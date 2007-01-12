<?php
/** 
*
* @package phpBB3
* @version $Id: index.php,v 1.153 2006/03/12 23:19:48 acydburn Exp $
* @copyright (c) 2005 phpBB Group 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
*/
define('IN_PHPBB', true);
$phpbb_root_path = './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.'.$phpEx);

include($phpbb_root_path . 'includes/common_rpg_db.'.$phpEx);

include($phpbb_root_path . 'includes/functions_shop.'.$phpEx);


// Basic parameter data
$id 	= request_var('i', 1);
$mode	= request_var('mode', '');
$shopid = request_var('shopid', 1);
$cityid = request_var('cityid', 0);

if ($mode == 'login' || $mode == 'logout')
{
	define('IN_LOGIN', true);
}

// Start session management
$user->session_begin();
$auth->acl($user->data);


$user->setup('user_info');
$user->setup('shop_info');

$shop_info = array();


// Only registered users can go beyond this point
if (!$user->data['is_registered'])
{
	if ($user->data['is_bot'])
	{
		redirect("index.$phpEx$SID");
	}
//shop.$phpEx$SID&amp;i=$id&amp;shopid=$shopid&amp;mode=$mode
	login_box('', $user->lang['LOGIN_EXPLAIN_UCP']);
}


// 取得商店信息
$sql = 'SELECT shop_info.*  
	FROM ' . BUILD_INFO . '  shop_info  
	
	WHERE shop_info.build_id = '. $shopid;

$result = $db->sql_query($sql);

if ($row = $db->sql_fetchrow($result))
{

	$shop_info = $row;

}
$db->sql_freeresult($result);


if($cityid==0) $cityid=$shop_info['city_id'];
include($phpbb_root_path . 'includes/city_inc.'.$phpEx);




if($shop_info['build_open']==0){
		
		//商店未开放
	trigger_error('SHOP_CLOSE');

}
$template->assign_vars(array(
			'V_SHOP_ID'             =>  $shopid,
			'V_SHOP_TYPE'			=>	$user->lang['SHOPTYPE'][$shop_info['build_type']],
			'V_SHOP_STATE'			=>	$user->lang['SHOPSTATE'][$shop_info['build_open']],
			'V_SHOP_LEVEL'			=>	$shop_info['build_level'],
			'V_SHOP_TYPE_IMG'		=>	$shop_info['build_type'],
			'V_SHOP_NAME'			=>	$shop_info['build_name'],
	)
);


//用户分栏
switch ($id)
{
	//店铺信息属性
	case 1:
		$template->assign_vars(array(
			'V_SHOP_DESC'			=>	$shop_info['build_desc'],
			)
		);
	break;
	// 取得出售商品信息
	case 2:
		if($shop_info['build_open']==2){
		
		//商店未开放
			trigger_error('SHOP_CLOSE');

			}

		$sql = 'SELECT goods_list.*,system_object.* 
			FROM ' . SHOP_GOODS_LIST . '  goods_list  
			LEFT JOIN ' . SYSTEM_OBJECT .' system_object
			ON (goods_list.good_id = system_object.object_id)
			WHERE goods_list.shop_id = '. $shopid . '
			AND buy_sell=1';

		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			$price = '';
			if($row['gold_coin']>0)
			$price .= ' '.$row['gold_coin'].$user->lang['COIN_UNIT'].$user->lang['G_COIN'];
			if($row['silver_coin']>0)
			$price .= ' '.$row['silver_coin'].$user->lang['COIN_UNIT'].$user->lang['S_COIN'];
			if($row['copper_coin']>0)
			$price .= ' '.$row['copper_coin'].$user->lang['COIN_UNIT'].$user->lang['C_COIN'];

			$template->assign_block_vars('sell_goods_list', array(
				'RECORD_ID' 		    => $row['record_id'],
				'GOODS_ID' 		        => $row['object_id'],
				'GOODS_NAME' 		    => $row['name'],
				'GOODS_WEIGHT'          => $row['weight'],
				'GOODS_DESC'			=> $row['desc'],
				'GOODS_UNIT_GPRICE'		=> $row['gold_coin'],
				'GOODS_UNIT_SPRICE'		=> $row['silver_coin'],
				'GOODS_UNIT_CPRICE'		=> $row['copper_coin'],
				'STR_PRICE'             => $price,
				'REMAINS'               =>($row['allow_num']-$row['acc_num']),
				'S_BUY_FLAG'            =>($row['allow_num']-$row['acc_num'])?true:false,
				'EFFECT1NAME'               =>($row['effect1'])?($user->lang['USER_COMPETENCE'][$row['effectname1']].(($row['effect1']>0)?sprintf($user->lang['ADD_NUM'],$row['effect1']):sprintf($user->lang['SUB_NUM'],abs($row['effect1'])))):'',
				'EFFECT2NAME'              =>($row['effect2'])?($user->lang['USER_COMPETENCE'][$row['effectname2']].':'.$row['effect2']):'',
				)
			);

		
		}
		$db->sql_freeresult($result);
	

	break;
	case 3:
		if($shop_info['build_open']==2){
		
		//商店未开放
				trigger_error('SHOP_CLOSE');

		}

		$sql = 'SELECT goods_list.*,system_object.* 
			FROM ' . SHOP_GOODS_LIST . '  goods_list  
			LEFT JOIN ' . SYSTEM_OBJECT .' system_object
			ON (goods_list.good_id = system_object.object_id)
			WHERE goods_list.shop_id = '. $shopid . '
			AND buy_sell=2';

		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			$price = '';
			if($row['gold_coin']>0)
			$price .= ' '.$row['gold_coin'].$user->lang['COIN_UNIT'].$user->lang['G_COIN'];
			if($row['silver_coin']>0)
			$price .= ' '.$row['silver_coin'].$user->lang['COIN_UNIT'].$user->lang['S_COIN'];
			if($row['copper_coin']>0)
			$price .= ' '.$row['copper_coin'].$user->lang['COIN_UNIT'].$user->lang['C_COIN'];
			$template->assign_block_vars('sell_goods_list', array(
				'RECORD_ID' 		    => $row['record_id'],
				'GOODS_ID' 		        => $row['object_id'],
				'GOODS_NAME' 		    => $row['name'],
				'GOODS_WEIGHT'          => $row['weight'],
				'GOODS_DESC'			=> $row['desc'],
				'GOODS_UNIT_GPRICE'		=> $row['gold_coin'],
				'GOODS_UNIT_SPRICE'		=> $row['silver_coin'],
				'GOODS_UNIT_CPRICE'		=> $row['copper_coin'],
				'STR_PRICE'             => $price,
				'REMAINS'               =>($row['allow_num']-$row['acc_num']),
				'S_BUY_FLAG'            =>($row['allow_num']-$row['acc_num'])?true:false,
				'EFFECT1NAME'               =>($row['effect1'])?($user->lang['USER_COMPETENCE'][$row['effectname1']].(($row['effect1']>0)?sprintf($user->lang['ADD_NUM'],$row['effect1']):sprintf($user->lang['SUB_NUM'],abs($row['effect1'])))):'',
				'EFFECT2NAME'              =>($row['effect2'])?($user->lang['USER_COMPETENCE'][$row['effectname2']].':'.$row['effect2']):'',
				)
			);

		
		}
		$db->sql_freeresult($result);
	
	break;
	case 4:
	break;
}

//$xajax->debugOn();
switch ($mode)
{
	case 'buy' :
	$gNum	= request_var('gnum', 0);
	$gId = request_var('goodid', 1);
	goods_sell($gId,$gNum);
	break;
	case 'stock' :
	$gNum	= request_var('gnum', 0);
	$gId = request_var('goodid', 1);
	goods_stock($gId,$gNum);
}






// Assign index specific vars
$template->assign_vars(array(
	'U_URL'	        => "{$phpbb_root_path}shop.$phpEx$SID&amp;cityid=".$shop_info['city_id'].'&amp;shopid='.$shopid.'&amp;i=',
	'S_SELECTED1'   => ($id==1)?'id="activetab"':'',
	'S_SELECTED2'	=> ($id==2)?'id="activetab"':'',
	'S_SELECTED3'	=> ($id==3)?'id="activetab"':'',
	'S_BUILD_INFO'   => ($id==1)?true:false,
	'S_SALE_LIST'   => ($id==2)?true:false,
	'S_STOCK_LIST'  => ($id==3)?true:false,
	'U_MCP'			=> ($auth->acl_get('m_')) ? "{$phpbb_root_path}mcp.$phpEx$SID&amp;i=main&amp;mode=front" : '',
	
	)
	
);

// Output page
page_header($user->lang['INDEX']);

$template->set_filenames(array(
	'body' => 'shop_info_body.html')
);

page_footer();

?>