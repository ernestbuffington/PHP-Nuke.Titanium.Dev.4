<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                              admin_board.php
 *                            -------------------
 *   begin                : Thursday, Jul 12, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: admin_board.php,v 1.51.2.9 2004/11/18 17:49:33 acydburn Exp
 *
 ***************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Drop-A-Mod                               v1.0.0       10/27/2005
-=[Mod]=-
      PM Quick Reply                           v1.3.5       06/14/2005
      Force Word Wrapping - Configurator       v1.0.16      06/15/2005
      Advance Signature Divider Control        v1.0.0       06/16/2005
      Default avatar                           v1.1.0       06/30/2005
      Disable Board Message                    v1.0.0       07/06/2005
      PM threshold                             v1.0.0       07/19/2005
      Welcome PM                               v2.0.0       07/22/2005
      Limit smilies per post                   v1.0.2       07/24/2005
      Advanced Time Management                 v2.2.0       07/26/2005
      At a Glance Options                      v1.0.0       08/17/2005
      Online/Offline/Hidden                    v2.2.6       08/21/2005
      Quick Search                             v3.0.1       08/23/2005
      Show Users Today Toggle                  v1.0.0       08/24/2005
      Customized Topic Status                  v1.0.0       08/25/2005
      Report Posts                             v1.2.3       08/30/2005
      Hide Images and Links                    v1.0.0       08/30/2005
      DHTML Admin Menu                         v1.0.1       08/31/2005
      Super Quick Reply                        v1.3.2       09/08/2005
      Smilies in Topic Titles Toggle           v1.0.0       09/10/2005
      Log Actions Mod - Topic View             v2.0.0       09/18/2005
      Resize Posted Images                     v2.4.5       09/29/2005
      Forum Admin Style Selection              v1.0.0       10/01/2005
	  Birthdays                                v3.0.0
-=[Other]=-
      URL Check                                v1.0.0       07/01/2005
      Cookie Check                             v1.0.0       08/04/2005
 ************************************************************************/

if (!defined('IN_PHPBB')) define('IN_PHPBB', true);

if( !empty($setmodules) )
{
    $file = basename(__FILE__);
        $module['General']['Configuration'] = "$file";
    return;
}

//
// Let's set the root dir for phpBB
//
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
include("../../../includes/functions_selects.php");
/*****[BEGIN]******************************************
 [ Mod:    Advanced Time Management            v2.2.0 ]
 ******************************************************/
if ( !file_exists(phpbb_realpath($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_adv_time.' . $phpEx)) )
{
    include_once($phpbb_root_path . 'language/lang_english/lang_adv_time.' . $phpEx);
} else
{
    include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_adv_time.' . $phpEx);
}
/*****[END]********************************************
 [ Mod:    Advanced Time Management            v2.2.0 ]
 ******************************************************/
//
// Pull all config data
//
$sql = "SELECT *
    FROM " . CONFIG_TABLE;
if(!$result = $db->sql_query($sql))
{
    message_die(CRITICAL_ERROR, "Could not query config information in admin_board", "", __LINE__, __FILE__, $sql);
}
else
{
/*****[BEGIN]******************************************
 [ Other:  URL Check                           v1.0.0 ]
 ******************************************************/
    if( isset($HTTP_POST_VARS['submit']) ) {
        ValidateURL($HTTP_POST_VARS["server_name"], 1, "Domain Name");
        if(empty($HTTP_POST_VARS["confirm"])) {
            $server_url = $_SERVER["HTTP_HOST"];

            $pos = strpos($_SERVER["PHP_SELF"],"modules");
            $PHP_SELF = substr($_SERVER["PHP_SELF"],0,$pos);
            $pos = strrpos($PHP_SELF,"/");
                if(!empty($pos)) {
                  $server_url .= substr($_SERVER["PHP_SELF"],0,$pos);
                }
                if($HTTP_POST_VARS["server_name"] != $server_url) {
                    echo "<form action='".append_sid("admin_board.$phpEx")."' method='post'>";
                    foreach ($HTTP_POST_VARS as $key => $value) {
                        echo "<input type='hidden' name='".$key."' value='".$value."'>";
                    }
                    echo "<input type='hidden' name='confirm' value='1'>";
                    echo "<br /><br />";
                    echo "<table width=\"100%\" cellpadding=\"4\" cellspacing=\"1\" border=\"0\" class=\"forumline\">";
                    echo "<tr>";
                    echo "<th class=\"thHead\" align=\"center\">".$lang['General_Error']."</th>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td class=\"row1\" width=\"100%\" align=\"center\"><span class=\"gen\">". sprintf($lang['URL_server_error'],$HTTP_POST_VARS["server_name"],$server_url) ."</span></td>";
                    echo "</tr><tr>";
                    echo "<td class=\"row1\" width=\"100%\" align=\"center\"><span class=\"gen\">".$lang['URL_error_confirm']."<br /><br /><input type='submit' value='Yes'></form>";
                    echo "<form action='javascript:history.back()' method='post'><input type='submit' value='No'></form></span></td>";
                    echo "</tr>";
                    echo "</table>";
                    echo "";
                    exit;
                }
        } else {
            array_pop($HTTP_POST_VARS);
        }
    }
/*****[END]********************************************
 [ Other:  URL Check                           v1.0.0 ]
 ******************************************************/
    while( $row = $db->sql_fetchrow($result) )
    {
        $config_name = $row['config_name'];
        $config_value = $row['config_value'];
        $default_config[$config_name] = isset($HTTP_POST_VARS['submit']) ? str_replace("'", "\'", $config_value) : $config_value;

        $new[$config_name] = ( isset($HTTP_POST_VARS[$config_name]) ) ? $HTTP_POST_VARS[$config_name] : $default_config[$config_name];

/*****[BEGIN]******************************************
 [ Mod:  Birthdays                             v3.0.0 ]
 ******************************************************/
		if ( $config_name == 'bday_greeting' && isset($HTTP_POST_VARS['submit']) )
		{
			$bday_email_mask = isset($HTTP_POST_VARS['bday_email_mask']) ? 1<<($HTTP_POST_VARS['bday_email_mask']-1) : 0;
			$bday_pm_mask = isset($HTTP_POST_VARS['bday_pm_mask']) ? 1<<($HTTP_POST_VARS['bday_pm_mask']-1) : 0;
			$bday_popup_mask = isset($HTTP_POST_VARS['bday_popup_mask']) ? 1<<($HTTP_POST_VARS['bday_popup_mask']-1) : 0;
			$new['bday_greeting'] = $bday_email_mask | $bday_pm_mask | $bday_popup_mask;
		}
/*****[END]********************************************
 [ Mod:  Birthdays                             v3.0.0 ]
 ******************************************************/

        if ($config_name == 'cookie_name')
        {
            $cookie_name = str_replace('.', '_', $new['cookie_name']);
        }
 		// Attempt to prevent a common mistake with this value,
 		// http:// is the protocol and not part of the server name
 		if ($config_name == 'server_name')
 		{
 			$new['server_name'] = str_replace('http://', '', $new['server_name']);
  		}
		// Attempt to prevent a mistake with this value.
		if ($config_name == 'avatar_path')
		{
			$new['avatar_path'] = trim($new['avatar_path']);
			if (strstr($new['avatar_path'], "\0") || !is_dir($phpbb_root_path . $new['avatar_path']) || !is_writable($phpbb_root_path . $new['avatar_path']))
			{
				$new['avatar_path'] = $default_config['avatar_path'];
			}
		}
        if( isset($HTTP_POST_VARS['submit']) )
        {
            if ($config_name == "default_Theme") {
                $sql = "UPDATE " . $prefix . "_config SET
                     default_Theme = '" . str_replace("\'", "''", $new[$config_name]) . "'";
                 if( !$db->sql_query($sql) )
                {
                    message_die(GENERAL_ERROR, "Failed to update general configuration for $config_name", "", __LINE__, __FILE__, $sql);
                }
            } else {
                $sql = "UPDATE " . CONFIG_TABLE . " SET
                    config_value = '" . str_replace("\'", "''", $new[$config_name]) . "'
                    WHERE config_name = '$config_name'";
                if( !$db->sql_query($sql) )
                {
                    message_die(GENERAL_ERROR, "Failed to update general configuration for $config_name", "", __LINE__, __FILE__, $sql);
                }
            }
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
               // $cache->delete('nukeconfig');
               // $cache->delete('board_config');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
        }
    }

    if( isset($HTTP_POST_VARS['submit']) )
    {
        $message = $lang['Config_updated'] . "<br /><br />" . sprintf($lang['Click_return_config'], "<a href=\"" . append_sid("admin_board.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");

        message_die(GENERAL_MESSAGE, $message);
    }
}

/*****[BEGIN]******************************************
 [ Mod:     Admin DHTML Menu                   v1.0.0 ]
 ******************************************************/
$dhtml_display = ( $new['use_dhtml'] ) ? "style=\"display: none\"" : "";
$dhtml_hand = ( $new['use_dhtml'] ) ? "style=\"cursor:pointer;cursor:hand\"" : "";
$dhtml_onclick  = ( $new['use_dhtml'] ) ? "onclick=" : "";
/*****[END]********************************************
 [ Mod:     Admin DHTML Menu                   v1.0.0 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Base:     Drop-A-Mod                        v1.0.0 ]
 ******************************************************/
$config_dir = dirname(__FILE__) . "/board_config";

define("BOARD_CONFIG", true);
include($config_dir . "/page_header.php");

    $load_files = 1;

    $dir = opendir($config_dir);

    $dhtml_id = 0;
    while( false !== ($file = readdir($dir)) )
    {
        if( preg_match("/^board_.*?\." . $phpEx . "$/", $file) )
        {
            $dhtml_id++;
            include($config_dir . "/" . $file);
        }
    }

    closedir($dir);

    unset($load_files);

include($config_dir . "/page_footer.php");
if (!defined('BOARD_CONFIG')) define("BOARD_CONFIG", false);
/*****[END]********************************************
 [ Base:     Drop-A-Mod                        v1.0.0 ]
 ******************************************************/

include('./page_footer_admin.'.$phpEx);

?>