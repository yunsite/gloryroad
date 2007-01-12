<?php
	$var = array(
		'obid'=>1,
		'obname'=>'石头',
		'oblv'=>1,
		'obnum'=>5
	);
	echo 'object='.serialize($var).'<br />';

	$skill= array(
		'skid'=>1,
		'skname'=>'巨石加工',
		'sklv'=>1
	);
	echo 'skill='.serialize($skill);
?>