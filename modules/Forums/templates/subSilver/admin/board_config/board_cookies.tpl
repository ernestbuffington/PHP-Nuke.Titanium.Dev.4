<table cellpadding="4" cellspacing="1" border="0" class="forumline" style="width: 99%;">
  <tr {DHTML_HAND} {DHTML_ONCLICK}"show({DHTML_ID})">
    <td class="catHead menu" colspan="2" style="height: 35px; font-weight: bold; text-align: center; text-transform: uppercase;">{L_COOKIE_SETTINGS}</td>
  </tr>
</table>

<span id="{DHTML_ID}" {DHTML_DISPLAY}>
<table cellpadding="4" cellspacing="1" border="0" class="forumline" style="width: 99%;">
  <tr>
    <td class="row2" colspan="2" style="height: 35px; font-size: 13px; text-align: center; width: 50%;">{L_COOKIE_SETTINGS_EXPLAIN}</td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_COOKIE_DOMAIN}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" maxlength="255" name="cookie_domain" value="{COOKIE_DOMAIN}" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_COOKIE_NAME}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" maxlength="255" name="cookie_name" value="{COOKIE_NAME}" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_COOKIE_PATH}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" maxlength="255" name="cookie_path" value="{COOKIE_PATH}" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_COOKIE_SECURE}</span>
      <span class="evo-sprite help tooltip float-right" title="{L_COOKIE_SECURE_EXPLAIN}"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="cookie_secure" value="0" {S_COOKIE_SECURE_DISABLED} />{L_DISABLED}  <input type="radio" name="cookie_secure" value="1" {S_COOKIE_SECURE_ENABLED} />{L_ENABLED}</td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_SESSION_LENGTH}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" maxlength="5" size="5" name="session_length" value="{SESSION_LENGTH}" /></td>
  </tr>
</table>
</span>