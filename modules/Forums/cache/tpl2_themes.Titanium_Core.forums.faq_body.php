<?php

// eXtreme Styles mod cache. Generated on Sun, 25 Sep 2022 23:38:03 +0000 (time=1664149083)

?><div align="center">
<table width="98%" style="background-color:none; height:100%;" class="viewforum" align="center" border="5" cellpadding="15" cellspacing="20" dir="ltr" id="viewforum">
<tbody>
<tr>
<td align="center">

<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
    <tr>
        <td align="left" class="nav"><a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>"><?php echo isset($this->vars['L_INDEX']) ? $this->vars['L_INDEX'] : $this->lang('L_INDEX'); ?></a></td>
    </tr>
</table>

<table class="forumline" width="100%" cellspacing="1" cellpadding="3" border="0" align="center">
    <tr>
        <th class="thHead"><?php echo isset($this->vars['L_FAQ_TITLE']) ? $this->vars['L_FAQ_TITLE'] : $this->lang('L_FAQ_TITLE'); ?></th>
    </tr>
    <tr>
        <td class="row1">
            <?php

$faq_block_link_count = ( isset($this->_tpldata['faq_block_link.']) ) ?  sizeof($this->_tpldata['faq_block_link.']) : 0;
for ($faq_block_link_i = 0; $faq_block_link_i < $faq_block_link_count; $faq_block_link_i++)
{
 $faq_block_link_item = &$this->_tpldata['faq_block_link.'][$faq_block_link_i];
 $faq_block_link_item['S_ROW_COUNT'] = $faq_block_link_i;
 $faq_block_link_item['S_NUM_ROWS'] = $faq_block_link_count;

?>
            <span class="gen"><strong><?php echo isset($faq_block_link_item['BLOCK_TITLE']) ? $faq_block_link_item['BLOCK_TITLE'] : ''; ?></strong></span><br />
            <?php

$faq_row_link_count = ( isset($faq_block_link_item['faq_row_link.']) ) ? sizeof($faq_block_link_item['faq_row_link.']) : 0;
for ($faq_row_link_i = 0; $faq_row_link_i < $faq_row_link_count; $faq_row_link_i++)
{
 $faq_row_link_item = &$faq_block_link_item['faq_row_link.'][$faq_row_link_i];
 $faq_row_link_item['S_ROW_COUNT'] = $faq_row_link_i;
 $faq_row_link_item['S_NUM_ROWS'] = $faq_row_link_count;

?>
            <span class="gen"><a href="<?php echo isset($faq_row_link_item['U_FAQ_LINK']) ? $faq_row_link_item['U_FAQ_LINK'] : ''; ?>" class="postlink"><?php echo isset($faq_row_link_item['FAQ_LINK']) ? $faq_row_link_item['FAQ_LINK'] : ''; ?></a></span><br />
            <?php

} // END faq_row_link

if(isset($faq_row_link_item)) { unset($faq_row_link_item); } 

?>
            <br />
            <?php

} // END faq_block_link

if(isset($faq_block_link_item)) { unset($faq_block_link_item); } 

?>
        </td>
    </tr>
    <tr>
        <td class="catBottom" height="28">&nbsp;</td>
    </tr>
</table>

<br />

<?php

$faq_block_count = ( isset($this->_tpldata['faq_block.']) ) ?  sizeof($this->_tpldata['faq_block.']) : 0;
for ($faq_block_i = 0; $faq_block_i < $faq_block_count; $faq_block_i++)
{
 $faq_block_item = &$this->_tpldata['faq_block.'][$faq_block_i];
 $faq_block_item['S_ROW_COUNT'] = $faq_block_i;
 $faq_block_item['S_NUM_ROWS'] = $faq_block_count;

?>
<table class="forumline" width="100%" cellspacing="1" cellpadding="3" border="0" align="center">
    <tr> 
        <td class="catHead" height="28" align="center"><span class="cattitle"><?php echo isset($faq_block_item['BLOCK_TITLE']) ? $faq_block_item['BLOCK_TITLE'] : ''; ?></span></td>
    </tr>
    <?php

$faq_row_count = ( isset($faq_block_item['faq_row.']) ) ? sizeof($faq_block_item['faq_row.']) : 0;
for ($faq_row_i = 0; $faq_row_i < $faq_row_count; $faq_row_i++)
{
 $faq_row_item = &$faq_block_item['faq_row.'][$faq_row_i];
 $faq_row_item['S_ROW_COUNT'] = $faq_row_i;
 $faq_row_item['S_NUM_ROWS'] = $faq_row_count;

?>  
    <tr> 
        <td class="<?php echo isset($faq_row_item['ROW_CLASS']) ? $faq_row_item['ROW_CLASS'] : ''; ?>" align="left" valign="top"><span class="postbody"><a name="<?php echo isset($faq_row_item['U_FAQ_ID']) ? $faq_row_item['U_FAQ_ID'] : ''; ?>"></a><strong><?php echo isset($faq_row_item['FAQ_QUESTION']) ? $faq_row_item['FAQ_QUESTION'] : ''; ?></strong></span><br /><span class="postbody"><?php echo isset($faq_row_item['FAQ_ANSWER']) ? $faq_row_item['FAQ_ANSWER'] : ''; ?><br /><a class="postlink" href="#top"><?php echo isset($this->vars['L_BACK_TO_TOP']) ? $this->vars['L_BACK_TO_TOP'] : $this->lang('L_BACK_TO_TOP'); ?></a></span></td>
    </tr>
    <tr>
        <td class="spaceRow" height="1"><img src="themes/<?php echo isset($this->vars['THEME_NAME']) ? $this->vars['THEME_NAME'] : $this->lang('THEME_NAME'); ?>/forums/images/spacer.gif" alt="" width="1" height="1" /></td>
    </tr>
    <?php

} // END faq_row

if(isset($faq_row_item)) { unset($faq_row_item); } 

?>
</table>

<br />
<?php

} // END faq_block

if(isset($faq_block_item)) { unset($faq_block_item); } 

?>

<table width="100%" cellspacing="2" border="0" align="center">
    <tr>
        <td align="right" valign="middle" nowrap="nowrap"><span class="gensmall"><?php echo isset($this->vars['S_TIMEZONE']) ? $this->vars['S_TIMEZONE'] : $this->lang('S_TIMEZONE'); ?></span><br /><br /><?php echo isset($this->vars['JUMPBOX']) ? $this->vars['JUMPBOX'] : $this->lang('JUMPBOX'); ?></td> 
    </tr>
</table>

</tr>
</tbody>
</table>
</div>
