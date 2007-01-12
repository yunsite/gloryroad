<?php
/** 
*
* acp_modules [中文] :: CRLin - http://web.dhjh.tcc.edu.tw/~gzqbyr/styles/
*
* @package language
* @version $Id: modules.php,v 1.3 2005/12/19 18:55:51 acydburn Exp $
* @copyright (c) 2005 phpBB Group 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* DO NOT CHANGE
*/
if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE 
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine

$lang = array_merge($lang, array(
	'ACP_MODULE_MANAGEMENT_EXPLAIN'	=> '这里您可以管理所有类别的模块. 请注意, 如果相同的模块置于不同的类别下, 则在树状结构中第一个被找到的类别会被选择.',
	'ADD_MODULE'					=> '增加模块',
	'ADD_MODULE_CONFIRM'			=> '您确定要以选择方式增加选择的模块?',
	'ADD_MODULE_TITLE'				=> '增加模块',

	'CANNOT_REMOVE_MODULE'	=> '不能移除模块, 因为它已经有下级类别. 在执行这个动作前请移除所有的下级类别.',
	'CATEGORY'				=> '类别',
	'CHOOSE_MODE'			=> '选择模块方式',
	'CHOOSE_MODE_EXPLAIN'	=> '选择模块使用的方式.',
	'CHOOSE_MODULE'			=> '选择模块',
	'CHOOSE_MODULE_EXPLAIN'	=> 'Choose the file being called by this module.',
	'CREATE_MODULE'			=> '建立新模块',

	'DEACTIVATED_MODULE'	=> '停用模块',
	'DELETE_MODULE'			=> '删除模块',
	'DELETE_MODULE_CONFIRM'	=> '您确定要删除这个模块?',

	'EDIT_MODULE'			=> '编辑模块',
	'EDIT_MODULE_EXPLAIN'	=> '这里您能够输入模块指定的设定',

	'HIDDEN_MODULE'			=> '隐藏模块',

	'MODULE'					=> '模块',
	'MODULE_ADDED'				=> '成功增加模块',
	'MODULE_DELETED'			=> '成功删除模块',
	'MODULE_DISPLAYED'			=> '显示模块',
	'MODULE_DISPLAYED_EXPLAIN'	=> '如果您不希望显示这个模块, 但又想使用它, 则这里请设定 否.',
	'MODULE_EDITED'				=> '成功编辑模块',
	'MODULE_ENABLED'			=> '启用模块',
	'MODULE_LANGNAME'			=> '模块语系名',
	'MODULE_LANGNAME_EXPLAIN'	=> '输入显示的模块名. 如果模块名来自伺服器语系档则请使用语系常量.',
	'MODULE_TYPE'				=> '模块类型',

	'NO_CATEGORY_TO_MODULE'	=> '不能改变模块类型, 因为它已经有下级类别. 在执行这个动作前请移除所有的下级类别.',
	'NO_MODULE'				=> '找不到模块',
	'NO_MODULE_ID'			=> '没有指定模块 ID',
	'NO_MODULE_LANGNAME'	=> '没有指定模块语系名',
	'NO_PARENT'				=> '没有上级模块',

	'PARENT'				=> '上级模块',
	'PARENT_NO_EXIST'		=> '上级模块不存在',

	'SELECT_MODULE'			=> '选择一个模块',
));

?>