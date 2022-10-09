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

echo "<table width='90%' border='1' style='margin: auto;'><tr><th scope='col'>".$lang_new[$module_name]['BLOCK_CONFIG']."</th></tr></table>";
echo "<form action='".$admin_file.".php?op=lu_update_settings' method='post'>";
echo "<table width='90%' border='1' cellpadding='3' cellspacing='3' style='margin: auto;'>";
echo "  <tr>";
echo "    <td width='40%'><strong>".$lang_new[$module_name]['LINK_US_IMAGE'].":</strong></td>";
echo "    <td width='50%'><input name='my_image' type='text' size='60' value='".$config['my_image']."' /><br />( ".$lang_new[$module_name]['EXAMPLE'].": http://www.mysite.com/button.gif )</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <td width='40%'><strong>".$lang_new[$module_name]['ENABLE_FADE'].":</strong></td>";
echo "    <td width='50%'>";
echo yesno_option('fade_effect', $config['fade_effect']);
echo "    </td>";
echo "  </tr>";
echo "  <tr>";
echo "    <td width='40%'><strong>".$lang_new[$module_name]['ENABLE_MARQUEE'].":</strong></td>";
echo "    <td width='50%'>";
echo yesno_option('marquee', $config['marquee']);
echo "    </td>";
echo "  </tr>";
if ($config['marquee_direction'] == 1){$marquee_d_u ="checked";}
if ($config['marquee_direction'] == 2){$marquee_d_d ="checked";}
if ($config['marquee_direction'] == 3){$marquee_d_l ="checked";}
if ($config['marquee_direction'] == 4){$marquee_d_r ="checked";}
echo "  <tr>";
echo "    <td width='40%'><strong>".$lang_new[$module_name]['MARQUEE_DIRECTION'].":</strong></td>";
echo "    <td width='50%'>
  <input name='marquee_direction' type='radio' value='1' ".$marquee_d_u." />".$lang_new[$module_name]['UP']."&nbsp;
  <input name='marquee_direction' type='radio' value='2' ".$marquee_d_d." />".$lang_new[$module_name]['DOWN']."&nbsp;
  <input name='marquee_direction' type='radio' value='3' ".$marquee_d_l." />".$lang_new[$module_name]['LEFT']."&nbsp;
  <input name='marquee_direction' type='radio' value='4' ".$marquee_d_r." />".$lang_new[$module_name]['RIGHT']."</td>";
echo "  </tr>";
if ($config['marquee_scroll'] == 1){$marquee_s_f ="checked";}
if ($config['marquee_scroll'] == 2){$marquee_s_s ="checked";}
echo "  <tr>";
echo "    <td width='40%'><strong>".$lang_new[$module_name]['MARQUEE_SCROLL'].":</strong></td>";
echo "    <td width='50%'><input name='marquee_scroll' type='radio' value='1' ".$marquee_s_f." />".$lang_new[$module_name]['FAST']."&nbsp;<input name='marquee_scroll' type='radio' value='2' ".$marquee_s_s." />".$lang_new[$module_name]['SLOW']."</td>";
echo "  </tr>";
if ($config['block_height'] == 1){$block_height_100 ="checked";}
if ($config['block_height'] == 2){$block_height_150 ="checked";}
if ($config['block_height'] == 3){$block_height_200 ="checked";}
if ($config['block_height'] == 4){$block_height_250 ="checked";}
if ($config['block_height'] == 5){$block_height_300 ="checked";}
echo "  <tr>";
echo "    <td width='40%'><strong>".$lang_new[$module_name]['BLOCK_HEIGHT'].":</strong></td>";
echo "    <td width='50%'>
    <input name='block_height' type='radio' value='1' ".$block_height_100." />100px&nbsp;
    <input name='block_height' type='radio' value='2' ".$block_height_150." />150px&nbsp;
    <input name='block_height' type='radio' value='3' ".$block_height_200." />200px&nbsp;
    <input name='block_height' type='radio' value='4' ".$block_height_250." />250px&nbsp;
    <input name='block_height' type='radio' value='5' ".$block_height_300." />300px&nbsp;</td>";
echo "  </tr>";
echo "  <tr>";
echo "    <td width='40%'><strong>".$lang_new[$module_name]['SHOW_CLICK_COUNTER'].":</strong></td>";
echo "    <td width='50%'>";
echo yesno_option('show_clicks', $config['show_clicks']);
echo "    </td>";
echo "  </tr>";
if ($config['button_seperate'] == 1){$button_seperate_hr ="checked";}
if ($config['button_seperate'] == 2){$button_seperate_dot ="checked";}
if ($config['button_seperate'] == 0){$button_seperate_none ="checked";}
echo "  <tr>";
echo "    <td width='40%'><strong>".$lang_new[$module_name]['BUTTON_SEPARATION'].":</strong></td>";
echo "    <td width='50%'>
  <input name='button_seperate' type='radio' value='1' ".$button_seperate_hr." />".$lang_new[$module_name]['HORIZONTAL']."&nbsp;
  <input name='button_seperate' type='radio' value='2' ".$button_seperate_dot." />".$lang_new[$module_name]['DOTTED']."&nbsp;
  <input name='button_seperate' type='radio' value='0' ".$button_seperate_none." />".$lang_new[$module_name]['NO_SEPARATION']."&nbsp;</td>";
echo "  </tr>";
echo "</table>";
echo "<br /><br />";
echo "<input name='op' type='hidden' value='lu_update_block_settings'>";
echo "<center><input name='submit' type='submit' value='".$lang_new[$module_name]['UPDATE_BLOCK_CONFIG']."'></center>";
echo "</form>";

CloseTable();

?>