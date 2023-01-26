<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System  
 =======================================================================*/

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
/* Titanium Portal Menu                                                 */
/* By: The 86it Developers Network                                      */
/* https://www.86it.us                                                  */
/* Copyright (c) 2019 Ernest Buffington                                 */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
-=[Mod]=-
	  Titanium Patched                         v3.0.0       08/28/2019
 ************************************************************************/
 echo "\n<!-- Loading blocks/block-Titanium_Portal_Menu.php -->\n";

 if(!defined('NUKE_EVO')): 
   exit;
 endif;

       global $db, 
		   $admin, 
		    $user, 
	      $prefix, 
          $cookie, 
	  $def_module, 
	    $bgcolor1, 
		$bgcolor2, 
		$bgcolor3, 
		$bgcolor4,
      $userpoints, 
             $uid;
			 
      global $user_prefix, $def_module, $currentlang, $cache;			 


if(file_exists(NUKE_LANGUAGE_DIR.'Menu/lang-'.$currentlang.'.php')): 
  include_once(NUKE_LANGUAGE_DIR.'Menu/lang-'.$currentlang.'.php');
else: 
  include_once(NUKE_LANGUAGE_DIR.'Menu/lang-english.php');
endif;

$userpoints=(int) $userpoints; 

global $menu_image_height;

$gestiongroupe = 1; 

$managment_group = 1; 

$detectPM = 1; # Put 0 to deactivate the detection of the Private Messages.  (gains 1 SQL query)

$horizontal = 0;

$div = 0;

/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
if(!($row = $cache->load('menu_row', 'titanium_block'))) 
{
  $sql = "SELECT t1.invisible, t2.main_module FROM ".$prefix."_menu AS t1, ".$prefix."_main AS t2 LIMIT 1";
  $result = $db->sql_query($sql);
  $row = $db->sql_fetchrow($result);
  $cache->save('menu_row', 'titanium_block', $row);
}
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/

$is_admin = (is_admin($admin)) ? 1 : 0 ;

# one will test if the visitor is an admin and or a member.
$is_user = (is_user()) ? 1 : 0 ;

# get the current theme.
$ThemeSel = get_theme(); 

if(isset($cookie[0]))
$uid = $cookie[0];

if(!isset($newpms))
$newpms = 0;

global $use_theme_image_dir_for_portal_menu;

$path_icon = $use_theme_image_dir_for_portal_menu == true ? "themes/$ThemeSel/images/menu" : "images/menu";

$imgnew = "new.gif";

if(($is_user == 1) && ($detectPM === 1)):
  $uid=(int) $uid; 
  $newpms = $db->sql_fetchrow($db->sql_query("SELECT COUNT(*) FROM " . $prefix . "_bbprivmsgs 
  WHERE privmsgs_to_userid='$uid' AND (privmsgs_type='5' OR privmsgs_type='1')")); 
endif;

# START Caching System
    if($managment_group === 1):
     $sql = "SELECT * FROM ".$prefix."_modules WHERE active='1' AND inmenu='1' AND `title` NOT LIKE '~l~%' ORDER BY custom_title ASC";
    else:
     $sql = "SELECT * FROM ".$prefix."_modules WHERE active='1' AND inmenu='1' AND `title` NOT LIKE '~l~%' ORDER BY custom_title ASC";   
	endif;
   
   $modules_attach = $db->sql_query($sql);

   while($tempo = $db->sql_fetchrow($modules_attach)): 
        $tempoA[] = $tempo;
   endwhile;
# END Caching System
	
$counter = 0;
    
if(is_array($tempoA)): 
   foreach($tempoA as $tempo): 
      $module[$counter] = $tempo['title'];
      $customtitle[$counter] = $tempo['custom_title'];
      $view[$counter] = $tempo['view'];
  //    $active[$row['title']] = $tempo['active'];
      $mod_group[$counter] = ($managment_group === 1) ? $tempo['groups'] : "";
      $counter++;
      if ($tempo['view'] == 3): 
	    $gestionsubscription = "yes";
	  endif;
   endforeach;
endif;

# Not entirely sure what the fuck is going on here?
if(file_exists("themes/$ThemeSel/module.php")): 

    include("themes/$ThemeSel/module.php");

    $is_active = ($active[$default_module] != 0) ? 1 : 0 ; 
    
	if($is_active == 1 && file_exists("modules/$default_module/index.php")): 
      $main_module = $default_module;
	endif;
    
endif;

$total_actions = "";

$flagmenu = 0;  

# START Caching System
if(!($row2A = $cache->load('menu_row', 'titanium_block'))):
    $sql2= "SELECT groupmenu, 
	                  module, 
					     url, 
					url_text, 
					   image, 
					     new, 
					new_days, 
					   class, bold FROM ".$prefix."_menu_categories ORDER BY id ASC";

    $result2 = $db->sql_query($sql2);

    while($row2 = $db->sql_fetchrow($result2)): 
        if(isset($row2))
		$row2A[] = $row2;
    endwhile; 

   $cache->save('menu_row2', 'titanium_block', $row2A);
endif;
# END Caching System
 
                                   $counter  = 0;
                              $totalcounter  = 0;
                                  $categorie = isset($row2A[0]['groupmenu']);
   $moduleinthisgroup[$categorie][$counter]  = isset($row2A[0]['module']);
     $linkinthisgroup[$categorie][$counter]  = isset($row2A[0]['url']);
 $linktextinthisgroup[$categorie][$counter]  = isset($row2A[0]['url_text']);
    $imageinthisgroup[$categorie][$counter]  = isset($row2A[0]['image']);
      $newinthisgroup[$categorie][$counter]  = isset($row2A[0]['new']);
  $newdaysinthisgroup[$categorie][$counter]  = isset($row2A[0]['new_days']);
    $classinthisgroup[$categorie][$counter]  = isset($row2A[0]['class']);
     $grasinthisgroup[$categorie][$counter]  = isset($row2A[0]['bold']);
       $totalcategorymodules[$totalcounter]  = isset($row2A[0]['module']); 
                                  $counter2  = $categorie;
                             $total_actions  = "menu_showhide('menu-".isset($row2A[0]['groupmenu'])."','nok','menuupdown-".isset($row2A[0]['groupmenu'])."');";
                              $totalcounter  = 1;

unset($row2A[0]);

    if(is_array($row2A)): 
	
      foreach($row2A as $row2): 
        $categorie = isset($row2['groupmenu']);
        $totalcategorymodules[$totalcounter] = isset($row2['module']);
        $totalcounter++;

        if($counter2 == $categorie): 
        $counter++;
        else :
            $total_actions = $total_actions."menu_showhide('menu-".$row2['groupmenu']."','nok','menuupdown-".$row2['groupmenu']."');";
            $counter = 0;
        endif;
        
		  $moduleinthisgroup[$categorie][$counter] = isset($row2['module']);
            $linkinthisgroup[$categorie][$counter] = isset($row2['url']);
        $linktextinthisgroup[$categorie][$counter] = isset($row2['url_text']);
		
           $imageinthisgroup[$categorie][$counter] = isset($row2['image']);
        
		     $newinthisgroup[$categorie][$counter] = isset($row2['new']);
         $newdaysinthisgroup[$categorie][$counter] = isset($row2['new_days']);
           $classinthisgroup[$categorie][$counter] = isset($row2['class']);
            $grasinthisgroup[$categorie][$counter] = isset($row2['bold']);
                                         $counter2 = $categorie;
      endforeach;
    endif;

$content ="\n\n\n\n\n<!-- Titanium Menu v5.01 -->\n\n\n\n\n";
 
$sql="SELECT t1.invisible, 
		   t2.main_module FROM ".$prefix."_menu AS t1, ".$prefix."_main AS t2 WHERE t1.groupmenu=99 limit 1";

         $result = $db->sql_query($sql);
            $row = $db->sql_fetchrow($result);
    $main_module = $row['main_module'];
 $type_invisible = $row['invisible'];

if($managment_group === 1): 
  $managment_group = ($row['invisible'] == "4" || $row['invisible'] == "5") ? 1 : 0 ;
else: 
  $managment_group = 0;
endif;

# this is the start of the Portal menu
$sql = "SELECT * FROM ".$prefix."_modules WHERE active='1' AND inmenu='1' ORDER BY custom_title ASC";
	
$modules_attach = $db->sql_query($sql);

$menu_counter = 0;
	
	while($tempo = $db->sql_fetchrow($modules_attach)): 
		   $module[$menu_counter] = $tempo['title'];
	  $customtitle[$menu_counter] = (stripslashes((string) $tempo['custom_title'])); //strip the fucking slashes
		     $view[$menu_counter] = $tempo['view'];
		//   $active[$row['title']] = $tempo['active'];
		$mod_group[$menu_counter] = ($managment_group==1 && isset($tempo['mod_group'])) ? $tempo['mod_group'] : "";
		$nsngroups[$menu_counter] = $tempo['groups'] ?? "" ; 
		   $gt_url[$menu_counter] = $tempo['url'] ?? "" ; 
	
		$menu_counter++;
	
		if($tempo['view'] == 3): 
	      $gestionsubscription = "yes";
		endif;
	endwhile;

    $ferme_sublevels = "";
      $total_actions = "";
           $flagmenu = 0;  
	
	$sql2= "SELECT groupmenu, 
	                  module, 
					     url, 
					url_text, 
					   image, 
					     new, 
				    new_days, 
					   class, 
					    bold, 
					sublevel, 
					    days 
						
						FROM ".$prefix."_menu_categories ORDER BY id ASC";
						
	$result2 = $db->sql_query($sql2);
	
	 $menu_counter = 0;
	$totalcounter = 0;
	      $premier = 0;
	       $hidden = 0;
  $hidden_sublevel = 0;
	
	$now=time(); 
	
	while($row2 = $db->sql_fetchrow($result2)): 
	
	   if(str_contains((string) $row2['days'],'8') ) 
	   {
			if($menu_counter2 != $row2['groupmenu']) 
			{
				$hidden_sublevel = 0;
			}
				$hidden = 1;
			
				if($hidden_sublevel == 0) 
				{
					$hidden_sublevel = $row2['sublevel'];
				}
				else 
				{
					$hidden_sublevel = ($row2['sublevel'] < $hidden_sublevel) ? $row2['sublevel'] : $hidden_sublevel;
				}
				
			continue;
		}
		
		
		if ($row2['module'] == "MENUTEXTONLY" || $row2['module'] == "External Link")
		{
			$poster_module = 1;
		}
		else 
		{ 
			$poster_module = 0;
			$restricted_reason = "";
		
			foreach ($module as $key => $this_module) 
			{
				if($row2['module'] == "External Link") 
				{
					$temponomdumodule= preg_split('#/#', (string) $row2['url'], -1, PREG_SPLIT_NO_EMPTY); //ern
					
					if (preg_match("^((http(s)?)|(ftp(s)?))://".$_SERVER['SERVER_NAME']."/modules.php\?name=^",(string) $row2['url'])) {
         $nomdumodule = substr(strstr($temponomdumodule[0],'modules.php'),17);
         $targetblank = "target=\"_tab\"";
     } elseif (preg_match("^((http(s)?)|(ftp(s)?))://".$_SERVER['SERVER_NAME']."/modules.php\?name=^",(string) $row2['url'])) {
         $nomdumodule = substr(strstr($temponomdumodule[0],'modules.php'),17);
         $targetblank = "";
     } else 
					{
						$nomdumodule = str_replace("modules.php\?name=","",$temponomdumodule[0]);
						$targetblank = "";
					}
					
					$customtitle2 = (stripslashes((string) $row2['url_text']));
					$urldumodule = $row2['url'];
				}
				else 
				{   # module normal
					$temponomdumodule = [];
					     $targetblank = "";
					     $nomdumodule = $row2['module'];
					$fix_customtitle2 = ($customtitle[$key] != "") ? $customtitle[$key] : str_replace("_", " ", (string) $this_module);
					    $customtitle2 = (stripslashes((string) $fix_customtitle2));
					     $urldumodule = ($gt_url[$key] != "") ? $gt_url[$key] : "modules.php?name=".$nomdumodule ; 
				}
				
					if (($is_admin === 1 && $view[$key] == 2 || $view[$key] != 2) && $nomdumodule == $this_module) {
         $isin = 0;
         if($is_user == 1 && $view[$key] == 1 && $type_invisible == 4 && $isin === 0) 
  							{
  								    $poster_module = 2;
  								$restricted_reason = ""._MENU_RESTRICTEDGROUP."";
  								break;
  							}
  							elseif($is_user == 0 && $view[$key] == 1 && ($type_invisible == 2 || $type_invisible == 4)) 
  							{
  								    $poster_module = 2;
  								$restricted_reason = ""._MENU_RESTRICTEDMEMBERS."";
  								break;
  							}
         if($is_user == 1 && $view[$key] == 1 && $type_invisible == 5 && $isin === 0 && $is_admin == 0) 
  							{ 
  								if($menu_counter2 != $row2['groupmenu']) 
  								{
  									$hidden_sublevel = 0;
  								}
  					
  								$hidden = 1;
  								
  								if($hidden_sublevel == 0) 
  								{
  									$hidden_sublevel = $row2['sublevel'];
  								}
  								else 
  								{
  									$hidden_sublevel = ($row2['sublevel']<$hidden_sublevel) ? $row2['sublevel'] : $hidden_sublevel;
  								}
  							}
  							elseif($is_user == 0 && $view[$key] == 1 && ($type_invisible == 5 || $type_invisible == 3) && $is_admin == 0) 
  							{
  								if($menu_counter2 != $row2['groupmenu']) 
  								{
  									$hidden_sublevel = 0;
  								}
  								
  								$hidden = 1;
  								
  								if($hidden_sublevel == 0) 
  								{
  									$hidden_sublevel = $row2['sublevel'];
  								}
  								else 
  								{
  									$hidden_sublevel = ($row2['sublevel']<$hidden_sublevel) ? $row2['sublevel'] : $hidden_sublevel;
  								}
  							}
  							elseif($view[$key] > 3 && ($type_invisible == 3 || $type_invisible == 5) && !in_groups($nsngroups[$key])) 
  							{
  								if($menu_counter2 != $row2['groupmenu']) 
  								{
  									$hidden_sublevel = 0;
  								}
  					
  								$hidden = 1;
  								
  								if($hidden_sublevel == 0) 
  								{
  									$hidden_sublevel = $row2['sublevel'];
  								}
  								else 
  								{
  									$hidden_sublevel = ($row2['sublevel'] < $hidden_sublevel) ? $row2['sublevel'] : $hidden_sublevel;
  								}
  							}
  							else 
  							{
  								$poster_module = 1;
  							}
         break;
     }
				}
		}
		
		if($poster_module > 0) 
		{
			                           $categorie = $row2['groupmenu'];
			$totalcategorymodules[$totalcounter] = $row2['module'];
			
			$totalcounter++;
			
			if ($premier == 0) {
       $premier++;
       $total_actions = "menu_showhide('menu-".$row2['groupmenu']."','nok','menuupdown-".$row2['groupmenu']."');";
   } elseif ($menu_counter2 == $categorie) {
       $menu_counter++;
   } else 
			{
				$total_actions = $total_actions."menu_showhide('menu-".$row2['groupmenu']."','nok','menuupdown-".$row2['groupmenu']."');";
				$menu_counter = 0;
				$hidden_sublevel = 0;
				$hidden = 0;
			}
							
			if ($menu_counter == 0 && $row2['sublevel'] > 0) {
       $hidden = 1;
       $hidden_sublevel = 0;
       $row2['sublevel'] = 0;
   } elseif ($row2['sublevel'] > $hidden_sublevel && $hidden==1) {
       $row2['sublevel'] -= $hidden_sublevel;
       if($hidden_sublevel == 0) 
   				{
   					$row2['sublevel']--;
   				}
   } else 
			{
				$hidden_sublevel = 0;
				$hidden = 0;
			}

			       $moduleinthisgroup[$categorie][$menu_counter] = $row2['module'];
			         $linkinthisgroup[$categorie][$menu_counter] = $row2['url'];
			     $linktextinthisgroup[$categorie][$menu_counter] = $row2['url_text'];
				 
			        $imageinthisgroup[$categorie][$menu_counter] = $row2['image'];
					
			          $newinthisgroup[$categorie][$menu_counter] = $row2['new'];
			      $newdaysinthisgroup[$categorie][$menu_counter] = $row2['new_days'];
			        $classinthisgroup[$categorie][$menu_counter] = $row2['class'];
			         $grasinthisgroup[$categorie][$menu_counter] = $row2['bold'];
			     $sublevelinthisgroup[$categorie][$menu_counter] = $row2['sublevel'];
		//	   $date_debutinthisgroup[$categorie][$menu_counter] = $row2['date_debut'];
		//	     $date_fininthisgroup[$categorie][$menu_counter] = $row2['date_fin'];
			         $daysinthisgroup[$categorie][$menu_counter] = $row2['days'];
			  $nomdumoduleinthisgroup[$categorie][$menu_counter] = $nomdumodule;
			  $targetblankinthisgroup[$categorie][$menu_counter] = $targetblank;
			 $customtitle2inthisgroup[$categorie][$menu_counter] = $customtitle2;
			  $urldumoduleinthisgroup[$categorie][$menu_counter] = $urldumodule;
			$poster_moduleinthisgroup[$categorie][$menu_counter] = $poster_module;
			           $whyrestricted[$categorie][$menu_counter] = $restricted_reason;
			                                  $restricted_reason = "";
			
			$menu_counter2 = $categorie;
		}
	endwhile;

$content = "";
echo "<!-- START Titanium Portal Menu Javascript Functions v1.0 -->\n";
?>
<script >
function menu_listbox(page) 
{
	var reg= new RegExp('(_menu_targetblank)$','g');

	if(reg.test(page)) 
	{
		page=page.replace(reg,"");
		window.open(page,'','menubar=yes,status=yes, location=yes, scrollbars=yes, resizable=yes');
	}
	else 
	if(page!="select") 
	{
	   top.location.href=page;
	}
}				

function menu_over_popup(page,nom,option) 
{
	window.open(page,nom,option);
}
</script>

<style>
.menunowrap 
{
  white-space: nowrap;
}
</style>
<?php
echo "<!-- END Titanium Portal Menu Javascript Functions v1.0 -->\n\n";
# MAIN MENU 
	$dynamictest=0;
	
	global $prefix, $db;

    $sql = "SELECT groupmenu, 
	                    name, 
					   image, 
					    lien, 
						  hr, 
					 bgcolor, 
				   invisible, 
				       class, 
					    bold, 
						 new, 
					    days 
	
	FROM ".$prefix."_menu ORDER BY groupmenu ASC";
    
	$result = $db->sql_query($sql);
	
	global $textcolor1,
	       $textcolor2,
             $bgcolor1,
             $bgcolor2,
             $bgcolor3,
             $bgcolor4,
		  $portaladmin, 
	           $prefix, 
	  $portaladminname,    
			   $domain, 
			      $uid, 
			 $ThemeSel;
	
	   $align = 'middle'; # added by Ernest Buffingtn to align the new.gif image
	$aligncat = 'style="text-align:left"'; # added by Ernest Buffingtn to align the link text left
	
    [$portaladminname, $avatar, $email] = $db->sql_ufetchrow("SELECT `username`,`user_avatar`, `user_email` FROM `".$prefix."_users` WHERE `user_id`='$portaladmin'", SQL_NUM);

    $content .= "\n";
	
 	$content .= "&nbsp;&nbsp;&nbsp;<img width=\"21\" style=\"vertical-align: left;\" src=\"images/menu/home.gif\" title=\""._MENU_NEWCONTENT."\" alt=\""._MENU_NEWCONTENT."\">";

	$content .= "&nbsp;<a class=\"modules\" href=\"index.php\"><strong>Home</strong></a>";	
	
	$content .= "<table class=\"table100\">\n";
	$content .= "<tr><td width=\"100%\"></td><td id=\"menu_block\"></td></tr>\n";
	
	if($horizontal == 1) 
	{
		$content.="<tr>\n";
	}
	
	$classpointer = 0;
    
	while ($row = $db->sql_fetchrow($result)) 
	{  
		                $som_groupmenu = $row['groupmenu'];
		                     //$som_name = str_replace("&amp;nbsp;","&nbsp;",$row['name']);
							 $som_name = str_replace('&amp;nbsp;', '&nbsp;', $row['name'] ?? '');
							  
		                    $sub_image = $row['image'];
		                     
							 $som_lien = $row['lien'];
		                       $som_hr = $row['hr'];
		    //               $som_center = $row['center'];
		                  $som_bgcolor = $row['bgcolor'];
						  
						  if(empty($som_bgcolor))
						  $som_bgcolor = 'transparent';
						  
		    $invisible[$classpointer] = $row['invisible'];
		$categoryclass[$classpointer] = $row['class'];
		                     $som_bold = $row['bold'];
		                      $som_new = $row['new'];
		  //                $som_listbox = $row['listbox'];
		    //              $som_dynamic = ($general_dynamic == 0) ? '' : $row['dynamic']; 
		      //         $som_date_debut = $row['date_debut'];
		         //        $som_date_fin = $row['date_fin'];
		                     $som_days = $row['days'];
		                          $key = $row['groupmenu'];
		
		//if(strpos($som_days,'8')!== false || $now < $som_date_debut || ($som_date_fin > 0 && $now > $som_date_fin)) 
		//{
		//	
		//	     $aenlever = "menu_showhide\('menu-".$som_groupmenu."','nok','menuupdown-".$som_groupmenu."'\);";
		//	$total_actions = str_replace("$aenlever", "" , $total_actions);
		//	continue;
		//}
		
		//if($som_dynamic != 'on') 
		//{
			$aenlever = "menu_showhide\('menu-".$som_groupmenu."','nok','menuupdown-".$som_groupmenu."'\);";
			$total_actions = str_replace("$aenlever", "" , $total_actions);
		//}
		
		//$dynamictest = 1;
		
		if($som_hr == "on" && $horizontal != 1) 
		{
			$content .= "<tr><td><hr width=\"100%\"></td></tr>\n"; # 15 mars 2005 : adjust the width to 100%
		}

		if($som_groupmenu != 99) 
		{
			
		  //if($som_dynamic=='on' && $detectMozilla!=1 && isset($moduleinthisgroup[$som_groupmenu]['0']) && $som_listbox!="on") 
		    //if($som_dynamic == 'on' && isset($moduleinthisgroup[$som_groupmenu]['0']) && $som_listbox != "on"): 
			//	      $reenrouletout = str_replace("menu_showhide\(\'menu-$som_groupmenu\',\'nok\',\'menuupdown-$som_groupmenu\'\);","",$total_actions);
			//	$action_somgroupmenu = "onclick=\"keymenu=".$key.";".$reenrouletout." menu_showhide('menu-$som_groupmenu','ok','menuupdown-$som_groupmenu')\" style=\"cursor:pointer\"";            // menu dynamic
			//else: 
			  $action_somgroupmenu = "";
			//endif;
			
			if($horizontal == 1) 
			{
				$content .= "<td style=\"background-color:$som_bgcolor;\" width=\"4\"></td><td style=\"background-color:$som_bgcolor;\" class=\"menunowrap\" valign=\"top\"><table class=\"table100 menunowrap\"><tr><td $action_somgroupmenu>\n";
			}
			else 
			{
				$positioningtd = ($div == 1) ? "" : "" ;
			    
				$content .= "<tr style=\"background-color:$som_bgcolor;\">\n";
				
				$content .= "<td height=\"4\" width=\"100%\"></td><td id=\"menu_divsublevel$key\"></td>\n";
				
				$content .= "</tr>\n";
			    
				$content .= "<tr><td style=\"background-color:$som_bgcolor;\" class=\"menunowrap\" width=\"100%\" $action_somgroupmenu>\n";
			}
			
			//if($som_center == "on") 
			//{
			//	$content .= "<div align=\"center\">\n";
			//}
			
			if($som_lien != "") 
			{
				if(str_starts_with((string) $som_lien, "LANG:_")) 
				{ 
					$som_lien = str_replace("LANG:","",(string) $som_lien);
					eval( "\$som_lien = $som_lien;");
				}
				
				$testepopup=strpos((string) $som_lien,"javascript:window.open(");
				
				if($testepopup === 0) 
				{
					$som_lien = str_replace("window.open","menu_over_popup",(string) $som_lien);
					$content .= "<a href=\"$som_lien\"";
				}
				else 
				{
				  $content .= "<a href=\"$som_lien\"";
				  $testehttp=strpos((string) $som_lien,"http://");
				  $testehttps=strpos((string) $som_lien,"https://");
				  $testeftp=strpos((string) $som_lien,"ftp://");
				
				  if($testehttp === 0 || $testeftp === 0 || $testehttps === 0) 
				  {
					$content .= " target=\"_tab\"";
				  }
				  
				  $content .= ">";
				}
			}

            # This is the Top image
			#
			#### sub image
			
			# TOP IMAGE AND TITLE OF EACH LINK CATEGORY
			if($sub_image != "noimg") 
			{
			    $fermebalise = ($som_lien != "") ? "</a>" : "";
				$content .= "&nbsp;&nbsp;&nbsp;<img width=\"21\" style=\"vertical-align: left !important;\" src=\"$path_icon/$sub_image\" alt=\"$sub_image\">".$fermebalise."&nbsp;";
			}

			if(str_starts_with($som_name, "LANG:_")) 
			{
				$som_name = str_replace("LANG:","",$som_name);
				eval( "\$som_name = $som_name;");
			}
			
			if($som_name == "" || $som_name == " " || $som_name== "&nbsp;" || $som_name=="&amp;nbsp;") 
			{ 
				$no_category_text[$som_groupmenu] = 1;
			}
			else 
			{
				if($som_lien != "") 
				{
					if(str_starts_with((string) $som_lien, "LANG:_")) 
					{
						$som_lien = str_replace("LANG:","",(string) $som_lien);
						eval( "\$som_lien = $som_lien;");
					}
					
					$testepopup=strpos((string) $som_lien,"javascript:window.open(");
					
					if($testepopup === 0) 
					{
						$som_lien = str_replace("window.open","menu_over_popup",(string) $som_lien);
						$content.="<a href=\"$som_lien\"";
					}
					else 
					{
						$content .= "<a href=\"$som_lien\"";
						$testehttp=strpos((string) $som_lien,"http://");
						$testeftp=strpos((string) $som_lien,"ftp://");
						$testehttps=strpos((string) $som_lien,"https://");
					
						if($testehttp === 0 || $testeftp === 0 || $testehttps === 0) 
						{
							$content .= " target=\"_tab\"";
						}
					}
				
				   $content.=" class=\"$categoryclass[$classpointer]\">";
				}
				
				$content.="<span class=\"$categoryclass[$classpointer]\">";
				
				$bold1 = ($som_bold == "on") ? "<strong>" : "";
				$bold2 = ($som_bold == "on") ? "</strong>" : "";
				
				# add NEW (new.gif)to top level
				$new = ($som_new == "on") ? "<img width=\"21\" style=\"vertical-align: left;\" src=\"$path_icon/admin/$imgnew\" title=\""._MENU_NEWCONTENT."\" alt=\""._MENU_NEWCONTENT."\"> " : "" ;
				
				$content .= "".$bold1."$som_name".$bold2." ".$new."";
			}
			
			$content .= "</span>";
			
			if($som_lien != "") 
			{
				$content .= "</a>";
			}
			
			//if($som_dynamic == 'on' && isset($moduleinthisgroup[$som_groupmenu]['0'])) 
			//{
			//	$zeimage = ($som_listbox == "on") ? "null.gif" : "down.gif" ;
			//	$content .= "<img align=\"bottom\" id=\"menuupdown-$som_groupmenu\" src=\"$path_icon/admin/$zeimage\" alt=\"Show/Hide content\">";
			//}
			
			//if($som_center == "on") 
			//{
			//	$content .= "</div>";
			//}
			
			if ($div == 1) {
       $content .= "</td><td style=\"vertical-align: top;\">";
   } elseif ($horizontal == 1) {
       $content .= "</td></tr>\n";
   } else 
			{
				$content .= "</td></tr>\n";
			}
			
		}
		
		$keyinthisgroup = 0;
		
		if($som_groupmenu != 99 && !isset($moduleinthisgroup[$som_groupmenu]['0'])) 
		{ 
			if($horizontal == 1) 
			{
				$content .= "</table></td><td width=\"4\" style=\"background-color:$som_bgcolor;\"></td>";
			}
			else 
			{
				$content .= "<tr style=\"background-color:$som_bgcolor;\"><td height=\"4\"></td></tr>";
			}
		}
		elseif($som_groupmenu != 99 && isset($moduleinthisgroup[$som_groupmenu]['0'])) 
		{
		
			if($div == 1) 
			{
				if(!$som_bgcolor) 
				{
					$divbgcolor = $bgcolor1 ?: "#ffffff";
				}
				else 
				{
					$divbgcolor = $som_bgcolor;
				}
				
				$content .= "<table id=\"menu-$som_groupmenu\" style=\"position: absolute; z-index: 2; background-color:".$divbgcolor."; border: 1px solid ".$bgcolor2.";\"><tr><td>";
			}
			else 
			{
				$content .= "<tr id=\"menu-$som_groupmenu\"><td style=\"background-color:$som_bgcolor;\" width=\"100\">";
			}
			
			$content .= "<table class=\"table100 menunowrap\">";
		
		if($sub_image != "noimg") 
		{ 
			$catimagesize = getimagesize("$path_icon/$sub_image");
		}
		else 
		{
			$catimagesize[0] = 1; 
		}

		while ($moduleinthisgroup[$som_groupmenu][$keyinthisgroup] ?? '')
		{ 
			if($grasinthisgroup[$som_groupmenu][$keyinthisgroup] == "on") 
			{ 
				$gras1 = "<strong>";
				$gras2 = "</strong>";
			}
			else 
			{
				$gras1 = $gras2 = "";
			}
			
	if ($moduleinthisgroup[$som_groupmenu][$keyinthisgroup] == "MENUTEXTONLY" 
			|| ($moduleinthisgroup[$som_groupmenu][$keyinthisgroup] == "External Link" 
			&& !preg_match("^modules.php\?name=^", (string) $linkinthisgroup[$som_groupmenu][$keyinthisgroup]) 
			&& !preg_match("^((http(s)?)|(ftp(s)?))://".$_SERVER['SERVER_NAME']."/modules.php\?name=^",(string) $linkinthisgroup[$som_groupmenu][$keyinthisgroup]))) {
       if(str_starts_with((string) $linkinthisgroup[$som_groupmenu][$keyinthisgroup], "LANG:_")) 
   				{
   					$zelink_lang = str_replace("LANG:","",(string) $linkinthisgroup[$som_groupmenu][$keyinthisgroup]);
   					eval( "\$zelink_lang = $zelink_lang;");
   					$linkinthisgroup[$som_groupmenu][$keyinthisgroup] = $zelink_lang;
   				}
       $testepopup = strpos((string) $linkinthisgroup[$som_groupmenu][$keyinthisgroup],"javascript:window.open(");
       if($testepopup === 0) 
   				{
   				  $linkinthisgroup[$som_groupmenu][$keyinthisgroup] = str_replace("window.open","menu_over_popup",(string) $linkinthisgroup[$som_groupmenu][$keyinthisgroup]);
   				  $zelink = "";
   				}
   				else 
   				{
   					$testehttp=strpos((string) $linkinthisgroup[$som_groupmenu][$keyinthisgroup],"http://");
   					$testeftp=strpos((string) $linkinthisgroup[$som_groupmenu][$keyinthisgroup],"ftp://");
   					$testehttps=strpos((string) $linkinthisgroup[$som_groupmenu][$keyinthisgroup],"https://");
   					
   					$zelink = $testehttp === 0 || $testeftp === 0 || $testehttps === 0 ? " target=\"_tab\"" : "";
   				}
       $linklang=$linktextinthisgroup[$som_groupmenu][$keyinthisgroup];
       if(str_starts_with((string) $linklang, "LANG:_")) 
    			{
    				$linklang = str_replace("LANG:","",(string) $linklang);
    				eval( "\$linklang = $linklang;");
    			
    				if($linklang == "") 
    				{
    					$keyinthisgroup++;
    					continue;
    				} 
    				
    				$linktextinthisgroup[$som_groupmenu][$keyinthisgroup]=$linklang;
    			}
       //sublevels
       if($keyinthisgroup==0) 
   				{
   					$sublevelinthisgroup[$som_groupmenu][$keyinthisgroup] = 0;
   					$current_sublevel = 0;
   				}
       if($sublevelinthisgroup[$som_groupmenu][$keyinthisgroup]>$current_sublevel) 
   				{
   					if($imageinthisgroup[$som_groupmenu][$keyinthisgroup-1] == 'tree-T.png') 
   					{
   						$zebar="background: url($path_icon/categories/bar.gif) right top repeat-y;";
   					}
   					else 
   					{
   						$zebar = "";
   					}
   					
   					$catimagesize[0] = 0;
   					
   					if($div == 1) 
   					{
   						$sublevelzindex = $sublevelinthisgroup[$som_groupmenu][$keyinthisgroup] +2;
   						$content .= "<td style=\"vertical-align: top;\"><table id=\"".$id_sublevel."\" class=\"table100 menunowrap\" 
						style=\"position: absolute; z-index: ".$sublevelzindex."; border: 1px solid ".$bgcolor2."; background-color: ".$bgcolor1.";\">";
   					}
   					else 
   					{
   					    $content .= "<tr id=\"".$id_sublevel."\"><td style=\"align: right;".$zebar."\"></td><td><table class=\"table100 menunowrap\">";
   					}
   					
   					$id_sublevel = "";
   					$id_sublevel_img = "";
   					$current_sublevel++;
   				}
       //sublevels - showhide
       //if($keyinthisgroup<count($moduleinthisgroup[$som_groupmenu])-1 && $sublevelinthisgroup[$som_groupmenu][$keyinthisgroup]<$sublevelinthisgroup[$som_groupmenu][$keyinthisgroup+1])
       //{
       //	$ligne=($som_dynamic == 'on') ? "<tr style=\"cursor: pointer;\"
       //	onclick=\"menu_showhide('menusublevel-$som_groupmenu-".($keyinthisgroup+1)."','ok','menuupdown-sublevel-$som_groupmenu-".($keyinthisgroup+1)."');\">" : "<tr>";
       //	$id_sublevel = "menusublevel-$som_groupmenu-".($keyinthisgroup+1);
       //	$id_sublevel_img = "menuupdown-sublevel-$som_groupmenu-".($keyinthisgroup+1);
       //	$ferme_sublevels .= ($som_dynamic == 'on') ? "menu_showhide('$id_sublevel','nok','$id_sublevel_img');" :  "" ;
       //	$sublevel_updownimg =($som_dynamic == 'on') ? "<img id=\"".$id_sublevel_img."\" src=\"$path_icon/admin/up.gif\" alt=\"Show/Hide content\" border=0>" : "";
       //}
       //else
       //{
       $ligne = "<tr>";
       $sublevel_updownimg = "";
       //}
       # add NEW (new.gif)to sub level
       $new = ($newinthisgroup[$som_groupmenu][$keyinthisgroup] == "on") ? " <img width=\"21\" style=\"vertical-align: left;\" src=\"$path_icon/admin/$imgnew\" 
			   title=\""._MENU_NEWCONTENT."\" alt=\""._MENU_NEWCONTENT."\">" : "" ;
       $imagedulien = "<img height=\"$menu_image_height\" width=\"21\" style=\"vertical-align: left;\" src=\"$path_icon/categories/".$imageinthisgroup[$som_groupmenu][$keyinthisgroup]."\" 
			   alt=\"".$imageinthisgroup[$som_groupmenu][$keyinthisgroup]."\">";
       if($linkinthisgroup[$som_groupmenu][$keyinthisgroup]) 
 			   { 
 				 $lelien = "<a href=\"".$linkinthisgroup[$som_groupmenu][$keyinthisgroup]."\"".$zelink." class=\"".$classinthisgroup[$som_groupmenu][$keyinthisgroup]."\">";
 				 $close_lelien = "</a>";
 			   }
 			  else 
 			  {
 				$lelien = "";
 				$close_lelien = "";
 			  }
       $letexte = "<span class=\"".$classinthisgroup[$som_groupmenu][$keyinthisgroup]."\">".$linktextinthisgroup[$som_groupmenu][$keyinthisgroup]."</span>";
       if ($imageinthisgroup[$som_groupmenu][$keyinthisgroup] != "middot.gif" && ($linktextinthisgroup[$som_groupmenu][$keyinthisgroup] == "" 
   				|| $linktextinthisgroup[$som_groupmenu][$keyinthisgroup] == " " 
   				|| $linktextinthisgroup[$som_groupmenu][$keyinthisgroup] == "&nbsp;" 
   				|| $linktextinthisgroup[$som_groupmenu][$keyinthisgroup] == "&amp;nbsp;")) {
           $content .= $ligne."<td colspan=2 width=\"100%\">".$lelien.$imagedulien.$close_lelien.$new."";
           $content .= $sublevel_updownimg."</td></tr>\n";
       } elseif ($imageinthisgroup[$som_groupmenu][$keyinthisgroup] != "middot.gif") {
           if(isset($no_category_text[$som_groupmenu]) && ($no_category_text[$som_groupmenu] ===1 ))
      					{	
      						$content .= $ligne."<td colspan=2 align=\"left\" width=\"100%\">".$imagedulien."&nbsp;".$lelien.$gras1.$letexte.$gras2.$close_lelien.$new.""; 
      					}
      					else 
      					{
      						$content .= $ligne."<td width=\"$catimagesize[0]\" align=\"right\">".$imagedulien."</td><td>&nbsp;".$lelien.$gras1.$letexte.$gras2.$close_lelien.$new.""; 
      					}
           $content .= $sublevel_updownimg."</td></tr>\n";
       } else 
   				{ 
   					if($no_category_text[$som_groupmenu] === 1) 
   					{	
   					  $content .= $ligne."<td colspan=2 align=\"left\" width=\"100%\"><span 
					  class=\"".$classinthisgroup[$som_groupmenu][$keyinthisgroup]."\"><strong><big>&middot;</big></strong></span>&nbsp;".$lelien.$gras1.$letexte.$gras2.$close_lelien.$new.""; 
   					}
   					else 
   					{
   						$content .= $ligne."<td width=\"$catimagesize[0]\" align=\"right\"><span 
						class=\"".$classinthisgroup[$som_groupmenu][$keyinthisgroup]."\"><strong><big>&middot;</big></strong></span></td><td>&nbsp;".$lelien.
   						$gras1.$letexte.$gras2.$close_lelien.$new.""; 
   					}
   					
   					$content .= $sublevel_updownimg."</td></tr>\n";
   				}
       # sublevels
       if($keyinthisgroup == (is_countable($moduleinthisgroup[$som_groupmenu]) ? count($moduleinthisgroup[$som_groupmenu]) : 0) -1) 
   				{
   					for($sub = 0; $sub < $current_sublevel; $sub++) 
   					{
   						$content .= "</table></td></tr>";
   					}
   				}
   				elseif($current_sublevel > $sublevelinthisgroup[$som_groupmenu][$keyinthisgroup+1]) 
   				{
   					for($sub=0; $sub < ($current_sublevel-$sublevelinthisgroup[$som_groupmenu][$keyinthisgroup+1]); $sub++) 
   					{
   						$content .= "</table></td></tr>";
   					}
   					
   					$current_sublevel = $sublevelinthisgroup[$som_groupmenu][$keyinthisgroup+1];
   				}
   } elseif($moduleinthisgroup[$som_groupmenu][$keyinthisgroup] == "Horizonatal Rule") 
			{
				$content .= "<tr><td colspan=\"2\">";
				$content .= "<hr>";
				$content .= "</td></tr>\n";
			} else 
			{
				if($moduleinthisgroup[$som_groupmenu][$keyinthisgroup] == "External Link") 
				{ 
					#1# Old Code
					#1# $temponomdumodule=split("&", $linkinthisgroup[$som_groupmenu][$keyinthisgroup]);
					
					// Split at '/', could use explode() but the PREG_SPLIT_NO_EMPTY flag is
                    // very handy since it handles "//" and "/" at start/end.
                   $temponomdumodule = preg_split('#/#', (string) $linkinthisgroup[$som_groupmenu][$keyinthisgroup], -1, PREG_SPLIT_NO_EMPTY);
					
					 $nomdumodule = $nomdumoduleinthisgroup[$som_groupmenu][$keyinthisgroup];
					 $targetblank = $targetblankinthisgroup[$som_groupmenu][$keyinthisgroup];
					$customtitle2 = $customtitle2inthisgroup[$som_groupmenu][$keyinthisgroup];
					 $urldumodule = $urldumoduleinthisgroup[$som_groupmenu][$keyinthisgroup];

					if(str_starts_with((string) $urldumodule, "LANG:_")) 
					{
						$zelink_lang = str_replace("LANG:","",(string) $urldumodule);
						eval( "\$zelink_lang = $zelink_lang;");
						$urldumodule = $zelink_lang;
					}
					
					$linklang = $customtitle2;
					
					if(str_starts_with((string) $linklang, "LANG:_")) 
					{
						$linklang = str_replace("LANG:","",(string) $linklang);
						eval( "\$linklang = $linklang;");
					
						if($linklang == "") 
						{
						  $keyinthisgroup++;
						  continue;
						} 
					
						$customtitle2 = $linklang;
					}
				}
				else 
				{
					$temponomdumodule = []; 
					     $nomdumodule = $nomdumoduleinthisgroup[$som_groupmenu][$keyinthisgroup];
					     $targetblank = $targetblankinthisgroup[$som_groupmenu][$keyinthisgroup];
					    $customtitle2 = $customtitle2inthisgroup[$som_groupmenu][$keyinthisgroup];
					     $urldumodule = $urldumoduleinthisgroup[$som_groupmenu][$keyinthisgroup];
				}
				
				if($imageinthisgroup[$som_groupmenu][$keyinthisgroup] != "middot.gif"): 
				$limage = "<img height=\"$menu_image_height\" width=\"21\" style=\"vertical-align: left;\" src=\"$path_icon/categories/".$imageinthisgroup[$som_groupmenu][$keyinthisgroup]."\" 
				alt=\"".$imageinthisgroup[$som_groupmenu][$keyinthisgroup]."\">";
				else: 
				$limage = "<strong><big>&middot;</big></strong>";
                endif;
				
				if($poster_moduleinthisgroup[$som_groupmenu][$keyinthisgroup] == 2) 
				$limage="<img width=\"21\" style=\"vertical-align: left;\" src=\"$path_icon/admin/interdit.gif\" title=\"".$whyrestricted[$som_groupmenu][$keyinthisgroup]."\" 
				alt=\"".$whyrestricted[$som_groupmenu][$keyinthisgroup]."\">";

				if((isset($newpms[0])) && ($nomdumodule == "Private_Messages")) 
				$disp_pmicon="<img src=\"images/blocks/email-y.gif\" height=\"10\" width=\"14\" alt=\""._MENU_NEWPM."\" title=\""._MENU_NEWPM."\">";
				else 
				$disp_pmicon= "";
				
				# add NEW (new.gif)to ?
				$new = ($newinthisgroup[$som_groupmenu][$keyinthisgroup] == "on") ? "<img width=\"21\" style=\"vertical-align: left;\" src=\"$path_icon/admin/$imgnew\" 
				title=\""._MENU_NEWCONTENT."\" alt=\""._MENU_NEWCONTENT."\">" : "" ;

				if ($nomdumodule == "Downloads" && $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup] != "-1") {
        $where = (preg_match("/^cid=\\d*\$/",$temponomdumodule[2])) ? " WHERE $temponomdumodule[2]" : "";
        $sqlimgnew = "SELECT date FROM ".$prefix."_nsngd_downloads".$where." order by date desc limit 1";
        $resultimgnew = $db->sql_query($sqlimgnew);
        $rowimgnew = $db->sql_fetchrow($resultimgnew);
        if($rowimgnew['date']) 
   					{
   						preg_match("/(\\d{4})-(\\d{1,2})-(\\d{1,2}) (\\d{1,2}):(\\d{1,2}):(\\d{1,2})/", (string) $rowimgnew['date'], $datetime);
   						$zedate = mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]);
   						$now=time();
   						
   						if((int) (($now-$zedate)/86400) <= $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup]) 
   						{
   							$new = "<img width=\"21\" style=\"vertical-align: left;\" src=\"$path_icon/admin/$imgnew\" title=\""._MENU_NEWCONTENT."\" alt=\""._MENU_NEWCONTENT."\">";
   						}
   					}
    } elseif (($nomdumodule == "Web_Links" && $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup] != "-1") && isset($temponomdumodule[2])) {
        $where = (preg_match("/^cid=\\d*\$/",$temponomdumodule[2])) ? " WHERE $temponomdumodule[2]" : "";
        $sqlimgnew = "SELECT date FROM ".$prefix."_links_links".$where." ORDER BY date DESC LIMIT 1";
        $resultimgnew = $db->sql_query($sqlimgnew);
        $rowimgnew = $db->sql_fetchrow($resultimgnew);
        if ($rowimgnew['date']) 
					{
                       preg_match("/(\\d{4})-(\\d{1,2})-(\\d{1,2}) (\\d{1,2}):(\\d{1,2}):(\\d{1,2})/", (string) $rowimgnew['date'], $datetime);
                       $zedate = mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]);
                       $now=time();
                    
					   if((int) (($now-$zedate)/86400) <= $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup]) 
					   {
                            $new = "<img width=\"21\" style=\"vertical-align: left;\" src=\"$path_icon/admin/$imgnew\" title=\""._MENU_NEWCONTENT."\" alt=\""._MENU_NEWCONTENT."\">";
                       }
                     }
    } elseif ($nomdumodule == "Content" && $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup] != "-1") {
        $where = (preg_match("/^cid=\\d*\$/",$temponomdumodule[2])) ? " WHERE $temponomdumodule[2]" : "";
        $sqlimgnew="SELECT date FROM ".$prefix."_pages".$where." order by date desc limit 1";
        $resultimgnew=$db->sql_query($sqlimgnew);
        $rowimgnew = $db->sql_fetchrow($resultimgnew);
        if($rowimgnew['date']) 
   					{
   						preg_match ("/(\\d{4})-(\\d{1,2})-(\\d{1,2}) (\\d{1,2}):(\\d{1,2}):(\\d{1,2})/", (string) $rowimgnew['date'], $datetime);
   						$zedate = mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]);
   						$now=time();
   						
   						if((int) (($now-$zedate)/86400) <= $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup]) 
   						{
   							$new="<img width=\"21\" style=\"vertical-align: left;\" src=\"$path_icon/admin/$imgnew\" title=\""._MENU_NEWCONTENT."\" alt=\""._MENU_NEWCONTENT."\">";
   						}
   					}
    } elseif ($nomdumodule == "Reviews" && $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup] != "-1") {
        $where = "";
        $sqlimgnew="SELECT date FROM ".$prefix."_reviews".$where." order by date desc limit 1";
        $resultimgnew=$db->sql_query($sqlimgnew);
        $rowimgnew = $db->sql_fetchrow($resultimgnew);
        
		
		if(isset($rowimgnew['date']))
   					{
   						preg_match ("/(\\d{4})-(\\d{1,2})-(\\d{1,2}) (\\d{1,2}):(\\d{1,2}):(\\d{1,2})/", (string) $rowimgnew['date'], $datetime);
   						$zedate = mktime(0,0,0,$datetime[2],$datetime[3],$datetime[1]);
   						$now=time();
   						
   						if((int) (($now-$zedate)/86400) <= $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup]) 
   						{
   							$new="<img width=\"21\" style=\"vertical-align: left;\" src=\"$path_icon/admin/$imgnew\" title=\""._MENU_NEWCONTENT."\" alt=\""._MENU_NEWCONTENT."\">";
   						}
   					}
    } elseif ($nomdumodule == "Blog" && $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup] != "-1") {
        global $db, $prefix;
        $where = (preg_match("/^cid=\\d*\$/",$temponomdumodule[2])) ? " WHERE ".str_replace("new_","",$temponomdumodule[1])."" : "";
        $sqlimgnew="SELECT datePublished FROM ".$prefix."_blogs".$where." order by datePublished desc limit 1";
        $resultimgnew=$db->sql_query($sqlimgnew);
        $rowimgnew = $db->sql_fetchrow($resultimgnew);
        if($rowimgnew['datePublished']) 
   					{
   						preg_match ("/(\\d{4})-(\\d{1,2})-(\\d{1,2}) (\\d{1,2}):(\\d{1,2}):(\\d{1,2})/", (string) $rowimgnew['datePublished'], $datetime);
   						$zedate = mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]);
   						$now=time();
   						
   						if((int) (($now-$zedate)/86400) <= $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup]) 
   						{
   							$new="<img width=\"21\" style=\"vertical-align: left;\" src=\"$path_icon/admin/$imgnew\" title=\""._MENU_NEWCONTENT."\" alt=\""._MENU_NEWCONTENT."\">";
   						}
   					}
    }

				# sublevels
				if($keyinthisgroup == 0) 
				{
					$sublevelinthisgroup[$som_groupmenu][$keyinthisgroup] = 0;
					$current_sublevel = 0;
				}
				
				if($sublevelinthisgroup[$som_groupmenu][$keyinthisgroup] > $current_sublevel) 
				{
					if($imageinthisgroup[$som_groupmenu][$keyinthisgroup-1] == 'tree-T.png') 
					{
						$zebar="background: url($path_icon/categories/bar.gif) right top repeat-y;";
					}
					else 
					{
						$zebar = "";
					}
					
					$catimagesize[0] = 0;
					
					if($div == 1) 
					{
						$sublevelzindex=$sublevelinthisgroup[$som_groupmenu][$keyinthisgroup]+2;
						$content.="<td style=\"vertical-align: top;\"><table id=\"".$id_sublevel."\" class=\"table100 menunowrap\" 
						style=\"position: absolute; z-index: ".$sublevelzindex."; border: 1px solid ".$bgcolor2."; background-color: ".$bgcolor1.";\">";
					}
					else 
					{
					    $content.="<tr id=\"".$id_sublevel."\"><td style=\"align: right;".$zebar."\"></td><td><table class=\"table100 menunowrap\">";
					}
					
					$id_sublevel="";
					$id_sublevel_img="";
					$current_sublevel++;
				}
				
				# sublevels - showhide
				if($keyinthisgroup<(is_countable($moduleinthisgroup[$som_groupmenu]) ? count($moduleinthisgroup[$som_groupmenu]) : 0)-1 && $sublevelinthisgroup[$som_groupmenu][$keyinthisgroup]<$sublevelinthisgroup[$som_groupmenu][$keyinthisgroup+1]) 
				{
					$ligne=($som_dynamic=='on') ? "<tr style=\"cursor: pointer;\" 
					onclick=\"menu_showhide('menusublevel-$som_groupmenu-".($keyinthisgroup+1)."','ok','menuupdown-sublevel-$som_groupmenu-".($keyinthisgroup+1)."');\">" : "<tr>"; 
					
					$id_sublevel="menusublevel-$som_groupmenu-".($keyinthisgroup+1);
					$id_sublevel_img="menuupdown-sublevel-$som_groupmenu-".($keyinthisgroup+1);
					$ferme_sublevels.= ($som_dynamic=='on') ? "menu_showhide('$id_sublevel','nok','$id_sublevel_img');" : "" ;
					$sublevel_updownimg=($som_dynamic=='on') ? "<img id=\"".$id_sublevel_img."\" src=\"$path_icon/admin/up.gif\" alt=\"Show/Hide content\" border=0>" : "";
				}
				else 
				{
					$ligne="<tr>";
					$sublevel_updownimg="";
				}

				if($limage != "middot.gif" && ($customtitle2 == "" || $customtitle2 == " " 
				                                                   || $customtitle2 == "&nbsp;" 
																   || $customtitle2 == "&amp;nbsp;")) 
		        { 
					
					if($no_category_text[$som_groupmenu]===1) 
					{	
						$content.=$ligne."<td colspan=2 align=\"left\" width=\"100%\">&nbsp;<a $aligncat href=\"".$urldumodule."\" ".$targetblank.">".$limage."</a> ".$new."";
					}
					else  
					{
						$content.=$ligne."<td width=\"$catimagesize[0]\" align=\"right\"></td><td>&nbsp;<a $aligncat href=\"".$urldumodule."\" ".$targetblank.">".$limage."</a> ".$new."";
					}
					
					$content.=$sublevel_updownimg."</td>";
					
					if(($div==1) && ($keyinthisgroup<(is_countable($moduleinthisgroup[$som_groupmenu]) ? count($moduleinthisgroup[$som_groupmenu]) : 0)-1 
					&& $sublevelinthisgroup[$som_groupmenu][$keyinthisgroup]<$sublevelinthisgroup[$som_groupmenu][$keyinthisgroup+1])) 
					{
						
					}
					else 
					{
						$content.="</tr>\n";
					}
				}
				else 
				{
					$width=" width=\"$catimagesize[0]\"";
				    if(isset($no_category_text[$som_groupmenu]) && ($no_category_text[$som_groupmenu]===1))
					//if($no_category_text[$som_groupmenu]===1) 
					{	
						$content.=$ligne."<td colspan=2 align=\"left\" width=\"100%\">".$limage."".$disp_pmicon."";
					}
					else 
					{
						$content.=$ligne."<td".$width." align=\"right\">".$limage.""."</td><td>".$disp_pmicon."";
					}
					
					$content.="&nbsp;<a $aligncat href=\"".$urldumodule."\" class=\"".$classinthisgroup[$som_groupmenu][$keyinthisgroup]."\" ".$targetblank."><span 
					class=\"".$classinthisgroup[$som_groupmenu][$keyinthisgroup]."\">".$gras1."$customtitle2".$gras2."</span></a> ".$new."";
					
					$content.=$sublevel_updownimg."</td>";
					
					if(($div==1) && ($keyinthisgroup<(is_countable($moduleinthisgroup[$som_groupmenu]) ? count($moduleinthisgroup[$som_groupmenu]) : 0)-1 
					&& $sublevelinthisgroup[$som_groupmenu][$keyinthisgroup]<$sublevelinthisgroup[$som_groupmenu][$keyinthisgroup+1])) 
					{
						
					}
					else 
					{
					  $content.="</tr>\n";
					}
				}

				# sublevels - ferme
				if ($keyinthisgroup == (is_countable($moduleinthisgroup[$som_groupmenu]) ? count($moduleinthisgroup[$som_groupmenu]) : 0)-1) {
        for($sub=0;$sub<$current_sublevel;$sub++) 
   					{
   						$content.="</table></td></tr>";
   					}
    } elseif ($current_sublevel>$sublevelinthisgroup[$som_groupmenu][$keyinthisgroup+1]) {
        for($sub=0;$sub<($current_sublevel-$sublevelinthisgroup[$som_groupmenu][$keyinthisgroup+1]);$sub++) 
   					{
   						$content.="</table></td></tr>";
   					}
        $current_sublevel=$sublevelinthisgroup[$som_groupmenu][$keyinthisgroup+1];
    }
	   		}
			
			$keyinthisgroup++;
		}
		
		//if($som_listbox=="on") 
		//{
		//	$content.="</select></form></td></tr>";
		//}
		
		$content.="</table>";
		
		if($div==1) 
		{
			$content.="</td></tr></table>";
			$content.="</td></tr>";
			
		}
		else 
		{
			$content.="</td></tr>";
		}
			
		if($horizontal==1) 
		{
			$content.="</table></td><td width=\"4\" style=\"background-color:$som_bgcolor;\"></td>";
		}
		else 
		{
			$content.="<tr style=\"background-color:$som_bgcolor;\"><td height=\"4\"></td></tr>";
		}
		}
	
		if($som_groupmenu == 99 && $is_admin==1 && $horizontal != 1) 
		{ 
			if($som_name != "menunoadmindisplay") 
			{
				$showadmin=1;
				$content.="<tr><td>";
				
				foreach ($module as $z => $singleModule) {
        $customtitle2 = str_replace ("_"," ", (string) $singleModule);
        if($customtitle[$z] != "") 
   					{
   						$customtitle2 = $customtitle[$z];
   					}
        if ($singleModule != $main_module && ($is_admin===1 && $view[$z] == 2 || $view[$z] != 2)) {
            $incategories=0;
            foreach ($totalcategorymodules as $i => $totalcategorymodule) {
                if($singleModule==$totalcategorymodule) 
        								{
        									$incategories=1;
        								}
            }
            if($incategories==0) 
     							{
     								$flagmenu += 1;
     							
     								if($flagmenu == 1) 
     								{
     									$content .="<hr><div align=\"center\">"._MENU_ADMINVIEWALLMODULES."</div><br />";   
     								}
     								
     								$urldumodule99 = ($gt_url[$z] != "") ? $gt_url[$z] : "modules.php?name=".$singleModule ; 
     								
     								if(isset($newpms[0]) && $singleModule=="Private_Messages")  
     								{ 
     									$content .= "<strong><big>&middot;</big></strong><img src=\"images/blocks/email-y.gif\"  
									height=\"10\" width=\"14\" alt=\""._MENU_NEWPM."\" title=\""._MENU_NEWPM."\"><a href=\"".$urldumodule99."\">$customtitle2</a><br>\n";
     								}
     								else 
     								{
     				                    $content .= "<strong><big><i class=\"bi bi-eye-slash\"></i></big></strong>&nbsp;<a href=\"".$urldumodule99."\">$customtitle2</a><br>\n";
     								}
     								
     								$content .= '';
     							}
        }
    }
				
				$content.="</td></tr>";
			}
			else 
			{
				$showadmin=0;
			}
		}
	}
	
	$content.="</table>";
	

function menu_is_user($user, $managment_group): int 
{
    global $prefix, $db, $uid, $userpoints;

    if(!is_array($user)) 
	{
		$user = addslashes((string) $user); 
        $user = base64_decode($user);
		$user = addslashes($user); 
        $user = explode(":", $user);
        $uid = "$user[0]";
        $pwd = "$user[2]";
    } 
	else 
	{
        $uid = "$user[0]";
        $pwd = "$user[2]";
    }
	
	$uid = addslashes($uid); 
	$uid=(int) $uid; 
    
	if($uid != 0 && $pwd != "") 
	{
		if ($managment_group==0) {
      $sql = "SELECT user_password FROM ".$prefix."_users WHERE user_id='$uid'";
  } elseif ($managment_group==1) {
      $sql = "SELECT user_password, points FROM ".$prefix."_users WHERE user_id='$uid'";
  } else 
		{
		  die("There Seems To Be A problem!!");
		}
        
		$result = $db->sql_query($sql);
        
		$row = $db->sql_fetchrow($result);
        
		$pass = $row['user_password'];
        
		if($pass == $pwd && $pass != "") 
		{
			$userpoints = ($managment_group==1) ? $row['points'] : "";
            return 1;
        }
    }
    return 0;
}


function menu_get_theme($is_user) 
{
    global $user, $cookie, $Default_Theme;

    if($is_user==1) 
	{
        $user2 = base64_decode((string) $user);
    
	    $t_cookie = explode(":", $user2);
    
	    if($t_cookie[9]=="") $t_cookie[9]=$Default_Theme;
    
	    if(isset($theme)) $t_cookie[9]=$theme;
    
	    $ThemeSel = ($tfile=@opendir("themes/$t_cookie[9]")) ? $t_cookie[9] : $Default_Theme;
    } 
	else 
	{
        $ThemeSel = $Default_Theme;
    }
    
	return($ThemeSel);
}
?>
