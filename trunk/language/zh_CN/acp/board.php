<?php
/** 
*
* acp_board [中文] :: CRLin - http://web.dhjh.tcc.edu.tw/~gzqbyr/styles/
*
* @package language
* @version $Id: board.php,v 1.29 2006/06/16 16:54:43 acydburn Exp $
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

// Board Settings
$lang = array_merge($lang, array(
	'ACP_BOARD_SETTINGS_EXPLAIN'	=> '这里您可以设定论坛的基本作用, 由论坛名称, 用户注册, 及私人讯息等等.',

	'CUSTOM_DATEFORMAT'				=> '自定义...',
	'DEFAULT_DATE_FORMAT'			=> '时间格式',
	'DEFAULT_DATE_FORMAT_EXPLAIN'	=> '时间格式同 PHP 日期函数.',
	'DEFAULT_LANGUAGE'				=> '预设语系',
	'DEFAULT_STYLE'					=> '预设样式',
	'DISABLE_BOARD'					=> '暂时关闭',
	'DISABLE_BOARD_EXPLAIN'			=> '这个动作将会暂时关闭论坛. 您可以输入一篇短(255字元内)讯息通知用户.',
	'OVERRIDE_STYLE'				=> '推翻用户选择样式',
	'OVERRIDE_STYLE_EXPLAIN'		=> '将用户所选样式改为预设样式.',
	'RELATIVE_DAYS'					=> '相关日数',
	'SITE_DESC'						=> '论坛描述',
	'SITE_NAME'						=> '论坛名称',
	'SYSTEM_DST'					=> '启用日光节约时间',
	'SYSTEM_TIMEZONE'				=> '系统时间',
	'WARNINGS_EXPIRE'				=> '警告期',
	'WARNINGS_EXPIRE_EXPLAIN'		=> '由警告发布后至用户纪录消失前的日数',
));

// Board Features
$lang = array_merge($lang, array(
	'ACP_BOARD_FEATURES_EXPLAIN'	=> '这里您可以 启用/停用 许多论坛功能',

	'ALLOW_ATTACHMENTS'			=> '允许附加档案',
	'ALLOW_BOOKMARKS'			=> '允许书签主题',
	'ALLOW_BOOKMARKS_EXPLAIN'	=> '用户可以储存个人书签',
	'ALLOW_BBCODE'				=> '允许 BBCode 代码',
	'ALLOW_FORUM_NOTIFY'		=> '允许订阅版面',
	'ALLOW_NAME_CHANGE'			=> '允许更改用户名',
	'ALLOW_NO_CENSORS'			=> '允许关闭过滤',
	'ALLOW_NO_CENSORS_EXPLAIN'	=> '用户可以关闭文字过滤.',
	'ALLOW_PM_ATTACHMENTS'		=> '允许私人讯息附加档案',
	'ALLOW_SIG'					=> '允许个性签名',
	'ALLOW_SIG_BBCODE'			=> '允许个性签名使用 BBCode 代码',
	'ALLOW_SIG_FLASH'			=> '允许个性签名使用 FLASH BBCode 标签',
	'ALLOW_SIG_IMG'				=> '允许个性签名使用 IMG BBCode 标签',
	'ALLOW_SIG_SMILIES'			=> '允许个性签名使用表情符号',
	'ALLOW_SMILIES'				=> '允许使用表情符号',
	'ALLOW_TOPIC_NOTIFY'		=> '允许订阅主题',
	'BOARD_PM'					=> '私人讯息',
	'BOARD_PM_EXPLAIN'			=> '启用或停用全部用户使用私人讯息.',
));

// Avatar Settings
$lang = array_merge($lang, array(
	'ACP_AVATAR_SETTINGS_EXPLAIN'	=> '个人头像通常是用户用以联结自己的小而唯一之图片. 依论坛的风格当检视文章时经常显示于用户名之下. 这里您可以设定用户可使用何种方式来规定自己的头像. 请注意为了能上传头像您必须建立底下命名的目录且确保可由网页伺服器写入. 也请注意档案大小的限制仅止于上传个人头像, 并没有应用到外部网址连结的图片.',

	'ALLOW_LOCAL'					=> '使用系统相簿',
	'ALLOW_REMOTE'					=> '允许连结头像',
	'ALLOW_REMOTE_EXPLAIN'			=> '从外部网址连结个人头像',
	'ALLOW_UPLOAD'					=> '允许上传头像',
	'AVATAR_GALLERY_PATH'			=> '系统相簿储存路径',
	'AVATAR_GALLERY_PATH_EXPLAIN'	=> '在您 phpBB 根目录底下的路径, 例如: images/avatars/gallery',
	'AVATAR_STORAGE_PATH'			=> '个人头像储存路径',
	'AVATAR_STORAGE_PATH_EXPLAIN'	=> '在您 phpBB 根目录底下的路径, 例如: images/avatars/upload',
	'MAX_AVATAR_SIZE'				=> '个人头像最大尺寸',
	'MAX_AVATAR_SIZE_EXPLAIN'		=> '(高 x 宽 像素单位) ',
	'MAX_FILESIZE'					=> '头像档案不可超过',
	'MAX_FILESIZE_EXPLAIN'			=> '用户上传个人头像档案',
	'MIN_AVATAR_SIZE'				=> '个人头像最小尺寸',
	'MIN_AVATAR_SIZE_EXPLAIN'		=> '(高 x 宽 像素单位)',
));

// Message Settings
$lang = array_merge($lang, array(
	'ACP_MESSAGE_SETTINGS_EXPLAIN'		=> '这里您可以设定全部私人讯息的内定设定',

	'ALLOW_BBCODE_PM'			=> '允许私人讯息使用 BBCode 代码',
	'ALLOW_DOWNLOAD_PM'			=> '允许于私人讯息下载附加档案',
	'ALLOW_FLASH_PM'			=> '允许私人讯息使用 FLASH BBCode 标签',
	'ALLOW_FORWARD_PM'			=> '允许转发私人讯息',
	'ALLOW_IMG_PM'				=> '允许私人讯息使用 IMG BBCode 标签',
	'ALLOW_MASS_PM'				=> '允许大量的私人讯息',
	'ALLOW_PRINT_PM'			=> '允许私人讯息使用预览列印',
	'ALLOW_QUOTE_PM'			=> '允许私人讯息使用引言',
	'ALLOW_SIG_PM'				=> '允许私人讯息使用个性签名',
	'ALLOW_SMILIES_PM'			=> '允许私人讯息使用表情符号',
	'BOXES_LIMIT'				=> '资料夹最大容量',
	'BOXES_LIMIT_EXPLAIN'		=> '用户于每一私人讯息资料夹最多可以容纳的量 0 代表不受限制.',
	'BOXES_MAX'					=> '资料夹最大数量',
	'BOXES_MAX_EXPLAIN'			=> '用户可以建立数个资料夹以储存私人讯息.',
	'ENABLE_PM_ICONS'			=> '于私人讯息启用主题图示',
	'FULL_FOLDER_ACTION'		=> '资料夹已满的预设动作',
	'FULL_FOLDER_ACTION_EXPLAIN'=> '用户的资料夹已满所执行的预设动作且当用户的资料夹设定动作不能实施时.',
	'HOLD_NEW_MESSAGES'			=> '扣留新讯息',
	'PM_EDIT_TIME'				=> '限制编辑时间',
	'PM_EDIT_TIME_EXPLAIN'		=> '限制编辑未传送的私人讯息时可用的时间, 0 代表不受限',
));

// Post Settings
$lang = array_merge($lang, array(
	'ACP_POST_SETTINGS_EXPLAIN'			=> '这里您可以设定全部发表时的内定设定',

	'BUMP_INTERVAL'					=> 'Bump Interval',
	'BUMP_INTERVAL_EXPLAIN'			=> 'Number of minutes, hours or days between the last post to a topic and the ability to bump this topic.',
	'CHAR_LIMIT'					=> '每篇文章字元数的上限',
	'CHAR_LIMIT_EXPLAIN'			=> '0 代表不受限.',
	'DISPLAY_LAST_EDITED'			=> '显示上次编辑时间',
	'DISPLAY_LAST_EDITED_EXPLAIN'	=> '文章内显示上次编辑时间',
	'EDIT_TIME'						=> '限制编辑时间',
	'EDIT_TIME_EXPLAIN'				=> '限制编辑新文章时可用的时间, 0 代表不受限',
	'FLOOD_INTERVAL'				=> '灌水机制',
	'FLOOD_INTERVAL_EXPLAIN'		=> '文章发表的间隔时间 (秒). 更改用户权限即可不受限.',
	'HOT_THRESHOLD'					=> '热门话题显示数',
	'MAX_POLL_OPTIONS'				=> '票选项目的最高数目',
	'MAX_POST_FONT_SIZE'			=> '每篇文章字型大小的上限',
	'MAX_POST_FONT_SIZE_EXPLAIN'	=> '0 代表不受限.',
	'MAX_POST_IMG_HEIGHT'			=> '每篇文章中千image 最大的高',
	'MAX_POST_IMG_HEIGHT_EXPLAIN'	=> '发表时 image/flash 档案最大的高. 0 代表不受限.',
	'MAX_POST_IMG_WIDTH'			=> '每篇文章中 image 最大的宽',
	'MAX_POST_IMG_WIDTH_EXPLAIN'	=> '发表时 image/flash 档案最大的宽. 0 代表不受限.',
	'MAX_POST_URLS'					=> '每篇文章外部连结数的上限',
	'MAX_POST_URLS_EXPLAIN'			=> '0 代表不受限.',
	'POSTING'						=> '发表文章',
	'POSTS_PER_PAGE'				=> '每页显示发表数',
	'QUOTE_DEPTH_LIMIT'				=> '每篇文章巢状式引言的上限',
	'QUOTE_DEPTH_LIMIT_EXPLAIN'		=> '0 代表不受限.',
	'SMILIES_LIMIT'					=> '每篇文章表情符号的上限',
	'SMILIES_LIMIT_EXPLAIN'			=> '0 代表不受限.',
	'TOPICS_PER_PAGE'				=> '每页显示主题数',
));

// Signature Settings
$lang = array_merge($lang, array(
	'ACP_SIGNATURE_SETTINGS_EXPLAIN'	=> '这里您可以设定全部个性签名的内定设定',

	'MAX_SIG_FONT_SIZE'				=> '个性签名时字型大小的上限',
	'MAX_SIG_FONT_SIZE_EXPLAIN'		=> '用户个性签名时字型大小的上限. 0 代表不受限',
	'MAX_SIG_IMG_HEIGHT'			=> '个性签名时 image 最大的高',
	'MAX_SIG_IMG_HEIGHT_EXPLAIN'	=> '用户个性签名时 image/flash 最大的高. 0 代表不受限.',
	'MAX_SIG_IMG_WIDTH'				=> '个性签名时 image 最大的宽',
	'MAX_SIG_IMG_WIDTH_EXPLAIN'		=> '用户个性签名时 image/flash 最大的宽. 0 代表不受限.',
	'MAX_SIG_LENGTH'				=> '签名档长度',
	'MAX_SIG_LENGTH_EXPLAIN'		=> '用户个性签名可用的最多字元数.',
	'MAX_SIG_SMILIES'				=> '个性签名时表情符号的上限',
	'MAX_SIG_SMILIES_EXPLAIN'		=> '用户个性签名时表情符号的上限. 0 代表不受限.',
	'MAX_SIG_URLS'					=> '个性签名时外部连结数的上限',
	'MAX_SIG_URLS_EXPLAIN'			=> '用户个性签名时外部连结数的上限. 0 代表不受限.',
));

// Registration Settings
$lang = array_merge($lang, array(
	'ACP_REGISTER_SETTINGS_EXPLAIN'		=> '这里您可以设定注册与个人资料的相关设定',

	'ACC_ACTIVATION'			=> '帐号启用',
	'ACC_ACTIVATION_EXPLAIN'	=> '这项设定用户可直接存取论坛资料或须更多的确认. 您也可以关闭注册.',
	'ACC_ADMIN'					=> '系统管理员开启',
	'ACC_DISABLE'				=> '关闭',
	'ACC_NONE'					=> '自动开启',
	'ACC_USER'					=> '用户开启',
//	'ACC_USER_ADMIN'			=> 'User + Admin',
	'ALLOW_EMAIL_REUSE'			=> '允许同一电子邮件信箱重覆注册',
	'ALLOW_EMAIL_REUSE_EXPLAIN'	=> '不同用户可用相同电子邮件信箱注册.',
	'COPPA'						=> 'COPPA (美国儿童网路隐私保护法)',
	'COPPA_FAX'					=> 'COPPA传真号码',
	'COPPA_HIDE_GROUPS'			=> '隐藏 COPPA 群组',
	'COPPA_HIDE_GROUPS_EXPLAIN'	=> 'Do not display the special COPPA groups within admin-facing parts',
	'COPPA_MAIL'				=> 'COPPA 邮递地址',
	'COPPA_MAIL_EXPLAIN'		=> '这是供家长寄送 COPPA 会员注册申请书的邮递地址',
	'ENABLE_COPPA'				=> '启用 COPPA',
	'ENABLE_COPPA_EXPLAIN'		=> '这需要取得 COPPA 承诺声明用户已满 13 岁.',
	'MAX_CHARS'					=> '最多',
	'MIN_CHARS'					=> '最少',
	'PASSWORD_LENGTH'			=> '用户密码长度',
	'PASSWORD_LENGTH_EXPLAIN'	=> '密码字元的上限与下限.',
	'REG_LIMIT'					=> '注册尝试',
	'REG_LIMIT_EXPLAIN'			=> '在这 session 锁住前用户送出确认码的尝试次数.',
	'USERNAME_ALPHA_ONLY'		=> '只可字母与数字',
	'USERNAME_ALPHA_SPACERS'	=> '字母与数字及空白',
	'USERNAME_CHARS'			=> '用户名字元限制',
	'USERNAME_CHARS_ANY'		=> '任意的',
	'USERNAME_CHARS_EXPLAIN'	=> '限制用户名可用的字元型式, 多个空白; 空白, -, +, _, [ 及 ]',
	'USERNAME_LENGTH'			=> '用户名长度',
	'USERNAME_LENGTH_EXPLAIN'	=> '用户名字元的上限与下限.',
));

// Visual Confirmation Settings
$lang = array_merge($lang, array(
	'ACP_VC_SETTINGS_EXPLAIN'			=> '这里您可以设定识别确认Here you are able to define visual confirmation defaults and captcha settings',

	'CAPTCHA_3DBITMAP'				=> '3D 位图',
	'CAPTCHA_CELLS'					=> 'Cells',
	'CAPTCHA_COMPOSITE'				=> '合成的',
	'CAPTCHA_ENTROPY'				=> '熵',
	'CAPTCHA_OPTIONS'				=> 'Captcha Options',
	'CAPTCHA_OVERLAP'				=> '部分重叠',
	'CAPTCHA_SHAPE'					=> '形状',
	'CAPTCHA_STENCIL'				=> '蜡纸',
	'ENTROPY_NOISE_LINE'			=> '熵线段干扰',
	'ENTROPY_NOISE_PIXEL'			=> '熵像素干扰',
	'HEAVY'							=> '重',
	'LIGHT'							=> '轻',
	'MEDIUM'						=> '中度',
	'OVERLAP_NOISE_LINE'			=> '部分重叠线段干扰',
	'OVERLAP_NOISE_PIXEL'			=> '部分重叠像素干扰',
	'SHAPE_NOISE_LINE'				=> '形状线段干扰',
	'SHAPE_NOISE_PIXEL'				=> '形状像素干扰',
	'VISUAL_CONFIRM_POST'			=> '访客发文时开启识别确认',
	'VISUAL_CONFIRM_POST_EXPLAIN'	=> '要求匿名者输入符合图片的乱数码以防止大量发文.',
	'VISUAL_CONFIRM_REG'			=> '注册时开启识别确认',
	'VISUAL_CONFIRM_REG_EXPLAIN'	=> '要求新用户输入符合图片的乱数码以防止大量注册.',
));

// Cookie Settings
$lang = array_merge($lang, array(
	'ACP_COOKIE_SETTINGS_EXPLAIN'		=> '这些设定控制着 Cookie 的定义, 就一般的情况, 使用系统预设值就可以了. 如果您要更改这些设定, 请小心处理, 不当的设定将导致用户需重复登入.',

	'COOKIE_DOMAIN'			=> 'Cookie 网域',
	'COOKIE_NAME'			=> 'Cookie 名称',
	'COOKIE_PATH'			=> 'Cookie 路径',
	'COOKIE_SECURE'			=> 'Cookie 加密',
	'COOKIE_SECURE_EXPLAIN'	=> '如果您的伺服器使用 SSL 通讯协定, 请开启这项设定, 否则请保持关闭的状态',
	'ONLINE_LENGTH'				=> '查看在线时间范围',
	'ONLINE_LENGTH_EXPLAIN'		=> '多少分钟后不活动的用户将不在线上列表中.',
	'SESSION_LENGTH'			=> 'session 存活时间',
	'SESSION_LENGTH_EXPLAIN'	=> 'sessions 在这个时间后将失效, 单位为秒.',
));

// Load Settings
$lang = array_merge($lang, array(
	'ACP_LOAD_SETTINGS_EXPLAIN'	=> '这里您可以启用或停用某些功能以减低论坛运行的负担. 对大多数的伺服器而言并无必要停用任何功能. 然而于某些系统或共享的主机环境, 停用您不须要的功能应是最佳的. 您也可以指定系统载入的限制与有效的 session 于越出论坛就离线.',

	'CUSTOM_PROFILE_FIELDS'			=> '自订个人资料栏位',
	'LIMIT_LOAD'					=> '限制系统载入',
	'LIMIT_LOAD_EXPLAIN'			=> '如果系统载入超过 1 分钟论坛就离线, 1.0 等于一个处理程序的 100% 利用 . 这项功能仅适用于 仿UNIX 伺服器.',
	'LIMIT_SESSIONS'				=> '限制 session',
	'LIMIT_SESSIONS_EXPLAIN'		=> '如果 session 的个数超过这个值则 1 分钟内论坛就离线. 0 代表不受限.',
	'LOAD_CPF_MEMBERLIST'			=> '于会员列表显示自订个人资料栏位',
	'LOAD_CPF_VIEWPROFILE'			=> '于用户个人资料显示自订个人资料栏位',
	'LOAD_CPF_VIEWTOPIC'			=> '于检视主题显示自订个人资料栏位',
	'LOAD_USER_ACTIVITY'			=> '显示用户们的活动',
	'LOAD_USER_ACTIVITY_EXPLAIN'	=> '于用户个人资料与用户控制面板显示活跃的 主题/版面. 强烈建议当文章数超过 1 百万时关闭本功能.',
	'RECOMPILE_TEMPLATES'			=> '重新编译较旧的模板文件(template)',
	'RECOMPILE_TEMPLATES_EXPLAIN'	=> '检查系统中已更新的模板文件并重新编译.',
	'YES_BIRTHDAYS'					=> '启用寿星列表',
	'YES_JUMPBOX'					=> '启用显示跳跃版面选取方块',
	'YES_MODERATORS'				=> '启用显示版面管理员',
	'YES_ONLINE'					=> '启用线上用户列表',
	'YES_ONLINE_EXPLAIN'			=> '于首页, 版面及检视主题时显示线上用户的资讯.',
	'YES_ONLINE_GUESTS'				=> '启用线上访客列表于线上用户',
	'YES_ONLINE_GUESTS_EXPLAIN'		=> '允许于线上用户显示线上访客的资讯.',
	'YES_ONLINE_TRACK'				=> '启用显示用户在线图',
	'YES_ONLINE_TRACK_EXPLAIN'		=> '于个人资料与检视主题显示用户在线资讯.',
	'YES_POST_MARKING'				=> '启用有点子的主题',
	'YES_POST_MARKING_EXPLAIN'		=> '指示用户是否已发表一篇主题.',
	'YES_READ_MARKING'				=> '启用伺服器端标示主题',
	'YES_READ_MARKING_EXPLAIN'		=> '储存 阅读/未读 的状况资讯于资料库(比利用 cookie 好).',
));

// Auth settings
$lang = array_merge($lang, array(
	'ACP_AUTH_SETTINGS_EXPLAIN'	=> 'phpBB 支援的认证外挂, or modules. 这些项目允许您设定用户登入论坛时以何种方法来认证. 预设提供 3 种; DB, LDAP 与 Apache. 并非所有方法都须要额外的资讯只当您选取 LDAP 才须填写栏位.',

	'AUTH_METHOD'				=> '选择一个认证方式',
	'LDAP_DN'					=> 'LDAP base dn',
	'LDAP_DN_EXPLAIN'			=> 'This is the Distinguished Name, locating the user information, e.g. o=My Company,c=US',
	'LDAP_NO_IDENTITY'			=> 'Could not find a login identity for %s',
	'LDAP_NO_LDAP_EXTENSION'	=> 'LDAP extension not availible',
	'LDAP_NO_SERVER_CONNECTION'	=> 'Could not connect to LDAP server',
	'LDAP_SERVER'				=> 'LDAP server name',
	'LDAP_SERVER_EXPLAIN'		=> 'If using LDAP this is the name or IP address of the server.',
	'LDAP_UID'					=> 'LDAP uid',
	'LDAP_UID_EXPLAIN'			=> 'This is the key under which to search for a given login identity, e.g. uid, sn, etc.',
));

// Server Settings
$lang = array_merge($lang, array(
	'ACP_SERVER_SETTINGS_EXPLAIN'	=> '这里您可以规定伺服器与网域相关设定. 请确认您输入的资料正确无误, 错误将导致电子邮件包含不正确的资讯. 输入网域名称时记得包括 http:// 或其它协定事项. 只要更改连接埠的值如果您知道您的连接埠与所列不同, 大部分情形使用 80 来作为连接埠.',

	'ENABLE_GZIP'				=> '启用 Gzip 压缩功能',
	'FORCE_SERVER_VARS'			=> '强制伺服器网址设定',
	'FORCE_SERVER_VARS_EXPLAIN'	=> '如果设定是则使用规定的伺服器设定有利于自动设定的值',
	'ICONS_PATH'				=> '文章图示储存路径',
	'ICONS_PATH_EXPLAIN'		=> '在您 phpBB 根目录底下的路径, 例如: images/icons',
	'PATH_SETTINGS'				=> '路径设定',
	'RANKS_PATH'				=> '等级图片储存路径',
	'RANKS_PATH_EXPLAIN'		=> '在您 phpBB 根目录底下的路径, 例如: images/ranks',
	'SEND_ENCODING'				=> 'Send Encoding',
	'SEND_ENCODING_EXPLAIN'		=> 'Send the file encoding from phpBB via HTTP overriding the webserver configuration',
	'SERVER_NAME'				=> '网域名称',
	'SERVER_NAME_EXPLAIN'		=> '网域名称指论坛由 (例如: www.foo.bar) 运转',
	'SERVER_PORT'				=> '伺服器连接埠',
	'SERVER_PORT_EXPLAIN'		=> '伺服器通常使用 80 来作为连接埠, 除非您使用不同的连接埠, 否则这项设定是不需更改的',
	'SERVER_PROTOCOL'			=> '伺服器协定',
	'SERVER_PROTOCOL_EXPLAIN'	=> '如果强制了伺服器网址设定则这项目就被当作伺服器协定. 如果空白或不强制协定则由 cookie 安全设定来决定 (http:// or https://)',
	'SERVER_URL_SETTINGS'		=> '伺服器网址设定',
	'SMILIES_PATH'				=> '表情符号储存路径',
	'SMILIES_PATH_EXPLAIN'		=> '在您 phpBB 根目录底下的路径, 例如: images/smilies',
	'UPLOAD_ICONS_PATH'			=> '副档名群组图像储存路径',
	'UPLOAD_ICONS_PATH_EXPLAIN'	=> '在您 phpBB 根目录底下的路径, 例如: images/upload_icons',
));

// Security Settings
$lang = array_merge($lang, array(
	'ACP_SECURITY_SETTINGS_EXPLAIN'		=> '这里您可以规定 session 及登入的相关设定',

	'ALL'							=> '全部',
	'ALLOW_AUTOLOGIN'				=> '允许持续登入', 
	'ALLOW_AUTOLOGIN_EXPLAIN'		=> '设定用户于登入论坛时是否可以选择自动登入.', 
	'AUTOLOGIN_LENGTH'				=> '持续登入的有效期限', 
	'AUTOLOGIN_LENGTH_EXPLAIN'		=> '于持续登入的日数后移除或 0 代表停用.', 
	'BROWSER_VALID'					=> '浏览器认证',
	'BROWSER_VALID_EXPLAIN'			=> '启用浏览器认证每一 session 以增加安全.',
	'CLASS_B'						=> 'A.B',
	'CLASS_C'						=> 'A.B.C',
	'FORCE_PASS_CHANGE'				=> '强迫变更密码',
	'FORCE_PASS_CHANGE_EXPLAIN'		=> '要求用户于指定的日数变更密码或 0 代表停用.',
	'IP_VALID'						=> 'session IP 认证',
	'IP_VALID_EXPLAIN'				=> '设定以多少个的用户 IP 认证 session; 全部代表完整位址, A.B.C 代表前3个 x.x.x, A.B 代表前2个 x.x, 没有代表停用认证.',
	'MAX_LOGIN_ATTEMPTS'			=> '尝试登入的上限次数',
	'MAX_LOGIN_ATTEMPTS_EXPLAIN'	=> '在登入失败的次数达上限后用户必须额外的确认视觉登入 (识别确认)',
	'PASSWORD_TYPE'					=> '密码错综性',
	'PASSWORD_TYPE_EXPLAIN'			=> '设定密码的复杂性当需要设定或变更时, 后面的选项包含前面的.',
	'PASS_TYPE_ALPHA'				=> '必须包含字母与数字',
	'PASS_TYPE_ANY'					=> '不须要',
	'PASS_TYPE_CASE'				=> '必须混合',
	'PASS_TYPE_SYMBOL'				=> '必须包含符号',
	'TPL_ALLOW_PHP'					=> '允许于模板文件使用 php 语法',
	'TPL_ALLOW_PHP_EXPLAIN'			=> '如果启用这个项目, PHP 与 INCLUDEPHP 语句将在模板中解析和运行.',
));

// Email Settings
$lang = array_merge($lang, array(
	'ACP_EMAIL_SETTINGS_EXPLAIN'	=> '当系统发送邮件给用户时要用到这些信息. 请确认您指定的邮箱地址是有效的, 任何退回的或者无法投递的信息可能返回您设定的邮箱. 如果您的主机不提供一个本地 (PHP 所依据) email 服务, 您也可以直接使用 SMTP 发送邮件. 这需要一个适当的伺服器 (如果有必要请询问您的主机服务商). 如果伺服器须要认证请输入必要的用户名和密码. 请注意只提供基本的认证即可, 不同的认证方法普遍不受支持.',

	'ADMIN_EMAIL'					=> '回覆邮件地址',
	'ADMIN_EMAIL_EXPLAIN'			=> '这个地址将被当作所有电子邮件的回覆地址.',
	'BOARD_EMAIL_FORM'				=> '用户藉由论坛邮寄电子邮件',
	'BOARD_EMAIL_FORM_EXPLAIN'		=> '用户可藉由论坛邮寄电子邮件替代显示用户的邮件信箱.',
	'BOARD_HIDE_EMAILS'				=> '隐藏电子邮件信箱',
	'BOARD_HIDE_EMAILS_EXPLAIN'		=> '这个功能保护邮件信箱完全保密.',
	'CONTACT_EMAIL'					=> '联系的邮件信箱',
	'CONTACT_EMAIL_EXPLAIN'			=> '指定系统管理员的联系信箱, 例如: 输出错误讯息.',
	'EMAIL_FUNCTION_NAME'			=> '电子邮件函数名称',
	'EMAIL_FUNCTION_NAME_EXPLAIN'	=> '通过 PHP 邮寄电子邮件的电子邮件函数名称.',
	'EMAIL_PACKAGE_SIZE'			=> 'Email Package Size',
	'EMAIL_PACKAGE_SIZE_EXPLAIN'	=> 'This is the number of emails sent in one package.',
	'EMAIL_SIG'						=> '电子邮件签名档',
	'EMAIL_SIG_EXPLAIN'				=> '这个签名档将会被附加在所有由论坛送出的电子邮件中.',
	'ENABLE_EMAIL'					=> 'Enable board-wide emails',
	'ENABLE_EMAIL_EXPLAIN'			=> 'If this is set to disabled no emails will be sent by the board at all.',
	'SMTP_AUTH_METHOD'				=> 'SMTP 的认证方式',
	'SMTP_AUTH_METHOD_EXPLAIN'		=> '只设定一组 用户名/密码 即可, 如果您不知道使用哪种认证方式最好询问您的伺服器提供商.',
	'SMTP_CRAM_MD5'					=> 'CRAM-MD5',
	'SMTP_DIGEST_MD5'				=> 'DIGEST-MD5',
	'SMTP_LOGIN'					=> 'LOGIN',
	'SMTP_PASSWORD'					=> 'SMTP 密码',
	'SMTP_PASSWORD_EXPLAIN'			=> '您的 SMTP 伺服器有要求时只须输入一组密码.',
	'SMTP_PLAIN'					=> 'PLAIN',
	'SMTP_POP_BEFORE_SMTP'			=> 'POP-BEFORE-SMTP',
	'SMTP_PORT'						=> 'SMTP 伺服器连接埠',
	'SMTP_PORT_EXPLAIN'				=> '如果您知道您的 SMTP 伺服器连接埠与所列不同才须要更改.',
	'SMTP_SERVER'					=> 'SMTP 伺服器位址',
	'SMTP_SETTINGS'					=> 'SMTP 设定',
	'SMTP_USERNAME'					=> 'SMTP 用户名',
	'SMTP_USERNAME_EXPLAIN'			=> '您的 SMTP 伺服器有要求时只须输入一位用户名.',
	'USE_SMTP'						=> '使用 SMTP 伺服器传送电子邮件',
	'USE_SMTP_EXPLAIN'				=> '假如您想要使用 SMTP 伺服器发送电子邮件请选择 是.',
));

// Jabber settings
$lang = array_merge($lang, array(
	'ACP_JABBER_SETTINGS_EXPLAIN'	=> 'Here you can enable and control the use Jabber for instant messaging and board notices. Jabber is an opensource protocol and therefore available for use by anyone. Some Jabber servers include gateways or transports which allow you to contact users on other networks. Not all servers offer all transports and changes in protocols can prevent transports from operating. Note that it may take several seconds to update Jabber account details, do not stop the script till completed!',

	'ERR_JAB_AUTH'			=> '不能够验证 Jabber 伺服器',
	'ERR_JAB_CONNECT'		=> '不能够连接 Jabber 伺服器',
	'ERR_JAB_PASSCHG'		=> '不能改变密码',
	'ERR_JAB_PASSFAIL'		=> '密码更新失败, %s',
	'ERR_JAB_REGISTER'		=> '注册帐号时发生错误, %s',
	'ERR_JAB_USERNAME'		=> '指定的用户名已经存在, 请另选一个.',

	'JAB_CHANGED'				=> '成功改变 Jabber 帐号',
	'JAB_ENABLE'				=> '开启 Jabber',
	'JAB_ENABLE_EXPLAIN'		=> '开启 Jabber 使得用户可以发送即时讯息和系统通知',
	'JAB_PACKAGE_SIZE'			=> 'Jabber Package Size',
	'JAB_PACKAGE_SIZE_EXPLAIN'	=> 'This is the number of messages sent in one package. If set to 0 the message is sent immediatly and gets not queued for later sending.',
	'JAB_PASSWORD'				=> 'Jabber 密码',
	'JAB_PASS_CHANGED'			=> '成功改变 Jabber 密码',
	'JAB_PORT'					=> 'Jabber 连接埠',
	'JAB_PORT_EXPLAIN'			=> '可以保留空白除非您知道它不是 5222',
	'JAB_REGISTERED'			=> '成功注册新帐号',
	'JAB_RESOURCE'				=> 'Jabber 资源',
	'JAB_RESOURCE_EXPLAIN'		=> '这些资源定位于特殊的连接, 例如: 论坛, 主页, 等等.',
	'JAB_SERVER'				=> 'Jabber 伺服器',
	'JAB_SERVER_EXPLAIN'		=> '参观 %sjabber.org%s 伺服器列表',
	'JAB_SETTINGS_CHANGED'		=> '变更 Jabber 设定成功',
	'JAB_USERNAME'				=> 'Jabber 用户名',
	'JAB_USERNAME_EXPLAIN'		=> '如果这个用户尚未注册将尽可能建立.',
));

?>