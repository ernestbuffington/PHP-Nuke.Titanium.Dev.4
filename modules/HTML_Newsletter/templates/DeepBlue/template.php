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
{TEMPLATENAME} = This is the template directory where all referenced objects can be found.

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
<td bgcolor='#d3e2ea'><img src=\"{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/pixel.gif\" width=\"5\" height=\"1\" border=\"0\" alt=\"\"></td><td valign=\"top\" align=\"right\" width=\"138\" bgcolor=\"d3e2ea\"><table border=\"0\" align=\"center\" width=\"138\" cellpadding=\"0\" cellspacing=\"0\"><tr><td class=\"titlebar\" width=\"138\" height=\"20\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color=\"#FFFFFF\"><b>Site Statistics</b></font></td></tr><tr><td><img alt=\"\" src=\"{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/pixel.gif\" width=\"100%\" height=\"3\"></td></tr></table><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"138\"><tr><td width=\"138\" bgcolor=\"#000000\"><table border=\"0\" cellpadding=\"1\" cellspacing=\"1\" width=\"138\"><tr><td width=\"138\" bgcolor=\"#ffffff\"><table width=\"100%\" align=\"center\"><tr><td width=\"75%\">Total Page Hits:</td><td width=\"25%\" align=left>{PAGEHITS}</td></tr><tr><td width=\"75%\">Total Members:</td><td width=\"25%\" align=left>{MEMBERS}</td></tr><tr><td width=\"75%\">Total News Items:</td><td width=\"25%\" align=left>{NEWSITEMS}</td></tr><tr><td width=\"75%\">Total Downloads:</td><td width=\"25%\" align=left>{DOWNLOADS}</td></tr><tr><td width=\"75%\">Total Web Links:</td><td width=\"25%\" align=left>{WEBLINKS}</td></tr><tr><td width=\"75%\">Total Forum Posts:</td><td width=\"25%\" align=left>{FORUMPOSTS}</td></tr></table></td></tr></table></td></tr></table></td><td bgcolor='#d3e2ea'><img src=\"{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/pixel.gif\" width=\"6\" height=\"1\" border=\"0\" alt=\"\"></td>";

$latestnewstop = 
"<table border=\"0\" align=\"center\" width=\"95%\" cellpadding=\"0\" cellspacing=\"0\"><tr><td width=\"16\" height=\"20\"><img alt=\"\" src=\"{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/table-title_01.gif\" width=\"16\" height=\"20\"></td><td class=\"title\" width=\"100%\" height=\"20\"><font color=\"#FFFFFF\"><b>Our {AMOUNT} latest news items.</b></font></td><td width=\"25\" height=\"20\"><img alt=\"\" src=\"{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/table-title_03.gif\" width=\"25\" height=\"20\"></td></tr><tr><td><img alt=\"\" src=\"{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/pixel.gif\" width=\"100%\" height=\"3\"></td></tr></table><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"95%\" align=\"center\">
	<tr>
		<td width=\"100%\" bgcolor=\"#000000\">
			<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\" width=\"100%\">
				<tr>
					<td width=\"100%\" bgcolor=\"#ffffff\">
						<table width=\"100%\" align=\"center\">
							<tr>
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
"						<tr>
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
"						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table><br>";

$latestdownloadtop =
"<table border=\"0\" align=\"center\" width=\"95%\" cellpadding=\"0\" cellspacing=\"0\"><tr><td width=\"16\" height=\"20\"><img alt=\"\" src=\"{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/table-title_01.gif\" width=\"16\" height=\"20\"></td><td class=\"title\" width=\"100%\" height=\"20\"><font color=\"#FFFFFF\"><b>Our {AMOUNT} latest downloads.</b></font></td><td width=\"25\" height=\"20\"><img alt=\"\" src=\"{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/table-title_03.gif\" width=\"25\" height=\"20\"></td></tr><tr><td><img alt=\"\" src=\"{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/pixel.gif\" width=\"100%\" height=\"3\"></td></tr></table><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"95%\" align=\"center\">
	<tr>
		<td width=\"100%\" bgcolor=\"#000000\">
			<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\" width=\"100%\">
				<tr>
					<td width=\"100%\" bgcolor=\"#ffffff\">
						<table width=\"100%\" align=\"center\">
							<tr>
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
"							<tr>
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
"						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table><br>";

$latestweblinktop = 
"<table border=\"0\" align=\"center\" width=\"95%\" cellpadding=\"0\" cellspacing=\"0\"><tr><td width=\"16\" height=\"20\"><img alt=\"\" src=\"{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/table-title_01.gif\" width=\"16\" height=\"20\"></td><td class=\"title\" width=\"100%\" height=\"20\"><font color=\"#FFFFFF\"><b>Our {AMOUNT} latest web links.</b></font></td><td width=\"25\" height=\"20\"><img alt=\"\" src=\"{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/table-title_03.gif\" width=\"25\" height=\"20\"></td></tr><tr><td><img alt=\"\" src=\"{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/pixel.gif\" width=\"100%\" height=\"3\"></td></tr></table><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"95%\" align=\"center\">
	<tr>
		<td width=\"100%\" bgcolor=\"#000000\">
			<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\" width=\"100%\">
				<tr>
					<td width=\"100%\" bgcolor=\"#ffffff\">
						<table width=\"100%\" align=\"center\">
							<tr>
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
"							<tr>
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
"						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table><br>";

$latestforumtop .= "
<table border=\"0\" align=\"center\" width=\"95%\" cellpadding=\"0\" cellspacing=\"0\"><tr><td width=\"16\" height=\"20\"><img alt=\"\" src=\"{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/table-title_01.gif\" width=\"16\" height=\"20\"></td><td class=\"title\" width=\"100%\" height=\"20\"><font color=\"#FFFFFF\"><b>Our {AMOUNT} latest forum posts.</b></font></td><td width=\"25\" height=\"20\"><img alt=\"\" src=\"{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/table-title_03.gif\" width=\"25\" height=\"20\"></td></tr><tr><td><img alt=\"\" src=\"{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/pixel.gif\" width=\"100%\" height=\"3\"></td></tr></table><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"95%\" align=\"center\">
	<tr>
		<td width=\"100%\" bgcolor=\"#000000\">
			<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\" width=\"100%\">
				<tr>
					<td width=\"100%\" bgcolor=\"#ffffff\">
						<table width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\" align=\"center\">
							<tr>
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
"							<tr>
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
"						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table><br>";


$emailfile =
"<!-- Hi {USERNAME} Your System cannot read HTML-Mails! Following message was send to you: {TEXTBODY} -->
<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">
<html>
<head>

<META HTTP-EQUIV=\"Content-Type\" CONTENT=\"text/html; charset=ISO-8859-1\">
<title>{SITENAME} Email</title>
<style type=\"text/css\">

<!--

TD			{FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 11px}
BODY		{FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 11px}
A:link      {BACKGROUND: none; COLOR: #000000; FONT-SIZE: 11px; FONT-FAMILY: Verdana, Helvetica; TEXT-DECORATION: underline}
A:active    {BACKGROUND: none; COLOR: #000000; FONT-SIZE: 11px; FONT-FAMILY: Verdana, Helvetica; TEXT-DECORATION: underline}
A:visited   {BACKGROUND: none; COLOR: #000000; FONT-SIZE: 11px; FONT-FAMILY: Verdana, Helvetica; TEXT-DECORATION: underline}
A:hover     {BACKGROUND: none; COLOR: #000000; FONT-SIZE: 11px; FONT-FAMILY: Verdana, Helvetica; TEXT-DECORATION: underline}
.option 	{BACKGROUND: none; COLOR: #000000; FONT-SIZE: 13px; FONT-WEIGHT: bold; FONT-FAMILY: Verdana, Helvetica; TEXT-DECORATION: none}
.tiny		{BACKGROUND: none; COLOR: #000000; FONT-SIZE: 10px; FONT-WEIGHT: normal; FONT-FAMILY: Verdana, Helvetica; TEXT-DECORATION: none}
.footmsg    {BACKGROUND: none; COLOR: #CCCCCC; FONT-SIZE: 8px; FONT-WEIGHT: normal; FONT-FAMILY: Verdana, Helvetica; TEXT-DECORATION: none}
td.titlebar {background: transparent url({SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/table-title.gif) no-repeat; color: #FFFFFF; font-family: Verdana, Helvetica, sans-serif }
td.title {background: transparent url({SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/table-title_02.gif) repeat; color: #FFFFFF; font-family: Verdana, Helvetica, sans-serif }

-->

</style>

</head>

<body bgcolor=\"#0E3259\" text=\"#000000\" link=\"0000ff\">
<br>
<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"840\" align=\"center\">
	<tr>
		<td width=\"100%\">
			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"840\">
				<tr>
					<td width=\"100%\">
						<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"840\">
							<tr>
								<td width=\"100%\" height=\"88\" bgcolor=\"#FFFFFF\">
									<table border=\"0\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">
										<tr>
											<td align=\"left\">
												<a href=\"{SITEURL}/index.php\">
													<img border=\"0\" src=\"{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/logo.gif\" alt=\"Welcome to $sitename!\" hspace=\"20\">
												</a>
											</td>
											<td align=\"right\">
												<img alt=\"\" border=\"0\" src=\"{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/logo-graphic.gif\">
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width=\"100%\" bgcolor=\"#000000\" height=\"19\" valign=\"bottom\"><a href=\"{SITEURL}/index.php\"><img alt=\"\" border=\"0\" src=\"{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/home.gif\" width=\"140\" height=\"18\"></a><a href=\"{SITEURL}/modules.php?name=Your_Account\"><img alt=\"\" border=\"0\" src=\"{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/account.gif\" width=\"140\" height=\"18\"></a><a href=\"{SITEURL}/modules.php?name=Downloads\"><img alt=\"\" border=\"0\" src=\"{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/downloads.gif\" width=\"140\" height=\"18\"></a><a href=\"{SITEURL}/modules.php?name=Submit_News\"><img alt=\"\" border=\"0\" src=\"{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/submit.gif\" width=\"140\" height=\"18\"></a><a href=\"{SITEURL}/modules.php?name=Topics\"><img alt=\"\" border=\"0\" src=\"{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/topics.gif\" width=\"140\" height=\"18\"></a><a href=\"{SITEURL}/modules.php?name=Top\"><img alt=\"\" border=\"0\" src=\"{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/top10.gif\" width=\"140\" height=\"18\"></a></td>
							</tr>
							<tr>
								<td width=\"100%\" height=\"10\" bgcolor=\"#d3e2ea\">
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td width=\"100%\">
						<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
							<tr>
								<td bgcolor='#d3e2ea'>
									<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"95%\" align=\"center\">
										<tr>
											<td bgcolor=\"#000000\">
												<table border=\"0\" cellpadding=\"0\" cellspacing=\"1\" width=\"100%\">
													<tr>
														<td bgcolor=\"#FFFFFF\">
															<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
																<tr>
																	<td bgcolor=\"#FFFFFF\">
																		<img alt=\"\" src=\"{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/dot.gif\" border=\"0\">
																	</td>
																	<td width=\"100%\" bgcolor=\"#FFFFFF\">
																		<font class=\"option\">
																			<b>
																				&nbsp;{EMAILTOPIC}
																			</b>
																		</font>
																	</td>
																</tr>
																<tr>
																	<td colspan=\"2\" bgcolor=\"#FFFFFF\">
																		<br>
																		<table>
																			<tr>
																				<td>
																					{TEXTBODY}
																				</td>
																			</tr>
																		</table>
																	</td>
																</tr>
															</table>
																<br>
														</td>
													</tr>
													<tr>
														<td bgcolor=\"#FFFFFF\" align=\"center\">
															<font class=\"tiny\">
																Sent By: {SENDER} on {DATE}
															</font>
															<img alt=\"\" src=\"{SITEURL}/modules/HTML_Newsletter/templates/{TEMPLATENAME}/pixel.gif\" border=\"0\" height=\"3\">
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
									{STATS}
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td bgcolor='#d3e2ea'>
						<br>
						{NEWS}
						{DOWNLOADS}
						{WEBLINKS}
						{FORUMS}
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
<br>
<center>{BANNER}</center>
<hr>
!!
<center><font class=\"footmsg\">
You received this email because you are a registered user of {SITENAME}, if you dont want to receive mail from {SITENAME}, please let us know by following this <a href=\"mailto:{ADMINEMAIL}?subject=Newsletter\">link</a>.
</font></center>
!!
<hr>
		</td>
	</tr>
</table>
</body>
</html>
";
?>