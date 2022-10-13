
<table width="100%" cellspacing="2" cellpadding="2" border="0" >
  <tr> 
	<td align="left" valign="bottom" colspan="2">»» <a class="maintitle" href="{U_VIEW_TOPIC}">{TOPIC_TITLE}</a><br />
	  <span class="gensmall"><b>{PAGINATION}</b><br />
	    </span></td>
  </tr>
</table>

<table width="100%" cellspacing="2" cellpadding="2" border="0" class="tablein">
  <tr> 
	<td align="left" valign="bottom" nowrap="nowrap"><span class="nav"><a href="{U_POST_NEW_TOPIC}"><img src="{POST_IMG}" border="0" alt="{L_POST_NEW_TOPIC}" align="middle" /></a>   <a href="{U_POST_REPLY_TOPIC}"><img src="{REPLY_IMG}" border="0" alt="{L_POST_REPLY_TOPIC}" align="middle" /></a></span></td>
	<td align="left" valign="middle" width="100%"><span class="nav">   <a href="{U_INDEX}" class="nav">{L_INDEX}</a> 
	  » <a href="{U_VIEW_FORUM}" class="nav">{FORUM_NAME}</a></span></td>
  </tr>
</table>

<table class="forumline" width="100%" cellspacing="1" cellpadding="3" border="0">
	<tr align="right">
		<td class="catHead" colspan="2" height="28"><span class="nav"><a href="{U_VIEW_OLDER_TOPIC}" class="nav">{L_VIEW_PREVIOUS_TOPIC}</a> :: <a href="{U_VIEW_NEWER_TOPIC}" class="nav">{L_VIEW_NEXT_TOPIC}</a>  </span></td>
	</tr>
	{POLL_DISPLAY} 
	<tr>
		<th class="thLeft" width="150" height="26" nowrap="nowrap">{L_AUTHOR}</th>
		<th class="thRight" nowrap="nowrap">{L_MESSAGE}</th>
	</tr>
	<!-- BEGIN postrow -->
	<tr> 
		<td width="150" align="left" valign="top" class="{postrow.ROW_CLASS}"><span class="name">{postrow.rowtit}<a name="{postrow.U_POST_ID}"></a><b>{postrow.POSTER_NAME}</b></span><br /><span class="postdetails">{postrow.POSTER_RANK}<br />{postrow.RANK_IMAGE}{postrow.POSTER_AVATAR}<br /><br />{postrow.POSTER_JOINED}<br />{postrow.POSTER_POSTS}<br />{postrow.POSTER_FROM}<br />{postrow.POSTER_ONLINE_STATUS}</span><br /></td>
		<td class="{postrow.ROW_CLASS}" width="100%" height="28" valign="top">
		
		<table border="0" align=center cellpadding="0" cellspacing="0" width="98%">
  <tr>
   <td><img name="tlc" src="themes/MNS-Cortex/images/2tl.jpg" width="32" height="54" border="0" alt=""></td> 
   <td width="100%" background="themes/MNS-Cortex/images/2t.jpg"><img name="tm" src="themes/MNS-Cortex/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
   <td><img name="trc" src="themes/MNS-Cortex/images/2tr.jpg" width="32" height="54" border="0" alt=""></td>
  </tr>
  <tr>
    <td background="themes/MNS-Cortex/images/2l.jpg"><img name="leftside" src="themes/MNS-Cortex/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
     <td valign="top" bgcolor="#161F29">
		
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="100%"><a href="{postrow.U_MINI_POST}"><img src="{postrow.MINI_POST_IMG}" width="12" height="9" alt="{postrow.L_MINI_POST_ALT}" title="{postrow.L_MINI_POST_ALT}" border="0" /></a><span class="postdetails">{L_POSTED}: {postrow.POST_DATE}<span class="gen">&nbsp;</span>&nbsp; &nbsp;{L_POST_SUBJECT}: {postrow.POST_SUBJECT}</span></td>
                        <td valign="top" align="right" nowrap="nowrap">{postrow.QUOTE_IMG} {postrow.EDIT_IMG} {postrow.REPORT_IMG} {postrow.DELETE_IMG} {postrow.IP_IMG} {postrow.topicjump}</td>
                    </tr>
                    <tr> 	
                        <td colspan="2"><hr /></td>
                    </tr>	
                    <tr>
                        <td colspan="2" HEIGHT="100%" VALIGN="TOP"><span class="postbody">{postrow.MESSAGE}</span>{postrow.ATTACHMENTS}<span class="postbody"></span><BR /><SPAN CLASS="gensmall">{postrow.EDITED_MESSAGE}</SPAN></td>
                    </tr>
                    <tr>
                        <td colspan="2" VALIGN="BOTTOM"><SPAN CLASS="postbody">{postrow.SIGNATURE}</SPAN></td>
                   </tr>
		</table>
		
		</td>
    <td background="themes/MNS-Cortex/images/2r.jpg"><img name="rightside" src="themes/MNS-Cortex/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
  </tr>
  <tr>
   <td><img name="blc" src="themes/MNS-Cortex/images/2bl.jpg" width="32" height="52" border="0" alt=""></td>
   
    <td background="themes/MNS-Cortex/images/2b.jpg"><img name="tbm" src="themes/MNS-Cortex/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
   <td><img name="brc" src="themes/MNS-Cortex/images/2br.jpg" width="32" height="52" border="0" alt=""></td>
  </tr></table>
		
		</td>
	</tr>
	<tr> 
		<td class="{postrow.ROW_CLASS}" width="150" align="left" valign="middle"><span class="nav"><a href="#top" class="nav">{L_BACK_TO_TOP}</a></span></td>
		<td class="{postrow.ROW_CLASS}" width="100%" height="28" valign="bottom" nowrap="nowrap"><table cellspacing="0" cellpadding="0" border="0" height="18" width="18">
			<tr> 
				<td valign="middle" nowrap="nowrap">{postrow.THREAD_KICK_IMG} {postrow.PROFILE_IMG} {postrow.BUDDY_IMG} {postrow.PM_IMG} {postrow.EMAIL_IMG} {postrow.WWW_IMG} {postrow.AIM_IMG} {postrow.YIM_IMG} {postrow.MSN_IMG}<script language="JavaScript" type="text/javascript"><!-- 

	if ( navigator.userAgent.toLowerCase().indexOf('mozilla') != -1 && navigator.userAgent.indexOf('5.') == -1 )
		document.write(' {postrow.ICQ_IMG}');
	else
		document.write('</td><td>&nbsp;</td><td valign="top" nowrap="nowrap"><div style="position:relative"><div style="position:absolute">{postrow.ICQ_IMG}</div><div style="position:absolute;left:3px;top:-1px">{postrow.ICQ_STATUS_IMG}</div></div>');
				
				//--></script><noscript>{postrow.ICQ_IMG}</noscript></td>
			</tr>
		</table></td>
	</tr>
	<tr> 
		<td class="spaceRow" colspan="2" height="1"><img src="themes/MNS-Cortex/forums/images/spacer.gif" alt="" width="1" height="1" /></td>
	</tr>
	<!-- END postrow -->
	<tr align="center"> 
		<td class="catBottom" colspan="2" height="28"><table cellspacing="0" cellpadding="0" border="0">
			<tr><form method="post" action="{S_POST_DAYS_ACTION}">
				<td align="center"><span class="gensmall">{L_DISPLAY_POSTS}: {S_SELECT_POST_DAYS} {S_SELECT_POST_ORDER} <input type="submit" value="{L_GO}" class="liteoption" name="submit" /></span></td>
			</form></tr>
		</table></td>
	</tr>
</table>

<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center" class="tablein">
  <tr> 
	<td align="left" valign="middle" nowrap="nowrap"><span class="nav"><a href="{U_POST_NEW_TOPIC}"><img src="{POST_IMG}" border="0" alt="{L_POST_NEW_TOPIC}" align="middle" /></a>   <a href="{U_POST_REPLY_TOPIC}"><img src="{REPLY_IMG}" border="0" alt="{L_POST_REPLY_TOPIC}" align="middle" /></a></span></td>
	<td align="left" valign="middle" width="100%"><span class="nav">   <a href="{U_INDEX}" class="nav">{L_INDEX}</a> 
	  -> <a href="{U_VIEW_FORUM}" class="nav">{FORUM_NAME}</a></span></td>
<td align="right" valign="bottom"><span class="mainmenu"><a href="{U_PRINT}" title="{L_PRINT}" class="mainmenu">{L_PRINT}</a></span></td>
	<td align="right" valign="top" nowrap="nowrap"><span class="gensmall">{S_TIMEZONE}</span><br /><span class="nav">{PAGINATION}</span> 
	  </td>
  </tr>
  <tr>
	<td align="left" colspan="3"><span class="nav">{PAGE_NUMBER}</span></td>
  </tr>
</table>

<!-- BEGIN switch_quick_reply -->
	{QRBODY}
<!-- END switch_quick_reply -->

<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center" class="tablein">
  <tr> 
	<td width="40%" class="row1" valign="top" nowrap="nowrap" align="left"><span class="gensmall">{S_WATCH_TOPIC}</span><br />
	   <br />
	  {S_VIEW_KICKED}{S_TOPIC_ADMIN}</td>
	<td align="right" class="row1" valign="top" nowrap="nowrap">{JUMPBOX}<span class="gensmall">{S_AUTH_LIST}</span></td>
  </tr>
</table>

{RELATED_TOPICS}
