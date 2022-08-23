<table cellpadding="4" cellspacing="1" border="0" class="forumline" style="width: 99%;">
  <tr {DHTML_HAND} {DHTML_ONCLICK}"show({DHTML_ID})">
    <td class="catHead menu" colspan="2" style="height: 35px; font-weight: bold; text-align: center; text-transform: uppercase;">{L_ABILITIES_SETTINGS}</td>
  </tr>
</table>

<span id="{DHTML_ID}" {DHTML_DISPLAY}>
<table cellpadding="4" cellspacing="1" border="0" class="forumline" style="width: 99%;">
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_MAX_POLL_OPTIONS}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" name="max_poll_options" size="4" maxlength="4" value="{MAX_POLL_OPTIONS}" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_ALLOW_HTML}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="allow_html" value="1" {HTML_YES} /> {L_YES} <input type="radio" name="allow_html" value="0" {HTML_NO} /> {L_NO}</td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_ALLOWED_TAGS}</span>
      <span class="tooltip icon-sprite icon-info" title="{L_ALLOWED_TAGS_EXPLAIN}"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" size="30" maxlength="255" name="allow_html_tags" value="{HTML_TAGS}" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_ALLOW_BBCODE}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="allow_bbcode" value="1" {BBCODE_YES} /> {L_YES} <input type="radio" name="allow_bbcode" value="0" {BBCODE_NO} /> {L_NO}</td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_ALLOW_SMILIES}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="allow_smilies" value="1" {SMILE_YES} /> {L_YES} <input type="radio" name="allow_smilies" value="0" {SMILE_NO} /> {L_NO}</td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_SMILIES_IN_TITLES}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="smilies_in_titles" value="1" {SMILES_IN_TITLES_YES} /> {L_YES} <input type="radio" name="smilies_in_titles" value="0" {SMILES_IN_TITLES_NO} /> {L_NO}</td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_LAST_POSTER_AVATAR}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="last_post_avatar" value="1" {AVATAR_ON_INDEX_YES} /> {L_YES} <input type="radio" name="last_post_avatar" value="0" {AVATAR_ON_INDEX_NO} /> {L_NO}</td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_HIDE_LINKS}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="hide_links" value="1" {HIDE_LINKS_YES} /> {L_YES} <input type="radio" name="hide_links" value="0" {HIDE_LINKS_NO} /> {L_NO}</td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_HIDE_IMAGES}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="hide_images" value="1" {HIDE_IMAGES_YES} /> {L_YES} <input type="radio" name="hide_images" value="0" {HIDE_IMAGES_NO} /> {L_NO}</td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_HIDE_EMAILS}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="hide_emails" value="1" {HIDE_EMAILS_YES} /> {L_YES} <input type="radio" name="hide_emails" value="0" {HIDE_EMAILS_NO} /> {L_NO}</td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_SHOW_EDITED_LOGS}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="show_edited_logs" value="1" {SHOW_EDITED_LOGS_YES} /> {L_YES} <input type="radio" name="show_edited_logs" value="0" {SHOW_EDITED_LOGS_NO} /> {L_NO}</td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_SHOW_LOCKED_LOGS}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="show_locked_logs" value="1" {SHOW_LOCKED_LOGS_YES} /> {L_YES} <input type="radio" name="show_locked_logs" value="0" {SHOW_LOCKED_LOGS_NO} /> {L_NO}</td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_SHOW_UNLOCKED_LOGS}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="show_unlocked_logs" value="1" {SHOW_UNLOCKED_LOGS_YES} /> {L_YES} <input type="radio" name="show_unlocked_logs" value="0" {SHOW_UNLOCKED_LOGS_NO} /> {L_NO}</td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_SHOW_MOVED_LOGS}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="show_moved_logs" value="1" {SHOW_MOVED_LOGS_YES} /> {L_YES} <input type="radio" name="show_moved_logs" value="0" {SHOW_MOVED_LOGS_NO} /> {L_NO}</td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_SHOW_SPLITTED_LOGS}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="show_splitted_logs" value="1" {SHOW_SPLITTED_LOGS_YES} /> {L_YES} <input type="radio" name="show_splitted_logs" value="0" {SHOW_SPLITTED_LOGS_NO} /> {L_NO}</td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_ALLOW_VIEW}</td>
    <td class="row2" style="height: 35px; width: 50%;">{ALLOW_VIEW_SELECT}</td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_SMILIES_PATH}</span>
      <span class="evo-sprite help tooltip float-right" title="{L_SMILIES_PATH_EXPLAIN}"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" maxlength="255" name="smilies_path" style="width: 400px;" value="{SMILIES_PATH}" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_ALLOW_AUTOLOGIN}</span>
      <span class="evo-sprite help tooltip float-right" title="{L_ALLOW_AUTOLOGIN_EXPLAIN}"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="allow_autologin" value="1" {ALLOW_AUTOLOGIN_YES} />{L_YES}&nbsp; &nbsp;<input type="radio" name="allow_autologin" value="0" {ALLOW_AUTOLOGIN_NO} />{L_NO}</td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_LOGIN_PAGE}</span>
      <span class="evo-sprite help tooltip float-right" title="{L_LOGIN_PAGE_EXPLAIN}"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="loginpage" value="1" {LOGINPAGE_YES} />{L_YES}&nbsp; &nbsp;<input type="radio" name="loginpage" value="0" {LOGINPAGE_NO} />{L_NO}</td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_AUTOLOGIN_TIME}</span>
      <span class="evo-sprite help tooltip float-right" title="{L_AUTOLOGIN_TIME_EXPLAIN}"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" size="3" maxlength="4" name="max_autologin_time" value="{AUTOLOGIN_TIME}" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_IMAGE_RESIZE_WIDTH}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" size="5" maxlength="4" name="image_resize_width" value="{IMAGE_RESIZE_WIDTH}" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_IMAGE_RESIZE_HEIGHT}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" size="5" maxlength="4" name="image_resize_height" value="{IMAGE_RESIZE_HEIGHT}" /></td>
  </tr>
</table>
</span>