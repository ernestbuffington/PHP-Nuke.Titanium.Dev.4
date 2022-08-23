<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
    <tr> 
        <td align="left"><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></span></td>
    </tr>
</table>

<!-- BEGIN switch_current_sig -->

<form method="post" action="{SIG_LINK}" name="preview">

<table border="0" cellpadding="3" cellspacing="1" width="660" class="forumline" align="center">
    <tr> 
        <th class="thHead" colspan="2" height="25" valign="middle">{SIG_CURRENT}</th>
    </tr>
    <tr> 
        <td class="row1" width="140" height="140"><span class="gen">{L_SIGNATURE}:</span></td>
        <td class="row2" width="520" valign="bottom"><span class="gen">{CURRENT_PREVIEW}</span></td>
    </tr>
    <tr> 
        <td class="row1" width="140" height="20"><span class="gen"></span></td>
        <td class="row2" width="520" valign="middle" nowrap="nowrap">{PROFIL_IMG} {EMAIL_IMG} {PM_IMG} {WWW_IMG} {AIM_IMG} {YIM_IMG} {MSN_IMG} {ICQ_IMG}</td>
    </tr>
</table>

<br />

<table border="0" cellpadding="3" cellspacing="1" width="660" class="forumline" align="center">
    <tr> 
        <th class="thHead" colspan="2" height="25" valign="middle">{SIG_EDIT}</th>
    </tr>
    <tr>
        <td class="row1" width="130" height="20">&nbsp;</td>
        <td class="row2" width="530" align="middle">{BB_BOX}</td>
    </tr>
    <tr> 
        <td class="row1" width="130" height="150"><span class="gen">{L_SIGNATURE}:</span><br /><span class="gensmall">{L_SIGNATURE_EXPLAIN}<br /><br />{HTML_STATUS}<br />{BBCODE_STATUS}<br />{SMILIES_STATUS}</span></td>
        <td class="row2" width="530" align="middle"><textarea name="signature" style="width: 450px" rows="8" cols="70" class="post">{SIGNATURE}</textarea></td>
    </tr>
    <tr> 
        <td class="row1" width="130" height="20">&nbsp;</td>
        <td class="row2" width="530" align="middle">
        <INPUT TYPE="button" VALUE="{L_PROFILE}" onClick="location='{U_PROFILE}'"> 
        <INPUT TYPE="button" VALUE="{SIG_CURRENT}" onClick="location='{SIG_LINK}'">
        <INPUT TYPE="submit" VALUE="{SIG_PREVIEW}" name="preview">
        <INPUT TYPE="submit" VALUE="{SIG_SAVE}" name="save">
        <INPUT TYPE="submit" VALUE="{SIG_CANCEL}" name="cancel">
        </td>
    </tr>
</table>

</form>

<!-- END switch_current_sig -->

<!-- BEGIN switch_preview_sig -->

<form method="post" action="{SIG_LINK}" name="preview">

<table border="0" cellpadding="3" cellspacing="1" width="660" class="forumline" align="center">
    <tr> 
        <th class="thHead" colspan="2" height="25" valign="middle">{SIG_PREVIEW}</th>
    </tr>
    <tr> 
        <td class="row1" width="140" height="140"><span class="gen">{L_SIGNATURE}:</span></td>
        <td class="row2" width="520" valign="bottom"><span class="gen">{REAL_PREVIEW}</span></td>
    </tr>
    <tr> 
        <td class="row1" width="140" height="20"><span class="gen"></span></td>
        <td class="row2" width="520" valign="middle" nowrap="nowrap">{PROFIL_IMG} {EMAIL_IMG} {PM_IMG} {WWW_IMG} {AIM_IMG} {YIM_IMG} {MSN_IMG} {ICQ_IMG}</td>
    </tr>
</table>

<br />

<table border="0" cellpadding="3" cellspacing="1" width="660" class="forumline" align="center">
    <tr> 
        <th class="thHead" colspan="2" height="25" valign="middle">{SIG_EDIT}</th>
    </tr>
    <tr>
        <td class="row1" width="130" height="20">&nbsp;</td>
        <td class="row2" width="530" align="middle">{BB_BOX}</td>
    </tr>
    <tr> 
        <td class="row1" width="130" height="150"><span class="gen">{L_SIGNATURE}:</span><br /><span class="gensmall">{L_SIGNATURE_EXPLAIN}<br /><br />{HTML_STATUS}<br />{BBCODE_STATUS}<br />{SMILIES_STATUS}</span></td>
        <td class="row2" width="530" align="middle"><textarea name="signature" style="width: 450px" rows="8" cols="70" class="post">{PREVIEW}</textarea></td>
    </tr>
    <tr> 
        <td class="row1" width="130" height="20">&nbsp;</td>
        <td class="row2" width="530" align="middle">
        <INPUT TYPE="button" VALUE="{L_PROFILE}" onClick="location='{U_PROFILE}'"> 
        <INPUT TYPE="button" VALUE="{SIG_CURRENT}" onClick="location='{SIG_LINK}'">
        <INPUT TYPE="submit" VALUE="{SIG_PREVIEW}" name="preview">
        <INPUT TYPE="submit" VALUE="{SIG_SAVE}" name="save">
        <INPUT TYPE="submit" VALUE="{SIG_CANCEL}" name="cancel">
        </td>
    </tr>
</table>

</form>

<!-- END switch_preview_sig -->

<!-- BEGIN switch_save_sig -->

<form method="post" action="{SIG_LINK}" name="preview">

<table border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline" align="center">
    <tr> 
        <th class="thHead" height="25" valign="middle">{SIG_SAVE}</th>
    </tr>
    <tr> 
        <td class="row1" valign="middle" align="middle" height="50"><span class="gen">{SAVE_MESSAGE}</span></td>
    </tr>
    <tr> 
        <td class="row2" align="middle">
        <INPUT TYPE="button" VALUE="{L_PROFILE}" onClick="location='{U_PROFILE}'"> 
        <INPUT TYPE="button" VALUE="{SIG_CURRENT}" onClick="location='{SIG_LINK}'">
        <INPUT TYPE="submit" VALUE="{SIG_CANCEL}" name="cancel">
        </td>
    </tr>
</table>

</form>

<!-- END switch_save_sig -->
