<?php
/** 
*
* @package phpBB3
* @version $Id: functions_shop.php,v 1.81 2006/03/25 12:07:00 acydburn Exp $
* @copyright (c) 2005 phpBB Group 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/
include($phpbb_root_path . 'includes/common_rpg_db.php');

/**
*   ����ѧϰ 
*/
function skill_study($skill,$buildid){
	global $db,$phpEx, $phpbb_root_path,$user;
	$objResponse = new xajaxResponse();
	if (!$user->data['is_registered'])
	{
		$objResponse->addScript("location.reload();");
	}else{
		$sql='SELECT * FROM '.BUILD_INFO. ' WHERE build_id='.$buildid;
		$result = $db->sql_query($sql);
		$buildinfo=array();
		if ($row = $db->sql_fetchrow($result)){
			$buildinfo = $row;
		}else{
			return $objResponse->getXML();
		}
		$db->sql_freeresult($result);

	$sql = 'SELECT skills.*,sys_skills.*,user_skills.* FROM ' .CONFRATERNITY_SKILLS.' skills 
				 LEFT JOIN 	' .SYSTEM_SKILLS.'	sys_skills	ON(skills.skillid=sys_skills.skill_id)	
				 LEFT JOIN 	' .USERS_SKILLS.'	user_skills	ON(skills.skillid=user_skills.skill_id AND user_id='.$user->data['user_id'].') 
			WHERE skills.skillid='.$skill.' AND skills.buildid='.$buildinfo['build_id'].' AND sys_skills.sysbuild ='.$buildinfo['system_type'];
	
	$result = $db->sql_query($sql);
	if ($row = $db->sql_fetchrow($result)){
		
		//����Ѿ�ӵ���˼��ܣ�����ѧϰ
		if($row['skill_lv']>0){
			return $objResponse->getXML();
		}
		if ($user->data['u_copper_coin']<$row['price_c']&&$user->data['u_silver_coin']<$row['price_s']&&$user->data['u_gold_coin']<$row['price_g']){
			$objResponse->addScript("msg(\"".$user->lang['NO_CCOIN']."\")");
			return $objResponse->getXML();		
		}

		$db->sql_transaction('begin');
		//����Ҫ�󣬴�����ѧϰ
		//���û���Ǯ

		$sql='UPDATE '.USER_EXINFO.' SET u_copper_coin=u_copper_coin-'.$row['price_c'].',u_silver_coin=u_silver_coin-'.$row['price_s'].'  ,u_gold_coin=u_gold_coin-'.$row['price_g'].'  WHERE user_id='.$user->data['user_id'];
		$db->sql_query($sql);
		//��Ӽ��ܵ��û���
		$sql='INSERT INTO '.USERS_SKILLS. '(skill_id,user_id,skill_lv,sys_build)
				VALUES('.$row['skillid'].','.$user->data['user_id'].',1,'.$row['sysbuild'].')';
		$db->sql_query($sql);

		$db->sql_transaction('commit');
		$objResponse->addScript("msg(\"".$user->lang['STUDY_SKILL_SUCESS']."\")");
		$objResponse->addRemove("skillli".$row['skillid']);

	}else{
		//������Ҫ����ʾ������Ϣ
		return $objResponse->getXML();
	}
	$db->sql_freeresult($result);
	}
	return $objResponse->getXML();
}	
/****************************************************************************************************
*   �������������
*****************************************************************************************************/
function do_objectscount($fid,$confid){
	global $db,$phpEx, $phpbb_root_path,$user,$objResponse;
	
	//����Ѿ���ʱ��ˢ��ҳ�棬�����½
	if (!$user->data['is_registered'])
	{
		$objResponse->addScript("location.reload();");
		return $objResponse->getXML();
	}
	$sql = 'SELECT formula.*,sys_formula.* FROM ' .CONFRATERNITY_FORMULA.' formula   
				LEFT JOIN 	' .SYSTEM_FORMULA.'	sys_formula	ON(formula.formulaid=sys_formula.formulaid)
				  WHERE formula.buildid='.$confid.' AND formula.cityid='.$user->data['last_place'].' AND 
				  formula.formulaid='.$fid;
	$result = $db->sql_query($sql);
	if ($row = $db->sql_fetchrow($result)){

			if($row['object1']!=''){
					$object1=unserialize($row['object1']);
			}else{
				$object1='';
			}
			if($row['object2']!=''){
					$object2=unserialize($row['object2']);
			}else{
				$object2='';
			}
			if($row['object3']!=''){
					$object3=unserialize($row['object3']);
			}else{
				$object3='';
			}
			if($row['object4']!=''){
					$object4=unserialize($row['object4']);
			}else{
				$object4='';
			}
			if($row['skill1']!=''){
					$skill1=unserialize($row['skill1']);
			}else{
				$skill1='';
			}
			if($row['skill2']!=''){
					$skill2=unserialize($row['skill2']);
			}else{
				$skill2='';
			}

			//�ж�Ǯ�������������
			$numcoin=0;
			if($row['price_g']>0){
				$numcoin=floor($user->data['u_gold_coin']/$row['price_g']);

			}

			if($row['price_s']>0){
				$snum = floor($user->data['u_silver_coin']/$row['price_s']);
				if($numcoin>0){
					if($snum<$numcoin) $numcoin=$snum;
				}else{
					$numcoin=$snum;
				}
			}

			if($row['price_c']>0){
				$cnum=floor($user->data['u_copper_coin']/$row['price_c']);
				if($numcoin>0){
					if($cnum<$numcoin) $numcoin=$cnum;
				}else{
					$numcoin=$cnum;
				}
				
			}
			
			
	}
    $db->sql_freeresult($result);
	//�ж��û��Ƿ����������
	if($row['skill1']!=''){
		$sql = 'SELECT skill_id,skill_lv FROM ' .USERS_SKILLS.'  
				  WHERE user_id='.$user->data['user_id'] .' AND skill_id='.$skill1['skid'].'  AND skill_lv>='.$skill1['sklv'];
		$result = $db->sql_query($sql);
		if (!$ff = $db->sql_fetchrow($result)){
			return 0;
		}
		$db->sql_freeresult($result);
	}
	if($row['skill2']!=''){
		$sql = 'SELECT skill_id,skill_lv FROM ' .USERS_SKILLS.'  
				  WHERE user_id='.$user->data['user_id'] .' AND skill_id='.$skill2['skid'].'  AND skill_lv>='.$skill2['sklv'];
		$result = $db->sql_query($sql);
		if (!$ff = $db->sql_fetchrow($result)){
			return 0;
		}
		$db->sql_freeresult($result);
	}


	//�ж���Ʒ����
	$strsql='(';
	if($object1!=''){
		$strsql .=$object1['obid'];
	}
	if($object2!=''){
		$strsql .=','.$object2['obid'];
	}
	if($object3!=''){
		$strsql .=','.$object3['obid'];
	}
	if($object4!=''){
		$strsql .=','.$object4['obid'];
	}
	$strsql.=')';
	$sql = 'SELECT objectid,object_num FROM ' .USER_BAG.'  
				  WHERE user_id='.$user->data['user_id'] .' AND objectid IN '.$strsql;
	$result = $db->sql_query($sql);
	$obs = array();
	$obnum1=$obnum2=$obnum3=$obnum4=0;
	while($row = $db->sql_fetchrow($result)){
		if($object1!=''&&$row['objectid']==$object1['obid']){
			$obnum1= floor($row['object_num']/$object1['obnum']);
		}
		if($object2!=''&&$row['objectid']==$object2['obid']){
			$obnum2= floor($row['object_num']/$object2['obnum']);
		}
		if($object3!=''&&$row['objectid']==$object3['obid']){
			$obnum3= floor($row['object_num']/$object3['obnum']);
		} 
		if($object4!=''&&$row['objectid']==$object4['obid']){
			$obnum4= floor($row['object_num']/$object4['obnum']);
		} 
	}
	$db->sql_freeresult($result);
	$onum= $obnum1;
	if($obnum2>0&&$obnum2<$onum) $onum= $obnum2; 
	if($obnum3>0&&$obnum3<$onum) $onum= $obnum3;
	if($obnum4>0&&$obnum4<$onum) $onum= $obnum4; 
	// onumΪԭ���Ͽ������������Ʒ����$numcoinΪǮ�������������Ʒ��
	if ($numcoin<$onum) $onum=$numcoin;
	//���յ��������Ϊ$onum
	
	return $onum;

}

/****************************************************************************************************
*   ��ʼ����
*   
*****************************************************************************************************/

function do_objectsstart($fid,$confid,$editnum){
	global $db,$phpEx, $phpbb_root_path,$user;
	$objResponse = new xajaxResponse();
	//����Ѿ���ʱ��ˢ��ҳ�棬�����½
	if (!$user->data['is_registered'])
	{
		$objResponse->addScript("location.reload();");
		return $objResponse->getXML();
	}
	$sql = 'SELECT formula.*,sys_formula.* FROM ' .CONFRATERNITY_FORMULA.' formula   
				LEFT JOIN 	' .SYSTEM_FORMULA.'	sys_formula	ON(formula.formulaid=sys_formula.formulaid)
				  WHERE formula.buildid='.$confid.' AND formula.cityid='.$user->data['last_place'].' AND 
				  formula.formulaid='.$fid;
	$result = $db->sql_query($sql);
	if ($fo = $db->sql_fetchrow($result)){

			if($fo['object1']!=''){
					$object1=unserialize($fo['object1']);
			}else{
				$object1='';
			}
			if($fo['object2']!=''){
					$object2=unserialize($fo['object2']);
			}else{
				$object2='';
			}
			if($fo['object3']!=''){
					$object3=unserialize($fo['object3']);
			}else{
				$object3='';
			}
			if($fo['object4']!=''){
					$object4=unserialize($fo['object4']);
			}else{
				$object4='';
			}
			if($fo['skill1']!=''){
					$skill1=unserialize($fo['skill1']);
			}else{
				$skill1='';
			}
			if($fo['skill2']!=''){
					$skill2=unserialize($fo['skill2']);
			}else{
				$skill2='';
			}
			//�ж�Ǯ�������������
			$numcoin=0;
			if($fo['price_g']>0){
				$numcoin=floor($user->data['u_gold_coin']/$fo['price_g']);

			}

			if($fo['price_s']>0){
				$snum = floor($user->data['u_silver_coin']/$fo['price_s']);
				if($numcoin>0){
					if($snum<$numcoin) $numcoin=$snum;
				}else{
					$numcoin=$snum;
				}
			}

			if($fo['price_c']>0){
				$cnum=floor($user->data['u_copper_coin']/$fo['price_c']);
				if($numcoin>0){
					if($cnum<$numcoin) $numcoin=$cnum;
				}else{
					$numcoin=$cnum;
				}
				
			}
			
			
			
	}
    $db->sql_freeresult($result);
	
	//�ж��û��Ƿ����������
	if($fo['skill1']!=''){
		$sql = 'SELECT skill_id,skill_lv FROM ' .USERS_SKILLS.'  
				  WHERE user_id='.$user->data['user_id'] .' AND skill_id='.$skill1['skid'].'  AND skill_lv>='.$skill1['sklv'];
		$result = $db->sql_query($sql);
		if (!$ff = $db->sql_fetchrow($result)){
			return $objResponse->getXML();
		}
		$db->sql_freeresult($result);
	}
	if($fo['skill2']!=''){
		$sql = 'SELECT skill_id,skill_lv FROM ' .USERS_SKILLS.'  
				  WHERE user_id='.$user->data['user_id'] .' AND skill_id='.$skill2['skid'].'  AND skill_lv>='.$skill2['sklv'];
		$result = $db->sql_query($sql);
		if (!$ff = $db->sql_fetchrow($result)){
			return $objResponse->getXML();
		}
		$db->sql_freeresult($result);
	}

	//�ж���Ʒ����
	$strsql='(';
	if($object1!=''){
		$strsql .=$object1['obid'];
	}
	if($object2!=''){
		$strsql .=','.$object2['obid'];
	}
	if($object3!=''){
		$strsql .=','.$object3['obid'];
	}
	if($object4!=''){
		$strsql .=','.$object4['obid'];
	}
	$strsql.=')';
	$sql = 'SELECT objectid,object_num FROM ' .USER_BAG.'  
				  WHERE user_id='.$user->data['user_id'] .' AND objectid IN '.$strsql;
	$result = $db->sql_query($sql);
	$obs = array();
	$obnum1=$obnum2=$obnum3=$obnum4=0;
	while($row = $db->sql_fetchrow($result)){
		if($object1!=''&&$row['objectid']==$object1['obid']){
			$obnum1= floor($row['object_num']/$object1['obnum']);
		}
		if($object2!=''&&$row['objectid']==$object2['obid']){
			$obnum2= floor($row['object_num']/$object2['obnum']);
		}
		if($object3!=''&&$row['objectid']==$object3['obid']){
			$obnum3= floor($row['object_num']/$object3['obnum']);
		} 
		if($object4!=''&&$row['objectid']==$object4['obid']){
			$obnum4= floor($row['object_num']/$object4['obnum']);
		} 
	}
	$db->sql_freeresult($result);
	$onum= $obnum1;
	if($obnum2>0&&$obnum2<$onum) $onum= $obnum2; 
	if($obnum3>0&&$obnum3<$onum) $onum= $obnum3;
	if($obnum4>0&&$obnum4<$onum) $onum= $obnum4; 
	// onumΪԭ���Ͽ������������Ʒ����$numcoinΪǮ�������������Ʒ��
	if ($numcoin<$onum) $onum=$numcoin;
	
	//���յ��������Ϊ$editnum
	if ($editnum>$onum)$editnum=$onum;
	//��ʼ�������ݣ����û���Ǯ������Ʒ�������Ʒ�����߸�����Ʒ
	$db->sql_transaction('begin');
	//��Ǯ
		$sql='UPDATE '.USER_EXINFO.' SET u_copper_coin=u_copper_coin-'.($fo['price_c']*$editnum).',u_silver_coin=u_silver_coin-'.($fo['price_s']*$editnum).'  ,u_gold_coin=u_gold_coin-'.($fo['price_g']*$editnum).'  WHERE user_id='.$user->data['user_id'];
		$db->sql_query($sql);
	//����Ʒ
	if($object1['obid']>0){
		$sql='UPDATE '.USER_BAG.' SET object_num=object_num-'.($object1['obnum']*$editnum).' 
					WHERE objectid= '.$object1['obid'].' AND user_id='.$user->data['user_id'];
		$db->sql_query($sql);
	}
	if($object2!=''&&$object2['obid']>0){
		$sql='UPDATE '.USER_BAG.' SET object_num=object_num-'.($object2['obnum']*$editnum).' 
					WHERE objectid= '.$object2['obid'].' AND user_id='.$user->data['user_id'];
		$db->sql_query($sql);
	}	
	if($object3!=''&&$object3['obid']>0){
		$sql='UPDATE '.USER_BAG.' SET object_num=object_num-'.($object3['obnum']*$editnum).' 
					WHERE objectid= '.$object3['obid'].' AND user_id='.$user->data['user_id'];
		$db->sql_query($sql);
	}
	if($object4!=''&&$object4['obid']>0){
		$sql='UPDATE '.USER_BAG.' SET object_num=object_num-'.($object4['obnum']*$editnum).' 
					WHERE objectid= '.$object4['obid'].' AND user_id='.$user->data['user_id'];
		$db->sql_query($sql);
	}
	$sql='DELETE FROM '.USER_BAG.' 	WHERE object_num=0 AND user_id='.$user->data['user_id'];
		$db->sql_query($sql);
	
	$db->sql_transaction('commit');
	$sql = 'SELECT objectid,object_num FROM ' .USER_BAG.'  
				  WHERE user_id='.$user->data['user_id'] .' AND objectid='.$fo['objectid'];
	$result = $db->sql_query($sql);
	if ($row = $db->sql_fetchrow($result)){
		$sql='UPDATE '.USER_BAG.' SET object_num=object_num+'.$editnum.' 
					WHERE objectid= '.$fo['objectid'].' AND user_id='.$user->data['user_id'];
		$db->sql_query($sql);
	}else{
	
	/********************************************************************************************** 
	*
	* �жϱ�����UPDATE����INSERT ,��������displayorder
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
		$sql='INSERT INTO '.USER_BAG.'(objectid,user_id,object_num,,displayorder)
				VALUES('.$fo['objectid'].','.$user->data['user_id'].','.$editnum.','.$display.')';
		$db->sql_query($sql);
	}
	$db->sql_freeresult($result);
	//��ʼ������
	$objResponse->addAssign("domax","disabled",false);
	$objResponse->addAssign("objectnum","disabled",true);
	$objResponse->addAssign("objectnum","value",0);
	$objResponse->addAssign("max","value",0);
	$objResponse->addAssign("doit","disabled",true);
	

	return $objResponse->getXML();

}




?>