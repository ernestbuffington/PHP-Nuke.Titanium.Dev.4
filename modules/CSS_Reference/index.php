<?php
if (!defined('MODULE_FILE')) die('You can\'t access this file directly...');

$module_name = basename(dirname(__FILE__));

if ( isset($HTTP_GET_VARS['mode']) || isset($HTTP_POST_VARS['mode']) )
        $mode = ( isset($HTTP_POST_VARS['mode']) ) ? htmlspecialchars($HTTP_POST_VARS['mode']) : htmlspecialchars($HTTP_GET_VARS['mode']);
else
        $mode = '';
//
// Generate page
//
global $module_name, $bgcolor2;

if(!isset($module_name) || empty($module_name))
$module_name = basename(dirname(__FILE__));

get_lang($module_name);

$pagetitle = 'Complete CSS Reference';

include(NUKE_BASE_DIR.'header.php');
    #########################################################################
    # Table Header Module     Fix Start - by TheGhost   v1.0.0     01/30/2012
    #########################################################################
    if(!function_exists('OpenTableModule'))
    {
      OpenTable();
	}
	else
	{
	   OpenTableModule();
	}
    #########################################################################
    # Table Header Module     Fix End  - by TheGhost   v1.0.0     01/30/2012
    #########################################################################
?>
<p align="center"><a href="#1">Font</a> | <a href="#2">Color and Background</a>
| <a href="#3">Text</a> | <a href="#4">Box</a> | <a href="#5">Classification</a>
| <a href="#6">Positioning</a> | <a href="#7">Printing</a> | <a href="#8">Pseudo</a>
</p>


<h3><font color="#FF0000"><b>- <a name="1"></a></b></font>Font Properties</h3>

<table class=clsRef width=100% border=0 cellpadding=5 cellspacing=2>

<tr align=LEFT valign=MIDDLE bgcolor="<?=$bgcolor2?>">
<td bgcolor="#999999" style="border-style: inset; border-width: 1px"><b>Property</b></td>
<td bgcolor="#999999" style="border-style: inset; border-width: 1px"><b>Valid Values</b></td>
<td bgcolor="#999999" style="border-style: inset; border-width: 1px"><b>Example</b></td>
<td bgcolor="#999999" style="border-style: inset; border-width: 1px"><b>Inherited?</b></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">font-family</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">[font name or type]</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">font-family: Verdana, Arial;</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">Y</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">font-style</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">normal | italic</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">font-style:italic;</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">Y</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">font-variant</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">normal | small-caps</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">font-variant:small-caps;</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">Y</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">font-weight</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">normal | bold</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">font-weight:bold;</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">Y</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">font-size</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">[ xx-large | x-large | large | medium | small | x-small | xx-small ] | [ larger | smaller ] | <i>percentage</i> | <i>length</i></td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">font-size:12pt;</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">Y</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">font</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">[ <i>font-style</i> || <i>font-variant</i> || <i>font-weight</i> ] ? <i>font-size</i> [ / <i>line-height</i> ] ? <i>font-family</i></td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"> font: bold 12pt Arial;</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">Y</font></td>
</tr>

</table>

<h3><font color="#FF0000"><b>- <a name="2"></a></b></font>Color and Background Properties</h3>

<table class=clsRef width=100% border=0 cellpadding=5 cellspacing=2>
<tr align=LEFT valign=MIDDLE bgcolor="<?=$bgcolor2?>">
<td bgcolor="#999999" style="border-style: inset; border-width: 1px"><b>Property</b></td>
<td bgcolor="#999999" style="border-style: inset; border-width: 1px"><b>Valid Values</b></td>
<td bgcolor="#999999" style="border-style: inset; border-width: 1px"><b>Example</b></td>
<td bgcolor="#999999" style="border-style: inset; border-width: 1px"><b>Inherited?</b></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">color</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"><i>color </i></td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">color: red</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">Y</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">background-color</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"><i>color</i> | transparent </td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">background-color: yellow</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N*</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">background-image</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"><i>url</i> | none </td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">background-image: url(house.jpg)</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N*</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">background-repeat</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">repeat | repeat-x | repeat-y | no-repeat </td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">background-repeat: no-repeat</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N*</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">background-attachment</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">scroll | fixed </td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">background-attachment: fixed</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N*</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">background-position</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">[ <i>position</i>  | <i>length</i> ] | {1,2} | [ top | center | bottom ] || [ left | center | right ]</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"> background-position: top center</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N*</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">background </td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">transparent | <i>color</i> || <i>url</i> || repeat || scroll || <i>position</i></td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"> background: silver url(house.jpg) repeat-y</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N*</font></td>
</tr>
</table>

<h3><font size="3">* Starting in CSS2, the properties indicated above are
inherited.&nbsp;</font></h3>

<h3><font color="#FF0000"><b>- <a name="3"></a></b></font>Text Properties</h3>

<table class=clsRef width=100% border=0 cellpadding=5 cellspacing=2>
<tr align=LEFT valign=MIDDLE bgcolor="<?=$bgcolor2?>">
<td bgcolor="#999999" style="border-style: inset; border-width: 1px"><b>Property</b></td>
<td bgcolor="#999999" style="border-style: inset; border-width: 1px"><b>Valid Values</b></td>
<td bgcolor="#999999" style="border-style: inset; border-width: 1px"><b>Example</b></td>
<td bgcolor="#999999" style="border-style: inset; border-width: 1px"><b>Inherited?</b></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">letter-spacing</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">normal | <i>length</i></td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">letter-spacing:5pt</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">Y</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">text-decoration</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">none | underline | overline | line-through</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">text-decoration:underline</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">vertical-align</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">sub | super | </td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">vertical-align:sub</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">text-transform</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">capitalize | uppercase | lowercase | none</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">text-transform:lowercase</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">text-align</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">left | right | center | justify</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">text-align:center</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">text-indent</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"><i>length</i> | <i>percentage</i></td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">text-indent:25px</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">line-height</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">normal | <i>number</i> | <i>length</i> | <i>percentage</i></td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">line-height:15pt</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
</table>

<h3><font color="#FF0000"><b>- <a name="4"></a></b></font>Box Properties</h3>

<table class=clsRef width=100% border=0 cellpadding=5 cellspacing=2>
<tr align=LEFT valign=MIDDLE bgcolor="<?=$bgcolor2?>">
<td bgcolor="#999999" style="border-style: inset; border-width: 1px"><b>Property</b></td>
<td bgcolor="#999999" style="border-style: inset; border-width: 1px"><b>Valid Values</b></td>
<td bgcolor="#999999" style="border-style: inset; border-width: 1px"><b>Example</b></td>
<td bgcolor="#999999" style="border-style: inset; border-width: 1px"><b>Inherited?</b></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">margin-top</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"><i>length</i> | <i>percentage</i> | auto</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">margin-top:5px</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">margin-right</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"><i>length</i> | <i>percentage</i> | auto</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">margin-right:5px</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">margin-bottom</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"><i>length</i> | <i>percentage</i> | auto</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">margin-bottom:1em</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">margin-left</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"><i>length</i> | <i>percentage</i> | auto</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">margin-left:5pt</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">margin</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"><i>length</i> | <i>percentage</i> | auto  {1,4}</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"> margin: 10px 5px 10px 5px</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">padding-top</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"><i>length</i> | <i>percentage</i></td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">padding-top:10%</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">padding-right</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"><i>length</i> | <i>percentage</i></td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">padding-right:15px</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">padding-bottom</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"><i>length</i> | <i>percentage</i></td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">padding-bottom:1.2em</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">padding-left</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"><i>length</i> | <i>percentage</i></td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"> padding-left:10pt; }</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">padding</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">l<i>ength</i> | <i>percentage</i> {1,4}</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"> padding: 10px 10px 10px 15px</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">border-top-width</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">thin | medium | thick | <i>length</i> </td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">border-top-width:thin</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">border-right-width</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">thin | medium | thick | <i>length</i> </td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">border-right-width:medium</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">border-bottom-width</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">thin | medium | thick | <i>length</i></td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">border-bottom-width:thick</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">border-left-width</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">thin | medium | thick | <i>length</i> </td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">border-left-width:15px</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">border-width</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">thin | medium | thick | <i>length</i> {1,4}</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"> border-width: 3px 5px 3px 5px </td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">border-top-color</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"><i>color </i></td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">border-top-color:navajowhite</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">border-right-color</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"><i>color</i></td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">border-right-color:whitesmoke</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">border-bottom-color</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"><i>color</i></td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">border-bottom-color:black</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">border-left-color</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"><i>color</i></td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">border-left-color:#C0C0C0</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">border-color</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"><i>color</i> {1,4} </td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"> border-color: green red white blue; } </td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">border-top-style</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">none | solid | double | groove | ridge | inset | outset </td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">border-top-style:solid</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">border-right-style</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">none | solid | double | groove | ridge | inset | outset </td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">border-right-style:double</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">border-bottom-style</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">none | solid | double | groove | ridge | inset | outset </td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">border-bottom-style:groove</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">border-left-style</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">none | solid | double | groove | ridge | inset | outset </td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">border-left-style:none</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">border-style</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">none | solid | double | groove | ridge | inset | outset </td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"> border-style:ridge; }</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">border-top</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"><i>border-width</i> | <i>border-style</i> | <i>border-color </i></td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"> border-top: medium outset red</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">border-right</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"><i>border-width</i> | <i>border-style</i> | <i>border-color </i></td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"> border-right: thick inset maroon</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">border-bottom</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"><i>border-width</i> | <i>border-style</i> | <i>border-color </i></td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"> border-bottom: 10px ridge gray</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">border-left</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"><i>border-width</i> | <i>border-style</i> | <i>border-color </i></td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"> border-left: 1px groove red</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">border</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"><i>border-width</i> | <i>border-style</i> | <i>border-color </i></td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"> border: thin solid blue</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">float</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">none | left | right  </td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">float:none</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">clear </td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">none | left | right | both </td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">clear:left</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
</table>


<h3><font color="#FF0000"><b>- <a name="5"></a></b></font>Classification Properties</h3>

<table class=clsRef width=100% border=0 cellpadding=5 cellspacing=2>

<tr align=LEFT valign=MIDDLE bgcolor="<?=$bgcolor2?>">
<td bgcolor="#999999" style="border-style: inset; border-width: 1px"><b>Property</b></td>
<td bgcolor="#999999" style="border-style: inset; border-width: 1px"><b>Valid Values</b></td>
<td bgcolor="#999999" style="border-style: inset; border-width: 1px"><b>Example</b></td>
<td bgcolor="#999999" style="border-style: inset; border-width: 1px"><b>Inherited?</b></td>
</tr>

<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">display</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">none | block | inline | list-item</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">display:none</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">list-style-type</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">disk | circle | square | decimal | lower-roman | upper-roman | lower-alpha | upper-alpha | none</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">list-style-type:upper-alpha</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">Y</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">list-style-image</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"><i>url</i> | none </td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">list-style-image:url(icFile.gif)</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">Y</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">list-style-position</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">inside | outside</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">list-style-position:inside</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">Y</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">list-style</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"><i>keyword</i> || <i>position</i> || <i>url</i> </td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"> list-style: square outside url(icFolder.gif)</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">Y</font></td>
</tr>
</table>

<h3><font color="#FF0000"><b>- <a name="6"></a></b></font>Positioning Properties</h3>

<table class=clsRef width=100% border=0 cellpadding=5 cellspacing=2>

<tr align=LEFT valign=MIDDLE bgcolor="<?=$bgcolor2?>">
<td bgcolor="#999999" style="border-style: inset; border-width: 1px"><b>Property</b></td>
<td bgcolor="#999999" style="border-style: inset; border-width: 1px"><b>Valid Values</b></td>
<td bgcolor="#999999" style="border-style: inset; border-width: 1px"><b>Example</b></td>
<td bgcolor="#999999" style="border-style: inset; border-width: 1px"><b>Applies to</b></td>
<td bgcolor="#999999" style="border-style: inset; border-width: 1px"><b>Inherited?</b></td>
</tr>

<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">clip</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"><i>shape</i> | auto </td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"> clip:rect(0px 200px 200px 0px)</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">all elements</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">height</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"><i>length</i> | auto</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">height:200px</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">DIV, SPAN and replaced elements</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">left</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"><i>length</i> | <i>percentage</i> | auto</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">left:0px</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">absolutely and relatively positioned elements</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">overflow</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">visible | hidden | scroll | auto</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">overflow:scroll </td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">all elements</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">position</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">absolute|  relative | static </td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">position:absolute</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">all elements</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">top</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"><i>length</i> | <i>percentage</i> | auto</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">top:0px</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">absolutely and relatively positioned elements</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">visibility</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">visible | hidden | inherit</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">visibility:visible</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">all elements</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">width</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px"><i>length</i> | <i>percentage</i> | auto</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">width:80%</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">DIV, SPAN and replaced elements</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">z-index</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">auto | <i>integer</i> </td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">z-index:-1</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">absolutely and relatively positioned elements</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>

</table>


<h3><font color="#FF0000"><b>- <a name="7"></a></b></font>Printing Properties</h3>


<table class=clsRef width=100% border=0 cellpadding=5 cellspacing=2>

<tr align=LEFT valign=MIDDLE bgcolor="<?=$bgcolor2?>">
<td bgcolor="#999999" style="border-style: inset; border-width: 1px"><b>Property</b></td>
<td bgcolor="#999999" style="border-style: inset; border-width: 1px"><b>Valid Values</b></td>
<td bgcolor="#999999" style="border-style: inset; border-width: 1px"><b>Example</b></td>
<td bgcolor="#999999" style="border-style: inset; border-width: 1px"><b>Inherited?</b></td>
</tr>

<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">page-break-before</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">auto | always || left | right </td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">page-break-before:always</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">page-break-after</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">auto | always || left | right</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">page-break-before:auto</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>

</table>


<h3><font color="#FF0000"><b>- <a name="8"></a></b></font>Pseudo Classes</h3>

<table class=clsRef width=100% border=0 cellpadding=5 cellspacing=2>

<tr align=LEFT valign=MIDDLE bgcolor="<?=$bgcolor2?>">
<td bgcolor="#999999" style="border-style: inset; border-width: 1px"><b>Property</b></td>
<td bgcolor="#999999" style="border-style: inset; border-width: 1px"><b>Valid Values</b></td>
<td bgcolor="#999999" style="border-style: inset; border-width: 1px"><b>Example</b></td>
<td bgcolor="#999999" style="border-style: inset; border-width: 1px"><b>Inherited?</b></td>
</tr>

<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">cursor</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">auto | crosshair | default | hand | move | e-resize | ne-resize | nw-resize | n-resize | se-resize | sw-resize | s-resize | w-resize | text | wait | help</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">{ cursor:hand; }</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">Y</font></td>
</tr>
<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">active, hover, link, visited</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">n/a</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">a:hover { color:red; }</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">Y</font></td>
</tr>

<tr align=LEFT valign=TOP >
<td  align="left" bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">first-letter, first-line</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">any font manipulating declaration</td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">p:first-letter{<br>
  float:left;color:blue<br>
  }<br>
  <font color="#FFFFFF">.</font></td>
<td bgcolor="#C0C0C0" style="border-style: inset; border-width: 1px">
<font color="#CC3300">N</font></td>
</tr>

</table>

<?php 
CloseTable();
include(NUKE_BASE_DIR.'footer.php');
?> 
