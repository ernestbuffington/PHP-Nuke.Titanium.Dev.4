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

/*****[CHANGES]**********************************************************
-=[Mod]=-
      Smilies in Topic Titles                  v1.0.0       09/02/2005
 ************************************************************************/

if (!defined('IN_PHPBB'))
{
    die('Hacking attempt');
}

//
// Most Interesting Topics
//

$core->start_module(true);

$core->set_content('statistical');

$core->set_view('rows', $core->return_limit);
$core->set_view('columns', 3);

$core->define_view('set_columns', array(
    $core->pre_defined('rank'),
    'rate' => $lang['Rate'],
    'topic' => $lang['Topic'])
);

$core->set_header($lang['module_name']);

$core->assign_defined_view('align_rows', array(
    'left',
    'center',
    'left')
);

$core->assign_defined_view('width_rows', array(
    '',
    '20%',
    '')
);

$sql = 'SELECT topic_id, forum_id, topic_title, topic_replies, topic_views, topic_views/(topic_replies + 1) AS k
FROM ' . TOPICS_TABLE . '
WHERE (topic_status <> 2) AND (topic_replies > 0)
ORDER BY k ASC
LIMIT ' . $core->return_limit;

$result = $core->sql_query($sql, 'Couldn\'t retrieve topic data');
$topic_data = $core->sql_fetchrowset($result);

$core->set_data($topic_data);

/*****[BEGIN]******************************************
 [ Mod:     Smilies in Topic Titles            v1.0.0 ]
 ******************************************************/
$core->topic_smiles();
/*****[END]********************************************
 [ Mod:     Smilies in Topic Titles            v1.0.0 ]
 ******************************************************/

//
// Now this one could get a big beast
// We will explain the structure, no fear, but not now. :D
//
$core->define_view('set_rows', array(
    '$core->pre_defined()',
    '$core->data(\'k\')',
    '$core->generate_link(append_sid(\'viewtopic.php?t=\' . $core->data(\'topic_id\')), $core->data(\'topic_title\'), \'target="_blank"\')'
    ),
    array(
        '$core->data(\'forum_id\')', 'auth_view AND auth_read', 'forum', array(
            '',
            '$core->data(\'k\')',
            '$lang[\'Hidden_from_public_view\']'
        )
    )
);

$core->run_module();

?>