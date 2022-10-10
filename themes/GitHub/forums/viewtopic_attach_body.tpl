<div align="center">        
<!-- BEGIN attach -->
    <br /><br />
          
    <!-- BEGIN denyrow -->
    <div align="center"><hr width="95%" /></div>
    <table width="95%" border="1" cellpadding="2" cellspacing="0" class="attachtable" align="center">
    <tr>
        <td width="100%" class="attachheader" align="center"><strong><span class="gen">{postrow.attach.denyrow.L_DENIED}</span></strong></td>
    </tr>
    </table>
    <div align="center"><hr width="95%" /></div>
    <!-- END denyrow -->
    <!-- BEGIN cat_stream -->
    <div align="center"><hr width="95%" /></div>
    <table width="95%" border="1" cellpadding="2" cellspacing="0" align="center">
    <tr>
        <td width="100%" colspan="2" class="attachheader center">{postrow.attach.cat_stream.DOWNLOAD_NAME}</td>
    </tr>
    <tr>
        <td width="15%" class="attachrow">{L_DESCRIPTION}:</td>
        <td width="75%" class="attachrow">
            <table width="100%" border="0" cellpadding="0" cellspacing="4" align="center">
            <tr>
                <td class="attachrow">{postrow.attach.cat_stream.COMMENT}</td>
            </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td width="15%" class="attachrow">{L_FILESIZE}:</td>
        <td width="75%" class="attachrow">{postrow.attach.cat_stream.FILESIZE} {postrow.attach.cat_stream.SIZE_VAR}</td>
    </tr>
    <tr>
        <td width="15%" class="attachrow">{postrow.attach.cat_stream.L_DOWNLOADED_VIEWED}:</td>
        <td width="75%" class="attachrow">{postrow.attach.cat_stream.L_DOWNLOAD_COUNT}</td>
    </tr>
    <tr>
        <td colspan="2" align="center"><br />
        <object id="wmp" classid="CLSID:22d6f312-b0f6-11d0-94ab-0080c74c7e95" codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=6,0,0,0" standby="Loading Microsoft Windows Media Player components..." type="application/x-oleobject"> 
        <param name="FileName" value="{postrow.attach.cat_stream.U_DOWNLOAD_LINK}"> 
        <param name="ShowControls" value="1"> 
        <param name="ShowDisplay" value="0"> 
        <param name="ShowStatusBar" value="1"> 
        <param name="AutoSize" value="1"> 
        <param name="AutoStart" value="0"> 
        <param name="Visible" value="1"> 
        <param name="AnimationStart" value="0"> 
        <param name="Loop" value="0"> 
        <embed type="application/x-mplayer2" pluginspage="http://www.microsoft.com/windows95/downloads/contents/wurecommended/s_wufeatured/mediaplayer/default.asp" src="{postrow.attach.cat_stream.U_DOWNLOAD_LINK}" name=MediaPlayer2 showcontrols=1 showdisplay=0 showstatusbar=1 autosize=1 autostart=0 visible=1 animationatstart=0 loop=0></embed> 
        </object> <br /><br />
        </td>
    </tr>
    </table>
    <div align="center"><hr width="95%" /></div>
    <!-- END cat_stream -->
    <!-- BEGIN cat_images -->
    <div align="center"><hr width="95%" /></div>
    <table width="95%" border="1" cellpadding="2" cellspacing="0" class="attachtable" align="center">
    <tr>
        <td width="100%" colspan="2" class="attachheader" align="center"><strong><span class="gen">{postrow.attach.cat_images.DOWNLOAD_NAME}</span></strong></td>
    </tr>
    <tr>
        <td width="15%" class="attachrow"><span class="genmed">&nbsp;{L_DESCRIPTION}:</span></td>
        <td width="75%" class="attachrow">
            <table width="100%" border="0" cellpadding="0" cellspacing="4" align="center">
            <tr>
                <td class="attachrow"><span class="genmed">{postrow.attach.cat_images.COMMENT}</span></td>
            </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td width="15%" class="attachrow"><span class="genmed">&nbsp;{L_FILESIZE}:</span></td>
        <td width="75%" class="attachrow"><span class="genmed">&nbsp;{postrow.attach.cat_images.FILESIZE} {postrow.attach.cat_images.SIZE_VAR}</td>
    </tr>
    <tr>
        <td width="15%" class="attachrow"><span class="genmed">&nbsp;{postrow.attach.cat_images.L_DOWNLOADED_VIEWED}:</span></td>
        <td width="75%" class="attachrow"><span class="genmed">&nbsp;{postrow.attach.cat_images.L_DOWNLOAD_COUNT}</span></td>
    </tr>
    <tr>
        <td colspan="2" align="center"><br /><a href="{postrow.attach.cat_images.IMG_SRC}" rel="lytebox" title="{postrow.attach.cat_images.COMMENT}"><img src="{postrow.attach.cat_images.IMG_SRC}" alt="{postrow.attach.cat_images.DOWNLOAD_NAME}" border="0" /></a><br /><br /></td>
    </tr>
    </table>
    <div align="center"><hr width="95%" /></div>
    <!-- END cat_images -->
    <!-- BEGIN cat_thumb_images -->
    <div align="center"><hr width="95%" /></div>
    <table width="95%" border="1" cellpadding="2" cellspacing="0" class="attachtable" align="center">
    <tr>
        <td width="100%" colspan="2" class="attachheader" align="center"><strong><span class="gen">{postrow.attach.cat_thumb_images.DOWNLOAD_NAME}</span></strong></td>
    </tr>
    <tr>
        <td width="50%" class="attachrow" align="right" valign="top"><span class="genmed">&nbsp;{L_DESCRIPTION}:</span></td>
        <td width="50%" class="attachrow" align="left" valign="top">
            <table width="100%" border="0" cellpadding="0" cellspacing="4" align="center">
            <tr>
                <td class="attachrow"><span class="genmed">{postrow.attach.cat_thumb_images.COMMENT}</span></td>
            </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td width="50%" class="attachrow" align="right" valign="top"><span class="genmed">&nbsp;{L_FILESIZE}:</span></td>
        <td width="50%" class="attachrow" align="left" valign="top"><span class="genmed">&nbsp;{postrow.attach.cat_thumb_images.FILESIZE} {postrow.attach.cat_thumb_images.SIZE_VAR}</td>
    </tr>
    <tr>
        <td width="50%" class="attachrow" align="right" valign="top"><span class="genmed">&nbsp;{postrow.attach.cat_thumb_images.L_DOWNLOADED_VIEWED}:</span></td>
        <td width="50%" class="attachrow" align="left" valign="top"><span class="genmed">&nbsp;{postrow.attach.cat_thumb_images.L_DOWNLOAD_COUNT}</span></td>
    </tr>
    <tr>
        <td colspan="2">
		<p align="center"><br /><a data-fancybox="screens" href="{postrow.attach.cat_thumb_images.IMG_SRC}" title="{postrow.attach.cat_thumb_images.COMMENT}"><img class="reimg-width reimg-link" onload="reimg(this);" onerror="reimg(this);" src="{postrow.attach.cat_thumb_images.IMG_THUMB_SRC}" alt="{postrow.attach.cat_thumb_images.DOWNLOAD_NAME}" border="0" /></a><br /><br /></td>
    </tr>
    </table>
    <div align="center"><hr width="95%" /></div>
    <!-- END cat_thumb_images -->

<!-- BEGIN attachrow -->
<div style="text-align: center;"><hr /></div>
<table width="95%" border="0" cellpadding="2" cellspacing="1" class="forumline" style="margin:auto">
  <tr>
    <td colspan="3" class="catHead center textbold" style="letter-spacing: 1px;">{postrow.attach.attachrow.DOWNLOAD_NAME}</td>
  </tr>
  <tr>
    <td class="row1" style="width: 15%; height: 10px !important;">{L_DESCRIPTION}:</td>
    <td class="row1" style="width: 75%; height: 10px !important;">{postrow.attach.attachrow.COMMENT}</td>
    <td class="row1" style="width: 10%; height: 10px !important; text-align: center;" rowspan="4"><a href="{postrow.attach.attachrow.U_DOWNLOAD_LINK}" {postrow.attach.attachrow.TARGET_BLANK}>{postrow.attach.attachrow.S_UPLOAD_IMAGE}</a></td>
  </tr>
  <tr>
    <td class="row1" style="width: 15%; height: 10px !important;">{L_FILENAME}:</td>
    <td class="row1" style="width: 75%; height: 10px !important;">{postrow.attach.attachrow.DOWNLOAD_NAME}</td>
  </tr>
  <tr>
    <td class="row1" style="width: 15%; height: 10px !important;">{L_FILESIZE}:</td>
    <td class="row1" style="width: 75%; height: 10px !important;">{postrow.attach.attachrow.FILESIZE} {postrow.attach.attachrow.SIZE_VAR}</td>
  </tr>
  <tr>
    <td class="row1" style="width: 15%; height: 10px !important;">{postrow.attach.attachrow.L_DOWNLOADED_VIEWED}:</td>
    <td class="row1" style="width: 75%; height: 10px !important;">{postrow.attach.attachrow.L_DOWNLOAD_COUNT}</td>
  </tr>
</table>
<div style="text-align: center;"><hr /></div>
<!-- END attachrow -->
    
<!-- END attach -->
</div>