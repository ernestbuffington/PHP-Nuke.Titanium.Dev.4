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

global $admin_file, $titanium_module_name;

$titanium_lang_new[$titanium_module_name]['ADMINISTRATION'] 				= 'Administration Settings';
$titanium_lang_new[$titanium_module_name]['ANONYMOUS'] 					= 'You are an Anonymous user. You can register for free by clicking <a style="text-decoration:none; letter-spacing:1px;" href="modules.php?name=Your_Account">here</a>';
$titanium_lang_new[$titanium_module_name]['ATTENTION'] 					= '<span style="font-weight:bold;">ATTENTION</span>';
$titanium_lang_new[$titanium_module_name]['BACKGROUND'] 					= 'Background Color';
$titanium_lang_new[$titanium_module_name]['BORDER'] 						= 'Border Color';
$titanium_lang_new[$titanium_module_name]['BROWSE'] 						= 'Browser for an Image';
$titanium_lang_new[$titanium_module_name]['BBCODE'] 						= 'BBCode';
$titanium_lang_new[$titanium_module_name]['CODES'] 						= 'Image Codes';
$titanium_lang_new[$titanium_module_name]['CODES_PLUS'] 					= 'More Codes';
$titanium_lang_new[$titanium_module_name]['CODES_THUMBS'] 				= 'Image Codes for Thumbnail';
$titanium_lang_new[$titanium_module_name]['COPYRIGHT_FOR'] 				= 'module for';
$titanium_lang_new[$titanium_module_name]['COPYRIGHT_LICENSE'] 			= '<strong>License</strong>';
$titanium_lang_new[$titanium_module_name]['COPYRIGHT_MODULE'] 			= '<strong>Module Name</strong>';
$titanium_lang_new[$titanium_module_name]['COPYRIGHT_MODULE_AUTHOR'] 		= '<strong>Author</strong>';
$titanium_lang_new[$titanium_module_name]['COPYRIGHT_MODULE_DESCRIPTION'] = '<strong>Module Description</strong>';
$titanium_lang_new[$titanium_module_name]['COPYRIGHT_MODULE_DOWNLOAD']	= '<strong>Module Download</strong>';
$titanium_lang_new[$titanium_module_name]['COPYRIGHT_MODULE_EMAIL'] 		= '<strong>Author Email</strong>';
$titanium_lang_new[$titanium_module_name]['COPYRIGHT_MODULE_HOME'] 		= '<strong>Author Homepage</strong>';
$titanium_lang_new[$titanium_module_name]['COPYRIGHT_MODULE_TEXT'] 		= 'Allows users to add and manage their images in a safe and secure module environment';
$titanium_lang_new[$titanium_module_name]['COPYRIGHT_MODULE_VERSION'] 	= '<strong>Module Version</strong>';
$titanium_lang_new[$titanium_module_name]['COPYRIGHT_INFORMATION'] 		= 'Module Copyright © Information';
$titanium_lang_new[$titanium_module_name]['COPYRIGHT_RAVEN_CMS'] 			= '<a href="http://ravenphpscripts.com" target="_blank">Raven Nuke</a>';
$titanium_lang_new[$titanium_module_name]['COPYRIGHT_EVOLUTION_XTREME'] 	= '<a href="http://evolution-xtreme.com" target="_blank">Nuke-Evolution Xtreme</a>';
$titanium_lang_new[$titanium_module_name]['COPYRIGHT_CLOSE'] 				= '<strong>Close</strong>';
$titanium_lang_new[$titanium_module_name]['CUSTOM'] 						= 'Custom Options';
$titanium_lang_new[$titanium_module_name]['CUSTOM_COLOR'] 				= 'Custom Color';
$titanium_lang_new[$titanium_module_name]['DELETE'] 						= 'Delete';
$titanium_lang_new[$titanium_module_name]['DIRECT'] 						= 'Direct Link';
$titanium_lang_new[$titanium_module_name]['EXTRA_CODES']					= 'Extra Image Codes';
$titanium_lang_new[$titanium_module_name]['FIRST'] 						= 'First';
$titanium_lang_new[$titanium_module_name]['FULL'] 						= 'View Image';
$titanium_lang_new[$titanium_module_name]['GENERATE'] 					= 'Generate Thumbnail';
$titanium_lang_new[$titanium_module_name]['HTML'] 						= 'HTML';
$titanium_lang_new[$titanium_module_name]['IMAGECOUNT']					= 'Image Count';
$titanium_lang_new[$titanium_module_name]['IMAGECOUNT_TOTAL'] 			= 'Has a total of <a style="text-decoration:none;" href="modules.php?name='.$titanium_module_name.'&amp;op=users_images&amp;uid=%s"><span style="color: red; font-weight: bold;">%s</span></a> image(s)';
$titanium_lang_new[$titanium_module_name]['IMAGECOUNT_ZERO'] 				= 'Has not uploaded anything.';
$titanium_lang_new[$titanium_module_name]['IMAGE'] 						= 'Image';
$titanium_lang_new[$titanium_module_name]['IMAGE_ALLOWED']				= 'Only the following filetype\'s are supported [JPEG, GIF and PNG]';
$titanium_lang_new[$titanium_module_name]['IMAGE_MAX'] 					= 'Max Image Size';
$titanium_lang_new[$titanium_module_name]['IMAGE_NONE'] 					= 'No image\'s uploaded yet.';
$titanium_lang_new[$titanium_module_name]['IMAGE_SIZE'] 					= 'Size';
$titanium_lang_new[$titanium_module_name]['IMAGE_SIZE_ERROR'] 			= 'Image size is too large, The max size allowed is %s';
$titanium_lang_new[$titanium_module_name]['IMAGES_SUBMITTED'] 			= 'Image submitted by %s';
$titanium_lang_new[$titanium_module_name]['LAST'] 						= 'Last';
$titanium_lang_new[$titanium_module_name]['MAIN'] 						= 'Main';
$titanium_lang_new[$titanium_module_name]['MODULE_NAME'] 					= str_replace('_',' ',$titanium_module_name);
$titanium_lang_new[$titanium_module_name]['MOUDLE_NAME_COPYRIGHT']		= str_replace('_',' ',$titanium_module_name).' &#169;';
$titanium_lang_new[$titanium_module_name]['MYIMAGES'] 					= 'List of your image(s)';
$titanium_lang_new[$titanium_module_name]['NEXT'] 						= 'Next';
$titanium_lang_new[$titanium_module_name]['NEXT_TIME']	 				= 'NICE TRY, BETTER LUCK NEXT TIME';
$titanium_lang_new[$titanium_module_name]['NEXT_TIME_OWNER'] 				= 'NICE TRY, YOU DO NOT OWN THIS IMAGE.';
$titanium_lang_new[$titanium_module_name]['OF']							= 'of';
$titanium_lang_new[$titanium_module_name]['OPTIONS'] 						= 'Options';
$titanium_lang_new[$titanium_module_name]['PERCENTAGE'] 					= 'Percentage Color';
$titanium_lang_new[$titanium_module_name]['PERCENTAGE-0'] 				= '0%';
$titanium_lang_new[$titanium_module_name]['PERCENTAGE-5'] 				= '5%';
$titanium_lang_new[$titanium_module_name]['PERCENTAGE-25'] 				= '25%';
$titanium_lang_new[$titanium_module_name]['PERCENTAGE-50'] 				= '50%';
$titanium_lang_new[$titanium_module_name]['PERCENTAGE-75'] 				= '75%';
$titanium_lang_new[$titanium_module_name]['PERCENTAGE-100'] 				= '100%';
$titanium_lang_new[$titanium_module_name]['PERPAGE_IMAGES'] 				= 'Images Per Page';
$titanium_lang_new[$titanium_module_name]['PERPAGE_USERS'] 				= 'Users Per Page (Administration)';
$titanium_lang_new[$titanium_module_name]['PREVIOUS'] 					= 'Prev';
$titanium_lang_new[$titanium_module_name]['PROGRESS'] 					= 'Upload Progress';
$titanium_lang_new[$titanium_module_name]['PROGRESS_BAR']					= 'Progress Bar Preview';
$titanium_lang_new[$titanium_module_name]['QUOTA']						= 'Quota';
$titanium_lang_new[$titanium_module_name]['QUOTA_DEFAULT']				= 'Quota Default';
$titanium_lang_new[$titanium_module_name]['QUOTA_LEFT']					= 'Quota';
$titanium_lang_new[$titanium_module_name]['QUOTA_PROGRESS']				= 'Quota Progress';
$titanium_lang_new[$titanium_module_name]['QUOTA_REACHED']				= 'Sorry %s, You have reached your allotted quota. Delete image\'s or message an admin for more space.';
$titanium_lang_new[$titanium_module_name]['QUOTA_USED']					= 'Quota Used';
$titanium_lang_new[$titanium_module_name]['RESOLUTION'] 					= 'Resolution';
$titanium_lang_new[$titanium_module_name]['SAVE']			 				= 'Save';
$titanium_lang_new[$titanium_module_name]['SAVE_SETTINGS'] 				= 'Save Settings';
$titanium_lang_new[$titanium_module_name]['SETTINGS'] 					= 'Settings';
$titanium_lang_new[$titanium_module_name]['SETTINGS_ADMIN'] 				= 'Module Settings';
$titanium_lang_new[$titanium_module_name]['SETTINGS_CONFIGURE'] 			= 'Configure your settings';
$titanium_lang_new[$titanium_module_name]['SOMETHING_WRONG'] 				= 'Sorry, Something went wrong while trying to upload your image.';
$titanium_lang_new[$titanium_module_name]['SOMETHING_WRONG_THUMB']		= 'Sorry, Something went wrong while trying to generate a thumbnail for this image.';
$titanium_lang_new[$titanium_module_name]['SPACING']						= 'Letter Spacing';
$titanium_lang_new[$titanium_module_name]['SPACING_NONE']					= 'No Spacing';
$titanium_lang_new[$titanium_module_name]['SUBMIT'] 						= 'Upload';
$titanium_lang_new[$titanium_module_name]['SUPPORTED'] 					= 'Only the following filetype\'s are supported [<span style="font-weight:bold;">JPEG</span>, <span style="font-weight:bold;">GIF</span> and <span style="font-weight:bold;">PNG</span>]';
$titanium_lang_new[$titanium_module_name]['TO']							= 'to';
$titanium_lang_new[$titanium_module_name]['UPLOAD'] 						= 'Upload an Image';
$titanium_lang_new[$titanium_module_name]['UPLOADED'] 					= 'Uploaded';
$titanium_lang_new[$titanium_module_name]['USER']							= 'User';
$titanium_lang_new[$titanium_module_name]['USERS'] 						= 'Manage User(s)';
$titanium_lang_new[$titanium_module_name]['USER_ADMINISTRATION']			= 'User Administration';
$titanium_lang_new[$titanium_module_name]['VERSION'] 						= 'Version & Changelog';
$titanium_lang_new[$titanium_module_name]['VIEW'] 						= 'View Image';
//-------------------------------------------------------------------------
//	LANGUAGE DEFINES FOR THE COLOR SELECTION MENU
//-------------------------------------------------------------------------
$titanium_lang_new[$titanium_module_name]['AQUA']							= 'Aqua';
$titanium_lang_new[$titanium_module_name]['AQUAMARINE']					= 'Aquamarine';
$titanium_lang_new[$titanium_module_name]['BLACK']						= 'Black';
$titanium_lang_new[$titanium_module_name]['BLACK_DEFAULT']				= 'Black (Default)';
$titanium_lang_new[$titanium_module_name]['BLUE']							= 'Blue';
$titanium_lang_new[$titanium_module_name]['BROWN']						= 'Brown';
$titanium_lang_new[$titanium_module_name]['CADETBLUE']					= 'Cadet Blue';
$titanium_lang_new[$titanium_module_name]['CHOCOLATE']					= 'Chocolate';
$titanium_lang_new[$titanium_module_name]['CHARTREUSE']					= 'Chartreuse';
$titanium_lang_new[$titanium_module_name]['CRIMSON']						= 'Crimson';
$titanium_lang_new[$titanium_module_name]['CYAN']							= 'Cyan';
$titanium_lang_new[$titanium_module_name]['DARKBLUE']						= 'Dark Blue';
$titanium_lang_new[$titanium_module_name]['DARKGOLDEN']					= 'Dark Golden Rod';
$titanium_lang_new[$titanium_module_name]['DARKGREEN']					= 'Dark Green';
$titanium_lang_new[$titanium_module_name]['DARKMAGENTA']					= 'Dark Magenta';
$titanium_lang_new[$titanium_module_name]['DARKORCHID']					= 'Dark Orchid';
$titanium_lang_new[$titanium_module_name]['DARKRED']						= 'Dark Red';
$titanium_lang_new[$titanium_module_name]['DARKSKY']						= 'Deep Sky Blue';
$titanium_lang_new[$titanium_module_name]['DODGERBLUE']					= 'Dodger Blue';
$titanium_lang_new[$titanium_module_name]['FIREBRICK']					= 'Fire Brick';
$titanium_lang_new[$titanium_module_name]['FUCHSIA']						= 'Fuchsia';
$titanium_lang_new[$titanium_module_name]['GOLD']							= 'Gold';
$titanium_lang_new[$titanium_module_name]['GOLDROD']						= 'Golden Rod';
$titanium_lang_new[$titanium_module_name]['GREY']							= 'Grey';
$titanium_lang_new[$titanium_module_name]['GREEN']						= 'Green';
$titanium_lang_new[$titanium_module_name]['GREEN_DEFAULT']				= 'Green (Default)';
$titanium_lang_new[$titanium_module_name]['INDIGO']						= 'Indigo';
$titanium_lang_new[$titanium_module_name]['LAWNGREEN']					= 'LawnGreen';
$titanium_lang_new[$titanium_module_name]['LIME']							= 'Lime';
$titanium_lang_new[$titanium_module_name]['LIMEGREEN']					= 'Lime Green';
$titanium_lang_new[$titanium_module_name]['MAGENTA']						= 'Magenta';
$titanium_lang_new[$titanium_module_name]['MIDNIGHTBLUE']					= 'Midnight Blue';
$titanium_lang_new[$titanium_module_name]['OLIVE']						= 'Olive';
$titanium_lang_new[$titanium_module_name]['ORANGE']						= 'Orange';
$titanium_lang_new[$titanium_module_name]['ORANGERED']					= 'Orange Red';
$titanium_lang_new[$titanium_module_name]['PLUM']							= 'Plum';
$titanium_lang_new[$titanium_module_name]['PURPLE']						= 'Purple';
$titanium_lang_new[$titanium_module_name]['RED']							= 'Red';
$titanium_lang_new[$titanium_module_name]['SADDLE']						= 'Saddle Brown';
$titanium_lang_new[$titanium_module_name]['SALMON']						= 'Salmon';
$titanium_lang_new[$titanium_module_name]['SEAGREEN']						= 'Sea Green';
$titanium_lang_new[$titanium_module_name]['BLUESLATE']					= 'Slate Blue';
$titanium_lang_new[$titanium_module_name]['TEAL']							= 'Teal';
$titanium_lang_new[$titanium_module_name]['TOMATO']						= 'Tomato';
$titanium_lang_new[$titanium_module_name]['VIOLET']						= 'Violet';
$titanium_lang_new[$titanium_module_name]['WHITE']						= 'White';
$titanium_lang_new[$titanium_module_name]['WHITE_DEFAULT']				= 'White (Default)';
$titanium_lang_new[$titanium_module_name]['YELLOW']						= 'Yellow';
//-------------------------------------------------------------------------
//	LANGUAGE DEFINES FOR THE COLOR SELECTION MENU
//-------------------------------------------------------------------------
?>