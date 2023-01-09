<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

//Close the open table
CloseTable();
//Start a new table
OpenTable();

/*==============================================================================================
    Function:    currency()
    In:          N/A
    Return:      Combo box of currency types
    Notes:       This is all that paypal supports
================================================================================================*/
function currency() {
    global $gen_values;
    $in[] = array('value' => 'USD', 'text' => 'US Dollars ($)');
    $in[] = array('value' => 'AUD', 'text' => 'Australian Dollars (A $)');
    $in[] = array('value' => 'CAD', 'text' => 'Canadian Dollars (C $)');
    $in[] = array('value' => 'EUR', 'text' => "Euros (&euro;)");
    $in[] = array('value' => 'GBP', 'text' => "Pounds Sterling (&pound;)");
    $in[] = array('value' => 'JPY', 'text' => "Yen (&yen;)");
    return  donate_combo('currency', $in, $gen_values['currency']);
}

/*==============================================================================================
    Function:    get_radios()
    In:          N/A
    Return:      An array of radio buttons
    Notes:       Creates the radio buttons using the donate_radio() function
================================================================================================*/
function get_radios() {
    global $lang_donate, $gen_values;
    $out = array();
    $radio[] = array('value' => 'yes', 'text' => $lang_donate['YES'], 'name' => 'type_private', 'checked' => ($gen_values['type_private'] == 'yes') ? 'CHECKED' : '', 'help' => make_help_popup($lang_donate['HELP_DONATION_PRIVATE'], $lang_donate['TYPE_PRIVATE']));
    $radio[] = array('value' => 'no', 'text' => $lang_donate['NO'], 'name' => 'type_private', 'checked' => ($gen_values['type_private'] == 'yes') ? '' : 'CHECKED', 'help' => make_help_popup($lang_donate['HELP_DONATION_PRIVATE'], $lang_donate['TYPE_PRIVATE']));
    $out['type_private'] = donate_radio($radio);
    unset($radio);
    $radio[] = array('value' => 'yes', 'text' => $lang_donate['YES'], 'name' => 'type_anon', 'checked' => ($gen_values['type_anon'] == 'yes') ? 'CHECKED' : '', 'help' => make_help_popup($lang_donate['HELP_DONATION_ANON'], $lang_donate['TYPE_PRIVATE']));
    $radio[] = array('value' => 'no', 'text' => $lang_donate['NO'], 'name' => 'type_anon', 'checked' => ($gen_values['type_anon'] == 'yes') ? '' : 'CHECKED', 'help' => make_help_popup($lang_donate['HELP_DONATION_ANON'], $lang_donate['TYPE_PRIVATE']));
    $out['type_anon'] = donate_radio($radio);
    unset($radio);
    $radio[] = array('value' => 'yes', 'text' => $lang_donate['YES'], 'name' => 'message', 'checked' => ($gen_values['message'] == 'yes') ? 'CHECKED' : '');
    $radio[] = array('value' => 'no', 'text' => $lang_donate['NO'], 'name' => 'message', 'checked' => ($gen_values['message'] == 'yes') ? '' : 'CHECKED');
    $out['message'] = donate_radio($radio);
    unset($radio);
    $radio[] = array('value' => 'yes', 'text' => $lang_donate['YES'], 'name' => 'cookie', 'checked' => ($gen_values['cookie'] == 'yes') ? 'CHECKED' : '', 'mouseover' => make_help_popup($lang_donate['HELP_COOKIE_TRACK'],$lang_donate['COOKIE_TRACK']));
    $radio[] = array('value' => 'no', 'text' => $lang_donate['NO'], 'name' => 'cookie', 'checked' => ($gen_values['cookie'] == 'yes') ? '' : 'CHECKED', 'mouseover' => make_help_popup($lang_donate['HELP_COOKIE_TRACK'],$lang_donate['COOKIE_TRACK']));
    $out['cookie'] = donate_radio($radio);
    return $out;
}

/*==============================================================================================
    Function:    display_config()
    In:          N/A
    Return:      N/A
    Notes:       Displays the on screen config choices
================================================================================================*/
function display_config() {
    global $lang_donate, $gen_values, $admin_file;
    $show = get_radios();
    echo "<form id=\"config_gen\" method=\"post\" action=\"".$admin_file.".php?op=".the_module()."&amp;file=config_donations\">\n";
    echo '<table style="width: 50%; margin: auto" cellpadding="4" cellspacing="1" border="0" class="forumline">';
    echo '  <tr>';
    echo '    <td class="catHead" colspan="2" style="text-align: center; font-weight: bold; font-size: 14px">'.$lang_donate['CONFIG_GENERAL'].'</td>';
    echo '  </tr>';
    // echo "<caption><span style=\"font-weight: bold; font-size: 20px;\">".$lang_donate['CONFIG_GENERAL']."</span></caption>";
    echo "<tr>\n";
    echo "  <td class=\"row1\" align=\"right\">".$lang_donate['PP_EMAIL'].$lang_donate['BREAK']."</td>\n
            <td class=\"row1\">".donate_text('pp_email', $gen_values['pp_email'])."</td>\n";
    echo "</tr>\n";
    echo "<tr>\n";
    echo "  <td class=\"row1\" align=\"right\">".$lang_donate['CURRENCY'].$lang_donate['BREAK']."</td>\n
            <td class=\"row1\">".currency()."</td>\n";
    echo "</tr>\n";
    echo "<tr>\n";
    echo "  <td class=\"row1\" align=\"right\">".$lang_donate['DONATION_NAME'].$lang_donate['BREAK']."</td>\n
            <td class=\"row1\">".donate_text('donation_name', $gen_values['donation_name'],'','',make_help_popup($lang_donate['HELP_DONATION_NAME'],$lang_donate['DONATION_NAME']))."</td>\n";
    echo "</tr>\n";
    echo "<tr>\n";
    echo "  <td class=\"row1\" align=\"right\">".$lang_donate['DONATION_CODE'].$lang_donate['BREAK']."</td>\n
            <td class=\"row1\">".donate_text('donation_code', $gen_values['donation_code'],'','',make_help_popup($lang_donate['HELP_DONATION_CODE'],$lang_donate['DONATION_CODE']))."</td>\n";
    echo "</tr>\n";
    echo "<tr>\n";
    echo "  <td class=\"row1\" align=\"right\">".$lang_donate['MONTHLY_GOAL'].$lang_donate['BREAK']."</td>\n
            <td class=\"row1\">".donate_text('monthly_goal', $gen_values['monthly_goal'],5,7)."</td>\n";
    echo "</tr>\n";
    echo "<tr>\n
            <td class=\"row1\" align=\"right\">".$lang_donate['BUTTON_IMAGE'].$lang_donate['BREAK']."</td>\n
            <td class=\"row1\">".donate_text('button_image', $gen_values['button_image'])."</td>\n
          </tr>\n";
    echo "<tr>\n
            <td class=\"row1\" align=\"right\">".$lang_donate['PAGE_HEADER_IMG'].$lang_donate['BREAK']."</td>\n
            <td class=\"row1\">".donate_text('page_image', $gen_values['page_image'])."</td>\n
          </tr>\n";
    echo "<tr>\n";
    echo "  <td class=\"row1\" align=\"right\">".$lang_donate['DATE_FORMAT'].$lang_donate['BREAK']."</td>\n
            <td class=\"row1\">".donate_text('date_format', $gen_values['date_format'])."</td>\n";
    echo "</tr>\n";
    echo "<tr>\n";
    echo "  <td class=\"row1\" align=\"right\">".$lang_donate['ALLOW_MESSAGE'].$lang_donate['BREAK']."</td>\n
            <td class=\"row1\">".$show['message']."</td>\n";
    echo "</tr>\n";
    echo "  <td class=\"row1\" align=\"right\">".$lang_donate['COOKIE_TRACK'].$lang_donate['BREAK']."</td>\n
            <td class=\"row1\">".$show['cookie']."</td>\n";
    echo "</tr>\n";
    echo "<tr>\n";
    echo "  <td class=\"row1\" align=\"right\">".$lang_donate['CODES'].$lang_donate['BREAK']."</td>\n
            <td class=\"row1\"><span class=\"tooltip-html\" title=\"".$lang_donate['HELP_DONATION_CODES']."\">".donate_text_area('codes', $gen_values['codes'], 5, 20)."</td>\n";
    echo "</tr>\n";
    //Type
    echo "<tr><td class=\"catHead\" colspan=\"2\" style=\"text-align: center; font-weight: bold; font-size: 14px\">".$lang_donate['TYPE']."</td></tr>";
    echo "<tr>\n";
    echo "  <td class=\"row1\" align=\"right\">".$lang_donate['TYPE_PRIVATE'].$lang_donate['BREAK']."</td>\n
            <td class=\"row1\">".$show['type_private']."</td>\n";
    echo "</tr>\n";
    echo "<tr>\n";
    echo "  <td class=\"row1\" align=\"right\">".$lang_donate['TYPE_ANON'].$lang_donate['BREAK']."</td>\n
            <td class=\"row1\">".$show['type_anon']."</td>\n";
    echo "</tr>\n";
    //Thank You
    echo "<tr><td class=\"catHead\" colspan=\"2\" style=\"text-align: center; font-weight: bold; font-size: 14px\">".$lang_donate['THANK_YOU']."</td></tr>";
    echo "<tr>\n";
    echo "  <td class=\"row1\" align=\"right\">".$lang_donate['IMAGE'].$lang_donate['BREAK']."</td>\n
            <td class=\"row1\">".donate_text('thank_image', $gen_values['thank_image'])."</td>\n";
    echo "</tr>\n";
    echo "<tr><td class=\"row1\" align=\"right\">".$lang_donate['MESSAGE'].$lang_donate['BREAK']."</td>\n
            <td class=\"row1\">".donate_text_area('thank_message', br2nl($gen_values['thank_message']))."</td>\n";
    echo "</tr>\n";
    //Cancel
    echo "<tr><td class=\"catHead\" colspan=\"2\" style=\"text-align: center; font-weight: bold; font-size: 14px\">".$lang_donate['CANCEL']."</td></tr>";
    echo "<tr>\n";
    echo "  <td class=\"row1\" align=\"right\">".$lang_donate['IMAGE'].$lang_donate['BREAK']."</td>\n
            <td class=\"row1\">".donate_text('cancel_image', $gen_values['cancel_image'])."</td>\n";
    echo "</tr>\n";
    echo "<tr>\n";
    echo "  <td class=\"row1\" align=\"right\">".$lang_donate['MESSAGE'].$lang_donate['BREAK']."</td>\n
            <td class=\"row1\">".donate_text_area('cancel_message', br2nl($gen_values['cancel_message']))."</td>\n";
    echo "</tr>\n";
    //Submit
    echo "<tr><td colspan=\"2\" class=\"catBottom\"><div align=\"center\"><input type=\"submit\" value=\"".$lang_donate['DONATION_SUBMIT']."\"></div></td></tr>\n";
    echo "</table></form>\n";
}

/*==============================================================================================
    Function:    get_values()
    In:          N/A
    Return:      Array of the values from the DB.
    Notes:       Will toss a DonateError if the values are not found
================================================================================================*/
function get_values() {
    global $db, $prefix, $lang_donate, $cache;
    static $don;
    if(isset($don) && is_array($don)) { return $don; }
    if (!$don = $cache->load('general', 'titanium_donations')) {
        $sql = 'SELECT config_value, config_name from `'.$prefix.'_donators_config` WHERE config_name LIKE "gen_%"';
        if(!$result = $db->sql_query($sql)) {
            DonateError($lang_donate['VALUES_NF']);
        }
        while ($row = $db->sql_fetchrow($result)) {
            if(isset($row['config_value']))
			$don[str_replace('gen_', '', $row['config_name'])] = $row['config_value'];
        }
        $cache->save('general', 'titanium_donations', $don);
        $db->sql_freeresult($result);
    }
    return $don;
}

/*==============================================================================================
    Function:    write_values()
    In:          $values
                    Values to write to the db
    Return:      N/A
    Notes:       Writes values to the DB
================================================================================================*/
function write_values($values) {
    global $db, $prefix, $cache;
    //Loop through values
    foreach ($values as $key => $value) {
        //Remove crap
        if($key != 'thank_message' && $key != 'cancel_message') {
            $value = Fix_Quotes(check_html($value, 'nohtml'));
        } else {
            $value = Fix_Quotes($value);
        }
        $key = Fix_Quotes(check_html($key, 'nohtml'));
        //Setup SQL
        $sql = 'UPDATE '.$prefix.'_donators_config SET';
        $sql .= ' config_value="'.$value.'" WHERE config_name="gen_'.$key.'";';
        //Run SQL
        $db->sql_query($sql);
    }
    //Clear the cache
    $cache->delete('general', 'donations');
    $cache->resync();
}

/*==============================================================================================
    Function:   check_codes()
    In:          $codes
                    The codes passed in to check
    Return:      N/A
    Notes:       Checks to make sure that the extra paypal codes are valid
================================================================================================*/
function check_codes($codes) {
    global $lang_donate;

    if (empty($codes)) {
        return ;
    }
    $codes = str_replace("\r\n", "\n", $codes);
    $codes = explode("\n", $codes);
    if (!is_array($codes)) {
        DonateError($lang_donate['CODES_SHORT']);
    }
    if ((count($codes)%2) != 0) {
        DonateError($lang_donate['CODES_SHORT']);
    }
    // for ($i=1, $maxi=count($codes); $i < $maxi; $i=$i+2) {
    //     if(str_replace(" ","",$codes[$i])) {
    //         DonateError($lang_donate['CODES_SPACES']);
    //     }
    // }
}

/*==============================================================================================
    Function:    set_values()
    In:          N/A
    Return:      Array of the values from that were posted
    Notes:       Runs write_values()
================================================================================================*/
function set_values() {
    global $lang_donate;
    $values['pp_email'] = $_POST['pp_email'];
    if(!Validate($values['pp_email'], 'email', '', 1, 1)) {
        DonateError($lang_donate['INVALID_EMAIL']);
    }
    $values['type_private'] = $_POST['type_private'];
    $values['type_anon'] = $_POST['type_anon'];
    $values['donation_name'] = $_POST['donation_name'];
    $values['donation_code'] = $_POST['donation_code'];
    $values['monthly_goal'] = $_POST['monthly_goal'];
    $values['date_format'] = $_POST['date_format'];
    $values['currency'] = $_POST['currency'];
    $values['thank_image'] = $_POST['thank_image'];
    $values['thank_message'] = $_POST['thank_message'];
    $values['thank_message'] = str_replace(array("\r\n", "\n", "\r"), "<br />", $values['thank_message']);
    $values['cancel_image'] = $_POST['cancel_image'];
    $values['cancel_message'] = $_POST['cancel_message'];
    $values['cancel_message'] = str_replace(array("\r\n", "\n", "\r"), "<br />", $values['cancel_message']);
    $values['button_image'] = $_POST['button_image'];
    $values['page_image'] = $_POST['page_image'];
    $values['message'] = $_POST['message'];
    $values['codes'] = trim($_POST['codes']);
    $values['cookie'] = trim($_POST['cookie']);
    check_codes($values['codes']);
    //Write values to DB
    write_values($values);
    return $values;
}

/*~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-*/

//If new values were posted
global $gen_values;
if (!empty($_POST)) {
    $gen_values = set_values();
} else {
    $gen_values = get_values();
}

display_config();

?>