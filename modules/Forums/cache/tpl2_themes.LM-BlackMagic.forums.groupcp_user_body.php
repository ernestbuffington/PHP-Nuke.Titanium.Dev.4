<?php

// eXtreme Styles mod cache. Generated on Fri, 19 Aug 2022 23:08:57 +0000 (time=1660950537)

?><section class="memberhips__body_wrapper">

	<nav aria-label="breadcrumb" class="d-none d-xl-block px-0">
		<ol class="breadcrumb ">
			<li class="breadcrumb-item"><a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>"><i class="fas fa-home"></i></a></li>
			<li class="breadcrumb-item active" aria-current="page"><a href="modules.php?name=Groups">Groups</a></li>
		</ol>
	</nav>

	<div class="container-fluid">

		<?php

$switch_groups_joined_count = ( isset($this->_tpldata['switch_groups_joined.']) ) ?  sizeof($this->_tpldata['switch_groups_joined.']) : 0;
for ($switch_groups_joined_i = 0; $switch_groups_joined_i < $switch_groups_joined_count; $switch_groups_joined_i++)
{
 $switch_groups_joined_item = &$this->_tpldata['switch_groups_joined.'][$switch_groups_joined_i];
 $switch_groups_joined_item['S_ROW_COUNT'] = $switch_groups_joined_i;
 $switch_groups_joined_item['S_NUM_ROWS'] = $switch_groups_joined_count;

?>
		<div class="row phpbb-membership-groups"><?php echo isset($this->vars['L_GROUP_MEMBERSHIP_DETAILS']) ? $this->vars['L_GROUP_MEMBERSHIP_DETAILS'] : $this->lang('L_GROUP_MEMBERSHIP_DETAILS'); ?></div>
		<div class="row phpbb-membership-wrap">

			<?php

$switch_groups_member_count = ( isset($switch_groups_joined_item['switch_groups_member.']) ) ? sizeof($switch_groups_joined_item['switch_groups_member.']) : 0;
for ($switch_groups_member_i = 0; $switch_groups_member_i < $switch_groups_member_count; $switch_groups_member_i++)
{
 $switch_groups_member_item = &$switch_groups_joined_item['switch_groups_member.'][$switch_groups_member_i];
 $switch_groups_member_item['S_ROW_COUNT'] = $switch_groups_member_i;
 $switch_groups_member_item['S_NUM_ROWS'] = $switch_groups_member_count;

?>
			
			<div class="col-12 col-lg-6 phpbb-membership-title d-flex justify-content-center justify-content-md-start"><?php echo isset($this->vars['L_YOU_BELONG_GROUPS']) ? $this->vars['L_YOU_BELONG_GROUPS'] : $this->lang('L_YOU_BELONG_GROUPS'); ?></div>
			<form class="col-12 col-lg-6 px-0" method="post" action="<?php echo isset($this->vars['S_USERGROUP_ACTION']) ? $this->vars['S_USERGROUP_ACTION'] : $this->lang('S_USERGROUP_ACTION'); ?>">
			<div class="row col-12 mx-0 phpbb-membership-select">
				<div class="col-12 col-lg-8">
					<?php echo isset($this->vars['GROUP_MEMBER_SELECT']) ? $this->vars['GROUP_MEMBER_SELECT'] : $this->lang('GROUP_MEMBER_SELECT'); ?>
				</div>
				<div class="col-12 col-lg-4">
					<input type="submit" value="<?php echo isset($this->vars['L_VIEW_INFORMATION']) ? $this->vars['L_VIEW_INFORMATION'] : $this->lang('L_VIEW_INFORMATION'); ?>" class="col-12 phpbb-group-button btn btn-outline-primary" />
					<?php echo isset($this->vars['S_HIDDEN_FIELDS']) ? $this->vars['S_HIDDEN_FIELDS'] : $this->lang('S_HIDDEN_FIELDS'); ?>
				</div>
			</div>
			</form>
			<?php

} // END switch_groups_member

if(isset($switch_groups_member_item)) { unset($switch_groups_member_item); } 

?>

			<?php

$switch_groups_pending_count = ( isset($switch_groups_joined_item['switch_groups_pending.']) ) ? sizeof($switch_groups_joined_item['switch_groups_pending.']) : 0;
for ($switch_groups_pending_i = 0; $switch_groups_pending_i < $switch_groups_pending_count; $switch_groups_pending_i++)
{
 $switch_groups_pending_item = &$switch_groups_joined_item['switch_groups_pending.'][$switch_groups_pending_i];
 $switch_groups_pending_item['S_ROW_COUNT'] = $switch_groups_pending_i;
 $switch_groups_pending_item['S_NUM_ROWS'] = $switch_groups_pending_count;

?>
			<div class="row phpbb-membership-groups">
				<?php echo isset($this->vars['L_PENDING_GROUPS']) ? $this->vars['L_PENDING_GROUPS'] : $this->lang('L_PENDING_GROUPS'); ?>
			</div>

			<div class="row phpbb-membership-wrap">

				<div class="col-12 col-lg-6 phpbb-membership-title d-flex justify-content-center justify-content-md-start"><?php echo isset($this->vars['L_SELECT_A_GROUP']) ? $this->vars['L_SELECT_A_GROUP'] : $this->lang('L_SELECT_A_GROUP'); ?></div>
				<form class="col-12 col-lg-6 px-0" method="post" action="<?php echo isset($this->vars['S_USERGROUP_ACTION']) ? $this->vars['S_USERGROUP_ACTION'] : $this->lang('S_USERGROUP_ACTION'); ?>">
				<div class="row col-12 mx-0 phpbb-membership-select">
					<div class="col-12 col-lg-8">
						<?php echo isset($this->vars['GROUP_PENDING_SELECT']) ? $this->vars['GROUP_PENDING_SELECT'] : $this->lang('GROUP_PENDING_SELECT'); ?>
					</div>
					<div class="col-12 col-lg-4">
						<input type="submit" value="<?php echo isset($this->vars['L_VIEW_INFORMATION']) ? $this->vars['L_VIEW_INFORMATION'] : $this->lang('L_VIEW_INFORMATION'); ?>" class="col-12 phpbb-group-button btn btn-outline-primary" />
						<?php echo isset($this->vars['S_HIDDEN_FIELDS']) ? $this->vars['S_HIDDEN_FIELDS'] : $this->lang('S_HIDDEN_FIELDS'); ?>
					</div>
				</div>
				</form>
			</div>
			<?php

} // END switch_groups_pending

if(isset($switch_groups_pending_item)) { unset($switch_groups_pending_item); } 

?>
		</div>
		<?php

} // END switch_groups_joined

if(isset($switch_groups_joined_item)) { unset($switch_groups_joined_item); } 

?>

		<?php

$switch_groups_remaining_count = ( isset($this->_tpldata['switch_groups_remaining.']) ) ?  sizeof($this->_tpldata['switch_groups_remaining.']) : 0;
for ($switch_groups_remaining_i = 0; $switch_groups_remaining_i < $switch_groups_remaining_count; $switch_groups_remaining_i++)
{
 $switch_groups_remaining_item = &$this->_tpldata['switch_groups_remaining.'][$switch_groups_remaining_i];
 $switch_groups_remaining_item['S_ROW_COUNT'] = $switch_groups_remaining_i;
 $switch_groups_remaining_item['S_NUM_ROWS'] = $switch_groups_remaining_count;

?>
		<div class="row phpbb-membership-groups">
			<?php echo isset($this->vars['L_GROUP_MEMBERSHIP_DETAILS']) ? $this->vars['L_GROUP_MEMBERSHIP_DETAILS'] : $this->lang('L_GROUP_MEMBERSHIP_DETAILS'); ?>
		</div>
		<div class="row phpbb-membership-wrap">
			<div class="col-12 col-lg-6 phpbb-membership-title d-flex justify-content-center justify-content-md-start""><?php echo isset($this->vars['L_SELECT_A_GROUP']) ? $this->vars['L_SELECT_A_GROUP'] : $this->lang('L_SELECT_A_GROUP'); ?></div>
			<form class="col-12 col-lg-6 px-0" method="post" action="<?php echo isset($this->vars['S_USERGROUP_ACTION']) ? $this->vars['S_USERGROUP_ACTION'] : $this->lang('S_USERGROUP_ACTION'); ?>">
			<div class="row col-12 mx-0 phpbb-membership-select">
				<div class="col-12 col-lg-8">
					<?php echo isset($this->vars['GROUP_LIST_SELECT']) ? $this->vars['GROUP_LIST_SELECT'] : $this->lang('GROUP_LIST_SELECT'); ?>
				</div>
				<div class="col-12 col-lg-4">
					<input type="submit" value="<?php echo isset($this->vars['L_VIEW_INFORMATION']) ? $this->vars['L_VIEW_INFORMATION'] : $this->lang('L_VIEW_INFORMATION'); ?>" class="col-12 phpbb-group-button btn btn-outline-primary" />
					<?php echo isset($this->vars['S_HIDDEN_FIELDS']) ? $this->vars['S_HIDDEN_FIELDS'] : $this->lang('S_HIDDEN_FIELDS'); ?>			
				</div>
			</div>
			</form>
		</div>
		<?php

} // END switch_groups_remaining

if(isset($switch_groups_remaining_item)) { unset($switch_groups_remaining_item); } 

?>

	</div>

</section>