<script>
<!--
message = new Array();
<!-- BEGIN postrow -->
message[{postrow.U_POST_ID}] = "[quote=\"{postrow.EXT_POSTER_NAME}\";p=\"{postrow.U_POST_ID}\"]\n{postrow.PLAIN_MESSAGE}\n[/quote]";
<!-- END postrow -->

function addquote(post_id)
{
    window.parent.document.post.message.value += message[post_id];
    window.parent.document.post.message.focus();
    return;
}

//-->
</script>
<!-- BEGIN switch_inline_mode -->
<table style="width: 100%; table-layout: fixed" align="center" border="0" cellpadding="3" cellspacing="1" class="forumline">
  <tr> 
    <td class="catHead" style="font-weight: bold; height: 30px; text-align: center;">{L_TOPIC_REVIEW}</td>
  </tr>
  <tr>
    <td class="row1">
      <div style="min-height: 400px; height: 400px !important; overflow: auto; line-height: 1.5em; resize: none;">
    <!-- <iframe width="100%" height="300" src="{U_REVIEW_TOPIC}" > -->
<!-- END switch_inline_mode -->
      <table style="width: 100%; table-layout: fixed" border="0" cellpadding="3" cellspacing="1" class="forumline">
        <tr>
          <td class="catHead" style="height: 30px; width: 22%;">{L_AUTHOR}</td>
          <td class="catHead" style="height: 30px; width: 78%;">{L_MESSAGE}</td>
        </tr>
        <!-- BEGIN postrow -->
        <tr>
          <td class="{postrow.ROW_CLASS}" style="height: 30px; width: 22%; vertical-align: top;"><a name="{postrow.U_POST_ID}"></a>{postrow.POSTER_NAME}</td>
          <td class="{postrow.ROW_CLASS}" style="height: 30px; width: 78%;" valign="top">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="table-layout: fixed">
              <tr> 
                <td width="80%"><img src="{postrow.MINI_POST_IMG}" width="12" height="9" alt="{postrow.L_MINI_POST_ALT}" title="{postrow.L_MINI_POST_ALT}" border="0" />{L_POSTED}:&nbsp;{postrow.POST_DATE}&nbsp;&nbsp;&nbsp;{L_POST_SUBJECT}:&nbsp;{postrow.POST_SUBJECT}</td>
                <td width="20%" valign="top" align="right" nowrap="nowrap"><input style="cursor: pointer;" type="button" class="button" name="addquote" value="Quote" style="width: 50px" onclick="addquote({postrow.U_POST_ID});" /></td>
              </tr>
              <tr> 
                <td colspan="2"><hr /></td>
              </tr>
              <tr> 
                <td colspan="2"><span class="postbody">{postrow.MESSAGE}</span>{postrow.ATTACHMENTS}</td>
              </tr>
              
            </table>
          </td>
        </tr>
        <tr> 
                <td colspan="2" class="row1" style="height:10px">&nbsp;</td>
              </tr>
        <!-- END postrow -->
      </table>

      <!-- BEGIN switch_inline_mode -->
    <!-- </iframe> -->
      </div>
    </td>
  </tr>
  <tr> 
    <td class="catBottom"></td>
  </tr>
</table>

<!-- END switch_inline_mode -->