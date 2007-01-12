<?php
/** 
*
* @package ucp
* @version $Id: ucp_prefs.php,v 1.2 2006/05/01 19:45:42 grahamje Exp $
* @copyright (c) 2005 phpBB Group 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* @package module_install
*/
class ucp_prefs_info
{
	function module()
	{
		return array(
			'filename'	=> 'ucp_prefs',
			'title'		=> 'UCP_PREFS',
			'version'	=> '1.0.0',
			'modes'		=> array(
				'personal'	=> array('title' => 'UCP_PREFS_PERSONAL', 'auth' => '', 'cat' => array('UCP_PREFS')),
				'view'		=> array('title' => 'UCP_PREFS_VIEW', 'auth' => '', 'cat' => array('UCP_PREFS')),
				'post'		=> array('title' => 'UCP_PREFS_POST', 'auth' => '', 'cat' => array('UCP_PREFS')),
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