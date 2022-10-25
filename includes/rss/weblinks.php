<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************
   Nuke-Evolution: News Feed 2.0
   ============================================
   Copyright (c) 2006 by The Nuke-Evolution Team

   Filename      : weblinks.php
   Author        : LombudXa (Rodmar) (www.evolved-Systems.net)
   Version       : 3.0.0
   Date          : 12/10/2006 (mm-dd-yyyy)

   Notes         : This will parse your Web Links for RSS readers.
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

$num = (isset($num) && is_integer(intval($num)) && intval($num) > 0) ? 'LIMIT '.$num : 'LIMIT 10';

$cat = intval($cat);
if (!empty($cat)) {
    $catid = $db->sql_fetchrow($db->sql_query("SELECT catid FROM ".$prefix."_links_categories WHERE title LIKE '%$cat%' LIMIT 1"));
    if (empty($catid)) {
        $result = $db->sql_query("SELECT lid, title, description, date, submitter FROM ".$prefix."_links_links ORDER BY lid DESC ".$num);
    } else {
        $catid = intval($catid);
        $result = $db->sql_query("SELECT lid, title, description, date, submitter FROM ".$prefix."_links_links WHERE catid='$catid' ORDER BY lid DESC ".$num);
    }
} else {
    $result = $db->sql_query("SELECT lid, title, description, date, submitter FROM ".$prefix."_links_links ORDER BY lid DESC ".$num);
}

header("Content-Type: text/xml");

echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n";
echo "<?xml-stylesheet title=\"XSL_formatting\" type=\"text/xsl\" href=\"includes/rss/rss_20.xsl\" ?>\n\n";
echo "<rss version=\"2.0\" \n";
echo " xmlns:dc=\"http://purl.org/dc/elements/1.1/\"\n";
echo " xmlns:sy=\"http://purl.org/rss/1.0/modules/syndication/\"\n";
echo " xmlns:admin=\"http://webns.net/mvcb/\"\n";
echo " xmlns:rdf=\"http://www.w3.org/1999/02/22-rdf-syntax-ns#\">\n\n";
echo "<channel>\n";
echo "<title>".$sitename."</title>\n";
echo "<link>".$nukeurl."</link>\n";
echo "<description>".$slogan."</description>\n";
echo "<copyright>".$sitename."</copyright>\n";
echo "<generator>".$sitename." Evo RSS Parser</generator>\n";
echo "<ttl>60</ttl>\n\n";
echo "<image>\n";
echo "<title>".$sitename."</title>\n";
echo "<url>".$nukeurl."/images/titanium/button.png</url>\n";
echo "<link>".$nukeurl."</link>\n";
echo "<width>94</width>\n";
echo "<height>15</height>\n";
echo "<description>".$backend_title."</description>\n";
echo "</image>\n";
echo "<dc:language>".$backend_language."</dc:language>\n";
echo "<dc:creator>".$adminmail."</dc:creator>\n";
echo "<dc:date>".$now."</dc:date>\n\n";
echo "<sy:updatePeriod>hourly</sy:updatePeriod>\n";
echo "<sy:updateFrequency>1</sy:updateFrequency>\n";
echo "<sy:updateBase>".$now."</sy:updateBase>\n\n";

while(list($lid, $title, $description, $date) = $db->sql_fetchrow($result)) {
    $title = stripslashes($title);
    $title = entity_to_hex_value($title);
    $title2 = preg_replace("/ /", "_", $title);
    $description = Fix_Quotes(filter_text($description, "nohtml"));
    $description = stripslashes($description);
    $description = entity_to_hex_value($description);
    //$description = ereg_replace('\x99', '', $description); // Needs improvement
    $description = decode_bb_all($description);
    $description = decode_rss_rest($description);
    if (empty($submitter)) {
        $submitter = $sitename;
    }

    // Format: 2004-08-02T12:15:23-06:00 (W3C Compliant)
    $date = date("Y-m-d\TH:i:s", strtotime($date));
    $date = $date . $gmtstr;

    echo "<item>\n";
    echo "<title>".$title."</title>\n";
    echo "<link>".$nukeurl."/modules.php?name=Web_Links&amp;l_op=viewlinkdetails&amp;lid=".$lid."&amp;ttitle=".$title2."</link>\n";
    echo "<description><![CDATA[".$description."]]></description>\n";
    echo "<guid isPermaLink=\"false\">".$lid."@".$nukeurl."</guid>\n";
    echo "<dc:subject>".$title."</dc:subject>\n";
    echo "<dc:date>".$date."</dc:date>\n";
    echo "<dc:creator>Posted by ".$submitter."</dc:creator>\n";
    echo "</item>\n\n";
}
echo "</channel>\n\n";
echo "</rss>\n";

?>