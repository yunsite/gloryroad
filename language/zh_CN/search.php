<?php
/** 
*
* search [中文] :: CRLin - http://web.dhjh.tcc.edu.tw/~gzqbyr/styles/
*
* @package language
* @version $Id: search.php,v 1.9 2006/05/30 16:50:06 acydburn Exp $
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
	'ALL_AVAILABLE'			=> '所有的',
	'ALL_RESULTS'			=> '所有文章',

	'DISPLAY_RESULTS'		=> '显示模式',

	'FOUND_SEARCH_MATCH'	=> '有 %d 笔资料符合您搜寻的条件',
	'FOUND_SEARCH_MATCHES'	=> '有 %d 笔资料符合您搜寻的条件',
	'FOUND_MORE_SEARCH_MATCHES'	=> '多于 %d 笔资料符合您搜寻的条件',

	'GLOBAL'				=> '全区公告',

	'IGNORED_TERMS'			=> '忽略',
	'IGNORED_TERMS_EXPLAIN'	=> '底下文字于您文章搜寻时忽略: <b>%s</b>',

	'NO_KEYWORDS'			=> '您至少须指定一个文字以利搜寻. 每一个文字至少须 %d 个字元且不可超过 %d 个字元万用字元除外.',
	'NO_RECENT_SEARCHES'	=> '最近没有执行文章搜寻',
	'NO_SEARCH'				=> '抱歉您不允许使用搜寻系统.',
	'NO_SEARCH_RESULTS'		=> '没有相关主题或文章符合您要搜寻的条件.',
	'NO_SEARCH_TIME'		=> '抱歉您不可以在此时使用搜寻系统. 请几分钟后再试.',

	'POST_CHARACTERS'		=> '笔资料',

	'RECENT_SEARCHES'		=> '最近的搜寻结果',
	'RESULT_DAYS'			=> '时间范围',
	'RESULT_SORT'			=> '排列顺序',
	'RETURN_FIRST'			=> '搜寻结果显示',

	'SEARCHED_FOR'			=> '使用搜寻关键字',
	'SEARCHED_TOPIC'		=> '搜寻主题',
	'SEARCH_ALL_TERMS'		=> '搜寻符合以上所有关键字的资料',
	'SEARCH_ANY_TERMS'		=> '搜寻符合任一所有关键字的资料',
	'SEARCH_AUTHOR'			=> '搜寻发表人',
	'SEARCH_AUTHOR_EXPLAIN'	=> '您可以使用 * 万用字元搜寻',
	'SEARCH_FIRST_POST'		=> '只搜寻主题的第1篇文章',
	'SEARCH_FORUMS'			=> '搜寻于版面',
	'SEARCH_FORUMS_EXPLAIN'	=> '选择您要搜寻的版面. 可选取多个版面并于底下搜寻子版面功能中设定是, 即可快速搜寻.',
	'SEARCH_IN_RESULTS'		=> '搜寻的结果',
	'SEARCH_KEYWORDS_EXPLAIN'	=> '将 <strong>+</strong> 置于欲搜寻的文字之前并将 <strong>-</strong> 置于不要搜寻的文字之前. 如果您将 <strong>|</strong> 置于文字之前, 则每一搜寻结果必须至少包含这些文字的其中一个. 可以使用 * 万用字元搜寻',
	'SEARCH_MSG_ONLY'		=> '只搜寻文章内容',
	'SEARCH_OPTIONS'		=> '搜寻选项',
	'SEARCH_QUERY'			=> '文章搜寻系统',
	'SEARCH_SUBFORUMS'		=> '搜寻子版面',
	'SEARCH_TITLE_MSG'		=> '搜寻文章主题及内容',
	'SEARCH_TITLE_ONLY'		=> '只搜寻文章主题',
	'SEARCH_WITHIN'			=> '搜寻范围',
	'SORT_ASCENDING'		=> '依序递增',
	'SORT_AUTHOR'			=> '作者',
	'SORT_DESCENDING'		=> '依序递减',
	'SORT_FORUM'			=> '版面',
	'SORT_POST_SUBJECT'		=> '主题',
	'SORT_TIME'				=> '时间',

	'TOO_FEW_AUTHOR_CHARS'	=> '您至少须指定作者名的 %d 个字元.',
));

?>