<?php
// multiply.php, multiply.common.php, multiply.server.php
// demonstrate a very basic xajax implementation with separate server and
// client files
// using xajax version 0.1 beta4
// http://xajax.sourceforge.net

require($phpbb_root_path . 'includes/xajax/xajax.inc.php');
$xajax = new xajax('xajax.server.php');

//$xajax->debugOn();
$xajax->registerFunction('shopaction');
$xajax->registerFunction('update');
$xajax->registerFunction('baseaction');

?>
