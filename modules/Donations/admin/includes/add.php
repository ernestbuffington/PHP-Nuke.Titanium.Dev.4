<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

//Close the open table
CloseTable();
echo '<br />';
//Start a new table
OpenTable();

/*==============================================================================================
    Function:    username()
    In:          N/A
    Return:      Combo box of user names
    Notes:       N/A
================================================================================================*/
function username() {
    global $titanium_db, $titanium_user_prefix;
    $in[] = array('value' => 'N/A', 'text' => _NONE);
    $sql = 'SELECT username FROM `'.$titanium_user_prefix.'_users` WHERE user_id > 1 ORDER BY username ASC';
    if(!$result = $titanium_db->sql_query($sql)) {
        DonateError($titanium_lang_donate['UNAMES_NF']);
    }
    while($row = $titanium_db->sql_fetchrow($result)) {
        $in[] = array('value' => $row[0], 'text' => $row[0]);
    }
    $titanium_db->sql_freeresult($result);
    return  donate_combo('uname', $in, 'None');
}

/*==============================================================================================
    Function:    types()
    In:          N/A
    Return:      The type of donations
    Notes:       N/A
================================================================================================*/
function types() {
    global $titanium_db, $titanium_prefix, $titanium_lang_donate;
    $sql = 'SELECT config_value, config_name FROM `'.$titanium_prefix.'_donators_config` WHERE config_name="gen_type_private"';
    if(!$result = $titanium_db->sql_query($sql)) {
        DonateError($titanium_lang_donate['TYPES_NF']);
    }
    $row = $titanium_db->sql_fetchrow($result);
    $type[$row['config_name']] = $row[0];
    $titanium_db->sql_freeresult($result);
    if ($type['gen_type_private'] == 'yes') {
        $in[] = array('value' => 'type_private', 'text' => $titanium_lang_donate['TYPE_PRIVATE']);
        $in[] = array('value' => 'type_regular', 'text' => $titanium_lang_donate['TYPE_REGULAR']);
        $ret = "<tr>\n
            <td align=\"right\">".$titanium_lang_donate['ADD_TYPE'].$titanium_lang_donate['BREAK']."</td>\n
            <td>".donate_combo('donshow', $in, 'type_regular')."</td>\n
          </tr>\n";
        return $ret;
    }
    return  '<input type="hidden" name="donshow" value="type_regular">';
}

/*==============================================================================================
    Function:    make_codes e()
    In:          N/A
    Return:      Creates the combo box of codes
    Notes:       N/A
================================================================================================*/
function make_codes () {
    global $titanium_db, $titanium_prefix, $titanium_lang_donate;
    $sql = 'SELECT config_value, config_name FROM `'.$titanium_prefix.'_donators_config`';
    if(!$result = $titanium_db->sql_query($sql)) {
        DonateError($titanium_lang_donate['TYPES_NF']);
    }
    while ($row = $titanium_db->sql_fetchrow($result)) {
        $gen_configs[$row['config_name']] = $row[0];
    }
    $titanium_db->sql_freeresult($result);
    if (empty($gen_configs['gen_codes'])) {
       return "<input type=\"hidden\" name=\"item_name\" value=\"".$gen_configs['gen_donation_code']."\">\n";
    }
    $codes = $gen_configs['gen_codes'];
    $codes = str_replace("\r\n", "\n", $codes);
    $codes = explode("\n", $codes);
    $radio[] = array('value' => $gen_configs['gen_donation_code'], 'text' => $gen_configs['gen_donation_name'], 'name' => 'item_name', 'checked' => 'CHECKED');
    for ($i=1, $maxi=count($codes); $i < $maxi; $i=$i+2) {
        $j = $i - 1;
        $radio[] = array('value' => $codes[$i], 'text' => $codes[$j], 'name' => 'item_name', 'checked' => '');
    }
    return donate_radio($radio,1);
}

/*==============================================================================================
    Function:    add_donation()
    In:          N/A
    Return:      N/A
    Notes:       Displays the on screen the add a donation
================================================================================================*/
function add_donation() {
    global $titanium_lang_donate, $admin_file;
    echo "<form id=\"values\" method=\"post\" action=\"".$admin_file.".php?op=Donations&amp;file=add\">\n";
    echo "<table width=\"43%\" border=\"0\" align=\"center\">\n";
    echo "<caption><span style=\"font-weight: bold; font-size: 20px;\">".$titanium_lang_donate['ADD_DONATION']."</span></caption>";
    echo "<tr>\n
            <td width=\"55%\" align=\"right\">".$titanium_lang_donate['UNAME'].$titanium_lang_donate['BREAK']."</td>\n
            <td width=\"45%\">".username()."</td>\n
          </tr>\n";
    echo "<tr>\n
            <td align=\"right\">".$titanium_lang_donate['FIRST_NAME'].$titanium_lang_donate['BREAK']."</td>\n
            <td>".donate_text('fname', '')."</td>\n
          </tr>\n";
    echo "<tr>\n
            <td align=\"right\">".$titanium_lang_donate['LAST_NAME'].$titanium_lang_donate['BREAK']."</td>\n
            <td>".donate_text('lname', '')."</td>\n
          </tr>\n";
    echo "<tr>\n
            <td align=\"right\">".$titanium_lang_donate['EMAIL_ADD'].$titanium_lang_donate['BREAK']."</td>\n
            <td>".donate_text('email', '')."</td>\n
          </tr>\n";
    echo "<tr>\n
            <td align=\"right\">".$titanium_lang_donate['DONATION'].$titanium_lang_donate['BREAK']."</td>\n
            <td>".donate_text('donated', '',5,5)."</td>\n
          </tr>\n";
    echo types();
    echo "<tr><td align=\"right\">\n";
    echo $titanium_lang_donate['DONATE_TO'].$titanium_lang_donate['BREAK'];
    echo "</td><td>\n";
    echo make_codes();
    echo "</td></tr>\n";
    echo '<tr><td colspan="2"><div align="center"><input type="submit" value="'.$titanium_lang_donate['submit'].'"></div></td></tr>';
    echo "</table></form>\n";
}

/*==============================================================================================
    Function:    check_donation()
    In:          N/A
    Return:      N/A
    Notes:       Validates the donation
================================================================================================*/
function check_donation() {
    global $titanium_lang_donate;
    if ($_POST['uname'] == 'N/A') {
        if (empty($_POST['fname'])) {
            DonateError($titanium_lang_donate['MISSING_FNAME']);
        }
        if (empty($_POST['lname'])) {
            DonateError($titanium_lang_donate['MISSING_LNAME']);
        }
    }
    if(!preg_match('/[\d\.]/',$_POST['donated'])) {
        DonateError($titanium_lang_donate['INVALID_DONATION']);
    }
}

/*==============================================================================================
    Function:    write_donation()
    In:          N/A
    Return:      N/A
    Notes:       Writes the donation to the DB
================================================================================================*/
function write_donation() {
    global $titanium_lang_donate, $titanium_db, $titanium_user_prefix, $titanium_prefix, $titanium_cache;
    if ($_POST['uname'] != 'N/A') {
        $_POST['uname'] = Fix_Quotes(check_html($_POST['uname'], 'nohtml'));
        $sql = 'SELECT * FROM `'.$titanium_user_prefix.'_users` WHERE username="'.$_POST['uname'].'"';
        if(!$result = $titanium_db->sql_query($sql)) {
            DonateError($titanium_lang_donate['UINFO_NF']);
        }
        $titanium_user = $titanium_db->sql_fetchrow($result);
        if(!is_array($titanium_user)) {
            DonateError($titanium_lang_donate['UINFO_NF']);
        }
        $titanium_db->sql_freeresult($result);
        $uname = $_POST['uname'];
        $uid = $titanium_user['user_id'];
        if (!empty($_POST['fname'])) {
            $fname = Fix_Quotes(check_html($_POST['fname'], 'nohtml'));
            $lname = Fix_Quotes(check_html($_POST['lname'], 'nohtml'));
        } else {
            if (substr_count($titanium_user['name'], ' ') == 1) {
                list($fname, $lname) = split(' ',$titanium_user['name']);
            } else {
                $fname = $titanium_user['name'];
                $lname = '';
            }
        }
        if (empty($_POST['email'])) {
            $email = $titanium_user['user_email'];
        } else {
            $email = Fix_Quotes(check_html($_POST['email'], 'nohtml'));
        }
        $donto = Fix_Quotes(check_html($_POST['item_name'], 'nohtml'));
    } else {
        $uname = '';
        $uid = '0';
        $fname = Fix_Quotes(check_html($_POST['fname'], 'nohtml'));
        $lname = Fix_Quotes(check_html($_POST['lname'], 'nohtml'));
        $email = Fix_Quotes(check_html($_POST['email'], 'nohtml'));
        $donto = Fix_Quotes(check_html($_POST['item_name'], 'nohtml'));
    }
    $donated = Fix_Quotes(check_html($_POST['donated'], 'nohtml'));
    $donshow = ($_POST['donshow'] == 'type_regular') ? '1' : '2';
    $sql = 'INSERT INTO `'.$titanium_prefix.'_donators` VALUES("","'.$uid.'","'.$uname.'","'.$fname.'","'.$lname.'","'.$email.'","'.$donated.'",'.time().',"'.$donshow.'","","","","'.$donto.'")';
    $titanium_db->sql_query($sql);
    //Clear the cache
    $titanium_cache->delete('donations', 'donations');
    $titanium_cache->delete('donations_goal', 'donations');
}

/*~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-*/

//If new values were posted
if (!empty($_POST)) {
    global $titanium_lang_donate;
    check_donation();
    write_donation();
    echo '<div align="center">';
    echo $titanium_lang_donate['ADDED'];
    echo '</div>';
} else {
    add_donation();
}

?>