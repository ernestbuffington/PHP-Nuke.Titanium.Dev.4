<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************
   Nuke-Evolution: Advanced Content Management System
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : case.version.php
   Author        : Technocrat (www.nuke-evolution.com)
   Version       : 1.0.0
   Date          : 06/16/2005 (dd-mm-yyyy)

   Notes         : Verifies if latest Nuke-Evolution Basic Release is
                   installed and a recent changelog.
************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
      Evolution Version Checker                v1.0.0       06/16/2005
      Caching System                           v1.0.0       10/31/2005
 ************************************************************************/

if (!defined('ADMIN_FILE')){
   die ("Illegal File Access");
}

define('CUR_EVO', strtolower(EVO_EDITION));

// Set the data to send to the server
// Trying to access the version tracker without using the
// $_POST method will return an "Access Denied" error
$postdata = 'v='.NUKE_EVO;

// Make a new connection to the version tracker
// We can either connect using cURL or fsockopen

$version_info = evo_get_version_curl($postdata);

/*****[BEGIN]******************************************
 [ Mod:    Evolution Version Checker           v1.1.0 ]
 ******************************************************/
function version_check()
{
	global $db, $prefix, $cache, $json, $evoconfig, $version_info, $admlang;
	
	if (is_array($version_info)):
	
		// Display a message based on the array
		if ($version_info['mTypeSmall'] == 'error')
			title('<h2>'.$version_info['mType'].'</h2><font color="red">'.$version_info['message'].'</font>');
		elseif ($version_info['mTypeSmall'] == 'success')
			title('<span style="color:green">'.$version_info['message'].'</span>');
		elseif ($version_info['mTypeSmall'] == 'out_of_date' && $version_info['dType'] == 'enabled')
			title('<h2>'.$version_info['mType'].'</h2><font color="red">'.$version_info['message'].'</font><br /><br /><a href="'.$version_info['download_link'].'" target="_blank">'.$version_info['download_link'].'</a>');
		
		
		// Get the last version check time
		$Version_Check = intval($evoconfig['ver_check']);
		
		if (!$Version_Check || ($Version_Check-time()) > 86400):
		
			$ret_ver = $version_info['current_version'];
			$db->sql_query("UPDATE ".$prefix."_evolution SET evo_value='".time()."' WHERE evo_field='ver_check'");
			$db->sql_query("UPDATE ".$prefix."_evolution SET evo_value='".$ret_ver."' WHERE evo_field='ver_previous'");
			$cache->delete('titanium_evoconfig');

		else:
			title($admlang['versions']['version_checked'].' '.date('Y-m-d', $Version_Check).' @'.date('H:i', $Version_Check));
		endif;

	else:
		echo $version_info;
	endif;
	
	unset($version_info);
}
/*****[END]********************************************
 [ Mod:    Evolution Version Checker           v1.1.0 ]
 ******************************************************/

function evo_check_version() {
	global $version_info;	
    $ver = $version_info['current_version'];
    return (NUKE_EVO == $ver) ? 0 : 1;
}

function evo_get_version_curl($postdata)
{
	global $json;	
	$ch = curl_init('https://versions.evolution-xtreme.co.uk/version.php');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
	$version_info = curl_exec($ch);
	curl_close($ch);
	
	if (!empty($version_info) && strtolower($version_info) != null){
		return $json->decode($version_info);
	} else {
		return $version_info;
	}
}

function evo_compare(){
    global $db, $prefix, $cache;

    $check = evo_check_version();
    if ($check == 0){
        $sql_ver = "UPDATE ".$prefix."_evolution SET evo_value = '0' WHERE evo_field='ver_previous'";
        $db->sql_query($sql_ver);
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
        $cache->delete('titanium_evoconfig');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
        return '<div class="col-12"><span style="color:green">'.$admlang['versions']['version_current'].'</span></div>';
    }
    $current = NUKE_EVO;
    $s = strpos($log_raw,$current);
    if (!$s){
        return -1;
    }
    return $log_evo;
}

function evo_changelog() {
    $data = @file('https://versions.evolution-xtreme.co.uk/changelog_'.CUR_EVO.'.txt');
    $log_evo = "";
    $names = array(
		"TECHNOCRAT" => "Technocrat",
		"JEFFB68CAM" => "JeFFb68CAM",
		"REVOLUTION" => "Revolution",
		"QUAKE" => "Quake",
		"KREAGON" => "Kreagon",
		"DANUK" => "DanUK",
		"LTABDIEL" => "Ltabdiel",
		"JELLE" => "Jelle",
		"RODMAR" => "Rodmar",
		"PLATINUMTHEMES" => "PlatinumThemes",
		"DIEDIEDIE" => "Diediedie",
		"TULISAN" => "Tulisan",
		"REORGANISATION" => "ReOrGaNiSaTiOn",
		"LONESTAR" => "Lonestar",
		"KILLIGAN" => "Killigan",
		"SGTLEGEND" => "SgtLegend",
		"TRAVO" => "Travo",
		"WOLFSTAR" => "Wolfstar",
		"VICTOMEYEZR" => "VicToMeyeZR",
		"CORPSE" => "coRpSE",
		"THEMORTAL" => "TheMortal"
	);
    for($i=0, $maxi=count($data); $i<$maxi; $i++):
    
        $line = $data[$i];
        if (stristr($line, " - [")):
            $log_evo .= '<div class="col-12" style="line-height:24px;">'.htmlspecialchars($line).'</div>';
        else:

            $line = trim($line);
            $line = isset($names[strtoupper($line)]) ? "<strong><u>" . $names[strtoupper($line)] . "</u></strong>" : $line;
            $log_evo .= '<div class="col-12" style="line-height:24px;">'.$line.'</div>';
        
        endif;
    
    endfor;
    return $log_evo;
}

function evo_get_download(){
    $contents = @file_get_contents('https://versions.evolution-xtreme.co.uk/download_'.CUR_EVO.'.txt');

    if (substr($contents,strlen($contents)-1) == "\r\n"){
        $contents = substr($contents,0,strlen($contents)-1);
    }

    return $contents;
}

function evo_version()
{
    global $db, $prefix, $admin_file, $version_info, $admlang;

    title($admlang['versions']['title']);
    version_check();
    OpenTable();
    echo '<div class="col-12">';	

    $ret_ver = $version_info['current_version'];
	
	if (!$ret_ver):

		echo '<div class="col-12 center"><span class="text-bold" style="color:red">'.$admlang['versions']['curl_connection_error'].'</span></div>';

	else:

		echo '<div class="col-12 center">';
		echo "<strong>".$admlang['versions']['version']."</strong> ".$ret_ver." ".EVO_EDITION."<br /><strong>".$admlang['versions']['your_version']."</strong> ".EVO_VERSION."<br />";
        
		if ($download = evo_get_download())
			$log_evo  = '<a href="'.$download.'" target="_blank">Download v'.$ret_ver.'</a></strong><br /><br />';       
        
		echo $log_evo;
		echo '</div>';
		echo evo_changelog();
        

    endif;
    echo '<br /><div class="col-12 center"><a href="'.$admin_file.'.php"><span class="text-bold">'.$admlang['global']['back'].'</span></a></div>';
    echo "</div>";
    CloseTable();
}

if (is_admin()):

    include_once(NUKE_BASE_DIR.'header.php');
	
    switch($op):

        case 'version': 
        	evo_version(); 
        	break;

    endswitch;

    include_once(NUKE_BASE_DIR.'footer.php');

else:
    echo 'Access Denied';
endif;

?>