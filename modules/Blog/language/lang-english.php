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
define('_NEWS','Blog Posts');
define("_LASTTWENTY","Last 100 Blog Posts");
define("_PROGRAMMEDBLOGS","Programmed Blog Posts");

# COMMENTS
define('_REMOVECOMMENTS','Would you like to <strong>DELETE</strong> This Comment?');
define('_SURETODELCOMMENTS','Are you <strong>SURE</strong> you would like to <strong>DELETE</strong> This Comment?');

define("_SEND","Send");
define("_URL","URL");
define("_PRINTER","Printer Friendly");
define("_FRIEND","Send to a Friend");
define("_YOURNAME","Your Name");
define("_OK","Ok!");
define("_RELATED","Related Links");
define("_MOREABOUT","More about");
define("_NEWSBY","Blog Post by");
define("_MOSTREAD","Most read Blog Post");
define("_READMORE","Read More...");
define("_BYTESMORE","bytes more");
define("_COMMENTSQ","Likes & comments?");
define("_COMMENT","comment");
define("_CONFIGURE","Configure");
define("_LOGINCREATE","Login/Create an Account");
define("_THRESHOLD","Threshold");
define("_NOCOMMENTS","No Comments");
define("_NESTED","Nested");
define("_FLAT","Flat");
define("_THREAD","Thread");
define("_OLDEST","Oldest First");
define("_NEWEST","Newest First");
define("_HIGHEST","Highest Scores First");
define("_COMMENTSWARNING","The comments are owned by the poster. We are not responsible for their content.");
define("_SCORE","Score:");
define("_USERINFO","User Info");
define("_READREST","Read the rest of this comment...");
define("_REPLY","Reply to This");
define("_REPLYMAIN","Post Comment");
define("_NOSUBJECT","No Subject");
define("_NOANONCOMMENTS","No Comments Allowed for Anonymous, please <a href=\"modules.php?name=Your_Account&amp;op=new_user\">register</a>");
define("_PARENT","Parent");
define("_ROOT","Root");
define("_UCOMMENT","Comment");
define("_ALLOWEDHTML","Allowed HTML:");
define("_POSTANON","Post Anonymously");
define("_EXTRANS","Extrans (html tags to text)");
define("_HTMLFORMATED","HTML Formatted");
define("_PLAINTEXT","Plain Old Text");
define("_ONN","on...");
define("_SUBJECT","Subject");
define("_COMMENTREPLY","Comment Post");
define("_COMREPLYPRE","Comment Post Preview");
define("_NOTRIGHT","Something is not right with passing a variable to this function. This message is just to keep things from messing up down the road");
define("_SENDAMSG","Send a Message");
define("_YOUSENDSTORY","You will send the blog post");
define("_TOAFRIEND","to a specified friend:");
define("_FYOURNAME","Your Name:");
define("_FYOUREMAIL","Your E-mail:");
define("_FFRIENDNAME","Your Friend's Name:");
define("_FFRIENDEMAIL","Your Friend's E-mail:");
define("_INTERESTING","Interesting Blog Post at");
define("_YOURFRIEND","Your Friend");
define("_CONSIDERED","considered the following Blog Post to be interesting and wanted to share it with you.");
define("_FDATE","Date:");
define("_FTOPIC","Topic:");
define("_YOUCANREAD","You can read interesting Blog Posts at");
define("_FSTORY","Blog Post");
define("_HASSENT","Has been sent to");
define("_THANKS","Thanks!");
define("_RECOMMEND","Recommend this web portal to a Friend");
define("_PDATE","Date:");
define("_PTOPIC","Topic:");
define("_COMESFROM","This Blog Post comes from");
define("_THEURL","The URL for this Blog Post is:");
define("_PREVIEW","Preview");
define("_NEWUSER","New User");
define("_OPTIONS","Options");
define("_REFRESH","Refresh");
define("_NOCOMMENTSACT","Sorry, Comments are not available for this Blog Post.");
define("_ARTICLEPOLL","Blog Post's Poll");
define("_RATEARTICLE","Blog Post Rating");
define("_RATETHISARTICLE","Will you take a moment to vote for this Blog Post? Your VOTES are appreciated by the Author!");
define("_CASTMYVOTE","Cast my Vote!");
define("_AVERAGESCORE","Star Rating");
define("_BAD","Bad");
define("_REGULAR","Regular");
define("_GOOD","Good");
define("_VERYGOOD","Very Good");
define("_EXCELLENT","Excellent");
define("_ARTICLERATING","Blog Rating");
define("_THANKSVOTEARTICLE","Thanks for voting for this Blog!");
define("_ALREADYVOTEDARTICLE","Sorry, you recently voted for this Blog Post!");
define("_BACKTOARTICLEPAGE","Back to the Blog Post");
define("_DIDNTRATE","You didn't select any score for the Blog Post!");
define("_NOINFO4TOPIC","Sorry, there isn't information for the selected Blog Topic.");
define("_GOTONEWSINDEX","Go to Blog Post Index");
define("_SELECTNEWTOPIC","Select a New Blog Post Topic");
define("_GOTOHOME","Go to Home");
define("_SEARCHONTOPIC","Search on This Blog Post Topic");
define("_SEARCHDIS","Search Discussion");
define("_READPDF","Read as PDF");
define("_READWITHCOMMENTS", "You can read the complete blog post with its comments from");
/*****[BEGIN]******************************************
 [ Mod:     NSN Blog                           v1.1.0 ]
 ******************************************************/
define("_NE_SELECT","Select Blog Post Page");
define("_NE_OF","( There are ");
define("_NE_PAGES"," Blog Post Pages )");
define("_NE_NEWSCONFIG","Blog Post Configuration");
define("_NE_DISPLAYTYPE","Display Column");
define("_NE_SINGLE","Single Column");
define("_NE_DUAL","Dual Column");
define("_NE_READLINK","Read More Link");
define("_NE_POPUP","Popup");
define("_NE_PAGE","Page");
define("_NE_TEXTTYPE","Blog Post Length");
define("_NE_TRUNCATE","Truncate to 255 chars");
define("_NE_COMPLETE","Original text");
define("_NE_NOTIFYAUTH","Notify Blog Post Author");
define("_NE_NOTIFYAUTHNOTE","This will email the Blog Post submitter<br />on approval");
define("_NE_NO","No");
define("_NE_YES","Yes");
define("_NE_HOMETOPIC","Blog Post Topics in Home");
define("_NE_ALLTOPICS","All Blog Post Topics");
define("_NE_HOMENUMBER","Blog Posts in Home");
define("_NE_NUKEDEFAULT","PHP-Nuke Default");
define("_NE_ARTICLES","Blog Posts");
define("_NE_HOMENUMNOTE","This will override user preferences<br />if set other than PHP-Nuke Default");
define("_NE_SAVECHANGES","Save Changes");
/*****[END]********************************************
 [ Mod:     NSN Blogs                           v1.1.0 ]
 ******************************************************/
define("_GFX_FAILURE","Please enter the correct GFX code");
?>
