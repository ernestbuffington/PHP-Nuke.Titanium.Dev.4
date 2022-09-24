<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************
   Nuke-Evolution: Admin / Error Tracker
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : log.php
   Author        : JeFFb68CAM (www.Evo-Mods.com)
   Version       : 1.0.2
   Date          : 11.28.2005 (mm.dd.yyyy)

   Notes         : Logs the following:
                        - Admin account creation
                        - Failed admin logins
                        - Intruder Alert
                        - MySQL Errors
                   Original admin tracker by Technocrat
************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
-=[Mod]=-
      Advanced Username Color                  v1.0.5       06/11/2005
 ************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

function log_write($file, $output, $title = 'General Error') {
    global $cookie, $identify;

    if(isset($cookie) && is_array($cookie)) {
        $titanium_username = $cookie[1];
    } else {
        if(isset($_COOKIE['user']) && !empty($_COOKIE['user'])) {
            $ucookie = explode(':', base64_decode($_COOKIE['user']));
        }
        if(isset($ucookie) && is_array($ucookie) && !empty($ucookie[1])) {
            $titanium_username = $ucookie[1];
        } else {
            $titanium_username = _ANONYMOUS;
        }
    }
    $ip = GetHostByName($identify->get_ip());
    $date = date("d M Y - H:i:s");
    if($file == 'admin') {
        $string = '';
    } elseif ($file == 'error') {
        $string = 'URL: <a href="http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] . '">' . $_SERVER['REQUEST_URI'] . "</a>\n";
    }
    $header  = "---------[" . $title . "]------------------------------------------------------------------------------------------------------------\n";
    $wdata = $header;
    $wdata .= "- [" . $date . "] - \n";
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
    $wdata .= "User: ".UsernameColor($titanium_username)."\n";
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
    $wdata .= 'IP: '.$ip."\n";
    $wdata .= $string;
    $wdata .= "\n";
    if(is_array($output)) {
        foreach($output as $line) {
             $wdata .= htmlspecialchars($line) . "\n";
        }
    } else {
        $wdata .= htmlspecialchars($output) . "\n";
    }
    $wdata .= str_repeat('-', strlen($header));
    $wdata .= "\n\n";
    if($handle = @fopen(NUKE_INCLUDE_DIR.'log/' . $file . '.log','a')) {
        fwrite($handle, $wdata);
        fclose($handle);
    }
    return;
}

function log_size($file) {
    global $titanium_db, $titanium_prefix;

    $filename = NUKE_INCLUDE_DIR.'log/' . $file . '.log';
    if(!is_file($filename)) {
        return -1;
    }
    if(!is_writable($filename)) {
        return -2;
    }
    if(filesize($filename) == 0) {
        return 0;
    }
    $handle = @fopen($filename,'r');
    if($handle) {
        $content = fread($handle, filesize($filename));
        @fclose($handle);
    } else {
        return -1;
    }
    $file_num = substr_count($content, "\n");
    $row_log = $titanium_db->sql_ufetchrow('SELECT ' . $file . '_log_lines FROM '.$titanium_prefix.'_config');
    if($row_log[0] != $file_num) {
        return 1;
    }
    return 0;
}

?>