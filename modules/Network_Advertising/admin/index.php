<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2005 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       08/06/2005
 ************************************************************************/

if (!defined('ADMIN_FILE')) {
    die('Access Denied');
}

global $network_prefix, $titanium_db2, $admin_file;
$titanium_module_name = basename(dirname(dirname(__FILE__)));

if(is_mod_admin($titanium_module_name)) {

    get_lang($titanium_module_name);

    /*********************************************************/
    /* Banners Administration Functions                      */
    /*********************************************************/

    list($c_num) = $titanium_db2->sql_ufetchrow("SELECT COUNT(*) FROM ".$network_prefix."_banner_clients", SQL_NUM);
    if ($c_num == 0) {
        $cli = "<i>"._ADDNEWBANNER."</i>";
    } else {
        $cli = "<a href=\"".$admin_file.".php?op=add_network_banner\">"._ADDNEWBANNER."</a>";
    }
    if (!is_active($titanium_module_name)) {
        $act = "<br /><center>"._ADSMODULEINACTIVE."</center>";
    } else {
        $act = "";
    }
    $ad_admin_menu_main = "<center><span class=\"title\"><strong>" . _BANNERSADMIN . "</strong></span><br /><br />[ <a href=\"".$admin_file.".php?op=ad_network_positions\">"._ADPOSITIONS."</a> - $cli - <a href=\"".$admin_file.".php?op=add_network_client\">"._ADDCLIENT."</a> - <a href=\"".$admin_file.".php?op=ad_network_terms\">"._TERMS."</a> - <a href=\"".$admin_file.".php?op=ad_network_plans\">"._PLANSPRICES."</a> ]</center>$act";
    $ad_admin_menu = "<center><span class=\"title\"><strong>" . _BANNERSADMIN . "</strong></span><br /><br />[ <a href=\"".$admin_file.".php?op=NetworkBannersAdmin\">"._BANNERS."</a> - <a href=\"".$admin_file.".php?op=ad_network_positions\">"._ADPOSITIONS."</a> - $cli - <a href=\"".$admin_file.".php?op=add_network_client\">"._ADDCLIENT."</a> - <a href=\"".$admin_file.".php?op=ad_network_terms\">"._TERMS."</a> - <a href=\"".$admin_file.".php?op=ad_network_plans\">"._PLANSPRICES."</a> ]</center>$act";

    function NetworkBannersAdmin() {
        global $network_prefix, $titanium_db2, $bgcolor2, $banners, $admin_file, $ad_admin_menu_main, $bgcolor1;

        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
	    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=NetworkBannersAdmin\">" . _BANNERS_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
	    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _BANNERS_RETURNMAIN . "</a> ]</div>\n";
	    CloseTable();
	    echo "<br />";
        OpenTable();
        echo $ad_admin_menu_main;
        CloseTable();
        echo "<br /><a name=\"top\"></a>";
        OpenTable();
        echo "<center><span class=\"option\"><strong>" . _ACTIVEBANNERS . "</strong></span></center><br />"
        ."<table width=\"100%\" border=\"1\"><tr>"
        ."<td align=\"center\"><strong>" . _BANNERNAME . "</strong></td>"
        ."<td align=\"center\"><strong>" . _CLIENT . "</strong></td>"
        ."<td align=\"center\"><strong>" . _IMPRESSIONS . "</strong></td>"
        ."<td align=\"center\"><strong>" . _IMPLEFT . "</strong></td>"
        ."<td align=\"center\"><strong>" . _CLICKS . "</strong></td>"
        ."<td align=\"center\"><strong>" . _CLICKSPERCENT . "</strong></td>"
        ."<td align=\"center\"><strong>" . _POSITION . "</strong></td>"
        ."<td align=\"center\"><strong>" . _CLASS . "</strong></td>"
        ."<td align=\"center\"><strong>" . _FUNCTIONS . "</strong></td><tr>";
        $result = $titanium_db2->sql_query("SELECT bid, cid, name, imptotal, impmade, clicks, imageurl, date, position, active, ad_class, type FROM " . $network_prefix . "_banner WHERE active='1' ORDER BY position,bid", true);
        while (list($bid, $cid, $name, $imptotal, $impmade, $clicks, $imageurl, $date, $type, $active, $ad_class) = $titanium_db2->sql_fetchrow($result)) {
            $bid = intval($bid);
            $cid = intval($cid);
            $imptotal = intval($imptotal);
            $impmade = intval($impmade);
            $clicks = intval($clicks);
            $active = intval($active);
            list($cid, $client_name) = $titanium_db2->sql_ufetchrow("SELECT cid, name FROM " . $network_prefix . "_banner_clients WHERE cid='$cid'");
            $cid = intval($cid);
            $name = trim($name);
            if (empty($name)) {
                $name = _NONE;
            } else {
                if ($ad_class == "image") {
                    $name = "<a href=\"$imageurl\" target=\"_blank\">".$name."</a>";
                }
            }
            if (empty($ad_class)) {
                $ad_class = 'image';
            }
            $ad_class = ucfirst($ad_class);
            if($impmade==0) {
                $percent = 0;
            } else {
                $percent = substr(100 * $clicks / $impmade, 0, 5);
            }
            if($imptotal==0) {
                $left = _UNLIMITED;
            } else {
                $left = $imptotal-$impmade;
            }
            $percent = $percent.'%';
            if ($ad_class == 'Code' || $ad_class == 'Flash') {
                $clicks = "N/A";
                $percent = "N/A";
            }
            $row2 = $titanium_db2->sql_ufetchrow("SELECT apid, position_name FROM ".$network_prefix."_banner_positions WHERE position_number='$type'");
            $type = "<a href=\"".$admin_file.".php?op=position_network_edit&amp;apid=".$row2['apid'] . "\">".$row2['position_name']."</a>";
            if ($active == 1) {
                $t_active = get_evo_icon('evo-sprite ok');
                $c_active = get_evo_icon('evo-sprite bad');
            } else {
                $t_active = get_evo_icon('evo-sprite bad');
                $c_active = get_evo_icon('evo-sprite ok');
            }
            echo "<td bgcolor=\"$bgcolor1\" align=center>".$name."</td>"
                ."<td bgcolor=\"$bgcolor1\" align=center><a href=\"".$admin_file.".php?op=NetworkBannerClientEdit&amp;cid=".$cid."\">$client_name</a></td>"
                ."<td bgcolor=\"$bgcolor1\" align=center>$impmade</td>"
                ."<td bgcolor=\"$bgcolor1\" align=center>$left</td>"
                ."<td bgcolor=\"$bgcolor1\" align=center>$clicks</td>"
                ."<td bgcolor=\"$bgcolor1\" align=center>$percent</td>"
                ."<td bgcolor=\"$bgcolor1\" align=center>$type</td>"
                ."<td bgcolor=\"$bgcolor1\" align=center>$ad_class</td>"
                ."<td bgcolor=\"$bgcolor1\" align=center>&nbsp;<a href=\"".$admin_file.".php?op=NetworkBannerEdit&amp;bid=$bid\">".get_evo_icon('evo-sprite edit')."</a>  <a href=\"".$admin_file.".php?op=NetworkBannerStatus&amp;bid=$bid&amp;status=$active\">$c_active</a>  <a href=\"".$admin_file.".php?op=NetworkBannerDelete&amp;bid=$bid&amp;ok=0\">".get_evo_icon('evo-sprite delete')."</a>&nbsp;</td><tr>";
        }
        $titanium_db2->sql_freeresult($result);
        echo "</td></tr></table><br />"
        ."<center><span class=\"option\"><strong>" . _INACTIVEBANNERS . "</strong></span></center><br />"
        ."<table width=\"100%\" border=\"1\"><tr>"
        ."<td align=\"center\"><strong>" . _BANNERNAME . "</strong></td>"
        ."<td align=\"center\"><strong>" . _CLIENT . "</strong></td>"
        ."<td align=\"center\"><strong>" . _IMPRESSIONS . "</strong></td>"
        ."<td align=\"center\"><strong>" . _IMPLEFT . "</strong></td>"
        ."<td align=\"center\"><strong>" . _CLICKS . "</strong></td>"
        ."<td align=\"center\"><strong>" . _CLICKSPERCENT . "</strong></td>"
        ."<td align=\"center\"><strong>" . _POSITION . "</strong></td>"
        ."<td align=\"center\"><strong>" . _CLASS . "</strong></td>"
        ."<td align=\"center\"><strong>" . _FUNCTIONS . "</strong></td><tr>";
        $result = $titanium_db2->sql_query("SELECT bid, cid, name, imptotal, impmade, clicks, imageurl, date, position, active, ad_class FROM " . $network_prefix . "_banner WHERE active='0' ORDER BY position,bid");
        while ($row = $titanium_db2->sql_fetchrow($result)) {
            $bid = intval($row['bid']);
            $cid = intval($row['cid']);
            $imptotal = intval($row['imptotal']);
            $impmade = intval($row['impmade']);
            $clicks = intval($row['clicks']);
            $imageurl = $row['imageurl'];
            $date = $row['date'];
            $type = $row['position'];
            $active = intval($row['active']);
            $row2 = $titanium_db2->sql_ufetchrow("SELECT cid, name FROM " . $network_prefix . "_banner_clients WHERE cid='$cid'");
            $cid = intval($row2['cid']);
            $name = trim($row2['name']);
            $ad_class = $row['ad_class'];
            if (empty($row['name'])) {
                $row['name'] = _NONE;
            } else {
                if ($row['ad_class'] == 'image') {
                    $row['name'] = "<a href=\"$imageurl\" target=\"_blank\">".$row['name']."</a>";
                }
            }
            if (empty($ad_class)) {
                $ad_class = 'image';
            }
            $ad_class = ucFirst($ad_class);
            if($impmade==0) {
                $percent = 0;
            } else {
                $percent = substr(100 * $clicks / $impmade, 0, 5);
            }
            if($imptotal==0) {
                $left = _UNLIMITED;
            } else {
                $left = $imptotal-$impmade;
            }
            $percent = $percent.'%';
            if ($ad_class == 'Code' || $ad_class == 'Flash') {
                $clicks = 'N/A';
                $percent = 'N/A';
            }
            $row2 = $titanium_db2->sql_ufetchrow("SELECT apid, position_name FROM ".$network_prefix."_banner_positions WHERE position_number='$type'");
            $type = "<a href=\"".$admin_file.".php?op=position_network_edit&amp;apid=".$row2['apid'] . "\">".$row2['position_name']."</a>";
            if ($active == 1) {
                $t_active = get_evo_icon('evo-sprite ok');
                $c_active = get_evo_icon('evo-sprite bad');
            } else {
                $t_active = get_evo_icon('evo-sprite bad');
                $c_active = get_evo_icon('evo-sprite ok');
            }

            echo "<td bgcolor=\"$bgcolor1\" align=center>".$row['name']."</td>"
                ."<td bgcolor=\"$bgcolor1\" align=center><a href=\"".$admin_file.".php?op=NetworkBannerClientEdit&amp;cid=".$row['cid']."\">$name</a></td>"
                ."<td bgcolor=\"$bgcolor1\" align=center>$impmade</td>"
                ."<td bgcolor=\"$bgcolor1\" align=center>$left</td>"
                ."<td bgcolor=\"$bgcolor1\" align=center>$clicks</td>"
                ."<td bgcolor=\"$bgcolor1\" align=center>$percent</td>"
                ."<td bgcolor=\"$bgcolor1\" align=center>$type</td>"
                ."<td bgcolor=\"$bgcolor1\" align=center>$ad_class</td>"
                ."<td bgcolor=\"$bgcolor1\" align=center>&nbsp;<a href=\"".$admin_file.".php?op=NetworkBannerEdit&amp;bid=$bid\">".get_evo_icon('evo-sprite edit')."</a>  <a href=\"".$admin_file.".php?op=NetworkBannerStatus&amp;bid=$bid&amp;status=$active\">$c_active</a>  <a href=\"".$admin_file.".php?op=NetworkBannerDelete&amp;bid=$bid&amp;ok=0\">".get_evo_icon('evo-sprite delete')."</a>&nbsp;</td><tr>";
        }
        $titanium_db2->sql_freeresult($result);
        echo "</td></tr></table>";
        CloseTable();
        echo "<br />";
        /* Clients List */
        OpenTable();
        echo "<center><span class=\"option\"><strong>" . _ADVERTISINGCLIENTS . "</strong></span></center><br />"
        ."<table width=\"100%\" border=\"1\"><tr>"
        ."<td align=\"center\"><strong>" . _CLIENTNAME . "</strong></td>"
        ."<td align=\"center\"><strong>" . _ACTIVEBANNERS2 . "</strong></td>"
        ."<td align=\"center\"><strong>" . _INACTIVEBANNERS . "</strong></td>"
        ."<td align=\"center\"><strong>" . _CONTACTNAME . "</strong></td>"
        ."<td align=\"center\"><strong>" . _CONTACTEMAIL . "</strong></td>"
        ."<td align=\"center\"><strong>" . _FUNCTIONS . "</strong></td><tr>";
        $result3 = $titanium_db2->sql_query("SELECT cid, name, contact, email FROM " . $network_prefix . "_banner_clients ORDER BY cid");
        while ($row3 = $titanium_db2->sql_fetchrow($result3)) {
            $cid = intval($row3['cid']);
            $name = $row3['name'];
            $contact = $row3['contact'];
            $email = $row3['email'];
            $result4 = $titanium_db2->sql_query("SELECT cid FROM " . $network_prefix . "_banner WHERE cid='$cid' AND active='1'");
            $numrows = $titanium_db2->sql_numrows($result4);
            $row4 = $titanium_db2->sql_fetchrow($result4);
            $titanium_db2->sql_freeresult($result4);
            $rcid = intval($row4['cid']);
            list($numrows2) = $titanium_db2->sql_ufetchrow("SELECT COUNT(*) FROM " . $network_prefix . "_banner WHERE cid='$cid' AND active='0'");
            echo "<td bgcolor=\"$bgcolor1\" align=\"center\">$name</td>"
            ."<td bgcolor=\"$bgcolor1\" align=\"center\">$numrows</td>"
            ."<td bgcolor=\"$bgcolor1\" align=\"center\">$numrows2</td>"
            ."<td bgcolor=\"$bgcolor1\" align=\"center\">$contact</td>"
            ."<td bgcolor=\"$bgcolor1\" align=\"center\"><a href=\"mailto:$email\">$email</a></td>"
            ."<td bgcolor=\"$bgcolor1\" align=\"center\" nowrap=\"nowrap\">&nbsp;<a href=\"".$admin_file.".php?op=NetworkBannerClientEdit&amp;cid=$cid\">".get_evo_icon('evo-sprite edit')."</a>  <a href=\"".$admin_file.".php?op=NetworkBannerClientDelete&amp;cid=$cid\">".get_evo_icon('evo-sprite delete')."</a>&nbsp;</td><tr>";
        }
        $titanium_db2->sql_freeresult($result3);
        echo "</td></tr></table>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function add_network_banner() {
        global $network_prefix, $titanium_db2, $banners, $admin_file, $ad_admin_menu;

        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
	    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=NetworkBannersAdmin\">" . _BANNERS_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
	    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _BANNERS_RETURNMAIN . "</a> ]</div>\n";
	    CloseTable();
	    echo "<br />";
        OpenTable();
        echo $ad_admin_menu;
        CloseTable();
        echo "<br />";
        OpenTable();
        $result = $titanium_db2->sql_query("select * FROM ".$network_prefix."_banner_clients");
        if($titanium_db2->sql_numrows($result) > 0) {
            echo "<center><span class=\"title\"><strong>" . _ADDNEWBANNER . "</strong></span></center><br /><br />"
            ."<table border=\"0\"><tr><td>"
            ."<form action=\"".$admin_file.".php?op=NetworkBannersAdd\" method=\"post\">"
            ."" . _CLIENTNAME . ":</td>"
            ."<td><select name=\"cid\">";
            while ($row = $titanium_db2->sql_fetchrow($result)) {
                $cid = intval($row['cid']);
                $name = $row['name'];
                echo "<option value=\"$cid\">$name</option>";
            }
            $titanium_db2->sql_freeresult($result);
            echo "</select></td></tr>"
            ."<tr><td nowrap>" . _BANNERNAME . ":</td><td><input type=\"text\" name=\"adname\" size=\"12\" maxlength=\"50\"></td></tr>"
            ."<tr><td nowrap>" . _PURCHASEDIMPRESSIONS . ":</td><td><input type=\"text\" name=\"imptotal\" size=\"12\" maxlength=\"11\"> 0 = " . _UNLIMITED . "</td></tr>"
            ."<tr><td>" . _ADCLASS . ":</td><td><select name=\"ad_class\">"
            ."<option name=\"type\" value=\"image\">" . _ADIMAGE . "</option>"
            ."<option name=\"type\" value=\"code\">" . _ADCODE . "</option>"
            ."<option name=\"type\" value=\"flash\">" . _ADFLASH . "</option>"
            ."</select></td></tr>"
            ."<tr><td>&nbsp;</td><td><i>"._CLASSNOTE."</i></td></tr>"
            ."<tr><td>" . _IMAGESWFURL . ":</td><td><input type=\"text\" name=\"imageurl\" size=\"50\" maxlength=\"100\" value=\"http://\"></td></tr>"
            ."<tr><td>" . _IMAGESIZE . ":</td><td>"._WIDTH.": <input type=\"text\" name=\"ad_width\" size=\"4\" maxlength=\"4\"> &nbsp; "._HEIGHT.": <input type=\"text\" name=\"ad_height\" size=\"4\" maxlength=\"4\"> &nbsp; "._INPIXELS."</td></tr>"
            ."<tr><td>" . _CLICKURL . "</td><td><input type=\"text\" name=\"clickurl\" size=\"50\" maxlength=\"200\" value=\"http://\"></td></tr>"
            ."<tr><td>" . _ALTTEXT . ":</td><td><input type=\"text\" name=\"alttext\" size=\"50\" maxlength=\"255\"></td></tr>"
            ."<tr><td>" . _ADCODE . ":</td><td><textarea name=\"ad_code\" rows=\"15\" cols=\"70\"></textarea></td></tr>"
            ."<tr><td>" . _TYPE . ":</td><td><select name=\"position\">";
            $result = $titanium_db2->sql_query("SELECT position_number, position_name FROM ".$network_prefix."_banner_positions ORDER BY position_number");
            while ($row = $titanium_db2->sql_fetchrow($result)) {
                echo "<option name=\"position\" value=\"".$row['position_number']."\">".$row['position_number']." - ".$row['position_name']."</option>";
            }
            $titanium_db2->sql_freeresult($result);
            echo "</select></td></tr><tr><td>&nbsp;</td><td>"._POSITIONNOTE."</td></tr>"
                ."<tr><td>" . _ACTIVATE . ":</td><td><input type=\"radio\" name=\"active\" value=\"1\" checked>" . _YES . "&nbsp;&nbsp;<input type=\"radio\" name=\"active\" value=\"0\">" . _NO . "</td></tr>"
                ."<tr><td>&nbsp;</td><td><input type=\"hidden\" name=\"op\" value=\"NetworkBannersAdd\">"
                ."<input type=\"submit\" value=\"" . _ADDBANNER . "\">"
                ."</form></td></tr></table>";
        } else {
            echo "<center><span class=\"title\"><strong>" . _ADDNEWBANNER . "</strong></span></center><br /><br />"
                ."<center>"._ADSNOCLIENT."<br /><br />"._GOBACK."</center>";
        }
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function add_network_client() {
        global $network_prefix, $titanium_db2, $banners, $admin_file, $ad_admin_menu;

        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
	    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=NetworkBannersAdmin\">" . _BANNERS_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
	    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _BANNERS_RETURNMAIN . "</a> ]</div>\n";
	    CloseTable();
	    echo "<br />";
        OpenTable();
        echo $ad_admin_menu;
        CloseTable();
        echo "<br />";
        OpenTable();
        $cl_pass = makePass();
        echo"<center><span class=\"title\"><strong>" . _ADDCLIENT . "</strong></span></center><br /><br />
            <table border=\"0\"><tr><td>
            <form action=\"".$admin_file.".php?op=NetworkBannerAddClient\" method=\"post\">
            " . _CLIENTNAME . ":</td><td><input type=\"text\" name=\"name\" size=\"30\" maxlength=\"60\"></td></tr>
            <tr><td>" . _CONTACTNAME . ":</td><td><input type=\"text\" name=\"contact\" size=\"30\" maxlength=\"60\"></td></tr>
            <tr><td>" . _CONTACTEMAIL . ":</td><td><input type=\"text\" name=\"email\" size=\"30\" maxlength=\"60\"></td></tr>
            <tr><td>" . _CLIENTLOGIN . ":</td><td><input type=\"text\" name=\"login\" size=\"12\" maxlength=\"10\"></td></tr>
            <tr><td>" . _CLIENTPASSWD . ":</td><td><input type=\"text\" name=\"passwd\" size=\"12\" maxlength=\"10\" value=\"$cl_pass\"></td></tr>
            <tr><td>" . _EXTRAINFO . ":</td><td><textarea name=\"extrainfo\" cols=\"70\" rows=\"15\"></textarea></td></tr>
            <tr><td>&nbsp;</td><td><input type=\"hidden\" name=\"op\" value=\"NetworkBannerAddClient\">
            <input type=\"submit\" value=\"" . _ADDCLIENT2 . "\">
            </form></td></tr></table>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function NetworkBannerStatus($bid, $status) {
        global $network_prefix, $titanium_db2, $admin_file;

        if ($status == 1) {
            $active = 0;
        } else {
            $active = 1;
        }
        $bid = intval($bid);
        $titanium_db2->sql_query("UPDATE " . $network_prefix . "_banner SET active='$active' WHERE bid='$bid'");
        redirect_titanium($admin_file.'.php?op=NetworkBannersAdmin');
    }

    function NetworkBannersAdd($name, $cid, $adname, $imptotal, $imageurl, $clickurl, $alttext, $position, $active, $ad_class, $ad_code, $ad_width, $ad_height) {
        global $network_prefix, $titanium_db2, $admin_file, $ad_admin_menu;

        $alttext = str_replace("\"", "", $alttext);
        $alttext = str_replace("'", "", $alttext);
        $cid = intval($cid);
        $imptotal = intval($imptotal);
        $active = intval($active);
        if (($ad_class == 'image' || $ad_class == 'flash') && (empty($ad_width) || empty($ad_height))) { $a = 1; }
        if (($ad_class == 'image') && ($imageurl == 'http://' || empty($imageurl))) { $a = 1; }
        if (($ad_class == 'image' || $ad_class == 'flash') && ((!is_numeric($ad_width) || !is_numeric($ad_height)))) { $a = 1; }
        if (($ad_class == 'code') && (empty($ad_code))) { $a = 1; }
        if ($a == 1) {
            include_once(NUKE_BASE_DIR.'header.php');
            OpenTable();
	    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=NetworkBannersAdmin\">" . _BANNERS_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
	    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _BANNERS_RETURNMAIN . "</a> ]</div>\n";
	    CloseTable();
	    echo "<br />";
            OpenTable();
            echo $ad_admin_menu;
            CloseTable();
            echo "<br />";
            OpenTable();
            echo "<center>"._ADINFOINCOMPLETE."<br /><br />"._GOBACK."</center>";
            CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
            exit;
        }
        $titanium_db2->sql_query("insert into " . $network_prefix . "_banner VALUES (NULL, '$cid', '$adname', '$imptotal', '1', '0', '$imageurl', '$clickurl', '$alttext', now(), '0000-00-00 00:00:00', '$position', '$active', '$ad_class', '$ad_code', '$ad_width', '$ad_height', '')");
        redirect_titanium($admin_file.'.php?op=NetworkBannersAdmin');
    }

    function NetworkBannerAddClient($name, $contact, $email, $login, $passwd, $extrainfo) {
        global $network_prefix, $titanium_db2, $admin_file;
        $titanium_db2->sql_query("insert into " . $network_prefix . "_banner_clients VALUES (NULL, '$name', '$contact', '$email', '$login', '$passwd', '$extrainfo')");
        redirect_titanium($admin_file.'.php?op=NetworkBannersAdmin');
    }

    function NetworkBannerDelete($bid, $ok=0) {
        global $network_prefix, $titanium_db2, $admin_file, $bgcolor1, $bgcolor2, $ad_admin_menu;
        $bid = intval($bid);
        if ($ok == 1) {
            $titanium_db2->sql_query("DELETE FROM " . $network_prefix . "_banner WHERE bid='$bid'");
            redirect_titanium($admin_file.".php?op=NetworkBannersAdmin");
        } else {
            include_once(NUKE_BASE_DIR.'header.php');
            OpenTable();
	    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=NetworkBannersAdmin\">" . _BANNERS_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
	    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _BANNERS_RETURNMAIN . "</a> ]</div>\n";
	    CloseTable();
	    echo "<br />";
            OpenTable();
            echo $ad_admin_menu;
            CloseTable();
            echo "<br />";
            $row = $titanium_db2->sql_fetchrow($titanium_db2->sql_query("SELECT cid, name, imptotal, impmade, clicks, imageurl, clickurl, ad_class, ad_code, ad_width, ad_height FROM " . $network_prefix . "_banner WHERE bid='$bid'"));
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
            if (empty($row['name'])) {
                $row['name'] = _NONE;
            }
            OpenTable();
            echo "<center><span class=\"title\"><strong>" . _DELETEBANNER . "</strong></span><br /><br />";
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
            echo "<table width=\"100%\" border=\"1\"><tr>"
                ."<td align=\"center\"><strong>" . _BANNERNAME . "<strong></td>"
                ."<td align=\"center\"><strong>" . _IMPRESSIONS . "<strong></td>"
                ."<td align=\"center\"><strong>" . _IMPLEFT . "<strong></td>"
                ."<td align=\"center\"><strong>" . _CLICKS . "<strong></td>"
                ."<td align=\"center\"><strong>" . _CLICKSPERCENT . "<strong></td>"
                ."<td align=\"center\"><strong>" . _CLIENTNAME . "<strong></td><tr>";
            $row2 = $titanium_db2->sql_ufetchrow("SELECT cid, name FROM " . $network_prefix . "_banner_clients WHERE cid='$cid'");
            $cid = intval($row2['cid']);
            $name = $row2['name'];
            $percent = substr(100 * $clicks / $impmade, 0, 5);
            if($imptotal==0) {
                $left = _UNLIMITED;
            } else {
                $left = $imptotal-$impmade;
            }
            echo "<td bgcolor=\"$bgcolor1\" align=\"center\">".$row['name']."</td>"
            ."<td bgcolor=\"$bgcolor1\" align=\"center\">$impmade</td>"
            ."<td bgcolor=\"$bgcolor1\" align=\"center\">$left</td>"
            ."<td bgcolor=\"$bgcolor1\" align=\"center\">$clicks</td>"
            ."<td bgcolor=\"$bgcolor1\" align=\"center\">$percent%</td>"
            ."<td bgcolor=\"$bgcolor1\" align=\"center\">$name</td><tr>";
        }
        echo "</td></tr></table><br />"
            ."" . _SURETODELBANNER . "<br /><br />"
            ."[ <a href=\"".$admin_file.".php?op=NetworkBannersAdmin\">" . _NO . "</a> | <a href=\"".$admin_file.".php?op=NetworkBannerDelete&amp;bid=$bid&amp;ok=1\">" . _YES . "</a> ]</center><br />";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function NetworkBannerEdit($bid) {
        global $network_prefix, $titanium_db2, $admin_file, $ad_admin_menu, $admlang;
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
	    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=NetworkBannersAdmin\">" . _BANNERS_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
	    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _BANNERS_RETURNMAIN . "</a> ]</div>\n";
	    CloseTable();
	    echo "<br />";
        OpenTable();
        echo $ad_admin_menu;
        CloseTable();
        echo "<br />";
        $bid = intval($bid);
        $row = $titanium_db2->sql_ufetchrow("SELECT cid, name, imptotal, impmade, clicks, imageurl, clickurl, alttext, date, position, active, ad_class, ad_code, ad_width, ad_height FROM " . $network_prefix . "_banner WHERE bid='$bid'");
        $cid = intval($row['cid']);
        $imptotal = intval($row['imptotal']);
        $impmade = intval($row['impmade']);
        $clicks = intval($row['clicks']);
        $imageurl = $row['imageurl'];
        $clickurl = $row['clickurl'];
        $alttext = $row['alttext'];
        $date = $row['date'];
        $date = explode(" ", $date);
        $date = $date[0].' @ '.$date[1];
        $position = $row['position'];
        $active = intval($row['active']);
        $ad_class = $row['ad_class'];
        $ad_code = $row['ad_code'];
        $ad_width = $row['ad_width'];
        $ad_height = $row['ad_height'];
        OpenTable();
        echo"<center><span class=\"title\"><strong>" . _EDITBANNER . "</strong></span></center><br /><br />";
        if ($ad_class == "code") {
            $ad_code = Fix_Quotes($ad_code);
            echo "<table border=\"0\" align=\"center\"><tr><td>$ad_code</td></tr></table><br /><br />";
        } elseif ($ad_class == "flash") {
            echo "<center>
                <OBJECT classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\"
                codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0\"
                WIDTH=\"$ad_width\" HEIGHT=\"$ad_height\" id=\"$bid\">
                <PARAM NAME=movie VALUE=\"$imageurl\">
                <PARAM NAME=quality VALUE=high>
                <EMBED src=\"$imageurl\" quality=high WIDTH=\"$ad_width\" HEIGHT=\"$ad_height\"
                NAME=\"$did\" ALIGN=\"\" TYPE=\"application/x-shockwave-flash\"
                PLUGINSPAGE=\"http://www.macromedia.com/go/getflashplayer\">
                </EMBED>
                </OBJECT>
                </center><br /><br />";
        } else {
            echo "<center><img src=\"$imageurl\" border=\"1\" alt=\"$alttext\" title=\"$alttext\" width=\"$ad_width\" height=\"$ad_height\"></center><br /><br />";
        }

        echo "<table border=\"0\" cellpadding=\"3\"><tr><td>"
            ."<form action=\"".$admin_file.".php?op=NetworkBannerChange\" method=\"post\">"
            ."" . _CLIENTNAME . ":</td><td>"
            ."<select name=\"cid\">";
        $row2 = $titanium_db2->sql_ufetchrow("SELECT cid, name FROM " . $network_prefix . "_banner_clients WHERE cid='$cid'");
        $cid = intval($row2['cid']);
        $name = $row2['name'];
        echo "<option value=\"$cid\" selected>$name</option>";
        $result3 = $titanium_db2->sql_query("SELECT cid, name FROM " . $network_prefix . "_banner_clients");
        while ($row3 = $titanium_db2->sql_fetchrow($result3)) {
            $ccid = intval($row3['cid']);
            $name = $row3['name'];
            if($cid!=$ccid) {
                echo "<option value=\"$ccid\">$name</option>";
            }
        }
        $titanium_db2->sql_freeresult($result3);
        echo "</select></td></tr>";
        if($imptotal==0) {
            $impressions = _UNLIMITED;
        } else {
            $impressions = $imptotal;
        }
        if ($active == 1) {
            $check1 = "checked";
            $check2 = "";
        } else {
            $check1 = "";
            $check2 = "checked";
        }
        $unl = '';
        if ($imptotal != 0) {
            $unl = "("._XFORUNLIMITED.")";
        }
        echo "<tr><td>"._BANNERNAME.":</td><td><input type=\"text\" name=\"adname\" size=\"20\" maxlength=\"50\" value=\"".$row['name']."\"></td></tr>";
        echo "<tr><td>"._ADDEDDATE.":</td><td>$date</td></tr>";
        echo "<tr><td>"._IMPPURCHASED.":</td><td><strong>$impressions</strong></td></tr>";
        echo "<tr><td>"._IMPMADE.":</td><td><strong>$impmade</strong></td></tr>";
        echo "<tr><td>"._ADDIMPRESSIONS.":</td><td><input type=\"text\" name=\"impadded\" size=\"12\" maxlength=\"11\" value=\"0\"> <i>$unl</i></td></tr>";
        echo "<tr><td>"._ADCLASS.":</td><td><strong>".ucFirst($ad_class)."</strong></td></tr>";
        if ($ad_class == "code") {
            echo "<tr><td>" . _ADCODE . ":</td><td><textarea name=\"ad_code\" rows=\"15\" cols=\"70\">$ad_code</textarea>"
                ."<input type=\"hidden\" name=\"imageurl\" value=\"$imageurl\">"
                ."<input type=\"hidden\" name=\"ad_width\" value=\"$ad_width\">"
                ."<input type=\"hidden\" name=\"ad_height\" value=\"$ad_height\">"
                ."<input type=\"hidden\" name=\"clickurl\" value=\"$clickurl\">"
                ."<input type=\"hidden\" name=\"alttext\" value=\"$alttext\"></td></tr>";
        } elseif ($ad_class == "flash") {
            echo "<tr><td>" . _FLASHFILEURL . ":</td><td><input type=\"text\" name=\"imageurl\" size=\"50\" maxlength=\"100\" value=\"$imageurl\"> &nbsp; <a href=\"$imageurl\" target=\"_blank\"><img src=\"images/view.gif\" border=\"0\" alt=\""._SHOW."\" title=\""._SHOW."\"></a></td></tr>"
                ."<tr><td>" . _FLASHSIZE . ":</td><td>"._WIDTH.": <input type=\"text\" name=\"ad_width\" size=\"4\" maxlength=\"4\" value=\"$ad_width\"> &nbsp; "._HEIGHT.": <input type=\"text\" name=\"ad_height\" size=\"4\" maxlength=\"4\" value=\"$ad_height\"> &nbsp; "._INPIXELS.""
                ."<input type=\"hidden\" name=\"clickurl\" value=\"$clickurl\">"
                ."<input type=\"hidden\" name=\"alttext\" value=\"$alttext\">"
                ."<input type=\"hidden\" name=\"ad_code\" value=\"$ad_code\"></td></tr>";
        } else {
            echo "<tr><td>" . _IMAGEURL . ":</td><td><input type=\"text\" name=\"imageurl\" size=\"50\" maxlength=\"100\" value=\"$imageurl\"></td></tr>"
                ."<tr><td>" . _IMAGESIZE . ":</td><td>"._WIDTH.": <input type=\"text\" name=\"ad_width\" size=\"4\" maxlength=\"4\" value=\"$ad_width\"> &nbsp; "._HEIGHT.": <input type=\"text\" name=\"ad_height\" size=\"4\" maxlength=\"4\" value=\"$ad_height\"> &nbsp; "._INPIXELS."</td></tr>"
                ."<tr><td>" . _CLICKURL . ":</td><td><input type=\"text\" name=\"clickurl\" size=\"50\" maxlength=\"200\" value=\"$clickurl\"></td></tr>"
                ."<tr><td>" . _ALTTEXT . ":</td><td><input type=\"text\" name=\"alttext\" size=\"50\" maxlength=\"255\" value=\"$alttext\">"
                ."<input type=\"hidden\" name=\"ad_code\" value=\"$ad_code\"></td></tr>";
        }
        echo "<tr><td>" . _TYPE . ":</td><td><select name=\"position\">";
        $result4 = $titanium_db2->sql_query("SELECT position_number, position_name FROM ".$network_prefix."_banner_positions ORDER BY position_number");
        while ($row4 = $titanium_db2->sql_fetchrow($result4)) {
            if ($position == $row4['position_number']) {
                $sel = "selected";
            } else {
                $sel = "";
            }
            echo "<option name=\"position\" value=\"".$row4['position_number']."\" $sel>".$row4['position_number']." - ".$row4['position_name']."</option>";
        }
        $titanium_db2->sql_freeresult($result4);
        echo "</select></td></tr>"
            ."<tr><td>" . _ACTIVATE . ":</td><td><input type=\"radio\" name=\"active\" value=\"1\" $check1>" . _YES . "&nbsp;&nbsp;<input type=\"radio\" name=\"active\" value=\"0\" $check2>" . _NO . "</td></tr>"
            ."<tr><td>&nbsp;</td><td><input type=\"hidden\" name=\"bid\" value=\"$bid\">"
            ."<input type=\"hidden\" name=\"imptotal\" value=\"$imptotal\">"
            ."<input type=\"hidden\" name=\"impmade\" value=\"$impmade\">"
            ."<input type=\"hidden\" name=\"op\" value=\"NetworkBannerChange\">"
            ."<input type=\"submit\" value=\"" . $admlang['global']['save_changes'] . "\">"
            ."</form></td></tr></table>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function NetworkBannerChange($bid, $cid, $adname, $imptotal, $impadded, $imageurl, $clickurl, $alttext, $position, $active, $ad_code, $ad_width, $ad_height, $impmade) {
        global $network_prefix, $titanium_db2, $admin_file;
        if (!is_numeric($impadded)) {
            $impadded = strtoupper($impadded);
            if ($impadded == "X") {
                $imp = 0;
            }
        } else {
            if ($impadded == 0) {
                $imp = $imptotal;
            } else {
                if ($imptotal == 0) {
                    $imp = $impmade+$impadded;
                } else {
                    $imp = $imptotal+$impadded;
                }
            }
        }
        $alttext = str_replace("\"", "", $alttext);
        $alttext = str_replace("'", "", $alttext);
        $cid = intval($cid);
        $imp = intval($imp);
        $active = intval($active);
        $bid = intval($bid);
        $titanium_db2->sql_query("UPDATE " . $network_prefix . "_banner SET cid='$cid', name='$adname', imptotal='$imp', imageurl='$imageurl', clickurl='$clickurl', alttext='$alttext', position='$position', active='$active', ad_code='$ad_code', ad_width='$ad_width', ad_height='$ad_height' WHERE bid='$bid'");
        redirect_titanium($admin_file.".php?op=NetworkBannersAdmin");
    }

    function NetworkBannerClientDelete($cid, $ok=0) {
        global $network_prefix, $titanium_db2, $admin_file, $ad_admin_menu;
        $cid = intval($cid);
        if ($ok==1) {
            $titanium_db2->sql_query("DELETE FROM " . $network_prefix . "_banner WHERE cid='$cid'");
            $titanium_db2->sql_query("DELETE FROM " . $network_prefix . "_banner_clients WHERE cid='$cid'");
            redirect_titanium($admin_file.".php?op=NetworkBannersAdmin");
        } else {
            include_once(NUKE_BASE_DIR.'header.php');
            OpenTable();
	    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=NetworkBannersAdmin\">" . _BANNERS_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
	    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _BANNERS_RETURNMAIN . "</a> ]</div>\n";
	    CloseTable();
	    echo "<br />";
            OpenTable();
            echo $ad_admin_menu;
            CloseTable();
            echo "<br />";
            $row = $titanium_db2->sql_fetchrow($titanium_db2->sql_query("SELECT cid, name FROM " . $network_prefix . "_banner_clients WHERE cid='$cid'"));
            $cid = intval($row['cid']);
            $name = $row['name'];
            OpenTable();
            echo "<center><strong>" . _DELETECLIENT . ": $name</strong><br /><br />
                " . _SURETODELCLIENT . "<br /><br />";
            $result2 = $titanium_db2->sql_query("SELECT imageurl, clickurl FROM " . $network_prefix . "_banner WHERE cid='$cid'");
            $numrows = $titanium_db2->sql_numrows($result2);
            $titanium_db2->sql_freeresult($result2);
            if($numrows==0) {
                echo "" . _CLIENTWITHOUTBANNERS . "<br /><br />";
            } else {
                echo "<strong>" . _WARNING . "!!!</strong><br />
                    " . _DELCLIENTHASBANNERS . ":<br /><br />";
            }
            while ($row2 = $titanium_db2->sql_fetchrow($result2)) {
                $imageurl = $row2['imageurl'];
                $clickurl = $row2['clickurl'];
                echo "<a href=\"$clickurl\"><img src=\"$imageurl\" border=\"1\" alt=\"\"></a><br />
                    <a href=\"$clickurl\">$clickurl</a><br /><br />";
            }
            $titanium_db2->sql_freeresult($result2);
        }
        echo "" . _SURETODELCLIENT . "<br /><br />
            [ <a href=\"".$admin_file.".php?op=NetworkBannersAdmin#top\">" . _NO . "</a> | <a href=\"".$admin_file.".php?op=NetworkBannerClientDelete&amp;cid=$cid&amp;ok=1\">" . _YES . "</a> ]</center><br /><br /></center>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function NetworkBannerClientEdit($cid) {
        global $network_prefix, $titanium_db2, $admin_file, $ad_admin_menu, $admlang;

        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
	    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=NetworkBannersAdmin\">" . _BANNERS_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
	    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _BANNERS_RETURNMAIN . "</a> ]</div>\n";
	    CloseTable();
	    echo "<br />";
        OpenTable();
        echo $ad_admin_menu;
        CloseTable();
        echo "<br />";
        $cid = intval($cid);
        $row = $titanium_db2->sql_fetchrow($titanium_db2->sql_query("SELECT name, contact, email, login, passwd, extrainfo FROM " . $network_prefix . "_banner_clients WHERE cid='$cid'"));
        $name = $row['name'];
        $contact = $row['contact'];
        $email = $row['email'];
        $login = $row['login'];
        $passwd = $row['passwd'];
        $extrainfo = $row['extrainfo'];
        OpenTable();
        echo "<center><span class=\"option\"><strong>" . _EDITCLIENT . "</strong></span></center><br /><br />"
        ."<form action=\"".$admin_file.".php?op=NetworkBannerClientChange\" method=\"post\">"
        ."" . _CLIENTNAME . ": <input type=\"text\" name=\"name\" value=\"$name\" size=\"30\" maxlength=\"60\"><br /><br />"
        ."" . _CONTACTNAME . ": <input type=\"text\" name=\"contact\" value=\"$contact\" size=\"30\" maxlength=\"60\"><br /><br />"
        ."" . _CONTACTEMAIL . ": <input type=\"text\" name=\"email\" size=30 maxlength=\"60\" value=\"$email\"><br /><br />"
        ."" . _CLIENTLOGIN . ": <input type=\"text\" name=\"login\" size=12 maxlength=\"10\" value=\"$login\"><br /><br />"
        ."" . _CLIENTPASSWD . ": <input type=\"text\" name=\"passwd\" size=12 maxlength=\"10\" value=\"$passwd\"><br /><br />"
        ."" . _EXTRAINFO . "<br /><textarea name=\"extrainfo\" cols=\"70\" rows=\"15\">$extrainfo</textarea><br /><br />"
        ."<input type=\"hidden\" name=\"cid\" value=\"$cid\">"
        ."<input type=\"hidden\" name=\"op\" value=\"NetworkBannerClientChange\">"
        ."<input type=\"submit\" value=\"" . $admlang['global']['save_changes'] . "\">"
        ."</form>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function NetworkBannerClientChange($cid, $name, $contact, $email, $extrainfo, $login, $passwd) {
        global $network_prefix, $titanium_db2, $admin_file;

        $cid = intval($cid);
        $titanium_db2->sql_query("UPDATE ".$network_prefix."_banner_clients SET name='$name', contact='$contact', email='$email', login='$login', passwd='$passwd', extrainfo='$extrainfo' WHERE cid='$cid'");
        redirect_titanium($admin_file.".php?op=NetworkBannersAdmin#top");
    }

    function ad_network_positions() {
        global $network_prefix, $titanium_db2, $banners, $admin_file, $ad_admin_menu, $bgcolor1, $bgcolor2;

        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
	    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=NetworkBannersAdmin\">" . _BANNERS_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
	    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _BANNERS_RETURNMAIN . "</a> ]</div>\n";
	    CloseTable();
	    echo "<br />";
        OpenTable();
        echo $ad_admin_menu;
        CloseTable();
        echo "<br />";
        OpenTable();
        echo "<center><span class=\"title\"><strong>"._CURRENTPOSITIONS."</strong></span></center><br /><br /><table width=\"100%\" border=\"1\"><tr>"
            ."<td align=\"center\"><strong>" . _POSITIONNAME . "<strong></td>"
            ."<td align=\"center\"><strong>" . _POSITIONNUMBER . "<strong></td>"
            ."<td align=\"center\"><strong>" . _ASSIGNEDADS . "<strong></td>"
            ."<td align=\"center\"><strong>" . _FUNCTIONS . "<strong></td>";
        $result = $titanium_db2->sql_query("SELECT * FROM ".$network_prefix."_banner_positions ORDER BY apid");
        while ($row = $titanium_db2->sql_fetchrow($result)) {
            $ban_num = $titanium_db2->sql_numrows($titanium_db2->sql_query("SELECT * FROM ".$network_prefix."_banner WHERE position='".$row['position_number']."'"));
            echo "<tr><td bgcolor=\"$bgcolor1\" align=\"center\">".$row['position_name']."</td>"
                ."<td bgcolor=\"$bgcolor1\" align=\"center\">".$row['position_number']."</td>"
                ."<td bgcolor=\"$bgcolor1\" align=\"center\">$ban_num</td>"
                ."<td bgcolor=\"$bgcolor1\" align=\"center\">&nbsp;<a href=\"".$admin_file.".php?op=position_network_edit&amp;apid=".$row['apid']."\">".get_evo_icon('evo-sprite edit')."</a>  <a href=\"".$admin_file.".php?op=position_delete&amp;apid=".$row['apid']."\">".get_evo_icon('evo-sprite delete')."</a>&nbsp;</td></tr>";
        }
        $titanium_db2->sql_freeresult($result);
        echo "</table><br />";
        CloseTable();
        echo "<br />";
        OpenTable();
        $numrows = $titanium_db2->sql_numrows($titanium_db2->sql_query("SELECT * FROM ".$network_prefix."_banner_positions"));
        if ($numrows == 0) {
            $pos_num = 0;
        } else {
            $row = $titanium_db2->sql_fetchrow($titanium_db2->sql_query("SELECT position_number FROM ".$network_prefix."_banner_positions ORDER BY position_number DESC LIMIT 0,1"));
            $pos_num = $row['position_number']+1;
        }
        echo "<center><span class=\"title\"><strong>"._ADDNEWPOSITION."</strong></span><br /><br />"
            ."<form method=\"\" action=\"".$admin_file.".php\">"
            .""._POSITIONNAME.": <input type=\"text\" name=\"ad_position_name\"> "._POSITIONNUMBER.": <strong>$pos_num</strong><input type=\"hidden\" name=\"ad_position_number\" value=\"$pos_num\"><input type=\"hidden\" name=\"position_new\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"position_network_save\"><br /><br /><input type=\"submit\" value=\""._ADDPOSITION."\">"
            ."</form></center>";
        CloseTable();
        echo "<br />";
        OpenTable();
        echo "<center><strong>"._NOTE."</strong><br /><br />"._POSITIONNOTE."<br />"._POSEXAMPLE."</center>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function position_network_save($apid=0, $ad_position_number, $ad_position_name, $position_new=0) {
        global $network_prefix, $titanium_db2, $admin_file, $ad_admin_menu;

        if (empty($ad_position_name)) {
            include_once(NUKE_BASE_DIR.'header.php');
            OpenTable();
	    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=NetworkBannersAdmin\">" . _BANNERS_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
	    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _BANNERS_RETURNMAIN . "</a> ]</div>\n";
	    CloseTable();
	    echo "<br />";
            OpenTable();
            echo $ad_admin_menu;
            CloseTable();
            echo "<br />";
            OpenTable();
            echo "<center><span class=\"title\"><strong>"._ADDNEWPOSITION."</strong></span><br /><br />"
                .""._POSINFOINCOMPLETE."<br /><br />"._GOBACK."</center>";
            CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
            exit;
        }
        $ad_position_name = Fix_Quotes(filter_text($ad_position_name, "nohtml"));
        $ad_position_number = intval($ad_position_number);
        if ($position_new == 1) {
            $titanium_db2->sql_query("INSERT INTO ".$network_prefix."_banner_positions VALUES (NULL, '$ad_position_number', '$ad_position_name')");
        } else {
            $apid = intval($apid);
            $titanium_db2->sql_query("UPDATE ".$network_prefix."_banner_positions SET position_name='$ad_position_name' WHERE apid='$apid'");
        }
        redirect_titanium($admin_file.'.php?op=ad_network_positions');
    }

    function position_network_edit($apid) {
        global $network_prefix, $titanium_db2, $banners, $admin_file, $ad_admin_menu;
        $apid = intval($apid);
        if (empty($apid) && $apid == 0) {
            redirect_titanium($admin_file.'.php?op=ad_network_positions');
            exit;
        }
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
	    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=NetworkBannersAdmin\">" . _BANNERS_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
	    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _BANNERS_RETURNMAIN . "</a> ]</div>\n";
	    CloseTable();
	    echo "<br />";
        OpenTable();
        echo $ad_admin_menu;
        CloseTable();
        echo "<br />";
        OpenTable();
        $row = $titanium_db2->sql_fetchrow($titanium_db2->sql_query("SELECT * FROM ".$network_prefix."_banner_positions WHERE apid='$apid'"));
        echo "<center><span class=\"title\"><strong>"._EDITPOSITION."</strong></span><br /><br />"
            ."<form method=\"POST\" action=\"".$admin_file.".php\">"
            .""._POSITIONNAME.": <input type=\"text\" name=\"ad_position_name\" value=\"".$row['position_name']."\"> "._POSITIONNUMBER.": <strong>".$row['position_number']."</strong><input type=\"hidden\" name=\"ad_position_number\" value=\"".$row['position_number']."\"><input type=\"hidden\" name=\"apid\" value=\"$apid\"><input type=\"hidden\" name=\"op\" value=\"position_network_save\"><br /><br /><input type=\"submit\" value=\""._SAVEPOSITION."\">"
            ."</form></center>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function position_delete($apid, $ok=0, $active=0, $new_pos=x) {
        global $network_prefix, $titanium_db2, $admin_file, $ad_admin_menu;

        $numrows = $titanium_db2->sql_numrows($titanium_db2->sql_query("SELECT * FROM ".$network_prefix."_banner_positions"));
        if ($numrows == 1) {
            include_once(NUKE_BASE_DIR.'header.php');
            OpenTable();
	    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=NetworkBannersAdmin\">" . _BANNERS_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
	    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _BANNERS_RETURNMAIN . "</a> ]</div>\n";
	    CloseTable();
	    echo "<br />";
            OpenTable();
            echo $ad_admin_menu;
            CloseTable();
            echo "<br />";
            OpenTable();
            echo "<center><strong>"._DELETEPOSITION."</strong><br /><br />
                   "._CANTDELETEPOSITION."<br /><br />"._GOBACK."";
           CloseTable();
           include_once(NUKE_BASE_DIR.'footer.php');
           exit;
        }
        if ($ok == 1) {
            if ($new_pos == "x" || empty($new_post)) {
                $titanium_db2->sql_query("DELETE FROM ".$network_prefix."_banner_positions WHERE apid='$apid'");
            } else {
                if ($active == "same") {
                    $row = $titanium_db2->sql_fetchrow($titanium_db2->sql_query("SELECT * FROM ".$network_prefix."_banner_positions WHERE apid='$apid'"));
                    $result = $titanium_db2->sql_query("SELECT * FROM ".$network_prefix."_banner WHERE position='".$row['position_number']."'");
                    while($row2 = $titanium_db2->sql_fetchrow($result)) {
                        $titanium_db2->sql_query("UPDATE ".$network_prefix."_banner SET position='$new_pos' WHERE bid='".$row2['bid']."'");
                    }
                    $titanium_db2->sql_freeresult($result);
                    $titanium_db2->sql_query("DELETE FROM ".$network_prefix."_banner_positions WHERE apid='$apid'");
                } elseif ($active == "active") {
                    $row = $titanium_db2->sql_fetchrow($titanium_db2->sql_query("SELECT * FROM ".$network_prefix."_banner_positions WHERE apid='$apid'"));
                    $result = $titanium_db2->sql_query("SELECT * FROM ".$network_prefix."_banner WHERE position='".$row['position_number']."'");
                    while($row2 = $titanium_db2->sql_fetchrow($result)) {
                        $titanium_db2->sql_query("UPDATE ".$network_prefix."_banner SET position='$new_pos', active='1' WHERE bid='".$row2['bid']."'");
                    }
                    $titanium_db2->sql_freeresult($result);
                    $titanium_db2->sql_query("DELETE FROM ".$network_prefix."_banner_positions WHERE apid='$apid'");
                } elseif ($active == "inactive") {
                    $row = $titanium_db2->sql_fetchrow($titanium_db2->sql_query("SELECT * FROM ".$network_prefix."_banner_positions WHERE apid='$apid'"));
                    $result = $titanium_db2->sql_query("SELECT * FROM ".$network_prefix."_banner WHERE position='".$row['position_number']."'");
                    while($row2 = $titanium_db2->sql_fetchrow($result)) {
                        $titanium_db2->sql_query("UPDATE ".$network_prefix."_banner SET position='$new_pos', active='0' WHERE bid='".$row2['bid']."'");
                    }
                    $titanium_db2->sql_freeresult($result);
                    $titanium_db2->sql_query("DELETE FROM ".$network_prefix."_banner_positions WHERE apid='$apid'");
                } elseif ($active == "delete_all") {
                    $row = $titanium_db2->sql_fetchrow($titanium_db2->sql_query("SELECT * FROM ".$network_prefix."_banner_positions WHERE apid='$apid'"));
                    $titanium_db2->sql_query("DELETE FROM ".$network_prefix."_banner WHERE position='".$row['position_number']."'");
                    $titanium_db2->sql_query("DELETE FROM ".$network_prefix."_banner_positions WHERE apid='$apid'");
                }
            }
            redirect_titanium($admin_file.'.php?op=ad_network_positions');
            exit;
        } else {
            include_once(NUKE_BASE_DIR.'header.php');
            OpenTable();
	    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=NetworkBannersAdmin\">" . _BANNERS_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
	    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _BANNERS_RETURNMAIN . "</a> ]</div>\n";
	    CloseTable();
	    echo "<br />";
            OpenTable();
            echo $ad_admin_menu;
            CloseTable();
            echo "<br />";
            OpenTable();
            $row = $titanium_db2->sql_fetchrow($titanium_db2->sql_query("SELECT * FROM ".$network_prefix."_banner_positions WHERE apid='$apid'"));
            echo "<br /><center><strong>"._DELETEPOSITION.": ".$row['position_name']."</strong><br /><br />
                "._SURETODELPOSITION."<br /><br />";
            $numrows = $titanium_db2->sql_numrows($titanium_db2->sql_query("SELECT * FROM ".$network_prefix."_banner WHERE position='".$row['position_number']."'"));
            if($numrows != 0) {
                echo ""._POSITIONHASADS."<br /><br />";
                echo "<form action=\"".$admin_file.".php\" method=\"POST\">";
                echo ""._MOVEADS.": <select name=\"new_pos\">";
                $result = $titanium_db2->sql_query("SELECT * FROM ".$network_prefix."_banner_positions WHERE apid!='$apid'");
                while($row = $titanium_db2->sql_fetchrow($result)) {
                    echo "<option value=\"".$row['position_number']."\">".$row['position_number'].": ".$row['position_name']."</option>";
                }
                $titanium_db2->sql_freeresult($result);
                echo "</select><br /><br />";
                echo ""._MOVEDADSSTATUS.": <select name=\"active\">";
                echo "<option value=\"same\">"._NOCHANGES."</option>";
                echo "<option value=\"active\">"._ACTIVE."</option>";
                echo "<option value=\"inactive\">"._INACTIVE."</option>";
                echo "<option value=\"delete_all\">"._DELETEALLADS." ($numrows)</option>";
                echo "</select><br /><br />";
                echo "<input type=\"hidden\" name=\"apid\" value=\"$apid\"><input type=\"hidden\" name=\"ok\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"position_delete\"><input type=\"submit\" value=\""._DELETE."\">";
                echo "</form>";
            } else {
                echo "[ <a href=\"".$admin_file.".php?op=ad_network_positions\">"._NO."</a> | <a href=\"".$admin_file.".php?op=position_delete&amp;apid=$apid&amp;ok=1\">"._YES."</a> ]</center>";
            }
        }
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function ad_network_terms($save=0, $terms_body=0, $country=0) {
        global $network_prefix, $titanium_db2, $banners, $admin_file, $ad_admin_menu, $admlang;
        if ($save != 0) {
            $titanium_db2->sql_query("UPDATE ".$network_prefix."_banner_terms SET terms_body='".Fix_Quotes($terms_body)."', country='$country'");
            redirect_titanium($admin_file.".php?op=ad_network_terms");
            exit;
        }
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
	    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=NetworkBannersAdmin\">" . _BANNERS_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
	    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _BANNERS_RETURNMAIN . "</a> ]</div>\n";
	    CloseTable();
	    echo "<br />";
        OpenTable();
        echo $ad_admin_menu;
        CloseTable();
        echo "<br />";
        OpenTable();
        $row = $titanium_db2->sql_fetchrow($titanium_db2->sql_query("SELECT * FROM ".$network_prefix."_banner_terms"));
        echo "<center><span class=\"title\"><strong>"._EDITTERMS."</strong></span><br /><br /><i>"._SITENAMEADS."</i><br /><br />"
            ."<form method=\"POST\" name=\"termspost\" action=\"".$admin_file.".php\">"
            .""._TERMSOFSERVICEBODY.":<br /><br />";
			Make_TextArea('terms_body', $row['terms_body'], 'termspost');
            echo ""._COUNTRYNAME.":<br /><br /><select name=\"country\">";
        $result = $titanium_db2->sql_query("SELECT `flag_name` FROM `".$network_prefix."_bbflags` ORDER BY `flag_name`");
        while ($row2 = $titanium_db2->sql_fetchrow($result)) {
            if ($row['country'] == $row2['flag_name']) {
                $sel = "selected";
            } else {
                $sel = "";
            }
            echo "<option value=\"".$row2['flag_name']."\" $sel>".ucwords(strtolower($row2['flag_name']))."</option>";
        }
        $titanium_db2->sql_freeresult($result);
        echo "</select><br /><br />"
            ."<input type=\"hidden\" name=\"save\" value=\"1\"><input type=\"hidden\" name=\"op\" value=\"ad_network_terms\"><br /><br /><input type=\"submit\" value=\"".$admlang['global']['save_changes']."\">"
            ."</form></center><br /><table border=\"0\" width=\"80%\" align=\"center\"><tr><td align=\"center\"><i>"._TERMSNOTE."</i></td></tr></table>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function ad_network_plans() {
        global $network_prefix, $titanium_db2, $admin_file, $ad_admin_menu, $bgcolor1, $bgcolor2;
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
	    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=NetworkBannersAdmin\">" . _BANNERS_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
	    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _BANNERS_RETURNMAIN . "</a> ]</div>\n";
	    CloseTable();
	    echo "<br />";
        OpenTable();
        echo $ad_admin_menu;
        CloseTable();
        echo "<br />";
        $numrows = $titanium_db2->sql_numrows($titanium_db2->sql_query("SELECT * FROM ".$network_prefix."_banner_plans"));
        if ($numrows != 0) {
            OpenTable();
            $result = $titanium_db2->sql_query("SELECT * FROM ".$network_prefix."_banner_plans");
            echo "<center><span class=\"title\"><strong>"._ADVERTISINGPLANS."</strong></span></center><br />";
            echo "<table border=\"1\" width=\"100%\"><tr><td><strong>&nbsp;"._PLANNAME."</strong></td><td align=\"center\"><strong>"._DELIVERY."</strong></td><td align=\"center\"><strong>"._STATUS."</strong></td><td align=\"center\"><strong>"._PRICE."</strong></td><td align=\"center\"><strong>"._FUNCTIONS."</strong></td></tr>";
            while ($row = $titanium_db2->sql_fetchrow($result)) {
                if ($row['delivery_type'] == 0) {
                    $type = _IMPRESSIONS;
                } elseif ($row['delivery_type'] == 1) {
                    $type = _CLICKS;
                } elseif ($row['delivery_type'] == 2) {
                    $type = _DAYS;
                } elseif ($row['delivery_type'] == 3) {
                    $type = _MONTHS;
                } elseif ($row['delivery_type'] == 4) {
                    $type = _YEARS;
                }
                $active = intval($row['active']);
                if ($active == 1) {
                    $t_active = get_evo_icon('evo-sprite ok');
                    $c_active = get_evo_icon('evo-sprite bad');
                } else {
                    $t_active = get_evo_icon('evo-sprite bad');
                    $c_active = get_evo_icon('evo-sprite ok');
                }
                echo "<tr><td bgcolor=\"$bgcolor1\">&nbsp;".$row['name']."</td>"
                    ."<td align=\"center\" bgcolor=\"$bgcolor1\">".$row['delivery']." $type</td>"
                    ."<td align=\"center\" bgcolor=\"$bgcolor1\">$t_active</td>"
                    ."<td align=\"center\" bgcolor=\"$bgcolor1\">".$row['price']."</td>"
                    ."<td align=\"center\" bgcolor=\"$bgcolor1\">&nbsp;<a href=\"".$admin_file.".php?op=ad_network_plans_edit&amp;pid=".$row['pid']."\">".get_evo_icon('evo-sprite edit')."</a>  <a href=\"".$admin_file.".php?op=ad_network_plans_status&amp;pid=".$row['pid']."&status=$active\">$c_active</a>  <a href=\"".$admin_file.".php?op=ad_network_plans_delete&amp;pid=".$row['pid']."&amp;ok=0\">".get_evo_icon('evo-sprite delete')."</a>&nbsp;</td></tr>";
            }
            $titanium_db2->sql_freeresult($result);
            echo "</table>";
            CloseTable();
            echo "<br />";
        }
        OpenTable();
        echo "<center><span class=\"title\"><strong>"._ADDADVERTISINGPLAN."</strong></span></center><br /><br />";
        echo "<table border=\"0\"><tr><td>";
        echo "<form method=\"POST\" action=\"".$admin_file.".php\">";
        echo ""._PLANNAME.":</td><td><input type=\"text\" size=\"40\" name=\"name\"></td></tr>";
        echo "<tr><td>"._PLANDESCRIPTION.":</td><td><textarea name=\"description\" rows=\"15\" cols=\"70\"></textarea></td></tr>";
        echo "<tr><td>"._DELIVERYQUANTITY.":</td><td><input type=\"text\" size=\"10\" name=\"delivery\"></td></tr>";
        echo "<tr><td>"._DELIVERYTYPE.":</td><td><select name=\"type\">"
            ."<option value=\"0\">"._IMPRESSIONS."</option>"
            ."<option value=\"1\">"._CLICKS."</option>"
            ."<option value=\"2\">"._PDAYS."</option>"
            ."<option value=\"3\">"._PMONTHS."</option>"
            ."<option value=\"4\">"._PYEARS."</option>"
            ."</select></td></tr>";
        echo "<tr><td>"._PRICE.":</td><td><input type=\"text\" size=\"10\" name=\"price\"></td></tr>";
        echo "<tr><td>"._PLANBUYLINKS.":</td><td><textarea name=\"buy_links\" rows=\"15\" cols=\"70\"></textarea></td></tr>";
        echo "<tr><td>"._INITIALSTATUS.":</td><td><input type=\"radio\" name=\"status\" value=\"1\" checked> "._ACTIVE." &nbsp;&nbsp; <input type=\"radio\" name=\"status\" value=\"0\"> "._INACTIVE."</td></tr>";
        echo "<tr><td>&nbsp;</td><td><input type=\"hidden\" name=\"op\" value=\"ad_network_plans_add\"><input type=\"submit\" value=\""._ADDNEWPLAN."\"></td></tr></table></form><br /><center><i>"._PLANSNOTE."</i></center>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function ad_network_plans_add($name, $description, $delivery, $type, $price, $buy_links, $status) {
        global $network_prefix, $titanium_db2, $banners, $admin_file, $ad_admin_menu;

        if (!empty($name) AND !empty($description) AND !empty($delivery) AND (isset($type) AND is_numeric($type)) AND !empty($price) AND !empty($buy_links) AND !empty($status)) {
            $titanium_db2->sql_query("INSERT INTO ".$network_prefix."_banner_plans VALUES (NULL, '$status', '$name', '$description', '$delivery', '$type', '$price', '$buy_links')");
            redirect_titanium($admin_file.'.php?op=ad_network_plans');
            exit;
        } else {
            include_once(NUKE_BASE_DIR.'header.php');
            OpenTable();
	    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=NetworkBannersAdmin\">" . _BANNERS_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
	    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _BANNERS_RETURNMAIN . "</a> ]</div>\n";
	    CloseTable();
	    echo "<br />";
            OpenTable();
            echo $ad_admin_menu;
            CloseTable();
            echo "<br />";
            OpenTable();
            echo "<center>"._ADDPLANERROR."<br /><br />"._GOBACK."</center>";
            CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
        }
    }

    function ad_network_plans_edit($pid) {
        global $network_prefix, $titanium_db2, $banners, $admin_file, $ad_admin_menu, $admlang;

        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
	    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=NetworkBannersAdmin\">" . _BANNERS_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
	    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _BANNERS_RETURNMAIN . "</a> ]</div>\n";
	    CloseTable();
	    echo "<br />";
        OpenTable();
        echo $ad_admin_menu;
        CloseTable();
        echo "<br />";
        OpenTable();
        $row = $titanium_db2->sql_fetchrow($titanium_db2->sql_query("SELECT * FROM ".$network_prefix."_banner_plans WHERE pid='$pid'"));
        echo "<center><span class=\"title\"><strong>"._ADVERTISINGPLANEDIT."</strong></span></center><br /><br />";
        echo "<table border=\"0\"><tr><td>";
        echo "<form method=\"POST\" action=\"".$admin_file.".php\">";
        echo ""._PLANNAME.":</td><td><input type=\"text\" size=\"40\" name=\"name\" value=\"".$row['name']."\"></td></tr>";
        echo "<tr><td>"._PLANDESCRIPTION.":</td><td><textarea name=\"description\" rows=\"15\" cols=\"70\">".$row['description']."</textarea></td></tr>";
        echo "<tr><td>"._DELIVERYQUANTITY.":</td><td><input type=\"text\" size=\"10\" name=\"delivery\" value=\"".$row['delivery']."\"></td></tr>";
        if ($row['delivery_type'] == 0) {
            $sel0 = "selected";
        }
        if ($row['delivery_type'] == 1) {
            $sel1 = "selected";
        }
        if ($row['delivery_type'] == 2) {
            $sel2 = "selected";
        }
        if ($row['delivery_type'] == 3) {
            $sel3 = "selected";
        }
        if ($row['delivery_type'] == 4) {
            $sel4 = "selected";
        }
        echo "<tr><td>"._DELIVERYTYPE.":</td><td><select name=\"type\">"
            ."<option value=\"0\" $sel0>"._IMPRESSIONS."</option>"
            ."<option value=\"1\" $sel1>"._CLICKS."</option>"
            ."<option value=\"2\" $sel2>"._PDAYS."</option>"
            ."<option value=\"3\" $sel3>"._PMONTHS."</option>"
            ."<option value=\"4\" $sel4>"._PYEARS."</option>"
            ."</select></td></tr>";
        echo "<tr><td>"._PRICE.":</td><td><input type=\"text\" size=\"10\" name=\"price\" value=\"".$row['price']."\"></td></tr>";
        echo "<tr><td>"._PLANBUYLINKS.":</td><td><textarea name=\"buy_links\" rows=\"15\" cols=\"70\">".$row['buy_links']."</textarea></td></tr>";
        if ($row['active'] == 1) {
            $check0 = 'checked';
            $check1 = '';
        } elseif ($row['active'] == 0) {
            $check0 = '';
            $check1 = 'checked';
        }
        echo "<tr><td>"._STATUS.":</td><td><input type=\"radio\" name=\"status\" value=\"1\" $check0> "._ACTIVE." &nbsp;&nbsp; <input type=\"radio\" name=\"status\" value=\"0\" $check1> "._INACTIVE."</td></tr>";
        echo "<tr><td>&nbsp;</td><td><input type=\"hidden\" name=\"pid\" value=\"$pid\"><input type=\"hidden\" name=\"op\" value=\"ad_network_plans_save\"><input type=\"submit\" value=\"".$admlang['global']['save_changes']."\"></td></tr></table></form><br /><center><i>"._PLANSNOTE."</i></center>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

    function ad_network_plans_save($pid, $name, $description, $delivery, $type, $price, $buy_links, $status) {
        global $network_prefix, $titanium_db2, $banners, $admin_file, $ad_admin_menu;

        if (!empty($name) AND !empty($description) AND !empty($delivery) AND (isset($type) AND is_numeric($type)) AND !empty($price) AND !empty($buy_links) AND !empty($status)) {
            $titanium_db2->sql_query("UPDATE ".$network_prefix."_banner_plans SET active='$status', name='$name', description='$description', delivery='$delivery', delivery_type='$type', buy_links='$buy_links', price='$price' WHERE pid='$pid'");
            redirect_titanium($admin_file.'.php?op=ad_network_plans');
            exit;
        } else {
            include_once(NUKE_BASE_DIR.'header.php');
            OpenTable();
	    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=NetworkBannersAdmin\">" . _BANNERS_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
	    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _BANNERS_RETURNMAIN . "</a> ]</div>\n";
	    CloseTable();
	    echo "<br />";
            OpenTable();
            echo $ad_admin_menu;
            CloseTable();
            echo "<br />";
            OpenTable();
            echo "<center>"._ADDPLANERROR."<br /><br />"._GOBACK."</center>";
            CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
        }
    }

    function ad_network_plans_delete($pid, $ok=0) {
        global $network_prefix, $titanium_db2, $admin_file, $ad_admin_menu;

        if ($ok == 1) {
            $titanium_db2->sql_query("DELETE FROM ".$network_prefix."_banner_plans WHERE pid='$pid'");
            redirect_titanium($admin_file.'.php?op=ad_network_plans');
            exit;
        } else {
            include_once(NUKE_BASE_DIR.'header.php');
            OpenTable();
	    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=NetworkBannersAdmin\">" . _BANNERS_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
	    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _BANNERS_RETURNMAIN . "</a> ]</div>\n";
	    CloseTable();
	    echo "<br />";
            OpenTable();
            echo $ad_admin_menu;
            CloseTable();
            echo "<br />";
            OpenTable();
            $row = $titanium_db2->sql_fetchrow($titanium_db2->sql_query("SELECT * FROM ".$network_prefix."_banner_plans WHERE pid='$pid'"));
            echo "<center><strong>"._DELETEPLAN.": ".$row['name']."</strong><br /><br />"
                .""._SURETODELPLAN."<br /><br />"
                ."[ <a href=\"".$admin_file.".php?op=ad_network_plans\">"._NO."</a> | <a href=\"".$admin_file.".php?op=ad_network_plans_delete&amp;pid=$pid&amp;ok=1\">"._YES."</a> ]</center>";
            CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
        }
    }

    function ad_network_plans_status($pid, $status) {
        global $network_prefix, $titanium_db2, $admin_file;

        if ($status == 1) {
            $active = 0;
        } else {
            $active = 1;
        }
        $pid = intval($pid);
        $titanium_db2->sql_query("UPDATE ".$network_prefix."_banner_plans SET active='$active' WHERE pid='$pid'");
        redirect_titanium($admin_file.'.php?op=ad_network_plans');
    }

    if (!isset($save)) { $save = ''; }
    if (!isset($terms_body)) { $terms_body = ''; }
    if (!isset($country)) { $country = ''; }
    if (!isset($ok)) { $ok = ""; }
    if (!isset($active)) { $active = ''; }
    if (!isset($new_pos)) { $new_pos = ''; }

    switch($op) {

        case "NetworkBannersAdmin":
            NetworkBannersAdmin();
        break;

        case "NetworkBannersAdd":
            NetworkBannersAdd($name, $cid, $adname, $imptotal, $imageurl, $clickurl, $alttext, $position, $active, $ad_class, $ad_code, $ad_width, $ad_height);
        break;

        case "NetworkBannerAddClient":
            NetworkBannerAddClient($name, $contact, $email, $login, $passwd, $extrainfo);
        break;

        case "NetworkBannerDelete":
            NetworkBannerDelete($bid, $ok);
        break;

        case "NetworkBannerEdit":
            NetworkBannerEdit($bid);
        break;

        case "NetworkBannerChange":
            NetworkBannerChange($bid, $cid, $adname, $imptotal, $impadded, $imageurl, $clickurl, $alttext, $position, $active, $ad_code, $ad_width, $ad_height, $impmade);
        break;

        case "NetworkBannerClientDelete":
            NetworkBannerClientDelete($cid, $ok);
        break;

        case "NetworkBannerClientEdit":
            NetworkBannerClientEdit($cid);
        break;

        case "NetworkBannerClientChange":
            NetworkBannerClientChange($cid, $name, $contact, $email, $extrainfo, $login, $passwd);
        break;

        case "NetworkBannerStatus":
            NetworkBannerStatus($bid, $status);
        break;

        case "add_network_banner":
            add_network_banner();
        break;

        case "add_network_client":
            add_network_client();
        break;

        case "ad_network_positions":
            ad_network_positions();
        break;

        case "position_network_save":
            position_network_save($apid, $ad_position_number, $ad_position_name, $position_new);
        break;

        case "position_network_edit":
            position_network_edit($apid);
        break;

        case "position_delete":
            position_delete($apid, $ok, $active, $new_pos);
        break;

        case "ad_network_terms":
            ad_network_terms($save, $terms_body, $country);
        break;

        case "ad_network_plans":
            ad_network_plans();
        break;

        case "ad_network_plans_add":
            ad_network_plans_add($name, $description, $delivery, $type, $price, $buy_links, $status);
        break;

        case "ad_network_plans_edit":
            ad_network_plans_edit($pid);
        break;

        case "ad_network_plans_save":
            ad_network_plans_save($pid, $name, $description, $delivery, $type, $price, $buy_links, $status);
        break;

        case "ad_network_plans_delete":
            ad_network_plans_delete($pid, $ok);
        break;

        case "ad_network_plans_status":
            ad_network_plans_status($pid, $status);
        break;
    }

} else {
    DisplayError("<strong>"._ERROR."</strong><br /><br />You do not have administration permission for module \"$titanium_module_name\"");
}

?>