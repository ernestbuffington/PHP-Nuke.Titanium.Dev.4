<h1>{L_REPUTATION_CONFIG_TITLE}</h1>

<p>{L_REPUTATION_CONFIG_EXPLAIN}</p>

<form action="{S_CONFIG_ACTION}" method="post"><table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
  <tr>
    <th class="thHead" colspan="2">{L_REPUTATION_CONFIG_TITLE}</th>
  </tr>
  <tr>
    <td width="100" class="row1" title="$rep_config['rep_disable']">{L_DISABLE_REP_SYSTEM}</td>
    <td class="row2" title="$rep_config['rep_disable']"><input type="radio" name="rep_disable" value="1" {S_DISABLE_REP_SYSTEM_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="rep_disable" value="0" {S_DISABLE_REP_SYSTEM_NO} /> {L_NO}</td>
  </tr>
  <tr>
    <td class="row1" title="$rep_config['graphic_version']">{L_GRAPHIC_VERSION}</td>
    <td class="row2" title="$rep_config['graphic_version']"><input type="radio" name="graphic_version" value="1" {S_GRAPHIC_VERSION_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="graphic_version" value="0" {S_GRAPHIC_VERSION_NO} /> {L_NO}</td>
  </tr>
  <tr>
    <td class="row1" title="$rep_config['show_stats_to_mods']">{L_SHOW_STATS_TO_MODS}<br /></td>
    <td class="row2" title="$rep_config['show_stats_to_mods']"><input type="radio" name="show_stats_to_mods" value="1" {S_SHOW_STATS_TO_MODS_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="show_stats_to_mods" value="0" {S_SHOW_STATS_TO_MODS_NO} /> {L_NO}</td>
  </tr>
  <tr>
    <td class="row1" title="$rep_config['pm_notify']">{L_PM_NOTIFY}<br /></td>
    <td class="row2" title="$rep_config['pm_notify']"><input type="radio" name="pm_notify" value="1" {S_PM_NOTIFY_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="pm_notify" value="0" {S_PM_NOTIFY_NO} /> {L_NO}</td>
  </tr>
  <tr>
    <td valign="middle" class="row1" title="$rep_config['default_amount']">{L_DEFAULT_AMOUNT}<br /></td>
    <td class="row2" title="$rep_config['default_amount']"><input class="post" type="text" maxlength="255" size="5" name="default_amount" value="{DEFAULT_AMOUNT}" /></td>
  </tr>
  <tr>
    <td class="row1" title="$rep_config['posts_to_earn']">{L_POSTS_TO_EARN}<br /></td>
    <td class="row2" title="$rep_config['posts_to_earn']"><input class="post" type="text" maxlength="255" size="5" name="posts_to_earn" value="{POSTS_TO_EARN}" /></td>
  </tr>
  <tr>
    <td class="row1" title="$rep_config['days_to_earn']">{L_DAYS_TO_EARN}<br /></td>
    <td class="row2" title="$rep_config['days_to_earn']"><input class="post" type="text" maxlength="255" size="5" name="days_to_earn" value="{DAYS_TO_EARN}" /></td>
  </tr>
  <tr>
    <td class="row1" title="$rep_config['flood_control_time']">{L_FLOOD_CONTROL_TIME}<br /></td>
    <td class="row2" title="$rep_config['flood_control_time']"><input class="post" type="text" maxlength="255" size="5" name="flood_control_time" value="{FLOOD_CONTROL_TIME}" /></td>
  </tr>
  <tr>
    <td valign="middle" class="row1" title="$rep_config['medal1_to_earn']">{L_MEDAL1_TO_EARN}&nbsp;&nbsp;&nbsp;<img src="../images/reputation_medal_size_1.gif" alt="" border="0" align="middle"><br /></td>
    <td class="row2" title="$rep_config['medal1_to_earn']"><input class="post" type="text" maxlength="255" size="5" name="medal1_to_earn" value="{MEDAL1_TO_EARN}" /></td>
  </tr>
  <tr>
    <td valign="middle" class="row1" title="$rep_config['medal2_to_earn']">{L_MEDAL2_TO_EARN}&nbsp;&nbsp;&nbsp;<img src="../images/reputation_medal_size_2.gif" alt="" border="0" align="middle"><br /></td>
    <td class="row2" title="$rep_config['medal2_to_earn']"><input class="post" type="text" maxlength="255" size="5" name="medal2_to_earn" value="{MEDAL2_TO_EARN}" /></td>
  </tr>
  <tr>
    <td valign="middle" class="row1" title="$rep_config['medal3_to_earn']">{L_MEDAL3_TO_EARN}&nbsp;&nbsp;&nbsp;<img src="../images/reputation_medal_size_3.gif" alt="" border="0" align="middle"><br /></td>
    <td class="row2" title="$rep_config['medal3_to_earn']"><input class="post" type="text" maxlength="255" size="5" name="medal3_to_earn" value="{MEDAL3_TO_EARN}" /></td>
  </tr>
  <tr>
    <td valign="middle" class="row1" title="$rep_config['medal4_to_earn']">{L_MEDAL4_TO_EARN}&nbsp;&nbsp;&nbsp;<img src="../images/reputation_medal_size_4.gif" alt="" border="0" align="middle"><br /></td>
    <td class="row2" title="$rep_config['medal4_to_earn']"><input class="post" type="text" maxlength="255" size="5" name="medal4_to_earn" value="{MEDAL4_TO_EARN}" /> <img src="../images/spacer.gif" alt="" width="100" height="1" border="0"></td>
  </tr>
  <tr>
    <td valign="middle" class="row1" title="$rep_config['given_rep_to_earn']">{L_GIVEN_REP_TO_EARN}<br /></td>
    <td class="row2" title="$rep_config['given_rep_to_earn']"><input class="post" type="text" maxlength="255" size="5" name="given_rep_to_earn" value="{GIVEN_REP_TO_EARN}" /></td>
  </tr>
  <tr>
    <td valign="middle" class="row1" title="$rep_config['repsum_limit']">{L_REPSUM_LIMIT}<br /></td>
    <td class="row2" title="$rep_config['repsum_limit']"><input class="post" type="text" maxlength="255" size="5" name="repsum_limit" value="{REPSUM_LIMIT}" /></td>
  </tr>
  <tr>
    <td class="catBottom" colspan="2" align="center">{S_HIDDEN_FIELDS}<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" class="liteoption" />
    </td>
  </tr>
</table></form>

<br clear="all" />