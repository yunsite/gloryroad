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
	'SHOP_INFO'		    => '店铺信息',
	'OWNER_INFO'        => '管理者信息',
	'SHOP_STOCK'		=> '店铺采购',
	'SHOP_SELL'			=> '店铺销售',
	'USER_NAME'			=> '角色名字',
	'WELCOME_IN'        => '欢迎光临',
	'SHOP_BASEINFO'		=> '商店基本信息',
	'CREATE_TIME'       => '创建时间',
	'SHOP_TYPE'         => '店铺类型',
	'SHOP_LEVEL'        => '店铺等级',
	'SHOP_OWNER'        => '店铺老板',
	'SHOP_USER'         => '经营者',
	'SHOP_STATE'        => '店铺状态',
	'LEVEL'             => '级',
	'SHOPTYPE'    => array(
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
		),
	'SHOPSTATE'		 => array( 
			'0' => '建设中',
			'1' => '开业中',
			'2' => '关闭中',
		),	
	'GOODS_SELL_LIST'        => '出售物品列表',
	'GOODS_STOCK_LIST'       => '采购物品列表',
	'GOOD_NAME'              => '物品名称',
	'GOOD_UNIT_PRICE'        => '物品单价',
	'GOOD_SELL_STATISTIC'    => '商品统计',
	'GOOD_WEIGHT'            => '物品重量',
	'GOOD_PRICE'             => '价格',
	'G_COIN'                 => '金币',
	'S_COIN'                 => '银币',
	'C_COIN'                 => '铜币',
	'COIN_UNIT'              => '枚',
	'HANDLE'                 => '操作',
	'BUY'                    => '购买',
	'STOCK'                  => '采购',
	'SALE'                   => '出售',
	'NUM'                    => '数量',
	'ALLOW_GOODS'            => '剩余商品',
	'ALL_GOODS_OVER'         => '全部商品已经售完。',
	'USER_COMPETENCE'        =>array(
			'hp'			=> '体力值',
			'weight'		=> '负重',
			'con'			=> '体质',
			'str'           => '力量',
			'int'			=> '智慧',
			'dex'			=> '敏捷',
			'wis'           => '感知',
			'cha'           => '魅力',
		),
	 'ADD_NUM'              => '<span style="color:#e30404;">+%d</span>',
	 'SUB_NUM'              => '<span style="color:#3fac03;">-%d</span>',
	 'NO_GOODS_NUM'         => '没有填写物品数量',
	 'NO_GOODS_ERROR_NUM'   => '您输入了错误的数量,请确认输入',
	 'NO_ENOUGH_GOODS'      => '店铺没有足够的货物',
	 'NO_ENOUGH_WEIGHT'     => '您无法带这么多的东西',
	 'SHOP_CLOSE'           => '对不起，商店还没开业呢，请您稍后再来',
	 'NO_ENOUGH_MONEY'      => '购买物品需要%d枚金币,%d枚银币,%d枚铜币<br />您携带的货币不足,无法购买.',

	 'SUCCEED_BUY_GOOD'     => '购买商品成功！',
	 'SUCCEED_SALE_GOOD'    => '出售商品成功！',
	 'COST_MONEY'           => '花费了%d枚金币,%d枚银币,%d枚铜币',
	 'GAIN_MONEY'           => '赚到了%d枚金币,%d枚银币,%d枚铜币',
	 'BUY_GOOD_INFO'		=> '成功购买了%d%s.',
	 'SALE_GOOD_INFO'		=> '成功出售了%d%s.',
	 'ABORT_BUY_GOOD'		=> '购买失败，请返回重新购买.',
	 'ABORT_BUY_GOOD'		=> '出售失败，请返回重新出售.',
	 'GOOD_STOCK_PRICE'     => '采购价格',
	 'GOOD_STOCK_INFO'      => '采购信息',
	 'NO_CCOIN'               => '您携带的铜币不足,无法购买.<br />请去银行提取或者兑换足够的铜币再来.',
	)
);