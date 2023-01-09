<?php
/*=======================================================================
 PHP-Nuke Titanium : Enhanced and Advanced Web Portal System 
 =======================================================================*/

/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts(tm) (http://www.nukescripts.86it.us) */
/* Copyright (c) 2000-2008 by NukeScripts(tm)           */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/

if(!defined('NUKE_EVO')) exit;

global $db, $prefix, $ab_config, $currentlang, $cache;

if(($total_ips = $cache->load('total_ips', 'titanium_sentienel_center_block')) === false) 
{
  $result = $db->sql_query('SELECT `reason` FROM `'.$prefix.'_nsnst_blocked_ips`');
  $total_ips = $db->sql_numrows($result);
  $db->sql_freeresult($result);
  $cache->save('total_ips', 'titanium_sentienel_center_block', $total_ips);
}

$content = '';

if(!$total_ips) 
{ 
  $total_ips = 0;
}
# June 16th, 2000 @ 6:16 pm
$time = '961179401';
 
$content .= '<div style="padding-top: 6px;"></div>';
$content .= '<div align="center"><img style="border-radius: 12px;" src="modules/NukeSentinel/images/nukesentinel_large.png" height="60" width="468" alt="'._AB_WARNED.'" title="'._AB_WARNED.'" /><br />Sentinel Portal Security has caught an estimated <strong>'.number_format($total_ips).'</strong> '._AB_SHAMEFULHACKERS.'</div>'."\n";
$content .= '<div style="padding-top: 6px;"></div>';
$content .= '<div align="center"><a href="http://nukescripts.86it.us" target="_blank">Copyright © 2000-2023 by NukeScripts.Net&trade;</a></div>'."\n";
$content .= '<div style="padding-top: 6px;"></div>';
$content .='<hr />';  

$content .='<div style="padding: 16px;">';
$content .= '<strong>Installed On:</strong>&nbsp;June 16th, 2000 at 6:16 pm<br />
<strong>Last upDate:</strong>&nbsp;Jan 1st, 2023<br />
<br />
<strong><h1>How injections are prevented by Bob Marion\'s PHP-Nuke Sentinel Portal Security addon:</h1></strong>

PHP-Nuke was created <strong>'.get_time_relative($time).' ago</strong>&nbsp;. It was a full-featured&nbsp;<strong> website/portal </strong>&nbsp;as we called them, it was all the craze.&nbsp;<strong>PHP-Nuke</strong>&nbsp;was something easy to install on the many free Web Hosting accounts that were available. It was the first <strong>CMS</strong> ever created and/or available  in internet history, and also came with lots of awesome features. But it had a price: It had unprofessional code, it was very unstable, and almost unmaintainable, and then last but not least it was horribly insecure. If you want to know why it had some of the security holes or problems that it had, you would have to take a look under the hood, maybe explore some of the old original source code, you would see right away why someone needed to organize re-write and clean up all the code. During the time of its production and release&nbsp;<strong>SQL injection</strong>&nbsp;and a few other security risks were a big problem: Search Engine, Contact Form, Forged Cookies, you name it. It was almost impossible to maintain so some internet <strong>PHP-Nuke</strong> enthusiast got togethor and added a much needed security layer, covering every security case you could imagine. Thus the birth of&nbsp;<strong>Sentinel Portal Security™</strong><br />
<br />
<strong>CURRENT FEATURES:</strong><br /><br />
&nbsp;&nbsp;<strong>1.</strong>&nbsp;&nbsp;&nbsp;Improved Scripting Attack filters.<br />
&nbsp;&nbsp;<strong>2.</strong>&nbsp;&nbsp;&nbsp;Repaired a couple of missing tags in admin pages.<br />
&nbsp;&nbsp;<strong>3.</strong>&nbsp;&nbsp;&nbsp;Updated Blocks for titles and compliance.<br />
&nbsp;&nbsp;<strong>4.</strong>&nbsp;&nbsp;&nbsp;Moved &quot;Country List&quot; link to the main menu.<br />
&nbsp;&nbsp;<strong>5.</strong>&nbsp;&nbsp;&nbsp;100% HTML / XHTML Compliant.<br />
&nbsp;&nbsp;<strong>6.</strong>&nbsp;&nbsp;&nbsp;The administrator can define the ability to have blocked users either:&nbsp; [A] Be forwarded to a page (or) [B] Be forwarded to an admin-defined URL.<br />
&nbsp;&nbsp;<strong>7.</strong>&nbsp;&nbsp;&nbsp;Enhanced Administration Functions.<br />
&nbsp;&nbsp;<strong>8.</strong>&nbsp;&nbsp;&nbsp;Writes information to Apache&#39;s .htaccess file. (For Increased Security on Blocking)<br />
&nbsp;&nbsp;<strong>9.</strong>&nbsp;&nbsp;&nbsp;Cleaned up coding and variables.<br />
<strong>10.&nbsp;&nbsp;</strong>&nbsp;Can now remove blocked ip&#39;s from Apache&#39;s .htaccess file while removing them from the DB.<br />
<strong>11.&nbsp;&nbsp;</strong>&nbsp;Can alter blocked ip&#39;s in Apache&#39;s .htaccess file while altering them in the DB.<br />
<strong>12.&nbsp;&nbsp;</strong>&nbsp;Improved paging system in the Administration area.<br />
<strong>13.&nbsp;&nbsp;</strong>&nbsp;Added Remote IP and User-Agent to the &quot;blocked&quot; page display.<br />
<strong>14.&nbsp;&nbsp;</strong>&nbsp;Added CLIKE protection with an on/off switch.<br />
<strong>15.&nbsp;&nbsp;</strong>&nbsp;Added UNION protection with an on/off switch.<br />
<strong>16.&nbsp;&nbsp;</strong>&nbsp;Added Harvester protection with an on/off switch.<br />
<strong>17.&nbsp;&nbsp;</strong>&nbsp;Added AUTHORS table protection with on/off switch.<br />
<strong>18.&nbsp;&nbsp;</strong>&nbsp;Improved speed relating to blocked ip checking.<br />
<strong>19.&nbsp;&nbsp;</strong>&nbsp;Added Page Sorting options for blocked ip pages.<br />
<strong>20.&nbsp;&nbsp;</strong>&nbsp;Added PC Killer option.<br />
<strong>21.&nbsp;&nbsp;</strong>&nbsp;Repaired PC Killer loop problem.<br />
<strong>22.&nbsp;&nbsp;</strong>&nbsp;Added &quot;Last 10 Blocked IPs&quot; block.<br />
<strong>23.&nbsp;&nbsp;</strong>&nbsp;Reconfigured the nsnst_config table.<br />
<strong>24.&nbsp;&nbsp;</strong>&nbsp;Repaired language file loading.<br />
<strong>25.&nbsp;&nbsp;</strong>&nbsp;Updated the lang-english.php file.<br />
<strong>26.&nbsp;&nbsp;</strong>&nbsp;Updated blockers to allow email only, block and email, and off.<br />
<strong>27.&nbsp;&nbsp;</strong>&nbsp;Repaired &quot;Edit Blocked IP&quot; routine.<br />
<strong>28.&nbsp;&nbsp;</strong>&nbsp;Repaired NukeSentinel(tm) Configuration.<br />
<strong>29.&nbsp;&nbsp;</strong>&nbsp;Now clears user sessions from both Nuke as well as Forums tables.<br />
<strong>30.&nbsp;&nbsp;</strong>&nbsp;Added a new block that shows IP lookups to the public as well as to admins.<br />
<strong>31.&nbsp;&nbsp;</strong>&nbsp;Added &quot;blocker type&quot; specific responses.<br />
<strong>32.&nbsp;&nbsp;</strong>&nbsp;Added the ability for block settings to now show ip lookup link and reason.<br />
<strong>33.&nbsp;&nbsp;</strong>&nbsp;Enabled Multiple email addresses for notifications. (may need work).<br />
<strong>34.&nbsp;&nbsp;</strong>&nbsp;Will match db stored IP addresses of xxx.*.*.* as global blocks.<br />
<strong>35.&nbsp;&nbsp;</strong>&nbsp;When blocking IP&#39;s it will use .* as the global range.<br />
<strong>36.&nbsp;&nbsp;</strong>&nbsp;Enabled Blocker-specific information to be written to Apache&#39;s .htaccess file(if your server supports it).<br />
<strong>37.&nbsp;&nbsp;</strong>&nbsp;Enabled Blocker specific forwarding.<br />
<strong>38.&nbsp;&nbsp;</strong>&nbsp;Enabled &quot;Protected Admins&quot; functions (Can only be set up by the &quot;God&quot; level Administrator)<br />
<strong>39.&nbsp;&nbsp;</strong>&nbsp;Enabled &quot;HTTP Auth&quot; function (If your server has PHP compiled as an Apache Module, but not if your server has PHP compiled in CGI Mode).<br />
<strong>40.&nbsp;&nbsp;</strong>&nbsp;Enabled &quot;Proxy Blocker&quot; capabilities with on/off switch.<br />
<strong>41.&nbsp;&nbsp;</strong>&nbsp;Enabled DOS (Denial Of Service) Attack Protection.<br />
<strong>42.&nbsp;&nbsp;</strong>&nbsp;Enabled Mouse-over &amp; Mouse-clicks Options in Help System.<br />
<strong>43.&nbsp;&nbsp;</strong>&nbsp;Enabled Mouse-clicks for Info System.<br />
<strong>44.&nbsp;&nbsp;</strong>&nbsp;Corrected problem with sites pulling your backend.php news feed.<br />
<strong>45.&nbsp;&nbsp;</strong>&nbsp;Reordered blockers for better trapping of attacks.<br />
<strong>46.&nbsp;&nbsp;</strong>&nbsp;Corrected a bad case for IP2C Searching.<br />
<strong>47.&nbsp;&nbsp;</strong>&nbsp;Corrected the is_god function. Around line 801 you can allow superusers in but as default, it requires God status.<br />
<strong>48.&nbsp;&nbsp;</strong>&nbsp;Corrected the blockers error of an empty set.<br />
<strong>49.&nbsp;&nbsp;</strong>&nbsp;Corrected a missing HELP define.<br />
<strong>50.&nbsp;&nbsp;</strong>&nbsp;Added Santy Worm protection (Thanks to NSN France)<br />
<strong>51.&nbsp;&nbsp;</strong>&nbsp;Added check box so you can return to the Add IP/Range screens faster<br />
<strong>52.&nbsp;&nbsp;</strong>&nbsp;Recoded includes/nukesentinel.php to load and run faster.<br />
<strong>53.&nbsp;&nbsp;</strong>&nbsp;Rebuilt the Search function to search all IP areas at once and display the results.<br />
<strong>54.&nbsp;&nbsp;</strong>&nbsp;Added test switch for HTTPAuth and register_globals. Helps prevent admins being locked out of admin.php.<br />
<strong>55.&nbsp;&nbsp;</strong>&nbsp;Added switch for Santy Worm protection.<br />
<strong>56.&nbsp;&nbsp;</strong>&nbsp;NEW import system for adding IP 2 Country data and importing Blocked Ranges.<br />
<strong>57.&nbsp;&nbsp;</strong>&nbsp;Created master globals in includes/nukesentinel.php for easier and faster processing.<br />
<strong>58.&nbsp;&nbsp;</strong>&nbsp;You can use the new master global by adding to your global lines throughout PHP-Nuke.<br />
<strong>59.&nbsp;&nbsp;</strong>&nbsp;Adapted for 7.7 WYSIWYG editor. (Thanks to WD-40)<br />
<strong>60.&nbsp;&nbsp;</strong>&nbsp;Enclosed table and field names with ` marks on SQL queries.<br />
<strong>61.&nbsp;&nbsp;</strong>&nbsp;Improved the Add IP 2 Country Range failure report page.<br />
<strong>62.&nbsp;&nbsp;</strong>&nbsp;includes/nukesentinel.php checks for the var and sets it if it isn&#39;t set.<br />
<strong>63.&nbsp;&nbsp;</strong>&nbsp;Added Country Listing page in IP 2 Country management. Now you can easily find the c2c codes.<br />
<strong>64.&nbsp;&nbsp;</strong>&nbsp;Changed the IP Tracking from a max number of lines to a max number of days.<br />
<strong>65.&nbsp;&nbsp;</strong>&nbsp;Added the gfx=gfx_little clause to prevent being tracked and wasting DB space.<br />
<strong>66.&nbsp;&nbsp;</strong>&nbsp;Removed unused code and language defines.<br />
<strong>67.&nbsp;&nbsp;</strong>&nbsp;Corrected a Search Results error.<br />
<strong>68.&nbsp;&nbsp;</strong>&nbsp;Re-ordered the lang file to prevent Undefined error.<br />
<strong>69.&nbsp;&nbsp;</strong>&nbsp;ChatServ updates to replace == &quot;&quot; to empty() in many locations.<br />
<strong>70.&nbsp;&nbsp;</strong>&nbsp;Updated Edit Instructions (Includes updates by ChatServ for Patched 3.1).<br />
<strong>71.&nbsp;&nbsp;</strong>&nbsp;Moved import directory out of the admin directory structure so it can be deleted after importing data easier.<br />
<strong>72.&nbsp;&nbsp;</strong>&nbsp;Added routines to check the range database table for overlaps.<br />
<strong>73.&nbsp;&nbsp;</strong>&nbsp;Updated import data (ip2country data from the NukeScripts site).<br />
<strong>74.&nbsp;&nbsp;</strong>&nbsp;NEW Flood Protection on GET and POST requests. (Thanks to Manuel)<br />
<strong>75.&nbsp;&nbsp;</strong>&nbsp;Added global for SERVER_ADDR as $nsnst_const[&#39;server_ip&#39;]. Can be useful in<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;other scripts to check if the request comes from your server or from a client.</p>';
$content .='</div>';
$content .='<hr />';  
$content .= '<br /><br /><br /><br /><br />';
?>