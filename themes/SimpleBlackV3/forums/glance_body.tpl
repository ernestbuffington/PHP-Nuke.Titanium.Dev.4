<table width="{GLANCE_TABLE_WIDTH}" cellpadding="2" cellspacing="1" border="0" class="forumline">
  <!-- BEGIN switch_glance_news -->
  <tr>
    <td class="catHead acenter" style="font-weight: bold;">+</td>
    <td class="catHead" colspan="3">
      <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
        <tr>
          <td>{NEWS_HEADING}</td>
          <td class="aright">{switch_glance_news.PREV_URL}&nbsp;&nbsp;{switch_glance_news.NEXT_URL}&nbsp;&nbsp;</td>
        </tr>
      </table>
    </td>
    <td class="catHead acenter" style="width: 100px;">{L_FORUM}</td>
    <!-- <td class="catHead acenter" style="width: 100px;">{L_AUTHOR}</td> -->
    <td class="catHead acenter" style="width: 50px;">{L_REPLIES}</td>
    <td class="catHead" style="width: 250px;">{L_LASTPOST}</td>
  </tr>
  <!-- BEGIN switch_news_on -->
  <tbody id="phpbbGlance_news">
  <!-- END switch_news_on -->
  <!-- BEGIN switch_news_off -->
  <tbody id="phpbbGlance_news" style="display: none;">
  <!-- END switch_news_off -->    
  <!-- END switch_glance_news -->
  <!-- BEGIN news -->
  <tr>
    <td class="{news.ROW_CLASS}" style="text-align: center; width: 40px;"><a href="{news.TOPIC_LINK}">{news.BULLET}</a></td>
    <!-- IF news.ICON_ID > 0 -->
    <td class="{news.ROW_CLASS}" style="text-align: center;">{news.ICON}</td>
    <td class="{news.ROW_CLASS}" colspan="2"><a href="{news.TOPIC_LINK}">{news.TOPIC_TITLE}</a><br /><span class="textmed">{news.TOPIC_POSTER}</span></td>
    <!-- ELSE -->
    <td class="{news.ROW_CLASS}" colspan="3"><a href="{news.TOPIC_LINK}">{news.TOPIC_TITLE}</a><br /><span class="textmed">{news.TOPIC_POSTER}</span></td>
    <!-- ENDIF -->
    <td class="{news.ROW_CLASS}" style="text-align: left;"><a{news.FORUM_COLOR} href="{news.FORUM_LINK}">{news.FORUM_TITLE}</a></td>
    <!-- <td class="row1" style="text-align: left;"></td> --> <!-- {news.TOPIC_POSTER} -->
    <td class="{news.ROW_CLASS}" style="width: 120px; text-align: center;">{news.TOPIC_REPLIES}</td>
    <td class="{news.ROW_CLASS} lastpost">{news.LAST_POST_IMG}{news.TOPIC_TIME}<br />{news.LAST_POSTER}</td>
  </tr>
  <!-- END news -->
  <!-- <tr> 
    <td class="spaceRow" colspan="7" style="height: 10px">&nbsp;</td>
  </tr> -->
  <!-- BEGIN switch_glance_recent -->
  <tr>
    <td class="catHead">&nbsp;</td>
    <td class="catHead" colspan="3">
      <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
        <tr>
          <td>{RECENT_HEADING}</td>
          <td class="aright">{switch_glance_recent.PREV_URL}&nbsp;&nbsp;{switch_glance_recent.NEXT_URL}&nbsp;&nbsp;</td>
        </tr>
      </table>
    </td>
    <td class="catHead acenter" style="width: 190px;">{L_FORUM}</td>
    <td class="catHead acenter" style="width: 50px;">{L_REPLIES}</td>
    <td class="catHead" style="width: 250px;">{L_LASTPOST}</td>
  </tr>
  <!-- BEGIN switch_recent_on -->
  <tbody id="phpbbGlance_recent">
  <!-- END switch_recent_on -->
  <!-- BEGIN switch_recent_off -->
  <tbody id="phpbbGlance_recent" style="display: none;">
  <!-- END switch_recent_off -->
  <!-- END switch_glance_recent -->
  <!-- BEGIN recent -->
  <tr>
    <td class="{recent.ROW_CLASS}" style="text-align: center; width: 40px;"><a href="{recent.TOPIC_LINK}">{recent.BULLET}</a></td>
    <!-- IF recent.ICON_ID > 0 -->
    <td class="{recent.ROW_CLASS}" style="text-align: center; width: 40px;">{recent.ICON}</td>
    <td class="{recent.ROW_CLASS}" colspan="2"><a href="{recent.TOPIC_LINK}">{recent.TOPIC_TITLE}</a><br /><span class="textmed">{recent.TOPIC_POSTER}</span></td>
    <!-- ELSE -->
    <td class="{recent.ROW_CLASS}" colspan="3"><a href="{recent.TOPIC_LINK}">{recent.TOPIC_TITLE}</a><br /><span class="textmed">{recent.TOPIC_POSTER}</span></td>
    <!-- ENDIF -->
    <td class="{recent.ROW_CLASS}"><a{recent.FORUM_COLOR} href="{recent.FORUM_LINK}">{recent.FORUM_TITLE}</a></td>
    <td class="{recent.ROW_CLASS} acenter">{recent.TOPIC_REPLIES}</td>
    <td class="{recent.ROW_CLASS} lastpost">{recent.LAST_POST_IMG} {recent.LAST_POST_TIME}<br />{recent.LAST_POSTER}</td>
  </tr>
  <!-- END recent -->
</table>
<br />