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
function FormatStory($thetext, $notes, $swf, $suspect,  $aid, $informant) 
{
    global $anonymous, $domain;

	if (!empty($notes)){$notes = "<br /><br /><strong>"._NOTE."</strong> <i>$notes</i>\n";} 
	else{$notes = "";}
    
	//Theghost added Mug Shot for the MyNetworkSpace Network
    if ($suspect =='none.png'){ $suspect = "<hr /><NO RESIZE><img src=\"http://".$domain."/images/stories/$suspect\ width=\"1\" height=\"1\"></NO RESIZE>\n";}
	else{$suspect = "<hr /><NO RESIZE><img src=\"http://".$domain."/images/stories/".$suspect."\"></NO RESIZE><hr />\n";}
    
	if ($aid == $informant) 
	{
        echo "<span class=\"content\" color=\"#505050\">$thetext$notes</span>\n";
    } 
	else 
	{
        if(defined('WRITES')) 
		{
            if(!empty($informant)) 
			{
                if(is_array($informant)) 
				{
                    $boxstuff = "<a href=\"http://".$domain."/modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant[0]\">$informant[1]</a> ";
                } 
				else 
				{
                    $boxstuff = "<a href=\"http://".$domain."/modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant\">$informant</a> ";
                }
            } 
			else 
			{
                $boxstuff = "$anonymous ";
            }
            
			$boxstuff .= ""._WRITES." <i>\"$thetext\"</i>$notes\n";
        } 
		else 
		{
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
	echo "<meta name=\"header-start\">";
	global $ThemeSel, $domain, $screen_res, $user, $cookie, $prefix, $sitekey, $db, $name, $banners, $file_extension, $op;
/**********************************************************************************************************************************/	
    echo "<body style=\"background-color:cecece\" topmargin=\"0\" leftmargin=\"0\" marginwidth=\"0\" marginheight=\"0\">\n";

    $module_name = main_module();
    if (($name == Music) or ($name == Music_Archive) 
	                     or ($name == Music_Search) 
						 or ($name == Music_Submit) 
						 or ($name == Music_Top) 
						 or ($name == Music_Topics)
						 or ($name == Music_Topics_Extended)  
						 or ($module_name == Music))
    { 
##################################################################################################
    if (@file_exists(NUKE_THEMES_DIR.$ThemeSel.'/includes/javascript_body_music_facebook.php'))  #
	{                                                                                            #     Added by Ernest Buffington
       require_once(NUKE_THEMES_DIR.$ThemeSel.'/includes/javascript_body_music_facebook.php');   ##### facebook Mod v1.0
    }                                                                                            #     Oct 10th 2012
##################################################################################################	
}
else
{
############################################################################################
    if (@file_exists(NUKE_THEMES_DIR.$ThemeSel.'/includes/javascript_body_facebook.php'))  #
	{                                                                                      #     Added by Ernest Buffington
       require_once(NUKE_THEMES_DIR.$ThemeSel.'/includes/javascript_body_facebook.php');   ##### facebook Mod v1.0
    }                                                                                      #     Oct 10th 2012
############################################################################################	
}


############################################################################
if (@file_exists(NUKE_THEMES_DIR.$ThemeSel.'/classes/class.swfheader.php'))#      Added by Ernest Buffington
{                                                                          ###### Load SWF class - used for automaticly displaying *.swf 
  include(NUKE_THEMES_DIR.$ThemeSel.'/classes/class.swfheader.php');       #      Jan 1st 2012 
}                                                                          #
############################################################################


    echo "<table width=100% border=0 cellpadding=0 cellspacing=0>\n";
    echo "<tr>\n";
    echo "<td><img src=\"themes/".$ThemeSel."/header/spacer.png\" width=20 height=1></td>\n";
    echo "<td><img src=\"themes/".$ThemeSel."/header/spacer.png\" width=231 height=1></td>\n";
    echo "<td><img src=\"themes/".$ThemeSel."/header/spacer.png\" width=19 height=1></td>\n";
    echo "<td><img src=\"themes/".$ThemeSel."/header/spacer.png\" width=16 height=1></td>\n";
    echo "<td><img src=\"themes/".$ThemeSel."/header/spacer.png\" width=179 height=1></td>\n";
    echo "<td><img src=\"themes/".$ThemeSel."/header/spacer.png\" width=43 height=1></td>\n";
    echo "<td><img src=\"themes/".$ThemeSel."/header/spacer.png\" width=24 height=1></td>\n";
    echo "<td><img src=\"themes/".$ThemeSel."/header/spacer.png\" width=145 height=1></td>\n";
    echo "<td><img src=\"themes/".$ThemeSel."/header/spacer.png\" width=73 height=1></td>\n";
    echo "<td><img src=\"themes/".$ThemeSel."/header/spacer.png\" width=20 height=1></td>\n";
    echo "</tr>\n";
    echo "<tr>\n";
    echo "<td rowspan=5><img src=\"themes/".$ThemeSel."/header/nukestyle-hd_01.png\" width=\"100%\" height=198></td>\n";
 /**********************************************************************************************************************************************************/   
   echo "<td valign=\"top\" align=\"center\" width=\"198\" background=\"themes/".$ThemeSel."/header/background.png\" rowspan=5>\n";
   if (@file_exists(NUKE_THEMES_DIR.$ThemeSel.'/swf/'.$domain.'.left.swf'))
   {
	   ?>
      <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,42,34"
        id="<?=$domain?>.left.swf" width="231" height="198">
        <param name="movie" value="http://<?=$domain?>/themes/<?=$ThemeSel?>/swf/<?=$domain?>.left.swf">
        <param name="bgcolor" value="#CECECE">
        <param name="quality" value="best">
        <param name="wmode" value="direct">
        <param name="allowscriptaccess" value="samedomain">
        <embed type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" name="<?=$domain?>.left.swf" width="231" height="198" src="http://<?=$domain?>/themes/<?=$ThemeSel?>/swf/<?=$domain?>.left.swf" bgcolor="#CECECE" quality="best" wmode="transparent" allowscriptaccess="samedomain"><noembed></noembed></embed>
      </object>     	   
    <?
   }
   else
   {
	   ?>
      <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,42,34"
        id="86it.swf" width="231" height="198">
        <param name="movie" value="http://<?=$domain?>/themes/<?=$ThemeSel?>/swf/86it.swf">
        <param name="bgcolor" value="#CECECE">
        <param name="quality" value="best">
        <param name="wmode" value="direct">
        <param name="allowscriptaccess" value="samedomain">
        <embed type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" name="86it.swf" width="231" height="198" src="http://<?=$domain?>/themes/<?=$ThemeSel?>/swf/86it.swf" bgcolor="#CECECE" quality="best" wmode="transparent" allowscriptaccess="samedomain"><noembed></noembed></embed>
      </object>     	   
    <?
   }
	echo "</td>\n";
/**********************************************************************************************************************************************************/   
    echo "<td valign=\"top\" align=\"center\" rowspan=5 background=\"themes/".$ThemeSel."/header/nukestyle-hd_full.png\" width=100% height=198>";
	if (@file_exists(NUKE_THEMES_DIR.$ThemeSel.'/swf/'.$domain.'.center.swf'))
	{   
	   ?>
      <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,42,34" 
      id="<?=$domain?>.center.swf" width="500" height="198">
        <param name="movie" value="http://<?=$domain?>/themes/<?=$ThemeSel?>/swf/<?=$domain?>.center.swf">
        <param name="bgcolor" value="#CECECE">
        <param name="quality" value="best">
        <param name="wmode" value="direct">
        <param name="allowscriptaccess" value="samedomain">
        <embed type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" name="http://<?=$domain?>/themes/<?=$ThemeSel?>/swf/<?=$domain?>.center.swf" width="500" height="198" src="http://<?=$domain?>/themes/<?=$ThemeSel?>/swf/<?=$domain?>.center.swf" bgcolor="#CECECE" quality="best" wmode="transparent" allowscriptaccess="samedomain"><noembed></noembed></embed>
      </object>     	   
    <?
	}
    echo "</td>";
/**********************************************************************************************************************************************************/   
   echo "<td colspan=6>\n";
   if (@file_exists(NUKE_THEMES_DIR.$ThemeSel.'/swf/menu.swf'))
   {
   ?>
      <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,42,34"
        id="menu.swf" width="480" height="50">
        <param name="movie" value="http://<?=$domain?>/themes/<?=$ThemeSel?>/swf/menu.swf">
        <param name="bgcolor" value="#CECECE">
        <param name="quality" value="best">
        <param name="wmode" value="direct">
        <param name="allowscriptaccess" value="samedomain">
        <embed type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" name="http://<?=$domain?>/themes/<?=$ThemeSel?>/swf/menu.swf" width="480" height="50" src="http://<?=$domain?>/themes/<?=$ThemeSel?>/swf/menu.swf" bgcolor="#CECECE" quality="best" wmode="transparent"     allowscriptaccess="samedomain"><noembed></noembed></embed>
      </object>     	   
   <?
   }
   echo "</td>\n";
/**********************************************************************************************************************************************************/   
   echo "<td rowspan=5>\n";
   echo "<img src=\"themes/".$ThemeSel."/header/nukestyle-hd_05.png\" width=20 height=198></td>\n";
   echo "</tr>\n";
   echo "<tr>\n"; 
   echo "<td colspan=6 align=center bgcolor=\"#CECECE\" valign=middle width=480 height=75>";
/**********************************************************************************************************************************************************/   
   // This is where we load the advertising banner in the top right
   // hand corner of the header
   $networkads = networkads(0);
   
   if(empty($networkads)) 
   {
   
   echo "<a href=\"index.php\" target=\"_self\">\n";
   echo "<img src=\"themes/".$ThemeSel."/banners/php-nuke-titanium.png\" border=\"0\" alt='' title='' width=\"472\" height=\"74\"></a>";
   //  echo "<img src=\"themes/".$ThemeSel."/banners/tattoo.png\" border=\"0\" alt='' title='' width=\"472\" height=\"74\">";
   }
   else
   {
      echo "$networkads";
   }
/**********************************************************************************************************************************************************/   
   echo "</td></tr>\n";
   echo "<tr>\n";
   echo "<td colspan=6><img src=\"themes/".$ThemeSel."/header/nukestyle-hd_07.png\" width=480 height=9></td>\n";
   echo "</tr>\n";
   echo "<tr>\n";
   echo "<td rowspan=2><img src=\"themes/".$ThemeSel."/header/nukestyle-hd_08.png\" width=16 height=64></td>\n";

#############################################################################################################################################
#  //News Search enabled // News search of Blog search - uncomment the one you would like to use
#############################################################################################################################################   
  // echo "<td background=\"themes/".$ThemeSel."/header/nukestyle-hd_search.png\" width=179 height=31><form action=\"modules.php?op=modload&name=Music_Search&file=index\" method=\"post\"> <input type=\"text\" class=\"select\" name=\"query\" value style=\"width:140;height:18;FONT-SIZE: 10px; color:#000000;\" size=\"30\"></td>\n";


#############################################################################################################################################
#  //Blog Search enabled // Blog search - uncomment the one you would like to use
#############################################################################################################################################   
   //Blog Search enabled
   echo "<td background=\"themes/".$ThemeSel."/header/nukestyle-hd_search.png\" width=179 height=31>
         
		 <form action=\"modules.php?op=modload&name=Blog_Search&file=index\" method=\"post\">
         <input class=\"select\" type=\"text\" name=\"query\" value style=\"width:140;height:18;FONT-SIZE: 10px; color:#000000;\" size=\"38\">
		 
		 </td>
   
         <td background=\"themes/".$ThemeSel."/header/nukestyle-hd_s2.png\" width=43 height=31>
         
		 <input class=\"button\" type=\"submit\" value=\"GO\" border=\"0\" width=\"19\" height=\"15\">
		 
		 </td>
		 
		 </form>
      
	     <td><img src=\"themes/".$ThemeSel."/header/nukestyle-hd_11.png\" width=24 height=31></td>
         
		 <td colspan=2 background=\"themes/".$ThemeSel."/header/nukestyle-hd_time.png\" width=218 height=31>\n";
   
   
   //load the clock that is on the top right hand side of the header!
   echo "<a href=\"javascript:clear_cache.submit()\">\n";
   echo "<script language=\"javascript\">\n";
   echo "<!--\n";
   echo "new LiveClock('Tahoma','1','#FFFFFF','#','<b>Time : ','</b>','174','1','1','0','2','null');\n"; 
   echo "//-->\n";
   echo "</script>\n";
   echo "</a>\n";
   //load the clock that is on the top right hand side of the header!
   
   echo "</td>\n";
   echo "</tr>\n";
   echo "<tr>\n";
   echo "<td valign=middle colspan=4 background=\"themes/".$ThemeSel."/header/nukestyle-hd_user.png\" width=391 height=33><font size=\"2\" face=\"arial\">";
   
   if(!$screen_res)
   {
     //$url = $_SERVER['REQUEST_URI'];
	 //echo "<meta http-equiv='refresh' content='0;URL=$url'>";
   }
   
   //screen resolution in the header
   echo "<img src=\"images/titanium/tiny_widescreen.png\" height=\"19\" align=\"top\"> Your video resolution is <font color=\"c00000\">".$_COOKIE["theme_resolution"]."<font><font><br>";

   echo "</td><td><img src=\"themes/".$ThemeSel."/header/nukestyle-hd_u2.png\" width=\"73\" height=\"33\"></td></font>\n";
   echo "</tr>\n";

   echo "<table cellSpacing=\"0\" cellPadding=\"0\" width=\"100%\" border=\"0\">\n";
   echo "<tr>\n";
   echo "<td width=\"100%\" height=\"5\">\n";
   echo "<img height=\"5\" src=\"themes/".$ThemeSel."/header/ltbg.png\" width=\"20\"></td>\n";
   echo "<td width=\"20\" height=\"5\">\n";
   echo "<img height=\"5\" src=\"themes/".$ThemeSel."/header/rtbg.png\" width=\"20\"></td>\n";
   echo "</tr>\n";
   echo "</table>\n";
   echo "</TABLE>\n";

   echo "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\">\n"
	   ."<tr valign=\"top\">\n"
       ."<td width=\"20\" valign=\"top\" background=\"themes/".$ThemeSel."/sides/leftbg.png\">\n"
	   ."<img src=\"themes/".$ThemeSel."/sides/leftbg.png\" width=\"20\" height=\"15\" border=\"0\">"
	   ."</td>\n"
	   ."<td width=\"20\">\n";

    
	if(blocks_visible('left')) 
	{
		global $fuckyou, $file;
	    if ( ($op =="info") or ($file =="arcade") or ($op =="newsletter") or ($op =="messages") )
		{
            $fuckyou = "yes";
		}
		else
		{
			$fuckyou = "no";
			blocks('left');
		}
    } 
	else 
	{

    }
   
   //this controls the gap between the left block and the left side of the center table!!!
    echo "</td>\n"
    	."<td><img src=\"themes/".$ThemeSel."/images/spacer.png\" width=\"7\" height=\"0\" border=\"0\" alt=\"\"></td>\n"
    	."<td width=\"100%\">\n";

	echo "<meta name=\"header-end\">";

}
/************************************************************/
/* Function themefooter()                                   */
/************************************************************/
function themefooter() 
{
    global $ThemeSel, $banners, $op;

	//this is where i control the gap between the right block and the right side of the center block   
	echo "</td>\n"
	    ."<td><img src=\"themes/".$ThemeSel."/images/spacer.png\" width=\"7\" height=\"15\" border=\"0\" alt=\"\"></td>\n"
	    ."<td valign=\"top\" background=\"themes/".$ThemeSel."/sides/rightbbg.png\" width=\"21\">\n";
	
    if(blocks_visible('right')) 
    {
		global $fuckyou;
	    if ( ($op =="info") or ($fuckyou =="yes") or ($op =="newsletter") or ($op =="messages") )
        {
		
		}
		else
		{
		  blocks('right');

		}
    }
	
    echo "</td>\n"
	
        ."<td width=\"21\" valign=\"top\" background=\"themes/".$ThemeSel."/sides/rightbg.png\">\n"
		."<img src=\"themes/".$ThemeSel."/sides/rightbg.png\" width=\"21\" height=\"15\" border=\"0\">\n"
		."</td>\n"
	
	    ."</tr>\n"
	    ."</table>\n\n\n";

    echo"<tr>\n";
    echo"<td height=\"42\"></td>\n";
    echo"</tr>\n";
    echo"</table></td>\n";
    echo"</tr>\n";
    echo"</table></td>\n";
    echo"</tr>\n";
    echo"</table>\n";
    echo"</td>\n";
    echo"</tr>\n";
    echo"</table>\n";

    echo"<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse\" width=\"100%\">";
    echo"<tr>";
    echo"<td width=\"100%\" background=\"themes/".$ThemeSel."/footer/nukestyle-ft_lt.png\">";
    echo"<img src=\"themes/".$ThemeSel."/footer/nukestyle-ft_01.png\" width=20 height=173>";
    echo"</td>";
    echo"<td width=\"100%\">";
    echo"<img src=\"themes/".$ThemeSel."/footer/nukestyle-ft_05.png\" width=20 height=173></td>";
    echo"</tr>";
    echo"</table>";
  
    echo "<center>";
    footmsg();
    echo "</center>";
}


/************************************************************/
/* Function theme_blog_index()                              */
/* This function format the stories on the Homepage         */
/************************************************************/
function theme_blog_index ($aid, $informant, $time, $title, $counter, $topic, $thetext, $notes, $swf, $suspect, $morelink, $topicname, $topicimage, $topictext) 
{
  global $anonymous, $tipath, $theme_name, $sid, $domain, $rating, $name;
  global $facebook_plugin_width;
  global $textcolor1, $textcolor2;
  
    $ThemeSel = get_theme();
/**********************************************************************************************************************************************************/   
    $name="Blogs";
/**********************************************************************************************************************************************************/   
	if(!empty($topicimage)) { if (file_exists("themes/$ThemeSel/images/topics/$topicimage")){ $t_image = "themes/$ThemeSel/images/topics/$topicimage";}
	else 
	{$t_image = "$tipath$topicimage";}$topic_img = "<a href=\"http://".$domain."/modules.php?name=".$name."&amp;new_topic=".$topic."\"><img src=\"".$t_image."\" border=\"0\" alt=\"$topictext\" /></a>";} 
	else {$topic_img = "";}
	
	if (!empty($notes)){$notes = "<br /><br /><strong>"._NOTE."</strong> $notes\n";}else{$notes = "";}
/**********************************************************************************************************************************************************/   
    $check_filename = $suspect;
	    
	if ($suspect =='none.gif')
	$suspect = "<center><img src=\"http://".$domain."/upload/upu/files/none.gif\" width=0 height=0></center><hr>\n";
	else
    $suspect = "<hr><center><NO RESIZE><img src=\"http://".$domain."/upload/upu/files/$suspect\"></NO RESIZE></center><hr>\n";
/**********************************************************************************************************************************************************/   
	$content = '';

    if ($aid == $informant){$content = "$thetext$notes\n";}
	else{if(defined('WRITES')){if(!empty($informant)){if(is_array($informant)){$content = "<a href=\"http://".$domain."/modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant[0]\">$informant[1]</a> ";}else{$content = "<a href=\"http://".$domain."/modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant\">$informant</a> ";}}else{$content = "$anonymous ";}$content .= _WRITES." \"$thetext\"$notes\n";}else{$content .= "$thetext$notes\n";}}
/**********************************************************************************************************************************************************/   
    $posted = _POSTEDBY." ";
    $posted .= get_author($aid);
    $posted .= " "._ON." $time  ";
    $datetime = substr($morelink, 0, strpos($morelink, "|") - strlen($morelink));
    $morelink = substr($morelink, strlen($datetime) + 2);
/**********************************************************************************************************************************************************/   
    global $sitename, $pagetitle;

	$pagetitle = $sitename." » ".$name;

      OpenTableModule();

      if($swf == "none.swf")
      {
		if ($check_filename == 'none.gif')
        echo "<b>[ Topic</b> &raquo; <a href=\"http://$domain/modules.php?name=$name>&amp;new_topic=$topic?>\"><font color=\"#CC0000\">$topictext</font></a> <b>] [ Subject</b> &raquo; <font color=\"#CC0000\">$title</font><b>]</b>";
        else
		if ($check_filename == 'personal.png')
        echo "<center><b>[ Topic</b> &raquo; <a href=\"http://$domain/modules.php?name=$name>&amp;new_topic=$topic?>\"><font color=\"#CC0000\">$topictext</font></a> <b>] [ Subject</b> &raquo; <font color=\"#CC0000\">$title</font><b>]</b></center>";
        else		
        echo "<b>[ Topic</b> &raquo; <a href=\"http://$domain/modules.php?name=$name>&amp;new_topic=$topic?>\"><font color=\"#CC0000\">$topictext</font></a> <b>] [ Subject</b> &raquo; <font color=\"#CC0000\">$title</font><b>]</b>";

        echo $suspect;
       	
        echo $content;
		if ($check_filename != 'personal.png')
        echo '<br />';
		if ($check_filename == 'personal.png')
        echo "<center>".$posted."</center>";
		else
		echo $posted;
		if ($check_filename != 'personal.png')
        echo '<br />';
        echo '<hr>';
        echo '<br />';
        echo '<br />';
/**********************************************************************************************************************************************************/   
        include(NUKE_THEMES_DIR.$theme_name.'/includes/plugin_facebook_likes.php');
/**********************************************************************************************************************************************************/   
        include(NUKE_THEMES_DIR.$theme_name.'/includes/plugin_facebook_comments.php');
/**********************************************************************************************************************************************************/   
        echo '<hr>';
		if ($check_filename != 'personal.png')
        echo "$datetime <font color=\"$textcolor2\">$title</font> | $morelink This has been read <font color=\"$textcolor2\">$counter</font> times.";
		else
		echo "<center>$datetime <font color=\"$textcolor2\">$title</font> | $morelink This has been read <font color=\"$textcolor2\">$counter</font> times.</center>";
		
      }
      else
      {
         if ($loadflv == 1)
         {
           echo '<center>';
	       echo "<b>[ Topic</b> &raquo; <a href=\"http://$domain/modules.php?name=$name>&amp;new_topic=$topic?>\"><font color=\"#CC0000\">$topictext</font></a> <b>] [ Subject</b> &raquo; <font color=\"#CC0000\">$title</font><b>]</b>";
           echo '</center>';
           echo "<hr>";

			if ($check_filename != 'none.gif')
			{
              echo $suspect;
			  echo "<hr />";
			}

          ?>
          <center>
          <script type='text/javascript' src='js/jwplayer.js'></script>
 
          <div id='mediaspace'>This text will be replaced</div>
 
          <script type='text/javascript'>
          <!--\n
          jwplayer('mediaspace').setup({
         'flashplayer': 'players/jsplayer.swf',
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
         <?
         echo '<hr>';
         echo '<br />';
         echo '<br />';
/**********************************************************************************************************************************************************/   
include(NUKE_THEMES_DIR.$theme_name.'/includes/plugin_facebook_likes.php');
/**********************************************************************************************************************************************************/   
include(NUKE_THEMES_DIR.$theme_name.'/includes/plugin_facebook_comments.php');
/**********************************************************************************************************************************************************/   
         echo '<hr><center>';
         echo "$datetime <font color=\"$textcolor2\">$title</font> | $morelink This has been read <font color=\"$textcolor2\">$counter</font> times.";
		 echo '</center>';
		}
	    else
         {
            echo "<center>";

            echo "<b>[ Topic</b> &raquo; <a href=\"http://$domain/modules.php?name=$name>&amp;new_topic=$topic?>\"><font color=\"#CC0000\">$topictext</font></a> <b>] [ Subject</b> &raquo; <font color=\"#CC0000\">$title</font><b>]</b>";
			

			if ($check_filename != 'none.gif')
            echo $suspect;
			else
			echo "<hr />";

            $newswf = new swfheader(false) ;
            $newswf->loadswf("upload/upu/files/$swf") ;
            $newswf->display($trans);  

             echo "<hr>";
       
	        ?>
            <center><?=$content?></center>
            <center><?=$posted?></center>
            <hr>
            <?

            echo '<br />';
            echo '<br />';
/**********************************************************************************************************************************************************/   
include(NUKE_THEMES_DIR.$theme_name.'/includes/plugin_facebook_likes.php');
/**********************************************************************************************************************************************************/   
include(NUKE_THEMES_DIR.$theme_name.'/includes/plugin_facebook_comments.php');
/**********************************************************************************************************************************************************/   
            echo "</center>";
            echo '<hr><center>';
            echo "$datetime <font color=\"$textcolor2\">$title</font> | $morelink This has been read <font color=\"$textcolor2\">$counter</font> times.";
		    echo '</center>';
         }
     }
CloseTable();
echo "<br />";
}

/************************************************************/
/* Function theme_blog_article()                            */
/************************************************************/
function theme_blog_article ($aid, $informant, $datetime, $title, $thetext, $topic, $topicname, $topicimage, $topictext, $swf, $suspect) 
{
    global $admin, $sid, $tipath, $theme_name, $domain, $name, $fb_title;
    global $sitename, $pagetitle;  
    global $name, $op;
    global $facebook_plugin_width;
/**********************************************************************************************************************************************************/   
    $ThemeSel = get_theme();
/**********************************************************************************************************************************************************/       
	$posted = _POSTEDON." $datetime "._BY." ";
    $posted .= get_author($aid);
/**********************************************************************************************************************************************************/      
    $name="Blogs";
/**********************************************************************************************************************************************************/   	
	if(!empty($topicimage)) 
	{
        if (file_exists("themes/$ThemeSel/images/topics/$topicimage")) 
		{
            $t_image = "themes/$ThemeSel/images/topics/$topicimage";
        } 
		else 
		{
            $t_image = "$tipath$topicimage";
        }
        
		$topic_img = "<a href=\"http://".$domain."/modules.php?name=".$name."&amp;new_topic=".$topic."\"><img src=\"".$t_image."\" border=\"0\" alt=\"$topictext\" /></a>";
    } 
	else 
	{
        $topic_img = "";
    }
/**********************************************************************************************************************************************************/   	
	if (!empty($notes)){ $notes = "<br /><br /><strong>"._NOTE."</strong> <i>$notes</i>\n"; } else { $notes = ''; }
/**********************************************************************************************************************************************************/       
    if ( isset($_POST['file1']['filename']) && !empty($_POST['file1']['filename']) )  
    {
       $suspect = $_POST['file1']['filename'];
    } 
/**********************************************************************************************************************************************************/   
    $check_filename = $suspect;
	
	if ($suspect =='none.gif')
	$suspect = "<center><img src=\"http://".$domain."/upload/upu/files/none.gif\" width=0 height=0></center>\n";
	else
    $suspect = "<center><NO RESIZE><img src=\"http://".$domain."/upload/upu/files/$suspect\"></NO RESIZE></center><hr>\n";
/**********************************************************************************************************************************************************/   	
    if ( isset($_POST['file2']['filename']) && !empty($_POST['file2']['filename']) )  
    $swf = $_POST['file2']['filename'];
    else 
    $swf = Fix_Quotes($swf);
/**********************************************************************************************************************************************************/   
    $content = '';
/**********************************************************************************************************************************************************/   
    if ($aid == $informant) 
    $content = "$thetext$notes\n";
	else 
	{
		if(defined('WRITES')) 
		{
            if(!empty($informant)) 
			{
                if(is_array($informant)) 
				{
                    $content = "<a href=\"http://".$domain."/modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant[0]\">$informant[1]</a> ";
                } 
				else 
				{
                    $content = "<a href=\"http://".$domain."/modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant\">$informant</a> ";
                }
            } 
			else 
            $content = "$anonymous ";
            
			$content .= ""._WRITES." <i>\"$thetext\"</i>$notes\n";
        } 
		else 
        $content .= "$thetext$notes\n";
    }
/**********************************************************************************************************************************************************/   	

      $pagetitle = $sitename." » ".$name;    

      OpenTableModule();

      if($swf == "none.swf")
      {
		
		if ($check_filename == 'none.gif')
        echo "<b>[ Topic</b> &raquo; <a href=\"http://$domain/modules.php?name=$name>&amp;new_topic=$topic?>\"><font color=\"#CC0000\">$topictext</font></a> <b>] [ Subject</b> &raquo; <font color=\"#CC0000\">$title</font><b>]</b>";
        else
		if ($check_filename == 'personal.png')
        echo "<center><b>[ Topic</b> &raquo; <a href=\"http://$domain/modules.php?name=$name>&amp;new_topic=$topic?>\"><font color=\"#CC0000\">$topictext</font></a> <b>] [ Subject</b> &raquo; <font color=\"#CC0000\">$title</font><b>]</b></center>";
        else		
        echo "<b>[ Topic</b> &raquo; <a href=\"http://$domain/modules.php?name=$name>&amp;new_topic=$topic?>\"><font color=\"#CC0000\">$topictext</font></a> <b>] [ Subject</b> &raquo; <font color=\"#CC0000\">$title</font><b>]</b>";
		
		echo '<hr>';
        echo $suspect;
        echo $content;
        if ($check_filename != 'personal.png')
		echo '<br />';
		if ($check_filename == 'personal.png')
        echo "<center>".$posted."</center>";
		else
		echo $posted;
		if ($check_filename != 'personal.png')
        echo '<br />';
        echo '<hr>';
        echo '<br />';
        echo '<br />';
/**********************************************************************************************************************************************************/   
include(NUKE_THEMES_DIR.$theme_name.'/includes/plugin_facebook_likes.php');
/**********************************************************************************************************************************************************/   
include(NUKE_THEMES_DIR.$theme_name.'/includes/plugin_facebook_comments.php');
/**********************************************************************************************************************************************************/   
        echo '<hr>';
      }
      else
      {
         if ($loadflv == 1)
         {

        echo "<center><b>[ Topic</b> &raquo; <a href=\"http://$domain/modules.php?name=$name>&amp;new_topic=$topic?>\"><font color=\"#CC0000\">$topictext</font></a> <b>] [ Subject</b> &raquo; <font color=\"#CC0000\">$title</font><b>]</b></center>";
        
		 ?>
         <hr />
         <center>
         <script type='text/javascript' src='includes/js/jwplayer.js'></script>
 
         <div id='mediaspace'>This text will be replaced</div>
 
         <script type='text/javascript'>
         <!--\n
         jwplayer('mediaspace').setup({
        'flashplayer': 'players/jsplayer.swf',
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
	    else
         {

             echo "<center>";

             echo "<b>[ Topic</b> &raquo; <a href=\"http://$domain/modules.php?name=$name>&amp;new_topic=$topic?>\"><font color=\"#CC0000\">$topictext</font></a> <b>] [ Subject</b> &raquo; <font color=\"#CC0000\">$title</font><b>]</b>";
             
			 if ($check_filename != 'none.gif')
			 {
               echo "<hr />";
			   echo $suspect;
			 }
             else
             echo "<hr />";

             $newswf = new swfheader(false) ;
             $newswf->loadswf("upload/upu/files/$swf") ;
             $newswf->display($trans);  

             echo "<hr>";
       
	        ?>
            <center><?=$content?></center>
            <center><?=$posted?></center>
            <hr>
            <?

        echo '<br />';
        echo '<br />';
/**********************************************************************************************************************************************************/   
include(NUKE_THEMES_DIR.$theme_name.'/includes/plugin_facebook_likes.php');
/**********************************************************************************************************************************************************/   
include(NUKE_THEMES_DIR.$theme_name.'/includes/plugin_facebook_comments.php');
/**********************************************************************************************************************************************************/   
        echo '<hr>';

             echo "</center>";
         }

     }
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
#########################################################################
# Table Header Module     Fix Start - by TheGhost   v1.0.0     01/30/2012
#########################################################################
  global $pagetitle;
  $pagetitle = "Titanium Tunes";
  OpenTableModule();
#########################################################################
# Table Header Module     Fix End  - by TheGhost   v1.0.0     01/30/2012
#########################################################################
	$ThemeSel = get_theme();

    # Module Name
    $name="Music";
	
	# Topic Icon
	if(!empty($topicimage)) { if (file_exists("themes/$ThemeSel/images/topics/$topicimage")){ $t_image = "themes/$ThemeSel/images/topics/$topicimage";}
	else {$t_image = "$tipath$topicimage";}
	$topic_img = "<a href=\"http://".$domain."/modules.php?name=".$name."&amp;new_topic=".$topic."\"><img src=\"".$t_image."\" border=\"0\" alt=\"$topictext\" /></a>";} 
	else {$topic_img = "";}	if (!empty($notes)){$notes = "<br /><br /><strong>"._NOTE."</strong> $notes\n";}else{$notes = "";}

    # Image Hack
    if ($suspect =='none.gif')
	$suspect = "<center><img src=\"http://".$domain."/upload/upu/files/none.gif\" width=0 height=0></center>\n";
	else
    $suspect = "<center><NO RESIZE><img src=\"http://".$domain."/upload/upu/files/$suspect\"></NO RESIZE></center><hr>\n";

    # define $content 
	$content = '';
	
	# notes
    if ($aid == $informant){$content = "$thetext$notes\n";}
	else{if(defined('WRITES')){
	if(!empty($informant)){
	if(is_array($informant)){
	$content = "<a href=\"http://".$domain."/modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant[0]\">$informant[1]</a> ";}
	else
	{$content = "<a href=\"http://".$domain."/modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant\">$informant</a> ";}}
	else
	{$content = "$anonymous ";}$content .= _WRITES." \"$thetext\"$notes\n";}else{$content .= "$thetext$notes\n";}}

    # posted by
    $posted = _POSTEDBY." ";
    $posted .= get_author($aid);
    $posted .= " "._ON." $time  ";
    $datetime = substr($morelink, 0, strpos($morelink, "|") - strlen($morelink));
    $morelink = substr($morelink, strlen($datetime) + 2);

    # header
    echo "<center><b>[ Titanium Collection</b> &raquo; <a href=\"http://music.86it.us/modules.php?name=$name&amp;new_topic=$topic\"><font color=\"#CC0000\">$topictext</font></a> <b>] [ Song</b> &raquo; <font color=\"#CC0000\">$title </font><b>]</center></b>";
	echo "<hr>";

   if ($swf == "none.swf")
   {
     echo $suspect;
     echo "<br />";
     echo "<center>$content</center>";
     echo "<br />";
     echo "<center>".$posted."</center>";
     echo "<br />";
     echo "<hr>";
   }
   else
      {
        ?>
        <br />
        <center>
        <script type='text/javascript' src='includes/js/jwplayer.js'></script>
 
        <div id='mediaspace'>This text will be replaced</div>
 
        <script type='text/javascript'>
        <!--\n
        jwplayer('mediaspace').setup({
       'flashplayer': 'players/jsplayer.swf',
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
include(NUKE_THEMES_DIR.$theme_name.'/includes/plugin_facebook_music_likes.php');
/**********************************************************************************************************************************************************/   
include(NUKE_THEMES_DIR.$theme_name.'/includes/plugin_facebook_music_comments.php');
/**********************************************************************************************************************************************************/   
echo '<hr>';
echo "<b>$datetime ) (<font color=\"#000000\"><b>$title</b></font> $morelink <font color=\"#000000\">This has been read</font> <font color=\"$textcolor2\">$counter</font> <font color=\"#000000\">times.</font></b>";
CloseTable();
echo "<br />";

}




/************************************************************/
/* Function theme_music_article()                           */
/************************************************************/
function theme_music_article ($aid, $informant, $datetime, $title, $thetext, $topic, $topicname, $topicimage, $topictext, $swf, $suspect) 
{
    global $admin, $sid, $tipath, $theme_name, $domain, $name, $fb_title;
#########################################################################
# Table Header Module     Fix Start - by TheGhost   v1.0.0     01/30/2012
#########################################################################
  global $pagetitle;
  $pagetitle = "Titanium Tunes";
  OpenTableModule();
#########################################################################
# Table Header Module     Fix End  - by TheGhost   v1.0.0     01/30/2012
#########################################################################
    $ThemeSel = get_theme();
/**********************************************************************************************************************************************************/       
    $posted = _POSTEDBY." ";
    $posted .= get_author($aid);
    $posted .= " "._ON." $datetime  ";
    
    

/**********************************************************************************************************************************************************/      
    $name="Music";
/**********************************************************************************************************************************************************/   	
	if(!empty($topicimage)) {
        if (file_exists("themes/$ThemeSel/images/topics/$topicimage")) {
            $t_image = "themes/$ThemeSel/images/topics/$topicimage";
        } else {
            $t_image = "$tipath$topicimage";
        }
        $topic_img = "<a href=\"http://".$domain."/modules.php?name=".$name."&amp;new_topic=".$topic."\"><img src=\"".$t_image."\" border=\"0\" alt=\"$topictext\" /></a>";
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
    if(is_array($informant)) { $content = "<a href=\"http://".$domain."/modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant[0]\">$informant[1]</a> "; } 
	else { $content = "<a href=\"http://".$domain."/modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant\">$informant</a> "; }} else { $content = "$anonymous "; }
    $content .= ""._WRITES." <i>\"$thetext\"</i>$notes\n"; } else { $content .= "$thetext$notes\n"; }}
/**********************************************************************************************************************************************************/   	
    echo "<center><b>[ Titanium Collection</b> &raquo; <a href=\"http://music.86it.us/modules.php?name=$name&amp;new_topic=$topic\"><font color=\"#CC0000\">$topictext</font></a> <b>] [ Song</b> &raquo; <font color=\"#CC0000\">$title </font><b>]</center></b>";
	echo "<hr>";
/**********************************************************************************************************************************************************/   
   if ($swf == "none.swf")
   {
     echo $suspect;
     echo "<br />";
     echo "<center>$content</center>";
     echo "<br />";
     echo "<center>".$posted."</center>";
     echo "<br />";
     echo "<hr>";
   }
   else
      {
        ?>
        <br />
        <center>
        <script type='text/javascript' src='includes/js/jwplayer.js'></script>
 
        <div id='mediaspace'>This text will be replaced</div>
 
        <script type='text/javascript'>
        <!--\n
        jwplayer('mediaspace').setup({
       'flashplayer': 'players/jsplayer.swf',
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
include(NUKE_THEMES_DIR.$theme_name.'/includes/plugin_facebook_music_likes.php');
/**********************************************************************************************************************************************************/   
include(NUKE_THEMES_DIR.$theme_name.'/includes/plugin_facebook_music_comments.php');
/**********************************************************************************************************************************************************/   
echo '<hr>';
echo "<b>(<font color=\"#000000\"><b>$title</b></font> $morelink )</b>";
CloseTable();
echo "<br />";
}





function themecenterbox($title, $content) 
{
    global $sitename, $theme_name, $textcolor1;
	
   echo"<table class=\"otthree\"border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">"
     . "<tr>"
     . "<td background=\"themes/$theme_name/tables/OpenTable/topmiddle.png\" align=\"left\" width=\"39\" colspan=\"2\">"
     . "<img src=\"themes/$theme_name/tables/OpenTable/leftcorner.png\" width=\"39\" height=\"50\"></td>"
     . "<td background=\"themes/$theme_name/tables/OpenTable/topmiddle.png\" width=\"100%\">"
     . "<div class=\"typeface-js\" style=\"font-family: Helvetiker\" align=\"center\"><strong><font color =\"$textcolor1\">$sitename » $title</font></strong></div>"
     . "</td>"
     . "<td background=\"themes/$theme_name/tables/OpenTable/topmiddle.png\" align=\"right\" width=\"39\" colspan=\"2\">"
     . "<img src=\"themes/$theme_name/tables/OpenTable/rightcorner.png\" width=\"39\" height=\"50\"></td>"
     . "</tr>"
     . "<tr>"
     . "<td width=\"15\" background=\"themes/$theme_name/tables/OpenTable/leftside.png\"></td>"
     . "<td width=\"24\"></td>"
     . "<td width=\"100%\">";
    
  echo '<center><span class="option"><strong>'.$title.'</strong></span></center><br />'.$content;
  
  CloseTable();
  echo "<br />";

}

function themepreview($title, $hometext, $bodytext='', $notes='', $swf='', $suspect='') 
{
    echo '<strong>'.$title.'</strong><br /><br />'.$hometext;

    if (!empty($bodytext)) 
	{
        echo '<br /><br />'.$bodytext;
    }
    
	if (!empty($notes)) 
	{
        echo '<br /><br /><strong>'._NOTE.'</strong> <i>'.$notes.'</i>';
    }
}
/************************************************************/
/* Function themesidebox()                                  */
/************************************************************/


function themesidebox($title, $content, $bid=0) 
{
    global $theme_name, $main_blocks_table_width;

   echo"<style type=\"text/css\">"
     . "<!--"
     . ".style1 {"
     . "color: #FFFFFF;"
     . "font-weight: bold;"
     . "}"
     . "-->"
     . "</style>"
     . "<table class=block cellSpacing=\"0\" cellPadding=\"0\" border=\"0\" width=\"$main_blocks_table_width\">"
     . "<tr>"
     . "<td background=\"themes/$theme_name/tables/OpenTable/topmiddle.png\">"
     . "<img src=\"themes/$theme_name/tables/OpenTable/leftcorner.png\" border=\"0\" width=\"39\" height=\"50\"></td>"
     . "<td width=\"$main_blocks_table_width\" align=\"center\" background=\"themes/$theme_name/tables/OpenTable/topmiddle.png\"><div class=\"typeface-js\" style=\"font-family: Helvetiker\"><span class=\"style1\">$title</span></div></td>"
     . "<td>"
     . "<img src=\"themes/$theme_name/tables/OpenTable/rightcorner.png\" border=\"0\" width=\"39\" height=\"50\"></td>"
     . "</tr>"
     . "<tr>"
     . "<td colSpan=\"3\">"
     . "<table cellSpacing=\"0\" cellPadding=\"0\" width=\"100%\" border=\"0\">"
     . "<tr>"
     . "<td width=\"15\" background=\"themes/$theme_name/tables/OpenTable/leftside.png\">"
     . "<img src=\"themes/$theme_name/tables/OpenTable/leftside.png\" border=\"0\" width=\"15\" height=\"4\"></td>"
     . "<td width=\"100%\" >"
     . "<table cellSpacing=\"0\" cellPadding=\"8\" width=\"100%\" border=\"0\" style=\"border-collapse: collapse\" bordercolor=\"#111111\">"
     . "<tr>"
     . "<td width=\"$main_blocks_table_width\">"
     . "$content         </td>"
     . "</tr>"
     . "</table>"
     . "</td>"
     . "<td width=\"15\" background=\"themes/$theme_name/tables/CloseTable/rightside.png\">"
     . "<img src=\"themes/$theme_name/tables/CloseTable/rightside.png\" border=\"0\" width=\"15\" height=\"4\"></td>"
     . "</tr>"
     . "</table>"
     . "</td>"
     . "</tr>"
     . "<tr>"
     . "<td width=\"39\" height=\"52\">"
     . "<img src=\"themes/$theme_name/tables/CloseTable/leftbottomcorner.png\" border=\"0\" width=\"39\" height=\"52\"></td>"
     . "<td width=\"$main_blocks_table_width\" height=\"27\" background=\"themes/$theme_name/tables/CloseTable/bottommiddle.png\">        </td>"
     . "<td width=\"39\" height=\"27\">"
     . "<img src=\"themes/$theme_name/tables/CloseTable/bottomrightcorner.png\" border=\"0\" width=\"39\" height=\"52\"></td>"
     . "</tr>"
     . "</table>"
     . "<br>";
}

function surveysidebox($title, $content, $bid=0) 
{
    global $theme_name, $main_blocks_table_width;

   echo"<style type=\"text/css\">"
     . "<!--"
     . ".style1 {"
     . "color: #FFFFFF;"
     . "font-weight: bold;"
     . "}"
     . "-->"
     . "</style>"
     . "<table class=block cellSpacing=\"0\" cellPadding=\"0\" border=\"0\" width=\"$main_blocks_table_width\">"
     . "<tr>"
     . "<td background=\"themes/$theme_name/tables/OpenTable/topmiddle.png\">"
     . "<img src=\"themes/$theme_name/tables/OpenTable/leftcorner.png\" border=\"0\" width=\"39\" height=\"50\"></td>"
     . "<td width=\"$main_blocks_table_width\" align=\"center\" background=\"themes/$theme_name/tables/OpenTable/topmiddle.png\"><div class=\"typeface-js\" style=\"font-family: Helvetiker\"><span class=\"style1\">$title</span></div></td>"
     . "<td>"
     . "<img src=\"themes/$theme_name/tables/OpenTable/rightcorner.png\" border=\"0\" width=\"39\" height=\"50\"></td>"
     . "</tr>"
     . "<tr>"
     . "<td colSpan=\"3\">"
     . "<table cellSpacing=\"0\" cellPadding=\"0\" width=\"100%\" border=\"0\">"
     . "<tr>"
     . "<td width=\"15\" background=\"themes/$theme_name/tables/OpenTable/leftside.png\">"
     . "<img src=\"themes/$theme_name/tables/OpenTable/leftside.png\" border=\"0\" width=\"15\" height=\"4\"></td>"
     . "<td width=\"100%\" >"
     . "<table cellSpacing=\"0\" cellPadding=\"8\" width=\"100%\" border=\"0\" style=\"border-collapse: collapse\" bordercolor=\"#111111\">"
     . "<tr>"
     . "<td width=\"$main_blocks_table_width\">"
     . "$content         </td>"
     . "</tr>"
     . "</table>"
     . "</td>"
     . "<td width=\"15\" background=\"themes/$theme_name/tables/CloseTable/rightside.png\">"
     . "<img src=\"themes/$theme_name/tables/CloseTable/rightside.png\" border=\"0\" width=\"15\" height=\"4\"></td>"
     . "</tr>"
     . "</table>"
     . "</td>"
     . "</tr>"
     . "<tr>"
     . "<td width=\"39\" height=\"52\">"
     . "<img src=\"themes/$theme_name/tables/CloseTable/leftbottomcorner.png\" border=\"0\" width=\"39\" height=\"52\"></td>"
     . "<td width=\"$main_blocks_table_width\" height=\"27\" background=\"themes/$theme_name/tables/CloseTable/bottommiddle.png\">        </td>"
     . "<td width=\"39\" height=\"27\">"
     . "<img src=\"themes/$theme_name/tables/CloseTable/bottomrightcorner.png\" border=\"0\" width=\"39\" height=\"52\"></td>"
     . "</tr>"
     . "</table>"
     . "<br>";
}
?>