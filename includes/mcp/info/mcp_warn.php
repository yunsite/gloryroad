<?php
/** 
*
* @package mcp
* @version $Id: mcp_warn.php,v 1.5 2006/06/10 11:51:10 grahamje Exp $
* @copyright (c) 2005 phpBB Group 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* @package module_install
*/
class mcp_warn_info
{
	function module()
	{
		return array(
			'filename'	=> 'mcp_warn',
			'title'		=> 'MCP_WARN',
			'version'	=> '1.0.0',
			'modes'		=> array(
				'front'				=> array('title' => 'MCP_WARN_FRONT', 'auth' => 'aclf_m_warn', 'cat' => array('MCP_WARN')),
				'list'				=> array('title' => 'MCP_WARN_LIST', 'auth' => 'aclf_m_warn', 'cat' => array('MCP_WARN')),
				'warn_user'			=> array('title' => 'MCP_WARN_USER', 'auth' => 'aclf_m_warn', 'cat' => array('MCP_WARN')),
				'warn_post'			=> array('title' => 'MCP_WARN_POST', 'auth' => 'acl_m_warn,$id || (!$id && aclf_m_warn)', 'cat' => array('MCP_WARN')),
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