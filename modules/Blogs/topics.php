<?php
/*=======================================================================
 PHP-Nuke Titanium v4.0.3 : Enhanced PHP-Nuke Web Portal System
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
/*                                                                      */
/************************************************************************/
/*         Additional security & Abstraction layer conversion           */
/*                           2003 chatserv                              */
/*      http://www.nukefixes.com -- http://www.nukeresources.com        */
/************************************************************************/

/********************************************************/
/* NSN Blogs                                            */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* Contributer(s): Ernest Buffington aka TheGhost       */
/* http://www.nukescripts.net                           */
/* Copyright (c) 2000-2005 by NukeScripts Network       */
/********************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
	  Titanium Patched                         v4.0.3       01/25/2023
-=[Mod]=-
      Advanced Username Color                  v1.0.5       07/29/2005
-=[Applied Rules]=-
 * DirNameFileConstantToDirConstantRector
 * NullToStrictStringFuncCallArgRector
 ************************************************************************/
if (!defined('MODULE_FILE')) {
   die('You can\'t access this file directly...');
}
$module_name = basename(__DIR__);
get_lang($module_name);
include_once(NUKE_INCLUDE_DIR.'functions_blog.php');
$neconfig = get_blog_configs();

define('INDEX_FILE', true);

$topics = 1;
automated_blogs();
if ($topic == 0 OR empty($topic)) { redirect("modules.php?name=$module_name"); }

switch (isset($op)) {

    default:
    case "newindex":
        if($neconfig["homenumber"] == 0) {
            if (isset($cookie[3])) { $storynum = $cookie[3]; } else { $storynum = $storyhome; }
        } else {
            $storynum = $neconfig["homenumber"];
        }
        if (!isset($min)) { $min = 0; }
        if (!isset($max)) { $max = $min + $storynum; }
        if ($multilingual == 1) { $querylang = "AND (alanguage='$currentlang' OR alanguage='')"; } else { $querylang = ""; }
        include_once(NUKE_BASE_DIR."header.php");
        if($neconfig["readmore"] == 1) {
            echo "<script>\n";
            echo "<!-- Begin\n";
            echo "function BlogsReadWindow(mypage, myname, w, h, scroll) {\n";
            echo "var winl = (screen.width - w) / 2;\n";
            echo "var wint = (screen.height - h) / 2;\n";
            echo "winprops = 'height='+h+',width='+w+',top='+wint+',left='+winl+',scrollbars='+scroll+''\n";
            echo "win = window.open(mypage, myname, winprops)\n";
            echo "if (parseInt(navigator.appVersion) >= 4) { win.window.focus(); }\n";
            echo "}\n";
            echo "//  End -->\n";
            echo "</script>\n";
        }
        $db->sql_query("UPDATE ".$prefix."_blogs_topics SET counter=counter+1 WHERE topicid='$topic'");
        $result = $db->sql_query("SELECT * FROM ".$prefix."_blogs WHERE topic='$topic' $querylang");
        $totalarticles = $db->sql_numrows($result);
        $result = $db->sql_query("SELECT * FROM ".$prefix."_blogs WHERE topic='$topic' $querylang ORDER BY sid DESC LIMIT $min,$storynum");
        if($neconfig["columns"] == 1) { // DUAL
            echo "<table border='0' cellpadding='0' cellspacing='0' width='100%'>\n";
        }
        $a = 0;
        while ($artinfo = $db->sql_fetchrow($result)) {
            formatTimestamp(isset($artinfo["time"]));
            $subject = stripslashes((string) check_html(isset($subject), "nohtml"));
            $artinfo["hometext"] = decode_bbcode(set_smilies(stripslashes((string) $artinfo["hometext"])), 1, true);
            $artinfo["notes"] = stripslashes((string) $artinfo["notes"]);
            $artinfo["sid"] = intval($artinfo["sid"]);
            $artinfo["aid"] = stripslashes((string) $artinfo["aid"]);
            $artinfo["title"] = stripslashes((string) check_html($artinfo["title"], "nohtml"));
            $artinfo["comments"] = intval($artinfo["comments"]);
            $artinfo["counter"] = intval($artinfo["counter"]);
            $artinfo["topic"] = intval($artinfo["topic"]);
            $artinfo["informant"] = stripslashes((string) $artinfo["informant"]);
            $artinfo["notes"] = stripslashes((string) $artinfo["notes"]);
            $artinfo["acomm"] = intval($artinfo["acomm"]);
            $artinfo["score"] = intval($artinfo["score"]);
            $artinfo["ratings"] = intval($artinfo["ratings"]);
            getTopics($artinfo["sid"]);

            if($neconfig["texttype"] == 0) {
                $introcount = strlen((string) $artinfo["hometext"]);
                $fullcount = strlen((string) $artinfo["bodytext"]);
            } else {
                $introcount = strlen(strip_tags((string) $artinfo["hometext"], "<br />"));
                $fullcount = strlen((string) $artinfo["bodytext"]);
            }

            $totalcount = $introcount + $fullcount;
            $r_options = "";
            if (isset($cookie[4])) { $r_options .= "&amp;mode=$cookie[4]"; } else { $r_options .= "&amp;mode=thread"; }
            if (isset($cookie[5])) { $r_options .= "&amp;order=$cookie[5]"; } else { $r_options .= "&amp;order=0"; }
            if (isset($cookie[6])) { $r_options .= "&amp;thold=$cookie[6]"; } else { $r_options .= "&amp;thold=0"; }
            $the_icons = "";
            
	        if (is_user()) 
            {
              $the_icons .= ' | <a href="modules.php?name='.$module_name.'&amp;file=print&amp;sid='.$artinfo["sid"].'"><i class="fa fa-print"></i></a>'.PHP_EOL;
              $the_icons .= '&nbsp;<a href="modules.php?name='.$module_name.'&amp;file=friend&amp;op=FriendSend&amp;sid='.$artinfo["sid"].'"><i class="fa fa-envelope"></i></a>';
            }
            
		    if (is_mod_admin($module_name)) 
            {
              $the_icons .= ' | <a href="'.$admin_file.'.php?op=EditBlog&amp;sid='.$artinfo["sid"].'"><i class="fa fa-pen"></i></a>'.PHP_EOL;
              $the_icons .= '&nbsp;<a href="'.$admin_file.'.php?op=RemoveBlog&amp;sid='.$artinfo["sid"].'"><i class="fa fa-times-circle"></i></a>';
            }
			
            $read_link = "<a href='modules.php?name=$module_name&amp;file=read_article&amp;sid=".$artinfo["sid"]."$r_options' onclick=\"BlogsReadWindow(this.href,'ReadArticle','600','400','yes');return false;\">";
            $story_link = "<a href='modules.php?name=$module_name&amp;file=article&amp;sid=".$artinfo["sid"]."$r_options'>";
            $morelink = "( ";

            if($neconfig["texttype"] == 0) {
                if ($fullcount > 0 OR $artinfo["comments"] > 0 OR $articlecomm == 0 OR $artinfo["acomm"] == 1) {
                    if($neconfig["readmore"] == 1) {
                        $morelink .= "$read_link<strong>"._READMORE."</strong></a> | ";
                    } else {
                        $morelink .= "$story_link<strong>"._READMORE."</strong></a> | ";
                    }
                } else { $morelink .= ""; }
            } else {
                if ($introcount > 255 OR $fullcount > 0 OR $artinfo["comments"] > 0 OR $articlecomm == 0 OR $artinfo["acomm"] == 1) {
                    if($neconfig["readmore"] == 1) {
                        $morelink .= "$read_link<strong>"._READMORE."</strong></a> | ";
                    } else {
                        $morelink .= "$story_link<strong>"._READMORE."</strong></a> | ";
                    }
                } else { $morelink .= ""; }
                if ($introcount > 255) {
                    $artinfo["hometext"] = strip_tags((string) $artinfo["hometext"], "<br />");
                    $artinfo["hometext"] = substr($artinfo["hometext"], 0, 255);
                }
            }

            if ($fullcount > 0) { $morelink .= "$totalcount "._BYTESMORE." | "; }
            if ($articlecomm == 1 AND $artinfo["acomm"] == 0) {
                if ($artinfo["comments"] == 0) {
                    $morelink .= "$story_link"._COMMENTSQ."</a>";
                } elseif ($artinfo["comments"] == 1) {
                    $morelink .= "$story_link".$artinfo["comments"]." "._COMMENT."</a>";
                } elseif ($artinfo["comments"] > 1) {
                    $morelink .= "$story_link".$artinfo["comments"]." "._COMMENTS."</a>";
                }
            }
            $morelink .= "$the_icons";
            $sid = $artinfo["sid"];
            if ($artinfo["catid"] != 0) {
                $result3 = $db->sql_query("SELECT title FROM ".$prefix."_blogs_cat WHERE catid='".$artinfo["catid"]."'");
                $catinfo = $db->sql_fetchrow($result3);
                $morelink .= " | <a href='modules.php?name=$module_name&amp;file=categories&amp;op=newindex&amp;catid=".$artinfo["catid"]."'>".$catinfo["title"]."</a>";
            }
            if ($artinfo["score"] != 0) {
                $rated = substr($artinfo["score"] / $artinfo["ratings"], 0, 4);
            } else { $rated = 0; }
            $morelink .= " | "._SCORE." $rated";
            $morelink .= " )";
            $morelink = str_replace(" |  | ", " | ", $morelink);
            $informant =  $artinfo["informant"];
            if($neconfig["columns"] == 1) { // DUAL
                if ($a == 0) { echo "<tr>"; }
                echo "<td valign='top' width='50%'>";
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                themeindex($artinfo["aid"], $informant, $datetime, $modified, $artinfo["title"], $artinfo["counter"], $artinfo["topic"], $artinfo["hometext"], $artinfo["notes"], $morelink, $topicname, $topicimage, $topictext);
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                echo "</td>\n";
                $a++;
                if ($a == 2) { echo "</tr>"; $a = 0; } else { echo "<td>&nbsp;</td>"; }
            } else { // SINGLE
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                themeindex($artinfo["aid"], 
				                $informant, 
								 $datetime, 
						  isset($modified), 
						 $artinfo["title"], 
					   $artinfo["counter"], 
					     $artinfo["topic"], 
					  $artinfo["hometext"], 
					     $artinfo["notes"], 
						         $morelink, 
								$topicname, 
							   $topicimage, 
							    $topictext);
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
            }
        }
        $db->sql_freeresult($result);
        if($neconfig["columns"] == 1) { // DUAL
            if ($a ==1) { echo "<td width='50%'>&nbsp;</td></tr>\n"; } else { echo "</tr>\n"; }
            echo "</table>\n";
        }
        echo "\n<!-- PAGING -->\n";
        $articlepagesint = ($totalarticles / $storynum);
        $articlepageremain = ($totalarticles % $storynum);
        if ($articlepageremain != 0) {
            $articlepages = ceil($articlepagesint);
            if ($totalarticles < $storynum) { $articlepageremain = 0; }
        } else {
            $articlepages = $articlepagesint;
        }
        if ($articlepages!=1 && $articlepages!=0) {
            echo "<br />\n";
            OpenTable();
            $counter = 1;
            $currentpage = ($max / $storynum);
            echo "<form action='modules.php?name=$module_name' method='post'>\n";
            echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
            echo "<tr>\n<td><strong>"._BLOG_SELECT." </strong><select name='min' onChange='top.location.href=this.options[this.selectedIndex].value'>\n";
            while ($counter <= $articlepages ) {
                $cpage = $counter;
                $mintemp = ($storynum * $counter) - $storynum;
                if ($counter == $currentpage) {
                    echo "<option selected>$counter</option>\n";
                } else {
                    echo "<option value='modules.php?name=$module_name&amp;min=$mintemp&amp;file=topics&amp;topic=$topic'>$counter</option>\n";
                }
                $counter++;
            }
            echo "</select><strong> "._BLOG_OF." $articlepages "._BLOG_PAGES.".</strong></td>\n</tr>\n";
            echo "</table>\n";
            echo "</form>\n";
            CloseTable();
        }
        echo "<!-- CLOSE PAGING -->\n";
        include_once("footer.php");
    break;

}

