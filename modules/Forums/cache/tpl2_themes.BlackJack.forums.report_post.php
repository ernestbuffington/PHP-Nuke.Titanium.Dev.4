<?php

// eXtreme Styles mod cache. Generated on Thu, 29 Dec 2022 18:36:43 +0000 (time=1672339003)

?><table width="100%" cellspacing="2" cellpadding="2" border="0">
  <tr> 
    <td align="left" valign="bottom" colspan="2"><span class="maintitle"><?php echo isset($this->vars['L_REPORT_POST']) ? $this->vars['L_REPORT_POST'] : $this->lang('L_REPORT_POST'); ?>: <a class="maintitle" href="<?php echo isset($this->vars['U_VIEW_TOPIC']) ? $this->vars['U_VIEW_TOPIC'] : $this->lang('U_VIEW_TOPIC'); ?>"><?php echo isset($this->vars['TOPIC_TITLE']) ? $this->vars['TOPIC_TITLE'] : $this->lang('TOPIC_TITLE'); ?></a></span></td>
  </tr>
</table>

<table width="100%" cellspacing="2" cellpadding="2" border="0">
  <tr> 
    <td align="left" valign="middle" width="100%"><span class="nav"><a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>"><?php echo isset($this->vars['L_INDEX']) ? $this->vars['L_INDEX'] : $this->lang('L_INDEX'); ?></a></span></td>
  </tr>
</table>

<form action="<?php echo isset($this->vars['S_ACTION']) ? $this->vars['S_ACTION'] : $this->lang('S_ACTION'); ?>" method="post">
<table class="forumline" width="100%" cellspacing="1" cellpadding="3" border="0">
    <tr>
        <th class="catHead" colspan="2"><?php echo isset($this->vars['L_REPORT_POST']) ? $this->vars['L_REPORT_POST'] : $this->lang('L_REPORT_POST'); ?></td>
    </tr>
    <tr>
        <td class="row1" width="22%"><span class="gen"><?php echo isset($this->vars['L_COMMENTS']) ? $this->vars['L_COMMENTS'] : $this->lang('L_COMMENTS'); ?></span><br /><span class="genmed"><?php echo isset($this->vars['L_COMMENTS_EXPLAIN']) ? $this->vars['L_COMMENTS_EXPLAIN'] : $this->lang('L_COMMENTS_EXPLAIN'); ?></span></td>
        <td class="row1"><textarea rows="15" cols="35" wrap="virtual" style="width:450px" tabindex="3" class="post" name="comments"></textarea></td>
    </tr>
    <tr> 
      <td class="catBottom" colspan="2" align="center" height="28"><input type="submit" accesskey="s" tabindex="6" name="post" class="mainoption" value="<?php echo isset($this->vars['L_SUBMIT']) ? $this->vars['L_SUBMIT'] : $this->lang('L_SUBMIT'); ?>" /></td>
    </tr>
</table>
</form>