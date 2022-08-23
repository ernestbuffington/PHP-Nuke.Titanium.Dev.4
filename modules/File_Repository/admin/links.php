<?php

/*
|-----------------------------------------------------------------------
|	COPYRIGHT (c) 2016 by lonestar-modules.com
|	AUTHOR 				:	Lonestar	
|	COPYRIGHTS 			:	lonestar-modules.com
|	PROJECT 			:	File Repository
|	VERSION 			:	1.0.0
|----------------------------------------------------------------------
*/

if (!defined('ADMIN_FILE')) 
   exit('THIS FILE WAS NOT CALLED WITHIN ADMINISTRATION');

global $admin_file, $module_title;
adminmenu($admin_file.'.php?op=file_repository', 'File Repository', 'file_repository.png');

?>