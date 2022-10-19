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

/**
 * Check if Folder Exist - 09/26/2022 4am
 * Checks if a folder exist and return canonicalized absolute pathname (long version)
 * @param string $folder the path being checked.
 * @return mixed returns the canonicalized absolute pathname on success otherwise FALSE is returned
 */

function folder_exist($folder)
{
    # Get canonicalized absolute pathname
    $path = realpath($folder);

    # If it exist, check if it's a directory
    if($path !== false AND is_dir($path))
    {
        # Return canonicalized absolute pathname
        return $path;
    }

    # Path/folder does not exist
    return false;
}

/**
 * Forum Icon Path Mod - 09/26/2022 4am
 * This makes it so that each theme is using independamt forum icons!
 * You can now style each theme with custom matching icons
 * Mod Created by Ernest Buffington aka TheGhost
 */

function forum_icon_img_path($icon='', $mymodule='', $empty=true) 
{
    global $currentlang, $ThemeSel, $Default_Theme, $ImageDebug;

    $folder = NUKE_BASE_DIR.'themes/'.$ThemeSel.'/images/forum_icons';
    $source_dir = NUKE_BASE_DIR.'modules/Forums/images/forum_icons';
    
	if(FALSE !== ($path = folder_exist($folder)))
    {
     $forum_icon_path = TITANIUM_THEMES_IMAGE_DIR.$ThemeSel."/"; 
	 log_write('error', "( ".$forum_icon_path." ) <--- Forum Icon Path!", 'Image Found!');

    }
    else
	{
		# Open the source folder / directory 
        $dir = opendir($source_dir); 	

	    mkdir($folder);
	
	    # Loop through the files in source directory 
        while($file = readdir($dir)) 
        {
          # Skip . and .. 
          if(($file != '.') && ($file != '..')) 
          {  
             # Check if it's folder / directory or file 
             if(is_dir($source_dir.'/'.$file))  
             {    
                # Recursively calling this function for sub directory  
                recursive_files_copy($source_dir.'/'.$file, $folder.'/'.$file); 
             }  
            else 
               {   
                  # Copying the files
                  copy($source_dir.'/'.$file, $folder.'/'.$file);  
               }  
          }  
        }  
     
	    closedir($dir); 
	}
	
	return($forum_icon_path);
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