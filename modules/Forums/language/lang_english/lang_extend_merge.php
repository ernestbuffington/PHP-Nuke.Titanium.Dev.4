<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                        lang_extend_merge.php [English]
 *                        -------------------------------
 *    begin                : 28/09/2003
 *    copyright            : Ptirhiik
 *    email                : ptirhiik@clanmckeen.com
 *
 *    version                : 1.0.1 - 21/10/2003
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

if (!defined('IN_PHPBB2'))
{
    die('ACCESS DENIED');
}

// admin part
if ( $titanium_lang_extend_admin )
{
    $titanium_lang['Lang_extend_merge'] = 'Simply Merge Threads';
}

$titanium_lang['Refresh'] = 'Refresh';
$titanium_lang['Merge_topics'] = 'Merge topics';
$titanium_lang['Merge_title'] = 'New topic title';
$titanium_lang['Merge_title_explain'] = 'This will be the new title of the final topic. Let it blank if you want the system to use the title of the destination topic';
$titanium_lang['Merge_topic_from'] = 'Topic to merge';
$titanium_lang['Merge_topic_from_explain'] = 'This topic will be merged to the other topic. You can input the topic id, the url of the topic, or the url of a post in this topic';
$titanium_lang['Merge_topic_to'] = 'Destination topic';
$titanium_lang['Merge_topic_to_explain'] = 'This topic will get all the posts of the precedent topic. You can input the topic id, the url of the topic, or the url of a post in this topic';
$titanium_lang['Merge_from_not_found'] = 'The topic to merge hasn\'t been found';
$titanium_lang['Merge_to_not_found'] = 'The destination topic hasn\'t been found';
$titanium_lang['Merge_topics_equals'] = 'You can\'t merge a topic with itself';
$titanium_lang['Merge_from_not_authorized'] = 'You are not authorized to moderate topics coming from the forum of the topic to merge';
$titanium_lang['Merge_to_not_authorized'] =  'You are not authorized to moderate topics coming from the forum of the destination topic';
$titanium_lang['Merge_poll_from'] = 'There is a poll on the topic to merge. It will be copied to the destination topic';
$titanium_lang['Merge_poll_from_and_to'] = 'The destination topic already has got a poll. The poll of the topic to merge will be deleted';
$titanium_lang['Merge_confirm_process'] = 'Are you sure you want to merge <br />"<strong>%s</strong>"<br />to<br />"<strong>%s</strong>"';
$titanium_lang['Merge_topic_done'] = 'The topics have been successfully merged.';

?>