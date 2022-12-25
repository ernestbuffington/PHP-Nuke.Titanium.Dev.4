<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                             admin_arcade.php
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
    $module['Arcade_Admin']['Configuration'] = $file;
    return;
}

//
// Let's set the root dir for phpBB
//
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
require( $phpbb_root_path . 'gf_funcs/gen_funcs.' . $phpEx);
require($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_main_arcade.' . $phpEx);
require($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_admin_arcade.' . $phpEx);

//
// Pull all config data
//
$sql = "SELECT *
    FROM " . ARCADE_TABLE;
if(!$result = $db->sql_query($sql))
{
    message_die(CRITICAL_ERROR, "Could not query config information in admin_arcade", "", __LINE__, __FILE__, $sql);
}
else
{
    while( $row = $db->sql_fetchrow($result) )
    {
        $arcade_name = $row['arcade_name'];
        $arcade_value = $row['arcade_value'];
        $default_arcade[$arcade_name] = $arcade_value;
        
        $new[$arcade_name] = ( isset($HTTP_POST_VARS[$arcade_name]) ) ? $HTTP_POST_VARS[$arcade_name] : $default_arcade[$arcade_name];

        if( isset($HTTP_POST_VARS['submit']) )
        {
            $sql = "UPDATE " . ARCADE_TABLE . "
                SET arcade_value = '" . str_replace("\'", "''", $new[$arcade_name]) . "'
                WHERE arcade_name = '$arcade_name'";
            if( !$db->sql_query($sql) )
            {
                message_die(GENERAL_ERROR, "Failed to update arcade configuration for $arcade_name", "", __LINE__, __FILE__, $sql);
            }
        }
    }

    if( isset($HTTP_POST_VARS['submit']) )
    {
        $message = $lang['Arcade_config_updated'] . "<br /><br />" . sprintf($lang['Click_return_arcade_config'], "<a href=\"" . append_sid("admin_arcade.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");

        message_die(GENERAL_MESSAGE, $message);
    }
}

if(!isset($new['forum_header']))
$new['forum_header'] = '';

if(!isset($new['bodyline']))
$new['bodyline'] = '';

if(!isset($new['head_out_bodyline']))
$new['head_out_bodyline'] = '';

$new['game_order'] = [];

if(!isset($lang['game_order_random']))
$lang['game_order_random'] = '';

if(!isset($lang['game_order_news']))
$lang['game_order_news'] = '';


$header_forum_yes = ( $new['forum_header'] ) ? "checked=\"checked\"" : "";
$header_forum_no = ( !$new['forum_header'] ) ? "checked=\"checked\"" : "";

$bodyline_yes = ( $new['bodyline'] ) ? "checked=\"checked\"" : "";
$bodyline_no = ( !$new['bodyline'] ) ? "checked=\"checked\"" : "";

$head_out_bodyline_yes = ( $new['head_out_bodyline'] ) ? "checked=\"checked\"" : "";
$head_out_bodyline_no = ( !$new['head_out_bodyline'] ) ? "checked=\"checked\"" : "";

$s_alpha = ( $new['game_order'] == 'Alpha' ) ? "selected" : "";
$s_popular = ( $new['game_order'] == 'Popular' ) ? "selected" : "";
$s_fixed = ( $new['game_order'] == 'Fixed') ? "selected" : "";
$s_random = ( $new['game_order'] == 'Random') ? "selected" : "";
$s_news = ( $new['game_order'] == 'News') ? "selected" : "";

$s_order  = "<option value='Alpha' $s_alpha >" . $lang['game_order_alpha'] . "</option>\n";
$s_order .= "<option value='Popular' $s_popular >" . $lang['game_order_popular'] . "</option>\n";
$s_order .= "<option value='Fixed' $s_fixed >" . $lang['game_order_fixed'] . "</option>\n";
$s_order .= "<option value='Random' $s_random >" . $lang['game_order_random'] . "</option>\n";
$s_order .= "<option value='News' $s_news >" . $lang['game_order_news'] . "</option>\n";

$use_category_mod_yes = ( $new['use_category_mod'] ) ? "checked=\"checked\"" : "";
$use_category_mod_no = ( !$new['use_category_mod'] ) ? "checked=\"checked\"" : "";

$use_fav_category_yes = ( $new['use_fav_category'] ) ? "checked=\"checked\"" : "";
$use_fav_category_no = ( !$new['use_fav_category'] ) ? "checked=\"checked\"" : "";

$display_winner_avatar_yes = ( $new['display_winner_avatar'] ) ? "checked=\"checked\"" : "";
$display_winner_avatar_no = ( !$new['display_winner_avatar'] ) ? "checked=\"checked\"" : "";

$winner_avatar_left = ( $new['winner_avatar_position']=='left' ) ? "checked=\"checked\"" : "";
$winner_avatar_right = ( $new['winner_avatar_position']!='left' ) ? "checked=\"checked\"" : "";

$s_linkcat_align_left = ( $new['linkcat_align'] == '0' ) ? "selected" : "";
$s_linkcat_align_center = ( $new['linkcat_align'] == '1' ) ? "selected" : "";
$s_linkcat_align_right = ( $new['linkcat_align'] == '2') ? "selected" : "";

$s_linkcat_align  = "<option value='0' $s_linkcat_align_left >" . $lang['linkcat_left'] . "</option>\n";
$s_linkcat_align .= "<option value='1' $s_linkcat_align_center >" . $lang['linkcat_center'] . "</option>\n";
$s_linkcat_align .= "<option value='2' $s_linkcat_align_right >" . $lang['linkcat_right'] . "</option>\n";

$limit_by_posts_yes = ( $new['limit_by_posts'] ) ? "checked=\"checked\"" : "";
$limit_by_posts_no = ( !$new['limit_by_posts'] ) ? "checked=\"checked\"" : "";

$limit_type_posts = ( $new['limit_type']=='posts' ) ? "checked=\"checked\"" : "";
$limit_type_date = ( $new['limit_type']=='date' ) ? "checked=\"checked\"" : "";

$template->set_filenames(array(
    "body" => "admin/arcade_config_body.tpl")
);


$template->assign_vars(array(
    "S_CONFIG_ACTION" => append_sid("admin_arcade.$phpEx"),

    "L_YES" => $lang['Yes'],
    "L_NO" => $lang['No'],
    "L_CONFIGURATION_TITLE" => $lang['Arcade_Config'],
    "L_CONFIGURATION_EXPLAIN" => $lang['Arcade_config_explain'],
    "L_GENERAL_SETTINGS" => $lang['General_arcade_settings'],
    "L_STATARCADE_SETTINGS" => $lang['statarcade_settings'],
    "L_GAMES_AREA_SETTINGS" => $lang['games_area_settings'],
    "L_USE_CATEGORY_MOD" => $lang['use_category_mod'],
    "L_USE_CATEGORY_MOD_EXPLAIN" => $lang['use_category_mod_explain'],
    "L_USE_FAV_CATEGORY" => $lang['use_fav_category'],
    "L_USE_FAV_CATEGORY_EXPLAIN" => $lang['use_fav_category_explain'],
    "L_ARCADE_ANNOUNCEMENT" => $lang['arcade_announcement'],
    "L_ARCADE_ANNOUNCEMENT_EXPLAIN" => $lang['arcade_announcement_explain'],
    "L_CATEGORY_PREVIEW_GAMES" => $lang['category_preview_games'],
    "L_CATEGORY_PREVIEW_GAMES_EXPLAIN" => $lang['category_preview_games_explain'],
    "L_GAMES_PAR_PAGE" => $lang['games_par_page'],
    "L_GAMES_PAR_PAGE_EXPLAIN" => $lang['games_par_page_explain'],
    "L_GAME_ORDER" => $lang['games_order'],
    "L_GAME_ORDER_EXPLAIN" => $lang['games_order_explain'],
    "L_DISPLAY_WINNER_AVATAR" => $lang['display_winner_avatar'],
    "L_DISPLAY_WINNER_AVATAR_EXPLAIN" => $lang['display_winner_avatar_explain'],
    "L_WINNER_AVATAR_POSITION" => $lang['winner_avatar_position'],
    "L_WINNER_AVATAR_POSITION_EXPLAIN" => $lang['winner_avatar_position_explain'],
    "L_RIGHT" => $lang['Right_avatar'],
    "L_LEFT" => $lang['Left_avatar'],
    "L_MAXSIZE_AVATAR" => $lang['maxsize_avatar'],
    "L_MAXSIZE_AVATAR_EXPLAIN" => $lang['maxsize_avatar_explain'],
    "L_STAT_PAR_PAGE" => $lang['stat_par_page'],
    "L_STAT_PAR_PAGE_EXPLAIN" => $lang['stat_par_page_explain'],
    "L_LINKCAT_ALIGN" => $lang['linkcat_align'],
    "L_LINKCAT_ALIGN_EXPLAIN" => $lang['linkcat_align_explain'],
    "L_POSTS_ONLY" => $lang['posts_only'],
    "L_POSTS_DATE" => $lang['posts_date'],
    "L_LIMIT_TYPE" => $lang['limit_type'],
    "L_LIMIT_TYPE_EXPLAIN" => $lang['limit_type_explain'],
    "L_GAME_ACCESS_SETTINGS" => $lang['game_access_settings'],
    "L_LIMIT_BY_POSTS" => $lang['limit_by_posts'],
    "L_POSTS_NEEDED" => $lang['posts_needed'],
    "L_DAYS_LIMIT" => $lang['days_limit'],
    "L_LIMIT_BY_POSTS_EXPLAIN" => $lang['limit_by_posts_explain'],
    "L_POSTS_NEEDED_EXPLAIN" => $lang['posts_needed_explain'],
    "L_DAYS_LIMIT_EXPLAIN" => $lang['days_limit_explain'],
    "L_ARCADE_ANNOUNCEMENT" => $lang['arcade_announcement'],
    "L_ARCADE_ANNOUNCEMENT_EXPLAIN" => $lang['arcade_announcement_explain'],

    "S_CATEGORY_PREVIEW_GAMES" => intval($new['category_preview_games']),
    "S_GAMES_PAR_PAGE" => intval($new['games_par_page']),
    "S_STAT_PAR_PAGE" => intval($new['stat_par_page']),
    "S_GAME_ORDER" => $s_order,
    "S_USE_CATEGORY_MOD_YES" => $use_category_mod_yes,
    "S_USE_CATEGORY_MOD_NO" => $use_category_mod_no,
    "S_USE_FAV_CATEGORY_YES" => $use_fav_category_yes,
    "S_USE_FAV_CATEGORY_NO" => $use_fav_category_no,
    "S_DISPLAY_WINNER_AVATAR_YES" => $display_winner_avatar_yes,
    "S_DISPLAY_WINNER_AVATAR_NO" => $display_winner_avatar_no,
    "S_WINNER_AVATAR_LEFT" => $winner_avatar_left,
    "S_WINNER_AVATAR_RIGHT" => $winner_avatar_right,
    "S_MAXSIZE_AVATAR" => intval($new['maxsize_avatar']),
    "S_LINKCAT_ALIGN" => $s_linkcat_align,
    "S_LIMIT_TYPE_POSTS" => $limit_type_posts,
    "S_LIMIT_TYPE_DATE" => $limit_type_date,
    "S_LIMIT_BY_POSTS_YES" => $limit_by_posts_yes,
    "S_LIMIT_BY_POSTS_NO" => $limit_by_posts_no,
    "S_POSTS_NEEDED" => intval($new['posts_needed']),
    "S_DAYS_LIMIT" => intval($new['days_limit']),
    "S_ARCADE_ANNOUNCEMENT" => $new['arcade_announcement'],

    "L_SUBMIT" => $lang['Submit'], 
    "L_RESET" => $lang['Reset'])
);

// Generate the page footer

$template->pparse("body");

include('./page_footer_admin.'.$phpEx);

?>