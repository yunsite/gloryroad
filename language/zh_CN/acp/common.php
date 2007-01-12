<?php
/** 
*
* acp common [中文] :: CRLin - http://web.dhjh.tcc.edu.tw/~gzqbyr/styles/
*
* @package language
* @version $Id: common.php,v 1.50 2006/06/16 23:20:32 acydburn Exp $
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

// Common
$lang = array_merge($lang, array(
	'ACP_ADMINISTRATORS'		=> '系统管理员',
	'ACP_ADMIN_LOGS'			=> '日志管理',
	'ACP_ADMIN_ROLES'			=> '角色管理',
	'ACP_ATTACHMENTS'			=> '附加档案',
	'ACP_ATTACHMENT_SETTINGS'	=> '附加档案设定',
	'ACP_AUTH_SETTINGS'			=> '认证设定',
	'ACP_AUTOMATION'			=> '自动操作',
	'ACP_AVATAR_SETTINGS'		=> '头像设定',

	'ACP_BACKUP'				=> '备份',
	'ACP_BAN'					=> '封锁',
	'ACP_BAN_EMAILS'			=> '封锁电子邮件信箱',
	'ACP_BAN_IPS'				=> '封锁 IP',
	'ACP_BAN_USERNAMES'			=> '封锁用户',
	'ACP_BASIC_PERMISSIONS'		=> '基本权限',
	'ACP_BBCODES'				=> 'BBCodes',
	'ACP_BOARD_CONFIGURATION'	=> '系统配置',
	'ACP_BOARD_DEFAULTS'		=> '系统预设',
	'ACP_BOARD_FEATURES'		=> '系统功能',
	'ACP_BOARD_MANAGEMENT'		=> '系统管理',
	'ACP_BOARD_SETTINGS'		=> '系统设定',
	'ACP_BOTS'					=> '网络蜘蛛/机器人',
	
	'ACP_CAT_DATABASE'			=> '资料库',
	'ACP_CAT_DOT_MODS'			=> '.Mods',
	'ACP_CAT_FORUMS'			=> '论坛管理',
	'ACP_CAT_GENERAL'			=> '一般管理',
	'ACP_CAT_MAINTENANCE'		=> '维修',

	'ACP_CAT_GAMEINFO'          => '游戏资料管理',

	'ACP_CAT_PERMISSIONS'		=> '权限管理',
	'ACP_CAT_POSTING'			=> '发表文章设定',
	'ACP_CAT_STYLES'			=> '风格管理',
	'ACP_CAT_SYSTEM'			=> '系统管理',
	'ACP_CAT_USERGROUP'			=> '用户与群组管理',
	'ACP_CAT_USERS'				=> '用户管理',
	'ACP_CLIENT_COMMUNICATION'	=> '客户通讯',
	'ACP_COOKIE_SETTINGS'		=> 'Cookie 设定',
	'ACP_CRITICAL_LOGS'			=> '错误日志',
	'ACP_CUSTOM_PROFILE_FIELDS'	=> '自定义个人资料栏位',
	
	'ACP_DATABASE'				=> '资料库管理',
	'ACP_DISALLOW'				=> '禁用',
	'ACP_DISALLOW_USERNAMES'	=> '禁用帐号',
	
	'ACP_EMAIL_SETTINGS'		=> '电子邮件设定',
	'ACP_EXTENSION_GROUPS'		=> '副档名群组管理',
	
	'ACP_FORUM_BASED_PERMISSIONS'	=> '版面基本权限',
	'ACP_FORUM_LOGS'				=> '论坛日志',
	'ACP_FORUM_MANAGEMENT'			=> '论坛管理',
	'ACP_FORUM_MODERATORS'			=> '版面版主',
	'ACP_FORUM_PERMISSIONS'			=> '版面权限',
	'ACP_FORUM_ROLES'				=> '版面角色',

	'ACP_GENERAL_CONFIGURATION'		=> '一般配置',
	'ACP_GENERAL_TASKS'				=> '一般任务',
	'ACP_GLOBAL_MODERATORS'			=> '超级版主',
	'ACP_GLOBAL_PERMISSIONS'		=> '一般权限',
	'ACP_GROUPS'					=> '群组',
	'ACP_GROUPS_FORUM_PERMISSIONS'	=> '群组版面权限',
	'ACP_GROUPS_MANAGE'				=> '管理群组',
	'ACP_GROUPS_MANAGEMENT'			=> '群组管理',
	'ACP_GROUPS_PERMISSIONS'		=> '管理权限',
	
	'ACP_ICONS'					=> '主题图示',
	'ACP_ICONS_SMILIES'			=> '主题 图示/表情',
	'ACP_IMAGESETS'				=> '图像集',
	'ACP_INDEX'					=> '系统管理首页',
	
	'ACP_JABBER_SETTINGS'		=> 'Jabber 设定',
	
	'ACP_LANGUAGE'				=> '语系管理',
	'ACP_LANGUAGE_PACKS'		=> '语系管理',
	'ACP_LOAD_SETTINGS'			=> '载入设定',
	'ACP_LOGGING'				=> '日志',
	
	'ACP_MAIN'					=> '系统管理首页',
	'ACP_MANAGE_EXTENSIONS'		=> '管理副档名',
	'ACP_MANAGE_FORUMS'			=> '管理版面',
	'ACP_MANAGE_RANKS'			=> '管理等级',
	'ACP_MANAGE_REASONS'		=> '管理 检举/拒绝 理由',
	'ACP_MANAGE_USERS'			=> '管理用户',
	'ACP_MASS_EMAIL'			=> '电子邮件通知',
	'ACP_MESSAGES'				=> '私人讯息',
	'ACP_MESSAGE_SETTINGS'		=> '私人讯息设定',
	'ACP_MODULE_MANAGEMENT'		=> '模块管理',
	'ACP_MOD_LOGS'				=> '版主日志',
	'ACP_MOD_ROLES'				=> '版主角色',
	
	'ACP_ORPHAN_ATTACHMENTS'	=> '孤立的附加档案',
	
	'ACP_PERMISSIONS'			=> '权限',
	'ACP_PERMISSION_MASKS'		=> '权限遮罩',
	'ACP_PERMISSION_ROLES'		=> '角色权限',
	'ACP_PERMISSION_SETTINGS'	=> '权限设定',
	'ACP_PERMISSION_TRACE'		=> '权限追踪',
	'ACP_PHP_INFO'				=> 'PHP 资讯',
	'ACP_POST_SETTINGS'			=> '发表文章设定',
	'ACP_PRUNE_FORUMS'			=> '删除版面',
	'ACP_PRUNE_USERS'			=> '删除用户',
	'ACP_PRUNING'				=> 'Pruning',
	
	'ACP_QUICK_ACCESS'			=> '快速使用',
	
	'ACP_RANKS'					=> '等级',
	'ACP_REASONS'				=> '检举/拒绝 理由',
	'ACP_REGISTER_SETTINGS'		=> '用户注册设定',

	'ACP_RESTORE'				=> '还原',

	'ACP_SEARCH'				=> '搜寻配置',
	'ACP_SEARCH_INDEX'			=> '搜寻索引',
	'ACP_SEARCH_SETTINGS'		=> '搜寻设定',

	'ACP_SECURITY_SETTINGS'		=> '安全设定',
	'ACP_SERVER_CONFIGURATION'	=> '伺服器配置',
	'ACP_SERVER_SETTINGS'		=> '伺服器设定',
	'ACP_SIGNATURE_SETTINGS'	=> '个性签名设定',
	'ACP_SMILIES'				=> '表情符号管理',
	'ACP_SPECIAL_PERMISSIONS'	=> '特殊权限',
	'ACP_STYLE_COMPONENTS'		=> '风格组成',
	'ACP_STYLE_MANAGEMENT'		=> '风格管理',
	'ACP_STYLES'				=> '风格',
	
	'ACP_TEMPLATES'				=> '模板(Template)',
	'ACP_THEMES'				=> '布景主题(Theme)',
	
	'ACP_UPDATE'					=> '更新',
	'ACP_USERS_FORUM_PERMISSIONS'	=> '用户版面权限',
	'ACP_USERS_LOGS'				=> '用户日志',
	'ACP_USERS_PERMISSIONS'			=> '用户权限',
	'ACP_USER_ATTACH'				=> '附加档案',
	'ACP_USER_AVATAR'				=> '头像',
	'ACP_USER_FEEDBACK'				=> 'Feedback',
	'ACP_USER_GROUPS'				=> '群组',
	'ACP_USER_MANAGEMENT'			=> '用户管理',
	'ACP_USER_OVERVIEW'				=> '综览',
	'ACP_USER_PERM'					=> '权限',
	'ACP_USER_PREFS'				=> 'Preferences',
	'ACP_USER_PROFILE'				=> '个人资料',
	'ACP_USER_RANK'					=> '等级',
	'ACP_USER_ROLES'				=> '用户角色',
	'ACP_USER_SECURITY'				=> '用户安全',
	'ACP_USER_SIG'					=> '个性签名',

	'ACP_VC_SETTINGS'					=> '识别确认设定',
	'ACP_VERSION_CHECK'					=> '检查更新',
	'ACP_VIEW_ADMIN_PERMISSIONS'		=> '检视管理权限',
	'ACP_VIEW_FORUM_MOD_PERMISSIONS'	=> '检视版面管理员权限',
	'ACP_VIEW_FORUM_PERMISSIONS'		=> '检视论坛权限',
	'ACP_VIEW_GLOBAL_MOD_PERMISSIONS'	=> '检视超级版主权限',
	'ACP_VIEW_USER_PERMISSIONS'			=> '检视用户权限',
	
	'ACP_WORDS'					=> '文字过滤',

	'ACTION'				=> '动作',
	'ACTIVATE'				=> '启用',
	'ADD'					=> '增加',
	'ADMIN'					=> '管理',
	'ADMIN_INDEX'			=> '系统管理首页',
	'ADMIN_PANEL'			=> '系统管理面板',

	'BACK'					=> '返回',

	'COLOUR_SWATCH'			=> 'Web-safe colour swatch',
	'CONFIG_UPDATED'		=> '配置已成功更新',
	'CONFIRM_OPERATION'		=> '您真的想执行这项操作?',

	'DEACTIVATE'				=> '禁用',
	'DIMENSIONS'				=> '尺寸',
	'DISABLE'					=> '关闭',
	'DOWNLOAD'					=> '下载',
	'DOWNLOAD_AS'				=> '下载为',
	'DOWNLOAD_STORE'			=> '下载或储存档案',
	'DOWNLOAD_STORE_EXPLAIN'	=> '您可以直接下载档案或者保存至您的 store/ 资料夹内.',

	'EDIT'					=> '编辑',
	'ENABLE'				=> '启用',
	'EXPORT_DOWNLOAD'		=> '下载',
	'EXPORT_STORE'			=> '储存',

	'FORUM_INDEX'			=> '论坛首页',

	'GENERAL_OPTIONS'		=> '一般选项',
	'GENERAL_SETTINGS'		=> '一般设定',
	'GLOBAL_MASK'			=> '全区权限遮罩',

	'INSTALL'				=> '安装',
	'IP'					=> '用户 IP',
	'IP_HOSTNAME'			=> 'IP 位址或主机名',

	'LOGGED_IN_AS'			=> '您登入的身分:',
	'LOGIN_ADMIN'			=> '您必须经过认证才能管理系统.',
	'LOGIN_ADMIN_CONFIRM'	=> '您必须重新经过认证才能管理系统.',
	'LOGIN_ADMIN_SUCCESS'	=> '您已成功经过认证现在将转向至系统管理面板',
	'LOOK_UP_FORUM'			=> '选择一个版面',

	'MANAGE'				=> '管理',
	'MOVE_DOWN'				=> '下移',
	'MOVE_UP'				=> '上移',

	'NOTIFY'				=> '通知',
	'NO_ADMIN'				=> '您无权管理本系统.',
	'NO_EMAILS_DEFINED'		=> '没有找到有效的电子邮件位址',
	'NO_IPS_DEFINED'		=> '没有定义 IP 或主机名',

	'OFF'					=> '关闭',
	'ON'					=> '开启',

	'PARSE_BBCODE'			=> '解析 BBCode',
	'PARSE_SMILIES'			=> '解析表情符号',
	'PARSE_URLS'			=> '解析连接',
	'PROCEED_TO_ACP'		=> '点击 %s这里%s 进入系统管理面板',
	'REMIND'				=> '提醒',
	'REORDER'				=> '重新排序',
	'RESYNC'				=> '同步',
	'RETURN_TO'				=> '返回至 ...',

	'SELECT_ANONYMOUS'		=> '选择匿名用户',
	'SELECT_OPTION'			=> '选择选项',

	'UCP'					=> '用户控制面板',
	'USERNAMES_EXPLAIN'		=> '每个用户需要另起一行',
	'USER_CONTROL_PANEL'	=> '用户控制面板',

	'WARNING'				=> '警告',

	'DEBUG_EXTRA_WARNING'	=> 'DEBUG_EXTRA 常数已经定义那只是方便开发者作研发.<br />系统运行时将显示附加的 SQL 报告, 这是察看系统运行缓慢的重要方法. 另外, sql 错误总以完整的返回来显示给所有用户而不是单一地显示给管理员, 这是预设内定.<br /><br />这样说吧, 您当前运行的安装为 <b>Debug 模式</b> 如果想取消这个运行模式, 请从 config.php 档去除这个常数.',
));

// PHP info
$lang = array_merge($lang, array(
	'ACP_PHP_INFO_EXPLAIN'	=> '这个页面列出伺服器上安装的 PHP 版本及相关讯息. 它包含了详细的载入模块(loaded modules), 可用变数和预设内定. 这讯息对于分析问题非常有用. 不过您必须明白很多主机服务商出于安全原因可能限制了列出这讯息. 如果此页面没有列出任何详细讯息请询问您的主机提供商或检查您的 PHP 配置文件.',
));

// Logs
$lang = array_merge($lang, array(
	'ACP_ADMIN_LOGS_EXPLAIN'	=> '这里列出系统管理员执行过的动作. 您能按照用户名, 日期, IP 或动作排序. 如果您有受权您也可以清除个别或所有的日志.',
	'ACP_CRITICAL_LOGS_EXPLAIN'	=> '这里列出系统自身产生的动作. 提供这些日志能够帮您解决一些细节问题, 例如邮件发送失败等等. 您能按照用户名, 日期, IP 或动作排序. 如果您有受权您也可以清除个别或所有的日志.',
	'ACP_MOD_LOGS_EXPLAIN'		=> '这里列出系统版主执行过的动作, 选择一个版面下拉列表. 您能按照用户名, 日期, IP 或动作排序. 如果您有受权您也可以清除个别或所有的日志.',
	'ACP_USERS_LOGS_EXPLAIN'	=> '这里列出用户或者是基于用户而执行的动作.',
	'ALL_ENTRIES'				=> '所有条目',

	'DISPLAY_LOG'	=> '显示多久以前的条目',

	'NO_ENTRIES'	=> '这段时间没有日志条目',

	'SORT_IP'		=> 'IP 位址',
	'SORT_DATE'		=> '日期',
	'SORT_ACTION'	=> '日志动作',
));

// Index page
$lang = array_merge($lang, array(
	'ADMIN_INTRO'				=> '感谢您采用 phpBB 架站. 这个银幕提供本系统各项状态的快速预览. 点击银幕左边的连结取得更多讯息. 每一页都有使用说明.',
	'ADMIN_LOG'					=> '系统管理员登入日志',
	'ADMIN_LOG_INDEX_EXPLAIN'	=> '这里列出系统管理员最后执行的 5 个动作. 要查看所有日志请选择适当的项目单并点击左边的相关选项.',
	'AVATAR_DIR_SIZE'			=> '头像目录大小',

	'BOARD_STARTED'		=> '系统开始运行时间',

	'DATABASE_SIZE'		=> '资料库大小',

	'FILES_PER_DAY'		=> '平均每天附加档案数量',
	'FORUM_STATS'		=> '系统统计',

	'GZIP_COMPRESSION'	=> 'Gzip 压缩',

	'INACTIVE_USERS'			=> '帐号未启用的用户',
	'INACTIVE_USERS_EXPLAIN'	=> '这是已注册但帐号未启用的用户名册. 您可以启用, 删除或提醒 (寄出电子邮件) 这些用户.',

	'NO_INACTIVE_USERS'	=> '无帐号未启用的用户',
	'NOT_AVAILABLE'		=> '不可用',
	'NUMBER_FILES'		=> '附加档案数量',
	'NUMBER_POSTS'		=> '文章数量',
	'NUMBER_TOPICS'		=> '主题数量',
	'NUMBER_USERS'		=> '用户数量',

	'POSTS_PER_DAY'		=> '平均每天文章数',

	'RESET_DATE'			=> '重设日期',
	'RESET_ONLINE'			=> '重设在线',
	'RESYNC_POSTCOUNTS'		=> 'Resync Postcounts',
	'RESYNC_POST_MARKING'	=> '同步主题',
	'RESYNC_STATS'			=> '同步统计',

	'STATISTIC'			=> '统计资料',

	'TOPICS_PER_DAY'	=> '平均每天主题数',

	'UPLOAD_DIR_SIZE'	=> '上传目录大小',
	'USERS_PER_DAY'		=> '平均每天用户数',

	'VALUE'				=> '数值',

	'WELCOME_PHPBB'			=> '欢迎使用 phpBB',
));

// Log
$lang = array_merge($lang, array(
	'LOG_ACL_ADD_USER_GLOBAL_U_'		=> '<b>增加或修改用户权限</b><br />&#187; %s',
	'LOG_ACL_ADD_GROUP_GLOBAL_U_'		=> '<b>增加或修改用户团队权限</b><br />&#187; %s',
	'LOG_ACL_ADD_USER_GLOBAL_M_'		=> '<b>增加或修改超级版主权限</b><br />&#187; %s',
	'LOG_ACL_ADD_GROUP_GLOBAL_M_'		=> '<b>增加或修改超级版主团队权限</b><br />&#187; %s',
	'LOG_ACL_ADD_USER_GLOBAL_A_'		=> '<b>增加或修改用户管理权限</b><br />&#187; %s',
	'LOG_ACL_ADD_GROUP_GLOBAL_A_'		=> '<b>增加或修改管理团队权限</b><br />&#187; %s',

	'LOG_ACL_ADD_ADMIN_GLOBAL_A_'		=> '<b>增加或修改系统管理员</b><br />&#187; %s',
	'LOG_ACL_ADD_MOD_GLOBAL_M_'			=> '<b>增加或修改超级版主</b><br />&#187; %s',

	'LOG_ACL_ADD_USER_LOCAL_F_'			=> '<b>增加或修改用户访问论坛权限</b> 来自 %s<br />&#187; %s',
	'LOG_ACL_ADD_USER_LOCAL_M_'			=> '<b>增加或修改版主访问论坛权限</b> 来自 %s<br />&#187; %s',
	'LOG_ACL_ADD_GROUP_LOCAL_F_'		=> '<b>增加或修改团队访问论坛权限</b> 来自 %s<br />&#187; %s',
	'LOG_ACL_ADD_GROUP_LOCAL_M_'		=> '<b>增加或修改团队访问论坛权限</b> 来自 %s<br />&#187; %s',

	'LOG_ACL_ADD_MOD_LOCAL_M_'			=> '<b>增加或修改版主</b> 来自 %s<br />&#187; %s',
	'LOG_ACL_ADD_FORUM_LOCAL_F_'		=> '<b>增加或修改论坛权限</b> 来自 %s<br />&#187; %s',

	'LOG_ACL_DEL_ADMIN_GLOBAL_A_'		=> '<b>删除系统管理员</b><br />&#187; %s',
	'LOG_ACL_DEL_MOD_GLOBAL_M_'			=> '<b>删除超级版主</b><br />&#187; %s',
	'LOG_ACL_DEL_MOD_LOCAL_M_'			=> '<b>删除版主</b> 来自 %s<br />&#187; %s',
	'LOG_ACL_DEL_FORUM_LOCAL_F_'		=> '<b>删除 用户/团队 论坛权限</b> 来自 %s<br />&#187; %s',

	'LOG_ACL_TRANSFER_PERMISSIONS'		=> '<b>转移权限来自</b><br />&#187; %s',
	'LOG_ACL_RESTORE_PERMISSIONS'		=> '<b>Own permissions restored after using permissions from</b><br />&#187; %s',
	
	'LOG_ADMIN_AUTH_FAIL'		=> '<b>登入系统管理失败</b>',
	'LOG_ADMIN_AUTH_SUCCESS'	=> '<b>成功登入系统管理</b>',

	'LOG_ATTACH_EXT_ADD'		=> '<b>增加或修改附加档案副档名</b><br />&#187; %s',
	'LOG_ATTACH_EXT_DEL'		=> '<b>删除附加档案副档名</b><br />&#187; %s',
	'LOG_ATTACH_EXT_UPDATE'		=> '<b>更新附加档案副档名</b><br />&#187; %s',
	'LOG_ATTACH_EXTGROUP_ADD'	=> '<b>增加副档名群组</b><br />&#187; %s',
	'LOG_ATTACH_EXTGROUP_EDIT'	=> '<b>修改副档名群组</b><br />&#187; %s',
	'LOG_ATTACH_EXTGROUP_DEL'	=> '<b>删除副档名群组</b><br />&#187; %s',
	'LOG_ATTACH_FILEUPLOAD'		=> '<b>孤立的附加档案上传至文章</b><br />&#187; ID %1$d - %2$s',
	'LOG_ATTACH_ORPHAN_DEL'		=> '<b>删除孤立的附加档案</b><br />&#187; %s',

	'LOG_BAN_EXCLUDE_USER'	=> '<b>排除封锁用户</b> 原因 "<i>%s</i>"<br />&#187; %s ',
	'LOG_BAN_EXCLUDE_IP'	=> '<b>排除封锁 IP</b> 原因 "<i>%s</i>"<br />&#187; %s ',
	'LOG_BAN_EXCLUDE_EMAIL' => '<b>排除封锁电子邮件信箱</b> 原因 "<i>%s</i>"<br />&#187; %s ',
	'LOG_BAN_USER'			=> '<b>封锁用户</b> 原因 "<i>%s</i>"<br />&#187; %s ',
	'LOG_BAN_IP'			=> '<b>封锁 IP</b> 原因 "<i>%s</i>"<br />&#187; %s',
	'LOG_BAN_EMAIL'			=> '<b>封锁电子邮件信箱</b> 原因 "<i>%s</i>"<br />&#187; %s',
	'LOG_UNBAN_USER'		=> '<b>解除封锁用户</b><br />&#187; %s',
	'LOG_UNBAN_IP'			=> '<b>解除封锁 IP</b><br />&#187; %s',
	'LOG_UNBAN_EMAIL'		=> '<b>解除封锁电子邮件信箱</b><br />&#187; %s',

	'LOG_BBCODE_ADD'		=> '<b>增加新的 BBCode</b><br />&#187; %s',
	'LOG_BBCODE_EDIT'		=> '<b>修改 BBCode</b><br />&#187; %s',
	'LOG_BBCODE_DELETE'		=> '<b>删除 BBCode</b><br />&#187; %s',

	'LOG_BOT_ADDED'		=> '<b>增加新的 bot</b><br />&#187; %s',
	'LOG_BOT_DELETE'	=> '<b>删除 bot</b><br />&#187; %s',
	'LOG_BOT_UPDATED'	=> '<b>更新已有的 bot</b><br />&#187; %s',

	'LOG_CLEAR_ADMIN'		=> '<b>清除管理日志</b>',
	'LOG_CLEAR_CRITICAL'	=> '<b>清除错误日志</b>',
	'LOG_CLEAR_MOD'			=> '<b>清除版主日志</b>',
	'LOG_CLEAR_USER'		=> '<b>清除用户日志</b><br />&#187; %s',
	'LOG_CLEAR_USERS'		=> '<b>清除用户日志</b>',

	'LOG_CONFIG_ATTACH'			=> '<b>改变附加档案设定</b>',
	'LOG_CONFIG_AUTH'			=> '<b>改变用户认证设定</b>',
	'LOG_CONFIG_AVATAR'			=> '<b>改变头像设定</b>',
	'LOG_CONFIG_COOKIE'			=> '<b>改变 cookie 设定</b>',
	'LOG_CONFIG_EMAIL'			=> '<b>改变电子邮件设定</b>',
	'LOG_CONFIG_FEATURES'		=> '<b>改变系统功能</b>',
	'LOG_CONFIG_LOAD'			=> '<b>改变载入设定</b>',
	'LOG_CONFIG_MESSAGE'		=> '<b>改变私人讯息设定</b>',
	'LOG_CONFIG_POST'			=> '<b>改变发表设定</b>',
	'LOG_CONFIG_REGISTRATION'	=> '<b>改变用户注册设定</b>',
	'LOG_CONFIG_SEARCH'			=> '<b>改变搜寻设定</b>',
	'LOG_CONFIG_SECURITY'		=> '<b>改变安全设定</b>',
	'LOG_CONFIG_SERVER'			=> '<b>改变伺服务设定</b>',
	'LOG_CONFIG_SETTINGS'		=> '<b>改变系统设定</b>',
	'LOG_CONFIG_SIGNATURE'		=> '<b>改变个性签名设定</b>',
	'LOG_CONFIG_VISUAL'			=> '<b>改识别确认设定</b>',

	'LOG_APPROVE_TOPIC'			=> '<b>审核主题</b><br />&#187; %s',
	'LOG_BUMP_TOPIC'			=> '<b>User bumped topic</b><br />&#187; %s',
	'LOG_DELETE_POST'			=> '<b>删除文章</b><br />&#187; %s',
	'LOG_DELETE_TOPIC'			=> '<b>删除主题</b><br />&#187; %s',
	'LOG_FORK'					=> '<b>复制主题</b><br />&#187; 来自 %s',
	'LOG_LOCK'					=> '<b>锁定主题</b><br />&#187; %s',
	'LOG_LOCK_POST'				=> '<b>锁定文章</b><br />&#187; %s',
	'LOG_MERGE'					=> '<b>合并文章</b> 至主题<br />&#187;%s',
	'LOG_MOVE'					=> '<b>移动主题</b><br />&#187; 来自 %s',
	'LOG_TOPIC_DELETED'			=> '<b>删除主题</b><br />&#187; %s',
	'LOG_TOPIC_RESYNC'			=> '<b>同步主题统计</b><br />&#187; %s',
	'LOG_TOPIC_TYPE_CHANGED'	=> '<b>改变主题类型</b><br />&#187; %s',
	'LOG_UNLOCK'				=> '<b>解锁主题</b><br />&#187; %s',
	'LOG_UNLOCK_POST'			=> '<b>解锁文章</b><br />&#187; %s',

	'LOG_DISALLOW_ADD'		=> '<b>增加禁止用户名</b><br />&#187; %s',
	'LOG_DISALLOW_DELETE'	=> '<b>删除禁止用户名</b>',

	'LOG_DB_BACKUP'			=> '<b>资料库备份</b>',
	'LOG_DB_RESTORE'		=> '<b>资料库还原</b>',

	'LOG_DOWNLOAD_EXCLUDE_IP'	=> '<b>由下载名册排除 IP/主机名</b><br />&#187; %s',
	'LOG_DOWNLOAD_IP'			=> '<b>增加 IP/主机名 至 下载名册</b><br />&#187; %s',
	'LOG_DOWNLOAD_REMOVE_IP'	=> '<b>由下载名册删除 IP/主机名</b><br />&#187; %s',

	'LOG_ERROR_JABBER'		=> '<b>Jabber 错误</b><br />&#187; %s',
	'LOG_ERROR_EMAIL'		=> '<b>Email 错误</b><br />&#187; %s',
	
	'LOG_FORUM_ADD'							=> '<b>建立新版面</b><br />&#187; %s',
	'LOG_FORUM_DEL_FORUM'					=> '<b>删除版面</b><br />&#187; %s',
	'LOG_FORUM_DEL_FORUMS'					=> '<b>删除版面及其子版面</b><br />&#187; %s',
	'LOG_FORUM_DEL_MOVE_FORUMS'				=> '<b>删除版面且移动其子版面</b> to %s<br />&#187; %s',
	'LOG_FORUM_DEL_MOVE_POSTS'				=> '<b>删除版面且移动文章 </b> 至 %s<br />&#187; %s',
	'LOG_FORUM_DEL_MOVE_POSTS_FORUMS'		=> '<b>删除版面及其子版面, 移动文章</b> 至 %s<br />&#187; %s',
	'LOG_FORUM_DEL_MOVE_POSTS_MOVE_FORUMS'	=> '<b>删除版面, 移动文章</b> 至 %s <b>且其子版面</b> 至 %s<br />&#187; %s',
	'LOG_FORUM_DEL_POSTS'					=> '<b>删除版面及文章</b><br />&#187; %s',
	'LOG_FORUM_DEL_POSTS_FORUMS'			=> '<b>删除版面, 文章且其子版面</b><br />&#187; %s',
	'LOG_FORUM_DEL_POSTS_MOVE_FORUMS'		=> '<b>删除版面及文章, 移动子版面</b> 至 %s<br />&#187; %s',
	'LOG_FORUM_EDIT'						=> '<b>Edited forum details</b><br />&#187; %s',
	'LOG_FORUM_MOVE_DOWN'					=> '<b>移动版面</b> %s <b>至</b> %s 下面',
	'LOG_FORUM_MOVE_UP'						=> '<b>移动版面</b> %s <b>至</b> %s 上面',
	'LOG_FORUM_SYNC'						=> '<b>重新同步版面</b><br />&#187; %s',

	'LOG_GROUP_CREATED'		=> '<b>建立新的用户群组</b><br />&#187; %s',
	'LOG_GROUP_DEFAULTS'	=> '<b>Group made default for members</b><br />&#187; %s',
	'LOG_GROUP_DELETE'		=> '<b>删除用户群组</b><br />&#187; %s',
	'LOG_GROUP_DEMOTED'		=> '<b>Leaders demoted in usergroup</b> %s<br />&#187; %s',
	'LOG_GROUP_PROMOTED'	=> '<b>Members promoted to leader in usergroup</b> %s<br />&#187; %s',
	'LOG_GROUP_REMOVE'		=> '<b>Members removed from usergroup</b> %s<br />&#187; %s',
	'LOG_GROUP_UPDATED'		=> '<b>Usergroup details updated</b><br />&#187; %s',
	'LOG_MODS_ADDED'		=> '<b>Added new leaders to usergroup</b> %s<br />&#187; %s',
	'LOG_USERS_APPROVED'	=> '<b>Users approved in usergroup</b> %s<br />&#187; %s',
	'LOG_USERS_ADDED'		=> '<b>Added new members to usergroup</b> %s<br />&#187; %s',

	'LOG_IMAGESET_ADD_DB'		=> '<b>Added new imageset to database</b><br />&#187; %s',
	'LOG_IMAGESET_ADD_FS'		=> '<b>Add new imageset on filesystem</b><br />&#187; %s',
	'LOG_IMAGESET_DELETE'		=> '<b>Deleted imageset</b><br />&#187; %s',
	'LOG_IMAGESET_EDIT_DETAILS'	=> '<b>Edited imageset details</b><br />&#187; %s',
	'LOG_IMAGESET_EDIT'			=> '<b>Edited imageset</b><br />&#187; %s',
	'LOG_IMAGESET_EXPORT'		=> '<b>Exported imageset</b><br />&#187; %s',

	'LOG_INDEX_ACTIVATE'	=> '<b>Activated inactive users</b><br />&#187; %s',
	'LOG_INDEX_DELETE'		=> '<b>Deleted inactive users</b><br />&#187; %s',
	'LOG_INDEX_REMIND'		=> '<b>Sent reminder emails to inactive users</b><br />&#187; %s',
	'LOG_INSTALL_INSTALLED'	=> '<b>Installed phpBB %s</b>',

	'LOG_IP_BROWSER_CHECK'	=> '<b>Session IP/Browser check failed</b><br />&#187;User IP "<i>%s</i>" checked against session IP "<i>%s</i>" and user browser string "<i>%s</i>" checked against session browser string "<i>%s</i>".',

	'LOG_JAB_CHANGED'			=> '<b>Jabber account changed</b>',
	'LOG_JAB_PASSCHG'			=> '<b>Jabber password changed</b>',
	'LOG_JAB_REGISTER'			=> '<b>Jabber account registered</b>',
	'LOG_JAB_SETTINGS_CHANGED'	=> '<b>Jabber settings设定 changed</b>',

	'LOG_LANGUAGE_PACK_DELETED'		=> '<b>Deleted language pack</b><br />&#187; %s',
	'LOG_LANGUAGE_PACK_INSTALLED'	=> '<b>Installed language pack</b><br />&#187; %s',
	'LOG_LANGUAGE_PACK_UPDATED'		=> '<b>Updated language pack details</b><br />&#187; %s',
	'LOG_LANGUAGE_FILE_REPLACED'	=> '<b>Replaced language file</b><br />&#187; %s',

	'LOG_MASS_EMAIL'		=> '<b>Sent mass email</b><br />&#187; %s',

	'LOG_MCP_CHANGE_POSTER'	=> '<b>Changed poster in topic "%s"</b><br />&#187; from %s to %s',

	'LOG_MODULE_DISABLE'	=> '<b>Module disabled</b>',
	'LOG_MODULE_ENABLE'		=> '<b>Module enabled</b>',
	'LOG_MODULE_MOVE_DOWN'	=> '<b>Module moved down</b><br />&#187; %s',
	'LOG_MODULE_MOVE_UP'	=> '<b>Module moved up</b><br />&#187; %s',
	'LOG_MODULE_REMOVED'	=> '<b>Module removed</b><br />&#187; %s',
	'LOG_MODULE_ADD'		=> '<b>Module added</b><br />&#187; %s',
	'LOG_MODULE_EDIT'		=> '<b>Module edited</b><br />&#187; %s',

	'LOG_A_ROLE_ADD'		=> '<b>Admin Role added</b><br />&#187; %s',
	'LOG_A_ROLE_EDIT'		=> '<b>Admin Role edited</b><br />&#187; %s',
	'LOG_A_ROLE_REMOVED'	=> '<b>Admin Role removed</b><br />&#187; %s',
	'LOG_F_ROLE_ADD'		=> '<b>Forum Role added</b><br />&#187; %s',
	'LOG_F_ROLE_EDIT'		=> '<b>Forum Role edited</b><br />&#187; %s',
	'LOG_F_ROLE_REMOVED'	=> '<b>Forum Role removed</b><br />&#187; %s',
	'LOG_M_ROLE_ADD'		=> '<b>Moderator Role added</b><br />&#187; %s',
	'LOG_M_ROLE_EDIT'		=> '<b>Moderator Role edited</b><br />&#187; %s',
	'LOG_M_ROLE_REMOVED'	=> '<b>Moderator Role removed</b><br />&#187; %s',
	'LOG_U_ROLE_ADD'		=> '<b>User Role added</b><br />&#187; %s',
	'LOG_U_ROLE_EDIT'		=> '<b>User Role edited</b><br />&#187; %s',
	'LOG_U_ROLE_REMOVED'	=> '<b>User Role removed</b><br />&#187; %s',

	'LOG_PROFILE_FIELD_ACTIVATE'	=> '<b>Profile field activated</b><br />&#187; %s',
	'LOG_PROFILE_FIELD_CREATE'		=> '<b>Profile field added</b><br />&#187; %s',
	'LOG_PROFILE_FIELD_DEACTIVATE'	=> '<b>Profile field deactivated</b><br />&#187; %s',
	'LOG_PROFILE_FIELD_EDIT'		=> '<b>Profile field changed</b><br />&#187; %s',
	'LOG_PROFILE_FIELD_REMOVED'		=> '<b>Profile field removed</b><br />&#187; %s',

	'LOG_PRUNE'					=> '<b>Pruned forums</b><br />&#187; %s',
	'LOG_AUTO_PRUNE'			=> '<b>Auto-pruned forums</b><br />&#187; %s',
	'LOG_PRUNE_USER_DEAC'		=> '<b>Users deactivated</b><br />&#187; %s',
	'LOG_PRUNE_USER_DEL_DEL'	=> '<b>Users pruned and posts deleted</b><br />&#187; %s',
	'LOG_PRUNE_USER_DEL_ANON'	=> '<b>Users pruned and posts retained</b><br />&#187; %s',

	'LOG_REASON_ADDED'		=> '<b>Added report/denial reason</b><br />&#187; %s',
	'LOG_REASON_REMOVED'	=> '<b>Removed report/denial reason</b><br />&#187; %s',
	'LOG_REASON_UPDATED'	=> '<b>Updated report/denial reason</b><br />&#187; %s',

	'LOG_RESET_DATE'			=> '<b>Board start date reset</b>',
	'LOG_RESET_ONLINE'			=> '<b>Most users online reset</b>',
	'LOG_RESYNC_POSTCOUNTS'		=> '<b>User postcounts synced</b>',
	'LOG_RESYNC_POST_MARKING'	=> '<b>Dotted topics synced</b>',
	'LOG_RESYNC_STATS'			=> '<b>Post, topic and user stats reset</b>',

	'LOG_STYLE_ADD'				=> '<b>Added new style</b><br />&#187; %s',
	'LOG_STYLE_DELETE'			=> '<b>Deleted style</b><br />&#187; %s',
	'LOG_STYLE_EDIT_DETAILS'	=> '<b>Edited style</b><br />&#187; %s',
	'LOG_STYLE_EXPORT'			=> '<b>Exported style</b><br />&#187; %s',

	'LOG_TEMPLATE_ADD_DB'			=> '<b>Added new template set to database</b><br />&#187; %s',
	'LOG_TEMPLATE_ADD_FS'			=> '<b>Add new template set on filesystem</b><br />&#187; %s',
	'LOG_TEMPLATE_CACHE_CLEARED'	=> '<b>Deleted cached versions of template files in template set <i>%s</i></b><br />&#187; %s',
	'LOG_TEMPLATE_DELETE'			=> '<b>Deleted template set</b><br />&#187; %s',
	'LOG_TEMPLATE_EDIT'				=> '<b>Edited template set <i>%s</i></b><br />&#187; %s',
	'LOG_TEMPLATE_EDIT_DETAILS'		=> '<b>Edited template details</b><br />&#187; %s',
	'LOG_TEMPLATE_EXPORT'			=> '<b>Exported template set</b><br />&#187; %s',
	'LOG_TEMPLATE_REFRESHED'		=> '<b>Refreshed template set</b><br />&#187; %s',

	'LOG_THEME_ADD_DB'			=> '<b>Added new theme to database</b><br />&#187; %s',
	'LOG_THEME_ADD_FS'			=> '<b>Add new theme on filesystem</b><br />&#187; %s',
	'LOG_THEME_DELETE'			=> '<b>Theme deleted</b><br />&#187; %s',
	'LOG_THEME_EDIT_DETAILS'	=> '<b>Edited theme details</b><br />&#187; %s',
	'LOG_THEME_EDIT'			=> '<b>Edited theme <i>%s</i></b><br />&#187; Modified class <i>%s</i>',
	'LOG_THEME_EDIT_ADD'		=> '<b>Edited theme <i>%s</i></b><br />&#187; Added class <i>%s</i>',
	'LOG_THEME_EXPORT'			=> '<b>Exported theme</b><br />&#187; %s',

	'LOG_USER_ACTIVE'		=> '<b>User activated</b><br />&#187; %s',
	'LOG_USER_BAN_USER'		=> '<b>Banned User via user management</b> for reason "<i>%s</i>"<br />&#187; %s',
	'LOG_USER_BAN_IP'		=> '<b>Banned ip via user management</b> for reason "<i>%s</i>"<br />&#187; %s',
	'LOG_USER_BAN_EMAIL'	=> '<b>Banned email via user management</b> for reason "<i>%s</i>"<br />&#187; %s',
	'LOG_USER_DELETED'		=> '<b>Deleted user</b><br />&#187; %s',
	'LOG_USER_DEL_ATTACH'	=> '<b>Removed all attachments made by the user</b><br />&#187; %s',
	'LOG_USER_DEL_AVATAR'	=> '<b>Removed user avatar</b><br />&#187; %s',
	'LOG_USER_DEL_POSTS'	=> '<b>Removed all posts made by the user</b><br />&#187; %s',
	'LOG_USER_DEL_SIG'		=> '<b>Removed user signature</b><br />&#187; %s',
	'LOG_USER_INACTIVE'		=> '<b>User deactivated</b><br />&#187; %s',
	'LOG_USER_MOVE_POSTS'	=> '<b>Moved user posts</b><br />&#187; posts by "%s" to forum "%s"',
	'LOG_USER_NEW_PASSWORD'	=> '<b>Changed user password</b><br />&#187; %s',
	'LOG_USER_REACTIVATE'	=> '<b>Forced user account re-activation</b><br />&#187; %s',
	'LOG_USER_UPDATE_EMAIL'	=> '<b>User "%s" changed email</b><br />&#187; from "%s" to "%s"',
	'LOG_USER_UPDATE_NAME'	=> '<b>Changed username</b><br />&#187; from "%s" to "%s"',
	'LOG_USER_USER_UPDATE'	=> '<b>Updated user details</b><br />&#187; %s',

	'LOG_USER_ACTIVE_USER'		=> '<b>User account activated</b>',
	'LOG_USER_DEL_AVATAR_USER'	=> '<b>User avatar removed</b>',
	'LOG_USER_DEL_SIG_USER'		=> '<b>User signature removed</b>',
	'LOG_USER_FEEDBACK'			=> '<b>Added user feedback</b><br />&#187; %s',
	'LOG_USER_GENERAL'			=> '%s',
	'LOG_USER_INACTIVE_USER'	=> '<b>User account de-activated</b>',
	'LOG_USER_LOCK'				=> '<b>User locked own topic</b><br />&#187; %s',
	'LOG_USER_MOVE_POSTS_USER'	=> '<b>Moved all posts to forum "%s"</b>',
	'LOG_USER_REACTIVATE_USER'	=> '<b>Forced user account re-activation</b>',
	'LOG_USER_UNLOCK'			=> '<b>User unlocked own topic</b><br />&#187; %s',
	'LOG_USER_WARNING'			=> '<b>Added user warning</b><br />&#187;%s',
	'LOG_USER_WARNING_BODY'		=> '<b>The following warning was issued to this user</b><br />&#187;%s',

	'LOG_USER_GROUP_CHANGE'			=> '<b>User changed default group</b><br />&#187; %s',
	'LOG_USER_GROUP_DEMOTE'			=> '<b>User demoted as leaders from usergroup</b><br />&#187; %s',
	'LOG_USER_GROUP_JOIN'			=> '<b>User joined group</b><br />&#187; %s',
	'LOG_USER_GROUP_JOIN_PENDING'	=> '<b>User joined group and needs to be approved</b><br />&#187; %s',
	'LOG_USER_GROUP_RESIGN'			=> '<b>User resigned membership from group</b><br />&#187; %s',

	'LOG_WORD_ADD'			=> '<b>增加文字过滤</b><br />&#187; %s',
	'LOG_WORD_DELETE'		=> '<b>删除文字过滤</b><br />&#187; %s',
	'LOG_WORD_EDIT'			=> '<b>编辑文字过滤</b><br />&#187; %s',
));

?>