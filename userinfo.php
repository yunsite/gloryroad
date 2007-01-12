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

// Basic parameter data
$id 	= request_var('i', 1);
$mode	= request_var('mode', '');


if ($mode == 'login' || $mode == 'logout')
{
	define('IN_LOGIN', true);
}

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('user_info');

// Only registered users can go beyond this point
if (!$user->data['is_registered'])
{
	if ($user->data['is_bot'])
	{
		redirect("index.$phpEx$SID");
	}

	login_box('', $user->lang['LOGIN_EXPLAIN_UCP']);
}

$template->assign_vars(array(
	'U_IMG_GENDER'     => $user->data['user_gender'],
	'U_IMG_PHYLE'     => $user->data['user_phyle'],
	)
);


switch ($mode)
{
	case '':
	case 'g':
	break;
	case 'show':
	break;
	case 'list':
	break;
	case 'updatelevel':

	break;
}

//用户分栏
switch ($id)
{
	//个人属性
	case 1:

		include($phpbb_root_path . 'xajax.common.'.$phpEx);

		$user->setup('godliness');
		$sql = 'SELECT base_Exp 
			FROM ' . SYSTEM_EXP . '  
			WHERE Level = '. $user->data['user_level'];
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);
		
		$template->assign_vars(array(
			'U_HP_NOW'			=>	($user->data['user_hp']/$user->data['user_hpall'])*200,
			'U_MAGIC_NOW'			=>	($user->data['user_hp']/$user->data['user_magicall'])*200,
			'U_ENERGY'			=>  ($user->data['activity']/$user->data['activityall'])*200,
			'U_WEIGHT'			=>  ($user->data['user_weight']/$user->data['user_weightall'])*200,
			'U_EXP'             => ($user->data['user_exp']/$row['base_Exp'])*200,
			'U_NOW_EXP'         => $user->data['user_exp'],
			'U_UPLEVELEXP'		=> $row['base_Exp'],
			'U_PHYLE'           => $user->lang['PHYLES'][$user->data['user_phyle']],
			'U_GODLINESS'       => $user->lang['GODLINESS'][$user->data['user_godliness']],
			'U_CREDIT'          => $user->data['user_credit'],
			'U_LEVEL'           => $user->data['user_level'],
			'U_CON'             => $user->data['user_con'],
			'U_STR'             => $user->data['user_str'],
			'U_DEX'             => $user->data['user_dex'],
			'U_INT'             => $user->data['user_int'],
			'U_CHA'             => $user->data['user_cha'],
			'U_WIS'             => $user->data['user_wis'],
			'U_GENDER'          =>  $user->lang['GENDER'][$user->data['user_gender']],
			'S_UPDATE_LEVEL'    =>($user->data['user_exp']>=$row['base_Exp'])?true:false,
			'S_UPDATE_CON'   =>($user->data['user_exp']>=$user->data['con_exp'])?true:false,
			'S_UPDATE_STR'   =>($user->data['user_exp']>=$user->data['str_exp'])?true:false,
			'S_UPDATE_DEX'   =>($user->data['user_exp']>=$user->data['dex_exp'])?true:false,
			'S_UPDATE_INT'   =>($user->data['user_exp']>=$user->data['int_exp'])?true:false,
			'S_UPDATE_CHA'   =>($user->data['user_exp']>=$user->data['cha_exp'])?true:false,
			'S_UPDATE_WIS'   =>($user->data['user_exp']>=$user->data['wis_exp'])?true:false,
			'M_AJAX'               => $xajax->getJavascript(),
			)
		);



	break;
	//个人背包
	case 2:
		include($phpbb_root_path . 'includes/functions_rpg.' . $phpEx);
		
		$template->assign_vars(array(
			'U_BAG_LIST'			=>	display_bag(1)
			)
		);
	break;
	//技能列表
	case 3:
	break;
	case 4:

		$sql = 'SELECT userskill.*,sysskills.* 
			FROM ' . USERS_SKILLS . '  userskill
			LEFT JOIN '.SYSTEM_SKILLS.' sysskills ON (userskill.skill_id=sysskills.skill_id)
			WHERE user_id = '. $user->data['user_id'];
		$result = $db->sql_query($sql);
		while($row = $db->sql_fetchrow($result)){

		$template->assign_block_vars('skill_list', array(
				'SKILL_ID' 		    => $row['skill_id'],
				'SKILL_NAME' 		=> $row['skill_name'],
				'SKILL_DESC' 		=> $row['skill_desc'],
				'SKILL_LV'          => $row['skill_lv'],
				'SYS_BUILD'         => $row['sysbuild'],
				'SKILL_USE'			=> $row['time'],
				'SKILL_LEN'         => $row['time']/2
				)
			);

		}
		$db->sql_freeresult($result);
	break;
	case 4:
	break;
}
// Get user details for  display
$sql = 'SELECT user.user_avatar,user.user_avatar_type,user.user_avatar_width,user.user_avatar_height,userinfo.*
	FROM ' . USER_EXINFO . ' AS  userinfo  
	LEFT JOIN ' . USERS_TABLE . ' AS user ON (user.user_id=userinfo.user_id )
	WHERE userinfo.user_id = '. $user->data['user_id'];
$result = $db->sql_query($sql);

$legend = '';
if ($row = $db->sql_fetchrow($result))
{
	
}else{
	

}
$db->sql_freeresult($result);




// Assign index specific vars
$template->assign_vars(array(
	'U_URL'	        => "{$phpbb_root_path}userinfo.$phpEx$SID&amp;i=",
	'S_SELECTED1'   => ($id==1)?'id="activetab"':'',
	'S_SELECTED2'	=> ($id==2)?'id="activetab"':'',
	'S_SELECTED3'	=> ($id==3)?'id="activetab"':'',
	'S_SELECTED4'	=> ($id==4)?'id="activetab"':'',
	'S_USER_INFO'   => ($id==1)?true:false,
	'S_USER_BAG'    => ($id==2)?true:false,
	'S_USER_SKILLS'  =>($id==4)?true:false,	
	'U_MCP'				=> ($auth->acl_get('m_')) ? "{$phpbb_root_path}mcp.$phpEx$SID&amp;i=main&amp;mode=front" : '')
);

// Output page
page_header($user->lang['INDEX']);

$template->set_filenames(array(
	'body' => 'user_info_body.html')
);

page_footer();

?>