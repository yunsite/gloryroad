<?php
/** 
*
* @package acp
* @version $Id: acp_forums.php,v 1.3 2006/05/31 20:26:48 grahamje Exp $
* @copyright (c) 2005 phpBB Group 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* @package module_install
*/
class acp_forums_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_forums',
			'title'		=> 'ACP_FORUM_MANAGEMENT',
			'version'	=> '1.0.0',
			'modes'		=> array(
				'manage'	=> array('title' => 'ACP_MANAGE_FORUMS', 'auth' => 'acl_a_forum', 'cat' => array('ACP_MANAGE_FORUMS')),
			),
		);
	}

	function install()
	{
	}

	function uninstall()
	{
	}
}

?>