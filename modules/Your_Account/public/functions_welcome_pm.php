<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/*******************************************************************
       File Name    : functions_welcome_pm.php
       Version        : 2.0.0
       Created by    : Technocrat (http://www.platinummods.com)
       Date            : 07/22/2005
  *******************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       07/22/2005
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}

define('IN_PHPBB', true);

include_once(NUKE_INCLUDE_DIR."bbcode.php");
include_once(NUKE_INCLUDE_DIR."functions_post.php");

//PM Sign Up
function change_post_msg($message,$ya_username)
{
	$message = str_replace("%NAME%", $ya_username, $message);
	return $message;
}

//PM Sign Up
function send_pm($new_uid,$ya_username)
{
    global $db, $prefix, $user_prefix, $board_config;

    if($board_config['welcome_pm'] != '1') { return; }

    $privmsgs_date = time();

    $sql = "SELECT * FROM ".$prefix."_welcome_pm";

    if ( !($result = $db->sql_query($sql)) )
    {
           echo "Could not obtain private message";
    }
    $row = $db->sql_fetchrow($result);
    $message = $row['msg'];
    $subject = $row['subject'];
    if(empty($message) || empty($subject)) {
        return;
    }
    $message 			= change_post_msg($message,$ya_username);
    $subject 			= change_post_msg($subject,$ya_username);
    $bbcode_uid 		= make_bbcode_uid();
    $privmsg_message 	= prepare_message($message, 1, 1, 1, $bbcode_uid);

    $from_userid = (!$board_config['welcome_pm_username']) ? 2 : 1;

    $sql = "INSERT INTO " . $prefix . "_bbprivmsgs (privmsgs_type, privmsgs_subject, privmsgs_from_userid, privmsgs_to_userid, privmsgs_date ) VALUES ('1', '".$subject."', '".$from_userid."', '".$new_uid."', ".$privmsgs_date.")";
    if ( !$db->sql_query($sql) )
    {
       echo "Could not insert private message sent info";
    }

    $privmsg_sent_id = $db->sql_nextid();
    $privmsg_message = addslashes($privmsg_message);

    $sql = "INSERT INTO " . $prefix . "_bbprivmsgs_text (privmsgs_text_id, privmsgs_bbcode_uid, privmsgs_text) VALUES ('".$privmsg_sent_id."', '".$bbcode_uid."', '".$privmsg_message."')";

    if ( !$db->sql_query($sql) )
    {
       echo "Could not insert private message sent text";
    }

    $sql = "UPDATE " . $user_prefix . "_users
            SET user_new_privmsg = user_new_privmsg + 1,  user_last_privmsg = '" . time() . "'
            WHERE user_id = $new_uid";
    if ( !($result = $db->sql_query($sql)) )
    {
         echo "Could not update users table";
    }

}

?>