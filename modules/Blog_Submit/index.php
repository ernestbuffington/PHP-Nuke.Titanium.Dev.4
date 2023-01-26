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

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
      Caching System                           v1.0.0       10/31/2005
	  Titanium Patched                         v4.0.3       01/25/2023
-=[Mod]=-
      Blogs BBCodes                            v1.0.0       10/05/2005
      Custom Text Area                         v1.0.0       11/23/2005
-=[Applied Rules]=-
 * DirNameFileConstantToDirConstantRector
 * AddDefaultValueForUndefinedVariableRector (https://github.com/vimeo/psalm/blob/29b70442b11e3e66113935a2ee22e165a70c74a4/docs/fixing_code.md#possiblyundefinedvariable)
 * CountOnNullRector (https://3v4l.org/Bndc9)
 * ChangeSwitchToMatchRector (https://wiki.php.net/rfc/match_expression_v2)
 * NullToStrictStringFuncCallArgRector	  
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die('You can\'t access this file directly...');
}

$module_name = basename(__DIR__);
get_lang($module_name);

function defaultDisplay() 
{
    global $prefix, $cookie, $anonymous, $currentlang, $multilingual, $db, $module_name;

    include_once(NUKE_BASE_DIR.'header.php');

    OpenTable();
	echo '<div align="center" class="title"><strong>'._SUBMIT_BLOG.'</strong></div><br /><br />'; 
/*****[BEGIN]******************************************
 [ Mod:     Blogs BBCodes                       v1.0.0 ]
 ******************************************************/
    echo "<p><form name=\"postblog\" action=\"modules.php?name=$module_name\" method=\"post\">\n";
/*****[END]********************************************
 [ Mod:     Blogs BBCodes                       v1.0.0 ]
 ******************************************************/
    echo '<div class="textbold">'._YOURNAME.':</div> ';
    if (is_user()) {
        echo "<a href=\"modules.php?name=Your_Account\">$cookie[1]</a> <span class=\"content\">[ <a href=\"modules.php?name=Your_Account&amp;op=logout\">"._LOGOUT."</a> ]</span>\n";
    } else {
        echo $anonymous ."<span class=\"content\">[ <a href=\"modules.php?name=Your_Account\">"._NEWUSER."</a> ]</span>\n";
    }
    echo '<br /><br />'
        ."<span class=\"textbold\">"._BLOG_SUB_TITLE."</span> "
        .'('._BEDESCRIPTIVE.')<br />'
        .'<input type="text" name="subject" size="50" maxlength="80"><br /><span class="content">('._BAD_BLOG_TITLES.')</span>'
        .'<br /><br />'
        .'<span class="textbold">'._TOPIC.":</span>\n";
    echo "<select name=\"topic\">\n";
    $result = $db->sql_query("SELECT `topicid`, `topictext` FROM `".$prefix."_blogs_topics` ORDER BY `topictext`");
    echo "<option value=\"\">"._SELECT_BLOG_TOPIC."</option>\n";
    while ($row = $db->sql_fetchrow($result)) {
        $topicid = (int)$row['topicid'];
        $topics = stripslashes((string) check_html($row['topictext'], "nohtml"));
        echo "<option value=\"$topicid\">$topics</option>\n";
    }
    $db->sql_freeresult($result);
    echo "</select>\n";
    if ($multilingual) {
        echo '<br /><br /><strong>'._LANGUAGE.": </strong>\n";
        echo "<select name=\"alanguage\">\n";
        $languages = lang_list();
        echo '<option value=""'.(($currentlang == '') ? ' selected="selected"' : '').'>'._ALL."</option>\n";
        for ($i=0, $j = is_countable($languages) ? count($languages) : 0; $i < $j; $i++) {
            if ($languages[$i] != '') {
                echo '<option value="'.$languages[$i].'"'.(($currentlang == $languages[$i]) ? ' selected="selected"' : '').'>'.ucfirst((string) $languages[$i])."</option>\n";
            }
        }
        echo '</select>';
    } else {
        echo "<input type=\"hidden\" name=\"alanguage\" value=\"$currentlang\">\n";
    }
    echo '<br /><br />';
    echo '<span class="textbold">'._BLOG_TEXT.":</span> ("._HTMLISFINE.")<br />\n";
/*****[BEGIN]******************************************
 [ Mod:     Custom Text Area                   v1.0.0 ]
 ******************************************************/
    global $wysiwyg_buffer;
    $wysiwyg_buffer = 'story,storyext';
    Make_TextArea('story', '', 'postblog');
    echo '<br /><br /><span class="textbold">'._EXTENDED_BLOG_TEXT.':</span><br />';
    Make_TextArea('storyext', '', 'postblog');
    echo '<span class="content">('._AREYOUSURE.')</span><br /><br />';
/*****[END]********************************************
 [ Mod:     Custom Text Area                   v1.0.0 ]
 ******************************************************/
    echo "<br /><br /><div style=\"font-style: italic; text-align: center;\">"._SUBMIT_BLOG_ADVICE."</div><br />\n";
	
	echo '<br /><br /><div align="center"> <input type="submit" name="op" value="'._PREVIEW."\">\n";
    echo '<br />('._SUBPREVIEW.")</form>";
	echo '</div>';
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function PreviewStory($name, $address, $subject, $story, $storyext, $topic, $alanguage, $posttype) 
{
    $counter = null;
    $topictext = null;
    $sel = null;
    global $user, $cookie, $bgcolor1, $bgcolor2, $anonymous, $prefix, $multilingual, $AllowableHTML, $db, $module_name, $tipath, $userinfo;

    include_once(NUKE_BASE_DIR.'header.php');

    $subject = stripslashes((string) check_html($subject, 'nohtml'));
    $story = stripslashes((string) $story);
    $storyext = stripslashes((string) $storyext);

    if (empty($story) && empty($storyext)) 
	{
        DisplayError(_ERROR_BLOG);
    }
    
	if (empty($subject)) 
	{
        DisplayError(_ERROR_BLOG_SUBJECT);
    }
    $story2 = $story.'<br /><br />'.$storyext;
    Validate($topic, 'int', $module_name, 0, 0, 0, 0, 'topic');
/*****[BEGIN]******************************************
 [ Mod:     Blogs BBCodes                    v1.0.0 ]
 ******************************************************/
    $story2 = decode_bbcode(set_smilies(stripslashes($story2)), 1, true);
/*****[END]********************************************
 [ Mod:     Blogs BBCodes                    v1.0.0 ]
 ******************************************************/
	if (empty($topic)) 
	{
        $topicimage = 'AllTopics.png';
        $warning = '<div style="font-style: italic; text-align: center;"><blink>'._SELECT_BLOG_TOPIC.'</blink></div>';
    } 
	else 
	{
        $warning = '';
        $row = $db->sql_fetchrow($db->sql_query("SELECT `topicimage`, `topictext` FROM `".$prefix."_blogs_topics` WHERE `topicid`='$topic'"));
        $topicimage = stripslashes((string) $row['topicimage']);
        $topictext = stripslashes((string) $row['topictext']);
    }
    themearticle($userinfo['username'], UsernameColor($userinfo['username']),'','',$subject,$counter,$story,$topic,$topic,$topicimage,$topictext);
//	themearticle(                 $aid,                           $informant, $datetime, $modified,   $title, $counter, $thetext, $topic,  $topicname, $topicimage, $topictext, $writes = false)
	
    echo $warning;
    OpenTable();
/*****[BEGIN]******************************************
 [ Mod:     Blogs BBCodes                       v1.0.0 ]
 ******************************************************/
    echo "<p><form name=\"postblog\" action=\"modules.php?name=$module_name\" method=\"post\">\n";
    echo '<strong>'._YOURNAME.':</strong> ';
/*****[END]********************************************
 [ Mod:     Blogs BBCodes                       v1.0.0 ]
 ******************************************************/
    if (is_user()) {
        echo "<a href=\"modules.php?name=Your_Account\">$cookie[1]</a> <span class=\"content\">[ <a href=\"modules.php?name=Your_Account&amp;op=logout\">"._LOGOUT."</a> ]</span>\n";
    } else {
        echo $anonymous;
    }
    echo "<br /><br /><div class=\"textbold\">"._BLOG_SUB_TITLE.":</div><br />\n";
    echo "<input type=\"text\" name=\"subject\" size=\"50\" maxlength=\"80\" value=\"$subject\">\n";
    echo '<br /><br /><div class="textbold">'._TOPIC.": </div><select name=\"topic\">\n";
    $result2 = $db->sql_query("SELECT `topicid`, `topictext` FROM `".$prefix."_blogs_topics` ORDER BY `topictext`");
    echo '<option VALUE="">'._SELECT_BLOG_TOPIC."</option>\n";
    while ($row2 = $db->sql_fetchrow($result2)) {
        $topicid = (int)$row2['topicid'];
        $topics = stripslashes((string) check_html($row2['topictext'], "nohtml"));
        if ($topicid == $topic) {
            $sel = 'selected ';
        }
        echo "<option $sel value=\"$topicid\">$topics</option>\n";
        $sel = '';
    }
    $db->sql_freeresult($result2);
    echo '</select>';
    if ($multilingual) {
        echo '<br /><br /><strong>'._LANGUAGE.": </strong>\n";
        echo "<select name=\"alanguage\">\n";
        $languages = lang_list();
        echo '<option value=""'.(($alanguage == '') ? ' selected="selected"' : '').'>'._ALL."</option>\n";
        for ($i=0, $j = is_countable($languages) ? count($languages) : 0; $i < $j; $i++) {
            if ($languages[$i] != '') {
                echo '<option value="'.$languages[$i].'"'.(($alanguage == $languages[$i]) ? ' selected="selected"' : '').'>'.ucfirst((string) $languages[$i])."</option>\n";
            }
        }
        echo '</select>';
    }
/*****[BEGIN]******************************************
 [ Mod:     Custom Text Area                   v1.0.0 ]
 ******************************************************/
    global $wysiwyg_buffer;
    $wysiwyg_buffer = 'story,storyext';
    echo '<br /><br /><div class="textbold">'._BLOG_TEXT.":</div> ("._HTMLISFINE.")<br />";
    Make_TextArea('story', $story, 'postblog');
    echo '<br /><br /><div class="textbold">'._EXTENDED_BLOG_TEXT.':</div><br />';
    Make_TextArea('storyext', $storyext, 'postblog');
    echo '<div class="content">('._AREYOUSURE.')</div><br /><br />';
/*****[END]********************************************
 [ Mod:     Custom Text Area                   v1.0.0 ]
 ******************************************************/
    echo '<div align="center">';
	echo "<input type=\"submit\" name=\"op\" value=\""._PREVIEW."\">&nbsp;&nbsp;";
    echo "<input type=\"submit\" name=\"op\" value=\""._OK."\">\n";
    echo "</form>\n";
	echo '</div">';
	echo '<br /><br /><br /><br />';
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function submitStory($name, $address, $subject, $story, $storyext, $topic, $alanguage, $posttype) 
{
    global $user, $EditedMessage, $cookie, $anonymous, $notify, $notify_email, $notify_subject, $notify_message, $notify_from, $prefix, $db, $cache;

    if (is_user()) 
	{
        $uid = $cookie[0];
        $name = $cookie[1];
    } 
	else 
	{
        $uid = 1;
        $name = $anonymous;
    }
    
	$subject = Fix_Quotes(filter_text($subject, "nohtml"));
    $story = Fix_Quotes(nl2br((string) check_words($story)));
    $storyext = Fix_Quotes(nl2br((string) check_words($storyext)));
    $result = $db->sql_query("INSERT INTO ".$prefix."_blogs_queue VALUES (NULL, '$uid', '$name', '$subject', '$story', '$storyext', now(), '$topic', '$alanguage')");
    
	if(!$result) 
	{
        echo _ERROR."<br />";
        exit();
    }
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    $cache->delete('numwaits', 'submissions');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    $db->sql_freeresult($result);
    if($notify) {
        $notify_message = "$notify_message\n\n\n========================================================\n$subject\n\n\n$story\n\n$storyext\n\n$name";
        evo_mail($notify_email, $notify_subject, $notify_message, "From: $notify_from\nX-Mailer: PHP/" . phpversion());
    }
    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    if(($numwaits = $cache->load('numwaits', 'submissions')) === false) 
	{
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
        $result = $db->sql_query("SELECT COUNT(*) AS numrows FROM ".$prefix."_blogs_queue");
        $numwaits = $db->sql_fetchrow($result);
        $db->sql_freeresult($result);
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
        $cache->save('numwaits', 'submissions', $numwaits);
    }
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    $numwaits = $numwaits['numrows'];
    echo "<div class=\"nuketitle\">"._BLOG_RECIEVED."</div>"
    ."<span class=\"content\"><strong>"._THANKS_BLOG_SUBMISSION."</strong></span><br /><br />"
    ._SUBTEXT
    ."<br />"._WEHAVESUB." $numwaits "._WAITING."</center>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

if (!isset($address)) { $address = ''; }
if (!isset($alanguage)) { $alanguage = ''; }
if (!isset($op)) { $op = ''; }

if(!isset($posttype))
$posttype = '';

match ($op) {
    _PREVIEW => PreviewStory($name, $address, $subject, $story, $storyext, $topic, $alanguage, $posttype),
    _OK => SubmitStory($name, $address, $subject, $story, $storyext, $topic, $alanguage, $posttype),
    default => defaultDisplay(),
};
