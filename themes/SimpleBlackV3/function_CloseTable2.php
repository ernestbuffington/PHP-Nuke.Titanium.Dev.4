<?php
if(realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])): 
  exit('Access Denied');
endif;
	
/*--------------------------*/
/* function CloseTable2() 
/*--------------------------*/
function CloseTable2() {
  
  echo  '</td></tr></table></td></tr></table>'.PHP_EOL;
  print '<div align="center" style="padding:6px;">'.PHP_EOL;
  print '</div>'.PHP_EOL;

  echo '<!-- CloseTable2 END -->'.PHP_EOL.PHP_EOL;	
}

?>
