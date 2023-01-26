<?php
/*=======================================================================
 PHP-Nuke Titanium v4.0.3 : Enhanced PHP-Nuke Web Portal System
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
/*                                                                      */
/************************************************************************/
/*         Additional security & Abstraction layer conversion           */
/*                           2003 chatserv                              */
/*      http://www.nukefixes.com -- http://www.nukeresources.com        */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
      Caching System                           v1.0.0       10/31/2005
	  Titanium Patched                         v4.0.3       01/25/2023
-=[Mod]=-
      Blogs BBCodes                            v1.0.0       10/05/2005
      Custom Text Area                         v1.0.0       11/23/2005
-=[Applied Rules]=-
 * DirNameFileConstantToDirConstantRector
 * TernaryToNullCoalescingRector
 * NullToStrictStringFuncCallArgRector
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}

require_once(NUKE_BASE_DIR.'mainfile.php');

$module_name = basename(__DIR__);

get_lang($module_name);

$pagetitle = "- "._ACTIVETOPICS."";

include_once(NUKE_BASE_DIR.'header.php');

OpenTable();

global $fieldset_color, $fieldset_border_width, $digits_color, $db, $prefix, $tipath;

$ThemeSel = get_theme();

$sql = "SELECT t.topicid, t.topicimage, t.topictext, count(s.sid) AS stories, SUM(s.counter) AS readcount FROM ".$prefix."_blogs_topics t 

LEFT JOIN ".$prefix."_blogs s 

ON (s.topic = t.topicid) 

GROUP BY t.topicid, t.topicimage, t.topictext 

ORDER BY t.topictext";

$result = $db->sql_query($sql);

if ($db->sql_numrows($result) > 0) 
{
    $output = "<div align=\"center\"><span class=\"title\"><strong>"._ACTIVETOPICS."</strong></span><br />\n";
    $output .= "<span class=\"content\">"._CLICK2LIST."</span><br /><br />\n";
    $output .= "<form action=\"modules.php?name=Search\" method=\"post\">";
    $output .= "<input type=\"text\" name=\"query\" size=\"30\">  ";
    $output .= "<input type=\"submit\" value=\""._SEARCH."\">";
    $output .= "</form></div><br />";
    echo $output;

    while ($row = $db->sql_fetchrow($result)) 
	{
        $topicid = intval($row['topicid']);
        $topicimage = stripslashes((string) $row['topicimage']);
        $topictext = stripslashes((string) check_html($row['topictext'], "nohtml"));
        
		if(file_exists("themes/".$ThemeSel."/images/topics/".$topicimage)) 
		{
          $t_image = "themes/".$ThemeSel."/images/topics/".$topicimage;
        } 
		else 
		{
          $t_image = "modules/Blog_Topics/images/topics/".$topicimage;
        }
        
		$output  = '<fieldset style="border-color: '.$fieldset_color.'; border-width: '.$fieldset_border_width.'; border-style: solid;">';	
		
		$output .= '<legend align="center" id="Legend5" runat="server" visible="true" style="width:auto; margin-bottom: 0px; font-size: 18px; font-weight: bold;"><a 
		href="modules.php?name=Blogs&amp;new_topic="'.$topicid.'">'.$topictext.'</a></legend>';
		
		$output .= '<table border="1" width="100%" align="center" cellpadding="2">';
        
        $output .= '<tr>'; 
        $output .= '<td valign="top" width="35%"><a href="modules.php?name=Blogs&amp;new_topic="'.$topicid.'"><img src='.$t_image.' border="0" alt='.$topictext.' title='.$topictext.' hspace="5" vspace="5"></a><br /><br />';
        $output .= '<span class="content">';
        
		$output .= '<img class="icons" align="absmiddle" width="16" src="'.img('topic-16.png','Blog_Topics').'"> <strong>'._TOPIC.' :</strong><a 
		href="modules.php?name=Blogs&amp;new_topic="'.$topicid.'"><strong> '.$topictext.'</strong></a><br />';
        
		$output .= '<img class="icons" align="absmiddle" width="16" 
		src="'.img('topic-blogs-16.png','Blog_Topics').'"> <strong>'._TOTNEWS.' </strong>( <font color="'.$digits_color.'"><strong>'.$row['stories'].'</strong></font> )<br />';
        
		$output .= '<img class="icons" align="absmiddle" width="16" 
		src="'.img('reads-icon-16.png','Blog_Topics').'"> <strong>'._TOTREADS.' </strong>( <font color="'.$digits_color.'"><strong>'.($row['readcount'] ?? 0).'</strong></font> )</span>';
        
		$output .= '</td><td valign="top">';
        echo $output;

        if ($row['stories'] > 0) 
		{
            $sql2 = "SELECT s.sid, s.catid, s.title, c.title AS cat_title FROM ".$prefix."_blogs s LEFT JOIN ".$prefix."_blogs_cat c ON s.catid=c.catid WHERE s.topic='$topicid' ORDER BY s.sid DESC LIMIT 0,50";
            $result2 = $db->sql_query($sql2);
        
		    while ($row2 = $db->sql_fetchrow($result2)) 
			{
                $cat_link = (intval($row2['catid']) > 0) ? "<a 
				href=\"modules.php?name=Blogs&amp;file=categories&amp;op=newindex&amp;catid=".intval($row2['catid'])."\"><strong>".stripslashes((string) check_html($row2['cat_title'], "nohtml"))."</strong></a>: " : "";
                
				echo '<img class="icons" align="absmiddle" width="16" 
				src="'.img('topic-blogs-16.png','Blog_Topics').'"> '.$cat_link.'<a href="modules.php?name=Blogs&amp;file=article&amp;sid='.intval($row2['sid']).'">'.htmlentities((string) $row2['title']).'</a><br />';
            }
            
			if ($row['stories'] > 0) 
			{
                echo '<div align="right"><a href="modules.php?name=Blogs&amp;new_topic='.$topicid.'"><strong><img align="absmiddle" height="50" src="'.img('more.png','Blog_Topics').'"></strong></a></div>';
            }
        } 
		else 
		{
            echo "<i>"._NONEWSYET."</i>";
        }

		echo "</td></tr></table></fieldset><br /><br />"; 
    }
} 
else 
{
  echo "<i>"._NONEWSYET."</i>";
}
CloseTable();

include_once(NUKE_BASE_DIR.'footer.php');
