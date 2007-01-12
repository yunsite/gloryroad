<?php
/** 
*
* groups [中文] :: CRLin - http://web.dhjh.tcc.edu.tw/~gzqbyr/styles/
*
* @package language
* @version $Id: groups.php,v 1.12 2006/06/17 11:28:21 acydburn Exp $
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
	'ALREADY_DEFAULT_GROUP'	=> '所选群组已是您的内定群组',
	'ALREADY_IN_GROUP'		=> '您已是所选群组的会员',

	'CHANGED_DEFAULT_GROUP'	=> '更改内定群组成功',
	
	'GROUP_AVATAR'			=> '群组图像', 
	'GROUP_CHANGE_DEFAULT'	=> '您确定要更改群组 "%s" 的内定会员?',
	'GROUP_CLOSED'			=> '关闭',
	'GROUP_DESC'			=> '群组描述',
	'GROUP_HIDDEN'			=> '隐藏',
	'GROUP_INFORMATION'		=> '群组资讯',
	'GROUP_IS_CLOSED'		=> '这是个封闭群组, 新会员不能自动加入.',
	'GROUP_IS_FREE'			=> '这是个自由开放群组, 所有会员皆欢迎加入.', 
	'GROUP_IS_HIDDEN'		=> '这是个隐藏群组, 只有会员才能检视会员资料.',
	'GROUP_IS_OPEN'			=> '这是个开放群组, 会员可以自动加入.',
	'GROUP_IS_SPECIAL'		=> '这是个特殊群组, 特殊群组只能由系统管理员处理.',
	'GROUP_JOIN'			=> '加入群组',
	'GROUP_JOIN_CONFIRM'	=> '您确定要加入所选群组?',
	'GROUP_JOIN_PENDING'	=> '请求加入群组',
	'GROUP_JOIN_PENDING_CONFIRM'	=> '您确定请求加入所选群组?',
	'GROUP_JOINED'			=> '加入所选群组成功', 
	'GROUP_JOINED_PENDING'	=> '要成功加入群组的会员. 请等候群组组长的核准.',
	'GROUP_LIST'			=> '管理用户',
	'GROUP_MEMBERS'			=> '群组会员',
	'GROUP_NAME'			=> '群组名称',
	'GROUP_OPEN'			=> '开放',
	'GROUP_RANK'			=> '群组等级',
	'GROUP_RESIGN_MEMBERSHIP'		=> '辞去群组会员',
	'GROUP_RESIGN_MEMBERSHIP_CONFIRM'	=> '您确定由所选群组辞去群组会员?',
	'GROUP_RESIGN_PENDING'			=> '辞去未定的群组会员',
	'GROUP_RESIGN_PENDING_CONFIRM'	=> '您确定由所选群组辞去未定的群组会员?',
	'GROUP_RESIGNED_MEMBERSHIP'		=> '移除您所选群组的会员成功',
	'GROUP_RESIGNED_PENDING'		=> '移除您所选群组的未定会员成功',
	'GROUP_TYPE'					=> '群组型式',
	'GROUP_UNDISCLOSED'				=> '隐藏群组',

	'LOGIN_EXPLAIN_GROUP'	=> '您必须登入才能检视群组详情',

	'NO_LEADERS'					=> '您非任一群组之组长',
	'NOT_LEADER_OF_GROUP'	=> '要求的作用不能执行因为您不是所选群组的组长.',
	'NOT_MEMBER_OF_GROUP'	=> '要求的作用不能执行因为您不是所选群组的组员.',
	'NOT_RESIGN_FROM_DEFAULT_GROUP'	=> '您不被允许辞去内定群组组员.',
	
	'PRIMARY_GROUP'		=> '主要的群组',

	'REMOVE_SELECTED'		=> '移除所选',

	'USER_GROUP_CHANGE'			=> '由群组 "%1$s" 至群组 "%2$s"',
	'USER_GROUP_DEMOTE'			=> '降级群组组长',
	'USER_GROUP_DEMOTE_CONFIRM'	=> '您确定由所选群组降级组长?',
	'USER_GROUP_DEMOTED'		=> '降级组长成功.',
));

?>