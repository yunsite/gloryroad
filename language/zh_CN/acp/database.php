<?php
/** 
*
* acp_database [中文] :: CRLin - http://web.dhjh.tcc.edu.tw/~gzqbyr/styles/
*
* @package language
* @version $Id: database.php,v 1.8 2006/06/17 06:50:58 davidmj Exp $
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

// Banning
$lang = array_merge($lang, array(
	'DATABASE' => '资料库工具',
	'ACP_BACKUP_EXPLAIN'	=> '在这里您可以备份 phpBB 的相关资料. 您可以储存产生的档案于您的 store/ 资料夹或者直接下载. 依您的伺服器配置您可以选择压缩档案的格式. 如果您有其它自定义的表格而且也想一并备份这些额外表格, 请在下方的 附加的表格 栏内输入他们的资料表名并用逗号区别开. ',
	'BACKUP_OPTIONS'	=> '备份选项',
	'BACKUP_TYPE'		=> '备份类型',
	'BACKUP_INVALID'	=> '选择的备份档案无效',
	'START_BACKUP'		=> '开始备份',
	'FULL_BACKUP'		=> '全部',
	'STRUCTURE_ONLY'	=> '只有结构',
	'DATA_ONLY'			=> '只有资料',
	'TABLE_SELECT'		=> '选择资料表',
	'FILE_TYPE'			=> '档案类型',
	'STORE_LOCAL'		=> '储存至 store/ 资料夹',
	'SELECT_ALL'		=> '选择全部',
	'DESELECT_ALL'		=> '全部取消选择',
	'BACKUP_SUCCESS'	=> '备份档案建立成功',
	'BACKUP_DELETE'		=> '备份档案成功删除',

	'STORE_AND_DOWNLOAD'	=> '储存并下载',
	'ACP_RESTORE_EXPLAIN'	=> '这里将还原保存档案里的所有 phpBB 资料表. 您可以 <u>选择</u> 经由表单或者手动上传档案至伺服器上指定的位置. 如果您的伺服器支援 gzip 或 bzip2 压缩的文字档, 系统将会自行解压您所上传的压缩档. <b>警告</b> 还原动作将会完全覆盖所有现存的资料. 系统还原动作可能会花费一段时间去完成, 直到系统完成前请不要离开这个页面.',
	'SELECT_FILE'			=> '选择档案',
	'RESTORE_OPTIONS'		=> '还原选项',
	'START_RESTORE'			=> '开始还原',
	'DELETE_BACKUP'			=> '删除备份',
	'DOWNLOAD_BACKUP'		=> '下载备份',
	'RESTORE_SUCCESS'		=> '资料库成功还原.<br /><br />系统已被还原至备份时的状态.',
));

?>