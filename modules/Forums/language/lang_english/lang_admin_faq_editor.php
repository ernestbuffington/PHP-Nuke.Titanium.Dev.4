<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                       lang_admin_faq_editor.php [English]
 *                              -------------------
 *     begin                : Sat Dec 16 2000
 *     copyright            : (C) 2001 The phpBB Group
 *     email                : support@phpbb.com
 *
 *     $Id: lang_admin_faq_editor.php,v 1.0.0.0 2003/07/13 23:24:12 Selven Exp $
 *
 ****************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

$titanium_lang['faq_editor'] = 'Edit Language';
$titanium_lang['faq_editor_explain'] = 'This module allows you to edit and re-arrange your Attachment FAQ, BBCode, Board FAQ . You <u>should not</u> remove or alter the section entitled <strong>phpBB 2 Issues</strong>.';

$titanium_lang['faq_select_language'] = 'Choose the language of the file you want to edit';
$titanium_lang['faq_retrieve'] = 'Retrieve File';

$titanium_lang['faq_block_delete'] = 'Are you sure you want to delete this block?';
$titanium_lang['faq_quest_delete'] = 'Are you sure you wish to delete this question (and its answer)?';

$titanium_lang['faq_quest_edit'] = 'Edit Question & Answer';
$titanium_lang['faq_quest_create'] = 'Create New Question & Answer';

$titanium_lang['faq_quest_edit_explain'] = 'Edit the question and answer. Change the block if you wish.';
$titanium_lang['faq_quest_create_explain'] = 'Type the new question and answer and press Submit.';

$titanium_lang['faq_block'] = 'Block';
$titanium_lang['faq_quest'] = 'Question';
$titanium_lang['faq_answer'] = 'Answer';

$titanium_lang['faq_block_name'] = 'Block Name';
$titanium_lang['faq_block_rename'] = 'Rename a block';
$titanium_lang['faq_block_rename_explain'] = 'Change the name of a block in the file';

$titanium_lang['faq_block_add'] = 'Add Block';
$titanium_lang['faq_quest_add'] = 'Add Question';

$titanium_lang['faq_no_quests'] = 'No questions in this block. This will prevent any blocks after this one being displayed. Delete the block or add one or more questions.';
$titanium_lang['faq_no_blocks'] = 'No blocks defined. Add a new block by typing a name below.';

$titanium_lang['faq_write_file'] = 'Could not write to the language file!';
$titanium_lang['faq_write_file_explain'] = 'You must make the language file in language/lang_english/ or equivilent <i>writeable</i> to use this control panel. On UNIX, this means running <code>chmod 666 filename</code>. Most FTP clients can do through the properties sheet for a file, otherwise you can use telnet or SSH.';

?>