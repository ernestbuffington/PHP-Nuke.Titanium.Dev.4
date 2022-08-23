<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/*********************************************************************
 Name:        Custom_Functions
 Version:    v1.0.0
 Date:        08/10/2005
 Does:        A common area to put custom functions for YA
 *********************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
-=[Mod]=-
      Password Strength Meter                  v1.0.0       07/12/2005
      XData                                    v0.1.1       08/09/2005
      Initial Usergroup                        v1.0.1       09/07/2005
      Group Colors                             v1.0.0       09/07/2005
      Group Ranks                              v1.0.0       09/07/2005
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}

if (!defined('CNBYA')) {
    die('CNBYA protection');
}

include_once(NUKE_INCLUDE_DIR.'constants.php');
include_once(NUKE_INCLUDE_DIR.'functions.php');

/*****[BEGIN]******************************************
 [ Mod:     Initial Usergroup                  v1.0.1 ]
 [ Mod:     Group Colors                       v1.0.0 ]
 [ Mod:     Group Ranks                        v1.0.0 ]
 ******************************************************/
function init_group($uid) {
    global $prefix, $db, $board_config, $cache;
    if($board_config['initial_group_id'] != "0" && $board_config['initial_group_id'] != NULL) {
        $initialusergroup = intval($board_config['initial_group_id']);
        if($initialusergroup == 0) {
            return;
        }

        $db->sql_query("INSERT INTO ".$prefix."_bbuser_group (group_id, user_id, user_pending) VALUES ('$initialusergroup', $uid, '0')");
        add_group_attributes($uid, $initialusergroup);
    }
}
/*****[END]********************************************
 [ Mod:     Initial Usergroup                  v1.0.1 ]
 [ Mod:     Group Colors                       v1.0.0 ]
 [ Mod:     Group Ranks                        v1.0.0 ]
 ******************************************************/

 ?>