<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* Based on Journey Links Hack                                          */
/* Copyright (c) 2000 by James Knickelbein                              */
/* Journey Milwaukee (http://www.journeymilwaukee.com)                  */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/*                                                                      */
/************************************************************************/
/*         Additional security & Abstraction layer conversion           */
/*                           2003 chatserv                              */
/*      http://www.nukefixes.com -- http://www.nukeresources.com        */
/************************************************************************/

//
//Web Links Preferences (Some variables are valid also for Downloads)
//
$perpage = 10;                       //How many links to show on each page?
$popular = 5000;                     //How many hits need a link to be listed as popular?
$newlinks = 10;                      //How many links to display in the New Links Page?
$toplinks = 25;                      //How many links to display in The Best Links Page? (Most Popular)
$linksresults = 10;                  //How many links to display on each search result page?
$links_anonaddlinklock = 1;          //Lock Unregistered users from Suggesting New Links? (0=Yes 1=No)
$anonwaitdays = 1;                   //Number of days anonymous users need to wait to vote on a link
$outsidewaitdays = 1;                //Number of days outside users need to wait to vote on a link (checks IP)
$useoutsidevoting = 1;               //Allow Webmasters to put vote links on their site (1=Yes 0=No)
$anonweight = 10;                    //How many Unregistered User vote per 1 Registered User Vote?
$outsideweight = 20;                 //How many Outside User vote per 1 Registered User Vote?
$detailvotedecimal = 2;              //Let Detailed Vote Summary Decimal out to N places. (no max)
$mainvotedecimal = 1;                //Let Main Vote Summary Decimal show out to N places. (max 4)
$toplinkspercentrigger = 0;          //1 to Show Top Links as a Percentage (else # of links)
$toplinks = 25;                      //Either # of links OR percentage to show (percentage as whole number. #/100)
$mostpoplinkspercentrigger = 0;      //1 to Show Most Popular Links as a Percentage (else # of links)
$mostpoplinks = 25;                  //Either # of links OR percentage to show (percentage as whole number. #/100)
$featurebox = 1;                     //1 to Show Feature Link Box on links Main Page? (1=Yes 0=No)
$linkvotemin = 5;                    //Number votes needed to make the 'top 10' list
$blockunregmodify = 1;               //Block unregistered users from suggesting links changes? (1=Yes 0=No)
?>
