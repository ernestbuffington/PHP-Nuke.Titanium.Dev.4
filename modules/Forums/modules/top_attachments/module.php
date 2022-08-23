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
// Top Attachments
//
$core->start_module(true);
$core->set_content('statistical');

//
// Get the user-definable variables
// -- exclude_images (TRUE/FALSE)
$user_variables = $core->get_user_defines();
$exclude_images = intval($user_variables['exclude_images']);

$core->set_view('rows', $core->return_limit);
$core->set_view('columns', 7);

$core->define_view('set_columns', array(
    $core->pre_defined('rank'),
    'filename' => $lang['Filename'],
    'filecomment' => $lang['Filecomment'],
    'size' => $lang['Size'],
    'downloads' => $lang['Downloads'],
    'posttime' => $lang['Posttime'],
    'posttopic' => $lang['Posted_in_topic'])
);

$core->set_header($lang['module_name']);

$core->assign_defined_view('width_rows', array(
    '10%',
    '20%',
    '20%',
    '10%',
    '5%',
    '15%',
    '20%')
);

$attachment_mod_installed = ( isset($attach_config) ) ? TRUE : FALSE;
$attachment_version = ($attachment_mod_installed) ? ATTACH_VERSION : '';
if ($attachment_version == '')
{
    $attachment_version = $attach_config['attach_version'];
}

if ( !$attachment_mod_installed )
{
    message_die(GENERAL_MESSAGE, "The Attachment Mod have to be installed in order to see the Top Downloaded Attachments.");
}

if ( (!strstr($attachment_version, '2.4.')) )
{
    message_die(GENERAL_MESSAGE, 'Wrong Attachment Mod Version detected.<br />Please update your Attachment Mod (V' . $attachment_version . ') to at least Version 2.3.0.');
}

$language = $board_config['default_lang'];

if( !file_exists($phpbb_root_path . 'language/lang_' . $language . '/lang_admin_attach.'.$phpEx) )
{
    $language = $attach_config['board_lang'];
}

include($phpbb_root_path . 'language/lang_' . $language . '/lang_admin_attach.' . $phpEx);

$order_by = 'download_count DESC LIMIT ' . $core->return_limit;

$sql = "SELECT a.post_id, p.forum_id as post_forum_id, t.topic_title, d.*
FROM " . ATTACHMENTS_TABLE . " a, " . ATTACHMENTS_DESC_TABLE . " d, "  . POSTS_TABLE . " p, " . TOPICS_TABLE . " t
WHERE (a.post_id = p.post_id) AND (p.topic_id = t.topic_id) AND (a.attach_id = d.attach_id)";

if ($exclude_images)
{
    $sql .= " AND d.mimetype NOT LIKE '%image%'";
}

$sql .= " ORDER BY " . $order_by;

$result = $core->sql_query($sql, 'Couldn\'t query attachments');

$attachments = $core->sql_fetchrowset($result);
$num_attachments = $core->sql_numrows($result);

$data = array();

for ($i = 0; $i < $num_attachments; $i++)
{
    // filename_link
    $data[$i]['filename_link'] = '';

    $filename = trim($attachments[$i]['real_filename']);
    $filename_2 = '';

    if (strlen($filename) > 22)
    {
        $filename_2 = substr($filename, 0, 20) . '...';
    }

    $view_attachment = append_sid('download.' . $phpEx . '?id=' . $attachments[$i]['attach_id']);
    $data[$i]['filename_link'] = ($filename_2 != '') ? '<a href="' . $view_attachment . '" class="gen" title="' . $filename . '" target="_blank">' . $filename_2 . '</a>' : '<a href="' . $view_attachment . '" class="gen" target="_blank">' . $filename . '</a>';

    // comment_field
    $data[$i]['comment_field'] = '';

    $comment = trim($attachments[$i]['comment']);
    $comment_2 = '';

    if (strlen($comment) > 22)
    {
        $comment_2 = substr($comment, 0, 20) . '...';
    }

    $data[$i]['comment_field'] = ($comment_2 != '') ? '<span title="' . $comment . '">' . $comment_2 . '</span>' : $comment;

    // size
    $data[$i]['size'] = intval($attachments[$i]['filesize']);

    if ($data[$i]['size'] >= 1048576)
    {
        $data[$i]['size'] = round($data[$i]['size'] / 1048576 * 100) / 100 . ' ' . $lang['MB'];
    }
    else if ($data[$i]['size'] >= 1024)
    {
        $data[$i]['size'] = round($data[$i]['size'] / 1024 * 100) / 100 . ' ' . $lang['KB'];
    }
    else
    {
        $data[$i]['size'] = $data[$i]['size'] . ' ' . $lang['Bytes'];
    }

    // Download Count
    $data[$i]['download_count'] = intval($attachments[$i]['download_count']);

    // Post Time
    $data[$i]['post_time'] = create_date($board_config['default_dateformat'], intval($attachments[$i]['filetime']), $board_config['board_timezone']);

    // Topic Title
    $data[$i]['topic_title'] = '';

    $topic_title = trim($attachments[$i]['topic_title']);
    $topic_title_2 = '';

    if (strlen($topic_title) > 22)
    {
        $topic_title_2 = substr($topic_title, 0, 20) . '...';
    }

    $view_topic = append_sid('viewtopic.' . $phpEx . '?' . POST_POST_URL . '=' . intval($attachments[$i]['post_id']) . '#' . intval($attachments[$i]['post_id']));

    $data[$i]['topic_title'] = ($topic_title_2 != '') ? '<a href="' . $view_topic . '" class="gen" title="' . $topic_title . '" target="_blank">' . $topic_title_2 . '</a>' : '<a href="' . $view_topic . '" class="gen" target="_blank">' . $topic_title . '</a>';

    $data[$i]['forum_id'] = intval($attachments[$i]['post_forum_id']);
}

$core->set_data($data);

$core->define_view('set_rows', array(
    '$core->pre_defined()',
    '$core->data(\'filename_link\')',
    '$core->data(\'comment_field\')',
    '$core->data(\'size\')',
    '$core->data(\'download_count\')',
    '$core->data(\'post_time\')',
    '$core->data(\'topic_title\')'
    ),
    array(
        '$core->data(\'forum_id\')', 'auth_read AND auth_download', 'forum', array(
            '',
            '$lang[\'Not_available\']',
            '$lang[\'Not_available\']',
            '$core->data(\'size\')',
            '$core->data(\'download_count\')',
            '$core->data(\'post_time\')',
            '$lang[\'Hidden_from_public_view\']'
        )
    )
);

$core->run_module();

?>