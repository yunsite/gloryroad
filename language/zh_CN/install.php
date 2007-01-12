<?php
/** 
*
* install [中文] :: CRLin - http://web.dhjh.tcc.edu.tw/~gzqbyr/styles/
*
* @package language
* @version $Id: install.php,v 1.22 2006/06/17 20:28:39 acydburn Exp $
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
	'ADMIN_CONFIG'				=> '系统管理设定',
	'ADMIN_PASSWORD'			=> '系统管理员密码',
	'ADMIN_PASSWORD_CONFIRM'	=> '确认系统管理员密码',
	'ADMIN_PASSWORD_EXPLAIN'	=> '(密码请输入 6 至 30 个字母或数字)',
	'ADMIN_TEST'				=> '检验系统管理员的设定',
	'ADMIN_USERNAME'			=> '系统管理员名称',
	'APP_MAGICK'				=> 'Imagemagick 支援 [ 附加档案 ]',
	'AUTHOR_NOTES'				=> '发表人注释<br />&#187; %s',
	'AVAILABLE'					=> '可用',
	'AVAILABLE_CONVERTORS'		=> '可用的转换器',
	
	'BEGIN_CONVERT'				=> '开始转换',
	'BLANK_PREFIX_FOUND'		=> '细看您的资料表已有有效安装可不使用资料表头.',

	'CACHE_STORE'				=> '暂存型式',
	'CACHE_STORE_EXPLAIN'		=> '资料暂存的实际位置, 档案系统的偏爱.',
	'CAT_CONVERT'				=> '转换',
	'CAT_INSTALL'				=> '安装',
	'CAT_OVERVIEW'				=> '综观',
	'CHECK_TABLE_PREFIX'		=> '请检验资料表头并再试一次.',
	'CLEAN_VERIFY'				=> '清理及验证最终结构',
	'CONFIG_CONVERT'			=> '转换设定',
	'CONFIG_FILE_UNABLE_WRITE'	=> '配置档(config.php)不能写入. 底下列出这个档案的处理方案',
	'CONFIG_FILE_WRITTEN'		=> '配置档已写入, 您现在可以继续下一步安装',
	'CONFIG_RETRY'				=> '重试',
	'CONTACT_EMAIL_CONFIRM'		=> '确认联系电子邮件',
	'CONTINUE_CONVERT'			=> '继续转换',
	'CONTINUE_LAST'				=> '继续最后的说明',
	'CONVERT'					=> '转换',
	'CONVERT_COMPLETE'			=> '转换完成',
	'CONVERT_INTRO'				=> '欢迎光临 phpBB 统一的转换器程式',
	'CONVERT_INTRO_BODY'		=> '在这里, 您可以从其它(已安装的)论坛系统引进资料. 底下列出现在全部可用的转换模组. 如果下表没有您要的转换模组, 请检查我们的网站哪里有进一步的转换模组供下载.',
	'CONVERT_NOT_EXIST'			=> '指定的转换器不存在',
	'CONVERT_SETTINGS_VERIFIED'	=> '您输入的资讯已验证. 按底下按钮启动进行转换',
	'COULD_NOT_FIND_PATH'		=> '找不到您表单上论坛的路径. 请检查您的设定并再试一次.<br />&#187; 指定的原来路径是 %s',

	'DBMS'						=> '资料库型式',
	'DB_CONFIG'					=> '资料库配置',
	'DB_CONNECTION'				=> '资料库连线',
	'DB_ERR_INSERT'				=> '进行 INSERT query 时发生错误',
	'DB_ERR_LAST'				=> '进行 query_last 时发生错误',
	'DB_ERR_QUERY_FIRST'		=> '执行 query_first 时发生错误',
	'DB_ERR_QUERY_FIRST_TABLE'	=> '执行 query_first 时发生错误, %s ("%s")',
	'DB_ERR_SELECT'				=> '进行 SELECT query  时发生错误',
	'DB_HOST'					=> '资料库伺服器主机或 DSN',
	'DB_HOST_EXPLAIN'			=> 'DSN (Data Source Name) 仅与安装 ODBC 有关.',
	'DB_NAME'					=> '资料库名',
	'DB_PASSWORD'				=> '资料库密码',
	'DB_PORT'					=> '资料库伺服器 port',
	'DB_PORT_EXPLAIN'			=> '请保留空白除非您知道伺服器运行于非标准的 port.',
	'DB_USERNAME'				=> '资料库用户名',
	'DB_TEST'					=> '测试连线',
	'DEFAULT_LANG'				=> '自定系统语系',
	'DEFAULT_PREFIX_IS'			=> '作为 %1$s 的自定资料表表头名是 <strong>%2$s</strong>',
	'DEV_NO_TEST_FILE'			=> 'No value has been specified for the test_file variable in the convertor. If you are a user of this convertor, you should not be seeing this error, please report this message to the convertor author. If you are a convertor author, you must specify the name of a file which exists in the source forum to allow the path to it to be verified.',
	'DIRECTORIES_AND_FILES'		=> '目录与档案安装',
	'DISABLE_KEYS'				=> 'Disabling keys',
	'DLL_FIREBIRD'				=> 'Firebird 1.5+',
	'DLL_FTP'					=> '远端 FTP 支援 [ 安装 ]',
	'DLL_MBSTRING'				=> 'Multi-byte character support',
	'DLL_MSSQL'					=> 'MSSQL Server 2000+',
	'DLL_MSSQL_ODBC'			=> 'MSSQL Server 2000+ via ODBC',
	'DLL_MYSQL'					=> 'MySQL 3.23.x/4.x',
	'DLL_MYSQL4'				=> 'MySQL 4.x/5.x',
	'DLL_MYSQLI'				=> 'MySQL 4.1.x/5.x with MySQLi Extension',
	'DLL_ORACLE'				=> 'Oracle',
	'DLL_POSTGRES'				=> 'PostgreSQL 7.x',
	'DLL_SQLITE'				=> 'SQLite',
	'DLL_XML'					=> 'XML 支援  [ Jabber ]',
	'DLL_ZLIB'					=> 'zlib 压缩支援 [ gz, .tar.gz, .zip ]',
	'DL_CONFIG'					=> '下载配置档',
	'DL_CONFIG_EXPLAIN'			=> 'You may download the complete config.php to your own PC. You will then need to upload the file manually, replacing any existing config.php in your phpBB 3.0 root directory. Please remember to upload the file in ASCII format (see your FTP application documentation if you are unsure how to achieve this). When you have uploaded the config.php please click "Done" to move to the next stage.',
	'DL_DOWNLOAD'				=> '下载',
	'DONE'						=> '已完成',

	'ENABLE_KEYS'				=> 'Re-enabling keys. 请稍待一会儿',

	'FILES_OPTIONAL'			=> '选择档案与目录',
	'FILES_OPTIONAL_EXPLAIN'	=> '<strong>非必要的</strong> - 这些档案, 目录或权限属非必要的. 安装程序会尝试它们是否存在及是否可写入. 然而, 这些档案的存在或目录权限会加速安装.',
	'FILES_REQUIRED'			=> '档案与目录',
	'FILES_REQUIRED_EXPLAIN'	=> '<strong>必要的</strong> - phpBB 必须能存取或写入某些档案或目录才可以正确运作. 如果您看到 "找不到" 时, 您必须建立相关的档案或目录. 如果您看到 "不可写入" 时, 您必须更改档案或目录的权限以使 phpBB 可以写入.',
	'FILLING_TABLE'				=> '填入资料表 <b>%s</b>',
	'FILLING_TABLES'			=> '填入资料表',
	'FINAL_STEP'				=> '进行最后步骤',
	'FORUM_ADDRESS'				=> '论坛网址',
	'FORUM_ADDRESS_EXPLAIN'		=> '这是您表单的论坛网址',
	'FORUM_PATH'				=> '论坛路径',
	'FORUM_PATH_EXPLAIN'		=> '这是有关于填入 <strong>phpBB 主目录</strong> 于伺服器路径的表单',
	'FOUND'						=> '找到了',
	'FTP_CONFIG'				=> 'Transfer config by FTP',
	'FTP_CONFIG_EXPLAIN'		=> 'phpBB has detected the presence of the FTP module on this server. You may attempt to install your config.php via this if you wish. You will need to supply the information listed below. Remember your username and password are those to your server! (ask your hosting provider for details if you are unsure what these are)',
	'FTP_PATH'					=> 'FTP 路径',
	'FTP_PATH_EXPLAIN'			=> '这是 phpBB2 相对于您的根目录路径, e.g. htdocs/phpBB2/',
	'FTP_UPLOAD'				=> '上传',

	'GPL'						=> 'General Public License',
	
	'INITIAL_CONFIG'			=> '基本配置',
	'INITIAL_CONFIG_EXPLAIN'	=> 'Now that install has determined your server can run phpBB you need to supply some specific information. If you do not know how to connect to your database please contact your hosting provider (in the first instance) or  use the phpBB support forums. When entering data please ensure you check it thoroughly before continuing.',
	'INSTALL_CONGRATS'			=> '恭喜',
	'INSTALL_CONGRATS_EXPLAIN'	=> '您现在已成功安装 phpBB 3.0. 按底下按钮您将前往系统管理面板 (ACP). 花些时间来检验可用的选项. 记住可由用户手册及 phpBB 支援论坛取得线上帮助, 进一步的资讯, 请浏览%s<font color=red>读我</font>%s.',
	'INSTALL_INTRO'				=> '欢迎安装',
	'INSTALL_INTRO_BODY'		=> '由于这个选择, 您可能将 phpBB 安装至伺服器.</p><p>安装前, 您必须清楚底下资讯:</p>
	<ul>
	<li>资料库(数据库)伺服器名</li>
	<li>资料库名</li>
	<li>资料库用户名与密码</li>
	</ul>
	<p>可由此获得更多的介绍文件...',
	'INSTALL_INTRO_NEXT'		=> '请按底下按钮开始安装.',
	'INSTALL_LOGIN'				=> '登入',
	'INSTALL_NEXT'				=> 'Next stage',
	'INSTALL_NEXT_FAIL'			=> 'Some tests failed and you should correct these problems before proceeding to the next stage. Failure to do so may result in an incomplete installation.',
	'INSTALL_NEXT_PASS'			=> 'All the basic tests have been passed and you may proceed to the next stage of installation. If you have changed any permissions, modules, etc. and wish to re-test you can do so if you wish.',
	'INSTALL_PANEL'				=> '安装面板',
	'INSTALL_SEND_CONFIG'		=> '很不幸地, phpBB 无法直接写入资料至您的配置档 config.php. 原因可能是配置档不存在或无法写入. 底下列出一些项目使您能完成 config.php 的处理.',
	'INSTALL_START'				=> '开始安装',
	'INSTALL_TEST'				=> '再试一次',
	'INST_ERR_DB_CONNECT'		=> '无法连线至资料库, 错误讯息如下',
	'INST_ERR_DB_NO_ERROR'		=> '没有回应错误讯息',
	'INST_ERR_EMAIL_INVALID'	=> '您输入的电子邮件信箱无效',
	'INST_ERR_EMAIL_MISMATCH'	=> '您输入的电子邮件信箱不符.',
	'INST_ERR_FATAL'			=> '无可挽回的错误安装',
	'INST_ERR_FATAL_DB'			=> '资料库发生一个无可挽回与无法补救的错误. 原因可能是指定的资料库用户名没有 CREATE TABLES 或 INSERT data, 等等的权限. 更进一步的资讯可能详列于后. 首先请联系您的伺服器主机提供者或求助于 phpBB 论坛以获得协助.',
	'INST_ERR_FTP_PATH'			=> '不能更改所给目录, 请检查路径.',
	'INST_ERR_FTP_LOGIN'		=> '不能登入 FTP 伺服器, 检查您的用户名与密码',
	'INST_ERR_MISSING_DATA'		=> '您必须填写区块里的所有栏位',
	'INST_ERR_NO_DB'			=> '所选的资料库型式 PHP module 无法载入',
	'INST_ERR_PASSWORD_MISMATCH' => '您输入的密码不符.',
	'INST_ERR_PASSWORD_TOO_LONG' => '您输入的密码过长. 最多 30 个字元.',
	'INST_ERR_PASSWORD_TOO_SHORT' => '您输入的密码过短. 最少 6 个字元.',
	'INST_ERR_PREFIX'			=> '指定的资料表表头名已存在, 请另选一个.',
	'INVALID_PRIMARY_KEY'		=> 'Invalid primary key : %s',

	'MAKE_FOLDER_WRITABLE'		=> '请确定这个资料夹存在且可写入然后再试一次:<br />&#187;<b>%s</b>',
	'MAKE_FOLDERS_WRITABLE'		=> '请确定这些资料夹存在且可写入然后再试一次:<br />&#187;<b>%s</b>',

	'NAMING_CONFLICT'			=> '命名冲突: %s 与 %s 都是别名<br /><br />%s',
	'NEXT_STEP'					=> '进行下一步',
	'NOT_FOUND'					=> '找不到',
	'NOT_UNDERSTAND'			=> '不暸解 %s #%d, 资料表 %s ("%s")',
	'NO_CONVERTORS'				=> '没有转换器可用',
	'NO_CONVERT_SPECIFIED'		=> '没有指定转换器 ',
	'NO_LOCATION'				=> '找不到所在位置',
	'NO_TABLES_FOUND'			=> '找不到资料表.',
// TODO: Write some explanatory introduction text
	'OVERVIEW_BODY'					=> 'Welcome to our first public beta of the next-generation of phpBB after 2.0.x, phpBB 3.0! This beta release is intended for advanced users to try out on dedicated development enviroments to help us finish creating the best Opensource Bulletin Board solution available.</p><p><strong style="text-transform: uppercase;">Note:</strong> This release is <strong style="text-transform: uppercase;">not final</strong> and made available for testing purposes <strong style="text-transform: uppercase;">only</strong>.</p><p>This installation system will guide you through the process of installing phpBB, converting from a different software package or updating to the latest version of phpBB. For more information on each option, select it from the menu above.',
	'PHP_OPTIONAL_MODULE'			=> '非必要的模组',
	'PHP_OPTIONAL_MODULE_EXPLAIN'	=> '<strong>非必要的</strong> - 这些模组或应用程式属非必要, 您不必用于phpBB 3.0. 然而如果您有这些模组, 它们能使 phpBB 发挥的更棒.',
	'PHP_SUPPORTED_DB'				=> '支援的资料库',
	'PHP_SUPPORTED_DB_EXPLAIN'		=> '<strong>必要的</strong> - 您必须至少有一个支援 PHP 的相容资料库. 如果所列出的资料库没有一个可用的, 则您须联系您的伺服器提供者或再检查相关的 PHP 安装文件报告.',
	'PHP_REGISTER_GLOBALS'			=> 'PHP 设定 "register_globals" 无效',
	'PHP_REGISTER_GLOBALS_EXPLAIN'	=> '如果这项设定 "On", phpBB 可能依然能开动, 为了安全启见您的 PHP 安装(php.ini)中 register_globals 应设定为 "Off".',
	'PHP_SAFE_MODE'					=> '安全模式',
	'PHP_SETTINGS'					=> 'PHP 版本与设定',
	'PHP_SETTINGS_EXPLAIN'			=> '<strong>必备的</strong> - 您的 PHP 版本至少须 4.3.3 才可安装 phpBB. 如果If "安全模式" 显示于您的 PHP 安装(php.ini)则这个模式正执行中. 您的远端管理与类似特性将会受到限制.',
	'PHP_VERSION_REQD'				=> 'PHP 版本 >= 4.3.3',
	'PREFIX_FOUND'					=> 'A scan of your tables has shown a valid installation using <strong>%s</strong> as table prefix.',
	'PREPROCESS_STEP'				=> 'Executing pre-processing functions/queries',
	'PRE_CONVERT_COMPLETE'			=> 'All pre-conversion steps have successfully been completed. You may now begin the actual conversion process.',
	'PROCESS_LAST'					=> 'Processing last statements',

//	'REQUIRED'					=> 'Required',
	'REQUIREMENTS_TITLE'		=> '安装相容性',
	'REQUIREMENTS_EXPLAIN'		=> '在进行完整安装前 phpBB 将于您的伺服器配置状况及档案实施一些测试以确保您能安装与开动 phpBB. 请确认您已认真仔细地阅读测试结果且一直到通过全部必要的测试才继续. 如果您希望由所列的随意测试中能有任一功能, 您必须确认这些功能也通过测试.',
	'RETRY_WRITE'				=> '重试写入配置档',
	'RETRY_WRITE_EXPLAIN'		=> '如果您希望更改 config.php 权限以使 phpBB 能写入, 您可以按底下 重试 再试一次. 记得在 phpBB 完成安装后恢复 config.php 的权限设定.',

	'SCRIPT_PATH'				=> '系统程式存放路径',
	'SCRIPT_PATH_EXPLAIN'		=> '论坛对应网域的路径',
	'SERVER_CONFIG'				=> '伺服器基本配置',
	'SOFTWARE'					=> 'Forum Software',
	'SPECIFY_OPTIONS'			=> 'Specify Conversion Options',
	'STAGE_ADMINISTRATOR'		=> '系统管理员细节',
	'STAGE_ADVANCED'			=> '进阶设定',
	'STAGE_ADVANCED_EXPLAIN'	=> '本页的设定只须设定与您所知有不同的部分自定. 若无法确认, 只要继续进行下一页, 这些可以在管理面板更改.',
	'STAGE_CONFIG_FILE'			=> '配置档',
	'STAGE_DATABASE'			=> '资料库(数据库)设定',
	'STAGE_FINAL'				=> '最后期',
	'STAGE_INTRO'				=> '简介',
	'STAGE_IN_PROGRESS'			=> 'Conversion in progress',
	'STAGE_REQUIREMENTS'		=> '需求',
	'STAGE_SETTINGS'			=> '设定',
	'STARTING_CONVERT'			=> 'Starting Conversion Process',
	'STEP_PERCENT_COMPLETED'	=> 'Step <b>%d</b> of <b>%d</b>: %d%% completed',
	'SUB_INTRO'					=> '简介',
	'SUB_LICENSE'				=> '版权',
	'SUB_SUPPORT'				=> '支援',
	'SUCCESSFUL_CONNECT'		=> '连线成功',
// TODO: Write some text on obtaining support
	'SUPPORT_BODY'				=> 'During the beta phase a minimal level of support will be given at <a href="http://www.phpbb.com/phpBB/viewforum.php?f=46">the phpBB 3.0 Beta1 support forum</a>. We will provide answers to general setup questions, configuration problems and support for determining common problems mostly related to bugs. We will not support modifications, custom code/style additions or any users using the beta packages within a live environment.</p><p>For additional assistance, please refer to our <a href="http://www.phpbb.com/support/documentation/3.0/quickstart/quick_start_guide.html">Quick Start Guide</a>.</p><p>To ensure you stay up to date with the latest news and releases, why not <a href="http://www.phpbb.com/support/" target="_new">subscribe to our mailing list</a>',
	'SYNC_FORUMS'				=> '开始同时整理论坛',
	'SYNC_TOPICS'				=> '开始同时整理全部主题',
	'SYNC_TOPIC_ID'				=> 'Synchronising topics from topic_id $1%s to $2%s',

	'TABLES_MISSING'			=> '找不至这些资料表<br />&#187; <b>%s</b>.',
	'TABLE_PREFIX'				=> '资料库的资料表表头名',
	'TABLE_PREFIX_SAME'			=> 'The table prefix needs to be the one used by the software you are converting from.<br />&#187; Specified table prefix was %s',
	'TESTS_PASSED'				=> '通过测试',
	'TESTS_FAILED'				=> '测试失败',

	'UNAVAILABLE'				=> '不可用',
	'UNWRITEABLE'				=> '不可写入',

	'VERSION'					=> '版本',

	'WELCOME_INSTALL'			=> '欢迎安装 phpBB 3 论坛系统',
	'WRITEABLE'					=> '可写入',
));

?>