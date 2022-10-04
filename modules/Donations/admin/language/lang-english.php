<?php

/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

global $lang_donate;

//Common
$lang_donate['ADMIN_HEADER'] = 'Nuke-Evolution Donations :: Modules Admin Panel';
$lang_donate['RETURNMAIN'] = 'Return to Main Administration';
$lang_donate['DONATIONS'] = 'Donations';
$lang_donate['CURRENT_DONATIONS'] = 'Current Donations';
$lang_donate['DONATION_VALUES'] = 'Donation Values';
$lang_donate['CONFIG_BLOCK'] = 'Config Block';
$lang_donate['CONFIG_GENERAL'] = 'Config Donations';
$lang_donate['CONFIG_PAGE'] = 'Config Page';
$lang_donate['ADD_DONATION'] = 'Add Donation';
$lang_donate['BREAK'] = ':';
$lang_donate['YES'] = 'Yes';
$lang_donate['NO'] = 'No';
$lang_donate['DONATION_SUBMIT'] = 'Submit';

//Config Page & Config Block
$lang_donate['SHOW_AMOUNTS'] = 'Show amounts';
$lang_donate['SHOW_GOAL'] = 'Show goal';
$lang_donate['SHOW_ANON_AMNTS'] = 'Show anonymous';
$lang_donate['BUTTON_IMAGE'] = 'Button image';
$lang_donate['NUM_DONATIONS'] = 'Number of donations shown';
$lang_donate['SHOW_DATES'] = 'Show donation dates';

//Config Page
$lang_donate['PAGE_HEADER_IMG'] = 'Page Header Image';

//Config Donation
$lang_donate['PP_EMAIL'] = 'PayPal Email Address';
$lang_donate['CURRENCY'] = 'Currency';
$lang_donate['DONATION_NAME'] = 'Donation Name';
$lang_donate['DONATION_CODE'] = 'Donation Code';
$lang_donate['MONTHLY_GOAL'] = 'Monthly Goal';
$lang_donate['DATE_FORMAT'] = 'Date Format (<a href="http://us3.php.net/date">PHP Date</a>)';
$lang_donate['TYPE'] = 'Type Of Donations';
$lang_donate['TYPE_PRIVATE'] = 'Private';
$lang_donate['TYPE_ANON'] = 'Anonymous';
$lang_donate['TYPE_REGULAR'] = 'Regular';
$lang_donate['THANK_YOU'] = 'Thank You';
$lang_donate['IMAGE'] = 'Image';
$lang_donate['MESSAGE'] = 'Message';
$lang_donate['CANCEL'] = 'Cancel';
$lang_donate['ALLOW_MESSAGE'] = 'Allow Message/Reason';
$lang_donate['SCROLL'] = 'Scrollable donation list';
$lang_donate['NUMBERS'] = 'Show numbers';
$lang_donate['CODES'] = 'Donations codes';
$lang_donate['COOKIE_TRACK'] = 'Track donations with cookies';

//Add Donation
$lang_donate['ADD_DONATION'] = 'Add Donation';
$lang_donate['UNAME'] = 'Username';
$lang_donate['FIRST_NAME'] = 'First Name';
$lang_donate['LAST_NAME'] = 'Last Name';
$lang_donate['EMAIL_ADD'] = 'Email Address';
$lang_donate['DONATION'] = 'Donation';
$lang_donate['ADDED'] = 'Donation added';
$lang_donate['ADD_TYPE'] = 'Type of Donation';
$lang_donate['DONATE_TO'] = 'Donate to';
$lang_donate['submit'] = 'Submit';

//Security
$lang_donate['ACCESS_DENIED'] = '<span style="color: #FF0000; font-weight: bold;">Access Denied</span>';

//Errors
$lang_donate['ERROR'] = '<span style="color: #FF0000; font-weight: bold;">ERROR!</span><br />';
$lang_donate['VALUES_NF'] = 'Could not find values';
$lang_donate['VALUES_ND'] = 'Could not display values';
$lang_donate['UNAMES_NF'] = 'Could not find username';
$lang_donate['UINFO_NF'] = 'Could not get user information';
$lang_donate['TYPES_NF'] = 'Could not get donation types';
$lang_donate['MISSING_FNAME'] = 'Please enter a first name';
$lang_donate['MISSING_LNAME'] = 'Please enter a last name';
$lang_donate['INVALID_DONATION'] = 'Please enter a valid donation';
$lang_donate['INVALID_EMAIL'] = 'Please enter a valid email address';
$lang_donate['CODES_SHORT'] = 'You must enter a code name, and a PayPal code in the Donations codes:';
$lang_donate['CODES_SPACES'] = 'Spaces are not allowed in the code';

//Current
$lang_donate['DATE'] = 'Date';
$lang_donate['USERNAME'] = 'Username';
$lang_donate['AMOUNT'] = 'Amount';
$lang_donate['TOTAL'] = 'Total';
$lang_donate['GOAL'] = 'Goal';
$lang_donate['DIFF'] = 'Difference';
$lang_donate['NEXT'] = 'Next';
$lang_donate['PREV'] = 'Previous';
$lang_donate['NEXT_DIRECTION'] = '&gt;&gt;';
$lang_donate['PREV_DIRECTION'] = '&lt;&lt;';
$lang_donate['N/A'] = 'N/A';

//Help
$lang_donate['HELP_DONATION_ANON'] = 'Everything except the donation is hidden from the admin(s).<br /><br /><strong>NOTE:</strong> PayPal will still have all the information so it is not 100% anonymous';
$lang_donate['HELP_DONATION_PRIVATE'] = 'Donations are hidden from the public but <strong>not</strong> the admin.';
$lang_donate['HELP_DONATION_NAME'] = 'This is the primary donation type';
$lang_donate['HELP_DONATION_CODE'] = 'This is the primary donation type code in Paypal';
$lang_donate['HELP_DONATION_CODES'] = 'This is where you can put in other donation types and codes.  This is <strong>optional</strong>.<br /><br />For example if you wanted to make a code for hospital bills.<hr />The first line is the text '
                                      .'which will show up in the combo box.  Make sure you put something that will make sense to people.  Spaces are allowed.<br />So for this example: Hospital Bills<br /><br />'
                                      .'The next line is the PayPal code you want to use.<br />Spaces are <strong>NOT</strong> allowed!<br />So for this example: hospital_bills<hr />So the final result would be:<br />'
                                      .'Hospital Bills<br />hospital_bills';
$lang_donate['HELP_COOKIE_TRACK'] = 'This will hold donation values in a users cookies.  It adds another way to help track donations.<br /><strong>This should only be used if you are having problems!</strong>';
?>