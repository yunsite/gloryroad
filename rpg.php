<?php
/** 
*
* @package phpBB3
* @version $Id: index.php,v 1.153 2006/03/12 23:19:48 acydburn Exp $
* @copyright (c) 2005 phpBB Group 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
*/
define('IN_PHPBB', true);
$phpbb_root_path = './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.'.$phpEx);
include($phpbb_root_path . 'includes/functions_display.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup();

display_forums('', $config['load_moderators']);

// Set some stats, get posts count from forums data if we... hum... retrieve all forums data
$total_posts = $config['num_posts'];
$total_topics = $config['num_topics'];
$total_users = $config['num_users'];
$newest_user = $config['newest_username'];
$newest_uid = $config['newest_user_id'];

$l_total_user_s = ($total_users == 0) ? 'TOTAL_USERS_ZERO' : 'TOTAL_USERS_OTHER';
$l_total_post_s = ($total_posts == 0) ? 'TOTAL_POSTS_ZERO' : 'TOTAL_POSTS_OTHER';
$l_total_topic_s = ($total_topics == 0) ? 'TOTAL_TOPICS_ZERO' : 'TOTAL_TOPICS_OTHER';

// Grab group details for legend display
$sql = 'SELECT group_id, group_name, group_colour, group_type
	FROM ' . GROUPS_TABLE . '
	WHERE group_legend = 1
		AND group_type <> ' . GROUP_HIDDEN;
$result = $db->sql_query($sql);

$legend = '';
while ($row = $db->sql_fetchrow($result))
{
	$legend .= (($legend != '') ? ', ' : '') . '<a style="color:#' . $row['group_colour'] . '" href="' . "{$phpbb_root_path}memberlist.$phpEx$SID" . '&amp;mode=group&amp;g=' . $row['group_id'] . '">' . (($row['group_type'] == GROUP_SPECIAL) ? $user->lang['G_' . $row['group_name']] : $row['group_name']) . '</a>';
}
$db->sql_freeresult($result);




// Assign index specific vars
$template->assign_vars(array(
	'TOTAL_POSTS'	=> sprintf($user->lang[$l_total_post_s], $total_posts),
	'TOTAL_TOPICS'	=> sprintf($user->lang[$l_total_topic_s], $total_topics),
	'TOTAL_USERS'	=> sprintf($user->lang[$l_total_user_s], $total_users),
	'NEWEST_USER'	=> sprintf($user->lang['NEWEST_USER'], "<a href=\"{$phpbb_root_path}memberlist.$phpEx$SID&amp;mode=viewprofile&amp;u=$newest_uid \">", $newest_user, '</a>'),
	'LEGEND'		=> $legend,

	'FORUM_IMG'			=>	$user->img('forum', 'NO_NEW_POSTS'),
	'FORUM_NEW_IMG'		=>	$user->img('forum_new', 'NEW_POSTS'),
	'FORUM_LOCKED_IMG'	=>	$user->img('forum_locked', 'NO_NEW_POSTS_LOCKED'),

	'S_LOGIN_ACTION'			=> "{$phpbb_root_path}ucp.$phpEx$SID&amp;mode=login",
	'S_DISPLAY_BIRTHDAY_LIST'	=> ($config['load_birthdays']) ? true : false,

	'U_MARK_FORUMS'		=> "{$phpbb_root_path}index.$phpEx$SID&amp;mark=forums",
	'U_MCP'				=> ($auth->acl_get('m_')) ? "{$phpbb_root_path}mcp.$phpEx$SID&amp;i=main&amp;mode=front" : '')
);

// Output page
page_header($user->lang['INDEX']);

$template->set_filenames(array(
	'body' => 'city/city_body.html')
);

page_footer();

?>