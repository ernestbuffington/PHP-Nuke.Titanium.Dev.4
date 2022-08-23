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


define('_HONEYPOT_MAIN','Nuke HoneyPot V2.2 - Antispam');
define('_HONEYPOT_BOTLIST','Honeypot Bot List');
define('_HONEYPOT_CONFIG','Honeypot Config');
define('_HONEYPOT_CONFIGAREA','Honeypot Configuration Area');
define('_HONEYPOT_MAINADMIN','Return to Main Administration');
define('_HONEYPOT_ID','ID#');
define('_HONEYPOT_IP','IP Address');
define('_HONEYPOT_DATETIME','Date &amp; Time');
define('_HONEYPOT_CAUGHTBY','Caught By');
define('_HONEYPOT_REASON','Reason');
define('_HONEYPOT_DELETE','Delete');
define('_HONEYPOT_DELETELIST','Delete List');
define('_HONEYPOT_DELETESELECTED','Delete Selected');
define('_HONEYPOT_ADDITIONALINFO','Additional Information');
define('_HONEYPOT_PREV','Prev');
define('_HONEYPOT_NEXT','Next');
define('_HONEYPOT_WAITSCRIPT','Wait Script');
define('_HONEYPOT_TEXTREMOVALSCRIPT','Text Removal Script');
define('_HONEYPOT_HIDDENTEXTFIELD','Hidden Text Field');
define('_HONEYPOT_CUSTOMQUESTION','Custom Question Check');
define('_HONEYPOT_SFSCHECK','SFS API Check');
define('_HONEYPOT_INSTALLCHECK','Nuke HoneyPot - Install Checker');
define('_HONEYPOT_INSTALLCHECKFAIL','Please Delete The installer For Security Purpose!');
define('_HONEYPOT_SAVE','Save Info');
define('_HONEYPOT_CHECKALL','Check All');
define('_HONEYPOT_DELETEALL_ANCHOR','Are you sure you want to delete ALL the caught bots?');
define('_HONEYPOT_DELETESELECTED_ANCHOR','Are you sure you want to delete the selected bots?');
define('_HONEYPOT_TRYAGAIN','Try again!');
define('_HONEYPOT_START','Let us start it!');
define('_HONEYPOT_GOBACKANDTRYAGAIN','Go back and try again.');
define('_HONEYPOT_DONE','done');
define('_HONEYPOT_DEL','Delete');
define('_HONEYPOT_FAIL','failed');
define('_HONEYPOT_ANSWEREDWITH','Answered with');
define('_HONEYPOT_DONTANSWER','Don\'t Answer!');
define('_HONEYPOT_WHATIS','What is');
define('_HONEYPOT_DELETEALLTEXT','Delete All Of This Text!');
define('_HONEYPOT_PLEASEDONTCLICK','please do not click Continue for');
define('_HONEYPOT_SECONDS','second(s)');
define('_HONEYPOT_ANTIBOTWAIT','Antibot wait');
define('_HONEYPOT_COUNTDOWNDONE','All done! You can click Continue at anytime!');
define('_HONEYPOT_ANTIBOT','A n t i B o t');
define('_HONEYPOT_SETTINGS','Nuke HoneyPot - Settings');
define('_HONEYPOT_ITEMSPERPAGE','Bots per page:');
define('_HONEYPOT_PAGERPOSITION','Pager-Position:');
define('_HONEYPOT_POSITIONTOP','top');
define('_HONEYPOT_POSITIONBOTTOM','bottom');
define('_HONEYPOT_POSITIONBOTH','both');
define('_HONEYPOT_HEADCOLOR','Head-Color:');
define('_HONEYPOT_ROWCOLOR1','Row-Color 1:');
define('_HONEYPOT_ROWCOLOR2','Row-Color 2:');
define('_HONEYPOT_PAGEBGCOLOR','Page Background Color:');
define('_HONEYPOT_PAGEBORDERCOLOR','Page Border / Glow color:');
define('_HONEYPOT_WAITYACOUNTERSEC','Waiting-Seconds for Your_Account Counter');
define('_HONEYPOT_BRBETWEENTABLES','br-tags between CloseTable() and OpenTable()');
define('_HONEYPOT_YOUAREABOT','You took less than ');
define('_HONEYPOT_YOUAREABOT2',' seconds to complete the form, We think your a bot...');
define('_HONEYPOT_YOUSHOULDHAVEDEL','You should have deleted');
define('_HONEYPOT_ANDLEFTITBLANK','and left it blank!');
define('_HONEYPOT_YOUHAVEFAILED','You failed the bot test!');
define('_HONEYPOT_USERNAME','Username (used)');
define('_HONEYPOT_REALNAME','Realname (used)');
define('_HONEYPOT_EMAIL','Email (used)');
define('_HONRYPOT_ONLY_IP_EMAIL','Only Search by Email or IP. Try using exact email & ip.');
define('_HONEYPOT_NO_CONTENT','There currently is no content to display.');
define('_HONEYPOT_EMPTY_SEARCH','Your search results turned up empty.');
define('_HONEYPOT_USE','Use Honeypot:');
define('_HONEYPOT_LISTING','Bot Listing:');
define('_HONEYPOT_ACSEND','Acscending');
define('_HONEYPOT_DESCENDING','Descending');
define('_HONEYPOT_ON','Honeypot On');
define('_HONEYPOT_OFF','Honeypot Off');
define('_HONEYPOT_YES','Yes');
define('_HONEYPOT_NO','No');
define('_HONEYPOT_CHECK1','Use Hidden Check:');
define('_HONEYPOT_CHECK2','Use Text Removal Check:');
define('_HONEYPOT_CHECK3','Use Time Submit Check:');
define('_HONEYPOT_CHECK3TIME','Time Check Wait Time:');
define('_HONEYPOT_CHECK4','Use Question Check:');
define('_HONEYPOT_QUESTIONCHECK_FAILED','You Failed the question check. Please try again.');
define('_HONEYPOT_CHECK4QUESTION','Question Check:<br><i>Be creative and make sure its something easy to get and not easily searchable on a search site like Google.</i><br><br><a href="javascript:void(0)" onclick="document.getElementById(\'light\').style.display=\'block\';document.getElementById(\'fade\').style.display=\'block\'"><strong>Click Here</strong></a> for some examples.');
define('_HONEYPOT_CHECK_5_AND_6','SFS Blacklist Check:<br>Check email or ip against stopforumsspam.com<br>email and ip blacklist API');
define('_HONEYPOT_CHECK7','Use Local Blacklist:<br><i>Check to see if the person has tried to register before and failed with the info supplied.</i>');
define('_HONEYPOT_CHECK7OPTIONS','Local Blacklist Options:<br>Choose which you like to check their info against.');
define('_HONEYPOT_WHITELISTEMAIL','Email Used');
define('_HONEYPOT_WHITELISTEIP','IP #');
define('_HONEYPOT_WHITELISTCOUNT','Local Blacklist Count:<br>How many times a person can show in the list before it stops them from registering with the info they are trying to use. <i>(between 2 and 50)</i>');
define('_HONEYPOT_BL_MESSAGE_START_1','The IP you are using has been blocked by the Nuke HoneyPot blacklist.<br>');
define('_HONEYPOT_BL_MESSAGE_END_1','</em></strong> times for failed attempts to register.<br><br>To fix this, you need to contact the administration of this site and ask them to remove your IP from the system before you can continue registering.<br>You can also ask them if they can help you register if you continue having issues.');
define('_HONEYPOT_BL_MESSAGE_START_2','The Email you are using has been blocked by the Nuke HoneyPot blacklist.<br>');
define('_HONEYPOT_BL_MESSAGE_END_2',' </em></strong> times for failed attempts to register.<br><br>To fix this, you need to contact the administration of this site and ask them to remove your Email from the system before you can continue registering.<br>You can also ask them if they can help you register if you continue having issues.');
define('_HONEYPOT_BL_MESSAGE_START','The Email and IP you are using has been blocked by the Nuke HoneyPot blacklist.');
define('_HONEYPOT_BL_MESSAGE_END',' To fix this, you need to contact the administration of this site and ask them to remove your Email & IP from the system before you can continue registering.<br> You can also ask them if they can help you register if you continue having issues.');
define('_HONEYPOT_BL_INFO_NEEDED','<br><br><em>Please, when you contact the administration, plese supply them with the reason why you were blocked from registering and give them either your Email, Ip, or both, depending on what you were blocked for. They can\'t help you without that information.</em>');
define('_HONEYPOT_BL_MESSAGE_EMAILOF','Your Email of <strong><em>');
define('_HONEYPOT_BL_MESSAGE_IPOF','Your Ip of <strong><em>');
define('_HONEYPOT_BL_MESSAGE_ISFOUND','</em></strong> is found in our system <strong><em>');
define('_HONEYPOT_BL_MESSAGE_TIMESFAILED','</em></strong> times for failed attempts to register.');
define('_HONEYPOT_LIMIT','<i>*(255 Character Limit)</i>');
define('_HONEYPOT_CHECK4ANSWER','Question Check Answer:<br><i>Don\'t worry about case sensitivity, this system is not case sensitive.</i>');
define('_HONEYPOT_FEEDBACK','Use Feedback Module:<br><i>This is for those that may have issues and need to contact you. Must have the feedback module activated. If you don\'t use this, the email WILL be used instead.</i>');
define('_HONEYPOT_FEEDBACK1','FeedBack Module');
define('_HONEYPOT_FEEDBACK2','Email');
define('_HONEYPOT_SUBMITTEDIN','Submitted in');
define('_HONEYPOT_ADMIN_EMAIL','Admin Email:<br><i>Only needed if FeedBack Module is not being used.</i>');
define('_HONEYPOT_DONTUSE','Don\'t Use');
define('_HONEYPOT_FEEDBACKMODULE','If you have difficulty registering, feel free to contact us through our Feedback system.<br><a href="./modules.php?name=Feedback" target="_blank"><strong>CLICK HERE</strong></a> to submit a ticket to the admin.');
define('_HONEYPOT_FEEDBACKEMAIL1','If you have difficulty registering, feel free to email the admin.<br><a href="mailto:');
define('_HONEYPOT_FEEDBACKEMAIL2','?subject=Problem Registering on your site">Send Email to ');
define('_HONEYPOT_FEEDBACKEMAIL3','</a> for support.');
define('_HONEYPOT_SEC','Sec.');
define('_HONEYPOT_SFS_API_CHECK','SFS marked as bot');
define('_HONEYPOT_SFS_API_BLOCKED','Your IP or EMAIL has been detected in the stopforumspam.com API and you have been flagged as a bot.');
define('_HONEYPOT_EXAMPLE','<strong>EXAMPLE:</strong><br> Using my site, www.headshotdomain.net for an example;<br><br>
 Q: What are the first three and last three characters of this board\'s URL? <br> A: heaain<br><br>another would be:<br><br>Q: Grass is to lawn as __________ is to forest.<br>A: tree ');
define('_HONEYPOT_CHECK8OPTIONS','BotScout Blacklist Check:<br>Check email or ip against BotScouts API.<br><i><b>Note:</b> Only 20 checks allowed per day without using a API Key Read below on how to obtain one.</i>');
define('_HONEYPOT_BSEMAIL','Email Check');
define('_HONEYPOT_BSIP','IP Check');
define('_HONEYPOT_BSAPIKEY','BotScout API key:<br>To obtain a BotScout API key to go from 20/day checks to 300/day checks, click the button. Its free.');
define('_HONEYPOT_BSUSEAPIKEY','Use BotScout API key:');
define('_HONEYPOT_BSAPITEST','Test the API key if it is working. It should look something like this:<br><hr><center><b>Y|MULTI|IP|0|MAIL|108|NAME|187</b></center><hr> If it doesn\'t, make sure the API key is copied correctly.');
define('_HONEYPOT_BSAPITESTBUTTONP','Click to test API');
define('_HONEYPOT_BSAPITESTBUTTONT','TEST API');
define('_HONEYPOT_BSAPIKEYBUTTON','Click to get API Key');
define('_HONEYPOT_BSREASON','EMAIL or IP marked as bot.');
define('_HONEYPOT_BS_BLOCKED','Your EMAIL or IP has been detected in the BotScout.com API and you have been flagged as a bot.<br>We do not have control to remove you from thier API, You will need to contact them to be removed from their API.');
define('_HONEYPOT_BSCHECK','BotScout API');
define('_HONEYPOT_CHECK9OPTIONS','FSpamlist Blacklist Check:<br>Check email or ip against FSpamlist API.<br><i><b>Note:</b> To use this, you do need a valid API Key. Read below on how to obtain one.</i>');
define('_HONEYPOT_FSAPIKEY','FSpamlist API key:<br>To use FSpam API, you must register for a API. To obtain a FSpam API key, click the button. Its free.');
define('_HONEYPOT_FSAPITEST','Test the API key if it is working. It should look something like this:<br><hr>');
define('_HONEYPOT_FSAPITEST2','<hr> If it doesn\'t, make sure the API key is copied correctly.');
define('_HONEYPOT_FSAPIKEYBUTTON','Click to get API Key');
define('_HONEYPOT_FS_BLOCKED','Your EMAIL or IP has been detected in the fspamlist.com API and you have been flagged as a bot.<br>We do not have control to remove you from thier API, You will need to contact them to be removed from their API.');
define('_HONEYPOT_FSCHECK','FSpamlist API');
define('_HONEYPOT_YOURVERSION','Your version of the Honeypot is v');
define('_HONEYPOT_YOURVERSION1',' and the latest version is v');
define('_HONEYPOT_YOURVERSION2','<br>You should update your HP script.');
define('_HONEYPOT_LATESTVERSION','You have the Latest version of the HonePot. - v');
define('_HONEYPOT_VERSIONCHECK','HoneyPot Version Checker');
define('_HONEYPOT_CHANGELOG','<a href="javascript:void(0)" onclick="document.getElementById(\'updateinfo\').style.display=\'block\';document.getElementById(\'fade\').style.display=\'block\'"><strong>Click Here to see change log.</strong></a>');
define('_HONEYPOT_FONTCOLOR','Main Text Color:');
define('_HONEYPOT_FONTCOLOR2','Header/Column Title color:');
define('_HP_XML_ERROR','Unable to parse the XML<br />Need CUrl or fopen to be allowed.');