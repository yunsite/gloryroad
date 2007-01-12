<?php
/** 
*
* @package ucp
* @version $Id: ucp_profile.php,v 1.72 2006/06/16 16:54:41 acydburn Exp $
* @copyright (c) 2005 phpBB Group 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* ucp_profile
* Changing profile settings
* @package ucp
*/
class ucp_profile
{
	var $u_action;

	function main($id, $mode)
	{
		global $config, $db, $user, $auth, $template, $phpbb_root_path, $phpEx;

		$user->add_lang('posting');

		$preview	= (!empty($_POST['preview'])) ? true : false;
		$submit		= (!empty($_POST['submit'])) ? true : false;
		$delete		= (!empty($_POST['delete'])) ? true : false;
		$error = $data = array();
		$s_hidden_fields = '';

		switch ($mode)
		{
			case 'reg_details':

				if ($submit)
				{
					$var_ary = array(
						'username'			=> $user->data['username'],
						'email'				=> $user->data['user_email'],
						'email_confirm'		=> (string) '',
						'new_password'		=> (string) '',
						'cur_password'		=> (string) '',
						'password_confirm'	=> (string) '',
					);

					foreach ($var_ary as $var => $default)
					{
						$data[$var] = request_var($var, $default);
					}

					$var_ary = array(
						'password_confirm'	=> array('string', true, $config['min_pass_chars'], $config['max_pass_chars']),
						'new_password'		=> array('string', true, $config['min_pass_chars'], $config['max_pass_chars']),
						'cur_password'		=> array('string', true, $config['min_pass_chars'], $config['max_pass_chars']),
						'email'				=> array(
							array('string', false, 6, 60),
							array('email', $data['email'])),
						'email_confirm'		=> array('string', true, 6, 60),
					);

					if ($auth->acl_get('u_chgname') && $config['allow_namechange'])
					{
						$var_ary['username'] = array(
							array('string', false, $config['min_name_chars'], $config['max_name_chars']),
							array('username', $data['username']),
						);
					}

					$error = validate_data($data, $var_ary);
					extract($data);
					unset($data);

					if ($auth->acl_get('u_chgpasswd') && $new_password && $password_confirm != $new_password)
					{
						$error[] = 'NEW_PASSWORD_ERROR';
					}

					if (($new_password || ($auth->acl_get('u_chgemail') && $email != $user->data['user_email']) || ($username != $user->data['username'] && $auth->acl_get('u_chgname') && $config['allow_namechange'])) && md5($cur_password) != $user->data['user_password'])
					{
						$error[] = 'CUR_PASSWORD_ERROR';
					}

					if ($auth->acl_get('u_chgemail') && $email != $user->data['user_email'] && $email_confirm != $email)
					{
						$error[] = 'NEW_EMAIL_ERROR';
					}

					if (!sizeof($error))
					{
						$sql_ary = array(
							'username'			=> ($auth->acl_get('u_chgname') && $config['allow_namechange']) ? $username : $user->data['username'],
							'user_email'		=> ($auth->acl_get('u_chgemail')) ? $email : $user->data['user_email'],
							'user_email_hash'	=> ($auth->acl_get('u_chgemail')) ? crc32(strtolower($email)) . strlen($email) : $user->data['user_email_hash'],
							'user_password'		=> ($auth->acl_get('u_chgpasswd') && $new_password) ? md5($new_password) : $user->data['user_password'],
							'user_passchg'		=> ($auth->acl_get('u_chgpasswd') && $new_password) ? time() : 0,
						);

						if ($auth->acl_get('u_chgname') && $config['allow_namechange'] && $username != $user->data['username'])
						{
							add_log('user', $user->data['user_id'], 'LOG_USER_UPDATE_NAME', $user->data['username'], $username);
						}

						if ($auth->acl_get('u_chgpasswd') && $new_password && md5($new_password) != $user->data['user_password'])
						{
							$user->reset_login_keys();
							add_log('user', $user->data['user_id'], 'LOG_USER_NEW_PASSWORD', $username);
						}

						if ($auth->acl_get('u_chgemail') && $email != $user->data['user_email'])
						{
							add_log('user', $user->data['user_id'], 'LOG_USER_UPDATE_EMAIL', $username, $user->data['user_email'], $email);
						}

						if ($config['email_enable'] && $email != $user->data['user_email'] && ($config['require_activation'] == USER_ACTIVATION_SELF || $config['require_activation'] == USER_ACTIVATION_ADMIN))
						{
							include_once($phpbb_root_path . 'includes/functions_messenger.'.$phpEx);

							$server_url = generate_board_url();

							$user_actkey = gen_rand_string(10);
							$key_len = 54 - (strlen($server_url));
							$key_len = ($key_len > 6) ? $key_len : 6;
							$user_actkey = substr($user_actkey, 0, $key_len);

							$messenger = new messenger();

							$template_file = ($config['require_activation'] == USER_ACTIVATION_ADMIN) ? 'user_activate_inactive' : 'user_activate';
							$messenger->template($template_file, $user->data['user_lang']);

							$messenger->replyto($config['board_contact']);
							$messenger->to($email, $username);

							$messenger->headers('X-AntiAbuse: Board servername - ' . $config['server_name']);
							$messenger->headers('X-AntiAbuse: User_id - ' . $user->data['user_id']);
							$messenger->headers('X-AntiAbuse: Username - ' . $user->data['username']);
							$messenger->headers('X-AntiAbuse: User IP - ' . $user->ip);

							$messenger->assign_vars(array(
								'SITENAME'		=> $config['sitename'],
								'USERNAME'		=> html_entity_decode($username),
								'EMAIL_SIG'		=> str_replace('<br />', "\n", "-- \n" . $config['board_email_sig']),

								'U_ACTIVATE'	=> "$server_url/ucp.$phpEx?mode=activate&u={$user->data['user_id']}&k=$user_actkey")
							);

							$messenger->send(NOTIFY_EMAIL);

							if ($config['require_activation'] == USER_ACTIVATION_ADMIN)
							{
								// Grab an array of user_id's with a_user permissions
								$admin_ary = $auth->acl_get_list(false, 'a_user', false);

								$sql = 'SELECT user_id, username, user_email, user_lang, user_jabber, user_notify_type
									FROM ' . USERS_TABLE . '
									WHERE user_id IN (' . implode(', ', $admin_ary[0]['a_user']) .')';
								$result = $db->sql_query($sql);

								while ($row = $db->sql_fetchrow($result))
								{
									$messenger->template('admin_activate', $row['user_lang']);
									$messenger->replyto($config['board_contact']);
									$messenger->to($row['user_email'], $row['username']);
									$messenger->im($row['user_jabber'], $row['username']);

									$messenger->assign_vars(array(
										'USERNAME'		=> html_entity_decode($username),
										'EMAIL_SIG'		=> str_replace('<br />', "\n", "-- \n" . $config['board_email_sig']),

										'U_ACTIVATE'	=> "$server_url/ucp.$phpEx?mode=activate&u={$user->data['user_id']}&k=$user_actkey")
									);

									$messenger->send($row['user_notify_type']);
								}
								$db->sql_freeresult($result);
							}

							$messenger->save_queue();

							$sql_ary += array(
								'user_type'		=> USER_INACTIVE,
								'user_actkey'	=> $user_actkey
							);
						}

						if (sizeof($sql_ary))
						{
							$sql = 'UPDATE ' . USERS_TABLE . '
								SET ' . $db->sql_build_array('UPDATE', $sql_ary) . '
								WHERE user_id = ' . $user->data['user_id'];
							$db->sql_query($sql);
						}

						// Need to update config, forum, topic, posting, messages, etc.
						if ($username != $user->data['username'] && $auth->acl_get('u_chgname') && $config['allow_namechange'])
						{
							user_update_name($user->data['username'], $username);
						}

						meta_refresh(3, $this->u_action);
						$message = $user->lang['PROFILE_UPDATED'] . '<br /><br />' . sprintf($user->lang['RETURN_UCP'], '<a href="' . $this->u_action . '">', '</a>');
						trigger_error($message);
					}
	
					// Replace "error" strings with their real, localised form
					$error = preg_replace('#^([A-Z_]+)$#e', "(!empty(\$user->lang['\\1'])) ? \$user->lang['\\1'] : '\\1'", $error);
				}

				$user_char_ary = array('.*' => 'USERNAME_CHARS_ANY', '[\w]+' => 'USERNAME_ALPHA_ONLY', '[\w_\+\. \-\[\]]+' => 'USERNAME_ALPHA_SPACERS');

				$template->assign_vars(array(
					'ERROR'				=> (sizeof($error)) ? implode('<br />', $error) : '',

					'USERNAME'			=> (isset($username)) ? $username : $user->data['username'],
					'EMAIL'				=> (isset($email)) ? $email : $user->data['user_email'],
					'PASSWORD_CONFIRM'	=> (isset($password_confirm)) ? $password_confirm : '',
					'NEW_PASSWORD'		=> (isset($new_password)) ? $new_password : '',
					'CUR_PASSWORD'		=> '',

					'L_USERNAME_EXPLAIN'		=> sprintf($user->lang[$user_char_ary[str_replace('\\\\', '\\', $config['allow_name_chars'])] . '_EXPLAIN'], $config['min_name_chars'], $config['max_name_chars']),
					'L_CHANGE_PASSWORD_EXPLAIN'	=> sprintf($user->lang['CHANGE_PASSWORD_EXPLAIN'], $config['min_pass_chars'], $config['max_pass_chars']),

					'S_FORCE_PASSWORD'	=> ($config['chg_passforce'] && $user->data['user_passchg'] < time() - $config['chg_passforce']) ? true : false,
					'S_CHANGE_USERNAME' => ($config['allow_namechange'] && $auth->acl_get('u_chgname')) ? true : false,
					'S_CHANGE_EMAIL'	=> ($auth->acl_get('u_chgemail')) ? true : false,
					'S_CHANGE_PASSWORD'	=> ($auth->acl_get('u_chgpasswd')) ? true : false)
				);
				break;

			case 'profile_info':

				include($phpbb_root_path . 'includes/functions_profile_fields.' . $phpEx);

				$cp = new custom_profile();

				$cp_data = $cp_error = array();

				if ($submit)
				{
					$var_ary = array(
						'icq'			=> (string) '',
						'aim'			=> (string) '',
						'msn'			=> (string) '',
						'yim'			=> (string) '',
						'jabber'		=> (string) '',
						'website'		=> (string) '',
						'location'		=> (string) '',
						'occupation'	=> (string) '',
						'interests'		=> (string) '',
						'bday_day'		=> 0,
						'bday_month'	=> 0,
						'bday_year'		=> 0,
					);

					foreach ($var_ary as $var => $default)
					{
						$data[$var] = (in_array($var, array('location', 'occupation', 'interests'))) ? request_var($var, $default, true) : request_var($var, $default);
					}

					$var_ary = array(
						'icq'			=> array(
							array('string', true, 3, 15),
							array('match', true, '#^[0-9]+$#i')),
						'aim'			=> array('string', true, 3, 17),
						'msn'			=> array('string', true, 5, 255),
						'jabber'		=> array(
							array('string', true, 5, 255),
							array('match', true, '#^[a-z0-9\.\-_\+]+?@(.*?\.)*?[a-z0-9\-_]+?\.[a-z]{2,4}(/.*)?$#i')),
						'yim'			=> array('string', true, 5, 255),
						'website'		=> array(
							array('string', true, 12, 255),
							array('match', true, '#^http[s]?://(.*?\.)*?[a-z0-9\-]+\.[a-z]{2,4}#i')),
						'location'		=> array('string', true, 2, 255),
						'occupation'	=> array('string', true, 2, 500),
						'interests'		=> array('string', true, 2, 500),
						'bday_day'		=> array('num', true, 1, 31),
						'bday_month'	=> array('num', true, 1, 12),
						'bday_year'		=> array('num', true, 1901, gmdate('Y', time())),
					);

					$error = validate_data($data, $var_ary);
					extract($data);
					unset($data);

					// validate custom profile fields
					$cp->submit_cp_field('profile', $user->get_iso_lang_id(), $cp_data, $cp_error);

					if (sizeof($cp_error))
					{
						$error = array_merge($error, $cp_error);
					}

					if (!sizeof($error))
					{
						$sql_ary = array(
							'user_icq'		=> $icq,
							'user_aim'		=> $aim,
							'user_msnm'		=> $msn,
							'user_yim'		=> $yim,
							'user_jabber'	=> $jabber,
							'user_website'	=> $website,
							'user_from'		=> $location,
							'user_occ'		=> $occupation,
							'user_interests'=> $interests,
							'user_birthday'	=> sprintf('%2d-%2d-%4d', $bday_day, $bday_month, $bday_year),
						);

						$sql = 'UPDATE ' . USERS_TABLE . '
							SET ' . $db->sql_build_array('UPDATE', $sql_ary) . '
							WHERE user_id = ' . $user->data['user_id'];
						$db->sql_query($sql);

						// Update Custom Fields
						if (sizeof($cp_data))
						{
							$sql = 'UPDATE ' . PROFILE_FIELDS_DATA_TABLE . '
								SET ' . $db->sql_build_array('UPDATE', $cp_data) . '
								WHERE user_id = ' . $user->data['user_id'];
							$db->sql_query($sql);

							if (!$db->sql_affectedrows())
							{
								$cp_data['user_id'] = (int) $user->data['user_id'];

								$db->return_on_error = true;

								$sql = 'INSERT INTO ' . PROFILE_FIELDS_DATA_TABLE . ' ' . $db->sql_build_array('INSERT', $cp_data);
								$db->sql_query($sql);

								$db->return_on_error = false;
							}
						}

						meta_refresh(3, $this->u_action);
						$message = $user->lang['PROFILE_UPDATED'] . '<br /><br />' . sprintf($user->lang['RETURN_UCP'], '<a href="' . $this->u_action . '">', '</a>');
						trigger_error($message);
					}

					// Replace "error" strings with their real, localised form
					$error = preg_replace('#^([A-Z_]+)$#e', "(!empty(\$user->lang['\\1'])) ? \$user->lang['\\1'] : '\\1'", $error);
				}

				if (!isset($bday_day))
				{
					if ($user->data['user_birthday'])
					{
						list($bday_day, $bday_month, $bday_year) = explode('-', $user->data['user_birthday']);
					}
					else
					{
						$bday_day = $bday_month = $bday_year = 0;
					}
				}

				$s_birthday_day_options = '<option value="0"' . ((!$bday_day) ? ' selected="selected"' : '') . '>--</option>';
				for ($i = 1; $i < 32; $i++)
				{
					$selected = ($i == $bday_day) ? ' selected="selected"' : '';
					$s_birthday_day_options .= "<option value=\"$i\"$selected>$i</option>";
				}

				$s_birthday_month_options = '<option value="0"' . ((!$bday_month) ? ' selected="selected"' : '') . '>--</option>';
				for ($i = 1; $i < 13; $i++)
				{
					$selected = ($i == $bday_month) ? ' selected="selected"' : '';
					$s_birthday_month_options .= "<option value=\"$i\"$selected>$i</option>";
				}
				$s_birthday_year_options = '';

				$now = getdate();
				$s_birthday_year_options = '<option value="0"' . ((!$bday_year) ? ' selected="selected"' : '') . '>--</option>';
				for ($i = $now['year'] - 100; $i < $now['year']; $i++)
				{
					$selected = ($i == $bday_year) ? ' selected="selected"' : '';
					$s_birthday_year_options .= "<option value=\"$i\"$selected>$i</option>";
				}
				unset($now);

				$template->assign_vars(array(
					'ERROR'		=> (sizeof($error)) ? implode('<br />', $error) : '',

					'ICQ'		=> (isset($icq)) ? $icq : $user->data['user_icq'],
					'YIM'		=> (isset($yim)) ? $yim : $user->data['user_yim'],
					'AIM'		=> (isset($aim)) ? $aim : $user->data['user_aim'],
					'MSN'		=> (isset($msn)) ? $msn : $user->data['user_msnm'],
					'JABBER'	=> (isset($jabber)) ? $jabber : $user->data['user_jabber'],
					'WEBSITE'	=> (isset($website)) ? $website : $user->data['user_website'],
					'LOCATION'	=> (isset($location)) ? $location : $user->data['user_from'],
					'OCCUPATION'=> (isset($occupation)) ? $occupation : $user->data['user_occ'],
					'INTERESTS'	=> (isset($interests)) ? $interests : $user->data['user_interests'],

					'S_BIRTHDAY_DAY_OPTIONS'	=> $s_birthday_day_options,
					'S_BIRTHDAY_MONTH_OPTIONS'	=> $s_birthday_month_options,
					'S_BIRTHDAY_YEAR_OPTIONS'	=> $s_birthday_year_options,)
				);

				// Get additional profile fields and assign them to the template block var 'profile_fields'
				$user->get_profile_fields($user->data['user_id']);

				$cp->generate_profile_fields('profile', $user->get_iso_lang_id());

				break;

			case 'signature':

				if (!$auth->acl_get('u_sig'))
				{
					trigger_error('NO_AUTH_SIGNATURE');
				}
				
				include($phpbb_root_path . 'includes/functions_posting.'.$phpEx);

				$enable_bbcode	= ($config['allow_sig_bbcode']) ? request_var('enable_bbcode', $user->optionget('bbcode')) : false;
				$enable_smilies	= ($config['allow_sig_smilies']) ? request_var('enable_smilies', $user->optionget('smilies')) : false;
				$enable_urls	= request_var('enable_urls', true);
				$signature		= request_var('signature', (string) $user->data['user_sig'], true);

				if ($submit || $preview)
				{
					include($phpbb_root_path . 'includes/message_parser.'.$phpEx);

					if (!sizeof($error))
					{
						$message_parser = new parse_message($signature);

						// Allowing Quote BBCode
						$message_parser->parse($enable_bbcode, $enable_urls, $enable_smilies, $config['allow_sig_img'], $config['allow_sig_flash'], true, true, 'sig');
						
						if (sizeof($message_parser->warn_msg))
						{
							$error[] = implode('<br />', $message_parser->warn_msg);
						}
						
						if (!sizeof($error) && $submit)
						{
							$sql_ary = array(
								'user_sig'					=> (string) $message_parser->message, 
								'user_sig_bbcode_uid'		=> (string) $message_parser->bbcode_uid, 
								'user_sig_bbcode_bitfield'	=> (int) $message_parser->bbcode_bitfield
							);

							$sql = 'UPDATE ' . USERS_TABLE . ' 
								SET ' . $db->sql_build_array('UPDATE', $sql_ary) . ' 
								WHERE user_id = ' . $user->data['user_id'];
							$db->sql_query($sql);

							$message = $user->lang['PROFILE_UPDATED'] . '<br /><br />' . sprintf($user->lang['RETURN_UCP'], '<a href="' . $this->u_action . '">', '</a>');
							trigger_error($message);
						}
					}
	
					// Replace "error" strings with their real, localised form
					$error = preg_replace('#^([A-Z_]+)$#e', "(!empty(\$user->lang['\\1'])) ? \$user->lang['\\1'] : '\\1'", $error);
				}

				$signature_preview = '';
				if ($preview)
				{
					// Now parse it for displaying
					$signature_preview = $message_parser->format_display($enable_bbcode, $enable_urls, $enable_smilies, false);
					unset($message_parser);
				}

				decode_message($signature, $user->data['user_sig_bbcode_uid']);

				$template->assign_vars(array(
					'ERROR'				=> (sizeof($error)) ? implode('<br />', $error) : '',
					'SIGNATURE'			=> $signature,
					'SIGNATURE_PREVIEW'	=> $signature_preview,

					'S_BBCODE_CHECKED' 		=> (!$enable_bbcode) ? 'checked="checked"' : '',
					'S_SMILIES_CHECKED' 	=> (!$enable_smilies) ? 'checked="checked"' : '',
					'S_MAGIC_URL_CHECKED' 	=> (!$enable_urls) ? 'checked="checked"' : '',

					'BBCODE_STATUS'			=> ($config['allow_sig_bbcode']) ? sprintf($user->lang['BBCODE_IS_ON'], '<a href="' . append_sid("{$phpbb_root_path}faq.$phpEx", 'mode=bbcode') . '" onclick="target=\'_phpbbcode\';">', '</a>') : sprintf($user->lang['BBCODE_IS_OFF'], '<a href="' . append_sid("{$phpbb_root_path}faq.$phpEx", 'mode=bbcode') . '" onclick="target=\'_phpbbcode\';">', '</a>'),
					'SMILIES_STATUS'		=> ($config['allow_sig_smilies']) ? $user->lang['SMILIES_ARE_ON'] : $user->lang['SMILIES_ARE_OFF'],
					'IMG_STATUS'			=> ($config['allow_sig_img']) ? $user->lang['IMAGES_ARE_ON'] : $user->lang['IMAGES_ARE_OFF'],
					'FLASH_STATUS'			=> ($config['allow_sig_flash']) ? $user->lang['FLASH_IS_ON'] : $user->lang['FLASH_IS_OFF'],

					'L_SIGNATURE_EXPLAIN'	=> sprintf($user->lang['SIGNATURE_EXPLAIN'], $config['max_sig_chars']),

					'S_BBCODE_ALLOWED'		=> $config['allow_sig_bbcode'], 
					'S_SMILIES_ALLOWED'		=> $config['allow_sig_smilies'],
					'S_BBCODE_IMG'			=> ($config['allow_sig_img']) ? true : false,
					'S_BBCODE_FLASH'		=> ($config['allow_sig_flash']) ? true : false)
				);
			
				// Build custom bbcodes array
				$sql = 'SELECT bbcode_id, bbcode_tag 
					FROM ' . BBCODES_TABLE . '
					WHERE display_on_posting = 1';
				$result = $db->sql_query($sql);

				$i = 0;
				while ($row = $db->sql_fetchrow($result))
				{
					$template->assign_block_vars('custom_tags', array(
						'BBCODE_NAME'	=> "'[{$row['bbcode_tag']}]', '[/" . str_replace('=', '', $row['bbcode_tag']) . "]'",
						'BBCODE_ID'		=> 22 + ($i * 2),
						'BBCODE_TAG'	=> $row['bbcode_tag'])
					);

					$i++;
				}
				$db->sql_freeresult($result);
			
			break;

			case 'avatar':

				$display_gallery = (isset($_POST['display_gallery'])) ? true : false;
				$delete = (isset($_POST['delete'])) ? true : false;

				$avatar_select = basename(request_var('avatar_select', ''));
				$category = basename(request_var('category', ''));

				// Can we upload?
				$can_upload = ($config['allow_avatar_upload'] && file_exists($phpbb_root_path . $config['avatar_path']) && is_writeable($phpbb_root_path . $config['avatar_path']) && $auth->acl_get('u_chgavatar') && (@ini_get('file_uploads') || strtolower(@ini_get('file_uploads')) == 'on')) ? true : false;

				if ($submit)
				{
					$var_ary = array(
						'uploadurl'		=> (string) '',
						'remotelink'	=> (string) '',
						'width'			=> (string) '',
						'height'		=> (string) '',
					);

					foreach ($var_ary as $var => $default)
					{
						$data[$var] = request_var($var, $default);
					}

					$var_ary = array(
						'uploadurl'		=> array('string', true, 5, 255),
						'remotelink'	=> array('string', true, 5, 255),
						'width'			=> array('string', true, 1, 3),
						'height'		=> array('string', true, 1, 3),
					);

					$error = validate_data($data, $var_ary);

					if (!sizeof($error))
					{
						$data['user_id'] = $user->data['user_id'];

						if ((!empty($_FILES['uploadfile']['name']) || $data['uploadurl']) && $can_upload)
						{
							list($type, $filename, $width, $height) = avatar_upload($data, $error);
						}
						else if ($data['remotelink'] && $auth->acl_get('u_chgavatar') && $config['allow_avatar_remote'])
						{
							list($type, $filename, $width, $height) = avatar_remote($data, $error);
						}
						else if ($avatar_select && $auth->acl_get('u_chgavatar') && $config['allow_avatar_local'])
						{
							$type = AVATAR_GALLERY;
							$filename = $avatar_select;
							
							// check avatar gallery
							if (!is_dir($phpbb_root_path . $config['avatar_gallery_path'] . '/' . $category))
							{
								$filename = '';
								$type = $width = $height = 0;
							}
							else
							{
								list($width, $height) = getimagesize($phpbb_root_path . $config['avatar_gallery_path'] . '/' . $category . '/' . $filename);
								$filename = $category . '/' . $filename;
							}
						}
						else if ($delete && $auth->acl_get('u_chgavatar'))
						{
							$filename = '';
							$type = $width = $height = 0;
						}
						else
						{
							$data = array();
						}
					}

					if (!sizeof($error))
					{
						// Do we actually have any data to update?
						if (sizeof($data))
						{
							$sql_ary = array(
								'user_avatar'			=> $filename,
								'user_avatar_type'		=> $type,
								'user_avatar_width'		=> $width,
								'user_avatar_height'	=> $height,
							);

							$sql = 'UPDATE ' . USERS_TABLE . '
								SET ' . $db->sql_build_array('UPDATE', $sql_ary) . '
								WHERE user_id = ' . $user->data['user_id'];
							$db->sql_query($sql);

							// Delete old avatar if present
							if ($user->data['user_avatar'] && $filename != $user->data['user_avatar'] && $user->data['user_avatar_type'] != AVATAR_GALLERY)
							{
								avatar_delete($user->data['user_avatar']);
							}
						}

						meta_refresh(3, $this->u_action);
						$message = $user->lang['PROFILE_UPDATED'] . '<br /><br />' . sprintf($user->lang['RETURN_UCP'], '<a href="' . $this->u_action . '">', '</a>');
						trigger_error($message);
					}

					extract($data);
					unset($data);

					// Replace "error" strings with their real, localised form
					$error = preg_replace('#^([A-Z_]+)$#e', "(!empty(\$user->lang['\\1'])) ? \$user->lang['\\1'] : '\\1'", $error);
				}

				// Generate users avatar
				$avatar_img = '';

				if ($user->data['user_avatar'])
				{
					switch ($user->data['user_avatar_type'])
					{
						case AVATAR_UPLOAD:
							$avatar_img = $phpbb_root_path . $config['avatar_path'] . '/';
						break;
				
						case AVATAR_GALLERY:
							$avatar_img = $phpbb_root_path . $config['avatar_gallery_path'] . '/';
						break;
					}
					$avatar_img .= $user->data['user_avatar'];

					$avatar_img = '<img src="' . $avatar_img . '" width="' . $user->data['user_avatar_width'] . '" height="' . $user->data['user_avatar_height'] . '" alt="" />';
				}

				$template->assign_vars(array(
					'ERROR'			=> (sizeof($error)) ? implode('<br />', $error) : '',
					'AVATAR'		=> $avatar_img,
					'AVATAR_SIZE'	=> $config['avatar_filesize'],

					'S_FORM_ENCTYPE'	=> ($can_upload) ? ' enctype="multipart/form-data"' : '',

					'L_AVATAR_EXPLAIN'	=> sprintf($user->lang['AVATAR_EXPLAIN'], $config['avatar_max_width'], $config['avatar_max_height'], round($config['avatar_filesize'] / 1024)),)
				);

				if ($display_gallery && $auth->acl_get('u_chgavatar') && $config['allow_avatar_local'])
				{
					avatar_gallery($category, $avatar_select, 4);
				}
				else
				{
					$template->assign_vars(array(
						'AVATAR'		=> $avatar_img,
						'AVATAR_SIZE'	=> $config['avatar_filesize'],
						'WIDTH'			=> (isset($width)) ? $width : $user->data['user_avatar_width'],
						'HEIGHT'		=> (isset($height)) ? $height : $user->data['user_avatar_height'],

						'S_UPLOAD_AVATAR_FILE'	=> $can_upload,
						'S_UPLOAD_AVATAR_URL'	=> $can_upload,
						'S_LINK_AVATAR'			=> ($auth->acl_get('u_chgavatar') && $config['allow_avatar_remote']) ? true : false,
						'S_GALLERY_AVATAR'		=> ($auth->acl_get('u_chgavatar') && $config['allow_avatar_local']) ? true : false)
					);
				}

				break;
		}

		$template->assign_vars(array(
			'L_TITLE'	=> $user->lang['UCP_PROFILE_' . strtoupper($mode)],

			'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
			'S_UCP_ACTION'		=> $this->u_action)
		);

		// Set desired template
		$this->tpl_name = 'ucp_profile_' . $mode;
		$this->page_title = 'UCP_PROFILE_' . strtoupper($mode);
	}
}

?>