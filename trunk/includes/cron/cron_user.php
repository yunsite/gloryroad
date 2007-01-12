<?php




define('EXP_TABLE', $table_prefix.'exp');


define('CITY_ROAD',$table_prefix.'city_road');
define('OBJECTS_TABLE', $table_prefix.'objects'); 
define('USER_EVENT', $table_prefix.'users_event');

function tidy_rpguser()
{
	global $db,$config;
	
	$sql = 'DELETE   FROM ' . USER_EVENT . ' where eventtype=1 AND (creat_time+useful_life)<='.time();

	$db->sql_query($sql);
	$sql = 'DELETE   FROM ' . BUILD_CONSTRUCT . ' where buildtype=1 AND endtime<='.time();

	$db->sql_query($sql);
	set_config('activity_last_time',time());
	
}
function tidy_useractivity()
{
	global $db,$config,$user;

	$sql = 'UPDATE ' . USER_EXINFO . ' SET  activity=activityall,activity_last_time='.(time()-(time()%$config['activity_time'])).'  WHERE user_id='.$user->data['user_id'];

	$result = $db->sql_query($sql);
	$db->sql_freeresult($result);
	
}




?>