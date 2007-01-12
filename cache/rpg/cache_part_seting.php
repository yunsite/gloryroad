<?
$_UCACHE['phyle'] = array(1=>'人类',2=>'精灵',3=>'黑暗精灵',4=>'半兽人',5=>'矮人');
//不同的职业的不同初始生命点
$_VBBCACHE['basejobvalue'] =  array(
	'hp' => 
	  array (10,8,4),
	'attack' => 
	  array (1,0,0),
	'skillpoint' => 
	  array (2,2,2)
);

//不同种族的生命修正值
$_UCACHE['changeHp'] = array(0,-2,0,0,2);

$_UCACHE['ex_attribute'] = array(
	1=>
		array (
			'con_ex'			=> 0,
			'int_ex'		    => 0,
			'str_ex'			=> 0,
			'dex_ex'		    => 0,
			'wis_ex'		    => 0,
			'cha_ex'			=> 0
			
		),
	2=>
		array (
			'con_ex'			=> -2,
			'int_ex'		    => 0,
			'str_ex'			=> 0,
			'dex_ex'		    => 2,
			'wis_ex'		    => 0,
			'cha_ex'			=> 0
			
		),
	3=>
		array (
			'con_ex'			=> 0,
			'int_ex'		    => 0,
			'str_ex'			=> -2,
			'dex_ex'		    => 2,
			'wis_ex'		    => 0,
			'cha_ex'			=> 0
			
		),
	4=>
		array (
			'con_ex'			=> 0,
			'int_ex'		    => -2,
			'str_ex'			=> 2,
			'dex_ex'		    => 0,
			'wis_ex'		    => 0,
			'cha_ex'			=> -2
			
		),
	5=>
		array (
			'con_ex'			=> 2,
			'int_ex'		    => 0,
			'str_ex'			=> 0,
			'dex_ex'		    => 0,
			'wis_ex'		    => 0,
			'cha_ex'			=> -2
			
		),

);

//表 vb3_system_strength 不同的力量点数的负重值
$_UCACHE['basestrength'] =  array(10,20,30,40,50,60,70,80,90,100,115,130,150,175,200,230,260,300,350,400,460,520,600,700,800,920,1040,1200,1400);
$_UCACHE['job'] = array(
	1 => 
	  array (
		'fid' => '1',
		'type' => '1',
		'name' => '初级冒险者',
		'upgradelv' => '0',
		'lv' => '1',
	  ),
	 2 => 
	  array (
		'fid' => '2',
		'type' => '2',
		'name' => '初级修行者',
		'upgradelv' => '0',
		'lv' => '1',
	  ),
	  3 => 
	  array (
		'fid' => '3',
		'type' => '3',
		'name' => '初级修炼者',
		'upgradelv' => '0',
		'lv' => '1',
	  ),
	  4 => 
	  array (
		'fid' => '4',
		'type' => '1',
		'name' => '战士',
		'upgradelv' => '5',
		'lv' => '2',
	  ),
	  5 => 
	  array (
		'fid' => '5',
		'type' => '2',
		'name' => '牧师',
		'upgradelv' => '5',
		'lv' => '2',
	  ),
	  6 => 
	  array (
		'fid' => '6',
		'type' => '3',
		'name' => '魔法师',
		'upgradelv' => '5',
		'lv' => '2',
	  )
);
?>