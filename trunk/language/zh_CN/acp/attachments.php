<?php
/** 
*
* acp_attachments [中文] :: CRLin - http://web.dhjh.tcc.edu.tw/~gzqbyr/styles/
*
* @package language
* @version $Id: attachments.php,v 1.7 2006/05/21 16:54:19 acydburn Exp $
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
	'ACP_ATTACHMENT_SETTINGS_EXPLAIN'	=> '这里您可以设定附加档案模组的主要设定及相关的特殊类别.',
	'ACP_EXTENSION_GROUPS_EXPLAIN'		=> '在这里您可以增加，删除和修改您的副档名群组，您可以停用副档名群组，指定特殊类别给它们，变更下载办法而且您可以定义上传图示当做被显示在附加档案适用于群组的最前头.',
	'ACP_MANAGE_EXTENSIONS_EXPLAIN'		=> '这里您可以管理您允许的副档名. 请参考副档名群组管理面板启用副档名. 我们强烈建议不要允许程式副档名(如: php, php3, php4, phtml, pl, cgi, asp, aspx...)',
	'ACP_ORPHAN_ATTACHMENTS_EXPLAIN'	=> '这里您可以看到尚未发表但已在上传目录里的附加档案. 用户在上传附加档案后通常会发生尚未发表的情况. 您可以删除这些附加档案或附加于已发表的文章. 附加档案至文章须要有效的文章 id, you have to determine this id by yourself, this feature is mainly for those people wanting to upload files with another program and assigning those (mostly large) files to an existing post.',
	'ADD_EXTENSION'						=> '增加副档名',
	'ADD_EXTENSION_GROUP'				=> '增加副档名群组',
	'ADMIN_UPLOAD_ERROR'				=> '附加档案 %s 时发生错误',
	'ALLOWED_FORUMS'					=> '已允许的版面',
	'ALLOWED_FORUMS_EXPLAIN'			=> '于所选版面可以发表指定的副档名',
	'ALLOW_ATTACHMENTS'					=> '允许附加档案',
	'ALLOW_ALL_FORUMS'					=> '允许全部版面',
	'ALLOW_IN_PM'						=> '已允许于私人讯息附加档案',
	'ALLOW_PM_ATTACHMENTS'				=> '允许于私人讯息附加档案',
	'ALLOW_SELECTED_FORUMS'				=> '只有底下所选取的版面',
	'ASSIGNED_EXTENSIONS'				=> '已指定的副档名',
	'ASSIGNED_GROUP'					=> '已指定的群组',
	'ATTACH_EXTENSIONS_URL'				=> '副档名',
	'ATTACH_EXT_GROUPS_URL'				=> '副档名群组',
	'ATTACH_MAX_FILESIZE'				=> '最大档案尺寸',
	'ATTACH_MAX_FILESIZE_EXPLAIN'		=> '每个上传档案最大的尺寸, 0 代表没有限制.',
	'ATTACH_MAX_PM_FILESIZE'			=> '最大档案尺寸通知',
	'ATTACH_MAX_PM_FILESIZE_EXPLAIN'	=> '每位用户可以于私人讯息附加档案的最大磁碟空间, 0 代表没有限制.',
	'ATTACH_ORPHAN_URL'					=> '孤立的附加档案',
	'ATTACH_POST_ID'					=> '文章 ID',
	'ATTACH_QUOTA'						=> '全部附加档案的限额',
	'ATTACH_QUOTA_EXPLAIN'				=> '全部附加档案的最大磁碟空间, 0 代表没有限制.',
	'ATTACH_TO_POST'					=> '附加档案于发表的文章',

	'CAT_IMAGES'				=> '图片',
	'CAT_RM_FILES'				=> 'Real Media Streams',
	'CAT_WM_FILES'				=> 'Win Media Streams',
	'CREATE_GROUP'				=> '建立新群组',
	'CREATE_THUMBNAIL'			=> '建立缩图',
	'CREATE_THUMBNAIL_EXPLAIN'	=> '于所有可能状况建立缩图.',

	'DEFINE_ALLOWED_IPS'			=> '规定允许的 IP/主机',
	'DEFINE_DISALLOWED_IPS'			=> '规定不许的 IP/主机',
	'DOWNLOAD_ADD_IPS_EXPLAIN'		=> '您能够以新起一行来指定多个 IP/主机. 要指定 IP 位址的范围请使用 - 来分隔起始及结束, 或是使用万用字元 *',
	'DOWNLOAD_MODE'					=> '下载模式',
	'DOWNLOAD_MODE_EXPLAIN'			=> 'If you experience problems downloading files, set this to "physical", the user will be directed to the file directly. Do not set it to physical if not really needed, it discloses the filename.',
	'DOWNLOAD_REMOVE_IPS_EXPLAIN'	=> 'You can remove (or un-exclude) multiple IP addresses in one go using the appropriate combination of mouse and keyboard for your computer and browser. Excluded IP\'s have a blue background.',
	'DISPLAY_INLINED'				=> '线上显示图片',
	'DISPLAY_INLINED_EXPLAIN'		=> '如果没有设定图示附加档案将指向一个连结.',
	'DISPLAY_ORDER'					=> '附加档案显示规则',
	'DISPLAY_ORDER_EXPLAIN'			=> '以时间排序.',
	
	'EDIT_EXTENSION_GROUP'			=> '编辑副档名群组',
	'EXCLUDE_ENTERED_IP'			=> 'Enable this to exclude the entered IP/Hostname.',
	'EXCLUDE_FROM_ALLOWED_IP'		=> '由已允许的 IP/主机 排除 IP',
	'EXCLUDE_FROM_DISALLOWED_IP'	=> '由已不许的 IP/主机 排除 IP',
	'EXTENSIONS_UPDATED'			=> '副档名更新成功',
	'EXTENSION_EXIST'				=> '副档名 %s 已存在',
	'EXTENSION_GROUP'				=> '副档名群组',
	'EXTENSION_GROUPS'				=> '副档名群组',
	'EXTENSION_GROUP_DELETED'		=> '副档名群组移除成功',
	'EXTENSION_GROUP_EXIST'			=> '副档名群组 %s 已存在',

	'GO_TO_EXTENSIONS'		=> '前往副档名管理面板',
	'GROUP_NAME'			=> '群组名',

	'IMAGE_LINK_SIZE'			=> '图片连结尺寸',
	'IMAGE_LINK_SIZE_EXPLAIN'	=> 'Display image attachment as link if image is larger than this, set to 0px by 0px to disable.',
	'IMAGICK_PATH'				=> 'Imagemagick 路径',
	'IMAGICK_PATH_EXPLAIN'		=> 'Imagemagick 转换程式完整路径, 例如. /usr/bin/',

	'MAX_ATTACHMENTS'				=> '每一篇文章最多可附加的档案数',
	'MAX_ATTACHMENTS_PM'			=> '每一讯息最多可附加的档案数',
	'MAX_EXTGROUP_FILESIZE'			=> '最大档案尺寸',
	'MAX_IMAGE_SIZE'				=> '最大图片尺寸',
	'MAX_IMAGE_SIZE_EXPLAIN'		=> '附加图片的最大尺寸, 0px X 0px 附加图片.',
	'MIN_THUMB_FILESIZE'			=> '缩图最小的尺寸',
	'MIN_THUMB_FILESIZE_EXPLAIN'	=> '当图片小于这项设定时不建立缩图.',
	'MODE_INLINE'					=> '排成一行',
	'MODE_PHYSICAL'					=> '自然排列',

	'NOT_ALLOWED_IN_PM'			=> '不允许于私人讯息',
	'NOT_ASSIGNED'				=> '没有指定',
	'NO_EXT_GROUP_NAME'			=> '没有输入群组名',
	'NO_EXT_GROUP_SPECIFIED'	=> '没有指定副档名群组',
	'NO_IMAGE'					=> '没有图片',
	'NO_THUMBNAIL_SUPPORT'		=> '缩图功能已停用因为没有 CD 程式库支援且找不至可执行的 Imagemagick.',
	'NO_UPLOAD_DIR'				=> '您指定的上传目录不存在.',
	'NO_WRITE_UPLOAD'			=> '您指定的上传目录不能写入. 请更改目录权限以使网页伺服器能写入.',

	'ORDER_ALLOW_DENY'		=> '允许',
	'ORDER_DENY_ALLOW'		=> '拒绝',

	'REMOVE_ALLOWED_IPS'		=> '移除或不排除已允许的 IP/主机',
	'REMOVE_DISALLOWED_IPS'		=> '移除或不排除已不许的 IP/主机',

	'SEARCH_IMAGICK'				=> '搜寻 Imagemagick',
	'SECURE_ALLOW_DENY'				=> '允许/拒绝 列表',
	'SECURE_ALLOW_DENY_EXPLAIN'		=> '允许或拒绝的位址名册, 这项设定仅限于下载档案',
	'SECURE_DOWNLOADS'				=> '启用安全下载',
	'SECURE_DOWNLOADS_EXPLAIN'		=> '由于设定这个项目, 只有您规定的 IP/主机 才能下载.',
	'SECURE_DOWNLOAD_NOTICE'		=> '安全下载未启用. 在启用安全下载后底下的设定才有作用.',
	'SECURE_DOWNLOAD_UPDATE_SUCCESS'=> 'IP 名册成功更新',
	'SECURE_EMPTY_REFERER'			=> 'Allow empty referer',
	'SECURE_EMPTY_REFERER_EXPLAIN'	=> 'Secure downloads are based on referers. Do you want to allow downloads for those ommitting the referer?',
	'SETTINGS_CAT_IMAGES'			=> '图片类别设定',
	'SPECIAL_CATEGORY'				=> '特殊类别',
	'SPECIAL_CATEGORY_EXPLAIN'		=> 'Special Categories differ between the way presented within posts.',
	'SUCCESSFULLY_UPLOADED'			=> '上传成功',
	'SUCCESS_EXTENSION_GROUP_ADD'	=> '增加副档名群组成功',
	'SUCCESS_EXTENSION_GROUP_EDIT'	=> '更新副档名群组成功',

	'UPLOADING_FILES'				=> '上传档案',
	'UPLOADING_FILE_TO'				=> '上传档案 "%1$s" 至发表 ID %2$d...',
	'UPLOAD_DENIED_FORUM'			=> '您无权于论坛 "%s" 上传档案',
	'UPLOAD_DIR'					=> '上传目录',
	'UPLOAD_DIR_EXPLAIN'			=> '附加档案的储存路径.',
	'UPLOAD_ICON'					=> '上传图示',
	'UPLOAD_NOT_DIR'				=> '您指定的上传位置不是目录.',
));

?>