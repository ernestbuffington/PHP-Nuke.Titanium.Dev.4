<?php

// eXtreme Styles mod cache. Generated on Wed, 28 Apr 2021 05:27:09 +0000 (time=1619587629)

?><div align="center">
<table width="98%" style="background-color:none; height:100%;" class="viewforum" align="center" border="5" cellpadding="15" cellspacing="20" dir="ltr" id="viewforum">
<tbody>
<tr>
<td align="center">

<form action="<?php echo isset($this->vars['S_SEARCH_ACTION']) ? $this->vars['S_SEARCH_ACTION'] : $this->lang('S_SEARCH_ACTION'); ?>" method="post"><table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
    <tr> 
        <td align="left"><span class="nav"><a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>"><?php echo isset($this->vars['L_INDEX']) ? $this->vars['L_INDEX'] : $this->lang('L_INDEX'); ?></a></span></td>
    </tr>
</table>

<table class="forumline" width="100%" cellpadding="4" cellspacing="1" border="0">
    <tr> 
        <th class="thHead" colspan="4" height="25"><?php echo isset($this->vars['L_SEARCH_QUERY']) ? $this->vars['L_SEARCH_QUERY'] : $this->lang('L_SEARCH_QUERY'); ?></th>
    </tr>
    <tr> 
        <td class="row1" colspan="2" width="50%"><span class="gen"><?php echo isset($this->vars['L_SEARCH_KEYWORDS']) ? $this->vars['L_SEARCH_KEYWORDS'] : $this->lang('L_SEARCH_KEYWORDS'); ?>:</span><br /><span class="gensmall"><?php echo isset($this->vars['L_SEARCH_KEYWORDS_EXPLAIN']) ? $this->vars['L_SEARCH_KEYWORDS_EXPLAIN'] : $this->lang('L_SEARCH_KEYWORDS_EXPLAIN'); ?></span></td>
        <td class="row2" colspan="2" valign="top"><span class="genmed"><input type="text" style="width: 300px" class="post" name="search_keywords" size="30" /><br /><input type="radio" name="search_terms" value="any" checked="checked" /> <?php echo isset($this->vars['L_SEARCH_ANY_TERMS']) ? $this->vars['L_SEARCH_ANY_TERMS'] : $this->lang('L_SEARCH_ANY_TERMS'); ?><br /><input type="radio" name="search_terms" value="all" /> <?php echo isset($this->vars['L_SEARCH_ALL_TERMS']) ? $this->vars['L_SEARCH_ALL_TERMS'] : $this->lang('L_SEARCH_ALL_TERMS'); ?></span></td>
    </tr>
    <tr> 
        <td class="row1" colspan="2"><span class="gen"><?php echo isset($this->vars['L_SEARCH_AUTHOR']) ? $this->vars['L_SEARCH_AUTHOR'] : $this->lang('L_SEARCH_AUTHOR'); ?>:</span><br /><span class="gensmall"><?php echo isset($this->vars['L_SEARCH_AUTHOR_EXPLAIN']) ? $this->vars['L_SEARCH_AUTHOR_EXPLAIN'] : $this->lang('L_SEARCH_AUTHOR_EXPLAIN'); ?></span></td>
        <td class="row2" colspan="2" valign="middle"><span class="genmed"><input type="text" style="width: 300px" class="post" name="search_author" size="30" /></span></td>
    </tr>
    <tr> 
        <th class="thHead" colspan="4" height="25"><?php echo isset($this->vars['L_SEARCH_OPTIONS']) ? $this->vars['L_SEARCH_OPTIONS'] : $this->lang('L_SEARCH_OPTIONS'); ?></th>
    </tr>
    <tr> 
        <td class="row1" align="right"><span class="gen"><?php echo isset($this->vars['L_FORUM']) ? $this->vars['L_FORUM'] : $this->lang('L_FORUM'); ?>:&nbsp;</span></td>
        <td class="row2"><span class="genmed"><select class="post" name="search_forum"><?php echo isset($this->vars['S_FORUM_OPTIONS']) ? $this->vars['S_FORUM_OPTIONS'] : $this->lang('S_FORUM_OPTIONS'); ?></select></span></td>
        <td class="row1" align="right" nowrap="nowrap"><span class="gen"><?php echo isset($this->vars['L_SEARCH_PREVIOUS']) ? $this->vars['L_SEARCH_PREVIOUS'] : $this->lang('L_SEARCH_PREVIOUS'); ?>:&nbsp;</span></td>
        <td class="row2" valign="middle"><span class="genmed"><select class="post" name="search_time"><?php echo isset($this->vars['S_TIME_OPTIONS']) ? $this->vars['S_TIME_OPTIONS'] : $this->lang('S_TIME_OPTIONS'); ?></select><br /><input type="radio" name="search_fields" value="all" checked="checked" /> <?php echo isset($this->vars['L_SEARCH_MESSAGE_TITLE']) ? $this->vars['L_SEARCH_MESSAGE_TITLE'] : $this->lang('L_SEARCH_MESSAGE_TITLE'); ?><br /><input type="radio" name="search_fields" value="msgonly" /> <?php echo isset($this->vars['L_SEARCH_MESSAGE_ONLY']) ? $this->vars['L_SEARCH_MESSAGE_ONLY'] : $this->lang('L_SEARCH_MESSAGE_ONLY'); ?></span></td>
    </tr>
    <tr> 
        <td class="row1" align="right"><span class="gen"><?php echo isset($this->vars['L_CATEGORY']) ? $this->vars['L_CATEGORY'] : $this->lang('L_CATEGORY'); ?>:&nbsp;</span></td>
        <td class="row2"><span class="genmed"><select class="post" name="search_cat"><?php echo isset($this->vars['S_CATEGORY_OPTIONS']) ? $this->vars['S_CATEGORY_OPTIONS'] : $this->lang('S_CATEGORY_OPTIONS'); ?>
        </select></span></td>
        <td class="row1" align="right"><span class="gen"><?php echo isset($this->vars['L_SORT_BY']) ? $this->vars['L_SORT_BY'] : $this->lang('L_SORT_BY'); ?>:&nbsp;</span></td>
        <td class="row2" valign="middle" nowrap="nowrap"><span class="genmed"><select class="post" name="sort_by"><?php echo isset($this->vars['S_SORT_OPTIONS']) ? $this->vars['S_SORT_OPTIONS'] : $this->lang('S_SORT_OPTIONS'); ?></select><br /><input type="radio" name="sort_dir" value="ASC" /> <?php echo isset($this->vars['L_SORT_ASCENDING']) ? $this->vars['L_SORT_ASCENDING'] : $this->lang('L_SORT_ASCENDING'); ?><br /><input type="radio" name="sort_dir" value="DESC" checked="checked" /> <?php echo isset($this->vars['L_SORT_DESCENDING']) ? $this->vars['L_SORT_DESCENDING'] : $this->lang('L_SORT_DESCENDING'); ?></span>&nbsp;</td>
    </tr>
    <tr> 
        <td class="row1" align="right" nowrap="nowrap"><span class="gen"><?php echo isset($this->vars['L_DISPLAY_RESULTS']) ? $this->vars['L_DISPLAY_RESULTS'] : $this->lang('L_DISPLAY_RESULTS'); ?>:&nbsp;</span></td>
        <td class="row2" nowrap="nowrap"><input type="radio" name="show_results" value="posts" /><span class="genmed"><?php echo isset($this->vars['L_POSTS']) ? $this->vars['L_POSTS'] : $this->lang('L_POSTS'); ?><input type="radio" name="show_results" value="topics" checked="checked" /><?php echo isset($this->vars['L_TOPICS']) ? $this->vars['L_TOPICS'] : $this->lang('L_TOPICS'); ?></span></td>
        <td class="row1" align="right"><span class="gen"><?php echo isset($this->vars['L_RETURN_FIRST']) ? $this->vars['L_RETURN_FIRST'] : $this->lang('L_RETURN_FIRST'); ?></span></td>
        <td class="row2"><span class="genmed"><select class="post" name="return_chars"><?php echo isset($this->vars['S_CHARACTER_OPTIONS']) ? $this->vars['S_CHARACTER_OPTIONS'] : $this->lang('S_CHARACTER_OPTIONS'); ?></select> <?php echo isset($this->vars['L_CHARACTERS']) ? $this->vars['L_CHARACTERS'] : $this->lang('L_CHARACTERS'); ?></span></td>
    </tr>
    <tr> 
        <td class="catBottom" colspan="4" align="center" height="28"><?php echo isset($this->vars['S_HIDDEN_FIELDS']) ? $this->vars['S_HIDDEN_FIELDS'] : $this->lang('S_HIDDEN_FIELDS'); ?><input class="liteoption" type="submit" value="<?php echo isset($this->vars['L_SEARCH']) ? $this->vars['L_SEARCH'] : $this->lang('L_SEARCH'); ?>" /></td>
    </tr>
</table>

<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
    <tr> 
        <td align="right" valign="middle"><span class="gensmall"><?php echo isset($this->vars['S_TIMEZONE']) ? $this->vars['S_TIMEZONE'] : $this->lang('S_TIMEZONE'); ?></span></td>
    </tr>
</table></form>

<table width="100%" border="0">
    <tr>
        <td align="right" valign="top"><?php echo isset($this->vars['JUMPBOX']) ? $this->vars['JUMPBOX'] : $this->lang('JUMPBOX'); ?></td>
    </tr>
</table>
</tr>
</tbody>
</table>
</div>