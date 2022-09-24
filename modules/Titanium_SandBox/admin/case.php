<?php
if (!defined('ADMIN_FILE')) {
   exit('THIS FILE WAS NOT CALLED WITHIN ADMINISTRATION');
}

$titanium_module_name = basename(dirname(dirname(__FILE__)));
get_lang($titanium_module_name);

$op = $_GETVAR->get('op', 'request', 'string');

switch($op) 
{
    case 'TitaniumSandboxMenu';
	include(NUKE_MODULES_DIR.$titanium_module_name.'/admin/index.php');
	break;
    case 'step1';
	include(NUKE_MODULES_DIR.$titanium_module_name.'/admin/index.php');
	break;
    case 'step2';
	include(NUKE_MODULES_DIR.$titanium_module_name.'/admin/index.php');
	break;
    case 'step3';
	include(NUKE_MODULES_DIR.$titanium_module_name.'/admin/index.php');
	break;
	case 'a':
    case 'b':
    case 'c':
    case 'd':
    case 'e':
    case 'f':
    case 'g':
    case 'h':
    case 'i':
    case 'k':
    case 'l':
    case 'm':
    case 'n':
    case 'o':
    case 'p':
    case 'q':
    case 'r':
    case 's':
    case 't':
    case 'u':
    case 'v':
    case 'w':
    case 'x':
    case 'y':
    case 'z':
        include(NUKE_MODULES_DIR.$titanium_module_name.'/admin/index.php');
    break;
}

?>