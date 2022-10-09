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
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
      Caching System                           v1.0.0       11/19/2005
 ************************************************************************/
if (!defined('NUKE_EVO')) 
die("You can't access this file directly...");

global $db, $prefix, $cache;

##################################################
# Load dynamic meta tags from database           #
##################################################

  /*****[BEGIN]******************************************
   [ Base:    Caching System                     v3.0.0 ]
   ******************************************************/
if(($metatags = $cache->load('metatags', 'config')) === false) 
{
  /*****[END]********************************************
   [ Base:    Caching System                     v3.0.0 ]
   ******************************************************/
  $metatags = array();
  $sql = 'SELECT meta_name, meta_content FROM '.$prefix.'_meta';
  $result = $db->sql_query($sql, true);
  $i=0;

  while(list($meta_name, $meta_content) = $db->sql_fetchrow($result, SQL_NUM)) 
  {
      $metatags[$i] = array();
      $metatags[$i]['meta_name'] = $meta_name;
      $metatags[$i]['meta_content'] = $meta_content;
      $i++;
  }
  
  unset($i);
  
  $db->sql_freeresult($result);
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
  $cache->save('metatags', 'config', $metatags);
}
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
$metastring .= '<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />'."\n";

/**
 * Only add the meta tag below if the theme is bootstrap made.
 */
if(defined('BOOTSTRAP'))
$metastring .= '<meta name="viewport" content="width=device-width, maximum-scale=1.0; user-scalable=no" />'."\n";
else
$metastring .= '<meta name="viewport" content="width=device-width, initial-scale=1.0" />'."\n";


for($i=0,$j=count($metatags);$i<$j;$i++) 
{
	$metatag = $metatags[$i];
    $metastring .= '<meta name="'.$metatag['meta_name'].'" content="'.$metatag['meta_content'].'" />'."\n";
}

###############################################
# DO NOT REMOVE THE FOLLOWING COPYRIGHT LINE! #
# YOU'RE NOT ALLOWED TO REMOVE NOR EDIT THIS. #
###############################################

// IF YOU REALLY NEED TO REMOVE IT AND HAVE MY WRITTEN AUTHORIZATION CHECK: http://phpnuke.org/modules.php?name=Commercial_License
// PLAY FAIR AND SUPPORT THE DEVELOPMENT, PLEASE!
$metastring .= '<meta name="generator" content="The US Version of PHP-Nuke Titanium Copyright (c) 2021 by Brandon Maintenance Management, LLC" />'."\n";

echo $metastring;
