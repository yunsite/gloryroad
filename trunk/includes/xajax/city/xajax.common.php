<?php
// multiply.php, multiply.common.php, multiply.server.php
// demonstrate a very basic xajax implementation with separate server and
// client files
// using xajax version 0.1 beta4
// http://xajax.sourceforge.net
$phpbb_root_path = './';

$xajax = new xajax($phpbb_root_path . 'includes/xajax/city/build.server.php');

//$xajax->debugOn();
$xajax->registerFunction('construct');


?>
