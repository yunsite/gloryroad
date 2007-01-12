<?php

$user->setup('city_info');


$city_info =array();
		$sql = 'SELECT * FROM ' .CITY_INFO.' WHERE city_id ='.$cityid;
        if ( !($result = $db->sql_query($sql)) )
		{
			trigger_error('ERROR_CITYID');
			return;
		}
		if ($row = $db->sql_fetchrow($result))
		{
			
			$city_info = $row;
		}
		$db->sql_freeresult($result);


$template->assign_vars(array(
	'U_MCP'				=> ($auth->acl_get('m_')) ? "{$phpbb_root_path}mcp.$phpEx$SID&amp;i=main&amp;mode=front" : '',
	'CITYNAME'          => $city_info['city_name'],
	'CITYID'          => $city_info['city_id'],
	'CITYSTYLE'       =>$city_info['city_style'],
	'U_CITYOUT'		=> "{$phpbb_root_path}city.$phpEx$SID&amp;cityid=$cityid",
	'U_CITYHALL'		=> "{$phpbb_root_path}city.$phpEx$SID&amp;i=hall&amp;cityid=$cityid",
	'U_CITYMAIN'		=> "{$phpbb_root_path}city.$phpEx$SID&amp;i=main&amp;cityid=$cityid",
	'U_CITYBANK'		=> "{$phpbb_root_path}bank.$phpEx$SID&amp;i=main&amp;cityid=$cityid",
	'U_CITYBIZ'		=> "{$phpbb_root_path}city.$phpEx$SID&amp;i=biz&amp;cityid=$cityid",
	'U_CITYTOWN'		=> "{$phpbb_root_path}city.$phpEx$SID&amp;i=town&amp;cityid=$cityid",
	'U_BIZ'         => $city_info['sowntown'],
	'U_RESIDENTIALAERA'        => $city_info['residentialarea'],
	)

);

?>