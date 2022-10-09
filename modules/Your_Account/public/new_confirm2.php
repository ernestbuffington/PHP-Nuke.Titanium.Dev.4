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
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}

if (!defined('CNBYA')) {
    die('CNBYA protection');
}

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

    $user_viewemail = "0";
    $ya_user_email = strtolower($ya_user_email);
    ya_userCheck($ya_username);
    ya_mailCheck($ya_user_email);
    if (!$stop) {
        $datekey = date("F j");
        //$rcode = hexdec(md5($_SERVER[HTTP_USER_AGENT] . $sitekey . $_POST[random_num] . $datekey));
        //$code = substr($rcode, 2, $ya_config['codesize']);
        global $sitekey, $evoconfig;
        $rcode = hexdec(md5($_SERVER['HTTP_USER_AGENT'] . $sitekey . $_POST['random_num'] . $datekey));
        $code = substr($rcode, 2, $evoconfig['codesize']);
        $gfxchk = array(3,4,6,7);
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
        echo "</table><br /><br />";
        echo "<center><strong>"._NOTE."</strong> "._YOUWILLRECEIVE."";
        echo "<form action='modules.php?name=$module_name' method='post'>";

        if (is_array($nfield)):

            if (count($nfield) > 0):

                foreach ($nfield as $key => $var):
                    echo "<input type='hidden' name='nfield[$key]' value='$nfield[$key]'>";
                endforeach;

            endif;

        endif;

        echo "<input type='hidden' name='random_num' value=\"$random_num\">";
        echo "<input type='hidden' name='gfx_check' value=\"$gfx_check\">";
        echo "<input type='hidden' name='ya_username' value=\"$ya_username\">";
        echo "<input type='hidden' name='ya_realname' value=\"$ya_realname\">";
        echo "<input type='hidden' name='ya_user_email' value=\"$ya_user_email\">";
        echo "<input type='hidden' name='user_password' value=\"$user_password\">";
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