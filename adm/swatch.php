<?php
/** 
*
* @package phpBB3
* @version $Id: swatch.php,v 1.8 2006/06/12 22:16:26 acydburn Exp $
* @copyright (c) 2005 phpBB Group 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* @ignore
*/
define('IN_PHPBB', true);
$phpbb_root_path = './../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

// Start session management
$user->session_begin(false);
$auth->acl($user->data);
$user->setup();

// Set custom template for admin area
$template->set_custom_template($phpbb_root_path . 'adm/style', 'admin');

$template->set_filenames(array(
	'body' => 'colour_swatch.html')
);

$template->assign_vars(array(
	'OPENER'		=> addslashes(request_var('form', '')),
	'NAME'			=> request_var('name', ''),
	'T_IMAGES_PATH'	=> "{$phpbb_root_path}images/",)
);

$template->display('body');

// Unload cache, must be done before the DB connection if closed
if (!empty($cache))
{
	$cache->unload();
}

// Close our DB connection.
$db->sql_close();

?>