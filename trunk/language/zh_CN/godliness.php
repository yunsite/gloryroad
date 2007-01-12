<?php
/** 
*
* common [English]
*
* @package language
* @version $Id: common.php,v 1.66 2006/03/25 17:21:32 acydburn Exp $
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
	'GENERAL'		    => '角色属性',
	'USER_BAG'		    => '角色背包',
	'USER_JOB'			=> '角色职业',
	'USER_NAME'			=> '角色名字',
	'USER_ACTIVITY'		=> '精力值',
	'USER_WEIGHT'		=> '负重',
	'USER_HP'           => '生命值',
	'USER_MAGIC'        => '魔力值',
	'USER_BELIEF'       => '信仰',
	'USER_PHYLE'        => '种族',
	'USER_CREDIT'       => '声望',
	'USER_EXP'          => '经验',
	'ATT_NAME'          => '名称',
	'USER_LEVEL'        => '等级',
	'USER_CON'          =>'体质',
	'USER_STR'          =>'力量',
	'USER_DEX'          =>'敏捷',
	'USER_INT'          =>'智慧',
	'USER_CHA'          =>'魅力',
	'USER_WIS'          =>'感知',
	'GODLINESS'            => array(
		0=>'诗莉雅',
		1=>'萨莎',
		2=>'艾芬格',
		3=>'穆汗',
		4=>'依斯比',
		5=>'阿蒙达',
		6=>'祖夫',
		7=>'克伦比亚',
		8=>'西里克斯',
		9=>'邓莫尔',
		10=>'金克巴',
		11=>'布兰斯托'
		),
	)
);