<?php
/** 
*
* @package install
* @version $Id: index.php,v 1.19 2006/06/16 16:54:42 acydburn Exp $
* @copyright (c) 2005 phpBB Group 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
*/
define('IN_PHPBB', true);
define('IN_INSTALL', true);

$phpbb_root_path = './../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);

// Report all errors, except notices
error_reporting(E_ALL ^ E_NOTICE);

/*
* Remove variables created by register_globals from the global scope
* Thanks to Matt Kavanagh
*/
function deregister_globals()
{
	$not_unset = array(
		'GLOBALS' => true,
		'_GET' => true,
		'_POST' => true,
		'_COOKIE' => true,
		'_REQUEST' => true,
		'_SERVER' => true,
		'_SESSION' => true,
		'_ENV' => true,
		'_FILES' => true,
		'phpEx' => true,
		'phpbb_root_path' => true
	);

	// Not only will array_merge and array_keys give a warning if
	// a parameter is not an array, array_merge will actually fail.
	// So we check if _SESSION has been initialised.
	if (!isset($_SESSION) || !is_array($_SESSION))
	{
		$_SESSION = array();
	}

	// Merge all into one extremely huge array; unset
	// this later
	$input = array_merge(
		array_keys($_GET),
		array_keys($_POST),
		array_keys($_COOKIE),
		array_keys($_SERVER),
		array_keys($_SESSION),
		array_keys($_ENV),
		array_keys($_FILES)
	);

	foreach ($input as $varname)
	{
		if (isset($not_unset[$varname]))
		{
			// Hacking attempt. No point in continuing.
			exit;
		}

		unset($GLOBALS[$varname]);
	}

	unset($input);
}

// If we are on PHP >= 6.0.0 we do not need some code
if (version_compare(phpversion(), '6.0.0-dev', '>='))
{
	/**
	* @ignore
	*/
	define('STRIP', false);
}
else
{
	set_magic_quotes_runtime(0);

	// Be paranoid with passed vars
	if (@ini_get('register_globals') == '1' || strtolower(@ini_get('register_globals')) == 'on')
	{
		deregister_globals();
	}

	define('STRIP', (get_magic_quotes_gpc()) ? true : false);
}

@set_time_limit(120);

// Include essential scripts
require($phpbb_root_path . 'includes/functions.' . $phpEx);
include($phpbb_root_path . 'includes/auth.' . $phpEx);
include($phpbb_root_path . 'includes/session.' . $phpEx);
include($phpbb_root_path . 'includes/template.' . $phpEx);
include($phpbb_root_path . 'includes/acm/acm_file.' . $phpEx);
include($phpbb_root_path . 'includes/cache.' . $phpEx);
include($phpbb_root_path . 'includes/functions_admin.' . $phpEx);

// Try and load an appropriate language if required
$language = request_var('language', '');

if (!empty($_SERVER['HTTP_ACCEPT_LANGUAGE']) && !$language)
{
	$accept_lang_ary = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
	foreach ($accept_lang_ary as $accept_lang)
	{
		// Set correct format ... guess full xx_YY form
		$accept_lang = substr($accept_lang, 0, 2) . '_' . strtoupper(substr($accept_lang, 3, 2));

		if (file_exists($phpbb_root_path . 'language/' . $accept_lang))
		{
			$language = $accept_lang;
			break;
		}
		else
		{
			// No match on xx_YY so try xx
			$accept_lang = substr($accept_lang, 0, 2);
			if (file_exists($phpbb_root_path . 'language/' . $accept_lang))
			{
				$language = $accept_lang;
				break;
			}
		}
	}
}

// No appropriate language found ... so let's use the first one in the language
// dir, this may or may not be English
if (!$language)
{
	$dir = @opendir($phpbb_root_path . 'language');
	while (($file = readdir($dir)) !== false)
	{
		$path = $phpbb_root_path . 'language/' . $file;

		if (!is_file($path) && !is_link($path) && file_exists($path . '/iso.txt'))
		{
			$language = $file;
			break;
		}
	}
}

// And finally, load the relevant language files
include($phpbb_root_path . 'language/' . $language . '/common.' . $phpEx);
include($phpbb_root_path . 'language/' . $language . '/acp/common.' . $phpEx);
include($phpbb_root_path . 'language/' . $language . '/acp/board.' . $phpEx);
include($phpbb_root_path . 'language/' . $language . '/install.' . $phpEx);
include($phpbb_root_path . 'language/' . $language . '/posting.' . $phpEx);

$mode = request_var('mode', 'overview');
$sub = request_var('sub', '');

// Set PHP error handler to ours
set_error_handler('msg_handler');

$user = new user();
$auth = new auth();
$cache = new cache();
$template = new Template();

$template->set_custom_template('../adm/style', 'admin');
$template->assign_var('T_TEMPLATE_PATH', '../adm/style');

$install = new module();

$install->create('install', "index.$phpEx", $mode, $sub);
$install->load();

// Generate the page
$install->page_header();
$install->generate_navigation();

$template->set_filenames(array(
	'body' => $install->get_tpl_name())
);

$install->page_footer();

/**
* @package install
*/
class module
{
	var $id = 0;
	var $type = 'install';
	var $module_ary = array();
	var $filename;
	var $module_url = '';
	var $tpl_name = '';
	var $mode;
	var $sub;

	/**
	* Private methods, should not be overwritten
	*/
	function create($module_type, $module_url, $selected_mod = false, $selected_submod = false)
	{
		global $db, $config, $phpEx;

		$module = array();

		// Grab module information using Bart's "neat-o-module" system (tm)
		$dir = @opendir('.');

		$setmodules = 1;
		while (($file = readdir($dir)) !== false)
		{
			if (preg_match('#^install_(.*?)\.' . $phpEx . '$#', $file))
			{
				include($file);
			}
		}
		@closedir($dir);

		unset($setmodules);

		if (!sizeof($module))
		{
			$this->error('No installation modules found', __LINE__, __FILE__);
		}

		foreach ($module as $row)
		{
			// Check any module pre-reqs
			if ($row['module_reqs'] != '')
			{
			}

			$this->module_ary[$row['module_order']]['name'] = $row['module_title'];
			$this->module_ary[$row['module_order']]['filename'] = $row['module_filename'];
			$this->module_ary[$row['module_order']]['subs'] = $row['module_subs'];
			$this->module_ary[$row['module_order']]['stages'] = $row['module_stages'];

			if (strtolower($selected_mod) == strtolower($row['module_title']))
			{
				$this->id = (int) $row['module_order'];
				$this->filename = (string) $row['module_filename'];
				$this->module_url = (string) $module_url;
				$this->mode = (string) $selected_mod;
				// Check that the sub-mode specified is valid or set a default if not
				if (is_array($row['module_subs']))
				{
					$this->sub = strtolower((in_array(strtoupper($selected_submod), $row['module_subs'])) ? $selected_submod : $row['module_subs'][0]);
				}
				else if (is_array($row['module_stages']))
				{
					$this->sub = strtolower((in_array(strtoupper($selected_submod), $row['module_stages'])) ? $selected_submod : $row['module_stages'][0]);
				}
				else
				{
					$this->sub = '';
				}
			}
		} // END foreach
	} // END create

	/**
	* Load and run the relevant module if applicable
	*/
	function load($mode = false, $run = true)
	{
		global $phpbb_root_path, $phpEx;

		if ($run)
		{
			if (!empty($mode))
			{
				$this->mode = $mode;
			}

			/**
			* @todo this could be written as $this->module = new $this->filename($this); ... no? (eval statement in install/index.php)
			*/
			eval("\$this->module = new $this->filename(\$this);");
			if (method_exists($this->module, 'main'))
			{
				$this->module->main($this->mode, $this->sub);
			}
		}
	}

	/**
	* Output the standard page header
	*/
	function page_header()
	{
		if (defined('HEADER_INC'))
		{
			return;
		}

		define('HEADER_INC', true);
		global $template, $lang, $stage;

		$template->assign_vars(array(
			'L_INSTALL_PANEL'		=> $lang['INSTALL_PANEL'],
			'PAGE_TITLE'			=> $this->get_page_title(),

			'META'					=> $this->get_meta(),

			'S_CONTENT_DIRECTION' 	=> $lang['DIRECTION'],
			'S_CONTENT_ENCODING' 	=> $lang['ENCODING'],
			'S_CONTENT_DIR_LEFT' 	=> $lang['LEFT'],
			'S_CONTENT_DIR_RIGHT' 	=> $lang['RIGHT'],
			)
		);

		if (!empty($lang['ENCODING']))
		{
			header('Content-type: text/html; charset: ' . $lang['ENCODING']);
		}
		header('Cache-Control: private, no-cache="set-cookie", pre-check=0, post-check=0');
		header('Expires: 0');
		header('Pragma: no-cache');

		return;
	}

	/**
	* Output the standard page footer
	*/
	function page_footer()
	{
		global $template;

		$template->display('body');
	
		// Close our DB connection.
		if (isset($db))
		{
			$db->sql_close();
		}

		exit;
	}

	/**
	* Returns desired template name
	*/
	function get_tpl_name()
	{
		return $this->module->tpl_name . '.html';
	}

	/**
	* Returns the desired page title
	*/
	function get_page_title()
	{
		global $lang;

		if (!isset($this->module->page_title))
		{
			return '';
		}

		return (isset($lang[$this->module->page_title])) ? $lang[$this->module->page_title] : $this->module->page_title;
	}

	/**
	* Returns the desired meta tags for the page
	*/
	function get_meta()
	{
		return (isset($this->module->meta)) ? $this->module->meta : '';
	}

	/**
	* Generate the navigation tabs
	*/
	function generate_navigation()
	{
		global $lang, $template, $phpEx;

		if (is_array($this->module_ary))
		{
			@ksort($this->module_ary);
			foreach ($this->module_ary as $cat_ary)
			{
				$cat = $cat_ary['name'];
				$l_cat = (!empty($lang['CAT_' . $cat])) ? $lang['CAT_' . $cat] : preg_replace('#_#', ' ', $cat);
				$cat = strtolower($cat);
				$url = $this->module_url . '?mode=' . $cat;
				
				if ($this->mode == $cat)
				{
					$template->assign_block_vars('t_block1', array(
						'L_TITLE'		=> $l_cat,
						'S_SELECTED'	=> true,
						'U_TITLE'		=> $url,
					));

					if (is_array($this->module_ary[$this->id]['subs']))
					{
						$subs = $this->module_ary[$this->id]['subs']; 
						foreach ($subs as $option)
						{
							$l_option = (!empty($lang['SUB_' . $option])) ? $lang['SUB_' . $option] : preg_replace('#_#', ' ', $option);
							$option = strtolower($option);
							$url = $this->module_url . '?mode=' . $this->mode . '&amp;sub=' . $option;

							$template->assign_block_vars('l_block1', array(
								'L_TITLE'		=> $l_option,
								'S_SELECTED'	=> ($this->sub == $option),
								'U_TITLE'		=> $url,
							));
						}
					}

					if (is_array($this->module_ary[$this->id]['stages']))
					{
						$subs = $this->module_ary[$this->id]['stages']; 
						$matched = false;
						foreach ($subs as $option)
						{
							$l_option = (!empty($lang['STAGE_' . $option])) ? $lang['STAGE_' . $option] : preg_replace('#_#', ' ', $option);
							$option = strtolower($option);
							$matched = ($this->sub == $option) ? true : $matched;

							$template->assign_block_vars('l_block2', array(
								'L_TITLE'		=> $l_option,
								'S_SELECTED'	=> ($this->sub == $option),
								'S_COMPLETE'	=> !$matched,
							));
						}
					}
				}
				else
				{
					$template->assign_block_vars('t_block1', array(
						'L_TITLE'		=> $l_cat,
						'S_SELECTED'	=> false,
						'U_TITLE'		=> $url,
					));
				}
			}
		}
	}

	/**
	* Output an error message
	* If skip is true, return and continue execution, else exit
	* @todo Really should change the caption based on $skip and calling code at some point
	* @todo This needs testing with a large dataset that generates multiple errors
	*/
	function error($error, $line, $file, $skip = false)
	{
		global $lang, $db, $template;

		if ($skip)
		{
			$template->assign_block_vars('checks', array(
				'S_LEGEND'	=> true,
				'LEGEND'	=> $lang['INST_ERR_FATAL'],
			));

			$template->assign_block_vars('checks', array(
				'TITLE'		=> basename($file) . ' [ ' . $line . ' ]',
				'RESULT'	=> '<b style="color:red">' . $error . '</b>',
			));

			return;
		}

		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
		echo '<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">';
		echo '<head>';
		echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';
		echo '<title>' . $lang['INST_ERR_FATAL'] . '</title>';
		echo '<link href="../adm/style/admin.css" rel="stylesheet" type="text/css" media="screen" />';
		echo '</head>';
		echo '<body id="errorpage">';
		echo '<div id="wrap">';
		echo '	<div id="page-header">';
		echo '	</div>';
		echo '	<div id="page-body">';
		echo '		<div class="panel">';
		echo '			<span class="corners-top"><span></span></span>';
		echo '			<div id="content">';
		echo '				<h1>' . $lang['INST_ERR_FATAL'] . '</h1>';
		echo '		<p>' . $lang['INST_ERR_FATAL'] . "</p>\n";
		echo '		<p>' . basename($file) . ' [ ' . $line . " ]</p>\n";
		echo '		<p><b>' . $error . "</b></p>\n";
		echo '			</div>';
		echo '			<span class="corners-bottom"><span></span></span>';
		echo '		</div>';
		echo '	</div>';
		echo '	<div id="page-footer">';
		echo '		Powered by phpBB &copy; ' . date('Y') . ' <a href="http://www.phpbb.com/">phpBB Group</a>';
		echo '	</div>';
		echo '</div>';
		echo '</body>';
		echo '</html>';

		if (isset($db))
		{
			$db->sql_close();
		}

		exit;
	}

	/**
	* Output an error message for a database related problem
	* If skip is true, return and continue execution, else exit
	*/
	function db_error($error, $sql, $line, $file, $skip = false)
	{
		global $lang, $db, $template;

		if ($skip)
		{
			$template->assign_block_vars('checks', array(
				'S_LEGEND'	=> true,
				'LEGEND'	=> $lang['INST_ERR_FATAL'],
			));

			$template->assign_block_vars('checks', array(
				'TITLE'		=> basename($file) . ' [ ' . $line . ' ]',
				'RESULT'	=> '<b style="color:red">' . $error . '</b><br />&#187; SQL:' . $sql,
			));

			return;
		}

		$template->set_filenames(array(
			'body' => 'install_error.html')
		);
		$this->page_header();
		$this->generate_navigation();

		$template->assign_vars(array(
			'MESSAGE_TITLE'		=> $lang['INST_ERR_FATAL_DB'],
			'MESSAGE_TEXT'		=> '<p>' . basename($file) . ' [ ' . $line . ' ]</p><p>SQL : ' . $sql . '</p><p><b>' . $error . '</b></p>',
		));

		$db->sql_close();
		$this->page_footer();
		exit;
	}

	/**
	* Generate the relevant HTML for an input field and the assosciated label and explanatory text
	*/
	function input_field($name, $type, $value='', $options='')
	{
		global $lang;
		$tpl_type = explode(':', $type);
		$tpl = '';

		switch ($tpl_type[0])
		{
			case 'text':
			case 'password':
				$size = (int) $tpl_type[1];
				$maxlength = (int) $tpl_type[2];

				$tpl = '<input id="' . $name . '" type="' . $tpl_type[0] . '"' . (($size) ? ' size="' . $size . '"' : '') . ' maxlength="' . (($maxlength) ? $maxlength : 255) . '" name="' . $name . '" value="' . $value . '" />';
			break;

			case 'textarea':
				$rows = (int) $tpl_type[1];
				$cols = (int) $tpl_type[2];

				$tpl = '<textarea id="' . $key . '" name="' . $name . '" rows="' . $rows . '" cols="' . $cols . '">' . $value . '</textarea>';
			break;

			case 'radio':
				$key_yes	= ($value) ? ' checked="checked"' : '';
				$key_no		= (!$value) ? ' checked="checked"' : '';

				$tpl_type_cond = explode('_', $tpl_type[1]);
				$type_no = ($tpl_type_cond[0] == 'disabled' || $tpl_type_cond[0] == 'enabled') ? false : true;

				$tpl_no = '<input type="radio" name="' . $name . '" value="0"' . $key_no . ' class="radio" />&nbsp;' . (($type_no) ? $lang['NO'] : $lang['DISABLED']);
				$tpl_yes = '<input type="radio" name="' . $name . '" value="1"' . $key_yes . ' class="radio" />&nbsp;' . (($type_no) ? $lang['YES'] : $lang['ENABLED']);

				$tpl = ($tpl_type_cond[0] == 'yes' || $tpl_type_cond[0] == 'enabled') ? $tpl_yes . '&nbsp;&nbsp;' . $tpl_no : $tpl_no . '&nbsp;&nbsp;' . $tpl_yes;
			break;

			case 'select':
				eval('$s_options = ' . str_replace('{VALUE}', $value, $options) . ';');
				$tpl = '<select name="' . $name . '">' . $s_options . '</select>';
			break;

			case 'custom':
				eval('$tpl = ' . str_replace('{VALUE}', $value, $options) . ';');
			break;

			default:
			break;
		}

		return $tpl;
	}
}

?>