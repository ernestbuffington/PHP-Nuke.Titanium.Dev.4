<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

//Display the page title
donation_title();

function confirm_donation () {
    global $gen_configs, $lang_donate, $module_name, $_GETVAR;

    $_GETVAR->unsetVariables();

    if (!isset($_SERVER['HTTP_REFERER']) || empty($_SERVER['HTTP_REFERER'])) {
        redirect('modules.php?name='.$module_name.'&op=make');
    }

    if (!isset($_SESSION)) { session_start(); }
    if (isset($_SESSION['PP_D'])) unset($_SESSION['PP_D']);
    $_SESSION['PP_D'] = $_POST;
    $cookie = '';
    if ($gen_configs['cookie'] == 'yes') {
        setcookie('currency_code', $_POST['currency_code'], time()+3600);
        setcookie('business', $_POST['business'], time()+3600);
        setcookie('on0', $_POST['on0'], time()+3600);
        setcookie('on1', $_POST['on1'], time()+3600);
        setcookie('item_name', $_POST['item_name'], time()+3600);
        setcookie('amount', $_POST['amount'], time()+3600);
        setcookie('os0', $_POST['os0'], time()+3600);
        setcookie('os1', $_POST['os1'], time()+3600);
        $cookie = 'onclick="donationcookie()"';
    }

    OpenTable();
    //Use this line if you want to use the sandbox
	//echo "<form action=\"https://www.sandbox.paypal.com/cgi-bin/webscr\" method=\"post\">\n";
	echo '<form action="https://www.paypal.com/cgi-bin/webscr" method="post">';
    foreach ($_POST as $key => $value) {
        echo "<input type=\"hidden\" name=\"".$key."\" value=\"".$value."\">\n";
    }
	echo "<table width=\"45%\" border=\"0\" align=\"center\">\n";
	//Change to force a language
	//echo "<input type='hidden' name='lc' value='US'>";
	echo "<tr><td colspan=\"2\"><div align=\"center\">".sprintf($lang_donate['CONFIRM_DONATION'], $_POST['amount'], $_POST['currency_code'])."</div></td></tr>\n";
	echo "<tr><td colspan=\"2\"><div align=\"center\"><input type=\"submit\" value=\"".$lang_donate['CONFIRM']."\" $cookie></div></td></tr>\n";
	echo "<tr><td colspan=\"2\"><div align=\"center\">".$lang_donate['COME_BACK']."</div></td></tr>\n";
	echo "</table>\n";
	echo "</form>\n";
	CloseTable();
}

//Get values
global $gen_configs;
$gen_configs = get_gen_configs();
if (empty($gen_configs['pp_email'])) {
    OpenTable();
    DonateError($lang_donate['NO_PP_ADD'],1);
}
confirm_donation();
?>