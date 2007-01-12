<?php
/**
*
* @package phpBB3
* @version $Id: functions_user.php,v 1.97 2006/06/13 21:06:27 acydburn Exp $
* @copyright (c) 2005 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* Obtain user_ids from usernames or vice versa. Returns false on
* success else the error string
*/
function user_get_id_name(&$user_id_ary, &$username_ary)
{
	global $db;

	// Are both arrays already filled? Yep, return else
	// are neither array filled?
	if ($user_id_ary && $username_ary)
	{
		return false;
	}
	else if (!$user_id_ary && !$username_ary)
	{
		return 'NO_USERS';
	}

	$which_ary = ($user_id_ary) ? 'user_id_ary' : 'username_ary';

	if ($$which_ary && !is_array($$which_ary))
	{
		$$which_ary = array($$which_ary);
	}

	$sql_in = ($which_ary == 'user_id_ary') ? array_map('intval', $$which_ary) : preg_replace('#^\s*(.*)\s*$#e', "\"'\" . \$db->sql_escape('\\1') . \"'\"", $$which_ary);
	unset($$which_ary);

	// Grab the user id/username records
	$sql_where = ($which_ary == 'user_id_ary') ? 'user_id' : 'username';
	$sql = 'SELECT user_id, username
		FROM ' . USERS_TABLE . "
		WHERE $sql_where IN (" . implode(', ', $sql_in) . ')';
	$result = $db->sql_query($sql);

	if (!($row = $db->sql_fetchrow($result)))
	{
		$db->sql_freeresult($result);
		return 'NO_USERS';
	}

	$user_id_ary = $username_ary = array();
	do
	{
		$username_ary[$row['user_id']] = $row['username'];
		$user_id_ary[] = $row['user_id'];
	}
	while ($row = $db->sql_fetchrow($result));
	$db->sql_freeresult($result);

	return false;
}

/**
* Get latest registered username and update database to reflect it
*/
function update_last_username()
{
	global $db;

	// Get latest username
	$sql = 'SELECT user_id, username
		FROM ' . USERS_TABLE . '
		WHERE user_type IN (' . USER_NORMAL . ', ' . USER_FOUNDER . ')
		ORDER BY user_id DESC';
	$result = $db->sql_query_limit($sql, 1);
	$row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);

	if ($row)
	{
		set_config('newest_user_id', $row['user_id'], true);
		set_config('newest_username', $row['username'], true);
	}
}

/**
* Updates a username across all relevant tables/fields
*
* @param string $old_name the old/current username
* @param string $new_name the new username
*/
function user_update_name($old_name, $new_name)
{
	global $config, $db, $cache;

	$update_ary = array(
		FORUMS_TABLE			=> array('forum_last_poster_name'),
		MODERATOR_CACHE_TABLE	=> array('username'),
		POSTS_TABLE				=> array('post_username'),
		TOPICS_TABLE			=> array('topic_first_poster_name', 'topic_last_poster_name'),
	);

	foreach ($update_ary as $table => $field_ary)
	{
		foreach ($field_ary as $field)
		{
			$sql = "UPDATE $table
				SET $field = '" . $db->sql_escape($new_name) . "'
				WHERE $field = '" . $db->sql_escape($old_name) . "'";
			$db->sql_query($sql);
		}
	}

	if ($config['newest_username'] == $old_name)
	{
		set_config('newest_username', $new_name);
	}
}

/**
* Add User
*/
function user_add($user_row, $cp_data = false)
{
	global $db, $user, $auth, $config, $phpbb_root_path, $phpEx;

	if (empty($user_row['username']) || !isset($user_row['group_id']) || !isset($user_row['user_email']) || !isset($user_row['user_type']))
	{
		return false;
	}

	$sql_ary = array(
		'username'			=> $user_row['username'],
		'user_password'		=> (isset($user_row['user_password'])) ? $user_row['user_password'] : '',
		'user_email'		=> $user_row['user_email'],
		'user_email_hash'	=> (int) crc32(strtolower($user_row['user_email'])) . strlen($user_row['user_email']),
		'group_id'			=> $user_row['group_id'],
		'user_type'			=> $user_row['user_type'],
	);

	// These are the additional vars able to be specified
	$additional_vars = array(
		'user_permissions'	=> '',
		'user_timezone'		=> 0,
		'user_dateformat'	=> $config['default_dateformat'],
		'user_lang'			=> $config['default_lang'],
		'user_style'		=> $config['default_style'],
		'user_allow_pm'		=> 1,
		'user_actkey'		=> '',
		'user_ip'			=> '',
		'user_regdate'		=> time(),

		'user_lastmark'			=> time(),
		'user_lastvisit'		=> 0,
		'user_lastpost_time'	=> 0,
		'user_lastpage'			=> '',
		'user_posts'			=> 0,
		'user_dst'				=> 0,
		'user_colour'			=> '',
		'user_avatar'			=> '',
		'user_avatar_type'		=> 0,
		'user_avatar_width'		=> 0,
		'user_avatar_height'	=> 0,
		'user_new_privmsg'		=> 0,
		'user_unread_privmsg'	=> 0,
		'user_last_privmsg'		=> 0,
		'user_message_rules'	=> 0,
		'user_full_folder'		=> PRIVMSGS_NO_BOX,
		'user_emailtime'		=> 0,

		'user_notify'			=> 0,
		'user_notify_pm'		=> 1,
		'user_notify_type'		=> NOTIFY_EMAIL,
		'user_allow_pm'			=> 1,
		'user_allow_email'		=> 1,
		'user_allow_viewonline'	=> 1,
		'user_allow_viewemail'	=> 1,
		'user_allow_massemail'	=> 1,

		'user_sig'					=> '',
		'user_sig_bbcode_uid'		=> '',
		'user_sig_bbcode_bitfield'	=> 0,
	);

	// Now fill the sql array with not required variables
	foreach ($additional_vars as $key => $default_value)
	{
		$sql_ary[$key] = (isset($user_row[$key])) ? $user_row[$key] : $default_value;
	}

	// Any additional variables in $user_row not covered above?
	$remaining_vars = array_diff(array_keys($user_row), array_keys($sql_ary));

	// Now fill our sql array with the remaining vars
	if (sizeof($remaining_vars))
	{
		foreach ($remaining_vars as $key)
		{
			$sql_ary[$key] = $user_row[$key];
		}
	}

	$db->sql_transaction('begin');

	$sql = 'INSERT INTO ' . USERS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	$db->sql_query($sql);

	$user_id = $db->sql_nextid();

	// Insert Custom Profile Fields
	if ($cp_data !== false && sizeof($cp_data))
	{
		$cp_data['user_id'] = (int) $user_id;

		if (!class_exists('custom_profile'))
		{
			include_once($phpbb_root_path . 'includes/functions_profile_fields.' . $phpEx);
		}

		$sql = 'INSERT INTO ' . PROFILE_FIELDS_DATA_TABLE . ' ' . 
			$db->sql_build_array('INSERT', custom_profile::build_insert_sql_array($cp_data));
		$db->sql_query($sql);
	}

	// Place into appropriate group...
	$sql = 'INSERT INTO ' . USER_GROUP_TABLE . ' ' . $db->sql_build_array('INSERT', array(
		'user_id'		=> (int) $user_id,
		'group_id'		=> (int) $user_row['group_id'],
		'user_pending'	=> 0)
	);
	$db->sql_query($sql);

	$db->sql_transaction('commit');

	return $user_id;
}

/**
* Remove User
*/
function user_delete($mode, $user_id, $post_username = false)
{
	global $config, $db, $user, $auth;

	$db->sql_transaction('begin');

	switch ($mode)
	{
		case 'retain':
			$sql = 'UPDATE ' . FORUMS_TABLE . '
				SET forum_last_poster_id = ' . ANONYMOUS . (($post_username !== false) ? ", forum_last_poster_name = '" . $db->sql_escape($post_username) . "'" : '') . "
				WHERE forum_last_poster_id = $user_id";
			$db->sql_query($sql);

			$sql = 'UPDATE ' . POSTS_TABLE . '
				SET poster_id = ' . ANONYMOUS . (($post_username !== false) ? ", post_username = '" . $db->sql_escape($post_username) . "'" : '') . "
				WHERE poster_id = $user_id";
			$db->sql_query($sql);

			$sql = 'UPDATE ' . TOPICS_TABLE . '
				SET topic_poster = ' . ANONYMOUS . "
				WHERE topic_poster = $user_id";
			$db->sql_query($sql);

			$sql = 'UPDATE ' . TOPICS_TABLE . '
				SET topic_last_poster_id = ' . ANONYMOUS . (($post_username !== false) ? ", topic_last_poster_name = '" . $db->sql_escape($post_username) . "'" : '') . "
				WHERE topic_last_poster_id = $user_id";
			$db->sql_query($sql);
		break;

		case 'remove':

			if (!function_exists('delete_posts'))
			{
				global $phpbb_root_path, $phpEx;
				include_once($phpbb_root_path . 'includes/functions_admin.' . $phpEx);
			}

			$sql = 'SELECT topic_id, COUNT(post_id) AS total_posts
				FROM ' . POSTS_TABLE . "
				WHERE poster_id = $user_id
				GROUP BY topic_id";
			$result = $db->sql_query($sql);

			$topic_id_ary = array();
			while ($row = $db->sql_fetchrow($result))
			{
				$topic_id_ary[$row['topic_id']] = $row['total_posts'];
			}
			$db->sql_freeresult($result);

			if (sizeof($topic_id_ary))
			{
				$sql = 'SELECT topic_id, topic_replies, topic_replies_real
					FROM ' . TOPICS_TABLE . '
					WHERE topic_id IN (' . implode(', ', array_keys($topic_id_ary)) . ')';
				$result = $db->sql_query($sql);

				$del_topic_ary = array();
				while ($row = $db->sql_fetchrow($result))
				{
					if (max($row['topic_replies'], $row['topic_replies_real']) + 1 == $topic_id_ary[$row['topic_id']])
					{
						$del_topic_ary[] = $row['topic_id'];
					}
				}
				$db->sql_freeresult($result);

				if (sizeof($del_topic_ary))
				{
					$sql = 'DELETE FROM ' . TOPICS_TABLE . '
						WHERE topic_id IN (' . implode(', ', $del_topic_ary) . ')';
					$db->sql_query($sql);
				}
			}

			// Delete posts, attachments, etc.
			delete_posts('poster_id', $user_id);

		break;
	}

	$table_ary = array(USERS_TABLE, USER_GROUP_TABLE, TOPICS_WATCH_TABLE, FORUMS_WATCH_TABLE, ACL_USERS_TABLE, TOPICS_TRACK_TABLE, TOPICS_POSTED_TABLE, FORUMS_TRACK_TABLE);

	foreach ($table_ary as $table)
	{
		$sql = "DELETE FROM $table
			WHERE user_id = $user_id";
		$db->sql_query($sql);
	}

	// Reset newest user info if appropriate
	if ($config['newest_user_id'] == $user_id)
	{
		update_last_username();
	}

	set_config('num_users', $config['num_users'] - 1, true);

	$db->sql_transaction('commit');

	return false;
}

/**
* Flips user_type from active to inactive and vice versa, handles
* group membership updates
*/
function user_active_flip($user_id, $user_type, $user_actkey = false, $username = false, $no_log = false)
{
	global $db, $user, $auth;

	$sql = 'SELECT group_id, group_name
		FROM ' . GROUPS_TABLE . "
		WHERE group_name IN ('REGISTERED', 'REGISTERED_COPPA', 'INACTIVE', 'INACTIVE_COPPA')";
	$result = $db->sql_query($sql);

	$group_id_ary = array();
	while ($row = $db->sql_fetchrow($result))
	{
		$group_id_ary[$row['group_name']] = $row['group_id'];
	}
	$db->sql_freeresult($result);

	$sql = 'SELECT group_id
		FROM ' . USER_GROUP_TABLE . "
		WHERE user_id = $user_id";
	$result = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($result))
	{
		if ($group_name = array_search($row['group_id'], $group_id_ary))
		{
			break;
		}
	}
	$db->sql_freeresult($result);

	$current_group = ($user_type == USER_NORMAL) ? 'REGISTERED' : 'INACTIVE';
	$switch_group = ($user_type == USER_NORMAL) ? 'INACTIVE' : 'REGISTERED';

	$new_group_id = $group_id_ary[str_replace($current_group, $switch_group, $group_name)];

	$sql = 'UPDATE ' . USER_GROUP_TABLE . "
		SET group_id = $new_group_id
		WHERE user_id = $user_id
			AND group_id = " . $group_id_ary[$group_name];
	$db->sql_query($sql);

	$sql_ary = array(
		'user_type'		=> ($user_type == USER_NORMAL) ? USER_INACTIVE : USER_NORMAL
	);

	if ($new_group_id == $group_id_ary[$group_name])
	{
		$sql_ary['group_id'] = $new_group_id;
	}

	if ($user_actkey !== false)
	{
		$sql_ary['user_actkey'] = $user_actkey;
	}

	$sql = 'UPDATE ' . USERS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . "
		WHERE user_id = $user_id";
	$db->sql_query($sql);

	$auth->acl_clear_prefetch($user_id);

	if (!$no_log)
	{
		if ($username === false)
		{
			$sql = 'SELECT username
				FROM ' . USERS_TABLE . "
				WHERE user_id = $user_id";
			$result = $db->sql_query($sql);
			$username = (string) $db->sql_fetchfield('username');
			$db->sql_freeresult($result);
		}

		$log = ($user_type == USER_NORMAL) ? 'LOG_USER_INACTIVE' : 'LOG_USER_ACTIVE';
		add_log('admin', $log, $username);
	}

	return false;
}

/**
* Add a ban or ban exclusion to the banlist. Bans either a user, an IP or an email address
*
* @param string $mode Type of ban. One of the following: user, ip, email
* @param mixed $ban Banned entity. Either string or array with usernames, ips or email addresses
* @param int $ban_len Ban length in minutes
* @param string $ban_len_other Ban length as a date (YYYY-MM-DD)
* @param boolean $ban_exclude Exclude these entities from banning?
* @param string $ban_reason String describing the reason for this ban
* @return boolean
*/
function user_ban($mode, $ban, $ban_len, $ban_len_other, $ban_exclude, $ban_reason, $ban_give_reason = '')
{
	global $db, $user, $auth;

	// Delete stale bans
	$sql = 'DELETE FROM ' . BANLIST_TABLE . '
		WHERE ban_end < ' . time() . '
			AND ban_end <> 0';
	$db->sql_query($sql);

	$ban_list = (!is_array($ban)) ? array_unique(explode("\n", $ban)) : $ban;
	$ban_list_log = implode(', ', $ban_list);

	$current_time = time();

	// Set $ban_end to the unix time when the ban should end. 0 is a permanent ban.
	if ($ban_len)
	{
		if ($ban_len != -1 || !$ban_len_other)
		{
			$ban_end = max($current_time, $current_time + ($ban_len) * 60);
		}
		else
		{
			$ban_other = explode('-', $ban_len_other);
			$ban_end = max($current_time, gmmktime(0, 0, 0, $ban_other[1], $ban_other[2], $ban_other[0]));
		}
	}
	else
	{
		$ban_end = 0;
	}

	$banlist_ary = array();

	switch ($mode)
	{
		case 'user':
			$type = 'ban_userid';

			if (in_array('*', $ban_list))
			{
				// Ban all users (it's a good thing that you can exclude people)
				$banlist_ary[] = '*';
			}
			else
			{
				// Select the relevant user_ids.
				$sql_usernames = array();

				foreach ($ban_list as $username)
				{
					$username = trim($username);
					if ($username != '')
					{
						$sql_usernames[] = "'" . $db->sql_escape($username) . "'";
					}
				}
				$sql_usernames = implode(', ', $sql_usernames);

				$sql = 'SELECT user_id
					FROM ' . USERS_TABLE . '
					WHERE username IN (' . $sql_usernames . ')';
				$result = $db->sql_query($sql);

				if ($row = $db->sql_fetchrow($result))
				{
					do
					{
						$banlist_ary[] = $row['user_id'];
					}
					while ($row = $db->sql_fetchrow($result));
				}
				else
				{
					trigger_error($user->lang['NO_USERS']);
				}
				$db->sql_freeresult($result);
			}
		break;

		case 'ip':
			$type = 'ban_ip';

			foreach ($ban_list as $ban_item)
			{
				if (preg_match('#^([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})[ ]*\-[ ]*([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})$#', trim($ban_item), $ip_range_explode))
				{
					// This is an IP range
					// Don't ask about all this, just don't ask ... !
					$ip_1_counter = $ip_range_explode[1];
					$ip_1_end = $ip_range_explode[5];

					while ($ip_1_counter <= $ip_1_end)
					{
						$ip_2_counter = ($ip_1_counter == $ip_range_explode[1]) ? $ip_range_explode[2] : 0;
						$ip_2_end = ($ip_1_counter < $ip_1_end) ? 254 : $ip_range_explode[6];

						if ($ip_2_counter == 0 && $ip_2_end == 254)
						{
							$ip_2_counter = 256;
							$ip_2_fragment = 256;

							$banlist_ary[] = "$ip_1_counter.*";
						}

						while ($ip_2_counter <= $ip_2_end)
						{
							$ip_3_counter = ($ip_2_counter == $ip_range_explode[2] && $ip_1_counter == $ip_range_explode[1]) ? $ip_range_explode[3] : 0;
							$ip_3_end = ($ip_2_counter < $ip_2_end || $ip_1_counter < $ip_1_end) ? 254 : $ip_range_explode[7];

							if ($ip_3_counter == 0 && $ip_3_end == 254)
							{
								$ip_3_counter = 256;
								$ip_3_fragment = 256;

								$banlist_ary[] = "$ip_1_counter.$ip_2_counter.*";
							}

							while ($ip_3_counter <= $ip_3_end)
							{
								$ip_4_counter = ($ip_3_counter == $ip_range_explode[3] && $ip_2_counter == $ip_range_explode[2] && $ip_1_counter == $ip_range_explode[1]) ? $ip_range_explode[4] : 0;
								$ip_4_end = ($ip_3_counter < $ip_3_end || $ip_2_counter < $ip_2_end) ? 254 : $ip_range_explode[8];

								if ($ip_4_counter == 0 && $ip_4_end == 254)
								{
									$ip_4_counter = 256;
									$ip_4_fragment = 256;

									$banlist_ary[] = "$ip_1_counter.$ip_2_counter.$ip_3_counter.*";
								}

								while ($ip_4_counter <= $ip_4_end)
								{
									$banlist_ary[] = "$ip_1_counter.$ip_2_counter.$ip_3_counter.$ip_4_counter";
									$ip_4_counter++;
								}
								$ip_3_counter++;
							}
							$ip_2_counter++;
						}
						$ip_1_counter++;
					}
				}
				else if (preg_match('#^([\w\-_]\.?){2,}$#is', trim($ban_item)))
				{
					// hostname
					$ip_ary = gethostbynamel(trim($ban_item));

					foreach ($ip_ary as $ip)
					{
						if ($ip)
						{
							$banlist_ary[] = $ip;
						}
					}
				}
				else if (preg_match('#^([0-9]{1,3})\.([0-9\*]{1,3})\.([0-9\*]{1,3})\.([0-9\*]{1,3})$#', trim($ban_item)) || preg_match('#^[a-f0-9:]+\*?$#i', trim($ban_item)))
				{
					// Normal IP address
					$banlist_ary[] = trim($ban_item);
				}
				else if (preg_match('#^\*$#', trim($ban_item)))
				{
					// Ban all IPs
					$banlist_ary[] = "*";
				}
				else
				{
					trigger_error('NO_IPS_DEFINED');
				}
			}
		break;

		case 'email':
			$type = 'ban_email';

			foreach ($ban_list as $ban_item)
			{
				if (preg_match('#^.*?@*|(([a-z0-9\-]+\.)+([a-z]{2,3}))$#i', trim($ban_item)))
				{
					$banlist_ary[] = trim($ban_item);
				}
			}

			if (sizeof($ban_list) == 0)
			{
				trigger_error('NO_EMAILS_DEFINED');
			}
		break;

		default:
			trigger_error('NO_MODE');
		break;
	}

	// Fetch currently set bans of the specified type and exclude state. Prevent duplicate bans.
	$sql = "SELECT $type
		FROM " . BANLIST_TABLE . "
		WHERE $type <> ''
			AND ban_exclude = $ban_exclude";
	$result = $db->sql_query($sql);

	if ($row = $db->sql_fetchrow($result))
	{
		$banlist_ary_tmp = array();
		do
		{
			switch ($mode)
			{
				case 'user':
					$banlist_ary_tmp[] = $row['ban_userid'];
				break;

				case 'ip':
					$banlist_ary_tmp[] = $row['ban_ip'];
				break;

				case 'email':
					$banlist_ary_tmp[] = $row['ban_email'];
				break;
			}
		}
		while ($row = $db->sql_fetchrow($result));

		$banlist_ary = array_unique(array_diff($banlist_ary, $banlist_ary_tmp));
		unset($banlist_ary_tmp);
	}
	$db->sql_freeresult($result);

	// We have some entities to ban
	if (sizeof($banlist_ary))
	{
		$sql_ary = array();

		foreach ($banlist_ary as $ban_entry)
		{
			$sql_ary[] = array(
				$type				=> $ban_entry,
				'ban_start'			=> $current_time,
				'ban_end'			=> $ban_end,
				'ban_exclude'		=> $ban_exclude,
				'ban_reason'		=> $ban_reason,
				'ban_give_reason'	=> $ban_give_reason,
			);
		}
		
		if (sizeof($sql_ary))
		{
			switch (SQL_LAYER)
			{
				case 'mysql':
				case 'mysql4':
				case 'mysqli':
					$db->sql_query('INSERT INTO ' . BANLIST_TABLE . ' ' . $db->sql_build_array('MULTI_INSERT', $sql_ary));
				break;

				default:
					foreach ($sql_ary as $ary)
					{
						$db->sql_query('INSERT INTO ' . BANLIST_TABLE . ' ' . $db->sql_build_array('INSERT', $ary));
					}
				break;
			}
		}

		// If we are banning we want to logout anyone matching the ban
		if (!$ban_exclude)
		{
			switch ($mode)
			{
				case 'user':
					$sql_where = (in_array('*', $banlist_ary)) ? '' : 'WHERE session_user_id IN (' . implode(', ', $banlist_ary) . ')';
				break;

				case 'ip':
					$banlist_ary_sql = array();

					foreach ($banlist_ary as $ban_entry)
					{
						$banlist_ary_sql[] = "'" . $db->sql_escape($ban_entry) . "'";
					}
					$sql_where = 'WHERE session_ip IN (' . implode(', ', $banlist_ary_sql) . ')';
				break;

				case 'email':
					$banlist_ary_sql = array();

					foreach ($banlist_ary as $ban_entry)
					{
						$banlist_ary_sql[] = "'" . $db->sql_escape(str_replace('*', '%', $ban_entry)) . "'";
					}

					$sql = 'SELECT user_id
						FROM ' . USERS_TABLE . '
						WHERE user_email IN (' . implode(', ', $banlist_ary_sql) . ')';
					$result = $db->sql_query($sql);

					$sql_in = array();

					if ($row = $db->sql_fetchrow($result))
					{
						do
						{
							$sql_in[] = $row['user_id'];
						}
						while ($row = $db->sql_fetchrow($result));

						$sql_where = 'WHERE session_user_id IN (' . implode(', ', $sql_in) . ")";
					}
					$db->sql_freeresult($result);
				break;
			}

			if (isset($sql_where) && $sql_where)
			{
				$sql = 'DELETE FROM ' . SESSIONS_TABLE . "
					$sql_where";
				$db->sql_query($sql);
			}
		}

		// Update log
		$log_entry = ($ban_exclude) ? 'LOG_BAN_EXCLUDE_' : 'LOG_BAN_';
		add_log('admin', $log_entry . strtoupper($mode), $ban_reason, $ban_list_log);
		return true;
	}

	// There was nothing to ban/exclude
	return false;
}

/**
* Unban User
*/
function user_unban($mode, $ban)
{
	global $db, $user, $auth;

	// Delete stale bans
	$sql = 'DELETE FROM ' . BANLIST_TABLE . '
		WHERE ban_end < ' . time() . '
			AND ban_end <> 0';
	$db->sql_query($sql);

	if (!is_array($ban))
	{
		$ban = array($ban);
	}

	$unban_sql = implode(', ', array_map('intval', $ban));

	if ($unban_sql)
	{
		// Grab details of bans for logging information later
		switch ($mode)
		{
			case 'user':
				$sql = 'SELECT u.username AS unban_info
					FROM ' . USERS_TABLE . ' u, ' . BANLIST_TABLE . " b
					WHERE b.ban_id IN ($unban_sql)
						AND u.user_id = b.ban_userid";
			break;

			case 'email':
				$sql = 'SELECT ban_email AS unban_info
					FROM ' . BANLIST_TABLE . "
					WHERE ban_id IN ($unban_sql)";
			break;

			case 'ip':
				$sql = 'SELECT ban_ip AS unban_info
					FROM ' . BANLIST_TABLE . "
					WHERE ban_id IN ($unban_sql)";
			break;
		}
		$result = $db->sql_query($sql);

		$l_unban_list = '';
		while ($row = $db->sql_fetchrow($result))
		{
			$l_unban_list .= (($l_unban_list != '') ? ', ' : '') . $row['unban_info'];
		}
		$db->sql_freeresult($result);

		$sql = 'DELETE FROM ' . BANLIST_TABLE . "
			WHERE ban_id IN ($unban_sql)";
		$db->sql_query($sql);

		add_log('admin', 'LOG_UNBAN_' . strtoupper($mode), $l_unban_list);
	}

	return false;
}

/**
* Whois facility
*/
function user_ipwhois($ip)
{
	$ipwhois = '';

	$match = array(
		'#RIPE\.NET#is'				=> 'whois.ripe.net',
		'#whois\.apnic\.net#is'		=> 'whois.apnic.net',
		'#nic\.ad\.jp#is'			=> 'whois.nic.ad.jp',
		'#whois\.registro\.br#is'	=> 'whois.registro.br'
	);

	if (($fsk = @fsockopen('whois.arin.net', 43)))
	{
		fputs($fsk, "$ip\n");
		while (!feof($fsk))
		{
			$ipwhois .= fgets($fsk, 1024);
		}
		@fclose($fsk);
	}

	foreach (array_keys($match) as $server)
	{
		if (preg_match($server, $ipwhois))
		{
			$ipwhois = '';
			if (($fsk = @fsockopen($match[$server], 43)))
			{
				fputs($fsk, "$ip\n");
				while (!feof($fsk))
				{
					$ipwhois .= fgets($fsk, 1024);
				}
				@fclose($fsk);
			}
			break;
		}
	}

	return $ipwhois;
}

/**
* Data validation ... used primarily but not exclusively by ucp modules
*
* "Master" function for validating a range of data types
*/
function validate_data($data, $val_ary)
{
	$error = array();

	foreach ($val_ary as $var => $val_seq)
	{
		if (!is_array($val_seq[0]))
		{
			$val_seq = array($val_seq);
		}

		foreach ($val_seq as $validate)
		{
			$function = array_shift($validate);
			array_unshift($validate, $data[$var]);

			if ($result = call_user_func_array('validate_' . $function, $validate))
			{
				$error[] = $result . '_' . strtoupper($var);
			}
		}
	}

	return $error;
}

/**
* Validate String
*/
function validate_string($string, $optional = false, $min = 0, $max = 0)
{
	if (empty($string) && $optional)
	{
		return false;
	}

	if ($min && strlen($string) < $min)
	{
		return 'TOO_SHORT';
	}
	else if ($max && strlen($string) > $max)
	{
		return 'TOO_LONG';
	}

	return false;
}

/**
* Validate Number
*/
function validate_num($num, $optional = false, $min = 0, $max = 1E99)
{
	if (empty($num) && $optional)
	{
		return false;
	}

	if ($num < $min)
	{
		return 'TOO_SMALL';
	}
	else if ($num > $max)
	{
		return 'TOO_LARGE';
	}

	return false;
}

/**
* Validate Match
*/
function validate_match($string, $optional = false, $match)
{
	if (empty($string) && $optional)
	{
		return false;
	}

	if (!preg_match($match, $string))
	{
		return 'WRONG_DATA';
	}

	return false;
}

/**
* Check to see if the username has been taken, or if it is disallowed.
* Also checks if it includes the " character, which we don't allow in usernames.
* Used for registering, changing names, and posting anonymously with a username
*/
function validate_username($username)
{
	global $config, $db, $user;

	if (strtolower($user->data['username']) == strtolower($username))
	{
		return false;
	}

	if (!preg_match('#^' . str_replace('\\\\', '\\', $config['allow_name_chars']) . '$#i', $username))
	{
		return 'INVALID_CHARS';
	}

	$sql = 'SELECT username
		FROM ' . USERS_TABLE . "
		WHERE LOWER(username) = '" . strtolower($db->sql_escape($username)) . "'";
	$result = $db->sql_query($sql);
	$row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);

	if ($row)
	{
		return 'USERNAME_TAKEN';
	}

	$sql = 'SELECT group_name
		FROM ' . GROUPS_TABLE . "
		WHERE LOWER(group_name) = '" . strtolower($db->sql_escape($username)) . "'";
	$result = $db->sql_query($sql);
	$row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);

	if ($row)
	{
		return 'USERNAME_TAKEN';
	}

	$sql = 'SELECT disallow_username
		FROM ' . DISALLOW_TABLE;
	$result = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($result))
	{
		if (preg_match('#^' . str_replace('%', '.*?', preg_quote($row['disallow_username'], '$#')) . '#i', $username))
		{
			$db->sql_freeresult($result);
			return 'USERNAME_DISALLOWED';
		}
	}
	$db->sql_freeresult($result);

	$sql = 'SELECT word
		FROM  ' . WORDS_TABLE;
	$result = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($result))
	{
		if (preg_match('#(' . str_replace('\*', '.*?', preg_quote($row['word'], '#')) . ')#i', $username))
		{
			$db->sql_freeresult($result);
			return 'USERNAME_DISALLOWED';
		}
	}
	$db->sql_freeresult($result);

	return false;
}

/**
* Check to see if email address is banned or already present in the DB
*/
function validate_email($email)
{
	global $config, $db, $user;

	if (strtolower($user->data['user_email']) == strtolower($email))
	{
		return false;
	}

	if (!preg_match('#^[a-z0-9\.\-_\+]+?@(.*?\.)*?[a-z0-9\-_]+?\.[a-z]{2,4}$#i', $email))
	{
		return 'EMAIL_INVALID';
	}

	if ($user->check_ban('', '', $email, true) == true)
	{
		return 'EMAIL_BANNED';
	}

	if (!$config['allow_emailreuse'])
	{
		$sql = 'SELECT user_email_hash
			FROM ' . USERS_TABLE . "
			WHERE user_email_hash = " . crc32(strtolower($email)) . strlen($email);
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

		if ($row)
		{
			return 'EMAIL_TAKEN';
		}
	}

	return false;
}

/**
* Remove avatar
*/
function avatar_delete($id)
{
	global $phpbb_root_path, $config, $db, $user;

	if (file_exists($phpbb_root_path . $config['avatar_path'] . '/' . basename($id)))
	{
		@unlink($phpbb_root_path . $config['avatar_path'] . '/' . basename($id));
	}

	return false;
}

/**
* Remote avatar linkage
*/
function avatar_remote($data, &$error)
{
	global $config, $db, $user, $phpbb_root_path;

	if (!preg_match('#^(http|https|ftp)://#i', $data['remotelink']))
	{
		$data['remotelink'] = 'http://' . $data['remotelink'];
	}

	if (!preg_match('#^(http|https|ftp)://(.*?\.)*?[a-z0-9\-]+?\.[a-z]{2,4}:?([0-9]*?).*?\.(gif|jpg|jpeg|png)$#i', $data['remotelink']))
	{
		$error[] = $user->lang['AVATAR_URL_INVALID'];
		return false;
	}

	// Make sure getimagesize works...
	if (($image_data = @getimagesize($data['remotelink'])) === false)
	{
		$error[] = $user->lang['AVATAR_URL_INVALID'];
		return false;
	}

	$width = ($data['width'] && $data['height']) ? $data['width'] : $image_data[0];
	$height = ($data['width'] && $data['height']) ? $data['height'] : $image_data[1];

	if (!$width || !$height)
	{
		$error[] = $user->lang['AVATAR_NO_SIZE'];
		return false;
	}

	if ($config['avatar_max_width'] || $config['avatar_max_height'])
	{
		if ($width > $config['avatar_max_width'] || $height > $config['avatar_max_height'])
		{
			$error[] = sprintf($user->lang['AVATAR_WRONG_SIZE'], $config['avatar_min_width'], $config['avatar_min_height'], $config['avatar_max_width'], $config['avatar_max_height'], $width, $height);
			return false;
		}
	}

	if ($config['avatar_min_width'] || $config['avatar_min_height'])
	{
		if ($width < $config['avatar_min_width'] || $height < $config['avatar_min_height'])
		{
			$error[] = sprintf($user->lang['AVATAR_WRONG_SIZE'], $config['avatar_min_width'], $config['avatar_min_height'], $config['avatar_max_width'], $config['avatar_max_height'], $width, $height);
			return false;
		}
	}

	return array(AVATAR_REMOTE, $data['remotelink'], $width, $height);
}

/**
* Avatar upload using the upload class
*/
function avatar_upload($data, &$error)
{
	global $phpbb_root_path, $config, $db, $user, $phpEx;

	// Init upload class
	include_once($phpbb_root_path . 'includes/functions_upload.' . $phpEx);
	$upload = new fileupload('AVATAR_', array('jpg', 'jpeg', 'gif', 'png'), $config['avatar_filesize'], $config['avatar_min_width'], $config['avatar_min_height'], $config['avatar_max_width'], $config['avatar_max_height']);

	if (!empty($_FILES['uploadfile']['name']))
	{
		$file = $upload->form_upload('uploadfile');
	}
	else
	{
		$file = $upload->remote_upload($data['uploadurl']);
	}

	$file->clean_filename('real', $data['user_id'] . '_');
	$file->move_file($config['avatar_path']);

	if (sizeof($file->error))
	{
		$file->remove();
		$error = array_merge($error, $file->error);
	}

	return array(AVATAR_UPLOAD, $file->get('realname'), $file->get('width'), $file->get('height'));
}

/**
* Avatar Gallery
*/
function avatar_gallery($category, $avatar_select, $items_per_column, $block_var = 'avatar_row')
{
	global $user, $cache, $template;
	global $config, $phpbb_root_path;

	$avatar_list = array();

	$path = $phpbb_root_path . $config['avatar_gallery_path'];

	if (!file_exists($path) || !is_dir($path))
	{
		$avatar_list = array($user->lang['NONE'] => array());
	}
	else
	{
		// Collect images
		$dp = @opendir($path);

		while (($file = readdir($dp)) !== false)
		{
			if ($file{0} != '.' && is_dir("$path/$file"))
			{
				$avatar_row_count = $avatar_col_count = 0;
	
				$dp2 = @opendir("$path/$file");
				while (($sub_file = readdir($dp2)) !== false)
				{
					if (preg_match('#\.(?:gif|png|jpe?g)$#i', $sub_file))
					{
						$avatar_list[$file][$avatar_row_count][$avatar_col_count] = array(
							'file'		=> "$file/$sub_file",
							'filename'	=> $sub_file,
							'name'		=> ucfirst(str_replace('_', ' ', preg_replace('#^(.*)\..*$#', '\1', $sub_file))),
						);

						$avatar_col_count++;
						if ($avatar_col_count == $items_per_column)
						{
							$avatar_row_count++;
							$avatar_col_count = 0;
						}
					}
				}
				closedir($dp2);
			}
		}
		closedir($dp);
	}

	if (!sizeof($avatar_list))
	{
		$avatar_list = array($user->lang['NONE'] => array());
	}

	@ksort($avatar_list);

	$category = (!$category) ? key($avatar_list) : $category;
	$avatar_categories = array_keys($avatar_list);

	$s_category_options = '';
	foreach ($avatar_categories as $cat)
	{
		$s_category_options .= '<option value="' . $cat . '"' . (($cat == $category) ? ' selected="selected"' : '') . '>' . $cat . '</option>';
	}

	$template->assign_vars(array(
		'S_IN_AVATAR_GALLERY'	=> true,
		'S_CAT_OPTIONS'			=> $s_category_options)
	);

	$avatar_list = $avatar_list[$category];

	foreach ($avatar_list as $avatar_row_ary)
	{
		$template->assign_block_vars($block_var, array());

		foreach ($avatar_row_ary as $avatar_col_ary)
		{
			$template->assign_block_vars($block_var . '.avatar_column', array(
				'AVATAR_IMAGE'	=> $phpbb_root_path . $config['avatar_gallery_path'] . '/' . $avatar_col_ary['file'],
				'AVATAR_NAME'	=> $avatar_col_ary['name'],
				'AVATAR_FILE'	=> $avatar_col_ary['filename'])
			);

			$template->assign_block_vars($block_var . '.avatar_option_column', array(
				'AVATAR_IMAGE'	=> $phpbb_root_path . $config['avatar_gallery_path'] . '/' . $avatar_col_ary['file'],
				'S_OPTIONS_AVATAR'	=> $avatar_col_ary['filename'])
			);
		}
	}

	return $avatar_list;
}

//
// Usergroup functions
//

/**
* Add or edit a group. If we're editing a group we only update user
* parameters such as rank, etc. if they are changed
*/
function group_create(&$group_id, $type, $name, $desc, $group_attributes, $allow_desc_bbcode = false, $allow_desc_urls = false, $allow_desc_smilies = false)
{
	global $phpbb_root_path, $config, $db, $user, $file_upload;

	$error = array();
	$attribute_ary = array(
		'group_colour'			=> 'string',
		'group_rank'			=> 'int',
		'group_avatar'			=> 'string',
		'group_avatar_type'		=> 'int',
		'group_avatar_width'	=> 'int',
		'group_avatar_height'	=> 'int',

		'group_receive_pm'		=> 'int',
		'group_legend'			=> 'int',
		'group_message_limit'	=> 'int',
	);

	// Those are group-only attributes
	$group_only_ary = array('group_receive_pm', 'group_legend', 'group_message_limit');

	// Check data
	if (!strlen($name) || strlen($name) > 40)
	{
		$error[] = (!strlen($name)) ? $user->lang['GROUP_ERR_USERNAME'] : $user->lang['GROUP_ERR_USER_LONG'];
	}

	if (strlen($desc) > 255)
	{
		$error[] = $user->lang['GROUP_ERR_DESC_LONG'];
	}

	if (!in_array($type, array(GROUP_OPEN, GROUP_CLOSED, GROUP_HIDDEN, GROUP_SPECIAL, GROUP_FREE)))
	{
		$error[] = $user->lang['GROUP_ERR_TYPE'];
	}

	if (!sizeof($error))
	{
		$sql_ary = array(
			'group_name'			=> (string) $name,
			'group_desc'			=> (string) $desc,
			'group_desc_uid'		=> '',
			'group_desc_bitfield'	=> 0,
			'group_type'			=> (int) $type,
		);

		// Parse description
		if ($desc)
		{
			generate_text_for_storage($sql_ary['group_desc'], $sql_ary['group_desc_uid'], $sql_ary['group_desc_bitfield'], $allow_desc_bbcode, $allow_desc_urls, $allow_desc_smilies);
		}

		if (sizeof($group_attributes))
		{
			foreach ($attribute_ary as $attribute => $_type)
			{
				if (isset($group_attributes[$attribute]))
				{
					settype($group_attributes[$attribute], $_type);
					$sql_ary[$attribute] = $group_attributes[$attribute];
				}
			}
		}

		// Setting the log message before we set the group id (if group gets added)
		$log = ($group_id) ? 'LOG_GROUP_UPDATED' : 'LOG_GROUP_CREATED';

		if ($group_id)
		{
			$sql = 'UPDATE ' . GROUPS_TABLE . '
				SET ' . $db->sql_build_array('UPDATE', $sql_ary) . "
				WHERE group_id = $group_id";
		}
		else
		{
			$sql = 'INSERT INTO ' . GROUPS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary);
		}
		$db->sql_query($sql);

		if (!$group_id)
		{
			$group_id = $db->sql_nextid();
		}

		// Set user attributes
		$sql_ary = array();
		if (sizeof($group_attributes))
		{
			foreach ($attribute_ary as $attribute => $_type)
			{
				if (isset($group_attributes[$attribute]) && !in_array($attribute, $group_only_ary))
				{
					// If we are about to set an avatar, we will not overwrite user avatars if no group avatar is set...
					if (strpos($attribute, 'group_avatar') === 0 && !$group_attributes[$attribute])
					{
						continue;
					}

					$sql_ary[str_replace('group', 'user', $attribute)] = $group_attributes[$attribute];
				}
			}
		}

		if (sizeof($sql_ary))
		{
			// Before we update the user attributes, we will make a list of those having now the group avatar assigned
			if (in_array('user_avatar', array_keys($sql_ary)))
			{
				// Ok, get the original avatar data from users having an uploaded one (we need to remove these from the filesystem)
				$sql = 'SELECT user_id, user_avatar
					FROM ' . USERS_TABLE . '
					WHERE group_id = ' . $group_id . '
						AND user_avatar_type = ' . AVATAR_UPLOAD;
				$result = $db->sql_query($sql);

				while ($row = $db->sql_fetchrow($result))
				{
					avatar_delete($row['user_avatar']);
				}
				$db->sql_freeresult($result);
			}

			$sql = 'UPDATE ' . USERS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . "
				WHERE group_id = $group_id";
			$db->sql_query($sql);
		}

		$name = ($type == GROUP_SPECIAL) ? $user->lang['G_' . $name] : $name;
		add_log('admin', $log, $name);
	}

	return (sizeof($error)) ? $error : false;
}

/**
* Group Delete
*/
function group_delete($group_id, $group_name = false)
{
	global $db;

	if (!$group_name)
	{
		$group_name = get_group_name($group_id);
	}

	$start = 0;

	do
	{
		$user_id_ary = $username_ary = array();

		// Batch query for group members, call group_user_del
		$sql = 'SELECT u.user_id, u.username
			FROM ' . USER_GROUP_TABLE . ' ug, ' . USERS_TABLE . " u
			WHERE ug.group_id = $group_id
				AND u.user_id = ug.user_id";
		$result = $db->sql_query_limit($sql, 200, $start);

		if ($row = $db->sql_fetchrow($result))
		{
			do
			{
				$user_id_ary[] = $row['user_id'];
				$username_ary[] = $row['username'];

				$start++;
			}
			while ($row = $db->sql_fetchrow($result));

			group_user_del($group_id, $user_id_ary, $username_ary, $group_name);
		}
		else
		{
			$start = 0;
		}
		$db->sql_freeresult($result);
	}
	while ($start);

	// Delete group
	$sql = 'DELETE FROM ' . GROUPS_TABLE . "
		WHERE group_id = $group_id";
	$db->sql_query($sql);

	// Delete auth entries from the groups table
	$sql = 'DELETE FROM ' . ACL_GROUPS_TABLE . "
		WHERE group_id = $group_id";
	$db->sql_query($sql);

	add_log('admin', 'LOG_GROUP_DELETE', $group_name);

	return 'GROUP_DELETED';
}

/**
* Add user(s) to group
*/
function group_user_add($group_id, $user_id_ary = false, $username_ary = false, $group_name = false, $default = false, $leader = 0, $pending = 0, $group_attributes = false)
{
	global $db, $auth;

	// We need both username and user_id info
	user_get_id_name($user_id_ary, $username_ary);

	if (!sizeof($user_id_ary))
	{
		return 'NO_USER';
	}

	// Remove users who are already members of this group
	$sql = 'SELECT user_id, group_leader
		FROM ' . USER_GROUP_TABLE . '
		WHERE user_id IN (' . implode(', ', $user_id_ary) . ")
			AND group_id = $group_id";
	$result = $db->sql_query($sql);

	$add_id_ary = $update_id_ary = array();
	while ($row = $db->sql_fetchrow($result))
	{
		$add_id_ary[] = $row['user_id'];

		if ($leader && !$row['group_leader'])
		{
			$update_id_ary[] = $row['user_id'];
		}
	}
	$db->sql_freeresult($result);

	// Do all the users exist in this group?
	$add_id_ary = array_diff($user_id_ary, $add_id_ary);

	// If we have no users
	if (!sizeof($add_id_ary) && !sizeof($update_id_ary))
	{
		return 'GROUP_USERS_EXIST';
	}

	if (sizeof($add_id_ary))
	{
		// Insert the new users
		switch (SQL_LAYER)
		{
			case 'mysql':
			case 'mysql4':
			case 'mysqli':
			case 'mssql':
			case 'mssql_odbc':
			case 'sqlite':
				$sql = 'INSERT INTO ' . USER_GROUP_TABLE . " (user_id, group_id, group_leader, user_pending)
					VALUES " . implode(', ', preg_replace('#^([0-9]+)$#', "(\\1, $group_id, $leader, $pending)",  $add_id_ary));
				$db->sql_query($sql);
			break;

			default:
				foreach ($add_id_ary as $user_id)
				{
					$sql = 'INSERT INTO ' . USER_GROUP_TABLE . " (user_id, group_id, group_leader, user_pending)
						VALUES ($user_id, $group_id, $leader, $pending)";
					$db->sql_query($sql);
				}
			break;
		}
	}

	if (sizeof($update_id_ary))
	{
		$sql = 'UPDATE ' . USER_GROUP_TABLE . '
			SET group_leader = 1
			WHERE user_id IN (' . implode(', ', $update_id_ary) . ")
				AND group_id = $group_id";
		$db->sql_query($sql);
	}

	if ($default)
	{
		group_set_user_default($group_id, $user_id_ary, $group_attributes);
	}

	// Clear permissions cache of relevant users
	$auth->acl_clear_prefetch($user_id_ary);

	if (!$group_name)
	{
		$group_name = get_group_name($group_id);
	}

	$log = ($leader) ? 'LOG_MODS_ADDED' : 'LOG_USERS_ADDED';

	add_log('admin', $log, $group_name, implode(', ', $username_ary));

	return ($leader) ? 'GROUP_LEADERS_ADDED' : 'GROUP_USERS_ADDED';
}

/**
* Remove a user/s from a given group. When we remove users we update their
* default group_id. We do this by examining which "special" groups they belong
* to. The selection is made based on a reasonable priority system
*/
function group_user_del($group_id, $user_id_ary = false, $username_ary = false, $group_name = false)
{
	global $db, $auth;

	$group_order = array('ADMINISTRATORS', 'GLOBAL_MODERATORS', 'REGISTERED_COPPA', 'REGISTERED', 'BOTS', 'GUESTS');

	// We need both username and user_id info
	user_get_id_name($user_id_ary, $username_ary);

	if (!sizeof($user_id_ary))
	{
		return 'NO_USER';
	}

	$sql = 'SELECT *
		FROM ' . GROUPS_TABLE . '
		WHERE group_name IN (' . implode(', ', preg_replace('#^(.*)$#', "'\\1'", $group_order)) . ')';
	$result = $db->sql_query($sql);

	$group_order_id = $special_group_data = array();
	while ($row = $db->sql_fetchrow($result))
	{
		$group_order_id[$row['group_name']] = $row['group_id'];

		$special_group_data[$row['group_id']] = array(
			'user_colour'			=> $row['group_colour'],
			'user_rank'				=> $row['group_rank'],
		);

		// Only set the group avatar if one is defined...
		if ($row['group_avatar'])
		{
			$special_group_data[$row['group_id']] = array_merge($special_group_data[$row['group_id']], array(
				'user_avatar'			=> $row['group_avatar'],
				'user_avatar_type'		=> $row['group_avatar_type'],
				'user_avatar_width'		=> $row['group_avatar_width'],
				'user_avatar_height'	=> $row['group_avatar_height'])
			);
		}
	}
	$db->sql_freeresult($result);

	// Get users default groups - we only need to reset default group membership if the group from which the user gets removed is set as default
	$sql = 'SELECT user_id, group_id
		FROM ' . USERS_TABLE . '
		WHERE user_id IN (' . implode(', ', $user_id_ary) . ")";
	$result = $db->sql_query($sql);

	$default_groups = array();
	while ($row = $db->sql_fetchrow($result))
	{
		$default_groups[$row['user_id']] = $row['group_id'];
	}
	$db->sql_freeresult($result);

	// What special group memberships exist for these users?
	$sql = 'SELECT g.group_id, g.group_name, ug.user_id
		FROM ' . USER_GROUP_TABLE . ' ug, ' . GROUPS_TABLE . ' g
		WHERE ug.user_id IN (' . implode(', ', $user_id_ary) . ")
			AND g.group_id = ug.group_id
			AND g.group_id <> $group_id
			AND g.group_type = " . GROUP_SPECIAL . '
		ORDER BY ug.user_id, g.group_id';
	$result = $db->sql_query($sql);

	$temp_ary = array();
	while ($row = $db->sql_fetchrow($result))
	{
		if ($default_groups[$row['user_id']] == $group_id && (!isset($temp_ary[$row['user_id']]) || array_search($row['group_name'], $group_order) < $temp_ary[$row['user_id']]))
		{
			$temp_ary[$row['user_id']] = $row['group_id'];
		}
	}
	$db->sql_freeresult($result);

	$sql_where_ary = array();
	foreach ($temp_ary as $uid => $gid)
	{
		$sql_where_ary[$gid][] = $uid;
	}
	unset($temp_ary);

	foreach ($special_group_data as $gid => $default_data_ary)
	{
		if (isset($sql_where_ary[$gid]) && sizeof($sql_where_ary[$gid]))
		{
			$special_group_data[$gid]['group_id'] = $gid;

			// Before we update the user attributes, we will make a list of those having now the group avatar assigned
			if (in_array('user_avatar', array_keys($special_group_data[$gid])))
			{
				// Ok, get the original avatar data from users having an uploaded one (we need to remove these from the filesystem)
				$sql = 'SELECT user_id, user_avatar
					FROM ' . USERS_TABLE . '
					WHERE user_id IN (' . implode(', ', $sql_where_ary[$gid]) . ')
						AND user_avatar_type = ' . AVATAR_UPLOAD;
				$result = $db->sql_query($sql);

				while ($row = $db->sql_fetchrow($result))
				{
					avatar_delete($row['user_avatar']);
				}
				$db->sql_freeresult($result);
			}

			$sql = 'UPDATE ' . USERS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $special_group_data[$gid]) . '
				WHERE user_id IN (' . implode(', ', $sql_where_ary[$gid]) . ')';
			$db->sql_query($sql);
		}
	}
	unset($special_group_data);

	$sql = 'DELETE FROM ' . USER_GROUP_TABLE . "
		WHERE group_id = $group_id
			AND user_id IN (" . implode(', ', $user_id_ary) . ')';
	$db->sql_query($sql);

	// Clear permissions cache of relevant users
	$auth->acl_clear_prefetch($user_id_ary);

	if (!$group_name)
	{
		$group_name = get_group_name($group_id);
	}

	$log = 'LOG_GROUP_REMOVE';

	add_log('admin', $log, $group_name, implode(', ', $username_ary));

	return 'GROUP_USERS_REMOVE';
}

/**
* This is used to promote (to leader), demote or set as default a member/s
*/
function group_user_attributes($action, $group_id, $user_id_ary = false, $username_ary = false, $group_name = false, $group_attributes = false)
{
	global $db, $auth, $phpbb_root_path, $phpEx, $config;

	// We need both username and user_id info
	user_get_id_name($user_id_ary, $username_ary);

	if (!sizeof($user_id_ary))
	{
		return false;
	}

	if (!$group_name)
	{
		$group_name = get_group_name($group_id);
	}

	switch ($action)
	{
		case 'demote':
		case 'promote':
			$sql = 'UPDATE ' . USER_GROUP_TABLE . '
				SET group_leader = ' . (($action == 'promote') ? 1 : 0) . "
				WHERE group_id = $group_id
					AND user_id IN (" . implode(', ', $user_id_ary) . ')';
			$db->sql_query($sql);

			$log = ($action == 'promote') ? 'LOG_GROUP_PROMOTED' : 'LOG_GROUP_DEMOTED';
		break;

		case 'approve':
			// Make sure we only approve those which are pending ;)
			$sql = 'SELECT u.user_id, u.user_email, u.username, u.user_notify_type, u.user_jabber, u.user_lang
				FROM ' . USERS_TABLE . ' u, ' . USER_GROUP_TABLE . ' ug
				WHERE ug.group_id = ' . $group_id . '
					AND ug.user_pending = 1
					AND ug.user_id = u.user_id
					AND ug.user_id IN (' . implode(', ', $user_id_ary) . ')';
			$result = $db->sql_query($sql);

			$user_id_ary = $email_users = array();
			while ($row = $db->sql_fetchrow($result))
			{
				$user_id_ary[] = $row['user_id'];
				$email_users[] = $row;
			}
			$db->sql_freeresult($result);

			if (!sizeof($user_id_ary))
			{
				return false;
			}

			$sql = 'UPDATE ' . USER_GROUP_TABLE . "
				SET user_pending = 0
				WHERE group_id = $group_id
					AND user_id IN (" . implode(', ', $user_id_ary) . ')';
			$db->sql_query($sql);

			// Send approved email to users...
			include_once($phpbb_root_path . 'includes/functions_messenger.' . $phpEx);
			$messenger = new messenger();

			$email_sig = str_replace('<br />', "\n", "-- \n" . $config['board_email_sig']);

			foreach ($email_users as $row)
			{
				$messenger->template('group_approved', $row['user_lang']);

				$messenger->replyto($config['board_email']);
				$messenger->to($row['user_email'], $row['username']);
				$messenger->im($row['user_jabber'], $row['username']);

				$messenger->assign_vars(array(
					'EMAIL_SIG'		=> $email_sig,
					'SITENAME'		=> $config['sitename'],
					'USERNAME'		=> html_entity_decode($row['username']),
					'GROUP_NAME'	=> html_entity_decode($group_name),

					'U_GROUP'		=> generate_board_url() . "/ucp.$phpEx?i=groups&mode=membership")
				);

				$messenger->send($row['user_notify_type']);
				$messenger->reset();
			}

			$messenger->save_queue();

			$log = 'LOG_USERS_APPROVED';
		break;

		case 'default':
			group_set_user_default($group_id, $user_id_ary, $group_attributes);
			$log = 'LOG_GROUP_DEFAULTS';
		break;
	}

	// Clear permissions cache of relevant users
	$auth->acl_clear_prefetch($user_id_ary);

	add_log('admin', $log, $group_name, implode(', ', $username_ary));

	return true;
}

/**
* Set users default group
*/
function group_set_user_default($group_id, $user_id_ary, $group_attributes = false)
{
	global $db;

	if (!$user_id_ary)
	{
		return;
	}

	$attribute_ary = array(
		'group_colour'			=> 'string',
		'group_rank'			=> 'int',
		'group_avatar'			=> 'string',
		'group_avatar_type'		=> 'int',
		'group_avatar_width'	=> 'int',
		'group_avatar_height'	=> 'int',
	);

	$sql_ary = array(
		'group_id'		=> $group_id
	);

	// Were group attributes passed to the function? If not we need to obtain them
	if ($group_attributes === false)
	{
		$sql = 'SELECT ' . implode(', ', array_keys($attribute_ary)) . '
			FROM ' . GROUPS_TABLE . "
			WHERE group_id = $group_id";
		$result = $db->sql_query($sql);
		$group_attributes = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);
	}

	foreach ($attribute_ary as $attribute => $type)
	{
		if (isset($group_attributes[$attribute]))
		{
			// If we are about to set an avatar, we will not overwrite user avatars if no group avatar is set...
			if (strpos($attribute, 'group_avatar') === 0 && !$group_attributes[$attribute])
			{
				continue;
			}

			settype($group_attributes[$attribute], $type);
			$sql_ary[str_replace('group_', 'user_', $attribute)] = $group_attributes[$attribute];
		}
	}

	// Before we update the user attributes, we will make a list of those having now the group avatar assigned
	if (in_array('user_avatar', array_keys($sql_ary)))
	{
		// Ok, get the original avatar data from users having an uploaded one (we need to remove these from the filesystem)
		$sql = 'SELECT user_id, user_avatar
			FROM ' . USERS_TABLE . '
			WHERE user_id IN (' . implode(', ', $user_id_ary) . ')
				AND user_avatar_type = ' . AVATAR_UPLOAD;
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			avatar_delete($row['user_avatar']);
		}
		$db->sql_freeresult($result);
	}

	$sql = 'UPDATE ' . USERS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . '
		WHERE user_id IN (' . implode(', ', $user_id_ary) . ')';
	$db->sql_query($sql);
}

/**
* Get group name
*/
function get_group_name($group_id)
{
	global $db, $user;

	$sql = 'SELECT group_name, group_type
		FROM ' . GROUPS_TABLE . '
		WHERE group_id = ' . (int) $group_id;
	$result = $db->sql_query($sql);
	$row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);

	if (!$row)
	{
		return '';
	}

	return ($row['group_type'] == GROUP_SPECIAL) ? $user->lang['G_' . $row['group_name']] : $row['group_name'];
}

/**
* Obtain either the members of a specified group, the groups the specified user is subscribed to
* or checking if a specified user is in a specified group
*
* Note: Never use this more than once... first group your users/groups
*/
function group_memberships($group_id_ary = false, $user_id_ary = false, $return_bool = false)
{
	global $db;

	if (!$group_id_ary && !$user_id_ary)
	{
		return true;
	}

	$sql = 'SELECT ug.*, u.username, u.user_email
		FROM ' . USER_GROUP_TABLE . ' ug, ' . USERS_TABLE . ' u
		WHERE ug.user_id = u.user_id AND ';

	if ($group_id_ary && $user_id_ary)
	{
		$sql .= " ug.group_id " . ((is_array($group_id_ary)) ? ' IN (' . implode(', ', $group_id_ary) . ')' : " = $group_id_ary") . "
				AND ug.user_id " . ((is_array($user_id_ary)) ? ' IN (' . implode(', ', $user_id_ary) . ')' : " = $user_id_ary");
	}
	else if ($group_id_ary)
	{
		$sql .= " ug.group_id " . ((is_array($group_id_ary)) ? ' IN (' . implode(', ', $group_id_ary) . ')' : " = $group_id_ary");
	}
	else if ($user_id_ary)
	{
		$sql .= " ug.user_id " . ((is_array($user_id_ary)) ? ' IN (' . implode(', ', $user_id_ary) . ')' : " = $user_id_ary");
	}

	$result = ($return_bool) ? $db->sql_query_limit($sql, 1) : $db->sql_query($sql);

	$row = $db->sql_fetchrow($result);

	if ($return_bool)
	{
		$db->sql_freeresult($result);
		return ($row) ? true : false;
	}

	if (!$row)
	{
		return false;
	}

	$return = array();

	do
	{
		$return[] = $row;
	}
	while ($row = $db->sql_fetchrow($result));

	$db->sql_freeresult($result);

	return $return;
}

?>