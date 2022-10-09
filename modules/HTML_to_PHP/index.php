<?php
if (!defined('MODULE_FILE')) {
   die('You can\'t access this file directly...');
}


$pagetitle = 'HTML to PHP';

require_once("mainfile.php");
$module = basename(dirname(__FILE__));
get_lang($module);
include("header.php");
$index = 0;
include("modules/$module/js/HTMLPHP.js");
title("$sitename: "._PNTINDEX."");
OpenTable();
  echo " <TABLE borderColor=blue cellSpacing=0 cellPadding=0 width=\"100%\" border=0>"
  . "<TBODY><TR><TD><TABLE borderColor=blue cellSpacing=0 cellPadding=0 width=\"100%\" border=0>"
  . "<TBODY><TR><TD align=middle>"
  . "<center><br><h4>"._HTMLC."</h4><BR>"
  . "<FORM name=htphp>"
  . "<TABLE cellSpacing=2 cellPadding=2 width=\"100%\" border=0>"
  . "<TBODY><TR><TD align=middle>"._PASTE."</TD></TR></TBODY></TABLE>"
  . "<TABLE cellSpacing=2 cellPadding=2 width=\"100%\" border=0>"
  . "<TBODY><TR><TD align=middle><TEXTAREA name=input rows=15 wrap=VIRTUAL cols=68></TEXTAREA> "
  . "</TD></TR><TR><TD align=middle>"._CONINFO."</TD></TR>"
  . "<TR><TD align=middle><TEXTAREA name=output rows=15 wrap=VIRTUAL cols=68></TEXTAREA> "
  . "</TD></TR><TR><TD align=middle><INPUT class=button onclick=htmlphp() type=button value="._CONVERT."> "
  . "<INPUT class=button onclick=javascript:this.form.output.focus();this.form.output.select(); type=button value="._SELEC." name=button wszystko> "
  . "<INPUT class=button onclick=reset(input.output) type=button value="._CLEAR."> "
  . "</TD></TR></FORM></CENTER></TD></TR>"
  . "<TR></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></CENTER></TD></TR></TBODY></TABLE>";
CloseTable();
include("footer.php");
?>