<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************
   Nuke-Evolution: Spambot Killer
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : index.php
   Author        : N/A
   Optimized by  : LombudXa (Rodmar) (www.evolved-Systems.net)
   Version       : 2.0.0
   Date          : 09.18.2005 (mm.dd.yyyy)

   Description   : Floods spambots with useless emails!
                   Spambots often get your email by harvesting it from
                   your website. This script feeds them tons of fake
                   emails until they crash, loading their database with
                   fake emails that will bounce when spammed!
                   This script has been designed for deadliness. It
                   attracts spambots with advertising keywords (you must
                   link to it first), generates about 300+ fake emails
                   and 10 links back to it (with a slightly different URL
                   each time), several kilobytes of random ASCII to
                   confuse the spambot, a limit on the number of times
                   the page is retrieved by a spambot (to limit bandwidth
                   consumption), and then sends the spambots to dozens of
                   other similar deathtraps! (So the spambot still
                   receives tons of fake emails, but the bandwidth
                   consumed is not all yours!).
************************************************************************/

define("_SBK","Spambot Killer");
define("_SBK_MORE","Get some more!");
define("_SBK_SERVED"," emails served!");
define("_SBK_BOTS_ONLY","The below section is strictly for s<!-- -->pambots only!");

?>