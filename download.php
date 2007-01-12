<?php
/** 
*
* @package phpBB3
* @version $Id: download.php,v 1.33 2006/06/06 20:53:42 acydburn Exp $
* @copyright (c) 2005 phpBB Group 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* @ignore
*/
define('IN_PHPBB', true);
$phpbb_root_path = './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

$download_id = request_var('id', 0);

// Thumbnails are not handled by this file by default - but for modders this should be interesting. ;)
$thumbnail = request_var('t', false);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('viewtopic');

if (!$download_id)
{
	trigger_error('NO_ATTACHMENT_SELECTED');
}

if (!$config['allow_attachments'] && !$config['allow_pm_attach'])
{
	trigger_error('ATTACHMENT_FUNCTIONALITY_DISABLED');
}

$sql = 'SELECT attach_id, in_message, post_msg_id, extension
	FROM ' . ATTACHMENTS_TABLE . "
	WHERE attach_id = $download_id";
$result = $db->sql_query_limit($sql, 1);
$attachment = $db->sql_fetchrow($result);
$db->sql_freeresult($result);

if (!$attachment)
{
	trigger_error('ERROR_NO_ATTACHMENT');
}

if ((!$attachment['in_message'] && !$config['allow_attachments']) || ($attachment['in_message'] && !$config['allow_pm_attach']))
{
	trigger_error('ATTACHMENT_FUNCTIONALITY_DISABLED');
}

$row = array();
if (!$attachment['in_message'])
{
	// 
	$sql = 'SELECT p.forum_id, f.forum_password, f.parent_id
		FROM ' . POSTS_TABLE . ' p, ' . FORUMS_TABLE . ' f
		WHERE p.post_id = ' . $attachment['post_msg_id'] . '
			AND p.forum_id = f.forum_id';
	$result = $db->sql_query_limit($sql, 1);
	$row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);

	if ($auth->acl_get('u_download') && $auth->acl_get('f_download', $row['forum_id']))
	{
		if ($row['forum_password'])
		{
			// Do something else ... ?
			login_forum_box($row);
		}
	}
	else
	{
		trigger_error('SORRY_AUTH_VIEW_ATTACH');
	}
}
else
{
	$row['forum_id'] = 0;
	if (!$auth->acl_get('u_pm_download') || !$config['auth_download_pm'])
	{
		trigger_error('SORRY_AUTH_VIEW_ATTACH');
	}
}

// disallowed ?
$extensions = array();
if (!extension_allowed($row['forum_id'], $attachment['extension'], $extensions))
{
	trigger_error(sprintf($user->lang['EXTENSION_DISABLED_AFTER_POSTING'], $attachment['extension']));
}

if (!download_allowed())
{
	trigger_error($user->lang['LINKAGE_FORBIDDEN']);
}

$download_mode = (int) $extensions[$attachment['extension']]['download_mode'];

// Fetching filename here to prevent sniffing of filename
$sql = 'SELECT attach_id, in_message, post_msg_id, extension, physical_filename, real_filename, mimetype
	FROM ' . ATTACHMENTS_TABLE . "
	WHERE attach_id = $download_id";
$result = $db->sql_query_limit($sql, 1);
$attachment = $db->sql_fetchrow($result);
$db->sql_freeresult($result);

if (!$attachment)
{
	trigger_error('ERROR_NO_ATTACHMENT');
}


$attachment['physical_filename'] = basename($attachment['physical_filename']);

if ($thumbnail)
{
	$attachment['physical_filename'] = 'thumb_' . $attachment['physical_filename'];
}
else
{
	// Update download count
	$sql = 'UPDATE ' . ATTACHMENTS_TABLE . ' 
		SET download_count = download_count + 1 
		WHERE attach_id = ' . $attachment['attach_id'];
	$db->sql_query($sql);
}

// Determine the 'presenting'-method
if ($download_mode == PHYSICAL_LINK)
{
	if (!@is_dir($phpbb_root_path . $config['upload_path']))
	{
		trigger_error($user->lang['PHYSICAL_DOWNLOAD_NOT_POSSIBLE']);
	}

	redirect($phpbb_root_path . $config['upload_path'] . '/' . $attachment['physical_filename']);
	exit;
}
else
{
	send_file_to_browser($attachment, $config['upload_path'], $extensions[$attachment['extension']]['display_cat']);
	exit;
}


/**
* Send file to browser
*/
function send_file_to_browser($attachment, $upload_dir, $category)
{
	global $user, $db, $config, $phpbb_root_path;

	$filename = $phpbb_root_path . $upload_dir . '/' . $attachment['physical_filename'];

	if (!@file_exists($filename))
	{
		trigger_error($user->lang['ERROR_NO_ATTACHMENT'] . '<br /><br />' . sprintf($user->lang['FILE_NOT_FOUND_404'], $filename));
	}

	// Determine the Browser the User is using, because of some nasty incompatibilities.
	// borrowed from phpMyAdmin. :)
	$user_agent = $user->browser;

	if (ereg('Opera(/| )([0-9].[0-9]{1,2})', $user_agent, $log_version))
	{
		$browser_version = $log_version[2];
		$browser_agent = 'opera';
	}
	else if (ereg('MSIE ([0-9].[0-9]{1,2})', $user_agent, $log_version))
	{
		$browser_version = $log_version[1];
		$browser_agent = 'ie';
	}
	else if (ereg('OmniWeb/([0-9].[0-9]{1,2})', $user_agent, $log_version))
	{
		$browser_version = $log_version[1];
		$browser_agent = 'omniweb';
	}
	else if (ereg('(Konqueror/)(.*)(;)', $user_agent, $log_version))
	{
		$browser_version = $log_version[2];
		$browser_agent = 'konqueror';
	}
	else if (ereg('Mozilla/([0-9].[0-9]{1,2})', $user_agent, $log_version) && ereg('Safari/([0-9]*)', $user_agent, $log_version2))
	{
		$browser_version = $log_version[1] . '.' . $log_version2[1];
		$browser_agent = 'safari';
	}
	else if (ereg('Mozilla/([0-9].[0-9]{1,2})', $user_agent, $log_version))
	{
		$browser_version = $log_version[1];
		$browser_agent = 'mozilla';
	}
	else
	{
		$browser_version = 0;
		$browser_agent = 'other';
	}

	// Correct the mime type - we force application/octetstream for all files, except images
	// Please do not change this, it is a security precaution
	if ($category == ATTACHMENT_CATEGORY_NONE && strpos($attachment['mimetype'], 'image') === false)
	{
		$attachment['mimetype'] = ($browser_agent == 'ie' || $browser_agent == 'opera') ? 'application/octetstream' : 'application/octet-stream';
	}

	if (@ob_get_length())
	{
		@ob_end_clean();
	}
	
	// Now the tricky part... let's dance
	header('Pragma: public');

	// Send out the Headers
	header('Content-Type: ' . $attachment['mimetype'] . '; name="' . $attachment['real_filename'] . '"');
	header('Content-Disposition: inline; filename="' . $attachment['real_filename'] . '"');

	// Now send the File Contents to the Browser
	$size = @filesize($filename);
	if ($size)
	{
		header("Content-length: $size");
	}
	$result = @readfile($filename);
	
	if (!$result)
	{
		// PHP track_errors setting On?
		if (!empty($php_errormsg))
		{
			trigger_error('Unable to deliver file.<br />Error was: ' . $php_errormsg, E_USER_ERROR);
		}

		trigger_error('Unable to deliver file.', E_USER_ERROR);
	}

	flush();
	exit;
}

/**
* Check if downloading item is allowed
*/
function download_allowed()
{
	global $config, $user, $db;

	if (!$config['secure_downloads'])
	{
		return true;
	}

	$url = (getenv('HTTP_REFERER')) ? trim(getenv('HTTP_REFERER')) : trim($_SERVER['HTTP_REFERER']);

	if (!$url)
	{
		return ($config['secure_allow_empty_referer']) ? true : false;
	}

	// Split URL into domain and script part
	$url = explode('?', str_replace(array('http://', 'https://'), array('', ''), $url));
	$hostname = trim($url[0]);
	unset($url);

	$allowed = ($config['secure_allow_deny']) ? false : true;
	$iplist = array();

	$ip_ary = gethostbynamel($hostname);

	foreach ($ip_ary as $ip)
	{
		if ($ip)
		{
			$iplist[] = $ip;
		}
	}
	
	// Check for own server...
	$server_name = (!empty($_SERVER['SERVER_NAME'])) ? $_SERVER['SERVER_NAME'] : getenv('SERVER_NAME');

	// Forcing server vars is the only way to specify/override the protocol
	if ($config['force_server_vars'] || !$server_name)
	{
		$server_name = $config['server_name'];
	}

	if (preg_match('#^.*?' . preg_quote($server_name, '#') . '.*?$#i', $hostname))
	{
		$allowed = true;
	}
	
	// Get IP's and Hostnames
	if (!$allowed)
	{
		$sql = 'SELECT site_ip, site_hostname, ip_exclude
			FROM ' . SITELIST_TABLE;
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			$site_ip = trim($row['site_ip']);
			$site_hostname = trim($row['site_hostname']);

			if ($site_ip)
			{
				foreach ($iplist as $ip)
				{
					if (preg_match('#^' . str_replace('*', '.*?', $site_ip) . '$#i', $ip))
					{
						if ($row['ip_exclude'])
						{
							$allowed = ($config['secure_allow_deny']) ? false : true;
							break 2;
						}
						else
						{
							$allowed = ($config['secure_allow_deny']) ? true : false;
						}
					}
				}
			}

			if ($site_hostname)
			{
				if (preg_match('#^' . str_replace('*', '.*?', $site_hostname) . '$#i', $hostname))
				{
					if ($row['ip_exclude'])
					{
						$allowed = ($config['secure_allow_deny']) ? false : true;
						break;
					}
					else
					{
						$allowed = ($config['secure_allow_deny']) ? true : false;
					}
				}
			}
		}
		$db->sql_freeresult($result);
	}
	
	return $allowed;
}

?>