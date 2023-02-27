<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

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

/*********************************************************/
/* Coded by Richard van Oosterhout, the Netherlands      */
/* https://menelaos.hetnet.nl (site no longer exists)    */
/* based on MyCookies Manager by A_Jelly_Doughnut        */
/* and work by Josh Pettit of UBB.Threads                */
/*********************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
	  PHP 8.1 Patched                          v4.0.3       12/14/2022
-=[Last Updated]=-
      12/14/2022 1:10 am Ernest Allen Buffington	  
 ************************************************************************/

if((!defined('MODULE_FILE')) AND (!defined('ADMIN_FILE'))): 
  die ('Access Denied');
endif;

if(!defined('CNBYA')): 
  die('CNBYA protection');
endif;

$module_name = basename (dirname(dirname (__FILE__)) );

global $currentlang, $language;

if(file_exists(NUKE_MODULES_DIR.$module_name.'/language/lang-'.$currentlang.'.php')):
  include_once(NUKE_MODULES_DIR.$module_name.'/language/lang-'.$currentlang.'.php');
elseif(file_exists(NUKE_MODULES_DIR.$module_name.'/language/lang-'.$language.'.php')):
  include_once(NUKE_MODULES_DIR.$module_name.'/language/lang-'.$language.'.php');
elseif(file_exists(NUKE_MODULES_DIR.$module_name.'/language/lang-english.php')):
  include_once(NUKE_MODULES_DIR.$module_name.'/language/lang-english.php');
endif; 

# function yacookiecheck()
function yacookiecheck()
{
  global $ya_config;
  setcookie("CNB_test1","value1"); 
  setcookie("CNB_test2","value2",time()+3600); 
  setcookie("CNB_test3","value3",time()+3600,"/"); 
  setcookie("CNB_test4","value4",time()+3600,"$ya_config[cookiepath]"); 
}

# function yacookiecheckresults()
function yacookiecheckresults()
{
  global $ya_config,$module_name;
  $cookiedebug = "0";        // cookiedebug: set this to '1' if you want additional debug info

  if (($_COOKIE ['CNB_test3'] != "value3") OR ($cookiedebug == "1"))
  {
    include_once(NUKE_BASE_DIR.'header.php');
    Show_CNBYA_menu();
    OpenTable();
  }
      $debugcookie = "<table width=\"100%\" cellspacing=\"10\" cellpadding=\"0\" border=\"0\" align=\"center\">";
      if($_COOKIE ['CNB_test1'] == "value1")
        {$debugcookie .= "<tr><td>1: setcookie('CNB_test1','value1';)";
         $debugcookie .= "</td><td><font color=\"#009933\"><strong>"._YA_COOKIEOK."</strong></font></td></tr>"; }
      else    {$debugcookie .= "<tr><td>1: setcookie('CNB_test1','value1';)";
         $debugcookie .= "</td><td><font color=\"#FF3333\"><strong>"._YA_COOKIEFAIL."</strong></font></td></tr>"; }
      if($_COOKIE ['CNB_test2'] == "value2")
        {$debugcookie .= "<tr><td>2: setcookie('CNB_test2','value2',time()+120)";
         $debugcookie .= "</td><td><font color=\"#009933\"><strong>"._YA_COOKIEOK."</strong></font></td></tr>"; }
      else    {$debugcookie .= "<tr><td>2: setcookie('CNB_test2','value2',time()+120)";
         $debugcookie .= "</td><td><font color=\"#FF3333\"><strong>"._YA_COOKIEFAIL."</strong></font></td></tr>"; }
      if($_COOKIE ['CNB_test3'] == "value3") 
        {$debugcookie .= "<tr><td>3: setcookie('CNB_test3','value3',time()+120,'/')";
         $debugcookie .= "</td><td><font color=\"#009933\"><strong>"._YA_COOKIEOK."</strong></font></td></tr>"; }
      else    {$debugcookie .= "<tr><td>3: setcookie('CNB_test3','value3',time()+120,'/')";
         $debugcookie .= "</td><td><font color=\"#FF3333\"><strong>"._YA_COOKIEFAIL."</strong></font></td></tr>"; }
      if($_COOKIE ['CNB_test4'] == "value4")
        {$debugcookie .= "<tr><td>4: setcookie('CNB_test4','value4',time()+120,'$ya_config[cookiepath]')";
         $debugcookie .= "</td><td><font color=\"#009933\"><strong>"._YA_COOKIEOK."</strong></font></td></tr>"; }
      else    {$debugcookie .= "<tr><td>4: setcookie('CNB_test4','value4',time()+120,'$ya_config[cookiepath]')";
         $debugcookie .= "</td><td><font color=\"#FF3333\"><strong>"._YA_COOKIEFAIL."</strong></font></td></tr>"; }
    $debugcookie .= "</td></tr></table>";

    if ($_COOKIE ['CNB_test3'] != "value3") 
	{
        echo "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"5\" border=\"0\"><tr>";
        echo "<td colspan=\"2\"><img src=\"modules/$module_name/images/warning.png\" align=\"left\" width=\"40\" height=\"40\">";
        echo "<font color=\"#FF3333\"><strong>"._YA_COOKIENO."</strong></font>";
        echo "</td></tr><tr><td valign=\"top\">";
        if ($cookiedebug == "1") {OpenTable();echo $debugcookie;CloseTable();}
        // In a next devellopment stage we will give users some tips on how to enable cookies in their browser
        // echo "We will give you some ideas on how to solve this.<br /><br />";
        // echo "If you use Internet Explorer, click here<br />";
        // echo "If you use Mozilla, click here<br />";
        // echo "If you use Opera, click here<br />";
        // echo "If you use Netscape, click here<br />";
        echo "</td></tr></table>";
    } 
    else 
	if ($cookiedebug == "1")
    {    echo "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"5\" border=\"0\"><tr>";
        echo "<td colspan=\"2\"><img src=\"modules/$module_name/images/warning.png\" align=\"left\" width=\"40\" height=\"40\">";
        echo "<font color=\"#009933\"><strong>"._YA_COOKIEYES."</strong></font>";
        echo "</td></tr><tr><td valign=\"top\">";
        if ($cookiedebug == "1") {OpenTable();echo $debugcookie;CloseTable();}
        echo "</td><tr><form action=\"modules.php?name=$module_name\" method=\"post\">";
        echo "<td align=\"right\"><input type=\"submit\" name=\"submit\" value='"._YA_CONTINUE."'></td></form></tr></table>";
    }
     
	 setcookie("CNB_test1","expired1",time()-604800,"");
     setcookie("CNB_test2","expired2",time()-604800,"");
     setcookie("CNB_test3","expired3",time()-604800,"/");
     setcookie("CNB_test4","expired4",time()-604800,"$ya_config[cookiepath]");

     if (($_COOKIE ['CNB_test3'] != "value3") OR  ($cookiedebug == "1"))
	 {
   
      CloseTable();
      echo "<br />";
      include_once(NUKE_BASE_DIR.'footer.php');}
}
/*************************************************************************************/
// function ShowCookiesRedirect()
/*************************************************************************************/
function ShowCookiesRedirect() 
{
  global $ya_config,$module_name;

  setcookie("CNB_test1","1",time()-604800,"");
  setcookie("CNB_test2","2",time()-604800,"");
  setcookie("CNB_test3","3",time()-604800,"/");
  setcookie("CNB_test4","4",time()-604800,"$ya_config[cookiepath]");

  redirect("modules.php?name=$module_name&op=ShowCookies");
}

/*************************************************************************************/
// function ShowCookies()
/*************************************************************************************/
function ShowCookies() 
{
  global $ya_config,$module_name,$prefix,$user,$username,$CookieArray,$cookie;
  include_once(NUKE_BASE_DIR.'header.php');

  OpenTable();

    $CookieArray = $_COOKIE;

	if(isset($cookie[0]))
    $r_uid = $cookie[0];
	else
	$r_uid = '1';
	
	if(isset($cookie[1]))
    $r_username = $cookie[1];
	else
    $r_username = 'Anonymous';
	
    echo "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"5\" border=\"0\"><tr>";
    echo "<form action=\"modules.php?name=$module_name&amp;op=DeleteCookies\" method=\"post\">";
    echo "<td style=\"padding-bottom: 0px;\" colspan=\"2\">";
    
	global $fieldset_border_width;

	echo '<fieldset style="border-color: gold; border-width: '.$fieldset_border_width.'; border-style: solid;">';
    echo '<legend align="left" id="Legend5" runat="server" visible="true" style="width:auto; margin: 0px; font-weight: bold;"><img 
	src="modules/'.$module_name.'/images/warning.png" align="left" width="20" height="20"></strong>&nbsp;<span style="color: red">'.$r_username.'\'s Cookies</span>&nbsp;</legend>';
	
	echo "<span class=\"content\">"._YA_DELCOOKIEINFO1."</span></td></tr><tr><td width=\"100%\"></fieldset>";

    echo "<br /><table cellspacing=\"0\" cellpadding=\"5\" border=\"1\" align=\"left\"><tr><td colspan=\"2\">";

    echo "<tr><td nowrap=\"nowrap\"><strong>"._YA_COOKIENAME."</strong></td><td width=\"100%\"><strong>"._YA_COOKIEVAL."</strong></td></tr>";
    
	if (is_array($CookieArray) && !empty($CookieArray)) 
	{
		foreach ($CookieArray as $cName => $cValue) 
		{
            $cName = str_replace(" ","",$cName); 
            
			if (empty($cValue)) $cValue = "(empty)";
            
			$cMore = substr("$cValue", 0, 37)." <span style=\"color: white;\">...✂</span>";

            if (!empty($cMore)) 
            $cValue = substr("$cValue", 0, 37)." <span style=\"color: white;\">...✂</span>";
            
			if($cName === 'PHPSESSID')
			echo "<tr><td align=\"left\" nowrap=\"nowrap\"><span style=\"color:crimson;\">$cName</span>&nbsp;&nbsp;&nbsp;</td><td width=\"100%\" align=\"left\"><span style=\"color:yellow;\">🍪 $cValue</span></td></tr>";
			else
			echo "<tr><td align=\"left\" nowrap=\"nowrap\"><span style=\"color:lime;\">$cName</span>&nbsp;&nbsp;&nbsp;</td><td width=\"100%\" align=\"left\"><span style=\"color:yellow;\">🍪 $cValue</span></td></tr>";
        }
            
			echo "</table></td><td valign=\"bottom\"><input type=\"submit\" name=\"submit\" value='"._YA_COOKIEDELTHESE."'></td></form></tr></table></fieldset>";
	}
    else 
	{
      echo "<tr><td colspan=\"2\">"._YA_COOKIENOCUR1."</td></tr></table>";
      echo "</td><td valign=\"top\"><input type=\"submit\" name=\"submit\" value='"._YA_COOKIEDELALL."'></td></form></tr></table>";
    }
    
	CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
    $CookieArray = "";
}
/*************************************************************************************/
// function DeleteCookies()
/*************************************************************************************/
function DeleteCookies() {
global $ya_config,$module_name,$prefix,$user,$username,$CookieArray,$cookie;
include_once(NUKE_BASE_DIR.'header.php');
OpenTable();
    
	if(isset($cookie[0]))
    $r_uid = $cookie[0];
	else
	$r_uid = '1';
	
	if(isset($cookie[1]))
    $r_username = $cookie[1];
	else
    $r_username = 'Anonymous';

    $CookieArray = $_COOKIE;
	
	if(isset($r_username)):
      $db->sql_query("DELETE FROM ".$prefix."_session WHERE uname='$r_username'");
      $db->sql_query("OPTIMIZE TABLE ".$prefix."_session");
    endif;
    
	echo "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"5\" border=\"0\"><tr>";
    echo "<form action=\"modules.php?name=$module_name&amp;op=ShowCookies\" method=\"post\">";
    echo "<td colspan=\"2\"><img src=\"modules/$module_name/images/warning.png\" align=\"left\" width=\"40\" height=\"40\">";
  
    echo "<span class=\"content\">"._YA_COOKIEDEL1."</td></tr><tr><td  width=\"100%\">";

    echo "<table cellspacing=\"0\" cellpadding=\"5\" border=\"1\" align=\"left\"><tr><td colspan=\"2\">";
    echo "<span class=\"title\">"._YA_CURRENTCOOKIE."</span></td></tr>";
    echo "<tr><td nowrap=\"nowrap\"><strong>"._YA_COOKIENAME."</strong></td><td width=\"100%\"><strong>"._YA_COOKIESTAT."</strong></td></tr>";

    if (is_array($CookieArray) && !empty($CookieArray)) {

		foreach ($CookieArray as $cName => $cValue)
		{	
            $cName = str_replace(" ","",$cName);
            // Multiple cookie paths used to expire cookies that are no longer in use as well.
            setcookie("$cName","1",time()-604800,"");                          // Directory only path
            setcookie("$cName","2",time()-604800,"/");                         // Site wide path
            setcookie("$cName","3",time()-604800,"$ya_config[cookiepath]");    // Configured path

            echo "<tr><td align=\"left\" nowrap=\"nowrap\">$cName</td><td width=\"100%\" align=\"left\">"._YA_COOKIEDEL2."</td></tr>";
            unset($cName);
        }
    echo "</table><td valign=\"top\"><input type=\"submit\" name=\"submit\" value='"._YA_COOKIESHOWALL."'></td></form></tr></table>";
    }
    else {
    echo "<tr><td width=\"100%\" colspan=\"2\">"._YA_COOKIENOCUR2."</td></tr></table>";
    echo "</td><td valign=\"top\"><input type=\"submit\" name=\"submit\" value='"._YA_COOKIESHOWALL."'></td></form></tr></table>";
    }

unset($user);
unset($cookie);

$user="";

if(isset($_SESSION)):
  session_unset();
endif;

if(isset($_SESSION)):
  session_destroy();
endif; 

if(isset($_COOKIE[session_name()])):
  unset($_COOKIE[session_name()]);
endif;
# menelaos: these lines need some more study: which are usefull, which are not

CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');
}
