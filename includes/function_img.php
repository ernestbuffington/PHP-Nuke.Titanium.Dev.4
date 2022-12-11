<?php
/*=======================================================================
            PHP-Nuke Titanium (CMS) Enhanced And Advanced
 ========================================================================

 ************************************************************************
 * PHP-NUKE: Advanced Content Management System                         *
 * ============================================                         *
 * Copyright (c) 2002 by Francisco Burzi                                *
 * http://phpnuke.org                                                   *
 *                                                                      *
 * This program is free software. You can redistribute it and/or modify *
 * it under the terms of the GNU General Public License as published by *
 * the Free Software Foundation; either version 2 of the License.       *
 ************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

############################################################################################################################################
# Image Mod - Start  01/01/2012                                                                                                            #       
############################################################################################################################################
function img($imgfile='', $mymodule='', $empty=true) 
{
    global $currentlang, $ThemeSel, $Default_Theme;

	if (@file_exists(TITANIUM_THEMES_DIR . $ThemeSel . '/images/' . $mymodule . '/lang_' . $currentlang . '/' . $imgfile)) 
	{
        $titanium_image = TITANIUM_THEMES_IMAGE_DIR.$ThemeSel."/images/$mymodule/lang_".$currentlang."/$imgfile";
    } 
	else
	if (@file_exists(TITANIUM_THEMES_DIR . $ThemeSel . '/images/lang_' . $currentlang . '/' . $imgfile)) 
	{
        $titanium_image = TITANIUM_THEMES_IMAGE_DIR.$ThemeSel."/images/lang_".$currentlang."/$imgfile";
    } 
	else
	if (@file_exists(TITANIUM_THEMES_DIR . $ThemeSel . '/images/' . $mymodule . '/' . $imgfile)) 
	{
        $titanium_image = TITANIUM_THEMES_IMAGE_DIR.$ThemeSel."/images/$mymodule/$imgfile";
    } 
	else
	if (@file_exists(TITANIUM_THEMES_DIR . $ThemeSel . '/images/' . $imgfile)) 
	{
        $titanium_image = TITANIUM_THEMES_IMAGE_DIR.$ThemeSel."/images/$imgfile";
    } 
	else
	if (@file_exists(TITANIUM_THEMES_DIR . $Default_Theme . '/images/' . $mymodule . '/lang_' . $currentlang . '/' . $imgfile)) 
	{
        $titanium_image = TITANIUM_THEMES_IMAGE_DIR.$Default_Theme."/images/$mymodule/lang_".$currentlang."/$imgfile";
    } 
	else
	if (@file_exists(TITANIUM_THEMES_DIR . $Default_Theme . '/images/lang_' . $currentlang . '/' . $imgfile)) 
	{
        $titanium_image = TITANIUM_THEMES_IMAGE_DIR.$Default_Theme."/images/lang_".$currentlang."/$imgfile";
    } 
	else
	if (@file_exists(TITANIUM_THEMES_DIR . $Default_Theme . '/images/' . $mymodule . '/' . $imgfile)) 
	{
        $titanium_image = TITANIUM_THEMES_IMAGE_DIR.$Default_Theme."/images/$mymodule/$imgfile";
    } 
	else
	if (@file_exists(TITANIUM_THEMES_DIR . $Default_Theme . '/images/' . $imgfile)) 
	{
        $titanium_image = TITANIUM_THEMES_IMAGE_DIR.$Default_Theme."/images/$imgfile";
    } 
	else
	if (@file_exists(TITANIUM_MODULES_DIR . $mymodule . '/images/lang_' . $currentlang . '/' . $imgfile)) 
	{
        $titanium_image = TITANIUM_MODULES_IMAGE_DIR. $mymodule ."/images/lang_".$currentlang."/$imgfile";
    } 
	else
	if (@file_exists(TITANIUM_MODULES_DIR . $mymodule . '/images/' . $imgfile)) 
	{
        $titanium_image =  TITANIUM_MODULES_IMAGE_DIR. $mymodule ."/images/$imgfile";
    } 
	else
	if (@file_exists(TITANIUM_IMAGES_DIR . $mymodule . '/' . $imgfile)) 
	{
        $titanium_image = TITANIUM_IMAGES_BASE_DIR . $mymodule ."/$imgfile";
    } 
	else
	if (@file_exists(TITANIUM_IMAGES_DIR . $imgfile)) 
	{
        $titanium_image = TITANIUM_IMAGES_BASE_DIR . $imgfile;
    } 
	else
	if (@file_exists(TITANIUM_BASE_DIR . $imgfile)) 
	{
        $titanium_image = TITANIUM_HREF_BASE_DIR . $imgfile;
    } 
	else
	{
		echo "( ".TITANIUM_MODULES_IMAGE_DIR. $mymodule ."/images/$imgfile"." ) not found!";
	    log_write('error', "( ".TITANIUM_MODULES_IMAGE_DIR. $mymodule ."/images/$imgfile"." ) not found!", 'Image Not Found Error');
		//echo "( ".TITANIUM_THEMES_IMAGE_DIR . $ThemeSel . "/images/$mymodule/$imgfile"." ) not found!";
    }

	return($titanium_image);
}
############################################################################################################################################
# Image Mod - End  01/01/2012                                                                                                              #
############################################################################################################################################
?>
