  <tr>
    <td class="catHead" colspan="2" style="text-align: center;">{L_ADD_A_POLL}</td>
  </tr>
  <tr>
    <td class="row1" colspan="2" style="text-align: center;">{L_ADD_POLL_EXPLAIN}</td>
  </tr>
  <tr>
    <td class="row1">{L_POLL_QUESTION}</td>
    <td class="row2"><input type="text" name="poll_title" size="50" maxlength="255" class="post" value="{POLL_TITLE}" /></td>
  </tr>
  <!-- BEGIN poll_option_rows -->
  <tr>
    <td class="row1">{L_POLL_OPTION}</td>
    <td class="row2"><input type="text" name="poll_option_text[{poll_option_rows.S_POLL_OPTION_NUM}]" size="50" class="post" maxlength="255" value="{poll_option_rows.POLL_OPTION}" /> &nbsp;<input type="submit" name="edit_poll_option" value="{L_UPDATE_OPTION}" class="titaniumbutton" /> <input type="submit" name="del_poll_option[{poll_option_rows.S_POLL_OPTION_NUM}]" value="{L_DELETE_OPTION}" class="titaniumbutton" /></td>
  </tr>
  <!-- END poll_option_rows -->
  <tr>
    <td class="row1">{L_POLL_OPTION}</td>
    <td class="row2"><input type="text" name="add_poll_option_text" size="50" maxlength="255" class="post" value="{ADD_POLL_OPTION}" /> &nbsp;<input type="submit" name="add_poll_option" value="{L_ADD_OPTION}" class="titaniumbutton" /></td>
  </tr>
  <tr>
    <td class="row1">{L_POLL_LENGTH}</td>
    <td class="row2"><input type="text" name="poll_length" size="3" maxlength="3" class="post" value="{POLL_LENGTH}" />&nbsp;{L_DAYS}&nbsp;{L_POLL_LENGTH_EXPLAIN}</td>
  </tr>
  <tr>
    <td class="row1">{L_POLL_TOGGLE}</td>
    <td class="row2"><input type="checkbox" name="poll_view_toggle" value="1" {POLL_TOGGLE_CHECKED} />&nbsp;{L_POLL_TOGGLE_EXPLAIN}</td>
  </tr>
  <!-- BEGIN switch_poll_delete_toggle -->
  <tr>
    <td class="row1">{L_POLL_DELETE}</td>
    <td class="row2"><input type="checkbox" name="poll_delete" /></td>
  </tr>
  <!-- END switch_poll_delete_toggle -->