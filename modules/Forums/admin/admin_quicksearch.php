<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                           admin_quicksearch.php
 *                            -------------------
 *   begin                : June 4, 2005
 *   author               : Fountain of Apples < webmacster87@webmacster87.info >
 *
 *   Revision: 0.1.0 -- 08/07/2005
 *
 ***************************************************************************/

/***************************************************************************
 *
 *    Code in this file was borrowed from code in admin_addsearch.php from
 *    EasySite MOD by ycl6 < ycl6@users.sourceforge.net > (Mac)
 *    http://macphpbbmod.sourceforge.net
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

if (!defined('IN_PHPBB')) define('IN_PHPBB', true);

if( !empty($setmodules) )
{
    $file = basename(__FILE__);
    $module['General']['Quick Search List'] = "$file";
    return;
}

//
// Let's set the root dir for phpBB
//
$no_page_header = FALSE;
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
//
// Let's start by playing with some HTTP VARS
//
if( isset($HTTP_GET_VARS['mode']) || isset($HTTP_POST_VARS['mode']) )
{
    $mode_pre = ($HTTP_GET_VARS['mode']) ? $HTTP_GET_VARS['mode'] : $HTTP_POST_VARS['mode'];
    $mode = htmlspecialchars($mode_pre, ENT_QUOTES);
}
else 
{
    //
    // These could be entered via a form button
    //
    if( isset($HTTP_POST_VARS['add']) )
    {
        $mode = "add";
    }
    else if( isset($HTTP_POST_VARS['save']) )
    {
        $mode = "save";
    }
    else
    {
        $mode = "";
    }
}

if( !empty($mode) )
{
    if( $mode == "edit" || $mode == "add" )
    {
        //
        // They want to add a new page, show the form.
        //
        $search_id = ( isset($HTTP_GET_VARS['id']) ) ? intval($HTTP_GET_VARS['id']) : 0;
        $s_hidden_fields = "";
        
        if( $mode == "edit" )
        {
            if( empty($search_id) )
            {
                message_die(GENERAL_MESSAGE, $lang['Must_select_search']);
            }

            $sql = "SELECT * FROM " . QUICKSEARCH_TABLE . "
                WHERE search_id = $search_id";
            if(!$result = $db->sql_query($sql))
            {
                message_die(GENERAL_ERROR, "Couldn't obtain quick search data", "", __LINE__, __FILE__, $sql);
            }
            
            $search_info = array();
            $search_info = $db->sql_fetchrow($result);
            $s_hidden_fields .= '<input type="hidden" name="id" value="' . $search_id . '" />';

        }

        $s_hidden_fields .= '<input type="hidden" name="mode" value="save" />';

        $template->set_filenames(array(
            "body" => "admin/quicksearch_edit.tpl")
        );

        $template->assign_vars(array(
                 "SEARCH_NMAE" => $search_info['search_name'],
            "SEARCH_URL1" => $search_info['search_url1'],
            "SEARCH_URL2" => $search_info['search_url2'],
            
            "L_SEARCHS_TITLE" => $lang['Search_title'],
            "L_SEARCHS_TEXT" => $lang['Search_explain'],
            "L_SEARCH_NMAE" => $lang['Search_name'],
            "L_SEARCH_NMAE_EXPLAIN" => $lang['Search_name_explain'],
            "L_SEARCH_URL" => $lang['Search_url'],
            "L_SEARCH_URL_EXPLAIN" => $lang['Search_url_explain'],
            "L_SUBMIT" => $lang['Submit'],
            "L_RESET" => $lang['Reset'],
            "L_YES" => $lang['Yes'],
            "L_NO" => $lang['No'],
            
            "S_SEARCH_ACTION" => append_sid("admin_quicksearch.$phpEx"),
            "S_HIDDEN_FIELDS" => $s_hidden_fields)
        );
        
    }
    else if( $mode == "save" )
    {
        //
        // Ok, they sent us our info, let's update it.
        //
        
        $search_id = ( isset($HTTP_POST_VARS['id']) ) ? intval($HTTP_POST_VARS['id']) : 0;
        $search_name = ( isset($HTTP_POST_VARS['search_name']) ) ? trim($HTTP_POST_VARS['search_name']) : "";
        $search_url1 = ( isset($HTTP_POST_VARS['search_url1']) ) ? trim($HTTP_POST_VARS['search_url1']) : "";
        $search_url2 = ( isset($HTTP_POST_VARS['search_url2']) ) ? trim($HTTP_POST_VARS['search_url2']) : "";

        if( empty($search_name) )
        {
            message_die(GENERAL_MESSAGE, $lang['Must_enter_search_name']);
        }

        if ($search_id)
        {            
            $sql = "UPDATE " . QUICKSEARCH_TABLE . "
                SET search_name = '" . str_replace("\'", "''", $search_name) . "', search_url1 = '" . str_replace("\'", "''", $search_url1) . "', search_url2 = '" . str_replace("\'", "''", $search_url2) . "'
                WHERE search_id = $search_id";

            $message = $lang['Search_updated'];
        }
        else
        {
            $sql = "INSERT INTO " . QUICKSEARCH_TABLE . " (search_name, search_url1, search_url2)
                VALUES ('" . str_replace("\'", "''", $search_name) . "', '" . str_replace("\'", "''", $search_url1) . "', '" . str_replace("\'", "''", $search_url2) . "')";

            $message = $lang['Search_added'];
        }
        
        if( !$result = $db->sql_query($sql) )
        {
            message_die(GENERAL_ERROR, "Couldn't update quick search table", "", __LINE__, __FILE__, $sql);
        }

        $message .= "<br /><br />" . sprintf($lang['Click_return_addsearchadmin'], "<a href=\"" . append_sid("admin_quicksearch.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");

        message_die(GENERAL_MESSAGE, $message);

    }
    else if( $mode == "delete" )
    {    
        if( isset($HTTP_POST_VARS['id']) || isset($HTTP_GET_VARS['id']) )
        {
            $search_id = ( isset($HTTP_POST_VARS['id']) ) ? intval($HTTP_POST_VARS['id']) : intval($HTTP_GET_VARS['id']);
        }
        else
        {
            message_die(CRITICAL_ERROR, 'No search ID was selected to be deleted.');
        }
        
        if( $search_id )
        {
            $sql = "DELETE FROM " . QUICKSEARCH_TABLE . "
                WHERE search_id = $search_id";
            
            if( !$result = $db->sql_query($sql) )
            {
                message_die(GENERAL_ERROR, "Couldn't delete quick search data", "", __LINE__, __FILE__, $sql);
            }

            $message = $lang['Search_removed'] . "<br /><br />" . sprintf($lang['Click_return_addsearchadmin'], "<a href=\"" . append_sid("admin_quicksearch.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");

            message_die(GENERAL_MESSAGE, $message);

        }
        else
        {
            message_die(GENERAL_MESSAGE, $lang['Must_select_page']);
        }
    }
    else
    {
        $template->set_filenames(array(
            "body" => "admin/quicksearch_body.tpl")
        );
        
        $sql = "SELECT * FROM " . QUICKSEARCH_TABLE . "
            ORDER BY search_name";
        if( !$result = $db->sql_query($sql) )
        {
            message_die(GENERAL_ERROR, "Couldn't retrieve quick search data", "", __LINE__, __FILE__, $sql);
        }
        
        $search_rows = array();
        $search_rows = $db->sql_fetchrowset($result);
        $search_count = count($search_rows);
        
        $template->assign_vars(array(
            "L_SEARCHS_TITLE" => $lang['Search_title'],
            "L_SEARCHS_TEXT" => $lang['Search_explain'],
            "L_SEARCH_NAME" => $lang['Search_name'],
            "L_EDIT" => $lang['Edit'],
            "L_DELETE" => $lang['Delete'],
            "L_ADD_SEARCH" => $lang['Add_new_search'],
            "L_ACTION" => $lang['Action'],
            
            "S_SEARCHS_ACTION" => append_sid("admin_quicksearch.$phpEx"))
        );
        
        for( $i = 0; $i < $search_count; $i++)
        {
            $search_name = $search_rows[$i]['search_name'];
            $search_id = $search_rows[$i]['search_id'];
            
            $row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
            $row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
    
            $template->assign_block_vars("addsearch", array(
                "ROW_COLOR" => "#" . $row_color,
                "ROW_CLASS" => $row_class,
                "SEARCH_NAME" => $search_name,

                "U_SEARCH_EDIT" => append_sid("admin_quicksearch.$phpEx?mode=edit&amp;id=$search_id"),
                "U_SEARCH_DELETE" => append_sid("admin_quicksearch.$phpEx?mode=delete&amp;id=$search_id"))
            );
        }
    }
}
else
{
    //
    // Show the default page
    //
    $template->set_filenames(array(
        "body" => "admin/quicksearch_body.tpl")
    );
    
    $sql = "SELECT * FROM " . QUICKSEARCH_TABLE . "
        ORDER BY search_name";
    if( !$result = $db->sql_query($sql) )
    {
        message_die(GENERAL_ERROR, "Couldn't retrieve quick search data", "", __LINE__, __FILE__, $sql);
    }
    $search_count = $db->sql_numrows($result);

    $search_rows = array();
    $search_rows = $db->sql_fetchrowset($result);
    
    $template->assign_vars(array(
        "L_SEARCHS_TITLE" => $lang['Search_title'],
        "L_SEARCHS_TEXT" => $lang['Search_explain'],
        "L_SEARCH_NAME" => $lang['Search_name'],
        "L_EDIT" => $lang['Edit'],
        "L_DELETE" => $lang['Delete'],
        "L_ADD_SEARCH" => $lang['Add_new_search'],
        "L_ACTION" => $lang['Action'],
        
        "S_SEARCHS_ACTION" => append_sid("admin_quicksearch.$phpEx"))
    );
    
    for($i = 0; $i < $search_count; $i++)
    {
        $search_name = $search_rows[$i]['search_name'];
        $search_id = $search_rows[$i]['search_id'];

        $row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
        $row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
        
        $template->assign_block_vars("addsearch", array(
            "ROW_COLOR" => "#" . $row_color,
            "ROW_CLASS" => $row_class,
            "SEARCH_NAME" => $search_name,

            "U_SEARCH_EDIT" => append_sid("admin_quicksearch.$phpEx?mode=edit&amp;id=$search_id"),
            "U_SEARCH_DELETE" => append_sid("admin_quicksearch.$phpEx?mode=delete&amp;id=$search_id"))
        );
    }
}

$template->pparse("body");

include('./page_footer_admin.'.$phpEx);

?>