<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/***************************************************************************
 *                              memberlist.php
 *                            -------------------
 *   update               : Monday, May 17, 2021
 *   copyright            : (C) 2001 Ernest Allen Buffington
 *   email                : ernest.buffington@gmail.com
 *	 version              : 2.0
 *
 *
 *   begin                : Friday, May 11, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: memberlist.php,v 1.36.2.10 2004/07/11 16:46:15 acydburn Exp $
 *
 *	Module Description: Display's all registered user's.
 *	Module Name: Members List	
 *	Module Version: 1.36.2.10
 *	Original Modifications: Lonestar (http://lonestar-modules.com)	
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
      Nuke Patched                             v3.1.0       06/26/2005
-=[Mod]=-
      Advanced Username Color                  v1.0.5       06/11/2005
      Memberlist Find User                     v1.0.0       07/06/2005
      Online/Offline/Hidden (Selection Order)  v1.0.0       08/21/2005
      Online/Offline/Hidden                    v2.2.7       01/24/2006
	  Member Country Flags                     v2.0.7
	  Birthdays                                v3.0.0
 ************************************************************************/
if (!defined('MODULE_FILE'))die('You can\'t access this file directly...');

$module_name = basename(__DIR__);
require(NUKE_FORUMS_DIR.'/nukebb.php');

define('IN_PHPBB', true);
include($phpbb_root_path.'extension.inc');
include($phpbb_root_path.'common.'.$phpEx);

# Start session management
$userdata = session_pagestart($user_ip, PAGE_VIEWMEMBERS);
init_userprefs($userdata);

$pageroot = (!empty($_GET['page'])) ? $_GET['page'] : 1;
$page = (isset($pageroot)) ? intval($pageroot) : 1;

$calc = $board_config['topics_per_page'] * $page;
$start = $calc - $board_config['topics_per_page'];

# just another instance where code is changed without explanation START

# it appears as if a new function was created called get_query_var and
# was used to replace the original code.
// if(isset($HTTP_GET_VARS['mode']) || isset($HTTP_POST_VARS['mode']))
// 	$mode = (isset($HTTP_POST_VARS['mode'])) ? htmlspecialchars($HTTP_POST_VARS['mode']) : htmlspecialchars($HTTP_GET_VARS['mode']);
// else
// 	$mode = 'joined';

# just another instance where code is changed without explanation END

$mode = get_query_var('mode', '_REQUEST', 'string', 'joined');
$sort_order = get_query_var('order', '_REQUEST', 'string');
$sort_order = ($sort_order == 'DESC') ? $sort_order : 'ASC';

$page_title = $lang['Memberlist'];
include(NUKE_INCLUDE_DIR.'page_header.php');

$template->set_filenames(['body' => 'memberlist_body.tpl']
);

if(!isset($lang['Sort_Go']))
$lang['Sort_Go'] = 'Sort';

$template->assign_vars([
    'L_PAGE_TITLE' => $lang['Memberlist'],
    'L_SELECT_SORT_METHOD' => $lang['Select_sort_method'],
    'L_EMAIL' => $lang['Email'],
    'L_WEBSITE' => $lang['Website'],
    'L_FROM' => $lang['Location'],
    'L_ORDER' => $lang['Order'],
    'L_LOOK_UP' => $lang['Look_up_User'],
    'L_FIND_USERNAME' => $lang['Find_username'],
    'U_SEARCH_USER' => "modules.php?name=Forums&amp;file=search&amp;mode=searchuser&amp;popup=1",
    'U_SEARCH_EXPLAIN' => $lang['Search_author_explain'],
    'L_GO' => $lang['Sort_Go'],
    'L_JOINED' => $lang['Joined'],
    'L_AGE' => $lang['Sort_Age'],
    'L_POSTS' => $lang['Posts'],
    'L_ONLINE_STATUS' => $lang['Online_status'],
    'L_LAST_VISIT' => $lang['User_last_visit'],
    # Mod: Selection Order v1.0.0 START
    # Mod: Birthdays v3.0.0 START
    'S_MODE_SELECT' => select_box('mode',$mode,['joined' => 
   	                          $lang['Sort_Joined'], 'username' => 
						   $lang['Sort_Username'], 'location' => 
						      $lang['Sort_Location'], 'posts' => 
							       $lang['Sort_Posts'], 'age' => 
								   $lang['Sort_Age'], 'email' => 
							   $lang['Sort_Email'], 'website' => 
							  $lang['Sort_Website'], 'topten' => 
							  $lang['Sort_Top_Ten'], 'online' => 
							           $lang['Current_status']]),
    # Mod: Selection Order v1.0.0 END
    # Mod: Birthdays v3.0.0 END
    'S_ORDER_SELECT' 		=> select_box('order',$sort_order,['ASC' => $lang['Sort_Ascending'], 'DESC' => $lang['Sort_Descending']]),
    'S_MODE_ACTION' 		=> append_sid("memberlist.$phpEx"),
]
);

# SEARCH FOR USERS VIA THE ALPHABET LISTING - START
$alpha_range = [];
$alpha_letters = [];
$alpha_letters = range('A','Z');
$alpha_start = ['All', '#'];
$alpha_range = array_merge($alpha_start, $alpha_letters);
$i = 0;
while($i < count($alpha_range)):
	if ($alpha_range[$i] != 'All'): 
		$temp = ($alpha_range[$i] != '#') ? strtolower($alpha_range[$i]) : 'num';
		$alphanum_search_url = 'modules.php?name='.basename(__DIR__).'&amp;mode=letter&amp;alphanum='.strtoupper($temp);
	else: 
		$alphanum_search_url = 'modules.php?name='.basename(__DIR__);
	endif;
	$template->assign_block_vars('alphanumsearch', ['SEARCH_SIZE' 	=> floor(100/count($alpha_range)) . '%', 'SEARCH_TERM' 	=> $alpha_range[$i], 'SEARCH_LINK' 	=> $alphanum_search_url]
	);
	$i++;
endwhile;
# SEARCH FOR USERS VIA THE ALPHABET LISTING - END

# search switch START
switch($mode):
	case 'letter':
	$alphanum = (isset($_POST['alphanum'])) ? htmlspecialchars((string) $_POST['alphanum']) : htmlspecialchars((string) $_GET['alphanum']);
	$alphanum = str_replace("\'", "''",$alphanum);
	$where = ($alphanum == 'num') ? " AND `username` NOT RLIKE '^[A-Z]' " : " AND `username` LIKE '".$alphanum."%' ";
	$order_by = 'user_id '.$sort_order.' LIMIT '.$start.', '.$board_config['topics_per_page']; break;
	break;
	case 'age':
	$age_order = $sort_order == 'ASC' ? 'DESC' : 'ASC';
	$order_by = 'coalesce(user_birthday2,';
	$order_by.= ($age_order == 'ASC') ? '99999999' : '0';
	$order_by.= ") $age_order LIMIT $start, ".$board_config['topics_per_page'];
	break;
	case 'joined': 		
	$order_by = 'user_id '.$sort_order.' LIMIT '.$start.', '.$board_config['topics_per_page']; 
	break;
	case 'username': 	
	$order_by = 'username '.$sort_order.' LIMIT '.$start.', '.$board_config['topics_per_page']; 
	break;
	case 'location': 	
	$order_by = 'user_from '.$sort_order.' LIMIT '.$start.', '.$board_config['topics_per_page']; 
	break;
	case 'posts': 		
	$order_by = 'user_posts '.$sort_order.' LIMIT '.$start.', '.$board_config['topics_per_page']; 
	break;
	case 'email': 		
	$order_by = 'user_email '.$sort_order.' LIMIT '.$start.', '.$board_config['topics_per_page']; 
	break;
	case 'website': 	
	$order_by = 'user_website '.$sort_order.' LIMIT '.$start.', '.$board_config['topics_per_page']; 
	break;
	case 'topten': 		
	$order_by = 'user_posts '.$sort_order.' LIMIT 10'; 
	break;
	case 'online': 		
	$order_by = 'user_session_time '.$sort_order.' LIMIT '.$start.', '.$board_config['topics_per_page']; 
	break;
	default: 			
	$order_by = 'user_id '.$sort_order.' LIMIT '.$start.', '.$board_config['topics_per_page']; break;
endswitch;
# search switch END

$username = (!empty($_POST['username'])) ? $_POST['username'] : '';

if ($username && isset($_POST['submituser'])):
    # search for users with a wildcard
	$search_author = str_replace('*', '%', trim($username));
	if((str_contains($search_author, '%')) && (strlen(str_replace('%', '',$search_author)) < $board_config['search_min_chars']))
	$search_author = '';

	$sql = "SELECT username,
	                   name, 
	  	        user_avatar, 
	       user_avatar_type, 
	       user_allowavatar, 
	                user_id, 
				 user_posts, 
				user_gender, 
			  user_facebook, 
			  user_birthday, 
		   birthday_display, 
		       user_regdate, 
			      user_from, 
			 user_from_flag, 
			   user_website, 
	  user_allow_viewonline, 
	      user_session_time, 
		     user_lastvisit 

	FROM ".USERS_TABLE." 
	WHERE username LIKE '".str_replace("\'", "''",$search_author)."' 
	AND user_id <> ".ANONYMOUS." LIMIT 1";

	# this is the original SQL queery START
	$deprecated_sql = "SELECT username, 
	        		              name, 
						   user_avatar, 
	                  user_avatar_type, 
	                  user_allowavatar, 
	                           user_id, 
							user_posts, 
						   user_gender, 
						 user_facebook, 
						 user_birthday, 
					  birthday_display, 
					      user_regdate, 
						     user_from, 
					    user_from_flag, 
						  user_website, 
				 user_allow_viewonline, 
				     user_session_time, 
					    user_lastvisit 

	FROM ".USERS_TABLE." 
	WHERE username = '$username' 
	AND user_id <> ".ANONYMOUS." LIMIT 1";
	# this is the original SQL queery END


else:

    if(!isset($where)):
	
	if(!isset($_POST['alphanum']))
	$_POST['alphanum'] = '';
	
	$alphanum = (isset($_POST['alphanum'])) ? htmlspecialchars((string) $_POST['alphanum']) : htmlspecialchars((string) $_GET['alphanum']);
	$alphanum = str_replace("\'", "''",$alphanum);
	$where = ($alphanum == 'num') ? " AND `username` NOT RLIKE '^[A-Z]' " : " AND `username` LIKE '".$alphanum."%' ";
	$order_by = 'user_id '.$sort_order.' LIMIT '.$start.', '.$board_config['topics_per_page']; 
	endif;
	
	
	$sql = "SELECT username,
	                   name, 
                user_avatar, 
	       user_avatar_type, 
	       user_allowavatar, 
	                user_id, 
				 user_posts, 
				user_gender, 
			  user_facebook, 
			  user_birthday, 
		   birthday_display, 
		       user_regdate, 
			      user_from, 
			 user_from_flag, 
			   user_website, 
	  user_allow_viewonline, 
	      user_session_time, 
		     user_lastvisit 
			 
    FROM ".USERS_TABLE." WHERE user_id <> ".ANONYMOUS."".$where." ORDER BY $order_by";
endif;

if(!($result = $db->sql_query($sql)))
message_die(GENERAL_ERROR, 'Could not query users', '', __LINE__, __FILE__, $sql);

global $textcolor1;
$theme_name = get_theme();

if($row = $db->sql_fetchrow($result)):

	$i = 0;
	do
	{
		$realname = $row['name'];
		$username = $row['username'];
		$user_id = intval($row['user_id']);
		
		# Get the users location and flag
		$user_from = (!empty($row['user_from'])) ? $row['user_from'] : '&nbsp;';

		$user_flag = (!empty($row['user_from_flag'])) ? 
		'&nbsp;'.get_evo_icon('countries '.str_replace('.png','',(string) $row['user_from_flag'])).'&nbsp;' : '&nbsp;'.get_evo_icon('countries unknown').'&nbsp;';
		 
		# Calculate the users age.
		$bday_month_day = floor($row['user_birthday'] / 10000);
		$bday_year_age = ($row['birthday_display'] != BIRTHDAY_NONE && $row['birthday_display'] != BIRTHDAY_DATE) ? $row['user_birthday'] - 10000*$bday_month_day : 0;
		$fudge = (gmdate('md') < $bday_month_day) ? 1 : 0;
		$age = ($bday_year_age) ? gmdate('Y')-$bday_year_age-$fudge : false;
		
		if(empty($age))
		$age = 'Hidden';
		else
		$age .= ' yrs';
		
		# Website URL
		if(!empty($row['user_website']))
		$www = '<a href="'.$row['user_website'].'" target="_blank"><img class="tooltip-html copyright" 
		alt="Male" title="Visit '.$username.'\'s Web Portal" width="30"alt="online" src="themes/'.$theme_name.'/forums/images/status/icons8-website-512.png" /></a>';
		else
		$www = '';
		
		# Date Joined
		$joined = $row['user_regdate'];
		
        /*****[BEGIN]******************************************
        [ Mod:    Forum Index Avatar Mod                 v1.0]
        ******************************************************/
        switch($row['user_avatar_type'])
        {
           case USER_AVATAR_UPLOAD:
           $current_avatar = $board_config['avatar_path'] . '/' . $row['user_avatar'];
           break;
           case USER_AVATAR_REMOTE:
           $current_avatar = resize_avatar($row['user_avatar']);
           break;
           case USER_AVATAR_GALLERY:
           $current_avatar = $board_config['avatar_gallery_path'] . '/' . (($row['user_avatar'] 
			== 'blank.png' || $row['user_avatar'] == 'gallery/blank.png') ? 'blank.png' : $row['user_avatar']);
           break;
		}
        /*****[END]********************************************
        [ Mod:    Forum Index Avatar Mod                 v1.0]
         ******************************************************/
		
		# Number of Posts
		$posts = ($row['user_posts']) ? '<a href="modules.php?name=Forums&file=search&search_author='.$username.'">'.$row['user_posts'].'</a>' : 0;
		
		# Private message link
		$pm = '<a href="'.append_sid("privmsg.$phpEx?mode=post&amp;".POST_USERS_URL."=$user_id").'"><img class="tooltip-html copyright" alt="Male" 
		title="Send A Private Message To '.$username.'" width="30"alt="online" src="themes/'.$theme_name.'/forums/images/status/icons8-send-80.png" /></a>';
		
		# does the person have a dick START
		if($row['user_gender'] ==1)
		$gender = '<img class="tooltip-html copyright" alt="Male" title="Male" width="30"alt="online" src="themes/'.$theme_name.'/forums/images/status/icons8-person-male-skin-type-5-80.png" />';
		elseif($row['user_gender'] == 2)
		$gender = '<img class="tooltip-html copyright" alt="Female" title="Female" width="30"alt="online" src="themes/'.$theme_name.'/forums/images/status/icons8-person-female-80.png" />';
		else // show an invisble picel when the person does not specify sex
		$gender = '<img class="tooltip-html copyright" alt="Undecided" title="Undecided" width="1" src="themes/'.$theme_name.'/images/invisible_pixel.gif" />';
		
		# does the person have a dick END
		
		# facebook mod v1.0 START
		if(!empty($row['user_facebook']))
		$facebook = '<a href="https://www.facebook.com/'.$row['user_facebook'].'" target="_blank"><img class="tooltip-html copyright" alt="Male" title="View '.$username.'\'s Facebook Page" 
		width="30"alt="online" src="themes/'.$theme_name.'/forums/images/status/icons8-facebook-80.png" /></a>';
		else
		$facebook = '';
		# facebook mod v1.0 END
		
		# USers last visit
		$last_visit = ($row['user_lastvisit'] == 0) ? '' : formatTimestamp($row['user_lastvisit'],'M d, Y');

       # This is broken in UK version
	   # Mod: Online/Offline/Hidden v2.2.7 START
	   if(!$row['user_allow_viewonline']):
	   $online_status = '<img class="tooltip-html copyright" alt="Hidden" title="Hidden" alt="Hidden" width="30" height="30" 
	   src="themes/'.$theme_name.'/forums/images/status/icons8-invisible-512.png" />';
   
	   elseif($row['user_session_time'] >= (time()-$board_config['online_time'])):
	   $theme_name = get_theme();
	   $online_status = '<a class="tooltip-html copyright" href="'.append_sid("viewonline.$phpEx").'" title="'.sprintf($lang['is_online'],$row['username']).'"'.$online_color.'><img 
	   alt="online" src="themes/'.$theme_name.'/forums/images/status/online_bgcolor_one.gif" /></a>';
	   else:
       $online_status = '<span class="tooltip-html copyright" title="'.sprintf($lang['is_offline'],$row['username']).'"'.$offline_color.'><img 
	   alt="online" src="themes/'.$theme_name.'/forums/images/status/offline_bgcolor_one.gif" /></span>';
       endif;
       # Mod: Online/Offline/Hidden v2.2.7 END
        
		if(strlen((string) $user_from) == 6)
		$user_from = 'The InterWebs';

        if (!is_admin())
        if(!$row['user_allow_viewonline'])
		continue;
		
        # Alternate the row class
        $row_class = ( !($i % 2) ) ? 'row2' : 'row3';
		$template->assign_block_vars('memberrow', ['ROW_NUMBER' => $i + ( $start + 1 ), 
		                                           'ROW_CLASS' => $row_class, 
												   'USERNAME' => UsernameColor($row['username']), 
												   'FROM' => $user_from, 
												   'FLAG' => $user_flag, 
												   'JOINED' => $joined, 
												   'AGE' => $age, 
												   'POSTS' => $posts, 
												   'PM' => $pm, 
												   'WWW' => $www, 
												   'GENDER' => $pm.' '.$www.' '.$facebook.' '.$gender, 
												   'LAST_ACTIVE' => $last_visit, 
												   'FACEBOOK' => $facebook, 
												   'STATUS' => $online_status, 
												   'CURRENT_AVATAR' => '<img class="rounded-corners-header" height="auto" width="30" src="'.$current_avatar.'">&nbsp;', 
												   'U_VIEWPROFILE' => "modules.php?name=Profile&mode=viewprofile&amp;" . POST_USERS_URL . "=$user_id"]
		);
		$i++;
	} 
	while ( $row = $db->sql_fetchrow($result) );
	$db->sql_freeresult($result);

else:
	$template->assign_block_vars('no_username', ['NO_USER_ID_SPECIFIED' => $lang['No_user_id_members_list_specified']]
	);
endif;

$total_found = $db->sql_unumrows($sql);

# Generate the page numbers
$alphanum 	= ( isset($_POST['alphanum']) ) ? htmlspecialchars((string) isset($_POST['alphanum'])) : htmlspecialchars((string) isset($_GET['alphanum']));
$where 		= ( $alphanum == 'num' ) ? " AND `username` NOT RLIKE '^[A-Z]' " : " AND `username` LIKE '".$alphanum."%' ";
$sql1 		= "SELECT count(*) AS total FROM " . USERS_TABLE . " WHERE user_id <> " . ANONYMOUS.$where;
$result1 	= $db->sql_query($sql1);
$total 		= $db->sql_fetchrow($result1);

if($total['total'] > $board_config['topics_per_page'] && $mode != 'topten' || $board_config['topics_per_page'] < 10):
	if(isset($pageroot))
	$page = intval($pageroot);
	else
	$page = 1;
	$pagination = '';
	$redirect = 'modules.php?name=Members_List'.(($_GET['mode']) ? '&mode=letter&alphanum='.$_GET['alphanum'] : '');
	if(isset($page)):
		$totalPages = ceil($total['total'] / $board_config['topics_per_page']);
		if($totalPages == 1)
		return '';
		$on_page = floor($start / $board_config['topics_per_page']) + 1;
		if($totalPages > 10):
			$init_page_max = ( $totalPages > 3 ) ? 3 : $totalPages;
			for($i = 1; $i < $init_page_max + 1; $i++):
				$pagination .= ( $i == $on_page ) ? '<span style="font-weight:bold; font-size:13px;">'.$i.'</span>' : '<a href="'.$redirect.'&amp;page='.$i.'"><span>'.$i.'</span></a>';
				if ( $i <  $init_page_max )
				$pagination .= "&nbsp;";
			endfor;
			 if($totalPages > 3):
				if($on_page > 1 && $on_page < $totalPages):
					$pagination .= ( $on_page > 5 ) ? ' ... ' : '&nbsp;';
					$init_page_min = ( $on_page > 4 ) ? $on_page : 5;
					$init_page_max = ( $on_page < $totalPages - 4 ) ? $on_page : $totalPages - 4;
					for($i = $init_page_min - 1; $i < $init_page_max + 2; $i++):
						$pagination .= ($i == $on_page) ? '<span style="font-weight:bold; font-size:13px;">'.$i.'</span>' : '<a href="'.$redirect.'&amp;page='.$i.'"><span>'.$i.'</span></a>';
						if ( $i <  $init_page_max + 1 )
							$pagination .= '&nbsp;';
					endfor;
					$pagination .= ( $on_page < $totalPages - 4 ) ? ' ... ' : '&nbsp;';
				else:
					$pagination .= ' ... ';
				endif;
				for($i = $totalPages - 2; $i < $totalPages + 1; $i++):
					$pagination .= ( $i == $on_page ) ? '<span style="font-weight:bold; font-size:13px;">'.$i.'</span>'  : '<a href="'.$redirect.'&amp;page='.$i.'"><span>'.$i.'</span></a>';
					if( $i <  $totalPages )
						$pagination .= "&nbsp;";
				endfor;		
			endif;
		else:
			for($i = 1; $i < $totalPages + 1; $i++):
				$pagination .= ( $i == $on_page ) ? '<span style="font-weight:bold; font-size:13px;">'.$i.'</span>' : '<a href="'.$redirect.'&amp;page='.$i.'"><span>'.$i.'</span></a>';
				if ( $i <  $totalPages )
			    $pagination .= '&nbsp;';
			endfor;
		endif;
		if($page <= 1):
			$pagination = '<span>'.$lang['Goto_page_prev'].'</span>&nbsp;'.$pagination.'&nbsp';
		else:
			$j = $page - 1;
			$pagination = '<span><a href="'.$redirect.'&amp;page='.$j.'">'.$lang['Goto_page_prev'].'</a></span>&nbsp;'.$pagination.'&nbsp;';
		endif;
		if($page == $totalPages):
			$pagination .= '<span>'.$lang['Goto_page_next'].'</span>';
		else:
			$j = $page + 1;
			$pagination .= '<a href="'.$redirect.'&amp;page='.$j.'">'.$lang['Goto_page_next'].'</a>';
		endif;
	endif;
	$template->assign_block_vars('pagination', ['PAGINATION'	=> $pagination, 
	                                            'TOTAL' 		=> $total_found, 
												'PERPAGE'		=> $board_config['topics_per_page']]
	);
endif;
$template->pparse('body');
include(NUKE_INCLUDE_DIR.'page_tail.php');

