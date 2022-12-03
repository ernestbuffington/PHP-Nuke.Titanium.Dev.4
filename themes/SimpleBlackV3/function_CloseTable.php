<?php
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])): 
 exit('Access Denied');
endif;
#--------------------------#
# function CloseTable() 
#--------------------------#
function CloseTable() {

global $theme_name;

  echo '</td>'.PHP_EOL;
  echo '<td width="8" style="background-image:url(themes/'.$theme_name.'/images/tbl/tbl_11.png)"><img src="themes/'.$theme_name.'/images/tbl/tbl_11.png" width="8" height="1" alt="DFG"></td>'.PHP_EOL;
  echo '</tr>'.PHP_EOL;
  echo '</table>'.PHP_EOL;
  echo '<table width="100%" border="0" cellspacing="0" cellpadding="0">'.PHP_EOL;
  echo '<tr>'.PHP_EOL;
  echo '<td width="17"><img src="themes/'.$theme_name.'/images/tbl/tbl_14.png" width="17" height="27" alt="DFG"></td>'.PHP_EOL;
  echo '<td style="background-image:url(themes/'.$theme_name.'/images/tbl/tbl_15.png)"><img src="themes/'.$theme_name.'/images/tbl/tbl_15.png" width="1" height="27" alt="DFG"></td>'.PHP_EOL;
  echo '<td width="17"><img src="themes/'.$theme_name.'/images/tbl/tbl_16.png" width="17" height="27" alt="DFG"></td>'.PHP_EOL;
  echo '</tr>'.PHP_EOL;
  echo '</table>'.PHP_EOL;
  echo '</td>'.PHP_EOL;
  echo '</tr>'.PHP_EOL;
  echo '</table>'.PHP_EOL;

print '<div align="center" style="padding:6px;">'.PHP_EOL;
print '</div>'.PHP_EOL;

echo '<!-- CloseTable END -->'.PHP_EOL.PHP_EOL;
}

?>
