<?php


define('IN_PHPBB', true);
$phpbb_root_path = '../../../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

include($phpbb_root_path . 'includes/function_event.php');	
// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('shop_info');
$user->setup('city_info');
require_once ('../xajax.inc.php');
$xajax = new xajax();
//$xajax->debugOn();
$xajax->registerFunction('license');

function license($recordid,$cityid)
{
	return event_buy_license($recordid);
}


$xajax->processRequests();

?>
