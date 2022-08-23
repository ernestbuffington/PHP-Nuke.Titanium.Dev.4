<?php

// eXtreme Styles mod cache. Generated on Fri, 19 Aug 2022 23:09:39 +0000 (time=1660950579)

?><section class="messages__wrapper">

	<nav aria-label="breadcrumb" class="d-none d-xl-block px-0">
		<ol class="breadcrumb ">
			<li class="breadcrumb-item"><a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>"><i class="fas fa-home"></i></a></li>
			<li class="breadcrumb-item"><a href="<?php echo isset($this->vars['MODULE_URI']) ? $this->vars['MODULE_URI'] : $this->lang('MODULE_URI'); ?>"><?php echo isset($this->vars['MODULE_NAME']) ? $this->vars['MODULE_NAME'] : $this->lang('MODULE_NAME'); ?></a></li>
			<li class="breadcrumb-item active" aria-current="page"><?php echo isset($this->vars['BOX_NAME']) ? $this->vars['BOX_NAME'] : $this->lang('BOX_NAME'); ?></li>
		</ol>
	</nav>

	<div class="container-fluid">

		<div class="row">

			<div class="col-md-6 col-lg-3">
				<a class="messages_a" href="<?php echo isset($this->vars['INBOX_URI']) ? $this->vars['INBOX_URI'] : $this->lang('INBOX_URI'); ?>">
					<div class="messages__inbox">

						<h2 class="number"><?php echo isset($this->vars['TOTAL_INBOX']) ? $this->vars['TOTAL_INBOX'] : $this->lang('TOTAL_INBOX'); ?></h2>
						<span class="desc"><?php echo isset($this->vars['INBOX_TITLE']) ? $this->vars['INBOX_TITLE'] : $this->lang('INBOX_TITLE'); ?></span>
						<div class="icon">
							<i class="fas fa-inbox"></i>
						</div>

					</div>
				</a>
			</div>
			<div class="col-md-6 col-lg-3">
				<a class="messages_a" href="<?php echo isset($this->vars['SENTBOX_URI']) ? $this->vars['SENTBOX_URI'] : $this->lang('SENTBOX_URI'); ?>">
					<div class="messages__inbox">

						<h2 class="number"><?php echo isset($this->vars['TOTAL_SENTBOX']) ? $this->vars['TOTAL_SENTBOX'] : $this->lang('TOTAL_SENTBOX'); ?></h2>
						<span class="desc"><?php echo isset($this->vars['SENTBOX_TITLE']) ? $this->vars['SENTBOX_TITLE'] : $this->lang('SENTBOX_TITLE'); ?></span>
						<div class="icon">
							<i class="fas fa-share"></i>
						</div>

					</div>
				</a>
			</div>
			<div class="col-md-6 col-lg-3">
				<a class="messages_a" href="<?php echo isset($this->vars['OUTBOX_URI']) ? $this->vars['OUTBOX_URI'] : $this->lang('OUTBOX_URI'); ?>">
					<div class="messages__inbox">

						<h2 class="number"><?php echo isset($this->vars['TOTAL_OUTBOX']) ? $this->vars['TOTAL_OUTBOX'] : $this->lang('TOTAL_OUTBOX'); ?></h2>
						<span class="desc"><?php echo isset($this->vars['OUTBOX_TITLE']) ? $this->vars['OUTBOX_TITLE'] : $this->lang('OUTBOX_TITLE'); ?></span>
						<div class="icon">
							<i class="fas fa-level-up-alt"></i>
						</div>

					</div>
				</a>
			</div>
			<div class="col-md-6 col-lg-3">
				<a class="messages_a" href="<?php echo isset($this->vars['SAVEBOX_URI']) ? $this->vars['SAVEBOX_URI'] : $this->lang('SAVEBOX_URI'); ?>">
					<div class="messages__inbox">

						<h2 class="number"><?php echo isset($this->vars['TOTAL_SAVEBOX']) ? $this->vars['TOTAL_SAVEBOX'] : $this->lang('TOTAL_SAVEBOX'); ?></h2>
						<span class="desc"><?php echo isset($this->vars['SAVEBOX_TITLE']) ? $this->vars['SAVEBOX_TITLE'] : $this->lang('SAVEBOX_TITLE'); ?></span>
						<div class="icon">
							<i class="fas fa-save"></i>
						</div>

					</div>
				</a>
			</div>

		</div>

	</div>
</section>

<div class="divider mb-3"></div>

<?php if ($this->vars['BOX_SIZE_STATUS']) {  ?>
<section>
	<div class="container-fluid">
		<div class="row mb-2 ml-2 mr-2">
			<!-- Inbox percentage meter -->
			<h3 class="progress-percentage"><?php echo isset($this->vars['BOX_SIZE_STATUS']) ? $this->vars['BOX_SIZE_STATUS'] : $this->lang('BOX_SIZE_STATUS'); ?></h3>
			<div class="progress">
  				<div class="progress-bar bg-success" role="progressbar" style="width: <?php echo isset($this->vars['INBOX_LIMIT_PERCENT']) ? $this->vars['INBOX_LIMIT_PERCENT'] : $this->lang('INBOX_LIMIT_PERCENT'); ?>%" aria-valuenow="<?php echo isset($this->vars['INBOX_LIMIT_PERCENT']) ? $this->vars['INBOX_LIMIT_PERCENT'] : $this->lang('INBOX_LIMIT_PERCENT'); ?>" aria-valuemin="0" aria-valuemax="100"></div>
			</div>
		</div>
		<div class="row mb-4 ml-2 mr-2">
			<!-- Attachements percentage meter -->
			<h3 class="progress-percentage"><?php echo isset($this->vars['ATTACH_BOX_SIZE_STATUS']) ? $this->vars['ATTACH_BOX_SIZE_STATUS'] : $this->lang('ATTACH_BOX_SIZE_STATUS'); ?></h3>
			<div class="progress">
  				<div class="progress-bar bg-success" role="progressbar" style="width: <?php echo isset($this->vars['ATTACHBOX_LIMIT_PERCENT']) ? $this->vars['ATTACHBOX_LIMIT_PERCENT'] : $this->lang('ATTACHBOX_LIMIT_PERCENT'); ?>%" aria-valuenow="<?php echo isset($this->vars['ATTACHBOX_LIMIT_PERCENT']) ? $this->vars['ATTACHBOX_LIMIT_PERCENT'] : $this->lang('ATTACHBOX_LIMIT_PERCENT'); ?>" aria-valuemin="0" aria-valuemax="100"></div>
			</div>
		</div>
	</div>
</section>

<div class="divider mb-3"></div>
<?php } ?>

<section>

	<div class="row pb-2">
		<div class="col-12 text-sm-center text-lg-left">
			<a class="btn btn-dark" href="<?php echo isset($this->vars['POST_PM_URL']) ? $this->vars['POST_PM_URL'] : $this->lang('POST_PM_URL'); ?>"><?php echo isset($this->vars['L_POST_PM']) ? $this->vars['L_POST_PM'] : $this->lang('L_POST_PM'); ?></a>
			<?php if ($this->vars['MASS_PM_PERMS'] == true) {  ?>
			<a class="btn btn-dark" href="<?php echo isset($this->vars['MASS_PM_URL']) ? $this->vars['MASS_PM_URL'] : $this->lang('MASS_PM_URL'); ?>"><?php echo isset($this->vars['L_MASS_PM']) ? $this->vars['L_MASS_PM'] : $this->lang('L_MASS_PM'); ?></a>
			<?php } ?>
		</div>
	</div>

	<div class="container-fluid clearfix">
		
		<div class="row messages__list">

			<form class="col-12 px-0" method="post" name="privmsg_list" action="<?php echo isset($this->vars['S_PRIVMSGS_ACTION']) ? $this->vars['S_PRIVMSGS_ACTION'] : $this->lang('S_PRIVMSGS_ACTION'); ?>">

			<?php

$listrow_count = ( isset($this->_tpldata['listrow.']) ) ?  sizeof($this->_tpldata['listrow.']) : 0;
for ($listrow_i = 0; $listrow_i < $listrow_count; $listrow_i++)
{
 $listrow_item = &$this->_tpldata['listrow.'][$listrow_i];
 $listrow_item['S_ROW_COUNT'] = $listrow_i;
 $listrow_item['S_NUM_ROWS'] = $listrow_count;

?>
			<div class="col-lg-12 messages__list_wrapper">

				<div class="row">

					<div class="col-2 col-lg-1 px-0 text-center">

						<label class="image-radio">
							<?php if ($listrow_item['PRIVMSG_STATUS_FLAG'] == true) {  ?>
							<div class="messages__list_icon_unread">
							<?php } else { ?>
							<div class="messages__list_icon">
							<?php } ?>
								<input class="checkbox" type="checkbox" name="mark[]" value="<?php echo isset($listrow_item['S_MARK_ID']) ? $listrow_item['S_MARK_ID'] : ''; ?>">
								<i class="far fa-comment"></i>
							</div>
						</label>

					</div>
					<div class="col-10 col-lg-11 px-0 messages__list_description">
						<div class="messages__list_description_inner">
							<h4 class="text-truncate"><a href="<?php echo isset($listrow_item['U_READ']) ? $listrow_item['U_READ'] : ''; ?>"><?php echo isset($listrow_item['SUBJECT']) ? $listrow_item['SUBJECT'] : ''; ?></a></h4>
							<p class="text-truncate"><a href="<?php echo isset($listrow_item['U_FROM_USER_PROFILE']) ? $listrow_item['U_FROM_USER_PROFILE'] : ''; ?>"><?php echo isset($listrow_item['FROM']) ? $listrow_item['FROM'] : ''; ?></a>, <?php echo isset($listrow_item['DATE']) ? $listrow_item['DATE'] : ''; ?></p>
						</div>						
					</div>
				</div>

			</div>
			<?php

} // END listrow

if(isset($listrow_item)) { unset($listrow_item); } 

?>

			<?php if ($this->vars['TOTAL_INBOX'] > 0) {  ?>
			<input type="submit" name="save" value="<?php echo isset($this->vars['L_SAVE_MARKED']) ? $this->vars['L_SAVE_MARKED'] : $this->lang('L_SAVE_MARKED'); ?>" class="btn btn-dark" />
            <input type="submit" name="delete" value="<?php echo isset($this->vars['L_DELETE_MARKED']) ? $this->vars['L_DELETE_MARKED'] : $this->lang('L_DELETE_MARKED'); ?>" class="btn btn-dark" />
            <input type="submit" name="deleteall" value="<?php echo isset($this->vars['L_DELETE_ALL']) ? $this->vars['L_DELETE_ALL'] : $this->lang('L_DELETE_ALL'); ?>" class="btn btn-dark" />
            <?php } ?>
        	</form>

			<?php

$switch_no_messages_count = ( isset($this->_tpldata['switch_no_messages.']) ) ?  sizeof($this->_tpldata['switch_no_messages.']) : 0;
for ($switch_no_messages_i = 0; $switch_no_messages_i < $switch_no_messages_count; $switch_no_messages_i++)
{
 $switch_no_messages_item = &$this->_tpldata['switch_no_messages.'][$switch_no_messages_i];
 $switch_no_messages_item['S_ROW_COUNT'] = $switch_no_messages_i;
 $switch_no_messages_item['S_NUM_ROWS'] = $switch_no_messages_count;

?>
			<div class="col-12 alert alert-danger"><?php echo isset($this->vars['L_NO_MESSAGES']) ? $this->vars['L_NO_MESSAGES'] : $this->lang('L_NO_MESSAGES'); ?></div>
			<?php

} // END switch_no_messages

if(isset($switch_no_messages_item)) { unset($switch_no_messages_item); } 

?>

		</div>

		

		<!-- <div class="row mt-2 justify-content-center float-lg-right">
			<?php echo isset($this->vars['PAGINATION_BOOTSTRAP']) ? $this->vars['PAGINATION_BOOTSTRAP'] : $this->lang('PAGINATION_BOOTSTRAP'); ?>
		</div> -->

		<div class="row mt-2 justify-content-center float-lg-right evo-pagination">
			<?php echo isset($this->vars['PAGINATION']) ? $this->vars['PAGINATION'] : $this->lang('PAGINATION'); ?>
		</div>

	</div>

</section>