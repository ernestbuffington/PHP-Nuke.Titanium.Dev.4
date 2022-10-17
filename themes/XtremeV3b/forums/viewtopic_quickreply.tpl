<!-- BEGIN switch_open_qr_yes -->
<div id="sqr" style="display: show; position: relative; ">
<!-- END switch_open_qr_yes -->
<!-- BEGIN switch_open_qr_no -->
<div id="sqr" style="display: none; position: relative; ">
<!-- END switch_open_qr_no -->
<form action="{S_POST_ACTION}" method="post" name="post">
<table border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
  <tr>
    <td class="catHead acenter" colspan="2" height="25">{L_QUICK_REPLY}</span></td>
  </tr>
  <!-- BEGIN switch_username_select -->
  <tr>
    <td class="row1">{L_USERNAME}</td>
    <td class="row2"><input type="text" tabindex="1" name="username" style="width:30%; padding-left:7px;" maxlength="25" value="{USERNAME}" /></td>
  </tr>
  <!-- END switch_username_select -->
  <tr>
    <td class="row1" width="22%">{L_SUBJECT}</td>
    <td class="row2" width="78%"><input type="text" tabindex="2" name="subject" maxlength="60" style="width:98.8%; padding-left:7px;" value="{SUBJECT}" /></td>
  </tr>
  <tr> 
    <td colspan="2" class="row2" valign="top"> 
      <table id="posttable" width="100%" border="0" cellspacing="0" cellpadding="0" valign="top" class="forumline">
        <tr> 
          <td>{BB_BOX}</td>
        </tr>          
      </table>
    </td>
  </tr>
  <!-- BEGIN switch_advanced_qr -->
  <tr>
    <td class="row1" valign="top">{L_OPTIONS}</span><br />{HTML_STATUS}<br />{BBCODE_STATUS}<br />{SMILIES_STATUS}</td>
    <td class="row2">
      <table cellspacing="0" cellpadding="1" border="0">
        <!-- BEGIN switch_html_checkbox -->
        <tr> 
          <td><input type="checkbox" name="disable_html" {S_HTML_CHECKED} value="ON" /></td>
          <td>{L_DISABLE_HTML}</td>
        </tr>
        <!-- END switch_html_checkbox -->
        <!-- BEGIN switch_bbcode_checkbox -->
        <tr> 
          <td><input type="checkbox" name="disable_bbcode" {S_BBCODE_CHECKED} value="ON" /></td>
          <td>{L_DISABLE_BBCODE}</td>
        </tr>
        <!-- END switch_bbcode_checkbox -->
        <!-- BEGIN switch_smilies_checkbox -->
        <tr> 
          <td><input type="checkbox" name="disable_smilies" {S_SMILIES_CHECKED} value="ON" /></td>
          <td>{L_DISABLE_SMILIES}</td>
        </tr>
        <!-- END switch_smilies_checkbox -->
        <!-- BEGIN switch_signature_checkbox -->
        <tr> 
          <td><input type="checkbox" name="attach_sig" {S_SIGNATURE_CHECKED} value="ON" /></td>
          <td>{L_ATTACH_SIGNATURE}&nbsp;{L_ATTACH_SIGNATURE_HELP}</td>
        </tr>
        <!-- END switch_signature_checkbox -->
        <!-- BEGIN switch_notify_checkbox -->
        <tr> 
          <td><input type="checkbox" name="notify" {S_NOTIFY_CHECKED} value="ON" /></td>
          <td>{L_NOTIFY_ON_REPLY}</td>
        </tr>
        <!-- END switch_notify_checkbox -->
        <!-- BEGIN switch_lock_topic -->
        <tr> 
          <td><input type="checkbox" name="lock" {S_LOCK_CHECKED} value="ON" /></td>
          <td>{L_LOCK_TOPIC}</td>
        </tr>
        <!-- END switch_lock_topic -->
        <!-- BEGIN switch_unlock_topic -->
        <tr> 
          <td><input type="checkbox" name="unlock" {S_UNLOCK_CHECKED} value="ON" /></td>
          <td>{L_UNLOCK_TOPIC}</td>
        </tr>
        <!-- END switch_unlock_topic -->
      </table>
    </td>
  </tr>
  <!-- END switch_advanced_qr -->
  <tr> 
    <td class="catBottom" colspan="2" align="center" height="28">
      {S_HIDDEN_FORM_FIELDS}
      <input style="cursor:pointer;" type="submit" tabindex="5" name="preview" id="preview" class="mainoption" value="{L_PREVIEW}" />
      <input style="cursor:pointer;" type="submit" id="submit" accesskey="s" tabindex="6" name="post" class="mainoption" value="{L_SUBMIT}" />
    </td>
  </tr>
</table>

<table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
  <tr> 
    <td class="aright" valign="top">{S_TIMEZONE}</td>
  </tr>
</table>
</form>
</div>