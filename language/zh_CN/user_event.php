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
	'NO_ENOUGH_ACTIVITY'			=> '您太疲劳了，请休息一会吧',
	'SUCCEED_OPEN_UP_WASTELAND'		=> '平整了一块新的土地，',
	'SUCCEED_ADD_RICE'				=> '耕种获得了丰收，',
	'COST_ACTIVITY'					=> '耗费了您%d点精力',
	'GET_EXP'						=> '获得 %d 点经验值',
	'SUCCEED_ENTIRONMENT'			=> '环境得到大幅度的改善,',
	'SUCCEED_ADD_CCOIN'				=> '获得了%d枚铜币，',
	'SUCCEED_ACTIVITY'				=> '您太疲劳了，请休息一会吧',
	'NO_LICENSE'					=> '您没有相关工作的许可证',
	'RESIDUAL'                      => '剩余',
	'HOUR'                          => '小时',
	'MINUTE'                        => '分钟',
	'FOREVER'                       => '永久',
	'EVENT_1'						=> '开荒',
	'EVENT_1_DESC'					=> '开荒是每个伊莎特纳弗大陆玩家的义务工作，不能获得任何的奖励，只能获得一定的贡献值。',
	'EVENT_2'						=> '耕种',
	'EVENT_2_DESC'					=> '耕种可以使城市获得更多的粮食，只有更多的粮食，城市才能吸引更多的人。',
	'EVENT_3'						=> '环境改造',
	'EVENT_3_DESC'					=> '被破坏的环境只有不断的改造，保护才能维持城市的发展。<br /><br />',
	'EVENT_4'						=> '狩猎',
	'EVENT_4_DESC'					=> '被破坏的环境只有不断的改造，保护才能维持城市的发展。<br /><br />',
	'EVENT_5'						=> '开矿',
    'EVENT_5_DESC'					=> '被破坏的环境只有不断的改造，保护才能维持城市的发展。<br /><br />',
	'EVENT_ROAD'					=> '修路',

	)
);