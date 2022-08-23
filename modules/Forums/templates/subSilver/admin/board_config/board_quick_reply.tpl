<table cellpadding="4" cellspacing="1" border="0" class="forumline" style="width: 99%;">
  <tr {DHTML_HAND} {DHTML_ONCLICK}"show({DHTML_ID})">
    <td class="catHead menu" colspan="2" style="height: 35px; font-weight: bold; text-align: center; text-transform: uppercase;">{L_ROPM_QUICK_REPLY}</th>
  </tr>
</table>

<span id="{DHTML_ID}" {DHTML_DISPLAY}>
<table cellpadding="4" cellspacing="1" border="0" class="forumline" style="width: 99%;">
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_ENABLE_ROPM_QUICK_REPLY}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="ropm_quick_reply" value="1" {ROPM_QUICK_REPLY_YES} /> {L_YES} <input type="radio" name="ropm_quick_reply" value="0" {ROPM_QUICK_REPLY_NO} /> {L_NO}</td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_ROPM_QUICK_REPLY_BBC}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="ropm_quick_reply_bbc" value="1" {ROPM_QUICK_REPLY_BBC_YES} /> {L_YES} <input type="radio" name="ropm_quick_reply_bbc" value="0" {ROPM_QUICK_REPLY_BBC_NO} /> {L_NO}</td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_ROPM_QUICK_REPLY_SMILIES}</span>
      <span class="evo-sprite help tooltip-html float-right" title="{L_ROPM_QUICK_REPLY_SMILIES_INFO}"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" name="ropm_quick_reply_smilies" size="4" maxlength="4" value="{ROPM_QUICK_REPLY_SMILIES}" /></td>
  </tr>
</table>
</span>