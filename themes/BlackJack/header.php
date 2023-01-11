<?php
#-----------------------------#
# Fixed & Full Width Style    #
#-----------------------------#
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) 
exit('Access Denied');

global $locked_width,
         $screen_res, 
         $textcolor1, 
	     $textcolor2, 
	       $bgcolor1,
		   $bgcolor2,
		   $bgcolor3,
		   $bgcolor4,
		   $bgcolor5,  
		   $sitename, 
		     $slogan, 
		       $name, 
		    $banners, 
		         $db, 
	    $user_prefix, 
	         $prefix, 
	     $admin_file, 
	       $userinfo, 
		  $ThemeInfo,
   $titanium_browser, 
	     $theme_name;


echo "\n<!-- BLACKJACK THEME HEADER START -->\n"; 

# Check if a Registered User is Logged-In
$username = is_user() ? $userinfo['username'] : _ANONYMOUS;

$theuser = '';
$scrollmsg = '';
$moreuser_info = '';
$marquee_one = '';
$date = '';

if(!isset($appID))
$appID = '';

# Setup the Welcome Information for the User
if ($username === _ANONYMOUS)
{
   $theuser  = '<div align="center">Please <a href="modules.php?name=Your_Account"><u>Login</u></a> or <a href="modules.php?name=Your_Account&amp;op=new_user"><u>Register</u></a>&nbsp;&nbsp;</div>';
   $theuser .= '<div align="center" id="locator">Monitor Resolution '.$screen_res.'</div>';
   $newmessages = 'Please <a href="modules.php?name=Your_Account"><u>Login</u></a> or <a href="modules.php?name=Your_Account&amp;op=new_user"><u>Register</u></a>';
}
else
{
    if(intval($userinfo['user_new_privmsg']) == 1 )
	{
	  $theuser  .= '<div align="center" id="theuser"><strong>';
      $theuser  .= sprintf(_YOUHAVE_1_MSGS,'(<a href="modules.php?name=Private_Messages">'.has_new_or_unread_private_messages().'</a>)');
	  $theuser  .= '</strong></div>';
	  $newmessages = sprintf(_YOUHAVE_1_MSGS,'(<a href="modules.php?name=Private_Messages">'.has_new_or_unread_private_messages().'</a>)');
	}
	else
	if(intval($userinfo['user_new_privmsg']) > 1 )
	{
	  $theuser  .= '<div align="center" id="theuser"><strong>';
	  $theuser  .= sprintf(_YOUHAVE_X_MSGS,'(<a href="modules.php?name=Private_Messages">'.has_new_or_unread_private_messages().'</a>)');
	  $theuser  .= '</strong></div>';
	  $newmessages = sprintf(_YOUHAVE_X_MSGS,'(<a href="modules.php?name=Private_Messages">'.has_new_or_unread_private_messages().'</a>)');
	}
	else
	{
	  $theuser  .= '<div align="center" id="theuser"><strong>';
	  $theuser  .= sprintf(_YOUHAVE_NO_MSGS,'(<a href="modules.php?name=Private_Messages">'.has_new_or_unread_private_messages().'</a>)');
      $theuser  .= '<div align="center" id="resolution">Monitor Resolution '.$screen_res.'</div>';
	  $theuser  .= '</strong></div>';
	  $newmessages = sprintf(_YOUHAVE_NO_MSGS,'(<a href="modules.php?name=Private_Messages">'.has_new_or_unread_private_messages().'</a>)');
	}
}

#chrome canary 64bit 91.0.4446.3 NIGHTLY BUILDS
if($titanium_browser->getBrowser() == Browser::BROWSER_CHROME && $titanium_browser->getVersion() == '109.0.0.0') // Chrome Canary Last Version for Windows 7 / 8.1 (x64bit) version as of 11/19/2022
$scrollmsg .= "<img align=\"absmiddle\" height=\"15\" src=\"images/browsers/current-channel-logo@1x.png\" alt=\"Browser\" title=\"Browser\"> <strong>Thanks for using Chrome Canary (64-bit)... We are glad you keep up with the times! You have been updating your browser and now unfortunately you must update your OS. This is the last release verion of Chrome that will work on Windows 7 and Windows 8.1 - It;s been fun and we wanted windows 7 to last forever but it's not going to happen... Windows 7 was our friend to the END!~!~!</strong>";

#chrome canary 64bit 91.0.4446.3 NIGHTLY BUILDS
if($titanium_browser->getBrowser() == Browser::BROWSER_CHROME && $titanium_browser->getVersion() == '110.0.0.0' || $titanium_browser->getVersion() == '111.0.0.0') // Chrome Canary (x64bit) version as of 11/19/2022
$scrollmsg .= "<img align=\"absmiddle\" height=\"15\" src=\"images/browsers/current-channel-logo@1x.png\" alt=\"Browser\" title=\"Browser\"> <strong>Thanks for using Chrome Canary (64-bit)... We are glad you keep up with the times! Google Chrome Canary is primarily an untested nightly build version of the most awesome badass browser that ever existed, Google MFn Chrome. Developers like (TheGhost) and early tech adopters, want to experience and test for bugs or any new updates that might have been added to the latest versions of Chrome.</strong>";

if($titanium_browser->getBrowser() == Browser::BROWSER_CHROME && $titanium_browser->getVersion() == '89.0.4389.114') // Chrome (x64bit) version as of 3/5/2021
$scrollmsg .= "<img align=\"top\" height=\"16\" src=\"https://www.chromium.org/_/rsrc/1302286290899/chromium-projects/chrome-32.png?height=32&width=32 alt=\"Browser\" title=\"Browser\"> <strong>Thanks for using Chrome, you have great taste... Chrome is the #1 browsing solution in the world! When you are using Chrome it doesnt get any better!</strong>";

if($titanium_browser->getBrowser() == Browser::BROWSER_EDGE && $titanium_browser->getVersion() == '107.0.1418.52') // MicroSoft Edge (x64bit) version as of 11/19/2022
$scrollmsg .= "<img align=\"absmiddle\" height=\"16\" src=\"images/browsers/microsoft.png\" alt=\"Browser\" title=\"Browser\"> <strong>Thanks for using Microsoft Edge (64-bit), Looks like Microsoft finally pulled their head out of their ass! TheGhost always said that sooner or later Microsoft would slide into the Chromium engine and shit can that piece of garbage they called Microsoft Explorer... They have come a long way but Bing Search sucks almost as bad as Yahoo search and they will always be a bunch of money grubbing end-user fucking pieces of shit!!! I understand, they have been trying to force their shit browser on millions of people for many years. I see you gave in... I guess you got tired of Windows asking you over and over again to change your default browser? We will pray for you next sunday in church... We heard Bill Gates fucked a goat, don't know how much thruth there is to that but his wife left him. The goats name was Nicholas and his wife said he should just marry the goat since he loved it so much!! xXxXx This website was hacked by HiJacker xXxXx</strong>";

if($titanium_browser->getBrowser() == Browser::BROWSER_EDGE && $titanium_browser->getVersion() == '108.0.1462.20') // MicroSoft Edge (x64bit) Beta as of 11/19/2022
$scrollmsg .= "<img align=\"absmiddle\" height=\"16\" src=\"https://www.86it.us/images/browsers/edge-beta@1x.png\" alt=\"Browser\" title=\"Browser\"> <strong>Thanks for using Microsoft Edge Beta (64-bit),Looks like Microsoft finally got ot together! TheGhost always said that sooner or later Microsoft would slide into the Chromium engine and shit can that piece of garbage they called Microsoft Explorer... They have come a long way but Bing Search is not good almost as bad as Yahoo search and they will always be a bunch of money grubbing end-user fn' pieces of s**t!!! I understand, they have been trying to force their s**t browser on millions of people for many years. I see you gave in... I guess you got tired of Windows asking you over and over again to change your default browser? We will pray for you next sunday in church...</strong>";

if($titanium_browser->getBrowser() == Browser::BROWSER_CHROME && $titanium_browser->getVersion() == '107.0.0.0') // Chrome Official Release (x64bit) as of 11/19/2022
$scrollmsg .= "<img align=\"top\" height=\"16\" src=\"images/browsers/chrome-transparent.png\" alt=\"Browser\" title=\"Browser\"> <strong>Thanks for using Chrome, you have great taste... Chrome is the #1 browsing solution in the world! When you are using Chrome it doesnt get any better! You made the superior choice and went with the latest and greatest!</strong>";

if($titanium_browser->getBrowser() == Browser::BROWSER_FIREFOX && $titanium_browser->getVersion() == '108.0') // Official FireFox Release - WAS BROKEN BY THE DEVELOPERS 9/21/2017 and now 11/19/2022 it's halfway decent!
{
$scrollmsg .= '<img src="images/browsers/mozilla-firefox-icon-15.png" align="top" height="16"><strong>Thanks for using FireFox (64bit) <span 
class="blink-one">BEWARE!</strong></span> Firfox sometimes breaks websites. There has been a lot of discussion lately about the decline of the Firefox browser and numerous articles about it losing 50 Million users in the last two years. But the real decline has been over the last 12 years with a total loss of half a Billion users and 75% of the market share it once held. Are screen shot utils and text to speech worth it?? Some say No!';
}

if($titanium_browser->getBrowser() == Browser::BROWSER_OPERA && $titanium_browser->getVersion() == '93.0.0.0') // Official Opera Release -  11/19/2022
{
$scrollmsg .= '<img src="images/browsers/opera.png" align="top" height="16"> Thanks for using Opera (64bit)  <span 
class="blink-one">Opera Rocks!</span> ::: This browser is hauling ass and about to catch up with Chrome... :::';
}

$scrollmsg .= ' Ezekiel 25,17. "The path of the righteous man is beset of all sides by the iniquities of the selfish and the tyranny of evil men. Blessed is he who, in the name of the charity and goodwill, shepherds the weak through the valley of darkness, for he is truly his brother’s keeper and the finder of lost children. And I will strike down upon thee with great vengeance and furious anger those who attempt to poison and destroy my brothers. And you will know my name is the Lord when I lay my vengeance upon thee.” ::: ';

$scrollmsg .= 'The current Beta release of PHP-Nuke Titanium is v'.NUKE_TITANIUM.' and we are running on PHP v'.PHPVERS.' ::: ';

//$detect = new Mobile_Detect;
$detect = new \Detection\MobileDetect;

if($detect->version('Windows NT'))
$scrollmsg .= 'It\'s nice to see you using Windows v'.$detect->version('Windows NT').' :::';

global $connected;

$moreuser_info .= '';
$moreuser_info .= '';


//if($titanium_browser->getBrowser() == Browser::PLATFORM_WINDOWS && $titanium_browser->version() == '10.0'):
// $scrollmsg .= 'HERE WINDOWS 10 HERE'; 
//endif; 

# check to see if user is logged into facebook
if(isset($_COOKIE['fbsr_' . $appID])):
$marquee_one .= ' Thanks for taking the time to login to our facebook app now you will be able to use the like and comments sections of this web portal...';
else:
$marquee_one .= ' login to our facebook app and you will be able to use the like and comments sections of this web portal...';
endif;
global $board_config;
$serverdate = FormatDate($board_config['default_dateformat'], time(), $board_config['board_timezone']);

$date .= '::: <span style=color:orange> QUOTE OF THE DAY “If you don\'t want to do something, you\'ll find an excuse. If you really do, you\'ll find a way.” Open-Source for Life ❤️️ ~ Tomas Votruba</span> ::: Today is <span style="color:'.$textcolor2.'">'.$serverdate.'</span>';

if ($username === _ANONYMOUS)
$moreuser_info .= '::: <span style=color:pink>There is so much more here to see, it takes 30 seconds to register an account and we don\'t even verify with e-mail! Just register we promise you won\'t be sorry...</span>';

if ($username === _ANONYMOUS)
$marquee_one = $moreuser_info.' ::: <span style="color:'.$textcolor2.'>Your Monitor Resolution is '.$screen_res.'</span> ::: '.$newmessages.'';
else
$marquee_one = $date.' '.$connected.' Welcome back <strong><span class="blink-one" style="color:'.$textcolor2.'">'.$username.'</span></strong> It\'s quite awesome to see you my friend! We are so glad you could make it back over to visit... We all have busy schedules, Thanks for stopping in to say hello 😉 ::: <span style="color:'.$textcolor2.'">'.$newmessages.'</span> ::: Your current Monitor Resolution is <span style="color:'.$textcolor2.'">'.$screen_res.'</span> '.$moreuser_info.' ::: Your current browser version is <span style="color:'.$textcolor2.'">'.$titanium_browser->getVersion().'</span> ::: '.$scrollmsg.'';

//$bullshit2 = 'Sept 28th 2019, Oct 4th 2019, Oct 5th 2019, Oct 11th 2019, Oct 13th 2019, Oct 14th 2019 Oct 20th 2019, Oct 22nd 2019, Oct 24th 2019';
# right finger
$lfinger = '<img border="0" align="absmiddle" height="16" src="themes/'.$theme_name.'/images/finger-pointing-left-icon.png" alt="Look at this!" title="Look at this!">';
$rfinger = '<img border="0" align="absmiddle" height="16" src="themes/'.$theme_name.'/images/finger-pointing-right-icon.png" alt="Look at this!" title="Look at this!">';

$marquee_two = '
               <strong>IPHub is an IP lookup website featuring Proxy/VPN detection. 
			   A free API is available, so you can perform fraud checks on online stores, 
			   detect malicious players on online games and much more! <a href="https://iphub.info" target="new">'.$rfinger.' Click here '.$lfinger.' to sign up for FREE today at ipHub</a></strong>
              <strong>::: <span style="color:'.$textcolor2.'"><a href="https://soulcircuscowboys.com" target="_blank">Country Music: The Soul Circus Cowboys</a></span></strong>
              <strong>::: <span style="color:'.$textcolor2.'"><a href="https://facebook.com/brandon.maintenance" target="_blank">Sponsor: Brandon Maintenance Management, LLC Phone: 813-846-2865</a></span></strong>
              <strong>::: <span style="color:'.$textcolor2.'"><a href="https://bigcountryradio.net" target="_blank">Sponsor: Big Country Radio - The EJ Morning Show</a></span> :::</strong>';

# This is where we set the poster background and full screen video START
//echo '<div class="fullscreen-bg">'."\n";
# echo '<video muted loop autoplay poster="themes/'.$theme_name.'/blackjack/main_background/black_background.png" class="fullscreen-bg__video">'."\n";
# echo '<source src="themes/'.$theme_name.'/video/aqua_fresh.mp4" type="video/mp4">'."\n"; ### 1 to 10  This is a 10 ### BEST SO FAR
# echo '</video>'."\n";
//echo '</div>'."\n";
# This is where we set the poster background and full screen video END

# This is the flex container used to resize the layout START
echo '<section id="flex-container">'."\n";
//echo '<div class="container" style="width: '.theme_width.'">';
echo '<div class="container" style="width: '.$locked_width.'">'."\n";

echo '<div align="center">';
# space at the top of the page
//echo '<div style="padding-top:6px;"></div>'."\n";

# This stays always
//echo '<table class="header_table_opacity">'."\n"; # opacity overlay table START (end is in theme footer) 
//echo '<tr>'."\n";                                 # opacity overlay table START (end is in theme footer) 
//echo '<td>'."\n";                                 # opacity overlay table START (end is in theme footer) 

# add the top of your tabel here
echo "\n<!-- HEADER (START)-->\n";

echo '<table class="table1859">';
echo '  <tr>';
echo '<!-- PHP-Carterfone Shim row, height 1. -->'.PHP_EOL;
echo '   <td><img src="themes/'.$theme_name.'/blackjack/main_background/spacer.gif" width="29px" height="1px" alt=""></td>'.PHP_EOL;
echo '   <td><img src="themes/'.$theme_name.'/blackjack/main_background/spacer.gif" width="23px" height="1px" alt=""></td>'.PHP_EOL;
echo '   <td><img src="themes/'.$theme_name.'/blackjack/main_background/spacer.gif" width="13px" height="1px" alt=""></td>'.PHP_EOL;
echo '   <td><img src="themes/'.$theme_name.'/blackjack/main_background/spacer.gif" width="1725px" height="1px" alt=""></td>'.PHP_EOL;
echo '   <td><img src="themes/'.$theme_name.'/blackjack/main_background/spacer.gif" width="10px" height="1px" alt=""></td>'.PHP_EOL;
echo '   <td><img src="themes/'.$theme_name.'/blackjack/main_background/spacer.gif" width="31px" height="1px" alt=""></td>'.PHP_EOL;
echo '   <td><img src="themes/'.$theme_name.'/blackjack/main_background/spacer.gif" width="28px" height="1px" alt=""></td>'.PHP_EOL;
echo '   <td><img src="themes/'.$theme_name.'/blackjack/main_background/spacer.gif" width="1px" height="1px" alt=""></td>'.PHP_EOL;
echo '  </tr>'.PHP_EOL;

echo '  <tr><!-- PHP-Carterfone row 1 -->'.PHP_EOL;
echo '   <td class="TopLeftCorner" rowspan="4"></td>'.PHP_EOL;
echo '   <td colspan="6"><img name="page_template_r1_c2" src="themes/'.$theme_name.'/blackjack/main_background/PHP-CarterPhone_top_middle_06.png" width="1830" height="33" alt=""></td>'.PHP_EOL;
echo '   <td><img src="themes/'.$theme_name.'/blackjack/main_background/spacer.gif" width="1" height="33" alt=""></td>'.PHP_EOL;
echo '  </tr>'.PHP_EOL;

echo '  <tr><!-- PHP-Carterfone row 2 -->'.PHP_EOL;
echo '   <td><img name="page_template_r2_c2" src="themes/'.$theme_name.'/blackjack/main_background/page_template_r2_c2.png" width="23" height="22" alt=""></td>'.PHP_EOL;

echo '   <td class="td1748" rowspan="2" colspan="3">'.PHP_EOL;

//echo '<div id="#header" style="padding-top: 16px;">'.ads(0).'</div>'."\n";

echo '<table class="table100">'.PHP_EOL;
echo '<tr>'.PHP_EOL;

echo '<td align="center" class="bannerLeftSide" height="auto" width="33.3%"><div align="left">'.ads(0).'</div>'.PHP_EOL;
echo ''.PHP_EOL;
echo '</td>'.PHP_EOL;

echo '<td class="stacklogos" valign="top">'.PHP_EOL;
echo '<div align="center" style="padding-top: 10px; vertical-align: top;">'.PHP_EOL;
echo '<a href="https://github.com/ernestbuffington/PHP-Nuke.Titanium.Dev.4" target="_blank"><img class="hover_effect" width="64" src="images/brands/png/github-active.png" /></a>&nbsp;&nbsp;'.PHP_EOL;
echo '<a href="https://3v4l.org/kuLmD#v7.4.33" target="_blank"><img class="hover_effect" width="64" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-plain.svg" /></a>'.PHP_EOL;
echo '<a href="https://html-css-js.com/html/generator/" target="_blank"><img class="hover_effect" width="64" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-original.svg" /></a>'.PHP_EOL;
echo '<a href="https://html-css-js.com/css/generator/" target="_blank"><img class="hover_effect" width="64" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/css3/css3-original.svg" /></a>'.PHP_EOL;
echo '<a href="https://mariadb.com/resources/blog/developer-quickstart-php-mysqli-and-mariadb/" target="_blank"><img class="hover_effect" width="64" src="images/brands/svg/mariadb_white.svg" /></a>'.PHP_EOL;
echo '<a href="https://htmlcheatsheet.com/js/" target="_blank"><img class="hover_effect" width="64" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/java/java-original-wordmark.svg" /></a>'.PHP_EOL;
echo '<a href="https://framework.zend.com/downloads" target="_blank"><img class="hover_effect" width="64" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/zend/zend-plain-wordmark.svg" /></a>&nbsp;&nbsp;'.PHP_EOL;
echo '<a href="https://htmlcheatsheet.com/jquery/" target="_blank"><img class="hover_effect" width="64" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/jquery/jquery-plain-wordmark.svg" /></a>'.PHP_EOL;
echo '<div align="center" style="padding-top: 10px; vertical-align: top;"></div>'.PHP_EOL;
//include(theme_dir.'css3_menu.php');
echo '</div>'.PHP_EOL;
echo '</td>'.PHP_EOL;

echo '<td align="center" class="bannerRightSide" height="auto" width="33.3%"><div align="right">'.network_ads(0).'</div>'.PHP_EOL;
echo '</td>'.PHP_EOL;

echo '<tr><td style="height: 23px !important; width: 33.3%;"><div class="above_marquee_one" align="center">PHP-Nuke Titanium v'.NUKE_TITANIUM.' / PHP v'.PHPVERS.'</div></td>'.PHP_EOL;
echo '<td style="height: 23px !important; width: 33.3%;"><div align="center"></div></td>'.PHP_EOL;
echo '<td style="height: 23px !important; width: 33.3%;"><div class="above_marquee_two" align="center">Sponsor Tron for PHP-Nuke Titanium</div></td></tr>'.PHP_EOL;

# marquees for left and right side
echo '<tr><td style="height: 23px !important; width: 33.3%;"><div align="center" class="marquee_one">'.$marquee_one.'</div></td>'.PHP_EOL;
echo '<td style="height: 23px !important; width: 33.3%;">'.PHP_EOL;
include(theme_dir.'css3_menu.php');
echo '</td>'.PHP_EOL;
echo '<td style="height: 23px !important; width: 33.3%;"><div align="center" class="marquee_two">'.$marquee_two.'</div></td></tr>'.PHP_EOL;

echo '</tr>'.PHP_EOL;
echo '</table>'.PHP_EOL;



echo '</td>'.PHP_EOL; # OPEN HEADER AREA

echo '   <td><img name="page_template_r2_c6" src="themes/'.$theme_name.'/blackjack/main_background/PHP-CarterPhone_the_missing_piece_03.png" width="31" height="22" alt=""></td>'.PHP_EOL;

echo '   <td rowspan="3"><img name="page_template_r2_c7" src="themes/'.$theme_name.'/blackjack/main_background/PHP-CarterPhone_top_right_corner_08.png" width="28" height="183" alt=""></td>'.PHP_EOL;

echo '   <td><img src="themes/'.$theme_name.'/blackjack/main_background/spacer.gif" width="1" height="22" alt=""></td>'.PHP_EOL;
echo '  </tr>'.PHP_EOL;

echo '  <tr><!-- PHP-Carterfone row 3 -->'.PHP_EOL;
echo '   <td><img name="page_template_r3_c2" src="themes/'.$theme_name.'/blackjack/main_background/page_template_r3_c2.png" width="23" height="134" alt=""></td>'.PHP_EOL;

echo '   <td><img name="page_template_r3_c6" src="themes/'.$theme_name.'/blackjack/main_background/page_template_r3_c6.png" width="31" height="134" alt=""></td>'.PHP_EOL;

echo '   <td><img src="themes/'.$theme_name.'/blackjack/main_background/spacer.gif" width="1" height="134" alt=""></td>'.PHP_EOL;
echo '  </tr>'.PHP_EOL;

echo '  <tr><!-- PHP-Carterfone row 4 -->'.PHP_EOL;

echo '   <td class="td1802" colspan="5"></td>'.PHP_EOL;

echo '   <td><img src="themes/'.$theme_name.'/blackjack/main_background/spacer.gif" width="1" height="27" alt=""></td>'.PHP_EOL;
echo '  </tr>'.PHP_EOL;

echo '  <tr><!-- PHP-Carterfone row 5 -->'.PHP_EOL;

echo '   <td id="pitch" class="td746LT"></td>'.PHP_EOL; # LEFT SIDE

echo '   <td class="td1802headerTD" colspan="5">'.PHP_EOL;


# space between header tabled and main page
echo "\n".'<div style="padding-top:20px;"></div>'."\n";

echo "<table width=\"100%\"  cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\">\n";
echo "<tr valign=\"top\">\n";
echo "<td valign=\"top\"></td>\n";
echo "<td style=\"padding-left: 6px;\" valign=\"top\">\n"; # set the space between the left side of the main body table and the blocks

if(blocks_visible('left')) 
{
  blocks('left');
  echo "</td>\n";
  # space between the left blocks and the left side of the center block
  echo "<td style=\"width: 26px;\" valign =\"top\"><img src=\"themes/".$theme_name."/images/invisible_pixel.gif\" alt=\"\" width=\"6\" height=\"0\" border=\"0\" /></td>\n";
  echo " <td width=\"100%\">\n";
} 
else  
{
  echo "</td>\n";
  echo " <td style=\"width: 1px;\" valign =\"top\"><img src=\"themes/".$theme_name."/images/invisible_pixel.gif\" alt=\"\" width=\"0\" height=\"0\" border=\"0\" /></td>\n";
  echo " <td width=\"100%\">\n";
}
echo "\n\n<!-- TITANIUM CORE THEME HEADER END -->\n"; 

?>
