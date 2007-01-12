<?php
/** 
*
* @package acp
* @version $Id: acp_bbcodes.php,v 1.12 2006/06/17 06:50:58 davidmj Exp $
* @copyright (c) 2005 phpBB Group 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* @package acp
*/
class acp_bbcodes
{
	var $u_action;

	function main($id, $mode)
	{
		global $db, $user, $auth, $template, $cache;
		global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx;

		$user->add_lang('acp/posting');

		// Set up general vars
		$action	= request_var('action', '');
		$bbcode_id = request_var('bbcode', 0);

		$this->tpl_name = 'acp_bbcodes';
		$this->page_title = 'ACP_BBCODES';

		// Set up mode-specific vars
		switch ($action)
		{
			case 'add':
				$bbcode_match = $bbcode_tpl = '';
				$display_on_posting = 0;
			break;

			case 'edit':
				$sql = 'SELECT bbcode_match, bbcode_tpl, display_on_posting
					FROM ' . BBCODES_TABLE . '
					WHERE bbcode_id = ' . $bbcode_id;
				$result = $db->sql_query($sql);
				$row = $db->sql_fetchrow($result);
				$db->sql_freeresult($result);

				if (!$row)
				{
					trigger_error('BBCODE_NOT_EXIST');
				}

				$bbcode_match = $row['bbcode_match'];
				$bbcode_tpl = htmlspecialchars($row['bbcode_tpl']);
				$display_on_posting = $row['display_on_posting'];
			break;

			case 'modify':
				$sql = 'SELECT bbcode_id, bbcode_tag
					FROM ' . BBCODES_TABLE . '
					WHERE bbcode_id = ' . $bbcode_id;
				$result = $db->sql_query($sql);
				$row = $db->sql_fetchrow($result);
				$db->sql_freeresult($result);

				if (!$row)
				{
					trigger_error('BBCODE_NOT_EXIST');
				}

			// No break here

			case 'create':
				$display_on_posting = request_var('display_on_posting', 0);

				$bbcode_match = request_var('bbcode_match', '');
				$bbcode_tpl = html_entity_decode(request_var('bbcode_tpl', ''));
			break;
		}

		// Do major work
		switch ($action)
		{
			case 'edit':
			case 'add':

				$template->assign_vars(array(
					'S_EDIT_BBCODE'		=> true,
					'U_BACK'			=> $this->u_action,
					'U_ACTION'			=> $this->u_action . '&amp;action=' . (($action == 'add') ? 'create' : 'modify') . (($bbcode_id) ? "&amp;bbcode=$bbcode_id" : ''),

					'BBCODE_MATCH'			=> $bbcode_match,
					'BBCODE_TPL'			=> $bbcode_tpl,
					'DISPLAY_ON_POSTING'	=> $display_on_posting)
				);

				foreach ($user->lang['tokens'] as $token => $token_explain)
				{
					$template->assign_block_vars('token', array(
						'TOKEN'		=> '{' . $token . '}',
						'EXPLAIN'	=> $token_explain)
					);
				}

				return;

			break;

			case 'modify':
			case 'create':

				$data = $this->build_regexp($bbcode_match, $bbcode_tpl);

				// Make sure the user didn't pick a "bad" name for the BBCode tag.
				$hard_coded = array('code', 'quote', 'quote=', 'attachment', 'attachment=', 'b', 'i', 'url', 'url=', 'img', 'size', 'size=', 'color', 'color=', 'u', 'list', 'list=', 'email', 'email=', 'flash', 'flash=');

				if (($action == 'modify' && $data['bbcode_tag'] !== $row['bbcode_tag']) || ($action == 'create'))
				{
					$sql = 'SELECT 1 as test
						FROM ' . BBCODES_TABLE . "
						WHERE LOWER(bbcode_tag) = '" . $db->sql_escape(strtolower($data['bbcode_tag'])) . "'";
					$result = $db->sql_query($sql);
					$info = $db->sql_fetchrow($result);
					$db->sql_freeresult($result);

					if ($info['test'] === '1' || in_array(strtolower($data['bbcode_tag']), $hard_coded))
					{
						trigger_error('BBCODE_INVALID_TAG_NAME');
					}
				}

				$sql_ary = array(
					'bbcode_tag'				=> $data['bbcode_tag'],
					'bbcode_match'				=> $bbcode_match,
					'bbcode_tpl'				=> $bbcode_tpl,
					'display_on_posting'		=> $display_on_posting,
					'first_pass_match'			=> $data['first_pass_match'],
					'first_pass_replace'		=> $data['first_pass_replace'],
					'second_pass_match'			=> $data['second_pass_match'],
					'second_pass_replace'		=> $data['second_pass_replace']
				);

				if ($action == 'create')
				{
					$sql = 'SELECT MAX(bbcode_id) as max_bbcode_id
						FROM ' . BBCODES_TABLE;
					$result = $db->sql_query($sql);
					$row = $db->sql_fetchrow($result);
					$db->sql_freeresult($result);

					if ($row)
					{
						$bbcode_id = $row['max_bbcode_id'] + 1;

						// Make sure it is greater than the core bbcode ids...
						if ($bbcode_id <= NUM_CORE_BBCODES)
						{
							$bbcode_id = NUM_CORE_BBCODES + 1;
						}
					}
					else
					{
						$bbcode_id = NUM_CORE_BBCODES + 1;
					}

					if ($bbcode_id > 31)
					{
						trigger_error('TOO_MANY_BBCODES');
					}

					$sql_ary['bbcode_id'] = (int) $bbcode_id;

					$db->sql_query('INSERT INTO ' . BBCODES_TABLE . $db->sql_build_array('INSERT', $sql_ary));

					$lang = 'BBCODE_ADDED';
					$log_action = 'LOG_BBCODE_ADD';
				}
				else
				{
					$sql = 'UPDATE ' . BBCODES_TABLE . '
						SET ' . $db->sql_build_array('UPDATE', $sql_ary) . '
						WHERE bbcode_id = ' . $bbcode_id;
					$db->sql_query($sql);

					$lang = 'BBCODE_EDITED';
					$log_action = 'LOG_BBCODE_EDIT';
				}

				add_log('admin', $log_action, $data['bbcode_tag']);

				trigger_error($user->lang[$lang] . adm_back_link($this->u_action));

			break;

			case 'delete':

				$sql = 'SELECT bbcode_tag
					FROM ' . BBCODES_TABLE . "
					WHERE bbcode_id = $bbcode_id";
				$result = $db->sql_query($sql);
				$row = $db->sql_fetchrow($result);
				$db->sql_freeresult($result);

				if ($row)
				{
					$db->sql_query('DELETE FROM ' . BBCODES_TABLE . " WHERE bbcode_id = $bbcode_id");
					add_log('admin', 'LOG_BBCODE_DELETE', $row['bbcode_tag']);
				}

			break;
		}

		$template->assign_vars(array(
			'U_ACTION'		=> $this->u_action . '&amp;action=add')
		);

		$sql = 'SELECT *
			FROM ' . BBCODES_TABLE . '
			ORDER BY bbcode_id';
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			$template->assign_block_vars('bbcodes', array(
				'BBCODE_TAG'		=> $row['bbcode_tag'],
				'U_EDIT'			=> $this->u_action . '&amp;action=edit&amp;bbcode=' . $row['bbcode_id'],
				'U_DELETE'			=> $this->u_action . '&amp;action=delete&amp;bbcode=' . $row['bbcode_id'])
			);
		}
		$db->sql_freeresult($result);
	}

	/*
	* Build regular expression for custom bbcode
	*/
	function build_regexp(&$bbcode_match, &$bbcode_tpl)
	{
		$bbcode_match = trim($bbcode_match);
		$bbcode_tpl = trim($bbcode_tpl);

		$fp_match = preg_quote($bbcode_match, '!');
		$fp_replace = preg_replace('#^\[(.*?)\]#', '[$1:$uid]', $bbcode_match);
		$fp_replace = preg_replace('#\[/(.*?)\]$#', '[/$1:$uid]', $fp_replace);

		$sp_match = preg_quote($bbcode_match, '!');
		$sp_match = preg_replace('#^\\\\\[(.*?)\\\\\]#', '\[$1:$uid\]', $sp_match);
		$sp_match = preg_replace('#\\\\\[/(.*?)\\\\\]$#', '\[/$1:$uid\]', $sp_match);
		$sp_replace = $bbcode_tpl;

		// @todo Make sure to change this too if something changed in message parsing
		$tokens = array(
			'URL'	 => array(
				'!([a-z0-9]+://)?([^?].*?[^ \t\n\r<"]*)!ie'	=>	"(('\$1') ? '\$1\$2' : 'http://\$2')"
			),
			'LOCAL_URL'	 => array(
				'!([^:]+/[^ \t\n\r<"]*)!'	=>	'$1'
			),
			'EMAIL' => array(
				'!([a-z0-9]+[a-z0-9\-\._]*@(?:(?:[0-9]{1,3}\.){3,5}[0-9]{1,3}|[a-z0-9]+[a-z0-9\-\._]*\.[a-z]+))!i'	=>	'$1'
			),
			'TEXT' => array(
				'!(.*?)!es'	 =>	"str_replace(\"\\r\\n\",\"\\n\", str_replace('\\\"', '\"', str_replace('\\'', '&#39;', trim('\$1'))))"
			),
			'COLOR' => array(
				'!([a-z]+|#[0-9abcdef]+)!i'	=>	'$1'
			),
			'NUMBER' => array(
				'!([0-9]+)!'	=>	'$1'
			)
		);

		$pad = 0;
		$modifiers = 'i';

		if (preg_match_all('/\{(' . implode('|', array_keys($tokens)) . ')[0-9]*\}/i', $bbcode_match, $m))
		{
			foreach ($m[0] as $n => $token)
			{
				$token_type = $m[1][$n];

				reset($tokens[$token_type]);
				list($match, $replace) = each($tokens[$token_type]);

				// Pad backreference numbers from tokens
				if (preg_match_all('/(?<!\\\\)\$([0-9]+)/', $replace, $repad))
				{
					$repad = $pad + sizeof(array_unique($repad[0]));
					$replace = preg_replace('/(?<!\\\\)\$([0-9]+)/e', "'\$' . (\$1 + \$pad)", $replace);
					$pad = $repad;
				}

				// Obtain pattern modifiers to use and alter the regex accordingly
				$regex = preg_replace('/!(.*)!([a-z]*)/', '$1', $match);
				$regex_modifiers = preg_replace('/!(.*)!([a-z]*)/', '$2', $match);

				for ($i = 0, $size = strlen($regex_modifiers); $i < $size; ++$i)
				{
					if (strpos($modifiers, $regex_modifiers[$i]) === false)
					{
						$modifiers .= $regex_modifiers[$i];

						if ($regex_modifiers[$i] == 'e')
						{
							$fp_replace = "'" . str_replace("'", "\\'", $fp_replace) . "'";
						}
					}

					if ($regex_modifiers[$i] == 'e')
					{
						$replace = "'.$replace.'";
					}
				}

				$fp_match = str_replace(preg_quote($token, '!'), $regex, $fp_match);
				$fp_replace = str_replace($token, $replace, $fp_replace);

				$sp_match = str_replace(preg_quote($token, '!'), '(.*?)', $sp_match);
				$sp_replace = str_replace($token, '$' . ($n + 1), $sp_replace);
			}

			$fp_match = '!' . $fp_match . '!' . $modifiers;
			$sp_match = '!' . $sp_match . '!s';

			if (strpos($fp_match, 'e') !== false)
			{
				$fp_replace = str_replace("'.'", '', $fp_replace);
				$fp_replace = str_replace(".''.", '.', $fp_replace);
			}
		}
		else
		{
			// No replacement is present, no need for a second-pass pattern replacement
			// A simple str_replace will suffice
			$fp_match = '!' . $fp_match . '!' . $modifiers;
			$sp_match = $fp_replace;
			$sp_replace = '';
		}

		// Lowercase tags
		$bbcode_tag = preg_replace('/.*?\[([a-z]+=?).*/i', '$1', $bbcode_match);
		$fp_match = preg_replace('#\[/?' . $bbcode_tag . '#ie', "strtolower('\$0')", $fp_match);
		$fp_replace = preg_replace('#\[/?' . $bbcode_tag . '#ie', "strtolower('\$0')", $fp_replace);
		$sp_match = preg_replace('#\[/?' . $bbcode_tag . '#ie', "strtolower('\$0')", $sp_match);
		$sp_replace = preg_replace('#\[/?' . $bbcode_tag . '#ie', "strtolower('\$0')", $sp_replace);

		return array(
			'bbcode_tag'				=> $bbcode_tag,
			'first_pass_match'			=> $fp_match,
			'first_pass_replace'		=> $fp_replace,
			'second_pass_match'			=> $sp_match,
			'second_pass_replace'		=> $sp_replace
		);
	}
}

?>