<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************
   Nuke-Evolution: Advanced Content Management System
   ============================================
   Copyright (c) 2006 by The Nuke-Evolution Team

   Filename      : block-Top_Posters.php
   Author        : NXP (http://www.nxproject.com)
   Ported by     : DrAg0n (http://www.evo-mods.com)
   Version       : 1.1.0
   Created on    : 06/26/2005 (mm-dd-yyyy)
   Ported on     : 02/12/2006 (mm-dd-yyyy)
   Notes         : Top Posters block shows the members with the
                   most posts in your forum.
************************************************************************/

if ( !defined('BLOCK_FILE') ) {
    Header("Location: ../index.php");
    exit;
}

global $user, $prefix, $db, $nxp_toppost_post, $nxp_toppost_poin;

$nxp_toppost_config = array(
     'show_mini' => 5, //number of members to show in block, default=5
     'show_maxi' => 15, //number of members to show in block after a sort order is clicked, default=15
     'name_maxi' => 15, //maximum characters to show of the username, default=15
     'show_avat' => 1, //show avatar on(1)/off(0), default=1
     'show_flag' => 1, //show flag on(1)/off(0), default=1 (must have flags in /images/flags directory )
     'show_link' => 1,
     );

// Setup Rank Arrays for later to match ranks ------------------------------------------|
$Q00 = "SELECT rank_id, rank_title 
	FROM " . $prefix . "_bbranks
	WHERE rank_special = 1 
	ORDER BY rank_id ASC";
$R00 = $db->sql_query($Q00);
while($special_rank_info = $db->sql_fetchrow($R00))
{
	$nxp_toppost_rank_spec[] = $special_rank_info;
}

$Q01 = "SELECT rank_id, rank_title, rank_min 
	FROM " . $prefix . "_bbranks
	WHERE rank_special = 0
	ORDER BY rank_min ASC";
$R01 = $db->sql_query($Q01);
while($normal_rank_info = $db->sql_fetchrow($R01))
{
	$nxp_toppost_rank_norm[] = $normal_rank_info;
}

if (intval($nxp_toppost_post) == 1)
{
	$nxp_toppost_show_numb = $nxp_toppost_config["show_maxi"];
	$nxp_toppost_order_by  = "user_posts DESC";
}
elseif (intval($nxp_toppost_poin) == 1)
{
	$nxp_toppost_show_numb = $nxp_toppost_config["show_maxi"];
	$nxp_toppost_order_by  = "user_points DESC";
}
else
{
	$nxp_toppost_show_numb = $nxp_toppost_config["show_mini"];
	$nxp_toppost_order_by  = "user_posts DESC";
}

// Start The Content For The Block -----------------------------------------------------|
	$content .= "<table border='0' width='100%' cellpadding='0' cellspacing='0'>\n";

if ($nxp_toppost_config["show_link"] == 1)
{
	$content .= " <tr>\n";
	$content .= " <td align='center' valign='middle' colspan='2' height='7'>\n";
	$content .= "	</tr>\n";
	$content .= "	<tr>\n";
	$content .= "		<td align='left' valign='middle' colspan='2' height='7'>\n";
	$content .= "			<hr widht='100%' height='5'></td>\n";
	$content .= "	</tr>\n";
}

$nxp_toppost_count = 1;

$Q02 = "SELECT user_id, username, user_avatar, user_from, user_from_flag, user_posts, user_rank FROM " . $prefix . "_users WHERE `user_id` != ".ANONYMOUS." ORDER BY " . $nxp_toppost_order_by . " LIMIT 0," . $nxp_toppost_show_numb;
$R02 = $db->sql_query($Q02);
while($nxp_toppost_user_info = $db->sql_fetchrow($R02))
{
	// Unset all common variables --------------------------------------------------|
	unset($nxp_toppost_name, $nxp_toppost_avat, $nxp_toppost_from_imag, $nxp_toppost_rank_titl);	
	
	// Sort Out Username and Shorten If Longer thant $name_max ---------------------|
	if (strlen($nxp_toppost_user_info["username"]) > $nxp_toppost_config["name_maxi"])
	{
		$nxp_toppost_name = substr($nxp_toppost_user_info["username"], 0, $nxp_toppost_config["name_maxi"] - 1) . "&hellip;";
	}
	else
	{
		$nxp_toppost_name = $nxp_toppost_user_info["username"];
	}	
	
	// Sort Out Avatar -------------------------------------------------------------|
	if ($nxp_toppost_config["show_avat"] == 1)
	{
		if ($nxp_toppost_user_info['user_avatar'] == "") 
		{
			$nxp_toppost_avat = "modules/Forums/images/avatars/noimage.gif";
		}
		elseif (preg_match("#http://#i", $nxp_toppost_user_info['user_avatar'])) 
		{
			$nxp_toppost_avat = $nxp_toppost_user_info['user_avatar'];
		}
		else
		{
			$nxp_toppost_avat = "modules/Forums/images/avatars/" . $nxp_toppost_user_info['user_avatar'];
		}
	}
	
	// Sort Out Flag Image ---------------------------------------------------------|
	// $flag_path = "images/flags";
	
	if ($nxp_toppost_config["show_flag"] == 1)
	{		
		// unset($flag_info, $flag_file);
		
		// $flag_show = "images/blank.png";
		// $flag_name = "";
		
		// $flag_info = explode(", ", $nxp_toppost_user_info['user_from']);
		
		// for ($i = (count($flag_info) - 1); $i >= 0; $i = $i - 1)
		// {
		// 	$flag_file .= "/" . str_replace(" ", "_", ucwords( strtolower($flag_info[$i]) ));
		// }

		// $flag_file .= ".gif";

		// if (file_exists($flag_path . $flag_file))
		// {
		// 	$flag_show = $flag_path . $flag_file;
		// 	$flag_name = $nxp_toppost_user_info['user_from'];
			
		// 	$nxp_toppost_from_imag = "<img src='" . $flag_show . "' width='17' height='11' alt='" . ucwords( str_replace("_", " ", $flag_name) ) . "'>";
		// }	
		// else
		// {
		// 	$nxp_toppost_from_imag = "<img src='images/blank.png' width='17' height='11'>";
		// }
		$user_flag 		= str_replace('.png','',$nxp_toppost_user_info['user_from_flag']);
        if ($nxp_toppost_user_info['user_from_flag']):
            $nxp_toppost_from_imag      = '<span class="countries '.$user_flag.'"'.(($nxp_toppost_user_info['user_from']) ? 'title="'.$nxp_toppost_user_info['user_from'].'"' : '').'></span>';
        else:
            $nxp_toppost_from_imag      = '<span class="countries unknown"></span>';
        endif;			
	}
	
	// Sort Out Rank Title ---------------------------------------------------------|
	$cur_user_rank  = intval($nxp_toppost_user_info['user_rank']);
	$cur_user_posts = intval($nxp_toppost_user_info['user_posts']);

	if ($cur_user_rank != 0)
	{
		$i = 0;
		while($nxp_toppost_rank_spec[$i][0] != "")
		{
			if ($nxp_toppost_rank_spec[$i][0] == $cur_user_rank)
			{
				$nxp_toppost_rank_titl = $nxp_toppost_rank_spec[$i][1];
				break;
			}
			$i++;
		}
	}
	elseif ($cur_user_rank == 0)
	{
		$i = 0;
		while($nxp_toppost_rank_norm[$i][0] != "")
		{
			$j = $i + 1;
			
			if ($cur_user_posts >= $nxp_toppost_rank_norm[$i][2] && $cur_user_posts < $nxp_toppost_rank_norm[$j][2])
			{
				$nxp_toppost_rank_titl = $nxp_toppost_rank_norm[$i][1];
				break;
			}
			$i++;
		}	
	} 
	else
	{
		$nxp_toppost_rank_titl = "Unknown Rank";
	}
	
	$tpresult = $db->sql_query("SELECT * FROM ". $prefix ."_bbadvanced_username_color WHERE group_name='$nxp_toppost_rank_titl'");
	$rowrank = $db->sql_fetchrow($tpresult);
	
	$content .= "	<tr>\n";
	$content .= "		<td align='left' valign='top' width='38' rowspan='4'>\n";
	$content .= "			<a href='modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=" . intval($nxp_toppost_user_info['user_id']) . "'>\n";
	$content .= "				<img class='rounded-corners-profile' src='" . $nxp_toppost_avat . "' border='0' width='32'></a></td>";
	$content .= "		<td align='left' valign='middle'>\n";
	$content .= "			<table border='0' width='100%' cellpadding='0' cellspacing='0'>\n";
	$content .= "				<tr class='even' valign='middle'>\n";
	$content .= "					<td align='left' valign='middle' width='100%' rowspan='2'>\n";
	$content .= "						<a href='modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=" . intval($nxp_toppost_user_info['user_id']) . "'>\n";
	$content .= "							<b>" . UsernameColor($nxp_toppost_name) . "</b></a></td>\n";
	$content .= "					<td align='right' valign='middle'>\n";
	$content .= "						" . $nxp_toppost_from_imag . "</td>\n";
	$content .= "				</tr>\n";
	$content .= "			</table>";
	$content .= "		</td>\n";
	$content .= "	</tr>\n";
	$content .= "	<tr>\n";
	$content .= "		<td align='left' valign='middle'>\n";
	$content .= "			<table border='0' width='100%' cellpadding='0' cellspacing='0'>\n";
	$content .= "				<tr class='even' valign='middle'>\n";
	$content .= "					<td align='left'  valign='middle' width='36'>\n";
	$content .= "						<a href='modules.php?name=Forums&amp;file=search&amp;search_author=" . trim($nxp_toppost_user_info['username']) . "'>Posts:</a></td>";
	$content .= "					<td valign='middle'>\n";
	$content .= "						" . number_format(intval($nxp_toppost_user_info['user_posts']), 0) . "</td>\n";
	$content .= "				</tr>\n";
	$content .= "			</table>";
	$content .= "		</td>\n";
	$content .= "	</tr>\n";
	$content .= "	<tr>\n";
	$content .= "		<td align='left' valign='middle'>\n";
	$content .= "			<font color=\"".$rowrank['group_color']."\"><i>".$nxp_toppost_rank_titl."</i></font></a></td>\n";	
	$content .= "	</tr>\n";

	if ($nxp_toppost_count != $nxp_toppost_show_numb)
	{
		$content .= "	<tr>\n";
		$content .= "		<td align='left' valign='middle' colspan='2' height='7'>\n";
		$content .= "			<hr widht='100%' height='5'></td>\n";
		$content .= "	</tr>\n";
	}
	
	$nxp_toppost_count++;
}

	$content .= "	<tr>\n";
	$content .= "		<form name='nxp_top_poster' action='http://nxproject.com/' method='get'>\n";
	$content .= "		<input type='hidden' name='ref_from_block' value='nxp_top_poster_v1.10'>\n";
	$content .= "		<td align='right' valign='bottom' colspan='2'>\n";
	$content .= "			<nobr><a style='text-decoration:none;' href='#' onclick='document.nxp_top_poster.submit();' onMouseover='window.status=\"\"; return true;' onMouseOut='window.status=\"\";'>\n";
	$content .= "				<span class='gensmall'>&copy; NXP</span></nobr></a></td>\n";
	$content .= "		</form>\n";
	$content .= "	</tr>\n";
	$content .= "</table>";
?>