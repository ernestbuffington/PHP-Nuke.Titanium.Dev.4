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

define('IN_PHPBB2', 1);

if( !empty($setmodules) )
{
    $file = basename(__FILE__);
    $titanium_module['AUC']['Management'] = "$file";
    return;
}

$phpbb2_root_path = "./../";
require($phpbb2_root_path . 'extension.inc');

require('./pagestart.' . $phpEx);
include($phpbb2_root_path . 'language/lang_' . $phpbb2_board_config['default_lang'] . '/lang_auc.' . $phpEx);

    if (isset($HTTP_POST_VARS['mode']) || isset($HTTP_GET_VARS['mode']))
        $mode = (isset($HTTP_POST_VARS['mode'])) ? $HTTP_POST_VARS['mode'] : $HTTP_GET_VARS['mode'];
    else
        $mode = '';
    global $titanium_prefix;
    define('COLORS', $titanium_prefix .'_bbadvanced_username_color');
    $link = append_titanium_sid("admin_advanced_username_color_m.". $phpEx);

if ($mode == "main" || !$mode)
        {
    echo "<table width='100%' border='0' class='forumline' cellspacing='2' align='center' valign='middle'>";
    echo "    <tr>";
    echo "        <th class='thHead' colspan='2'>";
    echo "            ". $titanium_lang['admin_main_header_m'];
    echo "        </th>";
    echo "    </tr>";
    echo "</table>";
    echo "<br /><br />";

    echo "<table border='0' align='center' valign='top' class='forumline' width='100%'>";
    echo "    <tr>";
    echo "        <td align='center' valign='top' width='100%' class='row2'>";
    echo "            <span class='genmed'>";
    echo "                ". $titanium_lang['choose_group'];
    echo "            </span>";
    echo "        </td>";
    echo "    </tr>";
    echo "</table>";
    echo "<form name='choose_group' action='$link' method='post'>";
    echo "<table border='0' align='center' valign='top' class='forumline' width='100%'>";
    echo "    <tr>";
    echo "        <td align='left' valign='top' width='50%' class='row2'>";
    echo "            <span class='genmed'>";
    echo "                ". $titanium_lang['choose_group_2'];
    echo "            </span>";
    echo "        </td>";
    echo "        <td align='center' valign='top' width='50%' class='row2'>";
    echo "            <select name='group'>";
    echo "                <option selected value=''>". $titanium_lang['choose_group_3'] ."</option>";

    $q = "SELECT *
          FROM ". COLORS ."
          WHERE group_id > '0'
          ORDER BY group_name ASC";
    $r            = $titanium_db->sql_query($q);
    while($row     = $titanium_db->sql_fetchrow($r))
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
    echo "            <input type='submit' class='mainoption' value='". $titanium_lang['choose_group_4'] ."' onchange='document.choose_group.submit()'>";
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
    $r        = $titanium_db->sql_query($q);
    $row     = $titanium_db->sql_fetchrow($r);
    $name     = $row['group_name'];
    $id     = $row['group_id'];
    $phpbb2_color    = $row['group_color'];

    echo "<table width='100%' border='0' class='forumline' cellspacing='2' align='center' valign='middle'>";
    echo "    <tr>";
    echo "        <th class='thHead' colspan='2'>";
    echo "            ". $titanium_lang['admin_main_header_m'];
    echo "        </th>";
    echo "    </tr>";
    echo "</table>";
    echo "<br /><br />";
    echo "<table border='0' align='center' valign='top' class='forumline' width='100%'>";
    echo "    <tr>";
    echo "        <td align='center' valign='top' width='100%' class='row2'>";
    echo "            <span class='genmed'>";
    echo "                ". str_replace("%G%", $name, $titanium_lang['group_selected']);
    echo "            </span>";
    echo "        </td>";
    echo "    </tr>";
    echo "</table>";
    echo "<br />";
    echo "<table border='0' align='center' valign='top' class='forumline' width='100%'>";
    echo "    <tr>";
    echo "        <td align='center' valign='top' width='33%' class='row2'>";
    echo "            <span class='genmed'>";
    echo "                ". $titanium_lang['group_already_assigned'];
    echo "            </span>";
    echo "        </td>";
    echo "        <td align='center' valign='top' width='33%' class='row2' colspan='2'>";
    echo "            <span class='genmed'>";
    echo "                <select name=''>";

    $q = "SELECT username, user_color_gi
          FROM ". USERS_TABLE ."
          WHERE user_color_gi <> '0'
          ORDER BY username ASC";
    $r            = $titanium_db->sql_query($q);
    while($row     = $titanium_db->sql_fetchrow($r))
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
    echo "                ". $titanium_lang['goup_group'];
    echo "            </span>";
    echo "        </td>";
    echo "        <td align='center' valign='top' width='33%' class='row2' colspan='2'>";
    echo "            <span class='genmed'>";

    $q = "SELECT group_id, group_name
          FROM ". GROUPS_TABLE ."
          WHERE group_id > 0 AND group_description <> 'Personal User'
          ORDER BY group_id ASC";
    $r = $titanium_db->sql_query($q);
    $groups = $titanium_db->sql_fetchrowset($r);

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
    echo "            <input type='hidden' name='color' value='". $phpbb2_color ."'>";
    echo "            <input type='submit' class='mainoption' value='". $titanium_lang['group_assign_1'] ."' onchange='document.add_group.submit()'>";
    echo "        </td>";
    echo "</form>";
/*****[END]********************************************
 [ Mod:    AUC Group                           v1.0.0 ]
 ******************************************************/
    echo "<form name='add_to_group' action='$link' method='post'>";
    echo "    <tr>";
    echo "        <td align='center' valign='top' width='33%' class='row2'>";
    echo "            <span class='genmed'>";
    echo "                ". $titanium_lang['group_assign'];
    echo "            </span>";
    echo "        </td>";
    echo "        <td align='center' valign='top' width='33%' class='row2' colspan='2'>";
    echo "            <span class='genmed'>";

    $q = "SELECT username, user_id
          FROM ". USERS_TABLE ."
          ORDER BY username ASC";
    $r = $titanium_db->sql_query($q);
    $titanium_users = $titanium_db->sql_fetchrowset($r);
    echo "                <select name='users_id'>";
    echo '                    <option selected value="" class="post">----------</option>';
        for ($x = 0; $x < count($titanium_users); $x++)
            echo '<option value="'. $titanium_users[$x]['user_id'] .'" class="post">'. $titanium_users[$x]['username'] .'</option>';
    echo "                </select>";
    echo "            </span>";
    echo "        </td>";
    echo '    </tr>';
    echo '    <tr>';
    echo '        <td align="left" class="row2">';
    echo '            <span class="genmed">';
    echo '                '. $titanium_lang['group_assign_2'];
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
    echo "            <input type='hidden' name='color' value='". $phpbb2_color ."'>";
    echo "            <input type='submit' class='mainoption' value='". $titanium_lang['group_assign_1'] ."' onchange='document.add_to_group.submit()'>";
    echo "        </td>";
    echo "    </tr>";
    echo "</form>";
    echo "<form name='delete_from_group' action='$link' method='post'>";
    echo "    <tr>";
    echo "        <td align='center' valign='top' width='33%' class='row2'>";
    echo "            <span class='genmed'>";
    echo "                ". $titanium_lang['group_delete_user'];
    echo "            </span>";
    echo "        </td>";
    echo "        <td align='center' valign='top' width='33%' class='row2'>";
    echo "            <span class='genmed'>";
    echo "                <select name='delete'>";
    $q = "SELECT username, user_id, user_color_gi
          FROM ". USERS_TABLE ."
          WHERE user_color_gi <> '0'
          ORDER BY username ASC";
    $r            = $titanium_db->sql_query($q);
    while($row     = $titanium_db->sql_fetchrow($r))
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
    echo "            <input type='submit' class='mainoption' value='". $titanium_lang['group_delete_user_1'] ."' onchange='document.delete_from_group.submit()'>";
    echo "        </td>";
    echo "    </tr>";
    echo "</form>";
    echo "</table>";
        }

    if($mode == "del_user")
        {
    $titanium_user     = $HTTP_POST_VARS['delete'];
    $group     = $HTTP_POST_VARS['group'];

    $q = "SELECT user_color_gi
          FROM ". USERS_TABLE ."
          WHERE user_id = '". $titanium_user ."'";
    $r         = $titanium_db->sql_query($q);
    $row     = $titanium_db->sql_fetchrow($r);

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
    $r = $titanium_db->sql_query($q);
    $groups_info = $titanium_db->sql_fetchrowset($r);
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
          WHERE user_id = '". $titanium_user ."'";
    $r = $titanium_db->sql_query($q);
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
     $cache->delete('UserColors', 'config');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    message_die(GENERAL_MESSAGE, $titanium_lang['group_delete_user_2'] . "<br /><br />" . sprintf($titanium_lang['Return_to_management'], "<a href=admin_advanced_username_color_m.php>", "</a>"), $titanium_lang['success']);
        }

    if ($mode == "add_user")
        {
    $who    = intval($HTTP_POST_VARS['users_id']);
    $multi    = $HTTP_POST_VARS['multi_users_id'];
    $group     = intval($HTTP_POST_VARS['group']);
    $phpbb2_color     = $HTTP_POST_VARS['color'];

        if ($who)
            $multi = '';
        if ($multi)
            $who = '';
        if ( (!$who) && (!$multi) )
            message_die(GENERAL_ERROR, $titanium_lang['choose_user_id_error'] . "<br /><br />" . sprintf($titanium_lang['Return_to_management'], "<a href=admin_advanced_username_color_m.php>", "</a>"));

        if ($multi)
            {
        $titanium_users = explode("\n", $multi);
            for ($x = 0; $x < count($titanium_users); $x++)
                {
            $titanium_users[$x] = trim(addslashes(stripslashes($titanium_users[$x])));
            $q = "SELECT user_color_gi, user_id
                  FROM ". USERS_TABLE ."
                  WHERE username = '". $titanium_users[$x] ."'";
            $r         = $titanium_db->sql_query($q);
            $row     = $titanium_db->sql_fetchrow($r);

                if ($row['user_color_gi'] <> '0')
                    $group = '--'. $group .'--'. $row['user_color_gi'];
                else
                    $group = '--'. $group .'--';

            $q = "UPDATE ". USERS_TABLE ."
                  SET user_color_gi = '". $group ."', user_color_gc = '". $phpbb2_color ."'
                  WHERE user_id = '". $row['user_id'] ."'";
            if (!$titanium_db->sql_query($q))
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
        $r         = $titanium_db->sql_query($q);
        $row     = $titanium_db->sql_fetchrow($r);

            if ($row['user_color_gi'] <> '0')
                $group = '--'. $group .'--'. $row['user_color_gi'];
            else
                $group = '--'. $group .'--';

        $q = "UPDATE ". USERS_TABLE ."
              SET user_color_gi = '". $group ."', user_color_gc = '". $phpbb2_color ."'
              WHERE user_id = '". $who ."'";
        if (!$titanium_db->sql_query($q))
            message_die(GENERAL_ERROR, 'ERROR!', '', __LINE__, __FILE__, $q);
            }
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
         $cache->delete('UserColors', 'config');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    message_die(GENERAL_MESSAGE, $titanium_lang['group_user_added'] . "<br /><br />" . sprintf($titanium_lang['Return_to_management'], "<a href=admin_advanced_username_color_m.php>", "</a>"), $titanium_lang['success']);
        }
/*****[BEGIN]******************************************
 [ Mod:    AUC Group                           v1.0.0 ]
 ******************************************************/
    if ($mode == "add_group")
        {
    $who    = intval($HTTP_POST_VARS['group_id']);
    $group     = intval($HTTP_POST_VARS['group']);
    $phpbb2_color     = $HTTP_POST_VARS['color'];

        $q_group = "SELECT user_id
              FROM ". USER_GROUP_TABLE ."
              WHERE group_id = '". $who ."'";
        $r_group    = $titanium_db->sql_query($q_group);

    while($id_group = $titanium_db->sql_fetchrow($r_group))
      {
        $q = "SELECT user_color_gi
              FROM ". USERS_TABLE ."
              WHERE user_id = '". $id_group['user_id'] ."'";
        $r         = $titanium_db->sql_query($q);
        $row     = $titanium_db->sql_fetchrow($r);
            $test = '--'. $group .'--';
        if(strstr($row[0], $test)) {
                continue;
            }
            if ($row['user_color_gi'] <> '0')
                $group = '--'. $group .'--'. $row['user_color_gi'];
            else
                $group = '--'. $group .'--';

        $q = "UPDATE ". USERS_TABLE ."
              SET user_color_gi = '". $group ."', user_color_gc = '". $phpbb2_color ."'
              WHERE user_id = '". $id_group['user_id'] ."'";

        if (!$titanium_db->sql_query($q)) {
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
        message_die(GENERAL_MESSAGE, $titanium_lang['group_user_added'] . "<br /><br />" . sprintf($titanium_lang['Return_to_management'], "<a href=admin_advanced_username_color_m.php>", "</a>"), $titanium_lang['success']);
      }
/*****[END]********************************************
 [ Mod:    AUC Group                           v1.0.0 ]
 ******************************************************/

include('page_footer_admin.' . $phpEx);

?>