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

/*****['CHANGES']**********************************************************
-=['Base']=-
      Nuke Patched                             v3.1.0       06/26/2005
      NukeSentinel                             v2.5.00      07/11/2006
      Caching System                           v1.0.0       10/31/2005
      Evolution Functions                      v1.5.0       12/20/2005
 ************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

/*************************************************************************************/
// function Show_CNBYA_menu(){ [added by menelaos dot hetnet dot nl']
/*************************************************************************************/
function Show_CNBYA_menu(){
    global $stop, $module_name, $redirect, $mode, $t, $f, $ya_config;
    OpenTable();
    if ($stop) {
        echo "<center><span class=\"title\"><strong>"._LOGININCOR."</strong></span></center>\n";
    } else {
        echo "<center><span class=\"title\"><strong>"._USERREGLOGIN."</strong></span></center>\n";
    }

    echo "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\"><tr><td align=\"left\"><span class=\"content\">\n";
    echo "[ <a href=\"modules.php?name=$module_name\">"._LOGIN."</a> \n";
    echo "| <a href=\"modules.php?name=$module_name&amp;op=new_user\">"._REGNEWUSER."</a> ]\n";
    echo "</td><td align=\"right\"><span class=\"content\">\n";
    echo "[ <span class=\"content\"><a href=\"modules.php?name=$module_name&amp;op=pass_lost\">"._PASSWORDLOST."</a> \n";
    echo "| <a href=\"modules.php?name=$module_name&amp;op=ShowCookiesRedirect\">"._YA_COOKIEDELALL."</a> ]</span>\n";
    echo "</td></tr></table>\n";
    CloseTable();
}

function ya_userCheck($username){
    global $stop, $user_prefix, $db, $ya_config, $prefix;
	
	// Remove any whitespace
	$username = trim($username);
	
    if (!Validate($username, 'username', '', 1, 1)){
        $stop = "<center>"._ERRORINVNICK."</center><br />";
    }
	
    if (strlen($username) > $ya_config['nick_max']) $stop = "<center>"._YA_NICKLENGTH."</center>";
    if (strlen($username) < $ya_config['nick_min']) $stop = "<center>"._YA_NICKLENGTH."</center>";
	
    $result = $db->sql_query("SELECT disallow_username FROM ". $prefix ."_bbdisallow");
    $disallowed = $db->sql_fetchrowset($result);
	
	if (is_array($disallowed)){
        foreach($disallowed as $bad_nick){
			$ya_config['bad_nick'] .= "\n".$bad_nick['disallow_username'];
        }
    }
	
	if (isset($ya_config['bad_nick']) && !empty($ya_config['bad_nick'])){
		$BadNickList = explode("\n", $ya_config['bad_nick']);
		
		if (!empty($BadNickList) && is_array($BadNickList)){
			for($i=0; $i<count($BadNickList); $i++){
				if (strtolower(trim($BadNickList[$i])) == strtolower($username)){
					$stop = "<center>"._NAMERESTRICTED."</center><br />";
					break;
				}
			}
		}
	}
	
    if (strrpos($username,' ') > 0) $stop = "<center>"._NICKNOSPACES."</center>";
    if ($db->sql_numrows($db->sql_query("SELECT username FROM ".$user_prefix."_users WHERE username='$username'")) > 0) $stop = "<center>"._NICKTAKEN."</center><br />";
    if ($db->sql_numrows($db->sql_query("SELECT username FROM ".$user_prefix."_users_temp WHERE username='$username'")) > 0) $stop = "<center>"._NICKTAKEN."</center><br />";
	
    return ($stop);
}

function ya_mail($email, $subject, $message, $from) {
global $ya_config, $adminmail;
    if ($ya_config['servermail'] == 0) {
        if (trim($from) == '') $from  = "From: $adminmail\n" . "Reply-To: $adminmail\n" . "Return-Path: $adminmail\n";
        evo_mail($email, $subject, $message, $from);
    }
}

function ya_mailCheck($user_email) {
    global $stop, $user_prefix, $db, $ya_config;
	
    $user_email = strtolower($user_email);
	
    if ((!$user_email) || (empty($user_email)) || (!preg_match("/^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$/i", $user_email))) $stop = "<center>"._ERRORINVEMAIL."</center><br />";
	
    if ($ya_config['bad_mail'] > ""){
        $BadMailList = explode("\n", $ya_config['bad_mail']);
		
        for($i=0; $i<count($BadMailList); $i++){
            if (substr($user_email, -strlen(trim($BadMailList[$i]))) == strtolower(trim($BadMailList[$i]))){
				$stop = "<center>"._MAILBLOCKED." <strong>".$BadMailList[$i]."</strong></center><br />";
				break;
			}
       	}
    }
	
    if (strrpos($user_email,' ') > 0) $stop = "<center>"._ERROREMAILSPACES."</center><br />";
    if ($db->sql_numrows($db->sql_query("SELECT user_email FROM ".$user_prefix."_users WHERE user_email='$user_email'")) > 0) $stop = "<center>"._EMAILREGISTERED."</center><br />";
    if ($db->sql_numrows($db->sql_query("SELECT user_email FROM ".$user_prefix."_users WHERE user_email='".md5($user_email)."'")) > 0) $stop = "<center>"._EMAILNOTUSABLE."</center><br />";
    if ($db->sql_numrows($db->sql_query("SELECT user_email FROM ".$user_prefix."_users_temp WHERE user_email='$user_email'")) > 0) $stop = "<center>"._EMAILREGISTERED."</center><br />";
    
	return ($stop);
}

function ya_passCheck($user_pass1, $user_pass2) {
    global $stop, $ya_config;
    if (strlen($user_pass1) > $ya_config['pass_max']) $stop = "<center>"._YA_PASSLENGTH."</center><br />";
    if (strlen($user_pass1) < $ya_config['pass_min']) $stop = "<center>"._YA_PASSLENGTH."</center><br />";
    if ($user_pass1 != $user_pass2) $stop = "<center>"._PASSWDNOMATCH."</center><br />";
    return($stop);
}

function ya_fixtext($ya_fixtext) {
    if (empty($ya_fixtext)) { return $ya_fixtext; }
    $ya_fixtext = Fix_Quotes($ya_fixtext);
    return $ya_fixtext;
}

// function improved by Peter
function ya_save_config($config_name, $config_value, $config_param=""){
    global $prefix, $db, $cache;
    Fix_Quotes($config_value);
    if($config_param == 'html') {
        $config_name = check_html($config_name, 'nohtml');
        $config_value = check_html($config_value, 'html');
        $db -> sql_query("UPDATE ".$prefix."_cnbya_config SET config_value='$config_value' WHERE config_name='$config_name'");
    }
    if($config_param == 'nohtml') {
        $config_name = check_html($config_name, 'nohtml');
        $config_value = ya_fixtext(check_html($config_value, 'nohtml'));
        $db -> sql_query("UPDATE ".$prefix."_cnbya_config SET config_value='$config_value' WHERE config_name='$config_name'");
    } else {
        $config_name=check_html($config_name, 'nohtml');
        $config_value = intval($config_value);
        $db -> sql_query("UPDATE ".$prefix."_cnbya_config SET config_value='$config_value' WHERE config_name='$config_name'");
    }
}

function ya_get_configs(){
    global $prefix, $db, $cache;
    
	static $ya_config;
    
	if(isset($ya_config)):
	  
	  $ya_config = $cache->load('titanium_ya_config', 'config'); 
	  
	  return $ya_config;
	
	endif;
	
      $configresult = $db->sql_query("SELECT config_name, config_value FROM ".$prefix."_cnbya_config");

      while (list($config_name, $config_value) = $db->sql_fetchrow($configresult)) 
	  {
          if(isset($config_value))
		  $ya_config[$config_name] = $config_value;
      }
      $db->sql_freeresult($configresult);
    
	  $cache->save('titanium_ya_config', 'config', $ya_config);
    
    return $ya_config;
}

function yacookie($setuid, $setusername, $setpass, $setstorynum, $setumode, $setuorder, $setthold, $setnoscore, $setublockon, $settheme, $setcommentmax) {
    global $ya_config, $db, $prefix, $identify;
    $ip = $identify->get_ip();
    $result = $db->sql_query("SELECT time FROM ".$prefix."_session WHERE uname='$setusername'");
    $ctime = time();

    $guest = 1;
    $user_agent = $identify->identify_agent();
    
	   if (is_user()) 
	   {
          $guest = 0;
       } 
	   elseif(isset($user_agent['engine']) && $user_agent['engine'] == 'bot') 
	   {
          $guest = 3;
       }
    
	if (!empty($setusername)) {
        $uname = substr($setusername, 0,25);
        if ($row = $db->sql_fetchrow($result)) {
            $db->sql_query("UPDATE ".$prefix."_session SET uname='$setusername', time='$ctime', host_addr='$ip', guest='$guest' WHERE uname='$uname'");
        } else {
            $db->sql_query("INSERT INTO ".$prefix."_session (uname, time, host_addr, guest) VALUES ('$uname', '$ctime', '$ip', '$guest')");
        }
    }
    $db->sql_freeresult($result);

    $info = base64_encode("$setuid:$setusername:$setpass:$setstorynum:$setumode:$setuorder:$setthold:$setnoscore:$setublockon:$settheme:$setcommentmax");
    if ($ya_config['cookietimelife'] != '-') {
      if (trim($ya_config['cookiepath']) != '') @setcookie("user",$info,time()+$ya_config['cookietimelife'],$ya_config['cookiepath']);
      else @setcookie("user","$info",time()+$ya_config['cookietimelife']);
    }
    else {
      @setcookie("user","$info");
    }
}

function YA_CoolSize($size) {
    $mb = 1024*1024;
    if ( $size > $mb ) {
        $mysize = sprintf ("%01.2f",$size/$mb) . " MB";
    } elseif ( $size >= 1024 ) {
        $mysize = sprintf ("%01.2f",$size/1024) . " Kb";
    } else {
        $mysize = $size . " bytes";
    }
    return $mysize;
}

function YA_MakePass() {
    static $makepass;
    if(isset($makepass)) return $makepass;
    $cons = 'bcdfghjklmnpqrstvwxyz';
    $vocs = 'aeiou';
    for ($x=0; $x < 6; $x++) {
		mt_srand(0, MT_RAND_MT19937);
        $con[$x] = substr($cons, mt_rand(0, strlen($cons)-1), 1);
        $voc[$x] = substr($vocs, mt_rand(0, strlen($vocs)-1), 1);
    }
	mt_srand(0, MT_RAND_MT19937);
    $num1 = mt_rand(0, 9);
    $num2 = mt_rand(0, 9);
    $makepass = $con[0] . $voc[0] .$con[2] . $num1 . $num2 . $con[3] . $voc[3] . $con[4];
    return $makepass;
}

function amain() {
    global $ya_config, $module_name, $db, $user_prefix, $bgcolor2, $bgcolor1, $textcolor1, $find, $what, $match, $query, $admin_file;
    $cnbyaversion = $ya_config['version'];

    OpenTable();
    $act = $db->sql_numrows($db->sql_query("SELECT * FROM ".$user_prefix."_users WHERE user_level>'0' AND user_id>'1'"));
    $sus = $db->sql_numrows($db->sql_query("SELECT * FROM ".$user_prefix."_users WHERE user_level='0' AND user_id>'1'"));
    $del = $db->sql_numrows($db->sql_query("SELECT * FROM ".$user_prefix."_users WHERE user_level='-1' AND user_id>'1'"));
    $nor = $db->sql_numrows($db->sql_query("SELECT * FROM ".$user_prefix."_users WHERE user_id>'1'"));
    $pen = $db->sql_numrows($db->sql_query("SELECT * FROM ".$user_prefix."_users_temp"));

    echo "<table align='center' cellpadding='2' cellspacing='2' border='0' width='100%'>\n";

    echo "<tr>\n";
    //echo "<td align='center' colspan='4'><a href='" . $admin_file . ".php'>"._YA_ADMINISTRATION."</a></td>\n";
    echo "</tr>\n";
    echo "<tr>\n";
    echo "<td align='center' width='33%'><a href='modules.php?name=$module_name&amp;file=admin&amp;op=addUser'>"._ADDUSER."</a></td>\n";
    echo "<td align='center' width='33%'><a href='modules.php?name=$module_name&amp;file=admin&amp;op=UsersConfig'>"._USERSCONFIG."</a></td>\n";
    echo "<td align='right'><a href='modules.php?name=$module_name&amp;file=admin&amp;op=listnormal&amp;query=1'>"._ACTIVEUSERS.":</a>";
    echo "<td align='left'>($act)</td>\n";
    echo "</tr>\n";
    echo "<tr>";
    echo "<td align='center' width='33%'><a href='modules.php?name=$module_name&amp;file=admin&amp;op=addField'>"._YA_ADDFIELD."</a></td>\n";
    echo "<td align='center' width='33%'><a href='modules.php?name=$module_name&amp;file=admin&amp;op=CookieConfig'>"._COOKIECONFIG."</a></td>\n";
    echo "<td align='right'><a href='modules.php?name=$module_name&amp;file=admin&amp;op=listnormal&amp;query=a'>"._NORMALUSERS.":</a>";
    echo "<td align='left'>($nor)</td>\n";
    echo "</tr>\n";
    echo "<tr>\n";
    echo "<td align='center' width='33%'><a href='modules.php?name=$module_name&amp;file=admin&amp;op=searchUser'>"._SEARCHUSERS."</a></td>\n";
    echo "<td align='center' width='33%'><a href='modules.php?name=$module_name&amp;file=admin&amp;op=editTOS'>"._EDITTOS."</a></td>\n";
    echo "<td align='right'><a href='modules.php?name=$module_name&amp;file=admin&amp;op=listnormal&amp;query=-1'>"._DELETEUSERS.":</a>";
    echo "<td align='left'>($del)</td>\n";
    echo "</tr>\n";
    echo "<tr>\n";
    echo "<td align='center' width='33%'>&nbsp;</td>\n";
    echo "<td align='center' width='33%'>&nbsp;</td>\n";
    echo "<td align='right'><a href='modules.php?name=$module_name&amp;file=admin&amp;op=listnormal&amp;query=0'>"._SUSPENDUSERS.":</a>";
    echo "<td align='left'>($sus)</td>\n";
    echo "</tr>\n";
    echo "<tr>\n";
//  echo "<td align='center' width='33%'><a href='modules.php?name=$module_name&amp;file=admin&amp;op=autoSuspend'>"._YA_CHKAUTOSUS."</a></td>";
    echo "<td align='center' width='33%'><a href='modules.php?name=$module_name&amp;file=admin&amp;op=credits'>"._CREDITS."</a></td>\n";
    echo "<td align='center' width='33%'>[CNB Your Account $cnbyaversion]</td>\n";
    echo "<td align='right'><a href='modules.php?name=$module_name&amp;file=admin&amp;op=listpending'>"._WAITINGUSERS.":</a>";
    echo "<td align='left'>($pen)</td>\n";
    echo "</tr>\n";

    echo "</table>\n";
    CloseTable();
}

function asearch() {
    global $module_name, $bgcolor2, $bgcolor1, $textcolor1, $find, $what, $match, $query, $db, $user_prefix;
    OpenTable();
    echo "<table style='margin:auto' cellpadding='2' cellspacing='2' border='0'>\n";
    echo "<form method='post' action='modules.php?name=$module_name&amp;file=admin'>\n";
    echo "<input type='hidden' name='op' value='listresults'>\n";
    echo "<tr>\n";
    echo "<td align='center'><strong>"._YA_FIND.":</strong></td>\n";
    echo "<td align='center'><strong>"._YA_BY.":</strong></td>\n";
    echo "<td align='center'><strong>"._YA_MATCH.":</strong></td>\n";
    echo "<td align='center'><strong>"._YA_QUERY.":</strong></td>\n";
    echo "</tr>\n<tr>\n";
    if ($find == "tempUser") { $sel1 = ""; $sel2 = " selected"; } else { $sel1 = " selected"; $sel2 = ""; }
    echo "<td align='center'><select name='find'>\n";
    echo "<option value='findUser'$sel1>"._YA_REGLUSER."</option>\n";
    echo "<option value='tempUser'$sel2>"._YA_TEMPUSER."</option>\n";
    echo "</select></td>\n";

    echo "<td align='center'><select name='what'>\n";
    $result = $db->sql_query("DESCRIBE " . $user_prefix . "_users");
    while($row = $db->sql_fetchrow($result)){
        if($row[0] != "user_password") {
            echo "<option value='" . $row[0]."' " . ((($what == $row[0]) || (empty($what) && $row[0] == "username") )? "selected" : "") . ">" . ucwords(str_replace("_", " ", $row[0])) . "</option>\n";
        }
    }
    echo "</select></td>\n";
    if ($match == "equal") { $sel1 = ""; $sel2 = " selected"; } else { $sel1 = " selected"; $sel2 = ""; }
    echo "<td align='center'><select name='match'>\n";
    echo "<option value='like' $sel1>"._YA_LIKE."</option>\n";
    echo "<option value='equal' $sel2>"._YA_EQUAL."</option>\n";
    echo "</select></td>\n";
    echo "<td align='center'><input type='text' name='query' value='$query' size='30' maxlength='60'></td>\n";
    echo "<td align='center'><input type='submit' value='"._YA_SEARCH."'></td>\n";
    echo "</tr>\n";
    echo "</form>\n";
    echo "</table>\n";
    CloseTable();
}

function mmain($user) {
    global $stop, $module_name, $redirect, $mode, $t, $f, $ya_config, $user, $p;
    if(!is_user()) {
        include_once(NUKE_BASE_DIR.'header.php');
        //mt_srand ((double)microtime()*1000000);
		mt_srand(0, MT_RAND_MT19937);
        $maxran = 10000000;
        $random_num = mt_rand(0, $maxran);
        Show_CNBYA_menu();
        OpenTable();
        echo "<br /><table width=\"100%\" cellpadding=\"4\" cellspacing=\"1\" class=\"forumline\" border=\"0\">";
        
		echo "    <tr>";
        echo "        <th class=\"thHead\">" . _EUCOOKIETITLE . "</th>";
        echo "    </tr>";
        
		echo "    <tr>";
        echo "        <td align=\"left\" class=\"row1\">" . _EUCOOKIEAUTH . "</td>";
        echo "    </tr>";

		echo "    <tr>";
        echo "        <th class=\"thHead\">&nbsp;</th>";
        echo "    </tr>";
        
		echo "</table><br />";
        
		# align this motherfucker
		echo '<div align="center">';
		
		echo "<form action=\"modules.php?name=".$module_name."\" method=\"post\">\n";
        echo "<table border=\"0\">\n";
        
		echo "<tr><td>"._NICKNAME.":</td><td><input type=\"text\" name=\"username\" size=\"25\" maxlength=\"25\"></td></tr>\n";

		echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>\n";
        
		echo "<tr><td>"._PASSWORD.":</td><td><input type=\"password\" name=\"user_password\" size=\"25\" maxlength=\"25\" AutoComplete=\"off\"></td></tr>\n";

		echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>\n";
		
        echo "<input type=\"hidden\" name=\"redirect\" value=\"". $redirect ."\">\n"; 
        echo "<input type=\"hidden\" name=\"mode\" value=\"".$mode."\">\n";
        echo "<input type=\"hidden\" name=\"f\" value=\"".$f."\">\n";
        echo "<input type=\"hidden\" name=\"t\" value=\"".$t."\">\n";
        echo "<input type=\"hidden\" name=\"p\" value=\"".$p."\">\n";
        echo "<input type=\"hidden\" name=\"op\" value=\"login\">\n";
		echo "<tr><td colspan='2'>";
 		
		$cnbchk = array(2,4,5,7);
   		echo security_code($cnbchk, 'normal', '1'); //Size - compact || normal

		echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>\n";
		
		echo "</td></tr>";
        
		echo "<tr><td colspan=\"2\"><div align=\"center\"><input type=\"submit\" value=\""._LOGIN."\">";
        

		echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>\n";

		if ($ya_config['useactivate'] == 0) { echo "<br />("._BESUREACT.")\n"; }
        
		echo "</div></td></tr>\n";
		echo "</table></form>\n";
		
		echo '</div>';
		
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    } elseif (is_user()) {
        global $cookie;
        redirect("modules.php?name=$module_name&op=userinfo&username=$cookie[1]");
    }
}

function yapagenums($op, $totalselected, $perpage, $max, $find, $what, $match, $query) {
    global $module_name;
    $pagesint = ($totalselected / $perpage);
    $pageremainder = ($totalselected % $perpage);
    if ($pageremainder != 0) {
        $pages = ceil($pagesint);
        if ($totalselected < $perpage) { $pageremainder = 0; }
    } else {
        $pages = $pagesint;
    }
    if ($pages != 1 && $pages != 0) {
        $counter = 1;
        $currentpage = ($max / $perpage);
        echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
        echo "<tr><form action='modules.php?name=$module_name&amp;file=admin' method='post'>\n";
        echo "<input type='hidden' name='op' value='$op'>\n";
        if ($what > "")    { echo "<input type='hidden' name='what' value='$what'>\n"; }
        if ($find > "")    { echo "<input type='hidden' name='find' value='$find'>\n"; }
        if ($match > "")    { echo "<input type='hidden' name='match' value='$match'>\n"; }
        if ($query > "")    { echo "<input type='hidden' name='query' value='$query'>\n"; }
        echo "<td align='center'><strong>"._YA_SELECTPAGE.": </strong><select name='min'>\n";
        while ($counter <= $pages ) {
            $mintemp = ($perpage * $counter) - $perpage;
            if($counter == $currentpage) {
                echo "<option selected>$counter</option>\n";
            } else {
                echo "<option value='$mintemp'>$counter</option>\n";
            }
            $counter++;
        }
        echo "</select><strong> "._YA_OF." $pages "._YA_PAGES."</strong> <input type='submit' value='"._YA_GO."'></td>\n</form>\n</tr>\n";
        echo "</table>\n";
    }
}

function disabled() {
    DisplayError("<span class='option'>"._ACTDISABLED."</span>");
}

function notuser() {
    DisplayError("<span class='option'>"._MUSTBEUSER."</span>");
}

?>