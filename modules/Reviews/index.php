<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/* V1.2                                                                 */
/* =====================                                                */
/* Base on Reviews Addon                                                */
/* Copyright (c) 2000 by Jeff Lambert (jeffx@ican.net)                  */
/* http://www.qchc.com                                                  */
/* More scripts on http://www.jeffx.qchc.com                            */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
/*         Additional security & Abstraction layer conversion           */
/*                           2003 chatserv                              */
/*      http://www.nukefixes.com -- http://www.nukeresources.com        */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
      Caching System                           v1.0.0       10/31/2005
-=[Mod]=-
      Reviews BBCodes                          v1.0.0       08/19/2005
      Advanced Username Color                  v1.0.6       11/19/2005
      Custom Text Area                         v1.0.0       11/23/2005
-=[Other]=-
      Review Background Color Fix              v1.0.0       06/23/2005
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die('You can\'t access this file directly...');
}

$titanium_module_name = basename(dirname(__FILE__));
get_lang($titanium_module_name);

function alpha() {
    global $titanium_module_name;
    $alphabet = array ("A","B","C","D","E","F","G","H","I","J","K","L","M",
                       "N","O","P","Q","R","S","T","U","V","W","X","Y","Z","1","2","3","4","5","6","7","8","9","0");
    $num = count($alphabet) - 1;
    echo "<center>[ ";
    $counter = 0;
    while (list(, $ltr) = each($alphabet)) {
        echo "<a href=\"modules.php?name=$titanium_module_name&amp;rop=$ltr\">$ltr</a>";
        if ( $counter == round($num/2) ) {
            echo " ]\n<br />\n[ ";
        } elseif ( $counter != $num ) {
            echo "&nbsp;|&nbsp;\n";
        }
        $counter++;
    }
    echo " ]</center><br /><br />\n\n\n";
    echo "<center>[ <a href=\"modules.php?name=$titanium_module_name&amp;rop=write_review\">"._WRITEREVIEW."</a> ]</center><br /><br />\n\n";
}

function display_score($score) {
    $image = "<img src=\"images/blue.gif\" alt=\"\">";
    $halfimage = "<img src=\"images/bluehalf.gif\" alt=\"\">";
    $full = "<img src=\"images/star.gif\" alt=\"\">";

    if ($score == 10) {
        for ($i=0; $i < 5; $i++)
            echo $full;
    } else if ($score % 2) {
        $score -= 1;
        $score /= 2;
        for ($i=0; $i < $score; $i++)
            echo $image;
        echo $halfimage;
    } else {
        $score /= 2;
        for ($i=0; $i < $score; $i++)
            echo $image;
    }
}

function write_review() {
    global $admin, $sitename, $titanium_user, $cookie, $titanium_prefix, $titanium_user_prefix, $currentlang, $multilingual, $titanium_db, $titanium_module_name, $anonpost;
    
    //Prevent Anonymous
    if(!is_user($titanium_user) && !$anonpost){
        Header("Location: modules.php?name=Your_Account&op=login&redirect=Reviews");
        die();
    }

    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    echo "<strong>"._WRITEREVIEWFOR." $sitename</strong><br /><br />"
    ."<i>"._ENTERINFO."</i><br /><br />"
/*****[BEGIN]******************************************
 [ Mod:     Reviews BBCodes                    v1.0.0 ]
 ******************************************************/
    ."<form name=\"postreviews\" method=\"post\" action=\"modules.php?name=$titanium_module_name\">"
/*****[END]********************************************
 [ Mod:     Reviews BBCodes                    v1.0.0 ]
 ******************************************************/
    ."<strong>"._PRODUCTTITLE.":</strong><br />"
    ."<input type=\"text\" name=\"title\" size=\"50\" maxlength=\"150\"><br />"
    ."<i>"._NAMEPRODUCT."</i><br />";
    if ($multilingual == 1) {
        echo "<br /><strong>"._LANGUAGE.": </strong>"
            ."<select name=\"rlanguage\">";
        $titanium_languages = lang_list();
        echo '<option value=""'.((strtolower($currentlang) == '') ? ' selected="selected"' : '').'>'._ALL."</option>\n";
        for ($i=0, $j = count($titanium_languages); $i < $j; $i++) {
            if ($titanium_languages[$i] != '') {
                echo '<option value="'.$titanium_languages[$i].'"'.((strtolower($currentlang) == $titanium_languages[$i]) ? ' selected="selected"' : '').'>'.ucfirst($titanium_languages[$i])."</option>\n";
            }
        }
        echo '</select><br /><br />';
    } else {
        echo "<input type=\"hidden\" name=\"rlanguage\" value=\"$rlanguage\"><br /><br />";
    }
/*****[BEGIN]******************************************
 [ Mod:     Custom Text Area                   v1.0.0 ]
 ******************************************************/
    Make_TextArea('text', $text, 'postreviews');
/*****[END]********************************************
 [ Mod:     Custom Text Area                   v1.0.0 ]
 ******************************************************/
    if (is_mod_admin($titanium_module_name)) {
        echo "<span class=\"content\">"._PAGEBREAK."</span><br />";
    }
    echo "
    <i>"._CHECKREVIEW."</i><br /><br />
    <strong>"._YOURNAME.":</strong><br />";
    if (is_user()) {
        $result = $titanium_db->sql_query("SELECT username, user_email FROM ".$titanium_user_prefix."_users WHERE user_id = '".intval($cookie[0])."'");
        list($rname, $email) = $titanium_db->sql_fetchrow($result);
        $titanium_db->sql_freeresult($result);
        $rname = stripslashes(check_html($rname, "nohtml"));
        $email = stripslashes(check_html($email, "nohtml"));
    }
    else {
        $rname = '';
        $email = '';
    }
    echo "<input type=\"text\" name=\"reviewer\" size=\"41\" maxlength=\"40\" value=\"$rname\"><br />
        <i>"._FULLNAMEREQ."</i><br /><br />
        <strong>"._REMAIL.":</strong><br />
        <input type=\"text\" name=\"email\" size=\"40\" maxlength=\"80\" value=\"$email\"><br />
        <i>"._REMAILREQ."</i><br /><br />
        <strong>"._SCORE."</strong><br />
        <select name=\"score\">
        <option name=\"score\" value=\"10\">10</option>
        <option name=\"score\" value=\"9\">9</option>
        <option name=\"score\" value=\"8\">8</option>
        <option name=\"score\" value=\"7\">7</option>
        <option name=\"score\" value=\"6\">6</option>
        <option name=\"score\" value=\"5\">5</option>
        <option name=\"score\" value=\"4\">4</option>
        <option name=\"score\" value=\"3\">3</option>
        <option name=\"score\" value=\"2\">2</option>
        <option name=\"score\" value=\"1\">1</option>
        </select>
        <i>"._SELECTSCORE."</i><br /><br />
        <strong>"._RELATEDLINK.":</strong><br />
        <input type=\"text\" name=\"url\" size=\"40\" maxlength=\"100\" placeholder=\"https://\"><br />
        <i>"._PRODUCTSITE."</i><br /><br />
        <strong>"._LINKTITLE.":</strong><br />
        <input type=\"text\" name=\"url_title\" size=\"40\" maxlength=\"50\"><br />
        <i>"._LINKTITLEREQ."</i><br /><br />
    ";
    if(is_mod_admin($titanium_module_name)) {
        echo "<strong>"._RIMAGEFILE.":</strong><br />
            <input type=\"text\" name=\"cover\" size=\"40\" maxlength=\"100\"><br />
            <i>"._RIMAGEFILEREQ."</i><br /><br />
        ";
    }
    echo "<i>"._CHECKINFO."</i><br /><br />
        <input type=\"hidden\" name=\"rop\" value=\"preview_review\">
        <input type=\"submit\" value=\""._PREVIEW."\"> <input type=\"button\" onClick=\"history.go(-1)\" value=\""._CANCEL."\"></form>
    ";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function preview_review($date, $title, $text, $reviewer, $email, $score, $cover, $url, $url_title, $hits, $id, $rlanguage) {
    global $admin, $multilingual, $titanium_module_name, $anonpost, $phpbb2_board_config;

    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    echo "<form method=\"post\" action=\"modules.php?name=$titanium_module_name\">";

    if (empty($title)) {
        $error = 1;
        echo _INVALIDTITLE."<br />";
    }
    if (empty($text)) {
        $error = 1;
        echo _INVALIDTEXT."<br />";
    }
    if (($score < 1) || ($score > 10)) {
        $error = 1;
        echo _INVALIDSCORE."<br />";
    }
    if (($hits < 0) && ($id != 0)) {
        $error = 1;
        echo _INVALIDHITS."<br />";
    }
    if (empty($reviewer) || empty($email)) {
        $error = 1;
        echo _CHECKNAME."<br />";
    } else if (!empty($reviewer) && !empty($email)) {
        if (!Validate($email, 'email', '', 1, 1)) {
            $error = 1;
            echo _INVALIDEMAIL."<br />";
        }
    }
    if ((!empty($url_title) && empty($url)) || (empty($url_title) && !empty($url))) {
        $error = 1;
        echo _INVALIDLINK."<br />";
    } else if(!empty($url) && !Validate($url,'url','',1,1)) {
        $error = 1;
        echo _INVALIDURL."<br />";
    } else if (!empty($url)) {
        if (substr($url,0,strlen('http://')) != 'http://') {
            $url = 'http://' . $url;
        }
    }
    if (isset($error) AND ($error == 1)) 
        echo "<br />"._GOBACK;
    else
    {
        if (preg_match("#<!--pagebreak-->#i", $text)) {
            $text = str_replace("<!--pagebreak-->","&lt;!--pagebreak--&gt;",$text);
        }
        session_start();
        if(isset($_SESSION['title'])) unset($_SESSION['title']);
        if(isset($_SESSION['text'])) unset($_SESSION['text']);
        
        $title = check_html($title, "nohtml");
    /*****[BEGIN]******************************************
     [ Mod:     Reviews BBCodes                    v1.0.0 ]
     ******************************************************/
        $text = decode_bbcode(set_smilies($text), 1, true);
    /*****[END]********************************************
     [ Mod:     Reviews BBCodes                    v1.0.0 ]
     ******************************************************/
        $reviewer = stripslashes(check_html($reviewer, "nohtml"));
        $url_title = stripslashes(check_html($url_title, "nohtml"));
        $email = stripslashes(check_html($email, "nohtml"));
        $score = intval($score);
        $cover = stripslashes(check_html($cover, "nohtml"));
        $url = stripslashes(check_html($url, "nohtml"));
        $url_title = stripslashes(check_html($url_title, "nohtml"));
        $hits = intval($hits);
        $id = intval($id);
        if (empty($date))
            $date = date("Y-m-d", time());
        $year2 = substr($date,0,4);
        $month = substr($date,5,2);
        $day = substr($date,8,2);
				$fdate = EvoDate($phpbb2_board_config['default_dateformat'], mktime (0,0,0,$month,$day,$year), $phpbb2_board_config['board_timezone']);
        echo "<table border=\"0\" width=\"100%\"><tr><td colspan=\"2\">";
        echo "<p><span class=\"title\"><i><strong>".stripslashes($title)."</strong></i></span><br />";
        echo "<blockquote><p>";
        if (!empty($cover))
            echo "<img src=\"images/reviews/$cover\" align=\"right\" border=\"1\" vspace=\"2\" alt=\"\">";
        echo stripslashes($text)."<p>";
        echo "<strong>"._ADDED."</strong> $fdate<br />";
        if ($multilingual == 1) {
            echo "<strong>"._LANGUAGE."</strong> $rlanguage<br />";
        }
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.6 ]
 ******************************************************/
        $phpbb2_color_review = ($anonpost) ? $reviewer : UsernameColor($reviewer);
        echo "<strong>"._REVIEWER."</strong> <a href=\"mailto:$email\">".$phpbb2_color_review."</a><br />";
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.6 ]
 ******************************************************/
        echo "<strong>"._SCORE."</strong> ";
        display_score($score);
        if (!empty($url))
            echo "<br /><strong>"._RELATEDLINK.":</strong> <a href=\"$url\" target=\"new\">$url_title</a>";
        $id = intval($id);
        if ($id != 0) {
            echo "<br /><strong>"._REVIEWID.":</strong> $id<br />";
            echo "<strong>"._HITS.":</strong> $hits<br />";
        }
        $_SESSION['title'] = $title;
        $_SESSION['text'] = $text;
        echo "</span></blockquote>";
        echo "</td></tr></table>";
        echo "<p><i>"._LOOKSRIGHT."</i> ";
        echo "<input type=\"hidden\" name=\"id\" value=$id>
          <input type=\"hidden\" name=\"hits\" value=\"$hits\">
          <input type=\"hidden\" name=\"rop\" value=send_review>
          <input type=\"hidden\" name=\"date\" value=\"$date\">
          <input type=\"hidden\" name=\"reviewer\" value=\"$reviewer\">
          <input type=\"hidden\" name=\"email\" value=\"$email\">
          <input type=\"hidden\" name=\"score\" value=\"$score\">
          <input type=\"hidden\" name=\"url\" value=\"$url\">
          <input type=\"hidden\" name=\"url_title\" value=\"$url_title\">
          <input type=\"hidden\" name=\"cover\" value=\"$cover\">";
          echo "<input type=\"hidden\" name=\"rlanguage\" value=\"$rlanguage\">";
        echo "<input type=\"submit\" name=\"rop\" value=\""._YES."\"> <input type=\"button\" onClick=\"history.go(-1)\" value=\""._NO."\">";
        $id = intval($id);
        if($id != 0)
            $word = _RMODIFIED;
        else
            $word = _RADDED;
        if(is_mod_admin($titanium_module_name))
            echo "<br /><br /><strong>"._NOTE."</strong> "._ADMINLOGGED." $word.";
    }
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function send_review($date, $title, $text, $reviewer, $email, $score, $cover, $url, $url_title, $hits, $id, $rlanguage) {
    global $admin, $EditedMessage, $titanium_prefix, $titanium_db, $titanium_module_name, $cache;

    session_start();
    if(isset($_SESSION['title'])) {
        $title = $_SESSION['title'];
        unset($_SESSION['title']);
    }
    if(isset($_SESSION['text'])) {
        $text = $_SESSION['text'];
        unset($_SESSION['text']);
    }
    
    include_once(NUKE_BASE_DIR.'header.php');
    if (preg_match("#<!--pagebreak-->#i", $text)) {
        $text = str_replace("<!--pagebreak-->","&lt;!--pagebreak--&gt;;",$text);
    }
    $id = intval($id);
    $title = Fix_Quotes(check_html($title, "nohtml"));
    $text = Fix_Quotes($text);
    $reviewer = Fix_Quotes(check_html($reviewer, "nohtml"));
    $url_title = Fix_Quotes(check_html($url_title, "nohtml"));
    $email = Fix_Quotes(check_html($email, "nohtml"));
    $score = intval($score);
    $cover = Fix_Quotes(check_html($cover, "nohtml"));
    $url = Fix_Quotes(check_html($url, "nohtml"));
    $url_title = Fix_Quotes(check_html($url_title, "nohtml"));
    $hits = intval($hits);
    if (preg_match("#&lt;!--pagebreak--&gt;#i", $text)) {
        $text = str_replace("&lt;!--pagebreak--&gt;","<!--pagebreak-->",$text);
    }
    OpenTable();
    echo "<br /><center>"._RTHANKS."";
    $id = intval($id);
    if ($id != 0)
        echo " "._MODIFICATION."";
    else
        echo ", ".stripslashes($reviewer);
    echo "!<br />";
    if ($score < 0 OR $score > 10) {
        $score = 0;
    }
    if ((is_mod_admin($titanium_module_name)) && ($id == 0)) {
        $titanium_db->sql_query("INSERT INTO ".$titanium_prefix."_reviews VALUES (NULL, '$date', '$title', '$text', '$reviewer', '$email', '$score', '$cover', '$url', '$url_title', '1', '$rlanguage')");
        echo ""._ISAVAILABLE."";
    } else if ((is_mod_admin($titanium_module_name)) && ($id != 0)) {
        $titanium_db->sql_query("UPDATE ".$titanium_prefix."_reviews SET date='$date', title='$title', text='$text', reviewer='$reviewer', email='$email', score='$score', cover='$cover', url='$url', url_title='$url_title', hits='$hits', rlanguage='$rlanguage' WHERE id = '$id'");
        echo ""._ISAVAILABLE."";
    } else {
        $titanium_db->sql_query("INSERT INTO ".$titanium_prefix."_reviews_add VALUES (NULL, '$date', '$title', '$text', '$reviewer', '$email', '$score', '$url', '$url_title', '$rlanguage')");
        echo ""._EDITORWILLLOOK."";
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
        $cache->delete('numwaitreviews', 'submissions');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    }
    echo "<br /><br />[ <a href=\"modules.php?name=$titanium_module_name\">"._RBACK."</a> ]<br /></center>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function reviews_index() {
    global $bgcolor3, $bgcolor2, $titanium_prefix, $multilingual, $currentlang, $titanium_db, $titanium_module_name;

    include_once(NUKE_BASE_DIR.'header.php');
    if ($multilingual == 1) {
        $querylang = "WHERE rlanguage='$currentlang'";
    } else {
        $querylang = '';
    }
    OpenTable();
    echo "<table border=\"0\" width=\"95%\" cellpadding=\"2\" cellspacing=\"4\" align=\"center\">
    <tr><td colspan=\"2\"><center><span class=\"title\">"._RWELCOME."</span></center><br /><br /><br />";
    $result = $titanium_db->sql_query("SELECT title, description FROM ".$titanium_prefix."_reviews_main");
    list($title, $description) = $titanium_db->sql_fetchrow($result);
    $titanium_db->sql_freeresult($result);
    $title = stripslashes(check_html($title, "nohtml"));
    $description = stripslashes($description);
    echo "<center><strong>$title</strong><br /><br />$description</center>";
    echo "<br /><br /><br />";
    alpha();
    echo "</td></tr>";
    echo "<tr><td width=\"50%\" bgcolor=\"$bgcolor2\"><strong>"._10MOSTPOP."</strong></td>";
    echo "<td width=\"50%\" bgcolor=\"$bgcolor2\"><strong>"._10MOSTREC."</strong></td></tr>";
    $result_pop = $titanium_db->sql_query("SELECT id, title, hits FROM ".$titanium_prefix."_reviews $querylang ORDER BY hits DESC limit 10");
    $result_rec = $titanium_db->sql_query("SELECT id, title, date, hits FROM ".$titanium_prefix."_reviews $querylang ORDER BY date DESC limit 10");
    $y = 1;
    for ($x = 0; $x < 10; $x++)    {
        $myrow = $titanium_db->sql_fetchrow($result_pop);
        $id = intval($myrow['id']);
        $title = stripslashes(check_html($myrow['title'], "nohtml"));
        $hits = intval($myrow['hits']);
        echo "<tr><td width=\"50%\" bgcolor=\"$bgcolor3\">$y) <a href=\"modules.php?name=$titanium_module_name&amp;rop=showcontent&amp;id=$id\">$title</a></td>";
        $myrow2 = $titanium_db->sql_fetchrow($result_rec);
        $id = intval($myrow2['id']);
        $title = stripslashes(check_html($myrow2['title'], "nohtml"));
        $hits = intval($myrow2['hits']);
        echo "<td width=\"50%\" bgcolor=\"$bgcolor3\">$y) <a href=\"modules.php?name=$titanium_module_name&amp;rop=showcontent&amp;id=$id\">$title</a></td></tr>";
        $y++;
    }
    echo "<tr><td colspan=\"2\"><br /></td></tr>";
    $result2 = $titanium_db->sql_query("SELECT * FROM ".$titanium_prefix."_reviews $querylang");
    $numresults = $titanium_db->sql_numrows($result2);
    echo "<tr><td colspan=\"2\"><br /><center>"._THEREARE." $numresults "._REVIEWSINDB."</center></td></tr></table>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function reviews($letter, $field, $order) {
    global $bgcolor4, $sitename, $titanium_prefix, $multilingual, $currentlang, $titanium_db, $titanium_module_name, $anonpost;

    include_once(NUKE_BASE_DIR.'header.php');
    $letter = substr($letter, 0,1);
    if ($multilingual == 1) {
        $querylang = "AND rlanguage='$currentlang'";
    } else {
        $querylang = '';
    }
    OpenTable();
    echo "<center><strong>$sitename "._REVIEWS."</strong><br />";
    echo "<i>"._REVIEWSLETTER." \"$letter\"</i><br /><br />";
    switch ($field) {

        case "reviewer":
            $result = $titanium_db->sql_query("SELECT id, title, hits, reviewer, score, email FROM ".$titanium_prefix."_reviews WHERE UPPER(title) LIKE '$letter%' $querylang ORDER BY reviewer $order");
        break;

        case "score":
            $result = $titanium_db->sql_query("SELECT id, title, hits, reviewer, score, email FROM ".$titanium_prefix."_reviews WHERE UPPER(title) LIKE '$letter%' $querylang ORDER BY score $order");
        break;

        case "hits":
            $result = $titanium_db->sql_query("SELECT id, title, hits, reviewer, score, email FROM ".$titanium_prefix."_reviews WHERE UPPER(title) LIKE '$letter%' $querylang ORDER BY hits $order");
        break;

        default:
            $result = $titanium_db->sql_query("SELECT id, title, hits, reviewer, score, email FROM ".$titanium_prefix."_reviews WHERE UPPER(title) LIKE '$letter%' $querylang ORDER BY title $order");
        break;

    }
    $numresults = $titanium_db->sql_numrows($result);
    if ($numresults == 0) {
        echo "<i><strong>"._NOREVIEWS." \"$letter\"</strong></i><br /><br />";
    } elseif ($numresults > 0) {
        echo "<TABLE border=\"0\" width=\"100%\" cellpadding=\"2\" cellspacing=\"4\">
            <tr>
            <td width=\"50%\" bgcolor=\"$bgcolor4\">
            <p align=\"left\"><a href=\"modules.php?name=$titanium_module_name&amp;rop=$letter&amp;field=title&amp;order=ASC\"><img src=\"images/up.gif\" border=\"0\" width=\"15\" height=\"9\" alt=\""._SORTASC."\"></a><strong> "._PRODUCTTITLE." </strong><a href=\"modules.php?name=$titanium_module_name&amp;rop=$letter&amp;field=title&amp;order=DESC\"><img src=\"images/down.gif\" border=\"0\" width=\"15\" height=\"9\" alt=\""._SORTDESC."\"></a>
            </td>
            <td width=\"18%\" bgcolor=\"$bgcolor4\">
            <p align=\"center\"><a href=\"modules.php?name=$titanium_module_name&amp;rop=$letter&amp;field=reviewer&amp;order=ASC\"><img src=\"images/up.gif\" border=\"0\" width=\"15\" height=\"9\" alt=\""._SORTASC."\"></a><strong> "._REVIEWER." </strong><a href=\"modules.php?name=$titanium_module_name&amp;rop=$letter&amp;field=reviewer&amp;order=desc\"><img src=\"images/down.gif\" border=\"0\" width=\"15\" height=\"9\" alt=\""._SORTDESC."\"></a>
            </td>
            <td width=\"18%\" bgcolor=\"$bgcolor4\">
            <p align=\"center\"><a href=\"modules.php?name=$titanium_module_name&amp;rop=$letter&amp;field=score&amp;order=ASC\"><img src=\"images/up.gif\" border=\"0\" width=\"15\" height=\"9\" alt=\""._SORTASC."\"></a><strong> "._SCORE." </strong><a href=\"modules.php?name=$titanium_module_name&amp;rop=$letter&amp;field=score&amp;order=DESC\"><img src=\"images/down.gif\" border=\"0\" width=\"15\" height=\"9\" alt=\""._SORTDESC."\"></a>
            </td>
            <td width=\"14%\" bgcolor=\"$bgcolor4\">
            <p align=\"center\"><a href=\"modules.php?name=$titanium_module_name&amp;rop=$letter&amp;field=hits&amp;order=ASC\"><img src=\"images/up.gif\" border=\"0\" width=\"15\" height=\"9\" alt=\""._SORTASC."\"></a><strong> "._HITS." </strong><a href=\"modules.php?name=$titanium_module_name&amp;rop=$letter&amp;field=hits&amp;order=DESC\"><img src=\"images/down.gif\" border=\"0\" width=\"15\" height=\"9\" alt=\""._SORTDESC."\"></a>
            </td>
            </tr>";
        while($myrow = $titanium_db->sql_fetchrow($result)) {
            $title = stripslashes(check_html($myrow['title'], "nohtml"));
            $id = intval($myrow['id']);
            $reviewer = stripslashes($myrow['reviewer']);
            $email = stripslashes($myrow['email']);
            $score = intval($myrow['score']);
            $hits = intval($myrow['hits']);
/*****[BEGIN]******************************************
[ Other:    Review Background Color Fix       v1.0.0 ]
******************************************************/
            echo "<tr>
                <td width=\"50%\" bgcolor=\"$bgcolor4\"><a href=\"modules.php?name=$titanium_module_name&amp;rop=showcontent&amp;id=$id\">$title</a></td>
                <td width=\"18%\" bgcolor=\"$bgcolor4\">";
            if (!empty($reviewer))
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.6 ]
 ******************************************************/
            $phpbb2_color_reviewer = ($anonpost) ? $reviewer : UsernameColor($reviewer);
            echo "<center>".$phpbb2_color_reviewer."</center>";
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.6 ]
 ******************************************************/
            echo "</td><td width=\"18%\" bgcolor=\"$bgcolor4\"><center>";
/*****[END]********************************************
[ Other:    Review Background Color Fix       v1.0.0 ]
******************************************************/
            display_score($score);
            echo "</center></td><td width=\"14%\" bgcolor=\"$bgcolor4\"><center>$hits</center></td>
              </tr>";
        }
        $titanium_db->sql_freeresult($result);
        echo "</TABLE>";
        echo "<br />$numresults "._TOTALREVIEWS."<br /><br />";
    }
    echo "[ <a href=\"modules.php?name=$titanium_module_name\">"._RETURN2MAIN."</a> ]";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function postcomment($id, $title) {
    global $titanium_user, $cookie, $AllowableHTML, $anonymous, $titanium_module_name, $anonpost;

    //Prevent Anonymous Comments
    if(!is_user($titanium_user) && !$anonpost){
        Header("Location: modules.php?name=Your_Account&op=login&redirect=Reviews");
        die();
    }
    
    include_once(NUKE_BASE_DIR.'header.php');
    $title = stripslashes(check_html($title, 'nohtml'));
    OpenTable();
    //End Prevent Anonymous Comments
    echo "<center><span class=\"option\"><strong>"._REVIEWCOMMENT." $title</strong><br /><br /></span></center>"
    ."<form action=modules.php?name=$titanium_module_name method=post>";
    if (!is_user()) {
        echo "<strong>"._YOURNICK."</strong> $anonymous [ "._RCREATEACCOUNT." ]<br /><br />";
        $uname = $anonymous;
    } else {
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.6 ]
 ******************************************************/
        echo "<strong>"._YOURNICK."</strong> ".UsernameColor($cookie[1])."<br /><br />";
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.6 ]
 ******************************************************/
        $uname = addslashes($cookie[1]);
    }
    echo "
    <input type=hidden name=uname value=$uname>
    <input type=hidden name=id value=$id>
    <strong>"._SELECTSCORE."</strong>
    <select name=score>
    <option name=score value=10>10</option>
    <option name=score value=9>9</option>
    <option name=score value=8>8</option>
    <option name=score value=7>7</option>
    <option name=score value=6>6</option>
    <option name=score value=5>5</option>
    <option name=score value=4>4</option>
    <option name=score value=3>3</option>
    <option name=score value=2>2</option>
    <option name=score value=1>1</option>
    </select><br /><br />
    <strong>"._YOURCOMMENT."</strong><br />
    <textarea name=comments rows=10 cols=70></textarea><br />";
    echo "<table>".security_code(array(7), 'normal', 1)."</table>";
    echo "<br /><br />
    <input type=hidden name=rop value=savecomment>
    <input type=submit value=Submit>
    </form>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function savecomment($xanonpost, $uname, $id, $score, $comments) {
    global $anonymous, $titanium_user, $cookie, $titanium_prefix, $titanium_db, $titanium_module_name, $anonpost;

    if(!isset($_POST) || empty($_POST)) {
        header("location: modules.php?name=$titanium_module_name&rop=showcontent&id=$id");
        die();
    }
    if(!is_user($titanium_user) && $cookie[1] != $uname && !$anonpost){
        Header("Location: modules.php?name=Your_Account&op=login&redirect=Reviews");
        die();
    }
    
    if(!security_code_check($_POST['gfx_check'], 'force')) {
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo '<center>'._GFX_FAILURE.'</center>';
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
        die();
    }
    
    if ($xanonpost) {
        $uname = $anonymous;
    }
    if (!is_int(intval($id)) || !is_int(intval($score))){
        header("location: modules.php?name=$titanium_module_name&rop=showcontent&;id=$id");
        die();
    }
    $comments = Fix_Quotes(check_html($comments,'nohtml'));
    $id = intval($id);
    $score = intval($score);
    $name = Fix_Quotes(check_html($name));
    $titanium_db->sql_query("INSERT INTO ".$titanium_prefix."_reviews_comments VALUES (NULL, '$id', '$uname', now(), '$comments', '$score')");
    header("location: modules.php?name=$titanium_module_name&rop=showcontent&id=$id");
    die();
}

function r_comments($id, $title) {
    global $admin, $titanium_prefix, $titanium_db, $titanium_module_name, $anonymous, $anonpost;

    $id = intval($id);
    $result = $titanium_db->sql_query("SELECT cid, userid, date, comments, score FROM ".$titanium_prefix."_reviews_comments WHERE rid='$id' ORDER BY date DESC");
    while ($row = $titanium_db->sql_fetchrow($result)) {
        $cid = intval($row['cid']);
        $uname = stripslashes($row['userid']);
        $date = $row['date'];
        $comments = stripslashes($row['comments']);
        $score = intval($row['score']);
        OpenTable();
        $title = htmlspecialchars(check_html($title, "nohtml"));
        echo "
        <strong>$title</strong><br />";
        if ($uname == $anonymous) {
            echo ""._POSTEDBY." $uname "._ON." $date<br />";
        } else {
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.6 ]
 ******************************************************/
            $phpbb2_color_reviewer = ($anonpost) ? $reviewer : UsernameColor($uname);
            echo _POSTEDBY." <a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$uname\">".$phpbb2_color_reviewer."</a> "._ON." $date<br />";
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.6 ]
 ******************************************************/
        }
        echo _MYSCORE." ";
        display_score($score);
        if (is_mod_admin($titanium_module_name)) {
            echo "<br /><strong>"._ADMIN."</strong> [ <a href=\"modules.php?name=$titanium_module_name&amp;rop=del_comment&amp;cid=$cid&amp;id=$id\">"._DELETE."</a> ]</span><hr noshade size=1><br /><br />";
        } else {
            echo "</span><hr noshade size=1><br /><br />";
        }
        $comments = Fix_Quotes(nl2br(filter_text($comments)));
        echo "
        $comments
        ";
        CloseTable();
        echo "<br />";
    }
}

function showcontent($id, $page) {
    global $admin, $uimages, $titanium_prefix, $titanium_db, $titanium_module_name, $anonpost, $phpbb2_board_config;

    $id = intval($id);
    $page = intval($page);
    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    if (($page == 1) || (empty($page))) {
        $titanium_db->sql_query("UPDATE ".$titanium_prefix."_reviews SET hits=hits+1 WHERE id='$id'");
    }
    $result = $titanium_db->sql_query("SELECT * FROM ".$titanium_prefix."_reviews WHERE id='$id'");
    $myrow = $titanium_db->sql_fetchrow($result);
    $titanium_db->sql_freeresult($result);
    $id = intval($myrow['id']);
    $date = $myrow['date'];
    $year = substr($date,0,4);
    $month = substr($date,5,2);
    $day = substr($date,8,2);
		$fdate = EvoDate($phpbb2_board_config['default_dateformat'], mktime (0,0,0,$month,$day,$year), $phpbb2_board_config['board_timezone']);
    $title = $myrow['title'];
    $title = Fix_Quotes(check_html($title, nohtml));
/*****[BEGIN]******************************************
 [ Mod:     Reviews BBCodes                    v1.0.0 ]
 ******************************************************/
    $text = decode_bbcode(set_smilies(stripslashes($myrow['text'])), 1, true);
/*****[END]********************************************
 [ Mod:     Reviews BBCodes                    v1.0.0 ]
 ******************************************************/
    $cover = $myrow['cover'];
    $reviewer = $myrow['reviewer'];
    $email = $myrow['email'];
    $hits = intval($myrow['hits']);
    $url = $myrow['url'];
    $url_title = $myrow['url_title'];
    $score = intval($myrow['score']);
    $rlanguage = $myrow['rlanguage'];
    $contentpages = explode( "<!--pagebreak-->", $text );
    $pageno = count($contentpages);
    if ( empty($page) || $page < 1 )
        $page = 1;
    if ( $page > $pageno )
        $page = $pageno;
    $arrayelement = (int)$page;
    $arrayelement --;
    echo "<p><span class=\"title\"><i><strong>$title</strong></i></span><br />";
    echo "<blockquote><p align=justify>";
    if (!empty($cover))
        echo "<img src=\"images/reviews/$cover\" align=right border=1 vspace=2 alt=\"\">";
    echo "$contentpages[$arrayelement]
    </blockquote><p>";
    if (is_mod_admin($titanium_module_name))
        echo "<strong>"._ADMIN."</strong> [ <a href=\"modules.php?name=$titanium_module_name&amp;rop=mod_review&amp;id=$id\">"._EDIT."</a> | <a href=modules.php?name=$titanium_module_name&amp;rop=del_review&amp;id_del=$id>"._DELETE."</a> ]<br />";
    echo "<strong>"._ADDED."</strong> $fdate<br />";
    if (!empty($reviewer))
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.6 ]
 ******************************************************/
        $phpbb2_color_reviewer = ($anonpost) ? $reviewer : UsernameColor($reviewer);
        echo "<strong>"._REVIEWER."</strong> <a href=mailto:$email>".$phpbb2_color_reviewer."</a><br />";
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.6 ]
 ******************************************************/
    if (!empty($score))
        echo "<strong>"._SCORE."</strong> ";
    display_score($score);
    if (!empty($url))
        echo "<br /><strong>"._RELATEDLINK.":</strong> <a href=\"$url\" target=new>$url_title</a>";
    echo "<br /><strong>"._HITS.":</strong> $hits";
    echo "<br /><strong>"._LANGUAGE.":</strong> $rlanguage";
    if ($pageno > 1) {
        echo "<br /><strong>"._PAGE.":</strong> $page/$pageno<br />";
    }
    echo "</span>";
    echo "</center>";
    if($page >= $pageno) {
      $next_page = '';
    } else {
    $next_pagenumber = $page + 1;
    if ($page != 1) {
        $next_page .= "<img src=\"images/blackpixel.gif\" width=\"10\" height=\"2\" border=\"0\" alt=\"\"> &nbsp;&nbsp; ";
    }
    $next_page .= "<a href=\"modules.php?name=$titanium_module_name&amp;rop=showcontent&amp;id=$id&amp;page=$next_pagenumber\">"._NEXT." ($next_pagenumber/$pageno)</a> <a href=\"modules.php?name=$titanium_module_name&amp;rop=showcontent&amp;id=$id&amp;page=$next_pagenumber\"><img src=\"images/right.gif\" border=\"0\" alt=\""._NEXT."\"></a>";
    }
    if($page <= 1) {
        $previous_page = '';
    } else {
        $previous_pagenumber = $page - 1;
        $previous_page = "<a href=\"modules.php?name=$titanium_module_name&amp;rop=showcontent&amp;id=$id&amp;page=$previous_pagenumber\"><img src=\"images/left.gif\" border=\"0\" alt=\""._PREVIOUS."\"></a> <a href=\"modules.php?name=$titanium_module_name&amp;rop=showcontent&amp;id=$id&amp;page=$previous_pagenumber\">"._PREVIOUS." ($previous_pagenumber/$pageno)</a>";
    }
    echo "<center>"
    ."$previous_page &nbsp;&nbsp; $next_page<br /><br />"
    ."[ <a href=\"modules.php?name=$titanium_module_name\">"._RBACK."</a> | "
    ."<a href=\"modules.php?name=$titanium_module_name&amp;rop=postcomment&amp;id=$id&amp;title=$title\">"._REPLYMAIN."</a> ]";
    CloseTable();
    if (($page == 1) OR (empty($page))) {
        echo "<br />";
        r_comments($id, $title);
    }
    include_once(NUKE_BASE_DIR.'footer.php');
}

function mod_review($id) {
    global $admin, $titanium_prefix, $titanium_db, $titanium_module_name, $rlanguage;

    $id = intval($id);
    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    if (($id == 0) || (!is_mod_admin($titanium_module_name)))
        echo "This function must be passed argument id, or you are not admin.";
    else if (($id != 0) && (is_mod_admin($titanium_module_name)))
    {
        $result = $titanium_db->sql_query("SELECT * FROM ".$titanium_prefix."_reviews WHERE id = '$id'");
        while ($myrow = $titanium_db->sql_fetchrow($result)) {
            $id = intval($myrow['id']);
            $date = $myrow['date'];
            $title = $myrow['title'];
            $title = Fix_Quotes(check_html($title, "nohtml"));
            $text = stripslashes($myrow['text']);
            $cover = stripslashes($myrow['cover']);
            $reviewer = stripslashes($myrow['reviewer']);
            $email = stripslashes($myrow['email']);
            $hits = intval($myrow['hits']);
            $url = stripslashes($myrow['url']);
            $url_title = stripslashes(check_html($myrow['url_title'], "nohtml"));
            $score = intval($myrow['score']);
            $rlanguage = $myrow['rlanguage'];
        }
        $titanium_db->sql_freeresult($result);
        echo "<center><strong>"._REVIEWMOD."</strong></center><br /><br />";
/*****[BEGIN]******************************************
 [ Mod:     Reviews BBCodes                    v1.0.0 ]
 ******************************************************/
        echo "<form name=\"postreviews\" method=\"post\" action=\"modules.php?name=$titanium_module_name&amp;rop=preview_review\"><input type=\"hidden\" name=\"id\" value=\"$id\">";
        echo "<strong>"._RTITLE."</strong><br />"
        ."<input type=\"text\" name=\"title\" size=\"50\" maxlength=\"150\" value=\"$title\"><br /><br />"
        ."<strong>"._RDATE."</strong><br />"
        ."<input type=\"text\" name=\"date\" size=\"15\" value=\"$date\" maxlength=\"10\"><br /><br />";
    if ($multilingual == 1) {
        echo "<br /><strong>"._LANGUAGE.": </strong>"
            ."<select name=\"rlanguage\">";
        $titanium_languages = lang_list();
        echo '<option value=""'.(($rlanguage == '') ? ' selected="selected"' : '').'>'._ALL."</option>\n";
        for ($i=0, $j = count($titanium_languages); $i < $j; $i++) {
            if ($titanium_languages[$i] != '') {
                echo '<option value="'.$titanium_languages[$i].'"'.(($rlanguage == $titanium_languages[$i]) ? ' selected="selected"' : '').'>'.ucfirst($titanium_languages[$i])."</option>\n";
            }
        }
        echo '</select><br /><br />';
    } else {
        echo "<input type=\"hidden\" name=\"rlanguage\" value=\"$rlanguage\">";
    }

    echo "<strong>" . _RTEXT . "</strong><br />";
/*****[BEGIN]******************************************
 [ Mod:     Custom Text Area                   v1.0.0 ]
 ******************************************************/
    Make_TextArea('text', $text, 'postreviews');
/*****[END]********************************************
 [ Mod:     Custom Text Area                   v1.0.0 ]
 ******************************************************/
    echo "<strong>" . _REVIEWER . "</strong><br />"
        ."<input type=\"text\" name=\"reviewer\" size=\"41\" maxlength=\"40\" value=\"$reviewer\"><br /><br />"
        ."<strong>"._REVEMAIL."</strong><br />"
        ."<input type=\"text\" name=\"email\" value=\"$email\" size=\"30\" maxlength=\"80\"><br /><br />"
        ."<strong>"._SCORE."</strong><br />"
        ."<input type=\"text\" name=\"score\" value=\"$score\" size=\"3\" maxlength=\"2\"><br /><br />"
        ."<strong>"._RLINK."</strong><br />"
        ."<input type=\"text\" name=\"url\" value=\"$url\" size=\"30\" maxlength=\"100\"><br /><br />"
        ."<strong>"._RLINKTITLE."</strong><br />"
        ."<input type=\"text\" name=\"url_title\" value=\"$url_title\" size=\"30\" maxlength=\"50\"><br /><br />"
        ."<strong>"._COVERIMAGE."</strong><br />"
        ."<input type=\"text\" name=\"cover\" value=\"$cover\" size=\"30\" maxlength=\"100\"><br /><br />"
        ."<strong>"._HITS."</strong><br />"
        ."<input type=\"text\" name=\"hits\" value=\"$hits\" size=\"5\" maxlength=\"5\"><br /><br />"
        ."<input type=\"hidden\" name=\"rop\" value=\"preview_review\"><input type=\"submit\" value=\""._PREMODS."\">&nbsp;&nbsp;<input type=\"button\" onClick=history.go(-1) value="._CANCEL."></form>";
/*****[END]********************************************
 [ Mod:     Reviews BBCodes                    v1.0.0 ]
 ******************************************************/
    }
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function del_review($id_del) {
    global $admin, $titanium_prefix, $titanium_db, $titanium_module_name;

    $id_del = intval($id_del);
    if (is_mod_admin($titanium_module_name)) {
        $titanium_db->sql_query("DELETE FROM ".$titanium_prefix."_reviews WHERE id = '$id_del'");
    $titanium_db->sql_query("DELETE FROM ".$titanium_prefix."_reviews_comments WHERE rid='$id_del'");
    redirect_titanium("modules.php?name=$titanium_module_name");
    } else {
        echo "ACCESS DENIED";
    }
}

function del_comment($cid, $id) {
    global $admin, $titanium_prefix, $titanium_db, $titanium_module_name;

    $cid = intval($cid);
    if (is_mod_admin($titanium_module_name)) {
        $titanium_db->sql_query("DELETE FROM ".$titanium_prefix."_reviews_comments WHERE cid='$cid'");
        redirect_titanium("modules.php?name=$titanium_module_name&rop=showcontent&id=$id");
    } else {
        echo "ACCESS DENIED";
    }
}

if (!isset($rop)) { $rop = ''; }
if (!isset($page)) { $page = ''; }
if (!isset($field)) { $field = ''; }
if (!isset($order)) { $order = ''; }
if (!isset($date)) { $date = ''; }
if (!isset($hits)) { $hits = ''; }
if (!isset($id)) { $id = ''; }
if (strlen($rop) == 1 AND ctype_alnum($rop))
  reviews($rop, $field, $order);

else switch($rop) {

    case "showcontent":
        showcontent($id, $page);
    break;

    case "write_review":
        write_review();
    break;

    case "preview_review":
        preview_review($date, $title, $text, $reviewer, $email, $score, $cover, $url, $url_title, $hits, $id, $rlanguage);
    break;

    case _YES:
        send_review($date, $title, $text, $reviewer, $email, $score, $cover, $url, $url_title, $hits, $id, $rlanguage);
    break;

    case "del_review":
        del_review($id_del);
    break;

    case "mod_review":
        mod_review($id);
    break;

    case "postcomment":
        postcomment($id, $title);
    break;

    case "savecomment":
        savecomment($xanonpost, $uname, $id, $score, $comments);
    break;

    case "del_comment":
        del_comment($cid, $id);
    break;

    default:
        reviews_index();
    break;
}

?>