<?php

// eXtreme Styles mod cache. Generated on Fri, 19 Aug 2022 23:07:23 +0000 (time=1660950443)

?><!--MOD GLANCE BEGIN --><!-- <?php echo isset($this->vars['GLANCE_OUTPUT']) ? $this->vars['GLANCE_OUTPUT'] : $this->lang('GLANCE_OUTPUT'); ?> --><!-- MOD GLANCE END -->
<section class="index__body_wrapper">

	<nav aria-label="breadcrumb" class="breadcrumb-nav d-none d-xl-block px-0">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>"><i class="fas fa-home"></i></a></li>
			<li class="breadcrumb-item active"><?php echo isset($this->vars['L_FORUM']) ? $this->vars['L_FORUM'] : $this->lang('L_FORUM'); ?></li>
		</ol>
		<a class="unread-topics btn btn-dark" style="display: margin-right: 3px" href="<?php echo isset($this->vars['U_SEARCH_NEW']) ? $this->vars['U_SEARCH_NEW'] : $this->lang('U_SEARCH_NEW'); ?>">Unread Content</a>
	</nav>

	<div class="container-fluid">

		<!-- additional buttons -->
		<!-- <div class="row">
			<a class="btn btn-dark" style="margin-right: 3px" href="">View posts since last visit</a>
			<a class="btn btn-dark" style="margin-right: 3px" href="">View your posts</a>
			<a class="btn btn-dark" style="margin-right: 3px" href="">View unanswered posts</a>
			<a class="btn btn-dark" style="margin-right: 3px" href="">Recent Topics</a>
		</div> -->

		<div class="row phpbb-forums">
			<div class="col-12 col-lg-6 phpbb-forum-info"><?php echo isset($this->vars['L_FORUM']) ? $this->vars['L_FORUM'] : $this->lang('L_FORUM'); ?></div>
			<div class="col-1 phpbb-forum-topic-count d-none d-lg-block"><?php echo isset($this->vars['L_TOPICS']) ? $this->vars['L_TOPICS'] : $this->lang('L_TOPICS'); ?></div>
			<div class="col-1 phpbb-topic-reply-count d-none d-lg-block"><?php echo isset($this->vars['L_POSTS']) ? $this->vars['L_POSTS'] : $this->lang('L_POSTS'); ?></div>
			<div class="col-4 phpbb-forum-freshness d-none d-lg-block"><?php echo isset($this->vars['L_FRESHNESS']) ? $this->vars['L_FRESHNESS'] : $this->lang('L_FRESHNESS'); ?></div>
		</div>
		<?php

$catrow_count = ( isset($this->_tpldata['catrow.']) ) ?  sizeof($this->_tpldata['catrow.']) : 0;
for ($catrow_i = 0; $catrow_i < $catrow_count; $catrow_i++)
{
 $catrow_item = &$this->_tpldata['catrow.'][$catrow_i];
 $catrow_item['S_ROW_COUNT'] = $catrow_i;
 $catrow_item['S_NUM_ROWS'] = $catrow_count;

?>
		<div class="row phpbb-cat-head"><?php echo isset($catrow_item['CAT_DESC']) ? $catrow_item['CAT_DESC'] : ''; ?></div>
		<?php

$forumrow_count = ( isset($catrow_item['forumrow.']) ) ? sizeof($catrow_item['forumrow.']) : 0;
for ($forumrow_i = 0; $forumrow_i < $forumrow_count; $forumrow_i++)
{
 $forumrow_item = &$catrow_item['forumrow.'][$forumrow_i];
 $forumrow_item['S_ROW_COUNT'] = $forumrow_i;
 $forumrow_item['S_NUM_ROWS'] = $forumrow_count;

?>
		<?php if (! $forumrow_item['PARENT']) {  ?>
		<div class="row phpbb-forum">

			<?php if ($forumrow_item['FORUM_IS_LINK'] == 0) {  ?>
			<div class="col-1 d-none d-lg-block text-center">
				<?php if ($forumrow_item['TOTAL_UNREAD'] != 0) {  ?>
				<div class="phpbb__list_icon_unread">
				<?php } else { ?>
				<div class="phpbb__list_icon">
				<?php } ?>
					<i class="far fa-comment fa-2x"></i>
				</div>
			</div>
			<?php } ?>

			<?php

$switch_forum_link_off_count = ( isset($forumrow_item['switch_forum_link_off.']) ) ? sizeof($forumrow_item['switch_forum_link_off.']) : 0;
for ($switch_forum_link_off_i = 0; $switch_forum_link_off_i < $switch_forum_link_off_count; $switch_forum_link_off_i++)
{
 $switch_forum_link_off_item = &$forumrow_item['switch_forum_link_off.'][$switch_forum_link_off_i];
 $switch_forum_link_off_item['S_ROW_COUNT'] = $switch_forum_link_off_i;
 $switch_forum_link_off_item['S_NUM_ROWS'] = $switch_forum_link_off_count;

?>
			<?php if ($forumrow_item['FORUM_ICON_IMG']) {  ?>
			<div class="col-1 d-none d-lg-block text-center"><?php echo isset($forumrow_item['FORUM_ICON_IMG']) ? $forumrow_item['FORUM_ICON_IMG'] : ''; ?></div>
			<?php } ?>
			<?php

} // END switch_forum_link_off

if(isset($switch_forum_link_off_item)) { unset($switch_forum_link_off_item); } 

?>
			<?php

$switch_forum_link_on_count = ( isset($forumrow_item['switch_forum_link_on.']) ) ? sizeof($forumrow_item['switch_forum_link_on.']) : 0;
for ($switch_forum_link_on_i = 0; $switch_forum_link_on_i < $switch_forum_link_on_count; $switch_forum_link_on_i++)
{
 $switch_forum_link_on_item = &$forumrow_item['switch_forum_link_on.'][$switch_forum_link_on_i];
 $switch_forum_link_on_item['S_ROW_COUNT'] = $switch_forum_link_on_i;
 $switch_forum_link_on_item['S_NUM_ROWS'] = $switch_forum_link_on_count;

?>
			<div class="col-1 d-none d-lg-block text-center"><i class="fas fa-link fa-3x"></i></div>
			<?php

} // END switch_forum_link_on

if(isset($switch_forum_link_on_item)) { unset($switch_forum_link_on_item); } 

?>

			<div class="col-12 col-lg-<?php if ($forumrow_item['FORUM_ICON_IMG']) {  ?>4<?php } else { ?>5<?php } ?>">

				<?php if ($forumrow_item['FORUM_HAS_NEW_POSTS'] == true) {  ?><span class="d--inline-block d-lg-none badge phpbb-sub-is-new mr-1">New</span><?php } ?><a<?php echo isset($forumrow_item['FORUM_COLOR']) ? $forumrow_item['FORUM_COLOR'] : ''; ?> href="<?php echo isset($forumrow_item['U_VIEWFORUM']) ? $forumrow_item['U_VIEWFORUM'] : ''; ?>"<?php if ($forumrow_item['FORUM_LINK_COUNT']) {  ?> target="_blank"<?php } ?>><?php echo isset($forumrow_item['FORUM_NAME']) ? $forumrow_item['FORUM_NAME'] : ''; ?></a>
				<div class="col-12 px-0">
					<small class="text-muted"><?php echo isset($forumrow_item['FORUM_DESC']) ? $forumrow_item['FORUM_DESC'] : ''; ?></small>
					<ul class="p-0 phpbb-sub-forum-list">
					<?php

$sub_count = ( isset($forumrow_item['sub.']) ) ? sizeof($forumrow_item['sub.']) : 0;
for ($sub_i = 0; $sub_i < $sub_count; $sub_i++)
{
 $sub_item = &$forumrow_item['sub.'][$sub_i];
 $sub_item['S_ROW_COUNT'] = $sub_i;
 $sub_item['S_NUM_ROWS'] = $sub_count;

?>
					<?php $this->_tpldata['DEFINE']['.']['HAS_SUB'] = 1; ?>	  				
	  					<li class="d-inline-block text-truncate phpbb-sub-forum">	  						
	  						<a href="<?php echo isset($sub_item['U_VIEWFORUM']) ? $sub_item['U_VIEWFORUM'] : ''; ?>" <?php echo isset($sub_item['FORUM_COLOR']) ? $sub_item['FORUM_COLOR'] : ''; ?> title="<?php echo isset($sub_item['FORUM_DESC_HTML']) ? $sub_item['FORUM_DESC_HTML'] : ''; ?>"><?php if ($sub_item['UNREAD']) {  ?><span class="d-inline-block badge phpbb-sub-is-new mr-1">New</span><?php } ?><?php echo isset($sub_item['FORUM_NAME']) ? $sub_item['FORUM_NAME'] : ''; ?></a>
	  					</li>
	  				<?php unset($this->_tpldata['DEFINE']['.']['HAS_SUB']); ?>
					<?php

} // END sub

if(isset($sub_item)) { unset($sub_item); } 

?>
					</ul>

				</div>

				<?php if ($forumrow_item['LAST_POST_TOPIC']) {  ?>
				<div class="col-12 px-0 text-truncate d-block d-lg-none">
					<small>Last post <a href=""><?php echo isset($forumrow_item['LAST_POST_USERNAME']) ? $forumrow_item['LAST_POST_USERNAME'] : ''; ?></a> in <a href="<?php echo isset($forumrow_item['LAST_TOPIC_URL']) ? $forumrow_item['LAST_TOPIC_URL'] : ''; ?>"><?php echo isset($forumrow_item['LAST_POST_TOPIC']) ? $forumrow_item['LAST_POST_TOPIC'] : ''; ?></a></small>
				</div>
				<?php } ?>

			</div>
			<?php

$switch_forum_link_off_count = ( isset($forumrow_item['switch_forum_link_off.']) ) ? sizeof($forumrow_item['switch_forum_link_off.']) : 0;
for ($switch_forum_link_off_i = 0; $switch_forum_link_off_i < $switch_forum_link_off_count; $switch_forum_link_off_i++)
{
 $switch_forum_link_off_item = &$forumrow_item['switch_forum_link_off.'][$switch_forum_link_off_i];
 $switch_forum_link_off_item['S_ROW_COUNT'] = $switch_forum_link_off_i;
 $switch_forum_link_off_item['S_NUM_ROWS'] = $switch_forum_link_off_count;

?>
			<div class="col-1 d-none d-lg-block text-center"><?php echo isset($forumrow_item['TOTAL_TOPICS']) ? $forumrow_item['TOTAL_TOPICS'] : ''; ?></div>
			<div class="col-1 d-none d-lg-block text-center"><?php echo isset($forumrow_item['TOTAL_POSTS']) ? $forumrow_item['TOTAL_POSTS'] : ''; ?></div>
			<div class="col-1 d-none <?php if ($forumrow_item['TOTAL_POSTS'] != 0) {  ?>d-lg-block<?php } ?> text-center"><img src="<?php echo isset($forumrow_item['LAST_POST_AVATAR']) ? $forumrow_item['LAST_POST_AVATAR'] : ''; ?>" style="max-width: 48px; max-height: 48px" border="0"></div>
			<div class="col-3<?php if ($forumrow_item['TOTAL_POSTS'] == 0) {  ?> phpbb-forum-row<?php } ?> phpbb-forum-row-freshness d-none d-lg-block"><?php echo isset($forumrow_item['LAST_POST']) ? $forumrow_item['LAST_POST'] : ''; ?><?php echo isset($forumrow_item['LAST_POSTTIME']) ? $forumrow_item['LAST_POSTTIME'] : ''; ?><br /><?php echo isset($forumrow_item['LAST_POST_USERNAME']) ? $forumrow_item['LAST_POST_USERNAME'] : ''; ?></div>
			<?php

} // END switch_forum_link_off

if(isset($switch_forum_link_off_item)) { unset($switch_forum_link_off_item); } 

?>
			<?php

$switch_forum_link_on_count = ( isset($forumrow_item['switch_forum_link_on.']) ) ? sizeof($forumrow_item['switch_forum_link_on.']) : 0;
for ($switch_forum_link_on_i = 0; $switch_forum_link_on_i < $switch_forum_link_on_count; $switch_forum_link_on_i++)
{
 $switch_forum_link_on_item = &$forumrow_item['switch_forum_link_on.'][$switch_forum_link_on_i];
 $switch_forum_link_on_item['S_ROW_COUNT'] = $switch_forum_link_on_i;
 $switch_forum_link_on_item['S_NUM_ROWS'] = $switch_forum_link_on_count;

?>
			<div class="col-12 col-lg-6 phpbb-forum-row text-left text-lg-right"><?php echo isset($forumrow_item['FORUM_LINK_COUNT']) ? $forumrow_item['FORUM_LINK_COUNT'] : ''; ?></div>
			<?php

} // END switch_forum_link_on

if(isset($switch_forum_link_on_item)) { unset($switch_forum_link_on_item); } 

?>
		</div>
		<?php } ?>
		<?php

} // END forumrow

if(isset($forumrow_item)) { unset($forumrow_item); } 

?>
		<?php

} // END catrow

if(isset($catrow_item)) { unset($catrow_item); } 

?>
		
		<!-- <div class="divider"></div> -->

	</div>
</section>