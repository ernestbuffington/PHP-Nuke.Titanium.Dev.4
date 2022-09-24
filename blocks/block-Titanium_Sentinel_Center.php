<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System 
 =======================================================================*/

/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts(tm) (http://www.nukescripts.net)     */
/* Copyright (c) 2000-2008 by NukeScripts(tm)           */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/

if(!defined('NUKE_EVO')) exit;

global $block_title, $titanium_db, $titanium_prefix, $ab_config, $currentlang;

$block_title = 'NukeSentinel Security';
$content = '';
$result = $titanium_db->sql_query('SELECT `reason` FROM `'.$titanium_prefix.'_nsnst_blocked_ips`');
$total_phpbb2_ips = $titanium_db->sql_numrows($result);
$titanium_db->sql_freeresult($result);

$total_phpbb2_ips+=109729; 

if(!$total_phpbb2_ips) 
{ 
  $total_phpbb2_ips = 0;
}

$content .='<br />';
$content .= '<div align="center"><img src="modules/NukeSentinel/images/nukesentinel_large.png" height="60" width="468" alt="'._AB_WARNED.'" title="'._AB_WARNED.'" /><br />'._AB_HAVECAUGHT.' <strong>'.intval($total_phpbb2_ips).'</strong> '._AB_SHAMEFULHACKERS.'</div>'."\n";
$content .= '<br /><hr /><div align="center"><a href="http://nukescripts.86it.us" target="_blank">Copyright © 2000-2021 by NukeScripts&trade;</a></div><br />'."\n";

$content .= '<p><strong>Installed On:</strong>&nbsp;October 23rd, 2000<br />
<strong>Last upDate:</strong>&nbsp;April 7th, 2021<br />
<br />
<strong>How injections are prevented by our NukeSentinel CMS portal addon.</strong><br />
<br />
About&nbsp;<strong>17</strong>&nbsp;years ago, full-featured&nbsp;<strong>&laquo; website/portals &raquo;</strong>&nbsp;as we called them, were all the craze.&nbsp;<strong>PHP-Nuke</strong>&nbsp;was something easy to install on the many free Web Hosting accounts that were available. It was the first <strong>CMS</strong> ever created and/or available and also came with lots of awesome features. But it had a price: It had unprofessional code, it was very unstable, and almost unmaintainable, and then last but not least it was horribly insecure. If you want to know why it has some of the security holes or problems that it had, you would have to take a look under the hood, maybe explore some of the old original source code, you would see right away why someone needed to organize re-write and clean up. During the time of its production and release&nbsp;<strong>SQL injection</strong>&nbsp;and a few other security risks were a big problem: Search Engine, Contact Form, Forged Cookies, you name it. It was almost impossible to maintain so some folks got togethor and added a security layer, covering every security case you could imagine. Thus the birth of&nbsp;<strong>NukeSentinel</strong>...<br />
<br />
<strong>CURRENT FEATURES:</strong><br />
&nbsp;&nbsp;&nbsp;<strong>1.</strong>&nbsp;&nbsp;&nbsp;Improved Scripting Attack filters.<br />
&nbsp;&nbsp;<strong>2.</strong>&nbsp;&nbsp;&nbsp;Repaired a couple of missing tags in admin pages.<br />
&nbsp;&nbsp;<strong>3.</strong>&nbsp;&nbsp;&nbsp;Updated Blocks for titles and compliance.<br />
&nbsp;&nbsp;<strong>4.</strong>&nbsp;&nbsp;&nbsp;Moved &quot;Country List&quot; link to the main menu.<br />
&nbsp;&nbsp;<strong>5.</strong>&nbsp;&nbsp;&nbsp;100% W3C XHTML 1.0 Transitional Compliant.<br />
&nbsp;&nbsp;<strong>6.</strong>&nbsp;&nbsp;&nbsp;The administrator can define the ability to have blocked users either: a) be forwarded to a page (or) b) be forwarded to an admin-defined URL.<br />
&nbsp;&nbsp;<strong>7.</strong>&nbsp;&nbsp;&nbsp;Enhanced Administration Functions.<br />
&nbsp;&nbsp;<strong>8.</strong>&nbsp;&nbsp;&nbsp;Writes information to Apache&#39;s .htaccess file (for increased security on blocking).<br />
&nbsp;&nbsp;<strong>9.</strong>&nbsp;&nbsp;&nbsp;Cleaned up coding and variables.<br />
<strong>10.</strong>&nbsp;Can now remove blocked ip&#39;s from Apache&#39;s .htaccess file while removing them from the DB.<br />
<strong>11.</strong>&nbsp;Can alter blocked ip&#39;s in Apache&#39;s .htaccess file while altering them in the DB.<br />
<strong>12.</strong>&nbsp;Improved paging system in the Administration area.<br />
<strong>13.</strong>&nbsp;Added Remote IP and User-Agent to the &quot;blocked&quot; page display.<br />
<strong>14.</strong>&nbsp;Added CLIKE protection with an on/off switch.<br />
<strong>15.</strong>&nbsp;Added UNION protection with an on/off switch.<br />
<strong>16.</strong>&nbsp;Added Harvester protection with an on/off switch.<br />
<strong>17.</strong>&nbsp;Added AUTHORS table protection with on/off switch.<br />
<strong>18.</strong>&nbsp;Improved speed relating to blocked ip checking.<br />
<strong>19.</strong>&nbsp;Added Page Sorting options for blocked ip pages.<br />
<strong>20.</strong>&nbsp;Added PC Killer option.<br />
<strong>21.</strong>&nbsp;Repaired PC Killer loop problem.<br />
<strong>22.</strong>&nbsp;Added &quot;Last 10 Blocked IPs&quot; block.<br />
<strong>23.</strong>&nbsp;Reconfigured the nsnst_config table.<br />
<strong>24.</strong>&nbsp;Repaired language file loading.<br />
<strong>25.</strong>&nbsp;Updated the lang-english.php file.<br />
<strong>26.</strong>&nbsp;Updated blockers to allow email only, block and email, and off.<br />
<strong>27.</strong>&nbsp;Repaired &quot;Edit Blocked IP&quot; routine.<br />
<strong>28.</strong>&nbsp;Repaired NukeSentinel(tm) Configuration.<br />
<strong>29.</strong>&nbsp;Now clears user sessions from both Nuke as well as Forums tables.<br />
<strong>30.</strong>&nbsp;Added a new block that shows IP lookups to the public as well as to admins.<br />
<strong>31.</strong>&nbsp;Added &quot;blocker type&quot; specific responses.<br />
<strong>32.</strong>&nbsp;Added the ability for block settings to now show ip lookup link and reason.<br />
<strong>33.</strong>&nbsp;Enabled Multiple email addresses for notifications. (may need work).<br />
<strong>34.</strong>&nbsp;Will match db stored IP addresses of xxx.*.*.* as global blocks.<br />
<strong>35.</strong>&nbsp;When blocking IP&#39;s it will use .* as the global range.<br />
<strong>36.</strong>&nbsp;Enabled Blocker-specific information to be written to Apache&#39;s .htaccess file(if your server supports it).<br />
<strong>37.</strong>&nbsp;Enabled Blocker specific forwarding.<br />
<strong>38.</strong>&nbsp;Enabled &quot;Protected Admins&quot; functions (Can only be set up by the &quot;God&quot; level Administrator)<br />
<strong>39.</strong>&nbsp;Enabled &quot;HTTP Auth&quot; function (If your server has PHP compiled as an Apache Module, but not if your server has PHP compiled in CGI Mode).<br />
<strong>40.</strong>&nbsp;Enabled &quot;Proxy Blocker&quot; capabilities with on/off switch.<br />
<strong>41.</strong>&nbsp;Enabled DOS (Denial Of Service) Attack Protection.<br />
<strong>42.</strong>&nbsp;Enabled Mouse-over &amp; Mouse-clicks Options in Help System.<br />
<strong>43.</strong>&nbsp;Enabled Mouse-clicks for Info System.<br />
<strong>44.</strong>&nbsp;Corrected problem with sites pulling your backend.php news feed.<br />
<strong>45.</strong>&nbsp;Reordered blockers for better trapping of attacks.<br />
<strong>46.</strong>&nbsp;Corrected a bad case for IP2C Searching.<br />
<strong>47.</strong>&nbsp;Corrected the is_god function. Around line 801 you can allow superusers in but as default, it requires God status.<br />
<strong>48.</strong>&nbsp;Corrected the blockers error of an empty set.<br />
<strong>49.</strong>&nbsp;Corrected a missing HELP define.<br />
<strong>50.</strong>&nbsp;Added Santy Worm protection (Thanks to NSN France)<br />
<strong>51.</strong>&nbsp;Added check box so you can return to the Add IP/Range screens faster<br />
<strong>52.</strong>&nbsp;Recoded includes/nukesentinel.php to load and run faster.<br />
<strong>53.</strong>&nbsp;Rebuilt the Search function to search all IP areas at once and display the results.<br />
<strong>54.</strong>&nbsp;Added test switch for HTTPAuth and register_globals. Helps prevent admins being locked out of admin.php.<br />
<strong>55.</strong>&nbsp;Added switch for Santy Worm protection.<br />
<strong>56.</strong>&nbsp;NEW import system for adding IP 2 Country data and importing Blocked Ranges.<br />
<strong>57.</strong>&nbsp;Created master globals in includes/nukesentinel.php for easier and faster processing.<br />
<strong>58.</strong>&nbsp;You can use the new master global by adding to your global lines throughout PHP-Nuke.<br />
<strong>59.</strong>&nbsp;Adapted for 7.7 WYSIWYG editor. (Thanks to WD-40)<br />
<strong>60.</strong>&nbsp;Enclosed table and field names with ` marks on SQL queries.<br />
<strong>61.</strong>&nbsp;Improved the Add IP 2 Country Range failure report page.<br />
<strong>62.</strong>&nbsp;includes/nukesentinel.php checks for the var and sets it if it isn&#39;t set.<br />
<strong>63.</strong>&nbsp;Added Country Listing page in IP 2 Country management. Now you can easily find the c2c codes.<br />
<strong>64.</strong>&nbsp;Changed the IP Tracking from a max number of lines to a max number of days.<br />
<strong>65.</strong>&nbsp;Added the gfx=gfx_little clause to prevent being tracked and wasting DB space.<br />
<strong>66.</strong>&nbsp;Removed unused code and language defines.<br />
<strong>67.</strong>&nbsp;Corrected a Search Results error.<br />
<strong>68.</strong>&nbsp;Re-ordered the lang file to prevent Undefined error.<br />
<strong>69.</strong>&nbsp;ChatServ updates to replace == &quot;&quot; to empty() in many locations.<br />
<strong>70.</strong>&nbsp;Updated Edit Instructions (Includes updates by ChatServ for Patched 3.1).<br />
<strong>71.</strong>&nbsp;Moved import directory out of the admin directory structure so it can be deleted after importing data easier.<br />
<strong>72.</strong>&nbsp;Added routines to check the range database table for overlaps.<br />
<strong>73.</strong>&nbsp;Updated import data (ip2country data from the NukeScripts site).<br />
<strong>74.</strong>&nbsp;NEW Flood Protection on GET and POST requests. (Thanks to Manuel)<br />
<strong>75.</strong>&nbsp;Added global for SERVER_ADDR as $nsnst_const[&#39;server_ip&#39;]. Can be useful in<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;other scripts to check if the request comes from your server or from a client.</p>';

$content .= '<strong>75.</strong> Added global for SERVER_ADDR as $nsnst_const[\'server_ip\']. Can be useful in<br />';
$content .= "       other scripts to check if the request comes from your server or from a client.<br />";
$content .='<hr />';  
$content .= '<br /><br /><br /><br /><br />';
?>