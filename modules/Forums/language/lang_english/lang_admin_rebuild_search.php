<?php

/***************************************************************************
 *                       lang_admin_rebuild_search.php [English]
 *                       ---------------------------------------
 *     begin                : Mon Aug 22 2005
 *     copyright            : (C) 2001 The phpBB Group
 *     email                : support@phpbb.com
 *
 *     $Id: lang_admin_rebuild_search.php,v 2.4.0.0 2006/06/17 18:38:17 chatasos Exp $
 *
 ****************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

$titanium_lang['Rebuild_search'] = 'Rebuild Search';
$titanium_lang['Rebuild_search_desc'] = 'This mod will index every post in your forum, rebuilding the search tables.
You can stop whenever you like and the next time you run it again you\'ll have the option of continuing from where you left off.<br /><br />
It may take a long time to show its progress (depending on "Posts per cycle" and "Time limit"),
so please do not move from its progress page until it is complete, unless of course you want to interrupt it.';

//
// Input screen
//
$titanium_lang['Starting_post_id'] = 'Starting post_id';
$titanium_lang['Starting_post_id_explain'] = 'First post where processing will begin from<br />You can choose to start from the beginning or from the post you last stopped';

$titanium_lang['Start_option_beginning'] = 'start from beginning';
$titanium_lang['Start_option_continue'] = 'continue from last stopped';

$titanium_lang['Clear_search_tables'] = 'Clear search tables';
$titanium_lang['Clear_search_tables_explain'] = 'When you start from the beginning you can clear the 3 phpBB search tables<br />You have the option of choosing between the DELETE/TRUNCATE methods';
$titanium_lang['Clear_search_no'] = 'NO';
$titanium_lang['Clear_search_delete'] = 'DELETE';
$titanium_lang['Clear_search_truncate'] = 'TRUNCATE';

$titanium_lang['Num_of_posts'] = 'Number of posts';
$titanium_lang['Num_of_posts_explain'] = 'Number of total posts to process<br />It\'s automatically filled with the number of total/remaining posts found in the db';

$titanium_lang['Posts_per_cycle'] = 'Posts per cycle';
$titanium_lang['Posts_per_cycle_explain'] = 'Number of posts to process per cycle<br />Keep it low to avoid php/webserver timeouts';

$titanium_lang['Refresh_rate'] = 'Refresh rate';
$titanium_lang['Refresh_rate_explain'] = 'How much time (secs) to stay idle before moving to next processing cycle<br />Usually you don\'t have to change this';

$titanium_lang['Time_limit'] = 'Time limit';
$titanium_lang['Time_limit_explain'] = 'How much time (secs) post processing can last before moving to next cycle';
$titanium_lang['Time_limit_explain_safe'] = '<i>Your php (safe mode) has a timeout of %s secs configured, so stay below this value</i>';
$titanium_lang['Time_limit_explain_webserver'] = '<i>Your webserver has a timeout of %s secs configured, so stay below this value</i>';

$titanium_lang['Disable_board'] = 'Disable board';
$titanium_lang['Disable_board_explain'] = 'Whether or not to disable your board while processing';
$titanium_lang['Disable_board_explain_enabled'] = 'It will be enabled automatically after the end of processing';
$titanium_lang['Disable_board_explain_already'] = '<i>Your board is already disabled through the admin configuration</i>';

$titanium_lang['Fast_mode'] = 'Fast mode';
$titanium_lang['Fast_mode_explain'] = 'Process the whole db without removing entries first<br />Use with caution!!! Please read the instructions for details.';

$titanium_lang['Max_info'] = '(Max : %d)';

//
// Information strings
//
$titanium_lang['Info_processing_stopped'] = 'You last stopped the processing at post_id %s (%s processed posts) on %s';
$titanium_lang['Info_processing_aborted'] = 'You last aborted the processing at post_id %s (%s processed posts) on %s';
$titanium_lang['Info_processing_aborted_soon'] = 'Please wait a little before you continue...';
$titanium_lang['Info_processing_finished'] = 'You successfully finished the processing (%s processed posts) on %s';
$titanium_lang['Info_processing_finished_new'] = 'You successfully finished the processing at post_id %s (%s processed posts) on %s,<br />but there have been %s new post(s) after that date';

//
// Progress screen
//
$titanium_lang['Rebuild_search_progress'] = 'Rebuild Search Progress';

$titanium_lang['Processed_post_ids'] = 'Processed post ids : %s - %s';
$titanium_lang['Timer_expired'] = 'Timer expired at %s secs. ';
$titanium_lang['Cleared_search_tables'] = 'Cleared search tables. ';
$titanium_lang['Deleted_posts'] = '%s post(s) were deleted by your users during processing. ';
$titanium_lang['Processing_next_posts'] = 'Processing next %s post(s). Please wait...';
$titanium_lang['All_session_posts_processed'] = 'Processed all posts in current session.';
$titanium_lang['All_posts_processed'] = 'All posts were processed successfully.';
$titanium_lang['All_tables_optimized'] = 'All search tables were optimized successfully.';

$titanium_lang['Processing_post_details'] = 'Processing post details';
$titanium_lang['Processed_posts'] = 'Processed Posts';
$titanium_lang['Percent'] = 'Percent';
$titanium_lang['Current_session'] = 'Current Session';
$titanium_lang['Total'] = 'Total';

$titanium_lang['Process_details'] = 'from <b>%s</b> to <b>%s</b> (out of total <b>%s</b>)';
$titanium_lang['Percent_completed'] = '%s %% completed';

$titanium_lang['Processing_time_details'] = 'Processing time details';
$titanium_lang['Processing_time'] = 'Processing time';
$titanium_lang['Time_last_posts'] = 'Last %s post(s) of current session';
$titanium_lang['Time_from_the_beginning'] = 'From the beginning of current session';
$titanium_lang['Time_average'] = 'Average per cycle of current session';
$titanium_lang['Time_estimated'] = 'Estimated until finish of current session';

$titanium_lang['days'] = 'days';
$titanium_lang['hours'] = 'hours';
$titanium_lang['minutes'] = 'minutes';
$titanium_lang['seconds'] = 'seconds';

$titanium_lang['Database_size_details'] = 'Database size details';
$titanium_lang['Size_current'] = 'Current';
$titanium_lang['Size_estimated'] = 'Estimated after finish';
$titanium_lang['Size_search_tables'] = 'Search Tables size';
$titanium_lang['Size_database'] = 'Database size';

$titanium_lang['Bytes'] = 'Bytes';

$titanium_lang['Active_parameters'] = 'Active parameters';
$titanium_lang['Posts_last_cycle'] = 'Processed post(s) on last cycle';
$titanium_lang['Board_status'] = 'Board status';
$titanium_lang['Board_disabled'] = 'Disabled';
$titanium_lang['Board_enabled'] = 'Enabled';

$titanium_lang['Info_estimated_values'] = '(*) All the estimated values are calculated approximately<br />
      based on the current completed percent and may not represent the actual final values.<br />
      As the completed percent increases the estimated values will come closer to the actual ones.';

$titanium_lang['Click_return_rebuild_search'] = 'Click %shere%s to return to Rebuild Search';
$titanium_lang['Rebuild_search_aborted'] = 'Rebuild search aborted at post_id %s.<br /><br />If you aborted while processing was on, you have to wait a little before you run Rebuild Search again, so the last cycle can finish.';
$titanium_lang['Wrong_input'] = 'You have entered some wrong values. Please check your input and try again.';

// Buttons
$titanium_lang['Next'] = 'Next';
$titanium_lang['Processing'] = 'Processing...';
$titanium_lang['Finished'] = 'Finished';

?>