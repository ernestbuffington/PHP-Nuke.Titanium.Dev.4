<table style="width: 100%" cellpadding="4" cellspacing="1" border="1" class="forumline">
  <tr>
    <td class="catHead" style="height: 30px; text-align: center;" colspan="5"><span style="font-weight:bold;">{L_VIEWING_PROFILE}</span></td>
  </tr>
  <tr>
    <td class="row1" style="width: 20%; height: 30px; text-align: center;"><a href="modules.php?name=Profile&mode=editprofile">Change my Info</a></td>
    <td class="row1" style="width: 20%; height: 30px; text-align: center;"><a href="modules.php?name=Your_Account&amp;op=edithome">Change Home</a></td>
    <td class="row1" style="width: 20%; height: 30px; text-align: center;"><a href="modules.php?name=Private_Messages">Messages</a></td>
    <td class="row1" style="width: 20%; height: 30px; text-align: center;"><a href="modules.php?name=Your_Account&amp;op=chgtheme">Change Theme</a></td>
    <td class="row1" style="width: 20%; height: 30px; text-align: center;"><a href="modules.php?name=Your_Account&amp;op=logout">Logout</a></td>
  </tr>
  <!-- IF USER_RANK_01 -->
  <tr>
    <td class="catHead" style="letter-spacing: 1px; text-align: center; height:10px;" colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td class="row1" style="text-align: center">{USER_RANK_01_IMG}{USER_RANK_01}</td>
    <td class="row1" style="text-align: center">{USER_RANK_02_IMG}{USER_RANK_02}</td>
    <td class="row1" style="text-align: center">{USER_RANK_03_IMG}{USER_RANK_03}</td>
    <td class="row1" style="text-align: center">{USER_RANK_04_IMG}{USER_RANK_04}</td>
    <td class="row1" style="text-align: center">{USER_RANK_05_IMG}{USER_RANK_05}</td>
  </tr>
  <!-- ENDIF -->

  <tr>
    <td class="catHead" style="letter-spacing: 1px; text-align: center; height:10px;" colspan="5">&nbsp;</td>
  </tr>

  <tr>
    <td class="row1" colspan="5" valign="top">
      <table style="width: 100%" cellpadding="1" cellspacing="1" border="1">
       <tr>
         <td style="width: 50%" valign="top">
           <table style="width: 100%" cellpadding="4" cellspacing="1" border="1" class="forumline">
             <tr>
               <td class="center catHead textbold" colspan="2">{L_AVATAR}</td>
             </tr>
             <tr>
               <td class="center row1" colspan="2">{AVATAR_IMG}</td>
             </tr>
             <tr>
               <td class="catHead textbold" colspan="2">{L_FORUM_INFO}</td>
             </tr>
             <tr>
               <td class="row1" style="width: 30%">{L_JOINED}</td>
               <td class="row1" style="width: 70%">{JOINED}</td>
             </tr>
             <tr>
               <td class="row1" style="width: 30%">{L_USER_LAST_VISIT}</td>
               <td class="row1" style="width: 70%">{USER_LAST_VISIT}</td>
             </tr>
             <tr>
               <td class="row1" style="width: 30%">{L_TOTAL_POSTS}</td>
               <td class="row1" style="width: 70%"><a href="{U_SEARCH_USER}">{POSTS}</a> ({POST_DAY_STATS} | {POST_PERCENT_STATS})</td>
             </tr>
             <tr>
               <td class="row1" style="width: 30%">{L_REPUTATION}</td>
               <td class="row1" style="width: 70%">{REPUTATION}</td>
             </tr>
             <tr>
               <td class="row1" style="width: 30%">{L_ONLINE_STATUS}</td>
               <td class="row1" style="width: 70%">{ONLINE_STATUS}</td>
             </tr>

             <tr>
               <td class="catHead textbold" colspan="2">{L_CONTACT_DETAILS}</td>
             </tr>
             <!-- IF WWW -->
             <tr>
               <td class="row1" style="width: 30%">{L_WEBSITE}</td>
               <td class="row1" style="width: 70%">{WWW}</td>
             </tr>
             <!-- ENDIF -->
             <!-- IF EMAIL -->
             <tr>
               <td class="row1" style="width: 30%">{L_EMAIL_ADDRESS}</td>
               <td class="row1" style="width: 70%">{EMAIL}</td>
             </tr>
             <!-- ENDIF -->
             <tr>
               <td class="row1" style="width: 30%">{L_PM}</td>
               <td class="row1" style="width: 70%">{PM}</td>
             </tr>
           </table>
         </td>
         <td style="width: 50%" valign="top">
           <table style="width: 100%" cellpadding="4" cellspacing="1" border="1" class="forumline">
             <tr>
               <td class="catHead textbold" colspan="2"">{L_ADDITIONAL_INFO}</td>
             </tr>
             <!-- BEGIN switch_admin_notes -->
             <!-- IF ADMIN_NOTES -->
             <tr>
               <td class="row1" style="width: 30%">{L_ADMIN_NOTES}</td>
               <td class="row1" style="width: 70%">{ADMIN_NOTES}</td>
             </tr>
             <!-- ENDIF -->
             <!-- END switch_admin_notes -->
             <tr>
               <td class="row1" style="width: 30%">{L_LOCATION}</td>
               <td class="row1" style="width: 70%">{LOCATION}</td>
             </tr>
             <tr>
               <td class="row1" style="width: 30%">{L_GENDER}</td>
               <td class="row1" style="width: 70%">{GENDER}</td>
             </tr>
             <!-- BEGIN xdata -->
             <tr>
               <td class="row1" style="width: 30%" nowrap="nowrap">{xdata.NAME}</td>
               <td class="row1" style="width: 70%">{xdata.VALUE}</td>
             </tr>
             <!-- END xdata --> 

			 <!-- IF USER_SIG -->
             <tr>
               <td class="catHead textbold" colspan="2">{L_USERS_SIGNATURE}</td>
             </tr>
             <tr>
               <td class="row1" colspan="2">{USER_SIG}</td>
             </tr>
             <!-- ENDIF -->

            <!-- BEGIN user_extra -->
             <tr>
              <td class="catHead textbold" colspan="2">{L_EXTRA_INFO}</td>
            </tr>
            <tr>
              <td class="row1" colspan="2">{EXTRA_INFO}</td>
            </tr>
            <!-- END user_extra -->


			<!-- BEGIN switch_user_admin -->
             <tr>
              <td class="catHead textbold" colspan="2">{L_USER_ADMIN_FOR}</td>
            </tr>
            <tr>
              <td class="row1" colspan="2">{EDIT_THIS_USER}</td>
            </tr>
            <tr>
              <td class="row1" colspan="2">{BAN_THIS_USER_IP}</td>
            </tr>
            <tr>
              <td class="row1" colspan="2">{SUSPEND_THIS_USER}</td>
            </tr>
            <tr>
              <td class="row1" colspan="2">{DELETE_THIS_USER}</td>
            </tr>
			<!-- END switch_user_admin -->
           </table>
         </td>
       </tr>
      </table>
    </td>
  </tr>
</table>
<br />