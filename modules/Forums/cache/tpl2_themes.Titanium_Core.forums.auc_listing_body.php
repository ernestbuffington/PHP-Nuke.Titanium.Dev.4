<?php

// eXtreme Styles mod cache. Generated on Sun, 30 May 2021 05:07:35 +0000 (time=1622351255)

?><table border="0" cellpadding="4" cellspacing="1" class="forumline" style="width: 100%;">
  <tr>
    <td width="100%" align="left"><a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>"><?php echo isset($this->vars['L_INDEX']) ? $this->vars['L_INDEX'] : $this->lang('L_INDEX'); ?></a></td>                            
  </tr>
</table>
<br />
<table border="0" cellpadding="4" cellspacing="1" class="forumline" style="width: 100%;">
  <tr>
    <td class="catHead" colspan="2" style="font-weight: bold; height: 30px; text-align: center;"><?php echo isset($this->vars['T_C_2']) ? $this->vars['T_C_2'] : $this->lang('T_C_2'); ?></td>                            
  </tr>
  <tr>
    <td class="catHead" style="font-weight: bold; height: 30px; text-align: center;"><?php echo isset($this->vars['T_L']) ? $this->vars['T_L'] : $this->lang('T_L'); ?></td>
    <td class="catHead" style="font-weight: bold; height: 30px; text-align: center;"> <?php echo isset($this->vars['T_R']) ? $this->vars['T_R'] : $this->lang('T_R'); ?></td>                            
  </tr>    
  <?php

$colors_count = ( isset($this->_tpldata['colors.']) ) ?  sizeof($this->_tpldata['colors.']) : 0;
for ($colors_i = 0; $colors_i < $colors_count; $colors_i++)
{
 $colors_item = &$this->_tpldata['colors.'][$colors_i];
 $colors_item['S_ROW_COUNT'] = $colors_i;
 $colors_item['S_NUM_ROWS'] = $colors_count;

?>
  <tr>    
    <td class="<?php echo isset($colors_item['ROW_CLASS']) ? $colors_item['ROW_CLASS'] : ''; ?>" style="height: 35px;"><?php echo isset($colors_item['USER']) ? $colors_item['USER'] : ''; ?></td>
    <td class="<?php echo isset($colors_item['ROW_CLASS']) ? $colors_item['ROW_CLASS'] : ''; ?>" style="height: 35px;"><?php echo isset($colors_item['INFO_LINE']) ? $colors_item['INFO_LINE'] : ''; ?></td>                                    
  </tr>    
  <?php

} // END colors

if(isset($colors_item)) { unset($colors_item); } 

?>
</table>