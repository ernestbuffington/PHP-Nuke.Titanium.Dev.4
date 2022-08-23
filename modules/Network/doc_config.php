<?php
#########################################################################
# Titanium Network Information v2.0                                     #
#########################################################################
# PHP-Nuke Titanium : Enhanced PHP-Nuke Web Portal System               #
#########################################################################
# [CHANGES]                                                             #
# Table Header Module Fix by TheGhost               v1.0.0   01/30/2012 #
# Nuke Patched                                      v3.1.0   06/26/2005 #
#########################################################################
/*********************************************
  CPG-NUKE: Advanced Content Management System
  ********************************************
  A highly modified version of PHP-Nuke 6.5
  which is Copyright (c) 2002 by Francisco Burzi
  http://phpnuke.org

  Under the GNU General Public License version 2

  Website Document Mod v1.0
  Copyright (c) 2002 by Shawn Archer
  http://www.nukestyles.com

  CPG-Nuke Port
  Copyright (c) 2004 by Trevor E
  from http://www.cpgnuke.com

***********************************************/

// Choose your settings below. If you don't to use a particular page,
// then set the number 1 to a number 0 for 'off'.
########################################

// Show the About Us page link?

$aboutus = 1;

########################################

// Show the Disclaimer Statement link?

$disclaimer = 1;

########################################

// Show the Privacy Statement link?

$privacy = 1;

########################################

// Show the Terms of Service link?

$terms = 1;

########################################

// Use the Contact Module or Feedback Module for questions pertaining
// to your Docs... or None?   0 = None   1 = Contact   2 = Feedback

$questions = 2;

########################################
################################################################
#                                                              #
#   DO NOT TOUCH CODE BELOW, UNLESS YOU KNOW WHAT YOUR DOING   #
#                                                              #
################################################################
function ns_doc_questions() {
    global $questions, $module_name, $sitename;
  if ((is_active("Feedback")) && $questions == 2) {
        echo _NSFEEDBACK;
    } else if ((is_active("Contact")) && $questions == 1) {
        echo ""._NSCONTACT."";
    } else if ($questions == 0) {
        echo "<br /><br />";
    }
}

function ns_doc_links() 
{
    global $aboutus, $disclaimer, $privacy, $terms, $module_name;
    echo "<div align=\"center\">";
    if ($aboutus == 1) echo "[ <a href=\"modules.php?name=$module_name&amp;file=about\">"._NSABOUTUS."</a> ]";
    if ($aboutus == 1 && $disclaimer == 1) echo " - ";
    if ($disclaimer == 1) echo "[ <a href=\"modules.php?name=$module_name&amp;file=disclaimer\">"._NSDISCLAIMER."</a> ]";
    if ($disclaimer == 1 && $privacy == 1) echo " - ";
    if ($privacy == 1) echo "[ <a href=\"modules.php?name=$module_name&amp;file=privacy\">"._NSPRIVACY."</a> ]";
    if (($privacy == 1 || $aboutus == 1 || $disclaimer ==1) AND ($terms == 1)) echo " - ";
    if ($terms == 1) echo "[ <a href=\"modules.php?name=$module_name&amp;file=terms\">"._NSTERMS."</a> ]";
    echo "</div><br /><br />";
}

?>