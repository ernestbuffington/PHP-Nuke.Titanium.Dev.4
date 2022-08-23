<?php
if (!defined('ADMIN_FILE')) {
   die ('Access Denied');
}

global $db, $admin_file;

$module_name = basename(dirname(dirname(__FILE__)));

if(is_mod_admin($module_name)) {

switch ($op) 
{
        case 'a':
		$pagetitle = "::: "._BLOG_NEWSCONFIG;
        include(NUKE_BASE_DIR.'header.php');
		OpenTable();
        echo 'This is where my new admin panel will be!';
        CloseTable();
        include(NUKE_BASE_DIR.'footer.php');
        break;
case 'b':
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
} 
else 
{
  DisplayError('<strong>Some Bad Shit Just Happened</strong><br /><br />' . _NO_ADMIN_RIGHTS . $module_name);
}

?>