<?php
if (!defined('MODULE_FILE')) {
   die('You can\'t access this file directly...');
}

$pnt_module = basename(dirname(dirname(__FILE__)));

get_lang($pnt_module);

if ( is_mod_admin($pnt_module) )
{ 

echo "<div align='center'>THIS WILL BE THE NEW ADMIN CONTROL PANEL FOR THE Titanium_SandBox (Only Admins Seee This)</div>";
}
else
{ 
    DisplayError('<strong>'._ERROR.'</strong><br /><br />' . _NO_ADMIN_RIGHTS . $pnt_module);
}

?>