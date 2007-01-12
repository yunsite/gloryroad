<?php
/** 
*
* viewtopic [中文] :: CRLin - http://web.dhjh.tcc.edu.tw/~gzqbyr/styles/
*
* @package language
* @version $Id: viewtopic.php,v 1.9 2006/06/17 12:16:56 naderman Exp $
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
	'ATTACHMENT'						=> '附加档案',
	'ATTACHMENT_FUNCTIONALITY_DISABLED'	=> '附加档案已关闭',

	'BOOKMARK_ADDED'		=> '主题加入书签成功.',
	'BOOKMARK_REMOVED'		=> '完成移除书签内主题.',
	'BOOKMARK_TOPIC'		=> '主题加入书签',
	'BOOKMARK_TOPIC_REMOVE'	=> '由书签移除',
	'BUMPED_BY'				=> '最后由 %1$s 取代 %2$s',
	'BUMP_TOPIC'			=> '取代主题',

	'CODE'					=> 'Code',

	'DELETE_TOPIC'			=> '删除主题',
	'DOWNLOAD_NOTICE'		=> '您无权检视文章的附加档案.',

	'EDITED_TIMES_TOTAL'	=> ' %1$s 在 %2$s 作了 %3$d 次修改',
	'EDITED_TIME_TOTAL'		=> ' %1$s 在 %2$s 作了 %3$d 次修改',

	'EMAIL_TOPIC'			=> '发信给好友',
	'ERROR_NO_ATTACHMENT'	=> '所选的附加档案已不存在',

	'FILE_NOT_FOUND_404'	=> '档案 <strong>%s</strong> 不存在.',
	'FORK_TOPIC'			=> '复制主题',

	'LINKAGE_FORBIDDEN'		=> '您无权检视, 由(或至)这网站下载或连结.',
	'LOGIN_NOTIFY_TOPIC'	=> '您已被通知这篇主题, 请登入后再检视..',
	'LOGIN_VIEWTOPIC'		=> '系统管理员要求只有注册会员登入后才可以检视这篇主题.',

	'MAKE_ANNOUNCE'				=> '更改为公告',
	'MAKE_GLOBAL'				=> '更改为全区公告',
	'MAKE_NORMAL'				=> '更改为正常主题',
	'MAKE_STICKY'				=> '更改为置顶',
	'MAX_OPTIONS_SELECT'		=> '您可以选择 <strong>%d</strong> 个项目',
	'MAX_OPTION_SELECT'			=> '您可以选择 <strong>1</strong> 个项目',
	'MISSING_INLINE_ATTACHMENT'	=> '附加档案 <strong>%s</strong> 不可再用',
	'MOVE_TOPIC'				=> '移动主题',

	'NO_ATTACHMENT_SELECTED'=> '您没选择附加档案以便下载或检视.',
	'NO_NEWER_TOPICS'		=> '此版面没有新主题',
	'NO_OLDER_TOPICS'		=> '此版面没有旧主题',
	'NO_UNREAD_POSTS'		=> '此主题没有未阅读的文章.',
	'NO_VOTE_OPTION'		=> '票选时至少须一个选项.',

	'POLL_RUN_TILL'			=> '票选执行至 %s',
	'POLL_VOTED_OPTION'		=> '您票选了此选项',
	'POST_ENCODING'			=> '这篇文章由 <strong>%1$s</strong> 所发表与您的语系编码不同. 请单击 %2$s这里%3$s 以合适的编码来检视.',
	'PRINT_TOPIC'			=> '预览列印',

	'QUICK_MOD'				=> '快速版面管理',
	'QUOTE'					=> '引言',

	'REPLY_TO_TOPIC'		=> '回覆主题',
	'RETURN_POST'			=> '%s返回至文章%s',

	'SUBMIT_VOTE'			=> '送出投票',

	'TOTAL_VOTES'			=> '总票选数',

	'UNLOCK_TOPIC'			=> '主题解锁',

	'VIEW_INFO'				=> '发表细节',
	'VIEW_NEXT_TOPIC'		=> '下一篇主题',
	'VIEW_PREVIOUS_TOPIC'	=> '上一篇主题',
	'VIEW_RESULTS'			=> '观看票选结果',
	'VIEW_TOPIC_POST'		=> '1 篇文章',
	'VIEW_TOPIC_POSTS'		=> '%d 篇文章',
	'VIEW_UNREAD_POST'		=> '第1篇未阅读的文章',
	'VISIT_WEBSITE'			=> 'WWW',
	'VOTE_SUBMITTED'		=> '您已票选过',

	'WROTE'					=> '写入',
));

?>