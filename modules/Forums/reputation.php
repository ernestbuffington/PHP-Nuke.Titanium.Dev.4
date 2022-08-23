<?php
/***************************************************************************
 *                             reputation.php
 *                            -------------------
 *   begin                : Wednesday, February 01, 2006
 *   copyright            : (C) 2006 Anton Granik
 *   email                : anton@granik.com
 *   web                : http://granik.com
 *
 *   $Id: reputation.php, v.1.0.0 2006/Mar/25 14:43:00 antongranik Exp $
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
-=[Mod]=-
      Advanced Username Color                  v1.0.5       12/11/2006
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}

define('IN_PHPBB', true);
$phpbb_root_path = NUKE_FORUMS_DIR;
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);
include($phpbb_root_path . 'reputation_common.'.$phpEx);
include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_reputation.' . $phpEx);

$userdata = session_pagestart($user_ip, PAGE_REPUTATION);
init_userprefs($userdata);

if ( empty($HTTP_GET_VARS["a"]) )
{
  message_die(GENERAL_MESSAGE, $lang['No_action_specified']);
}
$action = $HTTP_GET_VARS["a"];

$page_title = $lang['Reputation'];
$gen_simple_header = TRUE;
include('includes/page_header.'.$phpEx);
include('includes/functions_reputation.'.$phpEx);
include('includes/bbcode.'.$phpEx);

$template->set_filenames(array(
        'body' => 'reputation.tpl')
);

if ( !$userdata['session_logged_in'] )
{
  $message = $lang['Guests_cant_view_history'];
  message_die(GENERAL_MESSAGE, $message);
}

switch( $action  )
{
  case 'post':
    if ( empty($HTTP_POST_VARS['user_id_to_give']) || !isset($HTTP_POST_VARS['user_id_to_give']) )
    {
      message_die(GENERAL_MESSAGE, $lang['No_user']);
    }
    if ( empty($HTTP_POST_VARS['post_id_to_give']) || !isset($HTTP_POST_VARS['post_id_to_give']) )
    {
      message_die(GENERAL_MESSAGE, $lang['No_post']);
    }
    if ( empty($HTTP_POST_VARS['submit']) || !isset($HTTP_POST_VARS['submit']) )
    {
      message_die(GENERAL_MESSAGE, $lang['No_action_specified']);
    }
    if ( empty($HTTP_POST_VARS['ccode']) || !isset($HTTP_POST_VARS['ccode']) )
    {
      message_die(GENERAL_MESSAGE, $lang['No_check_code']);
    }

    $userid = intval($HTTP_POST_VARS['user_id_to_give']);
    $postid = intval($HTTP_POST_VARS['post_id_to_give']);
    $repsum = intval($HTTP_POST_VARS['rep_sum_to_give']);
    $repneg = intval($HTTP_POST_VARS['rep_neg_to_give']);
    $repcom = htmlspecialchars($HTTP_POST_VARS['rep_comment_to_give']);
    $reptime = time();
    $ccode = htmlspecialchars($HTTP_POST_VARS['ccode']);

    if ($repsum > $userdata['user_reputation'])
    {
      message_die(GENERAL_ERROR, $lang['Cant_give_more_than_have']);
    }
    if ($repsum == 0)
    {
      message_die(GENERAL_ERROR, $lang['Cant_give_zero']);
    } else if ($repsum < 0) {
      message_die(GENERAL_ERROR, $lang['Cant_give_subzero']);
    }
    if (($repsum > $rep_config['repsum_limit']) && ($rep_config['repsum_limit'] != 0))
    {
      message_die(GENERAL_ERROR, sprintf($lang['No_more_than_limit'], $rep_config['repsum_limit']));
    }

    // Check "ccode" of the post
    $sql = "SELECT p.bbcode_uid
        FROM " . POSTS_TEXT_TABLE . " AS p
        WHERE p.post_id = " . $postid;
    if ( !($result = $db->sql_query($sql)) )
    {
      message_die(GENERAL_ERROR, "Could not obtain information from posts", '', __LINE__, __FILE__, $sql);
    }
    $row = $db->sql_fetchrow($result);
    if ( !(substr(md5($row['bbcode_uid']),0,8) == $ccode) )
    {
      message_die(GENERAL_MESSAGE, $lang['Wrong_check_code']);
    }

    if ( $userdata['user_level'] != ADMIN && $userdata['user_level'] != MOD )
    {
      // Is the user the same as the last one the GIVER has given the reputation to?
      // And get the last reputation given time of the GIVER to compute flood time
      $sql = "SELECT r.user_id, r.user_id_2, r.rep_time
          FROM " . REPUTATION_TABLE . " AS r
          WHERE r.user_id_2 = " . $userdata['user_id'] . "
          ORDER BY r.rep_time DESC LIMIT 1";
      if ( !($result = $db->sql_query($sql)) )
      {
        message_die(GENERAL_ERROR, "Could not obtain user", '', __LINE__, __FILE__, $sql);
      }
      $row = $db->sql_fetchrow($result);
      if ($row['user_id'] == $userid)
      {
        message_die(GENERAL_MESSAGE, $lang['Cant_give_the_same_user']);
      }
      if ( ((time() - $row['rep_time']) / 60) < ($rep_config['flood_control_time']) )
      {
        message_die(GENERAL_MESSAGE, sprintf($lang['Too_little_time'], $rep_config['flood_control_time']));
      }
    }

    $sql = "SELECT u.user_id, u.username, u.user_reputation
        FROM " . USERS_TABLE . " AS u
        WHERE u.user_id = " . $userid;
    if ( !($result = $db->sql_query($sql)) )
    {
      message_die(GENERAL_ERROR, "Could not obtain user", '', __LINE__, __FILE__, $sql);
    }
    $row = $db->sql_fetchrow($result);
    if ($userdata['user_reputation'] > $row['user_reputation'])
    {
      if ($userdata['user_reputation'] >= $rep_config['medal1_to_earn']) // >= medal1?
      {
        $mul = 1.4;
      } else if ($userdata['user_reputation'] >= $rep_config['medal2_to_earn']) // >= medal2 && < medal1
      {
        $mul = 1.3;
      } else if ($userdata['user_reputation'] >= $rep_config['medal3_to_earn']) // >=medal3 && <medal2 && <medal1
      {
        $mul = 1.2;
      } else
      {
        $mul = 1.1;
      }
    } else
    {
      $mul = 1;
    }

    $repsum_mul = $repsum*$mul;
    $sign_rep = ($repneg == 0) ? '+ ' . $repsum_mul : '- ' . $repsum_mul;
    $sql = "INSERT INTO " . REPUTATION_TABLE . "
        (user_id, user_id_2, post_id, rep_sum, rep_neg,  rep_comment, rep_time)
        VALUES ('$userid', '$userdata[user_id]', '$postid', '$repsum_mul', '$repneg', '$repcom', '$reptime')";
    if ( !($result = $db->sql_query($sql)) )
    {
      message_die(GENERAL_ERROR, "Could not insert reputation for the user", '', __LINE__, __FILE__, $sql);
    }
    $sql = "UPDATE " . USERS_TABLE . "
        SET user_reputation = user_reputation $sign_rep
        WHERE user_id = " . $userid;
    if ( !($result = $db->sql_query($sql)) )
    {
      message_die(GENERAL_ERROR, "Could not update reputation for the user", '', __LINE__, __FILE__, $sql);
    }

    if ($rep_config['given_rep_to_earn'] != 0)
    {
      $repsum -= $repsum/$rep_config['given_rep_to_earn'];
    }
    $sql = "UPDATE " . USERS_TABLE . "
        SET user_reputation = user_reputation - $repsum
        WHERE user_id = " . $userdata[user_id];
    if ( !($result = $db->sql_query($sql)) )
    {
      message_die(GENERAL_ERROR, "Could not update reputation for the user", '', __LINE__, __FILE__, $sql);
    }

    if ($rep_config['pm_notify'] != 0)
    {
      r_send_pm($userdata['user_id'], $userid, $repsum_mul, $user_ip);
    }

    $msg = $lang['Reputation_has_given'] . '<br /><br />' . sprintf($lang['Click_here_return_rep'], '<a href="' . append_sid("reputation.$phpEx?a=stats&amp;u=".$userid) . '">', '</a> ') . '<br /><br />' . sprintf('%s'.$lang['Close_window'].'%s', '<a href="javascript:self.close();void(0);">', '</a>');
    //$msg = $lang['Reputation_has_given'] . '<br /><br />' . sprintf($lang['Click_here_return_rep'], '<a href="modules.php?name=Forums&amp;file=reputation&amp;a=stats&amp;u=$userid)">', '</a> ') . '<br /><br />' . sprintf('%s'.$lang['Close_window'].'%s', '<a href="javascript:self.close();void(0);">', '</a>');
    message_die(GENERAL_MESSAGE, $msg);
    break;

  case 'add':
    if ($userdata['user_reputation'] == 0)
    {
      message_die(GENERAL_MESSAGE, $lang['You_have_zero_rep']);
    } else if ($userdata['user_reputation'] < 0)
    {
      message_die(GENERAL_MESSAGE, $lang['You_have_neg_rep']);
    }
    if ( empty($HTTP_GET_VARS[POST_USERS_URL]) || $HTTP_GET_VARS[POST_USERS_URL] == ANONYMOUS )
    {
      message_die(GENERAL_MESSAGE, $lang['No_user_id_specified']);
    }
    $userid = intval($HTTP_GET_VARS[POST_USERS_URL]);
    $sql = "SELECT u.user_id, u.username
        FROM " . USERS_TABLE . " AS u
        WHERE u.user_id = " . $userid;
    if ( !($result = $db->sql_query($sql)) )
    {
      message_die(GENERAL_ERROR, "Could not obtain user", '', __LINE__, __FILE__, $sql);
    }
    if ( !($row = $db->sql_fetchrow($result)) )
    {
      message_die(GENERAL_MESSAGE, $lang['No_such_user']);
    } else {
      $username = $row['username'];
    }
    if ( empty($HTTP_GET_VARS[POST_POST_URL]) )
    {
      message_die(GENERAL_MESSAGE, $lang['No_post_id_specified']);
    }
    if ( empty($HTTP_GET_VARS["c"]) )
    {
      message_die(GENERAL_MESSAGE, $lang['No_check_code']);
    }
    if ($row['user_id'] == $userdata['user_id'])
    {
      message_die(GENERAL_MESSAGE, $lang['Cant_give_yourself']);
    }
    $ccode = $HTTP_GET_VARS["c"];
    $postid = intval($HTTP_GET_VARS[POST_POST_URL]);

    if ( $userdata['user_level'] != ADMIN && $userdata['user_level'] != MOD )
    {
      // Is the user the same as the last one the GIVER has given the reputation to?
      // And get the last reputation given time of the GIVER to compute flood time
      $sql = "SELECT r.user_id, r.user_id_2, r.rep_time
          FROM " . REPUTATION_TABLE . " AS r
          WHERE r.user_id_2 = " . $userdata['user_id'] . "
          ORDER BY r.rep_time DESC LIMIT 1";
      if ( !($result = $db->sql_query($sql)) )
      {
        message_die(GENERAL_ERROR, "Could not obtain user", '', __LINE__, __FILE__, $sql);
      }
      $row = $db->sql_fetchrow($result);
      if ($row['user_id'] == $userid)
      {
        message_die(GENERAL_MESSAGE, $lang['Cant_give_the_same_user']);
      }
      if ( ((time() - $row['rep_time']) / 60) < ($rep_config['flood_control_time']) )
      {
        message_die(GENERAL_MESSAGE, sprintf($lang['Too_little_time'], $rep_config['flood_control_time']));
      }
    }

    // Check "ccode" of the post
    $sql = "SELECT p.bbcode_uid
        FROM " . POSTS_TEXT_TABLE . " AS p
        WHERE p.post_id = " . $postid;
    if ( !($result = $db->sql_query($sql)) )
    {
      message_die(GENERAL_ERROR, "Could not obtain information from posts", '', __LINE__, __FILE__, $sql);
    }
    $row = $db->sql_fetchrow($result);
    if ( !(substr(md5($row['bbcode_uid']),0,8) == $ccode) )
    {
      message_die(GENERAL_MESSAGE, $lang['Wrong_check_code']);
    }

    $template->assign_block_vars("rep_add", array(
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
      "USERNAME" => UsernameColor($username),
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
      "U_USERID" => append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=' . $userid),
      "STATREP_COLOR" => ($rep_sum >= 0) ? "green" : "red",
      "REPSUM" => round($userdata['user_reputation'],1),
      "USER_ID_TO_GIVE" => $userid,
      "POST_ID_TO_GIVE" => $postid,

      "L_REPUTATIONGIVING" => $lang['Rep_giving'],
      "L_YOUHAVEPOINTS" => $lang['You_have_points'],
      "L_DESCR" => $lang['Description'],
      "L_FORM" => $lang['Form'],
      "L_ENTERREPSUM" => $lang['Enter_repsum'],
      "L_ENTERREPSUM_EXPLAIN" => $lang['Enter_repsum_explain'],
      "L_CHOOSEDIR" => $lang['Choose_dir'],
      "L_CHOOSEDIR_EXPLAIN" => $lang['Choose_dir_explain'],
      "L_ENTERCOMMENT" => $lang['Enter_comment'],
      "L_ENTERCOMMENT_EXPLAIN" => $lang['Enter_comment_explain'],
      "L_GIVE" => $lang['Give'],
      "CCODE" => $ccode,
    ));

    if ($rep_config['default_amount'] > 0)
    {
      $template->assign_vars(array(
        "SIMPLE_HIDDEN" => '<input type="hidden" name="rep_sum_to_give" value="' . $rep_config['default_amount'] . '">'
      ));
    } else {
      $template->assign_block_vars("rep_add.switch_adv_mode", array(
      ));
    }
    break;


  case 'globalstats':
    $start = ( isset($HTTP_GET_VARS['start']) ) ? intval($HTTP_GET_VARS['start']) : 0;
    $sql = "SELECT COUNT(user_id) AS total_count, SUM(rep_sum) AS total_sum
        FROM " . REPUTATION_TABLE;
    if ( !($result = $db->sql_query($sql)) )
    {
      message_die(GENERAL_ERROR, "Could not obtain reputation stats", '', __LINE__, __FILE__, $sql);
    }
    $row = $db->sql_fetchrow($result);
    $total_count = $row['total_count'];
    $total_sum = round($row['total_sum'],2);

    $sql = "SELECT u.username, r.user_id_2, r.rep_sum
        FROM " . REPUTATION_TABLE . " AS r
        LEFT JOIN " . USERS_TABLE . " AS u ON
          u.user_id = r.user_id_2
        ORDER BY rep_sum DESC
        LIMIT 1";
    if ( !($result = $db->sql_query($sql)) )
    {
      message_die(GENERAL_ERROR, "Could not obtain reputation stats", '', __LINE__, __FILE__, $sql);
    }
    $row = $db->sql_fetchrow($result);
    $max_repsum = $row['rep_sum'];
    $max_repsum_userid = $row['user_id_2'];
    $max_repsum_username = $row['username'];

    $sql = "SELECT username, user_id, user_reputation
        FROM " . USERS_TABLE . "
        ORDER BY user_reputation DESC
        LIMIT 1";
    if ( !($result = $db->sql_query($sql)) )
    {
      message_die(GENERAL_ERROR, "Could not obtain reputation stats", '', __LINE__, __FILE__, $sql);
    }
    $row = $db->sql_fetchrow($result);
    $max_userrep = round($row['user_reputation'],2);
    $max_userrep_userid = $row['user_id'];
    $max_userrep_username = $row['username'];

    $sql = "SELECT username, user_id, user_reputation
        FROM " . USERS_TABLE . "
        ORDER BY user_reputation ASC
        LIMIT 1";
    if ( !($result = $db->sql_query($sql)) )
    {
      message_die(GENERAL_ERROR, "Could not obtain reputation stats", '', __LINE__, __FILE__, $sql);
    }
    $row = $db->sql_fetchrow($result);
    $min_userrep = round($row['user_reputation'],2);
    $min_userrep_userid = $row['user_id'];
    $min_userrep_username = $row['username'];

    $sql = "SELECT u.username, r.user_id_2, SUM(r.rep_sum) AS total_repsum, COUNT(r.rep_sum) AS count_sum
        FROM " . REPUTATION_TABLE . " AS r
        LEFT JOIN " . USERS_TABLE . " AS u ON
          u.user_id = r.user_id_2
        GROUP BY r.user_id_2
        ORDER BY total_repsum DESC";
    if ( !($result = $db->sql_query($sql)) )
    {
      message_die(GENERAL_ERROR, "Could not obtain reputation stats", '', __LINE__, __FILE__, $sql);
    }
    $row = $db->sql_fetchrow($result);
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
    $active_user = UsernameColor($row['username']);
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
    $active_user_id = $row['user_id_2'];
    $active_user_repsum = round($row['total_repsum'],2);
    $active_user_count_sum = $row['count_sum'];

    $pagination = generate_pagination("reputation.$phpEx?a=globalstats", $total_count, 15, $start). '&nbsp;';
    $template->assign_block_vars("rep_globalstats", array(
      "L_WHO" => $lang['Who'],
      "L_WHOM" => $lang['Whom'],
      "L_DIR" => $lang['Dir'],
      "L_HOWMUCH" => $lang['How_much'],
      "L_POST" => $lang['Post'],
      "L_COMMENT" => $lang['Comment'],
      "L_DATE" => $lang['Date'],
      "L_REPUTATION" => $lang['Reputation'],
      "L_RECEIVEDREPUTATION" => $lang['Received_rep'],
      "L_GIVENREPUTATION" => $lang['Given_rep'],
      "L_GLOBALSTATS" => $lang['Global_stats'],
      "L_TOTAL_GIVEN_BY_USERS" => $lang['Total_given_by_users'],
      "L_ACTIVE_USER" => $lang['Active_user'],
      "L_BEST_REP_USER" => $lang['Best_rep_user'],
      "L_WORST_REP_USER" => $lang['Worst_rep_user'],
      "L_MAX_GIVEN_SUM" => $lang['Max_given_sum'],

      "TOTAL_GIVEN_BY_USERS" => sprintf($lang['Points_in_givings'],$total_sum,$total_count),
      "MAX_USERREP" => $max_userrep,
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
      "MAX_USERREP_USERNAME" => UsernameColor($max_userrep_username),
      "MIN_USERREP" => $min_userrep,
      "MIN_USERREP_USERNAME" => UsernameColor($min_userrep_username),
      "ACTIVE_USER" => $active_user,
      "TOTAL_GIVEN_BY_ACTIVE_USER" => sprintf($lang['Points_in_givings'],$active_user_repsum,$active_user_count_sum),
      "MAX_USERNAME" => UsernameColor($max_username),
      "MAX_REPSUM" => $max_repsum,
      "MAX_REPSUM_USERNAME" => UsernameColor($max_repsum_username),
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/

      "U_MAX_USERREP_USERID" => append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=' . $max_userrep_userid),
      "U_MIN_USERREP_USERID" => append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=' . $min_userrep_userid),
      "U_MAX_REPSUM_USERID" => append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=' . $max_repsum_userid),
      "U_ACTIVE_USER_ID" => append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=' . $active_user_id),

      "PAGINATION" => $pagination,
    ));

    $sql = "SELECT r.*, u.username, u.user_id, t.topic_title, f.forum_id, p.post_id
        FROM " . REPUTATION_TABLE . " AS r
        LEFT JOIN " . USERS_TABLE . " AS u ON
          u.user_id = r.user_id
        LEFT JOIN " . POSTS_TABLE . " AS p ON
          p.post_id = r.post_id
        LEFT JOIN " . TOPICS_TABLE . " AS t ON
          t.topic_id = p.topic_id
        LEFT JOIN " . FORUMS_TABLE . " AS f ON
          f.forum_id = t.forum_id
        ORDER BY r.rep_time DESC
        LIMIT $start, 15";
    if ( !($result = $db->sql_query($sql)) )
    {
      message_die(GENERAL_ERROR, "Could not obtain reputation stats", '', __LINE__, __FILE__, $sql);
    }
    while ($row = $db->sql_fetchrow($result))
    {
      $sql2 = "SELECT u.username, u.user_id
          FROM " . USERS_TABLE . " AS u
          WHERE u.user_id = " . $row['user_id_2'];
      if ( !($result2 = $db->sql_query($sql2)) )
      {
        message_die(GENERAL_ERROR, "Could not obtain data for this user", '', __LINE__, __FILE__, $sql);
      }
      $row2 = $db->sql_fetchrow($result2);
      if ($row['rep_neg'] == 1) // Если репутация отрицательная
      {
        $row['rep_neg'] = '<img src="' . $phpbb_root_path . 'images/reputation_neg.gif">';
      } else
      {
        $row['rep_neg'] = '<img src="' . $phpbb_root_path . 'images/reputation_pos.gif">';
      }
      $u_post = append_sid("viewtopic.$phpEx?" . POST_POST_URL . '=' . $row['post_id'] . "#" . $row['post_id']);
      $post = $row['topic_title'];
      //
      // Start auth check
      //
      $is_auth = array();
      $is_auth = auth(AUTH_ALL, $row['forum_id'], $userdata);

      if( !$is_auth['auth_view'] || !$is_auth['auth_read'] )
      {
        $u_post = '';
        $post = $lang['Hidden_post'];
      }
      //
      // End auth check
      //

      $template->assign_block_vars("rep_globalstats.row", array(
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
        "USERNAME" => UsernameColor($row['username']),
        "U_USERID" => append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=' . $row['user_id']),
        "USERNAME2" => UsernameColor($row2['username']),
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
        "U_USERID2" => append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=' . $row['user_id_2']),
        "REPNEG" => $row['rep_neg'],
        "REPSUM" => $row['rep_sum'],
        "REPCOMMENT" => $row['rep_comment'],
        "U_POST" => $u_post,
        "POST" => $post,
        "REPTIME" => create_date($board_config['default_dateformat'], $row['rep_time'], $board_config['board_timezone']),
      ));
    }
    break;


  case 'stats':
  default:
    if ( $rep_config['show_stats_to_mods'] == 1 && $userdata['user_level'] != ADMIN && $userdata['user_level'] != MOD )
    {
      message_die(GENERAL_MESSAGE, $lang['Stats_only_for_admins']);
    }
    if ( empty($HTTP_GET_VARS[POST_USERS_URL]) || $HTTP_GET_VARS[POST_USERS_URL] == ANONYMOUS )
    {
      message_die(GENERAL_MESSAGE, $lang['No_user_id_specified']);
    }
    $start = ( isset($HTTP_GET_VARS['start']) ) ? intval($HTTP_GET_VARS['start']) : 0;
    $userid = intval($HTTP_GET_VARS[POST_USERS_URL]);
    $sql = "SELECT u.user_id, u.username, u.user_reputation
        FROM " . USERS_TABLE . " AS u
        WHERE u.user_id = " . $userid . "
        GROUP BY u.user_id";
    if ( !($result = $db->sql_query($sql)) )
    {
      message_die(GENERAL_ERROR, "Could not obtain user", '', __LINE__, __FILE__, $sql);
    }
    if ( !($row = $db->sql_fetchrow($result)) )
    {
      message_die(GENERAL_MESSAGE, $lang['No_such_user']);
    } else {
      $username = $row['username'];
      $rep_sum = round($row['user_reputation'],1);
    }

    $sql = "SELECT COUNT(user_id) AS total_count
        FROM " . REPUTATION_TABLE . " AS r
        WHERE r.user_id = " . $userid . " OR r.user_id_2 = " . $userid;
    if ( !($result = $db->sql_query($sql)) )
    {
      message_die(GENERAL_ERROR, "Could not obtain reputation stats for this user", '', __LINE__, __FILE__, $sql);
    }
    $row = $db->sql_fetchrow($result);
    $total_count = $row['total_count'];

    $sql = "SELECT r.*
        FROM " . REPUTATION_TABLE . " AS r
        WHERE r.user_id = " . $userid . " OR r.user_id_2 = " . $userid;
    if ( !($result = $db->sql_query($sql)) )
    {
      message_die(GENERAL_ERROR, "Could not obtain reputation stats for this user", '', __LINE__, __FILE__, $sql);
    }

    // Computing stats
    $rep_negs = 0;      // Кол-во отрицательных голосов
    $rep_poss = 0;      // Кол-во положительных голосов
    $rep_given_sum = 0;   // Кол-во отданной репутации
    $rep_given_negs = 0;  // Кол-во отрицательных отданных голосов
    $rep_given_poss = 0;  // Кол-во положительных отданных голосов
    while ($row = $db->sql_fetchrow($result))
    {
      if ($row['rep_neg'] == 1 && $row['user_id'] == $userid) {
        $rep_negs++;
      } else if ($row['rep_neg'] == 0 && $row['user_id'] == $userid)  {
        $rep_poss++;
      } else if ($row['rep_neg'] == 1 && $row['user_id'] != $userid)  {
        $rep_given_sum = $rep_given_sum + $row['rep_sum'];
        $rep_given_negs++;
      } else if ($row['rep_neg'] == 0 && $row['user_id'] != $userid)  {
        $rep_given_sum = $rep_given_sum + $row['rep_sum'];
        $rep_given_poss++;
      }
    }

    $pagination = generate_pagination("reputation.$phpEx?a=stats&amp;" . POST_USERS_URL . "=" . $userid . "&amp;", $total_count, 15, $start). '&nbsp;';
    $template->assign_block_vars("rep_stats", array(
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
      "USERNAME" => UsernameColor($username),
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
      "U_USERID" => append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=' . $userid),
      "STATREP_COLOR" => ($rep_sum >= 0) ? "green" : "red",
      "STATREP_SUM" => $rep_sum,
      "STATREP_SUMPOS" => $rep_poss,
      "STATREP_SUMNEG" => $rep_negs,
      "STATREP_SUM_GIVEN" => $rep_given_sum,
      "STATREP_SUMPOS_GIVEN" => $rep_given_poss,
      "STATREP_SUMNEG_GIVEN" => $rep_given_negs,

      "L_REPUTATION" => $lang['Reputation'],
      "L_REPUTATION2" => $lang['Reputation2'],
      "L_TOTALRECEIVED" => $lang['Total_received'],
      "L_POSITIVE" => $lang['Positive'],
      "L_NEGATIVE" => $lang['Negative'],
      "L_TOTALGIVEN" => $lang['Total_given'],
      "L_VOTES" => $lang['Votes'],
      "L_WHO" => $lang['Who'],
      "L_WHOM" => $lang['Whom'],
      "L_DIR" => $lang['Dir'],
      "L_HOWMUCH" => $lang['How_much'],
      "L_POST" => $lang['Post'],
      "L_COMMENT" => $lang['Comment'],
      "L_DATE" => $lang['Date'],
      "L_RECEIVEDREPUTATION" => $lang['Received_rep'],
      "L_GIVENREPUTATION" => $lang['Given_rep'],
      "L_GLOBALSTATS" => $lang['Global_stats'],
      "U_GLOBALSTATS" => append_sid("reputation.$phpEx?a=globalstats"),

      "PAGINATION" => $pagination,
    ));

    $sql = "SELECT r.*, u.username, u.user_id, t.topic_title, f.forum_id, p.post_id
        FROM " . REPUTATION_TABLE . " AS r
        LEFT JOIN " . USERS_TABLE . " AS u ON
          u.user_id = r.user_id
        LEFT JOIN " . POSTS_TABLE . " AS p ON
          p.post_id = r.post_id
        LEFT JOIN " . TOPICS_TABLE . " AS t ON
          t.topic_id = p.topic_id
        LEFT JOIN " . FORUMS_TABLE . " AS f ON
          f.forum_id = t.forum_id
        WHERE r.user_id = " . $userid . " OR r.user_id_2 = " . $userid . "
        ORDER BY r.rep_time DESC
        LIMIT $start,15";
    if ( !($result = $db->sql_query($sql)) )
    {
      message_die(GENERAL_ERROR, "Could not obtain data for this post", '', __LINE__, __FILE__, $sql);
    }

    while ($row = $db->sql_fetchrow($result))
    {
      $sql2 = "SELECT u.username, u.user_id
          FROM " . USERS_TABLE . " AS u
          WHERE u.user_id = " . $row['user_id_2'];
      if ( !($result2 = $db->sql_query($sql2)) )
      {
        message_die(GENERAL_ERROR, "Could not obtain data for this user", '', __LINE__, __FILE__, $sql);
      }
      $row2 = $db->sql_fetchrow($result2);

      if ($row['rep_neg'] == 1) // Если репутация отрицательная
      {
        $row['rep_neg'] = '<img src="' . $phpbb_root_path . 'images/reputation_neg.gif">';
      } else
      {
        $row['rep_neg'] = '<img src="' . $phpbb_root_path . 'images/reputation_pos.gif">';
      }
      $u_post = append_sid("viewtopic.$phpEx?" . POST_POST_URL . '=' . $row['post_id'] . "#" . $row['post_id']);
      $post = $row['topic_title'];
      //
      // Start auth check
      //
      $is_auth = array();
      $is_auth = auth(AUTH_ALL, $row['forum_id'], $userdata);

      if( !$is_auth['auth_view'] || !$is_auth['auth_read'] )
      {
        $u_post = '';
        $post = $lang['Hidden_post'];
      }
      //
      // End auth check
      $template->assign_block_vars("rep_stats.row", array(
        "ROW" => ($row['user_id'] == $userid) ? "row1" : "row3",
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
        "USERNAME" => UsernameColor($row['username']),
        "U_USERID" => append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=' . $row['user_id']),
        "USERNAME2" => UsernameColor($row2['username']),
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
        "U_USERID2" => append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . '=' . $row['user_id_2']),
        "REPNEG" => $row['rep_neg'],
        "REPSUM" => $row['rep_sum'],
        "REPCOMMENT" => $row['rep_comment'],
        "U_POST" => $u_post,
        "POST" => $post,
        "REPTIME" => create_date($board_config['default_dateformat'], $row['rep_time'], $board_config['board_timezone']),
      ));
    }
    break;
}

$template->assign_vars(array(
  "L_CLOSEWINDOW" => $lang['Close_window'],
));

$template->pparse('body');
include('includes/page_tail.'.$phpEx);

?>