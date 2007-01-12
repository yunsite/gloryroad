<?php




include($phpbb_root_path . 'includes/common_rpg_db.php');



//require ('xajax/xajax.inc.php');

/**
*   Basic Action 
*/
function event_baseaciton($event,$city,$placeid)
{
	global $db,$phpEx, $phpbb_root_path,$user;
	include($phpbb_root_path . 'cache/rpg/cache_objects.'.$phpEx);
	$objectid = 0;
	$getobject = 6;
	$getexp=4;
	$sql = 'SELECT user.* FROM ' . USER_EXINFO . " user 
					WHERE user.user_id=".$user->data['user_id'];

	if ( !($result = $db->sql_query($sql)) )
	{
			message_die(GENERAL_ERROR, 'Could not user onlinezone', '', __LINE__, __FILE__, $sql);
	}
	if ( !($row = $db->sql_fetchrow($result)) )
	{
			message_die(GENERAL_ERROR, 'Could user onlinezone', '', __LINE__, __FILE__, $sql);
	}
	$db->sql_freeresult($result);

	$m_t = event_getobject($event,$row);

	$sql = 'UPDATE ' . USER_EXINFO . ' SET  user_exp=user_exp+'.$getexp.",activity=activity-2 WHERE user_id=".$user->data['user_id'];
	$db->sql_query($sql);
	$db->sql_freeresult($result);
	$message = '';
	$message = sprintf('获得 %d 点经验值',$getexp).'<br />';
	$message .= $m_t ;
	return $message;
}



/**
*   Get Same Object 
*/

function event_getobject($event,$cityid)
{
	
	global $db,$phpEx, $phpbb_root_path,$user;

	$message='';
//根据膜拜次数确定物品加成
	$getobject = $getobject+Floor($userdata['worship']/1000);
	$sql = 'SELECT event.*,object.name FROM ' . EVENT_PROBABILITY . ' AS event  
			LEFT ' . OBJECTS_TABLE . " AS object ON (event.object_id=object.object_id)
					WHERE event.event_id=".$event.' AND event.city_id='.$cityid;
	$db->sql_query($sql);
	$get_rand= rand(1,60000);
	$objectid = 0;
	while($row = $db->sql_fetchrow($result)){
		if(((int)$row[s_numerator]<$get_rand)&&((int)$row[e_numerator]>$get_rand)){
			$object_id = $row['object_id'];
		}
	}
	if($objectid !=0){
	//添加物品
		$sql = 'SELECT * FROM ' . USER_BAG . "  
						WHERE user_id=".$user->data['user_id'].' AND objectid='.$objectid;

		if($db->sql_query($sql)&&$db->sql_affectedrows())
		{
			$sql = 'UPDATE ' . USER_BAG . ' SET  object_num=object_num+'.$getobject." WHERE user_id=".$user->data['user_id'].' AND objectid='.$objectid;
		}else{
			$sql = 'INSERT INTO ' . USER_BAG . " (user_id,objectid,object_num,object_type)  VALUES ( ".$user->data['user_id'].','.$objectid.','.$getobject.','.$sys_objects[$objectid]['objecttype'].')';
		}

		$db->sql_query($sql);
		$db->sql_freeresult($result);

		$message = sprintf('得到 %d 个'.$row['name'],$getobject);
	}
	return $message;

	
}

/**
*  添加个人贡献度的事件
*  修路，开荒，绿化
*/
/**
*
*  开荒 
*  基础城市开荒，当荒地达到一定的时候才能建立新城，而且新城建立将消耗荒地值
*  荒地算作个人贡献，将会提高个人的信誉等级
*/
function event_contribution($event,$cityid)
{
	global $db,$phpEx, $phpbb_root_path,$user,$city_info;
	include($phpbb_root_path . 'cache/rpg/cache_contribution.'.$phpEx);
	if($user->data['activity']-$contributions_event[$event]['activity']<0){
		trigger_error('NO_ENOUGH_ACTIVITY');
		return;
	}
	if($user->data['contribution']+$contributions_event[$event]['contribution']>2000){
		$user->data['user_credit'] = $user->data['user_credit']+1; 
		$user->data['contribution'] = $user->data['contribution']+$contributions_event[$event]['contribution']-2000; 
	}else{
		$user->data['contribution'] = $user->data['contribution']+$contributions_event[$event]['contribution'];
	}

	$getexp='';
	$getcoin ='';
	if($contributions_event[$event]['exp']>0){
		$getexp =',user_exp='.($user->data['user_exp']+$contributions_event[$event]['exp']);
		$message = sprintf($user->lang['GET_EXP'],$contributions_event[$event]['exp']).'<br />';

	}
	if($contributions_event[$event]['coin']>0){
		$getcoin =',u_copper_coin='.($user->data['u_copper_coin']+$contributions_event[$event]['coin']);
	}
	$db->sql_transaction('begin');
	if($event<101){
		$sql = 'UPDATE ' . USER_EXINFO . ' SET activity=activity-'.$contributions_event[$event]['activity'].$getexp.$getcoin.', user_credit='.$user->data['user_credit'].',contribution='.$user->data['contribution'].'  WHERE user_id='.$user->data['user_id'];
		$db->sql_query($sql);
	}else if($event<201){
		$sql = 'SELECT  COUNT(eventid) AS counts  FROM ' .USER_EVENT.' 
				WHERE city_id ='.$cityid.' AND user_id='.$user->data['user_id'] .' AND eventtype=1 AND event_id='.$event.' AND (creat_time+useful_life)>'.time() ;
		$result = $db->sql_query($sql);	
		$row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

		$sql = 'UPDATE ' . USER_EXINFO . ' SET activity=activity-'.$contributions_event[$event]['activity'].$getexp.$getcoin.', user_credit='.$user->data['user_credit'].',contribution='.$user->data['contribution'].'  WHERE user_id='.$user->data['user_id'];
		$db->sql_query($sql);
		if ((int) $row['counts'] == 0)
		{
			trigger_error('NO_LICENSE');
			return;
		}
	}

	switch($event){
		//开荒
		case 1:
			$sql = 'UPDATE ' . CITY_INFO . ' SET  city_ground =city_ground+'.$contributions_event[$event]['eventeffect'].'   WHERE city_id='.$cityid;
			
			$message .= $user->lang['SUCCEED_OPEN_UP_WASTELAND'].sprintf($user->lang['COST_ACTIVITY'],$contributions_event[$event]['activity']).'<br />';
			
		break;
		//耕种
		case 2:
			if($city_info['city_type']>20){
			$sql = 'UPDATE ' . CITY_INFO . ' SET  city_rice =city_rice+'.$contributions_event[$event]['eventeffect'].'   WHERE city_id='.$cityid;
		   }
		   $message .=$user->lang['SUCCEED_ADD_RICE'].sprintf($user->lang['COST_ACTIVITY'],$contributions_event[$event]['activity']).','.sprintf($user->lang['SUCCEED_ADD_CCOIN'],$contributions_event[$event]['coin']). '<br />';
		break;
		//改善环境
		case 3:
			if($city_info['city_type']>20){

				if($city_info['city_pollute']>$contributions_event[$event]['eventeffect']){
					$sql = 'UPDATE ' . CITY_INFO . ' SET  city_pollute =city_pollute-'.$contributions_event[$event]['eventeffect'].'   WHERE city_id='.$cityid;
				}else{
					$sql = 'UPDATE ' . CITY_INFO . ' SET  city_pollute =0  WHERE city_id='.$cityid;
				}
			
		   }
		   $message .=$user->lang['SUCCEED_ENTIRONMENT'].sprintf($user->lang['COST_ACTIVITY'],$contributions_event[$event]['activity']).','.sprintf($user->lang['SUCCEED_ADD_CCOIN'],$contributions_event[$event]['coin']). '<br />';
		break;
		//狩猎
		case 4:
			if($city_info['city_type']>20){

				if($city_info['city_pollute']>$contributions_event[$event]['eventeffect']){
					$sql = 'UPDATE ' . CITY_INFO . ' SET  city_pollute =city_pollute-'.$contributions_event[$event]['eventeffect'].'   WHERE city_id='.$cityid;
				}else{
					$sql = 'UPDATE ' . CITY_INFO . ' SET  city_pollute =0  WHERE city_id='.$cityid;
				}
			
		   }
		   $message .=$user->lang['SUCCEED_ENTIRONMENT'].sprintf($user->lang['COST_ACTIVITY'],$contributions_event[$event]['activity']).','.sprintf($user->lang['SUCCEED_ADD_CCOIN'],$contributions_event[$event]['coin']). '<br />';
		break;
	}
	
	$db->sql_query($sql);
	$db->sql_transaction('commit');
	$meta_url = append_sid("{$phpbb_root_path}city.$phpEx", "cityid=$cityid");
	meta_refresh(3, $meta_url);
	trigger_error($message);

}
/**
*  城市购买许可证事件
*/


function event_buy_license($recordid)
{
	global $db,$phpEx, $phpbb_root_path,$user,$city_info;
	$objResponse = new xajaxResponse();
	if (!$user->data['is_registered'])
	{
		$objResponse->addScript("location.reload();");
		return;
	}else{
		$sql = 'SELECT license.*,userlic.u_rid,userlic.creat_time AS uc,userlic.useful_life AS ul FROM ' . CITY_LICENSE . ' license 
				   LEFT JOIN ' . USER_LICENSE . ' userlic ON 
				   (license.cityid=userlic.cityid AND license.licensetype=userlic.licensetype 
					AND license.allowlv=userlic.license_lv AND license.licenseid=userlic.licenseid
					AND userlic.user_id='.$user->data['user_id'].')
					WHERE license.cityid='.$user->data['last_place'].' AND license.recordid = '.$recordid ;


		$result = $db->sql_query($sql);	
		if ($row = $db->sql_fetchrow($result)){

			//判断城市类型
			if($row['cityid']>50){
				if($row['licenseallow']>=$row['licensenum'])
				//错误信息，允许的授权已经卖完
				$objResponse->addScript("msg(\"".$user->lang['NO_ALLOWLICENSE']."\")");
				return $objResponse->getXML();
				
			}
			if($user->data['u_copper_coin']<$row['price']){
				//错误信息，用户钱不够
				
				$objResponse->addScript("msg(\"".$user->lang['NO_CCOIN']."\")");
				return $objResponse->getXML();
			}
			if($row['u_rid']>0){
				//错误信息，用户已经拥有了许可
				if($row['uc']+$row['ul']>time()){
					//如果未过期提示错误
						$objResponse->addScript("msg(\"".$user->lang['NO_SOMELICENSE']."\")");
						return $objResponse->getXML();
				
				}else{
					if($row['ul']>0){
						//已过期,删除记录
						$sql='DELETE  FROM '.USER_LICENSE.'  WHERE u_rid='.$row['u_rid'];
						$db->sql_query($sql);
					}else{
						$objResponse->addScript("msg(\"".$user->lang['NO_SOMELICENSE']."\")");
						return $objResponse->getXML();
					}
					
				}
			}

			//全部判断结束,开始添加协议
			$db->sql_transaction('begin');
			$sql = 'INSERT INTO ' . USER_LICENSE . ' (cityid,licenseid,creat_time,useful_life,user_id,license_lv,licensetype) 
			VALUES			('.$user->data['last_place'].','.$row['licenseid'].','.time().','.$row['useful_life'].','.$user->data['user_id'].','.$row['allowlv'].','.$row['licensetype'].')';
			 $db->sql_query($sql);
			
			//扣用户的钱
			$sql='UPDATE '.USER_EXINFO.' SET u_copper_coin=u_copper_coin-'.$row['price'].' WHERE user_id='.$user->data['user_id'];
			$db->sql_query($sql);
			
			//修改许可卖出数量
			$sql='UPDATE '. CITY_LICENSE.' SET licensenum=licensenum+1 WHERE recordid='.$row['recordid'];
			$db->sql_query($sql);
			
			if($row['cityid']>50){
				//增加城市财政
				$sql='UPDATE '. CITY_INFO.' SET city_money_c=city_money_c+'.$row['price'].' WHERE city_id='.$row['cityid'];
				$db->sql_query($sql);
			}
			$db->sql_transaction('commit');
			$message='';
			switch($row['licensetype']){
				case 1:
					$message= $user->lang['YOU_NOWHAVE'].$user->lang['EVENT_'.$row['licenseid']].$user->lang['WORK_LICENSE'];
				break;
				case 2:
					$message= $user->lang['YOU_NOWHAVE'].$user->lang['BUILDNOW'].$user->lang['CITY_BUILD_V'][$row['licenseid']].$user->lang['UPTOWN_BUILD_APP'];
				break;
				case 3:
					$message= $user->lang['YOU_NOWHAVE'].$user->lang['BUILDNOW'].$user->lang['CITY_BUILD_V'][$row['licenseid']].$user->lang['SOWNTOWN_BUILD_APP'];
				break;
			}
			
			$objResponse->addScript("messageinfo(\"".$user->lang['LICENSE_SUSSES']."<br />".$message."\")");


		}
		$db->sql_freeresult($result);
	}
	return $objResponse->getXML();
	
	
}
/**
*  提升等级
*/
function event_update($x){
	global $db,$phpEx, $phpbb_root_path,$user;

	
	$lastexp=$user->data['user_exp'];
	$objResponse = new xajaxResponse();
	if (!$user->data['is_registered'])
	{
		$objResponse->addScript("location.reload();");
	}else{
	

	switch($x){
		//#################################  升级 ###############################################
		case 'exp':
					
					$sql = 'SELECT exp.base_Exp  
						FROM ' . EXP_TABLE . ' exp  
				    WHERE exp.Level='.$user->data['user_level'];
					
					$result = $db->sql_query($sql);
					if ($row = $db->sql_fetchrow($result)){
						if($user->data['user_exp']>=$row['base_Exp']){
			
							//如果可以被4整除,系统奖励一点属性点
							$sqlstr=(($user->data['user_level']+1)%4==0)?',pre_point=pre_point+1 ':'';
							$user->data['user_exp'] = $user->data['user_exp']-$row['base_Exp'];
							//更新等级以及下一级经验上限
							$sql = 'UPDATE ' . USER_EXINFO . ' SET  user_level=user_level+1,user_exp='.$user->data['user_exp'].$sqlstr.' WHERE user_id='.$user->data['user_id'];
							$db->sql_query($sql);

							if(($user->data['user_level']+1)%4==0){
								$objResponse->addAssign("point", "innerHTML",$user->data['pre_point']+1);
							}
							
							$objResponse->addAssign("userlevel", "innerHTML",$user->data['user_level']+1);
						   
						}
					}
					$db->sql_freeresult($result);
		break;
		// ########################  体质 ########################################################
		case 'con':
				$sql = 'SELECT ux.con_exp,ux.user_con,ux.user_level,exp.att_exp,exp.next_attexp,exp.base_Exp FROM ' . USER_EXINFO . ' ux 
					LEFT JOIN ' . EXP_TABLE . ' exp ON (ux.user_con+1=exp.level)
				    WHERE ux.user_id='.$user->data['user_id'];
					$result = $db->sql_query($sql);
					if ($row = $db->sql_fetchrow($result)){
						//如果用户的经验值大于当前体质需要升级的经验值
						if(($user->data['user_exp']>=$row['con_exp'])&&($row['user_level']>$row['user_con'])){
							$user->data['user_exp']=$user->data['user_exp']-$row['con_exp'];
							$user->data['con_exp'] =$row['next_attexp'];
							//更新等级,经验以及下一级经验上限
							$sql = 'UPDATE ' . USER_EXINFO . ' SET  user_con=user_con+1,con_exp='.$row['next_attexp'].',user_hpall=user_hpall+3,user_hp=user_hpall,user_exp='.$user->data['user_exp'].'  WHERE user_id='.$user->data['user_id'];
							$db->sql_query($sql);

							$objResponse->addAssign("con_v","innerHTML",$user->data['user_con']+1);



						}
					}
					$db->sql_freeresult($result);
			break;
// ########################  力量 ########################################################
			case 'str':
				$sql = 'SELECT ux.str_exp,ux.user_str,ux.user_level,exp.att_exp,exp.next_attexp,exp.base_Exp FROM ' . USER_EXINFO . ' ux 
					LEFT JOIN ' . EXP_TABLE . ' exp ON (ux.user_str+1=exp.level)
				    WHERE ux.user_id='.$user->data['user_id'];
					$result = $db->sql_query($sql);
					if ($row = $db->sql_fetchrow($result)){
						//如果用户的经验值大于当前体质需要升级的经验值
						
						if(($user->data['user_exp']>=$row['str_exp'])&&($row['user_level']>$row['user_str'])){
							
							//更新用户经验值
							$user->data['user_exp']= $user->data['user_exp']-$row['str_exp'];
			
							
							//更新等级以及下一级经验上限
							$sql = 'UPDATE ' . USER_EXINFO . ' SET  user_str=user_str+1,str_exp='.$row['next_attexp'].',user_weightall=user_weightall+3 ,user_exp='.$user->data['user_exp'].'  WHERE user_id='.$user->data['user_id'];
							$db->sql_query($sql);

							$objResponse->addAssign("str_v","innerHTML",$user->data['user_str']+1);


						}
					}
					$db->sql_freeresult($result);
			break;
// ###################################  敏捷  ###################################################
			case 'dex':
				$sql = 'SELECT ux.dex_exp,ux.user_dex,ux.user_level,exp.att_exp,exp.next_attexp,exp.base_Exp FROM ' . USER_EXINFO . ' ux 
					LEFT JOIN ' . EXP_TABLE . ' exp ON (ux.user_dex+1=exp.level)
				    WHERE ux.user_id='.$user->data['user_id'];
					$result = $db->sql_query($sql);
					if ($row = $db->sql_fetchrow($result)){
						//如果用户的经验值大于当前体质需要升级的经验值
						
						if(($user->data['user_exp']>=$row['dex_exp'])&&($row['user_level']>$row['user_dex'])){
							
							//更新用户经验值
							$user->data['user_exp']= $user->data['user_exp']-$row['dex_exp'];
							
							//更新等级以及下一级经验上限
							$sql = 'UPDATE ' . USER_EXINFO . ' SET  user_dex=user_dex+1,dex_exp='.$row['next_attexp'].',user_exp='.$user->data['user_exp'].' WHERE user_id='.$userdata['user_id'];
							$db->sql_query($sql);

							$objResponse->addAssign("dex_v","innerHTML",$user->data['user_dex']+1);

						}
					}
					$db->sql_freeresult($result);
			break;
// ###################################  智慧  ###################################################
			case 'int':
				$sql = 'SELECT ux.int_exp,ux.user_int,ux.user_level,exp.att_exp,exp.next_attexp,exp.base_Exp FROM ' . USER_EXINFO . ' ux 
					LEFT JOIN ' . EXP_TABLE . ' exp ON (ux.user_int+1=exp.level)
				    WHERE ux.user_id='.$user->data['user_id'];
					$result = $db->sql_query($sql);
					if ($row = $db->sql_fetchrow($result)){
						//如果用户的经验值大于当前体质需要升级的经验值
						
						if(($user->data['user_exp']>=$row['int_exp'])&&($row['user_level']>$row['user_int'])){
							
							//更新用户经验值
							$user->data['user_exp']= $user->data['user_exp']-$row['int_exp'];

							
							//更新等级以及下一级经验上限
							$sql = 'UPDATE ' . USER_EXINFO . ' SET  user_int=user_int+1,int_exp='.$row['next_attexp'].',user_magicall=user_magicall+3,user_magic=user_magicall,user_exp='.$user->data['user_exp'].' WHERE user_id='.$user->data['user_id'];
							$db->sql_query($sql);

							$objResponse->addAssign("int_v","innerHTML",$user->data['user_int']+1);


						}
					}
					$db->sql_freeresult($result);
			break;
// ###################################  感知  ###################################################
			case 'wis':
				$sql = 'SELECT ux.wis_exp,ux.user_wis,ux.user_level,exp.att_exp,exp.next_attexp,exp.base_Exp FROM ' . USER_EXINFO . ' ux 
					LEFT JOIN ' . EXP_TABLE . ' exp ON (ux.user_wis+1=exp.level)
				    WHERE ux.user_id='.$user->data['user_id'];
					$result = $db->sql_query($sql);
					if ($row = $db->sql_fetchrow($result)){
						//如果用户的经验值大于当前体质需要升级的经验值
						
						if(($user->data['user_exp']>=$row['wis_exp'])&&($row['user_level']>$row['user_wis'])){
							
							//更新用户经验值
							$user->data['user_exp']= $user->data['user_exp']-$row['wis_exp'];
							
							//更新等级以及下一级经验上限
							$sql = 'UPDATE ' . USER_EXINFO . ' SET  user_wis=user_wis+1,wis_exp='.$row['next_attexp'].',user_exp='.$user->data['user_exp'].' WHERE user_id='.$user->data['user_id'];
							$db->sql_query($sql);
							
							$objResponse->addAssign("wis_v","innerHTML",$user->data['user_wis']+1);

						}
					}
					$db->sql_freeresult($result);
			break;
// ###################################  魅力  ###################################################
			case 'cha':
				$sql = 'SELECT ux.cha_exp,ux.user_cha,ux.user_level,exp.att_exp,exp.next_attexp,exp.base_Exp FROM ' . USER_EXINFO . ' ux 
					LEFT JOIN ' . EXP_TABLE . ' exp ON (ux.user_cha+1=exp.level)
				    WHERE ux.user_id='.$user->data['user_id'];
					$result = $db->sql_query($sql);
					if ($row = $db->sql_fetchrow($result)){
						//如果用户的经验值大于当前体质需要升级的经验值
						
						if(($user->data['user_exp']>=$row['cha_exp'])&&($row['user_level']>$row['user_cha'])){
							
							//更新用户经验值
							$user->data['user_exp']= $user->data['user_exp']-$row['cha_exp'];
							
							//更新等级以及下一级经验上限
							$sql = 'UPDATE ' . USER_EXINFO . ' SET  user_cha=user_cha+1,cha_exp='.$row['next_attexp'].',user_credit=user_credit+1,user_exp='.$user->data['user_exp'].' WHERE user_id='.$user->data['user_id'];
							$db->sql_query($sql);
							
							$objResponse->addAssign("cha_v","innerHTML",$user->data['user_cha']+1);
							$objResponse->addAssign("credit_v","innerHTML",$user->data['user_credit']+1);

						}
					}
					$db->sql_freeresult($result);

			break;
	}

$sql = 'SELECT ux.*,uexp.base_Exp FROM ' . USER_EXINFO . ' ux 
			LEFT JOIN ' . EXP_TABLE . ' uexp ON (ux.user_level=uexp.level)
			 WHERE ux.user_id='.$user->data['user_id'];
$result = $db->sql_query($sql);
if ($row = $db->sql_fetchrow($result)){
	$objResponse->addAssign("userexp", "innerHTML",$row['user_exp']);
	
	$objResponse->addAssign("expbar", "innerHTML","<img src='images/rpg/bar/exp.gif' height='10' width='".(($row['user_exp']/$row['base_Exp'])*200)."' >");
	$objResponse->addAssign("hpbar", "innerHTML","<img src=\"images/rpg/bar/hp.gif\" height=\"10\" width=\"200\" >");
	$objResponse->addAssign("magicbar", "innerHTML","<img src=\"images/rpg/bar/mp.gif\" height=\"10\" width=\"200\" >");
	$objResponse->addAssign("wgbar", "innerHTML","<img src=\"images/rpg/bar/wg.gif\" height=\"10\" width=\"".(($row['user_weight']/$row['user_weightall'])*200)."\" >");

	if ($row['user_exp']<$row['base_Exp']){
			$objResponse->addAssign("leveladd", "innerHTML","");
	}
	if ($row['user_exp']<$row['base_Exp']){
		$objResponse->addAssign("leveladd", "innerHTML","");
	}
	if ($row['user_exp']<$row['con_exp']){
		$objResponse->addAssign("con_add", "innerHTML","");
							}
	if ($row['user_exp']<$row['dex_exp']){
		$objResponse->addAssign("dex_add", "innerHTML","");
							}
	if ($row['user_exp']<$row['str_exp']){
		$objResponse->addAssign("str_add", "innerHTML","");
							}
	if ($row['user_exp']<$row['int_exp']){
		$objResponse->addAssign("int_add", "innerHTML","");
							}
	if ($row['user_exp']<$row['cha_exp']){
		$objResponse->addAssign("cha_add", "innerHTML","");
							}
	if ($row['user_exp']<$row['wis_exp']){
		$objResponse->addAssign("wis_add", "innerHTML","");
							}
	$objResponse->addAssign("uplevelexp", "innerHTML",$row['base_Exp']);
}
	
	}
	$db->sql_freeresult($result);
	return $objResponse->getXML();
}
function build_construct($buildid,$orderid,$sid){
	global $db,$phpEx, $phpbb_root_path,$user;
	$objResponse = new xajaxResponse();
	if (!$user->data['is_registered'])
	{
		$objResponse->addScript("location.reload();");
	}else{
	$sql = 'SELECT za.*,bu.*  FROM '.BUILD_CONSTRUCT.' za
			LEFT JOIN ' .BUILD_INFO.' bu ON(za.cbuild_id=bu.build_id) 
			WHERE za.buildtype=0 AND za.cbuild_id='.$buildid;
	
	$result = $db->sql_query($sql);
	if ($row = $db->sql_fetchrow($result)){
		//已经完成建设
		if (time()-$row['endtime']>=0){
			$sql = 'UPDATE ' .BUILD_INFO.' bu,' .BUILD_CONSTRUCT.' co SET bu.build_open=2,co.buildtype=1 WHERE bu.build_id=co.cbuild_id AND co.endtime<='.time().' AND co.cbuild_id='.$buildid;
			$db->sql_query($sql);
			$sql = 'DELETE FROM ' .BUILD_CONSTRUCT.' WHERE cbuild_id='.$buildid;
			$db->sql_query($sql);
			
			$type=$row['system_type'];
			if ($row['system_type']>500) $type=$row['system_type']-500;
			$message = $user->lang['SHOP_TYPE'].' : '.$user->lang['SHOPTYPE'][$type].'<br />'.
				$user->lang['SHOP_STATE'].' : '.$user->lang['SHOPSTATE']['2'].'<br />'.
				$user->lang['SHOP_USER'].' : '.$row['build_user'].'<br />'.
				$user->lang['SHOP_LEVEL'].' : '.$row['build_level'];
			$url=$phpbb_root_path.'shop.'.$phpEx.$sid.'&amp;cityid='.$row['city_id'].'&amp;shopid='.$buildid;
			$objResponse->addAssign("zatitle_".$orderid, "innerHTML","<a href=\"".$url."\">".$row['build_name']."</a>");
			$objResponse->addAssign("zacontent_".$orderid, "innerHTML",$message);
			$objResponse->addAssign("imgbuild_".$orderid, "innerHTML","<img src=\"images/rpg/build/$type.gif\" />");
		}

	}else{
		
	}
	$db->sql_freeresult($result);
	}
	return $objResponse->getXML();
}	


?>