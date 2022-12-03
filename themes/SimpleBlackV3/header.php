<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/
echo PHP_EOL.'<!-- Preload Logo Images START -->'.PHP_EOL;

echo PHP_EOL.'<link rel="preload" as="image" href="images/brands/png/github-active.png">'.PHP_EOL;
echo '<link rel="preload" as="image" href="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-plain.svg">'.PHP_EOL;
echo '<link rel="preload" as="image" href="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-original.svg">'.PHP_EOL;
echo '<link rel="preload" as="image" href="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/css3/css3-original.svg">'.PHP_EOL;
echo '<link rel="preload" as="image" href="images/brands/svg/mariadb_white.svg">'.PHP_EOL;
echo '<link rel="preload" as="image" href="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/java/java-original-wordmark.svg">'.PHP_EOL;
echo '<link rel="preload" as="image" href="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/jquery/jquery-plain-wordmark.svg">'.PHP_EOL;

echo PHP_EOL.'<!-- Preload Logo Images END -->'.PHP_EOL.PHP_EOL;
/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       09/29/2005
 ************************************************************************/
if(realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])):
  exit('Access Denied');
endif;

global $ThemeInfo, $sitename, $theme_name;

echo '<div align="center">';

echo '<table width="'. $ThemeInfo['sitewidth'].'" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor=""><tr><td>'.PHP_EOL;
echo '<table width="'. $ThemeInfo['sitewidth'].'" class="table100"><tr><td>'.PHP_EOL;
echo '<table width="'. $ThemeInfo['sitewidth'].'" class="table100">'.PHP_EOL;
echo '<tr>'.PHP_EOL;
echo '<td>'.PHP_EOL;

echo '<table width="'. $ThemeInfo['sitewidth'].'" class="table100">'.PHP_EOL;
echo '<tr>'.PHP_EOL;
echo '<td width="87"><img src="themes/'.$theme_name.'/images/hd/hd_01.png" width="87" height="20" alt="DFG"></td>'.PHP_EOL;
echo '<td style="width:1; height:20; background-image:url(themes/'.$theme_name.'/images/hd/hd_02.png)"><img src="themes/'.$theme_name.'/images/hd/hd_02.png" width="1" height="20" alt="DFG"></td>'.PHP_EOL;
echo '<td width="87"><img src="themes/'.$theme_name.'/images/hd/hd_04.png" width="87" height="20" alt="DFG"></td>'.PHP_EOL;
echo '</tr>'.PHP_EOL;
echo '</table>'.PHP_EOL;

echo '<table width="'. $ThemeInfo['sitewidth'].'" class="table100">'.PHP_EOL;
echo '<tr>'.PHP_EOL;
echo '<td width="42"><img src="themes/'.$theme_name.'/images/hd/hd_05.png" width="42" height="119" alt="DFG"></td>'.PHP_EOL;
//echo '<td width="144px" style="background-image:url(themes/'.$theme_name.'/images/hd/hd_06.png)" height="119">'.$content1.'</td>'.PHP_EOL;
//echo '<td width="11"><img src="themes/'.$theme_name.'/images/hd/hd_07.png" width="11" height="119" alt="DFG"></td>'.PHP_EOL;

$ads = ads(0);

if(empty($ads)): 
  echo '<td width="233"><img src="themes/'.$theme_name.'/images/hd/hd_08.png" width="233" height="119" alt="DFG"></td>'.PHP_EOL;
else: 
  echo '<td style="padding-left: 20px; background-image:url(themes/'.$theme_name.'/images/hd/hd_09.png)" width="233"><div style="padding-bottom: 4px;" align="right">'.$ads.'</div></td>'.PHP_EOL;
endif;

echo '<td class="header_logo" style="background-image:url(themes/'.$theme_name.'/images/hd/hd_09.png)" width="100%" valign="top">'.PHP_EOL;
echo '<a href="https://github.com/ernestbuffington/PHP-Nuke.Titanium.Dev.4" target="_blank"><img class="hover_effect" width="64" src="images/brands/png/github-active.png" /></a>&nbsp;&nbsp;'.PHP_EOL;
echo '<a href="https://3v4l.org/kuLmD#v7.4.33" target="_blank"><img class="hover_effect" width="64" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-plain.svg" /></a>'.PHP_EOL;
echo '<a href="https://html-css-js.com/html/generator/" target="_blank"><img class="hover_effect" width="64" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-original.svg" /></a>'.PHP_EOL;
echo '<a href="https://html-css-js.com/css/generator/" target="_blank"><img class="hover_effect" width="64" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/css3/css3-original.svg" /></a>'.PHP_EOL;
echo '<a href="https://mariadb.com/resources/blog/developer-quickstart-php-mysqli-and-mariadb/" target="_blank"><img class="hover_effect" width="64" src="images/brands/svg/mariadb_white.svg" /></a>'.PHP_EOL;
echo '<a href="https://htmlcheatsheet.com/js/" target="_blank"><img class="hover_effect" width="64" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/java/java-original-wordmark.svg" /></a>'.PHP_EOL;
echo '<a href="https://framework.zend.com/downloads" target="_blank"><img class="hover_effect" width="64" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/zend/zend-plain-wordmark.svg" /></a>&nbsp;&nbsp;'.PHP_EOL;
echo '<a href="https://htmlcheatsheet.com/jquery/" target="_blank"><img class="hover_effect" width="64" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/jquery/jquery-plain-wordmark.svg" /></a>'.PHP_EOL;
echo '</td>'.PHP_EOL;

$network_ads = network_ads(0);

if(empty($network_ads)): 
  echo '<td style="background-image:url(themes/'.$theme_name.'/images/hd/hd_09.png)"><img src="themes/'.$theme_name.'/images/hd/hd_09.png" width="1" height="119" alt="DFG"></td>'.PHP_EOL;
else: 
  echo '<td style="background-image: url(themes/'.$theme_name.'/images/hd/hd_09.png)"><div align="right"><div class="bannerRightSide" style="padding-bottom: 4px;">'.$network_ads.'</div></div></td>'.PHP_EOL;
endif;

echo '<td width="60"><img src="themes/'.$theme_name.'/images/hd/hd_11.png" width="60" height="119" alt="DFG"></td>'.PHP_EOL;
echo '</tr>'.PHP_EOL;
echo '</table>'.PHP_EOL;

echo '<table width="'. $ThemeInfo['sitewidth'].'" width="100%" border="0" cellspacing="0" cellpadding="0">'.PHP_EOL;
echo '<tr>'.PHP_EOL;
echo '<td width="87"><img src="themes/'.$theme_name.'/images/hd/hd_12_2.png" width="87" height="48" alt="DFG"></td>'.PHP_EOL;
echo '<td style="background-image:url(themes/'.$theme_name.'/images/hd/hd_17_2.png)">'.PHP_EOL;
echo '<ul class="sb-navigation">'.PHP_EOL;
echo '<li class="sb-nav-item"><a href="'.$ThemeInfo['link1'].'">'.$ThemeInfo['link1text'].'</a></li>'.PHP_EOL;
echo '<li class="sb-nav-item"><a href="'.$ThemeInfo['link2'].'">'.$ThemeInfo['link2text'].'</a></li>'.PHP_EOL;
echo '<li class="sb-nav-item"><a href="'.$ThemeInfo['link3'].'">'.$ThemeInfo['link3text'].'</a></li>'.PHP_EOL;
echo '<li class="sb-nav-item"><a href="'.$ThemeInfo['link4'].'">'.$ThemeInfo['link4text'].'</a></li>'.PHP_EOL;
echo '<li class="sb-nav-item"><a href="'.$ThemeInfo['link5'].'">'.$ThemeInfo['link5text'].'</a></li>'.PHP_EOL;
echo '<li class="sb-nav-item"><a href="'.$ThemeInfo['link6'].'">'.$ThemeInfo['link6text'].'</a></li>'.PHP_EOL;
echo '<li class="sb-nav-item"><a href="'.$ThemeInfo['link7'].'">'.$ThemeInfo['link7text'].'</a></li>'.PHP_EOL;
echo '</ul>'.PHP_EOL;
echo '</td>'.PHP_EOL;
echo '<td width="87"><img src="themes/'.$theme_name.'/images/hd/hd_18_2.png" width="87" height="48" alt="DFG"></td>'.PHP_EOL;
echo '</tr>'.PHP_EOL;
echo '</table>'.PHP_EOL;
echo '<table width="'. $ThemeInfo['sitewidth'].'" width="100%" border="0" cellspacing="0" cellpadding="0">'.PHP_EOL;
echo '<tr>'.PHP_EOL;
echo '<td width="42"><img src="themes/'.$theme_name.'/images/hd/hd_19.png" width="42" height="17" alt="DFG"></td>'.PHP_EOL;
echo '<td style="background-image:url(themes/'.$theme_name.'/images/hd/hd_20.png)"><img src="themes/'.$theme_name.'/images/hd/hd_20.png" width="1" height="17" alt="DFG"></td>'.PHP_EOL;
echo '<td width="42"><img src="themes/'.$theme_name.'/images/hd/hd_24.png" width="42" height="17" alt="DFG"></td>'.PHP_EOL;
echo '</tr>'.PHP_EOL;
echo '</table></td>'.PHP_EOL;
echo '</tr>'.PHP_EOL;
echo '</table>'.PHP_EOL;

echo '<!-- THEME HEADER END -->'.PHP_EOL.PHP_EOL;
?>
