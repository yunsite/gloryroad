<?php
/** 
*
* @package phpBB3
* @version $Id: auth.php,v 1.59 2006/06/17 11:28:21 acydburn Exp $ 
* @copyright (c) 2005 phpBB Group 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* Permission/Auth class
* @package phpBB3
*/
class auth
{
	var $acl = array();
	var $cache = array();
	var $acl_options = array();
	var $acl_forum_ids = false;

	/**
	* Init permissions
	*/
	function acl(&$userdata)
	{
		global $db, $cache;

		$this->acl = $this->cache = $this->acl_options = array();
		$this->acl_forum_ids = false;

		if (($this->acl_options = $cache->get('acl_options')) === false)
		{
			$sql = 'SELECT auth_option, is_global, is_local
				FROM ' . ACL_OPTIONS_TABLE . '
				ORDER BY auth_option_id';
			$result = $db->sql_query($sql);

			$global = $local = 0;
			$this->acl_options = array();
			while ($row = $db->sql_fetchrow($result))
			{
				if ($row['is_global'])
				{
					$this->acl_options['global'][$row['auth_option']] = $global++;
				}

				if ($row['is_local'])
				{
					$this->acl_options['local'][$row['auth_option']] = $local++;
				}
			}
			$db->sql_freeresult($result);

			$cache->put('acl_options', $this->acl_options);
			$this->acl_cache($userdata);
		}
		else if (!trim($userdata['user_permissions']))
		{
			$this->acl_cache($userdata);
		}

		$user_permissions = explode("\n", $userdata['user_permissions']);

		foreach ($user_permissions as $f => $seq)
		{
			if ($seq)
			{
				$i = 0;

				if (!isset($this->acl[$f]))
				{
					$this->acl[$f] = '';
				}

				while ($subseq = substr($seq, $i, 6))
				{
					// We put the original bitstring into the acl array
					$this->acl[$f] .= str_pad(base_convert($subseq, 36, 2), 31, 0, STR_PAD_LEFT);
					$i += 6;
				}
			}
		}

		return;
	}

	/**
	* Look up an option
	* if the option is prefixed with !, then the result becomes negated
	*
	* If a forum id is specified the local option will be combined with a global option if one exist.
	* If a forum id is not specified, only the global option will be checked.
	*/
	function acl_get($opt, $f = 0)
	{
		$negate = false;

		if (strpos($opt, '!') === 0)
		{
			$negate = true;
			$opt = substr($opt, 1);
		}

		if (!isset($this->cache[$f][$opt]))
		{
			// We combine the global/local option with an OR because some options are global and local.
			// If the user has the global permission the local one is true too and vice versa
			$this->cache[$f][$opt] = false;

			// Is this option a global permission setting?
			if (isset($this->acl_options['global'][$opt]))
			{
				if (isset($this->acl[0]))
				{
					$this->cache[$f][$opt] = $this->acl[0]{$this->acl_options['global'][$opt]};
				}
			}

			// Is this option a local permission setting?
			// But if we check for a global option only, we won't combine the options...
			if ($f != 0 && isset($this->acl_options['local'][$opt]))
			{
				if (isset($this->acl[$f]))
				{
					$this->cache[$f][$opt] |= $this->acl[$f]{$this->acl_options['local'][$opt]};
				}
			}
		}

		// Founder always has all global options set to true...
		return ($negate) ? !$this->cache[$f][$opt] : $this->cache[$f][$opt];
	}

	/**
	* Get forums with the specified permission setting
	* if the option is prefixed with !, then the result becomes nagated
	*
	* @param bool $clean set to true if only values needs to be returned which are set/unset
	*/
	function acl_getf($opt, $clean = false)
	{
		$acl_f = array();
		$negate = false;

		if (strpos($opt, '!') === 0)
		{
			$negate = true;
			$opt = substr($opt, 1);
		}

		// If we retrieve a list of forums not having permissions in, we need to get every forum_id
		if ($negate)
		{
			if ($this->acl_forum_ids === false)
			{
				global $db;

				$sql = 'SELECT forum_id 
					FROM ' . FORUMS_TABLE;
				
				if (sizeof($this->acl))
				{
					$sql .= ' WHERE forum_id NOT IN (' . implode(', ', array_keys($this->acl)) . ')';
				}
				$result = $db->sql_query($sql);

				$this->acl_forum_ids = array();
				while ($row = $db->sql_fetchrow($result))
				{
					$this->acl_forum_ids[] = $row['forum_id'];
				}
				$db->sql_freeresult($result);
			}
		}
		
		if (isset($this->acl_options['local'][$opt]))
		{
			foreach ($this->acl as $f => $bitstring)
			{
				// Skip global settings
				if (!$f)
				{
					continue;
				}

				$allowed = (!isset($this->cache[$f][$opt])) ? $this->acl_get($opt, $f) : $this->cache[$f][$opt];

				if (!$clean)
				{
					$acl_f[$f][$opt] = ($negate) ? !$allowed : $allowed;
				}
				else
				{
					if (($negate && !$allowed) || (!$negate && $allowed))
					{
						$acl_f[$f][$opt] = 1;
					}
				}
			}
		}

		// If we get forum_ids not having this permission, we need to fill the remaining parts
		if ($negate && sizeof($this->acl_forum_ids))
		{
			foreach ($this->acl_forum_ids as $f)
			{
				$acl_f[$f][$opt] = 1;
			}
		}

		return $acl_f;
	}

	/**
	* Get local permission state for any forum.
	*
	* Returns true if user has the permission in one or more forums, false if in no forum.
	* If global option is checked it returns the global state (same as acl_get($opt))
	* Local option has precedence...
	*/
	function acl_getf_global($opt)
	{
		$allowed = false;

		if (isset($this->acl_options['local'][$opt]))
		{
			foreach ($this->acl as $f => $bitstring)
			{
				// Skip global settings
				if (!$f)
				{
					continue;
				}

				$allowed = (!isset($this->cache[$f][$opt])) ? $this->acl_get($opt, $f) : $this->cache[$f][$opt];

				if ($allowed)
				{
					break;
				}
			}
		}
		else if (isset($this->acl_options['global'][$opt]))
		{
			$allowed = $this->acl_get($opt);
		}

		return $allowed;
	}

	/**
	* Get permission settings (more than one)
	*/
	function acl_gets()
	{
		$args = func_get_args();
		$f = array_pop($args);

		if (!is_numeric($f))
		{
			$args[] = $f;
			$f = 0;
		}

		// alternate syntax: acl_gets(array('m_', 'a_'), $forum_id)
		if (is_array($args[0]))
		{
			$args = $args[0];
		}

		$acl = 0;
		foreach ($args as $opt)
		{
			$acl |= $this->acl_get($opt, $f);
		}

		return $acl;
	}

	/**
	* Get permission listing based on user_id/options/forum_ids
	*/
	function acl_get_list($user_id = false, $opts = false, $forum_id = false)
	{
		$hold_ary = $this->acl_raw_data($user_id, $opts, $forum_id);

		$auth_ary = array();
		foreach ($hold_ary as $user_id => $forum_ary)
		{
			foreach ($forum_ary as $forum_id => $auth_option_ary)
			{
				foreach ($auth_option_ary as $auth_option => $auth_setting)
				{
					if ($auth_setting)
					{
						$auth_ary[$forum_id][$auth_option][] = $user_id;
					}
				}
			}
		}

		return $auth_ary;
	}

	/**
	* Cache data to user_permissions row
	*/
	function acl_cache(&$userdata)
	{
		global $db;

		// Empty user_permissions
		$userdata['user_permissions'] = '';

		$hold_ary = $this->acl_raw_data($userdata['user_id'], false, false);

		if (isset($hold_ary[$userdata['user_id']]))
		{
			$hold_ary = $hold_ary[$userdata['user_id']];
		}

		// Key 0 in $hold_ary are global options, all others are forum_ids

		// If this user is founder we're going to force fill the admin options ...
		if ($userdata['user_type'] == USER_FOUNDER)
		{
			foreach ($this->acl_options['global'] as $opt => $id)
			{
				if (strpos($opt, 'a_') === 0)
				{
					$hold_ary[0][$opt] = ACL_YES;
				}
			}
		}

		$hold_str = $this->build_bitstring($hold_ary);

		if ($hold_str)
		{
			$userdata['user_permissions'] = $hold_str;

			$sql = 'UPDATE ' . USERS_TABLE . "
				SET user_permissions = '" . $db->sql_escape($userdata['user_permissions']) . "',
					user_perm_from = 0
				WHERE user_id = " . $userdata['user_id'];
			$db->sql_query($sql);
		}

		return;
	}

	/**
	* Build bitstring from permission set
	*/
	function build_bitstring(&$hold_ary)
	{
		$hold_str = '';

		if (sizeof($hold_ary))
		{
			ksort($hold_ary);

			$last_f = 0;

			foreach ($hold_ary as $f => $auth_ary)
			{
				$ary_key = (!$f) ? 'global' : 'local';

				$bitstring = array();
				foreach ($this->acl_options[$ary_key] as $opt => $id)
				{
					if (isset($auth_ary[$opt]))
					{
						$bitstring[$id] = $auth_ary[$opt];

						$option_key = substr($opt, 0, strpos($opt, '_') + 1);

						// If one option is allowed, the global permission for this option has to be allowed too
						// example: if the user has the a_ permission this means he has one or more a_* permissions
						if ($auth_ary[$opt] == ACL_YES && (!isset($bitstring[$this->acl_options[$ary_key][$option_key]]) || $bitstring[$this->acl_options[$ary_key][$option_key]] == ACL_NO))
						{
							$bitstring[$this->acl_options[$ary_key][$option_key]] = ACL_YES;
						}
					}
					else
					{
						$bitstring[$id] = ACL_NO;
					}
				}

				// Now this bitstring defines the permission setting for the current forum $f (or global setting)
				$bitstring = implode('', $bitstring);

				// The line number indicates the id, therefore we have to add empty lines for those ids not present
				$hold_str .= str_repeat("\n", $f - $last_f);
			
				// Convert bitstring for storage - we do not use binary/bytes because PHP's string functions are not fully binary safe
				for ($i = 0; $i < strlen($bitstring); $i += 31)
				{
					$hold_str .= str_pad(base_convert(str_pad(substr($bitstring, $i, 31), 31, 0, STR_PAD_RIGHT), 2, 36), 6, 0, STR_PAD_LEFT);
				}

				$last_f = $f;
			}
			unset($bitstring);

			$hold_str = rtrim($hold_str);
		}

		return $hold_str;
	}

	/**
	* Clear one or all users cached permission settings
	*/
	function acl_clear_prefetch($user_id = false)
	{
		global $db;

		$where_sql = ($user_id !== false) ? ' WHERE user_id ' . ((is_array($user_id)) ? ' IN (' . implode(', ', array_map('intval', $user_id)) . ')' : " = $user_id") : '';

		$sql = 'UPDATE ' . USERS_TABLE . "
			SET user_permissions = '',
				user_perm_from = 0
			$where_sql";
		$db->sql_query($sql);

		return;
	}

	/**
	* Get assigned roles
	*/
	function acl_role_data($user_type, $role_type, $ug_id = false, $forum_id = false)
	{
		global $db;

		$roles = array();

		$sql_id = ($user_type == 'user') ? 'user_id' : 'group_id';

		$sql_ug = ($ug_id !== false) ? ((!is_array($ug_id)) ? "AND a.$sql_id = $ug_id" : "AND a.$sql_id IN (" . implode(', ', $ug_id) . ')') : '';
		$sql_forum = ($forum_id !== false) ? ((!is_array($forum_id)) ? "AND a.forum_id = $forum_id" : 'AND a.forum_id IN (' . implode(', ', $forum_id) . ')') : '';

		// Grab assigned roles...
		$sql = 'SELECT a.auth_role_id, a.' . $sql_id . ', a.forum_id
			FROM ' . (($user_type == 'user') ? ACL_USERS_TABLE : ACL_GROUPS_TABLE) . ' a, ' . ACL_ROLES_TABLE . " r
			WHERE a.auth_role_id = r.role_id
				AND r.role_type = '" . $db->sql_escape($role_type) . "'
				$sql_ug
				$sql_forum
			ORDER BY r.role_order ASC";
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			$roles[$row[$sql_id]][$row['forum_id']] = $row['auth_role_id'];
		}
		$db->sql_freeresult($result);

		return $roles;
	}

	/**
	* Get raw acl data based on user/option/forum
	*/
	function acl_raw_data($user_id = false, $opts = false, $forum_id = false)
	{
		global $db;

		$sql_user = ($user_id !== false) ? ((!is_array($user_id)) ? "user_id = $user_id" : 'user_id IN (' . implode(', ', $user_id) . ')') : '';
		$sql_forum = ($forum_id !== false) ? ((!is_array($forum_id)) ? "AND a.forum_id = $forum_id" : 'AND a.forum_id IN (' . implode(', ', $forum_id) . ')') : '';

		$sql_opts = '';

		if ($opts !== false)
		{
			if (!is_array($opts))
			{
				$sql_opts = (strpos($opts, '%') !== false) ? "AND ao.auth_option LIKE '" . $db->sql_escape($opts) . "'" : "AND ao.auth_option = '" . $db->sql_escape($opts) . "'";
			}
			else
			{
				$sql_opts = 'AND ao.auth_option IN (' . implode(', ', preg_replace('#^\s*(.*)\s*$#e', "\"'\" . \$db->sql_escape('\\1') . \"'\"", $opts)) . ')';
			}
		}

		$hold_ary = array();

		// First grab user settings ... each user has only one setting for each
		// option ... so we shouldn't need any ACL_NO checks ... he says ...
		// Grab assigned roles...
		$sql = $db->sql_build_query('SELECT', array(
			'SELECT'	=> 'ao.auth_option, a.auth_role_id, r.auth_setting as role_auth_setting, a.user_id, a.forum_id, a.auth_setting',

			'FROM'		=> array(
				ACL_OPTIONS_TABLE	=> 'ao',
				ACL_USERS_TABLE		=> 'a'
			),

			'LEFT_JOIN'	=> array(
				array(
					'FROM'	=> array(ACL_ROLES_DATA_TABLE => 'r'),
					'ON'	=> 'a.auth_role_id = r.role_id'
				)
			),

			'WHERE'		=> '(ao.auth_option_id = a.auth_option_id OR ao.auth_option_id = r.auth_option_id)
				' . (($sql_user) ? 'AND a.' . $sql_user : '') . "
				$sql_forum
				$sql_opts",

			'ORDER_BY'	=> 'a.forum_id, ao.auth_option'
		));
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			$setting = ($row['auth_role_id']) ? $row['role_auth_setting'] : $row['auth_setting'];
			$hold_ary[$row['user_id']][$row['forum_id']][$row['auth_option']] = $setting;
		}
		$db->sql_freeresult($result);

		// Now grab group settings ... ACL_NO overrides ACL_YES so act appropriatley
		$sql = $db->sql_build_query('SELECT', array(
			'SELECT'	=> 'ug.user_id, ao.auth_option, a.forum_id, a.auth_setting, a.auth_role_id, r.auth_setting as role_auth_setting',

			'FROM'		=> array(
				USER_GROUP_TABLE	=> 'ug',
				ACL_OPTIONS_TABLE	=> 'ao',
				ACL_GROUPS_TABLE	=> 'a'
			),

			'LEFT_JOIN'	=> array(
				array(
					'FROM'	=> array(ACL_ROLES_DATA_TABLE => 'r'),
					'ON'	=> 'a.auth_role_id = r.role_id'
				)
			),

			'WHERE'		=> '(ao.auth_option_id = a.auth_option_id OR ao.auth_option_id = r.auth_option_id)
				AND a.group_id = ug.group_id
				AND ug.user_pending = 0
				' . (($sql_user) ? 'AND ug.' . $sql_user : '') . "
				$sql_forum
				$sql_opts",

			'ORDER_BY'	=> 'a.forum_id, ao.auth_option'
		));
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			if (!isset($hold_ary[$row['user_id']][$row['forum_id']][$row['auth_option']]) || (isset($hold_ary[$row['user_id']][$row['forum_id']][$row['auth_option']]) && $hold_ary[$row['user_id']][$row['forum_id']][$row['auth_option']] != ACL_NO))
			{
				$setting = ($row['auth_role_id']) ? $row['role_auth_setting'] : $row['auth_setting'];
				$hold_ary[$row['user_id']][$row['forum_id']][$row['auth_option']] = $setting;

				// Check for existence of ACL_YES if an option got set to NO
				if ($setting == ACL_NO)
				{
					$flag = substr($row['auth_option'], 0, strpos($row['auth_option'], '_') + 1);

					if (isset($hold_ary[$row['user_id']][$row['forum_id']][$flag]) && $hold_ary[$row['user_id']][$row['forum_id']][$flag] == ACL_YES)
					{
						unset($hold_ary[$row['user_id']][$row['forum_id']][$flag]);

						if (in_array(ACL_YES, $hold_ary[$row['user_id']][$row['forum_id']]))
						{
							$hold_ary[$row['user_id']][$row['forum_id']][$flag] = ACL_YES;
						}
					}
				}
			}
		}
		$db->sql_freeresult($result);

		return $hold_ary;
	}

	/**
	* Get raw user based permission settings
	*/
	function acl_user_raw_data($user_id = false, $opts = false, $forum_id = false)
	{
		global $db;

		$sql_user = ($user_id !== false) ? ((!is_array($user_id)) ? "user_id = $user_id" : 'user_id IN (' . implode(', ', $user_id) . ')') : '';
		$sql_forum = ($forum_id !== false) ? ((!is_array($forum_id)) ? "AND a.forum_id = $forum_id" : 'AND a.forum_id IN (' . implode(', ', $forum_id) . ')') : '';

		$sql_opts = '';

		if ($opts !== false)
		{
			if (!is_array($opts))
			{
				$sql_opts = (strpos($opts, '%') !== false) ? "AND ao.auth_option LIKE '" . $db->sql_escape($opts) . "'" : "AND ao.auth_option = '" . $db->sql_escape($opts) . "'";
			}
			else
			{
				$sql_opts = 'AND ao.auth_option IN (' . implode(', ', preg_replace('#^\s*(.*)\s*$#e', "\"'\" . \$db->sql_escape('\\1') . \"'\"", $opts)) . ')';
			}
		}

		$hold_ary = array();

		// Grab user settings...
		$sql = $db->sql_build_query('SELECT', array(
			'SELECT'	=> 'ao.auth_option, a.auth_role_id, r.auth_setting as role_auth_setting, a.user_id, a.forum_id, a.auth_setting',
			
			'FROM'		=> array(
				ACL_OPTIONS_TABLE	=> 'ao',
				ACL_USERS_TABLE		=> 'a'
			),
			
			'LEFT_JOIN'	=> array(
				array(
					'FROM'	=> array(ACL_ROLES_DATA_TABLE => 'r'),
					'ON'	=> 'a.auth_role_id = r.role_id'
				),
			),

			'WHERE'		=> '(ao.auth_option_id = a.auth_option_id OR ao.auth_option_id = r.auth_option_id)
				' . (($sql_user) ? 'AND a.' . $sql_user : '') . "
				$sql_forum
				$sql_opts",

			'ORDER_BY'	=> 'a.forum_id, ao.auth_option'
		));
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			$setting = ($row['auth_role_id']) ? $row['role_auth_setting'] : $row['auth_setting'];
			$hold_ary[$row['user_id']][$row['forum_id']][$row['auth_option']] = $setting;
		}
		$db->sql_freeresult($result);

		return $hold_ary;
	}

	/**
	* Get raw group based permission settings
	*/
	function acl_group_raw_data($group_id = false, $opts = false, $forum_id = false)
	{
		global $db;

		$sql_group = ($group_id !== false) ? ((!is_array($group_id)) ? "group_id = $group_id" : 'group_id IN (' . implode(', ', $group_id) . ')') : '';
		$sql_forum = ($forum_id !== false) ? ((!is_array($forum_id)) ? "AND a.forum_id = $forum_id" : 'AND a.forum_id IN (' . implode(', ', $forum_id) . ')') : '';

		if ($opts !== false)
		{
			if (!is_array($opts))
			{
				$sql_opts = (strpos($opts, '%') !== false) ? "AND ao.auth_option LIKE '" . $db->sql_escape($opts) . "'" : "AND ao.auth_option = '" . $db->sql_escape($opts) . "'";
			}
			else
			{
				$sql_opts = 'AND ao.auth_option IN (' . implode(', ', preg_replace('#^\s*(.*)\s*$#e', "\"'\" . \$db->sql_escape('\\1') . \"'\"", $opts)) . ')';
			}
		}

		$hold_ary = array();

		// Grab group settings... 
		$sql = $db->sql_build_query('SELECT', array(
			'SELECT'	=> 'a.group_id, ao.auth_option, a.forum_id, a.auth_setting, a.auth_role_id, r.auth_setting as role_auth_setting',

			'FROM'		=> array(
				ACL_OPTIONS_TABLE	=> 'ao',
				ACL_GROUPS_TABLE	=> 'a'
			),

			'LEFT_JOIN'	=> array(
				array(
					'FROM'	=> array(ACL_ROLES_DATA_TABLE => 'r'),
					'ON'	=> 'a.auth_role_id = r.role_id'
				),
			),

			'WHERE'		=> '(ao.auth_option_id = a.auth_option_id OR ao.auth_option_id = r.auth_option_id)
				' . (($sql_group) ? 'AND a.' . $sql_group : '') . "
				$sql_forum
				$sql_opts",

			'ORDER_BY'	=> 'a.forum_id, ao.auth_option'
		));
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			$setting = ($row['auth_role_id']) ? $row['role_auth_setting'] : $row['auth_setting'];
			$hold_ary[$row['group_id']][$row['forum_id']][$row['auth_option']] = $setting;
		}
		$db->sql_freeresult($result);

		return $hold_ary;
	}

	/**
	* Authentication plug-ins is largely down to Sergey Kanareykin, our thanks to him.
	*/
	function login($username, $password, $autologin = false, $viewonline = 1, $admin = 0)
	{
		global $config, $db, $user, $phpbb_root_path, $phpEx;

		$method = trim(basename($config['auth_method']));

		if (file_exists($phpbb_root_path . 'includes/auth/auth_' . $method . '.' . $phpEx))
		{
			include_once($phpbb_root_path . 'includes/auth/auth_' . $method . '.' . $phpEx);

			$method = 'login_' . $method;
			if (function_exists($method))
			{
				$login = $method($username, $password);

				// If login succeeded, we will log the user in... else we pass the login array through...
				if ($login['status'] == LOGIN_SUCCESS)
				{
					$result = $user->session_create($login['user_row']['user_id'], $admin, $autologin, $viewonline);

					// Successful session creation
					if ($result === true)
					{
						return array(
							'status'		=> LOGIN_SUCCESS,
							'error_msg'		=> false,
							'user_row'		=> $login['user_row'],
						);
					}

					return array(
						'status'		=> LOGIN_BREAK,
						'error_msg'		=> $result,
						'user_row'		=> $login['user_row'],
					);
				}

				return $login;
			}
		}

		trigger_error('Authentication method not found', E_USER_ERROR);
	}
}

?>