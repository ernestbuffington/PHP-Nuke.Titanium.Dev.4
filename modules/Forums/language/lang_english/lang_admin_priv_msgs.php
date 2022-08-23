<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
*                            $RCSfile: lang_admin_priv_msgs.php,v $
*                            -------------------
*   begin                : Tue January 20 2002
*   copyright            : (C) 2002-2003 Nivisec.com
*   email                : support@nivisec.com
*
*   $Id: lang_admin_priv_msgs.php,v 1.1 2005/07/21 15:49:49 Nivisec Exp $
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

/*************/
/*  IF YOU TRANSLATE THIS FILE, PLEASE UPLOAD IT AT:
/* http://www.nivisec.com/phpbb.php?l=ad
/*************/

/* Added in 1.6.0 */
$lang['PM_View_Type'] = 'PM View Type';
$lang['Show_IP'] = 'Show IP Address';
$lang['Rows_Per_Page'] = 'Rows Per Page';
$lang['Archive_Feature'] = 'Archive Feature';
$lang['Inline'] = 'Inline';
$lang['Pop_up'] = 'Pop-up';
$lang['Current'] = 'Current';
$lang['Rows_Plus_5'] = 'Add 5 Rows';
$lang['Rows_Minus_5'] = 'Remove 5 Rows';
$lang['Enable'] = 'Enable';
$lang['Disable'] = 'Disable';
$lang['Inserted_Default_Value'] = '%s Configuration Item did not exist, inserted a default value<br />'; // %s = config name
$lang['Updated_Config'] = 'Updated Configuration Item %s<br />'; // %s = config item
$lang['Archive_Table_Inserted'] = 'Archive Table did not exist, created it<br />';
$lang['Switch_Normal'] = 'Switch To Normal Mode';
$lang['Switch_Archive'] = 'Switch To Archive Mode';

/* General */
$lang['Deleted_Message'] = 'Deleted Private Message - %s <br />'; // %s = PM title
$lang['Archived_Message'] = 'Archived Private Message - %s <br />'; // %s = PM title
$lang['Archived_Message_No_Delete'] = 'Cannot Delete %s, It Was Marked For Archive As Well <br />'; // %s = PM title
$lang['Private_Messages'] = 'Private Messages';
$lang['Private_Messages_Archive'] = 'Private Messages Archive';
$lang['Archive'] = 'Archive';
$lang['To'] = 'To';
$lang['Subject'] = 'Subject';
$lang['Sent_Date'] = 'Sent Date';
$lang['Delete'] = 'Delete';
$lang['From'] = 'From';
$lang['Sort'] = 'Sort';
$lang['Filter_By'] = 'Filter By';
$lang['PM_Type'] = 'PM Type';
$lang['Status'] = 'Status';
$lang['No_PMS'] = 'No Private Messages Matching Your Sort Criteria To Display';
$lang['Archive_Desc'] = 'Private Messages you have chosen to archive are listed here.  Users are no longer able to access these (sender and receiver), but you can view or delete them at any time.';
$lang['Normal_Desc'] = 'All the Private Messages on your board may be managed here.  You can read any you\'d like and choose to delete or archive (keep, but users cannot view) the messages as well.';
$lang['Version'] = 'Version';
$lang['Remove_Old'] = 'Orphan PMs:</a> <span class="gensmall">Users who no longer exist could have left PMs behind, this will remove them.</span>';
$lang['Remove_Sent'] = 'Sent Box PMs:</a> <span class="gensmall">PMs in the sent box are just copies of the exact same message that was sent, except assigned to the sender after the other user has read the PM.  These are not needed really.</span>';
$lang['Remove_All'] = 'All PMs:</a> <span class="gensmall">CAUTION: Will clear ALL PMs</span>';
$lang['Affected_Rows'] = '%d known entries removed<br />';
$lang['Removed_Old'] = 'Removed All Orphan PMs<br />';
$lang['Removed_Sent'] = 'Removed All Sent PMs<br />';
$lang['Removed_All'] = 'Removed All PMs<br />';
$lang['Utilities'] = 'Mass Deletion Utilities';
$lang['Nivisec_Com'] = 'Nivisec.com';

/* PM Types */
$lang['PM_-1'] = 'All Types'; //PRIVMSGS_ALL_MAIL = -1
$lang['PM_0'] = 'Read PMs'; //PRIVMSGS_READ_MAIL = 0
$lang['PM_1'] = 'New PMs'; //PRIVMSGS_NEW_MAIL = 1
$lang['PM_2'] = 'Sent PMs'; //PRIVMSGS_SENT_MAIL = 2
$lang['PM_3'] = 'Saved PMs (In)'; //PRIVMSGS_SAVED_IN_MAIL = 3
$lang['PM_4'] = 'Saved PMs (Out)'; //PRIVMSGS_SAVED_OUT_MAIL = 4
$lang['PM_5'] = 'Unread PMs'; //PRIVMSGS_UNREAD_MAIL = 5

/* Errors */
$lang['Error_Other_Table'] = 'Error querying a required table.';
$lang['Error_Posts_Text_Table'] = 'Error querying Private Messages Text table.';
$lang['Error_Posts_Table'] = 'Error querying Private Messages table.';
$lang['Error_Posts_Archive_Table'] = 'Error querying Private Messages Archive table.';
$lang['No_Message_ID'] = 'No message ID was specified.';
/*Special Cases, Do not bother to change for another language */
$lang['ASC'] = $lang['Sort_Ascending'];
$lang['DESC'] = $lang['Sort_Descending'];
$lang['privmsgs_date'] = $lang['Sent_Date'];
$lang['privmsgs_subject'] = $lang['Subject'];
$lang['privmsgs_from_userid'] = $lang['From'];
$lang['privmsgs_to_userid'] = $lang['To'];
$lang['privmsgs_type'] = $lang['PM_Type'];

?>