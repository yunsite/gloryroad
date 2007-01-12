<?php
/** 
*
* @package phpBB3
* @version $Id: functions_shop.php,v 1.81 2006/03/25 12:07:00 acydburn Exp $
* @copyright (c) 2005 phpBB Group 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/






/** 
*
* 商店出售物品
* gold_coin，silver_coin，copper_coin，cess
* gold_coin，silver_coin，copper_coin 为商品价格，其中copper_coin为已经加过税的铜币数
* cess为该商品的税收铜币数
*/
/** 
* 税务处理
* 税收全部通过铜币结算，每样物品的cess字段保存，扣税
* 最高为800铜币。
* 税款加入店铺的shop_cess资金中，等待城市税务官统一收取。
*/


function goods_sell($goodsid,$goods_num)
{
	global $db, $user,$mode;
	global $phpbb_root_path, $phpEx, $SID, $config,$shop_info;
	//没填写数量



	if(empty($goods_num)||$goods_num==0){
		trigger_error('NO_GOODS_NUM');
		return;
	}
	//数字判断,
	$goods_num = Trim($goods_num);
	if (!ereg('^[0-9]{1,10}$',$goods_num))
	{
		trigger_error('NO_GOODS_ERROR_NUM');
		return;
	}


	$sql = 'SELECT goods_list.*,shop_storage.good_num ,system_object.weight,system_object.name,system_object.system_type,system_object.unit 
			FROM ' . SHOP_GOODS_LIST . '  goods_list  
			LEFT JOIN ' . SHOP_STORAGE . '  shop_storage ON (goods_list.good_id=shop_storage.good_id ) 
			LEFT JOIN ' . SYSTEM_OBJECT . '  system_object ON (goods_list.good_id=system_object.object_id )
			WHERE goods_list.good_id = ' . $goodsid . '  AND buy_sell=1 AND goods_list.shop_id='.$shop_info['build_id'];

	$result = $db->sql_query($sql);	
	$shop_goods =array();
	if ($row = $db->sql_fetchrow($result))
	{
		$shop_goods = $row;
	}
	
	$db->sql_freeresult($result);
	//判断用户的负重是否足够
	/* if($user->data['user_weight']+$shop_goods['weight']*$goods_num>800){
		//负重过高，无法购买
		trigger_error('NO_ENOUGH_WEIGHT');
		return;
	
	}*/
	//判断用户的钱是否足够
	if(!goodu_silver_coin(1,$goods_num,$shop_goods['gold_coin'],$shop_goods['silver_coin'],$shop_goods['copper_coin'])){
		//用户资金不足，无法购买
		trigger_error(sprintf($user->lang['NO_ENOUGH_MONEY'] ,$shop_goods['gold_coin']*$goods_num,$shop_goods['silver_coin']*$goods_num,$shop_goods['copper_coin']*$goods_num));
		return;
	
	}

	if($shop_goods['allow_num']-$shop_goods['acc_num']<$goods_num){
			//允许销售数量不足,订单，和库存判断
			trigger_error('NO_ENOUGH_GOODS');
			return;
			
	}	

	//非系统商店需要判断库存
	if($shop_info['system_type']<100){
		if($shop_goods['good_num']<$goods_num){
			//允许销售数量不足,订单，和库存判断
			trigger_error('NO_ENOUGH_GOODS');
			return;
			
		}		
		
	}
	/********************************************************************************************** 
	*
	* 判断背包，UPDATE还是INSERT ,另外生成displayorder
	*
	***********************************************************************************************/
	$sql = 'SELECT objectid,object_num,displayorder FROM ' . USERS_BAG . ' WHERE user_id = ' . $user->data['user_id'].' ORDER BY displayorder ' ;
	$result = $db->sql_query($sql);	
	$goodnum = 0;
	$i = 1;
	$display = 0;
	while($row = $db->sql_fetchrow($result))
	{
		if(($row['displayorder']!=$i)&&($display==0)){
			$display = $i;
		}

		$i++;
		$goodnum++;
	}

	$db->sql_freeresult($result);

/** 
*  交易开始
*/

	$db->sql_transaction();

	$user->data['u_gold_coin'] = $user->data['u_gold_coin']-$shop_goods['gold_coin']*$goods_num;
	$user->data['u_silver_coin'] = $user->data['u_silver_coin']-$shop_goods['silver_coin']*$goods_num;
	$user->data['u_copper_coin'] = $user->data['u_copper_coin']-$shop_goods['copper_coin']*$goods_num;
	$user->data['user_weight'] = $user->data['user_weight']+($shop_goods['weight']*$goods_num);
	
	//扣钱，加负重，
	$sql = 'UPDATE ' . USER_INFO . ' SET  
				u_gold_coin = '. $user->data['u_gold_coin'] . ' ,
				u_silver_coin = '. $user->data['u_silver_coin'] . ' ,
				u_copper_coin = '. $user->data['u_copper_coin'] . '  
				 WHERE user_id = '.$user->data['user_id'] ;
	$db->sql_query($sql);
	
	/********************************************************************************************** 
	*
	* 添加用户背包物品
	*
	***********************************************************************************************/
	
	if($goodnum>0){
			$sql = 'UPDATE ' . USERS_BAG . ' SET  
				object_num =object_num+ '. $goods_num . ' 
				 WHERE user_id = '.$user->data['user_id'] ;
		}else{
			$sql = 'INSERT INTO ' . USERS_BAG . ' (objectid,object_num,user_id,object_type,displayorder) 
				 VALUES ( '.$goodsid.','.$goods_num.','.$user->data['user_id'].','.$shop_goods['system_type'].','.$display.')' ;
		}
	$db->sql_query($sql);

	//变更商店订单

	$sql = 'UPDATE ' . SHOP_GOODS_LIST . ' SET  
			acc_num   = acc_num+'. $goods_num . ' 
			WHERE shop_id = '.$shop_info['build_id'] . ' AND buy_sell=1  AND  good_id ='.$goodsid ;		
	$db->sql_query($sql);



	
	if($shop_info['system_type']<100){
		
		/********************************************************************************************** 
		*
		* 将用户付款加入商店帐户，税收加入商店帐户，
		*
		***********************************************************************************************/
		$sql = 'UPDATE ' . BUILD_INFO . ' SET  
				build_gcoin = build_gcoin+'. ($shop_goods['gold_coin']*$goods_num) . ' ,
				build_scoin = build_scoin+'. ($shop_goods['silver_coin']*$goods_num) . ' ,
				build_ccoin = build_ccoin+'. ($shop_goods['copper_coin']-$shop_goods['cess'])*$goods_num . ', 
				build_cess  = build_cess+'. ($shop_goods['cess']*$goods_num) . '
				 WHERE build_id = '.$shop_info['build_id'] ;		
		$db->sql_query($sql);

		/********************************************************************************************** 
		*
		* 减仓库实际物品数量
		*
		***********************************************************************************************/
		$sql = 'UPDATE ' . SHOP_STORAGE . ' SET  
				good_num   = good_num-'. $goods_num . ' 
				 WHERE shop_id = '.$shop_info['build_id'] . ' AND good_id ='.$goodsid ;		
		$db->sql_query($sql);
		
		/********************************************************************************************** 
		*
		* 日志添加
		*
		***********************************************************************************************/

		$sql = 'INSERT INTO ' . SHOP_LOG . ' 	(shop_id,good_id,user_id,trade_time,
								gold_coin,silver_coin,copper_coin,cess,good_num,buy_sell) 
					VALUES('.$shop_info['build_id'].','.$goodsid.','.$user->data['user_id'].','.time().','
							.($shop_goods['gold_coin']*$goods_num) .','. ($shop_goods['silver_coin']*$goods_num) .
							','.(($shop_goods['copper_coin']-$shop_goods['cess'])*$goods_num).','
							.($shop_goods['cess']*$goods_num) . ','.$goods_num.',1)';
		$db->sql_query($sql);
	
	}


	$db->sql_transaction('commit');
	


/** 
*  交易结束
*/
	$url ="{$phpbb_root_path}shop.$phpEx$SID&amp;i=2&amp;shopid=".$shop_info['build_id'];
	meta_refresh(3, $url);
	if(!$db->sql_affectedrows()){
		$mesage = $user->lang['SUCCEED_BUY_GOOD'].'<br />'.sprintf($user->lang['COST_MONEY'] ,$shop_goods['gold_coin']*$goods_num,$shop_goods['silver_coin']*$goods_num,$shop_goods['copper_coin']*$goods_num).sprintf($user->lang['BUY_GOOD_INFO'] ,$goods_num,$shop_goods['unit'].$shop_goods['name']);
		trigger_error($mesage);
	}else{
		trigger_error('ABORT_BUY_GOOD');
	}


}




/** 
*
* 商店采购物品
* gold_coin，silver_coin，copper_coin，cess
* gold_coin，silver_coin，copper_coin 为商品价格，其中copper_coin为已经加过税的铜币数
* cess为该商品的税收铜币数
*/

/** 
* 税务处理
* 未定
* 采购涉及商店的等级，以及商店物品种类
*/


function goods_stock($goodsid,$goods_num)
{
	global $db, $user,$mode;
	global $phpbb_root_path, $phpEx, $SID, $config,$shop_info;
	//没填写数量



	if(empty($goods_num)||$goods_num==0){
		trigger_error('NO_GOODS_NUM');
		return;
	}
	//数字判断,
	$goods_num = Trim($goods_num);
	if (!ereg('^[0-9]{1,10}$',$goods_num))
	{
		trigger_error('NO_GOODS_ERROR_NUM');
		return;
	}


	$sql = 'SELECT goods_list.*,user_bag.objectid,user_bag.object_num as bag_num,system_object.weight,system_object.name,system_object.unit 
			FROM ' . SHOP_GOODS_LIST . '  goods_list  
			LEFT JOIN ' . USERS_BAG . '  user_bag ON (goods_list.good_id=user_bag.objectid )
			LEFT JOIN ' . SYSTEM_OBJECT . '  system_object ON (goods_list.good_id=system_object.object_id )
			WHERE goods_list.good_id = ' . $goodsid . '  AND buy_sell=2 AND user_bag.user_id= ' . $user->data['user_id'] .' AND goods_list.shop_id='.$shop_info['build_id'];
	$result = $db->sql_query($sql);	
	$shop_goods =array();
	if ($row = $db->sql_fetchrow($result))
	{
			
		$user_goods = $row;
	}else{
		trigger_error('NO_ENOUGH_GOODS');
		return;
	}
	
	$db->sql_freeresult($result);

	/********************************************************************************************** 
	*
	* 判断用户的货物量，
	*
	***********************************************************************************************/
	if($user_goods['bag_num']<$goods_num){
			
			trigger_error('NO_ENOUGH_GOODS');
			return;
	}	


	/********************************************************************************************** 
	*
	* 判断商店的订单量，
	*
	***********************************************************************************************/
	if($user_goods['allow_num']-$user_goods['acc_num']<$goods_num){
			
			trigger_error('NO_ENOUGH_GOODS');
			return;
	}	


	//非系统商店需要判断钱币
	if($shop_info['system_type']<100){

		//判断商店的钱是否足够
		if(!goodu_silver_coin(2,$goods_num,$user_goods['gold_coin'],$user_goods['silver_coin'],$user_goods['copper_coin'])){
			//商店资金不足，无法购买
			trigger_error(sprintf($user->lang['NO_ENOUGH_MONEY'] ,$user_goods['gold_coin']*$goods_num,$user_goods['silver_coin']*$goods_num,$user_goods['copper_coin']*$goods_num));
			return;
		
		}	
		
	}

/** 
*  交易开始
*/

	$db->sql_transaction();

	$user->data['u_gold_coin'] = $user->data['u_gold_coin']+$user_goods['gold_coin']*$goods_num;
	$user->data['u_silver_coin'] = $user->data['u_silver_coin ']+$user_goods['silver_coin']*$goods_num;
	$user->data['u_copper_coin'] = $user->data['u_copper_coin']+$user_goods['copper_coin']*$goods_num;
	$user->data['user_weight'] = $user->data['user_weight']-($user_goods['weight']*$goods_num);
	
	/********************************************************************************************** 
	*
	* 将商店付款加入用户账户，并减去用户负重值，
	*
	***********************************************************************************************/
	$sql = 'UPDATE ' . USER_INFO . ' SET  
				u_gold_coin = '. $user->data['u_gold_coin'] . ' ,
				u_silver_coin = '. $user->data['u_silver_coin'] . ' ,
				u_copper_coin = '. $user->data['u_copper_coin'] . ' 
				 WHERE user_id = '.$user->data['user_id'] ;
	$db->sql_query($sql);
	/********************************************************************************************** 
	*
	* 减去用户背包物品
	*
	***********************************************************************************************/
	if($user_goods['object_num']>$goods_num){
		$sql = 'UPDATE ' . USERS_BAG . ' SET  
				object_num =object_num- '. $goods_num . ' 
				 WHERE user_id = '.$user->data['user_id'] ;
	}else{
		$sql = 'DELETE * FROM ' . USERS_BAG . ' 
		          WHERE user_id = '.$user->data['user_id'].'
				   AND objectid='.$user_goods['objectid'];

	}
	$db->sql_query($sql);


	/********************************************************************************************** 
	*
	* 减去商店订单配额
	*
	***********************************************************************************************/

	$sql = 'UPDATE ' . SHOP_GOODS_LIST . ' SET  
			acc_num   = acc_num+'. $goods_num . ' 
			WHERE shop_id = '.$shop_info['build_id'] . ' AND buy_sell=2 AND  good_id ='.$goodsid ;		
	$db->sql_query($sql);



	
	if($shop_info['shop_type']>50){
		
		/********************************************************************************************** 
		*
		* 扣除商店购买的货款
		*
		***********************************************************************************************/
		$sql = 'UPDATE ' . BUILD_INFO . ' SET  
				build_gcoin = build_gcoin-'. ($user_goods['gold_coin']*$goods_num) . ' ,
				build_scoin = build_scoin-'. ($user_goods['silver_coin']*$goods_num) . ' ,
				build_ccoin = build_ccoin-'. ($user_goods['copper_coin']-$user_goods['cess'])*$goods_num . ' 
					 WHERE build_id = '.$shop_info['build_id'] ;		
		$db->sql_query($sql);

		/********************************************************************************************** 
		*
		* 添加仓库实际物品数量
		*
		***********************************************************************************************/
		$sql = 'UPDATE ' . SHOP_STORAGE . ' SET  
				good_num   = good_num+'. $goods_num . ' 
				 WHERE shop_id = '.$shop_info['build_id'] . ' AND good_id ='.$goodsid ;		
		$db->sql_query($sql);
		
		/********************************************************************************************** 
		*
		* 日志添加
		*
		***********************************************************************************************/

		$sql = 'INSERT INTO ' . SHOP_LOG . ' 	(shop_id,good_id,user_id,trade_time,
								gold_coin,silver_coin,copper_coin,cess,good_num,buy_sell) 
					VALUES('.$shop_info['build_id'].','.$goodsid.','.$user->data['user_id'].','.time().','
							.($user_goods['gold_coin']*$goods_num) .','. ($user_goods['silver_coin']*$goods_num) .
							','.(($user_goods['copper_coin']-$user_goods['cess'])*$goods_num).','
							.($user_goods['cess']*$goods_num) . ','.$goods_num.',2)';
		$db->sql_query($sql);
	
	}


	$db->sql_transaction('commit');
	


/** 
*  交易结束
*/
	$url ="{$phpbb_root_path}shop.$phpEx$SID&amp;i=2&amp;shopid=".$shop_info['build_id'];
	meta_refresh(3, $url);
	if(!$db->sql_affectedrows()){
		$mesage = $user->lang['SUCCEED_SALE_GOOD'].'<br />'.sprintf($user->lang['GAIN_MONEY'] ,$user_goods['gold_coin']*$goods_num,$shop_goods['silver_coin']*$goods_num,$user_goods['copper_coin']*$goods_num).sprintf($user->lang['SALE_GOOD_INFO'] ,$goods_num,$user_goods['unit'].$user_goods['name']);
		trigger_error($mesage);
	}else{
		trigger_error('ABORT_SALE_GOOD');
	}


}



/** 
*
* 交易货币判断
* 参数1：买卖标示 ，1为卖，2为买；参数2：货币数组
*
*/
function goodu_silver_coin($flag = 1,$goods_num,$u_gold_coin, $u_silver_coin, $u_copper_coin)
{
	global $db, $user;
	global $phpbb_root_path, $phpEx, $SID,$shop_info;
	$t_coin =array();
	//用户掏钱购买
	if($flag==1){
		$t_coin[0]=$user->data['u_gold_coin']-$u_gold_coin*$goods_num;
		$t_coin[1]=$user->data['u_silver_coin']-$u_silver_coin*$goods_num;
		$t_coin[2]=$user->data['u_copper_coin']-$u_copper_coin*$goods_num;
	}else{
	//店铺采购
	    $t_coin[0]=$shop_info['build_gcoin']-$u_gold_coin*$goods_num;
		$t_coin[1]=$shop_info['build_scoin']-$u_silver_coin*$goods_num;
		$t_coin[2]=$shop_info['build_ccoin']-$u_copper_coin*$goods_num;
	
	}

	if(($t_coin[0]>=0)&&($t_coin[1]>=0)&&($t_coin[2]>=0)){
		return 	$t_coin;	
	}else{
		return 	false;
	}
	
}




?>