<div align="center">
<table width="98%" style="background-color:none; height:100%;" class="viewforum" align="center" border="5" cellpadding="15" cellspacing="20" dir="ltr" id="viewforum">
<tbody>
<tr>
<td align="center">

<table width="100%" cellspacing="2" cellpadding="2" border="0">
  <tr>
    <!-- IF MESSAGE_FROM_ID != 1 -->
    <td>{REPLY_PM_IMG}</td>
    <!-- ENDIF -->
    <td style="width: 100%;">&nbsp;<a href="{U_INDEX}">{L_INDEX}</a></td>
  </tr>
</table>

<form method="post" action="{S_PRIVMSGS_ACTION}">
<table style="width: 100%; table-layout: fixed;" border="0" cellpadding="4" cellspacing="1" class="forumline">
  <tr>
    <td class="catHead" colspan="4" style="text-align: center; text-transform: uppercase;">{BOX_NAME} :: {L_MESSAGE}</td>
  </tr>
  <tr>
    <td class="row1" style="width: 25%;">{INBOX}</td>
    <td class="row1" style="width: 25%;">{SENTBOX}</td>
    <td class="row1" style="width: 25%;">{OUTBOX}</td>
    <td class="row1" style="width: 25%;">{SAVEBOX}</td>
  </tr>
  <tr>
    <td class="row1" colspan="4">
      <table style="width: 100%; table-layout: fixed;" border="0" cellpadding="4" cellspacing="1" class="forumline">
        <tr>
          <td class="row1" style="width: 20%; text-align: right">{L_FROM}</td>
          <td class="row1" colspan="2">{MESSAGE_FROM}<!-- IF MESSAGE_FROM_ID != 1 -->&nbsp;{POSTER_FROM_ONLINE_STATUS}<!-- ENDIF --></td>
        </tr>
        <tr>
          <td class="row1" style="width: 20%; text-align: right">{L_TO}</td>
          <td class="row1" colspan="2">{MESSAGE_TO}&nbsp;{POSTER_TO_ONLINE_STATUS}</td>
        </tr>
        <tr>
          <td class="row1" style="width: 20%; text-align: right">{L_POSTED}</td>
          <td class="row1" colspan="2">{POST_DATE}</td>
        </tr>
        <tr>
          <td class="row1" style="width: 20%; text-align: right">{L_SUBJECT}</td>
          <td class="row1">{POST_SUBJECT}</td>
          <td class="row1" style="width: 20%; text-align: center"><!-- IF MESSAGE_FROM_ID != 1 -->{QUOTE_PM_IMG} <!-- ENDIF -->{EDIT_PM_IMG}</td>
        </tr>
        <tr>
          <td class="row1" colspan="3"><span class="postbody">{MESSAGE}</span><!-- BEGIN postrow -->{ATTACHMENTS}<!-- END postrow --></td>
        </tr>
        <tr>
          <td class="row1" colspan="3">{PROFILE_IMG} {PM_IMG} {EMAIL_IMG} {WWW_IMG}</td>
        </tr>
        <tr>
          <td class="catBottom" colspan="3" height="28" align="right"> {S_HIDDEN_FIELDS}<input type="submit" name="save" value="{L_SAVE_MSG}" class="titaniumbutton" />&nbsp;<input type="submit" name="delete" value="{L_DELETE_MSG}" class="titaniumbutton" /><!-- BEGIN switch_attachments -->&nbsp;<input type="submit" name="pm_delete_attach" value="{L_DELETE_ATTACHMENTS}" class="titaniumbutton" /><!-- END switch_attachments --></td>
        </tr>
        <!-- IF MESSAGE_FROM_ID != 1 -->
        {ROPM_QUICKREPLY_OUTPUT}
        <!-- ENDIF --> 
      </table>
    </td>
  </tr>
  <tr>
    <td class="catBottom" colspan="4">&nbsp;</td>
  </tr>
</table>

<table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
  <tr> 
    <!-- IF MESSAGE_FROM_ID != 1 -->
    <td>{REPLY_PM_IMG}</td>
    <!-- ENDIF -->
    <td align="right" valign="top"><span class="gensmall">{S_TIMEZONE}</span></td>
  </tr>
</table>
</form>

<table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
  <tr> 
    <td valign="top" align="right">{JUMPBOX}</td>
  </tr>
</table>

</tr>
</tbody>
</table>
</div>
