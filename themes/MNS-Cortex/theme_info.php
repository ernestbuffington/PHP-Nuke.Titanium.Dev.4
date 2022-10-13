<?
/*=======================================================================================
 PHP-Nuke Titanium : Enhanced PHP-Nuke Web Portal System : Using the PHP-Nuke Titanium Core
 ========================================================================================*/
/*****************************************************************************************/
/* MNS-Cortex v.3.0 theme designed by Ernest "TheGhost" Buffington                       */
/* This theme was designed to fit the new generation wide screen monitors                */
/*                                                                                       */
/* MNS-Cortex v.3.0 is a free public theme package designed for PHP-Nuke Titanium        */
/* Copyright (c) 2009 by TheGhost All Rights Reserved                                    */
/*****************************************************************************************/
/* For more commercial and public themes, custom graphics and photoshop tutorials        */
/* visit www.mynetworkspace.in                                                           */
/*****************************************************************************************/
/* For support of this great CMS visit MyNetworkSpace http://www.mynetworkspace.in       */
/*****************************************************************************************/
/* PHP-Nuke Copyright (c) 2005 by Francisco Burzi http://phpnuke.org                     */
/*****************************************************************************************/
/*****[CHANGES]*****************************************************************************************************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       09/29/2005
      Theme Management                         v1.0.2       12/14/2005       
	  MyNetworkSpace Patched                   v1.0.0       10/09/2009       Modified for the MyNetworkSpace Network
	  SWF Header Class                         v1.0.0       10/09/2009       Modified for the MyNetworkSpace Network
	  Resolution Checker                       v1.0.0       10/09/2009       Modified for the MyNetworkSpace Network
	  Detect Browser Type                      v1.0.0       10/09/2009       Modified for the MyNetworkSpace Network
	  Page Loading Animation                   v1.0.0       10/09/2009       Modified for the MyNetworkSpace Network
	  Safari Browser Support                   v1.0.0       10/09/2009       Modified for the MyNetworkSpace Network
	  FireFox Browser Support                  v1.0.0       10/09/2009       Modified for the MyNetworkSpace Network
	  Internet Explorer Support                v1.0.0       10/09/2009       Modified for the MyNetworkSpace Network
	  File Extension Support                   v1.0.0       10/09/2009       Modified for the MyNetworkSpace Network
 ********************************************************************************************************************************************************/
 /******************************************************************************************************************************************************
   PHP-Nuke Titanium: Theme Management
   =====================================================================================================================================================
   Copyright (c) 2005 by The PHP-Nuke Titanium Team
  
   Filename      : theme_info.php
   Author        : JeFFb68CAM (www.Evo-Mods.com)
   Version       : 1.0.2
   Date          : 12.20.2005 (mm.dd.yyyy)
                                                                        
   Notes         : Advanced Theme Features for wgx-glazed.
********************************************************************************************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) 
{
    exit('Access Denied');
}

$current_theme = basename(dirname(__FILE__));

$param_names = array(
			'Link 1 URL',
 			'Link 1 Text',
			'Link 2 URL',
			'Link 2 Text',
			'Link 3 URL',
			'Link 3 Text',
			'Link 4 URL',
			'Link 4 Text',
			'Link 5 URL',
			'Link 5 Text',
			'BG Color 1',
			'BG Color 2',
			'BG Color 3',
			'BG Color 4',
			'Text Color 1',
			'Text Color 2',
			);
$params = array(
			'link1',
			'link1text',
			'link2',
			'link2text',
			'link3',
			'link3text',
			'link4',
			'link4text',
			'link5',
			'link5text',
			'bgcolor1',
			'bgcolor2',
			'bgcolor3',
			'bgcolor4',
			'textcolor1',
			'textcolor2',
			);
$default = array(
			'index.php',
			'HOME',
			'modules.php?name=Forums',
			'FORUMS',
			'modules.php?name=Web_Links',
			'LINKS',
			'modules.php?name=Downloads',
			'DOWNLOADS',
			'modules.php?name=Your_Account',
			'ACCOUNT',
			'#474646"',
			'#474646"',
			'#474646"',
			'#474646"',
			'#FFFFFF',
			'#FFFFFF',
			);

global $ThemeInfo;

$ThemeInfo = LoadThemeInfo($current_theme);
?>