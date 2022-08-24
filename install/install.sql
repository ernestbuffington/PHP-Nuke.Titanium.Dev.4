CREATE TABLE `network_bookmarks` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(256) NOT NULL,
  `category_id` int(11) NOT NULL DEFAULT 0,
  `url` varchar(256) NOT NULL,
  `description` varchar(256) DEFAULT NULL,
  `mod_date` date NOT NULL DEFAULT '0000-00-00',
  `popup` tinyint(3) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `network_bookmarks_cat` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(256) NOT NULL,
  `description` varchar(256) NOT NULL,
  `mod_date` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_admin_fc` (
  `fc_datetime` varchar(25) NOT NULL DEFAULT '',
  `fc_ip` varchar(255) NOT NULL DEFAULT '',
  `fc_attempts` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_authors` (
  `aid` varchar(25) NOT NULL DEFAULT '',
  `name` varchar(50) DEFAULT NULL,
  `url` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `pwd` varchar(40) DEFAULT NULL,
  `counter` int(11) NOT NULL DEFAULT 0,
  `radminsuper` tinyint(1) NOT NULL DEFAULT 1,
  `admlanguage` varchar(30) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_autonews` (
  `anid` int(10) UNSIGNED NOT NULL,
  `catid` int(11) NOT NULL DEFAULT 0,
  `aid` varchar(30) NOT NULL,
  `title` varchar(80) NOT NULL,
  `datePublished` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dateModified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `hometext` text NOT NULL,
  `bodytext` text NOT NULL,
  `topic` int(11) NOT NULL DEFAULT 1,
  `informant` varchar(40) NOT NULL,
  `notes` text NOT NULL,
  `ihome` tinyint(4) NOT NULL DEFAULT 0,
  `alanguage` varchar(30) NOT NULL,
  `acomm` tinyint(4) NOT NULL DEFAULT 0,
  `associated` text NOT NULL,
  `ticon` tinyint(1) NOT NULL DEFAULT 0,
  `writes` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_banner` (
  `bid` int(11) NOT NULL,
  `cid` int(11) NOT NULL DEFAULT 0,
  `name` varchar(50) NOT NULL DEFAULT '',
  `imptotal` int(11) NOT NULL DEFAULT 0,
  `impmade` int(11) NOT NULL DEFAULT 0,
  `clicks` int(11) NOT NULL DEFAULT 0,
  `imageurl` varchar(100) NOT NULL DEFAULT '',
  `clickurl` varchar(200) NOT NULL DEFAULT '',
  `alttext` varchar(255) NOT NULL DEFAULT '',
  `date` datetime DEFAULT NULL,
  `dateend` datetime DEFAULT NULL,
  `position` int(11) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `ad_class` varchar(5) NOT NULL DEFAULT '',
  `ad_code` text NOT NULL,
  `ad_width` int(11) DEFAULT 0,
  `ad_height` int(11) DEFAULT 0,
  `type` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_banner` (`bid`, `cid`, `name`, `imptotal`, `impmade`, `clicks`, `imageurl`, `clickurl`, `alttext`, `date`, `dateend`, `position`, `active`, `ad_class`, `ad_code`, `ad_width`, `ad_height`, `type`) VALUES
(4, 1, '86it', 0, 515357, 614, 'https://php-nuke-titanium.86it.us/images/banners/10.png', 'index.php', 'PHP-Nuke Titanium Dev 4', '2019-09-17 17:36:30', '0000-00-00 00:00:00', 0, 1, 'image', '', 472, 79, ''),
(5, 1, 'Xtreme', 0, 4532, 54, 'https://dev-php-nuke-evolution-xtreme.86it.us/themes/Xtreme_Core/images/HEADER/banner_02.png', 'index.php', 'PHP-Nuke Evolution Xtreme', '2021-05-28 02:54:43', '0000-00-00 00:00:00', 0, 0, 'image', '', 484, 79, '');

CREATE TABLE `nuke_banner_clients` (
  `cid` int(11) NOT NULL,
  `name` varchar(60) NOT NULL DEFAULT '',
  `contact` varchar(60) NOT NULL DEFAULT '',
  `email` varchar(60) NOT NULL DEFAULT '',
  `login` varchar(10) NOT NULL DEFAULT '',
  `passwd` varchar(10) NOT NULL DEFAULT '',
  `extrainfo` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_banner_clients` (`cid`, `name`, `contact`, `email`, `login`, `passwd`, `extrainfo`) VALUES
(1, 'TheGhost', 'Ernest Buffington', 'ernest.buffington@gmail.com', 'TheGhost', '28up4meoru', '');

CREATE TABLE `nuke_banner_plans` (
  `pid` int(10) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `delivery` varchar(10) NOT NULL DEFAULT '',
  `delivery_type` varchar(25) NOT NULL DEFAULT '',
  `price` varchar(25) NOT NULL DEFAULT '0',
  `buy_links` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_banner_positions` (
  `apid` int(10) NOT NULL,
  `position_number` int(5) NOT NULL DEFAULT 0,
  `position_name` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_banner_positions` (`apid`, `position_number`, `position_name`) VALUES
(1, 0, 'Page Top'),
(2, 1, 'Left Block'),
(3, 2, 'Page Bottom');

CREATE TABLE `nuke_banner_terms` (
  `terms_body` text NOT NULL,
  `country` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_banner_terms` (`terms_body`, `country`) VALUES
('<div align=\"justify\"><strong>Introduction:</strong> This Agreement between you and&nbsp;[sitename] consists of these Terms and Conditions. &quot;You&quot; or &quot;Advertiser&quot; means the entity identified in this enrollment form, and/or any agency acting on its behalf, which shall also be bound by the terms of this Agreement. Please read very carefully these Terms and Conditions.<br /><strong><br />Uses:</strong> You agree that your ads may be placed on (i) [sitename] web site and (ii) Any ads may be modified without your consent to comply with any policy of [sitename]. [sitename] reserves the right to, and in its sole discretion may, at any time review, reject, modify, or remove any ad. No liability of [sitename] and/or its owner(s) shall result from any such decision.<br /><br /></div><div align=\"justify\"><strong>Parties\' Responsibilities:</strong> You are responsible of your own site and/or service advertised in [sitename] web site. You are solely responsible for the advertising image creation, advertising text and for the content of your ads, including URL links. [sitename] is not responsible for anything regarding your Web site(s) including, but not limited to, maintenance of your Web site(s), order entry, customer service, payment processing, shipping, cancellations or returns.<br /><br /></div><div align=\"justify\"><strong>Impressions Count:</strong> Any hit to [sitename] web site is counted as an impression. Due to our advertising price we don\'t discriminate from users or automated robots. Even if you access to [sitename] web site and see your own banner ad it will be counted as a valid impression. Only in the case of [sitename] web site administrator, the impressions will not be counted.<br /><br /></div><div align=\"justify\"><strong>Termination, Cancellation:</strong> [sitename] may at any time, in its sole discretion, terminate the Campaign, terminate this Agreement, or cancel any ad(s) or your use of any Target. [sitename] will notify you via email of any such termination or cancellation, which shall be effective immediately. No refund will be made for any reason. Remaining impressions will be stored in a database and you\'ll be able to request another campaign to complete your inventory. You may cancel any ad and/or terminate this Agreement with or without cause at any time. Termination of your account shall be effective when [sitename] receives your notice via email. No refund will be made for any reason. Remaining impressions will be stored in a database for future uses by you and/or your company.<br /><br /></div><div align=\"justify\"><strong>Content:</strong> [sitename] web site doesn\'t accepts advertising that contains: (i) pornography, (ii) explicit adult content, (iii) moral questionable content, (iv) illegal content of any kind, (v) illegal drugs promotion, (vi) racism, (vii) politics content, (viii) religious content, and/or (ix) fraudulent suspicious content. If your advertising and/or target web site has any of this content and you purchased an advertising package, you\'ll not receive refund of any kind but your banners ads impressions will be stored for future use.<br /><br /></div><div align=\"justify\"><strong>Confidentiality:</strong> Each party agrees not to disclose Confidential Information of the other party without prior written consent except as provided herein. &quot;Confidential Information&quot; includes (i) ads, prior to publication, (ii) submissions or modifications relating to any advertising campaign, (iii) clickthrough rates or other statistics (except in an aggregated form that includes no identifiable information about you), and (iv) any other information designated in writing as &quot;Confidential.&quot; It does not include information that has become publicly known through no breach by a party, or has been (i) independently developed without access to the other party\'s Confidential Information; (ii) rightfully received from a third party; or (iii) required to be disclosed by law or by a governmental authority.<br /><br /></div><div align=\"justify\"><strong>No Guarantee:</strong> [sitename] makes no guarantee regarding the levels of clicks for any ad on its site. [sitename] may offer the same Target to more than one advertiser. You may not receive exclusivity unless special private contract between [sitename] and you.<br /><br /></div><div align=\"justify\"><strong>No Warranty:</strong> [sitename] MAKES NO WARRANTY, EXPRESS OR IMPLIED, INCLUDING WITHOUT LIMITATION WITH RESPECT TO ADVERTISING AND OTHER SERVICES, AND EXPRESSLY DISCLAIMS THE WARRANTIES OR CONDITIONS OF NONINFRINGEMENT, MERCHANTABILITY AND FITNESS FOR ANY PARTICULAR PURPOSE.<br /><br /></div><div align=\"justify\"><strong>Limitations of Liability:</strong> In no event shall [sitename] be liable for any act or omission, or any event directly or indirectly resulting from any act or omission of Advertiser, Partner, or any third parties (if any). EXCEPT FOR THE PARTIES\' INDEMNIFICATION AND CONFIDENTIALITY OBLIGATIONS HEREUNDER, (i) IN NO EVENT SHALL EITHER PARTY BE LIABLE UNDER THIS AGREEMENT FOR ANY CONSEQUENTIAL, SPECIAL, INDIRECT, EXEMPLARY, PUNITIVE, OR OTHER DAMAGES WHETHER IN CONTRACT, TORT OR ANY OTHER LEGAL THEORY, EVEN IF SUCH PARTY HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES AND NOTWITHSTANDING ANY FAILURE OF ESSENTIAL PURPOSE OF ANY LIMITED REMEDY AND (ii) [sitename] AGGREGATE LIABILITY TO ADVERTISER UNDER THIS AGREEMENT FOR ANY CLAIM IS LIMITED TO THE AMOUNT PAID TO [sitename] BY ADVERTISER FOR THE AD GIVING RISE TO THE CLAIM. Each party acknowledges that the other party has entered into this Agreement relying on the limitations of liability stated herein and that those limitations are an essential basis of the bargain between the parties. Without limiting the foregoing and except for payment obligations, neither party shall have any liability for any failure or delay resulting from any condition beyond the reasonable control of such party, including but not limited to governmental action or acts of terrorism, earthquake or other acts of God, labor conditions, and power failures.<br /><br /></div><div align=\"justify\"><strong>Payment:</strong> You agree to pay in advance the cost of the advertising. [sitename] will not setup any banner ads campaign(s) unless the payment process is complete. [sitename] may change its pricing at any time without prior notice. If you have an advertising campaign running and/or impressions stored for future use for any mentioned cause and [sitename] changes its pricing, you\'ll not need to pay any difference. Your purchased banners fee will remain the same. Charges shall be calculated solely based on records maintained by [sitename]. No other measurements or statistics of any kind shall be accepted by [sitename] or have any effect under this Agreement.<br /><br /></div><div align=\"justify\"><strong>Representations and Warranties:</strong> You represent and warrant that (a) all of the information provided by you to [sitename] to enroll in the Advertising Campaign is correct and current; (b) you hold all rights to permit [sitename] and any Partner(s) to use, reproduce, display, transmit and distribute your ad(s); and (c) [sitename] and any Partner(s) Use, your Target(s), and any site(s) linked to, and products or services to which users are directed, will not, in any state or country where the ad is displayed (i) violate any criminal laws or third party rights giving rise to civil liability, including but not limited to trademark rights or rights relating to the performance of music; or (ii) encourage conduct that would violate any criminal or civil law. You further represent and warrant that any Web site linked to your ad(s) (i) complies with all laws and regulations in any state or country where the ad is displayed; (ii) does not breach and has not breached any duty toward or rights of any person or entity including, without limitation, rights of publicity or privacy, or rights or duties under consumer protection, product liability, tort, or contract theories; and (iii) is not false, misleading, defamatory, libelous, slanderous or threatening.<br /><br /></div><div align=\"justify\"><strong>Your Obligation to Indemnify:</strong> You agree to indemnify, defend and hold [sitename], its agents, affiliates, subsidiaries, directors, officers, employees, and applicable third parties (e.g., all relevant Partner(s), licensors, licensees, consultants and contractors) (&quot;Indemnified Person(s)&quot;) harmless from and against any and all third party claims, liability, loss, and expense (including damage awards, settlement amounts, and reasonable legal fees), brought against any Indemnified Person(s), arising out of, related to or which may arise from your use of the Advertising Program, your Web site, and/or your breach of any term of this Agreement. Customer understands and agrees that each Partner, as defined herein, has the right to assert and enforce its rights under this Section directly on its own behalf as a third party beneficiary.<br /><br /></div><div align=\"justify\"><strong>Information Rights:</strong> [sitename] may retain and use for its own purposes all information you provide, including but not limited to Targets, URLs, the content of ads, and contact and billing information. [sitename] may share this information about you with business partners and/or sponsors. [sitename] will not sell your information. Your name, web site\'s URL and related graphics shall be used by [sitename] in its own web site at any time as a sample to the public, even if your Advertising Campaign has been finished.<br /><br /></div><div align=\"justify\"><strong>Miscellaneous:</strong> Any decision made by [sitename] under this Agreement shall be final. [sitename] shall have no liability for any such decision. You will be responsible for all reasonable expenses (including attorneys\' fees) incurred by [sitename] in collecting unpaid amounts under this Agreement. This Agreement shall be governed by the laws of [country]. Any dispute or claim arising out of or in connection with this Agreement shall be adjudicated in [country]. This constitutes the entire agreement between the parties with respect to the subject matter hereof. Advertiser may not resell, assign, or transfer any of its rights hereunder. Any such attempt may result in termination of this Agreement, without liability to [sitename] and without any refund. The relationship(s) between [sitename] and the &quot;Partners&quot; is not one of a legal partnership relationship, but is one of independent contractors. This Agreement shall be construed as if both parties jointly wrote it.</div>', 'Canada');

CREATE TABLE `nuke_bbadvanced_username_color` (
  `group_id` int(10) UNSIGNED NOT NULL,
  `group_name` varchar(255) NOT NULL DEFAULT '',
  `group_color` varchar(6) NOT NULL DEFAULT '',
  `group_weight` smallint(2) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_bbadvanced_username_color` (`group_id`, `group_name`, `group_color`, `group_weight`) VALUES
(1, 'Portal Admins', 'ff632a', 1),
(2, 'Portal Moderators', 'd38d01', 2),
(3, 'VIP Members', '00aa00', 3),
(4, 'Portal Members', '00b3ff', 4),
(5, 'CKEditor 4 Access', 'bf0000', 5);

CREATE TABLE `nuke_bbarcade` (
  `arcade_name` varchar(255) NOT NULL DEFAULT '',
  `arcade_value` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_bbarcade` (`arcade_name`, `arcade_value`) VALUES
('use_category_mod', '1'),
('category_preview_games', '5'),
('games_par_page', '15'),
('game_order', 'Alpha'),
('display_winner_avatar', '1'),
('stat_par_page', '10'),
('winner_avatar_position', 'left'),
('maxsize_avatar', '200'),
('linkcat_align', '2'),
('limit_by_posts', '0'),
('posts_needed', '5'),
('days_limit', '5'),
('limit_type', 'date'),
('use_fav_category', '1'),
('arcade_announcement', 'Welcome to the Arcade!<br />Enjoy!');

CREATE TABLE `nuke_bbarcade_categories` (
  `arcade_catid` mediumint(8) UNSIGNED NOT NULL,
  `arcade_cattitle` varchar(100) NOT NULL DEFAULT '',
  `arcade_nbelmt` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `arcade_catorder` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `arcade_catauth` tinyint(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_bbarcade_categories` (`arcade_catid`, `arcade_cattitle`, `arcade_nbelmt`, `arcade_catorder`, `arcade_catauth`) VALUES
(1, 'Arcade', 1, 1, 0);

CREATE TABLE `nuke_bbarcade_comments` (
  `game_id` mediumint(8) NOT NULL DEFAULT 0,
  `comments_value` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_bbarcade_comments` (`game_id`, `comments_value`) VALUES
(1, '');

CREATE TABLE `nuke_bbarcade_fav` (
  `order` mediumint(8) NOT NULL DEFAULT 0,
  `user_id` mediumint(8) NOT NULL DEFAULT 0,
  `game_id` mediumint(8) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_bbattachments` (
  `attach_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `post_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `privmsgs_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `user_id_1` mediumint(8) NOT NULL DEFAULT 0,
  `user_id_2` mediumint(8) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_bbattachments_config` (
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_bbattachments_config` (`config_name`, `config_value`) VALUES
('upload_dir', 'modules/Forums/files'),
('upload_img', 'modules/Forums/images/attachment-download.png'),
('topic_icon', 'modules/Forums/images/attachment.png'),
('display_order', '0'),
('max_filesize', '104857600'),
('attachment_quota', '1048576000'),
('max_filesize_pm', '1024000'),
('max_attachments', '10'),
('max_attachments_pm', '10'),
('disable_mod', '0'),
('allow_pm_attach', '1'),
('attachment_topic_review', '1'),
('allow_ftp_upload', '0'),
('show_apcp', '0'),
('attach_version', '2.4.5'),
('default_upload_quota', '0'),
('default_pm_quota', '0'),
('ftp_server', 'ftp.yoursite.com'),
('ftp_path', '/public_html/modules/Forums/files'),
('download_path', 'http://www.yoursite.com/modules/Forums/files'),
('ftp_user', ''),
('ftp_pass', ''),
('ftp_pasv_mode', '1'),
('img_display_inlined', '1'),
('img_max_width', '0'),
('img_max_height', '0'),
('img_link_width', '0'),
('img_link_height', '0'),
('img_create_thumbnail', '1'),
('img_min_thumb_filesize', '12000'),
('img_imagick', '/usr/bin/convert'),
('use_gd2', '0'),
('wma_autoplay', '0'),
('flash_autoplay', '0');

CREATE TABLE `nuke_bbattachments_desc` (
  `attach_id` mediumint(8) UNSIGNED NOT NULL,
  `physical_filename` varchar(255) NOT NULL DEFAULT '',
  `real_filename` varchar(255) NOT NULL DEFAULT '',
  `download_count` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `comment` varchar(255) DEFAULT NULL,
  `extension` varchar(100) DEFAULT NULL,
  `mimetype` varchar(100) DEFAULT NULL,
  `filesize` int(20) NOT NULL DEFAULT 0,
  `filetime` int(11) NOT NULL DEFAULT 0,
  `thumbnail` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_bbattach_quota` (
  `user_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `group_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `quota_type` smallint(2) NOT NULL DEFAULT 0,
  `quota_limit_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_bbauth_access` (
  `group_id` mediumint(8) NOT NULL DEFAULT 0,
  `forum_id` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `auth_view` tinyint(1) NOT NULL DEFAULT 0,
  `auth_read` tinyint(1) NOT NULL DEFAULT 0,
  `auth_post` tinyint(1) NOT NULL DEFAULT 0,
  `auth_reply` tinyint(1) NOT NULL DEFAULT 0,
  `auth_edit` tinyint(1) NOT NULL DEFAULT 0,
  `auth_delete` tinyint(1) NOT NULL DEFAULT 0,
  `auth_sticky` tinyint(1) NOT NULL DEFAULT 0,
  `auth_announce` tinyint(1) NOT NULL DEFAULT 0,
  `auth_globalannounce` tinyint(1) NOT NULL DEFAULT 0,
  `auth_vote` tinyint(1) NOT NULL DEFAULT 0,
  `auth_pollcreate` tinyint(1) NOT NULL DEFAULT 0,
  `auth_attachments` tinyint(1) NOT NULL DEFAULT 0,
  `auth_mod` tinyint(1) NOT NULL DEFAULT 0,
  `auth_download` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_bbauth_arcade_access` (
  `group_id` mediumint(8) NOT NULL DEFAULT 0,
  `arcade_catid` mediumint(8) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_bbbanlist` (
  `ban_id` mediumint(8) UNSIGNED NOT NULL,
  `ban_userid` mediumint(8) NOT NULL DEFAULT 0,
  `ban_ip` varchar(8) NOT NULL DEFAULT '',
  `ban_email` varchar(255) DEFAULT NULL,
  `ban_time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_bbcategories` (
  `cat_id` mediumint(8) UNSIGNED NOT NULL,
  `cat_title` varchar(100) DEFAULT NULL,
  `cat_order` mediumint(8) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_bbconfig` (
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_bbconfig` (`config_name`, `config_value`) VALUES
('config_id', '1'),
('board_disable', '0'),
('board_disable_adminview', '1'),
('board_disable_msg', 'The board is currently disabled...'),
('sitename', 'http://yourdomainname.com'),
('site_desc', 'Your Forum Dezscription'),
('cookie_name', 'titanium'),
('cookie_path', '/'),
('cookie_domain', 'yourdomainname.com'),
('cookie_secure', '0'),
('session_length', '3600'),
('allow_html', '1'),
('allow_html_tags', 'a,abbr,address,area,article,aside,audio,b,base,bdi,bdo,blockquote,br,button,canvas,caption,cite,code,col,colgroup,data,datalist,dd,del,em,strong,embed,fieldset,figure,footer,form,h1,h2,h3,h4,h5,h6,hgroup,hr,i,iframe,img,input,ins,kbd,keygen,label,legend,li,link,main,map,mark,menu,menuitem,meter,nav,noscript,object,ol,optgroup,option,output,p,param,pre,progress,1,rb,rt,rtc,ruby,s,samp,script,section,select,small,source,span,strong,style,sub,summary,sup,table,tbody,td,template,textarea,tfoot,th,thead,time,title,tr,track,u,ul,var,video,wbr,b,p'),
('allow_bbcode', '1'),
('allow_smilies', '1'),
('allow_sig', '1'),
('allow_namechange', '1'),
('allow_theme_create', '0'),
('allow_avatar_local', '1'),
('allow_avatar_remote', '1'),
('allow_avatar_upload', '1'),
('override_user_style', '1'),
('posts_per_page', '15'),
('topics_per_page', '50'),
('hot_threshold', '25'),
('max_poll_options', '10'),
('max_sig_chars', '255'),
('max_smilies', '15'),
('max_inbox_privmsgs', '1000'),
('max_sentbox_privmsgs', '1000'),
('max_savebox_privmsgs', '1000'),
('board_email_sig', 'Thanks, webmaster@yourdomain.com'),
('board_email', 'webmaster@yourdomain.com'),
('smtp_delivery', '0'),
('smtp_host', ''),
('require_activation', '0'),
('flood_interval', '15'),
('search_flood_interval', '15'),
('board_email_form', '0'),
('avatar_filesize', '980000'),
('avatar_max_width', '200'),
('avatar_max_height', '200'),
('avatar_path', 'modules/Forums/images/avatars'),
('avatar_gallery_path', 'modules/Forums/images/avatars'),
('smilies_path', 'modules/Forums/images/smiles'),
('default_style', '1'),
('default_dateformat', 'D M d, Y g:i a'),
('board_timezone', '-5'),
('prune_enable', '0'),
('privmsg_disable', '0'),
('gzip_compress', '0'),
('coppa_fax', ''),
('coppa_mail', ''),
('board_startdate', '1131089812'),
('default_lang', 'english'),
('smtp_username', ''),
('smtp_password', ''),
('record_online_users', ''),
('record_online_date', '1620385879'),
('server_name', 'yourdomain.com'),
('server_port', '80'),
('script_path', '/modules/Forums/'),
('version', '.0.23'),
('enable_confirm', '0'),
('sendmail_fix', '0'),
('sig_max_lines', '5'),
('sig_wordwrap', '100'),
('sig_allow_font_sizes', '1'),
('sig_min_font_size', '7'),
('sig_max_font_size', '12'),
('sig_allow_bold', '1'),
('sig_allow_italic', '1'),
('sig_allow_underline', '1'),
('sig_allow_colors', '1'),
('sig_allow_quote', '0'),
('sig_allow_code', '0'),
('sig_allow_list', '0'),
('sig_allow_url', '1'),
('sig_allow_images', '1'),
('sig_max_images', '0'),
('sig_max_img_height', '75'),
('sig_max_img_width', '500'),
('sig_allow_on_max_img_size_fail', '0'),
('sig_max_img_files_size', '10'),
('sig_max_img_av_files_size', '0'),
('sig_exotic_bbcodes_disallowed', ''),
('sig_allow_smilies', '1'),
('report_email', '1'),
('ropm_quick_reply', '0'),
('ropm_quick_reply_bbc', '1'),
('ropm_quick_reply_smilies', '22'),
('wrap_enable', '1'),
('wrap_min', '50'),
('wrap_max', '99'),
('wrap_def', '70'),
('allow_quickreply', '0'),
('anonymous_show_sqr', '0'),
('anonymous_sqr_mode', '1'),
('quick_search_enable', '1'),
('sig_line', ''),
('default_avatar_guests_url', 'modules/Forums/images/avatars/blank.png'),
('default_avatar_users_url', 'modules/Forums/images/avatars/blank.png'),
('default_avatar_set', '2'),
('pm_allow_threshold', '0'),
('welcome_pm', '0'),
('default_time_mode', '6'),
('default_dst_time_lag', '60'),
('glance_show', '2'),
('glance_show_override', '1'),
('glance_news_id', '0'),
('glance_num_news', '0'),
('glance_num', '6'),
('glance_ignore_forums', '0'),
('glance_table_width', '100%'),
('glance_auth_read', '1'),
('glance_topic_length', '0'),
('online_time', '600'),
('display_users_today', '0'),
('locked_view_open', 'Locked:'),
('locked_view_close', ''),
('global_view_open', 'Global Announcement:'),
('global_view_close', ''),
('announce_view_open', 'Announcement:'),
('announce_view_close', ''),
('sticky_view_open', 'Sticky:'),
('sticky_view_close', ''),
('moved_view_open', 'Moved:'),
('moved_view_close', ''),
('initial_group_id', '3'),
('hide_links', '0'),
('hide_emails', '0'),
('hide_images', '0'),
('use_dhtml', '1'),
('anonymous_open_sqr', '0'),
('smilies_in_titles', '1'),
('show_edited_logs', '1'),
('show_locked_logs', '1'),
('show_unlocked_logs', '1'),
('show_splitted_logs', '1'),
('show_moved_logs', '1'),
('logs_view_level', '2'),
('aprvmArchive', '0'),
('aprvmVersion', '1.6.0'),
('aprvmView', '0'),
('aprvmRows', '25'),
('aprvmIP', '1'),
('image_resize_width', '640'),
('image_resize_height', '480'),
('use_theme_style', '1'),
('allow_autologin', '1'),
('max_autologin_time', '0'),
('max_login_attempts', '5'),
('login_reset_time', '30'),
('show_sig_once', '0'),
('show_avatar_once', '0'),
('show_rank_once', '0'),
('loginpage', '1'),
('rand_seed', '0acdc9ed02fbae0fe28408329ffb7c9d'),
('ftr_msg', 'Sorry *u*, you need to read our topic: \"*t*\" for new users. <br> After you read it, you can proceed to browse our posts normally. <br><br> Please click *l* to view the post.'),
('ftr_topic', '3'),
('ftr_active', '0'),
('ftr_who', '2'),
('ftr_installed', '1241642769'),
('global_title', 'yourdomain.com'),
('global_announcement', 'PHP-Nuke Titanium brings you a 30 year old CMS revived!'),
('global_enable', '1'),
('marquee_disable', '0'),
('version_check_delay', '1241641548'),
('bday_show', '1'),
('bday_require', '0'),
('bday_year', '0'),
('bday_lock', '0'),
('bday_lookahead', '30'),
('bday_max', '150'),
('bday_min', '5'),
('bday_hide', '0'),
('bday_greeting', '3'),
('icon_per_row', '10'),
('ad_after_post', ''),
('ad_post_threshold', '1'),
('ad_every_post', '2'),
('ad_who', '1'),
('ad_no_forums', ''),
('ad_no_groups', ''),
('ad_old_style', '0'),
('xs_auto_compile', '1'),
('xs_auto_recompile', '1'),
('xs_use_cache', '1'),
('xs_php', 'php'),
('xs_def_template', 'subSilver'),
('xs_check_switches', '1'),
('xs_warn_includes', '1'),
('xs_add_comments', '0'),
('xs_ftp_host', ''),
('xs_ftp_login', ''),
('xs_ftp_path', ''),
('xs_downloads_count', '0'),
('xs_downloads_default', '0'),
('xs_shownav', '1'),
('xs_template_time', '1532797163'),
('xs_version', '8'),
('last_post_avatar', '1'),
('youtube_width', '640'),
('youtube_height', '360'),
('twitch_width', '640'),
('twitch_height', '360'),
('facebook_width', '640'),
('facebook_height', '360'),
('welcome_pm_username', '0'),
('glance_rowclass', '0'),
('smtp_encryption', 'none'),
('smtp_port', ''),
('smtp_auth', '0');

CREATE TABLE `nuke_bbdisallow` (
  `disallow_id` mediumint(8) UNSIGNED NOT NULL,
  `disallow_username` varchar(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_bbextensions` (
  `ext_id` mediumint(8) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `extension` varchar(100) NOT NULL DEFAULT '',
  `comment` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_bbextensions` (`ext_id`, `group_id`, `extension`, `comment`) VALUES
(1, 1, 'gif', ''),
(2, 1, 'png', ''),
(3, 1, 'jpeg', ''),
(4, 1, 'jpg', ''),
(5, 1, 'tif', ''),
(6, 1, 'tga', ''),
(7, 2, 'gtar', ''),
(8, 2, 'gz', ''),
(9, 2, 'tar', ''),
(10, 2, 'zip', ''),
(11, 2, 'rar', ''),
(12, 2, 'ace', ''),
(13, 3, 'txt', ''),
(14, 3, 'c', ''),
(15, 3, 'h', ''),
(16, 3, 'cpp', ''),
(17, 3, 'hpp', ''),
(18, 3, 'diz', ''),
(19, 4, 'xls', ''),
(20, 4, 'doc', ''),
(21, 4, 'dot', ''),
(22, 4, 'pdf', ''),
(23, 4, 'ai', ''),
(24, 4, 'ps', ''),
(25, 4, 'ppt', ''),
(26, 5, 'rm', ''),
(27, 6, 'wma', ''),
(28, 7, 'swf', ''),
(29, 2, 'iso', '');

CREATE TABLE `nuke_bbextension_groups` (
  `group_id` mediumint(8) NOT NULL,
  `group_name` varchar(20) NOT NULL DEFAULT '',
  `cat_id` tinyint(2) NOT NULL DEFAULT 0,
  `allow_group` tinyint(1) NOT NULL DEFAULT 0,
  `download_mode` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `upload_icon` varchar(100) DEFAULT '',
  `max_filesize` int(20) NOT NULL DEFAULT 0,
  `forum_permissions` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_bbextension_groups` (`group_id`, `group_name`, `cat_id`, `allow_group`, `download_mode`, `upload_icon`, `max_filesize`, `forum_permissions`) VALUES
(1, 'Images', 1, 1, 2, '', 104857600, ''),
(2, 'Archives', 0, 1, 2, '', 104857600, ''),
(3, 'Plain Text', 0, 0, 2, '', 104857600, ''),
(4, 'Documents', 0, 0, 2, '', 104857600, ''),
(5, 'Real Media', 0, 0, 2, '', 104857600, ''),
(6, 'Streams', 2, 0, 2, '', 104857600, ''),
(7, 'Flash Files', 3, 0, 2, '', 104857600, '');

CREATE TABLE `nuke_bbflags` (
  `flag_id` int(10) NOT NULL,
  `flag_name` varchar(50) DEFAULT NULL,
  `flag_image` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `nuke_bbflags` (`flag_id`, `flag_name`, `flag_image`) VALUES
(1, 'usa', 'usa.png'),
(2, 'afghanistan', 'afghanistan.png'),
(3, 'albania', 'albania.png'),
(4, 'algeria', 'algeria.png'),
(5, 'andorra', 'andorra.png'),
(6, 'antigua and barbuda', 'antigua_and_barbuda.png'),
(7, 'argentina', 'argentina.png'),
(8, 'armenia', 'armenia.png'),
(9, 'australia', 'australia.png'),
(10, 'austria', 'austria.png'),
(11, 'azerbaijan', 'azerbaijan.png'),
(12, 'bahamas', 'bahamas.png'),
(13, 'bahrain', 'bahrain.png'),
(14, 'bangladesh', 'bangladesh.png'),
(15, 'barbados', 'barbados.png'),
(16, 'belarus', 'belarus.png'),
(17, 'belgium', 'belgium.png'),
(18, 'belize', 'belize.png'),
(19, 'benin', 'benin.png'),
(20, 'bhutan', 'bhutan.png'),
(21, 'bolivia', 'bolivia.png'),
(22, 'bosnia and herzegovina', 'bosnia_and_herzegovina.png'),
(23, 'botswana', 'botswana.png'),
(24, 'brazil', 'brazil.png'),
(25, 'brunei', 'brunei.png'),
(26, 'bulgaria', 'bulgaria.png'),
(27, 'burkina faso', 'burkina_faso.png'),
(28, 'myanmar', 'myanmar.png'),
(29, 'burundi', 'burundi.png'),
(30, 'cambodia', 'cambodia.png'),
(31, 'cameroon', 'cameroon.png'),
(32, 'canada', 'canada.png'),
(33, 'chad', 'chad.png'),
(34, 'chile', 'chile.png'),
(35, 'china', 'china.png'),
(36, 'columbia', 'columbia.png'),
(37, 'comoros', 'comoros.png'),
(38, 'democratic republic of the congo', 'democratic_republic_of_the_congo.png'),
(39, 'croatia', 'croatia.png'),
(40, 'cuba', 'cuba.png'),
(41, 'cyprus', 'cyprus.png'),
(42, 'denmark', 'denmark.png'),
(43, 'djibouti', 'djibouti.png'),
(44, 'dominica', 'dominica.png'),
(45, 'dominican republic', 'dominican_republic.png'),
(46, 'ecuador', 'ecuador.png'),
(47, 'egypt', 'egypt.png'),
(48, 'el salvador', 'el_salvador.png'),
(49, 'england', 'england.png'),
(50, 'equatorial guinea', 'equatorial_guinea.png'),
(51, 'eritrea', 'eritrea.png'),
(52, 'estonia', 'estonia.png'),
(53, 'ethiopia', 'ethiopia.png'),
(54, 'fiji', 'fiji.png'),
(55, 'finland', 'finland.png'),
(56, 'france', 'france.png'),
(57, 'gabon', 'gabon.png'),
(58, 'gambia', 'gambia.png'),
(59, 'georgia', 'georgia.png'),
(60, 'germany', 'germany.png'),
(61, 'ghana', 'ghana.png'),
(62, 'greece', 'greece.png'),
(63, 'grenada', 'grenada.png'),
(64, 'saint vincent and the grenadines', 'saint_vincent_and_the_grenadines.png'),
(65, 'guatemala', 'guatemala.png'),
(66, 'guinea', 'guinea.png'),
(67, 'guyana', 'guyana.png'),
(68, 'haiti', 'haiti.png'),
(69, 'honduras', 'honduras.png'),
(70, 'hong kong', 'hong_kong.png'),
(71, 'hungary', 'hungary.png'),
(72, 'iceland', 'iceland.png'),
(73, 'india', 'india.png'),
(74, 'indonesia', 'indonesia.png'),
(75, 'iran', 'iran.png'),
(76, 'iraq', 'iraq.png'),
(77, 'ireland', 'ireland.png'),
(78, 'israel', 'israel.png'),
(79, 'italy', 'italy.png'),
(80, 'jamaica', 'jamaica.png'),
(81, 'japan', 'japan.png'),
(82, 'jordan', 'jordan.png'),
(83, 'kazakhstan', 'kazakhstan.png'),
(84, 'kenya', 'kenya.png'),
(85, 'kiribati', 'kiribati.png'),
(86, 'kuwait', 'kuwait.png'),
(87, 'kyrgyzstan', 'kyrgyzstan.png'),
(88, 'laos', 'laos.png'),
(89, 'latvia', 'latvia.png'),
(90, 'lebanon', 'lebanon.png'),
(91, 'liberia', 'liberia.png'),
(92, 'libya', 'libya.png'),
(93, 'liechtenstein', 'liechtenstein.png'),
(94, 'lithuania', 'lithuania.png'),
(95, 'luxembourg', 'luxembourg.png'),
(96, 'macau', 'macau.png'),
(97, 'madagascar', 'madagascar.png'),
(98, 'malawi', 'malawi.png'),
(99, 'malaysia', 'malaysia.png'),
(100, 'maldives', 'maldives.png'),
(101, 'mali', 'mali.png'),
(102, 'malta', 'malta.png'),
(103, 'mauritania', 'mauritania.png'),
(104, 'mauritius', 'mauritius.png'),
(105, 'mexico', 'mexico.png'),
(106, 'micronesia', 'micronesia.png'),
(107, 'moldova', 'moldova.png'),
(108, 'monaco', 'monaco.png'),
(109, 'mongolia', 'mongolia.png'),
(110, 'morocco', 'morocco.png'),
(111, 'mozambique', 'mozambique.png'),
(112, 'namibia', 'namibia.png'),
(113, 'nauru', 'nauru.png'),
(114, 'nepal', 'nepal.png'),
(115, 'netherlands', 'netherlands.png'),
(116, 'nicaragua', 'nicaragua.png'),
(117, 'niger', 'niger.png'),
(118, 'nigeria', 'nigeria.png'),
(119, 'norway', 'norway.png'),
(120, 'oman', 'oman.png'),
(121, 'pakistan', 'pakistan.png'),
(122, 'panama', 'panama.png'),
(123, 'paraguay', 'paraguay.png'),
(124, 'peru', 'peru.png'),
(125, 'philippines', 'philippines.png'),
(126, 'poland', 'poland.png'),
(127, 'portugal', 'portugal.png'),
(128, 'qatar', 'qatar.png'),
(129, 'romania', 'romania.png'),
(130, 'russia', 'russia.png'),
(131, 'sao tome and principe', 'sao_tome_and_principe.png'),
(132, 'senegal', 'senegal.png'),
(133, 'serbia', 'serbia.png'),
(134, 'seychelles', 'seychelles.png'),
(135, 'sierra leone', 'sierra_leone.png'),
(136, 'singapore', 'singapore.png'),
(137, 'slovakia', 'slovakia.png'),
(138, 'slovenia', 'slovenia.png'),
(139, 'solomon islands', 'solomon_islands.png'),
(140, 'somalia', 'somalia.png'),
(141, 'south_korea', 'south_korea.png'),
(142, 'spain', 'spain.png'),
(143, 'saint kitts and nevis', 'saint_kitts_and_nevis.png'),
(144, 'saint lucia', 'saint_lucia.png'),
(145, 'sudan', 'sudan.png'),
(146, 'suriname', 'suriname.png'),
(147, 'sweden', 'sweden.png'),
(148, 'switzerland', 'switzerland.png'),
(149, 'syria', 'syria.png'),
(150, 'taiwan', 'taiwan.png'),
(151, 'tajikistan', 'tajikistan.png'),
(152, 'tanzania', 'tanzania.png'),
(153, 'thailand', 'thailand.png'),
(154, 'togo', 'togo.png'),
(155, 'tonga', 'tonga.png'),
(156, 'tunisia', 'tunisia.png'),
(157, 'turkey', 'turkey.png'),
(158, 'turkmenistan', 'turkmenistan.png'),
(159, 'tuvalu', 'tuvalu.png'),
(160, 'uganda', 'uganda.png'),
(161, 'uk', 'uk.png'),
(162, 'ukraine', 'ukraine.png'),
(163, 'uruguay', 'uruguay.png'),
(164, 'uzbekistan', 'uzbekistan.png'),
(165, 'vanuatu', 'vanuatu.png'),
(166, 'venezuela', 'venezuela.png'),
(167, 'vietnam', 'vietnam.png'),
(168, 'western samoa', 'western_samoa.png'),
(169, 'yemen', 'yemen.png'),
(170, 'yugoslavia', 'yugoslavia.png'),
(171, 'zambia', 'zambia.png'),
(172, 'zimbabwe', 'zimbabwe.png');

CREATE TABLE `nuke_bbforbidden_extensions` (
  `ext_id` mediumint(8) UNSIGNED NOT NULL,
  `extension` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_bbforbidden_extensions` (`ext_id`, `extension`) VALUES
(1, 'php'),
(2, 'php3'),
(3, 'php4'),
(4, 'phtml'),
(5, 'pl'),
(6, 'asp'),
(7, 'cgi'),
(8, 'com'),
(9, 'bat'),
(10, 'scr');

CREATE TABLE `nuke_bbforums` (
  `forum_id` smallint(5) UNSIGNED NOT NULL,
  `cat_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `forum_name` varchar(150) DEFAULT NULL,
  `forum_desc` text DEFAULT NULL,
  `forum_status` tinyint(4) NOT NULL DEFAULT 0,
  `forum_order` mediumint(8) UNSIGNED NOT NULL DEFAULT 1,
  `forum_posts` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `forum_topics` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `forum_last_post_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `prune_next` int(11) DEFAULT NULL,
  `prune_enable` tinyint(1) NOT NULL DEFAULT 1,
  `auth_view` tinyint(2) NOT NULL DEFAULT 0,
  `auth_read` tinyint(2) NOT NULL DEFAULT 0,
  `auth_post` tinyint(2) NOT NULL DEFAULT 0,
  `auth_reply` tinyint(2) NOT NULL DEFAULT 0,
  `auth_edit` tinyint(2) NOT NULL DEFAULT 0,
  `auth_delete` tinyint(2) NOT NULL DEFAULT 0,
  `auth_sticky` tinyint(2) NOT NULL DEFAULT 0,
  `auth_announce` tinyint(2) NOT NULL DEFAULT 0,
  `auth_globalannounce` tinyint(2) NOT NULL DEFAULT 3,
  `auth_vote` tinyint(2) NOT NULL DEFAULT 0,
  `auth_pollcreate` tinyint(2) NOT NULL DEFAULT 0,
  `auth_attachments` tinyint(2) NOT NULL DEFAULT 0,
  `forum_display_sort` tinyint(1) NOT NULL DEFAULT 0,
  `forum_display_order` tinyint(1) NOT NULL DEFAULT 0,
  `auth_download` tinyint(2) NOT NULL DEFAULT 0,
  `forum_parent` int(11) NOT NULL DEFAULT 0,
  `forum_color` varchar(6) NOT NULL DEFAULT '',
  `title_is_link` tinyint(1) NOT NULL DEFAULT 0,
  `weblink` varchar(200) NOT NULL,
  `forum_link_icon` varchar(200) NOT NULL,
  `forum_link_count` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `forum_link_target` tinyint(1) NOT NULL DEFAULT 0,
  `forum_icon` varchar(255) DEFAULT NULL,
  `forum_thank` tinyint(1) NOT NULL DEFAULT 0,
  `forum_password` varchar(20) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_bbforum_prune` (
  `prune_id` mediumint(8) UNSIGNED NOT NULL,
  `forum_id` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `prune_days` tinyint(4) UNSIGNED NOT NULL DEFAULT 0,
  `prune_freq` tinyint(4) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_bbgamehash` (
  `gamehash_id` char(32) NOT NULL,
  `game_id` mediumint(8) NOT NULL,
  `user_id` mediumint(8) NOT NULL,
  `hash_date` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_bbgames` (
  `game_id` mediumint(8) NOT NULL,
  `game_pic` varchar(50) NOT NULL DEFAULT '',
  `game_desc` varchar(255) NOT NULL DEFAULT '',
  `game_highscore` int(11) NOT NULL DEFAULT 0,
  `game_highdate` int(11) NOT NULL DEFAULT 0,
  `game_highuser` mediumint(8) NOT NULL DEFAULT 0,
  `game_name` varchar(50) NOT NULL DEFAULT '',
  `game_swf` varchar(50) NOT NULL DEFAULT '',
  `game_scorevar` varchar(50) NOT NULL DEFAULT '',
  `game_type` tinyint(4) NOT NULL DEFAULT 0,
  `game_width` mediumint(5) NOT NULL DEFAULT 550,
  `game_height` varchar(5) NOT NULL DEFAULT '380',
  `game_order` mediumint(8) NOT NULL DEFAULT 0,
  `game_set` mediumint(8) NOT NULL DEFAULT 0,
  `arcade_catid` mediumint(8) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_bbgroups` (
  `group_id` mediumint(8) NOT NULL,
  `group_type` tinyint(4) NOT NULL DEFAULT 1,
  `group_name` varchar(40) NOT NULL DEFAULT '',
  `group_description` varchar(255) NOT NULL DEFAULT '',
  `group_moderator` mediumint(8) NOT NULL DEFAULT 0,
  `group_single_user` tinyint(1) NOT NULL DEFAULT 1,
  `group_allow_pm` tinyint(2) NOT NULL DEFAULT 5,
  `group_color` varchar(15) NOT NULL DEFAULT '',
  `group_rank` varchar(5) NOT NULL DEFAULT '0',
  `max_inbox` mediumint(10) NOT NULL DEFAULT 100,
  `max_sentbox` mediumint(10) NOT NULL DEFAULT 100,
  `max_savebox` mediumint(10) NOT NULL DEFAULT 100,
  `override_max_inbox` tinyint(1) NOT NULL DEFAULT 0,
  `override_max_sentbox` tinyint(1) NOT NULL DEFAULT 0,
  `override_max_savebox` tinyint(1) NOT NULL DEFAULT 0,
  `group_count` int(4) UNSIGNED DEFAULT 99999999,
  `group_count_max` int(4) UNSIGNED DEFAULT 99999999,
  `group_count_enable` smallint(2) UNSIGNED DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_bbgroups` (`group_id`, `group_type`, `group_name`, `group_description`, `group_moderator`, `group_single_user`, `group_allow_pm`, `group_color`, `group_rank`, `max_inbox`, `max_sentbox`, `max_savebox`, `override_max_inbox`, `override_max_sentbox`, `override_max_savebox`, `group_count`, `group_count_max`, `group_count_enable`) VALUES
(1, 1, 'Anonymous', 'Personal User', 0, 1, 0, '', '', 0, 0, 0, 0, 0, 0, 99999999, 99999999, 0),
(2, 2, 'Portal Moderators', 'Portal Moderators', 2, 0, 5, '2', '2', 0, 0, 0, 0, 0, 0, 99999999, 99999999, 0),
(3, 0, 'Portal Members', 'Default Portal Usergroup', 2, 0, 5, '4', '6', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 0, 'VIP Members', 'VIP Portal Members', 2, 0, 5, '3', '7', 100000, 100000, 100000, 0, 0, 0, 99999999, 99999999, 0),
(5, 0, 'Portal Admins', 'Portal Admins', 2, 0, 5, '1', '4', 100000, 100000, 100000, 1, 1, 1, 99999999, 99999999, 0),
(25, 0, 'CKEditor 4 Access', 'CKEditor 4 Access', 2, 0, 5, '5', '0', 1000, 1000, 1000, 0, 0, 0, 99999999, 99999999, 0),
(26, 1, '', 'Personal User', 0, 1, 5, '', '0', 100, 100, 100, 0, 0, 0, 99999999, 99999999, 0),
(27, 1, '', 'Personal User', 0, 1, 5, '', '0', 100, 100, 100, 0, 0, 0, 99999999, 99999999, 0),
(28, 1, '', 'Personal User', 0, 1, 5, '', '0', 100, 100, 100, 0, 0, 0, 99999999, 99999999, 0),
(29, 1, '', 'Personal User', 0, 1, 5, '', '0', 100, 100, 100, 0, 0, 0, 99999999, 99999999, 0);


CREATE TABLE `nuke_bbhackgame` (
  `user_id` mediumint(8) NOT NULL,
  `game_id` mediumint(8) NOT NULL,
  `date_hack` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_bbinline_ads` (
  `ad_id` tinyint(5) NOT NULL,
  `ad_code` text NOT NULL,
  `ad_name` char(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_bblogs` (
  `log_id` mediumint(10) NOT NULL,
  `mode` varchar(50) DEFAULT '',
  `topic_id` mediumint(10) DEFAULT 0,
  `user_id` mediumint(8) DEFAULT 0,
  `username` varchar(255) DEFAULT '',
  `user_ip` varchar(8) NOT NULL DEFAULT '0',
  `time` int(11) DEFAULT 0,
  `new_topic_id` mediumint(10) NOT NULL DEFAULT 0,
  `forum_id` mediumint(10) NOT NULL DEFAULT 0,
  `new_forum_id` mediumint(10) NOT NULL DEFAULT 0,
  `last_post_id` mediumint(10) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_bblogs_config` (
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_bblogs_config` (`config_name`, `config_value`) VALUES
('all_admin', '0');

CREATE TABLE `nuke_bbposts` (
  `post_id` mediumint(8) UNSIGNED NOT NULL,
  `topic_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `forum_id` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `poster_id` mediumint(8) NOT NULL DEFAULT 0,
  `post_time` int(11) NOT NULL DEFAULT 0,
  `poster_ip` varchar(8) NOT NULL DEFAULT '',
  `post_username` varchar(25) DEFAULT NULL,
  `enable_bbcode` tinyint(1) NOT NULL DEFAULT 1,
  `enable_html` tinyint(1) NOT NULL DEFAULT 0,
  `enable_smilies` tinyint(1) NOT NULL DEFAULT 1,
  `enable_sig` tinyint(1) NOT NULL DEFAULT 1,
  `post_edit_time` int(11) DEFAULT NULL,
  `post_edit_count` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `post_attachment` tinyint(1) NOT NULL DEFAULT 0,
  `post_move` tinyint(1) NOT NULL DEFAULT 0,
  `post_icon` tinyint(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_bbposts_text` (
  `post_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `bbcode_uid` varchar(10) NOT NULL DEFAULT '',
  `post_subject` varchar(60) DEFAULT NULL,
  `post_text` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_bbpost_reports` (
  `report_id` mediumint(8) NOT NULL,
  `post_id` mediumint(8) NOT NULL DEFAULT 0,
  `reporter_id` mediumint(8) NOT NULL DEFAULT 0,
  `report_status` tinyint(1) NOT NULL DEFAULT 0,
  `report_time` int(11) NOT NULL DEFAULT 0,
  `report_comments` text DEFAULT NULL,
  `last_action_user_id` mediumint(8) DEFAULT 0,
  `last_action_time` int(11) NOT NULL DEFAULT 0,
  `last_action_comments` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_bbprivmsgs` (
  `privmsgs_id` mediumint(8) UNSIGNED NOT NULL,
  `privmsgs_type` tinyint(4) NOT NULL DEFAULT 0,
  `privmsgs_subject` varchar(255) NOT NULL DEFAULT '0',
  `privmsgs_from_userid` mediumint(8) NOT NULL DEFAULT 0,
  `privmsgs_to_userid` mediumint(8) NOT NULL DEFAULT 0,
  `privmsgs_date` int(11) NOT NULL DEFAULT 0,
  `privmsgs_ip` varchar(8) NOT NULL DEFAULT '',
  `privmsgs_enable_bbcode` tinyint(1) NOT NULL DEFAULT 1,
  `privmsgs_enable_html` tinyint(1) NOT NULL DEFAULT 0,
  `privmsgs_enable_smilies` tinyint(1) NOT NULL DEFAULT 1,
  `privmsgs_attach_sig` tinyint(1) NOT NULL DEFAULT 1,
  `privmsgs_attachment` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_bbprivmsgs_archive` (
  `privmsgs_id` mediumint(8) UNSIGNED NOT NULL,
  `privmsgs_type` tinyint(4) NOT NULL DEFAULT 0,
  `privmsgs_subject` varchar(255) NOT NULL DEFAULT '0',
  `privmsgs_from_userid` mediumint(8) NOT NULL DEFAULT 0,
  `privmsgs_to_userid` mediumint(8) NOT NULL DEFAULT 0,
  `privmsgs_date` int(11) NOT NULL DEFAULT 0,
  `privmsgs_ip` varchar(8) NOT NULL DEFAULT '',
  `privmsgs_enable_bbcode` tinyint(1) NOT NULL DEFAULT 1,
  `privmsgs_enable_html` tinyint(1) NOT NULL DEFAULT 0,
  `privmsgs_enable_smilies` tinyint(1) NOT NULL DEFAULT 1,
  `privmsgs_attach_sig` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_bbprivmsgs_text` (
  `privmsgs_text_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `privmsgs_bbcode_uid` varchar(10) NOT NULL DEFAULT '0',
  `privmsgs_text` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_bbquicksearch` (
  `search_id` mediumint(8) UNSIGNED NOT NULL,
  `search_name` varchar(255) NOT NULL DEFAULT '',
  `search_url1` varchar(255) NOT NULL DEFAULT '',
  `search_url2` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_bbquicksearch` (`search_id`, `search_name`, `search_url1`, `search_url2`) VALUES
(1, 'Google', 'http://www.google.com/search?hl=en&ie=UTF-8&oe=UTF-8&q=', '');

CREATE TABLE `nuke_bbquota_limits` (
  `quota_limit_id` mediumint(8) UNSIGNED NOT NULL,
  `quota_desc` varchar(20) NOT NULL DEFAULT '',
  `quota_limit` bigint(20) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_bbquota_limits` (`quota_limit_id`, `quota_desc`, `quota_limit`) VALUES
(1, 'Low', 262144),
(2, 'Medium', 2097152),
(3, 'High', 5242880);

CREATE TABLE `nuke_bbranks` (
  `rank_id` smallint(5) UNSIGNED NOT NULL,
  `rank_title` varchar(100) NOT NULL DEFAULT '',
  `rank_min` mediumint(8) NOT NULL DEFAULT 0,
  `rank_special` tinyint(1) DEFAULT 0,
  `rank_image` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_bbranks` (`rank_id`, `rank_title`, `rank_min`, `rank_special`, `rank_image`) VALUES
(4, 'Administrator', -1, 1, 'images/ranks/administrator.png'),
(5, 'Developer', -1, 1, 'images/ranks/developer.png'),
(6, 'Portal Member', -1, 1, 'images/ranks/regular-member.png'),
(7, 'VIP Member', -1, 1, 'images/ranks/vip.png');

CREATE TABLE `nuke_bbreputation` (
  `user_id` mediumint(8) NOT NULL DEFAULT 0,
  `user_id_2` mediumint(8) NOT NULL DEFAULT 0,
  `post_id` mediumint(8) NOT NULL DEFAULT 0,
  `rep_sum` float NOT NULL DEFAULT 0,
  `rep_neg` tinyint(1) NOT NULL DEFAULT 0,
  `rep_comment` varchar(200) NOT NULL DEFAULT '',
  `rep_time` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_bbreputation_config` (
  `config_name` varchar(255) NOT NULL,
  `config_value` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_bbreputation_config` (`config_name`, `config_value`) VALUES
('posts_to_earn', '5'),
('rep_disable', '0'),
('days_to_earn', '30'),
('flood_control_time', '30'),
('graphic_version', '0'),
('medal4_to_earn', '10'),
('medal3_to_earn', '50'),
('medal2_to_earn', '100'),
('medal1_to_earn', '200'),
('given_rep_to_earn', '20'),
('show_stats_to_mods', '0'),
('repsum_limit', '0'),
('pm_notify', '0'),
('default_amount', '0');

CREATE TABLE `nuke_bbscores` (
  `game_id` mediumint(8) NOT NULL DEFAULT 0,
  `user_id` mediumint(8) NOT NULL DEFAULT 0,
  `score_game` int(11) NOT NULL DEFAULT 0,
  `score_date` int(11) NOT NULL DEFAULT 0,
  `score_time` int(11) NOT NULL DEFAULT 0,
  `score_set` mediumint(8) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_bbsearch_rebuild` (
  `rebuild_session_id` mediumint(8) UNSIGNED NOT NULL,
  `start_post_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `end_post_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `start_time` int(11) NOT NULL DEFAULT 0,
  `end_time` int(11) NOT NULL DEFAULT 0,
  `last_cycle_time` int(11) NOT NULL DEFAULT 0,
  `session_time` int(11) NOT NULL DEFAULT 0,
  `session_posts` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `session_cycles` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `search_size` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `rebuild_session_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_bbsearch_results` (
  `search_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `session_id` varchar(32) NOT NULL DEFAULT '',
  `search_array` text NOT NULL,
  `search_time` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_bbsearch_results` (`search_id`, `session_id`, `search_array`, `search_time`) VALUES
(1740340759, '26589137fb7fab02a0b32bc95be6281d', 'a:7:{s:14:\"search_results\";N;s:17:\"total_match_count\";N;s:12:\"split_search\";N;s:7:\"sort_by\";N;s:8:\"sort_dir\";N;s:12:\"show_results\";N;s:12:\"return_chars\";N;}', 1620660088);

CREATE TABLE `nuke_bbsearch_wordlist` (
  `word_text` varchar(255) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '',
  `word_id` mediumint(8) UNSIGNED NOT NULL,
  `word_common` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `post_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_bbsearch_wordmatch` (
  `post_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `word_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `title_match` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_bbsessions` (
  `session_id` varchar(32) NOT NULL DEFAULT '',
  `session_user_id` mediumint(8) NOT NULL DEFAULT 0,
  `session_start` int(11) NOT NULL DEFAULT 0,
  `session_time` int(11) NOT NULL DEFAULT 0,
  `session_ip` varchar(8) NOT NULL DEFAULT '0',
  `session_page` int(11) NOT NULL DEFAULT 0,
  `session_logged_in` tinyint(1) NOT NULL DEFAULT 0,
  `session_admin` tinyint(2) NOT NULL DEFAULT 0,
  `session_url_qs` varchar(255) NOT NULL DEFAULT '',
  `session_url_ps` varchar(255) NOT NULL DEFAULT '',
  `session_url_specific` int(10) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_bbsessions_keys` (
  `key_id` varchar(32) NOT NULL DEFAULT '0',
  `user_id` mediumint(8) NOT NULL DEFAULT 0,
  `last_ip` varchar(8) NOT NULL DEFAULT '0',
  `last_login` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_bbsmilies` (
  `smilies_id` smallint(5) UNSIGNED NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  `smile_url` varchar(100) DEFAULT NULL,
  `emoticon` varchar(75) DEFAULT NULL,
  `smile_stat` mediumint(8) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_bbsmilies` (`smilies_id`, `code`, `smile_url`, `emoticon`, `smile_stat`) VALUES
(1, ':D', 'bigsmile.png', 'Very Happy', 0),
(2, ':-D', 'bigsmile.png', 'Very Happy', 0),
(3, ':grin:', 'bigsmile.png', 'Very Happy', 0),
(4, ':)', 'smile.png', 'Smile', 0),
(5, ':-)', 'smile.png', 'Smile', 0),
(6, ':smile:', 'smile.png', 'Smile', 0),
(7, ':(', 'sad.png', 'Sad', 0),
(8, ':-(', 'sad.png', 'Sad', 0),
(9, ':sad:', 'sad.png', 'Sad', 0),
(10, ':o', 'surprised.png', 'Surprised', 0),
(11, ':-o', 'surprised.png', 'Surprised', 0),
(12, ':eek:', 'surprised.png', 'Surprised', 0),
(13, '8O', 'eek.png', 'Shocked', 0),
(14, '8-O', 'eek.png', 'Shocked', 0),
(15, ':shock:', 'eek.png', 'Shocked', 0),
(16, ':?', 'confused.png', 'Confused', 0),
(17, ':-?', 'confused.png', 'Confused', 0),
(18, ':???:', 'confused.png', 'Confused', 0),
(19, '8)', 'cool.png', 'Cool', 0),
(20, '8-)', 'cool.png', 'Cool', 0),
(21, ':cool:', 'cool.png', 'Cool', 0),
(22, ':lol:', 'lol.png', 'Laughing', 0),
(23, ':x', 'mad.png', 'Mad', 0),
(24, ':-x', 'mad.png', 'Mad', 0),
(25, ':mad:', 'mad.png', 'Mad', 0),
(26, ':P', 'razz.png', 'Razz', 0),
(27, ':-P', 'razz.png', 'Razz', 0),
(28, ':razz:', 'razz.png', 'Razz', 0),
(29, ':oops:', 'redface.png', 'Embarassed', 0),
(30, ':cry:', 'cry.png', 'Crying or Very sad', 0),
(31, ':evil:', 'evil.png', 'Evil or Very Mad', 0),
(32, ':twisted:', 'twisted.png', 'Twisted Evil', 0),
(33, ':hearts:', 'hearts.png', 'In Love', 0),
(34, ':wink:', 'wink.png', 'Wink', 0),
(35, ';)', 'wink.png', 'Wink', 0),
(36, ';-)', 'wink.png', 'Wink', 0);

CREATE TABLE `nuke_bbstats_config` (
  `config_name` varchar(100) NOT NULL DEFAULT '',
  `config_value` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_bbstats_config` (`config_name`, `config_value`) VALUES
('install_date', '0'),
('return_limit', '10'),
('version', '3.0.0'),
('page_views', '36');

CREATE TABLE `nuke_bbstats_modules` (
  `module_id` mediumint(8) UNSIGNED NOT NULL,
  `short_name` varchar(100) DEFAULT NULL,
  `update_time` mediumint(8) NOT NULL DEFAULT 0,
  `module_order` mediumint(8) NOT NULL DEFAULT 0,
  `active` tinyint(2) NOT NULL DEFAULT 0,
  `perm_all` tinyint(2) UNSIGNED NOT NULL DEFAULT 1,
  `perm_reg` tinyint(2) UNSIGNED NOT NULL DEFAULT 1,
  `perm_mod` tinyint(2) UNSIGNED NOT NULL DEFAULT 1,
  `perm_admin` tinyint(2) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_bbstats_modules` (`module_id`, `short_name`, `update_time`, `module_order`, `active`, `perm_all`, `perm_reg`, `perm_mod`, `perm_admin`) VALUES
(1, 'stats_overview', 360, 10, 1, 1, 1, 1, 1),
(2, 'top_posters', 360, 30, 1, 1, 1, 1, 1),
(3, 'admin_statistics', 360, 20, 1, 1, 1, 1, 1),
(4, 'most_viewed_topics', 360, 80, 1, 1, 1, 1, 1),
(5, 'top_posters_month', 360, 60, 1, 1, 1, 1, 1),
(6, 'topics_by_month', 360, 100, 1, 1, 1, 1, 1),
(7, 'most_interesting_topics', 360, 120, 1, 1, 1, 1, 1),
(8, 'top_words', 360, 90, 1, 1, 1, 1, 1),
(9, 'least_interesting_topics', 360, 130, 1, 1, 1, 1, 1),
(10, 'most_active_topicstarter', 360, 40, 1, 1, 1, 1, 1),
(11, 'top_smilies', 0, 110, 1, 1, 1, 1, 1),
(12, 'users_by_month', 360, 140, 1, 1, 1, 1, 1),
(13, 'posts_by_month', 360, 150, 1, 1, 1, 1, 1),
(14, 'top_posters_week', 360, 50, 1, 1, 1, 1, 1),
(15, 'top_attachments', 360, 160, 1, 1, 1, 1, 1),
(16, 'most_active_topics', 360, 70, 1, 1, 1, 1, 1);

CREATE TABLE `nuke_bbstats_module_admin_panel` (
  `module_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` varchar(255) NOT NULL DEFAULT '',
  `config_type` varchar(20) NOT NULL DEFAULT '',
  `config_title` varchar(100) NOT NULL DEFAULT '',
  `config_explain` varchar(100) DEFAULT NULL,
  `config_trigger` varchar(20) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_bbstats_module_admin_panel` (`module_id`, `config_name`, `config_value`, `config_type`, `config_title`, `config_explain`, `config_trigger`) VALUES
(1, 'num_columns', '2', 'number', 'num_columns_title', 'num_columns_explain', 'integer'),
(15, 'exclude_images', '0', 'number', 'exclude_images_title', 'exclude_images_explain', 'enum');

CREATE TABLE `nuke_bbstats_module_cache` (
  `module_id` mediumint(8) NOT NULL DEFAULT 0,
  `module_cache_time` int(12) NOT NULL DEFAULT 0,
  `db_cache` text NOT NULL,
  `priority` mediumint(8) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_bbstats_module_group_auth` (
  `module_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `group_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_bbstats_module_info` (
  `module_id` mediumint(8) NOT NULL DEFAULT 0,
  `long_name` varchar(100) NOT NULL DEFAULT '',
  `author` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `version` varchar(10) NOT NULL DEFAULT '',
  `update_site` varchar(100) DEFAULT NULL,
  `extra_info` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_bbstats_module_info` (`module_id`, `long_name`, `author`, `email`, `url`, `version`, `update_site`, `extra_info`) VALUES
(1, 'Statistics Overview Section', 'Acyd Burn', 'acyd.burn@gmx.de', 'http://www.opentools.de', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This Module will print out a link Block with Links to the current Module at the Statistics Site.\nYou are able to define the number of columns displayed for this Module within the Administration Panel -&gt; Edit Module.'),
(2, 'Top Posters', 'Acyd Burn', 'acyd.burn@gmx.de', 'http://www.opentools.de', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This Module displays the Top Posters from your board.\nAnonymous Poster are not counted.'),
(3, 'Administrative Statistics', 'Acyd Burn', 'acyd.burn@gmx.de', 'http://www.opentools.de', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This Module displays some Admin Statistics about your Board.\nIt is nearly the same you are able to see within the first Administration Panel visit.'),
(4, 'Most viewed topics', 'Acyd Burn', 'acyd.burn@gmx.de', 'http://www.opentools.de', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This Module displays the most viewed topics at your board.'),
(5, 'Top Posters this Month (Site History Mod)', 'Acyd Burn', 'acyd.burn@gmx.de', 'http://www.opentools.de', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This Module does NOT require the Site History Mod,\nit will display the Top Posters on a Monthly basis.'),
(6, 'New topics by month', 'Acyd Burn', 'acyd.burn@gmx.de', 'http://www.opentools.de', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This Module will display the topics created at your Board in a monthly statistic.'),
(7, 'Most Interesting Topics', 'JRSweets', 'JRSweets@gmail.com', 'http://www.jeffrusso.net', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This module will show the most intresting topics.'),
(8, 'Top Words', 'JRSweets', 'JRSweets@gmail.com', 'http://www.jeffrusso.net', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This Module displays the most used words on your board.'),
(9, 'Least Interesting Topics', 'JRSweets', 'JRSweets@gmail.com', 'http://www.jeffrusso.net', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This module will show the least intresting topics.'),
(10, 'Most Active Topicstarter', 'Acyd Burn', 'acyd.burn@gmx.de', 'http://www.opentools.de', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This Module displays the most active topicstarter on your board.\nAnonymous Poster are not counted.'),
(11, 'Top Smilies', 'Acyd Burn', 'acyd.burn@gmx.de', 'http://www.opentools.de', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This Module displays the Top Smilies used at your board.\nThis Module uses an Smilie Index Table for caching the smilie data and to not\nrequire re-indexing of all posts.'),
(12, 'New users by month', 'Acyd Burn', 'acyd.burn@gmx.de', 'http://www.opentools.de', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This Module will display the users registered to your Board in a monthly statistic.'),
(13, 'New posts by month', 'Acyd Burn', 'acyd.burn@gmx.de', 'http://www.opentools.de', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This Module will display the posts created at your Board in a monthly statistic.'),
(14, 'Top Posters this Week (Site History Mod)', 'Acyd Burn', 'acyd.burn@gmx.de', 'http://www.opentools.de', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This Module does NOT require the Site History Mod,\nit will display the Top Posters on a Weekly basis.'),
(15, 'Top Downloaded Attachments', 'Acyd Burn', 'acyd.burn@gmx.de', 'http://www.opentools.de', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This Module will print out the most downloaded Files.\nThe Attachment Mod Version 2.3.x have to be installed in order to let this Module work.\nYou are able to exclude Images from the statistic too.'),
(16, 'Most active Topics', 'Acyd Burn', 'acyd.burn@gmx.de', 'http://www.opentools.de', '3.0.0', 'http://www.opentools.de/board/show_modules.php', 'This Module displays the most active topics at your board.');

CREATE TABLE `nuke_bbstats_smilies_index` (
  `code` varchar(50) NOT NULL DEFAULT '',
  `smile_url` varchar(100) DEFAULT NULL,
  `smile_count` mediumint(8) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_bbstats_smilies_info` (
  `last_post_id` mediumint(8) NOT NULL DEFAULT 0,
  `last_update_time` int(12) NOT NULL DEFAULT 0,
  `update_time` mediumint(8) NOT NULL DEFAULT 10080
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_bbstats_smilies_info` (`last_post_id`, `last_update_time`, `update_time`) VALUES
(7, 1619840967, 10080);

CREATE TABLE `nuke_bbthanks` (
  `topic_id` mediumint(8) NOT NULL,
  `user_id` mediumint(8) NOT NULL,
  `thanks_time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_bbthemes` (
  `themes_id` mediumint(8) UNSIGNED NOT NULL,
  `template_name` varchar(30) NOT NULL DEFAULT '',
  `style_name` varchar(30) NOT NULL DEFAULT '',
  `head_stylesheet` varchar(100) DEFAULT NULL,
  `body_background` varchar(100) DEFAULT NULL,
  `body_bgcolor` varchar(6) DEFAULT NULL,
  `body_text` varchar(6) DEFAULT NULL,
  `body_link` varchar(6) DEFAULT NULL,
  `body_vlink` varchar(6) DEFAULT NULL,
  `body_alink` varchar(6) DEFAULT NULL,
  `body_hlink` varchar(6) DEFAULT NULL,
  `tr_color1` varchar(6) DEFAULT NULL,
  `tr_color2` varchar(6) DEFAULT NULL,
  `tr_color3` varchar(6) DEFAULT NULL,
  `tr_class1` varchar(25) DEFAULT NULL,
  `tr_class2` varchar(25) DEFAULT NULL,
  `tr_class3` varchar(25) DEFAULT NULL,
  `th_color1` varchar(6) DEFAULT NULL,
  `th_color2` varchar(6) DEFAULT NULL,
  `th_color3` varchar(6) DEFAULT NULL,
  `th_class1` varchar(25) DEFAULT NULL,
  `th_class2` varchar(25) DEFAULT NULL,
  `th_class3` varchar(25) DEFAULT NULL,
  `td_color1` varchar(6) DEFAULT NULL,
  `td_color2` varchar(6) DEFAULT NULL,
  `td_color3` varchar(6) DEFAULT NULL,
  `td_class1` varchar(25) DEFAULT NULL,
  `td_class2` varchar(25) DEFAULT NULL,
  `td_class3` varchar(25) DEFAULT NULL,
  `fontface1` varchar(50) DEFAULT NULL,
  `fontface2` varchar(50) DEFAULT NULL,
  `fontface3` varchar(50) DEFAULT NULL,
  `fontsize1` tinyint(4) DEFAULT NULL,
  `fontsize2` tinyint(4) DEFAULT NULL,
  `fontsize3` tinyint(4) DEFAULT NULL,
  `fontcolor1` varchar(6) DEFAULT NULL,
  `fontcolor2` varchar(6) DEFAULT NULL,
  `fontcolor3` varchar(6) DEFAULT NULL,
  `span_class1` varchar(25) DEFAULT NULL,
  `span_class2` varchar(25) DEFAULT NULL,
  `span_class3` varchar(25) DEFAULT NULL,
  `img_size_poll` smallint(5) UNSIGNED DEFAULT NULL,
  `img_size_privmsg` smallint(5) UNSIGNED DEFAULT NULL,
  `online_color` varchar(6) NOT NULL DEFAULT '',
  `offline_color` varchar(6) NOT NULL DEFAULT '',
  `hidden_color` varchar(6) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_bbthemes` (`themes_id`, `template_name`, `style_name`, `head_stylesheet`, `body_background`, `body_bgcolor`, `body_text`, `body_link`, `body_vlink`, `body_alink`, `body_hlink`, `tr_color1`, `tr_color2`, `tr_color3`, `tr_class1`, `tr_class2`, `tr_class3`, `th_color1`, `th_color2`, `th_color3`, `th_class1`, `th_class2`, `th_class3`, `td_color1`, `td_color2`, `td_color3`, `td_class1`, `td_class2`, `td_class3`, `fontface1`, `fontface2`, `fontface3`, `fontsize1`, `fontsize2`, `fontsize3`, `fontcolor1`, `fontcolor2`, `fontcolor3`, `span_class1`, `span_class2`, `span_class3`, `img_size_poll`, `img_size_privmsg`, `online_color`, `offline_color`, `hidden_color`) VALUES
(1, 'subSilver', 'subSilver', 'subSilver.css', '', '0E3259', '000000', '006699', '5493B4', '', 'DD6900', 'EFEFEF', 'DEE3E7', 'D1D7DC', '', '', '', '98AAB1', '006699', 'FFFFFF', 'cellpic1.gif', 'cellpic3.gif', 'cellpic2.jpg', 'FAFAFA', 'FFFFFF', '', 'row1', 'row2', '', 'Verdana, Arial, Helvetica, sans-serif', 'Trebuchet MS', 'Courier, \'Courier New\', sans-serif', 10, 11, 12, '444444', '006600', 'FFA34F', '', '', '', NULL, NULL, '008500', 'DF0000', 'EBD400');

CREATE TABLE `nuke_bbthemes_name` (
  `themes_id` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `tr_color1_name` char(50) DEFAULT NULL,
  `tr_color2_name` char(50) DEFAULT NULL,
  `tr_color3_name` char(50) DEFAULT NULL,
  `tr_class1_name` char(50) DEFAULT NULL,
  `tr_class2_name` char(50) DEFAULT NULL,
  `tr_class3_name` char(50) DEFAULT NULL,
  `th_color1_name` char(50) DEFAULT NULL,
  `th_color2_name` char(50) DEFAULT NULL,
  `th_color3_name` char(50) DEFAULT NULL,
  `th_class1_name` char(50) DEFAULT NULL,
  `th_class2_name` char(50) DEFAULT NULL,
  `th_class3_name` char(50) DEFAULT NULL,
  `td_color1_name` char(50) DEFAULT NULL,
  `td_color2_name` char(50) DEFAULT NULL,
  `td_color3_name` char(50) DEFAULT NULL,
  `td_class1_name` char(50) DEFAULT NULL,
  `td_class2_name` char(50) DEFAULT NULL,
  `td_class3_name` char(50) DEFAULT NULL,
  `fontface1_name` char(50) DEFAULT NULL,
  `fontface2_name` char(50) DEFAULT NULL,
  `fontface3_name` char(50) DEFAULT NULL,
  `fontsize1_name` char(50) DEFAULT NULL,
  `fontsize2_name` char(50) DEFAULT NULL,
  `fontsize3_name` char(50) DEFAULT NULL,
  `fontcolor1_name` char(50) DEFAULT NULL,
  `fontcolor2_name` char(50) DEFAULT NULL,
  `fontcolor3_name` char(50) DEFAULT NULL,
  `span_class1_name` char(50) DEFAULT NULL,
  `span_class2_name` char(50) DEFAULT NULL,
  `span_class3_name` char(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_bbthemes_name` (`themes_id`, `tr_color1_name`, `tr_color2_name`, `tr_color3_name`, `tr_class1_name`, `tr_class2_name`, `tr_class3_name`, `th_color1_name`, `th_color2_name`, `th_color3_name`, `th_class1_name`, `th_class2_name`, `th_class3_name`, `td_color1_name`, `td_color2_name`, `td_color3_name`, `td_class1_name`, `td_class2_name`, `td_class3_name`, `fontface1_name`, `fontface2_name`, `fontface3_name`, `fontsize1_name`, `fontsize2_name`, `fontsize3_name`, `fontcolor1_name`, `fontcolor2_name`, `fontcolor3_name`, `span_class1_name`, `span_class2_name`, `span_class3_name`) VALUES
(1, 'The lightest row colour', 'The medium row color', 'The darkest row colour', '', '', '', 'Border round the whole page', 'Outer table border', 'Inner table border', 'Silver gradient picture', 'Blue gradient picture', 'Fade-out gradient on index', 'Background for quote boxes', 'All white areas', '', 'Background for topic posts', '2nd background for topic posts', '', 'Main fonts', 'Additional topic title font', 'Form fonts', 'Smallest font size', 'Medium font size', 'Normal font size (post body etc)', 'Quote & copyright text', 'Code text colour', 'Main table header text colour', '', '', '');

CREATE TABLE `nuke_bbtopics` (
  `topic_id` mediumint(8) UNSIGNED NOT NULL,
  `forum_id` smallint(8) UNSIGNED NOT NULL DEFAULT 0,
  `topic_title` char(60) NOT NULL DEFAULT '',
  `topic_poster` mediumint(8) NOT NULL DEFAULT 0,
  `topic_time` int(11) NOT NULL DEFAULT 0,
  `topic_views` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `topic_replies` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `topic_status` tinyint(3) NOT NULL DEFAULT 0,
  `topic_vote` tinyint(1) NOT NULL DEFAULT 0,
  `topic_type` tinyint(3) NOT NULL DEFAULT 0,
  `topic_last_post_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `topic_first_post_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `topic_moved_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `topic_priority` smallint(6) NOT NULL DEFAULT 0,
  `topic_attachment` tinyint(1) NOT NULL DEFAULT 0,
  `topic_glance_priority` smallint(6) NOT NULL DEFAULT 0,
  `topic_icon` tinyint(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_bbtopics` (`topic_id`, `forum_id`, `topic_title`, `topic_poster`, `topic_time`, `topic_views`, `topic_replies`, `topic_status`, `topic_vote`, `topic_type`, `topic_last_post_id`, `topic_first_post_id`, `topic_moved_id`, `topic_priority`, `topic_attachment`, `topic_glance_priority`, `topic_icon`) VALUES
(8, 1, 'Welcome to PHP-Nuke Evolution Xtreme v3.0.1b', 5, 1620567668, 16, 0, 0, 0, 1, 14, 14, 0, 0, 0, 0, 5),
(9, 15, 'The Link Us Module is now in development status.', 5, 1620568076, 25, 0, 0, 0, 0, 15, 15, 0, 0, 0, 0, 5),
(10, 14, 'Google Site Map Generator is now in development status.', 5, 1620569758, 19, 1, 0, 0, 0, 19, 16, 0, 0, 0, 0, 5),
(11, 16, 'How do I get this to update my XML with forums posts?', 11, 1620571562, 5, 1, 0, 0, 0, 18, 17, 0, 0, 0, 0, 5),
(12, 3, 'Admin SQL Error log problems', 3, 1620584943, 8, 1, 0, 0, 0, 21, 20, 0, 0, 0, 0, 15);

CREATE TABLE `nuke_bbtopics_email` (
  `user_id` mediumint(8) NOT NULL,
  `friend_name` varchar(100) NOT NULL,
  `friend_email` varchar(100) NOT NULL,
  `message` varchar(255) NOT NULL DEFAULT '',
  `topic_id` mediumint(8) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_bbtopics_watch` (
  `topic_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` mediumint(8) NOT NULL DEFAULT 0,
  `notify_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_bbtopics_watch` (`topic_id`, `user_id`, `notify_status`) VALUES
(12, 2, 0);

CREATE TABLE `nuke_bbtopic_moved` (
  `moved_id` mediumint(8) UNSIGNED NOT NULL,
  `moved_topic_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `moved_oldtopic_id` mediumint(8) UNSIGNED DEFAULT 0,
  `moved_type` varchar(8) NOT NULL DEFAULT '0',
  `moved_parent` mediumint(8) UNSIGNED DEFAULT 0,
  `moved_target` mediumint(8) UNSIGNED DEFAULT 0,
  `moved_mod` mediumint(8) NOT NULL DEFAULT 0,
  `moved_time` int(11) NOT NULL DEFAULT 0,
  `last_post_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_bbtopic_view` (
  `topic_id` mediumint(8) NOT NULL,
  `user_id` mediumint(8) NOT NULL,
  `view_time` int(11) NOT NULL,
  `view_count` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_bbtopic_view` (`topic_id`, `user_id`, `view_time`, `view_count`) VALUES
(2, 2, 1620416529, 152),
(2, 1, 1620353324, 40),
(2, 4, 1620348528, 30),
(2, 6, 1619596768, 6),
(2, 10, 1619568473, 8),
(2, 11, 1620546347, 7),
(2, 5, 1620567467, 58),
(2, 7, 1619846451, 2),
(2, 3, 1620406504, 1),
(3, 20, 1620406568, 1),
(3, 5, 1620567442, 2),
(3, 3, 1620409077, 1),
(3, 1, 1620459617, 1),
(2, 21, 1620460237, 1),
(5, 20, 1620464910, 1),
(6, 20, 1620465284, 1),
(4, 21, 1620465669, 1),
(6, 21, 1620465677, 1),
(4, 5, 1620567409, 2),
(3, 11, 1620540631, 2),
(6, 11, 1620539506, 2),
(7, 11, 1620540689, 7),
(7, 5, 1620567451, 2),
(6, 5, 1620567427, 2),
(8, 5, 1620570714, 10),
(9, 5, 1620583076, 19),
(9, 2, 1620583286, 3),
(10, 5, 1620583146, 10),
(8, 11, 1620570999, 2),
(10, 11, 1620582683, 9),
(9, 11, 1620571179, 3),
(11, 11, 1620582385, 3),
(11, 5, 1620571754, 2),
(8, 2, 1620623482, 3),
(12, 3, 1620621765, 2),
(12, 2, 1620594924, 5),
(10, 2, 1620594958, 1),
(12, 1, 1620623590, 1),
(8, 3, 1620625732, 1);

CREATE TABLE `nuke_bbuser_group` (
  `group_id` mediumint(8) NOT NULL DEFAULT 0,
  `user_id` mediumint(8) NOT NULL DEFAULT 0,
  `user_pending` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_bbuser_group` (`group_id`, `user_id`, `user_pending`) VALUES
(1, -1, 0),
(3, 2, 0),
(5, 2, 0),
(5, 3, 0),
(4, 3, 0),
(3, 3, 0),
(5, 4, 0),
(3, 4, 0),
(6, 5, 0),
(3, 5, 0),
(7, 2, 0),
(8, 2, 0),
(7, 4, 0),
(9, 6, 0),
(3, 6, 0),
(7, 6, 0),
(7, 3, 0),
(7, 5, 0),
(10, 7, 0),
(3, 7, 0),
(11, 8, 0),
(3, 8, 0),
(12, 9, 0),
(3, 9, 0),
(13, 10, 0),
(3, 10, 0),
(14, 11, 0),
(3, 11, 0),
(15, 12, 0),
(3, 12, 0),
(16, 13, 0),
(3, 13, 0),
(17, 14, 0),
(3, 14, 0),
(18, 15, 0),
(3, 15, 0),
(19, 16, 0),
(3, 16, 0),
(20, 17, 0),
(3, 17, 0),
(21, 18, 0),
(3, 18, 0),
(22, 19, 0),
(3, 19, 0),
(23, 20, 0),
(3, 20, 0),
(7, 20, 0),
(24, 21, 0),
(3, 21, 0),
(7, 11, 1);

CREATE TABLE `nuke_bbvote_desc` (
  `vote_id` mediumint(8) UNSIGNED NOT NULL,
  `topic_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `vote_text` text NOT NULL,
  `vote_start` int(11) NOT NULL DEFAULT 0,
  `vote_length` int(11) NOT NULL DEFAULT 0,
  `poll_view_toggle` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_bbvote_results` (
  `vote_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `vote_option_id` tinyint(4) UNSIGNED NOT NULL DEFAULT 0,
  `vote_option_text` varchar(255) NOT NULL DEFAULT '',
  `vote_result` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_bbvote_voters` (
  `vote_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `vote_user_id` mediumint(8) NOT NULL DEFAULT 0,
  `vote_user_ip` char(8) NOT NULL DEFAULT '',
  `vote_cast` tinyint(4) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_bbwords` (
  `word_id` mediumint(8) UNSIGNED NOT NULL,
  `word` char(100) NOT NULL DEFAULT '',
  `replacement` char(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_bbwords` (`word_id`, `word`, `replacement`) VALUES
(1, 'cunt', 'fargnoggle');

CREATE TABLE `nuke_bbxdata_auth` (
  `field_id` smallint(5) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL,
  `auth_value` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_bbxdata_data` (
  `field_id` smallint(5) UNSIGNED NOT NULL,
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `xdata_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_bbxdata_fields` (
  `field_id` smallint(5) UNSIGNED NOT NULL,
  `field_name` varchar(255) NOT NULL DEFAULT '',
  `field_desc` text NOT NULL,
  `field_type` varchar(255) NOT NULL DEFAULT '',
  `field_order` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `code_name` varchar(255) NOT NULL DEFAULT '',
  `field_length` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `field_values` text NOT NULL,
  `field_regexp` text NOT NULL,
  `manditory` tinyint(1) NOT NULL DEFAULT 0,
  `default_auth` tinyint(1) NOT NULL DEFAULT 1,
  `display_register` tinyint(1) NOT NULL DEFAULT 1,
  `display_viewprofile` tinyint(1) NOT NULL DEFAULT 0,
  `display_posting` tinyint(1) NOT NULL DEFAULT 0,
  `handle_input` tinyint(1) NOT NULL DEFAULT 0,
  `allow_html` tinyint(1) NOT NULL DEFAULT 0,
  `allow_bbcode` tinyint(1) NOT NULL DEFAULT 0,
  `allow_smilies` tinyint(1) NOT NULL DEFAULT 0,
  `viewtopic` tinyint(1) NOT NULL DEFAULT 0,
  `signup` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `nuke_bbxdata_fields` (`field_id`, `field_name`, `field_desc`, `field_type`, `field_order`, `code_name`, `field_length`, `field_values`, `field_regexp`, `manditory`, `default_auth`, `display_register`, `display_viewprofile`, `display_posting`, `handle_input`, `allow_html`, `allow_bbcode`, `allow_smilies`, `viewtopic`, `signup`) VALUES
(5, 'Website', '', 'special', 5, 'website', 0, '', '', 0, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 'Location', '', 'special', 6, 'location', 0, '', '', 0, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0),
(7, 'Occupation', '', 'special', 7, 'occupation', 0, '', '', 0, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0),
(8, 'Interests', '', 'special', 8, 'interests', 0, '', '', 0, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0),
(9, 'Signature', '', 'special', 9, 'signature', 0, '', '', 0, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0);

CREATE TABLE `nuke_blocks` (
  `bid` int(10) NOT NULL,
  `bkey` varchar(15) NOT NULL DEFAULT '',
  `title` varchar(60) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `url` varchar(200) NOT NULL DEFAULT '',
  `bposition` char(1) NOT NULL DEFAULT '',
  `weight` int(10) NOT NULL DEFAULT 1,
  `active` int(1) NOT NULL DEFAULT 1,
  `refresh` int(10) NOT NULL DEFAULT 0,
  `time` varchar(14) NOT NULL DEFAULT '0',
  `blanguage` varchar(30) NOT NULL DEFAULT '',
  `blockfile` varchar(255) NOT NULL DEFAULT '',
  `view` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_blocks` (`bid`, `bkey`, `title`, `content`, `url`, `bposition`, `weight`, `active`, `refresh`, `time`, `blanguage`, `blockfile`, `view`) VALUES
(1, '', 'Main Menu', '', '', 'l', 5, 0, 1800, '0', '', 'block-Modules.php', '1'),
(2, '', 'Search', '', '', 'r', 0, 1, 3600, '', '', 'block-Search.php', '0'),
(3, '', 'Survey', '', '', 'r', 4, 0, 3600, '', '', 'block-Survey.php', '0'),
(4, '', 'Information', '<br /><center><span class=\"content\">\r\n<a href=\"http://phpnuke.org\"><img src=\"images/powered/powered8.jpg\" border=\"0\" alt=\"Powered by PHP-Nuke\" title=\"Powered by PHP-Nuke\" width=\"88\" height=\"31\" /></a>\r\n<br /><br />\r\n<a href=\"http://validator.w3.org/check/referer\"><img src=\"images/html401.gif\" width=\"88\" height=\"31\" alt=\"Valid HTML 4.01!\" title=\"Valid HTML 4.01!\" border=\"0\" /></a>\r\n<br /><br />\r\n<a href=\"http://jigsaw.w3.org/css-validator\"><img src=\"images/css.gif\" width=\"88\" height=\"31\" alt=\"Valid CSS!\" title=\"Valid CSS!\" border=\"0\" /></a></span></center><br />', '', 'r', 5, 0, 0, '', '', '', '0'),
(5, '', 'User Info', '', '', 'l', 0, 1, 0, '', '', 'block-Evo_User_Info.php', '0'),
(6, '', 'PHP-Nuke Evolution Xtreme', '', '', 'c', 2, 0, 0, '', '', 'block-Nuke-Evolution.php', '0'),
(8, '', 'Top 10 Links', '', '', 'r', 6, 1, 3600, '', '', 'block-Top10_Links.php', '0'),
(9, '', 'Forums', '', '', 'c', 0, 1, 3600, '', '', 'block-Forums.php', '0'),
(10, '', 'Submissions', '', '', 'l', 6, 0, 0, '', '', 'block-Submissions.php', '4'),
(11, '', 'Link-us', '', '', 'r', 3, 1, 3600, '0', '', 'block-Link-us.php', '1'),
(12, '', 'Shout Box', '', '', 'r', 1, 1, 3600, '0', '', 'block-Shout_Box.php', '1'),
(13, '', 'Todays Big Story', '', '', 'd', 0, 0, 3600, '0', '', 'block-Big_Story_of_Today.php', '1'),
(14, '', 'Donations', '', '', 'r', 2, 0, 3600, '0', '', 'block-Donations.php', '0'),
(15, '', 'Arcade Center', '', '', 'd', 1, 0, 3600, '0', '', 'block-Arcade_Center.php', '1'),
(16, '', 'ECalendar', '', '', 'l', 7, 0, 3600, '0', '', 'block-ECalendar.php', '1'),
(17, '', 'Portal Security', '', '', 'd', 2, 1, 3600, '0', '', 'block-Sentinel_Center.php', '1'),
(18, '', 'Visitor Log', '', '', 'c', 1, 1, 3600, '0', '', 'block-Titanium_Visitor_Log_Center.php', '1'),
(19, '', 'Module Demos', '', '', 'l', 2, 0, 3600, '0', '', 'block-Titanium_Portal_Menu.php', '1'),
(20, '', 'Select Theme', '', '', 'l', 1, 1, 3600, '0', '', 'block-Titanium_Themes.php', '1'),
(21, '', 'Portal Information', '', '', 'l', 3, 0, 3600, '0', '', 'block-Portal-Information.php', '1'),
(22, '', 'Honeypot Security', '', '', 'l', 4, 1, 3600, '0', '', 'block-Honey_Pot.php', '1'),
(23, '', 'Thank You', '', '', 'c', 3, 0, 3600, '0', '', 'block-Thank_You.php', '1'),
(24, '', 'Facebook Messenger Plugin', '', '', 'l', 8, 1, 3600, '0', '', 'block-Facebook_Chat_Plugin.php', '1');

CREATE TABLE `nuke_cnbya_config` (
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` longtext DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_cnbya_config` (`config_name`, `config_value`) VALUES
('sendaddmail', '1'),
('senddeletemail', '1'),
('allowuserdelete', '1'),
('allowusertheme', '0'),
('allowuserreg', '0'),
('allowmailchange', '0'),
('emailvalidate', '1'),
('requireadmin', '0'),
('servermail', '0'),
('useactivate', '1'),
('autosuspend', '0'),
('perpage', '100'),
('expiring', '86400'),
('nick_min', '4'),
('nick_max', '20'),
('pass_min', '4'),
('pass_max', '20'),
('bad_mail', 'yoursite.com\nmysite.com'),
('bad_nick', 'adm\nadmin\nanonimo\nanonymous\nannimo\ngod\nlinux\nnobody\noperator\nroot\nstaff\nwebmaster'),
('coppa', '0'),
('tos', '0'),
('tosall', '1'),
('cookiecheck', '1'),
('cookiecleaner', '1'),
('cookietimelife', '2592000'),
('cookiepath', ''),
('cookieinactivity', '-'),
('autosuspendmain', '0'),
('doublecheckemail', '1'),
('version', '4.4.2'),
('tos_text', 'This is your default TOS. You may edit this through the Your Account Admin Panel.');

CREATE TABLE `nuke_cnbya_field` (
  `fid` int(10) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT 'field',
  `value` varchar(255) DEFAULT NULL,
  `size` int(3) DEFAULT NULL,
  `need` int(1) NOT NULL DEFAULT 1,
  `pos` int(3) DEFAULT NULL,
  `public` int(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_cnbya_value` (
  `vid` int(10) NOT NULL,
  `uid` int(10) NOT NULL DEFAULT 0,
  `fid` int(10) NOT NULL DEFAULT 0,
  `value` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_cnbya_value_temp` (
  `vid` int(10) NOT NULL,
  `uid` int(10) NOT NULL DEFAULT 0,
  `fid` int(10) NOT NULL DEFAULT 0,
  `value` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_comments` (
  `tid` int(11) NOT NULL,
  `pid` int(11) NOT NULL DEFAULT 0,
  `sid` int(11) NOT NULL DEFAULT 0,
  `datePublished` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `dateModified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `name` varchar(60) NOT NULL DEFAULT '',
  `email` varchar(60) DEFAULT NULL,
  `url` varchar(60) DEFAULT NULL,
  `host_name` varchar(60) DEFAULT NULL,
  `subject` varchar(85) NOT NULL DEFAULT '',
  `comment` text NOT NULL,
  `score` tinyint(4) NOT NULL DEFAULT 0,
  `reason` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_config` (
  `sitename` varchar(255) NOT NULL DEFAULT '',
  `nukeurl` varchar(255) NOT NULL DEFAULT '',
  `site_logo` varchar(255) NOT NULL DEFAULT '',
  `slogan` varchar(255) NOT NULL DEFAULT '',
  `startdate` varchar(50) NOT NULL DEFAULT '',
  `datePublished` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dateModified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `adminmail` varchar(255) NOT NULL DEFAULT '',
  `anonpost` tinyint(1) NOT NULL DEFAULT 0,
  `default_Theme` varchar(255) NOT NULL DEFAULT 'Titanium_Core',
  `foot1` text DEFAULT NULL,
  `foot2` text DEFAULT NULL,
  `foot3` text DEFAULT NULL,
  `commentlimit` int(9) NOT NULL DEFAULT 4096,
  `anonymous` varchar(255) NOT NULL DEFAULT '',
  `minpass` tinyint(1) NOT NULL DEFAULT 5,
  `pollcomm` tinyint(1) NOT NULL DEFAULT 1,
  `articlecomm` tinyint(1) NOT NULL DEFAULT 1,
  `broadcast_msg` tinyint(1) NOT NULL DEFAULT 1,
  `my_headlines` tinyint(1) NOT NULL DEFAULT 1,
  `top` int(3) NOT NULL DEFAULT 10,
  `storyhome` int(2) NOT NULL DEFAULT 10,
  `user_news` tinyint(1) NOT NULL DEFAULT 1,
  `oldnum` int(2) NOT NULL DEFAULT 30,
  `ultramode` tinyint(1) NOT NULL DEFAULT 0,
  `banners` tinyint(1) NOT NULL DEFAULT 1,
  `backend_title` varchar(255) NOT NULL DEFAULT '',
  `backend_language` varchar(10) NOT NULL DEFAULT '',
  `language` varchar(100) NOT NULL DEFAULT '',
  `locale` varchar(10) NOT NULL DEFAULT '',
  `multilingual` tinyint(1) NOT NULL DEFAULT 0,
  `useflags` tinyint(1) NOT NULL DEFAULT 0,
  `notify` tinyint(1) NOT NULL DEFAULT 0,
  `notify_email` varchar(255) NOT NULL DEFAULT '',
  `notify_subject` varchar(255) NOT NULL DEFAULT '',
  `notify_message` varchar(255) NOT NULL DEFAULT '',
  `notify_from` varchar(255) NOT NULL DEFAULT '',
  `moderate` tinyint(1) NOT NULL DEFAULT 0,
  `admingraphic` tinyint(1) NOT NULL DEFAULT 1,
  `httpref` tinyint(1) NOT NULL DEFAULT 1,
  `httprefmax` int(5) NOT NULL DEFAULT 1000,
  `CensorMode` tinyint(1) NOT NULL DEFAULT 3,
  `CensorReplace` varchar(10) NOT NULL DEFAULT '',
  `copyright` text DEFAULT NULL,
  `Version_Num` varchar(10) NOT NULL DEFAULT '',
  `admin_pos` tinyint(1) NOT NULL DEFAULT 1,
  `admin_log_lines` int(11) NOT NULL DEFAULT 0,
  `error_log_lines` int(11) NOT NULL DEFAULT 0,
  `cache_data` mediumblob DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_config` (`sitename`, `nukeurl`, `site_logo`, `slogan`, `startdate`, `datePublished`, `dateModified`, `adminmail`, `anonpost`, `default_Theme`, `foot1`, `foot2`, `foot3`, `commentlimit`, `anonymous`, `minpass`, `pollcomm`, `articlecomm`, `broadcast_msg`, `my_headlines`, `top`, `storyhome`, `user_news`, `oldnum`, `ultramode`, `banners`, `backend_title`, `backend_language`, `language`, `locale`, `multilingual`, `useflags`, `notify`, `notify_email`, `notify_subject`, `notify_message`, `notify_from`, `moderate`, `admingraphic`, `httpref`, `httprefmax`, `CensorMode`, `CensorReplace`, `copyright`, `Version_Num`, `admin_pos`, `admin_log_lines`, `error_log_lines`, `cache_data`) VALUES
('My Site', 'http://dev.thoseguysgaming.86it.us', 'logo.png', '', '01/01/21', '2021-01-01 06:16:00', '2021-01-01 06:16:00', 'webmaster@dev.thoseguysgaming.86it.us', 0, 'Titanium_Core', 'FOOTER LINE 1', 'FOOTER LINE 2', 'FOOTER LINE 3', 4096, 'Anonymous', 5, 1, 1, 1, 1, 5, 5, 1, 30, 1, 1, 'Powered by PHP-Nuke Evolution Xtreme 3.0.1b', 'en-us', 'english', 'en_US', 1, 0, 0, 'webmaster@yourdomain.com', 'Blog for yourprefix.86it.us', 'Hey! You\'ve got a new blog submission for yourprefix.86it.us!', 'WebMaster', 0, 1, 1, 1000, 3, '*****', '', '7.6.0', 1, 0, 0, '');

CREATE TABLE `nuke_confirm` (
  `confirm_id` char(32) NOT NULL DEFAULT '',
  `session_id` char(32) NOT NULL DEFAULT '',
  `code` char(6) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_counter` (
  `type` varchar(80) NOT NULL DEFAULT '',
  `var` varchar(80) NOT NULL DEFAULT '',
  `count` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_counter` (`type`, `var`, `count`) VALUES
('total', 'hits', 0),
('browser', 'Avant', 0),
('browser', 'Camino', 0),
('browser', 'Crazy', 0),
('browser', 'DEVONtech', 0),
('browser', 'Dillo', 0),
('browser', 'Galeon', 0),
('browser', 'ELinks', 0),
('browser', 'Epiphany', 0),
('browser', 'Firefox', 0),
('browser', 'iRider', 0),
('browser', 'K-Meleon', 0),
('browser', 'Konqueror', 0),
('browser', 'Lynx', 0),
('browser', 'Maxthon', 0),
('browser', 'Mozilla', 0),
('browser', 'MSIE', 0),
('browser', 'MultiZilla', 0),
('browser', 'NetCaptor', 0),
('browser', 'Netscape', 0),
('browser', 'OmniWeb', 0),
('browser', 'Opera', 0),
('browser', 'Safari', 0),
('browser', 'Shiira', 0),
('browser', 'Voyager', 0),
('browser', 'w3m', 0),
('browser', 'WAP', 0),
('browser', 'WebWasher', 0),
('browser', 'Bot', 0),
('browser', 'Other', 0),
('os', 'Windows', 0),
('os', 'Linspire', 0),
('os', 'Linux', 0),
('os', 'Mac', 0),
('os', 'FreeBSD', 0),
('os', 'SunOS', 0),
('os', 'IRIX', 0),
('os', 'OS/2', 0),
('os', 'AIX', 0),
('os', 'Other', 0);

CREATE TABLE `nuke_donators` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL DEFAULT 0,
  `uname` varchar(60) NOT NULL DEFAULT '',
  `fname` varchar(25) NOT NULL DEFAULT '',
  `lname` varchar(25) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `donated` decimal(8,2) NOT NULL DEFAULT 0.00,
  `dondate` varchar(255) NOT NULL DEFAULT '',
  `donshow` tinyint(1) NOT NULL DEFAULT 0,
  `uip` varchar(255) NOT NULL DEFAULT '',
  `donok` tinyint(1) NOT NULL DEFAULT 0,
  `msg` text DEFAULT NULL,
  `donto` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_donators_config` (
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_donators_config` (`config_name`, `config_value`) VALUES
('values', '5,10,25,50,100'),
('block_show_amount', 'yes'),
('block_show_anon_amount', 'yes'),
('block_button_image', 'images/donations/paypal.png'),
('block_num_donations', '10'),
('block_show_dates', 'yes'),
('block_message', 'Find our site useful? Make a small donation to show your support.'),
('block_show_goal', 'no'),
('block_scroll', 'yes'),
('block_numbers', 'no'),
('page_num_donations', '25'),
('page_show_anon_amount', 'yes'),
('page_show_amount', 'yes'),
('page_show_dates', 'no'),
('page_header_image', ''),
('gen_pp_email', ''),
('gen_donation_name', 'Site Donation'),
('gen_donation_code', 'site_donation'),
('gen_button_image', 'images/donations/paypal.png'),
('gen_currency', 'USD'),
('gen_monthly_goal', '50.00'),
('gen_date_format', 'm/d/Y'),
('gen_type_private', 'no'),
('gen_type_anon', 'no'),
('gen_thank_image', ''),
('gen_thank_message', 'Thank you for your kind donation!<br /><br />Please come again!'),
('gen_cancel_image', 'images/logo.png'),
('gen_cancel_message', 'Sorry you could not donate!<br /><br />Please come again!'),
('gen_page_image', 'images/logo.png'),
('gen_message', 'yes'),
('gen_codes', ''),
('gen_cookie', 'no');

CREATE TABLE `nuke_ecalendar` (
  `eid` int(11) NOT NULL,
  `month` varchar(11) DEFAULT NULL,
  `day` varchar(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `reoccur` int(11) NOT NULL DEFAULT 0,
  `time` varchar(5) DEFAULT NULL,
  `ampm` tinyint(1) NOT NULL DEFAULT 0,
  `title` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_evolution` (
  `evo_field` varchar(50) NOT NULL DEFAULT '',
  `evo_value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_evolution` (`evo_field`, `evo_value`) VALUES
('sub', 'Xtreme'),
('ver_check', '0'),
('ver_previous', '3.0.1b'),
('lock_modules', '0'),
('queries_count', '1'),
('adminssl', '1'),
('poll_random', '0'),
('poll_days', '30'),
('censor_words', 'ass cuntface balllicker shitbag asshole arse bitch bullshit c0ck clit cock crap cum cunt fag faggot fuck fucker fucking fuk fuking motherfucker pussy shit tits twat'),
('censor', '0'),
('usrclearcache', '1'),
('cache_last_cleared', '1620227074'),
('textarea', 'ckeditor'),
('use_colors', '1'),
('usegfxcheck', '7'),
('codesize', '7'),
('iphub_use', '0'),
('useimage', '1'),
('lazy_tap', '0'),
('img_resize', '1'),
('img_width', '300'),
('img_height', '300'),
('capfile', ''),
('module_collapse', '1'),
('collapse', '0'),
('evouserinfo_ec', '1'),
('collapsetype', '1'),
('analytics', ''),
('img_viewer', 'fancybox'),
('html_auth', '1'),
('pm_alert_status', '1'),
('pm_cookie_name', 'jquery_pm_popup'),
('pm_cookie_minutes', '5'),
('pm_cookie_seconds', '1'),
('pm_overlay_color', '#000000'),
('pm_button_color', '#004594'),
('pm_button_color2', '#006de9'),
('pm_alert_sound', '1'),
('admin_fc_status', '0'),
('admin_fc_attempts', '5'),
('admin_fc_timeout', '15'),
('iphub_status', '0'),
('iphub_key', ''),
('iphub_cookietime', '5'),
('recap_color', ''),
('recap_lang', 'en'),
('recap_site_key', ''),
('recap_priv_key', ''),
('block_cachetime', '86400');

CREATE TABLE `nuke_evo_userinfo` (
  `name` varchar(25) NOT NULL,
  `filename` varchar(25) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `position` int(10) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_evo_userinfo` (`name`, `filename`, `active`, `position`, `image`) VALUES
('Good Afternoon', 'good_afternoon', 1, 1, ''),
('Username', 'username', 0, 2, ''),
('Rank', 'rank', 1, 5, ''),
('Login/logout/register', 'login', 1, 9, ''),
('Current Online', 'online', 1, 19, ''),
('PMs', 'pms', 1, 7, ''),
('Users', 'users', 1, 15, ''),
('Most Ever', 'mostever', 1, 17, ''),
('Members', 'members', 1, 11, ''),
('Avatar', 'avatar', 1, 3, ''),
('Personal Message', 'personal_message', 0, 1, ''),
('Language', 'language', 0, 3, ''),
('Posts', 'posts', 1, 13, ''),
('Break', 'Break', 1, 16, ''),
('Break', 'Break', 1, 14, ''),
('Break', 'Break', 1, 12, ''),
('Break', 'Break', 1, 10, ''),
('Break', 'Break', 1, 8, ''),
('Break', 'Break', 1, 6, ''),
('Break', 'Break', 1, 4, ''),
('Break', 'Break', 1, 2, ''),
('Break', 'Break', 1, 18, '');

CREATE TABLE `nuke_evo_userinfo_addons` (
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_evo_userinfo_addons` (`name`, `value`) VALUES
('good_afternoon_message', 'Good morning %name%:'),
('personal_message_message', '<div style=\"text-align:center\">Hello %name%, <br />\r\nWelcome to %site%.</div>'),
('username_center', 'yes'),
('online_show_hv', 'no'),
('online_scroll', 'no'),
('online_show_members', 'yes'),
('online_tooltip', 'yes'),
('online_country_flag', 'yes'),
('online_user_level_image', 'yes'),
('rank_show_title', 'no'),
('rank_show_2nd', 'no'),
('rank_show_3rd', 'no'),
('rank_show_4th', 'no'),
('rank_show_5th', 'no');

CREATE TABLE `nuke_faqanswer` (
  `id` int(25) NOT NULL,
  `id_cat` int(25) NOT NULL DEFAULT 0,
  `question` varchar(255) DEFAULT '',
  `answer` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_faqanswer` (`id`, `id_cat`, `question`, `answer`) VALUES
(1, 1, 'What are we working on now?', '<p>Right now the development team is working on the core theme for the new release of PHP-Nuke Xtreme that will be coming soon. The name of the theme is <strong>Xtreme Core</strong> as it will be the main template that people will use to build future themes, This theme should have every feature that is available within the CMS release.</p>\n\n<p>You will be able to pick and choose what elements you want to enable on your themes each time you design one.</p>\n\n<p>We are currently working on the menu system at the top of the page, where you see the gold buttons that say Home, Forums, Links, Downloads etc. We are adding the admin code so that when a user is logged in as an admin it will add admin options to each of the menu eares.</p>\n\n<p>&nbsp;</p>');

CREATE TABLE `nuke_faqcategories` (
  `id_cat` tinyint(3) NOT NULL,
  `categories` varchar(255) DEFAULT NULL,
  `flanguage` varchar(30) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_faqcategories` (`id_cat`, `categories`, `flanguage`) VALUES
(1, 'General Q&A', 'english');

CREATE TABLE `nuke_file_repository_categories` (
  `cid` int(11) NOT NULL,
  `cname` varchar(100) NOT NULL,
  `color` varchar(50) NOT NULL,
  `parentid` int(11) NOT NULL DEFAULT 0,
  `permissions` int(11) NOT NULL DEFAULT 0,
  `isallowed` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_file_repository_comments` (
  `cid` int(11) NOT NULL,
  `did` int(11) NOT NULL DEFAULT 0,
  `comment` text DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT '2018-12-12 00:00:00',
  `rating` int(11) NOT NULL DEFAULT 0,
  `uid` int(11) NOT NULL DEFAULT 0,
  `user` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_file_repository_files` (
  `fid` int(11) NOT NULL,
  `did` int(11) NOT NULL,
  `ftitle` varchar(50) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `filesize` int(20) NOT NULL,
  `last_downloaded` datetime NOT NULL DEFAULT '2018-12-12 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_file_repository_items` (
  `cid` int(11) NOT NULL DEFAULT 0,
  `author` varchar(100) NOT NULL DEFAULT '',
  `author_email` varchar(100) NOT NULL DEFAULT '',
  `author_website` varchar(100) NOT NULL DEFAULT '',
  `color` varchar(7) NOT NULL DEFAULT '',
  `currency` varchar(7) NOT NULL DEFAULT '',
  `date` datetime NOT NULL DEFAULT '2018-12-12 00:00:00',
  `description` text DEFAULT NULL,
  `did` int(11) NOT NULL,
  `fixes` longtext DEFAULT NULL,
  `groups` int(11) NOT NULL DEFAULT 0,
  `hits` int(11) NOT NULL DEFAULT 0,
  `isactive` int(11) NOT NULL DEFAULT 0,
  `isapproved` int(11) NOT NULL DEFAULT 0,
  `isbroken` tinyint(1) NOT NULL DEFAULT 0,
  `isfeatured` int(11) NOT NULL DEFAULT 0,
  `isnew` int(11) NOT NULL DEFAULT 0,
  `isupdated` datetime NOT NULL DEFAULT '2018-12-12 00:00:00',
  `lastdownloaded` datetime NOT NULL DEFAULT '2018-12-12 00:00:00',
  `paypal` varchar(255) NOT NULL DEFAULT '',
  `points` int(11) NOT NULL DEFAULT 0,
  `posts` int(11) NOT NULL DEFAULT 0,
  `preview` varchar(255) NOT NULL DEFAULT '',
  `price` int(11) NOT NULL DEFAULT 0,
  `semail` varchar(100) NOT NULL DEFAULT '',
  `sname` varchar(100) NOT NULL DEFAULT '',
  `suid` int(11) NOT NULL DEFAULT 0,
  `title` varchar(100) NOT NULL DEFAULT '',
  `version` varchar(30) NOT NULL DEFAULT '',
  `views` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_file_repository_screenshots` (
  `pid` int(11) NOT NULL,
  `did` int(11) NOT NULL DEFAULT 0,
  `filename` varchar(255) NOT NULL,
  `size` int(11) NOT NULL DEFAULT 0,
  `active` int(11) NOT NULL DEFAULT 1,
  `submitter` varchar(100) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_file_repository_settings` (
  `config_name` varchar(255) NOT NULL,
  `config_value` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_file_repository_settings` (`config_name`, `config_value`) VALUES
('uhead', '1'),
('utext', '0'),
('pophits', '250'),
('version', '1.1.0'),
('usegfxcheck', '1'),
('currency', 'GBP'),
('parse_smilies', '1'),
('date_format', 'M jS, Y g:i a'),
('viewer', 'lightboxevo'),
('developer_mode', '1'),
('overview_display', '1'),
('overview_count', '5'),
('most_popular', '50'),
('download_view', '1'),
('adminBypass', '0'),
('users_can_upload', '1'),
('users_file_upload_amount', '2'),
('users_screens_upload_amount', '3'),
('overview_display_areas', 'newdownloads,mostpopular,statistics'),
('show_legend', '0'),
('allowed_file_extensions', '7z,arj,rar,tar.gz,zip,tar,pdf'),
('allowed_image_extensions', 'jpeg,jpg,png,gif'),
('group_allowed_to_upload', '1');

CREATE TABLE `nuke_file_repository_themes` (
  `theme_name` varchar(255) NOT NULL,
  `cell` int(11) NOT NULL,
  `head` int(11) NOT NULL,
  `per_row` int(11) NOT NULL,
  `show_left` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_file_repository_themes` (`theme_name`, `cell`, `head`, `per_row`, `show_left`) VALUES
('Inferno', 0, 0, 2, 1),
('Titanium_Core', 0, 0, 2, 1);

CREATE TABLE `nuke_headlines` (
  `hid` int(11) NOT NULL,
  `sitename` varchar(30) NOT NULL DEFAULT '',
  `headlinesurl` varchar(200) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_headlines` (`hid`, `sitename`, `headlinesurl`) VALUES
(1, 'AbsoluteGames', 'http://files.gameaholic.com/agfa.rdf'),
(2, 'DailyDaemonNews', 'http://daily.daemonnews.org/ddn.rdf.php3'),
(3, 'FreeDOS', 'http://sourceforge.net/export/rss2_projnews.php?group_id=5109'),
(4, 'LinuxWeelyNews', 'http://lwn.net/headlines/rss'),
(5, 'Listology', 'http://listology.com/recent.rdf'),
(6, 'PHP-Nuke', 'http://phpnuke.org/backend.php'),
(7, 'PerlMonks', 'http://www.perlmonks.org/headlines.rdf'),
(8, 'WebReference', 'http://webreference.com/webreference.rdf');

CREATE TABLE `nuke_hnl_categories` (
  `cid` int(11) NOT NULL,
  `ctitle` varchar(50) NOT NULL DEFAULT '',
  `cdescription` text NOT NULL,
  `cblocklimit` int(4) NOT NULL DEFAULT 10
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_hnl_categories` (`cid`, `ctitle`, `cdescription`, `cblocklimit`) VALUES
(1, '*Unassigned*', 'This is a catch-all category where newsletters can default to or if all other categories are removed.  Do NOT remove this category!  This category of newsletters are only shown to the Admins.  ', 5),
(2, 'Archived Newsletters', 'This category is for newsletter subscribers.', 5),
(3, 'Archived Mass Mails', 'This category is used for mass mails.', 5);

CREATE TABLE `nuke_hnl_cfg` (
  `cfg_nm` varchar(255) NOT NULL DEFAULT '',
  `cfg_val` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_hnl_cfg` (`cfg_nm`, `cfg_val`) VALUES
('debug_mode', 'ERROR'),
('debug_output', 'DISPLAY'),
('show_blocks', '0'),
('dl_module', 'downloads'),
('blk_lmt', '10'),
('scroll', '0'),
('scroll_height', '180'),
('scroll_amt', '2'),
('scroll_delay', '100'),
('version', '1.3.0'),
('show_hits', '0'),
('show_dates', '0'),
('show_sender', '0'),
('show_categories', '0'),
('nsn_groups', '0'),
('latest_news', '5'),
('latest_downloads', '0'),
('latest_links', '5'),
('latest_forums', '5'),
('latest_reviews', '0'),
('wysiwyg_on', '1'),
('wysiwyg_rows', '30');

CREATE TABLE `nuke_hnl_newsletters` (
  `nid` int(11) NOT NULL,
  `cid` int(11) NOT NULL DEFAULT 1,
  `topic` varchar(100) NOT NULL DEFAULT '',
  `sender` varchar(20) NOT NULL DEFAULT '',
  `filename` varchar(32) NOT NULL DEFAULT '',
  `datesent` date DEFAULT NULL,
  `view` int(1) NOT NULL DEFAULT 0,
  `groups` text NOT NULL,
  `hits` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_hnl_newsletters` (`nid`, `cid`, `topic`, `sender`, `filename`, `datesent`, `view`, `groups`, `hits`) VALUES
(1, 1, 'PREVIEW Newsletter File', 'Admin', 'tmp.php', '2018-12-12', 99, '', 0),
(2, 1, 'Tested Email Temporary File', 'Admin', 'testemail.php', '2018-12-12', 99, '', 0);

CREATE TABLE `nuke_honeypot` (
  `id` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `realname` varchar(75) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip` varchar(60) NOT NULL DEFAULT '',
  `date` varchar(50) NOT NULL DEFAULT '',
  `potnum` varchar(1) NOT NULL DEFAULT '',
  `reason` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_honeypot_config` (
  `usehp` tinyint(1) NOT NULL,
  `botlisting` tinyint(1) NOT NULL,
  `perpage` varchar(3) NOT NULL,
  `pagenumberpos` tinyint(1) NOT NULL,
  `headcolor` varchar(7) NOT NULL,
  `rowcolor1` varchar(7) NOT NULL,
  `rowcolor2` varchar(7) NOT NULL,
  `pagebgcolor` varchar(7) NOT NULL,
  `pagebordercolor` varchar(7) NOT NULL,
  `fontcolor` varchar(7) NOT NULL,
  `fontcolor2` varchar(7) NOT NULL,
  `check1` tinyint(1) NOT NULL,
  `check2` tinyint(1) NOT NULL,
  `check3` tinyint(1) NOT NULL,
  `check4` tinyint(1) NOT NULL,
  `check5` tinyint(1) NOT NULL,
  `check6` tinyint(1) NOT NULL,
  `c7opt1` tinyint(1) NOT NULL,
  `c7opt2` tinyint(1) NOT NULL,
  `c7amount` varchar(2) NOT NULL,
  `c8opt1` tinyint(1) NOT NULL,
  `c8opt2` tinyint(1) NOT NULL,
  `usebsapi` tinyint(1) NOT NULL,
  `c8apikey` varchar(255) NOT NULL,
  `fs9opt1` tinyint(1) NOT NULL,
  `fs9opt2` tinyint(1) NOT NULL,
  `fs9apikey` varchar(255) NOT NULL,
  `check3time` varchar(2) NOT NULL,
  `check4question` varchar(255) NOT NULL,
  `check4answer` varchar(255) NOT NULL,
  `usefeedback` tinyint(1) NOT NULL,
  `email` varchar(255) NOT NULL,
  `version` varchar(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_honeypot_config` (`usehp`, `botlisting`, `perpage`, `pagenumberpos`, `headcolor`, `rowcolor1`, `rowcolor2`, `pagebgcolor`, `pagebordercolor`, `fontcolor`, `fontcolor2`, `check1`, `check2`, `check3`, `check4`, `check5`, `check6`, `c7opt1`, `c7opt2`, `c7amount`, `c8opt1`, `c8opt2`, `usebsapi`, `c8apikey`, `fs9opt1`, `fs9opt2`, `fs9apikey`, `check3time`, `check4question`, `check4answer`, `usefeedback`, `email`, `version`) VALUES
(1, 1, '30', 2, '#a92828', '#e48600', '#f8ce55', '#f8ce55', '#a92828', '#000000', '#000000', 1, 1, 1, 0, 1, 1, 1, 1, '5', 0, 0, 0, '', 0, 0, '', '30', '', '', 0, 'ernest.bufffington@gmail.com', '2.2');

CREATE TABLE `nuke_image_repository_settings` (
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_image_repository_settings` (`config_name`, `config_value`) VALUES
('alignment', 'left'),
('basedir', 'modules/Image_Repository/files'),
('spacing', '1'),
('image_view', '2'),
('perpage', '20'),
('admin_perpage', '20'),
('lytebox_color', 'black'),
('allow_colorization', '0'),
('thumb_width', '160'),
('thumb_height', '120'),
('jquery_prefix', 'nuke_jq'),
('pagination', '1'),
('max_upload', '6291456'),
('quota', '524288000');

CREATE TABLE `nuke_image_repository_uploads` (
  `pid` int(20) NOT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `submitter` varchar(255) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `size` int(11) NOT NULL DEFAULT 0,
  `screensize` varchar(255) DEFAULT NULL,
  `uploaded` int(11) NOT NULL DEFAULT 0,
  `bypass_thumb` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_image_repository_users` (
  `uid` int(11) NOT NULL,
  `background_color` varchar(20) DEFAULT NULL,
  `border_color` varchar(20) DEFAULT NULL,
  `border_thickness` varchar(3) DEFAULT NULL,
  `folder` int(11) NOT NULL DEFAULT 0,
  `percent_color` varchar(20) DEFAULT NULL,
  `quota` varchar(255) DEFAULT NULL,
  `quota_request` tinyint(2) NOT NULL DEFAULT 0,
  `custom_color` varchar(7) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_image_repository_users` (`uid`, `background_color`, `border_color`, `border_thickness`, `folder`, `percent_color`, `quota`, `quota_request`, `custom_color`) VALUES
(2, 'firebrick', 'goldenrod', NULL, 10002, 'seagreen', '52428800', 0, ''),
(4, 'white', 'black', NULL, 10004, 'darkorchid', '52428800', 0, NULL),
(6, 'white', 'black', NULL, 10006, 'darkorchid', '52428800', 0, NULL),
(5, 'white', 'black', NULL, 10005, 'darkorchid', '52428800', 0, NULL),
(3, 'white', 'black', NULL, 10003, 'darkorchid', '52428800', 0, NULL),
(11, 'white', 'black', NULL, 10011, 'darkorchid', '52428800', 0, NULL),
(20, 'white', 'black', NULL, 10020, 'darkorchid', '52428800', 0, NULL);

CREATE TABLE `nuke_jmap` (
  `name` varchar(255) NOT NULL DEFAULT '',
  `value` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_jmap` (`name`, `value`) VALUES
('xml', '1'),
('ntopics', '10000'),
('nnews', '10000'),
('ndown', '100000'),
('nrev', '100000'),
('nuser', '10000');

CREATE TABLE `nuke_links_categories` (
  `cid` int(11) NOT NULL,
  `title` varchar(50) NOT NULL DEFAULT '',
  `cdescription` text NOT NULL,
  `parentid` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_links_categories` (`cid`, `title`, `cdescription`, `parentid`) VALUES
(1, 'PHP-Nuke Evolution Xtreme', 'Anything and everything Evolution Xtreme related.', 0),
(2, 'PHP-Nuke', 'Anything and everything PHP-Nuke related.', 0),
(3, 'Exploits', '', 2),
(4, 'User Websites', '', 1),
(5, 'Themes', '', 1),
(6, 'Developer Websites', '', 1),
(7, 'Themes', '', 2),
(8, 'User Websites', '', 2),
(9, 'Developer Websites', '', 2),
(10, 'Open-Source', 'Open Source links and pages.', 0),
(11, 'Programming', 'Everything related to online programming.', 0),
(12, 'Bootstrap', 'Bootstrap, the worldâ€™s most popular framework for building responsive, mobile-first sites, with jsDelivr and a template starter page.', 11);

CREATE TABLE `nuke_links_editorials` (
  `linkid` int(11) NOT NULL DEFAULT 0,
  `adminid` varchar(60) NOT NULL DEFAULT '',
  `editorialtimestamp` datetime NOT NULL DEFAULT '2018-12-12 00:00:00',
  `editorialtext` text NOT NULL,
  `editorialtitle` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_links_editorials` (`linkid`, `adminid`, `editorialtimestamp`, `editorialtext`, `editorialtitle`) VALUES
(2, 'WebMaster', '2021-05-06 05:02:41', 'This is the Test Editorial Text', 'This is a Test Editorial');

CREATE TABLE `nuke_links_links` (
  `lid` int(11) NOT NULL,
  `cid` int(11) NOT NULL DEFAULT 0,
  `sid` int(11) NOT NULL DEFAULT 0,
  `title` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(100) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `date` datetime DEFAULT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `hits` int(11) NOT NULL DEFAULT 0,
  `submitter` varchar(60) NOT NULL DEFAULT '',
  `linkratingsummary` double(6,4) NOT NULL DEFAULT 0.0000,
  `totalvotes` int(11) NOT NULL DEFAULT 0,
  `totalcomments` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_links_links` (`lid`, `cid`, `sid`, `title`, `url`, `description`, `date`, `name`, `email`, `hits`, `submitter`, `linkratingsummary`, `totalvotes`, `totalcomments`) VALUES
(1, 3, 0, 'www.exploit-db.com', 'https://www.exploit-db.com/exploits/29733/', 'PHP-Nuke related exploits.<br /><br />\nName : PHP-Nuke 8.2.4 multiple vulnerabilities<br />\nSoftware : PHP-Nuke 8.2.4 and possibly below.<br />\nVendor Homepage : http://www.phpnuke.org/<br />\nVulnerability Type : File Inclusion and Reflected Cross-Site Scripting<br />\nSeverity : High (4/5)<br />\nAdvisory Reference : SOJOBO-ADV-13-04 (http://www.enkomio.com/Advisories)<br />\nCredits: Sojobo dev team<br />\nDescription: A File Inclusion and Reflected Cross Site Scripting vulnerability was discovered during the testing of Sojobo, Static Analysis Tool.<br />', '2021-04-25 20:09:29', 'Sebastian Buffington', 'ernest.bufffington@gmail.com', 3, '', 0.0000, 0, 0),
(2, 6, 0, 'The 86it Developers Network', 'https://www.86it.us/index.php', 'Programmers Making Connections, Coders Making a Difference.', '2021-04-27 16:59:04', 'Sebastian Buffington', 'ernest.bufffington@gmail.com', 3, '', 10.0000, 6, 5),
(3, 6, 0, 'Lonestar Modules', 'https://lonestar-modules.com/', 'Coding quality Block & Modules for Nuke Evolution Xtreme & Raven Nuke CMS.', '2021-04-27 17:05:00', 'Sebastian Buffington', 'ernest.bufffington@gmail.com', 3, '', 10.0000, 1, 1),
(4, 6, 0, 'HEADSHOT DOMAIN', 'https://www.headshotdomain.net/', 'coRpSE is the author of Nuke Honey Pot v2.2\n\nProgrammer and Gamer aka Dreaded coRpSE', '2021-04-27 17:08:46', 'Sebastian Buffington', 'ernest.bufffington@gmail.com', 2, '', 0.0000, 0, 0),
(5, 1, 0, 'Evolution Xtreme (UK Version)', 'https://evolution-xtreme.co.uk/', 'This is the main developers website for the UK version of Nuke Evolution Xtreme.', '2021-04-28 23:37:09', 'Brandon Maintenance Management, LLC', 'ernest.bufffington@gmail.com', 4, '', 0.0000, 0, 0),
(6, 1, 0, 'Evolution Xtreme (US Version)', 'https://dev-php-nuke-evolution-xtreme.86it.us', 'This is 1 of 2 developer sites in the US for PHP-Nuke Evolution Xtreme. This is not to be confused with the UK Developer website. The US version is very very different and has many many things updated and changed.\n\nBlocks and Modules are compatible however themes are not. Themes can easily be ported over to the US version but you will have to add in all the features the US version of Xtreme has added.', '2021-04-28 23:43:33', 'Brandon Maintenance Management, LLC', 'ernest.bufffington@gmail.com', 1, '', 10.0000, 1, 1),
(7, 4, 0, 'Canadian Clan', 'https://www.canadianclan.ca/', 'CnC Gaming Clan', '2021-04-29 07:11:57', 'Brandon Maintenance Management, LLC', 'ernest.bufffington@gmail.com', 4, '', 0.0000, 0, 0),
(8, 4, 0, 'OUTKASTS [OKT]', 'https://outkasts.eu/index.php', 'A Gameing Community Website', '2021-04-29 23:34:19', 'Ernest Buffington', 'ernest.bufffington@gmail.com', 2, '', 0.0000, 0, 0),
(9, 4, 0, 'TNO The New World Order', 'http://www.tnogaming.com/', 'A gaming website. This website does not have an SSL certificate so remember when making an account to not use one of your secured passwords. Maybe later he will use the auto SSL feature in his web hosting panel. Until then please remember to use a password that is not your normal secured password that you would use on all your secured websites.', '2021-04-29 23:55:55', 'Ernest Buffington', 'ernest.bufffington@gmail.com', 1, '', 0.0000, 0, 0),
(10, 4, 0, 'GLOBAL CORE GAMERS', 'https://gcg.megasportal.co.uk/index.php', 'A Small Gaming Community.', '2021-05-02 18:31:23', 'Brandon Maintenance Management, LLC', 'ernest.bufffington@gmail.com', 0, '', 0.0000, 0, 0),
(11, 6, 0, 'BCU Veterans', 'https://www.bcuveterans.co.uk/index.php', 'An Online Gaming Website', '2021-05-02 18:39:48', 'Brandon Maintenance Management, LLC', 'ernest.bufffington@gmail.com', 1, '', 0.0000, 0, 0),
(12, 10, 0, 'Freshmeat', 'http://freshmeat.sourceforge.net/', 'Freshmeat currently uses the SourceForge site.', '2021-05-05 21:30:23', 'Brandon Maintenance Management, LLC', 'ernest.bufffington@gmail.com', 1, '', 1.0000, 1, 1);

CREATE TABLE `nuke_links_modrequest` (
  `requestid` int(11) NOT NULL,
  `lid` int(11) NOT NULL DEFAULT 0,
  `cid` int(11) NOT NULL DEFAULT 0,
  `sid` int(11) NOT NULL DEFAULT 0,
  `title` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(100) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `modifysubmitter` varchar(60) NOT NULL DEFAULT '',
  `brokenlink` int(3) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_links_newlink` (
  `lid` int(11) NOT NULL,
  `cid` int(11) NOT NULL DEFAULT 0,
  `sid` int(11) NOT NULL DEFAULT 0,
  `title` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(100) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `submitter` varchar(60) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_links_newlink` (`lid`, `cid`, `sid`, `title`, `url`, `description`, `name`, `email`, `submitter`) VALUES
(2, 12, 0, 'Bootstrap Introduction Page', 'https://getbootstrap.com/docs/5.0/getting-started/introduction/', 'Get started with Bootstrap, the worldâ€™s most popular framework for building responsive, mobile-first sites, with jsDelivr and a template starter page.', 'TheGhost', 'ernest.bufffington@gmail.com', '');

CREATE TABLE `nuke_links_votedata` (
  `ratingdbid` int(11) NOT NULL,
  `ratinglid` int(11) NOT NULL DEFAULT 0,
  `ratinguser` varchar(60) NOT NULL DEFAULT '',
  `rating` int(11) NOT NULL DEFAULT 0,
  `ratinghostname` varchar(60) NOT NULL DEFAULT '',
  `ratingcomments` text NOT NULL,
  `ratingtimestamp` datetime NOT NULL DEFAULT '2018-12-12 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_links_votedata` (`ratingdbid`, `ratinglid`, `ratinguser`, `rating`, `ratinghostname`, `ratingcomments`, `ratingtimestamp`) VALUES
(1, 2, 'WebMaster', 10, '47.206.216.196', 'Awesome peeps, great programmers.', '2021-04-27 16:59:51'),
(2, 3, 'TheGhost', 10, '47.206.216.196', 'Good Peeps awesome site!', '2021-05-06 02:45:16'),
(3, 2, 'TheGhost', 10, '47.206.216.196', 'I really think this website is awesome!', '2021-05-06 03:17:24'),
(4, 2, 'ScottyBcoder', 10, '47.206.216.196', 'Friendly folks, a great bunch of folks!', '2021-05-06 03:18:13'),
(5, 2, 'TheWolf', 10, '47.206.216.196', 'The best!', '2021-05-06 03:21:18'),
(6, 2, 'Shakey', 10, '47.206.216.196', 'My Nephew is the best!', '2021-05-06 03:22:08'),
(7, 2, 'Anonymous', 10, '47.206.216.196', '', '2021-05-06 03:25:10'),
(8, 12, 'TheGhost', 1, '47.206.216.196', 'They got lazy and stopped maintaining their site. I give them an F!', '2021-05-06 08:28:30'),
(9, 6, 'cube', 10, '173.168.244.204', 'This is the best CMS software I have seen yet.', '2021-05-07 08:46:35');

CREATE TABLE `nuke_link_us` (
  `id` int(255) NOT NULL,
  `site_name` varchar(60) NOT NULL DEFAULT '',
  `site_url` varchar(255) NOT NULL DEFAULT '',
  `site_image` varchar(255) NOT NULL DEFAULT '',
  `site_description` text NOT NULL,
  `site_hits` int(10) NOT NULL DEFAULT 0,
  `site_status` int(1) NOT NULL DEFAULT 0,
  `date_added` varchar(255) NOT NULL DEFAULT '',
  `button_type` smallint(1) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `user_name` varchar(60) NOT NULL DEFAULT '',
  `user_email` varchar(60) NOT NULL DEFAULT '',
  `user_ip` varchar(20) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_link_us` (`id`, `site_name`, `site_url`, `site_image`, `site_description`, `site_hits`, `site_status`, `date_added`, `button_type`, `user_id`, `user_name`, `user_email`, `user_ip`) VALUES
(1, 'Headshotdomain', 'https://www.headshotdomain.net', 'images/evo/headshotdomain.gif', '[HSX] is a multi gaming clan that is involved with a bunch of games and our library is always adding new games.\nWe are a bunch of people that just like to hang out and have fun playing games.', 16, 1, '1542823866', 1, 2, '', '', '82.5.206.228'),
(2, 'Lonestar Modules', 'https://lonestar-modules.com', 'images/evo/lonestarmodules.gif', 'Coding quality Block & Modules for Nuke Evolution Xtreme & Raven Nuke CMS.', 10, 1, '1542823990', 1, 2, 'Administrator', '', '82.5.206.228'),
(3, 'ViZual DeZinez', 'https://vizual-dezinez.86it.us', 'images/evo/vd88x31.gif', 'Web Design and Development. We design and code custom addons, themes, blocks, modules, banners and more.', 11, 1, '1542824042', 1, 2, 'Administrator', '', '82.5.206.228'),
(4, 'Mega Portal', 'http://www.megasportal.co.uk', 'images/evo/megasportal.gif', 'Custom graphic designs and more.', 7, 1, '1542824429', 1, 2, 'Administrator', '', '82.5.206.228');

CREATE TABLE `nuke_link_us_config` (
  `my_image` varchar(255) NOT NULL DEFAULT '',
  `fade_effect` smallint(1) NOT NULL DEFAULT 0,
  `marquee` smallint(1) NOT NULL DEFAULT 0,
  `marquee_direction` smallint(1) NOT NULL DEFAULT 0,
  `marquee_scroll` smallint(1) NOT NULL DEFAULT 0,
  `block_height` smallint(1) NOT NULL DEFAULT 0,
  `show_clicks` smallint(1) NOT NULL DEFAULT 0,
  `button_seperate` smallint(1) NOT NULL DEFAULT 0,
  `user_submit` smallint(1) NOT NULL DEFAULT 0,
  `button_method` smallint(1) NOT NULL DEFAULT 0,
  `button_height` tinyint(4) NOT NULL DEFAULT 0,
  `button_banner_height` tinyint(4) NOT NULL DEFAULT 0,
  `button_ressource_height` tinyint(4) NOT NULL DEFAULT 0,
  `button_width` tinyint(4) NOT NULL DEFAULT 0,
  `button_banner_width` tinyint(4) NOT NULL DEFAULT 0,
  `button_ressource_width` tinyint(4) NOT NULL DEFAULT 0,
  `upload_file` varchar(255) NOT NULL DEFAULT '',
  `button_standard` smallint(1) NOT NULL DEFAULT 0,
  `button_banner` smallint(1) NOT NULL DEFAULT 0,
  `button_resource` smallint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_link_us_config` (`my_image`, `fade_effect`, `marquee`, `marquee_direction`, `marquee_scroll`, `block_height`, `show_clicks`, `button_seperate`, `user_submit`, `button_method`, `button_height`, `button_banner_height`, `button_ressource_height`, `button_width`, `button_banner_width`, `button_ressource_width`, `upload_file`, `button_standard`, `button_banner`, `button_resource`) VALUES
('images/evo/minilogo.gif', 1, 1, 1, 2, 3, 1, 1, 1, 0, 31, 45, 31, 88, 127, 88, 'modules/Link_Us/buttons/', 1, 1, 1);

CREATE TABLE `nuke_main` (
  `main_module` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_main` (`main_module`) VALUES
('Blog');

CREATE TABLE `nuke_menu` (
  `groupmenu` int(2) NOT NULL DEFAULT 0,
  `name` varchar(200) DEFAULT NULL,
  `image` varchar(99) DEFAULT NULL,
  `lien` text DEFAULT NULL,
  `hr` char(2) DEFAULT NULL,
  `center` char(2) DEFAULT NULL,
  `bgcolor` tinytext DEFAULT NULL,
  `invisible` int(1) NOT NULL DEFAULT 0,
  `class` tinytext DEFAULT NULL,
  `bold` char(2) DEFAULT NULL,
  `new` char(2) DEFAULT NULL,
  `listbox` char(2) DEFAULT NULL,
  `dynamic` char(2) DEFAULT NULL,
  `date_debut` bigint(20) NOT NULL DEFAULT 0,
  `date_fin` bigint(20) NOT NULL DEFAULT 0,
  `days` varchar(8) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_menu` (`groupmenu`, `name`, `image`, `lien`, `hr`, `center`, `bgcolor`, `invisible`, `class`, `bold`, `new`, `listbox`, `dynamic`, `date_debut`, `date_fin`, `days`) VALUES
(2, 'Network Modules', 'flourecent_module_page_05.png', '', 'on', '', '', 1, 'categories', 'on', '', '', 'on', 0, 0, ''),
(3, 'Standard Modules', 'yellow_module_page_05.png', '', 'on', '', '', 1, 'categories', 'on', '', '', '', 0, 0, ''),
(4, 'Developer Modules', 'babyblue_module_page_05.png', '', 'on', '', '', 1, 'categories', 'on', '', '', '', 0, 0, ''),
(99, '', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '', 0, 0, NULL);

CREATE TABLE `nuke_menu_categories` (
  `id` int(11) NOT NULL,
  `date_fin` bigint(20) NOT NULL DEFAULT 0,
  `date_debut` bigint(20) NOT NULL DEFAULT 0,
  `sublevel` tinyint(3) NOT NULL DEFAULT 0,
  `groupmenu` int(2) NOT NULL DEFAULT 0,
  `module` varchar(50) NOT NULL DEFAULT '',
  `url` text NOT NULL,
  `url_text` text NOT NULL,
  `image` varchar(50) NOT NULL DEFAULT '',
  `new` char(2) DEFAULT NULL,
  `new_days` tinyint(4) NOT NULL DEFAULT -1,
  `class` varchar(20) DEFAULT NULL,
  `bold` char(2) DEFAULT NULL,
  `days` varchar(8) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_menu_categories` (`id`, `date_fin`, `date_debut`, `sublevel`, `groupmenu`, `module`, `url`, `url_text`, `image`, `new`, `new_days`, `class`, `bold`, `days`) VALUES
(1109, 0, 0, 0, 2, 'Network_Advertising', '', '', 'tree-greenT.png', '', 3, 'modules', 'on', ''),
(1110, 0, 0, 0, 2, 'Network_Projects', '', '', 'tree-greenT.png', '', 3, 'modules', 'on', ''),
(1111, 0, 0, 0, 2, 'External Link', 'https://github.com/ernestbuffington/dev-php-nuke-evolution-xtreme', 'US Xtreme Repo', 'tree-greenT.png', '', 3, 'modules', 'on', ''),
(1112, 0, 0, 0, 2, 'Network', '', '', 'tree-green-L.png', '', 3, 'modules', 'on', ''),
(1113, 0, 0, 0, 3, 'Advertising', '', '', 'tree-yellowT.png', '', 3, 'modules', 'on', ''),
(1114, 0, 0, 0, 3, 'Arcade_Tweaks', '', '', 'tree-yellowT.png', '', 3, 'modules', 'on', ''),
(1115, 0, 0, 0, 3, 'Content', '', '', 'tree-yellowT.png', '', 3, 'modules', 'on', ''),
(1116, 0, 0, 0, 3, 'Docs', '', '', 'tree-yellowT.png', '', 3, 'modules', 'on', ''),
(1117, 0, 0, 0, 3, 'Donations', '', '', 'tree-yellowT.png', '', 3, 'modules', 'on', ''),
(1118, 0, 0, 0, 3, 'ECalendar', '', '', 'tree-yellowT.png', '', 3, 'modules', 'on', ''),
(1119, 0, 0, 0, 3, 'FAQ', '', '', 'tree-yellowT.png', '', 3, 'modules', 'on', ''),
(1120, 0, 0, 0, 3, 'Feedback', '', '', 'tree-yellowT.png', '', 3, 'modules', 'on', ''),
(1121, 0, 0, 0, 3, 'File_Repository', '', '', 'tree-yellowT.png', '', 3, 'modules', 'on', ''),
(1122, 0, 0, 0, 3, 'Forums', '', '', 'tree-yellowT.png', '', 3, 'modules', 'on', ''),
(1123, 0, 0, 0, 3, 'Google-Site-Map', '', '', 'tree-yellowT.png', '', 3, 'modules', 'on', ''),
(1124, 0, 0, 0, 3, 'Groups', '', '', 'tree-yellowT.png', '', 3, 'modules', 'on', ''),
(1125, 0, 0, 0, 3, 'HTML_Newsletter', '', '', 'tree-yellowT.png', '', 3, 'modules', 'on', ''),
(1126, 0, 0, 0, 3, 'Image_Repository', '', '', 'tree-yellowT.png', '', 3, 'modules', 'on', ''),
(1127, 0, 0, 0, 3, 'Link_Us', '', '', 'tree-yellowT.png', '', 3, 'modules', 'on', ''),
(1128, 0, 0, 0, 3, 'Members_List', '', '', 'tree-yellowT.png', '', 3, 'modules', 'on', ''),
(1129, 0, 0, 0, 3, 'NukeSentinel', '', '', 'tree-yellowT.png', '', 3, 'modules', 'on', ''),
(1130, 0, 0, 0, 3, 'Network_Bookmarks', '', '', 'tree-yellowT.png', '', 3, 'modules', 'on', ''),
(1131, 0, 0, 0, 3, 'Private_Messages', '', '', 'tree-yellowT.png', '', 3, 'modules', 'on', ''),
(1132, 0, 0, 0, 3, 'Profile', '', '', 'tree-yellowT.png', '', 3, 'modules', 'on', ''),
(1133, 0, 0, 0, 3, 'Recommend_Us', '', '', 'tree-yellowT.png', '', 3, 'modules', 'on', ''),
(1134, 0, 0, 0, 3, 'Reviews', '', '', 'tree-yellowT.png', '', 3, 'modules', 'on', ''),
(1135, 0, 0, 0, 3, 'Search', '', '', 'tree-yellowT.png', '', 3, 'modules', 'on', ''),
(1136, 0, 0, 0, 3, 'Shout_Box', '', '', 'tree-yellowT.png', '', 3, 'modules', 'on', ''),
(1137, 0, 0, 0, 3, 'Spambot_Killer', '', '', 'tree-yellowT.png', '', 3, 'modules', 'on', ''),
(1138, 0, 0, 0, 3, 'Statistics', '', '', 'tree-yellowT.png', '', 3, 'modules', 'on', ''),
(1139, 0, 0, 0, 3, 'Surveys', '', '', 'tree-yellowT.png', '', 3, 'modules', 'on', ''),
(1140, 0, 0, 0, 3, 'Web_Links', '', '', 'tree-yellowT.png', '', 3, 'modules', 'on', ''),
(1141, 0, 0, 0, 3, 'Your_Account', '', '', 'tree-yellow-L.png', '', 3, 'modules', 'on', ''),
(1142, 0, 0, 0, 4, 'cPanel_Login', '', '', 'tree-lightblueT.png', '', 3, 'modules', 'on', ''),
(1143, 0, 0, 0, 4, 'CSS_Color_Chart', '', '', 'tree-lightblueT.png', '', 3, 'modules', 'on', ''),
(1144, 0, 0, 0, 4, 'CSS_Reference', '', '', 'tree-lightblueT.png', '', 3, 'modules', 'on', ''),
(1145, 0, 0, 0, 4, 'Loan', '', '', 'tree-lightblue-L.png', '', 3, 'modules', 'on', '');

CREATE TABLE `nuke_message` (
  `mid` int(11) NOT NULL,
  `title` varchar(100) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `date` varchar(14) NOT NULL DEFAULT '',
  `expire` int(7) NOT NULL DEFAULT 0,
  `active` int(1) NOT NULL DEFAULT 1,
  `view` int(1) NOT NULL DEFAULT 1,
  `groups` text NOT NULL,
  `mlanguage` varchar(30) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_message` (`mid`, `title`, `content`, `date`, `expire`, `active`, `view`, `groups`, `mlanguage`) VALUES
(1, 'This website is in Development mode.', '<p>We hope to have a production release available soon. Thank you for being patient and if you see any problems or would like to report a bug please feel free to do so. We appreciate all the help we can get. The current version running on this website is PHP-Nuke Evolution Xtreme v3.0.1b.</p>\n\n<p>Thanks,<br />\nThe 86it Dev Team</p>\n\n<p>&nbsp;</p>', '1620541700', 0, 1, 1, '', 'english');

CREATE TABLE `nuke_meta` (
  `meta_name` varchar(50) NOT NULL DEFAULT '',
  `meta_content` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_meta` (`meta_name`, `meta_content`) VALUES
('resource-type', 'document'),
('distribution', 'global'),
('author', 'PHP-Nuke Evolution Xtreme'),
('copyright', 'Copyright (c) by PHP-Nuke Evolution Xtreme'),
('keywords', 'Ernest, Buffington, 86it, 86it.us, PHP-Nuke-Evolution-Xtreme, evo, pne, evolution, nuke, php-nuke, software, downloads, community, forums, bulletin, boards, cms, nuke-evo, phpnuke, xtreme'),
('description', 'PHP-Nuke Evolution Xtreme'),
('robots', 'index, follow'),
('revisit-after', '1 days'),
('rating', 'general'),
('facebook-domain-verification', 'get verfied and put your key here');

CREATE TABLE `nuke_modules` (
  `mid` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `custom_title` varchar(255) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 0,
  `view` tinyint(4) NOT NULL DEFAULT 0,
  `inmenu` tinyint(4) NOT NULL DEFAULT 1,
  `pos` tinyint(4) NOT NULL DEFAULT 0,
  `cat_id` tinyint(4) NOT NULL DEFAULT 0,
  `blocks` tinyint(4) NOT NULL DEFAULT 1,
  `admins` varchar(255) NOT NULL DEFAULT '',
  `groups` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_modules` (`mid`, `title`, `custom_title`, `active`, `view`, `inmenu`, `pos`, `cat_id`, `blocks`, `admins`, `groups`) VALUES
(1, 'Forums', 'Forums', 1, 1, 1, 3, 3, 0, '', 'Array'),
(2, 'File_Repository', 'File Repository', 1, 1, 1, 0, 5, 3, '', 'Array'),
(3, 'Your_Account', 'Your Account', 1, 0, 1, 3, 2, 3, '', 'Array'),
(4, 'Shout_Box', 'Shout Box', 1, 1, 1, 5, 3, 3, '', 'Array'),
(5, 'Advertising', 'Advertising', 1, 1, 1, 22, 7, 3, '', 'Array'),
(6, 'ECalendar', 'ECalendar', 1, 1, 1, 21, 7, 3, '', 'Array'),
(7, 'Content', 'Content', 1, 1, 1, 0, 3, 3, '', 'Array'),
(8, 'Docs', 'Docs', 1, 1, 1, 23, 7, 3, '', 'Array'),
(9, 'Donations', 'Donations', 1, 1, 1, 1, 3, 3, '', 'Array'),
(10, 'Evo_UserBlock', 'Evo UserBlock', 1, 0, 1, 27, 7, 1, '', ''),
(11, 'FAQ', 'FAQ', 1, 1, 1, 26, 7, 3, '', 'Array'),
(12, 'Feedback', 'Feedback', 1, 1, 1, 2, 3, 3, '', 'Array'),
(13, 'Groups', 'Groups', 1, 1, 1, 4, 3, 0, '', 'Array'),
(14, 'HTML_Newsletter', 'HTML Newsletter', 1, 1, 1, 25, 7, 3, '', 'Array'),
(15, 'Link_Us', 'Link Us', 1, 1, 1, 24, 7, 3, '', 'Array'),
(16, 'Members_List', 'Members List', 1, 1, 1, 0, 2, 0, '', 'Array'),
(18, 'NukeSentinel', 'NukeSentinel', 1, 1, 1, 20, 7, 3, '', 'Array'),
(19, 'Private_Messages', 'Private Messages', 1, 3, 1, 2, 2, 3, '', 'Array'),
(20, 'Profile', 'Profile', 1, 0, 1, 1, 2, 3, '', 'Array'),
(21, 'Recommend_Us', 'Recommend Us', 1, 1, 1, 17, 7, 3, '', 'Array'),
(22, 'Reviews', 'Reviews', 1, 1, 1, 16, 7, 3, '', 'Array'),
(23, 'Search', 'Search', 1, 1, 1, 15, 7, 3, '', 'Array'),
(25, 'Spambot_Killer', 'Spambot Killer', 1, 1, 1, 14, 7, 3, '', 'Array'),
(26, 'Statistics', 'Statistics', 1, 1, 1, 18, 7, 3, '', 'Array'),
(30, 'Surveys', 'Surveys', 1, 1, 1, 19, 7, 3, '', 'Array'),
(33, 'Web_Links', 'Web Links', 1, 1, 1, 1, 5, 3, '', 'Array'),
(34, 'Image_Repository', 'Image Repository', 1, 3, 1, 0, 7, 3, '', 'Array'),
(36, 'Arcade_Tweaks', 'Arcade Tweaks', 1, 1, 1, 1, 7, 3, '', 'Array'),
(37, 'Blog', 'Blog', 1, 0, 1, 2, 7, 3, '', 'Array'),
(38, 'Blog_Archive', 'Blog Archive', 1, 1, 1, 3, 7, 3, '', 'Array'),
(39, 'Blog_Submit', 'Blog Submit', 1, 1, 1, 4, 7, 3, '', 'Array'),
(40, 'Blog_Top', 'Blog Top 10', 1, 1, 1, 5, 7, 3, '', 'Array'),
(41, 'Blog_Topics', 'Blog Topics', 1, 1, 1, 6, 7, 3, '', 'Array'),
(44, 'Loan', 'Loan Amortization', 1, 1, 1, 7, 7, 3, '', 'Array'),
(45, 'Network', 'Network Disclaimer', 1, 1, 1, 8, 7, 3, '', 'Array'),
(46, 'Network_Bookmarks', 'Network Bookmarks', 1, 3, 1, 9, 7, 3, '', 'Array'),
(48, 'cPanel_Login', 'cPanel Login', 1, 1, 1, 10, 7, 3, '', 'Array'),
(51, 'Google-Site-Map', 'Google Site Map', 1, 1, 1, 11, 7, 3, '', 'Array'),
(52, 'Network_Advertising', 'Network Advertising', 1, 1, 1, 12, 7, 3, '', 'Array'),
(56, 'Network_Projects', 'Network Projects', 1, 1, 1, 13, 7, 3, '', 'Array');

CREATE TABLE `nuke_modules_cat` (
  `cid` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `image` text NOT NULL,
  `pos` tinyint(4) NOT NULL DEFAULT 0,
  `link_type` tinyint(4) NOT NULL DEFAULT 0,
  `link` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_modules_cat` (`cid`, `name`, `image`, `pos`, `link_type`, `link`) VALUES
(1, 'Home', 'home.png', 0, 2, 'index.php'),
(2, 'Members', 'members.png', 1, 0, ''),
(3, 'Community', 'community.png', 2, 0, ''),
(4, 'Statistics', 'poll.png', 3, 0, ''),
(5, 'Files &amp; Links', 'web.png', 4, 0, ''),
(6, 'News', 'news.png', 5, 0, ''),
(7, 'Other', 'general.png', 6, 0, '');

CREATE TABLE `nuke_modules_links` (
  `lid` int(10) UNSIGNED NOT NULL,
  `title` varchar(30) NOT NULL,
  `link_type` tinyint(4) NOT NULL DEFAULT 0,
  `link` varchar(255) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 0,
  `view` tinyint(4) NOT NULL DEFAULT 0,
  `pos` tinyint(4) NOT NULL DEFAULT 0,
  `cat_id` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_modules_links` (`lid`, `title`, `link_type`, `link`, `active`, `view`, `pos`, `cat_id`) VALUES
(2, 'Home', 1, 'index.php', 1, 0, 0, 1);

CREATE TABLE `nuke_mostonline` (
  `total` int(10) NOT NULL DEFAULT 0,
  `members` int(10) NOT NULL DEFAULT 0,
  `nonmembers` int(10) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_mostonline` (`total`, `members`, `nonmembers`) VALUES
(5, 4, 1);

CREATE TABLE `nuke_nsncb_blocks` (
  `rid` tinyint(2) NOT NULL DEFAULT 0,
  `cgid` tinyint(2) NOT NULL DEFAULT 0,
  `cbid` tinyint(2) NOT NULL DEFAULT 0,
  `title` varchar(60) NOT NULL DEFAULT '',
  `filename` varchar(255) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `wtype` tinyint(1) NOT NULL DEFAULT 0,
  `width` smallint(6) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_nsncb_blocks` (`rid`, `cgid`, `cbid`, `title`, `filename`, `content`, `wtype`, `width`) VALUES
(1, 1, 1, 'Place Holder', '', 'This is only a place holder', 1, 25),
(2, 1, 2, 'Place Holder', '', 'This is only a place holder', 1, 25),
(3, 1, 3, 'Place Holder', '', 'This is only a place holder', 1, 25),
(4, 1, 4, 'Place Holder', '', 'This is only a place holder', 1, 25),
(5, 2, 1, 'Place Holder', '', 'This is only a place holder', 1, 25),
(6, 2, 2, 'Place Holder', '', 'This is only a place holder', 1, 25),
(7, 2, 3, 'Place Holder', '', 'This is only a place holder', 1, 25),
(8, 2, 4, 'Place Holder', '', 'This is only a place holder', 1, 25),
(9, 3, 1, 'Place Holder', '', 'This is only a place holder', 1, 25),
(10, 3, 2, 'Place Holder', '', 'This is only a place holder', 1, 25),
(11, 3, 3, 'Place Holder', '', 'This is only a place holder', 1, 25),
(12, 3, 4, 'Place Holder', '', 'This is only a place holder', 1, 25),
(13, 4, 1, 'Place Holder', '', 'This is only a place holder', 1, 25),
(14, 4, 2, 'Place Holder', '', 'This is only a place holder', 1, 25),
(15, 4, 3, 'Place Holder', '', 'This is only a place holder', 1, 25),
(16, 4, 4, 'Place Holder', '', 'This is only a place holder', 1, 25);

CREATE TABLE `nuke_nsncb_config` (
  `cgid` tinyint(1) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `height` smallint(6) NOT NULL,
  `count` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_nsncb_config` (`cgid`, `enabled`, `height`, `count`) VALUES
(1, 0, 0, 0),
(2, 0, 0, 0),
(3, 0, 0, 0),
(4, 0, 0, 0);

CREATE TABLE `nuke_nsnne_config` (
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_nsnne_config` (`config_name`, `config_value`) VALUES
('columns', '0'),
('readmore', '0'),
('texttype', '0'),
('notifyauth', '0'),
('homenumber', '0'),
('hometopic', '0'),
('version_number', '1.1.6');

CREATE TABLE `nuke_nsnsp_config` (
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_nsnsp_config` (`config_name`, `config_value`) VALUES
('require_user', '1'),
('image_type', '0'),
('max_width', '88'),
('max_height', '31'),
('version_number', '1.3.0');

CREATE TABLE `nuke_nsnsp_sites` (
  `site_id` int(11) NOT NULL,
  `site_name` varchar(60) NOT NULL DEFAULT '',
  `site_url` varchar(255) NOT NULL DEFAULT '',
  `site_image` varchar(255) NOT NULL DEFAULT '',
  `site_status` int(1) NOT NULL DEFAULT 0,
  `site_hits` int(10) NOT NULL DEFAULT 0,
  `site_date` date NOT NULL DEFAULT '2018-12-12',
  `site_description` text NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `user_name` varchar(60) NOT NULL DEFAULT '',
  `user_email` varchar(60) NOT NULL DEFAULT '',
  `user_ip` varchar(20) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_nsnst_admins` (
  `aid` varchar(25) NOT NULL DEFAULT '',
  `login` varchar(25) NOT NULL DEFAULT '',
  `password` varchar(20) NOT NULL DEFAULT '',
  `password_md5` varchar(60) NOT NULL DEFAULT '',
  `password_crypt` varchar(60) NOT NULL DEFAULT '',
  `protected` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_nsnst_blocked_ips` (
  `ip_addr` varchar(15) NOT NULL DEFAULT '',
  `ip_long` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `username` varchar(60) NOT NULL DEFAULT 'Anonymous',
  `user_agent` text NOT NULL,
  `date` int(20) NOT NULL DEFAULT 0,
  `notes` text NOT NULL,
  `reason` tinyint(1) NOT NULL DEFAULT 0,
  `query_string` text NOT NULL,
  `get_string` text NOT NULL,
  `post_string` text NOT NULL,
  `x_forward_for` varchar(32) NOT NULL DEFAULT 'None',
  `client_ip` varchar(32) NOT NULL DEFAULT 'None',
  `remote_addr` varchar(32) NOT NULL DEFAULT '',
  `remote_port` varchar(11) NOT NULL DEFAULT 'Unknown',
  `request_method` varchar(10) NOT NULL DEFAULT '',
  `expires` int(20) NOT NULL DEFAULT 0,
  `c2c` char(2) NOT NULL DEFAULT '00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_nsnst_blocked_ranges` (
  `ip_lo` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `ip_hi` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `date` int(20) NOT NULL DEFAULT 0,
  `notes` text NOT NULL,
  `reason` tinyint(1) NOT NULL DEFAULT 0,
  `expires` int(20) NOT NULL DEFAULT 0,
  `c2c` char(2) NOT NULL DEFAULT '00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_nsnst_blockers` (
  `blocker` int(4) NOT NULL DEFAULT 0,
  `block_name` varchar(20) NOT NULL DEFAULT '',
  `activate` int(4) NOT NULL DEFAULT 0,
  `block_type` int(4) NOT NULL DEFAULT 0,
  `email_lookup` int(4) NOT NULL DEFAULT 0,
  `forward` varchar(255) NOT NULL DEFAULT '',
  `reason` varchar(20) NOT NULL DEFAULT '',
  `template` varchar(255) NOT NULL DEFAULT '',
  `duration` int(20) NOT NULL DEFAULT 0,
  `htaccess` int(4) NOT NULL DEFAULT 0,
  `list` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_nsnst_blockers` (`blocker`, `block_name`, `activate`, `block_type`, `email_lookup`, `forward`, `reason`, `template`, `duration`, `htaccess`, `list`) VALUES
(0, 'other', 0, 0, 0, '', 'Abuse-Other', 'abuse_default.tpl', 0, 0, ''),
(1, 'union', 5, 0, 2, '', 'Abuse-Union', 'abuse_union.tpl', 0, 0, ''),
(2, 'clike', 5, 0, 2, '', 'Abuse-CLike', 'abuse_clike.tpl', 0, 0, ''),
(3, 'harvester', 0, 0, 0, '', 'Abuse-Harvest', 'abuse_harvester.tpl', 0, 0, '@yahoo.com\r\nalexibot\r\nalligator\r\nanonymiz\r\nasterias\r\nbackdoorbot\r\nblack hole\r\nblackwidow\r\nblowfish\r\nbotalot\r\nbuiltbottough\r\nbullseye\r\nbunnyslippers\r\ncatch\r\ncegbfeieh\r\ncharon\r\ncheesebot\r\ncherrypicker\r\nchinaclaw\r\ncombine\r\ncopyrightcheck\r\ncosmos\r\ncrescent\r\ncurl\r\ndbrowse\r\ndisco\r\ndittospyder\r\ndlman\r\ndnloadmage\r\ndownload\r\ndreampassport\r\ndts agent\r\necatch\r\neirgrabber\r\nerocrawler\r\nexpress webpictures\r\nextractorpro\r\neyenetie\r\nfantombrowser\r\nfantomcrew browser\r\nfileheap\r\nfilehound\r\nflashget\r\nfoobot\r\nfranklin locator\r\nfreshdownload\r\nfscrawler\r\ngamespy_arcade\r\ngetbot\r\ngetright\r\ngetweb\r\ngo!zilla\r\ngo-ahead-got-it\r\ngrab\r\ngrafula\r\ngsa-crawler\r\nharvest\r\nhloader\r\nhmview\r\nhttplib\r\nhttpresume\r\nhttrack\r\nhumanlinks\r\nigetter\r\nimage stripper\r\nimage sucker\r\nindustry program\r\nindy library\r\ninfonavirobot\r\ninstallshield digitalwizard\r\nINTerget\r\niria\r\nirvine\r\niupui research bot\r\njbh agent\r\njennybot\r\njetcar\r\njobo\r\njoc\r\nkapere\r\nkenjin spider\r\nkeyword density\r\nlarbin\r\nleechftp\r\nleechget\r\nlexibot\r\nlibweb/clshttp\r\nlibwww-perl\r\nlightningdownload\r\nlincoln state web browser\r\nlinkextractorpro\r\nlinkscan/8.1a.unix\r\nlinkwalker\r\nlwp-trivial\r\nlwp::simple\r\nmac finder\r\nmata hari\r\nmediasearch\r\nmetaproducts\r\nmicrosoft url control\r\nmidown tool\r\nmiixpc\r\nmissauga locate\r\nmissouri college browse\r\nmister pix\r\nmoget\r\nmozilla.*newt\r\nmozilla/3.0 (compatible)\r\nmozilla/3.mozilla/2.01\r\nmsie 4.0 (win95)\r\nmultiblocker browser\r\nmydaemon\r\nmygetright\r\nnabot\r\nnavroad\r\nnearsite\r\nnet vampire\r\nnetants\r\nnetmechanic\r\nnetpumper\r\nnetspider\r\nnewsearchengine\r\nnicerspro\r\nninja\r\nnitro downloader\r\nnpbot\r\noctopus\r\noffline explorer\r\noffline navigator\r\nopenfind\r\npagegrabber\r\npapa foto\r\npavuk\r\npbrowse\r\npcbrowser\r\npeval\r\npompos/\r\nprogram shareware\r\npropowerbot\r\nprowebwalker\r\npsurf\r\npuf\r\npuxarapido\r\nqueryn metasearch\r\nrealdownload\r\nreget\r\nrepomonkey\r\nrsurf\r\nrumours-agent\r\nsakura\r\nscan4mail\r\nsemanticdiscovery\r\nsitesnagger\r\nslysearch\r\nspankbot\r\nspanner \r\nspiderzilla\r\nsq webscanner\r\nstamina\r\nstar downloader\r\nsteeler\r\nsteeler\r\nstrip\r\nsuperbot\r\nsuperhttp\r\nsurfbot\r\nsuzuran\r\nswbot\r\nszukacz\r\ntakeout\r\nteleport\r\ntelesoft\r\ntest spider\r\nthe INTraformant\r\nthenomad\r\ntighttwatbot\r\ntitan\r\ntocrawl/urldispatcher\r\ntrue_robot\r\ntsurf\r\nturing machine\r\nturingos\r\nurlblaze\r\nurlgetfile\r\nurly warning\r\nutilmind\r\nvci\r\nvoideye\r\nweb image collector\r\nweb sucker\r\nwebauto\r\nwebbandit\r\nwebcapture\r\nwebcollage\r\nwebcopier\r\nwebenhancer\r\nwebfetch\r\nwebgo\r\nwebleacher\r\nwebmasterworldforumbot\r\nwebql\r\nwebreaper\r\nwebsite extractor\r\nwebsite quester\r\nwebster\r\nwebstripper\r\nwebwhacker\r\nwep search\r\nwget\r\nwhizbang\r\nwidow\r\nwildsoft surfer\r\nwww-collector-e\r\nwww.netwu.com\r\nwwwoffle\r\nxaldon\r\nxenu\r\nzeus\r\nziggy\r\nzippy'),
(4, 'script', 5, 0, 2, '', 'Abuse-Script', 'abuse_script.tpl', 0, 0, ''),
(5, 'author', 5, 0, 2, '', 'Abuse-Author', 'abuse_author.tpl', 0, 0, ''),
(6, 'referer', 5, 0, 2, '', 'Abuse-Referer', 'abuse_referer.tpl', 0, 0, '121hr.com\r\n1st-call.net\r\n1stcool.com\r\n5000n.com\r\n69-xxx.com\r\n9irl.com\r\n9uy.com\r\na-day-at-the-party.com\r\naccessthepeace.com\r\nadult-model-nude-pictures.com\r\nadult-sex-toys-free-porn.com\r\nagnitum.com\r\nalfonssackpfeiffe.com\r\nalongwayfrommars.com\r\nanime-sex-1.com\r\nanorex-sf-stimulant-free.com\r\nantibot.net\r\nantique-tokiwa.com\r\napotheke-heute.com\r\narmada31.com\r\nartark.com\r\nartlilei.com\r\nascendbtg.com\r\naschalaecheck.com\r\nasian-sex-free-sex.com\r\naslowspeeker.com\r\nassasinatedfrogs.com\r\nathirst-for-tranquillity.net\r\naubonpanier.com\r\navalonumc.com\r\nayingba.com\r\nbayofnoreturn.com\r\nbbw4phonesex.com\r\nbeersarenotfree.com\r\nbierikiuetsch.com\r\nbilingualannouncements.com\r\nblack-pussy-toon-clip-anal-lover-single.com\r\nblownapart.com\r\nblueroutes.com\r\nboasex.com\r\nbooksandpages.com\r\nbootyquake.com\r\nbossyhunter.com\r\nboyz-sex.com\r\nbrokersaandpokers.com\r\nbrowserwindowcleaner.com\r\nbudobytes.com\r\nbusiness2fun.com\r\nbuymyshitz.com\r\nbyuntaesex.com\r\ncaniputsomeloveINToyou.com\r\ncartoons.net.ru\r\ncaverunsailing.com\r\ncertainhealth.com\r\nclantea.com\r\nclose-protection-services.com\r\nclubcanino.com\r\nclubstic.com\r\ncobrakai-skf.com\r\ncollegefucktour.co.uk\r\ncommanderspank.com\r\ncoolenabled.com\r\ncrusecountryart.com\r\ncrusingforsex.co.uk\r\ncunt-twat-pussy-juice-clit-licking.com\r\ncustomerhandshaker.com\r\ncyborgrama.com\r\ndarkprofits.co.uk\r\ndatingforme.co.uk\r\ndatingmind.com\r\ndegree.org.ru\r\ndelorentos.com\r\ndiggydigger.com\r\ndinkydonkyaussie.com\r\ndjpritchard.com\r\ndjtop.com\r\ndraufgeschissen.com\r\ndreamerteens.co.uk\r\nebonyarchives.co.uk\r\nebonyplaya.co.uk\r\necobuilder2000.com\r\nemailandemail.com\r\nemedici.net\r\nengine-on-fire.com\r\nerocity.co.uk\r\nesport3.com\r\neteenbabes.com\r\neurofreepages.com\r\neurotexans.com\r\nevolucionweb.com\r\nfakoli.com\r\nfe4ba.com\r\nferienschweden.com\r\nfindly.com\r\nfirsttimeteadrinker.com\r\nfishing.net.ru\r\nflatwonkers.com\r\nflowershopentertainment.com\r\nflymario.com\r\nfree-xxx-pictures-porno-gallery.com\r\nfreebestporn.com\r\nfreefuckingmovies.co.uk\r\nfreexxxstuff.co.uk\r\nfruitologist.net\r\nfruitsandbolts.com\r\nfuck-cumshots-free-midget-movie-clips.com\r\nfuck-michaelmoore.com\r\nfundacep.com\r\ngadless.com\r\ngallapagosrangers.com\r\ngalleries4free.co.uk\r\ngalofu.com\r\ngaypixpost.co.uk\r\ngeomasti.com\r\ngirltime.co.uk\r\nglassrope.com\r\ngodjustblessyouall.com\r\ngoldenageresort.com\r\ngonnabedaddies.com\r\ngranadasexi.com\r\ngranadasexi.com\r\nguardingtheangels.com\r\nguyprofiles.co.uk\r\nhappy1225.com\r\nhappychappywacky.com\r\nhealth.org.ru\r\nhexplas.com\r\nhighheelsmodels4fun.com\r\nhillsweb.com\r\nhiptuner.com\r\nhistoryINTospace.com\r\nhoa-tuoi.com\r\nhomebuyinginatlanta.com\r\nhorizonultra.com\r\nhorseminiature.net\r\nhotkiss.co.uk\r\nhotlivegirls.co.uk\r\nhotmatchup.co.uk\r\nhusler.co.uk\r\niaentertainment.com\r\niamnotsomeone.com\r\niconsofcorruption.com\r\nihavenotrustinyou.com\r\ninformat-systems.com\r\nINTeriorproshop.com\r\nINTersoftnetworks.com\r\nINThecrib.com\r\ninvestment4cashiers.com\r\niti-trailers.com\r\njackpot-hacker.com\r\njacks-world.com\r\njamesthesailorbasher.com\r\njesuislemonds.com\r\njustanotherdomainname.com\r\nkampelicka.com\r\nkanalrattenarsch.com\r\nkatzasher.com\r\nkerosinjunkie.com\r\nkillasvideo.com\r\nkoenigspisser.com\r\nkontorpara.com\r\nl8t.com\r\nlaestacion101.com\r\nlambuschlamppen.com\r\nlankasex.co.uk\r\nlaser-creations.com\r\nle-tour-du-monde.com\r\nlecraft.com\r\nledo-design.com\r\nleftregistration.com\r\nlekkikoomastas.com\r\nlepommeau.com\r\nlibr-animal.com\r\nlibraries.org.ru\r\nlikewaterlikewind.com\r\nlimbojumpers.com\r\nlink.ru\r\nlockportlinks.com\r\nloiproject.com\r\nlongtermalternatives.com\r\nlottoeco.com\r\nlucalozzi.com\r\nmaki-e-pens.com\r\nmalepayperview.co.uk\r\nmangaxoxo.com\r\nmaps.org.ru\r\nmarcofields.com\r\nmasterofcheese.com\r\nmasteroftheblasterhill.com\r\nmastheadwankers.com\r\nmegafrontier.com\r\nmeinschuppen.com\r\nmercurybar.com\r\nmetapannas.com\r\nmicelebre.com\r\nmidnightlaundries.com\r\nmikeapartment.co.uk\r\nmillenniumchorus.com\r\nmimundial2002.com\r\nminiaturegallerymm.com\r\nmixtaperadio.com\r\nmondialcoral.com\r\nmonja-wakamatsu.com\r\nmonstermonkey.net\r\nmouthfreshners.com\r\nmullensholiday.com\r\nmusilo.com\r\nmyhollowlog.com\r\nmyhomephonenumber.com\r\nmykeyboardisbroken.com\r\nmysofia.net\r\nnaked-cheaters.com\r\nnaked-old-women.com\r\nnastygirls.co.uk\r\nnationclan.net\r\nnatterratter.com\r\nnaughtyadam.com\r\nnestbeschmutzer.com\r\nnetwu.com\r\nnewrealeaseonline.com\r\nnewrealeasesonline.com\r\nnextfrontiersonline.com\r\nnikostaxi.com\r\nnotorious7.com\r\nnrecruiter.com\r\nnursingdepot.com\r\nnustramosse.com\r\nnuturalhicks.com\r\noccaz-auto49.com\r\nocean-db.net\r\noilburnerservice.net\r\nomburo.com\r\noneoz.com\r\nonepageahead.net\r\nonlinewithaline.com\r\norganizate.net\r\nourownweddingsong.com\r\nowen-music.com\r\np-partners.com\r\npaginadeautor.com\r\npakistandutyfree.com\r\npamanderson.co.uk\r\nparentsense.net\r\nparticlewave.net\r\npay-clic.com\r\npay4link.net\r\npcisp.com\r\npersist-pharma.com\r\npeteband.com\r\npetplusindia.com\r\npickabbw.co.uk\r\npicture-oral-position-lesbian.com\r\npl8again.com\r\nplaneting.net\r\npopusky.com\r\nporn-expert.com\r\npromoblitza.com\r\nproproducts-usa.com\r\nptcgzone.com\r\nptporn.com\r\npublishmybong.com\r\nputtingtogether.com\r\nqualifiedcancelations.com\r\nrahost.com\r\nrainbow21.com\r\nrakkashakka.com\r\nrandomfeeding.com\r\nrape-art.com\r\nrd-brains.com\r\nrealestateonthehill.net\r\nrebuscadobot\r\nrequested-stuff.com\r\nretrotrasher.com\r\nricopositive.com\r\nrisorseinrete.com\r\nrotatingcunts.com\r\nrunawayclicks.com\r\nrutalibre.com\r\ns-marche.com\r\nsabrosojazz.com\r\nsamuraidojo.com\r\nsanaldarbe.com\r\nsasseminars.com\r\nschlampenbruzzler.com\r\nsearchmybong.com\r\nseckur.com\r\nsex-asian-porn-INTerracial-photo.com\r\nsex-porn-fuck-hardcore-movie.com\r\nsexa3.net\r\nsexer.com\r\nsexINTention.com\r\nsexnet24.tv\r\nsexomundo.com\r\nsharks.com.ru\r\nshells.com.ru\r\nshop-ecosafe.com\r\nshop-toon-hardcore-fuck-cum-pics.com\r\nsilverfussions.com\r\nsin-city-sex.net\r\nsluisvan.com\r\nsmutshots.com\r\nsnagglersmaggler.com\r\nsomethingtoforgetit.com\r\nsophiesplace.net\r\nsoursushi.com\r\nsouthernxstables.com\r\nspeed467.com\r\nspeedpal4you.com\r\nsporty.org.ru\r\nstopdriving.net\r\nstw.org.ru\r\nsufficientlife.com\r\nsussexboats.net\r\nswinger-party-free-dating-porn-sluts.com\r\nsydneyhay.com\r\nszmjht.com\r\nteninchtrout.com\r\nthebalancedfruits.com\r\ntheendofthesummit.com\r\nthiswillbeit.com\r\nthosethosethose.com\r\nticyclesofindia.com\r\ntits-gay-fagot-black-tits-bigtits-amateur.com\r\ntonius.com\r\ntoohsoft.com\r\ntoolvalley.com\r\ntooporno.net\r\ntoosexual.com\r\ntorngat.com\r\ntour.org.ru\r\ntowneluxury.com\r\ntrafficmogger.com\r\ntriacoach.net\r\ntrottinbob.com\r\ntttframes.com\r\ntvjukebox.net\r\nundercvr.com\r\nunfinished-desires.com\r\nunicornonero.com\r\nunionvillefire.com\r\nupsandowns.com\r\nupthehillanddown.com\r\nvallartavideo.com\r\nvietnamdatingservices.com\r\nvinegarlemonshots.com\r\nvizy.net.ru\r\nvnladiesdatingservices.com\r\nvomitandbusted.com\r\nwalkingthewalking.com\r\nwell-I-am-the-type-of-boy.com\r\nwhales.com.ru\r\nwhincer.net\r\nwhitpagesrippers.com\r\nwhois.sc\r\nwipperrippers.com\r\nwordfilebooklets.com\r\nworld-sexs.com\r\nxsay.com\r\nxxxchyangel.com\r\nxxxzips.com\r\nyouarelostINTransit.com\r\nyuppieslovestocks.com\r\nyuzhouhuagong.com\r\nzhaori-food.com\r\nzwiebelbacke.com'),
(7, 'filter', 5, 0, 2, '', 'Abuse-Filter', 'abuse_filter.tpl', 0, 0, ''),
(8, 'request', 0, 0, 0, '', 'Abuse-Request', 'abuse_request.tpl', 0, 0, ''),
(9, 'string', 0, 0, 0, '', 'Abuse-String', 'abuse_string.tpl', 0, 0, ''),
(10, 'admin', 0, 0, 0, '', 'Abuse-Admin', 'abuse_admin.tpl', 0, 0, ''),
(11, 'flood', 0, 1, 2, '', 'Abuse-Flood', 'abuse_flood.tpl', 0, 1, '');

CREATE TABLE `nuke_nsnst_cidrs` (
  `cidr` int(2) NOT NULL DEFAULT 0,
  `hosts` int(10) NOT NULL DEFAULT 0,
  `mask` varchar(15) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_nsnst_cidrs` (`cidr`, `hosts`, `mask`) VALUES
(1, 2147483647, '127.255.255.255'),
(2, 1073741824, '63.255.255.255'),
(3, 536870912, '31.255.255.255'),
(4, 268435456, '15.255.255.255'),
(5, 134217728, '7.255.255.255'),
(6, 67108864, '3.255.255.255'),
(7, 33554432, '1.255.255.255'),
(8, 16777216, '0.255.255.255'),
(9, 8388608, '0.127.255.255'),
(10, 4194304, '0.63.255.255'),
(11, 2097152, '0.31.255.255'),
(12, 1048576, '0.15.255.255'),
(13, 524288, '0.7.255.255'),
(14, 262144, '0.3.255.255'),
(15, 131072, '0.1.255.255'),
(16, 65536, '0.0.255.255'),
(17, 32768, '0.0.127.255'),
(18, 16384, '0.0.63.255'),
(19, 8192, '0.0.31.255'),
(20, 4096, '0.0.15.255'),
(21, 2048, '0.0.7.255'),
(22, 1024, '0.0.3.255'),
(23, 512, '0.0.1.255'),
(24, 256, '0.0.0.255'),
(25, 128, '0.0.0.127'),
(26, 64, '0.0.0.63'),
(27, 32, '0.0.0.31'),
(28, 16, '0.0.0.15'),
(29, 8, '0.0.0.7'),
(30, 4, '0.0.0.3'),
(31, 2, '0.0.0.1'),
(32, 1, '0.0.0.0');

CREATE TABLE `nuke_nsnst_config` (
  `config_name` varchar(255) NOT NULL DEFAULT '',
  `config_value` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_nsnst_config` (`config_name`, `config_value`) VALUES
('admin_contact', 'webmaster@dev-php-nuke-evolution-xtreme.86it.us'),
('block_perpage', '50'),
('block_sort_column', 'date'),
('block_sort_direction', 'desc'),
('crypt_salt', 'N$'),
('display_link', '3'),
('display_reason', '3'),
('force_nukeurl', '0'),
('help_switch', '1'),
('htaccess_path', ''),
('http_auth', '0'),
('lookup_link', 'admin.php?op=ABIpCheck&domain='),
('page_delay', '1'),
('prevent_dos', '1'),
('proxy_reason', 'abuse_admin.tpl'),
('proxy_switch', '0'),
('santy_protection', '1'),
('self_expire', '0'),
('site_reason', 'admin_site_reason.tpl'),
('site_switch', '0'),
('staccess_path', ''),
('track_active', '1'),
('track_max', '604800'),
('track_perpage', '50'),
('track_sort_column', 'ip_long'),
('track_sort_direction', 'desc'),
('ip_reason', 'admin_ip_reason.tpl'),
('ip_switch', '0'),
('ftaccess_path', ''),
('flood_delay', '2'),
('disable_switch', '0'),
('track_clear', '1620604800'),
('blocked_clear', '0'),
('version_check', '$checktime'),
('version_newest', '2.6.04'),
('version_number', '2.6.04'),
('dump_directory', ''),
('show_right', '0'),
('test_switch', '0');

CREATE TABLE `nuke_nsnst_countries` (
  `c2c` char(2) NOT NULL DEFAULT '',
  `country` varchar(60) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_nsnst_countries` (`c2c`, `country`) VALUES
('00', 'Unknown'),
('01', 'IANA Reserved'),
('ac', 'Ascension Island'),
('ad', 'Andorra'),
('ae', 'United Arab Emirates'),
('af', 'Afghanistan'),
('ag', 'Antigua And Barbuda'),
('ai', 'Anguilla'),
('al', 'Albania'),
('am', 'Armenia'),
('an', 'Netherlands Antilles'),
('ao', 'Angola'),
('aq', 'Antarctica'),
('ar', 'Argentina'),
('as', 'American Samoa'),
('at', 'Austria'),
('au', 'Australia'),
('aw', 'Aruba'),
('ax', 'Aland Islands'),
('az', 'Azerbaijan'),
('ba', 'Bosnia And Herzegovina'),
('bb', 'Barbados'),
('bd', 'Bangladesh'),
('be', 'Belgium'),
('bf', 'Burkina Faso'),
('bg', 'Bulgaria'),
('bh', 'Bahrain'),
('bi', 'Burundi'),
('bj', 'Benin'),
('bm', 'Bermuda'),
('bn', 'Brunei Darussalam'),
('bo', 'Bolivia'),
('br', 'Brazil'),
('bs', 'Bahamas'),
('bt', 'Bhutan'),
('bv', 'Bouvet Island'),
('bw', 'Botswana'),
('by', 'Belarus'),
('bz', 'Belize'),
('ca', 'Canada'),
('cc', 'Cocos Keeling Islands'),
('cd', 'Democratic Republic of the Congo'),
('cf', 'Central African Republic'),
('cg', 'Republic of the Congo'),
('ch', 'Switzerland'),
('ci', 'Cote D\'ivoire'),
('ck', 'Cook Islands'),
('cl', 'Chile'),
('cm', 'Cameroon'),
('cn', 'China'),
('co', 'Colombia'),
('cr', 'Costa Rica'),
('cs', 'Czechoslovakia'),
('cu', 'Cuba'),
('cv', 'Cape Verde'),
('cx', 'Christmas Island'),
('cy', 'Cyprus'),
('cz', 'Czech Republic'),
('de', 'Germany'),
('dj', 'Djibouti'),
('dk', 'Denmark'),
('dm', 'Dominica'),
('do', 'Dominican Republic'),
('dz', 'Algeria'),
('ec', 'Ecuador'),
('ee', 'Estonia'),
('eg', 'Egypt'),
('eh', 'Western Sahara'),
('er', 'Eritrea'),
('es', 'Spain'),
('et', 'Ethiopia'),
('eu', 'European Union'),
('fi', 'Finland'),
('fj', 'Fiji'),
('fk', 'Falkland Islands'),
('fm', 'Micronesia'),
('fo', 'Faroes'),
('fr', 'France'),
('fx', 'Metropolitan France'),
('ga', 'Gabon'),
('gb', 'United Kingdom'),
('gd', 'Grenada'),
('ge', 'Georgia'),
('gf', 'French Guiana'),
('gg', 'Guernsey'),
('gh', 'Ghana'),
('gi', 'Gibraltar'),
('gl', 'Greenland'),
('gm', 'Gambia'),
('gn', 'Guinea'),
('gp', 'Guadeloupe'),
('gq', 'Equatorial Guinea'),
('gr', 'Greece'),
('gs', 'South Georgia and The Islands'),
('gt', 'Guatemala'),
('gu', 'Guam'),
('gw', 'Guinea-Bissau'),
('gy', 'Guyana'),
('hk', 'Hong Kong'),
('hm', 'Heard and McDonald Islands'),
('hn', 'Honduras'),
('hr', 'Croatia'),
('ht', 'Haiti'),
('hu', 'Hungary'),
('id', 'Indonesia'),
('ie', 'Ireland'),
('il', 'Israel'),
('im', 'Isle Of Man'),
('in', 'India'),
('io', 'British Indian Ocean Territory'),
('iq', 'Iraq'),
('ir', 'Iran'),
('is', 'Iceland'),
('it', 'Italy'),
('je', 'Jersey'),
('jm', 'Jamaica'),
('jo', 'Jordan'),
('jp', 'Japan'),
('ke', 'Kenya'),
('kg', 'Kyrgyzstan'),
('kh', 'Cambodia'),
('ki', 'Kiribati'),
('km', 'Comoros'),
('kn', 'SaINT Kitts And Nevis'),
('kp', 'North Korea'),
('kr', 'South Korea'),
('kw', 'Kuwait'),
('ky', 'Cayman Islands'),
('kz', 'Kazakhstan'),
('la', 'Laos'),
('lb', 'Lebanon'),
('lc', 'SaINT Lucia'),
('li', 'Liechtenstein'),
('lk', 'Sri Lanka'),
('lr', 'Liberia'),
('ls', 'Lesotho'),
('lt', 'Lithuania'),
('lu', 'Luxembourg'),
('lv', 'Latvia'),
('ly', 'Libya'),
('ma', 'Morocco'),
('mc', 'Monaco'),
('md', 'Moldova'),
('me', 'Montenegro'),
('mg', 'Madagascar'),
('mh', 'Marshall Islands'),
('mk', 'Macedonia'),
('ml', 'Mali'),
('mm', 'Myanmar'),
('mn', 'Mongolia'),
('mo', 'Macau'),
('mp', 'Northern Mariana Islands'),
('mq', 'Martinique'),
('mr', 'Mauritania'),
('ms', 'Montserrat'),
('mt', 'Malta'),
('mu', 'Mauritius'),
('mv', 'Maldives'),
('mw', 'Malawi'),
('mx', 'Mexico'),
('my', 'Malaysia'),
('mz', 'Mozambique'),
('na', 'Namibia'),
('nc', 'New Caledonia'),
('ne', 'Niger'),
('nf', 'Norfolk Island'),
('ng', 'Nigeria'),
('ni', 'Nicaragua'),
('nl', 'Netherlands'),
('no', 'Norway'),
('np', 'Nepal'),
('nr', 'Nauru'),
('nu', 'Niue'),
('nz', 'New Zealand'),
('om', 'Oman'),
('pa', 'Panama'),
('pe', 'Peru'),
('pf', 'French Polynesia'),
('pg', 'Papua New Guinea'),
('ph', 'Philippines'),
('pk', 'Pakistan'),
('pl', 'Poland'),
('pm', 'SaINT Pierre and Miquelon'),
('pn', 'Pitcairn Islands'),
('pr', 'Puerto Rico'),
('ps', 'Palestine'),
('pt', 'Portugal'),
('pw', 'Palau'),
('py', 'Paraguay'),
('qa', 'Qatar'),
('re', 'Reunion'),
('rs', 'Serbia'),
('ro', 'Romania'),
('ru', 'Russia'),
('rw', 'Rwanda'),
('sa', 'Saudi Arabia'),
('sb', 'Solomon Islands'),
('sc', 'Seychelles'),
('sd', 'Sudan'),
('se', 'Sweden'),
('sg', 'Singapore'),
('sh', 'SaINT Helena'),
('si', 'Slovenia'),
('sj', 'Svalbard'),
('sk', 'Slovakia'),
('sl', 'Sierra Leone'),
('sm', 'San Marino'),
('sn', 'Senegal'),
('so', 'Somalia'),
('sr', 'Suriname'),
('st', 'Sao Tome And Principe'),
('sv', 'El Salvador'),
('sy', 'Syria'),
('sz', 'Swaziland'),
('tc', 'Turks And Caicos Islands'),
('td', 'Chad'),
('tf', 'French Southern Territories'),
('tg', 'Togo'),
('th', 'Thailand'),
('tj', 'Tajikistan'),
('tk', 'Tokelau'),
('tl', 'East Timor'),
('tm', 'Turkmenistan'),
('tn', 'Tunisia'),
('to', 'Tonga'),
('tp', 'East Timor'),
('tr', 'Turkey'),
('tt', 'Trinidad And Tobago'),
('tv', 'Tuvalu'),
('tw', 'Taiwan'),
('tz', 'Tanzania'),
('ua', 'Ukraine'),
('ug', 'Uganda'),
('um', 'United States Minor Outlying Islands'),
('un', 'United Nations'),
('us', 'United States'),
('uy', 'Uruguay'),
('uz', 'Uzbekistan'),
('va', 'Vatican City'),
('vc', 'SaINT Vincent And The Grenadines'),
('ve', 'Venezuela'),
('vg', 'British Virgin Islands'),
('vi', 'US Virgin Islands'),
('vn', 'Vietnam'),
('vu', 'Vanuatu'),
('wf', 'Wallis and Futuna Islands'),
('ws', 'Samoa'),
('xe', 'England'),
('xs', 'Scotland'),
('xw', 'Wales'),
('ye', 'Yemen'),
('yt', 'Mayotte'),
('yu', 'Yugoslavia'),
('za', 'South Africa'),
('zm', 'Zambia'),
('zw', 'Zimbabwe'),
('02', 'UnAllocated');

CREATE TABLE `nuke_nsnst_excluded_ranges` (
  `ip_lo` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `ip_hi` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `date` int(20) NOT NULL DEFAULT 0,
  `notes` text NOT NULL,
  `c2c` char(2) NOT NULL DEFAULT '00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_nsnst_harvesters` (
  `hid` int(2) NOT NULL,
  `harvester` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_nsnst_harvesters` (`hid`, `harvester`) VALUES
(1, '@yahoo.com'),
(2, 'alexibot'),
(3, 'alligator'),
(4, 'anonymiz'),
(5, 'asterias'),
(6, 'backdoorbot'),
(7, 'black hole'),
(8, 'blackwidow'),
(9, 'blowfish'),
(10, 'botalot'),
(11, 'builtbottough'),
(12, 'bullseye'),
(13, 'bunnyslippers'),
(14, 'catch'),
(15, 'cegbfeieh'),
(16, 'charon'),
(17, 'cheesebot'),
(18, 'cherrypicker'),
(19, 'chinaclaw'),
(20, 'combine'),
(21, 'copyrightcheck'),
(22, 'cosmos'),
(23, 'crescent'),
(24, 'curl'),
(25, 'dbrowse'),
(26, 'disco'),
(27, 'dittospyder'),
(28, 'dlman'),
(29, 'dnloadmage'),
(30, 'download'),
(31, 'dreampassport'),
(32, 'dts agent'),
(33, 'ecatch'),
(34, 'eirgrabber'),
(35, 'erocrawler'),
(36, 'express webpictures'),
(37, 'extractorpro'),
(38, 'eyenetie'),
(39, 'fantombrowser'),
(40, 'fantomcrew browser'),
(41, 'fileheap'),
(42, 'filehound'),
(43, 'flashget'),
(44, 'foobot'),
(45, 'franklin locator'),
(46, 'freshdownload'),
(47, 'fscrawler'),
(48, 'gamespy_arcade'),
(49, 'getbot'),
(50, 'getright'),
(51, 'getweb'),
(52, 'go!zilla'),
(53, 'go-ahead-got-it'),
(54, 'grab'),
(55, 'grafula'),
(56, 'gsa-crawler'),
(57, 'harvest'),
(58, 'hloader'),
(59, 'hmview'),
(60, 'httplib'),
(61, 'httpresume'),
(62, 'httrack'),
(63, 'humanlinks'),
(64, 'igetter'),
(65, 'image stripper'),
(66, 'image sucker'),

(67, 'industry program'),
(68, 'indy library'),
(69, 'infonavirobot'),
(70, 'installshield digitalwizard'),
(71, 'interget'),
(72, 'iria'),
(73, 'irvine'),
(74, 'iupui research bot'),
(75, 'jbh agent'),
(76, 'jennybot'),
(77, 'jetcar'),
(78, 'jobo'),
(79, 'joc'),
(80, 'kapere'),
(81, 'kenjin spider'),
(82, 'keyword density'),
(83, 'larbin'),
(84, 'leechftp'),
(85, 'leechget'),
(86, 'lexibot'),
(87, 'libweb/clshttp'),
(88, 'libwww-perl'),
(89, 'lightningdownload'),
(90, 'lincoln state web browser'),
(91, 'linkextractorpro'),
(92, 'linkscan/8.1a.unix'),
(93, 'linkwalker'),
(94, 'lwp-trivial'),
(95, 'lwp::simple'),
(96, 'mac finder'),
(97, 'mata hari'),
(98, 'mediasearch'),
(99, 'metaproducts'),
(100, 'microsoft url control'),
(101, 'midown tool'),
(102, 'miixpc'),
(103, 'missauga locate'),
(104, 'missouri college browse'),
(105, 'mister pix'),
(106, 'moget'),
(107, 'mozilla.*newt'),
(108, 'mozilla/3.0 (compatible)'),
(109, 'mozilla/3.mozilla/2.01'),
(110, 'msie 4.0 (win95)'),
(111, 'multiblocker browser'),
(112, 'mydaemon'),
(113, 'mygetright'),
(114, 'nabot'),
(115, 'navroad'),
(116, 'nearsite'),
(117, 'net vampire'),
(118, 'netants'),
(119, 'netmechanic'),
(120, 'netpumper'),
(121, 'netspider'),
(122, 'newsearchengine'),
(123, 'nicerspro'),
(124, 'ninja'),
(125, 'nitro downloader'),
(126, 'npbot'),
(127, 'octopus'),
(128, 'offline explorer'),
(129, 'offline navigator'),
(130, 'openfind'),
(131, 'pagegrabber'),
(132, 'papa foto'),
(133, 'pavuk'),
(134, 'pbrowse'),
(135, 'pcbrowser'),
(136, 'peval'),
(137, 'pompos/'),
(138, 'program shareware'),
(139, 'propowerbot'),
(140, 'prowebwalker'),
(141, 'psurf'),
(142, 'puf'),
(143, 'puxarapido'),
(144, 'queryn metasearch'),
(145, 'realdownload'),
(146, 'reget'),
(147, 'repomonkey'),
(148, 'rsurf'),
(149, 'rumours-agent'),
(150, 'sakura'),
(151, 'scan4mail'),
(152, 'semanticdiscovery'),
(153, 'sitesnagger'),
(154, 'slysearch'),
(155, 'spankbot'),
(156, 'spanner '),
(157, 'spiderzilla'),
(158, 'sq webscanner'),
(159, 'stamina'),
(160, 'star downloader'),
(161, 'steeler'),
(162, 'strip'),
(163, 'superbot'),
(164, 'superhttp'),
(165, 'surfbot'),
(166, 'suzuran'),
(167, 'swbot'),
(168, 'szukacz'),
(169, 'takeout'),
(170, 'teleport'),
(171, 'telesoft'),
(172, 'test spider'),
(173, 'the intraformant'),
(174, 'thenomad'),
(175, 'tighttwatbot'),
(176, 'titan'),
(177, 'tocrawl/urldispatcher'),
(178, 'true_robot'),
(179, 'tsurf'),
(180, 'turing machine'),
(181, 'turingos'),
(182, 'urlblaze'),
(183, 'urlgetfile'),
(184, 'urly warning'),
(185, 'utilmind'),
(186, 'vci'),
(187, 'voideye'),
(188, 'web image collector'),
(189, 'web sucker'),
(190, 'webauto'),
(191, 'webbandit'),
(192, 'webcapture'),
(193, 'webcollage'),
(194, 'webcopier'),
(195, 'webenhancer'),
(196, 'webfetch'),
(197, 'webgo'),
(198, 'webleacher'),
(199, 'webmasterworldforumbot'),
(200, 'webql'),
(201, 'webreaper'),
(202, 'website extractor'),
(203, 'website quester'),
(204, 'webster'),
(205, 'webstripper'),
(206, 'webwhacker'),
(207, 'wep search'),
(208, 'wget'),
(209, 'whizbang'),
(210, 'widow'),
(211, 'wildsoft surfer'),
(212, 'www-collector-e'),
(213, 'www.netwu.com'),
(214, 'wwwoffle'),
(215, 'xaldon'),
(216, 'xenu'),
(217, 'zeus'),
(218, 'ziggy'),
(219, 'zippy');

CREATE TABLE `nuke_nsnst_protected_ranges` (
  `ip_lo` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `ip_hi` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `date` int(20) NOT NULL DEFAULT 0,
  `notes` text NOT NULL,
  `c2c` char(2) NOT NULL DEFAULT '00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_nsnst_referers` (
  `rid` int(2) NOT NULL,
  `referer` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_nsnst_referers` (`rid`, `referer`) VALUES
(1, '121hr.com'),
(2, '1st-call.net'),
(3, '1stcool.com'),
(4, '5000n.com'),
(5, '69-xxx.com'),
(6, '9irl.com'),
(7, '9uy.com'),
(8, 'a-day-at-the-party.com'),
(9, 'accessthepeace.com'),
(10, 'adult-model-nude-pictures.com'),
(11, 'adult-sex-toys-free-porn.com'),
(12, 'agnitum.com'),
(13, 'alfonssackpfeiffe.com'),
(14, 'alongwayfrommars.com'),
(15, 'anime-sex-1.com'),
(16, 'anorex-sf-stimulant-free.com'),
(17, 'antibot.net'),
(18, 'antique-tokiwa.com'),
(19, 'apotheke-heute.com'),
(20, 'armada31.com'),
(21, 'artark.com'),
(22, 'artlilei.com'),
(23, 'ascendbtg.com'),
(24, 'aschalaecheck.com'),
(25, 'asian-sex-free-sex.com'),
(26, 'aslowspeeker.com'),
(27, 'assasinatedfrogs.com'),
(28, 'athirst-for-tranquillity.net'),
(29, 'aubonpanier.com'),
(30, 'avalonumc.com'),
(31, 'ayingba.com'),
(32, 'bayofnoreturn.com'),
(33, 'bbw4phonesex.com'),
(34, 'beersarenotfree.com'),
(35, 'bierikiuetsch.com'),
(36, 'bilingualannouncements.com'),
(37, 'black-pussy-toon-clip-anal-lover-single.com'),
(38, 'blownapart.com'),
(39, 'blueroutes.com'),
(40, 'boasex.com'),
(41, 'booksandpages.com'),
(42, 'bootyquake.com'),
(43, 'bossyhunter.com'),
(44, 'boyz-sex.com'),
(45, 'brokersaandpokers.com'),
(46, 'browserwindowcleaner.com'),
(47, 'budobytes.com'),
(48, 'business2fun.com'),
(49, 'buymyshitz.com'),
(50, 'byuntaesex.com'),
(51, 'caniputsomeloveintoyou.com'),
(52, 'cartoons.net.ru'),
(53, 'caverunsailing.com'),
(54, 'certainhealth.com'),
(55, 'clantea.com'),
(56, 'close-protection-services.com'),
(57, 'clubcanino.com'),
(58, 'clubstic.com'),
(59, 'cobrakai-skf.com'),
(60, 'collegefucktour.co.uk'),
(61, 'commanderspank.com'),
(62, 'coolenabled.com'),
(63, 'crusecountryart.com'),
(64, 'crusingforsex.co.uk'),
(65, 'cunt-twat-pussy-juice-clit-licking.com'),
(66, 'customerhandshaker.com'),
(67, 'cyborgrama.com'),
(68, 'darkprofits.co.uk'),
(69, 'datingforme.co.uk'),
(70, 'datingmind.com'),
(71, 'degree.org.ru'),
(72, 'delorentos.com'),
(73, 'diggydigger.com'),
(74, 'dinkydonkyaussie.com'),
(75, 'djpritchard.com'),
(76, 'djtop.com'),
(77, 'draufgeschissen.com'),
(78, 'dreamerteens.co.uk'),
(79, 'ebonyarchives.co.uk'),
(80, 'ebonyplaya.co.uk'),
(81, 'ecobuilder2000.com'),
(82, 'emailandemail.com'),
(83, 'emedici.net'),
(84, 'engine-on-fire.com'),
(85, 'erocity.co.uk'),
(86, 'esport3.com'),
(87, 'eteenbabes.com'),
(88, 'eurofreepages.com'),
(89, 'eurotexans.com'),
(90, 'evolucionweb.com'),
(91, 'fakoli.com'),
(92, 'fe4ba.com'),
(93, 'ferienschweden.com'),
(94, 'findly.com'),
(95, 'firsttimeteadrinker.com'),
(96, 'fishing.net.ru'),
(97, 'flatwonkers.com'),
(98, 'flowershopentertainment.com'),
(99, 'flymario.com'),
(100, 'free-xxx-pictures-porno-gallery.com'),
(101, 'freebestporn.com'),
(102, 'freefuckingmovies.co.uk'),
(103, 'freexxxstuff.co.uk'),
(104, 'fruitologist.net'),
(105, 'fruitsandbolts.com'),
(106, 'fudge-cumshots-free-midget-movie-clips.com'),
(107, 'fudge-michaelmoore.com'),
(108, 'fundacep.com'),
(109, 'gadless.com'),
(110, 'gallapagosrangers.com'),
(111, 'galleries4free.co.uk'),
(112, 'galofu.com'),
(113, 'gaypixpost.co.uk'),
(114, 'geomasti.com'),
(115, 'girltime.co.uk'),
(116, 'glassrope.com'),
(117, 'godjustblessyouall.com'),
(118, 'goldenageresort.com'),
(119, 'gonnabedaddies.com'),
(120, 'granadasexi.com'),
(121, 'guardingtheangels.com'),
(122, 'guyprofiles.co.uk'),
(123, 'happy1225.com'),
(124, 'happychappywacky.com'),
(125, 'health.org.ru'),
(126, 'hexplas.com'),
(127, 'highheelsmodels4fun.com'),
(128, 'hillsweb.com'),
(129, 'hiptuner.com'),
(130, 'historyintospace.com'),
(131, 'hoa-tuoi.com'),
(132, 'homebuyinginatlanta.com'),
(133, 'horizonultra.com'),
(134, 'horseminiature.net'),
(135, 'hotkiss.co.uk'),
(136, 'hotlivegirls.co.uk'),
(137, 'hotmatchup.co.uk'),
(138, 'husler.co.uk'),
(139, 'iaentertainment.com'),
(140, 'iamnotsomeone.com'),
(141, 'iconsofcorruption.com'),
(142, 'ihavenotrustinyou.com'),
(143, 'informat-systems.com'),
(144, 'interiorproshop.com'),
(145, 'intersoftnetworks.com'),
(146, 'inthecrib.com'),
(147, 'investment4cashiers.com'),
(148, 'iti-trailers.com'),
(149, 'jackpot-hacker.com'),
(150, 'jacks-world.com'),
(151, 'jamesthesailorbasher.com'),
(152, 'jesuislemonds.com'),
(153, 'justanotherdomainname.com'),
(154, 'kampelicka.com'),
(155, 'kanalrattenarsch.com'),
(156, 'katzasher.com'),
(157, 'kerosinjunkie.com'),
(158, 'killasvideo.com'),
(159, 'koenigspisser.com'),
(160, 'kontorpara.com'),
(161, 'l8t.com'),
(162, 'laestacion101.com'),
(163, 'lambuschlamppen.com'),
(164, 'lankasex.co.uk'),
(165, 'laser-creations.com'),
(166, 'le-tour-du-monde.com'),
(167, 'lecraft.com'),
(168, 'ledo-design.com'),
(169, 'leftregistration.com'),
(170, 'lekkikoomastas.com'),
(171, 'lepommeau.com'),
(172, 'libr-animal.com'),
(173, 'libraries.org.ru'),
(174, 'likewaterlikewind.com'),
(175, 'limbojumpers.com'),
(176, 'link.ru'),
(177, 'lockportlinks.com'),
(178, 'loiproject.com'),
(179, 'longtermalternatives.com'),
(180, 'lottoeco.com'),
(181, 'lucalozzi.com'),
(182, 'maki-e-pens.com'),
(183, 'malepayperview.co.uk'),
(184, 'mangaxoxo.com'),
(185, 'maps.org.ru'),
(186, 'marcofields.com'),
(187, 'masterofcheese.com'),
(188, 'masteroftheblasterhill.com'),
(189, 'mastheadwankers.com'),
(190, 'megafrontier.com'),
(191, 'meinschuppen.com'),
(192, 'mercurybar.com'),
(193, 'metapannas.com'),
(194, 'micelebre.com'),
(195, 'midnightlaundries.com'),
(196, 'mikeapartment.co.uk'),
(197, 'millenniumchorus.com'),
(198, 'mimundial2002.com'),
(199, 'miniaturegallerymm.com'),
(200, 'mixtaperadio.com'),
(201, 'mondialcoral.com'),
(202, 'monja-wakamatsu.com'),
(203, 'monstermonkey.net'),
(204, 'mouthfreshners.com'),
(205, 'mullensholiday.com'),
(206, 'musilo.com'),
(207, 'myhollowlog.com'),
(208, 'myhomephonenumber.com'),
(209, 'mykeyboardisbroken.com'),
(210, 'mysofia.net'),
(211, 'naked-cheaters.com'),
(212, 'naked-old-women.com'),
(213, 'nastygirls.co.uk'),
(214, 'nationclan.net'),
(215, 'natterratter.com'),
(216, 'naughtyadam.com'),
(217, 'nestbeschmutzer.com'),
(218, 'netwu.com'),
(219, 'newrealeaseonline.com'),
(220, 'newrealeasesonline.com'),
(221, 'nextfrontiersonline.com'),
(222, 'nikostaxi.com'),
(223, 'notorious7.com'),
(224, 'nrecruiter.com'),
(225, 'nursingdepot.com'),
(226, 'nustramosse.com'),
(227, 'nuturalhicks.com'),
(228, 'occaz-auto49.com'),
(229, 'ocean-db.net'),
(230, 'oilburnerservice.net'),
(231, 'omburo.com'),
(232, 'oneoz.com'),
(233, 'onepageahead.net'),
(234, 'onlinewithaline.com'),
(235, 'organizate.net'),
(236, 'ourownweddingsong.com'),
(237, 'owen-music.com'),
(238, 'p-partners.com'),
(239, 'paginadeautor.com'),
(240, 'pakistandutyfree.com'),
(241, 'pamanderson.co.uk'),
(242, 'parentsense.net'),
(243, 'particlewave.net'),
(244, 'pay-clic.com'),
(245, 'pay4link.net'),
(246, 'pcisp.com'),
(247, 'persist-pharma.com'),
(248, 'peteband.com'),
(249, 'petplusindia.com'),
(250, 'pickabbw.co.uk'),
(251, 'picture-oral-position-lesbian.com'),
(252, 'pl8again.com'),
(253, 'planeting.net'),
(254, 'popusky.com'),
(255, 'porn-expert.com'),
(256, 'promoblitza.com'),
(257, 'proproducts-usa.com'),
(258, 'ptcgzone.com'),
(259, 'ptporn.com'),
(260, 'publishmybong.com'),
(261, 'puttingtogether.com'),
(262, 'qualifiedcancelations.com'),
(263, 'rahost.com'),
(264, 'rainbow21.com'),
(265, 'rakkashakka.com'),
(266, 'randomfeeding.com'),
(267, 'rape-art.com'),
(268, 'rd-brains.com'),
(269, 'realestateonthehill.net'),
(270, 'rebuscadobot'),
(271, 'requested-stuff.com'),
(272, 'retrotrasher.com'),
(273, 'ricopositive.com'),
(274, 'risorseinrete.com'),
(275, 'rotatingcunts.com'),
(276, 'runawayclicks.com'),
(277, 'rutalibre.com'),
(278, 's-marche.com'),
(279, 'sabrosojazz.com'),
(280, 'samuraidojo.com'),
(281, 'sanaldarbe.com'),
(282, 'sasseminars.com'),
(283, 'schlampenbruzzler.com'),
(284, 'searchmybong.com'),
(285, 'seckur.com'),
(286, 'sex-asian-porn-interracial-photo.com'),
(287, 'sex-porn-fudge-hardcore-movie.com'),
(288, 'sexa3.net'),
(289, 'sexer.com'),
(290, 'sexintention.com'),
(291, 'sexnet24.tv'),
(292, 'sexomundo.com'),
(293, 'sharks.com.ru'),
(294, 'shells.com.ru'),
(295, 'shop-ecosafe.com'),
(296, 'shop-toon-hardcore-fudge-cum-pics.com'),
(297, 'silverfussions.com'),
(298, 'sin-city-sex.net'),
(299, 'sluisvan.com'),
(300, 'smutshots.com'),
(301, 'snagglersmaggler.com'),
(302, 'somethingtoforgetit.com'),
(303, 'sophiesplace.net'),
(304, 'soursushi.com'),
(305, 'southernxstables.com'),
(306, 'speed467.com'),
(307, 'speedpal4you.com'),
(308, 'sporty.org.ru'),
(309, 'stopdriving.net'),
(310, 'stw.org.ru'),
(311, 'sufficientlife.com'),
(312, 'sussexboats.net'),
(313, 'swinger-party-free-dating-porn-sluts.com'),
(314, 'sydneyhay.com'),
(315, 'szmjht.com'),
(316, 'teninchtrout.com'),
(317, 'thebalancedfruits.com'),
(318, 'theendofthesummit.com'),
(319, 'thiswillbeit.com'),
(320, 'thosethosethose.com'),
(321, 'ticyclesofindia.com'),
(322, 'tits-gay-fagot-black-tits-bigtits-amateur.com'),
(323, 'tonius.com'),
(324, 'toohsoft.com'),
(325, 'toolvalley.com'),
(326, 'tooporno.net'),
(327, 'toosexual.com'),
(328, 'torngat.com'),
(329, 'tour.org.ru'),
(330, 'towneluxury.com'),
(331, 'trafficmogger.com'),
(332, 'triacoach.net'),
(333, 'trottinbob.com'),
(334, 'tttframes.com'),
(335, 'tvjukebox.net'),
(336, 'undercvr.com'),
(337, 'unfinished-desires.com'),
(338, 'unicornonero.com'),
(339, 'unionvillefire.com'),
(340, 'upsandowns.com'),
(341, 'upthehillanddown.com'),
(342, 'vallartavideo.com'),
(343, 'vietnamdatingservices.com'),
(344, 'vinegarlemonshots.com'),
(345, 'vizy.net.ru'),
(346, 'vnladiesdatingservices.com'),
(347, 'vomitandbusted.com'),
(348, 'walkingthewalking.com'),
(349, 'well-I-am-the-type-of-boy.com'),
(350, 'whales.com.ru'),
(351, 'whincer.net'),
(352, 'whitpagesrippers.com'),
(353, 'whois.sc'),
(354, 'wipperrippers.com'),
(355, 'wordfilebooklets.com'),
(356, 'world-sexs.com'),
(357, 'xsay.com'),
(358, 'xxxchyangel.com'),
(359, 'xxxx:'),
(360, 'xxxzips.com'),
(361, 'youarelostintransit.com'),
(362, 'yuppieslovestocks.com'),
(363, 'yuzhouhuagong.com'),
(364, 'zhaori-food.com'),
(365, 'zwiebelbacke.com');

CREATE TABLE `nuke_nsnst_strings` (
  `string` varchar(60) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_nsnst_tracked_ips` (
  `tid` int(11) NOT NULL,
  `ip_addr` varchar(15) NOT NULL DEFAULT '',
  `ip_long` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `username` varchar(60) NOT NULL DEFAULT '',
  `user_agent` text NOT NULL,
  `refered_from` text NOT NULL,
  `date` int(11) NOT NULL DEFAULT 0,
  `page` text NOT NULL,
  `x_forward_for` varchar(32) NOT NULL DEFAULT '',
  `client_ip` varchar(32) NOT NULL DEFAULT '',
  `remote_addr` varchar(32) NOT NULL DEFAULT '',
  `remote_port` varchar(11) NOT NULL DEFAULT '',
  `request_method` varchar(10) NOT NULL DEFAULT '',
  `c2c` char(2) NOT NULL DEFAULT '00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_pages` (
  `pid` int(10) NOT NULL,
  `cid` int(10) NOT NULL DEFAULT 0,
  `title` varchar(255) NOT NULL DEFAULT '',
  `subtitle` varchar(255) NOT NULL DEFAULT '',
  `active` int(1) NOT NULL DEFAULT 0,
  `page_header` text NOT NULL,
  `text` text NOT NULL,
  `page_footer` text NOT NULL,
  `signature` text NOT NULL,
  `date` datetime NOT NULL DEFAULT '2018-12-12 00:00:00',
  `counter` int(10) NOT NULL DEFAULT 0,
  `clanguage` varchar(30) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_pages_categories` (
  `cid` int(10) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_pollcomments` (
  `tid` int(11) NOT NULL,
  `pid` int(11) NOT NULL DEFAULT 0,
  `pollID` int(11) NOT NULL DEFAULT 0,
  `date` datetime DEFAULT NULL,
  `name` varchar(60) NOT NULL DEFAULT '',
  `email` varchar(60) DEFAULT NULL,
  `url` varchar(60) DEFAULT NULL,
  `host_name` varchar(60) DEFAULT NULL,
  `subject` varchar(60) NOT NULL DEFAULT '',
  `comment` text NOT NULL,
  `score` tinyint(4) NOT NULL DEFAULT 0,
  `reason` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_poll_check` (
  `ip` varchar(20) NOT NULL DEFAULT '',
  `time` varchar(14) NOT NULL DEFAULT '',
  `pollID` int(10) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_poll_check` (`ip`, `time`, `pollID`) VALUES
('47.206.216.196', '1618949976', 1);

CREATE TABLE `nuke_poll_data` (
  `pollID` int(11) NOT NULL DEFAULT 0,
  `optionText` char(50) NOT NULL DEFAULT '',
  `optionCount` int(11) NOT NULL DEFAULT 0,
  `voteID` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_poll_data` (`pollID`, `optionText`, `optionCount`, `voteID`) VALUES
(1, 'Ummmm, not bad', 0, 1),
(1, 'Farout', 0, 2),
(1, 'Terrific', 0, 3),
(1, 'The Shit!!', 1, 4),
(1, 'Where has this been?', 0, 5),
(1, 'Blows...', 0, 6),
(1, 'Absolutely #1!', 0, 7),
(1, '', 0, 8),
(1, '', 0, 9),
(1, '', 0, 10),
(1, '', 0, 11),
(1, '', 0, 12);

CREATE TABLE `nuke_poll_desc` (
  `pollID` int(11) NOT NULL,
  `pollTitle` varchar(100) NOT NULL DEFAULT '',
  `timeStamp` int(11) NOT NULL DEFAULT 0,
  `voters` mediumint(9) NOT NULL DEFAULT 0,
  `planguage` varchar(30) NOT NULL DEFAULT '',
  `artid` int(10) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_poll_desc` (`pollID`, `pollTitle`, `timeStamp`, `voters`, `planguage`, `artid`) VALUES
(1, 'What do you think about this portal?', 961405160, 1, 'english', 0);

CREATE TABLE `nuke_queue` (
  `qid` smallint(5) UNSIGNED NOT NULL,
  `uid` mediumint(9) NOT NULL DEFAULT 0,
  `uname` varchar(40) NOT NULL DEFAULT '',
  `subject` varchar(100) NOT NULL DEFAULT '',
  `story` text DEFAULT NULL,
  `storyext` text NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT '2018-12-12 00:00:00',
  `topic` varchar(20) NOT NULL DEFAULT '',
  `alanguage` varchar(30) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_quotes` (
  `qid` int(10) UNSIGNED NOT NULL,
  `quote` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_quotes` (`qid`, `quote`) VALUES
(1, 'Nos morituri te salutamus - CBHS');

CREATE TABLE `nuke_referer` (
  `url` varchar(100) NOT NULL,
  `lasttime` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `link` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_related` (
  `rid` int(11) NOT NULL,
  `tid` int(11) NOT NULL DEFAULT 0,
  `name` varchar(30) NOT NULL DEFAULT '',
  `url` varchar(200) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_reviews` (
  `id` int(10) NOT NULL,
  `date` date NOT NULL DEFAULT '2018-12-12',
  `title` varchar(150) NOT NULL DEFAULT '',
  `text` text NOT NULL,
  `reviewer` varchar(25) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `score` int(10) NOT NULL DEFAULT 0,
  `cover` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(100) NOT NULL DEFAULT '',
  `url_title` varchar(50) NOT NULL DEFAULT '',
  `hits` int(10) NOT NULL DEFAULT 0,
  `rlanguage` varchar(30) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_reviews_add` (
  `id` int(10) NOT NULL,
  `date` date DEFAULT NULL,
  `title` varchar(150) NOT NULL DEFAULT '',
  `text` text NOT NULL,
  `reviewer` varchar(25) NOT NULL DEFAULT '',
  `email` varchar(60) DEFAULT NULL,
  `score` int(10) NOT NULL DEFAULT 0,
  `url` varchar(100) NOT NULL DEFAULT '',
  `url_title` varchar(50) NOT NULL DEFAULT '',
  `rlanguage` varchar(30) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_reviews_comments` (
  `cid` int(10) NOT NULL,
  `rid` int(10) NOT NULL DEFAULT 0,
  `userid` varchar(25) NOT NULL DEFAULT '',
  `date` datetime DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `score` int(10) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_reviews_main` (
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_reviews_main` (`title`, `description`) VALUES
('Reviews Section Title', 'Reviews Section Long Description');

CREATE TABLE `nuke_security_agents` (
  `agent_name` varchar(20) NOT NULL DEFAULT '',
  `agent_fullname` varchar(30) DEFAULT '',
  `agent_hostname` varchar(30) DEFAULT '',
  `agent_url` varchar(80) DEFAULT '',
  `agent_ban` int(1) NOT NULL DEFAULT 0,
  `agent_desc` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_security_agents` (`agent_name`, `agent_fullname`, `agent_hostname`, `agent_url`, `agent_ban`, `agent_desc`) VALUES
('1Noon', '1Noonbot', NULL, '1nooncorp.com', -1, 'Doesn\'t follow robots.txt'),
('AI', 'AIBOT', NULL, '21seek.com', 0, '(China) robot (218.17.90.xxx)'),
('aip', 'aipbot/', NULL, 'nameprotect.com', 0, 'copyright search robot (24.177.134.x), s. also\r\n- np/0.1_(np;_http://www.nameprotect.com...\r\n- abot/0.1 (abot; http://www.abot.com...'),
('Alexa', 'ia_archiver', '.alexa.com', 'alexa.com', 0, 'Alexa (209.237.238.1xx)'),
('Archive', 'ia_archiver', '.archive.org', 'archive.org', 0, 'The Internet Archive (209.237.238.1xx)'),
('AltaVista', 'Scooter', NULL, 'altavista.com', 0, NULL),
('Amfibi', 'Amfibibot', NULL, 'amfibi.com', 0, NULL),
('Ansearch', 'AnsearchBot/', NULL, 'ansearch.com.au', 0, NULL),
('AnswerBus', 'AnswerBus', NULL, 'answerbus.com', 0, NULL),
('Argus', 'Argus/', NULL, 'simpy.com/bot.html', 0, NULL),
('Arachmo', 'Arachmo', NULL, NULL, -1, 'Impolite bandwidth sucker. Netblock owned by SOFTBANK BB CORP, Japan.\r\nDoesn\'t follow robots.txt'),
('Ask Jeeves', 'Ask Jeeves/Teoma', '.ask.com', 'sp.ask.com/docs/about/tech_crawling.html', 0, NULL),
('ASPseek', 'ASPseek/', NULL, 'aspseek.org', 0, 'search engine software'),
('AvantGo', 'AvantGo', 'avantgo.com', 'avantgo.com', 0, NULL),
('Axadine', 'Axadine Crawler', NULL, 'axada.de', 0, NULL),
('Baidu', 'Baiduspider', NULL, 'baidu.com/search/spider.htm', 0, NULL),
('Become', 'BecomeBot', NULL, NULL, 0, NULL),
('BigClique', 'BigCliqueBOT', NULL, 'bigclique.com', 0, NULL),
('BilderSauger', 'BilderSauger', NULL, 'google.com/search?q=BilderSauger+data+becker', -1, NULL),
('BitTorrent', 'btbot/', NULL, 'btbot.com/btbot.html', 0, NULL),
('Bruin', 'BruinBot', NULL, 'webarchive.cs.ucla.edu/bruinbot.html', 0, NULL),
('cfetch', 'cfetch/', NULL, NULL, 0, NULL),
('Cipinet', 'Cipinet', NULL, 'cipinet.com/bot.html', 0, NULL),
('Combine', 'Combine/', NULL, 'lub.lu.se/combine/', -1, 'harvesting robot'),
('Convera', 'ConveraCrawler/', NULL, 'authoritativeweb.com/crawl', -1, 'Impolite robot. Netblock owned by Convera Corp, Vienna'),
('Cydral', 'CydralSpider', NULL, 'cydral.com', 0, 'Cydral Web Image Search'),
('curl', 'curl/', NULL, 'curl.haxx.se', 0, 'file transferring tool'),
('Datapark', 'DataparkSearch/', NULL, 'dataparksearch.org', 0, NULL),
('Demo', 'Demo Bot', NULL, NULL, -1, NULL),
('DHCrawler', 'DHCrawler', NULL, NULL, 0, NULL),
('Diamond', 'DiamondBot', NULL, 'searchscout.com', -1, 'Claria (ex Gator) robot (64.152.73.xx), s. also Claria'),
('DISCo', 'DISCo Pump', NULL, NULL, -1, 'Doesn\'t follow robots.txt'),
('Dragonfly CMS', 'Dragonfly File Reader', NULL, NULL, 0, NULL),
('Drecom', 'Drecombot/', 'drecom.jp', 'career.drecom.jp/bot.html', -1, 'Doesn\'t follow robots.txt'),
('Dumbfind', 'Dumbot', NULL, 'dumbfind.com/dumbot.html', 0, NULL),
('e-Society', 'e-SocietyRobot', NULL, 'yama.info.waseda.ac.jp/~yamana/es/', 0, NULL),
('EmailSiphon', 'EmailSiphon', NULL, NULL, -1, NULL),
('EmeraldShield', 'EmeraldShield.com WebBot', NULL, 'emeraldshield.com/webbot.aspx', 0, NULL),
('Educate', 'Educate Search', NULL, NULL, -1, NULL),
('Envolk', 'envolk[ITS]spider/', NULL, 'envolk.com/envolkspider.html', 0, NULL),
('Eruvo', 'EruvoBot', NULL, 'eruvo.com', 0, NULL),
('Esperanza', 'EsperanzaBot', NULL, 'esperanza.to/bot/', 0, NULL),
('eStyle', 'eStyleSearch', NULL, NULL, 0, NULL),
('Eurip', 'EuripBot', NULL, 'eurip.com', 0, NULL),
('Fast', 'FAST MetaWeb Crawler', NULL, NULL, 0, NULL),
('FAST Enterprise', 'FAST Enterprise Crawler', 'fastsearch.net', NULL, 0, NULL),
('Feedster', 'Feedster Crawler', NULL, NULL, 0, NULL),
('FetchAPI', 'Fetch API Request', NULL, NULL, -1, 'Some sort of application that tries to download and store your full website.\r\nDoesn\'t follow robots.txt'),
('fg', 'fgcrawler', NULL, NULL, -1, 'Doesn\'t follow robots.txt'),
('Filangy', 'Filangy', NULL, 'filangy.com/filangyinfo.jsp?inc=robots.jsp', 0, NULL),
('Findexa', 'Findexa Crawler', 'gulesider.no', 'findexa.no/gulesider/article26548.ece', 0, NULL),
('FindLinks', 'findlinks', NULL, 'wortschatz.uni-leipzig.de/findlinks/', 0, NULL),
('Franklin', 'Franklin locator', NULL, NULL, -1, NULL),
('FullWeb', 'Full Web Bot', NULL, NULL, -1, NULL),
('Fyber', 'FyberSpider', NULL, 'fybersearch.com/fyberspider.php', 0, NULL),
('Gais', 'Gaisbot', NULL, 'gais.cs.ccu.edu.tw/robot.php', 0, NULL),
('Genie', 'geniebot', NULL, 'genieknows.com', 0, NULL),
('GetRight', 'GetRight/', NULL, NULL, 0, NULL),
('Giga', 'Gigabot/', NULL, 'gigablast.com/spider.html', 0, NULL),
('Girafa', 'Girafabot', NULL, 'girafa.com', 0, NULL),
('GoForIt', 'GOFORITBOT', NULL, 'goforit.com/about/', 0, NULL),
('Gonzo', 'gonzo1', '.t-ipconnect.de', 'telekom.de', 0, NULL),
('Google', 'Googlebot', 'crawl[0-9\\-]+.googlebot.com', 'google.com/bot.html', 0, NULL),
('GoogleAds', 'Mediapartners-Google', NULL, NULL, 0, NULL),
('GoogleImg', 'Googlebot-Image', NULL, NULL, 0, NULL),
('GPU', 'GPU p2p crawler', NULL, 'gpu.sourceforge.net/search_engine.php', 0, NULL),
('Grub', 'grub-client', NULL, 'grub.org', 0, NULL),
('GSA', 'gsa-crawler', NULL, 'arsenaldigital.com', 0, NULL),
('HappyFun', 'HappyFunBot/', NULL, 'happyfunsearch.com/bot.html', 0, NULL),
('Harvest', 'Harvest/', NULL, NULL, 0, NULL),
('HeadScan', 'head-scan.pl/', NULL, NULL, -1, NULL),
('Heritrix', 'heritrix/', NULL, 'crawler.xtramind.com', 0, NULL),
('HooWWWer', 'HooWWWer', NULL, 'cosco.hiit.fi/search/hoowwwer/', 0, NULL),
('htdig', 'htdig/', NULL, NULL, -1, NULL),
('HTMLParser', 'HTMLParser/', NULL, 'htmlparser.sourceforge.net', -1, 'Doesn\'t follow robots.txt'),
('HTTrack', 'HTTrack', NULL, NULL, 0, NULL),
('Ichiro', 'ichiro/', NULL, 'nttr.co.jp', 0, NULL),
('IconSurf', 'IconSurf/', NULL, 'iconsurf.com/robot.html', 0, NULL),
('Industry', 'Industry Program', NULL, NULL, -1, NULL),
('Indy', 'Indy Library', NULL, NULL, -1, 'Originally, the Indy Library is a programming library which is available at http://www.nevrona.com/Indy or http://indy.torry.net under an Open Source license. This library is included with Borland Delphi 6, 7, C++Builder 6, plus all of the Kylix versions. Unfortunately, this library is hi-jacked and abused by some Chinese spam bots. All recent user-agents with the unmodified \"Indy Library\" string were of Chinese origin.\r\nDoesn\'t follow robots.txt'),
('InetURL', 'InetURL/', NULL, NULL, 0, NULL),
('Infocious', 'InfociousBot', NULL, 'corp.infocious.com/tech_crawler.php', 0, NULL),
('Ingrid', 'INGRID', NULL, 'webmaster.ilse.nl/jsp/webmaster.jsp', 0, NULL),
('Interseek', 'InterseekWeb/', NULL, NULL, 0, NULL),
('Ipwalk', 'IpwalkBot/', NULL, NULL, 0, NULL),
('IRL', 'IRLbot', NULL, 'irl.cs.tamu.edu/crawler', 0, NULL),
('Java', 'Java/', NULL, NULL, -1, 'Doesn\'t follow robots.txt'),
('Jyxo', 'Jyxobot/', NULL, NULL, 0, NULL),
('KnowItAll', 'KnowItAll(', NULL, 'cs.washington.edu', 0, NULL),
('Kumm', 'KummHttp/', NULL, NULL, 0, NULL),
('Lapozz', 'LapozzBot', NULL, 'robot.lapozz.hu/', 0, NULL),
('Larbin', 'larbin', NULL, 'larbin.sourceforge.net/index-eng.html', 0, NULL),
('LeechGet', 'LeechGet', NULL, 'leechget.net', 0, NULL),
('libwww-perl', 'libwww-perl/', NULL, NULL, 0, NULL),
('lmspider', 'lmspider', NULL, 'scansoft.com', 0, NULL),
('Local', 'LocalcomBot/', NULL, 'local.com/bot.htm', 0, NULL),
('Looksmart', 'ZyBorg/', '.looksmart.com', 'WISEnutbot.com', 0, NULL),
('LoveSMS', 'LoveSMS Search Engine', NULL, 'cauta.lovesms.ro', 0, NULL),
('Lycos', 'Lycos_Spider', '.lycos.com', NULL, 0, NULL),
('Mac Finder', 'Mac Finder', NULL, NULL, 0, NULL),
('Majestic-12', 'MJ12bot', NULL, 'majestic12.co.uk/bot.php', 0, NULL),
('MapoftheInternet', 'MapoftheInternet.com', NULL, 'mapoftheinternet.com', 0, NULL),
('McBot', 'McBot/', NULL, NULL, 0, NULL),
('Medusa', 'Medusa', NULL, NULL, -1, 'Medusa is a tool for finding images, movie-clips or other kinds of files on webpages and downloading them. You start by entering a starting URL and Medusa searches for the filetypes you are interested in on this page and all pages found up to a given depth.\r\nDoesn\'t follow robots.txt'),
('Metaspinner', 'Metaspinner/', NULL, 'meta-spinner.de', 0, NULL),
('MetaTag', 'MetaTagRobot', NULL, 'widexl.com/remote/search-engines/metatag-analyzer.html', 0, NULL),
('Minuteman', 'Minuteman', NULL, NULL, 0, NULL),
('Mirago', 'HenryTheMiragoRobot', NULL, 'miragorobot.com/scripts/mrinfo.asp', 0, NULL),
('Missauga', 'Missauga Locate', NULL, NULL, -1, 'Doesn\'t follow robots.txt'),
('Missigua', 'Missigua Locator', NULL, NULL, -1, 'Doesn\'t follow robots.txt'),
('Mister PiX', 'Mister PiX', NULL, NULL, 0, NULL),
('Mojeek', 'MojeekBot', NULL, 'mojeek.com/bot.html', 0, NULL),
('MSCCDS', 'Microsoft Scheduled Cache Cont', NULL, 'google.com/search?q=Scheduled+Cache+Content+Download+Service', -1, NULL),
('MDAIPP', 'Microsoft Data Access Internet', NULL, 'google.com/search?q=Microsoft+Data+Access+Internet+Publishin', -1, 'This agent is used to exploit your system regarding the following security issue in FrontPage2000: http://lists.grok.org.uk/pipermail/full-disclosure/2004-December/030467.html'),
('MSIECrawler', 'MSIECrawler', NULL, NULL, -1, NULL),
('MSN', 'msnbot', 'msnbot.msn.com', 'search.msn.com/msnbot.htm', 0, NULL),
('MSR', 'MSRBOT/', NULL, NULL, 0, NULL),
('MUC', 'Microsoft URL Control', NULL, NULL, 0, NULL),
('Naver', 'NaverBot', NULL, NULL, 0, NULL),
('NetMechanic', 'NetMechanic', NULL, NULL, 0, NULL),
('nicebot', 'nicebot', NULL, NULL, -1, NULL),
('Ninja', 'Download Ninja', NULL, NULL, 0, NULL),
('Noxtrum', 'noxtrumbot', NULL, 'noxtrum.com', 0, NULL),
('NRS', 'NetResearchServer', NULL, 'loopimprovements.com/robot.html', 0, NULL),
('Nutch', 'Nutch', NULL, 'nutch.org/docs/en/bot.html', 0, NULL),
('NutchCVS', 'NutchCVS/', NULL, 'lucene.apache.org/nutch/bot.html', 0, NULL),
('Nutscrape', 'Nutscrape/', NULL, NULL, 0, NULL),
('oegp', 'oegp', NULL, NULL, -1, 'Doesn\'t follow robots.txt'),
('Offline Explorer', 'Offline Explorer/', NULL, 'metaproducts.com', 0, 'A Windows offline browser that allows you to download an unlimited number of your favorite Web and FTP sites for later offline viewing, editing or browsing.'),
('OmniExplorer', 'OmniExplorer_Bot/', NULL, 'omni-explorer.com', -1, 'Doesn\'t follow robots.txt'),
('Onet', 'OnetSzukaj/', NULL, 'szukaj.onet.pl', 0, NULL),
('Openfind', 'Openbot/', NULL, 'openfind.com.tw/robot.html', 0, NULL),
('Orbit', 'Orbiter', NULL, 'dailyorbit.com/bot.htm', 0, NULL),
('P3P Validator', 'P3P Validator', NULL, NULL, 0, NULL),
('Patsearch', 'Patwebbot', NULL, 'herz-power.de/technik.html', 0, NULL),
('PhpDig', 'PhpDig/', NULL, 'phpdig.net/robot.php', 0, NULL),
('PicSearch', 'psbot/', NULL, 'picsearch.com/bot.html', 0, NULL),
('Pipeline', 'pipeLiner', NULL, 'pipeline-search.com/webmaster.html', 0, NULL),
('Pogodak', 'Pogodak', NULL, NULL, 0, NULL),
('Poly', 'polybot', NULL, 'cis.poly.edu/polybot/', 0, NULL),
('Pompos', 'Pompos/', NULL, 'dir.com/pompos.html', 0, NULL),
('Poodle', 'Poodle predictor', NULL, NULL, 0, NULL),
('Powermarks', 'Powermarks/', NULL, 'kaylon.com/power.html', 0, NULL),
('PrivacyFinder', 'PrivacyFinder Cache Bot', NULL, NULL, 0, NULL),
('Privatizer', 'privatizer.net', NULL, 'privatizer.net/whatis.php', 0, NULL),
('Production', 'Production Bot', NULL, NULL, 0, NULL),
('PS', 'Program Shareware', NULL, NULL, 0, NULL),
('PuxaRapido', 'PuxaRapido v1.0', NULL, NULL, 0, NULL),
('Python-urllib', 'Python-urllib/', NULL, NULL, 0, NULL),
('Qweery', 'qweery', NULL, NULL, 0, NULL),
('Rambler', 'StackRambler/', NULL, 'rambler.ru', 0, NULL),
('Roffle', 'Roffle/', NULL, NULL, -1, NULL),
('RPT-HTTP', 'RPT-HTTPClient/', NULL, NULL, -1, NULL),
('rssImages', 'rssImagesBot', NULL, 'herbert.groot.jebbink.nl/?app=rssImages', 0, NULL),
('Ryan', 'Ryanbot/', NULL, NULL, 0, NULL),
('SBIder', 'SBIder/', NULL, 'sitesell.com/sbider.html', 0, NULL),
('schibstedsok', 'schibstedsokbot', NULL, 'schibstedsok.no', 0, NULL),
('Schmozilla', 'Schmozilla/', NULL, NULL, -1, 'Doesn\'t follow robots.txt'),
('Scrubby', 'Scrubby', NULL, 'scrubtheweb.com/abs/meta-check.html', 0, NULL),
('ScSpider', 'ScSpider/', NULL, NULL, 0, NULL),
('SearchGuild', 'SearchGuild/', NULL, NULL, 0, 'DMOZ Experiment'),
('Seekbot', 'Seekbot', NULL, 'seekbot.net', 0, NULL),
('Seznam', 'SeznamBot/', NULL, 'fulltext.seznam.cz', 0, NULL),
('Siets', 'SietsCrawler/', NULL, NULL, 0, NULL),
('SitiDi', '/SitiDiBot/', NULL, 'SitiDi.net', 0, NULL),
('Snoopy', 'Snoopy', NULL, 'sourceforge.net/projects/snoopy/', 0, 'Snoopy is a PHP class that simulates a web browser. It automates the task of retrieving web page content and posting forms, for example.'),
('Sohu', 'sohu-search', NULL, 'sogou.com', 0, 'Searchbot of sohu.com'),
('Spambot', NULL, NULL, NULL, -1, 'Global name for bots which try to fill guestbooks and other stuff with garbage\r\nThey don\'t follow robots.txt either\r\n\r\nCurrent agents in this list:\r\nMissigua Locator\r\nProduction Bot\r\nFull Web Bot\r\nDemo Bot\r\nEducate Search\r\nFranklin locator\r\nIndustry Program\r\nMac Finder\r\nProgram Shareware\r\nMissauga Locate '),
('Spip', 'SPIP-', NULL, 'spip.net', 0, NULL),
('SurveyBot', 'SurveyBot/', NULL, 'whois.sc', 0, NULL),
('Susie', '!Susie', NULL, 'sync2it.com/susie', 0, NULL),
('Thumbshots', 'thumbshots-de-Bot', NULL, 'thumbshots.de', 0, NULL),
('Turnitin', 'TurnitinBot', NULL, 'turnitin.com/robot/crawlerinfo.html', 0, NULL),
('TutorGig', 'TutorGigBot', NULL, 'tutorgig.info', 0, NULL),
('Twiceler', 'Twiceler', NULL, 'cuill.com/robots.html', 0, NULL),
('Updated', 'updated/', NULL, 'updated.com', 0, NULL),
('Versus', 'versus crawler', NULL, 'eda.baykan@epfl.ch', 0, NULL),
('Vagabondo', 'Vagabondo', NULL, NULL, 0, NULL),
('Virgo', 'Virgo/', NULL, NULL, 0, NULL),
('Voila', 'VoilaBot', NULL, 'voila.com', 0, NULL),
('vspider', 'vspider', NULL, NULL, 0, NULL),
('W3C Checklink', 'W3C-checklink', NULL, NULL, 0, NULL),
('W3C Validator', 'W3C_Validator', NULL, NULL, 0, NULL),
('Walhello', 'appie', NULL, 'walhello.com', 0, NULL),
('WebIndexer', 'WebIndexer/', NULL, NULL, 0, NULL),
('WebReaper', 'WebReaper', NULL, 'webreaper.net', 0, NULL),
('WebStripper', 'WebStripper/', NULL, NULL, 0, NULL),
('Wget', 'Wget/', NULL, NULL, 0, NULL),
('Wire', 'WIRE', NULL, NULL, 0, NULL),
('YaCy', 'yacy', NULL, 'yacy.net/yacy/', -1, 'p2p-based distributed Web Search Engine\r\nDoesn\'t follow robots.txt'),
('Yadows', 'YadowsCrawler', NULL, 'yadows.com', 0, NULL),
('Yahoo', 'Yahoo! Slurp', NULL, 'help.yahoo.com/help/us/ysearch/slurp', 0, NULL),
('YahooFS', 'YahooFeedSeeker/', '.yahoo.', 'help.yahoo.com/help/us/ysearch/slurp', 0, NULL),
('YahooMM', 'Yahoo-MMCrawler', NULL, 'help.yahoo.com/help/us/ysearch/slurp', 0, NULL),
('YANDEX', 'YANDEX', NULL, NULL, 0, NULL),
('Zeus', 'Zeus', NULL, NULL, 0, NULL),
('NextGen', 'NextGenSearchBot', NULL, 'about.zoominfo.com/PublicSite/NextGenSearchBot.asp', 0, NULL),
('PoI', 'PictureOfInternet/', NULL, 'malfunction.org/poi', -1, NULL),
('Sensis', 'Sensis Web Crawler', NULL, 'sensis.com.au', 0, NULL),
('IlTrovatore', 'IlTrovatore-Setaccio/', NULL, 'iltrovatore.it/bot.html', -1, NULL),
('Rufus', 'RufusBot', NULL, '64.124.122.252/feedback.html', -1, NULL),
('WebMiner', 'WebMiner', NULL, NULL, -1, 'See RufusBot'),
('Accoona', 'Accoona-AI-Agent/', NULL, 'accoona.com', 0, NULL),
('Xirq', 'xirq/', NULL, 'xirq.com/', 0, NULL),
('Blogpulse', 'Blogpulse', NULL, 'blogpulse.com', 0, 'IntelliSeek service'),
('KnackAttack', 'KnackAttack', NULL, NULL, -1, NULL),
('Miva', 'Miva', NULL, 'miva.com', 0, NULL),
('PictureRipper', 'PictureRipper/', NULL, 'pictureripper.com', -1, NULL),
('Teleport', 'Teleport Pro/', NULL, NULL, -1, NULL),
('NetSprint', 'NetSprint', NULL, NULL, -1, NULL),
('SVSpider', 'SVSpider/', NULL, 'bildkiste.de', -1, NULL),
('SVSearch', 'SVSearchRobot/', NULL, NULL, -1, NULL),
('Lorkyll', 'Lorkyll', NULL, '444.net', -1, NULL);

CREATE TABLE `nuke_session` (
  `uname` varchar(255) NOT NULL DEFAULT '',
  `time` varchar(14) NOT NULL DEFAULT '',
  `starttime` varchar(14) NOT NULL DEFAULT '',
  `host_addr` varchar(48) NOT NULL DEFAULT '',
  `guest` int(1) NOT NULL DEFAULT 0,
  `module` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_shoutbox_censor` (
  `id` int(9) NOT NULL,
  `text` varchar(30) NOT NULL,
  `replacement` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_shoutbox_censor` (`id`, `text`, `replacement`) VALUES
(1, '@$$', 'butt'),
(2, 'a$$', 'butt'),
(3, 'anton', '[censored]'),
(4, 'arse', 'butt'),
(5, 'arsehole', '[censored]'),
(6, 'ass', 'butt'),
(7, 'ass muncher', '[censored]'),
(8, 'asshole', '[censored]'),
(9, 'asstooling', '[censored]'),
(10, 'asswipe', '[censored]'),
(11, 'b!tch', '[censored]'),
(12, 'b17ch', '[censored]'),
(13, 'b1tch', '[censored]'),
(14, 'bastard', '[censored]'),
(15, 'beefcurtins', '[censored]'),
(16, 'bi7ch', '[censored]'),
(17, 'bitch', '[censored]'),
(18, 'bitchy', '[censored]'),
(19, 'boiolas', '[censored]'),
(20, 'bollocks', '[censored]'),
(21, 'breasts', '[censored]'),
(22, 'brown nose', '[censored]'),
(23, 'bugger', 'damn'),
(24, 'butt pirate', '[censored]'),
(25, 'c0ck', '[censored]'),
(26, 'cawk', '[censored]'),
(27, 'chink', '[censored]'),
(28, 'clitsaq', '[censored]'),
(29, 'cock', '[censored]'),
(30, 'cockbite', '[censored]'),
(31, 'cockgobbler', '[censored]'),
(32, 'cocksucker', '[censored]'),
(33, 'cum', '[censored]'),
(34, 'cunt', '[censored]'),
(35, 'dago', '[censored]'),
(36, 'daygo', '[censored]'),
(37, 'dego', '[censored]'),
(38, 'dick', '[censored]'),
(39, 'dick wad', '[censored]'),
(40, 'dickhead', '[censored]'),
(41, 'dickweed', '[censored]'),
(42, 'douchebag', '[censored]'),
(43, 'dziwka', '[censored]'),
(44, 'ekto', '[censored]'),
(45, 'enculer', '[censored]'),
(46, 'faen', '[censored]'),
(47, 'fag', '[censored]'),
(48, 'faggot', '[censored]'),
(49, 'fart', '[censored]'),
(50, 'fatass', '[censored]'),
(51, 'feg', '[censored]'),
(52, 'felch', '[censored]'),
(53, 'ficken', '[censored]'),
(54, 'fitta', '[censored]'),
(55, 'fitte', '[censored]'),
(56, 'flikker', '[censored]'),
(57, 'fok', '$#%!'),
(58, 'fuck', '$#%!'),
(59, 'fu(k', '$#%!'),
(60, 'fucker', '[censored]'),
(61, 'fucking', '[censored]'),
(62, 'fuckwit', '[censored]'),
(63, 'fuk', '[censored]'),
(64, 'fuking', '[censored]'),
(65, 'futkretzn', '[censored]'),
(66, 'fux0r', '$#%!'),
(67, 'gook', '[censored]'),
(68, 'h0r', '[censored]'),
(69, 'handjob', '[censored]'),
(70, 'helvete', '[censored]'),
(71, 'honkey', '[censored]'),
(72, 'hore', '[censored]'),
(73, 'hump', '[censored]'),
(74, 'injun', '[censored]'),
(75, 'kawk', '[censored]'),
(76, 'kike', '[censored]'),
(77, 'knulle', '[censored]'),
(78, 'kraut', '[censored]'),
(79, 'kuk', '[censored]'),
(80, 'kuksuger', '[censored]'),
(81, 'kurac', '[censored]'),
(82, 'kurwa', '[censored]'),
(83, 'langer', '[censored]'),
(84, 'masturbation', '[censored]'),
(85, 'merd', '[censored]'),
(86, 'motherfucker', '[censored]'),
(87, 'motherfuckingcocksucker', '[censored]'),
(88, 'mutherfucker', '[censored]'),
(89, 'nepesaurio', '[censored]'),
(90, 'nigga', '[censored]'),
(91, 'nigger', '[censored]'),
(92, 'nonce', '[censored]'),
(93, 'nutsack', '[censored]'),
(94, 'one-eyed-trouser-snake', '[censored]'),
(95, 'penis', '[censored]'),
(96, 'picka', '[censored]'),
(97, 'pissant', '[censored]'),
(98, 'pizda', '[censored]'),
(99, 'politician', '[censored]'),
(100, 'prick', '[censored]'),
(101, 'puckface', '[censored]'),
(102, 'pule', '[censored]'),
(103, 'pussy', '[censored]'),
(104, 'puta', '[censored]'),
(105, 'puto', '[censored]'),
(106, 'rimjob', '[censored]'),
(107, 'rubber', '[censored]'),
(108, 'scheisse', '[censored]'),
(109, 'schlampe', '[censored]'),
(110, 'schlong', '[censored]'),
(111, 'screw', '[censored]'),
(112, 'shit', '****'),
(113, 'shiteater', '[censored]'),
(114, 'shiz', '[censored]'),
(115, 'skribz', '[censored]'),
(116, 'skurwysyn', '[censored]'),
(117, 'slut', '[censored]'),
(118, 'spermburper', '[censored]'),
(119, 'spic', '[censored]'),
(120, 'spierdalaj', '[censored]'),
(121, 'splooge', '[censored]'),
(122, 'spunk', '[censored]'),
(123, 'tatas', '[censored]'),
(124, 'tits', '[censored]'),
(125, 'toss the salad', '[censored]'),
(126, 'twat', '[censored]'),
(127, 'unclefucker', '[censored]'),
(128, 'vagina', '[censored]'),
(129, 'vittu', '[censored]'),
(130, 'votze', '[censored]'),
(131, 'wank', '[censored]'),
(132, 'wanka', '[censored]'),
(133, 'wanker', '[censored]'),
(134, 'wankers', '[censored]'),
(135, 'wankstain', '[censored]'),
(136, 'whore', '[censored]'),
(137, 'wichser', '[censored]'),
(138, 'wop', '[censored]'),
(139, 'yed', '[censored]');

CREATE TABLE `nuke_shoutbox_conf` (
  `id` int(9) NOT NULL DEFAULT 0,
  `color1` varchar(20) NOT NULL DEFAULT '',
  `color2` varchar(20) NOT NULL DEFAULT '',
  `date` varchar(5) NOT NULL DEFAULT '',
  `time` varchar(5) NOT NULL DEFAULT '',
  `number` varchar(5) NOT NULL DEFAULT '',
  `ipblock` varchar(5) NOT NULL DEFAULT '',
  `nameblock` varchar(5) NOT NULL DEFAULT '',
  `censor` varchar(5) NOT NULL DEFAULT '',
  `tablewidth` char(3) NOT NULL DEFAULT '',
  `urlonoff` varchar(5) NOT NULL DEFAULT '',
  `delyourlastpost` varchar(5) NOT NULL DEFAULT '',
  `anonymouspost` varchar(5) NOT NULL DEFAULT '',
  `height` varchar(5) NOT NULL DEFAULT '',
  `themecolors` varchar(5) NOT NULL DEFAULT '',
  `textWidth` varchar(4) NOT NULL DEFAULT '',
  `nameWidth` varchar(4) NOT NULL DEFAULT '',
  `smiliesPerRow` varchar(4) NOT NULL DEFAULT '',
  `reversePosts` varchar(4) NOT NULL DEFAULT '',
  `timeOffset` varchar(10) NOT NULL DEFAULT '',
  `urlanononoff` varchar(10) NOT NULL DEFAULT '',
  `pointspershout` varchar(5) NOT NULL DEFAULT '',
  `shoutsperpage` varchar(5) NOT NULL DEFAULT '',
  `serverTimezone` varchar(5) NOT NULL DEFAULT '',
  `blockxxx` varchar(5) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_shoutbox_conf` (`id`, `color1`, `color2`, `date`, `time`, `number`, `ipblock`, `nameblock`, `censor`, `tablewidth`, `urlonoff`, `delyourlastpost`, `anonymouspost`, `height`, `themecolors`, `textWidth`, `nameWidth`, `smiliesPerRow`, `reversePosts`, `timeOffset`, `urlanononoff`, `pointspershout`, `shoutsperpage`, `serverTimezone`, `blockxxx`) VALUES
(1, '#EBEBEB', '#FFFFFF', 'yes', 'yes', '10', 'yes', 'yes', 'yes', '150', 'yes', 'yes', 'yes', '150', 'no', '20', '10', '7', 'no', '0', 'no', '0', '25', '-6', 'yes');

CREATE TABLE `nuke_shoutbox_date` (
  `id` int(5) NOT NULL DEFAULT 0,
  `date` varchar(10) NOT NULL DEFAULT '',
  `time` varchar(10) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_shoutbox_date` (`id`, `date`, `time`) VALUES
(1, 'd-m-Y', 'g:i:a');

CREATE TABLE `nuke_shoutbox_emoticons` (
  `id` int(9) NOT NULL,
  `text` varchar(20) NOT NULL,
  `image` varchar(70) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_shoutbox_emoticons` (`id`, `text`, `image`) VALUES
(1, ':D', '<img src=images/blocks/shout_box/icon_biggrin.gif>'),
(2, ':-D', '<img src=images/blocks/shout_box/icon_biggrin.gif>'),
(3, ':grin:', '<img src=images/blocks/shout_box/icon_biggrin.gif>'),
(4, ':)', '<img src=images/blocks/shout_box/icon_smile.gif>'),
(5, ':-)', '<img src=images/blocks/shout_box/icon_smile.gif>'),
(6, ':smile:', '<img src=images/blocks/shout_box/icon_smile.gif>'),
(7, ':(', '<img src=images/blocks/shout_box/icon_sad.gif>'),
(8, ':-(', '<img src=images/blocks/shout_box/icon_sad.gif>'),
(9, ':sad:', '<img src=images/blocks/shout_box/icon_sad.gif>'),
(10, ':o', '<img src=images/blocks/shout_box/icon_surprised.gif>'),
(11, ':-o', '<img src=images/blocks/shout_box/icon_surprised.gif>'),
(12, ';)', '<img src=images/blocks/shout_box/icon_wink.gif>'),
(13, ';-)', '<img src=images/blocks/shout_box/icon_wink.gif>'),
(14, ':wink:', '<img src=images/blocks/shout_box/icon_wink.gif>'),
(15, ':lol:', '<img src=images/blocks/shout_box/icon_lol.gif>'),
(16, '8O', '<img src=images/blocks/shout_box/icon_eek.gif>'),
(17, '8-O', '<img src=images/blocks/shout_box/icon_eek.gif>'),
(18, ':eek:', '<img src=images/blocks/shout_box/icon_eek.gif>'),
(19, ':shock:', '<img src=images/blocks/shout_box/icon_eek.gif>'),
(20, ':?', '<img src=images/blocks/shout_box/icon_confused.gif>'),
(21, ':-?', '<img src=images/blocks/shout_box/icon_confused.gif>'),
(22, ':S', '<img src=images/blocks/shout_box/icon_confused.gif>'),
(23, '8)', '<img src=images/blocks/shout_box/icon_cool.gif>'),
(24, '8-)', '<img src=images/blocks/shout_box/icon_cool.gif>'),
(25, ':x', '<img src=images/blocks/shout_box/icon_mad.gif>'),
(26, ':-x', '<img src=images/blocks/shout_box/icon_mad.gif>'),
(27, ':P', '<img src=images/blocks/shout_box/icon_razz.gif>'),
(28, ':-P', '<img src=images/blocks/shout_box/icon_razz.gif>'),
(29, ':razz:', '<img src=images/blocks/shout_box/icon_razz.gif>'),
(30, ':oops:', '<img src=images/blocks/shout_box/icon_redface.gif>'),
(31, ':redface:', '<img src=images/blocks/shout_box/icon_redface.gif>'),
(32, ':cry:', '<img src=images/blocks/shout_box/icon_cry.gif>'),
(33, ':evil:', '<img src=images/blocks/shout_box/icon_evil.gif>'),
(34, ':twisted:', '<img src=images/blocks/shout_box/icon_twisted.gif>'),
(35, ':roll:', '<img src=images/blocks/shout_box/icon_rolleyes.gif>'),
(36, ':!:', '<img src=images/blocks/shout_box/icon_exclaim.gif>'),
(37, ':exclaim:', '<img src=images/blocks/shout_box/icon_exclaim.gif>'),
(38, ':?:', '<img src=images/blocks/shout_box/icon_question.gif>'),
(39, ':question:', '<img src=images/blocks/shout_box/icon_question.gif>'),
(40, ':idea:', '<img src=images/blocks/shout_box/icon_idea.gif>'),
(41, ':arrow:', '<img src=images/blocks/shout_box/icon_arrow.gif>'),
(42, ':|', '<img src=images/blocks/shout_box/icon_neutral.gif>'),
(43, ':-|', '<img src=images/blocks/shout_box/icon_neutral.gif>'),
(44, ':mrgreen:', '<img src=images/blocks/shout_box/icon_mrgreen.gif>'),
(45, ':shy:', '<img src=images/blocks/shout_box/shy.gif>'),
(46, ':dead:', '<img src=images/blocks/shout_box/dead.gif>'),
(47, ':embar:', '<img src=images/blocks/shout_box/embar.gif>'),
(48, ':bigrazz:', '<img src=images/blocks/shout_box/bigrazz.gif>'),
(49, ':yes:', '<img src=images/blocks/shout_box/yes.gif>'),
(50, ':no:', '<img src=images/blocks/shout_box/no.gif>'),
(51, ':uhoh:', '<img src=images/blocks/shout_box/uhoh.gif>'),
(52, ':upset:', '<img src=images/blocks/shout_box/upset.gif>'),
(53, ':sigh:', '<img src=images/blocks/shout_box/sigh.gif>'),
(54, 'zzz', '<img src=images/blocks/shout_box/sleep.gif>'),
(55, ':sleep:', '<img src=images/blocks/shout_box/sleep.gif>'),
(56, ':confused:', '<img src=images/blocks/shout_box/confused.gif>'),
(57, ':aua:', '<img src=images/blocks/shout_box/aua.gif>');

CREATE TABLE `nuke_shoutbox_ipblock` (
  `id` int(9) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_shoutbox_manage_count` (
  `id` int(9) NOT NULL,
  `admin` varchar(25) NOT NULL DEFAULT '',
  `aCount` varchar(5) NOT NULL DEFAULT '10'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_shoutbox_manage_count` (`id`, `admin`, `aCount`) VALUES
(1, 'a', '10'),
(2, 'V', '10');

CREATE TABLE `nuke_shoutbox_nameblock` (
  `id` int(9) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_shoutbox_shouts` (
  `id` int(9) NOT NULL,
  `name` varchar(20) NOT NULL,
  `comment` text NOT NULL,
  `date` varchar(10) NOT NULL,
  `time` varchar(10) NOT NULL,
  `ip` varchar(39) DEFAULT NULL,
  `timestamp` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_shoutbox_shouts` (`id`, `name`, `comment`, `date`, `time`, `ip`, `timestamp`) VALUES
(1, 'OurScripts.86it.us', 'Thank You for trying this out!', '8-6-05', '24:00', 'noip', '1102320000');

CREATE TABLE `nuke_shoutbox_sticky` (
  `id` int(9) NOT NULL,
  `name` varchar(20) NOT NULL,
  `comment` text NOT NULL,
  `timestamp` varchar(20) NOT NULL,
  `stickySlot` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_shoutbox_themes` (
  `id` int(9) NOT NULL,
  `themeName` varchar(50) DEFAULT NULL,
  `blockColor1` varchar(20) DEFAULT NULL,
  `blockColor2` varchar(20) DEFAULT NULL,
  `border` varchar(20) DEFAULT NULL,
  `menuColor1` varchar(20) DEFAULT NULL,
  `menuColor2` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_shoutbox_themes` (`id`, `themeName`, `blockColor1`, `blockColor2`, `border`, `menuColor1`, `menuColor2`) VALUES
(1, 'Titanium_Core', '', '', '', '', '');

CREATE TABLE `nuke_shoutbox_theme_images` (
  `id` int(9) NOT NULL,
  `themeName` varchar(50) DEFAULT NULL,
  `blockArrowColor` varchar(50) NOT NULL,
  `blockBackgroundImage` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_shoutbox_version` (
  `id` int(5) NOT NULL,
  `version` varchar(10) NOT NULL,
  `datechecked` varchar(2) NOT NULL,
  `versionreported` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_shoutbox_version` (`id`, `version`, `datechecked`, `versionreported`) VALUES
(1, '8.5', '0', '0');

CREATE TABLE `nuke_sommaire` (
  `groupmenu` int(2) NOT NULL DEFAULT 0,
  `name` varchar(200) DEFAULT NULL,
  `image` varchar(99) DEFAULT NULL,
  `lien` text DEFAULT NULL,
  `hr` char(2) DEFAULT NULL,
  `center` char(2) DEFAULT NULL,
  `bgcolor` tinytext DEFAULT NULL,
  `invisible` int(1) DEFAULT NULL,
  `class` tinytext DEFAULT NULL,
  `bold` char(2) DEFAULT NULL,
  `new` char(2) DEFAULT NULL,
  `listbox` char(2) DEFAULT NULL,
  `dynamic` char(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_sommaire` (`groupmenu`, `name`, `image`, `lien`, `hr`, `center`, `bgcolor`, `invisible`, `class`, `bold`, `new`, `listbox`, `dynamic`) VALUES
(0, 'Home', 'icon_home.gif', 'index.php', '', '', '', 2, 'storytitle', '', '', '', 'on'),
(1, 'Discussions', 'icon_community.gif', '', 'on', '', '', 2, 'storytitle', '', '', '', 'on'),
(2, 'News', 'favoritos.gif', '', '', '', '', 2, 'storytitle', '', '', '', 'on'),
(3, 'Files & Links', 'som_downloads.gif', '', '', '', '', 2, 'storytitle', '', '', '', 'on'),
(4, 'General', 'icon_poll.gif', '', '', '', '', 2, 'storytitle', '', '', '', 'on'),
(5, 'Infos', 'icon_members.gif', '', '', '', '', 2, 'storytitle', '', '', '', 'on'),
(99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

CREATE TABLE `nuke_sommaire_categories` (
  `id` int(11) NOT NULL,
  `groupmenu` int(2) NOT NULL DEFAULT 0,
  `module` varchar(50) NOT NULL DEFAULT '',
  `url` text NOT NULL,
  `url_text` text NOT NULL,
  `image` varchar(50) NOT NULL DEFAULT '',
  `new` char(2) DEFAULT NULL,
  `new_days` tinyint(4) NOT NULL DEFAULT -1,
  `class` varchar(20) DEFAULT NULL,
  `bold` char(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_sommaire_categories` (`id`, `groupmenu`, `module`, `url`, `url_text`, `image`, `new`, `new_days`, `class`, `bold`) VALUES
(1, 1, 'Forums', '', '', 'tree-T.gif', '', 7, 'boxcontent', ''),
(2, 1, 'Private_Messages', '', '', 'tree-L.gif', '', 7, 'boxcontent', ''),
(3, 2, 'News', '', '', 'tree-T.gif', '', 7, 'boxcontent', ''),
(4, 2, 'Topics', '', '', 'tree-T.gif', '', 7, 'boxcontent', ''),
(5, 2, 'Stories_Archive', '', '', 'tree-T.gif', '', 7, 'boxcontent', ''),
(6, 2, 'Submit_News', '', '', 'tree-L.gif', '', 7, 'boxcontent', ''),
(7, 3, 'Downloads', '', '', 'tree-T.gif', '', 7, 'boxcontent', ''),
(8, 3, 'Web_Links', '', '', 'tree-L.gif', '', 7, 'boxcontent', ''),
(9, 4, 'Content', '', '', 'tree-T.gif', '', 7, 'boxcontent', ''),
(10, 4, 'faq', '', '', 'tree-T.gif', '', 7, 'boxcontent', ''),
(11, 4, 'Top', '', '', 'tree-T.gif', '', 7, 'boxcontent', ''),
(12, 4, 'Reviews', '', '', 'tree-L.gif', '', 7, 'boxcontent', ''),
(13, 5, 'Feedback', '', '', 'tree-T.gif', '', 7, 'boxcontent', ''),
(14, 5, 'Recommend_Us', '', '', 'tree-T.gif', '', 7, 'boxcontent', ''),
(15, 5, 'Statistics', '', '', 'tree-T.gif', '', 7, 'boxcontent', ''),
(16, 5, 'Search', '', '', 'tree-T.gif', '', 7, 'boxcontent', ''),
(17, 5, 'Your_Account', '', '', 'tree-L.gif', '', 7, 'boxcontent', '');

CREATE TABLE `nuke_stats_hour` (
  `year` smallint(6) NOT NULL DEFAULT 0,
  `month` tinyint(4) NOT NULL DEFAULT 0,
  `date` tinyint(4) NOT NULL DEFAULT 0,
  `hour` tinyint(4) NOT NULL DEFAULT 0,
  `hits` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_stories` (
  `sid` int(11) NOT NULL,
  `catid` int(11) NOT NULL DEFAULT 0,
  `aid` varchar(25) NOT NULL DEFAULT '',
  `title` varchar(80) DEFAULT NULL,
  `datePublished` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `dateModified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `hometext` text DEFAULT NULL,
  `bodytext` text NOT NULL,
  `comments` int(11) DEFAULT 0,
  `counter` mediumint(8) UNSIGNED DEFAULT NULL,
  `topic` int(3) NOT NULL DEFAULT 1,
  `informant` varchar(25) NOT NULL DEFAULT '',
  `notes` text NOT NULL,
  `ihome` int(1) NOT NULL DEFAULT 0,
  `alanguage` varchar(30) NOT NULL DEFAULT '',
  `acomm` int(1) NOT NULL DEFAULT 0,
  `haspoll` int(1) NOT NULL DEFAULT 0,
  `pollID` int(10) NOT NULL DEFAULT 0,
  `score` int(10) NOT NULL DEFAULT 0,
  `ratings` int(10) NOT NULL DEFAULT 0,
  `associated` text NOT NULL,
  `ticon` tinyint(1) NOT NULL DEFAULT 0,
  `writes` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_stories` (`sid`, `catid`, `aid`, `title`, `datePublished`, `dateModified`, `hometext`, `bodytext`, `comments`, `counter`, `topic`, `informant`, `notes`, `ihome`, `alanguage`, `acomm`, `haspoll`, `pollID`, `score`, `ratings`, `associated`, `ticon`, `writes`) VALUES
(1, 3, 'WebMaster', 'About PHP-Nuke Evolution Xtreme (US Version)', '2021-01-01 10:56:20', '2021-05-10 13:11:58', '<p>The <strong>US</strong> version of<strong> PHP-Nuke Evolution Xtreme CMS</strong>&nbsp;is not compatible with the <strong>UK </strong>version as far as themes go, however it does support modules and blocks from the <strong>UK</strong> version. What exactly is Xtreme? It is an open-source CMS wrote in PHP as a programming language and development was first started in 2005. The software comes with a set of basic features like a WYSIWYG editor, an admin interface with drag and drop blocks, spam protection, and image processing. Nuke Evolution-Xtreme CMS comes with the ability to use various modules that will extend the current functionality of your portal/website. The latest version available for download is 3.0.1b and is still in beta.</p>\n\n<p><strong>PHP-Nuke Evolution</strong> <strong>Xtreme</strong> now comes with v5 of the Titanium Facebook SDK kit. It&#39;s already set up. All you have to do is add your app ID and secret... If you need help, we would be glad to set it up for FREE.</p>\n\n<p><strong>PHP-Nuke Evolution Xtreme</strong> now comes with v5 of the Titanium Google SDK. Everything you need to be a Google developer is already there, just have a look inside your includes directory.</p>\n\n<p>[b]NOTE:[/b] Your admin and user accounts have already been logged in for you so please visit [url=admin.php]this link[/url] to get started.</p>\n\n<p>You can edit or remove this blog message by going into the Blog Admin Panel located in the Admin area, or look below and you can edit by clicking the pencil or the x to delete this blog message.</p>', '', 0, 465, 1, 'WebMaster', '', 0, '', 0, 0, 0, 65, 13, '', 0, 1),
(7, 4, 'TheGhost', 'New Blog Signature Mod', '2021-04-24 08:14:43', '2021-05-10 09:04:01', '<p>TESTING BLOG SIGNATURE MOD v1</p>\n\n<p>This mod was written by Ernest Buffington</p>\n\n<p>The Blog Signature Mod is having a lot of new features added, such as the ability to use your callsign or real name. You will also be able to enable and disable the blog signature at will globally or for each post.</p>', '', 0, 94, 7, 'TheGhost', '', 0, '', 0, 0, 0, 15, 3, '', 0, 1),
(8, 3, 'webmaster', 'We Will Be Updating The Modules 1 by 1', '2021-04-25 23:44:48', '2021-05-10 09:05:34', '<p>We are going through each module and fixing all the cosmetic issues that we are sure everyone is aware of.</p>\n\n<p>If you see any issues at all please feel free to submit a report. You can do so by clicking [url=modules.php?name=Network_Projects&amp;op=Project&amp;project_id=77]HERE[/url]</p>\n\n<p>A lot of the modules are being re-written for future versions of PHP as well as cosmetic issues.</p>\n\n<p>We would like to apologize for the slacking that has been going on over the years. We intend to keep the US version updated and will cater to anyone who has a mod request or needs install help.</p>\n\n<p>We would again like to thank everyone for stopping in to visit.</p>', '', 0, 40, 1, 'webmaster', '', 0, 'english', 0, 0, 0, 10, 2, '', 0, 1),
(9, 1, 'webmaster', 'New Google Site Map Generator Module', '2021-04-27 11:48:34', '2021-05-10 05:53:21', '<p><strong>Module Name: </strong>Google-Site-Map<br />\n<strong>Author:</strong> Ernest Buffington<br />\n<strong>Version:</strong> v1.0<br />\n<strong>Core:</strong> PHP-Nuke Evolution Xtreme v3.0.1a &lt;&gt;&nbsp;v3.0.1b</p>\n\n<p>The original sitemap was an abandoned project and idea, not by me but whoever was working on it originally. The new one is awesome and works great. I&#39;m not sure people really understand how important this little module is. Contrary to popular belief, this is an important part of being found on the internet. The class.sitemap.php file can be found in the&nbsp;<strong>includes/classes </strong>directory.</p>\n\n<p>I used some of the old code, not much just a few lines here and there, and the old sitemap&#39;s admin panel is the same.</p>\n\n<p>This uses <strong>sitemap 0.9</strong></p>\n\n<p>The new Google Site Map Generator works better than just about anything I have seen. You will need to delete the old <strong>sitemap.xml</strong> file that is in the root directory of your portal/website as it is no longer used. The new <strong>sitemap.xml</strong> file is generated in the <strong>xmls/sitemap</strong> folder. This is not the file you tell google to look at.</p>\n\n<p>You will need to point Google to your <strong>sitemap-index.xml</strong> file which resides in that very same directory.</p>\n\n<p>You will do this by telling Google where the file is at like so <strong>https://yourwebsite.com/xmls/sitemap/sitemap-index.xml</strong></p>\n\n<p>You can do so by going here <strong>https://search.google.com/search-console?resource_id=sc-domain:yourdomain.com</strong></p>\n\n<p>I used a fast and lightweight class for generating Google-Site-Map <strong>XML</strong> files and index of sitemap files. Written in <strong>PHP</strong> and uses <strong>XMLWriter</strong> extension (wrapper for <strong>libxml</strong> <strong>xmlWriter</strong> API) for creating <strong>XML</strong> files. <strong>XMLWriter</strong> extension is enabled by default in <strong>PHP</strong> 5 &gt; = 5.1.2. If you have more than 50000 URLs, it will split items into separated files. (In benchmarks, 1.000.000 URLs were generating in 8 seconds) The version we are using is a slightly modified version of the original.</p>\n\n<p>The Sitemap class is now added to a <strong>SitemapPHP</strong> <strong>namespace</strong>.</p>', '', 0, 78, 5, 'webmaster', '', 0, 'english', 0, 0, 0, 20, 4, '', 0, 1),
(10, 5, 'WebMaster', 'New Visitor Log Center Block', '2021-04-27 20:32:27', '2021-05-09 08:58:36', '<p><strong>Block Name: </strong>Titanium Visitor Log Center<br />\n<strong>Author: </strong>Ernest Allen Buffington<br />\n<strong>Filename:</strong> block-Titanium_Visitor_Log_center.php<br />\n<strong>Block Type:</strong> Center Block<br />\n<strong>Version:</strong> v1.0<br />\n<strong>Core:</strong> PHP-Nuke Evolution 2.0.9e &lt;&gt;&nbsp;3.0.1b</p>\n\n<p>This block was created with advanced resolution checking in mind. You can configure this block so that it changes for cell phones and different resolution monitors, It can even be configured for 4k TV.</p>\n\n<p>This block checks your monitor resolution and displays the visitor log in rows and columns, A row is a series of data put out horizontally in a table or spreadsheet while a column is a vertical series of cells in a chart, table, or spreadsheet. Rows go from left to right. On the other hand, Columns are arranged from up to down. After this block gets your monitor resolution width it will decide how many columns and rows to display. If your resolution width is less than 1920 it will display 3 columns, if it is 1920 or above it will display 4 columns. You can configure this block for any resolution and the code is obvious. Just add tables with rows and columns and display them according to the resolution width that PHP-Nuke Evolution Xtreme gets from your browser.</p>\n\n<p>This was written with the Last Seen block in mind. Someone once asked me why I changed the function for last seen. I never changed it I added a Titanium mod that changes the way the last seen data was displayed. I guess now you have a more declarative answer about why I did that.</p>\n\n<p>This block my friends gives you a perfect example of why PHP-Nuke was designed with a tabular theme interface. It had future ideas for things that had not yet been done. There is what is called a Flat page design and that is when we would use only HTML5 or CSS to layout a web page.</p>\n\n<p>PHP-Nuke Evolution Xtreme is not a Flat design and never will be. PHP-Nuke Evolution Xtreme was designed around the idea that people in a community who were just starting out learning PHP or HTML could or would be able to create blocks, modules, or themes with relative ease.</p>\n\n<p>This can be done in CSS and HTML5 and PHP-Nuke Evolution totally allows and supports themes of this design nature, however for Fluid resizeable responsive themes that might be displayed on TVs or extremely wide monitors it is not recommended. Why? PHP-Nuke Evolution Xtreme was built on the backbone of Theme technology that was written more than 30 years ago. PHP-Nuke Evolution Xtreme (US Version) supports XHTML, HTML, HTML5, and XML, so with this being the case anyone can design a theme and nobody has limitations when it comes to designing a block, module, or theme layout for their website.</p>\n\n<p>PHP-Nuke Evolution Xtreme was created for folks that like bling and beautiful graphics. If you want a Flat design layout with 3 colors and no graphics then use something plain, you know like wearing a white T-Shirt everywhere every day.</p>', '', 0, 91, 6, 'WebMaster', '', 0, 'english', 0, 0, 0, 40, 8, '', 0, 1),
(11, 2, 'WebMaster', 'New Link Us Module Update', '2021-03-01 02:16:01', '2021-05-10 13:21:29', '<p><strong>Module Name:</strong> Link Us<br />\n<strong>Author:</strong> DarkForgeGFX<br />\n<strong>Version:</strong> v1.0.0<br />\n<strong>Core: </strong>PHP-Nuke Evolution Xtreme v2.0.9d &lt;&gt; 3.0.1b<br />\n<strong>Description:</strong>&nbsp;To show and administrate several methods of backlinks to your website/portal.</p>\n\n<p>I updated the display on the Link_Us index page. It needed to be displayed properly, which may just be a matter of opinion however I&#39;m ocd and I could not take it any longer. I went ahead and took the time to lay out the table and add a fieldset to the default image section. I have not added any other size link back images so I have no idea what those&nbsp;will end up looking like. In that event, I am sure I will log in and re-write those areas as well. For now, this website has only the standard default link back image sizes in use so I will wait till I have to cross that bridge to fix it.</p>\n\n<p>I modified the index.php file located in the &quot;modules/Link_Us/public&quot; directory.&nbsp;</p>', '', 0, 83, 5, 'WebMaster', '', 0, '', 0, 0, 0, 15, 3, '', 0, 1),
(12, 3, 'webmaster', 'Facebook Plugin and Login Problems', '2021-04-30 12:00:40', '2021-05-09 14:03:24', '<p>The comment and likes section of our CMS and website are down. More than <strong>718</strong> reports to Downdetector since 3:00 am.</p>\n\n<p>I was working on some code and thought all of a sudden I must have done something somehow to cause these plugins and the Facebook app login to stop working. I&#39;m glad I looked carefully and inspected my other domains.&nbsp;</p>\n\n<p>Turns out Facebook did something somehow to cause everything to stop working, and as usual they leave you in confusion wondering what is going on. I don&#39;t think I have ever even gotten a response from a Facebook employee ever. I have to assume they just don&#39;t care and it&#39;s obvious by the way they never respond, reply or get back to anyone who submits any kind of report at all.</p>\n\n<p>The number one reason people connect with Facebook is the social plugins for likes and comments. This is something that could be duplicated through a rather simple but sophisticated API. I have no idea why nobody has done it yet.</p>\n\n<p>As far as using Facebook to log in to a website, well most people use Google or Github to log in to the places they visit nowadays.&nbsp;</p>\n\n<p>Turns out if you want to set up a Facebook SDK or set up a Facebook login for your website you have to have an IQ of 160 or at least a 4-year college reading comprehension level to understand the things you read about. There is no reason that they can&#39;t provide better help and easier-to-understand instructions for newbies and 1st-time developers.</p>\n\n<p>They did not patent the like button or ability to store comments, and all this can be done on your own website via MySQL or MariaDB if you will. Facebook is going to dwindle to nothing if they don&#39;t start offering some incentive for us to have any level of interest at all.</p>\n\n<p>You could add the Google, Twitter, and Github login API and write your own drop-in plugin with Java for comments and likes.</p>\n\n<p>We use Facebook login, likes, and&nbsp;plugins because it is connected to the largest social network in the world, however, the key thing here is we made Facebook what it is today and we are responsible for the lackadaisical user support we are getting, this is our fault because we have allowed it.</p>\n\n<p>I&#39;m left sitting here wondering when the hell my website will go back to normal all the while pondering how many people I know that hate clicking the confirm button when liking something on a Facebook website app. It&#39;s ridiculous and intentional. They do that why? who fuck&nbsp;knows but it&#39;s probably on the top of my ten most annoying things list.</p>\n\n<p>Seems like too many generation X kids have been running the show over at Facebook and 10 bucs says they go belly up sooner or later as a result.</p>\n\n<p>Nobody wants to click a like button 2 times. What do you want to bet that if you spoke to the person that came up with that idea that you wouldn&#39;t walk away wondering who the fuck ties his shoes every morning? I would have to say this is or would probably be one of the dumbest shit heads&nbsp;that you would ever have to meet in your life.</p>\n\n<p>I would like to apologize for my language and I&#39;m sorry but I&#39;m not.</p>', '', 0, 58, 1, 'webmaster', '', 1, 'english', 0, 0, 0, 15, 3, '', 0, 1),
(13, 5, 'WebMaster', 'New Facebook Chat Block', '2021-05-01 08:21:28', '2021-05-10 11:01:16', '<p><strong>Block Name: </strong>Facebook Chat Plugin<br />\n<strong>Author:&nbsp;</strong>Ernest Allen Buffington<br />\n<strong>Filename:</strong>&nbsp;block-Facebook_Chat_Plugin.php<br />\n<strong>Block Type:</strong>&nbsp;Invisible<br />\n<strong>Version:</strong>&nbsp;v1.0<br />\n<strong>Core:</strong> PHP-Nuke Evolution 3.0.1a &lt;&gt; 3.0.1b</p>\n\n<p>One of the interesting features of the US version of PHP-Nuke Evolution Xtreme is the ability to have invisible blocks. We used this feature when we made the Facebook Chat Plugin&nbsp;block as it does not need any tables or extended decorations.</p>\n\n<p>The Chat Plugin allows you to integrate your Messenger experience directly into your portal/website. This allows your customers or website members to interact with you anytime with the same personalized, rich-media experience that they get in their regular Facebook&nbsp;Messenger.</p>\n\n<p>The Chat Plugin automatically loads recent chat history between the person and your website or portal, meaning recent interactions with your website or page on messenger.com, in the Messenger app, or in the Chat Plugin on your website will be visible. This helps create a single experience for your site members or&nbsp;customers and enables you to continue the conversation even after they have left your web portal. No need to capture their information to follow up, just use the same conversation in Messenger.</p>\n\n<p>The Chat Plugin supports modern popular desktop and mobile browsers except Messenger in-app browsers and Internet Explorer.</p>', '', 0, 90, 6, 'WebMaster', '', 0, 'english', 0, 0, 0, 30, 6, '', 0, 1),
(14, 4, 'WebMaster', 'New Mod  jQuery Private Message Alert', '2016-05-04 14:34:00', '2021-05-06 21:18:25', '<p><strong>Mod Name:</strong>&nbsp;jQuery Private Message Alert<br />\n<strong>Author:&nbsp;</strong>Lonestar (crazycoder@live.co.uk)<br />\n<strong>Contributor: </strong>CoRpSE<br />\n<strong>Update:</strong>&nbsp;May 4th, 2016 10:34 am<br />\n<strong>Filename(s):</strong>&nbsp;&#39;includes/js/scripts/jquery.private.messages.alert.min.js&#39;&nbsp; &#39;admin/modules/settings/functions.php&#39;&nbsp;<br />\n<strong>Mod Type:</strong>&nbsp;Addon<br />\n<strong>Version:</strong>&nbsp;v1.0<br />\n<strong>Core:</strong>&nbsp;PHP-Nuke Evolution Xtreme 2.0.9d &lt;&gt; 3.0.1b</p>\n\n<p><br />\nThis is a&nbsp;jQuery Private Message Alert addon.<br />\n<br />\nThis simply runs in the background of your site and alerts you of any new Private Messages with an audio alert and popup window.<br />\n<br />\n<strong>Features:</strong></p>\n\n<ul>\n	<li>You can toggle the script on and off.</li>\n	<li>Can specify the cookie name it uses.</li>\n	<li>You can set cookie to stop if appearing on every page refresh (Default is 5 minutes between alerts)</li>\n	<li>You can set a delay the user must be on the site before being alerted.</li>\n	<li>You can change the color of the background overlay.</li>\n	<li>You can change the color of the redirect button, currently there are 4 colors (Blue, Green, Purple &amp; Red : Default is Blue)</li>\n	<li>You can activate or deactivate the alert sound.<br />\n	&nbsp;</li>\n</ul>\n\n<p><strong>How To Configure:</strong></p>\n\n<ul>\n	<li>Navigate to the link below to configure the plugin.<br />\n	&nbsp;</li>\n</ul>\n\n<p><strong>GotTo:</strong></p>\n\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; https://yoursite.com/admin.php?op=Configure&amp;sub=9</p>', '', 0, 34, 7, 'WebMaster', '', 1, 'english', 0, 0, 0, 10, 2, '', 0, 1),
(15, 1, 'WebMaster', 'New Network Projects Module', '2021-01-01 11:00:00', '2021-05-10 06:23:53', '<p><strong>Module Name:</strong>&nbsp;Network Projects<br />\n<strong>Author:</strong>&nbsp;Bob Marion (NukeScripts.Net)<br />\n<strong>Contributor:&nbsp;</strong>Ernest Allen Buffington<br />\n<strong>Version:</strong>&nbsp;v11.11.11<br />\n<strong>Core:&nbsp;</strong>PHP-Nuke Evolution Xtreme v2.0.9d &lt;&gt; 3.0.1b<br />\n<strong>Description:</strong>&nbsp;A module that allows network members to submit a bug&nbsp;report or request a new project or website modification.</p>\n\n<p>Manage multiple complex projects with ease.</p>\n\n<p>Simple to use,&nbsp;powerful&nbsp;when you need it.</p>\n\n<p>All the project management essentials you need.</p>\n\n<p>Create tasks and projects, reports bugs, submit mod requests.</p>\n\n<p>With the new Network Projects Module, everything is in one central location.</p>\n\n<p>Flexible, so you can customize for your workflow.</p>\n\n<p>Advanced features for complex projects.</p>\n\n<p>This is a network module that connects to the our main database server. You will need to acquire a network database password in order to enable this module on your web portal. When or if you have any sort of problem at all, whether it be with a block, module, theme or maybe something core related, this is the place to go for help or to report issues of any nature.</p>\n\n<p>This was originally a project module that was designed for the PHP-Nuke Evolution community, and it seemed to us nobody ever really appreciated it. Bob Marion spent many hours creating this module and the community originally showed little or almost no interest in it at all. Well, we thank you Bob Marion and we praise your efforts to try and better the PHP-Nuke Evolution community. This was a tool that if used the right way would have helped the PHP-Nuke Evolution community grow, and would have helped the development of PHP-Nuke Evolution immensely. Turns out maybe any and all of the development of PHP-Nuke Evolution and or Xtreme was never promoted correctly, and for that we apologize and will try to do better from here on out.</p>\n\n<p>Bob Marion we appreciate you and all your hard work and efforts, Thank you sir and God Bless...&nbsp;&nbsp;</p>\n\n<p>&nbsp;</p>', '', 0, 131, 5, 'WebMaster', '', 0, '', 0, 0, 0, 30, 6, '', 0, 1),
(16, 4, 'WebMaster', 'New Mod jQuery Floating Admin Menu', '2016-10-24 13:44:00', '2021-05-02 22:58:16', '<p><strong>Mod Name:</strong>&nbsp;jQuery Floating Admin Menu<br />\n<strong>Author:&nbsp;</strong>Lonestar (crazycoder@live.co.uk) (lonestar-modules.com)<br />\n<strong>Contributor:</strong> CoRpSE (www.headshotdomain.net)<br />\n<strong>Update:</strong>&nbsp;Aug 24th, 2016 09:44 am<br />\n<strong>Filename(s):</strong>&nbsp;&#39;includes/js/scripts/jquery.reimg.image.resizer.js&#39;&nbsp; &#39;includes/css/jquery.floating.admin.css&#39;&nbsp;<br />\n<strong>Mod Type:</strong>&nbsp;Addon<br />\n<strong>Version:</strong>&nbsp;v2.0.0<br />\n<strong>Core:</strong>&nbsp;PHP-Nuke Evolution Xtreme 2.0.9d &lt;&gt; 3.0.1b<br />\n&nbsp;</p>\n\n<p>This is the floating admin menu that resides on the left hand side of the page and will only appear after the admin logs in.</p>\n\n<p>Lonestar spent a lot of time making this look great. We would like to thank him for his time and efforts that most certainly have helped&nbsp;make Evolution Xtreme the best CMS software ever. We look forward to the many new great things Lonestar will most certainly be contributing to the community in the future. Thanks Lonestar!</p>', '', 0, 28, 7, 'WebMaster', '', 1, 'english', 0, 0, 0, 5, 1, '', 0, 1),
(17, 1, 'WebMaster', 'New File Repository Module', '2016-05-01 04:12:47', '2021-05-05 08:29:33', '<p><strong>Module Name:</strong>&nbsp;File Repository<br />\n<strong>Author:</strong>&nbsp;Lonestar (crazycoder@live.co.uk)<br />\n<strong>Contributor:</strong> CoRpSE (www.headshotdomain.net)<br />\n<strong>Version:</strong>&nbsp;v1.1.0<br />\n<strong>Core:&nbsp;</strong>PHP-Nuke Evolution Xtreme v2.0.9d &lt;&gt; 3.0.1b<br />\n<strong>Description:</strong>&nbsp;This takes the place of a very old downloads module. Meet the better new and improved downloads area.</p>\n\n<p>Lonestar would like to send a special thanks to&nbsp;coRpSE&nbsp;for his input and suggested additions/changes to this module and also for the production of the File Repository configuration video which can be found at the HeadShot Domain (www.headshotdomain.net).</p>\n\n<p><strong>Features:</strong></p>\n\n<ul>\n	<li>There are multiple ways to view the downloads, either in a Single Row or Side by Side.</li>\n	<li>Multiple files per download.</li>\n	<li>Multiple Screenshots per download.</li>\n	<li>Colored Category titles.</li>\n	<li>Colored Download titles.</li>\n	<li>Ability to link to a Live Preview of whatever file they are about to download.</li>\n	<li>SCEditor has been added to all text-area&#39;s for easy BBCode formatting.</li>\n	<li>Ability to lock downloads to a certain Group.</li>\n	<li>You can specify the minimum number of posts the user requires before being able to download.</li>\n	<li>Developer Mode: Enables developers to add a new text-area for adding fixes to downloads.</li>\n	<li>Ability to allow those logged in as an admin to bypass the Captcha.</li>\n	<li>A rating system, Allow you&#39;re users to Rate &amp; Comment on a download.</li>\n	<li>You can now specify if you wish to inform the user&#39;s the download has been updated.</li>\n	<li>Download Statistics.</li>\n	<li>Client-side uploading.</li>\n	<br />\n	&nbsp;\n</ul>\n\n<p>&nbsp;</p>', '', 0, 29, 5, 'WebMaster', '', 1, 'english', 0, 0, 0, 10, 2, '', 0, 1),
(18, 1, 'WebMaster', 'New Image Repository Module', '2016-04-17 04:46:25', '2021-05-10 12:59:26', '<p><strong>Module Name:</strong>&nbsp;&nbsp;Image Repository<br />\n<strong>Author:</strong>&nbsp;Lonestar (crazycoder@live.co.uk)<br />\n<strong>Contributor:</strong>&nbsp;CoRpSE (www.headshotdomain.net)<br />\n<strong>Version:</strong>&nbsp;v1.1.0<br />\n<strong>Core:&nbsp;</strong>PHP-Nuke Evolution Xtreme v2.0.9d &lt;&gt; 3.0.1b<br />\n<strong>Description:</strong>&nbsp;Image Repository is as it sounds, An Image Hosting module, It is far superior to the old version Lonestar had created / coded in the past.</p>\n\n<p><strong>Version 1.1.0 Changes:</strong><br />\n<strong>1.</strong> Removed the toggle upload image button, Upload table shows all the time now.<br />\n<strong>2.</strong> Reduced the size of the thumbnails to help with page load times.<br />\n<strong>3.</strong> Added new way of uploading images on the fly in the forums, No more BBCode button, Image Repository has its own table row now.<br />\n<strong>4.</strong> Admin panel has been moved in the main index, Just like in the Gaming Rigs (If you own it, you will know what i mean).<br />\n<strong>5.&nbsp;</strong>Cleaned up a lot of the coding, and carefully marked out what each area does.<br />\n<strong>6.&nbsp;</strong>This version is not encrypted,&nbsp;<br />\n<strong>7.</strong> FAQ, Will be added in the next minor update, Lonestar is working on making this an XML feed, So he can update from his site.<br />\n<br />\n<strong>Future Updates:</strong> Lonestar has many more updates planned for this module. You will just have to wait and see<br />\n<br />\n<strong>Version 1.0.1 Changes:</strong><br />\n<strong>1.</strong> Add Image Repository BBCode button for upload of images from forums<br />\n<strong>2.</strong> No SQL changes were made.</p>', '', 0, 58, 5, 'WebMaster', '', 1, 'english', 0, 0, 0, 15, 3, '', 0, 1),
(19, 2, 'WebMaster', 'New Web Links Module Update', '2021-05-06 14:16:31', '2021-05-10 12:59:08', '<p><strong>Module Name:</strong>&nbsp;Web Links<br />\n<strong>Author:</strong>&nbsp;James Knickelbein - Journey Milwaukee (http://www.journeymilwaukee.com)<br />\n<strong>Contributor:</strong> Ernest Allen Buffington<br />\n<strong>Version:</strong>&nbsp;v1.0.2<br />\n<strong>Core:&nbsp;</strong>PHP-Nuke Evolution Xtreme v2.0.9d &lt;&gt; 3.0.1b<br />\n<strong>Description:</strong>&nbsp;Web Links/Resources&nbsp;based on Journey Links Hack&nbsp;</p>\n\n<p>I went in and completely sorted through every line of code and got rid of &lt;center&gt; tags, added h1&#39;s, Rewrote a lot of the code, and fixed a few errors that went unseen for years. When writing an Editorial review it would only reflect the admin number and not the admins name, that is fixed now.</p>\n\n<p>Someone in a rush did not set up the reCaptcha correctly for the add link section.</p>\n\n<p>Added Bootstrap icons in various places to change the cosmetics a little.</p>\n\n<p>Junked all the un-needed braces that were clutter.</p>\n\n<p>Removed the old expired search engines that have not existed in years and while I was at it I added Google Groups, Disney and updated the JustLinux Forums search.</p>', '', 0, 53, 5, 'WebMaster', '', 0, 'english', 0, 0, 0, 45, 9, '', 0, 1),
(20, 2, 'WebMaster', 'New NukeSentinel Module Update', '2021-05-10 08:19:26', '2021-05-10 12:58:49', '<p><strong>Module Name:</strong>&nbsp;NukeSentinel<br />\n<strong>Author:</strong>&nbsp;NukeScripts&trade; (http://nukescripts.86it.us)<br />\n<strong>Copyright: </strong>2000-2021<br />\n<strong>Contributors:</strong>&nbsp;ScottyBcoder, Truman Scott Buffington, Ernest Allen Buffington, TheGhost, Bob Marion, ChatServ<br />\n<strong>Version:</strong>&nbsp;v2.6.04<br />\n<strong>Core:&nbsp;</strong>PHP-Nuke Evolution Xtreme v2.0.9d &lt;&gt; 3.0.1b<br />\n<strong>Description:</strong>&nbsp;Portal security for PHP-Nuke, PHP-Nuke Titanium, PHP-Nuke Evolution and Evolution Xtreme</p>\n\n<p>&nbsp;</p>\n\n<p>Hello Everyone,</p>\n\n<p>I want to start off by saying that a lot of folks have had their hands in the coding&nbsp;and design layout of this very important portal security module. When you pass the mantle so to speak you expect the person that takes over to use an overly gracious amount of emphasis on the authors, developers, and contributors that made it all possible.&nbsp;</p>\n\n<p>Let me start out by explaining why I&#39;m using my real name as a contributor. I have been around and taken part in the development of just about every piece of code that is a part of PHP-Nuke. Short of off branding my own changes over the years, the truth is the dynamic FRANCIS framework of PHP-Nuke is what made all of it possible. I have been a part of all the developer communities over the last 30 years under different various nicknames or callsigns if you will, and with that being said,&nbsp;I guess you would have a hard time giving me credit unless I started using my real name. PHP-Nuke is open-source and for the most part, belongs to the developer communities that kept it alive, and the folks who are still keeping it alive after 30 years. The reason I am using my real name now is I have noticed a few people stirring the shit pot about people stealing code and saying it isn&#39;t&nbsp;theirs when in fact it truly is. The fact&nbsp;in the matter is that after it is modified it is no longer the original and anything modified must contain the new author&#39;s information. With that being said let&#39;s get class rolling...</p>\n\n<p>If you&#39;re going to have something to say about who is claiming something is theirs make sure you do your homework before you start running your mouth and offending people old enough to be your grandfather while at the same time making yourself look like a complete idiot. Let&#39;s start off with re-branded public and commercial software rights. The GNU general public license allows everyone to distribute and or sell their own version of PHP-Nuke or any software released under the GNU and with any name that they so choose to use. You can legally sell software with a GPL license version 2 or 3 for whatever price you want to charge and interestingly enough we could sell the original software un-modified if we so choose to do so. This can all be pretty confusing to folks that do not have at least a&nbsp;4th year of college reading and comprehension. Let me explain something,&nbsp;free software is referred to as free in terms of freedom and not in terms of the software price. What most people do is charge a distribution fee for different various renditions of software that other people have written the core engines for. Technically speaking anything you modify and change is yours and ipso facto makes you the current author, in fact, the original authors would usually prefer not to have their name attached to any version but the original and that is why as part of the law and why you are required to give a full copy of the original code un-modified with any version that you so choose to sell or distribute. There are exceptions with worldwide distributions such as PHP-Nuke because the original source code is already out there and very well known and there is no real need to emphasize on who is responsible for the ideas or concepts that went into the development of that particular software. However in court, if you did not supply a full copy that is un-modified alongside the original with the original author information, because the law is the law, you would lose any said battles that pertain to any such revenues earned.</p>\n\n<p>Interestingly enough GNU copyrights are only legal if you provide your legal given name or the name of a legally registered business entity. With that being said you can&#39;t say copyright StarMonkey or Fragglenap. It must be your legally given birth name or a registered business entity. You cannot make up an entity name and use it without owning and registering it. A registered domain does not constitute any legal rights to the name you use. You must still register it as a legal trademark or license it as a business entity and this applies to everyone no matter where they are in the world. You may own the domain name and not have the name rights, so if you use a name and do not license it or register it as a trademark anyone can steal it in about 10 minutes and you will be shit out of luck. My suggestion is that if you use a name you better make sure you own it! What can happen is, you make someone angry and said person is quite wealthy, said person decides they don&#39;t like you so they register your domain as a trademark and then they license in your state or community under the said name&nbsp;and then they drag you into court and sue your pants off and leave you broke, naked and destitute with no home and not even a cardboard box to live in. So do yourself a favor and try not to piss people off on the internet and make sure you own any name you use. In other words you better secure your interests before you piss anyone off anywhere. You never know just how vindictive or rich they might be.</p>\n\n<p>I hope this article was helpful and I felt like packaging it with this particular module would be very fitting.</p>\n\n<p>Film at 11</p>\n\n<p>&nbsp;</p>', '', 0, 33, 5, 'WebMaster', '', 0, '', 0, 0, 0, 15, 3, '', 0, 1),
(21, 1, 'WebMaster', 'New Network Module', '2021-05-10 09:49:53', '2021-05-10 12:57:59', '<p><strong>Module Name:</strong>&nbsp;Network<br />\n<strong>Author:</strong>&nbsp;Ernest Buffington<br />\n<strong>Contributor:</strong>&nbsp;Shawn Archer, Ernest Allen Buffington<br />\n<strong>Version:</strong>&nbsp;v1.0.0<br />\n<strong>License:&nbsp;</strong>GNU General Public License version 2<br />\n<strong>Core:&nbsp;</strong>PHP-Nuke 6.0.0 &lt;&gt; 6.5.0 | PHP-Nuke Evolution Xtreme 2.0.9f&nbsp;&lt;&gt;&nbsp;3.0.1b<br />\n<strong>Description:</strong>&nbsp;Based on Website Document Mod v1.0 by&nbsp;Shawn Archer&nbsp;Copyright (c) 2002</p>\n\n<p>&nbsp;</p>\n\n<p>This module contains The 86it Developers Network&#39;s legal disclaimers and documents.</p>\n\n<ul>\n	<li>About Our Network</li>\n	<li>Network Disclaimer Statement</li>\n	<li>Network Privacy Statement</li>\n	<li>Network Terms of Use</li>\n</ul>\n\n<p>&nbsp;</p>\n\n<p>This module has information that must be loaded at the bottom of each portal or website given away by <strong>The 86it Developers Network</strong>.</p>\n\n<p>Some people disable the footer links and load the network module as a menu option on their portal. This is an acceptable way to present the network legal documents as well.</p>\n\n<p>This information must be present at all times and is a part of the network paid subscription agreement. When <strong>The 86it Developer Network</strong> gives you a web portal it may be free for you but Brandon Maintenance Management. LLC pays for your portal and website. This is done to promote programmers and programming all around the world.</p>\n\n<p>These free portals are for beginners and people learning to program on the internet.&nbsp;they are also for folks that want to setup gaming websites or run an online business, These portals have no limitations and come with a cPanel and PHP-FPM with all versions of PHP available.</p>\n\n<p>&nbsp;</p>', '', 0, 19, 5, 'WebMaster', '', 0, '', 0, 0, 0, 10, 2, '', 0, 1);

CREATE TABLE `nuke_stories_cat` (
  `catid` int(11) NOT NULL,
  `title` varchar(20) NOT NULL DEFAULT '',
  `counter` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_stories_cat` (`catid`, `title`, `counter`) VALUES
(1, 'Module Information', 21),
(2, 'Module Update', 5),
(3, 'Xtreme News', 12),
(4, 'Xtreme Mods', 5),
(5, 'Block Information', 6);

CREATE TABLE `nuke_subscriptions` (
  `id` int(10) NOT NULL,
  `userid` int(10) NOT NULL DEFAULT 0,
  `subscription_expire` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_themes` (
  `theme_name` varchar(100) NOT NULL DEFAULT '',
  `groups` varchar(50) NOT NULL DEFAULT '',
  `permissions` tinyint(2) NOT NULL DEFAULT 1,
  `custom_name` varchar(100) NOT NULL DEFAULT '',
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `theme_info` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_themes` (`theme_name`, `groups`, `permissions`, `custom_name`, `active`, `theme_info`) VALUES
('Titanium_Core', '', 1, 'Titanium Core v1.3', 1, '1760:::#8d7b4d:::#645838:::#373121:::#151515:::#ccc:::#ccc:::Go to Theme Options to Edit Footer Message Line 1:::Go to Theme Options to Edit Footer Message Line 2:::#D29A2B:::dark'),
('XtremeV4', '', 3, 'XtremeV4', 1, '93%:::#454545:::#383838:::#383838:::#383838:::#ccc:::#ccc:::Go to Theme Options to Edit Footer Message Line 1:::Go to Theme Options to Edit Footer Message Line 2:::#D29A2B:::dark');


CREATE TABLE `nuke_topics` (
  `topicid` int(3) NOT NULL,
  `topicname` varchar(20) DEFAULT NULL,
  `topicimage` varchar(100) DEFAULT NULL,
  `topictext` varchar(40) DEFAULT NULL,
  `counter` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_topics` (`topicid`, `topicname`, `topicimage`, `topictext`, `counter`) VALUES
(1, 'evolution', 'black_template.png', 'PHP-Nuke Titanium News', 5),
(5, 'modules', 'black_template.png', 'PHP-Nuke Titanium Modules', 5),
(6, 'blocks', 'black_template.png', 'PHP-Nuke Titanium Blocks', 7),
(7, 'mods', 'black_template.png', 'PHP-Nuke Titanium Mods', 2),
(8, 'themes', 'black_template.png', 'PHP-Nuke Titanium Themes', 0),
(9, 'todo', 'black_template.png', 'PHP-Nuke Titanium ToDo List', 0),
(10, 'adminpanels', 'black_template.png', 'PHP-Nuke Titanium Admin Panels', 0);

CREATE TABLE `nuke_users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL DEFAULT '',
  `username` varchar(25) NOT NULL DEFAULT '',
  `user_email` varchar(255) NOT NULL DEFAULT '',
  `femail` varchar(255) NOT NULL DEFAULT '',
  `user_website` varchar(255) NOT NULL DEFAULT '',
  `user_avatar` varchar(255) NOT NULL DEFAULT '',
  `user_regdate` varchar(20) NOT NULL DEFAULT '',
  `user_occ` varchar(100) DEFAULT NULL,
  `user_from` varchar(100) DEFAULT NULL,
  `user_from_flag` varchar(64) DEFAULT NULL,
  `user_interests` varchar(150) NOT NULL DEFAULT '',
  `user_sig` text DEFAULT NULL,
  `user_viewemail` tinyint(2) DEFAULT NULL,
  `user_theme` int(3) DEFAULT NULL,
  `user_facebook` varchar(255) DEFAULT NULL,
  `user_password` varchar(40) NOT NULL DEFAULT '',
  `storynum` tinyint(4) NOT NULL DEFAULT 10,
  `umode` varchar(10) NOT NULL DEFAULT '',
  `uorder` tinyint(1) NOT NULL DEFAULT 0,
  `thold` tinyint(1) NOT NULL DEFAULT 0,
  `noscore` tinyint(1) NOT NULL DEFAULT 0,
  `bio` longtext DEFAULT NULL,
  `ublockon` tinyint(1) NOT NULL DEFAULT 0,
  `ublock` tinytext DEFAULT NULL,
  `theme` varchar(255) NOT NULL DEFAULT '',
  `commentmax` int(11) NOT NULL DEFAULT 4096,
  `counter` int(11) NOT NULL DEFAULT 0,
  `newsletter` int(1) NOT NULL DEFAULT 0,
  `user_posts` int(10) NOT NULL DEFAULT 0,
  `user_attachsig` int(2) NOT NULL DEFAULT 1,
  `user_rank` int(10) NOT NULL DEFAULT 0,
  `user_level` int(10) NOT NULL DEFAULT 1,
  `broadcast` tinyint(1) NOT NULL DEFAULT 1,
  `popmeson` tinyint(1) NOT NULL DEFAULT 0,
  `user_active` tinyint(1) DEFAULT 1,
  `user_session_time` int(11) NOT NULL DEFAULT 0,
  `user_session_page` smallint(5) NOT NULL DEFAULT 0,
  `user_lastvisit` int(11) NOT NULL DEFAULT 0,
  `user_timezone` decimal(5,2) NOT NULL DEFAULT 0.00,
  `user_style` tinyint(4) DEFAULT NULL,
  `user_lang` varchar(255) NOT NULL DEFAULT 'english',
  `user_dateformat` varchar(14) NOT NULL DEFAULT 'D M d, Y g:i a',
  `user_new_privmsg` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `user_unread_privmsg` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `user_last_privmsg` int(11) NOT NULL DEFAULT 0,
  `user_emailtime` int(11) DEFAULT NULL,
  `user_allowhtml` tinyint(1) DEFAULT 1,
  `user_allowbbcode` tinyint(1) DEFAULT 1,
  `user_allowsmile` tinyint(1) DEFAULT 1,
  `user_allowavatar` tinyint(1) NOT NULL DEFAULT 1,
  `user_allow_pm` tinyint(1) NOT NULL DEFAULT 1,
  `user_allow_mass_pm` tinyint(1) DEFAULT 4,
  `user_allow_viewonline` tinyint(1) NOT NULL DEFAULT 1,
  `user_notify` tinyint(1) NOT NULL DEFAULT 0,
  `user_notify_pm` tinyint(1) NOT NULL DEFAULT 1,
  `user_popup_pm` tinyint(1) NOT NULL DEFAULT 1,
  `user_avatar_type` tinyint(4) NOT NULL DEFAULT 3,
  `user_sig_bbcode_uid` varchar(10) DEFAULT NULL,
  `user_actkey` varchar(32) DEFAULT NULL,
  `user_newpasswd` varchar(32) DEFAULT NULL,
  `points` int(10) DEFAULT 0,
  `last_ip` varchar(15) NOT NULL DEFAULT '0',
  `user_wordwrap` smallint(3) NOT NULL DEFAULT 70,
  `agreedtos` tinyint(1) NOT NULL DEFAULT 0,
  `user_allowsignature` tinyint(4) NOT NULL DEFAULT 1,
  `user_report_optout` tinyint(1) NOT NULL DEFAULT 0,
  `user_show_quickreply` tinyint(1) NOT NULL DEFAULT 1,
  `user_quickreply_mode` tinyint(1) NOT NULL DEFAULT 1,
  `user_color_gc` varchar(6) DEFAULT '',
  `user_color_gi` text DEFAULT NULL,
  `user_showavatars` tinyint(1) DEFAULT 1,
  `user_showsignatures` tinyint(1) DEFAULT 1,
  `user_time_mode` tinyint(4) NOT NULL DEFAULT 6,
  `user_dst_time_lag` tinyint(4) NOT NULL DEFAULT 60,
  `user_pc_timeOffsets` varchar(55) NOT NULL DEFAULT '0',
  `user_view_log` tinyint(4) NOT NULL DEFAULT 0,
  `user_glance_show` varchar(255) NOT NULL DEFAULT '1',
  `user_hide_images` tinyint(2) NOT NULL DEFAULT 0,
  `user_open_quickreply` tinyint(1) NOT NULL DEFAULT 1,
  `sceditor_in_source` tinyint(1) NOT NULL DEFAULT 0,
  `xdata_bbcode` varchar(10) DEFAULT NULL,
  `user_ftr` smallint(1) NOT NULL DEFAULT 0,
  `user_ftr_time` int(10) NOT NULL DEFAULT 0,
  `user_rank2` int(11) DEFAULT -1,
  `user_rank3` int(11) DEFAULT -2,
  `user_rank4` int(11) DEFAULT -2,
  `user_rank5` int(11) DEFAULT -2,
  `user_gender` tinyint(4) NOT NULL DEFAULT 0,
  `user_birthday` int(8) NOT NULL DEFAULT 0,
  `user_birthday2` int(8) DEFAULT NULL,
  `birthday_display` tinyint(1) NOT NULL DEFAULT 0,
  `birthday_greeting` tinyint(1) NOT NULL DEFAULT 0,
  `user_next_birthday` smallint(4) NOT NULL DEFAULT 0,
  `user_reputation` float NOT NULL DEFAULT 0,
  `user_rep_last_time` int(11) DEFAULT NULL,
  `user_admin_notes` text DEFAULT NULL,
  `user_allow_arcadepm` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_users` (`user_id`, `name`, `username`, `user_email`, `femail`, `user_website`, `user_avatar`, `user_regdate`, `user_occ`, `user_from`, `user_from_flag`, `user_interests`, `user_sig`, `user_viewemail`, `user_theme`, `user_facebook`, `user_password`, `storynum`, `umode`, `uorder`, `thold`, `noscore`, `bio`, `ublockon`, `ublock`, `theme`, `commentmax`, `counter`, `newsletter`, `user_posts`, `user_attachsig`, `user_rank`, `user_level`, `broadcast`, `popmeson`, `user_active`, `user_session_time`, `user_session_page`, `user_lastvisit`, `user_timezone`, `user_style`, `user_lang`, `user_dateformat`, `user_new_privmsg`, `user_unread_privmsg`, `user_last_privmsg`, `user_emailtime`, `user_allowhtml`, `user_allowbbcode`, `user_allowsmile`, `user_allowavatar`, `user_allow_pm`, `user_allow_mass_pm`, `user_allow_viewonline`, `user_notify`, `user_notify_pm`, `user_popup_pm`, `user_avatar_type`, `user_sig_bbcode_uid`, `user_actkey`, `user_newpasswd`, `points`, `last_ip`, `user_wordwrap`, `agreedtos`, `user_allowsignature`, `user_report_optout`, `user_show_quickreply`, `user_quickreply_mode`, `user_color_gc`, `user_color_gi`, `user_showavatars`, `user_showsignatures`, `user_time_mode`, `user_dst_time_lag`, `user_pc_timeOffsets`, `user_view_log`, `user_glance_show`, `user_hide_images`, `user_open_quickreply`, `sceditor_in_source`, `xdata_bbcode`, `user_ftr`, `user_ftr_time`, `user_rank2`, `user_rank3`, `user_rank4`, `user_rank5`, `user_gender`, `user_birthday`, `user_birthday2`, `birthday_display`, `birthday_greeting`, `user_next_birthday`, `user_reputation`, `user_rep_last_time`, `user_admin_notes`, `user_allow_arcadepm`) VALUES
(1, '', 'Anonymous', '', '', '', 'blank.gif', 'Nov 03, 2018', '', '', NULL, '', '', 0, 0, NULL, '', 10, '', 0, 0, 0, '', 0, '', '', 4096, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, 0, 0, 10.00, NULL, 'english', 'D M d, Y g:i a', 0, 0, 0, NULL, 1, 1, 1, 1, 1, 0, 1, 1, 0, 0, 3, NULL, NULL, NULL, 0, '0', 70, 0, 0, 0, 0, 0, '', '', 1, 1, 6, 60, '0', 0, '1', 0, 1, 0, '', 0, 0, -1, -2, -2, -2, 0, 0, NULL, 0, 0, 0, 43.2825, 1243272322, '', 1);


CREATE TABLE `nuke_users_countries` (
  `id_country` int(11) NOT NULL,
  `name` varchar(64) NOT NULL DEFAULT '',
  `iso_code_2` char(2) NOT NULL DEFAULT '',
  `iso_code_3` char(3) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `nuke_users_countries` (`id_country`, `name`, `iso_code_2`, `iso_code_3`) VALUES
(1, 'Afghanistan', 'AF', 'AFG'),
(2, 'Albania', 'AL', 'ALB'),
(3, 'Algeria', 'DZ', 'DZA'),
(4, 'American Samoa', 'AS', 'ASM'),
(5, 'Andorra', 'AD', 'AND'),
(6, 'Angola', 'AO', 'AGO'),
(7, 'Anguilla', 'AI', 'AIA'),
(8, 'Antarctica', 'AQ', 'ATA'),
(9, 'Antigua and Barbuda', 'AG', 'ATG'),
(10, 'Argentina', 'AR', 'ARG'),
(11, 'Armenia', 'AM', 'ARM'),
(12, 'Aruba', 'AW', 'ABW'),
(13, 'Australia', 'AU', 'AUS'),
(14, 'Austria', 'AT', 'AUT'),
(15, 'Azerbaijan', 'AZ', 'AZE'),
(16, 'Bahamas', 'BS', 'BHS'),
(17, 'Bahrain', 'BH', 'BHR'),
(18, 'Bangladesh', 'BD', 'BGD'),
(19, 'Barbados', 'BB', 'BRB'),
(20, 'Belarus', 'BY', 'BLR'),
(21, 'Belgium', 'BE', 'BEL'),
(22, 'Belize', 'BZ', 'BLZ'),
(23, 'Benin', 'BJ', 'BEN'),
(24, 'Bermuda', 'BM', 'BMU'),
(25, 'Bhutan', 'BT', 'BTN'),
(26, 'Bolivia', 'BO', 'BOL'),
(27, 'Bosnia and Herzegowina', 'BA', 'BIH'),
(28, 'Botswana', 'BW', 'BWA'),
(29, 'Bouvet Island', 'BV', 'BVT'),
(30, 'Brazil', 'BR', 'BRA'),
(31, 'British Indian Ocean Territory', 'IO', 'IOT'),
(32, 'Brunei Darussalam', 'BN', 'BRN'),
(33, 'Bulgaria', 'BG', 'BGR'),
(34, 'Burkina Faso', 'BF', 'BFA'),
(35, 'Burundi', 'BI', 'BDI'),
(36, 'Cambodia', 'KH', 'KHM'),
(37, 'Cameroon', 'CM', 'CMR'),
(38, 'Canada', 'CA', 'CAN'),
(39, 'Cape Verde', 'CV', 'CPV'),
(40, 'Cayman Islands', 'KY', 'CYM'),
(41, 'Central African Republic', 'CF', 'CAF'),
(42, 'Chad', 'TD', 'TCD'),
(43, 'Chile', 'CL', 'CHL'),
(44, 'China', 'CN', 'CHN'),
(45, 'Christmas Island', 'CX', 'CXR'),
(46, 'Cocos (Keeling) Islands', 'CC', 'CCK'),
(47, 'Colombia', 'CO', 'COL'),
(48, 'Comoros', 'KM', 'COM'),
(49, 'Congo', 'CG', 'COG'),
(50, 'Cook Islands', 'CK', 'COK'),
(51, 'Costa Rica', 'CR', 'CRI'),
(52, 'Cote D\'Ivoire', 'CI', 'CIV'),
(53, 'Croatia', 'HR', 'HRV'),
(54, 'Cuba', 'CU', 'CUB'),
(55, 'Cyprus', 'CY', 'CYP'),
(56, 'Czech Republic', 'CZ', 'CZE'),
(57, 'Denmark', 'DK', 'DNK'),
(58, 'Djibouti', 'DJ', 'DJI'),
(59, 'Dominica', 'DM', 'DMA'),
(60, 'Dominican Republic', 'DO', 'DOM'),
(61, 'East Timor', 'TP', 'TMP'),
(62, 'Ecuador', 'EC', 'ECU'),
(63, 'Egypt', 'EG', 'EGY'),
(64, 'El Salvador', 'SV', 'SLV'),
(65, 'Equatorial Guinea', 'GQ', 'GNQ'),
(66, 'Eritrea', 'ER', 'ERI'),
(67, 'Estonia', 'EE', 'EST'),
(68, 'Ethiopia', 'ET', 'ETH'),
(69, 'Falkland Islands (Malvinas)', 'FK', 'FLK'),
(70, 'Faroe Islands', 'FO', 'FRO'),
(71, 'Fiji', 'FJ', 'FJI'),
(72, 'Finland', 'FI', 'FIN'),
(73, 'France', 'FR', 'FRA'),
(74, 'France, Metropolitan', 'FX', 'FXX'),
(75, 'French Guiana', 'GF', 'GUF'),
(76, 'French Polynesia', 'PF', 'PYF'),
(77, 'French Southern Territories', 'TF', 'ATF'),
(78, 'Gabon', 'GA', 'GAB'),
(79, 'Gambia', 'GM', 'GMB'),
(80, 'Georgia', 'GE', 'GEO'),
(81, 'Germany', 'DE', 'DEU'),
(82, 'Ghana', 'GH', 'GHA'),
(83, 'Gibraltar', 'GI', 'GIB'),
(84, 'Greece', 'GR', 'GRC'),
(85, 'Greenland', 'GL', 'GRL'),
(86, 'Grenada', 'GD', 'GRD'),
(87, 'Guadeloupe', 'GP', 'GLP'),
(88, 'Guam', 'GU', 'GUM'),
(89, 'Guatemala', 'GT', 'GTM'),
(90, 'Guinea', 'GN', 'GIN'),
(91, 'Guinea-bissau', 'GW', 'GNB'),
(92, 'Guyana', 'GY', 'GUY'),
(93, 'Haiti', 'HT', 'HTI'),
(94, 'Heard and Mc Donald Islands', 'HM', 'HMD'),
(95, 'Honduras', 'HN', 'HND'),
(96, 'Hong Kong', 'HK', 'HKG'),
(97, 'Hungary', 'HU', 'HUN'),
(98, 'Iceland', 'IS', 'ISL'),
(99, 'India', 'IN', 'IND'),
(100, 'Indonesia', 'ID', 'IDN'),
(101, 'Iran (Islamic Republic of)', 'IR', 'IRN'),
(102, 'Iraq', 'IQ', 'IRQ'),
(103, 'Ireland', 'IE', 'IRL'),
(104, 'Israel', 'IL', 'ISR'),
(105, 'Italy', 'IT', 'ITA'),
(106, 'Jamaica', 'JM', 'JAM'),
(107, 'Japan', 'JP', 'JPN'),
(108, 'Jordan', 'JO', 'JOR'),
(109, 'Kazakhstan', 'KZ', 'KAZ'),
(110, 'Kenya', 'KE', 'KEN'),
(111, 'Kiribati', 'KI', 'KIR'),
(112, 'Korea, Democratic People\'s Republic of', 'KP', 'PRK'),
(113, 'Korea, Republic of', 'KR', 'KOR'),
(114, 'Kuwait', 'KW', 'KWT'),
(115, 'Kyrgyzstan', 'KG', 'KGZ'),
(116, 'Lao People\'s Democratic Republic', 'LA', 'LAO'),
(117, 'Latvia', 'LV', 'LVA'),
(118, 'Lebanon', 'LB', 'LBN'),
(119, 'Lesotho', 'LS', 'LSO'),
(120, 'Liberia', 'LR', 'LBR'),
(121, 'Libyan Arab Jamahiriya', 'LY', 'LBY'),
(122, 'Liechtenstein', 'LI', 'LIE'),
(123, 'Lithuania', 'LT', 'LTU'),
(124, 'Luxembourg', 'LU', 'LUX'),
(125, 'Macau', 'MO', 'MAC'),
(126, 'Macedonia, The Former Yugoslav Republic of', 'MK', 'MKD'),
(127, 'Madagascar', 'MG', 'MDG'),
(128, 'Malawi', 'MW', 'MWI'),
(129, 'Malaysia', 'MY', 'MYS'),
(130, 'Maldives', 'MV', 'MDV'),
(131, 'Mali', 'ML', 'MLI'),
(132, 'Malta', 'MT', 'MLT'),
(133, 'Marshall Islands', 'MH', 'MHL'),
(134, 'Martinique', 'MQ', 'MTQ'),
(135, 'Mauritania', 'MR', 'MRT'),
(136, 'Mauritius', 'MU', 'MUS'),
(137, 'Mayotte', 'YT', 'MYT'),
(138, 'Mexico', 'MX', 'MEX'),
(139, 'Micronesia, Federated States of', 'FM', 'FSM'),
(140, 'Moldova, Republic of', 'MD', 'MDA'),
(141, 'Monaco', 'MC', 'MCO'),
(142, 'Mongolia', 'MN', 'MNG'),
(143, 'Montserrat', 'MS', 'MSR'),
(144, 'Morocco', 'MA', 'MAR'),
(145, 'Mozambique', 'MZ', 'MOZ'),
(146, 'Myanmar', 'MM', 'MMR'),
(147, 'Namibia', 'NA', 'NAM'),
(148, 'Nauru', 'NR', 'NRU'),
(149, 'Nepal', 'NP', 'NPL'),
(150, 'Netherlands', 'NL', 'NLD'),
(151, 'Netherlands Antilles', 'AN', 'ANT'),
(152, 'New Caledonia', 'NC', 'NCL'),
(153, 'New Zealand', 'NZ', 'NZL'),
(154, 'Nicaragua', 'NI', 'NIC'),
(155, 'Niger', 'NE', 'NER'),
(156, 'Nigeria', 'NG', 'NGA'),
(157, 'Niue', 'NU', 'NIU'),
(158, 'Norfolk Island', 'NF', 'NFK'),
(159, 'Northern Mariana Islands', 'MP', 'MNP'),
(160, 'Norway', 'NO', 'NOR'),
(161, 'Oman', 'OM', 'OMN'),
(162, 'Pakistan', 'PK', 'PAK'),
(163, 'Palau', 'PW', 'PLW'),
(164, 'Panama', 'PA', 'PAN'),
(165, 'Papua New Guinea', 'PG', 'PNG'),
(166, 'Paraguay', 'PY', 'PRY'),
(167, 'Peru', 'PE', 'PER'),
(168, 'Philippines', 'PH', 'PHL'),
(169, 'Pitcairn', 'PN', 'PCN'),
(170, 'Poland', 'PL', 'POL'),
(171, 'Portugal', 'PT', 'PRT'),
(172, 'Puerto Rico', 'PR', 'PRI'),
(173, 'Qatar', 'QA', 'QAT'),
(174, 'Reunion', 'RE', 'REU'),
(175, 'Romania', 'RO', 'ROM'),
(176, 'Russian Federation', 'RU', 'RUS'),
(177, 'Rwanda', 'RW', 'RWA'),
(178, 'Saint Kitts and Nevis', 'KN', 'KNA'),
(179, 'Saint Lucia', 'LC', 'LCA'),
(180, 'Saint Vincent and the Grenadines', 'VC', 'VCT'),
(181, 'Samoa', 'WS', 'WSM'),
(182, 'San Marino', 'SM', 'SMR'),
(183, 'Sao Tome and Principe', 'ST', 'STP'),
(184, 'Saudi Arabia', 'SA', 'SAU'),
(185, 'Senegal', 'SN', 'SEN'),
(186, 'Serbia', 'RS', 'SER'),
(187, 'Seychelles', 'SC', 'SYC'),
(188, 'Sierra Leone', 'SL', 'SLE'),
(189, 'Singapore', 'SG', 'SGP'),
(190, 'Sudan', 'SD', 'SDN'),
(191, 'Slovenia', 'SI', 'SVN'),
(192, 'Solomon Islands', 'SB', 'SLB'),
(193, 'Somalia', 'SO', 'SOM'),
(194, 'South Africa', 'ZA', 'ZAF'),
(195, 'South Georgia and the South Sandwich Islands', 'GS', 'SGS'),
(196, 'Spain', 'ES', 'ESP'),
(197, 'Sri Lanka', 'LK', 'LKA'),
(198, 'St. Helena', 'SH', 'SHN'),
(199, 'St. Pierre and Miquelon', 'PM', 'SPM'),
(201, 'Suriname', 'SR', 'SUR'),
(202, 'Svalbard and Jan Mayen Islands', 'SJ', 'SJM'),
(203, 'Swaziland', 'SZ', 'SWZ'),
(204, 'Sweden', 'SE', 'SWE'),
(205, 'Switzerland', 'CH', 'CHE'),
(206, 'Syrian Arab Republic', 'SY', 'SYR'),
(207, 'Taiwan', 'TW', 'TWN'),
(208, 'Tanzania, United Republic of', 'TZ', 'TZA'),
(209, 'Thailand', 'TH', 'THA'),
(210, 'Togo', 'TG', 'TGO'),
(211, 'Tokelau', 'TK', 'TKL'),
(212, 'Tonga', 'TO', 'TON'),
(213, 'Trinidad and Tobago', 'TT', 'TTO'),
(214, 'Tunisia', 'TN', 'TUN'),
(215, 'Turkey', 'TR', 'TUR'),
(216, 'Turkmenistan', 'TM', 'TKM'),
(217, 'Turks and Caicos Islands', 'TC', 'TCA'),
(218, 'Tuvalu', 'TV', 'TUV'),
(219, 'Uganda', 'UG', 'UGA'),
(220, 'Ukraine', 'UA', 'UKR'),
(221, 'United Arab Emirates', 'AE', 'ARE'),
(222, 'United Kingdom', 'GB', 'GBR'),
(223, 'United States', 'US', 'USA'),
(224, 'United States Minor Outlying Islands', 'UM', 'UMI'),
(225, 'Uruguay', 'UY', 'URY'),
(226, 'Uzbekistan', 'UZ', 'UZB'),
(227, 'Vanuatu', 'VU', 'VUT'),
(228, 'Vatican City State (Holy See)', 'VA', 'VAT'),
(229, 'Venezuela', 'VE', 'VEN'),
(230, 'Viet Nam', 'VN', 'VNM'),
(231, 'Virgin Islands (British)', 'VG', 'VGB'),
(232, 'Virgin Islands (U.S.)', 'VI', 'VIR'),
(233, 'Wallis and Futuna Islands', 'WF', 'WLF'),
(234, 'Western Sahara', 'EH', 'ESH'),
(235, 'Yemen', 'YE', 'YEM'),
(237, 'Zaire', 'ZR', 'ZAR'),
(238, 'Zambia', 'ZM', 'ZMB'),
(239, 'Zimbabwe', 'ZW', 'ZWE');

CREATE TABLE `nuke_users_temp` (
  `user_id` int(10) NOT NULL,
  `username` varchar(25) NOT NULL DEFAULT '',
  `user_email` varchar(255) NOT NULL DEFAULT '',
  `user_password` varchar(40) NOT NULL DEFAULT '',
  `user_regdate` varchar(20) NOT NULL DEFAULT '',
  `check_num` varchar(50) NOT NULL DEFAULT '',
  `time` varchar(14) NOT NULL DEFAULT '',
  `realname` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_users_who_been` (
  `user_ID` int(11) NOT NULL DEFAULT 0,
  `username` varchar(25) NOT NULL DEFAULT '',
  `last_visit` int(15) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `nuke_welcome_pm` (
  `subject` varchar(30) NOT NULL DEFAULT '',
  `msg` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


ALTER TABLE `network_bookmarks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

ALTER TABLE `network_bookmarks_cat`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `user_id` (`user_id`);

ALTER TABLE `nuke_admin_fc`
  ADD PRIMARY KEY (`fc_attempts`);

ALTER TABLE `nuke_authors`
  ADD PRIMARY KEY (`aid`);

ALTER TABLE `nuke_autonews`
  ADD PRIMARY KEY (`anid`),
  ADD UNIQUE KEY `anid` (`anid`);

ALTER TABLE `nuke_banner`
  ADD PRIMARY KEY (`bid`),
  ADD KEY `cid` (`cid`);

ALTER TABLE `nuke_banner_clients`
  ADD PRIMARY KEY (`cid`);

ALTER TABLE `nuke_banner_plans`
  ADD PRIMARY KEY (`pid`);

ALTER TABLE `nuke_banner_positions`
  ADD PRIMARY KEY (`apid`),
  ADD KEY `position_number` (`position_number`);

ALTER TABLE `nuke_bbadvanced_username_color`
  ADD PRIMARY KEY (`group_id`);

ALTER TABLE `nuke_bbarcade`
  ADD PRIMARY KEY (`arcade_name`);

ALTER TABLE `nuke_bbarcade_categories`
  ADD KEY `arcade_catid` (`arcade_catid`);

ALTER TABLE `nuke_bbattachments`
  ADD KEY `attach_id_post_id` (`attach_id`,`post_id`),
  ADD KEY `attach_id_privmsgs_id` (`attach_id`,`privmsgs_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `privmsgs_id` (`privmsgs_id`);

ALTER TABLE `nuke_bbattachments_config`
  ADD PRIMARY KEY (`config_name`);

ALTER TABLE `nuke_bbattachments_desc`
  ADD PRIMARY KEY (`attach_id`),
  ADD KEY `filetime` (`filetime`),
  ADD KEY `physical_filename` (`physical_filename`(10)),
  ADD KEY `filesize` (`filesize`);

ALTER TABLE `nuke_bbattach_quota`
  ADD KEY `quota_type` (`quota_type`);

ALTER TABLE `nuke_bbauth_access`
  ADD KEY `group_id` (`group_id`),
  ADD KEY `forum_id` (`forum_id`);

ALTER TABLE `nuke_bbauth_arcade_access`
  ADD KEY `group_id` (`group_id`),
  ADD KEY `arcade_catid` (`arcade_catid`);

ALTER TABLE `nuke_bbbanlist`
  ADD PRIMARY KEY (`ban_id`),
  ADD KEY `ban_ip_user_id` (`ban_ip`,`ban_userid`);

ALTER TABLE `nuke_bbcategories`
  ADD PRIMARY KEY (`cat_id`),
  ADD KEY `cat_order` (`cat_order`);

ALTER TABLE `nuke_bbconfig`
  ADD PRIMARY KEY (`config_name`);

ALTER TABLE `nuke_bbdisallow`
  ADD PRIMARY KEY (`disallow_id`);

ALTER TABLE `nuke_bbextensions`
  ADD PRIMARY KEY (`ext_id`);

ALTER TABLE `nuke_bbextension_groups`
  ADD PRIMARY KEY (`group_id`);

ALTER TABLE `nuke_bbflags`
  ADD PRIMARY KEY (`flag_id`);

ALTER TABLE `nuke_bbforbidden_extensions`
  ADD PRIMARY KEY (`ext_id`);

ALTER TABLE `nuke_bbforums`
  ADD PRIMARY KEY (`forum_id`),
  ADD KEY `forums_order` (`forum_order`),
  ADD KEY `cat_id` (`cat_id`),
  ADD KEY `forum_last_post_id` (`forum_last_post_id`);

ALTER TABLE `nuke_bbforum_prune`
  ADD PRIMARY KEY (`prune_id`),
  ADD KEY `forum_id` (`forum_id`);

ALTER TABLE `nuke_bbgames`
  ADD KEY `game_id` (`game_id`);

ALTER TABLE `nuke_bbgroups`
  ADD PRIMARY KEY (`group_id`),
  ADD KEY `group_single_user` (`group_single_user`);

ALTER TABLE `nuke_bbinline_ads`
  ADD PRIMARY KEY (`ad_id`);

ALTER TABLE `nuke_bblogs`
  ADD PRIMARY KEY (`log_id`);

ALTER TABLE `nuke_bblogs_config`
  ADD PRIMARY KEY (`config_name`);

ALTER TABLE `nuke_bbposts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `forum_id` (`forum_id`),
  ADD KEY `topic_id` (`topic_id`),
  ADD KEY `poster_id` (`poster_id`),
  ADD KEY `post_time` (`post_time`),
  ADD KEY `post_icon` (`post_icon`);

ALTER TABLE `nuke_bbposts_text`
  ADD PRIMARY KEY (`post_id`);

ALTER TABLE `nuke_bbpost_reports`
  ADD PRIMARY KEY (`report_id`);

ALTER TABLE `nuke_bbprivmsgs`
  ADD PRIMARY KEY (`privmsgs_id`),
  ADD KEY `privmsgs_from_userid` (`privmsgs_from_userid`),
  ADD KEY `privmsgs_to_userid` (`privmsgs_to_userid`);

ALTER TABLE `nuke_bbprivmsgs_archive`
  ADD PRIMARY KEY (`privmsgs_id`),
  ADD KEY `privmsgs_from_userid` (`privmsgs_from_userid`),
  ADD KEY `privmsgs_to_userid` (`privmsgs_to_userid`);

ALTER TABLE `nuke_bbprivmsgs_text`
  ADD PRIMARY KEY (`privmsgs_text_id`);

ALTER TABLE `nuke_bbquicksearch`
  ADD PRIMARY KEY (`search_id`);

ALTER TABLE `nuke_bbquota_limits`
  ADD PRIMARY KEY (`quota_limit_id`);

ALTER TABLE `nuke_bbranks`
  ADD PRIMARY KEY (`rank_id`);

ALTER TABLE `nuke_bbreputation`
  ADD KEY `user_id` (`user_id`);

ALTER TABLE `nuke_bbscores`
  ADD KEY `game_id` (`game_id`),
  ADD KEY `user_id` (`user_id`);

ALTER TABLE `nuke_bbsearch_rebuild`
  ADD PRIMARY KEY (`rebuild_session_id`),
  ADD KEY `end_post_id` (`end_post_id`);

ALTER TABLE `nuke_bbsearch_results`
  ADD PRIMARY KEY (`search_id`),
  ADD KEY `session_id` (`session_id`);

ALTER TABLE `nuke_bbsearch_wordlist`
  ADD PRIMARY KEY (`word_text`),
  ADD KEY `word_id` (`word_id`);

ALTER TABLE `nuke_bbsearch_wordmatch`
  ADD KEY `post_id` (`post_id`),
  ADD KEY `word_id` (`word_id`);

ALTER TABLE `nuke_bbsessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `session_user_id` (`session_user_id`),
  ADD KEY `session_id_ip_user_id` (`session_id`,`session_ip`,`session_user_id`);

ALTER TABLE `nuke_bbsessions_keys`
  ADD PRIMARY KEY (`key_id`,`user_id`),
  ADD KEY `last_login` (`last_login`);

ALTER TABLE `nuke_bbsmilies`
  ADD PRIMARY KEY (`smilies_id`);

ALTER TABLE `nuke_bbstats_config`
  ADD PRIMARY KEY (`config_name`);

ALTER TABLE `nuke_bbstats_modules`
  ADD PRIMARY KEY (`module_id`);

ALTER TABLE `nuke_bbstats_module_admin_panel`
  ADD PRIMARY KEY (`module_id`);

ALTER TABLE `nuke_bbstats_module_cache`
  ADD PRIMARY KEY (`module_id`);

ALTER TABLE `nuke_bbstats_module_group_auth`
  ADD PRIMARY KEY (`module_id`);

ALTER TABLE `nuke_bbstats_module_info`
  ADD PRIMARY KEY (`module_id`);

ALTER TABLE `nuke_bbstats_smilies_index`
  ADD PRIMARY KEY (`code`);

ALTER TABLE `nuke_bbstats_smilies_info`
  ADD PRIMARY KEY (`last_post_id`);

ALTER TABLE `nuke_bbthemes`
  ADD PRIMARY KEY (`themes_id`);

ALTER TABLE `nuke_bbthemes_name`
  ADD PRIMARY KEY (`themes_id`);

ALTER TABLE `nuke_bbtopics`
  ADD PRIMARY KEY (`topic_id`),
  ADD KEY `forum_id` (`forum_id`),
  ADD KEY `topic_moved_id` (`topic_moved_id`),
  ADD KEY `topic_status` (`topic_status`),
  ADD KEY `topic_type` (`topic_type`);

ALTER TABLE `nuke_bbtopics_watch`
  ADD KEY `topic_id` (`topic_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `notify_status` (`notify_status`);

ALTER TABLE `nuke_bbtopic_moved`
  ADD PRIMARY KEY (`moved_id`);

ALTER TABLE `nuke_bbuser_group`
  ADD KEY `group_id` (`group_id`),
  ADD KEY `user_id` (`user_id`);

ALTER TABLE `nuke_bbvote_desc`
  ADD PRIMARY KEY (`vote_id`),
  ADD KEY `topic_id` (`topic_id`);

ALTER TABLE `nuke_bbvote_results`
  ADD KEY `vote_option_id` (`vote_option_id`),
  ADD KEY `vote_id` (`vote_id`);

ALTER TABLE `nuke_bbvote_voters`
  ADD KEY `vote_id` (`vote_id`),
  ADD KEY `vote_user_id` (`vote_user_id`),
  ADD KEY `vote_user_ip` (`vote_user_ip`),
  ADD KEY `vote_cast` (`vote_cast`);

ALTER TABLE `nuke_bbwords`
  ADD PRIMARY KEY (`word_id`);

ALTER TABLE `nuke_bbxdata_fields`
  ADD PRIMARY KEY (`field_id`),
  ADD UNIQUE KEY `code_name` (`code_name`);

ALTER TABLE `nuke_blocks`
  ADD PRIMARY KEY (`bid`),
  ADD KEY `title` (`title`);

ALTER TABLE `nuke_cnbya_config`
  ADD UNIQUE KEY `config_name` (`config_name`);

ALTER TABLE `nuke_cnbya_field`
  ADD PRIMARY KEY (`fid`);

ALTER TABLE `nuke_cnbya_value`
  ADD PRIMARY KEY (`vid`);

ALTER TABLE `nuke_cnbya_value_temp`
  ADD PRIMARY KEY (`vid`);

ALTER TABLE `nuke_comments`
  ADD PRIMARY KEY (`tid`),
  ADD KEY `pid` (`pid`),
  ADD KEY `sid` (`sid`);

ALTER TABLE `nuke_confirm`
  ADD PRIMARY KEY (`session_id`,`confirm_id`);

ALTER TABLE `nuke_counter`
  ADD KEY `var` (`var`);

ALTER TABLE `nuke_donators`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `nuke_donators_config`
  ADD PRIMARY KEY (`config_name`);

ALTER TABLE `nuke_ecalendar`
  ADD PRIMARY KEY (`eid`);

ALTER TABLE `nuke_evolution`
  ADD PRIMARY KEY (`evo_field`);

ALTER TABLE `nuke_evo_userinfo_addons`
  ADD PRIMARY KEY (`name`);

ALTER TABLE `nuke_faqanswer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cat` (`id_cat`);

ALTER TABLE `nuke_faqcategories`
  ADD PRIMARY KEY (`id_cat`);

ALTER TABLE `nuke_file_repository_categories`
  ADD PRIMARY KEY (`cid`);

ALTER TABLE `nuke_file_repository_comments`
  ADD PRIMARY KEY (`cid`);

ALTER TABLE `nuke_file_repository_files`
  ADD PRIMARY KEY (`fid`);

ALTER TABLE `nuke_file_repository_items`
  ADD PRIMARY KEY (`did`),
  ADD KEY `cid` (`cid`),
  ADD KEY `title` (`title`);

ALTER TABLE `nuke_file_repository_screenshots`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `did` (`did`);

ALTER TABLE `nuke_file_repository_settings`
  ADD PRIMARY KEY (`config_name`);

ALTER TABLE `nuke_file_repository_themes`
  ADD PRIMARY KEY (`theme_name`);

ALTER TABLE `nuke_headlines`
  ADD PRIMARY KEY (`hid`);

ALTER TABLE `nuke_hnl_categories`
  ADD PRIMARY KEY (`cid`);

ALTER TABLE `nuke_hnl_cfg`
  ADD PRIMARY KEY (`cfg_nm`);

ALTER TABLE `nuke_hnl_newsletters`
  ADD PRIMARY KEY (`nid`),
  ADD KEY `cid` (`cid`);

ALTER TABLE `nuke_honeypot`
  ADD UNIQUE KEY `id` (`id`);

ALTER TABLE `nuke_image_repository_settings`
  ADD PRIMARY KEY (`config_name`);

ALTER TABLE `nuke_image_repository_uploads`
  ADD PRIMARY KEY (`pid`);

ALTER TABLE `nuke_image_repository_users`
  ADD PRIMARY KEY (`uid`);

ALTER TABLE `nuke_jmap`
  ADD PRIMARY KEY (`name`);

ALTER TABLE `nuke_links_categories`
  ADD PRIMARY KEY (`cid`);

ALTER TABLE `nuke_links_editorials`
  ADD PRIMARY KEY (`linkid`);

ALTER TABLE `nuke_links_links`
  ADD PRIMARY KEY (`lid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `sid` (`sid`);

ALTER TABLE `nuke_links_modrequest`
  ADD PRIMARY KEY (`requestid`);

ALTER TABLE `nuke_links_newlink`
  ADD PRIMARY KEY (`lid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `sid` (`sid`);

ALTER TABLE `nuke_links_votedata`
  ADD PRIMARY KEY (`ratingdbid`);

ALTER TABLE `nuke_link_us`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `nuke_main`
  ADD KEY `main_module` (`main_module`);

ALTER TABLE `nuke_menu`
  ADD PRIMARY KEY (`groupmenu`);

ALTER TABLE `nuke_menu_categories`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `nuke_message`
  ADD PRIMARY KEY (`mid`),
  ADD UNIQUE KEY `mid` (`mid`);

ALTER TABLE `nuke_meta`
  ADD PRIMARY KEY (`meta_name`);

ALTER TABLE `nuke_modules`
  ADD PRIMARY KEY (`mid`),
  ADD UNIQUE KEY `mid` (`mid`),
  ADD KEY `title` (`title`),
  ADD KEY `custom_title` (`custom_title`);

ALTER TABLE `nuke_modules_cat`
  ADD PRIMARY KEY (`cid`),
  ADD UNIQUE KEY `cid` (`cid`);

ALTER TABLE `nuke_modules_links`
  ADD PRIMARY KEY (`lid`),
  ADD UNIQUE KEY `lid` (`lid`);

ALTER TABLE `nuke_mostonline`
  ADD PRIMARY KEY (`total`);

ALTER TABLE `nuke_nsncb_blocks`
  ADD PRIMARY KEY (`rid`),
  ADD UNIQUE KEY `rid` (`rid`);

ALTER TABLE `nuke_nsncb_config`
  ADD PRIMARY KEY (`cgid`),
  ADD UNIQUE KEY `cfgid` (`cgid`);

ALTER TABLE `nuke_nsnne_config`
  ADD UNIQUE KEY `config_name` (`config_name`);

ALTER TABLE `nuke_nsnsp_config`
  ADD PRIMARY KEY (`config_name`);

ALTER TABLE `nuke_nsnsp_sites`
  ADD PRIMARY KEY (`site_id`);

ALTER TABLE `nuke_nsnst_admins`
  ADD PRIMARY KEY (`aid`),
  ADD KEY `password_md5` (`password_md5`);

ALTER TABLE `nuke_nsnst_blocked_ips`
  ADD PRIMARY KEY (`ip_addr`),
  ADD KEY `ip_long` (`ip_long`);

ALTER TABLE `nuke_nsnst_blocked_ranges`
  ADD KEY `code` (`ip_lo`,`ip_hi`,`c2c`);

ALTER TABLE `nuke_nsnst_blockers`
  ADD PRIMARY KEY (`blocker`);

ALTER TABLE `nuke_nsnst_cidrs`
  ADD PRIMARY KEY (`cidr`);

ALTER TABLE `nuke_nsnst_config`
  ADD PRIMARY KEY (`config_name`);

ALTER TABLE `nuke_nsnst_countries`
  ADD KEY `c2c` (`c2c`);

ALTER TABLE `nuke_nsnst_excluded_ranges`
  ADD KEY `code` (`ip_lo`,`ip_hi`,`c2c`);

ALTER TABLE `nuke_nsnst_harvesters`
  ADD PRIMARY KEY (`harvester`),
  ADD KEY `hid` (`hid`);

ALTER TABLE `nuke_nsnst_protected_ranges`
  ADD KEY `code` (`ip_lo`,`ip_hi`,`c2c`);

ALTER TABLE `nuke_nsnst_referers`
  ADD PRIMARY KEY (`referer`),
  ADD KEY `rid` (`rid`);

ALTER TABLE `nuke_nsnst_tracked_ips`
  ADD PRIMARY KEY (`tid`),
  ADD KEY `maintracking` (`ip_addr`,`ip_long`),
  ADD KEY `ip_addr` (`ip_addr`),
  ADD KEY `ip_long` (`ip_long`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `username` (`username`),
  ADD KEY `user_agent` (`user_agent`(255)),
  ADD KEY `refered_from` (`refered_from`(255)),
  ADD KEY `date` (`date`),
  ADD KEY `page` (`page`(255)),
  ADD KEY `c2c` (`c2c`);

ALTER TABLE `nuke_pages`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `cid` (`cid`);

ALTER TABLE `nuke_pages_categories`
  ADD PRIMARY KEY (`cid`);

ALTER TABLE `nuke_pollcomments`
  ADD PRIMARY KEY (`tid`),
  ADD KEY `pid` (`pid`),
  ADD KEY `pollID` (`pollID`);

ALTER TABLE `nuke_poll_desc`
  ADD PRIMARY KEY (`pollID`);

ALTER TABLE `nuke_queue`
  ADD PRIMARY KEY (`qid`),
  ADD KEY `uid` (`uid`),
  ADD KEY `uname` (`uname`);

ALTER TABLE `nuke_quotes`
  ADD PRIMARY KEY (`qid`);

ALTER TABLE `nuke_referer`
  ADD PRIMARY KEY (`url`),
  ADD KEY `lasttime` (`lasttime`);

ALTER TABLE `nuke_related`
  ADD PRIMARY KEY (`rid`),
  ADD KEY `tid` (`tid`);

ALTER TABLE `nuke_reviews`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `nuke_reviews_add`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `nuke_reviews_comments`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `rid` (`rid`),
  ADD KEY `userid` (`userid`);

ALTER TABLE `nuke_reviews_main`
  ADD KEY `title` (`title`);

ALTER TABLE `nuke_security_agents`
  ADD PRIMARY KEY (`agent_name`);

ALTER TABLE `nuke_session`
  ADD PRIMARY KEY (`uname`),
  ADD KEY `time` (`time`),
  ADD KEY `guest` (`guest`);

ALTER TABLE `nuke_shoutbox_censor`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `nuke_shoutbox_conf`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `nuke_shoutbox_date`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `nuke_shoutbox_emoticons`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `nuke_shoutbox_ipblock`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `nuke_shoutbox_manage_count`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `nuke_shoutbox_nameblock`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `nuke_shoutbox_shouts`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `nuke_shoutbox_sticky`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `nuke_shoutbox_themes`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `nuke_shoutbox_theme_images`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `nuke_shoutbox_version`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `nuke_sommaire`
  ADD PRIMARY KEY (`groupmenu`);

ALTER TABLE `nuke_sommaire_categories`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `nuke_stories`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `catid` (`catid`),
  ADD KEY `counter` (`counter`),
  ADD KEY `topic` (`topic`);

ALTER TABLE `nuke_stories_cat`
  ADD PRIMARY KEY (`catid`);

ALTER TABLE `nuke_subscriptions`
  ADD PRIMARY KEY (`id`,`userid`);

ALTER TABLE `nuke_themes`
  ADD PRIMARY KEY (`theme_name`);

ALTER TABLE `nuke_topics`
  ADD PRIMARY KEY (`topicid`);

ALTER TABLE `nuke_users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `uname` (`username`),
  ADD KEY `user_session_time` (`user_session_time`),
  ADD KEY `user_birthday` (`user_birthday`),
  ADD KEY `user_birthday2` (`user_birthday2`);

ALTER TABLE `nuke_users_countries`
  ADD PRIMARY KEY (`id_country`),
  ADD KEY `IDX_NAME` (`name`);

ALTER TABLE `nuke_users_temp`
  ADD PRIMARY KEY (`user_id`);

ALTER TABLE `nuke_users_who_been`
  ADD PRIMARY KEY (`user_ID`);

ALTER TABLE `nuke_welcome_pm`
  ADD PRIMARY KEY (`subject`);


ALTER TABLE `network_bookmarks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `network_bookmarks_cat`
  MODIFY `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `nuke_autonews`
  MODIFY `anid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `nuke_banner`
  MODIFY `bid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `nuke_banner_clients`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `nuke_banner_plans`
  MODIFY `pid` int(10) NOT NULL AUTO_INCREMENT;

ALTER TABLE `nuke_banner_positions`
  MODIFY `apid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `nuke_bbadvanced_username_color`
  MODIFY `group_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `nuke_bbarcade_categories`
  MODIFY `arcade_catid` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `nuke_bbattachments_desc`
  MODIFY `attach_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

ALTER TABLE `nuke_bbbanlist`
  MODIFY `ban_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `nuke_bbcategories`
  MODIFY `cat_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `nuke_bbdisallow`
  MODIFY `disallow_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `nuke_bbextensions`
  MODIFY `ext_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

ALTER TABLE `nuke_bbextension_groups`
  MODIFY `group_id` mediumint(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

ALTER TABLE `nuke_bbforbidden_extensions`
  MODIFY `ext_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `nuke_bbforums`
  MODIFY `forum_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

ALTER TABLE `nuke_bbforum_prune`
  MODIFY `prune_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `nuke_bbgames`
  MODIFY `game_id` mediumint(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `nuke_bbgroups`
  MODIFY `group_id` mediumint(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

ALTER TABLE `nuke_bbinline_ads`
  MODIFY `ad_id` tinyint(5) NOT NULL AUTO_INCREMENT;

ALTER TABLE `nuke_bblogs`
  MODIFY `log_id` mediumint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

ALTER TABLE `nuke_bbposts`
  MODIFY `post_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

ALTER TABLE `nuke_bbpost_reports`
  MODIFY `report_id` mediumint(8) NOT NULL AUTO_INCREMENT;

ALTER TABLE `nuke_bbprivmsgs`
  MODIFY `privmsgs_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

ALTER TABLE `nuke_bbprivmsgs_archive`
  MODIFY `privmsgs_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `nuke_bbquicksearch`
  MODIFY `search_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `nuke_bbquota_limits`
  MODIFY `quota_limit_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `nuke_bbranks`
  MODIFY `rank_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `nuke_bbsearch_rebuild`
  MODIFY `rebuild_session_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `nuke_bbsearch_wordlist`
  MODIFY `word_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1556;

ALTER TABLE `nuke_bbsmilies`
  MODIFY `smilies_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

ALTER TABLE `nuke_bbstats_modules`
  MODIFY `module_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

ALTER TABLE `nuke_bbthemes`
  MODIFY `themes_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `nuke_bbtopics`
  MODIFY `topic_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

ALTER TABLE `nuke_bbtopic_moved`
  MODIFY `moved_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `nuke_bbvote_desc`
  MODIFY `vote_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `nuke_bbwords`
  MODIFY `word_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `nuke_blocks`
  MODIFY `bid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

ALTER TABLE `nuke_cnbya_field`
  MODIFY `fid` int(10) NOT NULL AUTO_INCREMENT;

ALTER TABLE `nuke_cnbya_value`
  MODIFY `vid` int(10) NOT NULL AUTO_INCREMENT;

ALTER TABLE `nuke_cnbya_value_temp`
  MODIFY `vid` int(10) NOT NULL AUTO_INCREMENT;

ALTER TABLE `nuke_comments`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

ALTER TABLE `nuke_donators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `nuke_ecalendar`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `nuke_faqanswer`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `nuke_faqcategories`
  MODIFY `id_cat` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `nuke_file_repository_categories`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `nuke_file_repository_comments`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `nuke_file_repository_files`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `nuke_file_repository_items`
  MODIFY `did` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `nuke_file_repository_screenshots`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `nuke_headlines`
  MODIFY `hid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE `nuke_hnl_categories`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `nuke_hnl_newsletters`
  MODIFY `nid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `nuke_honeypot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `nuke_image_repository_uploads`
  MODIFY `pid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE `nuke_image_repository_users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

ALTER TABLE `nuke_links_categories`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

ALTER TABLE `nuke_links_links`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

ALTER TABLE `nuke_links_modrequest`
  MODIFY `requestid` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `nuke_links_newlink`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `nuke_links_votedata`
  MODIFY `ratingdbid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

ALTER TABLE `nuke_link_us`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `nuke_menu_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1146;

ALTER TABLE `nuke_message`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `nuke_modules`
  MODIFY `mid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14713;

ALTER TABLE `nuke_modules_cat`
  MODIFY `cid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

ALTER TABLE `nuke_modules_links`
  MODIFY `lid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `nuke_nsnsp_sites`
  MODIFY `site_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `nuke_nsnst_harvesters`
  MODIFY `hid` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;

ALTER TABLE `nuke_nsnst_referers`
  MODIFY `rid` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=366;

ALTER TABLE `nuke_nsnst_tracked_ips`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `nuke_pages`
  MODIFY `pid` int(10) NOT NULL AUTO_INCREMENT;

ALTER TABLE `nuke_pages_categories`
  MODIFY `cid` int(10) NOT NULL AUTO_INCREMENT;

ALTER TABLE `nuke_pollcomments`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `nuke_poll_desc`
  MODIFY `pollID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `nuke_queue`
  MODIFY `qid` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `nuke_quotes`
  MODIFY `qid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `nuke_related`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `nuke_reviews`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

ALTER TABLE `nuke_reviews_add`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

ALTER TABLE `nuke_reviews_comments`
  MODIFY `cid` int(10) NOT NULL AUTO_INCREMENT;

ALTER TABLE `nuke_shoutbox_censor`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

ALTER TABLE `nuke_shoutbox_emoticons`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

ALTER TABLE `nuke_shoutbox_ipblock`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

ALTER TABLE `nuke_shoutbox_manage_count`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `nuke_shoutbox_nameblock`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

ALTER TABLE `nuke_shoutbox_shouts`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

ALTER TABLE `nuke_shoutbox_sticky`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

ALTER TABLE `nuke_shoutbox_themes`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `nuke_shoutbox_theme_images`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

ALTER TABLE `nuke_sommaire_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

ALTER TABLE `nuke_stories`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

ALTER TABLE `nuke_stories_cat`
  MODIFY `catid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `nuke_subscriptions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

ALTER TABLE `nuke_topics`
  MODIFY `topicid` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `nuke_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

ALTER TABLE `nuke_users_countries`
  MODIFY `id_country` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

ALTER TABLE `nuke_users_temp`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT;
