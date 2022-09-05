<?php
/*========================================================================================
 PHP-Nuke Titanium: Enhanced PHP-Nuke Web Portal System
 =========================================================================================*/
/*****[CHANGES]****************************************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       09/29/2005
      Theme Management                         v1.0.2       12/14/2005       
	  Page Loading Animation                   v1.0.0       10/09/2009       
 ********************************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

$theme_name = basename(dirname(__FILE__));

/*****[BEGIN]******************************************
 [ Base:    Theme Management                   v1.0.2 ]
 ******************************************************/
include_once(NUKE_THEMES_DIR.$theme_name.'/theme_info.php');
/*****[END]********************************************
 [ Base:    Theme Management                   v1.0.2 ]
 ******************************************************/

/************************************************************/
/* Theme Colors Definition                                  */
/************************************************************/
global $ThemeInfo, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4, $textcolor1, $textcolor2;

$bgcolor1 = $ThemeInfo['bgcolor1'];
$bgcolor2 = $ThemeInfo['bgcolor2'];
$bgcolor3 = $ThemeInfo['bgcolor3'];
$bgcolor4 = $ThemeInfo['bgcolor4'];
$textcolor1 = $ThemeInfo['textcolor1'];
$textcolor2 = $ThemeInfo['textcolor2'];

global $admin_icon_image_height, $admin_icon_table_width, $avatarwidth, $main_blocks_table_width, $blocks_width, $innertitle;

$admin_icon_image_height="100%";
$admin_icon_table_width="10%";
$avatarwidth = "150";
$main_blocks_table_width = "270";
$blocks_width = "195";
$innertitle = "#CC0000";


/*****[BEGIN]******************************************
 [ Base:    Theme Management                   v1.0.2 ]
 ******************************************************/
include_once(NUKE_THEMES_DIR.$theme_name.'/tables.php');
/*****[END]********************************************
 [ Base:    Theme Management                   v1.0.2 ]
 ******************************************************/

/************************************************************/
/* Function FormatStory()                                   */
/************************************************************/
function FormatStory($thetext, $notes, $aid, $informant) {
    global $anonymous;
    if (!empty($notes)) {
        $notes = "<br /><br /><strong>"._NOTE."</strong> <i>$notes</i>\n";
    } else {
        $notes = "";
    }
    if ($aid == $informant) {
        echo "<span class=\"content\" color=\"#505050\">$thetext$notes</span>\n";
    } else {
        if(defined('WRITES')) {
            if(!empty($informant)) {
                if(is_array($informant)) {
                    $boxstuff = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant[0]\">$informant[1]</a> ";
                } else {
                    $boxstuff = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant\">$informant</a> ";
                }
            } else {
                $boxstuff = "$anonymous ";
            }
            $boxstuff .= ""._WRITES." <i>\"$thetext\"</i>$notes\n";
        } else {
            $boxstuff .= "$thetext$notes\n";
        }

        echo "<span class=\"content\" color=\"#505050\">$boxstuff</span>\n";
    }
}
/************************************************************/
/* Function themeheader()                                   */
/************************************************************/
function themeheader() 
{
	global $user, $cookie, $prefix, $sitekey, $db, $name, $banners, $theme_name, $ThemeInfo, $sitename;

    $module_name = main_module();

echo "<body>\n";

echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "<tr>\n";
echo "<td>\n";

echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "<tr>\n";
echo "<td width=\"72\" height=\"34\"><img src=\"themes/".$theme_name."/images/bnr_01.gif\" alt=\"\" width=\"72\" height=\"34\" /></td>\n";
echo "<td width=\"51\"><img src=\"themes/".$theme_name."/images/bnr_02.gif\" alt=\"\" width=\"51\" height=\"34\" /></td>\n";
echo "<td style=\"background-image: url(themes/".$theme_name."/images/bnr_03_tile.gif)\"><img src=\"themes/86it-Chromo/images/spacer.gif\" alt=\"\" width=\"1\" height=\"1\" /></td>\n";
echo "<td width=\"51\"><img src=\"themes/".$theme_name."/images/bnr_04.gif\" alt=\"\" width=\"51\" height=\"34\" /></td>\n";
echo "<td width=\"72\" height=\"34\"><img src=\"themes/".$theme_name."/images/bnr_05.gif\" alt=\"\" width=\"72\" height=\"34\" /></td>\n";
echo "</tr>\n";
echo "</table>\n";

echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "<tr>\n";
echo "<td width=\"61\" height=\"98\"><img src=\"themes/".$theme_name."/images/left_electricity.gif\" alt=\"\" width=\"61\" height=\"98\" /></td>\n";
echo "<td width=\"317\"><img src=\"themes/".$theme_name."/images/bnr_07_logo.jpg\" alt=\"$sitename\" width=\"317\" height=\"98\" /></td>\n";

$ads = ads(0);

if(empty($ads)) 
{
echo "<td style=\"background-image: url(themes/".$theme_name."/images/bnr_08_tile.gif)\"><img src=\"themes/".$theme_name."/images/spacer.gif\" alt=\"\" width=\"1\" height=\"1\" /></td>\n";
} 
else 
{
echo "<td style=\"background-image: url(themes/".$theme_name."/images/bnr_08_tile.gif)\">$ads</td>\n";
}

//echo "<td style=\"background-image: url(themes/86it-Chromo/images/bnr_08_tile.gif)\"><img src=\"themes/86it-Chromo/images/spacer.gif\" alt=\"\" width=\"1\" height=\"1\" /></td>\n";

echo "<td width=\"62\"><img src=\"themes/".$theme_name."/images/bnr_09.gif\" alt=\"\" width=\"62\" height=\"98\" /></td>\n";
echo "<td width=\"61\"><img src=\"themes/".$theme_name."/images/right_electricity.gif\" alt=\"\" width=\"61\" height=\"98\" /></td>\n";
echo "</tr>\n";
echo "</table>\n";

echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "<tr>\n";
echo "<td width=\"72\" height=\"34\"><img src=\"themes/".$theme_name."/images/bnr_11.gif\" alt=\"\" width=\"72\" height=\"34\" /></td>\n";
echo "<td style=\"background-image: url(themes/".$theme_name."/images/bnr_12_tile.gif)\"><img src=\"themes/86it-Chromo/images/spacer.gif\" alt=\"\" width=\"1\" height=\"1\" /></td>\n";
echo "<td width=\"72\"><img src=\"themes/".$theme_name."/images/bnr_13.gif\" alt=\"\" width=\"72\" height=\"34\" /></td>\n";
echo "</tr>\n";
echo "</table>\n";

echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "<tr>\n";
echo "<td width=\"91\" height=\"46\"><img src=\"themes/".$theme_name."/images/bnr_14.jpg\" alt=\"\" width=\"91\" height=\"46\" /></td>\n";
echo "<td style=\"background-image: url(themes/".$theme_name."/images/bnr_14_tile.jpg)\"><img src=\"themes/86it-Chromo/images/spacer.gif\" alt=\"\" width=\"1\" height=\"1\" /></td>\n";
echo "<td width=\"478\">\n";

echo "<object type=\"application/x-shockwave-flash\" data=\"themes/".$theme_name."/images/bnrnav.swf?link1=" . urlencode($ThemeInfo['link1']) . "&amp;link1text=" . urlencode($ThemeInfo['link1text']) . "&amp;link2=" . urlencode($ThemeInfo['link2']) . "&amp;link2text=" . urlencode($ThemeInfo['link2text']) . "&amp;link3=" . urlencode($ThemeInfo['link3']) . "&amp;link3text=" . urlencode($ThemeInfo['link3text']) . "&amp;link4=" . urlencode($ThemeInfo['link4']) . "&amp;link4text=" . urlencode($ThemeInfo['link4text']) . "\" width=\"478\" height=\"46\">\n";
echo "<param name=\"movie\" value=\"themes/86it-Chromo/images/bnrnav.swf?link1=" . urlencode($ThemeInfo['link1']) . "&amp;link1text=" . urlencode($ThemeInfo['link1text']) . "&amp;link2=" . urlencode($ThemeInfo['link2']) . "&amp;link2text=" . urlencode($ThemeInfo['link2text']) . "&amp;link3=" . urlencode($ThemeInfo['link3']) . "&amp;link3text=" . urlencode($ThemeInfo['link3text']) . "&amp;link4=" . urlencode($ThemeInfo['link4']) . "&amp;link4text=" . urlencode($ThemeInfo['link4text']) . "\" />\n";
echo "</object>\n";

echo "</td>\n";
echo "<td style=\"background-image: url(themes/".$theme_name."/images/bnr_14_tile.jpg)\"><img src=\"themes/86it-Chromo/images/spacer.gif\" alt=\"\" width=\"1\" height=\"1\" /></td>\n";
echo "<td width=\"86\"><img src=\"themes/".$theme_name."/images/bnr_17.jpg\" width=\"86\" height=\"46\" alt=\"\" /></td>\n";
echo "</tr>\n";
echo "</table>\n";

echo "</td>\n";
echo "</tr>\n";
echo "</table>\n";


echo "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\">\n";
echo "<tr valign=\"top\">\n";
##################################################################
//width of the side image that makes the left border down the page //

echo "<td style=\"width: 36px; background-image: url(themes/".$theme_name."/images/bord_l.gif)\" valign=\"top\">\n";
echo "<img src=\"themes/".$theme_name."/images/spacer.gif\" width=\"36\" height=\"1\" border=\"0\" alt=\"\" />\n";
echo "</td>\n";
echo "<td valign=\"top\">\n";
##################################################################
if(blocks_visible('left')) 
{
  blocks('left');
  
  global $left_gap;
  
  $left_gap = "10";
  
  echo "</td>\n";
  echo "<td style=\"width: 10px;\" valign =\"top\"><img src=\"themes/".$theme_name."/images/spacer.gif\" alt=\"\" width=\"".$left_gap."\" height=\"1\" border=\"0\" />\n";
  echo "</td>\n";
  echo "<td width=\"100%\">\n";
} 
else 
{
  echo "</td>\n";
  echo " <td style=\"width: 1px;\" valign =\"top\"><img src=\"themes/".$theme_name."/images/spacer.gif\" alt=\"\" width=\"1\" height=\"1\" border=\"0\" /></td>\n";
  echo " <td width=\"100%\">\n";
}
}
/************************************************************/
/* Function themefooter()                                   */
/************************************************************/
function themefooter() 
{
    global $index, $user, $banners, $cookie, $prefix, $dbi, $db, $admin, $adminmail, $total_time, $start_time, $foot1, $foot2, $foot3, $foot4, $nukeurl, $ip, $theme_name, $ThemeInfo;

  global $right_gap;
	
  $right_gap = "9";
   
  if (blocks_visible('right')) 
  {
    echo "</td>\n";
    echo "<td style=\"width: 15px;\" valign=\"top\"><img src=\"themes/".$theme_name."/images/spacer.gif\" alt=\"\" width=\"$right_gap\" height=\"1\" /></td>\n";
    echo "<td style=\"width: 168px;\" valign=\"top\">\n";
    blocks('right');
  }


echo "</td>\n";
echo "<td style=\"width: 36px; background-image: url(themes/".$theme_name."/images/bord_r.gif)\" valign=\"top\"><img src=\"themes/".$theme_name."/images/spacer.gif\" alt=\"\"  width=\"36\" height=\"1\" /></td>\n";
echo "</tr>\n";
echo "</table>\n\n\n";

echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "<tr>\n";
echo "<td><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "<tr>\n";
echo "<td width=\"57\" height=\"17\"><img src=\"themes/".$theme_name."/images/foot_01.gif\" alt=\"\" width=\"57\" height=\"17\" /></td>\n";
echo "<td style=\"background-image: url(themes/".$theme_name."/images/foot_02_tile.gif)\"><img src=\"themes/".$theme_name."/images/spacer.gif\" alt=\"\" width=\"1\" height=\"1\" /></td>\n";
echo "<td width=\"57\" height=\"17\"><img src=\"themes/".$theme_name."/images/foot_03.gif\" alt=\"\" width=\"57\" height=\"17\" /></td>\n";
echo "</tr>\n";
echo "</table>\n";

echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "<tr>\n";
echo "<td width=\"31\" height=\"36\"><img src=\"themes/".$theme_name."/images/foot_04.gif\" alt=\"\" width=\"31\" height=\"36\" /></td>\n";
echo "<td style=\"background-image: url(themes/".$theme_name."/images/foot_05_tile.gif)\"><img src=\"themes/86it-Chromo/images/spacer.gif\" alt=\"\" width=\"1\" height=\"1\" /></td>\n";
echo "<td width=\"31\"><img src=\"themes/".$theme_name."/images/foot_06.gif\" alt=\"\" width=\"31\" height=\"36\" /></td>\n";
echo "</tr>\n";
echo "</table>\n";

echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "<tr>\n";
echo "<td width=\"31\" height=\"16\"><img src=\"themes/".$theme_name."/images/foot_07.gif\" alt=\"\" width=\"31\" height=\"16\" /></td>\n";
echo "<td width=\"190\"><a href=\"http://nuke-titanium.mynetworkedspace.com\" target=\"_blank\"><img src=\"themes/".$theme_name."/images/foot_08_evopower.gif\" alt=\"Powered by PHP-Nuke Titanium\" width=\"190\" height=\"16\" border=\"0\" title=\"PHP-Nuke Titanium site engine\" /></a></td>\n";
echo "<td style=\"background-image: url(themes/".$theme_name."/images/foot_09_tile.gif)\"><img src=\"themes/".$theme_name."/images/spacer.gif\" alt=\"\" width=\"1\" height=\"1\" /></td>\n";
echo "<td width=\"195\"><a href=\"http://theghost.86it.us\" target=\"_blank\"><img src=\"themes/".$theme_name."/images/foot_10_effpower.gif\" alt=\"theme designed by Ernest TheGhost Buffington\" width=\"195\" height=\"16\" border=\"0\" title=\"".$theme_name." theme by Ernest TheGhost Buffington\" /></a></td>\n";
echo "<td width=\"31\"><img src=\"themes/".$theme_name."/images/foot_11.gif\" alt=\"\" width=\"31\" height=\"16\" /></td>\n";
echo "</tr>\n";
echo "</table>\n";

echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "<tr>\n";
echo "<td width=\"31\" height=\"2\"><img src=\"themes/".$theme_name."/images/foot_12.gif\" alt=\"\" width=\"31\" height=\"2\" /></td>\n";
echo "<td style=\"background-image: url(themes/".$theme_name."/images/foot_13_tile.gif)\"><img src=\"themes/".$theme_name."/images/spacer.gif\" alt=\"\" width=\"1\" height=\"1\" /></td>\n";
echo "<td width=\"31\"><img src=\"themes/".$theme_name."/images/foot_14.gif\" alt=\"\" width=\"31\" height=\"2\" /></td>\n";
echo "</tr>\n";
echo "</table>\n";

echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "<tr>\n";
echo "<td width=\"31\" height=\"16\"><img src=\"themes/".$theme_name."/images/foot_15.gif\" alt=\"\" width=\"31\" height=\"16\" /></td>\n";
echo "<td width=\"146\"><img src=\"themes/".$theme_name."/images/foot_16.gif\" alt=\"\" width=\"146\" height=\"16\" /></td>\n";
echo "<td style=\"background-image: url(themes/".$theme_name."/images/foot_17_tile.gif)\"><img src=\"themes/".$theme_name."/images/spacer.gif\" alt=\"\" width=\"1\" height=\"1\" /></td>\n";
echo "<td width=\"31\"><img src=\"themes/".$theme_name."/images/foot_18.gif\" alt=\"\" width=\"31\" height=\"16\" /></td>\n";
echo "</tr>\n";
echo "</table>\n";
echo "</td>\n";
echo "</tr>\n";
echo "</table>";
echo "<div style=\"font-size: xx-small;\" align=\"center\">\n";

// Bottom banner
echo ads(2);
footmsg();
echo "</div>";
}

/************************************************************/
/* Function themeindex()                                    */
/* This function format the stories on the Homepage         */
/************************************************************/
function theme_blog_index ($aid, $informant, $time, $title, $counter, $topic, $thetext, $notes, $swf, $suspect, $morelink, $topicname, $topicimage, $topictext) 
{
  global $anonymous, $tipath, $theme_name, $sid, $domain, $rating, $name;

    $ThemeSel = get_theme();
/**********************************************************************************************************************************************************/   
   //facbook fix
    $name="Blogs";
	
    //facbook fix
/**********************************************************************************************************************************************************/   
	if(!empty($topicimage)) { if (file_exists("themes/$ThemeSel/images/topics/$topicimage")){ $t_image = "themes/$ThemeSel/images/topics/$topicimage";}
	else 
	{$t_image = "$tipath$topicimage";}$topic_img = "<a href=\"modules.php?name=".$name."&amp;new_topic=".$topic."\"><img src=\"".$t_image."\" border=\"0\" alt=\"$topictext\" /></a>";} 
	else {$topic_img = "";}
	
	if (!empty($notes)){$notes = "<br /><br /><strong>"._NOTE."</strong> $notes\n";}else{$notes = "";}
/**********************************************************************************************************************************************************/   
	//TheGhost added Mug Shot/Art work
    if ($suspect =='none.gif')
	{
		$suspect = "<center><img src=\"http://".$domain."/upload/upu/files/none.gif\" width=0 height=0></center><hr>\n";
	}
	else
	{
	  if($name == "Music")
	  $suspect = "<center><NO RESIZE><img src=\"http://".$domain."/upload/upu/files/$suspect\"></NO RESIZE></center><hr>\n";
	  else
	  if($name == "Blogs")
	  $suspect = "<hr><center><NO RESIZE><img src=\"http://".$domain."/upload/upu/files/$suspect\"></NO RESIZE></center><hr>\n";
	  else
	  $suspect = "<center><NO RESIZE><img src=\"http://".$domain."/upload/upu/files/$suspect\"></NO RESIZE></center>\n";
	}
/**********************************************************************************************************************************************************/   
	$content = '';

    if ($aid == $informant){$content = "$thetext$notes\n";}
	else{if(defined('WRITES')){if(!empty($informant)){if(is_array($informant)){$content = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant[0]\">$informant[1]</a> ";}else{$content = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant\">$informant</a> ";}}else{$content = "$anonymous ";}$content .= _WRITES." \"$thetext\"$notes\n";}else{$content .= "$thetext$notes\n";}}
/**********************************************************************************************************************************************************/   
    $posted = _POSTEDBY." ";
    $posted .= get_author($aid);
    $posted .= " "._ON." $time  ";
    $datetime = substr($morelink, 0, strpos($morelink, "|") - strlen($morelink));
    $morelink = substr($morelink, strlen($datetime) + 2);
	
	/* <?=$theme_name?> */
/**********************************************************************************************************************************************************/   
    global $sitename, $pagetitle;
	$pagetitle = $sitename." » ".$name;
	OpenTableModule();  
	?>
    <b>[ Topic</b> &raquo; <a href="modules.php?name=<?=$name?>&amp;new_topic=<?=$topic?>"><font color="#CC0000"><?=$topictext?></font></a> <b>] [ Subject</b> &raquo; <font color="#CC0000"><?=$title?> </font><b>]</b>
    <?php
	 if($name == "Blogs")
	 {
	   
       ?>
       <?=$suspect?>
       	
       <?=$content?>
       <?=$posted?>
       <br />
       <hr>
       <?
	 }
    if (($name == 'Music') or ($op == 'EditMusic'))
	echo "<br /><hr>";
	?>    
<?
/**********************************************************************************************************************************************************/   
if ($swf == "none.swf")
{
   if (($name == 'Music') or ($op == 'EditMusic'))
   {	
   
   ?>
   <?=$suspect?>
   <br />
   <center><?=$content?></center>
   <br />
   <center><?=$posted?></center>
   <br />
   <hr>
   <?
   }
}
else
{
  global $name, $op;
		
if (($name == 'Music') or ($name == 'Blogs') or ($op == 'EditMusic')) 
{
	get_author($aid);

if ($loadflv == 1)
{

	
?>

<br />
<center>
<script type='text/javascript' src='http://upload.86it.us/js/jwplayer.js'></script>
 
<div id='mediaspace'>This text will be replaced</div>
 
<script type='text/javascript'>
<!--\n
jwplayer('mediaspace').setup({
'flashplayer': 'http://upload.86it.us/players/player.swf',
'file': 'http://upload.86it.us/users/<?=$aid?>/<?=$swf?>',
'image': 'http://upload.86it.us/users/<?=$aid?>/<?=$swf?>.png',
'controlbar': 'bottom',
'width': '640',
'height': '480'
});
//-->
</script>      
</center>
<br />
<hr>
<center><?=$content?></center>
<br />
<center><?=$posted?></center>
<br />
<hr>
<?
}
else
{
echo "<br />";
echo "<center>";

 $newswf = new swfheader(false) ;
 $newswf->loadswf("upload/upu/files/$swf") ;
 $newswf->display($trans);  

echo "</center>";
echo "<br />";
echo "<hr>";

?>

<center><?=$content?></center>
<br />
<center><?=$posted?></center>
<br />
<hr>
<?
 
}

}
else
if (($name == 'Blogs') or ($op == 'EditNews'))
{

	
}
else
{
  echo "<hr /><center>";

  $newswf = new swfheader(false) ;
  $newswf->loadswf("upload/upu/files/$swf") ;
  $newswf->display($trans);  

  echo "<br /><br />";
  echo "If the above Flash Paper is not visible, please update the site cache</span> <a class=\"underline\" href=\"javascript:clear_cache.submit()\">" . _UPDATECACHE . "</a>";
	   
  echo "</center>";
  echo"<hr />";
}        

}
/**********************************************************************************************************************************************************/   

global $facebook_plugin_width;
?>
<center>
      <div class="fb-like" data-href="<?=$domain?>/modules.php?name=<?=$name?>&file=article&sid=<?=$sid?>&mode=0&thold=-1" ref="<?=$domain?>" data-action="like" send="true" width="<?=$facebook_plugin_width?>" show_faces="true" font="verdana"></div>
<br /><br />
<div class="fb-comments" data-href="<?=$domain?>/modules.php?name=<?=$name?>&file=article&sid=<?=$sid?>&mode=0&thold=-1" ref="<?=$domain?>" data-num-posts="5" data-width="<?=$facebook_plugin_width?>">
</div>
</center>
<hr>
<?=$datetime?> <?=$topictext?> | <?=$morelink?>

<?
CloseTable();
echo "<br />";
}

/************************************************************/
/* Function themearticle()                                  */
/************************************************************/
function theme_blog_article ($aid, $informant, $datetime, $title, $thetext, $topic, $topicname, $topicimage, $topictext, $swf, $suspect) 
{
    global $admin, $sid, $tipath, $theme_name, $domain, $name, $fb_title;

/**********************************************************************************************************************************************************/   
    $ThemeSel = get_theme();
/**********************************************************************************************************************************************************/       
	$posted = _POSTEDON." $datetime "._BY." ";
    $posted .= get_author($aid);
/**********************************************************************************************************************************************************/      
   //facbook fix
    if ($name == "Music")
    $name="Music";
    else
    $name="Blogs";
    //facbook fix
/**********************************************************************************************************************************************************/   	
	if(!empty($topicimage)) {
        if (file_exists("themes/$ThemeSel/images/topics/$topicimage")) {
            $t_image = "themes/$ThemeSel/images/topics/$topicimage";
        } else {
            $t_image = "$tipath$topicimage";
        }
        $topic_img = "<a href=\"modules.php?name=".$name."&amp;new_topic=".$topic."\"><img src=\"".$t_image."\" border=\"0\" alt=\"$topictext\" /></a>";
    } else {
        $topic_img = "";
    }
/**********************************************************************************************************************************************************/   	
	if (!empty($notes)) 
	{
        $notes = "<br /><br /><strong>"._NOTE."</strong> <i>$notes</i>\n";
    } 
	else 
	{
        $notes = '';
    }
/**********************************************************************************************************************************************************/       
	//Mug Shot
    if ( isset($_POST['file1']['filename']) && !empty($_POST['file1']['filename']) )  
    {
       $suspect = $_POST['file1']['filename'];
    } 

/**********************************************************************************************************************************************************/   
	//TheGhost added Mug Shot/Art work
    if ($suspect =='none.gif')
	{
		if($name == "Music")
		$suspect = "<center><img src=\"http://".$domain."/upload/upu/files/none.gif\" width=0 height=0></center>\n";
		else
		$suspect = "<center><img src=\"http://".$domain."/upload/upu/files/none.gif\" width=0 height=0></center><hr>\n";
	}
	else
	{
	  if($name == "Music")
	  $suspect = "<center><NO RESIZE><img src=\"http://".$domain."/upload/upu/files/$suspect\"></NO RESIZE></center><hr>\n";
	  else
	  if($name == "Blogs")
	  $suspect = "<hr><center><NO RESIZE><img src=\"http://".$domain."/upload/upu/files/$suspect\"></NO RESIZE></center><hr>\n";
	  else
	  $suspect = "<center><NO RESIZE><img src=\"http://".$domain."/upload/upu/files/$suspect\"></NO RESIZE></center>\n";
	}
/**********************************************************************************************************************************************************/   	
    if ( isset($_POST['file2']['filename']) && !empty($_POST['file2']['filename']) )  
    {
       $swf = $_POST['file2']['filename'];
    } 
    else 
    {
      $swf = Fix_Quotes($swf);
    }
/**********************************************************************************************************************************************************/   
    $content = '';
/**********************************************************************************************************************************************************/   
    if ($aid == $informant) 
	{
        $content = "$thetext$notes\n";
    } 
	else 
	{
		if(defined('WRITES')) 
		{
            if(!empty($informant)) 
			{
                if(is_array($informant)) 
				{
                    $content = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant[0]\">$informant[1]</a> ";
                } 
				else 
				{
                    $content = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant\">$informant</a> ";
                }
            } 
			else 
			{
                $content = "$anonymous ";
            }
            
			$content .= ""._WRITES." <i>\"$thetext\"</i>$notes\n";
        } 
		else 
		{
            $content .= "$thetext$notes\n";
        }
    }
/**********************************************************************************************************************************************************/   	
    global $sitename, $pagetitle;
	$pagetitle = $sitename." » ".$name;    
	OpenTableModule();
    ?>
    <b>[ Topic</b> &raquo; <a href="modules.php?name=<?=$name?>&amp;new_topic=<?=$topic?>"><font color="#CC0000"><?=$topictext?></font></a> <b>] [ Subject</b> &raquo; <font color="#CC0000"><?=$title?> </font><b>]</b>
    <?php
	 if($name == "Blogs")
	 {
	   
       ?>
       <?=$suspect?>
       	
       <?=$content?>
       <?=$posted?>
       <br />
       <hr>
       <?
	 }
    if (($name == 'Music') or ($op == 'EditMusic'))
	echo "<br /><hr>";
	?>    
<?
/**********************************************************************************************************************************************************/   
if ($swf == "none.swf")
{
   if (($name == 'Music') or ($op == 'EditMusic'))
   {	
   
   ?>
   <?=$suspect?>
   <br />
   <center><?=$content?></center>
   <br />
   <center><?=$posted?></center>
   <br />
   <hr>
   <?
   }
}
else
{
  global $name, $op;
		
if (($name == 'Music') or ($name == 'Blogs') or ($op == 'EditMusic')) 
{
	get_author($aid);

if ($loadflv == 1)
{

	
?>

<br />
<center>
<script type='text/javascript' src='http://upload.86it.us/js/jwplayer.js'></script>
 
<div id='mediaspace'>This text will be replaced</div>
 
<script type='text/javascript'>
<!--\n
jwplayer('mediaspace').setup({
'flashplayer': 'http://upload.86it.us/players/player.swf',
'file': 'http://upload.86it.us/users/<?=$aid?>/<?=$swf?>',
'image': 'http://upload.86it.us/users/<?=$aid?>/<?=$swf?>.png',
'controlbar': 'bottom',
'width': '640',
'height': '480'
});
//-->
</script>      
</center>
<br />
<hr>
<center><?=$content?></center>
<br />
<center><?=$posted?></center>
<br />
<hr>
<?
}
else
{
echo "<br />";
echo "<center>";

 $newswf = new swfheader(false) ;
 $newswf->loadswf("upload/upu/files/$swf") ;
 $newswf->display($trans);  

echo "</center>";
echo "<br />";
echo "<hr>";

?>

<center><?=$content?></center>
<br />
<center><?=$posted?></center>
<br />
<hr>
<?
 
}
}
else
if (($name == 'Blogs') or ($op == 'EditNews'))
{

	
}
else
{
  echo "<hr /><center>";

  $newswf = new swfheader(false) ;
  $newswf->loadswf("upload/upu/files/$swf") ;
  $newswf->display($trans);  

  echo "<br /><br />";
  echo "If the above Flash Paper is not visible, please update the site cache</span> <a class=\"underline\" href=\"javascript:clear_cache.submit()\">" . _UPDATECACHE . "</a>";
	   
  echo "</center>";
  echo"<hr />";
}        

}
/**********************************************************************************************************************************************************/   
global $facebook_plugin_width;
?>
<center>
      <div class="fb-like" data-href="<?=$domain?>/modules.php?name=<?=$name?>&file=article&sid=<?=$sid?>&mode=0&thold=-1" ref="<?=$domain?>" data-action="like" send="true" width="<?=$facebook_plugin_width?>" show_faces="true" font="verdana"></div>
<br /><br />
<div class="fb-comments" data-href="<?=$domain?>/modules.php?name=<?=$name?>&file=article&sid=<?=$sid?>&mode=0&thold=-1" ref="<?=$domain?>" data-num-posts="5" data-width="<?=$facebook_plugin_width?>">
</div>
</center>
<hr>
<?=$datetime?> <?=$topictext?> | <?=$morelink?>

<?
CloseTable();
echo "<br />";
}
###
###
###
/************************************************************/
/* Function theme_music_index()                             */
/* This function format the stories on the Homepage         */
/************************************************************/
function theme_music_index ($aid, $informant, $time, $title, $counter, $topic, $thetext, $notes, $swf, $suspect, $morelink, $topicname, $topicimage, $topictext) 
{
    global $anonymous, $tipath, $theme_name, $sid, $domain, $rating, $name;
    
	OpenTable();
    
	$ThemeSel = get_theme();
/**********************************************************************************************************************************************************/   
    $name="Music";
/**********************************************************************************************************************************************************/   
	if(!empty($topicimage)) { if (file_exists("themes/$ThemeSel/images/topics/$topicimage")){ $t_image = "themes/$ThemeSel/images/topics/$topicimage";}
	else {$t_image = "$tipath$topicimage";}
	$topic_img = "<a href=\"modules.php?name=".$name."&amp;new_topic=".$topic."\"><img src=\"".$t_image."\" border=\"0\" alt=\"$topictext\" /></a>";} 
	else {$topic_img = "";}	if (!empty($notes)){$notes = "<br /><br /><strong>"._NOTE."</strong> $notes\n";}else{$notes = "";}
/**********************************************************************************************************************************************************/   
    if ($suspect =='none.gif')
	$suspect = "<center><img src=\"http://".$domain."/upload/upu/files/none.gif\" width=0 height=0></center>\n";
	else
    $suspect = "<center><NO RESIZE><img src=\"http://".$domain."/upload/upu/files/$suspect\"></NO RESIZE></center><hr>\n";
/**********************************************************************************************************************************************************/   
	$content = '';
/**********************************************************************************************************************************************************/   
    if ($aid == $informant){$content = "$thetext$notes\n";}else{if(defined('WRITES')){if(!empty($informant)){if(is_array($informant)){
	$content = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant[0]\">$informant[1]</a> ";}
	else{$content = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant\">$informant</a> ";}}
	else{$content = "$anonymous ";}$content .= _WRITES." \"$thetext\"$notes\n";}else{$content .= "$thetext$notes\n";}}
/**********************************************************************************************************************************************************/   
    $posted = _POSTEDBY." ";
    $posted .= get_author($aid);
    $posted .= " "._ON." $time  ";
    $datetime = substr($morelink, 0, strpos($morelink, "|") - strlen($morelink));
    $morelink = substr($morelink, strlen($datetime) + 2);
/**********************************************************************************************************************************************************/   
?>  
    <b>[ Topic</b> &raquo; <a href="modules.php?name=<?=$name?>&amp;new_topic=<?=$topic?>"><font color="#CC0000"><?=$topictext?></font></a> <b>] [ Subject</b> &raquo; <font color="#CC0000"><?=$title?> </font><b>]</b>
    <?php
	echo "<br /><hr>";
	?>    
<?
/**********************************************************************************************************************************************************/   
if ($swf == "none.swf")
{
   if (($name == 'Music') or ($op == 'EditMusic'))
   {	
   
   ?>
   <?=$suspect?>
   <br />
   <center><?=$content?></center>
   <br />
   <center><?=$posted?></center>
   <br />
   <hr>
   <?
   }
}
else
{
?>

<br />
<center>
<script type='text/javascript' src='js/jwplayer.js'></script>
 
<div id='mediaspace'>This text will be replaced</div>
 
<script type='text/javascript'>
<!--\n
jwplayer('mediaspace').setup({
'flashplayer': 'players-local/player.swf',
'file': 'http://upload.86it.us/user/<?=$aid?>/<?=$swf?>',
'image': 'http://upload.86it.us/user/<?=$aid?>/<?=$swf?>.png',
'controlbar': 'bottom',
'width': '640',
'height': '480'
});
//-->
</script>      
</center>

<br />
<hr>
<center><?=$content?></center>
<br />
<center><?=$posted?></center>
<br />
<hr>
<?
}
/**********************************************************************************************************************************************************/   
global $facebook_plugin_width;
?>
<center>
      <div class="fb-like" data-href="http://music.86it.us/modules.php?name=<?=$name?>&file=article&sid=<?=$sid?>&mode=0&thold=-1" ref="<?=$domain?>" data-action="like" send="true" width="<?=$facebook_plugin_width?>" show_faces="true" font="verdana"></div>
<br /><br />
<div class="fb-comments" data-href="http://music.86it.us/modules.php?name=<?=$name?>&file=article&sid=<?=$sid?>&mode=0&thold=-1" ref="<?=$domain?>" data-num-posts="5" data-width="<?=$facebook_plugin_width?>">
</div>
</center>
<hr>
<b><?=$datetime?>) (<?=$title?> <?=$morelink?> <font color="#000000" size="2" face="Tahoma, Verdana, "myriad web", syntax, sans-serif">| This has been read <font color="#C00000"><b><?=$counter?></b></font> times.)</font></b>
<?
CloseTable();
echo "<br />";
}




/************************************************************/
/* Function theme_music_article()                           */
/************************************************************/
function theme_music_article ($aid, $informant, $datetime, $title, $thetext, $topic, $topicname, $topicimage, $topictext, $swf, $suspect) 
{
    global $admin, $sid, $tipath, $theme_name, $domain, $name, $fb_title;
/**********************************************************************************************************************************************************/   
    OpenTable();
/**********************************************************************************************************************************************************/   
    $ThemeSel = get_theme();
/**********************************************************************************************************************************************************/       
	$posted = _POSTEDON." $datetime "._BY." ";
    $posted .= get_author($aid);
/**********************************************************************************************************************************************************/      
    $name="Music";
/**********************************************************************************************************************************************************/   	
	if(!empty($topicimage)) {
        if (file_exists("themes/$ThemeSel/images/topics/$topicimage")) {
            $t_image = "themes/$ThemeSel/images/topics/$topicimage";
        } else {
            $t_image = "$tipath$topicimage";
        }
        $topic_img = "<a href=\"modules.php?name=".$name."&amp;new_topic=".$topic."\"><img src=\"".$t_image."\" border=\"0\" alt=\"$topictext\" /></a>";
    } else {
        $topic_img = "";
    }
/**********************************************************************************************************************************************************/   	
	if (!empty($notes))	{ $notes = "<br /><br /><strong>"._NOTE."</strong> <i>$notes</i>\n"; } else { $notes = ''; }
/**********************************************************************************************************************************************************/       
    if ( isset($_POST['file1']['filename']) && !empty($_POST['file1']['filename']) )  
    {
       $suspect = $_POST['file1']['filename'];
    } 
/**********************************************************************************************************************************************************/   
    if ($suspect =='none.gif')
	$suspect = "<center><img src=\"http://".$domain."/upload/upu/files/none.gif\" width=0 height=0></center>\n";
	else
    $suspect = "<center><NO RESIZE><img src=\"http://".$domain."/upload/upu/files/$suspect\"></NO RESIZE></center><hr>\n";
/**********************************************************************************************************************************************************/   	
    if ( isset($_POST['file2']['filename']) && !empty($_POST['file2']['filename']) )  
    {
       $swf = $_POST['file2']['filename'];
    } 
    else 
    {
      $swf = Fix_Quotes($swf);
    }
/**********************************************************************************************************************************************************/   
    $content = '';
/**********************************************************************************************************************************************************/   
    if ($aid == $informant) { $content = "$thetext$notes\n"; } else { if(defined('WRITES')) { if(!empty($informant)) {
    if(is_array($informant)) { $content = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant[0]\">$informant[1]</a> "; } 
	else { $content = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant\">$informant</a> "; }} else { $content = "$anonymous "; }
    $content .= ""._WRITES." <i>\"$thetext\"</i>$notes\n"; } else { $content .= "$thetext$notes\n"; }}
/**********************************************************************************************************************************************************/   	
	?>  
    <b>[ Topic</b> &raquo; <a href="modules.php?name=<?=$name?>&amp;new_topic=<?=$topic?>"><font color="#CC0000"><?=$topictext?></font></a> <b>] [ Subject</b> &raquo; <font color="#CC0000"><?=$title?> </font><b>]</b>
    <?php
	echo "<br /><hr>";
	?>    
<?
/**********************************************************************************************************************************************************/   
if ($swf == "none.swf")
{
?>
   <?=$suspect?>
   <br />
   <center><?=$content?></center>
   <br />
   <center><?=$posted?></center>
   <br />
   <hr>
   <?
}
else
{
?>
<br />
<center>
<script type='text/javascript' src='js/jwplayer.js'></script>
 
<div id='mediaspace'>This text will be replaced</div>
 
<script type='text/javascript'>
<!--\n
jwplayer('mediaspace').setup({
'flashplayer': 'players-local/player.swf',
'file': 'http://upload.86it.us/user/<?=$aid?>/<?=$swf?>',
'image': 'http://upload.86it.us/user/<?=$aid?>/<?=$swf?>.png',
'controlbar': 'bottom',
'width': '640',
'height': '480'
});
//-->
</script>      
</center>

<br />
<hr>
<center><?=$content?></center>
<br />
<center><?=$posted?></center>
<br />
<hr>
<?
}
/**********************************************************************************************************************************************************/   
global $facebook_plugin_width;
?>
<center>
      <div class="fb-like" data-href="http://music.86it.us/modules.php?name=<?=$name?>&file=article&sid=<?=$sid?>&mode=0&thold=-1" ref="<?=$domain?>" data-action="like" send="true" width="<?=$facebook_plugin_width?>" show_faces="true" font="verdana"></div>
<br /><br />
<div class="fb-comments" data-href="http://music.86it.us/modules.php?name=<?=$name?>&file=article&sid=<?=$sid?>&mode=0&thold=-1" ref="<?=$domain?>" data-num-posts="5" data-width="<?=$facebook_plugin_width?>">
</div>
</center>
<hr>
<?
CloseTable();
echo "<br />";
}

function themecenterbox($title, $content) {
    OpenTable();
    echo '<center><span class="option"><strong>'.$title.'</strong></span></center><br />'.$content;
    CloseTable();
    echo '<br />';
}

function themepreview($title, $hometext, $bodytext='', $notes='') {
    echo '<strong>'.$title.'</strong><br /><br />'.$hometext;
    if (!empty($bodytext)) {
        echo '<br /><br />'.$bodytext;
    }
    if (!empty($notes)) {
        echo '<br /><br /><strong>'._NOTE.'</strong> <i>'.$notes.'</i>';
    }
}
/************************************************************/
/* Function themesidebox()                                  */
/************************************************************/
function themesidebox($title, $content, $bid=0) 
{
   global $theme_name;

?>
<table width="249" border="0" cellspacing="0" cellpadding="0">
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="57" height="47"><img src="themes/86it-Chromo/images/new_01.gif" alt="" width="57" height="47" /></td>
<td style="background-image: url(themes/86it-Chromo/images/new_02_tile.gif)" align="center"><img src="themes/86it-Chromo/images/spacer.gif" alt="" width="1" height="1" /><div class="typeface-js" style="font-family: Helvetiker"><span class="style1"><b><?=$title?></b></span></div></td>
<td width="57" height="47"><img src="themes/86it-Chromo/images/new_03.gif" alt="" width="57" height="47" /></td>
</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="10" style="background-image: url(themes/86it-Chromo/images/new_04_bl.gif)"><img src="themes/86it-Chromo/images/spacer.gif" alt="" width="1" height="1" /></td>
<td style="background-color: #E6E6E6;">

<?=$content?>

</td>
<td width="10" style="background-image: url(themes/86it-Chromo/images/new_05_br.gif)"><img src="themes/86it-Chromo/images/spacer.gif" alt="" width="1" height="1" /></td>
</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="57" height="38"><img src="themes/86it-Chromo/images/new_06.gif" alt="" width="57" height="38" /></td>
<td style="background-image: url(themes/86it-Chromo/images/new_07_tile.gif)"><img src="themes/86it-Chromo/images/spacer.gif" alt="" width="1" height="1" /></td>
<td width="57"><img src="themes/86it-Chromo/images/new_08.gif" alt="" width="57" height="38" /></td>
</tr>
</table>
</td>
</tr>
</table><br />
<?
}

?>