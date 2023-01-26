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

if (!defined('MODULE_FILE')) {
    die ("You can't access this file directly...");
}

$inblog = '';
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

global $admin, $prefix, $db, $module_name, $articlecomm, $multilingual, $admin_file;
if ($multilingual == 1) {
    $queryalang = "AND (s.alanguage='$currentlang' OR s.alanguage='')"; /* stories */
    $queryrlang = "AND rlanguage='$currentlang' "; /* reviews */
} else {
    $queryalang = '';
    $queryrlang = '';
    $queryslang = '';
}

$query = (isset($query)) ? Fix_Quotes($query) : '';
if (!isset($type)) { $type = ''; }
if (!isset($category)) { $category = 0; }
if (!isset($topic)) { $topic = 0; }
if (!isset($days)) { $days = 0; }
if (!isset($author)) { $author = ''; }
if (!isset($op)) { $op = ''; }
if (!isset($sid)) { $sid = 0; } else { $sid = intval($sid); } 

switch($op) {

    case "comments":
    break;

    default:
        $ThemeSel = get_theme();
        $offset = 10;
        if (!isset($min)) $min = 0;
        if (!isset($max)) $max = $min + $offset;
        $min = intval($min);
        $max = intval($max);
        $pagetitle = "- "._SEARCH."";
        include_once(NUKE_BASE_DIR.'header.php');
        title($sitename.' '._SEARCH);
		$topic = intval($topic);
        if ($topic>0) {
            $result = $db->sql_query("SELECT `topicimage`, `topictext` FROM `".$prefix."_blogs_topics` WHERE `topicid`='$topic'");
            $row = $db->sql_fetchrow($result);
            $topicimage = stripslashes($row['topicimage']);
            $topictext = stripslashes(check_html($row['topictext'], "nohtml"));
            
			if (file_exists("themes/$ThemeSel/modules/images/topics/$topicimage")) 
			{
                $topicimage = "themes/$ThemeSel/modules/images/topics/$topicimage";
            } 
			else 
			{
                $topicimage = $tipath.$topicimage;
            }
        } 
		else 
		{
            $topictext = _ALLTOPICS;
        
		    if (file_exists("themes/$ThemeSel/modules/images/topics/AllTopics.png")) 
			{
                $topicimage = "themes/$ThemeSel/modules/images/topics/AllTopics.png";
            } 
			else 
			{
                $topicimage = $tipath.'AllTopics.png';
            }
        }
        
		if (file_exists("themes/$ThemeSel/modules/images/topics/AllTopics.png")) 
		{
            $alltop = "themes/$ThemeSel/modules/images/topics/AllTopics.png";
        } 
		else 
		{
            $alltop = $tipath.'AllTopics.png';
        }
        
		OpenTable();
        if ($type == 'users') {
            echo "<div align=\"center\"><span class=\"title\"><strong>"._SEARCHUSERS."</strong></span></div><br />\n";
        } elseif ($type == 'reviews') {
            echo "<div align=\"center\"><span class=\"title\"><strong>"._SEARCHREVIEWS."</strong></span></div><br />\n";
        } elseif ($type == 'comments' AND isset($sid)) {
            $res = $db->sql_query("SELECT `title` FROM ".$prefix."_blogs WHERE `sid`='$sid'");
            list($st_title) = $db->sql_fetchrow($res);
            $db->sql_freeresult($res);
            $st_title = stripslashes(check_html($st_title, "nohtml"));
            $inblog = "AND sid='$sid'";
            echo "<div align=\"center\"><span class=\"title\"><strong>"._SEARCHINSTORY." $st_title</strong></span></div><br />\n";
        } else {
            echo "<div align=\"center\"><span class=\"title\"><strong>"._SEARCHIN." $topictext</strong></span></div><br />\n";
        }

        echo "<table width=\"100%\" border=\"0\"><TR><TD>";
        if (($type == 'users') || ($type == 'reviews')) {
            echo "<img src=\"$alltop\" align=\"right\" border=\"0\" alt=\"\">";
        } else {
            echo "<img src=\"$topicimage\" align=\"right\" border=\"0\" alt=\"$topictext\">";
        }
        echo "<form action=\"modules.php?name=$module_name\" method=\"POST\">"
        ."<input size=\"25\" type=\"text\" name=\"query\" value=\"".stripslashes($query)."\">&nbsp;&nbsp;"
        ."<input type=\"submit\" value=\""._SEARCH."\"><br /><br />";
        if (isset($sid)) {
            echo "<input type='hidden' name='sid' value='$sid'>";
        }
        echo "<!-- Topic Selection -->\n";
        $toplist = $db->sql_query("SELECT `topicid`, `topictext` FROM `".$prefix."_blogs_topics` ORDER BY `topictext`");
        echo "<select name=\"topic\">";
        echo "<option value=\"\">"._ALLTOPICS."</option>\n";
        while($row2 = $db->sql_fetchrow($toplist)) {
            $topicid = intval($row2['topicid']);
            $topics = stripslashes(check_html($row2['topictext'], "nohtml"));
            if ($topicid == $topic) { $sel = 'selected '; } else { $sel = ''; }
            echo "<option $sel value=\"$topicid\">$topics</option>\n";
        }
        $db->sql_freeresult($toplist);
        echo "</select>\n";
        /* Category Selection */
        $category = intval($category);
        echo "&nbsp;<select name=\"category\">";
        echo "<option value=\"0\">"._BLOGS."</option>\n";
        $result3 = $db->sql_query("SELECT `catid`, `title` FROM `".$prefix."_blogs_cat` ORDER BY `title`");
        while ($row3 = $db->sql_fetchrow($result3)) {
            $catid = intval($row3['catid']);
            $title = stripslashes(check_html($row3['title'], "nohtml"));
            if ($catid==$category) { $sel = 'selected '; } else { $sel = ''; }
            echo "<option $sel value=\"$catid\">$title</option>\n";
        }
        $db->sql_freeresult($result3);
        echo "</select>\n";
        /* Authors Selection */
        $thing = $db->sql_query("SELECT `aid` FROM `".$prefix."_authors` ORDER BY `aid`");
        echo "&nbsp;<select name=\"author\">";
        echo "<option value=\"\">"._ALLAUTHORS."</option>\n";
        while($row4 = $db->sql_fetchrow($thing)) {
            $authors = stripslashes($row4['aid']);
            if ($authors==$author) { $sel = 'selected '; } else { $sel = ''; }
            echo "<option value=\"$authors\" $sel>$authors</option>\n";
        }
        $db->sql_freeresult($thing);
        echo "</select>\n";
        /* Date Selection */
                    ?>
            &nbsp;<select name="days">
                            <option <?php echo $days == 0 ? "selected " : ""; ?> value="0"><?php echo _ALL ?></option>
                            <option <?php echo $days == 7 ? "selected " : ""; ?> value="7">1 <?php echo _WEEK ?></option>
                            <option <?php echo $days == 14 ? "selected " : ""; ?> value="14">2 <?php echo _WEEKS ?></option>
                            <option <?php echo $days == 30 ? "selected " : ""; ?> value="30">1 <?php echo _MONTH ?></option>
                <option <?php echo $days == 60 ? "selected " : ""; ?> value="60">2 <?php echo _MONTHS ?></option>
                            <option <?php echo $days == 90 ? "selected " : ""; ?> value="90">3 <?php echo _MONTHS ?></option>
                    </select><br />
            <?php
            $sel1 = $sel2 = $sel3 = $sel4 = "";
            if (($type == 'stories') || (empty($type))) {
                $sel1 = 'checked';
            } elseif ($type == 'comments') {
                $sel2 = 'checked';
            } elseif ($type == 'users') {
                $sel3 = 'checked';
            } elseif ($type == 'reviews') {
                $sel4 = 'checked';
            }
            $num_rev = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_reviews`"));
            echo _SEARCHON;
            echo "<input type=\"radio\" name=\"type\" value=\"stories\" $sel1> "._SSTORIES;
            if ($articlecomm == 1) {
                echo "<input type=\"radio\" name=\"type\" value=\"comments\" $sel2> "._SCOMMENTS;
            }
            echo "<input type=\"radio\" name=\"type\" value=\"users\" $sel3> "._SUSERS;
            if ($num_rev > 0) {
                echo "<input type=\"radio\" name=\"type\" value=\"reviews\" $sel4> "._REVIEWS;
            }
            echo "</form></td></tr></table>";
            $query = htmlentities($query, ENT_QUOTES);
            if ($type == 'stories' || !$type) {

                if ($category > 0) {
                    $categ = "AND catid='$category' ";
                } else {
                    $categ = '';
                }
                $q = "SELECT s.sid, 
				             s.aid, 
					   s.informant, 
					       s.title, 
				   s.datePublished, 
				        s.hometext, 
						s.bodytext, 
						     a.url, 
						s.comments, 
						   s.topic FROM ".$prefix."_blogs s, ".$prefix."_authors a WHERE s.aid=a.aid $queryalang $categ";
                
				if (isset($query)) $q .= "AND (s.title LIKE '%$query%' OR s.hometext LIKE '%$query%' OR s.bodytext LIKE '%$query%' OR s.notes LIKE '%$query%') ";
                if (!empty($author)) $q .= "AND s.aid='".Fix_Quotes($author)."' ";
                if (!empty($topic)) $q .= "AND s.topic='".Fix_Quotes($topic)."' ";
                if (!empty($days) && $days!=0) $q .= "AND TO_DAYS(NOW()) - TO_DAYS(datePublished) <= '".Fix_Quotes($days)."' ";
                $q .= " ORDER BY s.datePublished DESC LIMIT $min,$offset";
                $t = $topic;
                $result5 = $db->sql_query($q);
                $nrows = $db->sql_numrows($result5);
                $x=0;
                if (!empty($query)) {
                    echo "<br /><hr noshade size=\"1\"><div align=\"center\"><strong>"._SEARCHRESULTS."</strong></div><br /><br />";
                    echo "<table width=\"99%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n";
                    if ($nrows>0) {
                        while($row5 = $db->sql_fetchrow($result5)) {
                            $sid = intval($row5['sid']);
                            $aid = stripslashes($row5['aid']);
                            $informant = stripslashes($row5['informant']);
                            $title = stripslashes(check_html($row5['title'], "nohtml"));
                            $time = $row5['datePublished'];
                            $hometext = stripslashes($row5['hometext']);
                            $bodytext = stripslashes($row5['bodytext']);
                            $url = stripslashes($row5['url']);
                            $comments = intval($row5['comments']);
                            $topic = intval($row5['topic']);
                            $row6 = $db->sql_fetchrow($db->sql_query("SELECT `topictext` FROM `".$prefix."_blogs_topics` WHERE `topicid`='$topic'"));
                            $topictext = stripslashes(check_html($row6['topictext'], "nohtml"));

                            $furl = "modules.php?name=Blogs&amp;file=article&amp;sid=$sid";
                            $datetime = formatTimestamp($time);
                            $query = stripslashes(htmlentities($query, ENT_QUOTES));
                            if (empty($informant)) {
                                $informant = $anonymous;
                            } else {
                                $informant = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant\">$informant</a>";
                            }
                            if (!empty($query) AND $query != '*') {
                                if (preg_match('#'.quotemeta($query).'#i',$title)) {
                                    $a = 1;
                                }
                                $text = $hometext.$bodytext;
                                if (preg_match('#'.quotemeta($query).'#i',$text)) {
                                    $a = 2;
                                }
                                if (preg_match('#'.quotemeta($query).'#i',$text) AND preg_match('#'.quotemeta($query).'#i',$title)) {
                                    $a = 3;
                                }
                                if ($a == 1) {
                                    $match = _MATCHTITLE;
                                } elseif ($a == 2) {
                                    $match = _MATCHTEXT;
                                } elseif ($a == 3) {
                                    $match = _MATCHBOTH;
                                }
                                if (!isset($a)) {
                                    $match = '';
                                } else {
                                    $match = $match.'<br />';
                                }
                            }
                            printf("<tr><td><img src=\"images/folders.gif\" border=\"0\" alt=\"\">&nbsp;<span class=\"option\"><a href=\"%s\"><strong>%s</strong></a></span><br /><span class=\"content\">"._CONTRIBUTEDBY." $informant<br />"._POSTEDBY." <a href=\"%s\">%s</a>",$furl,$title,$url,$aid,$informant);
                            echo " "._ON." $datetime<br />"
                            .$match
                            ._TOPIC.": <a href=\"modules.php?name=$module_name&amp;query=&amp;topic=$topic\">$topictext</a> ";
                            if ($comments == 0) {
                                echo '('._NOCOMMENTS.')';
                            } elseif ($comments == 1) {
                                echo "($comments "._UCOMMENT.")";
                            } elseif ($comments >1) {
                                echo "($comments "._UCOMMENTS.")";
                            }
                            if (is_mod_admin($module_name)) {
                                echo " [ <a href=\"".$admin_file.".php?op=EditBlog&amp;sid=$sid\">"._EDIT."</a> | <a href=\"".$admin_file.".php?op=RemoveBlog&amp;sid=$sid\">"._DELETE."</a> ]";
                            }
                            echo "</span><br /><br /><br /></td></tr>\n";
                            $x++;
                        }
                        $db->sql_freeresult($result5);
                        echo "</table>\n";
                    } else {
                        echo "<tr><td><div align=\"center\"><span class=\"option\"><strong>"._NOMATCHES."</strong></span></div><br /><br />";
                        echo "</td></tr></table>\n";
                    }

                    $prev = $min-$offset;
                    if ($prev>=0) {
                        print "<br /><br /><div align=\"center\"><a href=\"modules.php?name=$module_name&amp;author=$author&amp;topic=$t&amp;min=$prev&amp;query=$query&amp;type=$type&amp;category=$category\">";
                        print "<strong>$min "._PREVMATCHES."</strong></a></div>";
                    }

                    $next = $min+$offset;
                    if ($x>=9) {
                        print "<br /><br /><div align=\"center\"><a href=\"modules.php?name=$module_name&amp;author=$author&amp;topic=$t&amp;min=$max&amp;query=$query&amp;type=$type&amp;category=$category\">";
                        print "<strong>"._NEXTMATCHES."</strong></a></div>";
                    }
                }

            } elseif ($type == 'comments') {
                $result8 = $db->sql_query("SELECT `tid`, `sid`, `subject`, `datePublished`, `name` FROM `".$prefix."_blogs_comments` WHERE (`subject` LIKE '%$query%' OR `comment` LIKE '%$query%') ORDER BY `datePublished` DESC LIMIT $min,$offset");
                $nrows = $db->sql_numrows($result8);
                $x=0;
                if (!empty($query)) {
                    echo "<br /><hr noshade size=\"1\"><div align=\"center\"><strong>"._SEARCHRESULTS."</strong></div><br /><br />";
                    echo "<table width=\"99%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n";
                    if ($nrows>0) {
                        while($row8 = $db->sql_fetchrow($result8)) {
                            $tid = intval($row8['tid']);
                            $sid = intval($row8['sid']);
                            $subject = stripslashes(check_html($row8['subject'], "nohtml"));
                            $date = $row8['date'];
                            $name = stripslashes($row8['name']);
                            $row_res = $db->sql_fetchrow($db->sql_query("SELECT `title` FROM `".$prefix."_blogs` WHERE `sid`='$sid'"));
                            $title = stripslashes(check_html($row_res['title'], "nohtml"));
                            $reply = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_blogs_comments WHERE pid='$tid'"));
                            $furl = "modules.php?name=Blogs&amp;file=article&amp;thold=-1&amp;mode=flat&amp;order=1&amp;sid=$sid#$tid";
                            if(!$name) {
                                $name = $anonymous;
                            } else {
                                $name = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$name\">$name</a>";
                            }
                            $datetime = formatTimestamp($date);
                            echo "<tr><td><img src=\"images/folders.gif\" border=\"0\" alt=\"\">&nbsp;<span class=\"option\"><a href=\"$furl\"><strong>$subject</strong></a></span><span class=\"content\"><br />"._POSTEDBY." $name"
                            ." "._ON." $datetime<br />"
                            ._ATTACHART.": $title<br />";
                            if ($reply == 1) {
                                echo "($reply "._SREPLY.")";
                                if (is_mod_admin($module_name)) {
                                    echo " [ <a href=\"".$admin_file.".php?op=RemoveComment&amp;tid=$tid&amp;sid=$sid\">"._DELETE."</a> ]";
                                }
                                echo "<br /><br /><br /></td></tr>\n";
                            } else {
                                echo "($reply "._SREPLIES.")";
                                if (is_mod_admin($module_name)) {
                                    echo " [ <a href=\"".$admin_file.".php?op=RemoveComment&amp;tid=$tid&amp;sid=$sid\">"._DELETE."</a> ]";
                                }
                                echo "<br /><br /><br /></td></tr>\n";
                            }
                            $x++;
                        }
                        $db->sql_freeresult($result8);
                        echo "</table>";
                    } else {
                        echo "<tr><td><div align=\"center\"><span class=\"option\"><strong>"._NOMATCHES."</strong></span></div><br /><br />";
                        echo "</td></tr></table>";
                    }

                    $prev = $min-$offset;
                    if ($prev>=0) {
                        print "<br /><br /><div align=\"center\"><a href=\"modules.php?name=$module_name&amp;author=$author&amp;topic=$topic&amp;min=$prev&amp;query=$query&amp;type=$type\">";
                        print "<strong>$min "._PREVMATCHES."</strong></a></div>";
                    }

                    $next = $min+$offset;
                    if ($x>=9) {
                        print "<br /><br /><div align=\"center\"><a href=\"modules.php?name=$module_name&amp;author=$author&amp;topic=$topic&amp;min=$max&amp;query=$query&amp;type=$type\">";
                        print "<strong>"._NEXTMATCHES."</strong></a></div>";
                    }
                }
            } elseif ($type == 'reviews') {
                $res_n = $db->sql_query("SELECT id, title, text, reviewer, score FROM ".$prefix."_reviews WHERE (title LIKE '%$query%' OR text LIKE '%$query%') $queryrlang ORDER BY date DESC LIMIT $min,$offset");
                $nrows = $db->sql_numrows($res_n);
                $x=0;
                if (!empty($query)) {
                    echo "<br /><hr noshade size=\"1\"><div align=\"center\"><strong>"._SEARCHRESULTS."</strong></div><br /><br />";
                    echo "<table width=\"99%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n";
                    if ($nrows > 0) {
                        while($rown = $db->sql_fetchrow($res_n)) {
                            $id = intval($rown['id']);
                            $title = stripslashes(check_html($rown['title'], "nohtml"));
                            $text = stripslashes($rown['text']);
                            $reviewer = stripslashes($rown['reviewer']);
                            $score = intval($rown['score']);
                            $furl = "modules.php?name=Reviews&amp;op=showcontent&amp;id=$id";
                            $pages = count(explode( "<!--pagebreak-->", $text ));
                            echo "<tr><td><img src=\"images/folders.gif\" border=\"0\" alt=\"\">&nbsp;<span class=\"option\"><a href=\"$furl\"><strong>$title</strong></a></span><br />"
                            ."<span class=\"content\">"._POSTEDBY." $reviewer<br />"
                            ._REVIEWSCORE.": $score/10<br />";
                            if ($pages == 1) {
                                echo "($pages "._PAGE.")";
                            } else {
                                echo "($pages "._PAGES.")";
                            }
                            if (is_mod_admin($module_name)) {
                                echo " [ <a href=\"modules.php?name=Reviews&amp;op=mod_review&amp;id=$id\">"._EDIT."</a> | <a href=\"modules.php?name=Reviews.php&amp;op=del_review&amp;id_del=$id\">"._DELETE."</a> ]";
                            }
                            print "<br /><br /><br /></span></td></tr>\n";
                            $x++;
                        }
                        $db->sql_freeresult($res_n);
                        echo "</table>\n";
                    } else {
                        echo "<tr><td><div align=\"center\"><span class=\"option\"><strong>"._NOMATCHES."</strong></span></div><br /><br />";
                        echo "</td></tr></table>\n";
                    }

                    $prev = $min-$offset;
                    if ($prev >= 0) {
                        print "<br /><br /><div align=\"center\"><a href=\"modules.php?name=$module_name&amp;author=$author&amp;topic=$t&amp;min=$prev&amp;query=$query&amp;type=$type\">";
                        print "<strong>$min "._PREVMATCHES."</strong></a></div>";
                    }

                    $next=$min+$offset;
                    if ($x >= 9) {
                        print "<br /><br /><div align=\"center\"><a href=\"modules.php?name=$module_name&amp;author=$author&amp;topic=$t&amp;min=$max&amp;query=$query&amp;type=$type\">";
                        print "<strong>"._NEXTMATCHES."</strong></a></div>";
                    }
                }
            } elseif ($type == 'users') {
                $res_n3 = $db->sql_query("SELECT user_id, username, name FROM ".$user_prefix."_users WHERE (username LIKE '%$query%' OR name LIKE '%$query%' OR bio LIKE '%$query%') ORDER BY username ASC LIMIT $min,$offset");
                $nrows = $db->sql_numrows($res_n3);
                $x=0;
                if (!empty($query)) {
                    echo "<br /><hr noshade size=\"1\"><div align=\"center\"><strong>"._SEARCHRESULTS."</strong></div><br /><br />";
                    echo "<table width=\"99%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n";
                    if ($nrows > 0) {
                        while($rown3 = $db->sql_fetchrow($res_n3)) {
                            $uid = intval($rown3['user_id']);
                            $uname = stripslashes($rown3['username']);
                            $name = stripslashes($rown3['name']);
                            $furl = "modules.php?name=Your_Account&amp;op=userinfo&amp;username=$uname";
                            if (empty($name)) {
                                $name = ""._NONAME."";
                            }
                            echo "<tr><td><img src=\"images/folders.gif\" border=\"0\" alt=\"\">&nbsp;<span class=\"option\"><a href=\"$furl\"><strong>$uname</strong></a></span><span class=\"content\"> ($name)";
                            if (is_mod_admin($module_name)) {
                                echo " [ <a href=\"".$admin_file.".php?chng_uid=$uid&amp;op=modifyUser\">"._EDIT."</a> | <a href=\"".$admin_file.".php?op=delUser&amp;chng_uid=$uid\">"._DELETE."</a> ]";
                            }
                            echo "</span></td></tr>\n";
                            $x++;
                        }
                        $db->sql_freeresult($res_n3);
                        echo "</table>\n";
                    } else {
                        echo "<tr><td><div align=\"center\"><span class=\"option\"><strong>"._NOMATCHES."</strong></span></div><br /><br />";
                        echo "</td></tr></table>\n";
                    }

                    $prev = $min-$offset;
                    if ($prev >= 0) {
                        print "<br /><br /><div align=\"center\"><a href=\"modules.php?name=$module_name&amp;author=$author&amp;topic=$t&amp;min=$prev&amp;query=$query&amp;type=$type\">";
                        print "<strong>$min "._PREVMATCHES."</strong></a></div>";
                    }

                    $next = $min+$offset;
                    if ($x >= 9) {
                        print "<br /><br /><div align=\"center\"><a href=\"modules.php?name=$module_name&amp;author=$author&amp;topic=$t&amp;min=$max&amp;query=$query&amp;type=$type\">";
                        print "<strong>"._NEXTMATCHES."</strong></a></div>";
                    }
                }
            }
            CloseTable();
            $mod1 = $mod2 = $mod3 = '';
            if (isset($query) AND !empty($query)) {
                if (is_active('Downloads')) {
                    $dcnt = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_downloads_downloads` WHERE `title` LIKE '%$query%' OR `description` LIKE '%$query%'"));
                    $mod1 = "<li> <a href=\"modules.php?name=Downloads&amp;d_op=search&amp;query=$query\">"._DOWNLOADS."</a> ($dcnt "._SEARCHRESULTS.")";
                }
                if (is_active('Web_Links')) {
                    $lcnt = $db->sql_numrows($db->sql_query("SELECT * FROM `".$prefix."_links_links` WHERE `title` LIKE '%$query%' OR `description` LIKE '%$query%'"));
                    $mod2 = "<li> <a href=\"modules.php?name=Web_Links&amp;l_op=search&amp;query=$query\">"._WEBLINKS."</a> ($lcnt "._SEARCHRESULTS.")";
                }
                if (is_active('Encyclopedia')) {
                    $ecnt1 = $db->sql_query("SELECT `eid` FROM `".$prefix."_encyclopedia` WHERE `active`='1'");
                    $ecnt = 0;
                    while($row_e = $db->sql_fetchrow($ecnt1)) {
                        $eid = intval($row_e['eid']);
                        $ecnt2 = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_encyclopedia WHERE title LIKE '%$query%' OR description LIKE '%$query%' AND eid='$eid'"));
                        $ecnt3 = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_encyclopedia_text WHERE title LIKE '%$query%' OR text LIKE '%$query%' AND eid='$eid'"));
                        $ecnt = $ecnt+$ecnt2+$ecnt3;
                    }
                    $db->sql_freeresult($ecnt1);
                    $mod3 = "<li> <a href=\"modules.php?name=Encyclopedia&amp;file=search&amp;query=$query\">"._ENCYCLOPEDIA."</a> ($ecnt "._SEARCHRESULTS.")";
                }
                OpenTable();
                echo "<span class=\"title\">"._FINDMORE."<br /><br />"
                ._DIDNOTFIND."</span><br /><br />"
                ._SEARCH." \"<strong>$query</strong>\" "._ON.":<br /><br />"
                ."<ul>"
                .$mod1
                .$mod2
                .$mod3
                ."<li> <a href=\"http://www.google.com/search?q=$query\" target=\"new\">Google</a>"
                ."<li> <a href=\"http://groups.google.com/groups?q=$query\" target=\"new\">Google Groups</a>"
                ."</ul>";
                CloseTable();
            }
            include_once(NUKE_BASE_DIR.'footer.php');
        break;
}

?>