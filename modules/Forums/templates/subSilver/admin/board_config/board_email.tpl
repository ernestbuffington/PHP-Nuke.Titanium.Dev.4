<table cellpadding="4" cellspacing="1" border="0" class="forumline" style="width: 99%;">
  <tr {DHTML_HAND} {DHTML_ONCLICK}"show({DHTML_ID})">
    <td class="catHead menu" colspan="2" style="height: 35px; font-weight: bold; text-align: center; text-transform: uppercase;">{L_EMAIL_SETTINGS}</td>
  </tr>
</table>

<span id="{DHTML_ID}" {DHTML_DISPLAY}>
<table cellpadding="4" cellspacing="1" border="0" class="forumline" style="width: 99%;">
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_ADMIN_EMAIL}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" size="25" maxlength="100" name="board_email" value="{EMAIL_FROM}" /></td>
  </tr>

  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_EMAIL_SIG}</span>
      <span class="evo-sprite help tooltip float-right" title="{L_EMAIL_SIG_EXPLAIN}"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><textarea name="board_email_sig" rows="5" cols="30">{EMAIL_SIG}</textarea></td>
  </tr>

  <tr>
    <td class="catHead center" colspan="2" style="height: 35px;">SMTP Options</td>
  </tr>

  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_USE_SMTP}</span>
      <span class="evo-sprite help tooltip float-right" title="{L_USE_SMTP_EXPLAIN}"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;">
      <input type="radio" name="smtp_delivery" value="1" {SMTP_YES} /> {L_YES} |
      <input type="radio" name="smtp_delivery" value="0" {SMTP_NO} /> {L_NO}
    </td>
  </tr>

  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_SMTP_HOST}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" name="smtp_host" value="{SMTP_HOST}" size="25" maxlength="50" /></td>
  </tr>

  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_SMTP_ENCRYPTION}</span>
      <span class="evo-sprite help tooltip-html float-right" title="{L_SMTP_ENCRYPTION_EXPLAIN}"></span
    </td>
    <td class="row2" style="height: 35px; width: 50%;">
      <input type="radio" class="smtp_encryption" id="none" name="smtp_encryption" value="none" {SMTP_ENCRYPT_NONE} />&nbsp;<label for="none">None</label> |
      <input type="radio" class="smtp_encryption" id="ssl" name="smtp_encryption" value="ssl" {SMTP_ENCRYPT_SSL} />&nbsp;<label for="ssl">SSL</label> |
      <input type="radio" class="smtp_encryption" id="tls" name="smtp_encryption" value="tls" {SMTP_ENCRYPT_TLS} />&nbsp;<label for="tls">TLS</label>
    </td>
  </tr>

  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_SMTP_PORT}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="number" id="smtp_port" name="smtp_port" value="{SMTP_PORT}" /></td>
  </tr>

  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_SMTP_AUTHENTICATION}</td>
    <td class="row2" style="height: 35px; width: 50%;">
      <input type="radio" id="off" name="smtp_auth" value="0" {SMTP_AUTH_NO} />&nbsp;<label for="off">Off</label> |
      <input type="radio" id="on" name="smtp_auth" value="1" {SMTP_AUTH_YES} />&nbsp;<label for="on">On</label>
    </td>
  </tr>

  <tr class="smtp_auth_settings"{SMTP_AUTH_VIEW}>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_SMTP_USERNAME}</span>
      <span class="evo-sprite help tooltip float-right" title="{L_SMTP_USERNAME_EXPLAIN}"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" name="smtp_username" value="{SMTP_USERNAME}" size="25" maxlength="255" /></td>
  </tr>

  <tr class="smtp_auth_settings"{SMTP_AUTH_VIEW}>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_SMTP_PASSWORD}</span>
      <span class="evo-sprite help tooltip-interact float-right" title="{L_SMTP_PASSWORD_EXPLAIN}"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="password" name="smtp_password" value="{SMTP_PASSWORD}" size="25" maxlength="255" /></td>
  </tr>
</table>
</span>