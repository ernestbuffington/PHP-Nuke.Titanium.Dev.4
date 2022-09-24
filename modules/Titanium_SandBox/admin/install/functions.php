<?php

/*=======================================================================
 Nuke-Evolution Xtreme: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/
/************************************************************************
  Nuke-Evolution: Advanced Installer
  ============================================
  Copyright (c) 2010 by The Nuke-Evolution Team

  Filename           : functions.php
  Author             : Technocrat
  Design Layout      : The Mortal (RealmDesignz.com)
  Code Modifications : The Mortal
  Version            : 1.0.2
  Date               : 01.05.2019 (mm.dd.yyyy)

  Notes              : You may NOT use this installer for your own
                       needs or script. It is written specifically
                       for Nuke-Evolution and/or Xtreme
************************************************************************/

define('IN_PHPBB2', true);
global $data_file;

if (!$open_data = @fopen($data_file, 'r')){
    echo $install_lang['data_error'];
    exit;
}

$data = @fread($open_data, @filesize($data_file));
@fclose($open_data);
list($required_files, $chmods) = explode("\n###", $data);
$required_files = explode("\n", $required_files);
$chmods = explode("\n", $chmods);

if (!isset($directory_mode)){
	$directory_mode = 0755;
} else {
	$directory_mode = 0777;
}

if (!isset($file_mode)){
	$file_mode = 0666;
} else {
	$file_mode = 0644;
}

function permissions($file, $ord=false){
	$perms = fileperms($file);
	clearstatcache();
	// type
	if (($perms & 0xC000) == 0xC000) { $info = 's'; }     // Socket
	elseif (($perms & 0xA000) == 0xA000) { $info = 'l'; } // Symbolic Link
	elseif (($perms & 0x8000) == 0x8000) { $info = '-'; } // Regular
	elseif (($perms & 0x6000) == 0x6000) { $info = 'b'; } // Block special
	elseif (($perms & 0x4000) == 0x4000) { $info = 'd'; } // Directory
	elseif (($perms & 0x2000) == 0x2000) { $info = 'c'; } // Character special
	elseif (($perms & 0x1000) == 0x1000) { $info = 'p'; } // FIFO pipe
	else { $info = 'u'; } // Unknown
	// Owner
	$info .= ($perms & 0x0100) ? 'r' : '-';
	$info .= ($perms & 0x0080) ? 'w' : '-';
	$info .= ($perms & 0x0040) ? (($perms & 0x0800) ? 's' : 'x' ) : (($perms & 0x0800) ? 'S' : '-');
	// Group
	$info .= ($perms & 0x0020) ? 'r' : '-';
	$info .= ($perms & 0x0010) ? 'w' : '-';
	$info .= ($perms & 0x0008) ? (($perms & 0x0400) ? 's' : 'x' ) : (($perms & 0x0400) ? 'S' : '-');
	// World
	$info .= ($perms & 0x0004) ? 'r' : '-';
	$info .= ($perms & 0x0002) ? 'w' : '-';
	$info .= ($perms & 0x0001) ? (($perms & 0x0200) ? 't' : 'x' ) : (($perms & 0x0200) ? 'T' : '-');
	if ($ord) { return substr(sprintf('%o', $perms), -4); }
	return $info.' ('.substr(sprintf('%o', $perms), -4).')';
}

function message($message, $die=false){
    global $install_lang;

    if ($die){
        die('<table id="menu" border="1" width="100%"><tr><th id="test" align="center">'.$install_lang['die_message'].'</th></tr><tr><td align="center"><strong>'.$message.'</strong></td></tr></table><br />');
    } else {
        echo('<table id="menu" border="1" width="100%"><tr><th id="test" align="center">'.$install_lang['general_message'].'</th></tr><tr><td align="center"><strong>'.$message.'</strong></td></tr></table><br />');
    }
}

function generate_config(){
    global $directory_mode, $file_mode, $install_lang, $next_step;

    if (@is_file('config.php')){
        @unlink('config.php');
    }

    $filename = 'install/config_blank.php';
    if (!$handle = @fopen ($filename, 'r')){
        $message = $install_lang['cant_open'].' '.$filename;
        message($message);
    }
    $contents = @fread ($handle, filesize ($filename));
    @fclose ($handle);

    $contents = str_replace("%dbhost%", $_SESSION['dbhost'], $contents);
    $contents = str_replace("%dbname%", $_SESSION['dbname'], $contents);
    $contents = str_replace("%dbuname%", $_SESSION['dbuser'], $contents);
    $contents = str_replace("%dbpass%", $_SESSION['dbpass'], $contents);
    $contents = str_replace("%prefix%", $_SESSION['prefix'], $contents);
    $contents = str_replace("%user_prefix%", $_SESSION['user_prefix'], $contents);
    $contents = str_replace("%dbtype%", $_SESSION['dbtype'], $contents);

    $filename = 'config.php';

    if (!@touch($filename)){
        $DownloadData = true;
    }
    @chmod($filename, $directory_mode);
    if (@is_writable($filename)){
        if (!$handle = @fopen($filename, 'w')){
            $message = $install_lang['cant_open'].' '.$filename;
            return $message;
        }

        if (!@fwrite($handle, $contents)){
            $message = $install_lang['cantwrite'].' '.$filename;
            return $message;
        }
        @fclose($handle);
    } else {
		$_SESSION['configData'] = $contents;
        echo('<input type="hidden" name="download_file" value="1" /><table id="menu" border="0" width="100%"><tr><th id="test" align="center">'.$install_lang['general_message'].'</th></tr><tr><td align="center"><strong>'.$install_lang['config_failed'].'</strong></td></tr><tr><td align="center"><input type="submit" value="Download Config File" /><input type="hidden" name="step" value="'.$next_step.'" /><input type="submit" name="continue" value="'.$install_lang['continue'].' '.$next_step.'" /></td></tr></table>');
        return false;

    }
    return true;
}

function chmod_files(){
    global $directory_mode, $file_mode, $install_lang, $chmods;

    $message = '';

    foreach($chmods as $file){
		if (!(trim($file) == '')){
			$file = explode(" ", $file);
			$perm = $file[1];
			$perm = str_replace("[", "", str_replace("]", "", $perm));
			$file = $file[0];
			if (!empty($file) && !empty($perm)){
				if (!(substr($file,strlen($file)-1) == '/') && !@is_file($file)){
					$message .= '<strong>'.$file.'</strong> - <font color="red">'.$install_lang['is_missing'].'</font>';
					$failed = true;
					continue;
				}
				$perm = trim($perm);
				$permission = '0'.$perm;
				$current = substr(sprintf('%o', fileperms($file)), -4);
				if ($current != $permission){
					if (is_writable($file)){
						$message .= '('.$perm.') <strong>'.$file.'</strong> - <font color="green">'.$install_lang['success'].'</font><br />';
					} elseif (!@chmod($file, intval($permission,8))){
						$message .= '<strong>'.$file.'</strong> - <font color="red">'.$install_lang['failed'].'</font> CHMOD:('.$perm.')<br />';
						$failed = true;
					} else {
						$message .= '('.$perm.') <strong>'.$file.'</strong> - <font color="green">'.$install_lang['success'].'</font><br />';
					}
            	} else {
            		$message .= '('.$perm.') <strong>'.$file.'</strong> - <font color="green">'.$install_lang['success'].'</font><br />';
	    		}
			}
        }
    }
	if ($message){
		if ($failed){
			return $message.'<font color="red">'.$install_lang['chmod_failed'].'</font><br /><br />'.$install_lang['access_files'].'<br />';
		} else {
			return $message;
		}
	}
    return true;
}

function check_required_files(){
    global $install_lang, $required_files;

    foreach($required_files as $file){
        $file = @trim($file);
        #looping to make sure all required files are there..
        if (!is_file($file)){
            $message .= $install_lang['thefile'] . " \"" . $file . "\" " . $install_lang['is_missing'];
        }
    }
    #End the loop, check to see if any errors.
     if (isset($message)){
        message($message, true);
    }
    return;
}

function make_step_list(){
    global $step, $step_a, $install_lang;

    $show = '';
    foreach ($step_a as $step_num => $label):

	    if ($step_num < $step)
            $show .= '<div class="step_box strike">'.$label.'</div>';
        elseif ($step == $step_num)
            $show .= '<div class="step_box" style="font-weight: bold;">'.$label.'</div>';
        else
            $show .= '<div class="step_box">'.$label.'</div>';

	endforeach;
    return $show;
}

function validate_data($post){
    global $step, $next_step, $install_lang, $server_check;

	$error = '';
    $message = '';
    $titanium_dbhost = (isset($_POST['dbhost'])) ? $_POST['dbhost'] : $error .= '<font color="red">'.$install_lang['dbhost_error'].'</font><br />';
    $titanium_dbname = (isset($_POST['dbname'])) ? $_POST['dbname'] : $error .= '<font color="red">'.$install_lang['dbname_error'].'</font><br />';
    $titanium_dbuser = (isset($_POST['dbuser'])) ? $_POST['dbuser'] : $error .= '<font color="red">'.$install_lang['dbuser_error'].'</font>br />';
    $titanium_dbpass = (isset($_POST['dbpass'])) ? $_POST['dbpass'] : '';
    $titanium_prefix = (isset($_POST['prefix'])) ? $_POST['prefix'] : $error .= '<font color="red">'.$install_lang['prefix_error'].'</font><br />';
    $titanium_user_prefix = (isset($_POST['user_prefix'])) ? $_POST['user_prefix'] : $error .= '<font color="red">'.$install_lang['uprefix_error'].'</font><br />';
    $titanium_dbtype = (isset($_POST['dbtype'])) ? $_POST['dbtype'] : $error .= '<font color="red">'.$install_lang['dbtype_error'].'</font><br />';
    if (!empty($error)){
        $error .= '<center><input type="hidden" name="step" value="'.$next_step.'" /><input type="submit" class="button" name="submit" value="'.$install_lang['continue'].' '.$next_step.'" disabled="disabled" /></center>';
        return $error;
    }

    if (!($server_check = @mysqli_connect($titanium_dbhost, $titanium_dbuser, $titanium_dbpass, $titanium_dbname))){
        $error .= '<font color="red">'.$install_lang['connection_failed'].'</font><br />';
    }

    if ($error){
        $error .= '<input type="hidden" name="step" value="3" /><br /><input type="submit" class="button" name="submit" value="'.$install_lang['go_back'].'" /><br />';
        return $error;
    }

    $_SESSION['dbhost'] = $titanium_dbhost;
    $_SESSION['dbname'] = $titanium_dbname;
    $_SESSION['dbuser'] = $titanium_dbuser;
    $_SESSION['dbpass'] = $titanium_dbpass;
    $_SESSION['prefix'] = $titanium_prefix;
    $_SESSION['user_prefix'] = $titanium_user_prefix;
    $_SESSION['dbtype'] = $titanium_dbtype;

    if (generate_config()){
        $message .= '<font color="green">'.$install_lang['config_success'].'</font><br />';
        $message .= '<font color="green">'.$install_lang['data_success'].'</font><br />';
        $message .= '<input type="hidden" name="step" value="'.$next_step.'" /><br /><input type="submit" class="button" name="submit" value="'.$install_lang['continue'].' '.$next_step.'" />';
    } else {
        $message .= '<font color="red">'.$install_lang['config_failed'].'</font><br />';
    }
    return $message;
}

function do_sql($install_file){
    global $nuke_name, $next_step, $step, $install_lang, $titanium_prefix, $titanium_user_prefix, $server_check;

    if(!$handle = @fopen($install_file, 'r')){
        $message = $install_lang['cant_open'].' '.$install_file;
        return $message;
    }
    $contents = @fread($handle, filesize($install_file));
    @fclose($handle);
    $filename = $install_file;

    $filesize      = filesize($filename);
    $file_position = isset($_GET['pos']) ? $_GET['pos'] : 0;
    $errors        = isset($_GET['ignore_errors']) ? 0 : 1;

    if (!$fp = @fopen($filename,'rb')){
        echo $install_lang['cant_open'].' '.$filename;
    }

    $buffer = '';
    $inside_quote = 0;
    $quote_inside = '';
    $phpbb2_started_query = 0;
    $data_buffer = '';
    $last_char = "\n";

    @fseek($fp,$file_position);

    while ((!feof($fp) || strlen($buffer))){
        do
        {
            if (!strlen($buffer)){
                $buffer .= fread ($fp,1024);
            }

            $current_char = $buffer[0];
            $buffer = substr($buffer, 1);

            if ($phpbb2_started_query){
                $data_buffer .= $current_char;
            } elseif (preg_match('/[A-Za-z]/i',$current_char) && $last_char == "\n"){
                $phpbb2_started_query = 1;
                $data_buffer = $current_char;
            } else {
                $last_char = $current_char;
            }
        } while (!$phpbb2_started_query && (!feof($fp) || strlen($buffer)));

        if ($inside_quote && $current_char == $quote_inside && $last_char != '\\'){
            $inside_quote = 0;
        } elseif ($current_char == '\\' && $last_char == '\\'){
            $current_char = '';
        } elseif (!$inside_quote && ($current_char == '"' || $current_char == '`' || $current_char == '\'')){
            $inside_quote = 1;
            $quote_inside = $current_char;
        } elseif (!$inside_quote && $current_char == ';'){
            if ($titanium_user_prefix != "nuke" && !empty($titanium_user_prefix)){
                $data_buffer = str_replace("`nuke_users`", "`" . $titanium_user_prefix . "_users`", $data_buffer);
            }
            if($titanium_prefix != "nuke" && !empty($titanium_prefix)) {
                $data_buffer = str_replace("`nuke_", "`".$titanium_prefix."_", $data_buffer);
            }

            @mysqli_query($server_check, $data_buffer);

            if ($errors && mysqli_errno($server_check)){
                $message .= '<font color="red">' . $install_lang['sql_error'] . mysqli_errno($server_check).': '.mysqli_error($server_check).'<br />'.$data_buffer.'<br />';
            }
            $data_buffer = '';
            $last_char = "\n";
            $phpbb2_started_query = 0;
        }

        $last_char = $current_char;
    }
    $new_position = ftell($fp) - strlen($buffer) - strlen($data_buffer);

    @fclose($fp);

    if (empty($message)){
        $message = '<font color="green">'.(($step == 5) ? $install_lang['sql_install_success'] : $install_lang['sql2_install_success']).'</font><br /><br /><input type="hidden" name="step" value="'.$next_step.'" /><input type="submit" class="button" value="'.$install_lang['continue'].' '.$next_step.'" />';
    } else {
        $message .= '<input type="hidden" name="step" value="5" /><br /><input type="submit" class="button" name="submit" value="'.$install_lang['retry_sql'].'" />';
    }
    return $message;
}

function validate_admin(){
	global $install_lang, $next_step, $step, $server_check;

	$error = false;

	$message = '';

	if ($_POST['admin_pass'] != $_POST['admin_cpass']){
		$message .= '<font color="red">'.$install_lang['admin_fail'].'</font><br />';
		$message .= '<input type="hidden" name="step" value="6" /><br /><input type="submit" class="button" name="submit" value="'.$install_lang['go_back'].'" />';
		return $message;
	} else {
		if (strlen($_POST['admin_nick']) < 4 || strlen($_POST['admin_nick']) > 25 || preg_match('/[^a-zA-Z0-9_-]/', trim($_POST['admin_nick']))){
			$message .= '<font color="red">'.$install_lang['admin_nfail'].'</font><br />';
			$message .= '<input type="hidden" name="step" value="6" /><br /><input type="submit" class="button" name="submit" value="'.$install_lang['go_back'].'" />';
			return $message;
		}
		if (strlen($_POST['admin_email']) < 7 || !preg_match('/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/', $_POST['admin_email'])){
			$message .= '<font color="red">'.$install_lang['admin_efail'].'</font><br />';
			$message .= '<input type="hidden" name="step" value="6" /><br /><input type="submit" class="button" name="submit" value="'.$install_lang['go_back'].'" />';
			return $message;
		}

/*****[BEGIN]******************************************
 [ Mod:    Auto Admin Protection               v2.0.0 ]
 ******************************************************/
		if (!mysqli_query($server_check, "INSERT INTO `" . $_SESSION['prefix'] . "_nsnst_admins` (`aid`, `login`, `protected`) VALUES ('".$_POST['admin_nick']."', '".$_POST['admin_nick']."', '1')")){
			$error = true;
			$message .= '<font color="red">'.$install_lang['nsnst_fail'].'</font><br />';
		}
/*****[END]********************************************
 [ Mod:    Auto Admin Protection               v2.0.0 ]
 ******************************************************/
		$cookie_location = str_replace('/install.php', '', $_SERVER['PHP_SELF']);
		$titanium_user_nick = $_POST['admin_nick'];
		$titanium_user_pass = md5($_POST['admin_pass']);
/*****[BEGIN]******************************************
 [ Mod:    Auto Admin Login                    v2.0.0 ]
 ******************************************************/
		$cookiedata_admin = base64_encode("$titanium_user_nick:$titanium_user_pass:english:1:new");
		setcookie('admin',$cookiedata_admin,time()+2592000,$cookie_location);
/******************************************************
 [ Mod:    Auto Admin Login                    v2.0.0 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:    Auto First User Login               v1.0.0 ]
 ******************************************************/
        $cookiedata = base64_encode("2:$titanium_user_nick:$titanium_user_pass");
        setcookie('user',$cookiedata,time()+2592000,$cookie_location);
/*****[END]********************************************
 [ Mod:    Auto First User Login               v1.0.0 ]
 ******************************************************/
        $titanium_user_regdate = date('M d, Y');
        $titanium_user_avatar = 'blank.gif';
        $commentlimit = 4096;
        if ($_POST['admin_website'] == 'http://'){
			$url = '';
		} else {
			$url = $_POST['admin_website'];
		}

        if (!mysqli_query($server_check, "INSERT INTO `" . $_SESSION['prefix'] . "_authors` VALUES ('$titanium_user_nick', 'God', '".$url."', '".$_POST['admin_email']."', '$titanium_user_pass', '0', '1', '')")){
            $error = true;
            $message .= '<font color="red">'.$install_lang['god_fail'].'</font><br />';
        }

        if (!mysqli_query($server_check, "INSERT INTO " . $_SESSION['user_prefix'] . "_users (`user_id`, `username`, `user_email`, `user_website`, `user_avatar`, `user_regdate`, `user_password`, `theme`, `commentmax`, `user_level`, `user_lang`, `user_dateformat`, `user_color_gc`, `user_color_gi`, `user_posts`) VALUES (NULL,'$titanium_user_nick','".$_POST['admin_email']."','".$url."','".$titanium_user_avatar."','".$titanium_user_regdate."','$titanium_user_pass','XtremeV3','".$commentlimit."', '2', 'english','D M d, Y g:i a','d12727','--1--', '1')")){
			$error = true;
			$message .= '<font color="red">'.$install_lang['user_fail'].'</font><br />';
		}
		if ($error){
			return $message.'<input type="hidden" name="step" value="6" /><br /><input type="submit" class="button" name="submit" value="'.$install_lang['go_back'].'" />';
		} else {
			$_SESSION['admin_email'] = $_POST['admin_email'];
			return '<font color="green">'.$install_lang['admin_success'].'</font><br /><br /><input type="hidden" name="step" value="'.$next_step.'" /><input type="submit" name="confirm" class="button" value="'.$install_lang['continue'].' '.$next_step.'" />';
		}
	}
}

function site_form($display=1,$return=false){
    global $install_lang, $server_check;

    $form = '';
	$submit = (isset($_POST['submit'])) ? true : false;
    $sql = "SELECT * FROM " . $_SESSION['prefix'] . "_bbconfig";

    if (!$result = mysqli_query($server_check, $sql)){
        die($install_lang['get_config_error'].mysqli_error($server_check));
    }

    while($row = @mysqli_fetch_assoc($result)){
        $config_name = $row['config_name'];
        $config_value = $row['config_value'];
        $default_config[$config_name] = isset($_POST['submit']) ? str_replace("'", "\'", $config_value) : $config_value;
        $new[$config_name] = ( isset($_POST[$config_name]) ) ? $_POST[$config_name] : $default_config[$config_name];

        if ($submit){
            $sql = "UPDATE " . $_SESSION['prefix'] . "_bbconfig SET config_value = '" . str_replace("\'", "''", $new[$config_name]) . "' WHERE config_name = '$config_name'";
            if (!mysqli_query($server_check, $sql)){
                $error .= $install_lang['update_fail'].' '.$config_name.'<br />'.mysqli_error($server_check);
                return $error;
            }

            if ($config_name == "server_name"){
                $sql = "UPDATE " . $_SESSION['prefix'] . "_config SET nukeurl = 'http://" . str_replace("\'", "''", $new[$config_name]) . "'";
                if (!mysqli_query($server_check, $sql)){
                    $error .= $install_lang['update_fail'].' '.$config_name.'<br />'.mysqli_error($server_check);
                    return $error;
                }
            }
        }

        if ($config_name == 'cookie_name'){
            $cookie_name = str_replace('.', '_', $new['cookie_name']);
        }
    }

	if ($submit){
		$sql = "UPDATE " . $_SESSION['prefix'] . "_config SET sitename='".$_POST['nsitename']."', nukeurl='".$_POST['nukeurl']."', slogan='".$_POST['slogan']."', startdate='".$_POST['startdate']."', adminmail='".$_POST['adminmail']."'";
		if (!mysqli_query($server_check, $sql)){
			return $install_lang['update_fail'].' nuke config<br />'.mysqli_error($server_check);
		}
	}

	mysqli_free_result($result);

	$sql = "SELECT * FROM " . $_SESSION['prefix'] . "_config";

	if (!$result = mysqli_query($server_check, $sql)){
        die($install_lang['get_config_error'].mysqli_error($server_check));
    }

	$row = mysqli_fetch_assoc($result);
	$sitename = $row['sitename'];
	$nukeurl = $row['nukeurl'];
	$slogan = $row['slogan'];
	$startdate = $row['startdate'];
	$adminmail = $row['adminmail'];
	$get_cookie_name = _get_domain_cookie_name($_SERVER['SERVER_NAME']);
    $http_scheme = ( $_SERVER['REQUEST_SCHEME'] ) ? $_SERVER['REQUEST_SCHEME'] : 'http';

	mysqli_free_result($result);

    if (!$display){
		$form .= '  <dl>';
		$form .= '    <dt><label>'.$install_lang['site_name'].'</label></dt>';
		$form .= '    <dd>'.(($submit) ? (!empty($sitename) ? $sitename : 'My Site') : '<input type="text" name="nsitename" size="40" class="input" value="'.(($return) ? $sitename : 'My Site').'" />').'</dd>';
		$form .= '  </dl>';
		$form .= '  <dl>';
		$form .= '    <dt><label>'.$install_lang['site_url'].'</label></dt>';
		$form .= '    <dd>'.(($submit) ? (!empty($nukeurl) ? $nukeurl : $http_scheme.'://'.$_SERVER['HTTP_HOST'].str_replace('/install.php', '', $_SERVER['PHP_SELF'])) : '<input type="text" name="nukeurl" size="40" class="input" value="'.(($return) ? $nukeurl : $http_scheme.'://'.$_SERVER['HTTP_HOST'].str_replace('/install.php', '', $_SERVER['PHP_SELF'])).'" />').'</dd>';
		$form .= '  </dl>';
		$form .= '  <dl>';
		$form .= '    <dt><label>'.$install_lang['site_slogan'].'</label></dt>';
		$form .= '    <dd>'.(($submit) ? (!empty($slogan) ? $slogan : '&nbsp;') : '<input type="text" name="slogan" size="40" class="input" value="'.(($return) ? $slogan : '').'" />').'</dd>';
		$form .= '  </dl>';
		$form .= '  <dl>';
		$form .= '    <dt><label>'.$install_lang['start_date'].'</label></dt>';
		$form .= '    <dd>'.(($submit) ? (!empty($startdate) ? $startdate : date('F Y')) : '<input type="text" name="startdate" size="40" class="input" value="'.(($return) ? $startdate : date('F Y')).'" />').'</dd>';
		$form .= '  </dl>';
		$form .= '  <dl>';
		$form .= '    <dt><label>'.$install_lang['admin_email'].'</label></dt>';
		$form .= '    <dd>'.(($submit) ? (!empty($adminmail) ? $adminmail : $_SESSION['admin_email']) : '<input type="text" name="adminmail" size="40" class="input" value="'.(($return) ? $adminmail : $_SESSION['admin_email']).'" />').'</dd>';
		$form .= '  </dl>';
        $form .= '  <dl>';
		$form .= '    <dt><label>'.$install_lang['sitename'].'</label></dt>';
		$form .= '    <dd>'.(($submit) ? (!empty($new['sitename']) ? $new['sitename'] : $http_scheme.'://'.$_SERVER['SERVER_NAME']) : '<input type="text" name="sitename" size="40" class="input" value="'.(($return) ? $new['sitename'] : $http_scheme.'://'.$_SERVER['SERVER_NAME']).'" />').'</dd>';
		$form .= '  </dl>';
		$form .= '  <dl>';
		$form .= '    <dt><label>'.$install_lang['sitedescr'].'</label></dt>';
		$form .= '    <dd>'.(($submit) ? (!empty($new['site_desc']) ? $new['site_desc'] : '&nbsp;') : '<input type="text" value="'.(($return) ? $new['site_desc'] : '').'" name="site_desc" size="40" class="input" />').'</dd>';
		$form .= '  </dl>';
		$form .= '  <dl>';
		$form .= '    <dt><label>'.$install_lang['cookie_name'].'</label></dt>';
		$form .= '    <dd>'.(($submit) ? (!empty($new['cookie_name']) ? $new['cookie_name'] : '&nbsp;') : '<input type="text" value="'.(($return) ? $new['cookie_name'] : $get_cookie_name).'" name="cookie_name" size="40" class="input" />').'</dd>';
		$form .= '  </dl>';
		$form .= '  <dl>';
		$form .= '    <dt><label>'.$install_lang['cookie_path'].'</label></dt>';
		$path2cookie = str_replace('/install.php', '', $_SERVER['PHP_SELF']);
		$cookie_path = (!empty($path2cookie)) ? $path2cookie : '/';
		$form .= '    <dd>'.(($submit) ? (!empty($new['cookie_path']) ? $new['cookie_path'] : $cookie_path) : '<input type="text" value="'.(($return) ? $new['cookie_path'] : $cookie_path).'" name="cookie_path" size="40" class="input" />').'</dd>';
		$form .= '  </dl>';
		$form .= '  <dl>';
		$form .= '    <dt><label>'.$install_lang['cookie_domain'].'</label></dt>';
		$form .= '    <dd>'.(($submit) ? (!empty($new['cookie_domain']) ? $new['cookie_domain'] : $_SERVER['HTTP_HOST']) : '<input type="text" value="'.(($return) ? $new['cookie_domain'] : preg_replace('/^www\./', '', $_SERVER['HTTP_HOST'])).'" name="cookie_domain" size="40" class="input" />').'</dd>';
		$form .= '  </dl>';
		$form .= '  <dl>';
		$namechange_checked = ($new['allow_namechange']) ? 'checked="checked"' : '';
		$namechange_not_checked = (!$new['allow_namechange']) ? 'checked="checked"' : '';
		$form .= '    <dt><label>'.$install_lang['namechange'].'</label></dt>';
		$form .= '    <dd>'.(($submit) ? (($new['allow_namechange']) ? 'Yes' : 'No') : $install_lang['yes'].' <input type="radio" value="1" name="allow_namechange" '.$namechange_checked.' /> '. $install_lang['no'].' <input type="radio" value="0" name="allow_namechange" '.$namechange_not_checked.' />').'</dd>';
		$form .= '  </dl>';
		$form .= '  <dl>';
		$form .= '    <dt><label>'.$install_lang['email_sig'].'</label></dt>';
		$form .= '    <dd>'.(($submit) ? (!empty($new['board_email_sig']) ? $new['board_email_sig'] : '&nbsp;') : '<textarea name="board_email_sig" style="width: 100%; height: 100px;">'.$new['board_email_sig'].'</textarea>').'</dd>';
		$form .= '  </dl>';
		$form .= '  <dl>';
		$form .= '    <dt><label>'.$install_lang['site_email'].'</label></dt>';
		$form .= '    <dd>'.(($submit) ? (!empty($new['board_email']) ? $new['board_email'] : $_SESSION['admin_email']) : '<input type="text" name="board_email" value="'.(($return) ? $new['board_email'] : $_SESSION['admin_email']).'" size="40" class="input" />').'</dd>';
		$form .= '  </dl>';
		$form .= '  <dl>';
		$form .= '    <dt><label>'.$install_lang['default_lang'].'</label></dt>';
		$form .= '    <dd>'.(($submit) ? $new['default_lang'] : language_select('english', 'default_lang')).'</dd>';
		$form .= '  </dl>';
		$form .= '  <dl>';
		$form .= '    <dt><label>'.$install_lang['server_name'].'</label></dt>';
		$form .= '    <dd>'.(($submit) ? (!empty($new['server_name']) ? $new['server_name'] : $_SERVER['SERVER_NAME']) : '<input type="text" name="server_name" value="'.(($return) ? $new['server_name'] : rtrim($_SERVER['SERVER_NAME'].$cookie_path, '/')).'" size="40" class="input" />').'</dd>';
		$form .= '  </dl>';
		$form .= '  <dl>';
		$form .= '    <dt><label>'.$install_lang['server_port'].'</label></dt>';
		$form .= '    <dd>'.(($submit) ? $new['server_port'] : '<input type="text" name="server_port" value="'.$new['server_port'].'" size="40" class="input" />').'</dd>';
		$form .= '  </dl>';
        return $form;
    } else {
        return;
    }
}

function _get_domain_cookie_name($url) {
    $matches = 0;
    preg_match('/[\w-]+(?=(?:\.\w{2,6}){1,2}(?:\/|$))/', $url, $matches);
    return $matches[0];
}

?>