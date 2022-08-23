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
    Function:    thank_values()
    In:          N/A
    Return:      true - Donation recorded
                 false - Donation not recorded
    Notes:       Checks all the values and writes them to the donation table
================================================================================================*/
function thank_values ($option_selection1, $option_selection2, $first_name, $last_name, $payer_email, $payment_gross, $item_name, $uid, $uname) {
    global $gen_configs, $lang_donate, $db, $prefix, $nsnst_const, $cache;

    //Look for the type of donation
    if (isset($option_selection1) && !empty($option_selection1)) {
        //If its anonomyous
        if ($option_selection1 == $lang_donate['TYPE_ANON']) {
            $sql = 'INSERT INTO '.$prefix.'_donators VALUES("","","","","","","'.$payment_gross.'",'.time().',"'.$donshow.'","","","", "'.$item_name.'")';
            $ok = ($db->sql_query($sql)) ? true : false;
            return $ok;
        } else {
            $donshow = ($option_selection1 == $lang_donate['TYPE_REGULAR']) ? '1' : '0';
        }
    } else {
        $donshow = 1;
    }
    //Get Reason/Message
    $message = '';
    if (isset($option_selection2)) {
        $message = Fix_Quotes($option_selection2, true);
    }
    //Insert donation into DB
    $sql = 'INSERT INTO '.$prefix.'_donators VALUES("","'.$uid.'","'.$uname.'","'.$first_name.'","'.$last_name.'","'.$payer_email.'","'.$payment_gross.'",'.time().',"'.$donshow.'","'.$nsnst_const['remote_ip'].'","", "'.$message.'","'.$item_name.'")';
    $ok = ($db->sql_query($sql)) ? true : false;
    //Clear cache
    $cache->delete('block', 'donations');
    $cache->delete('general', 'donations');
    $cache->delete('donations', 'donations');
    return $ok;
}


//Get values
global $gen_configs;
$gen_configs = get_gen_configs();

// Start PayPal IPN
// read the post FROM PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';

unset($_GET);
unset($option_selection1, $option_selection2, $first_name, $last_name, $payer_email, $mc_gross, $item_name, $uid, $uname, $payment_gross);

if (is_array($_POST)) {
    $postvars = array();
    foreach ($_POST as $key => $value) {
        $$key = $value;
        $postvars[] = $key;
    }
    for ($var = 0, $max_var = count($postvars); $var < $max_var; $var++) {
        $postvar_key = $postvars[$var];
        $postvar_value = $$postvars[$var];
        $req .= "&" . $postvar_key . "=" . urlencode ($postvar_value);
    }

    // post back to PayPal system to validate
    define('_PAYPALSITE', 'www.paypal.com');
    $header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
    $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
    $header .= 'Content-Length: ' . strlen($req) . "\r\n\r\n";
    $fp = @fsockopen(_PAYPALSITE, 80, $errno, $errstr, 30);

    if ($fp) {
        @fputs($fp, $header . $req);
        while (!feof($fp)) {
            $res .= fgets ($fp, 1024);
        }
        fclose ($fp);
    }
}

if (!isset($_SESSION)) { session_start(); }
if ((isset($_SESSION['PP_D']) && is_array($_SESSION['PP_D'])) ||
    (isset($_COOKIE['amount']) && !empty($_COOKIE['amount'])) ||
    (isset($mc_gross) && !empty($mc_gross)) ||
    (isset($payment_gross) && !empty($payment_gross))) {

    if (!isset($option_selection1) || empty($option_selection1)) {
        if (isset($_SESSION['PP_D']['os0']) && !empty($_SESSION['PP_D']['os0'])) {
            $option_selection1 = $_SESSION['PP_D']['os0'];
        } else if (isset($_COOKIE['os0']) && !empty($_COOKIE['os0'])) {
            $option_selection1 = $_COOKIE['os0'];
        } else {
            $option_selection1 = '';
        }
    }
    Fix_Quotes($option_selection1);

    if (!isset($option_selection2) || empty($option_selection2)) {
        if (isset($_SESSION['PP_D']['os1']) && !empty($_SESSION['PP_D']['os1'])) {
            $option_selection2 = $_SESSION['PP_D']['os1'];
        } else if (isset($_COOKIE['os1']) && !empty($_COOKIE['os1'])) {
            $option_selection2 = $_COOKIE['os1'];
        } else {
            $option_selection2 = '';
        }
    }
    Fix_Quotes($option_selection2);

    if (!isset($option_name2) || empty($option_name2)) {
        if (isset($_SESSION['PP_D']['on1']) && !empty($_SESSION['PP_D']['on1'])) {
            $option_name2 = $_SESSION['PP_D']['on1'];
        } else if (isset($_COOKIE['on1']) && !empty($_COOKIE['on1'])) {
            $option_name2 = $_COOKIE['on1'];
        } else {
            $option_name2 = '';
        }
    }
    Fix_Quotes($option_name2);

    $first_name = (!empty($first_name)) ? Fix_Quotes($first_name) : '';
    $last_name = (!empty($last_name)) ? Fix_Quotes($last_name) : '';
    $payer_email = (!empty($payer_email)) ? Fix_Quotes($payer_email) : '';

    if (!isset($mc_gross) || empty($mc_gross)) {
        if (isset($payment_gross) && !empty($payment_gross)) {
            $mc_gross = $payment_gross;
        } else if (isset($_SESSION['PP_D']['amount']) && !empty($_SESSION['PP_D']['amount'])) {
            $mc_gross = $_SESSION['PP_D']['amount'];
        } else if (isset($_COOKIE['amount']) && !empty($_COOKIE['amount'])) {
            $mc_gross = $_COOKIE['amount'];
        } else {
            $mc_gross = '';
        }
    }
    Fix_Quotes($mc_gross);

    if (!isset($item_name) || empty($item_name)) {
        if (isset($_SESSION['PP_D']['item_name']) && !empty($_SESSION['PP_D']['item_name'])) {
            $item_name = $_SESSION['PP_D']['item_name'];
        } else if (isset($_COOKIE['item_name']) && !empty($_COOKIE['item_name'])) {
            $item_name = $_COOKIE['item_name'];
        } else {
            $item_name = '';
        }
    }
    Fix_Quotes($item_name);
    $uname = '';
    $uid = '';
    if (is_user()) {
        global $userinfo;
        if (isset($userinfo['username']) && !empty($userinfo['username'])) {
            $uname = $userinfo['username'];
            $uid = $userinfo['user_id'];
        }
    }

    if(!empty($mc_gross)) {
    	$ok = thank_values($option_selection1, $option_selection2, $first_name, $last_name, $payer_email, $mc_gross, $item_name, $uid, $uname);
    } else {
    	$ok = true;
    }

    //Kill everything
    $_SESSION['PP_D'] = null;
    unset($_SESSION['PP_D']);
    session_write_close();
    setcookie('currency_code', null, time()-3600);
    setcookie('business', null, time()-3600);
    setcookie('on0', null, time()-3600);
    setcookie('on1', null, time()-3600);
    setcookie('item_name', null, time()-3600);
    setcookie('amount', null, time()-3600);
    setcookie('os0', null, time()-3600);
    setcookie('os1', null, time()-3600);
}

OpenTable();
if($ok) {
    echo "<div align=\"center\">\n";
    if(!empty($gen_configs['thank_image'])) {
        echo "<img src=\"".$gen_configs['thank_image']."\" border=\"0\" alt=\"\">\n";
        echo "<br />";
    }
    echo nl2br($gen_configs['thank_message']);
    echo "</div>";
    //Clear the cache
    $cache->delete('', 'donations');
} else {
    DonateError($lang_donate['FAILED']);
}
CloseTable();

?>