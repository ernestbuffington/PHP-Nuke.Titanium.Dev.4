<?php

// eXtreme Styles mod cache. Generated on Fri, 20 Aug 2021 15:08:21 +0000 (time=1629472101)

?><table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline">
    <tr>
        <th class="thHead" align="center"><?php echo isset($this->vars['L_RULES_TITLE']) ? $this->vars['L_RULES_TITLE'] : $this->lang('L_RULES_TITLE'); ?></th>
    </tr>
<?php

$switch_nothing_count = ( isset($this->_tpldata['switch_nothing.']) ) ?  sizeof($this->_tpldata['switch_nothing.']) : 0;
for ($switch_nothing_i = 0; $switch_nothing_i < $switch_nothing_count; $switch_nothing_i++)
{
 $switch_nothing_item = &$this->_tpldata['switch_nothing.'][$switch_nothing_i];
 $switch_nothing_item['S_ROW_COUNT'] = $switch_nothing_i;
 $switch_nothing_item['S_NUM_ROWS'] = $switch_nothing_count;

?>
    <tr>
        <td class="row1" width="100%" align="center"><span class="gen"><?php echo isset($this->vars['L_EMPTY_GROUP_PERMS']) ? $this->vars['L_EMPTY_GROUP_PERMS'] : $this->lang('L_EMPTY_GROUP_PERMS'); ?></span></td>
    </tr>
<?php

} // END switch_nothing

if(isset($switch_nothing_item)) { unset($switch_nothing_item); } 

?>
<?php

$group_row_count = ( isset($this->_tpldata['group_row.']) ) ?  sizeof($this->_tpldata['group_row.']) : 0;
for ($group_row_i = 0; $group_row_i < $group_row_count; $group_row_i++)
{
 $group_row_item = &$this->_tpldata['group_row.'][$group_row_i];
 $group_row_item['S_ROW_COUNT'] = $group_row_i;
 $group_row_item['S_NUM_ROWS'] = $group_row_count;

?>
    <tr>
        <td class="row1" width="100%" align="center">
        <table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline">
        <tr>
            <th class="thHead" align="center"><?php echo isset($group_row_item['GROUP_RULE_HEADER']) ? $group_row_item['GROUP_RULE_HEADER'] : ''; ?></th>
        </tr>
        <tr>
            <td class="row1" align="center"><span class="gen">
<?php

$extension_row_count = ( isset($group_row_item['extension_row.']) ) ? sizeof($group_row_item['extension_row.']) : 0;
for ($extension_row_i = 0; $extension_row_i < $extension_row_count; $extension_row_i++)
{
 $extension_row_item = &$group_row_item['extension_row.'][$extension_row_i];
 $extension_row_item['S_ROW_COUNT'] = $extension_row_i;
 $extension_row_item['S_NUM_ROWS'] = $extension_row_count;

?>
<?php echo isset($extension_row_item['EXTENSION']) ? $extension_row_item['EXTENSION'] : ''; ?>&nbsp;
<?php

} // END extension_row

if(isset($extension_row_item)) { unset($extension_row_item); } 

?>
</span></td>
        </tr>
        </table>
        </td>
    </tr>
<?php

} // END group_row

if(isset($group_row_item)) { unset($group_row_item); } 

?>
</table>

<span class="genmed"><a href="javascript:window.close();" class="genmed"><?php echo isset($this->vars['L_CLOSE_WINDOW']) ? $this->vars['L_CLOSE_WINDOW'] : $this->lang('L_CLOSE_WINDOW'); ?></a></span>