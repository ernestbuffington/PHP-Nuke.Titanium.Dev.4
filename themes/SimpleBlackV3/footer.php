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

global $ThemeInfo, $theme_name;

echo '<!-- FOOTER START -->'.PHP_EOL;

echo '<table width="'. $ThemeInfo['sitewidth'].'" class="footerSITEwidth"><tr><td>'.PHP_EOL;

echo '<table width="'. $ThemeInfo['sitewidth'].'" align="center" border="0" cellpadding="0" cellspacing="0" class="headerexpand"><tr><td>'.PHP_EOL;

echo '<table width="'. $ThemeInfo['sitewidth'].'" border="0" cellspacing="0" cellpadding="0">'.PHP_EOL;
echo '<tr>'.PHP_EOL;
echo '<td>'.PHP_EOL;
echo '<table width="'. $ThemeInfo['sitewidth'].'" border="0" cellspacing="0" cellpadding="0">'.PHP_EOL;

echo '<tr>'.PHP_EOL;
echo '<td width="43"><img src="themes/'.$theme_name.'/images/ft/ft_02.png" width="43" height="30" alt="DFG"></td>'.PHP_EOL;
echo '<td style="background-image:url(themes/'.$theme_name.'/images/ft/ft_03.png)"><img src="themes/'.$theme_name.'/images/ft/ft_03.png" width="1" height="30" alt="DFG"></td>'.PHP_EOL;
echo '<td width="43"><img src="themes/'.$theme_name.'/images/ft/ft_05.png" width="43" height="30" alt="DFG"></td>'.PHP_EOL;
echo '</tr>'.PHP_EOL;
echo '</table>'.PHP_EOL;

echo '<table width="'. $ThemeInfo['sitewidth'].'" border="0" cellspacing="0" cellpadding="0">'.PHP_EOL;
echo '<tr>'.PHP_EOL;

echo '<td class="ft06" width="43"><img src="themes/'.$theme_name.'/images/ft/ft_06.png" width="43" height="200px" alt="DFG"></td>'.PHP_EOL;
//echo '<td width="144" style="background-image:url(themes/'.$theme_name.'/images/ft/ft_07.png)"><div align="center">'.$showdownloads.'</div></td>'.PHP_EOL;

echo '<td class="ft08"></td>'.PHP_EOL;

echo '<td class="ft09">'.PHP_EOL;

echo '<div style="padding-bottom: 15px;" align="center">';
# COPYRIGHT: DO NOT REMOVE, EDIT, MODIFY, OR DELETE, MUST STAY INTACT
footmsg();
echo '</div>';

echo '<td>'.PHP_EOL;

echo '<td class="ft11"></td>'.PHP_EOL;

//echo '<td width="144" style="background-image:url(themes/'.$theme_name.'/images/ft/ft_12.png)"><div align="center">'.$showlinks.'</div></td>'.PHP_EOL;
echo '<td width="43"><img src="themes/'.$theme_name.'/images/ft/ft_13.png" width="43" height="200px" alt="DFG"></td>'.PHP_EOL;
echo '</tr>'.PHP_EOL;
echo '</table>'.PHP_EOL;
echo '<table width="100%" border="0" cellspacing="0" cellpadding="0">'.PHP_EOL;
echo '<tr>'.PHP_EOL;
echo '<td width="43"><img src="themes/'.$theme_name.'/images/ft/ft_14.png" width="43" height="19" alt="DFG"></td>'.PHP_EOL;
echo '<td style="background-image:url(themes/'.$theme_name.'/images/ft/ft_15.png)"><img src="themes/'.$theme_name.'/images/ft/ft_15.png" width="1" height="19" alt="DFG"></td>'.PHP_EOL;
echo '<td width="43"><img src="themes/'.$theme_name.'/images/ft/ft_18.png" width="43" height="19" alt="DFG"></td>'.PHP_EOL;
echo '</tr>'.PHP_EOL;
echo '</table>'.PHP_EOL;
echo '</td>'.PHP_EOL;
echo '</tr>'.PHP_EOL;
echo '</table></div>'.PHP_EOL;

echo '</div>'.PHP_EOL;
echo '<!-- FOOTER END -->'.PHP_EOL.PHP_EOL;

?>
