<?php
/************************************************************************/
/* Nuke HoneyPot - Antibot Script                                       */
/* ==============================                                       */
/*                                                                      */
/* Copyright (c) 2013 coRpSE			                                */
/* http://www.headshotdomain.net                                        */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


define_once('_HONEYPOT_MAIN','Nuke HoneyPot V2.2 - Antispam');
define_once('_HONEYPOT_BOTLIST','Honeypot Bot List');
define_once('_HONEYPOT_CONFIG','Honeypot Config');
define_once('_HONEYPOT_CONFIGAREA','Honeypot Configuration Area');
define_once('_HONEYPOT_MAINADMIN','Return to Main Administration');
define_once('_HONEYPOT_ID','ID#');
define_once('_HONEYPOT_IP','IP Address');
define_once('_HONEYPOT_DATETIME','Date &amp; Time');
define_once('_HONEYPOT_CAUGHTBY','Caught By');
define_once('_HONEYPOT_REASON','Reason');
define_once('_HONEYPOT_DELETE','Delete');
define_once('_HONEYPOT_DELETELIST','Delete List');
define_once('_HONEYPOT_DELETESELECTED','Delete Selected');
define_once('_HONEYPOT_ADDITIONALINFO','Additional Information');
define_once('_HONEYPOT_PREV','Prev');
define_once('_HONEYPOT_NEXT','Next');
define_once('_HONEYPOT_WAITSCRIPT','Wait Script');
define_once('_HONEYPOT_TEXTREMOVALSCRIPT','Text Removal Script');
define_once('_HONEYPOT_HIDDENTEXTFIELD','Hidden Text Field');
define_once('_HONEYPOT_CUSTOMQUESTION','Custom Question Check');
define_once('_HONEYPOT_SFSCHECK','SFS API Check');
define_once('_HONEYPOT_INSTALLCHECK','Nuke HoneyPot - Install Checker');
define_once('_HONEYPOT_INSTALLCHECKFAIL','Please Delete The installer For Security Purpose!');
define_once('_HONEYPOT_SAVE','Save Info');
define_once('_HONEYPOT_CHECKALL','Check All');
define_once('_HONEYPOT_DELETEALL_ANCHOR','Are you sure you want to delete ALL the caught bots?');
define_once('_HONEYPOT_DELETESELECTED_ANCHOR','Are you sure you want to delete the selected bots?');
define_once('_HONEYPOT_TRYAGAIN','Try again!');
define_once('_HONEYPOT_START','Let us start it!');
define_once('_HONEYPOT_GOBACKANDTRYAGAIN','Go back and try again.');
define_once('_HONEYPOT_DONE','done');
define_once('_HONEYPOT_DEL','Delete');
define_once('_HONEYPOT_FAIL','failed');
define_once('_HONEYPOT_ANSWEREDWITH','Answered with');
define_once('_HONEYPOT_DONTANSWER','Don\'t Answer!');
define_once('_HONEYPOT_WHATIS','What is');
define_once('_HONEYPOT_DELETEALLTEXT','Delete All Of This Text!');
define_once('_HONEYPOT_PLEASEDONTCLICK','please do not click Continue for');
define_once('_HONEYPOT_SECONDS','second(s)');
define_once('_HONEYPOT_ANTIBOTWAIT','Antibot wait');
define_once('_HONEYPOT_COUNTDOWNDONE','All done! You can click Continue at anytime!');
define_once('_HONEYPOT_ANTIBOT','A n t i B o t');
define_once('_HONEYPOT_SETTINGS','Nuke HoneyPot - Settings');
define_once('_HONEYPOT_ITEMSPERPAGE','Bots per page:');
define_once('_HONEYPOT_PAGERPOSITION','Pager-Position:');
define_once('_HONEYPOT_POSITIONTOP','top');
define_once('_HONEYPOT_POSITIONBOTTOM','bottom');
define_once('_HONEYPOT_POSITIONBOTH','both');
define_once('_HONEYPOT_HEADCOLOR','Head-Color:');
define_once('_HONEYPOT_ROWCOLOR1','Row-Color 1:');
define_once('_HONEYPOT_ROWCOLOR2','Row-Color 2:');
define_once('_HONEYPOT_PAGEBGCOLOR','Page Background Color:');
define_once('_HONEYPOT_PAGEBORDERCOLOR','Page Border / Glow color:');
define_once('_HONEYPOT_WAITYACOUNTERSEC','Waiting-Seconds for Your_Account Counter');
define_once('_HONEYPOT_BRBETWEENTABLES','br-tags between CloseTable() and OpenTable()');
define_once('_HONEYPOT_YOUAREABOT','You took less than ');
define_once('_HONEYPOT_YOUAREABOT2',' seconds to complete the form, We think your a bot...');
define_once('_HONEYPOT_YOUSHOULDHAVEDEL','You should have deleted');
define_once('_HONEYPOT_ANDLEFTITBLANK','and left it blank!');
define_once('_HONEYPOT_YOUHAVEFAILED','You failed the bot test!');
define_once('_HONEYPOT_USERNAME','Username (used)');
define_once('_HONEYPOT_REALNAME','Realname (used)');
define_once('_HONEYPOT_EMAIL','Email (used)');
define_once('_HONRYPOT_ONLY_IP_EMAIL','Only Search by Email or IP. Try using exact email & ip.');
define_once('_HONEYPOT_NO_CONTENT','There currently is no content to display.');
define_once('_HONEYPOT_EMPTY_SEARCH','Your search results turned up empty.');
define_once('_HONEYPOT_USE','Use Honeypot:');
define_once('_HONEYPOT_LISTING','Bot Listing:');
define_once('_HONEYPOT_ACSEND','Acscending');
define_once('_HONEYPOT_DESCENDING','Descending');
define_once('_HONEYPOT_ON','Honeypot On');
define_once('_HONEYPOT_OFF','Honeypot Off');
define_once('_HONEYPOT_YES','Yes');
define_once('_HONEYPOT_NO','No');
define_once('_HONEYPOT_CHECK1','Use Hidden Check:');
define_once('_HONEYPOT_CHECK2','Use Text Removal Check:');
define_once('_HONEYPOT_CHECK3','Use Time Submit Check:');
define_once('_HONEYPOT_CHECK3TIME','Time Check Wait Time:');
define_once('_HONEYPOT_CHECK4','Use Question Check:');
define_once('_HONEYPOT_QUESTIONCHECK_FAILED','You Failed the question check. Please try again.');
define_once('_HONEYPOT_CHECK4QUESTION','Question Check:<br><i>Be creative and make sure its something easy to get and not easily searchable on a search site like Google.</i><br><br><a href="javascript:void(0)" onclick="document.getElementById(\'light\').style.display=\'block\';document.getElementById(\'fade\').style.display=\'block\'"><strong>Click Here</strong></a> for some examples.');
define_once('_HONEYPOT_CHECK_5_AND_6','SFS Blacklist Check:<br>Check email or ip against stopforumsspam.com<br>email and ip blacklist API');
define_once('_HONEYPOT_CHECK7','Use Local Blacklist:<br><i>Check to see if the person has tried to register before and failed with the info supplied.</i>');
define_once('_HONEYPOT_CHECK7OPTIONS','Local Blacklist Options:<br>Choose which you like to check their info against.');
define_once('_HONEYPOT_WHITELISTEMAIL','Email Used');
define_once('_HONEYPOT_WHITELISTEIP','IP #');
define_once('_HONEYPOT_WHITELISTCOUNT','Local Blacklist Count:<br>How many times a person can show in the list before it stops them from registering with the info they are trying to use. <i>(between 2 and 50)</i>');
define_once('_HONEYPOT_BL_MESSAGE_START_1','The IP you are using has been blocked by the Nuke HoneyPot blacklist.<br>');
define_once('_HONEYPOT_BL_MESSAGE_END_1','</em></strong> times for failed attempts to register.<br><br>To fix this, you need to contact the administration of this site and ask them to remove your IP from the system before you can continue registering.<br>You can also ask them if they can help you register if you continue having issues.');
define_once('_HONEYPOT_BL_MESSAGE_START_2','The Email you are using has been blocked by the Nuke HoneyPot blacklist.<br>');
define_once('_HONEYPOT_BL_MESSAGE_END_2',' </em></strong> times for failed attempts to register.<br><br>To fix this, you need to contact the administration of this site and ask them to remove your Email from the system before you can continue registering.<br>You can also ask them if they can help you register if you continue having issues.');
define_once('_HONEYPOT_BL_MESSAGE_START','The Email and IP you are using has been blocked by the Nuke HoneyPot blacklist.');
define_once('_HONEYPOT_BL_MESSAGE_END',' To fix this, you need to contact the administration of this site and ask them to remove your Email & IP from the system before you can continue registering.<br> You can also ask them if they can help you register if you continue having issues.');
define_once('_HONEYPOT_BL_INFO_NEEDED','<br><br><em>Please, when you contact the administration, plese supply them with the reason why you were blocked from registering and give them either your Email, Ip, or both, depending on what you were blocked for. They can\'t help you without that information.</em>');
define_once('_HONEYPOT_BL_MESSAGE_EMAILOF','Your Email of <strong><em>');
define_once('_HONEYPOT_BL_MESSAGE_IPOF','Your Ip of <strong><em>');
define_once('_HONEYPOT_BL_MESSAGE_ISFOUND','</em></strong> is found in our system <strong><em>');
define_once('_HONEYPOT_BL_MESSAGE_TIMESFAILED','</em></strong> times for failed attempts to register.');
define_once('_HONEYPOT_LIMIT','<i>*(255 Character Limit)</i>');
define_once('_HONEYPOT_CHECK4ANSWER','Question Check Answer:<br><i>Don\'t worry about case sensitivity, this system is not case sensitive.</i>');
define_once('_HONEYPOT_FEEDBACK','Use Feedback Module:<br><i>This is for those that may have issues and need to contact you. Must have the feedback module activated. If you don\'t use this, the email WILL be used instead.</i>');
define_once('_HONEYPOT_FEEDBACK1','FeedBack Module');
define_once('_HONEYPOT_FEEDBACK2','Email');
define_once('_HONEYPOT_SUBMITTEDIN','Submitted in');
define_once('_HONEYPOT_ADMIN_EMAIL','Admin Email:<br><i>Only needed if FeedBack Module is not being used.</i>');
define_once('_HONEYPOT_DONTUSE','Don\'t Use');
define_once('_HONEYPOT_FEEDBACKMODULE','If you have difficulty registering, feel free to contact us through our Feedback system.<br><a href="./modules.php?name=Feedback" target="_blank"><strong>CLICK HERE</strong></a> to submit a ticket to the admin.');
define_once('_HONEYPOT_FEEDBACKEMAIL1','If you have difficulty registering, feel free to email the admin.<br><a href="mailto:');
define_once('_HONEYPOT_FEEDBACKEMAIL2','?subject=Problem Registering on your site">Send Email to ');
define_once('_HONEYPOT_FEEDBACKEMAIL3','</a> for support.');
define_once('_HONEYPOT_SEC','Sec.');
define_once('_HONEYPOT_SFS_API_CHECK','SFS marked as bot');
define_once('_HONEYPOT_SFS_API_BLOCKED','Your IP or EMAIL has been detected in the stopforumspam.com API and you have been flagged as a bot.');
define_once('_HONEYPOT_EXAMPLE','<strong>EXAMPLE:</strong><br> Using my site, www.headshotdomain.net for an example;<br><br>
 Q: What are the first three and last three characters of this board\'s URL? <br> A: heaain<br><br>another would be:<br><br>Q: Grass is to lawn as __________ is to forest.<br>A: tree ');
define_once('_HONEYPOT_CHECK8OPTIONS','BotScout Blacklist Check:<br>Check email or ip against BotScouts API.<br><i><b>Note:</b> Only 20 checks allowed per day without using a API Key Read below on how to obtain one.</i>');
define_once('_HONEYPOT_BSEMAIL','Email Check');
define_once('_HONEYPOT_BSIP','IP Check');
define_once('_HONEYPOT_BSAPIKEY','BotScout API key:<br>To obtain a BotScout API key to go from 20/day checks to 300/day checks, click the button. Its free.');
define_once('_HONEYPOT_BSUSEAPIKEY','Use BotScout API key:');
define_once('_HONEYPOT_BSAPITEST','Test the API key if it is working. It should look something like this:<br><hr><center><b>Y|MULTI|IP|0|MAIL|108|NAME|187</b></center><hr> If it doesn\'t, make sure the API key is copied correctly.');
define_once('_HONEYPOT_BSAPITESTBUTTONP','Click to test API');
define_once('_HONEYPOT_BSAPITESTBUTTONT','TEST API');
define_once('_HONEYPOT_BSAPIKEYBUTTON','Click to get API Key');
define_once('_HONEYPOT_BSREASON','EMAIL or IP marked as bot.');
define_once('_HONEYPOT_BS_BLOCKED','Your EMAIL or IP has been detected in the BotScout.com API and you have been flagged as a bot.<br>We do not have control to remove you from thier API, You will need to contact them to be removed from their API.');
define_once('_HONEYPOT_BSCHECK','BotScout API');
define_once('_HONEYPOT_CHECK9OPTIONS','FSpamlist Blacklist Check:<br>Check email or ip against FSpamlist API.<br><i><b>Note:</b> To use this, you do need a valid API Key. Read below on how to obtain one.</i>');
define_once('_HONEYPOT_FSAPIKEY','FSpamlist API key:<br>To use FSpam API, you must register for a API. To obtain a FSpam API key, click the button. Its free.');
define_once('_HONEYPOT_FSAPITEST','Test the API key if it is working. It should look something like this:<br><hr>');
define_once('_HONEYPOT_FSAPITEST2','<hr> If it doesn\'t, make sure the API key is copied correctly.');
define_once('_HONEYPOT_FSAPIKEYBUTTON','Click to get API Key');
define_once('_HONEYPOT_FS_BLOCKED','Your EMAIL or IP has been detected in the fspamlist.com API and you have been flagged as a bot.<br>We do not have control to remove you from thier API, You will need to contact them to be removed from their API.');
define_once('_HONEYPOT_FSCHECK','FSpamlist API');
define_once('_HONEYPOT_YOURVERSION','Your version of the Honeypot is v');
define_once('_HONEYPOT_YOURVERSION1',' and the latest version is v');
define_once('_HONEYPOT_YOURVERSION2','<br>You should update your HP script.');
define_once('_HONEYPOT_LATESTVERSION','You have the Latest version of the HonePot. - v');
define_once('_HONEYPOT_VERSIONCHECK','HoneyPot Version Checker');
define_once('_HONEYPOT_CHANGELOG','<a href="javascript:void(0)" onclick="document.getElementById(\'updateinfo\').style.display=\'block\';document.getElementById(\'fade\').style.display=\'block\'"><strong>Click Here to see change log.</strong></a>');
define_once('_HONEYPOT_FONTCOLOR','Main Text Color:');
define_once('_HONEYPOT_FONTCOLOR2','Header/Column Title color:');
define_once('_HP_XML_ERROR','Unable to parse the XML<br />Need CUrl or fopen to be allowed.');