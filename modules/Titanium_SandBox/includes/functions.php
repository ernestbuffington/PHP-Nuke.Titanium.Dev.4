<?php 
if (!defined('MODULE_FILE')) { die('You can\'t access this file directly...'); }
###############################			
# TEST CODE GOES HERE - START #
###############################
function OpenTableFancy()
{
  global $name, $title, $ThemeSel;

	?>
    <div style="background : url(../../../modules/Titanium_SandBox/images/ghost.jpg) repeat-y; background-size: 100%;">
    <table style="width: 100% !important; class="ghost" border="0" width="100%" cellspacing="0" cellpadding="0">
    <tr>
    <td style="width: 31 !important; width="31" height="15" background="themes/<?=$ThemeSel?>/tables/OpenTable3/Curve-TL.png">
    <img src="themes/<?=$ThemeSel?>/tables/OpenTable3/Curve-TL.png" width="31" height="31"></td>
    <td background="themes/<?=$ThemeSel?>/tables/OpenTable3/up2.png" align="center" width="100%" height="15"></td>
    <td width="31" background="themes/<?=$ThemeSel?>/tables/OpenTable3/Curve-TR.png">
    </td></tr>
    <tr>
    <td background="themes/<?=$ThemeSel?>/tables/OpenTable3/left2.png" width="31"></td>
    <td width="100%" >
    <?
}

function CloseTableFancy()
{
  global $name, $ThemeSel;
 
  ?>
  </td>
  <td width="31" background="themes/<?=$ThemeSel?>/tables/CloseTable3/Curve_Right.png"></td></tr>
  <tr>
  <td background="themes/<?=$ThemeSel?>/tables/CloseTable3/Curve-BL.png" width="31">
  </td>
  <td height="15" background="themes/<?=$ThemeSel?>/tables/CloseTable3/Curve-Bottom.png"></td>
  <td style="width: 31 !important; width="31" width="31" background="themes/<?=$ThemeSel?>/tables/CloseTable3/Curve-BR.png">
  <img src="themes/<?=$ThemeSel?>/tables/CloseTable3/Curve-BR.png" width="31" height="31"></td>
  </tr>
  </td>
  </tr>
  </table></div>
  <?
}

function OpenTableCode()
{
  global $name, $title, $ThemeSel;

	?>
    <div style="color: #EEEEEE; background : url(../../../modules/Titanium_SandBox/images/white_eeeeee.png) repeat-y; background-size: 100%;">
    <table style="width: 100% !important; class="code" border="0" width="100%" cellspacing="0" cellpadding="0">
    <tr>
    <td style="width: 31 !important; width="31" height="15" background="themes/<?=$ThemeSel?>/tables/OpenTable3/Curve-TL.png">
    <img src="themes/<?=$ThemeSel?>/tables/OpenTable3/Curve-TL.png" width="31" height="31"></td>
    <td background="themes/<?=$ThemeSel?>/tables/OpenTable3/up2.png" align="center" width="100%" height="15"></td>
    <td width="31" background="themes/<?=$ThemeSel?>/tables/OpenTable3/Curve-TR.png">
    </td></tr>
    <tr>
    <td background="themes/<?=$ThemeSel?>/tables/OpenTable3/left2.png" width="31"></td>
    <td width="100%" >
    <?
}

function CloseTableCode()
{
  global $name, $ThemeSel;
 
  ?>
  </td>
  <td width="31" background="themes/<?=$ThemeSel?>/tables/CloseTable3/Curve_Right.png"></td></tr>
  <tr>
  <td background="themes/<?=$ThemeSel?>/tables/CloseTable3/Curve-BL.png" width="31">
  </td>
  <td height="15" background="themes/<?=$ThemeSel?>/tables/CloseTable3/Curve-Bottom.png"></td>
  <td style="width: 31 !important; width="31" width="31" background="themes/<?=$ThemeSel?>/tables/CloseTable3/Curve-BR.png">
  <img src="themes/<?=$ThemeSel?>/tables/CloseTable3/Curve-BR.png" width="31" height="31"></td>
  </tr>
  </td>
  </tr>
  </table></div>
  <?
}
#############################			
# TEST CODE GOES HERE - END #
#############################
?> 
