<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                           functions_arcade.php
 *                            -------------------
 *
 *   PHPNuke Ported Arcade - http://www.nukearcade.com
 *   Original Arcade Mod phpBB by giefca - http://www.gf-phpbb.com
 *
 ***************************************************************************/

if (!defined('IN_PHPBB2'))
{
    die('ACCESS DENIED');
}

if ( file_exists('arcade_install.'.$phpEx) AND ($userdata['user_level'] == ADMIN))
{
$message = "Only the Administrator will see this message. <br /><br /> You MUST DELETE arcade_install.php FROM the site root before you can continue.";
message_die(GENERAL_ERROR, $message);
}

$language = $phpbb2_board_config['default_lang'];
if ( !file_exists($phpbb2_root_path . 'language/lang_' . $language . '/lang_main_arcade.'.$phpEx) )
{
    $language = 'english';
}

include($phpbb2_root_path . 'language/lang_' . $language . '/lang_main_arcade.' . $phpEx);

function read_arcade_config() {
        global $titanium_db;

        $arcade_config = array();
        $sql = "SELECT * FROM " . ARCADE_TABLE;

        if(!($result = $titanium_db->sql_query($sql))) {
                message_die(CRITICAL_ERROR, "Could not query arcade config information", "", __LINE__, __FILE__, $sql);
        }

        while ($row = $titanium_db->sql_fetchrow($result)) {
                $arcade_config[$row['arcade_name']] = $row['arcade_value'];
        }

        return $arcade_config;
}

function get_arcade_categories($titanium_user_id, $titanium_user_level, $mode) {
        global $titanium_db;
        $liste_cat = '';
        $nbcat = 0;

        switch ($mode) {
                case 'view':
                    $liste_auth = "0,1,3,5";
                    $liste_auth .= ($titanium_user_level == ADMIN) ? ',2,4,6' : (( $titanium_user_level == MOD) ? ',4' : '');
                    break;

                case 'play':
                    $liste_auth = "0";
                    $liste_auth .= ($titanium_user_level == ADMIN) ? ',1,2,3,4,5,6' : (( $titanium_user_level == MOD) ? ',3,4' : '');
                    break;
        }

        $sql = "SELECT arcade_catid FROM " . ARCADE_CATEGORIES_TABLE . " WHERE arcade_catauth IN ($liste_auth)";

        if (!($result = $titanium_db->sql_query($sql))) {
                message_die(GENERAL_ERROR, 'Could not select info FROM arcade_categories table', '', __LINE__, __FILE__, $sql);
        }

        while($row = $titanium_db->sql_fetchrow($result)) {
                $liste_cat .= (empty($liste_cat)) ? $row['arcade_catid'] : ',' . $row['arcade_catid'];
        }

          $sql = "SELECT aa.arcade_catid FROM " . AUTH_ARCADE_ACCESS_TABLE . " aa, " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE. " g WHERE ug.user_id = $titanium_user_id AND g.group_id = ug.group_id AND aa.group_id = ug.group_id ";

        if (!($result = $titanium_db->sql_query($sql))) {
                message_die(GENERAL_ERROR, 'Could not select info FROM user/user_group table', '', __LINE__, __FILE__, $sql);
        }

        while($row = $titanium_db->sql_fetchrow($result)) {
                $liste_cat .= (empty($liste_cat)) ? $row['arcade_catid'] : ',' . $row['arcade_catid'];
        }

        return $liste_cat ;
}

//Function to convert time to hours, minutes and seconds.
function sec2hms ($secs)
  {

    $hms = "";

$days = intval(intval($secs) / 86400);
    if($days != 0)
    {
    $secs = $secs - ($days * 86400);

    if($days == 1)
    {
        $hms .= " ".$days. " day";
    }
    else
    {
        $hms .= " ".$days. " days";
    }
    }



    $hours = intval(intval($secs) / 3600);
    if($hours != 0)
    {
    if($hours == 1)
    {
        $hms .= " ".$hours. " hour";
    }
    else
    {
        $hms .= " ".$hours. " hours";
    }
    }

    $minutes = intval(($secs / 60) % 60);
    if($minutes != 0)
    {
    if($minutes == 1)
    {
        $hms .= " ".$minutes. " min";
    }
    else
    {
        $hms .= " ".$minutes. " mins";
    }
    }

    $seconds = intval($secs % 60);
    if($seconds != 0)
    {
    if($seconds == 1)
    {
        $hms .= " ".$seconds. " sec";
    }
    else
    {
        $hms .= " ".$seconds. " secs";
    }
     }
    return $hms;

  }

?>