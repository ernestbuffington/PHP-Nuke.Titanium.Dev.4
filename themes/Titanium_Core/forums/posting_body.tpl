<div align="center">
<table width="98%" style="background-color:none; height:100%;" class="viewforum" align="center" border="5" cellpadding="15" cellspacing="20" dir="ltr" id="viewforum">
<tbody>
<tr>
<td align="center">


<!-- BEGIN privmsg_extensions -->
<table border="0" cellspacing="0" cellpadding="0" align="center" width="100%">
  <tr> 
    <td valign="top" align="center" width="100%"> 
      <table height="40" cellspacing="2" cellpadding="2" border="0">
        <tr valign="middle"> 
          <td>{INBOX_IMG}</td>
          <td><span class="cattitle">{INBOX_LINK}</span></td>
          <td>{SENTBOX_IMG}</td>
          <td><span class="cattitle">{SENTBOX_LINK}</span></td>
          <td>{OUTBOX_IMG}</td>
          <td><span class="cattitle">{OUTBOX_LINK}</span></td>
          <td>{SAVEBOX_IMG}</td>
          <td><span class="cattitle">{SAVEBOX_LINK}</span></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<br clear="all" />
<!-- END privmsg_extensions -->
<form action="{S_POST_ACTION}" method="post" name="post" {S_FORM_ENCTYPE}>
{POST_PREVIEW_BOX}
{ERROR_BOX}
<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
  <tr> 
    <td align="left"><a href="{U_INDEX}">{L_INDEX}</a>
    <!-- BEGIN switch_not_privmsg --> 
    
    <!-- IF PARENT_FORUM --> -> 
    <a href="{U_VIEW_PARENT_FORUM}"><i class="fa-solid fa-arrow-right fa-lg"></i> {PARENT_FORUM_NAME}</a> 
    <!-- ENDIF --> 
    <a href="{U_VIEW_FORUM}"><i class="fa-solid fa-arrow-right fa-lg"></i> {FORUM_NAME}</a>
    
    <!-- // Begin View Topic Name While Posting MOD -->
    <!-- BEGIN reply_mode -->
    <i class="fa-solid fa-arrow-right fa-lg"></i> <a href="{U_VIEW_TOPIC}">{TOPIC_SUBJECT}</a>
    <!-- END reply_mode -->
    <!-- // End View Topic Name While Posting MOD -->
    </td>
    <!-- END switch_not_privmsg -->
  </tr>
</table>

<table border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
  <tr> 
    <td style="height:30px; text-align:center;" class="catHead" colspan="2">{L_POST_A}</th>
  </tr>
  <!-- BEGIN switch_username_select -->
  <tr> 
    <td class="row1">{L_USERNAME}</td>
    <td class="row2"><input type="text" class="post" tabindex="1" name="username" style="width:30%; padding-left:7px; letter-spacing:1px;" maxlength="25" value="{USERNAME}" /></td>
  </tr>
  <!-- END switch_username_select -->
  <!-- BEGIN switch_privmsg -->
  <tr> 
    <td class="row1">{L_USERNAME}</td>
    <td class="row2"><input type="text" class="post" name="username" style="width:30%; padding-left:7px; letter-spacing:1px;" tabindex="1" value="{USERNAME}" />&nbsp;<input style="border:1px solid black; cursor:pointer; text-transform: uppercase;" type="submit" name="usersubmit" value="{L_FIND_USERNAME}" class="titaniumbutton" onclick="window.open('{U_SEARCH_USER}', '_phpbbsearch', 'HEIGHT=250,resizable=yes,WIDTH=400');return false;" /></td>
  </tr>
  <!-- END switch_privmsg -->
  <!-- Start add - Custom mass PM MOD -->
  <!-- BEGIN switch_groupmsg -->
  <tr> 
    <td class="row1">{L_USERNAME}</td>
    <td class="row2">{USERNAME}</td>
  </tr>
  <!-- END switch_groupmsg -->
  <!-- End add - Custom mass PM MOD -->
  <tr> 
    <td class="row1" style="width: 20%">{L_SUBJECT}</td>
    <td class="row2" style="width: 80%"><input type="text" name="subject" size="45" maxlength="120" style="width:98.8%; fpadding-left:7px; letter-spacing:1px;" tabindex="2" class="post" value="{SUBJECT}" /></td>
  </tr>
  <!-- BEGIN switch_icon_checkbox -->
  <tr>
    <td valign="top" class="row1">{L_ICON_TITLE}</td>
    <td class="row2">
      <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <!-- BEGIN row -->
        <tr>
          <td nowrap="nowrap">
            <!-- BEGIN cell -->
            <input style="cursor:pointer;" type="radio" name="post_icon" value="{switch_icon_checkbox.row.cell.ICON_ID}"{switch_icon_checkbox.row.cell.ICON_CHECKED}>&nbsp;{switch_icon_checkbox.row.cell.ICON_IMG}&nbsp;&nbsp;
            <!-- END cell -->
          </td>
        </tr>
        <!-- END row -->
      </table>
    </td>
  </tr>
  <!-- END switch_icon_checkbox -->
  <tr> 
    <td colspan="2" class="row2" valign="top"> 
      <table id="posttable" width="100%" border="0" cellspacing="0" cellpadding="0" valign="top" class="forumline">
        <tr valign="middle"> 
          <td valign="center">{BB_BOX}</td>
        </tr>          
      </table>
    </td>
  </tr>

  <!-- START posting options -->
  <tr> 
    <td class="row1" style="vertical-align: top">{L_OPTIONS}<span class="tooltip-html icon-sprite icon-info" title="{HTML_STATUS}<br />{BBCODE_STATUS}<br />{SMILIES_STATUS}"></span></td>
    <td class="row2" style="vertical-align: top"> 
        <!-- BEGIN switch_html_checkbox -->
        <input type="checkbox" name="disable_html" {S_HTML_CHECKED} value="ON" /> {L_DISABLE_HTML}
        <!-- END switch_html_checkbox -->
        <!-- BEGIN switch_bbcode_checkbox -->
        | <input type="checkbox" name="disable_bbcode" {S_BBCODE_CHECKED} value="ON" /> {L_DISABLE_BBCODE}
        <!-- END switch_bbcode_checkbox -->
        <!-- BEGIN switch_smilies_checkbox -->
        | <input type="checkbox" name="disable_smilies" {S_SMILIES_CHECKED} value="ON" /> {L_DISABLE_SMILIES}
        <!-- END switch_smilies_checkbox -->
        <!-- BEGIN switch_signature_checkbox -->
        <br /><input type="checkbox" name="attach_sig" {S_SIGNATURE_CHECKED} value="ON" /> {L_ATTACH_SIGNATURE} <span class="gensmall">{L_ATTACH_SIGNATURE_HELP}</span>
        <!-- END switch_signature_checkbox -->
        <!-- BEGIN switch_notify_checkbox -->
        <br /><input type="checkbox" name="notify" {S_NOTIFY_CHECKED} value="ON" /> {L_NOTIFY_ON_REPLY}
        <!-- END switch_notify_checkbox -->
        <!-- BEGIN switch_delete_checkbox -->
        <br /><input type="checkbox" name="delete" value="ON" /> {L_DELETE_POST}
        <!-- END switch_delete_checkbox -->    
        <!-- BEGIN switch_topic_glance_priority -->
        <br /><input type="checkbox" name="topic_glance_priority" {TOPIC_GLANCE_PRIORITY_CHECKED} value="1" /> {L_TOPIC_GLANCE_PRIORITY} <span class="gensmall">{L_TOPIC_GLANCE_PRIORITY_HELP}</span>
        <!-- END switch_topic_glance_priority -->
        <!-- BEGIN switch_lock_topic -->
        <br /><input type="checkbox" name="lock" {S_LOCK_CHECKED} value="ON" /> {L_LOCK_TOPIC}
        <!-- END switch_lock_topic -->
        <!-- BEGIN switch_unlock_topic -->
        <br /><input type="checkbox" name="unlock" {S_UNLOCK_CHECKED} value="ON" /> {L_UNLOCK_TOPIC}
        <!-- END switch_unlock_topic -->
        <!-- BEGIN switch_Welcome_PM -->
        <br /><input type="checkbox" name="w_pm" {S_WELCOME_PM} value="ON" /> {L_WELCOME_PM}
        <!-- END switch_Welcome_PM -->
    </td>        
  </tr>
  <!-- BEGIN switch_type_toggle -->
  <!-- IF S_TYPE_TOGGLE -->
  <tr> 
    <td class="row1">{L_TYPE_TOGGLE}</td>
    <td class="row2"> 
        {S_TYPE_TOGGLE}<br />
    </td>        
  </tr>
  <!-- ENDIF -->
  <!-- END switch_type_toggle -->
  <!-- END posting options -->
  {ATTACHBOX}
  {POLLBOX} 
  <tr> 
    <td style="height:30px; text-align:center;" class="catBottom" colspan="2">
      {S_HIDDEN_FORM_FIELDS}
      <input type="submit" tabindex="5" name="preview" id="preview" class="titaniumbutton" value="{L_PREVIEW}" />
      <input type="submit" id="submit" accesskey="s" tabindex="6" name="post" class="titaniumbutton" value="{L_SUBMIT}" />
    </td>
  </tr>
</table>

<table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
  <tr> 
    <td align="right" valign="top"><span class="gensmall">{S_TIMEZONE}</span></td>
  </tr>
</table>
</form>

<table width="100%" cellspacing="2" border="0" align="center">
  <tr> 
    <td valign="top" align="right">{JUMPBOX}</td>
  </tr>
</table>

{TOPIC_REVIEW_BOX}
</tr>
</tbody>
</table>
</div>
