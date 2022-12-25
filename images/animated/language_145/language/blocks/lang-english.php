<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/**************************************************************************/
/* PHP-NUKE: Advanced Content Management System                           */
/* ============================================                           */
/*                                                                        */
/* This is the language module with all the system messages               */
/*                                                                        */
/* If you made a translation, please go to the site and send to me        */
/* the translated file. Please keep the original text order by modules,   */
/* and just one message per line, also double check your translation!     */
/*                                                                        */
/* You need to change the second quoted phrase, not the capital one!      */
/*                                                                        */
/* If you need to use double quotes (") remember to add a backslash (\),  */
/* so your entry will look like: This is \"double quoted\" text.          */
/* And, if you use HTML code, please double check it.                     */
/**************************************************************************/

global $blockslang;

/**
 * Language Defines: block-Honey_Pot.php
 * @since 2.0.9e
 */
$blockslang['honeypot']['bots_stopped'] = '<font color="#feac00">We have %s <font color="#fe8e01">%s</font> %s Bots<br /> in the Honey Pot!</font>';
$blockslang['honeypot']['bots_in_pot'] = 'Bots in the pot!';

/**
 * Language Defines: block-Forums.php
 * @since 2.0.9e
 */
$blockslang['forums']['topic'] = 'Topic';
$blockslang['forums']['forum'] = 'Forum';
$blockslang['forums']['last_post'] = 'Last Post';
$blockslang['forums']['none'] = 'There are no topics.';
$blockslang['forums']['by'] = 'by %s';
$blockslang['forums']['started'] = 'Started by %s';
$blockslang['forums']['view_latest'] = 'View Latest Post';

/**
 * Language Defines that are globally used: block-Forums.php
 * @since 2.0.9e
 */
$blockslang['global']['replies'] = 'Replies';
$blockslang['global']['views'] = 'Views';

/*****[BEGIN]******************************************
 [ Base:    Switch Content Script              v2.0.0 ]
 ******************************************************/
define_once('_COLLAPSE','Collapsible blocks?');
define_once('_COLLAPSE_TITLE','title');
define_once('_COLLAPSE_ICON','icon');
/*****[END]********************************************
 [ Base:    Switch Content Script              v2.0.0 ]
******************************************************/

/****************************************
Start Sentinel Blocks
*****************************************/
define_once("_AB_WARNED","You have been warned!");
define_once("_AB_CAUGHT","We have caught");
define_once("_AB_SHAME","shameful hackers.");
define_once("_AB_LIST","This is the list of NukeSentinel&trade; banned IP addresses.");
/*********************************************
End Sentinel Blocks
**********************************************/

/****************************************
Start  Newsletter Block
*****************************************/
define_once("_NEWSLOGGED","You must be logged in to signup for our newsletter!");
define_once("_NEWSERROR","Error retreiving newsletter settings");
define_once("_NEWSCLICK","Click");
define_once("_NEWSRECIEVE","to receive our newsletters");
define_once("_NEWSSTOP","to stop receiving our newsletters");
define_once("_NEWSHERE","Here");
/*********************************************
End  Newsletter Block
**********************************************/

/****************************************
Start  Donations Block
*****************************************/
define_once("_DONATE","Donate");
define_once("_DONATE_ANON","Anonymous");
define_once("_DONATE_TOTAL","Total:");
define_once("_DONATE_GOAL","Goal:");
define_once("_DONATE_DIF","Difference:");
/*********************************************
End  Donations Block
**********************************************/

/****************************************
Start  Modules Block
*****************************************/
define_once("_MORE","More");
define_once("_INACTIVE_LINKS","Inactive Links");
/*********************************************
End  Modules Block
**********************************************/

define_once("_NEWSLETTER","Newsletter");
define_once("_THEMES_DEFAULT", "Default Theme");

?>