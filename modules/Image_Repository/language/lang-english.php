<?php

/************************************************************************
    Nuke-Evolution: Image Repository
    ======================================================
    Copyright (c) 2015 by lonestar-modules.com
    Author        : Lonestar
    Version       : 1.1.0
    Developer     : Lonestar - www.lonestar-modules.com				
    Notes         : N/A
************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) 
    exit('ERROR: SERVERPATH AND FILELOCATION ARE DIFFERENT');

global $admin_file, $module_name;

$lang_new[$module_name]['ADMINISTRATION'] 				= 'Administration Settings';
$lang_new[$module_name]['ANONYMOUS'] 					= 'You are an Anonymous user. You can register for free by clicking <a style="text-decoration:none; letter-spacing:1px;" href="modules.php?name=Your_Account">here</a>';
$lang_new[$module_name]['ATTENTION'] 					= '<span style="font-weight:bold;">ATTENTION</span>';
$lang_new[$module_name]['BACKGROUND'] 					= 'Background Color';
$lang_new[$module_name]['BORDER'] 						= 'Border Color';
$lang_new[$module_name]['BROWSE'] 						= 'Browser for an Image';
$lang_new[$module_name]['BBCODE'] 						= 'BBCode';
$lang_new[$module_name]['CODES'] 						= 'Image Codes';
$lang_new[$module_name]['CODES_PLUS'] 					= 'More Codes';
$lang_new[$module_name]['CODES_THUMBS'] 				= 'Image Codes for Thumbnail';
$lang_new[$module_name]['COPYRIGHT_FOR'] 				= 'module for';
$lang_new[$module_name]['COPYRIGHT_LICENSE'] 			= '<strong>License</strong>';
$lang_new[$module_name]['COPYRIGHT_MODULE'] 			= '<strong>Module Name</strong>';
$lang_new[$module_name]['COPYRIGHT_MODULE_AUTHOR'] 		= '<strong>Author</strong>';
$lang_new[$module_name]['COPYRIGHT_MODULE_DESCRIPTION'] = '<strong>Module Description</strong>';
$lang_new[$module_name]['COPYRIGHT_MODULE_DOWNLOAD']	= '<strong>Module Download</strong>';
$lang_new[$module_name]['COPYRIGHT_MODULE_EMAIL'] 		= '<strong>Author Email</strong>';
$lang_new[$module_name]['COPYRIGHT_MODULE_HOME'] 		= '<strong>Author Homepage</strong>';
$lang_new[$module_name]['COPYRIGHT_MODULE_TEXT'] 		= 'Allows users to add and manage their images in a safe and secure module environment';
$lang_new[$module_name]['COPYRIGHT_MODULE_VERSION'] 	= '<strong>Module Version</strong>';
$lang_new[$module_name]['COPYRIGHT_INFORMATION'] 		= 'Module Copyright © Information';
$lang_new[$module_name]['COPYRIGHT_RAVEN_CMS'] 			= '<a href="http://ravenphpscripts.com" target="_blank">Raven Nuke</a>';
$lang_new[$module_name]['COPYRIGHT_EVOLUTION_XTREME'] 	= '<a href="http://evolution-xtreme.com" target="_blank">Nuke-Evolution Xtreme</a>';
$lang_new[$module_name]['COPYRIGHT_CLOSE'] 				= '<strong>Close</strong>';
$lang_new[$module_name]['CUSTOM'] 						= 'Custom Options';
$lang_new[$module_name]['CUSTOM_COLOR'] 				= 'Custom Color';
$lang_new[$module_name]['DELETE'] 						= 'Delete';
$lang_new[$module_name]['DIRECT'] 						= 'Direct Link';
$lang_new[$module_name]['EXTRA_CODES']					= 'Extra Image Codes';
$lang_new[$module_name]['FIRST'] 						= 'First';
$lang_new[$module_name]['FULL'] 						= 'View Image';
$lang_new[$module_name]['GENERATE'] 					= 'Generate Thumbnail';
$lang_new[$module_name]['HTML'] 						= 'HTML';
$lang_new[$module_name]['IMAGECOUNT']					= 'Image Count';
$lang_new[$module_name]['IMAGECOUNT_TOTAL'] 			= 'Has a total of <a style="text-decoration:none;" href="modules.php?name='.$module_name.'&amp;op=users_images&amp;uid=%s"><span style="color: red; font-weight: bold;">%s</span></a> image(s)';
$lang_new[$module_name]['IMAGECOUNT_ZERO'] 				= 'Has not uploaded anything.';
$lang_new[$module_name]['IMAGE'] 						= 'Image';
$lang_new[$module_name]['IMAGE_ALLOWED']				= 'Only the following filetype\'s are supported [JPEG, GIF and PNG]';
$lang_new[$module_name]['IMAGE_MAX'] 					= 'Max Image Size';
$lang_new[$module_name]['IMAGE_NONE'] 					= 'No image\'s uploaded yet.';
$lang_new[$module_name]['IMAGE_SIZE'] 					= 'Size';
$lang_new[$module_name]['IMAGE_SIZE_ERROR'] 			= 'Image size is too large, The max size allowed is %s';
$lang_new[$module_name]['IMAGES_SUBMITTED'] 			= 'Image submitted by %s';
$lang_new[$module_name]['LAST'] 						= 'Last';
$lang_new[$module_name]['MAIN'] 						= 'Main';
$lang_new[$module_name]['MODULE_NAME'] 					= str_replace('_',' ',$module_name);
$lang_new[$module_name]['MOUDLE_NAME_COPYRIGHT']		= str_replace('_',' ',$module_name).' &#169;';
$lang_new[$module_name]['MYIMAGES'] 					= 'List of your image(s)';
$lang_new[$module_name]['NEXT'] 						= 'Next';
$lang_new[$module_name]['NEXT_TIME']	 				= 'NICE TRY, BETTER LUCK NEXT TIME';
$lang_new[$module_name]['NEXT_TIME_OWNER'] 				= 'NICE TRY, YOU DO NOT OWN THIS IMAGE.';
$lang_new[$module_name]['OF']							= 'of';
$lang_new[$module_name]['OPTIONS'] 						= 'Options';
$lang_new[$module_name]['PERCENTAGE'] 					= 'Percentage Color';
$lang_new[$module_name]['PERCENTAGE-0'] 				= '0%';
$lang_new[$module_name]['PERCENTAGE-5'] 				= '5%';
$lang_new[$module_name]['PERCENTAGE-25'] 				= '25%';
$lang_new[$module_name]['PERCENTAGE-50'] 				= '50%';
$lang_new[$module_name]['PERCENTAGE-75'] 				= '75%';
$lang_new[$module_name]['PERCENTAGE-100'] 				= '100%';
$lang_new[$module_name]['PERPAGE_IMAGES'] 				= 'Images Per Page';
$lang_new[$module_name]['PERPAGE_USERS'] 				= 'Users Per Page (Administration)';
$lang_new[$module_name]['PREVIOUS'] 					= 'Prev';
$lang_new[$module_name]['PROGRESS'] 					= 'Upload Progress';
$lang_new[$module_name]['PROGRESS_BAR']					= 'Progress Bar Preview';
$lang_new[$module_name]['QUOTA']						= 'Quota';
$lang_new[$module_name]['QUOTA_DEFAULT']				= 'Quota Default';
$lang_new[$module_name]['QUOTA_LEFT']					= 'Quota';
$lang_new[$module_name]['QUOTA_PROGRESS']				= 'Quota Progress';
$lang_new[$module_name]['QUOTA_REACHED']				= 'Sorry %s, You have reached your allotted quota. Delete image\'s or message an admin for more space.';
$lang_new[$module_name]['QUOTA_USED']					= 'Quota Used';
$lang_new[$module_name]['RESOLUTION'] 					= 'Resolution';
$lang_new[$module_name]['SAVE']			 				= 'Save';
$lang_new[$module_name]['SAVE_SETTINGS'] 				= 'Save Settings';
$lang_new[$module_name]['SETTINGS'] 					= 'Settings';
$lang_new[$module_name]['SETTINGS_ADMIN'] 				= 'Module Settings';
$lang_new[$module_name]['SETTINGS_CONFIGURE'] 			= 'Configure your settings';
$lang_new[$module_name]['SOMETHING_WRONG'] 				= 'Sorry, Something went wrong while trying to upload your image.';
$lang_new[$module_name]['SOMETHING_WRONG_THUMB']		= 'Sorry, Something went wrong while trying to generate a thumbnail for this image.';
$lang_new[$module_name]['SPACING']						= 'Letter Spacing';
$lang_new[$module_name]['SPACING_NONE']					= 'No Spacing';
$lang_new[$module_name]['SUBMIT'] 						= 'Upload';
$lang_new[$module_name]['SUPPORTED'] 					= 'Only the following filetype\'s are supported [<span style="font-weight:bold;">JPEG</span>, <span style="font-weight:bold;">GIF</span> and <span style="font-weight:bold;">PNG</span>]';
$lang_new[$module_name]['TO']							= 'to';
$lang_new[$module_name]['UPLOAD'] 						= 'Upload an Image';
$lang_new[$module_name]['UPLOADED'] 					= 'Uploaded';
$lang_new[$module_name]['USER']							= 'User';
$lang_new[$module_name]['USERS'] 						= 'Manage User(s)';
$lang_new[$module_name]['USER_ADMINISTRATION']			= 'User Administration';
$lang_new[$module_name]['VERSION'] 						= 'Version & Changelog';
$lang_new[$module_name]['VIEW'] 						= 'View Image';
//-------------------------------------------------------------------------
//	LANGUAGE DEFINES FOR THE COLOR SELECTION MENU
//-------------------------------------------------------------------------
$lang_new[$module_name]['AQUA']							= 'Aqua';
$lang_new[$module_name]['AQUAMARINE']					= 'Aquamarine';
$lang_new[$module_name]['BLACK']						= 'Black';
$lang_new[$module_name]['BLACK_DEFAULT']				= 'Black (Default)';
$lang_new[$module_name]['BLUE']							= 'Blue';
$lang_new[$module_name]['BROWN']						= 'Brown';
$lang_new[$module_name]['CADETBLUE']					= 'Cadet Blue';
$lang_new[$module_name]['CHOCOLATE']					= 'Chocolate';
$lang_new[$module_name]['CHARTREUSE']					= 'Chartreuse';
$lang_new[$module_name]['CRIMSON']						= 'Crimson';
$lang_new[$module_name]['CYAN']							= 'Cyan';
$lang_new[$module_name]['DARKBLUE']						= 'Dark Blue';
$lang_new[$module_name]['DARKGOLDEN']					= 'Dark Golden Rod';
$lang_new[$module_name]['DARKGREEN']					= 'Dark Green';
$lang_new[$module_name]['DARKMAGENTA']					= 'Dark Magenta';
$lang_new[$module_name]['DARKORCHID']					= 'Dark Orchid';
$lang_new[$module_name]['DARKRED']						= 'Dark Red';
$lang_new[$module_name]['DARKSKY']						= 'Deep Sky Blue';
$lang_new[$module_name]['DODGERBLUE']					= 'Dodger Blue';
$lang_new[$module_name]['FIREBRICK']					= 'Fire Brick';
$lang_new[$module_name]['FUCHSIA']						= 'Fuchsia';
$lang_new[$module_name]['GOLD']							= 'Gold';
$lang_new[$module_name]['GOLDROD']						= 'Golden Rod';
$lang_new[$module_name]['GREY']							= 'Grey';
$lang_new[$module_name]['GREEN']						= 'Green';
$lang_new[$module_name]['GREEN_DEFAULT']				= 'Green (Default)';
$lang_new[$module_name]['INDIGO']						= 'Indigo';
$lang_new[$module_name]['LAWNGREEN']					= 'LawnGreen';
$lang_new[$module_name]['LIME']							= 'Lime';
$lang_new[$module_name]['LIMEGREEN']					= 'Lime Green';
$lang_new[$module_name]['MAGENTA']						= 'Magenta';
$lang_new[$module_name]['MIDNIGHTBLUE']					= 'Midnight Blue';
$lang_new[$module_name]['OLIVE']						= 'Olive';
$lang_new[$module_name]['ORANGE']						= 'Orange';
$lang_new[$module_name]['ORANGERED']					= 'Orange Red';
$lang_new[$module_name]['PLUM']							= 'Plum';
$lang_new[$module_name]['PURPLE']						= 'Purple';
$lang_new[$module_name]['RED']							= 'Red';
$lang_new[$module_name]['SADDLE']						= 'Saddle Brown';
$lang_new[$module_name]['SALMON']						= 'Salmon';
$lang_new[$module_name]['SEAGREEN']						= 'Sea Green';
$lang_new[$module_name]['BLUESLATE']					= 'Slate Blue';
$lang_new[$module_name]['TEAL']							= 'Teal';
$lang_new[$module_name]['TOMATO']						= 'Tomato';
$lang_new[$module_name]['VIOLET']						= 'Violet';
$lang_new[$module_name]['WHITE']						= 'White';
$lang_new[$module_name]['WHITE_DEFAULT']				= 'White (Default)';
$lang_new[$module_name]['YELLOW']						= 'Yellow';
//-------------------------------------------------------------------------
//	LANGUAGE DEFINES FOR THE COLOR SELECTION MENU
//-------------------------------------------------------------------------
?>