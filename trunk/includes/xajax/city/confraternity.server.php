<?php


define('IN_PHPBB', true);
$phpbb_root_path = '../../../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

	
include($phpbb_root_path . 'includes/function_confraternity.php');	
// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('shop_info');
$user->setup('confraternityinfo');
require_once ('../xajax.inc.php');



function study($skilldi,$buildid)
{
	return skill_study($skilldi,$buildid);
}
function objectscount($fid,$confid)
{
	$objResponse = new xajaxResponse();
	$pp =  do_objectscount($fid,$confid);
		//将添入数量
	$objResponse->addAssign("objectnum","disabled",false);
	$objResponse->addAssign("objectnum","value",$pp);
	$objResponse->addAssign("max","value",$pp);

	$objResponse->addAssign("doit","disabled",false);
	return $objResponse->getXML();
}
function objectsstart($fid,$confid,$num)
{
	return do_objectsstart($fid,$confid,$num);
}
$xajax = new xajax();

//$xajax->debugOn();

$xajax->registerFunction('study');
$xajax->registerFunction('objectscount');
$xajax->registerFunction('objectsstart');
$xajax->processRequests();

?>
