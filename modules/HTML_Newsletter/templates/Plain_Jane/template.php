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

/*Placeholders Table Of Contents

**General Place Holders**
{AMOUNT} = This is the row counter, mainly used displaying the total number of items.
{SITEURL} = This is the url of your site.
{ROWNUMBER} = This is the row counter, mainly used for numbering the repeating rows. (row specific)
{TOPICID} = This is the topic or category id number needed to do weblinks to the relative topic or category. (row specific)
{TOPIC} = This is the name of the topic or category. (row specific)
{TITLE} = This is the name of the item. (row specific)
{HITS} = This is the number of times an Item has been hit. (row specific)
{SITENAME} = This is the name of your site.
{USERNAME} = This is the Users name the email will be sent to.
{DATE} = The current date (i.e. January 01 2004).
{TEXTBODY} = This is the main body of text or the message you wish sent.
{BANNER} = This displays the Banners links.
{NEWS} = This displays the News information.
{DOWNLOADS} = This displays the download information.
{WEBLINKS} = This displays the web-links information.
{FORUMS} = This displays the forums information.
{STATS} = This displays the site stats information.
{EMAILTOPIC} = This displays the email topic.
{SENDER} = This is the senders name.
{ADMINEMAIL} = This is the Admin's email address.

**News Specific Placeholders**
{NEWSID} = This is the News id number needed to do weblinks to the news item.
{AUTHOR} = This is the authors name.

**Download Specific Placeholders**
{DOWNLOADID} = This is the id number needed to do weblinks.

**Weblink Specific Placeholders**
{LINKID} = This is the Weblink id number needed to do weblinks.

**Forum Specific Placeholders**
{FTOPICID} = This is the Topic id number needed to do weblinks.
{FTOPICLASTPOSTID} = This is the Topic last post id number needed to do weblinks (use with {FTOPICID} to view the last post of that topic).
{FTOPICTITLE} = This displays the Topic title.
{FTOPICREPLIES} = This displays the topic replys.
{FTPUSERID} = This is the user id of the Topic starter needed to do weblinks.
{FTPUSERNAME} = This is the username of the topic starter.
{FVIEWS} = This is the amount of views for the given topic.
{FTIME} = This is the latest post time of given topic.
{FUSERID} = This is the user id of the last poster needed to do weblinks.
{FUSERNAME} = This is the username of the last poster.

**Site Stats Specific Placeholders**
{PAGEHITS} = This is the total page hits.
{MEMBERS} = This is the total members.
{NEWSITEMS} = This is the total news items.
{NEWSCAT} = This is the total news categories.
{DOWNLOADS} = This is the total downloads.
{DOWNLOADCAT} = This is the total download categories.
{WEBLINKS} = This is the total web-links.
{WEBLINKCAT} = This is the total web-links categories.
{FORUMPOSTS} = This is the total forum posts.
{FORUMTOPICS} = This is the total forum topics.
*/

$statstable = "
<div class=\"content\">
<div class=\"title\">Some statistics from {SITENAME}.</div>
<table width=\"100%\" align=\"center\">
	<tr class=\"row\">
		<td width=\"75%\">
			Total Page Hits:
		</td>
		<td width=\"25%\" align=left>
			{PAGEHITS}
		</td>
	</tr>
	<tr class=\"row\">
		<td width=\"75%\">
			Total Members:
		</td>
		<td width=\"25%\" align=left>
			{MEMBERS}
		</td>
	</tr>
	<tr class=\"row\">
		<td width=\"75%\">
			Total News Items:
		</td>
		<td width=\"25%\" align=left>
			{NEWSITEMS} in {NEWSCAT} categories
		</td>
	</tr>
	<tr class=\"row\">
		<td width=\"75%\">
			Total Downloads:
		</td>
		<td width=\"25%\" align=left>
			{DOWNLOADS} in {DOWNLOADCAT} categories
		</td>
	</tr>
	<tr class=\"row\">
		<td width=\"75%\">
			Total Web Links:
		</td>
		<td width=\"25%\" align=left>
			{WEBLINKS} in {WEBLINKCAT} categories
		</td>
	</tr>
	<tr class=\"row\">
		<td width=\"75%\">
			Total Forum Posts:
		</td>
		<td width=\"25%\" align=left>
			{FORUMPOSTS} in {FORUMTOPICS} topics
		</td>
	</tr>
</table>
</div>";

$latestnewstop = "
<div class=\"content\">
<div class=\"title\"><a href=\"{SITEURL}/modules.php?name=News\">Our {AMOUNT} latest news items.</a></div>
<table width=\"100%\" align=\"center\">
	<tr class=\"subtitle\">
		<td width=\"5%\">
		</td>
		<td>
			Title
		</td>
		<td width=\"15%\">
			Topic
		</td>
		<td width=\"15%\">
			Author
		</td>
	</tr>";

$latestnewsrow = 
	"<tr class=\"row\">
		<td>
			<a href=\"{SITEURL}/modules.php?name=News&amp;file=article&amp;sid={NEWSID}&amp;mode=&amp;order=0&amp;thold=0\">
				{ROWNUMBER}
			</a>
		</td>
		<td>
			<a href=\"{SITEURL}/modules.php?name=News&amp;file=article&amp;sid={NEWSID}&amp;mode=&amp;order=0&amp;thold=0\">
				{TITLE} ({HITS} hits)
			</a>
		</td>
		<td>
			<a href=\"{SITEURL}/modules.php?name=News&amp;new_topic={TOPICID}\">
				{TOPIC}
			</a>
		</td>
		<td>
			{AUTHOR}
		</td>
	</tr>";

$latestnewsend = 
"</table>
</div>";

$latestdownloadtop = "
<div class=\"content\">
<div class=\"title\"><a href=\"{SITEURL}/modules.php?name=Downloads\" title=\"Our latest downloads\">Our {AMOUNT} latest downloads</a></div>
<table width=\"100%\" align=\"center\">
	<tr class=\"subtitle\">
		<td width=\"5%\">
		</td>
		<td>
			Title
		</td>
		<td width=\"10%\">
			Hits
		</td>
	</tr>";

$latestdownloadrow =
"	<tr class=\"row\">
		<td>
			{ROWNUMBER}
		</td>
		<td>
			<a href=\"{SITEURL}/modules.php?name=Downloads&amp;d_op=getit&amp;lid={DOWNLOADID}\">
				{TITLE}
			</a>
		</td>
		<td>
			{HITS}
		</td>
	</tr>";

$latestdownloadend =
"</table>
</div>";

$latestweblinktop = "
<div class=\"content\">
<div class=\"title\"><a href=\"{SITEURL}/modules.php?name=Downloads\" title=\"Our latest web links\">Our {AMOUNT} latest web links</a></div>
<table width=\"100%\" align=\"center\">
	<tr class=\"subtitle\">
		<td width=\"5%\">
		</td>
		<td>
			Title
		</td>
		<td width=\"10%\">
			Hits
		</td>
	</tr>";

$latestweblinkrow = 
"	<tr class=\"row\">
		<td>
			{ROWNUMBER}
		</td>
		<td>
			<a href=\"{SITEURL}/modules.php?name=Web_Links&amp;l_op=viewlinkdetails&amp;lid={LINKID}&amp;ttitle={TITLE}\">
				{TITLE}
			</a>
		</td>
		<td>
			{HITS}
		</td>
	</tr>";

$latestweblinkend =
"</table>
</div>";

$latestforumtop .= "
<div class=\"content\">
<div class=\"title\"><a href=\"{SITEURL}/modules.php?op=modload&amp;name=Forums\" title=\"Our latest forum posts\">Our {AMOUNT} latest forum posts</a></div>
<table width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\" align=\"center\">
	<tr class=\"subtitle\">
		<td width=\"5%\">
		</td>
		<td>
			Topic
		</td>
		<td width=\"7%\">
			Answer
		</td>
		<td width=\"10%\">
			Author
		</td>
		<td width=\"7%\">
			Viewed
		</td>
		<td width=\"23%\">
			Latest Poster
		</td>
	</tr>";

$latestforumrow =
"	<tr class=\"row\">
		<td>
			{ROWNUMBER}
		</td>
		<td>
			<a href=\"{SITEURL}/modules.php?name=Forums&amp;file=viewtopic&amp;t={FTOPICID}#{FTOPICLASTPOSTID}\">
				{FTOPICTITLE}
			</a>
		</td>
		<td>
			{FTOPICREPLIES}
		</td>
		<td>
			<a href=\"{SITEURL}/modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u={FTPUSERID}\">
				{FTPUSERNAME}
			</a>
		</td>
		<td>
			{FVIEWS}
		</td>
		<td>
			{FTIME}
			<br>
			<a href=\"{SITEURL}/modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u={FUSERID}\">
				{FUSERNAME}
			</a>
		</td>
	</tr>";

$latestforumend =
"</table>
</div>";


$emailfile =
"<!-- Hi {USERNAME} Your System cannot read HTML-Mails! Following message was send to you: {TEXTBODY} -->
<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">
<html>
<head>

<META HTTP-EQUIV=\"Content-Type\" CONTENT=\"text/html; charset=ISO-8859-1\">
<title>{SITENAME} Email</title>
<style type=\"text/css\">

<!--

a:link,a:active,a:visited{ background-color: #FFFFFF; color: #000000; text-decoration: none; }
a:hover{ background-color: #FFFFFF; color: #000000; text-decoration: underline; }
body { background: #FFFFFF; color: #000000; font-family: Verdana, Helvetica, sans-serif; font-size: 12px; text-decoration: none; }
div#banner { text-align: center; vertical-align: middle; }
div#main { background: #FFFFFF; border: 1px solid #000000; color: #000000; font-family: Verdana, Helvetica, sans-serif; margin: 2% 2% 2% 2%; padding: 2% 2% 2% 2%; text-decoration: none; }
div#subtitle { background: #FFFFFF; border: 1px solid #000000; color: #000000; font-family: Verdana, Helvetica, sans-serif; font-size: 10px; font-weight: bold; margin-bottom: 5px; margin-top: 5px; padding: 2px 2px 2px 2px; text-decoration: none; }
div#title { background: #FFFFFF; border: 1px solid #000000; color: #000000; font-family: Verdana, Helvetica, sans-serif; font-size: 18px; font-weight: bold; margin-bottom: 5px; margin-top: 5px; padding: 10px 10px; text-align: center; text-decoration: none; text-shadow: #D3D3D3; }
div#unsub { background-color: #FFFFFF; color: #000000; font-family: Verdana, Helvetica, sans-serif; font-size: 9px; text-decoration: none; }
tr.row { background: #FFFFFF; color: #000000; font-family: Verdana, Helvetica, sans-serif; font-size: 10px; text-decoration: none; }
.bar { border: 1px solid #000000; margin-bottom: 5px; margin-top: 5px; }
.content { background: #FFFFFF; border: 1px solid #000000; color: #000000; font-family: Verdana, Helvetica, sans-serif; font-size: 12px; margin-bottom: 5px; margin-top: 5px; padding: 5px 5px 5px 5px; text-decoration: none; }
.subtitle { background: #FFFFFF; color: #000000; font-family: Verdana, Helvetica, sans-serif; font-size: 10px; font-weight: bold; text-decoration: none; }
.title { background: #FFFFFF; color: #000000; font-family: Verdana, Helvetica, sans-serif; font-size: 14px; font-weight: bold; text-decoration: none; }

-->

</style>
</head>
<body>
<div id=\"main\">
	<div id=\"title\">Newsletter from {SITENAME} sent on {DATE}</div>
	<div id=\"subtitle\">By: {SENDER} Topic: {EMAILTOPIC}</div>
	<div class=\"content\">{TEXTBODY}</div>
	<div class=\"bar\"></div>
	{NEWS}
	{DOWNLOADS}
	{WEBLINKS}
	{FORUMS}
	{STATS}
</div>
	<div id=\"banner\">{BANNER}</div>
	<div class=\"bar\"></div>
	<div id=\"unsub\">You received this email because you are a registered user of {SITENAME}, if you dont want to receive mail from {SITENAME}, please let us know by following this <a href=\"mailto:{ADMINEMAIL}?subject=Newsletter\">link</a>.</div>
</body>
</html>
";
?>