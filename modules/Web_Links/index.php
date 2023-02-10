<?php # JOHN 3:16 #
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/
use function PHP81_BC\strftime;
/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* Copyright (c) 2000 by James Knickelbein                              */
/* Journey Milwaukee (http://www.journeymilwaukee.com)                  */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/*                                                                      */
/* Module Name: Web Links                                               */
/* Contributor: Ernest Allen Buffington                                 */
/* Version: v1.0.2                                                      */
/* Core: PHP-Nuke Evolution Xtreme v2.0.9d <> 3.0.1b                    */
/* Description: Web Links/Resources based on Journey Links Hack         */
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
	  Bootsrrap Mod                            v1.0.0       05/06/2021
 ************************************************************************/
if (!defined('MODULE_FILE')) 
die('You can\'t access this file directly...');


if (isset($min)) 
$min = intval($min);

if (isset($show)) 
$show = intval($show);

define('INDEX_FILE', true);

$module_name = basename(dirname(__FILE__));
get_lang($module_name);

$pagetitle = '- '._WEBLINKS;

require_once(NUKE_MODULES_DIR.$module_name.'/l_config.php');

function weblinks_parent($parentid,$title) 
{
    global $prefix, $db;
    $parentid = intval($parentid);
    $row = $db->sql_fetchrow($db->sql_query("SELECT `cid`, `title`, `parentid` FROM ".$prefix."_links_categories WHERE cid='$parentid'"));
    $cid = intval($row['cid']);
    $ptitle = stripslashes(check_html($row['title'], "nohtml"));
    $pparentid = intval($row['parentid']);
    if ($ptitle=="$title") 
	$title=$title;
    elseif (!empty($ptitle)) 
	$title=$ptitle."/".$title;
    if ($pparentid!=0) 
    $title=weblinks_parent($pparentid,$title);
	return $title;
}

function weblinks_parentlink($parentid,$title) 
{
    global $prefix, $db, $module_name;
    
	$parentid = intval($parentid);
    $row = $db->sql_fetchrow($db->sql_query("SELECT `cid`, `title`, `parentid` FROM ".$prefix."_links_categories WHERE cid='$parentid'"));
    
	if(isset($row['cid']))
	$cid = intval($row['cid']);
    
	if(isset($row['title']))
	$ptitle = stripslashes((string) check_html($row['title'], "nohtml"));

	if(isset($row['parentid']))
	$pparentid = intval($row['parentid']);
    else
	$pparentid = 0;
	
	if (!empty($ptitle)) 
	$title="<a href=modules.php?name=$module_name&amp;l_op=viewlink&amp;cid=$cid>$ptitle</a>/".$title;
	if ($pparentid!=0) 
    $title=weblinks_parentlink($pparentid,$ptitle);
    return $title;
}

function menu($mainlink) 
{
    global $module_name, $query;
    
	OpenTable();
    
    # stop using <br /> use a div tag with padding whenever it's possible!
	print '<div align="center" style="padding-top:13px;">'."\n";
    print '</div>'."\n";

	$ThemeSel = get_theme();
    
	if (file_exists("themes/".$ThemeSel."/images/Web_links/Web_Links.png")):
    echo "<div align=\"center\"><a href=\"modules.php?name=".$module_name."\"><img style=\"max-height: 50px;\" src=\"themes/".$ThemeSel."/images/Web_links/Web_Links.png\" border=\"0\" alt=\"\"></a><br /><br />";
     
	else: 
	
    echo "<div align=\"center\"><a href=\"modules.php?name=".$module_name."\"><img style=\"max-height: 50px;\" src=\"modules/".$module_name."/images/Web_Links.png\" border=\"0\" alt=\"\"></a><br /><br />";
    endif;
    
	echo "<form action=\"modules.php?name=".$module_name."&amp;l_op=search&amp;query=".$query."\" method=\"post\">"
    ."<span class=\"content\"><input type=\"text\" size=\"25\" name=\"query\"> <input type=\"submit\" value=\""._SEARCH."\"></span>"
    ."</form>";
    
	echo "<br /><strong><span class=\"content\"> ";
    
	if ($mainlink>0): 
    echo "<a href=\"modules.php?name=".$module_name."\"><i class=\"bi bi-link\"></i> "._LINKSMAIN."</a>  ";
    endif;
    
	echo " <a href=\"modules.php?name=".$module_name."&amp;l_op=AddLink\"><i class=\"bi bi-link\"></i> "._ADDLINK."</a>"
        ." <a href=\"modules.php?name=".$module_name."&amp;l_op=NewLinks\"><i class=\"bi bi-link\"></i> "._NEW."</a>"
        ." <a href=\"modules.php?name=".$module_name."&amp;l_op=MostPopular\"><i class=\"bi bi-link\"></i> "._POPULAR."</a>"
        ." <a href=\"modules.php?name=".$module_name,"&amp;l_op=TopRated\"><i class=\"bi bi-link\"></i> "._TOPRATED."</a>"
       #."<a href=\"modules.php?name=$module_name&amp;l_op=RandomLink\"><i class=\"bi bi-link\"></i> "._RANDOM."</a> " <- This is garbage
        ."</strong>"
	    ."</span></div>";

    # stop using <br /> use a div tag with padding whenever it's possible!
    print '<div align="center" style="padding-top:6px;">'."\n";
    print '</div>'."\n";
	CloseTable();
}

function SearchForm() 
{
	global $module_name, $query;
	
    echo "<form action=\"modules.php?name=".$module_name,"&amp;l_op=search&amp;query=".$query."\" method=\"post\">"
    ."<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">"
    ."<tr><td><span class=\"content\"><input type=\"text\" size=\"25\" name=\"query\"> <input type=\"submit\" value=\""._SEARCH."\"></td></tr>"
    ."</table>"
    ."</form>";
}

function linkinfomenu($lid, $ttitle) 
{
    global $module_name, $user;
    
	echo "<span class=\"content\"><strong>"
    ."<i class=\"bi bi-person-square\"></i>&nbsp;<a href=\"modules.php?name=".$module_name."&amp;l_op=viewlinkcomments&amp;lid=".$lid."&amp;ttitle=".$ttitle."\">"._LINKCOMMENTS."</a>&nbsp;&nbsp;"
    ."<i class=\"bi bi-info-square\"></i>&nbsp;<a href=\"modules.php?name=".$module_name."&amp;l_op=viewlinkdetails&amp;lid=".$lid."&amp;ttitle=".$ttitle."\">"._ADDITIONALDET."</a>&nbsp;&nbsp;"
    ."<i class=\"bi bi-clipboard-data\"></i>&nbsp;<a href=\"modules.php?name=".$module_name."&amp;l_op=viewlinkeditorial&amp;lid=".$lid."&amp;ttitle=".$ttitle."\">"._EDITORREVIEW."</a>&nbsp;&nbsp;"
    ."<i class=\"bi bi-pencil-square\"></i>&nbsp;<a href=\"modules.php?name=".$module_name."&amp;l_op=modifylinkrequest&amp;lid=".$lid."\">"._MODIFY."</a>&nbsp;&nbsp;";
    
	if (is_user()):
    echo "<i class=\"bi bi-backspace-reverse\"></i>&nbsp;<a href=\"modules.php?name=".$module_name."&amp;l_op=brokenlink&amp;lid=".$lid."\">"._REPORTBROKEN."</a>&nbsp;&nbsp;";
    endif;
    echo " </span></strong>";
}

function index() 
{
    global $prefix, $db;
    include_once(NUKE_BASE_DIR.'header.php');
    
	$mainlink = 0;
    
	menu($mainlink);
    
	OpenTable();
   
    # stop using <br /> use a div tag with padding whenever it's possible!
	print '<div align="center" style="padding-top:6px;">'."\n";
    print '</div>'."\n";
   
    echo '<div align="center">';
	echo "<div align=\"center\"><span class=\"title\"><strong><h1>"._LINKSMAINCAT."</h1></strong></span></div><br />";
    echo "<table border=\"0\" cellspacing=\"10\" cellpadding=\"0\" align=\"center\"><tr>";
    
	$result = $db->sql_query("SELECT cid, title, cdescription from ".$prefix."_links_categories where parentid=0 order by title"); 
    $dum = 0;
    $count = 0;
    
	while($row = $db->sql_fetchrow($result)): 
	
      $cid = intval($row['cid']);
      $title = stripslashes(check_html($row['title'], "nohtml"));
      $cdescription = stripslashes($row['cdescription']);
      
	  echo "<td><span class=\"option\"><strong>
	  <big><i class=\"bi bi-link\"></i></big></strong> 
	  <a href=\"modules.php?name=Web_Links&amp;l_op=viewlink&amp;cid=".$cid."\"><strong>".$title."</strong></a></span>";
    
	  categorynewlinkgraphic($cid);
    
	  if($cdescription):
      echo "<br /><span class=\"content\"><i class=\"bi bi-info-circle\"></i> ".$cdescription."</span><br />";
      else:
      echo "<br />"; 
      endif;
    
	  $result2 = $db->sql_query("SELECT `cid`, `title` FROM ".$prefix."_links_categories where parentid='$cid' ORDER BY title limit 0,3");
      $space = 0;
    
	  while($row2 = $db->sql_fetchrow($result2)):
          $cid = intval($row2['cid']);
          $stitle = stripslashes(check_html($row2['title'], "nohtml"));
        
		  if ($space > 0): 
          echo ",&nbsp; <i class=\"bi bi-link-45deg\"></i> ";
          else:
		  echo " <i class=\"bi bi-link-45deg\"></i> ";
		  endif;
		
          echo "<span class=\"content\"><a href=\"modules.php?name=Web_Links&amp;l_op=viewlink&amp;cid=$cid\">$stitle</a></span>";
        
		  $space++;
      
	  endwhile;
    
	      if ($count<1): 
          echo '<br /><br />';
          echo "</td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td>";
          $dum = 1;
          endif;
    
	      $count++;
    
	      if ($count == 2) :
          echo '<br /><br />';
	      echo "</td></tr><tr>";
          
		  $count = 0;
          $dum = 0;
          endif;

    endwhile;
	
	if ($dum == 1): 
    echo "</tr></table>";
	elseif ($dum == 0): 
    echo "<td></td></tr></table>";
    echo '</div>';
    endif;
	
	$result3 = $db->sql_query("SELECT * from ".$prefix."_links_links");
    $numrows = $db->sql_numrows($result3);
    $result4 = $db->sql_query("SELECT * from ".$prefix."_links_categories");
    $catnum = $db->sql_numrows($result4);
    $numrows = intval($numrows);
    $catnum = intval($catnum);
    
	echo "<div align=\"center\"><span class=\"content\">"._THEREARE." <strong>$numrows</strong> "._LINKS." "._AND." <strong>$catnum</strong> "._CATEGORIES." "._INDB."</span></div>";

    # stop using <br /> use a div tag with padding whenever it's possible!
	print '<div align="center" style="padding-top:6px;">'."\n";
    print '</div>'."\n";

	CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function AddLink() 
{
    global $prefix, $db, $user, $links_anonaddlinklock, $module_name;
    include_once(NUKE_BASE_DIR.'header.php');
    $mainlink = 1;
    menu(1);

    OpenTable();

    # stop using <br /> use a div tag with padding whenever it's possible!
	print '<div align="center" style="padding-top:6px;">'."\n";
    print '</div>'."\n";

    echo "<div align=\"center\"><span class=\"title\"><strong><h1>"._ADDALINK."</h1></strong></span></div><br />";
	
    if (is_user() || $links_anonaddlinklock == 1):
        echo "<strong><h2>"._INSTRUCTIONS.":</h2></strong>"
        ."<strong><big><i class=\"bi bi-link\"></i></big></strong> "._SUBMITONCE."<br />"
        ."<strong><big><i class=\"bi bi-check2-square\"></i></big></strong> "._POSTPENDING."<br />"
        ."<strong><big><i class=\"bi bi-person-bounding-box\"></i></big></strong> "._USERANDIP."<br /><br />"
		
            ."<form method=\"post\" action=\"modules.php?name=$module_name&amp;l_op=Add\">"
            ."<i class=\"bi bi-info-square\"></i> "._PAGETITLE.": <input type=\"text\" name=\"title\" size=\"50\" maxlength=\"100\"><br />"
			."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class=\"bi bi-hand-index\"></i> The link title goes here.<br /><br />"
            ."<i class=\"bi bi-info-square\"></i> "._PAGEURL.": <input type=\"text\" name=\"url\" size=\"50\" maxlength=\"100\" value=\"https://\"><br />"
			."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;<i class=\"bi bi-hand-index\"></i> The website or portal link goes here.<br /><br />";
	# stop using <br /> use a div tag with padding whenever it's possible!
	print '<div align="center" style="padding-top:6px;">'."\n";
    print '</div>'."\n";
			
        echo "<i class=\"bi bi-info-square\"></i> "._CATEGORY.": <select name=\"cat\">";
        
		$result = $db->sql_query("SELECT `cid`, 
		                               `title`, 
									`parentid` FROM ".$prefix."_links_categories order by parentid,title");
									
        while ($row = $db->sql_fetchrow($result)): 
		
        $cid2 = intval($row['cid']);
        $ctitle2 = stripslashes(check_html($row['title'], "nohtml"));
        $parentid2 = intval($row['parentid']);
        
		    if ($parentid2!=0) $ctitle2=weblinks_parent($parentid2,$ctitle2);
            echo "<option value=\"$cid2\">$ctitle2</option>";
        endwhile;
        
		echo "</select><br /><br />";
        echo ""._LDESCRIPTION."<br /><textarea name=\"description\" cols=\"60\" rows=\"5\"></textarea><br /><br />";
        
		global $userinfo;
        echo '<div class="textbold" style="margin-left:1px;">'._YOURNAME.':</div><input type="text" name="auth_name" value="'.$userinfo['username'].'" size="30" required><br /><br />';
        echo '<div class="textbold" style="margin-left:1px;">'._YOUREMAIL.':</div><input type="email" name="email" value="'.$userinfo['user_email'].'" size="30" required><br /><br />';
            
		echo security_code(array(0,1,2,3,4,5,6,7), 'normal').'<br />'; # added 5/6/2021 (Someone fucked this up so I fixed it)
		
        echo "<input type=\"hidden\" name=\"l_op\" value=\"Add\">";
		echo "<input type=\"submit\" value=\""._ADDURL."\"> "._GOBACK."<br /><br />";
        echo "</form>";
    
	else: 
	
        echo "<div align=\"center\">"._LINKSNOTUSER1."<br />"
        .""._LINKSNOTUSER2."<br /><br />"
            .""._LINKSNOTUSER3."<br />"
            .""._LINKSNOTUSER4."<br />"
            .""._LINKSNOTUSER5."<br />"
            .""._LINKSNOTUSER6."<br />"
            .""._LINKSNOTUSER7."<br /><br />"
            .""._LINKSNOTUSER8."</div>";
    endif;

    # stop using <br /> use a div tage with padding!
	print '<div align="center" style="padding-top:6px;">'."\n";
    print '</div>'."\n";

    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function Add($title, $url, $auth_name, $cat, $description, $email) {
    global $prefix, $db, $user, $cookie, $cache;
    $result = $db->sql_query("SELECT `url` FROM ".$prefix."_links_links WHERE url='$url'");
    $numrows = $db->sql_numrows($result);
/*****[BEGIN]******************************************
 [ Mod:    Advanced Security Code Control      v2.0.0 ] added 5/6/2021 (Someone fucked this up so I fixed it)
 ******************************************************/
	# Throw an error, If the user fails the reCaptcha.
	if (!security_code_check($_POST['g-recaptcha-response'], array(0,1,2,3,4,5,6,7))):
    include_once(NUKE_BASE_DIR.'header.php');
	OpenTable();
	$error_message[] = $lang_new[$module_name]['reCaptcha'];
	CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
	endif;
/*****[END]********************************************
 [ Mod:    Advanced Security Code Control      v2.0.0 ] added 5/6/2021 (Someone fucked this up so I fixed it)
 ******************************************************/
    if ($numrows>0): 
        include_once(NUKE_BASE_DIR.'header.php');
        menu(1);
        OpenTable();
        echo "<div align=\"center\"><strong>"._LINKALREADYEXT."</strong></div><br /><br />"
            .""._GOBACK."";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
	else: 
        if(is_user()) 
        $submitter = $userinfo['username'];
		// Check if Title exist
        if (empty($title)):
            include_once(NUKE_BASE_DIR.'header.php');
            menu(1);
            OpenTable();
            echo "<div align=\"center\"><strong>"._LINKNOTITLE."</strong></div><br /><br />"
                .""._GOBACK."";
            CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
        endif;
		// Check if URL exist
        if (empty($url)):
            include_once(NUKE_BASE_DIR.'header.php');
            menu(1);
            OpenTable();
            echo "<div align=\"center\"><strong>"._LINKNOURL."</strong></div><br /><br />"
                .""._GOBACK."";
            CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
        endif;
        // Check if Description exist
        if (empty($description)):
            include_once(NUKE_BASE_DIR.'header.php');
            menu(1);
            OpenTable();
            echo "<div align=\"center\"><strong>"._LINKNODESC."</strong></div><br /><br />"
                .""._GOBACK."";
            CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
        endif;
		$cat = explode("-", $cat);
        if (empty($cat[1])) 
        $cat[1] = 0;
        $title = check_html(Fix_Quotes($title, "nohtml"));
        $url = stripslashes(check_html($url, "nohtml"));
        $description = check_html(Fix_Quotes($description), "html");
        $auth_name = stripslashes(check_html($auth_name, "nohtml"));
        if (!empty($email)) 
        Validate($email,'email',_WEBLINKS);
        Validate($url,'url',_WEBLINKS);
        $cat[0] = intval($cat[0]);
        $cat[1] = intval($cat[1]);
        $num_new = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_links_newlink 
		                                             WHERE title='$title' 
													    OR url='$url' OR description='$description'"));
        if ($num_new == 0):
        $db->sql_query("insert into ".$prefix."_links_newlink values (NULL, 
		                                                         '$cat[0]', 
																 '$cat[1]', 
												  '".addslashes($title)."', 
												    '".addslashes($url)."', 
											'".addslashes($description)."', 
											  '".addslashes($auth_name)."', 
											      '".addslashes($email)."', 
											  '".addslashes($submitter)."')");
											  
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
        $cache->delete('numwaitl', 'submissions');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
        endif;
        include_once(NUKE_BASE_DIR.'header.php');
        menu(1);
        OpenTable();
        echo "<div align=\"center\"><strong>"._LINKRECEIVED."</strong></div><br />";
        if (!empty($email)) 
        echo _EMAILWHENADD;
        else 
        echo _CHECKFORIT;
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    
	endif;
}

function NewLinks($newlinkshowdays) 
{
    global $prefix, $db, $module_name;
    include_once(NUKE_BASE_DIR.'header.php');
    $newlinkshowdays = intval(trim($newlinkshowdays));
    menu(1);
    OpenTable();

    # stop using <br /> use a div tag with padding whenever it's possible!
	print '<div align="center" style="padding-top:6px;">'."\n";
    print '</div>'."\n";

    echo "<div align=\"center\"><span class=\"option\"><strong><h1>"._NEWLINKS."</h1></strong></span></div><br />";
    $counter = 0;
    $allweeklinks = 0;
    
	while ($counter <= 7-1):
    $newlinkdayRaw = (time()-(86400 * $counter));
    $newlinkday = date("d-M-Y", $newlinkdayRaw);
    $newlinkView = date("F d, Y", $newlinkdayRaw);
    $newlinkDB = Date("Y-m-d", $newlinkdayRaw);
    $totallinks = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_links_links WHERE date LIKE '%$newlinkDB%'"));
    $counter++;
    $allweeklinks = $allweeklinks + $totallinks;
    endwhile;
	
    $counter = 0;
    $allmonthlinks = 0;
    
	while ($counter <=30-1):
        $newlinkdayRaw = (time()-(86400 * $counter));
        $newlinkDB = Date("Y-m-d", $newlinkdayRaw);
        $totallinks = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_links_links WHERE date LIKE '%$newlinkDB%'"));
        $allmonthlinks = $allmonthlinks + $totallinks;
        $counter++;
    endwhile;
	
    echo "<div align=\"center\"><strong>"._TOTALNEWLINKS.":</strong> "._LASTWEEK." - $allweeklinks \ "._LAST30DAYS." - $allmonthlinks<br />"
    .""._SHOW.": <a href=\"modules.php?name=$module_name&amp;l_op=NewLinks&amp;newlinkshowdays=7\">"._1WEEK."</a> - <a href=\"modules.php?name=$module_name&amp;l_op=NewLinks&amp;newlinkshowdays=14\">"._2WEEKS."</a> - <a href=\"modules.php?name=$module_name&amp;l_op=NewLinks&amp;newlinkshowdays=30\">"._30DAYS."</a>"
    ."</div><br />";
    
	/* List Last VARIABLE Days of Links */
    if ($newlinkshowdays <= 0) $newlinkshowdays = 7;
    echo "<br /><div align=\"center\"><strong>"._TOTALFORLAST." $newlinkshowdays "._DAYS.":</strong><br /><br />";
    $counter = 0;
    $allweeklinks = 0;
    
	while ($counter <= $newlinkshowdays-1): 
    
	$newlinkdayRaw = (time()-(86400 * $counter));
       $newlinkday = date("d-M-Y", $newlinkdayRaw);
      $newlinkView = date("F d, Y", $newlinkdayRaw);
        $newlinkDB = Date("Y-m-d", $newlinkdayRaw);
       $totallinks = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_links_links WHERE date LIKE '%$newlinkDB%'"));
    
	$counter++;
     
	 $allweeklinks = $allweeklinks + $totallinks;
    
	echo "<strong><big><i class=\"bi bi-calendar3\"></i></big></strong> <a href=\"modules.php?name=Web_Links&amp;l_op=NewLinksDate&amp;selectdate=$newlinkdayRaw\">$newlinkView</a>&nbsp;($totallinks)<br />";
    
	endwhile;
	
    $counter = 0;
    $allmonthlinks = 0;
    echo "</div>";

    # stop using <br /> use a div tag with padding whenever it's possible!
	print '<div align="center" style="padding-top:6px;">'."\n";
    print '</div>'."\n";

    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function NewLinksDate($selectdate) 
{
    global $prefix, $db, $module_name, $admin, $user, $admin_file, $locale, $mainvotedecimal, $datetime;
    $dateDB = (date("d-M-Y", $selectdate));
    $dateView = (date("F d, Y", $selectdate));
    include_once(NUKE_BASE_DIR.'header.php');
    menu(1);

    OpenTable();

    # stop using <br /> use a div tag with padding whenever it's possible!
	print '<div align="center" style="padding-top:6px;">'."\n";
    print '</div>'."\n";

    $newlinkDB = Date("Y-m-d", $selectdate);
    $totallinks = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_links_links WHERE date LIKE '%$newlinkDB%'"));

    echo "<div align=\"center\"><span class=\"option\"><strong><h1>$dateView - $totallinks "._NEWLINKS."</h1></strong></span></div>"
    ."<table width=\"100%\" cellspacing=\"0\" cellpadding=\"10\" border=\"0\"><tr><td><span class=\"content\">";

    $result2 = $db->sql_query("SELECT `lid`, 
	                                  `cid`, 
									  `sid`, 
									`title`, 
							  `description`, 
							         `date`, 
									 `hits`, 
						`linkratingsummary`, 
						       `totalvotes`, 
							`totalcomments` FROM ".$prefix."_links_links 
							             WHERE date 
										  LIKE '%$newlinkDB%' 
										 ORDER by title ASC");

    while ($row2 = $db->sql_fetchrow($result2)):
      $lid = intval($row2['lid']);
      $cid = intval($row2['cid']);
      $sid = intval($row2['sid']);
      $title = stripslashes(check_html($row2['title'], "nohtml"));
      $description = stripslashes($row2['description']);
      $time = $row2['date'];
      $hits = intval($row2['hits']);
      $linkratingsummary = $row2['linkratingsummary'];
      $totalvotes = intval($row2['totalvotes']);
      $totalcomments = $row2['totalcomments'];
      $linkratingsummary = number_format($linkratingsummary, $mainvotedecimal);
      echo "<font size=\"4\"><i class=\"bi bi-link\"></i></font> <a href=\"modules.php?name=$module_name&amp;l_op=visit&amp;lid=$lid\" target=\"new\">$title</a>";
      newlinkgraphic($datetime, $time);
      popgraphic($hits);
      echo "<br /><i class=\"bi bi-info-square\"></i> $description<br />";
      setlocale (LC_TIME, $locale);
      /* INSERT code for *editor review* here */
      preg_match ("/([0-9]{4})\-([0-9]{1,2})\-([0-9]{1,2}) ([0-9]{1,2})\:([0-9]{1,2})\:([0-9]{1,2})/", $time, $datetime);
      $datetime = strftime(""._LINKSDATESTRING."", mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));
      $datetime = ucfirst($datetime);
      echo "<i class=\"bi bi-calendar4\"></i> Added <strong>$datetime</strong> "._HITS.": $hits";
       $transfertitle = str_replace (" ", "_", $title);
        /* voting & comments stats */
        if ($totalvotes == 1) 
        $votestring = _VOTE;
	    else 
        $votestring = _VOTES;
        if ($linkratingsummary!="0" || $linkratingsummary!="0.0") 
        echo " "._RATING.": $linkratingsummary ($totalvotes $votestring)";
        echo "<br />";
        if (is_mod_admin($module_name)) 
        echo "<a href=\"".$admin_file.".php?op=LinksModLink&amp;lid=$lid\">"._EDIT."</a> | ";
        echo "<a href=\"modules.php?name=$module_name&amp;l_op=ratelink&amp;lid=$lid&amp;ttitle=$transfertitle\">"._RATESITE."</a>";
        if (is_user()) 
        echo " | <a href=\"modules.php?name=$module_name&amp;l_op=brokenlink&amp;lid=$lid\">"._REPORTBROKEN."</a>";
        if ($totalvotes != 0) 
        echo " | <a href=\"modules.php?name=$module_name&amp;l_op=viewlinkdetails&amp;lid=$lid&amp;ttitle=$transfertitle\">"._DETAILS."</a>";
        if ($totalcomments != 0) 
        echo " | <a href=\"modules.php?name=$module_name&amp;l_op=viewlinkcomments&amp;lid=$lid&amp;ttitle=$transfertitle\">"._SCOMMENTS." ($totalcomments)</a>";
	  detecteditorial($lid, $transfertitle);
      echo "<br />";
      $row3 = $db->sql_fetchrow($db->sql_query("SELECT title from ".$prefix."_links_categories where cid='$cid'"));
      $ctitle = stripslashes(check_html($row3['title'], "nohtml"));
      $ctitle=weblinks_parent($cid,$ctitle);
      echo ""._CATEGORY.": $ctitle";
      # stop using <br /> use a div tag with padding whenever it's possible!
	  print '<div align="center" style="padding-top:6px;">'."\n";
      print '</div>'."\n";
    endwhile;
	
    echo "</span></td></tr></table>";

    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function TopRated($ratenum, $ratetype) 
{
    global $prefix, $db, $admin, $module_name, $user, $locale, $mainvotedecimal, $datetime;
    
	include_once(NUKE_BASE_DIR.'header.php');
    include(NUKE_MODULES_DIR.$module_name.'/l_config.php');
	menu(1);
    OpenTable();
	
    # stop using <br /> use a div tag with padding whenever it's possible!
    print '<div align="center" style="padding-top:6px;">'."\n";
    print '</div>'."\n";
	
    echo "<table border=\"0\" width=\"100%\"><tr><td align=\"center\">";
    if(!empty($ratenum) && !empty($ratetype)): 
    $ratenum = intval($ratenum);
    $ratetype = htmlentities($ratetype);
    $toplinks = $ratenum;
    if($ratetype == "percent") 
    $toplinkspercentrigger = 1;
    endif;
    if($toplinkspercentrigger == 1):
        $toplinkspercent = $toplinks;
        $totalratedlinks = $db->sql_numrows($db->sql_query("SELECT * from ".$prefix."_links_links where linkratingsummary != '0'"));
        $toplinks = $toplinks / 100;
        $toplinks = $totalratedlinks * $toplinks;
        $toplinks = round($toplinks);
    endif;
    
	if($toplinkspercentrigger == 1) 
    echo "<div align=\"center\"><span class=\"option\"><strong><h1>"._BESTRATED." $toplinkspercent% ("._OF." $totalratedlinks "._TRATEDLINKS.")</h1></strong></span></div><br />";
    else 
    echo "<div align=\"center\"><span class=\"option\"><strong><h1>"._BESTRATED." ".htmlentities($toplinks)." </h1></strong></span></div><br />";
    
    echo "</td></tr>"
    ."<tr><td><div align=\"center\">"._NOTE." $linkvotemin "._TVOTESREQ."<br />"
    .""._SHOWTOP.":  [ <a href=\"modules.php?name=$module_name&amp;l_op=TopRated&amp;ratenum=10&amp;ratetype=num\">10</a> - "
    ."<a href=\"modules.php?name=$module_name&amp;l_op=TopRated&amp;ratenum=25&amp;ratetype=num\">25</a> - "
        ."<a href=\"modules.php?name=$module_name&amp;l_op=TopRated&amp;ratenum=50&amp;ratetype=num\">50</a> | "
        ."<a href=\"modules.php?name=$module_name&amp;l_op=TopRated&amp;ratenum=1&amp;ratetype=percent\">1%</a> - "
        ."<a href=\"modules.php?name=$module_name&amp;l_op=TopRated&amp;ratenum=5&amp;ratetype=percent\">5%</a> - "
        ."<a href=\"modules.php?name=$module_name&amp;l_op=TopRated&amp;ratenum=10&amp;ratetype=percent\">10%</a> ]</div><br /><br /></td></tr>";
    
	$result = $db->sql_query("SELECT `lid`, 
	                                 `cid`, 
									 `sid`, 
								   `title`, 
							 `description`, 
							        `date`, 
									`hits`, 
					   `linkratingsummary`, 
					          `totalvotes`, 
						   `totalcomments` FROM ".$prefix."_links_links 
						   
						   WHERE linkratingsummary !=0 AND totalvotes >=$linkvotemin ORDER by linkratingsummary DESC limit 0,$toplinks");
    echo "<tr><td>";
    
	while($row = $db->sql_fetchrow($result)): 
	
      $lid = intval($row['lid']);
      $cid = intval($row['cid']);
      $sid = intval($row['sid']);
      $title = stripslashes(check_html($row['title'], "nohtml"));
      $description = stripslashes($row['description']);
      $time = $row['date'];
      $hits = intval($row['hits']);
      $linkratingsummary = $row['linkratingsummary'];
      $totalvotes = intval($row['totalvotes']);
      $totalcomments = $row['totalcomments'];
      $linkratingsummary = number_format($linkratingsummary, $mainvotedecimal);
      echo "<a href=\"modules.php?name=$module_name&amp;l_op=visit&amp;lid=$lid\" target=\"new\">$title</a>";
      newlinkgraphic($datetime, $time);
      popgraphic($hits);
      echo "<br />";
      echo ""._DESCRIPTION.": $description<br />";
      setlocale (LC_TIME, $locale);
      preg_match ("/([0-9]{4})\-([0-9]{1,2})\-([0-9]{1,2}) ([0-9]{1,2})\:([0-9]{1,2})\:([0-9]{1,2})/", $time, $datetime);
      $datetime = strftime(""._LINKSDATESTRING."", mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));
      $datetime = ucfirst($datetime);
      echo ""._ADDEDON.": $datetime "._HITS.": $hits";
      $transfertitle = str_replace (" ", "_", $title); 
    
	  /* voting & comments stats */
      if($totalvotes == 1) 
      $votestring = _VOTE;
      else 
      $votestring = _VOTES;
    
      if($linkratingsummary != "0" || $linkratingsummary != "0.0") 
      echo " "._RATING.": <strong> $linkratingsummary </strong> ($totalvotes $votestring)";
    
      echo "<br /><a href=\"modules.php?name=$module_name&amp;l_op=ratelink&amp;lid=$lid&amp;ttitle=$transfertitle\">"._RATESITE."</a>";
    
	  if(is_user()) 
      echo " | <a href=\"modules.php?name=$module_name&amp;l_op=brokenlink&amp;lid=$lid\">"._REPORTBROKEN."</a>";
    
      if($totalvotes != 0) 
      echo " | <a href=\"modules.php?name=$module_name&amp;l_op=viewlinkdetails&amp;lid=$lid&amp;ttitle=$transfertitle\">"._DETAILS."</a>";
    
      if($totalcomments != 0) 
      echo " | <a href=\"modules.php?name=$module_name&amp;l_op=viewlinkcomments&amp;lid=$lid&amp;ttitle=$transfertitle\">"._SCOMMENTS." ($totalcomments)</a>";
    
      detecteditorial($lid, $transfertitle);
    
	  echo "<br />";
    
	  $row2 = $db->sql_fetchrow($db->sql_query("SELECT title from ".$prefix."_links_categories where cid='$cid'"));
      $ctitle = $row2['title'];
      $ctitle = weblinks_parent($cid,$ctitle);
    
	echo ""._CATEGORY.": $ctitle";
    # stop using <br /> use a div tag with padding whenever it's possible!
    print '<div align="center" style="padding-top:6px;">'."\n";
    print '</div>'."\n";
    
	endwhile;

    echo "</span></td></tr></table>";
    
	CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function MostPopular($ratenum, $ratetype) 
{
    global $prefix, $db, $admin, $module_name, $user, $admin_file, $locale, $mainvotedecimal, $datetime;
    include_once(NUKE_BASE_DIR.'header.php');
    include(NUKE_MODULES_DIR.$module_name.'/l_config.php');
    menu(1);

    OpenTable();

    # stop using <br /> use a div tag with padding whenever it's possible!
    print '<div align="center" style="padding-top:11px;">'."\n";
    print '</div>'."\n";

    echo "<table border=\"0\" width=\"100%\"><tr><td align=\"center\">";
    if (!empty($ratenum) && !empty($ratetype)):
    $ratenum = intval($ratenum);
    $ratetype = htmlentities($ratetype);
        $mostpoplinks = $ratenum;
        if ($ratetype == "percent") $mostpoplinkspercentrigger = 1;
    endif;
	
    if ($mostpoplinkspercentrigger == 1):
        $toplinkspercent = $mostpoplinks;
        $result2 = $db->sql_query("SELECT * from ".$prefix."_links_links");
        $totalmostpoplinks = $db->sql_numrows($result2);
        $mostpoplinks = $mostpoplinks / 100;
        $mostpoplinks = $totalmostpoplinks * $mostpoplinks;
        $mostpoplinks = round($mostpoplinks);
    endif;
    
	if ($mostpoplinkspercentrigger == 1) 
    echo "<center><span class=\"option\"><strong><h1>"._MOSTPOPULAR." $toplinkspercent% ("._OFALL." $totalmostpoplinks "._LINKS.")</h1></strong></span></center>";
	else 
    echo "<center><span class=\"option\"><strong><h1>"._MOSTPOPULAR." ".htmlentities($mostpoplinks)."</h1></strong></span></center>";
    
	echo "<tr><td><center>"._SHOWTOP.": [ <a href=\"modules.php?name=$module_name&amp;l_op=MostPopular&amp;ratenum=10&amp;ratetype=num\">10</a> - "
    ."<a href=\"modules.php?name=$module_name&amp;l_op=MostPopular&amp;ratenum=25&amp;ratetype=num\">25</a> - "
        ."<a href=\"modules.php?name=$module_name&amp;l_op=MostPopular&amp;ratenum=50&amp;ratetype=num\">50</a> | "
        ."<a href=\"modules.php?name=$module_name&amp;l_op=MostPopular&amp;ratenum=1&amp;ratetype=percent\">1%</a> - "
        ."<a href=\"modules.php?name=$module_name&amp;l_op=MostPopular&amp;ratenum=5&amp;ratetype=percent\">5%</a> - "
        ."<a href=\"modules.php?name=$module_name&amp;l_op=MostPopular&amp;ratenum=10&amp;ratetype=percent\">10%</a> ]</center><br /><br /></td></tr>";
    
	if(!is_numeric($mostpoplinks)) 
    $mostpoplinks=10;
    
	$result3 = $db->sql_query("SELECT `lid`, 
	                                  `cid`, 
									  `sid`, 
									`title`, 
							  `description`, 
							         `date`, 
									 `hits`, 
						`linkratingsummary`, 
						       `totalvotes`, 
							`totalcomments` FROM ".$prefix."_links_links 
							             ORDER by hits 
										  DESC limit 0,$mostpoplinks");
    echo "<tr><td>";
	
    //print '<hr>'."\n";

    while($row3 = $db->sql_fetchrow($result3)): 
	
    $lid = intval($row3['lid']);
    $cid = intval($row3['cid']);
    $sid = intval($row3['sid']);
    $title = stripslashes(check_html($row3['title'], "nohtml"));
    $description = stripslashes($row3['description']);
    $time = $row3['date'];
    $hits = intval($row3['hits']);
    $linkratingsummary = $row3['linkratingsummary'];
    $totalvotes = intval($row3['totalvotes']);
    $totalcomments = $row3['totalcomments'];
    $linkratingsummary = number_format($linkratingsummary, $mainvotedecimal);
    echo "<span class=\"content\"><font size=\"4\"><i class=\"bi bi-link-45deg\"></i></font> <a href=\"modules.php?name=$module_name&amp;l_op=visit&amp;lid=$lid\" target=\"new\">$title</a>";
    newlinkgraphic($datetime, $time);
    popgraphic($hits);
    echo "<br />";
    echo "<i class=\"bi bi-info-square\"></i> $description<br />";
    setlocale (LC_TIME, $locale);
    preg_match ("/([0-9]{4})\-([0-9]{1,2})\-([0-9]{1,2}) ([0-9]{1,2})\:([0-9]{1,2})\:([0-9]{1,2})/", $time, $datetime);
    $datetime = strftime(""._LINKSDATESTRING."", mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));
    $datetime = ucfirst($datetime);
    echo "<i class=\"bi bi-calendar4\"></i> "._ADDEDON.": $datetime "._HITS.": <strong>$hits</strong>";
    $transfertitle = str_replace (" ", "_", $title);
    
	/* voting & comments stats */
    if ($totalvotes == 1) 
    $votestring = _VOTE;
    else 
    $votestring = _VOTES;
    
    if ($linkratingsummary!="0" || $linkratingsummary!="0.0") 
    echo " "._RATING.": $linkratingsummary ($totalvotes $votestring)";
    
    echo "<br />";
    
	if (is_mod_admin($module_name)) 
    echo "<a href=\"".$admin_file.".php?op=LinksModLink&amp;lid=$lid\">"._EDIT."</a> | ";
    
    echo "<a href=\"modules.php?name=$module_name&amp;l_op=ratelink&amp;lid=$lid&amp;ttitle=$transfertitle\">"._RATESITE."</a>";
    
	if (is_user()) 
    echo " | <a href=\"modules.php?name=$module_name&amp;l_op=brokenlink&amp;lid=$lid\">"._REPORTBROKEN."</a>";
    
    if ($totalvotes != 0) 
    echo " | <a href=\"modules.php?name=$module_name&amp;l_op=viewlinkdetails&amp;lid=$lid&amp;ttitle=$transfertitle\">"._DETAILS."</a>";
    
    if ($totalcomments != 0) 
    echo " | <a href=\"modules.php?name=$module_name&amp;l_op=viewlinkcomments&amp;lid=$lid&amp;ttitle=$transfertitle\">"._SCOMMENTS." ($totalcomments)</a>";
    
    detecteditorial($lid, $transfertitle);
    
	echo "<br />";
    
	$row4 = $db->sql_fetchrow($db->sql_query("SELECT title from ".$prefix."_links_categories where cid='$cid'"));
    $ctitle = stripslashes(check_html($row4['title'], "nohtml"));
    $ctitle=weblinks_parent($cid,$ctitle);
    
	echo ""._CATEGORY.": $ctitle";

    # stop using <br /> use a div tag with padding whenever it's possible!
    print '<div align="center" style="padding-top:13px;">'."\n";
    print '</div>'."\n";

    echo "</span>";
    endwhile;
    echo "</span></td></tr></table>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function RandomLink() 
{
/*  This is pure garabage!
    global $prefix, $db;
    $result = $db->sql_query("SELECT * from ".$prefix."_links_links");
    $numrows = $db->sql_numrows($result);
    if ($numrows == 1) {
    $random = 1;
    } else {
  //srand((double)microtime()*1000000); <- this horse shit is dead and gone
    mt_srand((double)microtime()*1_000_000); # <- this is the new horse shit
    $random = rand(1,$numrows);
        $random = intval($random);
    }
    $row2 = $db->sql_fetchrow($db->sql_query("SELECT url from ".$prefix."_links_links where lid='$random'"));
    $url = stripslashes($row2['url']);
    $db->sql_query("update ".$prefix."_links_links set hits=hits+1 where lid='$random'");
    redirect("$url");
*/
}

function viewlink($cid, $min, $orderby, $show) 
{
    global $prefix, $db, $admin, $perpage, $module_name, $user, $admin_file, $locale, $mainvotedecimal, $datetime;
    $show = intval($show);

    if (empty($show))
    $show = '';
    
	if (!empty($orderby)) 
    $orderby = htmlspecialchars($orderby);
    
    include_once(NUKE_BASE_DIR.'header.php');

    if(empty($min))
	$min = '';
	
    if(!isset($min)) 
	$min=0;
    
	if(empty($max))
	$max = '';
	
	if(!isset($max)) 
	$max=$min+$perpage;
    
	if(!empty($orderby)) 
    $orderby = convertorderbyin($orderby);
	else 
    $orderby = "title ASC";
    
	if(!empty($show)) 
    $perpage = $show;
	else 
    $show=$perpage;

    menu(1);

    OpenTable();

    # stop using <br /> use a div tag with padding whenever it's possible!
    print '<div align="center" style="padding-top:11px;">'."\n";
    print '</div>'."\n";

    $cid = intval($cid);
    $row_two = $db->sql_fetchrow($db->sql_query("SELECT title,parentid FROM ".$prefix."_links_categories WHERE cid='$cid'"));
    $title = stripslashes(check_html($row_two['title'], "nohtml"));
    $parentid = intval($row_two['parentid']);
    
	$title=weblinks_parentlink($parentid,$title);
    
	$title="<a href=modules.php?name=$module_name>"._MAIN."</a>/$title";
    echo "<center><span class=\"option\"><strong><h1>$title</h1></strong></span></center><br />";
    
	echo "<table border=\"0\" cellspacing=\"10\" cellpadding=\"0\" align=\"center\"><tr>";
    $cid = intval($cid);
    $result2 = $db->sql_query("SELECT cid, title, cdescription from ".$prefix."_links_categories where parentid='$cid' order by title");
    $dum = 0;
    $count = 0;
    
	while($row2 = $db->sql_fetchrow($result2)):
        $cid2 = intval($row2['cid']);
        $title2 = stripslashes(check_html($row2['title'], "nohtml"));
        $cdescription2 = stripslashes($row2['cdescription']);
    echo "<td><span class=\"option\"><strong><big><i class=\"bi bi-arrow-return-right\"></i></big></strong> <a href=\"modules.php?name=Web_Links&amp;l_op=viewlink&amp;cid=$cid2\"><strong>$title2</strong></a></span>";
    categorynewlinkgraphic($cid2);
    
	if (isset($description2)) 
    echo "<span class=\"content\">$cdescription2</span><br />";
    else 
    echo "<br />";
    
    $result3 = $db->sql_query("SELECT cid, title from ".$prefix."_links_categories where parentid='$cid2' order by title limit 0,3");
    $space = 0;
    
	while($row3 = $db->sql_fetchrow($result3)):
        $cid3 = intval($row3['cid']);
        $title3 = stripslashes(check_html($row3['title'], "nohtml"));
        if ($space>0) 
        echo ",&nbsp;";
        echo "<span class=\"content\"><a href=\"modules.php?name=$module_name&amp;l_op=viewlink&amp;cid=$cid3\">$title3</a></span>";
        $space++;
    endwhile;
    
	if ($count<1):
        echo "</td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td>";
        $dum = 1;
    endif;
    
	$count++;
    
	if ($count==2):
        echo "</td></tr><tr>";
        $count = 0;
        $dum = 0;
    endif;
    
	endwhile;
	
    if ($dum == 1) 
    echo "</tr></table>";
    elseif ($dum == 0) 
    echo "<td></td></tr></table>";
    
    echo "<hr noshade size=\"1\">";
    
	$orderbyTrans = convertorderbytrans($orderby);
    
	echo "<center><span class=\"content\">"._SORTLINKSBY.": "
        .""._TITLE." (<a href=\"modules.php?name=$module_name&amp;l_op=viewlink&amp;cid=$cid&amp;orderby=titleA\">A</a>\<a href=\"modules.php?name=$module_name&amp;l_op=viewlink&amp;cid=$cid&amp;orderby=titleD\">D</a>) "
        .""._DATE." (<a href=\"modules.php?name=$module_name&amp;l_op=viewlink&amp;cid=$cid&amp;orderby=dateA\">A</a>\<a href=\"modules.php?name=$module_name&amp;l_op=viewlink&amp;cid=$cid&amp;orderby=dateD\">D</a>) "
        .""._RATING." (<a href=\"modules.php?name=$module_name&amp;l_op=viewlink&amp;cid=$cid&amp;orderby=ratingA\">A</a>\<a href=\"modules.php?name=$module_name&amp;l_op=viewlink&amp;cid=$cid&amp;orderby=ratingD\">D</a>) "
        .""._POPULARITY." (<a href=\"modules.php?name=$module_name&amp;l_op=viewlink&amp;cid=$cid&amp;orderby=hitsA\">A</a>\<a href=\"modules.php?name=$module_name&amp;l_op=viewlink&amp;cid=$cid&amp;orderby=hitsD\">D</a>)"
    ."<br /><strong>"._SITESSORTED.": $orderbyTrans</strong></span></center><br /><br />";
    
	if(!is_numeric($min))
    $min=0;
    
    $result4 = $db->sql_query("SELECT `lid`, 
	                                `title`, 
							  `description`, 
							         `date`, 
									 `hits`, 
						`linkratingsummary`, 
						       `totalvotes`, 
							`totalcomments` FROM ".$prefix."_links_links 
							             WHERE cid='$cid' 
										 ORDER by $orderby limit $min,$perpage");
    
	$fullcountresult = $db->sql_query("SELECT `lid`, 
	                                        `title`, 
									  `description`, 
									         `date`, 
											 `hits`, 
								`linkratingsummary`, 
								       `totalvotes`, 
									`totalcomments` FROM ".$prefix."_links_links 
									             WHERE cid='$cid'");
    
	$totalselectedlinks = $db->sql_numrows($fullcountresult);
    
	echo "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"10\" border=\"0\"><tr><td><span class=\"content\">";
    $x=0;
    
	while($row4 = $db->sql_fetchrow($result4)):
        $lid = intval($row4['lid']);
        $title = stripslashes(check_html($row4['title'], "nohtml"));
        $description = stripslashes($row4['description']);
        $time = $row4['date'];
        $hits = intval($row4['hits']);
        $linkratingsummary = $row4['linkratingsummary'];
        $totalvotes = intval($row4['totalvotes']);
        $totalcomments = intval($row4['totalcomments']);
    $linkratingsummary = number_format($linkratingsummary, $mainvotedecimal);
        echo "<font size=\"4\"><i class=\"bi bi-link\"></i></font> <a href=\"modules.php?name=$module_name&amp;l_op=visit&amp;lid=$lid\" target=\"new\"><strong>$title</strong></a>";
    newlinkgraphic($datetime, $time);
    popgraphic($hits);
    
	/* INSERT code for *editor review* here */
    echo "<br />";
    echo "<i class=\"bi bi-info-square\"></i>  $description<br />";
    
	setlocale (LC_TIME, $locale);
    preg_match ("/([0-9]{4})\-([0-9]{1,2})\-([0-9]{1,2}) ([0-9]{1,2})\:([0-9]{1,2})\:([0-9]{1,2})/", $time, $datetime);
    $datetime = strftime(""._LINKSDATESTRING."", mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));
    $datetime = ucfirst($datetime);
    
	echo "<i class=\"bi bi-calendar2-plus\"></i> "._ADDEDON.": $datetime "._HITS.": $hits";
        $transfertitle = str_replace (" ", "_", $title);
        /* voting & comments stats */
        if ($totalvotes == 1) 
        $votestring = _VOTE;
        else 
        $votestring = _VOTES;
    
        if ($linkratingsummary!="0" || $linkratingsummary!="0.0") 
        echo " "._RATING.": $linkratingsummary ($totalvotes $votestring)";
    
    echo "<br />";
    
	if (is_mod_admin($module_name)) 
    echo "<a href=\"".$admin_file.".php?op=LinksModLink&amp;lid=$lid\">"._EDIT."</a> | ";
    
    echo "<a href=\"modules.php?name=$module_name&amp;l_op=ratelink&amp;lid=$lid&amp;ttitle=$transfertitle\">"._RATESITE."</a>";
    
	if (is_user()) 
    echo " | <a href=\"modules.php?name=$module_name&amp;l_op=brokenlink&amp;lid=$lid\">"._REPORTBROKEN."</a>";
    
    if ($totalvotes != 0) 
    echo " | <a href=\"modules.php?name=$module_name&amp;l_op=viewlinkdetails&amp;lid=$lid&amp;ttitle=$transfertitle\">"._DETAILS."</a>";
    
    if ($totalcomments != 0) 
    echo " | <a href=\"modules.php?name=$module_name&amp;l_op=viewlinkcomments&amp;lid=$lid&amp;ttitle=$transfertitle\">"._SCOMMENTS." ($totalcomments)</a>";
    
    detecteditorial($lid, $transfertitle);
    
	echo "<br /><br />";
    $x++;
    endwhile;
	
    echo "</span>";
    
	$orderby = convertorderbyout($orderby);
    
	/* Calculates how many pages exist. Which page one should be on, etc... */
    $linkpagesint = ($totalselectedlinks / $perpage);
    $linkpageremainder = ($totalselectedlinks % $perpage);
    
	if ($linkpageremainder != 0):
        $linkpages = ceil($linkpagesint);
 	    if ($totalselectedlinks < $perpage):
            $linkpageremainder = 0;
        endif;
 	else: 
       $linkpages = $linkpagesint;
    endif;
    
	/* Page Numbering */
    if ($linkpages!=1 && $linkpages!=0):
        echo "<br /><br />";
        echo ""._SELECTPAGE.": ";
        $prev=$min-$perpage;
      
	     if ($prev>=0): 
            echo "&nbsp;&nbsp;<strong>[ <a href=\"modules.php?name=$module_name&amp;l_op=viewlink&amp;cid=$cid&amp;min=$prev&amp;orderby=$orderby&amp;show=$show\">";
            echo " &lt;&lt; "._PREVIOUS."</a> ]</strong> ";
         endif;
		 
        $counter = 1;
     $currentpage = ($max / $perpage);

           while ($counter<=$linkpages ):
              $cpage = $counter;
              $mintemp = ($perpage * $counter) - $perpage;
 		      if ($counter == $currentpage) 
              echo "<strong>$counter</strong>&nbsp;";
		      else 
              echo "<a href=\"modules.php?name=$module_name&amp;l_op=viewlink&amp;cid=$cid&amp;min=$mintemp&amp;orderby=$orderby&amp;show=$show\">$counter</a> ";
              $counter++;
           endwhile;
         
		 $next=$min+$perpage;
         
		 if ($x>=$perpage):
            echo "&nbsp;&nbsp;<strong>[ <a href=\"modules.php?name=$module_name&amp;l_op=viewlink&amp;cid=$cid&amp;min=$max&amp;orderby=$orderby&amp;show=$show\">";
            echo " "._NEXT." &gt;&gt;</a> ]</strong> ";
         endif;
		 
    endif;
	
    echo "</td></tr></table>";
    echo '<hr>';

    # stop using <br /> use a div tag with padding whenever it's possible!
    print '<div align="center" style="padding-top:11px;">'."\n";
    print '</div>'."\n";

	CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function newlinkgraphic($datetime, $time) 
{
    global $module_name, $locale;

    echo "&nbsp;";

    setlocale (LC_TIME, $locale);
    preg_match ("/([0-9]{4})\-([0-9]{1,2})\-([0-9]{1,2}) ([0-9]{1,2})\:([0-9]{1,2})\:([0-9]{1,2})/", $time, $datetime);
    $datetime = strftime(""._LINKSDATESTRING."", mktime(isset($datetime[4]),isset($datetime[5]),isset($datetime[6]),isset($datetime[2]),isset($datetime[3]),isset($datetime[1])));
    $datetime = ucfirst($datetime);
    $startdate = time();
    $count = 0;

    while ($count <= 7):
    $daysold = date("d-M-Y", $startdate);
        if ("$daysold" == "$datetime"): 
            if ($count<=1) 
              echo "<img src=\"modules/$module_name/images/new_01.png\" alt=\""._NEWTODAY."\">";
            if ($count<=3 && $count>1) 
               echo "<img src=\"modules/$module_name/images/new_03.png\" alt=\""._NEWLAST3DAYS."\">";
            if ($count<=7 && $count>3) 
              echo "<img src=\"modules/$module_name/images/new_07.png\" alt=\""._NEWTHISWEEK."\">";
       endif;
        $count++;
        $startdate = (time()-(86400 * $count));
    endwhile;
}

function categorynewlinkgraphic($cat) 
{
    global $prefix, $db, $module_name, $locale;
    $cat = intval(trim((string) $cat));
    $row = $db->sql_fetchrow($db->sql_query("SELECT `date` FROM ".$prefix."_links_links WHERE cid='$cat' ORDER by date desc limit 1"));
    
	if(!isset($row['date']))
	$row['date'] = '';
	
	$time = $row['date'];
    
    echo "&nbsp;";
    setlocale (LC_TIME, $locale);
    preg_match ("/([0-9]{4})\-([0-9]{1,2})\-([0-9]{1,2}) ([0-9]{1,2})\:([0-9]{1,2})\:([0-9]{1,2})/", (string) $time, $datetime);
    $datetime = strftime(""._LINKSDATESTRING."", mktime(isset($datetime[4]),isset($datetime[5]),isset($datetime[6]),isset($datetime[2]),isset($datetime[3]),isset($datetime[1])));
    $datetime = ucfirst($datetime);
    $startdate = time();
    $count = 0;

    while ($count <= 7):
    $daysold = date("d-M-Y", $startdate);
        if ("$daysold" == "$datetime"):
        if ($count<=1) 
        echo "<img src=\"modules/$module_name/images/new_01.png\" alt=\""._CATNEWTODAY."\">";
        if ($count<=3 && $count>1) 
        echo "<img src=\"modules/$module_name/images/new_03.png\" alt=\""._CATLAST3DAYS."\">";
        if ($count<=7 && $count>3) 
        echo "<img src=\"modules/$module_name/images/new_07.png\" alt=\""._CATTHISWEEK."\">";
    endif;
        $count++;
        $startdate = (time()-(86400 * $count));
    endwhile;
}

function popgraphic($hits) 
{
    global $module_name;
    include(NUKE_MODULES_DIR.$module_name.'/l_config.php');
    if ($hits>=$popular) 
    echo "&nbsp;<img src=\"modules/$module_name/images/pop.gif\" alt=\""._POPULAR."\">";
}

function convertorderbyin($orderby) 
{
    if ($orderby != "titleA" AND $orderby 
	             != "dateA" AND $orderby 
				 != "hitsA" AND $orderby 
				 != "ratingA" AND $orderby 
				 != "titleD" AND $orderby 
				 != "dateD" AND $orderby 
				 != "hitsD" AND $orderby 
				 != "ratingD") 
	{
        redirect("index.php");
        exit;
    }
    if ($orderby == "titleA")    
	$orderby = "title ASC";
    if ($orderby == "dateA")    
	$orderby = "date ASC";
    if ($orderby == "hitsA")    
	$orderby = "hits ASC";
    if ($orderby == "ratingA")    
	$orderby = "linkratingsummary ASC";
    if ($orderby == "titleD")    
	$orderby = "title DESC";
    if ($orderby == "dateD")    
	$orderby = "date DESC";
    if ($orderby == "hitsD")    
	$orderby = "hits DESC";
    if ($orderby == "ratingD")    
	$orderby = "linkratingsummary DESC";
    return $orderby;
}

function convertorderbytrans($orderby) 
{
    if ($orderby != "hits ASC" AND $orderby 
	             != "hits DESC" AND $orderby 
				 != "title ASC" AND $orderby 
				 != "title DESC" AND $orderby 
				 != "date ASC" AND $orderby 
				 != "date DESC" AND $orderby 
				 != "linkratingsummary ASC" AND $orderby 
				 != "linkratingsummary DESC") 
	{
        redirect("index.php");
        exit;
    }
    if ($orderby == "hits ASC")            
	$orderbyTrans = ""._POPULARITY1."";
    if ($orderby == "hits DESC")        
	$orderbyTrans = ""._POPULARITY2."";
    if ($orderby == "title ASC")        
	$orderbyTrans = ""._TITLEAZ."";
    if ($orderby == "title DESC")        
	$orderbyTrans = ""._TITLEZA."";
    if ($orderby == "date ASC")            
	$orderbyTrans = ""._DATE1."";
    if ($orderby == "date DESC")        
	$orderbyTrans = ""._DATE2."";
    if ($orderby == "linkratingsummary ASC")    
	$orderbyTrans = ""._RATING1."";
    if ($orderby == "linkratingsummary DESC")    
	$orderbyTrans = ""._RATING2."";
    return $orderbyTrans;
}

function convertorderbyout($orderby) 
{
    if ($orderby != "title ASC" AND $orderby 
	             != "date ASC" AND $orderby 
				 != "hits ASC" AND $orderby 
				 != "linkratingsummary ASC" AND $orderby 
				 != "title DESC" AND $orderby 
				 != "date DESC" AND $orderby 
				 != "hits DESC" AND $orderby 
				 != "linkratingsummary DESC") 
	{
        redirect("index.php");
        exit;
    }
    if ($orderby == "title ASC")        
	$orderby = "titleA";
    if ($orderby == "date ASC")            
	$orderby = "dateA";
    if ($orderby == "hits ASC")            
	$orderby = "hitsA";
    if ($orderby == "linkratingsummary ASC")    
	$orderby = "ratingA";
    if ($orderby == "title DESC")        
	$orderby = "titleD";
    if ($orderby == "date DESC")        
	$orderby = "dateD";
    if ($orderby == "hits DESC")        
	$orderby = "hitsD";
    if ($orderby == "linkratingsummary DESC")    
	$orderby = "ratingD";
    return $orderby;
}

function visit($lid) 
{
    global $prefix, $db;
    $lid = intval($lid);
    $db->sql_query("update ".$prefix."_links_links set hits=hits+1 where lid='$lid'");
    $row = $db->sql_fetchrow($db->sql_query("SELECT `url` FROM ".$prefix."_links_links WHERE lid='$lid'"));
    $url = stripslashes($row['url']);
    redirect("$url");
}

function search($query, $min, $orderby, $show) 
{
    global $prefix, $db, $admin, $bgcolor2, $module_name, $locale, $mainvotedecimal, $datetime;
    include(NUKE_MODULES_DIR.$module_name.'/l_config.php');
    include_once(NUKE_BASE_DIR.'header.php');

    if (!isset($min)) 
	$min=0;
    if (!isset($max)) 
	$max=$min+$linksresults;
    if(!empty($orderby)) 
    $orderby = convertorderbyin($orderby);
	else 
    $orderby = "title ASC";
    
	if($show != "") 
    $linksresults = $show;
	else 
    $show=$linksresults;
    
	$query = htmlentities($query, ENT_QUOTES);
    $query = addslashes($query);

    if(!is_numeric($linksresults) AND $linksresults==0)
    $linksresults=10;

    $result = $db->sql_query("SELECT `lid`, 
	                                 `cid`, 
									 `sid`, 
								   `title`, 
								     `url`, 
						     `description`, 
							        `date`, 
									`hits`, 
					   `linkratingsummary`, 
					          `totalvotes`, 
						   `totalcomments` FROM ".$prefix."_links_links 
						                WHERE title 
										 LIKE '%$query%' 
										   OR description 
										 LIKE '%$query%' 
										ORDER BY $orderby 
										LIMIT ".intval($min).",$linksresults");
    
	$fullcountresult = $db->sql_query("SELECT `lid`, 
	                                        `title`, 
									  `description`, 
									         `date`, 
											 `hits`, 
							    `linkratingsummary`, 
								       `totalvotes`, 
									`totalcomments` FROM ".$prefix."_links_links 
									             WHERE title 
												  LIKE '%$query%' 
												    OR description 
												  LIKE '%$query%'");
    
	$totalselectedlinks = $db->sql_numrows($fullcountresult);
    $nrows = $db->sql_numrows($result);
    $x=0;
    $the_query = stripslashes($query);
    $the_query = str_replace("\'", "'", $the_query);
    menu(1);
    
	OpenTable();
    
	if ($query != "") :
        if ($nrows>0):
		echo "<span class=\"option\">"._SEARCHRESULTS4.": <strong>$the_query</strong></span><br /><br />"
            ."<table width=\"100%\" bgcolor=\"$bgcolor2\"><tr><td><span class=\"option\"><strong>"._USUBCATEGORIES."</strong></span></td></tr></table>";
            
			$result2 = $db->sql_query("SELECT `cid`, `title` FROM ".$prefix."_links_categories WHERE title LIKE '%$query%' ORDER BY title DESC");
            
			while ($row2 = $db->sql_fetchrow($result2)):
            $cid = intval($row2['cid']);
            $stitle = stripslashes(check_html($row2['title'], "nohtml"));
            $res = $db->sql_query("SELECT * from ".$prefix."_links_links where cid='$cid'");
            $numrows = $db->sql_numrows($res);
                $row3 = $db->sql_fetchrow($db->sql_query("SELECT cid,title,parentid from ".$prefix."_links_categories where cid='$cid'"));
                $cid3 = intval($row3['cid']);
                $title3 = stripslashes(check_html($row3['title'], "nohtml"));
                $parentid3 = intval($row3['parentid']);
            if ($parentid3>0) $title3 = weblinks_parent($parentid3,$title3);
            $title3 = str_replace($query, "<strong>$query</strong>", $title3);
            echo "<strong><big>&middot;</big></strong>&nbsp;<a href=\"modules.php?name=$module_name&amp;l_op=viewlink&amp;cid=$cid\">$title3</a> ($numrows)<br />";
        endwhile;
    
	    echo "<br /><table width=\"100%\" bgcolor=\"$bgcolor2\"><tr><td><span class=\"option\"><strong>"._LINKS."</strong></span></td></tr></table>";
        $orderbyTrans = convertorderbytrans($orderby);
        echo "<br /><span class=\"content\">"._SORTLINKSBY.": "
            .""._TITLE." (<a href=\"modules.php?name=$module_name&amp;l_op=search&amp;query=$the_query&amp;orderby=titleA\">A</a>\<a href=\"modules.php?name=$module_name&amp;l_op=search&amp;query=$the_query&amp;orderby=titleD\">D</a>)"
            .""._DATE." (<a href=\"modules.php?name=$module_name&amp;l_op=search&amp;query=$the_query&amp;orderby=dateA\">A</a>\<a href=\"modules.php?name=$module_name&amp;l_op=search&amp;query=$the_query&amp;orderby=dateD\">D</a>)"
            .""._RATING." (<a href=\"modules.php?name=$module_name&amp;l_op=search&amp;query=$the_query&amp;orderby=ratingA\">A</a>\<a href=\"modules.php?name=$module_name&amp;l_op=search&amp;query=$the_query&amp;orderby=ratingD\">D</a>)"
            .""._POPULARITY." (<a href=\"modules.php?name=$module_name&amp;l_op=search&amp;query=$the_query&amp;orderby=hitsA\">A</a>\<a href=\"modules.php?name=$module_name&amp;l_op=search&amp;query=$the_query&amp;orderby=hitsD\">D</a>)"
            ."<br />"._SITESSORTED.": $orderbyTrans<br /><br />";
        
		while($row = $db->sql_fetchrow($result)):
                $lid = intval($row['lid']);
                $cid = intval($row['cid']);
                $sid = intval($row['sid']);
                $title = stripslashes(check_html($row['title'], "nohtml"));
                $url = stripslashes($row['url']);
                $description = stripslashes($row['description']);
                $time = $row['date'];
                $hits = intval($row['hits']);
                $linkratingsummary = $row['linkratingsummary'];
                $totalvotes = intval($row['totalvotes']);
                $totalcomments = $row['totalcomments'];
        
		$linkratingsummary = number_format($linkratingsummary, $mainvotedecimal);
        $transfertitle = str_replace (" ", "_", $title);
        $title = str_replace($query, "<strong>$query</strong>", $title);
        
		echo "<a href=\"modules.php?name=$module_name&amp;l_op=visit&amp;lid=$lid\" target=\"new\">$title</a>";
        
		newlinkgraphic($datetime, $time);
            popgraphic($hits);
        
		echo "<br />";
        
		$description = str_replace($query, "<strong>$query</strong>", $description);
        
		echo ""._DESCRIPTION.": $description<br />";
        
		setlocale (LC_TIME, $locale);
        preg_match ("/([0-9]{4})\-([0-9]{1,2})\-([0-9]{1,2}) ([0-9]{1,2})\:([0-9]{1,2})\:([0-9]{1,2})/", $time, $datetime);
        $datetime = strftime(""._LINKSDATESTRING."", mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]));
        $datetime = ucfirst($datetime);
        
		echo ""._ADDEDON.": $datetime "._HITS.": $hits";
        /* voting & comments stats */
        if ($totalvotes == 1) 
        $votestring = _VOTE;
        else 
        $votestring = _VOTES;
        
        if ($linkratingsummary!="0" || $linkratingsummary!="0.0") 
        echo " "._RATING.": $linkratingsummary ($totalvotes $votestring)";
        
        echo "<br /><a href=\"modules.php?name=$module_name&amp;l_op=ratelink&amp;lid=$lid&amp;ttitle=$transfertitle\">"._RATESITE."</a>";
        
		if ($totalvotes != 0) 
        echo " | <a href=\"modules.php?name=$module_name&amp;l_op=viewlinkdetails&amp;lid=$lid&amp;ttitle=$transfertitle\">"._DETAILS."</a>";
        
        if ($totalcomments != 0) 
        echo " | <a href=\"modules.php?name=$module_name&amp;l_op=viewlinkcomments&amp;lid=$lid&amp;ttitle=$transfertitle>"._SCOMMENTS." ($totalcomments)</a>";
        
        detecteditorial($lid, $transfertitle);
        
		echo "<br />";
        
		$row4 = $db->sql_fetchrow($db->sql_query("SELECT cid,title,parentid from ".$prefix."_links_categories where cid='$cid'"));
        $cid3 = intval($row4['cid']);
        $title3 = stripslashes(check_html($row4['title'], "nohtml"));
        $parentid3 = intval($row4['parentid']);
        
		if ($parentid3>0) 
		$title3 = weblinks_parent($parentid3,$title3);
        
		echo ""._CATEGORY.": $title3<br /><br />";
        $x++;
    
	endwhile;
    
	echo "</span>";
    $orderby = convertorderbyout($orderby);
    else:
    echo "<br /><center><span class=\"option\"><strong>"._NOMATCHES."</strong></span><br /><br />"._GOBACK."<br /></center>";
    endif;
	
    /* Calculates how many pages exist.  Which page one should be on, etc... */
    $linkpagesint = ($totalselectedlinks / $linksresults);
    $linkpageremainder = ($totalselectedlinks % $linksresults);
    if ($linkpageremainder != 0):
        $linkpages = ceil($linkpagesint);
        if ($totalselectedlinks < $linksresults): 
            $linkpageremainder = 0;
		endif;
 	else: 
        $linkpages = $linkpagesint;
    endif;
	
	/* Page Numbering */
    if ($linkpages!=1 && $linkpages!=0):
 
    echo "<br /><br />"
        .""._SELECTPAGE.": ";
    $prev=$min-$linksresults;
    if ($prev>=0)
            echo "&nbsp;&nbsp;<strong>[ <a href=\"modules.php?name=$module_name&amp;l_op=search&amp;query=$the_query&amp;min=$prev&amp;orderby=$orderby&amp;show=$show\">"
            ." &lt;&lt; "._PREVIOUS."</a> ]</strong> ";
          
    $counter = 1;
        $currentpage = ($max / $linksresults);
        
		while ($counter<=$linkpages ):
            $cpage = $counter;
            $mintemp = ($perpage * $counter) - $linksresults;
         if ($counter == $currentpage) 
         echo "<strong>$counter</strong>&nbsp;";
         else 
         echo "<a href=\"modules.php?name=$module_name&amp;l_op=search&amp;query=$the_query&amp;min=$mintemp&amp;orderby=$orderby&amp;show=$show\">$counter</a> ";
         $counter++;
        endwhile;

        $next=$min+$linksresults;

        if ($x>=$perpage) 
            echo "&nbsp;&nbsp;<strong>[ <a href=\"modules.php?name=$module_name&amp;l_op=search&amp;query=$the_query&amp;min=$max&amp;orderby=$orderby&amp;show=$show\">"
            ." "._NEXT." &gt;&gt;</a> ]</strong>";
    endif;

    echo "<center><span class=\"content\">"
    ."<br />"._TRY2SEARCH." \"$the_query\" "._INOTHERSENGINES."<br />"
    ."<br /><a target=\"_blank\" href=\"http://search.disney.com/search?o=home&q=$the_query\">Disney</a> - "
    ."<a target=\"_blank\" href=\"https://search.lycos.com/web/?q=$the_query&amp;maxhits=20\">Lycos</a> - "
    ."<a target=\"_blank\" href=\"https://search.yahoo.com/search?p=$the_query\">Yahoo</a> - "
    ."<a target=\"_blank\" href=\"http://www.google.com/search?q=$the_query\">Google</a> - "
    ."<a target=\"_blank\" href=\"https://groups.google.com/search?q=$the_query\">Google Groups</a> - "
    ."<a target=\"_blank\" href=\"https://forums.justlinux.com/tags.php?tag=$the_query\">JustLinux Forums</a><br />"
    ."</span>";
  else:
  echo "<center><span class=\"option\"><strong>"._NOMATCHES."</strong></span></center><br />";
  endif;
    
  echo '<br />';
  CloseTable();
  include_once(NUKE_BASE_DIR.'footer.php');
}

function viewlinkeditorial($lid, $ttitle) 
{
    global $prefix, $db, $admin, $module_name;

    include_once(NUKE_BASE_DIR.'header.php');
    include(NUKE_MODULES_DIR.$module_name.'/l_config.php');
    menu(1);
    $lid = intval(trim($lid));
    
	$result = $db->sql_query("SELECT `adminid`, 
	                      `editorialtimestamp`, 
						       `editorialtext`, 
							  `editorialtitle` FROM ".$prefix."_links_editorials 
							                WHERE linkid = '".$lid."'");
    
	$recordexist = $db->sql_numrows($result);
    $ttitle = htmlentities($ttitle);
    $transfertitle = str_replace ("_", " ", $ttitle);
    $displaytitle = $transfertitle;

    OpenTable();
	
    # stop using <br /> use a div tag with padding whenever it's possible!
    print '<div align="center" style="padding-top:11px;">'."\n";
    print '</div>'."\n";

    echo "<div align=\"center\"><span class=\"option\"><strong><h1>"._LINKPROFILE.": ".htmlentities($displaytitle)."</h1></strong></span><br />";
    linkinfomenu($lid, $ttitle);
    
	if ($recordexist != 0):
    
	while($row = $db->sql_fetchrow($result)):
        $adminid = $row['adminid']; // Fixed 5/6/2021 (Someone fucked this up setting as intval!)
        $editorialtimestamp = $row['editorialtimestamp'];
        $editorialtext = stripslashes($row['editorialtext']);
        $editorialtitle = stripslashes(check_html($row['editorialtitle'], "nohtml"));
        preg_match ("/([0-9]{4})\-([0-9]{1,2})\-([0-9]{1,2}) ([0-9]{1,2})\:([0-9]{1,2})\:([0-9]{1,2})/", $editorialtimestamp, $editorialtime);
        $editorialtime = strftime("%F",mktime($editorialtime[4],$editorialtime[5],$editorialtime[6],$editorialtime[2],$editorialtime[3],$editorialtime[1]));
        $date_array = explode("-", $editorialtime);
        $timestamp = mktime(0, 0, 0, $date_array['1'], $date_array['2'], $date_array['0']);
        $formatted_date = date("F j, Y", $timestamp);
        echo "<br /><br />";
        
		OpenTable2();
        echo "<center><span class=\"option\"><strong>'$editorialtitle'</strong></span></center>"
        ."<center><span class=\"tiny\">"._EDITORIALBY." ".$adminid." - ".$formatted_date."</span></center><br /><br />"
        ."$editorialtext";
        CloseTable2();
        endwhile;
    
	else:
    echo "<br /><br /><center><span class=\"option\"><strong>"._NOEDITORIAL."</strong></span></center>";
	endif;
    
    echo "<br /><br /><center>";
    linkfooter($lid,$ttitle);
    echo "</div>";
    
    # stop using <br /> use a div tag with padding whenever it's possible!
    print '<div align="center" style="padding-top:11px;">'."\n";
    print '</div>'."\n";

	CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function detecteditorial($lid, $ttitle) 
{
    global $prefix, $db, $module_name;
    $lid = intval($lid);
    $resulted2 = $db->sql_query("SELECT adminid FROM ".$prefix."_links_editorials WHERE linkid='$lid'");
    $recordexist = $db->sql_numrows($resulted2);
    
	if ($recordexist != 0) 
    echo " | <a href=\"modules.php?name=$module_name&amp;l_op=viewlinkeditorial&amp;lid=$lid&amp;ttitle=$ttitle\">"._EDITORIAL."</a>";
    
}

function viewlinkcomments($lid, $ttitle) 
{
    global $prefix, $db, $admin, $bgcolor2, $module_name, $admin_file;
    include_once(NUKE_BASE_DIR.'header.php');
    include(NUKE_MODULES_DIR.$module_name.'/l_config.php');
    menu(1);
    $lid = intval(trim($lid));

    $result = $db->sql_query("SELECT `ratinguser`, 
	                                     `rating`, 
							     `ratingcomments`, 
								`ratingtimestamp` FROM ".$prefix."_links_votedata 
								               WHERE ratinglid = '$lid' 
											     AND ratingcomments != '' 
											   ORDER by ratingtimestamp 
											    DESC");
												
    $totalcomments = $db->sql_numrows($result);
    $ttitle = htmlentities($ttitle);
    $transfertitle = str_replace ("_", " ", $ttitle);
    $displaytitle = $transfertitle;
	
    OpenTable();
    
    # stop using <br /> use a div tag with padding whenever it's possible!
    print '<div align="center" style="padding-top:11px;">'."\n";
    print '</div>'."\n";
	
	echo "<div align=\"center\"><span class=\"option\"><strong><h1>"._LINKPROFILE.": ".htmlentities($displaytitle)."</h1></strong></span><br /><br />";
    
	linkinfomenu($lid, $ttitle);
    
	echo "<br /><br /><br />"._TOTALOF." $totalcomments "._COMMENTS."</span><br />"
    ."<table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\" width=\"450\">";
    $x=0;
    
	while($row = $db->sql_fetchrow($result)):
	 	
        $ratinguser = $row['ratinguser'];
        $rating = intval($row['rating']);
        $ratingcomments = $row['ratingcomments'];
        $ratingtimestamp = $row['ratingtimestamp'];
        preg_match ("/([0-9]{4})\-([0-9]{1,2})\-([0-9]{1,2}) ([0-9]{1,2})\:([0-9]{1,2})\:([0-9]{1,2})/", $ratingtimestamp, $ratingtime);
        $ratingtime = strftime("%F",mktime($ratingtime[4],$ratingtime[5],$ratingtime[6],$ratingtime[2],$ratingtime[3],$ratingtime[1]));
        $date_array = explode("-", $ratingtime);
        $timestamp = mktime(0, 0, 0, $date_array['1'], $date_array['2'], $date_array['0']);
        $formatted_date = date("F j, Y", $timestamp);
        
		/* Individual user information */
        $result2 = $db->sql_query("SELECT `rating` FROM ".$prefix."_links_votedata WHERE ratinguser = '$ratinguser'");
        $usertotalcomments = $db->sql_numrows($result2);
        $useravgrating = 0;
    
	while($row2 = $db->sql_fetchrow($result2))
        
		$rating2 = intval($row2['rating']);
        $useravgrating = $useravgrating + $rating2;
        $useravgrating = $useravgrating / $usertotalcomments;
        $useravgrating = number_format($useravgrating, 1);
        
		echo "<tr><td bgcolor=\"$bgcolor2\">"
            ."<span class=\"content\"><strong> "._USER.": </strong><a href=\"$nukeurl/modules.php?name=Your_Account&amp;op=userinfo&amp;username=$ratinguser\">$ratinguser</a></span>"
            ."</td>"
            ."<td bgcolor=\"$bgcolor2\">"
            ."<span class=\"content\"><strong>"._RATING.": </strong>$rating</span>"
            ."</td>"
            ."<td bgcolor=\"$bgcolor2\" align=\"right\">"
            ."<span class=\"content\">$formatted_date</span>"
            ."</td>"
            ."</tr>"
            ."<tr>"
            ."<td valign=\"top\">"
            ."<span class=\"tiny\">"._USERAVGRATING.": $useravgrating</span>"
            ."</td>"
            ."<td valign=\"top\" colspan=\"2\">"
            ."<span class=\"tiny\">"._NUMRATINGS.": $usertotalcomments</span>"
            ."</td>"
            ."</tr>"
            ."<tr>"
            ."<td colspan=\"3\">"
            ."<span class=\"content\">";
    
	    if (is_mod_admin($module_name)) 
        echo "<a href=\"".$admin_file.".php?op=LinksModLink&amp;lid=$lid\"><img src=\"modules/$module_name/images/editicon.gif\" border=\"0\" alt=\""._EDITTHISLINK."\"></a>";
        
    echo " $ratingcomments</span>"
        ."<br /><br /><br /></td></tr>";
    
	$x++;
    
	endwhile;
	
    echo "</table><br /><br /><div align=\"center\">";
    
	linkfooter($lid,$ttitle);
    
	echo "</div></div>";

    # stop using <br /> use a div tag with padding whenever it's possible!
    print '<div align="center" style="padding-top:11px;">'."\n";
    print '</div>'."\n";

    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function viewlinkdetails($lid, $ttitle) 
{
    global $prefix, $db, $admin, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4, $module_name, $anonymous;

    include_once(NUKE_BASE_DIR.'header.php');
    include(NUKE_MODULES_DIR.$module_name.'/l_config.php');

    menu(1);

    $lid = intval($lid);
    $voteresult = $db->sql_query("SELECT `rating`, `ratinguser`, `ratingcomments` FROM ".$prefix."_links_votedata WHERE ratinglid = '$lid'");
    $totalvotesDB = $db->sql_numrows($voteresult);
    $anonvotes = 0;
    $anonvoteval = 0;
    $outsidevotes = 0;
    $outsidevoteeval = 0;
    $regvoteval = 0;
    $topanon = 0;
    $bottomanon = 11;
    $topreg = 0;
    $bottomreg = 11;
    $topoutside = 0;
    $bottomoutside = 11;
    $avv = array(0,0,0,0,0,0,0,0,0,0,0);
    $rvv = array(0,0,0,0,0,0,0,0,0,0,0);
    $ovv = array(0,0,0,0,0,0,0,0,0,0,0);
    $truecomments = $totalvotesDB;

    while($row = $db->sql_fetchrow($voteresult)): 
	
     $ratingDB = intval($row['rating']);
     $ratinguserDB = $row['ratinguser'];
     $ratingcommentsDB = $row['ratingcomments'];
     
	 if ($ratingcommentsDB=="") 
	 $truecomments--;
     
	 if ($ratinguserDB==$anonymous): 
     $anonvotes++;
     $anonvoteval += $ratingDB;
     endif;
    
	 if ($useoutsidevoting == 1): 
        if ($ratinguserDB=='outside'): 
        $outsidevotes++;
        $outsidevoteval += $ratingDB;
        endif;
	else: 
        $outsidevotes = 0;
    endif;    
    
	if($ratinguserDB!=$anonymous && $ratinguserDB!="outside") 
    $regvoteval += $ratingDB;
    
	if($ratinguserDB!=$anonymous && $ratinguserDB!="outside"): 
        if ($ratingDB > $topreg) 
		$topreg = $ratingDB;
        if ($ratingDB < $bottomreg) 
		$bottomreg = $ratingDB;
        for ($rcounter=1; $rcounter<11; $rcounter++): 
		if ($ratingDB==$rcounter) 
		$rvv[$rcounter]++;
		endfor;
    endif;
    
	if($ratinguserDB==$anonymous): 
        if ($ratingDB > $topanon) 
		$topanon = $ratingDB;
        if ($ratingDB < $bottomanon) 
		$bottomanon = $ratingDB;
        for ($rcounter=1; $rcounter<11; $rcounter++): 
		if ($ratingDB==$rcounter) 
		$avv[$rcounter]++;
		endfor;
    endif;
    
	if ($ratinguserDB=="outside"): 
        if ($ratingDB > $topoutside) 
		$topoutside = $ratingDB;
        if ($ratingDB < $bottomoutside) 
		$bottomoutside = $ratingDB;
        for ($rcounter=1; $rcounter<11; $rcounter++): 
		if ($ratingDB==$rcounter) 
		$ovv[$rcounter]++;
		endfor;
    endif;
	
    endwhile;
    
	$regvotes = $totalvotesDB - $anonvotes - $outsidevotes;
    
    if($totalvotesDB == 0): 
    $finalrating = 0;
	elseif($anonvotes == 0 && $regvotes == 0): 
    /* Figure Outside Only Vote */
    $finalrating = $outsidevoteval / $outsidevotes;
    $finalrating = number_format($finalrating, $detailvotedecimal);
    $avgOU = $outsidevoteval / $totalvotesDB;
    $avgOU = number_format($avgOU, $detailvotedecimal);
	elseif($outsidevotes == 0 && $regvotes == 0): 
     /* Figure Anon Only Vote */
    $finalrating = $anonvoteval / $anonvotes;
    $finalrating = number_format($finalrating, $detailvotedecimal);
    $avgAU = $anonvoteval / $totalvotesDB;
    $avgAU = number_format($avgAU, $detailvotedecimal);
	elseif($outsidevotes == 0 && $anonvotes == 0): 
    /* Figure Reg Only Vote */
    $finalrating = $regvoteval / $regvotes;
    $finalrating = number_format($finalrating, $detailvotedecimal);
    $avgRU = $regvoteval / $totalvotesDB;
    $avgRU = number_format($avgRU, $detailvotedecimal);
	elseif ($regvotes == 0 && $useoutsidevoting == 1 && $outsidevotes != 0 && $anonvotes != 0 ): 
     /* Figure Reg and Anon Mix */
    $avgAU = $anonvoteval / $anonvotes;
    $avgOU = $outsidevoteval / $outsidevotes;
	   if ($anonweight > $outsideweight ): 
           /* Anon is 'standard weight' */
           $newimpact = $anonweight / $outsideweight;
           $impactAU = $anonvotes;
           $impactOU = $outsidevotes / $newimpact;
           $finalrating = ((($avgOU * $impactOU) + ($avgAU * $impactAU)) / ($impactAU + $impactOU));
           $finalrating = number_format($finalrating, $detailvotedecimal);
	   else: 
           /* Outside is 'standard weight' */
           $newimpact = $outsideweight / $anonweight;
           $impactOU = $outsidevotes;
           $impactAU = $anonvotes / $newimpact;
           $finalrating = ((($avgOU * $impactOU) + ($avgAU * $impactAU)) / ($impactAU + $impactOU));
           $finalrating = number_format($finalrating, $detailvotedecimal);
       endif;
    else: 
         /* REG User vs. Anonymous vs. Outside User Weight Calutions */
         $impact = $anonweight;
         $outsideimpact = $outsideweight;

         if ($regvotes == 0) 
         $avgRU = 0;
         else 
         $avgRU = $regvoteval / $regvotes;
         
         if ($anonvotes == 0) 
         $avgAU = 0;
		 else 
         $avgAU = $anonvoteval / $anonvotes;
         
         if ($outsidevotes == 0 ) 
         $avgOU = 0;
		 else 
         $avgOU = $outsidevoteval / $outsidevotes;
         
         $impactRU = $regvotes;
         $impactAU = $anonvotes / $impact;
         $impactOU = $outsidevotes / $outsideimpact;
         $finalrating = (($avgRU * $impactRU) + ($avgAU * $impactAU) + ($avgOU * $impactOU)) / ($impactRU + $impactAU + $impactOU);
         $finalrating = number_format($finalrating, $detailvotedecimal);
endif;

    if (!isset($avgOU) || $avgOU == 0 || empty($avgOU)) 
    $avgOU = "";
	else 
    $avgOU = number_format($avgOU, $detailvotedecimal);

    if (!isset($avgRU) || $avgRU == 0 || empty($avgRU)) 
    $avgRU = "";
	else 
    $avgRU = number_format($avgRU, $detailvotedecimal);

    if (!isset($avgAU) || $avgAU == 0 || empty($avgAU)) 
    $avgAU = "";
	else 
    $avgAU = number_format($avgAU, $detailvotedecimal);

    if ($topanon == 0) 
	$topanon = "";
    if ($bottomanon == 11) 
	$bottomanon = "";
    if ($topreg == 0) 
	$topreg = "";
    if ($bottomreg == 11) 
	$bottomreg = "";
    if ($topoutside == 0) 
	$topoutside = "";
    if ($bottomoutside == 11) 
	$bottomoutside = "";

    $totalchartheight = 70;
    $chartunits = $totalchartheight / 10;
    $avvper        = array(0,0,0,0,0,0,0,0,0,0,0);
    $rvvper         = array(0,0,0,0,0,0,0,0,0,0,0);
    $ovvper         = array(0,0,0,0,0,0,0,0,0,0,0);
    $avvpercent     = array(0,0,0,0,0,0,0,0,0,0,0);
    $rvvpercent     = array(0,0,0,0,0,0,0,0,0,0,0);
    $ovvpercent     = array(0,0,0,0,0,0,0,0,0,0,0);
    $avvchartheight    = array(0,0,0,0,0,0,0,0,0,0,0);
    $rvvchartheight    = array(0,0,0,0,0,0,0,0,0,0,0);
    $ovvchartheight    = array(0,0,0,0,0,0,0,0,0,0,0);
    $avvmultiplier = 0;
    $rvvmultiplier = 0;
    $ovvmultiplier = 0;
    
	for ($rcounter=1; $rcounter<11; $rcounter++): 
        if ($anonvotes != 0) 
		$avvper[$rcounter] = $avv[$rcounter] / $anonvotes;
		if ($regvotes != 0) 
		$rvvper[$rcounter] = $rvv[$rcounter] / $regvotes;
		if ($outsidevotes != 0) 
		$ovvper[$rcounter] = $ovv[$rcounter] / $outsidevotes;
		$avvpercent[$rcounter] = number_format($avvper[$rcounter] * 100, 1);
        $rvvpercent[$rcounter] = number_format($rvvper[$rcounter] * 100, 1);
        $ovvpercent[$rcounter] = number_format($ovvper[$rcounter] * 100, 1);
		if ($avv[$rcounter] > $avvmultiplier) 
		$avvmultiplier = $avv[$rcounter];
		if ($rvv[$rcounter] > $rvvmultiplier) 
		$rvvmultiplier = $rvv[$rcounter];
		if ($ovv[$rcounter] > $ovvmultiplier) 
		$ovvmultiplier = $ovv[$rcounter];
    endfor;
    
	if ($avvmultiplier != 0) 
	$avvmultiplier = 10 / $avvmultiplier;
	if ($rvvmultiplier != 0) 
	$rvvmultiplier = 10 / $rvvmultiplier;
	if ($ovvmultiplier != 0) 
	$ovvmultiplier = 10 / $ovvmultiplier;
    
	for ($rcounter=1; $rcounter<11; $rcounter++): 
        $avvchartheight[$rcounter] = ($avv[$rcounter] * $avvmultiplier) * $chartunits;
        $rvvchartheight[$rcounter] = ($rvv[$rcounter] * $rvvmultiplier) * $chartunits;
        $ovvchartheight[$rcounter] = ($ovv[$rcounter] * $ovvmultiplier) * $chartunits;
        if ($avvchartheight[$rcounter]==0) 
		$avvchartheight[$rcounter]=1;
        if ($rvvchartheight[$rcounter]==0) 
		$rvvchartheight[$rcounter]=1;
        if ($ovvchartheight[$rcounter]==0) 
		$ovvchartheight[$rcounter]=1;
    endfor;

    $ttitle = htmlentities($ttitle);
    $transfertitle = str_replace ("_", " ", $ttitle);
    $displaytitle = $transfertitle;

    OpenTable();

    # stop using <br /> use a div tag with padding whenever it's possible!
    print '<div align="center" style="padding-top:11px;">'."\n";
    print '</div>'."\n";

    echo "<div align=\"center\"><span class=\"option\"><strong><h1>"._LINKPROFILE.": ".htmlentities($displaytitle)."</h1></strong></span><br /><br />";

    linkinfomenu($lid, $ttitle);

    echo "<br /><br />"._LINKRATINGDET."<br />"
        .""._TOTALVOTES." $totalvotesDB<br />"
        .""._OVERALLRATING.": $finalrating</center><br /><br />"
        ."<table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\" width=\"455\">"
        ."<tr><td colspan=\"2\" bgcolor=\"$bgcolor2\">"
        ."<span class=\"content\"><strong>"._REGISTEREDUSERS."</strong></span>"
        ."</td></tr>"
        ."<tr>"
        ."<td bgcolor=\"$bgcolor1\">"
        ."<span class=\"content\">"._NUMBEROFRATINGS.": $regvotes</span>"
        ."</td>"
        ."<td rowspan=\"5\" width=\"200\">";
    
	if ($regvotes==0): 
    echo "<div align=\"center\"><span class=\"content\">"._NOREGUSERSVOTES."</span></div>";
	else: 
      echo "<table border=\"1\" width=\"200\">"
      ."<tr>"
      ."<td valign=\"top\" align=\"center\" colspan=\"10\" bgcolor=\"$bgcolor2\"><span class=\"content\">"._BREAKDOWNBYVAL."</span></td>"
      ."</tr>"
      ."<tr>"
      ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$rvv[1] "._LVOTES." ($rvvpercent[1]% "._LTOTALVOTES.")\" src=\"images/blackpixel.png\" width=\"15\" height=\"$rvvchartheight[1]\"></td>"
      ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$rvv[2] "._LVOTES." ($rvvpercent[2]% "._LTOTALVOTES.")\" src=\"images/blackpixel.png\" width=\"15\" height=\"$rvvchartheight[2]\"></td>"
      ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$rvv[3] "._LVOTES." ($rvvpercent[3]% "._LTOTALVOTES.")\" src=\"images/blackpixel.png\" width=\"15\" height=\"$rvvchartheight[3]\"></td>"
      ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$rvv[4] "._LVOTES." ($rvvpercent[4]% "._LTOTALVOTES.")\" src=\"images/blackpixel.png\" width=\"15\" height=\"$rvvchartheight[4]\"></td>"
      ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$rvv[5] "._LVOTES." ($rvvpercent[5]% "._LTOTALVOTES.")\" src=\"images/blackpixel.png\" width=\"15\" height=\"$rvvchartheight[5]\"></td>"
      ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$rvv[6] "._LVOTES." ($rvvpercent[6]% "._LTOTALVOTES.")\" src=\"images/blackpixel.png\" width=\"15\" height=\"$rvvchartheight[6]\"></td>"
      ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$rvv[7] "._LVOTES." ($rvvpercent[7]% "._LTOTALVOTES.")\" src=\"images/blackpixel.png\" width=\"15\" height=\"$rvvchartheight[7]\"></td>"
      ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$rvv[8] "._LVOTES." ($rvvpercent[8]% "._LTOTALVOTES.")\" src=\"images/blackpixel.png\" width=\"15\" height=\"$rvvchartheight[8]\"></td>"
      ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$rvv[9] "._LVOTES." ($rvvpercent[9]% "._LTOTALVOTES.")\" src=\"images/blackpixel.png\" width=\"15\" height=\"$rvvchartheight[9]\"></td>"
      ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$rvv[10] "._LVOTES." ($rvvpercent[10]% "._LTOTALVOTES.")\" src=\"images/blackpixel.png\" width=\"15\" height=\"$rvvchartheight[10]\"></td>"
      ."</tr>"
      ."<tr><td colspan=\"10\" bgcolor=\"$bgcolor2\">"
      ."<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"200\"><tr>"
      ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><span class=\"content\">1</span></td>"
      ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><span class=\"content\">2</span></td>"
      ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><span class=\"content\">3</span></td>"
      ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><span class=\"content\">4</span></td>"
      ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><span class=\"content\">5</span></td>"
      ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><span class=\"content\">6</span></td>"
      ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><span class=\"content\">7</span></td>"
      ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><span class=\"content\">8</span></td>"
      ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><span class=\"content\">9</span></td>"
      ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><span class=\"content\">10</span></td>"
      ."</tr></table>"
      ."</td></tr></table>";
    endif;
    
	echo "</td>"
      ."</tr>"
      ."<tr><td bgcolor=\"$bgcolor2\"><span class=\"content\">"._LINKRATING.": $avgRU</span></td></tr>"
      ."<tr><td bgcolor=\"$bgcolor1\"><span class=\"content\">"._HIGHRATING.": $topreg</span></td></tr>"
      ."<tr><td bgcolor=\"$bgcolor2\"><span class=\"content\">"._LOWRATING.": $bottomreg</span></td></tr>"
      ."<tr><td bgcolor=\"$bgcolor1\"><span class=\"content\">"._NUMOFCOMMENTS.": $truecomments</span></td></tr>"
      ."<tr><td></td></tr>"
      ."<tr><td valign=\"top\" colspan=\"2\"><span class=\"tiny\"><br /><br />"._WEIGHNOTE." $anonweight "._TO." 1.</span></td></tr>"
      ."<tr><td colspan=\"2\" bgcolor=\"$bgcolor2\"><span class=\"content\"><strong>"._UNREGISTEREDUSERS."</strong></span></td></tr>"
      ."<tr><td bgcolor=\"$bgcolor1\"><span class=\"content\">"._NUMBEROFRATINGS.": $anonvotes</span></td>"
      ."<td rowspan=\"5\" width=\"200\">";
    
	if ($anonvotes==0): 
    echo "<center><span class=\"content\">"._NOUNREGUSERSVOTES."</span></center>";
	else: 
        echo "<table border=\"1\" width=\"200\">"
        ."<tr>"
        ."<td valign=\"top\" align=\"center\" colspan=\"10\" bgcolor=\"$bgcolor2\"><span class=\"content\">"._BREAKDOWNBYVAL."</span></td>"
        ."</tr>"
        ."<tr>"
        ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$avv[1] "._LVOTES." ($avvpercent[1]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$avvchartheight[1]\"></td>"
        ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$avv[2] "._LVOTES." ($avvpercent[2]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$avvchartheight[2]\"></td>"
        ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$avv[3] "._LVOTES." ($avvpercent[3]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$avvchartheight[3]\"></td>"
        ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$avv[4] "._LVOTES." ($avvpercent[4]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$avvchartheight[4]\"></td>"
        ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$avv[5] "._LVOTES." ($avvpercent[5]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$avvchartheight[5]\"></td>"
        ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$avv[6] "._LVOTES." ($avvpercent[6]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$avvchartheight[6]\"></td>"
        ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$avv[7] "._LVOTES." ($avvpercent[7]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$avvchartheight[7]\"></td>"
        ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$avv[8] "._LVOTES." ($avvpercent[8]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$avvchartheight[8]\"></td>"
        ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$avv[9] "._LVOTES." ($avvpercent[9]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$avvchartheight[9]\"></td>"
        ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$avv[10] "._LVOTES." ($avvpercent[10]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$avvchartheight[10]\"></td>"
        ."</tr>"
        ."<tr><td colspan=\"10\" bgcolor=\"$bgcolor2\">"
        ."<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"200\"><tr>"
        ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><span class=\"content\">1</span></td>"
        ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><span class=\"content\">2</span></td>"
        ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><span class=\"content\">3</span></td>"
        ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><span class=\"content\">4</span></td>"
        ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><span class=\"content\">5</span></td>"
        ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><span class=\"content\">6</span></td>"
        ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><span class=\"content\">7</span></td>"
        ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><span class=\"content\">8</span></td>"
        ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><span class=\"content\">9</span></td>"
        ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><span class=\"content\">10</span></td>"
        ."</tr></table>"
        ."</td></tr></table>";
    endif;
    
	echo "</td>"
        ."</tr>"
        ."<tr><td bgcolor=\"$bgcolor2\"><span class=\"content\">"._LINKRATING.": $avgAU</span></td></tr>"
        ."<tr><td bgcolor=\"$bgcolor1\"><span class=\"content\">"._HIGHRATING.": $topanon</span></td></tr>"
        ."<tr><td bgcolor=\"$bgcolor2\"><span class=\"content\">"._LOWRATING.": $bottomanon</span></td></tr>"
        ."<tr><td bgcolor=\"$bgcolor1\"><span class=\"content\">&nbsp;</span></td></tr>";
    
	if ($useoutsidevoting == 1): 
	
    echo "<tr><td valign=top colspan=\"2\"><span class=\"tiny\"><br /><br />"._WEIGHOUTNOTE." $outsideweight "._TO." 1.</span></td></tr>"
        ."<tr><td colspan=\"2\" bgcolor=\"$bgcolor2\"><span class=\"content\"><strong>"._OUTSIDEVOTERS."</strong></span></td></tr>"
        ."<tr><td bgcolor=\"$bgcolor1\"><span class=\"content\">"._NUMBEROFRATINGS.": $outsidevotes</span></td>"
        ."<td rowspan=\"5\" width=\"200\">";
    
	    if ($outsidevotes==0): 
        echo "<center><span class=\"content\">"._NOOUTSIDEVOTES."</span></center>";
	   else: 
        echo "<table border=\"1\" width=\"200\">"
          ."<tr>"
          ."<td valign=\"top\" align=\"center\" colspan=\"10\" bgcolor=\"$bgcolor2\"><span class=\"content\">"._BREAKDOWNBYVAL."</span></td>"
          ."</tr>"
          ."<tr>"
          ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$ovv[1] "._LVOTES." ($ovvpercent[1]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$ovvchartheight[1]\"></td>"
          ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$ovv[2] "._LVOTES." ($ovvpercent[2]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$ovvchartheight[2]\"></td>"
          ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$ovv[3] "._LVOTES." ($ovvpercent[3]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$ovvchartheight[3]\"></td>"
          ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$ovv[4] "._LVOTES." ($ovvpercent[4]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$ovvchartheight[4]\"></td>"
          ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$ovv[5] "._LVOTES." ($ovvpercent[5]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$ovvchartheight[5]\"></td>"
          ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$ovv[6] "._LVOTES." ($ovvpercent[6]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$ovvchartheight[6]\"></td>"
          ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$ovv[7] "._LVOTES." ($ovvpercent[7]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$ovvchartheight[7]\"></td>"
          ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$ovv[8] "._LVOTES." ($ovvpercent[8]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$ovvchartheight[8]\"></td>"
          ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$ovv[9] "._LVOTES." ($ovvpercent[9]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$ovvchartheight[9]\"></td>"
          ."<td bgcolor=\"$bgcolor1\" valign=\"bottom\"><img border=\"0\" alt=\"$ovv[10] "._LVOTES." ($ovvpercent[10]% "._LTOTALVOTES.")\" src=\"images/blackpixel.gif\" width=\"15\" height=\"$ovvchartheight[10]\"></td>"
          ."</tr>"
          ."<tr><td colspan=\"10\" bgcolor=\"$bgcolor2\">"
          ."<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"200\"><tr>"
          ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><span class=\"content\">1</span></td>"
          ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><span class=\"content\">2</span></td>"
          ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><span class=\"content\">3</span></td>"
          ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><span class=\"content\">4</span></td>"
          ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><span class=\"content\">5</span></td>"
          ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><span class=\"content\">6</span></td>"
          ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><span class=\"content\">7</span></td>"
          ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><span class=\"content\">8</span></td>"
          ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><span class=\"content\">9</span></td>"
          ."<td width=\"10%\" valign=\"bottom\" align=\"center\"><span class=\"content\">10</span></td>"
          ."</tr></table>"
          ."</td></tr></table>";
      endif;
    
	echo "</td>"
        ."</tr>"
        ."<tr><td bgcolor=\"$bgcolor2\"><span class=\"content\">"._LINKRATING.": $avgOU</span></td></tr>"
        ."<tr><td bgcolor=\"$bgcolor1\"><span class=\"content\">"._HIGHRATING.": $topoutside</span></td></tr>"
        ."<tr><td bgcolor=\"$bgcolor2\"><span class=\"content\">"._LOWRATING.": $bottomoutside</span></td></tr>"
        ."<tr><td bgcolor=\"$bgcolor1\"><span class=\"content\">&nbsp;</span></td></tr>";
    endif;
    
	echo "</table><br /><br /><div align=\"center\">";
    
	linkfooter($lid,$ttitle);
    
	echo "</div>";
    
    # stop using <br /> use a div tag with padding whenever it's possible!
    print '<div align="center" style="padding-top:11px;">'."\n";
    print '</div>'."\n";
	
	CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function linkfooter($lid,$ttitle) 
{
    global $module_name;

    echo "<span class=\"content\"> <i class=\"bi bi-globe2\"></i> <a href=\"modules.php?name=$module_name&amp;l_op=visit&amp;lid=$lid\" target=\"_blank\">"._VISITTHISSITE."</a>&nbsp;&nbsp;<i class=\"bi bi-check-square\"></i> <a href=\"modules.php?name=$module_name&amp;l_op=ratelink&amp;lid=$lid&amp;ttitle=$ttitle\">"._RATETHISSITE."</a> </span><br /><br />";

    linkfooterchild($lid);
}

function linkfooterchild($lid) 
{
    global $module_name;
    include(NUKE_MODULES_DIR.$module_name.'/l_config.php');
    if ($useoutsidevoting = 1) 
    echo "<br /><span class=\"content\">"._ISTHISYOURSITE." <a href=\"modules.php?name=$module_name&amp;l_op=outsidelinksetup&amp;lid=$lid\">"._ALLOWTORATE."</a></span>";
}

function outsidelinksetup($lid) 
{
    global $module_name, $sitename, $nukeurl;
    include_once(NUKE_BASE_DIR.'header.php');
    include(NUKE_MODULES_DIR.$module_name.'/l_config.php');
    menu(1);

    OpenTable();

    # stop using <br /> use a div tag with padding whenever it's possible!
    print '<div align="center" style="padding-top:11px;">'."\n";
    print '</div>'."\n";
    
    echo '<div align="center"><span class="option"><strong><h1>'._PROMOTEYOURSITE.'</h1></strong></span></div><br />';

    echo ''._PROMOTE01.'<br /><br />';
	
	echo '<hr><strong>1) '._TEXTLINK.'</strong><br /><br />';

    echo ''._PROMOTE02.'<br /><br />';
	
	echo '<div align="center"><a href="'.$nukeurl.'/modules.php?name='.$module_name.'&amp;l_op=ratelink&amp;lid='.$lid.'">'._RATETHISSITE.' @ '.$sitename.'</a></div><br />';


    echo '<div align="center">'._HTMLCODE1.'</div><br />';

    echo '<div align="center"><textarea rows="4" cols="50"><a href="'.$nukeurl.'/modules.php?name='.$module_name.'&amp;l_op=ratelink&amp;lid='.$lid.'">'._RATETHISSITE.' @ '.$sitename.'</a></textarea></div><br /><hr>';

    echo '<div align="center">
    <form action="modules.php?name='.$module_name.'" method="post">
    <input type="hidden" name="lid" value="'.$lid.'">
    <input type="hidden" name="l_op" value="ratelink">
    <input type="submit" value="'._RATEIT.'">
    </form>
    </div>';
	
	echo '<center>'._HTMLCODE2.'</center><br /><br />';


    echo '<div align="center"><textarea rows="6" cols="56">
    <form action="modules.php?name='.$module_name.'" method="post">
    <input type="hidden" name="lid" value="'.$lid.'">
    <input type="hidden" name="l_op" value="ratelink">
    <input type="submit" value="'._RATEIT.'">
    </form>
    </div>';
	echo '</textarea></div>';

	
	echo '<hr>';

    echo "<strong>3) "._REMOTEFORM."</strong><br /><br />"; 

    echo '<div align="center">';
    echo '<form method="post" action="'.$nukeurl.'/modules.php?name='.$module_name.'">';
    echo '<div align="center"><table align="center" border="0" width="175" cellspacing="0" cellpadding="0">';
    echo '<tr><td align="center"><strong>'._VOTE4THISSITE.'</strong></a></td></tr>';
    echo '<tr><td>';
 	echo '<div align="center"><table border="0" cellspacing="0" cellpadding="0" align="center">';
    echo '<tr><td valign="top">';
    echo '<select name="rating">';
    echo '<option selected>--</option>';
    echo '<option>10</option>';
    echo '<option>9</option>';
    echo '<option>8</option>';
    echo '<option>7</option>';
    echo '<option>6</option>';
    echo '<option>5</option>';
    echo '<option>4</option>';
    echo '<option>3</option>';
    echo '<option>2</option>';
    echo '<option>1</option>';
    echo '</select>';
    echo '</td><td valign="top">';
    echo '<input type="hidden" name="ratinglid" value="'.$lid.'">';
    echo '<input type="hidden" name="ratinguser" value="outside">';
    echo '<input type="hidden" name="op value="addrating">';
    echo '<input type="submit" value="'._LINKVOTE.'">';
 	echo '</td></tr></table></div>';
 	echo '</td></tr></table></div></form></div>';

    echo '<br />'._HTMLCODE3.'<br /><br />';
 
 
    echo '<div align="center"><textarea rows="16" cols="56">';
    echo '<div align="center">';
    echo '<form method="post" action="'.$nukeurl.'/modules.php?name='.$module_name.'">';
    echo '<div align="center"><table align="center" border="0" width="175" cellspacing="0" cellpadding="0">';
    echo '<tr><td align="center"><strong>'._VOTE4THISSITE.'</strong></a></td></tr>';
    echo '<tr><td>';
 	echo '<div align="center"><table border="0" cellspacing="0" cellpadding="0" align="center">';
    echo '<tr><td valign="top">';
    echo '<select name="rating">';
    echo '<option selected>--</option>';
    echo '<option>10</option>';
    echo '<option>9</option>';
    echo '<option>8</option>';
    echo '<option>7</option>';
    echo '<option>6</option>';
    echo '<option>5</option>';
    echo '<option>4</option>';
    echo '<option>3</option>';
    echo '<option>2</option>';
    echo '<option>1</option>';
    echo '</select>';
    echo '</td><td valign="top">';
    echo '<input type="hidden" name="ratinglid" value="'.$lid.'">';
    echo '<input type="hidden" name="ratinguser" value="outside">';
    echo '<input type="hidden" name="op value="addrating">';
    echo '<input type="submit" value="'._LINKVOTE.'">';
 	echo '</td></tr></table></div>';
 	echo '</td></tr></table></div></form></div>';
	echo '</textarea></div>';
    
	echo '<hr>';
   
    # stop using <br /> use a div tag with padding whenever it's possible!
    print '<div align="center" style="padding-top:11px;">'."\n";
    print '</div>'."\n";
	
	CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function brokenlink($lid) 
{
    global $prefix, $db, $user, $cookie, $module_name;

    if (is_user()): 
    include_once(NUKE_BASE_DIR.'header.php');
    include(NUKE_MODULES_DIR.$module_name.'/l_config.php');
    $ratinguser = $cookie[1];
    menu(1);
    $lid = intval($lid);
    $row = $db->sql_fetchrow($db->sql_query("SELECT `cid`, `title`, `url`, `description` FROM ".$prefix."_links_links WHERE lid='$lid'"));
    $cid = intval($row['cid']);
    $title = stripslashes(check_html($row['title'], "nohtml"));
    $url = stripslashes($row['url']);
    $description = stripslashes($row['description']);

    OpenTable();

    # stop using <br /> use a div tag with padding whenever it's possible!
    print '<div align="center" style="padding-top:11px;">'."\n";
    print '</div>'."\n";

    echo "<div align=\"center\"><span class=\"option\"><strong><h1>"._REPORTBROKEN."</h1></strong></span><br /><span class=\"content\">";
    echo "<form action=\"modules.php?name=$module_name\" method=\"post\">";
    echo "<input type=\"hidden\" name=\"lid\" value=\"$lid\">";
    echo "<input type=\"hidden\" name=\"cid\" value=\"$cid\">";
    echo "<input type=\"hidden\" name=\"title\" value=\"$title\">";
    echo "<input type=\"hidden\" name=\"url\" value=\"$url\">";
    echo "<input type=\"hidden\" name=\"description\" value=\"$description\">";
    echo "<input type=\"hidden\" name=\"modifysubmitter\" value=\"$ratinguser\">";
    echo ""._THANKSBROKEN."<br /><br />";
    echo "<input type=\"hidden\" name=\"l_op\" value=\"brokenlinkS\"><input type=\"submit\" value=\""._REPORTBROKEN."\"></div></form>";

    # stop using <br /> use a div tag with padding whenever it's possible!
    print '<div align="center" style="padding-top:11px;">'."\n";
    print '</div>'."\n";

    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
     
	else: 
    redirect("modules.php?name=$module_name");
	endif;
}

function brokenlinkS($lid,$cid, $title, $url, $description, $modifysubmitter) 
{

    global $prefix, $db, $user, $anonymous, $cookie, $module_name, $user, $cache;

    if (is_user()): 
	
        include(NUKE_MODULES_DIR.$module_name.'/l_config.php');
        $ratinguser = $cookie[1];
        $lid = intval($lid);
        $cid = intval($cid);
        
		$db->sql_query("INSERT INTO ".$prefix."_links_modrequest values (NULL, 
		                                                               '$lid', 
																	   '$cid', 
																	      '0', 
													 '".addslashes($title)."', 
													   '".addslashes($url)."', 
											   '".addslashes($description)."', 
											    '".addslashes($ratinguser)."', 
												                           '1')");
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
        $cache->delete('numbrokenl', 'submissions');
        $cache->delete('nummodreql', 'submissions');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
        include_once(NUKE_BASE_DIR.'header.php');
        menu(1);
        OpenTable();
        
		# stop using <br /> use a div tag with padding whenever it's possible!
        print '<div align="center" style="padding-top:11px;">'."\n";
        print '</div>'."\n";
        
		echo "<br /><div align=\"center\">"._THANKSFORINFO."<br /><br />"._LOOKTOREQUEST."</div><br />";

		# stop using <br /> use a div tag with padding whenever it's possible!
        print '<div align="center" style="padding-top:11px;">'."\n";
        print '</div>'."\n";
        
		CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    else:
        redirect("modules.php?name=$module_name");
    endif;
}

function modifylinkrequest($lid) 
{
    global $prefix, $db, $user, $module_name, $anonymous, $cookie;
    include_once(NUKE_BASE_DIR.'header.php');
    include(NUKE_MODULES_DIR.$module_name.'/l_config.php');

    if(is_user())
    $ratinguser = $cookie[1];
    else 
    $ratinguser = $anonymous;
    
    menu(1);
    OpenTable();

	# stop using <br /> use a div tag with padding whenever it's possible!
    print '<div align="center" style="padding-top:11px;">'."\n";
    print '</div>'."\n";

    $blocknow = 0;
    $lid = intval(trim($lid));

    if ($blockunregmodify == 1 && $ratinguser=="$anonymous"): 
        echo "<div align=\"center\"><h1>"._ONLYREGUSERSMODIFY."</h1></div>";
        $blocknow = 1;
    endif;
    
	if ($blocknow != 1): 
	
        $result = $db->sql_query("SELECT `cid`, `sid`, `title`, `url`, `description` FROM ".$prefix."_links_links WHERE lid='$lid'");
    
	    echo "<div align=\"center\"><span class=\"option\"><strong><h1>"._REQUESTLINKMOD."</h1></strong></span></div><br /><span class=\"content\">";
    
	    while($row = $db->sql_fetchrow($result)): 
		
            $cid = intval($row['cid']);
            $sid = intval($row['sid']);
            $title = stripslashes(check_html($row['title'], "nohtml"));
            $url = stripslashes($row['url']);
            $description = stripslashes($row['description']);
        
		    echo "<form action=\"modules.php?name=$module_name\" method=\"post\">"
            .""._LINKID.": <strong>$lid</strong></center><br /><br />"
            .""._LINKTITLE.":<br /><input type=\"text\" name=\"title\" value=\"$title\" size=\"50\" maxlength=\"100\"><br /><br />"
            .""._URL.":<br /><input type=\"text\" name=\"url\" value=\"$url\" size=\"50\" maxlength=\"100\"><br /><br />"
            .""._DESCRIPTION.": <br /><textarea name=\"description\" cols=\"60\" rows=\"10\">$description</textarea><br /><br />";
        
        echo "<input type=\"hidden\" name=\"lid\" value=\"$lid\">"
        ."<input type=\"hidden\" name=\"modifysubmitter\" value=\"$ratinguser\">"
        .""._CATEGORY.": <select name=\"cat\">";
    
	$result2 = $db->sql_query("SELECT `cid`, `title`, `parentid` FROM ".$prefix."_links_categories ORDER by title");
    
	while($row2 = $db->sql_fetchrow($result2)): 
	
        $cid2 = intval($row2['cid']);
        $ctitle2 = stripslashes(check_html($row2['title'], "nohtml"));
        $parentid2 = intval($row2['parentid']);
    
	    if ($cid2==$cid) 
        $sel = "selected";
		else 
        $sel = "";
        
		if ($parentid2!=0) $ctitle2=weblinks_parent($parentid2,$ctitle2);
        echo "<option value=\"$cid2\" $sel>$ctitle2</option>";
    
	endwhile;
        echo "</select><br /><br />"
        ."<input type=\"hidden\" name=\"l_op\" value=\"modifylinkrequestS\">"
        ."<input type=\"submit\" value=\""._SENDREQUEST."\"></form>";
    endwhile;
		
    endif;

	# stop using <br /> use a div tag with padding whenever it's possible!
    print '<div align="center" style="padding-top:14px;">'."\n";
    print '</div>'."\n";

    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function modifylinkrequestS($lid, $cat, $title, $url, $description, $modifysubmitter) 
{
    global $prefix, $db, $user, $module_name, $cookie, $cache;
    include(NUKE_MODULES_DIR.$module_name.'/l_config.php');

    if(is_user()) 
    $ratinguser = $cookie[1];
    else 
    $ratinguser = $anonymous;
    
    $blocknow = 0;
    
	if ($blockunregmodify == 1 && $ratinguser=="$anonymous"): 
	
    include_once(NUKE_BASE_DIR.'header.php');
    menu(1);

    OpenTable();

	# stop using <br /> use a div tag with padding whenever it's possible!
    print '<div align="center" style="padding-top:11px;">'."\n";
    print '</div>'."\n";

    echo "<div align=\"center\"><span class=\"content\"><h1>"._ONLYREGUSERSMODIFY."</h1></span></div>";
    $blocknow = 1;

	# stop using <br /> use a div tag with padding whenever it's possible!
    print '<div align="center" style="padding-top:11px;">'."\n";
    print '</div>'."\n";

    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
    endif;
	
    if ($blocknow != 1): 
        
		$cat = explode("-", $cat);
        
		if (empty($cat[1]))
        $cat[1] = 0;
        
		$title = stripslashes(check_html($title, "nohtml"));
        $url = stripslashes($url);
        $description = stripslashes($description);
        $lid = intval($lid);
        $cat[0] = intval($cat[0]);
        $cat[1] = intval($cat[1]);
        
		$db->sql_query("INSERT INTO ".$prefix."_links_modrequest values (NULL, 
		                                                               '$lid', 
																	'$cat[0]', 
																	'$cat[1]', 
													 '".addslashes($title)."', 
													   '".addslashes($url)."', 
											   '".addslashes($description)."', 
											    '".addslashes($ratinguser)."', 
												                         0)");
																		 
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
        $cache->delete('numbrokenl', 'submissions');
        $cache->delete('nummodreql', 'submissions');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
 
    include_once(NUKE_BASE_DIR.'header.php');
    menu(1);

    OpenTable();

	# stop using <br /> use a div tag with padding whenever it's possible!
    print '<div align="center" style="padding-top:11px;">'."\n";
    print '</div>'."\n";

    echo "<div align=\"center\"><span class=\"content\"><h1>"._THANKSFORINFO." "._LOOKTOREQUEST."</h1></span></div>";

	# stop using <br /> use a div tag with padding whenever it's possible!
    print '<div align="center" style="padding-top:11px;">'."\n";
    print '</div>'."\n";

    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
    
	endif;
}

function rateinfo($lid) 
{
    global $prefix, $db;
    $lid = intval($lid);
    $db->sql_query("UPDATE ".$prefix."_links_links set hits=hits+1 WHERE lid='$lid'");
    $row = $db->sql_fetchrow($db->sql_query("SELECT url from ".$prefix."_links_links where lid='$lid'"));
    $url = stripslashes($row['url']);
    redirect("$url");
}

function addrating($ratinglid, $ratinguser, $rating, $ratinghost_name, $ratingcomments) 
{
    global $prefix, $db, $cookie, $user, $module_name, $anonymous;
    $passtest = "yes";
    include_once(NUKE_BASE_DIR.'header.php');
    include(NUKE_MODULES_DIR.$module_name.'/l_config.php');
    $ratinglid = intval($ratinglid);
    completevoteheader();

    if(is_user()) 
    $ratinguser = $cookie[1];
    elseif($ratinguser=="outside") 
    $ratinguser = "outside";
    else 
    $ratinguser = $anonymous;
    
    $result = $db->sql_query("SELECT title FROM ".$prefix."_links_links WHERE lid='$ratinglid'");
    
	while ($row = $db->sql_fetchrow($result)):
    $title = stripslashes(check_html($row['title'], "nohtml"));
    $ttitle = $title;
    
	/* Make sure only 1 anonymous from an IP in a single day. */
    $ip = identify::get_ip();
    
	/* Check if Rating is Null */
    if ($rating == "--"):
    $error = "nullerror";
    completevote($error);
    $passtest = "no";
    endif;
	
    /* Check if Link POSTER is voting (UNLESS Anonymous users allowed to post) */
    if ($ratinguser != $anonymous && $ratinguser != "outside"): 
      $result2 = $db->sql_query("SELECT submitter from ".$prefix."_links_links where lid='$ratinglid'");
      while ($row2 = $db->sql_fetchrow($result2)):
      $ratinguserDB = $row2['submitter'];
            if ($ratinguserDB == $ratinguser):
            $error = "postervote";
            completevote($error);
            $passtest = "no";
            endif;
      endwhile;
    endif;
	
    /* Check if REG user is trying to vote twice. */
    if ($ratinguser!=$anonymous && $ratinguser != "outside"): 
	
      $result3 = $db->sql_query("SELECT ratinguser from ".$prefix."_links_votedata where ratinglid='$ratinglid'");
        
		while ($row3 = $db->sql_fetchrow($result3)):
          $ratinguserDB = $row3['ratinguser'];
          if ($ratinguserDB==$ratinguser):
          $error = "regflood";
          completevote($error);
          $passtest = "no";
          endif;
		endwhile;
    endif;
	
    /* Check if ANONYMOUS user is trying to vote more than once per day. */
    if ($ratinguser==$anonymous):
        $yesterdaytimestamp = (time()-(86400 * $anonwaitdays));
        $ytsDB = Date("Y-m-d H:i:s", $yesterdaytimestamp);
    
	    $result4 = $db->sql_query("SELECT * FROM ".$prefix."_links_votedata 
		                                   WHERE ratinglid='$ratinglid' 
										     AND ratinguser='$anonymous' 
											 AND ratinghostname = '$ip' 
											 AND TO_DAYS(NOW()) - TO_DAYS(ratingtimestamp) < '$anonwaitdays'");
											 
        $anonvotecount = $db->sql_numrows($result4);
		
        if ($anonvotecount >= 1):
            $error = "anonflood";
            completevote($error);
            $passtest = "no";
        endif;
    endif;
	
    /* Check if OUTSIDE user is trying to vote more than once per day. */
    if ($ratinguser=="outside"):
	
        $yesterdaytimestamp = (time()-(86400 * $outsidewaitdays));
        $ytsDB = Date("Y-m-d H:i:s", $yesterdaytimestamp);
        
		$result5 = $db->sql_query("SELECT * FROM ".$prefix."_links_votedata 
		                                   WHERE ratinglid='$ratinglid' 
										     AND ratinguser='outside' 
											 AND ratinghostname = '$ip' 
											 AND TO_DAYS(NOW()) - TO_DAYS(ratingtimestamp) < '$outsidewaitdays'");
											 
        $outsidevotecount = $db->sql_numrows($result5);
        
		if ($outsidevotecount >= 1):
            $error = "outsideflood";
            completevote($error);
            $passtest = "no";
        endif;
    endif;
	
    /* Passed Tests */
    if ($passtest == "yes"):
    $ratingcomments = stripslashes(check_html($ratingcomments, 'nohtml'));
    if (!empty($ratingcomments)):
     
	endif;
	
        /* All is well.  Add to Line Item Rate to DB. */
        $ratinglid = intval($ratinglid);
        $rating = intval($rating);
    
	    if ($rating > 10 || $rating < 1):
          redirect("modules.php?name=$module_name&d_op=ratedownload&lid=$ratinglid");
          exit;
        endif;
		
          $db->sql_query("INSERT into ".$prefix."_links_votedata values (NULL,'$ratinglid', '$ratinguser', '$rating', '$ip', '$ratingcomments', now())");
          /* All is well.  Calculate Score & Add to Summary (for quick retrieval & sorting) to DB. */
          /* NOTE: If weight is modified, ALL links need to be refreshed with new weight. */
          /*     Running a SQL statement with your modded calc for ALL links will accomplish this. */
          $voteresult = $db->sql_query("SELECT rating, ratinguser, ratingcomments FROM ".$prefix."_links_votedata WHERE ratinglid = '$ratinglid'");
          $totalvotesDB = $db->sql_numrows($voteresult);
          include(NUKE_MODULES_DIR.$module_name.'/voteinclude.php');
          $lid = intval($lid);
          $db->sql_query("UPDATE ".$prefix."_links_links SET linkratingsummary='$finalrating',totalvotes='$totalvotesDB',totalcomments='$truecomments' WHERE lid = '$ratinglid'");
          $error = "none";
          completevote($error);
        endif;
    endwhile;
	
    completevotefooter($ratinglid, $ttitle, $ratinguser);
    include_once(NUKE_BASE_DIR.'footer.php');
}

function completevoteheader(){
    menu(1);
    OpenTable();

	# stop using <br /> use a div tag with padding whenever it's possible!
    print '<div align="center" style="padding-top:11px;">'."\n";
    print '</div>'."\n";

}

function completevotefooter($lid, $ttitle, $ratinguser) 
{
    global $prefix, $db, $sitename, $module_name;
    
	include(NUKE_MODULES_DIR.$module_name.'/l_config.php');
    
	$lid = intval($lid);
    $row = $db->sql_fetchrow($db->sql_query("SELECT `url` FROM ".$prefix."_links_links WHERE lid='$lid'"));
    $url = stripslashes($row['url']);

    echo "<span class=\"content\">"._THANKSTOTAKETIME." $sitename. "._LETSDECIDE."</span><br /><br /><br />";

    if ($ratinguser=="outside"): 
	    echo "<div align=\"center\"><span class=\"content\">".WEAPPREACIATE." $sitename!<br /><a href=\"$url\">"._RETURNTO." $ttitle</a></span></div><br /><br />";
        $row2 = $db->sql_fetchrow($db->sql_query("SELECT title FROM ".$prefix."_links_links where lid='$lid'"));
        $title = stripslashes(check_html($row2['title'], "nohtml"));
        $ttitle = str_replace (" ", "_", $title);
    endif;
	
    echo "<div align=\"center\">";
    linkinfomenu($lid,$ttitle);
    echo "</div>";
    
    # stop using <br /> use a div tag with padding whenever it's possible!
    print '<div align="center" style="padding-top:11px;">'."\n";
    print '</div>'."\n";

	CloseTable();
}

function completevote($error) 
{
    global $module_name;
    include(NUKE_MODULES_DIR.$module_name.'/l_config.php');
    if ($error == "none") 
	echo "<div align=\"center\"><span class=\"content\"><strong><h1>"._COMPLETEVOTE1."</h1></strong></span></div>";
    if ($error == "anonflood") 
	echo "<div align=\"center\"><span class=\"option\"><strong><h1>"._COMPLETEVOTE2."</h1></strong></span></div><br />";
    if ($error == "regflood") 
	echo "<div align=\"center\"><span class=\"option\"><strong><h1>"._COMPLETEVOTE3."</h1></strong></span></div><br />";
    if ($error == "postervote") 
	echo "<div align=\"center\"><span class=\"option\"><strong><h1>"._COMPLETEVOTE4."</h1></strong></span></div><br />";
    if ($error == "nullerror") 
	echo "<div align=\"center\"><span class=\"option\"><strong><h1>"._COMPLETEVOTE5."</h1></strong></span></div><br />";
    if ($error == "outsideflood") 
	echo "<div align=\"center\"><span class=\"option\"><strong><h1>"._COMPLETEVOTE6."</h1></strong></span></div><br />";
}

function ratelink($lid, $user, $ttitle) 
{
    global $prefix, $cookie, $datetime, $module_name, $identify;
    include_once(NUKE_BASE_DIR.'header.php');
    menu(1);

    OpenTable();

    # stop using <br /> use a div tag with padding whenever it's possible!
    print '<div align="center" style="padding-top:11px;">'."\n";
    print '</div>'."\n";

    $ttitle = htmlentities($ttitle);
    $transfertitle = str_replace ("_", " ", $ttitle);
    $displaytitle = $transfertitle;
    $ip = $identify->get_ip();
    
	echo "<strong><div align=\"center\"><h1><i class=\"bi bi-link\"></i> ".htmlentities($displaytitle)." <i class=\"bi bi-link\"></i></h1></div></strong>"
    ."<ul><span class=\"content\">"
    ."<li>"._RATENOTE1.""
    ."<li>"._RATENOTE2.""
    ."<li>"._RATENOTE3.""
    ."<li>"._RATENOTE4.""
    ."<li>"._RATENOTE5."";
	
    if(is_user()): 
        echo "<li>"._YOUAREREGGED.""
            ."<li>"._FEELFREE2ADD."";
        $auth_name = $cookie[1];
	else: 
        echo "<li>"._YOUARENOTREGGED.""
            ."<li>"._IFYOUWEREREG."";
        $auth_name = $anonymous;
    endif;
    
    echo "</ul>"
        ."<br /><form method=\"post\" action=\"modules.php?name=$module_name\">"
        ."<table border=\"0\" cellpadding=\"1\" cellspacing=\"0\" width=\"100%\">"
        ."<tr><td width=\"25\" nowrap></td>"
        ."<tr><td width=\"25\" nowrap></td><td width=\"550\">"
        ."<input type=\"hidden\" name=\"ratinglid\" value=\"$lid\">"
        ."<input type=\"hidden\" name=\"ratinguser\" value=\"$auth_name\">"
        ."<input type=\"hidden\" name=\"ratinghost_name\" value=\"$ip\">"
        ."<span class=content>"._RATETHISSITE."&nbsp;"
        ."<select name=\"rating\">"
        ."<option>--</option>"
        ."<option>10</option>"
        ."<option>9</option>"
        ."<option>8</option>"
        ."<option>7</option>"
        ."<option>6</option>"
        ."<option>5</option>"
        ."<option>4</option>"
        ."<option>3</option>"
        ."<option>2</option>"
        ."<option>1</option>"
        ."</select></span>"
        ."&nbsp;<span class=\"content\"><input type=\"submit\" value=\""._RATETHISSITE."\"></span>"
        ."<br /><br />";
    
	if(is_user()): 
      echo "<strong>"._SCOMMENTS.":</strong><br /><textarea wrap=\"virtual\" cols=\"50\" rows=\"10\" name=\"ratingcomments\"></textarea>"
          ."<br />"
          ."</span></td>";
	else: 
      echo"<input type=\"hidden\" name=\"ratingcomments\" value=\"\">";
    endif;

    echo "</tr></table></form>";
    
	echo "<div align=\"center\">";
    linkfooterchild($lid);
    echo "</div>";

    # stop using <br /> use a div tag with padding whenever it's possible!
    print '<div align="center" style="padding-top:11px;">'."\n";
    print '</div>'."\n";

    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

if (isset($ratinglid) && isset ($ratinguser) && isset ($rating)) 
$ret = addrating($ratinglid, $ratinguser, $rating, $ratinghost_name, $ratingcomments);

if(!isset($l_op)) 
$l_op = ""; 
if(!isset($min)) 
$min = ""; 
if(!isset($orderby)) 
$orderby = ""; 
if(!isset($show)) 
$show = ""; 
if(!isset($newlinkshowdays)) 
$newlinkshowdays = ""; 
if(!isset($ratenum)) 
$ratenum = ""; 
else 
$ratenum = (int)$ratenum;

if (!isset($ratetype)) 
$ratetype = ""; 
if (!isset($ttitle)) 
$ttitle = ""; 

switch($l_op):
    case "AddLink":
    AddLink();
    break;
    case "NewLinks":
    NewLinks($newlinkshowdays);
    break;
    case "NewLinksDate":
    NewLinksDate($selectdate);
    break;
    case "TopRated":
    TopRated($ratenum, $ratetype);
    break;
    case "MostPopular":
    MostPopular($ratenum, $ratetype);
    break;
    case "RandomLink":
    RandomLink();
    break;
    case "viewlink":
    viewlink($cid, $min, $orderby, $show);
    break;
    case "brokenlink":
    brokenlink($lid);
    break;
    case "modifylinkrequest":
    modifylinkrequest($lid);
    break;
    case "modifylinkrequestS":
    modifylinkrequestS($lid, $cat, $title, $url, $description, $modifysubmitter);
    break;
    case "brokenlinkS":
    brokenlinkS($lid,$cid, $title, $url, $description, $modifysubmitter);
    break;
    case "visit":
    visit($lid);
    break;
    case "Add":
    Add($title, $url, $auth_name, $cat, $description, $email);
    break;
    case "search":
    search($query, $min, $orderby, $show);
    break;
    case "rateinfo":
    rateinfo($lid, $user, $title);
    break;
    case "ratelink":
    ratelink($lid, $user, $ttitle);
    break;
    case "addrating":
    addrating($ratinglid, $ratinguser, $rating, $ratinghost_name, $ratingcomments, $user);
    break;
    case "viewlinkcomments":
    viewlinkcomments($lid, $ttitle);
    break;
    case "outsidelinksetup":
    outsidelinksetup($lid);
    break;
    case "viewlinkeditorial":
    viewlinkeditorial($lid, $ttitle);
    break;
    case "viewlinkdetails":
    viewlinkdetails($lid, $ttitle);
    break;
    default:
    index();
    break;
endswitch;
?>
