<?php
/*=======================================================================
 PHP-Nuke Titanium : Nuke-Evolution | Enhanced and Advnanced
 =======================================================================*/

/************************************************************************
   Nuke-Evolution    : Server Info Administration
   PHP-Nuke Titanium : Server Info Administration
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team
   Copyright (c) 2022 by The PHP-Nuke Titanium Group

   Filename      : avatar.php
   Author(s)     : Ernest Allen Buffington, Technocrat
   Version       : 4.0.3
   Date          : 05.19.2005 (mm.dd.yyyy)
   Last Update   : 12.12.2022 (mm.dd.yyyy)
   
   Notes         : Evo User Block Members Module
************************************************************************/

if(!defined('NUKE_EVO')):
  die("Illegal File Access");
endif;

global $evouserinfo_addons, $evouserinfo_members;

# group memberships
function evouserinfo_members() 
{
    global $userinfo, $db, $prefix, $user_prefix, $evouserinfo_members, $lang_evo_userblock;
    
    $evouserinfo_members = '<div style="font-weight: bold">'.$lang_evo_userblock['BLOCK']['MEMBERS']['MEMBERS'].'</div>';

    $in_group = array();
    
	# Select all groups where the user is a member
    if(isset($userinfo['groups'])) 
	{
	   foreach ($userinfo['groups'] as $id1 => $name) 
	   {
          $in_group[] = $id1;
    
	      if(!empty($name))
		  {
			$group_name = GroupColor($name);
			$evouserinfo_members .= '<div style="padding-left: 10px;">';
		    $evouserinfo_members .= '<font title="'.$id1.'" class="tooltip-html-side-interact tooltipstered" 
			color="lime"><i title="'.$id1.'" alt="'.$id1.'" class="fas fa-users"></i></font> ';
            $evouserinfo_members .= '<a class="tooltip-html-side-interact tooltipstered" 
			title="'.$name.'" href="modules.php?name=Groups&amp;g='.$id1 . '"><strong>' . $group_name . '</strong></a><br />';
			$evouserinfo_members .= '</div>';
            
			# Group Cookie Control START
			$groupcookie = str_replace(" ", "_", $name);
			if(!isset($_COOKIE[$groupcookie]))
			setcookie($groupcookie, $id1, time()+2*24*60*60);  
			# Group Cookie Control END
        
		  }
       }
    }


    # Select all groups where the user has a pending membership.
    if(is_user()) 
	{
	   $result = $db->sql_query('SELECT g.group_id, 
	                                  g.group_name, 
								      g.group_type
            
			               FROM '.$prefix.'_bbgroups g, 
			               '.$prefix.'_bbuser_group ug
            
			               WHERE ug.user_id = '.$userinfo['user_id'].'
				           AND ug.group_id = g.group_id
				           AND ug.user_pending = 1
				           AND g.group_single_user = 0
			               ORDER BY g.group_name, ug.user_id'); 
    
	   if ($db->sql_numrows($result)) 
	   {

	      $evouserinfo_members .= '<div style="font-weight: bold">'.isset($lang_evo_userblock['BLOCK']['MEMBERS']['PENDING']).'</div>'; 
       
	      while( $row = $db->sql_fetchrow($result) ) 
		  {
            $in_group[] = $row['group_id'];

		    $group_name = GroupColor($row['group_name']);
		    $evouserinfo_members .= '<div style="padding-left: 10px;">';
			$evouserinfo_members .= '<font title="'.$row['group_id'].'" class="tooltip-html-side-interact tooltipstered" 
			color="lightgrey"><i title="'.$row['group_id'].'" alt="'.$row['group_id'].'" class="fas fa-users"></i></font> ';
		    $evouserinfo_members .= '<a class="tooltip-html-side-interact tooltipstered" title="'.$row['group_name'].'"href="modules.php?name=Groups&amp;g='.$row['group_id'] . '"><strong>' . $group_name . '</strong></a><br />';
			$evouserinfo_members .= '</div>';
          }
        
       }
	    
		$db->sql_freeresult($result);
   }
}

if(is_user()):
  evouserinfo_members();
else:
  $evouserinfo_members = '';
endif;

?>
