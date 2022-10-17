<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
/* Titanium Portal Menu                                                 */
/* By: The 86it Developers Network                                      */
/* https://www.86it.us                                                  */
/* Copyright (c) 2019 Ernest Buffington                                 */
/************************************************************************/
define('_MENU_THANKS', '<br><br>Thanks for using this script. This mod was created by Ernest Allen Buffington, &copy; <a href="https://www.86it.us" target="_blank">The 86it Developers Network</a>.');
define('_MENU_INSTALL','I see that you don\'t have the Menu Tables installed yet!<br>With your permission, let us proceed to install the Menu Tables.<br>All you need to do is agree by checking the box below and clicking install, the script will do the rest.');
define('_MENU_INSTALL2','This is the auto install for the Portal Menu v5.01');
define('_MENU_INSTALL3','');
define('_MENU_INSTALLING', 'I am currently performing the database installation, please don\'t change the page while I am installing. This will take a moment!');
define('_MENU_COMPLETE', 'The installation is now complete. I will redirect you back to the module in a few moments.');
define('_MENU_INSERT_TABLE', 'Now we create the table.');
define('_MENU_INSERT_DATA', 'Now we insert the data.');
/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
-=[Mod]=-
	  Titanium Patched                         v3.0.0       08/28/2019
 ************************************************************************/
define("_MENU_CATEGORIES","Menu Categories");
define("_MENU_IMGNEWTITLE","Click to Show/Hide the NEW icon");
define("_CLICK_TO_CHOOSE_IMAGE","Click to choose an image for this category");
define("_CLICK_TO_CHOOSE_IMAGECAT","Click to choose an image for this link");
define("_MENU_JSFIXFORIE1","The drop-down lists below disappear on Internet Explorer. This is NORMAL : it's a workaround to avoid an IE bug. For the sake of the web and a better internet experience, please use another browser (Opera, Firefox,...)");
define("_MENU_HIDE","Hide");
define("_MENU_MOVEUP","Click to move the link upwards");
define("_MENU_MOVEDOWN","Click to move the link downwards");
define("_MENU_REMOVESUBLEVEL","Click to remove this sublevel");
define("_MENU_ADDSUBLEVEL","Click to add a sublevel");
define("_MENU_SCHEDULETITLE","Schedule the display");
define("_MENU_SCHEDULE","Click to hide or schedule the display");
define("_MENU_TEXTONLY","Text without url");
define("_MENU_MONDAY","Monday");
define("_MENU_TUESDAY","Tuesday");
define("_MENU_WEDNESDAY","Wednesday");
define("_MENU_THURSDAY","Thursday");
define("_MENU_FRIDAY","Friday");
define("_MENU_SATURDAY","Saturday");
define("_MENU_SUNDAY","Sunday");
define("_MENU_DISPLAYFROM","Display from");
define("_MENU_DISPLAYTO","to");
define("_MENU_SCHEDULEIT","Schedule");
define("_MENU_DISPLAYONLYTHESEDAYS","Only on");
define("_MENU_SHOWADMIN","Extended Administrator view");
define("_ALWAYS_OPEN","Always open");
define("_MENU_CENTER25","Center");
define("_MENU__ADMIN_HEADER","PHP-Nuke Titanium Portal Menu :: Admin Panel");
define("_MENU__RETURNMAIN","Return to Main Administration");
define("_MENU","Portal Menu");
define("_MENU_ADMINTITLE","<strong>Administration Menu</strong>");
define("_MENU_MSGNOTNUM","The value of this field must be numeric, please modify.");
define("_MENU_MSGVOID","You must enter a value for this field !");
define("_MENU_WEIGHT","Weight");
define("_MENU_CATNAME","Category's name");
define("_MENU_IMGNAME","Image file's name");
define("_MENU_CATLINK","Link on this category");
define("_MENU_CATMODS","Modules in this category");
define("_MENU_NOIMG","[No image]");
define("_MENU_CENTER","Center title");
define("_MENU_BGCOLOR","Background color");
define("_MENU_EXTLINK","External link");
define("_MENU_MISEENPAGE","Display");
define("_TARGETBLANK","Open in a new window");
define("_MENU_ACTION","Action");
define("_MENU_SUPPR","[Delete]");
define("_MENU_ADDCAT","Add a new category");
define("_MENU_NEWCATEGORY","Add a new category :");
define("_MENU_CANCEL","RESET TEXT");
define("_MENU_POST","SAVE YOUR MODIFICATIONS");
define("_MENU_REMARKS","<strong>Remarks :</strong><br /><br />"
    ."- The WEIGHT is used to order categories (categories with a lower WEIGHT are displayed first). [number between 0 and 98]<br /><br />"
    ."- You can create a category without a name : in this case, the image will not be displayed.<br />"
    ."&nbsp;&nbsp;(useful if you are using only horizontal rules to separate categories)<br /><br />"
    ."- The IMAGE FILE'S NAME (for the category) is an image file inside /images/menu/. You can also put a FLASH file (.swf)."
    ."<br />&nbsp;&nbsp;The IMAGE (for category's content) is an image file inside /images/menu/categories/."
    ."<br />&nbsp;&nbsp;When you add an image file in these folders, it is automatically added in its list box.<br />"
    ."&nbsp;&nbsp;If you don't want to display an image before a category's name, put 'null.gif' (transparent 20x20 px image) in the field.<br /><br />"
    ."- THE LINK ON THE CATEGORY could be any internet url or an url relative to your site.<br />"
    ."&nbsp;&nbsp;If you put an external link (beginnning with 'http://' or 'ftp://'), the link will be opened in a new window.<br />"
    ."&nbsp;&nbsp;If you put a relative url ('modules.php?name=Your_Account&op=new_user'), the link will open in the current window.<br />"
    ."&nbsp;&nbsp;To open an internal link in a new window, put the exact, full  url of your site.<br />"
    ."&nbsp;&nbsp;To open an external link in the current window, type 'HTTP://' (in uppercase).<br /><br />"
    ."- The BACKGROUND COLOR must be a color code or a standard color name.<br />"
    ."&nbsp;&nbsp;ex: 'red' : <span color=\"red\">RED</span>  --  '#ff0000' : <span color=\"#ff0000\">RED</span><br /><br />"
    ."- The CLASS used to display categories' names must be an existing class in all your themes.<br />"
    ."&nbsp;&nbsp;The classes are in the file /themes/YOURTHEME/style/style.css.<br />"
    ."&nbsp;&nbsp;You can add your own class, for example you can add this line in the style sheets of your themes :<br />"
    ."&nbsp;&nbsp;<i>.menu        {FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px; COLOR: #363636; FONT-WEIGHT: bold}   </i><br />");
define("_MENU_CATCONTENT","Category's content");
define("_MENU_LINKURL","link's URL");
define("_MENU_LINKTEXT","link's text");
define("_MENU_IMAGE","Image");
define("_MENU_INVALIDWEIGHT","The WEIGHT value is invalid for the category");
define("_MENU_MUSTBENUM"," This value MUST be a number between 0 and 98 !!");
define("_MENU_CATS","The categories");
define("_MENU_AND","and");
define("_MENU_SAMEWEIGHT","have the same WEIGHT !!");
define("_MENU_MODIFWEIGHT","Return back to the previous page and modify the WEIGHT value of one of these categories.");
define("_MENU_BACKADMIN","Back to Menu administration");
define("_MENU_SUCCESS","Your block has been successfully updated !");
define("_MENU_GOADMIN","Configure your Menu");
define("_MENU_UPGRADESUCCESS","Your Menu was successfully upgraded !!");
define("_MENU_V1DETECTED","Titanium Portal Menu v.1.0 detected !");
define("_MENU_CLICKTOUPGRADE","To upgrade your menu, click");
define("_MENU_HERE","HERE");
define("_MENU_WARNINGDELETECAT","Are you sure you want to delete the category");
define("_MENU_GENERALOPTIONS","General Options");
define("_MENU_DISPLAYMEMBERSONLYMODULES","Display of 'members only' modules");
define("_MENU_CATEGORIESCLASS","Class for categories' names");
define("_MENU_DISPLAYMODULENORMAL","Normal (always displayed)");
define("_MENU_DISPLAYMODULEWITHICON","Displayed with icon");
define("_MENU_DISPLAYMODULEWITHICONFORVISTORS","for visitors");
define("_MENU_DISPLAYMODULEINVISIBLE","Invisible for visitors");
define ("_MENU_YES","Yes");
define ("_MENU_NO","No");
define("_MENU_REMARKSTWO","<br />- You can create a popup, to do so, enter in the field 'url' of external link :<br />"
        ."&nbsp;&nbsp;<i>javascript:window.open('http://www.url.com','popup_menu','directories=no,menubar=no,status=no,location=no,scrollbars=no,resizable=no')</i><br />"
        ."<br />&nbsp;&nbsp;You can modify display options (display scrollbars, etc...)<br />"
        ."&nbsp;&nbsp;See <a href=\"http://javascript.about.com/od/popupwindows/Popup_Windows.htm\"  target=\"_tab\">JavaScript.About.Com</a> for more information.<br /><br />");
define("_MENU_HR","Horizontal Rule");
define("_MENU_BOLD","Bold");
define("_MENU_LISTBOX","Drop down box");
define("_MENU_SENDTOHAVEMORE","Save your modifications to add new links.");
define("_MENU_DISPLAYCLASSES","Display :");
define("_MENU_MODULESCLASS","CSS class used for modules/external links");
define("_MENU_AUTODETECTNEW","Automatic detection of news");
define("_MENU_SINCE","New for");
define("_MENU_NBDAYS","days");
define("_MENU_DYNAMICMENU","Dynamic menu");
define("_MENU_JSSAVEBEFORE","You are about to delete this category, continue?"); 
define("_MENU_EDITLINKTITLE","Edit a link...");
define("_MENU_MOREOPTIONS","More options");
define("_MENU_CLASS","CSS class");
define("_MENU_ATTENTIONMOREOPTIONS","<strong>Attention !</strong><br />If you modify in menu's admin panel the general CSS class for categories, or for modules/links, or the time 'New!' icon is displayed, the specific values of a category or a module/link will be overwritten.");
define("_MENU_MOREOPTIONSUCCESS","Your modifications are applied !");
define("_MENU_SENDTOVALIDATE","(You should validate all modifications in the main menu panel for your modifications to be finally confirmed)");
define("_MENU_CLOSE","Close the window");
define("_MENU_TARGETBLANK","Link opened in a new window. To open in the same window, begin url with HTTP:// (uppercase)");
define("_MENU_TARGETNONE","Link opened in the same window. To open in a new window, begin url with http:// (lowercase)");
define("_MENU_NOTABLEPB","Titanium Portal Menu is unable to access its database tables.Please verify that you have installed correctly, and READ THE FAQ !");
define("_MENU_ATTNSUPPRCAT","<strong>Portal Menu</strong>");
?>
