<?php
/** 
*
* acp_permissions (phpBB Permission Set) [English]
*
* @package language
* @version $Id: permissions_phpbb.php,v 1.12 2006/06/06 20:53:46 acydburn Exp $
* @copyright (c) 2005 phpBB Group 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* DO NOT CHANGE
*/
if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE 
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine

/*
	MODDERS PLEASE NOTE
	
	Please add your permission settings this way:

	// Adding new category
	$lang['permission_cats']['bugs'] = 'Bugs';

	// Adding new permission set
	$lang['permission_sets']['bug_'] = 'Bug Permissions';

	// Adding the permissions
	$lang = array_merge($lang, array(
		'acl_bug_view'		=> array('lang' => 'Can view bug reports', 'cat' => 'bugs'),
		'acl_bug_post'		=> array('lang' => 'Can post bugs', 'cat' => 'post'), // Using a phpBB category here
	));

	TODO:
	You are able to put your permission sets into a seperate file too by
	prefixing it with permissions_ and putting it into the acp language folder.
*/

// Define categories and permission types
$lang = array_merge($lang, array(
	'permission_cat'	=> array(
		'actions'		=> 'Actions',
		'content'		=> 'Content',
		'forums'		=> 'Forums',
		'misc'			=> 'Misc',
		'permissions'	=> 'Permissions',
		'pm'			=> 'Private Messages',
		'polls'			=> 'Polls',
		'post'			=> 'Post',
		'post_actions'	=> 'Post Actions',
		'posting'		=> 'Posting',
		'profile'		=> 'Profile',
		'settings'		=> 'Settings',
		'topic_actions'	=> 'Topic Actions',
		'user_group'	=> 'Users &amp; Groups',
	),

	'permission_type'	=> array(
		'u_'			=> 'User Permissions',
		'a_'			=> 'Admin Permissions',
		'm_'			=> 'Moderator Permissions',
		'f_'			=> 'Forum Permissions',
	),
));

// User Permissions
$lang = array_merge($lang, array(
	'acl_u_viewprofile'	=> array('lang' => 'Can view profiles', 'cat' => 'profile'),
	'acl_u_chgname'		=> array('lang' => 'Can change username', 'cat' => 'profile'),
	'acl_u_chgpasswd'	=> array('lang' => 'Can change password', 'cat' => 'profile'),
	'acl_u_chgemail'	=> array('lang' => 'Can change email address', 'cat' => 'profile'),
	'acl_u_chgavatar'	=> array('lang' => 'Can change avatar', 'cat' => 'profile'),
	'acl_u_chggrp'		=> array('lang' => 'Can change default usergroup', 'cat' => 'profile'),

	'acl_u_attach'		=> array('lang' => 'Can attach files', 'cat' => 'post'),
	'acl_u_download'	=> array('lang' => 'Can download files', 'cat' => 'post'),
	'acl_u_savedrafts'	=> array('lang' => 'Can save drafts', 'cat' => 'post'),
	'acl_u_chgcensors'	=> array('lang' => 'Can disable word censors', 'cat' => 'post'),
	'acl_u_sig'			=> array('lang' => 'Can use signature', 'cat' => 'post'),

	'acl_u_sendpm'		=> array('lang' => 'Can send private messages', 'cat' => 'pm'),
	'acl_u_readpm'		=> array('lang' => 'Can read private messages', 'cat' => 'pm'),
	'acl_u_pm_edit'		=> array('lang' => 'Can edit own private messages', 'cat' => 'pm'),
	'acl_u_pm_delete'	=> array('lang' => 'Can remove private messages from own folder', 'cat' => 'pm'),
	'acl_u_pm_forward'	=> array('lang' => 'Can forward private messages', 'cat' => 'pm'),
	'acl_u_pm_emailpm'	=> array('lang' => 'Can email private messages', 'cat' => 'pm'),
	'acl_u_pm_printpm'	=> array('lang' => 'Can print private messages', 'cat' => 'pm'),
	'acl_u_pm_attach'	=> array('lang' => 'Can attach files in private messages', 'cat' => 'pm'),
	'acl_u_pm_download'	=> array('lang' => 'Can download files in private messages', 'cat' => 'pm'),
	'acl_u_pm_bbcode'	=> array('lang' => 'Can post BBCode in private messages', 'cat' => 'pm'),
	'acl_u_pm_smilies'	=> array('lang' => 'Can post smilies in private messages', 'cat' => 'pm'),
	'acl_u_pm_img'		=> array('lang' => 'Can post images in private messages', 'cat' => 'pm'),
	'acl_u_pm_flash'	=> array('lang' => 'Can post Flash in private messages', 'cat' => 'pm'),

	'acl_u_sendemail'	=> array('lang' => 'Can send emails', 'cat' => 'misc'),
	'acl_u_sendim'		=> array('lang' => 'Can send instant messages', 'cat' => 'misc'),
	'acl_u_ignoreflood'	=> array('lang' => 'Can ignore flood limit', 'cat' => 'misc'),
	'acl_u_hideonline'	=> array('lang' => 'Can hide online status', 'cat' => 'misc'),
	'acl_u_viewonline'	=> array('lang' => 'Can view all online', 'cat' => 'misc'),
	'acl_u_search'		=> array('lang' => 'Can search board', 'cat' => 'misc'),
));

// Forum Permissions
$lang = array_merge($lang, array(
	'acl_f_list'		=> array('lang' => 'Can see forum', 'cat' => 'post'),
	'acl_f_read'		=> array('lang' => 'Can read forum', 'cat' => 'post'),
	'acl_f_post'		=> array('lang' => 'Can post in forum', 'cat' => 'post'),
	'acl_f_announce'	=> array('lang' => 'Can post announcements', 'cat' => 'post'),
	'acl_f_sticky'		=> array('lang' => 'Can post stickies', 'cat' => 'post'),
	'acl_f_reply'		=> array('lang' => 'Can reply to posts', 'cat' => 'post'),
	'acl_f_icons'		=> array('lang' => 'Can use post icons', 'cat' => 'post'),

	'acl_f_poll'		=> array('lang' => 'Can create polls', 'cat' => 'polls'),
	'acl_f_vote'		=> array('lang' => 'Can vote in polls', 'cat' => 'polls'),
	'acl_f_votechg'		=> array('lang' => 'Can change existing vote', 'cat' => 'polls'),

	'acl_f_attach'		=> array('lang' => 'Can attach files', 'cat' => 'content'),
	'acl_f_download'	=> array('lang' => 'Can download files', 'cat' => 'content'),
	'acl_f_sigs'		=> array('lang' => 'Can use signatures', 'cat' => 'content'),
	'acl_f_bbcode'		=> array('lang' => 'Can post BBCode', 'cat' => 'content'),
	'acl_f_smilies'		=> array('lang' => 'Can post smilies', 'cat' => 'content'),
	'acl_f_img'			=> array('lang' => 'Can post images', 'cat' => 'content'),
	'acl_f_flash'		=> array('lang' => 'Can post Flash', 'cat' => 'content'),

	'acl_f_edit'		=> array('lang' => 'Can edit own posts', 'cat' => 'actions'),
	'acl_f_delete'		=> array('lang' => 'Can delete own posts', 'cat' => 'actions'),
	'acl_f_user_lock'	=> array('lang' => 'Can lock own topics', 'cat' => 'actions'),
	'acl_f_bump'		=> array('lang' => 'Can bump topics', 'cat' => 'actions'),
	'acl_f_report'		=> array('lang' => 'Can report posts', 'cat' => 'actions'),
	'acl_f_subscribe'	=> array('lang' => 'Can subscribe forum', 'cat' => 'actions'),
	'acl_f_print'		=> array('lang' => 'Can print topics', 'cat' => 'actions'),
	'acl_f_email'		=> array('lang' => 'Can email topics', 'cat' => 'actions'),

	'acl_f_search'		=> array('lang' => 'Can search the forum', 'cat' => 'misc'),
	'acl_f_ignoreflood' => array('lang' => 'Can ignore flood limit', 'cat' => 'misc'),
	'acl_f_postcount'	=> array('lang' => 'Increment post counter', 'cat' => 'misc'),
	'acl_f_noapprove'	=> array('lang' => 'Can post without approval', 'cat' => 'misc'),
));

// Moderator Permissions
$lang = array_merge($lang, array(
	'acl_m_edit'		=> array('lang' => 'Can edit posts', 'cat' => 'post_actions'),
	'acl_m_delete'		=> array('lang' => 'Can delete posts', 'cat' => 'post_actions'),
	'acl_m_approve'		=> array('lang' => 'Can approve posts', 'cat' => 'post_actions'),
	'acl_m_report'		=> array('lang' => 'Can close and delete reports', 'cat' => 'post_actions'),
	'acl_m_chgposter'	=> array('lang' => 'Can change post author', 'cat' => 'post_actions'),

	'acl_m_move'	=> array('lang' => 'Can move topics', 'cat' => 'topic_actions'),
	'acl_m_lock'	=> array('lang' => 'Can lock topics', 'cat' => 'topic_actions'),
	'acl_m_split'	=> array('lang' => 'Can split topics', 'cat' => 'topic_actions'),
	'acl_m_merge'	=> array('lang' => 'Can merge topics', 'cat' => 'topic_actions'),

	'acl_m_info'	=> array('lang' => 'Can view post details', 'cat' => 'misc'),
	'acl_m_warn'	=> array('lang' => 'Can issue warnings', 'cat' => 'misc'),
	'acl_m_ban'		=> array('lang' => 'Can manage bans', 'cat' => 'misc'), // This moderator setting is only global (and not local)
));

// Admin Permissions
$lang = array_merge($lang, array(
	'acl_a_board'		=> array('lang' => 'Can alter board settings', 'cat' => 'settings'),
	'acl_a_server'		=> array('lang' => 'Can alter server/communication settings', 'cat' => 'settings'),
	'acl_a_jabber'		=> array('lang' => 'Can alter jabber settings', 'cat' => 'settings'),
	'acl_a_phpinfo'		=> array('lang' => 'Can view php settings', 'cat' => 'settings'),

	'acl_a_forum'		=> array('lang' => 'Can manage forums', 'cat' => 'forums'),
	'acl_a_forumadd'	=> array('lang' => 'Can add new forums', 'cat' => 'forums'),
	'acl_a_forumdel'	=> array('lang' => 'Can delete forums', 'cat' => 'forums'),
	'acl_a_prune'		=> array('lang' => 'Can prune forums', 'cat' => 'forums'),

	'acl_a_icons'		=> array('lang' => 'Can alter topic icons and smilies', 'cat' => 'posting'),
	'acl_a_words'		=> array('lang' => 'Can alter word censors', 'cat' => 'posting'),
	'acl_a_bbcode'		=> array('lang' => 'Can define BBCode tags', 'cat' => 'posting'),
	'acl_a_attach'		=> array('lang' => 'Can alter attachment related settings', 'cat' => 'posting'),

	'acl_a_user'		=> array('lang' => 'Can manage users', 'cat' => 'user_group'),
	'acl_a_userdel'		=> array('lang' => 'Can delete/prune users', 'cat' => 'user_group'),
	'acl_a_group'		=> array('lang' => 'Can manage groups', 'cat' => 'user_group'),
	'acl_a_groupadd'	=> array('lang' => 'Can add new groups', 'cat' => 'user_group'),
	'acl_a_groupdel'	=> array('lang' => 'Can delete groups', 'cat' => 'user_group'),
	'acl_a_ranks'		=> array('lang' => 'Can manage ranks', 'cat' => 'user_group'),
	'acl_a_profile'		=> array('lang' => 'Can manage custom profile fields', 'cat' => 'user_group'),
	'acl_a_names'		=> array('lang' => 'Can manage disallowed names', 'cat' => 'user_group'),
	'acl_a_ban'			=> array('lang' => 'Can manage bans', 'cat' => 'user_group'),

	'acl_a_viewauth'	=> array('lang' => 'Can view permission masks', 'cat' => 'permissions'),
	'acl_a_fauth'		=> array('lang' => 'Can alter forum permissions', 'cat' => 'permissions'),
	'acl_a_mauth'		=> array('lang' => 'Can alter moderator permissions', 'cat' => 'permissions'),
	'acl_a_aauth'		=> array('lang' => 'Can alter admin permissions', 'cat' => 'permissions'),
	'acl_a_uauth'		=> array('lang' => 'Can alter user permissions', 'cat' => 'permissions'),
	'acl_a_authgroups'	=> array('lang' => 'Can alter permissions for groups', 'cat' => 'permissions'),
	'acl_a_authusers'	=> array('lang' => 'Can alter permissions for users', 'cat' => 'permissions'),
	'acl_a_roles'		=> array('lang' => 'Can manage roles', 'cat' => 'permissions'),
	'acl_a_switchperm'	=> array('lang' => 'Can use others permissions', 'cat' => 'permissions'),

	'acl_a_styles'		=> array('lang' => 'Can manage styles', 'cat' => 'misc'),
	'acl_a_viewlogs'	=> array('lang' => 'Can view logs', 'cat' => 'misc'),
	'acl_a_clearlogs'	=> array('lang' => 'Can clear logs', 'cat' => 'misc'),
	'acl_a_modules'		=> array('lang' => 'Can manage modules', 'cat' => 'misc'),
	'acl_a_language'	=> array('lang' => 'Can manage language packs', 'cat' => 'misc'),
	'acl_a_email'		=> array('lang' => 'Can send mass email', 'cat' => 'misc'),
	'acl_a_bots'		=> array('lang' => 'Can manage bots', 'cat' => 'misc'),
	'acl_a_reasons'		=> array('lang' => 'Can manage report/denial reasons', 'cat' => 'misc'),
	'acl_a_backup'		=> array('lang' => 'Can backup database', 'cat' => 'misc'),
#	'acl_a_restore'		=> array('lang' => 'Can restore database', 'cat' => 'misc'),
	'acl_a_search'		=> array('lang' => 'Can manage search backends and settings', 'cat' => 'misc'),
));

?>