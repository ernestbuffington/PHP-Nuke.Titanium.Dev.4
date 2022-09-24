<?php
/************************************************************************/
/* Google-Site-Map Module 1.0 by Ernest Buffington 			            */
/* =================================                                    */
/* Copyright (c) 2021 by The 86it Developers Network          			*/
/* http://www.86it.us                                                   */
/************************************************************************/
if (!defined('MODULE_FILE')) 
die ("You can't access this file directly...");

$titanium_module_name = basename(dirname(__FILE__));

global $domain, $nukeurl, $titanium_prefix, $titanium_db, $sitename, $currentlang, $admin, $multilingual, $titanium_module_name, $admin_file, $titanium_user_prefix;

@require_once(NUKE_CLASSES_DIR.'class.sitemap.php');
use SitemapPHP\Sitemap;
$sitemap = new Sitemap($nukeurl);
$sitemap->setPath(NUKE_BASE_DIR.'xmls/sitemap/');
$sitemap->setFilename('sitemap');
$sitemap->addItem('/', '1.0', 'daily',  'Today');
$sitemap->createSitemapIndex($nukeurl.'/xmls/sitemap/', 'Today');

# Examples
# $sitemap->addItem('/contact', '0.6', 'yearly', '14-12-2009');
# $sitemap->addItem('/otherpage');

# Using the old Jmap admin panel
$result = $titanium_db->sql_query('SELECT * FROM `'.$titanium_prefix.'_jmap`');

while ($row=$titanium_db->sql_fetchrow($result)):
    $nametask = $row['name'];
    $value = $row['value'];
    $conf[$nametask]=$value;
endwhile;

$titanium_db->sql_freeresult($result);
$xml = $conf['xml'];
$ndown = $conf['ndown'];
$nnews = $conf['nnews'];
$nrev = $conf['nrev'];
$ntopics = $conf['ntopics'];
$nuser = $conf['nuser'];

//---------------------- Do some XML Shit BEGIN -----------------
if($xml):

else: 

endif;
//---------------------- Do some XML Shit  XML END -----------------

if (file_exists(NUKE_MODULES_DIR.$titanium_module_name.'/language/lang-'.$currentlang.'.php')):
	include_once(NUKE_MODULES_DIR.$titanium_module_name.'/language/lang-'.$currentlang.'.php');
else:
	include_once(NUKE_MODULES_DIR.$titanium_module_name.'/language/lang-english.php');
endif;

function downloads_subs($cid, $spaces, $xml) 
{
    $result4 = $titanium_db->sql_query("SELECT cid, title FROM " . $titanium_prefix . "_downloads_categories WHERE active=1 AND parentid=$cid1 ORDER BY title");
}

include_once(NUKE_BASE_DIR.'header.php');

Opentable();

print '<div align="center"><strong>'._GOOGLE_MAP.' '.$sitename.'</strong></div>';
print '<div align="center">';

# lock legend
print '<font color="violet"><i style="vertical-align: middle;" class="fa fa-unlock-alt"></i></font>&nbsp;&nbsp;';
print '<font color="green"><i style="vertical-align: middle;" class="fa fa-unlock-alt"></i></font>&nbsp;&nbsp;';
print '<font color="lime"><i style="vertical-align: middle;" class="fa fa-unlock-alt"></i></font>&nbsp;&nbsp;';
print '<font color="aqua"><i style="vertical-align: middle;" class="fa fa-unlock-alt"></i></font>&nbsp;<font size="1">(EVERYONE)</font>&nbsp;';
print '<font color="#FF0000"><i style="vertical-align: middle;" class="fa fa-lock"></i></font>&nbsp;<font size="1">(REGISTERED USERS ONLY)</font>&nbsp;';
print '</div><br/>';

print '<div align="center">';
print '<table style="background-color:#70163C;" class="googlesitemap" align="center" border="5" cellpadding="15" cellspacing="20" dir="ltr" id="googlesitemap">';
print '<tbody>';
print '<tr>';
print '<td align="center">';

print '<hr>';
print '<a href="'.$nukeurl.'">Homepage</a><hr>';
print '<table align="center" border="0">';

print '<tr><td></td><td align="center"></td></tr>'."\n";

$result2 = $titanium_db->sql_query("SELECT `title`, `custom_title`, `view`, `groups` FROM `" . $titanium_prefix . "_modules` WHERE `active` =1 ORDER BY `custom_title`");

while ($row2 = $titanium_db->sql_fetchrow($result2)): 


	$the_module_title = $row2['custom_title'];
	
	$link = $row2['title'];

	$permission = $row2['view'];
	
	$groups = $row2['groups'];
    
	$show = true;

	print '<tr><td>';

	if ($permission < 3): 
       # we do not want these in our sitemap
	   if(($link === 'Arcade_Tweaks')
	   || ($link === 'cPanel_Login')
	   || ($link === 'NukeSentinel')
	   || ($link === 'Shout_Box')
	   || ($link === 'Spambot_Killer')
	   || ($link === 'Google-Site-Map')
       ):
	   # dont do anything
	   else:

		print '&nbsp;&nbsp;&nbsp;<font color="lime"><i style="vertical-align: absmiddle;" class="fa fa-unlock-alt"></i>';

      endif;

	elseif ($permission == 4 && is_admin()): 
       # we do not want these in our sitemap
	   if(($link === 'Arcade_Tweaks')
	   || ($link === 'cPanel_Login')
	   || ($link === 'NukeSentinel')
	   || ($link === 'Shout_Box')
	   || ($link === 'Spambot_Killer')
	   || ($link === 'Google-Site-Map')
       ):
	   # dont do anything
	   else:

	    print '&nbsp;&nbsp;&nbsp;<font color="lime"><i style="vertical-align: absmiddle;" class="fa fa-unlock-alt"></i>';

      endif;
	elseif ($permission == 6 && !empty($groups) && is_array($groups)): 

	    $ingroup = false;
	    global $userinfo;
	
	    foreach ($groups as $group): 
		     if (isset($userinfo['groups'][$group])) 
		     $ingroup = true;
	    endforeach;
		
	if (!$ingroup):
      # we do not want these in our sitemap
	  if(($link === 'Arcade_Tweaks')
      || ($link === 'NukeSentinel')
	  || ($link === 'cPanel_Login')
      || ($link === 'Shout_Box')
      || ($link === 'Spambot_Killer')
	  || ($link === 'Google-Site-Map')
      ):
      # dont do anything
	  else:
        print '&nbsp;&nbsp;&nbsp;<font color="lime"><i style="vertical-align: absmiddle;" class="fa fa-unlock-alt"></i>';
      endif;		
	
		else: 
          # we do not want these in our sitemap
	      if(($link === 'Arcade_Tweaks')
	      || ($link === 'cPanel_Login')
	      || ($link === 'NukeSentinel')
	      || ($link === 'Shout_Box')
          || ($link === 'Spambot_Killer')
	      || ($link === 'Google-Site-Map')
          ):
	      # dont do anything
	      else:
		    print '&nbsp;&nbsp;&nbsp;<font color="#FF0000"><i style="vertical-align: absmiddle;" class="fa fa-lock"></i></font>&nbsp;';
			$show = false;
          endif;	    
		endif;
	 
	else: 
        # we do not want these in our sitemap
	    if(($link === 'Arcade_Tweaks')
	      || ($link === 'cPanel_Login')
	      || ($link === 'NukeSentinel')
	      || ($link === 'Shout_Box')
          || ($link === 'Spambot_Killer')
	      || ($link === 'Google-Site-Map')
          ):
	    # dont do anything
	    else:
	
		  print '&nbsp;&nbsp;&nbsp;<font color="#FF0000"><i style="vertical-align: absmiddle;" class="fa fa-lock"></i></font>&nbsp;';
		  $show = false;

        endif;	
	
	endif;

	print '</td>'."\n";
    # we do not want these in our sitemap
	if(($link === 'Arcade_Tweaks')
	|| ($link === 'cPanel_Login')
    || ($link === 'NukeSentinel')
    || ($link === 'Shout_Box')
    || ($link === 'Spambot_Killer')
	|| ($link === 'Google-Site-Map')
    ):
    # dont do anything
	else:

    # content module
	if($link === 'Content'):

     print '<td><a href="modules.php?name='.$link.'">'.$the_module_title.' &#187; A list of the available content on '.$sitename.'</a>&nbsp;&nbsp;&nbsp;</td></tr>'."\n";
     $sitemap->addItem('/modules.php?name='.$link.'', '0.8', 'monthly', 'Jun 25');
     
	 # groups module
	 elseif($link === 'Groups'):
     print '<td><a href="modules.php?name='.$link.'">'.$the_module_title.' &#187; A list of the available user groups on the '.$sitename.' web portal</a>&nbsp;&nbsp;&nbsp;</td></tr>';
     # Select all groups
	 global $titanium_prefix;
     $sql = $titanium_db->sql_query("select group_id, group_name from ".$titanium_prefix."_bbgroups where group_description <> 'Personal User'");
     while(list($group_id, $group_name) = $titanium_db->sql_fetchrow($sql)): 
       if (is_user())
       print '<td></td><td><font color="green"><i style="vertical-align: middle;" 
	   class="fa fa-lock"></i></font>&nbsp;<a href="modules.php?name=Groups&amp;g='.$group_id.'">Users Group &#187; '.$group_name.' &#187; Join Today</a></td></tr>'; 
	   else
       print '<td></td><td><font color="#FF0000"><i style="vertical-align: middle;" 
	   class="fa fa-lock"></i></font>&nbsp;<a href="modules.php?name=Groups&amp;g='.$group_id.'">Users Group &#187; '.$group_name.'</a><a  
	   href="modules.php?name=Your_Account&op=new_user"> &#187; Login or Create New User Account</a></td></tr>'; 
	   $sitemap->addItem('/modules.php?name=modules.php?name=Groups&g='.$group_id.'', '0.8', 'monthly', 'Jun 25');
     endwhile;
	 
	 # Feedback Module
	 elseif($link === 'Feedback'):
     print '<td><a href="modules.php?name='.$link.'">'.$the_module_title.' &#187; '.$sitename.'\'s Feedback form</a>&nbsp;&nbsp;&nbsp;</td></tr>'."\n";
     $sitemap->addItem('/modules.php?name='.$link.'', '0.8', 'yearly', 'Jun 25');

     # Your Account Module
	 elseif($link === 'Your_Account'):
     
	 if (is_user()):
	 print '<td><a href="modules.php?name='.$link.'">'.$the_module_title.' &#187; View your '.$sitename.' profile</a>&nbsp;&nbsp;&nbsp;</td></tr>'."\n";
     else:
	 print '<td><a href="modules.php?name='.$link.'">'.$the_module_title.' &#187; Login or Create a New User Account</a>&nbsp;&nbsp;&nbsp;</td></tr>'."\n";
	 endif;
	 $sitemap->addItem('/modules.php?name='.$link.'', '0.8', 'yearly', 'Jun 25');

	 elseif($link === 'Profile'):
     
	 if (is_user()):
	 print '<td><a href="modules.php?name='.$link.'">'.$the_module_title.' &#187; Change your profile settings</a>&nbsp;&nbsp;&nbsp;</td></tr>'."\n";
     else:
	 print '<td><a href="modules.php?name='.$link.'">'.$the_module_title.' &#187; Login or Create a New User Account</a>&nbsp;&nbsp;&nbsp;</td></tr>'."\n";
	 endif;
	 $sitemap->addItem('/modules.php?name='.$link.'', '0.8', 'yearly', 'Jun 25');
	 
	 elseif($link === 'Surveys'):
     print '<td><a href="modules.php?name='.$link.'">'.$the_module_title.' &#187; '.$sitename.'\'s surveys</a>&nbsp;&nbsp;&nbsp;</td></tr>'."\n";
     $sitemap->addItem('/modules.php?name='.$link.'', '0.8', 'daily', 'Today');

	 elseif($link === 'Supporters'):
     # xml is written below in the switch statement
     print '<td><a href="modules.php?name='.$link.'">'.$the_module_title.' &#187; If you support '.$sitename.' add your image and website link</a>&nbsp;&nbsp;&nbsp;</td></tr>'."\n";
     $sitemap->addItem('/modules.php?name='.$link.'', '0.8', 'daily', 'Today');

	 elseif($link === 'Statistics'):
     # xml is written below in the switch statement
     print '<td><a href="modules.php?name='.$link.'">'.$the_module_title.' &#187; '.$sitename.' portal statistics</a>&nbsp;&nbsp;&nbsp;</td></tr>'."\n";
     $sitemap->addItem('/modules.php?name='.$link.'', '0.8', 'daily', 'Today');

	 elseif($link === 'Search'):
     # xml is written below in the switch statement
     print '<td><a href="modules.php?name='.$link.'">'.$the_module_title.' &#187; Search the '.$sitename.' portal for information</a>&nbsp;&nbsp;&nbsp;</td></tr>'."\n";
     $sitemap->addItem('/modules.php?name='.$link.'', '0.8', 'daily', 'Today');

	 elseif($link === 'Reviews'):
     # xml is written below in the switch statement
     print '<td><a href="modules.php?name='.$link.'">'.$the_module_title.' &#187; '.$sitename.' reviews</a>&nbsp;&nbsp;&nbsp;</td></tr>'."\n";
     $sitemap->addItem('/modules.php?name='.$link.'', '0.8', 'daily', 'Today');

	 elseif($link === 'Recommend_Us'):
     # xml is written below in the switch statement
     print '<td><a href="modules.php?name='.$link.'">'.$the_module_title.' &#187; Recommend '.$sitename.' to a friend</a>&nbsp;&nbsp;&nbsp;</td></tr>'."\n";
     $sitemap->addItem('/modules.php?name='.$link.'', '0.8', 'yearly', 'Jun 5');

	 elseif($link === 'Private_Messages'):
     # xml is written below in the switch statement
     print '<td><a href="modules.php?name='.$link.'">'.$the_module_title.' &#187; Send messages to your online buddys</a>&nbsp;&nbsp;&nbsp;</td></tr>'."\n";

	 elseif($link === 'Network_Projects'):
     # xml is written below in the switch statement
     print '<td><a href="modules.php?name='.$link.'">'.$the_module_title.' &#187; Submit Support Requests or Report Bugs</a>&nbsp;&nbsp;&nbsp;</td></tr>'."\n";

	 elseif($link === 'Members_List'):
     # xml is written below in the switch statement
     print '<td><a href="modules.php?name='.$link.'">'.$the_module_title.' &#187; '.$sitename.'\'s Member list</a>&nbsp;&nbsp;&nbsp;</td></tr>'."\n";

	 elseif($link === 'File_Repository'):
     # xml is written below in the switch statement
     print '<td><a href="modules.php?name='.$link.'">'.$the_module_title.' &#187; Our download section is now called a File Repository</a>&nbsp;&nbsp;&nbsp;</td></tr>'."\n";
 
	 elseif($link === 'Bookmarks'):
     # xml is written below in the switch statement
     print '<td><a href="modules.php?name='.$link.'">'.$the_module_title.' &#187; Save all your important online links here</a>&nbsp;&nbsp;&nbsp;</td></tr>'."\n";
     $sitemap->addItem('/modules.php?name='.$link.'', '0.8', 'yearly', 'Jun 5');

	 elseif($link === 'Loan'):
     # xml is written below in the switch statement
     print '<td><a href="modules.php?name='.$link.'">'.$the_module_title.' &#187; The 30/360 US Rule by Truman Scott Buffington (ScottyBcoder)</a>&nbsp;&nbsp;&nbsp;</td></tr>'."\n";
     $sitemap->addItem('/modules.php?name='.$link.'', '0.8', 'yearly', 'Jun 5');
 
	 elseif($link === 'Link_Us'):
     # xml is written below in the switch statement
     print '<td><a href="modules.php?name='.$link.'">'.$the_module_title.' &#187; Help search engines find your portal by linking to '.$sitename.'</a>&nbsp;&nbsp;&nbsp;</td></tr>'."\n";
     $sitemap->addItem('/modules.php?name='.$link.'', '0.8', 'daily', 'Today');

	 elseif($link === 'Image_Repository'):
     # xml is written below in the switch statement
     print '<td><a href="modules.php?name='.$link.'">'.$the_module_title.' &#187; Host your images here on the '.$sitename.' website</a>&nbsp;&nbsp;&nbsp;</td></tr>'."\n";
     $sitemap->addItem('/modules.php?name='.$link.'', '0.8', 'daily', 'Today');

	 elseif($link === 'HTML_Newsletter'):
     # xml is written below in the switch statement
     print '<td><a href="modules.php?name='.$link.'">'.$the_module_title.' &#187; A list of '.$sitename.'\'s Archived News Letters</a>&nbsp;&nbsp;&nbsp;</td></tr>'."\n";
     $sitemap->addItem('/modules.php?name='.$link.'', '0.8', 'daily', 'Today');

	 elseif($link === 'Blog_Topics'):
     # xml is written below in the switch statement
     print '<td><a href="modules.php?name='.$link.'">'.$the_module_title.' &#187; A list of '.$sitename.'\'s blog topics</a>&nbsp;&nbsp;&nbsp;</td></tr>'."\n";
     $sitemap->addItem('/modules.php?name='.$link.'', '0.8', 'daily', 'Today');

	 elseif($link === 'Blog_Top'):
     # xml is written below in the switch statement
     print '<td><a href="modules.php?name='.$link.'">'.$the_module_title.' &#187; View '.$sitename.'\'s Top 10 Blogs</a>&nbsp;&nbsp;&nbsp;</td></tr>'."\n";
     $sitemap->addItem('/modules.php?name='.$link.'', '0.8', 'daily', 'Today');

	 elseif($link === 'FAQ'):
     # xml is written below in the switch statement
     print '<td><a href="modules.php?name='.$link.'">'.$the_module_title.' &#187; '.$sitename.'\'s Frequently asked questions</a>&nbsp;&nbsp;&nbsp;</td></tr>'."\n";
     $sitemap->addItem('/modules.php?name='.$link.'', '0.8', 'yearly', 'Jun 25');

	 elseif($link === 'ECalendar'):
     # xml is written below in the switch statement
     print '<td><a href="modules.php?name='.$link.'">'.$the_module_title.' &#187; '.$sitename.'\'s eCalendar</a>&nbsp;&nbsp;&nbsp;</td></tr>'."\n";
     $sitemap->addItem('/modules.php?name='.$link.'', '0.8', 'yearly', 'Jun 25');

	 elseif($link === 'Donations'):
     # xml is written below in the switch statement
     print '<td><a href="modules.php?name='.$link.'">'.$the_module_title.' &#187; Donate to the '.$sitename.' project</a>&nbsp;&nbsp;&nbsp;</td></tr>'."\n";
     $sitemap->addItem('/modules.php?name='.$link.'', '0.8', 'yearly', 'Jun 25');

	 elseif($link === 'Blog_Submit'):
     # xml is written below in the switch statement
     print '<td><a href="modules.php?name='.$link.'">'.$the_module_title.' &#187; Write a blog for '.$sitename.'</a>&nbsp;&nbsp;&nbsp;</td></tr>'."\n";
     $sitemap->addItem('/modules.php?name='.$link.'', '0.8', 'yearly', 'Jun 25');

	 elseif($link === 'Network'):
     # xml is written below in the switch statement
     print '<td><a href="modules.php?name='.$link.'">'.$the_module_title.' &#187; The 86it Developers Network Disclaimer</a>&nbsp;&nbsp;&nbsp;</td></tr>'."\n";

	 elseif($link === 'Docs'):
     # xml is written below in the switch statement
     print '<td><a href="modules.php?name='.$link.'">'.$the_module_title.' &#187; '.$sitename.'\'s Disclaimer</a>&nbsp;&nbsp;&nbsp;</td></tr>'."\n";

	 elseif($link === 'Blog_Archive'):
     # xml is written below in the switch statement
     print '<td><a href="modules.php?name='.$link.'">'.$the_module_title.' &#187; View '.$sitename.'\'s Blog history</a>&nbsp;&nbsp;&nbsp;</td></tr>'."\n";
     $sitemap->addItem('/modules.php?name='.$link.'', '0.8', 'monthly', 'Jun 25');

	 elseif($link === 'Blog'):
     # xml is written below in the switch statement
     print '<td><a href="modules.php?name='.$link.'">'.$the_module_title.' &#187; View '.$sitename.'\'s Blog content</a>&nbsp;&nbsp;&nbsp;</td></tr>'."\n";

	 elseif($link === 'Network_Advertising'):
     # xml is written below in the switch statement
     print '<td><a href="modules.php?name='.$link.'">'.$the_module_title.' &#187; JOIN OUR NETWORK ADVERTISING PROGRAM</a>&nbsp;&nbsp;&nbsp;</td></tr>'."\n";

	 elseif($link === 'Advertising'):
     # xml is written below in the switch statement
     print '<td><a href="modules.php?name='.$link.'">'.$the_module_title.' &#187; JOIN OUR PORTAL ADVERTISING PROGRAM</a>&nbsp;&nbsp;&nbsp;</td></tr>'."\n";

	 elseif($link === 'CSS_Color_Chart'):

     print '<td><a href="modules.php?name='.$link.'">'.$the_module_title.' &#187; A CSS Hex Color Chart</a>&nbsp;&nbsp;&nbsp;</td></tr>'."\n";
     $sitemap->addItem('/modules.php?name='.$link.'', '0.8', 'monthly', 'Jun 25');

	elseif($link === 'CSS_Reference'):

     print '<td><a href="modules.php?name='.$link.'">'.$the_module_title.' &#187; A CSS Code Refernce Chart</a>&nbsp;&nbsp;&nbsp;</td></tr>'."\n";
     $sitemap->addItem('/modules.php?name='.$link.'', '0.8', 'monthly', 'Jun 25');

	else:	
	 print '<td><a href="modules.php?name='.$link.'">'.$the_module_title.'</a></td></tr>'."\n";
    endif;

	endif;
    
	# include the language file for each module 
	if (file_exists(NUKE_MODULES_DIR.$link.'/language/lang-'.$currentlang.'.php')):
	include_once(NUKE_MODULES_DIR.$link.'/language/lang-'.$currentlang.'.php');
    else:
	include_once(NUKE_MODULES_DIR.$link.'/language/lang-english.php');
    endif;

	switch($link): 
		# Network Advertising #################################################################################################################################################
		case 'Network_Projects':
		global $network_prefix, $titanium_db2; 
        $projectresult = $titanium_db2->sql_query("SELECT `project_id` FROM `".$network_prefix."_projects` ORDER BY `weight`");
        while(list($project_id) = $titanium_db2->sql_fetchrow($projectresult)): 
          $project = pjprojectpercent_info($project_id);
		  print '<tr><td></td><td><font color="violet"><i style="vertical-align: absmiddle;" 
		  class="fa fa-unlock-alt"></i>&nbsp;</font><a href="modules.php?name=Network_Projects&amp;op=Project&amp;project_id='.$project_id.'">'.$project['project_name'].'</a>
		  &nbsp;&nbsp;</td>';
          $sitemap->addItem('/modules.php?name=Network_Projects&op=Project&project_id='.$project_id.'', '0.8', 'daily', 'Today');
	    endwhile;
		break;
		# Network Advertising #################################################################################################################################################
		case 'Network_Advertising':
		print '<tr><td></td><td><font color="violet"><i style="vertical-align: absmiddle;" 
		class="fa fa-unlock-alt"></i></font> <a 
		href="modules.php?name=Network_Advertising&op=network_ad_terms">'.$the_module_title.' &#187; Network Advertising Terms</a>&nbsp;&nbsp;</td>';
        $sitemap->addItem('/modules.php?name=Network_Advertising&op=network_ad_terms', '0.8', 'monthly', 'Jun 25');
		print '<tr><td></td><td><font color="violet"><i style="vertical-align: absmiddle;" 
		class="fa fa-unlock-alt"></i></font> <a 
		href="modules.php?name=Network_Advertising&op=ad_plans">'.$the_module_title.' &#187; Network Advertising Plans and Prices</a>&nbsp;&nbsp;</td>';
        $sitemap->addItem('/modules.php?name=Network_Advertising&op=ad_plans', '0.8', 'monthly', 'Jun 25');
		print '<tr><td></td><td><font color="violet"><i style="vertical-align: absmiddle;" 
		class="fa fa-unlock-alt"></i></font> <a 
		href="modules.php?name=Network_Advertising&op=network_ad_client">'.$the_module_title.' &#187; Network Advertising Client Login</a>&nbsp;&nbsp;</td>';
        $sitemap->addItem('/modules.php?name=Network_Advertising&op=network_ad_client', '0.8', 'monthly', 'Jun 25');
		break;
		# Portal Advertising #################################################################################################################################################
		case 'Advertising':
		print '<tr><td></td><td><font color="violet"><i style="vertical-align: absmiddle;" 
		class="fa fa-unlock-alt"></i></font> <a href="modules.php?name=Advertising&op=terms">'.$the_module_title.' &#187; Portal Advertising Terms</a>&nbsp;&nbsp;</td>';
        $sitemap->addItem('/modules.php?name=Advertising&op=terms', '0.8', 'monthly', 'Jun 25');
		print '<tr><td></td><td><font color="violet"><i style="vertical-align: absmiddle;" 
		class="fa fa-unlock-alt"></i></font> <a 
		href="modules.php?name=Advertising&op=plans">'.$the_module_title.' &#187; Portal Advertising Plans and Prices</a>&nbsp;&nbsp;</td>';
        $sitemap->addItem('/modules.php?name=Advertising&op=plans', '0.8', 'monthly', 'Jun 25');
		print '<tr><td></td><td><font color="violet"><i style="vertical-align: absmiddle;" 
		class="fa fa-unlock-alt"></i></font> <a href="modules.php?name=Advertising&op=client">'.$the_module_title.' &#187; Portal Advertising Client Login</a>&nbsp;&nbsp;</td>';
        $sitemap->addItem('/modules.php?name=Advertising&op=client', '0.8', 'monthly', 'Jun 25');
		break;
		# 86it Network Disclaimer #################################################################################################################################################
		case 'Network': 
		$sitemap->addItem('/modules.php?name=Network', '0.8', 'monthly', 'Jun 25');
		print '<tr><td></td><td><font color="violet"><i style="vertical-align: absmiddle;" 
		class="fa fa-unlock-alt"></i></font> <a href="modules.php?name=Network&file=about">'.$the_module_title.' &#187; About The 86it Developers Network</a>&nbsp;&nbsp;</td>';
        $sitemap->addItem('/modules.php?name=Network&file=about', '0.8', 'monthly', 'Jun 25');
		print '<tr><td></td><td><font color="violet"><i style="vertical-align: absmiddle;" 
		class="fa fa-unlock-alt"></i></font> <a 
		href="modules.php?name=Network&file=disclaimer">'.$the_module_title.' &#187; Disclaimer For The 86it Developers Network</a>&nbsp;&nbsp;</td>';
        $sitemap->addItem('/modules.php?name=Network&file=disclaimer', '0.8', 'monthly', 'Jun 25');
		print '<tr><td></td><td><font color="violet"><i style="vertical-align: absmiddle;" 
		class="fa fa-unlock-alt"></i></font> <a 
		href="modules.php?name=Network&file=privacy">'.$the_module_title.' &#187; Privacy Statement For The 86it Developers Network</a>&nbsp;&nbsp;</td>';
        $sitemap->addItem('/modules.php?name=Network&file=privacy', '0.8', 'monthly', 'Jun 25');
		print '<tr><td></td><td><font color="violet"><i style="vertical-align: absmiddle;" 
		class="fa fa-unlock-alt"></i></font> <a 
		href="modules.php?name=Network&file=terms">'.$the_module_title.' &#187; Network Terms For The 86it Developers Network</a>&nbsp;&nbsp;</td>';
        $sitemap->addItem('/modules.php?name=Network&file=terms', '0.8', 'monthly', 'Jun 25');
		break;
		# Portal Disclaimer #################################################################################################################################################
		case 'Docs': 
		$sitemap->addItem('/modules.php?name=Docs', '0.8', 'monthly', 'Jun 25');
		print '<tr><td></td><td><font color="violet"><i style="vertical-align: absmiddle;" 
		class="fa fa-unlock-alt"></i></font> <a href="modules.php?name=Docs&file=about">'.$the_module_title.' &#187; About '.$sitename.'</a>&nbsp;&nbsp;</td>';
        $sitemap->addItem('/modules.php?name=Docs&file=about', '0.8', 'monthly', 'Jun 25');
		print '<tr><td></td><td><font color="violet"><i style="vertical-align: absmiddle;" 
		class="fa fa-unlock-alt"></i></font> <a href="modules.php?name=Docs&file=disclaimer">'.$the_module_title.' &#187; Disclaimer For '.$sitename.'</a>&nbsp;&nbsp;</td>';
        $sitemap->addItem('/modules.php?name=Docs&file=disclaimer', '0.8', 'monthly', 'Jun 25');
		print '<tr><td></td><td><font color="violet"><i style="vertical-align: absmiddle;" 
		class="fa fa-unlock-alt"></i></font> <a href="modules.php?name=Docs&file=privacy">'.$the_module_title.' &#187; Privacy Statement For '.$sitename.'</a>&nbsp;&nbsp;</td>';
        $sitemap->addItem('/modules.php?name=Docs&file=privacy', '0.8', 'monthly', 'Jun 25');
		print '<tr><td></td><td><font color="violet"><i style="vertical-align: absmiddle;" 
		class="fa fa-unlock-alt"></i></font> <a href="modules.php?name=Docs&file=terms">'.$the_module_title.' &#187; Terms For '.$sitename.'</a>&nbsp;&nbsp;</td>';
        $sitemap->addItem('/modules.php?name=Docs&file=terms', '0.8', 'monthly', 'Jun 25');
		break;
		# Downloads #################################################################################################################################################
		case 'Downloads':
			$result3 = $titanium_db->sql_query("SELECT `cid`, `title` FROM `".$titanium_prefix."_downloads_categories` WHERE `active`=1 AND `parentid`=0 ORDER BY `title`");
			while ($row3 = $titanium_db->sql_fetchrow($result3)): 
				$titolodown = $row3['title'];
				$cid1 = $row3['cid'];
				print '<tr><td></td><td><font color="violet"><i style="vertical-align: absmiddle;" 
				class="fa fa-unlock-alt"></i></font> <a href="modules.php?name=Downloads&amp;cid='.$cid1.'">'.$titolodown.'</a></td>';
				if($xml):
                //@fwrite($var, '<url><loc>'.$nukeurl.'/modules.php?name=Downloads&amp;cid='.$cid1.'</loc></url>'."\n");
                endif;
			    $result4 = $titanium_db->sql_query('SELECT `cid`, `title` FROM `'.$titanium_prefix.'_downloads_categories` WHERE `active`=1 AND `parentid`="'.$cid1.'" ORDER BY `title`');
				while ($row4 = $titanium_db->sql_fetchrow($result4)): 
					$titolodown2 = $row4['title'];
					$cid2 = $row4['cid'];
					print '<tr><td></td><td><font color="green"><i style="vertical-align: middle;" 
					class="fa fa-unlock-alt"></i></font> <a href="modules.php?name=Downloads&amp;cid='.$cid2.'">'.$titolodown2.'</a></td>';
					if($xml):
                    //@fwrite($var, '<url><loc>'.$nukeurl.'/modules.php?name=Downloads&amp;cid='.$cid2.'</loc></url>'."\n");
                    endif;
				   $result4b = $titanium_db->sql_query('SELECT `cid`, 
				                                      `lid`, 
													`title` 
											   FROM `'.$titanium_prefix.'_downloads_downloads` 
											   WHERE `active`= 1 
											   AND `cid`="'.$cid2.'" 
											   ORDER BY `hits` LIMIT 0,'.$ndown);
				    while ($row4b = $titanium_db->sql_fetchrow($result4b)): 
        				$titolodown3=$row4b['title'];
						$cid3=$row4b['lid'];
						print '<tr><td></td><td><img src="modules/Google-Site-Map/images/catt.gif" alt="cat"> <a 
						href="modules.php?name=Downloads&amp;op=getit&amp;lid='.$cid3.'">'.$titolodown3.'</a></td>';
						if($xml):
                        //@fwrite($var, '<url><loc>'.$nukeurl.'/modules.php?name=Downloads&amp;op=getit&amp;lid='.$cid3.'</loc></url>'."\n");
						endif;
                    endwhile;
                    $titanium_db->sql_freeresult($result4b);
                endwhile;
                $titanium_db->sql_freeresult($result4);
			endwhile;
            $titanium_db->sql_freeresult($result3);
		break;
		# File Repository  #################################################################################################################################################
		case 'File_Repository':
			$result3 = $titanium_db->sql_query('SELECT `cid`, `cname` FROM `'.$titanium_prefix.'_file_repository_categories` WHERE `parentid`= 0 ORDER BY `cname`');
			while ($row3 = $titanium_db->sql_fetchrow($result3)):
				$titolodown = $row3['cname'];
				$cid1 = $row3['cid'];
				print '<tr><td></td><td><font color="violet"><i style="vertical-align: absmiddle;" 
				class="fa fa-unlock-alt"></i></font> <a href="modules.php?name=File_Repository&amp;cid='.$cid1.'">'.$titolodown.'</a></td>';
				if($xml):
                $sitemap->addItem('/modules.php?name=File_Repository&cid='.$cid1.'', '0.8', 'daily', 'Jun 25');
                endif;
				$result3b = $titanium_db->sql_query('SELECT `cid`, `did`, `title` FROM `'.$titanium_prefix.'_file_repository_items` WHERE `cid`="'.$cid1.'" ORDER BY `hits` LIMIT 0,'.$ndown);
				while ($row3b = $titanium_db->sql_fetchrow($result3b)):
					$titolodown3 = $row3b['title'];
					$cid3 = $row3b['did'];
					print '<tr><td></td><td><font color="green"><i style="vertical-align: middle;" class="fa 
					fa-unlock-alt"></i></font> <a 
					href="modules.php?name=File_Repository&amp;&action=view&amp;did='.$cid3.'">'.$titolodown3.'</a></td>';					
					if($xml):
                    $sitemap->addItem('/modules.php?name=File_Repository&action=view&did='.$cid3.'', '0.8', 'daily', 'Jun 25');
                    endif;
                endwhile;
                $titanium_db->sql_freeresult($result3b);	
                $result4 = $titanium_db->sql_query('SELECT `cid`, `cname` FROM `'.$titanium_prefix.'_file_repository_categories` WHERE `parentid`="'.$cid1.'" ORDER BY `cname`');
				while ($row4 = $titanium_db->sql_fetchrow($result4)):
					$titolodown2 = $row4['cname'];
					$cid2 = $row4['cid'];
					print '<tr><td></td><td><font color="green"><i style="vertical-align: middle;" class="fa 
					fa-unlock-alt"></i></font> <a href="modules.php?name=File_Repository&amp;cid='.$cid2.'">'.$titolodown2.'</a></td>';
					if($xml):
                    $sitemap->addItem('/modules.php?name=File_Repository&cid='.$cid2.'', '0.8', 'daily', 'Jun 25');
                    endif;
					$result4b = $titanium_db->sql_query('SELECT `cid`, `did`, `title` FROM `'.$titanium_prefix.'_file_repository_items` WHERE `cid`="'.$cid2.'" ORDER BY `hits` LIMIT 0,'.$ndown);
					while ($row4b = $titanium_db->sql_fetchrow($result4b)):
						$titolodown4 = $row4b['title'];
						$cid4 = $row4b['did'];
						print '<tr><td></td><td><font color="green"><i style="vertical-align: middle;" 
						class="fa fa-unlock-alt"></i></font> <a href="modules.php?name=File_Repository&amp;&action=view&amp;did='.$cid4.'">'.$titolodown4.'</a></td>';
						if($xml):
                        $sitemap->addItem('/modules.php?name=File_Repository&action=view&did='.$cid4.'', '0.8', 'daily', 'Jun 25');
						endif;
					endwhile;
					$titanium_db->sql_freeresult($result4b);
				endwhile;
				$titanium_db->sql_freeresult($result4);
			endwhile;
            $titanium_db->sql_freeresult($result3);
		break;
		# Forums  #################################################################################################################################################		
		case 'Forums':
			$result5 = $titanium_db->sql_query('SELECT `cat_id`, 
			                               `cat_title` 
									   FROM `'.$titanium_prefix.'_bbcategories` 
									   ORDER BY `cat_order`');
			while ($row5 = $titanium_db->sql_fetchrow($result5)): 
				$titolocatf = $row5['cat_title'];
				$cat_id = $row5['cat_id'];
				# Check to make sure its not a blank category
				$number_of_forums = $titanium_db->sql_numrows($titanium_db->sql_query('SELECT * FROM '.$titanium_prefix.'_bbforums 
				                                                     WHERE `cat_id`="'.$cat_id.'" 
																	 AND auth_view < 2 
																	 AND auth_read < 2 ORDER BY forum_order'));
				if ($number_of_forums <= 0) 
				continue;
				print '<tr><td></td><td><font color="violet"><i style="vertical-align: absmiddle;" 
				class="fa fa-unlock-alt"></i></font> <a href="modules.php?name=Forums&amp;file=index&amp;c='.$cat_id.'">'.$titolocatf.'</a></td>';
				if($xml):
                $sitemap->addItem('/modules.php?name=Forums&file=index&c='.$cat_id.'', '0.8', 'daily', 'Jun 25');
				endif;
				$result6 = $titanium_db->sql_query('SELECT `forum_name`,
				                                    `forum_id`,
												   `auth_view`,
												   `auth_read` 
										   FROM `'.$titanium_prefix.'_bbforums` 
										   WHERE `cat_id`="'.$cat_id.'" 
										   AND `auth_view`< 2 
										   AND `auth_read` < 2 
										   ORDER BY `forum_order`');
				while ($row6 = $titanium_db->sql_fetchrow($result6)): 
					$titoloforum = $row6['forum_name'];
					$fid = $row6['forum_id'];
					$auth_view = $row6['auth_view'];
					$auth_read = $row6['auth_read'];
					print '<tr><td></td><td>';
					if ($auth_view && !is_user()): 
						print '<font color="#FF0000"><i class="fa fa-lock"></i></font>';
						print $titoloforum.'</td></tr>';
					else: 
						print '&nbsp;&nbsp;&nbsp;&nbsp;<font color="green"><i style="vertical-align: absmiddle;" class="fa fa-unlock-alt"></i></font>&nbsp;';
						print  '<a href="modules.php?name=Forums&amp;file=viewforum&amp;f='.$fid.'">'.$titoloforum.'</a></td></tr>';
						if($xml):
                        $sitemap->addItem('/modules.php?name=Forums&file=viewforum&f='.$fid.'', '0.8', 'daily', 'Jun 25');
                        endif;
						$resultT = $titanium_db->sql_query('SELECT topic_title, topic_id FROM '.$titanium_prefix.'_bbtopics WHERE `forum_id`="'.$fid.'" ORDER BY topic_id DESC LIMIT 0,'.$ntopics);
						while($rowT = $titanium_db->sql_fetchrow($resultT)): 
						print '<tr><td></td><td>';
						print '&nbsp;&nbsp;&nbsp;&nbsp;<font color="darkgreen"><i style="vertical-align: middle;" 
						class="fa fa-unlock-alt"></i></font>&nbsp;';
						print '<a href="modules.php?name=Forums&amp;file=viewtopic&amp;t='.$rowT['topic_id'].'">'.$rowT['topic_title'].'</a></td>';
						if($xml):
                        $sitemap->addItem('/modules.php?name=Forums&file=viewtopic&t='.$rowT['topic_id'].'', '0.8', 'daily', 'Jun 25');
                        endif;
						endwhile;
                       $titanium_db->sql_freeresult($resultT);
					endif;
				endwhile;
				$titanium_db->sql_freeresult($result6);
			endwhile;
			$titanium_db->sql_freeresult($result5);
		break;
		# Sections  #################################################################################################################################################
		case 'Sections':
			$result7 = $titanium_db->sql_query('select `secid`, `secname`, `image` from `'.$titanium_prefix.'_sections` order by `secname`');
			while ($row7 = $titanium_db->sql_fetchrow($result7)): 
				$secid = $row7['secid'];
				$secname = $row7['secname'];
				$view = $row7['view'];
				print '<tr><td></td><td>';
				if($view==1): 
				print '<font color="#FF0000"><i class="fa fa-lock"></i></font>';
				else: 
				print '<i style="vertical-align: absmiddle;" class="fa fa-unlock-alt"></i></font> ';
				endif;
				print '<a href="modules.php?name=Sections&amp;op=listarticles&amp;secid='.$secid.'">'.$secname.'</a></td>';
				if($xml):
				$sitemap->addItem('/modules.php?name=Sections&op=listarticles&secid='.$secid.'', '0.8', 'monthly', 'Jun 25');
				endif;
			endwhile;
			$titanium_db->sql_freeresult($result7);
		break;
		# Web Links  #################################################################################################################################################
		case 'Web_Links':
			$result8 = $titanium_db->sql_query('SELECT `cid`, `title` from `'.$titanium_prefix.'_links_categories` where `parentid`="'.$cid.'" order by `title`');
			while ($row8 = $titanium_db->sql_fetchrow($result8)): 
				$titololink = $row8['title'];
				$cid1 = $row8['cid'];
				print '<tr><td></td><td><font color="green"><i style="vertical-align: absmiddle;" 
				class="fa fa-unlock-alt"></i></font> <a href="modules.php?name=Web_Links&amp;l_op=viewlink&amp;cid='.$cid1.'">'.$titololink.'</a></td>';
				if($xml):
			    $sitemap->addItem('/modules.php?name=Web_Links&l_op=viewlink&cid='.$cid1.'', '0.8', 'monthly', 'Jun 25');
				endif;
			endwhile;
            $titanium_db->sql_freeresult($result8);
		break;
		# Blog Topics  #################################################################################################################################################
		case 'Blog_Topics':
			$result9 = $titanium_db->sql_query("SELECT topictext,topicid FROM ".$titanium_prefix."_topics ORDER BY topictext");
			while ($row9 = $titanium_db->sql_fetchrow($result9)):
				$topiclink=$row9['topictext'];
				$cidtopic=$row9['topicid'];
				print '<tr><td></td><td><font color="green"><i 
				style="vertical-align: absmiddle;" class="fa fa-unlock-alt"></i></font> <a 
				href="modules.php?name=Blog_Topics&amp;cid='.$cidtopic.'">Blog Topic &#187; '.$topiclink.'</a></td>';
				if($xml):
		        $sitemap->addItem('/modules.php?name=Blog_Topics&cid='.$cidtopic.'', '0.8', 'monthly', 'Jun 25');
				endif;
            endwhile;
            $titanium_db->sql_freeresult($result9);
		break;
		# Blog  #################################################################################################################################################
		case 'Blog':
			$result10 = $titanium_db->sql_query('SELECT `title`, `sid` FROM `'.$titanium_prefix.'_stories` ORDER BY `sid` DESC LIMIT 0,'.$nnews);
			while ($row10 = $titanium_db->sql_fetchrow($result8)): 
				$newslink = $row10['title'];
				$cidnews = $row10['sid'];
				print '<tr><td></td><td><font color="green"><i 
				style="vertical-align: absmiddle;" class="fa fa-unlock-alt"></i></font> <a 
				href="modules.php?name=Blog&amp;file=article&amp;sid='.$cidnews.'">Blog Post &#187; '.$newslink.'</a></td>';
				if($xml):
		        $sitemap->addItem('/modules.php?name=Blog&file=article&sid='.$cidnews.'', '0.8', 'monthly', 'Jun 25');
				endif;
            endwhile;
            $titanium_db->sql_freeresult($result10);
		break;
		# Members List  #################################################################################################################################################
		case 'Members_List':
			$result11 = $titanium_db->sql_query('SELECT `username`, 
			                                    `user_id`, 
								   user_allow_viewonline 
								        
										FROM `'.$titanium_user_prefix.'_users` 
										ORDER BY `user_id` DESC LIMIT 0,'.$nuser);
		if ($show): 
			   while ($row11 = $titanium_db->sql_fetchrow($result11)): 
				if(($row11['user_allow_viewonline'] == 0) OR ($row11['username'] == 'Anonymous'))
			    continue;
				$titanium_user=$row11['username'];
				$ciduser=$row11['user_id'];
				print '<tr><td></td><td><font color="green"><i style="vertical-align: absmiddle;" 
				class="fa fa-unlock-alt"></i></font> <a 
				href="modules.php?name=Profile&amp;mode=viewprofile&amp;u='.$ciduser.'">PHP-Nuke Titanium &#187; User Profile &#187; '.$titanium_user.'</a></td>';
				if($xml):
                $sitemap->addItem('/modules.php?name=Profile&mode=viewprofile&u='.$ciduser.'', '0.8', 'daily', 'Today');
                endif;
			   endwhile;
            $titanium_db->sql_freeresult($result11);
		endif;
		break;
		# Reviews  #################################################################################################################################################
		case 'Reviews':
			$result12 = $titanium_db->sql_query('SELECT `title`, `id` FROM `'.$titanium_prefix.'_reviews` ORDER BY `id` DESC LIMIT 0,'.$nrev);
			while ($row12 = $titanium_db->sql_fetchrow($result12)): 
				$titrev=$row12['title'];
				$cidrev=$row12['id'];
				print '<tr><td></td><td><font color="green"><i style="vertical-align: absmiddle;" 
				class="fa fa-unlock-alt"></i></font> <a href="modules.php?name=Reviews&amp;rop=showcontent&amp;id='.$cidrev.'">'.$titrev.'</a></td>';
				if($xml):
				$sitemap->addItem('/modules.php?name=Reviews&rop=showcontent&id='.$cidrev.'', '0.8', 'daily', 'Today');
                endif;
            endwhile;
            $titanium_db->sql_freeresult($result12);
		break;
   endswitch;
endwhile;

$titanium_db->sql_freeresult($result2);
print '</table>';
print '<hr>';
if(defined('facebook')):	
global $content, $sid, $appID, $my_url;
print '<div id="fb-root"></div>'."\n";
print '<br /><script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v10.0&appId='.$appID.'&autoLogAppEvents=1" nonce="dv0pyfMc"></script>'."\n";
print '<div style="background-color: none" class="fb-like" data-href="https://'.$my_url.'/modules.php?name=Google-Site-Map" data-width="" data-layout="button_count" data-action="like" data-size="large" data-share="true"></div>'."\n";
endif;
print '<br/><br/><hr>';
print '<table style="background-color:none; height:100%;" class="googlesitemap" align="center" border="5" cellpadding="15" cellspacing="20" dir="ltr" id="googlesitemaplogo">';
print '<tbody>';
print '<tr>';
print '<td valign="top" align="center">';
print '<a href="https://github.com/evert/sitemap-php#readme" target="_tab">Sitemap</a><font color="lightblue"><font size ="5"><i style="vertical-align: absmiddle;" class="devicon-php-plain"></i></font>'."\n";
print '</td>';
print '</tr>';
print '</tbody>';
print '</table>';

print '<font color="lightgrey" size ="1">by Ernest Buffington, Evert Pot, David Oti, Osman Ungur, Mike Lay, Userlond, and Philipp Scheit</font><hr>';

print '</td>';

print '<tr>';
print '<td>&nbsp;';
print '</tr>';
print '</td>';

print '</tr>';
print '</tbody>';
print '</table>';
print '</div>';

print'
<script type="text/javascript">
 <!--
 function copy() {
   var w = 400;
   var h = 350;
   var l = Math.floor((screen.width-w)/2);
   var t = Math.floor((screen.height-h)/2);
      window.open("modules/Google-Site-Map/copyright.php","","width=" + w + ",height=" + h + ",top=" + t + ",left=" + l);
 }
 //-->
</script>';
print '<div align="center"><a href="javascript:copy()">&copy; Google Site Map</a></div>';

CloseTable();

if($xml):
//@fwrite($var, '</urlset>');
endif;
// FOOTER GRAPHIC
include_once(NUKE_BASE_DIR.'footer.php');

