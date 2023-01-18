<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/***************************************************************************
 *                              bbcode.php
 *                            -------------------
 *   update               : Sunday, May 23, 2021
 *   copyright            : (C) 2001 The 86it Developer Network
 *   email                : support@86it.us
 *
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: bbcode.php,v 1.36.2.35 2005/07/19 20:01:10 acydburn Exp
 ***************************************************************************/

/***************************************************************************
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 ***************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Caching System                           v1.0.0       10/29/2005
-=[Mod]=-
      Advanced BBCode Box                      v5.0.0a      11/16/2005
      Select Expand BBcodes                    v1.0.2       06/14/2005
      Force Word Wrapping                      v1.0.16      06/15/2005
      Force Word Wrapping - Configurator       v1.0.16      06/15/2005
      Anti Spam                                v1.1.0       06/18/2005
      PHP Syntax Highlighter BBCode            v3.0.7       07/10/2005
      Select Expand BBcodes (PHP add-on)       v1.0.2       07/18/2005
      Allow multiple spaces in posts           v1.0.0       07/30/2005
      Advanced Username Color                  v1.0.5       08/03/2005
      Extended Quote Tag                       v1.0.0       08/17/2005
      Select Expand & Extended Quote Tag       v1.0.0       08/26/2005
      Hide Images and Links                    v1.0.0       08/30/2005
      BBCode Box                               v1.0.0       10/06/2005
	  Lytebox Resize Images                    v3.2.2
	  Hide BBCode                              v1.2.0
 ************************************************************************/
if (!defined('IN_PHPBB')) {
    exit('Hacking attempt');
}

define("BBCODE_UID_LEN", 10);
# global that holds loaded-and-prepared bbcode templates, so we only have to do
# that stuff once.

$bbcode_tpl = null;
# Loads bbcode templates from the bbcode.tpl file of the current template set.
# Creates an array, keys are bbcode names like "b_open" or "url", values
# are the associated template.
# Probably pukes all over the place if there's something really screwed
# with the bbcode.tpl file.
# Nathan Codding, Sept 26 2001.
function load_bbcode_template()
{
    global $template;
    $tpl_filename = $template->make_filename('bbcode.tpl');
    $tpl = fread(fopen($tpl_filename, 'r'), filesize($tpl_filename));

    # replace \ with \\ and then ' with \'.
    $tpl = str_replace('\\', '\\\\', $tpl);
    $tpl  = str_replace('\'', '\\\'', $tpl);

    # strip newlines.
    $tpl  = str_replace("\n", '', $tpl);

    # Turn template blocks into PHP assignment statements for the values of $bbcode_tpls..
    $tpl = preg_replace('#<!-- BEGIN (.*?) -->(.*?)<!-- END (.*?) -->#', "\n" . '$bbcode_tpls[\'\\1\'] = \'\\2\';', $tpl);

    $bbcode_tpls = array();

    eval($tpl);

    return $bbcode_tpls;
}
# Prepares the loaded bbcode templates for insertion into preg_replace()
# or str_replace() calls in the bbencode_second_pass functions. This
# means replacing template placeholders with the appropriate preg backrefs
# or with language vars. NOTE: If you change how the regexps work in
# bbencode_second_pass(), you MUST change this function.
# Nathan Codding, Sept 26 2001
function prepare_bbcode_template($bbcode_tpl)
{
    global $lang, $board_config;

    $bbcode_tpl['olist_open'] = str_replace('{LIST_TYPE}','\\1',$bbcode_tpl['olist_open']);

    $bbcode_tpl['color_open'] = str_replace('{COLOR}','\\1',$bbcode_tpl['color_open']);
    # ----- new bbcode addition to v3 ----- START
    $bbcode_tpl['highlight_open'] = str_replace('{COLOR}','\\1',$bbcode_tpl['highlight_open']);
    # ----- new bbcode addition to v3 ----- END

    // $bbcode_tpl['size_open'] = str_replace('{SIZE}', '\\1', $bbcode_tpl['size_open']);
    // $bbcode_tpl['quote_open'] = str_replace('{L_QUOTE}', $lang['Quote'], $bbcode_tpl['quote_open']);
    $bbcode_tpl['quote_username_open'] = str_replace('{L_QUOTE}',$lang['Quote'],$bbcode_tpl['quote_username_open']);
    $bbcode_tpl['quote_username_open'] = str_replace('{L_WROTE}',$lang['wrote'],$bbcode_tpl['quote_username_open']);
    $bbcode_tpl['quote_username_open'] = str_replace('{USERNAME}',UsernameColor('\\1'),$bbcode_tpl['quote_username_open']);
    
	
	// $bbcode_tpl['quote_close'] = str_replace('{USERNAME}', UsernameColor('\\1'), $bbcode_tpl['quote_close']);

    # Mod: Extended Quote Tag v1.0.0 START
    $bbcode_tpl['quote_post_open'] = str_replace('{L_QUOTE}',$lang['Quote'],$bbcode_tpl['quote_post_open']);
    $temp_url = append_sid('show_post.php?p=\\1');
    
	$bbcode_tpl['quote_post_open'] = str_replace('{U_VIEW_POST}', '<a href="'.$temp_url.'" onClick=
	"javascript:open_postreview( \''.$temp_url.'\' );">'.$lang['View_post'].'</a>', $bbcode_tpl['quote_post_open']);

    $bbcode_tpl['quote_username_post_open'] = str_replace('{L_QUOTE}',$lang['Quote'],$bbcode_tpl['quote_username_post_open']);
    $bbcode_tpl['quote_username_post_open'] = str_replace('{L_WROTE}', $lang['wrote'],$bbcode_tpl['quote_username_post_open']);
    $bbcode_tpl['quote_username_post_open'] = str_replace('{USERNAME}','\\1',$bbcode_tpl['quote_username_post_open']);
    $temp_url = append_sid('show_post.php?p=\\2');
    $bbcode_tpl['quote_username_post_open'] = str_replace('{U_VIEW_POST}', '<a href="'.$temp_url.'" onClick=
	"javascript:open_postreview( \''.$temp_url.'\' );">'.$lang['View_post'] . '</a>',$bbcode_tpl['quote_username_post_open']);

    # Mod: Advanced Username Color v1.0.5 START
    $bbcode_tpl['quote_username_post_open'] = str_replace('{USERNAME}', UsernameColor('\\1'), $bbcode_tpl['quote_username_post_open']);
    # Mod: Advanced Username Color v1.0.5 END

    $temp_url = append_sid('show_post.php?p=\\2');
    $bbcode_tpl['quote_username_post_open'] = str_replace('{U_VIEW_POST}', '<a href="#_somewhat" onClick=
	"javascript:open_postreview( \''.$temp_url.'\' );">'.$lang['View_post'].'</a>', $bbcode_tpl['quote_username_post_open']);
    # Mod: Extended Quote Tag v1.0.0 END

    $bbcode_tpl['code_open'] = str_replace('{L_CODE}', $lang['Code'], $bbcode_tpl['code_open']);

/*****[BEGIN]******************************************
 [ Mod:     PHP Syntax Highlighter BBCode      v3.0.7 ]
 ******************************************************/
    $bbcode_tpl['php_open'] = str_replace('{L_PHP}', $lang['PHPCode'], $bbcode_tpl['php_open']); // PHP MOD
/*****[END]********************************************
 [ Mod:     PHP Syntax Highlighter BBCode      v3.0.7 ]
 ******************************************************/

    $bbcode_tpl['img'] = str_replace('{URL}', '\\1', $bbcode_tpl['img']);

    // We do URLs in several different ways..
    $bbcode_tpl['url1'] = str_replace('{URL}', '\\1', $bbcode_tpl['url']);
    $bbcode_tpl['url1'] = str_replace('{DESCRIPTION}', '\\1', $bbcode_tpl['url1']);

    $bbcode_tpl['url2'] = str_replace('{URL}', 'http://\\1', $bbcode_tpl['url']);
    $bbcode_tpl['url2'] = str_replace('{DESCRIPTION}', '\\1', $bbcode_tpl['url2']);

    $bbcode_tpl['url3'] = str_replace('{URL}', '\\1', $bbcode_tpl['url']);
    $bbcode_tpl['url3'] = str_replace('{DESCRIPTION}', '\\2', $bbcode_tpl['url3']);

    $bbcode_tpl['url4'] = str_replace('{URL}', 'http://\\1', $bbcode_tpl['url']);
    $bbcode_tpl['url4'] = str_replace('{DESCRIPTION}', '\\3', $bbcode_tpl['url4']);

    $bbcode_tpl['url5'] = str_replace('{URL}', 'http://\\1', $bbcode_tpl['url']);
    $bbcode_tpl['url5'] = str_replace('{DESCRIPTION}', '\\2', $bbcode_tpl['url5']);

/*****[BEGIN]******************************************
 [ Mod:     Anti-Spam                         v.1.1.0 ]
 ******************************************************/
    $bbcode_tpl['email'] = str_replace('{EMAIL1}', '\\1', $bbcode_tpl['email']);
    $bbcode_tpl['email'] = str_replace('{EMAIL2}', '\\2', $bbcode_tpl['email']);
    $bbcode_tpl['email'] = str_replace('{EMAIL3}', '\\3', $bbcode_tpl['email']);
/*****[END]********************************************
 [ Mod:     Anti-Spam                         v.1.1.0 ]
 ******************************************************/

    $bbcode_tpl['email'] = str_replace('{EMAIL}', '\\1', $bbcode_tpl['email']);

/*****[BEGIN]******************************************
 [ Mod:    Hide Mod                            v1.2.0 ]
 ******************************************************/
    $bbcode_tpl['show'] = str_replace('{HTEXTE}', '\\1', $bbcode_tpl['show']);
/*****[END]********************************************
 [ Mod:    Hide Mod                            v1.2.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Advanced BBCode Box               v5.0.0a ]
 ******************************************************/
    $bbcode_tpl['spoil_open'] = str_replace('{L_BBCODEBOX_HIDDEN}', $lang['BBCode_box_hidden'], $bbcode_tpl['spoil_open']);
    $bbcode_tpl['spoil_open'] = str_replace('{L_BBCODEBOX_VIEW}', $lang['BBcode_box_view'], $bbcode_tpl['spoil_open']);
    $bbcode_tpl['spoil_open'] = str_replace('{L_BBCODEBOX_HIDE}', $lang['BBcode_box_hide'], $bbcode_tpl['spoil_open']);
    $bbcode_tpl['align_open'] = str_replace('{ALIGN}', '\\1', $bbcode_tpl['align_open']);
    // $bbcode_tpl['marq_open'] = str_replace('{MARQ}', '\\1', $bbcode_tpl['marq_open']);
    // $bbcode_tpl['table_open'] = str_replace('{TABLE}', '\\1', $bbcode_tpl['table_open']);
    // $bbcode_tpl['cell_open'] = str_replace('{CELL}', '\\1', $bbcode_tpl['cell_open']);
    $bbcode_tpl['font_open'] = str_replace('{FONT}', '\\1', $bbcode_tpl['font_open']);
    /* ----- This code is no longer used in V3 of Xtreme, was only left here for those videos already submitted into the forums -----*/
    $bbcode_tpl['youtubeV209'] = str_replace('{YOUTUBE}', '\\1', $bbcode_tpl['youtubeV209']);
    $bbcode_tpl['youtubeV209'] = str_replace('{WATCH_YOUTUBE}', _WATCH_YOUTUBE, $bbcode_tpl['youtubeV209']);

    $bbcode_tpl['youtubeV209'] = str_replace('{YT_VIDEO_WIDTH}', $board_config['youtube_width'], $bbcode_tpl['youtubeV209']);
    $bbcode_tpl['youtubeV209'] = str_replace('{YT_VIDEO_HEIGHT}', $board_config['youtube_height'], $bbcode_tpl['youtubeV209']);

    /* ----- This code is no longer used in V3 of Xtreme, was only left here for those videos already submitted into the forums -----*/
    define("BBCODE_TPL_READY", true);
    return $bbcode_tpl;
}
/*****[BEGIN]******************************************
 [ Mod:     Hide Images and Links              v1.0.0 ]
 ******************************************************/
function replacer($mode, $bb)
{
    global $userdata, $lang, $board_config, $phpEx;
    switch($mode) 
    {
      case 'img':
          $message = $lang['Images_Allowed_For_Registered_Only'];
          break;
      case 'link':
          $message = $lang['Links_Allowed_For_Registered_Only'];
          break;
      case 'email':
          $message = $lang['Emails_Allowed_For_Registered_Only'];
          break;
    }

    $replacer = '<table width="40%" cellspacing="1" cellpadding="3" border="0"><tr><td class="quote">';
    $replacer .= $message . '<br />';
    $replacer .= sprintf($lang['Get_Registered'], "<a href=\"" . append_sid('profile.' . $phpEx . '?mode=register') . "\">", "</a>");
    $replacer .= "<a href=\"modules.php?name=Forums&amp;file=login\">" . $lang['Login'] . "</a>";
    $replacer .= '</td></tr></table>';

    if ($userdata['session_logged_in'])
    {
        switch($mode) {
          case 'img':
          $user_option = $userdata['user_hide_images'];
          break;
          default:
          $user_option = 0;
          break;
        }
            $replacer = '<table width="40%" cellspacing="1" cellpadding="3" border="0"><tr><td class="quote">';
            $replacer .= sprintf($lang['Image_Blocked'], "<a href=\"" . append_sid('profile.' . $phpEx) . "\">", "</a>");
            $replacer .= '</td></tr></table>';
        if ($user_option) {
            return $replacer;
        } else {
            return $bb;
        }

    } else {
         switch($mode) {
          case 'img':
          $config = $board_config['hide_images'];
          break;
          case 'link':
          $config = $board_config['hide_links'];
          break;
          case 'email':
           $config = $board_config['hide_emails'];
          break;
        }

        if ($config) {
          return $replacer;
        } else {
          return $bb;
        }
    }
}
/*****[END]********************************************
 [ Mod:     Hide Images and Links              v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    Hide Mod                            v1.2.0 ]
 ******************************************************/
function hide_in_quote($text)
{
        $text = preg_replace("#\[hide\](.*?)\[\/hide\]#si","--- phpBB : The Protected Message is not copied in this quote ---", $text);
        return $text;
}

function bbencode_third_pass($text, $uid, $deprotect)
{
    global $bbcode_tpl;

    // pad it with a space so we can distinguish between FALSE and matching the 1st char (index 0).
    // This is important; bbencode_quote(), bbencode_list(), and bbencode_code() all depend on it.
    $text = " " . $text;

    // First: If there isn't a "[" and a "]" in the message, don't bother.
    if (! (strpos($text, "[") && strpos($text, "]")) )
    {
        // Remove padding, return.
        $text = substr($text, 1);
        return $text;
    }

    // Patterns and replacements for URL and email tags..
    $patterns = array();
    $replacements = array();
 
    if ( $deprotect ) 
    {
        $patterns[0] = "#\[hide:$uid\](.*?)\[/hide:$uid\]#si";
        $replacements[0] = $bbcode_tpl['show'];
    }
    else
    {
        $patterns[0] = "#\[hide:$uid\](.*?)\[/hide:$uid\]#si";
        $replacements[0] = $bbcode_tpl['hide'];
    }

    $text = preg_replace($patterns, $replacements, $text);
 
    // Remove our padding from the string..
    $text = substr($text, 1);

    return $text;
}
/*****[END]********************************************
 [ Mod:    Hide Mod                            v1.2.0 ]
 ******************************************************/

/**
 * Does second-pass bbencoding. This should be used before displaying the message in
 * a thread. Assumes the message is already first-pass encoded, and we are given the
 * correct UID as used in first-pass encoding.
 */
function bbencode_second_pass($text, $uid)
{
    global $lang, $bbcode_tpl, $userdata, $board_config;

    $text = preg_replace('#(script|about|applet|activex|chrome):#is', "\\1&#058;", $text);

    // pad it with a space so we can distinguish between FALSE and matching the 1st char (index 0).
    // This is important; bbencode_quote(), bbencode_list(), and bbencode_code() all depend on it.
    $text = " " . $text;

    // First: If there isn't a "[" and a "]" in the message, don't bother.
    if (! (strpos($text, "[") && strpos($text, "]")) )
    {
        // Remove padding, return.
        $text = substr($text, 1);
        return $text;
    }

    // Only load the templates ONCE..
    if (!defined("BBCODE_TPL_READY"))
    {
        // load templates from file into array.
        $bbcode_tpl = load_bbcode_template();

        // prepare array for use in regexps.
        $bbcode_tpl = prepare_bbcode_template($bbcode_tpl);
    }

    // [CODE] and [/CODE] for posting code (HTML, PHP, C etc etc) in your posts.
    $text = bbencode_second_pass_code($text, $uid, $bbcode_tpl);

/*****[BEGIN]******************************************
 [ Mod:     PHP Syntax Highlighter BBCode      v3.0.7 ]
 ******************************************************/
    // [PHP] and [/PHP] for posting PHP code in your posts.
    $text = bbencode_second_pass_php($text, $uid, $bbcode_tpl);
/*****[END]********************************************
 [ Mod:     PHP Syntax Highlighter BBCode      v3.0.7 ]
 ******************************************************/

    // [QUOTE] and [/QUOTE] for posting replies with quote, or just for quoting stuff.
    $text = str_replace("[quote:$uid]", $bbcode_tpl['quote_open'], $text);
    $text = str_replace("[/quote:$uid]", $bbcode_tpl['quote_close'], $text);

/*****[BEGIN]******************************************
 [ Mod:     Extended Quote Tag                 v1.0.0 ]
 ******************************************************/
    // opening a quote with a pre-defined post entry
    $text = preg_replace("/\[quote:$uid=p=&quot;([0-9]+)&quot;\]/si", $bbcode_tpl['quote_post_open'], $text);
    $text = preg_replace("/\[quote:$uid=p=\"([0-9]+)\"\]/si", $bbcode_tpl['quote_post_open'], $text);

    // opening a username quote with a pre-defined post entry
    $text = preg_replace("/\[quote:$uid=(?:&quot;?([^\"]*)&quot;?);p=(?:&quot;?([0-9]+)&quot;?)\]/si", $bbcode_tpl['quote_username_post_open'], $text);
    $text = preg_replace("/\[quote:$uid=(?:\"?([^\"]*)\"?);p=(?:\"?([0-9]+)\"?)\]/si", $bbcode_tpl['quote_username_post_open'], $text);
    $text = preg_replace("/\[quote:$uid=(?:\"?([^\"]*)&quot;?);p=(?:&quot;?([0-9]+)\"?)\]/si", $bbcode_tpl['quote_username_post_open'], $text);
/*****[END]********************************************
 [ Mod:     Extended Quote Tag                 v1.0.0 ]
 ******************************************************/

    // New one liner to deal with opening quotes with usernames...
    // replaces the two line version that I had here before..
    $text = preg_replace("/\[quote:$uid=\"(.*?)\"\]/si", $bbcode_tpl['quote_username_open'], $text);

    //Fix for the destroyed quotes Technocrat
    $text = preg_replace("/\[quote:$uid=&quot;(.*?)&quot;\]/si", $bbcode_tpl['quote_username_open'], $text);

    // [list] and [list=x] for (un)ordered lists.
    # unordered lists
    $text = str_replace("[list:$uid]", $bbcode_tpl['ulist_open'], $text);
    
    # li tags
    $text = str_replace("[*:$uid]", $bbcode_tpl['listitem'], $text);

    # ending tags
    $text = str_replace("[/list:u:$uid]", $bbcode_tpl['ulist_close'], $text);
    $text = str_replace("[/list:o:$uid]", $bbcode_tpl['olist_close'], $text);

    # Ordered lists
    $text = preg_replace("/\[list=([ai1]):$uid\]/si", $bbcode_tpl['olist_open'], $text);

    # size
    // $text = preg_replace("/\[size=([1-2]?[0-9]):$uid\]/si", $bbcode_tpl['size_open'], $text);
    // $text = str_replace("[/size:$uid]", $bbcode_tpl['size_close'], $text);

    # [b] and [/b] for bolding text.
    $text = str_replace("[b:$uid]", $bbcode_tpl['b_open'], $text);
    $text = str_replace("[/b:$uid]", $bbcode_tpl['b_close'], $text);

    # [u] and [/u] for underlining text.
    $text = str_replace("[u:$uid]", $bbcode_tpl['u_open'], $text);
    $text = str_replace("[/u:$uid]", $bbcode_tpl['u_close'], $text);

    # [i] and [/i] for italicizing text.
    $text = str_replace("[i:$uid]", $bbcode_tpl['i_open'], $text);
    $text = str_replace("[/i:$uid]", $bbcode_tpl['i_close'], $text);

    # [strike]Strikethrough[/strike] code..
    $text = str_replace("[s:$uid]", $bbcode_tpl['s_open'], $text);
    $text = str_replace("[/s:$uid]", $bbcode_tpl['s_close'], $text);

    /* ----- this is support for bbcode used by a previous version of SCEditor ----- */
    # [center]text[/center] code..
    $text = preg_replace("/\[center\]/si", $bbcode_tpl['center_open'], $text);
    $text = str_replace("[/center]", $bbcode_tpl['center_close'], $text);

    # [right]text[/right] code..
    $text = preg_replace("/\[right\]/si", $bbcode_tpl['right_open'], $text);
    $text = str_replace("[/right]", $bbcode_tpl['right_close'], $text);

    # [left]text[/left] code..
    $text = preg_replace("/\[left\]/si", $bbcode_tpl['left_open'], $text);
    $text = str_replace("[/left]", $bbcode_tpl['left_close'], $text);

    # [justify]text[/justify] code..
    $text = preg_replace("/\[justify\]/si", $bbcode_tpl['justify_open'], $text);
    $text = str_replace("[/justify]", $bbcode_tpl['justify_close'], $text);
    /* ----- this is support for bbcode used by a previous version of SCEditor ----- */

    # [align=left/center/right/justify]Formatted Code[/align] code..
    $text = preg_replace("/\[align=(left|right|center|justify):$uid\]/si", $bbcode_tpl['align_open'], $text);
    $text = str_replace("[/align:$uid]", $bbcode_tpl['align_close'], $text);

    # [font=fonttype]text[/font] code..
    $text = preg_replace("/\[font=(.*?):$uid\]/si", $bbcode_tpl['font_open'], $text);
    $text = str_replace("[/font:$uid]", $bbcode_tpl['font_close'], $text);

    # colours
    $text = preg_replace("/\[color=(\#[0-9A-F]{6}|[a-z\-]+):$uid\]/si", $bbcode_tpl['color_open'], $text);
    $text = str_replace("[/color:$uid]", $bbcode_tpl['color_close'], $text);

    /* ----- new bbcode addition to v3 ----- */
    # highlight
    $text = preg_replace("/\[highlight=(\#[0-9A-F]{6}|[a-z\-]+):$uid\]/si", $bbcode_tpl['highlight_open'], $text);
    $text = str_replace("[/highlight:$uid]", $bbcode_tpl['highlight_close'], $text);
    /* ----- new bbcode addition to v3 ----- */

    // Patterns and replacements for URL and email tags..
    $patterns = array();
    $replacements = array();

    // [img]image_url_here[/img] code..
    // This one gets first-passed..
    $patterns[] = "#\[img:$uid\]([^?](?:[^\[]+|\[(?!url))*?)\[/img:$uid\]#i";
    $replacements[] = replacer('img', $bbcode_tpl['img']);

/*****[BEGIN]******************************************
 [ Mod:    Hide Mod                            v1.2.0 ]
 ******************************************************/
	//[hide]message[/hide]
	// $text = preg_replace("#\[hide\](.*?)\[\/hide\]#si","[hide:$uid]\\1[/hide:$uid]", $text);
/*****[END]********************************************
 [ Mod:    Hide Mod                            v1.2.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Hide Images and Links              v1.0.0 ]
 ******************************************************/
    // matches a [url]xxxx://www.phpbb.com[/url] code..
    $patterns[] = "#\[url\]([\w]+?://([\w\#$%&~/.\-;:=,?@\]+]+|\[(?!url=))*?)\[/url\]#is";
    $replacements[] = replacer('link', $bbcode_tpl['url1']);

    // [url]www.phpbb.com[/url] code.. (no xxxx:// prefix).
    $patterns[] = "#\[url\]((www|ftp)\.([\w\#$%&~/.\-;:=,?@\]+]+|\[(?!url=))*?)\[/url\]#is";
    $replacements[] = replacer('link', $bbcode_tpl['url2']);

    // [url=xxxx://www.phpbb.com]phpBB[/url] code..
    $patterns[] = "#\[url=([\w]+?://[\w\#$%&~/.\-;:=,?@\[\]+]*?)\]([^?\n\r\t].*?)\[/url\]#is";
    $replacements[] = replacer('link', $bbcode_tpl['url3']);

    // [url=www.phpbb.com]phpBB[/url] code.. (no xxxx:// prefix).
    $patterns[] = "#\[url=((www|ftp)\.[\w\#$%&~/.\-;:=,?@\[\]+]*?)\]([^?\n\r\t].*?)\[/url\]#is";
    $replacements[] = replacer('link', $bbcode_tpl['url4']);

    // [url=www.phpbb.com]phpBB[/url] code.. (no xxxx:// prefix).
    $patterns[] = "#\[url=(.*?)\](.*?)\[/url\]#is";
    $replacements[] = replacer('link', $bbcode_tpl['url5']);

    // [email]user@domain.tld[/email] code..
/*****[BEGIN]******************************************
 [ Mod:     Anti-Spam                         v.1.1.0 ]
 ******************************************************/
    $patterns[] = "#\[email\]([a-z0-9&\-_.]+?)@([a-z0-9&\-_.]+)\.([a-z]+)\[/email\]#si";
/*****[END]********************************************
 [ Mod:     Anti-Spam                         v.1.1.0 ]
 ******************************************************/
    $replacements[] = replacer('email', $bbcode_tpl['email']);
/*****[END]********************************************
 [ Mod:     Hide Images and Links              v1.0.0 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:     Advanced BBCode Box               v5.0.0a ]
 ******************************************************/
    $text = preg_replace($patterns, $replacements, $text);    

    // [marquee=left/right/up/down]Marquee Code[/marquee] code..
    // $text = preg_replace("/\[marq=(left|right|up|down):$uid\]/si", $bbcode_tpl['marq_open'], $text);
    // $text = str_replace("[/marq:$uid]", $bbcode_tpl['marq_close'], $text);

    // // [table=blah]Table[/table] code..
    // $text = preg_replace("/\[table=(.*?):$uid\]/si", $bbcode_tpl['table_open'], $text);
    // $text = str_replace("[/table:$uid]", $bbcode_tpl['table_close'], $text);

    // // [cell=blah]Cell[/table] code..
    // $text = preg_replace("/\[cell=(.*?):$uid\]/si", $bbcode_tpl['cell_open'], $text);
    // $text = str_replace("[/cell:$uid]", $bbcode_tpl['cell_close'], $text);    

    // [hr]
    $text = str_replace("[hr:$uid]", $bbcode_tpl['hr'], $text);

    // [sub]Subscrip[/sub] code..
    // $text = str_replace("[sub:$uid]", '<sub>', $text);
    // $text = str_replace("[/sub:$uid]", '</sub>', $text);

    // [sup]Superscript[/sup] code..
    // $text = str_replace("[sup:$uid]", '<sup>', $text);
    // $text = str_replace("[/sup:$uid]", '</sup>', $text);

    // [spoil]Spoiler[/spoil] code..
    $text = str_replace("[spoil:$uid]", $bbcode_tpl['spoil_open'], $text);
    $text = str_replace("[/spoil:$uid]", $bbcode_tpl['spoil_close'], $text);

    /* ----- This code is no longer used in V3 of Xtreme, was only left here for those videos already submitted into the forums -----*/
    $patterns[] = "#\[youtube\]([0-9A-Za-z-_]{11})[^[]*\[/youtube\]#is";
    $replacements[] = $bbcode_tpl['youtubeV209'];
    /* ----- This code is no longer used in V3 of Xtreme, was only left here for those videos already submitted into the forums -----*/
/*****[END]********************************************
 [ Mod:     Advanced BBCode Box               v5.0.0a ]
 ******************************************************/

    $text = preg_replace($patterns, $replacements, $text);

    // $text = preg_replace_callback("#\[video=(.*?)\](.*?)\[/video\]#is", 'evo_parse_video_callback', $text);
    $text = preg_replace_callback("#\[video=(.*?)\](.*?)\[/video\]#is", 'evo_parse_video_callback', $text);
    
	// $text = preg_replace("/\[size=(.*?):$uid\]/si", $bbcode_tpl['size_open'], $text);
    // $text = str_replace("[/size:$uid]", $bbcode_tpl['size_close'], $text);

    $text = preg_replace("/\[font=(.*?):$uid\]/si", $bbcode_tpl['font_open'], $text);
    $text = str_replace("[/font:$uid]", $bbcode_tpl['font_close'], $text);
	
	// $text = preg_replace_callback("#\[size=([1-2]?[0-9])]:$uid\](.*?)\[/size:$uid]#i", 'evo_font_size_callback', $text);
	$text = preg_replace_callback("(\[size=(.*?):$uid\](.*?)\[/size:$uid\])si", 'evo_font_size_callback', $text);

    // Remove our padding from the string..
    $text = substr($text, 1);

    return $text;

} // bbencode_second_pass()

// Need to initialize the random numbers only ONCE
//mt_srand( (double) microtime() * 1000000);
mt_srand(0, MT_RAND_MT19937);

function make_bbcode_uid()
{
    // Unique ID for this message..
    $uid = dss_rand();
    $uid = substr($uid, 0, BBCODE_UID_LEN);
    return $uid;
}

function bbencode_first_pass($text, $uid)
{
    global $bbcode_tpl;
	defined('_BBCODE_UNIQUE_ID') or define('_BBCODE_UNIQUE_ID', $uid);
    // pad it with a space so we can distinguish between FALSE and matching the 1st char (index 0).
    // This is important; bbencode_quote(), bbencode_list(), and bbencode_code() all depend on it.
    $text = " " . $text;
    if( preg_match('/<img.*>/', $text) )
    {
    //    message_die(GENERAL_ERROR, "The ".htmlentities("<img>")." tag is not allowed");
    }
    // [CODE] and [/CODE] for posting code (HTML, PHP, C etc etc) in your posts.
    $text = bbencode_first_pass_pda($text, $uid, '[code]', '[/code]', '', true, '');

/*****[BEGIN]******************************************
 [ Mod:     PHP Syntax Highlighter BBCode      v3.0.7 ]
 ******************************************************/
    // [PHP] and [/PHP] for posting PHP code in your posts.
    $text = bbencode_first_pass_pda($text, $uid, '[php]', '[/php]', '', true, '');
/*****[END]********************************************
 [ Mod:     PHP Syntax Highlighter BBCode      v3.0.7 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Extended Quote Tag                 v1.0.0 ]
 ******************************************************/
    // [QUOTE] and [/QUOTE] for posting replies with quote, or just for quoting stuff with an pre-defined post entry
   $text = bbencode_first_pass_pda($text, $uid, '/\[quote=p=\\\\&quot;([0-9]+)\\\\&quot;\]/is', '[/quote]', '', false, '', "[quote:$uid=p=\\\"\\1\\\"]");
   $text = bbencode_first_pass_pda($text, $uid, '/\[quote=p=&quot;([0-9]+)&quot;\]/is', '[/quote]', '', false, '', "[quote:$uid=p=\\\"\\1\\\"]");
   $text = bbencode_first_pass_pda($text, $uid, '/\[quote=&quot;(.*?)&quot;;p=&quot;([0-9]+)&quot;\]/is', '[/quote]', '', false, '', "[quote:$uid=\\\"\\1\\\";p=\\\"\\2\\\"]");
   $text = bbencode_first_pass_pda($text, $uid, '/\[quote=\\\\&quot;(.*?)\\\\&quot;;p=\\\\&quot;([0-9]+)\\\\&quot;\]/is', '[/quote]', '', false, '', "[quote:$uid=\\\"\\1\\\";p=\\\"\\2\\\"]");
/*****[END]********************************************
 [ Mod:     Extended Quote Tag                 v1.0.0 ]
 ******************************************************/

    // [QUOTE] and [/QUOTE] for posting replies with quote, or just for quoting stuff.
    $text = bbencode_first_pass_pda($text, $uid, '[quote]', '[/quote]', '', false, '');

    //Removed by Techno (http://evaders.swrebellion.com/forums/postt34.html)
	//$text = bbencode_first_pass_pda($text, $uid, '/\[quote=\\\\&quot;(.*?)\\\\&quot;\]/is', '[/quote]', '', false, '', "[quote:$uid=\\\&quot;\\1\\\&quot;]");
    $text = bbencode_first_pass_pda($text, $uid, '/\[quote=\\\&quot;(.*?)\\\&quot;\]/is', '[/quote]', '', false, '', "[quote:$uid=\\\"\\1\\\"]");


    // [list] and [list=x] for (un)ordered lists.
    $open_tag = array();
    $open_tag[0] = "[list]";

    // unordered..
    $text = bbencode_first_pass_pda($text, $uid, $open_tag, "[/list]", "[/list:u]", false, 'replace_listitems');

    $open_tag[0] = "[list=1]";
    $open_tag[1] = "[list=a]";
    $open_tag[2] = "[list=i]";

    // ordered.
    $text = bbencode_first_pass_pda($text, $uid, $open_tag, "[/list]", "[/list:o]",  false, 'replace_listitems');

    # these were added for an older version of xtreme that used the SCEditor v2
    # SCeditor Center Alignment
    // $text = preg_replace_callback("(\[center\](.*?)\[/center\])is", create_function('$m','return "<div style=\"text-align:center;\">".$m[1]."</div>";'), $text);
    // $text = preg_replace_callback("(\[center\](.*?)\[/center\])is", function($m) { return '[align=center:'._BBCODE_UNIQUE_ID.']'.$m[1].'[/align:'._BBCODE_UNIQUE_ID.']'; }, $text);

    # SCeditor Left Alignment
    // $text = preg_replace_callback("(\[left\](.*?)\[/left\])is", create_function('$m','return "<div style=\"text-align:left;\">".$m[1]."</div>";'), $text);
    // $text = preg_replace_callback("(\[left\](.*?)\[/left\])is", function($m) { return '[align=left:'._BBCODE_UNIQUE_ID.']'.$m[1].'[/align:'._BBCODE_UNIQUE_ID.']'; }, $text);

    # SCeditor Right Alignment
    // $text = preg_replace_callback("(\[right\](.*?)\[/right\])is", create_function('$m','return "<div style=\"text-align:right;\">".$m[1]."</div>";'), $text);
    // $text = preg_replace_callback("(\[right\](.*?)\[/right\])is", function($m) { return '[align=right:'._BBCODE_UNIQUE_ID.']'.$m[1].'[/align:'._BBCODE_UNIQUE_ID.']'; }, $text);

    # SCeditor Justify Alignment
    // $text = preg_replace_callback("(\[justify\](.*?)\[/justify\])is", create_function('$m','return "<div style=\"text-align:justify;\">".$m[1]."</div>";'), $text);
    // $text = preg_replace_callback("(\[justify\](.*?)\[/justify\])is", function($m) { return '[align=justify:'._BBCODE_UNIQUE_ID.']'.$m[1].'[/align:'._BBCODE_UNIQUE_ID.']'; }, $text);


    // $text = preg_replace_callback("(\[youtube\](.*?)\[/youtube\])is", function($m) { return '[video=youtube]https://www.youtube.com/watch?v='.$m[1].'[/video]<br />'.$m[1]; }, $text);

    # [highlight=#xxxxxx] and [/highlight] for highlighting text
    // (\#[0-9A-F]{6}|[a-z\-]+) 
    $text = preg_replace_callback("(\[highlight=(\#[0-9A-F]{6}|[a-z\-]+)\](.*?)\[/highlight\])is", function($m) { return '[highlight='.$m[1].':'._BBCODE_UNIQUE_ID.']'.$m[2].'[/highlight:'._BBCODE_UNIQUE_ID.']'; }, $text);
	
    # [color] and [/color] for setting text color
    $text = preg_replace_callback("(\[color=(\#[0-9A-F]{6}|[a-z\-]+)\](.*?)\[/color\])is", function($m) { return '[color='.$m[1].':'._BBCODE_UNIQUE_ID.']'.$m[2].'[/color:'._BBCODE_UNIQUE_ID.']'; }, $text); 
	
    # [size] and [/size] for setting text size
    // $text = preg_replace_callback("(\[size=([1-2]?[0-9])\](.*?)\[/size\])is", function($m) { return '[size='.$m[1].':'._BBCODE_UNIQUE_ID.']'.$m[2].'[/size:'._BBCODE_UNIQUE_ID.']'; }, $text);
    $text = preg_replace_callback("(\[size=(.*?)\](.*?)\[/size\])is", function($m) { return '[size='.$m[1].':'._BBCODE_UNIQUE_ID.']'.$m[2].'[/size:'._BBCODE_UNIQUE_ID.']'; }, $text);

    # [b] and [/b] for bolding text.
    $text = preg_replace_callback("(\[b\](.*?)\[/b\])is", function($m) { return '[b:'._BBCODE_UNIQUE_ID.']'.$m[1].'[/b:'._BBCODE_UNIQUE_ID.']'; }, $text);

    # [u] and [/u] for underlining text.
    $text = preg_replace_callback("(\[u\](.*?)\[/u\])is", function($m) { return '[u:'._BBCODE_UNIQUE_ID.']'.$m[1].'[/u:'._BBCODE_UNIQUE_ID.']'; }, $text);

    # [i] and [/i] for italicizing text.
    $text = preg_replace_callback("(\[i\](.*?)\[/i\])is", function($m) { return '[i:'._BBCODE_UNIQUE_ID.']'.$m[1].'[/i:'._BBCODE_UNIQUE_ID.']'; }, $text);

    # [strike]Strikethrough[/strike] code..
    $text = preg_replace_callback("(\[s\](.*?)\[/s\])is", function($m) { return '[s:'._BBCODE_UNIQUE_ID.']'.$m[1].'[/s:'._BBCODE_UNIQUE_ID.']'; }, $text);

    # [img]image_url_here[/img] code..
    $text = preg_replace_callback("(\[img\]((http|ftp|https|ftps)://)([^ \?&=\#\"\n\r\t<]*?(\.(jpg|jpeg|gif|png)))\[/img\])is", function($m) { 
	return '[img:'._BBCODE_UNIQUE_ID.']'.$m[1].str_replace(' ','%20',$m[3]).'[/img:'._BBCODE_UNIQUE_ID.']'; }, $text);

    # [align=left/center/right/justify]Formatted Code[/align] code..
    $text = preg_replace_callback("(\[align=(left|right|center|justify)\](.*?)\[/align\])is", function($m) { return '[align='.$m[1].':'._BBCODE_UNIQUE_ID.']'.$m[2].'[/align:'._BBCODE_UNIQUE_ID.']'; }, $text);

    #  [font=fonttype]text[/font] code..
    $text = preg_replace_callback("(\[font=(.*?)\](.*?)\[/font\])is", function($m) { return '[font='.$m[1].':'._BBCODE_UNIQUE_ID.']'.$m[2].'[/font:'._BBCODE_UNIQUE_ID.']'; }, $text);
	
	# [hr]
    $text = preg_replace_callback("(\[hr\])is", function($m) { return '[hr:'._BBCODE_UNIQUE_ID.']'; }, $text);
	
	# [spoil]Spoiler[/spoil] code..
    $text = preg_replace_callback("(\[spoil\](.*?)\[/spoil\])is", function($m) { return '[spoil:'._BBCODE_UNIQUE_ID.']'.$m[1].'[/spoil:'._BBCODE_UNIQUE_ID.']'; }, $text);
    
    # [sub]Subscript[/sub] code..
    // $text = preg_replace_callback("(\[sub\](.*?)\[/sub\])is", function($m) { return '[sub:'._BBCODE_UNIQUE_ID.']'.$m[1].'[/sub:'._BBCODE_UNIQUE_ID.']'; }, $text);
    
    # [sup]Superscript[/sup] code..
    // $text = preg_replace_callback("(\[sup\](.*?)\[/sup\])is", function($m) { return '[sup:'._BBCODE_UNIQUE_ID.']'.$m[1].'[/sup:'._BBCODE_UNIQUE_ID.']'; }, $text);

    # videos
    // $text = preg_replace_callback("#\[video=(.*?)\](.*?)\[/video\]#i", 'mycode_parse_video_callback', $text);

	
  	# [fade]Faded Text[/fade] code..
  	// $text = preg_replace_callback("(\[fade\](.*?)\[/fade\])is", create_function('$matches','return "[fade:'.$uid.']$matches[1][/fade:'.$uid.']";'), $text);	
  	
  	# [marquee=left/right/up/down]Marquee Code[/marquee] code..
  	// $text = preg_replace_callback("(\[marq=(left|right|up|down)\](.*?)\[/marq\])is", create_function('$matches','return "[marq=$matches[1]:'.$uid.']$matches[2][/marq:'.$uid.']";'), $text);
  	
  	# [table=blah]Table[/table] code..
  	// $text = preg_replace_callback("(\[table=(.*?)\](.*?)\[/table\])is", create_function('$matches','return "[table=$matches[1]:'.$uid.']$matches[2][/table:'.$uid.']";'), $text);
  	
  	# [cell=blah]Cell[/table] code..
  	// $text = preg_replace_callback("(\[cell=(.*?)\](.*?)\[/cell\])is", create_function('$matches','return "[cell=$matches[1]:'.$uid.']$matches[2][/cell:'.$uid.']";'), $text);
	
    # tag/mention a member
    $text = preg_replace_callback("(\[tag\](.*?)\[/tag\])is", 'evo_mention_callback', $text);

    // Remove our padding from the string..
    return substr($text, 1);

} // bbencode_first_pass()

function evo_mention($user)
{
	global $db, $bbcode_tpl, $lang;
	

	$row = $db->sql_ufetchrow("SELECT `user_id`, `username` FROM `".USERS_TABLE."` WHERE `username` = '".$user."'");
	// return $user.' - '.$row['user_id'];
  return '<a href="modules.php?name=Private_Messages&mode=post&u='.$row['user_id'].'" target="_blank" alt="'.$lang['Send_private_message'].'" title="'.$lang['Send_private_message'].'">'.$user.'</a>';
}

function evo_mention_callback($matches)
{
    return evo_mention($matches[1]);
}







function evo_font_size($size, $text)
{
	global $bbcode_tpl;
	$pixels = (is_numeric($size)) ? 'px' : '';
	$bbcode_tpl['font_size_open'] = str_replace('{SIZE}', $size, $bbcode_tpl['font_size']);
	$bbcode_tpl['font_size_open'] = str_replace('{PX}', $pixels, $bbcode_tpl['font_size_open']);
	return $bbcode_tpl['font_size_open'].$text.$bbcode_tpl['font_size_close'];
}

function evo_font_size_callback($matches)
{
    return evo_font_size($matches[1], $matches[2]);
}

/* ----- parse videos ----- */
function evo_parse_video($video, $url)
{
    global $bbcode_tpl, $board_config;

    // if(empty($video) || empty($url))
    // {
    //     return "[video={$video}]{$url}[/video]";
    // }

    $parsed_url = parse_url(urldecode($url));

    $winchester = '';
    if($parsed_url == false)
    {
        // return "[video={$video}]{$url}[/video]";
        $winchester = 'Dean & Sam';
    }

    $fragments = array();

    if(!isset($parsed_url['fragment']))
    $parsed_url['fragment'] = '';
    
	if($parsed_url['fragment'])
    {
        $fragments = explode("&", $parsed_url['fragment']);
    }

    if(!isset($parsed_url['query']))
    $parsed_url['query'] = '';
    
	$queries = explode("&", $parsed_url['query']);

    $input = array();

    foreach($queries as $query)
    {
		if (strpos($query, '-') !== false) {
         list($key, $value) = explode("=", $query, 2);
		}
		
        if(!isset($key))
        $key = '';		

        if(!isset($value))
        $value = '';		
        
		$key = str_replace("amp;", "", $key);
        $input[$key] = $value;
    }

    $path = explode('/', $parsed_url['path']);

    if(!isset($fragments[0]))
    $fragments[0] = '';		

    if(!isset($input['v']))
    $input['v'] = '';		

    switch($video):

		/* ----- youtube video embed ----- */
		case "youtube":
			if($fragments[0])
				# http://www.youtube.com/watch#!v=fds123
				$id = str_replace('!v=', '', $fragments[0]); 
			elseif($input['v'])
				# http://www.youtube.com/watch?v=fds123
				$id = $input['v']; 
			else
				# http://www.youtu.be/fds123
				$id = $path[1];

			$video_replace = str_replace('{YOUTUBE}', $id, $bbcode_tpl['youtube']);
			$video_replace = str_replace('{WATCH_YOUTUBE}', _WATCH_YOUTUBE, $video_replace);
			$video_replace = str_replace('{YOUTUBE_WIDTH}', $board_config['youtube_width'], $video_replace);
			$video_replace = str_replace('{YOUTUBE_HEIGHT}', $board_config['youtube_height'], $video_replace);
			break;

		/* ----- twitch video embed ----- */
		case "twitch":

			if(preg_match("/clips/", $url, $matches)):
			
				$clips = explode('/', $url);
				$id = 'embed?clip='.$clips[3].'&autoplay=false&tt_medium=clips_embed';
				$video_replace = str_replace('{TYPE}', 'clips', $bbcode_tpl['twitch']);
				$video_replace = str_replace('{TWITCH}', $id, $video_replace);
			
			else:
			
				if(count($path) >= 3 && $path[1] == 'videos')
					# Direct video embed with URL like: https://www.twitch.tv/videos/179723472
					$id = 'video=v'.$path[2];
				elseif(count($path) >= 4 && $path[2] == 'v')
					# Direct video embed with URL like: https://www.twitch.tv/waypoint/v/179723472
					$id = 'video=v'.$path[3];
				elseif(count($path) >= 2)
					# Channel (livestream) embed with URL like: https://twitch.tv/waypoint
				$id = 'channel='.$path[1];

				$time = explode("?", $url);
				$video_replace = str_replace('{TYPE}', 'player', $bbcode_tpl[$video]);
				$video_replace = str_replace('{TWITCH}', '?'.$id.(($time[1]) ? '&'.$time[1] : ''), $video_replace);
			
			endif;
			$video_replace = str_replace('{TWITCH_WIDTH}', $board_config['twitch_width'], $video_replace);
			$video_replace = str_replace('{TWITCH_HEIGHT}',  $board_config['twitch_height'], $video_replace);			        
			break;

		default:
			return "[video={$video}]{$url}[/video]";
    
	endswitch;

	if(empty($id))
	{
		return "[video={$video}]{$url}[/video]";
	}

	
	// eval("\$video_code = \"".$video_replace."\";");
	return $video_replace;
}

function evo_parse_video_callback($matches)
{
    return evo_parse_video($matches[1], $matches[2]);
}


# $text - The text to operate on.
# $uid - The UID to add to matching tags.
# $open_tag - The opening tag to match. Can be an array of opening tags.
# $close_tag - The closing tag to match.
# $close_tag_new - The closing tag to replace with.
# $mark_lowest_level - boolean - should we specially mark the tags that occur
# at the lowest level of nesting? (useful for [code], because
# we need to match these tags first and transform HTML tags
# in their contents..
# $func - This variable should contain a string that is the name of a function.
# That function will be called when a match is found, and passed 2
# parameters: ($text, $uid). The function should return a string.
# This is used when some transformation needs to be applied to the
# text INSIDE a pair of matching tags. If this variable is FALSE or the
# empty string, it will not be executed.
# If open_tag is an array, then the pda will try to match pairs consisting of
# any element of open_tag followed by close_tag. This allows us to match things
# like [list=A]...[/list] and [list=1]...[/list] in one pass of the PDA.
#
# NOTES:  - this function assumes the first character of $text is a space.
#         - every opening tag and closing tag must be of the [...] format.
function bbencode_first_pass_pda($text, $uid, $open_tag, $close_tag, $close_tag_new, $mark_lowest_level, $func, $open_regexp_replace = false)
{
    
	$open_tag_count = 0;

    if (!$close_tag_new || (empty($close_tag_new)))
    {
        $close_tag_new = $close_tag;
    }

    if(!isset($uid))
    $uid = '';

    $close_tag_length = strlen($close_tag);
    $close_tag_new_length = strlen($close_tag_new);
    $uid_length = strlen($uid);

    $use_function_pointer = ($func && (!empty($func)));

    $stack = array();

    if (is_array($open_tag))
    {
        if (0 == count($open_tag))
        {
            // No opening tags to match, so return.

            return $text;
        }
        $open_tag_count = count($open_tag);
    }
    else
    {
        // only one opening tag. make it into a 1-element array.
        $open_tag_temp = $open_tag;
        $open_tag = array();
        $open_tag[0] = $open_tag_temp;
        $open_tag_count = 1;
    }

    $open_is_regexp = false;

    if ($open_regexp_replace)
    {
        $open_is_regexp = true;
        if (!is_array($open_regexp_replace))
        {
            $open_regexp_temp = $open_regexp_replace;
            $open_regexp_replace = array();
            $open_regexp_replace[0] = $open_regexp_temp;
        }
    }

    if ($mark_lowest_level && $open_is_regexp)
    {
        message_die(GENERAL_ERROR, "Unsupported operation for bbcode_first_pass_pda().");
    }

    // Start at the 2nd char of the string, looking for opening tags.
    $curr_pos = 1;
    while ($curr_pos && ($curr_pos < strlen($text)))
    {
        $curr_pos = strpos($text, "[", $curr_pos);

        // If not found, $curr_pos will be 0, and the loop will end.
        if ($curr_pos)
        {
            // We found a [. It starts at $curr_pos.
            // check if it's a starting or ending tag.
            $found_start = false;
            $which_start_tag = "";
            $start_tag_index = -1;

            for ($i = 0; $i < $open_tag_count; $i++)
            {
                // Grab everything until the first "]"...
                $possible_start = substr($text, $curr_pos, strpos($text, ']', $curr_pos + 1) - $curr_pos + 1);

                //
                // We're going to try and catch usernames with "[' characters.
                //
                if( preg_match('#\[quote=\\\&quot;#si', $possible_start, $match) && !preg_match('#\[quote=\\\&quot;(.*?)\\\&quot;\]#si', $possible_start) )
                    {
                        // OK we are in a quote tag that probably contains a ] bracket.
                        // Grab a bit more of the string to hopefully get all of it..
                        if ($close_pos = strpos($text, '&quot;]', $curr_pos + 14))
                        {
                            if (strpos(substr($text, $curr_pos + 14, $close_pos - ($curr_pos + 14)), '[quote') === false)
                            {
                                $possible_start = substr($text, $curr_pos, $close_pos - $curr_pos + 7);
                            }
                        }
                    }
                // Now compare, either using regexp or not.
                if ($open_is_regexp)
                {
                    $match_result = array();
                    if (preg_match($open_tag[$i], $possible_start, $match_result))
                    {
                        $found_start = true;
                        $which_start_tag = $match_result[0];
                        $start_tag_index = $i;
                        break;
                    }
                }
                else
                {
                    // straightforward string comparison.
                    if (0 == strcasecmp($open_tag[$i], $possible_start))
                    {
                        $found_start = true;
                        $which_start_tag = $open_tag[$i];
                        $start_tag_index = $i;
                        break;
                    }
                }
            }

            if ($found_start)
            {
                // We have an opening tag.
                // Push its position, the text we matched, and its index in the open_tag array on to the stack, and then keep going to the right.
                $match = array("pos" => $curr_pos, "tag" => $which_start_tag, "index" => $start_tag_index);
                array_push($stack, $match);
                //
                // Rather than just increment $curr_pos
                // Set it to the ending of the tag we just found
                // Keeps error in nested tag from breaking out
                // of table structure..
                //
                $curr_pos += strlen($possible_start);
            }
            else
            {
                // check for a closing tag..
                $possible_end = substr($text, $curr_pos, $close_tag_length);
                if (0 == strcasecmp($close_tag, $possible_end))
                {
                    // We have an ending tag.
                    // Check if we've already found a matching starting tag.
                    if (count($stack) > 0)
                    {
                        // There exists a starting tag.
                        $curr_nesting_depth = count($stack);
                        // We need to do 2 replacements now.
                        $match = array_pop($stack);
                        $start_index = $match['pos'];
                        $start_tag = $match['tag'];
                        $start_length = strlen($start_tag);
                        $start_tag_index = $match['index'];

                        if ($open_is_regexp)
                        {
                            $start_tag = preg_replace($open_tag[$start_tag_index], $open_regexp_replace[$start_tag_index], $start_tag);
                        }

                        // everything before the opening tag.
                        $before_start_tag = substr($text, 0, $start_index);

                        // everything after the opening tag, but before the closing tag.
                        $between_tags = substr($text, $start_index + $start_length, $curr_pos - $start_index - $start_length);

                        // Run the given function on the text between the tags..
                        if ($use_function_pointer)
                        {
                            $between_tags = $func($between_tags, $uid);
                        }

                        // everything after the closing tag.
                        $after_end_tag = substr($text, $curr_pos + $close_tag_length);

                        // Mark the lowest nesting level if needed.
                        if ($mark_lowest_level && ($curr_nesting_depth == 1))
                        {
                            if ($open_tag[0] == '[code]')
                            {
                                $code_entities_match = array('#<#', '#>#', '#"#', '#:#', '#\[#', '#\]#', '#\(#', '#\)#', '#\{#', '#\}#');
                                $code_entities_replace = array('&lt;', '&gt;', '&quot;', '&#58;', '&#91;', '&#93;', '&#40;', '&#41;', '&#123;', '&#125;');
                                $between_tags = preg_replace($code_entities_match, $code_entities_replace, $between_tags);
                            }
                            if ($open_tag[0] == '[php]')
                            {
                                $between_tags = preg_replace('/\:[0-9a-z\:]+\]/si', ']', $between_tags);
                            }
                            $text = $before_start_tag . substr($start_tag, 0, $start_length - 1) . ":$curr_nesting_depth:$uid]";
                            $text .= $between_tags . substr($close_tag_new, 0, $close_tag_new_length - 1) . ":$curr_nesting_depth:$uid]";
                        }
                        else
                        {
                            if ($open_tag[0] == '[code]')
                            {
                                $text = $before_start_tag . '&#91;code&#93;';
                                $text .= $between_tags . '&#91;/code&#93;';
                            }
/*****[BEGIN]******************************************
 [ Mod:     PHP Syntax Highlighter BBCode      v3.0.7 ]
 ******************************************************/
                            else if ($open_tag[0] == '[php]')
                            {
                                $text = $before_start_tag . '&#91;php&#93;';
                                $text .= $between_tags . '&#91;/php&#93;';
                            }
/*****[END]********************************************
 [ Mod:     PHP Syntax Highlighter BBCode      v3.0.7 ]
 ******************************************************/
                            else
                            {
                                if ($open_is_regexp)
                                {
                                    $text = $before_start_tag . $start_tag;
                                }
                                else
                                {
                                    $text = $before_start_tag . substr($start_tag, 0, $start_length - 1) . ":$uid]";
                                }
                                $text .= $between_tags . substr($close_tag_new, 0, $close_tag_new_length - 1) . ":$uid]";
                            }
                        }

                        $text .= $after_end_tag;

                        // Now.. we've screwed up the indices by changing the length of the string.
                        // So, if there's anything in the stack, we want to resume searching just after it.
                        // otherwise, we go back to the start.
                        if (count($stack) > 0)
                        {
                            $match = array_pop($stack);
                            $curr_pos = $match['pos'];
//                            bbcode_array_push($stack, $match);
//                            ++$curr_pos;
                        }
                        else
                        {
                            $curr_pos = 1;
                        }
                    }
                    else
                    {
                        // No matching start tag found. Increment pos, keep going.
                        ++$curr_pos;
                    }
                }
                else
                {
                    // No starting tag or ending tag.. Increment pos, keep looping.,
                    ++$curr_pos;
                }
            }
        }
    } // while

    return $text;

} // bbencode_first_pass_pda()

/**
 * Does second-pass bbencoding of the [code] tags. This includes
 * running htmlspecialchars() over the text contained between
 * any pair of [code] tags that are at the first level of
 * nesting. Tags at the first level of nesting are indicated
 * by this format: [code:1:$uid] ... [/code:1:$uid]
 * Other tags are in this format: [code:$uid] ... [/code:$uid]
 */
function bbencode_second_pass_code($text, $uid, $bbcode_tpl)
{
    global $lang;

    $code_start_html = $bbcode_tpl['code_open'];
    $code_end_html =  $bbcode_tpl['code_close'];

    // First, do all the 1st-level matches. These need an htmlspecialchars() run,
    // so they have to be handled differently.
    $match_count = preg_match_all("#\[code:1:$uid\](.*?)\[/code:1:$uid\]#si", $text, $matches);

    for ($i = 0; $i < $match_count; $i++)
    {
        $before_replace = $matches[1][$i];
        $after_replace = $matches[1][$i];

        // Replace 2 spaces with "&nbsp; " so non-tabbed code indents without making huge long lines.
        $after_replace = str_replace("  ", "&nbsp; ", $after_replace);
        // now Replace 2 spaces with " &nbsp;" to catch odd #s of spaces.
        $after_replace = str_replace("  ", " &nbsp;", $after_replace);

        // Replace tabs with "&nbsp; &nbsp;" so tabbed code indents sorta right without making huge long lines.
        $after_replace = str_replace("\t", "&nbsp; &nbsp;", $after_replace);

        // now Replace space occurring at the beginning of a line
        $after_replace = preg_replace("/^ {1}/m", '&nbsp;', $after_replace);

        $str_to_match = "[code:1:$uid]" . $before_replace . "[/code:1:$uid]";

        $replacement = $code_start_html;
        $replacement .= $after_replace;
        $replacement .= $code_end_html;

        $text = str_replace($str_to_match, $replacement, $text);
    }

    // Now, do all the non-first-level matches. These are simple.
    $text = str_replace("[code:$uid]", $code_start_html, $text);
    $text = str_replace("[/code:$uid]", $code_end_html, $text);

    // $text = str_replace(array("<br>", "\r\n", "\r"), "\n", $text);




    # Fix linebreaks on important items
    $text = preg_replace("/<br>/si", "<br \/>", $text);

    $text = preg_replace("/<ul><br \/>/si", "<ul>", $text);
    $text = preg_replace("/<\/ul><br \/>/si", "</ul>", $text);

    // $text = preg_replace("/<br \/><ol type=\"1\">/si", "<ul>", $text);
    $text = preg_replace("/<\/ol><br \/>/si", "</ol>", $text);

    $text = preg_replace("/<\/table><br \/>/si", "</table>", $text);
    $text = preg_replace("/<\/div><br \/>/si", "</div>", $text);
    $text = preg_replace("/<br \/><table/si", "<table", $text);

    return $text;

} // bbencode_second_pass_code()

/*****[BEGIN]******************************************
 [ Mod:     PHP Syntax Highlighter BBCode      v3.0.7 ]
 ******************************************************/
/**
 * PHP MOD
 * Original code/function by phpBB Group
 * Modified by JW Frazier / Fubonis < php_fubonis@yahoo.com >
 */
function bbencode_second_pass_php($text, $uid, $bbcode_tpl)
{
    $code_start_html = $bbcode_tpl['php_open'];
    $code_end_html =  $bbcode_tpl['php_close'];

    // First, do all the 1st-level matches. These need an htmlspecialchars() run,
    // so they have to be handled differently.
    $match_count = preg_match_all("#\[php:1:$uid\](.*?)\[/php:1:$uid\]#si", $text, $matches);

    // To change the colors of the syntax, uncomment the 6 lines above and
    // change the color codes. IF your host php settings allow ini_set() the
    // colors will be changed. If ini_set() is disallowed, nothing will change.
//    @ini_set('highlight.string', '#DD0000');
//    @ini_set('highlight.comment', '#FF9900');
//    @ini_set('highlight.keyword', '#007700');
//    @ini_set('highlight.bg', '#FFFFFF');
//    @ini_set('highlight.default', '#0000BB');
//    @ini_set('highlight.html', '#000000');

    for ($i = 0; $i < $match_count; $i++)
    {
        $before_replace = $matches[1][$i];
        // $after_replace = ltrim(rtrim($matches[1][$i]), "\n\r\x0B");
        $after_replace = ltrim(rtrim($matches[1][$i]), "\n\r\x0B");

/*****[BEGIN]******************************************
 [ Mod:     Allow multiple spaces in posts     v1.0.0 ]
 ******************************************************/
        $after_replace = str_replace(' &nbsp;', '  ', $after_replace);
/*****[END]********************************************
 [ Mod:     Allow multiple spaces in posts     v1.0.0 ]
 ******************************************************/

        // Prepare the code for highlight_string()
        $after_replace = undo_htmlspecialchars($after_replace);

        // Add the php tags if needed to let highlight_string() works
        if (preg_match('/^<\?.*?\?>$/si', $after_replace) <= 0)
        {
            $after_replace = "<?php $after_replace ?>";
            $added = TRUE;
        } else
        {
            $added = FALSE;
        }

        // Highlight the php code
        if(strcmp('4.2.0', phpversion()) > 0)
        {
            ob_start();
            highlight_string($after_replace);
            $after_replace = ob_get_contents();
            ob_end_clean();
        } else
        {
            $after_replace = highlight_string($after_replace, TRUE);
        }

        // Remove the php tags if added to let highlight_string() work
        if ($added == TRUE)
        {
            $after_replace = substr_replace($after_replace, '', strpos($after_replace, '&lt;?php&nbsp;'), 14);
            $after_replace = substr_replace($after_replace, '', strrpos($after_replace, '?&gt;'), 5);
        }

        // Remove the <code> tag added by highlight_string() not to force the text size
        $after_replace = str_replace('<code>', '', $after_replace);
        $after_replace = str_replace('</code>', '', $after_replace);

        // Remove the new lines added by highlight_string()
        $after_replace = str_replace("\n", '', $after_replace);

        // Replace ":", "(" & ")" by their HTML codes to prevent smilies replacements
        $code_entities_match = array('#:#', '#\(#', '#\)#');
        $code_entities_replace = array('&#58;', '&#40;', '&#41;');
        $after_replace = preg_replace($code_entities_match, $code_entities_replace, $after_replace);

        // Replace <font color=...> by <span style="color:...> to be HTML 4 compliant and  not to force the text size too
        // $after_replace = preg_replace('/<font color="(.*?)">/si', '<span style="color: \\1;">', $after_replace);
        // $after_replace = str_replace('</font>', '</span>', $after_replace);

        $str_to_match = "[php:1:$uid]" . $before_replace . "[/php:1:$uid]";

        $replacement = $code_start_html;
        $replacement .= $after_replace;
        $replacement .= $code_end_html;

        $text = str_replace($str_to_match, $replacement, $text);
    }

    // Now, do all the non-first-level matches. These are simple.
    $text = str_replace("[php:$uid]", $code_start_html, $text);
    $text = str_replace("[/php:$uid]", $code_end_html, $text);

    return $text;

}  // bbencode_second_pass_code_php()
/*****[END]********************************************
 [ Mod:     PHP Syntax Highlighter BBCode      v3.0.7 ]
 ******************************************************/

/**
 * Rewritten by Nathan Codding - Feb 6, 2001.
 * - Goes through the given string, and replaces xxxx://yyyy with an HTML <a> tag linking
 *     to that URL
 * - Goes through the given string, and replaces www.xxxx.yyyy[zzzz] with an HTML <a> tag linking
 *     to http://www.xxxx.yyyy[/zzzz]
 * - Goes through the given string, and replaces xxxx@yyyy with an HTML mailto: tag linking
 *        to that email address
 * - Only matches these 2 patterns either after a space, or at the beginning of a line
 *
 * Notes: the email one might get annoying - it's easy to make it more restrictive, though.. maybe
 * have it require something like xxxx@yyyy.zzzz or such. We'll see.
 */
function make_clickable($text)
{
    global $userdata, $lang, $phpEx, $u_login_logout, $board_config;

    $text = preg_replace('#(script|about|applet|activex|chrome):#is', "\\1&#058;", $text);

    // pad it with a space so we can match things at the start of the 1st line.
    $ret = ' ' . $text;
/*****[BEGIN]******************************************
 [ Mod:     Hide Images and Links              v1.0.0 ]
 ******************************************************/
    // matches an "xxxx://yyyy" URL at the start of a line, or after a space.
    // xxxx can only be alpha characters.
    // yyyy is anything up to the first space, newline, comma, double quote or <
    $ret = preg_replace("#(^|[\n ])([\w]+?://[\w\#$%&~/.\-;:=,?@\[\]+]*)#is", replacer('link', "\\1<a href=\"\\2\" target=\"_blank\">\\2</a>"), $ret);

    // matches a "www|ftp.xxxx.yyyy[/zzzz]" kinda lazy URL thing
    // Must contain at least 2 dots. xxxx contains either alphanum, or "-"
    // zzzz is optional.. will contain everything up to the first space, newline,
    // comma, double quote or <.
    $ret = preg_replace("#(^|[\n ])((www|ftp)\.[\w\#$%&~/.\-;:=,?@\[\]+]*)#is", replacer('link', "\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>"), $ret);

/*****[BEGIN]******************************************
 [ Mod:     Anti-Spam                         v.1.1.0 ]
 ******************************************************/
   // matches an email@domain type address at the start of a line, or after a space.
   // Note: Only the followed chars are valid; alphanums, "-", "_" and or ".".
   $ret = preg_replace("#(^|[\n ])([a-z0-9&\-_.]+?)@([a-z0-9&\-_.]+)\.([a-z]+)#i", replacer('email', "\\1<a href=\"javascript:phpbbmail('\\3.\\4','\\2');\">\\2 [at] \\3 [dot] \\4</a>"), $ret);
/*****[END]********************************************
 [ Mod:     Anti-Spam                         v.1.1.0 ]
 ******************************************************/

/*****[END]********************************************
 [ Mod:     Hide Images and Links              v1.0.0 ]
 ******************************************************/
    // Remove our padding..
    $ret = substr($ret, 0);

    return($ret);
}

/**
 * Nathan Codding - Feb 6, 2001
 * Reverses the effects of make_clickable(), for use in editpost.
 * - Does not distinguish between "www.xxxx.yyyy" and "http://aaaa.bbbb" type URLs.
 *
 */
function undo_make_clickable($text)
{
    $text = preg_replace("#<!-- BBCode auto-link start --><a href=\"(.*?)\" target=\"_blank\">.*?</a><!-- BBCode auto-link end -->#i", "\\1", $text);
    $text = preg_replace("#<!-- BBcode auto-mailto start --><a href=\"mailto:(.*?)\">.*?</a><!-- BBCode auto-mailto end -->#i", "\\1", $text);
    return $text;
}

/**
 * Nathan Codding - August 24, 2000.
 * Takes a string, and does the reverse of the PHP standard function
 * htmlspecialchars().
 */
function undo_htmlspecialchars($input)
{
    $input = preg_replace("/&gt;/i", ">", $input);
    $input = preg_replace("/&lt;/i", "<", $input);
    $input = preg_replace("/&quot;/i", "\"", $input);
    $input = preg_replace("/&amp;/i", "&", $input);
    return $input;
}

/**
 * This is used to change a [*] tag into a [*:$uid] tag as part
 * of the first-pass bbencoding of [list] tags. It fits the
 * standard required in order to be passed as a variable
 * function into bbencode_first_pass_pda().
 */
function replace_listitems($text, $uid)
{
    $text = str_replace("[*]", "[*:$uid]", $text);
    return $text;
}

/**
 * Escapes the "/" character with "\/". This is useful when you need
 * to stick a runtime string into a PREG regexp that is being delimited
 * with slashes.
 */
function escape_slashes($input)
{
    $output = str_replace('/', '\/', $input);
    return $output;
}

/**
 * This function does exactly what the PHP4 function array_push() does
 * however, to keep phpBB compatable with PHP 3 we had to come up with our own
 * method of doing it.
 * This function was deprecated in phpBB 2.0.18
 */
function bbcode_array_push(&$stack, $value)
{
   $stack[] = $value;
   return (count($stack));
}

/**
 * This function does exactly what the PHP4 function array_pop() did!
 * Last modified 12/07/2021 by Ernest Allen Buffington
 */
function bbcode_array_pop(&$stack)
{
   $tmpArr = [];
   
   $return_val = null;
   
   $arrSize = is_countable($stack) ? count($stack) : 0;
   
   $x = 1;

   foreach ($stack as $key => $val):

     if($x < (is_countable($stack) ? count($stack) : 0)):
       $tmpArr[] = $val;
     else:
       $return_val = $val;
     endif;
       $x++;

   endforeach;
   
   $stack = $tmpArr;

   return($return_val);
}

//
// Smilies code ... would this be better tagged on to the end of bbcode.php?
// Probably so and I'll move it before B2
//
function smilies_pass($message)
{
    static $orig, $repl;

    if (!isset($orig))
    {
        global $db, $board_config, $cache;
        $orig = $repl = array();

/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
        if(($smilies = $cache->load('smilies', 'config')) === false) {
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
            $sql = 'SELECT * FROM ' . SMILIES_TABLE;
            if( !$result = $db->sql_query($sql) )
            {
                message_die(GENERAL_ERROR, "Couldn't obtain smilies data", "", __LINE__, __FILE__, $sql);
            }
            $smilies = $db->sql_fetchrowset($result);
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
            $cache->save('smilies', 'config', $smilies);
        }
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/

        if (count($smilies))
        {
            usort($smilies, 'smiley_sort');
        }

        for ($i = 0; $i < count($smilies); $i++)
        {
            $orig[] = "/(?<=.\W|\W.|^\W)" . preg_quote($smilies[$i]['code'], "/") . "(?=.\W|\W.|\W$)/";
            $repl[] = '<img src="'. $board_config['smilies_path'] . '/' . $smilies[$i]['smile_url'] . '" alt="' . $smilies[$i]['emoticon'] . '" border="0" title="' . $smilies[$i]['emoticon'] . '" />';
        }
    }

    if (count($orig))
    {
        $message = preg_replace($orig, $repl, ' ' . $message . ' ');
        $message = substr($message, 1, -1);
    }
    return $message;
}

function smiley_sort($a, $b)
{
    if ( strlen($a['code']) == strlen($b['code']) )
    {
        return 0;
    }
    return ( strlen($a['code']) > strlen($b['code']) ) ? -1 : 1;
}

/*****[BEGIN]******************************************
 [ Mod:     Force Word Wrapping               v1.0.16 ]
 ******************************************************/
function word_wrap_pass($message)
{
/*****[BEGIN]******************************************
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 ******************************************************/
    global $userdata, $board_config;

    //if ( !$board_config['wrap_enable'] )
    //{
        return $message;
    //}
/*****[END]********************************************
 [ Mod:    Force Word Wrapping - Configurator v1.0.16 ]
 ******************************************************/
    $tempText = '';
    $finalText = '';
    $curCount = $tempCount = 0;
    $longestAmp = 9;
    $inTag = false;
    $ampText = '';
    $len = strlen((string)$message);

    if(!isset($userdata['user_wordwrap']))
	$userdata['user_wordwrap'] = '';

    for ($num=0; $num < $len; $num++)
    {
        $curChar = $message[$num];

        if ($curChar == '<')
        {
            for ($snum=0;$snum < strlen((string) $ampText);$snum++)
            {
                addWrap($ampText[$snum],$ampText[$snum+1],$userdata['user_wordwrap'],$finalText,$tempText,$curCount,$tempCount);
            }
            $ampText = '';
            $tempText .= '<';
            $inTag = true;
        }
        elseif ($inTag && $curChar == '>')
        {
            $tempText .= '>';
            $inTag = false;
        }
        elseif ($inTag)
        {
            $tempText .= $curChar;
        }
        elseif ($curChar == '&')
        {
            for ($snum=0;$snum < strlen((string) $ampText);$snum++)
            {
                addWrap($ampText[$snum],$ampText[$snum+1],$userdata['user_wordwrap'],$finalText,$tempText,$curCount,$tempCount);
            }
            $ampText = '&';
        }
        elseif (strlen((string) $ampText) < $longestAmp && $curChar == ';' && function_exists('html_entity_decode') &&
               (strlen(html_entity_decode((string) "$ampText;")) == 1 || preg_match('#^&\#\d+$#',$ampText)))
         {
            addWrap($ampText.';',$message[$num+1],$userdata['user_wordwrap'],$finalText,$tempText,$curCount,$tempCount);
            $ampText = '';
        }
        elseif (strlen((string) $ampText) >= $longestAmp || $curChar == ';')
        {
            for ($snum=0;$snum < strlen((string) $ampText);$snum++)
            {
                addWrap($ampText[$snum],$ampText[$snum+1],$userdata['user_wordwrap'],$finalText,$tempText,$curCount,$tempCount);
            }
            addWrap($curChar,$message[$num+1],$userdata['user_wordwrap'],$finalText,$tempText,$curCount,$tempCount);
            $ampText = '';
        }
        elseif (strlen((string) $ampText) != 0 && strlen((string) $ampText) < $longestAmp)
        {
            $ampText .= $curChar;
        }
        else
        {
		   addWrap((string)$curChar,(string)$message[(int)$num+1],(int)$userdata['user_wordwrap'],$finalText,$tempText,$curCount,$tempCount);
		   
        }
    }

    return $finalText . $tempText;
}

function addWrap($curChar,$nextChar,$maxChars,&$finalText,&$tempText,&$curCount,&$tempCount) {
    $wrapProhibitedChars = "([{!;,.\\/:?}])";

    if ($curChar == ' ' || $curChar == "\n")
    {
        $finalText .= $tempText . $curChar;
        $tempText = '';
        $curCount = 0;
        $curChar = '';
    }
    //Removed to stop the stupid spaces in bad places
    /*elseif ($curCount >= $maxChars)
    {
        $finalText .= $tempText . ' ';
        $tempText = '';
        $curCount = 1;
    }*/
    else
    {
        $tempText .= $curChar;
        $curCount++;
    }

    // the following code takes care of (unicode) characters prohibiting non-mandatory breaks directly before them.

    // $curChar isn't a " " or "\n"
    if ($tempText != '' && $curChar != '')
    {
        $tempCount++;
    }
    // $curChar is " " or "\n", but $nextChar prohibits wrapping.
    elseif ( ($curCount == 1 && strstr($wrapProhibitedChars,$curChar) !== false) ||
             ($curCount == 0 && $nextChar != '' && $nextChar != ' ' && $nextChar != "\n" && strstr($wrapProhibitedChars,$nextChar) !== false))
    {
        $tempCount++;
    }
    // $curChar and $nextChar aren't both either " " or "\n"
    elseif (!($curCount == 0 && ($nextChar == ' ' || $nextChar == "\n")))
    {
        $tempCount = 0;
    }

    if ($tempCount >= $maxChars && $tempText == '')
    {
        $finalText .= '&nbsp;';
        $tempCount = 1;
        $curCount = 2;
    }

    if ($tempText == ''  && $curCount > 0)
    {
        $finalText .= $curChar;
    }
}
/*****[END]********************************************
 [ Mod:     Force Word Wrapping               v1.0.16 ]
 ******************************************************/

if(!function_exists('get_code_lang'))
{
    function get_code_lang($var, $array) 
    {
        return ($array[$var] != '') ? $array[$var] : $var;
    }
}

