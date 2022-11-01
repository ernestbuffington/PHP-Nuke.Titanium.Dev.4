<?php

// eXtreme Styles mod cache. Generated on Tue, 01 Nov 2022 06:26:17 +0000 (time=1667283977)

?><table border="0" cellpadding="3" cellspacing="4" width="100%">
<td align="left"><span class="nav"><a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>" class="nav"><?php echo isset($this->vars['L_INDEX']) ? $this->vars['L_INDEX'] : $this->lang('L_INDEX'); ?></a></span>
<span class="nav">&nbsp;->&nbsp;<?php echo isset($this->vars['NAV_DESC']) ? $this->vars['NAV_DESC'] : $this->lang('NAV_DESC'); ?></span>
<span class="nav">&nbsp;->&nbsp;<?php echo isset($this->vars['L_ARCADE_COMMENTS']) ? $this->vars['L_ARCADE_COMMENTS'] : $this->lang('L_ARCADE_COMMENTS'); ?></span>
</td>
</table>

<table width="100%" cellpadding="5" cellspacing="1" border="0" class="forumline" align="center">
  <tr> 
          <th class="row4" colspan="4"><span class="cattitle"><?php echo isset($this->vars['L_ARCADE_COMMENTS_FULL']) ? $this->vars['L_ARCADE_COMMENTS_FULL'] : $this->lang('L_ARCADE_COMMENTS_FULL'); ?></span></th>
  </tr>
  <tr>
                <td align='center' class='row2'><strong><?php echo isset($this->vars['L_GAME']) ? $this->vars['L_GAME'] : $this->lang('L_GAME'); ?></strong></td>
                <td align='center' class='row1'><strong><?php echo isset($this->vars['L_COMMENTS']) ? $this->vars['L_COMMENTS'] : $this->lang('L_COMMENTS'); ?></strong></td>
                <td align='center' class='row2'><strong><?php echo isset($this->vars['L_ARCADE_USER']) ? $this->vars['L_ARCADE_USER'] : $this->lang('L_ARCADE_USER'); ?></strong></td>
                <td align='center' class='row1'><strong><?php echo isset($this->vars['L_SCORE']) ? $this->vars['L_SCORE'] : $this->lang('L_SCORE'); ?></strong></td>
  </tr>
<?php

$commentrow_count = ( isset($this->_tpldata['commentrow.']) ) ?  sizeof($this->_tpldata['commentrow.']) : 0;
for ($commentrow_i = 0; $commentrow_i < $commentrow_count; $commentrow_i++)
{
 $commentrow_item = &$this->_tpldata['commentrow.'][$commentrow_i];
 $commentrow_item['S_ROW_COUNT'] = $commentrow_i;
 $commentrow_item['S_NUM_ROWS'] = $commentrow_count;

?> 
  <tr>
                <td align='center' class='row2'><?php echo isset($commentrow_item['GAME_NAME']) ? $commentrow_item['GAME_NAME'] : ''; ?></td>
                <td align='center' class='row1'><?php echo isset($commentrow_item['COMMENTS_VALUE']) ? $commentrow_item['COMMENTS_VALUE'] : ''; ?></td>
                <td align='center' class='row2'><?php echo isset($commentrow_item['USERNAME']) ? $commentrow_item['USERNAME'] : ''; ?></td>
                <td align='center' class='row1'><?php echo isset($commentrow_item['HIGHSCORE']) ? $commentrow_item['HIGHSCORE'] : ''; ?></td>
  </tr>

<?php

} // END commentrow

if(isset($commentrow_item)) { unset($commentrow_item); } 

?>
</table>
<br /> 
<table width="100%" cellpadding="5" cellspacing="1" border="0">
   <tr>
        <td align="center">[&nbsp;<?php echo isset($this->vars['MANAGE_COMMENTS']) ? $this->vars['MANAGE_COMMENTS'] : $this->lang('MANAGE_COMMENTS'); ?>]</td>
   </tr>
  </table>
<table border="0" cellpadding="3" cellspacing="1" width="100%"> 
<td align="left"><?php echo isset($this->vars['PAGE_NUMBER']) ? $this->vars['PAGE_NUMBER'] : $this->lang('PAGE_NUMBER'); ?></td>
<td align="right"><?php echo isset($this->vars['PAGINATION']) ? $this->vars['PAGINATION'] : $this->lang('PAGINATION'); ?></td>
</table>