<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       09/29/2005
 ************************************************************************/
if(realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])):
  exit('Access Denied');
endif;

global $ThemeInfo, $sitename, $theme_name;

echo '<div align="center">';

echo '<table width="' . $ThemeInfo['sitewidth'] . '" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor=""><tr><td>'.PHP_EOL;
echo '<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" class="headerexpand"><tr><td>'.PHP_EOL;
echo '<table width="100%" border="0" cellspacing="0" cellpadding="0">'.PHP_EOL;
echo '<tr>'.PHP_EOL;
echo '<td>'.PHP_EOL;
echo '<table width="100%" border="0" cellspacing="0" cellpadding="0">'.PHP_EOL;
echo '<tr>'.PHP_EOL;
echo '<td width="87"><img src="themes/'.$theme_name.'/images/hd/hd_01.png" width="87" height="20" alt="DFG"></td>'.PHP_EOL;
echo '<td style="background-image:url(themes/'.$theme_name.'/images/hd/hd_02.png)"><img src="themes/'.$theme_name.'/images/hd/hd_02.png" width="1" height="20" alt="DFG"></td>'.PHP_EOL;
echo '<td width="87"><img src="themes/'.$theme_name.'/images/hd/hd_04.png" width="87" height="20" alt="DFG"></td>'.PHP_EOL;
echo '</tr>'.PHP_EOL;
echo '</table>'.PHP_EOL;

echo '<table width="100%" border="0" cellspacing="0" cellpadding="0">'.PHP_EOL;
echo '<tr>'.PHP_EOL;
echo '<td width="42"><img src="themes/'.$theme_name.'/images/hd/hd_05.png" width="42" height="119" alt="DFG"></td>'.PHP_EOL;
echo '<td width="144px" style="background-image:url(themes/'.$theme_name.'/images/hd/hd_06.png)" height="119">'.$content1.'</td>'.PHP_EOL;
echo '<td width="11"><img src="themes/'.$theme_name.'/images/hd/hd_07.png" width="11" height="119" alt="DFG"></td>'.PHP_EOL;

$ads = ads(0);

if(empty($ads)) 
{
  echo '<td width="233"><img src="themes/'.$theme_name.'/images/hd/hd_08.png" width="233" height="119" alt="DFG"></td>'.PHP_EOL;
} 
else 
{
  echo '<td style="padding-left: 10px; background-image:url(themes/'.$theme_name.'/images/hd/hd_09.png)" width="233"><div style="padding-bottom: 4px;" align="right">'.$ads.'</div></td>'.PHP_EOL;
}


$network_ads = network_ads(0);

if(empty($network_ads)) 
{
  echo '<td style="background-image:url(themes/'.$theme_name.'/images/hd/hd_09.png)"><img src="themes/'.$theme_name.'/images/hd/hd_09.png" width="1" height="119" alt="DFG"></td>'.PHP_EOL;
} 
else 
{
  echo '<td style="background-image: url(themes/'.$theme_name.'/images/hd/hd_09.png)"><div align="right"><div class="bannerRightSide" style="padding-bottom: 4px;">'.$network_ads.'</div></div></td>'.PHP_EOL;
}

echo '<td width="60"><img src="themes/'.$theme_name.'/images/hd/hd_11.png" width="60" height="119" alt="DFG"></td>'.PHP_EOL;
echo '</tr>'.PHP_EOL;
echo '</table>'.PHP_EOL;

echo '<table width="100%" border="0" cellspacing="0" cellpadding="0">'.PHP_EOL;
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
echo '<table width="100%" border="0" cellspacing="0" cellpadding="0">'.PHP_EOL;
echo '<tr>'.PHP_EOL;
echo '<td width="42"><img src="themes/'.$theme_name.'/images/hd/hd_19.png" width="42" height="17" alt="DFG"></td>'.PHP_EOL;
echo '<td style="background-image:url(themes/'.$theme_name.'/images/hd/hd_20.png)"><img src="themes/'.$theme_name.'/images/hd/hd_20.png" width="1" height="17" alt="DFG"></td>'.PHP_EOL;
echo '<td width="42"><img src="themes/'.$theme_name.'/images/hd/hd_24.png" width="42" height="17" alt="DFG"></td>'.PHP_EOL;
echo '</tr>'.PHP_EOL;
echo '</table></td>'.PHP_EOL;
echo '</tr>'.PHP_EOL;
echo '</table>'.PHP_EOL;

?>