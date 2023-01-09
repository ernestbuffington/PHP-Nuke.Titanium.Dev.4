<div align="center">
<table width="98%" style="background-color:none; height:100%;" class="viewforum" align="center" border="5" cellpadding="15" cellspacing="20" dir="ltr" id="viewforum">
<tbody>
<tr>
<td align="center">


<table width="100%" cellspacing="2" cellpadding="2" border="0">
  <tr> 
    <td style="width: 100%"><a href="{U_INDEX}">{L_INDEX}</a> <i class="fa-solid fa-arrow-right fa-lg"></i> {L_RANKS}</td>
  </tr>
</table>

<table width="100%" border="0" cellpadding="0" cellspacing="5">
  <tr>
    <td valign="top" width="50%">
      <table border="0" cellpadding="4" cellspacing="1" class="forumline" width="100%">
        <tr>
            <td class="catHead" style="text-align: center" colspan="3"><strong>{L_RANKS}</strong></td>
        </tr>
        <tr>
            <td class="catLeft" nowrap="nowrap" align="center">{L_RANKS}</td>
            <td class="cat" nowrap="nowrap" align="center">{L_MINI}</td>
            <!-- BEGIN no_std_userlist -->
            <td class="cat" nowrap="nowrap" align="center">{L_TOTAL_USERS}</td>
            <!-- END no_std_userlist -->
        </tr>

        <!-- BEGIN ranks -->
        <tr>
            <td class="row1" align="center" nowrap="nowrap">{ranks.RANK_TITLE}<br />{ranks.RANK_IMAGE}</td>
            <td class="row2" align="center" valign="top">{ranks.RANK_MINI}</td>
            <!-- BEGIN no_userlist -->
            <td class="row2" align="center" valign="top">{ranks.RANK_TOTAL}</td>
            <!-- END no_userlist -->
        </tr>
        <!-- BEGIN userlist -->
        <tr>
            <td class="row1" colspan="2" valign="top">{ranks.userlist.USERS_LIST}</td>
        </tr>
        <!-- END userlist -->
        <!-- END ranks -->

        </table>
    </td>

    <td valign="top" width="50%">
        <table border="0" cellpadding="4" cellspacing="1" class="forumline" width="100%">
        <tr>
            <td class="catHead" style="text-align: center" height="25" valign="middle" colspan="2"><strong>{L_SPECIAL_RANKS}</strong></td>
        </tr>
        <tr>
            <td class="catLeft" nowrap="nowrap" align="center"><span class="cattitle">&nbsp;{L_SPECIAL_RANKS}&nbsp;</span></td>
            <td class="cat" nowrap="nowrap" align="center">
                <!-- BEGIN no_spe_userlist -->
                <span class="cattitle">&nbsp;{L_TOTAL_USERS}&nbsp;</span>
                <!-- END no_spe_userlist -->
                <!-- BEGIN spe_userlist -->
                <span class="cattitle">&nbsp;{L_USERS_LIST}&nbsp;</span>
                <!-- END spe_userlist -->
            </td>
        </tr>
        <!-- BEGIN spe_ranks -->
        <tr>
            <td class="row1" align="center" nowrap="nowrap">{spe_ranks.RANK_TITLE}<br />{spe_ranks.RANK_IMAGE}</td>
            <!-- BEGIN userlist -->
            <td class="row2" valign="top">{spe_ranks.userlist.USERS_LIST}</td>
            <!-- END userlist -->
            <!-- BEGIN no_userlist -->
            <td class="row2" align="center" valign="top">{spe_ranks.no_userlist.RANK_TOTAL}</td>
            <!-- END no_userlist -->
        </tr>
        <!-- END spe_ranks -->
        </table>
    </td>
</tr>
</table>

</tr>
</tbody>
</table>
</div>
