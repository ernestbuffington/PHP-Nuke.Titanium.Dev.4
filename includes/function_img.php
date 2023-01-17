<?php
/*=======================================================================
            PHP-Nuke Titanium (CMS) Enhanced And Advanced
  =======================================================================*/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}
// this needs to be fixed and is not being used
// avatar_resize function by JeFFb68CAM (based off phpBB mod)
// recoded & removed cache-function and added static variable (ReOrGaNiSaTiOn)
function avatar_resize($avatar_url) 
{
    global $board_config;
    static $loaded_avatars;
    
	//$avatar_url = str_replace('.','',$avatar_url); # remove the dot from the end of the string if needed

	if(!isset($loaded_avatars[$avatar_url])) 
	{
        $loaded_avatars[$avatar_url] = array();
    
	    list($avatar_width, $avatar_height) = getimagesize($avatar_url);
	    
		if ($avatar_width > $board_config['avatar_max_width'] && $avatar_height <= $board_config['avatar_max_height']) {
            $cons_width  = $board_config['avatar_max_width'];
            $cons_height = round((($board_config['avatar_max_width'] * $avatar_height) / $avatar_width), 0);
        }
        elseif($avatar_width <= $board_config['avatar_max_width'] && $avatar_height > $board_config['avatar_max_height']) {
            $cons_width  = round((($board_config['avatar_max_height'] * $avatar_width) / $avatar_height), 0);
            $cons_height = $board_config['avatar_max_height'];
        }
        elseif($avatar_width > $board_config['avatar_max_width'] && $avatar_height > $board_config['avatar_max_height']) {
            if($avatar_width >= $avatar_height) {
                $cons_width = $board_config['avatar_max_width'];
                $cons_height = round((($board_config['avatar_max_width'] * $avatar_height) / $avatar_width), 0);
            }
            elseif($avatar_width < $avatar_height) {
                $cons_width = round((($board_config['avatar_max_height'] * $avatar_width) / $avatar_height), 0);
                $cons_height = $board_config['avatar_max_height'];
            }
        }
         $loaded_avatars[$avatar_url] = '<img src="' . $avatar_url . '" width="' . isset($cons_width) . '" height="' . isset($cons_height) . '" alt="" border="0" />';
    }
    return $loaded_avatars[$avatar_url];
}

// select_gallery function by ReOrGaNiSaTiOn
// not currently being used anywhere at all
function select_gallery($name='default', $gallery='', $img_show = FALSE, $selected='') 
{
    if (empty($gallery)) {
        $select = '<select class="set" name="'.$name.'" id="'.$name."\">\n";
        $select .= "<option value=\"".FALSE."\" >"._NONE."</option>\n";
        return $select.'</select>';
    }
    if ( substr($gallery, 0, 1) == '/' ) {
        $gallery = substr($gallery, 1);
    }
    if ( substr($gallery, -1) == '/' ) {
        $gallery = substr($gallery, 0, strlen($gallery) -1);
    }
    $dir = NUKE_BASE_DIR . $gallery;
    $href_dir = NUKE_HREF_BASE_DIR . $gallery;
    if (is_dir($dir)) {
        if (!defined('GALLERY_JAVASCRIPT') && ($img_show == TRUE)) {
            $select = '<script>
                        <!--
                        function update_gallery(newimage)
                        {
                            document.gallery_image.src = newimage;
                        }
                        //-->
                        </script>';
            define('GALLERY_JAVASCRIPT', TRUE);
        }
        $opendir = opendir($gallery);
        if ( $img_show == TRUE ) {
            $select .= '<select class="set" name="'.$name.'" id="'.$name."\" onchange=\"update_gallery(this.options[selectedIndex].value);\">\n";
        } else {
            $select .= '<select class="set" name="'.$name.'" id="'.$name."\">\n";
        }
        if ( empty($selected)) {
            $select .= "<option value=\"". NUKE_IMAGES_BASE_DIR . "evo/spacer.gif\" selected=\"selected\">"._NONE."</option>\n";
        } else {
            $select .= "<option value=\"". NUKE_IMAGES_BASE_DIR . "evo/spacer.gif\" >"._NONE."</option>\n";
        }
        while (false !== ($entry = readdir($opendir))) {
            if( preg_match('/(\.gif$|\.png$|\.jpg|\.jpeg)$/is', $entry)) {
                if( $entry != '.' && $entry != '..' && is_file($dir . '/' . $entry) && !is_link($dir . '/' . $entry) ) {
                    $extension = substr($entry, strrpos($entry, '.'));
                    if ($selected == "$href_dir/$entry") {
                        $select .= "<option value=\"" . $href_dir . "/" .$entry."\" selected=\"selected\">".str_replace($extension, '', $entry)."</option>\n";
                    } else {
                        $select .= "<option value=\"" . $href_dir . "/" .$entry."\" >".str_replace($extension, '', $entry)."</option>\n";
                    }
                }
            }
        }
        closedir($dir);
    } else {
        $select = '<select class="set" name="'.$name.'" id="'.$name."\">\n";
        $select .= "<option value=\"".FALSE."\" >"._NONE."</option>\n";
    }
    if ( $img_show == TRUE ) {
        return $select.'</select>&nbsp;<img name="gallery_image" src="'.NUKE_IMAGES_BASE_DIR . 'evo/spacer.gif" border="0" alt="" />';
    } else {
        return $select.'</select>';
    }
}

// not currently used anywhere
// help_img function by ReOrGaNiSaTiOn
// based on various codefragments from Internet
function help_img_old($helptext) 
{
    global $bgcolor1, $bgcolor2, $textcolor1, $textcolor2;
    return "<a href=\"javascript:void(0);\" onclick=\"return overlib('".addslashes($helptext)."', STICKY, CAPTION, 'Help System', STATUS, 'Help System', WIDTH, 400, FGCOLOR, '".$bgcolor1."', BGCOLOR, '".$bgcolor2."', TEXTCOLOR, '".$textcolor1."', CAPCOLOR, '".$textcolor2."', CLOSECOLOR, '".$textcolor2."', CAPICON, 'images/evo/helpicon.png', BORDER, '2');\"><img src='images/evo/helpicon.png' border='0' height='12' width='12' alt='' title='' /></a>";
}

// used only in Blogs / Blogs Admin / Site Messages
function img_tag_to_resize($text) 
{
    global $img_resize;
    if(!$img_resize) return $text;
    if(empty($text)) return $text;
    if(preg_match('/<NO RESIZE>/',$text)) {
        $text = str_replace('<NO RESIZE>', '', $text);
        return $text;
    }
    $text = preg_replace('/<\s*?img/',"<div class=\"reimg-loading\"></div><img class=\"reimg\" onload=\"reimg(this);\" onerror=\"reimg(this);\" ",$text);
    return $text;
}

// img_make_tag function by ReOrGaNiSaTiOn
function img_make_tag($imgname, $mymodule_name, $mytitle='', $myborder=0, $myname='', $resize=FALSE , $mywidth='100%', $myheight='100%') 
{
    $temp_alttext = explode('.', $imgname);
    $temp_image = img($imgname, $mymodule_name);
    if (!empty($temp_image)) {
        $imgfile = '<img src="'.$temp_image.'" width="'.$mywidth.'" height="'.$myheight.'" border="'.$myborder.'" title="'.$mytitle.'" name="'.$myname.'" alt="" />';
        if ( $resize ) 
		{
            $imgfile = img_tag_to_resize($imgfile);
        }
        return $imgfile;
    }
    return '';
}

/**
 * @horndonkle image cache v1.1
 * @author Ernest Allen Buffington
 * @date 1/13/2023 10:32 pm
 * @not to be confused with cornsponkle
 * @only search through the directory structure once!
 * @ToDo: width and height theme images should be static and pre-cached as well
 *        not all images used in a theme are at their original width and height!
 */
function img($imgfile='', $mymodule='') {
	global $currentlang, $ThemeSel, $Default_Theme, $cache;
	$cache_imgfile = [0];
	$tmp_imgfile = explode('.', (string) $imgfile);
	$cache_imgfile = $tmp_imgfile[0];
	static $cached_image;
	$horndonkle = md5($imgfile.$ThemeSel); //maybe I should call this HornDonkleCrypt (just kidding, you know I love ya Technocrat)
  if(!($cached_image = $cache->load($mymodule,'titanium_horndonkle_image_'. $horndonkle))):
	if (file_exists(NUKE_THEMES_DIR . $ThemeSel . '/images/' . $mymodule . '/lang_' . $currentlang . '/' . $imgfile)):
	  $cached_image[$ThemeSel][$currentlang][$cache_imgfile] = "themes/".$ThemeSel."/images/$mymodule/lang_".$currentlang."/$imgfile";
	elseif (file_exists(NUKE_THEMES_DIR . $ThemeSel . '/images/lang_' . $currentlang . '/' . $imgfile)):
	  $cached_image[$ThemeSel][$currentlang][$cache_imgfile] = "themes/".$ThemeSel."/images/lang_".$currentlang."/$imgfile";
	elseif (file_exists(NUKE_THEMES_DIR . $ThemeSel . '/images/' . $mymodule . '/' . $imgfile)):
	  $cached_image[$ThemeSel][$currentlang][$cache_imgfile] = "themes/".$ThemeSel."/images/$mymodule/$imgfile";
	elseif (file_exists(NUKE_THEMES_DIR . $ThemeSel . '/images/' . $imgfile)):
	  $cached_image[$ThemeSel][$currentlang][$cache_imgfile] = "themes/".$ThemeSel."/images/$imgfile";
	elseif (file_exists(NUKE_THEMES_DIR . $Default_Theme . '/images/' . $mymodule . '/lang_' . $currentlang . '/' . $imgfile)):
	  $cached_image[$ThemeSel][$currentlang][$cache_imgfile] = "themes/".$Default_Theme."/images/$mymodule/lang_".$currentlang."/$imgfile";
	elseif (file_exists(NUKE_THEMES_DIR . $Default_Theme . '/images/lang_' . $currentlang . '/' . $imgfile)):
	  $cached_image[$ThemeSel][$currentlang][$cache_imgfile] = "themes/".$Default_Theme."/images/lang_".$currentlang."/$imgfile";
	elseif (file_exists(NUKE_THEMES_DIR . $Default_Theme . '/images/' . $mymodule . '/' . $imgfile)):
	  $cached_image[$ThemeSel][$currentlang][$cache_imgfile] = "themes/".$Default_Theme."/images/$mymodule/$imgfile";
	elseif (file_exists(NUKE_THEMES_DIR . $Default_Theme . '/images/' . $imgfile)):
	  $cached_image[$ThemeSel][$currentlang][$cache_imgfile] = "themes/".$Default_Theme."/images/$imgfile";
	elseif (file_exists(NUKE_MODULES_DIR . $mymodule . '/images/lang_' . $currentlang . '/' . $imgfile)):
	  $cached_image[$ThemeSel][$currentlang][$cache_imgfile] = "modules/".$mymodule."/images/lang_".$currentlang."/$imgfile";
	elseif (file_exists(NUKE_MODULES_DIR . $mymodule . '/images/avatars/' . $imgfile)):
	  $cached_image[$ThemeSel][$currentlang][$cache_imgfile] =  "modules/".$mymodule."/images/avatars/$imgfile";
	elseif (file_exists(NUKE_MODULES_DIR . $mymodule . '/images/' . $imgfile)):
	  $cached_image[$ThemeSel][$currentlang][$cache_imgfile] =  "modules/".$mymodule."/images/$imgfile";
	elseif (file_exists(NUKE_IMAGES_DIR . $mymodule . '/' . $imgfile)):
	  $cached_image[$ThemeSel][$currentlang][$cache_imgfile] = "images/".$mymodule."/$imgfile";
	elseif (file_exists(NUKE_IMAGES_DIR . $imgfile)):
	  $cached_image[$ThemeSel][$currentlang][$cache_imgfile] = "images/$imgfile";
	else:
		echo "( Image File: ".NUKE_MODULES_DIR.$mymodule.'/images/'.$imgfile." ) not found!</br>";
	    log_write('error', "( ".NUKE_MODULES_DIR.$mymodule.'/images/'.$imgfile." ) not found!", 'Module Image Not Found Error');
		$cached_image[$ThemeSel][$currentlang][$cache_imgfile] = '';
	endif;
	$cache->save($mymodule, 'titanium_horndonkle_image_'.$horndonkle, $cached_image);
	return($cached_image[$ThemeSel][$currentlang][$cache_imgfile]);
  else:	
	return ($cached_image[$ThemeSel][$currentlang][$cache_imgfile]);
  endif;
}
