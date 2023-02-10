<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/***************************************************************************
 *                            lang_main.php [English]
 *                              -------------------
 *     begin                : Sat Dec 16 2000
 *     copyright            : (C) 2001 The phpBB Group
 *     email                : support@phpbb.com
 *
 *     $Id: lang_main.php,v 1.1 2005/05/09 17:44:47 chatserv Exp $
 ****************************************************************************/

/***************************************************************************
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 ***************************************************************************/

/*****[CHANGES]**********************************************************
-=[Mod]=-
      Recent Topics                            v1.2.4       06/11/2005
      Global Announcements                     v1.2.8       06/13/2005
      Select Expand BBcodes                    v1.3.0       06/14/2005
      Force Word Wrapping - Configurator       v1.0.16      06/15/2005
      Topic Cement                             v1.0.3       06/15/2005
      Cache phpBB version in ACP               v1.0.0       06/15/2005
      Search Only Subject                      v0.9.1       06/15/2005
      Resize Posted Images                     v2.4.5       06/15/2005
      View/Disable Avatars/Signatures          v1.1.2       06/16/2005
      Signature Editor/Preview Deluxe          v1.0.0       06/22/2005
      Separate Announcements & Sticky          v2.0.0a      06/24/2005
      Staff Site                               v2.0.3       06/24/2005
      Better Session Handling                  v1.0.0       06/25/2005
      Forum Statistics                         v1.2.2       06/25/2005
      Disable Board Admin Override             v0.1.1       07/06/2005
      Memberlist Find User                     v1.0.0       07/06/2005
      PHP Syntax Highlighter BBCode            v3.0.7       07/10/2005
      Theme Simplifications                    v1.0.0       07/19/2005
      Limit smilies per post                   v1.0.2       07/24/2005
      YA Merge                                 v1.0.0       07/28/2005
      User Administration Link on Profile      v1.0.0       07/29/2005
      Move Message - Merge AddOn               v1.0.0       07/30/2005
      Must first vote to see results           v1.0.0       08/03/2005
      Log Moderator Actions                    v1.1.6       08/06/2005
      XData                                    v1.0.3       02/08/2007
      At a Glance Options                      v1.0.0       08/17/2005
      Extended Quote Tag                       v1.0.0       08/17/2005
      At a Glance Cement                       v1.0.0       08/17/2005
      Online Time                              v1.0.0       08/21/2005
      Quick Search                             v3.0.1       08/23/2005
      Hide Images and Links                    v1.0.0       08/30/2005
      Report Posts                             v1.2.3       08/30/2005
      Show Groups                              v1.0.1       09/02/2005
      Hide Images                              v1.0.0       09/02/2005
      Super Quick Reply                        v1.3.2       09/08/2005
      Log Actions Mod - Topic View             v2.0.0       09/18/2005
      Advanced BBCode Box                      v5.0.0a      11/16/2005
      Remote Avatar Resize                     v1.1.4       11/19/2005
      Online/Offline/Hidden                    v2.2.7       01/24/2006
      Auto Group                               v1.2.2       11/06/2006
	  Member Country Flags                     v2.0.7
	  Multiple Ranks And Staff View            v2.0.3
	  Forumtitle as Weblink                    v1.2.2
	  Users of the day                         v2.1.0
	  Gender                                   v1.2.6
	  Birthdays                                v3.0.0
	  Thank You Mod                            v1.1.8
	  Inline Banner Ad                         v1.2.3       05/26/2009
	  XtraColors                               v1.0.0       05/26/2009
	  Email topic to friend                    v1.0.0       05/26/2009
	  Admin User Notes                         v1.0.0       05/28/2009
	  Related Topics                           v0.1.2       05/28/2009
	  Arcade                                   v3.0.2       05/29/2009
      Who viewed a topic                       v1.0.3
 ************************************************************************/

//
// CONTRIBUTORS:
//     Add your details here if wanted, e.g. Name, username, email address, website
// 2002-08-27  Philip M. White        - fixed many grammar problems
//

$lang['private_message_notify'] = 'Hello {USERNAME},<br /><br />The member "{SENDER_USERNAME}" from "{SITENAME}" has just sent you a new private message to your<br />account, and you have requested that you be notified on this event. The content of the message is as follows:<br /><br />"{PM_MESSAGE}"<br /><br />You can view your new message by clicking on the following link:<br />{U_INBOX}<br /><img src="https://www.php-nuke-titanium.86it.us/images/banners/10.png" alt="PHP-Nuke Titanium HQ" title="PHP-Nuke Titanium HQ" data-alt-src="https://www.php-nuke-titanium.86it.us/images/banners/10.png" width="472" height="79" border="0"><br />Remember that you can always choose not to be notified of new messages by changing the appropriate setting in your profile.<br /><br />{EMAIL_SIG}';

$lang['topic_notify'] = 'Hello {USERNAME},<br /><br />You are receiving this email because you are watching the topic, "{TOPIC_TITLE}" at {SITENAME}. This topic has received a reply since your last visit. You can use the following link to view the replies made, no more notifications will be sent until you visit the topic.<br /><br />{U_TOPIC}<br /><br />The contents of the posted reply by {REPLY_BY} are as follows:<br /><br />{CONTENTS}<br /><br />{ATTACHMENT}<br /><br />If you no longer wish to watch this topic you can either click the "Stop watching this topic link" found at the bottom of the topic above, or by clicking the following link:<br /><br />{U_STOP_WATCHING_TOPIC}<br /><br />{EMAIL_SIG}';

$lang['group_added_template'] = 'Congratulations,<br /><br />You have been added to the "{GROUP_NAME}" group on {SITENAME}.<br />This action was done by the group moderator or the site administrator, contact them for more information.<br /><br />You can view your groups information here:<br />
{U_GROUPCP}<br /><br />{EMAIL_SIG}';

$lang['group_approved_template'] = 'Congratulations,<br /><br />Your request to join the "{GROUP_NAME}" group on {SITENAME} has been approved.<br />Click on the following link to see your group membership.<br /><br />{U_GROUPCP}<br /><br />{EMAIL_SIG}';

$lang['group_request_template'] = 'Dear {GROUP_MODERATOR},<br /><br />A user has requested to join a group you moderate on {SITENAME}.<br />To approve or deny this request for group membership please visit the following link:<br /><br />{U_GROUPCP}<br /><br />{EMAIL_SIG}';

$lang['report_post_template'] = 'A post at a site you moderate, {SITENAME}, has been reported.<br />To look at the post, please click on the following link:<br /><br />{U_VIEW_POST}<br /><br />This is what {USERNAME}, the person who reported the post, has to say:<br /><br />{COMMENTS}<br /><br />-----------------<br /><br />Manage reported posts:<br />{REPORT_URL}<br /><br />-----------------<br /><br />You can choose not to receive these emails any more by opting out in the Reported Posts control panel.<br /><br />{EMAIL_SIG}';





//
// The format of this file is ---> $lang['message'] = 'text';
//
// You should also try to set a locale and a character encoding (plus direction). The encoding and direction
// will be sent to the template. The locale may or may not work, it's dependent on OS support and the syntax
// varies ... give it your best guess!
//

$lang['ENCODING'] = 'UTF-8';
$lang['DIRECTION'] = 'ltr';
$lang['LEFT'] = 'left';
$lang['RIGHT'] = 'right';
$lang['DATE_FORMAT'] =  'd M Y'; // This should be changed to the default date format for your language, php date() format

// This is optional, if you would like a _SHORT_ message output
// along with our copyright message indicating you are the translator
// please add it here.
// $lang['TRANSLATION'] = '';

$lang['rank_title']     = 'Groups';
$lang['not_specified']  = 'Not Specified';

//
// Common, these terms are used
// extensively on several pages
//
$lang['Forum'] = 'Forum';
$lang['Category'] = 'Category';
$lang['Topic'] = 'Topic';
$lang['Topics'] = 'Topics';
$lang['Replies'] = 'Replies';
$lang['Views'] = 'Views';
$lang['Post'] = 'Post';
$lang['Posts'] = 'Posts';
$lang['Posted'] = 'Posted';
$lang['Username'] = 'Nickname/Callsign';
$lang['Password'] = 'Password';
$lang['Email'] = 'Email';
$lang['Poster'] = 'Poster';
$lang['Author'] = 'Author';
$lang['Time'] = 'Time';
$lang['Hours'] = 'Hours';
$lang['Message'] = 'Message';

$lang['1_Day'] = '1 Day';
$lang['7_Days'] = '7 Days';
$lang['2_Weeks'] = '2 Weeks';
$lang['1_Month'] = '1 Month';
$lang['3_Months'] = '3 Months';
$lang['6_Months'] = '6 Months';
$lang['1_Year'] = '1 Year';

$lang['Go'] = 'Go';
$lang['Jump_to'] = 'Jump to';
$lang['Submit'] = 'Submit';
$lang['Reset'] = 'Reset';
$lang['Required'] = 'Required';
$lang['Cancel'] = 'Cancel';
$lang['Preview'] = 'Preview';
$lang['Confirm'] = 'Confirm';
$lang['Spellcheck'] = 'Spellcheck';
$lang['Yes'] = 'Yes';
$lang['No'] = 'No';
$lang['Enabled'] = 'Enabled';
$lang['Disabled'] = 'Disabled';
$lang['Error'] = 'Error';

$lang['Next'] = 'Next';
$lang['Previous'] = 'Previous';
$lang['Goto_page'] = 'Goto page';
$lang['Joined'] = 'Joined';
$lang['IP_Address'] = 'IP Address';

$lang['Select_forum'] = 'Select a forum';
$lang['View_latest_post'] = 'View latest post';
$lang['View_newest_post'] = 'View newest post';
$lang['Page_of'] = 'Page <strong>%d</strong> of <strong>%d</strong>'; // Replaces with: Page 1 of 2 for example

/*****[BEGIN]******************************************
 [ Mod:     Facebook Profile Mod               v1.0.0 ]
 ******************************************************/
$lang['facebook'] = 'Facebook Profile';
$lang['facebook_explain'] = 'Enter your Facebook profile id number';
$lang['FACEBOOK_PROFILE'] = 'Facebook';
$lang['Visit_facebook'] = 'Visit user\'s Facebook';
/*****[END]********************************************
 [ Mod:     Facebook Profile Mod               v1.0.0 ]
 ******************************************************/ 

/**
 * @since 2.0.9e
 */
$lang['User_last_visit'] = 'Last Visit';
$lang['User_contact_details'] = '%s\'s Contact Details';
$lang['Additional_info'] = 'Additional Info About %s';
$lang['Users_signature'] = '%s\'s Signature';
$lang['Forum_Info'] = '%s\'s Forum Info';

$lang['Edit_Forum_User_ACP'] = '%sEdit this user in Forum ACP%s';
$lang['Ban_Forum_User_IP'] = '%sBan this user in NukeSentinel%s';
$lang['Suspend_This_User'] = '%sSuspend this user%s';
$lang['Delete_This_User'] = '%sDelete this user%s';

// $lang['Forum_Index'] = '%s Forum Index';  // eg. sitename Forum Index, %s can be removed if you prefer
$lang['Forum_Index'] = 'Forum Index';


$lang['Post_new_topic'] = 'Post new topic';
$lang['Reply_to_topic'] = 'Reply to topic';
$lang['Reply_with_quote'] = 'Reply with quote';

$lang['Click_return_topic'] = 'Click %sHere%s to return to the topic'; // %s's here are for uris, do not remove!
$lang['Click_return_login'] = 'Click %sHere%s to try again';
$lang['Click_return_forum'] = 'Click %sHere%s to return to the forum';
$lang['Click_view_message'] = 'Click %sHere%s to view your message';
$lang['Click_return_modcp'] = 'Click %sHere%s to return to the Moderator Control Panel';
$lang['Click_return_group'] = 'Click %sHere%s to return to group information';

$lang['Admin_panel'] = 'Go to Administration Panel';

$lang['Board_disable'] = 'Sorry, but this board is currently unavailable.  Please try again later.';

//
// Global Header strings
//
$lang['Registered_users'] = 'Registered Users:';
/*****[BEGIN]******************************************
 [ Mod:     Users of the day                   v2.1.0 ]
 ******************************************************/
$lang['day_userlist_users'] = '%d registered users visit during the last %d hours:';
/*****[END]********************************************
 [ Mod:     Users of the day                   v2.1.0 ]
 ******************************************************/
$lang['Browsing_forum'] = 'Users browsing this forum:';
$lang['Online_users_zero_total'] = 'In total there are <strong>0</strong> users online :: ';
$lang['Online_users_total'] = 'In total there are <strong>%d</strong> users online :: ';
$lang['Online_user_total'] = 'In total there is <strong>%d</strong> user online :: ';
$lang['Reg_users_zero_total'] = '0 Registered, ';
$lang['Reg_users_total'] = '%d Registered, ';
$lang['Reg_user_total'] = '%d Registered, ';
$lang['Hidden_users_zero_total'] = '0 Hidden and ';
$lang['Hidden_user_total'] = '%d Hidden and ';
$lang['Hidden_users_total'] = '%d Hidden and ';
$lang['Guest_users_zero_total'] = '0 Guests';
$lang['Guest_users_total'] = '%d Guests';
$lang['Guest_user_total'] = '%d Guest';
$lang['Record_online_users'] = 'Most users ever online was <strong>%s</strong> on %s'; // first %s = number of users, second %s is the date.

$lang['Admin_online_color'] = '%sAdministrator%s';
$lang['Mod_online_color'] = '%sModerator%s';

$lang['You_last_visit'] = 'You last visited on %s'; // %s replaced by date/time
$lang['Current_time'] = 'The time now is %s'; // %s replaced by time

$lang['Search_new'] = 'View posts since last visit';
$lang['Search_your_posts'] = 'View your posts';
$lang['Search_unanswered'] = 'View unanswered posts';

$lang['Register'] = 'Register';
$lang['Profile'] = 'Profile';
$lang['Edit_profile'] = 'Edit your profile';
$lang['Search'] = 'Search';
$lang['Memberlist'] = 'Members';
$lang['FAQ'] = 'Forum FAQ';
$lang['Legend'] = 'Legend';
/*****[BEGIN]******************************************
 [ Mod:     Forum Statistics                   v1.2.2 ]
 ******************************************************/
$lang['Statistics'] = 'Statistics';
/*****[END]********************************************
 [ Mod:     Forum Statistics                   v1.2.2 ]
 ******************************************************/
$lang['BBCode_guide'] = 'BBCode Guide';
$lang['Usergroups'] = 'Usergroups';
$lang['Last_Post'] = 'Last Post';
/*****[BEGIN]******************************************
 [ Mod:     Resize Posted Images               v2.4.5 ]
 ******************************************************/
// $lang['rmw_image_title'] = 'Click to view full-size';
/*****[END]********************************************
 [ Mod:     Resize Posted Images               v2.4.5 ]
 ******************************************************/
$lang['Moderator'] = 'Mod Group:'; 
$lang['Moderators'] = 'Mod Groups:';

//
// Stats block text
//
$lang['Posted_articles_zero_total'] = 'Our users have posted a total of 0 articles'; // Number of posts
$lang['Posted_articles_total'] = 'Our users have posted a total of %d articles'; // Number of posts
$lang['Posted_article_total'] = 'Our users have posted a total of %d article'; // Number of posts
$lang['Registered_users_zero_total'] = 'We have 0 registered users'; // # registered users
$lang['Registered_users_total'] = 'We have %d registered users'; // # registered users
$lang['Registered_user_total'] = 'We have %d registered user'; // # registered users
$lang['Newest_user'] = 'The newest registered user is %s%s%s'; // a href, username, /a

$lang['No_new_posts_last_visit'] = 'No new posts since your last visit';
$lang['No_new_posts'] = 'No new posts';
$lang['New_posts'] = 'New posts';
$lang['New_post'] = 'New post';
$lang['No_new_posts_hot'] = 'No new posts [ Popular ]';
$lang['New_posts_hot'] = 'New posts [ Popular ]';
$lang['No_new_posts_locked'] = 'No new posts [ Locked ]';
$lang['New_posts_locked'] = 'New posts [ Locked ]';
$lang['Forum_is_locked'] = 'Forum is locked';

//
// Login
//
$lang['Enter_password'] = 'Please enter your username and password to log in.';
$lang['Login'] = 'Log in';
$lang['Logout'] = 'Log out';

$lang['Forgotten_password'] = 'I forgot my password';

$lang['Log_me_in'] = 'Log me on automatically each visit';

$lang['Error_login'] = 'You have specified an incorrect or inactive username, or an invalid password.';

//
// Index page
//
$lang['Index'] = 'Index';
$lang['No_Posts'] = 'No Posts';
$lang['No_forums'] = 'This board has no forums';

$lang['Private_Message'] = 'Private Message';
$lang['Private_Messages'] = 'Private Messages';
$lang['Who_is_Online'] = 'Who is Online';

$lang['Mark_all_forums'] = 'Mark forums read';
$lang['Forums_marked_read'] = 'All forums have been marked read';

//
// Viewforum
//
$lang['View_forum'] = 'View Forum';

$lang['Forum_not_exist'] = 'The forum you selected does not exist.';
$lang['Reached_on_error'] = 'You have reached this page in error.';

$lang['Display_topics'] = 'Display topics from previous';
$lang['All_Topics'] = 'All Topics';

$lang['Topic_Announcement'] = '<strong>Announcement:</strong>';
$lang['Topic_Sticky'] = '<strong>Sticky:</strong>';
$lang['Topic_Moved'] = '<strong>Moved:</strong>';
$lang['Topic_Poll'] = '<strong>[ Poll ]</strong>';

$lang['Mark_all_topics'] = 'Mark all topics read';
$lang['Topics_marked_read'] = 'The topics for this forum have now been marked read';

$lang['Rules_post_can'] = 'You <strong>can</strong> post new topics in this forum';
$lang['Rules_post_cannot'] = 'You <strong>cannot</strong> post new topics in this forum';
$lang['Rules_reply_can'] = 'You <strong>can</strong> reply to topics in this forum';
$lang['Rules_reply_cannot'] = 'You <strong>cannot</strong> reply to topics in this forum';
$lang['Rules_edit_can'] = 'You <strong>can</strong> edit your posts in this forum';
$lang['Rules_edit_cannot'] = 'You <strong>cannot</strong> edit your posts in this forum';
$lang['Rules_delete_can'] = 'You <strong>can</strong> delete your posts in this forum';
$lang['Rules_delete_cannot'] = 'You <strong>cannot</strong> delete your posts in this forum';
$lang['Rules_vote_can'] = 'You <strong>can</strong> vote in polls in this forum';
$lang['Rules_vote_cannot'] = 'You <strong>cannot</strong> vote in polls in this forum';
$lang['Rules_moderate'] = 'You <strong>can</strong> %smoderate this forum%s'; // %s replaced by a href links, do not remove!

$lang['No_topics_post_one'] = 'There are no posts in this forum.<br />Click on the <span style="font-weight: bold;">New Topic</span> link on this page to post one.';

//
// Viewtopic
//
$lang['View_topic'] = 'View topic';

$lang['Guest'] = 'Guest';
$lang['Post_subject'] = 'Post subject';
$lang['View_next_topic'] = 'View next topic';
$lang['View_previous_topic'] = 'View previous topic';
$lang['Submit_vote'] = 'Submit Vote';
$lang['View_results'] = 'View Results';
$lang['must_first_vote'] = 'You must first vote to see the results of this poll';

$lang['No_newer_topics'] = 'There are no newer topics in this forum';
$lang['No_older_topics'] = 'There are no older topics in this forum';
$lang['Topic_post_not_exist'] = 'The topic or post you requested does not exist';
$lang['No_posts_topic'] = 'No posts exist for this topic';

$lang['Display_posts'] = 'Display posts from previous';
$lang['All_Posts'] = 'All Posts';
$lang['Newest_First'] = 'Newest First';
$lang['Oldest_First'] = 'Oldest First';

$lang['Back_to_top'] = 'Back to top';

$lang['Read_profile'] = 'View user\'s profile';
$lang['Visit_website'] = 'Visit user\'s website';
$lang['ICQ_status'] = 'ICQ Status';
$lang['Edit_delete_post'] = 'Edit/Delete this post';
$lang['View_IP'] = 'View IP address of poster';
$lang['Delete_post'] = 'Delete this post';

$lang['wrote'] = 'wrote'; // proceeds the username and is followed by the quoted text
$lang['Quote'] = 'Quote'; // comes before bbcode quote output.
$lang['Code'] = 'Code'; // comes before bbcode code output.
/*****[BEGIN]******************************************
 [ Mod:     PHP Syntax Highlighter BBCode      v3.0.7 ]
 ******************************************************/
$lang['PHPCode'] = 'PHP'; // PHP MOD
/*****[END]********************************************
 [ Mod:     PHP Syntax Highlighter BBCode      v3.0.7 ]
 ******************************************************/

$lang['Edited_time_total'] = 'Last edited by %s on %s; edited %d time in total'; // Last edited by me on 12 Oct 2001; edited 1 time in total
$lang['Edited_times_total'] = 'Last edited by %s on %s; edited %d times in total'; // Last edited by me on 12 Oct 2001; edited 2 times in total

$lang['Lock_topic'] = 'Lock this topic';
$lang['Unlock_topic'] = 'Unlock this topic';
$lang['Move_topic'] = 'Move this topic';
$lang['Delete_topic'] = 'Delete this topic';
$lang['Split_topic'] = 'Split this topic';

$lang['Stop_watching_topic'] = 'Stop watching this topic';
$lang['Start_watching_topic'] = 'Watch this topic for replies';
$lang['No_longer_watching'] = 'You are no longer watching this topic';
$lang['You_are_watching'] = 'You are now watching this topic';

$lang['Total_votes'] = 'Total Votes';

//
// Posting/Replying (Not private messaging!)
//
$lang['Message_body'] = 'Message body';
$lang['Topic_review'] = 'Topic review';

$lang['No_post_mode'] = 'No post mode specified'; // If posting.php is called without a mode (newtopic/reply/delete/etc, shouldn't be shown normaly)

$lang['Post_a_new_topic'] = 'Post a new topic';
$lang['Post_a_reply'] = 'Post a reply';
$lang['Post_topic_as'] = 'Post topic type';
$lang['Edit_Post'] = 'Edit post';
$lang['Options'] = 'Options';

$lang['Post_Announcement'] = 'Announcement';
$lang['Post_Sticky'] = 'Sticky';
$lang['Post_Normal'] = 'Normal';

$lang['Confirm_delete'] = 'Are you sure you want to delete this post?';
$lang['Confirm_delete_poll'] = 'Are you sure you want to delete this poll?';

$lang['Flood_Error'] = 'You cannot make another post so soon after your last; please try again in a short while.';
$lang['Empty_subject'] = 'You must specify a subject when posting a new topic.';
$lang['Empty_message'] = 'You must enter a message when posting.';
$lang['Forum_locked'] = 'This forum is locked: you cannot post, reply to, or edit topics.';
$lang['Topic_locked'] = 'This topic is locked: you cannot edit posts or make replies.';
$lang['No_post_id'] = 'You must select a post to edit';
$lang['No_topic_id'] = 'You must select a topic to reply to';
$lang['No_valid_mode'] = 'You can only post, reply, edit, or quote messages. Please return and try again.';
$lang['No_such_post'] = 'There is no such post. Please return and try again.';
$lang['Edit_own_posts'] = 'Sorry, but you can only edit your own posts.';
$lang['Delete_own_posts'] = 'Sorry, but you can only delete your own posts.';
$lang['Cannot_delete_replied'] = 'Sorry, but you may not delete posts that have been replied to.';
$lang['Cannot_delete_poll'] = 'Sorry, but you cannot delete an active poll.';
$lang['Empty_poll_title'] = 'You must enter a title for your poll.';
$lang['To_few_poll_options'] = 'You must enter at least two poll options.';
$lang['To_many_poll_options'] = 'You have tried to enter too many poll options.';
$lang['Post_has_no_poll'] = 'This post has no poll.';
$lang['Already_voted'] = 'You have already voted in this poll.';
$lang['No_vote_option'] = 'You must specify an option when voting.';

$lang['Add_poll'] = 'Add a Poll';
$lang['Add_poll_explain'] = 'If you do not want to add a poll to your topic, leave the fields blank.';
$lang['Poll_view_toggle_explain'] = '[ Allows user to see results before voting. ]';
$lang['Poll_question'] = 'Poll question';
$lang['Poll_option'] = 'Poll option';
$lang['Add_option'] = 'Add option';
$lang['Update'] = 'Update';
$lang['Delete'] = 'Delete';
$lang['Poll_for'] = 'Run poll for';
$lang['Poll_view_toggle'] = 'Allow View';
$lang['Days'] = 'Days'; // This is used for the Run poll for ... Days + in admin_forums for pruning
$lang['Poll_for_explain'] = '[ Enter 0 or leave blank for a never-ending poll ]';
$lang['Delete_poll'] = 'Delete Poll';

$lang['Disable_HTML_post'] = 'Disable HTML in this post';
$lang['Disable_BBCode_post'] = 'Disable BBCode in this post';
$lang['Disable_Smilies_post'] = 'Disable Smilies in this post';

$lang['HTML_is_ON'] = 'HTML is <u>ON</u>';
$lang['HTML_is_OFF'] = 'HTML is <u>OFF</u>';
// $lang['BBCode_is_ON'] = '%sBBCode%s is <u>ON</u>';
// $lang['BBCode_is_OFF'] = '%sBBCode%s is <u>OFF</u>';
$lang['BBCode_is_ON'] = 'BBCode is <u>ON</u>';
$lang['BBCode_is_OFF'] = 'BBCode is <u>OFF</u>';
$lang['Smilies_are_ON'] = 'Smilies are <u>ON</u>';
$lang['Smilies_are_OFF'] = 'Smilies are <u>OFF</u>';

$lang['Attach_signature'] = 'Attach signature (signatures can be changed in profile)';
$lang['Notify'] = 'Notify me when a reply is posted';

$lang['Stored'] = 'Your message has been entered successfully.';
$lang['Deleted'] = 'Your message has been deleted successfully.';
$lang['Poll_delete'] = 'Your poll has been deleted successfully.';
$lang['Vote_cast'] = 'Your vote has been cast.';

$lang['Topic_reply_notification'] = 'Topic Reply Notification';

$lang['Close_Tags'] = 'Close Tags';
$lang['Styles_tip'] = 'Tip: Styles can be applied quickly to selected text.';
$lang['glance_news_heading'] = 'Latest Site News';
$lang['glance_recent_heading'] = 'Recent Topics';

//
// Private Messaging
//
$lang['Private_Messaging'] = 'Private Messaging';

//
// PM with sound
//
$lang['New_pms'] = '%d new messages'; // You have 2 new messages
$lang['New_pm'] = '%d new message'; // You have 1 new message
//
// end PM with sound
//
$lang['Login_check_pm'] = 'Login, Check Messages';
$lang['No_new_pm'] = 'No new messages';
$lang['Unread_pms'] = '%d unread messages';
$lang['Unread_pm'] = '%d unread message';
$lang['No_unread_pm'] = 'No unread messages';
$lang['You_new_pm'] = '%d new private message';// You have 1 new message
$lang['You_new_pms'] = '%d new private messages';// You have 2 new messages
$lang['You_no_new_pm'] = 'No new private messages';

$lang['Unread_message'] = 'Unread message';
$lang['Read_message'] = 'Read message';

$lang['Read_pm'] = 'Read message';
$lang['Post_new_pm'] = 'Post message';
$lang['Post_reply_pm'] = 'Reply to message';
$lang['Post_quote_pm'] = 'Quote message';
$lang['Edit_pm'] = 'Edit message';

$lang['Inbox'] = 'Inbox';
$lang['Outbox'] = 'Outbox';
$lang['Savebox'] = 'Savebox';
$lang['Sentbox'] = 'Sentbox';
$lang['Flag'] = 'Flag';
$lang['Subject'] = 'Subject';
$lang['From'] = 'From';
$lang['To'] = 'To';
$lang['Date'] = 'Date';
$lang['Mark'] = 'Mark';
$lang['Sent'] = 'Sent';
$lang['Saved'] = 'Saved';
$lang['Delete_marked'] = 'Delete Marked';
$lang['Delete_all'] = 'Delete All';
$lang['Save_marked'] = 'Save Marked';
$lang['Save_message'] = 'Save Message';
$lang['Delete_message'] = 'Delete Message';

$lang['Display_messages'] = 'Display messages from previous'; // Followed by number of days/weeks/months
$lang['All_Messages'] = 'All Messages';

$lang['No_messages_folder'] = 'You have no messages in this folder';

$lang['PM_disabled'] = 'Private messaging has been disabled on this board.';
$lang['Cannot_send_privmsg'] = 'Sorry, but the administrator has prevented you from sending private messages.';
$lang['No_to_user'] = 'You must specify a username to whom to send this message.';
$lang['No_such_user'] = 'Sorry, but no such user exists.';

$lang['Disable_HTML_pm'] = 'Disable HTML in this message';
$lang['Disable_BBCode_pm'] = 'Disable BBCode in this message';
$lang['Disable_Smilies_pm'] = 'Disable Smilies in this message';

$lang['Message_sent'] = 'Your message has been sent.';

$lang['Click_return_inbox'] = 'Click %sHere%s to return to your Inbox';
$lang['Click_return_index'] = 'Click %sHere%s to return to the Index';
$lang['Click_return_profile'] = 'Click %sHere%s to return to your Profile';

$lang['Send_a_new_message'] = 'Send a new private message';
$lang['Send_a_reply'] = 'Reply to a private message';
$lang['Edit_message'] = 'Edit private message';

$lang['Notification_subject'] = 'New Private Message has arrived!';

$lang['Find_username'] = 'Find a username';
$lang['Find'] = 'Find';
$lang['No_match'] = 'No matches found.';

$lang['No_post_id'] = 'No post ID was specified';
$lang['No_such_folder'] = 'No such folder exists';
$lang['No_folder'] = 'No folder specified';

$lang['Mark_all'] = 'Mark all';
$lang['Unmark_all'] = 'Unmark all';

$lang['Confirm_delete_pm'] = 'Are you sure you want to delete this message?';
$lang['Confirm_delete_pms'] = 'Are you sure you want to delete these messages?';

$lang['Inbox_size'] = 'Your Inbox is %d%% full'; // eg. Your Inbox is 50% full
$lang['Sentbox_size'] = 'Your Sentbox is %d%% full';
$lang['Savebox_size'] = 'Your Savebox is %d%% full';

$lang['Click_view_privmsg'] = 'Click %sHere%s to visit your Inbox';

//
// Profiles/Registration
//
$lang['Viewing_user_profile'] = 'Profile of %s'; // %s is username
$lang['About_user'] = 'All about %s'; // %s is username
/*****[BEGIN]******************************************
 [ Mod:    User Administration Link on Profile v1.0.0 ]
 ******************************************************/
// $lang['User_admin_for'] = 'User Administration for';
$lang['User_admin_for'] = 'Admin Options';
/*****[END]********************************************
 [ Mod:    User Administration Link on Profile v1.0.0 ]
 ******************************************************/

$lang['Preferences'] = 'Preferences';
$lang['Items_required'] = 'Items marked with a * are required unless stated otherwise.';
$lang['Registration_info'] = 'Registration Information';
$lang['Password_change'] = 'Change Password';
$lang['Profile_info'] = 'Profile Information';
$lang['Profile_info_warn'] = 'This information will be publicly viewable';
$lang['Avatar_panel'] = 'Avatar control panel';
$lang['Avatar_gallery'] = 'Avatar gallery';

$lang['sceditor_options'] = 'SCeditor Options';
$lang['sceditor_state'] = 'Choose which state SCEditor should be in by default';
$lang['sceditor_display_mode'] = 'Display Mode';
$lang['sceditor_editor_mode'] = 'Editor Mode';

$lang['Website'] = 'Website';
$lang['Location'] = 'Location';
$lang['Contact'] = 'Contact';
$lang['Email_address'] = 'Email';
// $lang['Send_private_message'] = 'Send private message';
$lang['Send_private_message'] = 'Send %s a private message';
$lang['Hidden_email'] = '[ Hidden ]';
$lang['Interests'] = 'Interests';
$lang['Occupation'] = 'Occupation';
$lang['Poster_rank'] = 'Poster rank';

$lang['Total_posts'] = 'Posts';
$lang['User_post_pct_stats'] = '%.2f%% of total posts'; // 1.25% of total
$lang['User_post_day_stats'] = '%.2f per day'; // 1.5 posts per day
$lang['Search_user_posts'] = 'Find all posts by %s'; // Find all posts by username

$lang['Ghost_Mode_Specified'] = '<img style="padding-bottom: 3px;" src="images/ico/snapchat-002.ico" alt="Ghost Mode" data-alt-src="images/ico/snapchat-002.ico" width="16" height="19"> User is in Ghost Mode';
$lang['No_user_id_specified'] = '<img style="padding-bottom: 3px;" src="images/ico/snapchat-002.ico" alt="Ghost Mode" data-alt-src="images/ico/snapchat-002.ico" width="16" height="19"> User is in Ghost Mode';
$lang['No_user_id_members_list_specified'] = 'No Users Found';
$lang['Wrong_Profile'] = 'You cannot modify a profile that is not your own.';

$lang['Only_one_avatar'] = 'Only one type of avatar can be specified';
$lang['File_no_data'] = 'The file at the URL you gave contains no data';
$lang['No_connection_URL'] = 'A connection could not be made to the URL you gave';
$lang['Incomplete_URL'] = 'The URL you entered is incomplete';
$lang['Wrong_remote_avatar_format'] = 'The URL of the remote avatar is not valid';
$lang['No_send_account_inactive'] = 'Sorry, but your password cannot be retrieved because your account is currently inactive. Please contact the forum administrator for more information.';

$lang['Always_smile'] = 'Always enable Smilies';
$lang['Always_html'] = 'Always allow HTML';
$lang['Always_bbcode'] = 'Always allow BBCode';
$lang['Always_add_sig'] = 'Always attach my signature';
$lang['Always_notify'] = 'Always notify me of replies';
$lang['Always_notify_explain'] = 'Sends an e-mail when someone replies to a topic you have posted in. This can be changed whenever you post.';

/*****[BEGIN]******************************************
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 ******************************************************/
$lang['Word_Wrap'] = 'Screen Width';
$lang['Word_Wrap_Explain'] = 'This is the maximum line length of user\'s posts.';
$lang['Word_Wrap_Extra'] = 'characters (range: %min% - %max% chars.)';
$lang['Word_Wrap_Error'] = 'The post display width is out of range.';
/*****[END]********************************************
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 ******************************************************/

$lang['Board_style'] = 'Board Style';
$lang['Board_lang'] = 'Board Language';
$lang['No_themes'] = 'No Themes In database';
$lang['Timezone'] = 'Timezone';
$lang['Date_format'] = 'Date format';
$lang['Date_format_explain'] = 'The syntax used is identical to the PHP <a href=\'http://www.php.net/date\' target=\'_other\'>date()</a> function.';
$lang['Signature'] = 'Signature';
$lang['Signature_explain'] = 'This is a block of text that can be added to posts you make. There is a %d character limit';
$lang['Public_view_email'] = 'Always show my e-mail address';

$lang['Current_password'] = 'Current password';
$lang['New_password'] = 'New password';
$lang['Confirm_password'] = 'Confirm password';
$lang['Confirm_password_explain'] = 'You must confirm your current password if you wish to change it or alter your e-mail address';
$lang['password_if_changed'] = 'You only need to supply a password if you want to change it';
$lang['password_confirm_if_changed'] = 'You only need to confirm your password if you changed it above';

/*****[BEGIN]******************************************
 [ Mod:    Password security                   v1.1.0 ]
 ******************************************************/
$lang['password_security_level1'] = 'Unsafe';
$lang['password_security_level2'] = 'Not recommendable';
$lang['password_security_level3'] = 'Relatively safe';
$lang['password_security_level4'] = 'Safe';
$lang['password_security_level5'] = 'Very safe';
$lang['password_security_explain'] = 'Password security:';
/*****[END]********************************************
 [ Mod:    Password security                   v1.1.0 ]
 ******************************************************/

$lang['Avatar'] = 'Avatar';
/*****[BEGIN]******************************************
 [ Mod:     Remote Avatar Resize               v1.1.4 ]
 ******************************************************/
$lang['Avatar_explain'] = 'Displays a small graphic image below your details in posts. Only one image can be displayed at a time. The dimensions of the image are restricted to a maximum of %d pixels wide, and %d pixels high. Uploaded avatars have a file size limit of %d KB, and must be less than or equal to the maximum dimensions. Remotely hosted avatars will be automatically scaled to fit these dimensions.';
/*****[END]********************************************
 [ Mod:     Remote Avatar Resize               v1.1.4 ]
 ******************************************************/
$lang['Upload_Avatar_file'] = 'Upload Avatar from your machine';
$lang['Upload_Avatar_URL'] = 'Upload Avatar from a URL';
$lang['Upload_Avatar_URL_explain'] = 'Enter the URL of the location containing the Avatar image, it will be copied to this site.';
$lang['Pick_local_Avatar'] = 'Select Avatar from the gallery';
$lang['Link_remote_Avatar'] = 'Link to off-site Avatar';
$lang['Link_remote_Avatar_explain'] = 'Enter the URL of the location containing the Avatar image you wish to link to.';
$lang['Avatar_URL'] = 'URL of Avatar Image';
$lang['Select_from_gallery'] = 'Select Avatar from gallery';
$lang['View_avatar_gallery'] = 'Show gallery';

$lang['Select_avatar'] = 'Select avatar';
$lang['Return_profile'] = 'Cancel avatar';
$lang['Select_category'] = 'Select category';

$lang['Delete_Image'] = 'Delete Image';
$lang['Current_Image'] = 'Current Image';

$lang['Notify_on_privmsg'] = 'Notify on new Private Message';
$lang['Popup_on_privmsg'] = 'Pop up window on new Private Message';
$lang['Popup_on_privmsg_explain'] = 'Some templates may open a new window to inform you when new private messages arrive.';
$lang['Hide_user'] = 'Ghost Mode (Hide your membership and online status)';

$lang['Profile_updated'] = 'Your profile has been updated';
$lang['Profile_updated_inactive'] = 'Your profile has been updated. However, you have changed vital details, thus your account is now inactive. Check your e-mail to find out how to reactivate your account, or if admin activation is required, wait for the administrator to reactivate it.';

$lang['Password_mismatch'] = 'The passwords you entered did not match.';
$lang['Current_password_mismatch'] = 'The current password you supplied does not match that stored in the database.';
$lang['Password_long'] = 'Your password must be no more than 32 characters.';
$lang['Username_taken'] = 'Sorry, but this username has already been taken.';
$lang['Username_invalid'] = 'Sorry, but this username contains an invalid character such as \'.';
$lang['Username_disallowed'] = 'Sorry, but this username has been disallowed.';
$lang['Email_taken'] = 'Sorry, but that e-mail address is already registered to a user.';
$lang['Email_banned'] = 'Sorry, but this e-mail address has been banned.';
$lang['Email_invalid'] = 'Sorry, but this e-mail address is invalid.';
$lang['Signature_too_long'] = 'Your signature is too long.';
$lang['Fields_empty'] = 'You must fill in the required fields.';
$lang['Avatar_filetype'] = 'The avatar filetype must be .jpg, .gif or .png';
$lang['Avatar_filesize'] = 'The avatar image file size must be less than %d KB'; // The avatar image file size must be less than 6 KB
$lang['Avatar_imagesize'] = 'The avatar must be less than %d pixels wide and %d pixels high';

$lang['Welcome_subject'] = 'Welcome to %s Forums'; // Welcome to my.com forums
$lang['New_account_subject'] = 'New user account';
$lang['Account_activated_subject'] = 'Account Activated';

$lang['Account_added'] = 'Thank you for registering. Your account has been created. You may now log in with your username and password';
$lang['Account_inactive'] = 'Your account has been created. However, this forum requires account activation. An activation key has been sent to the e-mail address you provided. Please check your e-mail for further information';
$lang['Account_inactive_admin'] = 'Your account has been created. However, this forum requires account activation by the administrator. An e-mail has been sent to them and you will be informed when your account has been activated';
$lang['Account_active'] = 'Your account has now been activated. Thank you for registering';
$lang['Account_active_admin'] = 'The account has now been activated';
$lang['Reactivate'] = 'Reactivate your account!';
$lang['Already_activated'] = 'You have already activated your account';
$lang['COPPA'] = 'Your account has been created but has to be approved. Please check your e-mail for details.';

$lang['Registration'] = 'Registration Agreement Terms';
$lang['Reg_agreement'] = 'While the administrators and moderators of this forum will attempt to remove or edit any generally objectionable material as quickly as possible, it is impossible to review every message. Therefore you acknowledge that all posts made to these forums express the views and opinions of the author and not the administrators, moderators or webmaster (except for posts by these people) and hence will not be held liable.<br /><br />You agree not to post any abusive, obscene, vulgar, slanderous, hateful, threatening, sexually-oriented or any other material that may violate any applicable laws. Doing so may lead to you being immediately and permanently banned (and your service provider being informed). The IP address of all posts is recorded to aid in enforcing these conditions. You agree that the webmaster, administrator and moderators of this forum have the right to remove, edit, move or close any topic at any time should they see fit. As a user you agree to any information you have entered above being stored in a database. While this information will not be disclosed to any third party without your consent the webmaster, administrator and moderators cannot be held responsible for any hacking attempt that may lead to the data being compromised.<br /><br />This forum system uses cookies to store information on your local computer. These cookies do not contain any of the information you have entered above; they serve only to improve your viewing pleasure. The e-mail address is used only for confirming your registration details and password (and for sending new passwords should you forget your current one).<br /><br />By clicking Register below you agree to be bound by these conditions.';

$lang['Agree_under_13'] = 'I Agree to these terms and am <strong>under</strong> 13 years of age';
$lang['Agree_over_13'] = 'I Agree to these terms and am <strong>over</strong> or <strong>exactly</strong> 13 years of age';
$lang['Agree_not'] = 'I do not agree to these terms';

$lang['Wrong_activation'] = 'The activation key you supplied does not match any in the database.';
$lang['Send_password'] = 'Send me a new password';
$lang['Password_updated'] = 'A new password has been created; please check your e-mail for details on how to activate it.';
$lang['No_email_match'] = 'The e-mail address you supplied does not match the one listed for that username.';
$lang['New_password_activation'] = 'New password activation';
$lang['Password_activated'] = 'Your account has been re-activated. To log in, please use the password supplied in the e-mail you received.';

$lang['Email_sent'] = 'The e-mail has been sent.';
// $lang['Send_email'] = 'Send e-mail';
$lang['Send_email'] = 'Send %s an email.';
$lang['Send_email_msg'] = 'Send an email message';
$lang['No_user_specified'] = 'No user was specified';
$lang['User_prevent_email'] = 'This user does not wish to receive e-mail. Try sending them a private message.';
$lang['User_not_exist'] = 'That user does not exist';
$lang['CC_email'] = 'Send a copy of this e-mail to yourself';
$lang['Email_message_desc'] = 'This message will be sent as plain text, so do not include any HTML or BBCode. The return address for this message will be set to your e-mail address.';
$lang['Flood_email_limit'] = 'You cannot send another e-mail at this time. Try again later.';
$lang['Recipient'] = 'Recipient';
$lang['Empty_subject_email'] = 'You must specify a subject for the e-mail.';
$lang['Empty_message_email'] = 'You must enter a message to be e-mailed.';

$lang['Login_attempts_exceeded'] = 'The maximum number of %s login attempts has been exceeded. You are not allowed to login for the next %s minutes.';
$lang['Please_remove_install_contrib'] = 'Please ensure both the install/ and contrib/ directories are deleted';
$lang['Session_invalid'] = 'Invalid Session. Please resubmit the form.';

//
// Visual confirmation system strings
//
$lang['Confirm_code_wrong'] = 'The confirmation code you entered was incorrect';
$lang['Too_many_registers'] = 'You have exceeded the number of registration attempts for this session. Please try again later.';
$lang['Confirm_code_impaired'] = 'If you are visually impaired or cannot otherwise read this code please contact the %sAdministrator%s for help.';
$lang['Confirm_code'] = 'Confirmation code';
$lang['Confirm_code_explain'] = 'Enter the code exactly as you see it. The code is case sensitive and zero has a diagonal line through it.';

//
// Memberslist
//
$lang['Select_sort_method'] = 'Sort by';
$lang['Sort'] = 'Sort';
$lang['Sort_Top_Ten'] = 'Top10 Posters';
$lang['Sort_Joined'] = 'Joined Date';
$lang['Sort_Username'] = 'Username';
$lang['Sort_User_ID'] = 'User ID';
$lang['Sort_Location'] = 'Location';
$lang['Sort_Posts'] = 'Total posts';
$lang['Sort_Email'] = 'Email';
$lang['Sort_Website'] = 'Website';
$lang['Sort_Ascending'] = 'Ascending';
$lang['Sort_Descending'] = 'Descending';
$lang['Order'] = 'Order';

//
// Group control panel
//
$lang['Group_Control_Panel'] = 'Group Control Panel';
$lang['Group_member_details'] = 'Group Membership Details';
$lang['Group_member_join'] = 'Join a Group';

$lang['Group_Information'] = 'Group Information';
$lang['Group_name'] = 'Group name';
$lang['Group_description'] = 'Group description';
$lang['Group_membership'] = 'Group membership';
$lang['Group_Members'] = 'Group Members';
$lang['Group_Moderator'] = 'Group Moderator';
$lang['Pending_members'] = 'Pending Members';

$lang['Group_type'] = 'Group type';
$lang['Group_open'] = 'Open group';
$lang['Group_closed'] = 'Closed group';
$lang['Group_hidden'] = 'Hidden group';

$lang['Current_memberships'] = 'Current memberships';
$lang['Non_member_groups'] = 'Non-member groups';
$lang['Memberships_pending'] = 'Memberships pending';

$lang['No_groups_exist'] = 'No Groups Exist';
$lang['Group_not_exist'] = 'That user group does not exist';

$lang['Join_group'] = 'Join Group';
$lang['No_group_members'] = 'This group has no members';
$lang['Group_hidden_members'] = 'This group is hidden; you cannot view its membership';
$lang['No_pending_group_members'] = 'This group has no pending members';
$lang['Group_joined'] = 'You have successfully subscribed to this group.<br />You will be notified when your subscription is approved by the group moderator.';
$lang['Group_request'] = 'A request to join your group has been made.';
$lang['Group_approved'] = 'Your request has been approved.';
$lang['Group_added'] = 'You have been added to this usergroup.';
$lang['Already_member_group'] = 'You are already a member of this group';
$lang['User_is_member_group'] = 'User is already a member of this group';
$lang['Group_type_updated'] = 'Successfully updated group type.';

$lang['Could_not_add_user'] = 'The user you selected does not exist.';
$lang['Could_not_anon_user'] = 'You cannot make Anonymous a group member.';

$lang['Confirm_unsub'] = 'Are you sure you want to unsubscribe from this group?';
$lang['Confirm_unsub_pending'] = 'Your subscription to this group has not yet been approved; are you sure you want to unsubscribe?';

$lang['Unsub_success'] = 'You have been un-subscribed from this group.';

$lang['Approve_selected'] = 'Approve Selected';
$lang['Deny_selected'] = 'Deny Selected';
$lang['Not_logged_in'] = 'You must be logged in to join a group.';
$lang['Remove_selected'] = 'Remove Selected';
$lang['Add_member'] = 'Add Member';
$lang['Not_group_moderator'] = 'You are not this group\'s moderator, therefore you cannot perform that action.';

$lang['Login_to_join'] = 'Log in to join or manage group memberships';
$lang['This_open_group'] = '';
/*****[BEGIN]******************************************
 [ Mod:    Auto Group                          v1.2.2 ]
 ******************************************************/
//$lang['This_closed_group'] = 'This is a closed group: no more users accepted';
//$lang['This_hidden_group'] = 'This is a hidden group: automatic user addition is not allowed';
$lang['This_closed_group'] = 'This is a closed group: %s';
$lang['This_hidden_group'] = 'This is a hidden group: %s';
$lang['No_more'] = 'no more users accepted';
$lang['No_add_allowed'] = 'automatic user addition is not allowed';
$lang['Join_auto'] = 'You may join this group, since your post count meet the group criteria';
/*****[END]********************************************
 [ Mod:    Auto Group                          v1.2.2 ]
 ******************************************************/
$lang['Member_this_group'] = 'You are a member of this group';
$lang['Pending_this_group'] = 'Your membership of this group is pending';
$lang['Are_group_moderator'] = 'You are the group moderator';
$lang['None'] = 'None';

$lang['Subscribe'] = 'Subscribe';
$lang['Unsubscribe'] = 'Unsubscribe';
$lang['View_Information'] = 'View Information';

//
// Search
//
$lang['Search_query'] = 'Search Query';
$lang['Search_options'] = 'Search Options';

$lang['Search_keywords'] = 'Search for Keywords';
$lang['Search_keywords_explain'] = 'You can use <u>AND</u> to define words which must be in the results, <u>OR</u> to define words which may be in the result and <u>NOT</u> to define words which should not be in the result. Use * as a wildcard for partial matches';
$lang['Search_author'] = 'Search for Author';
$lang['Search_author_explain'] = 'Use * as a wildcard for partial matches';

$lang['Search_for_any'] = 'Search for any terms or use query as entered';
$lang['Search_for_all'] = 'Search for all terms';
$lang['Search_title_msg'] = 'Search topic title and message text';
$lang['Search_msg_only'] = 'Search message text only';

$lang['Return_first'] = 'Return first'; // followed by xxx characters in a select box
$lang['characters_posts'] = 'characters of posts';

$lang['Search_previous'] = 'Search previous'; // followed by days, weeks, months, year, all in a select box

$lang['Sort_by'] = 'Sort by';
$lang['Sort_Time'] = 'Post Time';
$lang['Sort_Post_Subject'] = 'Post Subject';
$lang['Sort_Topic_Title'] = 'Topic Title';
$lang['Sort_Author'] = 'Author';
$lang['Sort_Forum'] = 'Forum';

$lang['Display_results'] = 'Display results as';
$lang['All_available'] = 'All available';
$lang['not_available'] = 'Not available';
$lang['No_searchable_forums'] = 'You do not have permissions to search any forum on this site.';

$lang['No_search_match'] = 'No topics or posts met your search criteria';
$lang['Found_search_match'] = 'Search found %d match'; // eg. Search found 1 match
$lang['Found_search_matches'] = 'Search found %d matches'; // eg. Search found 24 matches
$lang['Search_Flood_Error'] = 'You cannot make another search so soon after your last; please try again in a short while.';

$lang['Close_window'] = 'Close Window';

//
// Auth related entries
//
// Note the %s will be replaced with one of the following 'user' arrays
$lang['Sorry_auth_announce'] = 'Sorry, but only %s can post announcements in this forum.';
$lang['Sorry_auth_sticky'] = 'Sorry, but only %s can post sticky messages in this forum.';
$lang['Sorry_auth_read'] = 'Sorry, but only %s can read topics in this forum.';
$lang['Sorry_auth_post'] = 'Sorry, but only %s can post topics in this forum.';
$lang['Sorry_auth_reply'] = 'Sorry, but only %s can reply to posts in this forum.';
$lang['Sorry_auth_edit'] = 'Sorry, but only %s can edit posts in this forum.';
$lang['Sorry_auth_delete'] = 'Sorry, but only %s can delete posts in this forum.';
$lang['Sorry_auth_vote'] = 'Sorry, but only %s can vote in polls in this forum.';

// These replace the %s in the above strings
$lang['Auth_Anonymous_Users'] = '<strong>anonymous users</strong>';
$lang['Auth_Registered_Users'] = '<strong>registered users</strong>';
$lang['Auth_Users_granted_access'] = '<strong>users granted special access</strong>';
$lang['Auth_Moderators'] = '<strong>moderators</strong>';
$lang['Auth_Administrators'] = '<strong>administrators</strong>';

$lang['Not_Moderator'] = 'You are not a moderator of this forum.';
$lang['Not_Authorised'] = 'Not Authorised';

$lang['You_been_banned'] = 'You have been banned from this forum.<br />Please contact the webmaster or board administrator for more information.';

//
// Viewonline
//
$lang['Reg_users_zero_online'] = 'There are 0 Registered users and '; // There are 5 Registered and
$lang['Reg_users_online'] = 'There are %d Registered users and '; // There are 5 Registered and
$lang['Reg_user_online'] = 'There is %d Registered user and '; // There is 1 Registered and
$lang['Hidden_users_zero_online'] = '0 Hidden users online'; // 6 Hidden users online
$lang['Hidden_users_online'] = '%d Hidden users online'; // 6 Hidden users online
$lang['Hidden_user_online'] = '%d Hidden user online'; // 6 Hidden users online
$lang['Guest_users_online'] = 'There are %d Guest users online'; // There are 10 Guest users online
$lang['Guest_users_zero_online'] = 'There are 0 Guest users online'; // There are 10 Guest users online
$lang['Guest_user_online'] = 'There is %d Guest user online'; // There is 1 Guest user online
$lang['No_users_browsing'] = 'There are no users currently browsing this forum';

/*****[BEGIN]******************************************
 [ Mod:    Online Time                         v1.0.0 ]
 ******************************************************/
$lang['Online_explain'] = 'Based on users active over the past ' . ( ($board_config['online_time']/60)%60 ) . ' minutes';
/*****[END]********************************************
 [ Mod:    Online Time                         v1.0.0 ]
 ******************************************************/

$lang['Forum_Location'] = 'Forum Location';
$lang['Last_updated'] = 'Last Updated';
$lang['Group_List_Info'] = 'Group Information';
$lang['Group_List_Title'] = '<h1>Available Member Groups</h1>';
$lang['Forum_index'] = 'Forum index';
$lang['Logging_on'] = 'Logging on';
$lang['Posting_message'] = 'Posting a message';
$lang['Searching_forums'] = 'Searching forums';
$lang['Viewing_profile'] = 'Viewing profile';
$lang['Viewing_online'] = 'Viewing who is online';
$lang['Viewing_member_list'] = 'Viewing member list';
$lang['Viewing_priv_msgs'] = 'Viewing Private Messages';
$lang['Viewing_FAQ'] = 'Viewing FAQ';

//
// Moderator Control Panel
//
$lang['Mod_CP'] = 'Moderator Control Panel';
$lang['Mod_CP_explain'] = 'Using the form below you can perform mass moderation operations on this forum. You can lock, unlock, move, delete or prioritise any number of topics.';

$lang['Select'] = 'Select';
$lang['Delete'] = 'Delete';
$lang['Move'] = 'Move';
$lang['Lock'] = 'Lock';
$lang['Unlock'] = 'Unlock';

$lang['Topics_Removed'] = 'The selected topics have been successfully removed from the database.';
$lang['Topics_Locked'] = 'The selected topics have been locked.';
$lang['Topics_Moved'] = 'The selected topics have been moved.';
$lang['Topics_Unlocked'] = 'The selected topics have been unlocked.';
$lang['No_Topics_Moved'] = 'No topics were moved.';
/*****[BEGIN]******************************************
 [ Mod:    Topic Cement                        v1.0.3 ]
 ******************************************************/
$lang['Topics_Prioritized'] = 'The selected topics have been prioritized.';
$lang['Priority'] = 'Priority';
$lang['Prioritize'] = 'Prioritize';
/*****[END]********************************************
 [ Mod:    Topic Cement                        v1.0.3 ]
 ******************************************************/

$lang['Confirm_delete_topic'] = 'Are you sure you want to remove the selected topic/s?';
$lang['Confirm_lock_topic'] = 'Are you sure you want to lock the selected topic/s?';
$lang['Confirm_unlock_topic'] = 'Are you sure you want to unlock the selected topic/s?';
$lang['Confirm_move_topic'] = 'Are you sure you want to move the selected topic/s?';

$lang['Move_to_forum'] = 'Move to forum';
$lang['Leave_shadow_topic'] = 'Leave shadow topic in old forum.';

$lang['Split_Topic'] = 'Split Topic Control Panel';
$lang['Split_Topic_explain'] = 'Using the form below you can split a topic in two, either by selecting the posts individually or by splitting at a selected post';
$lang['Split_title'] = 'New topic title';
$lang['Split_forum'] = 'Forum for new topic';
$lang['Split_posts'] = 'Split selected posts';
$lang['Split_after'] = 'Split from selected post';
$lang['Topic_split'] = 'The selected topic has been split successfully';

$lang['Too_many_error'] = 'You have selected too many posts. You can only select one post to split a topic after!';

$lang['None_selected'] = 'You have not selected any topics to perform this operation on. Please go back and select at least one.';
$lang['New_forum'] = 'New forum';

$lang['This_posts_IP'] = 'IP address for this post';
$lang['Other_IP_this_user'] = 'Other IP addresses this user has posted from';
$lang['Users_this_IP'] = 'Users posting from this IP address';
$lang['IP_info'] = 'IP Information';
$lang['Lookup_IP'] = 'Look up IP address';

//
// Timezones ... for display on each page
//
$lang['All_times'] = 'All times are %s'; // eg. All times are GMT - 12 Hours (times from next block)

$lang['-12'] = 'GMT - 12 Hours';
$lang['-11'] = 'GMT - 11 Hours';
$lang['-10'] = 'GMT - 10 Hours';
$lang['-9'] = 'GMT - 9 Hours';
$lang['-8'] = 'GMT - 8 Hours';
$lang['-7'] = 'GMT - 7 Hours';
$lang['-6'] = 'GMT - 6 Hours';
$lang['-5'] = 'GMT - 5 Hours';
$lang['-4'] = 'GMT - 4 Hours';
$lang['-3.5'] = 'GMT - 3.5 Hours';
$lang['-3'] = 'GMT - 3 Hours';
$lang['-2'] = 'GMT - 2 Hours';
$lang['-1'] = 'GMT - 1 Hours';
$lang['0'] = 'GMT';
$lang['1'] = 'GMT + 1 Hour';
$lang['2'] = 'GMT + 2 Hours';
$lang['3'] = 'GMT + 3 Hours';
$lang['3.5'] = 'GMT + 3.5 Hours';
$lang['4'] = 'GMT + 4 Hours';
$lang['4.5'] = 'GMT + 4.5 Hours';
$lang['5'] = 'GMT + 5 Hours';
$lang['5.5'] = 'GMT + 5.5 Hours';
$lang['6'] = 'GMT + 6 Hours';
$lang['6.5'] = 'GMT + 6.5 Hours';
$lang['7'] = 'GMT + 7 Hours';
$lang['8'] = 'GMT + 8 Hours';
$lang['9'] = 'GMT + 9 Hours';
$lang['9.5'] = 'GMT + 9.5 Hours';
$lang['10'] = 'GMT + 10 Hours';
$lang['11'] = 'GMT + 11 Hours';
$lang['12'] = 'GMT + 12 Hours';
$lang['13'] = 'GMT + 13 Hours';

// These are displayed in the timezone select box
$lang['tz']['-12'] = 'GMT - 12 Hours';
$lang['tz']['-11'] = 'GMT - 11 Hours';
$lang['tz']['-10'] = 'GMT - 10 Hours';
$lang['tz']['-9'] = 'GMT - 9 Hours';
$lang['tz']['-8'] = 'GMT - 8 Hours';
$lang['tz']['-7'] = 'GMT - 7 Hours';
$lang['tz']['-6'] = 'GMT - 6 Hours';
$lang['tz']['-5'] = 'GMT - 5 Hours';
$lang['tz']['-4'] = 'GMT - 4 Hours';
$lang['tz']['-3.5'] = 'GMT - 3.5 Hours';
$lang['tz']['-3'] = 'GMT - 3 Hours';
$lang['tz']['-2'] = 'GMT - 2 Hours';
$lang['tz']['-1'] = 'GMT - 1 Hours';
$lang['tz']['0'] = 'GMT';
$lang['tz']['1'] = 'GMT + 1 Hour';
$lang['tz']['2'] = 'GMT + 2 Hours';
$lang['tz']['3'] = 'GMT + 3 Hours';
$lang['tz']['3.5'] = 'GMT + 3.5 Hours';
$lang['tz']['4'] = 'GMT + 4 Hours';
$lang['tz']['4.5'] = 'GMT + 4.5 Hours';
$lang['tz']['5'] = 'GMT + 5 Hours';
$lang['tz']['5.5'] = 'GMT + 5.5 Hours';
$lang['tz']['6'] = 'GMT + 6 Hours';
$lang['tz']['6.5'] = 'GMT + 6.5 Hours';
$lang['tz']['7'] = 'GMT + 7 Hours';
$lang['tz']['8'] = 'GMT + 8 Hours';
$lang['tz']['9'] = 'GMT + 9 Hours';
$lang['tz']['9.5'] = 'GMT + 9.5 Hours';
$lang['tz']['10'] = 'GMT + 10 Hours';
$lang['tz']['11'] = 'GMT + 11 Hours';
$lang['tz']['12'] = 'GMT + 12 Hours';
$lang['tz']['13'] = 'GMT + 13 Hours';

$lang['datetime']['Sunday'] = 'Sunday';
$lang['datetime']['Monday'] = 'Monday';
$lang['datetime']['Tuesday'] = 'Tuesday';
$lang['datetime']['Wednesday'] = 'Wednesday';
$lang['datetime']['Thursday'] = 'Thursday';
$lang['datetime']['Friday'] = 'Friday';
$lang['datetime']['Saturday'] = 'Saturday';
$lang['datetime']['Sun'] = 'Sun';
$lang['datetime']['Mon'] = 'Mon';
$lang['datetime']['Tue'] = 'Tue';
$lang['datetime']['Wed'] = 'Wed';
$lang['datetime']['Thu'] = 'Thu';
$lang['datetime']['Fri'] = 'Fri';
$lang['datetime']['Sat'] = 'Sat';
$lang['datetime']['January'] = 'January';
$lang['datetime']['February'] = 'February';
$lang['datetime']['March'] = 'March';
$lang['datetime']['April'] = 'April';
$lang['datetime']['May'] = 'May';
$lang['datetime']['June'] = 'June';
$lang['datetime']['July'] = 'July';
$lang['datetime']['August'] = 'August';
$lang['datetime']['September'] = 'September';
$lang['datetime']['October'] = 'October';
$lang['datetime']['November'] = 'November';
$lang['datetime']['December'] = 'December';
$lang['datetime']['Jan'] = 'Jan';
$lang['datetime']['Feb'] = 'Feb';
$lang['datetime']['Mar'] = 'Mar';
$lang['datetime']['Apr'] = 'Apr';
$lang['datetime']['May'] = 'May';
$lang['datetime']['Jun'] = 'Jun';
$lang['datetime']['Jul'] = 'Jul';
$lang['datetime']['Aug'] = 'Aug';
$lang['datetime']['Sep'] = 'Sep';
$lang['datetime']['Oct'] = 'Oct';
$lang['datetime']['Nov'] = 'Nov';
$lang['datetime']['Dec'] = 'Dec';

//
// Errors (not related to a
// specific failure on a page)
//
$lang['Information'] = 'Information';
$lang['Critical_Information'] = 'Critical Information';

$lang['General_Error'] = 'General Error';
$lang['Critical_Error'] = 'Critical Error';
$lang['An_error_occured'] = 'An Error Occurred';
$lang['A_critical_error'] = 'A Critical Error Occurred';
/*****[BEGIN]******************************************
 [ Mod:     Super Quick Reply                  v1.3.2 ]
 ******************************************************/
$lang['Quick_reply_panel'] = 'Super Quick Reply Mod';
$lang['Quick_Reply'] = 'Quick Reply';
$lang['Show_quick_reply'] = 'Show Quick Reply Form';
$lang['sqr']['0'] = 'No';
$lang['sqr']['1'] = 'Yes';
$lang['sqr']['2'] = 'On last page only';
$lang['Quick_reply_mode'] = 'Quick Reply Mode';
$lang['Quick_reply_mode_basic'] = 'Basic';
$lang['Quick_reply_mode_advanced'] = 'Advanced';
$lang['Show_hide_quick_reply_form'] = 'Show/hide quick reply form';
$lang['Open_quick_reply'] = 'Open Quick Reply Form automatically';
/*****[END]********************************************
 [ Mod:     Super Quick Reply                  v1.3.2 ]
 ******************************************************/

$lang['Admin_reauthenticate'] = 'To administer the board you must re-authenticate yourself.';

/*****[BEGIN]******************************************
 [ Base:    Recent Topics                      v1.2.4 ]
 ******************************************************/
$lang['Recent_topics'] = '<strong>Recent Topics</strong>';
$lang['Recent_today'] = 'Today';
$lang['Recent_yesterday'] = 'Yesterday';
$lang['Recent_last24'] = 'Last 24 Hours';
$lang['Recent_lastweek'] = 'Last Week';
$lang['Recent_lastXdays'] = 'Last %s days';
$lang['Recent_last'] = 'Last';
$lang['Recent_days'] = 'Days';
$lang['Recent_first'] = 'started at %s';
$lang['Recent_first_poster'] = ' by %s';
$lang['Recent_started_by'] = 'Started by %s';
$lang['Recent_select_mode'] = 'Select mode:';
$lang['Recent_showing_posts'] = 'Showing Posts:';
$lang['Recent_title_one'] = '<font size=4>%s</font> topic %s'; // %s = topics; %s = sort method
$lang['Recent_title_more'] = '<font size=4>%s</font> topics %s'; // %s = topics; %s = sort method
$lang['Recent_title_today'] = ' from today';
$lang['Recent_title_yesterday'] = ' from yesterday';
$lang['Recent_title_last24'] = ' from the last 24 hours';
$lang['Recent_title_lastweek'] = ' from the last week';
$lang['Recent_title_lastXdays'] = ' from the last %s days'; // %s = days
$lang['Recent_no_topics'] = 'No topics were found.';
$lang['Recent_wrong_mode'] = 'You have selected a wrong mode.';
$lang['Recent_click_return'] = 'Click %shere%s to return to recent site.';
/*****[END]********************************************
 [ Base:    Recent Topics                      v1.2.4 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Global Announcements               v1.2.8 ]
 ******************************************************/
$lang['Topic_global_announcement']='<strong>Global Announcement:</strong>';
$lang['Post_global_announcement'] = 'Global Announcement';
/*****[END]********************************************
 [ Mod:     Global Announcements               v1.2.8 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Select Expand BBcodes              v1.2.8 ]
 ******************************************************/
$lang['Select'] = 'Select';
$lang['Expand'] = 'Expand';
$lang['Contract'] = 'Contract';
/*****[END]********************************************
 [ Mod:     Select Expand BBcodes              v1.2.8 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Base:    Cache phpBB version in ACP         v1.0.0 ]
 ******************************************************/
$lang['Version_check'] = 'Check for newest version';
/*****[END]********************************************
 [ Base:    Cache phpBB version in ACP         v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Search Only Subject                 v0.9.1 ]
 ******************************************************/
$lang['Search_subject_only'] = 'Search message subject only';
/*****[END]********************************************
 [ Mod:    Search Only Subject                 v0.9.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     View/Disable Avatars/Signatures    v1.1.2 ]
 ******************************************************/
$lang['Show_avatars'] = 'Show Avatars in Topic';
$lang['Show_signatures'] = 'Show Signatures in Topic';
/*****[END]********************************************
 [ Mod:     View/Disable Avatars/Signatures    v1.1.2 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Quick Search                    v2.1.1 RC ]
 ******************************************************/
$lang['Quick_search_for'] = 'Search for';
$lang['Quick_search_at'] = 'at';
// In this case, the %s displays the Site Name as defined in the ACP. e.g. phpBB.com Advanced Search
$lang['Forum_advanced_search'] = '%s Advanced Search';
/*****[END]********************************************
 [ Mod:     Quick Search                    v2.1.1 RC ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Signature Editor/Preview Deluxe    v1.0.0 ]
 ******************************************************/
$lang['sig_description'] = 'Edit Signature (<strong>Preview included</strong>)';
$lang['sig_edit'] = 'Edit Signature';
$lang['sig_current'] = 'Current Signature';
$lang['sig_none'] = 'No Signature available';
$lang['sig_save'] = 'Save';
$lang['sig_save_message'] = 'Signature saved successful !';
/*****[END]********************************************
 [ Mod:     Signature Editor/Preview Deluxe    v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Separate Announcements & Sticky   v2.0.0a ]
 ******************************************************/
$lang['Global_Announcements'] = 'Global Announcements';
$lang['Announcements'] = 'Announcements';
$lang['Sticky_Topics'] = 'Sticky Topics';
/*****[END]********************************************
 [ Mod:     Separate Announcements & Sticky   v2.0.0a ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Staff Site                         v2.0.3 ]
 ******************************************************/
$lang['Staff'] = 'Staff';
$lang['Forums'] = 'Forums';
$lang['Mod'] = 'Moderator';
$lang['Admin'] = 'Administrator';
$lang['Super'] = 'Super Moderator';
$lang['Junior'] = 'Junior Admin';
$lang['Period'] = 'since <strong>%d</strong> days'; // %d = days
$lang['Messenger'] = 'Messenger';
/*****[END]********************************************
 [ Mod:     Staff Site                         v2.0.3 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Better Session Handling             v1.0.0 ]
 ******************************************************/
$lang['BSH_Viewing_Topic'] = 'Viewing Topic: %t%';
$lang['BSH_Viewing_Post'] = '%sViewing A Post%s';
$lang['BSH_Viewing_Profile'] = 'Viewing %u%\'s Profile';
$lang['BSH_Viewing_Groups'] = '%sViewing Groups%s';
$lang['BSH_Viewing_Forums'] = 'Viewing Forum: %f%';
$lang['BSH_Index'] = '%sViewing Index%s';
$lang['BSH_Searching_Forums'] = '%sSearching Forums%s';
$lang['BSH_Viewing_Onlinelist'] = '%sViewing Online List%s';
$lang['BSH_Viewing_Messages'] = '%sViewing Private Messages%s';
$lang['BSH_Viewing_Memberlist'] = '%sViewing Memberlist%s';
$lang['BSH_Login'] = '%sLogging In%s';
$lang['BSH_Logout'] = '%sLogging Out%s';
$lang['BSH_Editing_Profile'] = '%sEditing Profile%s';
$lang['BSH_Viewing_ACP'] = '%sViewing ACP%s';
$lang['BSH_Moderating_Forum'] = '%sModerating Forums%s';
$lang['BSH_Viewing_FAQ'] = '%sViewing FAQ%s';
$lang['BSH_Viewing_Category'] = 'Viewing Category: %c%';

#==== Start: Language Integrations
$lang['BSH_Viewing_Tree'] = '%sViewing Forum Tree%s';
$lang['BSH_Viewing_Spiders'] = '%sViewing Search Spiders Log%s';
$lang['BSH_Viewing_BACP'] = '%sViewing Blend ACP%s';
#==== End: Language Integrations
/*****[END]********************************************
 [ Mod:    Better Session Handling             v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Disable Board Admin Override        v0.1.1 ]
 ******************************************************/
$lang['Board_Currently_Disabled'] = 'Board is currently disabled';
/*****[END]********************************************
 [ Mod:    Disable Board Admin Override        v0.1.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Memberlist Find User                v1.0.0 ]
 ******************************************************/
$lang['Look_up_User'] = 'Look up User';
/*****[END]********************************************
 [ Mod:    Memberlist Find User                v1.0.0 ] 
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Theme Simplifications              v1.0.0 ]
 ******************************************************/
$lang['Mini_Index'] = 'Forum Index';
$lang['Rules'] = 'Board Rules';
$lang['Login_Logout'] = 'Login / Logout';
/*****[END]********************************************
 [ Mod:     Theme Simplifications              v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Welcome PM                         v2.0.0 ]
 ******************************************************/
$lang['Welcome_PM'] = 'Set as the Welcome PM';
$lang['Welcome_PM_Set'] = 'Your Welcome PM has been set';
$lang['Welcome_PM_Admin'] = 'Welcome PM';
/*****[END]********************************************
 [ Mod:     Welcome PM                         v2.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Limit smilies per post             v1.0.2 ]
 ******************************************************/
$lang['Max_smilies_per_post'] = 'You can only use maximum %s smilies per post.<br />You have %s smilies too much in use.';
/*****[END]********************************************
 [ Mod:     Limit smilies per post             v1.0.2 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     YA Merge                           v1.0.0 ]
 ******************************************************/
 $lang['Real_Name'] = 'Real Name';
 $lang['Newsletter'] = 'Receive Newsletter by Email?';
 $lang['Extra_Info'] = 'Extra Info';
 $lang['Error_Check_Num'] = "Invalid check number<br /><br />You will need to register again<br /><br />Click <a href=\"%s\">here</a> to register";
/*****[END]********************************************
 [ Mod:     YA Merge                           v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Log Moderator Actions              v1.1.6 ]
 ******************************************************/
$lang['Move_merge_message'] = 'Merged: <strong>%s</strong> by <strong>%s</strong><br />From Topic <strong>%s</strong> (<strong>%s</strong>)';
$lang['Move_move_message'] = 'Moved: <strong>%s</strong> by <strong>%s</strong><br />From <strong>%s</strong> to <strong>%s</strong>';
$lang['Move_lock_message'] = 'Locked: <strong>%s</strong> by <strong>%s</strong>';
$lang['Move_edit_message'] = 'Edited: <strong>%s</strong> by <strong>%s</strong>';
$lang['Move_unlock_message'] = 'Unlocked: <strong>%s</strong> by <strong>%s</strong>';
$lang['Move_split_message'] = 'Splitted: <strong>%s</strong> by <strong>%s</strong><br />From Topic <strong>%s</strong> (<strong>%s</strong>)';
$lang['Close_window'] = 'Close the window';
$lang['Rules_title'] = 'Action : %s';
$lang['Locking_topic'] = 'Locking a topic';
$lang['Unlocking_topic'] = 'Unlocking a topic';
$lang['Spliting_topic'] = 'Splitting a topic';
$lang['Moving_topic'] = 'Moving a topic';
$lang['Deleting_topic'] = 'Deleting a topic';
$lang['Editing_topic'] = 'Editing a topic';
$lang['Lock_Explication'] = 'When a Moderator/Administrator locks a topic, it\'s not possible for a normal user to reply. But Moderators/Administrators can still continue to post.';
$lang['Unlock_Explication'] = 'A Moderator/Administrator can unlock a topic which has been locked. This will allow all users to continue to post in the thread.';
$lang['Split_Explication'] = 'Splitting a topic which has a lot of pages gives you the ability to keep your topics more organized.';
$lang['Move_Explication'] = 'If you choose to move a topic, you will be able to send the topic, which is in a forum A, to a forum B. You can also choose to leave a Shadow Topic in the forum A.';
$lang['Delete_Explication'] = 'If a Moderator/Administrator deletes a topic, it will no longer be displayed on the forum and nobody will be able to restore it. <br /><strong>Be careful with this function</strong>';
$lang['Edit_Explication'] = 'By editing a post, an Administrator and/or a Moderator can change what a user has written in the post.';
$lang['No_action_specified'] = 'There is no action specified';
/*****[END]********************************************
 [ Mod:     Log Moderator Actions              v1.1.6 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/
$lang['true'] = 'True';
$lang['false'] = 'False';

$lang['XData_too_long'] = 'Your %s is too long.';
$lang['XData_invalid'] = 'The value you entered for %s is invalid.';

$lang['XData_error_obtaining_userdata'] = 'Error while finding  a user\'s XData field to edit it';
$lang['XData_failure_removing_data'] = 'Failure to remove specefied data';
$lang['XData_failure_inserting_data'] = 'Failure to add specefied data';
$lang['XData_error_obtaining_user_xdata'] = 'Error obtaining user\'s XData';
$lang['XData_failure_obtaining_field_data'] = 'Error obtaining field data';
$lang['XData_failure_obtaining_field_auth'] = 'Error obtaining field auths';
$lang['XData_failure_obtaining_user_auth'] = 'Error obtaining auth for user';
$lang['XData_error_obtaining_usergroup'] = 'Error obtaining usergroup';
$lang['XData_error_obtaining_group_data'] = 'Error obtaining group data';
$lang['XData_error_updating_auth'] = 'Error updating auth table';
$lang['XData_error_updating_fields'] = 'Error updating field table';
$lang['XData_success_updating_permissions'] = "Permissions updated successfully <br /><br /> Click %shere%s to return to Field Permissions <br /><br />";
$lang['XData_error_obtaining_new_field_info'] = 'Could not get field_order and field_id for new field.';

$lang['XData_no_field_selected'] = 'You have not selected a field';
$lang['XData_field_non_existant'] = 'Field does not exist';
$lang['XData_unable_to_switch_fields'] = 'Unable to switch fields';
/*****[END]********************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     At a Glance Options                v1.0.0 ]
 ******************************************************/
$lang['show_glance_option']['1']    = 'All';
$lang['show_glance_option']['0']    = 'None';
$lang['show_glance_option']['2']    = 'Index Only';
$lang['show_glance_option']['3']    = 'Forums Only';
$lang['show_glance_option']['4']    = 'Topics Only';
$lang['show_glance_option']['5']    = 'Index and Topics';
$lang['show_glance_option']['6']    = 'Index and Forums';
$lang['show_glance_option']['7']    = 'Forums and Topics';
$lang['glance_show']                = 'Show At a Glance (Recent Topics)<br />';

$lang['glance_alternate_row']       = 'Alternate Glance Row Class';
$lang['glance_alternate_row_explain'] = 'Will alternate between row1 & row3 pre-defined colors in the theme CSS.';

/*****[END]********************************************
 [ Mod:     At a Glance Options                v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Extended Quote Tag                 v1.0.0 ]
 ******************************************************/
$lang['View_post'] = 'View Post';
$lang['Post_review'] = 'Post Review';
$lang['View_next_post'] = 'View next Post';
$lang['View_previous_post'] = 'View previous Post';
$lang['No_newer_posts'] = 'There are no newer posts in this forum';
$lang['No_older_posts'] = 'There are no older posts in this forum';
/*****[END]********************************************
 [ Mod:     Extended Quote Tag                 v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     At a Glance Cement                 v1.0.0 ]
 ******************************************************/
$lang['topic_glance_priority'] = 'Cement this topic on the Recent Topics Display';
/*****[END]********************************************
 [ Mod:     At a Glance Cement                 v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Online/Offline/Hidden              v2.2.7 ]
 ******************************************************/
$lang['Online'] = 'Online';
$lang['Offline'] = 'Offline';
$lang['Hidden'] = 'Hidden';
$lang['GhostMode'] = 'Ghost Mode<br/>Your profile is currently invisible!';
$lang['is_online'] = '%s is online now';
$lang['is_offline'] = '%s is offline';
$lang['is_hidden'] = '%s is hidden';
$lang['Online_status'] = 'Currently';
$lang['Current_status'] = 'Currently Online';
/*****[END]********************************************
 [ Mod:     Online/Offline/Hidden              v2.2.7 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Hide Images and Links              v1.0.0 ]
 ******************************************************/
$lang['Images_Allowed_For_Registered_Only'] = 'Please login to see this image.';
$lang['Links_Allowed_For_Registered_Only'] = 'Please login to see this link';
$lang['Emails_Allowed_For_Registered_Only'] = 'Please login to see this email';
$lang['Get_Registered'] = 'Get %sregistered%s or ';
$lang['Image_Blocked'] = 'You have chosen to block images.<br />%sEdit Your Profile%s';
$lang['Enter_Forum'] = '%senter%s the forums!';
/*****[END]********************************************
 [ Mod:     Hide Images and Links              v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Report Posts                       v1.2.3 ]
 ******************************************************/
$lang['Post_reports_none_cp'] = 'There aren\'t any open Reported Posts';
$lang['Post_reports_one_cp'] = 'There is %s open Reported Post';
$lang['Post_reports_many_cp'] = 'There are %s open Reported Posts';

$lang['All'] = 'All';
$lang['Display'] = 'Display only';
$lang['Report_post'] = 'Report Post';

$lang['Reporter'] = 'Reporter';
$lang['Status'] = 'Status';
$lang['Select_one'] = 'Select One';

$lang['Opt_in'] = 'Opt in to receive emails when a report is submitted';
$lang['Opt_out'] = 'Opt out so you don\'t receive emails when a report is submitted';

$lang['Post_reported'] = 'Post report submitted successfully.';
$lang['Close_success'] = 'Reports were Opened/Closed successfully.';
$lang['Opt_success'] = 'You have opt out/in successfully.';
$lang['Delete_success'] = 'Reports were deleted successfully.';
$lang['Click_return_reports'] = 'Click %shere%s to return to the Report Posts control panel.';
$lang['Report_email'] = 'Send Email when Post Reported';

$lang['Post_already_reported'] = 'This post has already been reported.';

$lang['Report_not_selected'] = 'You haven\'t selected any reports.';

$lang['Comments'] = 'Comments';
$lang['Last_action_comments'] = 'Comments from Moderators';
$lang['Last_action_comments_explain'] = 'Please write some comments about your action on this specific report';
$lang['Comments_explain'] = 'Please write some comments about your report on this specific post.';

$lang['Action'] = 'Action';
$lang['Report_comment'] = 'Comments regarding your action';
$lang['Previous_comments'] = 'Previous comments';

$lang['Last_action_checkbox'] = 'This action was done through the checkbox and drop down menu.';

$lang['Opened_by_user_on_date'] = 'Opened by %s on %s';
$lang['Closed_by_user_on_date'] = 'Closed by %s on %s';
$lang['Opened'] = 'Open';
$lang['Closed'] = 'Closed';
$lang['Open'] = 'Open';
$lang['Close'] = 'Close';

$lang['Non_existent_posts'] = 'Found and deleted %s leftover report(s) pointing to non-existent (deleted) posts';

$lang['Theme'] = 'Theme';

/*****[END]********************************************
 [ Mod:     Report Posts                       v1.2.3 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Show Groups                        v1.0.1 ]
 ******************************************************/
//$lang['Groups'] = 'Member Of';
/*****[END]********************************************
 [ Mod:     Show Groups                        v1.0.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Hide Images                        v1.0.0 ]
 ******************************************************/
$lang['user_hide_images'] = 'Hide Images in Forums';
/*****[END]********************************************
 [ Mod:     Hide Images                        v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Advanced BBCode Box               v5.0.0a ]
 ******************************************************/
$lang['BBCode_box_hidden'] = 'Hidden';
$lang['BBcode_box_view'] = 'Click to View Content';
$lang['BBcode_box_hide'] = 'Click to Hide Content';
/*****[END]********************************************
 [ Mod:     Advanced BBCode Box               v5.0.0a ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
$lang['Subforums'] = 'Sub Forums';
/*****[END]********************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Member Country Flags               v2.0.7 ]
 ******************************************************/
$lang['Country_Flag'] = "Country Flag";
$lang['Select_Country'] = "SELECT COUNTRY" ;
/*****[END]********************************************
 [ Mod:     Member Country Flags               v2.0.7 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Multiple Ranks And Staff View       v2.0.3 ]
 ******************************************************/
$lang['Staff'] = 'Staff';
$lang['Rank'] = 'Rank';
$lang['Rank_Header'] = 'Ranks';
$lang['Rank_Image'] = 'Rank Image';
$lang['Rank_Posts_Count'] = 'Automatic ranking by posts';
$lang['Rank_Days_Count'] = 'Automatic ranking by days';
$lang['Rank_Min_Des'] = 'Minimum messages/days';
$lang['Rank_Min_M'] = 'Minimum Messages';
$lang['Rank_Max_M'] = 'Max Messages';
$lang['Rank_Min_D'] = 'Minimum Days';
$lang['Rank_Max_D'] = 'Max Days';
$lang['Rank_Special'] = 'Special Rank';
$lang['Rank_Special_Guest'] = 'Special Rank For Guests';
$lang['Rank_Special_Banned'] = 'Special Rank For Banned';
$lang['Current_Rank_Image'] = 'Current rank image';
$lang['No_Rank'] = 'No rank assigned';
$lang['No_Rank_Image'] = 'No rank image';
$lang['No_Rank_Special'] = 'No special rank assigned';
$lang['Memberlist_Administrator'] = 'Administrator';
$lang['Memberlist_Moderator'] = 'Moderator';
$lang['Memberlist_User'] = 'User';
$lang['Guest_User'] = 'Guest';
$lang['Banned_User'] = 'Banned';
$lang['Rank1_title'] = 'Rank 1 Title';
$lang['Rank2_title'] = 'Rank 2 Title';
$lang['Rank3_title'] = 'Rank 3 Title';
$lang['Rank4_title'] = 'Rank 4 Title';
$lang['Rank5_title'] = 'Rank 5 Title';
/*****[END]********************************************
 [ Mod:    Multiple Ranks And Staff View       v2.0.3 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Forumtitle as Weblink               v1.2.2 ]
 ******************************************************/ 
$lang['Forum_link_count'] = 'Link was visited %s times.';
/*****[END]********************************************
 [ Mod:    Forumtitle as Weblink               v1.2.2 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Gender                              v1.2.6 ]
 ******************************************************/
$lang['Gender'] = 'Gender';//used in users profile to display witch gender he/she is 
$lang['Male'] = 'Male'; 
$lang['Female']='Female'; 
$lang['No_gender_specify'] = 'None Specified'; 
/*****[END]********************************************
 [ Mod:    Gender                              v1.2.6 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/
$lang['Birthday_range'] = 'Birthdays must yield ages between %d and %d years, inclusive.';
$lang['No_birthdays'] = 'No birthdays today';
$lang['Congratulations'] = 'Congratulations to: %s';
$lang['Upcoming_birthdays'] = 'Users with a birthday within the next %d days: %s';
$lang['No_upcoming'] = 'No users are having a birthday in the upcoming %d days';
$lang['Birthday'] = 'Date of Birth';
$lang['Month'] = 'Month';
$lang['Day'] = 'Day';
$lang['Year'] = 'Year';
$lang['Clear'] = 'Clear';
$lang['Year_Optional'] = 'Year <i>(Optional)</i>';
$lang['Optional'] = '<i>(Optional)</i>';
$lang['Default_Month'] = '[ Select a Month ]';
$lang['Default_Day'] = 'dd';
$lang['Default_Year'] = 'yyyy';
$lang['Birthday_invalid'] = 'You didn\'t specify a valid Birthday.';
$lang['Todays_Birthdays'] = 'Today\'s Birthdays';
$lang['View_Birthdays'] = 'Happy Birthday!';
$lang['Birthday_Display'] = 'Date of Birth Public Display Options';
$lang['Display_all'] = 'Display everything';
$lang['Display_day_and_month'] = 'Display day and month (but not year)';
$lang['Display_age'] = 'Display age (but not day or month)';
$lang['Display_nothing'] = 'Display nothing';
$lang['Age'] = 'Age: %d<br />';
$lang['Sort_Age'] = 'Age';
$lang['PM'] = 'PM';
$lang['Popup'] = 'Popup';
$lang['bday_send_greeting'] = 'Send Birthday Greetings via';
$lang['bday_send_greeting_user_explain'] = 'Determines how you will recieve Birthday Greetings on your birthday.';
$lang['Do_not_send'] = 'Do not send';
$lang['Birthday_popup'] = '%s would like to wish you a very happy birthday!';
/*****[END]********************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Thank You Mod                       v1.1.8 ]
 ******************************************************/
$lang['thankful'] = 'Thankful People';
$lang['thanks_to'] = 'Thanks';
$lang['thanks_end'] = 'for this post';
$lang['thanks_alt'] = 'Thank Post';
$lang['thanked_before'] = 'You have already thanked this topic';
$lang['thanks_add'] = 'Your thanks has been given';
$lang['thanks_not_logged'] = 'You need to log in to thank someone\'s post';
$lang['thanked'] = 'user(s) is/are thankful for this post.';
$lang['hide'] = 'Hide';
$lang['t_starter'] = 'You cannot thank yourself';
$lang['thank_no_exist'] = 'Forum thank information doesn\'t exists';
/*****[END]********************************************
 [ Mod:    Thank You Mod                       v1.1.8 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    DHTML Collapsible Forum Index MOD     v1.1.1]
 ******************************************************/
$lang['CFI_options'] = "C.F.I.";
$lang['CFI_options_ex'] = "Collapsible Forum Index Options";
$lang['CFI_close'] = "Close";
$lang['CFI_delete'] = "Delete Saved State";
$lang['CFI_restore'] = "Restore Saved State";
$lang['CFI_save'] = "Save State";
$lang['CFI_Expand_all'] = "Expand All";
$lang['CFI_Collapse_all'] = "Collapse All";
/*****[END]********************************************
 [ Mod:    DHTML Collapsible Forum Index MOD     v1.1.1]
 ******************************************************/
//
// Password-protected forums
//
$lang['Forum_password'] = 'Forum password';
$lang['Enter_forum_password'] = 'Enter forum password';
$lang['Incorrect_forum_password'] = 'Incorrect forum password';
$lang['Password_login_success'] = 'Password login was successfull';
$lang['Click_return_page'] = 'Click %sHere%s to return to the page';
$lang['Only_alpha_num_chars'] = 'The password must be between 3-20 characters and can only contain alphanumeric characters (A-Z, a-z, 0-9).';

/*****[BEGIN]******************************************
 [ Mod:     Users Reputations Systems          v1.0.0 ]
 ******************************************************/
$lang['Reputation'] = 'Reputation';
$lang['No_votes'] = 'No votes';
$lang['Votes'] = 'votes';
/*****[END]********************************************
 [ Mod:     Users Reputations System           v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Arcade                             v3.0.2 ]
 ******************************************************/
$lang['lib_arcade'] = 'Arcade';
$lang['statuser'] = 'User Stats';
/*****[END]********************************************
 [ Mod:     Arcade                             v3.0.2 ]
 ******************************************************/

/*****[BEGIN]*****************************************
[ Mod: Inline Banner Ad                       v1.2.3 ]
******************************************************/
$lang['Sponsor'] = 'Sponsor';
/*****[END]*******************************************
[ Mod: Inline Banner Ad                       v1.2.3 ]
******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Email topic to friend              v1.0.0 ]
 ******************************************************/
$lang['Email_topic'] = 'Email topic to a friend';
$lang['Email_topic_settings'] = 'Email topic information';
$lang['Friend_name'] = "Friend's name";
$lang['Friend_email'] = "Friend's email";
$lang['Message'] = 'Message';
$lang['Message_explain'] = 'The message can only contain 255 characters. HTML is not allowed.';
$lang['Email_max_exceeded'] = 'Sorry, but you have already sent %d emails in the past %d hours';
$lang['No_friend_specified'] = "You have not specified your friend's name or email address";
$lang['Friend_name_too_long'] = 'The name you specified is too long.';
$lang['Friend_email_too_long'] = 'The email address you specified is too long.';
$lang['Message_too_long'] = 'The message you entered is too long.';
/*****[END]********************************************
 [ Mod:     Email topic to friend              v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Admin User Notes                    v1.0.0 ]
 ******************************************************/
$lang['Admin_notes'] = 'Admin User Notes';
/*****[END]********************************************
 [ Mod:    Admin User Notes                    v1.0.0 ]
 ******************************************************/ 

/*****[BEGIN]******************************************
 [ Mod:     Related Topics                      v0.12 ]
******************************************************/
$lang['Related_topics'] = 'Related topics';
/*****[END]********************************************
 [ Mod:     Related Topics                      v0.12 ]
 ******************************************************/ 

/*****[START]******************************************
 [ Base:    Who viewed a topic                 v1.0.3 ]
 ******************************************************/
$lang['WhoIsViewingThisTopic'] = 'Who viewed <i class="fas fa-arrow-right" style="font-size: 12px;"></i>';
$lang['WhoViewedMemberlist'] = 'Who Has Viewed This Topic?';  
$lang['Topic_view_users'] = 'List users that have viewed this topic';
$lang['Topic_time'] = 'Last viewed';
$lang['Topic_count'] = 'View count';
$lang['Topic_view_count'] = 'Topic view count';
/*****[END]********************************************
 [ Base:    Who viewed a topic                 v1.0.3 ]
 ******************************************************/

//
// That's all, Folks!
// -------------------------------------------------
?>
