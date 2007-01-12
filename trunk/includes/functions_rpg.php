<?php
/** 
*
* @package phpBB3
* @version $Id: functions_display.php,v 1.81 2006/03/25 12:07:00 acydburn Exp $
* @copyright (c) 2005 phpBB Group 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/


/**
* Display Forums
*/
function display_bag($display_mode = 1)
{
	global $db, $auth, $user, $template;
	global $phpbb_root_path, $phpEx, $SID, $config;
	
	//initialize user bag
	
	for($i=0;$i<36;$i++){
		$template->assign_block_vars('bagsrow', array(
					'BAG_ITEMID' 			=> $i,)
		);

	}
	
	// Get user bag details for  display
	$sql = 'SELECT userbag.*,system_object.*
		FROM ' . USER_BAG . ' AS  userbag  
		LEFT JOIN ' . SYSTEM_OBJECT . ' AS system_object ON (userbag.objectid=system_object.object_id )
		WHERE userbag.user_id = '. $user->data['user_id'];

	$result = $db->sql_query($sql);
	$clientscriptstr='';
	while ($row = $db->sql_fetchrow($result))
	{
		$clientscriptstr .='document.getElementById("bag_'.($row['displayorder']-1).'").innerHTML = "<div id=\"userobj_'.($row['displayorder']-1).'\" class=\"docked\"><img src=\"images\/rpg\/object\/1\/'.$row['objectid'].'.gif\" /></div>";';
	}
	$db->sql_freeresult($result);
	return $clientscriptstr;
}

?>