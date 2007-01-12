<?php
define('IN_PHPBB', true);
$phpbb_root_path = './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);


 
include($phpbb_root_path . 'common.'.$phpEx);
include($phpbb_root_path . 'includes/function_confraternity.'.$phpEx);



// Basic parameter data
$i 	= request_var('i', 'main');
$mode	= request_var('mode', '');
$confid = request_var('conid', 1);
$cityid = request_var('cityid', 0);

if ($mode == 'login' || $mode == 'logout')
{
	define('IN_LOGIN', true);
}

// Start session management
$user->session_begin();
$auth->acl($user->data);

$user->setup('confraternityinfo');
$conf_info = array();


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

include($phpbb_root_path . 'includes/city_inc.'.$phpEx);


//得到建筑信息
$build_info=array();
$sql = 'SELECT * FROM ' .BUILD_INFO.' 
				WHERE build_id='.$confid .' AND build_open=1  AND city_id='.$user->data['last_place'];
		$result = $db->sql_query($sql);
if($row = $db->sql_fetchrow($result)){
		if($row['build_open']!=1){
			trigger_error('NOT_THIS_BUILD_OPEN');
		}else if ($row['city_id']!=$user->data['last_place']){
			trigger_error('YOU_NOT_THIS_CITY');
		}else{
			$build_info =$row;
		}

}else{
	trigger_error('NOT_THIS_BUILD');	
}

$db->sql_freeresult($result);	

$url = "{$phpbb_root_path}confraternity.$phpEx$SID&amp;cityid=$cityid&amp;conid=".$build_info['build_id'];

switch($mode){
	case 1:

	break;
	case 2:

	break;
	case 3:

	break;
	case 101:

	break;

	break;

}

switch($i)
{
	case '':
	case 'main':

		$template->assign_vars(array(
			'S_STUDY_ACTION'   => "confraternity.$phpEx$SID&amp;cityid=$cityid&amp;conid=$confid&amp;i=study",
			'S_DO_ACTION'   => "confraternity.$phpEx$SID&amp;cityid=$cityid&amp;conid=$confid&amp;i=do",
			'CITY_ID'   => $cityid,
			'SKILL_USE' => $user->lang['SKILL_USE'][$build_info['system_type']],
			'BUILD_NAME'=> $build_info['build_name'],
			'SYS_BUILD'=> $build_info['system_type'],
					)
			

		);
		page_header($user->lang['INDEX']);

		$template->set_filenames(array(
			'body' => 'confraternity_body.html')
		);

		page_footer();
	break;
/**************************************************************************************
/*
/*   技能学习
/*
/***************************************************************************************/
	case 'study':
		require_once ($phpbb_root_path . 'includes/xajax/xajax.inc.php');
		$xajax = new xajax($phpbb_root_path . 'includes/xajax/city/confraternity.server.php');

		$xajax->debugOn();
		$xajax->registerFunction('study');
		$sql = 'SELECT skills.*,sys_skills.* FROM ' .CONFRATERNITY_SKILLS.' skills, ' .USERS_SKILLS.'	user_skills 
				 LEFT JOIN 	' .SYSTEM_SKILLS.'	sys_skills	ON(skills.skillid=sys_skills.skill_id)	
				 WHERE skills.skillid<>user_skills.skill_id AND skills.buildid='.$confid.' AND cityid='.$user->data['last_place'];


		$result = $db->sql_query($sql);
		$i=1;
		while($row = $db->sql_fetchrow($result)){

			$template->assign_block_vars('skill_list', array(
				'DISPLAY_I'         => $i,
				'SKILL_ID' 		    => $row['skill_id'],
				'SKILL_NAME' 		=> $row['skill_name'],
				'SKILL_DESC' 		=> $row['skill_desc'],
				'SKILL_LV'          => $row['stduy_lv'],
				'SYS_BUILD'			=>$row['sysbuild'],
				'U_ISHAVE'          =>($user->data['user_id'])?true:false,
				'PRICE_G'           => ($row['price_g'])?$row['price_g']:0,
				'PRICE_S'           => ($row['price_s'])?$row['price_s']:0,
				'PRICE_C'           => ($row['price_c'])?$row['price_c']:0,
				)
			);

			$i++;
		}
		$template->assign_vars(array(
				'M_AJAX'        => $xajax->getJavascript(),
				'BUILDID'       => $confid,
				'BUILD_NAME'=> $build_info['build_name'],
				'S_MAIN_URL'=>$url,
			));
		$db->sql_freeresult($result);
		// Output page
		page_header($user->lang['INDEX']);

		$template->set_filenames(array(
			'body' => 'confraternity_studyskill_body.html')
		);

		page_footer();
	break;
/**************************************************************************************
/*
/*   物品制作
/*
/***************************************************************************************/
	case 'do':
		require_once ($phpbb_root_path . 'includes/xajax/xajax.inc.php');
		$xajax = new xajax($phpbb_root_path . 'includes/xajax/city/confraternity.server.php');

		$xajax->debugOn();
		$xajax->registerFunction('objectscount');
		$xajax->registerFunction('objectsstart');
		$sql = 'SELECT formula.*,sys_formula.* FROM ' .CONFRATERNITY_FORMULA.' formula   
				LEFT JOIN 	' .SYSTEM_FORMULA.'	sys_formula	ON(formula.formulaid=sys_formula.formulaid)
				  WHERE formula.buildid='.$confid.' AND formula.cityid='.$user->data['last_place'];
		$result = $db->sql_query($sql);

		while($row = $db->sql_fetchrow($result)){
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
			$template->assign_block_vars('formula_list', array(

				'FORMULA_ID' 		    => $row['formulaid'],
				'OBJECTNAME' 		    => $row['objectname'],
				'OBJECTID' 		    => $row['objectid'],
				'CASTG' 		    => $row['price_g'],
				'CASTS' 		    => $row['price_s'],
				'CASTC' 		    => $row['price_c'],
				'SKILL1ID' 		    => ($skill1['skid'])?$skill1['skid']:0,
				'SKILL1NAME' 		    =>($skill1['skid'])? $skill1['skname']:'',
				'SKILL1LV' 		    => ($skill1['skid'])?$skill1['sklv']:0,			
				'SKILL2ID' 		    => ($skill2)?$skill2['skid']:0,
				'SKILL2NAME' 		    =>($skill2)? $skill2['skname']:'',
				'SKILL2LV' 		    => ($skill2)?$skill2['sklv']:0,	
				'OBJECT1ID'           => ($object1)? $object1['obid']:0,
				'OBJECT1NAME'           => ($object1)? $object1['obname']:'',
				'OBJECT1LV'           => ($object1)? $object1['oblv']:0,
				'OBJECT1NUM'           => ($object1)? $object1['obnum']:0,
				'OBJECT2ID'           => ($object2)? $object2['obid']:0,
				'OBJECT2NAME'           => ($object2)? $object2['obname']:'',
				'OBJECT2LV'           => ($object2)? $object2['oblv']:0,
				'OBJECT2NUM'           => ($object2)? $object2['obnum']:0,
				'OBJECT3ID'           => ($object3)? $object3['obid']:0,
				'OBJECT3NAME'           => ($object3)? $object3['obname']:'',
				'OBJECT3LV'           => ($object3)? $object3['oblv']:0,
				'OBJECT3NUM'           => ($object3)? $object3['obnum']:0,
				'OBJECT4ID'           => ($object4)? $object4['obid']:0,
				'OBJECT4NAME'           => ($object4)? $object4['obname']:'',
				'OBJECT4LV'           => ($object4)? $object4['oblv']:0,
				'OBJECT4NUM'           => ($object4)? $object4['obnum']:0,
				)
			);

		}
		$template->assign_vars(array(
				'M_AJAX'        => $xajax->getJavascript(),
				'BUILDID'       => $confid,
				'BUILD_NAME'=> $build_info['build_name'],
				'S_MAIN_URL'=>$url,
				'SKILL_USE' => $user->lang['SKILL_USE'][$build_info['system_type']],
			));
		$db->sql_freeresult($result);
		// Output page
		page_header($user->lang['INDEX']);

		$template->set_filenames(array(
			'body' => 'confraternity_do_body.html')
		);

		page_footer();
	break;
}


?>