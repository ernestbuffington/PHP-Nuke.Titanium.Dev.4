<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

//Close the open table
CloseTable();
//echo '<br />';
//Start a new table
OpenTable();

/*==============================================================================================
    Function:    get_values()
    In:          N/A
    Return:      Array of the values from the DB.
    Notes:       Will toss a DonateError if the values are not found
================================================================================================*/
function get_values() {
    global $db, $prefix, $lang_donate;
    $sql = 'SELECT config_value from `'.$prefix.'_donators_config` WHERE config_name="values"';
    $result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    $values = ($row['config_value']) ? explode(',',$row['config_value']) : DonateError($lang_donate['VALUES_NF']);
    return $values;
}

/*==============================================================================================
    Function:    display_values
    In:          $values
                    The array of values from the DB
    Return:      N/A
    Notes:       Will display all the values in the form/table
================================================================================================*/
function display_values($values) {
    global $lang_donate, $admin_file;
    if (!is_array($values)) {
        DonateError($lang_donate['VALUES_ND']);
    }
    echo '<p class="acenter" style="font-size: large; font-weight: bold;">'.$lang_donate['DONATION_VALUES'].' </p>';
    echo '<form id="values" method="post" action="'.$admin_file.'.php?op=Donations&amp;file=values"><table width="7%" border="1" style="margin: auto">';
    for ($i = 1; $i <= 5; $i++) {
        echo '<tr>';
            echo '<td width="25%">';
                echo '<div align="center">'.$i.'</div>';
            echo '</td>';
            echo '<td width="75%">';
                $value = ($values[$i-1]) ? $values[$i-1] : '';
                echo '<input type="text" size="5" name="value'.$i.'" value="'.$value.'">';
            echo '</td>';
        echo '</tr>';
    }
    echo '<td colspan="2"><div align="center"><input type="submit" value="'.$lang_donate['DONATION_SUBMIT'].'"></div></td>';
    echo '</table></form>';
}

/*==============================================================================================
    Function:    strip_values()
    In:          N/A
    Return:      String of values with , speration
    Notes:       Gets the data from $_POST
================================================================================================*/
function strip_values() {
    $values = '';
    for ($i = 1; $i <= 5; $i++) {
        $values .= ($_POST['value'.$i]) ? Fix_Quotes($_POST['value'.$i]) . ',' : ',';
    }
    $values = substr($values,0,strlen($values)-1);
    return $values;
}

/*==============================================================================================
    Function:    write_values()
    In:          $values
                    The string of values from strip_values
    Return:      N/A
    Notes:       Writes new values to the DB
================================================================================================*/
function write_values($values) {
    global $db, $prefix, $lang_donate;
    $sql = 'UPDATE `'.$prefix.'_donators_config` SET config_value="'.$values.'" WHERE config_name="values"';
    $db->sql_query($sql);
}

/*~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-*/

//If new values were posted
if (!empty($_POST)) {
    write_values(strip_values());
}

//Display the current values
display_values(get_values());

?>