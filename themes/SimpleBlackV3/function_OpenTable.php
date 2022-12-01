<?php
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])): 
 exit('Access Denied');
endif;

/*--------------------------*/
/* function OpenTable() 
/*--------------------------*/
function OpenTable() {
    global $bgcolor1, $bgcolor2, $theme_name;


echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "  <tr>\n";
echo "  <td>\n";
echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "  <tr>\n";
echo "    <td width=\"17\"><img src=\"themes/SimpleBlackV3/images/tbl/tbl_03.png\" width=\"17\" height=\"27\" alt=\"DFG\"></td>\n";
echo "    <td style=\"background-image:url(themes/SimpleBlackV3/images/tbl/tbl_04.png)\"><img src=\"themes/SimpleBlackV3/images/tbl/tbl_04.png\" width=\"1\" height=\"27\" alt=\"DFG\"></td>\n";
echo "    <td width=\"17\"><img src=\"themes/SimpleBlackV3/images/tbl/tbl_06.png\" width=\"17\" height=\"27\" alt=\"DFG\"></td>\n";
echo "  </tr>\n";
echo "</table>\n";
echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "  <tr>\n";
echo "    <td width=\"8\" style=\"background-image:url(themes/SimpleBlackV3/images/tbl/tbl_08.png)\"><img src=\"themes/SimpleBlackV3/images/tbl/tbl_08.png\" width=\"8\" height=\"1\" alt=\"DFG\"></td>\n";
echo "          <td style=\"background-color: #010101;\">";
}

?>


