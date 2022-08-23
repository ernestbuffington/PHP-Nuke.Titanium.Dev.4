<h1>{L_TITLE}</h1>

<p>{L_EXPLAIN}</p>

<form action="{S_ACTION}" method="post">
  <table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline" align="center">
    <tr> 
      <th class="thHead" colspan="2">{L_TITLE}</th>
    </tr>
    <tr> 
      <td class="row1">{L_BLOCK_NAME}</td>
      <td class="row2"><input name="block_title" value="{BLOCK_TITLE}" type="text" style="width:350px; "></td>
    </tr>
    <tr> 
      <td class="catBottom" colspan="2" align="center">
        {S_HIDDEN_FIELDS}
        <input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />
      </td>
    </tr>
  </table>
</form>
        
<br clear="all" />