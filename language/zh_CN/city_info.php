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
	'ERROR_CITYID'					=> '该城市不存在。',
	'SUCCEED_ACTIVITY'				=> '您太疲劳了，请休息一会吧',
	'BUILD_TO_CITY'					=> '修建至%s的道路',
	'ROAD_LEVEL'					=> '道路等级',
	'BUILD_DATE'					=> '修建日期',
	'CITY_OUTSIDE'                  => '城外',
	'COME_IN_CITY'                  => '进城',
	'CITY_INFO'                     => '城市信息',
	'CITY_HALL'                     => '市政厅',
	'CITY_BANK'                     => '城市银行',
	'CITY_HOSPITAL'                 => '城市医院',
	'CIVI_OBJECT'                   => '市政项目',
	'CITY_BUILD'                    => '城市建筑',
	'CASTELLAN_PLACARD'             => '城市公告',
	'CITY_BUILD_INFO'               => '城市建筑信息',
	'CASTELLAN_PLACARD_C'             => '以热爱祖国为荣<br />以危害祖国为耻<br />以服务人民为荣<br />以背离人民为耻<br /> 
										以崇尚科学为荣<br />以愚昧无知为耻<br />以辛勤劳动为荣<br />以好逸恶劳为耻<br />以团结互助为荣<br />以损人利己为耻<br />以诚实守信为荣<br />以见利忘义为耻<br />以遵纪守法为荣<br />以违法乱纪为耻<br />以艰苦奋斗为荣<br />以骄奢淫逸为耻<br /> 
										',
	'LICENSE_BUY'                   => '许可证购买',
	'START_BUY_LICENSE'             => '开始购买许可证,请稍等.',
	'NO_ONTHISCITY'                 => '无法购买其它城市的许可',
	'NO_ALLOWLICENSE'               => '授权许可证已经卖完,下次赶早吧',
	'NO_SOMELICENSE'                => '您现在拥有未过期的许可,请不要重复购买许可',
	'LICENSE_SUSSES'                => '许可购买成功!',
	'GOTO_ALL'                      => '返回政务大厅',
	'ROAD_BUILD'                    => '道路修建',
	'CITY_CONTRAVALLATION'			=> '城市防御',
	'CITY_LEVEL'					=> '城市级别',
	'WORK_LICENSE'                  => '工作许可证',
	'BUILDNOW'                      => '修建',
	'YOU_NOWHAVE'                   => '您现在拥有了',
	'CITY_LEVEL_V'                  => array(
		'1'	=>'村庄',
		'2' =>'小镇',
		'3' =>'小城',
		'4' =>'中等城市',
		'5' =>'大型城市',
		'6' =>'大型都市',
	
	),
	'CITY_BUILD_V'                  => array(
		'1' =>'武器店',
		'2' =>'装备店',
		'3' =>'魔法用具店',
		'4' =>'杂货店',
		'5' =>'裁缝店',
		'6' =>'食品店',
		'7' =>'药品店',
		'8' =>'铁匠铺',
		'9' =>'工匠店',
		'10' =>'诊所',
		'11' =>'拍卖店',
		'201'	=>'帐篷',
		'202' =>'木房',
		'203' =>'土房',
		'204' =>'砖房',
		'205' =>'平房',
		'206' =>'公寓',
		'207' =>'高级公寓',
		'208' =>'别墅',
		'209' =>'庄园',
		'210' =>'城堡',
		'306' =>'工匠公会',
		'501' =>'武器店',
		'502' =>'装备店',
		'503' =>'魔法用具店',
		'504' =>'杂货店',
		'505' =>'裁缝店',
		'506' =>'食品店',
		'507' =>'药品店',
		'508' =>'铁匠铺',
		'509' =>'工匠店',
		'510' =>'诊所',
		'511' =>'拍卖店',
	),

	'UNKNOW'						=> '未知',
	'PRICE'							=> '价格',
	'LEVEL'							=> '等级',
	'TO_CITY'						=> '通向',
	'MAGIC_REC'						=> '魔法防御阵',
	'ALL_RIGHT'						=> '良好',
	'DANGER'						=> '危险',
	'NO_VALUE'						=> '无',
	'CITY_POPULATION'				=> '城市人口',
	'CREATE_DATE'					=> '建立日期',
	'CITY_XY'						=> '城市位置',
	'HOMELAND'						=> '本国',
	'FREMDNESS'						=> '外国',
	'CITY_PLACE'					=> '城市中心广场',
	'UPTOWN_BUILD_APP'				=> '居住建筑许可证',
	'SOWNTOWN_BUILD_APP'			=> '商业建筑许可证',
	'BUILD_APPLY'					=> '建筑申请',
	'UPTOWN'						=> '居住区',
	'SOWNTOWN'						=> '商业区',
	'ZONE_NO_OWNER'                 => '该块土地出售中，购买请到市政厅联系购买。',
	'ZONE_NO_OWNERDESC'             => '这是一块空白土地。',
	'ZONE_PRICE'                    => '土地价格',
	'ZONE_AREA'                     => '土地面积',
	'ZONE_NUM'                      => '号',
	'ZONE_ALL_SELL'                 => '该块土地已经售出,不久就会出现一个新的建筑.',
	'ZONE_SELL_DESC'                => '一个神秘的买家购买了这块土地.',
	'ZONE_CONS'                     => '正在建设中.',
	'ZONE_CONS_DESC'                => '这里是一片工地.',
	'ZONE_CONING'                   => '工地正在火热的建设中,不久就能建好了',
	'BUILT_TIME'                    => '剩余时间',
	'CITY_BUILD_LV'                 => '城市建筑等级',
	'BUILD_TYPE'                    => '建筑类别',
	'BUILD_STATE'                   => '建筑状态',
	'BUILD_LEVEL'                   =>'建筑等级'

	)
);
