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
	  Titanium Patched                         v3.0.0       08/26/2019
-=[Mod]=-
      Advanced Username Color                  v1.0.5       07/29/2005
      Blog BBCodes                             v1.0.0       08/19/2005
      Display Topic Icon                       v1.0.0       06/27/2005
      Display Writes                           v1.0.0       10/14/2005
-=[LAst Updated]=-
      11/20/2022 1:01 pm Ernest Allen Buffington	  
 ************************************************************************/
 
if(!defined('MODULE_FILE')): 
  die('You can\'t access this file directly...');
endif;

define('INDEX_FILE', true);

$module_name = basename(__DIR__);

include_once(NUKE_INCLUDE_DIR.'functions_blog.php');

$neconfig = get_blog_configs();

get_lang($module_name);

    global $db, 
    $storyhome, 
    $topicname, 
   $topicimage, 
    $topictext, 
     $datetime,
	 $modified, 
         $user, 
	   $cookie, 
	   $prefix, 
 $multilingual, 
  $currentlang, 
  $articlecomm, 
     $sitename, 
    $user_news, 
	 $userinfo;
 
automated_blogs();

if(isset($new_topic)): 
  redirect("modules.php?name=$module_name&file=topics&topic=$new_topic"); 
endif;

$main_module = main_module();

$op ??= '';
$neconfig["homenumber"] ??= '0';

switch ($op): 
    default:
        $storynum = $neconfig["homenumber"] == 0 ? $userinfo['storynum'] ?? $storyhome : $neconfig["homenumber"];

        if(!isset($min)): 
	      $min = 0; 
		endif;
        
		if(!isset($max)): 
		  $max = $min + $storynum; 
		endif;

        if ($multilingual == 1) {
            if(defined('HOME_FILE')): 
              $querylang = "WHERE (alanguage='$currentlang' OR alanguage='') AND ihome='0'";
  		  else: 
              $querylang = "WHERE (alanguage='$currentlang' OR alanguage='')";
  			endif;
        } elseif (defined('HOME_FILE')) {
            $querylang = "WHERE ihome='0'";
        } else 
                $querylang = "";

        include_once(NUKE_BASE_DIR."header.php");
        
		//title($sitename.' '.$pagetitle);
        
		if($neconfig["readmore"] == 1): 
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
        endif;
        
		if($neconfig["hometopic"] > 0 && define('HOME_FILE', true)): # One Topic on Home
            if(empty($querylang)): 
                $querylang = "WHERE topic='".$neconfig["hometopic"]."'";
			else: 
                $querylang .= " AND topic='".$neconfig["hometopic"]."'";
			endif;
        endif;

        $result = $db->sql_query("SELECT COUNT(*) AS numrows FROM ".$prefix."_blogs $querylang");

        [$totalarticles] = $db->sql_fetchrow($result);

        $db->sql_freeresult($result);

        $querylang = (!isset($querylang) || empty($querylang)) ? 'WHERE `datePublished` <= now()' : $querylang . ' AND `datePublished` <= now()';
        $result = $db->sql_query("SELECT * FROM ".$prefix."_blogs $querylang ORDER BY sid DESC LIMIT $min,$storynum");

        if($neconfig["columns"] == 1): # DUAL BLOG
          echo "<table border='0' cellpadding='0' cellspacing='0' width='100%'>\n";
        endif;
		
		$a = 0;
        
		while ($artinfo = $db->sql_fetchrow($result)): 
		
            $artinfo["datePublished"] = formatTimestamp($artinfo["datePublished"]);
        
		    if(!empty($subject)):
              $subject = stripslashes((string) check_html($subject, "nohtml"));
            endif;
			
			$artinfo["hometext"] =  decode_bbcode(set_smilies(stripslashes((string) $artinfo["hometext"])), 1, true);
            $artinfo["hometext"] = img_tag_to_resize($artinfo["hometext"]);
            $artinfo["notes"] = stripslashes((string) $artinfo["notes"]);
            $artinfo["sid"] = (int) $artinfo["sid"];
            $artinfo["aid"] = stripslashes((string) $artinfo["aid"]);
            $artinfo["title"] = stripslashes((string) check_html($artinfo["title"], "nohtml"));
            $artinfo["comments"] = (int) $artinfo["comments"];
            $artinfo["counter"] = (int) $artinfo["counter"];
            $artinfo["topic"] = (int) $artinfo["topic"];
            $artinfo["informant"] = stripslashes((string) $artinfo["informant"]);
            $artinfo["notes"] = stripslashes((string) $artinfo["notes"]);
            $artinfo["acomm"] = (int) $artinfo["acomm"];
            $artinfo["score"] = (int) $artinfo["score"];
            $artinfo["ratings"] = (int) $artinfo["ratings"];
            $artinfo["ticon"] = (int) $artinfo["ticon"];
            $artinfo["writes"] = (int) $artinfo["writes"];

            getTopics($artinfo["sid"]);

            if($neconfig["texttype"] == 0): 
                $introcount = strlen((string) $artinfo["hometext"]);
                $fullcount = strlen((string) $artinfo["bodytext"]);
			else: 
                $introcount = strlen(strip_tags((string) $artinfo["hometext"], "<br />"));
                $fullcount = strlen((string) $artinfo["bodytext"]);
            endif;
            
			$totalcount = $introcount + $fullcount;
            $r_options = "";
            
			if(isset($userinfo['umode'])): 
			  $r_options .= "&amp;mode=".$userinfo['umode']; 
			else: 
			  $r_options .= "&amp;mode=thread"; 
			endif;
            
			if(isset($userinfo['uorder'])): 
			  $r_options .= "&amp;order=".$userinfo['uorder']; 
			else: 
			  $r_options .= "&amp;order=0"; 
			endif;
            
			if(isset($userinfo['thold'])): 
			  $r_options .= "&amp;thold=".$userinfo['thold']; 
			else: 
			  $r_options .= "&amp;thold=0"; 
			endif;
            
			$the_icons = "";

            # show the user buttons
			if(is_user()): 
                $the_icons .= ' | <a href="modules.php?name='.$module_name.'&amp;file=print&amp;sid='.$artinfo["sid"].'"><i class="fa fa-print"></i></a>'.PHP_EOL;
                $the_icons .= '&nbsp;<a href="modules.php?name='.$module_name.'&amp;file=friend&amp;op=FriendSend&amp;sid='.$artinfo["sid"].'"><i class="fa fa-envelope"></i></a>';
            endif;
			
            # show the admin buttons
			if(is_mod_admin($module_name)): 
                $the_icons .= ' | <a href="'.$admin_file.'.php?op=EditBlog&amp;sid='.$artinfo["sid"].'"><i class="fa fa-pen"></i></a>'.PHP_EOL;
                $the_icons .= '&nbsp;<a href="'.$admin_file.'.php?op=RemoveBlog&amp;sid='.$artinfo["sid"].'"><i class="fa fa-times-circle"></i></a>';
            endif;

            $read_link = "<a href='modules.php?name=$module_name&amp;file=read_article&amp;sid=".$artinfo["sid"]."$r_options' onclick=\"BlogsReadWindow(this.href,'ReadArticle','600','400','yes');return false;\">";
            $story_link = "<a href='modules.php?name=$module_name&amp;file=article&amp;sid=".$artinfo["sid"]."$r_options'>";
            
			
            $seperator = " )&nbsp;( ";
			$morelink = "( "; // added a space here as that is how it belongs!  Ernest Buffington 08/09/2019
			
			if($neconfig["texttype"] == 0): 
                if($fullcount > 0 || $artinfo["comments"] > 0 || $articlecomm == 0 || $artinfo["acomm"] == 1): 
                    if($neconfig["readmore"] == 1): 
                        $morelink .= "$read_link<strong>"._READMORE."</strong></a> | ";
					else:
                        $morelink .= "$story_link<strong>"._READMORE."</strong></a> | ";
					endif;
				else: 
				$morelink .= ""; 
				endif;
			else: 
                if($introcount > 255 || $fullcount > 0 || $artinfo["comments"] > 0 || $articlecomm == 0 || $artinfo["acomm"] == 1): 
                    if($neconfig["readmore"] == 1): 
                      $morelink .= "$read_link<strong>"._READMORE."</strong></a> | ";
					else: 
                      $morelink .= "$story_link<strong>"._READMORE."</strong></a> | ";
					endif;
				else: 
				  $morelink .= ""; 
				endif;
                
				if($introcount > 255): 
                    $artinfo["hometext"] = strip_tags((string) $artinfo["hometext"], "<br />");
                    $artinfo["hometext"] = substr($artinfo["hometext"], 0, 255);
                endif;
            endif;

            if($fullcount > 0): 
			  $morelink .= "$totalcount "._BYTESMORE." | "; 
            endif;
			
			if($articlecomm == 1 && $artinfo["acomm"] == 0): 
                if($artinfo["comments"] == 0): 
				    $morelink .= "$story_link"._COMMENTSQ."</a>$seperator";
				elseif ($artinfo["comments"] == 1): 
                    $morelink .= "$story_link".$artinfo["comments"]." "._COMMENT."</a>";
				elseif ($artinfo["comments"] > 1): 
                    $morelink .= "$story_link".$artinfo["comments"]." "._COMMENTS."</a>";
			    endif;
            endif;
            
			$morelink .= "$the_icons";
            $sid = $artinfo["sid"];

            if ($artinfo["catid"] != 0): 
                $result3 = $db->sql_query("SELECT title FROM ".$prefix."_blogs_cat WHERE catid='".$artinfo["catid"]."'");
                $catinfo = $db->sql_fetchrow($result3);
                $db->sql_freeresult($result3);
                $morelink .= " | <a href='modules.php?name=$module_name&amp;file=categories&amp;op=newindex&amp;catid=".$artinfo["catid"]."'>".$catinfo["title"]."</a>";
            endif;
            global $rated;
			$rated = $artinfo["score"] != 0 ? substr($artinfo["score"] / $artinfo["ratings"], 0, 4) : 0;
            
			$morelink .= " | "._SCORE." $rated";
            $morelink .= " )"; # added a space here as that is how it belongs! Ernest Buffington 08/09/2019
            $morelink = str_replace(" |  | ", " | ", $morelink);

            if($artinfo["ticon"] == 1): 
              $topicimage = '';
			endif;

            if($artinfo["writes"] == 0): 
              define_once('WRITES', true);
            endif;
			
			$informant = UsernameColor($artinfo["informant"]);

            if($neconfig["columns"] == 1): # DUAL
			 
                if($a == 0): 
			      echo "<tr>";
				endif; 
                
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
            
			    if($a == 2):
				   echo "</tr>"; 
				   $a = 0; 
				else: 
				  echo "<td>&nbsp;</td>"; 
				endif;
             
			else: # SINGLE BLOG
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
		    endif;
        endwhile;
        
		$db->sql_freeresult($result);

        if($neconfig["columns"] == 1): # DUAL BLOG
            if($a ==1): 
			  echo "<td width='50%'>&nbsp;</td></tr>\n"; 
			else: 
			  echo "</tr>\n"; 
			endif;
            echo "</table>\n";
        endif;
        
		echo "\n<!-- PAGING -->\n";
        
		$articlepagesint = ($totalarticles / $storynum);
        
		$articlepageremain = ($totalarticles % $storynum);
        
		if($articlepageremain != 0): 
            $articlepages = ceil($articlepagesint);
		    if($totalarticles < $storynum): 
			  $articlepageremain = 0; 
			endif;
		else: 
            $articlepages = $articlepagesint;
		endif;

        if($articlepages != 1 && $articlepages != 0): 
		
		    OpenTable();
			
            print '<div align="center">';        
		    
		if(defined('pagination')):

			print '<div class="pagination_section">';
            
			$counter = isset($counter) ? $counter : 0;
			
			while($counter <= $articlepages): 
			
                $cpage = $counter;
                
				$mintemp = ($storynum * $counter) - $storynum;
                
				global $name;
				
				if(($mintemp >= 0) && ($name != 'Blogs')):
				 echo '<a style="text-shadow:none;" href="index.php?min='.$mintemp.'">'.$counter.'</a>&nbsp;';
				 elseif($mintemp >= 0):
				 echo '<a style="text-shadow:none;" href="modules.php?name='.$module_name.'&amp;min='.$mintemp.'">'.$counter.'</a>&nbsp;';
				endif;
                
				$counter++;
            endwhile;
           print '</div></div>';

		else:

			$counter = 1;
            
			$currentpage = ($max / $storynum);
		    
			echo "<div align=\"center\"><form action='modules.php?name=$module_name' method='post'>\n";
            echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
            echo "<tr>\n<td><strong>"._BLOG_SELECT." </strong><select name='min' onChange='top.location.href=this.options[this.selectedIndex].value'>\n";
            
		    while($counter <= $articlepages): 
                $cpage = $counter;
                $mintemp = ($storynum * $counter) - $storynum;
			    
				global $name;
			    
				if($counter == $currentpage): 
				
                  echo "<option selected>$counter</option>\n";
                 
				elseif (($mintemp >= 0) && ($name != 'Blogs')): 
				
                  echo "<option value='index.php?min=$mintemp'>$counter</option>\n";
                 
			    else: 
                        echo "<option value='modules.php?name=$module_name&amp;min=$mintemp'>$counter</option>\n";
				endif;
				$counter++;
            endwhile;

            echo "</select> "._BLOG_OF." $articlepages "._BLOG_PAGES."</td>\n</tr>\n";
            echo "</table>\n";
            echo "</form></div>\n";
            
			endif;
			
			if(defined('pagination')):
			
			else:
			  print '<div align="center" style="padding-bottom:16px;">';
              print '</div>';
			endif;
			
 			CloseTable();
        endif;

        echo "<!-- CLOSE PAGING -->\n";
        
		include(NUKE_BASE_DIR."footer.php");
    break;

    case "rate_article":
		$score = (int) $score;

		if($score !== 0): 
            if($score > 5): 
		      $score = 5; 
			endif;
            
			if($score < 1): 
		      $score = 1; 
			endif;
            
			if($score != 1 && $score != 2 && $score != 3 && $score != 4 && $score !== 5): 
                redirect("index.php");
                exit;
            endif;

		    if(isset($_COOKIE[$module_name."".$sid])):
            include_once(NUKE_BASE_DIR."header.php");
			OpenTable();
			$r_options = '&mode=nested&order=0&thold=0';
			echo "<br /><br /><div align=\"center\"><strong>"._ALREADYVOTEDARTICLE."</strong><br /><br />";
            echo "[ <a href='modules.php?name=$module_name&amp;file=article&amp;sid=$sid$r_options'>"._BACKTOARTICLEPAGE."</a> ]</div><br /><br />";
			CloseTable();
			include_once(NUKE_BASE_DIR."footer.php");
			exit;
			endif; 

            if(isset($ratecookie)): 
                $rcookie = base64_decode((string) $ratecookie);
                $r_cookie = explode(":", $rcookie);
            endif;
            $itemsCount = count([$r_cookie]);
            
			for($i=0; $i < $itemsCount; $i++): 
			   if ($r_cookie[$i] == $sid) 
			   $a = 1; 
		    endfor;
            
			if($a == 1): 
                redirect("modules.php?name=$module_name&op=rate_complete&sid=$sid&rated=1");
			else: 
                $result = $db->sql_query("update ".$prefix."_blogs set score=score+$score, ratings=ratings+1 where sid='$sid'");
                $db->sql_freeresult($result);
                $info = base64_encode("$rcookie$sid:");
                setcookie("ratecookie","$info",['expires' => time()+86400]);
                redirect("modules.php?name=Blogs&op=rate_complete&sid=$sid&score=$score");
            endif;
		else: 
            include_once(NUKE_BASE_DIR."header.php");

            OpenTable();

            echo "<div align=\"center\">"._DIDNTRATE."<br /><br />\n";
            echo ""._GOBACK."</div>";

            CloseTable();

            include_once(NUKE_BASE_DIR . "/footer.php");
        endif;
    break;
    case "rate_complete":

        $r_options = "";

        if(is_user()):
		  setcookie($module_name."".$sid, $module_name."".$sid, time()+2*24*60*60);

          if($userinfo['umode']): 
		    $r_options .= "&amp;mode=".$userinfo['umode']; 
		  else: 
		    $r_options .= "&amp;mode=thread"; 
		  endif;
          
		  if($userinfo['uorder']): 
		    $r_options .= "&amp;order=".$userinfo['uorder']; 
		  else: 
		    $r_options .= "&amp;order=0"; 
		  endif;
          
		  if($userinfo['thold']): 
		    $r_options .= "&amp;thold=".$userinfo['thold']; 
		  else: 
		    $r_options .= "&amp;thold=0"; 
		  endif;

        endif;
        
		include_once(NUKE_BASE_DIR."header.php");
        
        OpenTable();

        global $rated;
		if((int)$rated == 0): 
            echo "<br /><br /><div align=\"center\"><strong>"._THANKSVOTEARTICLE."</strong><br /><br />";
            echo "[ <a href='modules.php?name=$module_name&amp;file=article&amp;sid=$sid$r_options'>"._BACKTOARTICLEPAGE."</a> ]</div><br /><br />";
		elseif((int)$rated == 1): 
            echo "<br /><br /><div align=\"center\"><strong>"._ALREADYVOTEDARTICLE."</strong><br /><br />";
            echo "[ <a href='modules.php?name=$module_name&amp;file=article&amp;sid=$sid$r_options'>"._BACKTOARTICLEPAGE."</a> ]</div><br /><br />";
        endif;
        
		CloseTable();
        
		include_once(NUKE_BASE_DIR . "/footer.php");
    break;
endswitch;

