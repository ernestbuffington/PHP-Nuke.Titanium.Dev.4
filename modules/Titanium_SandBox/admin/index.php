<?php
if (!defined('ADMIN_FILE')) {
   die ("Illegal File Access");
}

global $pnt_prefix, $pnt_db, $admin_file, $admdata;
$pnt_module = basename(dirname(dirname(__FILE__)));

if (!is_mod_admin($pnt_module)) {
    echo "Access Denied";
    die();
}

define('PHP_NUKE_SANDBOX', dirname(dirname(__FILE__)) . '/');
define('PHP_NUKE_SANDBOX_ADDONS', PHP_NUKE_SANDBOX . '/addons/');
define('PHP_NUKE_SANDBOX_ADMIN', dirname(__FILE__) . '/');
define('PHP_NUKE_SANDBOX_ADMIN_INCLUDES', PHP_NUKE_SANDBOX_ADMIN . 'includes/');
define('PHP_NUKE_SANDBOX_ADMIN_LANG', PHP_NUKE_SANDBOX . 'admin/language/');
define('PHP_NUKE_SANDBOX_ADMIN_INSTALL', PHP_NUKE_SANDBOX . 'admin/install/');

include_once(PHP_NUKE_SANDBOX_ADMIN_LANG . 'lang-english.php');
global $data_file;
$data_file = PHP_NUKE_SANDBOX_ADMIN_INSTALL.'data.txt';
include_once(PHP_NUKE_SANDBOX_ADMIN_INSTALL . 'functions.php'); 
include_once(PHP_NUKE_SANDBOX_ADMIN_INCLUDES . 'functions.php');

include(NUKE_BASE_DIR.'header.php');

if(is_mod_admin($pnt_module)) 
{

  switch ($op) 
  {
        case 'TitaniumSandboxMenu':
		OpenTable();
		serverinfo();
		case_menu($admin_file.'.php?op=step1','PHP-Nuke Titanium Server Specifications', 'content.png');
		case_menu($admin_file.'.php?op=step2','PHP-Nuke Titanium CHMOD File/Folder Check', 'content.png');
        CloseTable();
		break;
  case 'step1':
  OpenTable();
  $nuke_name = "PHP-Nuke Titanium (Network Version)";
  $step = (isset($_REQUEST['step'])) ? $_REQUEST['step'] : 0;
  if (!$step) $step = '1';
  $total_phpbb2_steps = '2';
  $next_step = $step+1;
  $continue_button = '<input type="hidden" name="step" value="'.$next_step.'" /><input type="submit" class="button" name="submit" value="'.$install_lang['continue'].' '.$next_step.'" />';
  check_required_files();
  $safemodcheck = ini_get('safe_mod');

  if ($safemodcheck == 'On' || $safemodcheck == 'on' || $safemodcheck == true){
    include_once(PHP_NUKE_SANDBOX_ADMIN_INSTALL . 'header.php'); 
    echo '<table id="menu" border="1" width="100%">';
    echo '  <tr>';
    echo '    <th id="rowHeading" align="center">'.$nuke_name.' '.$install_lang['installer_heading'].' '.$install_lang['failed'].'</th>';
    echo '  </tr>';
    echo '  <tr>';
    echo '    <td align="center"><span style="color: #ff0000;"><strong>'.$install_lang['safe_mode'].'</strong></span></td>';
    echo '  </tr>';
    echo '</table>';
    include_once(PHP_NUKE_SANDBOX_ADMIN_INSTALL . 'footer.php'); 
    exit;
 }
	echo '<form action="" method="post">';
	$sub_step = (isset($_POST['sub_step'])) ? $_POST['sub_step'] : '';
	$root_path = dirname(__FILE__);
	if (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') {
		$root_path = str_replace('\\', '/', $root_path);
	}
	if (!function_exists('posix_getpwuid') || strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') {
		define('_FILE_OWNER', 'N/A');
		define('_PROCESS_UID', 0);
		define('_PROCESS_OWNER', 'N/A');
	} else {
		define('_FILE_OWNER', get_current_user());
		define('_PROCESS_UID', posix_geteuid());
		$processUser = posix_getpwuid(_PROCESS_UID);
		define('_PROCESS_OWNER', $processUser['name']);
		unset($processUser);
	}
	if (!$sub_step){
		echo '<form action="" method="post">';
		echo '<center><div style="color:#D29A2B;"><strong>'.$nuke_name.' '.$install_lang['installer_heading'].' '.$step.' '.$install_lang['installer_heading2'].' '.$total_phpbb2_steps.'</strong></div></center>';
		echo '<fieldset><legend>'.$install_lang['server_title'].'</legend>';
		echo '  <dl>';
		echo '    <dt><label>'.$install_lang['os'].'</label></dt>';
		echo '    <dd>'.PHP_OS.'</dd>';
		echo '  </dl>';
		echo '  <dl>';
		echo '    <dt><label>'.$install_lang['po'].'</label></dt>';
		echo '    <dd>'._PROCESS_OWNER.' ('._PROCESS_UID.')</dd>';
		echo '  </dl>';
		echo '  <dl>';
		echo '    <dt><label>'.$install_lang['fo'].'</label></dt>';
		echo '    <dd>'._FILE_OWNER.' ('.getmyuid().')</dd>';
		echo '  </dl>';
		echo '  <dl>';
		echo '    <dt><label>'.$install_lang['rp'].'</label></dt>';
		echo '    <dd>'.$root_path.'</dd>';
		echo '  </dl>';
		echo '  <dl>';
		echo '    <dt><label>'.$install_lang['rtp'].'</label></dt>';
		echo '    <dd>'.permissions($root_path).'</dd>';
		echo '  </dl>';
		echo '  <dl>';
		echo '    <dt><label>'.$install_lang['interface'].'</label></dt>';
		ob_start();
		echo php_sapi_name();
		$php_sapi_name = ob_get_clean();
		echo '    <dd>'.$php_sapi_name.'</dd>';
		echo '  </dl>';
		echo '  <dl>';
		echo '    <dt><label>'.$install_lang['openbasedir'].'</label></dt>';
		ob_start();
		echo ini_get('open_basedir');
		$basedir = ob_get_clean();
		echo '    <dd>'.(!empty($basedir) ? $basedir : '&nbsp;').'</dd>';
		echo '  </dl>';
		echo '  <dl>';
		echo '    <dt><label>'.$install_lang['safemode'].'</label></dt>';
		ob_start();
		echo ini_get('safe_mode');
		$safemode = ob_get_clean();
		echo '    <dd>'.(($safemode) ? 'enabled' : 'disabled').'</dd>';
		echo '  </dl>';
		echo '  <dl>';
		echo '    <dt><label>'.$install_lang['safemodegid'].'</label></dt>';
		ob_start();
		echo ini_get('safe_mode_gid');
		$safemodegid = ob_get_clean();
		echo '    <dd>'.(($safemodegid) ? 'enabled' : 'disabled').'</dd>';
		echo '  </dl>';
		echo '  <dl>';
		echo '    <dt><label>'.$install_lang['safemodeexecdir'].'</label></dt>';
		ob_start();
		echo ini_get('safe_mode_exec_dir');
		$safemodeexec = ob_get_clean();
		echo '    <dd>'.(!empty($safemodeexec) ? $safemodeexec : '&nbsp;').'</dd>';
		echo '  </dl>';
		echo '  <dl>';
		echo '    <dt><label>'.$install_lang['safemodeincludedir'].'</label></dt>';
		ob_start();
		echo ini_get('safe_mode_exec_dir');
		$safemodeinc = ob_get_clean();
		echo '    <dd>'.(!empty($safemodeinc) ? $safemodeinc : '&nbsp;').'</dd>';
		echo '  </dl>';
		echo '  <dl>';
		echo '    <dt><label>'.$install_lang['disablefunctions'].'</label></dt>';
		ob_start();
		echo ini_get('disable_functions');
		$disable_functions = ob_get_clean();
		echo '    <dd>'.(!empty($disable_functions) ? $disable_functions : '&nbsp;').'</dd>';
		echo '  </dl>';
		echo '</fieldset>';
		
		echo '<center><input type="hidden" name="step" value="2" /><input type="hidden" name="sub_step" value="1" /><br /><input type="submit" class="button" value="'.$install_lang['next_step'].'" /></center>';
		echo '</form>';
	} 
	elseif ($sub_step == 1){
		echo '<center><div style="color:#D29A2B;"><strong>'.$nuke_name.' '.$install_lang['installer_heading'].' '.$step.' '.$install_lang['installer_heading2'].' '.$total_phpbb2_steps.'</strong></div></center>';
		echo '<fieldset><legend>'.$install_lang['server_title'].'</legend>';
		require('install/file.inc');
		echo '</fieldset>';
		echo '</form>';
		?>
        <br /><div align="center" id="center_button">
        <button onclick="location.href='admin.php?op=TitaniumSandboxMenu'">Back to Titanium admin SandBox</button>
        </div>
        <br />		
        <?
	} 
  CloseTable();
  break;
  case 'step2';
    OpenTable();
	echo '<form action="" method="post">';
	echo '<fieldset><legend>'.$install_lang['chmod_check'].'</legend>';
	echo '<div style="text-align: left;">';
	echo chmod_files();
	echo '</div>';
	echo '</fieldset>';
	echo '<center>'.$continue_button.'</center>';
    echo '</form>';
	?>
    <br /><div align="center" id="center_button">
    <button onclick="location.href='admin.php?op=TitaniumSandboxMenu'">Back to Titanium admin SandBox</button>
    </div>
    <br />		
    <?
    CloseTable();
  break;
  case 'step3';
    OpenTable();
	echo 'TEST';
    CloseTable();
  break;
  case 'c':
  break;
  case 'd':
  break;
  case 'e':
  break;
  case 'f':
  break;
  case 'g':
  break;
  case 'h':
  break;
  case 'i':
  break;
  case 'j':
  break;
  case 'k':
  break;
  case 'l':
  break;
  case 'm':
  break;
  case 'n':
  break;
  case 'o':
  break;
  case 'p':
  break;
  case 'q':
  break;
  case 'r':
  break;
  case 's':
  break;
  case 't':
  break;
  case 'u':
  break;
  case 'v':
  break;
  case 'w':
  break;
  case 'x':
  break;
  case 'y':
  break;
  case 'z':
  break;
 }

 include(NUKE_BASE_DIR.'footer.php');

} 
else 
{
  DisplayError('<strong>Some Bad Shit Just Happened</strong><br /><br />' . _NO_ADMIN_RIGHTS . $pnt_module);
}

?>