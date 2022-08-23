<?php

// eXtreme Styles mod cache. Generated on Thu, 13 May 2021 13:35:05 +0000 (time=1620912905)

?><table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
  <tr> 
    <td align="left"><span class="nav"><a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>"><?php echo isset($this->vars['L_INDEX']) ? $this->vars['L_INDEX'] : $this->lang('L_INDEX'); ?></a></span></td>
  </tr>
</table>

<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
  <tr> 
    <th height="25" class="thHead"><?php echo isset($this->vars['L_IP_INFO']) ? $this->vars['L_IP_INFO'] : $this->lang('L_IP_INFO'); ?></th>
  </tr>
  <tr> 
    <td class="catHead" height="28"><span class="cattitle"><strong><?php echo isset($this->vars['L_THIS_POST_IP']) ? $this->vars['L_THIS_POST_IP'] : $this->lang('L_THIS_POST_IP'); ?></strong></span></td>
  </tr>
  <tr> 
    <td class="row1"> 
      <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr> 
          <td>&nbsp;<span class="gen"><?php echo isset($this->vars['IP']) ? $this->vars['IP'] : $this->lang('IP'); ?> [ <?php echo isset($this->vars['POSTS']) ? $this->vars['POSTS'] : $this->lang('POSTS'); ?> ]</span></td>
          <td align="right"><span class="gen">[ <a href="<?php echo isset($this->vars['U_LOOKUP_IP']) ? $this->vars['U_LOOKUP_IP'] : $this->lang('U_LOOKUP_IP'); ?>"><?php echo isset($this->vars['L_LOOKUP_IP']) ? $this->vars['L_LOOKUP_IP'] : $this->lang('L_LOOKUP_IP'); ?></a> 
            ]&nbsp;</span></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr> 
    <td class="catHead" height="28"><span class="cattitle"><strong><?php echo isset($this->vars['L_OTHER_USERS']) ? $this->vars['L_OTHER_USERS'] : $this->lang('L_OTHER_USERS'); ?></strong></span></td>
  </tr>
  <?php

$userrow_count = ( isset($this->_tpldata['userrow.']) ) ?  sizeof($this->_tpldata['userrow.']) : 0;
for ($userrow_i = 0; $userrow_i < $userrow_count; $userrow_i++)
{
 $userrow_item = &$this->_tpldata['userrow.'][$userrow_i];
 $userrow_item['S_ROW_COUNT'] = $userrow_i;
 $userrow_item['S_NUM_ROWS'] = $userrow_count;

?>
  <tr> 
    <td class="<?php echo isset($userrow_item['ROW_CLASS']) ? $userrow_item['ROW_CLASS'] : ''; ?>"> 
      <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr> 
          <td>&nbsp;<span class="gen"><a href="<?php echo isset($userrow_item['U_PROFILE']) ? $userrow_item['U_PROFILE'] : ''; ?>"><?php echo isset($userrow_item['USERNAME']) ? $userrow_item['USERNAME'] : ''; ?></a> [ <?php echo isset($userrow_item['POSTS']) ? $userrow_item['POSTS'] : ''; ?> ]</span></td>
          <td align="right"><a href="<?php echo isset($userrow_item['U_SEARCHPOSTS']) ? $userrow_item['U_SEARCHPOSTS'] : ''; ?>" title="<?php echo isset($userrow_item['L_SEARCH_POSTS']) ? $userrow_item['L_SEARCH_POSTS'] : ''; ?>"><img src="<?php echo isset($this->vars['SEARCH_IMG']) ? $this->vars['SEARCH_IMG'] : $this->lang('SEARCH_IMG'); ?>" border="0" alt="<?php echo isset($this->vars['L_SEARCH']) ? $this->vars['L_SEARCH'] : $this->lang('L_SEARCH'); ?>" /></a> 
            &nbsp;</td>
        </tr>
      </table>
    </td>
  </tr>
  <?php

} // END userrow

if(isset($userrow_item)) { unset($userrow_item); } 

?>
  <tr> 
    <td class="catHead" height="28"><span class="cattitle"><strong><?php echo isset($this->vars['L_OTHER_IPS']) ? $this->vars['L_OTHER_IPS'] : $this->lang('L_OTHER_IPS'); ?></strong></span></td>
  </tr>
  <?php

$iprow_count = ( isset($this->_tpldata['iprow.']) ) ?  sizeof($this->_tpldata['iprow.']) : 0;
for ($iprow_i = 0; $iprow_i < $iprow_count; $iprow_i++)
{
 $iprow_item = &$this->_tpldata['iprow.'][$iprow_i];
 $iprow_item['S_ROW_COUNT'] = $iprow_i;
 $iprow_item['S_NUM_ROWS'] = $iprow_count;

?>
  <tr> 
    <td class="<?php echo isset($iprow_item['ROW_CLASS']) ? $iprow_item['ROW_CLASS'] : ''; ?>"><table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr> 
          <td>&nbsp;<span class="gen"><?php echo isset($iprow_item['IP']) ? $iprow_item['IP'] : ''; ?> [ <?php echo isset($iprow_item['POSTS']) ? $iprow_item['POSTS'] : ''; ?> ]</span></td>
          <td align="right"><span class="gen">[ <a href="<?php echo isset($iprow_item['U_LOOKUP_IP']) ? $iprow_item['U_LOOKUP_IP'] : ''; ?>"><?php echo isset($this->vars['L_LOOKUP_IP']) ? $this->vars['L_LOOKUP_IP'] : $this->lang('L_LOOKUP_IP'); ?></a> 
            ]&nbsp;</span></td>
        </tr>
      </table></td>
  </tr>
  <?php

} // END iprow

if(isset($iprow_item)) { unset($iprow_item); } 

?>
</table>

<br />