<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
*                            $RCSfile: lang_admin_topic_shadow.php,v $
*                            -------------------
*   copyright            : (C) 2002-2003 Nivisec.com
*   email                : support@nivisec.com
*
*   $Id: lang_admin_topic_shadow.php,v 1.3 2003/06/26 00:16:32 nivisec Exp $
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

/* If you are translating this, please e-mail a copy to me! */
/* admin@nivisec.com is fine to use */

/* General */
$titanium_lang['Del_Before_Date'] = 'Deleted all Shadow Topics before %s<br />'; // %s = insertion of date
$titanium_lang['Deleted_Topic'] = 'Deleted Shadow Topic %s<br />'; // %s = topic name
$titanium_lang['Affected_Rows'] = '%d known entries were affected<br />'; // %d = affected rows (not avail with all databases!)
$titanium_lang['Delete_From_Date'] = 'All Shadow Topics that were created before the entered date will be removed.';
$titanium_lang['Delete_Before_Date_Button'] = 'Delete All Before Date';
$titanium_lang['No_Shadow_Topics'] = 'No Shadow Topics were found.';
$titanium_lang['Topic_Shadow'] = 'Topic Shadow';
$titanium_lang['TS_Desc'] = 'Allows the removal of shadow topics without the deletion of the actual message.  Shadow topics are created when you move a post to another forum and choose to leave behind a link in the original forum to the new post.';
$titanium_lang['Month'] = 'Month';
$titanium_lang['Day'] = 'Day';
$titanium_lang['Year'] = 'Year';
$titanium_lang['Clear'] = 'Clear';
$titanium_lang['Resync_Ran_On'] = 'Resync Ran On %s<br />'; // %s = insertion of forum name
$titanium_lang['All_Forums'] = 'All Forums';
$titanium_lang['Version'] = 'Version';

$titanium_lang['Title'] = 'Title';
$titanium_lang['Moved_To'] = 'Moved To';
$titanium_lang['Moved_From'] = 'Moved From';
$titanium_lang['Delete'] = 'Delete';

/* Modes */
$titanium_lang['topic_time'] = 'Topic Time';
$titanium_lang['topic_title'] = 'Topic Title';

/* Errors */
$titanium_lang['Error_Month'] = 'Your input month must be between 1 and 12';
$titanium_lang['Error_Day'] = 'Your input day must be between 1 and 31';
$titanium_lang['Error_Year'] = 'Your input year must be between 1970 and 2038';
$titanium_lang['Error_Topics_Table'] = 'Error accessing topics table';

//Special Cases, Do not change for another language
$titanium_lang['ASC'] = $titanium_lang['Sort_Ascending'];
$titanium_lang['DESC'] = $titanium_lang['Sort_Descending'];
$titanium_lang['Nivisec_Com'] = 'Nivisec.com';

?>