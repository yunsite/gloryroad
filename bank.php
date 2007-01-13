<?php
/** 
*
* @package phpBB3
* @version $Id: search.php,v 1.114 2005/06/13 17:51:54 acydburn Exp $
* @copyright (c) 2005 phpBB Group 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
* @todo Introduce phrase bank?
* @todo Stemmers?
* @todo Find similar?
* @todo Relevancy?
*/

/**
*/
define('IN_PHPBB', true);




$phpbb_root_path = './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.'.$phpEx);

include($phpbb_root_path . 'includes/common_rpg_db.'.$phpEx);
include($phpbb_root_path . 'includes/bank_confg.'.$phpEx);

//table


// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('bank');

// Define initial vars
$mode		= request_var('mode', '');
$do			= request_var('do', '');
$cityid 	= request_var('cityid', 1);

$bank_money = array('u_copper_coin'=>0,'u_silver_coin'=>0,'u_gold_coin'=>0,'open'=>0);


if (!$user->data['is_registered'])
{
	if ($user->data['is_bot'])
	{
		redirect("index.$phpEx$SID");
	}

	login_box('', $user->lang['LOGIN_EXPLAIN_UCP']);
}

// Define some vars

include($phpbb_root_path . 'includes/city_inc.'.$phpEx);

$current_time	= time();
$sql = 'SELECT * 
	FROM ' . BANK_TABLE . '
	WHERE user_id='.$user->data['user_id'];

$result = $db->sql_query($sql);
if ($row = $db->sql_fetchrow($result)){

	$template->assign_block_vars('b_money', array(
		'COIN_N'	=> $user->lang['COPPER_COIN'].':',
		'MONEY'		=> $row['u_copper_coin'])
	);
	$template->assign_block_vars('b_money', array(
		'COIN_N'	=> $user->lang['SILVER_COIN'].':',
		'MONEY'		=> $row['u_silver_coin'])
		
	);
	$template->assign_block_vars('b_money', array(
		'COIN_N'	=> $user->lang['GOLD_COIN'].':',
		'MONEY'		=> $row['u_gold_coin'])
		
	);

}
$db->sql_freeresult($result);
$sql = 'SELECT * 
	FROM ' . BANK_LOG . '
	WHERE user_id='.$user->data['user_id'].' ORDER BY logdate DESC limit 0,5';
$result = $db->sql_query($sql);
$i=0;
while(($row = $db->sql_fetchrow($result))||$i<5){
	
	$template->assign_block_vars('b_log', array(
		'LOG_DATE'	 => ($row['logdate'])?$user->format_date($row['logdate']):'',
		'LOGTYPE'	 => ($row['typeid'])?$bank_log_action[$row['typeid']]:'',
		'LOGTITLE'   =>$row['title']
	));

	$i++;
}
$db->sql_freeresult($result);


switch ($do){
	case 'depositorwithdraw':
		$save_money	= request_var('save_money', 0);
		$coin_type	= request_var('coin_type', 0);
		$dorw		= request_var('dorw', 'd');

		if($coin_type < 1){
			trigger_error($user->lang['NOT_SELECT_COIN']);
		}
		if($save_money==0){
			trigger_error($user->lang['NOT_RIGHT_NUMBER']);
		}
		if(($save_money>0) && $coin_type && $dorw ){			
			
			if (!ereg('^[0-9]{1,10}$',$save_money))
			{
				trigger_error($user->lang['NOT_RIGHT_NUMBER']);
			}
	
			$sql = 'SELECT * 
				FROM ' . BANK_TABLE . '
				WHERE user_id='.$user->data['user_id'];
			$bankmoney = 0;
			switch($coin_type){
			    case 1:
					$table_col = 'u_copper_coin';
					$coin = $user->lang['COPPER_COIN'];
					break;
				case 2:
					$table_col = 'u_silver_coin';
					$coin = $user->lang['SILVER_COIN'];
					break;
				case 3:
					$table_col = 'u_gold_coin';
					$coin = $user->lang['GOLD_COIN'];
					break;
			}	
			$result = $db->sql_query($sql);
			if ($row = $db->sql_fetchrow($result)){
				$bankmoney = $row[$table_col];
			}else{
				trigger_error($user->lang['NOT_MEMBER_ACCOUNT']);
			}
	


			if($dorw=='w'&&$bankmoney<$save_money){
				trigger_error($user->lang['NOT_BANK_ENOUGH_MONEY']);
			}
			if($dorw=='d'&&$user->data[$table_col]<$save_money){
				trigger_error($user->lang['NOT_ENOUGH_MONEY']);
			}
			$action_flag=0;
			//存款操作
			if($dorw=='d'){
				$db->sql_transaction('begin');
					$sql='UPDATE ' . USER_INFO . ' SET ' . $table_col . '=' . $table_col . '-'. $save_money . ' 
						WHERE user_id=' . $user->data['user_id'];
						
					$db->sql_query($sql);
					$sql='UPDATE ' . BANK_TABLE . ' SET ' . $table_col . '=' . $table_col . '+'. $save_money . '
						WHERE user_id=' . $user->data['user_id'];
						
					$db->sql_query($sql);
				$db->sql_transaction('commit');
				
				$message = sprintf($user->lang['SUCCEED_SAVE_C'],$save_money).$coin;
				
			}
			//取款操作
			if($dorw=='w'){
				$db->sql_transaction('begin');
					$sql='UPDATE ' . BANK_TABLE . ' SET ' . $table_col . '=' . $table_col . '-'. $save_money . '
						WHERE user_id=' . $user->data['user_id'];
					$db->sql_query($sql);
					$sql='UPDATE ' . USER_INFO . ' SET ' . $table_col . '=' . $table_col . '+'. $save_money . '
						WHERE user_id=' . $user->data['user_id'];
					$db->sql_query($sql);
				$db->sql_transaction('commit');
				$message = sprintf($user->lang['SUCCEED_SEND_C'],$save_money).$coin;
				$action_flag=1;
			
			}
			$sql_ary = array(
				'user_id'		=> $user->data['user_id'],
				'title'			=> $message,
				'typeid'		=> $action_flag,
				'logdate'		=> $current_time
			);

			$sql = 'INSERT INTO ' . BANK_LOG . ' ' . $db->sql_build_array('INSERT', $sql_ary);
			$db->sql_query($sql);
			$url = "bank.$phpEx$SID";
			meta_refresh(3, $url);
			
			trigger_error($user->lang['SUCCEED_SAVE'].$message);
		}
		unset($action_flag,$table_col);
		$db->sql_freeresult($result);
	break;
	case 'send':
	
		$send_money	= request_var('send_money', 0);
		$coin_type	= request_var('coin_type', 0);
		$send_user		= request_var('send_user', '');
		if($send_user==$user->lang['TO_USER']){
			$send_user = '';
		}
		$send_userid=0;
		if($send_money==0){
			trigger_error($user->lang['NOT_RIGHT_NUMBER']);
		}
		if($coin_type < 1){
			trigger_error($user->lang['NOT_SEND_COIN']);
		}
		if($send_user==''){
			trigger_error($user->lang['EMPTY_USERNAME']);
		}
		switch($coin_type){
			case 1:
				$table_col = 'u_copper_coin';
				$coin = $user->lang['COPPER_COIN'];
				break;
			case 2:
				$table_col = 'u_silver_coin';
				$coin = $user->lang['SILVER_COIN'];
				break;
			case 3:
				$table_col = 'u_gold_coin';
				$coin = $user->lang['GOLD_COIN'];
				break;
		}
		$sql = 'SELECT * 
			FROM ' . BANK_TABLE . '
			WHERE user_id='.$user->data['user_id'];
		$bankmoney = 0;
		$result = $db->sql_query($sql);
		if ($row = $db->sql_fetchrow($result)){
			$bankmoney = $row[$table_col];
		}else{
			trigger_error($user->lang['NOT_MEMBER_ACCOUNT']);
		}
		if($bankmoney<$send_money){
				trigger_error($user->lang['NOT_BANK_ENOUGH_MONEY']);
		}
		if(($send_money>0) && $coin_type && $send_user){			
			
			if (!ereg('^[0-9]{1,10}$',$send_money))
			{
				trigger_error($user->lang['NOT_RIGHT_NUMBER']);
			}
			$sql = 'SELECT users.username,bank.user_id  
			FROM ' . USER_INFO .' users
			LEFT JOIN ' . BANK_TABLE . " bank ON(users.user_id=bank.user_id)
			WHERE users.username='".$db->sql_escape($send_user)."'";

			$result = $db->sql_query($sql);
			if ($row = $db->sql_fetchrow($result))
			{
				$send_userid= $row['user_id'];
				if(empty($row['user_id'])){
					trigger_error($user->lang['NOT_USER_ACCOUNT']);
				}
				$db->sql_freeresult($result);

				virement($send_money,VIREMENT,$coin_type);
				
				$url = "bank.$phpEx$SID";
				meta_refresh(3, $url);
				unset($message,$bankmoney);
			}else{
				trigger_error($user->lang['NOT_RIGHT_MEMBER']);
			}
		}
	$db->sql_freeresult($result);
	break;

	case 'exchange':
		$exchange_money	= request_var('exchange_money', 0);
		$from_type	    = request_var('from_type', 0);
		$to_type		= request_var('to_type', 0);

		if($exchange_money==0){
			trigger_error($user->lang['NOT_RIGHT_NUMBER']);
		}
		
		if($from_type < 1){
			trigger_error($user->lang['NOT_FROM_COIN']);
		}
		if($to_type < 1){
			trigger_error($user->lang['NOT_TO_COIN']);
		}
		if($from_type==$to_type){
			trigger_error($user->lang['NOT_SAME_COIN']);
		}
		switch($from_type){
			case 1:
				$table_col = 'u_copper_coin';
				$coin = $user->lang['COPPER_COIN'];
				break;
			case 2:
				$table_col = 'u_silver_coin';
				$coin = $user->lang['SILVER_COIN'];
				break;
			case 3:
				$table_col = 'u_gold_coin';
				$coin = $user->lang['GOLD_COIN'];
				break;
		}
		if ($exchange_money> $user->data[$table_col]){
				trigger_error($user->lang['NOT_ENOUGH_MONEY_EX']);
		}
		switch($to_type){
			case 1:
				$table2_col = 'u_copper_coin';
				$coin2 = $user->lang['COPPER_COIN'];
				break;
			case 2:
				$table2_col = 'u_silver_coin';
				$coin2 = $user->lang['SILVER_COIN'];
				break;
			case 3:
				$table2_col = 'u_gold_coin';
				$coin2 = $user->lang['GOLD_COIN'];
				break;
		}


		
		if($from_type>$to_type){
			
			$db->sql_transaction('begin');
					$num = $exchange_money*pow(10,($from_type-$to_type));
					$sql='UPDATE ' . USER_INFO . ' SET ' . $table_col . '=' . $table_col . '-'. $exchange_money . '
						WHERE user_id=' . $user->data['user_id'];
					$db->sql_query($sql);
					$sql='UPDATE ' . USER_INFO . ' SET ' . $table2_col . '=' . $table2_col . '+'. $num . '
						WHERE user_id=' . $user->data['user_id'];
					$db->sql_query($sql);
				$db->sql_transaction('commit');
				$message = sprintf($user->lang['SUCCEED_EXCHANGE'], $exchange_money).$coin.sprintf($user->lang['EXCHANGE_MONEY'],$num).$coin2;		
		}else{
			$db->sql_transaction('begin');
					$num =Floor($exchange_money/ pow(10,($to_type-$from_type)));
					$sql='UPDATE ' . USER_INFO . ' SET ' . $table_col . '=' . $table_col . '-'. $num*pow(10,($to_type-$from_type)). '
						WHERE user_id=' . $user->data['user_id'];
					$db->sql_query($sql);

					$sql='UPDATE ' . USER_INFO . ' SET ' . $table2_col . '=' . $table2_col . '+'. $num . '
						WHERE user_id=' . $user->data['user_id'];
					$db->sql_query($sql);

				$db->sql_transaction('commit');	
			 $message = sprintf($user->lang['SUCCEED_EXCHANGE'],$num*pow(10,($to_type-$from_type))).$coin.sprintf($user->lang['EXCHANGE_MONEY'],$num).$coin2;
			
		}
		$url = "bank.$phpEx$SID";
		meta_refresh(3, $url);
		trigger_error($message);
		unset($num,$table2_col,$table_col,$coin,$coin2);
		$db->sql_freeresult($result);
	break;
	case 'clear':
		$sql='DELETE FROM ' . BANK_LOG . ' WHERE user_id=' . $user->data['user_id'];
		$db->sql_query($sql);
		break;
}

switch (COIN_BASE){
	case 1:
		$user->lang['ACCOUNT_COIN'] = sprintf($user->lang['ACCOUNT_COIN'],$user->lang['COPPER_COIN']);
	break;
	case 2:
		$user->lang['ACCOUNT_COIN'] = sprintf($user->lang['ACCOUNT_COIN'],$user->lang['SILVER_COIN']);
	break;
	case 3:
		$user->lang['ACCOUNT_COIN'] = sprintf($user->lang['ACCOUNT_COIN'],$user->lang['GOLD_COIN']);
	break;
}
$template->assign_vars(array(
	'U_COPPER_COIN'		    => $user->data['u_copper_coin'],
	'U_SILVER_COIN'		    => $user->data['u_silver_coin'],
	'U_GOLD_COIN'           => $user->data['u_gold_coin'],
	'S_SAVE_ACTION'			=> "bank.$phpEx$SID",
	'INTEREST_RATE'         => (INTEREST_RATE*100).'%/'.DAY_BASE.$user->lang['DAY'].' '.$user->lang['ACCOUNT_COIN'],
	'CLEAR_LOG'             => '[<a href="'."bank.$phpEx$SID&amp;do=clear".'">'.$user->lang['CLEAR_LOG'].'</a>]'
	)
);




// Output the basic page
page_header($user->lang['BANK']);

$template->set_filenames(array(
	'body' => 'bank_body.html')
);
make_jumpbox('viewforum.'.$phpEx);

page_footer();


function virement($money,$cash,$cointype)
{
	global $db, $user,$table_col,$send_userid,$send_user,$coin,$current_time,$phpEx,$SID;
	$g_coin = 0;
	$s_coin = 0;
	$c_coin = 0;
	$virement = 0;
	switch ($cointype){
		case 1:
			$virement = floor($money*VIREMENT);
			$c_coin = $money-$virement;
		break;
			
		case 2:
			$virement = floor($money*10*VIREMENT);
			$s_coin =  floor(($money*10-$virement)/10);
			$c_coin =  $money%10;
		break;
		case 3:
			$virement = floor($money*100*VIREMENT);
			$g_coin =   floor(($money*100-$virement)/100);
			$s_coin =   floor(($money*100-$virement)/10)-$g_coin*10;
			$c_coin =  ($money*100-$virement)%10;
		break;

	}
	
	$db->sql_transaction('begin');
		$sql='UPDATE ' . BANK_TABLE . ' SET ' . $table_col . '=' . $table_col . '-'. $money . ' 
			WHERE user_id=' . $user->data['user_id'];
		$db->sql_query($sql);
		$sql='UPDATE ' . BANK_TABLE . ' SET u_copper_coin=u_copper_coin+'. $c_coin . ',
			u_silver_coin=u_silver_coin+' . $s_coin . ', u_gold_coin = u_gold_coin+' . $g_coin . '
			WHERE user_id=' . $send_userid;
		$db->sql_query($sql);
	$message = sprintf($user->lang['LOG_TO_USER_MONEY'],$money).$coin.sprintf($user->lang['TO_USER_INFO'],$send_userid).$send_user.'</a>,'.sprintf($user->lang['BANK_COST'],$virement);
	$sql_ary = array(
		'user_id'		=> $user->data['user_id'],
		'title'         => $message,
		'typeid'		=> 2,
		'logdate'		=> $current_time
	);
	$sql = 'INSERT INTO ' . BANK_LOG . ' ' . $db->sql_build_array('INSERT', $sql_ary);
	$db->sql_query($sql);
	$sql_ary = array(
		'user_id'		=> $send_userid,
		'title'         => sprintf($user->lang['FROM_USER_INFO'],$user->data['user_id']),
		'typeid'		=> 2,
		'logdate'		=> $current_time
	);	
	$db->sql_transaction('commit');
	$url = "bank.$phpEx$SID";
	meta_refresh(3, $url);
	$message = 
	trigger_error($message);
}
?>