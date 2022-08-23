
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
	<th align="center" colspan="2">{L_TITLE}</th>
</tr>
<tr>
	<td class="row1" width="50%"><span class="gen">{L_LANG}</span><br /><span class="gensmall">{L_LANG_EXPLAIN}</span></td>
	<td class="row2">
		&nbsp;{S_LANGS}<br />
		&nbsp;<input name="icon_title" class="post" type="text" size="40" maxlength="255" value="{ICON_TITLE_KEY}" />
		&nbsp;<span class="gensmall">{ICON_TITLE}</span>
	</td>
</tr>
<tr>
	<td class="row1"><span class="gen">{L_ICON}</span><br /><span class="gensmall">{L_ICON_EXPLAIN}</span></td>
	<td class="row2">
		<table width="100%" cellpadding="2" cellspacing="1" border="0" />
		<tr>
			<td><span class="gensmall">{ICON}</span></td>
			<td width="100%">
				&nbsp;{S_ICONS}<br />
				&nbsp;<input name="icon_url" class="post" type="text" size="40" maxlength="255" value="{ICON_URL}" />
			</td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td class="row1"><span class="gen">{L_AUTH}</span><br /><span class="gensmall">{L_AUTH_EXPLAIN}</span></td>
	<td class="row2">&nbsp;{S_AUTHS}</td>
</tr>
<tr>
	<td class="row1"><span class="gen">{L_DEFAULT}</span><br /><span class="gensmall">{L_DEFAULT_EXPLAIN}</span></td>
	<td class="row2">
		<table width="100%" cellpadding="2" cellspacing="0" border="0">
		<!-- BEGIN defaults -->
		<tr>
			<td><input name="ids[]" type="checkbox" value="{defaults.ID}"{defaults.CHECKED} /></td>
			<td width="100%" nowrap="nowrap"><span class="gen">{defaults.NAME}</span></td>
		</tr>
		<!-- END defaults -->
		</table>
	</td>
</tr>
<tr>
	<td class="catBottom" colspan="2" align="center">{S_HIDDEN_FIELDS}
		<input type="submit" name="submit" class="mainoption" value="{L_SUBMIT}" />&nbsp;
		<input type="submit" name="refresh" class="liteoption" value="{L_REFRESH}" />&nbsp;
		<input type="submit" name="cancel" class="liteoption" value="{L_CANCEL}" />
	</td>
</tr>
</table>
</form>