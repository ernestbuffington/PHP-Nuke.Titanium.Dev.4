<?php
#########################################################################
# Titanium Blogs Top 100 v1.0                                           #
#########################################################################
# PHP-Nuke Titanium : Enhanced PHP-Nuke Web Portal System               #
#########################################################################
# [CHANGES]                                                             #
# Table Header Module Fix by TheGhost               v1.0.0   01/30/2012 #
# Nuke Patched                                      v3.1.0   06/26/2005 #
#########################################################################
define('CP_INCLUDE_DIR', dirname(dirname(dirname(__FILE__))));
require_once(CP_INCLUDE_DIR.'/includes/showcp.php');

$module_name = basename(dirname(__FILE__));
$mod_name = "CSS Color Chart";
$author_email = "";
$author_homepage = "";
$author_name = "";
$license = "";
$based_on = "Scratch";
$download_location = "";
$module_version = "v5.4";
$release_date = "02/09/2012";
$module_description = "CSS Color Chart Module";
$mod_cost = "";
show_copyright($author_name, $author_email, $author_homepage, $based_on, $license, $download_location, $module_version, $module_description, $release_date, $mod_cost);
?>