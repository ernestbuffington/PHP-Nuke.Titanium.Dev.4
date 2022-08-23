<?php
/************************************************************************/
/* Discord Block				                                        */
/* ==============================                                       */
/*                                                                      */
/* Copyright (c) 2003 - 2018 coRpSE	                                    */
/* http://www.headshotdomain.net                                        */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
define('_DISCORD_BLOCK','Discord Block Settings');
define('_DISCORD_MAINADMIN','Return to Main Administration');
define('_DISCORD_JSON','Discord Json URL:');
define('_DISCORD_LOGO','Discords Logo:');
define('_DISCORD_SHOWEMPTY', 'Display Empty Channels:');
define('_DISCORD_Z1','Name/Channels/Stats');
define('_DISCORD_Z2','Usernames/Title/Join Button Text:');
define('_DISCORD_Z3','Join Button Color');
define('_DISCORD_Z4','Join Button Text: Hover:');
define('_DISCORD_Z5','Join Button/Scrollbar: Hover:');
define('_DISCORD_Z6','Heading/Online/Users Background:');
define('_DISCORD_Z7','Channel Body Background:');
define('_DISCORD_Z8', 'Border Color:');
define('_DISCORD_Z8B', 'Border Width:');
define('_DISCORD_PX', 'px');
define('_DISCORD_ADMIN', 'Admins To Display:');
define('_DISCORD_DARK','Dark');
define('_DISCORD_LIGHT','Light');
define('_DISCORD_DEFAULT','Discord Blue');
define('_DISCORD_YES', 'Yes');
define('_DISCORD_NO', 'No');
define('_DISCORD_SUBMIT','SUBMIT');
define('_DISCORD_HIGHLIGHT', '<H3>EVERYTHING IN PINK IS WHAT IS CHANGED.</H3>');
define('_DISCORD_HELP_Z1', 'Here you can edit the font color of the servername, the server title, and the Channel names.');
define('_DISCORD_HELP_Z2', 'Here you can edit the font color of the Join Server button and the Usernames.');
define('_DISCORD_HELP_Z3', 'Here you can edit the background color of the "Join Server" button. This is <em>NOT</em> when you mouse over color.');
define('_DISCORD_HELP_Z4', 'Here you can edit the font color of the "Join Server" button when they are hovering over the button. Be sure to use <em>contrasting</em> colors to the next selection, "Join Button/Scrollbar: Hover". This way you can easily read the text when your mouse is over the button.');
define('_DISCORD_HELP_Z5', 'Here you can edit the colors of the "Join Server", (mouse over), button and the scrollbar. Just note, this color is the background color of the Join button when mouse if over the button only.');
define('_DISCORD_HELP_Z6', 'Here you can edit the main body colors of the Heading, Online, and Users backgrounds.');
define('_DISCORD_HELP_Z7', 'Here you can edit the channel body background color. Best to have it slightly lighter or darker than the previous option.');
define('_DISCORD_HELP_Z8', '<strong>Border Color:</strong> Here you edit the color of all the borders on the system. All borders are affected by both the color here and the width below.<br><br><strong>Border Width:</strong> Here you can use the slider to select how thing you want the border. Just note that I did limit it to just 0px - 3px.<br><strong><em>0px = NO border at all.</em></strong><br><br><h3 style="color:#F00;"><strong>NOTE:</strong> If your are using Internet Explorer, the visable number value will NOT change when you adjust the slider.<br> Recommended to find a better browser to use, there are plenty of free browsers to choose from that are much faster then IE. Win 10 users, best to use Edge if your not running Chrome, Firefox, ect..., instead.');
define('_DISCORD_HELP_ADMIN', 'Here is where you will input all the admins ID numbers. To get the ID for the users, while in Discord, right click on the user name that you want to add and select copy user ID, then come back to here and paste it in. <br> You will need to have advanced mode on, so go to this link to learn to get user ID numbers and turn on advanced mode: <a href="https://support.discordapp.com/hc/en-us/articles/206346498-Where-can-I-find-my-User-Server-Message-ID-" target="_blank">https://support.discordapp.com/hc/ ...</a><br><br> <h3 style="color:#F00;"><strong>NOTE:</strong>Make sure you separate each number by a comma followed by a space, (, ).</h3><br>Example: 123456789, 987654321, 112233445<br><br>I know a few of you asked for the ability to have it automated, or if I could write it by the names displayed, but I did this purposely so it\'s less likely that someone would try to come in and pretend to be someone they arn\'t. As for the Automated, if Discord adds in a way via the json file, then I will, but till then, I can\'t.');
define('_DISCORD_RESET', 'RESET TO DEFAULT');
define('_DISCORD_RESET_C', 'I understand this will change all my current<br>color settings back to the default settings.');
define('_DISCORD_THANKS', '<br><br>Thanks for using this script. This mod was created by coRpSE, &copy; <a href="https://www.headshotdomain.net" target="_blank">HeadShotDomain.net</a>.<br>Special thanks to SpOrAdiC of <a href="http://www.aa-hq.com/index.php" target="_blank">www.aa-hq.com</a> for testing, giving feedback, and giving ideas to improve this system.<br>Also, special thanks to Lonestar of <a href="https://lonestar-modules.com" target="_blank">lonestar-modules.com</a> for helping a little with the jQuery and for some suggestions.');
define('_DISCORD_ICONS', 'Mueted/Deafen Icon Color:');
define('_DISCORD_INSTALL','I see that you don\'t have this currently installed on your site.<br>With your permissions, I like to proceed to install this for you.<br>All you need to do is agree by checking the box below and clicking install, and I will take care of the rest.');
define('_DISCORD_INSTALL2','The reason I am asking you to agree to install before I proceed is because I will delete the table if there is one already and I want you to know that before you proceed.');
define('_DISCORD_INSTALL3','I also wanted to inform you though this script is reading the info from your Discords servers API and no information except for the URL to the API is being stored on your website.<br>There may be some mods/bots that may come out to allow you to show more information, but this system will never store any sensitive information that could jeopardize your Discords server.');
define('_DISCORD_INSTALLING', 'I am currently performing the database installation, please don\'t change page while I am installing. This will take a few seconds');
define('_DISCORD_COMPLETE', 'Installation is now complete. I will redirect you back to the module in a few moments.');
define('_DISCORD_BINSTALL', 'INSTALL');
define('_DISCORD_BAGREE', 'I agree to allow this system to install.');
define('_DISCORD_DROPTABLE', 'Checking if table existed. . . <br>If there was one, it\'s not there anymore.<br>');
define('_DISCORD_SKIPPED', 'I\'m sorry, I can not allow you to skip the first step. Please go back and do it right.');
define('_DISCORD_GOBACK', 'GO BACK');
define('_DISCORD_WARNING', '<span style="color:#FF0000; font-size:22px; font-weight:900;">!!!WARNING!!!</span> - Once you click Install, don\'t click anything until it brings you to the config page.');
define('_DISCORD_SUPPORT', 'A lot of work and time went into developing this script so you can use it for free.<br>Please help support us if you can by donating to our site.<br>Every little bit helps.');
define('_DISCORD_INSERT_TABLE', 'Lets put in a fresh table.');
define('_DISCORD_INSERT_DATA', 'Lets put in data into our fresh table.');
define('_DISCORD_TABLE_FOUND', '<br><span style="color:#FF0000; font-size:22px; font-weight:900;">!!!WARNING #2!!!</span> - I see that you already have the discord table there, are you sure you like me to proceed to install? You will loose all info in the current table.<br><br>');
?>