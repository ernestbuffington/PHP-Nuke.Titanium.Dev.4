<?php
/*--------------------------*/
/* XtremeV3b Footer Section */
/*--------------------------*/
/* Fixed & Full Width Style */
/*--------------------------*/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) 
    exit('Access Denied');

global $appID, $customlang; 
global $locked_width, $theme_business, $theme_title, $theme_author, $theme_date, $theme_name, $theme_download_link;
echo '<!-- FOOTER START -->';
global 
	   $index, 
	    $user, 
	 $banners, 
	  $cookie, 
         $dbi, 
		  $db, 
	   $admin, 
   $adminmail, 
  $total_time, 
  $start_time, 
       $foot1, 
	   $foot2, 
	   $foot3, 
	   $foot4,
	   $foot5, 
	 $nukeurl, 
	      $ip, 
  $theme_name, 
   $ThemeInfo,
    $bgcolor4,
      $prefix;
	  
if(blocks_visible('right') && !defined('ADMIN_FILE')):
echo '</div>'
    .'  <div class="body-background" style="vertical-align: top;"><img src="'.xtremev3b_images_dir.'spacer.gif" style="width:5px; height:1px" border="0" alt=""></div>'
    .'  <div class="body-background" style="vertical-align: top">';
    blocks('right'); 
endif;

echo '</div>';
echo '<div style="background-image: url('.xtremev3b_images_dir.'sideright.png); vertical-align: top"><img src="'.xtremev3b_images_dir.'spacer.gif" style="width:40px; height:5px" alt=""></div>';
echo '</section>';

echo '<footer>';
    
echo '<section id="flex-container">';
echo '  <div class="flex-item"><img src="'.xtremev3b_ftr_images.'FTRbartop_01.png" style="width: 114px; height: 23px;"></div>';
echo '  <div class="flex-item" style="width: 100%; height: 23px; background-image: url('.xtremev3b_ftr_images.'FTRbartop_Bg_Stretch.png)"></div>';
echo '  <div class="flex-item"><img src="'.xtremev3b_ftr_images.'FTRbartop_03.png" style="width: 114px; height: 23px;"></div>';
echo '</section>';

echo '<section id="flex-container">';
echo '<div class="flex-item"><img src="'.xtremev3b_ftr_images.'FTR_01.png" style="width: 35px; height: 71px;"></div>';
echo '<div class="flex-item" style="width: 100%; height: 71px; background-image: url('.xtremev3b_ftr_images.'FTR_Bg_Stretch.png)">';
echo '<div align="left" style="line-height: 28px; padding-top:8px; padding-left:20px;">';

if(isset($appID)):
echo "\n<!-- START facebook connector status id -->\n";
echo '<div align="center" id="status">'."\n";
echo '</div>'."\n";
echo "<!-- END facebook connector status id -->\n\n";
endif;

echo '<span style="color: #F1F1F1">';
# START updated 09/12/2019 Ernest Allen Buffington
global $use_cache, $usrclearcache;
if($use_cache && $usrclearcache) 
{
  echo "<div align=\"center\"><form method='post' name='clear_cache' action='".$_SERVER['REQUEST_URI']."'>";
  echo "<input type='hidden' name='clear_cache' value='1'>";
  echo ""._SITECACHED . " <a href=\"javascript:clear_cache.submit()\">" . _UPDATECACHE . "</a>";
  echo "</form>";
  echo "</div>";
}
echo '<div align="center"><a class="tooltip-html copyright tooltipstered" href="#myCopyRight" data-toggle="modal" data-target="#myCopyRight"><u>Xtreme v3b © 2022</u></a></div>';
# END updated 09/12/2019 Ernest Allen Buffington
echo '</span></div>';

echo '</div>';

echo '<div class="flex-item"><img src="'.xtremev3b_ftr_images.'FTR_04.png" style="width: 35px; height: 71px;"></div>';
echo '</section>';
echo '<section id="flex-container">';
echo '<div class="flex-item"><img src="'.xtremev3b_ftr_images.'FTRbarbtm_01.png" style="width: 114px; height: 15px;"></div>';
echo '<div class="flex-item" style="width: 100%; height: 15px; background-image: url('.xtremev3b_ftr_images.'FTRbarbtm_Bg_Stretch.png)">';

echo '</div>';
echo '<div class="flex-item"><img src="'.xtremev3b_ftr_images.'FTRbarbtm_03.png" style="width: 114px; height: 15px;"></div>';
echo '</section>';

echo '</footer>';

echo '</div>';

if(is_admin()):
update_modules();
endif;

if(isset($appID)):
echo "\n<!-- START facebook connector -->\n";
echo '<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>'."\n";
echo "<!-- END facebook connector -->\n\n";
endif;
?>

