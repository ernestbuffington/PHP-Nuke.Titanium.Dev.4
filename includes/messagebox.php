<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************
   Nuke-Evolution: Advanced Content Management System
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : messagebox.php
   Author        : Quake
   Version       : 1.0.0
   Date          : 06/10/2005 (dd-mm-yyyy)

   Notes         : Message Box
************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) 
exit('Access Denied');

include_once(NUKE_INCLUDE_DIR.'nbbcode.php');

global $bgcolor1, $bgcolor2, $textcolor2, $prefix, $multilingual, $currentlang, $db, $admin_file, $userinfo;

$query = ($multilingual) ? "AND (mlanguage='$currentlang' OR mlanguage='')" : '';

if (!is_admin()) 
{
	if (is_user()) 
    $query .= ' AND (view=1 OR view=3 OR view=6)';
	else 
    $query .= ' AND (view=1 OR view=2 OR view=6)';
} 
else 
    $query .= ' AND view<>2';

$result = $db->sql_query("SELECT `mid`, `title`, `content`, `date`, `expire`, `view`, `groups` FROM `".$prefix."_message` WHERE `active` = 1 ".$query." ORDER BY `date` DESC", true);

$query = '';

while (list($mid, $title, $content, $date, $expire, $view, $groups) = $db->sql_fetchrow($result)) 
{
	$content = decode_bb_all($content, 1, true);

	if (!empty($title) && !empty($content)) 
	{
		$output = '';
		
		switch($view) 
		{
			case 1:
				$output = _MVIEWALL;
			break;
			case 3:
				$output = _MVIEWUSERS;
			break;
			case 4:
				$output = _MVIEWADMIN;
			break;
			case 2:
				$output = _MVIEWANON;
			break;
			default:
			    if (is_admin()) 
				{
			        $output = _MVIEWGROUP;
			        break;
			    }
			    
				$groups = explode('-', $groups);
			    $ingroup = false;
			    
				foreach ($groups as $group) 
				{
    			     if (isset($userinfo['groups'][$group])) 
					 {
    			         $ingroup = true;
    			     }
			    }
			    if ($ingroup) $output = _MVIEWGROUP;
			break;
		}
		if ($output != '') 
		{
			$remain = '';
			if (is_admin()) 
			{
				if ($expire == 0) 
					$remain = _UNLIMITED;
				else 
				{
					$etime = (($date+$expire)-time())/3600;
					$etime = intval($etime);
					$remain = ($etime < 1) ? _EXPIRELESSHOUR : _EXPIREIN." $etime "._HOURS;
				}
			}
			$content = img_tag_to_resize($content);
			
			OpenTable();
			
			if ($title != '-' && $title != '=') 
			{
    			echo '<div class="option" align="center"><strong>'.$title.'</strong></div><br />
    				  <div class="content" >'.$content.'</div><div align="center">';
			} 
			else 
			    echo '<div class="content" >'.$content.'</div><div align="center">';
			
			if(is_admin())
			echo '[ '.$output.' - '.$remain.' - <a href="'.$admin_file.'.php?op=editmsg&amp;mid='.$mid.'">'._EDIT.'</a> ]';
			
			echo '</div>';
			CloseTable();
		}

		if ($expire != 0) 
		{
			if ($date+$expire < time()) 
			$db->sql_query("UPDATE ".$prefix."_message SET active='0' WHERE mid='$mid'");
		}
	}
}
$db->sql_freeresult($result);
?>
