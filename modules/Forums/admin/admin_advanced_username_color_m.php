<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                            admin_advanced_username_color_m.php
 *                           -------------------------------------
 *        Version            : 1.0.5
 *        Email            : austin@phpbb-amod.com
 *        Site            : http://phpbb-tweaks.com/
 *        Copyright        : aUsTiN-Inc 2003/5
 *
 ***************************************************************************/

/*****[CHANGES]**********************************************************
-=[Mod]=-
      AUC Group                                v1.0.0       06/20/2005
 ************************************************************************/

if (!defined('IN_PHPBB')) define('IN_PHPBB', true);

if( !empty($setmodules) )
{
    $file = basename(__FILE__);
    $module['AUC']['Management'] = "$file";
    return;
}

$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');

require('./pagestart.' . $phpEx);
include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_auc.' . $phpEx);

    if (isset($HTTP_POST_VARS['mode']) || isset($HTTP_GET_VARS['mode']))
        $mode = (isset($HTTP_POST_VARS['mode'])) ? $HTTP_POST_VARS['mode'] : $HTTP_GET_VARS['mode'];
    else
        $mode = '';
    global $prefix;
    define('COLORS', $prefix .'_bbadvanced_username_color');
    $link = append_sid("admin_advanced_username_color_m.". $phpEx);

if ($mode == "main" || !$mode)
        {
    echo "<table width='100%' border='0' class='forumline' cellspacing='2' align='center' valign='middle'>";
    echo "    <tr>";
    echo "        <th class='thHead' colspan='2'>";
    echo "            ". $lang['admin_main_header_m'];
    echo "        </th>";
    echo "    </tr>";
    echo "</table>";
    echo "<br /><br />";

    echo "<table border='0' align='center' valign='top' class='forumline' width='100%'>";
    echo "    <tr>";
    echo "        <td align='center' valign='top' width='100%' class='row2'>";
    echo "            <span class='genmed'>";
    echo "                ". $lang['choose_group'];
    echo "            </span>";
    echo "        </td>";
    echo "    </tr>";
    echo "</table>";
    echo "<form name='choose_group' action='$link' method='post'>";
    echo "<table border='0' align='center' valign='top' class='forumline' width='100%'>";
    echo "    <tr>";
    echo "        <td align='left' valign='top' width='50%' class='row2'>";
    echo "            <span class='genmed'>";
    echo "                ". $lang['choose_group_2'];
    echo "            </span>";
    echo "        </td>";
    echo "        <td align='center' valign='top' width='50%' class='row2'>";
    echo "            <select name='group'>";
    echo "                <option selected value=''>". $lang['choose_group_3'] ."</option>";

    $q = "SELECT *
          FROM ". COLORS ."
          WHERE group_id > '0'
          ORDER BY group_name ASC";
    $r            = $db->sql_query($q);
    while($row     = $db->sql_fetchrow($r))
        {
    $name     = $row['group_name'];
    $id     = $row['group_id'];
    echo "                <option value='". $id ."'>$name</option>";
        }

    echo "            </select>";
    echo "        </td>";
    echo "    </tr>";
    echo "</table>";
    echo "<br />";
    echo "<table border='0' align='center' valign='top'>";
    echo "    <tr>";
    echo "        <td align='center' valign='middle' width='100%' class='row2'>";
    echo "            <input type='hidden' name='mode' value='select_group'>";
    echo "            <input type='submit' class='mainoption' value='". $lang['choose_group_4'] ."' onchange='document.choose_group.submit()'>";
    echo "        </td>";
    echo "    </tr>";
    echo "</table>";
    echo "</form>";
    echo "<br /><br />";
        }

    if ($mode == "select_group")
        {
    $group = $HTTP_POST_VARS['group'];

    $q = "SELECT *
          FROM ". COLORS ."
          WHERE group_id = '". $group ."'";
    $r        = $db->sql_query($q);
    $row     = $db->sql_fetchrow($r);
    $name     = $row['group_name'];
    $id     = $row['group_id'];
    $color    = $row['group_color'];

    echo "<table width='100%' border='0' class='forumline' cellspacing='2' align='center' valign='middle'>";
    echo "    <tr>";
    echo "        <th class='thHead' colspan='2'>";
    echo "            ". $lang['admin_main_header_m'];
    echo "        </th>";
    echo "    </tr>";
    echo "</table>";
    echo "<br /><br />";
    echo "<table border='0' align='center' valign='top' class='forumline' width='100%'>";
    echo "    <tr>";
    echo "        <td align='center' valign='top' width='100%' class='row2'>";
    echo "            <span class='genmed'>";
    echo "                ". str_replace("%G%", $name, $lang['group_selected']);
    echo "            </span>";
    echo "        </td>";
    echo "    </tr>";
    echo "</table>";
    echo "<br />";
    echo "<table border='0' align='center' valign='top' class='forumline' width='100%'>";
    echo "    <tr>";
    echo "        <td align='center' valign='top' width='33%' class='row2'>";
    echo "            <span class='genmed'>";
    echo "                ". $lang['group_already_assigned'];
    echo "            </span>";
    echo "        </td>";
    echo "        <td align='center' valign='top' width='33%' class='row2' colspan='2'>";
    echo "            <span class='genmed'>";
    echo "                <select name=''>";

    $q = "SELECT username, user_color_gi
          FROM ". USERS_TABLE ."
          WHERE user_color_gi <> '0'
          ORDER BY username ASC";
    $r            = $db->sql_query($q);
    while($row     = $db->sql_fetchrow($r))
        {
        if    (preg_match('/--'. $id .'--/i', $row['user_color_gi']))
            echo "                <option value=''>". $row['username'] ."</option>";
        }

    echo "                </select>";
    echo "            </span>";
    echo "        </td>";
    echo "    </tr>";
/*****[BEGIN]******************************************
 [ Mod:    AUC Group                           v1.0.0 ]
 ******************************************************/
    echo "<form name='add_group' action='$link' method='post'>";
    echo "    <tr>";
    echo "        <td align='center' valign='top' width='33%' class='row2'>";
    echo "            <span class='genmed'>";
    echo "                ". $lang['goup_group'];
    echo "            </span>";
    echo "        </td>";
    echo "        <td align='center' valign='top' width='33%' class='row2' colspan='2'>";
    echo "            <span class='genmed'>";

    $q = "SELECT group_id, group_name
          FROM ". GROUPS_TABLE ."
          WHERE group_id > 0 AND group_description <> 'Personal User'
          ORDER BY group_id ASC";
    $r = $db->sql_query($q);
    $groups = $db->sql_fetchrowset($r);

    echo "                <select name='group_id'>";
    echo '                    <option selected value="" class="post">----------</option>';
        for ($x = 0; $x < count($groups); $x++)
            echo '<option value="'. $groups[$x]['group_id'] .'" class="post">'. $groups[$x]['group_name'] .'</option>';
    echo "                </select>";
    echo "            </span>";
    echo "        </td>";
    echo '    </tr>';
    echo "        <td align='center' valign='middle' width='100%' class='row2' colspan='3'>";
    echo "            <input type='hidden' name='mode' value='add_group'>";
    echo "            <input type='hidden' name='group' value='". $id ."'>";
    echo "            <input type='hidden' name='color' value='". $color ."'>";
    echo "            <input type='submit' class='mainoption' value='". $lang['group_assign_1'] ."' onchange='document.add_group.submit()'>";
    echo "        </td>";
    echo "</form>";
/*****[END]********************************************
 [ Mod:    AUC Group                           v1.0.0 ]
 ******************************************************/
    echo "<form name='add_to_group' action='$link' method='post'>";
    echo "    <tr>";
    echo "        <td align='center' valign='top' width='33%' class='row2'>";
    echo "            <span class='genmed'>";
    echo "                ". $lang['group_assign'];
    echo "            </span>";
    echo "        </td>";
    echo "        <td align='center' valign='top' width='33%' class='row2' colspan='2'>";
    echo "            <span class='genmed'>";

    $q = "SELECT username, user_id
          FROM ". USERS_TABLE ."
          ORDER BY username ASC";
    $r = $db->sql_query($q);
    $users = $db->sql_fetchrowset($r);
    echo "                <select name='users_id'>";
    echo '                    <option selected value="" class="post">----------</option>';
        for ($x = 0; $x < count($users); $x++)
            echo '<option value="'. $users[$x]['user_id'] .'" class="post">'. $users[$x]['username'] .'</option>';
    echo "                </select>";
    echo "            </span>";
    echo "        </td>";
    echo '    </tr>';
    echo '    <tr>';
    echo '        <td align="left" class="row2">';
    echo '            <span class="genmed">';
    echo '                '. $lang['group_assign_2'];
    echo '            </span>';
    echo '        </td>';
    echo '        <td align="center" class="row2" colspan="2">';
    echo '            <span class="genmed">';
    echo '                <textarea name="multi_users_id" class="post" rows="15" cols="40"></textarea>';
    echo '            </span>';
    echo '        </td>';
    echo '    </tr>';
    echo '    <tr>';
    echo "        <td align='center' valign='middle' width='100%' class='row2' colspan='3'>";
    echo "            <input type='hidden' name='mode' value='add_user'>";
    echo "            <input type='hidden' name='group' value='". $id ."'>";
    echo "            <input type='hidden' name='color' value='". $color ."'>";
    echo "            <input type='submit' class='mainoption' value='". $lang['group_assign_1'] ."' onchange='document.add_to_group.submit()'>";
    echo "        </td>";
    echo "    </tr>";
    echo "</form>";
    echo "<form name='delete_from_group' action='$link' method='post'>";
    echo "    <tr>";
    echo "        <td align='center' valign='top' width='33%' class='row2'>";
    echo "            <span class='genmed'>";
    echo "                ". $lang['group_delete_user'];
    echo "            </span>";
    echo "        </td>";
    echo "        <td align='center' valign='top' width='33%' class='row2'>";
    echo "            <span class='genmed'>";
    echo "                <select name='delete'>";
    $q = "SELECT username, user_id, user_color_gi
          FROM ". USERS_TABLE ."
          WHERE user_color_gi <> '0'
          ORDER BY username ASC";
    $r            = $db->sql_query($q);
    while($row     = $db->sql_fetchrow($r))
        {
        if    (preg_match('/--'. $id .'--/i', $row['user_color_gi']))
            echo "            <option value='". $row['user_id'] ."'>". $row['username'] ."</option>";
        }
    echo "                </select>";
    echo "            </span>";
    echo "        </td>";
    echo "        <td align='center' valign='middle' width='100%' class='row2'>";
    echo "            <input type='hidden' name='mode' value='del_user'>";
    echo "            <input type='hidden' name='group' value='". $id ."'>";
    echo "            <input type='submit' class='mainoption' value='". $lang['group_delete_user_1'] ."' onchange='document.delete_from_group.submit()'>";
    echo "        </td>";
    echo "    </tr>";
    echo "</form>";
    echo "</table>";
        }

    if($mode == "del_user")
        {
    $user     = $HTTP_POST_VARS['delete'];
    $group     = $HTTP_POST_VARS['group'];

    $q = "SELECT user_color_gi
          FROM ". USERS_TABLE ."
          WHERE user_id = '". $user ."'";
    $r         = $db->sql_query($q);
    $row     = $db->sql_fetchrow($r);

    $remove = str_replace('--'. $group .'--', '', $row['user_color_gi']);
    if (!$remove)
        $new_id     = '0';
    else
        $new_id = $remove;

    #==== If in more than 1 group, get the next color
    if ($new_id)
        {
    $q = "SELECT group_color, group_id
          FROM ". COLORS ."";
    $r = $db->sql_query($q);
    $groups_info = $db->sql_fetchrowset($r);
        for ($a = 0; $a < count($groups_info); $a++)
            {
            if (preg_match('/--'. $groups_info[$a]['group_id'] .'--/i', $new_id))
                {
            $new_color = $groups_info[$a]['group_color'];
            break;
                }
            }
        }
    else
        $new_color = '';

    $q = "UPDATE ". USERS_TABLE ."
          SET user_color_gi = '$new_id', user_color_gc = '$new_color'
          WHERE user_id = '". $user ."'";
    $r = $db->sql_query($q);
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
     $cache->delete('UserColors', 'config');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    message_die(GENERAL_MESSAGE, $lang['group_delete_user_2'] . "<br /><br />" . sprintf($lang['Return_to_management'], "<a href=admin_advanced_username_color_m.php>", "</a>"), $lang['success']);
        }

    if ($mode == "add_user")
        {
    $who    = intval($HTTP_POST_VARS['users_id']);
    $multi    = $HTTP_POST_VARS['multi_users_id'];
    $group     = intval($HTTP_POST_VARS['group']);
    $color     = $HTTP_POST_VARS['color'];

        if ($who)
            $multi = '';
        if ($multi)
            $who = '';
        if ( (!$who) && (!$multi) )
            message_die(GENERAL_ERROR, $lang['choose_user_id_error'] . "<br /><br />" . sprintf($lang['Return_to_management'], "<a href=admin_advanced_username_color_m.php>", "</a>"));

        if ($multi)
            {
        $users = explode("\n", $multi);
            for ($x = 0; $x < count($users); $x++)
                {
            $users[$x] = trim(addslashes(stripslashes($users[$x])));
            $q = "SELECT user_color_gi, user_id
                  FROM ". USERS_TABLE ."
                  WHERE username = '". $users[$x] ."'";
            $r         = $db->sql_query($q);
            $row     = $db->sql_fetchrow($r);

                if ($row['user_color_gi'] <> '0')
                    $group = '--'. $group .'--'. $row['user_color_gi'];
                else
                    $group = '--'. $group .'--';

            $q = "UPDATE ". USERS_TABLE ."
                  SET user_color_gi = '". $group ."', user_color_gc = '". $color ."'
                  WHERE user_id = '". $row['user_id'] ."'";
            if (!$db->sql_query($q))
                message_die(GENERAL_ERROR, 'ERROR!', '', __LINE__, __FILE__, $q);
                }
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
             $cache->delete('UserColors', 'config');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
            }

        if ($who)
            {
        $q = "SELECT user_color_gi
              FROM ". USERS_TABLE ."
              WHERE user_id = '". $who ."'";
        $r         = $db->sql_query($q);
        $row     = $db->sql_fetchrow($r);

            if ($row['user_color_gi'] <> '0')
                $group = '--'. $group .'--'. $row['user_color_gi'];
            else
                $group = '--'. $group .'--';

        $q = "UPDATE ". USERS_TABLE ."
              SET user_color_gi = '". $group ."', user_color_gc = '". $color ."'
              WHERE user_id = '". $who ."'";
        if (!$db->sql_query($q))
            message_die(GENERAL_ERROR, 'ERROR!', '', __LINE__, __FILE__, $q);
            }
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
         $cache->delete('UserColors', 'config');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    message_die(GENERAL_MESSAGE, $lang['group_user_added'] . "<br /><br />" . sprintf($lang['Return_to_management'], "<a href=admin_advanced_username_color_m.php>", "</a>"), $lang['success']);
        }
/*****[BEGIN]******************************************
 [ Mod:    AUC Group                           v1.0.0 ]
 ******************************************************/
    if ($mode == "add_group")
        {
    $who    = intval($HTTP_POST_VARS['group_id']);
    $group     = intval($HTTP_POST_VARS['group']);
    $color     = $HTTP_POST_VARS['color'];

        $q_group = "SELECT user_id
              FROM ". USER_GROUP_TABLE ."
              WHERE group_id = '". $who ."'";
        $r_group    = $db->sql_query($q_group);

    while($id_group = $db->sql_fetchrow($r_group))
      {
        $q = "SELECT user_color_gi
              FROM ". USERS_TABLE ."
              WHERE user_id = '". $id_group['user_id'] ."'";
        $r         = $db->sql_query($q);
        $row     = $db->sql_fetchrow($r);
            $test = '--'. $group .'--';
        if(strstr($row[0], $test)) {
                continue;
            }
            if ($row['user_color_gi'] <> '0')
                $group = '--'. $group .'--'. $row['user_color_gi'];
            else
                $group = '--'. $group .'--';

        $q = "UPDATE ". USERS_TABLE ."
              SET user_color_gi = '". $group ."', user_color_gc = '". $color ."'
              WHERE user_id = '". $id_group['user_id'] ."'";

        if (!$db->sql_query($q)) {
            message_die(GENERAL_ERROR, 'ERROR!', '', __LINE__, __FILE__, $q);
            }
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
         $cache->delete('UserColors', 'config');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
        }
        message_die(GENERAL_MESSAGE, $lang['group_user_added'] . "<br /><br />" . sprintf($lang['Return_to_management'], "<a href=admin_advanced_username_color_m.php>", "</a>"), $lang['success']);
      }
/*****[END]********************************************
 [ Mod:    AUC Group                           v1.0.0 ]
 ******************************************************/

include('page_footer_admin.' . $phpEx);

?>