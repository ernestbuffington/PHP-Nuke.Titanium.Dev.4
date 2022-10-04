<?php

/*=======================================================================
  PHP-Nuke Titanium : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/
/************************************************************************
  PHP-Nuke Titanium : Advanced Installer
  ============================================
  Copyright (c) 2010 by The 86it Developers Network

  Filename           : functions.php
  Author             : TheGhost (www.86it.us)
  Design Layout      : The Mortal (RealmDesignz.com)
  Code Modifications : TheGhost, The Mortal
  Version            : 1.0.0
  Date               : 03.20.2021 (mm.dd.yyyy)

  Notes              : You may NOT use this installer for your own
                       needs or script. It is written specifically
                       for PHP-Nuke Titanium
************************************************************************/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

function serverinfo()
{
  echo '<div align="middle"><strong>Titanium admin SandBox</strong><br />';
  echo " "." PHP version is: ".phpversion()."<br />";
  ob_start();
  phpinfo(INFO_MODULES);
  $info = ob_get_contents();
  ob_end_clean();
  $info = stristr($info, 'Client API version');
  preg_match('/[1-9].[0-9].[1-9][0-9]/', $info, $match);
  $gd = $match[0];
  echo 'MariaDB MySQL:  '.$gd.' <br />';
  echo '</div>';

}

function case_menu($url, $title, $image) 
{
	global $counter, $admingraphic, $admin, $pnt_module_folder_name;
    
	if ( file_exists('modules/'.$pnt_module_folder_name.'/images/admin/'.$image) ):
		$image = 'modules/'.$pnt_module_folder_name.'/images/admin/'.$image;
	elseif ( file_exists('modules/'.$pnt_module_folder_name.'/images/'.$image) ):
		$image = 'modules/'.$pnt_module_folder_name.'/images/'.$image;
	else:
		$image = 'images/admin/'.$image;
	endif;

	if ( $admingraphic ):
		$image_file = '<img align="absmiddle" src="'.$image.'" border="0" alt="'.$title.'" title="'.$title.'" width="40" height="40" />';
	else:
		$image_file = '';
	endif;

	if (!is_god($admin) && ($title == 'Edit Admins' || $title == 'Nuke Sentinel(tm)'))
	{
		if ( defined('BOOTSTRAP') ):
		?>
			<a style="pointer-events: none" href="<?php echo $url ?>">
				<h3 style="font-size: 17px; margin: 0; text-decoration: line-through"><?php echo $title ?></h3>
			</a>
		<?php
		else:
			echo '<table style="height: 75px; text-align: center; width: 100%;" border="0" cellpadding="4" cellspacing="1" class="forumline">';           
			echo '<td style="width: 16.6%;">';
			echo '<a href="'.$url.'">';
			echo '<table style="text-align: center; width: 100%;" border="0" cellpadding="4" cellspacing="1" class="forumline">';           
			echo '<tr>';
			echo '<td class="row1">'.(($admingraphic) ? $image_file.'<br />' : '').'<em style="text-decoration: line-through; letter-spacing:1px;">'.$title.'</span></td>';
			echo '</tr>';
			echo '</table>';
			echo '</a>';
			echo '</td>';
			echo '</table>';
		endif;
	}
	else
	{
		if ( defined('BOOTSTRAP') ):
		?>
			<a href="<?php echo $url ?>">
				<h3 style="font-size: 17px; margin: 0;"><?php echo $title ?></h3>
			</a>
		<?php
		else:
			echo '<table style="width: 100%;">';           
			echo '<td align="left" style="width: 100%;">'; 
			echo '<a href="'.$url.'">';
			echo '<table style="width: 100%;">';           
			echo '<tr>';
			echo '<td class="row1"><strong>'.(($admingraphic) ? $image_file.' ' : '').$title.'</strong></td>';
			echo '</tr>';
			echo '</table>';
			echo '</a>';
			echo '</td>';
			echo '</table>';
		endif;
	}

	if ($counter == 5) 
	{
		if($phpbb2_end == FALSE)
		{
			//echo '</tr>'."\n".'<tr>'."\n";
		}
	}
	$counter = ($counter == 5) ? 0 : (int) $counter+1;
}


?>
