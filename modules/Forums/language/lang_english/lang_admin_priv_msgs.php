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
$titanium_lang['PM_View_Type'] = 'PM View Type';
$titanium_lang['Show_IP'] = 'Show IP Address';
$titanium_lang['Rows_Per_Page'] = 'Rows Per Page';
$titanium_lang['Archive_Feature'] = 'Archive Feature';
$titanium_lang['Inline'] = 'Inline';
$titanium_lang['Pop_up'] = 'Pop-up';
$titanium_lang['Current'] = 'Current';
$titanium_lang['Rows_Plus_5'] = 'Add 5 Rows';
$titanium_lang['Rows_Minus_5'] = 'Remove 5 Rows';
$titanium_lang['Enable'] = 'Enable';
$titanium_lang['Disable'] = 'Disable';
$titanium_lang['Inserted_Default_Value'] = '%s Configuration Item did not exist, inserted a default value<br />'; // %s = config name
$titanium_lang['Updated_Config'] = 'Updated Configuration Item %s<br />'; // %s = config item
$titanium_lang['Archive_Table_Inserted'] = 'Archive Table did not exist, created it<br />';
$titanium_lang['Switch_Normal'] = 'Switch To Normal Mode';
$titanium_lang['Switch_Archive'] = 'Switch To Archive Mode';

/* General */
$titanium_lang['Deleted_Message'] = 'Deleted Private Message - %s <br />'; // %s = PM title
$titanium_lang['Archived_Message'] = 'Archived Private Message - %s <br />'; // %s = PM title
$titanium_lang['Archived_Message_No_Delete'] = 'Cannot Delete %s, It Was Marked For Archive As Well <br />'; // %s = PM title
$titanium_lang['Private_Messages'] = 'Private Messages';
$titanium_lang['Private_Messages_Archive'] = 'Private Messages Archive';
$titanium_lang['Archive'] = 'Archive';
$titanium_lang['To'] = 'To';
$titanium_lang['Subject'] = 'Subject';
$titanium_lang['Sent_Date'] = 'Sent Date';
$titanium_lang['Delete'] = 'Delete';
$titanium_lang['From'] = 'From';
$titanium_lang['Sort'] = 'Sort';
$titanium_lang['Filter_By'] = 'Filter By';
$titanium_lang['PM_Type'] = 'PM Type';
$titanium_lang['Status'] = 'Status';
$titanium_lang['No_PMS'] = 'No Private Messages Matching Your Sort Criteria To Display';
$titanium_lang['Archive_Desc'] = 'Private Messages you have chosen to archive are listed here.  Users are no longer able to access these (sender and receiver), but you can view or delete them at any time.';
$titanium_lang['Normal_Desc'] = 'All the Private Messages on your board may be managed here.  You can read any you\'d like and choose to delete or archive (keep, but users cannot view) the messages as well.';
$titanium_lang['Version'] = 'Version';
$titanium_lang['Remove_Old'] = 'Orphan PMs:</a> <span class="gensmall">Users who no longer exist could have left PMs behind, this will remove them.</span>';
$titanium_lang['Remove_Sent'] = 'Sent Box PMs:</a> <span class="gensmall">PMs in the sent box are just copies of the exact same message that was sent, except assigned to the sender after the other user has read the PM.  These are not needed really.</span>';
$titanium_lang['Remove_All'] = 'All PMs:</a> <span class="gensmall">CAUTION: Will clear ALL PMs</span>';
$titanium_lang['Affected_Rows'] = '%d known entries removed<br />';
$titanium_lang['Removed_Old'] = 'Removed All Orphan PMs<br />';
$titanium_lang['Removed_Sent'] = 'Removed All Sent PMs<br />';
$titanium_lang['Removed_All'] = 'Removed All PMs<br />';
$titanium_lang['Utilities'] = 'Mass Deletion Utilities';
$titanium_lang['Nivisec_Com'] = 'Nivisec.com';

/* PM Types */
$titanium_lang['PM_-1'] = 'All Types'; //PRIVMSGS_ALL_MAIL = -1
$titanium_lang['PM_0'] = 'Read PMs'; //PRIVMSGS_READ_MAIL = 0
$titanium_lang['PM_1'] = 'New PMs'; //PRIVMSGS_NEW_MAIL = 1
$titanium_lang['PM_2'] = 'Sent PMs'; //PRIVMSGS_SENT_MAIL = 2
$titanium_lang['PM_3'] = 'Saved PMs (In)'; //PRIVMSGS_SAVED_IN_MAIL = 3
$titanium_lang['PM_4'] = 'Saved PMs (Out)'; //PRIVMSGS_SAVED_OUT_MAIL = 4
$titanium_lang['PM_5'] = 'Unread PMs'; //PRIVMSGS_UNREAD_MAIL = 5

/* Errors */
$titanium_lang['Error_Other_Table'] = 'Error querying a required table.';
$titanium_lang['Error_Posts_Text_Table'] = 'Error querying Private Messages Text table.';
$titanium_lang['Error_Posts_Table'] = 'Error querying Private Messages table.';
$titanium_lang['Error_Posts_Archive_Table'] = 'Error querying Private Messages Archive table.';
$titanium_lang['No_Message_ID'] = 'No message ID was specified.';
/*Special Cases, Do not bother to change for another language */
$titanium_lang['ASC'] = $titanium_lang['Sort_Ascending'];
$titanium_lang['DESC'] = $titanium_lang['Sort_Descending'];
$titanium_lang['privmsgs_date'] = $titanium_lang['Sent_Date'];
$titanium_lang['privmsgs_subject'] = $titanium_lang['Subject'];
$titanium_lang['privmsgs_from_userid'] = $titanium_lang['From'];
$titanium_lang['privmsgs_to_userid'] = $titanium_lang['To'];
$titanium_lang['privmsgs_type'] = $titanium_lang['PM_Type'];

?>