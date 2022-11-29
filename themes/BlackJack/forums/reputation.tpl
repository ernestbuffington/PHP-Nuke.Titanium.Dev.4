<div align="right"><a href="javascript:self.close();void(0);" class="nav">{L_CLOSEWINDOW}</a></div>
<!-- BEGIN rep_stats -->
<span class="maintitle">{rep_stats.L_REPUTATION} <a href="{rep_stats.U_USERID}">{rep_stats.USERNAME}</a></span><br />
<br />
<table width="100%" cellspacing="1" cellpadding="6" border="0" align="center" class="forumline">
  <tr>
  <td width="50%" colspan="2" class="row1"><span class="genmed">{rep_stats.L_TOTALRECEIVED}:</span></td>
  <td width="50%" colspan="2" class="row1"><span class="genmed">{rep_stats.L_TOTALGIVEN}:</span></td>
  </tr>
  <tr>
  <td width="40%" class="row1"><span class="genmed">&nbsp;&nbsp;&nbsp;{rep_stats.L_REPUTATION2}</span></td>
  <td width="10%" class="row3"><span class="genmed"><font size="+1" color="{rep_stats.STATREP_COLOR}"><strong>{rep_stats.STATREP_SUM}</strong></font></span></td>
  <td width="40%" class="row1"><span class="genmed">&nbsp;&nbsp;&nbsp;{rep_stats.L_REPUTATION2}</span></td>
  <td width="10%" class="row3"><span class="genmed"><strong>{rep_stats.STATREP_SUM_GIVEN}</strong></span></td>
  </tr>
  <tr>
  <td width="40%" class="row1"><span class="genmed">&nbsp;&nbsp;&nbsp;{rep_stats.L_POSITIVE} {rep_stats.L_VOTES}</span></td>
  <td width="10%" class="row3"><span class="genmed"><font color="#008000"><strong>{rep_stats.STATREP_SUMPOS}</strong></font></span></td>
  <td class="row1"><span class="genmed">&nbsp;&nbsp;&nbsp;{rep_stats.L_POSITIVE} {rep_stats.L_VOTES}</span></td>
  <td class="row3"><span class="genmed"><font color="#008000">{rep_stats.STATREP_SUMPOS_GIVEN}</font></span></td>
  </tr>
  <tr>
  <td class="row1"><span class="genmed">&nbsp;&nbsp;&nbsp;{rep_stats.L_NEGATIVE} {rep_stats.L_VOTES}</span></td>
  <td class="row3"><span class="genmed"><font color="#FF0000"><strong>{rep_stats.STATREP_SUMNEG}</strong></font></span></td>
  <td class="row1"><span class="genmed">&nbsp;&nbsp;&nbsp;{rep_stats.L_NEGATIVE} {rep_stats.L_VOTES}</span></td>
  <td class="row3"><span class="genmed"><font color="#FF0000"><strong>{rep_stats.STATREP_SUMNEG_GIVEN}</strong></font></span></td>
  </tr>
</table>
<table width="100%">
  <tr>
  <td align="right"><span class="gensmall"><a href="{rep_stats.U_GLOBALSTATS}">{rep_stats.L_GLOBALSTATS}</a></span></td>
  </tr>
</table>
<table width="100%" cellspacing="1" cellpadding="6" border="0" align="center" class="forumline">
  <tr>
  <th align="left" class="thCornerL">{rep_stats.L_WHO}</th>
  <th align="left" class="thCornerL">{rep_stats.L_WHOM}</th>
  <th align="left" class="thTop">{rep_stats.L_DIR}</th>
  <th align="left" class="thTop">{rep_stats.L_HOWMUCH}</th>
  <th align="left" class="thTop">{rep_stats.L_POST}</th>
  <th align="left" class="thTop">{rep_stats.L_COMMENT}</th>
  <th align="left" class="thCornerR">{rep_stats.L_DATE}</th>
  </tr>
  <!-- BEGIN row -->
  <tr class="genmed">
  <td class="{rep_stats.row.ROW}"><a href="{rep_stats.row.U_USERID2}">{rep_stats.row.USERNAME2}</a></td>
  <td class="{rep_stats.row.ROW}"><a href="{rep_stats.row.U_USERID}">{rep_stats.row.USERNAME}</a></td>
  <td class="{rep_stats.row.ROW}"><div align="center">{rep_stats.row.REPNEG}</div></td>
  <td class="{rep_stats.row.ROW}"><div align="center">{rep_stats.row.REPSUM}</div></td>
  <td class="{rep_stats.row.ROW}"><a href="{rep_stats.row.U_POST}">{rep_stats.row.POST}</a></td>
  <td class="{rep_stats.row.ROW}">{rep_stats.row.REPCOMMENT}</td>
  <td class="{rep_stats.row.ROW}">{rep_stats.row.REPTIME}</td>
  </tr>
  <!-- END row -->
</table>

<table width="100%" border="0" cellspacing="4" cellpadding="4">
  <tr>
  <td width="150" class="row1"><span class="gensmall">{rep_stats.L_RECEIVEDREPUTATION}</span></td>
  <td width="150" class="row3"><span class="gensmall">{rep_stats.L_GIVENREPUTATION}</span></td>
  <td width="*"></td>
  <td><span class="nav">{PAGE_NUMBER}</span></td>
  <td align="right"><span class="nav">{rep_stats.PAGINATION}</span></td>
  </tr>
</table>
<!-- END rep_stats -->

<!-- BEGIN rep_globalstats -->
<span class="maintitle">{rep_globalstats.L_GLOBALSTATS}</span><br /><br />
<table width="100%" cellspacing="1" cellpadding="6" border="0" align="center" class="forumline">
  <tr>
  <td class="row1"><span class="genmed">{rep_globalstats.L_TOTAL_GIVEN_BY_USERS}</span></td>
  <td class="row3"><span class="genmed">{rep_globalstats.TOTAL_GIVEN_BY_USERS}</span></td>
  </tr>
  <tr>
  <td class="row1"><span class="genmed">{rep_globalstats.L_ACTIVE_USER}</span></td>
  <td class="row3"><span class="genmed"><a href="{rep_globalstats.U_ACTIVE_USER_ID}">{rep_globalstats.ACTIVE_USER}</a> ({rep_globalstats.TOTAL_GIVEN_BY_ACTIVE_USER})</span></td>
  </tr>
  <tr>
  <td class="row1"><span class="genmed">{rep_globalstats.L_BEST_REP_USER}</span></td>
  <td class="row3"><span class="genmed"><a href="{rep_globalstats.U_MAX_USERREP_USERID}">{rep_globalstats.MAX_USERREP_USERNAME}</a> ({rep_globalstats.L_REPUTATION}: <strong>{rep_globalstats.MAX_USERREP}</strong>)</span></td>
  </tr>
  <tr>
  <td class="row1"><span class="genmed">{rep_globalstats.L_WORST_REP_USER}</span></td>
  <td class="row3"><span class="genmed"><a href="{rep_globalstats.U_MIN_USERREP_USERID}">{rep_globalstats.MIN_USERREP_USERNAME}</a> ({rep_globalstats.L_REPUTATION}: <strong>{rep_globalstats.MIN_USERREP}</strong>)</span></td>
  </tr>
  <tr>
  <td class="row1"><span class="genmed">{rep_globalstats.L_MAX_GIVEN_SUM}</span></td>
  <td class="row3"><span class="genmed"><strong>{rep_globalstats.MAX_REPSUM}</strong> (<a href="{rep_globalstats.U_MAX_REPSUM_USERID}">{rep_globalstats.MAX_REPSUM_USERNAME}</a>)</span></td>
  </tr>
</table>
<br />
<table width="100%" cellspacing="1" cellpadding="6" border="0" align="center" class="forumline">
  <tr>
  <th align="left" class="thCornerL">{rep_globalstats.L_WHO}</th>
  <th align="left" class="thCornerL">{rep_globalstats.L_WHOM}</th>
  <th align="left" class="thTop">{rep_globalstats.L_DIR}</th>
  <th align="left" class="thTop">{rep_globalstats.L_HOWMUCH}</th>
  <th align="left" class="thTop">{rep_globalstats.L_POST}</th>
  <th align="left" class="thTop">{rep_globalstats.L_COMMENT}</th>
  <th align="left" class="thCornerR">{rep_globalstats.L_DATE}</th>
  </tr>
  <!-- BEGIN row -->
  <tr class="genmed">
  <td class="row1"><a href="{rep_globalstats.row.U_USERID2}">{rep_globalstats.row.USERNAME2}</a></td>
  <td class="row1"><a href="{rep_globalstats.row.U_USERID}">{rep_globalstats.row.USERNAME}</a></td>
  <td class="row1"><div align="center">{rep_globalstats.row.REPNEG}</div></td>
  <td class="row1"><div align="center">{rep_globalstats.row.REPSUM}</div></td>
  <td class="row1"><a href="{rep_globalstats.row.U_POST}">{rep_globalstats.row.POST}</a></td>
  <td class="row1">{rep_globalstats.row.REPCOMMENT}</td>
  <td class="row1">{rep_globalstats.row.REPTIME}</td>
  </tr>
  <!-- END row -->
</table>
<table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tr>
  <td><span class="nav">{PAGE_NUMBER}</span></td>
  <td align="right"><span class="nav">{rep_globalstats.PAGINATION}</span></td>
  </tr>
</table>
<!-- END rep_globalstats -->

<!-- BEGIN rep_add -->
<span class="maintitle">{rep_add.L_REPUTATIONGIVING} <a href="{rep_add.U_USERID}">{rep_add.USERNAME}</a></span><br />
<span class="genmed">
<form action="modules.php?name=Forums&amp;file=reputation&amp;a=post" method="post" name="rep_form" id="rep_form">
<strong>{rep_add.L_YOUHAVEPOINTS}: <font size="+1">{rep_add.REPSUM}</strong></font><br />

<table width="100%" cellspacing="1" cellpadding="6" border="0" align="center" class="forumline">
  <tr>
  <th align="left" class="thCornerR">{rep_add.L_DESCR}</th>
  <th align="left" class="thCornerR">{rep_add.L_FORM}</th>
  </tr>
<!-- BEGIN switch_adv_mode -->
  <tr class="genmed">
  <td class="row1">{rep_add.L_ENTERREPSUM}<br />
  <span class="gensmall">{rep_add.L_ENTERREPSUM_EXPLAIN}</span></td>
  <td class="row3"><input type="text" name="rep_sum_to_give" size="10"></td>
  </tr>
<!-- END switch_adv_mode -->
  <tr class="genmed">
  <td class="row1">{rep_add.L_CHOOSEDIR}<br />
  <span class="gensmall">{rep_add.L_CHOOSEDIR_EXPLAIN}</span></td>
  <td class="row3"><input type="radio" name="rep_neg_to_give" value="0" checked><img src="modules/Forums/images/reputation_pos.gif" alt="" border="0" align="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="rep_neg_to_give" value="1"><img src="modules/Forums/images/reputation_neg.gif" alt="" border="0" align="middle"></td>
  </tr>
  <tr class="genmed">
  <td class="row1">{rep_add.L_ENTERCOMMENT}<br />
  <span class="gensmall">{rep_add.L_ENTERCOMMENT_EXPLAIN}</span></td>
  <td class="row3"><textarea cols="50" rows="4" name="rep_comment_to_give"></textarea></a></td>
  </tr>
  <tr class="genmed">
  <td class="row1">&nbsp;</td>
  <td class="row3"><input type="submit" name="submit" value="{rep_add.L_GIVE}">
  <input type="hidden" name="user_id_to_give" value="{rep_add.USER_ID_TO_GIVE}">
  <input type="hidden" name="post_id_to_give" value="{rep_add.POST_ID_TO_GIVE}">
  <input type="hidden" name="ccode" value="{rep_add.CCODE}">
  {SIMPLE_HIDDEN}
  </form></td>
  </tr>
</table>
<!-- END rep_add -->
<br /><div align="center"><span class="copyright">Powered by Users Reputations system v1.0.0 &copy; 2006 <a href="http://granik.com" target="_blank" class="copyright">Anton Granik</a></span></div>