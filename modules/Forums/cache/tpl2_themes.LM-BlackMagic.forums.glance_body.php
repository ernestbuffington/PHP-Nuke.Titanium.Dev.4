<?php

// eXtreme Styles mod cache. Generated on Fri, 19 Aug 2022 23:07:23 +0000 (time=1660950443)

?><section class="index__body_glance">

	<div class="container-fluid glance-container">

		<?php

$switch_glance_news_count = ( isset($this->_tpldata['switch_glance_news.']) ) ?  sizeof($this->_tpldata['switch_glance_news.']) : 0;
for ($switch_glance_news_i = 0; $switch_glance_news_i < $switch_glance_news_count; $switch_glance_news_i++)
{
 $switch_glance_news_item = &$this->_tpldata['switch_glance_news.'][$switch_glance_news_i];
 $switch_glance_news_item['S_ROW_COUNT'] = $switch_glance_news_i;
 $switch_glance_news_item['S_NUM_ROWS'] = $switch_glance_news_count;

?>
		<div class="row"<?php

$switch_news_off_count = ( isset($switch_glance_news_item['switch_news_off.']) ) ? sizeof($switch_glance_news_item['switch_news_off.']) : 0;
for ($switch_news_off_i = 0; $switch_news_off_i < $switch_news_off_count; $switch_news_off_i++)
{
 $switch_news_off_item = &$switch_glance_news_item['switch_news_off.'][$switch_news_off_i];
 $switch_news_off_item['S_ROW_COUNT'] = $switch_news_off_i;
 $switch_news_off_item['S_NUM_ROWS'] = $switch_news_off_count;

?> style="display: none;"<?php

} // END switch_news_off

if(isset($switch_news_off_item)) { unset($switch_news_off_item); } 

?>>

			<div class="col-12 col-lg-6 phpbb-forum-info forum-glance"><?php echo isset($this->vars['NEWS_HEADING']) ? $this->vars['NEWS_HEADING'] : $this->lang('NEWS_HEADING'); ?></div>
			<div class="col-2 phpbb-forum-topic-count forum-glance d-none d-lg-block"><?php echo isset($this->vars['L_FORUM']) ? $this->vars['L_FORUM'] : $this->lang('L_FORUM'); ?></div>
			<div class="col-1 phpbb-topic-reply-count forum-glance d-none d-lg-block"><?php echo isset($this->vars['L_REPLIES']) ? $this->vars['L_REPLIES'] : $this->lang('L_REPLIES'); ?></div>
			<div class="col-3 phpbb-forum-freshness forum-glance d-none d-lg-block"><?php echo isset($this->vars['L_LASTPOST']) ? $this->vars['L_LASTPOST'] : $this->lang('L_LASTPOST'); ?></div>

		</div>
		<?php

} // END switch_glance_news

if(isset($switch_glance_news_item)) { unset($switch_glance_news_item); } 

?>


		<?php

$news_count = ( isset($this->_tpldata['news.']) ) ?  sizeof($this->_tpldata['news.']) : 0;
for ($news_i = 0; $news_i < $news_count; $news_i++)
{
 $news_item = &$this->_tpldata['news.'][$news_i];
 $news_item['S_ROW_COUNT'] = $news_i;
 $news_item['S_NUM_ROWS'] = $news_count;

?>
		<div class="row phpbb-forum forum-glance farscape">

			<div class="col-12 col-lg-6">
				<a href="<?php echo isset($news_item['TOPIC_LINK']) ? $news_item['TOPIC_LINK'] : ''; ?>"><?php echo isset($news_item['TOPIC_TITLE']) ? $news_item['TOPIC_TITLE'] : ''; ?></a><br /><?php echo isset($news_item['TOPIC_POSTER']) ? $news_item['TOPIC_POSTER'] : ''; ?>
			</div>
			<div class="col-2 d-none d-lg-block">
				<a<?php echo isset($news_item['FORUM_COLOR']) ? $news_item['FORUM_COLOR'] : ''; ?> href="<?php echo isset($news_item['FORUM_LINK']) ? $news_item['FORUM_LINK'] : ''; ?>"><?php echo isset($news_item['FORUM_TITLE']) ? $news_item['FORUM_TITLE'] : ''; ?></a>
			</div>
			<div class="col-1 d-none d-lg-block text-center"><?php echo isset($news_item['TOPIC_REPLIES']) ? $news_item['TOPIC_REPLIES'] : ''; ?></div>
			<div class="col-3 d-none d-lg-block phpbb-forum-row-freshness"><?php echo isset($news_item['LAST_POST_IMG']) ? $news_item['LAST_POST_IMG'] : ''; ?><?php echo isset($news_item['TOPIC_TIME']) ? $news_item['TOPIC_TIME'] : ''; ?><br /><?php echo isset($news_item['LAST_POSTER']) ? $news_item['LAST_POSTER'] : ''; ?></div>

		</div>
		<?php

} // END news

if(isset($news_item)) { unset($news_item); } 

?>

		<?php

$switch_glance_recent_count = ( isset($this->_tpldata['switch_glance_recent.']) ) ?  sizeof($this->_tpldata['switch_glance_recent.']) : 0;
for ($switch_glance_recent_i = 0; $switch_glance_recent_i < $switch_glance_recent_count; $switch_glance_recent_i++)
{
 $switch_glance_recent_item = &$this->_tpldata['switch_glance_recent.'][$switch_glance_recent_i];
 $switch_glance_recent_item['S_ROW_COUNT'] = $switch_glance_recent_i;
 $switch_glance_recent_item['S_NUM_ROWS'] = $switch_glance_recent_count;

?>
		<div class="row">

			<div class="col-12 col-lg-6 phpbb-forum-info forum-glance">				
				<div class="row">					
					<div class="col-6"><?php echo isset($this->vars['RECENT_HEADING']) ? $this->vars['RECENT_HEADING'] : $this->lang('RECENT_HEADING'); ?></div>
					<div class="col-6"><?php echo isset($switch_glance_recent_item['PREV_URL']) ? $switch_glance_recent_item['PREV_URL'] : ''; ?>&nbsp;&nbsp;<?php echo isset($switch_glance_recent_item['NEXT_URL']) ? $switch_glance_recent_item['NEXT_URL'] : ''; ?></div>
				</div>
			</div>
			<div class="col-2 phpbb-forum-topic-count forum-glance d-none d-lg-block"><?php echo isset($this->vars['L_FORUM']) ? $this->vars['L_FORUM'] : $this->lang('L_FORUM'); ?></div>
			<div class="col-1 phpbb-topic-reply-count forum-glance d-none d-lg-block"><?php echo isset($this->vars['L_REPLIES']) ? $this->vars['L_REPLIES'] : $this->lang('L_REPLIES'); ?></div>
			<div class="col-3 phpbb-forum-freshness forum-glance d-none d-lg-block"><?php echo isset($this->vars['L_LASTPOST']) ? $this->vars['L_LASTPOST'] : $this->lang('L_LASTPOST'); ?></div>

		</div>
		<?php

} // END switch_glance_recent

if(isset($switch_glance_recent_item)) { unset($switch_glance_recent_item); } 

?>

		<?php

$recent_count = ( isset($this->_tpldata['recent.']) ) ?  sizeof($this->_tpldata['recent.']) : 0;
for ($recent_i = 0; $recent_i < $recent_count; $recent_i++)
{
 $recent_item = &$this->_tpldata['recent.'][$recent_i];
 $recent_item['S_ROW_COUNT'] = $recent_i;
 $recent_item['S_NUM_ROWS'] = $recent_count;

?>
		<div class="row phpbb-forum forum-glance">

			<div class="col-12 col-lg-6"><a href="<?php echo isset($recent_item['TOPIC_LINK']) ? $recent_item['TOPIC_LINK'] : ''; ?>"><?php echo isset($recent_item['TOPIC_TITLE']) ? $recent_item['TOPIC_TITLE'] : ''; ?></a><br /><?php echo isset($recent_item['TOPIC_POSTER']) ? $recent_item['TOPIC_POSTER'] : ''; ?></div>
			<div class="col-2 d-none d-lg-block"><a<?php echo isset($recent_item['FORUM_COLOR']) ? $recent_item['FORUM_COLOR'] : ''; ?> href="<?php echo isset($recent_item['FORUM_LINK']) ? $recent_item['FORUM_LINK'] : ''; ?>"><?php echo isset($recent_item['FORUM_TITLE']) ? $recent_item['FORUM_TITLE'] : ''; ?></a></div>
			<div class="col-1 d-none d-lg-block text-center"><?php echo isset($recent_item['TOPIC_REPLIES']) ? $recent_item['TOPIC_REPLIES'] : ''; ?></div>
			<div class="col-3 d-none d-lg-block phpbb-forum-row-freshness"><?php echo isset($recent_item['LAST_POST_IMG']) ? $recent_item['LAST_POST_IMG'] : ''; ?> <?php echo isset($recent_item['LAST_POST_TIME']) ? $recent_item['LAST_POST_TIME'] : ''; ?><br /><?php echo isset($recent_item['LAST_POSTER']) ? $recent_item['LAST_POSTER'] : ''; ?></div>

		</div>
		<?php

} // END recent

if(isset($recent_item)) { unset($recent_item); } 

?>

	</div>

</section>