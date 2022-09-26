<?php

// eXtreme Styles mod cache. Generated on Sun, 25 Sep 2022 23:31:19 +0000 (time=1664148679)

?><span class="nav"><a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>"><?php echo isset($this->vars['L_INDEX']) ? $this->vars['L_INDEX'] : $this->lang('L_INDEX'); ?></a></span>

<?php

$modules_count = ( isset($this->_tpldata['modules.']) ) ?  sizeof($this->_tpldata['modules.']) : 0;
for ($modules_i = 0; $modules_i < $modules_count; $modules_i++)
{
 $modules_item = &$this->_tpldata['modules.'][$modules_i];
 $modules_item['S_ROW_COUNT'] = $modules_i;
 $modules_item['S_NUM_ROWS'] = $modules_count;

?>
<a name="<?php echo isset($modules_item['MODULE_ID']) ? $modules_item['MODULE_ID'] : ''; ?>"></a>
<br />
<!-- cached: <?php echo isset($modules_item['CACHED']) ? $modules_item['CACHED'] : ''; ?> reloaded: <?php echo isset($modules_item['RELOADED']) ? $modules_item['RELOADED'] : ''; ?> -->
<?php echo isset($modules_item['CURRENT_MODULE']) ? $modules_item['CURRENT_MODULE'] : ''; ?>
<!--
<?php

$switch_display_timestats_count = ( isset($modules_item['switch_display_timestats.']) ) ? sizeof($modules_item['switch_display_timestats.']) : 0;
for ($switch_display_timestats_i = 0; $switch_display_timestats_i < $switch_display_timestats_count; $switch_display_timestats_i++)
{
 $switch_display_timestats_item = &$modules_item['switch_display_timestats.'][$switch_display_timestats_i];
 $switch_display_timestats_item['S_ROW_COUNT'] = $switch_display_timestats_i;
 $switch_display_timestats_item['S_NUM_ROWS'] = $switch_display_timestats_count;

?>
<table border="0" cellpadding="0" cellspacing="0" class="forumline" width="100%"> 
<tr> 
    <td class="row2" align="center"><span class="gen">Last Update Time</span></td>
    <td class="row2" align="center"><span class="gen"><?php echo isset($modules_item['LAST_UPDATE_TIME']) ? $modules_item['LAST_UPDATE_TIME'] : ''; ?></span></td>
    <td class="row2" align="center"><span class="gen">Next expected Update</span></td>
    <td class="row2" align="center"><span class="gen"><?php echo isset($modules_item['NEXT_GUESSED_UPDATE_TIME']) ? $modules_item['NEXT_GUESSED_UPDATE_TIME'] : ''; ?></span></td>
</tr> 
</table>
<?php

} // END switch_display_timestats

if(isset($switch_display_timestats_item)) { unset($switch_display_timestats_item); } 

?>
//-->
<?php

} // END modules

if(isset($modules_item)) { unset($modules_item); } 

?>

<br />
<div align="center"><span class="copyright">Statistics Mod Version 3 Demonstration (BETA3-2003-03-16)
<?php

$switch_debug_count = ( isset($this->_tpldata['switch_debug.']) ) ?  sizeof($this->_tpldata['switch_debug.']) : 0;
for ($switch_debug_i = 0; $switch_debug_i < $switch_debug_count; $switch_debug_i++)
{
 $switch_debug_item = &$this->_tpldata['switch_debug.'][$switch_debug_i];
 $switch_debug_item['S_ROW_COUNT'] = $switch_debug_i;
 $switch_debug_item['S_NUM_ROWS'] = $switch_debug_count;

?>
<br /><br /><br />Statistics Mod - [time: <?php echo isset($this->vars['TIME']) ? $this->vars['TIME'] : $this->lang('TIME'); ?> | sql time: <?php echo isset($this->vars['SQL_TIME']) ? $this->vars['SQL_TIME'] : $this->lang('SQL_TIME'); ?> | queries: <?php echo isset($this->vars['QUERY']) ? $this->vars['QUERY'] : $this->lang('QUERY'); ?> | <a href="<?php echo isset($this->vars['U_EXPLAIN']) ? $this->vars['U_EXPLAIN'] : $this->lang('U_EXPLAIN'); ?>" target="_blank">Explain</a>]
<?php

} // END switch_debug

if(isset($switch_debug_item)) { unset($switch_debug_item); } 

?>
</span></div>