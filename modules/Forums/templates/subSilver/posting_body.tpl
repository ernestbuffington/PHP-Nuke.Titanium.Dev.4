<script src="modules/Forums/bbcode_box/bbcode_box.js" type="text/javascript" >
</script>

<!-- BEGIN privmsg_extensions -->
<table border="0" cellspacing="0" cellpadding="0" align="center" width="100%">
  <tr> 
    <td valign="top" align="center" width="100%"> 
      <table height="40" cellspacing="2" cellpadding="2" border="0">
        <tr valign="middle"> 
          <td>{INBOX_IMG}</td>
          <td><span class="cattitle">{INBOX_LINK}</span></td>
          <td>{SENTBOX_IMG}</td>
          <td><span class="cattitle">{SENTBOX_LINK}</span></td>
          <td>{OUTBOX_IMG}</td>
          <td><span class="cattitle">{OUTBOX_LINK}</span></td>
          <td>{SAVEBOX_IMG}</td>
          <td><span class="cattitle">{SAVEBOX_LINK}</span></td>
        </tr>
      </table>
    </td>
  </tr>
</table>

<br clear="all" />
<!-- END privmsg_extensions -->

<form action="{S_POST_ACTION}" method="post" name="post" onsubmit="return checkForm(this)" {S_FORM_ENCTYPE}>

{POST_PREVIEW_BOX}
{ERROR_BOX}

<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
    <tr> 
        <td align="left"><span  class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a>
        <!-- BEGIN switch_not_privmsg --> 
        -> <a href="{U_VIEW_FORUM}" class="nav">{FORUM_NAME}</a>
        <!-- // Begin View Topic Name While Posting MOD -->
        <!-- BEGIN reply_mode -->
                -> <a href="{U_VIEW_TOPIC}" class="nav">{TOPIC_SUBJECT}</a>
        <!-- END reply_mode -->
        <!-- // End View Topic Name While Posting MOD -->
        </span></td>
        <!-- END switch_not_privmsg -->
    </tr>
</table>

<table border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
    <tr> 
        <th class="thHead" colspan="2" height="25"><strong>{L_POST_A}</strong></th>
    </tr>
    <!-- BEGIN switch_username_select -->
    <tr> 
        <td class="row1"><span class="gen"><strong>{L_USERNAME}</strong></span></td>
        <td class="row2"><span class="genmed"><input type="text" class="post" tabindex="1" name="username" size="25" maxlength="25" value="{USERNAME}" /></span></td>
    </tr>
    <!-- END switch_username_select -->
    <!-- BEGIN switch_privmsg -->
    <tr> 
        <td class="row1"><span class="gen"><strong>{L_USERNAME}</strong></span></td>
        <td class="row2"><span class="genmed"><input type="text"  class="post" name="username" size="25" tabindex="1" value="{USERNAME}" /><input type="submit" name="usersubmit" value="{L_FIND_USERNAME}" class="liteoption" onclick="window.open('{U_SEARCH_USER}', '_phpbbsearch', 'HEIGHT=250,resizable=yes,WIDTH=400');return false;" /></span></td>
    </tr>
    <!-- END switch_privmsg -->
    <!-- Start add - Custom mass PM MOD -->
    <!-- BEGIN switch_groupmsg -->
    <tr> 
        <td class="row1"><span class="gen"><strong>{L_USERNAME}</strong></span></td>
        <td class="row2"><span class="genmed">{USERNAME}</span></td>
    </tr>
    <!-- END switch_groupmsg -->
    <!-- End add - Custom mass PM MOD -->
    <tr> 
      <td class="row1" width="22%"><span class="gen"><strong>{L_SUBJECT}</strong></span></td>
      <td class="row2" width="78%"> <span class="gen"> 
        <input type="text" name="subject" size="45" maxlength="60" style="width:450px" tabindex="2" class="post" value="{SUBJECT}" />
        </span> </td>
    </tr>
    <tr> 
      <td class="row1" valign="top"> 
        <table width="100%" border="0" cellspacing="0" cellpadding="1">
          <tr> 
            <td><span class="gen"><strong>{L_MESSAGE_BODY}</strong></span> </td>
          </tr>
          <tr> 
            <td valign="middle" align="center"> <br />
              <table width="100" border="0" cellspacing="0" cellpadding="5">
                <tr align="center"> 
                  <td colspan="{S_SMILIES_COLSPAN}" class="gensmall"><strong>{L_EMOTICONS}</strong></td>
                </tr>
                <!-- BEGIN smilies_row -->
                <tr align="center" valign="middle"> 
                  <!-- BEGIN smilies_col -->
                  <td><a href="javascript:emoticon('{smilies_row.smilies_col.SMILEY_CODE}')"><img src="{smilies_row.smilies_col.SMILEY_IMG}" border="0" alt="{smilies_row.smilies_col.SMILEY_DESC}" title="{smilies_row.smilies_col.SMILEY_DESC}" /></a></td>
                  <!-- END smilies_col -->
                </tr>
                <!-- END smilies_row -->
                <!-- BEGIN switch_smilies_extra -->
                <tr align="center"> 
                  <td colspan="{S_SMILIES_COLSPAN}"><span  class="nav"><a href="{U_MORE_SMILIES}" onclick="window.open('{U_MORE_SMILIES}', '_phpbbsmilies', 'HEIGHT=300,resizable=yes,scrollbars=yes,WIDTH=500');return false;" target="_phpbbsmilies" class="nav">{L_MORE_SMILIES}</a></span></td>
                </tr>
                <!-- END switch_smilies_extra -->
              </table>
            </td>
          </tr>
        </table>
      </td>
    <td class="row2" valign="top"><span class="gen"><span class="genmed"></span> 
        <table id="posttable" width="100%" border="1" bordercolor="#C0C0C0" style="border-collapse: collapse;" cellspacing="0" cellpadding="0" valign="top">
          <tr align="right" valign="middle"> 
            <td valign="center">
                <table width="100%" cellpadding="3" cellspacing="0" bgcolor="#FFFFFF">
                    <tr>
                        <!--<td class="row2" valign="middle"><img src="modules/Forums/bbcode_box/images/dots.gif" style="padding-left: 4px;"></td>-->
                        <td class="row2">
                            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                <tr>
                                    <td align="left" width="70%">
                                        <select name="addbbcode19"  style="height: 20px;" onchange="bbfontstyle('[font=' + this.form.addbbcode19.options[this.form.addbbcode19.selectedIndex].value + ']', '[/font]');this.selectedIndex=0;" onMouseOver="helpline('ft')">
                                            <option style="font-weight : bold;" selected="selected">Font type</option>
                                            <option value="Arial">Default font</option>
                                            <option style="font-family: Arial;" value="Arial" class="genmed">Arial</option> 
                                            <option style="font-family: Arial Black;" value="Arial Black" class="genmed">Arial Black</option> 
                                            <option style="font-family: Century Gothic;" value="Century Gothic" class="genmed">Century Gothic</option>
                                            <option style="font-family: Comic Sans MS;" value="Comic Sans MS" class="genmed">Comic Sans MS</option> 
                                            <option style="font-family: Courier New;" value="Courier New" class="genmed">Courier New</option>
                                            <option style="font-family: Georgia;" value="Georgia" class="genmed">Georgia</option> 
                                            <option style="font-family: Lucida Console;"value="Lucida Console">Lucida Console</option>
                                            <option style="font-family: Microsoft Sans Serif;" value="Microsoft Sans Serif" class="genmed">Microsoft Sans Serif</option> 
                                            <option style="font-family: Symbol;" value="Symbol" class="genmed">Symbol</option> 
                                            <option style="font-family: Tahoma;" value="Tahoma" class="genmed">Tahoma</option>
                                            <option style="font-family: Trebuchet;" value="Trebuchet" class="genmed">Trebuchet</option> 
                                            <option style="font-family: Times New Roman;" value="Times New Roman" class="genmed">Times New Roman</option> 
                                            <option style="font-family: Verdana;" value="Verdana" class="genmed">Verdana</option> 
                                        </select>
                                        <select name="addbbcode20"  style="height: 20px;" onchange="bbfontstyle('[size=' + this.form.addbbcode20.options[this.form.addbbcode20.selectedIndex].value + ']', '[/size]');this.selectedIndex=0;" onMouseOver="helpline('fs')">
                                            <option style="font-weight : bold;" selected="selected">Font Size</option>
                                            <option style="font-size: 8;" value="8" class="genmed">{L_FONT_TINY}</option>
                                            <option style="font-size: 10;" value="10" class="genmed">{L_FONT_SMALL}</option>
                                            <option style="font-size: 12;" value="12" class="genmed">{L_FONT_NORMAL}</option>
                                            <option style="font-size: 18;" value="18" class="genmed">{L_FONT_LARGE}</option>
                                            <option style="font-size: 24;" value="24" class="genmed">{L_FONT_HUGE}</option>
                                        </select>
                                        <select name="addbbcode18"  style="height: 20px;" onchange="bbfontstyle('[color=' + this.form.addbbcode18.options[this.form.addbbcode18.selectedIndex].value + ']', '[/color]');this.selectedIndex=0;" onMouseOver="helpline('fc')">
                                            <option style="font-weight : bold;" selected>Font Color</option>
                                            <option style="color:black; value="{T_FONTCOLOR1}" value="{T_FONTCOLOR1}">{L_COLOR_DEFAULT}</option>
                                            <option value="darkred">{L_COLOR_DARK_RED}</option>
                                            <option style="color:red; background-color: {T_TD_COLOR1}" value="red" class="genmed">{L_COLOR_RED}</option>
                                            <option style="color:orange; background-color: {T_TD_COLOR1}" value="orange" class="genmed">{L_COLOR_ORANGE}</option>
                                            <option style="color:brown; background-color: {T_TD_COLOR1}" value="brown" class="genmed">{L_COLOR_BROWN}</option>
                                            <option style="color:yellow; background-color: {T_TD_COLOR1}" value="yellow" class="genmed">{L_COLOR_YELLOW}</option>
                                            <option style="color:green; background-color: {T_TD_COLOR1}" value="green" class="genmed">{L_COLOR_GREEN}</option>
                                            <option style="color:olive; background-color: {T_TD_COLOR1}" value="olive" class="genmed">{L_COLOR_OLIVE}</option>
                                            <option style="color:cyan; background-color: {T_TD_COLOR1}" value="cyan" class="genmed">{L_COLOR_CYAN}</option>
                                            <option style="color:blue; background-color: {T_TD_COLOR1}" value="blue" class="genmed">{L_COLOR_BLUE}</option>
                                            <option style="color:darkblue; background-color: {T_TD_COLOR1}" value="darkblue" class="genmed">{L_COLOR_DARK_BLUE}</option>
                                            <option style="color:indigo; background-color: {T_TD_COLOR1}" value="indigo" class="genmed">{L_COLOR_INDIGO}</option>
                                            <option style="color:violet; background-color: {T_TD_COLOR1}" value="violet" class="genmed">{L_COLOR_VIOLET}</option>
                                            <option style="color:white; background-color: {T_TD_COLOR1}" value="white" class="genmed">{L_COLOR_WHITE}</option>
                                            <option style="color:black; background-color: {T_TD_COLOR1}" value="black" class="genmed">{L_COLOR_BLACK}</option>
                                            <option style="color:cadetblue; background-color: {T_TD_COLOR1}" value="cadetblue" class="genmed">{L_COLOR_CADET_BLUE}</option> 
                                            <option style="color:coral; background-color: {T_TD_COLOR1}" value="coral" class="genmed">{L_COLOR_CORAL}</option> 
                                            <option style="color:crimson; background-color: {T_TD_COLOR1}" value="crimson" class="genmed">{L_COLOR_CRIMSON}</option> 
                                            <option style="color:tomato; background-color: {T_TD_COLOR1}" value="tomato" class="genmed">{L_COLOR_TOMATO}</option> 
                                            <option style="color:seagreen; background-color: {T_TD_COLOR1}" value="seagreen" class="genmed">{L_COLOR_SEA_GREEN}</option> 
                                            <option style="color:darkorchid; background-color: {T_TD_COLOR1}" value="darkorchid" class="genmed">{L_COLOR_DARK_ORCHID}</option> 
                                            <option style="color:chocolate; background-color: {T_TD_COLOR1}"value="chocolate" class="genmed">{L_COLOR_CHOCOLATE}</option>
                                            <option style="color:deepskyblue; background-color: {T_TD_COLOR1}" value="deepskyblue" class="genmed">{L_COLOR_DEEPSKYBLUE}</option>
                                            <option style="color:gold; background-color: {T_TD_COLOR1}" value="gold" class="genmed">{L_COLOR_GOLD}</option>
                                            <option style="color:gray; background-color: {T_TD_COLOR1}" value="gray" class="genmed">{L_COLOR_GRAY}</option>
                                            <option style="color:midnightblue; background-color: {T_TD_COLOR1}" value="midnightblue" class="genmed">{L_COLOR_MIDNIGHTBLUE}</option>
                                            <option style="color:darkgreen; background-color: {T_TD_COLOR1}" value="darkgreen" class="genmed">{L_COLOR_DARKGREEN}</option>
                                            </select>
                                    </td>
                                    <td align="right" width="30%"><a href="http://hvmdesign.com/" class="gensmall" title="Advanced BBCode Box v5.0.0 MOD - by Disturbed One - www.HVMDesign.com" target="blank">&copy;</a></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr height="28">
                        <!--<td class="row2" valign="middle"><img src="modules/Forums/bbcode_box/images/dots.gif" style="padding-left: 4px;"></td>-->
                        <td class="row2" valign="middle">
                            <img src="modules/Forums/bbcode_box/images/justify.gif" class="postimage" name="justify" type="image" onClick="BBCjustify()" onMouseOver="helpline('justify')" alt="justify"><img border="0" src="modules/Forums/bbcode_box/images/right.gif" name="right" type="image" onClick="BBCright()" onMouseOver="helpline('right')" class="postimage" alt="right"><img border="0" src="modules/Forums/bbcode_box/images/center.gif" name="center" type="image" onClick="BBCcenter()" onMouseOver="helpline('center')" class="postimage" alt="center"><img border="0" src="modules/Forums/bbcode_box/images/left.gif" name="left" type="image" onClick="BBCleft()" onMouseOver="helpline('left')" class="postimage" alt="left"><img style="padding-left: 5px; padding-right: 5px;" src="modules/Forums/bbcode_box/images/blackdot.gif" width="1" height="100%" border="0" alt=""><img border="0" src="modules/Forums/bbcode_box/images/sup.gif" class="postimage" name="supscript" type="image" onClick="BBCsup()" onMouseOver="helpline('sup')" alt="" /><img border="0" src="modules/Forums/bbcode_box/images/sub.gif" name="subs" class="postimage" type="image" onClick="BBCsub()" onMouseOver="helpline('sub')" alt="" /><img style="padding-left: 5px; padding-right: 5px;" src="modules/Forums/bbcode_box/images/blackdot.gif" width="1" height="100%" border="0" alt=""><img border="0" src="modules/Forums/bbcode_box/images/bold.gif" name="bold" type="image" onClick="BBCbold()" onMouseOver="helpline('b')" class="postimage" alt="bold"><img border="0" src="modules/Forums/bbcode_box/images/italic.gif" name="italic" type="image" onClick="BBCitalic()" onMouseOver="helpline('i')" class="postimage" alt="italic"><img border="0" src="modules/Forums/bbcode_box/images/under.gif" name="under" type="image" onClick="BBCunder()" onMouseOver="helpline('u')" class="postimage" alt="under line"><img border="0" src="modules/Forums/bbcode_box/images/strike.gif" class="postimage" name="strik" type="image" onClick="BBCstrike()" onMouseOver="helpline('strike')" alt="" /><img style="padding-left: 5px; padding-right: 5px;" src="modules/Forums/bbcode_box/images/blackdot.gif" width="1" height="100%" border="0" alt=""><img border="0" src="modules/Forums/bbcode_box/images/fade.gif" name="fade" type="image" onClick="BBCfade()" onMouseOver="helpline('fade')" class="postimage" alt="fade"><img border="0" src="modules/Forums/bbcode_box/images/grad.gif" name="grad" type="image" onClick="BBCgrad()" onMouseOver="helpline('grad')" class="postimage" alt="gradient"><img style="padding-left: 5px; padding-right: 5px;" src="modules/Forums/bbcode_box/images/blackdot.gif" width="1" height="100%" border="0" alt=""><img border="0" src="modules/Forums/bbcode_box/images/rtl.gif" name="dirrtl" type="image" onClick="BBCdir('rtl')" onMouseOver="helpline('rtl')" class="postimage" alt="Right to Left"><img border="0" src="modules/Forums/bbcode_box/images/ltr.gif" name="dirltr" type="image" onClick="BBCdir('ltr')" onMouseOver="helpline('ltr')" class="postimage" alt="Left to Right"><img style="padding-left: 5px; padding-right: 5px;" src="modules/Forums/bbcode_box/images/blackdot.gif" width="1" height="100%" border="0" alt=""><img border="0" src="modules/Forums/bbcode_box/images/marqd.gif" name="marqd" type="image" onClick="BBCmarqd()" onMouseOver="helpline('marqd')" class="postimage" alt="Marque to down"><img border="0" src="modules/Forums/bbcode_box/images/marqu.gif" name="marqu" type="image" onClick="BBCmarqu()" onMouseOver="helpline('marqu')" class="postimage" alt="Marque to up"><img border="0" src="modules/Forums/bbcode_box/images/marql.gif" name="marql" type="image" onClick="BBCmarql()" onMouseOver="helpline('marql')" class="postimage" alt="Marque to left"><img border="0" src="modules/Forums/bbcode_box/images/marqr.gif" name="marqr" type="image" onClick="BBCmarqr()" onMouseOver="helpline('marqr')" class="postimage" alt="Marque to right">
                        </td>
                    </tr>
                    <tr height="28">
                        <!--<td class="row2" valign="middle"><img src="modules/Forums/bbcode_box/images/dots.gif" style="padding-left: 4px;"></td>-->
                        <td class="row2" valign="middle">
                            <img border="0" src="modules/Forums/bbcode_box/images/code.gif" name="code" type="image" onClick="BBCcode()" onMouseOver="helpline('code')" class="postimage" alt="Code"><img border="0" src="modules/Forums/bbcode_box/images/php.gif" name="php" type="image" onClick="BBCphp()" onMouseOver="helpline('php')" class="postimage" alt="Php"><img border="0" src="modules/Forums/bbcode_box/images/quote.gif" name="quote" type="image" onClick="BBCquote()" onMouseOver="helpline('quote')" class="postimage" alt="Quote"><img border="0" src="modules/Forums/bbcode_box/images/spoil.gif" class="postimage" name="spoil" type="image" onClick="BBCspoil()" onMouseOver="helpline('spoil')" alt="" /><img style="padding-left: 5px; padding-right: 5px;" src="modules/Forums/bbcode_box/images/blackdot.gif" width="1" height="100%" border="0" alt=""><img border="0" src="modules/Forums/bbcode_box/images/url.gif" name="url" type="image" onClick="BBCurl()" onMouseOver="helpline('url')" class="postimage" alt="URL"><img border="0" src="modules/Forums/bbcode_box/images/email.gif" name="email" type="image" onClick="BBCmail()" onMouseOver="helpline('mail')" class="postimage" alt="Email"><img style="padding-left: 5px; padding-right: 5px;" src="modules/Forums/bbcode_box/images/blackdot.gif" width="1" height="20" border="0" alt=""><img border="0" src="modules/Forums/bbcode_box/images/img.gif" name="img" type="image" onClick="BBCimg()" onMouseOver="helpline('img')" class="postimage" alt="Image"><img border="0" src="modules/Forums/bbcode_box/images/flash.gif" name="flash" type="image" onClick="BBCflash()" onMouseOver="helpline('flash')" class="postimage" alt="Flash"><img border="0" src="modules/Forums/bbcode_box/images/video.gif" name="video" type="image" onClick="BBCvideo()" onMouseOver="helpline('video')" class="postimage" alt="Video"><img border="0" src="modules/Forums/bbcode_box/images/sound.gif" name="stream" type="image" onClick="BBCstream()" onMouseOver="helpline('stream')" class="postimage" alt="Stream"><img border="0" src="modules/Forums/bbcode_box/images/ram.gif" name="ram" type="image" onClick="BBCram()" onMouseOver="helpline('ram')" class="postimage" alt="Real Media"><img border="0" src="modules/Forums/bbcode_box/images/googlevid.gif" name="GVideo" type="image" onClick="BBCGVideo()" onMouseOver="helpline('googlevid')" class="postimage" alt="GoogleVid"><img border="0" src="modules/Forums/bbcode_box/images/youtube.gif" name="youtube" type="image" onClick="BBCyoutube()" onMouseOver="helpline('youtube')" class="postimage" alt="Youtube"><img style="padding-left: 5px; padding-right: 5px;" src="modules/Forums/bbcode_box/images/blackdot.gif" width="1" height="100%" border="0" alt=""><img border="0" src="modules/Forums/bbcode_box/images/list.gif" name="listdf" type="image" onClick="BBClist()" onMouseOver="helpline('list')" class="postimage" alt="List" /><img border="0" src="modules/Forums/bbcode_box/images/hr.gif" name="hr" type="image" onClick="BBChr()" onMouseOver="helpline('hr')" class="postimage" alt="H-Line"><img style="padding-left: 5px; padding-right: 5px;" src="modules/Forums/bbcode_box/images/blackdot.gif" width="1" height="100%" border="0" alt=""><img border="0" src="modules/Forums/bbcode_box/images/plain.gif" name="plain" type="image" onClick="BBCplain()" onMouseOver="helpline('plain')" class="postimage" alt="Remove BBcode">
                        </td> 
                    </tr>
                </table>
            </td>
          </tr>
          <tr> 
            <td colspan="9"><span class="gensmall"> 
              <input type="text" name="helpbox" size="45" maxlength="100" style="width:100%; font-size:10px" class="helpline" value="{L_STYLES_TIP}" /></span>
             </td>
          </tr>
          <tr> 
            <td colspan="9">
                <span class="gen"><textarea name="message" rows="15" cols="35" wrap="virtual" style="width:100%; border: 0px;" tabindex="3" class="post" onselect="storeCaret(this);" onclick="storeCaret(this);" onkeyup="storeCaret(this);">{MESSAGE}</textarea></span>
            </td>
          </tr>
        </table>
        </span></td>
    </tr>
    <tr> 
      <td class="row1" valign="top"><span class="gen"><strong>{L_OPTIONS}</strong></span><br /><span class="gensmall">{HTML_STATUS}<br />{BBCODE_STATUS}<br />{SMILIES_STATUS}</span></td>
      <td class="row2"><span class="gen"> </span> 
        <table cellspacing="0" cellpadding="1" border="0">
          <!-- BEGIN switch_html_checkbox -->
          <tr> 
            <td> 
              <input type="checkbox" name="disable_html" {S_HTML_CHECKED} value="ON" />
            </td>
            <td><span class="gen">{L_DISABLE_HTML}</span></td>
          </tr>
          <!-- END switch_html_checkbox -->
          <!-- BEGIN switch_bbcode_checkbox -->
          <tr> 
            <td> 
              <input type="checkbox" name="disable_bbcode" {S_BBCODE_CHECKED} value="ON" />
            </td>
            <td><span class="gen">{L_DISABLE_BBCODE}</span></td>
          </tr>
          <!-- END switch_bbcode_checkbox -->
          <!-- BEGIN switch_smilies_checkbox -->
          <tr> 
            <td> 
              <input type="checkbox" name="disable_smilies" {S_SMILIES_CHECKED} value="ON" />
            </td>
            <td><span class="gen">{L_DISABLE_SMILIES}</span></td>
          </tr>
          <!-- END switch_smilies_checkbox -->
          <!-- BEGIN switch_signature_checkbox -->
          <tr> 
            <td> 
              <input type="checkbox" name="attach_sig" {S_SIGNATURE_CHECKED} value="ON" />
            </td>
            <td><span class="gen">{L_ATTACH_SIGNATURE}</span></td>
          </tr>
          <!-- END switch_signature_checkbox -->
          <!-- BEGIN switch_notify_checkbox -->
          <tr> 
            <td> 
              <input type="checkbox" name="notify" {S_NOTIFY_CHECKED} value="ON" />
            </td>
            <td><span class="gen">{L_NOTIFY_ON_REPLY}</span></td>
          </tr>
          <!-- END switch_notify_checkbox -->
          <!-- BEGIN switch_delete_checkbox -->
          <tr> 
            <td> 
              <input type="checkbox" name="delete" value="ON" />
            </td>
            <td><span class="gen">{L_DELETE_POST}</span></td>
          </tr>
          <!-- END switch_delete_checkbox -->    
          <!-- BEGIN switch_topic_glance_priority -->
           <tr> 
            <td> 
              <input type="checkbox" name="topic_glance_priority" {TOPIC_GLANCE_PRIORITY_CHECKED} value="1" /></td>
            <td><span class="gen">{L_TOPIC_GLANCE_PRIORITY}</span></td>
          </tr>
          <!-- END switch_topic_glance_priority -->
          <!-- BEGIN switch_lock_topic -->
          <tr> 
            <td> 
              <input type="checkbox" name="lock" {S_LOCK_CHECKED} value="ON" />
            </td>
            <td><span class="gen">{L_LOCK_TOPIC}</span></td>
          </tr>
          <!-- END switch_lock_topic -->
          <!-- BEGIN switch_unlock_topic -->
          <tr> 
            <td> 
              <input type="checkbox" name="unlock" {S_UNLOCK_CHECKED} value="ON" />
            </td>
            <td><span class="gen">{L_UNLOCK_TOPIC}</span></td>
          </tr>        

          <!-- END switch_unlock_topic -->
          <!-- BEGIN switch_type_toggle -->
          <tr> 
            <td></td>
            <td><span class="gen">{S_TYPE_TOGGLE}</span></td>
          </tr>
          <!-- END switch_type_toggle -->    

          <!-- BEGIN switch_Welcome_PM -->

          <tr> 
            <td> 
              <input type="checkbox" name="w_pm" {S_WELCOME_PM} value="ON" />
            </td>
            <td><span class="gen">{L_WELCOME_PM}</span></td>
          </tr>
          <!-- END switch_Welcome_PM -->
        </table></td>
        
    </tr>
    {ATTACHBOX}
    {POLLBOX} 
    <tr> 
      <td class="catBottom" colspan="2" align="center" height="28">{S_HIDDEN_FORM_FIELDS}<input type="submit" tabindex="5" name="preview" class="mainoption" value="{L_PREVIEW}" />&nbsp;&nbsp;<input type="submit" accesskey="s" tabindex="6" name="post" class="mainoption" value="{L_SUBMIT}" /></td>
    </tr>
  </table>

  <table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
    <tr> 
      <td align="right" valign="top"><span class="gensmall">{S_TIMEZONE}</span></td>
    </tr>
  </table>
</form>

<table width="100%" cellspacing="2" border="0" align="center">
  <tr> 
    <td valign="top" align="right">{JUMPBOX}</td>
  </tr>
</table>

{TOPIC_REVIEW_BOX}