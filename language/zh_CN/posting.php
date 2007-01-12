<?php
/** 
*
* posting [中文] :: CRLin - http://web.dhjh.tcc.edu.tw/~gzqbyr/styles/
*
* @package language
* @version $Id: posting.php,v 1.33 2006/06/16 16:54:44 acydburn Exp $
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
	'ADD_ATTACHMENT'			=> '附加档案上传',
	'ADD_ATTACHMENT_EXPLAIN'	=> '如果您要附加一或多个档案请填底下表单',
	'ADD_FILE'					=> '增加档案',
	'ADD_POLL'					=> '票选活动',
	'ADD_POLL_EXPLAIN'			=> '如果您不想设置票选功能, 请将此处留白',
	'ALREADY_DELETED'			=> '抱歉这篇讯息已删除.',
	'ATTACH_QUOTA_REACHED'		=> '抱歉, 系统附加档案的配合已满.',
	'ATTACH_SIG'				=> '附加签名 (签名可由 UCP 更改)',

	'BBCODE_A_HELP'				=> '关闭所有的 BBCode 标签',
	'BBCODE_B_HELP'				=> '粗体: [b]text[/b]  (alt+b)',
	'BBCODE_C_HELP'				=> '显示代码: [code]code[/code]  (alt+c)',
	'BBCODE_E_HELP'				=> '排列: 增加排列项目',
	'BBCODE_F_HELP'				=> '字型大小: [size=x-small]small text[/size]',
	'BBCODE_IS_OFF'				=> '%sBBCode%s 代码 <em>关闭</em>',
	'BBCODE_IS_ON'				=> '%sBBCode%s 代码 <em>开启</em>',
	'BBCODE_I_HELP'				=> '斜体: [i]text[/i]  (alt+i)',
	'BBCODE_L_HELP'				=> '排列: [list]text[/list]  (alt+l)',
	'BBCODE_O_HELP'				=> '依序排列: [list=]text[/list]  (alt+o)',
	'BBCODE_P_HELP'				=> '插入图片: [img]http://image_url[/img]  (alt+p)',
	'BBCODE_Q_HELP'				=> '引言回覆: [quote]text[/quote]  (alt+q)',
	'BBCODE_S_HELP'				=> '字型颜色: [color=red]text[/color] 提示: 您也可以使用颜色编码 color=#FF0000',
	'BBCODE_U_HELP'				=> '底线: [u]text[/u]  (alt+u)',
	'BBCODE_W_HELP'				=> '插入 URL: [url]http://url[/url] 或 [url=http://url]URL text[/url]  (alt+w)',
	'BUMP_ERROR'				=> '您不可以在上次发表后没多久就取代主题.',

	'CANNOT_DELETE_REPLIED'		=> '抱歉您只能删除没人回应的文章.',
	'CANNOT_EDIT_POST_LOCKED'	=> '文章已被锁住. 您不可以再编辑.',
	'CANNOT_EDIT_TIME'			=> '您不可以再编辑或删除那篇文章',
	'CANNOT_POST_ANNOUNCE'		=> '抱歉您不可以发布公告.',
	'CANNOT_POST_NEWS'			=> '抱歉您不可以发布新主题.',
	'CANNOT_POST_STICKY'		=> '抱歉您不可以发布置顶主题.',
	'CHANGE_TOPIC_TO'			=> '更改主题型式为',
	'CLOSE_TAGS'				=> '关闭标签',
	'CURRENT_TOPIC'				=> '目前主题',

	'DELETE_FILE'				=> '删除档案',
	'DELETE_MESSAGE'			=> '删除讯息',
	'DELETE_MESSAGE_CONFIRM'	=> '您确定要删除这篇讯息?',
	'DELETE_OWN_POSTS'			=> '抱歉您只能删除自己的文章.',
	'DELETE_POST_CONFIRM'		=> '您确定要删除这篇讯息?',
	'DELETE_POST_WARN'			=> '文章一经删除就不能恢复',
	'DISABLE_BBCODE'			=> '关闭 BBCode',
	'DISABLE_MAGIC_URL'			=> '无法自动分析 URL',
	'DISABLE_SMILIES'			=> '关闭表情符号',
	'DISALLOWED_EXTENSION'		=> '不允许的副档名 %s',
	'DRAFT_LOADED'				=> '草稿载至发表区, 您现在可以完成发表.<br />草稿在发表文章后就被删除.',
	'DRAFT_SAVED'				=> '草稿保存成功.',
	'DRAFT_TITLE'				=> '草稿标题',

	'EDIT_REASON'				=> '编辑这篇文章的原因',
	'EMPTY_FILEUPLOAD'			=> '上传空白档案',
	'EMPTY_MESSAGE'				=> '发表时须有内容.',
	'EMPTY_REMOTE_DATA'			=> '无法上传档案, 请尝试手动上传.',

	'FLASH_IS_OFF'				=> '[flash] <em>关闭</em>',
	'FLASH_IS_ON'				=> '[flash] <em>开启</em>',
	'FLOOD_ERROR'				=> '您不可以在上次发表后没多久就再发表.',
	'FONT_COLOR'				=> '字型颜色',
	'FONT_HUGE'					=> '极大',
	'FONT_LARGE'				=> '大',
	'FONT_NORMAL'				=> '一般',
	'FONT_SIZE'					=> '字型大小',
	'FONT_SMALL'				=> '小',
	'FONT_TINY'					=> '极小',

	'GENERAL_UPLOAD_ERROR'		=> '无法上传附加档案至 %s',

	'IMAGES_ARE_OFF'			=> '[img] 插图 <em>关闭</em>',
	'IMAGES_ARE_ON'				=> '[img] 插图 <em>开启</em>',
	'INVALID_FILENAME'			=> '%s 是无效档名',

	'LOAD'						=> '载入',
	'LOAD_DRAFT'				=> '载入草稿',
	'LOAD_DRAFT_EXPLAIN'		=> '您能够在这里选择您要继续编写的草稿. 您目前的文章将被取消, 所有目前的文章内容将被删除. 在您的"用户控制面板"检视, 编辑与删除草稿.',
	'LOGIN_EXPLAIN_POST'		=> '您必须登入后才可在这个版面发表文章',
	'LOGIN_EXPLAIN_REPLY'		=> '您必须登入后才可在这个版面回覆文章',

	'MAX_FONT_SIZE_EXCEEDED'	=> '您能使用的字型大小最多是 %1$d.',
	'MAX_FLASH_HEIGHT_EXCEEDED'	=> '您的 flash 档最多只能是 %1$d 像素高.',
	'MAX_FLASH_WIDTH_EXCEEDED'	=> '您的 flash 档最多只能是 %1$d 像素宽.',
	'MAX_IMG_HEIGHT_EXCEEDED'	=> '您的图形档最多只能是 %1$d 像素高.',
	'MAX_IMG_WIDTH_EXCEEDED'	=> '您的图形档最多只能是 %1$d 像素宽.',

	'MESSAGE_BODY_EXPLAIN'		=> '在这里输入您的文章内容, 最多不超过 <strong>%d</strong> 字元.',
	'MESSAGE_DELETED'			=> '您的文章已成功删除',
	'MORE_SMILIES'				=> '检视更多表情符号',

	'NOTIFY_REPLY'				=> '当有人回覆文章时通知我',
	'NOT_UPLOADED'				=> '无法上传档案.',
	'NO_DELETE_POLL_OPTIONS'	=> '您不可以删除现存的票选项目',
	'NO_POLL_TITLE'				=> '须有票选主题',
	'NO_POST'					=> '请求的文章不存在.',
	'NO_POST_MODE'				=> '没有指定的文章模式',

	'PARTIAL_UPLOAD'			=> '上传档案只能部分上传',
	'PHP_SIZE_NA'				=> '附加档案的大小过大.<br />不能超出由 PHP 于 php.ini 规定的最大长度.',
	'PHP_SIZE_OVERRUN'			=> '附加档案的大小过大, 最大上传的大小: %d MB.<br />请注意这是定义在 php.ini 不能更改.',
	'PLACE_INLINE'				=> '线上显示',
	'POLL_DELETE'				=> '删除票选',
	'POLL_FOR'					=> '票选期限',
	'POLL_FOR_EXPLAIN'			=> '输入 0 或是空白为没有限期的票选活动 ',
	'POLL_MAX_OPTIONS'			=> '每位用户项目数',
	'POLL_MAX_OPTIONS_EXPLAIN'	=> '用户票选时可选择的项目数.',
	'POLL_OPTIONS'				=> '票选项目',
	'POLL_OPTIONS_EXPLAIN'		=> '每一项目不要在同一行. 最多可以 <strong>%d</strong> 个项目',
	'POLL_QUESTION'				=> '票选主题',
	'POLL_VOTE_CHANGE'			=> '允许更改票选',
	'POLL_VOTE_CHANGE_EXPLAIN'	=> '如果勾取则用户可更改票选结果.',
	'POSTED_ATTACHMENTS'		=> '发表附加档案清单',
	'POST_CONFIRMATION'			=> '验证发表',
	'POST_CONFIRM_EXPLAIN'		=> '为防止自动发表, 系统管理员要求您输入确认代码. 确认代码是您所看到的图片中的字母或数字. 如果您有视觉的障碍或无法观看代码，请联络 %s系统管理员%s 寻求协助.',
	'POST_DELETED'				=> '您的文章已成功删除',
	'POST_EDITED'				=> '您的文章已修改成功',
	'POST_EDITED_MOD'			=> '您的文章已修改但须待核准',
	'POST_GLOBAL'				=> '全区公告',
	'POST_ICON'					=> '文章图示',
	'POST_NORMAL'				=> '正常',
	'POST_REPLY'				=> '回覆主题',
	'POST_REVIEW'				=> '检视回覆',
	'POST_REVIEW_EXPLAIN'		=> '这篇主题至少有一新发表文章. You may wish to review your post in light of this.',
	'POST_STORED'				=> '文章发表完成',
	'POST_STORED_MOD'			=> '您的文章已保存但须核准',
	'POST_TOPIC'				=> '发表新主题',
	'POST_TOPIC_AS'				=> '发表主题为',
	'PROGRESS_BAR'				=> '进展长条图',

	'QUOTE_DEPTH_EXCEEDED'		=> '您只可插入 %1$d 个引言于交互的引言内.',

	'SAVE'						=> '保存',
	'SAVE_DATE'					=> '保存于',
	'SAVE_DRAFT'				=> '保存草稿',
	'SAVE_DRAFT_CONFIRM'		=> '请注意保存草稿只含主题及内容, 其它项目不受理. 您现在要保存草稿吗?',
	'SMILIES'					=> '表情符号',
	'SMILIES_ARE_OFF'			=> '表情符号 <em>关闭</em>',
	'SMILIES_ARE_ON'			=> '表情符号 <em>开启</em>',
	'STICKY_ANNOUNCE_TIME_LIMIT'=> '置顶/公告 期限',
	'STICK_TOPIC_FOR'			=> '置顶主题设定',
	'STICK_TOPIC_FOR_EXPLAIN'	=> '输入 0 或空白为没有限期的置顶/公告',
	'STYLES_TIP'				=> '提示: 格式可以快速套用在选择的文字上',

	'TOO_FEW_CHARS'				=> '文章内容过少.',
	'TOO_FEW_POLL_OPTIONS'		=> '您至少需要输入两个票选的项目',
	'TOO_MANY_ATTACHMENTS'		=> '不能增加其它的附加档案, %d 已是最大.',
	'TOO_MANY_CHARS'			=> '文章内容过多.',
	'TOO_MANY_POLL_OPTIONS'		=> '您的票选项目太多了',
	'TOO_MANY_SMILIES'			=> '文章内容过多表情符号. 允许最多只能 %d 个表情符号.',
	'TOO_MANY_URLS'				=> '文章内容太多 URL. 允许最多只能 %d 个 URL.',
	'TOO_MANY_USER_OPTIONS'		=> '您的票选项目太多了',
	'TOPIC_BUMPED'				=> '主题被取代成功',

	'UNABLE_GET_IMAGE_SIZE'		=> '无法读取图形或档案是无效的图片.',
	'UNAUTHORISED_BBCODE'		=> '您不可以使用某些 BBCode 代码: ',
	'UNGLOBALISE_EXPLAIN'		=> '将全区公告的主题改为正常, 您须选择版面以显示这篇主题',
	'UPDATE_COMMENT'			=> '更改注解',
	'URL_INVALID'				=> '指定的 URL 无效.',
	'URL_NOT_FOUND'				=> '找不到指定的档案.',
	'USER_CANNOT_BUMP'			=> '您不可以在这个版面取代已有的主题',
	'USER_CANNOT_DELETE'		=> '您不可以在这个版面删除文章',
	'USER_CANNOT_EDIT'			=> '您不可以在这个版面编辑文章',
	'USER_CANNOT_REPLY'			=> '您不可以在这个版面回覆文章',
	'USER_CANNOT_FORUM_POST'	=> '您不可以在这个版面发表因为版面类型不支援.',
	'USERNAME_DISALLOWED'		=> '您输入的用户名已被禁用.',
	'USERNAME_TAKEN'			=> '您输入的用户名已被使用, 请重新输入另一个.',

	'VIEW_MESSAGE'				=> '%s检视您所发表的文章%s',

	'WRONG_FILESIZE'			=> '档案过大, 最大尺寸是 %1d %2s',
	'WRONG_SIZE'				=> '图形最少是 %1$d 像素宽, %2$d 像素高且最多是 %3$d 像素宽与 %4$d 像素高. 上传的图形是 %5$d 像素宽与 %6$d 像素高.',
));

?>