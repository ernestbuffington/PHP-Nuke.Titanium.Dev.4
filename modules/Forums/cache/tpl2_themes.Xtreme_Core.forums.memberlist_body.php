<?php

// eXtreme Styles mod cache. Generated on Mon, 17 May 2021 21:33:52 +0000 (time=1621287232)

?><div align="center">

<table width="98%" style="background-color:none; height:100%;" class="viewforum" align="center" border="5" cellpadding="15" cellspacing="20" dir="ltr" id="viewforum">
<tbody>
<tr>
<td align="center">

<form method="post" action="<?php echo isset($this->vars['S_MODE_ACTION']) ? $this->vars['S_MODE_ACTION'] : $this->lang('S_MODE_ACTION'); ?>" name="post">
<table style="width: 100%;" border="0" cellpadding="4" cellspacing="1" class="forumline">
  <tr>
    <td class="catHead">
      <table style="width: 100%;" border="0" cellpadding="4" cellspacing="1" class="forumline">
        <tr>
          <td class="row1" style="text-align: center; width: 33%;"><?php echo isset($this->vars['L_SELECT_SORT_METHOD']) ? $this->vars['L_SELECT_SORT_METHOD'] : $this->lang('L_SELECT_SORT_METHOD'); ?>&nbsp;<?php echo isset($this->vars['S_MODE_SELECT']) ? $this->vars['S_MODE_SELECT'] : $this->lang('S_MODE_SELECT'); ?>&nbsp;<?php echo isset($this->vars['S_ORDER_SELECT']) ? $this->vars['S_ORDER_SELECT'] : $this->lang('S_ORDER_SELECT'); ?>&nbsp;<input type="submit" name="submit" value="<?php echo isset($this->vars['L_GO']) ? $this->vars['L_GO'] : $this->lang('L_GO'); ?>" style="cursor: pointer;" class="liteoption" /></td>
          <td class="catHead" style="text-align: center; width: 33.3%;"><h1><?php echo isset($this->vars['L_PAGE_TITLE']) ? $this->vars['L_PAGE_TITLE'] : $this->lang('L_PAGE_TITLE'); ?></h1></td>
          <td class="row1" style="width: 33%;" align="center">
          <span>
            <span class="tooltip icon-sprite icon-info" style="float: left; margin-top: 2px;" title="<?php echo isset($this->vars['U_SEARCH_EXPLAIN']) ? $this->vars['U_SEARCH_EXPLAIN'] : $this->lang('U_SEARCH_EXPLAIN'); ?>"></span><input type="text" class="post" name="username" maxlength="25" size="20" tabindex="1" value="" />&nbsp;<input type="submit" name="submituser" value="<?php echo isset($this->vars['L_LOOK_UP']) ? $this->vars['L_LOOK_UP'] : $this->lang('L_LOOK_UP'); ?>" style="cursor: pointer;" class="mainoption" /></td>
          </span>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td class="row1" style="width: 100%;">
      <table style="width:100%;" border="0" cellpadding="0" cellspacing="1" class="forumline">
        <tr>
          <?php

$alphanumsearch_count = ( isset($this->_tpldata['alphanumsearch.']) ) ?  sizeof($this->_tpldata['alphanumsearch.']) : 0;
for ($alphanumsearch_i = 0; $alphanumsearch_i < $alphanumsearch_count; $alphanumsearch_i++)
{
 $alphanumsearch_item = &$this->_tpldata['alphanumsearch.'][$alphanumsearch_i];
 $alphanumsearch_item['S_ROW_COUNT'] = $alphanumsearch_i;
 $alphanumsearch_item['S_NUM_ROWS'] = $alphanumsearch_count;

?>
          <td class="row3" style="text-align: center; width: <?php echo isset($alphanumsearch_item['SEARCH_SIZE']) ? $alphanumsearch_item['SEARCH_SIZE'] : ''; ?>;"><a href="<?php echo isset($alphanumsearch_item['SEARCH_LINK']) ? $alphanumsearch_item['SEARCH_LINK'] : ''; ?>"><?php echo isset($alphanumsearch_item['SEARCH_TERM']) ? $alphanumsearch_item['SEARCH_TERM'] : ''; ?></a></td>
          <?php

} // END alphanumsearch

if(isset($alphanumsearch_item)) { unset($alphanumsearch_item); } 

?>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td class="row3" style="width: 100%;">
      <table style="width:100%;" border="0" cellpadding="0" cellspacing="0" class="forumline">
        <tr>
          <td valign="top">
            <table style="width:100%;" border="0" cellpadding="0" cellspacing="1" class="forumline">
              <tr>
                <td class="catHead acenter" style="width: 25px;">#</td>
                <td class="catHead acenter" style="width: 125px;" colspan="2"><?php echo isset($this->vars['L_USERNAME']) ? $this->vars['L_USERNAME'] : $this->lang('L_USERNAME'); ?></td>
                <td class="catHead acenter" style="width: 149px;"><?php echo isset($this->vars['L_FROM']) ? $this->vars['L_FROM'] : $this->lang('L_FROM'); ?></td>
                <td class="catHead acenter" style="width: 35px;"><?php echo isset($this->vars['L_AGE']) ? $this->vars['L_AGE'] : $this->lang('L_AGE'); ?></td>                
                <td class="catHead acenter" style="width: 35px;"><?php echo isset($this->vars['L_POSTS']) ? $this->vars['L_POSTS'] : $this->lang('L_POSTS'); ?></td>
                <td class="catHead acenter" style="width: 35px;"><?php echo isset($this->vars['L_JOINED']) ? $this->vars['L_JOINED'] : $this->lang('L_JOINED'); ?></td>
                <td class="catHead acenter" style="width: 35px;"><?php echo isset($this->vars['L_LAST_VISIT']) ? $this->vars['L_LAST_VISIT'] : $this->lang('L_LAST_VISIT'); ?></td>
                <td class="catHead acenter" style="width: 35px;"><?php echo isset($this->vars['L_ONLINE_STATUS']) ? $this->vars['L_ONLINE_STATUS'] : $this->lang('L_ONLINE_STATUS'); ?></td>
              </tr>
              <?php

$no_username_count = ( isset($this->_tpldata['no_username.']) ) ?  sizeof($this->_tpldata['no_username.']) : 0;
for ($no_username_i = 0; $no_username_i < $no_username_count; $no_username_i++)
{
 $no_username_item = &$this->_tpldata['no_username.'][$no_username_i];
 $no_username_item['S_ROW_COUNT'] = $no_username_i;
 $no_username_item['S_NUM_ROWS'] = $no_username_count;

?>
              <tr> 
                <td class="row1" colspan="9" style="text-align: center; text-transform: uppercase;"><?php echo isset($no_username_item['NO_USER_ID_SPECIFIED']) ? $no_username_item['NO_USER_ID_SPECIFIED'] : ''; ?></td>
              </tr>
              <?php

} // END no_username

if(isset($no_username_item)) { unset($no_username_item); } 

?>
              <?php

$memberrow_count = ( isset($this->_tpldata['memberrow.']) ) ?  sizeof($this->_tpldata['memberrow.']) : 0;
for ($memberrow_i = 0; $memberrow_i < $memberrow_count; $memberrow_i++)
{
 $memberrow_item = &$this->_tpldata['memberrow.'][$memberrow_i];
 $memberrow_item['S_ROW_COUNT'] = $memberrow_i;
 $memberrow_item['S_NUM_ROWS'] = $memberrow_count;

?>
              <tr>
                <td class="<?php echo isset($memberrow_item['ROW_CLASS']) ? $memberrow_item['ROW_CLASS'] : ''; ?> acenter"><?php echo isset($memberrow_item['ROW_NUMBER']) ? $memberrow_item['ROW_NUMBER'] : ''; ?></td>
                <td class="<?php echo isset($memberrow_item['ROW_CLASS']) ? $memberrow_item['ROW_CLASS'] : ''; ?>" width="115">
                  <span style="float: left; margin: 2px;"><?php echo isset($memberrow_item['CURRENT_AVATAR']) ? $memberrow_item['CURRENT_AVATAR'] : ''; ?> <a href="<?php echo isset($memberrow_item['U_VIEWPROFILE']) ? $memberrow_item['U_VIEWPROFILE'] : ''; ?>">
				  <strong><?php echo isset($memberrow_item['USERNAME']) ? $memberrow_item['USERNAME'] : ''; ?></strong></a></span>
                  <span style="float: right;"></span>
                &nbsp;</td>
                <td class="<?php echo isset($memberrow_item['ROW_CLASS']) ? $memberrow_item['ROW_CLASS'] : ''; ?>" width="66" align="right">
                  <span style="float: right;"><?php echo isset($memberrow_item['GENDER']) ? $memberrow_item['GENDER'] : ''; ?></span></td>
                <td class="<?php echo isset($memberrow_item['ROW_CLASS']) ? $memberrow_item['ROW_CLASS'] : ''; ?>"><?php echo isset($memberrow_item['FLAG']) ? $memberrow_item['FLAG'] : ''; ?><?php echo isset($memberrow_item['FROM']) ? $memberrow_item['FROM'] : ''; ?></td>
                <td class="<?php echo isset($memberrow_item['ROW_CLASS']) ? $memberrow_item['ROW_CLASS'] : ''; ?> acenter"><?php echo isset($memberrow_item['AGE']) ? $memberrow_item['AGE'] : ''; ?></td>                
                <td class="<?php echo isset($memberrow_item['ROW_CLASS']) ? $memberrow_item['ROW_CLASS'] : ''; ?> acenter"><?php echo isset($memberrow_item['POSTS']) ? $memberrow_item['POSTS'] : ''; ?></td>
                <td class="<?php echo isset($memberrow_item['ROW_CLASS']) ? $memberrow_item['ROW_CLASS'] : ''; ?> acenter"><?php echo isset($memberrow_item['JOINED']) ? $memberrow_item['JOINED'] : ''; ?></td>
                <td class="<?php echo isset($memberrow_item['ROW_CLASS']) ? $memberrow_item['ROW_CLASS'] : ''; ?> acenter"><?php echo isset($memberrow_item['LAST_ACTIVE']) ? $memberrow_item['LAST_ACTIVE'] : ''; ?></td>
                <td class="<?php echo isset($memberrow_item['ROW_CLASS']) ? $memberrow_item['ROW_CLASS'] : ''; ?> acenter"><?php echo isset($memberrow_item['STATUS']) ? $memberrow_item['STATUS'] : ''; ?></td>
              </tr>
              <?php

} // END memberrow

if(isset($memberrow_item)) { unset($memberrow_item); } 

?>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>       
    <td class="catBottom" style="font-size: 13px; text-align: right;">
    <?php

$pagination_count = ( isset($this->_tpldata['pagination.']) ) ?  sizeof($this->_tpldata['pagination.']) : 0;
for ($pagination_i = 0; $pagination_i < $pagination_count; $pagination_i++)
{
 $pagination_item = &$this->_tpldata['pagination.'][$pagination_i];
 $pagination_item['S_ROW_COUNT'] = $pagination_i;
 $pagination_item['S_NUM_ROWS'] = $pagination_count;

?> 
    <?php if ($pagination_item['TOTAL'] < $pagination_item['PERPAGE']) {  ?>
    <?php } else { ?>
    <?php echo isset($pagination_item['PAGINATION']) ? $pagination_item['PAGINATION'] : ''; ?>
    <?php } ?>
    <?php

} // END pagination

if(isset($pagination_item)) { unset($pagination_item); } 

?></td>      
  </tr>
</table>
</form>

</tr>
</tbody>
</table>

</div>