<h1>{L_TITLE}</h1>

<p>{L_EXPLAIN}</p>

<form action="{S_ACTION}" method="post">
  <table cellpadding="4" cellspacing="1" border="0" class="forumline" align="center">
    <tr> 
      <th colspan="2" class="thHead">{L_ARCADE_CAT_DELETE}</th>
    </tr>
    <tr> 
      <td class="row1">{L_ARCADE_CAT_TITLE}</td>
      <td class="row1"><span class="row1">{CATTITLE}</span></td>
    </tr>
    <tr> 
      <td class="row1">{L_MOVE_CONTENTS}</td>
      <td class="row1">
      <select name='to_catid'>
      {S_SELECT_TO}
      </select>
      </td>
    </tr>
    <tr> 
      <td class="cat" colspan="2" align="center">{S_HIDDEN_FIELDS}<input type="submit" name="submit" value="{S_SUBMIT_VALUE}" class="mainoption" /></td>
    </tr>
  </table>
</form>