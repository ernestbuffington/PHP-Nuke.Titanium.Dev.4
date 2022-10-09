<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

//Display the page title
donation_title();

/*==============================================================================================
    Function:    make_get_values()
    In:          N/A
    Return:      All the predefined donation values
    Notes:       N/A
================================================================================================*/
function make_get_values () {
    global $db, $prefix, $lang_donate;
    //Get the donation values
    $sql = 'SELECT config_value from '.$prefix.'_donators_config WHERE config_name="values"';
    //If not
    if(!$result = $db->sql_query($sql)) {
        DonateError($lang_donate['VALUES_NF'],0);
    }
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    //Explode them into an array
    $values = explode(',', $row[0]);
    //Send them back
    return $values;
}

/*==============================================================================================
    Function:    make_get_currency_code()
    In:          N/A
    Return:      Returns the selected currency code
    Notes:       N/A
================================================================================================*/
function make_get_currency_code () {
    global $gen_configs;
    switch ($gen_configs['currency']) {
        case 'USD':
            return "&#36;";
        break;
        case 'AUD':
            return "&#36;";
        break;
        case 'CAD':
            return "&#36;";
        break;
        case 'EUR':
            return "&euro;";
        break;
        case 'GBP':
            return "&pound;";
        break;
        case 'JPY':
            return "&yen;";
        break;
        default:
            DonateError($lang_donate['CURRENCY_NF'],0);
        break;
    }
}


/*==============================================================================================
    Function:    make_other_value()
    In:          N/A
    Return:      The other radio and text area
    Notes:       N/A
================================================================================================*/
function make_other_value () {
    $out = "<input type=\"radio\" name=\"amount\" value=\"other\" CHECKED>Other";
    $out .= "&nbsp;&nbsp;".make_get_currency_code()."<input size=\"8\" name=\"amount\" maxlength=\"8\" type=\"text\" value=\"0.00\" >\n<br />";
    return $out;
}

/*==============================================================================================
    Function:    make_display_values()
    In:          N/A
    Return:      Radios for all the predefined values
    Notes:       N/A
================================================================================================*/
function make_display_values () {
    $values = make_get_values();
    $currency_code = make_get_currency_code();
    foreach ($values as $value) {
        $radio[] = array('value' => $value, 'text' => $currency_code.$value, 'name' => 'amount', 'checked' => '');
    }
    return donate_radio($radio,1);
}

/*==============================================================================================
    Function:    make_image_button()
    In:          N/A
    Return:      Either a submit button or an image button
    Notes:       N/A
================================================================================================*/
function make_image_button () {
    global $gen_configs, $lang_donate;
    if (empty($gen_configs['button_image'])) {
        return "<tr><td class=\"row1\" colspan=\"2\"><div class=\"acenter\"><input type=\"submit\" value=\"".$lang_donate['DONATE']."\"></div></td></tr>\n";
    } else {
        return "<tr><td class=\"row1\" colspan=\"2\"><div class=\"acenter\"><input type=\"image\" src=\"".$gen_configs['button_image']."\" name=\"submit\"></div></td></tr>\n";
    }
}

/*==============================================================================================
    Function:    make_image_button()
    In:          N/A
    Return:      Types of donations
    Notes:       If there are no others on it will just return blank
================================================================================================*/
function make_type () {
    global $gen_configs, $lang_donate;
    if ($gen_configs['type_private'] == 'no' && $gen_configs['type_anon'] == 'no') {
        return '';
    }
    $radio[] = array('value' => $lang_donate['TYPE_REGULAR'], 'text' => $lang_donate['TYPE_REGULAR'], 'name' => 'os0', 'checked' => 'CHECKED', 'help' => make_help_popup($lang_donate['HELP_DONATION_REGULAR'], $lang_donate['TYPE_REGULAR']));
    if($gen_configs['type_private'] == 'yes'){
        $radio[] = array('value' => $lang_donate['TYPE_PRIVATE'], 'text' => $lang_donate['TYPE_PRIVATE'], 'name' => 'os0', 'checked' => '', 'help' => make_help_popup($lang_donate['HELP_DONATION_PRIVATE'], $lang_donate['TYPE_PRIVATE']));
    }
    if($gen_configs['type_anon'] == 'yes'){
        $radio[] = array('value' => $lang_donate['TYPE_ANON'], 'text' => $lang_donate['TYPE_ANON'], 'name' => 'os0', 'checked' => '', 'help' => make_help_popup($lang_donate['HELP_DONATION_ANON'], $lang_donate['TYPE_ANON']));
    }
    return donate_radio($radio,1);
}

/*==============================================================================================
    Function:    make_message()
    In:          N/A
    Return:      Creates the message/reason box or not
    Notes:       N/A
================================================================================================*/
function make_message () {
    global $gen_configs, $lang_donate;

    if ($gen_configs['message'] == 'no') {
        return "<input type=\"hidden\" name=\"os1\" value=\"\">\n";
    }
    $out = "<tr>\n<td class=\"row1 aright\">\n";
    $out .= $lang_donate['MESSAGE'].$lang_donate['BREAK'];
    $out .= "</td>\n<td class=\"row1\">\n";
    $out .= donate_text_area('os1', '')."</td>\n</tr>\n";
    return $out;
}

/*==============================================================================================
    Function:    make_codes e()
    In:          N/A
    Return:      Creates the combo box of codes
    Notes:       N/A
================================================================================================*/
function make_codes () {
    global $gen_configs, $lang_donate;

    if (empty($gen_configs['codes'])) {
        return '';
    }
    $codes = $gen_configs['codes'];
    $codes = str_replace("\r\n", "\n", $codes);
    $codes = explode("\n", $codes);
    $radio[] = array('value' => $gen_configs['donation_code'], 'text' => $gen_configs['donation_name'], 'name' => 'item_name', 'checked' => 'CHECKED');
    for ($i=1, $maxi=count($codes); $i < $maxi; $i=$i+2) {
        $j = $i - 1;
        $radio[] = array('value' => $codes[$i], 'text' => $codes[$j], 'name' => 'item_name', 'checked' => '');
    }
    return donate_radio($radio,1);
}

/*==============================================================================================
    Function:    make_donation()
    In:          N/A
    Return:      N/A
    Notes:       Makes the donation screen
================================================================================================*/
function make_donation () {
    global $gen_configs, $lang_donate, $module_name, $nukeurl;

    OpenTable();
    if(!empty($gen_configs['page_image'])) {
        echo "<div class=\"acenter\">\n";
        echo "<img src=\"".$gen_configs['page_image']."\" border=\"0\" alt=\"\">";
        echo "</div>\n";
        echo '<br />';
    }

    $url = ($nukeurl != 'http://www.mysite.com' && $nukeurl != 'http://--------.---' && $nukeurl != 'http://') ? $nukeurl : $_SERVER["HTTP_HOST"];
    $url = (substr($url,0,7) == 'http://') ? substr($url,7) : $url;
    $url = (substr($url,-1) == '/') ? substr($url,0, -1) : $url;

    //Use this line if you want to use the sandbox
	echo '<form action="modules.php?name='.$module_name.'&op=confirm" method="post">';
	echo "<input type=\"hidden\" name=\"currency_code\" value=\"".$gen_configs['currency']."\">\n";
	echo "<input type=\"hidden\" name=\"cmd\" value=\"_ext-enter\">\n";
	echo "<input type=\"hidden\" name=\"cmd\" value=\"_xclick\">\n";
	echo "<input type=\"hidden\" name=\"business\" value=\"".$gen_configs['pp_email']."\">\n";
    echo "<input type=\"hidden\" name=\"notify_url\" value=\"http://".$url."/modules.php?name=".$module_name."&amp;op=thankyou\">\n";
	echo "<input type=\"hidden\" name=\"no_shipping\" value=\"1\">\n";
	echo "<input type=\"hidden\" name=\"return\" value=\"http://".$url."/modules.php?name=".$module_name."&amp;op=thankyou\">\n";
	echo "<input type=\"hidden\" name=\"cancel_return\" value=\"http://".$url."/modules.php?name=".$module_name."&amp;op=cancel\">\n";
	echo "<input type=\"hidden\" name=\"rm\" value=\"2\">\n";
	echo "<input type=\"hidden\" name=\"no_note\" value=\"1\">\n";
	echo "<input type=\"hidden\" name=\"on0\" value=\"Info\">\n";
	if(is_user()) {
		 global $userinfo;
        //Get username and id
        $uname = "message|".$userinfo['user_id'] . "|". $userinfo['username'];
        echo "<input type=\"hidden\" name=\"on1\" value=\"".$uname."\">\n";
	} else {
		echo "<input type=\"hidden\" name=\"on1\" value=\"message\">\n";
	}
	if (empty($gen_configs['codes'])) {
	   echo "<input type=\"hidden\" name=\"item_name\" value=\"".$gen_configs['donation_code']."\">\n";
	}
	echo "<table width=\"50%\" border=\"0\" cellpadding=\"4\" cellspacing=\"1\" class=\"forumline\" style=\"margin:auto\">\n";
    //Values
    echo "<tr>\n<td class=\"row1 aright\">\n".$lang_donate['AMOUNT'].$lang_donate['BREAK']."\n</td>\n<td class=\"row1\">\n";
    echo make_other_value().make_display_values()."</td>\n</tr>\n";
    //Type
    $type = make_type();
    if (!empty($type)) {
        echo "<tr>\n<td class=\"row1 aright\">\n";
        echo $lang_donate['TYPE'].$lang_donate['BREAK'];
        echo "</td>\n<td class=\"row1\">\n";
        echo $type;
        echo "</td>\n</tr>\n";
    } else {
        echo "<input type=\"hidden\" name=\"os0\" value=\"".$lang_donate['TYPE_REGULAR']."\">\n";
    }
    if (!empty($gen_configs['codes'])) {
        echo "<tr>\n<td class=\"row1 aright\">\n";
        echo $lang_donate['DONATE_TO'].$lang_donate['BREAK'];
        echo "</td>\n<td class=\"row1\">\n";
        echo make_codes();
        echo "</td>\n</tr>\n";
    }
    echo make_message();
    //Button
	echo make_image_button();
	echo "</table>\n";
	echo "</form>\n";
	CloseTable();
}

setcookie('currency_code', null, time()-3600);
setcookie('business', null, time()-3600);
setcookie('on0', null, time()-3600);
setcookie('on1', null, time()-3600);
setcookie('item_name', null, time()-3600);
setcookie('amount', null, time()-3600);
setcookie('os0', null, time()-3600);
setcookie('os1', null, time()-3600);

//Get values
global $gen_configs;
$gen_configs = get_gen_configs();
if (empty($gen_configs['pp_email'])) {
    OpenTable();
    DonateError($lang_donate['NO_PP_ADD'],1);
}
make_donation();
?>