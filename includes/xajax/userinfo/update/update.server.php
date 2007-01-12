<?php
// multiply.php, multiply.common.php, multiply.server.php
// demonstrate a very basic xajax implementation
// using xajax version 0.2
// http://xajaxproject.org



require($phpbb_root_path . 'includes/xajax/userinfo/update/update.common.php');
include($phpbb_root_path . 'includes/functions_event.php');	
function update($x)
{
	
	switch($x){
		case 'exp':
			return event_update('exp');
		break;
		case 'con':
			return event_multiply('con');
		break;
		case 'str':
			return event_multiply('str');
		break;
		case 'dex':
			return event_multiply('dex');
		break;
		case 'int':
			return event_multiply('int');
		break;
		case 'wis':
			return event_multiply('wis');
		break;
		case 'cha':
			return event_multiply('cha');
		break;
	}
	 

	
}
$xajax->processRequests();
?>