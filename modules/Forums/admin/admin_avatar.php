<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/***************************************************************************
 *                              avatar_manage.php
 *                            -------------------
 *   begin                : Thursday, Apr 25, 2002
 *
 ***************************************************************************/

/***************************************************************************
* phpbb2 forums port version 2.1 (c) 2003 - Nuke Cops (http://nukecops.com)
*
* Ported by Paul Laudanski (Zhen-Xjell) to phpbb2 standalone 2.0.4. Test
* and debugging completed by the Elite Nukers at Nuke Cops: ArtificialIntel,
* Chatserv, MikeM, sixonetonoffun, Zhen-Xjell. Thanks to some heavy debug
* work by AI in Nuke 6.5.
*
* You run this package at your sole risk. Nuke Cops and affiliates cannot
* be held liable if anything goes wrong. You are advised to test this
* package on a development system. Backup everything before implementing
* in a production environment. If something goes wrong, you can always
* backout and restore your backups.
*
* Installing and running this also means you agree to the terms of the AUP
* found at Nuke Cops.
*
* This is version 2.1 of the phpbb2 forum port for PHP-Nuke. Work is based
* on Tom Nitzschner's forum port version 2.0.6. Tom's 2.0.6 port was based
* on the phpbb2 standalone version 2.0.3. Our version 2.1 from Nuke Cops is
* now reflecting phpbb2 standalone 2.0.4 that fixes some major SQL
* injection exploits.
***************************************************************************/

/***************************************************************************
 *   This file is part of the phpBB2 port to Nuke 6.0 (c) copyright 2002
 *   by Tom Nitzschner (tom@toms-home.com)
 *   http://bbtonuke.sourceforge.net (or http://www.toms-home.com)
 *
 *   As always, make a backup before messing with anything. All code
 *   release by me is considered sample code only. It may be fully
 *   functual, but you use it at your own risk, if you break it,
 *   you get to fix it too. No waranty is given or implied.
 *
 *   Updated to allow propper avatar management by:
 *   copland007@thewebworks.com (http://www.thewebworks.com/)
 *
 *   Please post all questions/request about this port on http://bbtonuke.sourceforge.net first,
 *   then on my site. All original header code and copyright messages will be maintained
 *   to give credit where credit is due. If you modify this, the only requirement is
 *   that you also maintain all original copyright messages. All my work is released
 *   under the GNU GENERAL PUBLIC LICENSE. Please see the README for more information.
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/
 
 /*****[CHANGES]**********************************************************
-=[Mod]=-
      Advanced Username Color                  v1.0.5       06/13/2005
 ************************************************************************/  

if (!defined('IN_PHPBB')) define('IN_PHPBB', true);

if(!empty($setmodules)):
  $file = basename(__FILE__);
  $module['General']['Avatar_Management'] = "$file";
  return;
endif;

$root_path = "./../../../";
$phpbb_root_path = './../';
require($phpbb_root_path . 'extension.inc');
require('pagestart.' . $phpEx);

# Any mode passed?
if(isset($_GET['mode']) || isset($_POST['mode'])):
  $mode = $_GET['mode'] ?? $_POST['mode'];
  $target = $_GET['target'] ?? $_POST['target'];
else:
  $mode = "";
endif;

# Select all avatars and usernames that have an uploaded avatar currently
$sql = "SELECT user_id, username, user_avatar FROM ".USERS_TABLE."

WHERE user_avatar_type = ".USER_AVATAR_UPLOAD." 

AND user_avatar IS NOT NULL";

if(!$result = $db->sql_query($sql))
{
    $error = $db->sql_error();
    die("Could not get avatar information! $error[code] : $error[message]");
}



# Create a hash to keep track of all the user that is using the uploaded avatar
while($avatar_rowset = $db->sql_fetchrow($result)):
    $avatar_usage[$avatar_rowset['user_avatar']] = $avatar_rowset['username'];
endwhile;


# This is the variable that points to the path of the avatars
# You may need to ajust this to meet your needs ;)
$real_avatar_dir = $phpbb_root_path . '../../' . $board_config['avatar_path'];

echo '<h1>Unused Avatar Management (This Code Is Not Finished Yet)</h1>

<p>The table below shows all currently stored uploaded avatars.  These are only the avatars which were selected to be
uploaded by users, this will not show avatars currently in the gallery. If any of the listed avatars are no longer used
by any user an option to delete it will appear.  This is a permanent delete, once you have selected to delete an
avatar it will be removed from the server and no longer be available.  You will be prompted for confirmation (requires
Javascript).</p>';



switch($mode):

  case "delete":
    echo '<table cellpadding=4 cellspacing=1 border=0 class=forumline>';
      if(unlink($real_avatar_dir.'/'.$target)):
        print "<tr><td>Success, $target deleted!</td></tr><tr><td><a href=\"./admin_avatar.php\">Continue</a></td></tr></table>";
      else:
        print "<tr><td>FAILED to delete $target!</td></tr><tr><td><a href=javascript:history.go(-1)>Go Back</a></td></tr></table>";
      endif;
      break;

    default:
        echo '<style>
        <!--
        td.avatar_listing    { font-family: Verdana; font-size: xx-small; text-align: center; }
        th.avatar_listing    { font-family: Verdana; font-size: x-small; text-align: center; font-weight: bold;
                      background-color: #cccccc; }
        -->
        </style>

        <table cellpadding=4 cellspacing=1 border=0 class=forumline>
        <tr>
          <th class=avatar_listing width=40%>Avatar</th>
          <th class=avatar_listing width=20%>Size</th>
          <th class=avatar_listing width=20%>Usage</th>
          <th class=avatar_listing width=20%>Edit user</th>
        </tr>';

        $alt1 = '#CCCCFF';
        $alt2 = '#EEEEEE';
        $alter = $alt2;


        # This is where we go through the avatar directory and report whether they are not
        # used or if they are used, by who.

        if($avatar_dir = opendir($real_avatar_dir)):

            while($file = readdir($avatar_dir)):
            
                # This is where the script will filter out any file that doesn't match the patterns
                if($file != "." && $file != ".." && preg_match("/\.(gif|jpg|webp|jpeg|png)$/i",$file)):
				
				if(($file === 'invisible.png') || ($file === 'no_avatar.png') || ($file === 'hidden.png') || ($file === 'blank.png'))
				continue;
                
                    $stats = stat($real_avatar_dir.'/'.$file);

                    # Alternating row colows code
                    if($alter == $alt1): 
					  $alter = $alt2; 
                    elseif($alter == $alt2): 
					  $alter = $alt1; 
					endif;
                    
					if(!empty($avatar_usage[$file])):
                    
                        # Since we need to supply a link with a valid sid later in html, let's build it now
                        $av_id = $avatar_usage[$file];
						
                        $sql = "SELECT user_id FROM ".USERS_TABLE." WHERE username = $av_id";
                        //echo ''.$av_id.'</br>';
                        $result = $db->sql_query($sql);

						$av_uid = $db->sql_fetchrow($result);
                        $avatar_uid = $av_uid['user_id'];
                        $edit_url = append_sid("./admin_users.php?mode=edit&u=$avatar_uid");

                        # Bingo, someone is using this avatar
                        print "<tr><td class=avatar_listing bgcolor=$alter><img height=\"200px\" src=$real_avatar_dir/$file><br />$file</td>
                               <td class=avatar_listing bgcolor=$alter>$stats[7] Bytes</td>
                               <td class=avatar_listing bgcolor=$alter>$avatar_usage[$file]</td>
                               <td class=avatar_listing bgcolor=$alter>
                               <a href=\"$edit_url\"> Edit $avatar_usage[$file]</a></td></tr>\n";

                    
                    else:
                        # Not used, safe to display delete link for admin
                        $delete_html = append_sid("./admin_avatar.php?mode=delete&target=$file");
                        print "<tr><td class=avatar_listing bgcolor=$alter><img height=\"200px\" src=$real_avatar_dir/$file><br />$file</td>
                                                           <td class=avatar_listing bgcolor=$alter>$stats[7] Bytes</td>
                               <td class=avatar_listing bgcolor=$alter>Not Used<br /><a href=$delete_html onClick=\"if(confirm('Are you sure you want to delete: $file ?')) return true; else return false;\">Delete</a></td>
                               <td class=avatar_listing bgcolor=$alter>&nbsp;</td>
                               </tr>\n";
                    endif;
                endif;
				
            endwhile;
        else:
            # If we made it to this else there was a problem trying to read the avatar directory
            # If you see this error message check this variable:
            # $real_avatar_dir -> This may be set incorrectly for your site.
            print "Avatar directory unavailable!";
        endif;

        echo '</table>';
        break;
		
endswitch;

?>
