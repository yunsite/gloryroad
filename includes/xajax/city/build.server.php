<?php


define('IN_PHPBB', true);
$phpbb_root_path = '../../../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

include($phpbb_root_path . 'includes/function_event.php');
include($phpbb_root_path . 'includes/function_confraternity.php');	
// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('shop_info');
$user->setup('confraternityinfo');
require_once ('../xajax.inc.php');


function construct($bid,$order,$psid)
{
	return build_construct($bid,$order,$psid);
}

function study($skilldi,$buildid)
{
	return skill_study($skilldi,$buildid);
}
function objectscount($fid)
{
	return do_objectscount($fid);
}
$xajax = new xajax();

//$xajax->debugOn();
$xajax->registerFunction('construct');
$xajax->registerFunction('study');
$xajax->processRequests();

?>
