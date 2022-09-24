<?php

/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

global $titanium_lang_donate;

//Common
$titanium_lang_donate['ADMIN_HEADER'] = 'Nuke-Evolution Donations :: Modules Admin Panel';
$titanium_lang_donate['RETURNMAIN'] = 'Return to Main Administration';
$titanium_lang_donate['DONATIONS'] = 'Donations';
$titanium_lang_donate['CURRENT_DONATIONS'] = 'Current Donations';
$titanium_lang_donate['DONATION_VALUES'] = 'Donation Values';
$titanium_lang_donate['CONFIG_BLOCK'] = 'Config Block';
$titanium_lang_donate['CONFIG_GENERAL'] = 'Config Donations';
$titanium_lang_donate['CONFIG_PAGE'] = 'Config Page';
$titanium_lang_donate['ADD_DONATION'] = 'Add Donation';
$titanium_lang_donate['BREAK'] = ':';
$titanium_lang_donate['YES'] = 'Yes';
$titanium_lang_donate['NO'] = 'No';
$titanium_lang_donate['DONATION_SUBMIT'] = 'Submit';

//Config Page & Config Block
$titanium_lang_donate['SHOW_AMOUNTS'] = 'Show amounts';
$titanium_lang_donate['SHOW_GOAL'] = 'Show goal';
$titanium_lang_donate['SHOW_ANON_AMNTS'] = 'Show anonymous';
$titanium_lang_donate['BUTTON_IMAGE'] = 'Button image';
$titanium_lang_donate['NUM_DONATIONS'] = 'Number of donations shown';
$titanium_lang_donate['SHOW_DATES'] = 'Show donation dates';

//Config Page
$titanium_lang_donate['PAGE_HEADER_IMG'] = 'Page Header Image';

//Config Donation
$titanium_lang_donate['PP_EMAIL'] = 'PayPal Email Address';
$titanium_lang_donate['CURRENCY'] = 'Currency';
$titanium_lang_donate['DONATION_NAME'] = 'Donation Name';
$titanium_lang_donate['DONATION_CODE'] = 'Donation Code';
$titanium_lang_donate['MONTHLY_GOAL'] = 'Monthly Goal';
$titanium_lang_donate['DATE_FORMAT'] = 'Date Format (<a href="http://us3.php.net/date">PHP Date</a>)';
$titanium_lang_donate['TYPE'] = 'Type Of Donations';
$titanium_lang_donate['TYPE_PRIVATE'] = 'Private';
$titanium_lang_donate['TYPE_ANON'] = 'Anonymous';
$titanium_lang_donate['TYPE_REGULAR'] = 'Regular';
$titanium_lang_donate['THANK_YOU'] = 'Thank You';
$titanium_lang_donate['IMAGE'] = 'Image';
$titanium_lang_donate['MESSAGE'] = 'Message';
$titanium_lang_donate['CANCEL'] = 'Cancel';
$titanium_lang_donate['ALLOW_MESSAGE'] = 'Allow Message/Reason';
$titanium_lang_donate['SCROLL'] = 'Scrollable donation list';
$titanium_lang_donate['NUMBERS'] = 'Show numbers';
$titanium_lang_donate['CODES'] = 'Donations codes';
$titanium_lang_donate['COOKIE_TRACK'] = 'Track donations with cookies';

//Add Donation
$titanium_lang_donate['ADD_DONATION'] = 'Add Donation';
$titanium_lang_donate['UNAME'] = 'Username';
$titanium_lang_donate['FIRST_NAME'] = 'First Name';
$titanium_lang_donate['LAST_NAME'] = 'Last Name';
$titanium_lang_donate['EMAIL_ADD'] = 'Email Address';
$titanium_lang_donate['DONATION'] = 'Donation';
$titanium_lang_donate['ADDED'] = 'Donation added';
$titanium_lang_donate['ADD_TYPE'] = 'Type of Donation';
$titanium_lang_donate['DONATE_TO'] = 'Donate to';
$titanium_lang_donate['submit'] = 'Submit';

//Security
$titanium_lang_donate['ACCESS_DENIED'] = '<span style="color: #FF0000; font-weight: bold;">Access Denied</span>';

//Errors
$titanium_lang_donate['ERROR'] = '<span style="color: #FF0000; font-weight: bold;">ERROR!</span><br />';
$titanium_lang_donate['VALUES_NF'] = 'Could not find values';
$titanium_lang_donate['VALUES_ND'] = 'Could not display values';
$titanium_lang_donate['UNAMES_NF'] = 'Could not find username';
$titanium_lang_donate['UINFO_NF'] = 'Could not get user information';
$titanium_lang_donate['TYPES_NF'] = 'Could not get donation types';
$titanium_lang_donate['MISSING_FNAME'] = 'Please enter a first name';
$titanium_lang_donate['MISSING_LNAME'] = 'Please enter a last name';
$titanium_lang_donate['INVALID_DONATION'] = 'Please enter a valid donation';
$titanium_lang_donate['INVALID_EMAIL'] = 'Please enter a valid email address';
$titanium_lang_donate['CODES_SHORT'] = 'You must enter a code name, and a PayPal code in the Donations codes:';
$titanium_lang_donate['CODES_SPACES'] = 'Spaces are not allowed in the code';

//Current
$titanium_lang_donate['DATE'] = 'Date';
$titanium_lang_donate['USERNAME'] = 'Username';
$titanium_lang_donate['AMOUNT'] = 'Amount';
$titanium_lang_donate['TOTAL'] = 'Total';
$titanium_lang_donate['GOAL'] = 'Goal';
$titanium_lang_donate['DIFF'] = 'Difference';
$titanium_lang_donate['NEXT'] = 'Next';
$titanium_lang_donate['PREV'] = 'Previous';
$titanium_lang_donate['NEXT_DIRECTION'] = '&gt;&gt;';
$titanium_lang_donate['PREV_DIRECTION'] = '&lt;&lt;';
$titanium_lang_donate['N/A'] = 'N/A';

//Help
$titanium_lang_donate['HELP_DONATION_ANON'] = 'Everything except the donation is hidden from the admin(s).<br /><br /><strong>NOTE:</strong> PayPal will still have all the information so it is not 100% anonymous';
$titanium_lang_donate['HELP_DONATION_PRIVATE'] = 'Donations are hidden from the public but <strong>not</strong> the admin.';
$titanium_lang_donate['HELP_DONATION_NAME'] = 'This is the primary donation type';
$titanium_lang_donate['HELP_DONATION_CODE'] = 'This is the primary donation type code in Paypal';
$titanium_lang_donate['HELP_DONATION_CODES'] = 'This is where you can put in other donation types and codes.  This is <strong>optional</strong>.<br /><br />For example if you wanted to make a code for hospital bills.<hr />The first line is the text '
                                      .'which will show up in the combo box.  Make sure you put something that will make sense to people.  Spaces are allowed.<br />So for this example: Hospital Bills<br /><br />'
                                      .'The next line is the PayPal code you want to use.<br />Spaces are <strong>NOT</strong> allowed!<br />So for this example: hospital_bills<hr />So the final result would be:<br />'
                                      .'Hospital Bills<br />hospital_bills';
$titanium_lang_donate['HELP_COOKIE_TRACK'] = 'This will hold donation values in a users cookies.  It adds another way to help track donations.<br /><strong>This should only be used if you are having problems!</strong>';
?>