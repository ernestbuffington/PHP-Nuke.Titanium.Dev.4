<?php
/*=======================================================================
 PHP-Nuke Titanium : Nuke-Evolution | Enhanced and Advnanced
 =======================================================================*/

/************************************************************************
   Nuke-Evolution    : Server Info Administration
   PHP-Nuke Titanium : Server Info Administration
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team
   Copyright (c) 2022 by The PHP-Nuke Titanium Group

   Filename      : avatar.php
   Author(s)     : Ernest Allen Buffington, Technocrat
   Version       : 4.0.3
   Date          : 05.19.2005 (mm.dd.yyyy)
   Last Update   : 12.12.2022 (mm.dd.yyyy)
   
   Notes         : User Block Login Module
************************************************************************/

if(!defined('NUKE_EVO')): 
  exit("Illegal File Access");
endif;

global $evouserinfo_login, $lang_evo_userblock, $appID;

function evouserinfo_login () 
{
   global $lang_evo_userblock, $evouserinfo_login;
   
    //mt_srand ((double)microtime()*1000000);
	mt_srand(0, MT_RAND_MT19937);
    $maxran = 1000000;
    $random_num = mt_rand(0, $maxran);
	
    $evouserinfo_login  = "<form action=\"modules.php?name=Your_Account\" method=\"post\">\n";
    $evouserinfo_login .= "<table border=\"0\" style=\"margin: auto\">";
    $evouserinfo_login .= "<tr><td>\n";
    $evouserinfo_login .= "<i class=\"fa fa-angle-double-right fa-right-arrows\" aria-hidden=\"true\"></i>&nbsp;";
    $evouserinfo_login .= "<a href=\"modules.php?name=Your_Account&amp;op=new_user\">".$lang_evo_userblock['BLOCK']['LOGIN']['REG']."</a><br />\n";
    $evouserinfo_login .= "<i class=\"fa fa-angle-double-right fa-right-arrows\" aria-hidden=\"true\"></i>&nbsp;";
    $evouserinfo_login .= "<a href=\"modules.php?name=Your_Account&amp;op=pass_lost\">".$lang_evo_userblock['BLOCK']['LOGIN']['LOST']."</a>\n";
    $evouserinfo_login .= "</td></tr>\n<tr><td align=\"center\">\n";
    
    # Login
    $evouserinfo_login .= $lang_evo_userblock['BLOCK']['LOGIN']['USERNAME']."<br /><input class=\"evo-login-username-field\" 
	type=\"text\" name=\"username\" size=\"15\" maxlength=\"25\"></td></tr>\n";
    
	$evouserinfo_login .= "<tr><td align=\"center\">".$lang_evo_userblock['BLOCK']['LOGIN']['PASSWORD']."<br /><input 
	class=\"evo-login-password-field\" type=\"password\" name=\"user_password\" size=\"15\" maxlength=\"20\" autocomplete=\"on\">\n";
    
    # Mod: Advanced Security Code Control v1.0.0 START
    $gfxchk = array(2,4,5,7);
    $evouserinfo_login .= security_code($gfxchk, 'compact', '1'); //Size - compact || normal  //Scale Adjustment - 0.90 = 90% scaledown.
    # Mod: Advanced Security Code Control v1.0.0 END
    
	$evouserinfo_login .= "</td><td align=\"center\">";
    
	if(!empty($redirect)):
       $evouserinfo_login .= "<input type=\"hidden\" name=\"redirect\" value=\"$redirect\">\n";
    endif;
	
    if(!empty($mode)):
       $evouserinfo_login .= "<input type=\"hidden\" name=\"mode\" value=\"$mode\">\n";
    endif;
	
    if(!empty($f)):
       $evouserinfo_login .= "<input type=\"hidden\" name=\"f\" value=\"$f\">\n";
    endif;
	
    if(!empty($t)):
       $evouserinfo_login .= "<input type=\"hidden\" name=\"t\" value=\"$t\">\n";
    endif;
	
    $evouserinfo_login .= "<input type=\"hidden\" name=\"op\" value=\"login\"></td></tr>\n";
    $evouserinfo_login .= "<tr><td align=\"center\"><input class=\"titaniumbutton evo-login-submit\" type=\"submit\" value=\"".$lang_evo_userblock['BLOCK']['LOGIN']['LOGIN']."\"></td></tr></table></form>\n";
}

if (!is_user()) 
{
    evouserinfo_login();
} 
else 
{
	global $userinfo, $bgcolor1, $bgcolor2;

    $icon1 = "<i style=\"font-size: 17px; color: #3498DB\" onMouseOver=\"this.style.color='#ECAB53'\" onMouseOut=\"this.style.color='#3498DB'\" class=\"fa fa-upload\"></i>";
    $link1 = " <a class=\"modules\" href=\"modules.php?name=Image_Repository\" target=\"_self\"> ".$icon1." My Hosted Images</a>";
    $evouserinfo_login .= '<div style="padding-left: 10px;">';
	$evouserinfo_login .= $link1."";
	$evouserinfo_login .= '</div>';

    $icon2 = " <i style=\"font-size: 18px; color: #FF0000\" onMouseOver=\"this.style.color='#ECAB53'\" onMouseOut=\"this.style.color='#FF0000'\" class=\"fa fa-bookmark\"></i>";
    $link2 = " <a class=\"modules\" href=\"modules.php?name=Bookmarks\" target=\"_self\"> ".$icon2." My Book Mark Vault</a>";
    $evouserinfo_login .= '<div style="padding-left: 13px;">';
	$evouserinfo_login .= $link2."";
	$evouserinfo_login .= '</div>';

    $icon3 = "<i style=\"font-size: 17px; color: #45B39D\" onMouseOver=\"this.style.color='#ECAB53'\" onMouseOut=\"this.style.color='#45B39D'\" class=\"fa fa-cog\"></i>";
    $link3 = " <a class=\"modules\" href=\"modules.php?name=Your_Account&op=chgtheme\" target=\"_self\"> ".$icon3." My Theme</a>";
    $evouserinfo_login .= '<div style="padding-left: 10px;">';
	$evouserinfo_login .= $link3."";
	$evouserinfo_login .= '</div>';


    $icon4 = "<i style=\"font-size: 18px; color: gold\" onMouseOver=\"this.style.color='#ECAB53'\" onMouseOut=\"this.style.color='gold'\" class=\"fa fa-id-badge\"></i>";
    $link4 = " <a class=\"modules\" href=\"modules.php?name=Profile&mode=viewprofile&u=".$userinfo['user_id']."\" target=\"_self\"> ".$icon4." My Profile</a>";
    $evouserinfo_login .= '<div style="padding-left: 13px;">';
	$evouserinfo_login .= $link4."";
	$evouserinfo_login .= '</div>';

    $icon5 = "<i style=\"font-size: 17px; color: gold\" onMouseOver=\"this.style.color='#ECAB53'\" onMouseOut=\"this.style.color='gold'\" class=\"fa fa-bars\"></i>";
    $link5 = " <a class=\"modules\" href=\"modules.php?name=Profile\" target=\"_self\"> ".$icon5." Edit Profile</a>";
    $evouserinfo_login .= '<div style="padding-left: 12px;">';
	$evouserinfo_login .= $link5."";
	$evouserinfo_login .= '</div>';

    $icon6 = "<i style=\"font-size: 17px; color: orange\" onMouseOver=\"this.style.color='#ECAB53'\" onMouseOut=\"this.style.color='orange'\" class=\"fa fa-sign-out\"></i>";
    $link6 = " <a class=\"modules\" href=\"modules.php?name=Your_Account&op=logout\" target=\"_self\"> ".$icon6." Log Out</a>";
    $evouserinfo_login .= '<div style="padding-left: 12px;">';
	$evouserinfo_login .= $link6."";
	$evouserinfo_login .= '</div>';

    $icon7 = "<i style=\"font-size: 17px; color: red\" onMouseOver=\"this.style.color='#ECAB53'\" onMouseOut=\"this.style.color='red'\" class=\"fa fa-trash\"></i>";
    $link7 = " <a class=\"modules\" href=\"modules.php?name=Your_Account&op=delete\" target=\"_self\"> ".$icon7." Deactivate Account</a>";
    $evouserinfo_login .= '<div style="padding-left: 12px;">';
	$evouserinfo_login .= $link7."";
	$evouserinfo_login .= '</div>';

    $icon8 = "<i style=\"font-size: 16px; color: tan\" onMouseOver=\"this.style.color='#ECAB53'\" onMouseOut=\"this.style.color='tan'\" class=\"fas fa-cookie\"></i>";
    $link8 = " <a class=\"modules\" href=\"modules.php?name=Your_Account&op=ShowCookiesRedirect\" target=\"_self\"> ".$icon8." View My Cookies</a>";
    $evouserinfo_login .= '<div style="padding-left: 11px;">';
	$evouserinfo_login .= $link8."";
	$evouserinfo_login .= '</div>';
}

?>
