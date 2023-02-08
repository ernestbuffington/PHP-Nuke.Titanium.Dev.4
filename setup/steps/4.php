<?php

/**
*****************************************************************************************
** PHP-Nuke Titanium v4.0.4 - Project Start Date 11/04/2022 Friday 4:09 am             **
*****************************************************************************************
** https://www.php-nuke-titanium.86it.us
** https://github.com/ernestbuffington/PHP-Nuke.Titanium.Dev.4
** https://www.php-nuke-titanium.86it.us/index.php (DEMO)
** Apache License, Version 2.0. MIT license 
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
foreach(explode(":","install-".$db_type.":nuke_bbsmiles") as $sqlscript) {
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

# Smilies Table
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbsmiles.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
		fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_smilies;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } 
		else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
		
		$sql="ALTER TABLE ".$db_prefix."_bbsmilies ADD PRIMARY KEY (`smilies_id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_bbsmilies MODIFY `smilies_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37 ";
		$result=$db->sql_query($sql);
}

# Admin Table
if ($can_proceed) {
        $fp = fopen("sql/nuke_admin_fc.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_admin_fc;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } 
		else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}

#Author Table
if ($can_proceed) {
        $fp = fopen("sql/nuke_authors.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_author;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}

# Local Banner Table
if ($can_proceed) {
        $fp = fopen("sql/nuke_banner.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_banner;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_banner ADD PRIMARY KEY (`bid`), ADD KEY `cid` (`cid`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_banner MODIFY `bid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6 ";
		$result=$db->sql_query($sql);

}

# Local Banner Clients Table
if ($can_proceed) {
        $fp = fopen("sql/nuke_banner_clients.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_banner_clients;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_banner_clients ADD PRIMARY KEY (`cid`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_banner_clients MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2 ";
		$result=$db->sql_query($sql);

}

# Local Banner Plans Table
if ($can_proceed) {
        $fp = fopen("sql/nuke_banner_plans.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_banner_plans;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
				nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_banner_plans ADD PRIMARY KEY (`pid`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_banner_plans MODIFY `pid` int(10) NOT NULL AUTO_INCREMENT ";
		$result=$db->sql_query($sql);

}

# Local Banner Positions
if ($can_proceed) {
        $fp = fopen("sql/nuke_banner_positions.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_banner_positions;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_banner_positions ADD PRIMARY KEY (`apid`), ADD KEY `position_number` (`position_number`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_banner_positions MODIFY `apid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4 ";
		$result=$db->sql_query($sql);
}

# Local Banner Terms
if ($can_proceed) {
        $fp = fopen("sql/nuke_banner_terms.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_banner_terms;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}

# User Name Colors
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbadvanced_username_color.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_advanced_username_colors;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbadvanced_username_color ADD PRIMARY KEY (`group_id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_bbadvanced_username_color MODIFY `group_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6 ";
		$result=$db->sql_query($sql);
}

# Arcade Settings
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbarcade.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bbarcade_settings;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbarcade ADD PRIMARY KEY (`arcade_name`) ";
		$result=$db->sql_query($sql);
}

# Arcade Categories
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbarcade_categories.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bbarcade_categories;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
		
		$sql="ALTER TABLE ".$db_prefix."_bbarcade_categories ADD KEY `arcade_catid` (`arcade_catid`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_bbarcade_categories MODIFY `arcade_catid` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2 ";
		$result=$db->sql_query($sql);
}

# Arcade Comments
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbarcade_comments.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bbarcade_comments;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}

# Arcade Favorites
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbarcade_fav.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bbarcade_favorites;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}

# Attachments
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbattachments.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bbattachments;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbattachments 
		ADD KEY `attach_id_post_id` (`attach_id`,`post_id`), 
		ADD KEY `attach_id_privmsgs_id` (`attach_id`,`privmsgs_id`), 
		ADD KEY `post_id` (`post_id`), 
		ADD KEY `privmsgs_id` (`privmsgs_id`) ";
		$result=$db->sql_query($sql);
}

# Attachmements Config
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbattachments_config.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bbattachments_config;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbattachments_config ADD PRIMARY KEY (`config_name`) ";
		$result=$db->sql_query($sql);
}

# Attchements Descriptions
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbattachments_desc.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bbattachments_descriptions;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbattachments_desc 
		ADD PRIMARY KEY (`attach_id`),
        ADD KEY `filetime` (`filetime`),
        ADD KEY `physical_filename` (`physical_filename`(10)),
        ADD KEY `filesize` (`filesize`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_bbattachments_desc MODIFY `attach_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12 ";
		$result=$db->sql_query($sql);
}

# Attachmement Quota
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbattach_quota.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bbattachments_quota;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}

# Forum Auth Access
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbauth_access.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bbauth_access;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}

#Arcade Auth Access
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbauth_arcade_access.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bbarcade_auth_access;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}

# Foru Ban Lists
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbbanlist.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_banlist;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
		
		$sql="ALTER TABLE ".$db_prefix."_bbbanlist 
		ADD PRIMARY KEY (`ban_id`),
        ADD KEY `ban_ip_user_id` (`ban_ip`,`ban_userid`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_bbbanlist MODIFY `ban_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT ";
		$result=$db->sql_query($sql);
}

# Forum Catgories
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbcategories.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_categories;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbcategories 
		ADD PRIMARY KEY (`cat_id`),
        ADD KEY `cat_order` (`cat_order`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_bbcategories MODIFY `cat_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6 ";
		$result=$db->sql_query($sql);
}

# Forum Config
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbconfig.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_config;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

        $time = time();

		$sql="ALTER TABLE ".$db_prefix."_bbconfig 
		ADD PRIMARY KEY (`config_name`) ";
		$result=$db->sql_query($sql);
		$sql="UPDATE `nuke_bbconfig` SET `config_name` = 'board_startdate',`config_value` = '".$time."' WHERE `nuke_bbconfig`.`config_name` = 'board_startdate'; ";
		$result=$db->sql_query($sql);	  
}

# Forum Disallow Config
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbdisallow.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_disallow;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbdisallow 
		ADD PRIMARY KEY (`disallow_id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_bbdisallow MODIFY `disallow_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3 ";
		$result=$db->sql_query($sql);
}

# Attachment Extensions
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbextensions.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_extensions;
		         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbextensions 
		ADD PRIMARY KEY (`ext_id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_bbextensions MODIFY `ext_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32 ";
		$result=$db->sql_query($sql);
}

# Attachments Extensions Groups
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbextension_groups.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_extensions_groups;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbextension_groups 
		ADD PRIMARY KEY (`group_id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_bbextension_groups MODIFY `group_id` mediumint(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8 ";
		$result=$db->sql_query($sql);
}

# Forum Flags
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbflags.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_flags;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}

# Forbidden Attchements Exensions
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbforbidden_extensions.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_forbidden_attachemnets_extensions;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbforbidden_extensions 
		ADD PRIMARY KEY (`ext_id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_bbforbidden_extensions MODIFY `ext_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11 ";
		$result=$db->sql_query($sql);
}

# Forums
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbforums.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_forums;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbforums 
		ADD PRIMARY KEY (`forum_id`),
        ADD KEY `forums_order` (`forum_order`),
        ADD KEY `cat_id` (`cat_id`),
        ADD KEY `forum_last_post_id` (`forum_last_post_id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_bbforums MODIFY `forum_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18 ";
		$result=$db->sql_query($sql);
}

#Forums Prune
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbforum_prune.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_forums_prune;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbforum_prune 
		ADD PRIMARY KEY (`prune_id`),
        ADD KEY `forum_id` (`forum_id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_bbforum_prune MODIFY `prune_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2 ";
		$result=$db->sql_query($sql);
}

# Arcade Games Hash Table
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbgamehash.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bbarcade_games_hash;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
		
		$sql="ALTER TABLE ".$db_prefix."_bbgamehash 
		ADD KEY `game_id` (`game_id`),
        ADD KEY `user_id` (`user_id`) ";
		$result=$db->sql_query($sql);
}

# Arcade Games Table
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbgames.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bbarcade_games;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbgames 
		ADD KEY `game_id` (`game_id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_bbgames MODIFY `game_id` mediumint(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2 ";
		$result=$db->sql_query($sql);
}

# Forum Groups Table
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbgroups.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_groups;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbgroups 
		ADD PRIMARY KEY (`group_id`),
        ADD KEY `group_single_user` (`group_single_user`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_bbgroups MODIFY `group_id` mediumint(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37 ";
		$result=$db->sql_query($sql);
}

# Arcade Hack Game Table
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbhackgame.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bbarcade_hack_games;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbhackgame 
		ADD KEY `game_id` (`game_id`),
        ADD KEY `user_id` (`user_id`) ";
		$result=$db->sql_query($sql);
}

# Forum InLine Ads
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbinline_ads.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_inline_ads;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbinline_ads 
		ADD PRIMARY KEY (`ad_id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_bbinline_ads MODIFY `ad_id` tinyint(5) NOT NULL AUTO_INCREMENT ";
		$result=$db->sql_query($sql);
}

# Forum Logs Table
if ($can_proceed) {
        $fp = fopen("sql/nuke_bblogs.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_logs;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bblogs 
		ADD PRIMARY KEY (`log_id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_bblogs MODIFY `log_id` mediumint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1 ";
		$result=$db->sql_query($sql);
}

# Forum Logs Config Table
if ($can_proceed) {
        $fp = fopen("sql/nuke_bblogs_config.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_logs_config;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bblogs_config 
		ADD PRIMARY KEY (`config_name`) ";
		$result=$db->sql_query($sql);
}

# Forum Posts Table
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbposts.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_forum_posts;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbposts 
		ADD PRIMARY KEY (`post_id`),
        ADD KEY `forum_id` (`forum_id`),
        ADD KEY `topic_id` (`topic_id`),
        ADD KEY `poster_id` (`poster_id`),
        ADD KEY `post_time` (`post_time`),
        ADD KEY `post_icon` (`post_icon`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_bbposts MODIFY `post_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57 ";
		$result=$db->sql_query($sql);
}

# Forum Posts Text Table
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbposts_text.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_forum_posts_text;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbposts_text ADD PRIMARY KEY (`post_id`) ";
		$result=$db->sql_query($sql);
}

# Forum Post Reports Table
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbpost_reports.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_forum_posts_reports;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbpost_reports 
		ADD PRIMARY KEY (`report_id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_bbpost_reports MODIFY `report_id` mediumint(8) NOT NULL AUTO_INCREMENT ";
		$result=$db->sql_query($sql);
}

# Forum Private Messages Table
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbprivmsgs.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_private_messages;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
       } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbprivmsgs 
		ADD PRIMARY KEY (`privmsgs_id`),
        ADD KEY `privmsgs_from_userid` (`privmsgs_from_userid`),
        ADD KEY `privmsgs_to_userid` (`privmsgs_to_userid`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_bbprivmsgs MODIFY `privmsgs_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1 ";
		$result=$db->sql_query($sql);
}

# Forum Private Messages Archive Table
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbprivmsgs_archive.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_private_messages_archive;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
		
		$sql="ALTER TABLE ".$db_prefix."_bbprivmsgs_archive 
		ADD PRIMARY KEY (`privmsgs_id`),
        ADD KEY `privmsgs_from_userid` (`privmsgs_from_userid`),
        ADD KEY `privmsgs_to_userid` (`privmsgs_to_userid`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_bbprivmsgs_archive MODIFY `privmsgs_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT ";
		$result=$db->sql_query($sql);
}

# Forum Private Messages Text Table
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbprivmsgs_text.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_private_messages_text;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
		
		$sql="ALTER TABLE ".$db_prefix."_bbprivmsgs_text 
		ADD PRIMARY KEY (`privmsgs_text_id`) ";
		$result=$db->sql_query($sql);
}

# Forum Quick Search
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbquicksearch.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_quick_search;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbquicksearch 
		ADD PRIMARY KEY (`search_id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_bbquicksearch MODIFY `search_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2 ";
		$result=$db->sql_query($sql);
}

# Forum Quota Limts
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbquota_limits.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_quota_limits;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
		
		$sql="ALTER TABLE ".$db_prefix."_bbquota_limits 
		ADD PRIMARY KEY (`quota_limit_id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_bbquota_limits MODIFY `quota_limit_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4 ";
		$result=$db->sql_query($sql);
}

# Forum Ranks Table
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbranks.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_ranks;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbranks 
		ADD PRIMARY KEY (`rank_id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_bbranks MODIFY `rank_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8 ";
		$result=$db->sql_query($sql);
}

# Forum Reputations
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbreputation.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_reputation;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
		
		$sql="ALTER TABLE ".$db_prefix."_bbreputation 
		ADD KEY `post_id` (`post_id`),
        ADD KEY `user_id` (`user_id`) ";
		$result=$db->sql_query($sql);
}

# Forum Reputations Config
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbreputation_config.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_reputation_config;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}

# Arcade Scores Table
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbscores.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bbarcade_scores;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbscores 
		ADD KEY `game_id` (`game_id`),
        ADD KEY `user_id` (`user_id`) ";
		$result=$db->sql_query($sql);
}

# Forum Search Rebuild Table
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbsearch_rebuild.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_search_rebuild;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbsearch_rebuild 
		ADD PRIMARY KEY (`rebuild_session_id`),
        ADD KEY `end_post_id` (`end_post_id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_bbsearch_rebuild MODIFY `rebuild_session_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT ";
		$result=$db->sql_query($sql);
}

# Forum Search Results Table
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbsearch_results.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_search_results;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbsearch_results 
		ADD PRIMARY KEY (`search_id`),
        ADD KEY `session_id` (`session_id`) ";
		$result=$db->sql_query($sql);
}

# Forum Search Word Lists Table
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbsearch_wordlist.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_search_word_list;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbsearch_wordlist 
		ADD PRIMARY KEY (`word_text`),
        ADD KEY `word_id` (`word_id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_bbsearch_wordlist MODIFY `word_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1914 ";
		$result=$db->sql_query($sql);
}

# Forum Words Match Table
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbsearch_wordmatch.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_search_word_match;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbsearch_wordmatch 
        ADD KEY `post_id` (`post_id`),
        ADD KEY `word_id` (`word_id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_bbsearch_wordmatch MODIFY `word_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1681 ";
		$result=$db->sql_query($sql);
}

# Forum Sessions Table
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbsessions.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_sessions;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbsessions 
        ADD PRIMARY KEY (`session_id`),
        ADD KEY `session_user_id` (`session_user_id`),
        ADD KEY `session_id_ip_user_id` (`session_id`,`session_ip`,`session_user_id`) ";
		$result=$db->sql_query($sql);
}

# Forum Sessions Keys Table
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbsessions_keys.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_sessions_keys;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
		
		$sql="ALTER TABLE ".$db_prefix."_bbsessions_keys 
        ADD PRIMARY KEY (`key_id`,`user_id`),
        ADD KEY `last_login` (`last_login`) ";
		$result=$db->sql_query($sql);
}

# Forum Stats
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbstats_config.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_stats;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
		
		$sql="ALTER TABLE ".$db_prefix."_bbstats_config 
        ADD PRIMARY KEY (`config_name`) ";
		$result=$db->sql_query($sql);
}

# Forum Stats Modules
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbstats_modules.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_stats_modules;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbstats_modules 
        ADD PRIMARY KEY (`module_id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_bbstats_modules MODIFY `module_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17 ";
		$result=$db->sql_query($sql);
}

# Forum Stats Modules Admin Panel
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbstats_module_admin_panel.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_stats_modules_admin_panel;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbstats_module_admin_panel 
        ADD PRIMARY KEY (`module_id`) ";
		$result=$db->sql_query($sql);
}

# Forum Stats Modules Cache
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbstats_module_cache.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_stats_modules_cache;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbstats_module_cache 
        ADD PRIMARY KEY (`module_id`) ";
		$result=$db->sql_query($sql);
}

# Forum Stats Modules Group Auth
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbstats_module_group_auth.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_stats_group_auth;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbstats_module_group_auth 
        ADD PRIMARY KEY (`module_id`) ";
		$result=$db->sql_query($sql);
}

# Forum Stats Modules Info
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbstats_module_info.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_stats_modules_info;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
		
		$sql="ALTER TABLE ".$db_prefix."_bbstats_module_info 
        ADD PRIMARY KEY (`module_id`) ";
		$result=$db->sql_query($sql);
}

# Forum Smilies Index
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbstats_smilies_index.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_smilies_index;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbstats_smilies_index 
        ADD PRIMARY KEY (`code`) ";
		$result=$db->sql_query($sql);
}

# Forum Smilies Info
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbstats_smilies_info.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_smilies_info;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbstats_smilies_info 
        ADD PRIMARY KEY (`last_post_id`) ";
		$result=$db->sql_query($sql);
}

# Forum Thanks Table
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbthanks.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_thanks;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbthanks 
        ADD KEY `topic_id` (`topic_id`),
        ADD KEY `user_id` (`user_id`) ";
		$result=$db->sql_query($sql);
}

# Forum Themes
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbthemes.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_themes;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbthemes 
        ADD PRIMARY KEY (`themes_id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_bbthemes MODIFY `themes_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2 ";
		$result=$db->sql_query($sql);
}

# Forum Themes Names
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbthemes_name.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_themes_names;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbthemes_name 
        ADD PRIMARY KEY (`themes_id`) ";
		$result=$db->sql_query($sql);
}

# Forum Topics
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbtopics.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_forum_topics;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
		
		$sql="ALTER TABLE ".$db_prefix."_bbtopics 
        ADD PRIMARY KEY (`topic_id`),
        ADD KEY `forum_id` (`forum_id`),
        ADD KEY `topic_moved_id` (`topic_moved_id`),
        ADD KEY `topic_status` (`topic_status`),
        ADD KEY `topic_type` (`topic_type`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_bbtopics MODIFY `topic_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24 ";
		$result=$db->sql_query($sql);
}

# Forum Topics Email
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbtopics_email.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_forum_topics_email;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbtopics_email 
        ADD KEY `topic_id` (`topic_id`),
        ADD KEY `user_id` (`user_id`) ";
		$result=$db->sql_query($sql);
}

# Forums Topic Watch
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbtopics_watch.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_forum_topics_watch;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbtopics_watch 
        ADD KEY `topic_id` (`topic_id`),
        ADD KEY `user_id` (`user_id`),
        ADD KEY `notify_status` (`notify_status`) ";
		$result=$db->sql_query($sql);
}

# Forum Topic Moved
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbtopic_moved.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_forum_topic_moved;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbtopic_moved 
        ADD PRIMARY KEY (`moved_id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_bbtopic_moved MODIFY `moved_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT ";
		$result=$db->sql_query($sql);
}

# Forum Topic View
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbtopic_view.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_forum_topic_viewed;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbtopic_view 
        ADD KEY `topic_id` (`topic_id`),
        ADD KEY `user_id` (`user_id`) ";
		$result=$db->sql_query($sql);
}

# Forum User Groups
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbuser_group.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_user_groups;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbuser_group 
        ADD KEY `group_id` (`group_id`),
        ADD KEY `user_id` (`user_id`) ";
		$result=$db->sql_query($sql);
}

# Forum Vote Description
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbvote_desc.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_vote_description;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbvote_desc 
        ADD PRIMARY KEY (`vote_id`),
        ADD KEY `topic_id` (`topic_id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_bbvote_desc MODIFY `vote_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT ";
		$result=$db->sql_query($sql);
}

# Forum Vote Results
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbvote_results.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_vote_results;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbvote_results 
        ADD KEY `vote_option_id` (`vote_option_id`),
        ADD KEY `vote_id` (`vote_id`) ";
		$result=$db->sql_query($sql);
}

# Forum Voters
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbvote_voters.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_voters;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbvote_voters 
        ADD KEY `vote_id` (`vote_id`),
        ADD KEY `vote_user_id` (`vote_user_id`),
        ADD KEY `vote_user_ip` (`vote_user_ip`),
        ADD KEY `vote_cast` (`vote_cast`) ";
		$result=$db->sql_query($sql);
}

# Forum Filtered Words
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbwords.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_filtered_words;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbwords 
        ADD PRIMARY KEY (`word_id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_bbwords MODIFY `word_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2 ";
		$result=$db->sql_query($sql);
}

# Forums XDATA Auth
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbxdata_auth.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_xdata_auth;
        if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
		
		$sql="ALTER TABLE ".$db_prefix."_bbxdata_auth 
        ADD KEY `field_id` (`field_id`),
        ADD KEY `group_id` (`group_id`) ";
		$result=$db->sql_query($sql);
}

# Forums XDATA Data
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbxdata_data.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_xdata_data;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbxdata_data 
        ADD KEY `field_id` (`field_id`),
        ADD KEY `user_id` (`user_id`) ";
		$result=$db->sql_query($sql);
}

# Forums XDATA Fields
if ($can_proceed) {
        $fp = fopen("sql/nuke_bbxdata_fields.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_bb_xdata_fields;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bbxdata_fields 
        ADD PRIMARY KEY (`field_id`),
        ADD UNIQUE KEY `code_name` (`code_name`) ";
		$result=$db->sql_query($sql);
}

# Titanium Blocks
if ($can_proceed) {
        $fp = fopen("sql/nuke_blocks.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_blocks;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_blocks 
        ADD PRIMARY KEY (`bid`),
        ADD KEY `title` (`title`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_blocks MODIFY `bid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27 ";
		$result=$db->sql_query($sql);
}

# Titanium Blogs
if ($can_proceed) {
        $fp = fopen("sql/nuke_blogs.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_blogs;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_blogs 
        ADD PRIMARY KEY (`sid`),
        ADD KEY `catid` (`catid`),
        ADD KEY `counter` (`counter`),
        ADD KEY `topic` (`topic`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_blogs MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61 ";
		$result=$db->sql_query($sql);
}

# Titanium Auto Blogs
if ($can_proceed) {
        $fp = fopen("sql/nuke_blogs_autoblog.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_auto_blogs;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_blogs_autoblog 
        ADD PRIMARY KEY (`anid`),
        ADD UNIQUE KEY `anid` (`anid`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_blogs_autoblog MODIFY `anid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT ";
		$result=$db->sql_query($sql);
}

# Titanium Blogs Categories
if ($can_proceed) {
        $fp = fopen("sql/nuke_blogs_cat.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_blog_categories;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_blogs_cat 
        ADD PRIMARY KEY (`catid`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_blogs_cat MODIFY `catid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15 ";
		$result=$db->sql_query($sql);
}

# Titanium Blogs Comments
if ($can_proceed) {
        $fp = fopen("sql/nuke_blogs_comments.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_blog_comments;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_blogs_comments 
        ADD PRIMARY KEY (`tid`),
        ADD KEY `pid` (`pid`),
        ADD KEY `sid` (`sid`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_blogs_comments MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37 ";
		$result=$db->sql_query($sql);
}

# Titanium Blogs Queue
if ($can_proceed) {
        $fp = fopen("sql/nuke_blogs_queue.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_blogs_queue;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_blogs_queue 
        ADD PRIMARY KEY (`qid`),
        ADD KEY `uid` (`uid`),
        ADD KEY `uname` (`uname`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_blogs_queue MODIFY `qid` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1 ";
		$result=$db->sql_query($sql);
}

# Tianium Blogs Topics
if ($can_proceed) {
        $fp = fopen("sql/nuke_blogs_topics.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_blogs_topics;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_blogs_topics 
        ADD PRIMARY KEY (`topicid`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_blogs_topics MODIFY `topicid` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11 ";
		$result=$db->sql_query($sql);
}

# Titanium Bookmarks
if ($can_proceed) {
        $fp = fopen("sql/nuke_bookmarks.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_bookmarks;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bookmarks 
        ADD PRIMARY KEY (`id`),
        ADD KEY `user_id` (`user_id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_bookmarks MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3 ";
		$result=$db->sql_query($sql);
}

# Titanium Bookmarks Categories
if ($can_proceed) {
        $fp = fopen("sql/nuke_bookmarks_cat.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_bookmarks_categories;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_bookmarks_cat 
        ADD PRIMARY KEY (`category_id`),
        ADD KEY `user_id` (`user_id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_bookmarks_cat MODIFY `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3 ";
		$result=$db->sql_query($sql);
}

# Titanium Cemetery
if ($can_proceed) {
        $fp = fopen("sql/nuke_cemetery.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_cemetery;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_cemetery 
        ADD PRIMARY KEY (`id`),
        ADD KEY `user_id` (`user_id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_cemetery MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1 ";
		$result=$db->sql_query($sql);
}

# Titanium Cemetery Categories
if ($can_proceed) {
        $fp = fopen("sql/nuke_cemetery_cat.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_cemetery_categories;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_cemetery_cat 
        ADD PRIMARY KEY (`category_id`),
        ADD KEY `user_id` (`user_id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_cemetery_cat MODIFY `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1 ";
		$result=$db->sql_query($sql);
}

# Titanium Your Account Config
if ($can_proceed) {
        $fp = fopen("sql/nuke_cnbya_config.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_your_account;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_cnbya_config 
        ADD UNIQUE KEY `config_name` (`config_name`) ";
		$result=$db->sql_query($sql);
}

# Titanium Your Account Fields
if ($can_proceed) {
        $fp = fopen("sql/nuke_cnbya_field.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_your_account_fields;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_cnbya_field 
        ADD PRIMARY KEY (`fid`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_cnbya_field MODIFY `fid` int(10) NOT NULL AUTO_INCREMENT ";
		$result=$db->sql_query($sql);
}

# Titanium Your Account Values
if ($can_proceed) {
        $fp = fopen("sql/nuke_cnbya_value.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_your_account_value;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_cnbya_value 
        ADD PRIMARY KEY (`vid`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_cnbya_value MODIFY `vid` int(10) NOT NULL AUTO_INCREMENT ";
		$result=$db->sql_query($sql);
}

# Titanium Your Account Temp
if ($can_proceed) {
        $fp = fopen("sql/nuke_cnbya_value_temp.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_your_account_value_temp;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_cnbya_value_temp 
        ADD PRIMARY KEY (`vid`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_cnbya_value_temp MODIFY `vid` int(10) NOT NULL AUTO_INCREMENT ";
		$result=$db->sql_query($sql);
}

# This needs to be processed last (Main Config)
if ($can_proceed) {
        $fp = fopen("sql/nuke_config.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_nuke_config;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_config 
        ADD UNIQUE KEY `Version_Num` (`Version_Num`) ";
		$result=$db->sql_query($sql);
}

# Titanium Confirm
if ($can_proceed) {
        $fp = fopen("sql/nuke_confirm.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_nuke_confirm;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_confirm 
        ADD PRIMARY KEY (`session_id`,`confirm_id`) ";
		$result=$db->sql_query($sql);
}

# Titanium Counter
if ($can_proceed) {
        $fp = fopen("sql/nuke_counter.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_nuke_counter;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_counter 
        ADD KEY `var` (`var`) ";
		$result=$db->sql_query($sql);
}

# Titanium Donaters
if ($can_proceed) {
        $fp = fopen("sql/nuke_donators.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_donaters;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_donators 
        ADD PRIMARY KEY (`id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_donators MODIFY `id` int(11) NOT NULL AUTO_INCREMENT ";
		$result=$db->sql_query($sql);
}

# Titanium Donaters Config
if ($can_proceed) {
        $fp = fopen("sql/nuke_donators_config.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_donaters_config;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_donators_config 
        ADD PRIMARY KEY (`config_name`) ";
		$result=$db->sql_query($sql);
}

# Evo eCalendar
if ($can_proceed) {
        $fp = fopen("sql/nuke_ecalendar.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_evo_ecalendar;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_ecalendar 
        ADD PRIMARY KEY (`eid`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_ecalendar MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT ";
		$result=$db->sql_query($sql);
}

# Titanium Config
if ($can_proceed) {
        $fp = fopen("sql/nuke_evolution.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_config;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_evolution 
        ADD PRIMARY KEY (`evo_field`) ";
		$result=$db->sql_query($sql);
}

#Evo User Block/Module
if ($can_proceed) {
        $fp = fopen("sql/nuke_evo_userinfo.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_evo_userblock;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_evo_userinfo 
        ADD KEY `active` (`active`),
        ADD KEY `position` (`position`) ";
		$result=$db->sql_query($sql);
}

#Evo User Block/Module Addons
if ($can_proceed) {
        $fp = fopen("sql/nuke_evo_userinfo_addons.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_evo_userblock_addons;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_evo_userinfo_addons 
        ADD PRIMARY KEY (`name`) ";
		$result=$db->sql_query($sql);
}

# Titanium FAQ
if ($can_proceed) {
        $fp = fopen("sql/nuke_faqanswer.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_faq;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_faqanswer 
        ADD PRIMARY KEY (`id`),
        ADD KEY `id_cat` (`id_cat`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_faqanswer MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1 ";
		$result=$db->sql_query($sql);
}

# Titanium FAQ Categories
if ($can_proceed) {
        $fp = fopen("sql/nuke_faqcategories.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_faq_categories;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_faqcategories 
        ADD PRIMARY KEY (`id_cat`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_faqcategories MODIFY `id_cat` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1 ";
		$result=$db->sql_query($sql);
}

# File Respository Categories
if ($can_proceed) {
        $fp = fopen("sql/nuke_file_repository_categories.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_file_repository_categories;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_file_repository_categories 
        ADD PRIMARY KEY (`cid`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_file_repository_categories MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT ";
		$result=$db->sql_query($sql);
}

# File Respository Comments
if ($can_proceed) {
        $fp = fopen("sql/nuke_file_repository_comments.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_file_repository_comments;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_file_repository_comments 
        ADD PRIMARY KEY (`cid`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_file_repository_comments MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT ";
		$result=$db->sql_query($sql);
}

# File Respository Files
if ($can_proceed) {
        $fp = fopen("sql/nuke_file_repository_files.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_file_repository_files;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_file_repository_files 
        ADD PRIMARY KEY (`fid`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_file_repository_files MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT ";
		$result=$db->sql_query($sql);
}

# File Respository Items
if ($can_proceed) {
        $fp = fopen("sql/nuke_file_repository_items.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_file_repository_items;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_file_repository_items 
        ADD PRIMARY KEY (`did`),
        ADD KEY `cid` (`cid`),
        ADD KEY `title` (`title`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_file_repository_items MODIFY `did` int(11) NOT NULL AUTO_INCREMENT ";
		$result=$db->sql_query($sql);
}

# File Respository Screen Shots
if ($can_proceed) {
        $fp = fopen("sql/nuke_file_repository_screenshots.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_file_repository_screenshots;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_file_repository_screenshots 
        ADD PRIMARY KEY (`pid`),
        ADD KEY `did` (`did`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_file_repository_screenshots MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT ";
		$result=$db->sql_query($sql);
}

# File Respository Settings
if ($can_proceed) {
        $fp = fopen("sql/nuke_file_repository_settings.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_file_repository_settings;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_file_repository_settings 
        ADD PRIMARY KEY (`config_name`) ";
		$result=$db->sql_query($sql);
}

# File Respository Themes
if ($can_proceed) {
        $fp = fopen("sql/nuke_file_repository_themes.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_file_repository_themes;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_file_repository_themes 
        ADD PRIMARY KEY (`theme_name`) ";
		$result=$db->sql_query($sql);
}

# Titanium Headlines
if ($can_proceed) {
        $fp = fopen("sql/nuke_headlines.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_headlines;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_headlines 
        ADD PRIMARY KEY (`hid`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_headlines MODIFY `hid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1 ";
		$result=$db->sql_query($sql);
}

# Evo News Letter Categories
if ($can_proceed) {
        $fp = fopen("sql/nuke_hnl_categories.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_evo_news_letter_categories;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_hnl_categories 
        ADD PRIMARY KEY (`cid`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_hnl_categories MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4 ";
		$result=$db->sql_query($sql);
}

# Evo News Letter Config
if ($can_proceed) {
        $fp = fopen("sql/nuke_hnl_cfg.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_evo_news_letter_config;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_hnl_cfg 
        ADD PRIMARY KEY (`cfg_nm`) ";
		$result=$db->sql_query($sql);
}

# Evo News Letters
if ($can_proceed) {
        $fp = fopen("sql/nuke_hnl_newsletters.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_evo_news_letters;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_hnl_newsletters 
        ADD PRIMARY KEY (`nid`),
        ADD KEY `cid` (`cid`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_hnl_newsletters MODIFY `nid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3 ";
		$result=$db->sql_query($sql);
}

# Nuke Honey Pot
if ($can_proceed) {
        $fp = fopen("sql/nuke_honeypot.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_honey_pot;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_honeypot 
        ADD UNIQUE KEY `id` (`id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_honeypot MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4 ";
		$result=$db->sql_query($sql);
}

# Nuke Honey Pot Config
if ($can_proceed) {
        $fp = fopen("sql/nuke_honeypot_config.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_honey_pot_config;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_honeypot_config 
        ADD UNIQUE KEY `version` (`version`) ";
		$result=$db->sql_query($sql);
}

# Nuke IMage Repository Settings
if ($can_proceed) {
        $fp = fopen("sql/nuke_image_repository_settings.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_image_repository_settings;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_image_repository_settings 
        ADD PRIMARY KEY (`config_name`) ";
		$result=$db->sql_query($sql);
}

# Nuke Image Repository Uploads
if ($can_proceed) {
        $fp = fopen("sql/nuke_image_repository_uploads.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_image_repository_uploads;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_image_repository_uploads 
        ADD PRIMARY KEY (`pid`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_image_repository_uploads MODIFY `pid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1 ";
		$result=$db->sql_query($sql);
}

# Nuke Image Repository Users
if ($can_proceed) {
        $fp = fopen("sql/nuke_image_repository_users.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_image_repository_users;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_image_repository_users 
        ADD PRIMARY KEY (`uid`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_image_repository_users MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21 ";
		$result=$db->sql_query($sql);
}

# Nuke Google Sitemap
if ($can_proceed) {
        $fp = fopen("sql/nuke_jmap.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_google_site_map;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_jmap 
        ADD PRIMARY KEY (`name`) ";
		$result=$db->sql_query($sql);
}

# Nuke Web Links Categories
if ($can_proceed) {
        $fp = fopen("sql/nuke_links_categories.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_web_links_categories;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_links_categories 
        ADD PRIMARY KEY (`cid`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_links_categories MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15 ";
		$result=$db->sql_query($sql);
}

# Nuke Web Links Editorials
if ($can_proceed) {
        $fp = fopen("sql/nuke_links_editorials.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_web_links_editorials;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_links_editorials 
        ADD PRIMARY KEY (`linkid`) ";
		$result=$db->sql_query($sql);
}

# Nuke Web Links Main
if ($can_proceed) {
        $fp = fopen("sql/nuke_links_links.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_web_links_main;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_links_links 
        ADD PRIMARY KEY (`lid`),
        ADD KEY `cid` (`cid`),
        ADD KEY `sid` (`sid`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_links_links MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14 ";
		$result=$db->sql_query($sql);
}

# Nuke Web Links Mod Requests
if ($can_proceed) {
        $fp = fopen("sql/nuke_links_modrequest.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_web_links_mod_requests;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_links_modrequest 
        ADD PRIMARY KEY (`requestid`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_links_modrequest MODIFY `requestid` int(11) NOT NULL AUTO_INCREMENT ";
		$result=$db->sql_query($sql);
}

# Nuke Web Links New Link
if ($can_proceed) {
        $fp = fopen("sql/nuke_links_newlink.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_web_links_new_link;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_links_newlink 
        ADD PRIMARY KEY (`lid`),
        ADD KEY `cid` (`cid`),
        ADD KEY `sid` (`sid`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_links_newlink MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1 ";
		$result=$db->sql_query($sql);
}

# Nuke Web Links Vote Data
if ($can_proceed) {
        $fp = fopen("sql/nuke_links_votedata.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_web_links_vote_data;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_links_votedata 
        ADD PRIMARY KEY (`ratingdbid`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_links_votedata MODIFY `ratingdbid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1 ";
		$result=$db->sql_query($sql);
}

# Titanium Link Us
if ($can_proceed) {
        $fp = fopen("sql/nuke_link_us.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_link_us;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_link_us 
        ADD PRIMARY KEY (`id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_link_us MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11 ";
		$result=$db->sql_query($sql);
}

# Titanium Link Us Config
if ($can_proceed) {
        $fp = fopen("sql/nuke_link_us_config.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_link_us_config;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_link_us_config 
        ADD KEY `my_image` (`my_image`) ";
		$result=$db->sql_query($sql);
}

# Titanium Main
if ($can_proceed) {
        $fp = fopen("sql/nuke_main.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_main;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_main 
        ADD KEY `main_module` (`main_module`) ";
		$result=$db->sql_query($sql);
}

# Titanium Menu
if ($can_proceed) {
        $fp = fopen("sql/nuke_menu.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_menu;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_menu 
        ADD PRIMARY KEY (`groupmenu`) ";
		$result=$db->sql_query($sql);
}

# Titanium Menu Categories
if ($can_proceed) {
        $fp = fopen("sql/nuke_menu_categories.sql","r");
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_menu_categories;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_menu_categories 
        ADD PRIMARY KEY (`id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_menu_categories MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3624 ";
		$result=$db->sql_query($sql);
}

# Titanium Messages
if ($can_proceed) {
        $fp = fopen("sql/nuke_message.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_messages;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_message 
        ADD PRIMARY KEY (`mid`),
        ADD UNIQUE KEY `mid` (`mid`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_message MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4 ";
		$result=$db->sql_query($sql);
}

# Titanium Meta
if ($can_proceed) {
        $fp = fopen("sql/nuke_meta.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_meta_tags;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_meta 
        ADD PRIMARY KEY (`meta_name`) ";
		$result=$db->sql_query($sql);
}

# Tianium Modules
if ($can_proceed) {
        $fp = fopen("sql/nuke_modules.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_modules;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_modules 
        ADD PRIMARY KEY (`mid`),
        ADD UNIQUE KEY `mid` (`mid`),
        ADD KEY `title` (`title`),
        ADD KEY `custom_title` (`custom_title`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_modules MODIFY `mid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47 ";
		$result=$db->sql_query($sql);
}

# Tianium Modules Categories
if ($can_proceed) {
        $fp = fopen("sql/nuke_modules_cat.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_modules_categories;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_modules_cat 
        ADD PRIMARY KEY (`cid`),
        ADD UNIQUE KEY `cid` (`cid`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_modules_cat MODIFY `cid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8 ";
		$result=$db->sql_query($sql);
}

# Tianium Modules Links
if ($can_proceed) {
        $fp = fopen("sql/nuke_modules_links.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_modules_links;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_modules_links 
        ADD PRIMARY KEY (`lid`),
        ADD UNIQUE KEY `lid` (`lid`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_modules_links MODIFY `lid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3 ";
		$result=$db->sql_query($sql);
}

# Forums Most Online
if ($can_proceed) {
        $fp = fopen("sql/nuke_mostonline.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_nuke_mostonline;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_mostonline 
        ADD PRIMARY KEY (`total`) ";
		$result=$db->sql_query($sql);
}

# Nuke Center Blocks
if ($can_proceed) {
        $fp = fopen("sql/nuke_nsncb_blocks.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_nuke_center_blocks;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_nsncb_blocks 
        ADD PRIMARY KEY (`rid`),
        ADD UNIQUE KEY `rid` (`rid`) ";
		$result=$db->sql_query($sql);
}

# Nuke Center Blocks Config
if ($can_proceed) {
        $fp = fopen("sql/nuke_nsncb_config.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_nuke_center_blocks_config;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_nsncb_config 
        ADD PRIMARY KEY (`cgid`),
        ADD UNIQUE KEY `cfgid` (`cgid`) ";
		$result=$db->sql_query($sql);
}

# Titanium Blogs Config
if ($can_proceed) {
        $fp = fopen("sql/nuke_blogs_config.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_blogs_config;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_blogs_config 
        ADD UNIQUE KEY `config_name` (`config_name`) ";
		$result=$db->sql_query($sql);
}

# Titanium Supporters Config 
if ($can_proceed) {
        $fp = fopen("sql/nuke_nsnsp_config.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_supporters_config;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_nsnsp_config 
        ADD UNIQUE KEY `config_name` (`config_name`) ";
		$result=$db->sql_query($sql);
}

# Titanium Supporters Sites 
if ($can_proceed) {
        $fp = fopen("sql/nuke_nsnsp_sites.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_supporters_sites;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_nsnsp_sites 
        ADD PRIMARY KEY (`site_id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_nsnsp_sites MODIFY `site_id` int(11) NOT NULL AUTO_INCREMENT ";
		$result=$db->sql_query($sql);
}

# Nuke Sentinel Admins
if ($can_proceed) {
        $fp = fopen("sql/nuke_nsnst_admins.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_nuke_sentienl_admins;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_nsnst_admins 
        ADD PRIMARY KEY (`aid`),
        ADD KEY `password_md5` (`password_md5`) ";
		$result=$db->sql_query($sql);
}

# Nuke Sentinel Blocked IP's
if ($can_proceed) {
        $fp = fopen("sql/nuke_nsnst_blocked_ips.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_nuke_sentienl_blocked_ips;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_nsnst_blocked_ips 
        ADD PRIMARY KEY (`ip_addr`),
        ADD KEY `ip_long` (`ip_long`) ";
		$result=$db->sql_query($sql);
}

# Nuke Sentinel Blocked Ranges
if ($can_proceed) {
        $fp = fopen("sql/nuke_nsnst_blocked_ranges.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_nuke_sentienl_blocked_ranges;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_nsnst_blocked_ranges 
        ADD KEY `code` (`ip_lo`,`ip_hi`,`c2c`) ";
		$result=$db->sql_query($sql);
}

# Nuke Sentinel Blockers
if ($can_proceed) {
        $fp = fopen("sql/nuke_nsnst_blockers.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_nuke_sentienl_blockers;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_nsnst_blockers 
        ADD PRIMARY KEY (`blocker`) ";
		$result=$db->sql_query($sql);
}

# Nuke Sentinel CIDRS
if ($can_proceed) {
        $fp = fopen("sql/nuke_nsnst_cidrs.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_nuke_sentienl_cidrs;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_nsnst_cidrs 
        ADD PRIMARY KEY (`cidr`) ";
		$result=$db->sql_query($sql);
}

# Nuke Sentinel Config
if ($can_proceed) {
        $fp = fopen("sql/nuke_nsnst_config.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_nuke_sentienl_config;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_nsnst_config 
        ADD PRIMARY KEY (`config_name`) ";
		$result=$db->sql_query($sql);
}

# Nuke Sentinel Coutries
if ($can_proceed) {
        $fp = fopen("sql/nuke_nsnst_countries.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_nuke_sentienl_countries;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_nsnst_countries 
        ADD KEY `c2c` (`c2c`) ";
		$result=$db->sql_query($sql);
}

# Nuke Sentinel Excluded Ranges
if ($can_proceed) {
        $fp = fopen("sql/nuke_nsnst_excluded_ranges.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_nuke_sentienl_excluded_ranges;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_nsnst_excluded_ranges 
        ADD KEY `code` (`ip_lo`,`ip_hi`,`c2c`) ";
		$result=$db->sql_query($sql);
}

# Nuke Sentinel Harvesters
if ($can_proceed) {
        $fp = fopen("sql/nuke_nsnst_harvesters.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_nuke_sentienl_harvesters;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_nsnst_harvesters 
        ADD PRIMARY KEY (`harvester`),
        ADD KEY `hid` (`hid`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_nsnst_harvesters MODIFY `hid` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221 ";
		$result=$db->sql_query($sql);
}

# Nuke Sentinel ip2 Country (No Keys)
if ($can_proceed) {
        $fp = fopen("sql/nuke_nsnst_ip2country.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_nuke_sentienl_ip2_country;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);
}

# Nuke Sentinel Protected Ranges
if ($can_proceed) {
        $fp = fopen("sql/nuke_nsnst_protected_ranges.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_nuke_sentienl_protected_ranges;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
				echo "<font class=\"ok\">OK</font>";
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_nsnst_protected_ranges 
        ADD KEY `code` (`ip_lo`,`ip_hi`,`c2c`) ";
		$result=$db->sql_query($sql);
}

# Nuke Sentinel Referers
if ($can_proceed) {
        $fp = fopen("sql/nuke_nsnst_referers.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_nuke_sentienl_referers;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_nsnst_referers 
        ADD PRIMARY KEY (`referer`),
        ADD KEY `rid` (`rid`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_nsnst_referers MODIFY `rid` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=494 ";
		$result=$db->sql_query($sql);
}

# Nuke Sentinel Strings
if ($can_proceed) {
        $fp = fopen("sql/nuke_nsnst_strings.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_nuke_sentienl_strings;
         if (!empty($installscript) || $installscript != "")
		 {
		   if(!$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
           } 
		 }
	     else echo "<font class=\"ok\">OK</font>";
        
		echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_nsnst_strings 
        ADD KEY `string` (`string`) ";
		$result=$db->sql_query($sql);
}

# Nuke Sentinel Tracked IPs
if ($can_proceed) {
        $fp = fopen("sql/nuke_nsnst_tracked_ips.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_nuke_sentienl_tracked_ips;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_nsnst_tracked_ips 
        ADD PRIMARY KEY (`tid`),
        ADD KEY `maintracking` (`ip_addr`,`ip_long`),
        ADD KEY `ip_addr` (`ip_addr`),
        ADD KEY `ip_long` (`ip_long`),
        ADD KEY `user_id` (`user_id`),
        ADD KEY `username` (`username`),
        ADD KEY `user_agent` (`user_agent`(255)),
        ADD KEY `refered_from` (`refered_from`(255)),
        ADD KEY `date` (`date`),
        ADD KEY `page` (`page`(255)),
        ADD KEY `c2c` (`c2c`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_nsnst_tracked_ips MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1 ";
		$result=$db->sql_query($sql);
}

# Titanium Pages
if ($can_proceed) {
        $fp = fopen("sql/nuke_pages.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_pages;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_pages 
        ADD PRIMARY KEY (`pid`),
        ADD KEY `cid` (`cid`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_pages MODIFY `pid` int(10) NOT NULL AUTO_INCREMENT ";
		$result=$db->sql_query($sql);
}

# Titanium Pages Categories
if ($can_proceed) {
        $fp = fopen("sql/nuke_pages_categories.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_pages_categories;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_pages_categories 
        ADD PRIMARY KEY (`cid`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_pages_categories MODIFY `cid` int(10) NOT NULL AUTO_INCREMENT ";
		$result=$db->sql_query($sql);
}

# Titanium Poll Comments
if ($can_proceed) {
        $fp = fopen("sql/nuke_pollcomments.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_poll_comments;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_pollcomments 
        ADD PRIMARY KEY (`tid`),
        ADD KEY `pid` (`pid`),
        ADD KEY `pollID` (`pollID`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_pollcomments MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT ";
		$result=$db->sql_query($sql);
}

# Titanium Poll Check
if ($can_proceed) {
        $fp = fopen("sql/nuke_poll_check.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_poll_check;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_poll_check 
        ADD PRIMARY KEY (`ip`),
        ADD KEY `time` (`time`),
        ADD KEY `pollID` (`pollID`) ";
		$result=$db->sql_query($sql);
}

# Titanium Poll Data
if ($can_proceed) {
        $fp = fopen("sql/nuke_poll_data.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_poll_data;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_poll_data 
        ADD KEY `voteID` (`voteID`),
        ADD KEY `pollID` (`pollID`) ";
		$result=$db->sql_query($sql);
}

# Titanium Poll Description
if ($can_proceed) {
        $fp = fopen("sql/nuke_poll_desc.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_poll_description;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_poll_desc 
        ADD PRIMARY KEY (`pollID`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_poll_desc MODIFY `pollID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2 ";
		$result=$db->sql_query($sql);
}

# Titanium Quotes
if ($can_proceed) {
        $fp = fopen("sql/nuke_quotes.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_quotes;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_quotes 
        ADD PRIMARY KEY (`qid`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_quotes MODIFY `qid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2 ";
		$result=$db->sql_query($sql);
}

# Titanium Referers
if ($can_proceed) {
        $fp = fopen("sql/nuke_referer.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_referers;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

        $sql="ALTER TABLE ".$db_prefix."_referer 
        ADD PRIMARY KEY (`url`),
        ADD KEY `lasttime` (`lasttime`) ";
		$result=$db->sql_query($sql);
}

# Titanium Related
if ($can_proceed) {
        $fp = fopen("sql/nuke_related.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_related;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_related 
        ADD PRIMARY KEY (`rid`),
        ADD KEY `tid` (`tid`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_related MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT ";
		$result=$db->sql_query($sql);
}

# Titanium Reviews
if ($can_proceed) {
        $fp = fopen("sql/nuke_reviews.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_reviews;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_reviews 
        ADD PRIMARY KEY (`id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_reviews MODIFY `id` int(10) NOT NULL AUTO_INCREMENT ";
		$result=$db->sql_query($sql);
}

# Titanium Reviews Add
if ($can_proceed) {
        $fp = fopen("sql/nuke_reviews_add.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_reviews_add;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_reviews_add 
        ADD PRIMARY KEY (`id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_reviews_add MODIFY `id` int(10) NOT NULL AUTO_INCREMENT ";
		$result=$db->sql_query($sql);
}

# Titanium Reviews Comments
if ($can_proceed) {
        $fp = fopen("sql/nuke_reviews_comments.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_reviews_comments;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_reviews_comments 
        ADD PRIMARY KEY (`cid`),
        ADD KEY `rid` (`rid`),
        ADD KEY `userid` (`userid`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_reviews_comments MODIFY `cid` int(10) NOT NULL AUTO_INCREMENT ";
		$result=$db->sql_query($sql);
}

# Titanium Reviews Main
if ($can_proceed) {
        $fp = fopen("sql/nuke_reviews_main.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_reviews_main;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_reviews_main 
        ADD KEY `title` (`title`) ";
		$result=$db->sql_query($sql);
}

# Titanium Security Agents
if ($can_proceed) {
        $fp = fopen("sql/nuke_security_agents.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_security_agents;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_security_agents 
        ADD PRIMARY KEY (`agent_name`) ";
		$result=$db->sql_query($sql);
}

# Titanium Sessions
if ($can_proceed) {
        $fp = fopen("sql/nuke_session.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_sessions;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_session 
        ADD PRIMARY KEY (`uname`),
        ADD KEY `time` (`time`),
        ADD KEY `guest` (`guest`) ";
		$result=$db->sql_query($sql);
}

# Titanium ShoutBox Censor
if ($can_proceed) {
        $fp = fopen("sql/nuke_shoutbox_censor.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_shoutbox_censor;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_shoutbox_censor 
        ADD PRIMARY KEY (`id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_shoutbox_censor MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140 ";
		$result=$db->sql_query($sql);
}

# Titanium ShoutBox Conf
if ($can_proceed) {
        $fp = fopen("sql/nuke_shoutbox_conf.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_shoutbox_config;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_shoutbox_conf 
        ADD PRIMARY KEY (`id`) ";
		$result=$db->sql_query($sql);
}

# Titanium ShoutBox Date
if ($can_proceed) {
        $fp = fopen("sql/nuke_shoutbox_date.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_shoutbox_date;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_shoutbox_date 
        ADD PRIMARY KEY (`id`) ";
		$result=$db->sql_query($sql);
}

# Titanium ShoutBox Emoticons
if ($can_proceed) {
        $fp = fopen("sql/nuke_shoutbox_emoticons.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_shoutbox_emoticons;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_shoutbox_emoticons 
        ADD PRIMARY KEY (`id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_shoutbox_emoticons MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58 ";
		$result=$db->sql_query($sql);
}

# Titanium ShoutBox IP Block
if ($can_proceed) {
        $fp = fopen("sql/nuke_shoutbox_ipblock.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_shoutbox_ip_block;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
				echo "<font class=\"ok\">OK</font>";
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_shoutbox_ipblock 
        ADD PRIMARY KEY (`id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_shoutbox_ipblock MODIFY `id` int(9) NOT NULL AUTO_INCREMENT ";
		$result=$db->sql_query($sql);
}

# Titanium ShoutBox Manage Count
if ($can_proceed) {
        $fp = fopen("sql/nuke_shoutbox_manage_count.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_shoutbox_manage_count;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_shoutbox_manage_count 
        ADD PRIMARY KEY (`id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_shoutbox_manage_count MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4 ";
		$result=$db->sql_query($sql);
}

# Titanium ShoutBox Name Block
if ($can_proceed) {
        $fp = fopen("sql/nuke_shoutbox_nameblock.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_shoutbox_name_block;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_shoutbox_nameblock 
        ADD PRIMARY KEY (`id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_shoutbox_nameblock MODIFY `id` int(9) NOT NULL AUTO_INCREMENT ";
		$result=$db->sql_query($sql);
}

# Titanium ShoutBox Shouts
if ($can_proceed) {
        $fp = fopen("sql/nuke_shoutbox_shouts.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_shoutbox_shouts;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_shoutbox_shouts 
        ADD PRIMARY KEY (`id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_shoutbox_shouts MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2 ";
		$result=$db->sql_query($sql);
}

# Titanium ShoutBox Sticky Shouts
if ($can_proceed) {
        $fp = fopen("sql/nuke_shoutbox_sticky.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_shoutbox_sticky_shouts;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_shoutbox_sticky 
        ADD PRIMARY KEY (`id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_shoutbox_sticky MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1 ";
		$result=$db->sql_query($sql);
}

# Titanium ShoutBox Themes
if ($can_proceed) {
        $fp = fopen("sql/nuke_shoutbox_themes.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_shoutbox_themes;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_shoutbox_themes 
        ADD PRIMARY KEY (`id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_shoutbox_themes MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4 ";
		$result=$db->sql_query($sql);
}

# Titanium ShoutBox Themes Images
if ($can_proceed) {
        $fp = fopen("sql/nuke_shoutbox_theme_images.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_shoutbox_themes_images;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_shoutbox_theme_images 
        ADD PRIMARY KEY (`id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_shoutbox_theme_images MODIFY `id` int(9) NOT NULL AUTO_INCREMENT ";
		$result=$db->sql_query($sql);
}

# Titanium ShoutBox Version
if ($can_proceed) {
        $fp = fopen("sql/nuke_shoutbox_version.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_shoutbox_version;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_shoutbox_version 
        ADD PRIMARY KEY (`id`) ";
		$result=$db->sql_query($sql);
}

# Titanium Sommaire
if ($can_proceed) {
        $fp = fopen("sql/nuke_sommaire.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_sommaire;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_sommaire 
        ADD PRIMARY KEY (`groupmenu`) ";
		$result=$db->sql_query($sql);
}

# Titanium Sommaire Categories
if ($can_proceed) {
        $fp = fopen("sql/nuke_sommaire_categories.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_sommaire_categories;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_sommaire_categories 
        ADD PRIMARY KEY (`id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_sommaire_categories MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18 ";
		$result=$db->sql_query($sql);
}

# Titanium Stats Hour
if ($can_proceed) {
        $fp = fopen("sql/nuke_stats_hour.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_stats_hour;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
				echo "<font class=\"ok\">OK</font>";
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_stats_hour 
        ADD KEY `year` (`year`),
        ADD KEY `date` (`date`) ";
		$result=$db->sql_query($sql);
}

# Titanium Subscriptions
if ($can_proceed) {
        $fp = fopen("sql/nuke_subscriptions.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_subscriptions;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_subscriptions 
        ADD PRIMARY KEY (`id`,`userid`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_subscriptions MODIFY `id` int(10) NOT NULL AUTO_INCREMENT ";
		$result=$db->sql_query($sql);
}

# Titanium Themes
if ($can_proceed) {
        $fp = fopen("sql/nuke_themes.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_themes;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_themes 
        ADD PRIMARY KEY (`theme_name`) ";
		$result=$db->sql_query($sql);
}

# Titanium Users
if ($can_proceed) {
        $fp = fopen("sql/nuke_users.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_users;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_users 
        ADD PRIMARY KEY (`user_id`),
        ADD KEY `uname` (`username`),
        ADD KEY `user_session_time` (`user_session_time`),
        ADD KEY `user_birthday` (`user_birthday`),
        ADD KEY `user_birthday2` (`user_birthday2`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_users MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2 ";
		$result=$db->sql_query($sql);
}

# Titanium Users Countries
if ($can_proceed) {
        $fp = fopen("sql/nuke_users_countries.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_users_countries;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_users_countries 
        ADD PRIMARY KEY (`id_country`),
        ADD KEY `IDX_NAME` (`name`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_users_countries MODIFY `id_country` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240 ";
		$result=$db->sql_query($sql);
}

# Titanium Users Temp
if ($can_proceed) {
        $fp = fopen("sql/nuke_users_temp.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_users_temp;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_users_temp 
        ADD PRIMARY KEY (`user_id`) ";
		$result=$db->sql_query($sql);
		$sql="ALTER TABLE ".$db_prefix."_users_temp MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT ";
		$result=$db->sql_query($sql);
}

# Titanium Center Last Visitors
if ($can_proceed) {
        $fp = fopen("sql/nuke_users_who_been.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_center_last_visitors;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_users_who_been 
        ADD PRIMARY KEY (`user_ID`) ";
		$result=$db->sql_query($sql);
}

# Titanium Welcome PM
if ($can_proceed) {
        $fp = fopen("sql/nuke_welcome_pm.sql","r"); 
        $installscript = "";
        while (!feof($fp)) $installscript .= fgets($fp,1000);
        fclose($fp);
        unset($fp);
        $installscript = str_replace("#prefix#",$db_prefix,$installscript);
        echo "<p>"._sql_titanium_welcome_pm;
         if (!empty($installscript) && !$db->sql_query($installscript)) {
                $can_proceed = false;
                nuke_sqlerror(substr($installscript,0,100)."...");
        } else echo "<font class=\"ok\">OK</font>";
        echo "</p>\n";
        unset($installscript);

		$sql="ALTER TABLE ".$db_prefix."_welcome_pm 
        ADD PRIMARY KEY (`subject`) ";
		$result=$db->sql_query($sql);
}

if ($can_proceed) {
        echo "<p>"._step4complete."</p>";
        echo "<p><input type=\"submit\" value=\""._nextstep."\" /></p>\n";
        echo "<input type=\"hidden\" name=\"step\" value=\"5\" />\n";
} else {
        echo "<p>"._step4failed."</p>";
}

$db->sql_close();

?>
