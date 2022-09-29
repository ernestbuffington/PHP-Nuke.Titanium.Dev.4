<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Network Advertising Module v1.0                                      */
/* Copyright (c) 2020 by Ernest Buffington                              */
/* http://www.86it.us                                                   */
/* The 86it Developers Network                                          */
/*                                                                      */
/* Copyright (c) 2005 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* Google Page Rank Calculation                                         */
/* Copyright 2004 by GoogleCommunity.com                                */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

// This system includes Google Page Rank Calculation made by GoogleCommunity.com
// Don't abuse this script. It's here for your use, to give accurate information
// about your site to your potential advertising customers. If you need the complete
// Google Page Rank Calculator script, please go to: http://www.GoogleCommunity.com
// and download the latest and stand alone release.

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       08/06/2005
 ************************************************************************/

if (!defined('MODULE_FILE')) {
    die('You can\'t access this file directly...');
}

$titanium_module_name = basename(dirname(__FILE__));
get_lang($titanium_module_name);

function is_ad_client($network_ad_client) 
{
    global $network_prefix, $titanium_db2;
    static $ClientSave;

    if(isset($ClientSave)) 
	return $ClientSave;
    
	if(!is_array($network_ad_client)) 
	{
        $network_ad_client = base64_decode($network_ad_client);
        $network_ad_client = addslashes($network_ad_client);
        $network_ad_client = explode(":", $network_ad_client);
        $cid = $network_ad_client[0];
        if (isset($network_ad_client[2])) { $pwd = $network_ad_client[2]; }
    } 
	else 
	{
        $cid = $network_ad_client[0];
        if (isset($network_ad_client[2])) { $pwd = $network_ad_client[2]; }
    }
    
	if (!empty($cid) AND !empty($pwd)) 
	{
        list($pass) = $titanium_db2->sql_ufetchrow("SELECT passwd FROM ".$network_prefix."_banner_clients WHERE cid='$cid'");
        
		if(!empty($pass) AND $pass == $pwd) 
		{
            return $ClientSave = 1;
        }
    }
    return $ClientSave = 0;
}

function the_network_menu() 
{
    global $titanium_module_name, $network_prefix, $titanium_db2, $network_ad_client, $op;

    if (is_ad_client($network_ad_client)) 
	{
        if ($op == "network_client_home") 
		{
            $ad_client_opt = "My Network Ads";
        } 
		else 
		{
            $ad_client_opt = "<a class=\"titaniumbutton\" href=\"modules.php?name=$titanium_module_name&amp;op=network_client_home\">"._MYADS."</a>";
        }
    } 
	else 
	{
        $ad_client_opt = "<a class=\"titaniumbutton\" href=\"modules.php?name=$titanium_module_name&amp;op=network_ad_client\">"._CLIENTLOGIN."</a>";
    }
    
	OpenTable();
    echo "<div align=\"center\"><strong>"._ADSMENU."</strong><br /><br /><a class=\"titaniumbutton\" href=\"modules.php?name=$titanium_module_name\">"._MAINPAGE."</a> " . (is_active('Statistics') ? "<a  class=\"titaniumbutton\" href=\"modules.php?name=Statistics\">"._SITESTATS."</a> " : "") . "<a  class=\"titaniumbutton\" href=\"modules.php?name=$titanium_module_name&amp;op=network_ad_terms\">"._TERMS."</a> <a  class=\"titaniumbutton\" href=\"modules.php?name=$titanium_module_name&amp;op=ad_plans\">"._PLANSPRICES."</a> $ad_client_opt</div>";
    CloseTable();
}

function theindex() {
    global $network_prefix, $titanium_db2, $sitename;

    include_once(NUKE_BASE_DIR.'header.php');
    title($sitename.' '._ADVERTISING);
    OpenTable();
    echo '<div align=\"center\">'._WELCOME_NETWORK_ADS.'</div>';
    CloseTable();
    the_network_menu();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function ad_plans() {
    global $titanium_module_name, $network_prefix, $titanium_db2, $bgcolor2, $sitename;

    include_once(NUKE_BASE_DIR.'header.php');
    title($sitename.': '._PLANSPRICES);
    OpenTable();
    $result = $titanium_db2->sql_query("SELECT * FROM ".$network_prefix."_banner_plans WHERE active='1'");
    if ($titanium_db2->sql_numrows($result) > 0) {
        echo ""._LISTPLANS."<br /><br />";
        echo "<table border=\"1\" width=\"100%\" cellpadding=\"3\">";
        echo "<tr><td align=\"center\" nowrap bgcolor=\"$bgcolor2\"><strong>"._PLANNAME."</strong></td><td bgcolor=\"$bgcolor2\">&nbsp;<strong>"._DESCRIPTION."</strong></td><td align=\"center\" bgcolor=\"$bgcolor2\"><strong>"._QUANTITY."</strong></td><td align=\"center\" bgcolor=\"$bgcolor2\"><strong>"._PRICE."</strong></td><td align=\"center\" bgcolor=\"$bgcolor2\" nowrap><strong>"._BUYLINKS."</strong></td></tr>";
        while ($row = $titanium_db2->sql_fetchrow($result)) {
            if ($row['delivery_type'] == "0") {
                $delivery = _IMPRESSIONS;
            } elseif ($row['delivery_type'] == "1") {
                $delivery = _CLICKS;
            } elseif ($row['delivery_type'] == "2") {
                $delivery = _DAYS;
            } elseif ($row['delivery_type'] == "3") {
                $delivery = _MONTHS;
            } elseif ($row['delivery_type'] == "4") {
                $delivery = _YEARS;
            }
            echo "<tr><td valign=\"top\"><strong>".$row['name']."</strong></td><td>".$row['description']."</td><td valign=\"bottom\"><center>".$row['delivery']."<br />$delivery</center></td><td valign=\"bottom\">".$row['price']."</td><td valign=\"bottom\" nowrap><center>".$row['buy_links']."</center></td></tr>";
        }
        $titanium_db2->sql_freeresult($result);
        echo "</table>";
    } else {
        echo "<center>"._ADSNOCONTENT."<br /><br />"._GOBACK."</center>";
    }
    CloseTable();
    the_network_menu();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function network_ad_terms() {
    global $titanium_module_name, $network_prefix, $titanium_db2, $sitename;

    $today = getdate();
    $month = $today['mon'];
    if ($month == 1) {$month = _JANUARY;} elseif ($month == 2) {$month = _FEBRUARY;} elseif ($month == 3) {$month = _MARCH;} elseif ($month == 4) {$month = _APRIL;} elseif ($month == 5) {$month = _MAY;} elseif ($month == 6) {$month = _JUNE;} elseif ($month == 7) {$month = _JULY;} elseif ($month == 8) {$month = _AUGUST;} elseif ($month == 9) {$month = _SEPTEMBER;} elseif ($month == 10) {$month = _OCTOBER;} elseif ($month == 11) {$month = _NOVEMBER;} elseif ($month == 12) {$month = _DECEMBER;}
    $year = $today['year'];
    include_once(NUKE_BASE_DIR.'header.php');
    title($sitename.': '._TERMSCONDITIONS);
    $row = $titanium_db2->sql_fetchrow($titanium_db2->sql_query("SELECT * FROM ".$network_prefix."_banner_terms"));
    $terms = str_replace("[sitename]", $sitename, $row['terms_body']);
    $terms = str_replace("[country]", $row['country'], $terms);
    $terms = decode_bb_all($terms, 1, true);
	OpenTable();
    echo "<center><span class='title'><strong>$sitename: "._TERMSCONDITIONS."</strong></span></center><br /><br />"
        ."$terms"
        ."<p align='right'>".$row['country'].", $month $year</p>";
    CloseTable();
    the_network_menu();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function network_ad_client() {
    global $titanium_module_name, $network_prefix, $titanium_db2, $sitename, $network_ad_client;

    if (is_ad_client($network_ad_client)) {
        redirect_titanium("modules.php?name=$titanium_module_name&op=network_client_home");
    } else {
        include_once(NUKE_BASE_DIR.'header.php');
        title($sitename.': '._ADSYSTEM);
        OpenTable();
        echo "<center><span class=\"title\"><strong>"._CLIENTLOGIN."</strong></span></center><br />";
        echo "<form method=\"post\" onsubmit=\"this.submit.disabled = true\" action=\"modules.php?name=$titanium_module_name\"><table border=\"0\" align=\"center\" cellpadding=\"3\"><tr>";
        echo "<td align=\"right\"><strong>"._LOGIN."</strong>&nbsp; <i class=\"bi bi-arrow-right-square\"></i>&nbsp;</td><td><input type=\"text\" name=\"login\" size=\"15\"></td></tr>";
        echo "<td align=\"right\"><strong>"._PASSWORD."</strong>&nbsp; <i class=\"bi bi-arrow-right-square\"></i>&nbsp;</td><td><input type=\"password\" name=\"pass\" size=\"15\"></td></tr>";
        echo "<td align=\"right\"></td><td><br/></td></tr>";
        echo "<td>&nbsp;</td><td><input type=\"hidden\" name=\"op\" value=\"ad_client_valid\"><input name=\"submit\" type=\"submit\" value=\""._ENTER."\"></tr></td></table></form>";
        CloseTable();		
        the_network_menu();
        include_once(NUKE_BASE_DIR.'footer.php');
    }
}

function zeroFill($a, $b) {
    $z = hexdec(80000000);
    if ($z & $a) {
        $a = ($a>>1);
        $a &= (~$z);
        $a |= 0x40000000;
        $a = ($a>>($b-1));
    } else {
        $a = ($a>>$b);
    }
    return $a;
}

function ad_client_logout() {
    global $titanium_module_name;
    $network_ad_client = "";
    setcookie("network_ad_client");
    redirect_titanium("modules.php?name=$titanium_module_name&op=network_ad_client");
}

function ad_client_valid($login, $pass) {
    global $network_prefix, $titanium_db2, $titanium_module_name, $sitename;
    $result = $titanium_db2->sql_query("SELECT cid FROM ".$network_prefix."_banner_clients WHERE login='$login' AND passwd='$pass'");
    if ($titanium_db2->sql_numrows($result) != 1) {
        include_once(NUKE_BASE_DIR.'header.php');
        title($sitename.': '._ADSYSTEM);
        OpenTable();
        echo "<center>"._LOGININCORRECT."<br /><br />"._GOBACK."</center>";
        CloseTable();
        the_network_menu();
        include_once(NUKE_BASE_DIR.'footer.php');
        exit;
    } else {
        $row = $titanium_db2->sql_fetchrow($result);
        $cid = $row['cid'];
        $info = base64_encode("$cid:$login:$pass");
        setcookie("network_ad_client",$info,time()+3600);
        redirect_titanium("modules.php?name=$titanium_module_name&op=network_client_home");
    }
}

function network_client_home() {
    global $network_prefix, $titanium_db2, $sitename, $bgcolor2, $titanium_module_name, $network_ad_client;

    if (!is_ad_client($network_ad_client)) {
        redirect_titanium("modules.php?name=$titanium_module_name&op=network_ad_client");
    } else {
        include_once(NUKE_BASE_DIR.'header.php');
        title($sitename.' '._ADSYSTEM);
        OpenTable();
        $network_ad_client = base64_decode($network_ad_client);
        $network_ad_client = addslashes($network_ad_client);
        $network_ad_client = explode(":", $network_ad_client);
        $cid = $network_ad_client[0];
        $row = $titanium_db2->sql_ufetchrow("SELECT * FROM ".$network_prefix."_banner_clients WHERE cid='$cid'");
        echo "<center>"._ACTIVEADSFOR." ".$row['name']."</center><br />"
               ."<table width=\"100%\" border=\"1\"><tr>"
               ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._NAME."</strong></td>"
            ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._IMPMADE."</strong></td>"
            ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._IMPTOTAL."</strong></td>"
            ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._IMPLEFT."</strong></td>"
            ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._CLICKS."</strong></td>"
            ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>% "._CLICKS."</strong></td>"
            ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._TYPE."</strong></td>"
            ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._FUNCTIONS."</strong></td><tr>";
        $sql = "SELECT * FROM ".$network_prefix."_banner WHERE cid='".$row['cid']."' AND active='1'";
        $result = $titanium_db2->sql_query($sql, true);
        while ($row = $titanium_db2->sql_fetchrow($result)) {
            $bid = $row['bid'];
            $bid = intval($bid);
            $imptotal = $row['imptotal'];
            $imptotal = intval($imptotal);
            $impmade = $row['impmade'];
            $impmade = intval($impmade);
            $clicks = $row['clicks'];
            $clicks = intval($clicks);
            $date = $row['date'];
            if ($impmade == 0) {
                $percent = 0;
            } else {
                $percent = substr(100 * $clicks / $impmade, 0, 5);
                $percent = $percent.'%';
            }
            if ($imptotal == 0) {
                $left = _UNLIMITED;
                $imptotal = _UNLIMITED;
            } else {
                $left = $imptotal-$impmade;
            }
            if ($row['ad_class'] == "flash" || $row['ad_class'] == "code") {
                $clicks = "N/A";
                $percent = "N/A";
            }
            if (empty($row['name'])) {
                $row['name'] = _NONE;
            }
            echo "<td align=\"center\">".$row['name']."</td>"
                ."<td align=\"center\">$impmade</td>"
                ."<td align=\"center\">$imptotal</td>"
                ."<td align=\"center\">$left</td>"
                ."<td align=\"center\">$clicks</td>"
                ."<td align=\"center\">$percent</td>"
                ."<td align=\"center\">".ucfirst($row['ad_class'])."</td>"
                ."<td align=\"center\">
				<a href=\"modules.php?name=$titanium_module_name&amp;op=client_report&amp;cid=$cid&amp;bid=$bid\"><i class=\"bi bi-mailbox\"></i></a>
				<a href=\"modules.php?name=$titanium_module_name&amp;op=client_report&amp;cid=$cid&amp;bid=$bid\">
				"._EMAILSTATS."</a>  
				<a href=\"modules.php?name=$titanium_module_name&amp;op=view_banner&amp;cid=$cid&amp;bid=$bid\"><i class=\"bi bi-binoculars\"></i></a>
				<a href=\"modules.php?name=$titanium_module_name&amp;op=view_banner&amp;cid=$cid&amp;bid=$bid\">
				"._VIEWBANNER."</a></td><tr>";
        }
        $titanium_db2->sql_freeresult($result);
        echo "</table>";
        $row = $titanium_db2->sql_ufetchrow("SELECT * FROM ".$network_prefix."_banner_clients WHERE cid='$cid'");
        echo "<br /><br /><center>"._INACTIVEADS." ".$row['name']."</center><br />"
            ."<table width=\"100%\" border=\"1\"><tr>"
            ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._NAME."</strong></td>"
            ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._IMPMADE."</strong></td>"
            ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._IMPTOTAL."</strong></td>"
            ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._IMPLEFT."</strong></td>"
            ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._CLICKS."</strong></td>"
            ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>% "._CLICKS."</strong></td>"
            ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._TYPE."</strong></td>"
            ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._FUNCTIONS."</strong></td><tr>";
        $sql = "SELECT * FROM ".$network_prefix."_banner WHERE cid='".$row['cid']."' AND active='0'";
        $result = $titanium_db2->sql_query($sql, true);
        while ($row = $titanium_db2->sql_fetchrow($result)) {
            $bid = $row['bid'];
            $bid = intval($bid);
            $imptotal = $row['imptotal'];
            $imptotal = intval($imptotal);
            $impmade = $row['impmade'];
            $impmade = intval($impmade);
            $clicks = $row['clicks'];
            $clicks = intval($clicks);
            $date = $row['date'];
            if($impmade == 0) {
                $percent = 0;
            } else {
                $percent = substr(100 * $clicks / $impmade, 0, 5);
                $percent = $percent.'%';
            }
            if($imptotal == 0) {
            $left = _UNLIMITED;
                $imptotal = _UNLIMITED;
            } else {
                $left = $imptotal-$impmade;
            }
            if ($row['ad_class'] == "flash" || $row['ad_class'] == "code") {
                $clicks = "N/A";
                $percent = "N/A";
            }
            if (empty($row['name'])) {
                $row['name'] = _NONE;
            }
            echo "<td align=\"center\">".$row['name']."</td>"
                ."<td align=\"center\">$impmade</td>"
                ."<td align=\"center\">$imptotal</td>"
                ."<td align=\"center\">$left</td>"
                ."<td align=\"center\">$clicks</td>"
                ."<td align=\"center\">$percent</td>"
                ."<td align=\"center\">".ucfirst($row['ad_class'])."</td>"
                ."<td align=\"center\"><a href=\"modules.php?name=$titanium_module_name&amp;op=ad_client_report&amp;cid=$cid&amp;bid=$bid\"><img src=\"images/edit.gif\" border=\"0\" alt=\""._EMAILSTATS."\" title=\""._EMAILSTATS."\"></a>  <a href=\"modules.php?name=$titanium_module_name&amp;op=view_banner&amp;cid=$cid&amp;bid=$bid\"><img src=\"images/view.gif\" border=\"0\" alt=\""._VIEWBANNER."\" title=\""._VIEWBANNER."\"></a></td><tr>";
            $a = 1;
        }
        $titanium_db2->sql_freeresult($result);
        if ($a != 1) {
            echo "<td align=\"center\" colspan=\"8\"><i>"._NOCONTENT."</i></td></tr>";
        }
        echo "</table><br /><br /><center>[ <a href=\"modules.php?name=$titanium_module_name&amp;op=ad_client_logout\">"._LOGOUT."</a> ]</center>";
        CloseTable();
        the_network_menu();
        include_once(NUKE_BASE_DIR.'footer.php');
    }
}

function view_banner($cid, $bid) {
    global $network_prefix, $titanium_db2, $titanium_module_name, $network_ad_client, $bgcolor2, $sitename;

    if (!is_ad_client($network_ad_client)) {
        redirect_titanium("modules.php?name=$titanium_module_name&amp;op=network_ad_client");
    } else {
        $network_ad_client = base64_decode($network_ad_client);
        $network_ad_client = addslashes($network_ad_client);
        $network_ad_client = explode(":", $network_ad_client);
        $ad_client_id = $network_ad_client[0];
        if ($cid != $ad_client_id) {
            include_once(NUKE_BASE_DIR.'header.php');
            title($sitename.' '._ADSYSTEM);
            OpenTable();
            echo "<center>"._ADISNTYOUR."<br /><br />"._GOBACK."</center>";
            CloseTable();
            the_network_menu();
            include_once(NUKE_BASE_DIR.'footer.php');
            exit;
        } else {
            include_once(NUKE_BASE_DIR.'header.php');
            title($sitename.' '._ADSYSTEM);
            OpenTable();
            $row = $titanium_db2->sql_ufetchrow("SELECT * FROM ".$network_prefix."_banner WHERE bid='$bid'");
            $cid = intval($row['cid']);
            $imptotal = intval($row['imptotal']);
            $impmade = intval($row['impmade']);
            $clicks = intval($row['clicks']);
            $imageurl = $row['imageurl'];
            $clickurl = $row['clickurl'];
            $ad_class = $row['ad_class'];
            $ad_code = $row['ad_code'];
            $ad_width = $row['ad_width'];
            $ad_height = $row['ad_height'];
            $alttext = $row['alttext'];
            echo "<center><span class=\"title\"><strong>" . _YOURBANNER . ": ".$row['name']."</strong></span><br /><br />";
            if ($ad_class == "code") {
                $ad_code = stripslashes(Fix_Quotes($ad_code));
                echo "<table border=\"0\" align=\"center\"><tr><td>$ad_code</td></tr></table><br /><br />";
            } elseif ($ad_class == "flash") {
                echo "<center>
                    <OBJECT classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\"
                    codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0\"
                    WIDTH=\"$ad_width\" HEIGHT=\"$ad_height\" id=\"$bid\">
                    <PARAM NAME=movie VALUE=\"$imageurl\">
                    <PARAM NAME=quality VALUE=high>
                    <EMBED src=\"$imageurl\" quality=high WIDTH=\"$ad_width\" HEIGHT=\"$ad_height\"
                    NAME=\"$bid\" ALIGN=\"\" TYPE=\"application/x-shockwave-flash\"
                    PLUGINSPAGE=\"http://www.macromedia.com/go/getflashplayer\">
                    </EMBED>
                    </OBJECT>
                    </center><br /><br />";
            } else {
                echo "<center><img src=\"$imageurl\" border=\"1\" alt=\"$alttext\" title=\"$alttext\" width=\"$ad_width\" height=\"$ad_height\"></center><br /><br />";
            }
            echo "<center>Banner Information: ".$row['name']."</center><br />"
                   ."<table width=\"100%\" border=\"1\"><tr>"
                   ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._NAME."</strong></td>"
                ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._IMPMADE."</strong></td>"
                ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._IMPTOTAL."</strong></td>"
                ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._IMPLEFT."</strong></td>"
                ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._CLICKS."</strong></td>"
                ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>% "._CLICKS."</strong></td>"
                ."<td bgcolor=\"$bgcolor2\" align=\"center\"><strong>"._TYPE."</strong></td><tr>";
            $bid = $row['bid'];
            $bid = intval($bid);
            $imptotal = $row['imptotal'];
            $imptotal = intval($imptotal);
            $impmade = $row['impmade'];
            $impmade = intval($impmade);
            $clicks = $row['clicks'];
            $clicks = intval($clicks);
            $date = $row['date'];
            if ($impmade == 0) {
                $percent = 0;
            } else {
                $percent = substr(100 * $clicks / $impmade, 0, 5);
                $percent = $percent.'%';
            }
            if ($imptotal == 0) {
                $left = _UNLIMITED;
                $imptotal = _UNLIMITED;
            } else {
                $left = $imptotal-$impmade;
            }
            if ($row['ad_class'] == "flash" || $row['ad_class'] == "code") {
                $clicks = "N/A";
                $percent = "N/A";
            }
            if (empty($row['name'])) {
                $row['name'] = _NONE;
            }
            if ($row['active'] == 1) {
                $status = _ACTIVE;
            } elseif ($row['active'] == 0) {
                $status = _INACTIVE;
            }
            echo "<td align=\"center\">".$row['name']."</td>"
                ."<td align=\"center\">$impmade</td>"
                ."<td align=\"center\">$imptotal</td>"
                ."<td align=\"center\">$left</td>"
                ."<td align=\"center\">$clicks</td>"
                ."<td align=\"center\">$percent</td>"
                ."<td align=\"center\">".ucFirst($row['ad_class'])."</td></tr><tr>"
                ."<td align=\"center\" colspan=\"7\">"._CURRENTSTATUS." $status</td></tr>"
                ."</table><br /><br />"
                ."[ <a href=\"modules.php?name=$titanium_module_name&amp;op=ad_client_report&amp;cid=$cid&amp;bid=$bid\">"._EMAILSTATS."</a> | <a href=\"modules.php?name=$titanium_module_name&amp;op=logout\">"._LOGOUT."</a> ]";
            CloseTable();
            the_network_menu();
            include_once(NUKE_BASE_DIR.'footer.php');
        }
    }
}

function ad_client_report($cid, $bid) {
    global $network_prefix, $titanium_db2, $titanium_module_name, $network_ad_client, $sitename;

    if (!is_ad_client($network_ad_client)) {
        redirect_titanium("modules.php?name=$titanium_module_name&op=network_ad_client");
    } else {
        $network_ad_client = base64_decode($network_ad_client);
        $network_ad_client = addslashes($network_ad_client);
        $network_ad_client = explode(":", $network_ad_client);
        $ad_client_id = $network_ad_client[0];
        if ($cid != $ad_client_id) {
            include_once(NUKE_BASE_DIR.'header.php');
            title($sitename.': '._ADSYSTEM);
            OpenTable();
            echo "<center>"._FUNCTIONSNOTALLOWED."<br /><br />"._GOBACK."</center>";
            CloseTable();
            the_network_menu();
            include_once(NUKE_BASE_DIR.'footer.php');
            exit;
        } else {
            include_once(NUKE_BASE_DIR.'header.php');
            title($sitename.': '._ADSYSTEM);
            OpenTable();
            $bid = intval($bid);
            $cid = intval($cid);
            list($name, $email) = $titanium_db2->sql_ufetchrow("SELECT name, email FROM ".$network_prefix."_banner_clients WHERE cid='$cid'");
            $name = htmlentities($name);
            if (empty($email)) {
                echo "<center><br /><br />"
                    ."<strong>"._STATSNOTSEND."</strong><br /><br />"
                    ."<a href=\"javascript:history.go(-1)\">"._GOBACK."</a>";
                CloseTable();
                the_network_menu();
                include_once(NUKE_BASE_DIR.'footer.php');
            } else {
                list($bid, $imptotal, $impmade, $clicks, $imageurl, $clickurl, $date, $ad_class) = $titanium_db2->sql_ufetchrow("SELECT bid, name, imptotal, impmade, clicks, imageurl, clickurl, date, ad_class FROM ".$network_prefix."_banner WHERE bid='$bid' AND cid='$cid'");
                $bid = intval($bid);
                $imptotal = intval($imptotal);
                $impmade = intval($impmade);
                $clicks = intval($clicks);
                if($impmade==0) {
                    $percent = 0;
                } else {
                    $percent = substr(100 * $clicks / $impmade, 0, 5);
                }
                if($imptotal==0) {
                    $left = _UNLIMITED;
                    $imptotal = _UNLIMITED;
                } else {
                    $left = $imptotal-$impmade;
                }
                $fecha = date("F jS Y, h:iA.");
                $subject = ""._YOURSTATS." $sitename";
                if (empty($ad_class) || $ad_class == "image") {
                    $message = ""._FOLLOWINGSTATS." $sitename:\n\n\n"._CLIENTNAME.": $name\n"._BANNERID.": $bid\n"._BANNERNAME.": ".$row['name']."\n"._BANNERIMAGE.": $imageurl\n"._BANNERURL.": $clickurl\n\n"._IMPPURCHASED.": $imptotal\n"._IMPREMADE.": $impmade\n"._IMPRELEFT.": $left\n"._RECEIVEDCLICKS.": $clicks\n"._CLICKSPERCENT.": $percent%\n\n\n"._GENERATEDON.": $fecha";
                } elseif ($ad_class == "flash") {
                    $message = ""._FOLLOWINGSTATS." $sitename:\n\n\n"._CLIENTNAME.": $name\n"._BANNERID.": $bid\n"._BANNERNAME.": ".$row['name']."\n"._FLASHMOVIE.": $imageurl\n\n"._IMPPURCHASED.": $imptotal\n"._IMPREMADE.": $impmade\n"._IMPRELEFT.": $left\n"._RECEIVEDCLICKS.": N/A\n"._CLICKSPERCENT.": N/A\n\n\n"._GENERATEDON.": $fecha";
                } elseif ($ad_class == "code") {
                    $message = ""._FOLLOWINGSTATS." $sitename:\n\n\n"._CLIENTNAME.": $name\n"._BANNERID.": $bid\n"._BANNERNAME.": ".$row['name']."\n\n"._IMPPURCHASED.": $imptotal\n"._IMPREMADE.": $impmade\n"._IMPRELEFT.": $left\n"._RECEIVEDCLICKS.": N/A\n"._CLICKSPERCENT.": N/A\n\n\n"._GENERATEDON.": $fecha";
                }
                $from = $sitename;
                evo_mail($email, $subject, $message, "From: $from\nX-Mailer: PHP/" . PHPVERS);
                echo "<center><br /><br /><br />"
                    ."<strong>"._STATSSENT." $email</strong><br /><br />"
                    ."[ <a href=\"javascript:history.go(-1)\">"._GOBACK."</a> ]";
                CloseTable();
                the_network_menu();
                include_once(NUKE_BASE_DIR.'footer.php');
            }
        }
    }
}

switch ($op) {

    default:
        theindex();
    break;

    case "sitestats":
        sitestats();
    break;

    case "ad_plans":
        ad_plans();
    break;

    case "network_ad_terms":
        network_ad_terms();
    break;

    case "network_ad_client":
        network_ad_client();
    break;

    case "network_client_home":
        network_client_home();
    break;

    case "ad_client_valid":
        ad_client_valid($login, $pass);
    break;

    case "ad_client_logout":
        ad_client_logout();
    break;

    case "ad_client_report":
        ad_client_report($cid, $bid);
    break;

    case "view_banner":
        view_banner($cid, $bid);
    break;

}

?>