<?php
/** 
*
* viewforum [中文] :: CRLin - http://web.dhjh.tcc.edu.tw/~gzqbyr/styles/
*
* @package language
* @version $Id: viewforum.php,v 1.11 2006/05/30 16:50:06 acydburn Exp $
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

$lang = array_merge($lang, array(
	'ACTIVE_TOPICS'			=> '活跃的主题',
	'ANNOUNCEMENTS'			=> '公告',
	
	'ICON_ANNOUNCEMENT'		=> '公告',
	'ICON_STICKY'			=> '置顶',

	'LOGIN_NOTIFY_FORUM'	=> '您已被通知这个版面, 请登入后再检视.',

	'MARK_TOPICS_READ'		=> '将所有主题标示为已阅读',
	'MOVED_TOPIC'			=> '被移动的主题',

	'NEW_POSTS_HOT'			=> '新文章 [ 热门 ]',
	'NEW_POSTS_LOCKED'		=> '新文章 [ 锁定 ]',
	'NO_NEW_POSTS_HOT'		=> '没有新文章 [ 热门 ]',
	'NO_NEW_POSTS_LOCKED'	=> '没有新文章 [ 锁定 ]',

	'POST_FORUM_LOCKED'		=> '版面被锁定',

	'TOPICS_MARKED'			=> '这版面的所有主题已被标示为已阅读',

	'VIEW_FORUM'			=> '检视版面',
	'VIEW_FORUM_TOPIC'		=> '1 篇主题',
	'VIEW_FORUM_TOPICS'		=> '%d 篇主题',
));

?>