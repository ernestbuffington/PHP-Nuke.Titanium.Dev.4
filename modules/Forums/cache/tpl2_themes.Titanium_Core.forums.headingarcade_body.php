<?php

// eXtreme Styles mod cache. Generated on Tue, 03 Jan 2023 09:38:35 +0000 (time=1672738715)

?><script>
function resize_avatar(image)
{
  if (<?php echo isset($this->vars['MAXSIZE_AVATAR']) ? $this->vars['MAXSIZE_AVATAR'] : $this->lang('MAXSIZE_AVATAR'); ?>>0)
  {
        if (image.width > <?php echo isset($this->vars['MAXSIZE_AVATAR']) ? $this->vars['MAXSIZE_AVATAR'] : $this->lang('MAXSIZE_AVATAR'); ?> ) image.width=<?php echo isset($this->vars['MAXSIZE_AVATAR']) ? $this->vars['MAXSIZE_AVATAR'] : $this->lang('MAXSIZE_AVATAR'); ?> ;
  }
}
</script>
 <table width="100%" cellpadding="2" cellspacing="3" border="0">

    <tr>
        <td width="100%">
          <table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
          <tr>
               <td colspan="3" class="arcadeRow1" width="100%"><p align="center"><a href="modules.php?name=Forums&amp;file=arcade"><img 
               width="269" src="images/arcade_mod/arcade_logo.png" border="0"></a></p></td>
          </tr>

          <tr>
            <td class="arcadeRow1" width="25%"><p align="center"><span class="arcadeText"><?php echo isset($this->vars['L_TOP']) ? $this->vars['L_TOP'] : $this->lang('L_TOP'); ?></span></p></td>
            <td class="arcadeRow1" width="60%"><p align="center"><span class="arcadeText"><?php echo isset($this->vars['L_RECENT']) ? $this->vars['L_RECENT'] : $this->lang('L_RECENT'); ?></span></p></td>
            <td class="arcadeRow1" width="15%"><p align="center"><span class="arcadeText"><?php echo isset($this->vars['L_USER_INFO']) ? $this->vars['L_USER_INFO'] : $this->lang('L_USER_INFO'); ?></span></p></td>
          </tr>

          <tr>
            <td class="arcadeRow1" width="25%" rowspan="2" height="93" align="center" valign="top">
                         <table height="1%" width="100%" cellpadding="0" cellspacing="1" border="0" class="forumline" align="center">
                   <tr>
                            <td class="cat" align="center" width="25%"><p align="center"><span class="arcadeTextWhite">Rank</span></td>
                         <td class="cat" align="center" width="50%"><p align="center"><span class="arcadeTextWhite"><?php echo isset($this->vars['L_ARCADE_USER']) ? $this->vars['L_ARCADE_USER'] : $this->lang('L_ARCADE_USER'); ?></span></td>
                         <td class="cat" align="center" width="25%"><p align="center"><span class="arcadeTextWhite"><?php echo isset($this->vars['L_WINS']) ? $this->vars['L_WINS'] : $this->lang('L_WINS'); ?></span></td>
               </tr>
                              
                   <?php

$player_row_count = ( isset($this->_tpldata['player_row.']) ) ?  sizeof($this->_tpldata['player_row.']) : 0;
for ($player_row_i = 0; $player_row_i < $player_row_count; $player_row_i++)
{
 $player_row_item = &$this->_tpldata['player_row.'][$player_row_i];
 $player_row_item['S_ROW_COUNT'] = $player_row_i;
 $player_row_item['S_NUM_ROWS'] = $player_row_count;

?>
                   <tr>
                        <td class="row2" align="center" height="2" width="25%" class="gensmall"><p align="center"><img width="15" src="modules/Forums/templates/subSilver/images/couronne.gif" align="absmiddle"><span class="arcadeTextWhite"><?php echo isset($player_row_item['CLASSEMENT']) ? $player_row_item['CLASSEMENT'] : ''; ?></span></td>
                      <td class="row1" align="center" height="2" class="gensmall" width="50%"><p align="center"><span class="arcadeTopTenHeader"><?php echo isset($player_row_item['USERNAME']) ? $player_row_item['USERNAME'] : ''; ?></span></td>
                        <td class="row2" height="2" align="center" width="25%"><p align="center"><span class="arcadeTextWhite w3-badge w3-blue"><?php echo isset($player_row_item['VICTOIRES']) ? $player_row_item['VICTOIRES'] : ''; ?></span></td>   
                   </tr>
                      <?php

} // END player_row

if(isset($player_row_item)) { unset($player_row_item); } 

?>
            </table>

            </td>
            <td class="arcadeRow1" align="center" height="20%" valign="top">
            
            <table height="100" width="100%" cellpadding="2" cellspacing="3" border="0">
            <tr>
            <td width="100%" valign="top">
            
            <table width="100%" height="20%" cellpadding="2" cellspacing="1" border="0" class="bodyline">
            <tr>
            <td class="row3" width="100%" align="center" valign="top"><p align="center"><span class="arcadeTextWhite"><?php echo isset($this->vars['L_LAST_FIVE']) ? $this->vars['L_LAST_FIVE'] : $this->lang('L_LAST_FIVE'); ?></span></p></td>
            </tr>
            <tr>
            <td class="row1" width="100%" height="44" align="center" valign="top">
            <table width="100%" cellpadding="0" cellspacing="0" border="0" class="">
                <?php

$arcaderow2_count = ( isset($this->_tpldata['arcaderow2.']) ) ?  sizeof($this->_tpldata['arcaderow2.']) : 0;
for ($arcaderow2_i = 0; $arcaderow2_i < $arcaderow2_count; $arcaderow2_i++)
{
 $arcaderow2_item = &$this->_tpldata['arcaderow2.'][$arcaderow2_i];
 $arcaderow2_item['S_ROW_COUNT'] = $arcaderow2_i;
 $arcaderow2_item['S_NUM_ROWS'] = $arcaderow2_count;

?>
              <tbody>
              <tr>
                <td vAlign=top  width="100%">
                  <table cellSpacing=0 cellPadding=0 width="100%" border=0>
                    <tbody>
                                    <?php

$bestscore2_count = ( isset($arcaderow2_item['bestscore2.']) ) ? sizeof($arcaderow2_item['bestscore2.']) : 0;
for ($bestscore2_i = 0; $bestscore2_i < $bestscore2_count; $bestscore2_i++)
{
 $bestscore2_item = &$arcaderow2_item['bestscore2.'][$bestscore2_i];
 $bestscore2_item['S_ROW_COUNT'] = $bestscore2_i;
 $bestscore2_item['S_NUM_ROWS'] = $bestscore2_count;

?>
                            <tr>
                              <td class="<?php echo isset($bestscore2_item['CLASS']) ? $bestscore2_item['CLASS'] : ''; ?>"  align=left width="85%" valign="top"><p>&nbsp;<span class="arcadeTextWhite"> <?php echo isset($bestscore2_item['L_HEADING_CHAMP']) ? $bestscore2_item['L_HEADING_CHAMP'] : ''; ?></span></p></td>
                              <td class="<?php echo isset($bestscore2_item['CLASS']) ? $bestscore2_item['CLASS'] : ''; ?>"  noWrap align=right width="15%" valign="top"><p><span class="arcadeTextWhite"><?php echo isset($bestscore2_item['LAST_SCOREDATE']) ? $bestscore2_item['LAST_SCOREDATE'] : ''; ?></span><font size=1> </font></p></td>
                                     </tr>
                                 <?php

} // END bestscore2

if(isset($bestscore2_item)) { unset($bestscore2_item); } 

?> 
                           </tbody>
                           </table>
                     </td>
                  </tr>
                  </tbody>
                    <?php

} // END arcaderow2

if(isset($arcaderow2_item)) { unset($arcaderow2_item); } 

?> 
                                                                </table>
                                                    </td>
                                                  </tr>
                                          </table>
                                </td>  
                        </tr>
                        </table>
                </td>
                
        <td class="row1" align="center" valign="top" width="15%" rowspan="2" height="93"><p align="center">
<!-- padding between Arcade Tables and links at the bottom of the Arcade Page START -->
<div align="center" style="padding-top:22px;">
</div>
<!-- padding between Arcade Tables and links at the bottom of the Arcade Page END -->
                        <span class="arcadeTextWhite"></span><?php echo isset($this->vars['AVATAR_IMG']) ? $this->vars['AVATAR_IMG'] : $this->lang('AVATAR_IMG'); ?><br /><br /><?php echo isset($this->vars['USERNAME']) ? $this->vars['USERNAME'] : $this->lang('USERNAME'); ?><br /></br>
                        <span class="arcadeTextWhite"> <img width="15" src="modules/Forums/templates/subSilver/images/couronne.gif"><?php echo isset($this->vars['ARCADE_VICTOIRES']) ? $this->vars['ARCADE_VICTOIRES'] : $this->lang('ARCADE_VICTOIRES'); ?></span><br />
                        <span class="arcadeTextWhite"><?php echo isset($this->vars['L_ARCADE_TOTAL_PLAYS']) ? $this->vars['L_ARCADE_TOTAL_PLAYS'] : $this->lang('L_ARCADE_TOTAL_PLAYS'); ?></span><br />
                        <span class="arcadeTextWhite"><?php echo isset($this->vars['ARCADE_TOTAL_PLAYS']) ? $this->vars['ARCADE_TOTAL_PLAYS'] : $this->lang('ARCADE_TOTAL_PLAYS'); ?></span></br><br />
                        <span class="arcadeTextWhite"><strong><?php echo isset($this->vars['L_ARCADE_TOTAL_TIME']) ? $this->vars['L_ARCADE_TOTAL_TIME'] : $this->lang('L_ARCADE_TOTAL_TIME'); ?></strong></span><br />
                        <?php echo isset($this->vars['ARCADE_TOTAL_TIME']) ? $this->vars['ARCADE_TOTAL_TIME'] : $this->lang('ARCADE_TOTAL_TIME'); ?></p>
        </td>
   </tr>
          
   <tr>
        <td class="arcadeRow1" width="60%" height="80%" align="center" valign="top">
                <table cellSpacing="0" cellPadding="0" width="100%" vAlign="top" align="center" border="0">
                        <tr><td></td></tr>
          <tr>
            <td class="row3" width="100%" align="left" valign="top"><p align="center"><span class="arcadeTextWhite"><?php echo isset($this->vars['L_LAST_RECORDED']) ? $this->vars['L_LAST_RECORDED'] : $this->lang('L_LAST_RECORDED'); ?></span></p></td>
          </tr>
                    <?php

$arcaderow3_count = ( isset($this->_tpldata['arcaderow3.']) ) ?  sizeof($this->_tpldata['arcaderow3.']) : 0;
for ($arcaderow3_i = 0; $arcaderow3_i < $arcaderow3_count; $arcaderow3_i++)
{
 $arcaderow3_item = &$this->_tpldata['arcaderow3.'][$arcaderow3_i];
 $arcaderow3_item['S_ROW_COUNT'] = $arcaderow3_i;
 $arcaderow3_item['S_NUM_ROWS'] = $arcaderow3_count;

?>
              <tbody>
              <tr>
                <td vAlign=top  width="100%" valign="top">
                  
                  <table vAlign=top cellSpacing="0" cellPadding="0" width="100%" border="0">
                    <tbody>
                             <?php

$score3_count = ( isset($arcaderow3_item['score3.']) ) ? sizeof($arcaderow3_item['score3.']) : 0;
for ($score3_i = 0; $score3_i < $score3_count; $score3_i++)
{
 $score3_item = &$arcaderow3_item['score3.'][$score3_i];
 $score3_item['S_ROW_COUNT'] = $score3_i;
 $score3_item['S_NUM_ROWS'] = $score3_count;

?>
                    <tr>
                      <td class="row2" vAlign=top align=left width="85%"><p><span class="arcadeTextWhite"> <?php echo isset($score3_item['L_LAST_SCORE']) ? $score3_item['L_LAST_SCORE'] : ''; ?></span></p></td>
                    </tr>
                           <?php

} // END score3

if(isset($score3_item)) { unset($score3_item); } 

?> 
                           </tbody>
                         </table>
                    </td>
                  </tr>
                  </tbody>
                    <?php

} // END arcaderow3

if(isset($arcaderow3_item)) { unset($arcaderow3_item); } 

?> 
                </table>

                </td>
          </tr>

          </table>
        
        </tr>

    </table>

<table width="100%" cellpadding="0" cellspacing="0" border="0" class="forumline" align="center">
<tr><form action="modules.php?name=Forums&file=arcade_search" method="post">
<td align='center' class='arcadeRow1'><strong><?php echo isset($this->vars['L_SEARCH_ARCADE']) ? $this->vars['L_SEARCH_ARCADE'] : $this->lang('L_SEARCH_ARCADE'); ?>:</strong> <select name="searchin"><option selected value="name"><?php echo isset($this->vars['L_GAME_NAME']) ? $this->vars['L_GAME_NAME'] : $this->lang('L_GAME_NAME'); ?></option><option value="desc"><?php echo isset($this->vars['L_GAME_DESCRIPTION']) ? $this->vars['L_GAME_DESCRIPTION'] : $this->lang('L_GAME_DESCRIPTION'); ?></option></select>&nbsp;<input type="text" name="srchstring" size="35" title="<?php echo isset($this->vars['L_SEARCH_DESCRIPTION']) ? $this->vars['L_SEARCH_DESCRIPTION'] : $this->lang('L_SEARCH_DESCRIPTION'); ?>">&nbsp;<input type="submit" value="Search"><br />
<span class="arcadeTextPink">[</span><a class="arcadeTitleLink" href="modules.php?name=Forums&file=arcade">Arcade</a><span class="arcadeTextPink">]</span>
<span class="arcadeTextPink">[</span><a class="arcadeTitleLink" href="modules.php?name=Forums&amp;file=arcade_search&amp;x=1"><?php echo isset($this->vars['L_NO_PLAY']) ? $this->vars['L_NO_PLAY'] : $this->lang('L_NO_PLAY'); ?></a><span class="arcadeTextPink">]</span>&nbsp;&nbsp;<span class="arcadeTextPink">[</span><a class="arcadeTitleLink" href="modules.php?name=Forums&amp;file=arcade_search&amp;x=2"><?php echo isset($this->vars['L_GAMES_NEWEST']) ? $this->vars['L_GAMES_NEWEST'] : $this->lang('L_GAMES_NEWEST'); ?></a><span class="arcadeTextPink">]</span></td>
</form>
</tr>
</table>