<?php

// eXtreme Styles mod cache. Generated on Fri, 19 Aug 2022 23:10:20 +0000 (time=1660950620)

?><section class="viewtopic__body_wrapper">

	<nav aria-label="breadcrumb" class="d-none d-xl-block px-0">
		<ol class="breadcrumb ">
			<li class="breadcrumb-item"><a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>"><i class="fas fa-home"></i></a></li>
			<?php if ($this->vars['PARENT_FORUM']) {  ?><li class="breadcrumb-item"><a href="<?php echo isset($this->vars['U_VIEW_PARENT_FORUM']) ? $this->vars['U_VIEW_PARENT_FORUM'] : $this->lang('U_VIEW_PARENT_FORUM'); ?>"><?php echo isset($this->vars['PARENT_FORUM_NAME']) ? $this->vars['PARENT_FORUM_NAME'] : $this->lang('PARENT_FORUM_NAME'); ?></a></li><?php } ?>
			<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo isset($this->vars['U_VIEW_FORUM']) ? $this->vars['U_VIEW_FORUM'] : $this->lang('U_VIEW_FORUM'); ?>"><?php echo isset($this->vars['FORUM_NAME']) ? $this->vars['FORUM_NAME'] : $this->lang('FORUM_NAME'); ?></a></li>
			<?php if ($this->vars['TOPIC_TITLE']) {  ?><li class="breadcrumb-item active" aria-current="page"><?php echo isset($this->vars['TOPIC_TITLE']) ? $this->vars['TOPIC_TITLE'] : $this->lang('TOPIC_TITLE'); ?></li><?php } ?>
		</ol>
	</nav>

	<div class="container-fluid">

		<?php if ($this->vars['PAGINATION']) {  ?>
		<div class="row px-0 mb-2 justify-content-center float-lg-right">
			<?php echo isset($this->vars['PAGINATION']) ? $this->vars['PAGINATION'] : $this->lang('PAGINATION'); ?>
		</div>
		<?php } ?>
		<div class="clearfix"></div>

		<div class="row mb-3 p-3 viewtopic__title">
			<div class="col-12 px-0 viewtopic__title_forum">
				<h3><?php echo isset($this->vars['TOPIC_TITLE']) ? $this->vars['TOPIC_TITLE'] : $this->lang('TOPIC_TITLE'); ?></h3>
				<p class="m-0"><?php echo isset($this->vars['L_BY']) ? $this->vars['L_BY'] : $this->lang('L_BY'); ?> <a href=""><?php echo isset($this->vars['TOPIC_AUTHOR']) ? $this->vars['TOPIC_AUTHOR'] : $this->lang('TOPIC_AUTHOR'); ?></a></p>
			</div>
		</div>

		<div class="row viewtopic__buttons justify-content-center float-md-left">

			<!-- TOPIC BUTTON (NEW POST) -->
			<a class="btn btn-dark mr-1 d-none d-md-block" href="<?php echo isset($this->vars['U_POST_NEW_TOPIC']) ? $this->vars['U_POST_NEW_TOPIC'] : $this->lang('U_POST_NEW_TOPIC'); ?>"><?php echo isset($this->vars['L_POST_NEW_TOPIC']) ? $this->vars['L_POST_NEW_TOPIC'] : $this->lang('L_POST_NEW_TOPIC'); ?></a>
			<a class="btn btn-dark mr-1 d-md-none d-sm-block" href="<?php echo isset($this->vars['U_POST_NEW_TOPIC']) ? $this->vars['U_POST_NEW_TOPIC'] : $this->lang('U_POST_NEW_TOPIC'); ?>" title="<?php echo isset($this->vars['L_POST_NEW_TOPIC']) ? $this->vars['L_POST_NEW_TOPIC'] : $this->lang('L_POST_NEW_TOPIC'); ?>"><i class="fas fa-comment"></i></a>

			<!-- TOPIC BUTTON (REPLY POST) -->
			<a class="btn btn-dark mr-1 d-none d-md-block" href="<?php echo isset($this->vars['U_POST_REPLY_TOPIC']) ? $this->vars['U_POST_REPLY_TOPIC'] : $this->lang('U_POST_REPLY_TOPIC'); ?>"><?php echo isset($this->vars['L_POST_REPLY_TOPIC']) ? $this->vars['L_POST_REPLY_TOPIC'] : $this->lang('L_POST_REPLY_TOPIC'); ?></a>
			<a class="btn btn-dark mr-1 d-md-none d-sm-block" href="<?php echo isset($this->vars['U_POST_REPLY_TOPIC']) ? $this->vars['U_POST_REPLY_TOPIC'] : $this->lang('U_POST_REPLY_TOPIC'); ?>"><i class="fas fa-reply fa__topic_icons"></i></a>

			<!-- TOPIC BUTTON (PRINT POST) -->
			<a class="btn btn-dark mr-1" target="_blank" href="<?php echo isset($this->vars['U_PRINTER_TOPIC']) ? $this->vars['U_PRINTER_TOPIC'] : $this->lang('U_PRINTER_TOPIC'); ?>" title="<?php echo isset($this->vars['L_PRINTER_TOPIC']) ? $this->vars['L_PRINTER_TOPIC'] : $this->lang('L_PRINTER_TOPIC'); ?>"><i class="fas fa-print fa__topic_icons"></i></a>

			<!-- TOPIC BUTTON (WHO HAS VIEWED THE POST) -->
			<a class="btn btn-dark mr-1" href="<?php echo isset($this->vars['U_WHOVIEW_TOPIC']) ? $this->vars['U_WHOVIEW_TOPIC'] : $this->lang('U_WHOVIEW_TOPIC'); ?>" title="<?php echo isset($this->vars['L_WHOVIEW_ALT']) ? $this->vars['L_WHOVIEW_ALT'] : $this->lang('L_WHOVIEW_ALT'); ?>"><i class="fas fa-eye fa__topic_icons"></i></a>

			<?php

$thanks_button_count = ( isset($this->_tpldata['thanks_button.']) ) ?  sizeof($this->_tpldata['thanks_button.']) : 0;
for ($thanks_button_i = 0; $thanks_button_i < $thanks_button_count; $thanks_button_i++)
{
 $thanks_button_item = &$this->_tpldata['thanks_button.'][$thanks_button_i];
 $thanks_button_item['S_ROW_COUNT'] = $thanks_button_i;
 $thanks_button_item['S_NUM_ROWS'] = $thanks_button_count;

?>
    		<a class="btn btn-dark" href="<?php echo isset($thanks_button_item['U_THANK_TOPIC']) ? $thanks_button_item['U_THANK_TOPIC'] : ''; ?>"><i class="fas fa-thumbs-up fa__topic_icons" title="<?php echo isset($thanks_button_item['L_THANK_TOPIC']) ? $thanks_button_item['L_THANK_TOPIC'] : ''; ?>"></i></a>
    		<?php

} // END thanks_button

if(isset($thanks_button_item)) { unset($thanks_button_item); } 

?>

		</div>
		<div class="clearfix"></div>

		<!-- POLL DISPLAY START -->
		<?php echo isset($this->vars['POLL_DISPLAY']) ? $this->vars['POLL_DISPLAY'] : $this->lang('POLL_DISPLAY'); ?>
		<!-- POLL DISPLAY END -->

		<?php

$postrow_count = ( isset($this->_tpldata['postrow.']) ) ?  sizeof($this->_tpldata['postrow.']) : 0;
for ($postrow_i = 0; $postrow_i < $postrow_count; $postrow_i++)
{
 $postrow_item = &$this->_tpldata['postrow.'][$postrow_i];
 $postrow_item['S_ROW_COUNT'] = $postrow_i;
 $postrow_item['S_NUM_ROWS'] = $postrow_count;

?>

		<div id="<?php echo isset($postrow_item['POST_ID']) ? $postrow_item['POST_ID'] : ''; ?>"></div>

		<div class="viewtopic__postrow_wrap">

			<div class="row viewtopic__author_post_info">
				<div class="col-12 col-md-3 col-xl-2 viewtopic__author_name_wrap">
					<a href="<?php echo isset($postrow_item['PROFILE_URL']) ? $postrow_item['PROFILE_URL'] : ''; ?>"><?php echo isset($postrow_item['POSTER_NAME']) ? $postrow_item['POSTER_NAME'] : ''; ?></a>
				</div>
				<div class="col-12 col-md-9 col-xl-10 viewtopic__author_posted_on">
					<div class="viewtopic__posted_date" style="float: left"><?php echo isset($this->vars['L_POSTED']) ? $this->vars['L_POSTED'] : $this->lang('L_POSTED'); ?>:&nbsp;<?php echo isset($postrow_item['POST_DATE']) ? $postrow_item['POST_DATE'] : ''; ?></div>
					<div class="viewtopic__options" style="float: right">
						<a class="btn btn-dark" href="<?php echo isset($postrow_item['QUOTE_URL']) ? $postrow_item['QUOTE_URL'] : ''; ?>" title="<?php echo isset($postrow_item['QUOTE_ALT']) ? $postrow_item['QUOTE_ALT'] : ''; ?>"><i class="fas fa-quote-right"></i></a>
						<?php if ($postrow_item['EDIT_URL']) {  ?>
						<a class="btn btn-dark" href="<?php echo isset($postrow_item['EDIT_URL']) ? $postrow_item['EDIT_URL'] : ''; ?>" title="<?php echo isset($postrow_item['EDIT_ALT']) ? $postrow_item['EDIT_ALT'] : ''; ?>"><i class="fas fa-pen-square"></i></a>
						<?php } ?>
						<?php if ($postrow_item['DELETE_URL']) {  ?>
						<a class="btn btn-dark" href="<?php echo isset($postrow_item['DELETE_URL']) ? $postrow_item['DELETE_URL'] : ''; ?>" title="<?php echo isset($postrow_item['DELETE_ALT']) ? $postrow_item['DELETE_ALT'] : ''; ?>"><i class="fas fa-trash-alt"></i></a>
						<?php } ?>
						<?php if ($postrow_item['IP_URL']) {  ?>
						<a class="btn btn-dark" href="<?php echo isset($postrow_item['IP_URL']) ? $postrow_item['IP_URL'] : ''; ?>" title="<?php echo isset($postrow_item['IP_ALT']) ? $postrow_item['IP_ALT'] : ''; ?>"><i class="fas fa-map-pin"></i></a>
						<?php } ?>
						<?php if ($postrow_item['REPORT_URL']) {  ?>
						<a class="btn btn-dark" href="<?php echo isset($postrow_item['REPORT_URL']) ? $postrow_item['REPORT_URL'] : ''; ?>" title="<?php echo isset($postrow_item['REPORT_ALT']) ? $postrow_item['REPORT_ALT'] : ''; ?>"><i class="fas fa-flag"></i></a>
						<?php } ?>
						<span class="ml-1 mr-2"><a data-clipboard-btn data-toast-text="Copied to clipboard" href="javascript:;" data-clipboard-text="modules.php?name=Forums&file=viewtopic&p=<?php echo isset($postrow_item['POST_ID']) ? $postrow_item['POST_ID'] : ''; ?>#<?php echo isset($postrow_item['POST_ID']) ? $postrow_item['POST_ID'] : ''; ?>">#<?php echo isset($postrow_item['POST_ID']) ? $postrow_item['POST_ID'] : ''; ?></a></span>
					</div>
				</div>
			</div>

			<div class="row mb-4 viewtopic_body_pane clearfix">
				
				<!-- BEGIN responsive topic author pane -->
				<div class="col-12 viewtopic__author_pane_top">
					<div class="col-2 p-0 viewtopic__avatar_wrap align-middle">
						<?php

$switch_showavatars_count = ( isset($postrow_item['switch_showavatars.']) ) ? sizeof($postrow_item['switch_showavatars.']) : 0;
for ($switch_showavatars_i = 0; $switch_showavatars_i < $switch_showavatars_count; $switch_showavatars_i++)
{
 $switch_showavatars_item = &$postrow_item['switch_showavatars.'][$switch_showavatars_i];
 $switch_showavatars_item['S_ROW_COUNT'] = $switch_showavatars_i;
 $switch_showavatars_item['S_NUM_ROWS'] = $switch_showavatars_count;

?><a href="<?php echo isset($postrow_item['PROFILE_URL']) ? $postrow_item['PROFILE_URL'] : ''; ?>"><?php echo isset($postrow_item['POSTER_AVATAR']) ? $postrow_item['POSTER_AVATAR'] : ''; ?></a><?php

} // END switch_showavatars

if(isset($switch_showavatars_item)) { unset($switch_showavatars_item); } 

?>
					</div>
					<div class="col-10 p-0 viewtopic__author_pane_top_info">
						<div class="col-12 pr-0"><a href="<?php echo isset($postrow_item['PROFILE_URL']) ? $postrow_item['PROFILE_URL'] : ''; ?>"><?php echo isset($postrow_item['POSTER_NAME']) ? $postrow_item['POSTER_NAME'] : ''; ?></a></div>
						<div class="col-12 pr-0"><?php echo isset($postrow_item['POST_DATE']) ? $postrow_item['POST_DATE'] : ''; ?></div>
					</div>
				</div>

				<div class="col-12 p-2 d-block d-lg-none viewtopic__options_responsive">
					<a class="btn btn-dark" href="<?php echo isset($postrow_item['QUOTE_URL']) ? $postrow_item['QUOTE_URL'] : ''; ?>" title="<?php echo isset($postrow_item['QUOTE_ALT']) ? $postrow_item['QUOTE_ALT'] : ''; ?>"><i class="fas fa-quote-right"></i></a>
					<?php if ($postrow_item['EDIT_URL']) {  ?>
					<a class="btn btn-dark" href="<?php echo isset($postrow_item['EDIT_URL']) ? $postrow_item['EDIT_URL'] : ''; ?>" title="<?php echo isset($postrow_item['EDIT_ALT']) ? $postrow_item['EDIT_ALT'] : ''; ?>"><i class="fas fa-pen-square"></i></a>
					<?php } ?>
					<?php if ($postrow_item['DELETE_URL']) {  ?>
					<a class="btn btn-dark" href="<?php echo isset($postrow_item['DELETE_URL']) ? $postrow_item['DELETE_URL'] : ''; ?>" title="<?php echo isset($postrow_item['DELETE_ALT']) ? $postrow_item['DELETE_ALT'] : ''; ?>"><i class="fas fa-trash-alt"></i></a>
					<?php } ?>
					<?php if ($postrow_item['IP_URL']) {  ?>
					<a class="btn btn-dark" href="<?php echo isset($postrow_item['IP_URL']) ? $postrow_item['IP_URL'] : ''; ?>" title="<?php echo isset($postrow_item['IP_ALT']) ? $postrow_item['IP_ALT'] : ''; ?>"><i class="fas fa-map-pin"></i></a>
					<?php } ?>
					<?php if ($postrow_item['REPORT_URL']) {  ?>
					<a class="btn btn-dark" href="<?php echo isset($postrow_item['REPORT_URL']) ? $postrow_item['REPORT_URL'] : ''; ?>" title="<?php echo isset($postrow_item['REPORT_ALT']) ? $postrow_item['REPORT_ALT'] : ''; ?>"><i class="fas fa-flag"></i></a>
					<?php } ?>

				</div>
				<!-- END responsive topic author pane -->


				<div class="col-12 col-md-3 col-xl-2 viewtopic__author_pane">
					<!-- <div class="col-12"><?php echo isset($postrow_item['POSTER_NAME']) ? $postrow_item['POSTER_NAME'] : ''; ?></div> -->
					<?php

$switch_showavatars_count = ( isset($postrow_item['switch_showavatars.']) ) ? sizeof($postrow_item['switch_showavatars.']) : 0;
for ($switch_showavatars_i = 0; $switch_showavatars_i < $switch_showavatars_count; $switch_showavatars_i++)
{
 $switch_showavatars_item = &$postrow_item['switch_showavatars.'][$switch_showavatars_i];
 $switch_showavatars_item['S_ROW_COUNT'] = $switch_showavatars_i;
 $switch_showavatars_item['S_NUM_ROWS'] = $switch_showavatars_count;

?><div class="viewtopic__author_avatar"><a href="<?php echo isset($postrow_item['PROFILE_URL']) ? $postrow_item['PROFILE_URL'] : ''; ?>"><?php echo isset($postrow_item['POSTER_AVATAR']) ? $postrow_item['POSTER_AVATAR'] : ''; ?></a></div><?php

} // END switch_showavatars

if(isset($switch_showavatars_item)) { unset($switch_showavatars_item); } 

?>
					<div class="viewtopic__rank"><?php echo isset($postrow_item['USER_RANK_01']) ? $postrow_item['USER_RANK_01'] : ''; ?></div>
					<div class="viewtopic__rank"><?php echo isset($postrow_item['POSTER_POSTS']) ? $postrow_item['POSTER_POSTS'] : ''; ?> <?php echo isset($this->vars['L_POST_COUNT']) ? $this->vars['L_POST_COUNT'] : $this->lang('L_POST_COUNT'); ?></div>
					<div class="col-12 px-0 mt-4">
						<a class="btn btn-dark" href="<?php echo isset($postrow_item['PM_URL']) ? $postrow_item['PM_URL'] : ''; ?>" title="<?php echo isset($postrow_item['PM_ALT']) ? $postrow_item['PM_ALT'] : ''; ?>"><i class="fas fa-comments"></i></a>
						<a class="btn btn-dark" href="<?php echo isset($postrow_item['EMAIL_USER']) ? $postrow_item['EMAIL_USER'] : ''; ?>" title="<?php echo isset($postrow_item['EMAIL_ALT']) ? $postrow_item['EMAIL_ALT'] : ''; ?>"><i class="fas fa-envelope-square"></i></a>
						<a class="btn btn-dark" href="<?php echo isset($postrow_item['SEARCH_USER_POSTS']) ? $postrow_item['SEARCH_USER_POSTS'] : ''; ?>" title="<?php echo isset($postrow_item['SEARCH_ALT']) ? $postrow_item['SEARCH_ALT'] : ''; ?>"><i class="fas fa-search"></i></a>
					</div>
				</div>
				<div class="col-12 col-md-9 col-xl-10 viewtopic__body p-3">
					<div class="col-12 px-0"><?php echo isset($postrow_item['MESSAGE']) ? $postrow_item['MESSAGE'] : ''; ?></div>
					<div class="col-12 px-0"><?php echo isset($postrow_item['ATTACHMENTS']) ? $postrow_item['ATTACHMENTS'] : ''; ?></div>
					<div class="col-12 px-0 viewtopic__signature_row"><?php echo isset($postrow_item['SIGNATURE']) ? $postrow_item['SIGNATURE'] : ''; ?></div>
					<?php if ($postrow_item['EDITED_MESSAGE']) {  ?>
	            	<div class="alert alert-info mt-2" role="alert"><?php echo isset($postrow_item['EDITED_MESSAGE']) ? $postrow_item['EDITED_MESSAGE'] : ''; ?></div>
	            	<?php } ?>
				</div>

			</div>

			<div class="row px-0">
				<?php

$move_message_count = ( isset($postrow_item['move_message.']) ) ? sizeof($postrow_item['move_message.']) : 0;
for ($move_message_i = 0; $move_message_i < $move_message_count; $move_message_i++)
{
 $move_message_item = &$postrow_item['move_message.'][$move_message_i];
 $move_message_item['S_ROW_COUNT'] = $move_message_i;
 $move_message_item['S_NUM_ROWS'] = $move_message_count;

?>
				<div class="col-12 alert alert-info" role="alert">
					<?php echo isset($move_message_item['MOVE_MESSAGE']) ? $move_message_item['MOVE_MESSAGE'] : ''; ?>
				</div>
				<?php

} // END move_message

if(isset($move_message_item)) { unset($move_message_item); } 

?>
				<?php

$thanks_count = ( isset($postrow_item['thanks.']) ) ? sizeof($postrow_item['thanks.']) : 0;
for ($thanks_i = 0; $thanks_i < $thanks_count; $thanks_i++)
{
 $thanks_item = &$postrow_item['thanks.'][$thanks_i];
 $thanks_item['S_ROW_COUNT'] = $thanks_i;
 $thanks_item['S_NUM_ROWS'] = $thanks_count;

?>
				<div class="col-12 alert alert-info" role="alert">
					<i class="fas fa-thumbs-up"></i> <?php echo isset($thanks_item['THANKFUL']) ? $thanks_item['THANKFUL'] : ''; ?>
					<a class="viewtopic__thanks" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><?php echo isset($thanks_item['THANKS_TOTAL']) ? $thanks_item['THANKS_TOTAL'] : ''; ?></a> <?php echo isset($thanks_item['THANKED']) ? $thanks_item['THANKED'] : ''; ?>
					<div class="collapse" id="collapseExample">
						<div class="card card-body"><?php echo isset($thanks_item['THANKS']) ? $thanks_item['THANKS'] : ''; ?></div>
					</div>
				</div>
				<?php

} // END thanks

if(isset($thanks_item)) { unset($thanks_item); } 

?>
			</div>
		</div>
		<?php

} // END postrow

if(isset($postrow_item)) { unset($postrow_item); } 

?>

		<div class="row viewtopic__buttons justify-content-center float-md-left">

			<!-- TOPIC BUTTON (NEW POST) -->
			<a class="btn btn-dark mr-1 d-none d-md-block" href="<?php echo isset($this->vars['U_POST_NEW_TOPIC']) ? $this->vars['U_POST_NEW_TOPIC'] : $this->lang('U_POST_NEW_TOPIC'); ?>"><?php echo isset($this->vars['L_POST_NEW_TOPIC']) ? $this->vars['L_POST_NEW_TOPIC'] : $this->lang('L_POST_NEW_TOPIC'); ?></a>
			<a class="btn btn-dark mr-1 d-md-none d-sm-block" href="<?php echo isset($this->vars['U_POST_NEW_TOPIC']) ? $this->vars['U_POST_NEW_TOPIC'] : $this->lang('U_POST_NEW_TOPIC'); ?>" title="<?php echo isset($this->vars['L_POST_NEW_TOPIC']) ? $this->vars['L_POST_NEW_TOPIC'] : $this->lang('L_POST_NEW_TOPIC'); ?>"><i class="fas fa-comment"></i></a>

			<!-- TOPIC BUTTON (REPLY POST) -->
			<?php if ($this->vars['U_POST_REPLY_TOPIC']) {  ?>
			<a class="btn btn-dark mr-1 d-none d-md-block" href="<?php echo isset($this->vars['U_POST_REPLY_TOPIC']) ? $this->vars['U_POST_REPLY_TOPIC'] : $this->lang('U_POST_REPLY_TOPIC'); ?>"><?php echo isset($this->vars['L_POST_REPLY_TOPIC']) ? $this->vars['L_POST_REPLY_TOPIC'] : $this->lang('L_POST_REPLY_TOPIC'); ?></a>
			<?php } ?>
			<a class="btn btn-dark mr-1 d-md-none d-sm-block" href="<?php echo isset($this->vars['U_POST_REPLY_TOPIC']) ? $this->vars['U_POST_REPLY_TOPIC'] : $this->lang('U_POST_REPLY_TOPIC'); ?>"><i class="fas fa-reply fa__topic_icons"></i></a>

			<!-- TOPIC BUTTON (PRINT POST) -->
			<a class="btn btn-dark mr-1" target="_blank" href="<?php echo isset($this->vars['U_PRINTER_TOPIC']) ? $this->vars['U_PRINTER_TOPIC'] : $this->lang('U_PRINTER_TOPIC'); ?>" title="<?php echo isset($this->vars['L_PRINTER_TOPIC']) ? $this->vars['L_PRINTER_TOPIC'] : $this->lang('L_PRINTER_TOPIC'); ?>"><i class="fas fa-print fa__topic_icons"></i></a>

			<!-- TOPIC BUTTON (WHO HAS VIEWED THE POST) -->
			<a class="btn btn-dark mr-1" href="<?php echo isset($this->vars['U_WHOVIEW_TOPIC']) ? $this->vars['U_WHOVIEW_TOPIC'] : $this->lang('U_WHOVIEW_TOPIC'); ?>" title="<?php echo isset($this->vars['L_WHOVIEW_ALT']) ? $this->vars['L_WHOVIEW_ALT'] : $this->lang('L_WHOVIEW_ALT'); ?>"><i class="fas fa-eye fa__topic_icons"></i></a>

			<?php

$thanks_button_count = ( isset($this->_tpldata['thanks_button.']) ) ?  sizeof($this->_tpldata['thanks_button.']) : 0;
for ($thanks_button_i = 0; $thanks_button_i < $thanks_button_count; $thanks_button_i++)
{
 $thanks_button_item = &$this->_tpldata['thanks_button.'][$thanks_button_i];
 $thanks_button_item['S_ROW_COUNT'] = $thanks_button_i;
 $thanks_button_item['S_NUM_ROWS'] = $thanks_button_count;

?>
    		<a class="btn btn-dark" href="<?php echo isset($thanks_button_item['U_THANK_TOPIC']) ? $thanks_button_item['U_THANK_TOPIC'] : ''; ?>"><i class="fas fa-thumbs-up fa__topic_icons" title="<?php echo isset($thanks_button_item['L_THANK_TOPIC']) ? $thanks_button_item['L_THANK_TOPIC'] : ''; ?>"></i></a>
    		<?php

} // END thanks_button

if(isset($thanks_button_item)) { unset($thanks_button_item); } 

?>

		</div>
		<div class="clearfix"></div>

		<?php if ($this->vars['PAGINATION']) {  ?>
		<div class="row px-0 justify-content-center float-lg-right">
			<?php echo isset($this->vars['PAGINATION']) ? $this->vars['PAGINATION'] : $this->lang('PAGINATION'); ?>
		</div>
		<div class="clearfix"></div>
		<div class="divider"></div>
		<?php } ?>

		<?php

$switch_quick_reply_count = ( isset($this->_tpldata['switch_quick_reply.']) ) ?  sizeof($this->_tpldata['switch_quick_reply.']) : 0;
for ($switch_quick_reply_i = 0; $switch_quick_reply_i < $switch_quick_reply_count; $switch_quick_reply_i++)
{
 $switch_quick_reply_item = &$this->_tpldata['switch_quick_reply.'][$switch_quick_reply_i];
 $switch_quick_reply_item['S_ROW_COUNT'] = $switch_quick_reply_i;
 $switch_quick_reply_item['S_NUM_ROWS'] = $switch_quick_reply_count;

?>
		<!-- <?php echo isset($this->vars['QRBODY']) ? $this->vars['QRBODY'] : $this->lang('QRBODY'); ?> -->
		<?php

} // END switch_quick_reply

if(isset($switch_quick_reply_item)) { unset($switch_quick_reply_item); } 

?>

		<!-- Split button -->
		<?php if ($this->vars['S_TOPIC_DELETE_URL']) {  ?>
		<!-- <div class="divider"></div> -->
		<div class="btn-group col-md-2 px-0" style="margin-left: -15px;">
			<a class="btn btn-dark" href="<?php echo isset($this->vars['S_TOPIC_DELETE_URL']) ? $this->vars['S_TOPIC_DELETE_URL'] : $this->lang('S_TOPIC_DELETE_URL'); ?>"><?php echo isset($this->vars['S_TOPIC_DELETE_BTN']) ? $this->vars['S_TOPIC_DELETE_BTN'] : $this->lang('S_TOPIC_DELETE_BTN'); ?></a>

			<button type="button" class="col-3 btn btn-dark dropdown-toggle px-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<span class="sr-only">Toggle Dropdown</span>
			</button>
			<div class="dropdown-menu viewtopic__mod_options">
				<a class="dropdown-item" href="<?php echo isset($this->vars['S_TOPIC_DELETE_URL']) ? $this->vars['S_TOPIC_DELETE_URL'] : $this->lang('S_TOPIC_DELETE_URL'); ?>"><i class="fas fa-trash-alt"></i> <?php echo isset($this->vars['S_TOPIC_DELETE_BTN']) ? $this->vars['S_TOPIC_DELETE_BTN'] : $this->lang('S_TOPIC_DELETE_BTN'); ?></a>
				<a class="dropdown-item" href="<?php echo isset($this->vars['S_TOPIC_MOVE_URL']) ? $this->vars['S_TOPIC_MOVE_URL'] : $this->lang('S_TOPIC_MOVE_URL'); ?>"><i class="fas fa-arrows-alt"></i> <?php echo isset($this->vars['S_TOPIC_MOVE_BTN']) ? $this->vars['S_TOPIC_MOVE_BTN'] : $this->lang('S_TOPIC_MOVE_BTN'); ?></a>
				<a class="dropdown-item" href="<?php echo isset($this->vars['S_TOPIC_LOCK_URL']) ? $this->vars['S_TOPIC_LOCK_URL'] : $this->lang('S_TOPIC_LOCK_URL'); ?>"><?php if ($this->vars['S_TOPIC_LOCK_STATE'] == 1) {  ?><i class="fas fa-lock-open"></i><?php } else { ?><i class="fas fa-lock"></i><?php } ?> <?php echo isset($this->vars['S_TOPIC_LOCK_BTN']) ? $this->vars['S_TOPIC_LOCK_BTN'] : $this->lang('S_TOPIC_LOCK_BTN'); ?></a>
				<a class="dropdown-item" href="<?php echo isset($this->vars['S_TOPIC_SPLIT_URL']) ? $this->vars['S_TOPIC_SPLIT_URL'] : $this->lang('S_TOPIC_SPLIT_URL'); ?>"><i class="fas fa-columns"></i> <?php echo isset($this->vars['S_TOPIC_SPLIT_BTN']) ? $this->vars['S_TOPIC_SPLIT_BTN'] : $this->lang('S_TOPIC_SPLIT_BTN'); ?></a>
				<a class="dropdown-item" href="<?php echo isset($this->vars['S_TOPIC_MERGE_URL']) ? $this->vars['S_TOPIC_MERGE_URL'] : $this->lang('S_TOPIC_MERGE_URL'); ?>"><i class="fas fa-object-group"></i> <?php echo isset($this->vars['S_TOPIC_MERGE_BTN']) ? $this->vars['S_TOPIC_MERGE_BTN'] : $this->lang('S_TOPIC_MERGE_BTN'); ?></a>
			</div>
		</div>
		<?php } ?>		

	</div>

</section>