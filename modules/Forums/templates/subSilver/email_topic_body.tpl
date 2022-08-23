<form action="{S_EMAIL_ACTION}" method="post" name="emailtopic">
  <table width="100%" cellspacing="2" cellpadding="2" border="0">
  <tr>
    <td align="left" valign="bottom" nowrap="nowrap"><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></span></td>
  </tr>
  </table>
  <table border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
  <tr>
    <th class="thHead" colspan="2" height="25"><strong>{L_TITLE}</strong></th>
  </tr>
  <tr>
    <td width="30%" class="row1"><span class="gen"><strong>{L_SUBJECT}</strong></span></td>
    <td class="row2"><span class="gen">{TOPIC_TITLE}</span></td>
  </tr>
  <tr>
    <td width="30%" class="row1"><span class="gen"><strong>{L_FRIEND_NAME}</strong></span></td>
    <td class="row2"><span class="gen"><input type="text" name="friend_name" size="30" maxlength="100" tabindex="1" class="post" /></span></td>
  </tr>
  <tr>
    <td width="30%" class="row1"><span class="gen"><strong>{L_FRIEND_EMAIL}</strong></span></td>
    <td class="row2"><span class="gen"><input type="text" name="friend_email" size="30" maxlength="100" tabindex="2" class="post" /></span></td>
  </tr>
  <tr>
    <td width="30%" valign="top" class="row1"><span class="gen"><strong>{L_MESSAGE}</strong></span><span class="gensmall"><br />{L_MESSAGE_EXPLAIN}</span></td>
    <td class="row2"><span class="gen"><textarea name="message" cols="30" rows="7" tabindex="3" class="post"></textarea></span></td>
  </tr>
  <tr>
    <td class="catBottom" colspan="2" align="center" height="28">{S_HIDDEN_FIELDS}<input type="submit" name="submit" value="{L_SUBMIT}" tabindex="4" accesskey="s" class="mainoption" /></td>
  </tr>
  </table>
</form>

<table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
  <tr>
  <td align="right" valign="top"><span class="gensmall">{S_TIMEZONE}</span></td>
  </tr>
</table>

<table width="100%" cellspacing="2" border="0" align="center">
  <tr>
  <td valign="top" align="right">{JUMPBOX}</td>
  </tr>
</table>