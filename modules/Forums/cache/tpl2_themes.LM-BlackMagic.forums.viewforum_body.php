<?php

// eXtreme Styles mod cache. Generated on Fri, 19 Aug 2022 23:15:47 +0000 (time=1660950947)

?><section class="viewforum__body_wrapper">

	<nav aria-label="breadcrumb" class="d-none d-xl-block px-0">
		<ol class="breadcrumb ">
			<li class="breadcrumb-item"><a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>"><i class="fas fa-home"></i></a></li>
			<?php if ($this->vars['PARENT_FORUM']) {  ?><li class="breadcrumb-item"><a href="<?php echo isset($this->vars['U_VIEW_PARENT_FORUM']) ? $this->vars['U_VIEW_PARENT_FORUM'] : $this->lang('U_VIEW_PARENT_FORUM'); ?>"><?php echo isset($this->vars['PARENT_FORUM_NAME']) ? $this->vars['PARENT_FORUM_NAME'] : $this->lang('PARENT_FORUM_NAME'); ?></a></li><?php } ?>
			<li class="breadcrumb-item" aria-current="page"><a href="<?php echo isset($this->vars['U_VIEW_FORUM']) ? $this->vars['U_VIEW_FORUM'] : $this->lang('U_VIEW_FORUM'); ?>"><?php echo isset($this->vars['FORUM_NAME']) ? $this->vars['FORUM_NAME'] : $this->lang('FORUM_NAME'); ?></a></li>
		</ol>
	</nav>

	<div class="viewtopic__buttons col-12 col-lg-2 px-0">
			<a class="btn btn-dark col-md-auto" href="<?php echo isset($this->vars['U_POST_NEW_TOPIC']) ? $this->vars['U_POST_NEW_TOPIC'] : $this->lang('U_POST_NEW_TOPIC'); ?>"><?php echo isset($this->vars['L_POST_NEW_TOPIC']) ? $this->vars['L_POST_NEW_TOPIC'] : $this->lang('L_POST_NEW_TOPIC'); ?></a>
		</div>

	<div class="container-fluid">
		
		<!-- <div class="clearfix"></div> -->

		<?php if ($this->vars['HAS_SUBFORUMS']) {  ?>
		<div class="phpbb-sub-forums-wrap">
			<?php

$catrow_count = ( isset($this->_tpldata['catrow.']) ) ?  sizeof($this->_tpldata['catrow.']) : 0;
for ($catrow_i = 0; $catrow_i < $catrow_count; $catrow_i++)
{
 $catrow_item = &$this->_tpldata['catrow.'][$catrow_i];
 $catrow_item['S_ROW_COUNT'] = $catrow_i;
 $catrow_item['S_NUM_ROWS'] = $catrow_count;

?>
			<div class="row phpbb-forums">
				<div class="col-12 col-lg-6 phpbb-forum-info"><?php echo isset($catrow_item['CAT_DESC']) ? $catrow_item['CAT_DESC'] : ''; ?></div>
				<div class="col-1 phpbb-forum-topic-count d-none d-lg-block"><?php echo isset($this->vars['L_TOPICS']) ? $this->vars['L_TOPICS'] : $this->lang('L_TOPICS'); ?></div>
				<div class="col-1 phpbb-topic-reply-count d-none d-lg-block"><?php echo isset($this->vars['L_POSTS']) ? $this->vars['L_POSTS'] : $this->lang('L_POSTS'); ?></div>
				<div class="col-4 phpbb-forum-freshness d-none d-lg-block"><?php echo isset($this->vars['L_LASTPOST']) ? $this->vars['L_LASTPOST'] : $this->lang('L_LASTPOST'); ?></div>
			</div>
			<?php

$forumrow_count = ( isset($catrow_item['forumrow.']) ) ? sizeof($catrow_item['forumrow.']) : 0;
for ($forumrow_i = 0; $forumrow_i < $forumrow_count; $forumrow_i++)
{
 $forumrow_item = &$catrow_item['forumrow.'][$forumrow_i];
 $forumrow_item['S_ROW_COUNT'] = $forumrow_i;
 $forumrow_item['S_NUM_ROWS'] = $forumrow_count;

?>
			<div class="row phpbb-forum">

				<?php if ($forumrow_item['FORUM_IS_LINK'] == 0) {  ?>
				<div class="col-1 phpbb-forum-row d-none d-lg-block text-center">
					<?php if ($forumrow_item['FORUM_HAS_NEW_POSTS'] == true) {  ?>
					<div class="phpbb__list_icon_unread">
					<?php } else { ?>
					<div class="phpbb__list_icon">
					<?php } ?>
						<i class="far fa-comment fa-2x"></i>
					</div>
				</div>
				<?php } ?>

				<div class="col-12 col-lg-5">
					<a href="<?php echo isset($forumrow_item['U_VIEWFORUM']) ? $forumrow_item['U_VIEWFORUM'] : ''; ?>"><?php echo isset($forumrow_item['FORUM_NAME']) ? $forumrow_item['FORUM_NAME'] : ''; ?></a><br /><?php echo isset($forumrow_item['FORUM_DESC']) ? $forumrow_item['FORUM_DESC'] : ''; ?>
				</div>

				<div class="col-1 phpbb-forum-row d-none d-lg-block text-center"><?php echo isset($forumrow_item['TOPICS']) ? $forumrow_item['TOPICS'] : ''; ?></div>

				<div class="col-1 phpbb-forum-row d-none d-lg-block text-center"><?php echo isset($forumrow_item['POSTS']) ? $forumrow_item['POSTS'] : ''; ?></div>

				<div class="col-1 phpbb-forum-row d-none <?php if ($forumrow_item['LAST_POST_COUNT'] != 0) {  ?>d-lg-block<?php } ?> text-center">
					<img src="<?php echo isset($forumrow_item['LAST_POST_AVATAR']) ? $forumrow_item['LAST_POST_AVATAR'] : ''; ?>" style="max-width: 48px; max-height: 48px" border="0">
				</div>

				<!-- <?php echo isset($forumrow_item['LAST_POST']) ? $forumrow_item['LAST_POST'] : ''; ?> -->
				<div class="col-<?php if ($forumrow_item['LAST_POST_COUNT']) {  ?>3<?php } else { ?>4<?php } ?> <?php if ($forumrow_item['LAST_POST_COUNT'] == 0) {  ?> phpbb-forum-row<?php } ?> phpbb-forum-row-freshness d-none d-lg-block"><?php echo isset($forumrow_item['LAST_POST_IMG']) ? $forumrow_item['LAST_POST_IMG'] : ''; ?> <?php echo isset($forumrow_item['LAST_POST_TIME']) ? $forumrow_item['LAST_POST_TIME'] : ''; ?><br /><?php echo isset($forumrow_item['LAST_POST_USERNAME']) ? $forumrow_item['LAST_POST_USERNAME'] : ''; ?></div>
			</div>
			<?php

} // END forumrow

if(isset($forumrow_item)) { unset($forumrow_item); } 

?>
			<?php

} // END catrow

if(isset($catrow_item)) { unset($catrow_item); } 

?>
		</div>
		<?php } ?>

		<?php if ($this->vars['NUM_TOPICS'] != 0) {  ?>

			<?php if ($this->vars['NUM_TOPICS'] || ! $this->vars['HAS_SUBFORUMS']) {  ?>
			<div class="phpbb-sub-forums-wrap<?php if ($this->vars['HAS_SUBFORUMS']) {  ?> mt-3<?php } ?>">

				<div class="row phpbb-forums"> 
					<div class="col-12 col-lg-6 phpbb-forum-info"><?php echo isset($this->vars['L_TOPICS']) ? $this->vars['L_TOPICS'] : $this->lang('L_TOPICS'); ?></div>
					<div class="col-1 phpbb-forum-topic-count d-none d-lg-block"><?php echo isset($this->vars['L_REPLIES']) ? $this->vars['L_REPLIES'] : $this->lang('L_REPLIES'); ?></div>
					<div class="col-1 phpbb-topic-reply-count d-none d-lg-block"><?php echo isset($this->vars['L_VIEWS']) ? $this->vars['L_VIEWS'] : $this->lang('L_VIEWS'); ?></div>
					<div class="col-4 phpbb-forum-freshness d-none d-lg-block"><?php echo isset($this->vars['L_LASTPOST']) ? $this->vars['L_LASTPOST'] : $this->lang('L_LASTPOST'); ?></div>
				</div>

				<?php

$topicrow_count = ( isset($this->_tpldata['topicrow.']) ) ?  sizeof($this->_tpldata['topicrow.']) : 0;
for ($topicrow_i = 0; $topicrow_i < $topicrow_count; $topicrow_i++)
{
 $topicrow_item = &$this->_tpldata['topicrow.'][$topicrow_i];
 $topicrow_item['S_ROW_COUNT'] = $topicrow_i;
 $topicrow_item['S_NUM_ROWS'] = $topicrow_count;

?>
				<?php

$divider_count = ( isset($topicrow_item['divider.']) ) ? sizeof($topicrow_item['divider.']) : 0;
for ($divider_i = 0; $divider_i < $divider_count; $divider_i++)
{
 $divider_item = &$topicrow_item['divider.'][$divider_i];
 $divider_item['S_ROW_COUNT'] = $divider_i;
 $divider_item['S_NUM_ROWS'] = $divider_count;

?>
				<div class="row viewforum__body_divider p-3"><?php echo isset($divider_item['L_DIV_HEADERS']) ? $divider_item['L_DIV_HEADERS'] : ''; ?></div>
				<?php

} // END divider

if(isset($divider_item)) { unset($divider_item); } 

?>
				<div class="row phpbb-topics">

					<div class="col-1 d-none d-lg-block text-center" style="padding: 6px;">
						<?php if ($topicrow_item['FORUM_HAS_NEW_POSTS'] == true) {  ?>
						<div class="phpbb__viewforum_icon_unread">
						<?php } else { ?>
						<div class="phpbb__viewforum_icon">
						<?php } ?>
							<i class="far fa-comment"></i>
						</div>
					</div>

					<div class="col-12 col-lg-5 text-truncate" style="padding: 12px;">
						<?php if ($topicrow_item['FORUM_HAS_NEW_POSTS'] == true) {  ?><span class="d--inline-block d-lg-none badge phpbb-sub-is-new mr-1">New</span><?php } ?><a href="<?php echo isset($topicrow_item['U_VIEW_TOPIC']) ? $topicrow_item['U_VIEW_TOPIC'] : ''; ?>"><?php echo isset($topicrow_item['TOPIC_TITLE']) ? $topicrow_item['TOPIC_TITLE'] : ''; ?></a>

						<div class="col-3 px-0 float-left float-lg-right">
							<small><?php echo isset($topicrow_item['GOTO_PAGE']) ? $topicrow_item['GOTO_PAGE'] : ''; ?></small>
						</div>

						<div class="col-12 px-0 text-truncate d-block d-lg-none">
							<small>Last post <?php echo isset($topicrow_item['LAST_POST_AUTHOR']) ? $topicrow_item['LAST_POST_AUTHOR'] : ''; ?></small>
						</div>

					</div>

					<div class="col-1 d-none d-lg-block text-center" style="padding: 12px;"><?php echo isset($topicrow_item['REPLIES']) ? $topicrow_item['REPLIES'] : ''; ?></div>
					<div class="col-1 d-none d-lg-block text-center" style="padding: 12px;"><?php echo isset($topicrow_item['VIEWS']) ? $topicrow_item['VIEWS'] : ''; ?></div>

					<div class="col-4 d-none d-lg-block phpbb-forum-row-freshness"><?php echo isset($topicrow_item['LAST_POST_IMG']) ? $topicrow_item['LAST_POST_IMG'] : ''; ?> <?php echo isset($topicrow_item['LAST_POST_TIME']) ? $topicrow_item['LAST_POST_TIME'] : ''; ?><br /><?php echo isset($topicrow_item['LAST_POST_AUTHOR']) ? $topicrow_item['LAST_POST_AUTHOR'] : ''; ?></div>

				</div>
				<?php

} // END topicrow

if(isset($topicrow_item)) { unset($topicrow_item); } 

?>

				<div class="row px-0 mt-3 justify-content-center float-lg-right">
					<?php echo isset($this->vars['PAGINATION']) ? $this->vars['PAGINATION'] : $this->lang('PAGINATION'); ?>
				</div>
				<div class="clearfix"></div>

				<?php if ($this->vars['S_USER_HAS_MOD_RIGHTS'] == true) {  ?>
				<div class="divider"></div>
				<div class="col-12 px-0 text-right">
					<a class="col-md-auto btn btn-outline-warning" href="<?php echo isset($this->vars['S_MODCP_URI']) ? $this->vars['S_MODCP_URI'] : $this->lang('S_MODCP_URI'); ?>">Moderate this forum</a>
					<div class="clearfix"></div>
				</div>
				<?php } ?>

			</div>

			<?php } ?>

			<?php } else { ?>
			<div class="alert alert-primary text-center mt-3" style="margin-left: -15px; margin-right: -15px;" role="alert"><?php echo isset($this->vars['L_NO_TOPICS']) ? $this->vars['L_NO_TOPICS'] : $this->lang('L_NO_TOPICS'); ?></div>
			<?php } ?>




	</div>
</section> 