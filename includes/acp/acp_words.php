<?php
/** 
*
* @package acp
* @version $Id: acp_words.php,v 1.8 2006/06/13 21:06:27 acydburn Exp $
* @copyright (c) 2005 phpBB Group 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* @todo [words] check regular expressions for special char replacements (stored specialchared in db)
* @package acp
*/
class acp_words
{
	var $u_action;
	
	function main($id, $mode)
	{
		global $db, $user, $auth, $template, $cache;
		global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx;

		$user->add_lang('acp/posting');

		// Set up general vars
		$action = request_var('action', '');
		$action = (isset($_POST['add'])) ? 'add' : ((isset($_POST['save'])) ? 'save' : $action);

		$s_hidden_fields = '';
		$word_info = array();

		$this->tpl_name = 'acp_words';
		$this->page_title = 'ACP_WORDS';

		switch ($action)
		{
			case 'edit':
				$word_id = request_var('id', 0);
				
				if (!$word_id)
				{
					trigger_error($user->lang['NO_WORD'] . adm_back_link($this->u_action));
				}

				$sql = 'SELECT *
					FROM ' . WORDS_TABLE . "
					WHERE word_id = $word_id";
				$result = $db->sql_query($sql);
				$word_info = $db->sql_fetchrow($result);
				$db->sql_freeresult($result);

				$s_hidden_fields .= '<input type="hidden" name="id" value="' . $word_id . '" />';

			case 'add':

				$template->assign_vars(array(
					'S_EDIT_WORD'		=> true,
					'U_ACTION'			=> $this->u_action,
					'U_BACK'			=> $this->u_action,
					'WORD'				=> (isset($word_info['word'])) ? $word_info['word'] : '',
					'REPLACEMENT'		=> (isset($word_info['replacement'])) ? $word_info['replacement'] : '',
					'S_HIDDEN_FIELDS'	=> $s_hidden_fields)
				);
				
				return;

			break;

			case 'save':
				$word_id = request_var('id', 0);
				$word = request_var('word', '', true);
				$replacement = request_var('replacement', '', true);

				if (!$word || !$replacement)
				{
					trigger_error($user->lang['ENTER_WORD'] . adm_back_link($this->u_action));
				}

				$sql_ary = array(
					'word'			=> $word,
					'replacement'	=> $replacement
				);
				
				if ($word_id)
				{
					$db->sql_query('UPDATE ' . WORDS_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . ' WHERE word_id = ' . $word_id);
				}
				else
				{
					$db->sql_query('INSERT INTO ' . WORDS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary));
				}

				$cache->destroy('word_censors');

				$log_action = ($word_id) ? 'LOG_WORD_EDIT' : 'LOG_WORD_ADD';
				add_log('admin', $log_action, $word);

				$message = ($word_id) ? $user->lang['WORD_UPDATED'] : $user->lang['WORD_ADDED'];
				trigger_error($message . adm_back_link($this->u_action));

			break;

			case 'delete':

				$word_id = request_var('id', 0);

				if (!$word_id)
				{
					trigger_error($user->lang['NO_WORD'] . adm_back_link($this->u_action));
				}

				$sql = 'SELECT word
					FROM ' . WORDS_TABLE . "
					WHERE word_id = $word_id";
				$result = $db->sql_query($sql);
				$deleted_word = $db->sql_fetchfield('word');
				$db->sql_freeresult($result);

				$sql = 'DELETE FROM ' . WORDS_TABLE . "
					WHERE word_id = $word_id";
				$db->sql_query($sql);

				$cache->destroy('word_censors');

				add_log('admin', 'LOG_WORD_DELETE', $deleted_word);

				trigger_error($user->lang['WORD_REMOVED'] . adm_back_link($this->u_action));
				
			break;
		}


		$template->assign_vars(array(
			'U_ACTION'			=> $this->u_action,
			'S_HIDDEN_FIELDS'	=> $s_hidden_fields)
		);

		$sql = 'SELECT *
			FROM ' . WORDS_TABLE . '
			ORDER BY word';
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			$template->assign_block_vars('words', array(
				'WORD'			=> $row['word'],
				'REPLACEMENT'	=> $row['replacement'],
				'U_EDIT'		=> $this->u_action . '&amp;action=edit&amp;id=' . $row['word_id'],
				'U_DELETE'		=> $this->u_action . '&amp;action=delete&amp;id=' . $row['word_id'])
			);
		}
		$db->sql_freeresult($result);
	}
}

?>