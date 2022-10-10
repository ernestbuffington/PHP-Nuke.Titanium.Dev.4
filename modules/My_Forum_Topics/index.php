<?php
if (!defined('MODULE_FILE')) die('You can\'t access this file directly...');

$module_name = basename(dirname(__FILE__));

if ( isset($HTTP_GET_VARS['mode']) || isset($HTTP_POST_VARS['mode']) )
 $mode = ( isset($HTTP_POST_VARS['mode']) ) ? htmlspecialchars($HTTP_POST_VARS['mode']) : htmlspecialchars($HTTP_GET_VARS['mode']);
else
 $mode = '';

global $module_name;

if(!isset($module_name) || empty($module_name))
$module_name = basename(dirname(__FILE__));

get_lang($module_name);

global $db, $prefix, $userinfo;

$pagetitle = ''.$userinfo['username'].' Topics';

include(NUKE_BASE_DIR.'header.php');
      OpenTable();
    
    $sql = "SELECT COUNT(*) FROM ".$prefix."_bbtopics WHERE topic_poster='".$userinfo['user_id']."'";
    $result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);

    $ntopics = 1000;
	
    $my_topics = (isset($row[0])) ? number_format($row[0]) : '?';
    if($my_topics > 1)
	echo '<div class="nuketitle acenter">User '.$userinfo['username'].' has created '.$my_topics.' Forum Topics</div>';
	else
	echo '<div class="nuketitle acenter">User '.$userinfo['username'].' has created '.$my_topics.' Forum Topic</div>';
	  
      CloseTable();
include(NUKE_BASE_DIR.'footer.php');
?> 
