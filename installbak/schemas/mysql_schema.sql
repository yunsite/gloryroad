#
# MySQL Schema for phpBB 3.x - (c) phpBB Group, 2005
#
# $Id: mysql_schema.sql,v 1.199 2006/06/16 16:54:43 acydburn Exp $
#

# Table: 'phpbb_attachments'
CREATE TABLE phpbb_attachments (
  attach_id mediumint(8) UNSIGNED NOT NULL auto_increment,
  post_msg_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  topic_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  in_message tinyint(1) UNSIGNED DEFAULT '0' NOT NULL,
  poster_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  physical_filename varchar(255) NOT NULL,
  real_filename varchar(255) NOT NULL,
  download_count mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  comment text,
  extension varchar(100),
  mimetype varchar(100),
  filesize int(20) UNSIGNED NOT NULL,
  filetime int(11) UNSIGNED DEFAULT '0' NOT NULL,
  thumbnail tinyint(1) DEFAULT '0' NOT NULL,
  PRIMARY KEY (attach_id),
  KEY filetime (filetime),
  KEY post_msg_id (post_msg_id),
  KEY topic_id (topic_id),
  KEY poster_id (poster_id),
  KEY physical_filename (physical_filename(10)),
  KEY filesize (filesize)
);

# Table: 'phpbb_acl_groups'
CREATE TABLE phpbb_acl_groups (
  group_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  forum_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  auth_option_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  auth_role_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  auth_setting tinyint(2) DEFAULT '0' NOT NULL,
  KEY group_id (group_id),
  KEY auth_option_id (auth_option_id)
);

# Table: 'phpbb_acl_options'
CREATE TABLE phpbb_acl_options (
  auth_option_id mediumint(8) UNSIGNED NOT NULL auto_increment,
  auth_option varchar(20) NOT NULL,
  is_global tinyint(1) DEFAULT '0' NOT NULL,
  is_local tinyint(1) DEFAULT '0' NOT NULL,
  founder_only tinyint(1) DEFAULT '0' NOT NULL,
  PRIMARY KEY (auth_option_id),
  KEY auth_option (auth_option)
);

# Table: 'phpbb_acl_roles'
CREATE TABLE phpbb_acl_roles (
  role_id mediumint(8) UNSIGNED NOT NULL auto_increment,
  role_name varchar(255) DEFAULT '' NOT NULL,
  role_description text,
  role_type varchar(10) DEFAULT '' NOT NULL,
  role_order smallint(4) UNSIGNED DEFAULT '0' NOT NULL,
  PRIMARY KEY (role_id),
  KEY role_type (role_type),
  KEY role_order (role_order)
);

# Table: 'phpbb_acl_roles_data'
CREATE TABLE phpbb_acl_roles_data (
  role_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  auth_option_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  auth_setting tinyint(2) DEFAULT '0' NOT NULL,
  PRIMARY KEY  (role_id, auth_option_id)
);

# Table: 'phpbb_acl_users'
CREATE TABLE phpbb_acl_users (
  user_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  forum_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  auth_option_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  auth_role_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  auth_setting tinyint(2) DEFAULT '0' NOT NULL,
  KEY user_id (user_id),
  KEY auth_option_id (auth_option_id)
);

# Table: 'phpbb_banlist'
CREATE TABLE phpbb_banlist (
  ban_id mediumint(8) UNSIGNED NOT NULL auto_increment,
  ban_userid mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  ban_ip varchar(40) DEFAULT '' NOT NULL,
  ban_email varchar(100) DEFAULT '' NOT NULL,
  ban_start int(11) DEFAULT '0' NOT NULL,
  ban_end int(11) DEFAULT '0' NOT NULL,
  ban_exclude tinyint(1) DEFAULT '0' NOT NULL,
  ban_reason text,
  ban_give_reason text,
  PRIMARY KEY (ban_id)
);

# Table: 'phpbb_bbcodes'
CREATE TABLE phpbb_bbcodes (
  bbcode_id tinyint(3) UNSIGNED DEFAULT '0' NOT NULL,
  bbcode_tag varchar(16) DEFAULT '' NOT NULL,
  display_on_posting tinyint(1) UNSIGNED DEFAULT '0' NOT NULL,
  bbcode_match varchar(255) DEFAULT '' NOT NULL,
  bbcode_tpl text,
  first_pass_match varchar(255) DEFAULT '' NOT NULL,
  first_pass_replace varchar(255) DEFAULT '' NOT NULL,
  second_pass_match varchar(255) DEFAULT '' NOT NULL,
  second_pass_replace text,
  PRIMARY KEY (bbcode_id),
  KEY display_in_posting (display_on_posting)
);

# Table: 'phpbb_bookmarks'
CREATE TABLE phpbb_bookmarks (
  topic_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  user_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  order_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  KEY order_id (order_id),
  KEY topic_user_id (topic_id, user_id)
);

# Table: 'phpbb_bots'
CREATE TABLE phpbb_bots (
  bot_id tinyint(3) UNSIGNED NOT NULL auto_increment,
  bot_active tinyint(1) DEFAULT '1' NOT NULL,
  bot_name text,
  user_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  bot_agent varchar(255) DEFAULT '' NOT NULL,
  bot_ip varchar(255) DEFAULT '' NOT NULL,
  PRIMARY KEY (bot_id),
  KEY bot_active (bot_active)
);

# Table: 'phpbb_config'
CREATE TABLE phpbb_config (
  config_name varchar(255) NOT NULL,
  config_value varchar(255) NOT NULL,
  is_dynamic tinyint(1) DEFAULT '0' NOT NULL,
  PRIMARY KEY (config_name),
  KEY is_dynamic (is_dynamic)
);

# Table: 'phpbb_confirm'
CREATE TABLE phpbb_confirm (
  confirm_id char(32) DEFAULT '' NOT NULL,
  session_id char(32) DEFAULT '' NOT NULL,
  confirm_type tinyint(3) DEFAULT '0' NOT NULL,
  code varchar(8) DEFAULT '' NOT NULL,
  PRIMARY KEY (session_id, confirm_id)
);

# Table: 'phpbb_disallow'
CREATE TABLE phpbb_disallow (
  disallow_id mediumint(8) UNSIGNED NOT NULL auto_increment,
  disallow_username varchar(255) DEFAULT '' NOT NULL,
  PRIMARY KEY (disallow_id)
);

# Table: 'phpbb_drafts'
CREATE TABLE phpbb_drafts (
  draft_id mediumint(8) UNSIGNED NOT NULL auto_increment,
  user_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  topic_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  forum_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  save_time int(11) UNSIGNED DEFAULT '0' NOT NULL,
  draft_subject text,
  draft_message mediumtext,
  PRIMARY KEY (draft_id),
  KEY save_time (save_time)
);

# Table: 'phpbb_extensions'
CREATE TABLE phpbb_extensions (
  extension_id mediumint(8) UNSIGNED NOT NULL auto_increment,
  group_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  extension varchar(100) DEFAULT '' NOT NULL,
  PRIMARY KEY (extension_id)
);

# Table: 'phpbb_extension_groups'
CREATE TABLE phpbb_extension_groups (
  group_id mediumint(8) NOT NULL auto_increment,
  group_name varchar(255) NOT NULL,
  cat_id tinyint(2) DEFAULT '0' NOT NULL,
  allow_group tinyint(1) DEFAULT '0' NOT NULL,
  download_mode tinyint(1) UNSIGNED DEFAULT '1' NOT NULL,
  upload_icon varchar(255) DEFAULT '' NOT NULL,
  max_filesize int(20) DEFAULT '0' NOT NULL,
  allowed_forums text,
  allow_in_pm tinyint(1) DEFAULT '0' NOT NULL,
  PRIMARY KEY (group_id)
);

# Table: 'phpbb_forums'
CREATE TABLE phpbb_forums (
  forum_id smallint(5) UNSIGNED NOT NULL auto_increment,
  parent_id smallint(5) UNSIGNED NOT NULL,
  left_id smallint(5) UNSIGNED NOT NULL,
  right_id smallint(5) UNSIGNED NOT NULL,
  forum_parents text,
  forum_name text,
  forum_desc text,
  forum_desc_bitfield int(11) UNSIGNED DEFAULT '0' NOT NULL,
  forum_desc_uid varchar(5) DEFAULT '' NOT NULL,
  forum_link varchar(255) DEFAULT '' NOT NULL,
  forum_password varchar(40) DEFAULT '' NOT NULL,
  forum_style tinyint(4) UNSIGNED,
  forum_image varchar(255) DEFAULT '' NOT NULL,
  forum_rules text,
  forum_rules_link varchar(255) DEFAULT '' NOT NULL,
  forum_rules_bitfield int(11) UNSIGNED DEFAULT '0' NOT NULL,
  forum_rules_uid varchar(5) DEFAULT '' NOT NULL,
  forum_topics_per_page tinyint(4) UNSIGNED DEFAULT '0' NOT NULL,
  forum_type tinyint(4) DEFAULT '0' NOT NULL,
  forum_status tinyint(4) DEFAULT '0' NOT NULL,
  forum_posts mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  forum_topics mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  forum_topics_real mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  forum_last_post_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  forum_last_poster_id mediumint(8) DEFAULT '0' NOT NULL,
  forum_last_post_time int(11) DEFAULT '0' NOT NULL,
  forum_last_poster_name varchar(255),
  forum_flags tinyint(4) DEFAULT '0' NOT NULL,
  display_on_index tinyint(1) DEFAULT '1' NOT NULL,
  enable_indexing tinyint(1) DEFAULT '1' NOT NULL,
  enable_icons tinyint(1) DEFAULT '1' NOT NULL,
  enable_prune tinyint(1) DEFAULT '0' NOT NULL,
  prune_next int(11) UNSIGNED,
  prune_days tinyint(4) UNSIGNED NOT NULL,
  prune_viewed tinyint(4) UNSIGNED NOT NULL,
  prune_freq tinyint(4) UNSIGNED DEFAULT '0' NOT NULL,
  PRIMARY KEY (forum_id),
  KEY left_right_id (left_id, right_id),
  KEY forum_last_post_id (forum_last_post_id)
);

# Table: 'phpbb_forums_access'
CREATE TABLE phpbb_forums_access (
  forum_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  user_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  session_id varchar(32) DEFAULT '' NOT NULL,
  PRIMARY KEY (forum_id, user_id, session_id)
);

# Table: 'phpbb_forums_track'
CREATE TABLE phpbb_forums_track (
  user_id mediumint(9) UNSIGNED DEFAULT '0' NOT NULL,
  forum_id mediumint(9) UNSIGNED DEFAULT '0' NOT NULL,
  mark_time int(11) DEFAULT '0' NOT NULL,
  PRIMARY KEY (user_id, forum_id)
);

# Table: 'phpbb_forums_watch'
CREATE TABLE phpbb_forums_watch (
  forum_id smallint(5) UNSIGNED DEFAULT '0' NOT NULL,
  user_id mediumint(8) DEFAULT '0' NOT NULL,
  notify_status tinyint(1) DEFAULT '0' NOT NULL,
  KEY forum_id (forum_id),
  KEY user_id (user_id),
  KEY notify_status (notify_status)
);

# Table: 'phpbb_groups'
CREATE TABLE phpbb_groups (
  group_id mediumint(8) NOT NULL auto_increment,
  group_type tinyint(4) DEFAULT '1' NOT NULL,
  group_name varchar(255) DEFAULT '' NOT NULL,
  group_desc text,
  group_desc_bitfield int(11) UNSIGNED DEFAULT '0' NOT NULL,
  group_desc_uid varchar(5) DEFAULT '' NOT NULL,
  group_display tinyint(1) DEFAULT '0' NOT NULL,
  group_avatar varchar(255) DEFAULT '' NOT NULL,
  group_avatar_type tinyint(4) DEFAULT '0' NOT NULL,
  group_avatar_width tinyint(4) UNSIGNED DEFAULT '0' NOT NULL,
  group_avatar_height tinyint(4) UNSIGNED DEFAULT '0' NOT NULL,
  group_rank smallint(5) DEFAULT '-1' NOT NULL,
  group_colour varchar(6) DEFAULT '' NOT NULL,
  group_sig_chars mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  group_receive_pm tinyint(1) DEFAULT '0' NOT NULL,
  group_message_limit mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  group_chgpass smallint(6) DEFAULT '0' NOT NULL,
  group_legend tinyint(1) DEFAULT '1' NOT NULL,
  PRIMARY KEY (group_id),
  KEY group_legend (group_legend)
);

# Table: 'phpbb_icons'
CREATE TABLE phpbb_icons (
  icons_id tinyint(4) UNSIGNED NOT NULL auto_increment,
  icons_url varchar(255),
  icons_width tinyint(4) UNSIGNED NOT NULL,
  icons_height tinyint(4) UNSIGNED NOT NULL,
  icons_order tinyint(4) UNSIGNED NOT NULL,
  display_on_posting tinyint(1) UNSIGNED DEFAULT '1' NOT NULL,
  PRIMARY KEY (icons_id)
);

# Table: 'phpbb_lang'
CREATE TABLE phpbb_lang (
  lang_id tinyint(4) UNSIGNED NOT NULL auto_increment,
  lang_iso varchar(5) NOT NULL,
  lang_dir varchar(30) NOT NULL,
  lang_english_name varchar(100),
  lang_local_name varchar(255),
  lang_author varchar(255),
  PRIMARY KEY (lang_id)
);

# Table: 'phpbb_log'
CREATE TABLE phpbb_log (
  log_id mediumint(8) UNSIGNED NOT NULL auto_increment,
  log_type tinyint(4) UNSIGNED DEFAULT '0' NOT NULL,
  user_id mediumint(8) DEFAULT '0' NOT NULL,
  forum_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  topic_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  reportee_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  log_ip varchar(40) NOT NULL,
  log_time int(11) NOT NULL,
  log_operation text,
  log_data text,
  PRIMARY KEY (log_id),
  KEY log_type (log_type),
  KEY forum_id (forum_id),
  KEY topic_id (topic_id),
  KEY reportee_id (reportee_id),
  KEY user_id (user_id)
);

# Table: 'phpbb_moderator_cache'
CREATE TABLE phpbb_moderator_cache (
  forum_id mediumint(8) UNSIGNED NOT NULL,
  user_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  username varchar(255) DEFAULT '' NOT NULL,
  group_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  group_name varchar(255) DEFAULT '' NOT NULL,
  display_on_index tinyint(1) UNSIGNED DEFAULT '1' NOT NULL,
  KEY display_on_index (display_on_index),
  KEY forum_id (forum_id)
);

# Table: 'phpbb_modules'
CREATE TABLE phpbb_modules (
  module_id mediumint(8) UNSIGNED NOT NULL auto_increment,
  module_enabled tinyint(1) UNSIGNED DEFAULT '1' NOT NULL,
  module_display tinyint(1) UNSIGNED DEFAULT '1' NOT NULL,
  module_name varchar(255) DEFAULT '' NOT NULL,
  module_class varchar(10) DEFAULT '' NOT NULL,
  parent_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  left_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  right_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  module_langname varchar(255) DEFAULT '' NOT NULL,
  module_mode varchar(255) DEFAULT '' NOT NULL,
  module_auth varchar(255) DEFAULT '' NOT NULL,
  PRIMARY KEY  (module_id),
  KEY left_right_id (left_id, right_id),
  KEY module_enabled (module_enabled),
  KEY class_left_id (module_class, left_id)
);

# Table: 'phpbb_poll_options'
CREATE TABLE phpbb_poll_options (
  poll_option_id tinyint(4) UNSIGNED DEFAULT '0' NOT NULL,
  topic_id mediumint(8) UNSIGNED NOT NULL,
  poll_option_text text,
  poll_option_total mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  KEY poll_option_id (poll_option_id),
  KEY topic_id (topic_id)
);

# Table: 'phpbb_poll_votes'
CREATE TABLE phpbb_poll_votes (
  topic_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  poll_option_id tinyint(4) UNSIGNED DEFAULT '0' NOT NULL,
  vote_user_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  vote_user_ip varchar(40) NOT NULL,
  KEY topic_id (topic_id),
  KEY vote_user_id (vote_user_id),
  KEY vote_user_ip (vote_user_ip)
);

# Table: 'phpbb_posts'
CREATE TABLE phpbb_posts (
  post_id mediumint(8) UNSIGNED NOT NULL auto_increment,
  topic_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  forum_id smallint(5) UNSIGNED DEFAULT '0' NOT NULL,
  poster_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  icon_id tinyint(4) UNSIGNED DEFAULT '0' NOT NULL,
  poster_ip varchar(40) NOT NULL,
  post_time int(11) DEFAULT '0' NOT NULL,
  post_approved tinyint(1) DEFAULT '1' NOT NULL,
  post_reported tinyint(1) DEFAULT '0' NOT NULL,
  enable_bbcode tinyint(1) DEFAULT '1' NOT NULL,
  enable_smilies tinyint(1) DEFAULT '1' NOT NULL,
  enable_magic_url tinyint(1) DEFAULT '1' NOT NULL,
  enable_sig tinyint(1) DEFAULT '1' NOT NULL,
  post_username varchar(255) NULL,
  post_subject text NOT NULL,
  post_text mediumtext NOT NULL,
  post_checksum varchar(32) NOT NULL,
  post_encoding varchar(20) DEFAULT 'iso-8859-1' NOT NULL,
  post_attachment tinyint(1) DEFAULT '0' NOT NULL,
  bbcode_bitfield int(11) UNSIGNED DEFAULT '0' NOT NULL,
  bbcode_uid varchar(5) DEFAULT '' NOT NULL,
  post_edit_time int(11) UNSIGNED DEFAULT '0' NULL,
  post_edit_reason text NULL,
  post_edit_user mediumint(8) UNSIGNED DEFAULT '0' NULL,
  post_edit_count smallint(5) UNSIGNED DEFAULT '0' NULL,
  post_edit_locked tinyint(1) UNSIGNED DEFAULT '0' NULL,
  PRIMARY KEY (post_id),
  KEY forum_id (forum_id),
  KEY topic_id (topic_id),
  KEY poster_ip (poster_ip),
  KEY poster_id (poster_id),
  KEY post_approved (post_approved),
  KEY post_time (post_time)
);

# Table: 'phpbb_privmsgs'
CREATE TABLE phpbb_privmsgs (
  msg_id mediumint(8) UNSIGNED NOT NULL auto_increment,
  root_level mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  author_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  icon_id tinyint(4) UNSIGNED DEFAULT '0' NOT NULL,
  author_ip varchar(40) DEFAULT '' NOT NULL,
  message_time int(11) DEFAULT '0' NOT NULL,
  enable_bbcode tinyint(1) DEFAULT '1' NOT NULL,
  enable_smilies tinyint(1) DEFAULT '1' NOT NULL,
  enable_magic_url tinyint(1) DEFAULT '1' NOT NULL,
  enable_sig tinyint(1) DEFAULT '1' NOT NULL,
  message_subject text NOT NULL,
  message_text mediumtext NOT NULL,
  message_edit_reason text NULL,
  message_edit_user mediumint(8) UNSIGNED DEFAULT '0' NULL,
  message_encoding varchar(20) DEFAULT 'iso-8859-1' NOT NULL,
  message_attachment tinyint(1) DEFAULT '0' NOT NULL,
  bbcode_bitfield int(11) UNSIGNED DEFAULT '0' NOT NULL,
  bbcode_uid varchar(5) DEFAULT '' NOT NULL,
  message_edit_time int(11) UNSIGNED DEFAULT '0' NULL,
  message_edit_count smallint(5) UNSIGNED DEFAULT '0' NULL,
  to_address text NOT NULL,
  bcc_address text NOT NULL,
  PRIMARY KEY  (msg_id),
  KEY author_ip (author_ip),
  KEY message_time (message_time),
  KEY author_id (author_id),
  KEY root_level (root_level)
);

# Table: 'phpbb_privmsgs_folder'
CREATE TABLE phpbb_privmsgs_folder (
  folder_id mediumint(8) UNSIGNED NOT NULL auto_increment,
  user_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  folder_name varchar(255) DEFAULT '' NOT NULL,
  pm_count mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  PRIMARY KEY  (folder_id),
  KEY user_id (user_id)
);

# Table: 'phpbb_privmsgs_rules'
CREATE TABLE phpbb_privmsgs_rules (
  rule_id mediumint(8) UNSIGNED NOT NULL auto_increment,
  user_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  rule_check mediumint(4) UNSIGNED DEFAULT '0' NOT NULL,
  rule_connection mediumint(4) UNSIGNED DEFAULT '0' NOT NULL,
  rule_string varchar(255) DEFAULT '' NOT NULL,
  rule_user_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  rule_group_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  rule_action mediumint(4) UNSIGNED DEFAULT '0' NOT NULL,
  rule_folder_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  PRIMARY KEY  (rule_id)
);

# Table: 'phpbb_privmsgs_to'
CREATE TABLE phpbb_privmsgs_to (
  msg_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  user_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  author_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  deleted tinyint(1) UNSIGNED DEFAULT '0' NOT NULL,
  new tinyint(1) UNSIGNED DEFAULT '1' NOT NULL,
  unread tinyint(1) UNSIGNED DEFAULT '1' NOT NULL,
  replied tinyint(1) UNSIGNED DEFAULT '0' NOT NULL,
  marked tinyint(1) UNSIGNED DEFAULT '0' NOT NULL,
  forwarded tinyint(1) UNSIGNED DEFAULT '0' NOT NULL,
  folder_id int(10) DEFAULT '0' NOT NULL,
  KEY msg_id (msg_id),
  KEY user_id (user_id, folder_id)
);

# Table: 'phpbb_profile_fields'
CREATE TABLE phpbb_profile_fields (
  field_id mediumint(8) UNSIGNED NOT NULL auto_increment,
  field_name varchar(255) DEFAULT '' NOT NULL,
  field_type mediumint(8) UNSIGNED NOT NULL,
  field_ident varchar(20) DEFAULT '' NOT NULL,
  field_length varchar(20) DEFAULT '' NOT NULL,
  field_minlen varchar(255) DEFAULT '' NOT NULL,
  field_maxlen varchar(255) DEFAULT '' NOT NULL,
  field_novalue varchar(255) DEFAULT '' NOT NULL,
  field_default_value varchar(255) DEFAULT '0' NOT NULL,
  field_validation varchar(20) DEFAULT '' NOT NULL,
  field_required tinyint(1) UNSIGNED DEFAULT '0' NOT NULL,
  field_show_on_reg tinyint(1) UNSIGNED DEFAULT '0' NOT NULL,
  field_hide tinyint(1) UNSIGNED DEFAULT '0' NOT NULL,
  field_no_view tinyint(1) UNSIGNED DEFAULT '0' NOT NULL,
  field_active tinyint(1) UNSIGNED DEFAULT '0' NOT NULL,
  field_order tinyint(4) UNSIGNED DEFAULT '0' NOT NULL,
  PRIMARY KEY (field_id),
  KEY field_type (field_type),
  KEY field_order (field_order)
);

# Table: 'phpbb_profile_fields_data'
CREATE TABLE phpbb_profile_fields_data (
  user_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  PRIMARY KEY (user_id)
);

# Table: 'phpbb_profile_fields_lang'
CREATE TABLE phpbb_profile_fields_lang (
  field_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  lang_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  option_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  field_type tinyint(4) DEFAULT '0' NOT NULL,
  value varchar(255) DEFAULT '' NOT NULL,
  PRIMARY KEY (field_id, lang_id, option_id)
);

# Table: 'phpbb_profile_lang'
CREATE TABLE phpbb_profile_lang (
  field_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  lang_id tinyint(4) UNSIGNED DEFAULT '0' NOT NULL,
  lang_name varchar(255) DEFAULT '' NOT NULL,
  lang_explain text,
  lang_default_value varchar(255) DEFAULT '' NOT NULL,
  PRIMARY KEY (field_id, lang_id)
);

# Table: 'phpbb_ranks'
CREATE TABLE phpbb_ranks (
  rank_id smallint(5) UNSIGNED NOT NULL auto_increment,
  rank_title varchar(255) NOT NULL,
  rank_min mediumint(8) DEFAULT '0' NOT NULL,
  rank_special tinyint(1) DEFAULT '0',
  rank_image varchar(255),
  PRIMARY KEY (rank_id)
);

# Table: 'phpbb_reports'
CREATE TABLE phpbb_reports (
  report_id smallint(5) UNSIGNED NOT NULL auto_increment,
  reason_id smallint(5) UNSIGNED DEFAULT '0' NOT NULL,
  post_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  user_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  user_notify tinyint(1) DEFAULT '0' NOT NULL,
  report_closed tinyint(1) DEFAULT '0' NOT NULL,
  report_time int(11) UNSIGNED DEFAULT '0' NOT NULL,
  report_text mediumtext,
  PRIMARY KEY (report_id)
);

# Table: 'phpbb_reports_reasons'
CREATE TABLE phpbb_reports_reasons (
  reason_id smallint(6) NOT NULL auto_increment,
  reason_title varchar(255) DEFAULT '' NOT NULL,
  reason_description text,
  reason_order tinyint(4) DEFAULT '0' NOT NULL,
  PRIMARY KEY (reason_id)
);

# Table: 'phpbb_search_results'
CREATE TABLE phpbb_search_results (
  search_key varchar(32) DEFAULT '' NOT NULL,
  search_time int(11) DEFAULT '0' NOT NULL,
  search_keywords mediumtext,
  search_authors mediumtext,
  PRIMARY KEY (search_key)
);

# Table: 'phpbb_search_wordlist'
CREATE TABLE phpbb_search_wordlist (
  word_text varchar(252) BINARY DEFAULT '' NOT NULL,
  word_id mediumint(8) UNSIGNED NOT NULL auto_increment,
  word_common tinyint(1) UNSIGNED DEFAULT '0' NOT NULL,
  PRIMARY KEY (word_text),
  KEY word_id (word_id)
);

# Table: 'phpbb_search_wordmatch'
CREATE TABLE phpbb_search_wordmatch (
  post_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  word_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  title_match tinyint(1) DEFAULT '0' NOT NULL,
  KEY word_id (word_id)
);

# Table: 'phpbb_sessions'
CREATE TABLE phpbb_sessions (
  session_id varchar(32) DEFAULT '' NOT NULL,
  session_user_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  session_last_visit int(11) DEFAULT '0' NOT NULL,
  session_start int(11) DEFAULT '0' NOT NULL,
  session_time int(11) DEFAULT '0' NOT NULL,
  session_ip varchar(40) DEFAULT '0' NOT NULL,
  session_browser varchar(150) DEFAULT '' NOT NULL,
  session_page varchar(200) DEFAULT '' NOT NULL,
  session_viewonline tinyint(1) DEFAULT '1' NOT NULL,
  session_autologin tinyint(1) DEFAULT '0' NOT NULL,
  session_admin tinyint(1) DEFAULT '0' NOT NULL,
  PRIMARY KEY (session_id),
  KEY session_time (session_time),
  KEY session_user_id (session_user_id)
);

# Table: 'phpbb_sessions_keys'
CREATE TABLE phpbb_sessions_keys (
  key_id varchar(32) DEFAULT '' NOT NULL,
  user_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  last_ip varchar(40) DEFAULT '' NOT NULL,
  last_login int(11) DEFAULT '0' NOT NULL,
  PRIMARY KEY  (key_id, user_id),
  KEY last_login (last_login)
);

# Table: 'phpbb_sitelist'
CREATE TABLE phpbb_sitelist (
  site_id mediumint(8) UNSIGNED NOT NULL auto_increment,
  site_ip varchar(40) DEFAULT '' NOT NULL,
  site_hostname varchar(255) DEFAULT '' NOT NULL,
  ip_exclude tinyint(1) DEFAULT '0' NOT NULL,
  PRIMARY KEY (site_id)
);

# Table: 'phpbb_smilies'
CREATE TABLE phpbb_smilies (
  smiley_id tinyint(4) UNSIGNED NOT NULL auto_increment,
  code varchar(50),
  emotion varchar(50),
  smiley_url varchar(50),
  smiley_width tinyint(4) UNSIGNED NOT NULL,
  smiley_height tinyint(4) UNSIGNED NOT NULL,
  smiley_order tinyint(4) UNSIGNED NOT NULL,
  display_on_posting tinyint(1) UNSIGNED DEFAULT '1' NOT NULL,
  PRIMARY KEY (smiley_id)
);

# Table: 'phpbb_styles'
CREATE TABLE phpbb_styles (
  style_id tinyint(4) UNSIGNED NOT NULL auto_increment,
  style_name varchar(255) DEFAULT '' NOT NULL,
  style_copyright varchar(255) DEFAULT '' NOT NULL,
  style_active tinyint(1) DEFAULT '1' NOT NULL,
  template_id tinyint(4) UNSIGNED NOT NULL,
  theme_id tinyint(4) UNSIGNED NOT NULL,
  imageset_id tinyint(4) UNSIGNED NOT NULL,
  PRIMARY KEY (style_id),
  UNIQUE style_name (style_name),
  KEY (template_id),
  KEY (theme_id),
  KEY (imageset_id)
);

# Table: 'phpbb_styles_template'
CREATE TABLE phpbb_styles_template (
  template_id tinyint(4) UNSIGNED NOT NULL auto_increment,
  template_name varchar(255) NOT NULL,
  template_copyright varchar(255) NOT NULL,
  template_path varchar(100) NOT NULL,
  bbcode_bitfield int(11) UNSIGNED DEFAULT '6921' NOT NULL,
  template_storedb tinyint(1) DEFAULT '0' NOT NULL,
  PRIMARY KEY (template_id),
  UNIQUE template_name (template_name)
);

# Table: 'phpbb_styles_template_data'
CREATE TABLE phpbb_styles_template_data (
  template_id tinyint(4) UNSIGNED NOT NULL,
  template_filename varchar(100) DEFAULT '' NOT NULL,
  template_included text,
  template_mtime int(11) DEFAULT '0' NOT NULL,
  template_data mediumtext,
  KEY (template_id),
  KEY (template_filename)
);

# Table: 'phpbb_styles_theme'
CREATE TABLE phpbb_styles_theme (
  theme_id tinyint(4) UNSIGNED NOT NULL auto_increment,
  theme_name varchar(255) DEFAULT '' NOT NULL,
  theme_copyright varchar(255) DEFAULT '' NOT NULL,
  theme_path varchar(100) DEFAULT '' NOT NULL,
  theme_storedb tinyint(1) DEFAULT '0' NOT NULL,
  theme_mtime int(11) DEFAULT '0' NOT NULL,
  theme_data mediumtext,
  PRIMARY KEY (theme_id),
  UNIQUE theme_name (theme_name)
);

# Table: 'phpbb_styles_imageset'
CREATE TABLE phpbb_styles_imageset (
  imageset_id tinyint(4) UNSIGNED NOT NULL auto_increment,
  imageset_name varchar(255) DEFAULT '' NOT NULL,
  imageset_copyright varchar(255) DEFAULT '' NOT NULL,
  imageset_path varchar(100) DEFAULT '' NOT NULL,
  site_logo varchar(200) DEFAULT '' NOT NULL,
  btn_post varchar(200) DEFAULT '' NOT NULL,
  btn_post_pm varchar(200) DEFAULT '' NOT NULL,
  btn_reply varchar(200) DEFAULT '' NOT NULL,
  btn_reply_pm varchar(200) DEFAULT '' NOT NULL,
  btn_locked varchar(200) DEFAULT '' NOT NULL,
  btn_profile varchar(200) DEFAULT '' NOT NULL,
  btn_pm varchar(200) DEFAULT '' NOT NULL,
  btn_delete varchar(200) DEFAULT '' NOT NULL,
  btn_info varchar(200) DEFAULT '' NOT NULL,
  btn_quote varchar(200) DEFAULT '' NOT NULL,
  btn_search varchar(200) DEFAULT '' NOT NULL,
  btn_edit varchar(200) DEFAULT '' NOT NULL,
  btn_report varchar(200) DEFAULT '' NOT NULL,
  btn_email varchar(200) DEFAULT '' NOT NULL,
  btn_www varchar(200) DEFAULT '' NOT NULL,
  btn_icq varchar(200) DEFAULT '' NOT NULL,
  btn_aim varchar(200) DEFAULT '' NOT NULL,
  btn_yim varchar(200) DEFAULT '' NOT NULL,
  btn_msnm varchar(200) DEFAULT '' NOT NULL,
  btn_jabber varchar(200) DEFAULT '' NOT NULL,
  btn_online varchar(200) DEFAULT '' NOT NULL,
  btn_offline varchar(200) DEFAULT '' NOT NULL,
  btn_friend varchar(200) DEFAULT '' NOT NULL,
  btn_foe varchar(200) DEFAULT '' NOT NULL,
  icon_unapproved varchar(200) DEFAULT '' NOT NULL,
  icon_reported varchar(200) DEFAULT '' NOT NULL,
  icon_attach varchar(200) DEFAULT '' NOT NULL,
  icon_post varchar(200) DEFAULT '' NOT NULL,
  icon_post_new varchar(200) DEFAULT '' NOT NULL,
  icon_post_latest varchar(200) DEFAULT '' NOT NULL,
  icon_post_newest varchar(200) DEFAULT '' NOT NULL,
  forum varchar(200) DEFAULT '' NOT NULL,
  forum_new varchar(200) DEFAULT '' NOT NULL,
  forum_locked varchar(200) DEFAULT '' NOT NULL,
  forum_link varchar(200) DEFAULT '' NOT NULL,
  sub_forum varchar(200) DEFAULT '' NOT NULL,
  sub_forum_new varchar(200) DEFAULT '' NOT NULL,
  folder varchar(200) DEFAULT '' NOT NULL,
  folder_moved varchar(200) DEFAULT '' NOT NULL,
  folder_posted varchar(200) DEFAULT '' NOT NULL,
  folder_new varchar(200) DEFAULT '' NOT NULL,
  folder_new_posted varchar(200) DEFAULT '' NOT NULL,
  folder_hot varchar(200) DEFAULT '' NOT NULL,
  folder_hot_posted varchar(200) DEFAULT '' NOT NULL,
  folder_hot_new varchar(200) DEFAULT '' NOT NULL,
  folder_hot_new_posted varchar(200) DEFAULT '' NOT NULL,
  folder_locked varchar(200) DEFAULT '' NOT NULL,
  folder_locked_posted varchar(200) DEFAULT '' NOT NULL,
  folder_locked_new varchar(200) DEFAULT '' NOT NULL,
  folder_locked_new_posted varchar(200) DEFAULT '' NOT NULL,
  folder_sticky varchar(200) DEFAULT '' NOT NULL,
  folder_sticky_posted varchar(200) DEFAULT '' NOT NULL,
  folder_sticky_new varchar(200) DEFAULT '' NOT NULL,
  folder_sticky_new_posted varchar(200) DEFAULT '' NOT NULL,
  folder_announce varchar(200) DEFAULT '' NOT NULL,
  folder_announce_posted varchar(200) DEFAULT '' NOT NULL,
  folder_announce_new varchar(200) DEFAULT '' NOT NULL,
  folder_announce_new_posted varchar(200) DEFAULT '' NOT NULL,
  folder_global varchar(200) DEFAULT '' NOT NULL,
  folder_global_posted varchar(200) DEFAULT '' NOT NULL,
  folder_global_new varchar(200) DEFAULT '' NOT NULL,
  folder_global_new_posted varchar(200) DEFAULT '' NOT NULL,
  poll_left varchar(200) DEFAULT '' NOT NULL,
  poll_center varchar(200) DEFAULT '' NOT NULL,
  poll_right varchar(200) DEFAULT '' NOT NULL,
  attach_progress_bar varchar(200) DEFAULT '' NOT NULL,
  user_icon1 varchar(200) DEFAULT '' NOT NULL,
  user_icon2 varchar(200) DEFAULT '' NOT NULL,
  user_icon3 varchar(200) DEFAULT '' NOT NULL,
  user_icon4 varchar(200) DEFAULT '' NOT NULL,
  user_icon5 varchar(200) DEFAULT '' NOT NULL,
  user_icon6 varchar(200) DEFAULT '' NOT NULL,
  user_icon7 varchar(200) DEFAULT '' NOT NULL,
  user_icon8 varchar(200) DEFAULT '' NOT NULL,
  user_icon9 varchar(200) DEFAULT '' NOT NULL,
  user_icon10 varchar(200) DEFAULT '' NOT NULL,
  PRIMARY KEY (imageset_id),
  UNIQUE imageset_name (imageset_name)
);

# Table: 'phpbb_topics'
CREATE TABLE phpbb_topics (
  topic_id mediumint(8) UNSIGNED NOT NULL auto_increment,
  forum_id smallint(5) UNSIGNED DEFAULT '0' NOT NULL,
  icon_id tinyint(4) UNSIGNED DEFAULT '1' NOT NULL,
  topic_attachment tinyint(1) DEFAULT '0' NOT NULL,
  topic_approved tinyint(1) UNSIGNED DEFAULT '1' NOT NULL,
  topic_reported tinyint(1) UNSIGNED DEFAULT '0' NOT NULL,
  topic_title text,
  topic_poster mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  topic_time int(11) DEFAULT '0' NOT NULL,
  topic_time_limit int(11) DEFAULT '0' NOT NULL,
  topic_views mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  topic_replies mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  topic_replies_real mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  topic_status tinyint(3) DEFAULT '0' NOT NULL,
  topic_type tinyint(3) DEFAULT '0' NOT NULL,
  topic_first_post_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  topic_first_poster_name varchar(255),
  topic_last_post_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  topic_last_poster_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  topic_last_poster_name varchar(255),
  topic_last_post_time int(11) UNSIGNED DEFAULT '0' NOT NULL,
  topic_last_view_time int(11) UNSIGNED DEFAULT '0' NOT NULL,
  topic_moved_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  topic_bumped tinyint(1) UNSIGNED DEFAULT '0' NOT NULL,
  topic_bumper mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  poll_title text NULL,
  poll_start int(11) DEFAULT '0' NULL,
  poll_length int(11) DEFAULT '0' NULL,
  poll_max_options tinyint(4) UNSIGNED DEFAULT '1' NOT NULL,
  poll_last_vote int(11) UNSIGNED DEFAULT '0',
  poll_vote_change tinyint(1) UNSIGNED DEFAULT '0' NOT NULL,
  PRIMARY KEY (topic_id),
  KEY forum_id (forum_id),
  KEY forum_id_type (forum_id, topic_type),
  KEY topic_last_post_time (topic_last_post_time)
);

# Table: 'phpbb_topics_track'
CREATE TABLE phpbb_topics_track (
  user_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  topic_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  forum_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  mark_time int(11) DEFAULT '0' NOT NULL,
  PRIMARY KEY (user_id, topic_id),
  KEY forum_id (forum_id)
);

# Table: 'phpbb_topic_posted'
CREATE TABLE phpbb_topics_posted (
  user_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  topic_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  topic_posted tinyint(4) DEFAULT '0' NOT NULL,
  PRIMARY KEY (user_id, topic_id)
);

# Table: 'phpbb_topics_watch'
CREATE TABLE phpbb_topics_watch (
  topic_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  user_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  notify_status tinyint(1) DEFAULT '0' NOT NULL,
  KEY topic_id (topic_id),
  KEY user_id (user_id),
  KEY notify_status (notify_status)
);

# Table: 'phpbb_user_group'
CREATE TABLE phpbb_user_group (
  group_id mediumint(8) DEFAULT '0' NOT NULL,
  user_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  group_leader tinyint(1) DEFAULT '0' NOT NULL,
  user_pending tinyint(1),
  KEY group_id (group_id),
  KEY user_id (user_id),
  KEY group_leader (group_leader)
);

# Table: 'phpbb_users'
CREATE TABLE phpbb_users (
  user_id mediumint(8) UNSIGNED NOT NULL auto_increment,
  user_type tinyint(1) DEFAULT '0' NOT NULL,
  group_id mediumint(8) DEFAULT '3' NOT NULL,
  user_permissions text NULL,
  user_perm_from mediumint(8) DEFAULT '0' NULL,
  user_ip varchar(40) DEFAULT '' NOT NULL,
  user_regdate int(11) DEFAULT '0' NOT NULL,
  username varchar(255) DEFAULT '' NOT NULL,
  user_password varchar(40) DEFAULT '' NOT NULL,
  user_passchg int(11) DEFAULT '0' NULL,
  user_email varchar(100) DEFAULT '' NOT NULL,
  user_email_hash bigint(20) DEFAULT '0' NOT NULL,
  user_birthday varchar(10) DEFAULT '' NULL,
  user_lastvisit int(11) DEFAULT '0' NOT NULL,
  user_lastmark int(11) DEFAULT '0' NOT NULL,
  user_lastpost_time int(11) DEFAULT '0' NOT NULL,
  user_lastpage varchar(200) DEFAULT '' NOT NULL,
  user_last_confirm_key varchar(10) DEFAULT '' NULL,
  user_last_search int(11) DEFAULT '0' NULL,
  user_warnings tinyint(4) DEFAULT '0' NULL,
  user_last_warning int(11) DEFAULT '0' NULL,
  user_login_attempts smallint(4) DEFAULT '0' NULL,
  user_posts mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  user_lang varchar(30) DEFAULT '' NOT NULL,
  user_timezone decimal(5,2) DEFAULT '0.0' NOT NULL,
  user_dst tinyint(1) DEFAULT '0' NOT NULL,
  user_dateformat varchar(30) DEFAULT 'd M Y H:i' NOT NULL,
  user_style tinyint(4) DEFAULT '0' NOT NULL,
  user_rank int(11) DEFAULT '0' NULL,
  user_colour varchar(6) DEFAULT '' NOT NULL,
  user_new_privmsg tinyint(4) UNSIGNED DEFAULT '0' NOT NULL,
  user_unread_privmsg tinyint(4) UNSIGNED DEFAULT '0' NOT NULL,
  user_last_privmsg int(11) DEFAULT '0' NOT NULL,
  user_message_rules tinyint(1) UNSIGNED DEFAULT '0' NOT NULL,
  user_full_folder int(11) DEFAULT '-3' NOT NULL,
  user_emailtime int(11) DEFAULT '0' NOT NULL,
  user_topic_show_days smallint(4) DEFAULT '0' NOT NULL,
  user_topic_sortby_type varchar(1) DEFAULT 't' NOT NULL,
  user_topic_sortby_dir varchar(1) DEFAULT 'd' NOT NULL,
  user_post_show_days smallint(4) DEFAULT '0' NOT NULL,
  user_post_sortby_type varchar(1) DEFAULT 't' NOT NULL,
  user_post_sortby_dir varchar(1) DEFAULT 'a' NOT NULL,
  user_notify tinyint(1) DEFAULT '0' NOT NULL,
  user_notify_pm tinyint(1) DEFAULT '1' NOT NULL,
  user_notify_type tinyint(4) DEFAULT '0' NOT NULL,
  user_allow_pm tinyint(1) DEFAULT '1' NOT NULL,
  user_allow_email tinyint(1) DEFAULT '1' NOT NULL,
  user_allow_viewonline tinyint(1) DEFAULT '1' NOT NULL,
  user_allow_viewemail tinyint(1) DEFAULT '1' NOT NULL,
  user_allow_massemail tinyint(1) DEFAULT '1' NOT NULL,
  user_options int(11) DEFAULT '893' NOT NULL,
  user_avatar varchar(255) DEFAULT '' NOT NULL,
  user_avatar_type tinyint(2) DEFAULT '0' NOT NULL,
  user_avatar_width tinyint(4) UNSIGNED DEFAULT '0' NOT NULL,
  user_avatar_height tinyint(4) UNSIGNED DEFAULT '0' NOT NULL,
  user_sig text NULL,
  user_sig_bbcode_uid varchar(5) DEFAULT '' NULL,
  user_sig_bbcode_bitfield int(11) DEFAULT '0' NULL,
  user_from varchar(100) DEFAULT '' NULL,
  user_icq varchar(15) DEFAULT '' NULL,
  user_aim varchar(255) DEFAULT '' NULL,
  user_yim varchar(255) DEFAULT '' NULL,
  user_msnm varchar(255) DEFAULT '' NULL,
  user_jabber varchar(255) DEFAULT '' NULL,
  user_website varchar(200) DEFAULT '' NULL,
  user_occ varchar(255) DEFAULT '' NULL,
  user_interests varchar(255) DEFAULT '' NULL,
  user_actkey varchar(32) DEFAULT '' NOT NULL,
  user_newpasswd varchar(32) DEFAULT '' NULL,
  PRIMARY KEY (user_id),
  KEY user_birthday (user_birthday(6)),
  KEY user_email_hash (user_email_hash),
  KEY user_type (user_type),
  KEY username (username)
);

# Table: 'phpbb_warnings'
CREATE TABLE phpbb_warnings (
  warning_id mediumint(8) unsigned NOT NULL auto_increment,
  user_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  post_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  log_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  warning_time int(11) DEFAULT '0' NOT NULL,
  PRIMARY KEY  (`warning_id`)
);

# Table: 'phpbb_words'
CREATE TABLE phpbb_words (
  word_id mediumint(8) UNSIGNED NOT NULL auto_increment,
  word varchar(255) NOT NULL,
  replacement varchar(255) NOT NULL,
  PRIMARY KEY (word_id)
);

# Table: 'phpbb_zebra'
CREATE TABLE phpbb_zebra (
  user_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  zebra_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  friend tinyint(1) DEFAULT '0' NOT NULL,
  foe tinyint(1) DEFAULT '0' NOT NULL,
  KEY user_id (user_id),
  KEY zebra_id (zebra_id)
);
