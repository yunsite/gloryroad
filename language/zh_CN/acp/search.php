<?php
/** 
*
* acp_search [中文] :: CRLin - http://web.dhjh.tcc.edu.tw/~gzqbyr/styles/
*
* @package language
* @version $Id: search.php,v 1.5 2006/06/16 18:31:51 naderman Exp $
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
	'ACP_SEARCH_INDEX_EXPLAIN'				=> 'Here you can manage the search backend\'s indexes. Since you normally use only one backend you should delete all indexes that you do not make use of. After altering some of the search settings (e.g. the number of minimum/maximum chars) it might be worth recreating the index so it reflects those changes.',
	'ACP_SEARCH_SETTINGS_EXPLAIN'			=> 'Here you can define what search backend will be used for indexing posts and performing searches. You can set various options that can influence how much processing these actions require. Some of these settings are the same for all search engine backends.',

	'CONFIRM_SEARCH_BACKEND'				=> 'Are you sure you wish to switch to a different search backend? After changing the search backend you will have to create an index for the new search backend. If you don\'t plan on switching back to the old search backend you can also delete the old backend\'s index in order to free system resources.',
	'CONTINUE_DELETING_INDEX'				=> 'Continue previous index deleting process',
	'CONTINUE_DELETING_INDEX_EXPLAIN'		=> 'An index deleting process has been started. In order to access the search index page again you need to complete it first.',
	'CONTINUE_INDEXING'						=> 'Continue previous indexing process',
	'CONTINUE_INDEXING_EXPLAIN'				=> 'An indexing process has been started. In order to access the search index page again you need to complete it first.',
	'CREATE_INDEX'							=> 'Create Index',

	'DELETE_INDEX'							=> 'Delete Index',
	'DELETING_INDEX_IN_PROGRESS'			=> 'Deleting the index in progress',
	'DELETING_INDEX_IN_PROGRESS_EXPLAIN'	=> 'The search backend is currently cleaning its index. This can take a few minutes.',

	'FULLTEXT_MYSQL_INCOMPATIBLE_VERSION'	=> 'The MySQL fulltext backend can only be used with MySQL4 and above.',
	'FULLTEXT_MYSQL_NOT_MYISAM'				=> 'MySQL fulltext indexes can only be used with MyISAM tables.',
	'FULLTEXT_MYSQL_SUBJECT_CARDINALITY'	=> 'Cardinality of the post_subject fulltext index (estimate of unique values)',
	'FULLTEXT_MYSQL_TEXT_CARDINALITY'		=> 'Cardinality of the post_text fulltext index (estimate of unique values)',
	'FULLTEXT_MYSQL_TOTAL_POSTS'			=> 'Total number of indexed posts',

	'GENERAL_SEARCH_SETTINGS'				=> 'General Search Settings',
	'GO_TO_SEARCH_INDEX'					=> 'Go to search index page',

	'INDEX_STATS'							=> 'Index Statistics',
	'INDEXING_IN_PROGRESS'					=> 'Indexing in progress',
	'INDEXING_IN_PROGRESS_EXPLAIN'			=> 'The search backend is currently indexing all posts on the board. This can take from a few minutes to a few hours depending on your board\'s size.',

	'LIMIT_SEARCH_LOAD'						=> 'Search page system load limit',
	'LIMIT_SEARCH_LOAD_EXPLAIN'				=> 'If the 1 minute system load exceeds this value the search page will go offline, 1.0 equals ~100% utilisation of one processor. This only functions on UNIX based servers.',

	'MAX_SEARCH_CHARS'						=> 'Max characters indexed by search',
	'MAX_SEARCH_CHARS_EXPLAIN'				=> 'Words with no more than this many characters will be indexed for searching.',
	'MIN_SEARCH_CHARS'						=> 'Min characters indexed by search',
	'MIN_SEARCH_CHARS_EXPLAIN'				=> 'Words with at least this many characters will be indexed for searching.',
	'MIN_SEARCH_AUTHOR_CHARS'				=> 'Min author name characters',
	'MIN_SEARCH_AUTHOR_CHARS_EXPLAIN'		=> 'Users have to enter at least this many characters of the name when performing a wildcard author search. If the author\'s username is shorter than this number you can still search for the author\'s posts by entering the complete username.',

	'PROGRESS_BAR'							=> 'Progress bar',

	'SEARCH_GUEST_INTERVAL'					=> 'Guest search flood interval',
	'SEARCH_GUEST_INTERVAL_EXPLAIN'			=> 'Number of seconds guests must wait between searches. If one guest searches all others have to wait until the time interval passed.',
	'SEARCH_INDEX_CREATED'					=> 'Successfully indexed all posts in the board database',
	'SEARCH_INDEX_REMOVED'					=> 'Successfully deleted the search index for this backend',
	'SEARCH_INTERVAL'						=> 'User search flood interval',
	'SEARCH_INTERVAL_EXPLAIN'				=> 'Number of seconds users must wait between searches. This interval is checked independendly for each user.',
	'SEARCH_STORE_RESULTS'					=> 'Search result cache length',
	'SEARCH_STORE_RESULTS_EXPLAIN'			=> 'Cached search results will expire after this time, in seconds. Set to 0 if you want to disable search cache.',
	'SEARCH_TYPE'							=> 'Search Backend',
	'SEARCH_TYPE_EXPLAIN'					=> 'phpBB allows you to choose the backend that is used for searching text in post contents. By default the search  will use phpBB\'s own fulltext search.',
	'SWITCHED_SEARCH_BACKEND'				=> 'You switched the search backend. In order to use the new search backend you should make sure that there is an index for the backend you chose.',

	'TOTAL_WORDS'							=> 'Total number of indexed words',
	'TOTAL_MATCHES'							=> 'Total number of word to post relations indexed',

	'YES_SEARCH'							=> 'Enable search facilities',
	'YES_SEARCH_EXPLAIN'					=> 'Enables user facing search functionality including member search.',
	'YES_SEARCH_UPDATE'						=> 'Enable fulltext updating',
	'YES_SEARCH_UPDATE_EXPLAIN'				=> 'Updating of fulltext indexes when posting, overriden if search is disabled.',
));

?>