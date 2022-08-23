<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************
   Nuke-Evolution: News Feed 2.0
   ============================================
   Copyright (c) 2006 by The Nuke-Evolution Team

   Filename      : downloads.php
   Author        : LombudXa (Rodmar) (www.evolved-Systems.net)
   Version       : 3.0.0
   Date          : 12/10/2006 (mm-dd-yyyy)

   Notes         : This will parse your Downloads for RSS readers.
                   Some code has been used from RSS 2.0 backend.php
                   (http://www.truden.com)
************************************************************************/

/*****[CHANGES]**********************************************************
-=[Mods]=-
      RSS Improvements                         v3.0.0       12/07/2006
 ************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

$sitename = entity_to_hex_value($sitename);
$nukeurl = htmlspecialchars($nukeurl);
$backend_title = entity_to_hex_value($backend_title);
$slogan = entity_to_hex_value($slogan);

$gmtdiff = date("O", time());
$gmtstr = substr($gmtdiff, 0, 3) . ":" . substr($gmtdiff, 3, 9);
// Format: 2004-08-02T12:15:23-06:00 (W3C Compliant)
$now = date("Y-m-d\TH:i:s", time());
$now = $now . $gmtstr;

// $num = (isset($num) && is_integer(intval($num)) && intval($num) > 0) ? 'LIMIT '.$num : 'LIMIT 10';
$num = 'LIMIT 20';

$cat = intval($cat);
if (!empty($cat)) 
{
    $catid = $db->sql_ufetchrow("SELECT cid FROM `".$prefix."_file_repository_categories` WHERE `cname` LIKE '%$cat%' LIMIT 1");
    if (empty($catid))
    {
        $result = $db->sql_query("SELECT `did`, `title`, `description`, `date`, `sname` FROM `".$prefix."_file_repository_items` WHERE `isactive` = 1 ORDER BY `did` DESC ".$num);
    } 
    else 
    {
        $catid = intval($catid);
        $result = $db->sql_query("SELECT `did`, `title`, `description`, `date`, `sname` FROM `".$prefix."_file_repository_items` WHERE `cid`='$catid' && `isactive` = 1 ORDER BY `did` DESC ".$num);
    }
} 
else 
{
    $result = $db->sql_query("SELECT `did`, `title`, `description`, `date`, `sname` FROM `".$prefix."_file_repository_items` WHERE `isactive` = 1 ORDER BY `did` DESC ".$num);
}

header("Content-Type: text/xml");


echo '<?xml version="1.0" encoding="UTF-8" ?>';
echo '<rss version="2.0">';
echo '<channel>';

echo '<title>'.$sitename.'</title>';
echo '<link>'.$nukeurl.'</link>';
echo '<description>'.$slogan.'</description>';
echo '<copyright>'.$sitename.'</copyright>';
echo '<generator>'.$sitename.' Evo RSS Parser</generator>';

while(list($did, $title, $description, $date, $submitter) = $db->sql_fetchrow($result)):

    $title = stripslashes($title);
    $title = entity_to_hex_value($title);

    $description = Fix_Quotes(filter_text($description, "nohtml"));
    // $description = stripslashes($description);
    $description = entity_to_hex_value($description);
    $description = decode_bb_all($description);
    $description = decode_rss_rest($description);
    $description = htmlentities($description, ENT_QUOTES);
    $description = decode_bbcode(set_smilies(stripslashes($description)), 1, true);

    if (empty($submitter)) {
        $submitter = $sitename;
    }

    // Format: 2004-08-02T12:15:23-06:00 (W3C Compliant)
    $date = date("Y-m-d\TH:i:s", strtotime($date));
    $date = $date . $gmtstr;

    // echo "<item>\n";
    // echo "<title>".$title."</title>\n";
    // echo "<link>".$nukeurl."/modules.php?name=Downloads&amp;op=getit&amp;lid=".$lid."</link>\n";
    // echo "<description><![CDATA[".$description."]]></description>\n";
    // echo "<guid isPermaLink=\"false\">".$lid."@".$nukeurl."</guid>\n";
    // echo "<dc:subject>".$title."</dc:subject>\n";
    // echo "<dc:date>".$date."</dc:date>\n";
    // echo "<dc:creator>Posted by ".$submitter."</dc:creator>\n";
    // echo "</item>\n\n";

    echo '  <item>';
    echo '    <title>'.$title.'</title>';
    echo '    <link>'.$nukeurl.'/modules.php?name=File_Repository&amp;action=view&amp;did='.$did.'</link>';
    echo "    <description><![CDATA[".$description."]]></description>";
    echo '    <date>'.$date.'</date>';
    echo '    <creator>'.$date.'</creator>';
    echo '  </item>';
    

endwhile;
echo '</channel>';
echo '</rss>';

?>