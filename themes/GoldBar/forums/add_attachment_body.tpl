<!-- GitHub v1.0 Theme -->
<tr>
  <td class="catHead" colspan="2" style="height: 30px; text-align: center;"><h1>{L_ADD_ATTACH_TITLE}</h1></td>
</tr>
<tr>
  <td class="row1" colspan="2" style="text-align: center">
  	<strong><strong><font size="+1">{L_ADD_ATTACH_EXPLAIN}<font></strong></strong>
  	<br />
  	{RULES}
  </td>
</tr>
<tr> 
  <td class="row1"><strong><font size="+1">{L_FILE_NAME}<font></strong></td> 
  <td class="row2"><input class="post titaniumbutton" type="file" name="fileupload" maxlength="{FILESIZE}" value="" style="width: 85%;" /></td> 
</tr> 
<tr> 
  <td class="row1"><strong><font size="+1">{L_FILE_COMMENT}<font></strong></td> 
  <td class="row2">
  	<textarea name="filecomment" wrap="virtual" class="post titaniumbutton" style="height: 100px; min-height: 100px; padding: 5px; resize: vertical; width: 85%;">{FILE_COMMENT}</textarea>
  	<br />
  	<input type="submit" name="add_attachment" value="{L_ADD_ATTACHMENT}" class="titaniumbutton" />
  </td> 
</tr>