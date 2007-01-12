<?php
/** 
*
* acp_ban [中文] :: CRLin - http://web.dhjh.tcc.edu.tw/~gzqbyr/styles/
*
* @package language
* @version $Id: ban.php,v 1.4 2006/06/16 23:20:32 acydburn Exp $
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

// Banning
$lang = array_merge($lang, array(
	'1_HOUR'		=> '1 小时',
	'30_MINS'		=> '30 分钟',
	'6_HOURS'		=> '6 小时',

	'ACP_BAN_EXPLAIN'	=> '这里您可以控制封锁用户的名称, IP 或 电子邮件位址. 这些方法能够封锁用户访问系统任何地方. 您也可以给封锁用户一个简短的 (255 个字元) 理由. 被封锁的用户将显示在管理面板中. 您也可以指定一个封锁的时间. 如果您想自定义封锁时间, 您可以使用 <u>一直到</u> 作为封锁时间并输入日期, 格式为 yyyy-mm-dd.',

	'BAN_EXCLUDE'			=> '由封锁者排除',
	'BAN_LENGTH'			=> '封锁时间',
	'BAN_REASON'			=> '封锁的理由',
	'BAN_GIVE_REASON'		=> '显示被封锁的理由',
	'BAN_UPDATE_SUCCESSFUL'	=> '封锁名册已经成功更新',

	'EMAIL_BAN'					=> '封锁一个或多个电子邮件位址',
	'EMAIL_BAN_EXCLUDE_EXPLAIN'	=> '启用这项, 可由所有封锁者排除输入的电子邮件位址.',
	'EMAIL_BAN_EXPLAIN'			=> '您可以藉由每一新行输入电子邮件位址以封锁多个电子邮件位址. 匹配部分位址请使用万用字元 * , 例如：*@hotmail.com, *@*.domain.tld, 等等.',
	'EMAIL_NO_BANNED'			=> '没有被封锁的电子邮件位址',
	'EMAIL_UNBAN'				=> '解除封锁或解除排除电子邮件位址',
	'EMAIL_UNBAN_EXPLAIN'		=> '配合使用滑鼠和键盘您可以解除封锁或者解除排除多个电子邮件位址. 拒绝的电子邮件位址有灰色背景.',

	'IP_BAN'					=> '封锁一个或多个 IP',
	'IP_BAN_EXCLUDE_EXPLAIN'	=> '启用这项, 可由所有封锁者排除输入的 IP.',
	'IP_BAN_EXPLAIN'			=> '您可以藉由每一新行输入 IP或主机名 以封锁多个 IP. 要指定 IP 位址的范围, 请使用 - 来分隔起始及结束位址, 或是使用万用字元 *',
	'IP_HOSTNAME'				=> 'IP 位址或主机名',
	'IP_NO_BANNED'				=> '没有被封锁的 IP 位址',
	'IP_UNBAN'					=> '解除封锁或解除排除 IP 位址',
	'IP_UNBAN_EXPLAIN'			=> '配合使用滑鼠和键盘您可以解除封锁或者解除排除多个 IP 位址. 拒绝的 IP 位址有灰色背景.',

	'PERMANENT'		=> '永久',
	
	'UNTIL'						=> '一直到',
	'USER_BAN'					=> '封锁一个或多个用户名',
	'USER_BAN_EXCLUDE_EXPLAIN'	=> '启用这项, 可由所有封锁者排除输入的用户.',
	'USER_BAN_EXPLAIN'			=> '您可以藉由每一新行输入用户名以封锁多个用户. 使用 <u>搜寻用户名</u> 方便地搜寻和增加多个用户.',
	'USER_NO_BANNED'			=> '没有用户被封锁',
	'USER_UNBAN'				=> '解除封锁或者解除排除用户',
	'USER_UNBAN_EXPLAIN'		=> '配合使用滑鼠和键盘您可以解除封锁或者解除排除多个用户. 拒绝的用户有灰色背景.',
));

?>