<?php

// eXtreme Styles mod cache. Generated on Thu, 22 Apr 2021 19:29:30 +0000 (time=1619119770)

?><script language="javascript" type="text/javascript">
<!--
function refresh_username(selected_username)
{
    <!-- Start replacement - Custom mass PM MOD -->
    if (opener.document.forms['post'].username.value)
    {
        opener.document.forms['post'].username.value = opener.document.forms['post'].username.value + ';' + selected_username;
    }
    else
    {
        opener.document.forms['post'].username.value = selected_username;
    }
    <!-- End replacement - Custom mass PM MOD -->
    opener.focus();
    window.close();
}
//-->
</script>

<form method="post" name="search" action="<?php echo isset($this->vars['S_SEARCH_ACTION']) ? $this->vars['S_SEARCH_ACTION'] : $this->lang('S_SEARCH_ACTION'); ?>">
<table width="100%" border="0" cellspacing="0" cellpadding="10">
    <tr>
        <td><table width="100%" class="forumline" cellpadding="4" cellspacing="1" border="0">
            <tr> 
                <th class="thHead" height="25"><?php echo isset($this->vars['L_SEARCH_USERNAME']) ? $this->vars['L_SEARCH_USERNAME'] : $this->lang('L_SEARCH_USERNAME'); ?></th>
            </tr>
            <tr> 
                <td valign="top" class="row1"><span class="genmed"><br /><input type="text" name="search_username" value="<?php echo isset($this->vars['USERNAME']) ? $this->vars['USERNAME'] : $this->lang('USERNAME'); ?>" class="post" />&nbsp; <input type="submit" name="search" value="<?php echo isset($this->vars['L_SEARCH']) ? $this->vars['L_SEARCH'] : $this->lang('L_SEARCH'); ?>" class="liteoption" /></span><br /><span class="gensmall"><?php echo isset($this->vars['L_SEARCH_EXPLAIN']) ? $this->vars['L_SEARCH_EXPLAIN'] : $this->lang('L_SEARCH_EXPLAIN'); ?></span><br />
                <?php

$switch_select_name_count = ( isset($this->_tpldata['switch_select_name.']) ) ?  sizeof($this->_tpldata['switch_select_name.']) : 0;
for ($switch_select_name_i = 0; $switch_select_name_i < $switch_select_name_count; $switch_select_name_i++)
{
 $switch_select_name_item = &$this->_tpldata['switch_select_name.'][$switch_select_name_i];
 $switch_select_name_item['S_ROW_COUNT'] = $switch_select_name_i;
 $switch_select_name_item['S_NUM_ROWS'] = $switch_select_name_count;

?>
                <span class="genmed"><?php echo isset($this->vars['L_UPDATE_USERNAME']) ? $this->vars['L_UPDATE_USERNAME'] : $this->lang('L_UPDATE_USERNAME'); ?><br /><select name="username_list"><?php echo isset($this->vars['S_USERNAME_OPTIONS']) ? $this->vars['S_USERNAME_OPTIONS'] : $this->lang('S_USERNAME_OPTIONS'); ?></select>&nbsp; <input type="submit" class="liteoption" onClick="refresh_username(this.form.username_list.options[this.form.username_list.selectedIndex].value);return false;" name="use" value="<?php echo isset($this->vars['L_SELECT']) ? $this->vars['L_SELECT'] : $this->lang('L_SELECT'); ?>" /></span><br />
                <?php

} // END switch_select_name

if(isset($switch_select_name_item)) { unset($switch_select_name_item); } 

?>
                <br /><span class="genmed"><a href="javascript:window.close();" class="genmed"><?php echo isset($this->vars['L_CLOSE_WINDOW']) ? $this->vars['L_CLOSE_WINDOW'] : $this->lang('L_CLOSE_WINDOW'); ?></a></span></td>
            </tr>
        </table></td>
    </tr>
</table>
</form>