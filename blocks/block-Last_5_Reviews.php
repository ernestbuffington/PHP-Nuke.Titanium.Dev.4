<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
      Caching System                           v1.0.0       10/31/2005
-=[Block]=-
      Last 5 Reviews                           v1.0.0       06/10/2005
 ************************************************************************/

if(!defined('NUKE_EVO')) exit;

global $prefix, $db;

# Number of reviews to display
$number_of_reviews = 5;
$image_height = 100;
$image_width = 100;

$sql = "SELECT id, title, text, cover, date FROM ".$prefix."_reviews ORDER BY id DESC LIMIT 0,$number_of_reviews ";

$result = $db->sql_query($sql);

while (list($id, $title, $text, $cover, $date) = $db->sql_fetchrow($result)) {
    $id = intval($id);
    $title = stripslashes($title);
    $cover = wordwrap($cover);
    $content .= "<table width=\"100%\" border=\"0\"><tr><td><strong><big>&middot;</big></strong>&nbsp; ";
    $content .= "<a href=\"modules.php?name=Reviews&amp;rop=showcontent&amp;id=$id\"><span style=\"color: white\"><strong>$title</strong></span></a><br /></td></tr></table>";
    $content .= "<table width=\"100%\" border=\"0\"><a href=\"modules.php?name=Reviews&amp;rop=showcontent&amp;id=$id\">";
    $content .= "<img src=\"images/reviews/$cover\" width=\"$image_width\" height=\"$image_height\" /></a></td></tr></table>";
}
$db->sql_freeresult($result);
?>