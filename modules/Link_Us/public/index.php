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

echo "<script type='text/javascript' src='includes/visible.js'></script>";
$settings = 'border="0" style="filter:alpha(opacity=60);-moz-opacity:0.6" onMouseOver="makevisible(this,0)" onMouseOut="makevisible(this,1)"';

OpenTable();

print '<div align="center">';
print '<table width="98%" style="background-color:none; height:100%;" class="viewforum" align="center" border="5" cellpadding="15" cellspacing="20" dir="ltr" id="viewforum">';
print '<tbody>';
print '<tr>';
print '<td align="center">';


echo '<div align="center" style="padding-top:17px;">';
echo '</div>';

echo '<div align="center"><img src="modules/'.$module_name.'/images/linkus-logo.png"></div>';
echo '<div align="center"><a href="modules.php?name=Link_Us&op=submitbutton"><font size="2"><i class="bi bi-link-45deg"></i><u>Submit Backlink</u></a></font></div>';
echo '<br />';

if ($config['button_standard'] == 1){
    $num = 0;
    $result = $db->sql_query("SELECT `id`, 
	                          `site_name`, 
							   `site_url`, 
							 `site_image`, 
					   `site_description`, 
					          `site_hits`, 
							`site_status`, 
							 `date_added` FROM `".$prefix."_link_us` WHERE `site_status` = '1' AND `button_type` = '1'");
    
	$numrows = $db->sql_numrows($result);

    if($numrows == 0)
	{
        echo '<div align="center"><span color="red" size="3">!'.$lang_new[$module_name]['NO_ACTIVE_SITES'].'!</span></div>';
    } 
	else 
	{
        if ($numrows > 0) 
		{
            echo "<table border='0' cellpadding='2' cellspacing='5' width='100%'>";
        
		    while(list($id, $site_name, $site_url, $site_image, $site_description, $site_hits, $site_status, $date_added) = $db->sql_fetchrow($result)) 
			{

                if ($num == 0) { echo "<tr>"; }
                echo "<td width='50%' valign='top'>";
                //OpenTable();
				
				global $fieldset_color, $fieldset_border_width; 
                echo '<fieldset style="color: '.$fieldset_color,'; border-width: '.$fieldset_border_width.'; border-style: solid;">';
                echo '<legend align="center" id="Legend6" runat="server" visible="true" style="width:auto; margin-bottom: 0px; color: #cecece; font-size: 18px; font-weight: bold;">
				<a href="modules.php?name='.$module_name.'&amp;op=visit&amp;id='.$id.'" target="_blank"><i class="bi bi-link"></i></i> '.set_smilies(decode_bbcode(stripslashes($site_name), 1, true)).' <i class="bi bi-link"></i></i></a></legend>';				
                
				#set font color
				print '<font color="white" style="opacity: 1.0;">';
                
				print '<table height="114" border="0">';
                print '<tr>';

                print "<td rowspan=\"2\" width=\"20%\" align=\"center\" valign=\"top\"><a href='modules.php?name=".$module_name."&amp;op=visit&amp;id=".$id."' target='_blank'><img src='".$site_image."' ".$settings." /></a></a>";

                if (is_mod_admin($module_name)) 
				{
                echo "<br /><a href='".$admin_file.".php?op=edit_button&amp;
                id=".$id."'><img src='modules/".$module_name."/images/edit.png' border='0' 
                alt='".$lang_new[$module_name]['EDIT']."' title='".$lang_new[$module_name]['EDIT']."' /></a>";
                echo " <a href='".$admin_file.".php?op=delete_button&amp;id=".$id."'><img 
                src='modules/".$module_name."/images/delete.png' 
				border='0' alt='".$lang_new[$module_name]['DELETE']."' title='".$lang_new[$module_name]['DELETE']."' /></a>";
                }

               print '</td><td align="left" valign="top" height="3" width="80%"><strong>&nbsp;<i class="bi bi-calendar2-check"></i>&nbsp; '.$lang_new[$module_name]['ADDED'].' '.formatTimestamp($date_added).'</strong></td>';
               print '</tr>';
               print '<tr>';
               
			   print '<td align="left" valign="top" height="3" width="0">';
			   print '<strong>&nbsp;<i class="bi bi-eye"></i>&nbsp; '.$lang_new[$module_name]['VISITS'].': '.$site_hits.'</strong></td>';
			   print '</tr>';

			   print '<td align="left" valign="top" height="3" width="0">';
			   print '<strong>&nbsp;</td>';
			   print '</tr>';

               print '<tr>';
			   print '<td width="100%" colspan="2" align="left" valign="top">';
			   print '<strong><i class="bi bi-info-square"></i>
&nbsp;</strong>'.set_smilies(decode_bbcode(stripslashes($site_description),1, true)).'</font></td>';

              print '</tr>';
              print '</table>';
              echo"</fieldset>";
              echo"<br/>";
				//CloseTable();
                echo "</td>";
                $num++;
                if ($num == 2) { echo "</tr>"; $num = 0; }
            }
            $db->sql_freeresult($result);
            if ($num ==1) { echo "<td width='50%'>&nbsp;</td></tr></table>"; } else { echo "</tr></table>"; }
        }
    }
}

if ($config['button_banner'] == 1){
    $num = 0;
    $result = $db->sql_query("SELECT `id`, 
	                          `site_name`, 
							   `site_url`, 
							 `site_image`, 
					   `site_description`, 
					          `site_hits`, 
							`site_status`, 
							 `date_added` FROM `".$prefix."_link_us` WHERE `site_status` = '1' AND `button_type` = '2'");
    
	$numrows = $db->sql_numrows($result);

    if ($numrows > 0) {
        echo "<br /><br />";
        echo "<table border='0' cellpadding='2' cellspacing='5' width='100%' align='center'>";
        echo "<tr><th width='100%'>".$lang_new[$module_name]['BANNER_BUTTONS']."</th></tr>";

        echo "</table>";
        echo "<table border='0' cellpadding='2' cellspacing='5' width='100%'>";
        while(list($id, $site_name, $site_url, $site_image, $site_description, $site_hits, $site_status, $date_added) = $db->sql_fetchrow($result)) {
            if ($num == 0) { echo "<tr>"; }
            echo "<td width='50%' valign='top'>";
            OpenTable();
            echo "<table border='0' width='100%'>";
            echo "<tr><td width='25%' align='center' valign='top' rowspan='3'>";
            echo "<a href='modules.php?name=".$module_name."&amp;op=visit&amp;id=$id' target='_blank'><img src='".$site_image."' ".$settings." /></a>";
            if (is_mod_admin($module_name)) {
                echo "<br /><br /><a href='".$admin_file.".php?op=edit_button&amp;id=".$id."'><img src='modules/".$module_name."/images/edit.png' border='0' alt='".$lang_new[$module_name]['EDIT']."' title='".$lang_new[$module_name]['EDIT']."' /></a>";
                echo " <a href='".$admin_file.".php?op=delete_button&amp;id=".$id."'><img src='modules/".$module_name."/images/delete.png' border='0' alt='".$lang_new[$module_name]['DELETE']."' title='".$lang_new[$module_name]['DELETE']."' /></a>";
            }
            echo "</td><td width='75%' valign='top'>";
            echo "<table border='0' width='100%'>";
            echo "<tr><td valign='top' align='left'><strong>".$lang_new[$module_name]['SITE_NAME'].":</strong></td><td>".set_smilies(decode_bbcode(stripslashes($site_name), 1, true))."</td></tr>";
            echo "<tr><td valign='top' align='left'><strong>".$lang_new[$module_name]['ADDED'].":</strong></td><td>".formatTimestamp($date_added)."</td></tr>";
            echo "<tr><td valign='top' align='left'><strong>".$lang_new[$module_name]['VISITS'].":</strong></td><td>".$site_hits."</td></tr>";
            echo "<tr><td valign='top' align='left'><strong>".$lang_new[$module_name]['DESCRIPTION'].":</strong></td><td>".set_smilies(decode_bbcode(stripslashes($site_description),1, true))."</td></tr>";
            echo "</table></td>";
            echo "</tr></table>";
            CloseTable();
            echo "</td>";
            $num++;
            if ($num == 1) { echo "</tr>"; $num = 0; }
        }
        $db->sql_freeresult($result);
        if ($num ==1) { echo "<td width='50%'>&nbsp;</td></tr></table>"; } else { echo "</tr></table>"; }
    }
}

if ($config['button_resource'] == 1){
    $num = 0;
    $result = $db->sql_query("SELECT `id`, `site_name`, `site_url`, `site_image`, `site_description`, `site_hits`, `site_status`, `date_added` FROM `".$prefix."_link_us` WHERE `site_status` = '1' AND `button_type` = '3'");
    $numrows = $db->sql_numrows($result);

    if ($numrows > 0) {
        echo "<br /><br />";
        echo "<table border='0' cellpadding='2' cellspacing='5' width='100%' align='center'>";
        echo "<tr><th width='100%'>".$lang_new[$module_name]['RESOURCES']."</th></tr>";
        echo "</table>";
        echo "<table border='0' cellpadding='2' cellspacing='5' width='100%'>";
        while(list($id, $site_name, $site_url, $site_image, $site_description, $site_hits, $site_status, $date_added) = $db->sql_fetchrow($result)) {
            if ($num == 0) { echo "<tr>"; }
            echo "<td width='25%' valign='top'>";
            OpenTable();
            echo "<table border='0' width='100%'>";
            echo "<tr><td width='25%' align='center' rowspan='3'>";
            echo "<a href='modules.php?name=".$module_name."&amp;op=visit&amp;id=$id' target='_blank'><img src='".$site_image."' ".$settings." align='absmiddle' /></a>";
            if (is_mod_admin($module_name)) {
                echo "<br /><br /><a href='".$admin_file.".php?op=edit_button&amp;id=".$id."'><img src='modules/".$module_name."/images/edit.png' border='0' alt='".$lang_new[$module_name]['EDIT']."' title='".$lang_new[$module_name]['EDIT']."' /></a>";
                echo " <a href='".$admin_file.".php?op=delete_button&amp;id=".$id."'><img src='modules/".$module_name."/images/delete.png' border='0' alt='".$lang_new[$module_name]['DELETE']."' title='".$lang_new[$module_name]['DELETE']."' /></a>";
            }
            echo "</td><td width='75%' valign='top'>";
            echo "<table border='0' width='100%'>";
            echo "<tr><td valign='top' align='left'><strong>".$lang_new[$module_name]['SITE_NAME'].":</strong></td><td>".set_smilies(decode_bbcode(stripslashes($site_name), 1, true))."</td></tr>";
            echo "<tr><td valign='top' align='left'><strong>".$lang_new[$module_name]['ADDED'].":</strong></td><td>".formatTimestamp($date_added)."</td></tr>";
            echo "<tr><td valign='top' align='left'><strong>".$lang_new[$module_name]['VISITS'].":</strong></td><td>".$site_hits."</td></tr>";
            echo "<tr><td valign='top' align='left'><strong>".$lang_new[$module_name]['DESCRIPTION'].":</strong></td><td>".set_smilies(decode_bbcode(stripslashes($site_description),1, true))."</td></tr>";
            echo "</table></td>";
            echo "</tr></table>";

            CloseTable();
            echo "</td>";
            $num++;
            if ($num == 4) { echo "</tr>"; $num = 0; }
        }
        $db->sql_freeresult($result);
        if ($num == 1) { echo "<td width='25%'>&nbsp;</td></tr></table>"; } else { echo "</tr></table>"; }
    }
}

print '</tr>';
print '</tbody>';
print '</table>';
print '</div>';

CloseTable();

?>