<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************
   Nuke-Evolution: Advanced Content Management System
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : block-Survey.php
   Author        : See Below
   Optimized by: : Quake
   Version       : 5.0.0
   Date          : 06/26/2005 (dd-mm-yyyy)

   Notes         : Surveys Block shows the current poll running on your
                   website.
************************************************************************/

if(!defined('NUKE_EVO')) exit;

if(is_active('Surveys')) {
    include_once(NUKE_MODULES_DIR.'Surveys/includes/pollblock.php');
}

?>