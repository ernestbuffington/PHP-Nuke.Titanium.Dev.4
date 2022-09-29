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
/* Version 1.0b                                                         */
/*                                                                      */
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

define('INDEX_FILE', true);

$titanium_module_name = basename(dirname(__FILE__));

include_once(NUKE_INCLUDE_DIR.'nsnne_func.php');

$blog_config = blog_get_configs();

get_lang($titanium_module_name);

    global $titanium_db, 
    $storyhome, 
    $topicname, 
   $topicimage, 
    $topictext, 
     $datetime,
	 $modified, 
         $titanium_user, 
	   $cookie, 
	   $titanium_prefix, 
 $multilingual, 
  $currentlang, 
  $articlecomm, 
     $sitename, 
    $titanium_user_news, 
	 $userinfo;
 
automated_blogs();

if (isset($new_topic)) 
redirect_titanium("modules.php?name=$titanium_module_name&file=topics&topic=$new_topic"); 

$main_module_titanium = main_module_titanium();

$op = (isset($op)) ? $op : '';
$blog_config["homenumber"] = 0;
switch ($op) 
{
    default:
        if($blog_config["homenumber"] == 0) 
		{
            if (isset($userinfo['storynum'])) 
                $blognum = $userinfo['storynum'];
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
		{
          if(defined('HOME_FILE')) 
            $querylang = "WHERE (alanguage='$currentlang' OR alanguage='') AND ihome='0'";
		  else 
            $querylang = "WHERE (alanguage='$currentlang' OR alanguage='')";
        } 
		else 
		{
          if(defined('HOME_FILE')) 
            $querylang = "WHERE ihome='0'";
		  else 
            $querylang = "";
        }

        include_once(NUKE_BASE_DIR."header.php");
        title($sitename.' '.$pagetitle);
        
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
        
		if($blog_config["hometopic"] > 0 AND define('HOME_FILE', true)) // One Topic on Home
		{ 
            if(empty($querylang)) 
                $querylang = "WHERE topic='".$blog_config["hometopic"]."'";
			else 
                $querylang .= " AND topic='".$blog_config["hometopic"]."'";
        }

        $result = $titanium_db->sql_query("SELECT COUNT(*) AS numrows FROM ".$titanium_prefix."_stories $querylang");

        list($totalarticles) = $titanium_db->sql_fetchrow($result);

        $titanium_db->sql_freeresult($result);

        $querylang = (!isset($querylang) || empty($querylang)) ? 'WHERE `datePublished` <= now()' : $querylang . ' AND `datePublished` <= now()';
        $result = $titanium_db->sql_query("SELECT * FROM ".$titanium_prefix."_stories $querylang ORDER BY sid DESC LIMIT $min,$blognum");

        if($blog_config["columns"] == 1) // DUAL BLOG
        echo "<table border='0' cellpadding='0' cellspacing='0' width='100%'>\n";
        
		$a = 0;
        
		while ($artinfo = $titanium_db->sql_fetchrow($result)) 
		{
            $artinfo["datePublished"] = formatTimestamp($artinfo["datePublished"]);
        
		    if(!empty($subject))
            $subject = stripslashes(check_html($subject, "nohtml"));
            
			$artinfo["hometext"] =  decode_bbcode(set_smilies(stripslashes($artinfo["hometext"])), 1, true);
            $artinfo["hometext"] = evo_img_tag_to_resize($artinfo["hometext"]);
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
            $artinfo["ticon"] = intval($artinfo["ticon"]);
            $artinfo["writes"] = intval($artinfo["writes"]);

            getTopics($artinfo["sid"]);

            if($blog_config["texttype"] == 0) 
			{
                $introcount = strlen($artinfo["hometext"]);
                $fullcount = strlen($artinfo["bodytext"]);
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

            # show the user buttons
			if (is_user()) 
            {
                $the_icons .= ' | <a href="modules.php?name='.$titanium_module_name.'&amp;file=print&amp;sid='.$artinfo["sid"].'"><i class="fa fa-print"></i></a>'.PHP_EOL;
                $the_icons .= '&nbsp;<a href="modules.php?name='.$titanium_module_name.'&amp;file=friend&amp;op=FriendSend&amp;sid='.$artinfo["sid"].'"><i class="fa fa-envelope"></i></a>';
            }
			
            # show thw admin buttons
			if (is_mod_admin($titanium_module_name)) 
            {
                $the_icons .= ' | <a href="'.$admin_file.'.php?op=EditStory&amp;sid='.$artinfo["sid"].'"><i class="fa fa-pen"></i></a>'.PHP_EOL;
                $the_icons .= '&nbsp;<a href="'.$admin_file.'.php?op=RemoveStory&amp;sid='.$artinfo["sid"].'"><i class="fa fa-times-circle"></i></a>';
            }

            $read_link = "<a href='modules.php?name=$titanium_module_name&amp;file=read_article&amp;sid=".$artinfo["sid"]."$r_options' onclick=\"NewsReadWindow(this.href,'ReadArticle','600','400','yes');return false;\">";
            $story_link = "<a href='modules.php?name=$titanium_module_name&amp;file=article&amp;sid=".$artinfo["sid"]."$r_options'>";
            
			
            $seperator = " )&nbsp;( ";
			$morelink = "( "; // added a space here as that is how it belongs!  Ernest Buffington 08/09/2019

            
			
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
				
                if ($artinfo["comments"] == 0): 
				    $morelink .= "$story_link"._COMMENTSQ."</a>$seperator";
				elseif ($artinfo["comments"] == 1): 
                    $morelink .= "$story_link".$artinfo["comments"]." "._COMMENT."</a>";
				elseif ($artinfo["comments"] > 1): 
                    $morelink .= "$story_link".$artinfo["comments"]." "._COMMENTS."</a>";
			    endif;
            }
            
			$morelink .= "$the_icons";
            $sid = $artinfo["sid"];

            if ($artinfo["catid"] != 0) 
			{
                $result3 = $titanium_db->sql_query("SELECT title FROM ".$titanium_prefix."_stories_cat WHERE catid='".$artinfo["catid"]."'");
                $catinfo = $titanium_db->sql_fetchrow($result3);
                $titanium_db->sql_freeresult($result3);
                $morelink .= " | <a href='modules.php?name=$titanium_module_name&amp;file=categories&amp;op=newindex&amp;catid=".$artinfo["catid"]."'>".$catinfo["title"]."</a>";
            }
            
			if ($artinfo["score"] != 0) 
                $rated = substr($artinfo["score"] / $artinfo["ratings"], 0, 4);
			else 
			    $rated = 0; 
            
			$morelink .= " | "._SCORE." $rated";
            $morelink .= " )"; // added a space here as that is how it belongs! Ernest Buffington 08/09/2019
            $morelink = str_replace(" |  | ", " | ", $morelink);

            if($artinfo["ticon"] == 1) 
            $topicimage = '';

            if($artinfo["writes"] == 0) 
            define_once('WRITES', true);
            $informant = UsernameColor($artinfo["informant"]);

            if($blog_config["columns"] == 1) // DUAL
			{ 
                if ($a == 0) 
			    echo "<tr>"; 
                
				echo "<td valign='top' width='50%'>";
            
			    themeindex($artinfo["aid"], 
				                $informant, 
								 $datetime,
								 $modified, 
						 $artinfo["title"], 
					   $artinfo["counter"], 
					     $artinfo["topic"], 
					  $artinfo["hometext"], 
					     $artinfo["notes"], 
						         $morelink, 
								$topicname, 
							   $topicimage, 
							    $topictext);
            
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
			else // SINGLE BLOG
            themeindex($artinfo["aid"], 
			                $informant, 
							 $datetime,
							 $modified, 
					 $artinfo["title"], 
				   $artinfo["counter"], 
				     $artinfo["topic"], 
				  $artinfo["hometext"], 
				     $artinfo["notes"], 
					         $morelink, 
							$topicname, 
						   $topicimage, 
						    $topictext);
        }
        
		$titanium_db->sql_freeresult($result);

        if($blog_config["columns"] == 1) // DUAL BLOG
		{ 
            if ($a ==1) { echo "<td width='50%'>&nbsp;</td></tr>\n"; } else { echo "</tr>\n"; }
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
            //echo "<br />\n";
        
		    OpenTable();
        
		    $counter = 1;
            $currentpage = ($max / $blognum);
        
		    echo "<div align=\"center\"><form action='modules.php?name=$titanium_module_name' method='post'>\n";
            echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
            echo "<tr>\n<td><strong>"._NE_SELECT." </strong><select name='min' onChange='top.location.href=this.options[this.selectedIndex].value'>\n";
        
		    while ($counter <= $articlepages ) 
			{
                $cpage = $counter;
                $mintemp = ($blognum * $counter) - $blognum;
            
			    if ($counter == $currentpage) 
                    echo "<option selected>$counter</option>\n";
				else 
				{
                    if($titanium_module_name == $main_module_titanium) 
                      echo "<option value='index.php?min=$mintemp'>$counter</option>\n";
					else 
                      echo "<option value='modules.php?name=$titanium_module_name&amp;min=$mintemp'>$counter</option>\n";
                }
                
				$counter++;
            }

            echo "</select> "._NE_OF." $articlepages "._NE_PAGES."</td>\n</tr>\n";
            echo "</table>\n";
            echo "</form></div>\n";

            CloseTable();
        }

        echo "<!-- CLOSE PAGING -->\n";
        include(NUKE_BASE_DIR."footer.php");
    break;

    case "rate_article":
        
		$score = intval($score);
        
		if ($score) 
		{
            if ($score > 5) 
		    $score = 5; 
            
			if ($score < 1) 
		    $score = 1; 
            
			if ($score != 1 AND $score != 2 AND $score != 3 AND $score != 4 AND $score != 5) 
			{
                redirect_titanium("index.php");
                exit;
            }

            if (isset($ratecookie)) 
			{
                $rcookie = base64_decode($ratecookie);
                $r_cookie = explode(":", $rcookie);
            }
            
			for ($i=0; $i < count($r_cookie); $i++) 
			{ 
			   if ($r_cookie[$i] == $sid) 
			   $a = 1; 
		    }
            
			if ($a == 1) 
			{
                redirect_titanium("modules.php?name=$titanium_module_name&op=rate_complete&sid=$sid&rated=1");
            } 
			else 
			{
                $result = $titanium_db->sql_query("update ".$titanium_prefix."_stories set score=score+$score, ratings=ratings+1 where sid='$sid'");
                $titanium_db->sql_freeresult($result);
                $info = base64_encode("$rcookie$sid:");
                setcookie("ratecookie","$info",time()+86400);
                redirect_titanium("modules.php?name=Blog&op=rate_complete&sid=$sid&score=$score");
            }
        } 
		else 
		{
            include_once(NUKE_BASE_DIR."header.php");

            OpenTable();

            echo "<div align=\"center\">"._DIDNTRATE."<br /><br />\n";
            echo ""._GOBACK."</div>";

            CloseTable();

            @include_once("footer.php");
        }
    break;

    case "rate_complete":

        $r_options = "";

        if (is_user()) 
		{
            if (isset($userinfo['umode'])) { $r_options .= "&amp;mode=".$userinfo['umode']; } else { $r_options .= "&amp;mode=thread"; }
            if (isset($userinfo['uorder'])) { $r_options .= "&amp;order=".$userinfo['uorder']; } else { $r_options .= "&amp;order=0"; }
            if (isset($userinfo['thold'])) { $r_options .= "&amp;thold=".$userinfo['thold']; } else { $r_options .= "&amp;thold=0"; }
        }
        
		include_once(NUKE_BASE_DIR."header.php");
        
        OpenTable();
        
		if ($rated == 0) 
		{
            echo "<br /><br /><div align=\"center\"><strong>"._THANKSVOTEARTICLE."</strong><br /><br />";
            echo "[ <a href='modules.php?name=$titanium_module_name&amp;file=article&amp;sid=$sid$r_options'>"._BACKTOARTICLEPAGE."</a> ]</div><br /><br />";
        } 
		else
		if ($rated == 1) 
		{
            echo "<br /><br /><div align=\"center\"><strong>"._ALREADYVOTEDARTICLE."</strong><br /><br />";
            echo "[ <a href='modules.php?name=$titanium_module_name&amp;file=article&amp;sid=$sid$r_options'>"._BACKTOARTICLEPAGE."</a> ]</div><br /><br />";
        }
        
		CloseTable();
        
		@include_once("footer.php");
    break;
}
?>
