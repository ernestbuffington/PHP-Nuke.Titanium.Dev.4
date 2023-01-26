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
/* Titanium Blog                                                        */
/* By: The 86it Developers Network                                      */
/* https://www.86it.us                                                  */
/* Copyright (c) 2019 Ernest Buffington                                 */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
-=[Mod]=-
      Advanced Username Color                  v1.0.5       07/29/2005
      Blog BBCodes                             v1.0.0       08/19/2005
      Display Blog Post Topic Icon             v1.0.0       06/27/2005
      Display Writes                           v1.0.0       10/14/2005
	  Titanium Patched                         v3.0.0       08/26/2019
 ************************************************************************/
define_once('_BLOGS','Blog Posts');
define_once("_LAST_BLOG_POSTS","Last 100 Blog Posts");
define_once("_PROGRAMMEDBLOGS","Programmed Blog Posts");

# COMMENTS
define_once('_REMOVECOMMENTS','Would you like to <strong>DELETE</strong> This Comment?');
define_once('_SURETODELCOMMENTS','Are you <strong>SURE</strong> you would like to <strong>DELETE</strong> This Comment?');

define_once("_SEND","Send");
define_once("_URL","URL");
define_once("_PRINTER_FRIENDLY_BLOG_POST_VIEW","Printer Friendly Page");
define_once("_SEND_BLOG_TO_FRIEND","Send to a Friend");
define_once("_YOURNAME","Your Name");
define_once("_OK","Ok!");
define_once("_RELATED","Related Links");
define_once("_MOREABOUT","More about");
define_once("_BLOG_BY","Blog Post by");
define_once("_MOST_READ_BLOGS","Most read Blog Post");
define_once("_READMORE","Read More...");
define_once("_BYTESMORE","bytes more");
define_once("_COMMENTSQ","Likes & comments?");
define_once("_COMMENT","comment");
define_once("_CONFIGURE","Configure");
define_once("_LOGINCREATE","Login/Create an Account");
define_once("_THRESHOLD","Threshold");
define_once("_NOCOMMENTS","No Comments");
define_once("_NESTED","Nested");
define_once("_FLAT","Flat");
define_once("_THREAD","Thread");
define_once("_OLDEST","Oldest First");
define_once("_NEWEST","Newest First");
define_once("_HIGHEST","Highest Scores First");
define_once("_COMMENTSWARNING","The comments are owned by the poster. We are not responsible for their content.");
define_once("_SCORE","Score:");
define_once("_USERINFO","User Info");
define_once("_READREST","Read the rest of this comment...");
define_once("_REPLY","Reply to This");
define_once("_REPLYMAIN","Post Comment");
define_once("_NOSUBJECT","No Subject");
define_once("_NOANONCOMMENTS","No Comments Allowed for Anonymous, please <a href=\"modules.php?name=Your_Account&amp;op=new_user\">register</a>");
define_once("_PARENT","Parent");
define_once("_ROOT","Root");
define_once("_UCOMMENT","Comment");
define_once("_ALLOWEDHTML","Allowed HTML:");
define_once("_POSTANON","Post Anonymously");
define_once("_EXTRANS","Extrans (html tags to text)");
define_once("_HTMLFORMATED","HTML Formatted");
define_once("_PLAINTEXT","Plain Old Text");
define_once("_ONN","on...");
define_once("_SUBJECT","Subject");
define_once("_COMMENTREPLY","Comment Post");
define_once("_COMREPLYPRE","Comment Post Preview");
define_once("_NOTRIGHT","Something is not right with passing a variable to this function. This message is just to keep things from messing up down the road");
define_once("_SENDAMSG","Send a Message");
define_once("_YOUSENDSTORY","You will send the blog post");
define_once("_TOAFRIEND","to a specified friend:");
define_once("_FYOURNAME","Your Name:");
define_once("_FYOUREMAIL","Your E-mail:");
define_once("_FFRIENDNAME","Your Friend's Name:");
define_once("_FFRIENDEMAIL","Your Friend's E-mail:");
define_once("_INTERESTING","Interesting Blog Post at");
define_once("_YOURFRIEND","Your Friend");
define_once("_CONSIDERED","considered the following Blog Post to be interesting and wanted to share it with you.");
define_once("_FDATE","Date:");
define_once("_FTOPIC","Topic:");
define_once("_YOUCANREAD","You can read interesting Blog Posts at");
define_once("_FSTORY","Blog Post");
define_once("_HASSENT","Has been sent to");
define_once("_THANKS","Thanks!");
define_once("_RECOMMEND","Recommend this web portal to a Friend");
define_once("_PDATE","Date:");
define_once("_PTOPIC","Topic:");
define_once("_COMESFROM","This Blog Post comes from");
define_once("_THEURL","The URL for this Blog Post is:");
define_once("_PREVIEW","Preview");
define_once("_NEWUSER","New User");
define_once("_OPTIONS","Options");
define_once("_REFRESH","Refresh");
define_once("_NOCOMMENTSACT","Sorry, Comments are not available for this Blog Post.");
define_once("_ARTICLEPOLL","Blog Post's Poll");
define_once("_RATEARTICLE","Blog Post Rating");
define_once("_RATETHISARTICLE","Will you take a moment to vote for this Blog Post? Your VOTES are appreciated by the Author!");
define_once("_CASTMYVOTE","Cast my Vote!");
define_once("_AVERAGESCORE","Star Rating");
define_once("_BAD","Bad");
define_once("_REGULAR","Regular");
define_once("_GOOD","Good");
define_once("_VERYGOOD","Very Good");
define_once("_EXCELLENT","Excellent");
define_once("_ARTICLERATING","Blog Rating");
define_once("_THANKSVOTEARTICLE","Thanks for voting for this Blog!");
define_once("_ALREADYVOTEDARTICLE","Sorry, you recently voted for this Blog Post!");
define_once("_BACKTOARTICLEPAGE","Back to the Blog Post");
define_once("_DIDNTRATE","You didn't select any score for the Blog Post!");
define_once("_NOINFO4TOPIC","Sorry, there isn't information for the selected Blog Topic.");
define_once("_GOTONEWSINDEX","Go to Blog Post Index");
define_once("_SELECTNEWTOPIC","Select a New Blog Post Topic");
define_once("_GOTOHOME","Go to Home");
define_once("_SEARCHONTOPIC","Search on This Blog Post Topic");
define_once("_SEARCHDIS","Search Discussion");
define_once("_READPDF","Read as PDF");
define_once("_READWITHCOMMENTS", "You can read the complete blog post with its comments from");
/*****[BEGIN]******************************************
 [ Mod:     NSN Blog                           v1.1.0 ]
 ******************************************************/
define_once("_BLOG_SELECT","Select Blog Post Page");
define_once("_BLOG_OF","( There are ");
define_once("_BLOG_PAGES"," Blog Post Pages )");
define_once("_BLOGS_CONFIG","Blog Post Configuration");
define_once("_BLOG_DISPLAYTYPE","Display Column");
define_once("_BLOG_SINGLE","Single Column");
define_once("_BLOG_DUAL","Dual Column");
define_once("_BLOG_READLINK","Read More Link");
define_once("_BLOG_POPUP","Popup");
define_once("_BLOG_PAGE","Page");
define_once("_BLOG_TEXTTYPE","Blog Post Length");
define_once("_BLOG_TRUNCATE","Truncate to 255 chars");
define_once("_BLOG_COMPLETE","Original text");
define_once("_BLOG_NOTIFYAUTH","Notify Blog Post Author");
define_once("_BLOG_NOTIFYAUTHNOTE","This will email the Blog Post submitter<br />on approval");
define_once("_BLOG_NO","No");
define_once("_BLOG_YES","Yes");
define_once("_BLOG_HOMETOPIC","Blog Post Topics in Home");
define_once("_BLOG_ALLTOPICS","All Blog Post Topics");
define_once("_BLOG_HOMENUMBER","Blog Posts in Home");
define_once("_BLOG_NUKEDEFAULT","PHP-Nuke Titanium Default");
define_once("_BLOG_ARTICLES","Blog Posts");
define_once("_BLOG_HOMENUMNOTE","This will override user preferences<br />if set other than PHP-Nuke Titanium Default");
define_once("_BLOG_SAVECHANGES","Save Changes");
/*****[END]********************************************
 [ Mod:     NSN Blogs                           v1.1.0 ]
 ******************************************************/
define_once("_GFX_FAILURE","Please enter the correct GFX code");
?>
