<tr>
  <td class="catHead" colspan="2" style="height: 30px; text-align: center;">{L_ADD_ATTACH_TITLE}</td>
</tr>
<tr>
  <td class="row1" colspan="2" style="text-align: center">
  	{L_ADD_ATTACH_EXPLAIN}
  	<br />
  	{RULES}
  </td>
</tr>
<tr> 
  <td class="row1">{L_FILE_NAME}</td> 
  <td class="row2"><input type="file" name="fileupload" maxlength="{FILESIZE}" value="" class="post" style="width: 85%;" /></td> 
</tr> 
<tr> 
  <td class="row1">{L_FILE_COMMENT}</td> 
  <td class="row2">
  	<textarea name="filecomment" wrap="virtual" class="post liteoption" style="height: 100px; min-height: 100px; padding: 5px; resize: vertical; width: 85%;">{FILE_COMMENT}</textarea>
  	<br />
  	<input type="submit" name="add_attachment" value="{L_ADD_ATTACHMENT}" class="liteoption" />
  </td> 
</tr>