<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/*********************************************************************************/
/* CNB Your Account: An Advanced User Management System for phpnuke             */
/* ============================================                                 */
/*                                                                              */
/* Copyright (c) 2004 by Comunidade PHP Nuke Brasil                             */
/* http://dev.phpnuke.org.br & http://www.phpnuke.org.br                        */
/*                                                                              */
/* Contact author: escudero@phpnuke.org.br                                      */
/* International Support Forum: http://ravenphpscripts.com/forum76.html         */
/*                                                                              */
/* This program is free software. You can redistribute it and/or modify         */
/* it under the terms of the GNU General Public License as published by         */
/* the Free Software Foundation; either version 2 of the License.               */
/*                                                                              */
/*********************************************************************************/
/* CNB Your Account it the official successor of NSN Your Account by Bob Marion    */
/*********************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
      Evolution Functions                      v1.5.0       12/20/2005
-=[Mod]=-
      XData                                    v0.1.1       08/09/2005
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}

if (!defined('CNBYA')) {
    die('CNBYA protection');
}

if(!isset($_SESSION)) { session_start(); }

if (!isset($_SESSION['YA1']) || isset($_SESSION['YA2'])) {
    global $debugger;
    $debugger->handle_error('Session not valid for user: Name - '.Fix_Quotes($ya_username).' Email - '.Fix_Quotes($femail), 'Error');
    redirect('modules.php?name='.$module_name.'&op=new_user');
}

$_SESSION['YA2'] = true;

/*****[BEGIN]******************************************
 [ Mod:     XData                              v0.1.1 ]
 ******************************************************/
    define_once('XDATA', true);
    include_once(NUKE_MODULES_DIR.'Your_Account/public/custom_functions.php');
/*****[END]********************************************
 [ Mod:     XData                              v0.1.1 ]
 ******************************************************/

    include_once(NUKE_BASE_DIR.'header.php');

/*
// menelaos: makes the 'realname' field a required field
    if (empty($ya_realname)) {
        OpenTable();
        echo "<center><span class='title'><strong>"._ERRORREG."</strong></span><br /><br />";
        echo "<span class='content'>"._YA_NOREALNAME."<br /><br />"._GOBACK."</span></center>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
        exit;
    }
*/ 

// menelaos: added configurable doublecheck email routine
    if ($ya_config['doublecheckemail'] == 0) {
    $ya_user_email2 == $ya_user_email;
    } else {
        if ($ya_user_email != $ya_user_email2) {
        OpenTable();
        echo "<center><span class='title'><strong>"._ERRORREG."</strong></span><br /><br />";
        echo "<span class='content'>"._EMAILDIFFERENT."<br /><br />"._GOBACK."</span></center>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
        exit;
    }
    }

    $user_viewemail    = "0";
    $ya_user_email    = strtolower($ya_user_email);
    ya_userCheck($ya_username);
    ya_mailCheck($ya_user_email);
    if (!$stop) {
        $datekey = date("F j");
       global $sitekey, $evoconfig;
		
	   if(!isset($_POST['random_num']))
	   $_POST['random_num'] = '';
        
	   $rcode = hexdec(md5($_SERVER['HTTP_USER_AGENT'] . $sitekey . $_POST['random_num'] . $datekey));
       $code = substr($rcode, 2, $evoconfig['codesize']);
       $gfxchk = array(3,4,6,7);
	   
	   if(!isset($_POST['g-recaptcha-response']))
	   $_POST['g-recaptcha-response'] = '';
	   
        if (!security_code_check($_POST['g-recaptcha-response'], $gfxchk)) {
            OpenTable();
            echo "<center><span class='title'><strong>"._ERRORREG."</strong></span><br /><br />";
            echo "<span class='content'>"._RECAPTCHA_FAILED."<br /><br />"._GOBACK."</span></center>";
            CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
            exit;
        }
		# start Nuke Honeypot
		if (file_exists('./includes/honeypot/hp_confirm.php')) {
		include_once './includes/honeypot/hp_confirm.php';
		}
		# end Nuke Honeypot
        if (empty($user_password) AND empty($user_password2)) {
            $user_password = YA_MakePass();
        } elseif ($user_password != $user_password2) {
            OpenTable();
            echo "<center><span class='title'><strong>"._ERRORREG."</strong></span><br /><br />";
            echo "<span class='content'>"._PASSDIFFERENT."<br /><br />"._GOBACK."</span></center>";
            CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
            exit;
        } elseif ($user_password == $user_password2 AND (strlen($user_password) < $ya_config['pass_min'] OR strlen($user_password) > $ya_config['pass_max'])) {
            OpenTable();
            echo "<center><span class='title'><strong>"._ERRORREG."</strong></span><br /><br />";
            echo "<span class='content'>"._YA_PASSLENGTH."<br /><br />"._GOBACK."</span></center>";
            CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
            exit;
        }

        $result = $db->sql_query("SELECT * FROM ".$user_prefix."_cnbya_field WHERE need = '3' ORDER BY pos");
        while ($sqlvalue = $db->sql_fetchrow($result)) {
          $t = trim($sqlvalue[fid]);
          if (empty($nfield[$t])) {
            OpenTable();
            if (substr($sqlvalue[name],0,1)=='_') eval( "\$name_exit = $sqlvalue[name];"); else $name_exit = $sqlvalue[name];
            echo "<center><span class='title'><strong>"._ERRORREG."</strong></span><br /><br />";
            echo "<span class='content'>"._YA_FILEDNEED1."$name_exit"._YA_FILEDNEED2."<br /><br />"._GOBACK."</span></center>";
            CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
            exit;
          };
        }

        title(_USERREGLOGIN);
        OpenTable();
        echo "<center><strong>"._USERFINALSTEP."</strong><br /><br />$ya_username, "._USERCHECKDATA."</center><br /><br />";
        echo "<table align='center' border='0'>";
        echo "<tr><td><strong>"._USERNAME.":</strong> $ya_username<br /></td></tr>";
        echo "<tr><td><strong>"._EMAIL.":</strong> $ya_user_email</td></tr>";
// menelaos: removed display of the user password here. It is mailed to the user
//      echo "<tr><td><strong>"._YA_PASSWORD.":</strong> $user_password<br /></td></tr>";
        echo "</table>";
        echo "<center><form action='modules.php?name=$module_name' method='post'>";
        
		if(!isset($nfield))
		$nfield = '';
		if(!isset($random_num))
        $random_num = '';
		if(!isset($gfx_check))
		$gfx_check = '';

        if (is_array($nfield))
        {
            if (count($nfield) > 0) 
            {
                foreach ($nfield as $key => $var)
                {
                    echo "<input type='hidden' name='nfield[$key]' value='$nfield[$key]'>";
                }
            }
        }

        echo "<input type='hidden' name='random_num' value=\"$random_num\">";
        echo "<input type='hidden' name='gfx_check' value=\"$gfx_check\">";
        echo "<input type='hidden' name='ya_username' value=\"$ya_username\">";
        echo "<input type='hidden' name='ya_user_email' value=\"$ya_user_email\">";
        echo "<input type='hidden' name='user_password' value=\"$user_password\">";
        // MrFluffy $realname to $ya_realname
        echo "<input type='hidden' name='realname' value=\"$ya_realname\">\n";
        echo "<input type='hidden' name='femail' value=\"$femail\">\n";
        echo "<input type='hidden' name='user_website' value=\"$user_website\">\n";
        echo "<input type='hidden' name='user_from' value=\"$user_from\">\n";
        echo "<input type='hidden' name='user_occ' value=\"$user_occ\">\n";
        echo "<input type='hidden' name='user_interests' value=\"$user_interests\">\n";
        echo "<input type='hidden' name='newsletter' value=\"$newsletter\">\n";
        echo "<input type='hidden' name='user_viewemail' value=\"$user_viewemail\">\n";
        echo "<input type='hidden' name='user_allow_viewonline' value=\"$user_allow_viewonline\">\n";
        echo "<input type='hidden' name='user_timezone' value=\"$user_timezone\">\n";
        echo "<input type='hidden' name='user_dateformat' value=\"$user_dateformat\">\n";
        echo "<input type='hidden' name='user_sig' value=\"$user_sig\">\n";
        echo "<input type='hidden' name='bio' value=\"$bio\">\n";
/*****[BEGIN]******************************************
 [ Mod:     XData                              v0.1.1 ]
 ******************************************************/
        $xdata = array();
        $xd_meta = get_xd_metadata();
        foreach ($xd_meta as $name => $info)
        {
            if ( isset($HTTP_POST_VARS[$name]) && $info['handle_input'] )
            {
                $xdata[$name] = trim($HTTP_POST_VARS[$name]);
                echo "<input type='hidden' name='".$name."' value=\"".$xdata[$name]."\">\n";
            }
        }
/*****[END]********************************************
 [ Mod:     XData                              v0.1.1 ]
 ******************************************************/
         echo "<input type='hidden' name='op' value='new_finish'><br /><br />";
        echo "<input type='submit' value='"._FINISH."'> &nbsp;&nbsp;"._GOBACK."</form></center>";
        CloseTable();
    } else {
        OpenTable();
        echo "<center><span class='title'><strong>"._ERRORREG."</strong></span><br /><br />";
        echo "<span class='content'>$stop<br /><br />"._GOBACK."</span></center>";
        CloseTable();
    }
    include_once(NUKE_BASE_DIR.'footer.php');

?>