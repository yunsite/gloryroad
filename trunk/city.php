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



// Basic parameter data
$cityid 	= request_var('cityid', 1);
$mode		= request_var('mode', '');
$i			= request_var('i', '');

if ($mode == 'login' || $mode == 'logout')
{
	define('IN_LOGIN', true);
}

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('user_event');
$user->setup('ucp');

// Only registered users can go beyond this point
if (!$user->data['is_registered'])
{
	if ($user->data['is_bot'])
	{
		redirect("index.$phpEx$SID");
	}

	login_box('', $user->lang['LOGIN_EXPLAIN_UCP']);
}
include($phpbb_root_path . 'includes/function_event.'.$phpEx);
include($phpbb_root_path . 'includes/city_inc.'.$phpEx);


switch($mode){
	case 1:
		//开荒，扩充土地
		event_contribution(1,$cityid);
	break;
	case 2:
		//耕种，增加粮食
		event_contribution(2,$cityid);
	break;
	case 3:
		//改善环境
		event_contribution(3,$cityid);
	break;
	case 101:
		//改善环境
		event_contribution(101,$cityid);
	break;

}

switch ($i)
{
	case '':
		
		
		$template->assign_vars(array(
			'S_POST_ACTION'   => "city.$phpEx$SID&amp;cityid=$cityid",
			'CITY_ID'   => $cityid,
					)
			

		);
		//查询高级动作
		$sql = 'SELECT * FROM ' .USER_EVENT.' 
				WHERE city_id ='.$cityid.' AND user_id='.$user->data['user_id'] .' AND eventtype=1 AND (creat_time+useful_life)>'.time() ;
		$result = $db->sql_query($sql);	
		
	
		// Output page
		while($row = $db->sql_fetchrow($result)){
				$residual =$user->lang['RESIDUAL'];
				$limit_time = $row['creat_time']+$row['useful_life']-time();
				$n=Floor($limit_time/86400);
				if($n>=1){
					$residual.=$n.$user->lang['DAY'];
					$limit_time= $limit_time-(86400*$n);
				}
				$n=Floor($limit_time/3600);
				if($n>=1){
					$residual.=$n.$user->lang['DAY'];
					$limit_time=$limit_time-(3600*$n);
				}
				$n=Floor($limit_time/60);
				if($n>=1){
					$residual.=$n.$user->lang['MINUTES'];
					$limit_time=$limit_time-(60*$n);
				}
				$residual.= $limit_time.$user->lang['SECONDS'];

				$template->assign_block_vars('user_event_list', array(
				'EVENT_ID'		   => $row['event_id'],
				'EVENT_NAME'       => $user->lang['EVENT_'.$row['event_id']],
				'EVENT_DESC'	   => $user->lang['EVENT_'.$row['event_id'].'_DESC'],
				'EVENT_LIMIT'	   => $residual,
			));
			
		}

		
		$db->sql_freeresult($result);
		
		page_header($user->lang['INDEX']);


		if($city_info['city_id']<20){
			$template->set_filenames(array(
				'body' => 'city_'.$city_info['city_id'].'_outbody.html')
			);
		}else{
			$template->set_filenames(array(
				'body' => 'city/city_outbody.html')
			);	
		}
		page_footer();		

	break;
	case 'main':
		//查询所有城市建筑列表
		$sql = 'SELECT * FROM ' .BUILD_INFO.' 
				WHERE city_id ='.$cityid .' AND build_hot>0';
		$result = $db->sql_query($sql);
		while($row = $db->sql_fetchrow($result)){
			$url = '';
			switch($row['system_type']){
				case 504:
					$url = "{$phpbb_root_path}shop.$phpEx$SID&amp;cityid=$cityid&amp;shopid=".$row['build_id'];
				break;
				case 306:
					$url = "{$phpbb_root_path}confraternity.$phpEx$SID&amp;cityid=$cityid&amp;conid=".$row['build_id'];
				break;
			}
			$template->assign_block_vars('city_build_list', array(
				'BUILD_NAME'       => $row['build_name'],
				'BUILD_URL'		   => $url,
				'BUILD_DESC'       => $row['build_desc'],
				'BUILD_LEVEL'      => $row['build_level'],
				'BUILD_OPEN'	   => $row['build_open'],
				'BUILD_DATE'		=> $user->format_date($row['build_date']),
			));
		
		}
		$db->sql_freeresult($result);	   

		// Output page
	
		page_header($user->lang['INDEX']);
		if($city_info['city_id']<20){
			$template->set_filenames(array(
				'body' => 'city_'.$city_info['city_id'].'_body.html')
			);
		}else{
			$template->set_filenames(array(
				'body' => 'city/city_body.html')
			);	
		}
		page_footer();		

	break;
	case 'hall':
		//如果为用户建立的城市
		if($cityid>50){
			//查询所有城市建筑列表
			$sql = 'SELECT * FROM ' .BUILD_INFO.' 
					WHERE city_id ='.$cityid .' AND system_type>300';
			$result = $db->sql_query($sql);
			while($row = $db->sql_fetchrow($result)){
					if($row['system_type']==317&&$row['hardiness']>0){
								$template->assign_vars(array(
										'MAGIC_R_V'  => ($city_info['city_magic_recovery']>=200)?$user->lang['ALL_RIGHT']:$user->lang['DANGER'],
										)

									);
					}		
			}
			$db->sql_freeresult($result);	 
	
		}else{
			$template->assign_vars(array(
					'MAGIC_R_V'  =>$user->lang['ALL_RIGHT']
										)

			);
		}
		// 显示修路数据
		$sql = 'SELECT city_road.*,city_info.city_name,city_info.country_id as to_countryid FROM ' .CITY_ROAD.' city_road
				LEFT JOIN '.CITY_INFO.' city_info ON(city_road.city2 = city_info.city_id )	
				WHERE city_road.city1 ='.$cityid ;
		$result = $db->sql_query($sql);	
		while($row = $db->sql_fetchrow($result)){
			$template->assign_block_vars('city_road_list', array(
				'TO_CITY'		=> $row['city_name'],
				'NUM'			=> $row['numerical_value'],
				'ROAD_LEVEL'    => $row['level'],
				'COUNTRY_INFO'		=> ($city_info['country_id']!=0&&$city_info['country_id']==$row['to_countryid'])?$user->lang['HOMELAND']:$user->lang['FREMDNESS'],
			));
		
		}
		$db->sql_freeresult($result);

		$template->assign_vars(array(
			'CITY_POPULATION'   => $city_info['city_population'],
			'CITY_DATE'			=>  $user->format_date($city_info['city_date']),
			'CITYLEVEL_V'       => ($city_info['city_lv']>6)?$user->lang['CITY_LEVEL_V'][6]:$user->lang['CITY_LEVEL_V'][$city_info['city_lv']],
			'CITYPROTECTION_V'  => ($city_info['city_protection']==0)?$user->lang['UNKNOW']:$city_info['city_protection'],
			'CITY_XY_V'			=>  $city_info['city_xy'],
			'U_APPLY_BUY'    =>"{$phpbb_root_path}city.$phpEx$SID&amp;i=applyroom&amp;cityid=$cityid",
			)
			

		);

		page_header($user->lang['INDEX']);
			$template->set_filenames(array(
				'body' => 'city_1_hall_body.html')
			);	

		page_footer();		

	break;
	case 'biz':
		require_once ($phpbb_root_path . 'includes/xajax/xajax.inc.php');
		$xajax = new xajax($phpbb_root_path . 'includes/xajax/city/build.server.php');

		//$xajax->debugOn();
		$xajax->registerFunction('construct');
		$section = request_var('section', 0);
		$sqlstr='';
		if ($section!=0) $sqlstr='AND zoneid ='.$section;
 
		$user->setup('shop_info');
		$sql = 'UPDATE ' .BUILD_INFO.' bu,' .BUILD_CONSTRUCT.' co SET bu.build_open=2,co.buildtype=1 WHERE bu.build_id=co.cbuild_id  AND co.endtime<'.time();
		$db->sql_query($sql);	
		//选择街区
		$sql = 'SELECT *  FROM ' .CITY_ZONE.' 
					WHERE zonetype=1 '.$sqlstr.' AND city_id='.$cityid.' ORDER BY zoneordy LIMIT 1';
		$result = $db->sql_query($sql);	 
		if ($row = $db->sql_fetchrow($result)){
			$template->assign_vars(array(
				'STREET_NAME'   =>$row['zonetitle'],
				'STREET_ALL'    =>$row['zoneacreage'],
				'M_AJAX'        => $xajax->getJavascript(),
				'S_ID'          => $SID,
			));

			$section =$row['zoneid'];
         }

		$db->sql_freeresult($result);
		$sql = 'SELECT za.*,bu.*,co.* FROM ' .CITY_ZONE.' za 
					LEFT JOIN ' .BUILD_INFO.' bu ON(za.zoneid=bu.zone_id )
					LEFT JOIN ' .BUILD_CONSTRUCT.' co ON(co.cbuild_id=bu.build_id)
					WHERE za.zonetype=2 AND za.parentid='.$section .' AND za.city_id='.$cityid.' ORDER BY za.zoneordy';

		$result = $db->sql_query($sql);	

		$useracreage=0;
		//******************************************************
		//
		// zonestate 土地状态 0 出售中，1已售出，2工程中，3，完成
		//
		//******************************************************

		while($row = $db->sql_fetchrow($result)){
			$url='';
			switch($row['system_type']){
				case 4:
				case 507:
				case 504:
					$url="{$phpbb_root_path}shop.$phpEx$SID&amp;cityid=$cityid&amp;shopid=".$row['build_id'];
				break;
				case 306:
					$url = "{$phpbb_root_path}confraternity.$phpEx$SID&amp;cityid=$cityid&amp;conid=".$row['build_id'];
				break;
			}
				
				$butime =ceil(($row['endtime']-time())%3600*24);
				//如果是土地所有者
				if (($row['zoneuser_id']==$user->data['user_id'])&&($row['build_id']>0&&$row['build_open']==0)){ 
					$butime =$row['endtime']-time();
				}
			$template->assign_block_vars('city_zone_list', array(
				'BUILD_ID'		=>($row['build_id']>0)?$row['build_id']:0,
				'BUILD_IMG'		=> ($row['build_id']>0&&$row['build_open']>0)?$row['system_type']:'0'.$row['zonestate'],
				'BUILD_NAME'	=> $row['build_name'],
				'BUILD_TYPE'    => ($row['system_type']>0)?$user->lang['CITY_BUILD_V'][$row['system_type']]:'',
				'BUILD_STATE'   =>($row['build_open']>0)?$user->lang['SHOPSTATE'][$row['build_open']]:'',
				'BULID_TYPE'	=> $row['build_name'],
				'ZONE_ORDER'	=> $row['zoneordy'],
				'ZP_GOLD'       =>( $row['zoneprice_g'])?$row['zoneprice_g'].$user->lang['G_COIN']:'',
				'ZP_SILVER'     =>( $row['zoneprice_s'])?$row['zoneprice_s'].$user->lang['S_COIN']:'',
				'ZP_COPPER'     =>( $row['zoneprice_c'])?$row['zoneprice_c'].$user->lang['C_COIN']:'',
				'ZONE_AREA'     =>$row['zoneacreage'],
				'ZONE_STATE'    =>$row['zonestate'],
				'BUILD_URL'     =>$url,
				'BUILD_USER'    =>$row['build_user'],
				'BUILD_LEVEL'   =>$row['build_level'],
				'BUILD_SHOW'    =>($row['build_id']>0&&$row['build_open']>0)?true:false,
				'BUILD_TIME'    =>($row['cbuild_id']>0)?$butime:'',
				'BUILD_TIMESHOW'    =>(($row['zoneuser_id']==$user->data['user_id'])&&($row['build_id']>0&&$row['build_open']==0))?true:false,

			));

			$useracreage =$useracreage+$row['zoneacreage']; 
		}
       
		$db->sql_freeresult($result);
			$template->assign_vars(array(
				'STREET_USE'    =>$useracreage,
			));
			page_header($user->lang['INDEX']);
			$template->set_filenames(array(
				'body' => 'city_1_bizbody.html')
			);	

		page_footer();	
	break;
	case 'town':
		require_once ($phpbb_root_path . 'includes/xajax/xajax.inc.php');
		$xajax = new xajax($phpbb_root_path . 'includes/xajax/city/build.server.php');
		$xajax->registerFunction('construct');

		$section = request_var('section', 0);
		$sqlstr='';
		if ($section!=0) $sqlstr='AND zoneid ='.$section;
 
		$user->setup('shop_info');
		$sql = 'UPDATE ' .BUILD_INFO.' bu,' .BUILD_CONSTRUCT.' co SET bu.build_open=2,co.buildtype=1 WHERE bu.build_id=co.cbuild_id  AND co.endtime<'.time();
		$db->sql_query($sql);	
		//选择街区
		$sql = 'SELECT *  FROM ' .CITY_ZONE.' 
					WHERE zonetype=3 '.$sqlstr.' AND city_id='.$cityid.' ORDER BY zoneordy LIMIT 1';
		$result = $db->sql_query($sql);	 
		if ($row = $db->sql_fetchrow($result)){
			$template->assign_vars(array(
				'STREET_NAME'   =>$row['zonetitle'],
				'STREET_ALL'    =>$row['zoneacreage'],
				'M_AJAX'        => $xajax->getJavascript(),
				'S_ID'          => $SID,
			));

			$section =$row['zoneid'];
         }

		$db->sql_freeresult($result);
		$sql = 'SELECT za.*,bu.*,co.* FROM ' .CITY_ZONE.' za 
					LEFT JOIN ' .BUILD_INFO.' bu ON(za.zoneid=bu.zone_id )
					LEFT JOIN ' .BUILD_CONSTRUCT.' co ON(co.cbuild_id=bu.build_id)
					WHERE za.zonetype=4 AND za.parentid='.$section .' AND za.city_id='.$cityid.' ORDER BY za.zoneordy';

		$result = $db->sql_query($sql);	

		$useracreage=0;
		//******************************************************
		//
		// zonestate 土地状态 0 出售中，1已售出，2工程中，3，完成
		//
		//******************************************************

		while($row = $db->sql_fetchrow($result)){
			$url='';
			switch($row['system_type']){
				case 4:
				case 507:
				case 504:
					$url="{$phpbb_root_path}shop.$phpEx$SID&amp;cityid=$cityid&amp;shopid=".$row['build_id'];
				break;
			}
				
				$butime =ceil(($row['endtime']-time())%3600*24);
				//如果是土地所有者
				if (($row['zoneuser_id']==$user->data['user_id'])&&($row['build_id']>0&&$row['build_open']==0)){ 
					$butime =$row['endtime']-time();
				}
			$template->assign_block_vars('city_zone_list', array(
				'BUILD_ID'		=>($row['build_id']>0)?$row['build_id']:0,
				'BUILD_IMG'		=> ($row['build_id']>0&&$row['build_open']>0)?(($row['system_type']>100)?$row['system_type']-500:$row['system_type']):'0'.$row['zonestate'],
				'BUILD_NAME'	=> $row['build_name'],
				'BUILD_TYPE'    => ($row['system_type']>0)?(($row['system_type']>100)?($user->lang['SHOPTYPE'][($row['system_type']-500)]):$user->lang['SHOPTYPE'][$row['system_type']]):'',
				'BUILD_STATE'   =>($row['build_open']>0)?$user->lang['SHOPSTATE'][$row['build_open']]:'',
				'BULID_TYPE'	=> $row['build_name'],
				'ZONE_ORDER'	=> $row['zoneordy'],
				'ZP_GOLD'       =>( $row['zoneprice_g'])?$row['zoneprice_g'].$user->lang['G_COIN']:'',
				'ZP_SILVER'     =>( $row['zoneprice_s'])?$row['zoneprice_s'].$user->lang['S_COIN']:'',
				'ZP_COPPER'     =>( $row['zoneprice_c'])?$row['zoneprice_c'].$user->lang['C_COIN']:'',
				'ZONE_AREA'     =>$row['zoneacreage'],
				'ZONE_STATE'    =>$row['zonestate'],
				'BUILD_URL'     =>$url,
				'BUILD_USER'    =>$row['build_user'],
				'BUILD_LEVEL'   =>$row['build_level'],
				'BUILD_SHOW'    =>($row['build_id']>0&&$row['build_open']>0)?true:false,
				'BUILD_TIME'    =>($row['cbuild_id']>0)?$butime:'',
				'BUILD_TIMESHOW'    =>(($row['zoneuser_id']==$user->data['user_id'])&&($row['build_id']>0&&$row['build_open']==0))?true:false,

			));

			$useracreage =$useracreage+$row['zoneacreage']; 
		}
       
		$db->sql_freeresult($result);
			$template->assign_vars(array(
				'STREET_USE'    =>$useracreage,
			));
				page_header($user->lang['INDEX']);
			$template->set_filenames(array(
				'body' => 'city_1_bizbody.html')
			);	

		page_footer();	
	break;
	case 'applyroom':
		require_once ($phpbb_root_path . 'includes/xajax/xajax.inc.php');
		$xajax = new xajax($phpbb_root_path . 'includes/xajax/city/license.server.php');

		$xajax->registerFunction('license');
		//$xajax->debugOn();
		$user->setup('shop_info');
		
		$sql = 'SELECT tech.* FROM ' .CITY_TECH.' tech
				WHERE city_id ='.$cityid ;
		$result = $db->sql_query($sql);	
		if($row = $db->sql_fetchrow($result)){
			$template->assign_vars(array(
				'C_BUILD_LV'		=> $row['city_build_lv'],
				'U_HALL_ROOM'    =>"{$phpbb_root_path}city.$phpEx$SID&amp;i=hall&amp;cityid=$cityid",
				'M_AJAX'        => $xajax->getJavascript(),
				'CITY_ID'       => $cityid,
			));
		
		}
		$db->sql_freeresult($result);
		$sql = 'SELECT * FROM ' .CITY_LICENSE.' 
				WHERE cityid ='.$cityid.'' ;
		$result = $db->sql_query($sql);	
		while($row = $db->sql_fetchrow($result)){
			if ($row['licensetype']==1){
					$t_time ='';
					if($row['useful_life']>3600){
						$h= $row['useful_life']/3600;
						$t_time = $h.$user->lang['HOUR'];
						if (($row['useful_life']%3600)>60){
							$m= ($row['useful_life']%3600)/60;
							$t_time .= $m.$user->lang['MINUTE'];
						}
						
					}else{
						$t_time = $user->lang['FOREVER'];
					}
					
				$template->assign_block_vars('city_work_licenses', array(
					'LICENSE_ID'		=> $row['recordid'],
					'LICENSE_NAME'		=> $user->lang['EVENT_'.$row['licenseid']],
					'LICENSE_TIME'		=> $t_time,
					'LICENSE_DESC'		=> $user->lang['EVENT_'.$row['licenseid']],
					'LICENSE_PRICE'     => $row['price'],
					
				));
			}
			if ($row['licensetype']==2){
				$template->assign_block_vars('city_tbuild_licenses', array(
					'LICENSE_ID'		=> $row['recordid'],
					'BUILD_NAME'		=> $user->lang['CITY_BUILD_V'][$row['licenseid']],
					'LICENSE_PRICE'     => $row['price'],
				));
			}
			if ($row['licensetype']==3){
				$template->assign_block_vars('city_bbuild_licenses', array(
					'LICENSE_ID'		=> $row['recordid'],
					'BUILD_NAME'		=> $user->lang['CITY_BUILD_V'][$row['licenseid']],
					'LICENSE_PRICE'     => $row['price'],
				));
			}		
		}
		$db->sql_freeresult($result);	

		page_header($user->lang['INDEX']);
			$template->set_filenames(array(
				'body' => 'city_1_apply_body.html')
			);	

		page_footer();		
	break;
}











?>