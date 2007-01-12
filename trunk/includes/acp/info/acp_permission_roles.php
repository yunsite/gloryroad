<?php
/** 
*
* @package acp
* @version $Id: acp_permission_roles.php,v 1.2 2006/05/01 19:45:42 grahamje Exp $
* @copyright (c) 2005 phpBB Group 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* @package module_install
*/
class acp_permission_roles_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_permission_roles',
			'title'		=> 'ACP_PERMISSION_ROLES',
			'version'	=> '1.0.0',
			'modes'		=> array(
				'admin_roles'		=> array('title' => 'ACP_ADMIN_ROLES', 'auth' => 'acl_a_roles', 'cat' => array('ACP_PERMISSION_ROLES')),
				'user_roles'		=> array('title' => 'ACP_USER_ROLES', 'auth' => 'acl_a_roles', 'cat' => array('ACP_PERMISSION_ROLES')),
				'mod_roles'			=> array('title' => 'ACP_MOD_ROLES', 'auth' => 'acl_a_roles', 'cat' => array('ACP_PERMISSION_ROLES')),
				'forum_roles'		=> array('title' => 'ACP_FORUM_ROLES', 'auth' => 'acl_a_roles', 'cat' => array('ACP_PERMISSION_ROLES')),
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