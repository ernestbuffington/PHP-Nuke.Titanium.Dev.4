<?php
/*=======================================================================================
 PHP-Nuke Titanium : Enhanced PHP-Nuke Web Portal System : Using the Nuke-Evolution Core
 ========================================================================================*/
/*****************************************************************************************/
/* MNS-Titanium v.3.0 theme designed by Ernest "TheGhost" Buffington                     */
/* This theme was designed to fit the new generation wide screen monitors                */
/*                                                                                       */
/* MNS-Titanium v.3.0  is a free public theme package designed for PHP-Nuke Titanium     */
/* Copyright (c) 2009 by TheGhost All Rights Reserved                                    */
/*****************************************************************************************/
/* For more commercial and public themes, custom graphics and photoshop tutorials        */
/* visit www.mynetworkspace.in                                                           */
/*****************************************************************************************/
/* For support of this great CMS visit MyNetworkSpace http://www.mynetworkspace.in       */
/*****************************************************************************************/
/* PHP-Nuke Copyright (c) 2005 by Francisco Burzi http://phpnuke.org                     */
/*****************************************************************************************/
/*****[CHANGES]*****************************************************************************************************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       09/29/2005
      Theme Management                         v1.0.2       12/14/2005       
	  MyNetworkSpace Patched                   v1.0.0       10/09/2009       Modified for the MyNetworkSpace Network
	  SWF Header Class                         v1.0.0       10/09/2009       Modified for the MyNetworkSpace Network
	  Resolution Checker                       v1.0.0       10/09/2009       Modified for the MyNetworkSpace Network
	  Detect Browser Type                      v1.0.0       10/09/2009       Modified for the MyNetworkSpace Network
	  Page Loading Animation                   v1.0.0       10/09/2009       Modified for the MyNetworkSpace Network
	  Safari Browser Support                   v1.0.0       10/09/2009       Modified for the MyNetworkSpace Network
	  FireFox Browser Support                  v1.0.0       10/09/2009       Modified for the MyNetworkSpace Network
	  Internet Explorer Support                v1.0.0       10/09/2009       Modified for the MyNetworkSpace Network
	  File Extension Support                   v1.0.0       10/09/2009       Modified for the MyNetworkSpace Network
 ********************************************************************************************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) 
{
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
global $ThemeInfo, $modulename;

$bgcolor1 = $ThemeInfo['bgcolor1'];
$bgcolor2 = $ThemeInfo['bgcolor2'];
$bgcolor3 = $ThemeInfo['bgcolor3'];
$bgcolor4 = $ThemeInfo['bgcolor4'];
$textcolor1 = $ThemeInfo['textcolor1'];
$textcolor2 = $ThemeInfo['textcolor2'];

/************************************************************/
/* OpenTable Functions                                      */
/************************************************************/
include_once(NUKE_THEMES_DIR.$theme_name.'/tables.php');
/************************************************************/
/* OpenTable Functions                                      */
/************************************************************/


/************************************************************/
/* Function FormatStory()                                   */
/************************************************************/
function FormatStory($thetext, $notes, $swf, $suspect,  $aid, $informant) 
{
    global $anonymous, $domain;

	if (!empty($notes)){$notes = "<br /><br /><strong>"._NOTE."</strong> <i>$notes</i>\n";} 
	else{$notes = "";}
    
	//Theghost added Mug Shot for the MyNetworkSpace Network
    if ($suspect =='none.png'){ $suspect = "<hr /><NO RESIZE><img src=\"http://".$domain."/upload/upu/files/$suspect\ width=\"1\" height=\"1\"></NO RESIZE>\n";}
	else{$suspect = "<hr /><NO RESIZE><img src=\"http://".$domain."/upload/upu/files/".$suspect."\"></NO RESIZE><hr />\n";}
    
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
                    $boxstuff = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant[0]\">$informant[1]</a> ";
                } 
				else 
				{
                    $boxstuff = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant\">$informant</a> ";
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
	global $myappid, $user, $cookie, $prefix, $sitekey, $db, $name, $banners, $theme_name, $_SERVER, $HTTP_USER_AGENT, $HTTP_SERVER_VARS, $browser, $file_extension;
?>
<div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            appId      : '$myappid',
            status     : true, 
            cookie     : true,
            xfbml      : true
          });
        };
        (function(d){
           var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
           js = d.createElement('script'); js.id = id; js.async = true;
           js.src = "//connect.facebook.net/en_US/all.js";
           d.getElementsByTagName('head')[0].appendChild(js);
         }(document));
      </script>
      <div 
        class="fb-registration" 
        data-fields="[{'name':'name'}, {'name':'email'},
          {'name':'favorite_car','description':'What is your favorite car?',
            'type':'text'}]" 
        data-redirect-uri="URL_TO_LOAD_AFTER_REGISTRATION"
      </div>
<?	
    //
    // Determine the Browser the User is using, because of some nasty incompatibilities.
    //

    if (!empty($_SERVER['HTTP_USER_AGENT']))
    {
      $HTTP_USER_AGENT = $_SERVER['HTTP_USER_AGENT'];
    }
    else if (!empty($HTTP_SERVER_VARS['HTTP_USER_AGENT']))
    {
      $HTTP_USER_AGENT = $HTTP_SERVER_VARS['HTTP_USER_AGENT'];
    }
    else if (!isset($HTTP_USER_AGENT))
    {
      $HTTP_USER_AGENT = '';
    }	

    // Store Screen Resolution - Some Assholes Still have piece os shit computers!!!!!
    if(!isset($_COOKIE["theme_resolution"]))
	{
     ?>
      <script language="javascript"><!--
      writeCookie();
      
	  function writeCookie() 
      {
        var today = new Date();
        var the_date = new Date("June 16, 2023");
        var the_cookie_date = the_date.toGMTString();
        var the_cookie = "theme_resolution="+ screen.width +"x"+ screen.height +"x"+ screen.colorDepth;
        var the_cookie = the_cookie + ";expires=" + the_cookie_date;
        document.cookie=the_cookie;
      }
      
	  //--></script>
     <?php
    } 
	else 
	{ 
	  $theme[theme_res] = $_COOKIE["theme_resolution"]; 
	}
	
    if (ereg('Opera(/| )([0-9].[0-9]{1,2})', $HTTP_USER_AGENT, $log_version))
    {
	   //This browser handles PNG files just fine
       $browser_version = $log_version[2];
       $browser_agent = 'opera';
       $agent = strtolower(getenv("HTTP_USER_AGENT"));
	   $file_extension = '.png';
    }
    else 
	if (ereg('MSIE ([0-9].[0-9]{1,2})', $HTTP_USER_AGENT, $log_version))
    {
       $browser_version = $log_version[1];
       $browser_agent = 'ie';
       $agent = strtolower(getenv("HTTP_USER_AGENT"));
	   $file_extension = '.jpg';
    }
    else 
	if (ereg('OmniWeb/([0-9].[0-9]{1,2})', $HTTP_USER_AGENT, $log_version))
    {
	   //Mac Only
       $browser_version = $log_version[1];
       $browser_agent = 'omniweb';
       $agent = strtolower(getenv("HTTP_USER_AGENT"));
	   $file_extension = '.png';
    }
    else 
	if (ereg('Netscape([0-9]{1})', $HTTP_USER_AGENT, $log_version))
    {
	   //This browser handles PNG files just fine
       $browser_version = $log_version[1];
       $browser_agent = 'netscape';
       $agent = strtolower(getenv("HTTP_USER_AGENT"));
	   $file_extension = '.png';
	}
    else 
	if (ereg('Mozilla/([0-9].[0-9]{1,2})', $HTTP_USER_AGENT, $log_version))
    {
	   //This browser handles PNG files just fine
       $browser_version = $log_version[1];
       $browser_agent = 'mozilla';
       $agent = strtolower(getenv("HTTP_USER_AGENT"));
	   $file_extension = '.png';
    }
    else 
	if (ereg('Konqueror/([0-9].[0-9]{1,2})', $HTTP_USER_AGENT, $log_version))
    {
	   //This is garbage, I did not wish to waste an hour figuring out
	   //what to install for a windows based machine - This may work ok
	   //under a linux environment but as for windows I think I would rather
	   //drive a 10 penny nail into my nutsack
       $browser_version = $log_version[1];
       $browser_agent = 'konqueror';
       $agent = strtolower(getenv("HTTP_USER_AGENT"));
	   $file_extension = '.png';
    }
    else
    {
       $browser_version = 0;
       $browser_agent = 'other';
       $agent = strtolower(getenv("HTTP_USER_AGENT"));
	   $file_extension = '.jpg';
    }
	
    echo "<HTML>\n";
    echo "<HEAD>\n";
	echo "<html xmlns:fb=\"https://www.facebook.com/2008/fbml\">\n";
    echo "<meta http-equiv=\"Content-Language\" content=\"en-us\">\n";
    echo "<SCRIPT LANGUAGE=\"JavaScript\" src=\"themes/".$theme_name."/js/fade.js\"></script>\n";
	echo "<script language=\"javascript\" src=\"themes/".$theme_name."/js/liveclock.js\"></script>\n";
    echo "</head>\n\n\n";     	

    echo "<BODY>";
    echo "<body topmargin=\"0\" leftmargin=\"0\" marginwidth=\"0\" marginheight=\"0\">\n";

    echo "<TABLE WIDTH=100% BORDER=0 CELLPADDING=0 CELLSPACING=0>\n";
    echo "<TR>";
    echo "<TD>";
    echo "<IMG SRC=\"themes/".$theme_name."/header/spacer.png\" WIDTH=20 HEIGHT=1></TD>\n";
    echo "<TD>\n";
    echo "<IMG SRC=\"themes/".$theme_name."/header/spacer.png\" WIDTH=231 HEIGHT=1></TD>\n";
    echo "<TD>\n";
    echo "<IMG SRC=\"themes/".$theme_name."/header/spacer.png\" WIDTH=19 HEIGHT=1></TD>\n";
    echo "<TD>\n";
    echo "<IMG SRC=\"themes/".$theme_name."/header/spacer.png\" WIDTH=16 HEIGHT=1></TD>\n";
    echo "<TD>\n";
    echo "<IMG SRC=\"themes/".$theme_name."/header/spacer.png\" WIDTH=179 HEIGHT=1></TD>\n";
    echo "<TD>\n";
    echo "<IMG SRC=\"themes/".$theme_name."/header/spacer.png\" WIDTH=43 HEIGHT=1></TD>\n";
    echo "<TD>\n";
    echo "<IMG SRC=\"themes/".$theme_name."/header/spacer.png\" WIDTH=24 HEIGHT=1></TD>\n";
    echo "<TD>\n";
    echo "<IMG SRC=\"themes/".$theme_name."/header/spacer.png\" WIDTH=145 HEIGHT=1></TD>\n";
    echo "<TD>\n";
    echo "<IMG SRC=\"themes/".$theme_name."/header/spacer.png\" WIDTH=73 HEIGHT=1></TD>\n";
    echo "<TD>\n";
    echo "<IMG SRC=\"themes/".$theme_name."/header/spacer.png\" WIDTH=20 HEIGHT=10></TD>\n";
    echo "</TR>\n";
    echo "<TR>\n";
    echo "<TD ROWSPAN=5>\n";
    echo "<IMG SRC=\"themes/".$theme_name."/header/nukestyle-hd_01".$file_extension."\" WIDTH=20 HEIGHT=198></TD>\n";
    echo "<TD background=\"themes/".$theme_name."/header/background.png\" ROWSPAN=5>\n";


/**********************************************************************************************************************************************************/   
    // This is where we load the flash logo that resides 
	// in the top left hand corner of the header
	global $domain;

/************************************************************/
/* SWF Header Class                                         */
/************************************************************/
require_once(NUKE_CLASSES_DIR.'class.swfheader.php');
/************************************************************/
/* SWF Header Class                                         */
/************************************************************/
 	
	$newswf = new swfheader(false) ;
    $newswf->loadswf("themes/".$theme_name."/swf/".$domain.".left.swf") ;
    $newswf->display($trans);  

    /* echo "<script language=\"javascript\" src=\"js/theghostwashere.js\"></script>\n"; */
/**********************************************************************************************************************************************************/   


    echo "</TD>\n";
    echo "<TD valign=\"top\" align=\"center\" ROWSPAN=5 background=\"themes/".$theme_name."/header/nukestyle-hd_full".$file_extension."\" WIDTH=100% HEIGHT=198>";
	echo "<IMG SRC=\"themes/".$theme_name."/header/spacer.png\" WIDTH=1 HEIGHT=25>";


/**********************************************************************************************************************************************************/   
	// This is where we load the center flash logo that resides
	// at the top dead center of the theme.
    $newswf = new swfheader(false) ;
    $newswf->loadswf("themes/".$theme_name."/swf/".$domain.".center.swf") ;
    $newswf->display($trans);
	
	//echo "<br><br><br>";
	//echo "themes/".$theme_name."/swf/".$domain.".center.swf";  

    /* echo "<script language=\"javascript\" src=\"js/theghostwashere.js\"></script>\n"; */
/**********************************************************************************************************************************************************/   



   echo "</TD>";
   echo "<TD COLSPAN=6>\n";



/**********************************************************************************************************************************************************/   
    // This is where we load the flash menu that resides
	// in the top right hand corner of the header
   $newswf = new swfheader(false) ;
   $newswf->loadswf("themes/".$theme_name."/swf/menu.swf") ;
   $newswf->display($trans);  

   /* echo "<script language=\"javascript\" src=\"js/theghostwashere.js\"></script>\n"; */
/**********************************************************************************************************************************************************/   



   echo "</TD>\n";
   echo "<TD ROWSPAN=5>\n";
   echo "<IMG SRC=\"themes/".$theme_name."/header/nukestyle-hd_05".$file_extension."\" WIDTH=20 HEIGHT=198></TD>\n";
   echo "</TR>\n";
   echo "<TR>\n";
   echo "<TD COLSPAN=6 align=center valign=middle WIDTH=480 HEIGHT=75>";


/**********************************************************************************************************************************************************/   
   // This is where we load the advertising banner in the top right
   // hand corner of the header
   $ads = ads(0);
   
   if(empty($ads)) 
   {
   //echo "$ads";
   echo "<a href=\"index.php\" target=\"_self\">\n";
   echo "<img src=\"themes/".$theme_name."/header/nukestyle-hd_banner.png\" border=\"0\" alt='' title='' width=\"472\" height=\"74\"></a>";
   
   }
   else
   {
   echo "$ads";
   }
/**********************************************************************************************************************************************************/   


   echo "</TD></TR>\n";
   echo "<TR>\n";
   echo "<TD COLSPAN=6>\n";
   echo "<IMG SRC=\"themes/".$theme_name."/header/nukestyle-hd_07".$file_extension."\" WIDTH=480 HEIGHT=9></TD>\n";
   echo "</TR>\n";
   echo "<TR>\n";
   echo "<TD ROWSPAN=2>\n";
   echo "<IMG SRC=\"themes/".$theme_name."/header/nukestyle-hd_08".$file_extension."\" WIDTH=16 HEIGHT=64></TD>\n";
   echo "<TD background=\"themes/".$theme_name."/header/nukestyle-hd_search".$file_extension."\" WIDTH=179 HEIGHT=31><form action=\"modules.php?op=modload&name=Search&file=index\" method=\"post\"><input type=\"text\" name=\"query\" value style=\"width:140;height:18;FONT-SIZE: 10px; color:#000000;\" size=\"20\"></TD>\n";
   echo "<TD background=\"themes/".$theme_name."/header/nukestyle-hd_s2".$file_extension."\" WIDTH=43 HEIGHT=31>\n";
   echo "<input type=\"image\" value=\"search\" src=\"themes/".$theme_name."/header/searchbutton.png\" border=\"0\" width=\"19\" height=\"15\"></TD></form>\n";
   echo "<TD>\n";
   echo "<IMG SRC=\"themes/".$theme_name."/header/nukestyle-hd_11".$file_extension."\" WIDTH=24 HEIGHT=31></TD>\n";
   echo "<TD COLSPAN=2 background=\"themes/".$theme_name."/header/nukestyle-hd_time".$file_extension."\" WIDTH=218 HEIGHT=31>\n";
   echo "<script language=\"javascript\"><!--\n";
   echo "new LiveClock('arial','1','#FFFFFF','#','<b>Time: ','</b>','174','1','1','0','2','null'); //-->\n";
   echo "</script></TD>\n";
   echo "</TR>\n";
   echo "<TR>\n";
   echo "<TD valign=middle COLSPAN=4 background=\"themes/".$theme_name."/header/nukestyle-hd_user".$file_extension."\" WIDTH=391 HEIGHT=33><font size=\"2\" face=\"arial\">";
   //echo "POOPCIKLE"; Pocket Pickle
   echo "".$_COOKIE["theme_resolution"]." <b><- Monitor Resolution</b>";
   

   
   
   echo "</TD><TD><img src=\"themes/".$theme_name."/header/nukestyle-hd_u2".$file_extension."\" width=\"73\" height=\"33\"></TD></font>\n";
   echo "</TR>\n";

   echo "<table cellSpacing=\"0\" cellPadding=\"0\" width=\"100%\" border=\"0\">\n";
   echo "<tr>\n";
   echo "<td width=\"100%\" height=\"5\">\n";
   echo "<img height=\"5\" src=\"themes/".$theme_name."/header/ltbg.png\" width=\"20\"></td>\n";
   echo "<td width=\"20\" height=\"5\">\n";
   echo "<img height=\"5\" src=\"themes/".$theme_name."/header/rtbg.png\" width=\"20\"></td>\n";
   echo "</tr>\n";
   echo "</table>\n";

   echo "</TABLE>\n";
   echo "</BODY>\n";
   echo "</HTML>\n";

   echo "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\">\n"
	   ."<tr valign=\"top\">\n"
       ."<td width=\"20\" valign=\"top\" background=\"themes/".$theme_name."/sides/leftbg.png\">\n"
	   ."<img src=\"themes/".$theme_name."/sides/leftbg.png\" width=\"20\" height=\"15\" border=\"0\">"
	   ."</td>\n"
	   ."<td width=\"20\">\n";

	  if(blocks_visible('left')) 
	  {
		blocks('left');
      } 
	  else 
	  {
		 //include_once(NUKE_BLOCKS_DIR.'/block-Evo_User_Info.php'); 
         //themecenterbox("User Info", $content, $bid=5);
		 //themesidebox("User Info", $content, $bid);
      }
	  
	
   
   //this controls the gap between the left block and the left side of the center table!!!
    echo "</td>\n"
    	."<td><img src=\"themes/".$theme_name."/images/spacer.png\" width=\"7\" height=\"0\" border=\"0\" alt=\"\"></td>\n"
    	."<td width=\"100%\">\n";
}
/************************************************************/
/* Function themefooter()                                   */
/************************************************************/
function themefooter() 
{
    global $index, $user, $cookie, $banners, $prefix, $db, $admin,  $adminmail, $nukeurl, $theme_name;

	//this is where i control the gap between the right block and the right side of the center block   
	echo "</td>\n"
	    ."<td><img src=\"themes/".$theme_name."/images/spacer.png\" width=\"7\" height=\"15\" border=\"0\" alt=\"\"></td>\n"
	    ."<td valign=\"top\" background=\"themes/".$theme_name."/images/spacer.png\" width=\"21\">\n";


      if(blocks_visible('right')) 
      {
		blocks('right');
      }
	  else
	  {
		  
		  
	  }
	
    echo "</td>\n"
	
        ."<td width=\"21\" valign=\"top\" background=\"themes/".$theme_name."/sides/rightbg.png\">\n"
		."<img src=\"themes/".$theme_name."/sides/rightbg.png\" width=\"21\" height=\"15\" border=\"0\">\n"
		."</td>\n"
	
	    ."</tr>\n"
	    ."</table>\n\n\n";
    

//   echo "<HTML>\n";
//   echo "<HEAD>\n";

//   echo"<tr>\n";
//   echo"<td height=\"42\"></td>\n";
//   echo"</tr>\n";
//   echo"</table></td>\n";
//   echo"</tr>\n";
//   echo"</table></td>\n";
//   echo"</tr>\n";
//   echo"</table>\n";
//   echo"</td>\n";
//   echo"</tr>\n";
//   echo"</table>\n";

   echo"<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse\" width=\"100%\">";
   echo"<tr>";
   echo"<td width=\"100%\" background=\"themes/".$theme_name."/footer/nukestyle-ft_lt.png\">";
   echo"<IMG SRC=\"themes/".$theme_name."/footer/nukestyle-ft_01.png\" WIDTH=20 HEIGHT=173>";
   echo"</td>";
   echo"<td width=\"100%\">";
   echo"<IMG SRC=\"themes/".$theme_name."/footer/nukestyle-ft_05.png\" WIDTH=20 HEIGHT=173></td>";
   echo"</tr>";
   echo"</table>";
//   echo "</BODY>";
//   echo"</HTML>";
   echo "</body>\n"; 
   echo "</html>\n"; 
   echo "<center>";
   footmsg();

// 9/11 banner
/*
	  echo "<br /><font size=\"-1\" style=\"cursor: pointer; \"><img src=\"/upload/upu/files/ribbon-black_68.png\" title=\"Remembering 9/11\" alt=\"Remembering 9/11\" style=\"vertical-align:middle\">
<a href=\"http://googleblog.blogspot.com/2011/09/ten-years-later.html\">Remembering September 11th</a></font>";	  
*/
   echo "</center>";
}

/************************************************************/
/* Function themeindex()                                    */
/* This function format the stories on the Homepage         */
/************************************************************/
function themeindex ($aid, $informant, $time, $title, $counter, $topic, $thetext, $notes, $swf, $suspect, $morelink, $topicname, $topicimage, $topictext) 
{
  global $anonymous, $tipath, $theme_name, $sid, $domain, $name;

    $ThemeSel = get_theme();
    
   //facbook fix
    if ($name == "Music")
    $name="Music";
    else
    $name="News";
    //facbook fix
		
	if(!empty($topicimage)) { if (file_exists("themes/$ThemeSel/images/topics/$topicimage")){ $t_image = "themes/$ThemeSel/images/topics/$topicimage";}
	else 
	{$t_image = "$tipath$topicimage";}$topic_img = "<a href=\"modules.php?name=".$name."&amp;new_topic=".$topic."\"><img src=\"".$t_image."\" border=\"0\" alt=\"$topictext\" /></a>";} 
	else {$topic_img = "";}
	
	if (!empty($notes)){$notes = "<br /><br /><strong>"._NOTE."</strong> $notes\n";}else{$notes = "";}

	//TheGhost added Mug Shot/Art work
    if ($suspect =='none.gif'){$suspect = "<hr>";}
	else
	if (($suspect == 'ernieonbikewithangelwings03.png')
	or ($suspect == 'Image12.png')
	or ($suspect == 'JAmie-Lynn02.png')
	or ($suspect == 'gun.jpg'))
	{$suspect = "<hr /><center><img src=\"http://".$domain."/upload/upu/files/$suspect\" width=\"640\"></center><hr />";}
	else{$suspect = "<hr /><center><NO RESIZE><img src=\"http://".$domain."/upload/upu/files/$suspect\"></NO RESIZE></center><hr />\n";}

	$content = '';

    if ($aid == $informant){$content = "$thetext$notes\n";}
	else{if(defined('WRITES')){if(!empty($informant)){if(is_array($informant)){$content = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant[0]\">$informant[1]</a> ";}else{$content = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant\">$informant</a> ";}}else{$content = "$anonymous ";}$content .= _WRITES." \"$thetext\"$notes\n";}else{$content .= "$thetext$notes\n";}}

    $posted = _POSTEDBY." ";
    $posted .= get_author($aid);
    $posted .= " "._ON." $time  ";
    $datetime = substr($morelink, 0, strpos($morelink, "|") - strlen($morelink));
    $morelink = substr($morelink, strlen($datetime) + 2);
	
    ?>  
    <table class="otthree"border="0" width="100%" cellspacing="0" cellpadding="0">
    <tr>
    <td background="themes/<?=$theme_name?>/tables/OpenTable/topmiddle.png" align="left" width="39" colspan="2">
    <img src="themes/<?=$theme_name?>/tables/OpenTable/leftcorner.png" width="39" height="50"></td>
    <td background="themes/<?=$theme_name?>/tables/OpenTable/topmiddle.png" align="center" width="100%"><font color="#FFFFFF"><strong><?=$topictext?></strong></font></td>
    <td background="themes/<?=$theme_name?>/tables/OpenTable/topmiddle.png" align="right" width="39" colspan="2">
    <img src="themes/<?=$theme_name?>/tables/OpenTable/rightcorner.png" width="39" height="50"></td>
    </tr>
    <tr>
    <td width="15" background="themes/<?=$theme_name?>/tables/OpenTable/leftside.png"></td>
    <td width="24"></td>
    <td width="100%">
    
    <strong>.::[</strong> <strong>Topic</strong> &raquo; <a href="modules.php?name=<?=$name?>&amp;new_topic=<?=$topic?>"><font color="#CC0000"><?=$topictext?></font><strong></a> Title</strong> &raquo; <font color="#CC0000"><?=$title?> </font><strong>]::.
    </strong><br />
    <strong>.::[</strong> <?=$posted?> <strong>]::.</strong><br />
    <?=$suspect?>
    <?=$content?>
	<?
  
      if ($swf == "none.swf")
      {


	  }
      else
      {
		global $name, $op;
		
		
		if (($name == 'Music') or ($op == 'EditMusic'))
		{
			  
       ?>
       <center>
       
		<script type='text/javascript' src='js/jwplayer.js'></script>
 
        <div id='mediaspace'>This text will be replaced</div>
 
        <script type='text/javascript'>
        jwplayer('mediaspace').setup({
        'flashplayer': 'players/player.swf',
        'file': 'players/videos/flv/<?=$swf?>',
		'image': 'players/videos/slides/<?=$swf?>.png',
		'controlbar': 'bottom',
        'width': '640',
        'height': '480'
        });
        </script>      
	    
		</center>
		<?
		 
		}
		else
		{
	   //this class is loaded in the header and only needs to load once	  
       /************************************************************/
       /* SWF Header Class                                         */
       /************************************************************/
       require_once(NUKE_CLASSES_DIR.'class.swfheader.php');
       /************************************************************/
       /* SWF Header Class                                         */
       /************************************************************/
  	   echo "<hr /><center>";

  	   $newswf = new swfheader(false) ;
       $newswf->loadswf("upload/upu/files/$swf") ;
       $newswf->display($trans);  

       echo "<br /><br />";
	   echo "If the above Flash Paper is not visible, please update the site cache</span> <a class=\"underline\" href=\"javascript:clear_cache.submit()\">" . _UPDATECACHE . "</a>";
	   
   	   echo "</center>";
	   

	   }        
		
	   
		?>
       
        <?
      }
    
	echo"<hr />";
    echo "<script src=\"http://connect.facebook.net/en_US/all.js#xfbml=1\"></script>";
  ?>
</center>

<div id="fb-root"></div>
<center>
<fb:like href="<?=$domain?>/modules.php?name=<?=$name?>&file=article&sid=<?=$sid?>&mode=0&thold=-1" data-colorscheme="light" send="true" width="640" show_faces="true" font="tahoma"></fb:like>
<br />
<fb:comments href="<?=$domain?>/modules.php?name=<?=$name?>&file=article&sid=<?=$sid?>&mode=0&thold=-1" data-colorscheme="light" send="true" width="640" show_faces="true" font="tahoma">
</fb:comments></center>



<hr>
    <strong><font class="option" color="#000000">.::[</font></strong> <font class="option" color="#cc0000">( <font class="option" color="#000000">This message has been read</font> <b><?=$counter?></b> <font class="option" color="#000000">times</font> ) </font><strong><font class="option" color="#000000">]::.</font></strong><br />
    <strong><font class="option" color="#000000">.::[</font></strong> <?=$datetime?>) (<b><font class="option" color="#000000"><?=$title?></font></b> <?=$morelink?></font> <strong><font class="option" color="#000000">]::.</font></strong>


<?

CloseTable();
}
/************************************************************/
/* Function themearticle()                                  */
/************************************************************/
function themearticle ($aid, $informant, $datetime, $title, $thetext, $topic, $topicname, $topicimage, $topictext, $swf, $suspect) 
{
    global $admin, $sid, $tipath, $theme_name, $domain, $name;

    $ThemeSel = get_theme();
    
	$posted = _POSTEDON." $datetime "._BY." ";
    $posted .= get_author($aid);
   
   //facbook fix
    if ($name == "Music")
    $name="Music";
    else
    $name="News";
    //facbook fix
    
	
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
	
	if (!empty($notes)) 
	{
        $notes = "<br /><br /><strong>"._NOTE."</strong> <i>$notes</i>\n";
    } 
	else 
	{
        $notes = '';
    }
    
	//Mug Shot
    if ( isset($_POST['file1']['filename']) && !empty($_POST['file1']['filename']) )  
    {
       $suspect = $_POST['file1']['filename'];
    } 

	//TheGhost added Mug Shot/Art work
    if ($suspect =='none.gif'){$suspect = "<hr>";}
	else
	if (($suspect == 'ernieonbikewithangelwings03.png')
	or ($suspect == 'Image12.png')
	or ($suspect == 'JAmie-Lynn02.png')
	or ($suspect == 'gun.jpg'))
	{$suspect = "<hr /><center><img src=\"http://".$domain."/upload/upu/files/$suspect\" width=\"640\"></center><hr />";}
	else{$suspect = "<hr /><center><NO RESIZE><img src=\"http://".$domain."/upload/upu/files/$suspect\"></NO RESIZE></center><hr />\n";}
	
    if ( isset($_POST['file2']['filename']) && !empty($_POST['file2']['filename']) )  
    {
       $swf = $_POST['file2']['filename'];
    } 
    else 
    {
      $swf = Fix_Quotes($swf);
    }

    $content = '';

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
	

    ?>  
    <table class="otthree"border="0" width="100%" cellspacing="0" cellpadding="0">
    <tr>
    <td background="themes/<?=$theme_name?>/tables/OpenTable/topmiddle.png" align="left" width="39" colspan="2">
    <img src="themes/<?=$theme_name?>/tables/OpenTable/leftcorner.png" width="39" height="50"></td>
    <td background="themes/<?=$theme_name?>/tables/OpenTable/topmiddle.png" align="center" width="100%"><font color="#FFFFFF"><strong><?=$topictext?></strong></font></td>
    <td background="themes/<?=$theme_name?>/tables/OpenTable/topmiddle.png" align="right" width="39" colspan="2">
    <img src="themes/<?=$theme_name?>/tables/OpenTable/rightcorner.png" width="39" height="50"></td>
    </tr>
    <tr>
    <td width="15" background="themes/<?=$theme_name?>/tables/OpenTable/leftside.png"></td>
    <td width="24"></td>
    <td width="100%">
    
    <strong>.::[</strong> <strong>Topic</strong> &raquo; <a href="modules.php?name=<?=$name?>&amp;new_topic=<?=$topic?>"><font color="#CC0000"><?=$topictext?></font><strong></a> Title</strong> &raquo; <font color="#CC0000"><?=$title?> </font><strong>]::.
    </strong><br />
    <strong>.::[</strong> <?=$posted?> <strong>]::.</strong><br />
    <?=$suspect?>
	<?=$content?>
    
	<?

      if ($swf == "none.swf")
      {
        echo "<hr />";
	  }
      else
      {
		global $name, $op;
		
		if (($name == 'Music') or ($op == 'EditMusic'))
		{
       ?>
        <center>
       
		<script type='text/javascript' src='js/jwplayer.js'></script>
 
        <div id='mediaspace'>This text will be replaced</div>
 
        <script type='text/javascript'>
        jwplayer('mediaspace').setup({
        'flashplayer': 'players/player.swf',
        'file': 'players/videos/flv/<?=$swf?>',
		'image': 'players/videos/slides/<?=$swf?>.png',
		'controlbar': 'bottom',
        'width': '640',
        'height': '480'
        });
        </script>      

		</center>

	    <?
        		}
		else
		{
	   //this class is loaded in the header and only needs to load once	  
       /************************************************************/
       /* SWF Header Class                                         */
       /************************************************************/
       require_once(NUKE_CLASSES_DIR.'class.swfheader.php');
       /************************************************************/
       /* SWF Header Class                                         */
       /************************************************************/
  	   echo "<hr /><center>";
	   
	   $newswf = new swfheader(false) ;
       $newswf->loadswf("upload/upu/files/$swf") ;
       $newswf->display($trans);  

       echo "<br /><br />";
	   echo "If the above Flash Paper is not visible, please update the site cache</span> <a class=\"underline\" href=\"javascript:clear_cache.submit()\">" . _UPDATECACHE . "</a>";
	   
   	   echo "</center>";

	   }        
	
		
		
		echo"<hr />";
        echo "<script src=\"http://connect.facebook.net/en_US/all.js#xfbml=1\"></script>";
	  }
?>
</center>
    

<div id="fb-root"></div>
<center>
<fb:like href="<?=$domain?>/modules.php?name=<?=$name?>&file=article&sid=<?=$sid?>&mode=0&thold=-1" data-colorscheme="light" send="true" width="640" show_faces="true" font="tahoma"></fb:like>
<br />
<fb:comments href="<?=$domain?>/modules.php?name=<?=$name?>&file=article&sid=<?=$sid?>&mode=0&thold=-1" data-colorscheme="light" send="true" width="640" show_faces="true" font="tahoma"></fb:comments>
</center>


</td>
<?
CloseTable();
}


function themecenterbox($title, $content) 
{
    OpenTable();
    echo '<center><span class="option"><strong>'.$title.'</strong></span></center><br />'.$content;
    CloseTable();
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
   global $theme_name;

   echo"<style type=\"text/css\">"
     . "<!--"
     . ".style1 {"
     . "color: #FFFFFF;"
     . "font-weight: bold;"
     . "}"
     . "-->"
     . "</style>"
     . "<table class=block cellSpacing=\"0\" cellPadding=\"0\" border=\"0\" width=\"249\">"
     . "<tr>"
     . "<td background=\"themes/$theme_name/tables/OpenTable/topmiddle.png\">"
     . "<img src=\"themes/$theme_name/tables/OpenTable/leftcorner.png\" border=\"0\" width=\"39\" height=\"50\"></td>"
     . "<td width=\"195\" align=\"center\" background=\"themes/$theme_name/tables/OpenTable/topmiddle.png\"><span class=\"style1\">$title</span></td>"
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
     . "<td width=\"195\">"



     . "$content"         
	 . "</td>"
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
     . "<td width=\"195\" height=\"27\" background=\"themes/$theme_name/tables/CloseTable/bottommiddle.png\">        </td>"
     . "<td width=\"39\" height=\"27\">"
     . "<img src=\"themes/$theme_name/tables/CloseTable/bottomrightcorner.png\" border=\"0\" width=\"39\" height=\"52\"></td>"
     . "</tr>"
     . "</table>"
     . "<br>";
}
?>