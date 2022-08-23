<table cellpadding="4" cellspacing="1" border="0" class="forumline" style="width: 99%;">
  <tr {DHTML_HAND} {DHTML_ONCLICK}"show({DHTML_ID})">
    <td class="catHead menu" colspan="2" style="height: 35px; font-weight: bold; text-align: center; text-transform: uppercase;">{L_BIRTHDAYS}</td>
  </tr>
</table>


<span id="{DHTML_ID}" {DHTML_DISPLAY}>
<table style="width: 99%" cellpadding="4" cellspacing="1" border="0" class="forumline">
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_BDAY_REQUIRE}</span>
      <span class="evo-sprite help tooltip float-right" title="{L_BDAY_REQUIRE_EXPLAIN}"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="bday_require" value="1" {BDAY_REQUIRE_YES} />{L_YES}&nbsp; &nbsp;<input type="radio" name="bday_require" value="0" {BDAY_REQUIRE_NO} />{L_NO}</td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_BDAY_YEAR}</span>
      <span class="evo-sprite help tooltip float-right" title="{L_BDAY_YEAR_EXPLAIN}"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="bday_year" value="1" {BDAY_YEAR_YES} />{L_YES}&nbsp; &nbsp;<input type="radio" name="bday_year" value="0" {BDAY_YEAR_NO} />{L_NO}</td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_BDAY_LOCK}</span>
      <span class="evo-sprite help tooltip float-right" title="{L_BDAY_LOCK_EXPLAIN}"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="bday_lock" value="1" {BDAY_LOCK_YES} />{L_YES}&nbsp; &nbsp;<input type="radio" name="bday_lock" value="0" {BDAY_LOCK_NO} />{L_NO}</td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_BDAY_LOOKAHEAD}</span>
      <span class="evo-sprite help tooltip float-right" title="{L_BDAY_LOOKAHEAD_EXPLAIN}"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" size="2" maxlength="2" name="bday_lookahead" value="{BDAY_LOOKAHEAD}" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_BDAY_AGE_RANGE}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" size="2" maxlength="2" name="bday_min" value="{BDAY_MIN}" /> {L_TO} <input class="post" type="text" size="3" maxlength="3" name="bday_max" value="{BDAY_MAX}" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_BDAY_HIDE}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="bday_hide" value="1" {BDAY_HIDE_YES} />{L_YES}&nbsp; &nbsp;<input type="radio" name="bday_hide" value="0" {BDAY_HIDE_NO} />{L_NO}</td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <!-- {L_BDAY_SHOW}<br /><span class="gensmall">{L_BDAY_SHOW_EXPLAIN}</span> -->
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_BDAY_SHOW}</span>
      <span class="evo-sprite help tooltip float-right" title="{L_BDAY_SHOW_EXPLAIN}"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="bday_show" value="1" {BDAY_SHOW_YES} />{L_UNCONDITIONAL}&nbsp; &nbsp;<input type="radio" name="bday_show" value="0" {BDAY_SHOW_NO} />{L_CONDITIONAL}</td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <!-- {L_BDAY_SEND_GREETING}<br /><span class="gensmall">{L_BDAY_SEND_GREETING_EXPLAIN}</span> -->
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_BDAY_SEND_GREETING}</span>
      <span class="evo-sprite help tooltip float-right" title="{L_BDAY_SEND_GREETING_EXPLAIN}"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;">
      <input type="checkbox" name="bday_email_mask" value="{BDAY_EMAIL}" {BDAY_EMAIL_ENABLED} /> {L_EMAIL}&nbsp;&nbsp;
      <input type="checkbox" name="bday_pm_mask" value="{BDAY_PM}" {BDAY_PM_ENABLED} /> {L_PM}&nbsp;&nbsp;
      <input type="checkbox" name="bday_popup_mask" value="{BDAY_POPUP}" {BDAY_POPUP_ENABLED} /> {L_POPUP}&nbsp;&nbsp;
    </td>
  </tr>
</table>
</span>