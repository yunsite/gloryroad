<?php
/** 
*
* @package acp
* @version $Id: acp_disallow.php,v 1.6 2006/06/16 16:54:37 acydburn Exp $
* @copyright (c) 2005 phpBB Group 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* @package acp
*/
class acp_disallow
{
	var $u_action;

	function main($id, $mode)
	{
		global $db, $user, $auth, $template, $cache;
		global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx;

		include($phpbb_root_path . 'includes/functions_user.' . $phpEx);

		$user->add_lang('acp/posting');

		// Set up general vars
		$this->tpl_name = 'acp_disallow';
		$this->page_header = 'ACP_DISALLOW_USERNAMES';

		$disallow = (isset($_POST['disallow'])) ? true : false;
		$allow = (isset($_POST['allow'])) ? true : false;

		if ($disallow)
		{
			$disallowed_user = str_replace('*', '%', request_var('disallowed_user', '', true));

			if (!$disallowed_user)
			{
				trigger_error($user->lang['NO_USERNAME_SPECIFIED'] . adm_back_link($this->u_action));
			}

			$sql = 'INSERT INTO ' . DISALLOW_TABLE . ' ' . $db->sql_build_array('INSERT', array('disallow_username' => $disallowed_user));
			$db->sql_query($sql);

			$message = $user->lang['DISALLOW_SUCCESSFUL'];
			add_log('admin', 'LOG_DISALLOW_ADD', str_replace('%', '*', $disallowed_user));

			trigger_error($message . adm_back_link($this->u_action));
		}
		else if ($allow)
		{
			$disallowed_id = request_var('disallowed_id', 0);

			if (!$disallowed_id)
			{
				trigger_error($user->lang['NO_USERNAME_SPECIFIED'] . adm_back_link($this->u_action));
			}

			$sql = 'DELETE FROM ' . DISALLOW_TABLE . "
				WHERE disallow_id = $disallowed_id";
			$db->sql_query($sql);

			add_log('admin', 'LOG_DISALLOW_DELETE');

			trigger_error($user->lang['DISALLOWED_DELETED'] . adm_back_link($this->u_action));
		}

		// Grab the current list of disallowed usernames...
		$sql = 'SELECT *
			FROM ' . DISALLOW_TABLE;
		$result = $db->sql_query($sql);

		$disallow_select = '';
		while ($row = $db->sql_fetchrow($result))
		{
			$disallow_select .= '<option value="' . $row['disallow_id'] . '">' . str_replace('%', '*', $row['disallow_username']) . '</option>';
		}
		$db->sql_freeresult($result);

		$template->assign_vars(array(
			'U_ACTION'				=> $this->u_action,
			'S_DISALLOWED_NAMES'	=> $disallow_select)
		);
	}
}

?>