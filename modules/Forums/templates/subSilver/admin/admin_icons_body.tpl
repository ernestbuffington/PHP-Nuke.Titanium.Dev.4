<h1>{L_TITLE}</h1>
<p>{L_TITLE_EXPLAIN}</p>

<form action="{S_ACTION}" method="post">
<table width="100%" cellpadding="2" cellspacing="0">
  <tr>
	<td><span class="nav"><a href="{S_ACTION}" class="nav">{L_TITLE}</a></span></td>
  </tr>
</table>

<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline">
  <tr>
	<td class="catHead" style="width: 10px; height: 30px; text-align: center; text-transform: uppercase;">{L_TITLE}</td>
	<td class="catHead" style="height: 30px; text-align: center; text-transform: uppercase;">{L_TITLE_KEY}</td>
	<td class="catHead" style="height: 30px; text-align: center; text-transform: uppercase;">{L_PERMISSIONS}</td>
	<td class="catHead" style="height: 30px; text-align: center; text-transform: uppercase;">{L_DEFAULT}</td>
	<td class="catHead" style="height: 30px; text-align: center; text-transform: uppercase;">{L_USAGE}</td>
	<td class="catHead" style="height: 30px; text-align: center; text-transform: uppercase;" colspan="2">{L_ACTION}</td>
  </tr>
  <!-- BEGIN row -->

  <tr>
	<td class="row1" style="width: 10px; text-align: center">{row.ICON}</td>
	<td class="row1">{row.L_LANG}{row.LANG_KEY}</td>
	<td class="row2" align="center"><span class="gen">{row.L_AUTH}</span></td>
	<td class="row2" align="center"><!-- BEGIN default -->{row.default.L_DEFAULT}<br /><!-- END default --></td>
	<td class="row2" align="center">{row.USAGE}</td>
	<td class="row3" align="center">
		<a href="{row.U_EDIT}" alt="{L_EDIT}" class="genmed">{L_EDIT}</a>&nbsp;&nbsp;
		<a href="{row.U_DELETE}" alt="{L_DELETE}" class="genmed">{L_DELETE}</a>
	</td>
	<td class="row3" align="center">
		<a href="{row.U_MOVEUP}" alt="{L_MOVEUP}" class="genmed">{L_MOVEUP}</a><br />
		<a href="{row.U_MOVEDW}" alt="{L_MOVEDW}" class="genmed">{L_MOVEDW}</a>
	</td>
  </tr>
  
  <!-- END row -->
  <tr>
	<td class="catBottom" colspan="7" align="center">{S_HIDDEN_FIELDS}<input type="submit" name="create" class="mainoption" value="{L_CREATE}" /></td>
  </tr>
</table>
</form>