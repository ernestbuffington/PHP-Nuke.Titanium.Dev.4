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
 if(!defined('NUKE_EVO')) exit;

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


if(file_exists(NUKE_LANGUAGE_DIR.'Menu/lang-'.$currentlang.'.php')) 
include_once(NUKE_LANGUAGE_DIR.'Menu/lang-'.$currentlang.'.php');
else 
include_once(NUKE_LANGUAGE_DIR.'Menu/lang-english.php');

$userpoints=intval($userpoints); 

$gestiongroupe = 1; 
$managment_group = 1; 

$detectPM = 1; # Put 0 to deactivate the detection of the Private Messages.  (gains 1 SQL query)
$detectMozilla = (preg_match("/Mozilla/i",$_SERVER['HTTP_USER_AGENT']) && !preg_match("/MSIE/i",$_SERVER['HTTP_USER_AGENT']) && !preg_match("/Opera/i",$_SERVER['HTTP_USER_AGENT']) && !preg_match("/Konqueror/i",$_SERVER['HTTP_USER_AGENT'])) ? 1 : 0 ;
$detectMozilla = 0;

$horizontal=0;
$div=0;

/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
if(!($row = $cache->load('menu_row', 'block'))) 
{
  $sql="SELECT t1.invisible, t2.main_module FROM ".$prefix."_menu AS t1, ".$prefix."_main AS t2 LIMIT 1";
  $result = $db->sql_query($sql);
  $row = $db->sql_fetchrow($result);
  $cache->save('menu_row', 'block', $row);
}
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/

$is_admin = (is_admin($admin)) ? 1 : 0 ;

# one will test if the visitor is an admin and or a member.
$is_user = (is_user()) ? 1 : 0 ;

# get the current theme.
$ThemeSel = get_theme(); 

$uid = $cookie[0];

global $use_theme_image_dir_for_portal_menu;

if ($use_theme_image_dir_for_portal_menu == true)
$pathicon = "themes/$ThemeSel/images/menu";
else
$path_icon = "images/menu";

$imgnew="new.gif";

if(($is_user == 1) && ($detectPM == 1))
{
  $uid=intval($uid); 
  $newpms = $db->sql_fetchrow($db->sql_query("SELECT COUNT(*) FROM " . $prefix . "_bbprivmsgs 
  WHERE privmsgs_to_userid='$uid' AND (privmsgs_type='5' OR privmsgs_type='1')")); 
}

# START Caching System
   if ($managment_group==1)
     $sql = "SELECT * FROM ".$prefix."_modules WHERE active='1' AND inmenu='1' AND `title` NOT LIKE '~l~%' ORDER BY custom_title ASC";
   else
     $sql = "SELECT * FROM ".$prefix."_modules WHERE active='1' AND inmenu='1' AND `title` NOT LIKE '~l~%' ORDER BY custom_title ASC";   
   
   $modulesaffiche = $db->sql_query($sql);

   while($tempo = $db->sql_fetchrow($modulesaffiche)) 
   {
        $tempoA[] = $tempo;
    }

# END Caching System
	
$compteur = 0;
    
if (is_array($tempoA)) 
{
   foreach($tempoA as $tempo) 
   {
      $module[$compteur] = $tempo['title'];
      $customtitle[$compteur] = $tempo['custom_title'];
      $view[$compteur] = $tempo['view'];
      $active[$row['title']] = $tempo['active'];
      $mod_group[$compteur] = ($managment_group==1) ? $tempo['groups'] : "";
      $compteur++;
        
      if ($tempo['view'] == 3) 
	  $gestionsubscription = "yes";
   }
}

# What the fuck does this do and why ? This file will never be found because it will never exist!
if (file_exists("themes/$ThemeSel/module.php")) 
{
    include("themes/$ThemeSel/module.php");

    $is_active = ($active[$default_module]!=0) ? 1 : 0 ; 
    
	if ($is_active==1 AND file_exists("modules/$default_module/index.php")) 
	{
        $main_module = $default_module;
    }
}

$total_actions = "";

$flagmenu = 0;  

# START Caching System
if (!($row2A = $cache->load('menu_row2', 'block'))) 
{
    $sql2= "SELECT groupmenu, 
	                  module, 
					     url, 
					url_text, 
					   image, 
					     new, 
					new_days, 
					   class, bold FROM ".$prefix."_menu_categories ORDER BY id ASC";

    $result2 = $db->sql_query($sql2);

    while($row2 = $db->sql_fetchrow($result2)) 
	{
        $row2A[] = $row2;
    } 

   $cache->save('menu_row2', 'block', $row2A);
}
# END Caching System
 
                                   $compteur = 0;
                              $totalcompteur = 0;
                                  $categorie = $row2A[0]['groupmenu'];
   $moduleinthisgroup[$categorie][$compteur] = $row2A[0]['module'];
     $linkinthisgroup[$categorie][$compteur] = $row2A[0]['url'];
 $linktextinthisgroup[$categorie][$compteur] = $row2A[0]['url_text'];
    $imageinthisgroup[$categorie][$compteur] = $row2A[0]['image'];
      $newinthisgroup[$categorie][$compteur] = $row2A[0]['new'];
  $newdaysinthisgroup[$categorie][$compteur] = $row2A[0]['new_days'];
    $classinthisgroup[$categorie][$compteur] = $row2A[0]['class'];
     $grasinthisgroup[$categorie][$compteur] = $row2A[0]['bold'];
       $totalcategorymodules[$totalcompteur] = $row2A[0]['module']; 
                                  $compteur2 = $categorie;
                              $total_actions = "menu_showhide('menu-".$row2A[0]['groupmenu']."','nok','menuupdown-".$row2A[0]['groupmenu']."');";
                              $totalcompteur = 1;

unset($row2A[0]);

    if (is_array($row2A)) 
	{
      foreach($row2A as $row2) 
	  { 
        $categorie = $row2['groupmenu'];
        $totalcategorymodules[$totalcompteur] = $row2['module'];
        $totalcompteur++;

        if ($compteur2 == $categorie) 
        $compteur++;
        else 
		{
            $total_actions = $total_actions."menu_showhide('menu-".$row2['groupmenu']."','nok','menuupdown-".$row2['groupmenu']."');";
            $compteur = 0;
        }
        
		  $moduleinthisgroup[$categorie][$compteur] = $row2['module'];
            $linkinthisgroup[$categorie][$compteur] = $row2['url'];
        $linktextinthisgroup[$categorie][$compteur] = $row2['url_text'];
           $imageinthisgroup[$categorie][$compteur] = $row2['image'];
             $newinthisgroup[$categorie][$compteur] = $row2['new'];
         $newdaysinthisgroup[$categorie][$compteur] = $row2['new_days'];
           $classinthisgroup[$categorie][$compteur] = $row2['class'];
            $grasinthisgroup[$categorie][$compteur] = $row2['bold'];
                                         $compteur2 = $categorie;
      }
    }

$content ="\n\n\n\n\n<!-- Titanium Menu v5.01 -->\n\n\n\n\n";
 
$sql="SELECT t1.invisible, 
               t1.dynamic, 
		   t2.main_module FROM ".$prefix."_menu AS t1, ".$prefix."_main AS t2 WHERE t1.groupmenu=99 limit 1";

         $result = $db->sql_query($sql);
            $row = $db->sql_fetchrow($result);
    $main_module = $row['main_module'];
$general_dynamic = ($row['dynamic'] == 'on') ? 1 : 0 ;
 $type_invisible = $row['invisible'];

if($managment_group == 1) 
$managment_group = ($row['invisible'] == "4" || $row['invisible'] == "5") ? 1 : 0 ;
else 
$managment_group = 0;

# this is the start of the Portal menu
$sql = "SELECT * FROM ".$prefix."_modules WHERE active='1' AND inmenu='1' ORDER BY custom_title ASC";
	
$modulesaffiche = $db->sql_query($sql);
  $menu_counter = 0;
	
	while ($tempo = $db->sql_fetchrow($modulesaffiche)) 
	{
		   $module[$menu_counter] = $tempo['title'];
	  $customtitle[$menu_counter] = (stripslashes($tempo['custom_title'])); //strip the fucking slashes
		     $view[$menu_counter] = $tempo['view'];
		   $active[$row['title']] = $tempo['active'];
		$mod_group[$menu_counter] = ($managment_group==1 && isset($tempo['mod_group'])) ? $tempo['mod_group'] : "";
		$nsngroups[$menu_counter] = (isset($tempo['groups'])) ? $tempo['groups'] : "" ; 
		   $gt_url[$menu_counter] = (isset($tempo['url'])) ? $tempo['url'] : "" ; 
	
		$menu_counter++;
	
		if($tempo['view'] == 3) 
	    $gestionsubscription = "yes";
	}

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
				  date_debut, 
				    date_fin, 
					    days 
						
						FROM ".$prefix."_menu_categories ORDER BY id ASC";
						
	$result2 = $db->sql_query($sql2);
	
	 $menu_counter = 0;
	$totalcompteur = 0;
	      $premier = 0;
	       $hidden = 0;
  $hidden_sublevel = 0;
	
	$now=time(); 
	
	while ($row2 = $db->sql_fetchrow($result2)) 
	{
	   if(strpos($row2['days'],'8')!== false || $now<$row2['date_debut'] || ($row2['date_fin'] > 0 && $now>$row2['date_fin'])) 
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
		
		
		if (($row2['module'] == "MENUTEXTONLY") or ($row2['module'] == "External Link"))

		//&& (!stristr("^modules.php\?name=", $row2['url'])) 
		//&& (!stristr("^((http(s)?)|(ftp(s)?))://".$_SERVER['SERVER_NAME']."/modules.php\?name=",$row2['url']))) 

		//&& (preg_match("^modules.php\?name=^",$row2['url'])) 
		//&& (preg_match("^((http(s)?)|(ftp(s)?))://".$_SERVER['SERVER_NAME']."/modules.php\?name=^",$row2['url']))) 
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
					//$temponomdumodule=explode("&", $row2['url']);
					$temponomdumodule= preg_split('#/#', $row2['url'], -1, PREG_SPLIT_NO_EMPTY); //ern
					
					if(preg_match("^((http(s)?)|(ftp(s)?))://".$_SERVER['SERVER_NAME']."/modules.php\?name=^",$row2['url'])) 
					{ 
						$nomdumodule = substr(strstr($temponomdumodule[0],'modules.php'),17);
						$targetblank = "target=\"_tab\"";
					}
					else
					if(preg_match("^((http(s)?)|(ftp(s)?))://".$_SERVER['SERVER_NAME']."/modules.php\?name=^",$row2['url'])) 
					{ 
						$nomdumodule = substr(strstr($temponomdumodule[0],'modules.php'),17);
						$targetblank = "";
					}
					else 
					{
						$nomdumodule = str_replace("modules.php\?name=","",$temponomdumodule[0]);
						$targetblank = "";
					}
					
					$customtitle2 = (stripslashes($row2['url_text']));
					$urldumodule = $row2['url'];
				}
				else 
				{   # module normal
					$temponomdumodule = array();
					     $targetblank = "";
					     $nomdumodule = $row2['module'];
					$fix_customtitle2 = ($customtitle[$key] != "") ? $customtitle[$key] : str_replace("_", " ", $this_module);
					    $customtitle2 = (stripslashes($fix_customtitle2));
					     $urldumodule = ($gt_url[$key] != "") ? $gt_url[$key] : "modules.php?name=".$nomdumodule ; 
				}
				
					if(($is_admin === 1 AND $view[$key] == 2) OR $view[$key] != 2) 
					{ 
						if($nomdumodule == $this_module) 
						{ 
							$isin = 0;
							
							if($is_user == 1 && $view[$key] == 1 && $type_invisible == 4 && $isin == 0) 
							{
								    $poster_module = 2;
								$restricted_reason = ""._MENU_RESTRICTEDGROUP."";
								break;
							}
							else
							if($is_user == 0 && $view[$key] == 1 && ($type_invisible == 2 || $type_invisible == 4)) 
							{
								    $poster_module = 2;
								$restricted_reason = ""._MENU_RESTRICTEDMEMBERS."";
								break;
							}

							if($is_user == 1 && $view[$key] == 1 && $type_invisible == 5 && $isin == 0 && $is_admin == 0) 
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
							else
							if($is_user == 0 && $view[$key] == 1 && ($type_invisible == 5 || $type_invisible == 3) && $is_admin == 0) 
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
							else
							if($view[$key] > 3 && ($type_invisible == 3 || $type_invisible == 5) && !in_groups($nsngroups[$key])) 
							{
								if($menu_counter2!=$row2['groupmenu']) 
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
		}
		
		if($poster_module > 0) 
		{
			                           $categorie = $row2['groupmenu'];
			$totalcategorymodules[$totalcompteur] = $row2['module'];
			
			$totalcompteur++;
			
			if($premier == 0) 
			{
				$premier++;
				$total_actions = "menu_showhide('menu-".$row2['groupmenu']."','nok','menuupdown-".$row2['groupmenu']."');";
			}
			else
			if($menu_counter2 == $categorie) 
			{ 
			  $menu_counter++;
			}
			else 
			{
				$total_actions = $total_actions."menu_showhide('menu-".$row2['groupmenu']."','nok','menuupdown-".$row2['groupmenu']."');";
				$menu_counter = 0;
				$hidden_sublevel = 0;
				$hidden = 0;
			}
							
			if($menu_counter == 0 && $row2['sublevel'] > 0) 
			{ 
				$hidden = 1;
				$hidden_sublevel = 0;
				$row2['sublevel'] = 0;
			}
			else
			if($row2['sublevel'] > $hidden_sublevel && $hidden==1) 
			{
				$row2['sublevel'] = $row2['sublevel']-$hidden_sublevel;
			
				if($hidden_sublevel == 0) 
				{
					$row2['sublevel']--;
				}
			}
			else 
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
			   $date_debutinthisgroup[$categorie][$menu_counter] = $row2['date_debut'];
			     $date_fininthisgroup[$categorie][$menu_counter] = $row2['date_fin'];
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
	}

$content = "";
echo "\n\n\n\n<!--  START Titanium Portal Menu Javascript Functions v5.01 -->\n";
?>
<script type="text/javascript" language="JavaScript">
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

<style type="text/css">
.menunowrap 
{
  white-space: nowrap;
}
</style>

<?php
echo "<!--  END Titanium Portal Menu Javascript Functions v5.01 -->\n\n\n\n";
# MAIN MENU 
	$dynamictest=0;
	
	global $prefix, $db;

    $sql = "SELECT groupmenu, 
	                    name, 
					   image, 
					    lien, 
						  hr, 
					  center, 
					 bgcolor, 
				   invisible, 
				       class, 
					    bold, 
						 new, 
					 listbox, 
					 dynamic, 
				  date_debut, 
				    date_fin, 
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
	
	   $align = 'absmiddle'; # added by Ernest Buffingtn to align the new.gif image
	$aligncat = 'style="text-align:left"'; # added by Ernest Buffingtn to align the link text left
	
    list($portaladminname, 
	              $avatar, 
				   $email) = $db->sql_ufetchrow("SELECT `username`,`user_avatar`, `user_email` FROM `".$prefix."_users` WHERE `user_id`='$portaladmin'", SQL_NUM);

    $content .= "\n\n\n";
	
	if (strcmp($_SERVER['SERVER_NAME'], 'cvs.86it.us') == 0)
	{
      $content .= "<div class=\"supersmall\" align=\"center\"><font size=\"1\" color=\"$textcolor1\"><strong>86it CVS</strong></font></div>\n";
      $content .= "<div class=\"supersmall\" align=\"center\"><font size=\"1\" color=\"$textcolor2\"><strong>https://".$_SERVER['SERVER_NAME']."</strong></font></div>\n";
	}
    else
	if (strcmp($_SERVER['SERVER_NAME'], 'www.86it.us') == 0)
	{
      $content .= "<div class=\"supersmall\" align=\"center\"><font size=\"1\" color=\"$textcolor1\"><strong>Welcome Home</strong></font></div>\n";
      $content .= "<div class=\"supersmall\" align=\"center\"><font size=\"1\" color=\"$textcolor2\"><strong>The 86it HQ</strong></font></div>\n";
	}
    else
	{
      $content.= "<div class=\"supersmall\" align=\"center\"><font size=\"1\" color=\"$textcolor1\"><strong>$portaladminname</strong></font></div>\n";
      $content.= "<div class=\"supersmall\" align=\"center\"><font size=\"1\" color=\"$textcolor2\"><strong>Owns This 86it Portal</strong></font></div>\n";
	}

    $content .= "<br />";
	$content .= "<img align=\"$align\" src=\"images/menu/home.gif\" border=0 title=\""._MENU_NEWCONTENT."\" alt=\""._MENU_NEWCONTENT."\">";

	if (strcmp($_SERVER['SERVER_NAME'], 'www.86it.us') == 0)	
	$content .= "<a href=\"index.php\"><strong> Home</strong></a>";
    else
	if (strcmp($_SERVER['SERVER_NAME'], 'cvs.86it.us') == 0)
	$content .= "<a href=\"index.php\"><strong> Home</strong></a>";
	else
	$content .= "<a href=\"index.php\"><strong> Home</strong></a>";	
	
	$content .= "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
	$content .= "<tr><td width=\"100%\"></td><td id=\"menu_block\"></td></tr>\n";
	
	if($horizontal == 1) 
	{
		$content.="<tr>\n";
	}
	
	$classpointeur = 0;
    
	while ($row = $db->sql_fetchrow($result)) 
	{  
		                $som_groupmenu = $row['groupmenu'];
		                     $som_name = str_replace("&amp;nbsp;","&nbsp;",$row['name']); 
		                    $som_image = $row['image'];
		                     $som_lien = $row['lien'];
		                       $som_hr = $row['hr'];
		                   $som_center = $row['center'];
		                  $som_bgcolor = $row['bgcolor'];
		    $invisible[$classpointeur] = $row['invisible'];
		$categoryclass[$classpointeur] = $row['class'];
		                     $som_bold = $row['bold'];
		                      $som_new = $row['new'];
		                  $som_listbox = $row['listbox'];
		                  $som_dynamic = ($general_dynamic == 0) ? '' : $row['dynamic']; 
		               $som_date_debut = $row['date_debut'];
		                 $som_date_fin = $row['date_fin'];
		                     $som_days = $row['days'];
		                          $key = $row['groupmenu'];
		
		if(strpos($som_days,'8')!== false || $now < $som_date_debut || ($som_date_fin > 0 && $now > $som_date_fin)) 
		{
			
			     $aenlever = "menu_showhide\('menu-".$som_groupmenu."','nok','menuupdown-".$som_groupmenu."'\);";
			$total_actions = str_replace("$aenlever", "" , $total_actions);
			continue;
		}
		
		if($som_dynamic != 'on') 
		{
			     $aenlever = "menu_showhide\('menu-".$som_groupmenu."','nok','menuupdown-".$som_groupmenu."'\);";
			$total_actions = str_replace("$aenlever", "" , $total_actions);
		}
		
		if(($general_dynamic == 1) && ($dynamictest != 1)) 
		{
			# $dynamic = 1;
			echo "\n<!--  START Titanium Portal Menu Dynamic Javascript Function v5.01 -->\n\n\n\n";
			?>
			<script type="text/javascript" language="JavaScript">
			var keymenu;
			function menu_showhide(tableau, trigger, somimagename) 
			{
				if(document.getElementById(tableau) && document.images[somimagename] && document.getElementById(tableau).style.display == "none" && trigger != "nok") 
				{
					var menu_block=document.getElementById('menu_block');
					document.getElementById(tableau).style.display = "<?php if($div == 1) {echo "";} ?>";
					document.images[somimagename].src="<?php echo $path_icon;?>/admin/up.gif";
				}
				else 
				if(document.getElementById(tableau) && document.images[somimagename]) 
				{
					var reg= new RegExp("<?php echo $path_icon;?>/admin/up.gif$","gi");
				
					if(reg.test(document.images[somimagename].src)) 
					{
						document.images[somimagename].src="<?php echo $path_icon;?>/admin/down.gif";
					}
				
					document.getElementById(tableau).style.display = "none";
				}
			}
			</script>
			<?php
			echo "\n<!--  END Titanium Portal Menu Dynamic Javascript Function v5.01 -->\n\n\n\n";
		}
		
		$dynamictest = 1;
		
		if($som_hr == "on" && $horizontal != 1) 
		{
			$content .= "<tr><td><hr width=\"100%\"></td></tr>\n"; # 15 mars 2005 : adjust the width to 100%
		}

		if($som_groupmenu <> 99) 
		{
			
		  //if($som_dynamic=='on' && $detectMozilla!=1 && isset($moduleinthisgroup[$som_groupmenu]['0']) && $som_listbox!="on") 
		  if($som_dynamic == 'on' && isset($moduleinthisgroup[$som_groupmenu]['0']) && $som_listbox != "on") 
		  { 
				      $reenrouletout = str_replace("menu_showhide\(\'menu-$som_groupmenu\',\'nok\',\'menuupdown-$som_groupmenu\'\);","",$total_actions);
				$action_somgroupmenu = "onclick=\"keymenu=".$key.";".$reenrouletout." menu_showhide('menu-$som_groupmenu','ok','menuupdown-$som_groupmenu')\" style=\"cursor:pointer\"";            // menu dynamic
			}
			else 
			{
			  $action_somgroupmenu = "";
			}
			
			if($horizontal == 1) 
			{
				$content .= "<td bgcolor=\"$som_bgcolor\" width=\"4\"></td><td bgcolor=\"$som_bgcolor\" class=\"menunowrap\" valign=\"top\"><table class=\"menunowrap\"><tr><td $action_somgroupmenu>\n";
			}
			else 
			{
				$positioningtd = ($div == 1) ? "" : "" ;
			    
				$content .= "<tr bgcolor=\"$som_bgcolor\">\n";
				
				$content .= "<td height=\"4\" width=\"100%\"></td><td id=\"menu_divsublevel$key\"></td>\n";
				
				$content .= "</tr>\n";
			    
				$content .= "<tr><td bgcolor=\"$som_bgcolor\" class=\"menunowrap\" width=\"100%\" $action_somgroupmenu>\n";
			}
			
			if($som_center == "on") 
			{
				$content .= "<div align=\"center\">\n";
			}
			
			if($som_lien <> "") 
			{
				if(strpos($som_lien,"LANG:_") === 0) 
				{ 
					$som_lien = str_replace("LANG:","",$som_lien);
					eval( "\$som_lien = $som_lien;");
				}
				
				$testepopup=strpos($som_lien,"javascript:window.open(");
				
				if($testepopup === 0) 
				{
					$som_lien = str_replace("window.open","menu_over_popup",$som_lien);
					$content .= "<a href=\"$som_lien\"";
				}
				else 
				{
				  $content .= "<a href=\"$som_lien\"";
				  $testehttp=strpos($som_lien,"http://");
				  $testehttps=strpos($som_lien,"https://");
				  $testeftp=strpos($som_lien,"ftp://");
				
				  if($testehttp === 0 || $testeftp === 0 || $testehttps === 0) 
				  {
					$content .= " target=\"_tab\"";
				  }
				  
				  $content .= ">";
				}
			}

			if($som_image <> "noimg") 
			{
				if(stristr(".swf",$som_image)) # addd FLASH support
				{ 
				   $content .= "<OBJECT classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" width=\"179\" height=\"20\" id=\"$som_groupmenu\"><PARAM NAME=movie VALUE=\"$path_icon/$som_image\"><PARAM NAME=quality VALUE=high><EMBED src=\"$path_icon/$som_image\" quality=high WIDTH=\"160\" HEIGHT=\"20\" TYPE=\"application/x-shockwave-flash\" wmode=\"transparent\"></EMBED></OBJECT><br>";
        		}
				else 
				{
				    $fermebalise = ($som_lien!="") ? "</a>" : "" ;
					$content .= "<img align=\"$align\" src=\"$path_icon/$som_image\" border=\"0\" alt=\"$som_image\">".$fermebalise."&nbsp;";
				}
			}

			if(strpos($som_name,"LANG:_") === 0) 
			{
				$som_name = str_replace("LANG:","",$som_name);
				eval( "\$som_name = $som_name;");
			}
			
			if(stristr(".swf",$som_image) || $som_name == "" || $som_name ==" " || $som_name=="&nbsp;" || $som_name=="&amp;nbsp;") 
			{ 
				$no_category_text[$som_groupmenu] = 1;
			}
			else 
			{
				if($som_lien<>"") 
				{
					if(strpos($som_lien,"LANG:_") === 0) 
					{
						$som_lien = str_replace("LANG:","",$som_lien);
						eval( "\$som_lien = $som_lien;");
					}
					
					$testepopup=strpos($som_lien,"javascript:window.open(");
					
					if($testepopup === 0) 
					{
						$som_lien = str_replace("window.open","menu_over_popup",$som_lien);
						$content.="<a href=\"$som_lien\"";
					}
					else 
					{
						$content .= "<a href=\"$som_lien\"";
						$testehttp=strpos($som_lien,"http://");
						$testeftp=strpos($som_lien,"ftp://");
						$testehttps=strpos($som_lien,"https://");
					
						if($testehttp === 0 || $testeftp === 0 ||$testehttps === 0) 
						{
							$content .= " target=\"_tab\"";
						}
					}
				
				   $content.=" class=\"$categoryclass[$classpointeur]\">";
				}
				
				$content.="<span class=\"$categoryclass[$classpointeur]\">";
				
				$bold1 = ($som_bold == "on") ? "<strong>" : "" ;
				$bold2 = ($som_bold == "on") ? "</strong>" : "" ;
				
				# add NEW (new.gif)to top level
				$new = ($som_new == "on") ? "<img align=\"$align\" src=\"$path_icon/admin/$imgnew\" border=0 title=\""._MENU_NEWCONTENT."\" alt=\""._MENU_NEWCONTENT."\"> " : "" ;
				
				$content .= "".$bold1."$som_name".$bold2." ".$new."";
			}
			
			$content .= "</span>";
			
			if($som_lien <> "") 
			{
				$content .= "</a>";
			}
			
			if($som_dynamic == 'on' && isset($moduleinthisgroup[$som_groupmenu]['0'])) 
			{
				$zeimage = ($som_listbox == "on") ? "null.gif" : "down.gif" ;
				$content .= "<img align=\"bottom\" id=\"menuupdown-$som_groupmenu\" src=\"$path_icon/admin/$zeimage\" border=0 alt=\"Show/Hide content\">";
			}
			
			if($som_center == "on") 
			{
				$content .= "</div>";
			}
			
			if($div == 1) 
			{
				$content .= "</td><td style=\"vertical-align: top;\">";
			}
			else
			if($horizontal == 1) 
			{
				$content .= "</td></tr>\n";
			}
			else 
			{
				$content .= "</td></tr>\n";
			}
			
		}
		
		$keyinthisgroup = 0;
		
		if($som_groupmenu != 99 && !isset($moduleinthisgroup[$som_groupmenu]['0'])) 
		{ 
			if($horizontal == 1) 
			{
				$content .= "</table></td><td width=\"4\" bgcolor=\"$som_bgcolor\"></td>";
			}
			else 
			{
				$content .= "<tr bgcolor=\"$som_bgcolor\"><td height=\"4\"></td></tr>";
			}
		}
		else
		if($som_groupmenu != 99 && isset($moduleinthisgroup[$som_groupmenu]['0'])) 
		{
		     if($som_listbox == "on") 
		     {
			   $content .= "<tr><td bgcolor=\"$som_bgcolor\"><span id=\"menu-$som_groupmenu\"></span>";
			   $aenlever = "menu_showhide\('menu-".$som_groupmenu."','nok','menuupdown-".$som_groupmenu."'\);";
			   $total_actions = str_replace("$aenlever", "" , $total_actions);
			
			   $content .= "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"menunowrap\"><tr><td width=\"100%\">";
			
			   $content .= "<form action=\"modules.php\" method=\"get\" name=\"menuformlistbox\">"
				  	    ."<select name=\"somlistbox$key\" onchange=\"menu_listbox(this.options[this.selectedIndex].value)\">"
					    ."<option value=\"select\">"._MENU_SELECTALINK."";
		  }
	    else 
		{
			if($div == 1) 
			{
				if(!$som_bgcolor) 
				{
					$divbgcolor = (!$bgcolor1) ? "#ffffff" : $bgcolor1;
				}
				else 
				{
					$divbgcolor = $som_bgcolor;
				}
				
				$content .= "<table id=\"menu-$som_groupmenu\" style=\"position: absolute; z-index: 2; background-color:".$divbgcolor."; border: 1px solid ".$bgcolor2.";\"><tr><td>";
			}
			else 
			{
				$content .= "<tr id=\"menu-$som_groupmenu\"><td bgcolor=\"$som_bgcolor\" width=\"100\">";
			}
			
			$content .= "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"menunowrap\">";
		}
		
		if($som_image <> "noimg" && !stristr(".swf",$som_image) && $som_center <> "on") 
		{ 
			$catimagesize = getimagesize("$path_icon/$som_image");
		}
		else 
		{
			$catimagesize[0] = 1; 
		}
		
		while ($moduleinthisgroup[$som_groupmenu][$keyinthisgroup]) 
		{ 
			if(strpos($daysinthisgroup[$som_groupmenu][$keyinthisgroup],'8')!== false || $now<$date_debutinthisgroup[$som_groupmenu][$keyinthisgroup] 
			                                                                          || ($date_fininthisgroup[$som_groupmenu][$keyinthisgroup] > 0 
																					  && $now>$date_fininthisgroup[$som_groupmenu][$keyinthisgroup])) 
			{
				$keyinthisgroup++;
				continue;
			}
			
			if($grasinthisgroup[$som_groupmenu][$keyinthisgroup] == "on") 
			{ 
				$gras1 = "<strong>";
				$gras2 = "</strong>";
			}
			else 
			{
				$gras1 = $gras2 = "";
			}
			
			if($som_listbox == "on") 
			{ 
				if($moduleinthisgroup[$som_groupmenu][$keyinthisgroup] == "External Link") 
				{
					if(strpos($linkinthisgroup[$som_groupmenu][$keyinthisgroup],"LANG:_") === 0) 
					{
						$zelink_lang = str_replace("LANG:","",$linkinthisgroup[$som_groupmenu][$keyinthisgroup]);
						eval( "\$zelink_lang = $zelink_lang;");
						$linkinthisgroup[$som_groupmenu][$keyinthisgroup] = $zelink_lang;
					}
					
					$testehttp=strpos($linkinthisgroup[$som_groupmenu][$keyinthisgroup],"http://");
					$testeftp=strpos($linkinthisgroup[$som_groupmenu][$keyinthisgroup],"ftp://");
					$testehttps=strpos($linkinthisgroup[$som_groupmenu][$keyinthisgroup],"https://");
					$testepopup=strpos($linkinthisgroup[$som_groupmenu][$keyinthisgroup],"javascript:window.open(");
					
					if($testehttp === 0 || $testeftp === 0 || $testehttps ===0) 
					{
						$zelink = "_menu_targetblank";
					}
					else
					if($testepopup === 0) 
					{
						$zelink = " target=\"popup_menu\"";
					}
					else 
					{
						$zelink = "";
					}
					
					$linklang=$linktextinthisgroup[$som_groupmenu][$keyinthisgroup];
					
					if(strpos($linklang,"LANG:_") === 0) 
					{
						$linklang = str_replace("LANG:","",$linklang);
						eval( "\$linklang = $linklang;");
					
						if($linklang == "") 
						{
						  $keyinthisgroup++;
						  continue;
						} 
						
						$linktextinthisgroup[$som_groupmenu][$keyinthisgroup]=$linklang;
					}
					
					$content .= "<option value=\"".$linkinthisgroup[$som_groupmenu][$keyinthisgroup]."".$zelink."\">".$linktextinthisgroup[$som_groupmenu][$keyinthisgroup]."";
				}
				else
				if($moduleinthisgroup[$som_groupmenu][$keyinthisgroup] != "Horizonatal Rule" && $moduleinthisgroup[$som_groupmenu][$keyinthisgroup] != "MENUTEXTONLY" ) 
				{
					if($poster_moduleinthisgroup[$som_groupmenu][$keyinthisgroup]!= 2 || $is_admin == 1) 
					{
						$content .= "<option value=\"".$urldumoduleinthisgroup[$som_groupmenu][$keyinthisgroup]."\">".$customtitle2inthisgroup[$som_groupmenu][$keyinthisgroup]."";
					}
				}
			}
			else
			if($moduleinthisgroup[$som_groupmenu][$keyinthisgroup] == "MENUTEXTONLY" 
			|| ($moduleinthisgroup[$som_groupmenu][$keyinthisgroup] == "External Link" 
			&& !preg_match("^modules.php\?name=^", $linkinthisgroup[$som_groupmenu][$keyinthisgroup]) 
			&& !preg_match("^((http(s)?)|(ftp(s)?))://".$_SERVER['SERVER_NAME']."/modules.php\?name=^",$linkinthisgroup[$som_groupmenu][$keyinthisgroup]))) 
			{ 
				if(strpos($linkinthisgroup[$som_groupmenu][$keyinthisgroup],"LANG:_") === 0) 
				{
					$zelink_lang = str_replace("LANG:","",$linkinthisgroup[$som_groupmenu][$keyinthisgroup]);
					eval( "\$zelink_lang = $zelink_lang;");
					$linkinthisgroup[$som_groupmenu][$keyinthisgroup] = $zelink_lang;
				}
	
				$testepopup=strpos($linkinthisgroup[$som_groupmenu][$keyinthisgroup],"javascript:window.open(");
				
				if($testepopup === 0) 
				{
				  $linkinthisgroup[$som_groupmenu][$keyinthisgroup] = str_replace("window.open","menu_over_popup",$linkinthisgroup[$som_groupmenu][$keyinthisgroup]);
				  $zelink = "";
				}
				else 
				{
					$testehttp=strpos($linkinthisgroup[$som_groupmenu][$keyinthisgroup],"http://");
					$testeftp=strpos($linkinthisgroup[$som_groupmenu][$keyinthisgroup],"ftp://");
					$testehttps=strpos($linkinthisgroup[$som_groupmenu][$keyinthisgroup],"https://");
					
					if($testehttp === 0 || $testeftp === 0 || $testehttps === 0) 
					{
						$zelink = " target=\"_tab\"";
					}
					else 
					{
						$zelink = "";
					}
				}
			
			$linklang=$linktextinthisgroup[$som_groupmenu][$keyinthisgroup];
			
			if(strpos($linklang,"LANG:_") === 0) 
			{
				$linklang = str_replace("LANG:","",$linklang);
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
						$sublevelzindex=$sublevelinthisgroup[$som_groupmenu][$keyinthisgroup]+2;
						$content .= "<td style=\"vertical-align: top;\"><table id=\"".$id_sublevel."\" cellpadding=0 cellspacing=0 border=0 class=\"menunowrap\" style=\"position: absolute; z-index: ".$sublevelzindex."; border: 1px solid ".$bgcolor2."; background-color: ".$bgcolor1.";\">";
					}
					else 
					{
					    $content .= "<tr id=\"".$id_sublevel."\"><td style=\"align: right;".$zebar."\"></td><td><table cellpadding=0 cellspacing=0 border=0 class=\"menunowrap\">";
					}
					
					$id_sublevel = "";
					$id_sublevel_img = "";
					$current_sublevel++;
				}
				
				//sublevels - showhide
				if($keyinthisgroup<count($moduleinthisgroup[$som_groupmenu])-1 && $sublevelinthisgroup[$som_groupmenu][$keyinthisgroup]<$sublevelinthisgroup[$som_groupmenu][$keyinthisgroup+1]) 
				{
					$ligne=($som_dynamic == 'on') ? "<tr style=\"cursor: pointer;\" onclick=\"menu_showhide('menusublevel-$som_groupmenu-".($keyinthisgroup+1)."','ok','menuupdown-sublevel-$som_groupmenu-".($keyinthisgroup+1)."');\">" : "<tr>"; // onclick=\"menu_showhide('menusublevel-$som_groupmenu-$keyinthisgroup','ok','menuupdown-sublevel-$som_groupmenu-$keyinthisgroup');\"
					$id_sublevel = "menusublevel-$som_groupmenu-".($keyinthisgroup+1);
					$id_sublevel_img = "menuupdown-sublevel-$som_groupmenu-".($keyinthisgroup+1);
					$ferme_sublevels .= ($som_dynamic == 'on') ? "menu_showhide('$id_sublevel','nok','$id_sublevel_img');" :  "" ;
					$sublevel_updownimg =($som_dynamic == 'on') ? "<img id=\"".$id_sublevel_img."\" src=\"$path_icon/admin/up.gif\" alt=\"Show/Hide content\" border=0>" : "";
				}
				else 
				{
					$ligne = "<tr>";
					$sublevel_updownimg = "";
				}
				
			   # add NEW (new.gif)to sub level 
			   $new = ($newinthisgroup[$som_groupmenu][$keyinthisgroup] == "on") ? " <img align=\"$align\" src=\"$path_icon/admin/$imgnew\" border=0 title=\""._MENU_NEWCONTENT."\" alt=\""._MENU_NEWCONTENT."\">" : "" ;
			   $imagedulien = "<img align=\"$align\" src=\"$path_icon/categories/".$imageinthisgroup[$som_groupmenu][$keyinthisgroup]."\" border=0 alt=\"".$imageinthisgroup[$som_groupmenu][$keyinthisgroup]."\">";
			
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
			
				if($imageinthisgroup[$som_groupmenu][$keyinthisgroup] <> "middot.gif" && ($linktextinthisgroup[$som_groupmenu][$keyinthisgroup] == "" 
				|| $linktextinthisgroup[$som_groupmenu][$keyinthisgroup] == " " 
				|| $linktextinthisgroup[$som_groupmenu][$keyinthisgroup] == "&nbsp;" 
				|| $linktextinthisgroup[$som_groupmenu][$keyinthisgroup] == "&amp;nbsp;")) 
				{ 
					$content .= $ligne."<td colspan=2 width=\"100%\">".$lelien.$imagedulien.$close_lelien.$new.""; 
					$content .= $sublevel_updownimg."</td></tr>\n";
				}
				else
				if($imageinthisgroup[$som_groupmenu][$keyinthisgroup] <> "middot.gif") 
				{ 
					if($no_category_text[$som_groupmenu] === 1) 
					{	
						$content .= $ligne."<td colspan=2 align=\"left\" width=\"100%\">".$imagedulien."&nbsp;".$lelien.$gras1.$letexte.$gras2.$close_lelien.$new.""; 
					}
					else 
					{
						$content .= $ligne."<td width=\"$catimagesize[0]\" align=\"right\">".$imagedulien."</td><td>&nbsp;".$lelien.$gras1.$letexte.$gras2.$close_lelien.$new.""; 
					}
					
					$content .= $sublevel_updownimg."</td></tr>\n";
				}
				else 
				{ 
					if($no_category_text[$som_groupmenu] === 1) 
					{	
						$content .= $ligne."<td colspan=2 align=\"left\" width=\"100%\"><span class=\"".$classinthisgroup[$som_groupmenu][$keyinthisgroup]."\"><strong><big>&middot;</big></strong></span>&nbsp;".$lelien.$gras1.$letexte.$gras2.$close_lelien.$new.""; //v2.1.2beta4 : ajout de $close_lelien
					}
					else 
					{
						$content .= $ligne."<td width=\"$catimagesize[0]\" align=\"right\"><span class=\"".$classinthisgroup[$som_groupmenu][$keyinthisgroup]."\"><strong><big>&middot;</big></strong></span></td><td>&nbsp;".$lelien.$gras1.$letexte.$gras2.$close_lelien.$new.""; //v2.1.2beta4 : ajout de $close_lelien
					}
					
					$content .= $sublevel_updownimg."</td></tr>\n";
				}
			
				
				# sublevels
				if($keyinthisgroup == count($moduleinthisgroup[$som_groupmenu]) -1) 
				{
					for($sub = 0; $sub < $current_sublevel; $sub++) 
					{
						$content .= "</table></td></tr>";
					}
				}
				else
				if($current_sublevel > $sublevelinthisgroup[$som_groupmenu][$keyinthisgroup+1]) 
				{
					for($sub=0; $sub < ($current_sublevel-$sublevelinthisgroup[$som_groupmenu][$keyinthisgroup+1]); $sub++) 
					{
						$content .= "</table></td></tr>";
					}
					
					$current_sublevel = $sublevelinthisgroup[$som_groupmenu][$keyinthisgroup+1];
				}
			
			}
			else
			if($moduleinthisgroup[$som_groupmenu][$keyinthisgroup] == "Horizonatal Rule") 
			{
				$content .= "<tr><td colspan=\"2\">";
				$content .= "<hr>";
				$content .= "</td></tr>\n";
			}
			else 
			{
				if($moduleinthisgroup[$som_groupmenu][$keyinthisgroup] == "External Link") 
				{ 
					#1# Old Code
					#1# $temponomdumodule=split("&", $linkinthisgroup[$som_groupmenu][$keyinthisgroup]);
					
					// Split at '/', could use explode() but the PREG_SPLIT_NO_EMPTY flag is
                    // very handy since it handles "//" and "/" at start/end.
                   $temponomdumodule = preg_split('#/#', $linkinthisgroup[$som_groupmenu][$keyinthisgroup], -1, PREG_SPLIT_NO_EMPTY);
					
					 $nomdumodule = $nomdumoduleinthisgroup[$som_groupmenu][$keyinthisgroup];
					 $targetblank = $targetblankinthisgroup[$som_groupmenu][$keyinthisgroup];
					$customtitle2 = $customtitle2inthisgroup[$som_groupmenu][$keyinthisgroup];
					 $urldumodule = $urldumoduleinthisgroup[$som_groupmenu][$keyinthisgroup];

					if(strpos($urldumodule,"LANG:_") === 0) 
					{
						$zelink_lang = str_replace("LANG:","",$urldumodule);
						eval( "\$zelink_lang = $zelink_lang;");
						$urldumodule = $zelink_lang;
					}
					
					$linklang = $customtitle2;
					
					if(strpos($linklang,"LANG:_") === 0) 
					{
						$linklang = str_replace("LANG:","",$linklang);
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
					$temponomdumodule = array(); 
					     $nomdumodule = $nomdumoduleinthisgroup[$som_groupmenu][$keyinthisgroup];
					     $targetblank = $targetblankinthisgroup[$som_groupmenu][$keyinthisgroup];
					    $customtitle2 = $customtitle2inthisgroup[$som_groupmenu][$keyinthisgroup];
					     $urldumodule = $urldumoduleinthisgroup[$som_groupmenu][$keyinthisgroup];
				}
				
				if($som_dynamic == 'on') 
				{
					#1# Old code by Frenchie
					#1# détection améliorée de la catégorie à ouvrir
					#1# $temprequesturi=split('&',$_SERVER['REQUEST_URI']);
					
					#1# NEW CODE by Ernest Allen Buffington for PHP 7.3.6 - 08/28/2019
					#1# Split at '/', could use explode() but the PREG_SPLIT_NO_EMPTY flag is
                    #1# very handy since it handles "//" and "/" at start/end.
					$temprequesturi = preg_split('#/#', $_SERVER['REQUEST_URI'], -1, PREG_SPLIT_NO_EMPTY);
					
					#2# Old code by Frenchie
					#2# $tempurldumodule=split('&',$urldumodule);
					
                    #2# NEW CODE by Ernest Allen Buffington for PHP 7.3.6 - 08/28/2019
					#2# Split at '/', could use explode() but the PREG_SPLIT_NO_EMPTY flag is
                    #2# very handy since it handles "//" and "/" at start/end.
					$tempurldumodule = preg_split('#/#', $urldumodule, -1, PREG_SPLIT_NO_EMPTY);
					
					
					$nbparam=count($tempurldumodule);
					$nbrequest=count($temprequesturi);
					$requesturi=$temprequesturi[0];
					
					if($nbparam <= $nbrequest) 
					{
						for ($i = 1; $i < $nbparam; $i++) 
						{
							$requesturi .= "&".$temprequesturi[$i];
						}
					}
					
					# Ernest Buffington Fix - 08/23/2019
					# was strstr now using a case sensitive check so needle problems do not occur 
					# if(strstr(addcslashes("$urldumodule$", '?&'), $requesturi)) <-- OLD CODE
					if(strcasecmp(addcslashes("$urldumodule$", '?&'), $requesturi)) 
					{ 
						$categorieouverte = $som_groupmenu;
						       $keyouvert = $keyinthisgroup;
					}
				}
				
				if($imageinthisgroup[$som_groupmenu][$keyinthisgroup] != "middot.gif") 
				$limage = "<img align=\"$align\" src=\"$path_icon/categories/".$imageinthisgroup[$som_groupmenu][$keyinthisgroup]."\" border=\"0\" alt=\"".$imageinthisgroup[$som_groupmenu][$keyinthisgroup]."\">";
				else 
				$limage = "<strong><big>&middot;</big></strong>";

				
				if($poster_moduleinthisgroup[$som_groupmenu][$keyinthisgroup] == 2) 
				$limage="<img align=\"$align\" src=\"$path_icon/admin/interdit.gif\" title=\"".$whyrestricted[$som_groupmenu][$keyinthisgroup]."\" alt=\"".$whyrestricted[$som_groupmenu][$keyinthisgroup]."\">";

				if(($newpms[0]) && ($nomdumodule == "Private_Messages")) 
				$disp_pmicon="<img src=\"images/blocks/email-y.gif\" height=\"10\" width=\"14\" alt=\""._MENU_NEWPM."\" title=\""._MENU_NEWPM."\">";
				else 
				$disp_pmicon="";
				
				# add NEW (new.gif)to ?
				$new = ($newinthisgroup[$som_groupmenu][$keyinthisgroup] == "on") ? "<img align=\"$align\" src=\"$path_icon/admin/$imgnew\" border=0 title=\""._MENU_NEWCONTENT."\" alt=\""._MENU_NEWCONTENT."\">" : "" ;

				if($nomdumodule == "Downloads" && $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup] != "-1") 
				{
				    $where = (preg_match("/^cid=[0-9]*$/",$temponomdumodule[2])) ? " WHERE $temponomdumodule[2]" : "";
					$sqlimgnew = "SELECT date FROM ".$prefix."_nsngd_downloads".$where." order by date desc limit 1";
					$resultimgnew = $db->sql_query($sqlimgnew);
					$rowimgnew = $db->sql_fetchrow($resultimgnew);
				
					if($rowimgnew['date']) 
					{
						preg_match("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $rowimgnew['date'], $datetime);
						$zedate = mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]);
						$now=time();
						
						if(intval(($now-$zedate)/86400) <= $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup]) 
						{
							$new = "<img align=\"$align\" src=\"$path_icon/admin/$imgnew\" border=0 title=\""._MENU_NEWCONTENT."\" alt=\""._MENU_NEWCONTENT."\">";
						}
					}
				}
                else
				if ($nomdumodule == "Web_Links" && $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup] != "-1") 
				{
                    $where = (preg_match("/^cid=[0-9]*$/",$temponomdumodule[2])) ? " WHERE $temponomdumodule[2]" : "";
                    $sqlimgnew = "SELECT date FROM ".$prefix."_links_links".$where." ORDER BY date DESC LIMIT 1";
                    $resultimgnew = $db->sql_query($sqlimgnew);
                    $rowimgnew = $db->sql_fetchrow($resultimgnew);
                
				    if ($rowimgnew['date']) 
					{
                       preg_match("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $rowimgnew['date'], $datetime);
                       $zedate = mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]);
                       $now=time();
                    
					   if(intval(($now-$zedate)/86400) <= $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup]) 
					   {
                            $new = "<img align=\"$align\" src=\"$path_icon/admin/$imgnew\" border=0 title=\""._MENU_NEWCONTENT."\" alt=\""._MENU_NEWCONTENT."\">";
                       }
                     }
                }
				else
				if($nomdumodule == "Content" && $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup]!="-1") 
				{
				    $where = (preg_match("/^cid=[0-9]*$/",$temponomdumodule[2])) ? " WHERE $temponomdumodule[2]" : "";
					$sqlimgnew="SELECT date FROM ".$prefix."_pages".$where." order by date desc limit 1";
					$resultimgnew=$db->sql_query($sqlimgnew);
					$rowimgnew = $db->sql_fetchrow($resultimgnew);
				
					if($rowimgnew['date']) 
					{
						preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $rowimgnew['date'], $datetime);
						$zedate = mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]);
						$now=time();
						
						if(intval(($now-$zedate)/86400) <= $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup]) 
						{
							$new="<img align=\"$align\" src=\"$path_icon/admin/$imgnew\" border=0 title=\""._MENU_NEWCONTENT."\" alt=\""._MENU_NEWCONTENT."\">";
						}
					}
				}
				else
				if($nomdumodule == "Reviews" && $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup]!="-1") 
				{
					$where = "";
					$sqlimgnew="SELECT date FROM ".$prefix."_reviews".$where." order by date desc limit 1";
					$resultimgnew=$db->sql_query($sqlimgnew);
					$rowimgnew = $db->sql_fetchrow($resultimgnew);
				
					if($rowimgnew['date']) 
					{
						preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $rowimgnew['date'], $datetime);
						$zedate = mktime(0,0,0,$datetime[2],$datetime[3],$datetime[1]);
						$now=time();
						
						if(intval(($now-$zedate)/86400) <= $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup]) 
						{
							$new="<img align=\"$align\" src=\"$path_icon/admin/$imgnew\" border=0 title=\""._MENU_NEWCONTENT."\" alt=\""._MENU_NEWCONTENT."\">";
						}
					}
				}
				else # News module
				if($nomdumodule == "Blog" && $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup]!="-1") 
				{
				    global $db, $prefix;
					
				    $where = (preg_match("/^cid=[0-9]*$/",$temponomdumodule[2])) ? " WHERE ".str_replace("new_","",$temponomdumodule[1])."" : "";
				
					$sqlimgnew="SELECT datePublished FROM ".$prefix."_stories".$where." order by datePublished desc limit 1";
				
					$resultimgnew=$db->sql_query($sqlimgnew);
				
					$rowimgnew = $db->sql_fetchrow($resultimgnew);
				
					if($rowimgnew['datePublished']) 
					{
						preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $rowimgnew['date'], $datetime);
						$zedate = mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]);
						$now=time();
						
						if(intval(($now-$zedate)/86400) <= $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup]) 
						{
							$new="<img align=\"$align\" src=\"$path_icon/admin/$imgnew\" border=0 title=\""._MENU_NEWCONTENT."\" alt=\""._MENU_NEWCONTENT."\">";
						}
					}
				}
				else # Blog module
				if($nomdumodule == "Blog" && $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup]!="-1") 
				{
				    global $db, $prefix;
					
					$where = (preg_match("/^new_topic=[0-9]*$/",$temponomdumodule[1])) ? " WHERE ".str_replace("new_","",$temponomdumodule[1])."" : "";

					$sqlimgnew="SELECT datePublished FROM ".$prefix."_stories".$where." order by datePublished desc limit 1";
				
					$resultimgnew=$db->sql_query($sqlimgnew);
				
					$rowimgnew = $db->sql_fetchrow($resultimgnew);
				
					if($rowimgnew['datePublished']) 
					{
						preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $rowimgnew['date'], $datetime);
						$zedate = mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]);
						$now=time();
					
						if(intval(($now-$zedate)/86400) <= $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup]) 
						{
							$new="<img align=\"$align\" src=\"$path_icon/admin/$imgnew\" border=0 title=\""._MENU_NEWCONTENT."\" alt=\""._MENU_NEWCONTENT."\">";
						}
					}
				}
				# sublevels
				if($keyinthisgroup==0) 
				{
					$sublevelinthisgroup[$som_groupmenu][$keyinthisgroup]=0;
					$current_sublevel=0;
				}
				
				if($sublevelinthisgroup[$som_groupmenu][$keyinthisgroup]>$current_sublevel) 
				{
					if($imageinthisgroup[$som_groupmenu][$keyinthisgroup-1] == 'tree-T.png') 
					{
						$zebar="background: url($path_icon/categories/bar.gif) right top repeat-y;";
					}
					else 
					{
						$zebar="";
					}
					
					$catimagesize[0]=0;
					
					if($div==1) 
					{
						$sublevelzindex=$sublevelinthisgroup[$som_groupmenu][$keyinthisgroup]+2;
						$content.="<td style=\"vertical-align: top;\"><table id=\"".$id_sublevel."\" cellpadding=0 cellspacing=0 border=0 class=\"menunowrap\" style=\"position: absolute; z-index: ".$sublevelzindex."; border: 1px solid ".$bgcolor2."; background-color: ".$bgcolor1.";\">";
					}
					else 
					{
					    $content.="<tr id=\"".$id_sublevel."\"><td style=\"align: right;".$zebar."\"></td><td><table cellpadding=0 cellspacing=0 border=0 class=\"menunowrap\">";
					}
					
					$id_sublevel="";
					$id_sublevel_img="";
					$current_sublevel++;
				}
				
				# sublevels - showhide
				if($keyinthisgroup<count($moduleinthisgroup[$som_groupmenu])-1 && $sublevelinthisgroup[$som_groupmenu][$keyinthisgroup]<$sublevelinthisgroup[$som_groupmenu][$keyinthisgroup+1]) 
				{
					$ligne=($som_dynamic=='on') ? "<tr style=\"cursor: pointer;\" onclick=\"menu_showhide('menusublevel-$som_groupmenu-".($keyinthisgroup+1)."','ok','menuupdown-sublevel-$som_groupmenu-".($keyinthisgroup+1)."');\">" : "<tr>"; // onclick=\"menu_showhide('menusublevel-$som_groupmenu-$keyinthisgroup','ok','menuupdown-sublevel-$som_groupmenu-$keyinthisgroup');\"
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
					
					if(($div==1) && ($keyinthisgroup<count($moduleinthisgroup[$som_groupmenu])-1 && $sublevelinthisgroup[$som_groupmenu][$keyinthisgroup]<$sublevelinthisgroup[$som_groupmenu][$keyinthisgroup+1])) 
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
				
					if($no_category_text[$som_groupmenu]===1) 
					{	
						$content.=$ligne."<td colspan=2 align=\"left\" width=\"100%\">".$limage."".$disp_pmicon."";
					}
					else 
					{
						$content.=$ligne."<td".$width." align=\"right\">".$limage.""."</td><td>".$disp_pmicon."";
					}
					
					$content.="&nbsp;<a $aligncat href=\"".$urldumodule."\" class=\"".$classinthisgroup[$som_groupmenu][$keyinthisgroup]."\" ".$targetblank."><span class=\"".$classinthisgroup[$som_groupmenu][$keyinthisgroup]."\">".$gras1."$customtitle2".$gras2."</span></a> ".$new."";
					$content.=$sublevel_updownimg."</td>";
					
					if(($div==1) && ($keyinthisgroup<count($moduleinthisgroup[$som_groupmenu])-1 && $sublevelinthisgroup[$som_groupmenu][$keyinthisgroup]<$sublevelinthisgroup[$som_groupmenu][$keyinthisgroup+1])) 
					{
						
					}
					else 
					{
					  $content.="</tr>\n";
					}
				}

				# sublevels - ferme
				if($keyinthisgroup == count($moduleinthisgroup[$som_groupmenu])-1) 
				{
					for($sub=0;$sub<$current_sublevel;$sub++) 
					{
						$content.="</table></td></tr>";
					}
				}
				else
				if($current_sublevel>$sublevelinthisgroup[$som_groupmenu][$keyinthisgroup+1]) 
				{
					for($sub=0;$sub<($current_sublevel-$sublevelinthisgroup[$som_groupmenu][$keyinthisgroup+1]);$sub++) 
					{
						$content.="</table></td></tr>";
					}
					
					$current_sublevel=$sublevelinthisgroup[$som_groupmenu][$keyinthisgroup+1];
				}
	   		}
			
			$keyinthisgroup++;
		}
		
		if($som_listbox=="on") 
		{
			$content.="</select></form></td></tr>";
		}
		
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
			$content.="</table></td><td width=\"4\" bgcolor=\"$som_bgcolor\"></td>";
		}
		else 
		{
			$content.="<tr bgcolor=\"$som_bgcolor\"><td height=\"4\"></td></tr>";
		}
		}
	
		if($som_groupmenu == 99 && $is_admin==1 && $horizontal!=1) 
		{ 
			if($som_name != "menunoadmindisplay") 
			{
				$showadmin=1;
				$content.="<tr><td>";
				
				for ($z=0;$z<count($module);$z++) 
				{
					$customtitle2 = str_replace ("_"," ", $module[$z]);
				
					if($customtitle[$z] != "") 
					{
						$customtitle2 = $customtitle[$z];
					}
					
					if($module[$z] != $main_module) 
					{
						if(($is_admin===1 AND $view[$z] == 2) OR $view[$z] != 2) 
						{
							$incategories=0;
						
							for ($i=0;$i<count($totalcategorymodules);$i++) 
							{
								if($module[$z]==$totalcategorymodules[$i]) 
								{
									$incategories=1;
								}
							}
							
							if($incategories==0) 
							{
								$flagmenu = $flagmenu+1;
							
								if($flagmenu==1) 
								{
									$content .="<hr><div align=\"center\">"._MENU_ADMINVIEWALLMODULES."</div><br>";   // si il y a des modules affichés en rubrique 99, on affiche avant une ligne horizontale
								}
								
								$urldumodule99 = ($gt_url[$z]!="") ? $gt_url[$z] : "modules.php?name=".$module[$z] ; // GT-NextGen
								
								if(($newpms[0]) AND ($module[$z]=="Private_Messages")) 
								{ 
									$content .= "<strong><big>&middot;</big></strong><img src=\"images/blocks/email-y.gif\" height=\"10\" width=\"14\" alt=\""._MENU_NEWPM."\" title=\""._MENU_NEWPM."\"><a href=\"".$urldumodule99."\">$customtitle2</a><br>\n";
								}
								else 
								{
									$content .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"".$urldumodule99."\">$customtitle2</a><br>\n";
								}
							}
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
	
	if($general_dynamic==1 && $detectMozilla!=1) 
	{ 
		if(isset($categorieouverte)) 
		{
			$aenlever="menu_showhide\('menu-".$categorieouverte."','nok','menuupdown-".$categorieouverte."'\);";
			$total_actions = str_replace("$aenlever", "" , $total_actions);
		}
		
		if(isset($keyouvert)) 
		{ 
			$aenlever_sublevels="menu_showhide\('menusublevel-".$categorieouverte."-".$keyouvert."','nok','menuupdown-sublevel-".$categorieouverte."-".$keyouvert."'\);";
			$ferme_sublevels = str_replace("$aenlever_sublevels", "" , $ferme_sublevels);
			$j=$keyouvert;

			for ($i=$keyouvert-1;$i>=0;$i--) 
			{
				if($sublevelinthisgroup[$categorieouverte][$i]<=$sublevelinthisgroup[$categorieouverte][$j] && $sublevelinthisgroup[$categorieouverte][$i]<=$sublevelinthisgroup[$categorieouverte][$keyouvert]) 
				{
					$aenlever_sublevels="menu_showhide\('menusublevel-".$categorieouverte."-".$i."','nok','menuupdown-sublevel-".$categorieouverte."-".$i."'\);";
					$ferme_sublevels = str_replace("$aenlever_sublevels", "" , $ferme_sublevels);
					$j--;
				}
			}
		}
		
		$content.="<script type=\"text/javascript\" language=\"JavaScript\">$total_actions;\n";
		$content.=$ferme_sublevels;
		$content.="</script>";
	}


/* If you're Admin you and only you can see Inactive modules and test it */
/* If you copied a new module is the /modules/ directory, it will be added to the database */
if( $showadmin==1 && $is_admin===1 && $horizontal!=1) 
{
	$key=count($module); 
	$content .= "<br><div align=\"center\"><strong>"._INVISIBLEMODULES."</strong></div>";
	$content .= "<div align=\"center\"><font class=\"tiny\">"._ACTIVEBUTNOTSEE."</font></div>";
	$content.="<div align=\"center\"><form action=\"modules.php\" method=\"get\" name=\"menuformlistboxinvisibles\">"
	."<select name=\"somlistboxinvisibles\" onchange=\"menu_listbox(this.options[this.selectedIndex].value)\">"
	."<option value=\"select\">"._MENU_SELECTALINK."";
	$sql = "SELECT * FROM ".$prefix."_modules WHERE active='1' AND inmenu='0' ORDER BY title ASC";
	$result = $db->sql_query($sql);
	
	while ($row = $db->sql_fetchrow($result)) 
	{
		$module[$key]=$row['title'];
		$mn_title = $row['title'];
		$custom_title = $row['custom_title'];
		$mn_title2 = (!$custom_title) ? str_replace("_", " ", $mn_title) : $custom_title;
		$urldumodule_admin = (isset($row['url'])) ? $row['url'] : "modules.php?name=".$mn_title ; // GT-NextGen
		$content .= "<option value=\"".$urldumodule_admin."\">".$mn_title2."";
		$key++;
	}
	
	$content.= "</select></form></div>\n";
	
	$content .= "<br /><div align=\"center\"><strong>"._NOACTIVEMODULES."</strong></div>";
	$content .= "<div align=\"center\"><font class=\"tiny\">"._FORADMINTESTS."</font></div>";
	$content.="<div align=\"center\"><form action=\"modules.php\" method=\"get\" name=\"menuformlistboxinactifs\">"
				."<select name=\"somlistboxinactifs\" onchange=\"menu_listbox(this.options[this.selectedIndex].value)\">"
				."<option value=\"select\">"._MENU_SELECTALINK."";
	
	$sql = "SELECT title, custom_title FROM ".$prefix."_modules WHERE active='0' ORDER BY title ASC";
	$result = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($result)) 
	{
		$module[$key]=$row['title'];
		$key++;
		$mn_title = $row['title'];
		$custom_title = $row['custom_title'];
		$mn_title2 = (!$custom_title) ? str_replace("_", " ", $mn_title) : $custom_title;
	
		if($custom_title != "") 
		{
			$mn_title2 = $custom_title;
		}
		
		$urldumodule_admin = (isset($row['url'])) ? $row['url'] : "modules.php?name=".$mn_title ; // GT-NextGen
		$content .= "<option value=\"".$urldumodule_admin."\">".$mn_title2."";
		$dummy = 1;
	}
	
	$content.= "</select></form></div>\n";

	$handle=opendir('modules');
	
	while ($file = readdir($handle)) 
	{
	    if( (!strstr("[.]",$file)) ) 
		{
			$trouve=0;  
			
			for ($i=0;$i<count($module);$i++) 
			{
				if($module[$i]==$file) 
				{
				  $trouve=1;
				}
	    	}
			
			if($trouve<>1) 
			{
				$modlist .= "$file ";
			}
		}
	}
	
	closedir($handle);
	$modlist = explode(" ", $modlist);
	sort($modlist);
	
	for ($i=0; $i < sizeof($modlist); $i++) 
	{
	    if($modlist[$i] != "") 
		{
			$sql = "SELECT mid FROM ".$prefix."_modules WHERE title='$modlist[$i]'";
			$result = $db->sql_query($sql);
			$row = $db->sql_fetchrow($result);
			$mid = $row['mid'];
		
			if($mid == "") 
			{
			    $db->sql_query("INSERT INTO ".$prefix."_modules (mid, title, custom_title, active, view, inmenu) VALUES (NULL, '$modlist[$i]', '$modlist[$i]', '0', '0', '1')");
			}
	    }
	}
}

function menu_is_user($user, $managment_group) 
{
    global $prefix, $db, $uid, $userpoints;

    if(!is_array($user)) 
	{
		$user = addslashes($user); 
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
	$uid=intval($uid); 
    
	if($uid != "" AND $pwd != "") 
	{
		if($managment_group==0) 
		{
        	$sql = "SELECT user_password FROM ".$prefix."_users WHERE user_id='$uid'";
		}
		else 
		if($managment_group==1) 
		{
			$sql = "SELECT user_password, points FROM ".$prefix."_users WHERE user_id='$uid'";
		}
		else 
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
        $user2 = base64_decode($user);
    
	    $t_cookie = explode(":", $user2);
    
	    if($t_cookie[9]=="") $t_cookie[9]=$Default_Theme;
    
	    if(isset($theme)) $t_cookie[9]=$theme;
    
	    if(!$tfile=@opendir("themes/$t_cookie[9]")) 
		{
            $ThemeSel = $Default_Theme;
        } 
		else 
		{
            $ThemeSel = $t_cookie[9];
        }
    } 
	else 
	{
        $ThemeSel = $Default_Theme;
    }
    
	return($ThemeSel);
}
?>
