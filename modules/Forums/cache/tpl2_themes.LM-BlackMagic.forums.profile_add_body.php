<?php

// eXtreme Styles mod cache. Generated on Fri, 19 Aug 2022 23:23:48 +0000 (time=1660951428)

?><section class="posting__edit_wrapper">

	<nav aria-label="breadcrumb" class="d-none d-xl-block px-0">
		<ol class="breadcrumb ">
			<li class="breadcrumb-item"><a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>"><i class="fas fa-home"></i></a></li>
			<li class="breadcrumb-item active"><?php echo isset($this->vars['L_PAGE_TITLE']) ? $this->vars['L_PAGE_TITLE'] : $this->lang('L_PAGE_TITLE'); ?></li>
		</ol>
	</nav>

	<div class="container-fluid px-0">

		<!-- <div class="row"> -->

			<div class="d-flex justify-content-center mb-4 mt-4"><span class="messages__posting_title"><?php echo isset($this->vars['L_PAGE_TITLE']) ? $this->vars['L_PAGE_TITLE'] : $this->lang('L_PAGE_TITLE'); ?></span></div>

			<ul class="nav nav-tabs profile-edit-tabs" id="myTab" role="tablist">
				<li class="nav-item"><a class="profile-edit-link nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><?php echo isset($this->vars['L_REGISTRATION_INFO']) ? $this->vars['L_REGISTRATION_INFO'] : $this->lang('L_REGISTRATION_INFO'); ?></a></li>
				<li class="nav-item"><a class="profile-edit-link nav-link" id="password-tab" data-toggle="tab" href="#password" role="tab" aria-controls="password" aria-selected="false"><?php echo isset($this->vars['L_PROFILE_PASSWORD']) ? $this->vars['L_PROFILE_PASSWORD'] : $this->lang('L_PROFILE_PASSWORD'); ?></a></li>
				<li class="nav-item"><a class="profile-edit-link nav-link" id="public-info-tab" data-toggle="tab" href="#public-info" role="tab" aria-controls="public-info" aria-selected="false"><?php echo isset($this->vars['L_PROFILE_INFO']) ? $this->vars['L_PROFILE_INFO'] : $this->lang('L_PROFILE_INFO'); ?></a></li>
				<li class="nav-item"><a class="profile-edit-link nav-link" id="preferences-tab" data-toggle="tab" href="#preferences" role="tab" aria-controls="preferences" aria-selected="false"><?php echo isset($this->vars['L_PREFERENCES']) ? $this->vars['L_PREFERENCES'] : $this->lang('L_PREFERENCES'); ?></a></li>			  
				<li class="nav-item"><a class="profile-edit-link nav-link" id="avatar-tab" data-toggle="tab" href="#avatar" role="tab" aria-controls="avatar" aria-selected="false"><?php echo isset($this->vars['L_AVATAR_PANEL']) ? $this->vars['L_AVATAR_PANEL'] : $this->lang('L_AVATAR_PANEL'); ?></a></li>
				<li class="nav-item"><a class="profile-edit-link nav-link" href="<?php echo isset($this->vars['SIG_EDIT_LINK']) ? $this->vars['SIG_EDIT_LINK'] : $this->lang('SIG_EDIT_LINK'); ?>"><?php echo isset($this->vars['SIG_BUTTON_DESC']) ? $this->vars['SIG_BUTTON_DESC'] : $this->lang('SIG_BUTTON_DESC'); ?></a></li>
			</ul>

			<form action="<?php echo isset($this->vars['S_PROFILE_ACTION']) ? $this->vars['S_PROFILE_ACTION'] : $this->lang('S_PROFILE_ACTION'); ?>" <?php echo isset($this->vars['S_FORM_ENCTYPE']) ? $this->vars['S_FORM_ENCTYPE'] : $this->lang('S_FORM_ENCTYPE'); ?> method="post" name="edit_profile">
			<div class="profile-edit-tab-pane tab-content p-3" id="myTabContent">

				<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
					
					<div class="form-group row mx-0">
						<label for="username" class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_USERNAME']) ? $this->vars['L_USERNAME'] : $this->lang('L_USERNAME'); ?></label>
						<div class="col-12 col-lg-6 px-0"><input class="form-control" type="text" name="username" id="username" value="<?php echo isset($this->vars['USERNAME']) ? $this->vars['USERNAME'] : $this->lang('USERNAME'); ?>" autocomplete="username"></div>
					</div>

					<div class="form-group row mx-0">
						<label for="rname" class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_NAME']) ? $this->vars['L_NAME'] : $this->lang('L_NAME'); ?></label>
						<div class="col-12 col-lg-6 px-0"><input class="form-control" type="text" name="rname" id="rname" value="<?php echo isset($this->vars['RNAME']) ? $this->vars['RNAME'] : $this->lang('RNAME'); ?>"></div>
					</div>

					<div class="form-group row mx-0">
						<label for="email" class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_EMAIL_ADDRESS']) ? $this->vars['L_EMAIL_ADDRESS'] : $this->lang('L_EMAIL_ADDRESS'); ?></label>
						<div class="col-12 col-lg-6 px-0"><input class="form-control" type="text" name="email" id="email" value="<?php echo isset($this->vars['EMAIL']) ? $this->vars['EMAIL'] : $this->lang('EMAIL'); ?>"></div>
					</div>

					<!-- gender selection -->
					<div class="form-group row mx-0">
						<label for="gender" class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_GENDER']) ? $this->vars['L_GENDER'] : $this->lang('L_GENDER'); ?></label>
						<div class="col-12 col-lg-6 px-0">
							<select name="gender" id="gender" class="form-control">
								<option value="1" <?php echo isset($this->vars['GENDER_MALE_SELECTED']) ? $this->vars['GENDER_MALE_SELECTED'] : $this->lang('GENDER_MALE_SELECTED'); ?>>Male</option>
								<option value="2" <?php echo isset($this->vars['GENDER_FEMALE_SELECTED']) ? $this->vars['GENDER_FEMALE_SELECTED'] : $this->lang('GENDER_FEMALE_SELECTED'); ?>>Female</option>
								<option value="0" <?php echo isset($this->vars['GENDER_NO_SPECIFY_SELECTED']) ? $this->vars['GENDER_NO_SPECIFY_SELECTED'] : $this->lang('GENDER_NO_SPECIFY_SELECTED'); ?>>Unspecified</option>
							</select>
						</div>
					</div>

					<div class="form-group row mx-0 birthday-select">
						<label for="bday_day" class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_BIRTHDAY']) ? $this->vars['L_BIRTHDAY'] : $this->lang('L_BIRTHDAY'); ?></label>
						
						<div class="col-12 col-lg-1 px-0 mb-0 mb-lg-1 bday-wrap">
							<?php

$birthday_required_count = ( isset($this->_tpldata['birthday_required.']) ) ?  sizeof($this->_tpldata['birthday_required.']) : 0;
for ($birthday_required_i = 0; $birthday_required_i < $birthday_required_count; $birthday_required_i++)
{
 $birthday_required_item = &$this->_tpldata['birthday_required.'][$birthday_required_i];
 $birthday_required_item['S_ROW_COUNT'] = $birthday_required_i;
 $birthday_required_item['S_NUM_ROWS'] = $birthday_required_count;

?>
      						<input type="text" class="form-control" name="bday_day" id="bday_day" placeholder="Day" value="<?php echo isset($this->vars['BDAY_DAY']) ? $this->vars['BDAY_DAY'] : $this->lang('BDAY_DAY'); ?>" maxlength="2"<?php echo isset($this->vars['BIRTHDAY_REQUIRED']) ? $this->vars['BIRTHDAY_REQUIRED'] : $this->lang('BIRTHDAY_REQUIRED'); ?>>
      						<?php

} // END birthday_required

if(isset($birthday_required_item)) { unset($birthday_required_item); } 

?>
      						<?php

$birthday_optional_count = ( isset($this->_tpldata['birthday_optional.']) ) ?  sizeof($this->_tpldata['birthday_optional.']) : 0;
for ($birthday_optional_i = 0; $birthday_optional_i < $birthday_optional_count; $birthday_optional_i++)
{
 $birthday_optional_item = &$this->_tpldata['birthday_optional.'][$birthday_optional_i];
 $birthday_optional_item['S_ROW_COUNT'] = $birthday_optional_i;
 $birthday_optional_item['S_NUM_ROWS'] = $birthday_optional_count;

?>
      						<input type="text" class="form-control" name="bday_day" id="bday_day" placeholder="Day" value="<?php echo isset($this->vars['BDAY_DAY']) ? $this->vars['BDAY_DAY'] : $this->lang('BDAY_DAY'); ?>" maxlength="2">
      						<?php

} // END birthday_optional

if(isset($birthday_optional_item)) { unset($birthday_optional_item); } 

?>
    					</div>

    					<div class="col-12 col-lg-2 px-0 bday-month-wrap">
    						<?php

$birthday_required_count = ( isset($this->_tpldata['birthday_required.']) ) ?  sizeof($this->_tpldata['birthday_required.']) : 0;
for ($birthday_required_i = 0; $birthday_required_i < $birthday_required_count; $birthday_required_i++)
{
 $birthday_required_item = &$this->_tpldata['birthday_required.'][$birthday_required_i];
 $birthday_required_item['S_ROW_COUNT'] = $birthday_required_i;
 $birthday_required_item['S_NUM_ROWS'] = $birthday_required_count;

?>
							<select class="form-control" name="bday_month" id="bday_month"<?php echo isset($this->vars['BIRTHDAY_REQUIRED']) ? $this->vars['BIRTHDAY_REQUIRED'] : $this->lang('BIRTHDAY_REQUIRED'); ?>>
							<?php

} // END birthday_required

if(isset($birthday_required_item)) { unset($birthday_required_item); } 

?>
							<?php

$birthday_optional_count = ( isset($this->_tpldata['birthday_optional.']) ) ?  sizeof($this->_tpldata['birthday_optional.']) : 0;
for ($birthday_optional_i = 0; $birthday_optional_i < $birthday_optional_count; $birthday_optional_i++)
{
 $birthday_optional_item = &$this->_tpldata['birthday_optional.'][$birthday_optional_i];
 $birthday_optional_item['S_ROW_COUNT'] = $birthday_optional_i;
 $birthday_optional_item['S_NUM_ROWS'] = $birthday_optional_count;

?>
							<select class="form-control" name="bday_month" id="bday_month">
							<?php

} // END birthday_optional

if(isset($birthday_optional_item)) { unset($birthday_optional_item); } 

?>
								<option value="0"<?php echo isset($this->vars['MONTH_DEFAULT']) ? $this->vars['MONTH_DEFAULT'] : $this->lang('MONTH_DEFAULT'); ?>>Month</option>
								<option value="1"<?php echo isset($this->vars['MONTH_JAN_SELECTED']) ? $this->vars['MONTH_JAN_SELECTED'] : $this->lang('MONTH_JAN_SELECTED'); ?>>January</option>
								<option value="2"<?php echo isset($this->vars['MONTH_FEB_SELECTED']) ? $this->vars['MONTH_FEB_SELECTED'] : $this->lang('MONTH_FEB_SELECTED'); ?>>Feburary</option>
								<option value="3"<?php echo isset($this->vars['MONTH_MAR_SELECTED']) ? $this->vars['MONTH_MAR_SELECTED'] : $this->lang('MONTH_MAR_SELECTED'); ?>>March</option>
								<option value="4"<?php echo isset($this->vars['MONTH_APR_SELECTED']) ? $this->vars['MONTH_APR_SELECTED'] : $this->lang('MONTH_APR_SELECTED'); ?>>April</option>
								<option value="5"<?php echo isset($this->vars['MONTH_MAY_SELECTED']) ? $this->vars['MONTH_MAY_SELECTED'] : $this->lang('MONTH_MAY_SELECTED'); ?>>May</option>
								<option value="6"<?php echo isset($this->vars['MONTH_JUN_SELECTED']) ? $this->vars['MONTH_JUN_SELECTED'] : $this->lang('MONTH_JUN_SELECTED'); ?>>June</option>
								<option value="7"<?php echo isset($this->vars['MONTH_JUL_SELECTED']) ? $this->vars['MONTH_JUL_SELECTED'] : $this->lang('MONTH_JUL_SELECTED'); ?>>July</option>
								<option value="8"<?php echo isset($this->vars['MONTH_AUG_SELECTED']) ? $this->vars['MONTH_AUG_SELECTED'] : $this->lang('MONTH_AUG_SELECTED'); ?>>August</option>
								<option value="9"<?php echo isset($this->vars['MONTH_SEP_SELECTED']) ? $this->vars['MONTH_SEP_SELECTED'] : $this->lang('MONTH_SEP_SELECTED'); ?>>September</option>
								<option value="10"<?php echo isset($this->vars['MONTH_OCT_SELECTED']) ? $this->vars['MONTH_OCT_SELECTED'] : $this->lang('MONTH_OCT_SELECTED'); ?>>October</option>
								<option value="11"<?php echo isset($this->vars['MONTH_NOV_SELECTED']) ? $this->vars['MONTH_NOV_SELECTED'] : $this->lang('MONTH_NOV_SELECTED'); ?>>November</option>
								<option value="12"<?php echo isset($this->vars['MONTH_DEC_SELECTED']) ? $this->vars['MONTH_DEC_SELECTED'] : $this->lang('MONTH_DEC_SELECTED'); ?>>December</option>
							</select>
    					</div>

    					<div class="col-12 col-lg-1 px-0">
    						<?php

$birthday_required_count = ( isset($this->_tpldata['birthday_required.']) ) ?  sizeof($this->_tpldata['birthday_required.']) : 0;
for ($birthday_required_i = 0; $birthday_required_i < $birthday_required_count; $birthday_required_i++)
{
 $birthday_required_item = &$this->_tpldata['birthday_required.'][$birthday_required_i];
 $birthday_required_item['S_ROW_COUNT'] = $birthday_required_i;
 $birthday_required_item['S_NUM_ROWS'] = $birthday_required_count;

?>
      						<input type="text" class="form-control" name="bday_year" id="bday_year" placeholder="Year" value="<?php echo isset($this->vars['BDAY_YEAR']) ? $this->vars['BDAY_YEAR'] : $this->lang('BDAY_YEAR'); ?>" maxlength="4"<?php echo isset($this->vars['BIRTHDAY_YEAR_REQUIRED']) ? $this->vars['BIRTHDAY_YEAR_REQUIRED'] : $this->lang('BIRTHDAY_YEAR_REQUIRED'); ?>>
      						<?php

} // END birthday_required

if(isset($birthday_required_item)) { unset($birthday_required_item); } 

?>
      						<?php

$birthday_optional_count = ( isset($this->_tpldata['birthday_optional.']) ) ?  sizeof($this->_tpldata['birthday_optional.']) : 0;
for ($birthday_optional_i = 0; $birthday_optional_i < $birthday_optional_count; $birthday_optional_i++)
{
 $birthday_optional_item = &$this->_tpldata['birthday_optional.'][$birthday_optional_i];
 $birthday_optional_item['S_ROW_COUNT'] = $birthday_optional_i;
 $birthday_optional_item['S_NUM_ROWS'] = $birthday_optional_count;

?>
      						<input type="text" class="form-control" name="bday_year" id="bday_year" placeholder="Year" value="<?php echo isset($this->vars['BDAY_YEAR']) ? $this->vars['BDAY_YEAR'] : $this->lang('BDAY_YEAR'); ?>" maxlength="4">
      						<?php

} // END birthday_optional

if(isset($birthday_optional_item)) { unset($birthday_optional_item); } 

?>
    					</div>

					</div>
					
				</div>

				<div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">

					<?php

$switch_edit_profile_count = ( isset($this->_tpldata['switch_edit_profile.']) ) ?  sizeof($this->_tpldata['switch_edit_profile.']) : 0;
for ($switch_edit_profile_i = 0; $switch_edit_profile_i < $switch_edit_profile_count; $switch_edit_profile_i++)
{
 $switch_edit_profile_item = &$this->_tpldata['switch_edit_profile.'][$switch_edit_profile_i];
 $switch_edit_profile_item['S_ROW_COUNT'] = $switch_edit_profile_i;
 $switch_edit_profile_item['S_NUM_ROWS'] = $switch_edit_profile_count;

?>
					<div class="form-group row mx-0">
						<label for="cur_password" class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_CURRENT_PASSWORD']) ? $this->vars['L_CURRENT_PASSWORD'] : $this->lang('L_CURRENT_PASSWORD'); ?></label>
						<div class="col-12 col-lg-6 px-0">
							<input class="form-control" type="password" name="cur_password" id="cur_password" value="<?php echo isset($this->vars['CUR_PASSWORD']) ? $this->vars['CUR_PASSWORD'] : $this->lang('CUR_PASSWORD'); ?>" autocomplete="current-password">
							<small id="passwordHelpBlock" class="form-text text-muted"><?php echo isset($this->vars['L_CONFIRM_PASSWORD_EXPLAIN']) ? $this->vars['L_CONFIRM_PASSWORD_EXPLAIN'] : $this->lang('L_CONFIRM_PASSWORD_EXPLAIN'); ?></small>
						</div>
					</div>
					<?php

} // END switch_edit_profile

if(isset($switch_edit_profile_item)) { unset($switch_edit_profile_item); } 

?>

					<?php

$switch_ya_merge_count = ( isset($this->_tpldata['switch_ya_merge.']) ) ?  sizeof($this->_tpldata['switch_ya_merge.']) : 0;
for ($switch_ya_merge_i = 0; $switch_ya_merge_i < $switch_ya_merge_count; $switch_ya_merge_i++)
{
 $switch_ya_merge_item = &$this->_tpldata['switch_ya_merge.'][$switch_ya_merge_i];
 $switch_ya_merge_item['S_ROW_COUNT'] = $switch_ya_merge_i;
 $switch_ya_merge_item['S_NUM_ROWS'] = $switch_ya_merge_count;

?>
					<div class="form-group row mx-0">
						<label for="new_password" class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_NEW_PASSWORD']) ? $this->vars['L_NEW_PASSWORD'] : $this->lang('L_NEW_PASSWORD'); ?></label>
						<div class="col-12 col-lg-6 px-0">
							<input class="form-control pass-autocomplete-off" type="password" name="new_password" id="new_password" value="<?php echo isset($this->vars['NEW_PASSWORD']) ? $this->vars['NEW_PASSWORD'] : $this->lang('NEW_PASSWORD'); ?>" autocomplete="new-password">
							<small id="passwordHelpBlock" class="form-text text-muted"><?php echo isset($this->vars['L_PASSWORD_IF_CHANGED']) ? $this->vars['L_PASSWORD_IF_CHANGED'] : $this->lang('L_PASSWORD_IF_CHANGED'); ?></small>
						</div>
					</div>

					<div class="form-group row mx-0">
						<label for="password_confirm" class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_CONFIRM_PASSWORD']) ? $this->vars['L_CONFIRM_PASSWORD'] : $this->lang('L_CONFIRM_PASSWORD'); ?></label>
						<div class="col-12 col-lg-6 px-0">
							<input class="form-control pass-autocomplete-off" type="password" name="password_confirm" id="password_confirm" value="<?php echo isset($this->vars['PASSWORD_CONFIRM']) ? $this->vars['PASSWORD_CONFIRM'] : $this->lang('PASSWORD_CONFIRM'); ?>" autocomplete="new-password">
							<small id="passwordHelpBlock" class="form-text text-muted"><?php echo isset($this->vars['L_PASSWORD_CONFIRM_IF_CHANGED']) ? $this->vars['L_PASSWORD_CONFIRM_IF_CHANGED'] : $this->lang('L_PASSWORD_CONFIRM_IF_CHANGED'); ?></small>
						</div>
					</div>
					<?php

} // END switch_ya_merge

if(isset($switch_ya_merge_item)) { unset($switch_ya_merge_item); } 

?>

					<?php

$switch_silent_password_count = ( isset($this->_tpldata['switch_silent_password.']) ) ?  sizeof($this->_tpldata['switch_silent_password.']) : 0;
for ($switch_silent_password_i = 0; $switch_silent_password_i < $switch_silent_password_count; $switch_silent_password_i++)
{
 $switch_silent_password_item = &$this->_tpldata['switch_silent_password.'][$switch_silent_password_i];
 $switch_silent_password_item['S_ROW_COUNT'] = $switch_silent_password_i;
 $switch_silent_password_item['S_NUM_ROWS'] = $switch_silent_password_count;

?>
					<input type="hidden" name="new_password" value="<?php echo isset($this->vars['NEW_PASSWORD']) ? $this->vars['NEW_PASSWORD'] : $this->lang('NEW_PASSWORD'); ?>" />
					<input type="hidden" name="password_confirm" value="<?php echo isset($this->vars['PASSWORD_CONFIRM']) ? $this->vars['PASSWORD_CONFIRM'] : $this->lang('PASSWORD_CONFIRM'); ?>" />
					<?php

} // END switch_silent_password

if(isset($switch_silent_password_item)) { unset($switch_silent_password_item); } 

?>

				</div>

				<div class="tab-pane fade" id="public-info" role="tabpanel" aria-labelledby="public-info-tab">

					<div class="form-group row mx-0">
						<label for="facebook" class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_FACEBOOK']) ? $this->vars['L_FACEBOOK'] : $this->lang('L_FACEBOOK'); ?></label>
						<div class="col-12 col-lg-6 px-0">
							<input class="form-control" type="text" name="facebook" id="facebook" value="<?php echo isset($this->vars['FACEBOOK']) ? $this->vars['FACEBOOK'] : $this->lang('FACEBOOK'); ?>">
							<small id="facebookHelpBlock" class="form-text text-muted">https://facebook.com/<span>face.book.2019</span></small>
						</div>
					</div>

					<div class="form-group row mx-0">
						<label for="user_flag" class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_FLAG']) ? $this->vars['L_FLAG'] : $this->lang('L_FLAG'); ?></label>
						<div class="col-10 col-lg-5 px-0">
							<select class="form-control user_from_flag_select" name="user_flag" id="user_flag">
								<option value="blank"><?php echo isset($this->vars['L_FLAG_SELECT']) ? $this->vars['L_FLAG_SELECT'] : $this->lang('L_FLAG_SELECT'); ?></option>
								<?php

$country_flags_count = ( isset($this->_tpldata['country_flags.']) ) ?  sizeof($this->_tpldata['country_flags.']) : 0;
for ($country_flags_i = 0; $country_flags_i < $country_flags_count; $country_flags_i++)
{
 $country_flags_item = &$this->_tpldata['country_flags.'][$country_flags_i];
 $country_flags_item['S_ROW_COUNT'] = $country_flags_i;
 $country_flags_item['S_NUM_ROWS'] = $country_flags_count;

?>
								<option value="<?php echo isset($country_flags_item['FLAG_NAME']) ? $country_flags_item['FLAG_NAME'] : ''; ?>"<?php echo isset($country_flags_item['FLAG_SELECTED']) ? $country_flags_item['FLAG_SELECTED'] : ''; ?>><?php echo isset($country_flags_item['FLAG_NAME']) ? $country_flags_item['FLAG_NAME'] : ''; ?></option>
								<?php

} // END country_flags

if(isset($country_flags_item)) { unset($country_flags_item); } 

?>
							</select>
						</div>
						<div class="col-2 col-lg-1 px-0 d-flex justify-content-center align-items-center"><span class="countries <?php echo isset($this->vars['FLAG_START']) ? $this->vars['FLAG_START'] : $this->lang('FLAG_START'); ?>"></span></div>
					</div>

					<?php

$xdata_count = ( isset($this->_tpldata['xdata.']) ) ?  sizeof($this->_tpldata['xdata.']) : 0;
for ($xdata_i = 0; $xdata_i < $xdata_count; $xdata_i++)
{
 $xdata_item = &$this->_tpldata['xdata.'][$xdata_i];
 $xdata_item['S_ROW_COUNT'] = $xdata_i;
 $xdata_item['S_NUM_ROWS'] = $xdata_count;

?>

					<?php

$switch_is_location_count = ( isset($xdata_item['switch_is_location.']) ) ? sizeof($xdata_item['switch_is_location.']) : 0;
for ($switch_is_location_i = 0; $switch_is_location_i < $switch_is_location_count; $switch_is_location_i++)
{
 $switch_is_location_item = &$xdata_item['switch_is_location.'][$switch_is_location_i];
 $switch_is_location_item['S_ROW_COUNT'] = $switch_is_location_i;
 $switch_is_location_item['S_NUM_ROWS'] = $switch_is_location_count;

?>
					<div class="form-group row mx-0">
						<label for="location" class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_LOCATION']) ? $this->vars['L_LOCATION'] : $this->lang('L_LOCATION'); ?></label>
						<div class="col-12 col-lg-6 px-0">
							<input class="form-control" type="text" name="location" id="location" value="<?php echo isset($this->vars['LOCATION']) ? $this->vars['LOCATION'] : $this->lang('LOCATION'); ?>">
						</div>
					</div>
					<?php

} // END switch_is_location

if(isset($switch_is_location_item)) { unset($switch_is_location_item); } 

?>

					<?php

$switch_is_website_count = ( isset($xdata_item['switch_is_website.']) ) ? sizeof($xdata_item['switch_is_website.']) : 0;
for ($switch_is_website_i = 0; $switch_is_website_i < $switch_is_website_count; $switch_is_website_i++)
{
 $switch_is_website_item = &$xdata_item['switch_is_website.'][$switch_is_website_i];
 $switch_is_website_item['S_ROW_COUNT'] = $switch_is_website_i;
 $switch_is_website_item['S_NUM_ROWS'] = $switch_is_website_count;

?>
					<div class="form-group row mx-0">
						<label for="website" class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_WEBSITE']) ? $this->vars['L_WEBSITE'] : $this->lang('L_WEBSITE'); ?></label>
						<div class="col-12 col-lg-6 px-0">
							<input class="form-control" type="url" name="website" id="website" value="<?php echo isset($this->vars['WEBSITE']) ? $this->vars['WEBSITE'] : $this->lang('WEBSITE'); ?>">
						</div>
					</div>
					<?php

} // END switch_is_website

if(isset($switch_is_website_item)) { unset($switch_is_website_item); } 

?>

					<?php

$switch_is_occupation_count = ( isset($xdata_item['switch_is_occupation.']) ) ? sizeof($xdata_item['switch_is_occupation.']) : 0;
for ($switch_is_occupation_i = 0; $switch_is_occupation_i < $switch_is_occupation_count; $switch_is_occupation_i++)
{
 $switch_is_occupation_item = &$xdata_item['switch_is_occupation.'][$switch_is_occupation_i];
 $switch_is_occupation_item['S_ROW_COUNT'] = $switch_is_occupation_i;
 $switch_is_occupation_item['S_NUM_ROWS'] = $switch_is_occupation_count;

?>
					<div class="form-group row mx-0">
						<label for="occupation" class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_OCCUPATION']) ? $this->vars['L_OCCUPATION'] : $this->lang('L_OCCUPATION'); ?></label>
						<div class="col-12 col-lg-6 px-0">
							<input class="form-control" type="text" name="occupation" id="occupation" value="<?php echo isset($this->vars['OCCUPATION']) ? $this->vars['OCCUPATION'] : $this->lang('OCCUPATION'); ?>">
						</div>
					</div>
					<?php

} // END switch_is_occupation

if(isset($switch_is_occupation_item)) { unset($switch_is_occupation_item); } 

?>

					<?php

$switch_is_interests_count = ( isset($xdata_item['switch_is_interests.']) ) ? sizeof($xdata_item['switch_is_interests.']) : 0;
for ($switch_is_interests_i = 0; $switch_is_interests_i < $switch_is_interests_count; $switch_is_interests_i++)
{
 $switch_is_interests_item = &$xdata_item['switch_is_interests.'][$switch_is_interests_i];
 $switch_is_interests_item['S_ROW_COUNT'] = $switch_is_interests_i;
 $switch_is_interests_item['S_NUM_ROWS'] = $switch_is_interests_count;

?>
					<div class="form-group row mx-0">
						<label for="interests" class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_INTERESTS']) ? $this->vars['L_INTERESTS'] : $this->lang('L_INTERESTS'); ?></label>
						<div class="col-12 col-lg-6 px-0">
							<input class="form-control" type="text" name="interests" id="interests" value="<?php echo isset($this->vars['INTERESTS']) ? $this->vars['INTERESTS'] : $this->lang('INTERESTS'); ?>">
						</div>
					</div>
					<?php

} // END switch_is_interests

if(isset($switch_is_interests_item)) { unset($switch_is_interests_item); } 

?>

					<!-- SIGNATURE WILL GO HERE -->

					<?php

$switch_type_date_count = ( isset($xdata_item['switch_type_date.']) ) ? sizeof($xdata_item['switch_type_date.']) : 0;
for ($switch_type_date_i = 0; $switch_type_date_i < $switch_type_date_count; $switch_type_date_i++)
{
 $switch_type_date_item = &$xdata_item['switch_type_date.'][$switch_type_date_i];
 $switch_type_date_item['S_ROW_COUNT'] = $switch_type_date_i;
 $switch_type_date_item['S_NUM_ROWS'] = $switch_type_date_count;

?>
					<div class="form-group row mx-0">
						<label for="<?php echo isset($xdata_item['CODE_NAME']) ? $xdata_item['CODE_NAME'] : ''; ?>" class="col-12 col-lg-6 px-0"><?php echo isset($xdata_item['NAME']) ? $xdata_item['NAME'] : ''; ?></label>
						<div class="col-12 col-lg-6 px-0">
							<input class="form-control" type="text" name="<?php echo isset($xdata_item['CODE_NAME']) ? $xdata_item['CODE_NAME'] : ''; ?>" id="<?php echo isset($xdata_item['CODE_NAME']) ? $xdata_item['CODE_NAME'] : ''; ?>" maxlength="<?php echo isset($xdata_item['MAX_LENGTH']) ? $xdata_item['MAX_LENGTH'] : ''; ?>" value="<?php echo isset($xdata_item['VALUE']) ? $xdata_item['VALUE'] : ''; ?>">
							<small id="<?php echo isset($xdata_item['CODE_NAME']) ? $xdata_item['CODE_NAME'] : ''; ?>HelpBlock" class="form-text text-muted"><?php echo isset($xdata_item['DESCRIPTION']) ? $xdata_item['DESCRIPTION'] : ''; ?></small>
						</div>
					</div>
					<?php

} // END switch_type_date

if(isset($switch_type_date_item)) { unset($switch_type_date_item); } 

?>

					<?php

$switch_type_text_count = ( isset($xdata_item['switch_type_text.']) ) ? sizeof($xdata_item['switch_type_text.']) : 0;
for ($switch_type_text_i = 0; $switch_type_text_i < $switch_type_text_count; $switch_type_text_i++)
{
 $switch_type_text_item = &$xdata_item['switch_type_text.'][$switch_type_text_i];
 $switch_type_text_item['S_ROW_COUNT'] = $switch_type_text_i;
 $switch_type_text_item['S_NUM_ROWS'] = $switch_type_text_count;

?>
					<div class="form-group row mx-0">
						<label for="<?php echo isset($xdata_item['CODE_NAME']) ? $xdata_item['CODE_NAME'] : ''; ?>" class="col-12 col-lg-6 px-0"><?php echo isset($xdata_item['NAME']) ? $xdata_item['NAME'] : ''; ?></label>
						<div class="col-12 col-lg-6 px-0">
							<input class="form-control" type="text" name="<?php echo isset($xdata_item['CODE_NAME']) ? $xdata_item['CODE_NAME'] : ''; ?>" id="<?php echo isset($xdata_item['CODE_NAME']) ? $xdata_item['CODE_NAME'] : ''; ?>" maxlength="<?php echo isset($xdata_item['MAX_LENGTH']) ? $xdata_item['MAX_LENGTH'] : ''; ?>" value="<?php echo isset($xdata_item['VALUE']) ? $xdata_item['VALUE'] : ''; ?>">
							<small id="<?php echo isset($xdata_item['CODE_NAME']) ? $xdata_item['CODE_NAME'] : ''; ?>HelpBlock" class="form-text text-muted"><?php echo isset($xdata_item['DESCRIPTION']) ? $xdata_item['DESCRIPTION'] : ''; ?></small>
						</div>
					</div>
					<?php

} // END switch_type_text

if(isset($switch_type_text_item)) { unset($switch_type_text_item); } 

?>

					<?php

$switch_type_textarea_count = ( isset($xdata_item['switch_type_textarea.']) ) ? sizeof($xdata_item['switch_type_textarea.']) : 0;
for ($switch_type_textarea_i = 0; $switch_type_textarea_i < $switch_type_textarea_count; $switch_type_textarea_i++)
{
 $switch_type_textarea_item = &$xdata_item['switch_type_textarea.'][$switch_type_textarea_i];
 $switch_type_textarea_item['S_ROW_COUNT'] = $switch_type_textarea_i;
 $switch_type_textarea_item['S_NUM_ROWS'] = $switch_type_textarea_count;

?>
					<div class="form-group row mx-0">
						<label for="<?php echo isset($xdata_item['CODE_NAME']) ? $xdata_item['CODE_NAME'] : ''; ?>" class="col-12 col-lg-6 px-0"><?php echo isset($xdata_item['NAME']) ? $xdata_item['NAME'] : ''; ?></label>
						<div class="col-12 col-lg-6 px-0">
							<textarea name="<?php echo isset($xdata_item['CODE_NAME']) ? $xdata_item['CODE_NAME'] : ''; ?>" id="<?php echo isset($xdata_item['CODE_NAME']) ? $xdata_item['CODE_NAME'] : ''; ?>" class="form-control"><?php echo isset($xdata_item['VALUE']) ? $xdata_item['VALUE'] : ''; ?></textarea>
							<small id="<?php echo isset($xdata_item['CODE_NAME']) ? $xdata_item['CODE_NAME'] : ''; ?>HelpBlock" class="form-text text-muted"><?php echo isset($xdata_item['DESCRIPTION']) ? $xdata_item['DESCRIPTION'] : ''; ?></small>
						</div>
					</div>
					<?php

} // END switch_type_textarea

if(isset($switch_type_textarea_item)) { unset($switch_type_textarea_item); } 

?>

					<?php

$switch_type_checkbox_count = ( isset($xdata_item['switch_type_checkbox.']) ) ? sizeof($xdata_item['switch_type_checkbox.']) : 0;
for ($switch_type_checkbox_i = 0; $switch_type_checkbox_i < $switch_type_checkbox_count; $switch_type_checkbox_i++)
{
 $switch_type_checkbox_item = &$xdata_item['switch_type_checkbox.'][$switch_type_checkbox_i];
 $switch_type_checkbox_item['S_ROW_COUNT'] = $switch_type_checkbox_i;
 $switch_type_checkbox_item['S_NUM_ROWS'] = $switch_type_checkbox_count;

?>
					<div class="form-group row mx-0">
						<label for="<?php echo isset($xdata_item['CODE_NAME']) ? $xdata_item['CODE_NAME'] : ''; ?>" class="col-12 col-lg-6 px-0"><?php echo isset($xdata_item['NAME']) ? $xdata_item['NAME'] : ''; ?></label>
						<div class="col-12 col-lg-6 px-0">
							<input class="form-check-input" type="checkbox" name="<?php echo isset($xdata_item['CODE_NAME']) ? $xdata_item['CODE_NAME'] : ''; ?>" id="<?php echo isset($xdata_item['CODE_NAME']) ? $xdata_item['CODE_NAME'] : ''; ?>" <?php echo isset($switch_type_checkbox_item['CHECKED']) ? $switch_type_checkbox_item['CHECKED'] : ''; ?> />
							<small id="<?php echo isset($xdata_item['CODE_NAME']) ? $xdata_item['CODE_NAME'] : ''; ?>HelpBlock" class="form-text text-muted"><?php echo isset($xdata_item['DESCRIPTION']) ? $xdata_item['DESCRIPTION'] : ''; ?></small>
						</div>
					</div>
					<?php

} // END switch_type_checkbox

if(isset($switch_type_checkbox_item)) { unset($switch_type_checkbox_item); } 

?>

					<?php

$switch_type_select_count = ( isset($xdata_item['switch_type_select.']) ) ? sizeof($xdata_item['switch_type_select.']) : 0;
for ($switch_type_select_i = 0; $switch_type_select_i < $switch_type_select_count; $switch_type_select_i++)
{
 $switch_type_select_item = &$xdata_item['switch_type_select.'][$switch_type_select_i];
 $switch_type_select_item['S_ROW_COUNT'] = $switch_type_select_i;
 $switch_type_select_item['S_NUM_ROWS'] = $switch_type_select_count;

?>
					<div class="form-group row mx-0">
						<label for="<?php echo isset($xdata_item['CODE_NAME']) ? $xdata_item['CODE_NAME'] : ''; ?>" class="col-12 col-lg-6 px-0"><?php echo isset($xdata_item['NAME']) ? $xdata_item['NAME'] : ''; ?></label>
						<div class="col-12 col-lg-6 px-0">
							<select class="form-control" name="<?php echo isset($xdata_item['CODE_NAME']) ? $xdata_item['CODE_NAME'] : ''; ?>" id="<?php echo isset($xdata_item['CODE_NAME']) ? $xdata_item['CODE_NAME'] : ''; ?>">
        						<?php

$options_count = ( isset($switch_type_select_item['options.']) ) ? sizeof($switch_type_select_item['options.']) : 0;
for ($options_i = 0; $options_i < $options_count; $options_i++)
{
 $options_item = &$switch_type_select_item['options.'][$options_i];
 $options_item['S_ROW_COUNT'] = $options_i;
 $options_item['S_NUM_ROWS'] = $options_count;

?>
        						<option value="<?php echo isset($options_item['OPTION']) ? $options_item['OPTION'] : ''; ?>" <?php echo isset($options_item['SELECTED']) ? $options_item['SELECTED'] : ''; ?>><?php echo isset($options_item['OPTION']) ? $options_item['OPTION'] : ''; ?></option>
        						<?php

} // END options

if(isset($options_item)) { unset($options_item); } 

?>
      						</select>
							<small id="<?php echo isset($xdata_item['CODE_NAME']) ? $xdata_item['CODE_NAME'] : ''; ?>HelpBlock" class="form-text text-muted"><?php echo isset($xdata_item['DESCRIPTION']) ? $xdata_item['DESCRIPTION'] : ''; ?></small>
						</div>
					</div>
					<?php

} // END switch_type_select

if(isset($switch_type_select_item)) { unset($switch_type_select_item); } 

?>

					<?php

$switch_type_radio_count = ( isset($xdata_item['switch_type_radio.']) ) ? sizeof($xdata_item['switch_type_radio.']) : 0;
for ($switch_type_radio_i = 0; $switch_type_radio_i < $switch_type_radio_count; $switch_type_radio_i++)
{
 $switch_type_radio_item = &$xdata_item['switch_type_radio.'][$switch_type_radio_i];
 $switch_type_radio_item['S_ROW_COUNT'] = $switch_type_radio_i;
 $switch_type_radio_item['S_NUM_ROWS'] = $switch_type_radio_count;

?>
					<div class="form-group row mx-0">
						<label for="<?php echo isset($xdata_item['CODE_NAME']) ? $xdata_item['CODE_NAME'] : ''; ?>" class="col-12 col-lg-6 px-0"><?php echo isset($xdata_item['NAME']) ? $xdata_item['NAME'] : ''; ?></label>
						<div class="col-12 col-lg-6 px-0">
							<?php

$options_count = ( isset($switch_type_radio_item['options.']) ) ? sizeof($switch_type_radio_item['options.']) : 0;
for ($options_i = 0; $options_i < $options_count; $options_i++)
{
 $options_item = &$switch_type_radio_item['options.'][$options_i];
 $options_item['S_ROW_COUNT'] = $options_i;
 $options_item['S_NUM_ROWS'] = $options_count;

?>
							<input class="form-check-input" type="radio" name="<?php echo isset($xdata_item['CODE_NAME']) ? $xdata_item['CODE_NAME'] : ''; ?>" id="<?php echo isset($xdata_item['CODE_NAME']) ? $xdata_item['CODE_NAME'] : ''; ?>" value="<?php echo isset($options_item['OPTION']) ? $options_item['OPTION'] : ''; ?>" <?php echo isset($options_item['CHECKED']) ? $options_item['CHECKED'] : ''; ?> />
							<label for="<?php echo isset($xdata_item['CODE_NAME']) ? $xdata_item['CODE_NAME'] : ''; ?>"><?php echo isset($options_item['OPTION']) ? $options_item['OPTION'] : ''; ?></label><br />
							<?php

} // END options

if(isset($options_item)) { unset($options_item); } 

?>
							<small id="<?php echo isset($xdata_item['CODE_NAME']) ? $xdata_item['CODE_NAME'] : ''; ?>HelpBlock" class="form-text text-muted"><?php echo isset($xdata_item['DESCRIPTION']) ? $xdata_item['DESCRIPTION'] : ''; ?></small>
						</div>
					</div>
					<?php

} // END switch_type_radio

if(isset($switch_type_radio_item)) { unset($switch_type_radio_item); } 

?>
					<?php

} // END xdata

if(isset($xdata_item)) { unset($xdata_item); } 

?>

				</div>

				<div class="tab-pane fade" id="preferences" role="tabpanel" aria-labelledby="preferences-tab">

					<!-- glance options will go here -->

					<div class="form-group row mx-0">
						<label for="hide_images" class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_HIDE_IMAGES']) ? $this->vars['L_HIDE_IMAGES'] : $this->lang('L_HIDE_IMAGES'); ?></label>
						<div class="col-12 col-lg-6 px-0">
							<select class="form-control" name="hide_images" id="hide_images">
								<option value="1"<?php echo isset($this->vars['HIDE_IMAGES_YES_SELECTED']) ? $this->vars['HIDE_IMAGES_YES_SELECTED'] : $this->lang('HIDE_IMAGES_YES_SELECTED'); ?>><?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?></option>
								<option value="0"<?php echo isset($this->vars['HIDE_IMAGES_NO_SELECTED']) ? $this->vars['HIDE_IMAGES_NO_SELECTED'] : $this->lang('HIDE_IMAGES_NO_SELECTED'); ?>><?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></option>
							</select>
						</div>
					</div>

					<div class="form-group row mx-0">
						<label for="viewemail" class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_PUBLIC_VIEW_EMAIL']) ? $this->vars['L_PUBLIC_VIEW_EMAIL'] : $this->lang('L_PUBLIC_VIEW_EMAIL'); ?></label>
						<div class="col-12 col-lg-6 px-0">
							<select class="form-control" name="viewemail" id="viewemail">
								<option value="1"<?php echo isset($this->vars['VIEW_EMAIL_YES_SELECTED']) ? $this->vars['VIEW_EMAIL_YES_SELECTED'] : $this->lang('VIEW_EMAIL_YES_SELECTED'); ?>><?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?></option>
								<option value="0"<?php echo isset($this->vars['VIEW_EMAIL_NO_SELECTED']) ? $this->vars['VIEW_EMAIL_NO_SELECTED'] : $this->lang('VIEW_EMAIL_NO_SELECTED'); ?>><?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></option>
							</select>
						</div>
					</div>

					<div class="form-group row mx-0">
						<label for="hideonline" class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_HIDE_USER']) ? $this->vars['L_HIDE_USER'] : $this->lang('L_HIDE_USER'); ?></label>
						<div class="col-12 col-lg-6 px-0">
							<select class="form-control" name="hideonline" id="hideonline">
								<option value="1"<?php echo isset($this->vars['HIDE_USER_YES_SELECTED']) ? $this->vars['HIDE_USER_YES_SELECTED'] : $this->lang('HIDE_USER_YES_SELECTED'); ?>><?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?></option>
								<option value="0"<?php echo isset($this->vars['HIDE_USER_NO_SELECTED']) ? $this->vars['HIDE_USER_NO_SELECTED'] : $this->lang('HIDE_USER_NO_SELECTED'); ?>><?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></option>
							</select>
						</div>
					</div>

					<div class="form-group row mx-0">
						<label for="birthday_display" class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_BIRTHDAY_DISPLAY']) ? $this->vars['L_BIRTHDAY_DISPLAY'] : $this->lang('L_BIRTHDAY_DISPLAY'); ?></label>
						<div class="col-12 col-lg-6 px-0">
							<select class="form-control" name="birthday_display" id="birthday_display">
								<option value="<?php echo isset($this->vars['BIRTHDAY_ALL']) ? $this->vars['BIRTHDAY_ALL'] : $this->lang('BIRTHDAY_ALL'); ?>"<?php echo isset($this->vars['BIRTHDAY_ALL_SELECTED']) ? $this->vars['BIRTHDAY_ALL_SELECTED'] : $this->lang('BIRTHDAY_ALL_SELECTED'); ?>><?php echo isset($this->vars['L_BIRTHDAY_ALL']) ? $this->vars['L_BIRTHDAY_ALL'] : $this->lang('L_BIRTHDAY_ALL'); ?></option>
								<option value="<?php echo isset($this->vars['BIRTHDAY_DATE']) ? $this->vars['BIRTHDAY_DATE'] : $this->lang('BIRTHDAY_DATE'); ?>"<?php echo isset($this->vars['BIRTHDAY_DATE_SELECTED']) ? $this->vars['BIRTHDAY_DATE_SELECTED'] : $this->lang('BIRTHDAY_DATE_SELECTED'); ?>><?php echo isset($this->vars['L_BIRTHDAY_YEAR']) ? $this->vars['L_BIRTHDAY_YEAR'] : $this->lang('L_BIRTHDAY_YEAR'); ?></option>
								<option value="<?php echo isset($this->vars['BIRTHDAY_AGE']) ? $this->vars['BIRTHDAY_AGE'] : $this->lang('BIRTHDAY_AGE'); ?>"<?php echo isset($this->vars['BIRTHDAY_AGE_SELECTED']) ? $this->vars['BIRTHDAY_AGE_SELECTED'] : $this->lang('BIRTHDAY_AGE_SELECTED'); ?>><?php echo isset($this->vars['L_BIRTHDAY_AGE']) ? $this->vars['L_BIRTHDAY_AGE'] : $this->lang('L_BIRTHDAY_AGE'); ?></option>
								<option value="<?php echo isset($this->vars['BIRTHDAY_NONE']) ? $this->vars['BIRTHDAY_NONE'] : $this->lang('BIRTHDAY_NONE'); ?>"<?php echo isset($this->vars['BIRTHDAY_NONE_SELECTED']) ? $this->vars['BIRTHDAY_NONE_SELECTED'] : $this->lang('BIRTHDAY_NONE_SELECTED'); ?>><?php echo isset($this->vars['L_BIRTHDAY_NONE']) ? $this->vars['L_BIRTHDAY_NONE'] : $this->lang('L_BIRTHDAY_NONE'); ?></option>
							</select>
						</div>
					</div>

					<?php

$birthdays_greeting_count = ( isset($this->_tpldata['birthdays_greeting.']) ) ?  sizeof($this->_tpldata['birthdays_greeting.']) : 0;
for ($birthdays_greeting_i = 0; $birthdays_greeting_i < $birthdays_greeting_count; $birthdays_greeting_i++)
{
 $birthdays_greeting_item = &$this->_tpldata['birthdays_greeting.'][$birthdays_greeting_i];
 $birthdays_greeting_item['S_ROW_COUNT'] = $birthdays_greeting_i;
 $birthdays_greeting_item['S_NUM_ROWS'] = $birthdays_greeting_count;

?>

					<?php

} // END birthdays_greeting

if(isset($birthdays_greeting_item)) { unset($birthdays_greeting_item); } 

?>

					<div class="form-group row mx-0">
						<label for="notifyreply" class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_NOTIFY_ON_REPLY']) ? $this->vars['L_NOTIFY_ON_REPLY'] : $this->lang('L_NOTIFY_ON_REPLY'); ?></label>
						<div class="col-12 col-lg-6 px-0">
							<select class="form-control" name="notifyreply" id="notifyreply">
								<option value="1"<?php echo isset($this->vars['NOTIFY_REPLY_YES_SELECTED']) ? $this->vars['NOTIFY_REPLY_YES_SELECTED'] : $this->lang('NOTIFY_REPLY_YES_SELECTED'); ?>><?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?></option>
								<option value="0"<?php echo isset($this->vars['NOTIFY_REPLY_NO_SELECTED']) ? $this->vars['NOTIFY_REPLY_NO_SELECTED'] : $this->lang('NOTIFY_REPLY_NO_SELECTED'); ?>><?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></option>
							</select>
							<small id="notifyReplyHelpBlock" class="form-text text-muted"><?php echo isset($this->vars['L_NOTIFY_ON_REPLY_EXPLAIN']) ? $this->vars['L_NOTIFY_ON_REPLY_EXPLAIN'] : $this->lang('L_NOTIFY_ON_REPLY_EXPLAIN'); ?></small>
						</div>
					</div>

					<div class="form-group row mx-0">
						<label for="notifypm" class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_NOTIFY_ON_PRIVMSG']) ? $this->vars['L_NOTIFY_ON_PRIVMSG'] : $this->lang('L_NOTIFY_ON_PRIVMSG'); ?></label>
						<div class="col-12 col-lg-6 px-0">
							<select class="form-control" name="notifypm" id="notifypm">
								<option value="1"<?php echo isset($this->vars['NOTIFY_PM_YES_SELECTED']) ? $this->vars['NOTIFY_PM_YES_SELECTED'] : $this->lang('NOTIFY_PM_YES_SELECTED'); ?>><?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?></option>
								<option value="0"<?php echo isset($this->vars['NOTIFY_PM_NO_SELECTED']) ? $this->vars['NOTIFY_PM_NO_SELECTED'] : $this->lang('NOTIFY_PM_NO_SELECTED'); ?>><?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></option>
							</select>
						</div>
					</div>

					<?php

$switch_can_disable_mass_pm_count = ( isset($this->_tpldata['switch_can_disable_mass_pm.']) ) ?  sizeof($this->_tpldata['switch_can_disable_mass_pm.']) : 0;
for ($switch_can_disable_mass_pm_i = 0; $switch_can_disable_mass_pm_i < $switch_can_disable_mass_pm_count; $switch_can_disable_mass_pm_i++)
{
 $switch_can_disable_mass_pm_item = &$this->_tpldata['switch_can_disable_mass_pm.'][$switch_can_disable_mass_pm_i];
 $switch_can_disable_mass_pm_item['S_ROW_COUNT'] = $switch_can_disable_mass_pm_i;
 $switch_can_disable_mass_pm_item['S_NUM_ROWS'] = $switch_can_disable_mass_pm_count;

?>
					<div class="form-group row mx-0">
						<label for="allow_mass_pm" class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_ENABLE_MASS_PM']) ? $this->vars['L_ENABLE_MASS_PM'] : $this->lang('L_ENABLE_MASS_PM'); ?></label>
						<div class="col-12 col-lg-6 px-0">
							<select class="form-control" name="allow_mass_pm" id="allow_mass_pm">
								<option value="4"<?php echo isset($this->vars['ALLOW_MASS_PM_SELECTED']) ? $this->vars['ALLOW_MASS_PM_SELECTED'] : $this->lang('ALLOW_MASS_PM_SELECTED'); ?>><?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?></option>
								<option value="2"<?php echo isset($this->vars['ALLOW_MASS_PM_NOTIFY_SELECTED']) ? $this->vars['ALLOW_MASS_PM_NOTIFY_SELECTED'] : $this->lang('ALLOW_MASS_PM_NOTIFY_SELECTED'); ?>><?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></option>
								<option value="0"<?php echo isset($this->vars['DISABLE_MASS_PM_SELECTED']) ? $this->vars['DISABLE_MASS_PM_SELECTED'] : $this->lang('DISABLE_MASS_PM_SELECTED'); ?>><?php echo isset($this->vars['L_NO_MASS_PM']) ? $this->vars['L_NO_MASS_PM'] : $this->lang('L_NO_MASS_PM'); ?></option>
							</select>
							<small id="allowMassHelpBlock" class="form-text text-muted"><?php echo isset($this->vars['L_ENABLE_MASS_PM_EXPLAIN']) ? $this->vars['L_ENABLE_MASS_PM_EXPLAIN'] : $this->lang('L_ENABLE_MASS_PM_EXPLAIN'); ?></small>
						</div>
					</div>
					<?php

} // END switch_can_disable_mass_pm

if(isset($switch_can_disable_mass_pm_item)) { unset($switch_can_disable_mass_pm_item); } 

?>
					<?php

$switch_can_not_disable_mass_pm_count = ( isset($this->_tpldata['switch_can_not_disable_mass_pm.']) ) ?  sizeof($this->_tpldata['switch_can_not_disable_mass_pm.']) : 0;
for ($switch_can_not_disable_mass_pm_i = 0; $switch_can_not_disable_mass_pm_i < $switch_can_not_disable_mass_pm_count; $switch_can_not_disable_mass_pm_i++)
{
 $switch_can_not_disable_mass_pm_item = &$this->_tpldata['switch_can_not_disable_mass_pm.'][$switch_can_not_disable_mass_pm_i];
 $switch_can_not_disable_mass_pm_item['S_ROW_COUNT'] = $switch_can_not_disable_mass_pm_i;
 $switch_can_not_disable_mass_pm_item['S_NUM_ROWS'] = $switch_can_not_disable_mass_pm_count;

?>
					<div class="form-group row mx-0">
						<label for="allow_mass_pm" class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_ENABLE_MASS_PM']) ? $this->vars['L_ENABLE_MASS_PM'] : $this->lang('L_ENABLE_MASS_PM'); ?></label>
						<div class="col-12 col-lg-6 px-0">
							<select class="form-control" name="allow_mass_pm" id="allow_mass_pm">
								<option value="4"<?php echo isset($this->vars['ALLOW_MASS_PM_SELECTED']) ? $this->vars['ALLOW_MASS_PM_SELECTED'] : $this->lang('ALLOW_MASS_PM_SELECTED'); ?>><?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?></option>
								<option value="2"<?php echo isset($this->vars['ALLOW_MASS_PM_NOTIFY_SELECTED']) ? $this->vars['ALLOW_MASS_PM_NOTIFY_SELECTED'] : $this->lang('ALLOW_MASS_PM_NOTIFY_SELECTED'); ?>><?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></option>
							</select>
							<small id="allowMassHelpBlock" class="form-text text-muted"><?php echo isset($this->vars['L_ENABLE_MASS_PM_EXPLAIN']) ? $this->vars['L_ENABLE_MASS_PM_EXPLAIN'] : $this->lang('L_ENABLE_MASS_PM_EXPLAIN'); ?></small>
						</div>
					</div>
					<?php

} // END switch_can_not_disable_mass_pm

if(isset($switch_can_not_disable_mass_pm_item)) { unset($switch_can_not_disable_mass_pm_item); } 

?>

					<div class="form-group row mx-0">
						<label for="attachsig" class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_ALWAYS_ADD_SIGNATURE']) ? $this->vars['L_ALWAYS_ADD_SIGNATURE'] : $this->lang('L_ALWAYS_ADD_SIGNATURE'); ?></label>
						<div class="col-12 col-lg-6 px-0">
							<select class="form-control" name="attachsig" id="attachsig">
								<option value="1"<?php echo isset($this->vars['ALWAYS_ADD_SIGNATURE_YES_SELECTED']) ? $this->vars['ALWAYS_ADD_SIGNATURE_YES_SELECTED'] : $this->lang('ALWAYS_ADD_SIGNATURE_YES_SELECTED'); ?>><?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?></option>
								<option value="0"<?php echo isset($this->vars['ALWAYS_ADD_SIGNATURE_NO_SELECTED']) ? $this->vars['ALWAYS_ADD_SIGNATURE_NO_SELECTED'] : $this->lang('ALWAYS_ADD_SIGNATURE_NO_SELECTED'); ?>><?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></option>
							</select>
						</div>
					</div>

					<div class="form-group row mx-0">
						<label for="allowbbcode" class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_ALWAYS_ALLOW_BBCODE']) ? $this->vars['L_ALWAYS_ALLOW_BBCODE'] : $this->lang('L_ALWAYS_ALLOW_BBCODE'); ?></label>
						<div class="col-12 col-lg-6 px-0">
							<select class="form-control" name="allowbbcode" id="allowbbcode">
								<option value="1"<?php echo isset($this->vars['ALWAYS_ALLOW_BBCODE_YES_SELECTED']) ? $this->vars['ALWAYS_ALLOW_BBCODE_YES_SELECTED'] : $this->lang('ALWAYS_ALLOW_BBCODE_YES_SELECTED'); ?>><?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?></option>
								<option value="0"<?php echo isset($this->vars['ALWAYS_ALLOW_BBCODE_NO_SELECTED']) ? $this->vars['ALWAYS_ALLOW_BBCODE_NO_SELECTED'] : $this->lang('ALWAYS_ALLOW_BBCODE_NO_SELECTED'); ?>><?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></option>
							</select>
						</div>
					</div>

					<div class="form-group row mx-0">
						<label for="allowhtml" class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_ALWAYS_ALLOW_HTML']) ? $this->vars['L_ALWAYS_ALLOW_HTML'] : $this->lang('L_ALWAYS_ALLOW_HTML'); ?></label>
						<div class="col-12 col-lg-6 px-0">
							<select class="form-control" name="allowhtml" id="allowhtml">
								<option value="1"<?php echo isset($this->vars['ALWAYS_ALLOW_HTML_YES_SELECTED']) ? $this->vars['ALWAYS_ALLOW_HTML_YES_SELECTED'] : $this->lang('ALWAYS_ALLOW_HTML_YES_SELECTED'); ?>><?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?></option>
								<option value="0"<?php echo isset($this->vars['ALWAYS_ALLOW_HTML_NO_SELECTED']) ? $this->vars['ALWAYS_ALLOW_HTML_NO_SELECTED'] : $this->lang('ALWAYS_ALLOW_HTML_NO_SELECTED'); ?>><?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></option>
							</select>
						</div>
					</div>

					<div class="form-group row mx-0">
						<label for="allowsmilies" class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_ALWAYS_ALLOW_SMILIES']) ? $this->vars['L_ALWAYS_ALLOW_SMILIES'] : $this->lang('L_ALWAYS_ALLOW_SMILIES'); ?></label>
						<div class="col-12 col-lg-6 px-0">
							<select class="form-control" name="allowsmilies" id="allowsmilies">
								<option value="1"<?php echo isset($this->vars['ALWAYS_ALLOW_SMILIES_YES_SELECTED']) ? $this->vars['ALWAYS_ALLOW_SMILIES_YES_SELECTED'] : $this->lang('ALWAYS_ALLOW_SMILIES_YES_SELECTED'); ?>><?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?></option>
								<option value="0"<?php echo isset($this->vars['ALWAYS_ALLOW_SMILIES_NO_SELECTED']) ? $this->vars['ALWAYS_ALLOW_SMILIES_NO_SELECTED'] : $this->lang('ALWAYS_ALLOW_SMILIES_NO_SELECTED'); ?>><?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></option>
							</select>
						</div>
					</div>

					<div class="form-group row mx-0">
						<label for="showavatars" class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_SHOW_AVATARS']) ? $this->vars['L_SHOW_AVATARS'] : $this->lang('L_SHOW_AVATARS'); ?></label>
						<div class="col-12 col-lg-6 px-0">
							<select class="form-control" name="showavatars" id="showavatars">
								<option value="1"<?php echo isset($this->vars['SHOW_AVATARS_YES_SELECTED']) ? $this->vars['SHOW_AVATARS_YES_SELECTED'] : $this->lang('SHOW_AVATARS_YES_SELECTED'); ?>><?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?></option>
								<option value="0"<?php echo isset($this->vars['SHOW_AVATARS_NO_SELECTED']) ? $this->vars['SHOW_AVATARS_NO_SELECTED'] : $this->lang('SHOW_AVATARS_NO_SELECTED'); ?>><?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></option>
							</select>
						</div>
					</div>

					<div class="form-group row mx-0">
						<label for="showsignatures" class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_SHOW_SIGNATURES']) ? $this->vars['L_SHOW_SIGNATURES'] : $this->lang('L_SHOW_SIGNATURES'); ?></label>
						<div class="col-12 col-lg-6 px-0">
							<select class="form-control" name="showsignatures" id="showsignatures">
								<option value="1"<?php echo isset($this->vars['SHOW_SIGNATURES_YES_SELECTED']) ? $this->vars['SHOW_SIGNATURES_YES_SELECTED'] : $this->lang('SHOW_SIGNATURES_YES_SELECTED'); ?>><?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?></option>
								<option value="0"<?php echo isset($this->vars['SHOW_SIGNATURES_NO_SELECTED']) ? $this->vars['SHOW_SIGNATURES_NO_SELECTED'] : $this->lang('SHOW_SIGNATURES_NO_SELECTED'); ?>><?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></option>
							</select>
						</div>
					</div>

					<div class="form-group row mx-0">
						<label for="newsletter" class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_NEWSLETTER']) ? $this->vars['L_NEWSLETTER'] : $this->lang('L_NEWSLETTER'); ?></label>
						<div class="col-12 col-lg-6 px-0">
							<select class="form-control" name="newsletter" id="newsletter">
								<option value="1"<?php echo isset($this->vars['NEWSLETTER_YES_SELECTED']) ? $this->vars['NEWSLETTER_YES_SELECTED'] : $this->lang('NEWSLETTER_YES_SELECTED'); ?>><?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?></option>
								<option value="0"<?php echo isset($this->vars['NEWSLETTER_NO_SELECTED']) ? $this->vars['NEWSLETTER_NO_SELECTED'] : $this->lang('NEWSLETTER_NO_SELECTED'); ?>><?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></option>
							</select>
						</div>
					</div>

					<?php

$force_word_wrapping_count = ( isset($this->_tpldata['force_word_wrapping.']) ) ?  sizeof($this->_tpldata['force_word_wrapping.']) : 0;
for ($force_word_wrapping_i = 0; $force_word_wrapping_i < $force_word_wrapping_count; $force_word_wrapping_i++)
{
 $force_word_wrapping_item = &$this->_tpldata['force_word_wrapping.'][$force_word_wrapping_i];
 $force_word_wrapping_item['S_ROW_COUNT'] = $force_word_wrapping_i;
 $force_word_wrapping_item['S_NUM_ROWS'] = $force_word_wrapping_count;

?>
					<div class="form-group row mx-0">
						<label for="user_wordwrap" class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_WORD_WRAP']) ? $this->vars['L_WORD_WRAP'] : $this->lang('L_WORD_WRAP'); ?></label>
						<div class="col-12 col-lg-6 px-0">
							<input class="form-control" type="number" name="user_wordwrap" id="user_wordwrap" min="50" max="99" value="<?php echo isset($this->vars['WRAP_ROW']) ? $this->vars['WRAP_ROW'] : $this->lang('WRAP_ROW'); ?>">
							<small id="wordWrapHelpBlock" class="form-text text-muted"><?php echo isset($this->vars['L_WORD_WRAP_EXPLAIN']) ? $this->vars['L_WORD_WRAP_EXPLAIN'] : $this->lang('L_WORD_WRAP_EXPLAIN'); ?></small>
						</div>
					</div>
					<?php

} // END force_word_wrapping

if(isset($force_word_wrapping_item)) { unset($force_word_wrapping_item); } 

?>

					<div class="form-group row mx-0">
						<label for="language" class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_BOARD_LANGUAGE']) ? $this->vars['L_BOARD_LANGUAGE'] : $this->lang('L_BOARD_LANGUAGE'); ?></label>
						<div class="col-12 col-lg-6 px-0">
							<?php echo isset($this->vars['LANGUAGE_SELECT']) ? $this->vars['LANGUAGE_SELECT'] : $this->lang('LANGUAGE_SELECT'); ?>
						</div>
					</div>

					<div class="form-group row mx-0">
						<label class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_BOARD_STYLE']) ? $this->vars['L_BOARD_STYLE'] : $this->lang('L_BOARD_STYLE'); ?></label>
						<div class="col-12 col-lg-6 px-0">
							<?php echo isset($this->vars['STYLE_SELECT']) ? $this->vars['STYLE_SELECT'] : $this->lang('STYLE_SELECT'); ?>
						</div>
					</div>

					<div class="form-group row mx-0">

						<label for="time_mode" class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_TIME_MODE']) ? $this->vars['L_TIME_MODE'] : $this->lang('L_TIME_MODE'); ?></label>
						<div class="col-12 col-lg-6 px-0">
							<select class="form-control" name="time_mode" id="time_mode">
								<optgroup label="<?php echo isset($this->vars['L_TIME_MODE_AUTO']) ? $this->vars['L_TIME_MODE_AUTO'] : $this->lang('L_TIME_MODE_AUTO'); ?>">
									<option value="6" <?php echo isset($this->vars['TIME_MODE_FULL_PC_SELECTED']) ? $this->vars['TIME_MODE_FULL_PC_SELECTED'] : $this->lang('TIME_MODE_FULL_PC_SELECTED'); ?>><?php echo isset($this->vars['L_TIME_MODE_FULL_PC']) ? $this->vars['L_TIME_MODE_FULL_PC'] : $this->lang('L_TIME_MODE_FULL_PC'); ?></option>
									<option value="4" <?php echo isset($this->vars['TIME_MODE_SERVER_PC_SELECTED']) ? $this->vars['TIME_MODE_SERVER_PC_SELECTED'] : $this->lang('TIME_MODE_SERVER_PC_SELECTED'); ?>><?php echo isset($this->vars['L_TIME_MODE_SERVER_PC']) ? $this->vars['L_TIME_MODE_SERVER_PC'] : $this->lang('L_TIME_MODE_SERVER_PC'); ?></option>
									<option value="3" <?php echo isset($this->vars['TIME_MODE_FULL_SERVER_SELECTED']) ? $this->vars['TIME_MODE_FULL_SERVER_SELECTED'] : $this->lang('TIME_MODE_FULL_SERVER_SELECTED'); ?>><?php echo isset($this->vars['L_TIME_MODE_FULL_SERVER']) ? $this->vars['L_TIME_MODE_FULL_SERVER'] : $this->lang('L_TIME_MODE_FULL_SERVER'); ?></option>
								</optgroup>
								<optgroup label="<?php echo isset($this->vars['L_TIME_MODE_DST']) ? $this->vars['L_TIME_MODE_DST'] : $this->lang('L_TIME_MODE_DST'); ?> (<?php echo isset($this->vars['L_TIME_MODE_MANUAL']) ? $this->vars['L_TIME_MODE_MANUAL'] : $this->lang('L_TIME_MODE_MANUAL'); ?>)">
									<option value="Lonestar" <?php echo isset($this->vars['TIME_MODE_MANUAL_DST_SELECTED']) ? $this->vars['TIME_MODE_MANUAL_DST_SELECTED'] : $this->lang('TIME_MODE_MANUAL_DST_SELECTED'); ?>><?php echo isset($this->vars['L_TIME_MODE_DST']) ? $this->vars['L_TIME_MODE_DST'] : $this->lang('L_TIME_MODE_DST'); ?>: <?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?><?php echo isset($this->vars['L_TIME_MODE_DST_ON']) ? $this->vars['L_TIME_MODE_DST_ON'] : $this->lang('L_TIME_MODE_DST_ON'); ?></option>
									<option value="0" <?php echo isset($this->vars['TIME_MODE_MANUAL_SELECTED']) ? $this->vars['TIME_MODE_MANUAL_SELECTED'] : $this->lang('TIME_MODE_MANUAL_SELECTED'); ?>><?php echo isset($this->vars['L_TIME_MODE_DST']) ? $this->vars['L_TIME_MODE_DST'] : $this->lang('L_TIME_MODE_DST'); ?>: <?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?><?php echo isset($this->vars['L_TIME_MODE_DST_OFF']) ? $this->vars['L_TIME_MODE_DST_OFF'] : $this->lang('L_TIME_MODE_DST_OFF'); ?></option>
									<option value="2" <?php echo isset($this->vars['TIME_MODE_SERVER_SWITCH_SELECTED']) ? $this->vars['TIME_MODE_SERVER_SWITCH_SELECTED'] : $this->lang('TIME_MODE_SERVER_SWITCH_SELECTED'); ?>><?php echo isset($this->vars['L_TIME_MODE_DST']) ? $this->vars['L_TIME_MODE_DST'] : $this->lang('L_TIME_MODE_DST'); ?>: <?php echo isset($this->vars['L_TIME_MODE_DST_SERVER']) ? $this->vars['L_TIME_MODE_DST_SERVER'] : $this->lang('L_TIME_MODE_DST_SERVER'); ?></option>
								</optgroup>
							</select>
							<small id="timeManageHelpBlock" class="form-text text-muted"><?php echo isset($this->vars['L_TIME_MODE_TEXT']) ? $this->vars['L_TIME_MODE_TEXT'] : $this->lang('L_TIME_MODE_TEXT'); ?></small>
						</div>

					</div>

					<div class="form-group row mx-0">
						<label for="dst_time_lag" class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_TIME_MODE_DST_TIME_LAG']) ? $this->vars['L_TIME_MODE_DST_TIME_LAG'] : $this->lang('L_TIME_MODE_DST_TIME_LAG'); ?></label>
						<div class="col-12 col-lg-6 px-0">
							<input class="form-control col-10 col-lg-11" type="number" name="dst_time_lag" id="dst_time_lag" min="0" max="120" value="<?php echo isset($this->vars['DST_TIME_LAG']) ? $this->vars['DST_TIME_LAG'] : $this->lang('DST_TIME_LAG'); ?>">&nbsp;<?php echo isset($this->vars['L_TIME_MODE_DST_MN']) ? $this->vars['L_TIME_MODE_DST_MN'] : $this->lang('L_TIME_MODE_DST_MN'); ?>
						</div>
					</div>

					<div class="form-group row mx-0">
						<label class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_TIME_MODE_TIMEZONE']) ? $this->vars['L_TIME_MODE_TIMEZONE'] : $this->lang('L_TIME_MODE_TIMEZONE'); ?></label>
						<div class="col-12 col-lg-6 px-0">
							<?php echo isset($this->vars['TIMEZONE_SELECT']) ? $this->vars['TIMEZONE_SELECT'] : $this->lang('TIMEZONE_SELECT'); ?>
						</div>
					</div>

					<!-- <div class="row mx-0 mb-3">
						<label class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_SHOW_QUICK_REPLY']) ? $this->vars['L_SHOW_QUICK_REPLY'] : $this->lang('L_SHOW_QUICK_REPLY'); ?></label>
						<div class="col-12 col-lg-6 px-0">
							<?php echo isset($this->vars['QUICK_REPLY_SELECT']) ? $this->vars['QUICK_REPLY_SELECT'] : $this->lang('QUICK_REPLY_SELECT'); ?>
						</div>
					</div>

					<div class="row mx-0 mb-3">
						<label class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_QUICK_REPLY_MODE']) ? $this->vars['L_QUICK_REPLY_MODE'] : $this->lang('L_QUICK_REPLY_MODE'); ?></label>
						<div class="col-12 col-lg-6 px-0">
							<input type="radio" name="quickreply_mode" value="0" <?php echo isset($this->vars['QUICK_REPLY_MODE_BASIC']) ? $this->vars['QUICK_REPLY_MODE_BASIC'] : $this->lang('QUICK_REPLY_MODE_BASIC'); ?> /><?php echo isset($this->vars['L_QUICK_REPLY_MODE_BASIC']) ? $this->vars['L_QUICK_REPLY_MODE_BASIC'] : $this->lang('L_QUICK_REPLY_MODE_BASIC'); ?>&nbsp;&nbsp;<input type="radio" name="quickreply_mode" value="1" <?php echo isset($this->vars['QUICK_REPLY_MODE_ADVANCED']) ? $this->vars['QUICK_REPLY_MODE_ADVANCED'] : $this->lang('QUICK_REPLY_MODE_ADVANCED'); ?> /><?php echo isset($this->vars['L_QUICK_REPLY_MODE_ADVANCED']) ? $this->vars['L_QUICK_REPLY_MODE_ADVANCED'] : $this->lang('L_QUICK_REPLY_MODE_ADVANCED'); ?>
						</div>
					</div>

					<div class="row mx-0 mb-3">
						<label class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_OPEN_QUICK_REPLY']) ? $this->vars['L_OPEN_QUICK_REPLY'] : $this->lang('L_OPEN_QUICK_REPLY'); ?></label>
						<div class="col-12 col-lg-6 px-0">
							<input type="radio" name="open_quickreply" value="1" <?php echo isset($this->vars['OPEN_QUICK_REPLY_YES']) ? $this->vars['OPEN_QUICK_REPLY_YES'] : $this->lang('OPEN_QUICK_REPLY_YES'); ?> /><?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?><input type="radio" name="open_quickreply" value="0" <?php echo isset($this->vars['OPEN_QUICK_REPLY_NO']) ? $this->vars['OPEN_QUICK_REPLY_NO'] : $this->lang('OPEN_QUICK_REPLY_NO'); ?> /><?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?>
						</div>
					</div> -->

					<!-- <?php echo isset($this->vars['L_SCEDITOR_PANEL']) ? $this->vars['L_SCEDITOR_PANEL'] : $this->lang('L_SCEDITOR_PANEL'); ?> -->
					<?php if ($this->vars['SCEDITOR_STATE'] == 'sceditor') {  ?>
					<div class="form-group row mx-0">
						<label class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_SCEDITOR_STATE']) ? $this->vars['L_SCEDITOR_STATE'] : $this->lang('L_SCEDITOR_STATE'); ?></label>
						<div class="col-12 col-lg-6 px-0">
							<?php echo isset($this->vars['SCEDITOR_SELECT']) ? $this->vars['SCEDITOR_SELECT'] : $this->lang('SCEDITOR_SELECT'); ?>
						</div>
					</div>
					<?php } ?>

				</div>

				<div class="tab-pane fade" id="avatar" role="tabpanel" aria-labelledby="avatar-tab">
					
					<?php

$switch_avatar_block_count = ( isset($this->_tpldata['switch_avatar_block.']) ) ?  sizeof($this->_tpldata['switch_avatar_block.']) : 0;
for ($switch_avatar_block_i = 0; $switch_avatar_block_i < $switch_avatar_block_count; $switch_avatar_block_i++)
{
 $switch_avatar_block_item = &$this->_tpldata['switch_avatar_block.'][$switch_avatar_block_i];
 $switch_avatar_block_item['S_ROW_COUNT'] = $switch_avatar_block_i;
 $switch_avatar_block_item['S_NUM_ROWS'] = $switch_avatar_block_count;

?>
					<div class="form-group row mx-0">
						<label for="dst_time_lag" class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_CURRENT_IMAGE']) ? $this->vars['L_CURRENT_IMAGE'] : $this->lang('L_CURRENT_IMAGE'); ?></label>
						<div class="col-12 col-lg-6 px-0">
							<?php echo isset($this->vars['AVATAR']) ? $this->vars['AVATAR'] : $this->lang('AVATAR'); ?>
							<small class="form-text text-muted"><?php echo isset($this->vars['L_AVATAR_EXPLAIN']) ? $this->vars['L_AVATAR_EXPLAIN'] : $this->lang('L_AVATAR_EXPLAIN'); ?></small>							
						</div>

					</div>

					<div class="form-group row mx-0">
						<label for="avatardel" class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_DELETE_AVATAR']) ? $this->vars['L_DELETE_AVATAR'] : $this->lang('L_DELETE_AVATAR'); ?></label>
						<div class="col-12 col-lg-6 px-0">
							<select class="form-control" name="avatardel" id="avatardel">
								<option value="1"><?php echo isset($this->vars['L_YES']) ? $this->vars['L_YES'] : $this->lang('L_YES'); ?></option>
								<option value="0" selected><?php echo isset($this->vars['L_NO']) ? $this->vars['L_NO'] : $this->lang('L_NO'); ?></option>
							</select>							
						</div>
					</div>

					<?php

$switch_avatar_local_upload_count = ( isset($switch_avatar_block_item['switch_avatar_local_upload.']) ) ? sizeof($switch_avatar_block_item['switch_avatar_local_upload.']) : 0;
for ($switch_avatar_local_upload_i = 0; $switch_avatar_local_upload_i < $switch_avatar_local_upload_count; $switch_avatar_local_upload_i++)
{
 $switch_avatar_local_upload_item = &$switch_avatar_block_item['switch_avatar_local_upload.'][$switch_avatar_local_upload_i];
 $switch_avatar_local_upload_item['S_ROW_COUNT'] = $switch_avatar_local_upload_i;
 $switch_avatar_local_upload_item['S_NUM_ROWS'] = $switch_avatar_local_upload_count;

?>
					<div class="form-group row mx-0">
						<label for="avatar-upload" class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_UPLOAD_AVATAR_FILE']) ? $this->vars['L_UPLOAD_AVATAR_FILE'] : $this->lang('L_UPLOAD_AVATAR_FILE'); ?></label>
						<div class="col-12 col-lg-6 px-0">
							<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo isset($this->vars['AVATAR_SIZE']) ? $this->vars['AVATAR_SIZE'] : $this->lang('AVATAR_SIZE'); ?>" />
							<input class="form-control-file px-0" type="file" name="avatar" id="avatar-upload">
						</div>
					</div>
					<?php

} // END switch_avatar_local_upload

if(isset($switch_avatar_local_upload_item)) { unset($switch_avatar_local_upload_item); } 

?>

					<?php

$switch_avatar_remote_upload_count = ( isset($switch_avatar_block_item['switch_avatar_remote_upload.']) ) ? sizeof($switch_avatar_block_item['switch_avatar_remote_upload.']) : 0;
for ($switch_avatar_remote_upload_i = 0; $switch_avatar_remote_upload_i < $switch_avatar_remote_upload_count; $switch_avatar_remote_upload_i++)
{
 $switch_avatar_remote_upload_item = &$switch_avatar_block_item['switch_avatar_remote_upload.'][$switch_avatar_remote_upload_i];
 $switch_avatar_remote_upload_item['S_ROW_COUNT'] = $switch_avatar_remote_upload_i;
 $switch_avatar_remote_upload_item['S_NUM_ROWS'] = $switch_avatar_remote_upload_count;

?>
					<div class="form-group row mx-0">
						<label for="avatarurl" class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_UPLOAD_AVATAR_URL']) ? $this->vars['L_UPLOAD_AVATAR_URL'] : $this->lang('L_UPLOAD_AVATAR_URL'); ?></label>
						<div class="col-12 col-lg-6 px-0">
							<input class="form-control" type="text" name="avatarurl" id="avatarurl">
							<small id="avatarURLHelpBlock" class="form-text text-muted"><?php echo isset($this->vars['L_UPLOAD_AVATAR_URL_EXPLAIN']) ? $this->vars['L_UPLOAD_AVATAR_URL_EXPLAIN'] : $this->lang('L_UPLOAD_AVATAR_URL_EXPLAIN'); ?></small>
						</div>
					</div>
					<?php

} // END switch_avatar_remote_upload

if(isset($switch_avatar_remote_upload_item)) { unset($switch_avatar_remote_upload_item); } 

?>

					<?php

$switch_avatar_remote_link_count = ( isset($switch_avatar_block_item['switch_avatar_remote_link.']) ) ? sizeof($switch_avatar_block_item['switch_avatar_remote_link.']) : 0;
for ($switch_avatar_remote_link_i = 0; $switch_avatar_remote_link_i < $switch_avatar_remote_link_count; $switch_avatar_remote_link_i++)
{
 $switch_avatar_remote_link_item = &$switch_avatar_block_item['switch_avatar_remote_link.'][$switch_avatar_remote_link_i];
 $switch_avatar_remote_link_item['S_ROW_COUNT'] = $switch_avatar_remote_link_i;
 $switch_avatar_remote_link_item['S_NUM_ROWS'] = $switch_avatar_remote_link_count;

?>
					<div class="form-group row mx-0">
						<label for="avatarremoteurl" class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_LINK_REMOTE_AVATAR']) ? $this->vars['L_LINK_REMOTE_AVATAR'] : $this->lang('L_LINK_REMOTE_AVATAR'); ?></label>
						<div class="col-12 col-lg-6 px-0">
							<input class="form-control" type="text" name="avatarremoteurl" id="avatarremoteurl">
							<small id="avatarRemoteURLHelpBlock" class="form-text text-muted"><?php echo isset($this->vars['L_LINK_REMOTE_AVATAR_EXPLAIN']) ? $this->vars['L_LINK_REMOTE_AVATAR_EXPLAIN'] : $this->lang('L_LINK_REMOTE_AVATAR_EXPLAIN'); ?></small>
						</div>
					</div>
					<?php

} // END switch_avatar_remote_link

if(isset($switch_avatar_remote_link_item)) { unset($switch_avatar_remote_link_item); } 

?>

					<?php

$switch_avatar_local_gallery_count = ( isset($switch_avatar_block_item['switch_avatar_local_gallery.']) ) ? sizeof($switch_avatar_block_item['switch_avatar_local_gallery.']) : 0;
for ($switch_avatar_local_gallery_i = 0; $switch_avatar_local_gallery_i < $switch_avatar_local_gallery_count; $switch_avatar_local_gallery_i++)
{
 $switch_avatar_local_gallery_item = &$switch_avatar_block_item['switch_avatar_local_gallery.'][$switch_avatar_local_gallery_i];
 $switch_avatar_local_gallery_item['S_ROW_COUNT'] = $switch_avatar_local_gallery_i;
 $switch_avatar_local_gallery_item['S_NUM_ROWS'] = $switch_avatar_local_gallery_count;

?>
					<div class="form-group row mx-0">
						<label for="avatargallery" class="col-12 col-lg-6 px-0"><?php echo isset($this->vars['L_AVATAR_GALLERY']) ? $this->vars['L_AVATAR_GALLERY'] : $this->lang('L_AVATAR_GALLERY'); ?></label>
						<div class="col-12 col-lg-6 px-0">
							<input class="col-md-auto btn btn-dark" type="submit" name="avatargallery" id="avatargallery" value="<?php echo isset($this->vars['L_SHOW_GALLERY']) ? $this->vars['L_SHOW_GALLERY'] : $this->lang('L_SHOW_GALLERY'); ?>">
						</div>
					</div>
					<?php

} // END switch_avatar_local_gallery

if(isset($switch_avatar_local_gallery_item)) { unset($switch_avatar_local_gallery_item); } 

?>

					<?php

} // END switch_avatar_block

if(isset($switch_avatar_block_item)) { unset($switch_avatar_block_item); } 

?>

				</div>

			</div>
			<?php echo isset($this->vars['S_HIDDEN_FIELDS']) ? $this->vars['S_HIDDEN_FIELDS'] : $this->lang('S_HIDDEN_FIELDS'); ?>
			<div class="form-group row mx-0 mt-3 justify-content-center">
				<input class="col-md-auto btn btn-dark mr-lg-1 mb-2 mb-lg-0" type="submit" name="submit" value="<?php echo isset($this->vars['L_SUBMIT']) ? $this->vars['L_SUBMIT'] : $this->lang('L_SUBMIT'); ?>" /><input class="col-md-auto btn btn-dark" type="reset" value="<?php echo isset($this->vars['L_RESET']) ? $this->vars['L_RESET'] : $this->lang('L_RESET'); ?>" name="reset" />
			</div>
			</form>

		<!-- </div> -->

	</div>

</section>