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
	'LOGIN_EXPLAIN_UCP'	=> '请登入后再操作用户面板',
	'OCCUPATION_AUTHENTICATION'		    => '职业认证',
	'SKILL_STUDY'        => '技能学习',
	'SKILL_TECH'         => '技能研究',
	'JOB_APPRAISAL'      => '职业鉴定',
	'SKILL_USE'          => array(
				'306'=>'材料制作',
	),
	'SELECT_DO'=>'选择要制作的物品',
	'OBJECT_BOOK'=>'制作卷',
	'PLEASE_SELECT'=>'选择要制作的物品',
	'OB_COST'=>'每件制作成本',
	'MAX_DO'=>'最大制作数量',
	'DO_NUM'=>'制作数量',
	'START_DO'=>'开始制作',
	'GOTO_MAIN'=>'返回大厅',
	'MAXCOUNT'=>'计算最大制作数量',
	'SKILL_LEVEL'        => '等级',
	'NOT_THIS_BUILD_OPEN'     => '该建筑未对外开放，请过些时候再来吧。',
	'YOU_NOT_THIS_CITY'      =>'你并未在这个城市中',
	'STUDY_SKILL_SUCESS'     =>'您成功学习了技能',
	)
);