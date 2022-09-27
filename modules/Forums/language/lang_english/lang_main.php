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

$titanium_lang['private_message_notify'] = 'Hello {USERNAME},<br /><br />The member "{SENDER_USERNAME}" from "{SITENAME}" has just sent you a new private message to your account and you have requested that you be notified on this event. The content of the message is as follow:<br /><br />"{PM_MESSAGE}"<br /><br />You can view your new message by clicking on the following link:<br /><br />{U_INBOX}<br /><br />Remember that you can always choose not to be notified of new messages by changing the appropriate setting in your profile.<br /><br />{EMAIL_SIG}';

$titanium_lang['topic_notify'] = 'Hello {USERNAME},<br /><br />You are receiving this email because you are watching the topic, "{TOPIC_TITLE}" at {SITENAME}. This topic has received a reply since your last visit. You can use the following link to view the replies made, no more notifications will be sent until you visit the topic.<br /><br />{U_TOPIC}<br /><br />The contents of the posted reply by {REPLY_BY} are as follows:<br /><br />{CONTENTS}<br /><br />{ATTACHMENT}<br /><br />If you no longer wish to watch this topic you can either click the "Stop watching this topic link" found at the bottom of the topic above, or by clicking the following link:<br /><br />{U_STOP_WATCHING_TOPIC}<br /><br />{EMAIL_SIG}';

$titanium_lang['group_added_template'] = 'Congratulations,<br /><br />You have been added to the "{GROUP_NAME}" group on {SITENAME}.<br />This action was done by the group moderator or the site administrator, contact them for more information.<br /><br />You can view your groups information here:<br />
{U_GROUPCP}<br /><br />{EMAIL_SIG}';

$titanium_lang['group_approved_template'] = 'Congratulations,<br /><br />Your request to join the "{GROUP_NAME}" group on {SITENAME} has been approved.<br />Click on the following link to see your group membership.<br /><br />{U_GROUPCP}<br /><br />{EMAIL_SIG}';

$titanium_lang['group_request_template'] = 'Dear {GROUP_MODERATOR},<br /><br />A user has requested to join a group you moderate on {SITENAME}.<br />To approve or deny this request for group membership please visit the following link:<br /><br />{U_GROUPCP}<br /><br />{EMAIL_SIG}';

$titanium_lang['report_post_template'] = 'A post at a site you moderate, {SITENAME}, has been reported.<br />To look at the post, please click on the following link:<br /><br />{U_VIEW_POST}<br /><br />This is what {USERNAME}, the person who reported the post, has to say:<br /><br />{COMMENTS}<br /><br />-----------------<br /><br />Manage reported posts:<br />{REPORT_URL}<br /><br />-----------------<br /><br />You can choose not to receive these emails any more by opting out in the Reported Posts control panel.<br /><br />{EMAIL_SIG}';





//
// The format of this file is ---> $titanium_lang['message'] = 'text';
//
// You should also try to set a locale and a character encoding (plus direction). The encoding and direction
// will be sent to the template. The locale may or may not work, it's dependent on OS support and the syntax
// varies ... give it your best guess!
//

$titanium_lang['ENCODING'] = 'UTF-8';
$titanium_lang['DIRECTION'] = 'ltr';
$titanium_lang['LEFT'] = 'left';
$titanium_lang['RIGHT'] = 'right';
$titanium_lang['DATE_FORMAT'] =  'd M Y'; // This should be changed to the default date format for your language, php date() format

// This is optional, if you would like a _SHORT_ message output
// along with our copyright message indicating you are the translator
// please add it here.
// $titanium_lang['TRANSLATION'] = '';

$titanium_lang['rank_title']     = 'Groups';
$titanium_lang['not_specified']  = 'Not Specified';

//
// Common, these terms are used
// extensively on several pages
//
$titanium_lang['Forum'] = 'Forum';
$titanium_lang['Category'] = 'Category';
$titanium_lang['Topic'] = 'Topic';
$titanium_lang['Topics'] = 'Topics';
$titanium_lang['Replies'] = 'Replies';
$titanium_lang['Views'] = 'Views';
$titanium_lang['Post'] = 'Post';
$titanium_lang['Posts'] = 'Posts';
$titanium_lang['Posted'] = 'Posted';
$titanium_lang['Username'] = 'Nickname/Callsign';
$titanium_lang['Password'] = 'Password';
$titanium_lang['Email'] = 'Email';
$titanium_lang['Poster'] = 'Poster';
$titanium_lang['Author'] = 'Author';
$titanium_lang['Time'] = 'Time';
$titanium_lang['Hours'] = 'Hours';
$titanium_lang['Message'] = 'Message';

$titanium_lang['1_Day'] = '1 Day';
$titanium_lang['7_Days'] = '7 Days';
$titanium_lang['2_Weeks'] = '2 Weeks';
$titanium_lang['1_Month'] = '1 Month';
$titanium_lang['3_Months'] = '3 Months';
$titanium_lang['6_Months'] = '6 Months';
$titanium_lang['1_Year'] = '1 Year';

$titanium_lang['Go'] = 'Go';
$titanium_lang['Jump_to'] = 'Jump to';
$titanium_lang['Submit'] = 'Submit';
$titanium_lang['Reset'] = 'Reset';
$titanium_lang['Required'] = 'Required';
$titanium_lang['Cancel'] = 'Cancel';
$titanium_lang['Preview'] = 'Preview';
$titanium_lang['Confirm'] = 'Confirm';
$titanium_lang['Spellcheck'] = 'Spellcheck';
$titanium_lang['Yes'] = 'Yes';
$titanium_lang['No'] = 'No';
$titanium_lang['Enabled'] = 'Enabled';
$titanium_lang['Disabled'] = 'Disabled';
$titanium_lang['Error'] = 'Error';

$titanium_lang['Next'] = 'Next';
$titanium_lang['Previous'] = 'Previous';
$titanium_lang['Goto_page'] = 'Goto page';
$titanium_lang['Joined'] = 'Joined';
$titanium_lang['IP_Address'] = 'IP Address';

$titanium_lang['Select_forum'] = 'Select a forum';
$titanium_lang['View_latest_post'] = 'View latest post';
$titanium_lang['View_newest_post'] = 'View newest post';
$titanium_lang['Page_of'] = 'Page <strong>%d</strong> of <strong>%d</strong>'; // Replaces with: Page 1 of 2 for example

/*****[BEGIN]******************************************
 [ Mod:     Facebook Profile Mod               v1.0.0 ]
 ******************************************************/
$titanium_lang['facebook'] = 'Facebook Profile';
$titanium_lang['facebook_explain'] = 'Enter your Facebook profile id number';
$titanium_lang['FACEBOOK_PROFILE'] = 'Facebook';
$titanium_lang['Visit_facebook'] = 'Visit user\'s Facebook Page';
/*****[END]********************************************
 [ Mod:     Facebook Profile Mod               v1.0.0 ]
 ******************************************************/ 

/**
 * @since 2.0.9e
 */
$titanium_lang['User_last_visit'] = 'Last Visit';
$titanium_lang['User_contact_details'] = '%s\'s Contact Details';
$titanium_lang['Additional_info'] = 'Additional Info About %s';
$titanium_lang['Users_signature'] = '%s\'s Signature';
$titanium_lang['Forum_Info'] = '%s\'s Forum Info';

$titanium_lang['Edit_Forum_User_ACP'] = '%sEdit this user in Forum ACP%s';
$titanium_lang['Ban_Forum_User_IP'] = '%sBan this user in NukeSentinel%s';
$titanium_lang['Suspend_This_User'] = '%sSuspend this user%s';
$titanium_lang['Delete_This_User'] = '%sDelete this user%s';

// $titanium_lang['Forum_Index'] = '%s Forum Index';  // eg. sitename Forum Index, %s can be removed if you prefer
$titanium_lang['Forum_Index'] = 'Forums';
$titanium_lang['Home_Index']  = 'Home';


$titanium_lang['Post_new_topic'] = 'Post new topic';
$titanium_lang['Reply_to_topic'] = 'Reply to topic';
$titanium_lang['Reply_with_quote'] = 'Reply with quote';

$titanium_lang['Click_return_topic'] = 'Click %sHere%s to return to the topic'; // %s's here are for uris, do not remove!
$titanium_lang['Click_return_login'] = 'Click %sHere%s to try again';
$titanium_lang['Click_return_forum'] = 'Click %sHere%s to return to the forum';
$titanium_lang['Click_view_message'] = 'Click %sHere%s to view your message';
$titanium_lang['Click_return_modcp'] = 'Click %sHere%s to return to the Moderator Control Panel';
$titanium_lang['Click_return_group'] = 'Click %sHere%s to return to group information';

$titanium_lang['Admin_panel'] = 'Go to Administration Panel';

$titanium_lang['Board_disable'] = 'Sorry, but this board is currently unavailable.  Please try again later.';

//
// Global Header strings
//
$titanium_lang['Registered_users'] = 'Registered Portal Members:';
/*****[BEGIN]******************************************
 [ Mod:     Users of the day                   v2.1.0 ]
 ******************************************************/
$titanium_lang['day_userlist_users'] = '%d registered users have visited us in the last %d hours:';
/*****[END]********************************************
 [ Mod:     Users of the day                   v2.1.0 ]
 ******************************************************/
$titanium_lang['Browsing_forum'] = 'Members browsing this forum:';
$titanium_lang['Online_users_zero_total'] = 'In total there are <strong>0</strong> members online :: ';
$titanium_lang['Online_users_total'] = 'In total there are <strong>%d</strong> members online :: ';
$titanium_lang['Online_user_total'] = 'In total there is <strong>%d</strong> member online :: ';
$titanium_lang['Reg_users_zero_total'] = '0 Registered, ';
$titanium_lang['Reg_users_total'] = '%d Registered, ';
$titanium_lang['Reg_user_total'] = '%d Registered, ';
$titanium_lang['Hidden_users_zero_total'] = '0 Hidden and ';
$titanium_lang['Hidden_user_total'] = '%d Hidden and ';
$titanium_lang['Hidden_users_total'] = '%d Hidden and ';
$titanium_lang['Guest_users_zero_total'] = '0 Guests';
$titanium_lang['Guest_users_total'] = '%d Guests';
$titanium_lang['Guest_user_total'] = '%d Guest';
$titanium_lang['Record_online_users'] = 'Most members ever online was <strong>%s</strong> on %s'; // first %s = number of users, second %s is the date.

$titanium_lang['Admin_online_color'] = '%sAdministrator%s';
$titanium_lang['Mod_online_color'] = '%sModerator%s';

$titanium_lang['You_last_visit'] = 'You last visited on %s'; // %s replaced by date/time
$titanium_lang['Current_time'] = 'The time now is %s'; // %s replaced by time

$titanium_lang['Search_new'] = 'View posts since last visit';
$titanium_lang['Search_your_posts'] = 'View your posts';
$titanium_lang['Search_unanswered'] = 'View unanswered posts';

$titanium_lang['Register'] = 'Register';
$titanium_lang['Profile'] = 'Profile';
$titanium_lang['Edit_profile'] = 'Edit your profile';
$titanium_lang['Search'] = 'Search';
$titanium_lang['Memberlist'] = 'Members';
$titanium_lang['FAQ'] = 'Forum FAQ';
$titanium_lang['Legend'] = 'Legend';
/*****[BEGIN]******************************************
 [ Mod:     Forum Statistics                   v1.2.2 ]
 ******************************************************/
$titanium_lang['Statistics'] = 'Statistics';
/*****[END]********************************************
 [ Mod:     Forum Statistics                   v1.2.2 ]
 ******************************************************/
$titanium_lang['BBCode_guide'] = 'BBCode Guide';
$titanium_lang['Usergroups'] = 'Usergroups';
$titanium_lang['Last_Post'] = 'Last Post';
/*****[BEGIN]******************************************
 [ Mod:     Resize Posted Images               v2.4.5 ]
 ******************************************************/
// $titanium_lang['rmw_image_title'] = 'Click to view full-size';
/*****[END]********************************************
 [ Mod:     Resize Posted Images               v2.4.5 ]
 ******************************************************/
$titanium_lang['Moderator'] = 'Mod Group:';
$titanium_lang['Moderators'] = 'Mod Groups:';

//
// Stats block text
//
$titanium_lang['Posted_articles_zero_total'] = 'Our members have posted a total of 0 articles'; // Number of posts
$titanium_lang['Posted_articles_total'] = 'Our members have posted a total of %d articles'; // Number of posts
$titanium_lang['Posted_article_total'] = 'Our members have posted a total of %d article'; // Number of posts
$titanium_lang['Registered_users_zero_total'] = 'We have 0 registered members'; // # registered users
$titanium_lang['Registered_users_total'] = 'We have %d registered members'; // # registered users
$titanium_lang['Registered_user_total'] = 'We have %d registered member'; // # registered users
$titanium_lang['Newest_user'] = 'The newest registered member is %s%s%s'; // a href, username, /a

$titanium_lang['No_new_posts_last_visit'] = 'No new posts since your last visit';
$titanium_lang['No_new_posts'] = 'No new posts';
$titanium_lang['New_posts'] = 'New posts';
$titanium_lang['New_post'] = 'New post';
$titanium_lang['No_new_posts_hot'] = 'No new posts [ Popular ]';
$titanium_lang['New_posts_hot'] = 'New posts [ Popular ]';
$titanium_lang['No_new_posts_locked'] = 'No new posts [ Locked ]';
$titanium_lang['New_posts_locked'] = 'New posts [ Locked ]';
$titanium_lang['Forum_is_locked'] = 'Forum is locked';

//
// Login
//
$titanium_lang['Enter_password'] = 'Please enter your username and password to log in.';
$titanium_lang['Login'] = 'Log in';
$titanium_lang['Logout'] = 'Log out';

$titanium_lang['Forgotten_password'] = 'I forgot my password';

$titanium_lang['Log_me_in'] = 'Log me on automatically each visit';

$titanium_lang['Error_login'] = 'You have specified an incorrect or inactive member name, or an invalid password.';

//
// Index page
//
$titanium_lang['Index'] = 'Index';
$titanium_lang['No_Posts'] = 'No Posts';
$titanium_lang['No_forums'] = 'This board has no forums';

$titanium_lang['Private_Message'] = 'Private Message';
$titanium_lang['Private_Messages'] = 'Private Messages';
$titanium_lang['Who_is_Online'] = 'Members Online';

$titanium_lang['Mark_all_forums'] = 'Mark forums read';
$titanium_lang['Forums_marked_read'] = 'All forums have been marked read';

//
// Viewforum
//
$titanium_lang['View_forum'] = 'View Forum';

$titanium_lang['Forum_not_exist'] = 'The forum you selected does not exist.';
$titanium_lang['Reached_on_error'] = 'You have reached this page in error.';

$titanium_lang['Display_topics'] = 'Display topics from previous';
$titanium_lang['All_Topics'] = 'All Topics';

$titanium_lang['Topic_Announcement'] = '<strong>Announcement:</strong>';
$titanium_lang['Topic_Sticky'] = '<strong>Sticky:</strong>';
$titanium_lang['Topic_Moved'] = '<strong>Moved:</strong>';
$titanium_lang['Topic_Poll'] = '<strong>[ Poll ]</strong>';

$titanium_lang['Mark_all_topics'] = 'Mark all topics read';
$titanium_lang['Topics_marked_read'] = 'The topics for this forum have now been marked read';

$titanium_lang['Rules_post_can'] = 'You <strong>can</strong> post new topics in this forum';
$titanium_lang['Rules_post_cannot'] = 'You <strong>cannot</strong> post new topics in this forum';
$titanium_lang['Rules_reply_can'] = 'You <strong>can</strong> reply to topics in this forum';
$titanium_lang['Rules_reply_cannot'] = 'You <strong>cannot</strong> reply to topics in this forum';
$titanium_lang['Rules_edit_can'] = 'You <strong>can</strong> edit your posts in this forum';
$titanium_lang['Rules_edit_cannot'] = 'You <strong>cannot</strong> edit your posts in this forum';
$titanium_lang['Rules_delete_can'] = 'You <strong>can</strong> delete your posts in this forum';
$titanium_lang['Rules_delete_cannot'] = 'You <strong>cannot</strong> delete your posts in this forum';
$titanium_lang['Rules_vote_can'] = 'You <strong>can</strong> vote in polls in this forum';
$titanium_lang['Rules_vote_cannot'] = 'You <strong>cannot</strong> vote in polls in this forum';
$titanium_lang['Rules_moderate'] = 'You <strong>can</strong> %smoderate this forum%s'; // %s replaced by a href links, do not remove!

$titanium_lang['No_topics_post_one'] = 'There are no posts in this forum.<br />Click on the <span style="font-weight: bold;">New Topic</span> link on this page to post one.';

//
// Viewtopic
//
$titanium_lang['View_topic'] = 'View topic';

$titanium_lang['Guest'] = 'Guest';
$titanium_lang['Post_subject'] = 'Post subject';
$titanium_lang['View_next_topic'] = 'View next topic';
$titanium_lang['View_previous_topic'] = 'View previous topic';
$titanium_lang['Submit_vote'] = 'Submit Vote';
$titanium_lang['View_results'] = 'View Results';
$titanium_lang['must_first_vote'] = 'You must first vote to see the results of this poll';

$titanium_lang['No_newer_topics'] = 'There are no newer topics in this forum';
$titanium_lang['No_older_topics'] = 'There are no older topics in this forum';
$titanium_lang['Topic_post_not_exist'] = 'The topic or post you requested does not exist';
$titanium_lang['No_posts_topic'] = 'No posts exist for this topic';

$titanium_lang['Display_posts'] = 'Display posts from previous';
$titanium_lang['All_Posts'] = 'All Posts';
$titanium_lang['Newest_First'] = 'Newest First';
$titanium_lang['Oldest_First'] = 'Oldest First';

$titanium_lang['Back_to_top'] = 'Back to top';

$titanium_lang['Read_profile'] = 'View member\'s profile';
$titanium_lang['Visit_website'] = 'Visit member\'s website';
$titanium_lang['ICQ_status'] = 'ICQ Status';
$titanium_lang['Edit_delete_post'] = 'Edit/Delete this post';
$titanium_lang['View_IP'] = 'View IP address of poster';
$titanium_lang['Delete_post'] = 'Delete this post';

$titanium_lang['wrote'] = 'wrote'; // proceeds the username and is followed by the quoted text
$titanium_lang['Quote'] = 'Quote'; // comes before bbcode quote output.
$titanium_lang['Code'] = 'Code'; // comes before bbcode code output.
/*****[BEGIN]******************************************
 [ Mod:     PHP Syntax Highlighter BBCode      v3.0.7 ]
 ******************************************************/
$titanium_lang['PHPCode'] = 'PHP'; // PHP MOD
/*****[END]********************************************
 [ Mod:     PHP Syntax Highlighter BBCode      v3.0.7 ]
 ******************************************************/

$titanium_lang['Edited_time_total'] = 'Last edited by %s on %s; edited %d time in total'; // Last edited by me on 12 Oct 2001; edited 1 time in total
$titanium_lang['Edited_times_total'] = 'Last edited by %s on %s; edited %d times in total'; // Last edited by me on 12 Oct 2001; edited 2 times in total

$titanium_lang['Lock_topic'] = 'Lock this topic';
$titanium_lang['Unlock_topic'] = 'Unlock this topic';
$titanium_lang['Move_topic'] = 'Move this topic';
$titanium_lang['Delete_topic'] = 'Delete this topic';
$titanium_lang['Split_topic'] = 'Split this topic';

$titanium_lang['Stop_watching_topic'] = 'Stop watching this topic';
$titanium_lang['Start_watching_topic'] = 'Watch this topic for replies';
$titanium_lang['No_longer_watching'] = 'You are no longer watching this topic';
$titanium_lang['You_are_watching'] = 'You are now watching this topic';

$titanium_lang['Total_votes'] = 'Total Votes';

//
// Posting/Replying (Not private messaging!)
//
$titanium_lang['Message_body'] = 'Message body';
$titanium_lang['Topic_review'] = 'Topic review';

$titanium_lang['No_post_mode'] = 'No post mode specified'; // If posting.php is called without a mode (newtopic/reply/delete/etc, shouldn't be shown normaly)

$titanium_lang['Post_a_new_topic'] = 'Post a new topic';
$titanium_lang['Post_a_reply'] = 'Post a reply';
$titanium_lang['Post_topic_as'] = 'Post topic type';
$titanium_lang['Edit_Post'] = 'Edit post';
$titanium_lang['Options'] = 'Options';

$titanium_lang['Post_Announcement'] = 'Announcement';
$titanium_lang['Post_Sticky'] = 'Sticky';
$titanium_lang['Post_Normal'] = 'Normal';

$titanium_lang['Confirm_delete'] = 'Are you sure you want to delete this post?';
$titanium_lang['Confirm_delete_poll'] = 'Are you sure you want to delete this poll?';

$titanium_lang['Flood_Error'] = 'You cannot make another post so soon after your last; please try again in a short while.';
$titanium_lang['Empty_subject'] = 'You must specify a subject when posting a new topic.';
$titanium_lang['Empty_message'] = 'You must enter a message when posting.';
$titanium_lang['Forum_locked'] = 'This forum is locked: you cannot post, reply to, or edit topics.';
$titanium_lang['Topic_locked'] = 'This topic is locked: you cannot edit posts or make replies.';
$titanium_lang['No_post_id'] = 'You must select a post to edit';
$titanium_lang['No_topic_id'] = 'You must select a topic to reply to';
$titanium_lang['No_valid_mode'] = 'You can only post, reply, edit, or quote messages. Please return and try again.';
$titanium_lang['No_such_post'] = 'There is no such post. Please return and try again.';
$titanium_lang['Edit_own_posts'] = 'Sorry, but you can only edit your own posts.';
$titanium_lang['Delete_own_posts'] = 'Sorry, but you can only delete your own posts.';
$titanium_lang['Cannot_delete_replied'] = 'Sorry, but you may not delete posts that have been replied to.';
$titanium_lang['Cannot_delete_poll'] = 'Sorry, but you cannot delete an active poll.';
$titanium_lang['Empty_poll_title'] = 'You must enter a title for your poll.';
$titanium_lang['To_few_poll_options'] = 'You must enter at least two poll options.';
$titanium_lang['To_many_poll_options'] = 'You have tried to enter too many poll options.';
$titanium_lang['Post_has_no_poll'] = 'This post has no poll.';
$titanium_lang['Already_voted'] = 'You have already voted in this poll.';
$titanium_lang['No_vote_option'] = 'You must specify an option when voting.';

$titanium_lang['Add_poll'] = 'Add a Poll';
$titanium_lang['Add_poll_explain'] = 'If you do not want to add a poll to your topic, leave the fields blank.';
$titanium_lang['Poll_view_toggle_explain'] = '[ Allows user to see results before voting. ]';
$titanium_lang['Poll_question'] = 'Poll question';
$titanium_lang['Poll_option'] = 'Poll option';
$titanium_lang['Add_option'] = 'Add option';
$titanium_lang['Update'] = 'Update';
$titanium_lang['Delete'] = 'Delete';
$titanium_lang['Poll_for'] = 'Run poll for';
$titanium_lang['Poll_view_toggle'] = 'Allow View';
$titanium_lang['Days'] = 'Days'; // This is used for the Run poll for ... Days + in admin_forums for pruning
$titanium_lang['Poll_for_explain'] = '[ Enter 0 or leave blank for a never-ending poll ]';
$titanium_lang['Delete_poll'] = 'Delete Poll';

$titanium_lang['Disable_HTML_post'] = 'Disable HTML in this post';
$titanium_lang['Disable_BBCode_post'] = 'Disable BBCode in this post';
$titanium_lang['Disable_Smilies_post'] = 'Disable Smilies in this post';

$titanium_lang['HTML_is_ON'] = 'HTML is <u>ON</u>';
$titanium_lang['HTML_is_OFF'] = 'HTML is <u>OFF</u>';
// $titanium_lang['BBCode_is_ON'] = '%sBBCode%s is <u>ON</u>';
// $titanium_lang['BBCode_is_OFF'] = '%sBBCode%s is <u>OFF</u>';
$titanium_lang['BBCode_is_ON'] = 'BBCode is <u>ON</u>';
$titanium_lang['BBCode_is_OFF'] = 'BBCode is <u>OFF</u>';
$titanium_lang['Smilies_are_ON'] = 'Smilies are <u>ON</u>';
$titanium_lang['Smilies_are_OFF'] = 'Smilies are <u>OFF</u>';

$titanium_lang['Attach_signature'] = 'Attach signature (signatures can be changed in profile)';
$titanium_lang['Notify'] = 'Notify me when a reply is posted';

$titanium_lang['Stored'] = 'Your message has been entered successfully.';
$titanium_lang['Deleted'] = 'Your message has been deleted successfully.';
$titanium_lang['Poll_delete'] = 'Your poll has been deleted successfully.';
$titanium_lang['Vote_cast'] = 'Your vote has been cast.';

$titanium_lang['Topic_reply_notification'] = 'Topic Reply Notification';

$titanium_lang['Close_Tags'] = 'Close Tags';
$titanium_lang['Styles_tip'] = 'Tip: Styles can be applied quickly to selected text.';
$titanium_lang['glance_news_heading'] = 'Latest Site News';
$titanium_lang['glance_recent_heading'] = 'Recent Topics';

//
// Private Messaging
//
$titanium_lang['Private_Messaging'] = 'Private Messaging';

//
// PM with sound
//
$titanium_lang['New_pms'] = '%d new messages'; // You have 2 new messages
$titanium_lang['New_pm'] = '%d new message'; // You have 1 new message
//
// end PM with sound
//
$titanium_lang['Login_check_pm'] = 'Login, Check Messages';
$titanium_lang['No_new_pm'] = 'No new messages';
$titanium_lang['Unread_pms'] = '%d unread messages';
$titanium_lang['Unread_pm'] = '%d unread message';
$titanium_lang['No_unread_pm'] = 'No unread messages';
$titanium_lang['You_new_pm'] = '%d new private message';// You have 1 new message
$titanium_lang['You_new_pms'] = '%d new private messages';// You have 2 new messages
$titanium_lang['You_no_new_pm'] = 'No new private messages';

$titanium_lang['Unread_message'] = 'Unread message';
$titanium_lang['Read_message'] = 'Read message';

$titanium_lang['Read_pm'] = 'Read message';
$titanium_lang['Post_new_pm'] = 'Post message';
$titanium_lang['Post_reply_pm'] = 'Reply to message';
$titanium_lang['Post_quote_pm'] = 'Quote message';
$titanium_lang['Edit_pm'] = 'Edit message';

$titanium_lang['Inbox'] = 'Inbox';
$titanium_lang['Outbox'] = 'Outbox';
$titanium_lang['Savebox'] = 'Savebox';
$titanium_lang['Sentbox'] = 'Sentbox';
$titanium_lang['Flag'] = 'Flag';
$titanium_lang['Subject'] = 'Subject';
$titanium_lang['From'] = 'From';
$titanium_lang['To'] = 'To';
$titanium_lang['Date'] = 'Date';
$titanium_lang['Mark'] = 'Mark';
$titanium_lang['Sent'] = 'Sent';
$titanium_lang['Saved'] = 'Saved';
$titanium_lang['Delete_marked'] = 'Delete Marked';
$titanium_lang['Delete_all'] = 'Delete All';
$titanium_lang['Save_marked'] = 'Save Marked';
$titanium_lang['Save_message'] = 'Save Message';
$titanium_lang['Delete_message'] = 'Delete Message';

$titanium_lang['Display_messages'] = 'Display messages from previous'; // Followed by number of days/weeks/months
$titanium_lang['All_Messages'] = 'All Messages';

$titanium_lang['No_messages_folder'] = 'You have no messages in this folder';

$titanium_lang['PM_disabled'] = 'Private messaging has been disabled on this board.';
$titanium_lang['Cannot_send_privmsg'] = 'Sorry, but the administrator has prevented you from sending private messages.';
$titanium_lang['No_to_user'] = 'You must specify a username to whom to send this message.';
$titanium_lang['No_such_user'] = 'Sorry, but no such user exists.';

$titanium_lang['Disable_HTML_pm'] = 'Disable HTML in this message';
$titanium_lang['Disable_BBCode_pm'] = 'Disable BBCode in this message';
$titanium_lang['Disable_Smilies_pm'] = 'Disable Smilies in this message';

$titanium_lang['Message_sent'] = 'Your message has been sent.';

$titanium_lang['Click_return_inbox'] = 'Click %sHere%s to return to your Inbox';
$titanium_lang['Click_return_index'] = 'Click %sHere%s to return to the Index';
$titanium_lang['Click_return_profile'] = 'Click %sHere%s to return to your Profile';

$titanium_lang['Send_a_new_message'] = 'Send a new private message';
$titanium_lang['Send_a_reply'] = 'Reply to a private message';
$titanium_lang['Edit_message'] = 'Edit private message';

$titanium_lang['Notification_subject'] = 'New Private Message has arrived!';

$titanium_lang['Find_username'] = 'Find a member name';
$titanium_lang['Find'] = 'Find';
$titanium_lang['No_match'] = 'No matches found.';

$titanium_lang['No_post_id'] = 'No post ID was specified';
$titanium_lang['No_such_folder'] = 'No such folder exists';
$titanium_lang['No_folder'] = 'No folder specified';

$titanium_lang['Mark_all'] = 'Mark all';
$titanium_lang['Unmark_all'] = 'Unmark all';

$titanium_lang['Confirm_delete_pm'] = 'Are you sure you want to delete this message?';
$titanium_lang['Confirm_delete_pms'] = 'Are you sure you want to delete these messages?';

$titanium_lang['Inbox_size'] = 'Your Inbox is %d%% full'; // eg. Your Inbox is 50% full
$titanium_lang['Sentbox_size'] = 'Your Sentbox is %d%% full';
$titanium_lang['Savebox_size'] = 'Your Savebox is %d%% full';

$titanium_lang['Click_view_privmsg'] = 'Click %sHere%s to visit your Inbox';

//
// Profiles/Registration
//
$titanium_lang['Viewing_user_profile'] = 'Profile of&nbsp;&nbsp;%s'; // %s is username
$titanium_lang['About_user'] = 'All about %s'; // %s is username
/*****[BEGIN]******************************************
 [ Mod:    User Administration Link on Profile v1.0.0 ]
 ******************************************************/
// $titanium_lang['User_admin_for'] = 'User Administration for';
$titanium_lang['User_admin_for'] = 'Admin Options';
/*****[END]********************************************
 [ Mod:    User Administration Link on Profile v1.0.0 ]
 ******************************************************/

$titanium_lang['Preferences'] = 'Preferences';
$titanium_lang['Items_required'] = 'Items marked with a * are required unless stated otherwise.';
$titanium_lang['Registration_info'] = 'Registration Information';
$titanium_lang['Password_change'] = 'Change Password';
$titanium_lang['Profile_info'] = 'Profile Information';
$titanium_lang['Profile_info_warn'] = 'This information will be publicly viewable';
$titanium_lang['Avatar_panel'] = 'Avatar control panel';
$titanium_lang['Avatar_gallery'] = 'Avatar gallery';

$titanium_lang['sceditor_options'] = 'SCeditor Options';
$titanium_lang['sceditor_state'] = 'Choose which state SCEditor should be in by default';
$titanium_lang['sceditor_display_mode'] = 'Display Mode';
$titanium_lang['sceditor_editor_mode'] = 'Editor Mode';

$titanium_lang['Website'] = 'Website/Portal';
$titanium_lang['Location'] = 'Location';
$titanium_lang['Contact'] = 'Contact';
$titanium_lang['Email_address'] = 'Email';
// $titanium_lang['Send_private_message'] = 'Send private message';
$titanium_lang['Send_private_message'] = 'Send %s a private message';
$titanium_lang['Hidden_email'] = '[ Hidden ]';
$titanium_lang['Interests'] = 'Interests';
$titanium_lang['Occupation'] = 'Occupation';
$titanium_lang['Poster_rank'] = 'Poster rank';

$titanium_lang['Total_posts'] = 'Posts';
$titanium_lang['User_post_pct_stats'] = '%.2f%% of total posts'; // 1.25% of total
$titanium_lang['User_post_day_stats'] = '%.2f per day'; // 1.5 posts per day
$titanium_lang['Search_user_posts'] = 'Find all posts by %s'; // Find all posts by username

$titanium_lang['No_user_id_specified'] = 'The user you are looking for is in Ghost Mode!<br />- THIS USER DOES NOT WANT TO BE FOUND -';
$titanium_lang['Wrong_Profile'] = 'You cannot modify a profile that is not your own.';

$titanium_lang['Only_one_avatar'] = 'Only one type of avatar can be specified';
$titanium_lang['File_no_data'] = 'The file at the URL you gave contains no data';
$titanium_lang['No_connection_URL'] = 'A connection could not be made to the URL you gave';
$titanium_lang['Incomplete_URL'] = 'The URL you entered is incomplete';
$titanium_lang['Wrong_remote_avatar_format'] = 'The URL of the remote avatar is not valid';
$titanium_lang['No_send_account_inactive'] = 'Sorry, but your password cannot be retrieved because your account is currently inactive. Please contact the forum administrator for more information.';

$titanium_lang['Always_smile'] = 'Always enable Smilies';
$titanium_lang['Always_html'] = 'Always allow HTML';
$titanium_lang['Always_bbcode'] = 'Always allow BBCode';
$titanium_lang['Always_add_sig'] = 'Always attach my signature';
$titanium_lang['Always_notify'] = 'Always notify me of replies';
$titanium_lang['Always_notify_explain'] = 'Sends an e-mail when someone replies to a topic you have posted in. This can be changed whenever you post.';

/*****[BEGIN]******************************************
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 ******************************************************/
$titanium_lang['Word_Wrap'] = 'Screen Width';
$titanium_lang['Word_Wrap_Explain'] = 'This is the maximum line length of user\'s posts.';
$titanium_lang['Word_Wrap_Extra'] = 'characters (range: %min% - %max% chars.)';
$titanium_lang['Word_Wrap_Error'] = 'The post display width is out of range.';
/*****[END]********************************************
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 ******************************************************/

$titanium_lang['Board_style'] = 'Board Style';
$titanium_lang['Board_lang'] = 'Board Language';
$titanium_lang['No_themes'] = 'No Themes In database';
$titanium_lang['Timezone'] = 'Timezone';
$titanium_lang['Date_format'] = 'Date format';
$titanium_lang['Date_format_explain'] = 'The syntax used is identical to the PHP <a href=\'http://www.php.net/date\' target=\'_other\'>date()</a> function.';
$titanium_lang['Signature'] = 'Signature';
$titanium_lang['Signature_explain'] = 'This is a block of text that can be added to posts you make. There is a %d character limit';
$titanium_lang['Public_view_email'] = 'Always show my e-mail address';

$titanium_lang['Current_password'] = 'Current password';
$titanium_lang['New_password'] = 'New password';
$titanium_lang['Confirm_password'] = 'Confirm password';
$titanium_lang['Confirm_password_explain'] = 'You must confirm your current password if you wish to change it or alter your e-mail address';
$titanium_lang['password_if_changed'] = 'You only need to supply a password if you want to change it';
$titanium_lang['password_confirm_if_changed'] = 'You only need to confirm your password if you changed it above';

/*****[BEGIN]******************************************
 [ Mod:    Password security                   v1.1.0 ]
 ******************************************************/
$titanium_lang['password_security_level1'] = 'Unsafe';
$titanium_lang['password_security_level2'] = 'Not recommendable';
$titanium_lang['password_security_level3'] = 'Relatively safe';
$titanium_lang['password_security_level4'] = 'Safe';
$titanium_lang['password_security_level5'] = 'Very safe';
$titanium_lang['password_security_explain'] = 'Password security:';
/*****[END]********************************************
 [ Mod:    Password security                   v1.1.0 ]
 ******************************************************/

$titanium_lang['Avatar'] = 'Avatar';
/*****[BEGIN]******************************************
 [ Mod:     Remote Avatar Resize               v1.1.4 ]
 ******************************************************/
$titanium_lang['Avatar_explain'] = 'Displays a small graphic image below your details in posts. Only one image can be displayed at a time. The dimensions of the image are restricted to a maximum of %d pixels wide, and %d pixels high. Uploaded avatars have a file size limit of %d KB, and must be less than or equal to the maximum dimensions. Remotely hosted avatars will be automatically scaled to fit these dimensions.';
/*****[END]********************************************
 [ Mod:     Remote Avatar Resize               v1.1.4 ]
 ******************************************************/
$titanium_lang['Upload_Avatar_file'] = 'Upload Avatar from your machine';
$titanium_lang['Upload_Avatar_URL'] = 'Upload Avatar from a URL';
$titanium_lang['Upload_Avatar_URL_explain'] = 'Enter the URL of the location containing the Avatar image, it will be copied to this site.';
$titanium_lang['Pick_local_Avatar'] = 'Select Avatar from the gallery';
$titanium_lang['Link_remote_Avatar'] = 'Link to off-site Avatar';
$titanium_lang['Link_remote_Avatar_explain'] = 'Enter the URL of the location containing the Avatar image you wish to link to.';
$titanium_lang['Avatar_URL'] = 'URL of Avatar Image';
$titanium_lang['Select_from_gallery'] = 'Select Avatar from gallery';
$titanium_lang['View_avatar_gallery'] = 'Show gallery';

$titanium_lang['Select_avatar'] = 'Select avatar';
$titanium_lang['Return_profile'] = 'Cancel avatar';
$titanium_lang['Select_category'] = 'Select category';

$titanium_lang['Delete_Image'] = 'Delete Image';
$titanium_lang['Current_Image'] = 'Current Image';

$titanium_lang['Notify_on_privmsg'] = 'Notify on new Private Message';
$titanium_lang['Popup_on_privmsg'] = 'Pop up window on new Private Message';
$titanium_lang['Popup_on_privmsg_explain'] = 'Some templates may open a new window to inform you when new private messages arrive.';
$titanium_lang['Hide_user'] = 'Ghost Mode (Hide your membership and online status)';

$titanium_lang['Profile_updated'] = 'Your profile has been updated';
$titanium_lang['Profile_updated_inactive'] = 'Your profile has been updated. However, you have changed vital details, thus your account is now inactive. Check your e-mail to find out how to reactivate your account, or if admin activation is required, wait for the administrator to reactivate it.';

$titanium_lang['Password_mismatch'] = 'The passwords you entered did not match.';
$titanium_lang['Current_password_mismatch'] = 'The current password you supplied does not match that stored in the database.';
$titanium_lang['Password_long'] = 'Your password must be no more than 32 characters.';
$titanium_lang['Username_taken'] = 'Sorry, but this username has already been taken.';
$titanium_lang['Username_invalid'] = 'Sorry, but this username contains an invalid character such as \'.';
$titanium_lang['Username_disallowed'] = 'Sorry, but this username has been disallowed.';
$titanium_lang['Email_taken'] = 'Sorry, but that e-mail address is already registered to a user.';
$titanium_lang['Email_banned'] = 'Sorry, but this e-mail address has been banned.';
$titanium_lang['Email_invalid'] = 'Sorry, but this e-mail address is invalid.';
$titanium_lang['Signature_too_long'] = 'Your signature is too long.';
$titanium_lang['Fields_empty'] = 'You must fill in the required fields.';
$titanium_lang['Avatar_filetype'] = 'The avatar filetype must be .jpg, .gif or .png';
$titanium_lang['Avatar_filesize'] = 'The avatar image file size must be less than %d KB'; // The avatar image file size must be less than 6 KB
$titanium_lang['Avatar_imagesize'] = 'The avatar must be less than %d pixels wide and %d pixels high';

$titanium_lang['Welcome_subject'] = 'Welcome to %s Forums'; // Welcome to my.com forums
$titanium_lang['New_account_subject'] = 'New member account';
$titanium_lang['Account_activated_subject'] = 'Account Activated';

$titanium_lang['Account_added'] = 'Thank you for registering. Your account has been created. You may now log in with your username and password';
$titanium_lang['Account_inactive'] = 'Your account has been created. However, this forum requires account activation. An activation key has been sent to the e-mail address you provided. Please check your e-mail for further information';
$titanium_lang['Account_inactive_admin'] = 'Your account has been created. However, this forum requires account activation by the administrator. An e-mail has been sent to them and you will be informed when your account has been activated';
$titanium_lang['Account_active'] = 'Your account has now been activated. Thank you for registering';
$titanium_lang['Account_active_admin'] = 'The account has now been activated';
$titanium_lang['Reactivate'] = 'Reactivate your account!';
$titanium_lang['Already_activated'] = 'You have already activated your account';
$titanium_lang['COPPA'] = 'Your account has been created but has to be approved. Please check your e-mail for details.';

$titanium_lang['Registration'] = 'Registration Agreement Terms';
$titanium_lang['Reg_agreement'] = 'While the administrators and moderators of this forum will attempt to remove or edit any generally objectionable material as quickly as possible, it is impossible to review every message. Therefore you acknowledge that all posts made to these forums express the views and opinions of the author and not the administrators, moderators or webmaster (except for posts by these people) and hence will not be held liable.<br /><br />You agree not to post any abusive, obscene, vulgar, slanderous, hateful, threatening, sexually-oriented or any other material that may violate any applicable laws. Doing so may lead to you being immediately and permanently banned (and your service provider being informed). The IP address of all posts is recorded to aid in enforcing these conditions. You agree that the webmaster, administrator and moderators of this forum have the right to remove, edit, move or close any topic at any time should they see fit. As a user you agree to any information you have entered above being stored in a database. While this information will not be disclosed to any third party without your consent the webmaster, administrator and moderators cannot be held responsible for any hacking attempt that may lead to the data being compromised.<br /><br />This forum system uses cookies to store information on your local computer. These cookies do not contain any of the information you have entered above; they serve only to improve your viewing pleasure. The e-mail address is used only for confirming your registration details and password (and for sending new passwords should you forget your current one).<br /><br />By clicking Register below you agree to be bound by these conditions.';

$titanium_lang['Agree_under_13'] = 'I Agree to these terms and am <strong>under</strong> 13 years of age';
$titanium_lang['Agree_over_13'] = 'I Agree to these terms and am <strong>over</strong> or <strong>exactly</strong> 13 years of age';
$titanium_lang['Agree_not'] = 'I do not agree to these terms';

$titanium_lang['Wrong_activation'] = 'The activation key you supplied does not match any in the database.';
$titanium_lang['Send_password'] = 'Send me a new password';
$titanium_lang['Password_updated'] = 'A new password has been created; please check your e-mail for details on how to activate it.';
$titanium_lang['No_email_match'] = 'The e-mail address you supplied does not match the one listed for that username.';
$titanium_lang['New_password_activation'] = 'New password activation';
$titanium_lang['Password_activated'] = 'Your account has been re-activated. To log in, please use the password supplied in the e-mail you received.';

$titanium_lang['Email_sent'] = 'The e-mail has been sent.';
// $titanium_lang['Send_email'] = 'Send e-mail';
$titanium_lang['Send_email'] = 'Send %s an email.';
$titanium_lang['Send_email_msg'] = 'Send an email message';
$titanium_lang['No_user_specified'] = 'No user was specified';
$titanium_lang['User_prevent_email'] = 'This user does not wish to receive e-mail. Try sending them a private message.';
$titanium_lang['User_not_exist'] = 'That user does not exist';
$titanium_lang['CC_email'] = 'Send a copy of this e-mail to yourself';
$titanium_lang['Email_message_desc'] = 'This message will be sent as plain text, so do not include any HTML or BBCode. The return address for this message will be set to your e-mail address.';
$titanium_lang['Flood_email_limit'] = 'You cannot send another e-mail at this time. Try again later.';
$titanium_lang['Recipient'] = 'Recipient';
$titanium_lang['Empty_subject_email'] = 'You must specify a subject for the e-mail.';
$titanium_lang['Empty_message_email'] = 'You must enter a message to be e-mailed.';

$titanium_lang['Login_attempts_exceeded'] = 'The maximum number of %s login attempts has been exceeded. You are not allowed to login for the next %s minutes.';
$titanium_lang['Please_remove_install_contrib'] = 'Please ensure both the install/ and contrib/ directories are deleted';
$titanium_lang['Session_invalid'] = 'Invalid Session. Please resubmit the form.';

//
// Visual confirmation system strings
//
$titanium_lang['Confirm_code_wrong'] = 'The confirmation code you entered was incorrect';
$titanium_lang['Too_many_registers'] = 'You have exceeded the number of registration attempts for this session. Please try again later.';
$titanium_lang['Confirm_code_impaired'] = 'If you are visually impaired or cannot otherwise read this code please contact the %sAdministrator%s for help.';
$titanium_lang['Confirm_code'] = 'Confirmation code';
$titanium_lang['Confirm_code_explain'] = 'Enter the code exactly as you see it. The code is case sensitive and zero has a diagonal line through it.';

//
// Memberslist
//
$titanium_lang['Select_sort_method'] = 'Sort by';
$titanium_lang['Sort'] = 'Sort';
$titanium_lang['Sort_Top_Ten'] = 'Top10 Posters';
$titanium_lang['Sort_Joined'] = 'Joined Date';
$titanium_lang['Sort_Username'] = 'Username';
$titanium_lang['Sort_User_ID'] = 'User ID';
$titanium_lang['Sort_Location'] = 'Location';
$titanium_lang['Sort_Posts'] = 'Total posts';
$titanium_lang['Sort_Email'] = 'Email';
$titanium_lang['Sort_Website'] = 'Website';
$titanium_lang['Sort_Ascending'] = 'Ascending';
$titanium_lang['Sort_Descending'] = 'Descending';
$titanium_lang['Order'] = 'Order';

//
// Group control panel
//
$titanium_lang['Group_Control_Panel'] = 'Group Control Panel';
$titanium_lang['Group_member_details'] = 'Group Membership Details';
$titanium_lang['Group_member_join'] = 'Join a Group';

$titanium_lang['Group_Information'] = 'Group Information';
$titanium_lang['Group_name'] = 'Group name';
$titanium_lang['Group_description'] = 'Group description';
$titanium_lang['Group_membership'] = 'Group membership';
$titanium_lang['Group_Members'] = 'Group Members';
$titanium_lang['Group_Moderator'] = 'Group Moderator';
$titanium_lang['Pending_members'] = 'Pending Members';

$titanium_lang['Group_type'] = 'Group type';
$titanium_lang['Group_open'] = 'Open group';
$titanium_lang['Group_closed'] = 'Closed group';
$titanium_lang['Group_hidden'] = 'Hidden group';

$titanium_lang['Current_memberships'] = 'Current memberships';
$titanium_lang['Non_member_groups'] = 'Non-member groups';
$titanium_lang['Memberships_pending'] = 'Memberships pending';

$titanium_lang['No_groups_exist'] = 'No Groups Exist';
$titanium_lang['Group_not_exist'] = 'That user group does not exist';

$titanium_lang['Join_group'] = 'Join Group';
$titanium_lang['No_group_members'] = 'This group has no members';
$titanium_lang['Group_hidden_members'] = 'This group is hidden; you cannot view its memberships';
$titanium_lang['No_pending_group_members'] = 'This group has no pending members';
$titanium_lang['Group_joined'] = 'You have successfully subscribed to this group.<br />You will be notified when your subscription is approved by the group moderator.';
$titanium_lang['Group_request'] = 'A request to join your group has been made.';
$titanium_lang['Group_approved'] = 'Your request has been approved.';
$titanium_lang['Group_added'] = 'You have been added to this usergroup.';
$titanium_lang['Already_member_group'] = 'You are already a member of this group';
$titanium_lang['User_is_member_group'] = 'User is already a member of this group';
$titanium_lang['Group_type_updated'] = 'Successfully updated group type.';

$titanium_lang['Could_not_add_user'] = 'The user you selected does not exist.';
$titanium_lang['Could_not_anon_user'] = 'You cannot make Anonymous a group member.';

$titanium_lang['Confirm_unsub'] = 'Are you sure you want to unsubscribe from this group?';
$titanium_lang['Confirm_unsub_pending'] = 'Your subscription to this group has not yet been approved; are you sure you want to unsubscribe?';

$titanium_lang['Unsub_success'] = 'You have been un-subscribed from this group.';

$titanium_lang['Approve_selected'] = 'Approve Selected';
$titanium_lang['Deny_selected'] = 'Deny Selected';
$titanium_lang['Not_logged_in'] = 'You must be logged in to join a group.';
$titanium_lang['Remove_selected'] = 'Remove Selected';
$titanium_lang['Add_member'] = 'Add Member';
$titanium_lang['Not_group_moderator'] = 'You are not this group\'s moderator, therefore you cannot perform that action.';

$titanium_lang['Login_to_join'] = 'Log in to join or manage group memberships';
$titanium_lang['This_open_group'] = '';
/*****[BEGIN]******************************************
 [ Mod:    Auto Group                          v1.2.2 ]
 ******************************************************/
//$titanium_lang['This_closed_group'] = 'This is a closed group: no more users accepted';
//$titanium_lang['This_hidden_group'] = 'This is a hidden group: automatic user addition is not allowed';
$titanium_lang['This_closed_group'] = 'This is a closed group: %s';
$titanium_lang['This_hidden_group'] = 'This is a hidden group: %s';
$titanium_lang['No_more'] = 'no more users accepted';
$titanium_lang['No_add_allowed'] = 'automatic user addition is not allowed';
$titanium_lang['Join_auto'] = 'You may join this group, since your post count meet the group criteria';
/*****[END]********************************************
 [ Mod:    Auto Group                          v1.2.2 ]
 ******************************************************/
$titanium_lang['Member_this_group'] = 'You are a member of this group';
$titanium_lang['Pending_this_group'] = 'Your membership of this group is pending';
$titanium_lang['Are_group_moderator'] = 'You are the group moderator';
$titanium_lang['None'] = 'None';

$titanium_lang['Subscribe'] = 'Subscribe';
$titanium_lang['Unsubscribe'] = 'Unsubscribe';
$titanium_lang['View_Information'] = 'View Information';

//
// Search
//
$titanium_lang['Search_query'] = 'Search Query';
$titanium_lang['Search_options'] = 'Search Options';

$titanium_lang['Search_keywords'] = 'Search for Keywords';
$titanium_lang['Search_keywords_explain'] = 'You can use <u>AND</u> to define words which must be in the results, <u>OR</u> to define words which may be in the result and <u>NOT</u> to define words which should not be in the result. Use * as a wildcard for partial matches';
$titanium_lang['Search_author'] = 'Search for Author';
$titanium_lang['Search_author_explain'] = 'Use * as a wildcard for partial matches';

$titanium_lang['Search_for_any'] = 'Search for any terms or use query as entered';
$titanium_lang['Search_for_all'] = 'Search for all terms';
$titanium_lang['Search_title_msg'] = 'Search topic title and message text';
$titanium_lang['Search_msg_only'] = 'Search message text only';

$titanium_lang['Return_first'] = 'Return first'; // followed by xxx characters in a select box
$titanium_lang['characters_posts'] = 'characters of posts';

$titanium_lang['Search_previous'] = 'Search previous'; // followed by days, weeks, months, year, all in a select box

$titanium_lang['Sort_by'] = 'Sort by';
$titanium_lang['Sort_Time'] = 'Post Time';
$titanium_lang['Sort_Post_Subject'] = 'Post Subject';
$titanium_lang['Sort_Topic_Title'] = 'Topic Title';
$titanium_lang['Sort_Author'] = 'Author';
$titanium_lang['Sort_Forum'] = 'Forum';

$titanium_lang['Display_results'] = 'Display results as';
$titanium_lang['All_available'] = 'All available';
$titanium_lang['not_available'] = 'Not available';
$titanium_lang['No_searchable_forums'] = 'You do not have permissions to search any forum on this site.';

$titanium_lang['No_search_match'] = 'No topics or posts met your search criteria';
$titanium_lang['Found_search_match'] = 'Search found %d match'; // eg. Search found 1 match
$titanium_lang['Found_search_matches'] = 'Search found %d matches'; // eg. Search found 24 matches
$titanium_lang['Search_Flood_Error'] = 'You cannot make another search so soon after your last; please try again in a short while.';

$titanium_lang['Close_window'] = 'Close Window';

//
// Auth related entries
//
// Note the %s will be replaced with one of the following 'user' arrays
$titanium_lang['Sorry_auth_announce'] = 'Sorry, but only %s can post announcements in this forum.';
$titanium_lang['Sorry_auth_sticky'] = 'Sorry, but only %s can post sticky messages in this forum.';
$titanium_lang['Sorry_auth_read'] = 'Sorry, but only %s can read topics in this forum.';
$titanium_lang['Sorry_auth_post'] = 'Sorry, but only %s can post topics in this forum.';
$titanium_lang['Sorry_auth_reply'] = 'Sorry, but only %s can reply to posts in this forum.';
$titanium_lang['Sorry_auth_edit'] = 'Sorry, but only %s can edit posts in this forum.';
$titanium_lang['Sorry_auth_delete'] = 'Sorry, but only %s can delete posts in this forum.';
$titanium_lang['Sorry_auth_vote'] = 'Sorry, but only %s can vote in polls in this forum.';

// These replace the %s in the above strings
$titanium_lang['Auth_Anonymous_Users'] = '<strong>anonymous users</strong>';
$titanium_lang['Auth_Registered_Users'] = '<strong>registered members</strong>';
$titanium_lang['Auth_Users_granted_access'] = '<strong>users granted special access</strong>';
$titanium_lang['Auth_Moderators'] = '<strong>moderators</strong>';
$titanium_lang['Auth_Administrators'] = '<strong>administrators</strong>';

$titanium_lang['Not_Moderator'] = 'You are not a moderator of this forum.';
$titanium_lang['Not_Authorised'] = 'Not Authorised';

$titanium_lang['You_been_banned'] = 'You have been banned from this forum.<br />Please contact the webmaster or board administrator for more information.';

//
// Viewonline
//
$titanium_lang['Reg_users_zero_online'] = 'There are 0 Registered users and '; // There are 5 Registered and
$titanium_lang['Reg_users_online'] = 'There are %d Registered users and '; // There are 5 Registered and
$titanium_lang['Reg_user_online'] = 'There is %d Registered user and '; // There is 1 Registered and
$titanium_lang['Hidden_users_zero_online'] = '0 Hidden users online'; // 6 Hidden users online
$titanium_lang['Hidden_users_online'] = '%d Hidden users online'; // 6 Hidden users online
$titanium_lang['Hidden_user_online'] = '%d Hidden user online'; // 6 Hidden users online
$titanium_lang['Guest_users_online'] = 'There are %d Guest users online'; // There are 10 Guest users online
$titanium_lang['Guest_users_zero_online'] = 'There are 0 Guest users online'; // There are 10 Guest users online
$titanium_lang['Guest_user_online'] = 'There is %d Guest user online'; // There is 1 Guest user online
$titanium_lang['No_users_browsing'] = 'There are no users currently browsing this forum';

/*****[BEGIN]******************************************
 [ Mod:    Online Time                         v1.0.0 ]
 ******************************************************/
$titanium_lang['Online_explain'] = 'Based on users active over the past ' . ( ($phpbb2_board_config['online_time']/60)%60 ) . ' minutes';
/*****[END]********************************************
 [ Mod:    Online Time                         v1.0.0 ]
 ******************************************************/

$titanium_lang['Forum_Location'] = 'Forum Location';
$titanium_lang['Last_updated'] = 'Last Updated';
$titanium_lang['Group_List_Info'] = 'Group Information';
$titanium_lang['Group_List_Title'] = '<h1>Available Member Groups</h1>';
$titanium_lang['Forum_index'] = 'Forum index';
$titanium_lang['Logging_on'] = 'Logging on';
$titanium_lang['Posting_message'] = 'Posting a message';
$titanium_lang['Searching_forums'] = 'Searching forums';
$titanium_lang['Viewing_profile'] = 'Viewing profile';
$titanium_lang['Viewing_online'] = 'Viewing who is online';
$titanium_lang['Viewing_member_list'] = 'Viewing member list';
$titanium_lang['Viewing_priv_msgs'] = 'Viewing Private Messages';
$titanium_lang['Viewing_FAQ'] = 'Viewing FAQ';

//
// Moderator Control Panel
//
$titanium_lang['Mod_CP'] = 'Moderator Control Panel';
$titanium_lang['Mod_CP_explain'] = 'Using the form below you can perform mass moderation operations on this forum. You can lock, unlock, move, delete or prioritise any number of topics.';

$titanium_lang['Select'] = 'Select';
$titanium_lang['Delete'] = 'Delete';
$titanium_lang['Move'] = 'Move';
$titanium_lang['Lock'] = 'Lock';
$titanium_lang['Unlock'] = 'Unlock';

$titanium_lang['Topics_Removed'] = 'The selected topics have been successfully removed from the database.';
$titanium_lang['Topics_Locked'] = 'The selected topics have been locked.';
$titanium_lang['Topics_Moved'] = 'The selected topics have been moved.';
$titanium_lang['Topics_Unlocked'] = 'The selected topics have been unlocked.';
$titanium_lang['No_Topics_Moved'] = 'No topics were moved.';
/*****[BEGIN]******************************************
 [ Mod:    Topic Cement                        v1.0.3 ]
 ******************************************************/
$titanium_lang['Topics_Prioritized'] = 'The selected topics have been prioritized.';
$titanium_lang['Priority'] = 'Priority';
$titanium_lang['Prioritize'] = 'Prioritize';
/*****[END]********************************************
 [ Mod:    Topic Cement                        v1.0.3 ]
 ******************************************************/

$titanium_lang['Confirm_delete_topic'] = 'Are you sure you want to remove the selected topic/s?';
$titanium_lang['Confirm_lock_topic'] = 'Are you sure you want to lock the selected topic/s?';
$titanium_lang['Confirm_unlock_topic'] = 'Are you sure you want to unlock the selected topic/s?';
$titanium_lang['Confirm_move_topic'] = 'Are you sure you want to move the selected topic/s?';

$titanium_lang['Move_to_forum'] = 'Move to forum';
$titanium_lang['Leave_shadow_topic'] = 'Leave shadow topic in old forum.';

$titanium_lang['Split_Topic'] = 'Split Topic Control Panel';
$titanium_lang['Split_Topic_explain'] = 'Using the form below you can split a topic in two, either by selecting the posts individually or by splitting at a selected post';
$titanium_lang['Split_title'] = 'New topic title';
$titanium_lang['Split_forum'] = 'Forum for new topic';
$titanium_lang['Split_posts'] = 'Split selected posts';
$titanium_lang['Split_after'] = 'Split from selected post';
$titanium_lang['Topic_split'] = 'The selected topic has been split successfully';

$titanium_lang['Too_many_error'] = 'You have selected too many posts. You can only select one post to split a topic after!';

$titanium_lang['None_selected'] = 'You have not selected any topics to perform this operation on. Please go back and select at least one.';
$titanium_lang['New_forum'] = 'New forum';

$titanium_lang['This_posts_IP'] = 'IP address for this post';
$titanium_lang['Other_IP_this_user'] = 'Other IP addresses this user has posted from';
$titanium_lang['Users_this_IP'] = 'Users posting from this IP address';
$titanium_lang['IP_info'] = 'IP Information';
$titanium_lang['Lookup_IP'] = 'Look up IP address';

//
// Timezones ... for display on each page
//
$titanium_lang['All_times'] = 'All times are %s'; // eg. All times are GMT - 12 Hours (times from next block)

$titanium_lang['-12'] = 'GMT - 12 Hours';
$titanium_lang['-11'] = 'GMT - 11 Hours';
$titanium_lang['-10'] = 'GMT - 10 Hours';
$titanium_lang['-9'] = 'GMT - 9 Hours';
$titanium_lang['-8'] = 'GMT - 8 Hours';
$titanium_lang['-7'] = 'GMT - 7 Hours';
$titanium_lang['-6'] = 'GMT - 6 Hours';
$titanium_lang['-5'] = 'GMT - 5 Hours';
$titanium_lang['-4'] = 'GMT - 4 Hours';
$titanium_lang['-3.5'] = 'GMT - 3.5 Hours';
$titanium_lang['-3'] = 'GMT - 3 Hours';
$titanium_lang['-2'] = 'GMT - 2 Hours';
$titanium_lang['-1'] = 'GMT - 1 Hours';
$titanium_lang['0'] = 'GMT';
$titanium_lang['1'] = 'GMT + 1 Hour';
$titanium_lang['2'] = 'GMT + 2 Hours';
$titanium_lang['3'] = 'GMT + 3 Hours';
$titanium_lang['3.5'] = 'GMT + 3.5 Hours';
$titanium_lang['4'] = 'GMT + 4 Hours';
$titanium_lang['4.5'] = 'GMT + 4.5 Hours';
$titanium_lang['5'] = 'GMT + 5 Hours';
$titanium_lang['5.5'] = 'GMT + 5.5 Hours';
$titanium_lang['6'] = 'GMT + 6 Hours';
$titanium_lang['6.5'] = 'GMT + 6.5 Hours';
$titanium_lang['7'] = 'GMT + 7 Hours';
$titanium_lang['8'] = 'GMT + 8 Hours';
$titanium_lang['9'] = 'GMT + 9 Hours';
$titanium_lang['9.5'] = 'GMT + 9.5 Hours';
$titanium_lang['10'] = 'GMT + 10 Hours';
$titanium_lang['11'] = 'GMT + 11 Hours';
$titanium_lang['12'] = 'GMT + 12 Hours';
$titanium_lang['13'] = 'GMT + 13 Hours';

// These are displayed in the timezone select box
$titanium_lang['tz']['-12'] = 'GMT - 12 Hours';
$titanium_lang['tz']['-11'] = 'GMT - 11 Hours';
$titanium_lang['tz']['-10'] = 'GMT - 10 Hours';
$titanium_lang['tz']['-9'] = 'GMT - 9 Hours';
$titanium_lang['tz']['-8'] = 'GMT - 8 Hours';
$titanium_lang['tz']['-7'] = 'GMT - 7 Hours';
$titanium_lang['tz']['-6'] = 'GMT - 6 Hours';
$titanium_lang['tz']['-5'] = 'GMT - 5 Hours';
$titanium_lang['tz']['-4'] = 'GMT - 4 Hours';
$titanium_lang['tz']['-3.5'] = 'GMT - 3.5 Hours';
$titanium_lang['tz']['-3'] = 'GMT - 3 Hours';
$titanium_lang['tz']['-2'] = 'GMT - 2 Hours';
$titanium_lang['tz']['-1'] = 'GMT - 1 Hours';
$titanium_lang['tz']['0'] = 'GMT';
$titanium_lang['tz']['1'] = 'GMT + 1 Hour';
$titanium_lang['tz']['2'] = 'GMT + 2 Hours';
$titanium_lang['tz']['3'] = 'GMT + 3 Hours';
$titanium_lang['tz']['3.5'] = 'GMT + 3.5 Hours';
$titanium_lang['tz']['4'] = 'GMT + 4 Hours';
$titanium_lang['tz']['4.5'] = 'GMT + 4.5 Hours';
$titanium_lang['tz']['5'] = 'GMT + 5 Hours';
$titanium_lang['tz']['5.5'] = 'GMT + 5.5 Hours';
$titanium_lang['tz']['6'] = 'GMT + 6 Hours';
$titanium_lang['tz']['6.5'] = 'GMT + 6.5 Hours';
$titanium_lang['tz']['7'] = 'GMT + 7 Hours';
$titanium_lang['tz']['8'] = 'GMT + 8 Hours';
$titanium_lang['tz']['9'] = 'GMT + 9 Hours';
$titanium_lang['tz']['9.5'] = 'GMT + 9.5 Hours';
$titanium_lang['tz']['10'] = 'GMT + 10 Hours';
$titanium_lang['tz']['11'] = 'GMT + 11 Hours';
$titanium_lang['tz']['12'] = 'GMT + 12 Hours';
$titanium_lang['tz']['13'] = 'GMT + 13 Hours';

$titanium_lang['datetime']['Sunday'] = 'Sunday';
$titanium_lang['datetime']['Monday'] = 'Monday';
$titanium_lang['datetime']['Tuesday'] = 'Tuesday';
$titanium_lang['datetime']['Wednesday'] = 'Wednesday';
$titanium_lang['datetime']['Thursday'] = 'Thursday';
$titanium_lang['datetime']['Friday'] = 'Friday';
$titanium_lang['datetime']['Saturday'] = 'Saturday';
$titanium_lang['datetime']['Sun'] = 'Sun';
$titanium_lang['datetime']['Mon'] = 'Mon';
$titanium_lang['datetime']['Tue'] = 'Tue';
$titanium_lang['datetime']['Wed'] = 'Wed';
$titanium_lang['datetime']['Thu'] = 'Thu';
$titanium_lang['datetime']['Fri'] = 'Fri';
$titanium_lang['datetime']['Sat'] = 'Sat';
$titanium_lang['datetime']['January'] = 'January';
$titanium_lang['datetime']['February'] = 'February';
$titanium_lang['datetime']['March'] = 'March';
$titanium_lang['datetime']['April'] = 'April';
$titanium_lang['datetime']['May'] = 'May';
$titanium_lang['datetime']['June'] = 'June';
$titanium_lang['datetime']['July'] = 'July';
$titanium_lang['datetime']['August'] = 'August';
$titanium_lang['datetime']['September'] = 'September';
$titanium_lang['datetime']['October'] = 'October';
$titanium_lang['datetime']['November'] = 'November';
$titanium_lang['datetime']['December'] = 'December';
$titanium_lang['datetime']['Jan'] = 'Jan';
$titanium_lang['datetime']['Feb'] = 'Feb';
$titanium_lang['datetime']['Mar'] = 'Mar';
$titanium_lang['datetime']['Apr'] = 'Apr';
$titanium_lang['datetime']['May'] = 'May';
$titanium_lang['datetime']['Jun'] = 'Jun';
$titanium_lang['datetime']['Jul'] = 'Jul';
$titanium_lang['datetime']['Aug'] = 'Aug';
$titanium_lang['datetime']['Sep'] = 'Sep';
$titanium_lang['datetime']['Oct'] = 'Oct';
$titanium_lang['datetime']['Nov'] = 'Nov';
$titanium_lang['datetime']['Dec'] = 'Dec';

//
// Errors (not related to a
// specific failure on a page)
//
$titanium_lang['Information'] = 'Information';
$titanium_lang['Critical_Information'] = 'Critical Information';

$titanium_lang['General_Error'] = 'General Error';
$titanium_lang['Critical_Error'] = 'Critical Error';
$titanium_lang['An_error_occured'] = 'An Error Occurred';
$titanium_lang['A_critical_error'] = 'A Critical Error Occurred';
/*****[BEGIN]******************************************
 [ Mod:     Super Quick Reply                  v1.3.2 ]
 ******************************************************/
$titanium_lang['Quick_reply_panel'] = 'Super Quick Reply Mod';
$titanium_lang['Quick_Reply'] = 'Quick Reply';
$titanium_lang['Show_quick_reply'] = 'Show Quick Reply Form';
$titanium_lang['sqr']['0'] = 'No';
$titanium_lang['sqr']['1'] = 'Yes';
$titanium_lang['sqr']['2'] = 'On last page only';
$titanium_lang['Quick_reply_mode'] = 'Quick Reply Mode';
$titanium_lang['Quick_reply_mode_basic'] = 'Basic';
$titanium_lang['Quick_reply_mode_advanced'] = 'Advanced';
$titanium_lang['Show_hide_quick_reply_form'] = 'Show/hide quick reply form';
$titanium_lang['Open_quick_reply'] = 'Open Quick Reply Form automatically';
/*****[END]********************************************
 [ Mod:     Super Quick Reply                  v1.3.2 ]
 ******************************************************/

$titanium_lang['Admin_reauthenticate'] = 'To administer the board you must re-authenticate yourself.';

/*****[BEGIN]******************************************
 [ Base:    Recent Topics                      v1.2.4 ]
 ******************************************************/
$titanium_lang['Recent_topics'] = '<strong>Recent Topics</strong>';
$titanium_lang['Recent_today'] = 'Today';
$titanium_lang['Recent_yesterday'] = 'Yesterday';
$titanium_lang['Recent_last24'] = 'Last 24 Hours';
$titanium_lang['Recent_lastweek'] = 'Last Week';
$titanium_lang['Recent_lastXdays'] = 'Last %s days';
$titanium_lang['Recent_last'] = 'Last';
$titanium_lang['Recent_days'] = 'Days';
$titanium_lang['Recent_first'] = 'started at %s';
$titanium_lang['Recent_first_poster'] = ' by %s';
$titanium_lang['Recent_started_by'] = 'Started by %s';
$titanium_lang['Recent_select_mode'] = 'Select mode:';
$titanium_lang['Recent_showing_posts'] = 'Showing Posts:';
$titanium_lang['Recent_title_one'] = '<font size=4>%s</font> topic %s'; // %s = topics; %s = sort method
$titanium_lang['Recent_title_more'] = '<font size=4>%s</font> topics %s'; // %s = topics; %s = sort method
$titanium_lang['Recent_title_today'] = ' from today';
$titanium_lang['Recent_title_yesterday'] = ' from yesterday';
$titanium_lang['Recent_title_last24'] = ' from the last 24 hours';
$titanium_lang['Recent_title_lastweek'] = ' from the last week';
$titanium_lang['Recent_title_lastXdays'] = ' from the last %s days'; // %s = days
$titanium_lang['Recent_no_topics'] = 'No topics were found.';
$titanium_lang['Recent_wrong_mode'] = 'You have selected a wrong mode.';
$titanium_lang['Recent_click_return'] = 'Click %shere%s to return to recent site.';
/*****[END]********************************************
 [ Base:    Recent Topics                      v1.2.4 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Global Announcements               v1.2.8 ]
 ******************************************************/
$titanium_lang['Topic_global_announcement']='<strong>Global Portal Announcement:</strong>';
$titanium_lang['Post_global_announcement'] = 'Global Portal Announcement';
/*****[END]********************************************
 [ Mod:     Global Announcements               v1.2.8 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Select Expand BBcodes              v1.2.8 ]
 ******************************************************/
$titanium_lang['Select'] = 'Select';
$titanium_lang['Expand'] = 'Expand';
$titanium_lang['Contract'] = 'Contract';
/*****[END]********************************************
 [ Mod:     Select Expand BBcodes              v1.2.8 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Base:    Cache phpBB version in ACP         v1.0.0 ]
 ******************************************************/
$titanium_lang['Version_check'] = 'Check for newest version';
/*****[END]********************************************
 [ Base:    Cache phpBB version in ACP         v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Search Only Subject                 v0.9.1 ]
 ******************************************************/
$titanium_lang['Search_subject_only'] = 'Search message subject only';
/*****[END]********************************************
 [ Mod:    Search Only Subject                 v0.9.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     View/Disable Avatars/Signatures    v1.1.2 ]
 ******************************************************/
$titanium_lang['Show_avatars'] = 'Show Avatars in Topic';
$titanium_lang['Show_signatures'] = 'Show Signatures in Topic';
/*****[END]********************************************
 [ Mod:     View/Disable Avatars/Signatures    v1.1.2 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Quick Search                    v2.1.1 RC ]
 ******************************************************/
$titanium_lang['Quick_search_for'] = 'Search for';
$titanium_lang['Quick_search_at'] = 'at';
// In this case, the %s displays the Site Name as defined in the ACP. e.g. phpBB.com Advanced Search
$titanium_lang['Forum_advanced_search'] = '%s Advanced Search';
/*****[END]********************************************
 [ Mod:     Quick Search                    v2.1.1 RC ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Signature Editor/Preview Deluxe    v1.0.0 ]
 ******************************************************/
$titanium_lang['sig_description'] = 'Edit Signature (<strong>Preview included</strong>)';
$titanium_lang['sig_edit'] = 'Edit Signature';
$titanium_lang['sig_current'] = 'Current Signature';
$titanium_lang['sig_none'] = 'No Signature available';
$titanium_lang['sig_save'] = 'Save';
$titanium_lang['sig_save_message'] = 'Signature saved successful !';
/*****[END]********************************************
 [ Mod:     Signature Editor/Preview Deluxe    v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Separate Announcements & Sticky   v2.0.0a ]
 ******************************************************/
$titanium_lang['Global_Announcements'] = 'Global Announcements';
$titanium_lang['Announcements'] = 'Announcements';
$titanium_lang['Sticky_Topics'] = 'Sticky Topics';
/*****[END]********************************************
 [ Mod:     Separate Announcements & Sticky   v2.0.0a ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Staff Site                         v2.0.3 ]
 ******************************************************/
$titanium_lang['Staff'] = 'Staff';
$titanium_lang['Forums'] = 'Forums';
$titanium_lang['Mod'] = 'Moderator';
$titanium_lang['Admin'] = 'Administrator';
$titanium_lang['Super'] = 'Super Moderator';
$titanium_lang['Junior'] = 'Junior Admin';
$titanium_lang['Period'] = 'since <strong>%d</strong> days'; // %d = days
$titanium_lang['Messenger'] = 'Messenger';
/*****[END]********************************************
 [ Mod:     Staff Site                         v2.0.3 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Better Session Handling             v1.0.0 ]
 ******************************************************/
$titanium_lang['BSH_Viewing_Topic'] = 'Viewing Topic: %t%';
$titanium_lang['BSH_Viewing_Post'] = '%sViewing A Post%s';
$titanium_lang['BSH_Viewing_Profile'] = 'Viewing %u%\'s Profile';
$titanium_lang['BSH_Viewing_Groups'] = '%sViewing Groups%s';
$titanium_lang['BSH_Viewing_Forums'] = 'Viewing Forum: %f%';
$titanium_lang['BSH_Index'] = '%sViewing Index%s';
$titanium_lang['BSH_Searching_Forums'] = '%sSearching Forums%s';
$titanium_lang['BSH_Viewing_Onlinelist'] = '%sViewing Online List%s';
$titanium_lang['BSH_Viewing_Messages'] = '%sViewing Private Messages%s';
$titanium_lang['BSH_Viewing_Memberlist'] = '%sViewing Memberlist%s';
$titanium_lang['BSH_Login'] = '%sLogging In%s';
$titanium_lang['BSH_Logout'] = '%sLogging Out%s';
$titanium_lang['BSH_Editing_Profile'] = '%sEditing Profile%s';
$titanium_lang['BSH_Viewing_ACP'] = '%sViewing ACP%s';
$titanium_lang['BSH_Moderating_Forum'] = '%sModerating Forums%s';
$titanium_lang['BSH_Viewing_FAQ'] = '%sViewing FAQ%s';
$titanium_lang['BSH_Viewing_Category'] = 'Viewing Category: %c%';

#==== Start: Language Integrations
$titanium_lang['BSH_Viewing_Tree'] = '%sViewing Forum Tree%s';
$titanium_lang['BSH_Viewing_Spiders'] = '%sViewing Search Spiders Log%s';
$titanium_lang['BSH_Viewing_BACP'] = '%sViewing Blend ACP%s';
#==== End: Language Integrations
/*****[END]********************************************
 [ Mod:    Better Session Handling             v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Disable Board Admin Override        v0.1.1 ]
 ******************************************************/
$titanium_lang['Board_Currently_Disabled'] = 'Board is currently disabled';
/*****[END]********************************************
 [ Mod:    Disable Board Admin Override        v0.1.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Memberlist Find User                v1.0.0 ]
 ******************************************************/
$titanium_lang['Look_up_User'] = 'Look up Member';
/*****[END]********************************************
 [ Mod:    Memberlist Find User                v1.0.0 ] 
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Theme Simplifications              v1.0.0 ]
 ******************************************************/
$titanium_lang['Mini_Index'] = 'Forums';
$titanium_lang['Rules'] = 'Board Rules';
$titanium_lang['Login_Logout'] = 'Login / Logout';
/*****[END]********************************************
 [ Mod:     Theme Simplifications              v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Welcome PM                         v2.0.0 ]
 ******************************************************/
$titanium_lang['Welcome_PM'] = 'Set as the Welcome PM';
$titanium_lang['Welcome_PM_Set'] = 'Your Welcome PM has been set';
$titanium_lang['Welcome_PM_Admin'] = 'Welcome PM';
/*****[END]********************************************
 [ Mod:     Welcome PM                         v2.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Limit smilies per post             v1.0.2 ]
 ******************************************************/
$titanium_lang['Max_smilies_per_post'] = 'You can only use maximum %s smilies per post.<br />You have %s smilies too much in use.';
/*****[END]********************************************
 [ Mod:     Limit smilies per post             v1.0.2 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     YA Merge                           v1.0.0 ]
 ******************************************************/
 $titanium_lang['Real_Name'] = 'Real Name';
 $titanium_lang['Newsletter'] = 'Receive Newsletter by Email?';
 $titanium_lang['Extra_Info'] = 'Extra Info';
 $titanium_lang['Error_Check_Num'] = "Invalid check number<br /><br />You will need to register again<br /><br />Click <a href=\"%s\">here</a> to register";
/*****[END]********************************************
 [ Mod:     YA Merge                           v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Log Moderator Actions              v1.1.6 ]
 ******************************************************/
$titanium_lang['Move_merge_message'] = 'Merged: <strong>%s</strong> by <strong>%s</strong><br />From Topic <strong>%s</strong> (<strong>%s</strong>)';
$titanium_lang['Move_move_message'] = 'Moved: <strong>%s</strong> by <strong>%s</strong><br />From <strong>%s</strong> to <strong>%s</strong>';
$titanium_lang['Move_lock_message'] = 'Locked: <strong>%s</strong> by <strong>%s</strong>';
$titanium_lang['Move_edit_message'] = 'Edited: <strong>%s</strong> by <strong>%s</strong>';
$titanium_lang['Move_unlock_message'] = 'Unlocked: <strong>%s</strong> by <strong>%s</strong>';
$titanium_lang['Move_split_message'] = 'Splitted: <strong>%s</strong> by <strong>%s</strong><br />From Topic <strong>%s</strong> (<strong>%s</strong>)';
$titanium_lang['Close_window'] = 'Close the window';
$titanium_lang['Rules_title'] = 'Action : %s';
$titanium_lang['Locking_topic'] = 'Locking a topic';
$titanium_lang['Unlocking_topic'] = 'Unlocking a topic';
$titanium_lang['Spliting_topic'] = 'Splitting a topic';
$titanium_lang['Moving_topic'] = 'Moving a topic';
$titanium_lang['Deleting_topic'] = 'Deleting a topic';
$titanium_lang['Editing_topic'] = 'Editing a topic';
$titanium_lang['Lock_Explication'] = 'When a Moderator/Administrator locks a topic, it\'s not possible for a normal user to reply. But Moderators/Administrators can still continue to post.';
$titanium_lang['Unlock_Explication'] = 'A Moderator/Administrator can unlock a topic which has been locked. This will allow all users to continue to post in the thread.';
$titanium_lang['Split_Explication'] = 'Splitting a topic which has a lot of pages gives you the ability to keep your topics more organized.';
$titanium_lang['Move_Explication'] = 'If you choose to move a topic, you will be able to send the topic, which is in a forum A, to a forum B. You can also choose to leave a Shadow Topic in the forum A.';
$titanium_lang['Delete_Explication'] = 'If a Moderator/Administrator deletes a topic, it will no longer be displayed on the forum and nobody will be able to restore it. <br /><strong>Be careful with this function</strong>';
$titanium_lang['Edit_Explication'] = 'By editing a post, an Administrator and/or a Moderator can change what a user has written in the post.';
$titanium_lang['No_action_specified'] = 'There is no action specified';
/*****[END]********************************************
 [ Mod:     Log Moderator Actions              v1.1.6 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/
$titanium_lang['true'] = 'True';
$titanium_lang['false'] = 'False';

$titanium_lang['XData_too_long'] = 'Your %s is too long.';
$titanium_lang['XData_invalid'] = 'The value you entered for %s is invalid.';

$titanium_lang['XData_error_obtaining_userdata'] = 'Error while finding  a user\'s XData field to edit it';
$titanium_lang['XData_failure_removing_data'] = 'Failure to remove specefied data';
$titanium_lang['XData_failure_inserting_data'] = 'Failure to add specefied data';
$titanium_lang['XData_error_obtaining_user_xdata'] = 'Error obtaining user\'s XData';
$titanium_lang['XData_failure_obtaining_field_data'] = 'Error obtaining field data';
$titanium_lang['XData_failure_obtaining_field_auth'] = 'Error obtaining field auths';
$titanium_lang['XData_failure_obtaining_user_auth'] = 'Error obtaining auth for user';
$titanium_lang['XData_error_obtaining_usergroup'] = 'Error obtaining usergroup';
$titanium_lang['XData_error_obtaining_group_data'] = 'Error obtaining group data';
$titanium_lang['XData_error_updating_auth'] = 'Error updating auth table';
$titanium_lang['XData_error_updating_fields'] = 'Error updating field table';
$titanium_lang['XData_success_updating_permissions'] = "Permissions updated successfully <br /><br /> Click %shere%s to return to Field Permissions <br /><br />";
$titanium_lang['XData_error_obtaining_new_field_info'] = 'Could not get field_order and field_id for new field.';

$titanium_lang['XData_no_field_selected'] = 'You have not selected a field';
$titanium_lang['XData_field_non_existant'] = 'Field does not exist';
$titanium_lang['XData_unable_to_switch_fields'] = 'Unable to switch fields';
/*****[END]********************************************
 [ Mod:     XData                              v1.0.3 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     At a Glance Options                v1.0.0 ]
 ******************************************************/
$titanium_lang['show_glance_option']['1']    = 'All';
$titanium_lang['show_glance_option']['0']    = 'None';
$titanium_lang['show_glance_option']['2']    = 'Index Only';
$titanium_lang['show_glance_option']['3']    = 'Forums Only';
$titanium_lang['show_glance_option']['4']    = 'Topics Only';
$titanium_lang['show_glance_option']['5']    = 'Index and Topics';
$titanium_lang['show_glance_option']['6']    = 'Index and Forums';
$titanium_lang['show_glance_option']['7']    = 'Forums and Topics';
$titanium_lang['glance_show']                = 'Show At a Glance (Recent Topics)<br />';

$titanium_lang['glance_alternate_row']       = 'Alternate Glance Row Class';
$titanium_lang['glance_alternate_row_explain'] = 'Will alternate between row1 & row3 pre-defined colors in the theme CSS.';

/*****[END]********************************************
 [ Mod:     At a Glance Options                v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Extended Quote Tag                 v1.0.0 ]
 ******************************************************/
$titanium_lang['View_post'] = 'View Post';
$titanium_lang['Post_review'] = 'Post Review';
$titanium_lang['View_next_post'] = 'View next Post';
$titanium_lang['View_previous_post'] = 'View previous Post';
$titanium_lang['No_newer_posts'] = 'There are no newer posts in this forum';
$titanium_lang['No_older_posts'] = 'There are no older posts in this forum';
/*****[END]********************************************
 [ Mod:     Extended Quote Tag                 v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     At a Glance Cement                 v1.0.0 ]
 ******************************************************/
$titanium_lang['topic_glance_priority'] = 'Cement this topic on the Recent Topics Display';
/*****[END]********************************************
 [ Mod:     At a Glance Cement                 v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Online/Offline/Hidden              v2.2.7 ]
 ******************************************************/
$titanium_lang['Online'] = 'Online';
$titanium_lang['Offline'] = 'Offline';
$titanium_lang['Hidden'] = 'Hidden';
$titanium_lang['is_online'] = '%s is online now';
$titanium_lang['is_offline'] = '%s is offline';
$titanium_lang['is_hidden'] = '%s is hidden';
$titanium_lang['Online_status'] = 'Currently';
$titanium_lang['Current_status'] = 'Currently Online';
/*****[END]********************************************
 [ Mod:     Online/Offline/Hidden              v2.2.7 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Hide Images and Links              v1.0.0 ]
 ******************************************************/
$titanium_lang['Images_Allowed_For_Registered_Only'] = 'Please login to see this image.';
$titanium_lang['Links_Allowed_For_Registered_Only'] = 'Please login to see this link';
$titanium_lang['Emails_Allowed_For_Registered_Only'] = 'Please login to see this email';
$titanium_lang['Get_Registered'] = 'Get %sregistered%s or ';
$titanium_lang['Image_Blocked'] = 'You have chosen to block images.<br />%sEdit Your Profile%s';
$titanium_lang['Enter_Forum'] = '%senter%s the forums!';
/*****[END]********************************************
 [ Mod:     Hide Images and Links              v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Report Posts                       v1.2.3 ]
 ******************************************************/
$titanium_lang['Post_reports_none_cp'] = 'There aren\'t any open Reported Posts';
$titanium_lang['Post_reports_one_cp'] = 'There is %s open Reported Post';
$titanium_lang['Post_reports_many_cp'] = 'There are %s open Reported Posts';

$titanium_lang['All'] = 'All';
$titanium_lang['Display'] = 'Display only';
$titanium_lang['Report_post'] = 'Report Post';

$titanium_lang['Reporter'] = 'Reporter';
$titanium_lang['Status'] = 'Status';
$titanium_lang['Select_one'] = 'Select One';

$titanium_lang['Opt_in'] = 'Opt in to receive emails when a report is submitted';
$titanium_lang['Opt_out'] = 'Opt out so you don\'t receive emails when a report is submitted';

$titanium_lang['Post_reported'] = 'Post report submitted successfully.';
$titanium_lang['Close_success'] = 'Reports were Opened/Closed successfully.';
$titanium_lang['Opt_success'] = 'You have opt out/in successfully.';
$titanium_lang['Delete_success'] = 'Reports were deleted successfully.';
$titanium_lang['Click_return_reports'] = 'Click %shere%s to return to the Report Posts control panel.';
$titanium_lang['Report_email'] = 'Send Email when Post Reported';

$titanium_lang['Post_already_reported'] = 'This post has already been reported.';

$titanium_lang['Report_not_selected'] = 'You haven\'t selected any reports.';

$titanium_lang['Comments'] = 'Comments';
$titanium_lang['Last_action_comments'] = 'Comments from Moderators';
$titanium_lang['Last_action_comments_explain'] = 'Please write some comments about your action on this specific report';
$titanium_lang['Comments_explain'] = 'Please write some comments about your report on this specific post.';

$titanium_lang['Action'] = 'Action';
$titanium_lang['Report_comment'] = 'Comments regarding your action';
$titanium_lang['Previous_comments'] = 'Previous comments';

$titanium_lang['Last_action_checkbox'] = 'This action was done through the checkbox and drop down menu.';

$titanium_lang['Opened_by_user_on_date'] = 'Opened by %s on %s';
$titanium_lang['Closed_by_user_on_date'] = 'Closed by %s on %s';
$titanium_lang['Opened'] = 'Open';
$titanium_lang['Closed'] = 'Closed';
$titanium_lang['Open'] = 'Open';
$titanium_lang['Close'] = 'Close';

$titanium_lang['Non_existent_posts'] = 'Found and deleted %s leftover report(s) pointing to non-existent (deleted) posts';

$titanium_lang['Theme'] = 'Theme';

/*****[END]********************************************
 [ Mod:     Report Posts                       v1.2.3 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Show Groups                        v1.0.1 ]
 ******************************************************/
//$titanium_lang['Groups'] = 'Member Of';
/*****[END]********************************************
 [ Mod:     Show Groups                        v1.0.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Hide Images                        v1.0.0 ]
 ******************************************************/
$titanium_lang['user_hide_images'] = 'Hide Images in Forums';
/*****[END]********************************************
 [ Mod:     Hide Images                        v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Advanced BBCode Box               v5.0.0a ]
 ******************************************************/
$titanium_lang['BBCode_box_hidden'] = 'Hidden';
$titanium_lang['BBcode_box_view'] = 'Click to View Content';
$titanium_lang['BBcode_box_hide'] = 'Click to Hide Content';
/*****[END]********************************************
 [ Mod:     Advanced BBCode Box               v5.0.0a ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/
$titanium_lang['Subforums'] = 'Sub Forums';
/*****[END]********************************************
 [ Mod:    Simple Subforums                    v1.0.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Member Country Flags               v2.0.7 ]
 ******************************************************/
$titanium_lang['Country_Flag'] = "Country Flag";
$titanium_lang['Select_Country'] = "SELECT COUNTRY" ;
/*****[END]********************************************
 [ Mod:     Member Country Flags               v2.0.7 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Multiple Ranks And Staff View       v2.0.3 ]
 ******************************************************/
$titanium_lang['Staff'] = 'Staff';
$titanium_lang['Rank'] = 'Rank';
$titanium_lang['Rank_Header'] = 'Ranks';
$titanium_lang['Rank_Image'] = 'Rank Image';
$titanium_lang['Rank_Posts_Count'] = 'Automatic ranking by posts';
$titanium_lang['Rank_Days_Count'] = 'Automatic ranking by days';
$titanium_lang['Rank_Min_Des'] = 'Minimum messages/days';
$titanium_lang['Rank_Min_M'] = 'Minimum Messages';
$titanium_lang['Rank_Max_M'] = 'Max Messages';
$titanium_lang['Rank_Min_D'] = 'Minimum Days';
$titanium_lang['Rank_Max_D'] = 'Max Days';
$titanium_lang['Rank_Special'] = 'Special Rank';
$titanium_lang['Rank_Special_Guest'] = 'Special Rank For Guests';
$titanium_lang['Rank_Special_Banned'] = 'Special Rank For Banned';
$titanium_lang['Current_Rank_Image'] = 'Current rank image';
$titanium_lang['No_Rank'] = 'No rank assigned';
$titanium_lang['No_Rank_Image'] = 'No rank image';
$titanium_lang['No_Rank_Special'] = 'No special rank assigned';
$titanium_lang['Memberlist_Administrator'] = 'Administrator';
$titanium_lang['Memberlist_Moderator'] = 'Moderator';
$titanium_lang['Memberlist_User'] = 'User';
$titanium_lang['Guest_User'] = 'Guest';
$titanium_lang['Banned_User'] = 'Banned';
$titanium_lang['Rank1_title'] = 'Rank 1 Title';
$titanium_lang['Rank2_title'] = 'Rank 2 Title';
$titanium_lang['Rank3_title'] = 'Rank 3 Title';
$titanium_lang['Rank4_title'] = 'Rank 4 Title';
$titanium_lang['Rank5_title'] = 'Rank 5 Title';
/*****[END]********************************************
 [ Mod:    Multiple Ranks And Staff View       v2.0.3 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Forumtitle as Weblink               v1.2.2 ]
 ******************************************************/ 
$titanium_lang['Forum_link_count'] = 'Link was visited %s times.';
/*****[END]********************************************
 [ Mod:    Forumtitle as Weblink               v1.2.2 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Gender                              v1.2.6 ]
 ******************************************************/
$titanium_lang['Gender'] = 'Gender';//used in users profile to display witch gender he/she is 
$titanium_lang['Male'] = 'Male'; 
$titanium_lang['Female']='Female'; 
$titanium_lang['No_gender_specify'] = 'None Specified'; 
/*****[END]********************************************
 [ Mod:    Gender                              v1.2.6 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/
$titanium_lang['Birthday_range'] = 'Birthdays must yield ages between %d and %d years, inclusive.';
$titanium_lang['No_birthdays'] = 'No birthdays today';
$titanium_lang['Congratulations'] = 'Congratulations to: %s';
$titanium_lang['Upcoming_birthdays'] = 'Members with a birthday within the next %d days: %s';
$titanium_lang['No_upcoming'] = 'No portal members are having a birthday in the upcoming %d days';
$titanium_lang['Birthday'] = 'Date of Birth';
$titanium_lang['Month'] = 'Month';
$titanium_lang['Day'] = 'Day';
$titanium_lang['Year'] = 'Year';
$titanium_lang['Clear'] = 'Clear';
$titanium_lang['Year_Optional'] = 'Year <i>(Optional)</i>';
$titanium_lang['Optional'] = '<i>(Optional)</i>';
$titanium_lang['Default_Month'] = '[ Select a Month ]';
$titanium_lang['Default_Day'] = 'dd';
$titanium_lang['Default_Year'] = 'yyyy';
$titanium_lang['Birthday_invalid'] = 'You didn\'t specify a valid Birthday.';
$titanium_lang['Todays_Birthdays'] = 'Today\'s Birthdays';
$titanium_lang['View_Birthdays'] = 'Happy Birthday!';
$titanium_lang['Birthday_Display'] = 'Date of Birth Public Display Options';
$titanium_lang['Display_all'] = 'Display everything';
$titanium_lang['Display_day_and_month'] = 'Display day and month (but not year)';
$titanium_lang['Display_age'] = 'Display age (but not day or month)';
$titanium_lang['Display_nothing'] = 'Display nothing';
$titanium_lang['Age'] = 'Age: %d<br />';
$titanium_lang['Sort_Age'] = 'Age';
$titanium_lang['PM'] = 'PM';
$titanium_lang['Popup'] = 'Popup';
$titanium_lang['bday_send_greeting'] = 'Send Birthday Greetings via';
$titanium_lang['bday_send_greeting_user_explain'] = 'Determines how you will recieve Birthday Greetings on your birthday.';
$titanium_lang['Do_not_send'] = 'Do not send';
$titanium_lang['Birthday_popup'] = '%s would like to wish you a very happy birthday!';
/*****[END]********************************************
 [ Mod:    Birthdays                           v3.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Thank You Mod                       v1.1.8 ]
 ******************************************************/
$titanium_lang['thankful'] = 'Thankful Portal Members';
$titanium_lang['thanks_to'] = 'Thanks';
$titanium_lang['thanks_end'] = 'for his/her post';
$titanium_lang['thanks_alt'] = 'Thank Post';
$titanium_lang['thanked_before'] = 'You have already thanked this topic';
$titanium_lang['thanks_add'] = 'Your thanks has been given';
$titanium_lang['thanks_not_logged'] = 'You need to log in to thank someone\'s post';
$titanium_lang['thanked'] = 'user(s) is/are thankful for this post.';
$titanium_lang['hide'] = 'Hide';
$titanium_lang['t_starter'] = 'You cannot thank yourself';
$titanium_lang['thank_no_exist'] = 'Forum thank information doesn\'t exists';
/*****[END]********************************************
 [ Mod:    Thank You Mod                       v1.1.8 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    DHTML Collapsible Forum Index MOD     v1.1.1]
 ******************************************************/
$titanium_lang['CFI_options'] = "C.F.I.";
$titanium_lang['CFI_options_ex'] = "Collapsible Forums Options";
$titanium_lang['CFI_close'] = "Close";
$titanium_lang['CFI_delete'] = "Delete Saved State";
$titanium_lang['CFI_restore'] = "Restore Saved State";
$titanium_lang['CFI_save'] = "Save State";
$titanium_lang['CFI_Expand_all'] = "Expand All";
$titanium_lang['CFI_Collapse_all'] = "Collapse All";
/*****[END]********************************************
 [ Mod:    DHTML Collapsible Forum Index MOD     v1.1.1]
 ******************************************************/
//
// Password-protected forums
//
$titanium_lang['Forum_password'] = 'Forum password';
$titanium_lang['Enter_forum_password'] = 'Enter forum password';
$titanium_lang['Incorrect_forum_password'] = 'Incorrect forum password';
$titanium_lang['Password_login_success'] = 'Password login was successfull';
$titanium_lang['Click_return_page'] = 'Click %sHere%s to return to the page';
$titanium_lang['Only_alpha_num_chars'] = 'The password must be between 3-20 characters and can only contain alphanumeric characters (A-Z, a-z, 0-9).';

/*****[BEGIN]******************************************
 [ Mod:     Users Reputations Systems          v1.0.0 ]
 ******************************************************/
$titanium_lang['Reputation'] = 'Reputation';
$titanium_lang['No_votes'] = 'No votes';
$titanium_lang['Votes'] = 'votes';
/*****[END]********************************************
 [ Mod:     Users Reputations System           v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Arcade                             v3.0.2 ]
 ******************************************************/
$titanium_lang['lib_arcade'] = 'Portal Arcade';
$titanium_lang['statuser'] = 'User Stats';
/*****[END]********************************************
 [ Mod:     Arcade                             v3.0.2 ]
 ******************************************************/

/*****[BEGIN]*****************************************
[ Mod: Inline Banner Ad                       v1.2.3 ]
******************************************************/
$titanium_lang['Sponsor'] = 'Sponsor';
/*****[END]*******************************************
[ Mod: Inline Banner Ad                       v1.2.3 ]
******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Email topic to friend              v1.0.0 ]
 ******************************************************/
$titanium_lang['Email_topic'] = 'Email topic to a friend';
$titanium_lang['Email_topic_settings'] = 'Email topic information';
$titanium_lang['Friend_name'] = "Friend's name";
$titanium_lang['Friend_email'] = "Friend's email";
$titanium_lang['Message'] = 'Message';
$titanium_lang['Message_explain'] = 'The message can only contain 255 characters. HTML is not allowed.';
$titanium_lang['Email_max_exceeded'] = 'Sorry, but you have already sent %d emails in the past %d hours';
$titanium_lang['No_friend_specified'] = "You have not specified your friend's name or email address";
$titanium_lang['Friend_name_too_long'] = 'The name you specified is too long.';
$titanium_lang['Friend_email_too_long'] = 'The email address you specified is too long.';
$titanium_lang['Message_too_long'] = 'The message you entered is too long.';
/*****[END]********************************************
 [ Mod:     Email topic to friend              v1.0.0 ]
 ******************************************************/
 
/*****[BEGIN]******************************************
 [ Mod:    Admin User Notes                    v1.0.0 ]
 ******************************************************/
$titanium_lang['Admin_notes'] = 'Admin User Notes';
/*****[END]********************************************
 [ Mod:    Admin User Notes                    v1.0.0 ]
 ******************************************************/ 
 
/*****[BEGIN]******************************************
 [ Mod:     Related Topics                      v0.12 ]
******************************************************/
$titanium_lang['Related_topics'] = 'Related topics';
/*****[END]********************************************
 [ Mod:     Related Topics                      v0.12 ]
 ******************************************************/ 

/*****[START]******************************************
 [ Base:    Who viewed a topic                 v1.0.3 ]
 ******************************************************/
$titanium_lang['WhoIsViewingThisTopic'] = 'Who viewed <i class="fas fa-arrow-right" style="font-size: 12px;"></i>';
$titanium_lang['WhoViewedMemberlist'] = 'Who Has Viewed This Topic?';  
$titanium_lang['Topic_view_users'] = 'List members who have viewed this topic';
$titanium_lang['Topic_time'] = 'Last viewed';
$titanium_lang['Topic_count'] = 'View count';
$titanium_lang['Topic_view_count'] = 'Topic view count';
/*****[END]********************************************
 [ Base:    Who viewed a topic                 v1.0.3 ]
 ******************************************************/

//
// That's all, Folks!
// -------------------------------------------------
?>
