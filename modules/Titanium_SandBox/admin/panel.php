<?php
if (!defined('MODULE_FILE')) {
   die('You can\'t access this file directly...');
}

$titanium_module_name = basename(dirname(dirname(__FILE__)));

get_lang($titanium_module_name);

if ( is_mod_admin($titanium_module_name) )
{ 

echo "<div align='center'>THIS WILL BE THE NEW ADMIN CONTROL PANEL FOR THE Titanium_SandBox (Only Admins Seee This)</div>";
}
else
{ 
    DisplayError('<strong>'._ERROR.'</strong><br /><br />' . _NO_ADMIN_RIGHTS . $titanium_module_name);
}

?>