/*

MSSQL Schema for phpBB 3.x - (c) phpBB Group, 2005

$Id: mssql_schema.sql,v 1.50 2006/06/16 16:54:43 acydburn Exp $

*/

BEGIN TRANSACTION
GO

/*
 Table: phpbb_attachments
*/
CREATE TABLE [phpbb_attachments] (
	[attach_id] [int] IDENTITY (1, 1) NOT NULL ,
	[post_msg_id] [int] NOT NULL ,
	[topic_id] [int] NOT NULL ,
	[in_message] [int] NOT NULL ,
	[poster_id] [int] NOT NULL ,
	[physical_filename] [varchar] (255) NOT NULL ,
	[real_filename] [varchar] (255) NOT NULL ,
	[download_count] [int] NOT NULL ,
	[comment] [varchar] (8000) ,
	[extension] [varchar] (100) NULL ,
	[mimetype] [varchar] (100) NULL ,
	[filesize] [int] NOT NULL ,
	[filetime] [int] NOT NULL ,
	[thumbnail] [int] NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_attachments] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_attachments] PRIMARY KEY  CLUSTERED 
	(
		[attach_id]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_attachments] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_attach_post_msg_id] DEFAULT (0) FOR [post_msg_id],
	CONSTRAINT [DF_phpbb_attach_topic_id] DEFAULT (0) FOR [topic_id],
	CONSTRAINT [DF_phpbb_attach_in_message] DEFAULT (0) FOR [in_message],
	CONSTRAINT [DF_phpbb_attach_poster_id] DEFAULT (0) FOR [poster_id],
	CONSTRAINT [DF_phpbb_attach_download_count] DEFAULT (0) FOR [download_count],
	CONSTRAINT [DF_phpbb_attach_filetime] DEFAULT (0) FOR [filetime],
	CONSTRAINT [DF_phpbb_attach_thumbnail] DEFAULT (0) FOR [thumbnail]
GO

CREATE  INDEX [filetime] ON [phpbb_attachments]([filetime]) ON [PRIMARY]
GO

CREATE  INDEX [post_msg_id] ON [phpbb_attachments]([post_msg_id]) ON [PRIMARY]
GO

CREATE  INDEX [topic_id] ON [phpbb_attachments]([topic_id]) ON [PRIMARY]
GO

CREATE  INDEX [poster_id] ON [phpbb_attachments]([poster_id]) ON [PRIMARY]
GO

CREATE  INDEX [physical_filename] ON [phpbb_attachments]([physical_filename]) ON [PRIMARY]
GO

CREATE  INDEX [filesize] ON [phpbb_attachments]([filesize]) ON [PRIMARY]
GO


/*
 Table: phpbb_acl_groups
*/
CREATE TABLE [phpbb_acl_groups] (
	[group_id] [int] NOT NULL ,
	[forum_id] [int] NOT NULL ,
	[auth_option_id] [int] NOT NULL ,
	[auth_role_id] [int] NOT NULL ,
	[auth_setting] [int] NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_acl_groups] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_acl_g_group_id] DEFAULT (0) FOR [group_id],
	CONSTRAINT [DF_phpbb_acl_g_forum_id] DEFAULT (0) FOR [forum_id],
	CONSTRAINT [DF_phpbb_acl_g_auth_option_id] DEFAULT (0) FOR [auth_option_id],
	CONSTRAINT [DF_phpbb_acl_g_auth_role_id] DEFAULT (0) FOR [auth_role_id],
	CONSTRAINT [DF_phpbb_acl_g_auth_setting] DEFAULT (0) FOR [auth_setting]
GO

CREATE  INDEX [group_id] ON [phpbb_acl_groups]([group_id]) ON [PRIMARY]
GO

CREATE  INDEX [auth_option_id] ON [phpbb_acl_groups]([auth_option_id]) ON [PRIMARY]
GO


/*
 Table: phpbb_acl_options
*/
CREATE TABLE [phpbb_acl_options] (
	[auth_option_id] [int] IDENTITY (1, 1) NOT NULL ,
	[auth_option] [varchar] (20) NOT NULL ,
	[is_global] [int] NOT NULL ,
	[is_local] [int] NOT NULL ,
	[founder_only] [int] NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_acl_options] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_acl_options] PRIMARY KEY  CLUSTERED 
	(
		[auth_option_id]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_acl_options] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_acl_o_is_global] DEFAULT (0) FOR [is_global],
	CONSTRAINT [DF_phpbb_acl_o_is_local] DEFAULT (0) FOR [is_local],
	CONSTRAINT [DF_phpbb_acl_o_founder_only] DEFAULT (0) FOR [founder_only]
GO

CREATE  INDEX [auth_option] ON [phpbb_acl_options]([auth_option]) ON [PRIMARY]
GO


/*
 Table: phpbb_acl_roles
*/
CREATE TABLE [phpbb_acl_roles] (
	[role_id] [int] IDENTITY (1, 1) NOT NULL ,
	[role_name] [varchar] (255) NOT NULL ,
	[role_description] [varchar] (8000) ,
	[role_type] [varchar] (10) NOT NULL ,
	[role_order] [int] NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_acl_roles] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_acl_roles] PRIMARY KEY  CLUSTERED 
	(
		[role_id]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_acl_roles] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_acl_p_role_role_order] DEFAULT (0) FOR [role_order],
	CONSTRAINT [DF_phpbb_acl_p_role_role_type] DEFAULT ('') FOR [role_type],
	CONSTRAINT [DF_phpbb_acl_p_role_role_name] DEFAULT ('') FOR [role_name]
GO

CREATE  INDEX [role_type] ON [phpbb_acl_roles]([role_type]) ON [PRIMARY]
GO

CREATE  INDEX [role_order] ON [phpbb_acl_roles]([role_order]) ON [PRIMARY]
GO


/*
 Table: phpbb_acl_roles_data
*/
CREATE TABLE [phpbb_acl_roles_data] (
	[role_id] [int] NOT NULL ,
	[auth_option_id] [int] NOT NULL ,
	[auth_setting] [int] NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_acl_roles_data] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_acl_roles_data] PRIMARY KEY  CLUSTERED 
	(
		[role_id],
		[auth_option_id]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_acl_roles_data] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_acl_d_role_id] DEFAULT (0) FOR [role_id],
	CONSTRAINT [DF_phpbb_acl_d_auth_option_id] DEFAULT (0) FOR [auth_option_id],
	CONSTRAINT [DF_phpbb_acl_d_auth_setting] DEFAULT (0) FOR [auth_setting]
GO


/*
 Table: phpbb_acl_users
*/
CREATE TABLE [phpbb_acl_users] (
	[user_id] [int] NOT NULL ,
	[forum_id] [int] NOT NULL ,
	[auth_option_id] [int] NOT NULL ,
	[auth_role_id] [int] NOT NULL ,
	[auth_setting] [int] NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_acl_users] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_acl_u_user_id] DEFAULT (0) FOR [user_id],
	CONSTRAINT [DF_phpbb_acl_u_forum_id] DEFAULT (0) FOR [forum_id],
	CONSTRAINT [DF_phpbb_acl_u_auth_option_id] DEFAULT (0) FOR [auth_option_id],
	CONSTRAINT [DF_phpbb_acl_u_auth_role_id] DEFAULT (0) FOR [auth_role_id],
	CONSTRAINT [DF_phpbb_acl_u_auth_setting] DEFAULT (0) FOR [auth_setting]
GO

CREATE  INDEX [user_id] ON [phpbb_acl_users]([user_id]) ON [PRIMARY]
GO

CREATE  INDEX [auth_option_id] ON [phpbb_acl_users]([auth_option_id]) ON [PRIMARY]
GO


/*
 Table: phpbb_banlist
*/
CREATE TABLE [phpbb_banlist] (
	[ban_id] [int] IDENTITY (1, 1) NOT NULL ,
	[ban_userid] [int] NOT NULL ,
	[ban_ip] [varchar] (40) NOT NULL ,
	[ban_email] [varchar] (100) NOT NULL ,
	[ban_start] [int] NOT NULL ,
	[ban_end] [int] NOT NULL ,
	[ban_exclude] [int] NOT NULL ,
	[ban_reason] [varchar] (3000) ,
	[ban_give_reason] [varchar] (3000) 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_banlist] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_banlist] PRIMARY KEY  CLUSTERED 
	(
		[ban_id]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_banlist] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_banlis_ban_userid] DEFAULT (0) FOR [ban_userid],
	CONSTRAINT [DF_phpbb_banlis_ban_start] DEFAULT (0) FOR [ban_start],
	CONSTRAINT [DF_phpbb_banlis_ban_end] DEFAULT (0) FOR [ban_end],
	CONSTRAINT [DF_phpbb_banlis_ban_exclude] DEFAULT (0) FOR [ban_exclude],
	CONSTRAINT [DF_phpbb_banlis_ban_ip] DEFAULT ('') FOR [ban_ip],
	CONSTRAINT [DF_phpbb_banlis_ban_email] DEFAULT ('') FOR [ban_email]
GO


/*
 Table: phpbb_bbcodes
*/
CREATE TABLE [phpbb_bbcodes] (
	[bbcode_id] [int] NOT NULL ,
	[bbcode_tag] [varchar] (16) NOT NULL ,
	[display_on_posting] [int] NOT NULL ,
	[bbcode_match] [varchar] (255) NOT NULL ,
	[bbcode_tpl] [text] ,
	[first_pass_match] [varchar] (255) NOT NULL ,
	[first_pass_replace] [varchar] (255) NOT NULL ,
	[second_pass_match] [varchar] (255) NOT NULL ,
	[second_pass_replace] [text] 
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO

ALTER TABLE [phpbb_bbcodes] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_bbcodes] PRIMARY KEY  CLUSTERED 
	(
		[bbcode_id]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_bbcodes] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_bbcode_bbcode_id] DEFAULT (0) FOR [bbcode_id],
	CONSTRAINT [DF_phpbb_bbcode_bbcode_tag] DEFAULT ('') FOR [bbcode_tag],
	CONSTRAINT [DF_phpbb_bbcode_bbcode_match] DEFAULT ('') FOR [bbcode_match],
	CONSTRAINT [DF_phpbb_bbcode_display_on_posting] DEFAULT (0) FOR [display_on_posting],
	CONSTRAINT [DF_phpbb_bbcode_first_pass_match] DEFAULT ('') FOR [first_pass_match],
	CONSTRAINT [DF_phpbb_bbcode_first_pass_replace] DEFAULT ('') FOR [first_pass_replace],
	CONSTRAINT [DF_phpbb_bbcode_second_pass_match] DEFAULT ('') FOR [second_pass_match]
GO

CREATE  INDEX [display_on_posting] ON [phpbb_bbcodes]([display_on_posting]) ON [PRIMARY]
GO


/*
 Table: phpbb_bookmarks
*/
CREATE TABLE [phpbb_bookmarks] (
	[topic_id] [int] NOT NULL ,
	[user_id] [int] NOT NULL ,
	[order_id] [int] NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_bookmarks] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_bookma_topic_id] DEFAULT (0) FOR [topic_id],
	CONSTRAINT [DF_phpbb_bookma_user_id] DEFAULT (0) FOR [user_id],
	CONSTRAINT [DF_phpbb_bookma_order_id] DEFAULT (0) FOR [order_id]
GO

CREATE  INDEX [order_id] ON [phpbb_bookmarks]([order_id]) ON [PRIMARY]
GO

CREATE  INDEX [topic_user_id] ON [phpbb_bookmarks]([topic_id], [user_id]) ON [PRIMARY]
GO


/*
 Table: phpbb_bots
*/
CREATE TABLE [phpbb_bots] (
	[bot_id] [int] IDENTITY (1, 1) NOT NULL ,
	[bot_active] [int] NOT NULL ,
	[bot_name] [varchar] (1000) ,
	[user_id] [int] NOT NULL ,
	[bot_agent] [varchar] (255) NOT NULL ,
	[bot_ip] [varchar] (255) NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_bots] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_bots] PRIMARY KEY  CLUSTERED 
	(
		[bot_id]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_bots] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_bots___bot_active] DEFAULT (1) FOR [bot_active],
	CONSTRAINT [DF_phpbb_bots___user_id] DEFAULT (0) FOR [user_id],
	CONSTRAINT [DF_phpbb_bots___bot_ip] DEFAULT ('') FOR [bot_ip]
GO

CREATE  INDEX [bot_active] ON [phpbb_bots]([bot_active]) ON [PRIMARY]
GO


/*
 Table: phpbb_config
*/
CREATE TABLE [phpbb_config] (
	[config_name] [varchar] (255) NOT NULL ,
	[config_value] [varchar] (255) NOT NULL ,
	[is_dynamic] [int] NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_config] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_config] PRIMARY KEY  CLUSTERED 
	(
		[config_name]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_config] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_config_is_dynamic] DEFAULT (0) FOR [is_dynamic]
GO

CREATE  INDEX [is_dynamic] ON [phpbb_config]([is_dynamic]) ON [PRIMARY]
GO


/*
 Table: phpbb_confirm
*/
CREATE TABLE [phpbb_confirm] (
	[confirm_id] [char] (32) NOT NULL ,
	[session_id] [char] (32) NOT NULL ,
	[confirm_type] [int] NOT NULL ,
	[code] [varchar] (8) NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_confirm] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_confirm] PRIMARY KEY  CLUSTERED 
	(
		[session_id],
		[confirm_id]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_confirm] WITH NOCHECK ADD
	CONSTRAINT [DF_phpbb_confirm_confirm_type] DEFAULT (0) FOR [confirm_type],
	CONSTRAINT [DF_phpbb_confirm_confirm_id] DEFAULT ('') FOR [confirm_id],
	CONSTRAINT [DF_phpbb_confirm_session_id] DEFAULT ('') FOR [session_id],
	CONSTRAINT [DF_phpbb_confirm_code] DEFAULT ('') FOR [code]
GO


/*
 Table: phpbb_disallow
*/
CREATE TABLE [phpbb_disallow] (
	[disallow_id] [int] IDENTITY (1, 1) NOT NULL ,
	[disallow_username] [varchar] (255) NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_disallow] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_disallow] PRIMARY KEY  CLUSTERED 
	(
		[disallow_id]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_disallow] WITH NOCHECK ADD
	CONSTRAINT [DF_phpbb_disallow_disallow_username] DEFAULT ('') FOR [disallow_username]
GO


/*
 Table: phpbb_drafts
*/
CREATE TABLE [phpbb_drafts] (
	[draft_id] [int] IDENTITY (1, 1) NOT NULL ,
	[user_id] [int] NOT NULL ,
	[topic_id] [int] NOT NULL ,
	[forum_id] [int] NOT NULL ,
	[save_time] [int] NOT NULL ,
	[draft_subject] [varchar] (1000) ,
	[draft_message] [text] 
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO

ALTER TABLE [phpbb_drafts] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_drafts] PRIMARY KEY  CLUSTERED 
	(
		[draft_id]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_drafts] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_drafts_user_id] DEFAULT (0) FOR [user_id],
	CONSTRAINT [DF_phpbb_drafts_topic_id] DEFAULT (0) FOR [topic_id],
	CONSTRAINT [DF_phpbb_drafts_forum_id] DEFAULT (0) FOR [forum_id],
	CONSTRAINT [DF_phpbb_drafts_save_time] DEFAULT (0) FOR [save_time]
GO

CREATE  INDEX [save_time] ON [phpbb_drafts]([save_time]) ON [PRIMARY]
GO


/*
 Table: phpbb_extensions
*/
CREATE TABLE [phpbb_extensions] (
	[extension_id] [int] IDENTITY (1, 1) NOT NULL ,
	[group_id] [int] NOT NULL ,
	[extension] [varchar] (100) NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_extensions] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_extensions] PRIMARY KEY  CLUSTERED 
	(
		[extension_id]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_extensions] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_extens_group_id] DEFAULT (0) FOR [group_id],
	CONSTRAINT [DF_phpbb_extens_extension] DEFAULT (0) FOR [extension]
GO



/*
 Table: phpbb_extension_groups
*/
CREATE TABLE [phpbb_extension_groups] (
	[group_id] [int] IDENTITY (1, 1) NOT NULL ,
	[group_name] [varchar] (255) NOT NULL ,
	[cat_id] [int] NOT NULL ,
	[allow_group] [int] NOT NULL ,
	[download_mode] [int] NOT NULL ,
	[upload_icon] [varchar] (255) NOT NULL ,
	[max_filesize] [int] NOT NULL ,
	[allowed_forums] [text] ,
	[allow_in_pm] [int] NOT NULL 
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO

ALTER TABLE [phpbb_extension_groups] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_extension_groups] PRIMARY KEY  CLUSTERED 
	(
		[group_id]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_extension_groups] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_extens_cat_id] DEFAULT (0) FOR [cat_id],
	CONSTRAINT [DF_phpbb_extens_allow_group] DEFAULT (0) FOR [allow_group],
	CONSTRAINT [DF_phpbb_extens_download_mode] DEFAULT (1) FOR [download_mode],
	CONSTRAINT [DF_phpbb_extens_max_filesize] DEFAULT (0) FOR [max_filesize],
	CONSTRAINT [DF_phpbb_extens_allow_in_pm] DEFAULT (0) FOR [allow_in_pm],
	CONSTRAINT [DF_phpbb_extens_upload_icon] DEFAULT ('') FOR [upload_icon]
GO


/*
 Table: phpbb_forums
*/
CREATE TABLE [phpbb_forums] (
	[forum_id] [int] IDENTITY (1, 1) NOT NULL ,
	[parent_id] [int] NOT NULL ,
	[left_id] [int] NOT NULL ,
	[right_id] [int] NOT NULL ,
	[forum_parents] [text] NULL ,
	[forum_name] [varchar] (3000) ,
	[forum_desc] [text] ,
	[forum_desc_bitfield] [int] NOT NULL ,
	[forum_desc_uid] [varchar] (5) NOT NULL ,
	[forum_link] [varchar] (255) NOT NULL ,
	[forum_password] [varchar] (40) NOT NULL ,
	[forum_style] [int] NULL ,
	[forum_image] [varchar] (255) NOT NULL ,
	[forum_rules] [text] ,
	[forum_rules_link] [varchar] (255) NOT NULL ,
	[forum_rules_bitfield] [int] NOT NULL ,
	[forum_rules_uid] [varchar] (5) NOT NULL ,
	[forum_topics_per_page] [int] NOT NULL ,
	[forum_type] [int] NOT NULL ,
	[forum_status] [int] NOT NULL ,
	[forum_posts] [int] NOT NULL ,
	[forum_topics] [int] NOT NULL ,
	[forum_topics_real] [int] NOT NULL ,
	[forum_last_post_id] [int] NOT NULL ,
	[forum_last_poster_id] [int] NOT NULL ,
	[forum_last_post_time] [int] NOT NULL ,
	[forum_last_poster_name] [varchar] (255) NULL ,
	[forum_flags] [int] NOT NULL ,
	[display_on_index] [int] NOT NULL ,
	[enable_indexing] [int] NOT NULL ,
	[enable_icons] [int] NOT NULL ,
	[enable_prune] [int] NOT NULL ,
	[prune_next] [int] NULL ,
	[prune_days] [int] NOT NULL ,
	[prune_viewed] [int] NOT NULL ,
	[prune_freq] [int] NOT NULL 
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO

ALTER TABLE [phpbb_forums] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_forums] PRIMARY KEY  CLUSTERED 
	(
		[forum_id]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_forums] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_forums_desc_bitfield] DEFAULT (0) FOR [forum_desc_bitfield],
	CONSTRAINT [DF_phpbb_forums_rules_bitfield] DEFAULT (0) FOR [forum_rules_bitfield],
	CONSTRAINT [DF_phpbb_forums_topics_per_page] DEFAULT (0) FOR [forum_topics_per_page],
	CONSTRAINT [DF_phpbb_forums_forum_type] DEFAULT (0) FOR [forum_type],
	CONSTRAINT [DF_phpbb_forums_forum_status] DEFAULT (0) FOR [forum_status],
	CONSTRAINT [DF_phpbb_forums_forum_posts] DEFAULT (0) FOR [forum_posts],
	CONSTRAINT [DF_phpbb_forums_forum_topics] DEFAULT (0) FOR [forum_topics],
	CONSTRAINT [DF_phpbb_forums_forum_topics_real] DEFAULT (0) FOR [forum_topics_real],
	CONSTRAINT [DF_phpbb_forums_forum_last_post_id] DEFAULT (0) FOR [forum_last_post_id],
	CONSTRAINT [DF_phpbb_forums_forum_last_poster_id] DEFAULT (0) FOR [forum_last_poster_id],
	CONSTRAINT [DF_phpbb_forums_forum_last_post_time] DEFAULT (0) FOR [forum_last_post_time],
	CONSTRAINT [DF_phpbb_forums_forum_flags] DEFAULT (0) FOR [forum_flags],
	CONSTRAINT [DF_phpbb_forums_display_on_index] DEFAULT (1) FOR [display_on_index],
	CONSTRAINT [DF_phpbb_forums_enable_indexing] DEFAULT (1) FOR [enable_indexing],
	CONSTRAINT [DF_phpbb_forums_enable_icons] DEFAULT (1) FOR [enable_icons],
	CONSTRAINT [DF_phpbb_forums_enable_prune] DEFAULT (0) FOR [enable_prune],
	CONSTRAINT [DF_phpbb_forums_prune_freq] DEFAULT (0) FOR [prune_freq],
	CONSTRAINT [DF_phpbb_forums_forum_desc_uid] DEFAULT ('') FOR [forum_desc_uid],
	CONSTRAINT [DF_phpbb_forums_forum_link] DEFAULT ('') FOR [forum_link],
	CONSTRAINT [DF_phpbb_forums_forum_password] DEFAULT ('') FOR [forum_password],
	CONSTRAINT [DF_phpbb_forums_forum_image] DEFAULT ('') FOR [forum_image],
	CONSTRAINT [DF_phpbb_forums_forum_rules_link] DEFAULT ('') FOR [forum_rules_link],
	CONSTRAINT [DF_phpbb_forums_forum_rules_uid] DEFAULT ('') FOR [forum_rules_uid]
GO

CREATE  INDEX [left_right_id] ON [phpbb_forums]([left_id], [right_id]) ON [PRIMARY]
GO

CREATE  INDEX [forum_last_post_id] ON [phpbb_forums]([forum_last_post_id]) ON [PRIMARY]
GO


/*
 Table: phpbb_forums_access
*/
CREATE TABLE [phpbb_forums_access] (
	[forum_id] [int] NOT NULL ,
	[user_id] [int] NOT NULL ,
	[session_id] [varchar] (32) NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_forums_access] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_forums_access] PRIMARY KEY  CLUSTERED 
	(
		[forum_id],
		[user_id],
		[session_id]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_forums_access] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_forum__forum_id] DEFAULT (0) FOR [forum_id],
	CONSTRAINT [DF_phpbb_forum__user_id] DEFAULT (0) FOR [user_id],
	CONSTRAINT [DF_phpbb_forum__session_id] DEFAULT ('') FOR [session_id]
GO


/*
 Table: phpbb_forums_track
*/
CREATE TABLE [phpbb_forums_track] (
	[user_id] [int] NOT NULL ,
	[forum_id] [int] NOT NULL ,
	[mark_time] [int] NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_forums_track] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_forums_track] PRIMARY KEY  CLUSTERED 
	(
		[user_id],
		[forum_id]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_forums_track] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_forumm_user_id] DEFAULT (0) FOR [user_id],
	CONSTRAINT [DF_phpbb_forumm_forum_id] DEFAULT (0) FOR [forum_id],
	CONSTRAINT [DF_phpbb_forumm_mark_time] DEFAULT (0) FOR [mark_time]
GO


/*
 Table: phpbb_forums_watch
*/
CREATE TABLE [phpbb_forums_watch] (
	[forum_id] [int] NOT NULL ,
	[user_id] [int] NOT NULL ,
	[notify_status] [int] NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_forums_watch] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_forumw_forum_id] DEFAULT (0) FOR [forum_id],
	CONSTRAINT [DF_phpbb_forumw_user_id] DEFAULT (0) FOR [user_id],
	CONSTRAINT [DF_phpbb_forumw_notify_status] DEFAULT (0) FOR [notify_status]
GO

CREATE  INDEX [forum_id] ON [phpbb_forums_watch]([forum_id]) ON [PRIMARY]
GO

CREATE  INDEX [user_id] ON [phpbb_forums_watch]([user_id]) ON [PRIMARY]
GO

CREATE  INDEX [notify_status] ON [phpbb_forums_watch]([notify_status]) ON [PRIMARY]
GO


/*
 Table: phpbb_groups
*/
CREATE TABLE [phpbb_groups] (
	[group_id] [int] IDENTITY (1, 1) NOT NULL ,
	[group_type] [int] NOT NULL ,
	[group_name] [varchar] (255) NOT NULL ,
	[group_desc] [text] ,
	[group_desc_bitfield] [int] NOT NULL ,
	[group_desc_uid] [varchar] (5) NOT NULL ,
	[group_display] [int] NOT NULL ,
	[group_avatar] [varchar] (255) NOT NULL ,
	[group_avatar_type] [int] NOT NULL ,
	[group_avatar_width] [int] NOT NULL ,
	[group_avatar_height] [int] NOT NULL ,
	[group_rank] [int] NOT NULL ,
	[group_colour] [varchar] (6) NOT NULL ,
	[group_sig_chars] [int] NOT NULL ,
	[group_receive_pm] [int] NOT NULL ,
	[group_message_limit] [int] NOT NULL ,
	[group_chgpass] [int] NOT NULL ,
	[group_legend] [int] NOT NULL 
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO

ALTER TABLE [phpbb_groups] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_groups] PRIMARY KEY  CLUSTERED 
	(
		[group_id]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_groups] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_groups_group_type] DEFAULT (1) FOR [group_type],
	CONSTRAINT [DF_phpbb_groups_group_display] DEFAULT (0) FOR [group_display],
	CONSTRAINT [DF_phpbb_groups_group_desc_bitfield] DEFAULT (0) FOR [group_desc_bitfield],
	CONSTRAINT [DF_phpbb_groups_group_avatar_type] DEFAULT (0) FOR [group_avatar_type],
	CONSTRAINT [DF_phpbb_groups_group_avatar_width] DEFAULT (0) FOR [group_avatar_width],
	CONSTRAINT [DF_phpbb_groups_group_avatar_height] DEFAULT (0) FOR [group_avatar_height],
	CONSTRAINT [DF_phpbb_groups_group_rank] DEFAULT ((-1)) FOR [group_rank],
	CONSTRAINT [DF_phpbb_groups_group_sig_chars] DEFAULT (0) FOR [group_sig_chars],
	CONSTRAINT [DF_phpbb_groups_group_receive_pm] DEFAULT (0) FOR [group_receive_pm],
	CONSTRAINT [DF_phpbb_groups_group_message_limit] DEFAULT (0) FOR [group_message_limit],
	CONSTRAINT [DF_phpbb_groups_group_chgpass] DEFAULT (0) FOR [group_chgpass],
	CONSTRAINT [DF_phpbb_groups_group_legend] DEFAULT (1) FOR [group_legend],
	CONSTRAINT [DF_phpbb_groups_group_name] DEFAULT ('') FOR [group_name],
	CONSTRAINT [DF_phpbb_groups_group_desc_uid] DEFAULT ('') FOR [group_desc_uid],
	CONSTRAINT [DF_phpbb_groups_group_avatar] DEFAULT ('') FOR [group_avatar],
	CONSTRAINT [DF_phpbb_groups_group_colour] DEFAULT ('') FOR [group_colour]
GO

CREATE  INDEX [group_legend] ON [phpbb_groups]([group_legend]) ON [PRIMARY]
GO


/*
 Table: phpbb_icons
*/
CREATE TABLE [phpbb_icons] (
	[icons_id] [int] IDENTITY (1, 1) NOT NULL ,
	[icons_url] [varchar] (255) NULL ,
	[icons_width] [int] NOT NULL ,
	[icons_height] [int] NOT NULL ,
	[icons_order] [int] NOT NULL ,
	[display_on_posting] [int] NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_icons] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_icons] PRIMARY KEY  CLUSTERED 
	(
		[icons_id]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_icons] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_icons__display_on_posting] DEFAULT (1) FOR [display_on_posting]
GO


/*
 Table: phpbb_lang
*/
CREATE TABLE [phpbb_lang] (
	[lang_id] [int] IDENTITY (1, 1) NOT NULL ,
	[lang_iso] [varchar] (5) NOT NULL ,
	[lang_dir] [varchar] (30) NOT NULL ,
	[lang_english_name] [varchar] (100) NULL ,
	[lang_local_name] [varchar] (255) NULL ,
	[lang_author] [varchar] (255) NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_lang] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_lang] PRIMARY KEY  CLUSTERED 
	(
		[lang_id]
	)  ON [PRIMARY] 
GO


/*
 Table: phpbb_log
*/
CREATE TABLE [phpbb_log] (
	[log_id] [int] IDENTITY (1, 1) NOT NULL ,
	[log_type] [int] NOT NULL ,
	[user_id] [int] NOT NULL ,
	[forum_id] [int] NOT NULL ,
	[topic_id] [int] NOT NULL ,
	[reportee_id] [int] NOT NULL ,
	[log_ip] [varchar] (40) NOT NULL ,
	[log_time] [int] NOT NULL ,
	[log_operation] [varchar] (8000) ,
	[log_data] [text] 
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO

ALTER TABLE [phpbb_log] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_log] PRIMARY KEY  CLUSTERED 
	(
		[log_id]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_log] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_log____log_type] DEFAULT (0) FOR [log_type],
	CONSTRAINT [DF_phpbb_log____user_id] DEFAULT (0) FOR [user_id],
	CONSTRAINT [DF_phpbb_log____forum_id] DEFAULT (0) FOR [forum_id],
	CONSTRAINT [DF_phpbb_log____topic_id] DEFAULT (0) FOR [topic_id],
	CONSTRAINT [DF_phpbb_log____reportee_id] DEFAULT (0) FOR [reportee_id]
GO

CREATE  INDEX [log_type] ON [phpbb_log]([log_type]) ON [PRIMARY]
GO

CREATE  INDEX [forum_id] ON [phpbb_log]([forum_id]) ON [PRIMARY]
GO

CREATE  INDEX [topic_id] ON [phpbb_log]([topic_id]) ON [PRIMARY]
GO

CREATE  INDEX [reportee_id] ON [phpbb_log]([reportee_id]) ON [PRIMARY]
GO

CREATE  INDEX [user_id] ON [phpbb_log]([user_id]) ON [PRIMARY]
GO


/*
 Table: phpbb_moderator_cache
*/
CREATE TABLE [phpbb_moderator_cache] (
	[forum_id] [int] NOT NULL ,
	[user_id] [int] NOT NULL ,
	[username] [varchar] (255) NOT NULL ,
	[group_id] [int] NOT NULL ,
	[group_name] [varchar] (255) NOT NULL ,
	[display_on_index] [int] NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_moderator_cache] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_modera_user_id] DEFAULT (0) FOR [user_id],
	CONSTRAINT [DF_phpbb_modera_group_id] DEFAULT (0) FOR [group_id],
	CONSTRAINT [DF_phpbb_modera_display_on_index] DEFAULT (1) FOR [display_on_index],
	CONSTRAINT [DF_phpbb_modera_username] DEFAULT ('') FOR [username],
	CONSTRAINT [DF_phpbb_modera_group_name] DEFAULT ('') FOR [group_name]
GO

CREATE  INDEX [display_on_index] ON [phpbb_moderator_cache]([display_on_index]) ON [PRIMARY]
GO

CREATE  INDEX [forum_id] ON [phpbb_moderator_cache]([forum_id]) ON [PRIMARY]
GO


/*
 Table: phpbb_modules
*/
CREATE TABLE [phpbb_modules] (
	[module_id] [int] IDENTITY (1, 1) NOT NULL ,
	[module_enabled] [int] NOT NULL ,
	[module_display] [int] NOT NULL ,
	[module_name] [varchar] (255) NOT NULL ,
	[module_class] [varchar] (10) NOT NULL ,
	[parent_id] [int] NOT NULL ,
	[left_id] [int] NOT NULL ,
	[right_id] [int] NOT NULL ,
	[module_langname] [varchar] (255) NOT NULL ,
	[module_mode] [varchar] (255) NOT NULL ,
	[module_auth] [varchar] (255) NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_modules] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_modules] PRIMARY KEY  CLUSTERED 
	(
		[module_id]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_modules] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_module_forums_parent_id] DEFAULT (0) FOR [parent_id],
	CONSTRAINT [DF_phpbb_module_left_id] DEFAULT (0) FOR [left_id],
	CONSTRAINT [DF_phpbb_module_right_id] DEFAULT (0) FOR [right_id],
	CONSTRAINT [DF_phpbb_module_module_enabled] DEFAULT (1) FOR [module_enabled],
	CONSTRAINT [DF_phpbb_module_module_display] DEFAULT (1) FOR [module_display],
	CONSTRAINT [DF_phpbb_module_module_name] DEFAULT ('') FOR [module_name],
	CONSTRAINT [DF_phpbb_module_module_class] DEFAULT ('') FOR [module_class],
	CONSTRAINT [DF_phpbb_module_module_langname] DEFAULT ('') FOR [module_langname],
	CONSTRAINT [DF_phpbb_module_module_mode] DEFAULT ('') FOR [module_mode],
	CONSTRAINT [DF_phpbb_module_module_auth] DEFAULT ('') FOR [module_auth]
GO

CREATE  INDEX [module_enabled] ON [phpbb_modules]([module_enabled]) ON [PRIMARY]
GO

CREATE  INDEX [module_left_right_id] ON [phpbb_modules]([left_id], [right_id]) ON [PRIMARY]
GO

CREATE  INDEX [module_class_left_id] ON [phpbb_modules]([module_class], [left_id]) ON [PRIMARY]
GO


/*
 Table: phpbb_poll_options
*/
CREATE TABLE [phpbb_poll_options] (
	[poll_option_id] [int] NOT NULL ,
	[topic_id] [int] NOT NULL ,
	[poll_option_text] [varchar] (3000) ,
	[poll_option_total] [int] NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_poll_options] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_poll_o_poll_option_id] DEFAULT (0) FOR [poll_option_id],
	CONSTRAINT [DF_phpbb_poll_o_poll_option_total] DEFAULT (0) FOR [poll_option_total]
GO

CREATE  INDEX [poll_option_id] ON [phpbb_poll_options]([poll_option_id]) ON [PRIMARY]
GO

CREATE  INDEX [topic_id] ON [phpbb_poll_options]([topic_id]) ON [PRIMARY]
GO


/*
 Table: phpbb_poll_votes
*/
CREATE TABLE [phpbb_poll_votes] (
	[topic_id] [int] NOT NULL ,
	[poll_option_id] [int] NOT NULL ,
	[vote_user_id] [int] NOT NULL ,
	[vote_user_ip] [varchar] (40) NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_poll_votes] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_poll_v_topic_id] DEFAULT (0) FOR [topic_id],
	CONSTRAINT [DF_phpbb_poll_v_poll_option_id] DEFAULT (0) FOR [poll_option_id],
	CONSTRAINT [DF_phpbb_poll_v_vote_user_id] DEFAULT (0) FOR [vote_user_id]
GO

CREATE  INDEX [topic_id] ON [phpbb_poll_votes]([topic_id]) ON [PRIMARY]
GO

CREATE  INDEX [vote_user_id] ON [phpbb_poll_votes]([vote_user_id]) ON [PRIMARY]
GO

CREATE  INDEX [vote_user_ip] ON [phpbb_poll_votes]([vote_user_ip]) ON [PRIMARY]
GO


/*
 Table: phpbb_posts
*/
CREATE TABLE [phpbb_posts] (
	[post_id] [int] IDENTITY (1, 1) NOT NULL ,
	[topic_id] [int] NOT NULL ,
	[forum_id] [int] NOT NULL ,
	[poster_id] [int] NOT NULL ,
	[icon_id] [int] NOT NULL ,
	[poster_ip] [varchar] (40) NOT NULL ,
	[post_time] [int] NOT NULL ,
	[post_approved] [int] NOT NULL ,
	[post_reported] [int] NOT NULL ,
	[enable_bbcode] [int] NOT NULL ,
	[enable_smilies] [int] NOT NULL ,
	[enable_magic_url] [int] NOT NULL ,
	[enable_sig] [int] NOT NULL ,
	[post_username] [varchar] (255) NULL ,
	[post_subject] [varchar] (1000) NOT NULL ,
	[post_text] [text] NOT NULL ,
	[post_checksum] [varchar] (32) NOT NULL ,
	[post_encoding] [varchar] (20) NOT NULL ,
	[post_attachment] [int] NOT NULL ,
	[bbcode_bitfield] [int] NOT NULL ,
	[bbcode_uid] [varchar] (5) NOT NULL ,
	[post_edit_time] [int] NULL ,
	[post_edit_reason] [varchar] (3000) NULL,
	[post_edit_user] [int] NULL ,
	[post_edit_count] [int] NULL ,
	[post_edit_locked] [int] NULL 
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO

ALTER TABLE [phpbb_posts] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_posts] PRIMARY KEY  CLUSTERED 
	(
		[post_id]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_posts] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_posts__topic_id] DEFAULT (0) FOR [topic_id],
	CONSTRAINT [DF_phpbb_posts__forum_id] DEFAULT (0) FOR [forum_id],
	CONSTRAINT [DF_phpbb_posts__poster_id] DEFAULT (0) FOR [poster_id],
	CONSTRAINT [DF_phpbb_posts__icon_id] DEFAULT (0) FOR [icon_id],
	CONSTRAINT [DF_phpbb_posts__post_time] DEFAULT (0) FOR [post_time],
	CONSTRAINT [DF_phpbb_posts__post_approved] DEFAULT (1) FOR [post_approved],
	CONSTRAINT [DF_phpbb_posts__post_reported] DEFAULT (0) FOR [post_reported],
	CONSTRAINT [DF_phpbb_posts__enable_bbcode] DEFAULT (1) FOR [enable_bbcode],
	CONSTRAINT [DF_phpbb_posts__enable_smilies] DEFAULT (1) FOR [enable_smilies],
	CONSTRAINT [DF_phpbb_posts__enable_magic_url] DEFAULT (1) FOR [enable_magic_url],
	CONSTRAINT [DF_phpbb_posts__enable_sig] DEFAULT (1) FOR [enable_sig],
	CONSTRAINT [DF_phpbb_posts__post_encoding] DEFAULT ('iso-8859-1') FOR [post_encoding],
	CONSTRAINT [DF_phpbb_posts__post_attachment] DEFAULT (0) FOR [post_attachment],
	CONSTRAINT [DF_phpbb_posts__bbcode_bitfield] DEFAULT (0) FOR [bbcode_bitfield],
	CONSTRAINT [DF_phpbb_posts__post_edit_time] DEFAULT (0) FOR [post_edit_time],
	CONSTRAINT [DF_phpbb_posts__post_edit_user] DEFAULT (0) FOR [post_edit_user],
	CONSTRAINT [DF_phpbb_posts__post_edit_count] DEFAULT (0) FOR [post_edit_count],
	CONSTRAINT [DF_phpbb_posts__post_edit_locked] DEFAULT (0) FOR [post_edit_locked],
	CONSTRAINT [DF_phpbb_posts__bbcode_uid] DEFAULT ('') FOR [bbcode_uid]
GO

CREATE  INDEX [forum_id] ON [phpbb_posts]([forum_id]) ON [PRIMARY]
GO

CREATE  INDEX [topic_id] ON [phpbb_posts]([topic_id]) ON [PRIMARY]
GO

CREATE  INDEX [poster_ip] ON [phpbb_posts]([poster_ip]) ON [PRIMARY]
GO

CREATE  INDEX [poster_id] ON [phpbb_posts]([poster_id]) ON [PRIMARY]
GO

CREATE  INDEX [post_approved] ON [phpbb_posts]([post_approved]) ON [PRIMARY]
GO

CREATE  INDEX [post_time] ON [phpbb_posts]([post_time]) ON [PRIMARY]
GO


/*
 Table: phpbb_privmsgs
*/
CREATE TABLE [phpbb_privmsgs] (
	[msg_id] [int] IDENTITY (1, 1) NOT NULL ,
	[root_level] [int] NOT NULL ,
	[author_id] [int] NOT NULL ,
	[icon_id] [int] NOT NULL ,
	[author_ip] [varchar] (40) NOT NULL ,
	[message_time] [int] NOT NULL ,
	[enable_bbcode] [int] NOT NULL ,
	[enable_smilies] [int] NOT NULL ,
	[enable_magic_url] [int] NOT NULL ,
	[enable_sig] [int] NOT NULL ,
	[message_subject] [varchar] (1000) NOT NULL ,
	[message_text] [text] NOT NULL ,
	[message_edit_reason] [varchar] (3000) NULL ,
	[message_edit_user] [int] NULL ,
	[message_encoding] [varchar] (20) NOT NULL ,
	[message_attachment] [int] NOT NULL ,
	[bbcode_bitfield] [int] NOT NULL ,
	[bbcode_uid] [varchar] (5) NOT NULL ,
	[message_edit_time] [int] NULL ,
	[message_edit_count] [int] NULL ,
	[to_address] [text] NOT NULL ,
	[bcc_address] [text] NOT NULL 
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO

ALTER TABLE [phpbb_privmsgs] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_privmsgs] PRIMARY KEY  CLUSTERED 
	(
		[msg_id]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_privmsgs] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_privms_root_level] DEFAULT (0) FOR [root_level],
	CONSTRAINT [DF_phpbb_privms_author_id] DEFAULT (0) FOR [author_id],
	CONSTRAINT [DF_phpbb_privms_icon_id] DEFAULT (0) FOR [icon_id],
	CONSTRAINT [DF_phpbb_privms_message_time] DEFAULT (0) FOR [message_time],
	CONSTRAINT [DF_phpbb_privms_enable_bbcode] DEFAULT (1) FOR [enable_bbcode],
	CONSTRAINT [DF_phpbb_privms_enable_smilies] DEFAULT (1) FOR [enable_smilies],
	CONSTRAINT [DF_phpbb_privms_enable_magic_url] DEFAULT (1) FOR [enable_magic_url],
	CONSTRAINT [DF_phpbb_privms_enable_sig] DEFAULT (1) FOR [enable_sig],
	CONSTRAINT [DF_phpbb_privms_message_edit_user] DEFAULT (0) FOR [message_edit_user],
	CONSTRAINT [DF_phpbb_privms_message_encoding] DEFAULT ('iso-8859-1') FOR [message_encoding],
	CONSTRAINT [DF_phpbb_privms_message_attachment] DEFAULT (0) FOR [message_attachment],
	CONSTRAINT [DF_phpbb_privms_bbcode_bitfield] DEFAULT (0) FOR [bbcode_bitfield],
	CONSTRAINT [DF_phpbb_privms_message_edit_time] DEFAULT (0) FOR [message_edit_time],
	CONSTRAINT [DF_phpbb_privms_message_edit_count] DEFAULT (0) FOR [message_edit_count],
	CONSTRAINT [DF_phpbb_privms_author_ip] DEFAULT ('') FOR [author_ip],
	CONSTRAINT [DF_phpbb_privms_bbcode_uid] DEFAULT ('') FOR [bbcode_uid]
GO

CREATE  INDEX [author_ip] ON [phpbb_privmsgs]([author_ip]) ON [PRIMARY]
GO

CREATE  INDEX [message_time] ON [phpbb_privmsgs]([message_time]) ON [PRIMARY]
GO

CREATE  INDEX [author_id] ON [phpbb_privmsgs]([author_id]) ON [PRIMARY]
GO

CREATE  INDEX [root_level] ON [phpbb_privmsgs]([root_level]) ON [PRIMARY]
GO


/*
 Table: phpbb_privmsgs_folder
*/
CREATE TABLE [phpbb_privmsgs_folder] (
	[folder_id] [int] IDENTITY (1, 1) NOT NULL ,
	[user_id] [int] NOT NULL ,
	[folder_name] [varchar] (255) NOT NULL ,
	[pm_count] [int] NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_privmsgs_folder] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_privmsgs_folder] PRIMARY KEY  CLUSTERED 
	(
		[folder_id]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_privmsgs_folder] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_pmfold_user_id] DEFAULT (0) FOR [user_id],
	CONSTRAINT [DF_phpbb_pmfold_pm_count] DEFAULT (0) FOR [pm_count],
	CONSTRAINT [DF_phpbb_pmfold_folder_name] DEFAULT ('') FOR [folder_name]
GO

CREATE  INDEX [user_id] ON [phpbb_privmsgs_folder]([user_id]) ON [PRIMARY]
GO


/*
 Table: phpbb_privmsgs_rules
*/
CREATE TABLE [phpbb_privmsgs_rules] (
	[rule_id] [int] IDENTITY (1, 1) NOT NULL ,
	[user_id] [int] NOT NULL ,
	[rule_check] [int] NOT NULL ,
	[rule_connection] [int] NOT NULL ,
	[rule_string] [varchar] (255) NOT NULL ,
	[rule_user_id] [int] NOT NULL ,
	[rule_group_id] [int] NOT NULL ,
	[rule_action] [int] NOT NULL ,
	[rule_folder_id] [int] NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_privmsgs_rules] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_privmsgs_rules] PRIMARY KEY  CLUSTERED 
	(
		[rule_id]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_privmsgs_rules] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_pmrule_user_id] DEFAULT (0) FOR [user_id],
	CONSTRAINT [DF_phpbb_pmrule_rule_check] DEFAULT (0) FOR [rule_check],
	CONSTRAINT [DF_phpbb_pmrule_rule_connection] DEFAULT (0) FOR [rule_connection],
	CONSTRAINT [DF_phpbb_pmrule_rule_user_id] DEFAULT (0) FOR [rule_user_id],
	CONSTRAINT [DF_phpbb_pmrule_rule_group_id] DEFAULT (0) FOR [rule_group_id],
	CONSTRAINT [DF_phpbb_pmrule_rule_action] DEFAULT (0) FOR [rule_action],
	CONSTRAINT [DF_phpbb_pmrule_rule_folder_id] DEFAULT (0) FOR [rule_folder_id],
	CONSTRAINT [DF_phpbb_pmrule_rule_string] DEFAULT ('') FOR [rule_string]
GO


/*
 Table: phpbb_privmsgs_to
*/
CREATE TABLE [phpbb_privmsgs_to] (
	[msg_id] [int] NOT NULL ,
	[user_id] [int] NOT NULL ,
	[author_id] [int] NOT NULL ,
	[deleted] [int] NOT NULL ,
	[new] [int] NOT NULL ,
	[unread] [int] NOT NULL ,
	[replied] [int] NOT NULL ,
	[marked] [int] NOT NULL ,
	[forwarded] [int] NOT NULL ,
	[folder_id] [int] NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_privmsgs_to] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_pmto___msg_id] DEFAULT (0) FOR [msg_id],
	CONSTRAINT [DF_phpbb_pmto___user_id] DEFAULT (0) FOR [user_id],
	CONSTRAINT [DF_phpbb_pmto___author_id] DEFAULT (0) FOR [author_id],
	CONSTRAINT [DF_phpbb_pmto___deleted] DEFAULT (0) FOR [deleted],
	CONSTRAINT [DF_phpbb_pmto___new] DEFAULT (1) FOR [new],
	CONSTRAINT [DF_phpbb_pmto___unread] DEFAULT (1) FOR [unread],
	CONSTRAINT [DF_phpbb_pmto___replied] DEFAULT (0) FOR [replied],
	CONSTRAINT [DF_phpbb_pmto___marked] DEFAULT (0) FOR [marked],
	CONSTRAINT [DF_phpbb_pmto___forwarded] DEFAULT (0) FOR [forwarded],
	CONSTRAINT [DF_phpbb_pmto___folder_id] DEFAULT (0) FOR [folder_id]
GO

CREATE  INDEX [msg_id] ON [phpbb_privmsgs_to]([msg_id]) ON [PRIMARY]
GO

CREATE  INDEX [user_id] ON [phpbb_privmsgs_to]([user_id], [folder_id]) ON [PRIMARY]
GO


/*
 Table: phpbb_profile_fields
*/
CREATE TABLE [phpbb_profile_fields] (
	[field_id] [int] IDENTITY (1, 1) NOT NULL ,
	[field_name] [varchar] (255) NOT NULL ,
	[field_type] [int] NOT NULL ,
	[field_ident] [varchar] (20) NOT NULL ,
	[field_length] [varchar] (20) NOT NULL ,
	[field_minlen] [varchar] (255) NOT NULL ,
	[field_maxlen] [varchar] (255) NOT NULL ,
	[field_novalue] [varchar] (255) NOT NULL ,
	[field_default_value] [varchar] (255) NOT NULL ,
	[field_validation] [varchar] (20) NOT NULL ,
	[field_required] [int] NOT NULL ,
	[field_show_on_reg] [int] NOT NULL ,
	[field_hide] [int] NOT NULL ,
	[field_no_view] [int] NOT NULL ,
	[field_active] [int] NOT NULL ,
	[field_order] [int] NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_profile_fields] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_profile_fields] PRIMARY KEY  CLUSTERED 
	(
		[field_id]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_profile_fields] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_pffiel_field_default_value] DEFAULT ('0') FOR [field_default_value],
	CONSTRAINT [DF_phpbb_pffiel_field_required] DEFAULT (0) FOR [field_required],
	CONSTRAINT [DF_phpbb_pffiel_field_show_on_reg] DEFAULT (0) FOR [field_show_on_reg],
	CONSTRAINT [DF_phpbb_pffiel_field_hide] DEFAULT (0) FOR [field_hide],
	CONSTRAINT [DF_phpbb_pffiel_field_no_view] DEFAULT (0) FOR [field_no_view],
	CONSTRAINT [DF_phpbb_pffiel_field_active] DEFAULT (0) FOR [field_active],
	CONSTRAINT [DF_phpbb_pffiel_field_order] DEFAULT (0) FOR [field_order],
	CONSTRAINT [DF_phpbb_pffiel_field_name] DEFAULT ('') FOR [field_name],
	CONSTRAINT [DF_phpbb_pffiel_field_ident] DEFAULT ('') FOR [field_ident],
	CONSTRAINT [DF_phpbb_pffiel_field_length] DEFAULT ('') FOR [field_length],
	CONSTRAINT [DF_phpbb_pffiel_field_minlen] DEFAULT ('') FOR [field_minlen],
	CONSTRAINT [DF_phpbb_pffiel_field_maxlen] DEFAULT ('') FOR [field_maxlen],
	CONSTRAINT [DF_phpbb_pffiel_field_novalue] DEFAULT ('') FOR [field_novalue],
	CONSTRAINT [DF_phpbb_pffiel_field_validation] DEFAULT ('') FOR [field_validation]
GO

CREATE  INDEX [field_type] ON [phpbb_profile_fields]([field_type]) ON [PRIMARY]
GO

CREATE  INDEX [field_order] ON [phpbb_profile_fields]([field_order]) ON [PRIMARY]
GO


/*
 Table: phpbb_profile_fields_data
*/
CREATE TABLE [phpbb_profile_fields_data] (
	[user_id] [int] NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_profile_fields_data] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_profile_fields_data] PRIMARY KEY  CLUSTERED 
	(
		[user_id]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_profile_fields_data] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_pfdata_user_id] DEFAULT (0) FOR [user_id]
GO


/*
 Table: phpbb_profile_fields_lang
*/
CREATE TABLE [phpbb_profile_fields_lang] (
	[field_id] [int] NOT NULL ,
	[lang_id] [int] NOT NULL ,
	[option_id] [int] NOT NULL ,
	[field_type] [int] NOT NULL ,
	[value] [varchar] (255) NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_profile_fields_lang] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_profile_fields_lang] PRIMARY KEY  CLUSTERED 
	(
		[field_id],
		[lang_id],
		[option_id]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_profile_fields_lang] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_pfflan_field_id] DEFAULT (0) FOR [field_id],
	CONSTRAINT [DF_phpbb_pfflan_lang_id] DEFAULT (0) FOR [lang_id],
	CONSTRAINT [DF_phpbb_pfflan_option_id] DEFAULT (0) FOR [option_id],
	CONSTRAINT [DF_phpbb_pfflan_field_type] DEFAULT (0) FOR [field_type],
	CONSTRAINT [DF_phpbb_pfflan_value] DEFAULT ('') FOR [value]
GO


/*
 Table: phpbb_profile_lang
*/
CREATE TABLE [phpbb_profile_lang] (
	[field_id] [int] NOT NULL ,
	[lang_id] [int] NOT NULL ,
	[lang_name] [varchar] (255) NOT NULL ,
	[lang_explain] [text] ,
	[lang_default_value] [varchar] (255) NOT NULL 
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO

ALTER TABLE [phpbb_profile_lang] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_profile_lang] PRIMARY KEY  CLUSTERED 
	(
		[field_id],
		[lang_id]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_profile_lang] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_pflang_field_id] DEFAULT (0) FOR [field_id],
	CONSTRAINT [DF_phpbb_pflang_lang_id] DEFAULT (0) FOR [lang_id],
	CONSTRAINT [DF_phpbb_pflang_lang_name] DEFAULT ('') FOR [lang_name],
	CONSTRAINT [DF_phpbb_pflang_lang_default_value] DEFAULT ('') FOR [lang_default_value]
GO


/*
 Table: phpbb_ranks
*/
CREATE TABLE [phpbb_ranks] (
	[rank_id] [int] IDENTITY (1, 1) NOT NULL ,
	[rank_title] [varchar] (255) NOT NULL ,
	[rank_min] [int] NOT NULL ,
	[rank_special] [int] NULL ,
	[rank_image] [varchar] (255) NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_ranks] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_ranks] PRIMARY KEY  CLUSTERED 
	(
		[rank_id]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_ranks] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_ranks__rank_min] DEFAULT (0) FOR [rank_min],
	CONSTRAINT [DF_phpbb_ranks__rank_special] DEFAULT (0) FOR [rank_special]
GO


/*
 Table: phpbb_reports
*/
CREATE TABLE [phpbb_reports] (
	[report_id] [int] IDENTITY (1, 1) NOT NULL ,
	[reason_id] [int] NOT NULL ,
	[post_id] [int] NOT NULL ,
	[user_id] [int] NOT NULL ,
	[user_notify] [int] NOT NULL ,
	[report_closed] [int] NOT NULL ,
	[report_time] [int] NOT NULL ,
	[report_text] [text] 
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO

ALTER TABLE [phpbb_reports] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_reports] PRIMARY KEY  CLUSTERED 
	(
		[report_id]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_reports] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_report_reason_id] DEFAULT (0) FOR [reason_id],
	CONSTRAINT [DF_phpbb_report_post_id] DEFAULT (0) FOR [post_id],
	CONSTRAINT [DF_phpbb_report_user_id] DEFAULT (0) FOR [user_id],
	CONSTRAINT [DF_phpbb_report_user_notify] DEFAULT (0) FOR [user_notify],
	CONSTRAINT [DF_phpbb_report_report_closed] DEFAULT (0) FOR [report_closed],
	CONSTRAINT [DF_phpbb_report_report_time] DEFAULT (0) FOR [report_time]
GO


/*
 Table: phpbb_reports_reasons
*/
CREATE TABLE [phpbb_reports_reasons] (
	[reason_id] [int] IDENTITY (1, 1) NOT NULL ,
	[reason_title] [varchar] (255) NOT NULL ,
	[reason_description] [varchar] (8000) ,
	[reason_order] [int] NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_reports_reasons] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_reports_reasons] PRIMARY KEY  CLUSTERED 
	(
		[reason_id]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_reports_reasons] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_reporr_reason_order] DEFAULT (0) FOR [reason_order],
	CONSTRAINT [DF_phpbb_reporr_reason_title] DEFAULT ('') FOR [reason_title]
GO


/*
 Table: phpbb_search_results
*/
CREATE TABLE [phpbb_search_results] (
	[search_key] [varchar] (32) NOT NULL ,
	[search_time] [int] NOT NULL ,
	[search_keywords] [varchar] (8000) ,
	[search_authors] [text] 
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO

ALTER TABLE [phpbb_search_results] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_search_results] PRIMARY KEY  CLUSTERED 
	(
		[search_key]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_search_results] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_search_search_time] DEFAULT (0) FOR [search_time],
	CONSTRAINT [DF_phpbb_search_search_key] DEFAULT ('') FOR [search_key]
GO


/*
 Table: phpbb_search_wordlist
*/
CREATE TABLE [phpbb_search_wordlist] (
	[word_text] [nvarchar] (252) NOT NULL ,
	[word_id] [int] IDENTITY (1, 1) NOT NULL ,
	[word_common] [int] NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_search_wordlist] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_search_wordlist] PRIMARY KEY  CLUSTERED 
	(
		[word_text]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_search_wordlist] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_swlist_word_common] DEFAULT (0) FOR [word_common],
	CONSTRAINT [DF_phpbb_swlist_word_text] DEFAULT ('') FOR [word_text]
GO

CREATE  INDEX [word_id] ON [phpbb_search_wordlist]([word_id]) ON [PRIMARY]
GO


/*
 Table: phpbb_search_wordmatch
*/
CREATE TABLE [phpbb_search_wordmatch] (
	[post_id] [int] NOT NULL ,
	[word_id] [int] NOT NULL ,
	[title_match] [int] NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_search_wordmatch] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_swmatc_post_id] DEFAULT (0) FOR [post_id],
	CONSTRAINT [DF_phpbb_swmatc_word_id] DEFAULT (0) FOR [word_id],
	CONSTRAINT [DF_phpbb_swmatc_title_match] DEFAULT (0) FOR [title_match]
GO

CREATE  INDEX [word_id] ON [phpbb_search_wordmatch]([word_id]) ON [PRIMARY]
GO


/*
 Table: phpbb_sessions
*/
CREATE TABLE [phpbb_sessions] (
	[session_id] [varchar] (32) NOT NULL ,
	[session_user_id] [int] NOT NULL ,
	[session_last_visit] [int] NOT NULL ,
	[session_start] [int] NOT NULL ,
	[session_time] [int] NOT NULL ,
	[session_ip] [varchar] (40) NOT NULL ,
	[session_browser] [varchar] (150) NOT NULL ,
	[session_page] [varchar] (200) NOT NULL ,
	[session_viewonline] [int] NOT NULL ,
	[session_autologin] [int] NOT NULL ,
	[session_admin] [int] NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_sessions] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_sessions] PRIMARY KEY  CLUSTERED 
	(
		[session_id]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_sessions] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_sessio_session_user_id] DEFAULT (0) FOR [session_user_id],
	CONSTRAINT [DF_phpbb_sessio_session_last_visit] DEFAULT (0) FOR [session_last_visit],
	CONSTRAINT [DF_phpbb_sessio_session_start] DEFAULT (0) FOR [session_start],
	CONSTRAINT [DF_phpbb_sessio_session_time] DEFAULT (0) FOR [session_time],
	CONSTRAINT [DF_phpbb_sessio_session_ip] DEFAULT ('0') FOR [session_ip],
	CONSTRAINT [DF_phpbb_sessio_session_viewonline] DEFAULT (1) FOR [session_viewonline],
	CONSTRAINT [DF_phpbb_sessio_session_autologin] DEFAULT (0) FOR [session_autologin],
	CONSTRAINT [DF_phpbb_sessio_session_admin] DEFAULT (0) FOR [session_admin],
	CONSTRAINT [DF_phpbb_sessio_session_id] DEFAULT ('') FOR [session_id],
	CONSTRAINT [DF_phpbb_sessio_session_browser] DEFAULT ('') FOR [session_browser],
	CONSTRAINT [DF_phpbb_sessio_session_page] DEFAULT ('') FOR [session_page]
GO

CREATE  INDEX [session_time] ON [phpbb_sessions]([session_time]) ON [PRIMARY]
GO

CREATE  INDEX [session_user_id] ON [phpbb_sessions]([session_user_id]) ON [PRIMARY]
GO


/*
 Table: phpbb_sessions_keys
*/
CREATE TABLE [phpbb_sessions_keys] (
	[key_id] [varchar] (32) NOT NULL ,
	[user_id] [int] NOT NULL ,
	[last_ip] [varchar] (40) NOT NULL ,
	[last_login] [int] NOT NULL
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_sessions_keys] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_sessions_keys] PRIMARY KEY  CLUSTERED 
	(
		[key_id],
		[user_id]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_sessions_keys] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_sessik_key_id] DEFAULT ('0') FOR [key_id],
	CONSTRAINT [DF_phpbb_sessik_user_id] DEFAULT (0) FOR [user_id],
	CONSTRAINT [DF_phpbb_sessik_last_ip] DEFAULT ('0') FOR [last_ip],
	CONSTRAINT [DF_phpbb_sessik_last_login] DEFAULT (0) FOR [last_login]
GO

CREATE  INDEX [last_login] ON [phpbb_sessions_keys]([last_login]) ON [PRIMARY]
GO


/*
 Table: phpbb_sitelist
*/
CREATE TABLE [phpbb_sitelist] (
	[site_id] [int] IDENTITY (1, 1) NOT NULL ,
	[site_ip] [varchar] (40) NOT NULL ,
	[site_hostname] [varchar] (255) NOT NULL ,
	[ip_exclude] [int] NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_sitelist] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_sitelist] PRIMARY KEY  CLUSTERED 
	(
		[site_id]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_sitelist] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_siteli_ip_exclude] DEFAULT (0) FOR [ip_exclude],
	CONSTRAINT [DF_phpbb_siteli_ip_site_ip] DEFAULT ('') FOR [site_ip],
	CONSTRAINT [DF_phpbb_siteli_ip_site_hostname] DEFAULT ('') FOR [site_hostname]
GO


/*
 Table: phpbb_smilies
*/
CREATE TABLE [phpbb_smilies] (
	[smiley_id] [int] IDENTITY (1, 1) NOT NULL ,
	[code] [varchar] (50) NULL ,
	[emotion] [varchar] (50) NULL ,
	[smiley_url] [varchar] (50) NULL ,
	[smiley_width] [int] NOT NULL ,
	[smiley_height] [int] NOT NULL ,
	[smiley_order] [int] NOT NULL ,
	[display_on_posting] [int] NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_smilies] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_smilies] PRIMARY KEY  CLUSTERED 
	(
		[smiley_id]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_smilies] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_smilie_display_on_posting] DEFAULT (1) FOR [display_on_posting]
GO


/*
 Table: phpbb_styles
*/
CREATE TABLE [phpbb_styles] (
	[style_id] [int] IDENTITY (1, 1) NOT NULL ,
	[style_name] [varchar] (255) NOT NULL ,
	[style_copyright] [varchar] (255) NOT NULL ,
	[style_active] [int] NOT NULL ,
	[template_id] [int] NOT NULL ,
	[theme_id] [int] NOT NULL ,
	[imageset_id] [int] NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_styles] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_styles] PRIMARY KEY  CLUSTERED 
	(
		[style_id]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_styles] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_styles_style_active] DEFAULT (1) FOR [style_active],
	CONSTRAINT [DF_phpbb_styles_style_name] DEFAULT ('') FOR [style_name],
	CONSTRAINT [DF_phpbb_styles_style_copyright] DEFAULT ('') FOR [style_copyright]
GO

CREATE  UNIQUE  INDEX [style_name] ON [phpbb_styles]([style_name]) ON [PRIMARY]
GO

CREATE  INDEX [template_id] ON [phpbb_styles]([template_id]) ON [PRIMARY]
GO

CREATE  INDEX [theme_id] ON [phpbb_styles]([theme_id]) ON [PRIMARY]
GO

CREATE  INDEX [imageset_id] ON [phpbb_styles]([imageset_id]) ON [PRIMARY]
GO


/*
 Table: phpbb_styles_template
*/
CREATE TABLE [phpbb_styles_template] (
	[template_id] [int] IDENTITY (1, 1) NOT NULL ,
	[template_name] [varchar] (255) NOT NULL ,
	[template_copyright] [varchar] (255) NOT NULL ,
	[template_path] [varchar] (100) NOT NULL ,
	[bbcode_bitfield] [int] NOT NULL ,
	[template_storedb] [int] NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_styles_template] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_styles_template] PRIMARY KEY  CLUSTERED 
	(
		[template_id]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_styles_template] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_templa_bbcode_bitfield] DEFAULT (6921) FOR [bbcode_bitfield],
	CONSTRAINT [DF_phpbb_templa_template_storedb] DEFAULT (0) FOR [template_storedb]
GO

CREATE  UNIQUE  INDEX [template_name] ON [phpbb_styles_template]([template_name]) ON [PRIMARY]
GO


/*
 Table: phpbb_styles_template_data
*/
CREATE TABLE [phpbb_styles_template_data] (
	[template_id] [int] NOT NULL ,
	[template_filename] [varchar] (100) NOT NULL ,
	[template_included] [text] ,
	[template_mtime] [int] NOT NULL ,
	[template_data] [text] 
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO

ALTER TABLE [phpbb_styles_template_data] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_tpldat_template_mtime] DEFAULT (0) FOR [template_mtime],
	CONSTRAINT [DF_phpbb_tpldat_template_filename] DEFAULT ('') FOR [template_filename]
GO

CREATE  INDEX [template_id] ON [phpbb_styles_template_data]([template_id]) ON [PRIMARY]
GO

CREATE  INDEX [template_filename] ON [phpbb_styles_template_data]([template_filename]) ON [PRIMARY]
GO


/*
 Table: phpbb_styles_theme
*/
CREATE TABLE [phpbb_styles_theme] (
	[theme_id] [int] IDENTITY (1, 1) NOT NULL ,
	[theme_name] [varchar] (255) NOT NULL ,
	[theme_copyright] [varchar] (255) NOT NULL ,
	[theme_path] [varchar] (100) NOT NULL ,
	[theme_storedb] [int] NOT NULL ,
	[theme_mtime] [int] NOT NULL ,
	[theme_data] [text] 
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO

ALTER TABLE [phpbb_styles_theme] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_styles_theme] PRIMARY KEY  CLUSTERED 
	(
		[theme_id]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_styles_theme] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_theme__theme_storedb] DEFAULT (0) FOR [theme_storedb],
	CONSTRAINT [DF_phpbb_theme__theme_mtime] DEFAULT (0) FOR [theme_mtime],
	CONSTRAINT [DF_phpbb_theme__theme_name] DEFAULT ('') FOR [theme_name],
	CONSTRAINT [DF_phpbb_theme__theme_copyright] DEFAULT ('') FOR [theme_copyright],
	CONSTRAINT [DF_phpbb_theme__theme_path] DEFAULT ('') FOR [theme_path]
GO

CREATE  UNIQUE  INDEX [theme_name] ON [phpbb_styles_theme]([theme_name]) ON [PRIMARY]
GO

/*
 Table: phpbb_styles_imageset
*/
CREATE TABLE [phpbb_styles_imageset] (
	[imageset_id] [int] IDENTITY (1, 1) NOT NULL ,
	[imageset_name] [varchar] (255) NOT NULL ,
	[imageset_copyright] [varchar] (255) NOT NULL ,
	[imageset_path] [varchar] (100) NOT NULL ,
	[site_logo] [varchar] (200) NOT NULL ,
	[btn_post] [varchar] (200) NOT NULL ,
	[btn_post_pm] [varchar] (200) NOT NULL ,
	[btn_reply] [varchar] (200) NOT NULL ,
	[btn_reply_pm] [varchar] (200) NOT NULL ,
	[btn_locked] [varchar] (200) NOT NULL ,
	[btn_profile] [varchar] (200) NOT NULL ,
	[btn_pm] [varchar] (200) NOT NULL ,
	[btn_delete] [varchar] (200) NOT NULL ,
	[btn_info] [varchar] (200) NOT NULL ,
	[btn_quote] [varchar] (200) NOT NULL ,
	[btn_search] [varchar] (200) NOT NULL ,
	[btn_edit] [varchar] (200) NOT NULL ,
	[btn_report] [varchar] (200) NOT NULL ,
	[btn_email] [varchar] (200) NOT NULL ,
	[btn_www] [varchar] (200) NOT NULL ,
	[btn_icq] [varchar] (200) NOT NULL ,
	[btn_aim] [varchar] (200) NOT NULL ,
	[btn_yim] [varchar] (200) NOT NULL ,
	[btn_msnm] [varchar] (200) NOT NULL ,
	[btn_jabber] [varchar] (200) NOT NULL ,
	[btn_online] [varchar] (200) NOT NULL ,
	[btn_offline] [varchar] (200) NOT NULL ,
	[btn_friend] [varchar] (200) NOT NULL ,
	[btn_foe] [varchar] (200) NOT NULL ,
	[icon_unapproved] [varchar] (200) NOT NULL ,
	[icon_reported] [varchar] (200) NOT NULL ,
	[icon_attach] [varchar] (200) NOT NULL ,
	[icon_post] [varchar] (200) NOT NULL ,
	[icon_post_new] [varchar] (200) NOT NULL ,
	[icon_post_latest] [varchar] (200) NOT NULL ,
	[icon_post_newest] [varchar] (200) NOT NULL ,
	[forum] [varchar] (200) NOT NULL ,
	[forum_new] [varchar] (200) NOT NULL ,
	[forum_locked] [varchar] (200) NOT NULL ,
	[forum_link] [varchar] (200) NOT NULL ,
	[sub_forum] [varchar] (200) NOT NULL ,
	[sub_forum_new] [varchar] (200) NOT NULL ,
	[folder] [varchar] (200) NOT NULL ,
	[folder_moved] [varchar] (200) NOT NULL ,
	[folder_posted] [varchar] (200) NOT NULL ,
	[folder_new] [varchar] (200) NOT NULL ,
	[folder_new_posted] [varchar] (200) NOT NULL ,
	[folder_hot] [varchar] (200) NOT NULL ,
	[folder_hot_posted] [varchar] (200) NOT NULL ,
	[folder_hot_new] [varchar] (200) NOT NULL ,
	[folder_hot_new_posted] [varchar] (200) NOT NULL ,
	[folder_locked] [varchar] (200) NOT NULL ,
	[folder_locked_posted] [varchar] (200) NOT NULL ,
	[folder_locked_new] [varchar] (200) NOT NULL ,
	[folder_locked_new_posted] [varchar] (200) NOT NULL ,
	[folder_sticky] [varchar] (200) NOT NULL ,
	[folder_sticky_posted] [varchar] (200) NOT NULL ,
	[folder_sticky_new] [varchar] (200) NOT NULL ,
	[folder_sticky_new_posted] [varchar] (200) NOT NULL ,
	[folder_announce] [varchar] (200) NOT NULL ,
	[folder_announce_posted] [varchar] (200) NOT NULL ,
	[folder_announce_new] [varchar] (200) NOT NULL ,
	[folder_announce_new_posted] [varchar] (200) NOT NULL ,
	[folder_global] [varchar] (200) NOT NULL ,
	[folder_global_posted] [varchar] (200) NOT NULL ,
	[folder_global_new] [varchar] (200) NOT NULL ,
	[folder_global_new_posted] [varchar] (200) NOT NULL ,
	[poll_left] [varchar] (200) NOT NULL ,
	[poll_center] [varchar] (200) NOT NULL ,
	[poll_right] [varchar] (200) NOT NULL ,
	[attach_progress_bar] [varchar] (200) NOT NULL ,
	[user_icon1] [varchar] (200) NOT NULL ,
	[user_icon2] [varchar] (200) NOT NULL ,
	[user_icon3] [varchar] (200) NOT NULL ,
	[user_icon4] [varchar] (200) NOT NULL ,
	[user_icon5] [varchar] (200) NOT NULL ,
	[user_icon6] [varchar] (200) NOT NULL ,
	[user_icon7] [varchar] (200) NOT NULL ,
	[user_icon8] [varchar] (200) NOT NULL ,
	[user_icon9] [varchar] (200) NOT NULL ,
	[user_icon10] [varchar] (200) NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_styles_imageset] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_styles_imageset] PRIMARY KEY  CLUSTERED 
	(
		[imageset_id]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_styles_imageset] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_styles_imageset_imageset_name] DEFAULT ('') FOR [imageset_name],
	CONSTRAINT [DF_phpbb_styles_imageset_imageset_copyright] DEFAULT ('') FOR [imageset_copyright],
	CONSTRAINT [DF_phpbb_styles_imageset_imageset_path] DEFAULT ('') FOR [imageset_path],
	CONSTRAINT [DF_phpbb_styles_imageset_site_logo] DEFAULT ('') FOR [site_logo],
	CONSTRAINT [DF_phpbb_styles_imageset_btn_post] DEFAULT ('') FOR [btn_post],
	CONSTRAINT [DF_phpbb_styles_imageset_btn_post_pm] DEFAULT ('') FOR [btn_post_pm],
	CONSTRAINT [DF_phpbb_styles_imageset_btn_reply] DEFAULT ('') FOR [btn_reply],
	CONSTRAINT [DF_phpbb_styles_imageset_btn_reply_pm] DEFAULT ('') FOR [btn_reply_pm],
	CONSTRAINT [DF_phpbb_styles_imageset_btn_locked] DEFAULT ('') FOR [btn_locked],
	CONSTRAINT [DF_phpbb_styles_imageset_btn_profile] DEFAULT ('') FOR [btn_profile],
	CONSTRAINT [DF_phpbb_styles_imageset_btn_pm] DEFAULT ('') FOR [btn_pm],
	CONSTRAINT [DF_phpbb_styles_imageset_btn_delete] DEFAULT ('') FOR [btn_delete],
	CONSTRAINT [DF_phpbb_styles_imageset_btn_info] DEFAULT ('') FOR [btn_info],
	CONSTRAINT [DF_phpbb_styles_imageset_btn_quote] DEFAULT ('') FOR [btn_quote],
	CONSTRAINT [DF_phpbb_styles_imageset_btn_search] DEFAULT ('') FOR [btn_search],
	CONSTRAINT [DF_phpbb_styles_imageset_btn_edit] DEFAULT ('') FOR [btn_edit],
	CONSTRAINT [DF_phpbb_styles_imageset_btn_report] DEFAULT ('') FOR [btn_report],
	CONSTRAINT [DF_phpbb_styles_imageset_btn_email] DEFAULT ('') FOR [btn_email],
	CONSTRAINT [DF_phpbb_styles_imageset_btn_www] DEFAULT ('') FOR [btn_www],
	CONSTRAINT [DF_phpbb_styles_imageset_btn_icq] DEFAULT ('') FOR [btn_icq],
	CONSTRAINT [DF_phpbb_styles_imageset_btn_aim] DEFAULT ('') FOR [btn_aim],
	CONSTRAINT [DF_phpbb_styles_imageset_btn_yim] DEFAULT ('') FOR [btn_yim],
	CONSTRAINT [DF_phpbb_styles_imageset_btn_msnm] DEFAULT ('') FOR [btn_msnm],
	CONSTRAINT [DF_phpbb_styles_imageset_btn_jabber] DEFAULT ('') FOR [btn_jabber],
	CONSTRAINT [DF_phpbb_styles_imageset_btn_online] DEFAULT ('') FOR [btn_online],
	CONSTRAINT [DF_phpbb_styles_imageset_btn_offline] DEFAULT ('') FOR [btn_offline],
	CONSTRAINT [DF_phpbb_styles_imageset_btn_friend] DEFAULT ('') FOR [btn_friend],
	CONSTRAINT [DF_phpbb_styles_imageset_btn_foe] DEFAULT ('') FOR [btn_foe],
	CONSTRAINT [DF_phpbb_styles_imageset_icon_unapproved] DEFAULT ('') FOR [icon_unapproved],
	CONSTRAINT [DF_phpbb_styles_imageset_icon_reported] DEFAULT ('') FOR [icon_reported],
	CONSTRAINT [DF_phpbb_styles_imageset_icon_attach] DEFAULT ('') FOR [icon_attach],
	CONSTRAINT [DF_phpbb_styles_imageset_icon_post] DEFAULT ('') FOR [icon_post],
	CONSTRAINT [DF_phpbb_styles_imageset_icon_post_new] DEFAULT ('') FOR [icon_post_new],
	CONSTRAINT [DF_phpbb_styles_imageset_icon_post_latest] DEFAULT ('') FOR [icon_post_latest],
	CONSTRAINT [DF_phpbb_styles_imageset_icon_post_newest] DEFAULT ('') FOR [icon_post_newest],
	CONSTRAINT [DF_phpbb_styles_imageset_forum] DEFAULT ('') FOR [forum],
	CONSTRAINT [DF_phpbb_styles_imageset_forum_new] DEFAULT ('') FOR [forum_new],
	CONSTRAINT [DF_phpbb_styles_imageset_forum_locked] DEFAULT ('') FOR [forum_locked],
	CONSTRAINT [DF_phpbb_styles_imageset_forum_link] DEFAULT ('') FOR [forum_link],
	CONSTRAINT [DF_phpbb_styles_imageset_sub_forum] DEFAULT ('') FOR [sub_forum],
	CONSTRAINT [DF_phpbb_styles_imageset_sub_forum_new] DEFAULT ('') FOR [sub_forum_new],
	CONSTRAINT [DF_phpbb_styles_imageset_folder] DEFAULT ('') FOR [folder],
	CONSTRAINT [DF_phpbb_styles_imageset_folder_moved] DEFAULT ('') FOR [folder_moved],
	CONSTRAINT [DF_phpbb_styles_imageset_folder_posted] DEFAULT ('') FOR [folder_posted],
	CONSTRAINT [DF_phpbb_styles_imageset_folder_new] DEFAULT ('') FOR [folder_new],
	CONSTRAINT [DF_phpbb_styles_imageset_folder_new_posted] DEFAULT ('') FOR [folder_new_posted],
	CONSTRAINT [DF_phpbb_styles_imageset_folder_hot] DEFAULT ('') FOR [folder_hot],
	CONSTRAINT [DF_phpbb_styles_imageset_folder_hot_posted] DEFAULT ('') FOR [folder_hot_posted],
	CONSTRAINT [DF_phpbb_styles_imageset_folder_hot_new] DEFAULT ('') FOR [folder_hot_new],
	CONSTRAINT [DF_phpbb_styles_imageset_folder_hot_new_posted] DEFAULT ('') FOR [folder_hot_new_posted],
	CONSTRAINT [DF_phpbb_styles_imageset_folder_locked] DEFAULT ('') FOR [folder_locked],
	CONSTRAINT [DF_phpbb_styles_imageset_folder_locked_posted] DEFAULT ('') FOR [folder_locked_posted],
	CONSTRAINT [DF_phpbb_styles_imageset_folder_locked_new] DEFAULT ('') FOR [folder_locked_new],
	CONSTRAINT [DF_phpbb_styles_imageset_folder_locked_new_posted] DEFAULT ('') FOR [folder_locked_new_posted],
	CONSTRAINT [DF_phpbb_styles_imageset_folder_sticky] DEFAULT ('') FOR [folder_sticky],
	CONSTRAINT [DF_phpbb_styles_imageset_folder_sticky_posted] DEFAULT ('') FOR [folder_sticky_posted],
	CONSTRAINT [DF_phpbb_styles_imageset_folder_sticky_new] DEFAULT ('') FOR [folder_sticky_new],
	CONSTRAINT [DF_phpbb_styles_imageset_folder_sticky_new_posted] DEFAULT ('') FOR [folder_sticky_new_posted],
	CONSTRAINT [DF_phpbb_styles_imageset_folder_announce] DEFAULT ('') FOR [folder_announce],
	CONSTRAINT [DF_phpbb_styles_imageset_folder_announce_posted] DEFAULT ('') FOR [folder_announce_posted],
	CONSTRAINT [DF_phpbb_styles_imageset_folder_announce_new] DEFAULT ('') FOR [folder_announce_new],
	CONSTRAINT [DF_phpbb_styles_imageset_folder_announce_new_posted] DEFAULT ('') FOR [folder_announce_new_posted],
	CONSTRAINT [DF_phpbb_styles_imageset_folder_global] DEFAULT ('') FOR [folder_global],
	CONSTRAINT [DF_phpbb_styles_imageset_folder_global_posted] DEFAULT ('') FOR [folder_global_posted],
	CONSTRAINT [DF_phpbb_styles_imageset_folder_global_new] DEFAULT ('') FOR [folder_global_new],
	CONSTRAINT [DF_phpbb_styles_imageset_folder_global_new_posted] DEFAULT ('') FOR [folder_global_new_posted],
	CONSTRAINT [DF_phpbb_styles_imageset_poll_left] DEFAULT ('') FOR [poll_left],
	CONSTRAINT [DF_phpbb_styles_imageset_poll_center] DEFAULT ('') FOR [poll_center],
	CONSTRAINT [DF_phpbb_styles_imageset_poll_right] DEFAULT ('') FOR [poll_right],
	CONSTRAINT [DF_phpbb_styles_imageset_attach_progress_bar] DEFAULT ('') FOR [attach_progress_bar],
	CONSTRAINT [DF_phpbb_styles_imageset_user_icon1] DEFAULT ('') FOR [user_icon1],
	CONSTRAINT [DF_phpbb_styles_imageset_user_icon2] DEFAULT ('') FOR [user_icon2],
	CONSTRAINT [DF_phpbb_styles_imageset_user_icon3] DEFAULT ('') FOR [user_icon3],
	CONSTRAINT [DF_phpbb_styles_imageset_user_icon4] DEFAULT ('') FOR [user_icon4],
	CONSTRAINT [DF_phpbb_styles_imageset_user_icon5] DEFAULT ('') FOR [user_icon5],
	CONSTRAINT [DF_phpbb_styles_imageset_user_icon6] DEFAULT ('') FOR [user_icon6],
	CONSTRAINT [DF_phpbb_styles_imageset_user_icon7] DEFAULT ('') FOR [user_icon7],
	CONSTRAINT [DF_phpbb_styles_imageset_user_icon8] DEFAULT ('') FOR [user_icon8],
	CONSTRAINT [DF_phpbb_styles_imageset_user_icon9] DEFAULT ('') FOR [user_icon9],
	CONSTRAINT [DF_phpbb_styles_imageset_user_icon10] DEFAULT ('') FOR [user_icon10]
GO

CREATE  UNIQUE  INDEX [imageset_name] ON [phpbb_styles_imageset]([imageset_name]) ON [PRIMARY]
GO



/*
 Table: phpbb_topics
*/
CREATE TABLE [phpbb_topics] (
	[topic_id] [int] IDENTITY (1, 1) NOT NULL ,
	[forum_id] [int] NOT NULL ,
	[icon_id] [int] NOT NULL ,
	[topic_attachment] [int] NOT NULL ,
	[topic_approved] [int] NOT NULL ,
	[topic_reported] [int] NOT NULL ,
	[topic_title] [varchar] (1000) ,
	[topic_poster] [int] NOT NULL ,
	[topic_time] [int] NOT NULL ,
	[topic_time_limit] [int] NOT NULL ,
	[topic_views] [int] NOT NULL ,
	[topic_replies] [int] NOT NULL ,
	[topic_replies_real] [int] NOT NULL ,
	[topic_status] [int] NOT NULL ,
	[topic_type] [int] NOT NULL ,
	[topic_first_post_id] [int] NOT NULL ,
	[topic_first_poster_name] [varchar] (255) NULL ,
	[topic_last_post_id] [int] NOT NULL ,
	[topic_last_poster_id] [int] NOT NULL ,
	[topic_last_poster_name] [varchar] (255) NULL ,
	[topic_last_post_time] [int] NOT NULL ,
	[topic_last_view_time] [int] NOT NULL ,
	[topic_moved_id] [int] NOT NULL ,
	[topic_bumped] [int] NOT NULL ,
	[topic_bumper] [int] NOT NULL ,
	[poll_title] [varchar] (3000) NULL ,
	[poll_start] [int] NULL ,
	[poll_length] [int] NULL ,
	[poll_max_options] [int] NOT NULL ,
	[poll_last_vote] [int] NULL ,
	[poll_vote_change] [int] NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_topics] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_topics] PRIMARY KEY  CLUSTERED 
	(
		[topic_id]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_topics] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_topics_forum_id] DEFAULT (0) FOR [forum_id],
	CONSTRAINT [DF_phpbb_topics_icon_id] DEFAULT (1) FOR [icon_id],
	CONSTRAINT [DF_phpbb_topics_topic_attachment] DEFAULT (0) FOR [topic_attachment],
	CONSTRAINT [DF_phpbb_topics_topic_approved] DEFAULT (1) FOR [topic_approved],
	CONSTRAINT [DF_phpbb_topics_topic_reported] DEFAULT (0) FOR [topic_reported],
	CONSTRAINT [DF_phpbb_topics_topic_poster] DEFAULT (0) FOR [topic_poster],
	CONSTRAINT [DF_phpbb_topics_topic_time] DEFAULT (0) FOR [topic_time],
	CONSTRAINT [DF_phpbb_topics_topic_time_limit] DEFAULT (0) FOR [topic_time_limit],
	CONSTRAINT [DF_phpbb_topics_topic_views] DEFAULT (0) FOR [topic_views],
	CONSTRAINT [DF_phpbb_topics_topic_replies] DEFAULT (0) FOR [topic_replies],
	CONSTRAINT [DF_phpbb_topics_topic_replies_real] DEFAULT (0) FOR [topic_replies_real],
	CONSTRAINT [DF_phpbb_topics_topic_status] DEFAULT (0) FOR [topic_status],
	CONSTRAINT [DF_phpbb_topics_topic_type] DEFAULT (0) FOR [topic_type],
	CONSTRAINT [DF_phpbb_topics_topic_first_post_id] DEFAULT (0) FOR [topic_first_post_id],
	CONSTRAINT [DF_phpbb_topics_topic_last_post_id] DEFAULT (0) FOR [topic_last_post_id],
	CONSTRAINT [DF_phpbb_topics_topic_last_poster_id] DEFAULT (0) FOR [topic_last_poster_id],
	CONSTRAINT [DF_phpbb_topics_topic_last_post_time] DEFAULT (0) FOR [topic_last_post_time],
	CONSTRAINT [DF_phpbb_topics_topic_last_view_time] DEFAULT (0) FOR [topic_last_view_time],
	CONSTRAINT [DF_phpbb_topics_topic_moved_id] DEFAULT (0) FOR [topic_moved_id],
	CONSTRAINT [DF_phpbb_topics_topic_bumped] DEFAULT (0) FOR [topic_bumped],
	CONSTRAINT [DF_phpbb_topics_topic_bumper] DEFAULT (0) FOR [topic_bumper],
	CONSTRAINT [DF_phpbb_topics_poll_start] DEFAULT (0) FOR [poll_start],
	CONSTRAINT [DF_phpbb_topics_poll_length] DEFAULT (0) FOR [poll_length],
	CONSTRAINT [DF_phpbb_topics_poll_max_options] DEFAULT (1) FOR [poll_max_options],
	CONSTRAINT [DF_phpbb_topics_poll_last_vote] DEFAULT (0) FOR [poll_last_vote],
	CONSTRAINT [DF_phpbb_topics_poll_vote_change] DEFAULT (0) FOR [poll_vote_change]
GO

CREATE  INDEX [forum_id] ON [phpbb_topics]([forum_id]) ON [PRIMARY]
GO

CREATE  INDEX [forum_id_type] ON [phpbb_topics]([forum_id], [topic_type]) ON [PRIMARY]
GO

CREATE  INDEX [topic_last_post_time] ON [phpbb_topics]([topic_last_post_time]) ON [PRIMARY]
GO


/*
 Table: phpbb_topics_track
*/
CREATE TABLE [phpbb_topics_track] (
	[user_id] [int] NOT NULL ,
	[topic_id] [int] NOT NULL ,
	[forum_id] [int] NOT NULL ,
	[mark_time] [int] NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_topics_track] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_topics_track] PRIMARY KEY  CLUSTERED 
	(
		[user_id],
		[topic_id]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_topics_track] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_tmarki_user_id] DEFAULT (0) FOR [user_id],
	CONSTRAINT [DF_phpbb_tmarki_topic_id] DEFAULT (0) FOR [topic_id],
	CONSTRAINT [DF_phpbb_tmarki_forum_id] DEFAULT (0) FOR [forum_id],
	CONSTRAINT [DF_phpbb_tmarki_mark_time] DEFAULT (0) FOR [mark_time]
GO

CREATE  INDEX [forum_id] ON [phpbb_topics_track]([forum_id]) ON [PRIMARY]
GO


/*
 Table: phpbb_topics_posted
*/
CREATE TABLE [phpbb_topics_posted] (
	[user_id] [int] NOT NULL ,
	[topic_id] [int] NOT NULL ,
	[topic_posted] [int] NOT NULL
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_topics_posted] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_topics_posted] PRIMARY KEY  CLUSTERED 
	(
		[user_id],
		[topic_id]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_topics_posted] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_tposte_user_id] DEFAULT (0) FOR [user_id],
	CONSTRAINT [DF_phpbb_tposte_topic_id] DEFAULT (0) FOR [topic_id],
	CONSTRAINT [DF_phpbb_tposte_topic_posted] DEFAULT (0) FOR [topic_posted]
GO


/*
 Table: phpbb_topics_watch
*/
CREATE TABLE [phpbb_topics_watch] (
	[topic_id] [int] NOT NULL ,
	[user_id] [int] NOT NULL ,
	[notify_status] [int] NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_topics_watch] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_twatch_topic_id] DEFAULT (0) FOR [topic_id],
	CONSTRAINT [DF_phpbb_twatch_user_id] DEFAULT (0) FOR [user_id],
	CONSTRAINT [DF_phpbb_twatch_notify_status] DEFAULT (0) FOR [notify_status]
GO

CREATE  INDEX [topic_id] ON [phpbb_topics_watch]([topic_id]) ON [PRIMARY]
GO

CREATE  INDEX [user_id] ON [phpbb_topics_watch]([user_id]) ON [PRIMARY]
GO

CREATE  INDEX [notify_status] ON [phpbb_topics_watch]([notify_status]) ON [PRIMARY]
GO


/*
 Table: phpbb_user_group
*/
CREATE TABLE [phpbb_user_group] (
	[group_id] [int] NOT NULL ,
	[user_id] [int] NOT NULL ,
	[group_leader] [int] NOT NULL ,
	[user_pending] [int] NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_user_group] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_usersg_group_id] DEFAULT (0) FOR [group_id],
	CONSTRAINT [DF_phpbb_usersg_user_id] DEFAULT (0) FOR [user_id],
	CONSTRAINT [DF_phpbb_usersg_group_leader] DEFAULT (0) FOR [group_leader]
GO

CREATE  INDEX [group_id] ON [phpbb_user_group]([group_id]) ON [PRIMARY]
GO

CREATE  INDEX [user_id] ON [phpbb_user_group]([user_id]) ON [PRIMARY]
GO

CREATE  INDEX [group_leader] ON [phpbb_user_group]([group_leader]) ON [PRIMARY]
GO


/*
 Table: phpbb_users
*/
CREATE TABLE [phpbb_users] (
	[user_id] [int] IDENTITY (1, 1) NOT NULL ,
	[user_type] [int] NOT NULL ,
	[group_id] [int] NOT NULL ,
	[user_permissions] [text] NULL ,
	[user_perm_from] [int] NULL ,
	[user_ip] [varchar] (40) NOT NULL ,
	[user_regdate] [int] NOT NULL ,
	[username] [varchar] (255) NOT NULL ,
	[user_password] [varchar] (40) NOT NULL ,
	[user_passchg] [int] NULL ,
	[user_email] [varchar] (100) NOT NULL ,
	[user_email_hash] [float] NOT NULL ,
	[user_birthday] [varchar] (10) NULL ,
	[user_lastvisit] [int] NOT NULL ,
	[user_lastmark] [int] NOT NULL ,
	[user_lastpost_time] [int] NOT NULL ,
	[user_lastpage] [varchar] (200) NOT NULL ,
	[user_last_confirm_key] [varchar] (10) NULL ,
	[user_last_search] [int] NULL ,
	[user_warnings] [int] NULL ,
	[user_last_warning] [int] NULL ,
	[user_login_attempts] [int] NULL ,
	[user_posts] [int] NOT NULL ,
	[user_lang] [varchar] (30) NOT NULL ,
	[user_timezone] [float] NOT NULL ,
	[user_dst] [int] NOT NULL ,
	[user_dateformat] [varchar] (30) NOT NULL ,
	[user_style] [int] NOT NULL ,
	[user_rank] [int] NULL ,
	[user_colour] [varchar] (6) NOT NULL ,
	[user_new_privmsg] [int] NOT NULL ,
	[user_unread_privmsg] [int] NOT NULL ,
	[user_last_privmsg] [int] NOT NULL ,
	[user_message_rules] [int] NOT NULL ,
	[user_full_folder] [int] NOT NULL ,
	[user_emailtime] [int] NOT NULL ,
	[user_topic_show_days] [int] NOT NULL ,
	[user_topic_sortby_type] [varchar] (1) NOT NULL ,
	[user_topic_sortby_dir] [varchar] (1) NOT NULL ,
	[user_post_show_days] [int] NOT NULL ,
	[user_post_sortby_type] [varchar] (1) NOT NULL ,
	[user_post_sortby_dir] [varchar] (1) NOT NULL ,
	[user_notify] [int] NOT NULL ,
	[user_notify_pm] [int] NOT NULL ,
	[user_notify_type] [int] NOT NULL ,
	[user_allow_pm] [int] NOT NULL ,
	[user_allow_email] [int] NOT NULL ,
	[user_allow_viewonline] [int] NOT NULL ,
	[user_allow_viewemail] [int] NOT NULL ,
	[user_allow_massemail] [int] NOT NULL ,
	[user_options] [int] NOT NULL ,
	[user_avatar] [varchar] (255) NOT NULL ,
	[user_avatar_type] [int] NOT NULL ,
	[user_avatar_width] [int] NOT NULL ,
	[user_avatar_height] [int] NOT NULL ,
	[user_sig] [text] NULL ,
	[user_sig_bbcode_uid] [varchar] (5) NULL ,
	[user_sig_bbcode_bitfield] [int] NULL ,
	[user_from] [varchar] (100) NULL ,
	[user_icq] [varchar] (15) NULL ,
	[user_aim] [varchar] (255) NULL ,
	[user_yim] [varchar] (255) NULL ,
	[user_msnm] [varchar] (255) NULL ,
	[user_jabber] [varchar] (255) NULL ,
	[user_website] [varchar] (200) NULL ,
	[user_occ] [varchar] (255) NULL ,
	[user_interests] [varchar] (255) NULL ,
	[user_actkey] [varchar] (32) NOT NULL ,
	[user_newpasswd] [varchar] (32) NULL 
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO

ALTER TABLE [phpbb_users] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_users] PRIMARY KEY  CLUSTERED 
	(
		[user_id]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_users] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_users__user_type] DEFAULT (0) FOR [user_type],
	CONSTRAINT [DF_phpbb_users__group_id] DEFAULT (3) FOR [group_id],
	CONSTRAINT [DF_phpbb_users__user_perm_from] DEFAULT (0) FOR [user_perm_from],
	CONSTRAINT [DF_phpbb_users__user_regdate] DEFAULT (0) FOR [user_regdate],
	CONSTRAINT [DF_phpbb_users__user_passchg] DEFAULT (0) FOR [user_passchg],
	CONSTRAINT [DF_phpbb_users__user_email_hash] DEFAULT (0) FOR [user_email_hash],
	CONSTRAINT [DF_phpbb_users__user_lastvisit] DEFAULT (0) FOR [user_lastvisit],
	CONSTRAINT [DF_phpbb_users__user_lastmark] DEFAULT (0) FOR [user_lastmark],
	CONSTRAINT [DF_phpbb_users__user_lastpost_time] DEFAULT (0) FOR [user_lastpost_time],
	CONSTRAINT [DF_phpbb_users__user_warnings] DEFAULT (0) FOR [user_warnings],
	CONSTRAINT [DF_phpbb_users__user_last_warning] DEFAULT (0) FOR [user_last_warning],
	CONSTRAINT [DF_phpbb_users__user_login_attempts] DEFAULT (0) FOR [user_login_attempts],
	CONSTRAINT [DF_phpbb_users__user_posts] DEFAULT (0) FOR [user_posts],
	CONSTRAINT [DF_phpbb_users__user_timezone] DEFAULT (0) FOR [user_timezone],
	CONSTRAINT [DF_phpbb_users__user_dst] DEFAULT (0) FOR [user_dst],
	CONSTRAINT [DF_phpbb_users__user_dateformat] DEFAULT ('d M Y H:i') FOR [user_dateformat],
	CONSTRAINT [DF_phpbb_users__user_style] DEFAULT (0) FOR [user_style],
	CONSTRAINT [DF_phpbb_users__user_rank] DEFAULT (0) FOR [user_rank],
	CONSTRAINT [DF_phpbb_users__user_new_privmsg] DEFAULT (0) FOR [user_new_privmsg],
	CONSTRAINT [DF_phpbb_users__user_unread_privmsg] DEFAULT (0) FOR [user_unread_privmsg],
	CONSTRAINT [DF_phpbb_users__user_last_privmsg] DEFAULT (0) FOR [user_last_privmsg],
	CONSTRAINT [DF_phpbb_users__user_message_rules] DEFAULT (0) FOR [user_message_rules],
	CONSTRAINT [DF_phpbb_users__user_full_folder] DEFAULT ((-3)) FOR [user_full_folder],
	CONSTRAINT [DF_phpbb_users__user_emailtime] DEFAULT (0) FOR [user_emailtime],
	CONSTRAINT [DF_phpbb_users__user_topic_sortby_type] DEFAULT ('t') FOR [user_topic_sortby_type],
	CONSTRAINT [DF_phpbb_users__user_topic_sortby_dir] DEFAULT ('d') FOR [user_topic_sortby_dir],
	CONSTRAINT [DF_phpbb_users__user_topic_show_days] DEFAULT (0) FOR [user_topic_show_days],
	CONSTRAINT [DF_phpbb_users__user_post_show_days] DEFAULT (0) FOR [user_post_show_days],
	CONSTRAINT [DF_phpbb_users__user_post_sortby_type] DEFAULT ('t') FOR [user_post_sortby_type],
	CONSTRAINT [DF_phpbb_users__user_post_sortby_dir] DEFAULT ('a') FOR [user_post_sortby_dir],
	CONSTRAINT [DF_phpbb_users__user_notify] DEFAULT (0) FOR [user_notify],
	CONSTRAINT [DF_phpbb_users__user_notify_pm] DEFAULT (1) FOR [user_notify_pm],
	CONSTRAINT [DF_phpbb_users__user_notify_type] DEFAULT (0) FOR [user_notify_type],
	CONSTRAINT [DF_phpbb_users__user_allow_pm] DEFAULT (1) FOR [user_allow_pm],
	CONSTRAINT [DF_phpbb_users__user_allow_email] DEFAULT (1) FOR [user_allow_email],
	CONSTRAINT [DF_phpbb_users__user_allow_viewonlin] DEFAULT (1) FOR [user_allow_viewonline],
	CONSTRAINT [DF_phpbb_users__user_allow_viewemail] DEFAULT (1) FOR [user_allow_viewemail],
	CONSTRAINT [DF_phpbb_users__user_allow_massemail] DEFAULT (1) FOR [user_allow_massemail],
	CONSTRAINT [DF_phpbb_users__user_options] DEFAULT (893) FOR [user_options],
	CONSTRAINT [DF_phpbb_users__user_avatar_type] DEFAULT (0) FOR [user_avatar_type],
	CONSTRAINT [DF_phpbb_users__user_avatar_width] DEFAULT (0) FOR [user_avatar_width],
	CONSTRAINT [DF_phpbb_users__user_avatar_height] DEFAULT (0) FOR [user_avatar_height],
	CONSTRAINT [DF_phpbb_users__user_sig_bbcode_bitf] DEFAULT (0) FOR [user_sig_bbcode_bitfield],
	CONSTRAINT [DF_phpbb_users__user_ip] DEFAULT ('') FOR [user_ip],
	CONSTRAINT [DF_phpbb_users__username] DEFAULT ('') FOR [username],
	CONSTRAINT [DF_phpbb_users__user_password] DEFAULT ('') FOR [user_password],
	CONSTRAINT [DF_phpbb_users__user_email] DEFAULT ('') FOR [user_email],
	CONSTRAINT [DF_phpbb_users__user_birthday] DEFAULT ('') FOR [user_birthday],
	CONSTRAINT [DF_phpbb_users__user_lastpage] DEFAULT ('') FOR [user_lastpage],
	CONSTRAINT [DF_phpbb_users__user_last_confirm_key] DEFAULT ('') FOR [user_last_confirm_key],
	CONSTRAINT [DF_phpbb_users__user_lang] DEFAULT ('') FOR [user_lang],
	CONSTRAINT [DF_phpbb_users__user_colour] DEFAULT ('') FOR [user_colour],
	CONSTRAINT [DF_phpbb_users__user_avatar] DEFAULT ('') FOR [user_avatar],
	CONSTRAINT [DF_phpbb_users__user_sig_bbcode_uid] DEFAULT ('') FOR [user_sig_bbcode_uid],
	CONSTRAINT [DF_phpbb_users__user_from] DEFAULT ('') FOR [user_from],
	CONSTRAINT [DF_phpbb_users__user_icq] DEFAULT ('') FOR [user_icq],
	CONSTRAINT [DF_phpbb_users__user_aim] DEFAULT ('') FOR [user_aim],
	CONSTRAINT [DF_phpbb_users__user_yim] DEFAULT ('') FOR [user_yim],
	CONSTRAINT [DF_phpbb_users__user_msnm] DEFAULT ('') FOR [user_msnm],
	CONSTRAINT [DF_phpbb_users__user_jabber] DEFAULT ('') FOR [user_jabber],
	CONSTRAINT [DF_phpbb_users__user_website] DEFAULT ('') FOR [user_website],
	CONSTRAINT [DF_phpbb_users__user_occ] DEFAULT ('') FOR [user_occ],
	CONSTRAINT [DF_phpbb_users__user_interests] DEFAULT ('') FOR [user_interests],
	CONSTRAINT [DF_phpbb_users__user_actkey] DEFAULT ('') FOR [user_actkey],
	CONSTRAINT [DF_phpbb_users__user_newpasswd] DEFAULT ('') FOR [user_newpasswd]
GO

CREATE  INDEX [user_birthday] ON [phpbb_users]([user_birthday]) ON [PRIMARY]
GO

CREATE  INDEX [user_email_hash] ON [phpbb_users]([user_email_hash]) ON [PRIMARY]
GO

CREATE  INDEX [username] ON [phpbb_users]([username]) ON [PRIMARY]
GO


/*
 Table: phpbb_warnings
*/
CREATE TABLE [phpbb_warnings] (
	[warning_id] [int] IDENTITY (1, 1) NOT NULL ,
	[user_id] [int] NOT NULL ,
	[post_id] [int] NOT NULL ,
	[log_id] [int] NOT NULL ,
	[warning_time] [int] NOT NULL
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_warnings] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_warnings] PRIMARY KEY  CLUSTERED 
	(
		[warning_id]
	)  ON [PRIMARY] 
GO

ALTER TABLE [phpbb_warnings] WITH NOCHECK ADD
	CONSTRAINT [DF_phpbb_warnings__user_id] DEFAULT (0) FOR [user_id],
	CONSTRAINT [DF_phpbb_warnings__post_id] DEFAULT (0) FOR [post_id],
	CONSTRAINT [DF_phpbb_warnings__log_id] DEFAULT (0) FOR [log_id],
	CONSTRAINT [DF_phpbb_warnings__warning_time] DEFAULT (0) FOR [warning_time]
GO


/*
 Table: phpbb_words
*/
CREATE TABLE [phpbb_words] (
	[word_id] [int] IDENTITY (1, 1) NOT NULL ,
	[word] [varchar] (100) NOT NULL ,
	[replacement] [varchar] (100) NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_words] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_words] PRIMARY KEY  CLUSTERED 
	(
		[word_id]
	)  ON [PRIMARY] 
GO


/*
 Table: phpbb_zebra
*/
CREATE TABLE [phpbb_zebra] (
	[user_id] [int] NOT NULL ,
	[zebra_id] [int] NOT NULL ,
	[friend] [int] NOT NULL ,
	[foe] [int] NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_zebra] WITH NOCHECK ADD 
	CONSTRAINT [DF_phpbb_zebra__user_id] DEFAULT (0) FOR [user_id],
	CONSTRAINT [DF_phpbb_zebra__zebra_id] DEFAULT (0) FOR [zebra_id],
	CONSTRAINT [DF_phpbb_zebra__friend] DEFAULT (0) FOR [friend],
	CONSTRAINT [DF_phpbb_zebra__foe] DEFAULT (0) FOR [foe]
GO

CREATE  INDEX [user_id] ON [phpbb_zebra]([user_id]) ON [PRIMARY]
GO

CREATE  INDEX [zebra_id] ON [phpbb_zebra]([zebra_id]) ON [PRIMARY]
GO


COMMIT
GO
