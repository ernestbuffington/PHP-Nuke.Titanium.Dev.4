<?php 
if(!defined('NUKE_EVO')) exit;
global $heading_color, $db, $textcolor1;

$heading_color = 'green';

$content = '<hr>';
$content .= '<div align="center">';
$content .= '<strong><span style="color:'.$heading_color.';">Dedicated Rack 68</span></strong><br />Intel(R) Xeon(R)<br /> CPU E3-1230 v5 @ 3.40GHz<br />Data Center: Tampa, Florida<br />Hosting: $500.00 Monthly';
$content .= '<hr>';
$content .= '<strong><span style="color:'.$heading_color.';">CMS</span></strong><br />PHP-Nuke Titanium v'.NUKE_TITANIUM.'<br />';
$content .= '<hr>';
$content .= '<strong><span style="color:'.$heading_color.';">Linux</span></strong><br />CENTOS 7.9.2009<br />x86_64<br />';
$content .= '<hr>';
$content .= '<strong><span style="color:'.$heading_color.';">EasyApache 4</span></strong><br />Apache 2.4.54<br />';
$content .= '<hr>';
$content .= '<strong><strong><span style="color:'.$heading_color.';">Perl</span></strong><br />Version: 5.16.3<br />';
$content .= '<hr>';
$content .= '<strong><strong><span style="color:'.$heading_color.';">cPanel</span></strong><br />106.0.11<br />';
$content .= '<hr>';
$content .= '<strong><strong><span style="color:'.$heading_color.';">PHP Version</span></strong><br />php-fpm '.PHPVERS.'<br />';
$content .= '<hr>';
$content .= '<strong><strong><span style="color:'.$heading_color.';">Mysqli Support</span></strong><br />'.mysqli_get_client_info().'<br />'.$db->mariadb_short_version().'';
$content .= '<hr>';
$content .= '<strong><strong><span style="color:'.$heading_color.';">cURL</span></strong><br />7.86.0<br />';
$content .= '<hr>';
$content .= '<strong><strong><span style="color:'.$heading_color.';">DOM/XML</span></strong><br /> API Version: 20031129<br />';
$content .= '<hr>';
$content .= '<strong><strong><span style="color:'.$heading_color.';">GD Version</span></strong><br />'; 
$content .= 'bundled (2.1.0 compatible)<br />';
$content .= '<hr>';
$content .= '<strong><strong><span style="color:'.$heading_color.';">JSON support</span></strong><br /> enabled<br />';
$content .= '<hr>';

$content .= '<strong><strong><span style="color:'.$heading_color.';">OpenSSL</span></strong><br />';
$content .= 'Version 1.1.1s 1 Nov 2022';
$content .= '<hr>';

$content .= '<strong><span style="color:'.$heading_color.';">Phar</span></strong><br />';
$content .= 'API version 1.1.1';
$content .= '<hr>';

$content .= '<strong><span style="color:'.$heading_color.';">Memcached</span></strong><br />';
$content .= 'Version 3.1.5';
$content .= '<hr>';

$content .= '</div>';

?>
