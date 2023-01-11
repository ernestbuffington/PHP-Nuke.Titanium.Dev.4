<?php

// eXtreme Styles mod cache. Generated on Thu, 29 Dec 2022 17:11:30 +0000 (time=1672333890)

?><script>
var win = null;

function Arcade_Popup(mypage,myname,w,h,scroll)
{
  LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
  TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
  settings = 'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',status='+scroll+',resizable=yes';
  win = window.open(mypage,myname,settings);
}
    
function createPopupWin(mypage,myname,popupWinWidth, popupWinHeight) {
            var left = (screen.width ) ;
            var top = (screen.height ) ;
            var myWindow = window.open(mypage, myname,
                    'resizable=yes, width=' + popupWinWidth
                    + ', height=' + popupWinHeight + ', top='
                    + top + ', left=' + left);
        }    
</script>
 <!-- index phrase display -->
<?php echo isset($this->vars['HEADINGARCADE']) ? $this->vars['HEADINGARCADE'] : $this->lang('HEADINGARCADE'); ?>
  <table width="100%" cellspacing="2" cellpadding="2" border="0">
    <tr>
          <td align="left" valign="middle" width="100%">
                <span class="arcadeTitleLink">
                        <a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>" class="arcadeTitleLink"><?php echo isset($this->vars['L_INDEX']) ? $this->vars['L_INDEX'] : $this->lang('L_INDEX'); ?></a>
                </span>
                <span class="arcadeTitleLink">&nbsp;->&nbsp;<?php echo isset($this->vars['NAV_DESC']) ? $this->vars['NAV_DESC'] : $this->lang('NAV_DESC'); ?>&nbsp;->&nbsp;<?php echo isset($this->vars['CATTITLE']) ? $this->vars['CATTITLE'] : $this->lang('CATTITLE'); ?></span>
          </td>
    </tr>
  </table>
<?php echo isset($this->vars['WHOISPLAYING']) ? $this->vars['WHOISPLAYING'] : $this->lang('WHOISPLAYING'); ?>
  <?php

$arcade_search_count = ( isset($this->_tpldata['arcade_search.']) ) ?  sizeof($this->_tpldata['arcade_search.']) : 0;
for ($arcade_search_i = 0; $arcade_search_i < $arcade_search_count; $arcade_search_i++)
{
 $arcade_search_item = &$this->_tpldata['arcade_search.'][$arcade_search_i];
 $arcade_search_item['S_ROW_COUNT'] = $arcade_search_i;
 $arcade_search_item['S_NUM_ROWS'] = $arcade_search_count;

?>
<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
  <tr>
        <td align="left" valign="bottom"><span class="maintitle"><?php echo isset($arcade_search_item['L_SEARCH_MATCHES']) ? $arcade_search_item['L_SEARCH_MATCHES'] : ''; ?></span><br /></td>
  </tr>
</table>
    <?php

} // END arcade_search

if(isset($arcade_search_item)) { unset($arcade_search_item); } 

?>

<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
  <tr>
        <th class="arcadeThTop" colspan="<?php echo isset($this->vars['ARCADE_COL']) ? $this->vars['ARCADE_COL'] : $this->lang('ARCADE_COL'); ?>" nowrap="nowrap">&nbsp;<?php echo isset($this->vars['L_ARCADE']) ? $this->vars['L_ARCADE'] : $this->lang('L_ARCADE'); ?>&nbsp;</th>
  </tr>
  <?php

$use_category_mod_count = ( isset($this->_tpldata['use_category_mod.']) ) ?  sizeof($this->_tpldata['use_category_mod.']) : 0;
for ($use_category_mod_i = 0; $use_category_mod_i < $use_category_mod_count; $use_category_mod_i++)
{
 $use_category_mod_item = &$this->_tpldata['use_category_mod.'][$use_category_mod_i];
 $use_category_mod_item['S_ROW_COUNT'] = $use_category_mod_i;
 $use_category_mod_item['S_NUM_ROWS'] = $use_category_mod_count;

?>
  <tr> 
        <td class="cat" colspan="<?php echo isset($this->vars['ARCADE_COL']) ? $this->vars['ARCADE_COL'] : $this->lang('ARCADE_COL'); ?>" nowrap="nowrap" align="center"><span class="cattitle"><?php echo isset($this->vars['CATTITLE']) ? $this->vars['CATTITLE'] : $this->lang('CATTITLE'); ?></span></td>
  </tr>
  <?php

} // END use_category_mod

if(isset($use_category_mod_item)) { unset($use_category_mod_item); } 

?>
  <tr> 
        <td class="cat" height="28" align="center" colspan="2"><span class="cattitle"><?php echo isset($this->vars['L_GAME']) ? $this->vars['L_GAME'] : $this->lang('L_GAME'); ?></span></td>
        <td class="cat" nowrap="nowrap" align="center"><span class="cattitle"><?php echo isset($this->vars['L_HIGHSCORE']) ? $this->vars['L_HIGHSCORE'] : $this->lang('L_HIGHSCORE'); ?></span></td>
        <td class="cat" nowrap="nowrap" align="center"><span class="cattitle"><?php echo isset($this->vars['L_YOURSCORE']) ? $this->vars['L_YOURSCORE'] : $this->lang('L_YOURSCORE'); ?></span></td>
        <td class="cat" colspan="<?php echo isset($this->vars['ARCADE_COL1']) ? $this->vars['ARCADE_COL1'] : $this->lang('ARCADE_COL1'); ?>" nowrap="nowrap" align="center"><span class="cattitle"><?php echo isset($this->vars['L_DESC']) ? $this->vars['L_DESC'] : $this->lang('L_DESC'); ?></span></td>
  </tr>
<?php

$favrow_count = ( isset($this->_tpldata['favrow.']) ) ?  sizeof($this->_tpldata['favrow.']) : 0;
for ($favrow_i = 0; $favrow_i < $favrow_count; $favrow_i++)
{
 $favrow_item = &$this->_tpldata['favrow.'][$favrow_i];
 $favrow_item['S_ROW_COUNT'] = $favrow_i;
 $favrow_item['S_NUM_ROWS'] = $favrow_count;

?>

<tr>
        <td class="cat" colspan="6"><span class="cattitle"><?php echo isset($this->vars['FAV']) ? $this->vars['FAV'] : $this->lang('FAV'); ?></span></td>
</tr>
          
          <?php

$fav_row_count = ( isset($favrow_item['fav_row.']) ) ? sizeof($favrow_item['fav_row.']) : 0;
for ($fav_row_i = 0; $fav_row_i < $fav_row_count; $fav_row_i++)
{
 $fav_row_item = &$favrow_item['fav_row.'][$fav_row_i];
 $fav_row_item['S_ROW_COUNT'] = $fav_row_i;
 $fav_row_item['S_NUM_ROWS'] = $fav_row_count;

?>
          <tr>
                        <td class="row1" width="35"><?php echo isset($fav_row_item['GAMEPICF']) ? $fav_row_item['GAMEPICF'] : ''; ?></td>
                        
                        <td class="row1" width="100" align="center">
                        <span class='genmed'><?php echo isset($fav_row_item['GAMELINKF']) ? $fav_row_item['GAMELINKF'] : ''; ?></span><br />
                        <span class='genmed'><?php echo isset($fav_row_item['GAMEPOPUPLINKF']) ? $fav_row_item['GAMEPOPUPLINKF'] : ''; ?></span><br />
                        <span class='gensmall'><?php echo isset($fav_row_item['GAMESETF']) ? $fav_row_item['GAMESETF'] : ''; ?></span>
                        </td>
                        
                        <td class="row1" width="150" align="center" valign="center" >
                                <span class='gen'><?php echo isset($fav_row_item['NORECORDF']) ? $fav_row_item['NORECORDF'] : ''; ?>
                                <?php

$recordrow_count = ( isset($fav_row_item['recordrow.']) ) ? sizeof($fav_row_item['recordrow.']) : 0;
for ($recordrow_i = 0; $recordrow_i < $recordrow_count; $recordrow_i++)
{
 $recordrow_item = &$fav_row_item['recordrow.'][$recordrow_i];
 $recordrow_item['S_ROW_COUNT'] = $recordrow_i;
 $recordrow_item['S_NUM_ROWS'] = $recordrow_count;

?>
                                <strong><?php echo isset($fav_row_item['HIGHSCOREF']) ? $fav_row_item['HIGHSCOREF'] : ''; ?></strong></span><span class='gensmall'>   <?php echo isset($fav_row_item['HIGHUSERF']) ? $fav_row_item['HIGHUSERF'] : ''; ?><br/><?php echo isset($fav_row_item['DATEHIGHF']) ? $fav_row_item['DATEHIGHF'] : ''; ?>
                                <?php

} // END recordrow

if(isset($recordrow_item)) { unset($recordrow_item); } 

?>
                                 </span>
                        </td>
                        
                        <td class="row1" width="150" align="center" valign="center" >
                                <span class='gen'><?php echo isset($fav_row_item['NOSCOREF']) ? $fav_row_item['NOSCOREF'] : ''; ?>
                                <?php

$yourrecordrow_count = ( isset($fav_row_item['yourrecordrow.']) ) ? sizeof($fav_row_item['yourrecordrow.']) : 0;
for ($yourrecordrow_i = 0; $yourrecordrow_i < $yourrecordrow_count; $yourrecordrow_i++)
{
 $yourrecordrow_item = &$fav_row_item['yourrecordrow.'][$yourrecordrow_i];
 $yourrecordrow_item['S_ROW_COUNT'] = $yourrecordrow_i;
 $yourrecordrow_item['S_NUM_ROWS'] = $yourrecordrow_count;

?>
                                <strong><?php echo isset($fav_row_item['YOURHIGHSCOREF']) ? $fav_row_item['YOURHIGHSCOREF'] : ''; ?><?php echo isset($fav_row_item['IMGFIRSTF']) ? $fav_row_item['IMGFIRSTF'] : ''; ?></strong></span><span class='gensmall'><br/><?php echo isset($fav_row_item['YOURDATEHIGHF']) ? $fav_row_item['YOURDATEHIGHF'] : ''; ?>
                                <?php

} // END yourrecordrow

if(isset($yourrecordrow_item)) { unset($yourrecordrow_item); } 

?>
        <?php

$playrecordrow_count = ( isset($fav_row_item['playrecordrow.']) ) ? sizeof($fav_row_item['playrecordrow.']) : 0;
for ($playrecordrow_i = 0; $playrecordrow_i < $playrecordrow_count; $playrecordrow_i++)
{
 $playrecordrow_item = &$fav_row_item['playrecordrow.'][$playrecordrow_i];
 $playrecordrow_item['S_ROW_COUNT'] = $playrecordrow_i;
 $playrecordrow_item['S_NUM_ROWS'] = $playrecordrow_count;

?>
        <strong><?php echo isset($fav_row_item['CLICKPLAY']) ? $fav_row_item['CLICKPLAY'] : ''; ?></strong>
           <?php

} // END playrecordrow

if(isset($playrecordrow_item)) { unset($playrecordrow_item); } 

?>
                                </span>   
                        </td>
                        
                        <td class="row1" align="center" valign="center">
                                <table width="100%">
                                        <tr>
                                                 <td align="center">
                                                        <span class="name"><?php echo isset($fav_row_item['GAMEDESCF']) ? $fav_row_item['GAMEDESCF'] : ''; ?></span>
                                                 </td>
                                                <td width="25"><?php echo isset($fav_row_item['URL_SCOREBOARDF']) ? $fav_row_item['URL_SCOREBOARDF'] : ''; ?></td>
                                        </tr>
                                </table>
                          </td>
                          
                  
                         <td class="row1" align="center" valign="center">
                         <?php echo isset($fav_row_item['DELFAVORI']) ? $fav_row_item['DELFAVORI'] : ''; ?>
                         </td>
</tr>                 
<?php

} // END fav_row

if(isset($fav_row_item)) { unset($fav_row_item); } 

?>
<br />
<tr>
        <td class="cat" colspan="6"><span class="cattitle"><?php echo isset($this->vars['L_GAME']) ? $this->vars['L_GAME'] : $this->lang('L_GAME'); ?></span></td>
</tr>
<?php

} // END favrow

if(isset($favrow_item)) { unset($favrow_item); } 

?>
  <?php

$gamerow_count = ( isset($this->_tpldata['gamerow.']) ) ?  sizeof($this->_tpldata['gamerow.']) : 0;
for ($gamerow_i = 0; $gamerow_i < $gamerow_count; $gamerow_i++)
{
 $gamerow_item = &$this->_tpldata['gamerow.'][$gamerow_i];
 $gamerow_item['S_ROW_COUNT'] = $gamerow_i;
 $gamerow_item['S_NUM_ROWS'] = $gamerow_count;

?>
  <tr> 
        <td class="row1" height="25" width='35' align='center'><?php echo isset($gamerow_item['GAMEPIC']) ? $gamerow_item['GAMEPIC'] : ''; ?></td>
        <td class="row1" height="25">
            <span class='genmed'><?php echo isset($gamerow_item['GAMELINK']) ? $gamerow_item['GAMELINK'] : ''; ?></span><br />
            <span class='genmed'><?php echo isset($gamerow_item['GAMEPOPUPLINK']) ? $gamerow_item['GAMEPOPUPLINK'] : ''; ?></span><br />
                <span class='gensmall'><?php echo isset($gamerow_item['GAMESET']) ? $gamerow_item['GAMESET'] : ''; ?></span>
        </td>
        <td class="row1" align="center" valign="center" >
                <span class='gen'>
                <?php echo isset($gamerow_item['NORECORD']) ? $gamerow_item['NORECORD'] : ''; ?>
          <?php

$recordrow_count = ( isset($gamerow_item['recordrow.']) ) ? sizeof($gamerow_item['recordrow.']) : 0;
for ($recordrow_i = 0; $recordrow_i < $recordrow_count; $recordrow_i++)
{
 $recordrow_item = &$gamerow_item['recordrow.'][$recordrow_i];
 $recordrow_item['S_ROW_COUNT'] = $recordrow_i;
 $recordrow_item['S_NUM_ROWS'] = $recordrow_count;

?>
        <strong><?php echo isset($gamerow_item['HIGHSCORE']) ? $gamerow_item['HIGHSCORE'] : ''; ?></strong></span><span class='gensmall'>&nbsp;&nbsp;<?php echo isset($gamerow_item['HIGHUSER']) ? $gamerow_item['HIGHUSER'] : ''; ?><br /><?php echo isset($gamerow_item['DATEHIGH']) ? $gamerow_item['DATEHIGH'] : ''; ?>
           <?php

} // END recordrow

if(isset($recordrow_item)) { unset($recordrow_item); } 

?>
            </span>
           
        </td>
        <td class="row1" align="center" valign="center" >
        <span class='gen'>
                <?php echo isset($gamerow_item['NOSCORE']) ? $gamerow_item['NOSCORE'] : ''; ?>
          <?php

$yourrecordrow_count = ( isset($gamerow_item['yourrecordrow.']) ) ? sizeof($gamerow_item['yourrecordrow.']) : 0;
for ($yourrecordrow_i = 0; $yourrecordrow_i < $yourrecordrow_count; $yourrecordrow_i++)
{
 $yourrecordrow_item = &$gamerow_item['yourrecordrow.'][$yourrecordrow_i];
 $yourrecordrow_item['S_ROW_COUNT'] = $yourrecordrow_i;
 $yourrecordrow_item['S_NUM_ROWS'] = $yourrecordrow_count;

?>
        <strong><?php echo isset($gamerow_item['YOURHIGHSCORE']) ? $gamerow_item['YOURHIGHSCORE'] : ''; ?><?php echo isset($gamerow_item['IMGFIRST']) ? $gamerow_item['IMGFIRST'] : ''; ?></strong></span><span class='gensmall'><br /><?php echo isset($gamerow_item['YOURDATEHIGH']) ? $gamerow_item['YOURDATEHIGH'] : ''; ?>
           <?php

} // END yourrecordrow

if(isset($yourrecordrow_item)) { unset($yourrecordrow_item); } 

?>
        <?php

$playrecordrow_count = ( isset($gamerow_item['playrecordrow.']) ) ? sizeof($gamerow_item['playrecordrow.']) : 0;
for ($playrecordrow_i = 0; $playrecordrow_i < $playrecordrow_count; $playrecordrow_i++)
{
 $playrecordrow_item = &$gamerow_item['playrecordrow.'][$playrecordrow_i];
 $playrecordrow_item['S_ROW_COUNT'] = $playrecordrow_i;
 $playrecordrow_item['S_NUM_ROWS'] = $playrecordrow_count;

?>
        <strong><?php echo isset($gamerow_item['CLICKPLAY']) ? $gamerow_item['CLICKPLAY'] : ''; ?></strong>
           <?php

} // END playrecordrow

if(isset($playrecordrow_item)) { unset($playrecordrow_item); } 

?>

            </span>   
        </td>
        <td class="row1" align="center" valign="center">
                <table width="100%">
                <tr>
                 <td align="center">
                <span class="name"><?php echo isset($gamerow_item['GAMEDESC']) ? $gamerow_item['GAMEDESC'] : ''; ?></span>
                 </td>
                 <td width="25"><?php echo isset($gamerow_item['URL_SCOREBOARD']) ? $gamerow_item['URL_SCOREBOARD'] : ''; ?></td>
            </tr>
                </table>
        </td>
<?php echo isset($gamerow_item['ADD_FAV']) ? $gamerow_item['ADD_FAV'] : ''; ?>
  </tr>
  <?php

} // END gamerow

if(isset($gamerow_item)) { unset($gamerow_item); } 

?>
</table>
<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
        <tr>
                <td align="left" valign="middle" nowrap="nowrap"><span class="nav"><?php echo isset($this->vars['PAGE_NUMBER']) ? $this->vars['PAGE_NUMBER'] : $this->lang('PAGE_NUMBER'); ?></span></td>
                <td align="right" valign="middle"><span class="nav"><?php echo isset($this->vars['PAGINATION']) ? $this->vars['PAGINATION'] : $this->lang('PAGINATION'); ?></span></td>
        </tr>
</table>
  <table width="100%" cellpadding="5" cellspacing="1" border="0">
   <tr>
        <td align="center">[&nbsp;<?php echo isset($this->vars['URL_ARCADE']) ? $this->vars['URL_ARCADE'] : $this->lang('URL_ARCADE'); ?>]&nbsp;-&nbsp;[&nbsp;<?php echo isset($this->vars['URL_BESTSCORES']) ? $this->vars['URL_BESTSCORES'] : $this->lang('URL_BESTSCORES'); ?>]&nbsp;-&nbsp;[&nbsp;<?php echo isset($this->vars['MANAGE_COMMENTS']) ? $this->vars['MANAGE_COMMENTS'] : $this->lang('MANAGE_COMMENTS'); ?>]</td>
   </tr>
  </table>