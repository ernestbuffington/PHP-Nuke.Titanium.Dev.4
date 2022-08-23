<?php

// eXtreme Styles mod cache. Generated on Fri, 19 Aug 2022 23:09:17 +0000 (time=1660950557)

?><section class="member-list-body-wrap clearfix">

	<nav aria-label="breadcrumb" class="d-none d-xl-block px-0">
		<ol class="breadcrumb ">
			<li class="breadcrumb-item"><a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>"><i class="fas fa-home"></i></a></li>
			<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo isset($this->vars['U_VIEW_FORUM']) ? $this->vars['U_VIEW_FORUM'] : $this->lang('U_VIEW_FORUM'); ?>">member list</a></li>
		</ol>
	</nav>

	<div class="table-responsive">

		<table class="table table-striped table-dark">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col"><?php echo isset($this->vars['L_USERNAME']) ? $this->vars['L_USERNAME'] : $this->lang('L_USERNAME'); ?></th>
					<th scope="col"><?php echo isset($this->vars['L_FROM']) ? $this->vars['L_FROM'] : $this->lang('L_FROM'); ?></th>
					<th scope="col"><?php echo isset($this->vars['L_AGE']) ? $this->vars['L_AGE'] : $this->lang('L_AGE'); ?></th>
					<th scope="col"><?php echo isset($this->vars['L_POSTS']) ? $this->vars['L_POSTS'] : $this->lang('L_POSTS'); ?></th>
					<th scope="col"><?php echo isset($this->vars['L_JOINED']) ? $this->vars['L_JOINED'] : $this->lang('L_JOINED'); ?></th>
					<th scope="col"><?php echo isset($this->vars['L_LAST_VISIT']) ? $this->vars['L_LAST_VISIT'] : $this->lang('L_LAST_VISIT'); ?></th>
					<th scope="col"><?php echo isset($this->vars['L_ONLINE_STATUS']) ? $this->vars['L_ONLINE_STATUS'] : $this->lang('L_ONLINE_STATUS'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php

$memberrow_count = ( isset($this->_tpldata['memberrow.']) ) ?  sizeof($this->_tpldata['memberrow.']) : 0;
for ($memberrow_i = 0; $memberrow_i < $memberrow_count; $memberrow_i++)
{
 $memberrow_item = &$this->_tpldata['memberrow.'][$memberrow_i];
 $memberrow_item['S_ROW_COUNT'] = $memberrow_i;
 $memberrow_item['S_NUM_ROWS'] = $memberrow_count;

?>
				<tr>
					<th scope="row"><?php echo isset($memberrow_item['ROW_NUMBER']) ? $memberrow_item['ROW_NUMBER'] : ''; ?></th>
					<td class="text-nowrap"><a href="<?php echo isset($memberrow_item['U_VIEWPROFILE']) ? $memberrow_item['U_VIEWPROFILE'] : ''; ?>"><?php echo isset($memberrow_item['USERNAME']) ? $memberrow_item['USERNAME'] : ''; ?></a></td>
					<td class="text-nowrap"><?php echo isset($memberrow_item['FLAG']) ? $memberrow_item['FLAG'] : ''; ?><?php echo isset($memberrow_item['FROM']) ? $memberrow_item['FROM'] : ''; ?></td>
					<td class="text-nowrap"><?php echo isset($memberrow_item['AGE']) ? $memberrow_item['AGE'] : ''; ?></td>
					<td class="text-nowrap"><?php echo isset($memberrow_item['POSTS']) ? $memberrow_item['POSTS'] : ''; ?></td>
					<td class="text-nowrap"><?php echo isset($memberrow_item['JOINED']) ? $memberrow_item['JOINED'] : ''; ?></td>
					<td class="text-nowrap"><?php echo isset($memberrow_item['LAST_ACTIVE']) ? $memberrow_item['LAST_ACTIVE'] : ''; ?></td>
					<td class="text-nowrap"><?php echo isset($memberrow_item['STATUS']) ? $memberrow_item['STATUS'] : ''; ?></td>
				</tr>
				<?php

} // END memberrow

if(isset($memberrow_item)) { unset($memberrow_item); } 

?>
			</tbody>
		</table>
		
	</div>

	<?php

$pagination_count = ( isset($this->_tpldata['pagination.']) ) ?  sizeof($this->_tpldata['pagination.']) : 0;
for ($pagination_i = 0; $pagination_i < $pagination_count; $pagination_i++)
{
 $pagination_item = &$this->_tpldata['pagination.'][$pagination_i];
 $pagination_item['S_ROW_COUNT'] = $pagination_i;
 $pagination_item['S_NUM_ROWS'] = $pagination_count;

?>
	<div class="row no-gutters mt-2 justify-content-center float-lg-right evo-pagination"><?php echo isset($pagination_item['PAGINATION']) ? $pagination_item['PAGINATION'] : ''; ?></div><?php

} // END pagination

if(isset($pagination_item)) { unset($pagination_item); } 

?>

</section>