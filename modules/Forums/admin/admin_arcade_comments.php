<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                          admin_arcade_comments.php
 *                            -------------------
 *
 *   PHPNuke Ported Arcade - http://www.nukearcade.com
 *   Original Arcade Mod phpBB by giefca - http://www.gf-phpbb.com
 *
 ***************************************************************************/

/*****[CHANGES]**********************************************************
-=[Mod]=-
      Advanced Username Color                  v1.0.5       01/30/2006
 ************************************************************************/

if (!defined('IN_PHPBB')) define('IN_PHPBB', true);

if( !empty($setmodules) )
{
   $file = basename(__FILE__);
   $module['Arcade_Admin']['Manage_comments'] = $file;
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

if(!isset($mode))
$mode = '';

if(!isset($HTTP_GET_VARS['mode']))
$HTTP_GET_VARS['mode'] = '';

$mode = $HTTP_GET_VARS['mode'];

    if($mode == "update")
    {
    $game_id = intval($HTTP_POST_VARS['comment_id']);
    $comment_text = str_replace("\'","''",$HTTP_POST_VARS['comments']);
    $comment_text = preg_replace(array('#&(?!(\#[0-9]+;))#', '#<#', '#>#'), array('&amp;', '&lt;', '&gt;'),$comment_text);
        
    //Enters Comment into the DB
    $sql = "UPDATE " . COMMENTS_TABLE . " SET comments_value = '$comment_text' WHERE game_id = $game_id";
    if( !$result = $db->sql_query($sql) )
    {
        message_die(GENERAL_ERROR, "Couldn't insert row in comments table", "", __LINE__, __FILE__, $sql);
    }
        
    //Comment Updated/Added Successfully
    $message = "Comment sucessfully updated."; 
      $message .= "<br /><br />Click <a href=\"admin_arcade_comments.php\">here</a> to return to comments configuration."; 
    $message .= "<meta http-equiv=\"refresh\" content=\"5;URL=admin_arcade_comments.php\">";
      message_die(GENERAL_MESSAGE, $message); 

    }
    

    if($mode == "edit")
    {

    $gid = $HTTP_GET_VARS['gid'];

    $template->set_filenames(array(
       'body' => 'admin/admin_edit_comments_body.tpl')); 

    
    //Gets comments from database
    $sql = "SELECT g.game_id, g.game_name, c.* FROM " . GAMES_TABLE. " g LEFT JOIN " . COMMENTS_TABLE . " c ON g.game_id = c.game_id WHERE g.game_id = $gid";
    if( !($result = $db->sql_query($sql)) )
            {
            message_die(GENERAL_ERROR, "Error retrieving comment list", '', __LINE__, __FILE__, $sql); 
            }

    $row = $db->sql_fetchrow($result);

    $template->assign_vars(array(
            'GAME_ID' => $row['game_id'],
            'GAME_NAME' => '<a href="../../../' . append_sid("games.$phpEx?gid=" . $row['game_id']) . '">' . $row['game_name'] . '</a>', 
            'COMMENTS' => $row['comments_value'],
            'S_ACTION' => append_sid('admin_arcade_comments.' . $phpEx . '?mode=update'), 
            ));

    $template->pparse('body'); 

    include('./page_footer_admin.'.$phpEx);

    }
 
    $comments_sql = "SELECT * FROM " . COMMENTS_TABLE . " WHERE comments_value <> ''"; 

    if ( !($result_count = $db->sql_query($comments_sql)) ) 
      { 
         // Error if it fails... 
         message_die(GENERAL_ERROR, "Couldn't obtain comment count.", "", __LINE__, __FILE__, $sql); 
      }
    
    $count_rows = $db->sql_fetchrowset($result_count);
    $count_rows = array();
    $comments_total= count($count_rows);

    $start = ( isset($HTTP_GET_VARS['start']) ) ? intval($HTTP_GET_VARS['start']) : 0;
    $comments_perpage = 15;


$template->set_filenames(array( 
   'body' => 'admin/admin_arcade_comments_body.tpl')); 

                
$sql = "SELECT g.*, c.*, u.* FROM " . GAMES_TABLE. " g LEFT JOIN " . COMMENTS_TABLE . " c ON g.game_id = c.game_id LEFT JOIN " . USERS_TABLE ." u ON g.game_highuser=u.user_id WHERE comments_value <> '' ORDER BY game_name ASC LIMIT $start, $comments_perpage";
            if( !($result = $db->sql_query($sql)) )
            {
            message_die(GENERAL_ERROR, "Error retrieving high score list", '', __LINE__, __FILE__, $sql); 
            }
    
    

while ( $row = $db->sql_fetchrow($result))
            {
            
            $template->assign_block_vars('commentrow', array(
                 'GAME_NAME' => '<a href="../../../' . append_sid("games.$phpEx?gid=" . $row['game_id']) . '">' . $row['game_name'] . '</a>', 
                 'COMMENTS_VALUE' => $row['comments_value'],
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                 'USERNAME' => '<a href="../../../' . append_sid("statarcade.$phpEx?uid=" . $row['user_id'] ) . '" class="genmed">' . UsernameColor($row['username']) . '</a> ',
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                 'EDIT_COMMENTS' => '<a href="' . append_sid("admin_arcade_comments.$phpEx?mode=edit&amp;gid=" . $row['game_id']) . '">Edit Comment</a>',
            )); 

            }

$template->assign_vars(array(
                'PAGINATION' => generate_pagination("admin_arcade_comments.$phpEx?", $comments_total, $comments_perpage, $start),
                'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $comments_perpage) + 1 ), ceil( $comments_total / $comments_perpage )),
                'L_GOTO_PAGE' => $lang['Goto_page'])
        );

//
// Generate the page end
//
$template->pparse('body');
include('./page_footer_admin.'.$phpEx);

?>