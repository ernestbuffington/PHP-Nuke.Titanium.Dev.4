<?php
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])):
  exit('Access Denied');
endif;

/*--------------------------*/
/* function OpenTable2()  
/*--------------------------*/
function OpenTable2() {
    global $bgcolor1, $bgcolor2;

    echo '<!-- OpenTable2 START -->'.PHP_EOL;

    echo '<table border="0" cellspacing="1" cellpadding="0" align="center"><tr><td class="extras">'.PHP_EOL;
    echo '<table border="0" cellspacing="1" cellpadding="8" ><tr><td>'.PHP_EOL;
}

?>
