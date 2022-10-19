<?php
#---------------------------------------------------------------------------------------#
# HEADER NAVIGATION SYSTEM                                                              #
#---------------------------------------------------------------------------------------#
# THEME INFO                                                                            #
# Xtreme Core v1.0 (Fixed & Full Width)                                                 #
#                                                                                       #
# Final Build Date 05/04/2021 Tuesday 12:54am                                           #
#                                                                                       #
# A Very Nice Gold Theme Design.                                                        #
# Copyright © 2021 : Brandon Maintenance Management                                     #
# e-Mail : brandon.maintenance.management@gmail.com                                     #
#---------------------------------------------------------------------------------------#
# CREATION INFO                                                                         #
# Created On: 05/04/2021 Tuesday 12:54am (v1.0)                                         #
#                                                                                       #
#                                                                                       #
# Read CHANGELOG File for Updates & Upgrades Info                                       ## Designed By: Ernest Buffington                                                        #
# Web Site: https://www.theghost.86it.us                                                #
# Purpose: PHP-Nuke Titanium v4.0.2                                                     #
#---------------------------------------------------------------------------------------#
# CMS INFO                                                                              #
# PHP-Nuke Copyright (c) 2002    : Francisco Burzi phpnuke.org                          #
# Nuke Evolution Xtreme (c) 2010 : Enhanced PHP-Nuke Web Portal System                  #
# PHP-Nuke Titanium (c) 2022     : Enhanced and Advanced PHP-Nuke Web Portal System     #
#---------------------------------------------------------------------------------------#
# Special Honorable Mentions                                                            #
#---------------------------------------------------------------------------------------#
# killigan                                                                              # 
# -[04/17/2010] Updated Nuke Sentinel to version 2.6.01                                 # 
# -[04/17/2010] Updated Nuke Evolution to XHTML 1.0 Transitional                        #
#---------------------------------------------------------------------------------------#
# SgtLegend                                                                             #   
# -[04/17/2010] Updated Nuke Evolution to XHTML 1.0 Transitional                        #
# -[04/18/2010] Updated the installer/upgrade files and display                         #
# -[04/19/2010] Improved load time for global variables                                 #
# -[04/21/2010] Upgraded Swift mail to version 4.0.6                                    #
# -[04/21/2010] Upgraded HTML Purifier to version 4                                     # 
#---------------------------------------------------------------------------------------#
# Technocrat                                                                            # 
# -[04/22/2010] Added speed tweaks to the cache and PHP version compare                 #  
#---------------------------------------------------------------------------------------#
# Eyecu                                                                                 # 
# -[04/17/2010] Updated Nuke Evolution to XHTML 1.0 Transitional                        #
#---------------------------------------------------------------------------------------#
# Wolfstar                                                                              # 
# -[04/17/2010] Updated Nuke Evolution to XHTML 1.0 Transitional                        #
#---------------------------------------------------------------------------------------#

#------------------------------------#
# CSS Drop-Down Navigation System v9 #
#------------------------------------#
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])){ exit('Access Denied');}

global $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4, $user, $cookie, $prefix, $sitekey, $db, $name, $banners, $user_prefix, $userinfo, $admin, $admin_file, $ThemeInfo;

global $headeruserinfo_avatar, $avatar_overide_size, $make_xtreme_avatar_small, $board_config, $userinfo;
# START - this was added for the very whimpy small themes that have no block width! by Ernest Buffington 08/06/2019
if($make_xtreme_avatar_small == true):
  $board_config['avatar_max_height'] = 18;
  $board_config['avatar_max_width'] = 18;
endif;
# END - this was added for the very whimpy small themes that have no block width! by Ernest Buffington 08/06/2019
if(is_user() && $userinfo['user_avatar']):
  switch( $userinfo['user_avatar_type']):
		# user_allowavatar = 1
		case USER_AVATAR_UPLOAD:
			$headeruserinfo_avatar .= ( $board_config['allow_avatar_upload'] ) 
			? '<img class="rounded-corners-header" style="max-height: '.$board_config['avatar_max_height'].'px; max-width: '.$board_config['avatar_max_width'].'px;" src="' 
			. $board_config['avatar_path'] . '/' . $userinfo['user_avatar'] . '" alt="" border="0" />' : '';
			break;
		# user_allowavatar = 2
		case USER_AVATAR_REMOTE:
			$headeruserinfo_avatar .= '<img class="rounded-corners-header" style="max-height: '.$board_config['avatar_max_height'].'px; 
			max-width: '.$board_config['avatar_max_width'].'px;" src="
			'.avatar_resize($userinfo['user_avatar']).'" alt="" border="0" />';
			break;
		# user_allowavatar = 3
		case USER_AVATAR_GALLERY:
			$headeruserinfo_avatar .= ( $board_config['allow_avatar_local'] ) ? '<img class="rounded-corners-header" 
			style="max-height: '.$board_config['avatar_max_height'].'px; max-width: '
			.$board_config['avatar_max_width'].'px;" src="' . $board_config['avatar_gallery_path'] . '/' . (($userinfo['user_avatar'] == 'blank.png' || $userinfo['user_avatar'] 
			== 'gallery/blank.png') ? 'blank.png' : $userinfo['user_avatar']) . '" alt="" border="0" />' : '';
			break;
  endswitch;
else:
$headeruserinfo_avatar .= '<img class="rounded-corners-header" style="max-height: '.$board_config['avatar_max_height'].'px; max-width: '
.$board_config['avatar_max_width'].'px;" src="'.$board_config['default_avatar_users_url'].'" alt="" border="0" />';
endif;
if($_COOKIE["titanium_resolution_width"] > 1366):
if (!is_user()) 
{
   # not logged in FORUMS menu START	
   if ($name == 'Forums'):

   echo '<div align="center">';
   
       echo ' <div class="btn-group">';
       echo '    <a href="index.php" class="btn btn-primary dropbtn" role="button">Home</a>';
       echo '    <a href="modules.php?name=Forums" class="btn btn-primary adropbtn" role="button">Forum Index</a>';
       echo '    <a href="modules.php?name=Forums&file=search&search_id=newposts" class="btn btn-primary dropbtn" role="button">New Posts</a>';
       echo '    <a href="modules.php?name=Forums&file=search&search_id=unanswered" class="btn btn-primary dropbtn" role="button">Unanswered</a>';
       echo '    <a href="modules.php?name=Forums&file=search&search_id=egosearch" class="btn btn-primary dropbtn" role="button">My Posts</a>';
       echo '    <a href="modules.php?name=Forums&file=search" class="btn btn-primary dropbtn" role="button">Search</a>';
       echo '  </div>';


    echo '</div>';
	# not logged in FORUMS menu END

    # not logged in Links START	
    elseif ($name == 'Web_Links'):



    # not logged in Links END	
else:

   echo '<div align="center">';

   echo '<div class="btn-group">';
   echo '     <a href="index.php" class="btn btn-primary adropbtn" role="button">Home</a>';
   echo '      <a href="modules.php?name=Forums" class="btn btn-primary dropbtn" role="button">Forums</a>';
   echo '      <a href="modules.php?name=Web_Links" class="btn btn-primary dropbtn" role="button">Links</a>';


   echo '<div class="btn-group">';
   echo '       <a class="btn dropbtn btn-primary dropdown-toggle" data-toggle="dropdown" role="button">Downloads</a>';
   echo '       <ul class="dropdown-menu dropbtn dropdown-content" role="menu">';
   echo '         <li><strong><a href="modules.php?name=File_Repository" class="btn btn-primary dropbtn" role="button">Main Downloads</a></strong></li>';
   echo '         <li><strong><a href="modules.php?name=File_Repository&action=newdownloads" class="btn btn-primary dropbtn" role="button">New Downloads</a></strong></li>';
   echo '         <li><strong><a href="modules.php?name=File_Repository&action=mostpopular" class="btn btn-primary dropbtn" role="button">Popular Downloads</a></strong></li>';
   echo '         <li><strong><a href="modules.php?name=File_Repository&action=statistics" class="btn btn-primary dropbtn" role="button">Download Statistics</a></strong></li>';
   echo '         <li><strong><a href="modules.php?name=File_Repository&action=search" class="btn btn-primary dropbtn" role="button">Search Downloads</a></strong></li>';
   echo '         <li><strong><a href="modules.php?name=File_Repository&action=submitdownload" class="btn btn-primary dropbtn" role="button">Upload A File</a></strong></li>';
   echo '       </ul>';
   echo '</div>';

    echo '<div class="btn-group">';
    echo '       <a class="btn dropbtn btn-primary dropdown-toggle" data-toggle="dropdown" role="button">Blog</a>';
    echo '       <ul class="dropdown-menu dropbtn dropdown-content" role="menu">';
    if (is_mod_admin('super')):
    echo '         <li><strong><a href="admin.php?op=adminBlog" class="btn btn-primary dropbtn" role="button">Post New Blog</a></strong></li>';
    echo '         <li><strong><a href="admin.php?op=topicsmanager" class="btn btn-primary dropbtn" role="button">Create New Blog Topic</a></strong></li>';
    echo '         <li><strong><a href="admin.php?op=AddBlogCategory" class="btn btn-primary dropbtn" role="button">Create New Blog Category</a></strong></li>';
    endif;
    echo '         <li><strong><a href="modules.php?name=Blogs" class="btn btn-primary dropbtn" role="button">View Blog Posts</a></strong></li>';
    echo '         <li><strong><a href="modules.php?name=Blog_Topics" class="btn btn-primary dropbtn" role="button">View Blog Topics</a></strong></li>';
    echo '         <li><strong><a href="modules.php?name=Blog_Archives" class="btn btn-primary dropbtn" role="button">View Blog Archives</a></strong></li>';
    echo '         <li><strong><a href="modules.php?name=Blogs_Top" class="btn btn-primary dropbtn" role="button">View Top 10 Blog Posts</a></strong></li>';
    if (!is_mod_admin('super'))
	echo '         <li><strong><a href="modules.php?name=Blog_Submit" class="btn btn-primary dropbtn" role="button">Submit Blog Post</a></strong></li>';
    echo '       </ul>';
    echo '</div>';

   echo '<div class="btn-group">';
   echo '       <a href="modules.php?name=FAQ" class="btn btn-primary dropbtn" role="button">FAQ</a>';
   echo '</div>';

   echo '<div class="btn-group">';
   echo '       <a href="modules.php?name=Your_Account" class="btn btn-primary dropbtn" role="button">'.$headeruserinfo_avatar.' '.$userinfo['username'].'</a>';
   echo '</div>';
   
   
   echo '</div></div>';

endif;

} 


if (is_user()) 
{
    ############################################################################################################################################################### 
    ############################################################################################################################################################### 
    ############################################################################################################################################################### 
    # logged in Forums module #########################################################################################################################
	if($name == 'Forums'):                                                                                                                            #
                                                                                                                                                      #
    if(isset($_POST['file']) || isset($_GET['file']))                                                                                                 #
        $file = (isset($_POST['file']) ) ? $_POST['file'] : $_GET['file'];                                                                            #
                                                                                                                                                      #
		if(is_string($file)):                                                                                                                         #
        $file = htmlspecialchars($file);                                                                                                              #
        else:                                                                                                                                         #
        $file = '';                                                                                                                                   #
        endif;                                                                                                                                        #
                                                                                                                                                      #
    if(isset($_POST['search_id']) || isset($_GET['search_id']))                                                                                       #
        $search_id = (isset($_POST['search_id']) ) ? $_POST['search_id'] : $_GET['search_id'];                                                        #
                                                                                                                                                      #
		if(is_string($search_id)):                                                                                                                    #
        $search_id = htmlspecialchars($search_id);                                                                                                    #
        else:                                                                                                                                         #
        $search_id = '';                                                                                                                              #
        endif;                                                                                                                                        #
                                                                                                                                                      #
	echo '<div align="center">';                                                                                                                      #
    echo '<div class="btn-group">';                                                                                                                   #
                                                                                                                                                      #
    echo '<div class="btn-group">';                                                                                                                   #
    echo '<a href="index.php" class="btn btn-primary dropbtn" role="button">Home</a>';                                                                #
	                                                                                                                                                  #
	if($search_id == '' && $file == '')                                                                                                               #
    echo '<a href="modules.php?name=Forums" class="btn btn-primary adropbtn" role="button">Forum Index</a>';                                          #
	else                                                                                                                                              #
	echo '<a href="modules.php?name=Forums" class="btn btn-primary dropbtn" role="button">Forum Index</a>';                                           #
                                                                                                                                                      #
	if($search_id == 'newposts' && $file == 'search')                                                                                                 #
	echo '<a href="modules.php?name=Forums&file=search&search_id=newposts" class="btn btn-primary adropbtn" role="button">New Posts</a>';             #
    else                                                                                                                                              #
	echo '<a href="modules.php?name=Forums&file=search&search_id=newposts" class="btn btn-primary dropbtn" role="button">New Posts</a>';              #
                                                                                                                                                      #
	if($search_id == 'unanswered' && $file == 'search')                                                                                               #
	echo '<a href="modules.php?name=Forums&file=search&search_id=unanswered" class="btn btn-primary adropbtn" role="button">Unanswered Topics</a>';   #
    else                                                                                                                                              #
	echo '<a href="modules.php?name=Forums&file=search&search_id=unanswered" class="btn btn-primary dropbtn" role="button">Unanswered Topics</a>';    #
                                                                                                                                                      #
	if($search_id == 'egosearch' && $file == 'search')                                                                                                #
    echo '<a href="modules.php?name=Forums&file=search&search_id=egosearch" class="btn btn-primary adropbtn" role="button">My Posts</a>';             #
    else                                                                                                                                              #
    echo '<a href="modules.php?name=Forums&file=search&search_id=egosearch" class="btn btn-primary dropbtn" role="button">My Posts</a>';              #
                                                                                                                                                      #
	if($search_id == '' && $file == 'search')                                                                                                         #                                                                                                                                                      #
	echo '<a href="modules.php?name=Forums&file=search" class="btn btn-primary adropbtn" role="button">Search</a>';                                   #
	else                                                                                                                                              #
	echo '<a href="modules.php?name=Forums&file=search" class="btn btn-primary dropbtn" role="button">Search</a>';                                    #
	echo '</div>';                                                                                                                                    #
                                                                                                                                                      #
    echo '</div></div>';                                                                                                                              #
	###################################################################################################################################################
	
    ######################################################################################################################################## 
    # logged in Private Messages START	                                                                                                   #
    elseif ($name == 'Private_Messages'):                                                                                                  #
                                                                                                                                           #
    if( isset($_POST['folder']) || isset($_GET['folder'])):                                                                                #
        $folder = (isset($_POST['folder']) ) ? $_POST['folder'] : $_GET['folder'];                                                         #
                                                                                                                                           #
		if (is_string($folder)):                                                                                                           #
        $folder = htmlspecialchars($folder);                                                                                               #
        else:                                                                                                                              #
        $folder = '';                                                                                                                      #
        endif;                                                                                                                             #
                                                                                                                                           #
        if($folder != 'inbox' && $folder != 'outbox' && $folder != 'sentbox' && $folder != 'savebox'):                                     #
        $folder = 'inbox';                                                                                                                 #
		endif;                                                                                                                             #
                                                                                                                                           #
    else:                                                                                                                                  #
        $folder = 'inbox';                                                                                                                 #
    endif;                                                                                                                                 #
	                                                                                                                                       #
    echo '<div align="center">';                                                                                                           #
    echo '    <div class="btn-group">';                                                                                                    #
                                                                                                                                           #
    echo '     <a href="index.php" class="btn btn-primary dropbtn" role="button">Home</a>';                                                #
	                                                                                                                                       #
	if($folder != 'outbox' && $folder != 'sentbox' && $folder != 'savebox')                                                                #
    echo '      <a href="modules.php?name=Private_Messages&folder=inbox" class="btn btn-primary adropbtn" role="button">In Box</a>';       #
    else                                                                                                                                   #
	echo '      <a href="modules.php?name=Private_Messages&folder=inbox" class="btn btn-primary dropbtn" role="button">In Box</a>';        #
	                                                                                                                                       #
	if($folder == 'sentbox')                                                                                                               #
	echo '      <a href="modules.php?name=Private_Messages&folder=sentbox" class="btn btn-primary adropbtn" role="button">Sent Box</a>';   #
    else                                                                                                                                   #
	echo '      <a href="modules.php?name=Private_Messages&folder=sentbox" class="btn btn-primary dropbtn" role="button">Sent Box</a>';    #
	                                                                                                                                       #
	if($folder == 'outbox')                                                                                                                #
	echo '      <a href="modules.php?name=Private_Messages&folder=outbox" class="btn btn-primary adropbtn" role="button">Out Box</a>';     #
	else                                                                                                                                   #
	echo '      <a href="modules.php?name=Private_Messages&folder=outbox" class="btn btn-primary dropbtn" role="button">Out Box</a>';      #
	                                                                                                                                       #
	if($folder == 'savebox')                                                                                                               #
    echo '      <a href="modules.php?name=Private_Messages&folder=savebox" class="btn btn-primary adropbtn" role="button">Saved Box</a>';  #
    else                                                                                                                                   #
	echo '      <a href="modules.php?name=Private_Messages&folder=savebox" class="btn btn-primary dropbtn" role="button">Saved Box</a>';   #
                                                                                                                                           #
                                                                                                                                           #
    echo '    </div>';                                                                                                                     #
    echo '</div>';                                                                                                                         #
    # logged in Private Messages END #######################################################################################################	

    ############################################################################################################################################################### 
    ############################################################################################################################################################### 
    ############################################################################################################################################################### 
    # logged in File_Repository START	
    elseif ($name == 'File_Repository'):

    echo '<div align="center">';
    echo '    <div class="btn-group">';
     
    echo '     <a href="index.php" class="btn btn-primary dropbtn" role="button">Home</a>';
    echo '      <a href="modules.php?name=Forums" class="btn btn-primary dropbtn" role="button">Forums</a>';

   # This is the button set for the Web Links #####################################################################################################################
   echo '<div class="btn-group">';                                                                                                                                #
    if (is_mod_admin('super')):                                                                                                                                   #
     echo '<a href="modules.php?name=Web_Links" class="btn dropbtn btn-primary dropdown-toggle" data-toggle="dropdown" role="button">Links</a>';                  #
     echo '<ul class="dropdown-menu dropbtn dropdown-content" role="menu">';                                                                                      #
     echo '  <li><strong><a href="modules.php?name=Web_Links" class="btn btn-primary dropbtn" role="button">View Web Links</a></strong></li>';                    #######
     echo '  <li><strong><a href="admin.php?op=Links" class="btn btn-danger adropbtn-admin" role="button">Add Web Link</a></strong></li>';                              # 
     echo '  <li><strong><a href="admin.php?op=LinksCleanVotes" class="btn btn-danger adropbtn-admin" role="button">Clean Link Votes</a></strong></li>';                # 
     echo '  <li><strong><a href="admin.php?op=LinksListBrokenLinks" class="btn btn-danger adropbtn-admin" role="button">Broken Link Reports</a></strong></li>';        #  
     echo '  <li><strong><a href="admin.php?op=LinksListModRequests" class="btn btn-danger adropbtn-admin" role="button">Link Modification Requests</a></strong></li>'; # 
     echo '  <li><strong><a href="admin.php?op=LinksLinkCheck" class="btn btn-danger adropbtn-admin" role="button">Validate Web Links</a></strong></li>';               # 
	 echo '</ul>';                                                                                                                                                #######
   else:                                                                                                                                                          #
     echo '<a href="modules.php?name=Web_Links" class="btn btn-primary dropbtn" role="button">Links</a>';                                                         #
   endif;                                                                                                                                                         #
   echo '</div>';                                                                                                                                                 #
   ################################################################################################################################################################ 

    # File_Repository ################################################################################################################################################################## 
    echo '<div class="btn-group">';                                                                                                                                                    #
    echo '<a class="btn adropbtn btn-primary dropdown-toggle" data-toggle="dropdown" role="button">Downloads</a>';                                                                     #
    echo '<ul class="dropdown-menu dropbtn dropdown-content" role="menu">';                                                                                                            #
                                                                                                                                                                                       #
    if(is_mod_admin('super')):                                                                                                                                                         #
	echo '<li><strong><a href="admin.php?op=file_repository&action=settings" class="btn btn-danger adropbtn-admin" role="button">Download Settings</a></strong></li>';                 #
	echo '<li><strong><a href="admin.php?op=file_repository&action=addfile" class="btn btn-danger adropbtn-admin" role="button">Add New Download</a></strong></li>';                   #
	echo '<li><strong><a href="admin.php?op=file_repository&action=files" class="btn btn-danger adropbtn-admin" role="button">View Downloads File List</a></strong></li>';             #
	echo '<li><strong><a href="admin.php?op=file_repository&action=newcat" class="btn btn-danger adropbtn-admin" role="button">Add Download Category</a></strong></li>';               #
	echo '<li><strong><a href="admin.php?op=file_repository&action=categories" class="btn btn-danger adropbtn-admin" role="button">View Download Categories List</a></strong></li>';   #
	echo '<li><strong><a href="admin.php?op=file_repository&action=clientuploads" class="btn btn-danger adropbtn-admin" role="button">View New Uploads</a></strong></li>';             #
	echo '<li><strong><a href="admin.php?op=file_repository&action=brokenfiles" class="btn btn-danger adropbtn-admin" role="button">Check Broken Downloads</a></strong></li>';         #
	endif;                                                                                                                                                                             #
	                                                                                                                                                                                   #
	echo '<li><strong><a href="modules.php?name=File_Repository" class="btn btn-primary dropbtn" role="button">Main Downloads</a></strong></li>';                                      #
    echo '<li><strong><a href="modules.php?name=File_Repository&action=newdownloads" class="btn btn-primary dropbtn" role="button">New Downloads</a></strong></li>';                   #
    echo '<li><strong><a href="modules.php?name=File_Repository&action=mostpopular" class="btn btn-primary dropbtn" role="button">Popular Downloads</a></strong></li>';                #
    echo '<li><strong><a href="modules.php?name=File_Repository&action=statistics" class="btn btn-primary dropbtn" role="button">Download Statistics</a></strong></li>';               #
    echo '<li><strong><a href="modules.php?name=File_Repository&action=search" class="btn btn-primary dropbtn" role="button">Search Downloads</a></strong></li>';                      #
    if(!is_mod_admin('super')):                                                                                                                                                        #
	echo '<li><strong><a href="modules.php?name=File_Repository&action=submitdownload" class="btn btn-primary dropbtn" role="button">Upload A File</a></strong></li>';                 #
	endif;                                                                                                                                                                             #
    echo '</ul>';                                                                                                                                                                      #
    echo '</div>';                                                                                                                                                                     #
	####################################################################################################################################################################################

    # Blog module buttin set ###########################################################################################################################################
    echo '<div class="btn-group">';                                                                                                                                    #
    echo '       <a class="btn dropbtn btn-primary dropdown-toggle" data-toggle="dropdown" role="button">Blog</a>';                                                    #
    echo '       <ul class="dropdown-menu dropbtn dropdown-content" role="menu">';                                                                                     #
    if (is_mod_admin('super')):                                                                                                                                        #
    echo '         <li><strong><a href="admin.php?op=adminBlog" class="btn btn-danger adropbtn-admin" role="button">Post New Blog</a></strong></li>';                  #
    echo '         <li><strong><a href="admin.php?op=topicsmanager" class="btn btn-danger adropbtn-admin" role="button">Create New Blog Topic</a></strong></li>';      #
    echo '         <li><strong><a href="admin.php?op=AddBlogCategory" class="btn btn-danger adropbtn-admin" role="button">Create New Blog Category</a></strong></li>'; #
    endif;                                                                                                                                                             #
    echo '         <li><strong><a href="modules.php?name=Blogs" class="btn btn-primary dropbtn" role="button">View Blog Posts</a></strong></li>';                      #
    echo '         <li><strong><a href="modules.php?name=Blog_Topics" class="btn btn-primary dropbtn" role="button">View Blog Topics</a></strong></li>';               #
    echo '         <li><strong><a href="modules.php?name=Blog_Archives" class="btn btn-primary dropbtn" role="button">View Blog Archives</a></strong></li>';           #
    echo '         <li><strong><a href="modules.php?name=Blogs_Top" class="btn btn-primary dropbtn" role="button">View Top 10 Blog Posts</a></strong></li>';           #
    if (!is_mod_admin('super'))                                                                                                                                        #
	echo '         <li><strong><a href="modules.php?name=Blog_Submit" class="btn btn-primary dropbtn" role="button">Submit Blog Post</a></strong></li>';               #
    echo '       </ul>';                                                                                                                                               #
    echo '</div>';                                                                                                                                                     #
	####################################################################################################################################################################

   # This is the button set for the FAQ module #################################################################################################################
   echo '<div class="btn-group">';                                                                                                                             #
    if (is_mod_admin('super')):                                                                                                                                #
     echo '<a href="modules.php?name=FAQ" class="btn dropbtn btn-primary dropdown-toggle" data-toggle="dropdown" role="button">FAQ</a>';                       #
     echo '<ul class="dropdown-menu dropbtn dropdown-content" role="menu">';                                                                                   #
     echo '  <li><strong><a href="modules.php?name=FAQ" class="btn btn-primary dropbtn" role="button">View Frequently Asked Questions</a></strong></li>';      #
     echo '  <li><strong><a href="admin.php?op=FaqAdmin" class="btn btn-primary dropbtn" role="button">Edit Frequently Asked Questions</a></strong></li>';     #
     echo '</ul>';                                                                                                                                             #
   else:                                                                                                                                                       #
     echo '<a href="modules.php?name=FAQ" class="btn btn-primary dropbtn" role="button">FAQ</a>';                                                              #
   endif;                                                                                                                                                      #
   echo '</div>';                                                                                                                                              #
   #############################################################################################################################################################

   # Logged in My Account ##############################################################################################################################################
   echo '<div class="btn-group">';                                                                                                                                     #
    echo '       <a class="btn dropbtn btn-primary dropdown-toggle" data-toggle="dropdown" role="button">'.$headeruserinfo_avatar.' '.$userinfo['username'].'</a>';    #
    echo '       <ul class="dropdown-menu dropbtn dropdown-content" role="menu">';                                                                                     #
    echo '         <li><strong><a href="modules.php?name=Private_Messages" class="btn btn-primary dropbtn" role="button">Message Center</a></strong></li>';            #
    echo '         <li><strong><a href="modules.php?name=Bookmarks" class="btn btn-primary dropbtn" role="button">My Bookmarks</a></strong></li>';                     #
    echo '         <li><strong><a href="modules.php?name=Cemetery" class="btn btn-primary dropbtn" role="button">My Cemetery</a></strong></li>';                       #
    echo '         <li><strong><a href="modules.php?name=Image_Repository" class="btn btn-primary dropbtn" role="button">My Images</a></strong></li>';                 #
                                                                                                                                                                       #
    echo '         <li><strong><a href="modules.php?name=Groups" class="btn btn-primary dropbtn" role="button">My Groups</a></strong></li>';                           #
                                                                                                                                                                       #
    echo '         <li><strong><a href="modules.php?name=Your_Account" class="btn btn-primary dropbtn" role="button">View Pofile</a></strong></li>';                   #
    echo '         <li><strong><a href="modules.php?name=Profile&mode=editprofile" class="btn btn-primary dropbtn" role="button">Edit Pofile</a></strong></li>';       #
    echo '         <li><strong><a href="modules.php?name=Your_Account&op=chgtheme" class="btn btn-primary dropbtn" role="button">Theme Selection</a></strong></li>';   #
                                                                                                                                                                       #
    echo '       </ul>';                                                                                                                                               #
   echo '</div>';                                                                                                                                                      #
   ##################################################################################################################################################################### 
    # logged in File_Repository END	

    ############################################################################################################################################################### 
    ############################################################################################################################################################### 
    ############################################################################################################################################################### 
    # logged in FAQ START	
    elseif ($name == 'FAQ'):

    echo '<div align="center">';
    echo '    <div class="btn-group">';
     
    echo '     <a href="index.php" class="btn btn-primary dropbtn" role="button">Home</a>';
    echo '      <a href="modules.php?name=Forums" class="btn btn-primary dropbtn" role="button">Forums</a>';

   # This is the button set for the Web Links #####################################################################################################################
   echo '<div class="btn-group">';                                                                                                                                #
    if (is_mod_admin('super')):                                                                                                                                   #
     echo '<a href="modules.php?name=Web_Links" class="btn dropbtn btn-primary dropdown-toggle" data-toggle="dropdown" role="button">Links</a>';                  #
     echo '<ul class="dropdown-menu dropbtn dropdown-content" role="menu">';                                                                                      #
     echo '  <li><strong><a href="modules.php?name=Web_Links" class="btn btn-primary dropbtn" role="button">View Web Links</a></strong></li>';                    #######
     echo '  <li><strong><a href="admin.php?op=Links" class="btn btn-danger adropbtn-admin" role="button">Add Web Link</a></strong></li>';                              # 
     echo '  <li><strong><a href="admin.php?op=LinksCleanVotes" class="btn btn-danger adropbtn-admin" role="button">Clean Link Votes</a></strong></li>';                # 
     echo '  <li><strong><a href="admin.php?op=LinksListBrokenLinks" class="btn btn-danger adropbtn-admin" role="button">Broken Link Reports</a></strong></li>';        #  
     echo '  <li><strong><a href="admin.php?op=LinksListModRequests" class="btn btn-danger adropbtn-admin" role="button">Link Modification Requests</a></strong></li>'; # 
     echo '  <li><strong><a href="admin.php?op=LinksLinkCheck" class="btn btn-danger adropbtn-admin" role="button">Validate Web Links</a></strong></li>';               # 
	 echo '</ul>';                                                                                                                                                #######
   else:                                                                                                                                                          #
     echo '<a href="modules.php?name=Web_Links" class="btn btn-primary dropbtn" role="button">Links</a>';                                                         #
   endif;                                                                                                                                                         #
   echo '</div>';                                                                                                                                                 #
   ################################################################################################################################################################ 

    # File_Repository ######################################################################################################################################################################## 
    echo '<div class="btn-group">';                                                                                                                                                          #
    echo ' <a class="btn dropbtn btn-primary dropdown-toggle" data-toggle="dropdown" role="button">Downloads</a>';                                                                           #
    echo '   <ul class="dropdown-menu dropbtn dropdown-content" role="menu">';                                                                                                               #
                                                                                                                                                                                             #
    if (is_mod_admin('super')):                                                                                                                                                              #
	echo '      <li><strong><a href="admin.php?op=file_repository&action=settings" class="btn btn-danger adropbtn-admin" role="button">Download Settings</a></strong></li>';                 #
	echo '      <li><strong><a href="admin.php?op=file_repository&action=addfile" class="btn btn-danger adropbtn-admin" role="button">Add New Download</a></strong></li>';                   #
	echo '      <li><strong><a href="admin.php?op=file_repository&action=files" class="btn btn-danger adropbtn-admin" role="button">View Downloads File List</a></strong></li>';             #
	echo '      <li><strong><a href="admin.php?op=file_repository&action=newcat" class="btn btn-danger adropbtn-admin" role="button">Add Download Category</a></strong></li>';               #
	echo '      <li><strong><a href="admin.php?op=file_repository&action=categories" class="btn btn-danger adropbtn-admin" role="button">View Download Categories List</a></strong></li>';   #
	echo '      <li><strong><a href="admin.php?op=file_repository&action=clientuploads" class="btn btn-danger adropbtn-admin" role="button">View New Uploads</a></strong></li>';             #
	echo '      <li><strong><a href="admin.php?op=file_repository&action=brokenfiles" class="btn btn-danger adropbtn-admin" role="button">Check Broken Downloads</a></strong></li>';         #
	endif;                                                                                                                                                                                   #
	                                                                                                                                                                                         #
	echo '      <li><strong><a href="modules.php?name=File_Repository" class="btn btn-primary dropbtn" role="button">Main Downloads</a></strong></li>';                                      #
    echo '      <li><strong><a href="modules.php?name=File_Repository&action=newdownloads" class="btn btn-primary dropbtn" role="button">New Downloads</a></strong></li>';                   #
    echo '      <li><strong><a href="modules.php?name=File_Repository&action=mostpopular" class="btn btn-primary dropbtn" role="button">Popular Downloads</a></strong></li>';                #
    echo '      <li><strong><a href="modules.php?name=File_Repository&action=statistics" class="btn btn-primary dropbtn" role="button">Download Statistics</a></strong></li>';               #
    echo '      <li><strong><a href="modules.php?name=File_Repository&action=search" class="btn btn-primary dropbtn" role="button">Search Downloads</a></strong></li>';                      #
    if (!is_mod_admin('super')):                                                                                                                                                             #
	echo '      <li><strong><a href="modules.php?name=File_Repository&action=submitdownload" class="btn btn-primary dropbtn" role="button">Upload A File</a></strong></li>';                 #
	endif;                                                                                                                                                                                   #
    echo '   </ul>';                                                                                                                                                                         #
    echo '</div>';                                                                                                                                                                           #
	##########################################################################################################################################################################################

    # Blog module buttin set ###########################################################################################################################################
    echo '<div class="btn-group">';                                                                                                                                    #
    echo '       <a class="btn dropbtn btn-primary dropdown-toggle" data-toggle="dropdown" role="button">Blog</a>';                                                    #
    echo '       <ul class="dropdown-menu dropbtn dropdown-content" role="menu">';                                                                                     #
    if (is_mod_admin('super')):                                                                                                                                        #
    echo '         <li><strong><a href="admin.php?op=adminBlog" class="btn btn-danger adropbtn-admin" role="button">Post New Blog</a></strong></li>';                  #
    echo '         <li><strong><a href="admin.php?op=topicsmanager" class="btn btn-danger adropbtn-admin" role="button">Create New Blog Topic</a></strong></li>';      #
    echo '         <li><strong><a href="admin.php?op=AddBlogCategory" class="btn btn-danger adropbtn-admin" role="button">Create New Blog Category</a></strong></li>'; #
    endif;                                                                                                                                                             #
    echo '         <li><strong><a href="modules.php?name=Blogs" class="btn btn-primary dropbtn" role="button">View Blog Posts</a></strong></li>';                      #
    echo '         <li><strong><a href="modules.php?name=Blog_Topics" class="btn btn-primary dropbtn" role="button">View Blog Topics</a></strong></li>';               #
    echo '         <li><strong><a href="modules.php?name=Blog_Archives" class="btn btn-primary dropbtn" role="button">View Blog Archives</a></strong></li>';           #
    echo '         <li><strong><a href="modules.php?name=Blogs_Top" class="btn btn-primary dropbtn" role="button">View Top 10 Blog Posts</a></strong></li>';           #
    if (!is_mod_admin('super'))                                                                                                                                        #
	echo '         <li><strong><a href="modules.php?name=Blog_Submit" class="btn btn-primary dropbtn" role="button">Submit Blog Post</a></strong></li>';               #
    echo '       </ul>';                                                                                                                                               #
    echo '</div>';                                                                                                                                                     #
	####################################################################################################################################################################

   # This is the button set for the FAQ module #################################################################################################################
   echo '<div class="btn-group">';                                                                                                                             #
    if (is_mod_admin('super')):                                                                                                                                #
     echo '<a href="modules.php?name=FAQ" class="btn adropbtn btn-primary dropdown-toggle" data-toggle="dropdown" role="button">FAQ</a>';                      #
     echo '<ul class="dropdown-menu dropbtn dropdown-content" role="menu">';                                                                                   #
     echo '  <li><strong><a href="modules.php?name=FAQ" class="btn btn-primary dropbtn" role="button">View Frequently Asked Questions</a></strong></li>';      #
     echo '  <li><strong><a href="admin.php?op=FaqAdmin" class="btn btn-primary dropbtn" role="button">Edit Frequently Asked Questions</a></strong></li>';     #
     echo '</ul>';                                                                                                                                             #
   else:                                                                                                                                                       #
     echo '<a href="modules.php?name=FAQ" class="btn btn-primary adropbtn" role="button">FAQ</a>';                                                             #
   endif;                                                                                                                                                      #
   echo '</div>';                                                                                                                                              #
   #############################################################################################################################################################

   # Logged in My Account ##############################################################################################################################################
   echo '<div class="btn-group">';                                                                                                                                     #
    echo '       <a class="btn dropbtn btn-primary dropdown-toggle" data-toggle="dropdown" role="button">'.$headeruserinfo_avatar.' '.$userinfo['username'].'</a>';    #
    echo '       <ul class="dropdown-menu dropbtn dropdown-content" role="menu">';                                                                                     #
    echo '         <li><strong><a href="modules.php?name=Private_Messages" class="btn btn-primary dropbtn" role="button">Message Center</a></strong></li>';            #
    echo '         <li><strong><a href="modules.php?name=Bookmarks" class="btn btn-primary dropbtn" role="button">My Bookmarks</a></strong></li>';                     #
    echo '         <li><strong><a href="modules.php?name=Cemetery" class="btn btn-primary dropbtn" role="button">My Cemetery</a></strong></li>';                       #
    echo '         <li><strong><a href="modules.php?name=Image_Repository" class="btn btn-primary dropbtn" role="button">My Images</a></strong></li>';                 #
                                                                                                                                                                       #
    echo '         <li><strong><a href="modules.php?name=Groups" class="btn btn-primary dropbtn" role="button">My Groups</a></strong></li>';                           #
                                                                                                                                                                       #
    echo '         <li><strong><a href="modules.php?name=Your_Account" class="btn btn-primary dropbtn" role="button">View Pofile</a></strong></li>';                   #
    echo '         <li><strong><a href="modules.php?name=Profile&mode=editprofile" class="btn btn-primary dropbtn" role="button">Edit Pofile</a></strong></li>';       #
    echo '         <li><strong><a href="modules.php?name=Your_Account&op=chgtheme" class="btn btn-primary dropbtn" role="button">Theme Selection</a></strong></li>';   #
                                                                                                                                                                       #
    echo '       </ul>';                                                                                                                                               #
   echo '</div>';                                                                                                                                                      #
   ##################################################################################################################################################################### 
    # logged in FAQ END	

    ############################################################################################################################################################### 
    ############################################################################################################################################################### 
    ############################################################################################################################################################### 
    # logged in FAQ START	
    elseif ($name == 'Image_Repository'):

    echo '<div align="center">';
    echo '    <div class="btn-group">';
     
    echo '     <a href="index.php" class="btn btn-primary dropbtn" role="button">Home</a>';
    echo '      <a href="modules.php?name=Forums" class="btn btn-primary dropbtn" role="button">Forums</a>';

   # This is the button set for the Web Links #####################################################################################################################
   echo '<div class="btn-group">';                                                                                                                                #
    if (is_mod_admin('super')):                                                                                                                                   #
     echo '<a href="modules.php?name=Web_Links" class="btn dropbtn btn-primary dropdown-toggle" data-toggle="dropdown" role="button">Links</a>';                  #
     echo '<ul class="dropdown-menu dropbtn dropdown-content" role="menu">';                                                                                      #
     echo '  <li><strong><a href="modules.php?name=Web_Links" class="btn btn-primary dropbtn" role="button">View Web Links</a></strong></li>';                    #######
     echo '  <li><strong><a href="admin.php?op=Links" class="btn btn-danger adropbtn-admin" role="button">Add Web Link</a></strong></li>';                              # 
     echo '  <li><strong><a href="admin.php?op=LinksCleanVotes" class="btn btn-danger adropbtn-admin" role="button">Clean Link Votes</a></strong></li>';                # 
     echo '  <li><strong><a href="admin.php?op=LinksListBrokenLinks" class="btn btn-danger adropbtn-admin" role="button">Broken Link Reports</a></strong></li>';        #  
     echo '  <li><strong><a href="admin.php?op=LinksListModRequests" class="btn btn-danger adropbtn-admin" role="button">Link Modification Requests</a></strong></li>'; # 
     echo '  <li><strong><a href="admin.php?op=LinksLinkCheck" class="btn btn-danger adropbtn-admin" role="button">Validate Web Links</a></strong></li>';               # 
	 echo '</ul>';                                                                                                                                                #######
   else:                                                                                                                                                          #
     echo '<a href="modules.php?name=Web_Links" class="btn btn-primary dropbtn" role="button">Links</a>';                                                         #
   endif;                                                                                                                                                         #
   echo '</div>';                                                                                                                                                 #
   ################################################################################################################################################################ 

    # File_Repository ######################################################################################################################################################################## 
    echo '<div class="btn-group">';                                                                                                                                                          #
    echo ' <a class="btn dropbtn btn-primary dropdown-toggle" data-toggle="dropdown" role="button">Downloads</a>';                                                                           #
    echo '   <ul class="dropdown-menu dropbtn dropdown-content" role="menu">';                                                                                                               #
                                                                                                                                                                                             #
    if (is_mod_admin('super')):                                                                                                                                                              #
	echo '      <li><strong><a href="admin.php?op=file_repository&action=settings" class="btn btn-danger adropbtn-admin" role="button">Download Settings</a></strong></li>';                 #
	echo '      <li><strong><a href="admin.php?op=file_repository&action=addfile" class="btn btn-danger adropbtn-admin" role="button">Add New Download</a></strong></li>';                   #
	echo '      <li><strong><a href="admin.php?op=file_repository&action=files" class="btn btn-danger adropbtn-admin" role="button">View Downloads File List</a></strong></li>';             #
	echo '      <li><strong><a href="admin.php?op=file_repository&action=newcat" class="btn btn-danger adropbtn-admin" role="button">Add Download Category</a></strong></li>';               #
	echo '      <li><strong><a href="admin.php?op=file_repository&action=categories" class="btn btn-danger adropbtn-admin" role="button">View Download Categories List</a></strong></li>';   #
	echo '      <li><strong><a href="admin.php?op=file_repository&action=clientuploads" class="btn btn-danger adropbtn-admin" role="button">View New Uploads</a></strong></li>';             #
	echo '      <li><strong><a href="admin.php?op=file_repository&action=brokenfiles" class="btn btn-danger adropbtn-admin" role="button">Check Broken Downloads</a></strong></li>';         #
	endif;                                                                                                                                                                                   #
	                                                                                                                                                                                         #
	echo '      <li><strong><a href="modules.php?name=File_Repository" class="btn btn-primary dropbtn" role="button">Main Downloads</a></strong></li>';                                      #
    echo '      <li><strong><a href="modules.php?name=File_Repository&action=newdownloads" class="btn btn-primary dropbtn" role="button">New Downloads</a></strong></li>';                   #
    echo '      <li><strong><a href="modules.php?name=File_Repository&action=mostpopular" class="btn btn-primary dropbtn" role="button">Popular Downloads</a></strong></li>';                #
    echo '      <li><strong><a href="modules.php?name=File_Repository&action=statistics" class="btn btn-primary dropbtn" role="button">Download Statistics</a></strong></li>';               #
    echo '      <li><strong><a href="modules.php?name=File_Repository&action=search" class="btn btn-primary dropbtn" role="button">Search Downloads</a></strong></li>';                      #
    if (!is_mod_admin('super')):                                                                                                                                                             #
	echo '      <li><strong><a href="modules.php?name=File_Repository&action=submitdownload" class="btn btn-primary dropbtn" role="button">Upload A File</a></strong></li>';                 #
	endif;                                                                                                                                                                                   #
    echo '   </ul>';                                                                                                                                                                         #
    echo '</div>';                                                                                                                                                                           #
	##########################################################################################################################################################################################

    # Blog module buttin set ###########################################################################################################################################
    echo '<div class="btn-group">';                                                                                                                                    #
    echo '       <a class="btn dropbtn btn-primary dropdown-toggle" data-toggle="dropdown" role="button">Blog</a>';                                                    #
    echo '       <ul class="dropdown-menu dropbtn dropdown-content" role="menu">';                                                                                     #
    if (is_mod_admin('super')):                                                                                                                                        #
    echo '         <li><strong><a href="admin.php?op=adminBlog" class="btn btn-danger adropbtn-admin" role="button">Post New Blog</a></strong></li>';                  #
    echo '         <li><strong><a href="admin.php?op=topicsmanager" class="btn btn-danger adropbtn-admin" role="button">Create New Blog Topic</a></strong></li>';      #
    echo '         <li><strong><a href="admin.php?op=AddBlogCategory" class="btn btn-danger adropbtn-admin" role="button">Create New Blog Category</a></strong></li>'; #
    endif;                                                                                                                                                             #
    echo '         <li><strong><a href="modules.php?name=Blogs" class="btn btn-primary dropbtn" role="button">View Blog Posts</a></strong></li>';                      #
    echo '         <li><strong><a href="modules.php?name=Blog_Topics" class="btn btn-primary dropbtn" role="button">View Blog Topics</a></strong></li>';               #
    echo '         <li><strong><a href="modules.php?name=Blog_Archives" class="btn btn-primary dropbtn" role="button">View Blog Archives</a></strong></li>';           #
    echo '         <li><strong><a href="modules.php?name=Blogs_Top" class="btn btn-primary dropbtn" role="button">View Top 10 Blog Posts</a></strong></li>';           #
    if (!is_mod_admin('super'))                                                                                                                                        #
	echo '         <li><strong><a href="modules.php?name=Blog_Submit" class="btn btn-primary dropbtn" role="button">Submit Blog Post</a></strong></li>';               #
    echo '       </ul>';                                                                                                                                               #
    echo '</div>';                                                                                                                                                     #
	####################################################################################################################################################################

   # This is the button set for the FAQ module #################################################################################################################
   echo '<div class="btn-group">';                                                                                                                             #
    if (is_mod_admin('super')):                                                                                                                                #
     echo '<a href="modules.php?name=FAQ" class="btn dropbtn btn-primary dropdown-toggle" data-toggle="dropdown" role="button">FAQ</a>';                       #
     echo '<ul class="dropdown-menu dropbtn dropdown-content" role="menu">';                                                                                   #
     echo '  <li><strong><a href="modules.php?name=FAQ" class="btn btn-primary dropbtn" role="button">View Frequently Asked Questions</a></strong></li>';      #
     echo '  <li><strong><a href="admin.php?op=FaqAdmin" class="btn btn-primary dropbtn" role="button">Edit Frequently Asked Questions</a></strong></li>';     #
     echo '</ul>';                                                                                                                                             #
   else:                                                                                                                                                       #
     echo '<a href="modules.php?name=FAQ" class="btn btn-primary dropbtn" role="button">FAQ</a>';                                                              #
   endif;                                                                                                                                                      #
   echo '</div>';                                                                                                                                              #
   #############################################################################################################################################################

   # Logged in My Account ##############################################################################################################################################
   echo '<div class="btn-group">';                                                                                                                                     #
    echo '       <a class="btn dropbtn btn-primary dropdown-toggle" data-toggle="dropdown" role="button">'.$headeruserinfo_avatar.' '.$userinfo['username'].'</a>';    #
    echo '       <ul class="dropdown-menu dropbtn dropdown-content" role="menu">';                                                                                     #
    echo '         <li><strong><a href="modules.php?name=Private_Messages" class="btn btn-primary dropbtn" role="button">Message Center</a></strong></li>';            #
    echo '         <li><strong><a href="modules.php?name=Bookmarks" class="btn btn-primary dropbtn" role="button">My Bookmarks</a></strong></li>';                     #
    echo '         <li><strong><a href="modules.php?name=Cemetery" class="btn btn-primary dropbtn" role="button">My Cemetery</a></strong></li>';                       #
    echo '         <li><strong><a href="modules.php?name=Image_Repository" class="btn btn-primary dropbtn" role="button">My Images</a></strong></li>';                 #
                                                                                                                                                                       #
    echo '         <li><strong><a href="modules.php?name=Groups" class="btn btn-primary dropbtn" role="button">My Groups</a></strong></li>';                           #
                                                                                                                                                                       #
    echo '         <li><strong><a href="modules.php?name=Your_Account" class="btn btn-primary dropbtn" role="button">View Pofile</a></strong></li>';                   #
    echo '         <li><strong><a href="modules.php?name=Profile&mode=editprofile" class="btn btn-primary dropbtn" role="button">Edit Pofile</a></strong></li>';       #
    echo '         <li><strong><a href="modules.php?name=Your_Account&op=chgtheme" class="btn btn-primary dropbtn" role="button">Theme Selection</a></strong></li>';   #
                                                                                                                                                                       #
    echo '       </ul>';                                                                                                                                               #
   echo '</div>';                                                                                                                                                      #
   ##################################################################################################################################################################### 
    # logged in Image_Repository END	

    ############################################################################################################################################################### 
    ############################################################################################################################################################### 
    ############################################################################################################################################################### 
    # logged in Links START	
    elseif ($name == 'Web_Links'):

    echo '<div align="center">';
    echo '    <div class="btn-group">';
     
    echo '     <a href="index.php" class="btn btn-primary dropbtn" role="button">Home</a>';
    echo '      <a href="modules.php?name=Forums" class="btn btn-primary dropbtn" role="button">Forums</a>';
    
   # This is the button set for the Web Links #####################################################################################################################
   echo '<div class="btn-group">';                                                                                                                                #
    if (is_mod_admin('super')):                                                                                                                                   #
     echo '<a href="modules.php?name=Web_Links" class="btn adropbtn btn-primary dropdown-toggle" data-toggle="dropdown" role="button">Links</a>';                 #
     echo '<ul class="dropdown-menu dropbtn dropdown-content" role="menu">';                                                                                      #
     echo '  <li><strong><a href="modules.php?name=Web_Links" class="btn btn-primary dropbtn" role="button">View Web Links</a></strong></li>';                    #######
     echo '  <li><strong><a href="admin.php?op=Links" class="btn btn-danger adropbtn-admin" role="button">Add Web Link</a></strong></li>';                              # 
     echo '  <li><strong><a href="admin.php?op=LinksCleanVotes" class="btn btn-danger adropbtn-admin" role="button">Clean Link Votes</a></strong></li>';                # 
     echo '  <li><strong><a href="admin.php?op=LinksListBrokenLinks" class="btn btn-danger adropbtn-admin" role="button">Broken Link Reports</a></strong></li>';        #  
     echo '  <li><strong><a href="admin.php?op=LinksListModRequests" class="btn btn-danger adropbtn-admin" role="button">Link Modification Requests</a></strong></li>'; # 
     echo '  <li><strong><a href="admin.php?op=LinksLinkCheck" class="btn btn-danger adropbtn-admin" role="button">Validate Web Links</a></strong></li>';               # 
	 echo '</ul>';                                                                                                                                                #######
   else:                                                                                                                                                          #
     echo '<a href="modules.php?name=Web_Links" class="btn btn-primary dropbtn" role="button">Links</a>';                                                         #
   endif;                                                                                                                                                         #
   echo '</div>';                                                                                                                                                 #
   ################################################################################################################################################################ 

    # File_Repository ######################################################################################################################################################################## 
    echo '<div class="btn-group">';                                                                                                                                                          #
    echo ' <a class="btn dropbtn btn-primary dropdown-toggle" data-toggle="dropdown" role="button">Downloads</a>';                                                                           #
    echo '   <ul class="dropdown-menu dropbtn dropdown-content" role="menu">';                                                                                                               #
                                                                                                                                                                                             #
    if (is_mod_admin('super')):                                                                                                                                                              #
	echo '      <li><strong><a href="admin.php?op=file_repository&action=settings" class="btn btn-danger adropbtn-admin" role="button">Download Settings</a></strong></li>';                 #
	echo '      <li><strong><a href="admin.php?op=file_repository&action=addfile" class="btn btn-danger adropbtn-admin" role="button">Add New Download</a></strong></li>';                   #
	echo '      <li><strong><a href="admin.php?op=file_repository&action=files" class="btn btn-danger adropbtn-admin" role="button">View Downloads File List</a></strong></li>';             #
	echo '      <li><strong><a href="admin.php?op=file_repository&action=newcat" class="btn btn-danger adropbtn-admin" role="button">Add Download Category</a></strong></li>';               #
	echo '      <li><strong><a href="admin.php?op=file_repository&action=categories" class="btn btn-danger adropbtn-admin" role="button">View Download Categories List</a></strong></li>';   #
	echo '      <li><strong><a href="admin.php?op=file_repository&action=clientuploads" class="btn btn-danger adropbtn-admin" role="button">View New Uploads</a></strong></li>';             #
	echo '      <li><strong><a href="admin.php?op=file_repository&action=brokenfiles" class="btn btn-danger adropbtn-admin" role="button">Check Broken Downloads</a></strong></li>';         #
	endif;                                                                                                                                                                                   #
	                                                                                                                                                                                         #
	echo '      <li><strong><a href="modules.php?name=File_Repository" class="btn btn-primary dropbtn" role="button">Main Downloads</a></strong></li>';                                      #
    echo '      <li><strong><a href="modules.php?name=File_Repository&action=newdownloads" class="btn btn-primary dropbtn" role="button">New Downloads</a></strong></li>';                   #
    echo '      <li><strong><a href="modules.php?name=File_Repository&action=mostpopular" class="btn btn-primary dropbtn" role="button">Popular Downloads</a></strong></li>';                #
    echo '      <li><strong><a href="modules.php?name=File_Repository&action=statistics" class="btn btn-primary dropbtn" role="button">Download Statistics</a></strong></li>';               #
    echo '      <li><strong><a href="modules.php?name=File_Repository&action=search" class="btn btn-primary dropbtn" role="button">Search Downloads</a></strong></li>';                      #
    if (!is_mod_admin('super')):                                                                                                                                                             #
	echo '      <li><strong><a href="modules.php?name=File_Repository&action=submitdownload" class="btn btn-primary dropbtn" role="button">Upload A File</a></strong></li>';                 #
	endif;                                                                                                                                                                                   #
    echo '   </ul>';                                                                                                                                                                         #
    echo '</div>';                                                                                                                                                                           #
	##########################################################################################################################################################################################

    # Blog module buttin set ###########################################################################################################################################
    echo '<div class="btn-group">';                                                                                                                                    #
    echo '       <a class="btn dropbtn btn-primary dropdown-toggle" data-toggle="dropdown" role="button">Blog</a>';                                                    #
    echo '       <ul class="dropdown-menu dropbtn dropdown-content" role="menu">';                                                                                     #
    if (is_mod_admin('super')):                                                                                                                                        #
    echo '         <li><strong><a href="admin.php?op=adminBlog" class="btn btn-danger adropbtn-admin" role="button">Post New Blog</a></strong></li>';                  #
    echo '         <li><strong><a href="admin.php?op=topicsmanager" class="btn btn-danger adropbtn-admin" role="button">Create New Blog Topic</a></strong></li>';      #
    echo '         <li><strong><a href="admin.php?op=AddBlogCategory" class="btn btn-danger adropbtn-admin" role="button">Create New Blog Category</a></strong></li>'; #
    endif;                                                                                                                                                             #
    echo '         <li><strong><a href="modules.php?name=Blogs" class="btn btn-primary dropbtn" role="button">View Blog Posts</a></strong></li>';                      #
    echo '         <li><strong><a href="modules.php?name=Blog_Topics" class="btn btn-primary dropbtn" role="button">View Blog Topics</a></strong></li>';               #
    echo '         <li><strong><a href="modules.php?name=Blog_Archives" class="btn btn-primary dropbtn" role="button">View Blog Archives</a></strong></li>';           #
    echo '         <li><strong><a href="modules.php?name=Blogs_Top" class="btn btn-primary dropbtn" role="button">View Top 10 Blog Posts</a></strong></li>';           #
    if (!is_mod_admin('super'))                                                                                                                                        #
	echo '         <li><strong><a href="modules.php?name=Blog_Submit" class="btn btn-primary dropbtn" role="button">Submit Blog Post</a></strong></li>';               #
    echo '       </ul>';                                                                                                                                               #
    echo '</div>';                                                                                                                                                     #
	####################################################################################################################################################################

   # This is the button set for the FAQ module #################################################################################################################
   echo '<div class="btn-group">';                                                                                                                             #
    if (is_mod_admin('super')):                                                                                                                                #
     echo '<a href="modules.php?name=FAQ" class="btn dropbtn btn-primary dropdown-toggle" data-toggle="dropdown" role="button">FAQ</a>';                       #
     echo '<ul class="dropdown-menu dropbtn dropdown-content" role="menu">';                                                                                   #
     echo '  <li><strong><a href="modules.php?name=FAQ" class="btn btn-primary dropbtn" role="button">View Frequently Asked Questions</a></strong></li>';      #
     echo '  <li><strong><a href="admin.php?op=FaqAdmin" class="btn btn-primary dropbtn" role="button">Edit Frequently Asked Questions</a></strong></li>';     #
     echo '</ul>';                                                                                                                                             #
   else:                                                                                                                                                       #
     echo '<a href="modules.php?name=FAQ" class="btn btn-primary dropbtn" role="button">FAQ</a>';                                                              #
   endif;                                                                                                                                                      #
   echo '</div>';                                                                                                                                              #
   #############################################################################################################################################################

   # Logged in My Account ##############################################################################################################################################
   echo '<div class="btn-group">';                                                                                                                                     #
    echo '       <a class="btn dropbtn btn-primary dropdown-toggle" data-toggle="dropdown" role="button">'.$headeruserinfo_avatar.' '.$userinfo['username'].'</a>';    #
    echo '       <ul class="dropdown-menu dropbtn dropdown-content" role="menu">';                                                                                     #
    echo '         <li><strong><a href="modules.php?name=Private_Messages" class="btn btn-primary dropbtn" role="button">Message Center</a></strong></li>';            #
    echo '         <li><strong><a href="modules.php?name=Bookmarks" class="btn btn-primary dropbtn" role="button">My Bookmarks</a></strong></li>';                     #
    echo '         <li><strong><a href="modules.php?name=Cemetery" class="btn btn-primary dropbtn" role="button">My Cemetery</a></strong></li>';                       #
    echo '         <li><strong><a href="modules.php?name=Image_Repository" class="btn btn-primary dropbtn" role="button">My Images</a></strong></li>';                 #
                                                                                                                                                                       #
    echo '         <li><strong><a href="modules.php?name=Groups" class="btn btn-primary dropbtn" role="button">My Groups</a></strong></li>';                           #
                                                                                                                                                                       #
    echo '         <li><strong><a href="modules.php?name=Your_Account" class="btn btn-primary dropbtn" role="button">View Pofile</a></strong></li>';                   #
    echo '         <li><strong><a href="modules.php?name=Profile&mode=editprofile" class="btn btn-primary dropbtn" role="button">Edit Pofile</a></strong></li>';       #
    echo '         <li><strong><a href="modules.php?name=Your_Account&op=chgtheme" class="btn btn-primary dropbtn" role="button">Theme Selection</a></strong></li>';   #
                                                                                                                                                                       #
    echo '       </ul>';                                                                                                                                               #
   echo '</div>';                                                                                                                                                      #
   ##################################################################################################################################################################### 
    # logged in Links END	

    ############################################################################################################################################################### 
    ############################################################################################################################################################### 
    ############################################################################################################################################################### 
    # logged in Blog START	
    elseif (($name == 'Blog') OR ($name == 'Blog_Topics') OR ($name == 'Blog_Archive') OR ($name == 'Blogs_Top') OR ($name == 'Blog_Submit')):

    echo '<div align="center">';
    echo '    <div class="btn-group">';
     
    echo '     <a href="index.php" class="btn btn-primary dropbtn" role="button">Home</a>';
    echo '      <a href="modules.php?name=Forums" class="btn btn-primary dropbtn" role="button">Forums</a>';

   # This is the button set for the Web Links #####################################################################################################################
   echo '<div class="btn-group">';                                                                                                                                #
    if (is_mod_admin('super')):                                                                                                                                   #
     echo '<a href="modules.php?name=Web_Links" class="btn dropbtn btn-primary dropdown-toggle" data-toggle="dropdown" role="button">Links</a>';                  #
     echo '<ul class="dropdown-menu dropbtn dropdown-content" role="menu">';                                                                                      #
     echo '  <li><strong><a href="modules.php?name=Web_Links" class="btn btn-primary dropbtn" role="button">View Web Links</a></strong></li>';                    #
     echo '  <li><strong><a href="admin.php?op=Links" class="btn btn-primary dropbtn" role="button">Add Web Link</a></strong></li>';                              # 
     echo '  <li><strong><a href="admin.php?op=LinksCleanVotes" class="btn btn-primary dropbtn" role="button">Clean Link Votes</a></strong></li>';                # 
     echo '  <li><strong><a href="admin.php?op=LinksListBrokenLinks" class="btn btn-primary dropbtn" role="button">Broken Link Reports</a></strong></li>';        # 
     echo '  <li><strong><a href="admin.php?op=LinksListModRequests" class="btn btn-primary dropbtn" role="button">Link Modification Requests</a></strong></li>'; # 
     echo '  <li><strong><a href="admin.php?op=LinksLinkCheck" class="btn btn-primary dropbtn" role="button">Validate Web Links</a></strong></li>';               # 
	 echo '</ul>';                                                                                                                                                #
   else:                                                                                                                                                          #
     echo '<a href="modules.php?name=Web_Links" class="btn btn-primary dropbtn" role="button">Links</a>';                                                         #
   endif;                                                                                                                                                         #
   echo '</div>';                                                                                                                                                 #
   ################################################################################################################################################################ 

    # File_Repository ######################################################################################################################################################################## 
    echo '<div class="btn-group">';                                                                                                                                                          #
    echo ' <a class="btn dropbtn btn-primary dropdown-toggle" data-toggle="dropdown" role="button">Downloads</a>';                                                                           #
    echo '   <ul class="dropdown-menu dropbtn dropdown-content" role="menu">';                                                                                                               #
                                                                                                                                                                                             #
    if (is_mod_admin('super')):                                                                                                                                                              #
	echo '      <li><strong><a href="admin.php?op=file_repository&action=settings" class="btn btn-danger adropbtn-admin" role="button">Download Settings</a></strong></li>';                 #
	echo '      <li><strong><a href="admin.php?op=file_repository&action=addfile" class="btn btn-danger adropbtn-admin" role="button">Add New Download</a></strong></li>';                   #
	echo '      <li><strong><a href="admin.php?op=file_repository&action=files" class="btn btn-danger adropbtn-admin" role="button">View Downloads File List</a></strong></li>';             #
	echo '      <li><strong><a href="admin.php?op=file_repository&action=newcat" class="btn btn-danger adropbtn-admin" role="button">Add Download Category</a></strong></li>';               #
	echo '      <li><strong><a href="admin.php?op=file_repository&action=categories" class="btn btn-danger adropbtn-admin" role="button">View Download Categories List</a></strong></li>';   #
	echo '      <li><strong><a href="admin.php?op=file_repository&action=clientuploads" class="btn btn-danger adropbtn-admin" role="button">View New Uploads</a></strong></li>';             #
	echo '      <li><strong><a href="admin.php?op=file_repository&action=brokenfiles" class="btn btn-danger adropbtn-admin" role="button">Check Broken Downloads</a></strong></li>';         #
	endif;                                                                                                                                                                                   #
	                                                                                                                                                                                         #
	echo '      <li><strong><a href="modules.php?name=File_Repository" class="btn btn-primary dropbtn" role="button">Main Downloads</a></strong></li>';                                      #
    echo '      <li><strong><a href="modules.php?name=File_Repository&action=newdownloads" class="btn btn-primary dropbtn" role="button">New Downloads</a></strong></li>';                   #
    echo '      <li><strong><a href="modules.php?name=File_Repository&action=mostpopular" class="btn btn-primary dropbtn" role="button">Popular Downloads</a></strong></li>';                #
    echo '      <li><strong><a href="modules.php?name=File_Repository&action=statistics" class="btn btn-primary dropbtn" role="button">Download Statistics</a></strong></li>';               #
    echo '      <li><strong><a href="modules.php?name=File_Repository&action=search" class="btn btn-primary dropbtn" role="button">Search Downloads</a></strong></li>';                      #
    if (!is_mod_admin('super')):                                                                                                                                                             #
	echo '      <li><strong><a href="modules.php?name=File_Repository&action=submitdownload" class="btn btn-primary dropbtn" role="button">Upload A File</a></strong></li>';                 #
	endif;                                                                                                                                                                                   #
    echo '   </ul>';                                                                                                                                                                         #
    echo '</div>';                                                                                                                                                                           #
	##########################################################################################################################################################################################

    # Blog module buttin set ###########################################################################################################################################
    echo '<div class="btn-group">';                                                                                                                                    #
    echo '       <a class="btn adropbtn btn-primary dropdown-toggle" data-toggle="dropdown" role="button">Blog</a>';                                                   #
    echo '       <ul class="dropdown-menu dropbtn dropdown-content" role="menu">';                                                                                     #
    if (is_mod_admin('super')):                                                                                                                                        #
    echo '         <li><strong><a href="admin.php?op=adminBlog" class="btn btn-danger adropbtn-admin" role="button">Post New Blog</a></strong></li>';                  #
    echo '         <li><strong><a href="admin.php?op=topicsmanager" class="btn btn-danger adropbtn-admin" role="button">Create New Blog Topic</a></strong></li>';      #
    echo '         <li><strong><a href="admin.php?op=AddBlogCategory" class="btn btn-danger adropbtn-admin" role="button">Create New Blog Category</a></strong></li>'; #
    endif;                                                                                                                                                             #
    echo '         <li><strong><a href="modules.php?name=Blogs" class="btn btn-primary dropbtn" role="button">View Blog Posts</a></strong></li>';                      #
    echo '         <li><strong><a href="modules.php?name=Blog_Topics" class="btn btn-primary dropbtn" role="button">View Blog Topics</a></strong></li>';               #
    echo '         <li><strong><a href="modules.php?name=Blog_Archives" class="btn btn-primary dropbtn" role="button">View Blog Archives</a></strong></li>';           #
    echo '         <li><strong><a href="modules.php?name=Blogs_Top" class="btn btn-primary dropbtn" role="button">View Top 10 Blog Posts</a></strong></li>';           #
    if (!is_mod_admin('super'))                                                                                                                                        #
	echo '         <li><strong><a href="modules.php?name=Blog_Submit" class="btn btn-primary dropbtn" role="button">Submit Blog Post</a></strong></li>';               #
    echo '       </ul>';                                                                                                                                               #
    echo '</div>';                                                                                                                                                     #
	####################################################################################################################################################################

   # This is the button set for the FAQ module #################################################################################################################
   echo '<div class="btn-group">';                                                                                                                             #
    if (is_mod_admin('super')):                                                                                                                                #
     echo '<a href="modules.php?name=FAQ" class="btn dropbtn btn-primary dropdown-toggle" data-toggle="dropdown" role="button">FAQ</a>';                       #
     echo '<ul class="dropdown-menu dropbtn dropdown-content" role="menu">';                                                                                   #
     echo '  <li><strong><a href="modules.php?name=FAQ" class="btn btn-primary dropbtn" role="button">View Frequently Asked Questions</a></strong></li>';      #
     echo '  <li><strong><a href="admin.php?op=FaqAdmin" class="btn btn-primary dropbtn" role="button">Edit Frequently Asked Questions</a></strong></li>';     #
     echo '</ul>';                                                                                                                                             #
   else:                                                                                                                                                       #
     echo '<a href="modules.php?name=FAQ" class="btn btn-primary dropbtn" role="button">FAQ</a>';                                                              #
   endif;                                                                                                                                                      #
   echo '</div>';                                                                                                                                              #
   #############################################################################################################################################################

   # Logged in My Account #######################################################################################################################################
    echo '<div class="btn-group">';                                                                                                                             #
    echo '<a class="btn dropbtn btn-primary dropdown-toggle" data-toggle="dropdown" role="button">'.$headeruserinfo_avatar.' '.$userinfo['username'].'</a>';    # 
	echo '<ul class="dropdown-menu dropbtn dropdown-content" role="menu">';                                                                                     #
    echo '<li><strong><a href="modules.php?name=Private_Messages" class="btn btn-primary dropbtn" role="button">Message Center</a></strong></li>';              #
    echo '<li><strong><a href="modules.php?name=Bookmarks" class="btn btn-primary dropbtn" role="button">My Bookmarks</a></strong></li>';                       #
    echo '<li><strong><a href="modules.php?name=Cemetery" class="btn btn-primary dropbtn" role="button">My Cemetery</a></strong></li>';                         #
    echo '<li><strong><a href="modules.php?name=Image_Repository" class="btn btn-primary dropbtn" role="button">My Images</a></strong></li>';                   #
    echo '<li><strong><a href="modules.php?name=Groups" class="btn btn-primary dropbtn" role="button">My Groups</a></strong></li>';                             #
    echo '<li><strong><a href="modules.php?name=Your_Account" class="btn btn-primary dropbtn" role="button">View Pofile</a></strong></li>';                     #
    echo '<li><strong><a href="modules.php?name=Profile&mode=editprofile" class="btn btn-primary dropbtn" role="button">Edit Pofile</a></strong></li>';         #
    echo '<li><strong><a href="modules.php?name=Your_Account&op=chgtheme" class="btn btn-primary dropbtn" role="button">Theme Selection</a></strong></li>';     #
    echo '</ul>';                                                                                                                                               #
   echo '</div>';                                                                                                                                               #
   ############################################################################################################################################################## 
    # logged in Blog END	
              # -------------------------------------------------------------------------------------------------------------------------------------------------------------
            #
###########
###########
else:      #
             # --------------------------------------------------------------------------------------------------------------------------------------------------------------
			 
 echo '<div align="center">';
echo '<div class="btn-group">';
     
    echo '     <a href="index.php" class="btn btn-primary adropbtn" role="button">Home</a>';
    echo '      <a href="modules.php?name=Forums" class="btn btn-primary dropbtn" role="button">Forums</a>';

   # This is the button set for the Web Links #####################################################################################################################
   echo '<div class="btn-group">';                                                                                                                                #
    if (is_mod_admin('super')):                                                                                                                                   #
     echo '<a href="modules.php?name=Web_Links" class="btn dropbtn btn-primary dropdown-toggle" data-toggle="dropdown" role="button">Links</a>';                  #
     echo '<ul class="dropdown-menu dropbtn dropdown-content" role="menu">';                                                                                      #
     echo '  <li><strong><a href="modules.php?name=Web_Links" class="btn btn-primary dropbtn" role="button">View Web Links</a></strong></li>';                    #######
     echo '  <li><strong><a href="admin.php?op=Links" class="btn btn-danger admin-adropbtn" role="button">Add Web Link</a></strong></li>';                              # 
     echo '  <li><strong><a href="admin.php?op=LinksCleanVotes" class="btn btn-danger admin-adropbtn" role="button">Clean Link Votes</a></strong></li>';                # 
     echo '  <li><strong><a href="admin.php?op=LinksListBrokenLinks" class="btn btn-danger admin-adropbtn" role="button">Broken Link Reports</a></strong></li>';        # 
     echo '  <li><strong><a href="admin.php?op=LinksListModRequests" class="btn btn-danger admin-adropbtn" role="button">Link Modification Requests</a></strong></li>'; # 
     echo '  <li><strong><a href="admin.php?op=LinksLinkCheck" class="btn btn-danger admin-adropbtn" role="button">Validate Web Links</a></strong></li>';               # 
	 echo '</ul>';                                                                                                                                                #######
   else:                                                                                                                                                          #
     echo '<a href="modules.php?name=Web_Links" class="btn btn-primary dropbtn" role="button">Links</a>';                                                         #
   endif;                                                                                                                                                         #
   echo '</div>';                                                                                                                                                 #
   ################################################################################################################################################################ 

    # File_Repository ######################################################################################################################################################################## 
    echo '<div class="btn-group">';                                                                                                                                                          #
    echo ' <a class="btn dropbtn btn-primary dropdown-toggle" data-toggle="dropdown" role="button">Downloads</a>';                                                                           #
    echo '   <ul class="dropdown-menu dropbtn dropdown-content" role="menu">';                                                                                                               #
                                                                                                                                                                                             #
    if (is_mod_admin('super')):                                                                                                                                                              #
	echo '      <li><strong><a href="admin.php?op=file_repository&action=settings" class="btn btn-danger adropbtn-admin" role="button">Download Settings</a></strong></li>';                 #
	echo '      <li><strong><a href="admin.php?op=file_repository&action=addfile" class="btn btn-danger adropbtn-admin" role="button">Add New Download</a></strong></li>';                   #
	echo '      <li><strong><a href="admin.php?op=file_repository&action=files" class="btn btn-danger adropbtn-admin" role="button">View Downloads File List</a></strong></li>';             #
	echo '      <li><strong><a href="admin.php?op=file_repository&action=newcat" class="btn btn-danger adropbtn-admin" role="button">Add Download Category</a></strong></li>';               #
	echo '      <li><strong><a href="admin.php?op=file_repository&action=categories" class="btn btn-danger adropbtn-admin" role="button">View Download Categories List</a></strong></li>';   #
	echo '      <li><strong><a href="admin.php?op=file_repository&action=clientuploads" class="btn btn-danger adropbtn-admin" role="button">View New Uploads</a></strong></li>';             #
	echo '      <li><strong><a href="admin.php?op=file_repository&action=brokenfiles" class="btn btn-danger adropbtn-admin" role="button">Check Broken Downloads</a></strong></li>';         #
	endif;                                                                                                                                                                                   #
	                                                                                                                                                                                         #
	echo '      <li><strong><a href="modules.php?name=File_Repository" class="btn btn-primary dropbtn" role="button">Main Downloads</a></strong></li>';                                      #
    echo '      <li><strong><a href="modules.php?name=File_Repository&action=newdownloads" class="btn btn-primary dropbtn" role="button">New Downloads</a></strong></li>';                   #
    echo '      <li><strong><a href="modules.php?name=File_Repository&action=mostpopular" class="btn btn-primary dropbtn" role="button">Popular Downloads</a></strong></li>';                #
    echo '      <li><strong><a href="modules.php?name=File_Repository&action=statistics" class="btn btn-primary dropbtn" role="button">Download Statistics</a></strong></li>';               #
    echo '      <li><strong><a href="modules.php?name=File_Repository&action=search" class="btn btn-primary dropbtn" role="button">Search Downloads</a></strong></li>';                      #
    if (!is_mod_admin('super')):                                                                                                                                                             #
	echo '      <li><strong><a href="modules.php?name=File_Repository&action=submitdownload" class="btn btn-primary dropbtn" role="button">Upload A File</a></strong></li>';                 #
	endif;                                                                                                                                                                                   #
    echo '   </ul>';                                                                                                                                                                         #
    echo '</div>';                                                                                                                                                                           #
	##########################################################################################################################################################################################

    # Blog module buttin set ###########################################################################################################################################
    echo '<div class="btn-group">';                                                                                                                                    #
    echo '       <a class="btn dropbtn btn-primary dropdown-toggle" data-toggle="dropdown" role="button">Blog</a>';                                                    #
    echo '       <ul class="dropdown-menu dropbtn dropdown-content" role="menu">';                                                                                     #
    if (is_mod_admin('super')):                                                                                                                                        #
    echo '         <li><strong><a href="admin.php?op=adminBlog" class="btn btn-danger adropbtn-admin" role="button">Post New Blog</a></strong></li>';                  #
    echo '         <li><strong><a href="admin.php?op=topicsmanager" class="btn btn-danger adropbtn-admin" role="button">Create New Blog Topic</a></strong></li>';      #
    echo '         <li><strong><a href="admin.php?op=AddBlogCategory" class="btn btn-danger adropbtn-admin" role="button">Create New Blog Category</a></strong></li>'; #
    endif;                                                                                                                                                             #
    echo '         <li><strong><a href="modules.php?name=Blogs" class="btn btn-primary dropbtn" role="button">View Blog Posts</a></strong></li>';                      #
    echo '         <li><strong><a href="modules.php?name=Blog_Topics" class="btn btn-primary dropbtn" role="button">View Blog Topics</a></strong></li>';               #
    echo '         <li><strong><a href="modules.php?name=Blog_Archives" class="btn btn-primary dropbtn" role="button">View Blog Archives</a></strong></li>';           #
    echo '         <li><strong><a href="modules.php?name=Blogs_Top" class="btn btn-primary dropbtn" role="button">View Top 10 Blog Posts</a></strong></li>';           #
    if (!is_mod_admin('super'))                                                                                                                                        #
	echo '         <li><strong><a href="modules.php?name=Blog_Submit" class="btn btn-primary dropbtn" role="button">Submit Blog Post</a></strong></li>';               #
    echo '       </ul>';                                                                                                                                               #
    echo '</div>';                                                                                                                                                     #
	####################################################################################################################################################################

   # This is the button set for the FAQ module #################################################################################################################
   echo '<div class="btn-group">';                                                                                                                             #
    if (is_mod_admin('super')):                                                                                                                                #
     echo '<a href="modules.php?name=FAQ" class="btn dropbtn btn-primary dropdown-toggle" data-toggle="dropdown" role="button">FAQ</a>';                       #
     echo '<ul class="dropdown-menu dropbtn dropdown-content" role="menu">';                                                                                   #
     echo '  <li><strong><a href="modules.php?name=FAQ" class="btn btn-primary dropbtn" role="button">View Frequently Asked Questions</a></strong></li>';      #
     echo '  <li><strong><a href="admin.php?op=FaqAdmin" class="btn btn-primary dropbtn" role="button">Edit Frequently Asked Questions</a></strong></li>';     #
     echo '</ul>';                                                                                                                                             #
   else:                                                                                                                                                       #
     echo '<a href="modules.php?name=FAQ" class="btn btn-primary dropbtn" role="button">FAQ</a>';                                                              #
   endif;                                                                                                                                                      #
   echo '</div>';                                                                                                                                              #
   ############################################################################################################################################################# 
  
   # Logged in My Account ##############################################################################################################################################
   echo '<div class="btn-group">';                                                                                                                                     #
    echo '       <a class="btn dropbtn btn-primary dropdown-toggle" data-toggle="dropdown" role="button">'.$headeruserinfo_avatar.' '.$userinfo['username'].'</a>';    #
    echo '       <ul class="dropdown-menu dropbtn dropdown-content" role="menu">';                                                                                     #
    echo '         <li><strong><a href="modules.php?name=Private_Messages" class="btn btn-primary dropbtn" role="button">Message Center</a></strong></li>';            #
    echo '         <li><strong><a href="modules.php?name=Bookmarks" class="btn btn-primary dropbtn" role="button">My Bookmarks</a></strong></li>';                     #
    echo '         <li><strong><a href="modules.php?name=Cemetery" class="btn btn-primary dropbtn" role="button">My Cemetery</a></strong></li>';                       #
    echo '         <li><strong><a href="modules.php?name=Image_Repository" class="btn btn-primary dropbtn" role="button">My Images</a></strong></li>';                 #
                                                                                                                                                                       #
    echo '         <li><strong><a href="modules.php?name=Groups" class="btn btn-primary dropbtn" role="button">My Groups</a></strong></li>';                           #
                                                                                                                                                                       #
    echo '         <li><strong><a href="modules.php?name=Your_Account" class="btn btn-primary dropbtn" role="button">View Pofile</a></strong></li>';                   #
    echo '         <li><strong><a href="modules.php?name=Profile&mode=editprofile" class="btn btn-primary dropbtn" role="button">Edit Pofile</a></strong></li>';       #
    echo '         <li><strong><a href="modules.php?name=Your_Account&op=chgtheme" class="btn btn-primary dropbtn" role="button">Theme Selection</a></strong></li>';   #
                                                                                                                                                                       #
    echo '       </ul>';                                                                                                                                               #
   echo '</div>';                                                                                                                                                      #
   ##################################################################################################################################################################### 

echo '</div>';
 echo '</div>';
endif;
}
endif;
echo '<div align="center" style="padding-top:8px;">';
echo '</div>';
?>
