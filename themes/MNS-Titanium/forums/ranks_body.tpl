<table width="100%" cellspacing="2" cellpadding="2" border="0">
  <tr> 
    <td align="left" valign="middle" width="100%"><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a> 
      -> {L_RANKS}</span></td>
  </tr>
</table>

<table width="100%" border="0" cellpadding="0" cellspacing="5">
<tr>

    <td valign="top" width="50%">
        <table border="0" cellpadding="4" cellspacing="1" class="forumline" width="100%">
        <tr>
            <th class="thHead" height="25" valign="middle" colspan="3">{L_RANKS}</th>
        </tr>
        <tr>
            <td class="catLeft" nowrap="nowrap" align="center"><span class="cattitle">&nbsp;{L_RANKS}&nbsp;</span></td>
            <td class="cat" nowrap="nowrap" align="center"><span class="cattitle">&nbsp;{L_MINI}&nbsp;</span></td>
            <!-- BEGIN no_std_userlist -->
            <td class="cat" nowrap="nowrap" align="center"><span class="cattitle">&nbsp;{L_TOTAL_USERS}&nbsp;</span></td>
            <!-- END no_std_userlist -->
        </tr>
        <!-- BEGIN ranks -->
        <tr>
            <!-- BEGIN userlist -->
            <td class="row1" align="center" rowspan="2" nowrap="nowrap">
            <!-- END userlist -->
            <!-- BEGIN no_userlist -->
            <td class="row1" align="center" nowrap="nowrap">
            <!-- END no_userlist -->
                <span class="gen">{ranks.RANK_TITLE}<br />{ranks.RANK_IMAGE}</span>
            </td>
            <td class="row2" align="center" valign="top">
                <span class="gensmall">{ranks.RANK_MINI}</span>
            </td>
            <!-- BEGIN no_userlist -->
            <td class="row2" align="center" valign="top">
                <span class="gensmall">{ranks.RANK_TOTAL}</span>
            </td>
            <!-- END no_userlist -->
        </tr>
        <!-- BEGIN userlist -->
        <tr>
            <td class="row1" colspan="2" valign="top">
                <span class="gensmall">&nbsp;{ranks.userlist.USERS_LIST}</span>
            </td>
        </tr>
        <!-- END userlist -->
        <!-- END ranks -->
        </table>
    </td>

    <td valign="top" width="50%">
        <table border="0" cellpadding="4" cellspacing="1" class="forumline" width="100%">
        <tr>
            <th class="thHead" height="25" valign="middle" colspan="2">{L_SPECIAL_RANKS}</th>
        </tr>
        <tr>
            <td class="catLeft" nowrap="nowrap" align="center"><span class="cattitle">&nbsp;{L_SPECIAL_RANKS}&nbsp;</span></td>
            <td class="cat" nowrap="nowrap" valign="top" align="center">
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
            <td class="row1" align="center" nowrap="nowrap">
                <span class="gen">{spe_ranks.RANK_TITLE}<br />{spe_ranks.RANK_IMAGE}</span>
            </td>
            <!-- BEGIN userlist -->
            <td class="row2" valign="top">
                <span class="gensmall">{spe_ranks.userlist.USERS_LIST}</span>
            </td>
            <!-- END userlist -->
            <!-- BEGIN no_userlist -->
            <td class="row2" align="center" valign="top">
                <span class="gensmall">{spe_ranks.no_userlist.RANK_TOTAL}</span>
            </td>
            <!-- END no_userlist -->
        </tr>
        <!-- END spe_ranks -->
        </table>
    </td>
</tr>
</table>