<?php
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
/************************************************************************/
/* HTML Newsletter 1.0 module for PHP-Nuke 6.5 - 7.6                    */
/* By: NukeWorks (webmaster@nukeworks.biz)                              */
/* http://www.nukeworks.com                                             */
/* Copyright © 2004 by NukeWorks                                        */
/* License: GNU/GPL                                                     */
/************************************************************************/
/************************************************************************
* HTML Newsletter 1.1 - 1.2 module for PHP-Nuke 6.5 - 7.6
* By: NukeWorks (mangaman@nukeworks.biz & montego@montegoscripts.com)
* http://www.nukeworks.biz
* Copyright © 2004, 2005 by NukeWorks
* License: GNU/GPL
************************************************************************/
/************************************************************************
* Script:			HTML Newsletter module for PHP-Nuke 6.5 - 7.6
* Version:		01.03.01
* Author:			Rob Herder (aka: montego) of montegoscripts.com
* Contact:		montego@montegoscripts.com
* Copyright:	Copyright © 2006 by Montego Scripts
* License:		GNU/GPL (see provided LICENSE.txt file)
************************************************************************/

/*************************************************************************
* All attempts are made to place defines into the Function and Section
* on the screen where it is used as well as in the order of placement on
* the screen reading left-to-right and then top-down.  In cases where a
* define is used on multiple screens, it may only be defined once, so the
* first Function/Section: will have the define in it.
************************************************************************/

/************************************************************************
* Function: General Use Defines
************************************************************************/

define("_MSNL_COM_LAB_MODULENAME",				"HTML Newsletter");
define("_MSNL_LAB_ADMIN",									"Administration");

//Module Menu Labels and Link Titles

define("_MSNL_LAB_CREATENL",							"Create&nbsp;Newsletter");
define("_MSNL_LAB_MAINCFG",								"Main&nbsp;Config");
define("_MSNL_LAB_CATEGORYCFG",						"Category&nbsp;Config");
define("_MSNL_LAB_MAINTAINNLS",						"Maintain&nbsp;Newsletters");
define("_MSNL_LAB_SENDTESTED",						"Send&nbsp;Tested");
define("_MSNL_LAB_SITEADMIN",							"Site&nbsp;Administration");
define("_MSNL_LAB_NLARCHIVES",						"Archives");
define("_MSNL_LAB_NLDOCS",								"On-Line&nbsp;Documentation");

define("_MSNL_LNK_CREATENL",							"Create a newsletter");
define("_MSNL_LNK_MAINCFG",								"Configure module options");
define("_MSNL_LNK_CATEGORYCFG",						"Maintain list of newsletter categories");
define("_MSNL_LNK_MAINTAINNLS",						"Maintain existing newsletters");
define("_MSNL_LNK_SENDTESTED",						"Send the last tested newsletter");
define("_MSNL_LNK_SITEADMIN",							"Go to overall site administration menu");
define("_MSNL_LNK_NLARCHIVES",						"Go to list of newsletter archives");
define("_MSNL_LNK_NLDOCS",								"Go to on-line HTML Newsletter documentation");

define("_MSNL_ERR_NOTAUTHORIZED",					"You are not authorized to administer this module");

//For module functions.php (not admin functions.php)

define("_MSNL_COM_ERR_SQL",								"ENCOUNTERED ERROR IN SQL");
define("_MSNL_COM_ERR_MODULE",						"ERROR IN MODULE");
define("_MSNL_COM_ERR_VALMSG",						"THE FOLLOWING FIELDS FAILED VALIDATION");
define("_MSNL_COM_ERR_VALWARNMSG",				"THE FOLLOWING FIELDS HAD WARNINGS");
define("_MSNL_COM_ERR_DBGETCFG", 					"Failed to get module configuration information!");

//Common use Defines

define("_MSNL_COM_LAB_ACTIONS",						"Actions");
define("_MSNL_COM_LAB_ACTIVE",						"Active");
define("_MSNL_COM_LAB_ADD",								"ADD");
define("_MSNL_COM_LAB_ALL",								"ALL");
define("_MSNL_COM_LAB_GO",								"GO");
define("_MSNL_COM_LAB_INACTIVE",					"Inactive");
define("_MSNL_COM_LAB_LANG",							"Language");
define("_MSNL_COM_LAB_NO",								"No");
define("_MSNL_COM_LAB_PREVIEW",						"Preview");
define("_MSNL_COM_LAB_SAVE",							"SAVE");
define("_MSNL_COM_LAB_SHOW_ALL",					"**Show All**");
define("_MSNL_COM_LAB_SEND",							"Send");
define("_MSNL_COM_LAB_VERSION",						"Version");
define("_MSNL_COM_LAB_YES",								"Yes");

define("_MSNL_COM_LNK_ADD",								"Click to add the above data");
define("_MSNL_COM_LNK_CANCEL",						"Cancel transaction");
define("_MSNL_COM_LNK_CONTINUE",					"Continue with transaction");
define("_MSNL_COM_LNK_SAVE",							"Click to save any changes to the above data");
define("_MSNL_COM_LNK_SEND",							"Send newsletter");
define("_MSNL_COM_LNK_PREVIEW",						"Validate and Preview newsletter");

define("_MSNL_COM_ERR_SQL",								"SQL");
define("_MSNL_COM_ERR_MSG",								"ERROR MSG");
define("_MSNL_COM_ERR_DBGETCATS",					"Failed to get newsletter categories");
define("_MSNL_COM_ERR_FILENOTEXIST",			"File does not exist");
define("_MSNL_COM_ERR_DBGETPHPBB",				"Unable to get phpBB board config information");
define("_MSNL_COM_ERR_DBGETRECIPIENTS",		"Unable to get number of recipients for:");

define("_MSNL_COM_MSG_WARNING",						"Warning!");
define("_MSNL_COM_MSG_UPDSUCCESS",				"Update Was Successfull!");
define("_MSNL_COM_MSG_ADDSUCCESS",				"Add Was Successfull!");
define("_MSNL_COM_MSG_DELSUCCESS",				"Delete Was Successfull!");
define("_MSNL_COM_MSG_REQUIRED",					"Required field must be given a value");
define("_MSNL_COM_MSG_POSNONZEROINT",			"Requires a positive non-zero integer value");

define("_MSNL_COM_HLP_ACTIONS",						"Hover the cursor "
	."over each icon below to see what action is going to be taken if it is clicked."
	);

/************************************************************************
* Function: msnl_admin  (Create Newsletter)
************************************************************************/

//Section: Letter

define("_MSNL_ADM_LAB_LETTER",						"Letter");
define("_MSNL_ADM_LAB_TOPIC",							"Topic");
define("_MSNL_ADM_LAB_SENDER",						"Sender's Name");
define("_MSNL_ADM_LAB_NLSCAT",						"Category");
define("_MSNL_ADM_LAB_TEXTBODY",					"Newsletter Text");
define("_MSNL_ADM_LAB_HTMLOK",						"(HTML Tags are allowed)");

define("_MSNL_ADM_HLP_TOPIC", 				"This text replaces the {EMAILTOPIC} tag in the "
	."chosen template.  Since this tag is usually on a line with other tags, it would be "
	."best to keep it short and to the point - say 40 characters or less.  Only the following "
	."HTML tags are allowed in this field: & lt;b& gt; & lt;i& gt; & lt;u& gt;."
	);
define("_MSNL_ADM_HLP_SENDER", 				"This text replaces the {SENDER} tag in the "
	."chosen template.  Since this tag is usually on a line with other tags, it would be "
	."best to keep it short and personal - say, less than 20 characters.  Only the following "
	."HTML tags are allowed in this field: & lt;b& gt; & lt;i& gt; & lt;u& gt;."
	);
define("_MSNL_ADM_HLP_NLSCAT", 				"Simply choose the newsletter category to place "
	."this newsletter into.  Newsletter categories can be used to organize site newsletters "
	."into specific key topic areas.  Newsletters can be listed under their respective "
	."categories using a configuration switch under admin function Main Configuration."
	);
define("_MSNL_ADM_HLP_TEXTBODY",					"This is where the main text of your newsletter "
	."will go. It probably makes sense to write your HTML content elsewhere in a good WYSIWYG "
	."editor until it is as you want it to be, and then copy-and-paste the HTML into this text "
	."area. This HTML text will replace the {TEXTBODY} tag in the chosen template.<br /><br />"
	."HTML tags are allowed, but it would be wise to consider your recipient's email readers "
	."and target browsers (for the archives) to ensure the best possible results for all.  <br /><br /> "
	."For long newsletter text, you may wish to use anchor tags to <b>mark</b> "
	."certain sections.  Give them descriptive names and then check the <b>Include Table of "
	."Contents</b> checkbox below and these anchors will become links within the Table of "
	."Contents within your newsletter! <br /><br />For example, one could use: "
	."<b>& lt;a name=\"Section One\"& gt;& lt;/a& gt;</b>. <b>NOTE:</b> Must be EXACTLY as shown "
	."with double quotes AND the closing anchor tag! This example would produce a link called "
	."<b>Section One</b> within the Table of Contents and upon clicking it, would take "
	."the viewer to the anchor within the text."
	);

//Section: Templates

define("_MSNL_ADM_LAB_TEMPLATES",					"Templates");
define("_MSNL_ADM_LAB_CHOOSETMPLT",				"Choose a Template");

define("_MSNL_ADM_LNK_SHOWTEMPLATE",			"Click to display sample image of template");

define("_MSNL_ADM_HLP_TEMPLATES",					"The list below is derived from the current "
	."set of template directories under your modules/HTML_Newsletter/templates/ directory. "
	."If you elect to go with <b>no template</b>, the system will simply send to your recipients "
	."an email with the text you entered above in the <b>Newsletter Text</b> text area.<br /><br />"
	."To create a newsletter from a template, select one from the list.  To see a sample of what "
	."your selected newsletter will look like, click on the <b>View</b> icon to the right of "
	."the template name text.<br /><br />You can also create your own templates and place them "
	."in the templates directory.  <b>Hint:</b> pattern off of Fancy_Content as this is the "
	."only sample template that the author of this tool will be continually upgrading with new "
	."HTML Newsletter module releases!"
	);

//Section: Stats and Newsletter Contents

define("_MSNL_ADM_LAB_STATS",							"Stats and Newsletter Contents");
define("_MSNL_ADM_LAB_INCLSTATS",					"Include Site Stats");
define("_MSNL_ADM_LAB_INCLTOC",						"Include Table of Contents");

define("_MSNL_ADM_HLP_INCLSTATS",					"Checking this option will include your site's "
	."key statistics in templates which have the {STATS} tag in them.  See the template samples "
	."above to get an idea what statistics will be shown."
	);
define("_MSNL_ADM_HLP_INCLTOC",						"Checking this option will include a Table of "
	."Contents 'block' in templates which have the {TOC} tag in them - e.g., see template sample "
	."for Fancy_Content.  The TOC block will have links to each of the blocks of <b>Latest xxxxxx</b> "
	."as well as links to any <b>anchors</b> included within the <b>Newsletter Text</b> text area."
	);

//Section: Include Latest Items

define("_MSNL_ADM_LAB_INCLLATEST",				"Include Latest Items");
define("_MSNL_ADM_LAB_INCLLATESTDLS",			"Latest Downloads Items");
define("_MSNL_ADM_LAB_INCLLATESTWLS",			"Latest Web-Links Items");
define("_MSNL_ADM_LAB_INCLLATESTFORS",		"Latest Forums Items");
define("_MSNL_ADM_LAB_INCLLATESTNEWS",		"Latest News Items");
define("_MSNL_ADM_LAB_INCLLATESTREVS",		"Latest Review Items");

define("_MSNL_ADM_HLP_INCLLATESTNEWS",		"Controls the number of latest articles to show in the "
	."newsletter.  The articles will be in chronological order starting with the most recent one "
	."first. Use a value of 0 (zero) to not show the Latest News information in the newsletter. "
	."Values entered here are retained from newsletter to newsletter, but you can change them "
	."at any time for any newsletter."
	);
define("_MSNL_ADM_HLP_INCLLATESTDLS",			"Controls the number of latest downloads to show in the "
	."newsletter.  The downloads will be in chronological order starting with the most recent one "
	."first. Use a value of 0 (zero) to not show the Latest Downloads information in the newsletter. "
	."Values entered here are retained from newsletter to newsletter, but you can change them "
	."at any time for any newsletter."
	);
define("_MSNL_ADM_HLP_INCLLATESTWLS",			"Controls the number of latest web links to show in the "
	."newsletter.  The web links will be in chronological order starting with the most recent one "
	."first. Use a value of 0 (zero) to not show the Latest Web Links information in the newsletter. "
	."Values entered here are retained from newsletter to newsletter, but you can change them "
	."at any time for any newsletter."
	);
define("_MSNL_ADM_HLP_INCLLATESTFORS",		"Controls the number of latest forum posts to show in the "
	."newsletter.  The forum posts will be in chronological order starting with the most recent one "
	."first. Use a value of 0 (zero) to not show the Latest Forum Posts information in the newsletter. "
	."Values entered here are retained from newsletter to newsletter, but you can change them "
	."at any time for any newsletter.  In addition, only publically available (read) forums have "
	."their posts displayed."
	);
define("_MSNL_ADM_HLP_INCLLATESTREVS",		"Controls the number of latest reviews to show in the "
	."newsletter.  The reviews will be in chronological order starting with the most recent one "
	."first. Use a value of 0 (zero) to not show the Latest Reviews information in the newsletter. "
	."Values entered here are retained from newsletter to newsletter, but you can change them "
	."at any time for any newsletter."
	);

//Section: Sponsors

define("_MSNL_ADM_LAB_SPONSORS",					"Sponsors");
define("_MSNL_ADM_LAB_CHOOSESPONSOR",			"Choose a Sponsor");
define("_MSNL_ADM_LAB_NOSPONSOR",					"No sponsor");

define("_MSNL_ADM_HLP_CHOOSESPONSOR",			"Choosing a sponsor will replace the {BANNER} tag "
	."in the newsletter template file with the selected image, link and alternate text from "
	."the banners system"
	);

define("_MSNL_ADM_ERR_DBGETBANNERS",			"Failed to get sponsor banner information");

//Section: Who to Send the Newsletter To

define("_MSNL_ADM_LAB_WHOSNDTO",					"Who do you want the Newsletter to be sent to?");
define("_MSNL_ADM_LAB_CHOOSESENDTO",			"Choose recipient(s) option");

define("_MSNL_ADM_LAB_WHOSNDTONLSUBS",		"Newsletter subscribers only");
define("_MSNL_ADM_LAB_WHOSNDTOALLREG",		"ALL registered users");
define("_MSNL_ADM_LAB_WHOSNDTOPAID",			"Paid subscribers only");
define("_MSNL_ADM_LAB_WHOSNDTOANONY",			"ALL site visitors - NO email is sent, but "
	."any visitor can view the newsletter"
	);
define("_MSNL_ADM_LAB_WHOSNDTONSNGRPS",		"One or more NSN Groups - choose group(s) below");
define("_MSNL_ADM_LAB_WHOSNDTOADM",				"Test email (to Admin ONLY)");
define("_MSNL_ADM_LAB_SUBSCRIBEDUSRS",		"subscribed users");
define("_MSNL_ADM_LAB_USERS",							"Users");
define("_MSNL_ADM_LAB_PAIDUSRS",					"paid users");
define("_MSNL_ADM_LAB_NSNGRPUSRS",				"NSN Group users");
define("_MSNL_ADM_LAB_WHOSNDTOADHOC",			"Ad-Hoc email distribution list");
define("_MSNL_ADM_LAB_WHOSNDTOANONYV",		"ALL site visitors");

define("_MSNL_ADM_HLP_WHOSNDTONLSUBS",		"Choosing this option will send the newsletter "
	."to all your nuke users which have subscribed to your site's newsletter through their "
	."account preferences."
	);
define("_MSNL_ADM_HLP_WHOSNDTOALLREG",		"Choosing this option will send the newsletter "
	."to all of your registered users.  Be careful using this option as your users may not "
	."appreciate having a newsletter sent to them for which they did not ask for."
	);
define("_MSNL_ADM_HLP_WHOSNDTOPAID",			"Choosing this option will send the newsletter "
	."to all of your site's paid subscribers - i.e., those with active subscriptions."
	);
define("_MSNL_ADM_HLP_NSNGRPUSRS",				"Choosing this option will allow you to select "
	."one or more NSN Groups below to have the newsletter sent to."
	);
define("_MSNL_ADM_HLP_WHOSNDTOANONYV",		"Choosing this option will NOT send a newsletter "
	."but, rather, will display the newsletter within the block and archives. However, do "
	."keep in mind that block and module permissions still must be set as desired."
	);
define("_MSNL_ADM_HLP_WHOSNDTOADM",				"Choosing this option will send a test newsletter "
	."to YOU - a site admin - ONLY. Once you have validated that the newsletter is ready to "
	."be sent to your intended recipients, use the <b>Send Tested</b> link towards the "
	."top of this page."
	);
define("_MSNL_ADM_HLP_WHOSNDTOADHOC",			"Choosing this option will allow you to send the "
	."newsletter to one or more email addresses of your choosing.  You must simply separate "
	."each address with a comma AND you MUST ensure that the addresses are valid."
	);

//Section: NSN Groups

define("_MSNL_ADM_LAB_CHOOSENSNGRP",			"Which NSN Group(s) to send to?");
define("_MSNL_ADM_LAB_CHOOSENSNGRP1",			"(selection will be ignored if NSN Group option "
	."not chosen above)"
	);
define("_MSNL_ADM_LAB_WHONSNGRP",					"Choose one or more groups");

define("_MSNL_ADM_ERR_DBGETNSNGRPS",			"Unable to get NSN Groups information");

define("_MSNL_ADM_HLP_CHOOSENSNGRPUSRS",	"Choose one or more groups below. The newsletter "
	."will be sent to all the nuke users that are in the group(s) that are chosen.  If a user is "
	."in more than one group, the newsletter will only be sent to them once."
	);

/************************************************************************
* Function: msnl_admin_preview  (Create Newsletter --> Preview)
************************************************************************/

define("_MSNL_ADM_PREV_LAB_VALPREVNL",		"Create Newsletter - Validate and Preview");
define("_MSNL_ADM_PREV_LAB_PREVNL",				"Preview Newsletter");

define("_MSNL_ADM_PREV_MSG_SUCCESS",			"Newsletter passed all validation and is ready "
	."for previewing below");

/************************************************************************
* Function: msnl_admin  (Create Newsletter --> admin_check_post.php)
************************************************************************/

define("_MSNL_ADM_LAB_NSNGRPS",						"NSN Groups");

define("_MSNL_ADM_VAL_NONSNGRP",					"You have chosen to send to a NSN Group but "
	."have not selected a group to send to"
	);

define("_MSNL_ADM_ERR_NOTEMPLATE",				"Possible hack attempt - no template chosen");
define("_MSNL_ADM_ERR_NOSENDTO",					"Possible hack attempt - no Send To option chosen");

define("_MSNL_ADM_ERR_DBUPDLATEST",				"Had error on updating 'Latest _____' configuration information");

/************************************************************************
* Function: msnl_admin (Create Newsletter --> admin_send_mail.php)
************************************************************************/

define("_MSNL_ADM_SEND_LAB_SENDNL",				"Create Newsletter - Send Mail");
define("_MSNL_ADM_SEND_LAB_TESTNLFROM",		"Test Newsletter from");
define("_MSNL_ADM_SEND_LAB_NLFROM",				"Newsletter from");

define("_MSNL_ADM_SEND_MSG_ANONYMOUS",		"Newsletter was added for ALL visitors to view");
define("_MSNL_ADM_SEND_MSG_LOTSSENT",			"More than 500 users will receive the "
	."newsletter, this can take 10 minutes or more and PHP may time-out."
	);
define("_MSNL_ADM_SEND_MSG_TOTALSENT",		"Total Emails Sent");
define("_MSNL_ADM_SEND_MSG_SENDSUCCESS",	"Newsletter emails sent successfully");
define("_MSNL_ADM_SEND_MSG_SENDFAILURE",	"Newsletter email sends failed");

define("_MSNL_ADM_SEND_ERR_NOTESTEMAIL",	"Could not find testemail.php file");
define("_MSNL_ADM_SEND_ERR_INVALIDVIEW",	"Invalid view option provided");
define("_MSNL_ADM_SEND_ERR_CREATENL",			"Could not copy from testemail to the "
	."newsletter file"
	);
define("_MSNL_ADM_SEND_ERR_DBNLSINSERT",	"Was not able to insert the newsletter into "
	."the database"
	);
define("_MSNL_ADM_SEND_ERR_DBNLSNID",			"Was not able to get the NID of the just "
	."inserted newsletter"
	);
define("_MSNL_ADM_SEND_ERR_MAIL",					"PHP mail function failed - was unable to send "
	."newsletter to:"
	);
define("_MSNL_ADM_SEND_ERR_DELFILETEST",	"Delete of testemail.php file failed");
define("_MSNL_ADM_SEND_ERR_DELFILETMP",		"Delete of tmp.php file failed");

/************************************************************************
* Function: msnl_admin (Create Newsletter --> admin_make_nls.php)
************************************************************************/

define("_MSNL_ADM_MAKE_ERR_DBGETSTATSUSR",			"Unable to retrieve Statistics for number of users");
define("_MSNL_ADM_MAKE_ERR_DBGETSTATSHITS",			"Unable to retrieve Statistics for total site hits");
define("_MSNL_ADM_MAKE_ERR_DBGETSTATSNEWS",			"Unable to retrieve Statistics for number of news articles");
define("_MSNL_ADM_MAKE_ERR_DBGETSTATSNEWSCAT",	"Unable to retrieve Statistics for number of news categories");
define("_MSNL_ADM_MAKE_ERR_DBGETSTATSDLS",			"Unable to retrieve Statistics for number of downloads");
define("_MSNL_ADM_MAKE_ERR_DBGETSTATSDLCAT",		"Unable to retrieve Statistics for number of download categories");
define("_MSNL_ADM_MAKE_ERR_DBGETSTATSLINKS",		"Unable to retrieve Statistics for number of web links");
define("_MSNL_ADM_MAKE_ERR_DBGETSTATSLNKCAT",		"Unable to retrieve Statistics for number of web link categories");
define("_MSNL_ADM_MAKE_ERR_DBGETSTATSFORUMS",		"Unable to retrieve Statistics for number of forums");
define("_MSNL_ADM_MAKE_ERR_DBGETSTATSPOSTS",		"Unable to retrieve Statistics for number of forum posts");
define("_MSNL_ADM_MAKE_ERR_DBGETSTATSREVIEWS",	"Unable to retrieve Statistics for number of reviews");

define("_MSNL_ADM_SEND_ERR_DBGETNEWS",		"Unable to retrieve latest news articles");
define("_MSNL_ADM_MAKE_ERR_DBGETDLS",			"Unable to retrieve latest downloads");
define("_MSNL_ADM_MAKE_ERR_DBGETWLS",			"Unable to retrieve latest web links");
define("_MSNL_ADM_MAKE_ERR_DBGETPOSTS",		"Unable to retrieve latest forum posts");
define("_MSNL_ADM_MAKE_ERR_DBGETREVIEWS",	"Unable to retrieve latest reviews");
define("_MSNL_ADM_MAKE_ERR_DBGETBANNER",	"Unable to retrieve banner");

/************************************************************************
* Function: msnl_admin_send_tested  (Send Tested)
************************************************************************/

define("_MSNL_ADM_TEST_LAB_PREVNL",				"Preview Tested Newsletter to Send");

/************************************************************************
* Function: msnl_cfg	(Main Configuration Options)
************************************************************************/

define("_MSNL_CFG_LAB_MAINCFG",						"Main Module Configuration");

//Module Options

define("_MSNL_CFG_LAB_MODULEOPT",					"Module Options");
define("_MSNL_CFG_LAB_DEBUGMODE",					"Debug Mode");
define("_MSNL_CFG_LAB_DEBUGMODE_OFF",			"OFF");
define("_MSNL_CFG_LAB_DEBUGMODE_ERR",			"ERROR");
define("_MSNL_CFG_LAB_DEBUGMODE_VER",			"VERBOSE");
define("_MSNL_CFG_LAB_DEBUGOUTPUT",				"Debug Output");
define("_MSNL_CFG_LAB_DEBUGOUTPUT_DIS",		"DISPLAY");
define("_MSNL_CFG_LAB_DEBUGOUTPUT_LOG",		"LOG FILE");
define("_MSNL_CFG_LAB_DEBUGOUTPUT_BTH",		"BOTH");
define("_MSNL_CFG_LAB_SHOWBLOCKS",				"Show Right Blocks");
define("_MSNL_CFG_LAB_NSNGRPS",						"Use NSN Groups");
define("_MSNL_CFG_LAB_DLMODULE",					"Download Module's Name");
define("_MSNL_CFG_LAB_WYSIWYGON",					"Use WYSIWYG Editor");
define("_MSNL_CFG_LAB_WYSIWYGROWS",				"Content Rows");

define("_MSNL_CFG_HLP_DEBUGMODE",					"This allows the module admin to set various levels of "
	."debug messaging as follows:<br /><strong>OFF</strong> = Only application level error "
	."messages, with no details will be displayed.<br /><strong>ERROR</strong> = Application "
	."errors will be displayed, along with useful debug message text.  SQL errors will also "
	."show the actual SQL error message and generated SQL.<br /> <strong>VERBOSE</strong> "
	."= Very detailed messages will be displayed throughout the application, including path "
	."names (be careful with not leaving this setting on for very long or on a very active "
	."web site as it could provide alot of useful information to a hacker!). <b>NOTE: emails "
	."will NOT be sent using this option</b> - very useful for debugging purposes."
	);
define("_MSNL_CFG_HLP_DEBUGOUTPUT",				"This option is not used at this time.  In the future "
	."will provide ability to display the above debug messages to either the browser, a log "
	."file, or both."
	);
define("_MSNL_CFG_HLP_SHOWBLOCKS",				"Having this <strong>checked</strong> will show the "
	."right-hand blocks when in the module.  Having this <strong>unchecked</strong> will hide "
	."the right-hand blocks.  The default for this is <strong>unchecked</strong>."
	);
define("_MSNL_CFG_HLP_NSNGRPS",						"This option can only be used if you have "
	."NSN Groups add-on installed.  If you would like to be able to send newsletters "
	."to one or more NSN Groups, check this option."
	);
define("_MSNL_CFG_HLP_DLMODULE",					"Replace this with the proper module "
	."extension, i.e. the default module is 'downloads' from nuke_"
	."<strong>downloads</strong>_downloads. For NSN Groups module, it is 'nsngd' "
	."from nuke_<strong>nsngd</strong>_downloads."
	);
define("_MSNL_CFG_HLP_WYSIWYGON",					"Check this if you wish to use the WYSIWYG "
	."editor for editing the newsletter content (textbody).  <strong>NOTE:</strong> this "
	."option requires that the nukeWYSIWYG add-on is pre-installed."
	);
define("_MSNL_CFG_HLP_WYSIWYGROWS",				"This controls the number of rows that are "
	."made available on the Create Newsletter page within the Newsletter Content "
	."(textbody).  It works with WYSIWYG and without."
	);

//Show Options

define("_MSNL_CFG_LAB_SHOWOPT",						"Show Options");
define("_MSNL_CFG_LAB_SHOWCATS",					"Show categories");
define("_MSNL_CFG_LAB_SHOWHITS",					"Show hits");
define("_MSNL_CFG_LAB_SHOWDATES",					"Show dates sent");
define("_MSNL_CFG_LAB_SHOWSENDER",				"Show sender");

define("_MSNL_CFG_HLP_SHOWCATS",					"If checked, will show newsletters under "
	."their respective categories in the block.  Categories will always be shown "
	."in the Archives (module)."
	);
define("_MSNL_CFG_HLP_SHOWHITS",					"If checked, will display the number "
	."of views (hits) a newsletter receives within the block and in the Archives (module)."
	);
define("_MSNL_CFG_HLP_SHOWDATES",					"If checked, will display the date that "
	."each newsletter was sent on in both the block and in the Archives (module)."
	);
define("_MSNL_CFG_HLP_SHOWSENDER",				"If checked, will display the sender who "
	."sent each newsletter in both the block and in the Archives (module)."
	);

//Block Options

define("_MSNL_CFG_LAB_BLKOPT",						"Block Options");
define("_MSNL_CFG_LAB_BLKLMT",						"Newsletters to show in the block");
define("_MSNL_CFG_LAB_SCROLL",						"Use Scrolling block code");
define("_MSNL_CFG_LAB_SCROLLHEIGHT",			"Scrolling code height");
define("_MSNL_CFG_LAB_SCROLLAMT",					"Scrolling code amount");
define("_MSNL_CFG_LAB_SCROLLDELAY",				"Scrolling code delay");

define("_MSNL_CFG_HLP_BLKLMT",						"Limits the TOTAL number of newsletters "
	."to show in the block.  If categories are turned on, the number of newsletters "
	."to show in a particular category is a separate configuration setting."
	);
define("_MSNL_CFG_HLP_SCROLL",						"This feature gives the block information "
	."the ability to scroll upwards in the block"
	);
define("_MSNL_CFG_HLP_SCROLLHEIGHT",			"Sets the height of the scroll area in "
	."pixels, default is 180. Be careful, if you make it too small you may not see anything."
	);
define("_MSNL_CFG_HLP_SCROLLAMT",					"Set the scroll amount on the scrolling, "
	."this in affect is the distance the Info will move in-between the Scroll delay. "
	."Default is 2."
	);
define("_MSNL_CFG_HLP_SCROLLDELAY",				"Sets the scroll delay on the scrolling, "
	."this is how long the info waits before it moves again in mil-sec. Default is 25."
	);

/************************************************************************
* Function: msnl_cfg_apply	(Apply Changes to Main Configuration)
************************************************************************/

define("_MSNL_CFG_APPLY_ERR_DBFAILED",		"Update of configuration information failed");

define("_MSNL_CFG_APPLY_VAL_DEBUGMODE",		"Invalid Debug Mode was provided - might have "
	."problem with module installation"
	);
define("_MSNL_CFG_APPLY_VAL_DEBUGOUTPUT",	"Invalid Debug Output was provided - might have "
	."problem with module installation"
	);

define("_MSNL_CFG_APPLY_MSG_BACK",				"Back to Main Configuration");

/************************************************************************
* Function: msnl_cat	(Maintain Newsletter Categories)
************************************************************************/

define("_MSNL_CAT_LAB_CATCFG",						"Newsletter Categories Configuration");

define("_MSNL_CAT_LAB_ADDCAT",						"ADD CATEGORY");
define("_MSNL_CAT_LAB_CATTITLE",					"Category Title");
define("_MSNL_CAT_LAB_CATDESC",						"Category Description");
define("_MSNL_CAT_LAB_CATBLOCKLMT",				"Block Limit");

define("_MSNL_CAT_LNK_ADDCAT",						"Add a new newsletter category");
define("_MSNL_CAT_LNK_CATCHG",						"Edit newsletter category");
define("_MSNL_CAT_LNK_CATDEL",						"Delete newsletter catetory");

define("_MSNL_CAT_MSG_CATBACK",						"Back to Newsletter Categories list");

define("_MSNL_CAT_ERR_DBGETCAT",					"Failed to get newsletter category information");
define("_MSNL_CAT_ERR_DBGETCATS",					"Failed to get newsletter categories");
define("_MSNL_CAT_ERR_NOCATS",						"No categories found - Major problem with installation");
define("_MSNL_CAT_ERR_INVALIDCID",				"Invalid Newsletter Category ID was provided");
define("_MSNL_CAT_ERR_DBGETCNT",					"Get count of impacted newsletters failed");

define("_MSNL_CAT_HLP_CATTITLE",					"This field is the title of the category which will "
	."show in both the block (if enabled through the configuration options) and the newsletter "
	."archives.  Since this is what will be used in the block to group newsletters together "
	."you should keep the title to 30 characters or less in size so the block will render "
	."properly."
	);
define("_MSNL_CAT_HLP_CATDESC",						"This is a very large field. The only restriction "
	."is to not embed HTML tags into it.  It will let you do it, but they will be stripped "
	."out later.  Give a good and thorough description of this newsletter category."
	);
define("_MSNL_CAT_HLP_CATBLOCKLMT",				"This field is used only if the <b>show categories</b> "
	."configuration option is checked and must be greater than zero.  Enter here the number of "
	."newsletters that should be shown under this category in the block. <b>If a value is not "
	."provided, this will be defaulted to "
	);

/************************************************************************
* Function: msnl_cat_add
************************************************************************/

define("_MSNL_CAT_ADD_LAB_CATADD",				"Newsletter Categories Configuration - Add Category");

/************************************************************************
* Function: msnl_cat_add_apply
************************************************************************/

define("_MSNL_CAT_ADD_APPLY_DBCATADD",		"Add of Newsletter Category failed");

/************************************************************************
* Function: msnl_cat_chg
************************************************************************/

define("_MSNL_CAT_CHG_LAB_CATCHG",				"Newsletter Categories Configuration - Change Category");

define("_MSNL_CAT_CHG_MSG_CHGIMPACT",			"Newsletter(s) will be impacted by this change");

/************************************************************************
* Function: msnl_cat_chg_apply
************************************************************************/

define("_MSNL_CAT_CHG_APPLY_ERR_DBCATCHG","Update of Newsletter category failed");

/************************************************************************
* Function: msnl_cat_del
************************************************************************/

define("_MSNL_CAT_DEL_MSG_DELIMPACT",			"Newsletter(s) will be impacted by this delete.");
define("_MSNL_CAT_DEL_MSG_DELIMPACT1",		"Impacted newsletters will be re-assigned to the "
	."default unassigned newsletter category.  Do you wish to continue with this delete?"
	);

/************************************************************************
* Function: msnl_cat_del_apply
************************************************************************/

define("_MSNL_CAT_DEL_APPLY_ERR_DBREASSIGN",	"Re-assignment of newsletters failed");
define("_MSNL_CAT_DEL_APPLY_ERR_DBDELETE","Delete of newsletter category failed");

/************************************************************************
* Function: msnl_nls
************************************************************************/

define("_MSNL_NLS_LAB_NLSCFG",						"Maintain Newsletters");
define("_MSNL_NLS_LAB_CURRENTCAT",				"Current Category");
define("_MSNL_NLS_LAB_DATESENT",					"Date Sent");
define("_MSNL_NLS_LAB_CATEGORY",					"Category");

define("_MSNL_NLS_LNK_GETNLS",						"Get requested newsletters");
define("_MSNL_NLS_LNK_VIEWNL",						"View newsletter - may open new window");
define("_MSNL_NLS_LNK_NLSCHG",						"Edit newsletter information");
define("_MSNL_NLS_LNK_NLSDEL",						"Delete newsletter");

define("_MSNL_NLS_MSG_NONLSS",						"No newsletters for category found");
define("_MSNL_NLS_MSG_NLSBACK",						"Back to Newsletter list");

define("_MSNL_NLS_ERR_DBGETNLSS",					"Failed to get newsletters");
define("_MSNL_NLS_ERR_DBGETNLS",					"Failed to get newsletter information");

define("_MSNL_NLS_ERR_INVALIDNID",				"Invalid Newsletter ID was provided");
define("_MSNL_NLS_ERR_NONLSS",						"No newsletters found - Major problem with installation");

/************************************************************************
* Function: msnl_nls_chg
************************************************************************/

define("_MSNL_NLS_CHG_LAB_NLSCHG",				"Maintain Newsletters - Change Newsletter Information");
define("_MSNL_NLS_CHG_LAB_DATESENT",			"Date Sent");
define("_MSNL_NLS_CHG_LAB_WHOVIEW",				"Who Can View Newsletter");
define("_MSNL_NLS_CHG_LAB_NSNGRPS",				"NSN Groups Can View Newsletter");
define("_MSNL_NLS_CHG_LAB_NBRHITS",				"Number of Hits");
define("_MSNL_NLS_CHG_LAB_FILENAME",			"Newsletter Filename");
define("_MSNL_NLS_CHG_LAB_CAUTION",				"Change below values ONLY if you know what you are doing");

define("_MSNL_NLS_CHG_HLP_DATESENT", 			"Currently, the date must be entered in format "
	."YYYY-MM-DD as displayed in this field.  When a newsletter is first created and sent, "
	."this field is populated with the current system date.  Newsletters are always listed "
	."in date order sequence with the most recent one on the top of the list."
	);
define("_MSNL_NLS_CHG_HLP_WHOVIEW", 			"This field is system assigned - be careful in "
	."changing it!  Valid values are:"
	."<br /><strong>0</strong> = anonymous - all can view"
	."<br /><strong>1</strong> = all registered users"
	."<br /><strong>2</strong> = newsletter subscribers only"
	."<br /><strong>3</strong> = site paid members only"
	."<br /><strong>4</strong> = selected NSN Groups only"
	."<br /><strong>5</strong> = adhoc distribution list"
	."<br /><strong>99</strong> = site admin only."
	);
define("_MSNL_NLS_CHG_HLP_NSNGRPS", 			"Requires that the above <b>view</b> option "
	."be set to 4 for *NSN Groups only*. Each NSN Group has a specific ID number associated "
	."with it.  At newsletter create/send time, one can choose one or more NSN Groups to "
	."send to.  For only one group, this field should just have the associated group ID. "
	."For more than one group, each group ID should be separated by a dash, e.g. <b>1-2-3</b>."
	);
define("_MSNL_NLS_CHG_HLP_NBRHITS",				"When a newsletter is viewed from the web site using "
	."either a block link or an archives link, the newsletter's hit count is incremented.  "
	."The hit counter is NOT incremented if the user is logged in as admin."
	);
define("_MSNL_NLS_CHG_HLP_FILENAME",			"This field is system assigned.  If you change it, "
	."make sure the file name exists and it is formatted properly for viewing by this system."
	);

/************************************************************************
* Function: msnl_nls_chg_apply
************************************************************************/

define("_MSNL_NLS_CHG_APPLY_MSG_WHOVIEW",	"Value must be one of 0 - 4, or 99");

define("_MSNL_NLS_CHG_APPLY_ERR_DBNLSCHG","Update of Newsletter information failed");

/************************************************************************
* Function: msnl_nls_del
************************************************************************/

define("_MSNL_NLS_DEL_MSG_DELIMPACT",			"You are about to permanently delete this newsletter.");
define("_MSNL_NLS_DEL_MSG_DELIMPACT1",		"All information related to this newsletter will be "
	."deleted from the database as well as the newsletter file within the archive directory. "
	."Do you wish to continue with this delete?"
	);

/************************************************************************
* Function: msnl_nls_del_apply
************************************************************************/

define("_MSNL_NLS_DEL_APPLY_ERR_FILEDEL",	"Was unable to delete newsletter file - check "
	."file permissions"
	);

define("_MSNL_NLS_DEL_APPLY_ERR_DBNLSDEL","Delete of Newsletter information failed");

?>