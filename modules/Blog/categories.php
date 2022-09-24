<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
/* Titanium Blog                                                        */
/* By: The 86it Developers Network                                      */
/* https://www.86it.us                                                  */
/* Copyright (c) 2019 Ernest Buffington                                 */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
-=[Mod]=-
      Advanced Username Color                  v1.0.5       07/29/2005
      Blog BBCodes                             v1.0.0       08/19/2005
      Display Topic Icon                       v1.0.0       06/27/2005
      Display Writes                           v1.0.0       10/14/2005
	  Titanium Patched                         v3.0.0       08/26/2019
 ************************************************************************/
if (!defined('MODULE_FILE')) die('You can\'t access this file directly...');

global $storyhome, $topicname, $topicimage, $topictext, $datetime, $titanium_user, $cookie, $titanium_prefix, $multilingual, $currentlang, $titanium_db, $articlecomm, $titanium_module_name, $userinfo;

$titanium_module_name = basename(dirname(__FILE__));

get_lang($titanium_module_name);

@include_once(NUKE_INCLUDE_DIR."nsnne_func.php");

$blog_config = blog_get_configs();

define('INDEX_FILE', true);

$categories = 1;

automated_blogs();

if ($catid == 0 OR empty($catid)) 
redirect_titanium("modules.php?name=$titanium_module_name"); 

switch ($op) 
{

    default:
    case "newindex":
        if($blog_config["homenumber"] == 0) 
		{
            if (isset($userinfo['setstorynum'])) 
			$blognum = $userinfo['setstorynum']; 
			else 
			$blognum = $storyhome; 
        } 
		else 
            $blognum = $blog_config["homenumber"];
        
		if (!isset($min)) 
		$min = 0; 
        
		if (!isset($max)) 
		$max = $min + $blognum; 
        
		if ($multilingual == 1) 
		$querylang = "AND (alanguage='$currentlang' OR alanguage='')"; 
		else 
		$querylang = ""; 

        include_once(NUKE_BASE_DIR."header.php");
        
		if($blog_config["readmore"] == 1) 
		{
            echo "<script language='JavaScript'>\n";
            echo "<!-- Begin\n";
            echo "function NewsReadWindow(mypage, myname, w, h, scroll) {\n";
            echo "var winl = (screen.width - w) / 2;\n";
            echo "var wint = (screen.height - h) / 2;\n";
            echo "winprops = 'height='+h+',width='+w+',top='+wint+',left='+winl+',scrollbars='+scroll+''\n";
            echo "win = window.open(mypage, myname, winprops)\n";
            echo "if (parseInt(navigator.appVersion) >= 4) { win.window.focus(); }\n";
            echo "}\n";
            echo "//  End -->\n";
            echo "</script>\n";
        }

        $titanium_db->sql_query("update ".$titanium_prefix."_stories_cat set counter=counter+1 where catid='$catid'");
        $result = $titanium_db->sql_query("SELECT * FROM ".$titanium_prefix."_stories WHERE catid='$catid' $querylang");
        $totalarticles = $titanium_db->sql_numrows($result);
        $titanium_db->sql_freeresult($result);
        $result = $titanium_db->sql_query("SELECT * FROM ".$titanium_prefix."_stories WHERE catid='$catid' $querylang ORDER BY sid DESC LIMIT $min,$blognum");
        
		if($blog_config["columns"] == 1) // DUAL
        echo "<table border='0' cellpadding='0' cellspacing='0' width='100%'>\n";
        
		$a = 0;

        while ($artinfo = $titanium_db->sql_fetchrow($result)) 
		{
            formatTimestamp($artinfo["time"]);
            $subject = stripslashes(check_html($subject, "nohtml"));
/*****[BEGIN]******************************************
 [ Mod:     Blog BBCodes                       v1.0.0 ]
 ******************************************************/
            $artinfo["hometext"] = decode_bbcode(set_smilies(stripslashes($artinfo["hometext"])), 1, true);
            $artinfo["hometext"] = evo_img_tag_to_resize($artinfo["hometext"]);
/*****[END]********************************************
 [ Mod:     Blog BBCodes                       v1.0.0 ]
 ******************************************************/
            $artinfo["notes"] = stripslashes($artinfo["notes"]);
            $artinfo["sid"] = intval($artinfo["sid"]);
            $artinfo["aid"] = stripslashes($artinfo["aid"]);
            $artinfo["title"] = stripslashes(check_html($artinfo["title"], "nohtml"));
            $artinfo["comments"] = intval($artinfo["comments"]);
            $artinfo["counter"] = intval($artinfo["counter"]);
            $artinfo["topic"] = intval($artinfo["topic"]);
            $artinfo["informant"] = stripslashes($artinfo["informant"]);
            $artinfo["notes"] = stripslashes($artinfo["notes"]);
            $artinfo["acomm"] = intval($artinfo["acomm"]);
            $artinfo["score"] = intval($artinfo["score"]);
            $artinfo["ratings"] = intval($artinfo["ratings"]);
            getTopics($artinfo["sid"]);

            if($blog_config["texttype"] == 0) 
			{
                $introcount = strlen($hometext);
                $fullcount = strlen($bodytext);
            } 
			else 
			{
                $introcount = strlen(strip_tags($artinfo["hometext"], "<br />"));
                $fullcount = strlen($artinfo["bodytext"]);
            }

            $totalcount = $introcount + $fullcount;
            $r_options = "";
            
			if (isset($userinfo['umode'])) 
			$r_options .= "&amp;mode=".$userinfo['umode']; 
			else 
			$r_options .= "&amp;mode=thread"; 
            
			if (isset($userinfo['uorder'])) 
			$r_options .= "&amp;order=".$userinfo['uorder']; 
			else 
			$r_options .= "&amp;order=0"; 
            
			if (isset($userinfo['thold'])) 
			$r_options .= "&amp;thold=".$userinfo['thold']; 
			else 
			$r_options .= "&amp;thold=0"; 
            
			$the_icons = "";
            
	        if (is_user()) 
            {
              $the_icons .= ' | <a href="modules.php?name='.$titanium_module_name.'&amp;file=print&amp;sid='.$artinfo["sid"].'"><i class="fa fa-print"></i></a>'.PHP_EOL;
              $the_icons .= '&nbsp;<a href="modules.php?name='.$titanium_module_name.'&amp;file=friend&amp;op=FriendSend&amp;sid='.$artinfo["sid"].'"><i class="fa fa-envelope"></i></a>';
            }
            
		    if (is_mod_admin($titanium_module_name)) 
            {
              $the_icons .= ' | <a href="'.$admin_file.'.php?op=EditStory&amp;sid='.$artinfo["sid"].'"><i class="fa fa-pen"></i></a>'.PHP_EOL;
              $the_icons .= '&nbsp;<a href="'.$admin_file.'.php?op=RemoveStory&amp;sid='.$artinfo["sid"].'"><i class="fa fa-times-circle"></i></a>';
            }
			
			$read_link = "<a href='modules.php?name=$titanium_module_name&amp;file=read_article&amp;sid=".$artinfo["sid"]."$r_options' onclick=\"NewsReadWindow(this.href,'ReadArticle','600','400','yes');return false;\">";
            $story_link = "<a href='modules.php?name=$titanium_module_name&amp;file=article&amp;sid=".$artinfo["sid"]."$r_options'>";
            $morelink = "( ";

            if($blog_config["texttype"] == 0) 
			{
                if ($fullcount > 0 OR $artinfo["comments"] > 0 OR $articlecomm == 0 OR $artinfo["acomm"] == 1) 
				{
                    if($blog_config["readmore"] == 1) 
                        $morelink .= "$read_link<strong>"._READMORE."</strong></a> | ";
					else 
                        $morelink .= "$story_link<strong>"._READMORE."</strong></a> | ";
                } 
				else 
				$morelink .= ""; 
            } 
			else 
			{
                if ($introcount > 255 OR $fullcount > 0 OR $artinfo["comments"] > 0 OR $articlecomm == 0 OR $artinfo["acomm"] == 1) 
				{
                    if($blog_config["readmore"] == 1) 
                        $morelink .= "$read_link<strong>"._READMORE."</strong></a> | ";
					else 
                        $morelink .= "$story_link<strong>"._READMORE."</strong></a> | ";
                } 
				else 
				$morelink .= ""; 
                
				if ($introcount > 255) 
				{
                    $artinfo["hometext"] = strip_tags($artinfo["hometext"], "<br />");
                    $artinfo["hometext"] = substr($artinfo["hometext"], 0, 255);
                }
            }

            if ($fullcount > 0) 
			$morelink .= "$totalcount "._BYTESMORE." | "; 
            
			if ($articlecomm == 1 AND $artinfo["acomm"] == 0) 
			{
                if ($artinfo["comments"] == 0) 
                    $morelink .= "$story_link"._COMMENTSQ."</a>";
				else
				if ($artinfo["comments"] == 1) 
                    $morelink .= "$story_link".$artinfo["comments"]." "._COMMENT."</a>";
				else
				if ($artinfo["comments"] > 1) 
                    $morelink .= "$story_link".$artinfo["comments"]." "._COMMENTS."</a>";
            }
            
			$morelink .= "$the_icons";
            $sid = $artinfo["sid"];

            if ($artinfo["catid"] != 0) 
			{
                $result3 = $titanium_db->sql_query("SELECT title FROM ".$titanium_prefix."_stories_cat WHERE catid='".$artinfo["catid"]."'");
                $catinfo = $titanium_db->sql_fetchrow($result3);
                $morelink .= " | <a href='modules.php?name=$titanium_module_name&amp;file=categories&amp;op=newindex&amp;catid=".$artinfo["catid"]."'>".$catinfo["title"]."</a>";
            }
            
			if ($artinfo["score"] != 0) 
            $rated = substr($artinfo["score"] / $artinfo["ratings"], 0, 4);
			else 
			$rated = 0; 
            
			$morelink .= " | "._SCORE." $rated";
            $morelink .= " )";
            $morelink = str_replace(" |  | ", " | ", $morelink);
            $informant = $artinfo["informant"];

            if($blog_config["columns"] == 1) // DUAL
			{ 
                if ($a == 0) 
				echo "<tr>"; 

                echo "<td valign='top' width='50%'>";

                themeindex($artinfo["aid"], $informant, $datetime, $modified, $artinfo["title"], $artinfo["counter"], $artinfo["topic"], $artinfo["hometext"], $artinfo["notes"], $morelink, $topicname, $topicimage, $topictext);

                echo "</td>\n";

                $a++;

                if ($a == 2)
				{ 
				  echo "</tr>"; 
				  $a = 0; 
				}
				else 
				echo "<td>&nbsp;</td>"; 
            } 
			else // SINGLE 
            themeindex($artinfo["aid"], $informant, $datetime, $modified, $artinfo["title"], $artinfo["counter"], $artinfo["topic"], $artinfo["hometext"], $artinfo["notes"], $morelink, $topicname, $topicimage, $topictext);
        }
        $titanium_db->sql_freeresult($result);
        
		if($blog_config["columns"] == 1) // DUAL
		{ 
            if ($a ==1) 
			echo "<td width='50%'>&nbsp;</td></tr>\n"; 
			else 
			echo "</tr>\n"; 
            
			echo "</table>\n";
        }
        
		echo "\n<!-- PAGING -->\n";
        
		$articlepagesint = ($totalarticles / $blognum);
        $articlepageremain = ($totalarticles % $blognum);
        
		if ($articlepageremain != 0) 
		{
            $articlepages = ceil($articlepagesint);
        
		    if ($totalarticles < $blognum) 
			$articlepageremain = 0; 
        } 
		else 
            $articlepages = $articlepagesint;

        if ($articlepages!=1 && $articlepages!=0) 
		{
            echo "<br />\n";
            
			OpenTable();
            
			$counter = 1;
            
			$currentpage = ($max / $blognum);
            
			echo "<form action='modules.php?name=$titanium_module_name' method='post'>\n";
            echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
            echo "<tr>\n<td><strong>"._NE_SELECT." </strong><select name='min' onChange='top.location.href=this.options[this.selectedIndex].value'>\n";
            
			while ($counter <= $articlepages ) 
			{
                $cpage = $counter;
                $mintemp = ($blognum * $counter) - $blognum;
            
			    if ($counter == $currentpage) 
                echo "<option selected>$counter</option>\n";
				else 
                echo "<option value='modules.php?name=$titanium_module_name&amp;min=$mintemp&amp;file=categories&amp;catid=$catid'>$counter</option>\n";
                
				$counter++;
            }

            echo "</select><strong> "._NE_OF." $articlepages "._NE_PAGES.".</strong></td>\n</tr>\n";
            echo "</table>\n";
            echo "</form>\n";

            CloseTable();
        }
        echo "<!-- CLOSE PAGING -->\n";
        @include_once("footer.php");
    break;
}
?>
