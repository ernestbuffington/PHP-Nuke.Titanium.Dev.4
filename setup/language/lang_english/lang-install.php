<?php

/*=======================================================================
 PHP-Nuke Titanium Dev 4: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/
/************************************************************************
  Nuke-Evolution: Advanced Installer
  ============================================
  Copyright (c) 2010 by The PHP-Nuke Titanium Team

  Filename           : lang-install.php
  Author             : Technocrat
  Design Layout      : The Mortal (RealmDesignz.com)
  Code Modifications : The Mortal
  Version            : 1.0.2
  Date               : 01.05.2019 (mm.dd.yyyy)

  Notes              : You may NOT use this installer for your own
                       needs or script. It is written specifically
                       for Nuke-Evolution and/or Xtreme
************************************************************************/

$step_a[1] = "Step 1: Language Selection";
$step_a[2] = "Step 2: Server Specifications";
$step_a[3] = "Step 3: File CHMOD Check";
$step_a[4] = "Step 4: Database Connection";
$step_a[5] = "Step 5: SQL Installation";

$step_a[6] = "Step 6: IP to Country database";

$step_a[7] = "Step 7: Setup First Admin";
$step_a[8] = "Step 8: Setup Site Configs";
$step_a[9] = "Step 9: Confirm All Settings";
$step_a[10] = "Finish Installation";

// New Language
$install_lang['go_back'] = "Go Back To Previous Page";
$install_lang['lang_stitle'] = "Select A Language";
$install_lang['lang_select'] = "Select your language from drop-down menu:";
$install_lang['chmod_check'] = "CHMOD File/Folder Check";
$install_lang['mysql_info'] = "MySQL Connection Info";
$install_lang['mysql_check'] = "MySQL Connection Check";
$install_lang['server_check'] = "Server Check";
$install_lang['sql_install'] = "Importing PHP-Nuke Titanium Database";
$install_lang['sql2_install'] = "Importing PHP-Nuke Titanium IP to Country Database";

$install_lang['sql_install_success'] = "Importing PHP-Nuke Titanium Database Was Successful";
$install_lang['sql2_install_success'] = "Importing PHP-Nuke Titanium IP to Country Database Was Successful";

$install_lang['retry_sql'] = "Retry SQL Installation";
$install_lang['setup_admin'] = "Setup Your First Admin Account";
$install_lang['admin_check'] = "Admin Account Validation";
$install_lang['admin_nick'] = "Admin Nickname:";
$install_lang['admin_pass'] = "Admin Password:";
$install_lang['admin_cpass'] = "Confirm Password:";
$install_lang['admin_email'] = "Admin Email:";
$install_lang['admin_web'] = "Admin Homepage:";
$install_lang['admin_success'] = "Your god administration account was created successfully along with a user account.";
$install_lang['admin_fail'] = "The password's you entered do not match.";
$install_lang['admin_nfail'] = "The nickname you entered is not valid.";
$install_lang['admin_efail'] = "The email you entered is not valid.";
$install_lang['god_fail'] = "Failed to insert admin data into nuke authors table.";
$install_lang['nsnst_fail'] = "Failed to insert admin protection data into nuke sentinel table.";
$install_lang['user_fail'] = "Failed to insert user data into nuke users table.";
$install_lang['setup_config'] = "Setup Site/Forum Configuration";
$install_lang['server_title'] = "Server Specifications";
$install_lang['os'] = "Operating System:";
$install_lang['po'] = "Process Owner:";
$install_lang['fo'] = "File Owner:";
$install_lang['rp'] = "Root Path:";
$install_lang['rtp'] = "Root Permissions:";
$install_lang['interface'] = "Interface:";
$install_lang['openbasedir'] = "open_basedir:";
$install_lang['safemode'] = "safe_mode:";
$install_lang['safemodegid'] = "safe_mode_gid:";
$install_lang['safemodeexecdir'] = "safe_mode_exec_dir:";
$install_lang['safemodeincludedir'] = "safe_mode_include_dir:";
$install_lang['disablefunctions'] = "disable_functions:";
$install_lang['file_uploads'] = "file_uploads:";
$install_lang['upload_tmp_dir'] = "upload_tmp_dir:";
$install_lang['upload_max_filesize'] = "upload_max_filesize:";
$install_lang['upload_file'] = "Upload Test File:";
$install_lang['next_step'] = "Next Step";
$install_lang['site_name'] = "Site Name:";
$install_lang['site_url'] = "Site URL:";
$install_lang['site_slogan'] = "Site Slogan:";
$install_lang['start_date'] = "Site Start Date:";
$install_lang['admin_email'] = "Administrator Email:";
$install_lang['setup_overview'] = "Confirm Your Site Settings";
$install_lang['return_setup'] = "Return To Setup";
$install_lang['finish_install'] = "Installation Finished";
$install_lang['access_files'] = '<strong>NOTE:</strong> If your missing the .htaccess or .staccess file simply rename evo.htaccess and or evo.staccess to the relative filenames they should be!';

$install_lang['briefing'] = "This will install $nuke_name on your server";
$install_lang['couldnt_connect'] = "Could not connect to database<br />";
$install_lang['couldnt_select_db'] = "Could not select database<br />";
$install_lang['continue'] = "Continue To Step";
$install_lang['connection_failed'] = "Connection to the server has failed! Make sure your settings are correct.";
$install_lang['connection_failed2'] = "Connection to the database has failed! Make sure your settings are correct. (Database name)";
$install_lang['chmod'] = "CHMOD Required Files";
$install_lang['config_maker'] = "Config.php Generator";
$install_lang['configure'] = "Configure Site";
$install_lang['cant_open'] = "Cannot open file";
$install_lang['cantwrite'] = "Cannot write to file";
$install_lang['chmod_failed'] = "One or more files has failed, please manually chmod them.";
$install_lang['config_success'] = "PHP-Nuke Titanium's Config.php was generated Successfully.";
$install_lang['cookie_name'] = "Cookie Name:";
$install_lang['cookie_path'] = "Cookie Path:";
$install_lang['cookie_domain'] = "Cookie Domain:";
$install_lang['config_failed'] = "PHP-Nuke Titanium's Config.php generation failed.";
$install_lang['installer_heading'] = "Installer :: Step";
$install_lang['installer_heading2'] = "of";
$install_lang['dbhost'] = "DB Host:";
$install_lang['dbname'] = "DB Name:";
$install_lang['dbuser'] = "DB User:";
$install_lang['dbpass'] = "DB Password:";
$install_lang['dbtype'] = "DB Type:";
$install_lang['dbhost_error'] = "You must enter a database host (default is \"localhost\")";
$install_lang['dbname_error'] = "You must enter a database name.";
$install_lang['dbuser_error'] = "You must enter a database user.";
$install_lang['dbpass_error'] = "You must enter a database password.";
$install_lang['dbtype_error'] = "You must select a database type.";
$install_lang['data_success'] = "Data validation and SQL Server Checks completed succsesfully!";
$install_lang['die_message'] = "General Error";
$install_lang['prefix'] = "Prefix:";
$install_lang['user_prefix'] = "User Prefix:";
$install_lang['confirm_data'] = "Confirm Data";
$install_lang['server_check'] = "Server Check";
$install_lang['skip'] = "Skip Configuration";
$install_lang['failed'] = "FAILED";
$install_lang['success'] = "SUCCESS";
$install_lang['thefile'] = "The file";
$install_lang['is_missing'] = "is missing.<br />";
$install_lang['prefix_error'] = "You must enter a prefix.";
$install_lang['uprefix_error'] = "You must enter a user prefix.";
$install_lang['mysql_incorrect'] = "<font color=red>Your MySQL version is not correct!</font><br />Your server is reporting a MySQL version of '.$sql_version.' and 4.x is required.";
$install_lang['dbtype_que'] = "You have chosen something other than MySQL as your database type, are you sure you wish to use this? If you are not sure, you need to go back and select MySQL.";
$install_lang['session_lost'] = "Your Session Data was lost, please run install again.";
$install_lang['php_ver'] = "Your PHP version is incorrect!</font></strong><br />4.x.x is required - Your version is";
$install_lang['checks_good'] = "All checks completed Successfully. Please continue.";
$install_lang['sql_error'] = "There has been a MySQL error. <strong>MySQL Error Details:</strong></font><br />";
$install_lang['install_success'] = "Your installation of $nuke_name has been Successful.";
$install_lang['get_config_error'] = "Could not query config information<br />";
$install_lang['update_fail'] = "Failed to update configuration for";
$install_lang['sitename'] = "Forum Site URL:";
$install_lang['sitedescr'] = "Site Description:";
$install_lang['namechange'] = "Allow Namechange:";
$install_lang['yes'] = "Yes:";
$install_lang['no'] = "No:";
$install_lang['email_sig'] = "Email Sig:";
$install_lang['site_email'] = "Site E-Mail:";
$install_lang['default_lang'] = "Default Language:";
$install_lang['server_name'] = "Server Name:";
$install_lang['server_port'] = "Server Port:";
$install_lang['done'] = "Thank you for choosing PHP-Nuke Titanium.<br /><br /><a href=index.php>Goto your homepage</a>";
$install_lang['delete'] = "<font color=\"red\">Please delete install.php and the install folder</font>";
$install_lang['install_complete_header'] = " :: Installation Complete";
$install_lang['general_message'] = "General Message";
$install_lang['data_error'] = "Cannot open data.txt";
$install_lang['safe_mode'] = "Your php is currently in safe mode.<br /><br />This will keep the installer from finishing.<br /><br />You must install PHP-Nuke Titanium manually.<br /><br />Please see the install help file to manually install.";

?>