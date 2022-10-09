<?php

/*=======================================================================
 Nuke-Evolution   :   Enhanced Web Portal System
 ========================================================================

 Nuke-Evo Base          :   #$#BASE
 Nuke-Evo Version       :   #$#VER
 Nuke-Evo Build         :   #$#BUILD
 Nuke-Evo Patch         :   #$#PATCH
 Nuke-Evo Filename      :   #$#FILENAME
 Nuke-Evo Date          :   #$#DATE

 (c) 2007 - 2018 by Lonestar Modules - https://lonestar-modules.com
 ========================================================================

 LICENSE INFORMATIONS COULD BE FOUND IN COPYRIGHTS.PHP WHICH MUST BE
 DISTRIBUTED WITHIN THIS MODULEPACKAGE OR WITHIN FILES WHICH ARE
 USED FROM WITHIN THIS PACKAGE.
 IT IS "NOT" ALLOWED TO DISTRIBUTE THIS MODULE WITHOUT THE ORIGINAL
 COPYRIGHT-FILE.
 ALL INFORMATIONS ABOVE THIS SECTION ARE "NOT" ALLOWED TO BE REMOVED.
 THEY HAVE TO STAY AS THEY ARE.
 IT IS ALLOWED AND SHOULD BE DONE TO ADD ADDITIONAL INFORMATIONS IN
 THE SECTIONS BELOW IF YOU CHANGE OR MODIFY THIS FILE.

/*****[CHANGES]**********************************************************
-=[Base]=-
-=[Mod]=-
 ************************************************************************/

LinkusAdminMain();

$config = $db->sql_ufetchrow("SELECT * FROM ".$prefix."_link_us_config LIMIT 0,1");

OpenTable();

echo "<table width='80%' border='1' style='margin: auto;'><tr><th scope='col'>".$lang_new[$module_name]['MODULE_CONFIG']."</th></tr></table>";
echo "<form action='".$admin_file.".php?op=update_module_settings' method='post'>";
echo "<table width='80%' border='1' cellpadding='3' cellspacing='3' style='margin: auto;'>";
echo "  <tr>";
echo "    <td width='40%'><strong>".$lang_new[$module_name]['SHOW_STANDARD'].":</strong></td>";
echo "    <td width='40%'>";
echo yesno_option('button_standard', $config['button_standard']);
echo "    </td>";
echo "  </tr>";
echo "  <tr>";
echo "    <td width='40%'><strong>".$lang_new[$module_name]['SHOW_BANNER'].":</strong></td>";
echo "    <td width='40%'>";
echo yesno_option('button_banner', $config['button_banner']);
echo "    </td>";
echo "  </tr>";
echo "  <tr>";
echo "    <td width='40%'><strong>".$lang_new[$module_name]['SHOW_RESOURCES'].":</strong></td>";
echo "    <td width='40%'>";
echo yesno_option('button_resource', $config['button_resource']);
echo "    </td>";
echo "  </tr>";
echo "</table>";
echo "<input name='op' type='hidden' value='update_module_settings' />";
echo "<br /><div align='center'><input name='submit' type='submit' value='".$lang_new[$module_name]['UPDATE_MODULE_CONFIG']."' /></div>";
echo "</form>";

CloseTable();

?>