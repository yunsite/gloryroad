<?php
/** 
*
* acp_language [中文] :: CRLin - http://web.dhjh.tcc.edu.tw/~gzqbyr/styles/
*
* @package language
* @version $Id: language.php,v 1.4 2006/02/19 15:13:25 davidmj Exp $
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
	'ACP_FILES'						=> '管理语系档',
	'ACP_LANGUAGE_PACKS_EXPLAIN'	=> '这里您可以 安装/删除 语系包',

	'EMAIL_FILES'			=> 'Email 模板',

	'FILE_CONTENTS'				=> 'File Contents',
	'FILE_FROM_STORAGE'			=> 'File from storage folder',

	'HELP_FILES'				=> '帮助档',

	'INSTALLED_LANGUAGE_PACKS'	=> '已安装的语系包',
	'INVALID_LANGUAGE_PACK'		=> '选择的语系似乎是无效的. 请校对语系包, 如果有需要请再重新上传.',
	'INVALID_UPLOAD_METHOD'		=> '选择的上传方法无效, 请选择其它方法.',

	'LANGUAGE_DETAILS_UPDATED'			=> '语系资料已成功更新',
	'LANGUAGE_ENTRIES'					=> '语系项目',
	'LANGUAGE_ENTRIES_EXPLAIN'			=> '这里您可以修改已经存在的语系包项目或者尚未转译的部分.<br /><b>注意:</b> 一旦改变语系档, 改变的档案将储存在一个资料夹内以利下载. 改变并不会马上生效直到您替换网站空间里原来的语系档(以上传来替换语系档).',
	'LANGUAGE_FILES'					=> '语系档',
	'LANGUAGE_KEY'						=> '语系键值',
	'LANGUAGE_PACK_ALREADY_INSTALLED'	=> '这个语系包已安装This language pack is already installed.',
	'LANGUAGE_PACK_DELETED'				=> '语系包 <b>%s</b> 已经成功移除. 所有使用此语系包的用户将自动设定为系统预设语系.',
	'LANGUAGE_PACK_DETAILS'				=> '语系包详细资料',
	'LANGUAGE_PACK_INSTALLED'			=> '语系包 <b>%s</b> 已经成功安装.',
	'LANGUAGE_PACK_ISO'					=> 'ISO',
	'LANGUAGE_PACK_LOCALNAME'			=> '当地名称',
	'LANGUAGE_PACK_NAME'				=> '名称',
	'LANGUAGE_PACK_NOT_EXIST'			=> '选择的语系包不存在.',
	'LANGUAGE_PACK_USED_BY'				=> '使用人数',
	'LANGUAGE_VARIABLE'					=> '语系变量',
	'LANG_AUTHOR'						=> '语系包发表人',
	'LANG_ENGLISH_NAME'					=> '英文名称',
	'LANG_ISO_CODE'						=> 'ISO 代码',
	'LANG_LOCAL_NAME'					=> '当地名称',

	'MISSING_LANGUAGE_FILE'		=> '残缺的语系档: <span style="color:red">%s</span>',
	'MISSING_LANG_VARIABLES'	=> '错误的语系变量',
	'MODS_FILES'				=> 'Mods 语系档',

	'NO_LANG_ID'					=> '您没有指定一个语系包',
	'NO_REMOVE_DEFAULT_LANG'		=> '您不能删除预设语系包.<br />如果您想删除此语系包, 您首先得改变系统预设语系.',
	'NO_UNINSTALLED_LANGUAGE_PACKS'	=> '没有未安装的语系包',

	'REMOVE_FROM_STORAGE_FOLDER'		=> '从储存资料夹内删除',

	'SELECT_DOWNLOAD_FORMAT'	=> '选择下载格式',
	'SUBMIT_AND_DOWNLOAD'		=> '提交并下载档案',
	'SUBMIT_AND_UPLOAD'		=> '提交并上传档案',

	'THOSE_MISSING_LANG_FILES'			=> '在 %s 语系资料夹内缺少下列语系档',
	'THOSE_MISSING_LANG_VARIABLES'		=> '下面的语系变量错误来自 <b>%s</b> 语系包',

	'UNINSTALLED_LANGUAGE_PACKS'	=> '未安装的语系包',

	'UPLOAD_COMPLETED'			=> '已完成上传',
	'UPLOAD_METHOD'				=> '上传方法',
	'UPLOAD_SETTINGS'			=> '上传设定',

	'WRONG_LANGUAGE_FILE'		=> '选择的语系档无效',
));

?>