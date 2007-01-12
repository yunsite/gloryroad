<?php
// multiply.php, multiply.common.php, multiply.server.php
// demonstrate a very basic xajax implementation
// using xajax version 0.2
// http://xajaxproject.org

require_once($phpbb_root_path .'includes/xajax/xajax.inc.php');

$xajax = new xajax($phpbb_root_path . 'includes/xajax/userinfo/update/update.server.php');
$xajax->registerFunction("update");
?>