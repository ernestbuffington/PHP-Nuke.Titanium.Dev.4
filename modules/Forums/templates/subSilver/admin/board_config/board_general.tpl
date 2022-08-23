<table cellpadding="4" cellspacing="1" border="0" class="forumline" style="width: 99%;">
  <tr {DHTML_HAND} {DHTML_ONCLICK}"show({DHTML_ID})">
    <td class="catHead menu" colspan="2" style="height: 35px; font-weight: bold; text-align: center; text-transform: uppercase;">{L_GENERAL_SETTINGS}</td>
  </tr>
</table>

<span id="{DHTML_ID}" {DHTML_DISPLAY}>
<table cellpadding="4" cellspacing="1" border="0" class="forumline" style="width: 99%;">
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_SERVER_NAME}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" maxlength="255" name="server_name" style="width: 350px;" value="{SERVER_NAME}" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_SERVER_PORT}</span>
      <span class="evo-sprite help tooltip float-right" title="{L_SERVER_PORT_EXPLAIN}"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" maxlength="5" size="5" name="server_port" value="{SERVER_PORT}" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_SCRIPT_PATH}</span>
      <span class="evo-sprite help tooltip float-right" title="{L_SCRIPT_PATH_EXPLAIN}"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" maxlength="255" name="script_path" style="width: 350px;" value="{SCRIPT_PATH}" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_SITE_NAME}</span>
      <span class="evo-sprite help tooltip float-right" title="{L_SITE_DESCRIPTION}"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" maxlength="100" name="sitename" style="width: 350px;" value="{SITENAME}" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_SITE_DESCRIPTION}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" maxlength="255" name="site_desc" style="width: 350px;" value="{SITE_DESCRIPTION}" /></td>
  </tr>
  <tr> 
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_GLOBAL_TITLE}</span>
      <span class="evo-sprite help tooltip float-right" title="{L_GLOBAL_TITLE_EXPLAIN}"></span>
    </td> 
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" maxlength="55" name="global_title" style="width: 350px;" value="{GLOBAL_TITLE}" /></td> 
  </tr> 
  <tr> 
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_GLOBAL}</span>
      <span class="evo-sprite help tooltip float-right" title="{L_GLOBAL_EXPLAIN}"></span>
    </td> 
    <td class="row2" style="height: 35px; width: 50%;"><textarea name="global_announcement" maxlength="255" onkeydown="return ismaxlength(this)" style="height: 100px; width: 350px;">{GLOBAL_ANNOUNCEMENT}</textarea></td> 
  </tr> 
  <tr> 
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_ENABLE_GLOBAL}</span>
      <span class="evo-sprite help tooltip float-right" title="{L_ENABLE_GLOBAL_EXPLAIN}"></span>
    </td> 
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="global_enable" value="1" {S_ENABLE_GLOBAL_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="global_enable" value="0" {S_ENABLE_GLOBAL_NO} /> {L_NO}</td> 
  </tr> 
  <tr> 
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_DISABLE_MARQUEE}</span>
      <span class="evo-sprite help tooltip float-right" title="{L_DISABLE_MARQUEE_EXPLAIN}"></span>
    </td> 
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="marquee_disable" value="1" {S_DISABLE_MARQUEE_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="marquee_disable" value="0" {S_DISABLE_MARQUEE_NO} /> {L_NO}</td> 
  </tr> 
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_DHTML}</span>
      <span class="evo-sprite help tooltip float-right" title="{L_DHTML_EXPLAIN}"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="use_dhtml" value="1" {DHTML_YES} /> {L_YES} <input type="radio" name="use_dhtml" value="0" {DHTML_NO} /> {L_NO}</td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_ADMIN_STYLE}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="use_theme_style" value="1" {ADMIN_STYLE_THEME} /> {L_YES} <input type="radio" name="use_theme_style" value="0" {ADMIN_STYLE_DEFAULT} /> {L_NO}</td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_DISABLE_BOARD}</span>
      <span class="evo-sprite help tooltip float-right" title="{L_DISABLE_BOARD_EXPLAIN}"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="board_disable" value="1" {S_DISABLE_BOARD_YES} /> {L_YES} <input type="radio" name="board_disable" value="0" {S_DISABLE_BOARD_NO} /> {L_NO}</td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_DISABLE_BOARD_ADMINVIEW}</span>
      <span class="evo-sprite help tooltip float-right" title="{L_DISABLE_BOARD_ADMINVIEW_EXPLAIN}"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="board_disable_adminview" value="1" {S_DISABLE_BOARD_ADMINVIEW_YES} /> {L_YES}  <input type="radio" name="board_disable_adminview" value="0" {S_DISABLE_BOARD_ADMINVIEW_NO} /> {L_NO}</td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_DISABLE_BOARD_MSG}</span>
      <span class="evo-sprite help tooltip-html float-right" title="{L_DISABLE_BOARD_MSG_EXPLAIN}"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" maxlength="255" name="board_disable_msg" style="width: 350px;" value="{DISABLE_BOARD_MSG}" /></td>
  </tr>
  <input type="hidden" name="require_activation" value="{ACTIVATION_NONE}" />
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_BOARD_EMAIL_FORM}</span>
      <span class="evo-sprite help tooltip float-right" title="{L_BOARD_EMAIL_FORM_EXPLAIN}"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="board_email_form" value="1" {BOARD_EMAIL_FORM_ENABLE} /> {L_ENABLED} <input type="radio" name="board_email_form" value="0" {BOARD_EMAIL_FORM_DISABLE} /> {L_DISABLED}</td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_FLOOD_INTERVAL}</span>
      <span class="evo-sprite help tooltip float-right" title="{L_FLOOD_INTERVAL_EXPLAIN}"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" size="3" maxlength="4" name="flood_interval" value="{FLOOD_INTERVAL}" /></td>
  </tr>
    <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_SEARCH_FLOOD_INTERVAL}</span>
      <span class="evo-sprite help tooltip float-right" title="{L_SEARCH_FLOOD_INTERVAL_EXPLAIN}"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" size="3" maxlength="4" name="search_flood_interval" value="{SEARCH_FLOOD_INTERVAL}" /></td>
    </tr>
   <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_MAX_LOGIN_ATTEMPTS}</span>
      <span class="evo-sprite help tooltip float-right" title="{L_MAX_LOGIN_ATTEMPTS_EXPLAIN}"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" size="3" maxlength="4" name="max_login_attempts" value="{MAX_LOGIN_ATTEMPTS}" /></td>
   </tr>
   <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_LOGIN_RESET_TIME}</span>
      <span class="evo-sprite help tooltip float-right" title="{L_LOGIN_RESET_TIME_EXPLAIN}"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" size="3" maxlength="4" name="login_reset_time" value="{LOGIN_RESET_TIME}" /></td>
   </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_MAX_SMILIES}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" name="max_smilies" size="3" maxlength="4" value="{MAX_SMILIES}" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_TOPICS_PER_PAGE}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" name="topics_per_page" size="3" maxlength="4" value="{TOPICS_PER_PAGE}" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_POSTS_PER_PAGE}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" name="posts_per_page" size="3" maxlength="4" value="{POSTS_PER_PAGE}" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_HOT_THRESHOLD}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" name="hot_threshold" size="3" maxlength="4" value="{HOT_TOPIC}" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_DEFAULT_STYLE}</td>
    <td class="row2" style="height: 35px; width: 50%;">{STYLE_SELECT}</td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_OVERRIDE_STYLE}</span>
      <span class="evo-sprite help tooltip float-right" title="{L_OVERRIDE_STYLE_EXPLAIN}"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="override_user_style" value="1" {OVERRIDE_STYLE_YES} /> {L_YES} <input type="radio" name="override_user_style" value="0" {OVERRIDE_STYLE_NO} /> {L_NO}</td>
  </tr>
  <!-- Quick Search -->
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_QUICK_SEARCH_ENABLE}</span>
      <span class="evo-sprite help tooltip float-right" title="{L_QUICK_SEARCH_ENABLE_EXPLAIN}"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="quick_search_enable" value="1" {S_QUICK_SEARCH_ENABLE_YES} /> {L_YES} <input type="radio" name="quick_search_enable" value="0" {S_QUICK_SEARCH_ENABLE_NO} /> {L_NO}</td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_DEFAULT_LANGUAGE}</td>
    <td class="row2" style="height: 35px; width: 50%;">{LANG_SELECT}</td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_DATE_FORMAT}</span>
      <span class="evo-sprite help tooltip float-right" title="{L_DATE_FORMAT_EXPLAIN}"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" name="default_dateformat" style="width: 350px;" value="{DEFAULT_DATEFORMAT}" /></td>
  </tr>
  <!-- Start replacement - Advanced time management MOD -->
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_TIME_MODE}</span>
      <span class="evo-sprite help tooltip-html float-right" title="{L_TIME_MODE_TEXT}"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;" nowrap="nowrap">
      <span>{L_TIME_MODE_AUTO}</span><br /><input type="radio" name="default_time_mode" value="6" {TIME_MODE_FULL_PC_CHECKED}/>
      <span>{L_TIME_MODE_FULL_PC}</span> <br /><input type="radio" name="default_time_mode" value="4" {TIME_MODE_SERVER_PC_CHECKED}/>
      <span>{L_TIME_MODE_SERVER_PC}</span><br /><input type="radio" name="default_time_mode" value="3" {TIME_MODE_FULL_SERVER_CHECKED}/>
      <span>{L_TIME_MODE_FULL_SERVER}</span>
      <br /><br />
      <span>{L_TIME_MODE_MANUAL}</span><br />
      <span> {L_TIME_MODE_DST}:</span><input type="radio" name="default_time_mode" value="1" {TIME_MODE_MANUAL_DST_CHECKED}/><span>{L_YES}</span>&nbsp;<input type="radio" name="default_time_mode" value="0" {TIME_MODE_MANUAL_CHECKED}/><span>{L_NO}</span>&nbsp;<input type="radio" name="default_time_mode" value="2" {TIME_MODE_SERVER_SWITCH_CHECKED}/><span>{L_TIME_MODE_DST_SERVER}</span><br />
      <span> {L_TIME_MODE_DST_TIME_LAG}: </span><input type="text" name="default_dst_time_lag" value="{DST_TIME_LAG}" maxlength="3" size="3" class="post" /><span>{L_TIME_MODE_DST_MN}</span><br />
      <span> {L_TIME_MODE_TIMEZONE}: </span><span class="gensmall">{TIMEZONE_SELECT}</span>
    </td>
  </tr>
  <!-- End replacement - Advanced time management MOD -->
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_ONLINE_TIME}</span>
      <span class="evo-sprite help tooltip float-right" title="{L_ONLINE_TIME_EXPLAIN}"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" size="3" maxlength="4" name="online_time" value="{ONLINE_TIME}" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_ENABLE_PRUNE}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="prune_enable" value="1" {PRUNE_YES} /> {L_YES} <input type="radio" name="prune_enable" value="0" {PRUNE_NO} /> {L_NO}</td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_REPORT_EMAIL}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="report_email" value="1" {REPORT_EMAIL_YES} /> {L_YES} <input type="radio" name="report_email" value="0" {REPORT_EMAIL_NO} /> {L_NO}</td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_ALLOW_NAME_CHANGE}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="allow_namechange" value="1" {NAMECHANGE_YES} /> {L_YES} <input type="radio" name="allow_namechange" value="0" {NAMECHANGE_NO} /> {L_NO}</td>
  </tr>
</table>
</span>
