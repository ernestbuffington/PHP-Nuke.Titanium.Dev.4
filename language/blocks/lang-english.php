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
define('_COLLAPSE','Collapsible blocks?');
define('_COLLAPSE_TITLE','title');
define('_COLLAPSE_ICON','icon');
/*****[END]********************************************
 [ Base:    Switch Content Script              v2.0.0 ]
******************************************************/

/****************************************
Start Sentinel Blocks
*****************************************/
define("_AB_WARNED","You have been warned!");
define("_AB_CAUGHT","We have caught");
define("_AB_SHAME","shameful hackers.");
define("_AB_LIST","This is the list of NukeSentinel&trade; banned IP addresses.");
/*********************************************
End Sentinel Blocks
**********************************************/

/****************************************
Start  Newsletter Block
*****************************************/
define("_NEWSLOGGED","You must be logged in to signup for our newsletter!");
define("_NEWSERROR","Error retreiving newsletter settings");
define("_NEWSCLICK","Click");
define("_NEWSRECIEVE","to receive our newsletters");
define("_NEWSSTOP","to stop receiving our newsletters");
define("_NEWSHERE","Here");
/*********************************************
End  Newsletter Block
**********************************************/

/****************************************
Start  Donations Block
*****************************************/
define("_DONATE","Donate");
define("_DONATE_ANON","Anonymous");
define("_DONATE_TOTAL","Total:");
define("_DONATE_GOAL","Goal:");
define("_DONATE_DIF","Difference:");
/*********************************************
End  Donations Block
**********************************************/

/****************************************
Start  Modules Block
*****************************************/
define("_MORE","More");
define("_INACTIVE_LINKS","Inactive Links");
/*********************************************
End  Modules Block
**********************************************/

define("_NEWSLETTER","Newsletter");


?>