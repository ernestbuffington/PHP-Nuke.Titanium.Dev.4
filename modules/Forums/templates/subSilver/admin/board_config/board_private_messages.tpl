<table cellpadding="4" cellspacing="1" border="0" class="forumline" style="width: 99%;">
  <tr {DHTML_HAND} {DHTML_ONCLICK}"show({DHTML_ID})">
    <td class="catHead menu" colspan="2" style="height: 35px; font-weight: bold; text-align: center; text-transform: uppercase;">{L_PRIVATE_MESSAGING}</td>
  </tr>
</table>

<span id="{DHTML_ID}" {DHTML_DISPLAY}>
<table cellpadding="4" cellspacing="1" border="0" class="forumline" style="width: 99%;">
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_DISABLE_PRIVATE_MESSAGING}</td>
    <td class="row1" style="height: 35px; width: 50%;"><input type="radio" name="privmsg_disable" value="0" {S_PRIVMSG_ENABLED} />{L_ENABLED} <input type="radio" name="privmsg_disable" value="1" {S_PRIVMSG_DISABLED} />{L_DISABLED}</td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_WELCOME_PM}</td>
    <td class="row1" style="height: 35px; width: 50%;"><input type="radio" name="welcome_pm" value="1" {S_WELCOME_PM_ENABLED} />{L_ENABLED} <input type="radio" name="welcome_pm" value="0" {S_WELCOME_PM_DISABLED} />{L_DISABLED}</td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">Welcome PM Sender Name</td>
    <td class="row1" style="height: 35px; width: 50%;"><input class="post" type="text" style="width: 350px;" name="welcome_pm_username" value="{WELCOME_USERNAME}" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_PM_ALLOW_THRESHOLD}</span>
      <span class="evo-sprite help tooltip-html float-right" title="{L_PM_ALLOW_TRHESHOLD_EXPLAIN}"></span>
    </td>
    <td class="row1" style="height: 35px; width: 50%;"><input class="post" type="text" maxlength="4" size="4" name="pm_allow_threshold" value="{PM_ALLOW_THRESHOLD}" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_INBOX_LIMIT}</td>
    <td class="row1" style="height: 35px; width: 50%;"><input class="post" type="text" maxlength="4" size="4" name="max_inbox_privmsgs" value="{INBOX_LIMIT}" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_SENTBOX_LIMIT}</td>
    <td class="row1" style="height: 35px; width: 50%;"><input class="post" type="text" maxlength="4" size="4" name="max_sentbox_privmsgs" value="{SENTBOX_LIMIT}" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_SAVEBOX_LIMIT}</td>
    <td class="row1" style="height: 35px; width: 50%;"><input class="post" type="text" maxlength="4" size="4" name="max_savebox_privmsgs" value="{SAVEBOX_LIMIT}" /></td>
  </tr>
</table>
</span>