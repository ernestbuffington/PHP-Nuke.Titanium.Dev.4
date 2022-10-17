<?php
/*--------------------------*/
/* XtremeV3b Footer Section */
/*--------------------------*/
/* Fixed & Full Width Style */
/*--------------------------*/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) 
    exit('Access Denied');

global $appID, $customlang, $ThemeInfo, $banners;

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
  echo "</form></div>";
}

  echo "<div align=\"center\">";
  echo '<a class="copyright" href="javascript: void(0)" onclick="window.open(\''.xtremev3b_theme_dir.'copyrights.php\', \'windowname1\', \'width=800, height=500\'); return false;">';
  echo '<span class="tooltip-html" title="'.xtremev3b_copyright_click.'">Xtreme v3b Theme</span>';
  echo "</div>";

# END updated 09/12/2019 Ernest Allen Buffington
echo '</span></div>';

echo '</div>';

//echo '<div class="flex-item" style="width: 58px; height: 71px; background-image: url('.xtremev3b_ftr_images.'FTR_Copyright.png); padding-right: 40px;">';
//echo '<div style="padding-top:46px;">';
//echo '<a class="copyright" href="javascript: void(0)" onclick="window.open(\''.xtremev3b_theme_dir.'copyrights.php\', \'windowname1\', \'width=800, height=500\'); return false;">';
//echo '<span class="tooltip-html" title="'.xtremev3b_copyright_click.'"><font size="1">'.$customlang['global']['copyrights'].'</font></span>';
//echo '</a>';
//echo '</div>';
//echo '</div>';
echo '<div class="flex-item"><img src="'.xtremev3b_ftr_images.'FTR_04.png" style="width: 35px; height: 71px;"></div>';
echo '</section>';
echo '<section id="flex-container">';
echo '<div class="flex-item"><img src="'.xtremev3b_ftr_images.'FTRbarbtm_01.png" style="width: 114px; height: 15px;"></div>';
echo '<div class="flex-item" style="width: 100%; height: 15px; background-image: url('.xtremev3b_ftr_images.'FTRbarbtm_Bg_Stretch.png)">';

//echo '<div class="tooltip-html center" style="font-size: xx-small;" title="'.xtremev3_copyright.'"><span style="color: #141B05;">'.str_replace('<br />', ' ', xtremev3_copyright);
//echo '</span></div>';

echo '</div>';
echo '<div class="flex-item"><img src="'.xtremev3b_ftr_images.'FTRbarbtm_03.png" style="width: 114px; height: 15px;"></div>';
echo '</section>';

echo '</footer>';

echo '</div>';
    if (!empty($banners)):
        echo '<div class="center">'.ads(2).'</div>';
    endif;

    if ( is_admin() ):
        update_modules();
    endif;

if(isset($appID)):
echo "\n<!-- START facebook connector -->\n";
echo '<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>'."\n";
echo "<!-- END facebook connector -->\n\n";
endif;
?>

