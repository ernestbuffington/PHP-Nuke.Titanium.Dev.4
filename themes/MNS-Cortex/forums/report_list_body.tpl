<style type="text/css">
<!--
a.notfinished, a.notfinished:hover, a.notfinished:visited, a.notfinished:hover, a.notfinished:active{ color: {T_NOT_FINISHED}; }
a.finished, a.finished:hover, a.finished:visited, a.finished:hover, a.finished:active{ color: {T_FINISHED}; }
-->
</style>

<table width="100%" cellspacing="2" cellpadding="2" border="0">
   <tr>
      <td class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a></td>
   </tr>
</table>
<!-- BEGIN catrow -->
<table width="100%" cellspacing="1" cellpadding="5" border="0" class="forumline">
  <tr>
    <td class="cat" nowrap="nowrap" align="center" colspan="7" height="25"><span class="cattitle"><b>{catrow.NAME}:</b></span></td>
  </tr>
  <tr>
  	<th class="thCornerL" nowrap="nowrap">&nbsp;#&nbsp;</th>
  	<th class="thTop" nowrap="nowrap">&nbsp;{L_DATE}&nbsp;</th>
	<th class="thTop" nowrap="nowrap">&nbsp;{L_STATUS}&nbsp;</th>
	<th class="thTop" nowrap="nowrap" width="15%">&nbsp;{L_USERNAME}&nbsp;</th>
	<th class="thTop" nowrap="nowrap" width="25%">&nbsp;{L_INFO}&nbsp;</th>
	<th class="thTop" nowrap="nowrap" width="60%">&nbsp;{L_TEXT}&nbsp;</th>
	<th class="thCornerR" nowrap="nowrap" width="60%">&nbsp;{L_DELETE}?&nbsp;</th>
  </tr>
  <!-- BEGIN reportrow -->
  <tr>
    <td class="row1" align="center" nowrap="nowrap"><span class="genmed">{catrow.reportrow.ID}</span></td>
    <td class="row1" align="center" nowrap="nowrap"><span class="genmed">{catrow.reportrow.DATE}</span></td>
    <td class="row1" align="center" nowrap="nowrap"><span class="genmed">{catrow.reportrow.STATUS}</span></td>
    <td class="row1" align="center"><span class="genmed"><a href="{catrow.reportrow.USERLINK}">{catrow.reportrow.USERNAME}</a></span></td>
    <td class="row1"><span class="genmed">{catrow.reportrow.INFO}</span></td>
    <td class="row1"><span class="genmed">{catrow.reportrow.TEXT}</span></td>
    <td class="row1" align="center"><span class="genmed"><a href="{catrow.reportrow.DELETE}">{L_DELETE}</a></span></td>
  </tr>
  <!-- END reportrow -->

  <!-- BEGIN switch_no_results -->
  <tr>
    <td class="row1" align="center" nowrap="nowrap" colspan="7"><span class="genmed">&nbsp;<br />{L_NO_RESULTS}<br />&nbsp;</span></td>
  </tr>
  <!-- END switch_no_results -->
</table>
<br />
<!-- END catrow -->
