<?php
if (!defined('ADMIN_FILE')) {
   exit('THIS FILE WAS NOT CALLED WITHIN ADMINISTRATION');
}

global $admin_file;  

adminmenu($admin_file.'.php?op=TitaniumSandboxMenu','Titanium SandBox', 'content.png'); 
?>