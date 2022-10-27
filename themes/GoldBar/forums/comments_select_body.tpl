<table border="0" cellpadding="3" cellspacing="4" width="100%">
<td align="left"><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></span>
<span class="nav">&nbsp;->&nbsp;{NAV_DESC}</span>
<span class="nav">&nbsp;->&nbsp;Arcade Comments</span>
</td>
</table>

<table width='100%' cellpadding="5" cellspacing="1" border="0" class="forumline" align="center">
<!-- BEGIN comment_select -->
  <tr>
          <th colspan='2' class="row4"><span class="cattitle">Select a Game</span></th>
  </tr>

<form method='post' name='submit' action='{comment_select.S_ACTION}'>
<tr><td colspan='2' align='center' class='row2'>You currently hold {comment_select.HIGHSCORE_COUNT} highscores.</td></tr>
<tr><td width="50%" align='center' class='row2'>Select a game to enter or edit a comment:</td>
<td width="50%" align='center' class='row2'>{comment_select.HIGHSCORE_SELECT}</td></tr>
<tr><td colspan='2' align='center' class='row2'><input type='submit' name='submit' value='Add/Edit' class='mainoption' /></td></tr>
</form>
<!-- END comment_select -->
<!-- BEGIN comment_settings -->
  <tr>
          <th colspan='2' class="row4"><span class="cattitle">User Settings</span></th>
  </tr>

<form method='post' name='submit' action='{comment_settings.S_ACTION_PM}'>
<tr>
<td class="row1">Enable Arcade PM<br />
<span class="gensmall">If enabled, you will receive a private message when you lose a highscore.</span>
</td>
<td class="row2">
<input type="radio" name="user_allow_arcadepm" value="1" {comment_settings.USER_ALLOW_ARCADEPM_YES} />
{comment_settings.L_YES}
<input type="radio" name="user_allow_arcadepm" value="0" {comment_settings.USER_ALLOW_ARCADEPM_NO} />
{comment_settings.L_NO}
</td>
</tr>
<tr><td colspan='2' align='center' class='row2'><input type='submit' name='submit' value='Submit' class='mainoption' /></td></tr>
</form>
<!-- END comment_settings -->
</table>
<br />