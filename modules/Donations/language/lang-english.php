<?php

/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

global $lang_donate;

//Common
$lang_donate['DONATIONS'] = 'Donations';
$lang_donate['BREAK'] = ':';
$lang_donate['DONATE'] = 'Donate';
$lang_donate['CONFIRM'] = 'Confirm';

//Index
$lang_donate['VIEW_DONATIONS'] = 'View Donations';
$lang_donate['MAKE_DONATIONS'] = 'Make Donations';

//Errors
$lang_donate['GEN_NF'] = 'General setting could not be found';
$lang_donate['PAGE_NF'] = 'Page setting could not be found';
$lang_donate['DON_NF'] = 'Donations could not be found';
$lang_donate['VALUES_NF'] = 'Donations values could not be found';
$lang_donate['CURRENCY_NF'] = 'Currency code could not be found';
$lang_donate['FAILED'] = 'Donation failed to record!';
$lang_donate['ERROR'] = '<span style="color: #FF0000; font-weight: bold;">ERROR!</span><br />';
$lang_donate['NO_PP_ADD'] = 'PayPal address has not been setup';

//View
$lang_donate['DATE'] = 'Date';
$lang_donate['USERNAME'] = 'Username';
$lang_donate['AMOUNT'] = 'Amount'; #1
$lang_donate['TOTAL'] = 'Total';
$lang_donate['GOAL'] = 'Goal';
$lang_donate['DIFF'] = 'Difference';
$lang_donate['NEXT'] = 'Next';
$lang_donate['PREV'] = 'Previous';
$lang_donate['NEXT_DIRECTION'] = '&gt;&gt;';
$lang_donate['PREV_DIRECTION'] = '&lt;&lt;';
$lang_donate['N/A'] = 'N/A';

//Make
$lang_donate['TYPE_PRIVATE'] = 'Private';
$lang_donate['TYPE_ANON'] = 'Anonymous';
$lang_donate['TYPE_REGULAR'] = 'Regular';
$lang_donate['TYPE'] = 'Type of donation';
$lang_donate['MESSAGE'] = 'Message/Reason';
$lang_donate['DONATE_TO'] = 'Donate to';

//Help
$lang_donate['HELP_TOTAL'] = 'This will show the total amount donated so far.';
$lang_donate['HELP_GOAL'] = 'This will show the total amount donated so far this month vs the monthly goal.';
$lang_donate['HELP_DONATION_REGULAR'] = 'Everything is public';
$lang_donate['HELP_DONATION_ANON'] = 'Everything except the donation is hidden from the admin(s).<br /><br /><strong>NOTE:</strong> PayPal will still have all your information so it is not 100% anonymous';
$lang_donate['HELP_DONATION_PRIVATE'] = 'Your donation is hidden from the public but <strong>not</strong> the admin.';

//Confirm
$lang_donate['CONFIRM_DONATION'] = 'Please confirm your donation of %s %s?';
$lang_donate['COME_BACK'] = 'After you have made your donation <strong>PLEASE</strong> make sure you use the button in paypal to return to this site or your donation will not count.';

?>