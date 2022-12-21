<?php
/***************************************************************************
 *                            functions_mg_ranks.php
 *                            ---------------------
 *   begin                : 2005/08/31
 *   last modified        : 12/16/2022 Ernest Allen Buffington
 *   copyright            : Mighty Gorgon (Luca Libralato)
 *   website              : http://www.mightygorgon.com
 *   email                : mightygorgon@mightygorgon.com
 *   current version      : 4.0.3
  ***************************************************************************/
/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/
function query_ranks()
{
	global $db;

	$sql = "SELECT ban_userid FROM ".BANLIST_TABLE." ORDER BY ban_userid ASC";
	if(!($result = $db->sql_query($sql)))
	message_die(GENERAL_ERROR, "Could not obtain banned users information.", '', __LINE__, __FILE__, $sql);
	
	$ranks_sql = [];
	$ranks_sql['bannedrow'][] = $db->sql_fetchrowset($result);
	$db->sql_freeresult($result);

	$sql = "SELECT * FROM ".RANKS_TABLE." ORDER BY rank_special ASC, rank_min ASC";

	if(!($result = $db->sql_query($sql)))
	message_die(GENERAL_ERROR, "Could not obtain ranks information.", '', __LINE__, __FILE__, $sql);

	while($row = $db->sql_fetchrow($result)):
	$ranks_sql['ranksrow'][] = $row;
	endwhile;
	$db->sql_freeresult($result);

	return $ranks_sql;
}


function generate_ranks($user_row, $ranks_sql)
{
	$user_fields_array = ['user_rank', 'user_rank2', 'user_rank3', 'user_rank4', 'user_rank5'];
	$user_ranks_array = ['rank_01', 'rank_01_img', 'rank_02', 'rank_02_img', 'rank_03', 'rank_03_img', 'rank_04', 'rank_04_img', 'rank_05', 'rank_05_img'];
	$user_ranks = [];
	
	$is_banned = false;
	$is_guest = false;
	$rank_sw = false;

	foreach (array_keys($user_ranks_array) as $j) {
     $user_ranks[$user_ranks_array[$j]] = '';
 }

	if($user_row['user_id'] == '-1')
	$is_guest = true;

	if ($is_guest == false) {
     $itemsCount = is_countable($ranks_sql['bannedrow']) ? count($ranks_sql['bannedrow']) : 0;
     for($j = 0; $j < $itemsCount; $j++):
			//if($ranks_sql['bannedrow'][$j]['ban_userid'] == $user_row['user_id'] )
			if(isset($ranks_sql['bannedrow'][$j]['ban_userid']) ? $user_row['user_id'] : 0)
   		    $is_banned = true;
   		endfor;
 }
    $itemsCount = is_countable($ranks_sql['ranksrow']) ? count($ranks_sql['ranksrow']) : 0;

	for($j = 0; $j < $itemsCount; $j++):
	
		$rank_tmp = $ranks_sql['ranksrow'][$j]['rank_title'];
		$rank_img_tmp = ( $ranks_sql['ranksrow'][$j]['rank_image'] ) ? '<img class="forum-ranks" src="modules/Forums/' 
		. $ranks_sql['ranksrow'][$j]['rank_image'] . '" alt="' . $rank_tmp . '" title="' . $rank_tmp . '" border="0" />' : '';
		
		if($is_guest == true):
			if ($ranks_sql['ranksrow'][$j]['rank_special'] == '2'):
				$user_ranks['rank_01'] = $rank_tmp;
				$user_ranks['rank_01_img'] = $rank_img_tmp;
			endif;
		elseif($is_banned == true):
			if($ranks_sql['ranksrow'][$j]['rank_special'] == '3'):
				$user_ranks['rank_01'] = $rank_tmp;
				$user_ranks['rank_01_img'] = $rank_img_tmp;
			endif;
		else:
		
			$day_diff = (int) ((time() - (int) $user_row['user_regdate']) / 86400);

			foreach ($user_fields_array as $k => $singleUser_fields_array) {
       switch($ranks_sql['ranksrow'][$j]['rank_special']):
   					case '1':
   						if($user_row[$singleUser_fields_array] == $ranks_sql['ranksrow'][$j]['rank_id'])
   						$rank_sw = true;
   						break;
   					case '0':
   						if(($user_row[$singleUser_fields_array] == '0') && ($user_row['user_posts'] >= $ranks_sql['ranksrow'][$j]['rank_min']))
   						$rank_sw = true;
   						break;
   					case '-1':
   						if(($user_row[$singleUser_fields_array] == '-1') && ($day_diff >= $ranks_sql['ranksrow'][$j]['rank_min']))
   						$rank_sw = true;
   						break;
   					default:
   						break;
   				endswitch;
                
				if ($rank_sw == true):
   					$user_ranks[$user_ranks_array[(($k + 1) * 2) - 2]] = $rank_tmp;
   					$user_ranks[$user_ranks_array[(($k + 1) * 2) - 1]] = $rank_img_tmp;
   					$rank_sw = false;
   				endif;
   }

		endif;
	endfor;

	return $user_ranks;
}

?>
