<?php
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])): 
 exit('Access Denied');
endif;
#--------------------------#
# function CloseTable() 
#--------------------------#
function CloseTable() {
    global $theme_name;
    echo "</td>\n";
echo "    <td width=\"8\" style=\"background-image:url(themes/SimpleBlackV2/images/tbl/tbl_11.png)\"><img src=\"themes/SimpleBlackV2/images/tbl/tbl_11.png\" width=\"8\" height=\"1\" alt=\"DFG\"></td>\n";
echo "  </tr>\n";
echo "</table>\n";
echo "\n";
echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "  <tr>\n";
echo "    <td width=\"17\"><img src=\"themes/SimpleBlackV2/images/tbl/tbl_14.png\" width=\"17\" height=\"27\" alt=\"DFG\"></td>\n";
echo "    <td style=\"background-image:url(themes/SimpleBlackV2/images/tbl/tbl_15.png)\"><img src=\"themes/SimpleBlackV2/images/tbl/tbl_15.png\" width=\"1\" height=\"27\" alt=\"DFG\"></td>\n";
echo "    <td width=\"17\"><img src=\"themes/SimpleBlackV2/images/tbl/tbl_16.png\" width=\"17\" height=\"27\" alt=\"DFG\"></td>\n";
echo "  </tr>\n";
echo "</table>\n";
echo "</td>\n";
echo "</tr>\n";
echo "</table>\n";

}

?>
