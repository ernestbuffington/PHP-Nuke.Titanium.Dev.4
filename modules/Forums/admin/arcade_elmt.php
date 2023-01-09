<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                              arcade_elmt.php
 *                            -------------------
 *
 *   PHPNuke Ported Arcade - http://www.nukearcade.com
 *   Original Arcade Mod phpBB by giefca - http://www.gf-phpbb.com
 *
 ***************************************************************************/

if (!defined('IN_PHPBB')) define('IN_PHPBB', true);

$phpbb_root_path = "../";
require($phpbb_root_path . 'extension.inc');
require('pagestart.' . $phpEx);
require($phpbb_root_path . 'gf_funcs/gen_funcs.' . $phpEx);
require($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_main_arcade.' . $phpEx);
require($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_admin_arcade.' . $phpEx);

$mode = get_var_gf(array('name' => 'mode', 'intval' => false, 'okvar' => array('create','edit','editsave','createsave','delete', 'move'), 'default' => ''));
$arcade_catid = get_var_gf(array('name' => 'arcade_catid', 'intval' => true));
$last_catid = get_var_gf(array('name' => 'last_catid', 'intval' => true));
$game_name = get_var_gf(array('name' => 'game_name'));
$game_id = get_var_gf(array('name' => 'game_id', 'intval' => true));
$game_swf = get_var_gf(array('name' => 'game_swf', 'method' => 'POST'));
$game_pic = get_var_gf(array('name' => 'game_pic', 'method' => 'POST'));
$game_desc = get_var_gf(array('name' => 'game_desc', 'method' => 'POST'));
$game_scorevar = get_var_gf(array('name' => 'game_scorevar', 'method' => 'POST'));
$game_type = get_var_gf(array('name' => 'game_type', 'intval'=>true, 'method' => 'POST'));
$game_width = get_var_gf(array('name' => 'game_width', 'intval'=>true, 'method' => 'POST'));
$game_height = get_var_gf(array('name' => 'game_height', 'intval'=>true, 'method' => 'POST'));

if ($arcade_catid == 0 )$arcade_catid = get_var_gf(array('name'=>'arcade_catid', 'intval'=>true ));

if ( $mode == 'move')
{
    $gid2 = get_var_gf(array('name' => 'gid2', 'intval' => true, 'method' => 'GET'));
    $game_order = get_var_gf(array('name' => 'game_order', 'intval' => true, 'method' => 'GET'));
    $gorder2 = get_var_gf(array('name' => 'gorder2', 'intval' => true, 'method' => 'GET'));

    $sql = "UPDATE " . GAMES_TABLE . "
            SET game_order = $game_order + $gorder2 - game_order
            WHERE game_id = '$game_id' OR game_id = '$gid2'";

    if( !$db->sql_query($sql) )
    {
        message_die(GENERAL_ERROR, "Couldn't update games table", "", __LINE__, __FILE__, $sql);
    }
}

if( !empty($mode) )
{
    switch($mode)
    {
        case 'create':
        case 'edit':
            if ($mode == 'edit')
            {
                $l_title = $lang['Edit_game'];
                $newmode = 'editsave';
                $sql = "SELECT * FROM " . GAMES_TABLE . " WHERE game_id = '$game_id' ORDER BY game_order ASC";
                if( !($result = $db->sql_query($sql)) )
                {
                    message_die(GENERAL_ERROR, "Could not read the games table", '', __LINE__, __FILE__, $sql);
                }

                if( !($row = $db->sql_fetchrow($result)) )
                {
                    message_die(GENERAL_ERROR, "No game corresponds to this ID ($game_id)");
                }
                $arcade_catid = $row['arcade_catid'];
                $game_name = $row['game_name'];
                $game_desc = $row['game_desc'];
                $game_pic = $row['game_pic'];
                $game_swf = $row['game_swf'];
                $game_width = $row['game_width']; 
                $game_height = $row['game_height']; 
                $game_scorevar = $row['game_scorevar'];
                $selected0 = ( $row['game_type']==0 ) ? "selected='selected'" : "";
                $selected1 = ( $row['game_type']==1 ) ? "selected='selected'" : "";
                $selected2 = ( $row['game_type']==2 ) ? "selected='selected'" : "";
                $selected3 = ( $row['game_type']==3 ) ? "selected='selected'" : "";
                $selected4 = ( $row['game_type']==4 ) ? "selected='selected'" : "";
                $selected5 = ( $row['game_type']==5 ) ? "selected='selected'" : "";

                $sql = "SELECT arcade_cattitle, arcade_catid FROM " . ARCADE_CATEGORIES_TABLE . " ORDER BY arcade_cattitle ASC";
                if( !($result = $db->sql_query($sql)) )
                {
                    message_die(GENERAL_ERROR, "Could not read the arcade categories", '', __LINE__, __FILE__, $sql);
                }
                $liste_cat = '';
                while ( $row = $db->sql_fetchrow($result))
                {
                  $selected = ( $row['arcade_catid'] == $arcade_catid ) ? " selected='selected'" : "";
                  $liste_cat .= "<option value='" . $row['arcade_catid'] . "' $selected >" . $row['arcade_cattitle'] . "</option>\n";
                }


                $hidden_fields  = "<input type='hidden' name='mode' value='editsave' />";
                $hidden_fields .= "<input type='hidden' name='game_id' value='$game_id' />";
                $hidden_fields .= "<input type='hidden' name='last_catid' value='$arcade_catid' />";
            }
            else
            {
                $l_title = $lang['Create_game'];
                $newmode = 'createsave';

                $game_desc = "";
                $game_pic = "";
                $game_swf = "";
                $game_width = 550;
                $game_height = 380;
                $game_scorevar = "";
                $selected0 = "";
                $selected1 = "";
                $selected2 = "";

                $sql = "SELECT arcade_cattitle, arcade_catid FROM " . ARCADE_CATEGORIES_TABLE . " ORDER BY arcade_cattitle ASC";
                if( !($result = $db->sql_query($sql)) )
                {
                    message_die(GENERAL_ERROR, "Could not read the arcade category table", '', __LINE__, __FILE__, $sql);
                }
                $liste_cat = '';
                while ( $row = $db->sql_fetchrow($result))
                {
                  $liste_cat .= "<option value='" . $row['arcade_catid'] . "' >" . $row['arcade_cattitle'] . "</option>\n";
                }


                $hidden_fields = "<input type='hidden' name='mode' value='createsave' />";
            }

            $template->set_filenames(array(
            "body" => "admin/admin_edit_games.tpl")
             );

          $template->assign_vars(array(
            "L_EDIT_GAME" => $l_title,
            "L_EDIT_GAME_EXPLAIN" => $lang['Edit_game_explain'],
            "L_GAME_SETTINGS" => $lang['Game_settings'],
            "L_GAME_NAME" => $lang['Game_name'],
            "L_GAME_NAME_EXPLAIN" => $lang['Game_name_explain'],
            "L_DESCRIPTION" => $lang['Game_description'],
            "L_DESCRIPTION_EXPLAIN" => $lang['Game_description_explain'],
            "L_VIGNETTE" => $lang['Game_thumbail'],
            "L_VIGNETTE_EXPLAIN" => $lang['Game_thumbail_explain'],
            "L_SWF" => $lang['Game_swf'],
            "L_SWF_EXPLAIN" => $lang['Game_swf_explain'],
            "L_WIDTH" => $lang['Game_width'],
            "L_WIDTH_EXPLAIN" => $lang['Game_width_explain'],
            "L_HEIGHT" => $lang['Game_height'],
            "L_HEIGHT_EXPLAIN" => $lang['Game_height_explain'],
            "L_CATEGORIE" => $lang['Game_category'],
            "L_CATEGORIE_EXPLAIN" => $lang['Game_category_explain'],
            "L_SCORE_SETTINGS" => $lang['Score_settings'],
            "L_SCORE_SETTINGS_EXPLAIN" => $lang['Score_settings_explain'],
            "L_SCOREVARIABLE" => $lang['Game_scorevariable'],
            "L_SCOREVARIABLE_EXPLAIN" => $lang['Game_scorevariable_explain'],
            "L_GESTION_SCORE" => $lang['Game_typescore'],
            "L_GESTION_SCORE_EXPLAIN" => $lang['Game_typescore_explain'],
            "L_SUBMIT" => $lang['Submit'],

            "S_ACTION" => "arcade_elmt.$phpEx",
            "S_MODE" => $newmode,
            "GAME_NAME" => strip_htmlchars($game_name),
            "GAME_DESCRIPTION" => strip_htmlchars($game_desc),
            "GAME_VIGNETTE" => $game_pic,
            "GAME_SWF" => $game_swf,
            "GAME_WIDTH" => $game_width,
            "GAME_HEIGHT" => $game_height,
            "SCOREVARIABLE" => $game_scorevar,
            "SELECTED0" => $selected0,
            "SELECTED1" => $selected1,
            "SELECTED2" => $selected2,
            "SELECTED3" => $selected3,
            "SELECTED4" => $selected4,
            "SELECTED5" => $selected5,
            "S_CATEGORIE" => $liste_cat,
            "S_HIDDEN_FIELDS" => $hidden_fields)
            );

          $template->pparse('body');
          include('page_footer_admin.'.$phpEx);
          break;
          
          case 'createsave':
            if( trim(empty($game_name)) )
            {
                message_die(GENERAL_ERROR, "Can not create a game without a name.");
            }
            
            if( trim(empty($game_swf)) )
            {
                message_die(GENERAL_ERROR, "Impossible to create a play without file swf.");
            }
                
            $sql = "SELECT MAX(game_order) AS max_order
                FROM " . GAMES_TABLE;
            if( !$result = $db->sql_query($sql) )
            {
                message_die(GENERAL_ERROR, "Impossible to obtain the last sequence number of the table plays", "", __LINE__, __FILE__, $sql);
            }
            $row = $db->sql_fetchrow($result);

            $max_order = $row['max_order'];
            $next_order = $max_order + 10;

            $sql = "INSERT INTO " . GAMES_TABLE . " ( game_order, game_pic, game_desc, game_highscore, game_highdate, game_highuser, game_name, game_swf, game_width, game_height, game_scorevar, game_type, arcade_catid ) " .
                "VALUES ($next_order, '$game_pic', '" . str_replace("\'", "''", $game_desc) . "', 0, 0, 0, '" . str_replace("\'", "''", $game_name) . "', '$game_swf', '$game_width', '$game_height', '$game_scorevar','$game_type','$arcade_catid')";
            if( !$result = $db->sql_query($sql) )
            {
                message_die(GENERAL_ERROR, "Couldn't insert row in games table", "", __LINE__, __FILE__, $sql);
            }

            $sql = "UPDATE " . ARCADE_CATEGORIES_TABLE . " SET arcade_nbelmt = arcade_nbelmt + 1 WHERE arcade_catid = $arcade_catid";
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


            $message = $lang['Games_updated'] . "<br /><br />" . sprintf($lang['Click_return_gameadmin'], "<a href=\"arcade_elmt.$phpEx?arcade_catid=$arcade_catid\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");
            message_die(GENERAL_MESSAGE, $message);
            break;

        case 'editsave':
            $sql = "UPDATE " . GAMES_TABLE . " SET 
            game_name = '" . str_replace("\'", "''", $game_name) . "',
            game_desc = '" . str_replace("\'", "''", $game_desc) . "',
            game_pic = '" . $game_pic . "',
            game_scorevar = '" . $game_scorevar . "',
            game_swf = '" . $game_swf . "',
            game_width = " . $game_width . ",
            game_height = " . $game_height . ",
            game_type = " . $game_type . ",
            arcade_catid = " . $arcade_catid . "
                    WHERE game_id = " . $game_id;
                
            if( !$result = $db->sql_query($sql) )
            {
                message_die(GENERAL_ERROR, "Couldn't update game informations", "", __LINE__, __FILE__, $sql);
            }

            if ($arcade_catid != $last_catid)
            {
                $sql = "UPDATE " . ARCADE_CATEGORIES_TABLE . " SET arcade_nbelmt = arcade_nbelmt + 1 WHERE arcade_catid = $arcade_catid";                
                if( !$db->sql_query($sql) )
                {
                    message_die(GENERAL_ERROR, "Couldn't update categories table", "", __LINE__, __FILE__, $sql);
                }

                $sql = "UPDATE " . ARCADE_CATEGORIES_TABLE . " SET arcade_nbelmt = arcade_nbelmt - 1 WHERE arcade_catid = $last_catid";                
                if( !$db->sql_query($sql) )
                {
                    message_die(GENERAL_ERROR, "Couldn't update categories table", "", __LINE__, __FILE__, $sql);
                }
            }

            $message = $lang['Games_updated'] . "<br /><br />" . sprintf($lang['Click_return_gameadmin'], "<a href=\"arcade_elmt.$phpEx?arcade_catid=$last_catid\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");
            message_die(GENERAL_MESSAGE, $message);
            break;
    }                
}

$valid_select = get_var_gf(array('name' => 'valid', 'default' => ''));
$type_select  = get_var_gf(array('name' => 'selection', 'intval' => false, 'okvar' => array('Z','S','Y'), 'default' => ''));

if ($valid_select <> '')
{
    $selected_check = ( isset($HTTP_POST_VARS['select_list']) ) ?  $HTTP_POST_VARS['select_list'] : array();

    $select_id_sql = '';
    $csc = count($selected_check);
    
    for($i = 0; $i < $csc; $i++)
    {
        $select_id_sql .= ( ( !empty($select_id_sql) ) ? ', ' : '' ) . $selected_check[$i];
    }

    switch ($type_select)
    {
        case 'Z':
            $sql = "DELETE FROM " . SCORES_TABLE . "  
                WHERE game_id IN ($select_id_sql) ";
            if ( !$db->sql_query($sql) )
            {
                message_die(GENERAL_ERROR, 'Could not delete from the scores table', '', __LINE__, __FILE__, $sql);
            }
            $sql = "UPDATE " . GAMES_TABLE . " SET game_set = 0, game_highscore = 0, game_highuser = 0, game_highdate = 0
                WHERE game_id IN ($select_id_sql) ";
            if ( !$db->sql_query($sql) )
            {
                message_die(GENERAL_ERROR, 'Could not update the games table', '', __LINE__, __FILE__, $sql);
            }
            // Comments MOD Start
                        $sql = "UPDATE " . COMMENTS_TABLE. " SET comments_value = '' WHERE game_id IN ($select_id_sql) ";
                        if (!$db->sql_query($sql))
                        {
                                message_die(GENERAL_ERROR, 'Could not delete from comments table', '', __LINE__, __FILE__, $sql);
                        }
                        // Comments MOD End
            break;
        case 'S':
            $sql = "DELETE FROM " . SCORES_TABLE . " 
                WHERE game_id IN ($select_id_sql) ";
            if ( !$db->sql_query($sql) )
            {
                message_die(GENERAL_ERROR, 'Could not delete from the scores table', '', __LINE__, __FILE__, $sql);
            }
            $sql = "DELETE FROM " . GAMES_TABLE . " 
                WHERE game_id IN ($select_id_sql) ";
            if ( !$db->sql_query($sql) )
            {
                message_die(GENERAL_ERROR, 'Could not delete from the games table', '', __LINE__, __FILE__, $sql);
            }
            
            //Comments Mod Start
            $sql = "DELETE FROM " . COMMENTS_TABLE . " WHERE game_id IN ($select_id_sql) ";
            if ( !$db->sql_query($sql) )
            {
                message_die(GENERAL_ERROR, 'Could delete from comments table', '', __LINE__, __FILE__, $sql);
            }
            //Comments Mod End

            $sql = "UPDATE " . ARCADE_CATEGORIES_TABLE . " SET arcade_nbelmt = arcade_nbelmt - $csc WHERE arcade_catid = $arcade_catid";                
            if( !$db->sql_query($sql) )
            {
                message_die(GENERAL_ERROR, "Couldn't update categories table", "", __LINE__, __FILE__, $sql);
            }
            break;
        case 'Y':
            $sql = "SELECT SUM(score_set) AS nbset, game_id FROM " . SCORES_TABLE . " 
                WHERE game_id IN ($select_id_sql) GROUP BY game_id";
            if ( !$result = $db->sql_query($sql) )
            {
                message_die(GENERAL_ERROR, 'Impossible to reach the table of the scores', '', __LINE__, __FILE__, $sql);
            }
            
            while ($row = $db->sql_fetchrow($result))
            {
                $sql2 = "UPDATE " . GAMES_TABLE . " SET game_set = " . $row['nbset'] .
                    " WHERE game_id = " . $row['game_id'];
                if ( !$db->sql_query($sql2) )
                {
                    message_die(GENERAL_ERROR, 'Impossible to reach the table of the games', '', __LINE__, __FILE__, $sql);
                }
            }
            break;
        default :;
    }
}
//---------------------------
$hidden_fields = "<input type='hidden' name='arcade_catid' value='$arcade_catid'/>";

$template->set_filenames(array(
        "body" => "admin/arcade_manage_body.tpl")
    );

  $template->assign_vars(array(
        "L_MANAGE_GAME" => $lang['Manage_game'],
        "ADD_GAME" => $lang['Add_new'],
        "INITIAL_SCORE" => $lang['Initialize_score'],
        "DELETE_GAME" => $lang['Delete_game'],
        "SYNCHRO_GAME_SET" => $lang['Synchro_game_set'],
        "L_PATH_NEW_LOGO" => $lang['Path_new_logo'] = $lang['Path_new_logo'] ?? '',
        "L_ACTION" => $lang['Action'],
        "L_EDIT" => $lang['Edit'],
        "L_DEPLACE" => $lang['Deplace'],
        "L_GAME" => $lang['Arcade_game'],
        "L_HIGHSCORE" => $lang['Arcade_highscore'],
        'HIDDEN_FIELDS' => $hidden_fields,
        "L_SETS" => $lang['Arcade_sets'],
        "L_SCORES" => $lang['Arcade_scores'],
        "L_FOR_GAME_SELECTION" => $lang['For_game_selection'],
        "L_MANAGE_GAME_EXPLAIN" => $lang['Manage_game_explain'],
        "ALL_CHECKED" => $lang['All_checked'],
        "NOTHING_CHECKED" => $lang['Nothing_checked'],
        "S_ACTION" => "arcade_elmt.$phpEx")
        );

$sql = "SELECT COUNT(s.score_game) as nbset, g.game_id, g.game_order, g.game_name, g.game_highscore, g.game_set FROM " . GAMES_TABLE . " g left join " . SCORES_TABLE ." s on s.game_id = g.game_id WHERE g.arcade_catid = '$arcade_catid' GROUP BY g.game_id ORDER BY g.game_order";

if( !($result = $db->sql_query($sql)) )
{
    message_die(GENERAL_ERROR, "Impossible to reach the table of the games", '', __LINE__, __FILE__, $sql);
}

$liste_jeux = array();
while( $row = $db->sql_fetchrow($result) )
{
  $liste_jeux[] = $row;
}

$cg = count($liste_jeux);

for( $i=0 ; $i<$cg; $i++)
{
  $template->assign_block_vars('ligne_jeu', array(
        'TITRE_JEU' => $liste_jeux[$i]['game_name'],
        'NB_SETS' => $liste_jeux[$i]['game_set'],
        'NB_SCORES' => $liste_jeux[$i]['nbset'],
        'RECORD_JEU' => $liste_jeux[$i]['game_highscore'],
        'CHECK' => $liste_jeux[$i]['game_id'],
        'L_UP' => ( $i > 0) ? $lang['Up_arcade_cat'] . '<br />' : '',
        'L_DOWN' => ( $i < $cg-1 ) ? $lang['Down_arcade_cat'] : '',
        'U_UP' => ( $i > 0) ? "arcade_elmt.$phpEx?mode=move&amp;arcade_catid=$arcade_catid&amp;game_id=" . $liste_jeux[ $i ]['game_id'] . "&amp;gid2=" . $liste_jeux[ $i - 1 ]['game_id'] . 
                                    "&amp;game_order=" .  $liste_jeux[ $i ]['game_order'] . "&amp;gorder2=" . $liste_jeux[ $i - 1 ]['game_order'] : '',
        'U_DOWN' => ( $i < $cg-1) ? "arcade_elmt.$phpEx?mode=move&amp;arcade_catid=$arcade_catid&amp;game_id=" . $liste_jeux[ $i ]['game_id'] . "&amp;gid2=" . $liste_jeux[ $i + 1 ]['game_id'] . 
                                    "&amp;game_order=" .  $liste_jeux[ $i ]['game_order'] . "&amp;gorder2=" . $liste_jeux[ $i + 1 ]['game_order'] : '',
        'U_EDIT' => "arcade_elmt.$phpEx?mode=edit&amp;game_id=" . $liste_jeux[$i]['game_id']
      )
    );
}

if ( $cg>0 )
{
  $template->assign_block_vars('switch_liste_non_vide', array());
}

  $template->pparse('body');
  include('page_footer_admin.'.$phpEx);

?>