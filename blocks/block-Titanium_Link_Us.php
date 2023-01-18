<?php 
/*=======================================================================
 PHP-Nuke Titanium : Enhanced and Advanced Web Portal System
 ========================================================================
 (c) 2007 - 2008 by DarkForgeGFX - http://www.darkforgegfx.com
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
if(!defined('NUKE_EVO')) exit;

global $prefix, $db, $sitename, $nukeurl;

$config = dburow("SELECT * FROM ".$prefix."_link_us_config LIMIT 1");
	
function block_Link_Us_cache($block_cachetime) 
{
	global $prefix;
	
	$blockcache = [];
	
	if(!isset($blockcache[0]['stat_created']))
	$blockcache[0]['stat_created'] = '';
	
	if ((($blockcache = cache_load('titanium_link_us', 'blocks')) === false) 
	|| empty($blockcache) 
	|| intval($blockcache[0]['stat_created']) < (time() - intval($block_cachetime))) 
	{
		$sql = "SELECT `id`, 
		        `site_name`, 
				 `site_url`, 
			   `site_image`, 
			    `site_hits` FROM `".$prefix."_link_us` WHERE `site_status` = 1 ORDER BY `id` DESC";
		
		$result = dbquery($sql);
		$blockcache = dbrowset($result);
		dbfree($result);
		$blockcache[0]['stat_created'] = time();
		cache_set('titanium_link_us', 'blocks', $blockcache);
	}

	return $blockcache;
}

$blocksession = block_Link_Us_cache( get_evo_option('block_cachetime') );

$settings = 'width="88" height="31" border="0"';

if(!isset($site_hits))
$site_hits = 0;
	
	if($config['marquee_direction'] == 1){ $direction = "up"; }
elseif($config['marquee_direction'] == 2){ $direction = "down"; }
elseif($config['marquee_direction'] == 3){ $direction = "left"; }
elseif($config['marquee_direction'] == 4){ $direction = "right"; }

	if ($config['button_seperate'] == 1){ $seperation ="<span style='width=100px; size=5;'><br /></span>"; }
elseif ($config['button_seperate'] == 2){ $seperation ="<div align=\"center\">-------------------</div>"; }
elseif ($config['button_seperate'] == 0){ $seperation =""; }

	if($config['show_clicks'] == 1){ $clicks = "<br />( Visits ".$site_hits." )"; }
elseif($config['show_clicks'] == 0){ $clicks = ""; }

	if($config['block_height'] == 1){ $height = "100"; }
elseif($config['block_height'] == 2){ $height = "150"; }
elseif($config['block_height'] == 3){ $height = "200"; }
elseif($config['block_height'] == 4){ $height = "250"; }
elseif($config['block_height'] == 5){ $height = "300"; }

	if($config['marquee_scroll'] == 1){ $amount = 3; }
elseif($config['marquee_scroll'] == 2){ $amount = 2; }


$my_image = '<img src="'.$config['my_image'].'" alt="'.$sitename.'" title="'.$sitename.'" width="88" height="31">';
$linkus_settings = '<a href="'.$nukeurl.'" target="_blank"><img src="'.$config['my_image'].'" alt="'.$sitename.'" title="'.$sitename.'" width="88" height="31">lol</a><br>';

$content = '<div align="center" style="padding-top:6px;">';
$content = '</div>';

$content  = '<div style="padding-top: 6px" align="center">'.$my_image.'</div><br />';
$content .= '<div align="center">';
$content .= '<span class="content"><textarea style="resize: none; font-size: 13px" name="text" rows="3" cols="15">'.$linkus_settings.'</textarea></span>';
$content .= '<br /><br />';
$content .= '<a href="modules.php?name=Link_Us">View All Buttons</a><br />';

if($config['user_submit'] == 1)
$content .= '<div align=\"center\"><a href="modules.php?name=Link_Us&op=submitbutton">Submit Button</a></div><br /><br />'; 

$content .= '';

if($config['marquee'] == 1)
$content .= "<marquee direction='".$direction."' scrollamount='".$amount."' height='".$height."' onMouseover='this.stop()' onMouseout='this.start()'>";

foreach( $blocksession as $friends ):

	$content .= "<div align='center'><a href='modules.php?name=Link_Us&amp;op=visit&amp;id=".$friends['id']."' target='_blank'><img src='".$friends['site_image']."' ".$settings." title='".$friends['site_name']."' /></a>";

		if($config['show_clicks'] == 1){$clicks = "<br /><strong><font size=\"2\">".$friends['site_name']."</font></strong><br /><strong><font size=\"2\">( ".$friends['site_hits']." CLICKS )</font></strong>";}
	elseif($config['show_clicks'] == 0){$clicks = "";}

	$content .= "".$clicks."";
	$content .= "<br>".$seperation."</div>";

endforeach;

if($config['marquee'] == 1)
$content .= "</marquee>";
$content .= '</div>';


