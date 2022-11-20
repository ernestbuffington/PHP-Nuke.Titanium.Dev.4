<script>
<!--
    function open_postreview(ref)
    {
        height = screen.height / 3;
        width = screen.width / 2;
        window.open(ref, '_phpbbpostreview', 'HEIGHT=' + height + ',WIDTH=' + width + ',resizable=yes,scrollbars=yes');
    }
//-->
</script>

<table class="forumline" width="100%" cellspacing="1" cellpadding="3" border="0">
    <tr align="right">
        <td class="catHead" colspan="2" height="28"><span class="nav"><a href="{U_VIEW_OLDER_POST}" class="nav">{L_VIEW_PREVIOUS_POST}</a> :: <a href="{U_VIEW_NEWER_POST}" class="nav">{L_VIEW_NEXT_POST}</a> &nbsp;</span></td>
    </tr>
    <tr>
        <th class="thRight" nowrap="nowrap">{L_AUTHOR}</th>
    </tr>
    <!-- BEGIN postrow -->
    <tr>
        <td class="{postrow.ROW_CLASS}" width="100%" height="28" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="100%" align="center"><span class="name"><a name="{postrow.U_POST_ID}"></a><strong>{postrow.POSTER_NAME}</strong></span><br /><span class="postdetails">{postrow.POSTER_RANK}<br />{postrow.RANK_IMAGE}{postrow.POSTER_AVATAR}<br /><br />{postrow.POSTER_JOINED}<br />{postrow.POSTER_POSTS}<br />{postrow.POSTER_FROM}<br />{postrow.POSTER_ONLINE_STATUS}</span></td>
            </tr>
        </table></td>
    </tr>
    <tr> 
        <td class="spaceRow" colspan="2" height="1"><img src="themes/chromo/forums/images/spacer.gif" alt="" width="1" height="1" /></td>
    </tr>
    <!-- END postrow -->
    <tr>
        <th class="thRight" nowrap="nowrap">{L_MESSAGE}</th>
    </tr>
    <!-- BEGIN postrow -->
    <tr>
        <td class="{postrow.ROW_CLASS}" width="100%" height="28" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="100%"><img src="{postrow.MINI_POST_IMG}" width="12" height="9" alt="{postrow.L_MINI_POST_ALT}" title="{postrow.L_MINI_POST_ALT}" border="0" /><span class="postdetails">{L_POSTED}: {postrow.POST_DATE}<span class="gen">&nbsp;</span>&nbsp;&nbsp;&nbsp;{L_POST_SUBJECT}: {postrow.POST_SUBJECT}</span></td>
                <td valign="top" align="right" nowrap="nowrap">{postrow.QUOTE_IMG} {postrow.REPORT_IMG}</td>
            </tr>
            <tr> 
                <td colspan="2"><hr /></td>
            </tr>
            <tr>
                <td colspan="2"><span class="postbody">{postrow.MESSAGE}{postrow.SIGNATURE}</span>{postrow.ATTACHMENTS}<span class="gensmall">{postrow.EDITED_MESSAGE}</span></td>
            </tr>
        </table></td>
    </tr>
    <tr> 
        <td class="{postrow.ROW_CLASS}" width="100%" height="28" valign="bottom" nowrap="nowrap"><table cellspacing="0" cellpadding="0" border="0" height="18" width="18">
            <tr> 
                <td valign="middle" nowrap="nowrap">{postrow.PROFILE_IMG} {postrow.PM_IMG} {postrow.EMAIL_IMG} {postrow.WWW_IMG} {postrow.AIM_IMG} {postrow.YIM_IMG} {postrow.MSN_IMG}<script><!-- 

    if ( navigator.userAgent.toLowerCase().indexOf('mozilla') != -1 && navigator.userAgent.indexOf('5.') == -1 )
        document.write(' {postrow.ICQ_IMG}');
    else
        document.write('</td><td>&nbsp;</td><td valign="top" nowrap="nowrap"><div style="position:relative"><div style="position:absolute">{postrow.ICQ_IMG}</div><div style="position:absolute;left:3px;top:-1px">{postrow.ICQ_STATUS_IMG}</div></div>');
                
                //--></script><noscript>{postrow.ICQ_IMG}</noscript></td>
            </tr>
        </table></td>
    </tr>
    <!-- END postrow -->
</table>