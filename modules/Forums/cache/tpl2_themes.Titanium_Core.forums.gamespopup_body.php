<?php

// eXtreme Styles mod cache. Generated on Tue, 01 Nov 2022 02:45:42 +0000 (time=1667270742)

?><html>

<head>
<title><?php echo isset($this->vars['L_GAME']) ? $this->vars['L_GAME'] : $this->lang('L_GAME'); ?><?php echo isset($this->vars['HIGHUSER']) ? $this->vars['HIGHUSER'] : $this->lang('HIGHUSER'); ?><?php echo isset($this->vars['HIGHSCORE']) ? $this->vars['HIGHSCORE'] : $this->lang('HIGHSCORE'); ?></title>
</head>
<body bgcolor="#000000">
<?php

$game_type_V5_count = ( isset($this->_tpldata['game_type_V5.']) ) ?  sizeof($this->_tpldata['game_type_V5.']) : 0;
for ($game_type_V5_i = 0; $game_type_V5_i < $game_type_V5_count; $game_type_V5_i++)
{
 $game_type_V5_item = &$this->_tpldata['game_type_V5.'][$game_type_V5_i];
 $game_type_V5_item['S_ROW_COUNT'] = $game_type_V5_i;
 $game_type_V5_item['S_NUM_ROWS'] = $game_type_V5_count;

?>
         <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="100%" height="100%">
            <param name="movie" value="modules/Forums/games/<?php echo isset($this->vars['SWF_GAME']) ? $this->vars['SWF_GAME'] : $this->lang('SWF_GAME'); ?>?arcade_hash=<?php echo isset($this->vars['GAMEHASH']) ? $this->vars['GAMEHASH'] : $this->lang('GAMEHASH'); ?>">
            <param name="quality" value="high">
            <param name="menu" value="false">
            <embed src="modules/Forums/games/<?php echo isset($this->vars['SWF_GAME']) ? $this->vars['SWF_GAME'] : $this->lang('SWF_GAME'); ?>?arcade_hash=<?php echo isset($this->vars['GAMEHASH']) ? $this->vars['GAMEHASH'] : $this->lang('GAMEHASH'); ?>" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="100%" height="100%">
            </embed>
        </object>
<?php

} // END game_type_V5

if(isset($game_type_V5_item)) { unset($game_type_V5_item); } 

?>
<?php

$game_type_V2_count = ( isset($this->_tpldata['game_type_V2.']) ) ?  sizeof($this->_tpldata['game_type_V2.']) : 0;
for ($game_type_V2_i = 0; $game_type_V2_i < $game_type_V2_count; $game_type_V2_i++)
{
 $game_type_V2_item = &$this->_tpldata['game_type_V2.'][$game_type_V2_i];
 $game_type_V2_item['S_ROW_COUNT'] = $game_type_V2_i;
 $game_type_V2_item['S_NUM_ROWS'] = $game_type_V2_count;

?>
         <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="100%" height="100%">
            <param name="movie" value="modules/Forums/games/<?php echo isset($this->vars['SWF_GAME']) ? $this->vars['SWF_GAME'] : $this->lang('SWF_GAME'); ?>">
            <param name="quality" value="high">
            <param name="menu" value="false">
            <embed src="modules/Forums/games/<?php echo isset($this->vars['SWF_GAME']) ? $this->vars['SWF_GAME'] : $this->lang('SWF_GAME'); ?>"  pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="100%" height="100%">
            </embed>
        </object>
<?php

} // END game_type_V2

if(isset($game_type_V2_item)) { unset($game_type_V2_item); } 

?>
<br />
</body>
</html>e-flash" width="100%" height="100%">
            </embed>
        </object>
<!-- END game_type_V2 -->
<br />
</body>
</html>