<?php

// eXtreme Styles mod cache. Generated on Thu, 22 Apr 2021 18:44:35 +0000 (time=1619117075)

?><form method="post" action="<?php echo isset($this->vars['S_SPLIT_ACTION']) ? $this->vars['S_SPLIT_ACTION'] : $this->lang('S_SPLIT_ACTION'); ?>">
<table cellspacing="2" cellpadding="2" border="0">
  <tr>
  	<td><a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>"><?php echo isset($this->vars['L_INDEX']) ? $this->vars['L_INDEX'] : $this->lang('L_INDEX'); ?></a><?php if ($this->vars['PARENT_FORUM']) {  ?> -> <a href="<?php echo isset($this->vars['U_VIEW_PARENT_FORUM']) ? $this->vars['U_VIEW_PARENT_FORUM'] : $this->lang('U_VIEW_PARENT_FORUM'); ?>"><?php echo isset($this->vars['PARENT_FORUM_NAME']) ? $this->vars['PARENT_FORUM_NAME'] : $this->lang('PARENT_FORUM_NAME'); ?></a> <?php } ?> -> <a href="<?php echo isset($this->vars['U_VIEW_FORUM']) ? $this->vars['U_VIEW_FORUM'] : $this->lang('U_VIEW_FORUM'); ?>"><?php echo isset($this->vars['FORUM_NAME']) ? $this->vars['FORUM_NAME'] : $this->lang('FORUM_NAME'); ?></a></td>
  </tr>
</table>

<table cellpadding="4" cellspacing="1" border="0" class="col-12 forumline">
  <tr> 
    <td class="catHead center" colspan="3" nowrap="nowrap"><?php echo isset($this->vars['L_SPLIT_TOPIC']) ? $this->vars['L_SPLIT_TOPIC'] : $this->lang('L_SPLIT_TOPIC'); ?></td>
  </tr>
  <tr> 
    <td class="center row1" colspan="3"><?php echo isset($this->vars['L_SPLIT_TOPIC_EXPLAIN']) ? $this->vars['L_SPLIT_TOPIC_EXPLAIN'] : $this->lang('L_SPLIT_TOPIC_EXPLAIN'); ?></td>
  </tr>
  <tr> 
    <td class="row1" nowrap="nowrap"><?php echo isset($this->vars['L_SPLIT_SUBJECT']) ? $this->vars['L_SPLIT_SUBJECT'] : $this->lang('L_SPLIT_SUBJECT'); ?></td>
    <td class="row1" colspan="2"><input type="text" size="35" style="width: 350px" maxlength="100" name="subject" class="post" /></td>
  </tr>
  <tr> 
    <td class="row1" nowrap="nowrap"><?php echo isset($this->vars['L_SPLIT_FORUM']) ? $this->vars['L_SPLIT_FORUM'] : $this->lang('L_SPLIT_FORUM'); ?></td>
    <td class="row1" colspan="2"><?php echo isset($this->vars['S_FORUM_SELECT']) ? $this->vars['S_FORUM_SELECT'] : $this->lang('S_FORUM_SELECT'); ?></td>
  </tr>
</table>

<table cellpadding="4" cellspacing="1" border="0" class="col-12 forumline" style="table-layout: fixed;">
  <tr> 
    <td class="catHead col-2"><?php echo isset($this->vars['L_AUTHOR']) ? $this->vars['L_AUTHOR'] : $this->lang('L_AUTHOR'); ?></td>
    <td class="catHead col-9"><?php echo isset($this->vars['L_MESSAGE']) ? $this->vars['L_MESSAGE'] : $this->lang('L_MESSAGE'); ?></td>
    <td class="catHead center col-1"><?php echo isset($this->vars['L_SELECT']) ? $this->vars['L_SELECT'] : $this->lang('L_SELECT'); ?></td>
  </tr>
  <?php

$postrow_count = ( isset($this->_tpldata['postrow.']) ) ?  sizeof($this->_tpldata['postrow.']) : 0;
for ($postrow_i = 0; $postrow_i < $postrow_count; $postrow_i++)
{
 $postrow_item = &$this->_tpldata['postrow.'][$postrow_i];
 $postrow_item['S_ROW_COUNT'] = $postrow_i;
 $postrow_item['S_NUM_ROWS'] = $postrow_count;

?>
  <tr> 
    <td align="left" valign="top" class="<?php echo isset($postrow_item['ROW_CLASS']) ? $postrow_item['ROW_CLASS'] : ''; ?>"><span class="name"><a name="<?php echo isset($postrow_item['U_POST_ID']) ? $postrow_item['U_POST_ID'] : ''; ?>"></a><?php echo isset($postrow_item['POSTER_NAME']) ? $postrow_item['POSTER_NAME'] : ''; ?></span></td>
    <td width="100%" valign="top" class="<?php echo isset($postrow_item['ROW_CLASS']) ? $postrow_item['ROW_CLASS'] : ''; ?>"> 
      <table width="100%" cellspacing="0" cellpadding="3" border="0" style="table-layout: fixed;">
        <tr> 
          <td valign="middle"><img src="themes/<?php echo isset($this->vars['THEME_NAME']) ? $this->vars['THEME_NAME'] : $this->lang('THEME_NAME'); ?>/forums/images/icon_minipost.gif" alt="<?php echo isset($this->vars['L_POST']) ? $this->vars['L_POST'] : $this->lang('L_POST'); ?>"><?php echo isset($this->vars['L_POSTED']) ? $this->vars['L_POSTED'] : $this->lang('L_POSTED'); ?>: <?php echo isset($postrow_item['POST_DATE']) ? $postrow_item['POST_DATE'] : ''; ?>&nbsp;&nbsp;<?php echo isset($this->vars['L_POST_SUBJECT']) ? $this->vars['L_POST_SUBJECT'] : $this->lang('L_POST_SUBJECT'); ?>: <?php echo isset($postrow_item['POST_SUBJECT']) ? $postrow_item['POST_SUBJECT'] : ''; ?></td>
        </tr>
        <tr> 
          <td valign="top"><hr size="1" /><span class="postbody"><?php echo isset($postrow_item['MESSAGE']) ? $postrow_item['MESSAGE'] : ''; ?></span></td> 
        </tr>
      </table>
    </td>
    <td class="center col-1 <?php echo isset($postrow_item['ROW_CLASS']) ? $postrow_item['ROW_CLASS'] : ''; ?>"><?php echo isset($postrow_item['S_SPLIT_CHECKBOX']) ? $postrow_item['S_SPLIT_CHECKBOX'] : ''; ?></td>
  </tr>
  <tr> 
    <td colspan="3" height="1" class="row3"><img src="themes/<?php echo isset($this->vars['THEME_NAME']) ? $this->vars['THEME_NAME'] : $this->lang('THEME_NAME'); ?>/forums/images/spacer.gif" width="1" height="1" alt="."></td>
  </tr>
  <?php

} // END postrow

if(isset($postrow_item)) { unset($postrow_item); } 

?>
  <tr> 
    <td class="catHead center" colspan="3"><input class="liteoption" type="submit" name="split_type_all" value="<?php echo isset($this->vars['L_SPLIT_POSTS']) ? $this->vars['L_SPLIT_POSTS'] : $this->lang('L_SPLIT_POSTS'); ?>" />&nbsp;<input class="liteoption" type="submit" name="split_type_beyond" value="<?php echo isset($this->vars['L_SPLIT_AFTER']) ? $this->vars['L_SPLIT_AFTER'] : $this->lang('L_SPLIT_AFTER'); ?>" /></td>
  </tr>
</table>
<?php echo isset($this->vars['S_HIDDEN_FIELDS']) ? $this->vars['S_HIDDEN_FIELDS'] : $this->lang('S_HIDDEN_FIELDS'); ?>
</form>