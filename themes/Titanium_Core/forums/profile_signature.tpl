<table border="0" cellpadding="4" cellspacing="1" width="100%">
  <tr> 
    <td align="left"><span class="nav"><a href="{U_INDEX}">{L_INDEX}</a></span></td>
  </tr>
</table>
<!-- BEGIN switch_current_sig -->
<form method="post" action="{SIG_LINK}" name="preview">
<table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">
  <tr>
    <td class="catHead" style="height: 30px; letter-spacing: 1px; text-align: center; text-transform: uppercase;" valign="middle">{SIG_PREVIEW}</td>
  </tr>
  <tr> 
    <td class="row2" width="520" valign="bottom"><span class="gen">{CURRENT_PREVIEW}</span></td>
  </tr>
  <tr> 
    <td class="row2" width="520" valign="middle" nowrap="nowrap">{PROFIL_IMG} {EMAIL_IMG} {PM_IMG} {WWW_IMG}</td>
  </tr>
</table>

<br />

<table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">
  <tr>
    <td class="catHead" colspan="2" style="height: 30px; letter-spacing: 1px; text-align: center; text-transform: uppercase;" valign="middle">{SIG_EDIT}</td>
  </tr>
  <tr>
    <td class="row1" colspan="2" style="width: 100%;">
      <table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">
        <tr>
          <td class="row1" style="text-align: center; width: 33.3%;">{HTML_STATUS}</td>
          <td class="row1" style="text-align: center; width: 33.3%;">{BBCODE_STATUS}</td>
          <td class="row1" style="text-align: center; width: 33.3%;">{SMILIES_STATUS}</td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td class="row1" colspan="2" style="width: 100%;">{BB_BOX}</td>
  </tr>
  <tr>
    <td class="catBottom" colspan="2" style="text-align: center; width: 100%;">
      <input style="cursor: pointer;" type="button" value="{L_PROFILE}" onClick="location='{U_PROFILE}'"> 
      <input style="cursor: pointer;" type="button" value="{SIG_CURRENT}" onClick="location='{SIG_LINK}'">
      <input style="cursor: pointer;" type="submit" value="{SIG_PREVIEW}" name="preview">
      <input style="cursor: pointer;" type="submit" value="{SIG_SAVE}" name="save">
      <input style="cursor: pointer;" type="submit" value="{SIG_CANCEL}" name="cancel">
    </td>
  </tr>
</table>
</form>
<!-- END switch_current_sig -->

<!-- BEGIN switch_preview_sig -->
<form method="post" action="{SIG_LINK}" name="preview">
<table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">
  <tr>
    <td class="catHead" style="height: 30px; letter-spacing: 1px; text-align: center; text-transform: uppercase;" valign="middle">{SIG_PREVIEW}</td>
  </tr>
  <tr> 
    <td class="row2" width="520" valign="bottom"><span class="gen">{REAL_PREVIEW}</span></td>
  </tr>
  <tr> 
    <td class="row2" width="520" valign="middle" nowrap="nowrap">{PROFIL_IMG} {EMAIL_IMG} {PM_IMG} {WWW_IMG}</td>
  </tr>
</table>

<br />

<table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">
  <tr>
    <td class="catHead" colspan="2" style="height: 30px; letter-spacing: 1px; text-align: center; text-transform: uppercase;" valign="middle">{SIG_EDIT}</td>
  </tr>
  <tr>
    <td class="row1" colspan="2" style="width: 100%;">
      <table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">
        <tr>
          <td class="row1" style="text-align: center; width: 33.3%;">{HTML_STATUS}</td>
          <td class="row1" style="text-align: center; width: 33.3%;">{BBCODE_STATUS}</td>
          <td class="row1" style="text-align: center; width: 33.3%;">{SMILIES_STATUS}</td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td class="row1" colspan="2" style="width: 100%;">{BB_BOX}</td>
  </tr>
  <tr>
    <td class="catBottom" colspan="2" style="text-align: center; width: 100%;">
      <input style="cursor: pointer;" type="button" value="{L_PROFILE}" onClick="location='{U_PROFILE}'"> 
      <input style="cursor: pointer;" type="button" value="{SIG_CURRENT}" onClick="location='{SIG_LINK}'">
      <input style="cursor: pointer;" type="submit" value="{SIG_PREVIEW}" name="preview" id="preview">
      <input style="cursor: pointer;" type="submit" value="{SIG_SAVE}" name="save" id="submit">
      <input style="cursor: pointer;" type="submit" value="{SIG_CANCEL}" name="cancel">
    </td>
  </tr>
</table>
</form>
<!-- END switch_preview_sig -->

<!-- BEGIN switch_save_sig -->
<form method="post" action="{SIG_LINK}" name="preview">
<table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">
  <tr>
    <td class="catHead" colspan="2" style="height: 30px; letter-spacing: 1px; text-align: center; text-transform: uppercase;" valign="middle">{SIG_SAVE}</td>
  </tr>
  <tr> 
    <td class="row1" valign="middle" align="middle" height="50"><span class="gen">{SAVE_MESSAGE}</span></td>
  </tr>
  <tr> 
    <td class="catBottom" align="middle">
      <input style="cursor: pointer;" type="button" value="{L_PROFILE}" onClick="location='{U_PROFILE}'"> 
      <input style="cursor: pointer;" type="button" value="{SIG_CURRENT}" onClick="location='{SIG_LINK}'">
      <input style="cursor: pointer;" type="submit" value="{SIG_CANCEL}" name="cancel">
    </td>
  </tr>
</table>
</form>
<!-- END switch_save_sig -->