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

if ( !defined( 'MSNL_LOADED' ) ) { die( "Illegal File Access" ); }

/************************************************************************
* Script Initialization
************************************************************************/

/************************************************************************
* Setup the fixed newsletter variables
************************************************************************/

$msnl_sTopic			= stripslashes( $_POST['msnl_topic'] );			//Replaces the {EMAILTOPIC} tag
$msnl_sSender			= stripslashes( $_POST['msnl_sender'] );		//Replaces the {SENDER} tag
$msnl_sTextbody		= stripslashes( $_POST['msnl_textbody'] );	//Replaces the {TEXTBODY} tag
$msnl_sTemplateNm	= $_POST['msnl_template'];									//Replaces the {TEMPLATENAME} tag
$msnl_sSendDate		= date("F d Y"); 														//Replaces the {DATE} tag
$msnl_iCID				= intval( $_POST['msnl_cid'] );

/************************************************************************
* Load Template file if one was selected
************************************************************************/

if ( $msnl_sTemplateNm != "notemplate" ) {

	@include( "./modules/$msnl_sModuleNm/templates/".$msnl_sTemplateNm."/template.php" );

	$msnl_sEmailText = $emailfile;
	
} else {

	$msnl_sEmailText = "";
	
}

/************************************************************************
* Build Statistics if chosen to do so and as long as a template was selected
*  - to replace the {STATS} tag
************************************************************************/

if ( $_POST['msnl_stats'] == "yes" && $msnl_sTemplateNm != "notemplate" ) {

	//Total Members

	$sql									= "SELECT `user_id` FROM `".$prefix."_users` WHERE `username` <> 'Anonymous'";
	$result 							= msnl_fSQLCall( $sql );

	if ( !$result ) { //Bad SQL call

		msnl_fRaiseAppError( _MSNL_ADM_MAKE_ERR_DBGETSTATSUSR );	

	} else { //Successful SQL call

		$msnl_iStatsTotUsr		= intval( $db->sql_numrows( $result ) );
	
	}

	//Total Hits
	
	$sql										= "SELECT `count` FROM `".$prefix."_counter` WHERE `type` = 'total' "
													.	"AND `var` = 'hits' LIMIT 1";
	$result1 								= msnl_fSQLCall( $sql );

	if ( !$result1 ) { //Bad SQL call

		msnl_fRaiseAppError( _MSNL_ADM_MAKE_ERR_DBGETSTATSHITS );	

	} else { //Successful SQL call

		$row										= $db->sql_fetchrow( $result1 );
		$msnl_iStatsTotHits			= intval( $row['count'] );
		
	}

	//Total Blogs
	
	$sql										= "SELECT * FROM `".$prefix."_blogs`";
	$result2 								= msnl_fSQLCall( $sql );

	if ( !$result2 ) { //Bad SQL call

		msnl_fRaiseAppError( _MSNL_ADM_MAKE_ERR_DBGETSTATSNEWS );	

	} else { //Successful SQL call

		$msnl_iStatsTotNews			= intval( $db->sql_numrows( $result2 ) );

	}

	//Total News categories
	
	$sql										= "SELECT * FROM `".$prefix."_blogs_cat`";
	$result3 								= msnl_fSQLCall( $sql );

	if ( !$result3 ) { //Bad SQL call

		msnl_fRaiseAppError( _MSNL_ADM_MAKE_ERR_DBGETSTATSNEWSCAT );	

	} else { //Successful SQL call

		$msnl_iStatsTotNewsCat	= intval( $db->sql_numrows( $result3 ) );

	}

	//Total Downloads Files

	$sql										= "SELECT * FROM `".$prefix."_".$msnl_gasModCfg['dl_module']."_downloads`";
	$result4 								= msnl_fSQLCall( $sql );

	if ( !$result4 ) { //Bad SQL call

		msnl_fRaiseAppError( _MSNL_ADM_MAKE_ERR_DBGETSTATSDLS );	

	} else { //Successful SQL call

		$msnl_iStatsTotDls			= intval( $db->sql_numrows( $result4 ) );

	}
	
	//Total Downloads Categories

	$sql										= "SELECT * FROM `".$prefix."_".$msnl_gasModCfg['dl_module']."_categories`";
	$result5 								= msnl_fSQLCall( $sql );

	if ( !$result5 ) { //Bad SQL call

		msnl_fRaiseAppError( _MSNL_ADM_MAKE_ERR_DBGETSTATSDLCAT );	

	} else { //Successful SQL call

		$msnl_iStatsTotDlsCat		= intval( $db->sql_numrows( $result5 ) );

	}
	
	//Total Web Links

	$sql										= "SELECT * FROM `".$prefix."_links_links`";
	$result6 								= msnl_fSQLCall( $sql );

	if ( !$result6 ) { //Bad SQL call

		msnl_fRaiseAppError( _MSNL_ADM_MAKE_ERR_DBGETSTATSLINKS );	

	} else { //Successful SQL call

		$msnl_iStatsTotLnks			= intval( $db->sql_numrows( $result6 ) );
	
	}
	
	//Total Web Links Categories

	$sql										= "SELECT * FROM `".$prefix."_links_categories`";
	$result7 								= msnl_fSQLCall( $sql );

	if ( !$result7 ) { //Bad SQL call

		msnl_fRaiseAppError( _MSNL_ADM_MAKE_ERR_DBGETSTATSLNKCAT );	

	} else { //Successful SQL call

		$msnl_iStatsTotLnksCat	= intval( $db->sql_numrows( $result7 ) );

	}
	
	//Total Amount of Forum Topics

	$sql										= "SELECT * FROM `".$prefix."_bbtopics`";
	$result8 								= msnl_fSQLCall( $sql );

	if ( !$result8 ) { //Bad SQL call

		msnl_fRaiseAppError( _MSNL_ADM_MAKE_ERR_DBGETSTATSFORUMS );	

	} else { //Successful SQL call

		$msnl_iStatsTotForums		= intval( $db->sql_numrows( $result8 ) );
	
	}
	
	//Total Amount of forum Posts

	$sql										= "SELECT * FROM `".$prefix."_bbposts`";
	$result9 								= msnl_fSQLCall( $sql );

	if ( !$result9 ) { //Bad SQL call

		msnl_fRaiseAppError( _MSNL_ADM_MAKE_ERR_DBGETSTATSPOSTS );	

	} else { //Successful SQL call

		$msnl_iStatsTotPosts		= intval( $db->sql_numrows( $result9 ) );
	
	}
	
	//Total Amount of Reviews

	$sql										= "SELECT * FROM `".$prefix."_reviews`";
	$result10 							= msnl_fSQLCall( $sql );

	if ( !$result10 ) { //Bad SQL call

		msnl_fRaiseAppError( _MSNL_ADM_MAKE_ERR_DBGETSTATSREVIEWS );	

	} else { //Successful SQL call

		$msnl_iStatsTotReviews	= intval( $db->sql_numrows( $result10 ) );

	}
	
	//Replace the stats rows in the template

	$msnl_sTotStats = $statstable;
	
	$msnl_sTotStats = str_replace( "{PAGEHITS}",		$msnl_iStatsTotHits,		$msnl_sTotStats );
	$msnl_sTotStats = str_replace( "{MEMBERS}",			$msnl_iStatsTotUsr,			$msnl_sTotStats );
	$msnl_sTotStats = str_replace( "{NEWSITEMS}",		$msnl_iStatsTotNews,		$msnl_sTotStats );
	$msnl_sTotStats = str_replace( "{NEWSCAT}",			$msnl_iStatsTotNewsCat,	$msnl_sTotStats );
	$msnl_sTotStats = str_replace( "{DOWNLOADS}",		$msnl_iStatsTotDls,			$msnl_sTotStats );
	$msnl_sTotStats = str_replace( "{DOWNLOADCAT}",	$msnl_iStatsTotDlsCat,	$msnl_sTotStats );
	$msnl_sTotStats = str_replace( "{WEBLINKS}",		$msnl_iStatsTotLnks,		$msnl_sTotStats );
	$msnl_sTotStats = str_replace( "{WEBLINKCAT}",	$msnl_iStatsTotLnksCat,	$msnl_sTotStats );
	$msnl_sTotStats = str_replace( "{FORUMPOSTS}",	$msnl_iStatsTotPosts,		$msnl_sTotStats );
	$msnl_sTotStats = str_replace( "{FORUMTOPICS}",	$msnl_iStatsTotForums,	$msnl_sTotStats );
	$msnl_sTotStats = str_replace( "{REVIEWS}",			$msnl_iStatsTotReviews,	$msnl_sTotStats );

} else { //Will not be including Statistics

	$msnl_sTotStats = "";

}

/************************************************************************
* Build the Latest X News Items - to replace the {NEWS} tag
************************************************************************/

if ( $_POST['msnl_news'] > 0 && $msnl_sTemplateNm != "notemplate" ) {

	$i					= 0;
	$msnl_sRows	= "";

	$sql				= "SELECT `sid`, `informant`, `title`, `topic`, `topictext`, a.`counter` AS counter FROM `"
							. $prefix."_blogs` a, `"
							. $prefix."_blogs_topics` b "
							. "WHERE a.`topic` = b.`topicid` "
							. "ORDER BY `time` DESC LIMIT 0, ". $_POST['msnl_news'];

	$result11	= msnl_fSQLCall( $sql );

	if ( !$result11 ) { //Bad SQL call

		msnl_fRaiseAppError( _MSNL_ADM_SEND_ERR_DBGETNEWS );	

	} else { //Successful SQL call

		while ( $row = $db->sql_fetchrow( $result11 ) ) {

			$msnl_iSID					= intval( $row['sid'] );
			$msnl_sNewsAuthor		= stripslashes ( $row['informant'] );
			$msnl_sNewsTitle		= stripslashes( $row['title'] );
			$msnl_iNewsTopicID	= intval( $row['ctopic'] );
			$msnl_sNewsTopic		= stripslashes( $row['topictext'] );
			$msnl_iNewsHits			= intval( $row['counter'] );

			$i	= ++$i; //Keep track of row number

			$msnl_sRowTmp = $latestnewsrow;

			$msnl_sRowTmp = str_replace( "{NEWSID}",		$msnl_iSID,						$msnl_sRowTmp );
			$msnl_sRowTmp = str_replace( "{ROWNUMBER}",	$i,										$msnl_sRowTmp );
			$msnl_sRowTmp = str_replace( "{TITLE}",			$msnl_sNewsTitle,			$msnl_sRowTmp );
			$msnl_sRowTmp = str_replace( "{TOPICID}",		$msnl_iNewsTopicID,		$msnl_sRowTmp );
			$msnl_sRowTmp = str_replace( "{TOPIC}",			$msnl_sNewsTopic,			$msnl_sRowTmp );
			$msnl_sRowTmp = str_replace( "{AUTHOR}",		$msnl_sNewsAuthor,		$msnl_sRowTmp );
			$msnl_sRowTmp = str_replace( "{HITS}",			$msnl_iNewsHits,			$msnl_sRowTmp );

			$msnl_sRows .= $msnl_sRowTmp;

		} //End while to build rows
		
		$msnl_sLatestNews = $latestnewstop . $msnl_sRows . $latestnewsend;
		
		$msnl_sLatestNews = str_replace( "{AMOUNT}",	$_POST['msnl_news'],	$msnl_sLatestNews );
		
	} //End IF successful DB Call

} else { //Will not be including Latest News

	$msnl_sLatestNews = "";

} //End IF for Latest X News Items

/************************************************************************
* Build the Latest X Downloads Items - to replace the {DOWNLOADS} tag
************************************************************************/

if ( $_POST['msnl_downloads'] > 0 && $msnl_sTemplateNm != "notemplate" ) {

	$i					= 0;
	$msnl_sRows	= "";

	$sql				= "SELECT `lid`, a.`cid` as cid, a.`title` as dtitle, `hits`, b.`title` as ctitle FROM `"
							. $prefix."_".$msnl_gasModCfg['dl_module']."_downloads` a, `"
							. $prefix."_".$msnl_gasModCfg['dl_module']."_categories` b "
							. "WHERE a.`cid` = b.`cid` "
							. "ORDER BY `lid` DESC LIMIT 0, ".$_POST['msnl_downloads'];

	$result12	= msnl_fSQLCall( $sql );

	if ( !$result12 ) { //Bad SQL call

		msnl_fRaiseAppError( _MSNL_ADM_SEND_ERR_DBGETDLS );	

	} else { //Successful SQL call

		while ( $row = $db->sql_fetchrow( $result12 ) ) {

			$msnl_iLID					= intval( $row['lid'] );
			$msnl_iTopicCID			= intval( $row['cid'] );
			$msnl_sDlTitle			= stripslashes( $row['dtitle'] );
			$msnl_iDlHits				= intval( $row['hits'] );
			$msnl_sDlCat				= stripslashes( $row['ctitle'] );

			$i			= ++$i; //Keep track of row number

			$msnl_sRowTmp = $latestdownloadrow;

			$msnl_sRowTmp = str_replace( "{DOWNLOADID}",	$msnl_iLID,				$msnl_sRowTmp );
			$msnl_sRowTmp = str_replace( "{ROWNUMBER}",		$i,								$msnl_sRowTmp );
			$msnl_sRowTmp = str_replace( "{TITLE}",				$msnl_sDlTitle,		$msnl_sRowTmp );
			$msnl_sRowTmp = str_replace( "{TOPICID}",			$msnl_iTopicCID,	$msnl_sRowTmp );
			$msnl_sRowTmp = str_replace( "{TOPIC}",				$msnl_sDlCat,			$msnl_sRowTmp );
			$msnl_sRowTmp = str_replace( "{HITS}",				$msnl_iDlHits,		$msnl_sRowTmp );

			$msnl_sRows .= $msnl_sRowTmp;

		} //End While
		
		$msnl_sLatestDownloads = $latestdownloadtop . $msnl_sRows . $latestdownloadend;
		
		$msnl_sLatestDownloads = str_replace( "{AMOUNT}", $_POST['msnl_downloads'], $msnl_sLatestDownloads );
		
	} //End IF DB call successful

} else { //Will not be including Latest Downloads

	$msnl_sLatestDownloads = "";

} //End IF Downloads

/************************************************************************
* Build the Latest X Web Links - to replace the {WEBLINKS} tag
************************************************************************/

if ( $_POST['msnl_weblinks'] > 0 && $msnl_sTemplateNm != "notemplate" ) {

	$i					= 0;
	$msnl_sRows	= "";

	$sql				= "SELECT `lid`, a.`cid` as cid, a.`title` as ltitle, b.`title` as ctitle, `hits` FROM `"
							. $prefix."_links_links` a, `"
							. $prefix."_links_categories` b "
							. "WHERE a.`cid` = b.`cid` "
							. "ORDER BY `lid` DESC LIMIT 0, ". $_POST['msnl_weblinks'];

	$result13	= msnl_fSQLCall( $sql );

	if ( !$result13 ) { //Bad SQL call

		msnl_fRaiseAppError( _MSNL_ADM_MAKE_ERR_DBGETWLS );	

	} else { //Successful SQL call

		while ( $row = $db->sql_fetchrow( $result13 ) ) {

			$msnl_iLID					= intval( $row['lid'] );
			$msnl_iWlCID				= intval( $row['cid'] );
			$msnl_sWlTitle			= stripslashes( $row['ltitle'] );
			$msnl_sWlCat				= stripslashes( $row['ctitle'] );
			$msnl_iWlHits				= intval( $row['hits'] );

			$i			= ++$i; //Keep track of row number

			$msnl_sRowTmp = $latestweblinkrow;

			$msnl_sRowTmp = str_replace( "{LINKID}",		$msnl_iLID,				$msnl_sRowTmp);
			$msnl_sRowTmp = str_replace( "{ROWNUMBER}",	$i,								$msnl_sRowTmp);
			$msnl_sRowTmp = str_replace( "{TITLE}",			$msnl_sWlTitle,		$msnl_sRowTmp);
			$msnl_sRowTmp = str_replace( "{TOPICID}",		$msnl_iWlCID,			$msnl_sRowTmp);
			$msnl_sRowTmp = str_replace( "{TOPIC}",			$msnl_sWlCat,			$msnl_sRowTmp);
			$msnl_sRowTmp = str_replace( "{HITS}",			$msnl_iWlHits,		$msnl_sRowTmp);

			$msnl_sRows .= $msnl_sRowTmp;

		} //End While
		
		$msnl_sLatestLinks = $latestweblinktop . $msnl_sRows . $latestweblinkend;
		
		$msnl_sLatestLinks = str_replace( "{AMOUNT}", $_POST['msnl_weblinks'], $msnl_sLatestLinks );

	}  //End IF DB call successful

} else { //Will not be including Latest Web Links

	$msnl_sLatestLinks = "";

} //End IF Web Links

/************************************************************************
* Build the Latest X Forum Posts - to replace the {FORUMS} tag
************************************************************************/

if ($_POST['msnl_forums'] > 0 && $msnl_sTemplateNm != "notemplate") {

	$i					= 0;
	$msnl_sRows	= "";
	
	$msnl_iHideReadOnly = 1;	//Do not show read-only forums

	$sql				= "SELECT "
								."t.`topic_id` AS topic_id, "
								."t.`forum_id` AS forum_id, "
								."`topic_last_post_id`, "
								."`topic_title`, "
								."`topic_views`, "
								."`topic_replies`, "
								."`post_time`, "
								."ut.`username` AS ut_username, "
								."ut.`user_id` AS ut_user_id, "
								."up.`username` AS up_username, "
								."up.`user_id` AS up_user_id "
							."FROM `"
								.$prefix."_bbtopics` t, `"
								.$prefix."_bbforums` f, `"
								.$prefix."_bbposts` p, `"
								.$prefix."_users` ut, `"
								.$prefix."_users` up "
							."WHERE "
								."f.`forum_id` = t.`forum_id` "
							."AND "
								."`post_id` = `topic_last_post_id` "
							."AND "
								."ut.`user_id` = `topic_poster` "
							."AND "
								."up.`user_id` = `poster_id` ";

	if ( $msnl_iHideReadOnly == 1 ) {  //Exclude posts which should be hidden

		$sql .= "AND `auth_view` = '0' AND `auth_read` = '0' ";

	}

	$sql .= "AND `topic_moved_id` = '0' "
				. "ORDER BY `topic_last_post_id` DESC LIMIT 0, ". $_POST['msnl_forums'];

	$result14	= msnl_fSQLCall( $sql );

	if ( !$result14 ) { //Bad SQL call

		msnl_fRaiseAppError( _MSNL_ADM_MAKE_ERR_DBGETPOSTS );	

	} else { //Successful SQL call

		while ( $row = $db->sql_fetchrow( $result14 ) ) {

			$msnl_iTopicID							= intval( $row['topic_id'] );
			$msnl_iForumID							= intval( $row['forum_id'] );
			$msnl_iPostID								= intval( $row['topic_last_post_id'] );
			$msnl_sTopicTitle						= stripslashes( $row['topic_title'] );
			$msnl_iTopicViews						= intval( $row['topic_views'] );
			$msnl_iTopicReplies					= intval( $row['topic_replies'] );
			$msnl_sPostTime							= msnl_fFormatDate( $msnl_asPHPBBCfg['default_dateformat'], 
																			$row['post_time'], $msnl_asPHPBBCfg['board_timezone'] );
			$msnl_sTopicPosterNm				= stripslashes( $row['ut_username'] );
			$msnl_sTopicPosterID				= intval( $row['ut_user_id'] );
			$msnl_sLastPosterNm					= stripslashes( $row['up_username'] );
			$msnl_iLastPosterID					= intval( $row['up_user_id'] );

			$i			= ++$i; //Keep track of row number

			$msnl_sRowTmp = $latestforumrow;

			$msnl_sRowTmp = str_replace( "{ROWNUMBER}",					$i, 									$msnl_sRowTmp );
			$msnl_sRowTmp = str_replace( "{FTOPICLASTPOSTID}",	$msnl_iPostID, 				$msnl_sRowTmp );
			$msnl_sRowTmp = str_replace( "{FTOPICID}",					$msnl_iTopicID, 			$msnl_sRowTmp );
			$msnl_sRowTmp = str_replace( "{FTOPICREPLIES}",			$msnl_iTopicReplies,	$msnl_sRowTmp );
			$msnl_sRowTmp = str_replace( "{FTOPICTITLE}",				$msnl_sTopicTitle, 		$msnl_sRowTmp );
			$msnl_sRowTmp = str_replace( "{FTPUSERID}",					$msnl_iTopicPosterID,	$msnl_sRowTmp );
			$msnl_sRowTmp = str_replace( "{FTPUSERNAME}",				$msnl_sTopicPosterNm,	$msnl_sRowTmp );
			$msnl_sRowTmp = str_replace( "{FVIEWS}",						$msnl_iTopicViews,		$msnl_sRowTmp );
			$msnl_sRowTmp = str_replace( "{FTIME}",							$msnl_sPostTime,			$msnl_sRowTmp );
			$msnl_sRowTmp = str_replace( "{FUSERID}",						$msnl_iLastPosterID,	$msnl_sRowTmp );
			$msnl_sRowTmp = str_replace( "{FUSERNAME}",					$msnl_sLastPosterNm,	$msnl_sRowTmp );

			$msnl_sRows .= $msnl_sRowTmp;

		} //End While
		
		$msnl_sLatestForums = $latestforumtop . $msnl_sRows . $latestforumend;
		
		$msnl_sLatestForums = str_replace( "{AMOUNT}", $_POST['msnl_forums'], $msnl_sLatestForums );

	}  //End IF DB call successful

} else { //Will not be including Latest Forum Posts

	$msnl_sLatestForums = "";

} //End IF Forum Posts

/************************************************************************
* Build the Latest X Reviews - to replace the {REVIEWS} tag
************************************************************************/

if ( $_POST['msnl_reviews'] > 0 && $msnl_sTemplateNm != "notemplate" ) {

	$i					= 0;
	$msnl_sRows	= "";

	$sql				= "SELECT `id`, `reviewer`, `title`, `hits`, `date` FROM `"
							. $prefix."_reviews` "
							. "ORDER BY `id` DESC LIMIT 0, ". $_POST['msnl_reviews'];

	$result15	= msnl_fSQLCall( $sql );

	if ( !$result15 ) { //Bad SQL call

		msnl_fRaiseAppError( _MSNL_ADM_MAKE_ERR_DBGETREVIEWS );	

	} else { //Successful SQL call

		while ( $row = $db->sql_fetchrow( $result15 ) ) {

			$msnl_iReviewID				= intval( $row['id'] );
			$msnl_sReviewAuthor		= stripslashes( $row['reviewer'] );
			$msnl_sReviewTitle		= stripslashes( $row['title'] );
			$msnl_iReviewHits			= intval( $row['hits'] );
			$msnl_sReviewDt				= stripslashes( $row['date'] );

			$msnl_sReviewDtFormat = trim( eregi_replace( "[g\:iabhsu]", "", $msnl_asPHPBBCfg['default_dateformat'] ) );

			$msnl_sReviewDt = msnl_fFormatDate( $msnl_sReviewDtFormat, 
												strtotime( $msnl_sReviewDt ), $msnl_asPHPBBCfg['board_timezone'] );

			$i	= ++$i;

			$msnl_sRowTmp = $latestreviewsrow;

			$msnl_sRowTmp = str_replace( "{ROWNUMBER}",			$i,										$msnl_sRowTmp );
			$msnl_sRowTmp = str_replace( "{REVIEWID}",			$msnl_iReviewID,			$msnl_sRowTmp );
			$msnl_sRowTmp = str_replace( "{TITLE}",					$msnl_sReviewTitle,		$msnl_sRowTmp );
			$msnl_sRowTmp = str_replace( "{REVIEWAUTHOR}",	$msnl_sReviewAuthor,	$msnl_sRowTmp );
			$msnl_sRowTmp = str_replace( "{REVIEWDATE}",		$msnl_sReviewDt,			$msnl_sRowTmp );
			$msnl_sRowTmp = str_replace( "{HITS}",					$msnl_iReviewHits,		$msnl_sRowTmp );

			$msnl_sRows .= $msnl_sRowTmp;

		}  //End While

		$msnl_sLatestReviews = $latestreviewstop . $msnl_sRows . $latestreviewsend;

		$msnl_sLatestReviews = str_replace( "{AMOUNT}", $_POST['msnl_reviews'], $msnl_sLatestReviews );

	}  //End IF DB call successful

} else { //Will not be including Latest Reviews

	$msnl_sLatestReviews = "";

} //End IF Reviews

/************************************************************************
* Build the Banner Link - to replace {BANNER} tag
************************************************************************/

if ( $_POST['msnl_banner'] != "" && $msnl_sTemplateNm != "notemplate" ) {

	$sql	= "SELECT `imageurl`, `clickurl`, `alttext` FROM `"
				. $prefix."_banner` WHERE `bid` = '". $_POST['msnl_banner'] ."'";

	$result16	= msnl_fSQLCall( $sql );

	if ( !$result16 ) { //Bad SQL call

		msnl_fRaiseAppError( _MSNL_ADM_MAKE_ERR_DBGETBANNER );	

	} else { //Successful SQL call
	
		$row = $db->sql_fetchrow( $result16 );
		
		$msnl_sImageURL		= stripslashes( $row['imageurl'] );
		$msnl_sClickURL		= stripslashes( $row['clickurl'] );
		$msnl_sAltText		= stripslashes( $row['alttext'] );

		$msnl_sBanner = "<a href=\"$msnl_sClickURL\" title=\"\">"
									. "<img src=\"$msnl_sImageURL\" alt=\"$msnl_sAltText\">"
									. "</a>\n";
						
	} //End IF DB call successful

} else {

	$msnl_sBanner = "";

} //End IF Banner link

/************************************************************************
* Build the Newsletter Table of Contents - to replace {TOC} tag
************************************************************************/

if ( $_POST['msnl_toc'] != "" && $msnl_sTemplateNm != "notemplate" && isset( $newscontentsrow ) ) {

	$msnl_sRows			= "";
	$msnl_sRowTmp		= "";

	//Check for HTML anchors in the Textbody entry field.  If found, will need to create links to them

	$msnl_iMatch	= preg_match_all( '/<\s*A\s*NAME="([^\"]+)"\s*><\/A>/i', $msnl_sTextbody,
										$msnl_asMatches, PREG_SET_ORDER );

	if ( $msnl_iMatch ) { //We found HTML anchors

		foreach ( $msnl_asMatches as $msnl_sVal ) { //Cycle through the anchors and create links

			$msnl_sRowTmp			= $newscontentsrow;
			$msnl_sAnchorNm		= $msnl_sVal[1];

			$msnl_sRowTmp			= str_replace( "{TOCLINK}", $msnl_sAnchorNm, $msnl_sRowTmp );
			$msnl_sRowTmp     = str_replace( "{TOCLINKTEXT}", str_replace("_"," ",$msnl_sAnchorNm), 
														$msnl_sRowTmp );

			$msnl_sRows	.= $msnl_sRowTmp;

		}

	} //End IF to check for HTML anchors

	//Create a link to Latest News if it exists

	if ( $_POST['msnl_news'] > 0 ) {

		$msnl_sRowTmp		= $newscontentsrow;
		$msnl_sRowTmp		= str_replace( "{TOCLINK}",			"LatestNews",						$msnl_sRowTmp );
		$msnl_sRowTmp		= str_replace( "{TOCLINKTEXT}",	"Latest News Articles",	$msnl_sRowTmp );

		$msnl_sRows	.= $msnl_sRowTmp;

	}

	//Create a link to Latest Downloads if it exists

	if ( $_POST['msnl_downloads'] > 0 ) {

		$msnl_sRowTmp		= $newscontentsrow;
		$msnl_sRowTmp		= str_replace( "{TOCLINK}",			"LatestDownloads",		$msnl_sRowTmp );
		$msnl_sRowTmp		= str_replace( "{TOCLINKTEXT}",	"Latest Downloads",		$msnl_sRowTmp );

		$msnl_sRows .= $msnl_sRowTmp;

	}

	//Create a link to Latest Web Links if it exists

	if ( $_POST['msnl_weblinks'] > 0 ) {

		$msnl_sRowTmp		= $newscontentsrow;
		$msnl_sRowTmp		= str_replace( "{TOCLINK}",			"LatestLinks",			$msnl_sRowTmp );
		$msnl_sRowTmp		= str_replace( "{TOCLINKTEXT}",	"Latest Web Links",	$msnl_sRowTmp );

		$msnl_sRows .= $msnl_sRowTmp;

	}

	//Create a link to Latest Forums if it exists

	if ( $_POST['msnl_forums'] > 0 ) {

		$msnl_sRowTmp		= $newscontentsrow;
		$msnl_sRowTmp		= str_replace( "{TOCLINK}",			"LatestPosts",				$msnl_sRowTmp );
		$msnl_sRowTmp		= str_replace( "{TOCLINKTEXT}",	"Latest Forum Posts",	$msnl_sRowTmp );

		$msnl_sRows .= $msnl_sRowTmp;

	}

	//Create a link to Latest Reviews if it exists

	if ( $_POST['msnl_reviews'] > 0 ) {

		$msnl_sRowTmp		= $newscontentsrow;
		$msnl_sRowTmp		= str_replace( "{TOCLINK}",			"LatestReviews",		$msnl_sRowTmp );
		$msnl_sRowTmp		= str_replace( "{TOCLINKTEXT}",	"Latest Reviews",		$msnl_sRowTmp );

		$msnl_sRows .= $msnl_sRowTmp;

	}

	//Create a link to Latest Reviews if it exists

	if ( $_POST['msnl_stats'] > 0 ) {

		$msnl_sRowTmp		= $newscontentsrow;
		$msnl_sRowTmp		= str_replace( "{TOCLINK}",			"Statistics",				$msnl_sRowTmp );
		$msnl_sRowTmp		= str_replace( "{TOCLINKTEXT}",	"Site Statistics",	$msnl_sRowTmp );

		$msnl_sRows .= $msnl_sRowTmp;

	}

	// Finalize the TOC "block"
	
	$msnl_sNewsletterTOC = $newscontentstop . $msnl_sRows . $newscontentsend;

} else { //TOC was not selected

	$msnl_sNewsletterTOC = "";

} //End IF for TOC build

/************************************************************************
* Replace the newsletter template {} (tags)
************************************************************************/

if ( $msnl_sTemplateNm != "notemplate" ) { //Admin/author elected to use a newsletter template

	$msnl_sEmailText = str_replace( "{TOC}",					$msnl_sNewsletterTOC,			$msnl_sEmailText );
	$msnl_sEmailText = str_replace( "{NEWS}",					$msnl_sLatestNews,				$msnl_sEmailText );
	$msnl_sEmailText = str_replace( "{WEBLINKS}",			$msnl_sLatestLinks,				$msnl_sEmailText );
	$msnl_sEmailText = str_replace( "{FORUMS}",				$msnl_sLatestForums,			$msnl_sEmailText );
	$msnl_sEmailText = str_replace( "{DOWNLOADS}",		$msnl_sLatestDownloads,		$msnl_sEmailText );
	$msnl_sEmailText = str_replace( "{REVIEWS}",			$msnl_sLatestReviews,			$msnl_sEmailText );
	$msnl_sEmailText = str_replace( "{STATS}",				$msnl_sTotStats,					$msnl_sEmailText );
	$msnl_sEmailText = str_replace( "{EMAILTOPIC}",		$msnl_sTopic,							$msnl_sEmailText );
	$msnl_sEmailText = str_replace( "{USERNAME}",			$msnl_sLastPosterNm,			$msnl_sEmailText ); //Not right! Fix it!
	$msnl_sEmailText = str_replace( "{TEXTBODY}",			$msnl_sTextbody,					$msnl_sEmailText );
	$msnl_sEmailText = str_replace( "{DATE}",					$msnl_sSendDate,					$msnl_sEmailText ); //Needs to be localized
	$msnl_sEmailText = str_replace( "{SITEURL}",			$nukeurl,									$msnl_sEmailText );
	$msnl_sEmailText = str_replace( "{SITENAME}",			$sitename,								$msnl_sEmailText );
	$msnl_sEmailText = str_replace( "{BANNER}",				$msnl_sBanner,						$msnl_sEmailText );
	$msnl_sEmailText = str_replace( "{SENDER}",				$msnl_sSender,						$msnl_sEmailText );
	$msnl_sEmailText = str_replace( "{ADMINEMAIL}",		$adminmail,								$msnl_sEmailText );
	$msnl_sEmailText = str_replace( "{TEMPLATENAME}",	$msnl_sTemplateNm,				$msnl_sEmailText );
	
} else { //Admin/author elected to NOT use a template

	$msnl_sEmailText = $msnl_sTextbody;

} //End IF on Template check

/************************************************************************
* Finish building the final Newsletter File content
************************************************************************/

$msnl_sTopic			= str_replace( "&quot;", "\"", $msnl_sTopic );
$msnl_sSender			= str_replace( "&quot;", "\"", $msnl_sSender );

$msnl_sNewsletter = "<?php\n"
									. "if (!defined('MSNL_LOADED')){die(\"Cannot Access Newsletter Directly\");}\n"
									. "\$ftopic = \"". addslashes($msnl_sTopic) ."\";\n"
									. "\$fsender = \"". addslashes($msnl_sSender) ."\";\n"
									. "\$fcid = \"". $msnl_iCID ."\";\n"
									. "\$emailfile = <<< EOD\n"
									. $msnl_sEmailText
									. "\nEOD;\n"
									. "\n?>";

?>