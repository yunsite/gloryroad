<?php
/** 
*
* @package phpBB3
* @version $Id: memberlist.php,v 1.156 2006/06/17 11:28:21 acydburn Exp $
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

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup(array('memberlist', 'groups'));

// Grab data
$mode		= request_var('mode', '');
$action		= request_var('action', '');
$user_id	= request_var('u', ANONYMOUS);
$group_id	= request_var('g', 0);
$topic_id	= request_var('t', 0);

switch ($mode)
{
	case 'email':
	break;

	default:
		// Can this user view profiles/memberlist?
		if (!$auth->acl_gets('u_viewprofile', 'a_user', 'a_useradd', 'a_userdel'))
		{
			if ($user->data['user_id'] != ANONYMOUS)
			{
				trigger_error('NO_VIEW_USERS');
			}

			login_box('', ((isset($user->lang['LOGIN_EXPLAIN_' . strtoupper($mode)])) ? $user->lang['LOGIN_EXPLAIN_' . strtoupper($mode)] : $user->lang['LOGIN_EXPLAIN_MEMBERLIST']));
		}
	break;
}


$start	= request_var('start', 0);
$submit = (isset($_POST['submit'])) ? true : false;

$sort_key = request_var('sk', 'c');
$sort_dir = request_var('sd', 'a');


// Grab rank information for later
$ranks = array();
$cache->obtain_ranks($ranks);


// What do you want to do today? ... oops, I think that line is taken ...
switch ($mode)
{
	case 'leaders':
		// Display a listing of board admins, moderators
		$user->add_lang('groups');
		
		$page_title = $user->lang['THE_TEAM'];
		$template_html = 'memberlist_leaders.html';

		$user_ary = $auth->acl_get_list(false, array('a_', 'm_'), false);

		$admin_id_ary = $mod_id_ary = $forum_id_ary = array();
		foreach ($user_ary as $forum_id => $forum_ary)
		{
			foreach ($forum_ary as $auth_option => $id_ary)
			{
				if (!$forum_id && $auth_option == 'a_')
				{
					$admin_id_ary = array_merge($admin_id_ary, $id_ary);
					continue;
				}
				else
				{
					$mod_id_ary = array_merge($mod_id_ary, $id_ary);
				}

				if ($forum_id)
				{
					foreach ($id_ary as $id)
					{
						$forum_id_ary[$id][] = $forum_id;
					}
				}
			}
		}

		$admin_id_ary = array_unique($admin_id_ary);
		$mod_id_ary = array_unique($mod_id_ary);

		$sql = 'SELECT forum_id, forum_name 
			FROM ' . FORUMS_TABLE . '
			WHERE forum_type = ' . FORUM_POST;
		$result = $db->sql_query($sql);
		
		$forums = array();
		while ($row = $db->sql_fetchrow($result))
		{
			$forums[$row['forum_id']] = $row['forum_name'];
		}
		$db->sql_freeresult($result);

		$sql = $db->sql_build_query('SELECT', array(
			'SELECT'	=> 'u.user_id, u.username, u.user_colour, u.user_rank, u.user_posts, g.group_id, g.group_name, g.group_colour, g.group_type, ug.user_id as ug_user_id',

			'FROM'		=> array(
				USERS_TABLE		=> 'u',
				GROUPS_TABLE	=> 'g'
			),

			'LEFT_JOIN'	=> array(
				array(
					'FROM'	=> array(USER_GROUP_TABLE => 'ug'),
					'ON'	=> 'ug.group_id = g.group_id AND ug.user_pending = 0 AND ug.user_id = ' . $user->data['user_id']
				)
			),

			'WHERE'		=> 'u.user_id IN (' . implode(', ', array_unique(array_merge($admin_id_ary, $mod_id_ary))) . ')
				AND u.group_id = g.group_id',

			'ORDER_BY'	=> 'g.group_name ASC, u.username ASC'
		));

		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			$which_row = (in_array($row['user_id'], $admin_id_ary)) ? 'admin' : 'mod';

			$s_forum_select = '';

			if (isset($forum_id_ary[$row['user_id']]))
			{
				if ($which_row == 'mod' && sizeof(array_diff(array_keys($forums), $forum_id_ary[$row['user_id']])))
				{
					foreach ($forum_id_ary[$row['user_id']] as $forum_id)
					{
						if (isset($forums[$forum_id]) && $auth->acl_get('f_list', $forum_id))
						{
							$s_forum_select .= '<option value="">' . $forums[$forum_id] . '</option>';
						}
					}
				}
			}

			if ($row['group_type'] == GROUP_HIDDEN && !$auth->acl_gets('a_group', 'a_groupadd', 'a_groupdel') && $row['ug_user_id'] != $user->data['user_id'])
			{
				$group_name = $user->lang['GROUP_UNDISCLOSED'];
				$u_group = '';
			}
			else
			{
				$group_name = ($row['group_type'] == GROUP_SPECIAL) ? $user->lang['G_' . $row['group_name']] : $row['group_name'];
				$u_group = append_sid("{$phpbb_root_path}memberlist.$phpEx", 'mode=group&amp;g=' . $row['group_id']);
			}

			$rank_title = $rank_img = '';
			get_user_rank($row['user_rank'], $row['user_posts'], $rank_title, $rank_img, $rank_img_src);

			$template->assign_block_vars($which_row, array(
				'USER_ID'		=> $row['user_id'],
				'FORUMS'		=> $s_forum_select,
				'USERNAME'		=> $row['username'],
				'USER_COLOR'	=> $row['user_colour'],
				'RANK_TITLE'	=> $rank_title,
				'GROUP_NAME'	=> $group_name,
				'GROUP_COLOR'	=> $row['group_colour'],

				'RANK_IMG'		=> $rank_img,
				'RANK_IMG_SRC'	=> $rank_img_src,

				'U_GROUP'		=> $u_group,
				'U_VIEWPROFILE'	=> append_sid("{$phpbb_root_path}memberlist.$phpEx", 'mode=viewprofile&amp;u=' . $row['user_id']),
				'U_PM'			=> ($auth->acl_get('u_sendpm')) ? append_sid("{$phpbb_root_path}ucp.$phpEx", 'i=pm&amp;mode=compose&amp;u=' . $row['user_id']) : '')
			);
		}
		$db->sql_freeresult($result);

		$template->assign_vars(array(
			'PM_IMG'		=> $user->img('btn_pm', $user->lang['SEND_PRIVATE_MESSAGE']))
		);
	break;

	case 'contact':
		$page_title = $user->lang['IM_USER'];
		$template_html = 'memberlist_im.html';

		$presence_img = '';
		switch ($action)
		{
			case 'icq':
				$lang = 'ICQ';
				$sql_field = 'user_icq';
				$s_select = 'S_SEND_ICQ';
				$s_action = 'http://wwp.icq.com/scripts/WWPMsg.dll';
			break;

			case 'aim':
				$lang = 'AIM';
				$sql_field = 'user_aim';
				$s_select = 'S_SEND_AIM';
				$s_action = '';
			break;

			case 'msnm':
				$lang = 'MSNM';
				$sql_field = 'user_msnm';
				$s_select = 'S_SEND_MSNM';
				$s_action = '';
			break;

			case 'jabber':
				$lang = 'JABBER';
				$sql_field = 'user_jabber';
				$s_select = (@extension_loaded('xml') && $config['jab_enable']) ? 'S_SEND_JABBER' : 'S_NO_SEND_JABBER';
				$s_action = append_sid("{$phpbb_root_path}memberlist.$phpEx", "mode=contact&amp;action=$action&amp;u=$user_id");
			break;

			default:
				$sql_field = '';
			break;
		}

		// Grab relevant data
		$sql = "SELECT user_id, username, user_email, user_lang, $sql_field
			FROM " . USERS_TABLE . "
			WHERE user_id = $user_id
				AND user_type IN (" . USER_NORMAL . ', ' . USER_FOUNDER . ')';
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

		if (!$row)
		{
			trigger_error('NO_USER_DATA');
		}

		// Post data grab actions
		switch ($action)
		{
			case 'icq':
				$presence_img = '<img src="http://web.icq.com/whitepages/online?icq=' . $row[$sql_field] . '&amp;img=5" width="18" height="18" alt="" />';
			break;

			case 'jabber':
				if ($submit && @extension_loaded('xml') && $config['jab_enable'])
				{
					include_once($phpbb_root_path . 'includes/functions_messenger.' . $phpEx);

					$subject = sprintf($user->lang['IM_JABBER_SUBJECT'], $user->data['username'], $config['server_name']);
					$message = request_var('message', '', true);

					$messenger = new messenger(false);

					$messenger->template('profile_send_im', $row['user_lang']);
					$messenger->subject(html_entity_decode($subject));

					$messenger->replyto($user->data['user_email']);
					$messenger->im($row['user_jabber'], $row['username']);

					$messenger->assign_vars(array(
						'SITENAME'		=> $config['sitename'],
						'BOARD_EMAIL'	=> $config['board_contact'],
						'FROM_USERNAME'	=> html_entity_decode($user->data['username']),
						'TO_USERNAME'	=> html_entity_decode($row['username']),
						'MESSAGE'		=> html_entity_decode($message))
					);

					$messenger->send(NOTIFY_IM);

					$s_select = 'S_SENT_JABBER';
				}
			break;
		}

		// Send vars to the template
		$template->assign_vars(array(
			'IM_CONTACT'	=> $row[$sql_field],
			'USERNAME'		=> $row['username'],
			'EMAIL'			=> $row['user_email'],
			'CONTACT_NAME'	=> $row[$sql_field],
			'SITENAME'		=> $config['sitename'],

			'PRESENCE_IMG'		=> $presence_img,

			'L_SEND_IM_EXPLAIN'	=> $user->lang['IM_' . $lang],
			'L_IM_SENT_JABBER'	=> sprintf($user->lang['IM_SENT_JABBER'], $row['username']),

			$s_select			=> true,
			'S_IM_ACTION'		=> $s_action)
		);

	break;

	case 'viewprofile':
		// Display a profile
		if ($user_id == ANONYMOUS)
		{
			trigger_error('NO_USER');
		}

		// Get user...
		$sql = 'SELECT *
			FROM ' . USERS_TABLE . "
			WHERE user_id = $user_id
				AND user_type IN (" . USER_NORMAL . ', ' . USER_FOUNDER . ')';
		$result = $db->sql_query($sql);
		$member = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

		if (!$member)
		{
			trigger_error('NO_USER');
		}

		// Do the SQL thang
		$sql = 'SELECT g.group_id, g.group_name, g.group_type
			FROM ' . GROUPS_TABLE . ' g, ' . USER_GROUP_TABLE . " ug
			WHERE ug.user_id = $user_id
				AND g.group_id = ug.group_id" . ((!$auth->acl_get('a_group')) ? ' AND group_type <> ' . GROUP_HIDDEN : '') . '
			ORDER BY group_type, group_name';
		$result = $db->sql_query($sql);

		$group_options = '';
		while ($row = $db->sql_fetchrow($result))
		{
			$group_options .= '<option value="' . $row['group_id'] . '"' . (($row['group_id'] == $member['group_id']) ? ' selected="selected"' : '') . '>' . (($row['group_type'] == GROUP_SPECIAL) ? $user->lang['G_' . $row['group_name']] : $row['group_name']) . '</option>';
		}

		$sql = 'SELECT MAX(session_time) AS session_time, MIN(session_viewonline) AS session_viewonline
			FROM ' . SESSIONS_TABLE . "
			WHERE session_user_id = $user_id";
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

		$member['session_time'] = (isset($row['session_time'])) ? $row['session_time'] : 0;
		$member['session_viewonline'] = (isset($row['session_viewonline'])) ? $row['session_viewonline'] :	0;
		unset($row);

		if ($config['load_user_activity'])
		{
			if (!function_exists('display_user_activity'))
			{
				include_once($phpbb_root_path . 'includes/functions_display.' . $phpEx);
			}
			display_user_activity($member);
		}

		// Do the relevant calculations
		$memberdays = max(1, round((time() - $member['user_regdate']) / 86400));
		$posts_per_day = $member['user_posts'] / $memberdays;
		$percentage = ($config['num_posts']) ? min(100, ($member['user_posts'] / $config['num_posts']) * 100) : 0;

		if ($member['user_sig_bbcode_bitfield'] && $member['user_sig'])
		{
			include_once($phpbb_root_path . 'includes/bbcode.' . $phpEx);
			$bbcode = new bbcode();
			$bbcode->bbcode_second_pass($member['user_sig'], $member['user_sig_bbcode_uid'], $member['user_sig_bbcode_bitfield']);
		}

		if ($member['user_sig'])
		{
			$member['user_sig'] = censor_text(smiley_text($member['user_sig']));
		}

		$poster_avatar = '';
		if (!empty($member['user_avatar']))
		{
			switch ($member['user_avatar_type'])
			{
				case AVATAR_UPLOAD:
					$poster_avatar = $config['avatar_path'] . '/';
				break;

				case AVATAR_GALLERY:
					$poster_avatar = $config['avatar_gallery_path'] . '/';
				break;
			}
			$poster_avatar .= $member['user_avatar'];

			$poster_avatar = '<img src="' . $poster_avatar . '" width="' . $member['user_avatar_width'] . '" height="' . $member['user_avatar_height'] . '" alt="" />';
		}

		$template->assign_vars(show_profile($member));

		// Custom Profile Fields
		$profile_fields = array();
		if ($config['load_cpf_viewprofile'])
		{
			include_once($phpbb_root_path . 'includes/functions_profile_fields.' . $phpEx);
			$cp = new custom_profile();
			$profile_fields = $cp->generate_profile_fields_template('grab', $user_id);
			$profile_fields = (isset($profile_fields[$user_id])) ? $cp->generate_profile_fields_template('show', false, $profile_fields[$user_id]) : array();
		}

		$template->assign_vars(array(
			'POSTS_DAY'			=> sprintf($user->lang['POST_DAY'], $posts_per_day),
			'POSTS_PCT'			=> sprintf($user->lang['POST_PCT'], $percentage),

			'OCCUPATION'	=> (!empty($member['user_occ'])) ? censor_text($member['user_occ']) : '',
			'INTERESTS'		=> (!empty($member['user_interests'])) ? censor_text($member['user_interests']) : '',
			'SIGNATURE'		=> (!empty($member['user_sig'])) ? str_replace("\n", '<br />', $member['user_sig']) : '',

			'AVATAR_IMG'	=> $poster_avatar,
			'PM_IMG'		=> $user->img('btn_pm', $user->lang['SEND_PRIVATE_MESSAGE']),
			'EMAIL_IMG'		=> $user->img('btn_email', $user->lang['EMAIL']),
			'WWW_IMG'		=> $user->img('btn_www', $user->lang['WWW']),
			'ICQ_IMG'		=> $user->img('btn_icq', $user->lang['ICQ']),
			'AIM_IMG'		=> $user->img('btn_aim', $user->lang['AIM']),
			'MSN_IMG'		=> $user->img('btn_msnm', $user->lang['MSNM']),
			'YIM_IMG'		=> $user->img('btn_yim', $user->lang['YIM']),
			'JABBER_IMG'	=> $user->img('btn_jabber', $user->lang['JABBER']),
			'SEARCH_IMG'	=> $user->img('btn_search', $user->lang['SEARCH']),

			'S_PROFILE_ACTION'	=> append_sid("{$phpbb_root_path}memberlist.$phpEx", 'mode=group'),
			'S_GROUP_OPTIONS'	=> $group_options,
			'S_CUSTOM_FIELDS'	=> (isset($profile_fields['row']) && sizeof($profile_fields['row'])) ? true : false,
			'S_SHOW_ACTIVITY'	=> ($config['load_user_activity']) ? true : false,

			'U_USER_ADMIN'			=> ($auth->acl_get('a_user')) ? append_sid("{$phpbb_root_path}adm/index.$phpEx", 'i=users&amp;mode=overview&amp;u=' . $user_id, true, $user->session_id) : '',
			'U_SWITCH_PERMISSIONS'	=> ($auth->acl_get('a_switchperm') && $user->data['user_id'] != $user_id) ? append_sid("{$phpbb_root_path}ucp.$phpEx", "mode=switch_perm&amp;u={$user_id}") : '',

			'S_ZEBRA'			=> ($user->data['user_id'] != $user_id && $user->data['is_registered']) ? true : false,
			'U_ADD_FRIEND'		=> append_sid("{$phpbb_root_path}ucp.$phpEx", 'i=zebra&amp;add=' . urlencode($member['username'])),
			'U_ADD_FOE'			=> append_sid("{$phpbb_root_path}ucp.$phpEx", 'i=zebra&amp;mode=foes&amp;add=' . urlencode($member['username'])))
		);

		if (!empty($profile_fields['row']))
		{
			$template->assign_vars($profile_fields['row']);
		}

		if (!empty($profile_fields['blockrow']))
		{
			foreach ($profile_fields['blockrow'] as $field_data)
			{
				$template->assign_block_vars('custom_fields', $field_data);
			}
		}

		// Now generate page tilte
		$page_title = sprintf($user->lang['VIEWING_PROFILE'], $member['username']);
		$template_html = 'memberlist_view.html';

	break;

	case 'email':

		// Send an email
		$page_title = $user->lang['SEND_EMAIL'];
		$template_html = 'memberlist_email.html';

		if (!$config['email_enable'])
		{
			trigger_error('EMAIL_DISABLED');
		}

		if (!$auth->acl_get('u_sendemail'))
		{
			trigger_error('NO_EMAIL');
		}

		// Are we trying to abuse the facility?
		if (time() - $user->data['user_emailtime'] < $config['flood_interval'])
		{
			trigger_error('FLOOD_EMAIL_LIMIT');
		}

		// Determine action...
		$user_id = request_var('u', 0);
		$topic_id = request_var('t', 0);

		// Send email to user...
		if ($user_id)
		{
			if ($user_id == ANONYMOUS || !$config['board_email_form'])
			{
				trigger_error('NO_EMAIL');
			}

			// Get the appropriate username, etc.
			$sql = 'SELECT username, user_email, user_allow_viewemail, user_lang, user_jabber, user_notify_type
				FROM ' . USERS_TABLE . "
				WHERE user_id = $user_id
					AND user_type IN (" . USER_NORMAL . ', ' . USER_FOUNDER . ')';
			$result = $db->sql_query($sql);
			$row = $db->sql_fetchrow($result);
			$db->sql_freeresult($result);

			if (!$row)
			{
				trigger_error('NO_USER');
			}

			// Can we send email to this user?
			if (!$row['user_allow_viewemail'] && !$auth->acl_get('a_user'))
			{
				trigger_error('NO_EMAIL');
			}
		}
		else if ($topic_id)
		{
			// Send topic heads-up to email address
			$sql = 'SELECT forum_id, topic_title
				FROM ' . TOPICS_TABLE . "
				WHERE topic_id = $topic_id";
			$result = $db->sql_query($sql);
			$row = $db->sql_fetchrow($result);
			$db->sql_freeresult($result);

			if (!$row)
			{
				trigger_error('NO_TOPIC');
			}

			if ($row['forum_id'])
			{
				if (!$auth->acl_get('f_read', $row['forum_id']))
				{
					trigger_error($user->lang['SORRY_AUTH_READ']);
				}

				if (!$auth->acl_get('f_email', $row['forum_id']))
				{
					trigger_error('NO_EMAIL');
				}
			}
			else
			{
				// If global announcement, we need to check if the user is able to at least read and email in one forum...
				if (!$auth->acl_getf_global('f_read'))
				{
					trigger_error($user->lang['SORRY_AUTH_READ']);
				}

				if (!$auth->acl_getf_global('f_email'))
				{
					trigger_error('NO_EMAIL');
				}
			}
		}
		else
		{
			trigger_error('NO_EMAIL');
		}

		$error = array();

		$name		= request_var('name', '');
		$email		= request_var('email', '');
		$email_lang = request_var('lang', $config['default_lang']);
		$subject	= request_var('subject', '');
		$message	= request_var('message', '');
		$cc			= (isset($_POST['cc_email'])) ? true : false;
		$submit		= (isset($_POST['submit'])) ? true : false;

		if ($submit)
		{
			if ($user_id)
			{
				if (!$subject)
				{
					$error[] = $user->lang['EMPTY_SUBJECT_EMAIL'];
				}

				if (!$message)
				{
					$error[] = $user->lang['EMPTY_MESSAGE_EMAIL'];
				}

				$name = $row['username'];
				$email_lang = $row['user_lang'];
				$email = $row['user_email'];
			}
			else
			{
				if (!$email || !preg_match('#^.*?@(.*?\.)?[a-z0-9\-]+\.[a-z]{2,4}$#i', $email))
				{
					$error[] = $user->lang['EMPTY_ADDRESS_EMAIL'];
				}

				if (!$name)
				{
					$error[] = $user->lang['EMPTY_NAME_EMAIL'];
				}
			}

			if (!sizeof($error))
			{
				$sql = 'UPDATE ' . USERS_TABLE . '
					SET user_emailtime = ' . time() . '
					WHERE user_id = ' . $user->data['user_id'];
				$result = $db->sql_query($sql);

				include_once($phpbb_root_path . 'includes/functions_messenger.' . $phpEx);
				$messenger = new messenger(false);

				$email_tpl = ($user_id) ? 'profile_send_email' : 'email_notify';

				$messenger->template($email_tpl, $email_lang);

				$messenger->replyto($user->data['user_email']);
				$messenger->to($email, $name);

				if ($user_id)
				{
					$messenger->subject(html_entity_decode($subject));
					$messenger->im($row['user_jabber'], $row['username']);
					$notify_type = $row['user_notify_type'];
				}
				else
				{
					$notify_type = NOTIFY_EMAIL;
				}

				if ($cc)
				{
					$messenger->cc($user->data['user_email'], $user->data['username']);
				}

				$messenger->headers('X-AntiAbuse: Board servername - ' . $config['server_name']);
				$messenger->headers('X-AntiAbuse: User_id - ' . $user->data['user_id']);
				$messenger->headers('X-AntiAbuse: Username - ' . $user->data['username']);
				$messenger->headers('X-AntiAbuse: User IP - ' . $user->ip);

				$messenger->assign_vars(array(
					'SITENAME'		=> $config['sitename'],
					'BOARD_EMAIL'	=> $config['board_contact'],
					'TO_USERNAME'	=> html_entity_decode($name),
					'FROM_USERNAME'	=> html_entity_decode($user->data['username']),
					'MESSAGE'		=> html_entity_decode($message))
				);

				if ($topic_id)
				{
					$messenger->assign_vars(array(
						'TOPIC_NAME'	=> html_entity_decode($row['topic_title']),
						'U_TOPIC'		=> generate_board_url() . "/viewtopic.$phpEx?f=" . $row['forum_id'] . "&t=$topic_id")
					);
				}

				$messenger->send($notify_type);
				$messenger->save_queue();

				meta_refresh(3, append_sid("{$phpbb_root_path}index.$phpEx"));
				$message = ($user_id) ? sprintf($user->lang['RETURN_INDEX'],  '<a href="' . append_sid("{$phpbb_root_path}index.$phpEx") . '">', '</a>') : sprintf($user->lang['RETURN_TOPIC'],  '<a href="' . append_sid("{$phpbb_root_path}viewtopic.$phpEx", "f={$row['forum_id']}&amp;t=$topic_id") . '">', '</a>');
				trigger_error($user->lang['EMAIL_SENT'] . '<br /><br />' . $message);
			}
		}

		if ($user_id)
		{
			$template->assign_vars(array(
				'S_SEND_USER'	=> true,
				'USERNAME'		=> $row['username'],
	
				'L_EMAIL_BODY_EXPLAIN'	=> $user->lang['EMAIL_BODY_EXPLAIN'],
				'S_POST_ACTION'			=> append_sid("{$phpbb_root_path}memberlist.$phpEx", 'mode=email&amp;u=' . $user_id))
			);
		}
		else
		{
			$template->assign_vars(array(
				'EMAIL'				=> $email,
				'NAME'				=> $name,
				'S_LANG_OPTIONS'	=> language_select($email_lang),

				'L_EMAIL_BODY_EXPLAIN'	=> $user->lang['EMAIL_TOPIC_EXPLAIN'],
				'S_POST_ACTION'			=> append_sid("{$phpbb_root_path}memberlist.$phpEx", 'mode=email&amp;t=' . $topic_id))
			);
		}

		$template->assign_vars(array(
			'ERROR_MESSAGE'		=> (sizeof($error)) ? implode('<br />', $error) : '')
		);

	break;

	case 'group':
	default:
		// The basic memberlist
		$page_title = $user->lang['MEMBERLIST'];
		$template_html = 'memberlist_body.html';

		// Sorting
		$sort_key_text = array('a' => $user->lang['SORT_USERNAME'], 'b' => $user->lang['SORT_LOCATION'], 'c' => $user->lang['SORT_JOINED'], 'd' => $user->lang['SORT_POST_COUNT'], 'e' => $user->lang['SORT_EMAIL'], 'f' => $user->lang['WEBSITE'], 'g' => $user->lang['ICQ'], 'h' => $user->lang['AIM'], 'i' => $user->lang['MSNM'], 'j' => $user->lang['YIM'], 'k' => $user->lang['JABBER'], 'l' => $user->lang['SORT_LAST_ACTIVE'], 'm' => $user->lang['SORT_RANK'], 'n' => $user->lang['LOCATION'] );
		$sort_key_sql = array('a' => 'u.username', 'b' => 'u.user_from', 'c' => 'u.user_regdate', 'd' => 'u.user_posts', 'e' => 'u.user_email', 'f' => 'u.user_website', 'g' => 'u.user_icq', 'h' => 'u.user_aim', 'i' => 'u.user_msnm', 'j' => 'u.user_yim', 'k' => 'u.user_jabber', 'l' => 'u.user_lastvisit', 'm' => 'u.user_rank DESC, u.user_posts', 'n' => 'u.user_from');

		$sort_dir_text = array('a' => $user->lang['ASCENDING'], 'd' => $user->lang['DESCENDING']);

		$s_sort_key = '';
		foreach ($sort_key_text as $key => $value)
		{
			$selected = ($sort_key == $key) ? ' selected="selected"' : '';
			$s_sort_key .= '<option value="' . $key . '"' . $selected . '>' . $value . '</option>';
		}

		$s_sort_dir = '';
		foreach ($sort_dir_text as $key => $value)
		{
			$selected = ($sort_dir == $key) ? ' selected="selected"' : '';
			$s_sort_dir .= '<option value="' . $key . '"' . $selected . '>' . $value . '</option>';
		}

		// Additional sorting options for user search ... if search is enabled, if not
		// then only admins can make use of this (for ACP functionality)
		$sql_select = $sql_from = $sql_where = $order_by = '';

		$form	= request_var('form', '');
		$field	= request_var('field', '');

		if ($mode == 'searchuser' && ($config['load_search'] || $auth->acl_get('a_')))
		{
			$username	= request_var('username', '', true);
			$email		= request_var('email', '');
			$icq		= request_var('icq', '');
			$aim		= request_var('aim', '');
			$yahoo		= request_var('yahoo', '');
			$msn		= request_var('msn', '');
			$jabber		= request_var('jabber', '');
			$search_group_id	= request_var('search_group_id', 0);

			$joined_select	= request_var('joined_select', 'lt');
			$active_select	= request_var('active_select', 'lt');
			$count_select	= request_var('count_select', 'eq');
			$joined			= explode('-', request_var('joined', ''));
			$active			= explode('-', request_var('active', ''));
			$count			= (request_var('count', '') !== '') ? request_var('count', 0) : '';
			$ipdomain		= request_var('ip', '');

			$find_key_match = array('lt' => '<', 'gt' => '>', 'eq' => '=');

			$find_count = array('lt' => $user->lang['LESS_THAN'], 'eq' => $user->lang['EQUAL_TO'], 'gt' => $user->lang['MORE_THAN']);
			$s_find_count = '';
			foreach ($find_count as $key => $value)
			{
				$selected = ($count_select == $key) ? ' selected="selected"' : '';
				$s_find_count .= '<option value="' . $key . '"' . $selected . '>' . $value . '</option>';
			}

			$find_time = array('lt' => $user->lang['BEFORE'], 'gt' => $user->lang['AFTER']);
			$s_find_join_time = '';
			foreach ($find_time as $key => $value)
			{
				$selected = ($joined_select == $key) ? ' selected="selected"' : '';
				$s_find_join_time .= '<option value="' . $key . '"' . $selected . '>' . $value . '</option>';
			}

			$s_find_active_time = '';
			foreach ($find_time as $key => $value)
			{
				$selected = ($active_select == $key) ? ' selected="selected"' : '';
				$s_find_active_time .= '<option value="' . $key . '"' . $selected . '>' . $value . '</option>';
			}

			$sql_where .= ($username) ? " AND u.username LIKE '" . str_replace('*', '%', $db->sql_escape($username)) . "'" : '';
			$sql_where .= ($email) ? " AND u.user_email LIKE '" . str_replace('*', '%', $db->sql_escape($email)) . "' " : '';
			$sql_where .= ($icq) ? " AND u.user_icq LIKE '" . str_replace('*', '%', $db->sql_escape($icq)) . "' " : '';
			$sql_where .= ($aim) ? " AND u.user_aim LIKE '" . str_replace('*', '%', $db->sql_escape($aim)) . "' " : '';
			$sql_where .= ($yahoo) ? " AND u.user_yim LIKE '" . str_replace('*', '%', $db->sql_escape($yahoo)) . "' " : '';
			$sql_where .= ($msn) ? " AND u.user_msnm LIKE '" . str_replace('*', '%', $db->sql_escape($msn)) . "' " : '';
			$sql_where .= ($jabber) ? " AND u.user_jabber LIKE '" . str_replace('*', '%', $db->sql_escape($jabber)) . "' " : '';
			$sql_where .= (is_numeric($count)) ? ' AND u.user_posts ' . $find_key_match[$count_select] . ' ' . (int) $count . ' ' : '';
			$sql_where .= (sizeof($joined) > 1) ? " AND u.user_regdate " . $find_key_match[$joined_select] . ' ' . gmmktime(0, 0, 0, intval($joined[1]), intval($joined[2]), intval($joined[0])) : '';
			$sql_where .= (sizeof($active) > 1) ? " AND u.user_lastvisit " . $find_key_match[$active_select] . ' ' . gmmktime(0, 0, 0, $active[1], intval($active[2]), intval($active[0])) : '';
			$sql_where .= ($search_group_id) ? " AND u.user_id = ug.user_id AND ug.group_id = $search_group_id " : '';

			if ($search_group_id)
			{
				$sql_from = ', ' . USER_GROUP_TABLE . ' ug ';
			}

			if ($ipdomain && $auth->acl_getf_global('m_info'))
			{
				$ips = (preg_match('#[a-z]#', $ipdomain)) ? implode(', ', preg_replace('#([0-9]{1,3}\.[0-9]{1,3}[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3})#', "'\\1'", gethostbynamel($ipdomain))) : "'" . str_replace('*', '%', $ipdomain) . "'";

				$ip_forums = array_keys($auth->acl_getf('m_info', true));
				$sql = 'SELECT DISTINCT poster_id
					FROM ' . POSTS_TABLE . '
					WHERE poster_ip ' . ((preg_match('#%#', $ips)) ? 'LIKE' : 'IN') . " ($ips)
						AND forum_id IN (0, " . implode(',', $ip_forums) . ')';
				$result = $db->sql_query($sql);

				if ($row = $db->sql_fetchrow($result))
				{
					$ip_sql = array();
					do
					{
						$ip_sql[] = $row['poster_id'];
					}
					while ($row = $db->sql_fetchrow($result));

					$sql_where .= ' AND u.user_id IN (' . implode(', ', $ip_sql) . ')';
				}
				else
				{
					// A minor fudge but it does the job :D
					$sql_where .= " AND u.user_id IN ('-1')";
				}
				unset($ip_forums);
			}
		}

		$first_char = request_var('first_char', '');

		if ($first_char == 'other')
		{
			for ($i = 65; $i < 91; $i++)
			{
				$sql_where .= " AND u.username NOT LIKE '" . chr($i) . "%'";
			}
		}
		else if ($first_char)
		{
			$sql_where .= " AND u.username LIKE '" . $db->sql_escape(substr($first_char, 0, 1)) . "%'";
		}

		// Are we looking at a usergroup? If so, fetch additional info
		// and further restrict the user info query
		if ($mode == 'group')
		{
			// We JOIN here to save a query for determining membership for hidden groups. ;)
			$sql = 'SELECT g.*, ug.user_id
				FROM ' . GROUPS_TABLE . ' g
				LEFT JOIN ' . USER_GROUP_TABLE . ' ug ON (ug.user_id = ' . $user->data['user_id'] . " AND ug.group_id = $group_id)
				WHERE g.group_id = $group_id";
			$result = $db->sql_query($sql);
			$group_row = $db->sql_fetchrow($result);
			$db->sql_freeresult($result);

			if (!$group_row)
			{
				trigger_error('NO_GROUP');
			}

			switch ($group_row['group_type'])
			{
				case GROUP_OPEN:
					$group_row['l_group_type'] = 'OPEN';
				break;

				case GROUP_CLOSED:
					$group_row['l_group_type'] = 'CLOSED';
				break;

				case GROUP_HIDDEN:
					$group_row['l_group_type'] = 'HIDDEN';

					// Check for membership or special permissions
					if (!$auth->acl_gets('a_group', 'a_groupadd', 'a_groupdel') && $group_row['user_id'] != $user->data['user_id'])
					{
						trigger_error('NO_GROUP');
					}
				break;

				case GROUP_SPECIAL:
					$group_row['l_group_type'] = 'SPECIAL';
				break;

				case GROUP_FREE:
					$group_row['l_group_type'] = 'FREE';
				break;
			}

			$avatar_img = '';
			if ($group_row['group_avatar'])
			{
				switch ($group_row['group_avatar_type'])
				{
					case AVATAR_UPLOAD:
						$avatar_img = $phpbb_root_path . $config['avatar_path'] . '/';
					break;

					case AVATAR_GALLERY:
						$avatar_img = $phpbb_root_path . $config['avatar_gallery_path'] . '/';
					break;
				}
				$avatar_img .= $group_row['group_avatar'];

				$avatar_img = '<img src="' . $avatar_img . '" width="' . $group_row['group_avatar_width'] . '" height="' . $group_row['group_avatar_height'] . '" alt="" />';
			}

			$rank_title = $rank_img = $rank_img_src = '';
			if ($group_row['group_rank'] != -1)
			{
				if (isset($ranks['special'][$group_row['group_rank']]))
				{
					$rank_title = $ranks['special'][$group_row['group_rank']]['rank_title'];
				}
				$rank_img = (!empty($ranks['special'][$group_row['group_rank']]['rank_image'])) ? '<img src="' . $config['ranks_path'] . '/' . $ranks['special'][$group_row['group_rank']]['rank_image'] . '" border="0" alt="' . $ranks['special'][$group_row['group_rank']]['rank_title'] . '" title="' . $ranks['special'][$group_row['group_rank']]['rank_title'] . '" /><br />' : '';
				$rank_img_src = (!empty($ranks['special'][$group_row['group_rank']]['rank_image'])) ? $config['ranks_path'] . '/' . $ranks['special'][$group_row['group_rank']]['rank_image'] : '';
			}
			else if ($group_row['group_rank'] == -1)
			{
				$rank_title = '';
				$rank_img = '';
				$rank_img_src = '';
			}

			$template->assign_vars(array(
				'GROUP_DESC'	=> generate_text_for_display($group_row['group_desc'], $group_row['group_desc_uid'], $group_row['group_desc_bitfield']),
				'GROUP_NAME'	=> ($group_row['group_type'] == GROUP_SPECIAL) ? $user->lang['G_' . $group_row['group_name']] : $group_row['group_name'],
				'GROUP_COLOR'	=> $group_row['group_colour'],
				'GROUP_TYPE'	=> $user->lang['GROUP_IS_' . $group_row['l_group_type']],
				'GROUP_RANK'	=> $rank_title,

				'AVATAR_IMG'	=> $avatar_img,
				'RANK_IMG'		=> $rank_img,
				'RANK_IMG_SRC'	=> $rank_img_src,

				'U_PM'			=> ($auth->acl_get('u_sendpm') && $group_row['group_receive_pm'] && $config['allow_mass_pm']) ? append_sid("{$phpbb_root_path}ucp.$phpEx", 'i=pm&amp;mode=compose&amp;g=' . $group_id) : '',)
			);

			$sql_select = ', ug.group_leader';
			$sql_from = ', ' . USER_GROUP_TABLE . ' ug ';
			$order_by = 'ug.group_leader DESC, ';

			$sql_where .= " AND u.user_id = ug.user_id AND ug.group_id = $group_id";
		}
		
		// Sorting and order
		$order_by .= $sort_key_sql[$sort_key] . '  ' . (($sort_dir == 'a') ? 'ASC' : 'DESC');

		// Count the users ...
		if ($sql_where)
		{
			$sql = 'SELECT COUNT(u.user_id) AS total_users
				FROM ' . USERS_TABLE . " u$sql_from
				WHERE u.user_type IN (" . USER_NORMAL . ', ' . USER_FOUNDER . ")
				$sql_where";
			$result = $db->sql_query($sql);
			$total_users = (int) $db->sql_fetchfield('total_users');
			$db->sql_freeresult($result);
		}
		else
		{
			$total_users = $config['num_users'];
		}

		$s_char_options = '<option value=""' . ((!$first_char) ? ' selected="selected"' : '') . '>&nbsp; &nbsp;</option>';
		for ($i = 65; $i < 91; $i++)
		{
			$s_char_options .= '<option value="' . chr($i) . '"' . (($first_char == chr($i)) ? ' selected="selected"' : '') . '>' . chr($i) . '</option>';
		}
		$s_char_options .= '<option value="other"' . (($first_char == 'other') ? ' selected="selected"' : '') . '>Other</option>';

		// Build a relevant pagination_url
		$params = array();
		foreach (array('_POST', '_GET') as $global_var)
		{
			foreach ($$global_var as $key => $var)
			{
				if ($global_var == '_POST')
				{
					unset($_GET[$key]);
				}

				if (in_array($key, array('submit', 'start', 'mode')) || !$var)
				{
					continue;
				}
				$params[] = $key . '=' . urlencode(htmlspecialchars($var));
			}
		}

		$u_hide_find_member = append_sid("{$phpbb_root_path}memberlist.$phpEx", implode('&amp;', $params));

		$params[] = "mode=$mode&amp;first_char=$first_char";
		$pagination_url = append_sid("{$phpbb_root_path}memberlist.$phpEx", implode('&amp;', $params));

		// Some search user specific data
		if ($mode == 'searchuser' && ($config['load_search'] || $auth->acl_get('a_')))
		{
			$group_selected = request_var('search_group_id', 0);
			$s_group_select = '<option value="0"' . ((!$group_selected) ? ' selected="selected"' : '') . '>&nbsp;</option>';

			$sql = 'SELECT group_id, group_name, group_type
				FROM ' . GROUPS_TABLE . '
				WHERE group_type <> ' . GROUP_HIDDEN . '
				ORDER BY group_name ASC';
			$result = $db->sql_query($sql);

			while ($row = $db->sql_fetchrow($result))
			{
				$s_group_select .= '<option value="' . $row['group_id'] . '"' . (($group_selected == $row['group_id']) ? ' selected="selected"' : '') . '>' . (($row['group_type'] == GROUP_SPECIAL) ? $user->lang['G_' . $row['group_name']] : $row['group_name']) . '</option>';
			}
			$db->sql_freeresult($result);

			$template->assign_vars(array(
				'USERNAME'	=> $username,
				'EMAIL'		=> $email,
				'ICQ'		=> $icq,
				'AIM'		=> $aim,
				'YAHOO'		=> $yahoo,
				'MSNM'		=> $msn,
				'JABBER'	=> $jabber,
				'JOINED'	=> implode('-', $joined),
				'ACTIVE'	=> implode('-', $active),
				'COUNT'		=> $count,
				'IP'		=> $ipdomain,

				'S_SEARCH_USER'			=> true,
				'S_FORM_NAME'			=> $form,
				'S_FIELD_NAME'			=> $field,
				'S_COUNT_OPTIONS'		=> $s_find_count,
				'S_SORT_OPTIONS'		=> $s_sort_key,
				'S_JOINED_TIME_OPTIONS'	=> $s_find_join_time,
				'S_ACTIVE_TIME_OPTIONS'	=> $s_find_active_time,
				'S_GROUP_SELECT'		=> $s_group_select,
				'S_SEARCH_ACTION'		=> append_sid("{$phpbb_root_path}memberlist.$phpEx", "mode=searchuser&amp;form=$form&amp;field=$field"))
			);
		}

		$sql = 'SELECT session_user_id, MAX(session_time) AS session_time
			FROM ' . SESSIONS_TABLE . '
			WHERE session_time >= ' . (time() - $config['session_length']) . '
				AND session_user_id <> ' . ANONYMOUS . '
			GROUP BY session_user_id';
		$result = $db->sql_query($sql);

		$session_times = array();
		while ($row = $db->sql_fetchrow($result))
		{
			$session_times[$row['session_user_id']] = $row['session_time'];
		}
		$db->sql_freeresult($result);

		// Do the SQL thang
		$sql = "SELECT u.*
				$sql_select
			FROM " . USERS_TABLE . " u
				$sql_from
			WHERE u.user_type IN (" . USER_NORMAL . ', ' . USER_FOUNDER . ")
				$sql_where
			ORDER BY $order_by";
		$result = $db->sql_query_limit($sql, $config['topics_per_page'], $start);

		$id_cache = array();
		while ($row = $db->sql_fetchrow($result))
		{
			$row['session_time'] = (!empty($session_times[$row['user_id']])) ? $session_times[$row['user_id']] : '';

			$id_cache[$row['user_id']] = $row;
		}
		$db->sql_freeresult($result);
			
		// Load custom profile fields
		if ($config['load_cpf_memberlist'])
		{
			include_once($phpbb_root_path . 'includes/functions_profile_fields.' . $phpEx);
			$cp = new custom_profile();

			// Grab all profile fields from users in id cache for later use - similar to the poster cache
			$profile_fields_cache = $cp->generate_profile_fields_template('grab', array_keys($id_cache));
		}

		$i = 0;
		foreach ($id_cache as $user_id => $row)
		{
			$cp_row = array();
			if ($config['load_cpf_memberlist'])
			{
				$cp_row = (isset($profile_fields_cache[$user_id])) ? $cp->generate_profile_fields_template('show', false, $profile_fields_cache[$user_id]) : array();
			}

			$memberrow = array_merge(show_profile($row), array(
				'ROW_NUMBER'		=> $i + ($start + 1),

				'S_CUSTOM_PROFILE'	=> (isset($cp_row['row']) && sizeof($cp_row['row'])) ? true : false,
				'S_GROUP_LEADER'	=> (isset($row['group_leader']) && $row['group_leader']) ? true : false,

				'U_VIEWPROFILE'		=> append_sid("{$phpbb_root_path}memberlist.$phpEx", 'mode=viewprofile&amp;u=' . $user_id))
			);

			if (isset($cp_row['row']) && sizeof($cp_row['row']))
			{
				$memberrow = array_merge($memberrow, $cp_row['row']);
			}

			$template->assign_block_vars('memberrow', $memberrow);

			if (isset($cp_row['blockrow']) && sizeof($cp_row['blockrow']))
			{
				foreach ($cp_row['blockrow'] as $field_data)
				{
					$template->assign_block_vars('memberrow.custom_fields', $field_data);
				}
			}

			$i++;
			unset($id_cache[$user_id]);
		}
	
		// Generate page
		$template->assign_vars(array(
			'PAGINATION'	=> generate_pagination($pagination_url, $total_users, $config['topics_per_page'], $start),
			'PAGE_NUMBER'	=> on_page($total_users, $config['topics_per_page'], $start),
			'TOTAL_USERS'	=> ($total_users == 1) ? $user->lang['LIST_USER'] : sprintf($user->lang['LIST_USERS'], $total_users),

			'PROFILE_IMG'	=> $user->img('btn_profile', $user->lang['PROFILE']),
			'PM_IMG'		=> $user->img('btn_pm', $user->lang['SEND_PRIVATE_MESSAGE']),
			'EMAIL_IMG'		=> $user->img('btn_email', $user->lang['EMAIL']),
			'WWW_IMG'		=> $user->img('btn_www', $user->lang['WWW']),
			'ICQ_IMG'		=> $user->img('btn_icq', $user->lang['ICQ']),
			'AIM_IMG'		=> $user->img('btn_aim', $user->lang['AIM']),
			'MSN_IMG'		=> $user->img('btn_msnm', $user->lang['MSNM']),
			'YIM_IMG'		=> $user->img('btn_yim', $user->lang['YIM']),
			'JABBER_IMG'	=> $user->img('btn_jabber', $user->lang['JABBER']),
			'SEARCH_IMG'	=> $user->img('btn_search', $user->lang['SEARCH']),

			'U_FIND_MEMBER'			=> ($config['load_search'] || $auth->acl_get('a_')) ? append_sid("{$phpbb_root_path}memberlist.$phpEx", 'mode=searchuser') : '',
			'U_HIDE_FIND_MEMBER'	=> ($mode == 'searchuser') ? $u_hide_find_member : '',
			'U_SORT_USERNAME'		=> $pagination_url . '&amp;sk=a&amp;sd=' . (($sort_key == 'a' && $sort_dir == 'a') ? 'd' : 'a'),
			'U_SORT_FROM'			=> $pagination_url . '&amp;sk=b&amp;sd=' . (($sort_key == 'b' && $sort_dir == 'a') ? 'd' : 'a'),
			'U_SORT_JOINED'			=> $pagination_url . '&amp;sk=c&amp;sd=' . (($sort_key == 'c' && $sort_dir == 'a') ? 'd' : 'a'),
			'U_SORT_POSTS'			=> $pagination_url . '&amp;sk=d&amp;sd=' . (($sort_key == 'd' && $sort_dir == 'a') ? 'd' : 'a'),
			'U_SORT_EMAIL'			=> $pagination_url . '&amp;sk=e&amp;sd=' . (($sort_key == 'e' && $sort_dir == 'a') ? 'd' : 'a'),
			'U_SORT_WEBSITE'		=> $pagination_url . '&amp;sk=f&amp;sd=' . (($sort_key == 'f' && $sort_dir == 'a') ? 'd' : 'a'),
			'U_SORT_LOCATION'		=> $pagination_url . '&amp;sk=n&amp;sd=' . (($sort_key == 'n' && $sort_dir == 'a') ? 'd' : 'a'),
			'U_SORT_ICQ'			=> $pagination_url . '&amp;sk=g&amp;sd=' . (($sort_key == 'g' && $sort_dir == 'a') ? 'd' : 'a'),
			'U_SORT_AIM'			=> $pagination_url . '&amp;sk=h&amp;sd=' . (($sort_key == 'h' && $sort_dir == 'a') ? 'd' : 'a'),
			'U_SORT_MSN'			=> $pagination_url . '&amp;sk=i&amp;sd=' . (($sort_key == 'i' && $sort_dir == 'a') ? 'd' : 'a'),
			'U_SORT_YIM'			=> $pagination_url . '&amp;sk=j&amp;sd=' . (($sort_key == 'j' && $sort_dir == 'a') ? 'd' : 'a'),
			'U_SORT_ACTIVE'			=> $pagination_url . '&amp;sk=k&amp;sd=' . (($sort_key == 'k' && $sort_dir == 'a') ? 'd' : 'a'),
			'U_SORT_RANK'			=> $pagination_url . '&amp;sk=m&amp;sd=' . (($sort_key == 'm' && $sort_dir == 'a') ? 'd' : 'a'),
			'U_LIST_CHAR'			=> $pagination_url . '&amp;sk=a&amp;sd=' . (($sort_key == 'l' && $sort_dir == 'a') ? 'd' : 'a'),

			'S_SHOW_GROUP'		=> ($mode == 'group') ? true : false,
			'S_MODE_SELECT'		=> $s_sort_key,
			'S_ORDER_SELECT'	=> $s_sort_dir,
			'S_CHAR_OPTIONS'	=> $s_char_options,
			'S_MODE_ACTION'		=> $pagination_url . "&amp;form=$form")
		);
}

// Output the page
page_header($page_title);

$template->set_filenames(array(
	'body' => $template_html)
);
make_jumpbox(append_sid("{$phpbb_root_path}viewforum.$phpEx"));

page_footer();

/**
* Get user rank title and image
*/
function get_user_rank($user_rank, $user_posts, &$rank_title, &$rank_img, &$rank_img_src)
{
	global $ranks, $config;

	if (!empty($user_rank))
	{
		$rank_title = (isset($ranks['special'][$user_rank]['rank_title'])) ? $ranks['special'][$user_rank]['rank_title'] : '';
		$rank_img = (!empty($ranks['special'][$user_rank]['rank_image'])) ? '<img src="' . $config['ranks_path'] . '/' . $ranks['special'][$user_rank]['rank_image'] . '" alt="' . $ranks['special'][$user_rank]['rank_title'] . '" title="' . $ranks['special'][$user_rank]['rank_title'] . '" />' : '';
		$rank_img_src = (!empty($ranks['special'][$user_rank]['rank_image'])) ? $config['ranks_path'] . '/' . $ranks['special'][$user_rank]['rank_image'] : '';
	}
	else
	{
		if (isset($ranks['normal']))
		{
			foreach ($ranks['normal'] as $rank)
			{
				if ($user_posts >= $rank['rank_min'])
				{
					$rank_title = $rank['rank_title'];
					$rank_img = (!empty($rank['rank_image'])) ? '<img src="' . $config['ranks_path'] . '/' . $rank['rank_image'] . '" alt="' . $rank['rank_title'] . '" title="' . $rank['rank_title'] . '" />' : '';
					$rank_img_src = (!empty($rank['rank_image'])) ? $config['ranks_path'] . '/' . $rank['rank_image'] : '';
					break;
				}
			}
		}
	}
}

/**
* Prepare profile data
*/
function show_profile($data)
{
	global $config, $auth, $template, $user, $phpEx, $phpbb_root_path;

	$username = $data['username'];
	$user_id = $data['user_id'];

	$rank_title = $rank_img = $rank_img_src = '';
	get_user_rank($data['user_rank'], $data['user_posts'], $rank_title, $rank_img, $rank_img_src);
	
	if (!empty($data['user_allow_viewemail']) || $auth->acl_get('a_email'))
	{
		$email = ($config['board_email_form'] && $config['email_enable']) ? append_sid("{$phpbb_root_path}memberlist.$phpEx", 'mode=email&amp;u=' . $user_id) : (($config['board_hide_emails'] && !$auth->acl_get('a_email')) ? '' : 'mailto:' . $data['user_email']);
	}
	else
	{
		$email = '';
	}

	$last_visit = (!empty($data['session_time'])) ? $data['session_time'] : $data['user_lastvisit'];

	$update_time = $config['load_online_time'] * 60;
	$online = (time() - $update_time < $data['session_time'] && ((isset($data['session_viewonline']) && $data['user_allow_viewonline']) || $auth->acl_get('u_viewonline'))) ? true : false;

	// Dump it out to the template
	return array(
		'USERNAME'		=> $username,
		'USER_COLOR'	=> (!empty($data['user_colour'])) ? $data['user_colour'] : '',
		'RANK_TITLE'	=> $rank_title,
		'JOINED'		=> $user->format_date($data['user_regdate']),
		'VISITED'		=> (empty($last_visit)) ? ' - ' : $user->format_date($last_visit),
		'POSTS'			=> ($data['user_posts']) ? $data['user_posts'] : 0,
  		'WARNINGS'		=> isset($data['user_warnings']) ? $data['user_warnings'] : 0,

		'ONLINE_IMG'		=> ($online) ? $user->img('btn_online', 'ONLINE') : $user->img('btn_offline', 'OFFLINE'),
		'S_ONLINE'			=> ($online) ? true : false,
		'RANK_IMG'			=> $rank_img,
		'RANK_IMG_SRC'		=> $rank_img_src,
		'ICQ_STATUS_IMG'	=> (!empty($data['user_icq'])) ? '<img src="http://web.icq.com/whitepages/online?icq=' . $data['user_icq'] . '&amp;img=5" width="18" height="18" />' : '',
		'S_JABBER_ENABLED'	=> ($config['jab_enable']) ? true : false,

		'U_PROFILE'		=> append_sid("{$phpbb_root_path}memberlist.$phpEx", 'mode=viewprofile&amp;u=' . $user_id),
		'U_SEARCH_USER'	=> ($auth->acl_get('u_search')) ? append_sid("{$phpbb_root_path}search.$phpEx", "author_id=$user_id&amp;sr=posts") : '',
		'U_NOTES'		=> $auth->acl_getf_global('m_') ? append_sid("{$phpbb_root_path}mcp.$phpEx", 'i=notes&amp;mode=user_notes&amp;u=' . $user_id, true, $user->session_id) : '',
		'U_WARN'		=> $auth->acl_getf_global('m_warn') ? append_sid("{$phpbb_root_path}mcp.$phpEx", 'i=warn&amp;mode=warn_user&amp;u=' . $user_id, true, $user->session_id) : '',
		'U_PM'			=> ($auth->acl_get('u_sendpm')) ? append_sid("{$phpbb_root_path}ucp.$phpEx", 'i=pm&amp;mode=compose&amp;u=' . $user_id) : '',
		'U_EMAIL'		=> $email,
		'U_WWW'			=> (!empty($data['user_website'])) ? $data['user_website'] : '',
		'U_ICQ'			=> ($data['user_icq']) ? append_sid("{$phpbb_root_path}memberlist.$phpEx", 'mode=contact&amp;action=icq&amp;u=' . $user_id) : '',
		'U_AIM'			=> ($data['user_aim']) ? append_sid("{$phpbb_root_path}memberlist.$phpEx", 'mode=contact&amp;action=aim&amp;u=' . $user_id) : '',
		'U_YIM'			=> ($data['user_yim']) ? 'http://edit.yahoo.com/config/send_webmesg?.target=' . $data['user_yim'] . '&amp;.src=pg' : '',
		'U_MSN'			=> ($data['user_msnm']) ? append_sid("{$phpbb_root_path}memberlist.$phpEx", 'mode=contact&amp;action=msnm&amp;u=' . $user_id) : '',
		'U_JABBER'		=> ($data['user_jabber']) ? append_sid("{$phpbb_root_path}memberlist.$phpEx", 'mode=contact&amp;action=jabber&amp;u=' . $user_id) : '',
		'LOCATION'		=> ($data['user_from']) ? $data['user_from'] : '',
		
		'L_VIEWING_PROFILE'	=> sprintf($user->lang['VIEWING_PROFILE'], $username),

		'S_ONLINE'	=> ($online) ? true : false
	);
}

?>