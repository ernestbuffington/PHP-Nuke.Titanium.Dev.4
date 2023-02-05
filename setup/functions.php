<?php
/*=======================================================================
 PHP-Nuke Titanium : Enhanced and Advanced PHP-Nuke Web Portal System
 =======================================================================*/
/************************************************************************
  PHP-Nuke Titanium / Nuke-Evolution: Advanced Installer
  ============================================
  Copyright (c) 2023 by The Titanium Group

  Filename           : functions.php
  Author             : Technocrat, The Mortal, Ernest Allen Buffington
  Design Layout      : The Mortal (RealmDesignz.com)
  Version            : 4.0.3
  Date               : 01.26.2023 (mm.dd.yyyy)

  Notes              : You may NOT use this installer for your own
                       needs or script. It is written specifically
                       for PHP-Nuke Titanium, Nuke-Evolution and/or Xtreme
					   
 * TernaryToElvisRector (http://php.net/manual/en/language.operators.comparison.php#language.operators.comparison.ternary https://stackoverflow.com/a/1993455/1348344)
 * LongArrayToShortArrayRector
 * AddDefaultValueForUndefinedVariableRector (https://github.com/vimeo/psalm/blob/29b70442b11e3e66113935a2ee22e165a70c74a4/docs/fixing_code.md#possiblyundefinedvariable)
 * TernaryToNullCoalescingRector
 * ListToArrayDestructRector (https://wiki.php.net/rfc/short_list_syntax https://www.php.net/manual/en/migration71.new-features.php#migration71.new-features.symmetric-array-destructuring)
 * SetCookieRector (https://www.php.net/setcookie https://wiki.php.net/rfc/same-site-cookie)
 * AddLiteralSeparatorToNumberRector (https://wiki.php.net/rfc/numeric_literal_separator)
 * NullToStrictStringFuncCallArgRector					   
************************************************************************/
require_once("setup_config.php");
define('IN_PHPBB', true);
$data_file = BASE_DIR.'data.txt';

if (!$open_data = fopen($data_file, 'r')){
    echo $install_lang['data_error'];
    exit;
}

$data = fread($open_data, filesize($data_file));

fclose($open_data);

[$required_files, $chmods] = explode("\n###", $data);

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
	require_once(__DIR__."/setup_config.php");
    require_once(__DIR__."/include/configdata.php");
	
    $config_php = $_SERVER['DOCUMENT_ROOT'];
    $config_php .= "/config.php";
		
	if (is_file($config_php)){
        unlink($config_php);
    }

    $filename = __DIR__.'/config_blank.php';
    if (!$handle = fopen ($filename, 'r')){
        $message = $install_lang['cant_open'].' '.$filename;
        message($message);
    }
    $contents = fread ($handle, filesize ($filename));
    fclose ($handle);

    $contents = str_replace("%dbhost%", $_SESSION['dbhost'], $contents);
    $contents = str_replace("%dbname%", $_SESSION['dbname'], $contents);
    $contents = str_replace("%dbuname%", $_SESSION['dbuser'], $contents);
    $contents = str_replace("%dbpass%", $_SESSION['dbpass'], $contents);
    $contents = str_replace("%prefix%", $_SESSION['prefix'], $contents);
    $contents = str_replace("%user_prefix%", $_SESSION['user_prefix'], $contents);
    $contents = str_replace("%dbtype%", $_SESSION['dbtype'], $contents);

    $filename = $config_php;

    if (!touch($filename)){
        $DownloadData = true;
    }
    chmod($filename, $directory_mode);
    if (is_writable($filename)){
        if (!$handle = fopen($filename, 'w')){
            $message = $install_lang['cant_open'].' '.$filename;
            return $message;
        }

        if (!fwrite($handle, $contents)){
            $message = $install_lang['cantwrite'].' '.$filename;
            return $message;
        }
        fclose($handle);
    } else {
		$_SESSION['configData'] = $contents;
        echo('<input type="hidden" name="download_file" value="1" /><table id="menu" border="0" width="100%"><tr><th id="test" align="center">'.$install_lang['general_message'].'</th></tr><tr><td align="center"><strong>'.$install_lang['config_failed'].'</strong></td></tr><tr><td align="center"><input type="submit" value="Download Config File" /><input type="hidden" name="step" value="'.$next_step.'" /><input type="submit" name="continue" value="'.$install_lang['continue'].' '.$next_step.'" /></td></tr></table>');
        return false;

    }
    return true;
}

function chmod_files(){
    $failed = null;
    global $directory_mode, $file_mode, $install_lang, $chmods;

    $message = '';

    foreach($chmods as $file){
		if (!(trim((string) $file) == '')){
			$file = explode(" ", (string) $file);
			$perm = $file[1];
			$perm = str_replace("[", "", str_replace("]", "", $perm));
			$file = $file[0];
			if (!empty($file) && !empty($perm)){
				if (!(substr($file,strlen($file)-1) == '/') && !is_file($file)){
					$message .= ''.$file.' - <span style="color: red;">'.$install_lang['is_missing'].'</span>';
					$failed = true;
					continue;
				}
				$perm = trim($perm);
				$permission = '0'.$perm;
				$current = substr(sprintf('%o', fileperms($file)), -4);
				if ($current != $permission){
					if (is_writable($file)){
						$message .= '<span style="font-size: 70%; color: white;">('.$perm.') '.$file.' - <span style="color: green;">'.$install_lang['success'].'</span></span><br />';
					} elseif (!chmod($file, intval($permission,8))){
						$message .= ''.$file.' - <span style="color: red;">'.$install_lang['failed'].'</span> CHMOD:('.$perm.')<br />';
						$failed = true;
					} else {
						$message .= '<span style="font-size: 70%; color: white;">('.$perm.') '.$file.' - <span style="color: green;">'.$install_lang['success'].'</span></span><br />';
					}
            	} else {
            		$message .= '<span style="font-size: 70%; color: white;">('.$perm.') '.$file.' - <span style="color: green;">'.$install_lang['success'].'</span></span><br />';
	    		}
			}
        }
    }
	if ($message){
		if ($failed){
			return $message.'<span style="color: red;">'.$install_lang['chmod_failed'].'</span><br /><br />'.$install_lang['access_files'].'<br />';
		} else {
			return $message;
		}
	}
    return true;
}

function check_required_files(){
    global $install_lang, $required_files;
    foreach($required_files as $file){
        $file = trim((string) $file);
        #looping to make sure all required files are there..
        if (!is_file($file)){
            if(!isset($message))
			$message = '';
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
   	global $step, $next_step, $install_lang, $server_check, $db_host, $db_user, $db_pass, $db_name, $db_prefix, $db_persistency;


	$error = '';
    $message = '';
    $dbhost = $_POST['dbhost'] ?? ($error .= '<font color="red">'.$install_lang['dbhost_error'].'</font><br />');
    $dbname = $_POST['dbname'] ?? ($error .= '<font color="red">'.$install_lang['dbname_error'].'</font><br />');
    $dbuser = $_POST['dbuser'] ?? ($error .= '<font color="red">'.$install_lang['dbuser_error'].'</font>br />');
    $dbpass = $_POST['dbpass'] ?? '';
    $prefix = $_POST['prefix'] ?? ($error .= '<font color="red">'.$install_lang['prefix_error'].'</font><br />');
    $user_prefix = $_POST['user_prefix'] ?? ($error .= '<font color="red">'.$install_lang['uprefix_error'].'</font><br />');
    $dbtype = $_POST['dbtype'] ?? ($error .= '<font color="red">'.$install_lang['dbtype_error'].'</font><br />');
    if (!empty($error)){
    $error .= '<div align="center"><input type="hidden" name="step" value="'.$next_step.'" /><input type="submit" class="button" name="submit" value="'.$install_lang['continue'].' '.$next_step.'" disabled="disabled" /></div>';
    return $error;
    }

    if (!($server_check = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname))){
        $error .= '<font color="red">'.$install_lang['connection_failed'].'</font><br />';
    }

    if ($error){
        $error .= '<input type="hidden" name="step" value="3" /><br /><input type="submit" class="button" name="submit" value="'.$install_lang['go_back'].'" /><br />';
        return $error;
    }

    $_SESSION['dbhost'] = $dbhost;
    $_SESSION['dbname'] = $dbname;
    $_SESSION['dbuser'] = $dbuser;
    $_SESSION['dbpass'] = $dbpass;
    $_SESSION['prefix'] = $prefix;
    $_SESSION['user_prefix'] = $user_prefix;
    $_SESSION['dbtype'] = $dbtype;

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

    $message = null;
    global $nuke_name, $next_step, $step, $install_lang, $prefix, $user_prefix, $server_check;

    if(!$handle = fopen($install_file, 'r')){
        $message = $install_lang['cant_open'].' '.$install_file;
        return $message;
    }
    $contents = fread($handle, filesize($install_file));
    fclose($handle);
    $filename = $install_file;

    $filesize      = filesize($filename);
    $file_position = $_GET['pos'] ?? 0;
    $errors        = isset($_GET['ignore_errors']) ? 0 : 1;

    if (!$fp = fopen($filename,'rb')){
        echo $install_lang['cant_open'].' '.$filename;
    }

    $buffer = '';
    $inside_quote = 0;
    $quote_inside = '';
    $started_query = 0;
    $data_buffer = '';
    $last_char = "\n";

    fseek($fp,$file_position);

    while ((!feof($fp) || strlen($buffer))){
        do
        {
            if (!strlen($buffer)){
                $buffer .= fread ($fp,1024);
            }

            $current_char = $buffer[0];
            $buffer = substr($buffer, 1);

            if ($started_query){
                $data_buffer .= $current_char;
            } elseif (preg_match('/[A-Za-z]/i',$current_char) && $last_char == "\n"){
                $started_query = 1;
                $data_buffer = $current_char;
            } else {
                $last_char = $current_char;
            }
        } 
		while (!$started_query && (!feof($fp) || strlen($buffer)));

        if ($inside_quote && $current_char == $quote_inside && $last_char != '\\'){
            $inside_quote = 0;
        } elseif ($current_char == '\\' && $last_char == '\\'){
            $current_char = '';
        } elseif (!$inside_quote && ($current_char == '"' || $current_char == '`' || $current_char == '\'')){
            $inside_quote = 1;
            $quote_inside = $current_char;
        } elseif (!$inside_quote && $current_char == ';'){
        
		    if ($user_prefix != "nuke" && !empty($user_prefix)){
                $data_buffer = str_replace("`nuke_users`", "`" . $user_prefix . "_users`", $data_buffer);
            }
        
		    if($prefix != "nuke" && !empty($prefix)) {
                $data_buffer = str_replace("`nuke_", "`".$prefix."_", $data_buffer);
            }

            mysqli_query($server_check, $data_buffer);

            if ($errors && mysqli_errno($server_check)){
                $message .= '<font color="red">' . $install_lang['sql_error'] . mysqli_errno($server_check).': '.mysqli_error($server_check).'<br />'.$data_buffer.'<br />';
            }
        
		    $data_buffer = '';
            $last_char = "\n";
            $started_query = 0;
        }

        $last_char = $current_char;
    }
    $new_position = ftell($fp) - strlen($buffer) - strlen($data_buffer);

    fclose($fp);

    if (empty($message)){
        $message = '<font color="green">'.(($step == 5) ? $install_lang['sql_install_success'] : $install_lang['sql2_install_success']).'</font><br /><br /><input type="hidden" name="step" value="'.$next_step.'" /><input type="submit" class="button" value="'.$install_lang['continue'].' '.$next_step.'" />';
    } else {
        $message .= '<input type="hidden" name="step" value="5" /><br /><input type="submit" class="button" name="submit" value="'.$install_lang['retry_sql'].'" />';
    }
    return $message;
}

function validate_admin(){
	global $cookiedata_admin, $cookiedata;
    
	global $db_type, $db_host, $db_user, $db_pass, $db_name, $db_prefix, $db_persistency, $use_rsa, $rsa_modulo, $rsa_public, $rsa_private, $uploads_dir;
    global $step, $next_step, $install_lang, $server_check;
    
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/config.php";
    include_once($path);
   
    $_SESSION['prefix'] = $prefix;
    $_SESSION['user_prefix'] = $user_prefix;
	$error = false;

	$message = '';

	if ($_POST['admin_pass'] != $_POST['admin_cpass']){
		$message .= '<font color="red">'.$install_lang['admin_fail'].'</font><br />';
		$message .= '<input type="hidden" name="step" value="6" /><br /><input type="submit" class="button" name="submit" value="'.$install_lang['go_back'].'" />';
		return $message;
	} 
	else 
	{
		if (strlen((string) $_POST['admin_nick']) < 4 || strlen((string) $_POST['admin_nick']) > 25 || preg_match('/[^a-zA-Z0-9_-]/', trim((string) $_POST['admin_nick']))){
			$message .= '<font color="red">'.$install_lang['admin_nfail'].'</font><br />';
			$message .= '<input type="hidden" name="step" value="6" /><br /><input type="submit" class="button" name="submit" value="'.$install_lang['go_back'].'" />';
			return $message;
		}
		
		if (strlen((string) $_POST['admin_email']) < 7 || !preg_match('/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/', (string) $_POST['admin_email'])){
			$message .= '<font color="red">'.$install_lang['admin_efail'].'</font><br />';
			$message .= '<input type="hidden" name="step" value="6" /><br /><input type="submit" class="button" name="submit" value="'.$install_lang['go_back'].'" />';
			return $message;
		}

		if (!mysqli_query($server_check, "REPLACE INTO `" . $_SESSION['prefix'] . "_nsnst_admins` (`aid`, `login`, `protected`) VALUES ('".$_POST['admin_nick']."', '".$_POST['admin_nick']."', '1')")){
			$error = true;
			$message .= '<font color="red">'.$install_lang['nsnst_fail'].'</font><br />';
		}

		$cookie_location = str_replace(BASE_DIR.'/index.php', '', (string) $_SERVER['PHP_SELF']);
		$user_nick = $_POST['admin_nick'];
		$user_pass = md5((string) $_POST['admin_pass']);

		$cookiedata_admin = base64_encode("$user_nick:$user_pass:english:1:new");
        $cookiedata = base64_encode("2:$user_nick:$user_pass");

        $user_regdate = date('M d, Y');
        $user_avatar = 'blank.png';
        $commentlimit = 4096;

        if ($_POST['admin_website'] == 'http://'){
			$url = '';
		} 
		else 
		{
			$url = $_POST['admin_website'];
		}

        if (!mysqli_query($server_check, "REPLACE INTO `" . $_SESSION['prefix'] . "_authors` VALUES ('$user_nick', 'God', '".$url."', '".$_POST['admin_email']."', '$user_pass', '0', '1', '')")){
            $error = true;
            $message .= '<font color="red">'.$install_lang['god_fail'].'</font><br />';
        }

        if (!mysqli_query($server_check, "REPLACE INTO " . $_SESSION['user_prefix'] . "_users (`user_id`, 
		                                                                                     `username`, 
																						   `user_email`, 
																						 `user_website`, 
																						  `user_avatar`, 
																						 `user_regdate`, 
																						`user_password`, 
																						        `theme`, 
																						   `commentmax`, 
																						   `user_level`, 
																						    `user_lang`, 
																					  `user_dateformat`, 
																					    `user_color_gc`, 
																						`user_color_gi`, 
																						   `user_posts`) 
																						   
		VALUES (2,
		'$user_nick',
		'".$_POST['admin_email']."',
		'".$url."','".$user_avatar."',
		'".$user_regdate."',
		'$user_pass',
		'Titanium_Core',
		'".$commentlimit."', 
		'2', 
		'english',
		'D M d, Y g:i a',
		'd12727',
		'--1--', 
		'1')")){
			$error = true;
			$message .= '<font color="red">'.$install_lang['user_fail'].'</font><br />';
		}
		
		if ($error){
			return $message.'<input type="hidden" name="step" value="6" /><br /><input type="submit" class="button" name="submit" value="'.$install_lang['go_back'].'" />';
		} else {
			$_SESSION['admin_email'] = $_POST['admin_email'];
			return '<font color="green">'.$install_lang['admin_success'].'</font><br /><br /><input type="hidden" name="step" value="'.$next_step.'" /><input 
			type="submit" name="confirm" class="button" value="'.$install_lang['continue'].' '.$next_step.'" />';
		}
	}
}

function site_form($display=1,$return=false){
    $default_config = [];
    $new = [];
    $error = false;
    
    global $db_type, $db_host, $db_user, $db_pass, $db_name, $db_prefix, $db_persistency, $use_rsa, $rsa_modulo, $rsa_public, $rsa_private, $uploads_dir;
    global $step, $next_step, $install_lang, $server_check;
	
	require_once(__DIR__."/setup_config.php");
    require_once(__DIR__."/include/configdata.php");

    $_SESSION['prefix'] = $db_prefix;
	
    $form = '';
	$submit = (isset($_POST['submit'])) ? true : false;
    $sql = "SELECT * FROM " . $_SESSION['prefix'] . "_bbconfig";

    if (!($server_check = mysqli_connect($db_host, $db_user, $db_pass, $db_name))){
        $error .= '<font color="red">'.$install_lang['connection_failed'].'</font><br />';
    }

    if ($error){
        $error .= '<input type="hidden" name="step" value="3" /><br /><input type="submit" class="button" name="submit" value="'.$install_lang['go_back'].'" /><br />';
        return $error;
    }

    if (!$result = mysqli_query($server_check, $sql)){
        die($install_lang['get_config_error'].mysqli_error($server_check));
    }

    while($row = mysqli_fetch_assoc($result)){
        $config_name = $row['config_name'];
        $config_value = $row['config_value'];
        $default_config[$config_name] = isset($_POST['submit']) ? str_replace("'", "\'", $config_value) : $config_value;
        $new[$config_name] = $_POST[$config_name] ?? $default_config[$config_name];

        if ($submit){
            $sql = "UPDATE " . $_SESSION['prefix'] . "_bbconfig SET config_value = '" . str_replace("\'", "''", (string) $new[$config_name]) . "' WHERE config_name = '$config_name'";
            if (!mysqli_query($server_check, $sql)){
                $error .= $install_lang['update_fail'].' '.$config_name.'<br />'.mysqli_error($server_check);
                return $error;
            }

            if ($config_name == "server_name"){
                $sql = "UPDATE " . $_SESSION['prefix'] . "_config SET nukeurl = 'http://" . str_replace("\'", "''", (string) $new[$config_name]) . "'";
                if (!mysqli_query($server_check, $sql)){
                    $error .= $install_lang['update_fail'].' '.$config_name.'<br />'.mysqli_error($server_check);
                    return $error;
                }
            }
        }

        if ($config_name == 'cookie_name'){
            $cookie_name = str_replace('.', '_', (string) $new['cookie_name']);
        }
    }

	if ($submit){
		if(!isset($_POST['nsitename']))
		$_POST['nsitename'] = '';
		if(!isset($_POST['slogan']))
		$_POST['slogan'] = '';
		if(!isset($_POST['nukeurl']))
		$_POST['nukeurl'] = '';
		if(!isset($_POST['startdate']))
		$_POST['startdate'] = '';
		if(!isset($_POST['adminmail']))
		$_POST['adminmail'] = '';
		if(!isset($_SESSION['admin_email']))
		$_SESSION['admin_email'] = '';
		
		$fuck_apostrophes = str_replace("'", "''", (string) $_POST['nsitename']);
		$fuck_apostrophes_again = str_replace("'", "''", (string) $_POST['slogan']);
		
		$sql = "UPDATE " . $_SESSION['prefix'] . "_config 
		
		SET sitename='".$fuck_apostrophes."', nukeurl='".$_POST['nukeurl']."', slogan='".$fuck_apostrophes_again."', startdate='".$_POST['startdate']."', adminmail='".$_POST['adminmail']."'";
		
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
    $http_scheme = $_SERVER['REQUEST_SCHEME'] ?: 'http';

	mysqli_free_result($result);
    
	if(empty($sitename))
	$sitename = 'A PHP-Nuke Titanium Web Portal';

	if(empty($nukeurl))
	$nukeurl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

	if(empty($startdate))
	$startdate = date('F Y');

	if(empty($slogan))
	$slogan = 'It takes a Village or a Savant!';

    $hostname = $_SERVER['HTTP_HOST'];
	$domain_name = preg_replace('/^www\./', '', $hostname);
	
	$new['server_name'] = $hostname;
	
	if(empty($adminmail))
	$adminmail = 'administrator@'.$domain_name;
	
	$new['board_email_sig'] = 'administrator@'.$domain_name;

	$new['board_email'] = 'administrator@'.$domain_name;
	
	$new['sitename'] = $nukeurl;
	
	$new['cookie_domain'] = $domain_name;
	
	if(empty($new['site_desc']))
	$new['site_desc'] = 'Forums, Blogs, Image Hosting, File Hosting';
	
    if (!$display){
		$form .= '<dl>';
		$form .= '<dt><label><span style="color: green;">'.$install_lang['site_name'].'</span></label></dt>';
		$form .= '<dd><span style="color: white;"><input type="text" name="nsitename" size="40" class="input" value="'.$sitename.'"></span></dd>';
		
		$form .= '</dl>';
		$form .= '<dl>';
		$form .= '<dt><label><span style="color: green;">'.$install_lang['site_url'].'</span></label></dt>';
		
		$form .= '<dd><span style="color: white;"><input type="text" name="nukeurl" size="40" class="input" value="'.$nukeurl.'"</span></dd>';
		
		$form .= '</dl>';
		$form .= '<dl>';
		$form .= '<dt><label><span style="color: green;">'.$install_lang['site_slogan'].'</span></label></dt>';
		$form .= '<dd><input type="text" name="slogan" size="40" class="input" value="'.$slogan.'"></dd>';
		$form .= '</dl>';
		$form .= '<dl>';
		$form .= '<dt><label><span style="color: green;">'.$install_lang['start_date'].'</span></label></dt>';
		$form .= '<dd><input type="text" name="startdate" size="40" class="input" value="'.$startdate.'"></dd>';
		$form .= '</dl>';
		$form .= '<dl>';
		$form .= '<dt><label><span style="color: green;">'.$install_lang['admin_email'].'</span></label></dt>';
		
		$form .= '<dd><input type="text" name="adminmail" size="40" class="input" value="'.$adminmail.'"></dd>';
		
		$form .= '</dl>';
        $form .= '<dl>';
		$form .= '<dt><label><span style="color: green;">'.$install_lang['sitename'].'</span></label></dt>';
		
		$form .= '<dd><input type="text" name="sitename" size="40" class="input" value="'.$new['sitename'].'"</dd>';
		
		$form .= '</dl>';
		$form .= '<dl>';
		$form .= '<dt><label><span style="color: green;">'.$install_lang['sitedescr'].'</span></label></dt>';
		$form .= '<dd><input type="text" value="'.$new['site_desc'].'" name="site_desc" size="40" class="input"></dd>';
		$form .= '</dl>';
		$form .= '<dl>';
		$form .= '<dt><label><span style="color: green;">'.$install_lang['cookie_name'].'</span></label></dt>';
		
		$form .= '<dd><input type="text" value="'.$get_cookie_name.'" name="cookie_name" size="40" class="input"></dd>';
		
		$form .= '</dl>';
		$form .= '<dl>';
		$form .= '<dt><label><span style="color: green;">'.$install_lang['cookie_path'].'</span></label></dt>';
		
		$form .= '<dd><input type="text" value="'.$new['cookie_path'].'" name="cookie_path" size="40" class="input"></dd>';
		
		$form .= '</dl>';
		$form .= '<dl>';
		$form .= '<dt><label><span style="color: green;">'.$install_lang['cookie_domain'].'</span></label></dt>';
		
		$form .= '<dd><input type="text" value="'.$new['cookie_domain'].'" name="cookie_domain" size="40" class="input"></dd>';
		
		$form .= '</dl>';
		$form .= '<dl>';

		$namechange_checked = ($new['allow_namechange']) ? 'checked="checked"' : '';
		$namechange_not_checked = (!$new['allow_namechange']) ? 'checked="checked"' : '';
		
		$form .= '<dt><label><span style="color: green;">'.$install_lang['namechange'].'</span></label></dt>';
		
		$form .= '<dd><span style="color: white;">'.(($submit) ? (($new['allow_namechange']) ? 'Yes' : 'No') : $install_lang['yes'].' <input type="radio" value="1" 
		name="allow_namechange" '.$namechange_checked.' /> '. $install_lang['no'].' <input type="radio" value="0" name="allow_namechange" '.$namechange_not_checked.' />').'</span></dd>';
		
		$form .= '</dl>';
		$form .= '<dl>';
		$form .= '<dt><label><span style="color: green;">'.$install_lang['email_sig'].'</span></label></dt>';
		$form .= '<dd><textarea name="board_email_sig" style="width: 100%; height: 100px;">'.$new['board_email_sig'].'</textarea></dd>';
		$form .= '</dl>';
		$form .= '<dl>';
		$form .= '<dt><label><span style="color: green;">'.$install_lang['site_email'].'</span></label></dt>';
		
		$form .= '<dd><input type="text" name="board_email" value="'.$new['board_email'].'" size="40" class="input"></dd>';
		
		$form .= '</dl>';
		$form .= '<dl>';
		$form .= '<dt><label><span style="color: green;">'.$install_lang['default_lang'].'</span></label></dt>';
		$form .= '<dd><span style="color: white;">'.(($submit) ? $new['default_lang'] : language_select('english', 'default_lang')).'</span></dd>';
		$form .= '</dl>';
		$form .= '<dl>';
		$form .= '<dt><label><span style="color: green;">'.$install_lang['server_name'].'</span></label></dt>';
		
		$form .= '<dd><input type="text" name="server_name" value="'.$new['server_name'].'" size="40" class="input"></dd>';
		
		$form .= '</dl>';
		$form .= '<dl>';
		$form .= '<dt><label><span style="color: green;">'.$install_lang['server_port'].'</span></label></dt>';
		$form .= '<dd><input type="text" name="server_port" value="'.$new['server_port'].'" size="40" class="input"></dd>';
		$form .= '</dl>';
        return $form;
    } else {
        return;
    }
}

function _get_domain_cookie_name($url) {
    $matches = [];
	if(!isset($matches[0]))
	$matches[0] = 'savant';
    preg_match('/[\w-]+(?=(?:\.\w{2,6}){1,2}(?:\/|$))/', (string) $url, $matches);
    return 'savant';
}

function is__writable($path, $file = '')
{
	if($path[strlen((string) $path)-1]=='/' AND $file == ''): 
	  return is__writable($path, uniqid(random_int(0, mt_getrandmax())).'.tmp');
	endif;
	//die($path);
	if(!is_dir($path)):
	  return false;
	else:
      $path = $path.$file;
	//die($path);
	  $fp = fopen($path,"w");
	  
	  if(!$fp):
		return false;
	  else:
		if(!fputs($fp,"Test Write")):
		  return false;
		endif;
	  endif;
		unlink($path); # Deleting the mess we just done
		fclose($fp);
	endif;
  
  return true;
}

function hex_esc($matches) {
  return sprintf("%02x", ord($matches[0]));
}
function RandomAlpha($num)
{
    $set  = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvxyz0123456789";
    $resp = "";

    for($i = 1; $i <= $num; $i++):
      $char  = random_int(0, strlen($set) - 1);
      $resp .= $set[$char];
    endfor;
  
  return $resp;
}

function getscrapedata($url, $display=false, $info = false) {
	$ret = null;
 if (preg_match("/thepiratebay.org/i", (string) $url))$url = 'udp://tracker.openbittorrent.com:80';
		if(preg_match('%udp://([^:/]*)(?::([0-9]*))?(?:/)?%si', (string) $url, $m))
			{
				$tracker = 'udp://' . $m[1];
				$port = $m[2] ?? 80;
				$page = "d5:filesd";
				$transaction_id = random_int(0,65535);
				$fp = fsockopen($tracker, $port, $errno, $errstr);
				stream_set_timeout($fp, 10);
				if(!$fp)
					{
						return false;
					}
						fclose($fp);
						return true;
				$current_connid = "\x00\x00\x04\x17\x27\x10\x19\x80";
				//Connection request
				$packet = $current_connid . pack("N", 0) . pack("N", $transaction_id);
				fwrite($fp,(string) $packet);
				//Connection response
				$ret = fread($fp, 100);
				if(strlen($ret) < 1 OR strlen($ret) < 16)
					{
						die($ret);
						return false;
					}
				$retd = unpack("Naction/Ntransid",$ret);
				if($retd['action'] != 0 || $retd['transid'] != $transaction_id)
					{
						return false;
					}
				$current_connid = substr($ret,8,8);
				//Scrape request
				$hashes = '';
				foreach($info as $hash)
					{
						$hashes .= pack('H*', $hash);
					}
				$packet = $current_connid . pack("N", 2) . pack("N", $transaction_id) . $hashes;
				fwrite($fp,(string) $packet);
				//Scrape response
				$readlength = 8 + (12 * (is_countable($info) ? count($info) : 0));
				$ret = fread($fp, $readlength);
				if(strlen($ret) < 1 OR strlen($ret) < 8)
					{
						return false;
					}
					else
					{
						return true;
					}
				$retd = unpack("Naction/Ntransid",$ret);
				// Todo check for error string if response = 3
				if($retd['action'] != 2 || $retd['transid'] != $transaction_id || strlen($ret) < $readlength)
					{
						return false;
					}
				$torrents = [];
				$index = 8;
				foreach($info as $k => $hash)
					{
						$retd = unpack("Nseeders/Ncompleted/Nleechers",substr($ret,$index,12));
						$retd['infohash'] = $k;
						$torrents[$hash] = $retd;
						$index = $index + 12;
					}
				foreach($torrents as $retb)$page .= "20:".str_pad((string) $retb['infohash'], 20)."d".
				"8:completei".$retb['seeders']."e".
				"10:downloadedi".$retb['completed']."e".
				"10:incompletei".$retb['leechers']."e".
				"e";
				$page .= "ee";
			}
			else
			{
				if (!$fp = fopen($url,"rb")) return false; //Warnings are shown
					stream_set_timeout($fp, 10);
				$page = "";
				while (!feof($fp)) $page .= fread($fp,10000);
				fclose($fp);
			}
				if(strlen($page) < 1 OR strlen($page) < 16)
					{
						return false;
					}


        return $page;
}

function check_chmod($file_check)
{

}
