<table cellpadding="4" cellspacing="1" border="0" class="forumline" style="width: 99%;">
  <tr {DHTML_HAND} {DHTML_ONCLICK}"show({DHTML_ID})">
    <td class="catHead menu" colspan="2" style="height: 35px; font-weight: bold; text-align: center; text-transform: uppercase;">{L_GLANCE_TITLE}</td>
  </tr>
</table>

<span id="{DHTML_ID}" {DHTML_DISPLAY}>
<table cellpadding="4" cellspacing="1" border="0" class="forumline" style="width: 99%;">
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_GLANCE_SHOW}</td>
    <td class="row2" style="height: 35px; width: 50%;">{GLANCE_SELECT}</td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_GLANCE_OVERRIDE_TITLE}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="glance_show_override" value="1" {GLANCE_SHOW_OVERRIDE_YES} /> {L_YES} <input type="radio" name="glance_show_override" value="0" {GLANCE_SHOW_OVERRIDE_NO} /> {L_NO}</td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_GLANCE_NEWS}</span>
      <span class="evo-sprite help tooltip-html float-right" title="{L_GLANCE_NEWS_EXPLAIN}"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" name="glance_news_id" size="10" maxlength="20" value="{GLANCE_NEWS_ID}" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_GLANCE_NUM_NEWS}</span>
      <span class="evo-sprite help tooltip-html float-right" title="{L_GLANCE_NUM_NEWS_EXPLAIN}"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" name="glance_num_news" size="10" maxlength="20" value="{GLANCE_NUM_NEWS}" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_GLANCE_NUM_EXPLAIN}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" name="glance_num" size="10" maxlength="20" value="{GLANCE_NUM}" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_GLANCE_IGNORE_FORUMS}</span>
      <span class="evo-sprite help tooltip-html float-right" title="{L_GLANCE_IGNORE_FORUMS_EXPLAIN}"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" name="glance_ignore_forums" size="10" maxlength="20" value="{GLANCE_IGNORE_FORUMS}" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_GLANCE_TABLE_WIDTH}</span>
      <span class="evo-sprite help tooltip-html float-right" title="{L_GLANCE_TABLE_WIDTH_EXPLAIN}"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" name="glance_table_width" size="10" maxlength="10" value="{GLANCE_TABLE_WIDTH}" /></td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">{L_GLANCE_AUTH_READ_EXPLAIN}</td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="glance_auth_read" value="1" {GLANCE_AUTH_READ_YES} /> {L_YES} <input type="radio" name="glance_auth_read" value="0" {GLANCE_AUTH_READ_NO} /> {L_NO}</td>
  </tr>
  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_GLANCE_TOPIC_LENGTH}</span>
      <span class="evo-sprite help tooltip-html float-right" title="{L_GLANCE_TOPIC_LENGTH_EXPLAIN}"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input class="post" type="text" name="glance_topic_length" size="10" maxlength="10" value="{GLANCE_TOPIC_LENGTH}" /></td>
  </tr>

  <tr>
    <td class="row1" style="height: 35px; width: 50%;">
      <span style="display: inline-block; float: left; margin-top: 2px;">{L_GLANCE_ALTERNATE_ROW}</span>
      <span class="evo-sprite help tooltip-html float-right" title="{L_GLANCE_ALTERNATE_ROW_EXPLAIN}"></span>
    </td>
    <td class="row2" style="height: 35px; width: 50%;"><input type="radio" name="glance_rowclass" value="1" {GLANCE_ALTERNATE_YES} /> {L_YES} <input type="radio" name="glance_rowclass" value="0" {GLANCE_ALTERNATE_NO} /> {L_NO}</td>
  </tr>

</table>
</span>