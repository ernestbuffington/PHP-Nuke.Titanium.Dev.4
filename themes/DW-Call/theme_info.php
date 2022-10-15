<?php

/************************************************************************
   Nuke-Evolution: Theme Management
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team
  
   Filename      : theme_info.php
   Author        : JeFFb68CAM (www.Evo-Mods.com)
   Version       : 1.0.2
   Date          : 12.20.2005 (mm.dd.yyyy)
                                                                        
   Notes         : Call Theme Features.
************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

global $theme_options;
$current_theme = basename(dirname(__FILE__));

$param_names = array(
	'Footer Message1',
	'Footer Message2',
	'BG Color 1',
	'BG Color 2',
	'BG Color 3',
	'BG Color 4',
	'Text Color 1',
	'Text Color 2',
	'Scroll to Top Hover Color',
	'reCaptcha Skin<br /><span class="textmed">white | dark</span>' ,
	'Show footer banners<br /><span class="textmed">yes | no</span>'
);

$params = array(
	'fms1',
	'fms2',
	'bgcolor1',
	'bgcolor2',
	'bgcolor3',
	'bgcolor4',
	'textcolor1',
	'textcolor2',
	'uitotophover',
	'recaptcha_skin',
	'banners'
);

$default = array(
	'Your Message Here',
	'Your Message Here',
	'#989898',
	'#989898',
	'#989898',
	'#989898',
	'#989898',
	'#989898',
	'#dad386',
	'dark',
	'yes'
);
$ThemeInfo = LoadThemeInfo($current_theme);
?>