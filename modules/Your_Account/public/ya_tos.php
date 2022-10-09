<?php
/*=============================================================================== 
   PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 ================================================================================*/

/*********************************************************************************/
/* CNB Your Account: An Advanced User Management System for phpnuke              */
/* ============================================                                  */
/*                                                                               */
/* Copyright (c) 2004 by Comunidade PHP Nuke Brasil                              */
/* http://dev.phpnuke.org.br & http://www.phpnuke.org.br                         */
/*                                                                               */
/* Contact author: escudero@phpnuke.org.br                                       */
/* International Support Forum: http://ravenphpscripts.com/forum76.html          */
/*                                                                               */
/* This program is free software. You can redistribute it and/or modify          */
/* it under the terms of the GNU General Public License as published by          */
/* the Free Software Foundation; either version 2 of the License.                */
/*                                                                               */
/*********************************************************************************/
/* CNB Your Account is the official successor of NSN Your Account by Bob Marion  */
/*********************************************************************************/

/********************************************************/
/* TOS Pluggin sixonetonoffun http://www.netflake.com   */
/* Simple Agree to Terms mod for CNBYA                  */
/********************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/
if (!defined('MODULE_FILE')) die ("You can't access this file directly...");

if (!defined('CNBYA')) die('CNBYA protection');

  include_once(NUKE_BASE_DIR.'header.php');
  
  title(_USERAPPLOGIN);
  
  $sel1 = "checked";
  $sel2 = "";

  # menelaos: shows top table (differently for new users and current members)
  OpenTable();
  if ($setinfo['agreedtos'] == '0') 
  echo "<img src=\"modules/$module_name/images/warning.png\" align=\"left\" width=\"40\" height=\"40\"><div align=\"center\">"._YATOSINTRO1."</div></td>\n";
  else 
  echo "<img src=\"modules/$module_name/images/warning.png\" align=\"left\" width=\"40\" height=\"40\"><div align=\"center\">"._YATOSINTRO2."</div></td>\n";
  CloseTable();
  
  # menelaos: shows bottom table (differently for new users and current members)
  OpenTable();
  
  echo "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"5\" border=\"0\"><tr align=\"center\">";
  
  if ($setinfo['agreedtos'] == '0'):
    echo "<form name=\"tos1\" action=\"modules.php?name=$module_name\" method=\"POST\"><td colspan=\"2\">\n";
    echo "<input type=\"hidden\" name=\"username\" value=$username>\n";
    echo "<input type=\"hidden\" name=\"user_password\" value=$user_password>\n";
    echo "<input type=\"hidden\" name=\"random_num\" value=$random_num>\n";
    echo "<input type=\"hidden\" name=\"gfx_check\" value=$gfx_check>\n";
    echo "<input type=\"hidden\" name=\"redirect\" value=$redirect>\n";
    echo "<input type=\"hidden\" name=\"mode\" value=$mode>\n";
    echo "<input type=\"hidden\" name=\"f\" value=$f>\n";
    echo "<input type=\"hidden\" name=\"t\" value=$t>\n";
    echo "<input type=\"hidden\" name=\"op\" value=\"login\">\n";
  else:
    echo "<form name=\"tos1\" action=\"modules.php?name=$module_name&amp;op=new_user\" method=\"POST\"><td colspan=\"2\">\n";
  endif;

  if($_POST['coppa_yes']== intval(1)) 
  echo "<input type=\"hidden\" name=\"coppa_yes\" value='1'>\n";
  
  if (isset($_POST['tos_yes']) AND $ya_config['tos'] == intval(1)): 
    if ($setinfo[agreedtos] == '0'): 
    echo "</td><td align=\"center\"><font color=\"#FF3333\">"._YATOS5."</font>\n";
	else: 
    echo "</td><td align=\"center\"><br /><font size=\"4\" color=\"#FF3333\"><strong>- NEW MEMBERS NEED TO AGREE TO OUR NETWORK TERMS! -</strong></font>\n";
    endif;
    echo "<br /><br /><input type=\"submit\" value='"._YA_GOBACK."'>\n";
  else: 
    echo "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"20\" border=\"1\"><tr><td class=\"title\">";
    # space at the top of the page
    echo '<div align="center" style="padding-top:20px;">';
    echo '</div>';
	
	echo "<strong><div align=\"center\"><h1>$sitename - "._YATOS1."</h1></div></strong>";
    echo "".nl2br(decode_bbcode(set_smilies($ya_config['tos_text']),1,true)).""; 
    echo "</td></tr></table>";
    echo "</td></tr>";
    echo "<tr align=\"center\"><td width=\"100%\" valign=\"middle\"><a href=\"modules.php?name=Network&amp;file=terms\" target=\"popup\">Click Here</a> To view our Network Terms of Use!<br />";
    echo ""._YATOS3." <label><input type=\"radio\" name=\"tos_yes\" value='1' $sel2>&nbsp;"._YES."</div> <input type=\"radio\" name=\"tos_yes\" value='0' $sel1>&nbsp;"._NO."</label>";
	# space at the top of the page
    echo '<div align="center" style="padding-top:1px;">'; 
    echo '</div>';

    echo "<br /><input type=\"submit\" value='"._YA_CONTINUE."'</td>";
	echo "<td align=\"center\">";
  endif;
  
    echo "</td></form></tr>";
    echo "</table>";
    # space at the top of the page
    echo '<div align="center" style="padding-top:1px;">';
    echo '&nbsp;</div>';
  
  CloseTable();
  include_once(NUKE_BASE_DIR.'footer.php');
?>
