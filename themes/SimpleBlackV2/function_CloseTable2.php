<?php
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) 
    exit('Access Denied');
	
/*--------------------------*/
/* function CloseTable2() 
/*--------------------------*/
function CloseTable2() {
    echo "</td></tr></table></td></tr></table>\n";
}

?>
