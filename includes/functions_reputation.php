<?php
/***************************************************************************
 *                            functions_reputation.php
 *                            -------------------
 *   begin                : Wednesday, February 15, 2006
 *   copyright            : (C) 2006 Anton Granik
 *   email                : anton@granik.com
 *   web                : http://granik.com
 *
 *   $Id: functions_reputation.php, v.1.0.0 2006/Mar/25 14:43:00 antongranik Exp $
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

if (!defined('IN_PHPBB'))
{
  die('Hacking attempt');
}

//
// This function makes the reputation medals
// according to the reputation on input ($rep)
//
function get_reputation_medals($rep)
{
  global $rep_config, $reputation, $lang, $phpbb_root_path;

  if ($rep > 0)
  {
    $temp = $rep / $rep_config['medal1_to_earn'];
    if ($temp >= 1)
    {
      for ($k=1; $k<=round($temp); $k++)
      {
        $reputation .= '<img src="' . $phpbb_root_path . 'images/reputation_medal_size_1.gif" alt="' . $lang['Reputation'] . ': ' .  round($rep,1) . '" title="' . $lang['Reputation'] . ': ' . round($rep,1) . '" border="0">';
      }
    }
    else if ($temp < 1)
    {
      $temp = $rep / $rep_config['medal2_to_earn'];
      if ($temp >= 1)
      {
        for ($k=1; $k<=round($temp); $k++)
        {
          $reputation .= '<img src="' . $phpbb_root_path . 'images/reputation_medal_size_2.gif" alt="' . $lang['Reputation'] . ': ' . round($rep,1) . '" title="' . $lang['Reputation'] . ': ' . round($rep,1) . '" border="0">';
        }
      } else if ($temp < 1)
      {
        $temp = $rep / $rep_config['medal3_to_earn'];
        if ($temp >= 1)
        {
          for ($k=1; $k<=round($temp); $k++)
          {
            $reputation .= '<img src="' . $phpbb_root_path . 'images/reputation_medal_size_3.gif" alt="' . $lang['Reputation'] . ': ' . round($rep,1) . '" title="' . $lang['Reputation'] . ': ' . round($rep,1) . '" border="0">';
          }
        } else if ($temp < 1)
        {
          $temp = $rep / $rep_config['medal4_to_earn'];
          if ($temp >= 1)
          {
            for ($k=1; $k<=round($temp); $k++)
            {
              $reputation .= '<img src="' . $phpbb_root_path . 'images/reputation_medal_size_4.gif" alt="' . $lang['Reputation'] . ': ' . round($rep,1) . '" title="' . $lang['Reputation'] . ': ' . round($rep,1) . '" border="0">';
            }
          } else if ($temp < 1)
          {
            for ($k=1; $k<=$rep; $k++)
            {
              $reputation .= '<img src="' . $phpbb_root_path . 'images/reputation_medal_size_5.gif" alt="' . $lang['Reputation'] . ': ' . round($rep,1) . '" title="' . $lang['Reputation'] . ': ' . round($rep,1) . '" border="0">';
            }
          }
        }
      }
    }
  } else if ($rep < 0)
  $reputation = '<img src="' . $phpbb_root_path . 'images/reputation_medal_neg.gif" alt="' . $lang['Reputation'] . ': ' . round($rep,1) . '" title="' . $lang['Reputation'] . ': ' . round($rep,1) . '" border="0">';

  return $reputation;
}


//
// This function will send the PM to the user $user_2id
// (borrowed from privmsg.php)
//
function r_send_pm(&$user_id, &$user_2id, &$rep_sum, &$user_ip)
{
  global $lang, $db;

  $msg_time = time();
  $sql_info = "INSERT INTO " . PRIVMSGS_TABLE . " (privmsgs_type, privmsgs_subject, privmsgs_from_userid, privmsgs_to_userid, privmsgs_date, privmsgs_ip, privmsgs_enable_html, privmsgs_enable_bbcode, privmsgs_enable_smilies, privmsgs_attach_sig)
        VALUES (" . PRIVMSGS_NEW_MAIL . ", '" . str_replace("\'", "''", $lang['PM_notify_subj']) . "' , " . $user_id . ", " . $user_2id . ", $msg_time, '$user_ip', 0, 1, 0, 0)";
  if ( !($result = $db->sql_query($sql_info, BEGIN_TRANSACTION)) )
  {
    message_die(GENERAL_ERROR, "Could not insert/update private message sent info.", "", __LINE__, __FILE__, $sql_info);
  }

  $next_id = $db->sql_nextid();
  $bbcode_uid = make_bbcode_uid();

  $privmsg_message = sprintf($lang['PM_notify_text'], $rep_sum);
  $sql = "INSERT INTO " . PRIVMSGS_TEXT_TABLE . " (privmsgs_text_id, privmsgs_bbcode_uid, privmsgs_text)
    VALUES ($next_id, '" . $bbcode_uid . "', '" . str_replace("\'", "''", $privmsg_message) . "')";
  if ( !$db->sql_query($sql, END_TRANSACTION) )
  {
    message_die(GENERAL_ERROR, "Could not insert/update private message sent text.", "", __LINE__, __FILE__, $sql_info);
  }

  //
  // Add to the users new pm counter
  //
  $sql = "UPDATE " . USERS_TABLE . "
    SET user_new_privmsg = user_new_privmsg + 1, user_last_privmsg = " . $msg_time . "
    WHERE user_id = " . $user_2id;
  if ( !$status = $db->sql_query($sql) )
  {
    message_die(GENERAL_ERROR, 'Could not update private message new/read status for user', '', __LINE__, __FILE__, $sql);
  }

  return;
}


//
// This function updates the reputations for the user,
// earned by posting and by "living" on forum
//
function update_reputations(&$mode, &$user_id)
{
  global $db, $rep_config, $userdata;

  if ($userdata['user_id'] == ANONYMOUS)
  {
    $last_time = time();
  } else
  {
    if ($rep_config['posts_to_earn'] != 0)
    {
      $sign_rep = ($mode == 'delete') ? '- ' . (1/$rep_config['posts_to_earn']) : '+ ' . (1/$rep_config['posts_to_earn']);
    } else
    {
      $sign_rep = ' + 0';
    }

    $last_time = ($userdata['user_rep_last_time'] == 0) ? time() : $userdata['user_rep_last_time'];
    $dif = time() - $last_time;
    $dif = round($dif/86400,0);
    if ($dif > 1)
    {
      if ($rep_config['days_to_earn'] != 0)
      {
        $sign_rep .= ' + ' . $dif / $rep_config['days_to_earn'];
      } else
      {
        $sign_rep .= ' + 0';
      }
      $last_time = time();
    }
  }

  if ($mode != 'poll_delete')
  {
    $sql = "UPDATE " . USERS_TABLE . "
        SET user_reputation = user_reputation $sign_rep, user_rep_last_time = $last_time
        WHERE user_id = $user_id";
    if (!$db->sql_query($sql))
    {
      message_die(GENERAL_ERROR, 'Error in updating the reputations', '', __LINE__, __FILE__, $sql);
    }
  }

  return;
}
?>