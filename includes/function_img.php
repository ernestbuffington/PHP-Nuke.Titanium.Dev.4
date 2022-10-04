<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/***************************************************************************
 *                                index.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: index.php,v 1.99.2.3 2004/07/11 16:46:15 acydburn Exp
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
-=[Mod]=-
	  Forum Icon Path Mod                      v1.0.0       09/26/2022
	  Images Mod                               v1.0.0       09/26/2022
 ************************************************************************/
 
 if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

############################################################################################################################################
# Forum Icon Path Mod - 09/26/2022 by Ernest Buffington - START                                                                            #       
############################################################################################################################################
function forum_icon_img_path($imgfile='', $mymodule='', $empty=true) 
{
    global $phpbb2_icon, $currentlang, $ThemeSel, $Default_Theme, $ImageDebug;
	
	$forum_theme_icons_found = false;
	
	# If file is found use themes/theme_name/images/forum_icons path!
	if (@file_exists(TITANIUM_THEMES_DIR . $ThemeSel . '/forums/images/forum_icons/'.$imgfile)) 
	{
        $pnt_image = TITANIUM_THEMES_IMAGE_DIR.$ThemeSel."/$imgfile"; 
		$forum_theme_icons_found = true;
    } 
	else # if we do not find any images under the theme directory use the Forums system default forum_icons dir!
	if (@file_exists(TITANIUM_MODULES_DIR . $mymodule . '/images/forum_icons/'.$imgfile)) 
	{
		if($forum_theme_icons_found)
		return;
		
        $pnt_image = TITANIUM_MODULES_IMAGE_DIR. $mymodule ."/images/forum_icons/$imgfile";

    } 
	else # if we dont find shit write it to the error log
	{

    }
	
	return($pnt_image);
}
############################################################################################################################################
# Forum Icon Path Mod - 09/26/2022 by Ernest Buffington - END                                                                              #       
############################################################################################################################################


############################################################################################################################################
# Image Mod - Start  01/01/2012                                                                                                            #       
############################################################################################################################################
function img($imgfile='', $mymodule='', $empty=true) 
{
    global $phpbb2_icon, $currentlang, $ThemeSel, $Default_Theme, $ImageDebug;
	
	$ImageDebug = false;
	$forum_theme_icons_found = false;
	
    # not sure what we are doing here?
	if (@file_exists(TITANIUM_THEMES_DIR . $ThemeSel . '/images/' . $mymodule . '/lang_' . $currentlang . '/' . $imgfile)) 
	{
        $pnt_image = TITANIUM_THEMES_IMAGE_DIR.$ThemeSel."/images/$mymodule/lang_".$currentlang."/$imgfile";
		if($ImageDebug)
        echo '<div align="center"><font color="red"><strong>FOUND:</strong> '.$pnt_image.'</font></div>';
    } 
	else # check for images in the themes languages directory!
	if (@file_exists(TITANIUM_THEMES_DIR . $ThemeSel . '/images/lang_' . $currentlang . '/' . $imgfile)) 
	{
        $pnt_image = TITANIUM_THEMES_IMAGE_DIR.$ThemeSel."/images/lang_".$currentlang."/$imgfile";
		if($ImageDebug)
        echo '<div align="center"><font color="red"><strong>FOUND:</strong> '.$pnt_image.'</font></div>';
    } 
	else # looks like its lookin for a folder named after the module in the imaages area!
	if (@file_exists(TITANIUM_THEMES_DIR . $ThemeSel . '/images/' . $mymodule . '/' . $imgfile)) 
	{
        $pnt_image = TITANIUM_THEMES_IMAGE_DIR.$ThemeSel."/images/$mymodule/$imgfile";
		if($ImageDebug)
        echo '<div align="center"><font color="red"><strong>FOUND:</strong> '.$pnt_image.'</font></div>';
    } 
	else
	if (@file_exists(TITANIUM_THEMES_DIR . $ThemeSel . '/images/' . $imgfile)) 
	{
        $pnt_image = TITANIUM_THEMES_IMAGE_DIR.$ThemeSel."/images/$imgfile";
		if($ImageDebug)
        echo '<div align="center"><font color="red"><strong>FOUND:</strong> '.$pnt_image.'</font></div>';
    } 
	else
	if (@file_exists(TITANIUM_THEMES_DIR . $Default_Theme . '/images/' . $mymodule . '/lang_' . $currentlang . '/' . $imgfile)) 
	{
        $pnt_image = TITANIUM_THEMES_IMAGE_DIR.$Default_Theme."/images/$mymodule/lang_".$currentlang."/$imgfile";
		if($ImageDebug)
        echo '<div align="center"><font color="red"><strong>FOUND:</strong> '.$pnt_image.'</font></div>';
    } 
	else
	if (@file_exists(TITANIUM_THEMES_DIR . $Default_Theme . '/images/lang_' . $currentlang . '/' . $imgfile)) 
	{
        $pnt_image = TITANIUM_THEMES_IMAGE_DIR.$Default_Theme."/images/lang_".$currentlang."/$imgfile";
		if($ImageDebug)
        echo '<div align="center"><font color="red"><strong>FOUND:</strong> '.$pnt_image.'</font></div>';
    } 
	else
	if (@file_exists(TITANIUM_THEMES_DIR . $Default_Theme . '/images/' . $mymodule . '/' . $imgfile)) 
	{
        $pnt_image = TITANIUM_THEMES_IMAGE_DIR.$Default_Theme."/images/$mymodule/$imgfile";
		if($ImageDebug)
        echo '<div align="center"><font color="red"><strong>FOUND:</strong> '.$pnt_image.'</font></div>';
    } 
	else
	if (@file_exists(TITANIUM_THEMES_DIR . $Default_Theme . '/images/' . $imgfile)) 
	{
        $pnt_image = TITANIUM_THEMES_IMAGE_DIR.$Default_Theme."/images/$imgfile";
		if($ImageDebug)
        echo '<div align="center"><font color="red"><strong>FOUND:</strong> '.$pnt_image.'</font></div>';
    } 
	else
	if (@file_exists(TITANIUM_MODULES_DIR . $mymodule . '/images/lang_' . $currentlang . '/' . $imgfile)) 
	{
        $pnt_image = TITANIUM_MODULES_IMAGE_DIR. $mymodule ."/images/lang_".$currentlang."/$imgfile";
		if($ImageDebug)
        echo '<div align="center"><font color="red"><strong>FOUND:</strong> '.$pnt_image.'</font></div>';
    } 
	else
	if (@file_exists(TITANIUM_MODULES_DIR . $mymodule . '/images/' . $imgfile)) 
	{
        $pnt_image =  TITANIUM_MODULES_IMAGE_DIR. $mymodule ."/images/$imgfile";
		if($ImageDebug)
        echo '<div align="center"><font color="red"><strong>FOUND:</strong> '.$pnt_image.'</font></div>';
    } 
	else
	if (@file_exists(TITANIUM_IMAGES_DIR . $mymodule . '/' . $imgfile)) 
	{
        $pnt_image = TITANIUM_IMAGES_BASE_DIR . $mymodule ."/$imgfile";
		if($ImageDebug)
        echo '<div align="center"><font color="red"><strong>FOUND:</strong> '.$pnt_image.'</font></div>';
    } 
	else
	if (@file_exists(TITANIUM_IMAGES_DIR . $imgfile)) 
	{
        $pnt_image = TITANIUM_IMAGES_BASE_DIR . $imgfile;
		if($ImageDebug)
        echo '<div align="center"><font color="red"><strong>FOUND:</strong> '.$pnt_image.'</font></div>';
    } 
	else
	if (@file_exists(TITANIUM_BASE_DIR . $imgfile)) 
	{
        $pnt_image = TITANIUM_HREF_BASE_DIR . $imgfile;
		if($ImageDebug)
        echo '<div align="center"><font color="red"><strong>FOUND:</strong> '.$pnt_image.'</font></div>';
    } 
	else
	{
	    log_write('error', "( ".TITANIUM_MODULES_IMAGE_DIR. $mymodule ."/images/$imgfile"." ) not found!", 'Image Not Found Error');
		if($ImageDebug)
        echo '<div align="center"><font color="red"><strong>NOT FOUND:</strong> '.$pnt_image.'</font></div>';
    }
	
	return($pnt_image);
}
############################################################################################################################################
# Image Mod - End  01/01/2012                                                                                                              #
############################################################################################################################################
?>
