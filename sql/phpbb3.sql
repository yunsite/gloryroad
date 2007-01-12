-- phpMyAdmin SQL Dump
-- version 2.9.1.1
-- http://www.phpmyadmin.net
-- 
-- 主机: localhost
-- 生成日期: 2007 年 01 月 12 日 09:11
-- 服务器版本: 4.1.22
-- PHP 版本: 5.1.6
-- 
-- 数据库: `phpbb3`
-- 

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_acl_groups`
-- 

CREATE TABLE `phpbb_acl_groups` (
  `group_id` mediumint(8) unsigned NOT NULL default '0',
  `forum_id` mediumint(8) unsigned NOT NULL default '0',
  `auth_option_id` mediumint(8) unsigned NOT NULL default '0',
  `auth_role_id` mediumint(8) unsigned NOT NULL default '0',
  `auth_setting` tinyint(2) NOT NULL default '0',
  KEY `group_id` (`group_id`),
  KEY `auth_option_id` (`auth_option_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- 导出表中的数据 `phpbb_acl_groups`
-- 

INSERT INTO `phpbb_acl_groups` (`group_id`, `forum_id`, `auth_option_id`, `auth_role_id`, `auth_setting`) VALUES 
(7, 0, 0, 5, 0),
(7, 0, 0, 1, 0),
(4, 0, 0, 6, 0),
(5, 0, 0, 6, 0),
(6, 0, 0, 5, 0),
(6, 0, 0, 10, 0),
(1, 1, 0, 17, 0),
(2, 1, 0, 17, 0),
(3, 1, 0, 17, 0),
(4, 1, 0, 17, 0),
(5, 1, 0, 17, 0),
(8, 1, 0, 17, 0),
(1, 2, 0, 17, 0),
(2, 2, 0, 17, 0),
(3, 2, 0, 17, 0),
(4, 2, 0, 15, 0),
(5, 2, 0, 15, 0),
(6, 2, 0, 21, 0),
(7, 2, 0, 14, 0),
(7, 2, 0, 10, 0),
(8, 2, 0, 19, 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_acl_options`
-- 

CREATE TABLE `phpbb_acl_options` (
  `auth_option_id` mediumint(8) unsigned NOT NULL auto_increment,
  `auth_option` varchar(20) NOT NULL default '',
  `is_global` tinyint(1) NOT NULL default '0',
  `is_local` tinyint(1) NOT NULL default '0',
  `founder_only` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`auth_option_id`),
  KEY `auth_option` (`auth_option`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=116 ;

-- 
-- 导出表中的数据 `phpbb_acl_options`
-- 

INSERT INTO `phpbb_acl_options` (`auth_option_id`, `auth_option`, `is_global`, `is_local`, `founder_only`) VALUES 
(1, 'f_', 0, 1, 0),
(2, 'f_announce', 0, 1, 0),
(3, 'f_attach', 0, 1, 0),
(4, 'f_bbcode', 0, 1, 0),
(5, 'f_bump', 0, 1, 0),
(6, 'f_delete', 0, 1, 0),
(7, 'f_download', 0, 1, 0),
(8, 'f_edit', 0, 1, 0),
(9, 'f_email', 0, 1, 0),
(10, 'f_flash', 0, 1, 0),
(11, 'f_icons', 0, 1, 0),
(12, 'f_ignoreflood', 0, 1, 0),
(13, 'f_img', 0, 1, 0),
(14, 'f_list', 0, 1, 0),
(15, 'f_noapprove', 0, 1, 0),
(16, 'f_print', 0, 1, 0),
(17, 'f_poll', 0, 1, 0),
(18, 'f_post', 0, 1, 0),
(19, 'f_postcount', 0, 1, 0),
(20, 'f_read', 0, 1, 0),
(21, 'f_reply', 0, 1, 0),
(22, 'f_report', 0, 1, 0),
(23, 'f_search', 0, 1, 0),
(24, 'f_sigs', 0, 1, 0),
(25, 'f_smilies', 0, 1, 0),
(26, 'f_sticky', 0, 1, 0),
(27, 'f_subscribe', 0, 1, 0),
(28, 'f_user_lock', 0, 1, 0),
(29, 'f_vote', 0, 1, 0),
(30, 'f_votechg', 0, 1, 0),
(31, 'm_', 1, 1, 0),
(32, 'm_approve', 1, 1, 0),
(33, 'm_chgposter', 1, 1, 0),
(34, 'm_delete', 1, 1, 0),
(35, 'm_edit', 1, 1, 0),
(36, 'm_info', 1, 1, 0),
(37, 'm_lock', 1, 1, 0),
(38, 'm_merge', 1, 1, 0),
(39, 'm_move', 1, 1, 0),
(40, 'm_report', 1, 1, 0),
(41, 'm_split', 1, 1, 0),
(42, 'm_warn', 1, 1, 0),
(43, 'm_ban', 1, 0, 0),
(44, 'a_', 1, 0, 0),
(45, 'a_aauth', 1, 0, 0),
(46, 'a_attach', 1, 0, 0),
(47, 'a_authgroups', 1, 0, 0),
(48, 'a_authusers', 1, 0, 0),
(49, 'a_backup', 1, 0, 0),
(50, 'a_ban', 1, 0, 0),
(51, 'a_bbcode', 1, 0, 0),
(52, 'a_board', 1, 0, 0),
(53, 'a_bots', 1, 0, 0),
(54, 'a_clearlogs', 1, 0, 0),
(55, 'a_email', 1, 0, 0),
(56, 'a_fauth', 1, 0, 0),
(57, 'a_forum', 1, 0, 0),
(58, 'a_forumadd', 1, 0, 0),
(59, 'a_forumdel', 1, 0, 0),
(60, 'a_group', 1, 0, 0),
(61, 'a_groupadd', 1, 0, 0),
(62, 'a_groupdel', 1, 0, 0),
(63, 'a_icons', 1, 0, 0),
(64, 'a_jabber', 1, 0, 0),
(65, 'a_language', 1, 0, 0),
(66, 'a_mauth', 1, 0, 0),
(67, 'a_modules', 1, 0, 0),
(68, 'a_names', 1, 0, 0),
(69, 'a_phpinfo', 1, 0, 0),
(70, 'a_profile', 1, 0, 0),
(71, 'a_prune', 1, 0, 0),
(72, 'a_ranks', 1, 0, 0),
(73, 'a_reasons', 1, 0, 0),
(74, 'a_roles', 1, 0, 0),
(75, 'a_search', 1, 0, 0),
(76, 'a_server', 1, 0, 0),
(77, 'a_styles', 1, 0, 0),
(78, 'a_switchperm', 1, 0, 0),
(79, 'a_uauth', 1, 0, 0),
(80, 'a_user', 1, 0, 0),
(81, 'a_userdel', 1, 0, 0),
(82, 'a_viewauth', 1, 0, 0),
(83, 'a_viewlogs', 1, 0, 0),
(84, 'a_words', 1, 0, 0),
(85, 'u_', 1, 0, 0),
(86, 'u_sendemail', 1, 0, 0),
(87, 'u_readpm', 1, 0, 0),
(88, 'u_sendpm', 1, 0, 0),
(89, 'u_sendim', 1, 0, 0),
(90, 'u_ignoreflood', 1, 0, 0),
(91, 'u_hideonline', 1, 0, 0),
(92, 'u_viewonline', 1, 0, 0),
(93, 'u_viewprofile', 1, 0, 0),
(94, 'u_chgavatar', 1, 0, 0),
(95, 'u_chggrp', 1, 0, 0),
(96, 'u_chgemail', 1, 0, 0),
(97, 'u_chgname', 1, 0, 0),
(98, 'u_chgpasswd', 1, 0, 0),
(99, 'u_chgcensors', 1, 0, 0),
(100, 'u_search', 1, 0, 0),
(101, 'u_savedrafts', 1, 0, 0),
(102, 'u_download', 1, 0, 0),
(103, 'u_attach', 1, 0, 0),
(104, 'u_sig', 1, 0, 0),
(105, 'u_pm_attach', 1, 0, 0),
(106, 'u_pm_bbcode', 1, 0, 0),
(107, 'u_pm_smilies', 1, 0, 0),
(108, 'u_pm_download', 1, 0, 0),
(109, 'u_pm_edit', 1, 0, 0),
(110, 'u_pm_printpm', 1, 0, 0),
(111, 'u_pm_emailpm', 1, 0, 0),
(112, 'u_pm_forward', 1, 0, 0),
(113, 'u_pm_delete', 1, 0, 0),
(114, 'u_pm_img', 1, 0, 0),
(115, 'u_pm_flash', 1, 0, 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_acl_roles`
-- 

CREATE TABLE `phpbb_acl_roles` (
  `role_id` mediumint(8) unsigned NOT NULL auto_increment,
  `role_name` varchar(255) NOT NULL default '',
  `role_description` text,
  `role_type` varchar(10) NOT NULL default '',
  `role_order` smallint(4) unsigned NOT NULL default '0',
  PRIMARY KEY  (`role_id`),
  KEY `role_type` (`role_type`),
  KEY `role_order` (`role_order`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

-- 
-- 导出表中的数据 `phpbb_acl_roles`
-- 

INSERT INTO `phpbb_acl_roles` (`role_id`, `role_name`, `role_description`, `role_type`, `role_order`) VALUES 
(1, 'Standard Admin', 'ROLE_DESCRIPTION_ADMIN_STANDARD', 'a_', 1),
(2, 'Forum Admin', 'ROLE_DESCRIPTION_ADMIN_FORUM', 'a_', 3),
(3, 'User and Groups Admin', 'ROLE_DESCRIPTION_ADMIN_USERGROUP', 'a_', 4),
(4, 'Full Admin', 'ROLE_DESCRIPTION_ADMIN_FULL', 'a_', 2),
(5, 'All Features', 'ROLE_DESCRIPTION_USER_FULL', 'u_', 3),
(6, 'Standard Features', 'ROLE_DESCRIPTION_USER_STANDARD', 'u_', 1),
(7, 'Limited Features', 'ROLE_DESCRIPTION_USER_LIMITED', 'u_', 2),
(8, 'No Private Messages', 'ROLE_DESCRIPTION_USER_NOPM', 'u_', 4),
(9, 'No Avatar', 'ROLE_DESCRIPTION_USER_NOAVATAR', 'u_', 5),
(10, 'Full Moderator', 'ROLE_DESCRIPTION_MOD_FULL', 'm_', 3),
(11, 'Standard Moderator', 'ROLE_DESCRIPTION_MOD_STANDARD', 'm_', 1),
(12, 'Simple Moderator', 'ROLE_DESCRIPTION_MOD_SIMPLE', 'm_', 2),
(13, 'Queue Moderator', 'ROLE_DESCRIPTION_MOD_QUEUE', 'm_', 4),
(14, 'Full Access', 'ROLE_DESCRIPTION_FORUM_FULL', 'f_', 6),
(15, 'Standard Access', 'ROLE_DESCRIPTION_FORUM_STANDARD', 'f_', 4),
(16, 'No Access', 'ROLE_DESCRIPTION_FORUM_NOACCESS', 'f_', 1),
(17, 'Read Only Access', 'ROLE_DESCRIPTION_FORUM_READONLY', 'f_', 2),
(18, 'Limited Access', 'ROLE_DESCRIPTION_FORUM_LIMITED', 'f_', 3),
(19, 'Bot Access', 'ROLE_DESCRIPTION_FORUM_BOT', 'f_', 8),
(20, 'On Moderation Queue', 'ROLE_DESCRIPTION_FORUM_ONQUEUE', 'f_', 7),
(21, 'Standard Access + Polls', 'ROLE_DESCRIPTION_FORUM_POLLS', 'f_', 5);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_acl_roles_data`
-- 

CREATE TABLE `phpbb_acl_roles_data` (
  `role_id` mediumint(8) unsigned NOT NULL default '0',
  `auth_option_id` mediumint(8) unsigned NOT NULL default '0',
  `auth_setting` tinyint(2) NOT NULL default '0',
  PRIMARY KEY  (`role_id`,`auth_option_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- 导出表中的数据 `phpbb_acl_roles_data`
-- 

INSERT INTO `phpbb_acl_roles_data` (`role_id`, `auth_option_id`, `auth_setting`) VALUES 
(1, 44, 1),
(1, 46, 1),
(1, 47, 1),
(1, 48, 1),
(1, 50, 1),
(1, 51, 1),
(1, 52, 1),
(1, 56, 1),
(1, 57, 1),
(1, 58, 1),
(1, 59, 1),
(1, 60, 1),
(1, 61, 1),
(1, 62, 1),
(1, 63, 1),
(1, 66, 1),
(1, 68, 1),
(1, 70, 1),
(1, 71, 1),
(1, 72, 1),
(1, 73, 1),
(1, 79, 1),
(1, 80, 1),
(1, 81, 1),
(1, 82, 1),
(1, 83, 1),
(1, 84, 1),
(2, 44, 1),
(2, 47, 1),
(2, 48, 1),
(2, 56, 1),
(2, 57, 1),
(2, 58, 1),
(2, 59, 1),
(2, 66, 1),
(2, 71, 1),
(2, 79, 1),
(2, 82, 1),
(2, 83, 1),
(3, 44, 1),
(3, 47, 1),
(3, 48, 1),
(3, 50, 1),
(3, 60, 1),
(3, 61, 1),
(3, 62, 1),
(3, 72, 1),
(3, 79, 1),
(3, 80, 1),
(3, 82, 1),
(3, 83, 1),
(4, 44, 1),
(4, 45, 1),
(4, 46, 1),
(4, 47, 1),
(4, 48, 1),
(4, 49, 1),
(4, 50, 1),
(4, 51, 1),
(4, 52, 1),
(4, 53, 1),
(4, 54, 1),
(4, 55, 1),
(4, 56, 1),
(4, 57, 1),
(4, 58, 1),
(4, 59, 1),
(4, 60, 1),
(4, 61, 1),
(4, 62, 1),
(4, 63, 1),
(4, 64, 1),
(4, 65, 1),
(4, 66, 1),
(4, 67, 1),
(4, 68, 1),
(4, 69, 1),
(4, 70, 1),
(4, 71, 1),
(4, 72, 1),
(4, 73, 1),
(4, 74, 1),
(4, 75, 1),
(4, 76, 1),
(4, 77, 1),
(4, 78, 1),
(4, 79, 1),
(4, 80, 1),
(4, 81, 1),
(4, 82, 1),
(4, 83, 1),
(4, 84, 1),
(5, 85, 1),
(5, 86, 1),
(5, 87, 1),
(5, 88, 1),
(5, 89, 1),
(5, 90, 1),
(5, 91, 1),
(5, 92, 1),
(5, 93, 1),
(5, 94, 1),
(5, 95, 1),
(5, 96, 1),
(5, 97, 1),
(5, 98, 1),
(5, 99, 1),
(5, 100, 1),
(5, 101, 1),
(5, 102, 1),
(5, 103, 1),
(5, 104, 1),
(5, 105, 1),
(5, 106, 1),
(5, 107, 1),
(5, 108, 1),
(5, 109, 1),
(5, 110, 1),
(5, 111, 1),
(5, 112, 1),
(5, 113, 1),
(5, 114, 1),
(5, 115, 1),
(6, 85, 1),
(6, 86, 1),
(6, 87, 1),
(6, 88, 1),
(6, 89, 1),
(6, 91, 1),
(6, 92, 1),
(6, 93, 1),
(6, 94, 1),
(6, 96, 1),
(6, 98, 1),
(6, 99, 1),
(6, 100, 1),
(6, 101, 1),
(6, 102, 1),
(6, 103, 1),
(6, 104, 1),
(6, 105, 1),
(6, 106, 1),
(6, 107, 1),
(6, 108, 1),
(6, 109, 1),
(6, 110, 1),
(6, 111, 1),
(6, 113, 1),
(6, 114, 1),
(7, 85, 1),
(7, 87, 1),
(7, 88, 1),
(7, 91, 1),
(7, 92, 1),
(7, 93, 1),
(7, 94, 1),
(7, 96, 1),
(7, 98, 1),
(7, 99, 1),
(7, 102, 1),
(7, 104, 1),
(7, 106, 1),
(7, 107, 1),
(7, 108, 1),
(7, 109, 1),
(7, 110, 1),
(7, 112, 1),
(7, 113, 1),
(7, 114, 1),
(8, 85, 1),
(8, 91, 1),
(8, 92, 1),
(8, 93, 1),
(8, 94, 1),
(8, 96, 1),
(8, 98, 1),
(8, 99, 1),
(8, 102, 1),
(8, 104, 1),
(8, 87, 0),
(8, 88, 0),
(9, 85, 1),
(9, 87, 1),
(9, 88, 1),
(9, 91, 1),
(9, 92, 1),
(9, 93, 1),
(9, 96, 1),
(9, 98, 1),
(9, 99, 1),
(9, 102, 1),
(9, 104, 1),
(9, 106, 1),
(9, 107, 1),
(9, 108, 1),
(9, 109, 1),
(9, 110, 1),
(9, 112, 1),
(9, 113, 1),
(9, 114, 1),
(9, 94, 0),
(10, 31, 1),
(10, 32, 1),
(10, 43, 1),
(10, 33, 1),
(10, 34, 1),
(10, 35, 1),
(10, 36, 1),
(10, 37, 1),
(10, 38, 1),
(10, 39, 1),
(10, 40, 1),
(10, 41, 1),
(10, 42, 1),
(11, 31, 1),
(11, 35, 1),
(11, 36, 1),
(11, 37, 1),
(11, 38, 1),
(11, 39, 1),
(11, 40, 1),
(11, 41, 1),
(11, 42, 1),
(12, 31, 1),
(12, 32, 1),
(12, 34, 1),
(12, 35, 1),
(12, 36, 1),
(12, 40, 1),
(12, 42, 1),
(13, 31, 1),
(13, 32, 1),
(13, 35, 1),
(14, 1, 1),
(14, 2, 1),
(14, 3, 1),
(14, 4, 1),
(14, 5, 1),
(14, 6, 1),
(14, 7, 1),
(14, 8, 1),
(14, 9, 1),
(14, 10, 1),
(14, 11, 1),
(14, 12, 1),
(14, 13, 1),
(14, 14, 1),
(14, 15, 1),
(14, 17, 1),
(14, 18, 1),
(14, 19, 1),
(14, 16, 1),
(14, 20, 1),
(14, 21, 1),
(14, 22, 1),
(14, 23, 1),
(14, 24, 1),
(14, 25, 1),
(14, 26, 1),
(14, 27, 1),
(14, 28, 1),
(14, 29, 1),
(14, 30, 1),
(15, 1, 1),
(15, 3, 1),
(15, 4, 1),
(15, 5, 1),
(15, 7, 1),
(15, 8, 1),
(15, 9, 1),
(15, 10, 1),
(15, 11, 1),
(15, 13, 1),
(15, 14, 1),
(15, 15, 1),
(15, 18, 1),
(15, 19, 1),
(15, 16, 1),
(15, 20, 1),
(15, 21, 1),
(15, 22, 1),
(15, 23, 1),
(15, 24, 1),
(15, 25, 1),
(15, 27, 1),
(15, 29, 1),
(15, 30, 1),
(16, 1, 0),
(17, 1, 1),
(17, 7, 1),
(17, 14, 1),
(17, 20, 1),
(17, 23, 1),
(17, 27, 1),
(18, 1, 1),
(18, 4, 1),
(18, 7, 1),
(18, 8, 1),
(18, 9, 1),
(18, 13, 1),
(18, 14, 1),
(18, 15, 1),
(18, 18, 1),
(18, 19, 1),
(18, 16, 1),
(18, 20, 1),
(18, 21, 1),
(18, 22, 1),
(18, 23, 1),
(18, 24, 1),
(18, 25, 1),
(18, 27, 1),
(18, 29, 1),
(19, 1, 1),
(19, 7, 1),
(19, 14, 1),
(19, 20, 1),
(20, 1, 1),
(20, 3, 1),
(20, 4, 1),
(20, 7, 1),
(20, 8, 1),
(20, 9, 1),
(20, 13, 1),
(20, 14, 1),
(20, 18, 1),
(20, 19, 1),
(20, 16, 1),
(20, 20, 1),
(20, 21, 1),
(20, 22, 1),
(20, 23, 1),
(20, 24, 1),
(20, 25, 1),
(20, 27, 1),
(20, 29, 1),
(20, 15, 0),
(21, 1, 1),
(21, 3, 1),
(21, 4, 1),
(21, 5, 1),
(21, 7, 1),
(21, 8, 1),
(21, 9, 1),
(21, 10, 1),
(21, 11, 1),
(21, 13, 1),
(21, 14, 1),
(21, 15, 1),
(21, 17, 1),
(21, 18, 1),
(21, 19, 1),
(21, 16, 1),
(21, 20, 1),
(21, 21, 1),
(21, 22, 1),
(21, 23, 1),
(21, 24, 1),
(21, 25, 1),
(21, 27, 1),
(21, 29, 1),
(21, 30, 1);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_acl_users`
-- 

CREATE TABLE `phpbb_acl_users` (
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `forum_id` mediumint(8) unsigned NOT NULL default '0',
  `auth_option_id` mediumint(8) unsigned NOT NULL default '0',
  `auth_role_id` mediumint(8) unsigned NOT NULL default '0',
  `auth_setting` tinyint(2) NOT NULL default '0',
  KEY `user_id` (`user_id`),
  KEY `auth_option_id` (`auth_option_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- 导出表中的数据 `phpbb_acl_users`
-- 

INSERT INTO `phpbb_acl_users` (`user_id`, `forum_id`, `auth_option_id`, `auth_role_id`, `auth_setting`) VALUES 
(2, 0, 0, 5, 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_attachments`
-- 

CREATE TABLE `phpbb_attachments` (
  `attach_id` mediumint(8) unsigned NOT NULL auto_increment,
  `post_msg_id` mediumint(8) unsigned NOT NULL default '0',
  `topic_id` mediumint(8) unsigned NOT NULL default '0',
  `in_message` tinyint(1) unsigned NOT NULL default '0',
  `poster_id` mediumint(8) unsigned NOT NULL default '0',
  `physical_filename` varchar(255) NOT NULL default '',
  `real_filename` varchar(255) NOT NULL default '',
  `download_count` mediumint(8) unsigned NOT NULL default '0',
  `comment` text,
  `extension` varchar(100) default NULL,
  `mimetype` varchar(100) default NULL,
  `filesize` int(20) unsigned NOT NULL default '0',
  `filetime` int(11) unsigned NOT NULL default '0',
  `thumbnail` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`attach_id`),
  KEY `filetime` (`filetime`),
  KEY `post_msg_id` (`post_msg_id`),
  KEY `topic_id` (`topic_id`),
  KEY `poster_id` (`poster_id`),
  KEY `physical_filename` (`physical_filename`(10)),
  KEY `filesize` (`filesize`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `phpbb_attachments`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_banlist`
-- 

CREATE TABLE `phpbb_banlist` (
  `ban_id` mediumint(8) unsigned NOT NULL auto_increment,
  `ban_userid` mediumint(8) unsigned NOT NULL default '0',
  `ban_ip` varchar(40) NOT NULL default '',
  `ban_email` varchar(100) NOT NULL default '',
  `ban_start` int(11) NOT NULL default '0',
  `ban_end` int(11) NOT NULL default '0',
  `ban_exclude` tinyint(1) NOT NULL default '0',
  `ban_reason` text,
  `ban_give_reason` text,
  PRIMARY KEY  (`ban_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `phpbb_banlist`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_bbcodes`
-- 

CREATE TABLE `phpbb_bbcodes` (
  `bbcode_id` tinyint(3) unsigned NOT NULL default '0',
  `bbcode_tag` varchar(16) NOT NULL default '',
  `display_on_posting` tinyint(1) unsigned NOT NULL default '0',
  `bbcode_match` varchar(255) NOT NULL default '',
  `bbcode_tpl` text,
  `first_pass_match` varchar(255) NOT NULL default '',
  `first_pass_replace` varchar(255) NOT NULL default '',
  `second_pass_match` varchar(255) NOT NULL default '',
  `second_pass_replace` text,
  PRIMARY KEY  (`bbcode_id`),
  KEY `display_in_posting` (`display_on_posting`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- 导出表中的数据 `phpbb_bbcodes`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_bookmarks`
-- 

CREATE TABLE `phpbb_bookmarks` (
  `topic_id` mediumint(8) unsigned NOT NULL default '0',
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `order_id` mediumint(8) unsigned NOT NULL default '0',
  KEY `order_id` (`order_id`),
  KEY `topic_user_id` (`topic_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- 导出表中的数据 `phpbb_bookmarks`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_bots`
-- 

CREATE TABLE `phpbb_bots` (
  `bot_id` tinyint(3) unsigned NOT NULL auto_increment,
  `bot_active` tinyint(1) NOT NULL default '1',
  `bot_name` text,
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `bot_agent` varchar(255) NOT NULL default '',
  `bot_ip` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`bot_id`),
  KEY `bot_active` (`bot_active`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- 
-- 导出表中的数据 `phpbb_bots`
-- 

INSERT INTO `phpbb_bots` (`bot_id`, `bot_active`, `bot_name`, `user_id`, `bot_agent`, `bot_ip`) VALUES 
(1, 1, 'Alexa', 3, 'ia_archiver', '66.28.250.,209.237.238.'),
(2, 1, 'Fastcrawler', 4, 'FAST MetaWeb Crawler', '66.151.181.'),
(3, 1, 'Googlebot', 5, 'Googlebot/', ''),
(4, 1, 'Inktomi', 6, 'Slurp/', '216.35.116.,66.196.');

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_build_construct`
-- 

CREATE TABLE `phpbb_build_construct` (
  `cbuild_id` int(10) NOT NULL default '0',
  `starttime` int(10) NOT NULL default '0',
  `endtime` int(10) NOT NULL default '0',
  `buildtype` smallint(2) NOT NULL default '0',
  PRIMARY KEY  (`cbuild_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='建设记录';

-- 
-- 导出表中的数据 `phpbb_build_construct`
-- 

INSERT INTO `phpbb_build_construct` (`cbuild_id`, `starttime`, `endtime`, `buildtype`) VALUES 
(2, 0, 1167468145, 1);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_build_info`
-- 

CREATE TABLE `phpbb_build_info` (
  `build_id` int(10) NOT NULL auto_increment,
  `build_name` varchar(40) collate utf8_unicode_ci NOT NULL default '0',
  `build_desc` text collate utf8_unicode_ci NOT NULL,
  `build_open` tinyint(2) NOT NULL default '0',
  `build_owner` varchar(30) collate utf8_unicode_ci NOT NULL default '0',
  `build_ownerid` int(10) NOT NULL default '0',
  `build_user` varchar(20) collate utf8_unicode_ci NOT NULL default '',
  `build_userid` int(10) NOT NULL default '0',
  `build_date` int(10) NOT NULL default '0',
  `build_level` tinyint(2) NOT NULL default '1',
  `build_show` smallint(6) NOT NULL default '0',
  `build_type` tinyint(2) NOT NULL default '1',
  `system_type` smallint(6) NOT NULL default '1',
  `build_gcoin` int(10) NOT NULL default '0',
  `build_scoin` int(10) NOT NULL default '0',
  `build_ccoin` int(10) NOT NULL default '0',
  `build_cess` int(10) NOT NULL default '0',
  `build_cess_stat` int(10) NOT NULL default '0',
  `item_count` smallint(6) NOT NULL default '4',
  `product_type` tinyint(2) NOT NULL default '1',
  `country` int(10) NOT NULL default '0',
  `city_id` int(10) NOT NULL default '0',
  `hardiness` int(10) NOT NULL default '0',
  `build_hot` smallint(4) NOT NULL default '0',
  `zone_id` int(10) NOT NULL default '0',
  `build_ground` int(10) NOT NULL default '100',
  PRIMARY KEY  (`build_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- 
-- 导出表中的数据 `phpbb_build_info`
-- 

INSERT INTO `phpbb_build_info` (`build_id`, `build_name`, `build_desc`, `build_open`, `build_owner`, `build_ownerid`, `build_user`, `build_userid`, `build_date`, `build_level`, `build_show`, `build_type`, `system_type`, `build_gcoin`, `build_scoin`, `build_ccoin`, `build_cess`, `build_cess_stat`, `item_count`, `product_type`, `country`, `city_id`, `hardiness`, `build_hot`, `zone_id`, `build_ground`) VALUES 
(1, '卡利普拉贸易市场', 'ä½äºŽä¹Œé²çš„å¡åˆ©æ™®æ‹‰è´¸æ˜“å¸‚åœºæ‹¥æœ‰äº†ä¸‰ç™¾å¤šå¹´çš„åŽ†å²äº†,ä»Žè¥¿å¤§é™†æ¥çš„å•†é˜Ÿéƒ½ä¼šé€‰æ‹©è¿™é‡Œè·Ÿç”Ÿæ¯å¹³åŽŸçš„å•†äººä»¬åšç”Ÿæ„,ç”Ÿæ´»åœ¨å¤§æ¼ ä¸­çš„å†’é™©è€…ä»¬ä¹Ÿå–œæ¬¢åœ¨è¿™é‡Œè´­ä¹°è¡¥ç»™å’Œå‡ºå”®ä»–ä»¬çš„æˆ˜åˆ©å“.', 1, '', 0, '', 0, 0, 1, 0, 1, 504, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 2, 100),
(2, '同仁堂', '', 2, '0', 0, '', 0, 0, 1, 0, 1, 507, 0, 0, 0, 0, 0, 4, 1, 0, 1, 0, 1, 6, 100),
(3, '工匠工会', '', 1, '0', 0, '', 0, 0, 1, 0, 1, 306, 0, 0, 0, 0, 0, 4, 1, 0, 1, 0, 1, 3, 100);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_city_bank`
-- 

CREATE TABLE `phpbb_city_bank` (
  `user_id` int(11) unsigned NOT NULL auto_increment,
  `u_copper_coin` int(11) NOT NULL default '0',
  `u_silver_coin` int(11) NOT NULL default '0',
  `u_gold_coin` int(11) NOT NULL default '0',
  `user_regdate` int(11) NOT NULL default '0',
  `user_credit` int(10) NOT NULL default '0',
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

-- 
-- 导出表中的数据 `phpbb_city_bank`
-- 

INSERT INTO `phpbb_city_bank` (`user_id`, `u_copper_coin`, `u_silver_coin`, `u_gold_coin`, `user_regdate`, `user_credit`) VALUES 
(2, 5, 2, 0, 0, 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_city_bank_log`
-- 

CREATE TABLE `phpbb_city_bank_log` (
  `logid` int(11) unsigned NOT NULL auto_increment,
  `user_id` int(11) unsigned NOT NULL default '0',
  `title` varchar(250) collate utf8_unicode_ci NOT NULL default '',
  `typeid` tinyint(1) NOT NULL default '0',
  `logdate` int(11) NOT NULL default '0',
  PRIMARY KEY  (`logid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

-- 
-- 导出表中的数据 `phpbb_city_bank_log`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_city_info`
-- 

CREATE TABLE `phpbb_city_info` (
  `city_id` int(10) NOT NULL auto_increment,
  `city_name` varchar(40) collate utf8_unicode_ci NOT NULL default '',
  `city_desc` text collate utf8_unicode_ci NOT NULL,
  `city_welcome` varchar(80) collate utf8_unicode_ci NOT NULL default '',
  `city_base` smallint(2) NOT NULL default '1',
  `city_location` tinyint(4) NOT NULL default '0',
  `city_protection` int(10) NOT NULL default '0',
  `city_date` int(10) NOT NULL default '0',
  `city_build` tinyint(2) NOT NULL default '0',
  `city_type` smallint(6) NOT NULL default '0',
  `city_style` smallint(6) NOT NULL default '1',
  `city_population` tinyint(4) NOT NULL default '0',
  `city_lv` smallint(2) default '0',
  `city_cess` smallint(3) default '0',
  `city_cess_money` int(10) default '0',
  `city_magic_recovery` int(10) default '0',
  `city_castellan` varchar(30) collate utf8_unicode_ci default NULL,
  `city_castellan_id` int(10) default '0',
  `city_money_g` int(10) unsigned NOT NULL default '0',
  `city_money_s` int(10) unsigned NOT NULL default '0',
  `city_money_c` int(10) default '0',
  `city_lasttime` int(10) default '0',
  `city_state` smallint(2) default NULL,
  `city_ground` int(10) NOT NULL default '0',
  `city_xy` varchar(250) collate utf8_unicode_ci NOT NULL default '',
  `city_rice` int(10) NOT NULL default '0',
  `city_pollute` int(10) NOT NULL default '0',
  `country_id` smallint(6) NOT NULL default '0',
  `sowntown` int(10) NOT NULL default '0',
  `residentialarea` int(10) NOT NULL default '0',
  PRIMARY KEY  (`city_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- 
-- 导出表中的数据 `phpbb_city_info`
-- 

INSERT INTO `phpbb_city_info` (`city_id`, `city_name`, `city_desc`, `city_welcome`, `city_base`, `city_location`, `city_protection`, `city_date`, `city_build`, `city_type`, `city_style`, `city_population`, `city_lv`, `city_cess`, `city_cess_money`, `city_magic_recovery`, `city_castellan`, `city_castellan_id`, `city_money_g`, `city_money_s`, `city_money_c`, `city_lasttime`, `city_state`, `city_ground`, `city_xy`, `city_rice`, `city_pollute`, `country_id`, `sowntown`, `residentialarea`) VALUES 
(1, '乌鲁城', '', 'æ¬¢è¿Žæ¥åˆ°ä¹Œé²åŸŽ', 1, 1, 0, 0, 0, 1, 1, 0, 3, 0, 0, 0, NULL, 0, 0, 0, 0, 0, NULL, 2340, '80000,0', 0, 800, 0, 1200, 600),
(2, '史坎布雷', 'ç”Ÿæ¯å¹³åŽŸä¸Šä¸­å¿ƒåœ°åŒºçš„ä¸€åº§åŸŽå¸‚ï¼Œæ›¾ç»æ˜¯å¡æ›¼çŽ‹æœçš„éƒ½åŸŽï¼Œäº”ç™¾å¹´æ¥ä¸€ç›´ä¿å­˜çš„å¾ˆå®Œå¥½ã€‚', 'æ¬¢è¿Žæ¥åˆ°å²åŽå¸ƒé›·', 2, 5, 0, 0, 0, 1, 1, 0, 1, 0, 0, 0, NULL, 0, 0, 0, 0, 0, NULL, 0, '', 0, 800, 0, 0, 0),
(3, '东角城', 'å¤§é™†ä¸œå—çš„æ¸¯å£åŸŽå¸‚,è¿™é‡Œæ˜¯æµ·ä¸Šå†’é™©å®¶,å’Œå•†äººä»¬çš„å¤©å ‚', 'æ¬¢è¿Žæ¥ä¸œè§’', 3, 0, 0, 0, 0, 0, 1, 0, 1, 0, 0, 0, NULL, 0, 0, 0, 0, 0, NULL, 0, '', 0, 800, 0, 0, 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_city_license`
-- 

CREATE TABLE `phpbb_city_license` (
  `recordid` int(10) NOT NULL auto_increment,
  `cityid` int(10) NOT NULL default '0',
  `licenseid` int(10) NOT NULL default '0',
  `creat_time` int(10) NOT NULL default '0',
  `useful_life` int(10) NOT NULL default '0',
  `price` int(10) NOT NULL default '0',
  `licensetype` smallint(6) NOT NULL default '1',
  `licensenum` int(10) NOT NULL default '0',
  `licenseallow` int(10) NOT NULL default '0',
  `allowlv` smallint(6) unsigned NOT NULL default '1',
  PRIMARY KEY  (`recordid`),
  UNIQUE KEY `city_license` (`cityid`,`licenseid`,`licensetype`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

-- 
-- 导出表中的数据 `phpbb_city_license`
-- 

INSERT INTO `phpbb_city_license` (`recordid`, `cityid`, `licenseid`, `creat_time`, `useful_life`, `price`, `licensetype`, `licensenum`, `licenseallow`, `allowlv`) VALUES 
(1, 1, 4, 0, 7200, 200, 1, 0, 0, 1),
(2, 1, 5, 0, 7200, 200, 1, 0, 0, 1),
(3, 1, 201, 0, 0, 50, 2, 21, 0, 1),
(4, 1, 4, 0, 0, 800, 3, 0, 0, 1);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_city_road`
-- 

CREATE TABLE `phpbb_city_road` (
  `road_id` int(10) NOT NULL auto_increment,
  `city1` int(10) NOT NULL default '0',
  `city2` int(10) NOT NULL default '0',
  `numerical_value` int(10) NOT NULL default '0',
  `level` smallint(4) NOT NULL default '0',
  `creat_date` int(10) NOT NULL default '0',
  `application1` tinyint(1) NOT NULL default '0',
  `application2` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`road_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- 
-- 导出表中的数据 `phpbb_city_road`
-- 

INSERT INTO `phpbb_city_road` (`road_id`, `city1`, `city2`, `numerical_value`, `level`, `creat_date`, `application1`, `application2`) VALUES 
(1, 1, 2, 0, 0, 1143428162, 1, 1),
(2, 1, 3, 0, 0, 1143428162, 0, 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_city_tech`
-- 

CREATE TABLE `phpbb_city_tech` (
  `city_id` int(10) NOT NULL default '0',
  `city_build_lv` smallint(6) NOT NULL default '0',
  `city_build_outlay` int(10) NOT NULL default '0',
  `city_build_star` int(10) unsigned NOT NULL default '0',
  `city_build_study` int(10) NOT NULL default '0',
  PRIMARY KEY  (`city_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- 导出表中的数据 `phpbb_city_tech`
-- 

INSERT INTO `phpbb_city_tech` (`city_id`, `city_build_lv`, `city_build_outlay`, `city_build_star`, `city_build_study`) VALUES 
(1, 1, 0, 0, 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_city_zone`
-- 

CREATE TABLE `phpbb_city_zone` (
  `zoneid` int(10) unsigned NOT NULL auto_increment,
  `zonetitle` varchar(60) collate utf8_unicode_ci NOT NULL default '',
  `zoneordy` smallint(6) NOT NULL default '0',
  `zoneacreage` smallint(6) NOT NULL default '0',
  `zonetype` tinyint(2) NOT NULL default '0',
  `zonestate` smallint(2) NOT NULL default '0',
  `parentid` smallint(6) NOT NULL default '0',
  `zoneprice_g` int(10) NOT NULL default '0',
  `zoneprice_s` int(10) NOT NULL default '0',
  `zoneprice_c` int(10) NOT NULL default '0',
  `zoneuser_id` int(10) NOT NULL default '0',
  `city_id` int(10) NOT NULL default '0',
  PRIMARY KEY  (`zoneid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

-- 
-- 导出表中的数据 `phpbb_city_zone`
-- 

INSERT INTO `phpbb_city_zone` (`zoneid`, `zonetitle`, `zoneordy`, `zoneacreage`, `zonetype`, `zonestate`, `parentid`, `zoneprice_g`, `zoneprice_s`, `zoneprice_c`, `zoneuser_id`, `city_id`) VALUES 
(1, '曼哈顿一区', 1, 500, 1, 0, 0, 0, 0, 0, 0, 1),
(2, '', 1, 100, 2, 1, 1, 0, 1, 0, 0, 1),
(3, '', 2, 100, 2, 1, 1, 0, 0, 500, 0, 1),
(4, '', 3, 100, 2, 0, 1, 0, 0, 450, 2, 1),
(5, '', 4, 100, 2, 0, 1, 0, 0, 430, 0, 1),
(6, '', 5, 100, 2, 2, 1, 0, 0, 500, 2, 1),
(7, '八宝山一区', 1, 80, 3, 0, 0, 0, 0, 0, 0, 1),
(8, '', 1, 20, 4, 0, 7, 0, 0, 120, 0, 1);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_config`
-- 

CREATE TABLE `phpbb_config` (
  `config_name` varchar(255) NOT NULL default '',
  `config_value` varchar(255) NOT NULL default '',
  `is_dynamic` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`config_name`),
  KEY `is_dynamic` (`is_dynamic`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- 导出表中的数据 `phpbb_config`
-- 

INSERT INTO `phpbb_config` (`config_name`, `config_value`, `is_dynamic`) VALUES 
('active_sessions', '0', 0),
('allow_attachments', '1', 0),
('allow_autologin', '1', 0),
('allow_avatar_local', '0', 0),
('allow_avatar_remote', '0', 0),
('allow_avatar_upload', '0', 0),
('allow_bbcode', '1', 0),
('allow_bookmarks', '1', 0),
('allow_emailreuse', '0', 0),
('allow_forum_notify', '1', 0),
('allow_mass_pm', '1', 0),
('allow_name_chars', '.*', 0),
('allow_namechange', '0', 0),
('allow_nocensors', '0', 0),
('allow_pm_attach', '0', 0),
('allow_privmsg', '1', 0),
('allow_sig', '1', 0),
('allow_sig_bbcode', '1', 0),
('allow_sig_flash', '0', 0),
('allow_sig_img', '1', 0),
('allow_sig_pm', '1', 0),
('allow_sig_smilies', '1', 0),
('allow_smilies', '1', 0),
('allow_topic_notify', '1', 0),
('attachment_quota', '52428800', 0),
('auth_bbcode_pm', '1', 0),
('auth_download_pm', '1', 0),
('auth_flash_pm', '0', 0),
('auth_img_pm', '1', 0),
('auth_method', 'db', 0),
('auth_smilies_pm', '1', 0),
('avatar_filesize', '6144', 0),
('avatar_gallery_path', 'images/avatars/gallery', 0),
('avatar_max_height', '90', 0),
('avatar_max_width', '90', 0),
('avatar_min_height', '20', 0),
('avatar_min_width', '20', 0),
('avatar_path', 'images/avatars/upload', 0),
('board_contact', 'ientium@sina.com', 0),
('board_disable', '0', 0),
('board_disable_msg', '', 0),
('board_dst', '0', 0),
('board_email', 'ientium@sina.com', 0),
('board_email_form', '0', 0),
('board_email_sig', 'Thanks, The Management', 0),
('board_hide_emails', '1', 0),
('board_timezone', '0', 0),
('browser_check', '0', 0),
('bump_interval', '10', 0),
('bump_type', 'd', 0),
('cache_gc', '7200', 0),
('chg_passforce', '0', 0),
('cookie_domain', 'mycity.novsoft.com', 0),
('cookie_name', 'phpbb3', 0),
('cookie_path', '/', 0),
('cookie_secure', '0', 0),
('coppa_enable', '0', 0),
('coppa_fax', '', 0),
('coppa_hide_groups', '1', 0),
('coppa_mail', '', 0),
('database_gc', '604800', 0),
('default_dateformat', 'Y-m-d, H:i', 0),
('default_style', '1', 0),
('display_last_edited', '1', 0),
('display_order', '0', 0),
('edit_time', '0', 0),
('email_enable', '0', 0),
('email_function_name', 'mail', 0),
('email_package_size', '50', 0),
('enable_confirm', '1', 0),
('enable_pm_icons', '1', 0),
('enable_post_confirm', '1', 0),
('flood_interval', '15', 0),
('force_server_vars', '0', 0),
('forward_pm', '1', 0),
('full_folder_action', '2', 0),
('fulltext_mysql_max_word_len', '254', 0),
('fulltext_mysql_min_word_len', '4', 0),
('fulltext_native_load_upd', '1', 0),
('fulltext_native_max_chars', '14', 0),
('fulltext_native_min_chars', '3', 0),
('gzip_compress', '0', 0),
('hot_threshold', '25', 0),
('icons_path', 'images/icons', 0),
('img_create_thumbnail', '0', 0),
('img_display_inlined', '1', 0),
('img_imagick', '', 0),
('img_link_height', '0', 0),
('img_link_width', '0', 0),
('img_max_height', '0', 0),
('img_max_width', '0', 0),
('img_min_thumb_filesize', '12000', 0),
('ip_check', '4', 0),
('jab_enable', '0', 0),
('jab_host', '', 0),
('jab_password', '', 0),
('jab_package_size', '20', 0),
('jab_port', '5222', 0),
('jab_resource', '', 0),
('jab_username', '', 0),
('ldap_base_dn', '', 0),
('ldap_server', '', 0),
('ldap_uid', '', 0),
('limit_load', '0', 0),
('limit_search_load', '0', 0),
('load_birthdays', '1', 0),
('load_cpf_memberlist', '0', 0),
('load_cpf_viewprofile', '1', 0),
('load_cpf_viewtopic', '0', 0),
('load_db_lastread', '1', 0),
('load_db_track', '1', 0),
('load_onlinetrack', '1', 0),
('load_jumpbox', '1', 0),
('load_moderators', '1', 0),
('load_online', '1', 0),
('load_online_guests', '1', 0),
('load_online_time', '5', 0),
('load_search', '1', 0),
('load_tplcompile', '1', 0),
('load_user_activity', '1', 0),
('max_attachments', '3', 0),
('max_attachments_pm', '1', 0),
('max_autologin_time', '0', 0),
('max_filesize', '262144', 0),
('max_filesize_pm', '262144', 0),
('max_login_attempts', '3', 0),
('max_name_chars', '20', 0),
('max_pass_chars', '30', 0),
('max_poll_options', '10', 0),
('max_post_chars', '0', 0),
('max_post_font_size', '0', 0),
('max_post_img_height', '0', 0),
('max_post_img_width', '0', 0),
('max_post_smilies', '0', 0),
('max_post_urls', '0', 0),
('max_quote_depth', '3', 0),
('max_reg_attempts', '5', 0),
('max_sig_chars', '255', 0),
('max_sig_font_size', '24', 0),
('max_sig_img_height', '0', 0),
('max_sig_img_width', '0', 0),
('max_sig_smilies', '0', 0),
('max_sig_urls', '5', 0),
('min_name_chars', '3', 0),
('min_pass_chars', '6', 0),
('min_search_author_chars', '3', 0),
('override_user_style', '0', 0),
('pass_complex', '.*', 0),
('pm_edit_time', '0', 0),
('pm_max_boxes', '4', 0),
('pm_max_msgs', '50', 0),
('policy_overlap', '0', 0),
('policy_overlap_noise_pixel', '1', 0),
('policy_overlap_noise_line', '1', 0),
('policy_entropy', '1', 0),
('policy_entropy_noise_pixel', '2', 0),
('policy_entropy_noise_line', '1', 0),
('policy_shape', '1', 0),
('policy_shape_noise_pixel', '1', 0),
('policy_shape_noise_line', '1', 0),
('policy_3dbitmap', '0', 0),
('policy_cells', '0', 0),
('policy_stencil', '0', 0),
('policy_composite', '0', 0),
('posts_per_page', '10', 0),
('print_pm', '1', 0),
('queue_interval', '600', 0),
('ranks_path', 'images/ranks', 0),
('require_activation', '0', 0),
('search_block_size', '250', 0),
('search_gc', '7200', 0),
('search_indexing_state', '', 0),
('search_interval', '0', 0),
('search_anonymous_interval', '0', 0),
('search_type', 'fulltext_native', 0),
('search_store_results', '1800', 0),
('secure_allow_deny', '1', 0),
('secure_allow_empty_referer', '1', 0),
('secure_downloads', '0', 0),
('send_encoding', '0', 0),
('server_name', 'mycity.novsoft.com', 0),
('server_port', '80', 0),
('server_protocol', 'http://', 0),
('session_gc', '3600', 0),
('session_length', '3600', 0),
('site_desc', 'A _little_ text to describe your forum', 0),
('sitename', 'yourdomain.com', 0),
('smilies_path', 'images/smilies', 0),
('smtp_auth_method', 'PLAIN', 0),
('smtp_delivery', '0', 0),
('smtp_host', '', 0),
('smtp_password', '', 0),
('smtp_port', '25', 0),
('smtp_username', '', 0),
('topics_per_page', '25', 0),
('tpl_allow_php', '0', 0),
('upload_icons_path', 'images/upload_icons', 0),
('upload_path', 'files', 0),
('version', '3.0.B1', 0),
('warnings_expire_days', '90', 0),
('warnings_gc', '14400', 0),
('cache_last_gc', '1168587185', 1),
('database_last_gc', '1168474653', 1),
('last_queue_run', '0', 1),
('newest_user_id', '2', 1),
('newest_username', 'PROSE', 1),
('num_files', '0', 1),
('num_posts', '1', 1),
('num_topics', '1', 1),
('num_users', '1', 1),
('rand_seed', '315ed4d214e96e94a22043637d261d10', 1),
('record_online_date', '1167211570', 1),
('record_online_users', '2', 1),
('search_last_gc', '1168587188', 1),
('session_last_gc', '1168587199', 1),
('upload_dir_size', '0', 1),
('warnings_last_gc', '1168579499', 1),
('board_startdate', '1167211017', 0),
('default_lang', 'zh_CN', 0),
('activity_base', '200', 0),
('activity_last_time', '1166973614', 0),
('activity_time', '3600', 0),
('activity_add', '30', 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_confirm`
-- 

CREATE TABLE `phpbb_confirm` (
  `confirm_id` varchar(32) NOT NULL default '',
  `session_id` varchar(32) NOT NULL default '',
  `confirm_type` tinyint(3) NOT NULL default '0',
  `code` varchar(8) NOT NULL default '',
  PRIMARY KEY  (`session_id`,`confirm_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- 导出表中的数据 `phpbb_confirm`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_confraternity_formula`
-- 

CREATE TABLE `phpbb_confraternity_formula` (
  `con_id` int(10) unsigned NOT NULL auto_increment,
  `buildid` int(10) unsigned NOT NULL default '0',
  `cityid` int(10) NOT NULL default '0',
  `formulaid` int(10) NOT NULL default '0',
  `price_g` int(10) NOT NULL default '0',
  `price_s` int(10) NOT NULL default '0',
  `price_c` int(10) NOT NULL default '0',
  PRIMARY KEY  (`con_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- 
-- 导出表中的数据 `phpbb_confraternity_formula`
-- 

INSERT INTO `phpbb_confraternity_formula` (`con_id`, `buildid`, `cityid`, `formulaid`, `price_g`, `price_s`, `price_c`) VALUES 
(1, 3, 1, 1, 0, 0, 20);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_confraternity_skills`
-- 

CREATE TABLE `phpbb_confraternity_skills` (
  `recordid` int(10) unsigned NOT NULL auto_increment,
  `skillid` int(10) unsigned NOT NULL default '0',
  `buildid` int(10) unsigned NOT NULL default '0',
  `price_c` int(10) NOT NULL default '0',
  `price_s` int(10) NOT NULL default '0',
  `price_g` int(10) NOT NULL default '0',
  `cityid` smallint(6) NOT NULL default '0',
  PRIMARY KEY  (`recordid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

-- 
-- 导出表中的数据 `phpbb_confraternity_skills`
-- 

INSERT INTO `phpbb_confraternity_skills` (`recordid`, `skillid`, `buildid`, `price_c`, `price_s`, `price_g`, `cityid`) VALUES 
(1, 1, 3, 20, 0, 0, 1),
(2, 2, 3, 20, 0, 0, 1),
(3, 3, 3, 20, 0, 0, 1),
(4, 4, 3, 2, 0, 0, 1);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_country_info`
-- 

CREATE TABLE `phpbb_country_info` (
  `country_id` smallint(6) NOT NULL default '0',
  `country_name` varchar(30) collate utf8_unicode_ci NOT NULL default '',
  `country_desc` varchar(240) collate utf8_unicode_ci NOT NULL default '',
  `country_date` int(10) NOT NULL default '0',
  `country_logo` varchar(100) collate utf8_unicode_ci NOT NULL default '',
  `country_location` tinyint(2) NOT NULL default '0',
  `country_population` smallint(6) NOT NULL default '0',
  `country_city` tinyint(4) NOT NULL default '0',
  `country_money` int(8) NOT NULL default '0',
  `country_level` tinyint(2) NOT NULL default '1',
  `country_state` tinyint(2) NOT NULL default '0',
  `country_kingname` varchar(30) collate utf8_unicode_ci NOT NULL default '',
  `country_kongid` int(10) NOT NULL default '0',
  `build_lv` tinyint(2) NOT NULL default '1',
  `build_exp` int(10) NOT NULL default '0',
  `build_money` int(10) NOT NULL default '0',
  `tech_lv` tinyint(2) NOT NULL default '1',
  `tech_exp` int(10) NOT NULL default '0',
  `tech_money` int(10) NOT NULL default '0',
  `making_lv` tinyint(2) NOT NULL default '1',
  `making_exp` int(10) NOT NULL default '0',
  `making_money` int(10) NOT NULL default '0',
  `military_lv` tinyint(2) NOT NULL default '1',
  `military_exp` int(10) NOT NULL default '0',
  `military_money` int(10) NOT NULL default '0',
  `magic_lv` tinyint(2) NOT NULL default '1',
  `magic_exp` int(10) NOT NULL default '0',
  `magic_money` int(10) NOT NULL default '0',
  `civi_lv` tinyint(2) NOT NULL default '1',
  `civi_exp` int(10) NOT NULL default '0',
  `civi_money` int(10) NOT NULL default '0',
  `country_lasttime` int(10) NOT NULL default '0',
  `country_left_up` smallint(6) NOT NULL default '0',
  `country_left` smallint(6) NOT NULL default '0',
  `country_left_down` smallint(6) NOT NULL default '0',
  `country_up` smallint(6) NOT NULL default '0',
  `country_down` smallint(6) NOT NULL default '0',
  `country_right_up` smallint(6) NOT NULL default '0',
  `country_right` smallint(6) NOT NULL default '0',
  `country_right_down` smallint(6) NOT NULL default '0',
  `country_woods` int(10) NOT NULL default '0',
  `country_ores` int(10) NOT NULL default '0',
  `country_contamination` int(10) NOT NULL default '0',
  `country_morale` int(10) NOT NULL default '0',
  PRIMARY KEY  (`country_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- 导出表中的数据 `phpbb_country_info`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_disallow`
-- 

CREATE TABLE `phpbb_disallow` (
  `disallow_id` mediumint(8) unsigned NOT NULL auto_increment,
  `disallow_username` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`disallow_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `phpbb_disallow`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_drafts`
-- 

CREATE TABLE `phpbb_drafts` (
  `draft_id` mediumint(8) unsigned NOT NULL auto_increment,
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `topic_id` mediumint(8) unsigned NOT NULL default '0',
  `forum_id` mediumint(8) unsigned NOT NULL default '0',
  `save_time` int(11) unsigned NOT NULL default '0',
  `draft_subject` text,
  `draft_message` mediumtext,
  PRIMARY KEY  (`draft_id`),
  KEY `save_time` (`save_time`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `phpbb_drafts`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_event_probability`
-- 

CREATE TABLE `phpbb_event_probability` (
  `probabilityid` int(10) NOT NULL auto_increment,
  `event_id` int(10) NOT NULL default '0',
  `object_id` int(10) NOT NULL default '0',
  `city_id` varchar(10) collate utf8_unicode_ci NOT NULL default '0',
  `level` int(10) NOT NULL default '0',
  `s_numerator` int(10) NOT NULL default '1',
  `e_numerator` int(10) NOT NULL default '0',
  PRIMARY KEY  (`probabilityid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- 
-- 导出表中的数据 `phpbb_event_probability`
-- 

INSERT INTO `phpbb_event_probability` (`probabilityid`, `event_id`, `object_id`, `city_id`, `level`, `s_numerator`, `e_numerator`) VALUES 
(1, 101, 4, '1', 0, 1, 12000),
(2, 101, 5, '1', 0, 12001, 48000);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_exp`
-- 

CREATE TABLE `phpbb_exp` (
  `Level` smallint(6) NOT NULL default '0',
  `base_Exp` decimal(8,0) NOT NULL default '0',
  `att_exp` decimal(8,0) NOT NULL default '0',
  `next_attexp` decimal(8,0) NOT NULL default '0',
  `country_num` decimal(8,0) NOT NULL default '0',
  PRIMARY KEY  (`Level`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- 导出表中的数据 `phpbb_exp`
-- 

INSERT INTO `phpbb_exp` (`Level`, `base_Exp`, `att_exp`, `next_attexp`, `country_num`) VALUES 
(1, 51, 41, 93, 0),
(2, 137, 93, 147, 0),
(3, 235, 147, 203, 0),
(4, 351, 203, 261, 0),
(5, 491, 261, 321, 0),
(6, 661, 321, 383, 0),
(7, 867, 383, 447, 0),
(8, 1115, 447, 513, 0),
(9, 1411, 513, 581, 0),
(10, 1761, 581, 651, 0),
(11, 2171, 651, 723, 0),
(12, 2647, 723, 797, 0),
(13, 3195, 797, 873, 0),
(14, 3821, 873, 951, 0),
(15, 4531, 951, 1031, 0),
(16, 5331, 1031, 1113, 0),
(17, 6227, 1113, 1197, 0),
(18, 7225, 1197, 1283, 0),
(19, 8331, 1283, 1371, 0),
(20, 9551, 1371, 1461, 0),
(21, 10891, 1461, 1553, 0),
(22, 12357, 1553, 1647, 0),
(23, 13955, 1647, 1743, 0),
(24, 15691, 1743, 1841, 0),
(25, 17571, 1841, 1941, 0),
(26, 19601, 1941, 2043, 0),
(27, 21787, 2043, 2147, 0),
(28, 24135, 2147, 2253, 0),
(29, 26651, 2253, 2361, 0),
(30, 29341, 2361, 2471, 0),
(31, 32211, 2471, 2583, 0),
(32, 35267, 2583, 2697, 0),
(33, 38515, 2697, 2813, 0),
(34, 41961, 2813, 2931, 0),
(35, 45611, 2931, 3051, 0),
(36, 49471, 3051, 3173, 0),
(37, 53547, 3173, 3297, 0),
(38, 57845, 3297, 3423, 0),
(39, 62371, 3423, 3551, 0),
(40, 67131, 3551, 3681, 0),
(41, 72131, 3681, 3813, 0),
(42, 77377, 3813, 3947, 0),
(43, 82875, 3947, 4083, 0),
(44, 88631, 4083, 4221, 0),
(45, 94651, 4221, 4361, 0),
(46, 100941, 4361, 4503, 0),
(47, 107507, 4503, 4647, 0),
(48, 114355, 4647, 4793, 0),
(49, 121491, 4793, 4941, 0),
(50, 128921, 4941, 5091, 0),
(51, 136651, 5091, 5243, 0),
(52, 144687, 5243, 5397, 0),
(53, 153035, 5397, 5553, 0),
(54, 161701, 5553, 5711, 0),
(55, 170691, 5711, 5871, 0),
(56, 180011, 5871, 6033, 0),
(57, 189667, 6033, 6197, 0),
(58, 199665, 6197, 6363, 0),
(59, 210011, 6363, 6531, 0),
(60, 220711, 6531, 6701, 0),
(61, 231771, 6701, 6873, 0),
(62, 243197, 6873, 7047, 0),
(63, 254995, 7047, 7223, 0),
(64, 267171, 7223, 7401, 0),
(65, 279731, 7401, 7581, 0),
(66, 292681, 7581, 7763, 0),
(67, 306027, 7763, 7947, 0),
(68, 319775, 7947, 8133, 0),
(69, 333931, 8133, 8321, 0),
(70, 348501, 8321, 8511, 0),
(71, 363491, 8511, 8703, 0),
(72, 378907, 8703, 8897, 0),
(73, 394755, 8897, 9093, 0),
(74, 411041, 9093, 9291, 0),
(75, 427771, 9291, 9491, 0),
(76, 444951, 9491, 9693, 0),
(77, 462587, 9693, 9897, 0),
(78, 480685, 9897, 10103, 0),
(79, 499251, 10103, 10311, 0),
(80, 518291, 10311, 10521, 0),
(81, 537811, 10521, 10733, 0),
(82, 557817, 10733, 10947, 0),
(83, 578315, 10947, 11163, 0),
(84, 599311, 11163, 11381, 0),
(85, 620811, 11381, 11601, 0),
(86, 642821, 11601, 11823, 0),
(87, 665347, 11823, 12047, 0),
(88, 688395, 12047, 12273, 0),
(89, 711971, 12273, 12501, 0),
(90, 736081, 12501, 12731, 0),
(91, 760731, 12731, 12963, 0),
(92, 785927, 12963, 13197, 0),
(93, 811675, 13197, 13433, 0),
(94, 837981, 13433, 13671, 0),
(95, 864851, 13671, 13911, 0),
(96, 892291, 13911, 14153, 0),
(97, 920307, 14153, 14397, 0),
(98, 948905, 14397, 14643, 0),
(99, 978091, 14643, 14891, 0),
(100, 1007871, 14891, 15141, 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_extension_groups`
-- 

CREATE TABLE `phpbb_extension_groups` (
  `group_id` mediumint(8) NOT NULL auto_increment,
  `group_name` varchar(255) NOT NULL default '',
  `cat_id` tinyint(2) NOT NULL default '0',
  `allow_group` tinyint(1) NOT NULL default '0',
  `download_mode` tinyint(1) unsigned NOT NULL default '1',
  `upload_icon` varchar(255) NOT NULL default '',
  `max_filesize` int(20) NOT NULL default '0',
  `allowed_forums` text,
  `allow_in_pm` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- 
-- 导出表中的数据 `phpbb_extension_groups`
-- 

INSERT INTO `phpbb_extension_groups` (`group_id`, `group_name`, `cat_id`, `allow_group`, `download_mode`, `upload_icon`, `max_filesize`, `allowed_forums`, `allow_in_pm`) VALUES 
(1, 'Images', 1, 1, 1, '', 0, '', 0),
(2, 'Archives', 0, 1, 1, '', 0, '', 0),
(3, 'Plain Text', 0, 0, 1, '', 0, '', 0),
(4, 'Documents', 0, 0, 1, '', 0, '', 0),
(5, 'Real Media', 3, 0, 2, '', 0, '', 0),
(6, 'Windows Media', 2, 0, 1, '', 0, '', 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_extensions`
-- 

CREATE TABLE `phpbb_extensions` (
  `extension_id` mediumint(8) unsigned NOT NULL auto_increment,
  `group_id` mediumint(8) unsigned NOT NULL default '0',
  `extension` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`extension_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

-- 
-- 导出表中的数据 `phpbb_extensions`
-- 

INSERT INTO `phpbb_extensions` (`extension_id`, `group_id`, `extension`) VALUES 
(1, 1, 'gif'),
(2, 1, 'png'),
(3, 1, 'jpeg'),
(4, 1, 'jpg'),
(5, 1, 'tif'),
(6, 1, 'tga'),
(7, 2, 'gtar'),
(8, 2, 'gz'),
(9, 2, 'tar'),
(10, 2, 'zip'),
(11, 2, 'rar'),
(12, 2, 'ace'),
(13, 3, 'txt'),
(14, 3, 'c'),
(15, 3, 'h'),
(16, 3, 'cpp'),
(17, 3, 'hpp'),
(18, 3, 'diz'),
(19, 4, 'xls'),
(20, 4, 'doc'),
(21, 4, 'dot'),
(22, 4, 'pdf'),
(23, 4, 'ai'),
(24, 4, 'ps'),
(25, 4, 'ppt'),
(26, 5, 'rm'),
(27, 6, 'wma'),
(28, 6, 'wmv');

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_forums`
-- 

CREATE TABLE `phpbb_forums` (
  `forum_id` smallint(5) unsigned NOT NULL auto_increment,
  `parent_id` smallint(5) unsigned NOT NULL default '0',
  `left_id` smallint(5) unsigned NOT NULL default '0',
  `right_id` smallint(5) unsigned NOT NULL default '0',
  `forum_parents` text,
  `forum_name` text,
  `forum_desc` text,
  `forum_desc_bitfield` int(11) unsigned NOT NULL default '0',
  `forum_desc_uid` varchar(5) NOT NULL default '',
  `forum_link` varchar(255) NOT NULL default '',
  `forum_password` varchar(40) NOT NULL default '',
  `forum_style` tinyint(4) unsigned default NULL,
  `forum_image` varchar(255) NOT NULL default '',
  `forum_rules` text,
  `forum_rules_link` varchar(255) NOT NULL default '',
  `forum_rules_bitfield` int(11) unsigned NOT NULL default '0',
  `forum_rules_uid` varchar(5) NOT NULL default '',
  `forum_topics_per_page` tinyint(4) unsigned NOT NULL default '0',
  `forum_type` tinyint(4) NOT NULL default '0',
  `forum_status` tinyint(4) NOT NULL default '0',
  `forum_posts` mediumint(8) unsigned NOT NULL default '0',
  `forum_topics` mediumint(8) unsigned NOT NULL default '0',
  `forum_topics_real` mediumint(8) unsigned NOT NULL default '0',
  `forum_last_post_id` mediumint(8) unsigned NOT NULL default '0',
  `forum_last_poster_id` mediumint(8) NOT NULL default '0',
  `forum_last_post_time` int(11) NOT NULL default '0',
  `forum_last_poster_name` varchar(255) default NULL,
  `forum_flags` tinyint(4) NOT NULL default '0',
  `display_on_index` tinyint(1) NOT NULL default '1',
  `enable_indexing` tinyint(1) NOT NULL default '1',
  `enable_icons` tinyint(1) NOT NULL default '1',
  `enable_prune` tinyint(1) NOT NULL default '0',
  `prune_next` int(11) unsigned default NULL,
  `prune_days` tinyint(4) unsigned NOT NULL default '0',
  `prune_viewed` tinyint(4) unsigned NOT NULL default '0',
  `prune_freq` tinyint(4) unsigned NOT NULL default '0',
  PRIMARY KEY  (`forum_id`),
  KEY `left_right_id` (`left_id`,`right_id`),
  KEY `forum_last_post_id` (`forum_last_post_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- 导出表中的数据 `phpbb_forums`
-- 

INSERT INTO `phpbb_forums` (`forum_id`, `parent_id`, `left_id`, `right_id`, `forum_parents`, `forum_name`, `forum_desc`, `forum_desc_bitfield`, `forum_desc_uid`, `forum_link`, `forum_password`, `forum_style`, `forum_image`, `forum_rules`, `forum_rules_link`, `forum_rules_bitfield`, `forum_rules_uid`, `forum_topics_per_page`, `forum_type`, `forum_status`, `forum_posts`, `forum_topics`, `forum_topics_real`, `forum_last_post_id`, `forum_last_poster_id`, `forum_last_post_time`, `forum_last_poster_name`, `forum_flags`, `display_on_index`, `enable_indexing`, `enable_icons`, `enable_prune`, `prune_next`, `prune_days`, `prune_viewed`, `prune_freq`) VALUES 
(1, 0, 5, 8, NULL, 'My first Category', '', 0, '', '', '', NULL, '', '', '', 0, '', 0, 0, 0, 1, 1, 1, 1, 2, 1167211017, 'PROSE', 0, 1, 1, 1, 0, NULL, 0, 0, 0),
(2, 1, 6, 7, NULL, 'Test Forum 1', 'This is just a test forum.', 0, '', '', '', NULL, '', '', '', 0, '', 0, 1, 0, 1, 1, 1, 1, 2, 1167211017, 'PROSE', 0, 1, 1, 1, 0, NULL, 0, 0, 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_forums_access`
-- 

CREATE TABLE `phpbb_forums_access` (
  `forum_id` mediumint(8) unsigned NOT NULL default '0',
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `session_id` varchar(32) NOT NULL default '',
  PRIMARY KEY  (`forum_id`,`user_id`,`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- 导出表中的数据 `phpbb_forums_access`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_forums_track`
-- 

CREATE TABLE `phpbb_forums_track` (
  `user_id` mediumint(9) unsigned NOT NULL default '0',
  `forum_id` mediumint(9) unsigned NOT NULL default '0',
  `mark_time` int(11) NOT NULL default '0',
  PRIMARY KEY  (`user_id`,`forum_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- 导出表中的数据 `phpbb_forums_track`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_forums_watch`
-- 

CREATE TABLE `phpbb_forums_watch` (
  `forum_id` smallint(5) unsigned NOT NULL default '0',
  `user_id` mediumint(8) NOT NULL default '0',
  `notify_status` tinyint(1) NOT NULL default '0',
  KEY `forum_id` (`forum_id`),
  KEY `user_id` (`user_id`),
  KEY `notify_status` (`notify_status`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- 导出表中的数据 `phpbb_forums_watch`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_groups`
-- 

CREATE TABLE `phpbb_groups` (
  `group_id` mediumint(8) NOT NULL auto_increment,
  `group_type` tinyint(4) NOT NULL default '1',
  `group_name` varchar(255) NOT NULL default '',
  `group_desc` text,
  `group_desc_bitfield` int(11) unsigned NOT NULL default '0',
  `group_desc_uid` varchar(5) NOT NULL default '',
  `group_display` tinyint(1) NOT NULL default '0',
  `group_avatar` varchar(255) NOT NULL default '',
  `group_avatar_type` tinyint(4) NOT NULL default '0',
  `group_avatar_width` tinyint(4) unsigned NOT NULL default '0',
  `group_avatar_height` tinyint(4) unsigned NOT NULL default '0',
  `group_rank` smallint(5) NOT NULL default '-1',
  `group_colour` varchar(6) NOT NULL default '',
  `group_sig_chars` mediumint(8) unsigned NOT NULL default '0',
  `group_receive_pm` tinyint(1) NOT NULL default '0',
  `group_message_limit` mediumint(8) unsigned NOT NULL default '0',
  `group_chgpass` smallint(6) NOT NULL default '0',
  `group_legend` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`group_id`),
  KEY `group_legend` (`group_legend`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- 
-- 导出表中的数据 `phpbb_groups`
-- 

INSERT INTO `phpbb_groups` (`group_id`, `group_type`, `group_name`, `group_desc`, `group_desc_bitfield`, `group_desc_uid`, `group_display`, `group_avatar`, `group_avatar_type`, `group_avatar_width`, `group_avatar_height`, `group_rank`, `group_colour`, `group_sig_chars`, `group_receive_pm`, `group_message_limit`, `group_chgpass`, `group_legend`) VALUES 
(1, 3, 'GUESTS', '', 0, '', 0, '', 0, 0, 0, -1, '', 0, 0, 0, 0, 0),
(2, 3, 'INACTIVE', '', 0, '', 0, '', 0, 0, 0, -1, '', 0, 0, 0, 0, 0),
(3, 3, 'INACTIVE_COPPA', '', 0, '', 0, '', 0, 0, 0, -1, '', 0, 0, 0, 0, 0),
(4, 3, 'REGISTERED', '', 0, '', 0, '', 0, 0, 0, -1, '', 0, 0, 0, 0, 0),
(5, 3, 'REGISTERED_COPPA', '', 0, '', 0, '', 0, 0, 0, -1, '', 0, 0, 0, 0, 0),
(6, 3, 'GLOBAL_MODERATORS', '', 0, '', 0, '', 0, 0, 0, -1, '00AA00', 0, 0, 0, 0, 1),
(7, 3, 'ADMINISTRATORS', '', 0, '', 0, '', 0, 0, 0, -1, 'AA0000', 0, 0, 0, 0, 1),
(8, 3, 'BOTS', '', 0, '', 0, '', 0, 0, 0, -1, '9E8DA7', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_icons`
-- 

CREATE TABLE `phpbb_icons` (
  `icons_id` tinyint(4) unsigned NOT NULL auto_increment,
  `icons_url` varchar(255) default NULL,
  `icons_width` tinyint(4) unsigned NOT NULL default '0',
  `icons_height` tinyint(4) unsigned NOT NULL default '0',
  `icons_order` tinyint(4) unsigned NOT NULL default '0',
  `display_on_posting` tinyint(1) unsigned NOT NULL default '1',
  PRIMARY KEY  (`icons_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- 
-- 导出表中的数据 `phpbb_icons`
-- 

INSERT INTO `phpbb_icons` (`icons_id`, `icons_url`, `icons_width`, `icons_height`, `icons_order`, `display_on_posting`) VALUES 
(1, 'misc/arrow_bold_rgt.gif', 19, 19, 1, 1),
(2, 'smile/redface_anim.gif', 19, 19, 9, 1),
(3, 'smile/mr_green.gif', 19, 19, 10, 1),
(4, 'misc/musical.gif', 19, 19, 4, 1),
(5, 'misc/asterix.gif', 19, 19, 2, 1),
(6, 'misc/square.gif', 19, 19, 3, 1),
(7, 'smile/alien_grn.gif', 19, 19, 5, 1),
(8, 'smile/idea.gif', 19, 19, 8, 1),
(9, 'smile/question.gif', 19, 19, 6, 1),
(10, 'smile/exclaim.gif', 19, 19, 7, 1);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_lang`
-- 

CREATE TABLE `phpbb_lang` (
  `lang_id` tinyint(4) unsigned NOT NULL auto_increment,
  `lang_iso` varchar(5) NOT NULL default '',
  `lang_dir` varchar(30) NOT NULL default '',
  `lang_english_name` varchar(100) default NULL,
  `lang_local_name` varchar(255) default NULL,
  `lang_author` varchar(255) default NULL,
  PRIMARY KEY  (`lang_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- 导出表中的数据 `phpbb_lang`
-- 

INSERT INTO `phpbb_lang` (`lang_id`, `lang_iso`, `lang_dir`, `lang_english_name`, `lang_local_name`, `lang_author`) VALUES 
(1, 'en', 'en', 'English [ UK ]', 'English [ UK ]', 'phpBB Group');

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_log`
-- 

CREATE TABLE `phpbb_log` (
  `log_id` mediumint(8) unsigned NOT NULL auto_increment,
  `log_type` tinyint(4) unsigned NOT NULL default '0',
  `user_id` mediumint(8) NOT NULL default '0',
  `forum_id` mediumint(8) unsigned NOT NULL default '0',
  `topic_id` mediumint(8) unsigned NOT NULL default '0',
  `reportee_id` mediumint(8) unsigned NOT NULL default '0',
  `log_ip` varchar(40) NOT NULL default '',
  `log_time` int(11) NOT NULL default '0',
  `log_operation` text,
  `log_data` text,
  PRIMARY KEY  (`log_id`),
  KEY `log_type` (`log_type`),
  KEY `forum_id` (`forum_id`),
  KEY `topic_id` (`topic_id`),
  KEY `reportee_id` (`reportee_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- 导出表中的数据 `phpbb_log`
-- 

INSERT INTO `phpbb_log` (`log_id`, `log_type`, `user_id`, `forum_id`, `topic_id`, `reportee_id`, `log_ip`, `log_time`, `log_operation`, `log_data`) VALUES 
(1, 0, 2, 0, 0, 0, '127.0.0.1', 1167211019, 'LOG_INSTALL_INSTALLED', 'a:1:{i:0;s:6:"3.0.B1";}'),
(2, 0, 2, 0, 0, 0, '127.0.0.1', 1167497481, 'LOG_ADMIN_AUTH_SUCCESS', '');

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_moderator_cache`
-- 

CREATE TABLE `phpbb_moderator_cache` (
  `forum_id` mediumint(8) unsigned NOT NULL default '0',
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `username` varchar(255) NOT NULL default '',
  `group_id` mediumint(8) unsigned NOT NULL default '0',
  `group_name` varchar(255) NOT NULL default '',
  `display_on_index` tinyint(1) unsigned NOT NULL default '1',
  KEY `display_on_index` (`display_on_index`),
  KEY `forum_id` (`forum_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- 导出表中的数据 `phpbb_moderator_cache`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_modules`
-- 

CREATE TABLE `phpbb_modules` (
  `module_id` mediumint(8) unsigned NOT NULL auto_increment,
  `module_enabled` tinyint(1) unsigned NOT NULL default '1',
  `module_display` tinyint(1) unsigned NOT NULL default '1',
  `module_name` varchar(255) NOT NULL default '',
  `module_class` varchar(10) NOT NULL default '',
  `parent_id` mediumint(8) unsigned NOT NULL default '0',
  `left_id` mediumint(8) unsigned NOT NULL default '0',
  `right_id` mediumint(8) unsigned NOT NULL default '0',
  `module_langname` varchar(255) NOT NULL default '',
  `module_mode` varchar(255) NOT NULL default '',
  `module_auth` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`module_id`),
  KEY `left_right_id` (`left_id`,`right_id`),
  KEY `module_enabled` (`module_enabled`),
  KEY `class_left_id` (`module_class`,`left_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=188 ;

-- 
-- 导出表中的数据 `phpbb_modules`
-- 

INSERT INTO `phpbb_modules` (`module_id`, `module_enabled`, `module_display`, `module_name`, `module_class`, `parent_id`, `left_id`, `right_id`, `module_langname`, `module_mode`, `module_auth`) VALUES 
(1, 1, 1, '', 'acp', 0, 261, 318, 'ACP_CAT_GENERAL', '', ''),
(2, 1, 1, '', 'acp', 1, 264, 277, 'ACP_QUICK_ACCESS', '', ''),
(3, 1, 1, '', 'acp', 1, 278, 297, 'ACP_BOARD_CONFIGURATION', '', ''),
(4, 1, 1, '', 'acp', 1, 298, 305, 'ACP_CLIENT_COMMUNICATION', '', ''),
(5, 1, 1, '', 'acp', 1, 306, 317, 'ACP_SERVER_CONFIGURATION', '', ''),
(6, 1, 1, '', 'acp', 0, 319, 336, 'ACP_CAT_FORUMS', '', ''),
(7, 1, 1, '', 'acp', 6, 320, 325, 'ACP_MANAGE_FORUMS', '', ''),
(8, 1, 1, '', 'acp', 6, 326, 335, 'ACP_FORUM_BASED_PERMISSIONS', '', ''),
(9, 1, 1, '', 'acp', 0, 337, 360, 'ACP_CAT_POSTING', '', ''),
(10, 1, 1, '', 'acp', 9, 338, 349, 'ACP_MESSAGES', '', ''),
(11, 1, 1, '', 'acp', 9, 350, 359, 'ACP_ATTACHMENTS', '', ''),
(12, 1, 1, '', 'acp', 0, 361, 412, 'ACP_CAT_USERGROUP', '', ''),
(13, 1, 1, '', 'acp', 12, 362, 391, 'ACP_CAT_USERS', '', ''),
(14, 1, 1, '', 'acp', 12, 392, 399, 'ACP_GROUPS', '', ''),
(15, 1, 1, '', 'acp', 12, 400, 411, 'ACP_USER_SECURITY', '', ''),
(16, 1, 1, '', 'acp', 0, 413, 460, 'ACP_CAT_PERMISSIONS', '', ''),
(17, 1, 1, '', 'acp', 16, 416, 425, 'ACP_GLOBAL_PERMISSIONS', '', ''),
(18, 1, 1, '', 'acp', 16, 426, 435, 'ACP_FORUM_BASED_PERMISSIONS', '', ''),
(19, 1, 1, '', 'acp', 16, 436, 445, 'ACP_PERMISSION_ROLES', '', ''),
(20, 1, 1, '', 'acp', 16, 446, 459, 'ACP_PERMISSION_MASKS', '', ''),
(21, 1, 1, '', 'acp', 0, 461, 474, 'ACP_CAT_STYLES', '', ''),
(22, 1, 1, '', 'acp', 21, 462, 465, 'ACP_STYLE_MANAGEMENT', '', ''),
(23, 1, 1, '', 'acp', 21, 466, 473, 'ACP_STYLE_COMPONENTS', '', ''),
(24, 1, 1, '', 'acp', 0, 475, 494, 'ACP_CAT_MAINTENANCE', '', ''),
(25, 1, 1, '', 'acp', 24, 476, 485, 'ACP_FORUM_LOGS', '', ''),
(26, 1, 1, '', 'acp', 24, 486, 493, 'ACP_CAT_DATABASE', '', ''),
(27, 1, 1, '', 'acp', 0, 495, 518, 'ACP_CAT_SYSTEM', '', ''),
(28, 1, 1, '', 'acp', 27, 496, 497, 'ACP_AUTOMATION', '', ''),
(29, 1, 1, '', 'acp', 27, 498, 509, 'ACP_GENERAL_TASKS', '', ''),
(30, 1, 1, '', 'acp', 27, 510, 517, 'ACP_MODULE_MANAGEMENT', '', ''),
(31, 1, 1, '', 'acp', 0, 519, 520, 'ACP_CAT_DOT_MODS', '', ''),
(32, 1, 1, 'attachments', 'acp', 3, 279, 280, 'ACP_ATTACHMENT_SETTINGS', 'attach', 'acl_a_attach'),
(33, 1, 1, 'attachments', 'acp', 11, 351, 352, 'ACP_ATTACHMENT_SETTINGS', 'attach', 'acl_a_attach'),
(34, 1, 1, 'attachments', 'acp', 11, 353, 354, 'ACP_MANAGE_EXTENSIONS', 'extensions', 'acl_a_attach'),
(35, 1, 1, 'attachments', 'acp', 11, 355, 356, 'ACP_EXTENSION_GROUPS', 'ext_groups', 'acl_a_attach'),
(36, 1, 1, 'attachments', 'acp', 11, 357, 358, 'ACP_ORPHAN_ATTACHMENTS', 'orphan', 'acl_a_attach'),
(37, 1, 1, 'ban', 'acp', 15, 401, 402, 'ACP_BAN_EMAILS', 'email', 'acl_a_ban'),
(38, 1, 1, 'ban', 'acp', 15, 403, 404, 'ACP_BAN_IPS', 'ip', 'acl_a_ban'),
(39, 1, 1, 'ban', 'acp', 15, 405, 406, 'ACP_BAN_USERNAMES', 'user', 'acl_a_ban'),
(40, 1, 1, 'bbcodes', 'acp', 10, 339, 340, 'ACP_BBCODES', 'bbcodes', 'acl_a_bbcode'),
(41, 1, 1, 'board', 'acp', 3, 281, 282, 'ACP_BOARD_SETTINGS', 'settings', 'acl_a_board'),
(42, 1, 1, 'board', 'acp', 3, 283, 284, 'ACP_BOARD_FEATURES', 'features', 'acl_a_board'),
(43, 1, 1, 'board', 'acp', 3, 285, 286, 'ACP_AVATAR_SETTINGS', 'avatar', 'acl_a_board'),
(44, 1, 1, 'board', 'acp', 3, 287, 288, 'ACP_MESSAGE_SETTINGS', 'message', 'acl_a_board'),
(45, 1, 1, 'board', 'acp', 10, 341, 342, 'ACP_MESSAGE_SETTINGS', 'message', 'acl_a_board'),
(46, 1, 1, 'board', 'acp', 3, 289, 290, 'ACP_POST_SETTINGS', 'post', 'acl_a_board'),
(47, 1, 1, 'board', 'acp', 3, 291, 292, 'ACP_SIGNATURE_SETTINGS', 'signature', 'acl_a_board'),
(48, 1, 1, 'board', 'acp', 3, 293, 294, 'ACP_REGISTER_SETTINGS', 'registration', 'acl_a_board'),
(49, 1, 1, 'board', 'acp', 3, 295, 296, 'ACP_VC_SETTINGS', 'visual', 'acl_a_board'),
(50, 1, 1, 'board', 'acp', 4, 299, 300, 'ACP_AUTH_SETTINGS', 'auth', 'acl_a_server'),
(51, 1, 1, 'board', 'acp', 4, 301, 302, 'ACP_EMAIL_SETTINGS', 'email', 'acl_a_server'),
(52, 1, 1, 'board', 'acp', 5, 307, 308, 'ACP_COOKIE_SETTINGS', 'cookie', 'acl_a_server'),
(53, 1, 1, 'board', 'acp', 5, 309, 310, 'ACP_SERVER_SETTINGS', 'server', 'acl_a_server'),
(54, 1, 1, 'board', 'acp', 5, 311, 312, 'ACP_SECURITY_SETTINGS', 'security', 'acl_a_server'),
(55, 1, 1, 'board', 'acp', 5, 313, 314, 'ACP_LOAD_SETTINGS', 'load', 'acl_a_server'),
(56, 1, 1, 'bots', 'acp', 29, 499, 500, 'ACP_BOTS', 'bots', 'acl_a_bots'),
(57, 1, 1, 'database', 'acp', 26, 487, 488, 'ACP_BACKUP', 'backup', 'acl_a_backup'),
(58, 1, 1, 'database', 'acp', 26, 489, 490, 'ACP_RESTORE', 'restore', 'acl_a_backup'),
(59, 1, 1, 'disallow', 'acp', 15, 407, 408, 'ACP_DISALLOW_USERNAMES', 'usernames', 'acl_a_names'),
(60, 1, 1, 'email', 'acp', 29, 501, 502, 'ACP_MASS_EMAIL', 'email', 'acl_a_email'),
(61, 1, 1, 'forums', 'acp', 7, 321, 322, 'ACP_MANAGE_FORUMS', 'manage', 'acl_a_forum'),
(62, 1, 1, 'groups', 'acp', 14, 393, 394, 'ACP_GROUPS_MANAGE', 'manage', 'acl_a_group'),
(63, 1, 1, 'icons', 'acp', 10, 343, 344, 'ACP_ICONS', 'icons', 'acl_a_icons'),
(64, 1, 1, 'icons', 'acp', 10, 345, 346, 'ACP_SMILIES', 'smilies', 'acl_a_icons'),
(65, 1, 1, 'jabber', 'acp', 4, 303, 304, 'ACP_JABBER_SETTINGS', 'settings', 'acl_a_jabber'),
(66, 1, 1, 'language', 'acp', 29, 503, 504, 'ACP_LANGUAGE_PACKS', 'lang_packs', 'acl_a_language'),
(67, 1, 1, 'logs', 'acp', 25, 477, 478, 'ACP_ADMIN_LOGS', 'admin', 'acl_a_viewlogs'),
(68, 1, 1, 'logs', 'acp', 25, 479, 480, 'ACP_MOD_LOGS', 'mod', 'acl_a_viewlogs'),
(69, 1, 1, 'logs', 'acp', 25, 481, 482, 'ACP_USERS_LOGS', 'users', 'acl_a_viewlogs'),
(70, 1, 1, 'logs', 'acp', 25, 483, 484, 'ACP_CRITICAL_LOGS', 'critical', 'acl_a_viewlogs'),
(71, 1, 1, 'main', 'acp', 1, 262, 263, 'ACP_INDEX', 'main', ''),
(72, 1, 1, 'modules', 'acp', 30, 511, 512, 'ACP', 'acp', 'acl_a_modules'),
(73, 1, 1, 'modules', 'acp', 30, 513, 514, 'UCP', 'ucp', 'acl_a_modules'),
(74, 1, 1, 'modules', 'acp', 30, 515, 516, 'MCP', 'mcp', 'acl_a_modules'),
(75, 1, 1, 'permission_roles', 'acp', 19, 437, 438, 'ACP_ADMIN_ROLES', 'admin_roles', 'acl_a_roles'),
(76, 1, 1, 'permission_roles', 'acp', 19, 439, 440, 'ACP_USER_ROLES', 'user_roles', 'acl_a_roles'),
(77, 1, 1, 'permission_roles', 'acp', 19, 441, 442, 'ACP_MOD_ROLES', 'mod_roles', 'acl_a_roles'),
(78, 1, 1, 'permission_roles', 'acp', 19, 443, 444, 'ACP_FORUM_ROLES', 'forum_roles', 'acl_a_roles'),
(79, 1, 1, 'permissions', 'acp', 16, 414, 415, 'ACP_PERMISSIONS', 'intro', 'acl_a_authusers || acl_a_authgroups || acl_a_viewauth'),
(80, 1, 0, 'permissions', 'acp', 20, 447, 448, 'ACP_PERMISSION_TRACE', 'trace', 'acl_a_viewauth'),
(81, 1, 1, 'permissions', 'acp', 18, 427, 428, 'ACP_FORUM_PERMISSIONS', 'setting_forum_local', 'acl_a_fauth && (acl_a_authusers || acl_a_authgroups)'),
(82, 1, 1, 'permissions', 'acp', 18, 429, 430, 'ACP_FORUM_MODERATORS', 'setting_mod_local', 'acl_a_mauth && (acl_a_authusers || acl_a_authgroups)'),
(83, 1, 1, 'permissions', 'acp', 17, 417, 418, 'ACP_USERS_PERMISSIONS', 'setting_user_global', 'acl_a_authusers && (acl_a_aauth || acl_a_mauth || acl_a_uauth)'),
(84, 1, 1, 'permissions', 'acp', 13, 363, 364, 'ACP_USERS_PERMISSIONS', 'setting_user_global', 'acl_a_authusers && (acl_a_aauth || acl_a_mauth || acl_a_uauth)'),
(85, 1, 1, 'permissions', 'acp', 18, 431, 432, 'ACP_USERS_FORUM_PERMISSIONS', 'setting_user_local', 'acl_a_authusers && (acl_a_mauth || acl_a_fauth)'),
(86, 1, 1, 'permissions', 'acp', 13, 365, 366, 'ACP_USERS_FORUM_PERMISSIONS', 'setting_user_local', 'acl_a_authusers && (acl_a_mauth || acl_a_fauth)'),
(87, 1, 1, 'permissions', 'acp', 17, 419, 420, 'ACP_GROUPS_PERMISSIONS', 'setting_group_global', 'acl_a_authgroups && (acl_a_aauth || acl_a_mauth || acl_a_uauth)'),
(88, 1, 1, 'permissions', 'acp', 14, 395, 396, 'ACP_GROUPS_PERMISSIONS', 'setting_group_global', 'acl_a_authgroups && (acl_a_aauth || acl_a_mauth || acl_a_uauth)'),
(89, 1, 1, 'permissions', 'acp', 18, 433, 434, 'ACP_GROUPS_FORUM_PERMISSIONS', 'setting_group_local', 'acl_a_authgroups && (acl_a_mauth || acl_a_fauth)'),
(90, 1, 1, 'permissions', 'acp', 14, 397, 398, 'ACP_GROUPS_FORUM_PERMISSIONS', 'setting_group_local', 'acl_a_authgroups && (acl_a_mauth || acl_a_fauth)'),
(91, 1, 1, 'permissions', 'acp', 17, 421, 422, 'ACP_ADMINISTRATORS', 'setting_admin_global', 'acl_a_aauth && (acl_a_authusers || acl_a_authgroups)'),
(92, 1, 1, 'permissions', 'acp', 17, 423, 424, 'ACP_GLOBAL_MODERATORS', 'setting_mod_global', 'acl_a_mauth && (acl_a_authusers || acl_a_authgroups)'),
(93, 1, 1, 'permissions', 'acp', 20, 449, 450, 'ACP_VIEW_ADMIN_PERMISSIONS', 'view_admin_global', 'acl_a_viewauth'),
(94, 1, 1, 'permissions', 'acp', 20, 451, 452, 'ACP_VIEW_USER_PERMISSIONS', 'view_user_global', 'acl_a_viewauth'),
(95, 1, 1, 'permissions', 'acp', 20, 453, 454, 'ACP_VIEW_GLOBAL_MOD_PERMISSIONS', 'view_mod_global', 'acl_a_viewauth'),
(96, 1, 1, 'permissions', 'acp', 20, 455, 456, 'ACP_VIEW_FORUM_MOD_PERMISSIONS', 'view_mod_local', 'acl_a_viewauth'),
(97, 1, 1, 'permissions', 'acp', 20, 457, 458, 'ACP_VIEW_FORUM_PERMISSIONS', 'view_forum_local', 'acl_a_viewauth'),
(98, 1, 1, 'php_info', 'acp', 29, 505, 506, 'ACP_PHP_INFO', 'info', 'acl_a_phpinfo'),
(99, 1, 1, 'profile', 'acp', 13, 367, 368, 'ACP_CUSTOM_PROFILE_FIELDS', 'profile', 'acl_a_profile'),
(100, 1, 1, 'prune', 'acp', 7, 323, 324, 'ACP_PRUNE_FORUMS', 'forums', 'acl_a_prune'),
(101, 1, 1, 'prune', 'acp', 15, 409, 410, 'ACP_PRUNE_USERS', 'users', 'acl_a_userdel'),
(102, 1, 1, 'ranks', 'acp', 13, 369, 370, 'ACP_MANAGE_RANKS', 'ranks', 'acl_a_ranks'),
(103, 1, 1, 'reasons', 'acp', 29, 507, 508, 'ACP_MANAGE_REASONS', 'main', 'acl_a_reasons'),
(104, 1, 1, 'search', 'acp', 5, 315, 316, 'ACP_SEARCH_SETTINGS', 'settings', 'acl_a_search'),
(105, 1, 1, 'search', 'acp', 26, 491, 492, 'ACP_SEARCH_INDEX', 'index', 'acl_a_search'),
(106, 1, 1, 'styles', 'acp', 22, 463, 464, 'ACP_STYLES', 'style', 'acl_a_styles'),
(107, 1, 1, 'styles', 'acp', 23, 467, 468, 'ACP_TEMPLATES', 'template', 'acl_a_styles'),
(108, 1, 1, 'styles', 'acp', 23, 469, 470, 'ACP_THEMES', 'theme', 'acl_a_styles'),
(109, 1, 1, 'styles', 'acp', 23, 471, 472, 'ACP_IMAGESETS', 'imageset', 'acl_a_styles'),
(110, 1, 1, 'users', 'acp', 13, 371, 372, 'ACP_MANAGE_USERS', 'overview', 'acl_a_user'),
(111, 1, 0, 'users', 'acp', 13, 373, 374, 'ACP_USER_FEEDBACK', 'feedback', 'acl_a_user'),
(112, 1, 0, 'users', 'acp', 13, 375, 376, 'ACP_USER_PROFILE', 'profile', 'acl_a_user'),
(113, 1, 0, 'users', 'acp', 13, 377, 378, 'ACP_USER_PREFS', 'prefs', 'acl_a_user'),
(114, 1, 0, 'users', 'acp', 13, 379, 380, 'ACP_USER_AVATAR', 'avatar', 'acl_a_user'),
(115, 1, 0, 'users', 'acp', 13, 381, 382, 'ACP_USER_RANK', 'rank', 'acl_a_user'),
(116, 1, 0, 'users', 'acp', 13, 383, 384, 'ACP_USER_SIG', 'sig', 'acl_a_user'),
(117, 1, 0, 'users', 'acp', 13, 385, 386, 'ACP_USER_GROUPS', 'groups', 'acl_a_user && acl_a_group'),
(118, 1, 0, 'users', 'acp', 13, 387, 388, 'ACP_USER_PERM', 'perm', 'acl_a_user && acl_a_viewauth'),
(119, 1, 0, 'users', 'acp', 13, 389, 390, 'ACP_USER_ATTACH', 'attach', 'acl_a_user'),
(120, 1, 1, 'words', 'acp', 10, 347, 348, 'ACP_WORDS', 'words', 'acl_a_words'),
(121, 1, 1, 'users', 'acp', 2, 265, 266, 'ACP_MANAGE_USERS', 'overview', 'acl_a_user'),
(122, 1, 1, 'groups', 'acp', 2, 267, 268, 'ACP_GROUPS_MANAGE', 'manage', 'acl_a_group'),
(123, 1, 1, 'forums', 'acp', 2, 269, 270, 'ACP_MANAGE_FORUMS', 'manage', 'acl_a_forum'),
(124, 1, 1, 'logs', 'acp', 2, 271, 272, 'ACP_MOD_LOGS', 'mod', 'acl_a_viewlogs'),
(125, 1, 1, 'bots', 'acp', 2, 273, 274, 'ACP_BOTS', 'bots', 'acl_a_bots'),
(126, 1, 1, 'php_info', 'acp', 2, 275, 276, 'ACP_PHP_INFO', 'info', 'acl_a_phpinfo'),
(127, 1, 1, 'permissions', 'acp', 8, 327, 328, 'ACP_FORUM_PERMISSIONS', 'setting_forum_local', 'acl_a_fauth && (acl_a_authusers || acl_a_authgroups)'),
(128, 1, 1, 'permissions', 'acp', 8, 329, 330, 'ACP_FORUM_MODERATORS', 'setting_mod_local', 'acl_a_mauth && (acl_a_authusers || acl_a_authgroups)'),
(129, 1, 1, 'permissions', 'acp', 8, 331, 332, 'ACP_USERS_FORUM_PERMISSIONS', 'setting_user_local', 'acl_a_authusers && (acl_a_mauth || acl_a_fauth)'),
(130, 1, 1, 'permissions', 'acp', 8, 333, 334, 'ACP_GROUPS_FORUM_PERMISSIONS', 'setting_group_local', 'acl_a_authgroups && (acl_a_mauth || acl_a_fauth)'),
(131, 1, 1, '', 'mcp', 0, 59, 68, 'MCP_MAIN', '', ''),
(132, 1, 1, '', 'mcp', 0, 69, 76, 'MCP_QUEUE', '', ''),
(133, 1, 1, '', 'mcp', 0, 77, 84, 'MCP_REPORTS', '', ''),
(134, 1, 1, '', 'mcp', 0, 85, 90, 'MCP_NOTES', '', ''),
(135, 1, 1, '', 'mcp', 0, 91, 100, 'MCP_WARN', '', ''),
(136, 1, 1, '', 'mcp', 0, 101, 108, 'MCP_LOGS', '', ''),
(137, 1, 1, '', 'mcp', 0, 109, 116, 'MCP_BAN', '', ''),
(138, 1, 1, 'ban', 'mcp', 137, 110, 111, 'MCP_BAN_USERNAMES', 'user', 'acl_m_ban'),
(139, 1, 1, 'ban', 'mcp', 137, 112, 113, 'MCP_BAN_IPS', 'ip', 'acl_m_ban'),
(140, 1, 1, 'ban', 'mcp', 137, 114, 115, 'MCP_BAN_EMAILS', 'email', 'acl_m_ban'),
(141, 1, 1, 'logs', 'mcp', 136, 102, 103, 'MCP_LOGS_FRONT', 'front', 'acl_m_ || aclf_m_'),
(142, 1, 1, 'logs', 'mcp', 136, 104, 105, 'MCP_LOGS_FORUM_VIEW', 'forum_logs', 'acl_m_,$id'),
(143, 1, 1, 'logs', 'mcp', 136, 106, 107, 'MCP_LOGS_TOPIC_VIEW', 'topic_logs', 'acl_m_,$id'),
(144, 1, 1, 'main', 'mcp', 131, 60, 61, 'MCP_MAIN_FRONT', 'front', ''),
(145, 1, 1, 'main', 'mcp', 131, 62, 63, 'MCP_MAIN_FORUM_VIEW', 'forum_view', 'acl_m_,$id'),
(146, 1, 1, 'main', 'mcp', 131, 64, 65, 'MCP_MAIN_TOPIC_VIEW', 'topic_view', 'acl_m_,$id'),
(147, 1, 1, 'main', 'mcp', 131, 66, 67, 'MCP_MAIN_POST_DETAILS', 'post_details', 'acl_m_,$id || (!$id && aclf_m_)'),
(148, 1, 1, 'notes', 'mcp', 134, 86, 87, 'MCP_NOTES_FRONT', 'front', ''),
(149, 1, 1, 'notes', 'mcp', 134, 88, 89, 'MCP_NOTES_USER', 'user_notes', ''),
(150, 1, 1, 'queue', 'mcp', 132, 70, 71, 'MCP_QUEUE_UNAPPROVED_TOPICS', 'unapproved_topics', 'aclf_m_approve'),
(151, 1, 1, 'queue', 'mcp', 132, 72, 73, 'MCP_QUEUE_UNAPPROVED_POSTS', 'unapproved_posts', 'aclf_m_approve'),
(152, 1, 1, 'queue', 'mcp', 132, 74, 75, 'MCP_QUEUE_APPROVE_DETAILS', 'approve_details', 'acl_m_approve,$id || (!$id && aclf_m_approve)'),
(153, 1, 1, 'reports', 'mcp', 133, 78, 79, 'MCP_REPORTS_OPEN', 'reports', 'aclf_m_report'),
(154, 1, 1, 'reports', 'mcp', 133, 80, 81, 'MCP_REPORTS_CLOSED', 'reports_closed', 'aclf_m_report'),
(155, 1, 1, 'reports', 'mcp', 133, 82, 83, 'MCP_REPORT_DETAILS', 'report_details', 'acl_m_report,$id || (!$id && aclf_m_report)'),
(156, 1, 1, 'warn', 'mcp', 135, 92, 93, 'MCP_WARN_FRONT', 'front', 'aclf_m_warn'),
(157, 1, 1, 'warn', 'mcp', 135, 94, 95, 'MCP_WARN_LIST', 'list', 'aclf_m_warn'),
(158, 1, 1, 'warn', 'mcp', 135, 96, 97, 'MCP_WARN_USER', 'warn_user', 'aclf_m_warn'),
(159, 1, 1, 'warn', 'mcp', 135, 98, 99, 'MCP_WARN_POST', 'warn_post', 'acl_m_warn,$id || (!$id && aclf_m_warn)'),
(160, 1, 1, '', 'ucp', 0, 57, 66, 'UCP_MAIN', '', ''),
(161, 1, 1, '', 'ucp', 0, 67, 76, 'UCP_PROFILE', '', ''),
(162, 1, 1, '', 'ucp', 0, 77, 84, 'UCP_PREFS', '', ''),
(163, 1, 1, '', 'ucp', 0, 85, 96, 'UCP_PM', '', ''),
(164, 1, 1, '', 'ucp', 0, 97, 102, 'UCP_USERGROUPS', '', ''),
(165, 1, 1, '', 'ucp', 0, 103, 106, 'UCP_ATTACHMENTS', '', ''),
(166, 1, 1, '', 'ucp', 0, 107, 112, 'UCP_ZEBRA', '', ''),
(167, 1, 1, 'attachments', 'ucp', 165, 104, 105, 'UCP_ATTACHMENTS', 'attachments', 'acl_u_attach'),
(168, 1, 1, 'groups', 'ucp', 164, 98, 99, 'UCP_USERGROUPS_MEMBER', 'membership', ''),
(169, 1, 1, 'groups', 'ucp', 164, 100, 101, 'UCP_USERGROUPS_MANAGE', 'manage', ''),
(170, 1, 1, 'main', 'ucp', 160, 58, 59, 'UCP_MAIN_FRONT', 'front', ''),
(171, 1, 1, 'main', 'ucp', 160, 60, 61, 'UCP_MAIN_SUBSCRIBED', 'subscribed', ''),
(172, 1, 1, 'main', 'ucp', 160, 62, 63, 'UCP_MAIN_BOOKMARKS', 'bookmarks', 'cfg_allow_bookmarks'),
(173, 1, 1, 'main', 'ucp', 160, 64, 65, 'UCP_MAIN_DRAFTS', 'drafts', ''),
(174, 1, 0, 'pm', 'ucp', 163, 86, 87, 'UCP_PM_VIEW', 'view', 'cfg_allow_privmsg'),
(175, 1, 1, 'pm', 'ucp', 163, 88, 89, 'UCP_PM_COMPOSE', 'compose', 'cfg_allow_privmsg'),
(176, 1, 1, 'pm', 'ucp', 163, 90, 91, 'UCP_PM_DRAFTS', 'drafts', 'cfg_allow_privmsg'),
(177, 1, 1, 'pm', 'ucp', 163, 92, 93, 'UCP_PM_OPTIONS', 'options', 'cfg_allow_privmsg'),
(178, 1, 0, 'pm', 'ucp', 163, 94, 95, 'UCP_PM_POPUP_TITLE', 'popup', 'cfg_allow_privmsg'),
(179, 1, 1, 'prefs', 'ucp', 162, 78, 79, 'UCP_PREFS_PERSONAL', 'personal', ''),
(180, 1, 1, 'prefs', 'ucp', 162, 80, 81, 'UCP_PREFS_VIEW', 'view', ''),
(181, 1, 1, 'prefs', 'ucp', 162, 82, 83, 'UCP_PREFS_POST', 'post', ''),
(182, 1, 1, 'profile', 'ucp', 161, 68, 69, 'UCP_PROFILE_REG_DETAILS', 'reg_details', ''),
(183, 1, 1, 'profile', 'ucp', 161, 70, 71, 'UCP_PROFILE_PROFILE_INFO', 'profile_info', ''),
(184, 1, 1, 'profile', 'ucp', 161, 72, 73, 'UCP_PROFILE_SIGNATURE', 'signature', ''),
(185, 1, 1, 'profile', 'ucp', 161, 74, 75, 'UCP_PROFILE_AVATAR', 'avatar', ''),
(186, 1, 1, 'zebra', 'ucp', 166, 108, 109, 'UCP_ZEBRA_FRIENDS', 'friends', ''),
(187, 1, 1, 'zebra', 'ucp', 166, 110, 111, 'UCP_ZEBRA_FOES', 'foes', '');

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_poll_options`
-- 

CREATE TABLE `phpbb_poll_options` (
  `poll_option_id` tinyint(4) unsigned NOT NULL default '0',
  `topic_id` mediumint(8) unsigned NOT NULL default '0',
  `poll_option_text` text,
  `poll_option_total` mediumint(8) unsigned NOT NULL default '0',
  KEY `poll_option_id` (`poll_option_id`),
  KEY `topic_id` (`topic_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- 导出表中的数据 `phpbb_poll_options`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_poll_votes`
-- 

CREATE TABLE `phpbb_poll_votes` (
  `topic_id` mediumint(8) unsigned NOT NULL default '0',
  `poll_option_id` tinyint(4) unsigned NOT NULL default '0',
  `vote_user_id` mediumint(8) unsigned NOT NULL default '0',
  `vote_user_ip` varchar(40) NOT NULL default '',
  KEY `topic_id` (`topic_id`),
  KEY `vote_user_id` (`vote_user_id`),
  KEY `vote_user_ip` (`vote_user_ip`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- 导出表中的数据 `phpbb_poll_votes`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_posts`
-- 

CREATE TABLE `phpbb_posts` (
  `post_id` mediumint(8) unsigned NOT NULL auto_increment,
  `topic_id` mediumint(8) unsigned NOT NULL default '0',
  `forum_id` smallint(5) unsigned NOT NULL default '0',
  `poster_id` mediumint(8) unsigned NOT NULL default '0',
  `icon_id` tinyint(4) unsigned NOT NULL default '0',
  `poster_ip` varchar(40) NOT NULL default '',
  `post_time` int(11) NOT NULL default '0',
  `post_approved` tinyint(1) NOT NULL default '1',
  `post_reported` tinyint(1) NOT NULL default '0',
  `enable_bbcode` tinyint(1) NOT NULL default '1',
  `enable_smilies` tinyint(1) NOT NULL default '1',
  `enable_magic_url` tinyint(1) NOT NULL default '1',
  `enable_sig` tinyint(1) NOT NULL default '1',
  `post_username` varchar(255) default NULL,
  `post_subject` text NOT NULL,
  `post_text` mediumtext NOT NULL,
  `post_checksum` varchar(32) NOT NULL default '',
  `post_encoding` varchar(20) NOT NULL default 'iso-8859-1',
  `post_attachment` tinyint(1) NOT NULL default '0',
  `bbcode_bitfield` int(11) unsigned NOT NULL default '0',
  `bbcode_uid` varchar(5) NOT NULL default '',
  `post_edit_time` int(11) unsigned default '0',
  `post_edit_reason` text,
  `post_edit_user` mediumint(8) unsigned default '0',
  `post_edit_count` smallint(5) unsigned default '0',
  `post_edit_locked` tinyint(1) unsigned default '0',
  PRIMARY KEY  (`post_id`),
  KEY `forum_id` (`forum_id`),
  KEY `topic_id` (`topic_id`),
  KEY `poster_ip` (`poster_ip`),
  KEY `poster_id` (`poster_id`),
  KEY `post_approved` (`post_approved`),
  KEY `post_time` (`post_time`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- 导出表中的数据 `phpbb_posts`
-- 

INSERT INTO `phpbb_posts` (`post_id`, `topic_id`, `forum_id`, `poster_id`, `icon_id`, `poster_ip`, `post_time`, `post_approved`, `post_reported`, `enable_bbcode`, `enable_smilies`, `enable_magic_url`, `enable_sig`, `post_username`, `post_subject`, `post_text`, `post_checksum`, `post_encoding`, `post_attachment`, `bbcode_bitfield`, `bbcode_uid`, `post_edit_time`, `post_edit_reason`, `post_edit_user`, `post_edit_count`, `post_edit_locked`) VALUES 
(1, 1, 2, 2, 1, '127.0.0.1', 1167211017, 1, 0, 1, 1, 1, 1, NULL, 'Welcome to phpBB 3', 'This is an example post in your phpBB 3.0 installation. You may delete this post, this topic and even this forum if you like since everything seems to be working!', '5dd683b17f641daf84c040bfefc58ce9', 'iso-8859-1', 0, 0, '', 0, NULL, 0, 0, 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_privmsgs`
-- 

CREATE TABLE `phpbb_privmsgs` (
  `msg_id` mediumint(8) unsigned NOT NULL auto_increment,
  `root_level` mediumint(8) unsigned NOT NULL default '0',
  `author_id` mediumint(8) unsigned NOT NULL default '0',
  `icon_id` tinyint(4) unsigned NOT NULL default '0',
  `author_ip` varchar(40) NOT NULL default '',
  `message_time` int(11) NOT NULL default '0',
  `enable_bbcode` tinyint(1) NOT NULL default '1',
  `enable_smilies` tinyint(1) NOT NULL default '1',
  `enable_magic_url` tinyint(1) NOT NULL default '1',
  `enable_sig` tinyint(1) NOT NULL default '1',
  `message_subject` text NOT NULL,
  `message_text` mediumtext NOT NULL,
  `message_edit_reason` text,
  `message_edit_user` mediumint(8) unsigned default '0',
  `message_encoding` varchar(20) NOT NULL default 'iso-8859-1',
  `message_attachment` tinyint(1) NOT NULL default '0',
  `bbcode_bitfield` int(11) unsigned NOT NULL default '0',
  `bbcode_uid` varchar(5) NOT NULL default '',
  `message_edit_time` int(11) unsigned default '0',
  `message_edit_count` smallint(5) unsigned default '0',
  `to_address` text NOT NULL,
  `bcc_address` text NOT NULL,
  PRIMARY KEY  (`msg_id`),
  KEY `author_ip` (`author_ip`),
  KEY `message_time` (`message_time`),
  KEY `author_id` (`author_id`),
  KEY `root_level` (`root_level`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `phpbb_privmsgs`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_privmsgs_folder`
-- 

CREATE TABLE `phpbb_privmsgs_folder` (
  `folder_id` mediumint(8) unsigned NOT NULL auto_increment,
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `folder_name` varchar(255) NOT NULL default '',
  `pm_count` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`folder_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `phpbb_privmsgs_folder`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_privmsgs_rules`
-- 

CREATE TABLE `phpbb_privmsgs_rules` (
  `rule_id` mediumint(8) unsigned NOT NULL auto_increment,
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `rule_check` mediumint(4) unsigned NOT NULL default '0',
  `rule_connection` mediumint(4) unsigned NOT NULL default '0',
  `rule_string` varchar(255) NOT NULL default '',
  `rule_user_id` mediumint(8) unsigned NOT NULL default '0',
  `rule_group_id` mediumint(8) unsigned NOT NULL default '0',
  `rule_action` mediumint(4) unsigned NOT NULL default '0',
  `rule_folder_id` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`rule_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `phpbb_privmsgs_rules`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_privmsgs_to`
-- 

CREATE TABLE `phpbb_privmsgs_to` (
  `msg_id` mediumint(8) unsigned NOT NULL default '0',
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `author_id` mediumint(8) unsigned NOT NULL default '0',
  `deleted` tinyint(1) unsigned NOT NULL default '0',
  `new` tinyint(1) unsigned NOT NULL default '1',
  `unread` tinyint(1) unsigned NOT NULL default '1',
  `replied` tinyint(1) unsigned NOT NULL default '0',
  `marked` tinyint(1) unsigned NOT NULL default '0',
  `forwarded` tinyint(1) unsigned NOT NULL default '0',
  `folder_id` int(10) NOT NULL default '0',
  KEY `msg_id` (`msg_id`),
  KEY `user_id` (`user_id`,`folder_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- 导出表中的数据 `phpbb_privmsgs_to`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_profile_fields`
-- 

CREATE TABLE `phpbb_profile_fields` (
  `field_id` mediumint(8) unsigned NOT NULL auto_increment,
  `field_name` varchar(255) NOT NULL default '',
  `field_type` mediumint(8) unsigned NOT NULL default '0',
  `field_ident` varchar(20) NOT NULL default '',
  `field_length` varchar(20) NOT NULL default '',
  `field_minlen` varchar(255) NOT NULL default '',
  `field_maxlen` varchar(255) NOT NULL default '',
  `field_novalue` varchar(255) NOT NULL default '',
  `field_default_value` varchar(255) NOT NULL default '0',
  `field_validation` varchar(20) NOT NULL default '',
  `field_required` tinyint(1) unsigned NOT NULL default '0',
  `field_show_on_reg` tinyint(1) unsigned NOT NULL default '0',
  `field_hide` tinyint(1) unsigned NOT NULL default '0',
  `field_no_view` tinyint(1) unsigned NOT NULL default '0',
  `field_active` tinyint(1) unsigned NOT NULL default '0',
  `field_order` tinyint(4) unsigned NOT NULL default '0',
  PRIMARY KEY  (`field_id`),
  KEY `field_type` (`field_type`),
  KEY `field_order` (`field_order`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `phpbb_profile_fields`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_profile_fields_data`
-- 

CREATE TABLE `phpbb_profile_fields_data` (
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- 导出表中的数据 `phpbb_profile_fields_data`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_profile_fields_lang`
-- 

CREATE TABLE `phpbb_profile_fields_lang` (
  `field_id` mediumint(8) unsigned NOT NULL default '0',
  `lang_id` mediumint(8) unsigned NOT NULL default '0',
  `option_id` mediumint(8) unsigned NOT NULL default '0',
  `field_type` tinyint(4) NOT NULL default '0',
  `value` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`field_id`,`lang_id`,`option_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- 导出表中的数据 `phpbb_profile_fields_lang`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_profile_lang`
-- 

CREATE TABLE `phpbb_profile_lang` (
  `field_id` mediumint(8) unsigned NOT NULL default '0',
  `lang_id` tinyint(4) unsigned NOT NULL default '0',
  `lang_name` varchar(255) NOT NULL default '',
  `lang_explain` text,
  `lang_default_value` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`field_id`,`lang_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- 导出表中的数据 `phpbb_profile_lang`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_ranks`
-- 

CREATE TABLE `phpbb_ranks` (
  `rank_id` smallint(5) unsigned NOT NULL auto_increment,
  `rank_title` varchar(255) NOT NULL default '',
  `rank_min` mediumint(8) NOT NULL default '0',
  `rank_special` tinyint(1) default '0',
  `rank_image` varchar(255) default NULL,
  PRIMARY KEY  (`rank_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- 导出表中的数据 `phpbb_ranks`
-- 

INSERT INTO `phpbb_ranks` (`rank_id`, `rank_title`, `rank_min`, `rank_special`, `rank_image`) VALUES 
(1, 'Site Admin', -1, 1, NULL);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_reports`
-- 

CREATE TABLE `phpbb_reports` (
  `report_id` smallint(5) unsigned NOT NULL auto_increment,
  `reason_id` smallint(5) unsigned NOT NULL default '0',
  `post_id` mediumint(8) unsigned NOT NULL default '0',
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `user_notify` tinyint(1) NOT NULL default '0',
  `report_closed` tinyint(1) NOT NULL default '0',
  `report_time` int(11) unsigned NOT NULL default '0',
  `report_text` mediumtext,
  PRIMARY KEY  (`report_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `phpbb_reports`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_reports_reasons`
-- 

CREATE TABLE `phpbb_reports_reasons` (
  `reason_id` smallint(6) NOT NULL auto_increment,
  `reason_title` varchar(255) NOT NULL default '',
  `reason_description` text,
  `reason_order` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`reason_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- 
-- 导出表中的数据 `phpbb_reports_reasons`
-- 

INSERT INTO `phpbb_reports_reasons` (`reason_id`, `reason_title`, `reason_description`, `reason_order`) VALUES 
(1, 'warez', 'The reported post contains links to pirated or illegal software', 1),
(2, 'spam', 'The reported post has for only purpose to advertise for a website or another product', 2),
(3, 'off_topic', 'The reported post is off topic', 3),
(4, 'other', 'The reported post does not fit into any other category (please use the description field)', 4);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_search_results`
-- 

CREATE TABLE `phpbb_search_results` (
  `search_key` varchar(32) NOT NULL default '',
  `search_time` int(11) NOT NULL default '0',
  `search_keywords` mediumtext,
  `search_authors` mediumtext,
  PRIMARY KEY  (`search_key`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- 导出表中的数据 `phpbb_search_results`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_search_wordlist`
-- 

CREATE TABLE `phpbb_search_wordlist` (
  `word_text` varchar(252) character set latin1 collate latin1_bin NOT NULL default '',
  `word_id` mediumint(8) unsigned NOT NULL auto_increment,
  `word_common` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`word_text`),
  KEY `word_id` (`word_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- 
-- 导出表中的数据 `phpbb_search_wordlist`
-- 

INSERT INTO `phpbb_search_wordlist` (`word_text`, `word_id`, `word_common`) VALUES 
('example', 1, 0),
('post', 2, 0),
('phpbb', 3, 0),
('installation', 4, 0),
('delete', 5, 0),
('topic', 6, 0),
('forum', 7, 0),
('since', 8, 0),
('everything', 9, 0),
('seems', 10, 0),
('working', 11, 0),
('welcome', 12, 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_search_wordmatch`
-- 

CREATE TABLE `phpbb_search_wordmatch` (
  `post_id` mediumint(8) unsigned NOT NULL default '0',
  `word_id` mediumint(8) unsigned NOT NULL default '0',
  `title_match` tinyint(1) NOT NULL default '0',
  KEY `word_id` (`word_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- 导出表中的数据 `phpbb_search_wordmatch`
-- 

INSERT INTO `phpbb_search_wordmatch` (`post_id`, `word_id`, `title_match`) VALUES 
(1, 1, 0),
(1, 2, 0),
(1, 3, 0),
(1, 4, 0),
(1, 5, 0),
(1, 6, 0),
(1, 7, 0),
(1, 8, 0),
(1, 9, 0),
(1, 10, 0),
(1, 11, 0),
(1, 12, 1),
(1, 3, 1);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_sessions`
-- 

CREATE TABLE `phpbb_sessions` (
  `session_id` varchar(32) NOT NULL default '',
  `session_user_id` mediumint(8) unsigned NOT NULL default '0',
  `session_last_visit` int(11) NOT NULL default '0',
  `session_start` int(11) NOT NULL default '0',
  `session_time` int(11) NOT NULL default '0',
  `session_ip` varchar(40) NOT NULL default '0',
  `session_browser` varchar(150) NOT NULL default '',
  `session_page` varchar(200) NOT NULL default '',
  `session_viewonline` tinyint(1) NOT NULL default '1',
  `session_autologin` tinyint(1) NOT NULL default '0',
  `session_admin` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`session_id`),
  KEY `session_time` (`session_time`),
  KEY `session_user_id` (`session_user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- 导出表中的数据 `phpbb_sessions`
-- 

INSERT INTO `phpbb_sessions` (`session_id`, `session_user_id`, `session_last_visit`, `session_start`, `session_time`, `session_ip`, `session_browser`, `session_page`, `session_viewonline`, `session_autologin`, `session_admin`) VALUES 
('c9dd763cef6233bab825b270734e0f17', 2, 1168567952, 1168587195, 1168590721, '127.0.0.1', 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0; IEShow Toolbar; IEShow oktieToolBar; .NET CLR 2.0.50727; Maxthon 2.0)', 'userinfo.php?i=2', 1, 0, 0),
('0520f29fcb7c5b0119f25f755ca89321', 2, 1168567952, 1168590363, 1168590367, '127.0.0.1', 'Mozilla/5.0 (Windows; U; Windows NT 5.0; zh-CN; rv:1.8.1) Gecko/20061010 Firefox/2.0', 'userinfo.php?i=2', 1, 0, 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_sessions_keys`
-- 

CREATE TABLE `phpbb_sessions_keys` (
  `key_id` varchar(32) NOT NULL default '',
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `last_ip` varchar(40) NOT NULL default '',
  `last_login` int(11) NOT NULL default '0',
  PRIMARY KEY  (`key_id`,`user_id`),
  KEY `last_login` (`last_login`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- 导出表中的数据 `phpbb_sessions_keys`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_shop_goods`
-- 

CREATE TABLE `phpbb_shop_goods` (
  `record_id` int(10) NOT NULL auto_increment,
  `shop_id` int(10) NOT NULL default '0',
  `good_id` int(10) NOT NULL default '0',
  `buy_sell` tinyint(1) NOT NULL default '0',
  `allow_num` int(10) NOT NULL default '0',
  `acc_num` int(10) NOT NULL default '0',
  `gold_coin` int(10) NOT NULL default '0',
  `silver_coin` int(10) NOT NULL default '0',
  `copper_coin` int(10) NOT NULL default '0',
  `cess` tinyint(3) NOT NULL default '0',
  PRIMARY KEY  (`record_id`),
  UNIQUE KEY `shop_id` (`shop_id`,`good_id`,`buy_sell`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=29 ;

-- 
-- 导出表中的数据 `phpbb_shop_goods`
-- 

INSERT INTO `phpbb_shop_goods` (`record_id`, `shop_id`, `good_id`, `buy_sell`, `allow_num`, `acc_num`, `gold_coin`, `silver_coin`, `copper_coin`, `cess`) VALUES 
(1, 1, 1, 1, 200, 30, 0, 0, 8, 0),
(2, 1, 2, 1, 200, 0, 0, 0, 12, 0),
(3, 1, 3, 1, 200, 0, 0, 0, 10, 0),
(4, 1, 4, 1, 200, 0, 0, 0, 10, 0),
(5, 1, 5, 1, 200, 0, 0, 0, 10, 0),
(6, 1, 6, 1, 200, 1, 0, 0, 12, 0),
(7, 1, 7, 1, 200, 0, 0, 0, 26, 0),
(8, 1, 8, 1, 200, 0, 0, 0, 34, 0),
(9, 1, 9, 1, 200, 0, 1, 0, 0, 0),
(10, 1, 10, 1, 200, 0, 0, 2, 0, 0),
(11, 1, 11, 1, 200, 0, 0, 0, 4, 0),
(12, 1, 12, 1, 200, 0, 0, 0, 600, 0),
(13, 1, 13, 1, 200, 0, 0, 0, 80, 0),
(14, 1, 1, 2, 200, 24, 0, 0, 8, 0),
(15, 1, 2, 2, 200, 0, 0, 0, 12, 0),
(16, 1, 3, 2, 200, 0, 0, 0, 10, 0),
(17, 1, 4, 2, 200, 0, 0, 0, 10, 0),
(18, 1, 5, 2, 200, 0, 0, 0, 10, 0),
(19, 1, 6, 2, 200, 1, 0, 0, 12, 0),
(20, 1, 7, 2, 200, 0, 0, 0, 26, 0),
(21, 1, 8, 2, 200, 0, 0, 0, 34, 0),
(22, 1, 9, 2, 200, 0, 1, 0, 0, 0),
(23, 1, 10, 2, 200, 0, 0, 2, 0, 0),
(24, 1, 11, 2, 200, 0, 0, 0, 4, 0),
(25, 1, 12, 2, 200, 0, 0, 0, 600, 0),
(26, 1, 13, 2, 200, 0, 0, 0, 80, 0),
(27, 1, 16, 1, 200, 0, 0, 0, 30, 0),
(28, 1, 16, 2, 200, 0, 0, 0, 30, 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_shop_log`
-- 

CREATE TABLE `phpbb_shop_log` (
  `record_id` int(10) NOT NULL default '0',
  `shop_id` int(10) NOT NULL default '0',
  `good_id` int(10) NOT NULL default '0',
  `user_id` int(10) NOT NULL default '0',
  `trade_time` int(10) NOT NULL default '0',
  `gold_coin` int(10) NOT NULL default '0',
  `silver_coin` int(10) NOT NULL default '0',
  `copper_coin` int(10) NOT NULL default '0',
  `cess` int(10) NOT NULL default '0',
  `good_num` int(10) NOT NULL default '0',
  `buy_sell` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`record_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- 导出表中的数据 `phpbb_shop_log`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_shop_storage`
-- 

CREATE TABLE `phpbb_shop_storage` (
  `record_id` int(10) NOT NULL default '0',
  `shop_id` int(10) NOT NULL default '0',
  `good_id` int(10) NOT NULL default '0',
  `good_num` int(10) NOT NULL default '0',
  PRIMARY KEY  (`record_id`),
  UNIQUE KEY `shop_id` (`shop_id`,`good_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- 导出表中的数据 `phpbb_shop_storage`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_sitelist`
-- 

CREATE TABLE `phpbb_sitelist` (
  `site_id` mediumint(8) unsigned NOT NULL auto_increment,
  `site_ip` varchar(40) NOT NULL default '',
  `site_hostname` varchar(255) NOT NULL default '',
  `ip_exclude` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`site_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `phpbb_sitelist`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_smilies`
-- 

CREATE TABLE `phpbb_smilies` (
  `smiley_id` tinyint(4) unsigned NOT NULL auto_increment,
  `code` varchar(50) default NULL,
  `emotion` varchar(50) default NULL,
  `smiley_url` varchar(50) default NULL,
  `smiley_width` tinyint(4) unsigned NOT NULL default '0',
  `smiley_height` tinyint(4) unsigned NOT NULL default '0',
  `smiley_order` tinyint(4) unsigned NOT NULL default '0',
  `display_on_posting` tinyint(1) unsigned NOT NULL default '1',
  PRIMARY KEY  (`smiley_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

-- 
-- 导出表中的数据 `phpbb_smilies`
-- 

INSERT INTO `phpbb_smilies` (`smiley_id`, `code`, `emotion`, `smiley_url`, `smiley_width`, `smiley_height`, `smiley_order`, `display_on_posting`) VALUES 
(1, ':D', 'Very Happy', 'icon_biggrin.gif', 15, 15, 1, 1),
(2, ':)', 'Smile', 'icon_smile.gif', 15, 15, 2, 1),
(3, ':(', 'Sad', 'icon_sad.gif', 15, 15, 3, 1),
(4, ':o', 'Surprised', 'icon_surprised.gif', 15, 15, 4, 1),
(5, ':eek:', 'Surprised', 'icon_surprised.gif', 15, 15, 4, 1),
(6, '8O', 'Shocked', 'icon_eek.gif', 15, 15, 5, 1),
(7, ':?', 'Confused', 'icon_confused.gif', 15, 15, 6, 1),
(8, '8)', 'Cool', 'icon_cool.gif', 15, 15, 7, 1),
(9, ':lol:', 'Laughing', 'icon_lol.gif', 15, 15, 8, 1),
(10, ':x', 'Mad', 'icon_mad.gif', 15, 15, 9, 1),
(11, ':P', 'Razz', 'icon_razz.gif', 15, 15, 10, 1),
(12, ':oops:', 'Embarassed', 'icon_redface.gif', 15, 15, 11, 1),
(13, ':cry:', 'Crying or Very sad', 'icon_cry.gif', 15, 15, 12, 1),
(14, ':evil:', 'Evil or Very Mad', 'icon_evil.gif', 15, 15, 13, 1),
(15, ':twisted:', 'Twisted Evil', 'icon_twisted.gif', 15, 15, 14, 1),
(16, ':roll:', 'Rolling Eyes', 'icon_rolleyes.gif', 15, 15, 15, 1),
(17, ';)', 'Wink', 'icon_wink.gif', 15, 15, 16, 1),
(18, ':!:', 'Exclamation', 'icon_exclaim.gif', 15, 15, 17, 1),
(19, ':?:', 'Question', 'icon_question.gif', 15, 15, 18, 1),
(20, ':idea:', 'Idea', 'icon_idea.gif', 15, 15, 19, 1),
(21, ':arrow:', 'Arrow', 'icon_arrow.gif', 15, 15, 20, 1),
(22, ':|', 'Neutral', 'icon_neutral.gif', 15, 15, 21, 1),
(23, ':mrgreen:', 'Mr. Green', 'icon_mrgreen.gif', 15, 15, 22, 1);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_styles`
-- 

CREATE TABLE `phpbb_styles` (
  `style_id` tinyint(4) unsigned NOT NULL auto_increment,
  `style_name` varchar(255) NOT NULL default '',
  `style_copyright` varchar(255) NOT NULL default '',
  `style_active` tinyint(1) NOT NULL default '1',
  `template_id` tinyint(4) unsigned NOT NULL default '0',
  `theme_id` tinyint(4) unsigned NOT NULL default '0',
  `imageset_id` tinyint(4) unsigned NOT NULL default '0',
  PRIMARY KEY  (`style_id`),
  UNIQUE KEY `style_name` (`style_name`),
  KEY `template_id` (`template_id`),
  KEY `theme_id` (`theme_id`),
  KEY `imageset_id` (`imageset_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- 导出表中的数据 `phpbb_styles`
-- 

INSERT INTO `phpbb_styles` (`style_id`, `style_name`, `style_copyright`, `style_active`, `template_id`, `theme_id`, `imageset_id`) VALUES 
(1, 'subSilver', '&copy; phpBB Group', 1, 1, 1, 1);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_styles_imageset`
-- 

CREATE TABLE `phpbb_styles_imageset` (
  `imageset_id` tinyint(4) unsigned NOT NULL auto_increment,
  `imageset_name` varchar(255) NOT NULL default '',
  `imageset_copyright` varchar(255) NOT NULL default '',
  `imageset_path` varchar(100) NOT NULL default '',
  `site_logo` varchar(200) NOT NULL default '',
  `btn_post` varchar(200) NOT NULL default '',
  `btn_post_pm` varchar(200) NOT NULL default '',
  `btn_reply` varchar(200) NOT NULL default '',
  `btn_reply_pm` varchar(200) NOT NULL default '',
  `btn_locked` varchar(200) NOT NULL default '',
  `btn_profile` varchar(200) NOT NULL default '',
  `btn_pm` varchar(200) NOT NULL default '',
  `btn_delete` varchar(200) NOT NULL default '',
  `btn_info` varchar(200) NOT NULL default '',
  `btn_quote` varchar(200) NOT NULL default '',
  `btn_search` varchar(200) NOT NULL default '',
  `btn_edit` varchar(200) NOT NULL default '',
  `btn_report` varchar(200) NOT NULL default '',
  `btn_email` varchar(200) NOT NULL default '',
  `btn_www` varchar(200) NOT NULL default '',
  `btn_icq` varchar(200) NOT NULL default '',
  `btn_aim` varchar(200) NOT NULL default '',
  `btn_yim` varchar(200) NOT NULL default '',
  `btn_msnm` varchar(200) NOT NULL default '',
  `btn_jabber` varchar(200) NOT NULL default '',
  `btn_online` varchar(200) NOT NULL default '',
  `btn_offline` varchar(200) NOT NULL default '',
  `btn_friend` varchar(200) NOT NULL default '',
  `btn_foe` varchar(200) NOT NULL default '',
  `icon_unapproved` varchar(200) NOT NULL default '',
  `icon_reported` varchar(200) NOT NULL default '',
  `icon_attach` varchar(200) NOT NULL default '',
  `icon_post` varchar(200) NOT NULL default '',
  `icon_post_new` varchar(200) NOT NULL default '',
  `icon_post_latest` varchar(200) NOT NULL default '',
  `icon_post_newest` varchar(200) NOT NULL default '',
  `forum` varchar(200) NOT NULL default '',
  `forum_new` varchar(200) NOT NULL default '',
  `forum_locked` varchar(200) NOT NULL default '',
  `forum_link` varchar(200) NOT NULL default '',
  `sub_forum` varchar(200) NOT NULL default '',
  `sub_forum_new` varchar(200) NOT NULL default '',
  `folder` varchar(200) NOT NULL default '',
  `folder_moved` varchar(200) NOT NULL default '',
  `folder_posted` varchar(200) NOT NULL default '',
  `folder_new` varchar(200) NOT NULL default '',
  `folder_new_posted` varchar(200) NOT NULL default '',
  `folder_hot` varchar(200) NOT NULL default '',
  `folder_hot_posted` varchar(200) NOT NULL default '',
  `folder_hot_new` varchar(200) NOT NULL default '',
  `folder_hot_new_posted` varchar(200) NOT NULL default '',
  `folder_locked` varchar(200) NOT NULL default '',
  `folder_locked_posted` varchar(200) NOT NULL default '',
  `folder_locked_new` varchar(200) NOT NULL default '',
  `folder_locked_new_posted` varchar(200) NOT NULL default '',
  `folder_sticky` varchar(200) NOT NULL default '',
  `folder_sticky_posted` varchar(200) NOT NULL default '',
  `folder_sticky_new` varchar(200) NOT NULL default '',
  `folder_sticky_new_posted` varchar(200) NOT NULL default '',
  `folder_announce` varchar(200) NOT NULL default '',
  `folder_announce_posted` varchar(200) NOT NULL default '',
  `folder_announce_new` varchar(200) NOT NULL default '',
  `folder_announce_new_posted` varchar(200) NOT NULL default '',
  `folder_global` varchar(200) NOT NULL default '',
  `folder_global_posted` varchar(200) NOT NULL default '',
  `folder_global_new` varchar(200) NOT NULL default '',
  `folder_global_new_posted` varchar(200) NOT NULL default '',
  `poll_left` varchar(200) NOT NULL default '',
  `poll_center` varchar(200) NOT NULL default '',
  `poll_right` varchar(200) NOT NULL default '',
  `attach_progress_bar` varchar(200) NOT NULL default '',
  `user_icon1` varchar(200) NOT NULL default '',
  `user_icon2` varchar(200) NOT NULL default '',
  `user_icon3` varchar(200) NOT NULL default '',
  `user_icon4` varchar(200) NOT NULL default '',
  `user_icon5` varchar(200) NOT NULL default '',
  `user_icon6` varchar(200) NOT NULL default '',
  `user_icon7` varchar(200) NOT NULL default '',
  `user_icon8` varchar(200) NOT NULL default '',
  `user_icon9` varchar(200) NOT NULL default '',
  `user_icon10` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`imageset_id`),
  UNIQUE KEY `imageset_name` (`imageset_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- 导出表中的数据 `phpbb_styles_imageset`
-- 

INSERT INTO `phpbb_styles_imageset` (`imageset_id`, `imageset_name`, `imageset_copyright`, `imageset_path`, `site_logo`, `btn_post`, `btn_post_pm`, `btn_reply`, `btn_reply_pm`, `btn_locked`, `btn_profile`, `btn_pm`, `btn_delete`, `btn_info`, `btn_quote`, `btn_search`, `btn_edit`, `btn_report`, `btn_email`, `btn_www`, `btn_icq`, `btn_aim`, `btn_yim`, `btn_msnm`, `btn_jabber`, `btn_online`, `btn_offline`, `btn_friend`, `btn_foe`, `icon_unapproved`, `icon_reported`, `icon_attach`, `icon_post`, `icon_post_new`, `icon_post_latest`, `icon_post_newest`, `forum`, `forum_new`, `forum_locked`, `forum_link`, `sub_forum`, `sub_forum_new`, `folder`, `folder_moved`, `folder_posted`, `folder_new`, `folder_new_posted`, `folder_hot`, `folder_hot_posted`, `folder_hot_new`, `folder_hot_new_posted`, `folder_locked`, `folder_locked_posted`, `folder_locked_new`, `folder_locked_new_posted`, `folder_sticky`, `folder_sticky_posted`, `folder_sticky_new`, `folder_sticky_new_posted`, `folder_announce`, `folder_announce_posted`, `folder_announce_new`, `folder_announce_new_posted`, `folder_global`, `folder_global_posted`, `folder_global_new`, `folder_global_new_posted`, `poll_left`, `poll_center`, `poll_right`, `attach_progress_bar`, `user_icon1`, `user_icon2`, `user_icon3`, `user_icon4`, `user_icon5`, `user_icon6`, `user_icon7`, `user_icon8`, `user_icon9`, `user_icon10`) VALUES 
(1, 'subSilver', '&copy; phpBB Group', 'subSilver', 'sitelogo.gif*94*170', '{LANG}/btn_post.gif*27*97', '{LANG}/btn_post_pm.gif*27*97', '{LANG}/btn_reply.gif*27*97', '{LANG}/btn_reply_pm.gif*20*90', '{LANG}/btn_locked.gif*27*97', '{LANG}/btn_profile.gif*20*72', '{LANG}/btn_pm.gif*20*72', '{LANG}/btn_delete.gif*20*20', '{LANG}/btn_info.gif*20*20', '{LANG}/btn_quote.gif*20*90', '{LANG}/btn_search.gif*20*72', '{LANG}/btn_edit.gif*20*90', '{LANG}/btn_report.gif*20*20', '{LANG}/btn_email.gif*20*72', '{LANG}/btn_www.gif*20*72', '{LANG}/btn_icq.gif*20*72', '{LANG}/btn_aim.gif*20*72', '{LANG}/btn_yim.gif*20*72', '{LANG}/btn_msnm.gif*20*72', '{LANG}/btn_jabber.gif*20*72', '{LANG}/btn_online.gif*20*72', '{LANG}/btn_offline.gif*20*72', '', '', 'icon_unapproved.gif*18*19', 'icon_reported.gif*18*19', 'icon_attach.gif*18*14', 'icon_minipost.gif*9*12', 'icon_minipost_new.gif*9*12', 'icon_latest_reply.gif*9*18', 'icon_newest_reply.gif*9*18', 'folder_big.gif*25*46', 'folder_new_big.gif*25*46', 'folder_locked_big.gif*25*46', 'folder_link_big.gif*25*46', 'subfolder_big.gif*25*46', 'subfolder_new_big.gif*25*46', 'folder.gif*18*19', 'folder_moved.gif*18*19', 'folder_posted.gif*18*19', 'folder_new.gif*18*19', 'folder_new_posted.gif*18*19', 'folder_hot.gif*18*19', 'folder_hot_posted.gif*18*19', 'folder_new_hot.gif*18*19', 'folder_new_hot_posted.gif*18*19', 'folder_lock.gif*18*19', 'folder_lock_posted.gif*18*19', 'folder_lock_new.gif*18*19', 'folder_lock_new_posted.gif*18*19', 'folder_sticky.gif*18*19', 'folder_sticky_posted.gif*18*19', 'folder_sticky_new.gif*18*19', 'folder_sticky_new_posted.gif*18*19', 'folder_announce.gif*18*19', 'folder_announce_posted.gif*18*19', 'folder_announce_new.gif*18*19', 'folder_announce_new_posted.gif*18*19', '', '', '', '', 'vote_lcap.gif*12*4', 'voting_bar.gif*12', 'vote_rcap.gif*12*4', 'progress_bar.gif*16*280', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_styles_template`
-- 

CREATE TABLE `phpbb_styles_template` (
  `template_id` tinyint(4) unsigned NOT NULL auto_increment,
  `template_name` varchar(255) NOT NULL default '',
  `template_copyright` varchar(255) NOT NULL default '',
  `template_path` varchar(100) NOT NULL default '',
  `bbcode_bitfield` int(11) unsigned NOT NULL default '6921',
  `template_storedb` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`template_id`),
  UNIQUE KEY `template_name` (`template_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- 导出表中的数据 `phpbb_styles_template`
-- 

INSERT INTO `phpbb_styles_template` (`template_id`, `template_name`, `template_copyright`, `template_path`, `bbcode_bitfield`, `template_storedb`) VALUES 
(1, 'subSilver', '&copy; phpBB Group', 'subSilver', 6921, 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_styles_template_data`
-- 

CREATE TABLE `phpbb_styles_template_data` (
  `template_id` tinyint(4) unsigned NOT NULL default '0',
  `template_filename` varchar(100) NOT NULL default '',
  `template_included` text,
  `template_mtime` int(11) NOT NULL default '0',
  `template_data` mediumtext,
  KEY `template_id` (`template_id`),
  KEY `template_filename` (`template_filename`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- 导出表中的数据 `phpbb_styles_template_data`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_styles_theme`
-- 

CREATE TABLE `phpbb_styles_theme` (
  `theme_id` tinyint(4) unsigned NOT NULL auto_increment,
  `theme_name` varchar(255) NOT NULL default '',
  `theme_copyright` varchar(255) NOT NULL default '',
  `theme_path` varchar(100) NOT NULL default '',
  `theme_storedb` tinyint(1) NOT NULL default '0',
  `theme_mtime` int(11) NOT NULL default '0',
  `theme_data` mediumtext,
  PRIMARY KEY  (`theme_id`),
  UNIQUE KEY `theme_name` (`theme_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- 导出表中的数据 `phpbb_styles_theme`
-- 

INSERT INTO `phpbb_styles_theme` (`theme_id`, `theme_name`, `theme_copyright`, `theme_path`, `theme_storedb`, `theme_mtime`, `theme_data`) VALUES 
(1, 'subSilver', '&copy; phpBB Group', 'subSilver', 0, 0, '');

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_system_formula`
-- 

CREATE TABLE `phpbb_system_formula` (
  `formulaid` int(10) unsigned NOT NULL auto_increment,
  `objectid` int(10) NOT NULL default '0',
  `objectname` varchar(80) collate utf8_unicode_ci NOT NULL default '',
  `object1` varchar(250) collate utf8_unicode_ci NOT NULL default '',
  `object2` varchar(250) collate utf8_unicode_ci NOT NULL default '',
  `object3` varchar(250) collate utf8_unicode_ci NOT NULL default '',
  `object4` varchar(250) collate utf8_unicode_ci NOT NULL default '',
  `skill1` varchar(250) collate utf8_unicode_ci NOT NULL default '',
  `skill2` varchar(250) collate utf8_unicode_ci NOT NULL default '',
  `formulatype` smallint(6) NOT NULL default '0',
  `systemtype` smallint(6) NOT NULL default '0',
  `formulastate` tinyint(2) NOT NULL default '0',
  `ownerid` int(10) NOT NULL default '0',
  `su_numerator` int(10) unsigned NOT NULL default '0',
  `su_denominator` int(10) unsigned NOT NULL default '1000',
  PRIMARY KEY  (`formulaid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- 
-- 导出表中的数据 `phpbb_system_formula`
-- 

INSERT INTO `phpbb_system_formula` (`formulaid`, `objectid`, `objectname`, `object1`, `object2`, `object3`, `object4`, `skill1`, `skill2`, `formulatype`, `systemtype`, `formulastate`, `ownerid`, `su_numerator`, `su_denominator`) VALUES 
(1, 16, '石砖', 'a:4:{s:4:"obid";i:1;s:6:"obname";s:6:"石头";s:4:"oblv";i:1;s:5:"obnum";i:5;}', '', '', '', 'a:3:{s:4:"skid";i:1;s:6:"skname";s:12:"巨石加工";s:4:"sklv";i:1;}', '', 0, 0, 0, 0, 0, 1000);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_system_object`
-- 

CREATE TABLE `phpbb_system_object` (
  `object_id` int(10) NOT NULL auto_increment,
  `name` varchar(40) collate utf8_unicode_ci NOT NULL default '',
  `desc` text collate utf8_unicode_ci NOT NULL,
  `weight` int(10) NOT NULL default '0',
  `level` tinyint(3) NOT NULL default '0',
  `cost` int(10) NOT NULL default '0',
  `occupation` tinyint(2) NOT NULL default '0',
  `use` tinyint(1) NOT NULL default '0',
  `system_type` tinyint(1) NOT NULL default '0',
  `effectname1` varchar(20) collate utf8_unicode_ci NOT NULL default '',
  `effect1` tinyint(4) NOT NULL default '0',
  `effectname2` varchar(20) collate utf8_unicode_ci NOT NULL default '',
  `effect2` tinyint(4) NOT NULL default '0',
  `author` varchar(40) collate utf8_unicode_ci NOT NULL default '',
  `authorid` int(10) NOT NULL default '0',
  `unit` varchar(20) collate utf8_unicode_ci NOT NULL default '',
  PRIMARY KEY  (`object_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

-- 
-- 导出表中的数据 `phpbb_system_object`
-- 

INSERT INTO `phpbb_system_object` (`object_id`, `name`, `desc`, `weight`, `level`, `cost`, `occupation`, `use`, `system_type`, `effectname1`, `effect1`, `effectname2`, `effect2`, `author`, `authorid`, `unit`) VALUES 
(1, '石头', '这是普通的不能再普通的东西了，但是却是谁也离不开它', 5, 1, 1, 0, 0, 1, '', 0, '', 0, '', 0, 'å—'),
(2, '木材', '', 3, 1, 1, 0, 0, 1, '', 0, '', 0, '', 0, 'å—'),
(3, '兽骨', '动物骨骼是魔法师跟建筑师都需要的原料', 2, 1, 1, 0, 0, 1, '', 0, '', 0, '', 0, 'å—'),
(4, '动物的皮', '这是制作皮革装备的原材料，来源是森林中各式各样的动物', 2, 1, 1, 0, 0, 1, '', 0, '', 0, '', 0, 'å¼ '),
(5, '动物的肉', '味道鲜美，做成食品后，可以补充体力', 3, 1, 1, 0, 0, 1, '', 0, '', 0, '', 0, ''),
(6, '煤块', '黑黑的，是燃烧必备的原料', 4, 1, 2, 0, 0, 1, '', 0, '', 0, '', 0, ''),
(7, '铁块', '', 7, 2, 3, 0, 0, 1, '', 0, '', 0, '', 0, ''),
(8, '铜块', '', 8, 2, 5, 0, 0, 1, '', 0, '', 0, '', 0, ''),
(9, '钻石', '', 5, 1, 500, 0, 0, 1, '', 0, '', 0, '', 0, ''),
(10, '卡利鸟的羽毛', '', 1, 1, 2, 0, 0, 1, '', 0, '', 0, '', 0, ''),
(11, '麦子', '酿酒,做面包', 2, 1, 1, 0, 0, 1, '', 0, '', 0, '', 0, ''),
(12, '巴布果', '是一种很好的药材，据说也是魔法原料', 2, 1, 2, 0, 0, 1, '', 0, '', 0, '', 0, ''),
(13, '布料', '', 2, 1, 2, 0, 0, 1, '', 0, '', 0, '', 0, ''),
(14, '独角兽的犄角', '非常珍贵的魔法材料', 3, 1, 400, 0, 0, 1, '', 0, '', 0, '', 0, ''),
(15, '乌布拉德的羽毛', '一种生活在西方的动物的羽毛', 1, 1, 300, 0, 0, 1, '', 0, '', 0, '', 0, 'ä¸ª'),
(16, '石砖', '建筑使用的基本材料', 5, 2, 3, 0, 0, 1, '', 0, '', 0, '', 0, '块');

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_system_skills`
-- 

CREATE TABLE `phpbb_system_skills` (
  `skill_id` int(10) unsigned NOT NULL auto_increment,
  `skill_name` varchar(120) collate utf8_unicode_ci NOT NULL default '',
  `skill_desc` text collate utf8_unicode_ci NOT NULL,
  `skill_type` smallint(4) unsigned NOT NULL default '0',
  `stduy_lv` smallint(6) unsigned NOT NULL default '2',
  `att_name1` int(10) unsigned NOT NULL default '0',
  `att_value1` int(10) NOT NULL default '0',
  `att_name2` int(10) unsigned NOT NULL default '0',
  `att_value2` int(10) NOT NULL default '0',
  `exp` int(10) NOT NULL default '0',
  `timevalue` int(10) NOT NULL default '0',
  `energy` int(10) NOT NULL default '0',
  `distance` int(10) NOT NULL default '0',
  `sysbuild` smallint(6) NOT NULL default '0',
  PRIMARY KEY  (`skill_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

-- 
-- 导出表中的数据 `phpbb_system_skills`
-- 

INSERT INTO `phpbb_system_skills` (`skill_id`, `skill_name`, `skill_desc`, `skill_type`, `stduy_lv`, `att_name1`, `att_value1`, `att_name2`, `att_value2`, `exp`, `timevalue`, `energy`, `distance`, `sysbuild`) VALUES 
(1, '巨石加工', '将收集到的完整的石头进行整理,这是每一个想要成为建筑巨匠的第一步.做好这一步,才是正式步入了建筑学徒的大门', 1, 1, 0, 0, 0, 0, 20, 1200, 0, 0, 306),
(2, '金属锻造', '立志成为一个铸造大师的基础学习技能.', 1, 1, 0, 0, 0, 0, 20, 1200, 0, 0, 306),
(3, '木材加工', '木工大师的基本学习项目', 1, 1, 0, 0, 0, 0, 20, 1200, 0, 0, 306),
(4, '裁剪材料', '巧手裁缝的基础技能', 1, 1, 0, 0, 0, 0, 20, 1200, 0, 0, 306);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_topics`
-- 

CREATE TABLE `phpbb_topics` (
  `topic_id` mediumint(8) unsigned NOT NULL auto_increment,
  `forum_id` smallint(5) unsigned NOT NULL default '0',
  `icon_id` tinyint(4) unsigned NOT NULL default '1',
  `topic_attachment` tinyint(1) NOT NULL default '0',
  `topic_approved` tinyint(1) unsigned NOT NULL default '1',
  `topic_reported` tinyint(1) unsigned NOT NULL default '0',
  `topic_title` text,
  `topic_poster` mediumint(8) unsigned NOT NULL default '0',
  `topic_time` int(11) NOT NULL default '0',
  `topic_time_limit` int(11) NOT NULL default '0',
  `topic_views` mediumint(8) unsigned NOT NULL default '0',
  `topic_replies` mediumint(8) unsigned NOT NULL default '0',
  `topic_replies_real` mediumint(8) unsigned NOT NULL default '0',
  `topic_status` tinyint(3) NOT NULL default '0',
  `topic_type` tinyint(3) NOT NULL default '0',
  `topic_first_post_id` mediumint(8) unsigned NOT NULL default '0',
  `topic_first_poster_name` varchar(255) default NULL,
  `topic_last_post_id` mediumint(8) unsigned NOT NULL default '0',
  `topic_last_poster_id` mediumint(8) unsigned NOT NULL default '0',
  `topic_last_poster_name` varchar(255) default NULL,
  `topic_last_post_time` int(11) unsigned NOT NULL default '0',
  `topic_last_view_time` int(11) unsigned NOT NULL default '0',
  `topic_moved_id` mediumint(8) unsigned NOT NULL default '0',
  `topic_bumped` tinyint(1) unsigned NOT NULL default '0',
  `topic_bumper` mediumint(8) unsigned NOT NULL default '0',
  `poll_title` text,
  `poll_start` int(11) default '0',
  `poll_length` int(11) default '0',
  `poll_max_options` tinyint(4) unsigned NOT NULL default '1',
  `poll_last_vote` int(11) unsigned default '0',
  `poll_vote_change` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`topic_id`),
  KEY `forum_id` (`forum_id`),
  KEY `forum_id_type` (`forum_id`,`topic_type`),
  KEY `topic_last_post_time` (`topic_last_post_time`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- 导出表中的数据 `phpbb_topics`
-- 

INSERT INTO `phpbb_topics` (`topic_id`, `forum_id`, `icon_id`, `topic_attachment`, `topic_approved`, `topic_reported`, `topic_title`, `topic_poster`, `topic_time`, `topic_time_limit`, `topic_views`, `topic_replies`, `topic_replies_real`, `topic_status`, `topic_type`, `topic_first_post_id`, `topic_first_poster_name`, `topic_last_post_id`, `topic_last_poster_id`, `topic_last_poster_name`, `topic_last_post_time`, `topic_last_view_time`, `topic_moved_id`, `topic_bumped`, `topic_bumper`, `poll_title`, `poll_start`, `poll_length`, `poll_max_options`, `poll_last_vote`, `poll_vote_change`) VALUES 
(1, 2, 1, 0, 1, 0, 'Welcome to phpBB 3', 2, 1167211017, 0, 0, 0, 0, 0, 0, 1, 'PROSE', 1, 2, 'PROSE', 1167211017, 972086460, 0, 0, 0, '', 0, 0, 1, 0, 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_topics_posted`
-- 

CREATE TABLE `phpbb_topics_posted` (
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `topic_id` mediumint(8) unsigned NOT NULL default '0',
  `topic_posted` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`user_id`,`topic_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- 导出表中的数据 `phpbb_topics_posted`
-- 

INSERT INTO `phpbb_topics_posted` (`user_id`, `topic_id`, `topic_posted`) VALUES 
(2, 1, 1);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_topics_track`
-- 

CREATE TABLE `phpbb_topics_track` (
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `topic_id` mediumint(8) unsigned NOT NULL default '0',
  `forum_id` mediumint(8) unsigned NOT NULL default '0',
  `mark_time` int(11) NOT NULL default '0',
  PRIMARY KEY  (`user_id`,`topic_id`),
  KEY `forum_id` (`forum_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- 导出表中的数据 `phpbb_topics_track`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_topics_watch`
-- 

CREATE TABLE `phpbb_topics_watch` (
  `topic_id` mediumint(8) unsigned NOT NULL default '0',
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `notify_status` tinyint(1) NOT NULL default '0',
  KEY `topic_id` (`topic_id`),
  KEY `user_id` (`user_id`),
  KEY `notify_status` (`notify_status`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- 导出表中的数据 `phpbb_topics_watch`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_user_group`
-- 

CREATE TABLE `phpbb_user_group` (
  `group_id` mediumint(8) NOT NULL default '0',
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `group_leader` tinyint(1) NOT NULL default '0',
  `user_pending` tinyint(1) default NULL,
  KEY `group_id` (`group_id`),
  KEY `user_id` (`user_id`),
  KEY `group_leader` (`group_leader`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- 导出表中的数据 `phpbb_user_group`
-- 

INSERT INTO `phpbb_user_group` (`group_id`, `user_id`, `group_leader`, `user_pending`) VALUES 
(1, 1, 0, 0),
(4, 2, 0, 0),
(7, 2, 1, 0),
(8, 3, 0, 0),
(8, 4, 0, 0),
(8, 5, 0, 0),
(8, 6, 0, 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_users`
-- 

CREATE TABLE `phpbb_users` (
  `user_id` mediumint(8) unsigned NOT NULL auto_increment,
  `user_type` tinyint(1) NOT NULL default '0',
  `group_id` mediumint(8) NOT NULL default '3',
  `user_permissions` text,
  `user_perm_from` mediumint(8) default '0',
  `user_ip` varchar(40) NOT NULL default '',
  `user_regdate` int(11) NOT NULL default '0',
  `username` varchar(255) NOT NULL default '',
  `user_password` varchar(40) NOT NULL default '',
  `user_passchg` int(11) default '0',
  `user_email` varchar(100) NOT NULL default '',
  `user_email_hash` bigint(20) NOT NULL default '0',
  `user_birthday` varchar(10) default '',
  `user_lastvisit` int(11) NOT NULL default '0',
  `user_lastmark` int(11) NOT NULL default '0',
  `user_lastpost_time` int(11) NOT NULL default '0',
  `user_lastpage` varchar(200) NOT NULL default '',
  `user_last_confirm_key` varchar(10) default '',
  `user_last_search` int(11) default '0',
  `user_warnings` tinyint(4) default '0',
  `user_last_warning` int(11) default '0',
  `user_login_attempts` smallint(4) default '0',
  `user_posts` mediumint(8) unsigned NOT NULL default '0',
  `user_lang` varchar(30) NOT NULL default '',
  `user_timezone` decimal(5,2) NOT NULL default '0.00',
  `user_dst` tinyint(1) NOT NULL default '0',
  `user_dateformat` varchar(30) NOT NULL default 'd M Y H:i',
  `user_style` tinyint(4) NOT NULL default '0',
  `user_rank` int(11) default '0',
  `user_colour` varchar(6) NOT NULL default '',
  `user_new_privmsg` tinyint(4) unsigned NOT NULL default '0',
  `user_unread_privmsg` tinyint(4) unsigned NOT NULL default '0',
  `user_last_privmsg` int(11) NOT NULL default '0',
  `user_message_rules` tinyint(1) unsigned NOT NULL default '0',
  `user_full_folder` int(11) NOT NULL default '-3',
  `user_emailtime` int(11) NOT NULL default '0',
  `user_topic_show_days` smallint(4) NOT NULL default '0',
  `user_topic_sortby_type` char(1) NOT NULL default 't',
  `user_topic_sortby_dir` char(1) NOT NULL default 'd',
  `user_post_show_days` smallint(4) NOT NULL default '0',
  `user_post_sortby_type` char(1) NOT NULL default 't',
  `user_post_sortby_dir` char(1) NOT NULL default 'a',
  `user_notify` tinyint(1) NOT NULL default '0',
  `user_notify_pm` tinyint(1) NOT NULL default '1',
  `user_notify_type` tinyint(4) NOT NULL default '0',
  `user_allow_pm` tinyint(1) NOT NULL default '1',
  `user_allow_email` tinyint(1) NOT NULL default '1',
  `user_allow_viewonline` tinyint(1) NOT NULL default '1',
  `user_allow_viewemail` tinyint(1) NOT NULL default '1',
  `user_allow_massemail` tinyint(1) NOT NULL default '1',
  `user_options` int(11) NOT NULL default '893',
  `user_avatar` varchar(255) NOT NULL default '',
  `user_avatar_type` tinyint(2) NOT NULL default '0',
  `user_avatar_width` tinyint(4) unsigned NOT NULL default '0',
  `user_avatar_height` tinyint(4) unsigned NOT NULL default '0',
  `user_sig` text,
  `user_sig_bbcode_uid` varchar(5) default '',
  `user_sig_bbcode_bitfield` int(11) default '0',
  `user_from` varchar(100) default '',
  `user_icq` varchar(15) default '',
  `user_aim` varchar(255) default '',
  `user_yim` varchar(255) default '',
  `user_msnm` varchar(255) default '',
  `user_jabber` varchar(255) default '',
  `user_website` varchar(200) default '',
  `user_occ` varchar(255) default '',
  `user_interests` varchar(255) default '',
  `user_actkey` varchar(32) NOT NULL default '',
  `user_newpasswd` varchar(32) default '',
  PRIMARY KEY  (`user_id`),
  KEY `user_birthday` (`user_birthday`(6)),
  KEY `user_email_hash` (`user_email_hash`),
  KEY `user_type` (`user_type`),
  KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- 
-- 导出表中的数据 `phpbb_users`
-- 

INSERT INTO `phpbb_users` (`user_id`, `user_type`, `group_id`, `user_permissions`, `user_perm_from`, `user_ip`, `user_regdate`, `username`, `user_password`, `user_passchg`, `user_email`, `user_email_hash`, `user_birthday`, `user_lastvisit`, `user_lastmark`, `user_lastpost_time`, `user_lastpage`, `user_last_confirm_key`, `user_last_search`, `user_warnings`, `user_last_warning`, `user_login_attempts`, `user_posts`, `user_lang`, `user_timezone`, `user_dst`, `user_dateformat`, `user_style`, `user_rank`, `user_colour`, `user_new_privmsg`, `user_unread_privmsg`, `user_last_privmsg`, `user_message_rules`, `user_full_folder`, `user_emailtime`, `user_topic_show_days`, `user_topic_sortby_type`, `user_topic_sortby_dir`, `user_post_show_days`, `user_post_sortby_type`, `user_post_sortby_dir`, `user_notify`, `user_notify_pm`, `user_notify_type`, `user_allow_pm`, `user_allow_email`, `user_allow_viewonline`, `user_allow_viewemail`, `user_allow_massemail`, `user_options`, `user_avatar`, `user_avatar_type`, `user_avatar_width`, `user_avatar_height`, `user_sig`, `user_sig_bbcode_uid`, `user_sig_bbcode_bitfield`, `user_from`, `user_icq`, `user_aim`, `user_yim`, `user_msnm`, `user_jabber`, `user_website`, `user_occ`, `user_interests`, `user_actkey`, `user_newpasswd`) VALUES 
(1, 2, 1, '\ni1cgsw000000\ni1cgsw000000', 0, '', 1167211017, 'Anonymous', '', 0, '', 0, '', 0, 0, 0, '', '', 0, 0, 0, 0, 0, 'en', 0.00, 0, 'd M Y H:i', 1, 0, '', 0, 0, 0, 0, -3, 0, 0, '', '', 0, '', '', 0, 1, 0, 1, 1, 1, 1, 1, 893, '', 0, 0, 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', ''),
(2, 3, 7, '005m9rzik0zjzik0sg\ni1cgsw000000\nzik0zjzhxjwg', 0, '', 1167211017, 'PROSE', 'df073729e898448f481888360a73dbd8', 0, 'ientium@sina.com', 0, '', 1168567952, 0, 0, 'includes/xajax/city/confraternity.server.php', '', 0, 0, 0, 0, 1, 'zh_CN', 0.00, 0, 'Y-m-d, H:i', 1, 1, 'AA0000', 0, 0, 0, 0, -3, 0, 0, 't', 'd', 0, 't', 'a', 0, 1, 0, 1, 1, 1, 1, 1, 893, '', 0, 0, 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', ''),
(3, 2, 8, '', 0, '', 1167211019, 'Alexa', '', 0, '', 0, '', 0, 1167211019, 0, '', '', 0, 0, 0, 0, 0, 'zh_CN', 0.00, 0, 'Y-m-d, H:i', 1, 0, '9E8DA7', 0, 0, 0, 0, -3, 0, 0, 't', 'd', 0, 't', 'a', 0, 1, 0, 1, 1, 1, 1, 1, 893, '', 0, 0, 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', ''),
(4, 2, 8, '', 0, '', 1167211019, 'Fastcrawler', '', 0, '', 0, '', 0, 1167211019, 0, '', '', 0, 0, 0, 0, 0, 'zh_CN', 0.00, 0, 'Y-m-d, H:i', 1, 0, '9E8DA7', 0, 0, 0, 0, -3, 0, 0, 't', 'd', 0, 't', 'a', 0, 1, 0, 1, 1, 1, 1, 1, 893, '', 0, 0, 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', ''),
(5, 2, 8, '', 0, '', 1167211019, 'Googlebot', '', 0, '', 0, '', 0, 1167211019, 0, '', '', 0, 0, 0, 0, 0, 'zh_CN', 0.00, 0, 'Y-m-d, H:i', 1, 0, '9E8DA7', 0, 0, 0, 0, -3, 0, 0, 't', 'd', 0, 't', 'a', 0, 1, 0, 1, 1, 1, 1, 1, 893, '', 0, 0, 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', ''),
(6, 2, 8, '', 0, '', 1167211019, 'Inktomi', '', 0, '', 0, '', 0, 1167211019, 0, '', '', 0, 0, 0, 0, 0, 'zh_CN', 0.00, 0, 'Y-m-d, H:i', 1, 0, '9E8DA7', 0, 0, 0, 0, -3, 0, 0, 't', 'd', 0, 't', 'a', 0, 1, 0, 1, 1, 1, 1, 1, 893, '', 0, 0, 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_users_bag`
-- 

CREATE TABLE `phpbb_users_bag` (
  `record_id` int(10) NOT NULL auto_increment,
  `objectid` int(10) NOT NULL default '0',
  `user_id` int(10) NOT NULL default '0',
  `object_num` int(10) NOT NULL default '0',
  `object_type` tinyint(2) NOT NULL default '1',
  `displayorder` tinyint(2) NOT NULL default '0',
  PRIMARY KEY  (`record_id`),
  UNIQUE KEY `un_user_ob` (`user_id`,`objectid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

-- 
-- 导出表中的数据 `phpbb_users_bag`
-- 

INSERT INTO `phpbb_users_bag` (`record_id`, `objectid`, `user_id`, `object_num`, `object_type`, `displayorder`) VALUES 
(1, 5, 2, 11, 1, 1),
(5, 1, 2, 4, 1, 2),
(3, 4, 2, 13, 1, 3),
(4, 3, 2, 13, 1, 4),
(6, 16, 2, 5, 1, 5);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_users_event`
-- 

CREATE TABLE `phpbb_users_event` (
  `eventid` int(10) NOT NULL auto_increment,
  `user_id` int(10) NOT NULL default '0',
  `city_id` int(10) NOT NULL default '0',
  `event_id` int(10) NOT NULL default '0',
  `creat_time` int(10) NOT NULL default '0',
  `useful_life` int(10) NOT NULL default '0',
  `eventtype` smallint(6) NOT NULL default '0',
  PRIMARY KEY  (`eventid`),
  UNIQUE KEY `uq_uid_cid_eid` (`user_id`,`city_id`,`event_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- 
-- 导出表中的数据 `phpbb_users_event`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_users_info`
-- 

CREATE TABLE `phpbb_users_info` (
  `user_id` int(10) NOT NULL default '0',
  `user_name` varchar(30) collate utf8_unicode_ci NOT NULL default '',
  `user_gender` varchar(20) collate utf8_unicode_ci default NULL,
  `user_phyle` tinyint(1) unsigned NOT NULL default '0',
  `user_exp` int(10) NOT NULL default '0',
  `user_hp` int(10) NOT NULL default '0',
  `user_hpall` int(10) unsigned NOT NULL default '20',
  `user_magic` int(10) unsigned NOT NULL default '0',
  `user_magicall` int(10) unsigned NOT NULL default '20',
  `user_weight` int(10) NOT NULL default '0',
  `user_weightall` int(10) unsigned NOT NULL default '100',
  `user_con` smallint(6) NOT NULL default '0',
  `con_exp` int(10) NOT NULL default '0',
  `user_int` smallint(6) NOT NULL default '0',
  `int_exp` int(10) NOT NULL default '0',
  `user_str` smallint(6) NOT NULL default '0',
  `str_exp` int(10) NOT NULL default '0',
  `user_dex` smallint(6) NOT NULL default '0',
  `dex_exp` int(10) NOT NULL default '0',
  `user_wis` smallint(6) NOT NULL default '0',
  `wis_exp` int(10) NOT NULL default '0',
  `user_cha` smallint(6) NOT NULL default '0',
  `cha_exp` int(10) NOT NULL default '0',
  `user_level` smallint(4) unsigned NOT NULL default '1',
  `user_credit` int(10) NOT NULL default '0',
  `user_title` varchar(40) collate utf8_unicode_ci NOT NULL default '',
  `user_metier` tinyint(4) NOT NULL default '0',
  `user_country` smallint(6) NOT NULL default '0',
  `country_place` tinyint(2) NOT NULL default '0',
  `user_org` smallint(6) NOT NULL default '0',
  `org_place` tinyint(2) NOT NULL default '0',
  `user_godliness` tinyint(2) NOT NULL default '0',
  `user_worship` int(10) NOT NULL default '0',
  `u_gold_coin` int(10) NOT NULL default '0',
  `u_silver_coin` int(10) NOT NULL default '0',
  `u_copper_coin` int(10) NOT NULL default '0',
  `lasttime` int(10) NOT NULL default '0',
  `last_place` smallint(4) NOT NULL default '0',
  `reg_time` int(10) NOT NULL default '0',
  `pre_point` smallint(6) NOT NULL default '0',
  `activity` smallint(3) NOT NULL default '230',
  `activityall` int(10) NOT NULL default '230',
  `activity_last_time` int(10) NOT NULL default '0',
  `contribution` smallint(6) NOT NULL default '0',
  PRIMARY KEY  (`user_id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- 导出表中的数据 `phpbb_users_info`
-- 

INSERT INTO `phpbb_users_info` (`user_id`, `user_name`, `user_gender`, `user_phyle`, `user_exp`, `user_hp`, `user_hpall`, `user_magic`, `user_magicall`, `user_weight`, `user_weightall`, `user_con`, `con_exp`, `user_int`, `int_exp`, `user_str`, `str_exp`, `user_dex`, `dex_exp`, `user_wis`, `wis_exp`, `user_cha`, `cha_exp`, `user_level`, `user_credit`, `user_title`, `user_metier`, `user_country`, `country_place`, `user_org`, `org_place`, `user_godliness`, `user_worship`, `u_gold_coin`, `u_silver_coin`, `u_copper_coin`, `lasttime`, `last_place`, `reg_time`, `pre_point`, `activity`, `activityall`, `activity_last_time`, `contribution`) VALUES 
(2, '小脏手', '0', 0, 28, 20, 20, 20, 20, 11, 100, 0, 41, 0, 41, 0, 41, 0, 41, 0, 41, 0, 41, 1, 0, '', 0, 0, 0, 0, 0, 6, 0, 5, 0, 5900, 0, 1, 0, 0, 124, 200, 1166972400, 670);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_users_license`
-- 

CREATE TABLE `phpbb_users_license` (
  `u_rid` int(10) NOT NULL auto_increment,
  `cityid` int(10) NOT NULL default '0',
  `licenseid` int(10) NOT NULL default '0',
  `creat_time` int(10) NOT NULL default '0',
  `useful_life` int(10) NOT NULL default '0',
  `user_id` int(10) NOT NULL default '0',
  `license_lv` smallint(6) NOT NULL default '0',
  `licensetype` smallint(6) NOT NULL default '1',
  PRIMARY KEY  (`u_rid`),
  UNIQUE KEY `user_license` (`cityid`,`licenseid`,`user_id`,`licensetype`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- 
-- 导出表中的数据 `phpbb_users_license`
-- 

INSERT INTO `phpbb_users_license` (`u_rid`, `cityid`, `licenseid`, `creat_time`, `useful_life`, `user_id`, `license_lv`, `licensetype`) VALUES 
(1, 1, 201, 1168179882, 0, 2, 1, 2);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_users_skills`
-- 

CREATE TABLE `phpbb_users_skills` (
  `uskillid` int(10) unsigned NOT NULL auto_increment,
  `skill_id` int(10) NOT NULL default '0',
  `user_id` int(10) NOT NULL default '0',
  `skill_lv` smallint(6) NOT NULL default '0',
  `sys_build` smallint(6) NOT NULL default '0',
  `skill_type` smallint(6) NOT NULL default '0',
  `starttime` int(10) NOT NULL default '0',
  `time` int(10) NOT NULL default '0',
  PRIMARY KEY  (`uskillid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- 
-- 导出表中的数据 `phpbb_users_skills`
-- 

INSERT INTO `phpbb_users_skills` (`uskillid`, `skill_id`, `user_id`, `skill_lv`, `sys_build`, `skill_type`, `starttime`, `time`) VALUES 
(1, 1, 2, 1, 306, 0, 0, 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_warnings`
-- 

CREATE TABLE `phpbb_warnings` (
  `warning_id` mediumint(8) unsigned NOT NULL auto_increment,
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `post_id` mediumint(8) unsigned NOT NULL default '0',
  `log_id` mediumint(8) unsigned NOT NULL default '0',
  `warning_time` int(11) NOT NULL default '0',
  PRIMARY KEY  (`warning_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `phpbb_warnings`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_words`
-- 

CREATE TABLE `phpbb_words` (
  `word_id` mediumint(8) unsigned NOT NULL auto_increment,
  `word` varchar(255) NOT NULL default '',
  `replacement` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`word_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `phpbb_words`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `phpbb_zebra`
-- 

CREATE TABLE `phpbb_zebra` (
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `zebra_id` mediumint(8) unsigned NOT NULL default '0',
  `friend` tinyint(1) NOT NULL default '0',
  `foe` tinyint(1) NOT NULL default '0',
  KEY `user_id` (`user_id`),
  KEY `zebra_id` (`zebra_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- 导出表中的数据 `phpbb_zebra`
-- 

