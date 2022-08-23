<div class="maintitle">{L_ADD_TITLE}</div>
<br />

<form action="{S_CONFIG_ACTION}" method="post">
<table width="99%" cellpadding="3" cellspacing="1" border="0" align="center" class="forumline">

<tr>
<th colspan="2">{L_ADD_TITLE}</th>
</tr>

<tr> 
<td class="row1" width="38%">{L_NAME}<br />
<span class="gensmall">{L_NAME_DESC}</span>
</td>
<td class="row2" width="62%"> 
<input type="text" maxlength="100" size="25" name="add_gamename" value="" class="post" />
</td>
</tr>

<tr> 
<td class="row1" width="38%">{L_DESC}<br />
<span class="gensmall">{L_DESC_DESC}</span>
</td>
<td class="row2"> 
<textarea name="add_gamedesc" rows="5" cols="30" style="width: 255px" class="post">{GAME_DESCRIPTION}</textarea>
</td>
</tr>

<tr> 
<td class="row1" width="38%">{L_SCOREVAR}<br />
<span class="gensmall">{L_SCOREVAR_DESC}</span>
</td>
<td class="row2" width="62%"> 
<input type="text" maxlength="100" size="25" name="add_scorevar" value="" class="post" />
</td>
</tr>

<tr> 
<td class="row1" width="38%">{L_GAMEFILE}<br />
<span class="gensmall">{L_GAMEFILE_DESC}</span>
</td>
<td class="row2" width="62%"> 
<input type="text" maxlength="100" size="25" name="add_gamefile" value="" class="post" />
</td>
</tr>

<tr> 
<td class="row1" width="38%">{L_PICFILE}<br />
<span class="gensmall">{L_PICFILE_DESC}</span>
</td>
<td class="row2" width="62%"> 
<input type="text" maxlength="100" size="25" name="add_gamepicture" value="" class="post" />
</td>
</tr>

<tr> 
<td class="row1" width="38%">{L_CAT}<br />
<span class="gensmall">{L_CAT_DESC}</span>
</td>
<td class="row2" width="62%"> 
<select name="add_cat" class="post">
{CATEGORIES}
</select>
</td>
</tr>

<tr> 
<td class="row1" width="38%">{L_TYPE}<br />
<span class="gensmall">{L_TYPE_DESC}</span>
</td>
<td class="row2"> 
<select name="add_gametype" class="post">
<option value="3" {SELECTED3}>V3Arcade</option>
<option value="4" {SELECTED4}>IBPro</option>
<option value="5" {SELECTED5}>Activity</option>
</select>
</td>
</tr>

<tr> 
<td class="row1" width="38%">{L_WIDTH}<br />
<span class="gensmall">{L_WIDTH_DESC}</span>
</td>
<td class="row2" width="62%"> 
<input type="text" maxlength="5" size="5" name="add_gamewidth" value="550" class="post" />
</td>
</tr>

<tr> 
<td class="row1" width="38%">{L_HEIGHT}<br />
<span class="gensmall">{L_HEIGHT_DESC}</span>
</td>
<td class="row2" width="62%"> 
<input type="text" maxlength="5" size="5" name="add_gameheight" value="380" class="post" />
</td>
</tr>

<tr> 
<td class="cat" colspan="2" align="center">
<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />
</td>
</tr>

</table>
</form>
<br clear="all" />