<?php
/** 
*
* acp_email [中文] :: CRLin - http://web.dhjh.tcc.edu.tw/~gzqbyr/styles/
*
* @package language
* @version $Id: email.php,v 1.3 2006/03/25 15:46:20 acydburn Exp $
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

// Bot settings
$lang = array_merge($lang, array(
	'ACP_MASS_EMAIL_EXPLAIN'		=> '这里您能发送电子邮件讯息给一位或所有用户或是特定的群组.  这封电子邮件将被寄送至系统管理员的电子邮件信箱, 并以密件副本的方式寄送给所有收件人. 如果收件人数过多, 系统需要较长的时间来执行这个动作, 请在讯息送出之后耐心等候, 切勿在程序完成之前停止网页动作.',
	'ALL_USERS'						=> '所有用户',

	'COMPOSE'				=> '组成',

	'EMAIL_SEND_ERROR'		=> '发送邮件时遇到一个或者多个错误. 请检查 %s错误日志%s 查看详细讯息.',
	'EMAIL_SENT'			=> '您的讯息已发出.',
	'EMAIL_SENT_QUEUE'		=> '您的消息正在等待发送.',

	'LOG_SESSION'			=> 'Log mail session to critical log',

	'SEND_IMMEDIATLY'		=> '直接发送',
	'SEND_TO_GROUP'			=> '收件群组',
	'SEND_TO_USERS'			=> '收件人',
	'SEND_TO_USERS_EXPLAIN'	=> '如果这里输入用户名则上面的收件群组就无效, 每个用户名必须新起一行.',
	
	'MAIL_HIGH_PRIORITY'	=> '高',
	'MAIL_LOW_PRIORITY'		=> '低',
	'MAIL_NORMAL_PRIORITY'	=> '正常',
	'MAIL_PRIORITY'			=> '邮件优先级别',
	'MASS_MESSAGE'			=> '内容',
	'MASS_MESSAGE_EXPLAIN'	=> '请注意您只能发送无格式的纯文字文件. 发送邮件前系统会移除所有标签.',
	
	'NO_EMAIL_MESSAGE'		=> '您必须输入内容.',
	'NO_EMAIL_SUBJECT'		=> '您的邮件必须有主题.',
));

?>