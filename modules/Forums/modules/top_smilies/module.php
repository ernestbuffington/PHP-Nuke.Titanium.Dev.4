<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

if (!defined('IN_PHPBB'))
{
    die('Hacking attempt');
}

//
// Top Smilies
//

//
// Start user modifiable variables
//

//
// Set smile_pref to 0, if you want that smilies are only counted once per post.
// This means that, if the same smilie is entered ten times in a message, only one is counted in that message.
//
$smile_pref = 0;
//
// End user modifiable variables
//

define('SMILIE_INDEX_TABLE', 'stats_smilies_index');
define('SMILIE_INFO_TABLE', 'stats_smilies_info');

$core->start_module();

$core->set_content('bars');

$core->set_view('rows', $core->return_limit);
$core->set_view('columns', 6);

$core->define_view('set_columns', array(
    $core->pre_defined('rank'),
    'uses' => $lang['Uses'],
    'image' => $lang['Smilie_image'],
    'code' => $lang['Smilie_code'],
    $core->pre_defined('percent'),
    $core->pre_defined('graph'))
);

$content->percentage_sign = TRUE;

$core->set_header($lang['module_name']);

$core->assign_defined_view('align_rows', array(
    'left',
    'center',
    'center',
    'center',
    'center',
    'left')
);

// Rebuild Index ?
$sql = "SELECT * FROM " . SMILIE_INFO_TABLE;
$result = $core->sql_query($sql, 'Unable to determine last_post_id');
$smilie_info_row = $core->sql_fetchrow($result);

$last_post_id = $smilie_info_row['last_post_id'];

if ((intval($smilie_info_row['last_update_time']) + (intval($smilie_info_row['update_time']) * 60)) <= time())
{
    // Rebuild Smilies Index
    $sql = "DELETE FROM " . SMILIE_INDEX_TABLE;
    $core->sql_query($sql, 'Could not delete Smilies Index Table');

    $sql = "UPDATE " . SMILIE_INFO_TABLE . " SET last_post_id = 0, last_update_time = " . time();
    $core->sql_query($sql, 'Could not reset Smilies Info Table');
    $last_post_id = 0;
}

// Query Index
$sql = "SELECT * FROM " . SMILIE_INDEX_TABLE;
$result = $core->sql_query($sql, 'Couldn\'t retrieve smilies data');
$rows = $core->sql_fetchrowset($result);

$index_smilies = array();
$rows = array();

for ($i = 0; $i < count($rows); $i++)
{
    $index_s[$rows[$i]['smile_url']]['code'] = $rows[$i]['code'];
    $index_smilies['smile_url'][] = $rows[$i]['smile_url'];
    $index_s[$rows[$i]['smile_url']]['count'] = $rows[$i]['smile_count'];
}

$sql = "SELECT max(post_id) as total FROM " . POSTS_TABLE;
$result = $core->sql_query($sql, 'Unable to determine last_post_id');
$row = $core->sql_fetchrow($result);

$last_post = $row['total'];

$sql = "SELECT COUNT(post_id) as total FROM " . POSTS_TABLE;
$result = $core->sql_query($sql, 'Unable to determine last_post_id');
$row = $core->sql_fetchrow($result);

$num_posts = $row['total'];

if ($last_post > $last_post_id)
{
    $last_post_update = "UPDATE " . SMILIE_INFO_TABLE . " SET last_post_id = " . intval($last_post);
    $last_post_index = $last_post_id;
}
else
{
    $last_post_index = -1;
}

$sql = 'SELECT smile_url FROM ' . SMILIES_TABLE . ' GROUP BY smile_url'; 
$result = $core->sql_query($sql, 'Couldn\'t retrieve smilies data');

$all_smilies = array(); 
$total_smilies = 0; 
$num_smilie_rows = $core->sql_numrows($result);

// New Smilie Limit, calculate on posts - every 5000 posts one smilie got decremented
$new_smilie_limit = $num_smilie_rows;
$dec = round($num_posts / 5000);

if ($dec != 0)
{
    $new_smilie_limit -= $dec;
}

if ($new_smilie_limit <= 0)
{
    $new_smilie_limit = 5;
}

$new_smilies = 0;

if ($num_smilie_rows > 0) 
{ 
    $smilies = $core->sql_fetchrowset($result); 

    for ($i = 0; $i < count($smilies); $i++) 
    { 
        $build_new_smilie = false;
        $update_smilie = false;

        if ( is_array($index_smilies['smile_url']) )
        {
            if (count($index_smilies['smile_url']) > 0)
            {
                if (!in_array($smilies[$i]['smile_url'], $index_smilies['smile_url']))
                {
                    $build_new_smilie = true;
                }
            }
        }
        
        else
        {
            $build_new_smilie = true;
        }

        if ((!$build_new_smilie) && ($last_post_index != -1))
        {
            $update_smilie = true;
        }

        if ($build_new_smilie)
        {
            if ($new_smilies > $new_smilie_limit)
            {
                $build_new_smilie = false;
            }
            else
            {
                $new_smilies++;
            }
        }
        
        if (($build_new_smilie) || ($update_smilie))
        {
            $sql = "SELECT * 
            FROM " . SMILIES_TABLE . " 
            WHERE smile_url = '" . str_replace("'", "\\'", $smilies[$i]['smile_url']) . "'"; 
        
            $result = $core->sql_query($sql, 'Couldn\'t retrieve smilies data'); 
            $smile_codes = $core->sql_fetchrowset($result); 

            if ($update_smilie)
            {
                $count = intval($index_s[$smilies[$i]['smile_url']]['count']);
            }
            else
            {
                $count = 0; 
            }

            for ($j = 0; $j < count($smile_codes); $j++) 
            {
                $plus_where = ($last_post_index == -1) ? '' : ' AND post_id > ' . $last_post_index;

                $sql = "SELECT post_id, post_text 
                FROM " . POSTS_TEXT_TABLE . " 
                WHERE post_text LIKE '%" . str_replace("'", "\\'", $smile_codes[$j]['code']) . "%'" . $plus_where; 

                $result = $core->sql_query($sql, 'Couldn\'t retrieve smilies data'); 

                if ($smile_pref == 0) 
                { 
                    $count = $count + $core->sql_numrows($result); 
                } 
                else 
                { 
                    while ($post = $core->sql_fetchrow($result)) 
                    { 
                        $count = $count + substr_count($post['post_text'], $smile_codes[$j]['code']); 
                    } 
                } 
            } 

            $all_smilies[$i]['status'] = ($update_smilie) ? 'update' : 'new';
            $all_smilies[$i]['count'] = $count;
            $all_smilies[$i]['code'] = ($update_smilie) ? trim($index_s[$smilies[$i]['smile_url']]['code']) : $smile_codes[0]['code']; 
            $all_smilies[$i]['smile_url'] = ($update_smilie) ? trim($smilies[$i]['smile_url']) : $smile_codes[0]['smile_url']; 
            $total_smilies = $total_smilies + $count; 
        } 
        else
        {
            $all_smilies[$i]['status'] = 'old';
            $all_smilies[$i]['count'] = intval($index_s[$smilies[$i]['smile_url']]['count']); 
            $all_smilies[$i]['code'] = trim($index_s[$smilies[$i]['smile_url']]['code']); 
            $all_smilies[$i]['smile_url'] = trim($smilies[$i]['smile_url']); 
            $total_smilies = $total_smilies + intval($all_smilies[$i]['count']);
        }
    }
} 

// Fill Index Table
for ($i = 0; $i < count($all_smilies); $i++)
{
    if ($all_smilies[$i]['status'] == 'new')
    {
        // $sql = "INSERT INTO " . SMILIE_INDEX_TABLE . " (code, smile_url, smile_count) VALUES ('" . str_replace("'", "\\'", $all_smilies[$i]['code']) . "', '" . str_replace("'", "\\'", $all_smilies[$i]['smile_url']) . "', " . intval($all_smilies[$i]['count']) . ")";
        // $core->sql_query($sql, 'Could not generate Smilie Index');
        // echo '<pre>'.var_export($smilies, true).'</pre>';
    }
    else if ($all_smilies[$i]['status'] == 'update')
    {
        $sql = "UPDATE " . SMILIE_INDEX_TABLE . " SET smile_count = " . intval($all_smilies[$i]['count']) . " WHERE smile_url = '" . $all_smilies[$i]['smile_url'] . "'";
        $core->sql_query($sql, 'Could not update Smilie Index');
    }
}

if ( ($last_post_index != -1) && (!empty($last_post_update)) )
{
    $core->sql_query($last_post_update, 'Could not update last_post_id');
}

// Sort array 
$all_smilies = $core->sort_data($all_smilies, 'count', 'DESC');
$limit = ( $core->return_limit > count($all_smilies) ) ? count($all_smilies) : $core->return_limit; 

$content->init_math('count', $all_smilies[0]['count'], $total_smilies);
$core->set_data($all_smilies, $limit);

$core->make_global(array(
    '$board_config')
);

$core->define_view('set_rows', array(
    '$core->pre_defined()',
    '$core->data(\'count\')',
    '$core->generate_image_link($board_config[\'smilies_path\'] . \'/\' . $core->data(\'smile_url\'), $core->data(\'smile_url\'), \'border="0"\')',
    '$core->data(\'code\')',
    '$core->pre_defined()',
    '$core->pre_defined()')
);

$core->run_module();

?>