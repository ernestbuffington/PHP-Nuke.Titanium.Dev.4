<div class="maintitle">{L_CONFIGURATION_TITLE}</div>
<br />
<p>{L_CONFIGURATION_EXPLAIN}</p>
<form action="{S_CONFIG_ACTION}" method="post">
<table width="99%" cellpadding="3" cellspacing="1" border="0" align="center" class="forumline">
<tr>
<th colspan="2">{L_GENERAL_SETTINGS}</th>
</tr>
<!-- use_category_mod -->
<tr>
<td class="row1" width="38%">{L_USE_CATEGORY_MOD}<br />
<span class="gensmall">{L_USE_CATEGORY_MOD_EXPLAIN}</span>
</td>
<td class="row2" width="62%">
<input type="radio" name="use_category_mod" value="1" {S_USE_CATEGORY_MOD_YES} />
{L_YES}&nbsp;&nbsp;
<input type="radio" name="use_category_mod" value="0" {S_USE_CATEGORY_MOD_NO} />
{L_NO}
</td>
</tr>
<!-- use_fav_category -->
<tr>
<td class="row1" width="38%">{L_USE_FAV_CATEGORY}<br />
<span class="gensmall">{L_USE_FAV_CATEGORY_EXPLAIN}</span>
</td>
<td class="row2" width="62%">
<input type="radio" name="use_fav_category" value="1" {S_USE_FAV_CATEGORY_YES} />
{L_YES}
<input type="radio" name="use_fav_category" value="0" {S_USE_FAV_CATEGORY_NO} />
{L_NO}
</td>
</tr>
<!-- category_preview_games -->
<tr>
<td class="row1" width="38%">{L_CATEGORY_PREVIEW_GAMES}<br />
<span class="gensmall">{L_CATEGORY_PREVIEW_GAMES_EXPLAIN}</span>
</td>
<td class="row2" width="62%">
<input type="text" maxlength="100" size="5" name="category_preview_games" value="{S_CATEGORY_PREVIEW_GAMES}" class="post" />
</td>
</tr>
<!-- games_par_page -->
<tr>
<td class="row1" width="38%">{L_GAMES_PAR_PAGE}<br />
<span class="gensmall">{L_GAMES_PAR_PAGE_EXPLAIN}</span>
</td>
<td class="row2" width="62%">
<input type="text" maxlength="100" size="5" name="games_par_page" value="{S_GAMES_PAR_PAGE}" class="post" />
</td>
</tr>
<!-- game_order -->
<tr>
<td class="row1" width="38%">{L_GAME_ORDER}<br />
<span class="gensmall">{L_GAME_ORDER_EXPLAIN}</span></td>
<td class="row2" width="62%">
<select name='game_order' class="post" >
{S_GAME_ORDER}
</select>
</td>
</tr>
<!-- linkcat_align -->
<tr>
<td class="row1" width="38%">{L_LINKCAT_ALIGN}<br />
<span class="gensmall">{L_LINKCAT_ALIGN_EXPLAIN}</span></td>
<td class="row2" width="62%">
<select name='linkcat_align' class="post" >
{S_LINKCAT_ALIGN}
</select>
</td>
</tr>
<!-- arcade_announcement -->
<tr>
<td class="row1" width="38%">{L_ARCADE_ANNOUNCEMENT}<br />
<span class="gensmall">{L_ARCADE_ANNOUNCEMENT_EXPLAIN}</span></td>
<td align='left' class='row2'>
<textarea NAME='arcade_announcement' class="post" ROWS='2' COLS='60' wrap='virtual'>{S_ARCADE_ANNOUNCEMENT}</textarea>
</td>
</tr>
<tr>
<th colspan="2">{L_GAME_ACCESS_SETTINGS}</th>
</tr>
<!-- limit_by_posts -->
<tr>
<td class="row1" width="38%">{L_LIMIT_BY_POSTS}<br />
<span class="gensmall">{L_LIMIT_BY_POSTS_EXPLAIN}</span>
</td>
<td class="row2" width="62%">
<input type="radio" name="limit_by_posts" value="1" {S_LIMIT_BY_POSTS_YES} />
{L_YES}&nbsp;&nbsp;
<input type="radio" name="limit_by_posts" value="0" {S_LIMIT_BY_POSTS_NO} />
{L_NO}
</td>
</tr>
<!-- limit_type -->
<tr>
<td class="row1" width="38%">{L_LIMIT_TYPE}<br />
<span class="gensmall">{L_LIMIT_TYPE_EXPLAIN}</span>
</td>
<td class="row2" width="62%">
<input type="radio" name="limit_type" value="posts" {S_LIMIT_TYPE_POSTS} />
{L_POSTS_ONLY}<br />
<input type="radio" name="limit_type" value="date" {S_LIMIT_TYPE_DATE} />
{L_POSTS_DATE}
</td>
</tr>
<!-- posts_needed -->
<tr>
<td class="row1" width="38%">{L_POSTS_NEEDED}<br />
<span class="gensmall">{L_POSTS_NEEDED_EXPLAIN}</span>
</td>
<td class="row2" width="62%">
<input type="text" maxlength="100" size="5" name="posts_needed" value="{S_POSTS_NEEDED}" class="post" />
</td>
</tr>
<!-- days_limit -->
<tr>
<td class="row1" width="38%">{L_DAYS_LIMIT}<br />
<span class="gensmall">{L_DAYS_LIMIT_EXPLAIN}</span>
</td>
<td class="row2" width="62%">
<input type="text" maxlength="100" size="5" name="days_limit" value="{S_DAYS_LIMIT}" class="post" />
</td>
</tr>
<tr>
<th colspan="2">{L_GAMES_AREA_SETTINGS}</th>
</tr>
<!-- display_winner_avatar -->
<tr>
<td class="row1" width="38%">{L_DISPLAY_WINNER_AVATAR}<br />
<span class="gensmall">{L_DISPLAY_WINNER_AVATAR_EXPLAIN}</span>
</td>
<td class="row2" width="62%">
<input type="radio" name="display_winner_avatar" value="1" {S_DISPLAY_WINNER_AVATAR_YES} />
{L_YES}&nbsp;&nbsp;
<input type="radio" name="display_winner_avatar" value="0" {S_DISPLAY_WINNER_AVATAR_NO} />
{L_NO}
</td>
</tr>
<tr>
<td class="row1" width="38%">{L_WINNER_AVATAR_POSITION}<br />
<span class="gensmall">{L_WINNER_AVATAR_POSITION_EXPLAIN}</span>
</td>
<td class="row2" width="62%">
<input type="radio" name="winner_avatar_position" value="left" {S_WINNER_AVATAR_LEFT} />
{L_LEFT}<br />
<input type="radio" name="winner_avatar_position" value="right" {S_WINNER_AVATAR_RIGHT} />
{L_RIGHT}
</td>
</tr>
<!-- maxsize_avatar -->
<tr>
<td class="row1" width="38%">{L_MAXSIZE_AVATAR}<br />
<span class="gensmall">{L_MAXSIZE_AVATAR_EXPLAIN}</span>
</td>
<td class="row2" width="62%">
<input type="text" maxlength="10" size="5" name="maxsize_avatar" value="{S_MAXSIZE_AVATAR}" class="post" />
</td>
</tr>

<tr>
<th colspan="2">{L_STATARCADE_SETTINGS}</th>
</tr>
<!-- stat_par_page -->
<tr>
<td class="row1" width="38%">{L_STAT_PAR_PAGE}<br />
<span class="gensmall">{L_STAT_PAR_PAGE_EXPLAIN}</span>
</td>
<td class="row2" width="62%">
<input type="text" maxlength="100" size="5" name="stat_par_page" value="{S_STAT_PAR_PAGE}" class="post" />
</td>
</tr>
<tr>
<td class="cat" colspan="2" align="center">{S_HIDDEN_FIELDS}
<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />
&nbsp;&nbsp;
<input type="reset" value="{L_RESET}" class="button" />
</td>
</tr>

</table>
</form>
<br clear="all" />