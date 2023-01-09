<?php

/**
*****************************************************************************************
** PHP-AN602  (Titanium Edition) v1.0.0 - Project Start Date 11/04/2022 Friday 4:09 am **
*****************************************************************************************
** https://an602.86it.us/
** https://github.com/php-an602/php-an602
** https://an602.86it.us/index.php (DEMO)
** Apache License, Version 2.0, MIT license 
** Copyright (C) 2022
** Formerly Known As PHP-Nuke by Francisco Burzi <fburzi@gmail.com>
** Created By Ernest Allen Buffington (aka TheGhost or Ghost) <ernest.buffington@gmail.com>
** And Joe Robertson (aka joeroberts)
** Project Leaders: Black_heart, Thor.
** File steps/4.php 2018-09-21 00:00:00 Thor
**
** CHANGES
**
** 2018-09-21 - Updated Masthead, Github, !defined('IN_NUKE')
**/

require_once(SETUP_INCLUDE_DIR."configdata.php");
require_once(SETUP_UDL_DIR."database.php");

function nuke_sqlerror($sql) { //Returns SQL Error
        global $db;
        $err = [];
        $err = $db->sql_error();
        echo "<br />\n";
        echo "<font class=\"err\">";
        echo _nuke_sql_error1.$sql;
        echo "<br />";
        echo _nuke_sql_error2.$err["code"];
        echo "<br />";
        echo _nuke_sql_error3.$err["message"];
        echo "</font>";
        $db->sql_query("",END_TRANSACTION);
}

echo "<p align=\"center\"><font size=\"5\">"._step4."</font></p>\n";
echo "<p>&nbsp</p>";

$db = new sql_db($db_host, $db_user, $db_pass, $db_name, $db_persistency);

$can_proceed = true;

echo "<p>"._checkingfiles;
foreach(explode(":","install-".$db_type.":smiles:categories") as $sqlscript) {
        if (!is_readable("sql/".$sqlscript.".sql")) {
                $can_proceed = false;
                echo "<br /><font class=\"err\">".str_replace("**file**","install-".$db_type.".sql",_step4fnotfound)."</font>";
        }
}
if ($can_proceed) echo "<font class=\ok\">OK</font>";
echo "</p>";


#Creating Tables
if ($can_proceed) {
        $fp = fopen("sql/install-".$db_type.".sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $scripts = explode(";",$installscript);
        //print_r($scripts);
        unset($installscript);
        foreach ($scripts as $script) {
                if (!preg_match('/^CREATE TABLE IF NOT EXISTS `#prefix#_([\\w]*)`[^;]*$/sim', $script, $matches)) continue;
                $script .= ";"; //Splitting string removes semicolon
                $script = str_replace("#prefix#",$db_prefix,$script);
                echo "<p>".str_replace("**table**",$matches[1],_tblcreating);
                if (!$db->sql_query($script)) {
                        $can_proceed = false;
                        nuke_sqlerror($script);
                        break;
                } else echo "<font class=\"ok\">OK</font>";
                echo "</p>\n";
                unset($script, $matches);
        }
        unset($scripts);
}

#Inserting default smileys
if ($can_proceed) {
        $fp = fopen("sql/smiles.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._installsmiles;
        if (!$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}
if ($can_proceed) {
        $fp = fopen("sql/site_settings.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_site_settings;
        if (!$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}
if ($can_proceed) {
        $fp = fopen("sql/arcade_settings.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_arcade_settings;
        if (!$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}
if ($can_proceed) {
        $fp = fopen("sql/arcade_categories.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_arcade_categories;
        if (!$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}
if ($can_proceed) {
        $fp = fopen("sql/arcade_games.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_arcade_games;
        if (!$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}
if ($can_proceed) {
        $fp = fopen("sql/attachments_config.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_attachments_config;
        if (!$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}
if ($can_proceed) {
        $fp = fopen("sql/avatar_config.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_avatar_config;
        if (!$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}
if ($can_proceed) {
        $fp = fopen("sql/avp.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_avp;
        if (!$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}
if ($can_proceed) {
        $fp = fopen("sql/bbcode.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bbcode;
        if (!$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}
if ($can_proceed) {
        $fp = fopen("sql/bonus.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bonus;
        if (!$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}
if ($can_proceed) {
        $fp = fopen("sql/bonus_points.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bonus_points;
        if (!$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}
if ($can_proceed) {
        $fp = fopen("sql/cache_con.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_cache_con;
        if (!$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}
if ($can_proceed) {
        $fp = fopen("sql/categories.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._installcategories;
        if (!$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}
if ($can_proceed) {
        $fp = fopen("sql/extension_groups.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_extension_groups;
        if (!$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}
if ($can_proceed) {
        $fp = fopen("sql/extensions.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_extensions;
        if (!$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}
if ($can_proceed) {
        $fp = fopen("sql/forum_config.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_forum_config;
        if (!$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}
if ($can_proceed) {
        $fp = fopen("sql/icons.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_icons;
        if (!$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}
if ($can_proceed) {
        $fp = fopen("sql/img_bucket.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_img_bucket;
        if (!$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}
if ($can_proceed) {
        $fp = fopen("sql/level_privlages.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_level_privlages;
        if (!$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}
if ($can_proceed) {
        $fp = fopen("sql/level_settings.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_level_settings;
        if (!$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}
if ($can_proceed) {
        $fp = fopen("sql/levels.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_levels;
        if (!$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}
if ($can_proceed) {
        $fp = fopen("sql/paypal.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_paypal;
        if (!$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}

if ($can_proceed) {
        $fp = fopen("sql/ranks.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_ranks;
        if (!$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}

if ($can_proceed) {
        $fp = fopen("sql/ratiowarn_config.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_ratiowarn_config;
        if (!$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}

if ($can_proceed) {
        $fp = fopen("sql/search_cloud.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_search_cloud;
        if (!$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}

if ($can_proceed) {
        $fp = fopen("sql/shout_config.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_shout_config;
        if (!$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}

if ($can_proceed) {
        $fp = fopen("sql/time_offset.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_time_offset;
        if (!$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}

if ($can_proceed) {
        $fp = fopen("sql/userautodel.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_userautodel;
        if (!$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}

if ($can_proceed) {
        $fp = fopen("sql/acl_options.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_acl_options;
        if (!$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}

if ($can_proceed) {
        $fp = fopen("sql/acl_roles.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_acl_roles;
        if (!$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}

if ($can_proceed) {
        $fp = fopen("sql/acl_roles_data.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_acl_roles_data;
        if (!$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}

if ($can_proceed) {
        $fp = fopen("sql/acl_groups.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_acl_groups;
        if (!$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}

if ($can_proceed) {
        $fp = fopen("sql/modules.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_modules;
        if (!$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}

if ($can_proceed) {
        $fp = fopen("sql/report_reasons.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_report_reasons;
        if (!$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}

if ($can_proceed) {
        $fp = fopen("sql/countries.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_countries;
        if (!$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        $db->sql_query('UPDATE `' . $db_prefix . '_countries` SET `id`=\'0\' WHERE `id` = \'100\';');
        unset($installscript);
}

if ($can_proceed) {
        $fp = fopen("sql/hit_run.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_hit_run;
        if (!$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}
        $db->sql_query('UPDATE `' . $db_prefix . '_countries` SET `id`=\'0\' WHERE `id` = \'100\';');
        $sql = "INSERT INTO ".$db_prefix."_users (username, clean_username, password, email, active, act_key, level, can_do, user_rank, user_type, regdate) VALUES('GUEST','guest','".md5('1k2g5h1j5k1h5g1f5hkj')."','".addslashes('guestnowhere.com')."', 1,'".base64_encode(microtime())."', 'user', '4', '0', '0', NOW());";
        $db->sql_query($sql);
        $db->sql_query('UPDATE `' . $db_prefix . '_users` SET `id`=\'0\';');
if ($can_proceed) {
        echo "<p>"._step4complete."</p>";
        echo "<p><input type=\"submit\" value=\""._nextstep."\" /></p>\n";
        echo "<input type=\"hidden\" name=\"step\" value=\"5\" />\n";
} else {
        echo "<p>"._step4failed."</p>";
}

$db->sql_close();

?>
