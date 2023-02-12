<?php
/*=======================================================================
 PHP-Nuke Titanium | Nuke-Evolution Xtreme 
 ========================================================================
 (c) 2021 - 2022 by The 86it DEvelopers Network - https://86it.us
 (c) 2007 - 2018 by Lonestar Modules - https://lonestar-modules.com
 ========================================================================
 
/*****[CHANGES]**********************************************************
-=[Base]=-

-=[Mod]=-

-=[Last Updated]=-
 Cleaned - 11/30/2022 12:11 pm Ernest Allen Buffington
 ************************************************************************/

global $fieldset_color, $fieldset_border_width; 

echo "<script type='text/javascript' src='includes/visible.js'></script>";

$settings = 'border="0" style="filter:alpha(opacity=60);-moz-opacity:0.6" onMouseOver="makevisible(this,0)" onMouseOut="makevisible(this,1)"';

OpenTable();

echo '<div align="center">';
echo '<table width="98%" style="background-color:none; height:100%;" class="viewforum" align="center" border="5" cellpadding="15" cellspacing="20" dir="ltr" id="viewforum">';
echo '<tbody>';
echo '<tr>';
echo '<td align="center">';

echo '<div align="center" style="padding-top:17px;">';
echo '</div>';

echo '<div align="center"><img src="modules/'.$module_name.'/images/linkus-logo.png"></div>';
echo '<div align="center"><a href="modules.php?name=Link_Us&op=submitbutton"><font size="2"><i class="bi bi-link-45deg"></i><u>Submit Backlink</u></a></font></div>';
echo '<br />';

if($config['button_standard'] == 1):

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

    if($numrows == 0):
        echo '<div align="center"><span color="red" size="3">!'.$lang_new[$module_name]['NO_ACTIVE_SITES'].'!</span></div>';
	else: 
        if($numrows > 0):
            
			echo "<table border='0' cellpadding='2' cellspacing='5' width='100%'>";
        
		    while(list($id, $site_name, $site_url, $site_image, $site_description, $site_hits, $site_status, $date_added) = $db->sql_fetchrow($result)): 
			
				if ($num == 0): 
				  echo "<tr>"; 
				endif;
				
				echo "<td class='linkUStable' width='50%' valign='top'>";
                
				echo '<fieldset class="linkUSfieldset" style="color: '.$fieldset_color,'; border-width: '.$fieldset_border_width.'; border-style: solid;">';
                
				echo '<legend class="linkUSlegend" align="center" visible="true" style="width:auto; margin-bottom: 0px; color: #cecece; font-size: 18px; font-weight: bold;">
				<a href="modules.php?name='.$module_name.'&amp;op=visit&amp;id='.$id.'" target="_blank"><i class="bi bi-link"></i></i> '
				.set_smilies(decode_bbcode(stripslashes($site_name), 1, true)).' <i class="bi bi-link"></i></i></a></legend>';				
                
				#set font color
				echo '<span style="color: white; opacity: 1.0;">';
                
				echo '<table class="linkUStable">';
                
				echo '<tr>';

                echo "<td rowspan=\"2\" width=\"110\" align=\"center\" valign=\"top\"><a href='modules.php?name=".$module_name."&amp;op=visit&amp;id=".$id."' 
				target='_blank'><img height=\"31\" src='".$site_image."' ".$settings." /></a></a>";

                if (is_mod_admin($module_name)): 
                  echo "<br /><a href='".$admin_file.".php?op=edit_button&amp;id=".$id."'><img src='modules/".$module_name."/images/edit.png' alt='".$lang_new[$module_name]['EDIT']."' 
				  title='".$lang_new[$module_name]['EDIT']."' /></a>";
                  echo " <a href='".$admin_file.".php?op=delete_button&amp;id=".$id."'><img 
                  src='modules/".$module_name."/images/delete.png' alt='".$lang_new[$module_name]['DELETE']."' title='".$lang_new[$module_name]['DELETE']."' /></a>";
                endif;

               echo '</td><td align="left" valign="top" height="3" width="80%"><strong>&nbsp;<i class="bi bi-calendar2-check"></i>&nbsp; '.$lang_new[$module_name]['ADDED'].' '.formatTimestamp($date_added).'</strong></td>';
               echo '</tr>';
               echo '<tr>';
               
			   echo '<td align="left" valign="top" height="3" width="0">';
			   echo '<strong>&nbsp;<i class="bi bi-eye"></i>&nbsp; '.$lang_new[$module_name]['VISITS'].': '.$site_hits.'</strong></td>';
			   echo '</tr>';

			   echo '<td align="left" valign="top" height="3" width="0">';
			   echo '<strong>&nbsp;</td>';
			   echo '</tr>';

               echo '<tr>';
			   echo '<td class="HeightController" colspan="2" align="left" valign="top">';
			   echo '<strong><i class="bi bi-info-square"></i>&nbsp;</strong>'.set_smilies(decode_bbcode(stripslashes($site_description),1, true)).'</span></td>';

               echo '</tr>';
               echo '</table>';
			  
               echo '</fieldset>';
              
               echo '</td>';
               
			   $num++;
               
			   if($num == 2): 
			     echo "</tr>"; 
			     $num = 0; 
			   endif;

            endwhile;
			
            $db->sql_freeresult($result);
            if ($num ==1) { echo "<td width='50%'>&nbsp;</td></tr></table>"; } else { echo "</tr></table>"; }
        endif;
    endif;
endif;

if($config['button_banner'] == 1):
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

    if ($numrows > 0):
      
	  echo "<br /><br />";
      
	  echo "<table border='0' cellpadding='2' cellspacing='5' width='100%' align='center'>";
      echo "<tr><th width='100%'>".$lang_new[$module_name]['BANNER_BUTTONS']."</th></tr>";

      echo "</table>";
      
	  echo "<table border='0' cellpadding='2' cellspacing='5' width='100%'>";
      
	  while(list($id, $site_name, $site_url, $site_image, $site_description, $site_hits, $site_status, $date_added) = $db->sql_fetchrow($result)):

          if ($num == 0) { echo "<tr>"; }
          echo "<td width='50%' valign='top'>";

          OpenTable();
          
		  echo "<table border='0' width='100%'>";
          echo "<tr><td width='25%' align='center' valign='top' rowspan='3'>";
          echo "<a href='modules.php?name=".$module_name."&amp;op=visit&amp;id=$id' target='_blank'><img src='".$site_image."' ".$settings." /></a>";
        
		  if (is_mod_admin($module_name)):
            echo "<br /><br /><a href='".$admin_file.".php?op=edit_button&amp;id=".$id."'><img src='modules/".$module_name."/images/edit.png' 
			alt='".$lang_new[$module_name]['EDIT']."' title='".$lang_new[$module_name]['EDIT']."' /></a>";
            
			echo " <a href='".$admin_file.".php?op=delete_button&amp;id=".$id."'><img src='modules/".$module_name."/images/delete.png' 
			alt='".$lang_new[$module_name]['DELETE']."' title='".$lang_new[$module_name]['DELETE']."' /></a>";
          endif;
        
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
          
		  if($num == 1): 
		    echo "</tr>"; 
			$num = 0; 
		  endif;
        endwhile;
		  
		  $db->sql_freeresult($result);
        
		if($num ==1): 
		  echo "<td width='50%'>&nbsp;</td></tr></table>"; 
		else: 
		  echo "</tr></table>"; 
		endif;
    endif;
endif;

if ($config['button_resource'] == 1):
    
	$num = 0;
    
	$result = $db->sql_query("SELECT `id`, 
	                          `site_name`, 
							   `site_url`, 
							 `site_image`, 
					   `site_description`, 
					          `site_hits`, 
							`site_status`, 
							 `date_added` 
							 
	FROM `".$prefix."_link_us` 
	
	WHERE `site_status` = '1' 
	
	AND `button_type` = '3'");
    
	$numrows = $db->sql_numrows($result);

    if($numrows > 0):
        
		echo "<br /><br />";
        
		echo "<table border='0' cellpadding='2' cellspacing='5' width='100%' align='center'>";
        echo "<tr><th width='100%'>".$lang_new[$module_name]['RESOURCES']."</th></tr>";
        echo "</table>";
        
		echo "<table border='0' cellpadding='2' cellspacing='5' width='100%'>";
        
		while(list($id, $site_name, $site_url, $site_image, $site_description, $site_hits, $site_status, $date_added) = $db->sql_fetchrow($result)):
            
			if($num == 0): 
			  echo "<tr>"; 
			endif;

            echo "<td width='25%' valign='top'>";

            OpenTable();

            echo "<table border='0' width='100%'>";
            echo "<tr><td width='25%' align='center' rowspan='3'>";
            echo "<a href='modules.php?name=".$module_name."&amp;op=visit&amp;id=$id' target='_blank'><img style=\"vertical-align:middle;\" src='".$site_image."' ".$settings." /></a>";
            
			if(is_mod_admin($module_name)):
              echo "<br /><br /><a href='".$admin_file.".php?op=edit_button&amp;id=".$id."'><img src='modules/".$module_name."/images/edit.png' 
			  border='0' alt='".$lang_new[$module_name]['EDIT']."' title='".$lang_new[$module_name]['EDIT']."' /></a>";
              
			  echo " <a href='".$admin_file.".php?op=delete_button&amp;id=".$id."'><img src='modules/".$module_name."/images/delete.png' 
			  border='0' alt='".$lang_new[$module_name]['DELETE']."' title='".$lang_new[$module_name]['DELETE']."' /></a>";
            endif;
			
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

            if($num == 4): 
			  echo "</tr>"; 
			  $num = 0; 
		    endif;
        endwhile;

        $db->sql_freeresult($result);

        if ($num == 1) { echo "<td width='25%'>&nbsp;</td></tr></table>"; } else { echo "</tr></table>"; }
    endif;
endif;

echo '</tr>';
echo '</tbody>';
echo '</table>';
echo '</div>';

CloseTable();

?>