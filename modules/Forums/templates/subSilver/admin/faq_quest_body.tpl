<h1>{L_TITLE}</h1>

<p>{L_EXPLAIN}</p>

<form action="{S_ACTION}" method="post">
  <table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline" align="center">
    <tr> 
      <th class="thHead" colspan="2">{L_TITLE}</th>
    </tr>
    <tr> 
      <td class="row1">{L_BLOCK}</td>
      <td class="row2"><select name="block" style="width:350px; ">{S_BLOCK_LIST}</select></td>
    </tr>
    <tr> 
      <td class="row1">{L_QUESTION}</td>
      <td class="row2"><input type="text" size="50" style="width:350px; " name="quest_title" value="{QUESTION}" class="post" /></td>
    </tr>
    <tr> 
      <td class="row1">{L_ANSWER}</td>
      <td class="row2"><textarea wrap="virtual" name="answer" class="post" style="width:350px; " rows="8">{ANSWER}</textarea></td>
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