<?php
/** 
*
* mcp [中文] :: CRLin - http://web.dhjh.tcc.edu.tw/~gzqbyr/styles/
*
* @package language
* @version $Id: mcp.php,v 1.43 2006/06/17 12:16:56 naderman Exp $
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
	'ACTION'				=> '作用',
	'ADD_FEEDBACK'			=> '增加讯息回馈',
	'ADD_FEEDBACK_EXPLAIN'	=> '如果您想于此提出检举请填底下表单. 只能使用文字模式; HTML, BBCode, 等不可使用.',
	'ADD_WARNING'			=> '增加警告',
	'ADD_WARNING_EXPLAIN'	=> '欲寄发警告给此用户请填底下表单. 只能使用文字模式; HTML, BBCode, 等不可使用.',
	'ALL_ENTRIES'			=> '所有记载事项',
	'ALL_NOTES_DELETED'		=> '移除所有用户记载事项成功',
	'ALL_REPORTS'			=> '所有检举',
	'ALREADY_REPORTED'		=> '这篇检举已发出',
	'ALREADY_WARNED'		=> '这篇文章已被发布警告',
	'APPROVE'				=> '核准',
	'APPROVE_POST'			=> '核准文章',
	'APPROVE_POST_CONFIRM'	=> '您确定要核准这篇文章?',
	'APPROVE_POSTS'			=> '核准文章',
	'APPROVE_POSTS_CONFIRM'	=> '您确定要核准所选取的文章?',

	'CANNOT_MOVE_SAME_FORUM'=> '您不可以移除本篇主题至已有此主题的版面',
	'CANNOT_WARN_ANONYMOUS'	=> '您不可以警告访客',
	'CAN_LEAVE_BLANK'		=> '这里不可空白.',
	'CHANGE_POSTER'			=> '更改发表人',
	'CLOSE_REPORT'			=> '关闭检举',
	'CLOSE_REPORT_CONFIRM'	=> '您确定要关闭所选取的检举?',
	'CLOSE_REPORTS'			=> '关闭检举',
	'CLOSE_REPORTS_CONFIRM'	=> '您确定要关闭所选取的检举?',

	'DELETE_POSTS'			=> '删除文章',
	'DELETE_POSTS_CONFIRM'	=> '您确定要删除这些文章?',
	'DELETE_POST_CONFIRM'	=> '您确定要删除这篇文章?',
	'DELETE_REPORT'			=> '删除检举',
	'DELETE_REPORT_CONFIRM'	=> '您确定要删除所选取的检举?',
	'DELETE_REPORTS'		=> '删除检举',
	'DELETE_REPORTS_CONFIRM'	=> '您确定要删除所选取的检举?',
	'DELETE_TOPICS'			=> '删除选取检举',
	'DELETE_TOPICS_CONFIRM'	=> '您确定要删除这些主题?',
	'DELETE_TOPIC_CONFIRM'	=> '您确定要删除这篇主题?',
	'DISAPPROVE'			=> '不准',
	'DISAPPROVE_REASON'		=> '不准的理由',
	'DISAPPROVE_POST'		=> '不准的文章',
	'DISAPPROVE_POST_CONFIRM'	=> '您确定要不准这篇文章?',
	'DISAPPROVE_POSTS'		=> '不准的文章',
	'DISAPPROVE_POSTS_CONFIRM'	=> '您确定要不准所选的文章?',
	'DISPLAY_LOG'			=> '显示先前记载事项',
	'DISPLAY_OPTIONS'		=> '显示选项',

	'EMPTY_REPORT'			=> '当选取这理由您必须输入叙述',
	'EMPTY_TOPICS_REMOVED_WARNING'	=> '请注意一或多个主题已从资料库移除因为已无资料',

	'FEEDBACK'				=> '讯息回馈',
	'FORK'					=> '分歧',
	'FORK_TOPIC'			=> '分歧主题',
	'FORK_TOPIC_CONFIRM'	=> '您确定要复制这篇主题?',
	'FORK_TOPICS'			=> '分歧所选主题',
	'FORK_TOPICS_CONFIRM'	=> '您确定要复制所选主题?',
	'FORUM_DESC'			=> '叙述',
	'FORUM_NAME'			=> '版面名称',
	'FORUM_NOT_EXIST'		=> '您选的版面不存在',
	'FORUM_NOT_POSTABLE'	=> '您选的版面不可以发文',
	'FORUM_STATUS'			=> '版面状况',
	'FORUM_STYLE'			=> '版面风格',

	'GLOBAL_ANNOUNCEMENT'	=> '全区公告',

	'IP_INFO'				=> 'IP 资讯',

	'JUMP_TO'					=> '版面管理',		// Overwriting the jump to language variable for the mcp jumpbox
	
	'LATEST_LOGS'				=> '最近 5 次的登入活动',
	'LATEST_REPORTED'			=> '最近 5 篇检举',
	'LATEST_UNAPPROVED'			=> '最近 5 篇等候核准的文章',
	'LATEST_WARNING_TIME'		=> '最近发布的警告',
	'LATEST_WARNINGS'			=> '最近 5 次警告',
	'LEAVE_SHADOW'				=> 'Leave shadow topic in place',
	'LIST_REPORT'				=> '1 篇检举',
	'LIST_REPORTS'				=> '%d 篇检举',
	'LOCK'						=> '锁定',
	'LOCK_POST_POST'			=> '锁定文章',
	'LOCK_POST_POST_CONFIRM'	=> '您确定要防止编辑这篇文章?',
	'LOCK_POST_POSTS'			=> '锁定所选文章',
	'LOCK_POST_POSTS_CONFIRM'	=> '您确定要防止编辑所选文章?',
	'LOCK_TOPIC_CONFIRM'		=> '您确定要锁定这篇主题?',
	'LOCK_TOPICS'				=> '锁定所选主题',
	'LOCK_TOPICS_CONFIRM'		=> '您确定要锁定所选主题?',
	'LOGS_CURRENT_TOPIC'		=> '正在检视记录:',
	'LOGIN_EXPLAIN_MCP'			=> '登入后才可以管理版面.',
	'LOGVIEW_VIEWTOPIC'			=> '检视主题',
	'LOGVIEW_VIEWLOGS'			=> '检视主题记录',
	'LOGVIEW_VIEWFORUM'			=> '检视版面',
	'LOOKUP_ALL'				=> '查寻所有 IPs',
	'LOOKUP_IP'					=> '查寻 IP',

	'MARKED_NOTES_DELETED'		=> '移除全部有记号的用户记载事项成功',
	'MCP_ADD'						=> '增加警告',

	'MCP_BAN'					=> '禁止',
	'MCP_BAN_EMAILS'			=> '禁用的电子邮件信箱',
	'MCP_BAN_IPS'				=> '禁用的 IPs',
	'MCP_BAN_USERNAMES'			=> '禁用的用户名',

	'MCP_LOGS'						=> '版面管理员记录',
	'MCP_LOGS_FRONT'				=> '前页',
	'MCP_LOGS_FORUM_VIEW'			=> '版面记录',
	'MCP_LOGS_TOPIC_VIEW'			=> '主题记录',

	'MCP_MAIN'						=> '主页',
	'MCP_MAIN_FORUM_VIEW'			=> '检视版面',
	'MCP_MAIN_FRONT'				=> '前页',
	'MCP_MAIN_POST_DETAILS'			=> '发表细节',
	'MCP_MAIN_TOPIC_VIEW'			=> '检视主题',
	'MCP_MAKE_ANNOUNCEMENT'			=> '发布公告',
	'MCP_MAKE_ANNOUNCEMENT_CONFIRM'	=> '您确定要改变这篇主题是公告?',
	'MCP_MAKE_ANNOUNCEMENTS'		=> '发布公告',
	'MCP_MAKE_ANNOUNCEMENTS_CONFIRM'=> '您确定要改变所选主题是公告?',
	'MCP_MAKE_GLOBAL'				=> '发布全区公告',
	'MCP_MAKE_GLOBAL_CONFIRM'		=> '您确定要改变这篇主题是全区公告?',
	'MCP_MAKE_GLOBALS'				=> '发布全区公告',
	'MCP_MAKE_GLOBALS_CONFIRM'		=> '您确定要改变所选主题是全区公告?',
	'MCP_MAKE_STICKY'				=> '发布置顶',
	'MCP_MAKE_STICKY_CONFIRM'		=> '您确定要改变这篇主题是置顶?',
	'MCP_MAKE_STICKIES'				=> '发布置顶',
	'MCP_MAKE_STICKIES_CONFIRM'		=> '您确定要改变所选主题是置顶?',
	'MCP_MAKE_NORMAL'				=> '发布标准主题',
	'MCP_MAKE_NORMAL_CONFIRM'		=> '您确定要改变这篇主题是标准?',
	'MCP_MAKE_NORMALS'				=> '发布标准主题',
	'MCP_MAKE_NORMALS_CONFIRM'		=> '您确定要改变所选主题是标准?',

	'MCP_NOTES'						=> '用户记载事项',
	'MCP_NOTES_FRONT'				=> '前页',
	'MCP_NOTES_USER'				=> '用户细节',

	'MCP_REPORTS'					=> '检举文章',
	'MCP_REPORT_DETAILS'			=> '检举细节',
	'MCP_REPORTS_CLOSED'			=> '关闭检举',
	'MCP_REPORTS_CLOSED_EXPLAIN'	=> '表列相关文章已被处理的所有检举',
	'MCP_REPORTS_OPEN'				=> '开放检举',
	'MCP_REPORTS_OPEN_EXPLAIN'		=> '表列所有仍待处理的检举文章',

	'MCP_QUEUE'								=> '核准主题或文章',
	'MCP_QUEUE_APPROVE_DETAILS'				=> '核准细节',
	'MCP_QUEUE_UNAPPROVED_POSTS'			=> '正待核准的文章',
	'MCP_QUEUE_UNAPPROVED_POSTS_EXPLAIN'	=> '表列全部待核准的文章',
	'MCP_QUEUE_UNAPPROVED_TOPICS'			=> '正待核准的主题',
	'MCP_QUEUE_UNAPPROVED_TOPICS_EXPLAIN'	=> '表列全部待核准的主题',

	'MCP_VIEW_ALL'			=> '检视全部 (%s)',
	'MCP_VIEW_LOGS'			=> '检视记录',
	'MCP_VIEW_RECENT'		=> '检视最近 (%s)',
	'MCP_VIEW_USER'			=> '检视指定用户的警告',

	'MCP_WARN'				=> '警告',
	'MCP_WARN_FRONT'		=> '前页',
	'MCP_WARN_LIST'			=> '表列警告',
	'MCP_WARN_POST'			=> '给指定文章的警告',
	'MCP_WARN_USER'			=> '警告用户',

	'MERGE_POSTS'			=> '合并文章',
	'MERGE_POSTS_CONFIRM'	=> '您确定要合并所选文章?',
	'MERGE_TOPIC_EXPLAIN'	=> '利用底下表单您可以合并所选文章至另一主题. 这些文章不重新安排只当用户将之发表至新的主题才刊出.<br />请输入目标主题 id或单击"选择"钮找寻另一主题',
	'MERGE_TOPIC_ID'		=> '目标主题 id',
	'MOD_OPTIONS'			=> '管理选项',
	'MORE_INFO'				=> '更进一步的资讯',
	'MOST_WARNINGS'			=> '用户与最多的警告',
	'MOVE_TOPIC_CONFIRM'	=> '您确定要移除这篇主题至另一版面?',
	'MOVE_TOPICS'			=> '移除所选主题',
	'MOVE_TOPICS_CONFIRM'	=> '您确定要移除所选主题至另一版面?',

	'NOTIFY_POSTER_APPROVAL'=> '通知发言者核准原因?',
	'NOTIFY_POSTER_DISAPPROVAL' => '通知发言者不准原因?',
	'NOTIFY_USER_WARN'		=> '通知用户警告原因?',
	'NOT_MODERATOR'			=> '您不是这版面的管理员',
	'NO_DESTINATION_FORUM'	=> '请选择一个目地版面',
	'NO_ENTRIES'			=> '这一期间没有记录事项',
	'NO_FEEDBACK'			=> '这用户没有回覆的讯息',
	'NO_FINAL_TOPIC_SELECTED'	=> '您必须选择一个主题以合并文章',
	'NO_MATCHES_FOUND'		=> '找不到合适的',
	'NO_POST'				=> '您必须选择一篇文章以警告用户所表发的文章',
	'NO_POST_REPORT'		=> '这篇文章尚未被检举.',
	'NO_POST_SELECTED'		=> '您至少须选择一篇文章来执行这项作用',
	'NO_REASON_DISAPPROVAL'	=> '请给予一个不准的合适理由',
	'NO_TOPIC_SELECTED'		=> '您至少须选择一篇主题来执行这项作用',

	'OTHER_IPS'				=> '这位用户曾从其他 IP 位址发表文章',
	'ONLY_TOPIC'			=> '只有 "%s" 篇主题',
	'OTHER_USERS'			=> '用户正从此 IP 发表文章',

	'POSTER'				=> '发言者',
	'POSTS_APPROVED_SUCCESS'=> '所选文章已核准',
	'POSTS_DELETED_SUCCESS'	=> '所选文章已成功自资料库移除',
	'POSTS_DISAPPROVED_SUCCESS'=> '所选文章已不准',
	'POSTS_LOCKED_SUCCESS'	=> '所选文章已成功封锁',
	'POSTS_MERGED_SUCCESS'	=> '所选文章已完成合并',
	'POSTS_UNLOCKED_SUCCESS'=> '所选文章已成功解锁',
	'POSTS_PER_PAGE'		=> '每页发表文章数',
	'POSTS_PER_PAGE_EXPLAIN'=> '(设定 0 可检视全部文章)',
	'POST_APPROVED_SUCCESS'	=> '所选文章已核准',
	'POST_DELETED_SUCCESS'	=> '所选文章已成功自资料库移除',
	'POST_DISAPPROVED_SUCCESS'	=> '所选文章已不准',
	'POST_LOCKED_SUCCESS'	=> '成功锁定文章',
	'POST_NOT_EXIST'		=> '没有您请求的文章',
	'POST_REPORTED_SUCCESS'	=> '这篇文章被检举成功',
	'POST_UNLOCKED_SUCCESS'	=> '文章解锁成功',

	'READ_USERNOTES'		=> '用户记载事项',
	'READ_WARNINGS'			=> '用户警告',
	'REPORTER'				=> '检举人',
	'REPORTED'				=> '检举',
	'REPORTS_CLOSED_SUCCESS'	=> '所选检举完成封闭.',
	'REPORTS_DELETED_SUCCESS'	=> '移除所选检举成功.',
	'REPORTS_TOTAL'			=> '共 <strong>%d</strong> 篇检举待复审',
	'REPORTS_ZERO_TOTAL'	=> '没有检举待复审',
	'REPORT_CLOSED'			=> '这篇检举先前已封闭.',
	'REPORT_CLOSED_SUCCESS'	=> '所选检举封闭成功.',
	'REPORT_DELETED_SUCCESS'	=> '所选检举成功移除.',
	'REPORT_DETAILS'		=> '检举细节',
	'REPORT_MESSAGE'		=> '检举主旨',
	'REPORT_MESSAGE_EXPLAIN'=> '使用这个表单检举所选主旨给系统管理员. 只有当主旨违反版面规则才可使用检举.',
	'REPORT_NOTIFY'			=> '通知我',
	'REPORT_NOTIFY_EXPLAIN'	=> '通知您当您的检举已受理',
	'REPORT_POST_EXPLAIN'	=> '使用这个表单检举所选文章给版面管理员与系统管理员. 只有当文章违反版面规则才可使用检举.',
	'REPORT_REASON'			=> '检举的理由',
	'REPORT_TIME'			=> '检举时间',
	'REPORT_TOTAL'			=> '共 <strong>1</strong> 篇检举待复审',
	'RESYNC'				=> '重整对应资料',
	'RETURN_MESSAGE'		=> '%s返回主旨%s',
	'RETURN_NEW_FORUM'		=> '%s返回新版面%s',
	'RETURN_NEW_TOPIC'		=> '%s返回新主题%s',
	'RETURN_POST'			=> '%s返回文章%s',
	'RETURN_QUEUE'			=> '%s返回列表%s',
	'RETURN_REPORTS'		=> '%s返回检举%s',

	'SELECT_ACTION'			=> '选择想要的作用',
	'SELECT_TOPIC'			=> '选择主题',
	'SELECT_USER'			=> '选择用户',
	'SORT_ACTION'			=> '记录作用',
	'SORT_DATE'				=> '日期',
	'SORT_IP'				=> 'IP 位址',
	'SORT_WARNINGS'			=> '警告',
	'SPLIT_AFTER'			=> '分离所选文章',
	'SPLIT_FORUM'			=> '讨论新主题',
	'SPLIT_POSTS'			=> '分离所选文章',
	'SPLIT_SUBJECT'			=> '新主题标题',
	'SPLIT_TOPIC_ALL'		=> '由所选文章分离主题',
	'SPLIT_TOPIC_ALL_CONFIRM'	=> '您确定要分离这篇主题?',
	'SPLIT_TOPIC_BEYOND'	=> '在所选文章分离主题',
	'SPLIT_TOPIC_BEYOND_CONFIRM'	=> '您确定要在所选文章分离主题?',
	'SPLIT_TOPIC_EXPLAIN'	=> '使用底下表单您可以分离主题为二, 由选择每篇文章或由分离所选文章',

	'THIS_POST_IP'			=> '这篇文章的 IP',
	'TOPICS_APPROVED_SUCCESS'	=> '所选主题已核准',
	'TOPICS_DELETED_SUCCESS'=> '所选主题已成功自资料库移除',
	'TOPICS_DISAPPROVED_SUCCESS'	=> '所选主题已不准',
	'TOPICS_FORKED_SUCCESS'	=> '所选主题成功复制',
	'TOPICS_LOCKED_SUCCESS'	=> '所选主题成功锁定',
	'TOPICS_MOVED_SUCCESS'	=> '所选主题完成移动',
	'TOPICS_RESYNC_SUCCESS'	=> '所选主题已重整对应资料',
	'TOPICS_UNLOCKED_SUCCESS'	=> '所选主题已解锁',
	'TOPIC_APPROVED_SUCCESS'	=> '所选主题已核准',
	'TOPIC_DELETED_SUCCESS'	=> '所选主题已成功自资料库移除',
	'TOPIC_DISAPPROVED_SUCCESS'	=> '所选主题已不准',
	'TOPIC_FORKED_SUCCESS'	=> '所选主题成功复制',
	'TOPIC_LOCKED_SUCCESS'	=> '所选主题成功锁定',
	'TOPIC_MOVED_SUCCESS'	=> '所选主题完成移动',
	'TOPIC_NOT_EXIST'		=> '您所选主题不存在',
	'TOPIC_RESYNC_SUCCESS'	=> '所选主题已重整对应资料',
	'TOPIC_SPLIT_SUCCESS'	=> '所选主题完成分离',
	'TOPIC_TIME'			=> '主题发表时间',
	'TOPIC_TYPE_CHANGED'	=> '更改主题型式成功.',
	'TOPIC_UNLOCKED_SUCCESS'=> '所选主题已解锁',
	'TOTAL_WARNINGS'		=> '警告总计',

	'UNAPPROVED_POSTS_TOTAL'		=> '共 <strong>%d</strong> 篇文章待核准',
	'UNAPPROVED_POSTS_ZERO_TOTAL'	=> '没有文章待核准',
	'UNAPPROVED_POST_TOTAL'			=> '共 <strong>1</strong> 篇文章待核准',
	'UNLOCK'						=> '解锁',
	'UNLOCK_POST'					=> '文章解锁',
	'UNLOCK_POST_EXPLAIN'			=> '充许编辑',
	'UNLOCK_POST_POST'				=> '文章解锁',
	'UNLOCK_POST_POST_CONFIRM'		=> '您确定要充许编辑本篇文章?',
	'UNLOCK_POST_POSTS'				=> '解锁所选文章',
	'UNLOCK_POST_POSTS_CONFIRM'		=> '您确定要充许编辑本篇文章?',
	'UNLOCK_TOPIC'					=> '主题解锁',
	'UNLOCK_TOPIC_CONFIRM'			=> '您确定要解锁这篇主题?',
	'UNLOCK_TOPICS'					=> '解锁所选主题',
	'UNLOCK_TOPICS_CONFIRM'			=> '您确定要解锁全部所选主题?',
	'USER_CANNOT_POST'				=> '您不可以在这个版面发表文章',
	'USER_CANNOT_REPORT'			=> '您不可以在这个版面检举文章',
	'USER_FEEDBACK_ADDED'			=> '成功增加用户回馈讯息',
	'USER_WARNING_ADDED'			=> '警告用户成功',

	'VIEW_DETAILS'			=> '检视细节',

	'WARNED_USERS'			=> '警告用户',
	'WARNED_USERS_EXPLAIN'	=> '发布未到期警告至用户的列表',
	'WARNING_PM_BODY'		=> '底下的警告由您(网站的系统管理员或版面管理员)所发布.[quote]%s[/quote]',
	'WARNING_PM_SUBJECT'	=> '发布系统警告',
	'WARNINGS_ZERO_TOTAL'	=> '没有警告',

	'YOU_SELECTED_TOPIC'	=> '您选择的主题数字 %d: %s',

	'report_reasons'		=> array(
		'TITLE'	=> array(
			'WAREZ'		=> '商品',
			'SPAM'		=> '加工产品',
			'OFF_TOPIC'	=> '偏离的主题',
			'OTHER'		=> '其他'
		),
		'DESCRIPTION' => array(
			'WAREZ'		=> '文章包含连结至非法或侵权的软体',
			'SPAM'		=> '检举文章只有宣传网站或产品目的',
			'OFF_TOPIC'	=> '检举文章偏离主题',
			'OTHER'		=> '检举文章不适合放置于任何类别, 请利用叙述栏位'
		)
	),
));

?>