<?php
/** 
*
* @package ucp
* @version $Id: ucp_attachments.php,v 1.2 2006/05/01 19:45:42 grahamje Exp $
* @copyright (c) 2005 phpBB Group 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* @package module_install
*/
class ucp_attachments_info
{
	function module()
	{
		return array(
			'filename'	=> 'ucp_attachments',
			'title'		=> 'UCP_ATTACHMENTS',
			'version'	=> '1.0.0',
			'modes'		=> array(
				'attachments'	=> array('title' => 'UCP_ATTACHMENTS', 'auth' => 'acl_u_attach', 'cat' => array('UCP_ATTACHMENTS')),
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