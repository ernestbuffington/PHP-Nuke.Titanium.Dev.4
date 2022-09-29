<?php
/*=======================================================================
 PHP-Nuke Titanium: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/
if (!defined('NUKE_EVO'))
{
    die('ACCESS DENIED');
}

function OpenWaldoHeaderTable() {

 global $theme_name, $browser, $title;
  	
	?>
    <fieldset><legend><strong><b><?=$title?></b></strong></legend>
    <table class="waldo" width="100%" border="2">
    <tr>
    <td><div style="background : url(../../../modules/CHANGELOG/images/.png) no-repeat; background-size: 100%;">
	<?
}

function OpenChangeLogHeaderTable() {

 global $theme_name, $browser, $title;
  	
	?>	
    <fieldset><legend><strong><b><?=$title?></b></strong></legend>
    <table class="jason" width="100%" border="2">
    <tr>
    <td width="100%"><div style="background : url(../../../modules/CHANGELOG/images/Image58.png) repeat-y; background-size: 100%;">
	<?
}

function CloseChangeLogHeaderTable()
{

  global $name, $theme_name;
  
      ?>
     </div></td>
     </tr>
     </table> 		
	</fieldset>
    
    <br />
     <?   


}

function OpenChangeLogTable() {

 global $theme_name, $browser, $title;
  	
	?>	
    <fieldset><legend><strong><b><?=$title?></b></strong></legend>
    <table class="jimmy" width="100%" border="2">
    <tr>
    <td>
	<?
}

    
function CloseChangeLogTable() {

      ?>
     </td>
     </tr>
     </table> 		
	</fieldset>
    <br />
     <?   
	 
}

function dynamic_titles_update()
{
  $ch = curl_init();
  $data = curl_exec($ch);

  header("Content-Disposition: attachment; filename=file_I_am_downloading.csv"); 
  header("Content-Type: application/octet-stream"); 
  readfile(DEV."file_I_am_downloading.csv");
  file_put_contents('/modules/CHANGELOG', $data);

  if ($data === FALSE) 
  {
   die(curl_error($ch));
  }

// do this, instead of the header/readfile business.
file_put_contents('/some/path/on/your/webhost', $data);
}

function titanium_site_down() {
	$url = 'http://php-nuke-titanium.86it.us/versions/version_network.txt';
    $address = parse_url($url);
    $host = $address['host'];
    if (!($ip = @gethostbyname($host))) return false;
    if (@fsockopen($host, 80, $errno, $errdesc, 10) === false) return false;
    return true;
}

function titanium_get_version() {

    if(titanium_site_down()) {
      //  return NUKE_TITANIUM;
    }
    
	$contents = file_get_contents('http://php-nuke-titanium.86it.us/versions/version_network.txt');

    if(substr($contents,strlen($contents)-1) == "\n") {
        $contents = substr($contents,0,strlen($contents)-1);
    }

    return $contents;
}

function titanium_compare() {
    global $titanium_db, $titanium_prefix, $cache;

    $check = titanium_check_version();
    
	if($check == 0) 
	{
        $sql_ver = "UPDATE ".$titanium_prefix."_titanium SET titanium_value = '0' WHERE titanium_field='ver_previous'";
        $titanium_db->sql_query($sql_ver);
        $cache->delete('titaniumconfig');
        return "<strong><span style='color:green'>"._ADMIN_VER_CUR."</span></strong>";
    }
    
	$current = NUKE_EVO;
    
	$s = strpos($log_raw,$current);
    
	if(!$s) {
        return -1;
    }
    return $log_evo;
}

function ghost_changelog() 
{
   
    $data = @file('http://php-nuke-titanium.86it.us/versions/ghost_status.txt');
    
	$log_ghost = "<table class=\"\" width='100%'>";
    
	$names = array(
	            "-[" => "[",
                "ERN" => "Ernest Buffington",
				"ALPHA" => "Ernest Buffington"
            );
    
	for($i=0, $maxi=count($data);$i<$maxi;$i++) 
	{
        $line = $data[$i];
    
	    if(stristr($line, "-[")) 
		{
            
			
			$log_ghost .= "<tr><td style='text-indent: 15pt;'>";
			$log_ghost .= htmlspecialchars($line);
            $log_ghost .= "</td></tr>";
        } 
		else 
		{
            $line = trim($line);
            $line = isset($names[strtoupper($line)]) ? "<div class=\"\" color=\"#000000\"><strong>" . $names[strtoupper($line)] . "</strong></div>" : $line;
            $log_ghost .= "<tr><td>";
            $log_ghost .= $line;
            $log_ghost .= "</td></tr>";
        }
    }
    
	$log_ghost .= "</table>";
    
	$phrase  = $log_ghost;
	
	$original = array("pm to", 
				      "ON",
				   "CODING",
				 "SLEEPING",
				     "EABS",
					  "EAB",
					  "OFF",  
					  "AWAY",
					  "NEW",
					  "am ]", 
					  "Moved",
				      "Ported",
				      "Updated",
				      "Removed",
				      "Added",
					   "pm ]", 
					  "am to",
					  "Fixed");
    
	$new   = array("<font color=\"#CC0000\"><b>pm</b></font> to", 
			       "<font color=\"#CC0000\"><b>ON</b></font>", 
				   "<font color=\"#CC0000\"><b>CODING</b></font>",
				   "<font color=\"#CC0000\"><b>SLEEPING</b></font>",
				   "<center><font color=\"#3b5998\"><b>Ernest Buffington's</b></font>", 
				   "<center><font color=\"#3b5998\"><b>Ernest Buffington</b></font>", 
				   "<font color=\"#CC0000\"><b>OFF</b></font>", 
				   "<font color=\"#CC0000\"><b>AWAY</b></font>", 
				   
				   "<img src=\"images/sommaire/admin/new.gif\" border=\"0\" title=\"New!\">", 
			       "<font color=\"blue\"><b>am</b> </font>]", 
				   
				   "<font color=\"#ca5e06\"><b>Moved</b></font>", 
			       "<font color=\"#300e9e\"><b>Ported</b></font>", 
			       "<font color=\"green\"><b>Updated</b></font>", 
			       "<font color=\"#CC0000\"><u><b>Removed</b></u></font>", 
				   "<font color=\"blue\"><b>Added</b></font>",
					
					"<font color=\"#CC0000\"><b>pm</b> </font>]", 
					
					  "<font color=\"blue\"><b>am</b></font> to",
				   
				   "<font color=\"#C00000\"><b>Fixed</b></font>");

    $log_ghost = str_replace($original, $new, $phrase);
	
	return $log_ghost;
}

function titanium_changelog() 
{
	global $domain;
    $data = @file("http://".$domain."/versions/".$domain.".txt");
    
	$log_evo = "<table class=\"\" width='100%'>";
    
	$names = array(
	            "-[" => "[",
                "ERN" => "Ernest Buffington",
				"ALPHA" => "Ernest Buffington"
            );
    
	for($i=0, $maxi=count($data);$i<$maxi;$i++) 
	{
        $line = $data[$i];
    
	    if(stristr($line, "-[")) 
		{
            
			
			$log_evo .= "<tr><td style='text-indent: 15pt;'>";
			$log_evo .= htmlspecialchars($line);
            $log_evo .= "</td></tr>";
        } 
		else 
		{
            $line = trim($line);
            $line = isset($names[strtoupper($line)]) ? "<div class=\"\" color=\"#000000\"><strong>" . $names[strtoupper($line)] . "</strong></div>" : $line;
            $log_evo .= "<tr><td>";
            $log_evo .= $line;
            $log_evo .= "</td></tr>";
        }
    }
    
	$log_evo .= "</table>";
    
	$phrase  = $log_evo;
	
	$original = array("pm to", 
				      "NEW",
					  "am ]", 
					  "Moved",
				      "Ported",
				      "Updated",
				      "Removed",
				      "Added",
					   "pm ]", 
					  "am to",
					  "Fixed");
    
	$new   = array("<font color=\"#CC0000\"><b>pm</b></font> to", 
			       "<img src=\"images/sommaire/admin/new.gif\" border=\"0\" title=\"New!\">", 
			       "<font color=\"blue\"><b>am</b> </font>]", 
				   
				   "<font color=\"#ca5e06\"><b>Moved</b></font>", 
			       "<font color=\"#300e9e\"><b>Ported</b></font>", 
			       "<font color=\"green\"><b>Updated</b></font>", 
			       "<font color=\"#CC0000\"><u><b>Removed</b></u></font>", 
				   "<font color=\"blue\"><b>Added</b></font>",
					
					"<font color=\"#CC0000\"><b>pm</b> </font>]", 
					
					  "<font color=\"blue\"><b>am</b></font> to",
				   
				   "<font color=\"#C00000\"><b>Fixed</b></font>");

    $log_evo = str_replace($original, $new, $phrase);
	
	return $log_evo;
}

function titanium_get_download() {
    global $evo;

    if (titanium_site_down()) {
        return false;
    }

    
	$contents = @file_get_contents('http://php-nuke-titanium.86it.us/versions/download_network.txt');

    if(substr($contents,strlen($contents)-1) == "\n") {
        $contents = substr($contents,0,strlen($contents)-1);
    }

    return $contents;
}

function titanium_version() {
    global $titanium_db, $titanium_prefix, $admin_file, $title ;
    
	$title = "Live Change Log";
	OpenChangeLogHeaderTable();
    echo "<br /><center>";
    echo "<strong><span class=\"title\">PHP-Nuke Titanium - Live Change Log v3.0</span></strong><br /><br />";

    $ret_ver = titanium_get_version();
    
	if(!$ret_ver) 
	{
        echo "<strong><span style='color:red'>"._VER_ERR_CON."</span></strong>";
    } 
	else 
	{
        global $domain;
	    echo "<strong><span style='color:#3b5998'>Current Release :</span> PHP-Nuke Titanium ".$ret_ver." ".TITANIUM_EDITION."</strong><br /><strong><span style='color:#3b5998'>The Version On This Server is</span></strong> : <b>PHP-Nuke Titanium ".TITANIUM_VERSION."</b> <span style='color:#3b5998'><strong>and is using</strong></span> <span style='color:#CC0000'><b>Zend</span></b><span style='color:#3b5998'><strong> Caching</strong></span></center>";
echo "<center><strong><span style='color:#3b5998'>The Base Engine on <span style='color:#000000'>$domain</span> is Nuke-Evolution ".EVO_VERSION."</center></span><br />";
   CloseChangeLogHeaderTable();
	
		global $chnangelogstatus;
	    echo $chnangelogstatus;
		
		$log_ghost = ghost_changelog();
		
		$log_evo = titanium_changelog();
    
	    if($download = titanium_get_download()) 
		{
            $log_evo = "<strong><a href='".$download."'>Download v".$ret_ver."</a></strong><br /><br />". $log_evo;
            $log_evo .= "<br /><br /><strong><a href='".$download."'>Download v".$ret_ver."</a></strong>";
        }
        
		$title = "Where is the Network Administrator?";
	  	OpenWaldoHeaderTable();
		echo $log_ghost;
	    CloseChangeLogHeaderTable();
		$title = "What is the Network Administrator working on now?";
		OpenChangeLogTable();
		echo $log_evo;
		CloseChangeLogTable();
        echo "<center>";
    }
    //echo "<br /><br /><strong><a href='".$admin_file.".php'>"._TRACKER_BACK."</a></strong>";
    echo "</center>";
}
?>
