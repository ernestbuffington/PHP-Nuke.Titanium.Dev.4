<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                               sig_reset.php
 *                            -------------------
 *   begin                : Saturday, Jan 31, 2004
 *   copyright            : (C) 2004 -=ET=-
 *   email                : space_et@tiscali.fr
 *
 *   $Id: sig_reset.php,v 1.1.0 2004/02/05 12:00:00 -=ET=- Exp $
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

if (!defined('IN_PHPBB')) define('IN_PHPBB', true);

$phpbb_root_path = './../';
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
if ( isset($HTTP_POST_VARS['cancel']) )
{

}

if ( !file_exists(@phpbb_realpath($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_sig_control.' . $phpEx)) ) 
{ 
    include($phpbb_root_path . 'language/lang_english/lang_sig_control.' . $phpEx); 
} else 
{ 
    include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_sig_control.' . $phpEx); 
} 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $user->lang['ENCODING']; ?>">
<meta http-equiv="Content-Style-Type" content="text/css">
<link rel="stylesheet" href="<?php echo $phpbb_root_path . 'templates/' . $theme['template_name'] . '/' . $theme['head_stylesheet'];?>" type="text/css">
<title><?php echo $board_config['sitename']; ?></title>
<style>
<!--
body { 
    margin: 0px 0px 0px 0px;
}
-->
</style>
</head>
<body>

<a name="top"></a>

<table width="100%" cellspacing="0" cellpadding="10" border="0" align="center"> 
    <tr> 
        <td><?php
if ( isset($HTTP_POST_VARS['mode']) || isset($HTTP_GET_VARS['mode']) )
{
    $mode = ( isset($HTTP_POST_VARS['mode']) ) ? $HTTP_POST_VARS['mode'] : $HTTP_GET_VARS['mode'];
}
else
{
    $mode = '';
}

switch ( $mode )
{
    case 'confirm_all':?>
        <table class="forumline" width="100%" cellspacing="1" cellpadding="3" border="0">
            <tr>
                <th class="thHead" height="25" valign="middle"><span class="tableTitle"><?php echo $lang['sig_reset'];?></span></th>
            </tr>
            <tr>
                <td class="row1" align="center"><form action="<?php echo "sig_reset.$phpEx?mode=all"?>" method="post"><span class="gen"><br /><?php echo $lang['sig_reset_confirm'];?><br /><br /><input type="submit" name="confirm" value="<?php echo $lang['Yes'];?>" class="liteoption" />&nbsp;&nbsp;<input type="submit" name="cancel" value="<?php echo $lang['No'];?>" class="mainoption" onclick="javascript:window.close();" /></span></form></td>
            </tr>
        </table><?php
        break; 
    
    case 'all':
        $sql = "UPDATE " . USERS_TABLE . " SET user_sig = ''";

        if ( $result = $db->sql_query($sql) )
        {
            $result_msg = $lang['sig_reset_successful'];
        } else
        {
            $result_msg = $lang['sig_reset_failed'];
        }?>

        <table class="forumline" width="100%" cellspacing="1" cellpadding="3" border="0">
            <tr>
                <th class="thHead" height="25" valign="middle"><span class="tableTitle"><?php echo $lang['sig_reset'];?></span></th>
            </tr>
            <tr>
                <td class="row1" align="center"><br /><span class="gen"><br /><?php echo $result_msg;?></span><br /><br /><br /><span class="gensmall"><a href="javascript:window.close();" class="gensmall"><?php echo $lang['Close_window'];?></a></span></td>
            </tr>
        </table><?php
        break; 
}?>
        </td>
    </tr>
</table>

</body>
</html>