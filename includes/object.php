<?php
/** 
*
* @package phpBB3
* @version $Id: session.php,v 1.191 2006/03/25 12:35:23 acydburn Exp $ 
* @copyright (c) 2005 phpBB Group 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* @package phpBB3
* Object class
*/
class object_rpg
{
	var $object_id = '';
	var $object_name = '';
	var $object_desc = '';
	var $object_weight = 0;
	var $object_level  = 0;  //物品等级
	var $object_cost   = 0;
	var $effect = array();
	var $occupation_limit = 0;
	var $use_limit = 0;
	var $system_type = 0;
	var $author = array();

}