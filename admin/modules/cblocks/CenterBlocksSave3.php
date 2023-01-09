<?php

/********************************************************/
/* NSN Center Blocks                                    */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://nukescripts.86it.us                           */
/* Copyright © 2000-2005 by NukeScripts Network         */
/* Ported for Nuke-Evolution by Quake                   */
/* http://www.evo-mods.com                              */
/* Additional Porting by co0kz & Rodmar                 */
/* http://www.cookie-creations.net                      */
/* http://www.evolved-Systems.net                       */
/********************************************************/
/* Original by: Richard Benfield                        */
/* http://www.benfield.ws                               */
/********************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Caching System                           v1.0.0       10/29/2005
 ************************************************************************/

if(!defined('ADMIN_FILE')) {
    exit('Access Denied');
}
global $cache, $prefix, $db;
$x1content = html_entity_decode($x1content, ENT_QUOTES);
$x2content = html_entity_decode($x2content, ENT_QUOTES);
$x3content = html_entity_decode($x3content, ENT_QUOTES);
$x4content = html_entity_decode($x4content, ENT_QUOTES);
$x1content = stripslashes(FixQuotes($x1content));
$x2content = stripslashes(FixQuotes($x2content));
$x3content = stripslashes(FixQuotes($x3content));
$x4content = stripslashes(FixQuotes($x4content));
if($x1name > "") { $x1content = ""; }
if($x2name > "") { $x2content = ""; }
if($x3name > "") { $x3content = ""; }
if($x4name > "") { $x4content = ""; }
$x1title = html_entity_decode($x1title, ENT_QUOTES);
$x2title = html_entity_decode($x2title, ENT_QUOTES);
$x3title = html_entity_decode($x3title, ENT_QUOTES);
$x4title = html_entity_decode($x4title, ENT_QUOTES);
$x1title = stripslashes(FixQuotes($x1title));
$x2title = stripslashes(FixQuotes($x2title));
$x3title = stripslashes(FixQuotes($x3title));
$x4title = stripslashes(FixQuotes($x4title));
$x1content = addslashes($x1content);
$x2content = addslashes($x2content);
$x3content = addslashes($x3content);
$x4content = addslashes($x4content);
$x1title = addslashes($x1title);
$x2title = addslashes($x2title);
$x3title = addslashes($x3title);
$x4title = addslashes($x4title);
$result = $db->sql_query("UPDATE `".$prefix."_nsncb_config` SET `enabled`='$xenabled', `count`='$xcount', `height`='$xheight' WHERE `cgid`='3'");
$result1 = $db->sql_query("UPDATE `".$prefix."_nsncb_blocks` SET `content`='$x1content', `filename`='$x1name', `title`='$x1title', `wtype`='$x1wtype', `width`='$x1width' WHERE `cbid`='1' AND `cgid`='3'");
$result2 = $db->sql_query("UPDATE `".$prefix."_nsncb_blocks` SET `content`='$x2content', `filename`='$x2name', `title`='$x2title', `wtype`='$x2wtype', `width`='$x2width' WHERE `cbid`='2' AND `cgid`='3'");
$result3 = $db->sql_query("UPDATE `".$prefix."_nsncb_blocks` SET `content`='$x3content', `filename`='$x3name', `title`='$x3title', `wtype`='$x3wtype', `width`='$x3width' WHERE `cbid`='3' AND `cgid`='3'");
$result4 = $db->sql_query("UPDATE `".$prefix."_nsncb_blocks` SET `content`='$x4content', `filename`='$x4name', `title`='$x4title', `wtype`='$x4wtype', `width`='$x4width' WHERE `cbid`='4' AND `cgid`='3'");
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v1.0.0 ]
 ******************************************************/
$cache->delete('cb_blocks', 'config');
/*****[END]********************************************
 [ Base:    Caching System                     v1.0.0 ]
 ******************************************************/
redirect($admin_file.'.php?op=CenterBlocksSet3');

?>