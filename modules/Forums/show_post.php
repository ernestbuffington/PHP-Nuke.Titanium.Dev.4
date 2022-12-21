<?php # JOHN 3:16 #
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/***************************************************************************
 *                            show_post.php
 *                          -------------------
 *   updated              : Monday, May 17, 2021
 *   Author               : Ernest Allen Buffington
 *   copyright            : (C) 2021 
 *   email                : ernest.buffington@gmail.com
 *
 *   begin                : Saturday, Nov 23, 2002
 *   original copyright   : (C) 2002 Meik Sievertsen
 *   email                : acyd.burn@gmx.de
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       08/26/2005
-=[Mod]=-
      Attachment Mod                           v2.4.1       08/26/2005
      Advanced Username Color                  v1.0.5       08/26/2005
      Smilies in Topic Titles                  v1.0.0       08/26/2005
      Force Word Wrapping                      v1.0.16      08/26/2005
      View/Disable Avatars/Signatures          v1.1.2       08/26/2005
      Advance Signature Divider Control        v1.0.0       08/26/2005
      Report Post                              v1.0.0       09/04/2005
      Smilies in Topic Titles Toggle           v1.0.0       09/10/2005
      Bottom aligned signature                 v1.2.0       10/01/2005
      Remote Avatar Resize                     v2.0.0       11/19/2005
      Online/Offline/Hidden                    v2.2.7       01/24/2005
 ************************************************************************/
if (!defined('MODULE_FILE')) die ("You can't access this file directly...");

define('IN_PHPBB', true);
$phpbb_root_path = NUKE_FORUMS_DIR;
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);
include_once('includes/bbcode.'.$phpEx);

# Start initial var setup
$topic_id = $post_id = 0;
if(isset($HTTP_GET_VARS['p']))
$post_id = intval($HTTP_GET_VARS['p']);

if(!isset($post_id))
message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');

# Find topic id if user requested a newer
# or older topic
if(isset($HTTP_GET_VARS['view'])):
  if($HTTP_GET_VARS['view'] == 'next' || $HTTP_GET_VARS['view'] == 'previous'):

    $sql_condition = ( $HTTP_GET_VARS['view'] == 'next' ) ? '>' : '<';
    $sql_ordering = ( $HTTP_GET_VARS['view'] == 'next' ) ? 'ASC' : 'DESC';

    $sql = "SELECT topic_id, post_time FROM " . POSTS_TABLE . " WHERE post_id = " . $post_id . " LIMIT 1";

    if (!($result = $db->sql_query($sql)))
    message_die(GENERAL_ERROR, "Could not obtain newer/older post information", '', __LINE__, __FILE__, $sql);

    $row = $db->sql_fetchrow($result);

    $topic_id = $row['topic_id'];
    $post_time = $row['post_time'];

    $sql = "SELECT post_id FROM ".POSTS_TABLE."
            WHERE topic_id = $topic_id
            AND post_time $sql_condition ".$post_time."
            ORDER BY post_time $sql_ordering
            LIMIT 1";
        
    if(!($result = $db->sql_query($sql)))
    message_die(GENERAL_ERROR, "Could not obtain newer/older post information", '', __LINE__, __FILE__, $sql);
        
        if($row = $db->sql_fetchrow($result)):
            $post_id = $row['post_id'];
        else:
            $message = ( $HTTP_GET_VARS['view'] == 'next' ) ? 'No_newer_posts' : 'No_older_posts';
            message_die(GENERAL_MESSAGE, $message);
        endif;
    endif;
endif;

if(!isset($post_id))
message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');

# Get topic info ...
$sql = "SELECT t.topic_title, 
                  f.forum_id, 
				 f.auth_view, 
				 f.auth_read, 
				 f.auth_post, 
				f.auth_reply, 
				 f.auth_edit, 
			   f.auth_delete, 
			   f.auth_sticky, 
			 f.auth_announce, 
		   f.auth_pollcreate, 
		         f.auth_vote, 
		  f.auth_attachments 

FROM ".TOPICS_TABLE." t, ".FORUMS_TABLE." f, ".POSTS_TABLE." p
WHERE p.post_id = $post_id
AND t.topic_id = p.topic_id
AND f.forum_id = t.forum_id";
        
$tmp = '';
 
# Mod: Attachment Mod v2.4.1 START

# This is another instance where someone removes or changes something
# in the code and is so lazy they do not comment about the changes.

/* attach_setup_viewtopic_auth($tmp, $sql); */

# Mod: Attachment Mod v2.4.1 END

if(!($result = $db->sql_query($sql)))
message_die(GENERAL_ERROR, 'Could not obtain topic information', '', __LINE__, __FILE__, $sql);

if(!($forum_row = $db->sql_fetchrow($result)))
message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');

$forum_id = $forum_row['forum_id'];
$topic_title = $forum_row['topic_title'];

# Start session management
$userdata = session_pagestart($user_ip, $forum_id);
init_userprefs($userdata);
# End session management

$is_auth = array();
$is_auth = auth(AUTH_ALL, $forum_id, $userdata, $forum_row);

if(!$is_auth['auth_read'])
message_die(GENERAL_MESSAGE, sprintf($lang['Sorry_auth_read'], $is_auth['auth_read_type']));

# Define censored word matches
if(empty($orig_word) && empty($replacement_word)):
    $orig_word = array();
    $replacement_word = array();
    obtain_word_list($orig_word, $replacement_word);
endif;

# Censor topic title
if(count($orig_word))
$topic_title = preg_replace($orig_word, $replacement_word, $topic_title);

# Dump out the page header and load viewtopic body template
$gen_simple_header = TRUE;

$page_title = $lang['Post_review'] . ' - ' . $topic_title;
include('includes/page_header.'.$phpEx);

$template->set_filenames(array(
    'reviewbody' => 'post_review.tpl')
);

$view_prev_post_url = append_sid("show_post.$phpEx?p=$post_id&amp;view=previous");
$view_next_post_url = append_sid("show_post.$phpEx?p=$post_id&amp;view=next");

$template->assign_vars(array(
    'L_AUTHOR' => $lang['Author'],
    'L_MESSAGE' => $lang['Message'],
    'L_POSTED' => $lang['Posted'], 
    'L_POST_SUBJECT' => $lang['Post_subject'],
    'L_VIEW_NEXT_POST' => $lang['View_next_post'],
    'L_VIEW_PREVIOUS_POST' => $lang['View_previous_post'],
    # next topic and previous topic 
    'U_VIEW_OLDER_POST' => $view_prev_post_url,
    'U_VIEW_NEWER_POST' => $view_next_post_url)
);

$sql = "SELECT *
        FROM " . RANKS_TABLE . "
        ORDER BY rank_special, rank_min";

if(!($result = $db->sql_query($sql)))
message_die(GENERAL_ERROR, "Could not obtain ranks information.", '', __LINE__, __FILE__, $sql);

$ranksrow = array();

while($row = $db->sql_fetchrow($result)):
    $ranksrow[] = $row;
endwhile;
$db->sql_freeresult($result);
    

# Go ahead and pull all data for this topic
# Mod: Online/Offline/Hidden v2.2.7 START
$sql = "SELECT u.*, p.*, u.user_allow_viewonline, u.user_session_time, pt.post_text, pt.post_subject, pt.bbcode_uid
        FROM " . POSTS_TABLE . " p, " . USERS_TABLE . " u, " . POSTS_TEXT_TABLE . " pt
        WHERE p.post_id = $post_id
        AND p.poster_id = u.user_id
        AND p.post_id = pt.post_id
        LIMIT 1";
# Mod: Online/Offline/Hidden v2.2.7 END

if(!($result = $db->sql_query($sql)))
message_die(GENERAL_ERROR, 'Could not obtain post/user information', '', __LINE__, __FILE__, $sql);

# Mod: Attachment Mod v2.4.1 START

# This is another instance where someone removes or changes something
# in the code and is so lazy they do not comment about the changes.

//init_display_review_attachments($is_auth);

# Mod: Attachment Mod v2.4.1 END

# Okay, let's do the loop, yeah come on baby let's do the loop
# and it goes like this ...
if($row = $db->sql_fetchrow($result)):

    $mini_post_img = $images['icon_minipost'];
    $mini_post_alt = $lang['Post'];

    $i = 0;
    do
    {
        $poster_id = $row['user_id'];
        $poster = ( $poster_id == ANONYMOUS ) ? $lang['Guest'] : $row['username'];

        $post_date = create_date($board_config['default_dateformat'], $row['post_time'], $board_config['board_timezone']);

        $poster_posts = ( $row['user_id'] != ANONYMOUS ) ? $lang['Posts'] . ': ' . $row['user_posts'] : '';

        $poster_from = ( $row['user_from'] && $row['user_id'] != ANONYMOUS ) ? $lang['Location'] . ': ' . $row['user_from'] : '';
        $poster_from = str_replace(".gif", "", $poster_from);
        $poster_joined = ( $row['user_id'] != ANONYMOUS ) ? $lang['Joined'] . ': ' . $row['user_regdate'] : '';

        $poster_avatar = '';
        
		# Mod: View/Disable Avatars/Signatures v1.1.2 START
        if ( $row['user_avatar_type'] && $poster_id != ANONYMOUS && $row['user_allowavatar'] && $userdata['user_showavatars']):
		# Mod: View/Disable Avatars/Signatures v1.1.2 END
            switch( $row['user_avatar_type']):
                case USER_AVATAR_UPLOAD:
                    $poster_avatar = ( $board_config['allow_avatar_upload'] ) ? '<img src="' . $board_config['avatar_path'] . '/' . $row['user_avatar'] . '" alt="" border="0" />' : '';
                    break;
                # Mod: Remote Avatar Resize v2.0.0 START
                case USER_AVATAR_REMOTE:
                    $poster_avatar = resize_avatar($row['user_avatar']);
                    break;
                # Mod: Remote Avatar Resize v2.0.0 END
                case USER_AVATAR_GALLERY:
                    $poster_avatar = ( $board_config['allow_avatar_local'] ) ? '<img src="' . $board_config['avatar_gallery_path'] . '/' . $row['user_avatar'] . '" alt="" border="0" />' : '';
                    break;
            endswitch;
        endif;
        
        # Generate ranks, set them to empty string initially.
        $poster_rank = '';
        $rank_image = '';

        if ($row['user_id'] == ANONYMOUS):
        # do some shit if the user is anonymous
        elseif($row['user_rank']):
            for($j = 0; $j < count($ranksrow); $j++):
                if ( $row['user_rank'] == $ranksrow[$j]['rank_id'] && $ranksrow[$j]['rank_special']):
                    $poster_rank = $ranksrow[$j]['rank_title'];
                    $rank_image = ( $ranksrow[$j]['rank_image'] ) ? '<img src="'.$ranksrow[$j]['rank_image'].'" alt="'.$poster_rank.'" title="'.$poster_rank.'" border="0" /><br />' : '';
                endif;
            endfor;
        else:
            for($j = 0; $j < count($ranksrow); $j++):
                if( $row['user_posts'] >= $ranksrow[$j]['rank_min'] && !$ranksrow[$j]['rank_special']):
                    $poster_rank = $ranksrow[$j]['rank_title'];
                    $rank_image = ( $ranksrow[$j]['rank_image'] ) ? '<img src="'.$ranksrow[$j]['rank_image'].'" alt="'.$poster_rank.'" title="'.$poster_rank.'" border="0" /><br />' : '';
                endif;
            endfor;
        endif;

        # Handle anon users posting with usernames
        if($poster_id == ANONYMOUS && !empty($row['post_username'])):
            $poster = $row['post_username'];
            $poster_rank = $lang['Guest'];
        endif;

        $temp_url = '';

        if($poster_id != ANONYMOUS):
        
            $temp_url = append_sid("profile.$phpEx?mode=viewprofile&amp;".POST_USERS_URL."=$poster_id");
            $profile_img = '<a href="'.$temp_url.'"><img src="'.$images['icon_profile'].'" alt="'.$lang['Read_profile'].'" title="'.$lang['Read_profile'].'" border="0" /></a>';
            $profile = '<a href="'.$temp_url.'">'.$lang['Read_profile'].'</a>';

            $temp_url = append_sid("privmsg.$phpEx?mode=post&amp;".POST_USERS_URL."=$poster_id");

            if(is_active("Private_Messages")): 
              $pm_img = '<a href="'.$temp_url.'"><img src="'.$images['icon_pm'].'" alt="'.$lang['Send_private_message'].'" title="'.$lang['Send_private_message'].'" border="0" /></a>';
              $pm = '<a href="'.$temp_url.'">'.$lang['Send_private_message'].'</a>';
            endif;

            if(!empty($row['user_viewemail']) || $is_auth['auth_mod']):
                $email_uri = ($board_config['board_email_form']) ? append_sid("profile.$phpEx?mode=email&amp;".POST_USERS_URL.'='.$poster_id) : 'mailto:'.$row['user_email'];
                $email_img = '<a href="'.$email_uri.'"><img src="'.$images['icon_email'].'" alt="'.$lang['Send_email'].'" title="'.$lang['Send_email'].'" border="0" /></a>';
                $email = '<a href="'.$email_uri.'">'.$lang['Send_email'].'</a>';
            else:
                $email_img = '';
                $email = '';
            endif;
            
			if(($row['user_website'] == "http:///") || ( $row['user_website'] == "http://"))
            $row['user_website'] =  "";
            
			if(($row['user_website'] != "" ) && (substr($row['user_website'],0, 7) != "http://")) 
            $row['user_website'] = "http://".$row['user_website'];

            $www_img = ($row['user_website']) ? '<a href="'.$row['user_website'].'" target="_userwww"><img 
			src="'.$images['icon_www'].'" alt="'.$lang['Visit_website'].'" title="'.$lang['Visit_website'].'" border="0" /></a>' : '';
            
			$www = ( $row['user_website'] ) ? '<a href="' . $row['user_website'] . '" target="_userwww">' . $lang['Visit_website'] . '</a>' : '';

            if(!empty($row['user_icq'])):
               $icq_status_img = '<a href="http://wwp.icq.com/'.$row['user_icq'].'#pager"><img 
			   src="http://web.icq.com/whitepages/online?icq='.$row['user_icq'].'&amp;img=5" width="18" height="18" border="0" /></a>';
               
			   $icq_img = '<a href="http://wwp.icq.com/scripts/search.dll?to='.$row['user_icq'].'"><img 
			   src="'.$images['icon_icq'].'" alt="'.$lang['ICQ'].'" title="'.$lang['ICQ'].'" border="0" /></a>';
               
			   $icq =  '<a href="http://wwp.icq.com/scripts/search.dll?to=' . $row['user_icq'] . '">' . $lang['ICQ'] . '</a>';
            else:
                $icq_status_img = '';
                $icq_img = '';
                $icq = '';
            endif;

            $aim_img = ($row['user_aim']) ? '<a href="aim:goim?screenname='.$row['user_aim'].'&amp;message=Hello+Are+you+there?"><img 
			src="'.$images['icon_aim'].'" alt="'.$lang['AIM'].'" title="'.$lang['AIM'].'" border="0" /></a>' : '';
            
			$aim = ( $row['user_aim'] ) ? '<a href="aim:goim?screenname='.$row['user_aim'].'&amp;message=Hello+Are+you+there?">'.$lang['AIM'].'</a>' : '';

            $temp_url = append_sid("profile.$phpEx?mode=viewprofile&amp;".POST_USERS_URL."=$poster_id");
            $msn_img = ($row['user_msnm']) ? '<a href="'.$temp_url.'"><img src="'.$images['icon_msnm'].'" alt="'.$lang['MSNM'].'" title="'.$lang['MSNM'].'" border="0" /></a>' : '';
            $msn = ($row['user_msnm']) ? '<a href="'.$temp_url.'">'.$lang['MSNM'].'</a>' : '';

            $yim_img = ($row['user_yim']) ? '<a href="http://edit.yahoo.com/config/send_webmesg?.target='.$row['user_yim'].'&amp;.src=pg"><img 
			src="'.$images['icon_yim'].'" alt="'.$lang['YIM'].'" title="'.$lang['YIM'].'" border="0" /></a>' : '';
            
			$yim = ( $row['user_yim'] ) ? '<a href="http://edit.yahoo.com/config/send_webmesg?.target=' . $row['user_yim'] . '&amp;.src=pg">' . $lang['YIM'] . '</a>' : '';

            # Mod: Online/Offline/Hidden v2.2.7 START
            if($row['user_session_time'] >= (time()-$board_config['online_time'])):
            
               if($row['user_allow_viewonline']):
                   $online_status_img = '<a href="'.append_sid("viewonline.$phpEx").'"><img 
				   src="'.$images['icon_online'].'" alt="'.sprintf($lang['is_online'], $poster).'" title="'.sprintf($lang['is_online'], $poster).'" /></a>&nbsp;';
                   
				   $online_status = '<br />'.$lang['Online_status'].': <strong><a href="'.append_sid("viewonline.$phpEx").'" 
				   title="'.sprintf($lang['is_online'], $poster).'"'.$online_color.'>'.$lang['Online'].'</a></strong>';
               elseif($is_auth['auth_mod'] || $userdata['user_id'] == $poster_id):
                   $online_status_img = '<a href="'.append_sid("viewonline.$phpEx").'"><img 
				   src="'.$images['icon_hidden'].'" alt="'.sprintf($lang['is_hidden'], $poster).'" title="'.sprintf($lang['is_hidden'], $poster).'" /></a>&nbsp;';
                   
				   $online_status = '<br />'.$lang['Online_status'].': <strong><em><a href="'.append_sid("viewonline.$phpEx").'" 
				   title="'.sprintf($lang['is_hidden'], $poster) .'"'. $hidden_color.'>'.$lang['Hidden'].'</a></em></strong>';
               else:
                   $online_status_img = '<img src="'.$images['icon_offline'].'" 
				   alt="'.sprintf($lang['is_offline'], $poster).'" title="'.sprintf($lang['is_offline'], $poster).'" />&nbsp;';
                   
				   $online_status = '<br />'.$lang['Online_status'].': <span title="'.sprintf($lang['is_offline'], $poster).'"'.$offline_color.'><strong>'.$lang['Offline'].'</strong></span>';
               endif;
            
            else:
              $online_status_img = '<img src="'.$images['icon_offline'].'" alt="'.sprintf($lang['is_offline'], $poster).'" title="'.sprintf($lang['is_offline'], $poster).'" />&nbsp;';
              $online_status = '<br />'.$lang['Online_status'].': <span title="'.sprintf($lang['is_offline'], $poster).'"'.$offline_color.'><strong>'.$lang['Offline'].'</strong></span>';
            endif;
            # Mod: Online/Offline/Hidden v2.2.7 END
        
        else:
            $profile_img = '';
            $profile = '';
            $pm_img = '';
            $pm = '';
            $email_img = '';
            $email = '';
            $www_img = '';
            $www = '';
            $icq_status_img = '';
            $icq_img = '';
            $icq = '';
            $aim_img = '';
            $aim = '';
            $msn_img = '';
            $msn = '';
            $yim_img = '';
            $yim = '';
            
			# Mod: Online/Offline/Hidden v2.2.7 START
            $online_status_img = '';
            $online_status = '';
			# Mod: Online/Offline/Hidden v2.2.7 END

        endif;

        $temp_url = append_sid("posting.$phpEx?mode=quote&amp;".POST_POST_URL."=".$row['post_id']);
        $quote_img = '<a href="'.$temp_url.'" target="_parent"><img src="'.$images['icon_quote'].'" alt="'.$lang['Reply_with_quote'].'" title="'.$lang['Reply_with_quote'].'" border="0" /></a>';
        $quote = '<a href="'.$temp_url.'" target="_parent">'.$lang['Reply_with_quote'].'</a>';

        # Mod: Smilies in Topic Titles v1.0.0 START
        # Mod: Smilies in Topic Titles Toggle v1.0.0 START
        if ($board_config['smilies_in_titles']) 
        $post_subject = smilies_pass(( !empty($row['post_subject'] )) ? $row['post_subject'] : '');
		else 
        $post_subject = ( !empty($row['post_subject'] )) ? $row['post_subject'] : '';
        # Mod: Smilies in Topic Titles v1.0.0 END
        # Mod: Smilies in Topic Titles Toggle v1.0.0 END

        $message = $row['post_text'];
        $bbcode_uid = $row['bbcode_uid'];
        
		# Mod: View/Disable Avatars/Signatures v1.1.2 START
        if($userdata['user_showsignatures'])
        $user_sig = ( $row['enable_sig'] && !empty($row['user_sig']) && $board_config['allow_sig'] ) ? $row['user_sig'] : '';
		# Mod: View/Disable Avatars/Signatures v1.1.2 END

        $user_sig_bbcode_uid = $row['user_sig_bbcode_uid'];

        # Note! The order used for parsing the message _is_ important, moving things around could break any 
        # output

        # If the board has HTML off but the post has HTML
        # on then we process it, else leave it alone
        if(!$board_config['allow_html'] || !$userdata['user_allowhtml']):
            if(!empty($user_sig))
            $user_sig = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $user_sig);

            if($row['enable_html'])
            $message = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $message);
        endif;

        # Parse message and/or sig for BBCode if reqd
        if($board_config['allow_bbcode']):
            if(!empty($user_sig) && !empty($user_sig_bbcode_uid))
            $user_sig = ( $board_config['allow_bbcode'] ) ? bbencode_second_pass($user_sig, $user_sig_bbcode_uid) : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $user_sig);

            if(!empty($bbcode_uid))
            $message = ( $board_config['allow_bbcode'] ) ? bbencode_second_pass($message, $bbcode_uid) : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $message);
        endif;

        if(!empty($user_sig))
        $user_sig = make_clickable($user_sig);

        $message = make_clickable($message);

        # Parse smilies
        if($board_config['allow_smilies']):
            if($row['user_allowsmile'] && !empty($user_sig))
            $user_sig = smilies_pass($user_sig);

            if ( $row['enable_smilies'] )
            $message = smilies_pass($message);
        endif;

        # Replace naughty words
        if (count($orig_word)):
            $post_subject = preg_replace($orig_word, $replacement_word, $post_subject);

            if (!empty($user_sig))
            $user_sig = str_replace('\"', '"', substr(@preg_replace('#(\>(((?>([^><]+|(?R)))*)\<))#se', "@preg_replace(\$orig_word, \$replacement_word, '\\0')", '>' . $user_sig . '<'), 1, -1));

            $message = str_replace('\"', '"', substr(@preg_replace('#(\>(((?>([^><]+|(?R)))*)\<))#se', "@preg_replace(\$orig_word, \$replacement_word, '\\0')", '>' . $message . '<'), 1, -1));
        endif;

        # Replace newlines (we use this rather than nl2br because
        # till recently it wasn't XHTML compliant)
        if(!empty($user_sig)):
          # Mod: Force Word Wrapping v1.0.16 START
          $user_sig = word_wrap_pass($user_sig);
          # Mod: Force Word Wrapping v1.0.16 END

          # Mod: Advance Signature Divider Control v1.0.0 START
          # Mod: Bottom aligned signature v1.2.0 START
          $user_sig = '<br />' . $board_config['sig_line'] . '<br />' . str_replace("\n", "\n<br />\n", $user_sig);
          # Mod: Advance Signature Divider Control v1.0.0 END
          # Mod: Bottom aligned signature v1.2.0 END
        endif;

        # Mod: Force Word Wrapping v1.0.16 START
        $message = word_wrap_pass($message);
        # Mod: Force Word Wrapping v1.0.16 END

        $message = str_replace("\n", "\n<br />\n", $message);
        
        # Editing information
        if($row['post_edit_count']):
            $l_edit_time_total = ($row['post_edit_count'] == 1) ? $lang['Edited_time_total'] : $lang['Edited_times_total'];
            $l_edited_by = '<br /><br />'.sprintf($l_edit_time_total, 
			$poster, create_date($board_config['default_dateformat'], $row['post_edit_time'], $board_config['board_timezone']), $row['post_edit_count']);
        else:
            $l_edited_by = '';
        endif;
		
        # Mod: Report Post v1.0.0 START
        if($userdata['session_logged_in']):
          $report_img = '<a href="'.append_sid('viewtopic.'.$phpEx.'?report=true&amp;'.POST_POST_URL.'='.$post_id).'"><img 
		  src="'.$images['icon_report'].'" border="0" width="16" height="18" alt="'.$lang['Report_post'].'" title="'.$lang['Report_post'].'" /></a>';
        else:
          $report_img = '';
        endif;
        # Mod: Report Post v1.0.0 END
    
        # Again this will be handled by the templating
        # code at some point
        $row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
        $row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

        $template->assign_block_vars('postrow', array(
            'ROW_COLOR' => '#' . $row_color,
            'ROW_CLASS' => $row_class,
			
            # Mod: Advanced Username Color v1.0.5 START
            'POSTER_NAME' => UsernameColor($poster),
            # Mod: Advanced Username Color v1.0.5 END

            'POSTER_RANK' => $poster_rank,
            'RANK_IMAGE' => $rank_image,
            'POSTER_JOINED' => $poster_joined,
            'POSTER_POSTS' => $poster_posts,
            'POSTER_FROM' => $poster_from,
            'POSTER_AVATAR' => $poster_avatar,
			
            # Mod: Online/Offline/Hidden v2.2.7 START
            'POSTER_ONLINE_STATUS_IMG' => $online_status_img,
            'POSTER_ONLINE_STATUS' => $online_status,
            # Mod: Online/Offline/Hidden v2.2.7 END

            'POST_DATE' => $post_date,
            'POST_SUBJECT' => $post_subject,
            'MESSAGE' => $message, 
            'SIGNATURE' => $user_sig, 
            'EDITED_MESSAGE' => $l_edited_by, 

            'MINI_POST_IMG' => $mini_post_img, 
            'PROFILE_IMG' => $profile_img, 
            'PROFILE' => $profile, 
            'PM_IMG' => $pm_img,
            'PM' => $pm,
            'EMAIL_IMG' => $email_img,
            'EMAIL' => $email,
            'WWW_IMG' => $www_img,
            'WWW' => $www,
            'ICQ_STATUS_IMG' => $icq_status_img,
            'ICQ_IMG' => $icq_img, 
            'ICQ' => $icq, 
            'AIM_IMG' => $aim_img,
            'AIM' => $aim,
            'MSN_IMG' => $msn_img,
            'MSN' => $msn,
            'YIM_IMG' => $yim_img,
            'YIM' => $yim,
            'QUOTE_IMG' => $quote_img,
			
            # Mod: Report Post v1.0.0 START
            'REPORT_IMG' => $report_img,
            # Mod: Report Post v1.0.0 END

            'QUOTE' => $quote,

            'L_MINI_POST_ALT' => $mini_post_alt, 

            'U_POST_ID' => $row['post_id'])
        );
		
    # Mod: Attachment Mod v2.4.1 START
    
    # This is another instance where someone removes or changes something
    # in the code and is so lazy they do not comment about the changes.
	
	//display_review_attachments($row['post_id'], $row['post_attachment'], $is_auth);
    # Mod: Attachment Mod v2.4.1 END

      $i++;
    }
    while($row = $db->sql_fetchrow($result));

else:
    message_die(GENERAL_MESSAGE, 'Topic_post_not_exist', '', __LINE__, __FILE__, $sql);
endif;

$template->pparse('reviewbody');
?>
