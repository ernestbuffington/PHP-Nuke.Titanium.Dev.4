<?php
/*=======================================================================
            PHP-Nuke Titanium (CMS) Enhanced And Advanced
 ========================================================================
 PHP-Nuke Titanium                     :   v1.0.1z
 PHP-Nuke Titanium Build               :   6205
 PHP-Nuke Titanium Filename            :   function_img.php
 PHP-Nuke Titanium File Release Date   :   September 16th, 2017  
 PHP-Nuke Tianium File Author          :   Ernest Allen Buffington

 PHP-Nuke Titanium web address         :   https://titanium.86it.network
 
 PHP-Nuke Titanium is licensed under GNU General Public License v3.0

 PHP-Nuke Titanium is Copyright(c) 2002 to 2017 by Ernest Allen Buffington
 of Sebastian Enterprises. 
 
 ernest.buffington@gmail.com
 Att: Sebastian Enterprises
 1071 Emerald Dr,
 Brandon, Florida 33511
 ========================================================================
 GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007
 Copyright (C) 2007 Free Software Foundation, Inc. <http://fsf.org/>
 Everyone is permitted to copy and distribute verbatim copies
 of this license document, but changing it is not allowed.       
 ========================================================================
 
 /*****[CHANGES]**********************************************************
  The Nuke-Evo Base Engine : v2.1.0 RC3 dated May 4th, 2009 is what we
  used to build our new content management system. To find out more
  about the starting core engine before we modified it please refer to 
  the Nuke Evolution website. http://www.nuke-evolution.com
   
  This file was re-written for PHP-Nuke Titanium and all modifications
  were done by Ernest Allen Buffington of Sebastian Enterprises.
  
  PHP-Nuke Titanium is written for Social Networking and uses a centralized 
  database that is chained to The Scorpion Network & The 86it Social Network

  It is not intended for single user platforms and has the requirement of
  remote database access to https://the.scorpion.network and 
  https://www.86it.us which is a new Social Networking System designed by 
  Ernest Buffington that requires a FEDERATED MySQL engine in order to 
  function at all.
  
  The federated database concept was created in the 1980's and has been
  available a very long time. In fact it was a part of MySQL before they
  ever started to document it. There is not much information available
  about using a FEDERATED engine and a lot of the documention is not very
  complete with regard to every detail; it is superficial and partial to
  say thge least. 
  
  The core engine from Nuke Evolution was used to create 
  PHP-Nuke Titanium. Almost all versions of PHP-Nuke were unstable and not 
  very secure. We have made it so that it is enhanced and advanced!
  
  PHP-Nuke Titanium is now a secure custom FORK of the ORIGINAL PHP-Nuke
  that was purchased by Ernest Buffington of Sebastian Enterprises.
  
  PHP-Nuke Titanium is not backward compatible to any of the prior versions of
  PHP-Nuke, Nuke-Evoltion or Nuke-Evo.
  
  The module framework of PHP-Nuke is the only thing that still functions 
  in the same way that Francis Burzi had intended and even that had to be
  safer and more secure to be a reliable form of internet communications.
  
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