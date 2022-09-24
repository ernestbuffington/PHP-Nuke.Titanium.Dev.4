<?php

/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

global $titanium_lang_donate;

//Common
$titanium_lang_donate['DONATIONS'] = 'Donations';
$titanium_lang_donate['BREAK'] = ':';
$titanium_lang_donate['DONATE'] = 'Donate';
$titanium_lang_donate['CONFIRM'] = 'Confirm';

//Index
$titanium_lang_donate['VIEW_DONATIONS'] = 'View Donations';
$titanium_lang_donate['MAKE_DONATIONS'] = 'Make Donations';

//Errors
$titanium_lang_donate['GEN_NF'] = 'General setting could not be found';
$titanium_lang_donate['PAGE_NF'] = 'Page setting could not be found';
$titanium_lang_donate['DON_NF'] = 'Donations could not be found';
$titanium_lang_donate['VALUES_NF'] = 'Donations values could not be found';
$titanium_lang_donate['CURRENCY_NF'] = 'Currency code could not be found';
$titanium_lang_donate['FAILED'] = 'Donation failed to record!';
$titanium_lang_donate['ERROR'] = '<span style="color: #FF0000; font-weight: bold;">ERROR!</span><br />';
$titanium_lang_donate['NO_PP_ADD'] = 'PayPal address has not been setup';

//View
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

//Make
$titanium_lang_donate['AMOUNT'] = 'Amount';
$titanium_lang_donate['TYPE_PRIVATE'] = 'Private';
$titanium_lang_donate['TYPE_ANON'] = 'Anonymous';
$titanium_lang_donate['TYPE_REGULAR'] = 'Regular';
$titanium_lang_donate['TYPE'] = 'Type of donation';
$titanium_lang_donate['MESSAGE'] = 'Message/Reason';
$titanium_lang_donate['DONATE_TO'] = 'Donate to';

//Help
$titanium_lang_donate['HELP_TOTAL'] = 'This will show the total amount donated so far.';
$titanium_lang_donate['HELP_GOAL'] = 'This will show the total amount donated so far this month vs the monthly goal.';
$titanium_lang_donate['HELP_DONATION_REGULAR'] = 'Everything is public';
$titanium_lang_donate['HELP_DONATION_ANON'] = 'Everything except the donation is hidden from the admin(s).<br /><br /><strong>NOTE:</strong> PayPal will still have all your information so it is not 100% anonymous';
$titanium_lang_donate['HELP_DONATION_PRIVATE'] = 'Your donation is hidden from the public but <strong>not</strong> the admin.';

//Confirm
$titanium_lang_donate['CONFIRM_DONATION'] = 'Please confirm your donation of %s %s?';
$titanium_lang_donate['COME_BACK'] = 'After you have made your donation <strong>PLEASE</strong> make sure you use the button in paypal to return to this site or your donation will not count.';

?>