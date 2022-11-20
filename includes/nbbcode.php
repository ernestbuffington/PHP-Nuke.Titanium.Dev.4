<?php

/*********************************************
  CPG Dragonfly™ CMS
  ********************************************
  Copyright (c) 2004 - 2006 by CPG-Nuke Dev Team
  http://dragonflycms.org

  Dragonfly is released under the terms and conditions
  of the GNU GPL version 2 or any later version
  
  $Revision: 9.25 $
  $Author: djmaze $
**********************************************/

/*
    This was orginally derived from DragonFly CMS/CPG Nuke
    but was modified to work with nuke by other coders that 
    removed the copyright information and distributed it
    on other sites.
*/

/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/*****[CHANGES]**********************************************************
-=[Base]=-
      Caching System                           v1.0.0       10/29/2005
 ************************************************************************/

if (!defined('NUKE_EVO')) {
    die("You can't access this file directly...");
}

global $db, $prefix, $smilies_path, $bbbttns_path, $bb_codes, $smilies_close, $bbcode_common, $currentlang, $nukeurl;

if(file_exists(NUKE_LANGUAGE_DIR.'bbcode/lang-'.$currentlang.'.php')) {
    include_once(NUKE_LANGUAGE_DIR.'bbcode/lang-'.$currentlang.'.php');
} else {
    include_once(NUKE_LANGUAGE_DIR.'bbcode/lang-english.php');
}

require_once(NUKE_CLASSES_DIR.'class.nbbcode.php');

$ThemeSel = get_theme();

if (file_exists('themes/'.$ThemeSel.'/bbcode.inc')) {
    include('themes/'.$ThemeSel.'/bbcode.inc');
}

function get_codelang($var, $array) {
    return (isset($array[$var])) ? $array[$var] : $var;
}

function smilies_table($mode, $field='message', $form='post')
{
    global $board_config;
    $smilies = '';
    $smilies = get_smilies();

    $smilies_row  = '<table style="width: 100%" border="0" cellspacing="0" cellpadding="0">';
    $smilies_row .= '  <tr>';
    $smilies_row .= '    <td>';

    if (is_array($smilies)):

        $num_smilies = 0;
        $rowset = array();
        for ($i=0; $i<count($smilies); ++$i):
        
            if (empty($rowset[$smilies[$i]['smile_url']])):
        
                $rowset[$smilies[$i]['smile_url']]['code'] = str_replace("'", "\\'", str_replace('\\', '\\\\', $smilies[$i]['code']));
                // $rowset[$smilies[$i]['smile_url']]['emoticon'] = get_codelang($smilies[$i]['emoticon'],$smilies_desc);
                $rowset[$smilies[$i]['smile_url']]['emoticon'] = $smilies[$i]['emoticon'];
                $num_smilies++;

            endif;

        endfor;

        if ($num_smilies):

            foreach( $rowset as $smile_url => $data ):
                $smilies_row .= '<img class="forum-emoticon" data-id="'.$data['code'].'" data-field="'.$field.'" src="'.$board_config['smilies_path'].'/'.$smile_url.'" border="0" alt="'.$data['emoticon'].'" title="'.$data['emoticon'].'" />&nbsp;';
            endforeach;

        endif;

    endif;
    $smilies_row .= '    <td>';
    $smilies_row .= '  </tr>';
    $smilies_row .= '</table>';

    return $smilies_row;

}

// bbcode table
if(!function_exists('bbcode_table'))
{
    function bbcode_table($field='message', $form='post', $allowed=0)
    {
        global $currentlang;
        if (file_exists(NUKE_LANGUAGE_DIR.'bbcode/lang-'.$currentlang.'.php')) 
            include(NUKE_LANGUAGE_DIR.'bbcode/lang-'.$currentlang.'.php');
        else 
            include(NUKE_LANGUAGE_DIR.'bbcode/lang-english.php');

        $bbcode_table  = '<link rel="stylesheet" href="includes/css/bbcode.css?v=1.0" type="text/css">';

        // jquery.bbcode
        // addCSSToHead(NUKE_CSS_DIR.'bbcode.css?v=1.0','file');
        $JStoBody  = '<script>'.PHP_EOL;
        $JStoBody .= '  var emailError      = "'.$bbcode_help['emailError'].'";';
        $JStoBody .= '  var imageError      = "'.$bbcode_help['imageError'].'";';
        $JStoBody .= '  var imageLabel      = "'.$bbcode_help['imageLabel'].'";';
        $JStoBody .= '  var imageInline     = "'.$bbcode_help['imageInline'].'";';
        $JStoBody .= '  var imageNewline    = "'.$bbcode_help['imageNewline'].'";';
        $JStoBody .= '  var imageLocation   = "'.$bbcode_help['imageLocation'].'";';
        $JStoBody .= '  var imageTitle      = "'.$bbcode_help['imageTitle'].'";';
        $JStoBody .= '  var urlLabel        = "'.$bbcode_help['urlLabel'].'";';
        $JStoBody .= '  var urlError        = "'.$bbcode_help['urlError'].'";';
        $JStoBody .= '  var videoLabel      = "'.$bbcode_help['videoLabel'].'";';
        $JStoBody .= '  var videoFacebook   = "'.$bbcode_help['videoFacebook'].'";';
        $JStoBody .= '  var videoYoutube    = "'.$bbcode_help['videoYoutube'].'";';
        $JStoBody .= '  var videoTwitch     = "'.$bbcode_help['videoTwitch'].'";';
        $JStoBody .= '  var videoType       = "'.$bbcode_help['videoType'].'";';
        $JStoBody .= '  var videoError      = "'.$bbcode_help['videoError'].'";';
        $JStoBody .= '  var emailLabel      = "'.$bbcode_help['emailLabel'].'";';
        $JStoBody .= '  var message_help    = "'.$bbcode_help['default'].'";';
        $JStoBody .= '  var must_select     = "'.$bbcode_help['must_select'].'";';
        $JStoBody .= '  var font_family     = "'.$bbcode_help['font_family'].'";';
        $JStoBody .= '  var fontsize        = "'.$bbcode_help['fontsize'].'";';
        $JStoBody .= '  var desc_label      = "'.$bbcode_help['description_optional'].'";';
        $JStoBody .= '  var buttonCancel    = "'.$bbcode_help['buttonCancel'].'";';
        $JStoBody .= '</script>'.PHP_EOL;
        addJSToBody($JStoBody,'inline');
        addJSToBody(NUKE_JQUERY_SCRIPTS_DIR.'bbcode/jquery.bbcode.js','file');

        # basic bccode buttons
        $bbcode_table .= '      <i class="bbcode bbc-bold bbcbutton" data-field="'.$field.'" data-form="'.$form.'" data-bbcode="b" data-name="bold" data-helpline="'.$bbcode_help['bold'].'"></i>';
        $bbcode_table .= '      <i class="bbcode bbc-italic bbcbutton" data-field="'.$field.'" data-form="'.$form.'" data-bbcode="i" data-name="italic" data-helpline="'.$bbcode_help['italic'].'"></i>';
        $bbcode_table .= '      <i class="bbcode bbc-underline bbcbutton" data-field="'.$field.'" data-form="'.$form.'" data-bbcode="u" data-name="underline" data-helpline="'.$bbcode_help['underline'].'"></i>';
        $bbcode_table .= '      <i class="bbcode bbc-strike bbcbutton" data-field="'.$field.'" data-form="'.$form.'" data-bbcode="s" data-name="strike" data-helpline="'.$bbcode_help['strike'].'"></i>&nbsp;';
        $bbcode_table .= '      <i class="bbcode bbc-left bbcalignment" data-field="'.$field.'" data-form="'.$form.'" data-bbcode="left" data-type="align" data-helpline="'.$bbcode_help['left'].'"></i>';
        $bbcode_table .= '      <i class="bbcode bbc-center bbcalignment" data-field="'.$field.'" data-form="'.$form.'" data-bbcode="center" data-type="align" data-helpline="'.$bbcode_help['center'].'"></i>';
        $bbcode_table .= '      <i class="bbcode bbc-right bbcalignment" data-field="'.$field.'" data-form="'.$form.'" data-bbcode="right" data-type="align" data-helpline="'.$bbcode_help['right'].'"></i>';
        $bbcode_table .= '      <i class="bbcode bbc-justify bbcalignment" data-field="'.$field.'" data-form="'.$form.'" data-bbcode="justify" data-type="align" data-helpline="'.$bbcode_help['justify'].'"></i>&nbsp;';
        $bbcode_table .= '      <i class="bbcode bbc-font bbcfont" data-field="'.$field.'" data-form="'.$form.'" data-helpline="'.$bbcode_help['fonttype'].'"></i>';

        $bbcode_table .= '      <i class="bbcode bbc-font-size bbcfontsize" data-field="'.$field.'" data-form="'.$form.'" data-helpline="'.$bbcode_help['fontsize'].'"></i>';

        $bbcode_table .= '      <i class="bbcode bbc-color bbccolor" data-field="'.$field.'" data-form="'.$form.'" data-helpline="'.$bbcode_help['fontcolor'].'"></i>';
        $bbcode_table .= '      <i class="bbcode bbc-highlight bbchighlight" data-field="'.$field.'" data-form="'.$form.'" data-helpline="'.$bbcode_help['highlight'].'"></i>&nbsp;';
        $bbcode_table .= '      <i class="bbcode bbc-hr bcchorizontalrule" data-field="'.$field.'" data-form="'.$form.'" data-helpline="'.$bbcode_help['horizontalrule'].'"></i>';
        $bbcode_table .= '      <i class="bbcode bbc-img bbcpopup" data-field="'.$field.'" data-form="'.$form.'" data-name="img" data-helpline="'.$bbcode_help['image'].'"></i>';
        $bbcode_table .= '      <i class="bbcode bbc-email bbcpopup" data-field="'.$field.'" data-form="'.$form.'" data-name="email" data-helpline="'.$bbcode_help['email'].'"></i>';
        $bbcode_table .= '      <i class="bbcode bbc-url bbcpopup" data-field="'.$field.'" data-form="'.$form.'" data-name="url" data-helpline="'.$bbcode_help['url'].'"></i>';
        $bbcode_table .= '      <i class="bbcode bbc-video bbcvideo" data-field="'.$field.'" data-form="'.$form.'" data-helpline="'.$bbcode_help['video'].'"></i>';
        # smilies table
        // $bbcode_table .= '      <i class="bbcode bbcsmilies bbc-smilies" data-field="'.$field.'" data-form="'.$form.'"></i>';
        $bbcode_table .= '&nbsp;';
        $bbcode_table .= '      <i class="bbcode bbc-list" data-field="'.$field.'" data-form="'.$form.'" data-bbcode="list" data-name="list" data-helpline="'.$bbcode_help['bulletList'].'"></i>';
        $bbcode_table .= '      <i class="bbcode bbc-ordered-list" data-field="'.$field.'" data-form="'.$form.'" data-bbcode="list" data-name="list=1" data-helpline="'.$bbcode_help['orderedList'].'"></i>&nbsp;';
        $bbcode_table .= '      <i class="bbcode bbc-code bbcbutton" data-field="'.$field.'" data-form="'.$form.'" data-bbcode="code" data-name="code" data-helpline="'.$bbcode_help['code'].'"></i>';
        $bbcode_table .= '      <i class="bbcode bbc-quote bbcbutton" data-field="'.$field.'" data-form="'.$form.'" data-bbcode="quote" data-name="quote" data-helpline="'.$bbcode_help['quote'].'"></i>';
        $bbcode_table .= '      <i class="bbcode bbc-php bbcbutton" data-field="'.$field.'" data-form="'.$form.'" data-bbcode="php" data-name="php" data-helpline="'.$bbcode_help['php'].'"></i>';
        $bbcode_table .= '      <i class="bbcode bbc-spoil bbcbutton" data-field="'.$field.'" data-form="'.$form.'" data-bbcode="spoil" data-name="spoil" data-helpline="'.$bbcode_help['spoil'].'"></i>';
        return $bbcode_table;
    }
}

function get_smilies() {
   global $db, $prefix, $cache;
   static $smilies;
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    if(($smilies = $cache->load('smilies', 'config')) === false) {
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
        $smilies = $db->sql_ufetchrowset('SELECT * FROM '.$prefix.'_bbsmilies');
        if(count($smilies))
        {
            usort($smilies, 'sort_smiley');
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
            $cache->save('smilies', 'config', $smilies);
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
        }
    }
    return $smilies;
}

function set_smilies($message, $url='') 
{
    static $orig, $repl;

    if (!isset($orig)) 
	{
        global $smilies_path, $smilies_desc, $nukeurl;
    
	    $orig = $repl = array();
        $smilies = get_smilies();
        $url = (empty($url)) ? $nukeurl : $url;
    
	    if (!empty($url) && substr($url, -1) != '/') 
		{ 
		  $url .= '/modules/Forums/images/smiles/'; # this had only a forward slash / and was not displaying the smilies on the main page correctly.
		                                            # TheGhost fixed this 03/19/2021 at 5:55pm
		}
        
		for ($i = 0; $i < count($smilies); $i++) 
		{
            $smilies[$i]['code'] = str_replace('#', '\#', preg_quote($smilies[$i]['code']));
            $orig[] = "#([\s])".$smilies[$i]['code']."([\s<])#si";
            $repl[] = '\\1<img src="' . $url . $smilies_path . $smilies[$i]['smile_url'] . '" alt="'.get_codelang($smilies[$i]['emoticon'],$smilies_desc).'" title="'.get_codelang($smilies[$i]['emoticon'],$smilies_desc).'" border="0" />\\2';
        }
    }
    
	if (count($orig)) 
	{
        $message = preg_replace($orig, $repl, " $message ");
        $message = substr($message, 1, -1);
    }
    return $message;
}

function sort_smiley($a, $b)
{
    if (strlen($a['code']) == strlen($b['code'])) { return 0; }
    return (strlen($a['code']) > strlen($b['code'])) ? -1 : 1;
}

# bbencode_first_pass() prepare bbcode for db insert
function encode_bbcode($text)
{
    return BBCode::encode($text);
}
function decode_bb_all($text, $allowed=0, $allow_html=false, $url='') {
    return set_smilies(decode_bbcode($text, $allowed, $allow_html), $url);
}
function decode_bbcode($text, $allowed=0, $allow_html=false)
{
    return BBCode::decode($text, $allowed, $allow_html);
}

function shrink_url($url) {
    $url = preg_replace("#(^[\w]+?://)#", '', $url);
    return (strlen($url) > 35) ? substr($url,0,22).'...'.substr($url,-10) : $url;
}

function makeclickable($text)
{
    $ret = ' ' . $text;
    $ret = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t<]*)#ise", "'\\1<a href=\"\\2\" rel=\"nofollow\" title=\"\\2\" target=\"_blank\">'.shrink_url('\\2').'</a>'", $ret);
    $ret = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r<]*)#ise", "'\\1<a href=\"http://\\2\" rel=\"nofollow\" target=\"_blank\" title=\"\\2\">'.shrink_url('\\2').'</a>'", $ret);
    $ret = preg_replace("#(^|[\n ])([a-z0-9&\-_\.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i", "\\1 \\2 &#64; \\3", $ret);
    $ret = substr($ret, 1);
    return($ret);
}

function htmlprepare($str, $nl2br=false, $spchar=ENT_QUOTES, $nohtml=false) 
{
    if ($nohtml) 
	$str = strip_tags($str, $nohtml); 
	
	# $nohtml : <a><br><strong><i><img><li><ol><p><strong><u><ul>
	# htmlentities sucks cos it converts all chars <- not TheGhost's opinion becuase it does what it is written to do.
	
    $str = htmlspecialchars($str,$spchar,'utf-8');     
    
	if ($nl2br) 
    $str = nl2br($str); 

    return trim($str);
}

function htmlunprepare($str, $nl2br=false) {
    $unhtml_specialchars_match = array('#&gt;#', '#&lt;#', '#&quot;#', '#&\#039;#', '#&amp;#');
    $unhtml_specialchars_replace = array('>', '<', '"', '\'', '&');
    if ($nl2br) {
        $unhtml_specialchars_match[] = "#<br />\n#";
        $unhtml_specialchars_replace[] = "\n";
    }
    return preg_replace($unhtml_specialchars_match, $unhtml_specialchars_replace, $str);
}

function html2bb($text) 
{
    $text = preg_replace('/</', ' <', $text);
    $text = preg_replace('/<ol type="([a1])">/si', '/\[list=\\1\]', $text);
    $text = preg_replace('/<(b|u|i|hr)>/sie', "'['.strtolower(\\1).']'", $text);
    $text = preg_replace('/<\/(b|u|i|hr)>/sie', "'[/'.strtolower(\\1).']'", $text);
    $text = preg_replace('#<img(.*?)src="(.*?)\.(gif|png|jpg|jpeg)"(.*?)>#si', '[img]\\2.\\3[/img]', $text);

    $text = str_replace('<ul>', '[list]', $text);
    $text = str_replace('<li>', '[*]', $text);
    $text = str_replace('</ul>', '[/list:u]', $text);
    $text = str_replace('</ol>', '[/list:o]', $text);
    $text = strip_tags($text, '<br><p><strong>');
    return trim($text);
}

# prepare_message(
function message_prepare($message, $html_on, $bbcode_on)
{
    global $board_config;
    #
    # Clean up the message
    #
    $message = trim($message);
    if ($html_on) 
    {
        $allowed_html_tags = split(',', $board_config['allow_html_tags']);
        $end_html = 0;
        $start_html = 1;
        $tmp_message = '';
        $message = ' ' . $message . ' ';
        while ($start_html = strpos($message, '<', $start_html)) {
            $tmp_message .= BBCode::encode_html(substr($message, $end_html + 1, ($start_html - $end_html - 1)));
            if ($end_html = strpos($message, '>', $start_html)) {
                $length = $end_html - $start_html + 1;
                $hold_string = substr($message, $start_html, $length);
                if (($unclosed_open = strrpos(' ' . $hold_string, '<')) != 1) {
                    $tmp_message .= BBCode::encode_html(substr($hold_string, 0, $unclosed_open - 1));
                    $hold_string = substr($hold_string, $unclosed_open - 1);
                }
                $tagallowed = false;
                for ($i = 0; $i < count($allowed_html_tags); $i++) {
                    $match_tag = trim($allowed_html_tags[$i]);
                    if (preg_match('#^<\/?' . $match_tag . '[> ]#i', $hold_string)) {
                        $tagallowed = (preg_match('#^<\/?' . $match_tag . ' .*?(style[ ]*?=|on[\w]+[ ]*?=)#i', $hold_string)) ? false : true;
                    }
                }
                $tmp_message .= ($length && !$tagallowed) ? BBCode::encode_html($hold_string) : $hold_string;
                $start_html += $length;
            } else {
                $tmp_message .= BBCode::encode_html(substr($message, $start_html));
                $start_html = strlen($message);
                $end_html = $start_html;
            }
        }
        if ($end_html != strlen($message) && $tmp_message != '') {
            $tmp_message .= BBCode::encode_html(substr($message, $end_html + 1));
        }
        $message = ($tmp_message != '') ? trim($tmp_message) : trim($message);
    } else {
        $message = BBCode::encode_html($message);
    }
    if ($bbcode_on) {
        $message = BBCode::encode($message);
    }
    return $message;
}

?>