<table width="80%" cellpadding="5" cellspacing="1" border="0" class="forumline" align="center">
  <tr> 
      <th class="thHead" colspan="3">Edit Comments</th>
  </tr>

<form method='post' name='update' action='{S_ACTION}'>
    <tr>
        <td align='left' class='row2'><strong>Game Name:</strong></td>
        <td align='left' class='row2'>{GAME_NAME}</td>
    </tr>
    <tr>
        <td align='left' class='row2'><strong>Enter comment:</strong></td>
        <td align='left' class='row2'><textarea NAME='comments' ROWS='5' COLS='60' wrap='virtual'>{COMMENTS}</textarea></td>
    </tr>
        <input type=hidden name='comment_id' value='{GAME_ID}'>
    <tr>
        <td colspan='2'align='center' class='row2'><input type='submit' name='submit' value='Submit' class='mainoption' /></td>
    </tr>
</form>
           
</table>
<br />