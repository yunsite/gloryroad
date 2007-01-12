<?php


define('IN_PHPBB', true);
$phpbb_root_path = './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

include($phpbb_root_path . 'includes/function_event.php');	
// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('user_info');
require('xajax.common.php');




function update($x)
{
	
	switch($x){
		case 'exp':
			return event_update('exp');
		break;
		case 'con':
			return event_update('con');
		break;
		case 'str':
			return event_update('str');
		break;
		case 'dex':
			return event_update('dex');
		break;
		case 'int':
			return event_update('int');
		break;
		case 'wis':
			return event_update('wis');
		break;
		case 'cha':
			return event_update('cha');
		break;
	}
	 

	
}
function shopaction($action,$goodsnum,$goodsid,$shopid)
{
	global $phpEx, $phpbb_root_path;
	

	switch($action){
		case 'buy':
			return event_buy($goodsnum,$goodsid,$shopid,$objectname);
		break;
		case 'sale':
			return event_sale($goodsnum,$goodsid,$shopid,$objectname);
		break;
	}
	 

	
}

function baseaction($action)
{
	global $phpEx, $phpbb_root_path;
	switch($action){
		case '1':
			
		break;
		case '2':
			return event_baseaciton($action);
		break;
	}
	 

	
}
$xajax->processRequests();

?>
