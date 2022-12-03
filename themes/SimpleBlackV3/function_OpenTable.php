<?php
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])): 
 exit('Access Denied');
endif;

/*--------------------------*/
/* function OpenTable() 
/*--------------------------*/
function OpenTable() {

echo PHP_EOL.'<!-- OpenTable START -->'.PHP_EOL;

global $theme_name;

echo '<table class="table100">'.PHP_EOL;
echo '<tr>'.PHP_EOL;
echo '<td>'.PHP_EOL;
echo '<table class="table100">'.PHP_EOL;
echo '<tr>'.PHP_EOL;
echo '<td width="17"><img src="themes/'.$theme_name.'/images/tbl/tbl_03.png" width="17" height="27" alt="DFG"></td>'.PHP_EOL;
echo '<td style="background-image:url(themes/'.$theme_name.'/images/tbl/tbl_04.png)"><img src="themes/'.$theme_name.'/images/tbl/tbl_04.png" width="1" height="27" alt="DFG"></td>'.PHP_EOL;
echo '<td width="17"><img src="themes/'.$theme_name.'/images/tbl/tbl_06.png" width="17" height="27" alt="DFG"></td>'.PHP_EOL;
echo '</tr>'.PHP_EOL;
echo '</table>'.PHP_EOL;
echo '<table class="table100">'.PHP_EOL;
echo '<tr>'.PHP_EOL;
echo '<td width="8" style="background-image:url(themes/'.$theme_name.'/images/tbl/tbl_08.png)"><img src="themes/'.$theme_name.'/images/tbl/tbl_08.png" width="8" height="1" alt="DFG"></td>'.PHP_EOL;
echo '<td style="background-color: #010101;">'.PHP_EOL;

}

?>


