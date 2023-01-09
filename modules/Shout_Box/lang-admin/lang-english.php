<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


// ==========================================
// PHP-NUKE: Shout Box
// ==========================
//
// Copyright (c) 2003-2005 by Aric Bolf (SuperCat)
// http://www.OurScripts.net
//
// This program is free software. You can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation
// ===========================================

define_once("_SHOUT_ADMIN_HEADER","ShotBox Admin Panel");
define_once("_SHOUT_RETURNMAIN","Return to Main Administration");
define_once("_SHOUTADMIN","Shout Box administration");
define_once("_MANAGESHOUTS","Manage shouts");
define_once("_SB_LAYOUT","Layout");
define_once("_SB_THEMEING","Themeing");
define_once("_SB_PERMISSIONS","Permissions");
define_once("_SB_EMOTICONS","Emoticons");
define_once("_SB_CENSOR","Censor");
define_once("_SB_BANS","Bans");
define_once("_SB_NICKNAME","Nickname");
define_once("_SB_SHOUT","Shout");
define_once("_SB_DATE","Date");
define_once("_SB_TIME","Time");
define_once("_DELETE","Delete");
define_once("_EDIT","Edit");
define_once("_BAN","Ban");
define_once("_SB_BANNED","Banned");
define_once("_VIEWINGSHOUTS","Viewing shouts");
define_once("_TOTALSHOUTS","Total shouts");
define_once("_PREVIOUS","Previous");
define_once("_PAGE","Page");
define_once("_NEXT","Next");
define_once("_REMOVECHECKEDSHOUTS","Remove checked shouts");
define_once("_SB_PRUNESHOUTS","Prune Shouts");
define_once("_SB_SHOUTSPRUNED","shouts pruned");
define_once("_SB_PRUNESHOUTSOLDERTHAN","Prune shouts older than");
define_once("_SB_DAYS","days");
define_once("_SB_DOPRUNE","Do Prune");
define_once("_SB_STICKYSHOUTS","Sticky Shouts");
define_once("_SB_SUBMIT","Submit");
define_once("_EDITSHOUT","Edit Shout");
define_once("_SB_NOTE","Note");
define_once("_UPDATE","Update");
define_once("_CANCELEDIT","Cancel edit");
define_once("_SHOUTTOOSHORT","Shout too short.");
define_once("_SHOUTTOOLONG","Shout too long.");
define_once("_NOSHOUT","No shout.");
define_once("_SB_MESSAGE","Message");
define_once("_XXXBLOCKED",".XXX URLs blocked");
define_once("_JSINSHOUT","JavaScript in shout.");
define_once("_URLNOTALLOWED","URL not allowed");
define_once("_DISPLAYDATEANDTIMEOFSHOUT","Display date and time of shout");
define_once("_NO","No");
define_once("_YES","Yes");
define_once("_DATEANDTIMEFORMATFORANONYMOUSUSERS","Time and date format for anonymous users");
define_once("_HOUR","Hour");
define_once("_TIMEZONEOFSERVER","Timezone of server");
define_once("_TIMEOFFSET","Time offset from server time");
define_once("_INHOURS","in hours");
define_once("_NUMBEROFSHOUTSINBLOCK","Number of shouts shown in Shout Box");
define_once("_NUMBEROFSHOUTSINHISTORY","Number of shouts per page shown in Shout History");
define_once("_TABLEHEIGHT","Table Height");
define_once("_BLOCKINPUTBOXWIDTH","Block input box width");
define_once("_SMILIESPERROW","Smilies per row within the drop");
define_once("_SHOUTSORDER","Shouts display order");
define_once("_OLDESTFIRST","Oldest first");
define_once("_NEWESTFIRST","Newest first");
define_once("_POINTSPERSHOUT","Points earned per shout");
define_once("_SAVEABOVESET","Save above settings");
define_once("_SAVESETS","Save settings");
define_once("_SB_VERSION","Shout Box version");
define_once("_SB_NEW_VERSION_RELEASED","A new version of the Shout Box has been released!");
define_once("_SB_YOUR_VERSION","Your current version is");
define_once("_SB_NEWEST_VERSION","The newest version is");
define_once("_SB_DOWNLOAD_NOW","Download it now");
define_once("_SB_SHOUTBOX_IS_UPTODATE","The Shout Box is up to date.");
define_once("_SB_CHECK_FOR_NEW","Check for a new version");
define_once("_SETUPANDSECURITY","Setup and Security monitor");
define_once("_CURRENTCOND","Current condition");
define_once("_SBEXCELLENT","Excellent");
define_once("_SBMARGINAL","Marginal");
define_once("_SBCRITICAL","Critical");
define_once("_ANALYZEANDVIEW","Analyze system and view recommendations");
define_once("_SB_THEMECOLORING","Theme coloring");
define_once("_SB_THEME","Theme");
define_once("_SHOUTBOX","Shout Box");
define_once("_SB_BORDER","Border");
define_once("_SB_MENU","Menu");
define_once("_SB_ROW","Row");
define_once("_SB_SAVECOLORVALUES","Save color values");
define_once("_SB_HELPWITHCOLORS","Help with colors");
define_once("_SB_THEMEIMAGES","Theme Images");
define_once("_SB_BOXARROWS","Box Arrows");
define_once("_SB_BOXBACKGROUND","Box Background");
define_once("_SB_SAVEIMAGEVALUES","Save image values");
define_once("_ALLOWANONURLTAGS","Allow URLs from anonymous users");
define_once("_ALLOWREGURLTAGS","Allow URLs from registered users");
define_once("_SB_BLOCKXXX","Block shouts containing .xxx URLs");
define_once("_ALLOWREGDELETE","Allow registered users to edit/delete their posts");
define_once("_ALLOWANONSSHOUT","Allow anonymous visitors to shout");
define_once("_EMOTICON","Emoticon");
define_once("_BBAREMOVE","Remove");
define_once("_ADDEMOTICON","Add Emoticon");
define_once("_IMAGESOURCE","Image source");
define_once("_CENSORTEXTONOFF","Censor text in Shout Box [on/off]");
define_once("_CENSOR","censor");
define_once("_EDITCENSOR","Edit censor");
define_once("_REPLACEMENT","Replacement");
define_once("_WORDTOCENSOR","Word to Censor");
define_once("_REPLACEWITH","Replace Censored work with");
define_once("_BANIPONOFF","Ban from posting by IP [on/off]");
define_once("_BANNAMEONOFF","Ban from posting by name [on/off]");
define_once("_ADDIPTOBAN","Add IP to ban from posting");
define_once("_BANNEDIP","Banned IP");
define_once("_EDITADDRESS","Edit address");
define_once("_IPBANNED","IP banned from posting");
define_once("_UPDATEIP","Update IP");
define_once("_ADDNAMETOBAN","Add Name to ban from posting");
define_once("_ADD","Add");
define_once("_BANNEDNAMES","Banned names");
define_once("_EDITNAME","Edit name");
define_once("_NAMEBANNED","Name banned from posting");
define_once("_UPDATENAME","Update name");

?>