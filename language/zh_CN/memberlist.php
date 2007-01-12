<?php
/** 
*
* memberlist [中文] :: CRLin - http://web.dhjh.tcc.edu.tw/~gzqbyr/styles/
*
* @package language
* @version $Id: memberlist.php,v 1.17 2006/06/01 13:47:42 acydburn Exp $
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
	'ABOUT_USER'			=> '个人资料',
	'ACTIVE_IN_FORUM'		=> '最活跃的版面',
	'ACTIVE_IN_TOPIC'		=> '最活跃的主题',
	'ADD_FOE'				=> '增加损友',
	'ADD_FRIEND'			=> '增加益友',
	'AFTER'					=> '之后',
	'AIM'					=> 'AIM',

	'BEFORE'				=> '之前',

	'CC_EMAIL'				=> '发送一个邮件备份给自己',
	'CONTACT_USER'			=> '联系',

	'DEST_LANG'				=> '语系',
	'DEST_LANG_EXPLAIN'		=> '选择一个合适的语系(如果可用)来接收邮件.',

	'EMAIL_BODY_EXPLAIN'	=> '这封邮件只能以纯文字寄送, 不可使用 HTML 或 BBCode. 回覆邮件的电子信箱是您的信箱位址.',
	'EMAIL_DISABLED'		=> '抱歉全部的邮寄功能已关闭.',
	'EMAIL_SENT'			=> '电子邮件已寄送.',
	'EMAIL_TOPIC_EXPLAIN'	=> '这封邮件将以纯文字寄送, 不可使用 HTML 或 BBCode. 请注意主题资讯已含入邮件. 回覆邮件的电子信箱是您的信箱位址.',
	'EMPTY_ADDRESS_EMAIL'	=> '您必须提供有效的电子邮件位址以回覆邮件.',
	'EMPTY_MESSAGE_EMAIL'	=> '您必须输入邮件内容才能寄送.',
	'EMPTY_NAME_EMAIL'		=> '您必须输入回覆邮件的真实名子.',
	'EMPTY_SUBJECT_EMAIL'	=> '您必须指定电子邮件的主题.',
	'EQUAL_TO'				=> '等于',

	'FIND_USERNAME_EXPLAIN'	=> '利用这个表单搜寻指定的会员. 您不须填满所有栏位. 您可以使用 * 万用字元. 当输入日期可使用格式 yyyy-mm-dd, 例如: 2006-01-01. 使用核取方块选取一或多个用户(可由表单核取数个用户). 您可以核取用户或单击嵌入核取按钮.',
	'FLOOD_EMAIL_LIMIT'		=> '您不可以在此时邮寄另一电子邮件. 请稍后再试.',

	'GROUP_LEADER'			=> '群组组长',

	'HIDE_MEMBER_SEARCH'	=> '隐藏会员搜寻',

	'ICQ'					=> 'ICQ',
	'IM_ADD_CONTACT'		=> '增加联系',
	'IM_AIM'				=> '请注意您须要安装 AOL 即时通才可使用.',
	'IM_AIM_EXPRESS'		=> 'AIM 快递',
	'IM_DOWNLOAD_APP'		=> '下载申请',
	'IM_ICQ'				=> '请注意用户可选择不接受未经申请的即时通.',
	'IM_JABBER'				=> 'Please note that users may have selected to not receive unsolicited instant messages.',
	'IM_JABBER_SUBJECT'		=> '这是自动讯息请勿回覆! 由用户 %1$s 在 %2$s 发出',
	'IM_MESSAGE'			=> '您的讯息',
	'IM_MSNM'				=> '请注意您须要安装 Windows 即时通才可使用..',
	'IM_NAME'				=> '您的名字',
	'IM_NO_JABBER'			=> '抱歉, 本伺服器不支援 Jabber 用户直接即时通. 您须要一个 Jabber client 安装于您的系统以回覆上文.',
	'IM_RECIPIENT'			=> '回覆',
	'IM_SEND'				=> '发送讯息',
	'IM_SEND_MESSAGE'		=> '发送讯息',
	'IM_SENT_JABBER'		=> '您的讯息已成功发送至 %1$s .',
	'IM_USER'				=> '发送即时通',
	
	'JABBER'				=> 'Jabber',

	'LAST_ACTIVE'				=> '最后活跃的',
	'LESS_THAN'					=> '小于',
	'LIST_USER'					=> '1 位用户',
	'LIST_USERS'				=> '%d 位用户',
	'LOGIN_EXPLAIN_LEADERS'		=> '系统管理员要求您须先注册再登入才可检视团队列表.',
	'LOGIN_EXPLAIN_MEMBERLIST'	=> '系统管理员要求您须先注册再登入才可使用会员列表.',
	'LOGIN_EXPLAIN_SEARCHUSER'	=> '系统管理员要求您须先注册再登入才可搜寻用户.',
	'LOGIN_EXPLAIN_VIEWPROFILE'	=> '系统管理员要求您须先注册再登入才可检视个人资料.',

	'MORE_THAN'				=> '多于',
	'MSNM'					=> 'MSNM',

	'NO_EMAIL'				=> '您不允许寄送电邮给这位用户.',
	'NO_VIEW_USERS'			=> '您未获授权检视会员列表及个人资料.',

	'ORDER'					=> '顺序',

	'POST_IP'				=> '由 IP/domain 发表',

	'RANK'					=> '等级',
	'REAL_NAME'				=> '回覆名',
	'RECIPIENT'				=> '回覆',

	'SEARCH_USER_POSTS'		=> '查询用户发表的文章',
	'SELECT_MARKED'			=> '选择已标示的',
	'SELECT_SORT_METHOD'	=> '选择排序方式',
	'SEND_IM'				=> '即时通',
	'SEND_MESSAGE'			=> '私人讯息',
	'SORT_EMAIL'			=> '电子邮件',
	'SORT_LAST_ACTIVE'		=> '最后活跃',
	'SORT_POST_COUNT'		=> '文章总数',

	'USERNAME_BEGINS_WITH'	=> '用户名起始于',
	'USER_ADMIN'			=> '管理用户',
	'USER_FORUM'			=> '用户状况',
	'USER_ONLINE'			=> '在线',
	'USER_PRESENCE'			=> '出席论坛',

	'VIEWING_PROFILE'		=> '检视个人资料 - %s',
	'VISITED'				=> '最后访问',

	'WWW'					=> '网址',

	'YIM'					=> 'YIM',
));

?>