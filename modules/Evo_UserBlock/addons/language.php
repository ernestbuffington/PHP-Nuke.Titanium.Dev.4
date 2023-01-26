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

   Notes         : Evo User Block Language Module
************************************************************************/

if(!defined('NUKE_EVO')):
  die("Illegal File Access");
endif;

global $useflags, $currentlang, $admin_file, $multilingual, $evouserinfo_addons, $evouserinfo_language;

$evouserinfo_language = '';

if($multilingual): 

    $langlist = lang_list();
    if(!isset($lang_evo_userblock['BLOCK']['LANG']['SELECT']))
	$lang_evo_userblock['BLOCK']['LANG']['SELECT'] = '';
    $menulist = '';
    $evouserinfo_language = '<div align="center">'.$lang_evo_userblock['BLOCK']['LANG']['SELECT'].'<br /><br />';

    if($useflags): 
	
        for($i = 0, $maxi = count($langlist); $i < $maxi; $i++): 
            if($langlist[$i]!=''): 
                $imge = 'images/language/flag-'.$langlist[$i].'.png';
                $altlang = ucwords($langlist[$i]);
			    if(defined('ADMIN_FILE')): 
                    $evouserinfo_language .= '<a href="'.$qs.$langlist[$i].'">';
				elseif(!$name): 
                    $evouserinfo_language .= '<a href="index.php?newlang='.$langlist[$i]."\">";
				else: 
                    $evouserinfo_language .= '<a href="modules.php?name='.$qs.$langlist[$i].'">';
                endif;
                
				$evouserinfo_language .= (file_exists($imge)) ? "<img src=\"$imge\" align=\"middle\" border=\"0\" alt=\"$altlang\" title=\"$altlang\" hspace=\"3\" vspace=\"3\" />" : $altlang;
                $evouserinfo_language .= '</a> ';
            endif;
        endfor;
     
	else: 
	
        $evouserinfo_language .= '<form action="" method="get">
        <select name="newlanguage" onchange="top.location.href=this.options[this.selectedIndex].value">';
    
	    for($i=0, $maxi=count($langlist); $i < $maxi; $i++): 
            
			if(isset($langlist[$i]) && $langlist[$i] != ''): 
			
			   if(!isset($qs)) $qs = '';
			   
                if(defined('ADMIN_FILE')): 
                    $evouserinfo_language .= '<option value="'.$qs.$langlist[$i].'"';
				elseif(!$name): 
                    $evouserinfo_language .= '<option value="index.php?newlang='.$langlist[$i]."\"";
				else: 
                    $evouserinfo_language .= '<option value="modules.php?name='.$qs.$langlist[$i].'"';
                endif;
                
				if($langlist[$i]==$currentlang): 
				   $evouserinfo_language .= ' selected="selected"';
                endif;
				
				$evouserinfo_language .= '>'.ucwords($langlist[$i])."</option>\n";
            endif;
			
        endfor;
        $evouserinfo_language .= '</select></form>';
    
	endif;
    $evouserinfo_language .= '</div>';

endif;

?>
