<?php

define('IN_PHPBB', true);

$phpbb_root_path = './../';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);
define('EXP_TABLE', $table_prefix.'exp');

if ( isset($_GET['mode']) || isset($_POST['mode']) )
{
	$mode = ( isset($_GET['mode']) ) ? $_GET['mode'] : $_POST['mode'];
	$mode = htmlspecialchars($mode);
}
define('EXP_BASE', 50);
define('USER_CHANGE_SEED', 29);

switch($mode){
	case 'insert_user':
		for($i=1;$i<=100;$i++){
			$exp= (EXP_BASE*$i)+(USER_CHANGE_SEED*($i-1)+$i*$i*$i);
			$sql = 'INSERT INTO ' . EXP_TABLE . ' (base_Exp,Level) VALUES('.$exp.','.$i.')';

			if($result=$db->sql_query($sql)){
				echo 'Level '. $i . '  user Exp : '.$exp .'<br />';
	
			}

		}

	break;
	case 'update_user_att':
		for($i=1;$i<=100;$i++){
			$exp= (20*$i)+(USER_CHANGE_SEED*($i-1)+($i*$i+20));
			$exp1= (20*$i+20)+(USER_CHANGE_SEED*$i)+(($i+1)*($i+1)+20);
			$sql = 'UPDATE ' . EXP_TABLE . ' SET att_exp='.$exp.',next_attexp='.$exp1.' WHERE Level='.$i;

			if($result=$db->sql_query($sql)){
				echo 'ATT  Level '. $i . '  user Exp : '.$exp .'<br />';
	
			}

		}

	break;

}

?>