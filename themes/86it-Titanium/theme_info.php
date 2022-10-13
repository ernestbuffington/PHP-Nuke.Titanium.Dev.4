<?php
/*========================================================================================
 PHP-Nuke Titanium: Enhanced PHP-Nuke Web Portal System
 =========================================================================================*/
/*****************************************************************************************/
/* 86it-Chromo v3.0 theme designed by effectica    www.effectica.com                      */
/*                                                                                       */
/*                                                                                       */
/* 86it-Chromo v3.0  is a free public theme package designed for PHP-Nuke Evolution       */
/* Copyright (c) 2005 by effectica All Rights Reserved                                   */
/*****************************************************************************************/
/* For more commercial and public themes, custom graphics and photoshop tutorials        */
/* visit www.effectica.com                                                               */
/*****************************************************************************************/
/* For support of this great CMS visit PHP-Nuke Titanium http://www.nuke-evolution.com      */
/* For Nuke Evolution blocks, mods and addons, please visit http://Evo-Mods.com          */
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

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
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
            'BG Color 1',
            'BG Color 2',
            'BG Color 3',
            'BG Color 4',
            'Text Color 1',
            'Text Color 2'
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
            'bgcolor1',
            'bgcolor2',
            'bgcolor3',
            'bgcolor4',
            'textcolor1',
            'textcolor2'

            );

$default = array(
            'index.php',
            'HOME',
            'modules.php?name=Forums',
            'FORUMS',
            'modules.php?name=Downloads',
            'DOWNLOADS',
            'modules.php?name=Your_Account',
            'ACCOUNT',
            '#AAAFB2',
            '#878C92',
            '#F0F0F0',
            '#F3F4FF',
            '#FFFFFF',
            '#D59E00'
            );
global $ThemeInfo;
$ThemeInfo = LoadThemeInfo($current_theme);

?>