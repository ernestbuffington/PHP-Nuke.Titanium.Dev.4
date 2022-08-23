<table cellpadding="4" cellspacing="1" border="0" class="forumline" style="width: 99%;">
  <tr {DHTML_HAND} {DHTML_ONCLICK}"show({DHTML_ID})">
    <td class="catHead menu" colspan="2" style="height: 35px; font-weight: bold; text-align: center; text-transform: uppercase;">{L_WRAP_TITLE}</td>
  </tr>
</table>

<span id="{DHTML_ID}" {DHTML_DISPLAY}>
<table cellpadding="4" cellspacing="1" border="0" class="forumline" style="width: 99%;">
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_ENABLE_WRAP}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="wrap_enable" value="1" {WRAP_ENABLE} /> {L_ENABLED} <input type="radio" name="wrap_enable" value="0" {WRAP_DISABLE} /> {L_DISABLED}</td>
   </tr>
   <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_WRAP_MIN}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" size="3" maxlength="3" name="wrap_min" value="{WRAP_MIN}" /> {L_WRAP_UNITS}</td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_WRAP_DEF}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" size="3" maxlength="3" name="wrap_def" value="{WRAP_DEF}" /> {L_WRAP_UNITS}</td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_WRAP_MAX}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" size="3" maxlength="3" name="wrap_max" value="{WRAP_MAX}" /> {L_WRAP_UNITS}</td>
  </tr>
</table>
</span>