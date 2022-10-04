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

global $admin_file, $pnt_module;

$lang_new[$pnt_module]['ADMINISTRATION'] 				= 'Administration Settings';
$lang_new[$pnt_module]['ANONYMOUS'] 					= 'You are an Anonymous user. You can register for free by clicking <a style="text-decoration:none; letter-spacing:1px;" href="modules.php?name=Your_Account">here</a>';
$lang_new[$pnt_module]['ATTENTION'] 					= '<span style="font-weight:bold;">ATTENTION</span>';
$lang_new[$pnt_module]['BACKGROUND'] 					= 'Background Color';
$lang_new[$pnt_module]['BORDER'] 						= 'Border Color';
$lang_new[$pnt_module]['BROWSE'] 						= 'Browser for an Image';
$lang_new[$pnt_module]['BBCODE'] 						= 'BBCode';
$lang_new[$pnt_module]['CODES'] 						= 'Image Codes';
$lang_new[$pnt_module]['CODES_PLUS'] 					= 'More Codes';
$lang_new[$pnt_module]['CODES_THUMBS'] 				= 'Image Codes for Thumbnail';
$lang_new[$pnt_module]['COPYRIGHT_FOR'] 				= 'module for';
$lang_new[$pnt_module]['COPYRIGHT_LICENSE'] 			= '<strong>License</strong>';
$lang_new[$pnt_module]['COPYRIGHT_MODULE'] 			= '<strong>Module Name</strong>';
$lang_new[$pnt_module]['COPYRIGHT_MODULE_AUTHOR'] 		= '<strong>Author</strong>';
$lang_new[$pnt_module]['COPYRIGHT_MODULE_DESCRIPTION'] = '<strong>Module Description</strong>';
$lang_new[$pnt_module]['COPYRIGHT_MODULE_DOWNLOAD']	= '<strong>Module Download</strong>';
$lang_new[$pnt_module]['COPYRIGHT_MODULE_EMAIL'] 		= '<strong>Author Email</strong>';
$lang_new[$pnt_module]['COPYRIGHT_MODULE_HOME'] 		= '<strong>Author Homepage</strong>';
$lang_new[$pnt_module]['COPYRIGHT_MODULE_TEXT'] 		= 'Allows users to add and manage their images in a safe and secure module environment';
$lang_new[$pnt_module]['COPYRIGHT_MODULE_VERSION'] 	= '<strong>Module Version</strong>';
$lang_new[$pnt_module]['COPYRIGHT_INFORMATION'] 		= 'Module Copyright © Information';
$lang_new[$pnt_module]['COPYRIGHT_RAVEN_CMS'] 			= '<a href="http://ravenphpscripts.com" target="_blank">Raven Nuke</a>';
$lang_new[$pnt_module]['COPYRIGHT_EVOLUTION_XTREME'] 	= '<a href="http://evolution-xtreme.com" target="_blank">Nuke-Evolution Xtreme</a>';
$lang_new[$pnt_module]['COPYRIGHT_CLOSE'] 				= '<strong>Close</strong>';
$lang_new[$pnt_module]['CUSTOM'] 						= 'Custom Options';
$lang_new[$pnt_module]['CUSTOM_COLOR'] 				= 'Custom Color';
$lang_new[$pnt_module]['DELETE'] 						= 'Delete';
$lang_new[$pnt_module]['DIRECT'] 						= 'Direct Link';
$lang_new[$pnt_module]['EXTRA_CODES']					= 'Extra Image Codes';
$lang_new[$pnt_module]['FIRST'] 						= 'First';
$lang_new[$pnt_module]['FULL'] 						= 'View Image';
$lang_new[$pnt_module]['GENERATE'] 					= 'Generate Thumbnail';
$lang_new[$pnt_module]['HTML'] 						= 'HTML';
$lang_new[$pnt_module]['IMAGECOUNT']					= 'Image Count';
$lang_new[$pnt_module]['IMAGECOUNT_TOTAL'] 			= 'Has a total of <a style="text-decoration:none;" href="modules.php?name='.$pnt_module.'&amp;op=users_images&amp;uid=%s"><span style="color: red; font-weight: bold;">%s</span></a> image(s)';
$lang_new[$pnt_module]['IMAGECOUNT_ZERO'] 				= 'Has not uploaded anything.';
$lang_new[$pnt_module]['IMAGE'] 						= 'Image';
$lang_new[$pnt_module]['IMAGE_ALLOWED']				= 'Only the following filetype\'s are supported [JPEG, GIF and PNG]';
$lang_new[$pnt_module]['IMAGE_MAX'] 					= 'Max Image Size';
$lang_new[$pnt_module]['IMAGE_NONE'] 					= 'No image\'s uploaded yet.';
$lang_new[$pnt_module]['IMAGE_SIZE'] 					= 'Size';
$lang_new[$pnt_module]['IMAGE_SIZE_ERROR'] 			= 'Image size is too large, The max size allowed is %s';
$lang_new[$pnt_module]['IMAGES_SUBMITTED'] 			= 'Image submitted by %s';
$lang_new[$pnt_module]['LAST'] 						= 'Last';
$lang_new[$pnt_module]['MAIN'] 						= 'Main';
$lang_new[$pnt_module]['MODULE_NAME'] 					= str_replace('_',' ',$pnt_module);
$lang_new[$pnt_module]['MOUDLE_NAME_COPYRIGHT']		= str_replace('_',' ',$pnt_module).' &#169;';
$lang_new[$pnt_module]['MYIMAGES'] 					= 'List of your image(s)';
$lang_new[$pnt_module]['NEXT'] 						= 'Next';
$lang_new[$pnt_module]['NEXT_TIME']	 				= 'NICE TRY, BETTER LUCK NEXT TIME';
$lang_new[$pnt_module]['NEXT_TIME_OWNER'] 				= 'NICE TRY, YOU DO NOT OWN THIS IMAGE.';
$lang_new[$pnt_module]['OF']							= 'of';
$lang_new[$pnt_module]['OPTIONS'] 						= 'Options';
$lang_new[$pnt_module]['PERCENTAGE'] 					= 'Percentage Color';
$lang_new[$pnt_module]['PERCENTAGE-0'] 				= '0%';
$lang_new[$pnt_module]['PERCENTAGE-5'] 				= '5%';
$lang_new[$pnt_module]['PERCENTAGE-25'] 				= '25%';
$lang_new[$pnt_module]['PERCENTAGE-50'] 				= '50%';
$lang_new[$pnt_module]['PERCENTAGE-75'] 				= '75%';
$lang_new[$pnt_module]['PERCENTAGE-100'] 				= '100%';
$lang_new[$pnt_module]['PERPAGE_IMAGES'] 				= 'Images Per Page';
$lang_new[$pnt_module]['PERPAGE_USERS'] 				= 'Users Per Page (Administration)';
$lang_new[$pnt_module]['PREVIOUS'] 					= 'Prev';
$lang_new[$pnt_module]['PROGRESS'] 					= 'Upload Progress';
$lang_new[$pnt_module]['PROGRESS_BAR']					= 'Progress Bar Preview';
$lang_new[$pnt_module]['QUOTA']						= 'Quota';
$lang_new[$pnt_module]['QUOTA_DEFAULT']				= 'Quota Default';
$lang_new[$pnt_module]['QUOTA_LEFT']					= 'Quota';
$lang_new[$pnt_module]['QUOTA_PROGRESS']				= 'Quota Progress';
$lang_new[$pnt_module]['QUOTA_REACHED']				= 'Sorry %s, You have reached your allotted quota. Delete image\'s or message an admin for more space.';
$lang_new[$pnt_module]['QUOTA_USED']					= 'Quota Used';
$lang_new[$pnt_module]['RESOLUTION'] 					= 'Resolution';
$lang_new[$pnt_module]['SAVE']			 				= 'Save';
$lang_new[$pnt_module]['SAVE_SETTINGS'] 				= 'Save Settings';
$lang_new[$pnt_module]['SETTINGS'] 					= 'Settings';
$lang_new[$pnt_module]['SETTINGS_ADMIN'] 				= 'Module Settings';
$lang_new[$pnt_module]['SETTINGS_CONFIGURE'] 			= 'Configure your settings';
$lang_new[$pnt_module]['SOMETHING_WRONG'] 				= 'Sorry, Something went wrong while trying to upload your image.';
$lang_new[$pnt_module]['SOMETHING_WRONG_THUMB']		= 'Sorry, Something went wrong while trying to generate a thumbnail for this image.';
$lang_new[$pnt_module]['SPACING']						= 'Letter Spacing';
$lang_new[$pnt_module]['SPACING_NONE']					= 'No Spacing';
$lang_new[$pnt_module]['SUBMIT'] 						= 'Upload';
$lang_new[$pnt_module]['SUPPORTED'] 					= 'Only the following filetype\'s are supported [<span style="font-weight:bold;">JPEG</span>, <span style="font-weight:bold;">GIF</span> and <span style="font-weight:bold;">PNG</span>]';
$lang_new[$pnt_module]['TO']							= 'to';
$lang_new[$pnt_module]['UPLOAD'] 						= 'Upload an Image';
$lang_new[$pnt_module]['UPLOADED'] 					= 'Uploaded';
$lang_new[$pnt_module]['USER']							= 'User';
$lang_new[$pnt_module]['USERS'] 						= 'Manage User(s)';
$lang_new[$pnt_module]['USER_ADMINISTRATION']			= 'User Administration';
$lang_new[$pnt_module]['VERSION'] 						= 'Version & Changelog';
$lang_new[$pnt_module]['VIEW'] 						= 'View Image';
//-------------------------------------------------------------------------
//	LANGUAGE DEFINES FOR THE COLOR SELECTION MENU
//-------------------------------------------------------------------------
$lang_new[$pnt_module]['AQUA']							= 'Aqua';
$lang_new[$pnt_module]['AQUAMARINE']					= 'Aquamarine';
$lang_new[$pnt_module]['BLACK']						= 'Black';
$lang_new[$pnt_module]['BLACK_DEFAULT']				= 'Black (Default)';
$lang_new[$pnt_module]['BLUE']							= 'Blue';
$lang_new[$pnt_module]['BROWN']						= 'Brown';
$lang_new[$pnt_module]['CADETBLUE']					= 'Cadet Blue';
$lang_new[$pnt_module]['CHOCOLATE']					= 'Chocolate';
$lang_new[$pnt_module]['CHARTREUSE']					= 'Chartreuse';
$lang_new[$pnt_module]['CRIMSON']						= 'Crimson';
$lang_new[$pnt_module]['CYAN']							= 'Cyan';
$lang_new[$pnt_module]['DARKBLUE']						= 'Dark Blue';
$lang_new[$pnt_module]['DARKGOLDEN']					= 'Dark Golden Rod';
$lang_new[$pnt_module]['DARKGREEN']					= 'Dark Green';
$lang_new[$pnt_module]['DARKMAGENTA']					= 'Dark Magenta';
$lang_new[$pnt_module]['DARKORCHID']					= 'Dark Orchid';
$lang_new[$pnt_module]['DARKRED']						= 'Dark Red';
$lang_new[$pnt_module]['DARKSKY']						= 'Deep Sky Blue';
$lang_new[$pnt_module]['DODGERBLUE']					= 'Dodger Blue';
$lang_new[$pnt_module]['FIREBRICK']					= 'Fire Brick';
$lang_new[$pnt_module]['FUCHSIA']						= 'Fuchsia';
$lang_new[$pnt_module]['GOLD']							= 'Gold';
$lang_new[$pnt_module]['GOLDROD']						= 'Golden Rod';
$lang_new[$pnt_module]['GREY']							= 'Grey';
$lang_new[$pnt_module]['GREEN']						= 'Green';
$lang_new[$pnt_module]['GREEN_DEFAULT']				= 'Green (Default)';
$lang_new[$pnt_module]['INDIGO']						= 'Indigo';
$lang_new[$pnt_module]['LAWNGREEN']					= 'LawnGreen';
$lang_new[$pnt_module]['LIME']							= 'Lime';
$lang_new[$pnt_module]['LIMEGREEN']					= 'Lime Green';
$lang_new[$pnt_module]['MAGENTA']						= 'Magenta';
$lang_new[$pnt_module]['MIDNIGHTBLUE']					= 'Midnight Blue';
$lang_new[$pnt_module]['OLIVE']						= 'Olive';
$lang_new[$pnt_module]['ORANGE']						= 'Orange';
$lang_new[$pnt_module]['ORANGERED']					= 'Orange Red';
$lang_new[$pnt_module]['PLUM']							= 'Plum';
$lang_new[$pnt_module]['PURPLE']						= 'Purple';
$lang_new[$pnt_module]['RED']							= 'Red';
$lang_new[$pnt_module]['SADDLE']						= 'Saddle Brown';
$lang_new[$pnt_module]['SALMON']						= 'Salmon';
$lang_new[$pnt_module]['SEAGREEN']						= 'Sea Green';
$lang_new[$pnt_module]['BLUESLATE']					= 'Slate Blue';
$lang_new[$pnt_module]['TEAL']							= 'Teal';
$lang_new[$pnt_module]['TOMATO']						= 'Tomato';
$lang_new[$pnt_module]['VIOLET']						= 'Violet';
$lang_new[$pnt_module]['WHITE']						= 'White';
$lang_new[$pnt_module]['WHITE_DEFAULT']				= 'White (Default)';
$lang_new[$pnt_module]['YELLOW']						= 'Yellow';
//-------------------------------------------------------------------------
//	LANGUAGE DEFINES FOR THE COLOR SELECTION MENU
//-------------------------------------------------------------------------
?>