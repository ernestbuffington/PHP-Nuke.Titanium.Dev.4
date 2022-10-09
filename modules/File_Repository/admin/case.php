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

$module_name = basename(dirname(dirname(__FILE__)));
//-------------------------------------------------------------------------
//  INCLUDE THE LANGUAGE FILE FOR THE MODULE.
//-------------------------------------------------------------------------
include_once(NUKE_MODULES_DIR.$module_name.'/language/lang-english.php');
//-------------------------------------------------------------------------
//  INCLUDE THE LANGUAGE FILE FOR THE MODULE.
//-------------------------------------------------------------------------
switch($op) 
{
    case 'file_repository':
    	include(NUKE_MODULES_DIR.$module_name.'/admin/index.php');
    	break;

}

?>