<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                           admin_arcade_add.php
 *                            -------------------
 *
 *   PHPNuke Ported Arcade - http://www.nukearcade.com
 *   Original Arcade Mod phpBB by giefca - http://www.gf-phpbb.com
 *
 ***************************************************************************/

if (!defined('IN_PHPBB')) define('IN_PHPBB', true);

if( !empty($setmodules) )
{
    $file = basename(__FILE__);
    $module['Arcade_Admin']['Add_a_game'] = $file;
    return;
}

//
// Let's set the root dir for phpBB
//
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
require($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_main_arcade.' . $phpEx);
require($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_admin_arcade.' . $phpEx);

if( isset($HTTP_POST_VARS['submit']) )
{
    $game_name = $HTTP_POST_VARS['add_gamename'];
    $game_desc = $HTTP_POST_VARS['add_gamedesc'];
    $game_swf = $HTTP_POST_VARS['add_gamefile'];
    $game_pic = $HTTP_POST_VARS['add_gamepicture'];
    $catid = $HTTP_POST_VARS['add_cat'];
    $game_width = $HTTP_POST_VARS['add_gamewidth'];
    $game_height = $HTTP_POST_VARS['add_gameheight'];
    $game_type = $HTTP_POST_VARS['add_gametype'];
    $game_scorevar = $HTTP_POST_VARS['add_scorevar'];

    if( !empty($game_name) && !empty($game_width) && !empty($game_height) && !empty($game_type) && !empty($game_scorevar) && !empty($catid) )
    {
        if(empty($game_swf))
            $game_swf = $game_scorevar . ".swf";
        if(empty($game_pic))
            $game_pic = $game_scorevar . ".gif";
    
        $sql = "SELECT MAX(game_order) AS max_order FROM " . GAMES_TABLE;
        if( !$result = $db->sql_query($sql) )
        {
            message_die(GENERAL_ERROR, "Unable to obtain the last sequence number of the table plays", "", __LINE__, __FILE__, $sql);
        }
        $row = $db->sql_fetchrow($result);
    
        $max_order = $row['max_order'];
        $next_order = $max_order + 10;
    
        $sql = "INSERT INTO " . GAMES_TABLE . " ( game_order, game_pic, game_desc, game_highscore, game_highdate, game_highuser, game_name, game_swf, game_width, game_height, game_scorevar, game_type, arcade_catid ) " .
            "VALUES ($next_order, '$game_pic', '" . str_replace("\'", "''", $game_desc) . "', 0, 0, 0, '" . str_replace("\'", "''", $game_name) . "', '$game_swf', '$game_width', '$game_height', '$game_scorevar','$game_type','$catid')";
        if( !$result = $db->sql_query($sql) )
        {
            message_die(GENERAL_ERROR, "Couldn't insert row in games table", "", __LINE__, __FILE__, $sql);
        }
    
        $sql = "UPDATE " . ARCADE_CATEGORIES_TABLE . " SET arcade_nbelmt = arcade_nbelmt + 1 WHERE arcade_catid = $catid";
        if( !$db->sql_query($sql) )
        {
            message_die(GENERAL_ERROR, "Couldn't update categories table", "", __LINE__, __FILE__, $sql);
        }
        
        //Comments Mod Start 
             $sql = "SELECT * FROM " . GAMES_TABLE . " WHERE game_order = $next_order ";
             if( !$result = $db->sql_query($sql) ) 
             { 
                message_die(GENERAL_ERROR, "Couldn't update comments table", "", __LINE__, __FILE__, $sql);
            } 
             $row = $db->sql_fetchrow($result); 
             $game_id = $row['game_id']; 
          
             $sql = "INSERT INTO " . COMMENTS_TABLE . " ( game_id, comments_value ) VALUES ($game_id, '')";
             if( !$db->sql_query($sql) ) 
             { 
                    message_die(GENERAL_ERROR, "Couldn't update comments table", "", __LINE__, __FILE__, $sql);
             } 
             //Comments Mod End 
        
        unset($HTTP_POST_VARS['submit']);
        
                $game_name = str_replace("\'", "'", $game_name);
        $message = $game_name . $lang['Arcade_game_added'] . "<br /><br />" . sprintf($lang['Click_return_add_game'], "<a href=\"" . append_sid("admin_arcade_add.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");

        message_die(GENERAL_MESSAGE, $message);

    }
    else
    {
        $message = "Not all forms have been filled out!  Unable to add the game!" . "<br /><br />" . sprintf($lang['Click_return_add_game'], "<a href=\"" . append_sid("admin_arcade_add.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");

        message_die(GENERAL_MESSAGE, $message);
    }
}

$template->set_filenames(array(
    "body" => "admin/arcade_add_body.tpl")
);

$sql = "SELECT arcade_cattitle, arcade_catid FROM " . ARCADE_CATEGORIES_TABLE . " ORDER BY arcade_cattitle ASC";
if( !($result = $db->sql_query($sql)) )
{
    message_die(GENERAL_ERROR, "Error retrieving categories", '', __LINE__, __FILE__, $sql); 
}

while ( $row = $db->sql_fetchrow($result))
{
    if(!isset($cats))
	$cats = ''; 
	
	$cats = $cats . "<option value='" . $row['arcade_catid'] . "' >" . $row['arcade_cattitle'] . "</option>\n";
}


$template->assign_vars(array(
    "L_ADD_TITLE" => $lang['Add_title'],

    "L_NAME" => $lang['Add_game_name'],
    "L_NAME_DESC" => $lang['Add_game_name_desc'],

    "L_DESC" => $lang['Add_game_desc'],
    "L_DESC_DESC" => $lang['Add_game_desc_desc'],

    "L_SCOREVAR" => $lang['Add_score_var'],
    "L_SCOREVAR_DESC" => $lang['Add_scorevar_desc'],

    "L_GAMEFILE" => $lang['Add_game_file'],
    "L_GAMEFILE_DESC" => $lang['Add_game_file_desc'],

    "L_PICFILE" => $lang['Add_pic_file'],
    "L_PICFILE_DESC" => $lang['Add_pic_file_desc'],

    "L_CAT" => $lang['Add_cat'],
    "L_CAT_DESC" => $lang['Add_cat_desc'],

    "L_TYPE" => $lang['Add_type'],
    "L_TYPE_DESC" => $lang['Add_type_desc'],

    "L_WIDTH" => $lang['Add_width'],
    "L_WIDTH_DESC" => $lang['Add_width_desc'],

    "L_HEIGHT" => $lang['Add_height'],
    "L_HEIGHT_DESC" => $lang['Add_height_desc'],

    "CATEGORIES" => $cats,

    "L_SUBMIT" => $lang['Submit'])
);

// Generate The Page

$template->pparse("body");

include('./page_footer_admin.'.$phpEx);

?>