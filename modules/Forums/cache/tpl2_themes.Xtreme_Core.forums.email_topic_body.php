<?php

// eXtreme Styles mod cache. Generated on Wed, 05 May 2021 02:54:18 +0000 (time=1620183258)

?><form action="<?php echo isset($this->vars['S_EMAIL_ACTION']) ? $this->vars['S_EMAIL_ACTION'] : $this->lang('S_EMAIL_ACTION'); ?>" method="post" name="emailtopic">
  <table width="100%" cellspacing="2" cellpadding="2" border="0">
  <tr>
    <td align="left" valign="bottom" nowrap="nowrap"><span class="nav"><a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>"><?php echo isset($this->vars['L_INDEX']) ? $this->vars['L_INDEX'] : $this->lang('L_INDEX'); ?></a></span></td>
  </tr>
  </table>
  <table border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
  <tr>
    <th class="thHead" colspan="2" height="25"><strong><?php echo isset($this->vars['L_TITLE']) ? $this->vars['L_TITLE'] : $this->lang('L_TITLE'); ?></strong></th>
  </tr>
  <tr>
    <td width="30%" class="row1"><span class="gen"><strong><?php echo isset($this->vars['L_SUBJECT']) ? $this->vars['L_SUBJECT'] : $this->lang('L_SUBJECT'); ?></strong></span></td>
    <td class="row2"><span class="gen"><?php echo isset($this->vars['TOPIC_TITLE']) ? $this->vars['TOPIC_TITLE'] : $this->lang('TOPIC_TITLE'); ?></span></td>
  </tr>
  <tr>
    <td width="30%" class="row1"><span class="gen"><strong><?php echo isset($this->vars['L_FRIEND_NAME']) ? $this->vars['L_FRIEND_NAME'] : $this->lang('L_FRIEND_NAME'); ?></strong></span></td>
    <td class="row2"><span class="gen"><input type="text" name="friend_name" size="30" maxlength="100" tabindex="1" class="post" /></span></td>
  </tr>
  <tr>
    <td width="30%" class="row1"><span class="gen"><strong><?php echo isset($this->vars['L_FRIEND_EMAIL']) ? $this->vars['L_FRIEND_EMAIL'] : $this->lang('L_FRIEND_EMAIL'); ?></strong></span></td>
    <td class="row2"><span class="gen"><input type="text" name="friend_email" size="30" maxlength="100" tabindex="2" class="post" /></span></td>
  </tr>
  <tr>
    <td width="30%" valign="top" class="row1"><span class="gen"><strong><?php echo isset($this->vars['L_MESSAGE']) ? $this->vars['L_MESSAGE'] : $this->lang('L_MESSAGE'); ?></strong></span><span class="gensmall"><br /><?php echo isset($this->vars['L_MESSAGE_EXPLAIN']) ? $this->vars['L_MESSAGE_EXPLAIN'] : $this->lang('L_MESSAGE_EXPLAIN'); ?></span></td>
    <td class="row2"><span class="gen"><textarea name="message" cols="30" rows="7" tabindex="3" class="post"></textarea></span></td>
  </tr>
  <tr>
    <td class="catBottom" colspan="2" align="center" height="28"><?php echo isset($this->vars['S_HIDDEN_FIELDS']) ? $this->vars['S_HIDDEN_FIELDS'] : $this->lang('S_HIDDEN_FIELDS'); ?><input type="submit" name="submit" value="<?php echo isset($this->vars['L_SUBMIT']) ? $this->vars['L_SUBMIT'] : $this->lang('L_SUBMIT'); ?>" tabindex="4" accesskey="s" class="mainoption" /></td>
  </tr>
  </table>
</form>

<table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
  <tr>
  <td align="right" valign="top"><span class="gensmall"><?php echo isset($this->vars['S_TIMEZONE']) ? $this->vars['S_TIMEZONE'] : $this->lang('S_TIMEZONE'); ?></span></td>
  </tr>
</table>

<table width="100%" cellspacing="2" border="0" align="center">
  <tr>
  <td valign="top" align="right"><?php echo isset($this->vars['JUMPBOX']) ? $this->vars['JUMPBOX'] : $this->lang('JUMPBOX'); ?></td>
  </tr>
</table>