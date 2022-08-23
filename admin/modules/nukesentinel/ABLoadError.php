<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts(tm) (http://nukescripts.86it.us)     */
/* Copyright (c) 2000-2008 by NukeScripts(tm)           */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/

if (!defined('NUKESENTINEL_ADMIN')) {
   die ('You can\'t access this file directly...');
}

$pagetitle = "NukeSentinel(tm): Error Loading Functions";
include_once(NUKE_BASE_DIR.'header.php');
title($pagetitle);
OpenTable();
echo 'It appears that NukeSentinel(tm) has not been configured correctly.  The
most common cause is that you either have an error in the syntax that is
including includes/nukesentinel.php from your mainfile.php, or you have not
added the NukeSentinel(tm) code to your mainfile.php.  Details for including this
code are included in the download package in the <strong>Edits_For_Core_Files</strong> directory.';
CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>