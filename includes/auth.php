<?php # JOHN 3:16 #
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/***************************************************************************
 *                                 auth.php
 *                            -------------------
 *   update               : Sunday, May 23, 2021
 *   copyright            : (C) 2001 The 86it Developers Network
 *   email                : support@86it.us
 *
 *   Id: auth.php,v 2.0.2.3n 2021/05/23 18:00:00 psotfx Exp
 *
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: auth.php,v 1.37.2.5 2004/03/01 16:49:03 psotfx Exp
 ***************************************************************************/

/***************************************************************************
* phpbb2 forums port version 2.0.5 (c) 2003 - Nuke Cops (http://nukecops.com)
*
* Ported by Nuke Cops to phpbb2 standalone 2.0.5 Test
* and debugging completed by the Elite Nukers and site members.
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
* This is version 2.0.5 of the phpbb2 forum port for PHP-Nuke. Work is based
* on Tom Nitzschner's forum port version 2.0.6. Tom's 2.0.6 port was based
* on the phpbb2 standalone version 2.0.3. Our version 2.0.5 from Nuke Cops is
* now reflecting phpbb2 standalone 2.0.5 that fixes some bugs and the
* invalid_session error message.
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
 *   Please post all questions/request about this port on http://bbtonuke.sourceforge.net first,
 *   then on my site. All original header code and copyright messages will be maintained
 *   to give credit where credit is due. If you modify this, the only requirement is
 *   that you also maintain all original copyright messages. All my work is released
 *   under the GNU GENERAL PUBLIC LICENSE. Please see the README for more information.
 ***************************************************************************/

/***************************************************************************
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 ***************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
-=[Mod]=-
      Attachment Mod                           v2.4.1       07/20/2005
      Global Announcements                     v1.2.8       06/13/2005
 ************************************************************************/
if (!defined('IN_PHPBB'))
exit('Hacking attempt');

# $type's accepted (pre-pend with AUTH_):
# VIEW, READ, POST, REPLY, EDIT, DELETE, STICKY, ANNOUNCE, VOTE, POLLCREATE
#
# Possible options ($type/forum_id combinations):
#
# * If you include a type and forum_id then a specific lookup will be done and
# the single result returned
#
# * If you set type to AUTH_ALL and specify a forum_id an array of all auth types
# will be returned
#
# * If you provide a forum_id a specific lookup on that forum will be done
#
# * If you set forum_id to AUTH_LIST_ALL and specify a type an array listing the
# results for all forums will be returned
#
# * If you set forum_id to AUTH_LIST_ALL and type to AUTH_ALL a multidimensional
# array containing the auth permissions for all types and all forums for that
# user is returned
#
# All results are returned as associative arrays, even when a single auth type is
# specified.
#
# If available you can send an array (either one or two dimensional) containing the
# forum auth levels, this will prevent the auth function having to do its own
# lookup

function auth($type, $forum_id, $userdata, $f_access = '')
{
   global $db, $lang;

switch($type):
     case AUTH_ALL:
     # Mod: Global Announcements v1.2.8 START
     $a_sql = 'a.auth_view, 
	           a.auth_read, 
			   a.auth_post, 
			  a.auth_reply, 
			   a.auth_edit, 
			 a.auth_delete, 
			 a.auth_sticky, 
		   a.auth_announce, 
		       a.auth_vote, 
		 a.auth_pollcreate, 
	 a.auth_globalannounce';
    
	 $auth_fields = array('auth_view', 
	                      'auth_read', 
						  'auth_post', 
						 'auth_reply', 
						  'auth_edit', 
					    'auth_delete', 
					    'auth_sticky', 
					  'auth_announce', 
					      'auth_vote', 
				    'auth_pollcreate', 
			    'auth_globalannounce');
    # Mod: Global Announcements v1.2.8 END
    break;
    case AUTH_VIEW:
       $a_sql = 'a.auth_view';
       $auth_fields = array('auth_view');
    break;
    case AUTH_READ:
       $a_sql = 'a.auth_read';
       $auth_fields = array('auth_read');
    break;
    case AUTH_POST:
       $a_sql = 'a.auth_post';
       $auth_fields = array('auth_post');
    break;
    case AUTH_REPLY:
       $a_sql = 'a.auth_reply';
       $auth_fields = array('auth_reply');
    break;
    case AUTH_EDIT:
        $a_sql = 'a.auth_edit';
        $auth_fields = array('auth_edit');
    break;
    case AUTH_DELETE:
        $a_sql = 'a.auth_delete';
        $auth_fields = array('auth_delete');
    break;
    case AUTH_ANNOUNCE:
        $a_sql = 'a.auth_announce';
        $auth_fields = array('auth_announce');
    break;
    case AUTH_STICKY:
        $a_sql = 'a.auth_sticky';
        $auth_fields = array('auth_sticky');
    break;
    case AUTH_POLLCREATE:
        $a_sql = 'a.auth_pollcreate';
        $auth_fields = array('auth_pollcreate');
    break;
    case AUTH_VOTE:
        $a_sql = 'a.auth_vote';
        $auth_fields = array('auth_vote');
    break;
    case AUTH_ATTACH:
    break;
    # Mod: Global Announcements v1.2.8 START
    case AUTH_GLOBALANNOUNCE:
        $a_sql = 'a.auth_globalannounce';
        $auth_fields = array('auth_globalannounce');
    break;
    # Mod: Global Announcements v1.2.8 END
    default:
    break;
	
endswitch;

        # Mod: Attachment Mod v2.4.1 START
        attach_setup_basic_auth($type, $auth_fields, $a_sql);
        # Mod: Attachment Mod v2.4.1 END

        # If f_access has been passed, or auth is needed to return an array of forums
        # then we need to pull the auth information on the given forum (or all forums)
        if(empty($f_access)):
           $forum_match_sql = ( $forum_id != AUTH_LIST_ALL ) ? "WHERE a.forum_id = '$forum_id'" : '';

            $sql = "SELECT a.forum_id, $a_sql
                    FROM " . FORUMS_TABLE . " a
                    $forum_match_sql";
						
            if(!($result = $db->sql_query($sql)))
            message_die(GENERAL_ERROR, 'Failed obtaining forum access control lists', '', __LINE__, __FILE__, $sql);

            $sql_fetchrow = ($forum_id != AUTH_LIST_ALL) ? 'sql_fetchrow' : 'sql_fetchrowset';

            if(!($f_access = $db->$sql_fetchrow($result))):
              $db->sql_freeresult($result);
              return array();
            endif;

            $db->sql_freeresult($result);
        endif;

        # If the user isn't logged on then all we need do is check if the forum
        # has the type set to ALL, if yes they are good to go, if not then they
        # are denied access
        $u_access = array();

        if(isset($userdata['session_logged_in'])):
           $forum_match_sql = ($forum_id != AUTH_LIST_ALL) ? "AND a.forum_id = '$forum_id'" : '';
           $sql = "SELECT a.forum_id, $a_sql, a.auth_mod
                   FROM " . AUTH_ACCESS_TABLE . " a, " . USER_GROUP_TABLE . " ug
                   WHERE ug.user_id = ".$userdata['user_id']. "
                   AND ug.user_pending = '0'
                   AND a.group_id = ug.group_id
                   $forum_match_sql";
            if(!($result = $db->sql_query($sql)))
            message_die(GENERAL_ERROR, 'Failed obtaining forum access control lists', '', __LINE__, __FILE__, $sql);
            if($row = $db->sql_fetchrow($result)):
              do
               {
                  if ( $forum_id != AUTH_LIST_ALL)
                  $u_access[] = $row;
                  else
                  $u_access[$row['forum_id']][] = $row;
                }
                while( $row = $db->sql_fetchrow($result) );
            endif;
        
		$db->sql_freeresult($result);
        endif;

        $is_admin = ( $userdata['user_level'] == ADMIN && $userdata['session_logged_in'] ) ? TRUE : 0;

        $auth_user = array();
        for($i = 0; $i < count($auth_fields); $i++):
           $key = $auth_fields[$i];
           # If the user is logged on and the forum type is either ALL or REG then the user has access
           #
           # If the type if ACL, MOD or ADMIN then we need to see if the user has specific permissions
           # to do whatever it is they want to do ... to do this we pull relevant information for the
           # user (and any groups they belong to)
           #
           # Now we compare the users access level against the forums. We assume here that a moderator
           # and admin automatically have access to an ACL forum, similarly we assume admins meet an
           # auth requirement of MOD
           if($forum_id != AUTH_LIST_ALL):
           
             $value = (isset($f_access[$key])) ? $f_access[$key] : null;
             switch($value):
                 case AUTH_ALL:
                 $auth_user[$key] = TRUE;
                 $auth_user[$key.'_type'] = $lang['Auth_Anonymous_Users'];
                 break;
                 case AUTH_REG:
                 $auth_user[$key] = ( $userdata['session_logged_in'] ) ? TRUE : 0;
                 $auth_user[$key.'_type'] = $lang['Auth_Registered_Users'];
                 break;
                 case AUTH_ACL:
                 $auth_user[$key] = ( $userdata['session_logged_in'] ) ? auth_check_user(AUTH_ACL, $key, $u_access, $is_admin) : 0;
                 $auth_user[$key.'_type'] = $lang['Auth_Users_granted_access'];
                 break;
                 case AUTH_MOD:
                 $auth_user[$key] = ( $userdata['session_logged_in'] ) ? auth_check_user(AUTH_MOD, 'auth_mod', $u_access, $is_admin) : 0;
                 $auth_user[$key.'_type'] = $lang['Auth_Moderators'];
                 break;
                 case AUTH_ADMIN:
                 $auth_user[$key] = $is_admin;
                 $auth_user[$key.'_type'] = $lang['Auth_Administrators'];
                 break;
                 default:
                 $auth_user[$key] = 0;
                 break;
               endswitch;
           
           else:

              for($k = 0; $k < count($f_access); $k++):
                 $value = $f_access[$k][$key];
                 $f_forum_id = $f_access[$k]['forum_id'];
                 $u_access[$f_forum_id] = isset($u_access[$f_forum_id]) ? $u_access[$f_forum_id] : array();
                 switch($value):
                    case AUTH_ALL:
                    $auth_user[$f_forum_id][$key] = TRUE;
                    $auth_user[$f_forum_id][$key.'_type'] = $lang['Auth_Anonymous_Users'];
                    break;
                    case AUTH_REG:
                    $auth_user[$f_forum_id][$key] = ( $userdata['session_logged_in'] ) ? TRUE : 0;
                    $auth_user[$f_forum_id][$key.'_type'] = $lang['Auth_Registered_Users'];
                    break;
                    case AUTH_ACL:
                    $auth_user[$f_forum_id][$key] = ( $userdata['session_logged_in'] ) ? auth_check_user(AUTH_ACL, $key, $u_access[$f_forum_id], $is_admin) : 0;
                    $auth_user[$f_forum_id][$key.'_type'] = $lang['Auth_Users_granted_access'];
                    break;
                    case AUTH_MOD:
                    $auth_user[$f_forum_id][$key] = ( $userdata['session_logged_in'] ) ? auth_check_user(AUTH_MOD, 'auth_mod', $u_access[$f_forum_id], $is_admin) : 0;
                    $auth_user[$f_forum_id][$key.'_type'] = $lang['Auth_Moderators'];
                    break;
                    case AUTH_ADMIN:
                    $auth_user[$f_forum_id][$key] = $is_admin;
                    $auth_user[$f_forum_id][$key.'_type'] = $lang['Auth_Administrators'];
                    break;
                    default:
                    $auth_user[$f_forum_id][$key] = 0;
                    break;
                 endswitch;

             endfor;
          endif;
		  
        endfor;

        # Is user a moderator?
        if($forum_id != AUTH_LIST_ALL):
        
          $auth_user['auth_mod'] = ($userdata['session_logged_in']) ? auth_check_user(AUTH_MOD, 'auth_mod', $u_access, $is_admin) : 0;
        
        else:
          if(!isset($userdata['session_logged_in']))
		  $userdata['session_logged_in'] = '';
		
          for($k = 0; $k < count($f_access); $k++):
             $f_forum_id = $f_access[$k]['forum_id'];
             $u_access[$f_forum_id] = isset($u_access[$f_forum_id]) ? $u_access[$f_forum_id] : array();
             $auth_user[$f_forum_id]['auth_mod'] = ( $userdata['session_logged_in'] ) ? auth_check_user(AUTH_MOD, 'auth_mod', $u_access[$f_forum_id], $is_admin) : 0;
           endfor;
        endif;

        return $auth_user;
}

function auth_check_user($type, $key, $u_access, $is_admin)
{
  $auth_user = 0;
  if(count($u_access)):
     for($j = 0; $j < count($u_access); $j++):
        $result = 0;
        switch($type):
           case AUTH_ACL:
           $result = $u_access[$j][$key];
           case AUTH_MOD:
           $result = $result || $u_access[$j]['auth_mod'];
           case AUTH_ADMIN:
           $result = $result || $is_admin;
           break;
        endswitch;
        $auth_user = $auth_user || $result;
     endfor;
  else:
     $auth_user = $is_admin;
  endif;
 return $auth_user;
}
?>
