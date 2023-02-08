<?php
/*====================================================================== 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System                JOHN 3:16
 =======================================================================*/
if(!defined('ADMIN_FILE')) 
die ("Illegal File Access");

if(!is_mod_admin()) 
die ("Access Denied");

function modadmin_title() 
{
    global $admin_file, $admlang; 
    OpenTable();
    echo '<div class="modules" align="center">[ <a href="'.$admin_file.'.php?op=modules">Admin Modules Block</a> ]</div>';
    echo '<div align="center">[ <a href="'.$admin_file.'.php">'.$admlang['global']['header_return'].'</a> ]</div>';
    CloseTable();
}

function modadmin_get_modules ($mid = '') 
{
    global $prefix, $db, $admlang;

    $mid = (!empty($mid)) ? 'WHERE mid='.$mid : '';

    if(!$result = $db->sql_query("SELECT `mid`, `title`, `custom_title`, `active`, `view`, `inmenu`, `blocks`, `groups` FROM `".$prefix."_modules` $mid ORDER BY `title` ASC")) 
    DisplayError($admlang['modblock']['no_values']);

    if (!$out = $db->sql_fetchrowset($result)) 
    DisplayError($admlang['modblock']['no_values']);

    $db->sql_freeresult($result);

    return $out;
}

function modadmin_usergroup_whoview($module)
{
   global $db, $prefix, $admlang;

   $who_view = '';

   if($module['view'] == 0 || $module['view'] == 1) 
      $who_view = $admlang['global']['all_visitors'];
   else
   if($module['view'] == 2) 
            $who_view = $admlang['global']['guests_only'];
   else
   if($module['view'] == 3) 
            $who_view = $admlang['global']['users_only'];
   else
   if($module['view'] == 4) 
            $who_view = $admlang['global']['admins_only'];
   else
   if($module['view'] == 6) 
   {
      $groups = explode('-', $module['groups']);
   
      foreach ($groups as $group) 
      {
         if (!empty($group)) 
         {
            $row = $db->sql_ufetchrow("SELECT group_name FROM ".$prefix.'_bbgroups WHERE group_id='.$group, SQL_NUM);
   
            if (!empty($row['group_name'])) 
            {
               $who_view .= $row['group_name'].', ';
            }
         }
      }
   
      if (!empty($who_view)) 
      {
         $who_view = substr($who_view, 0, strlen($who_view)-2);
      }
   }
   
   return $who_view;
}

function modadmin_dispaly_modules($modadmin_modules) 
{
   global $prefix, $db, $admin_file, $bgcolor, $bgcolor2,$bgcolor3, $bgcolor4, $admlang;
   
   if(!is_array($modadmin_modules)) 
   DisplayError($admlang['modblock']['no_values']);

   $main_module = main_module();

   OpenTable();
   echo '<table style="width: 100%;" cellpadding="4" cellspacing="1" border="1" class="forumline acenter">';
   echo '<tr>';
   echo '<td class="catHead" colspan="7">-= '.$admlang['global']['warning'].' =-</td>';
   echo '</tr>';
   echo '<tr>';
   
   echo '<td class="row1" style="letter-spacing: 1px; line-height: 22px;" 
   colspan="7">'.$admlang['modules']['warn'].'<br /><br />[ <a href="'.$admin_file.'.php?op=modules&amp;area=block">'.$admlang['modules']['block'].'</a> ]</td>';
   
   echo '</tr>';
   echo '<tr>';
   echo '<td class="catHead" style="width: 10%;">'.$admlang['global']['active'].'</td>';
   echo '<td class="catHead" style="width: 10%;">'.$admlang['global']['home'].'</td>';
   echo '<td class="catHead" style="width: 18.3%;">'.$admlang['global']['title'].'</td>';
   echo '<td class="catHead" style="width: 18.3%;">'.$admlang['global']['title_custom'].'</td>';
   echo '<td class="catHead" style="width: 18.3%;">'.$admlang['global']['view'].'</td>';
   echo '<td class="catHead" style="width: 15%;">'.$admlang['blocks']['visible'].'</td>';
   echo '<td class="catHead" style="width: 10%;">'.$admlang['global']['functions'].'</td>';
   echo '</tr>';
   
   foreach ($modadmin_modules as $module) 
   {
      if(substr($module['title'],0,3) == '~l~') 
      {
         continue;
      }

      # Fixed by TheGhost 3/26/2021
	  # this boggled my mind years ago, I added this to remove the .. module that did not really exists!
	  # do not place the index as a module in the moodules list
      if(substr($module['title'],0,2) == '..') 
      {
         continue;
      }

      # Fixed by TheGhost 3/26/2021
      # this boggled my mind years ago, I added this to remove the .. index.html!
	  # allow an index.html in the root of the modules folder
      if(substr($module['title'],0,10) == 'index.html') 
      {
         continue;
      }

      # Fixed by TheGhost 3/26/2021
	  # this boggled my mind years ago, I added this to remove the Evo_UserBlock module that did not need to exist in the list!
	  # Remove Evo User Block from modules list!
      if(substr($module['title'],0,13) == 'Evo_UserBlock') 
      {
         continue;
      }
	  
	  if(!isset($who_view))
	  $who_view = null;
	  
      # list the top header information
      if($module['title'] == $main_module) 
      {
         $home       = get_evo_icon('evo-sprite home', $admlang['modules']['inhome']);
         $active     = get_evo_icon('evo-sprite ok', $admlang['global']['active']);
         $title      = "<strong>".$module['title']."</strong>";
         $who_view   = "<strong>".$who_view."</strong>";
      } 
	  else 
	  {
         $home       = '<a href="'.$admin_file.'.php?op=modules&amp;h='.$module['mid'].'">'.get_evo_icon('evo-sprite cancel', $admlang['global']['inactive']).'</a>';
         
		 $active     = (intval($module['active'])) ? '<a href="'.$admin_file.'.php?op=modules&amp;a='.$module['mid'].'">'.get_evo_icon('evo-sprite ok', $admlang['global']['active']).'</a>' : '<a 
		 href="'.$admin_file.'.php?op=modules&amp;a='.$module['mid'].'">'.get_evo_icon('evo-sprite cancel', $admlang['global']['inactive']).'</a>';
         
		 $title      =  (!intval($module['inmenu'])) ? "[&nbsp;<big><strong>&middot;</strong></big>&nbsp;]&nbsp;".$module['title'] : $module['title'];
      }

      if(isset($module['blocks'])) 
      {
         switch($module['blocks']) 
         {
            case 0:
               $module['blocks'] = $admlang['global']['none'];
               break;
            case 1:
               $module['blocks'] = $admlang['global']['left'];
               break;
            case 2:
               $module['blocks'] = $admlang['global']['right'];
               break;
            case 3:
               $module['blocks'] = $admlang['global']['both'];
               break;
            default:
               $module['blocks'] = '';
               break;
            }
        } 
        else 
        {
            $module['blocks'] = '';
        }

      echo '<tr>';
      echo '<td class="row1">'.$active.'</td>';
      echo '<td class="row1">'.$home.'</td>';
      echo '<td class="row1" style="text-align: left;"><a href="modules.php?name='.$module['title'].'" title="'.$admlang['global']['show'].'">'.$title.'</a></td>';
      echo '<td class="row1" style="text-align: left;">'.$module['custom_title'].'</td>';
      echo '<td class="row1" style="text-align: left;">'.modadmin_usergroup_whoview($module).'</td>';
      echo '<td class="row1">'.$module['blocks'].'</td>';
      echo '<td class="row1"><a href="'.$admin_file.'.php?op=modules&amp;edit='.$module['mid'].'">'.get_evo_icon('evo-sprite edit').'</a></td>'; // '._EDIT.'
      echo '</tr>';
   }
   echo '</table>';

   CloseTable();
}

function modadmin_edit_module($module) 
{
   global $prefix, $db, $admin_file, $admlang;
   
   $main_module = main_module();
   
   $ingroups = array();
   
   $o1 = $o2 = $o3 = $o4 = $o6 = '';
   
   switch ($module['view']) 
   {
      case 1: $o1 = 'SELECTED'; 
	  break;
      case 2: $o2 = 'SELECTED'; 
	  break;
      case 3: $o3 = 'SELECTED'; 
	  break;
      case 4: $o4 = 'SELECTED'; 
	  break;
      case 6:
         $o6 = 'SELECTED';
         $ingroups = explode('-', $module['groups']);
         break;
   }
   
   OpenTable();
   if(substr($module['title'],0,3) != '~l~') 
   {
      $a = ($module['title'] == $main_module) ? ' - ('.$admlang['modules']['inhome'].')' : '';

      echo '<form method="post" action="'.$admin_file.'.php?op=modules">';
      echo '<input type="hidden" name="save" value="'.$module['mid'].'" />';
      echo '<table style="width: 100%;" cellpadding="4" cellspacing="1" border="1" class="forumline">';
      echo '<tr>';
      echo '<td class="catHead" colspan="2" style="text-align: center;">'.$module['title'].$a.'</td>';
      echo '</tr>';
      echo '<tr>';
      echo '<td class="row1" style="width: 50%;">'.$admlang['global']['title_custom'].'</td>';
      echo '<td class="row1" style="width: 50%;"><input style="height: 24px; padding-left: 3px; padding-right: 3px; width: 99%;" 
	  type="text" name="custom_title" id="custom_title" value="'.$module['custom_title'].'" maxlength="255" /></td>';
      
	  echo '</tr>';

      echo '<tr>';
      echo '<td class="row1" style="width: 50%;">'.$admlang['global']['who_view'].'</td>';
      echo '<td class="row1" style="width: 50%;">';
   
      if($module['title'] == $main_module || $module['title'] == 'Your_Account' || $module['title'] == 'Profile') 
      {
         echo '<input type="hidden" name="view" value="0" />';
      } 
      else 
      {
         echo '<br /><strong>'.$admlang['global']['who_view'].'</strong><br />';
         echo '<select name="view" style="cursor: pointer; font-size: 11px !important; font-family: Verdana,Geneva,Arial,Helvetica,sans-serif; letter-spacing: 1px; margin: 0px 1px 1px; padding: 5px;">';
         echo '<option value="1" '.$o1.'>' . $admlang['global']['all_visitors'] .'</option>';
         echo '<option value="2" '.$o2.'>' . $admlang['global']['guests_only'] .'</option>';
         echo '<option value="3" '.$o3.'>' . $admlang['global']['users_only'] .'</option>';
         echo '<option value="4" '.$o4.'>' . $admlang['global']['admins_only'] .'</option>';
         echo '<option value="6" '.$o6.'>' . $admlang['global']['groups_only'] .'</option>';
         echo '</select><br />';

         echo "<span class='tiny'>"._WHATGRDESC."</span><br /><br /><strong>"._WHATGROUPS."</strong><br /> <select name='add_groups[]' style=\"cursor: pointer; 
		 font-size: 11px !important; font-family: Verdana,Geneva,Arial,Helvetica,sans-serif; letter-spacing: 1px; margin: 0px 1px 1px; padding: 5px;\" multiple size='5'>\n";
            
			$groupsResult = $db->sql_query("SELECT group_id, group_name FROM ".$prefix."_bbgroups WHERE group_description <> 'Personal User'");
            
			while(list($gid, $gname) = $db->sql_fetchrow($groupsResult)) 
			{
                if(in_array($gid,$ingroups) AND $module['view'] == 5) 
				{ 
				  $sel = "selected"; 
				} 
				else 
				{ 
				   $sel = ""; 
				}
                
				echo "<option value='$gid'$sel>$gname</option>\n";
            }
            
			echo "</select><br /><br />\n";
        }
      
	  echo '</td>';
      echo '</tr>';

      echo '<tr>';
      echo '<td class="row1" style="width: 50%;">'.$admlang['blocks']['visible'].'</td>';
      echo '<td class="row1" style="width: 50%;">';
      echo '<select name="blocks" style="cursor: pointer; font-size: 11px !important; font-family: Verdana,Geneva,Arial,Helvetica,sans-serif; letter-spacing: 1px; margin: 0px 1px 1px; padding: 5px;">';
      echo '<option value="0"'.(($module['blocks'] == 0) ? ' selected="selected"' : '').'>'.$admlang['global']['none'].'</option>';
      echo '<option value="1"'.(($module['blocks'] == 1) ? ' selected="selected"' : '').'>'.$admlang['global']['left'].'</option>';
      echo '<option value="2"'.(($module['blocks'] == 2) ? ' selected="selected"' : '').'>'.$admlang['global']['right'].'</option>';
      echo '<option value="3"'.(($module['blocks'] == 3) ? ' selected="selected"' : '').'>'.$admlang['global']['both'].'</option>';
      echo '</select><br />';
      echo '</td>';
      echo '</tr>';

      echo '<tr>';
      echo '<td class="row1" style="width: 50%;">'.$admlang['modules']['inmenu'].'</td>';
      echo '<td class="row1" style="width: 50%;">';
      echo '<select name="inmenu" style="cursor: pointer; font-size: 11px !important; font-family: Verdana,Geneva,Arial,Helvetica,sans-serif; letter-spacing: 1px; margin: 0px 1px 1px; padding: 5px;">';
      echo '<option value="0"'.(($module['inmenu'] == 0) ? ' selected="selected"' : '').'>'.$admlang['global']['no'].'</option>';
      echo '<option value="1"'.(($module['inmenu'] == 1) ? ' selected="selected"' : '').'>'.$admlang['global']['yes'].'</option>';
      echo '</select><br />';
      echo '</td>';
      echo '</tr>';

      echo '<tr>';
      echo '<td class="catBottom" colspan="2" style="text-align: center;"><input type="submit" value="'.$admlang['global']['save_changes'].'" /></td>';
      echo '</tr>';
      echo '</table>';
      echo '</form>';
   }
   else
   {

   }
   CloseTable();
}

function modadmin_activate($module) 
{
   global $prefix, $db, $cache, $debugger;
   
   $result = $db->sql_query('SELECT active FROM '.$prefix."_modules WHERE mid=$module");
   
   if($db->sql_numrows($result) > 0) 
   {
      list($active) = $db->sql_fetchrow($result);
      
	  if(is_numeric($active)) 
      {
         $active = intval(!$active);
         $db->sql_query('UPDATE '.$prefix."_modules SET active='$active' WHERE mid=$module");
      }
   }
   
   $cache->delete('active_modules');
   $cache->resync();
}

function modadmin_activate_all($type) 
{
   global $prefix, $db, $cache;
   
   $active = ($type == 'all') ? '1;' : "0 WHERE `title` <> 'Your_Account' AND `title` <> 'Profile';";
   $sql = "UPDATE `".$prefix."_modules` SET `active`=".$active;
   $db->sql_query($sql);
   $cache->delete('active_modules');
   $cache->resync();
}

function modadmin_home($mid) 
{
   global $prefix, $db, $cache;
   
   list($title) = $db->sql_ufetchrow("SELECT title FROM ".$prefix."_modules WHERE mid='$mid'",SQL_NUM);
   
   if ($title == '' || $title == 'Evo_UserBlock') 
   {
      return false;
   }
   
   $db->sql_query("UPDATE ".$prefix."_main SET main_module='$title'");
   $db->sql_query("UPDATE ".$prefix."_modules SET active=1, view=0 WHERE mid='$mid'");
   $cache->delete('main_module');
   $cache->delete('active_modules');
   $cache->resync();
}

function modadmin_edit_save($mid) 
{
   global $prefix, $db, $admin_file, $cache;
   
   $title = null;
   
   if(!isset($ingroups))
   $ingroups = null;
   
   if($_POST['view'] == 6) 
   {
      if (!isset($_POST['add_groups']) || empty($_POST['add_groups'])) 
      {
         DisplayError(_MOD_ERROR_GROUPS);
      }
   
      $ingroups = implode("-", $_POST['add_groups']);
   }
   
   if(isset($_POST['link'])) 
   {
      Validate($_POST['custom_title'], 'url', 'modules');
	  $view = (int) $_POST['view'];
      $title = '~l~'.Fix_Quotes($_POST['title']);
      $custom_title = Fix_Quotes($_POST['custom_title']);
      $db->sql_query("UPDATE `".$prefix."_modules` SET `custom_title`='$custom_title', `title`='$title', `view`=$view, `groups`='$ingroups' WHERE `mid`=$mid");
   } 
   else 
   {
      $view = (int) $_POST['view'];
      $inmenu = (int) $_POST['inmenu'];
      $blocks = (int) $_POST['blocks'];	  
      $custom_title = Fix_Quotes($_POST['custom_title']);
      $db->sql_query("UPDATE `".$prefix."_modules` SET `custom_title`='$custom_title', `view`=$view, `inmenu`=$inmenu, `blocks`=$blocks, `groups`='$ingroups' $title WHERE `mid`=$mid");
   }
}

//---------------------
// AJAX MODULE SORT
//---------------------
function modadmin_get_inactive () 
{
    global $prefix, $db, $cache, $admlang;

    if(!$result = $db->sql_query("SELECT `mid`, `title`, `custom_title`, `active`, `view`, `inmenu`, `blocks` FROM `".$prefix."_modules` WHERE `cat_id`=0 AND `inmenu`<>0 ORDER BY `pos` ASC"))     {
        DisplayError($admlang['modblock']['no_values']);
    }
    
	$out = $db->sql_fetchrowset($result);
    $db->sql_freeresult($result);
    return $out;
}

function modadmin_ajax_header () 
{
    global $element_ids, $modadmin_module_cats;

    foreach ($modadmin_module_cats as $cat) 
	{
        if ($cat['cid'] == 1) 
		{
            continue;
        }
        
		$element_ids[] = 'ul'.$cat['cid'];
    }
    
	$element_ids[] = 'left_col';
    include_once(NUKE_BASE_DIR.'header.php');
}

function modadmin_block () 
{
    global $lang_evo_userblock, $admin_file, $module_collapse, $Default_Theme, $module_name, $board_config, $userinfo, $modadmin_module_cats, $bgcolor2, $admlang;

    $inactive = modadmin_get_inactive();

    $total = count($modadmin_module_cats);

    OpenTable();

    //Notes
    OpenTable();
    echo "<div align=\"center\">\n";
    echo "<span style=\"background-color : #bf0909;\">".$admlang['global']['title']."</span>&nbsp;-&nbsp;".$admlang['modblock']['is_inactive']."<br />\n";
    echo "<span style=\"color: blue;\">".$admlang['global']['title']."</span>&nbsp;-&nbsp;".$admlang['modblock']['is_link']."<br />\n";
    echo get_evo_icon('evo-sprite delete')."&nbsp;-&nbsp;".$admlang['modblock']['link_delete']."<br />\n";
    echo get_evo_icon('evo-sprite trash-2')."&nbsp;-&nbsp;".$admlang['modblock']['delete']."<br />";
    echo get_evo_icon('evo-sprite edit')."&nbsp;-&nbsp;".$admlang['modblock']['edit']."<br />\n";
    echo get_evo_icon('evo-sprite sort-up').get_evo_icon('evo-sprite sort-down')."&nbsp;-&nbsp;".$admlang['modblock']['order']."<br /><br />\n";
    echo $admlang['modblock']['explain1'];
    echo "<br /><br />";
    echo "<input type=\"submit\" value=\"Refresh Screen\" onclick=\"window.location.reload()\" />";
    echo "<br /><br />";
    echo $admlang['modblock']['explain2'];
    echo "</div>\n";
    CloseTable();

    //Config
    OpenTable();
    echo "<div align=\"center\">\n";
    echo "<form action=\"".$admin_file.".php?op=modules&amp;area=block\" method=\"post\">\n";
    echo "<table border=\"0\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\">\n";
    echo "<tr><td align=\"right\">\n";
    echo $admlang['misc']['collapse'];
    echo "</td><td align=\"left\">\n";
    echo yesno_option('collapse',$module_collapse);
    echo "</td>\n";
    echo "</tr>\n";
    echo "</table>\n";
    echo "<br />";
    echo "<input type=\"submit\" value=\"".$admlang['global']['submit']."\" />";
    echo "</form>\n";
    echo "</div>\n";
    CloseTable();

    echo "<div align=\"center\">\n";
    echo "<table width=\"80%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\n";

    //Inactive
    echo "<tr><td width=\"33%\" align=\"center\" rowspan=\"1\">\n";
    echo "<div align=\"center\"><span style=\"font-weight: bold;\">N/A</span></div>";
    echo "<ul id=\"left_col\" class=\"sortable boxy\">\n";

    if(is_array($inactive)) 
    {
        foreach ($inactive as $element) 
        {
            $custom_title = (substr($element['title'],0,3) == '~l~') ? '<span style="color: blue;">'.substr($element['title'],3).'</span>' : $element['custom_title'];

            echo '<li class="'.(($element['active'] == 1) ? "active" : "inactive").'" id="mod'.$element['mid'].'" ondblclick="change_status('.$element['mid'].')">'
                .'<table class="col-12">'
                .'<tr>'
                .'<td class="col-8">'.$custom_title.'</td>'
                .'<td class="col-4 aright">'
                .'<a href="'.$admin_file.'.php?op=modules&amp;edit='.$element['mid'].'"><i class="far fa-edit" style="font-size: 20px" title="'.$admlang['modblock']['modedit'].'"></i></a>';

            if ( (substr($element['title'],0,3) == '~l~') ):

                echo '&nbsp;<a href="'.$admin_file.'.php?op=modules&amp;delete='.$element['mid'].'"><i class="far fa-trash-alt" style="font-size: 20px" title="'.$admlang['global']['delete'].'"></i></a>';

            endif;

            echo '</td>'
                .'</tr>'
                .'</table>'
                .'</li>';
        }
    }
    
	echo "</ul>\n";
    echo "</td>\n";
    echo "<td align=\"center\">\n";
    
	//Active
    if(is_array($modadmin_module_cats)) 
    {
        global $db, $prefix;
    
	    $i = 0;
    
	    foreach ($modadmin_module_cats as $cat) 
        {
            if ($cat['cid'] == 1) 
            {
                continue;
            }
    
	        $i++;
    
	        if($i == count($modadmin_module_cats)) 
            {
                $updown = "<a href=\"".$admin_file.".php?op=modules&amp;upcat=".$cat['pos']."\">".get_evo_icon('evo-sprite sort-up', $admlang['modblock']['sort_up'])."</a>";
            } 
            else 
			if($i != 1) 
            {
                $updown = "<a href=\"".$admin_file.".php?op=modules&amp;downcat=".$cat['pos']."\">".get_evo_icon('evo-sprite sort-down', $admlang['modblock']['sort_down'])."</a><a 
				href=\"".$admin_file.".php?op=modules&amp;upcat=".$cat['pos']."\">".get_evo_icon('evo-sprite sort-up', $admlang['modblock']['sort_up'])."</a>";
            } 
            else 
			if($i == 1) 
            {
                $updown = "<a href=\"".$admin_file.".php?op=modules&amp;downcat=".$cat['pos']."\">".get_evo_icon('evo-sprite sort-down', $admlang['modblock']['sort_down'])."</a>";
            }
            
			echo "<span style=\"font-weight: bold; text-align: 'center';\">".$cat['name']."&nbsp;&nbsp;<a 
			href=\"".$admin_file.".php?op=modules&amp;editcat=".$cat['cid']."\">".get_evo_icon('evo-sprite edit', $admlang['modblock']['edit'])."</a>&nbsp;<a 
			href=\"".$admin_file.".php?op=modules&amp;deletecat=".$cat['cid']."\">".get_evo_icon('evo-sprite trash-2', $admlang['modblock']['delete'])."</a>&nbsp;".$updown."</span>";
            
			echo "<ul id=\"ul".$cat['cid']."\" class=\"sortable boxy\">\n";
            $sql = 'SELECT * FROM `'.$prefix.'_modules` WHERE cat_id='.$cat['cid'].' AND `inmenu`<>0 ORDER BY `pos` ASC';
            $result = $db->sql_query($sql);
            
			while ($row = $db->sql_fetchrow($result)) 
            {
              echo '<li class="'.(($row['active'] == 1) ? "active" : "inactive").'" id="mod'.$row['mid'].'" ondblclick="change_status('.$row['mid'].')">'
                  .'<table class="col-12">'
                  .'<tr>'
                  .'<td class="col-10">'.$row['custom_title'].'</td>'
                  .'<td class="col-2"><a href="'.$admin_file.'.php?op=modules&amp;edit='.$row['mid'].'">'.get_evo_icon('evo-sprite edit', $admlang['modblock']['modedit']).'</a></td>'
                  .'</tr>'
                  .'</table>'
                  .'</li>';
            }
            
			$db->sql_freeresult($result);
            echo "</ul>\n";
        }
    }
    
	echo "</td></tr>\n";
    echo "<tr>\n";
    echo "<td colspan=\"3\" align=\"center\">";
    echo "<form action=\"\" method=\"post\">
              <br />
              <input type=\"hidden\" name=\"order\" id=\"order\" value=\"\" />
              <input type=\"submit\" onclick=\"getSort()\" value=\"".$admlang['global']['submit']."\" />
          </form>";
    echo "</td></tr>\n";
    echo "</table><br /><br />\n";

    echo '<table width="50%" border="0" cellpadding="4" cellspacing="1" class="forumline">';
    echo '<tr>';
    echo '<td class="row1" style="width: 50%">';
    echo '<form action="'.$admin_file.'.php?op=modules&amp;area=block" method="post">';
    echo '<table width="100%" border="0" cellpadding="4" cellspacing="1" class="forumline">';
    echo '<tr>';
    echo '<td class="row1" style="width: 50%">'.$admlang['global']['title'].'</td>';
    echo '<td class="row1" style="width: 50%"><input type="text" name="cat" id="cat" value="" size="30" maxlength="30" /></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td class="row1" style="width: 50%">';
    echo '<span style="float:left;">'.$admlang['modblock']['image'].'</span>';
    echo '<span class="tooltip-html icon-sprite icon-info" title="'.$admlang['modblock']['image_note'].'"></span>';
    echo '</td>';
    echo '<td class="row1" style="width: 50%"><input type="text" name="catimage" id="catimage" value="" size="30" maxlength="50" /></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td class="row1 acenter" colspan="2"><input type="submit" value="'.$admlang['global']['submit'].'" /></td>';
    echo '</tr>';
    echo '</table>';
    echo '</form>';
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td class="row1" style="width: 50%">';
    echo '<form action="'.$admin_file.'.php?op=modules&amp;area=block" method="post">';
    echo '<table width="100%" border="0" cellpadding="4" cellspacing="1" class="forumline">';
    echo '<tr>';
    echo '<td class="row1" style="width: 50%">'.$admlang['modblock']['link_title'].'</td>';
    echo '<td class="row1" style="width: 50%"><input type="text" name="linktitle" id="linktitle" value="" size="30" maxlength="30" /></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td class="row1" style="width: 50%">'.$admlang['global']['url'].'</td>';
    echo '<td class="row1" style="width: 50%"><input type="text" name="link" id="link" value="" size="30" maxlength="50" /></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td class="row1 acenter" colspan="2"><input type="submit" value="'.$admlang['global']['submit'].'" /></td>';
    echo '</tr>';
    echo '</table>';
    echo '</form>';
    echo '</td>';
    echo '</tr>';
    echo '</table>';
    echo "</div>";
    CloseTable();
}

function modadmin_get_module_cats () 
{
    global $modadmin_module_cats, $prefix, $db, $cache;

    static $cats;

    if (isset($cats) && is_array($cats)) $modadmin_module_cats = $cats;

    if(!($cats = $cache->load('module_cats', 'config'))) 
	{
        if(!$result = $db->sql_query("SELECT `cid`, `name`, `image`, `pos`, `link_type`, `link` FROM `".$prefix."_modules_cat` WHERE `name`<>'Home' ORDER BY `pos` ASC")) 
		{
            DisplayError($admlang['modblock']['no_values']);
        }
        
		if (!$cats = $db->sql_fetchrowset($result)) 
		{
            DisplayError($admlang['modblock']['no_values']);
        }
        
		$db->sql_freeresult($result);
        $cache->save('module_cats', 'config', $cats);
    }
    
	$modadmin_module_cats = $cats;
}

function modadmin_parse_data($data) 
{
  $containers = explode(":", $data);

  foreach($containers AS $container)
  {
      $container = str_replace(")", "", $container);
      $i = 0;
      $lastly = explode("(", $container);
      $values = explode(",", $lastly[1]);

      foreach($values AS $value)
      {
        if($value == '')
        {
            continue;
        }
        $key = str_replace('ul', '', $lastly[0]);
        $value = str_replace('mod','',$value);
        $final[$key][] = $value;
        $i ++;
      }
  }
  return $final;
}

function modadmin_write_cats ($data) 
{
    global $db, $prefix, $cache;

    if(is_array($data)) 
	{
        foreach ($data as $key => $modules) 
		{
            $i = 0;
        
		    foreach ($modules as $id) 
			{
                $key = ($key == 'left_col') ? '0' : $key;
                $sql = 'UPDATE `'.$prefix.'_modules` SET `cat_id`='.$key.', `pos`='.$i.' WHERE `mid`="'.$id.'"';
                $db->sql_query($sql);
                $i++;
            }
        }
    }
    
	$cache->delete('module_cats');
    $cache->resync();
}

function modadmin_new_cat ($name, $image) 
{
    global $db, $prefix, $cache;

    $result = $db->sql_query('SELECT COUNT(*) FROM `'.$prefix.'_modules_cat`');
    $num = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    $name = Fix_Quotes($name);
    $image = Fix_Quotes($image);
    $sql = 'INSERT INTO `'.$prefix.'_modules_cat` VALUES ("","'.$name.'","'.$image.'",'.($num[0]+1).', 0, "")';
    $result = $db->sql_query($sql);
    $cache->delete('module_cats');
    $cache->resync();
}

function modadmin_delete_cat ($cid) 
{
    global $db, $prefix, $cache;

    $sql = 'DELETE FROM `'.$prefix.'_modules_cat` WHERE `cid`='.$cid;
    $db->sql_query($sql);
    $sql = 'UPDATE `'.$prefix.'_modules` SET `cat_id`=0 WHERE `cat_id`='.$cid;
    $db->sql_query($sql);
    $cache->delete('module_cats');
    $cache->resync();
}

function modadmin_move_cat ($pos, $up) 
{
    global $db, $prefix, $cache;

    $where = ($up) ? ($pos - 1) : ($pos + 1);
    $sql = "UPDATE `".$prefix."_modules_cat` SET `pos`=127 WHERE `pos`=".$where;
    $db->sql_query($sql);
    $sql = "UPDATE `".$prefix."_modules_cat` SET `pos`=".$where." WHERE `pos`=".$pos;
    $db->sql_query($sql);
    $sql = "UPDATE `".$prefix."_modules_cat` SET `pos`=".$pos." WHERE `pos`=127";
    $db->sql_query($sql);
    $cache->delete('module_cats');
    $cache->resync();
}

function modadmin_edit_cat($cat) 
{
    global $prefix, $db, $admin_file, $cache, $admlang;

    $cat = Fix_Quotes($cat);

    if(!is_numeric($cat)) 
	{
        DisplayError($admlang['modblock']['not_found']);
    }
    $result = $db->sql_query('SELECT name, image FROM `'.$prefix.'_modules_cat` WHERE `cid` = '.$cat);
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);

    if(!isset($row[0]) || empty($row[0])) 
	{
        DisplayError($admlang['modblock']['not_found']);
    }

    $name = $row[0];
    $image = $row[1];

    include_once(NUKE_BASE_DIR.'header.php');
    
	OpenTable();
    echo "<fieldset><legend>".$admlang['modblock']['edit']."</legend>";
    echo "<form method=\"post\" action=\"".$admin_file.".php?op=modules\">\n";
    echo $admlang['global']['title'].":&nbsp;<input type=\"text\" name=\"cattitle\" id=\"title\" value=\"".$name."\" size=\"30\" maxlength=\"30\" />\n<br />";
    echo $admlang['modblock']['image'].":&nbsp;<input type=\"text\" name=\"catimage\" id=\"image\" value=\"".$image."\" size=\"30\" />\n<br />";
    echo "<input type=\"hidden\" name=\"catsave\" value=\"".$cat."\" />\n";
    echo "<input type=\"submit\" value=\"".$admlang['global']['save_changes']."\" />\n</form>\n</fieldset>\n";
    CloseTable();
    modadmin_title();
}

function modadmin_edit_cat_save($cat, $name, $image) 
{
    global $prefix, $db, $admin_file, $cache, $admlang;

    $name = Fix_Quotes($name);
    $image = Fix_Quotes($image);
    $cat = Fix_Quotes($cat);

    if(!is_numeric($cat)) 
	{
        DisplayError($admlang['modblock']['not_found']);
    }

    $sql = "UPDATE `".$prefix."_modules_cat` SET `name`=\"".$name."\", `image`=\"".$image."\" WHERE `cid`=".$cat;
    $db->sql_query($sql);
    $cache->delete('module_cats');
}

function modadmin_new_link ($title, $link) 
{
    global $db, $prefix, $cache, $admlang;

    if(empty($title) || empty($link)) DisplayError($admlang['modblock']['link_title_error']);

    $title = Fix_Quotes($title);
    $link = Fix_Quotes($link);
    Validate($link, 'url', 'modules');
    $sql = 'INSERT INTO `'.$prefix.'_modules` VALUES (NULL,"~l~'.$title.'","'.$link.'",0,0,1,0,0,1,"","")';
    $db->sql_query($sql);
    $cache->delete('module_links');
    $cache->resync();
}

function modadmin_delete_link ($mid) 
{
    global $db, $prefix, $cache;

    $sql = 'DELETE FROM `'.$prefix.'_modules` WHERE `mid`='.$mid.' AND `title` LIKE "~l~%"';
    $db->sql_query($sql);
    $cache->delete('module_links');
    $cache->resync();
}

function modadmin_add_scripts() 
{
    global $Sajax;
    
	if(!isset($script))
	$script = '';

    $script .= "function module_activate(mid) {
                    x_modadmin_activate(mid, confirm);
                    window.location.reload();
                }\n";
    $script .= "function change_status(bid) {
            var elem = document.getElementById(\"mod\"+bid);
            elem.className = ((elem.className == \"active\") ? \"inactive\" : \"active\");
            x_modadmin_activate(bid, confirm);
            }\n";
    $script .= "    function onDrop() {
                var data = DragDrop.serData('g2');
                x_sajax_update(data, confirm);
            }\n";
    $script .= "function getSort()
                {
                  order = document.getElementById(\"order\");
                  order.value = DragDrop.serData('g1', null);
                }\n";
    $script .= "function showValue()
                {
                  order = document.getElementById(\"order\");
                  alert(order.value);
                }\n";
    $Sajax->sajax_add_script($script);
}
//---------------------------------------------------------------------
// AJAX MODULE SORT
//---------------------------------------------------------------------

//---------------------------------------------------------------------
// ACTIVATE AN INACTIVE MODULE
//---------------------------------------------------------------------
if(isset($_GET['a'])) 
{
   (intval($_GET['a'])) ? modadmin_activate(intval($_GET['a'])) :  modadmin_activate_all($_GET['a']);
}

//---------------------------------------------------------------------
// SET THE CLICKED MODULE AS HOME
//---------------------------------------------------------------------
if(isset($_GET['h'])) 
{
   (intval($_GET['h'])) ? modadmin_home(intval($_GET['h'])) :  '';
}

//---------------------------------------------------------------------
// SAVE THE MODULE CHANGES
//---------------------------------------------------------------------
if(isset($_POST['save'])) 
{
   modadmin_edit_save(intval($_POST['save']));
}

if(isset($_POST['cat'])) 
{
   if(!empty($_POST['cat'])) 
   {
      modadmin_new_cat($_POST['cat'], $_POST['catimage']);
   }
}

if(isset($_POST['linktitle']) && isset($_POST['link'])) 
{
   if(!empty($_POST['linktitle']) && !empty($_POST['link'])) 
   {
      modadmin_new_link($_POST['linktitle'], $_POST['link']);
   }
}

if (isset($_POST['order']))
{
   $data = modadmin_parse_data($_POST['order']);
   modadmin_write_cats($data);
   // redirect so refresh doesnt reset order to last save
   redirect($admin_file.".php?op=modules&area=block");
}

if(isset($_GET['delete'])) 
{
   modadmin_delete_link($_GET['delete']);
   redirect($admin_file.".php?op=modules&area=block");
}

if(isset($_GET['deletecat'])) 
{
   modadmin_delete_cat($_GET['deletecat']);
   redirect($admin_file.".php?op=modules&area=block");
}

if(isset($_GET['upcat']) || isset($_GET['downcat'])) 
{
   $up = (isset($_GET['upcat'])) ? 1 : 0;
   modadmin_move_cat((isset($_GET['upcat'])) ? $_GET['upcat'] : $_GET['downcat'], $up);
   redirect($admin_file.".php?op=modules&area=block");
}

if(isset($_POST['collapse']) && is_int(intval($_POST['collapse']))) 
{
   global $db, $prefix, $module_collapse, $cache;
   $db->sql_query('UPDATE `'.$prefix.'_evolution` SET `evo_value`="'.intval($_POST['collapse']).'" WHERE `evo_field`= "module_collapse"');
   $module_collapse = intval($_POST['collapse']);
   $cache->delete('titanium_evoconfig');
   $cache->resync();
}

if(isset($_GET['editcat'])) 
{
   modadmin_edit_cat($_GET['editcat']);
   include_once(NUKE_BASE_DIR.'footer.php');
   die();
}

if(isset($_POST['catsave'])) 
{
   modadmin_edit_cat_save($_POST['catsave'], $_POST['cattitle'], $_POST['catimage']);
   redirect($admin_file.".php?op=modules&area=block");
}
if(!isset($area))
$area = null;

switch ($area) 
{
   case 'block':
      define('USE_DRAG_DROP', true);
      require_once(NUKE_INCLUDE_DIR.'ajax/Sajax.php');
      global $Sajax;
      $Sajax = new Sajax();
      $Sajax->sajax_export("sajax_update", "modadmin_activate");
      $Sajax->sajax_handle_client_request();
      modadmin_add_scripts();
      global $modadmin_module_cats;
      modadmin_get_module_cats();
      modadmin_ajax_header();
      modadmin_title();
      modadmin_block();
      modadmin_title();
      break;
   default:
      include_once(NUKE_BASE_DIR.'header.php');
      modadmin_title();
	  
	  if(!isset($_GET['edit']))
	  $_GET['edit'] = null;
	  
	  $modadmin_modules = modadmin_get_modules((int) $_GET['edit']);
      (isset($_GET['edit'])) ? modadmin_edit_module($modadmin_modules[0]) : modadmin_dispaly_modules($modadmin_modules);
       modadmin_title();
	   break;
}

include_once(NUKE_BASE_DIR.'footer.php');

