<?php
/*=============================================================================== 
   PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 ================================================================================*/

/*********************************************************************************/
/* CNB Your Account: An Advanced User Management System for phpnuke              */
/* ============================================                                  */
/*                                                                               */
/* Copyright (c) 2004 by Comunidade PHP Nuke Brasil                              */
/* http://dev.phpnuke.org.br & http://www.phpnuke.org.br                         */
/*                                                                               */
/* Contact author: escudero@phpnuke.org.br                                       */
/* International Support Forum: http://ravenphpscripts.com/forum76.html          */
/*                                                                               */
/* This program is free software. You can redistribute it and/or modify          */
/* it under the terms of the GNU General Public License as published by          */
/* the Free Software Foundation; either version 2 of the License.                */
/*                                                                               */
/*********************************************************************************/
/* CNB Your Account it the official successor of NSN Your Account by Bob Marion  */
/*********************************************************************************/

/*****[CHANGES]*******************************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
      NukeSentinel                             v2.5.00      07/11/2006
-=Mod=-
      CNBYA Modifications                      v1.0.0       08/11/2005
 *********************************************************************************/

if (!defined('MODULE_FILE')) die ("You can't access this file directly...");

if (!defined('CNBYA')) die('CNBYA protection');

$result  = $db->sql_query("SELECT * FROM ".$user_prefix."_users WHERE username='$username'");
$num     = $db->sql_numrows($result);
$usrinfo = $db->sql_fetchrow($result);

$result = $db->sql_query("SELECT * FROM ".$user_prefix."_cnbya_field");

while ($sqlvalue = $db->sql_fetchrow($result)):
  list($value) = $db->sql_fetchrow( $db->sql_query("SELECT value FROM ".$user_prefix."_cnbya_value WHERE fid ='$sqlvalue[fid]' AND uid = '$usrinfo[user_id]'"));
  $usrinfo[$sqlvalue[name]] = $value;
endwhile;

global $cookie;
include_once(NUKE_BASE_DIR.'header.php');

if ($num > 0): 

    if ($usrinfo[user_level] > 0): 
	
        OpenTable();
    
	    echo "<div align=\"center\">";
    
	    if ((strtolower($usrinfo['username']) == strtolower($cookie[1])) AND ($usrinfo['user_password'] == $cookie[2])):
            echo "<span class=\"option\">$username, "._WELCOMETO." $sitename!</span><br /><br />";
            echo "<span class=\"content\">"._THISISYOURPAGE."</span></div><br />";
            nav(1);
            echo "<br />";
        else:
            # Mod: Advanced Username Color v1.0.5 START 
            echo "<span class=\"title\">"._PERSONALINFO.": ".UsernameColor($usrinfo['username'])."</span></div><br />";
            # Mod: Advanced Username Color v1.0.5 END
        endif;
		
        if($num == 1): 
		
            echo "<div align=\"center\">\n";
            echo "<table bgcolor='$bgcolor4' border='0' cellpadding='2' cellspacing='1' class='content' width='60%'>\n";
            echo "<tr>\n<td align='center' bgcolor='$bgcolor2' class='title' colspan='2' width='100%'>";
        
		    # AVATAR TYPES START
			if ($usrinfo['user_avatar_type'] == 1):     # Type 1
            $user_avatar = $board_config['avatar_path']."/".$usrinfo['user_avatar'];
            
			elseif($usrinfo['user_avatar_type'] == 2):  # Type 2
            echo "<img class=\"rounded-corners-last-vistors\" src='$usrinfo[user_avatar]'>";
            
			elseif(empty($usrinfo['user_avatar'])):     # Type 3
            echo "<img class=\"rounded-corners-last-vistors\" src='".$board_config['avatar_gallery_path']."/gallery/blank.png'>";
            
			
			else:
            echo "<img class=\"rounded-corners-last-vistors\" src='".$board_config['avatar_gallery_path']."/".$usrinfo[user_avatar]."'>";
            endif;
            # AVATAR TYPES END
			
		    echo "</td>\n</tr>\n";
        
		    $usrinfo['user_website'] = strtolower($usrinfo['user_website']);
            $usrinfo['user_website'] = str_replace("https://", "", $usrinfo['user_website']);
        
		    if (empty($usrinfo['user_website'])) 
            $userwebsite = _YA_NA;
			else 
            $userwebsite = "<a href=\"https://$usrinfo[user_website]\" target=\"new\">$usrinfo[user_website]</a>";
            
			if (is_mod_admin($module_name) || $usrinfo['user_viewemail'] == 1) 
            $user_email = "<a href='mailto:$usrinfo[user_email]'>$usrinfo[user_email]</a>";
			else 
            $user_email = _YA_NA;
            
			$usrinfo['user_sig'] = nl2br($usrinfo['user_sig']);
            $usrinfo['user_bio'] = nl2br($usrinfo['user_bio']);
            $usrinfo['user_lastvisit'] = date("D M j H:i:s T Y", $usrinfo['user_lastvisit']);
            
			# Mod: Advanced Username Color v1.0.5 START 
            echo "<tr>\n<td width='30%' bgcolor='$bgcolor1'>"._USERNAME."</td>\n<td width='70%' bgcolor='$bgcolor1'><strong>".UsernameColor($usrinfo['username'])."</strong></td>\n</tr>\n";
            # Mod: Advanced Username Color v1.0.5 END
			 
            echo "<tr>\n<td width='30%' bgcolor='$bgcolor1'>"._REALNAME."</td>\n<td width='70%' bgcolor='$bgcolor1'><strong>$usrinfo[name]</strong></td>\n</tr>\n";
            echo "<tr>\n<td width='30%' bgcolor='$bgcolor1'>"._EMAIL."</td>\n<td width='70%' bgcolor='$bgcolor1'><strong>$user_email</strong></td>\n</tr>\n";
            echo "<tr>\n<td width='30%' bgcolor='$bgcolor1'>"._WEBSITE."</td>\n<td width='70%' bgcolor='$bgcolor1'><strong>$userwebsite</strong></td>\n</tr>\n";

            if(is_mod_admin($module_name) OR is_user() AND $usrinfo['username'] == $username) 
            $result = $db->sql_query("SELECT * FROM ".$user_prefix."_cnbya_field WHERE need <> '0' ORDER BY pos");
			else 
			$result = $db->sql_query("SELECT * FROM ".$user_prefix."_cnbya_field WHERE need <> '0' AND public='1' ORDER BY pos");

            while ($sqlvalue = $db->sql_fetchrow($result)): 
     
	         if (substr($sqlvalue['name'],0,1)=='_') 
			 eval( "\$name_exit = $sqlvalue[name];"); 
			 else $name_exit = $sqlvalue['name'];
             echo "<tr><td width='30%' bgcolor='$bgcolor1'>$name_exit</td><td width='70%' bgcolor='$bgcolor1'>".$usrinfo[$sqlvalue['name']]."</td></tr>\n";
     
	        endwhile;

            echo "<tr>\n<td width='30%' bgcolor='$bgcolor1'>"._LOCATION."</td>\n<td width='70%' bgcolor='$bgcolor1'><strong>$usrinfo[user_from]</strong></td>\n</tr>\n";
            echo "<tr>\n<td width='30%' bgcolor='$bgcolor1'>"._REGDATE."</td>\n<td width='70%' bgcolor='$bgcolor1'><strong>$usrinfo[user_regdate]</strong></td>\n</tr>\n";
            echo "<tr>\n<td width='30%' bgcolor='$bgcolor1'>"._OCCUPATION."</td>\n<td width='70%' bgcolor='$bgcolor1'><strong>$usrinfo[user_occ]</strong></td>\n</tr>\n";
            echo "<tr>\n<td width='30%' bgcolor='$bgcolor1'>"._INTERESTS."</td>\n<td width='70%' bgcolor='$bgcolor1'><strong>$usrinfo[user_interests]</strong></td>\n</tr>\n";
            echo "<tr>\n<td width='30%' bgcolor='$bgcolor1'>"._SIGNATURE."</td>\n<td width='70%' bgcolor='$bgcolor1'><strong>$usrinfo[user_sig]</strong></td>\n</tr>\n";
            echo "<tr>\n<td width='30%' bgcolor='$bgcolor1'>"._EXTRAINFO."</td>\n<td width='70%' bgcolor='$bgcolor1'><strong>$usrinfo[bio]</strong></td>\n</tr>\n";
            echo "<tr>\n<td width='30%' bgcolor='$bgcolor1'>"._YA_LASTVISIT."</td>\n<td width='70%' bgcolor='$bgcolor1'><strong>$usrinfo[user_lastvisit]</strong></td>\n</tr>\n";
            
			$sql2 = "SELECT uname FROM ".$prefix."_session WHERE uname='$username'";
            $result2 = $db->sql_query($sql2);
            $row2 = $db->sql_fetchrow($result2);
            $username_pm = $username;
            $active_username = $row2[uname]; // Edited PSL 12-9-04 was killing $username
            
			if (empty($active_username)) 
		    $online = _OFFLINE; 
			else 
			$online = _ONLINE; 
            
			echo "<tr>\n<td width='30%' bgcolor='$bgcolor1'>"._USERSTATUS."</td>\n<td width='70%' bgcolor='$bgcolor1'><strong>$online</strong></td>\n</tr>\n";
            
			if ($Version_Num > 6.9): 
                if (is_user() AND $cookie[1] == "$username" OR is_mod_admin($module_name)) 
                    echo "<tr>\n<td width='30%' bgcolor='$bgcolor1'>"._YA_POINTS."</td>\n<td width='70%' bgcolor='$bgcolor1'><strong>$usrinfo[points]</strong></td>\n</tr>\n";
            endif;
            
			if (($usrinfo['newsletter'] == 1) 
			AND ($username == $cookie[1]) 
			AND ($usrinfo['user_password'] == $cookie[2]) 
			OR (is_mod_admin($module_name) 
			AND ($usrinfo['newsletter'] == 1))): 
			
                echo "<tr>\n<td width='30%' bgcolor='$bgcolor1'>"._NEWSLETTER."</td>\n<td width='70%' bgcolor='$bgcolor1'><strong>"._SUBSCRIBED."</strong></td>\n</tr>\n";
             
			elseif (($usrinfo['newsletter'] == 0) 
			AND ($username == $cookie[1]) 
			AND ($usrinfo['user_password'] == $cookie[2]) 
			OR (is_mod_admin($module_name) 
			AND ($usrinfo['newsletter'] == 0))): 
			
                echo "<tr>\n<td width='30%' bgcolor='$bgcolor1'>"._NEWSLETTER."</td>\n<td width='70%' bgcolor='$bgcolor1'><strong>"._NOTSUBSCRIBED."</strong></td>\n</tr>\n";
    
	        endif;
            
			echo "</table>\n";
            echo "</div><br />\n<div align=\"center\">\n";
            
			if (is_active("Journal") AND $cookie[1] != $username):  
			
                $sql3 = "SELECT jid FROM ".$prefix."_journal WHERE aid='$username' AND status='yes' ORDER BY pdate,jid DESC LIMIT 0,1";
                $result3 = $db->sql_query($sq3);
                $row3 = $db->sql_fetchrow($result3);
                $jid = $row3[jid];
            
			    if (!empty($jid) AND isset($jid)) 
                echo "[ <a href=\"modules.php?name=Journal&amp;file=search&amp;bywhat=aid&amp;forwhat=$username\">"._READMYJOURNAL."</a> ]<br />";
            
			endif;
            
			if (is_mod_admin($module_name)): 
            
                if ($usrinfo['last_ip'] != 0): 
				
                echo "<div align=\"center\">"._LASTIP." <strong>$usrinfo[last_ip]</strong><br />";
                # Base: NukeSentinel v2.5.00      START
                # Mod: CNBYA Modifications v1.0.0 START
                echo "[ <a href='".$admin_file.".php?
				op=ABBlockedIPAdd&amp;tip=".$usrinfo['last_ip']."'>"._BANTHIS."</a> | <a 
				href=\"modules.php?name=$module_name&amp;file=admin&amp;op=modifyUser&amp;chng_uid=".$usrinfo['username']."\">"._EDITUSER."</a> ]</div>";
                # Base: NukeSentinel v2.5.00      END
                # Mod: CNBYA Modifications v1.0.0 END
                endif;
				
                echo "[ <a href=\"modules.php?name=$module_name&amp;file=admin&amp;op=modifyUser&amp;chng_uid=$usrinfo[user_id]\">"._EDITUSER."</a> ] ";
                echo "[ <a href=\"modules.php?name=$module_name&amp;file=admin&amp;op=suspendUser&amp;chng_uid=$usrinfo[user_id]\">"._SUSPENDUSER."</a> ] ";
                echo "[ <a href=\"modules.php?name=$module_name&amp;file=admin&amp;op=deleteUser&amp;chng_uid=$usrinfo[user_id]\">"._DELETEUSER."</a> ]<br />";
            
			endif;
            
			if (((is_user() AND $cookie[1] != $username) 
			OR is_mod_admin($module_name)) 
			AND is_active("Private_Messages")): 
			  echo "<br />[ <a href=\"modules.php?name=Private_Messages&amp;mode=post&amp;u=$usrinfo[user_id]\">"._USENDPRIVATEMSG." $usrinfo[username]</a> ]<br />\n"; 
			endif;
			echo "</div></span>";
         
		else: 
            echo "<div align=\"center\">"._NOINFOFOR." $username</div>";
        endif; # end if num = 1
        
		CloseTable();

        $incsdir = dir("modules/$module_name/includes");
        
		while($func=$incsdir->read()):

         if(substr($func, 0, 3) == "ui-") 
         $incslist .= "$func ";

        endwhile;
        
		closedir($incsdir->handle);
        $incslist = explode(" ", $incslist);
        sort($incslist);
        
		for($i=0; $i < count($incslist); $i++):
            if($incslist[$i]!=""):
                $counter = 0;
                include($incsdir->path."/$incslist[$i]");
            endif;
        endfor;
     
	else: 
	
        OpenTable();
        echo "<div align=\"center\"><strong>"._NOINFOFOR." <i>".$usrinfo['username']."</i></strong></div>";
        
		if($usrinfo[user_level] == 0) 
	    echo "<br /><div align=\"center\"><strong>"._ACCSUSPENDED."</strong></div>"; 
        
		if($usrinfo[user_level] == -1) 
		echo "<br /><div align=\"center\"><strong>"._ACCDELETED."</strong></div>"; 
		CloseTable();
    
	endif;
 
else: 

    OpenTable();
    echo "<div align=\"center\"><strong>"._NOINFOFOR." <i>".$usrinfo['username']."</i></strong></div>";
    echo "<br /><div align=\"center\"><strong>"._YA_ACCNOFIND."</strong></div>";
    CloseTable();

endif;

include_once(NUKE_BASE_DIR.'footer.php');
?>
