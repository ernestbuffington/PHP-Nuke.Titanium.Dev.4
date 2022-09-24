<?php
##########################################################################
# PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System #
##########################################################################
# PHP-NUKE: Advanced Content Management System                           #
#                                                                        #
# Copyright (c) 2002 by Francisco Burzi                                  #
# http://phpnuke.org                                                     #
#                                                                        #
# This program is free software. You can redistribute it and/or modify   #
# it under the terms of the GNU General Public License as published by   #
# the Free Software Foundation; either version 2 of the License.         #
##########################################################################
# Additional security checking code 2003 by chatserv                     #
# Old web address http://www.nukefixes.com                               #
# Old web address http://www.nukeresources.com                           #
##########################################################################

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
	  Titanium Patched                         v1.0.0       05/19/2021
-=[Mod]=-
      Lock Modules                             v1.0.0       08/04/2005
	  
	  Groups Permissiond Mod                   v1.0.0       05/19/2021
	  This mod adds a stop sign and message for the user when they try
	  to access a module that is assigned to a group that they are not
	  a member of.
 ************************************************************************/
define('MODULE_FILE', true);

if(isset($_GET['file']) && $_GET['file'] == 'posting') 
define('MEDIUM_SECURITY', true);

if(isset($_GET['Action']) && $_GET['Action'] == 'AJAX')
define('MEDIUM_SECURITY', true);

if(isset($_POST['tos_text']) && isset($_POST['op']) && $_POST['op'] == 'editTOS')
define('MEDIUM_SECURITY', true);

require_once(dirname(__FILE__) . '/mainfile.php');

global $name;

if($name): 
    # Mod: Lock Modules v1.0.0 START
    global $titanium_db, $titanium_prefix, $titanium_user, $lock_titanium_modules;

    if(($lock_titanium_modules && $name != 'Your_Account') 
	&& !is_admin() 
	&& !is_user() 
	&& ($name != 'Profile' 
	&& $mode == 'register' 
	&& (isset($check_num) 
	|| isset($HTTP_POST_VARS['submit'])))) 
    include(NUKE_MODULES_DIR.'Your_Account/index.php');
    # Mod: Lock Modules v1.0.0 END

    $titanium_module = $titanium_db->sql_ufetchrow('SELECT `title`, `active`, `view`, `blocks`, `custom_title`, `groups` FROM `'.$titanium_prefix.'_modules` WHERE `title`="'.Fix_Quotes($name).'"');
	
	$titanium_module_name = $titanium_module['title'];
	
	if ($titanium_module_name == 'Your_Account' 
	|| $titanium_module_name == main_module_titanium()): 
		$titanium_module['active'] = true;
		$view = 0;
	else: 
		$view = $titanium_module['view'];
	endif;
	
	if($titanium_module['active'] || is_mod_admin($titanium_module_name)):
      if (!isset($file) OR $file != $_REQUEST['file']) 
		$file='index';
	     if (isset($open)) 
          if ($open != $_REQUEST['open']) 
		   $open = '';
        
		if((isset($file) 
		&& stristr($file,"..")) 
		|| (isset($mop) 
		&& stristr($mop,"..")) 
		|| (isset($open) 
		&& stristr($open,".."))) 
		die('You are so cool...');
		
		$showblocks = $titanium_module['blocks'];
		$titanium_module_title = ($titanium_module['custom_title'] != '') ? $titanium_module['custom_title'] : str_replace('_', ' ', $titanium_module_name);
        $modpath = isset($titanium_module['title']) ? NUKE_MODULES_DIR.$titanium_module['title']."/$file.php" : NUKE_MODULES_DIR.$name."/$file.php";
        $groups = (!empty($titanium_module['groups'])) ? $groups = explode('-', $titanium_module['groups']) : '';
        
		if(!empty($open)) 
        $modpath = isset($titanium_module['title']) ? NUKE_MODULES_DIR.$titanium_module['title']."/$open.php" : NUKE_MODULES_DIR.$name."/$open.php";
        		
		unset($titanium_module, $error);
		
		if($view >= 1 && !is_admin()): 
		    # Must Not be a user
			if($view == 2 AND is_user()): 
				$error = _MVIEWANON;
			# Must Be a user 
			elseif($view == 3 && !is_user()): 
				$error = _MODULEUSERS;
		    # Must Be a admin
			elseif($view == 4 && !is_mod_admin($titanium_module['title'])): 
				$error = _MODULESADMINS;
		    # Groups
			elseif($view == 6 && !empty($groups) && is_array($groups)): 
			    
				$ingroup = false;
			    global $userinfo;

			    foreach($groups as $group): 
    			     if(isset($userinfo['groups'][$group])):
					 $ingroup = true;
                 	 # Group Cookie Control START
					 list($groupname) = $titanium_db->sql_ufetchrow("SELECT `group_name` FROM ".$titanium_prefix."_bbgroups WHERE `group_id`=".$group."", SQL_NUM);
   			         $groupcookie = str_replace(" ", "_", $groupname);
					 if(!isset($_COOKIE[$groupcookie]))
					 setcookie($groupcookie, $group, time()+2*24*60*60);
			         # Group Cookie Control END
					 endif;
			    endforeach;

			    if(!$ingroup)
                  $result = $titanium_db->sql_query('SELECT `group_name`
			                                FROM  '.$titanium_prefix.'_bbgroups 
											WHERE group_id = '.$group.'
				                            ORDER BY group_id'); 
				 
				  if($titanium_db->sql_numrows($result)): 
	              
                     while(($row = $titanium_db->sql_fetchrow($result)) AND (!$ingroup)): 
                     
						 # this is so you can add a custom message to any groups on your portal
						 # just add the special group id number where it says 9999
						 if($group == 9999):
						 
						   $error  = '<div align="center" style="padding-top:6px;">';
                           $error .= '</div>';

						   $error .= '<h1>'._CREDENTIALS.''.$titanium_module_title.' '._AREA.'</h1>';
						   $error .= '<img class="icons" align="absmiddle" width="200" src="'.img('unknown-error.png','error').'"><br />'; 
                           $error .= '<strong><font size="4">'._MUSTJOIN.''.$row['group_name'].''._GAINACCESS;

						   $error .= '<div align="center" style="padding-top:6px;">';
                           $error .= '</div>';
						 
						 # this is so you can add a custom message to any groups on your portal
						 # just add the special group id number where it says 99999
						 elseif($group == 99999):
						 
						   $error  = '<div align="center" style="padding-top:6px;">';
                           $error .= '</div>';

						   $error .= '<h1>'._CREDENTIALS.''.$titanium_module_title.' '._AREA.'</h1>';
						   $error .= '<img class="icons" align="absmiddle" width="200" src="'.img('unknown-error.png','error').'"><br />'; 
                           $error .= '<strong><font size="4">'._MUSTJOIN.''.$row['group_name'].''._GAINACCESS;

						   $error .= '<div align="center" style="padding-top:6px;">';
                           $error .= '</div>';
					     
						 else:
						   
						   # this is the default message foe users that do not have group access to a module
						   $error  = '<div align="center" style="padding-top:6px;">';
                           $error .= '</div>';

						   $error .= '<h1>'._CREDENTIALS.''.$titanium_module_title.' '._AREA.'</h1>';
						   $error .= '<img class="icons" align="absmiddle" width="200" src="'.img('unknown-error.png','error').'"><br />'; 
                           $error .= '<strong><font size="4">'._MUSTJOIN.''.$row['group_name'].''._GAINACCESS;

						   $error .= '<div align="center" style="padding-top:6px;">';
                           $error .= '</div>';

					     endif;

					 endwhile;
        
                  endif;
				 $titanium_db->sql_freeresult($result);
			endif;
		endif;
		
        if(isset($error)) 
            DisplayError($error);
		elseif(file_exists($modpath)) 
            include($modpath);
		else 
            DisplayError(_MODULEDOESNOTEXIST);
     
	else: 
        DisplayError(_MODULENOTACTIVE."<br /><br />"._GOBACK);
    endif;
 
else: 
    redirect_titanium('index.php');
endif;
?>
