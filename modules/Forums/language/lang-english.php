<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


######################################################################
# Modulo Splatt Forum per PHP-NUKE
#-------------------------
# Versione: 3.2
#
#  by:
#
# Giorgio Ciranni (~Splatt~) (http://www.splatt.it) (webmaster@splatt.it)
#
#
# Supporto tecnico disponibile sul Forum di www.splatt.it
######################################################################
# This program is free software. You can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License.
######################################################################

/*****************************************************/
/* Messaggi Modulo Forum
/*****************************************************/

global $sitename;

define("_FORUM","Forum");
define("_FORUMACC","Users");
define("_FORUMCONF","Configuration");
define("_FORUMRANK","Ranks");
define("_UNABLETOQUERY","Connection to the Bankrupt Database");
define("_TODAYIS","Today is ");
// define("_LASTVISIT","Your last visit to the forum was ");
define("_TYPES","Preferences");
define("_FTOPICS","Discussion");
define("_FPOSTS","Messages");
define("_FLPOSTS","Last Message");
define("_PMSG","Private Messages");
define("_PINBOX","Inbox");
define("_LOGINTOR","You must login before reading messages.");
define("_VNMS","new Messages");
define("_VNM","new Messages");
define("_TVM","Total Messages");
define("_NPM","You have not received new Messages");
define("_NPO","There are New Messages since your last visit");
define("_NNPO","There are No New Message since your last visit");
define("_FFA","Free to all");
define("_FREG","Registered Users");
define("_FMODS","Moderator");
define("_PASSW","Password Protected");
define("_FCOULDNOT","Problems were encountered accessing the Database");
define("_FNOTEXIST","This forum does not exist! Select another.");
define("_MODERATED","Moderated by : ");
define("_FINDEX","Index");
define("_FPRIVATE","This is a private forum, you will need the password to enter.");
define("_FREPLIES","Replies");
define("_FPOSTER","Poster");
define("_FVIEWS","Views");
define("_FODATE","Date");
define("_FNOTOPICS","There is no topics for this Forum.");
define("_FPOSTONE","If you like, you can post a new one.");
define("_FNEXTP","Next Page");
define("_JUMPTO","Jump To");
define("_FSELECTF","Select Forum");
define("_TLOCKED","Discussion locked - No more messages allowed.");
define("_MORETHEN","More then");
define("_WRONGPASS","Password not recognized!");
define("_FNOMORE","There are no more Forums.");
define("_FFMOD","Moderator");
define("_FCOULDNOTINSERT","Error, could not insert data into Database! Sorry for the inconvenience!");
define("_FPOSTCOUNT","The message counter is not being increased.");
define("_FPOSTED","New Message Posted!");
define("_FVIEW","Please wait a few seconds or click here.");
define("_YOUMUST","You must insert a message or a reply.");
define("_POSTIN","Respond to: ");
define("_FCANWRITE","You can Post new messages or replies to this Forum");
define("_YOUNOT","You cannot write here!");
define("_FBACK","Back");
define("_FNICKNAME","NickName");
define("_FPASSWORD","Password");
define("_FSUBJECT","Subject");
define("_FMESSAGE","Message");
define("_FMICON","Message Icon");
define("_FON","On");
define("_FOFF","Off");
define("_FOPTIONS","Options");
define("_DISHTML","HTML is not allowed in this Message");
define("_FDIS","Not allowed.");
define("_FTHISMAIL","in this Message");
define("_FSHOWSIG","Company");
define("_WHATISSIG","That one is setup in the User Pages.");
define("_FNOTIFY","Notify me by email when there is a new post.(Only for registered users)");
define("_FPAGED","Pages");
define("_FAQOUTE","Qoute");
define("_FAUTHOR","Author");
define("_FGOTO","Go to Page: ");
define("_FADMINT","Administration");
define("_LOCKTHIS","Lock discussion");
define("_UNLOCKTHIS","Unlock discussion");
define("_FMOVET","Move discussion");
define("_FDELT","Cancel discussion");
define("_FJOINED","Registered to :");
define("_FAPOSTS","Messages :");
define("_FFROM","Da");
define("_NOTREG","User not Registered");
define("_FTPOSTED","Posted");
define("_FAPROFIL","Profile");
define("_FAEMAIL","Email");
define("_FAADD","Post");
define("_FAEDIT","Edit");
define("_TREVIEW","Review your Reply");
define("_ENM","read");
define("_FPAGES","pages");
define("_BENV","Welcome to the $sitename Forum");
define("_HEAD1","Here you can exchange ideas and thoughts.");
define("_HEAD2","To try and help those that need it.");
define("_HEAD3","Please feel free to post!");
define("_ERRORE1","There was an Error!");
define("_FNOTA","Even if the Forum is available to Anonymous posters <a href=\"modules.php?name=Your_Account\">Register!</a>");
define("_ERRQUERY","during the database query");
define("_FERRORE","ERROR!");
define("_FNONTUO","You can't modify this message");
define("_NOPERMESS","You don't have permission to edit this message.");
define("_MODBY","This message was edited by");
define("_FIL","on");
define("_CHECKCONF","I cannot connect to the database, please check the configuration.");
define("_PUPD","You message was successfully edited!");
define("_CLIKVUPD","Click here to view you modified message.");
define("_CLIKRET","Click here to go to the main forum index.");
define("_POSTCANC","Post was canceled.");
define("_CLIKRETL","Click here to return to the list of messages.");
define("_MODPOST","Edit Message");
define("_FNICK","Nickname");
define("_FERRPASS","You have either entered an incorrect password or you don't have the correct password to edit this message. Please go back and re-enter your password.");
define("_MESSICON","Message icon");
define("_FMESS","Messaggi!");
define("_FOPT","Options");
define("_FDELP","Cancel This Message");
define("_FATTACT","Currently Active");
define("_DISCTOT","Total Discussions");
define("_FLEGEN","Legend");
define("_CLICONSMI","Click to add <a href=\"bb_smilies.php\">Smilies</a> into your Message:<br />");
define("_CLIONBOT","Click to add <a href=\"bbcode_ref.php\">BBCode</a> to your Message:<br /><br />");
define("_FRICAV","Advanced Search");
define("_FRESET","Reset");
define("_FCANC","Cancel");
define("_FPMESS","Private Message");
define("_FNOPMSG","You have not received any private messages.");
define("_FPROF","Profile");
define("_FPREVMSG","Previous Message");
define("_FNEXMSG","Next Message");
define("_FLOKTOP","The Moderator has locked this Discussion. You cannot reply.");
define("_NOTIFSUB","Someone has posted a reply to your message.");
define("_CIAO","Hello");
define("_NOTIFM1","You have received this email because someone has posted a reply to your message you posted on $sitename, and you chose");
define("_NOTIFM2"," to be informed by email when this happened.\r\n\r\nYou can see the discussion here: ");
define("_NOTIFM3","Or you can see our home page $sitename here: ");
define("_GRAZ","Thanks");
define("_APRSTAF","$sitename Staff");
define("_FKEY","Key word or phrase to try");
define("_FSEANY","Word (Default)");
define("_FSEAL","Phrase");
define("_SALF","In all the Forums");
define("_AUTN","Author Name");
define("_SORTBY","Sort By");
define("_FPTIM","Post Date");
define("_FSEA","I Tried!");
define("_FNOREC","No Corresponding record found. Go Back.");
define("_FFTOPIC","Discussion");
define("_FPRAC","Private Access Forum");
define("_FLIVAC","Access Level Changed");
define("_FADNAC","Add Access Level");
define("_FADNUSAC","Add new user to this Access Level");
define("_FUT","User");
define("_FUSID","User Id");
define("_FCUSACL","Activate User Levels");
define("_FWARDEL","WARNING: You are about to delete this Access Level. Are you sure about that?");
define("_FNO","No");
define("_FSI","Yes");
define("_FEDUSAC","Edit User Access Level");
define("_FADD","Add");
define("_FSAV","Save");
define("_WARDELU","WARNING: You are about to delete a users Access Level. Are you sure about that?");
define("_FACNEG","ACCESS DENIED!!!!");
define("_FCONF","Forum Configuration");
define("_FALHTML","Activate HTML");
define("_FALBBC","Activate BBCode");
define("_FALSIGN","Activate Signature");
define("_FHOTOP","Heated Discussion Threshold");
define("_FPOSTP","Post per Page");
define("_FMESSCO1","The number of Posts per page");
define("_FTOPPF","Discussions per Forum");
define("_FMESCO2","The number of Topics per Forum.");
define("_FSAVC","Save Configuration");
define("_FCATE","Forum Categories");
define("_FID","Id");
define("_FCAT","Categories");
define("_FNUM","Forum Number");
define("_FEDFO","Edit Forum");
define("_FADDCAT","Add Category");
define("_FCATT","Category");
define("_FPRAT","Currently on Forum ");
define("_FNAME","Name");
define("_FDESCR","Description");
define("_FACCE","Access");
define("_FTIPO","Type");
define("_FANON","Anonymous");
define("_FMODERAM","Moderator/Administrator");
define("_FPUBLIC","Public");
define("_FPRIVA","Private");
define("_FADDMOR","Add new Forum in ");
define("_FNONE","Nobody");
define("_FPASSIF","Password <i>(Private)</i>");
define("_FATTUA","Moderator/i Activate/i");
define("_NOMODSA","No Moderator Assigned");
define("_WADELCAT","WARNING: You are about to delete a Category and all its Forums and Messages, would you like to continue?");
define("_WADELFO","WARNING: You are about to delete a Forum and all its messages, would you like to continue?");
define("_FORANKSI","Hierarchical Forum Structure");
define("_FTITL","Degree");
define("_FMINPO","Min. Post");
define("_FMAXPO","Max. Post");
define("_FRANSP","Special Rank");
define("_FADDNRAN","Add a new Rank");
define("_WADELRA","WARNING: Are you sure you want to delete this Rank?");
define("_FENTNIPAS","Please insert your username and password");
define("_FTUNOMOD","You are not a moderator for this Forum, you do not have permission to execute that command!");
define("_ERRORPASS","ERROR: You have entered an incorrect Password! Go back and re-enter it.");
define("_FTOPDEL","The Disscussion has been removed from the database.");
define("_FCLIKTORET","Click here to return to the Forum");
define("_FTOPMOV","The Discussion has been moved!");
define("_FTOPLOK","The Discussion has been Locked!");
define("_FTOPSBLOK","The Discussion has been Unlocked!");
define("_FUSIP","User Account and IP information");
define("_FFUSIP","Users IP:");
define("_FREDVIS","Warning: ");
define("_FIDENTMOD","It looks like you're the moderator of this Forum!");
define("_FONCEDEL","Once you click the button, the selected Discussion and all of its messages will be deleted from the database.");
define("_FONCEMOV","Once you click the button, the selected Discussion and all its Messages will be moved to the selected Forum.");
define("_FONCELOK","When you click the button, the selected Discussion will be locked. You may unlock it at anytime.");
define("_FONCEUNLOK","When you click the button, the selected Discussion will be Unlocked and accessable to users.");
define("_FMOVETO","Move Discussion to: ");
define("_FVIEWIP","Your IP");
define("_FANONIMO","Anonymous");
define("_LOCALDATETIME","%d-%m-%Y at %H:%M");
//define("_BY","from");
define("_WEEKDAYDATETIME","%A, %e-%m-%Y at %H:%M");

/* AGGIUNTE PER VERSIONE 2.1 */

define("_FINMSGH","Message Head");
define("_FINMSGF","Message Footer");
define("_FNOTIF","Notify");
define("_FNOTMAIL","Notify Email");
define("_FINDNOT","Notify Address");
define("_POSTINN","Post in: ");
define("_FOPTIO","Optional");
define("_FOPPR","If private");

/* AGGIUNTE PER VERSIONE 2.1 by REFOSCO */

define("_FORUMPREF","Preference");
define("_FORUMPREFDESC","general preference setting, active HTML, BBCode, Post for page, message header and footer, ecc.");
define("_FORUMDESC","category gestion, add, edit and delete Forum");
define("_FORUMRANKDESC","ranks forum system, add, edit, delete ranks");
define("_FORUMACCDESC","users gestion, add, edit, access privilege");
define("_FORUMMENU","Forum Administration Menù");
define("_EDITRANK","Edit rank");

/* AGGIUNTE PER GESTIONE ATTACHMENT */

define("_FORUMATCHM","Attachments");
define("_FORUMENABLECOOKIE","To use this feature you need to enable cookies in your Browser");
define("_FORUMCLOSE","Close");
define("_FORUMATCHMERRINVFILETYPE","ERROR : this file cannot be attached");
define("_FORUMATCHMERRMAXSIZEREACH","ERROR : file size is larger than allowed");
define("_FORUMATCHMMODEINFO","To attach a file to your message, follow the two steps mentioned, repeating them if necessary to include more than a file.<br />At the end, click on<strong>OK</strong> to go back to your massage.");
define("_FORUMATCHMMODEINFO1","Click on<strong>Browse</strong> to select the file<br /> or type the path in the following field.");
define("_FORUMATCHMMODEINFO2","Move the file in the field<strong></strong> clicking on <strong>Attach</strong>. File transfer times may vary (from a few seconds to a few minutes).");
define("_FORUMATCHMFINDFILE","Find file");
define("_FORUMATCHMUPLOAD"," Attach ");
define("_FORUMATCHMREMOVE","Delete");
define("_FORUMATCHMEMPTY","-- No Attachment --");
define("_FORUMATCHMTOTSIZE","Total Size");
define("_FORUMATCHMMAXSIZE","maximum");
define("_FORUMATCHMCANCEL","Cancel");
define("_FORUMATCHMDELCONFIRM","Are you sure you want to delete the file");
define("_FORUMATCHMDOWNFILE","Download File");
define("_FORUMATCHMOPENFILE","Open File");
define("_FORUMATCHMCODE","(Press &lt;Attachments&gt; to add documents to your message)");

/* AGGIUNTE VARIE 3.0 */

define("_RANKIM","Image");
define("_RANKIMB","(N.B. Images must be in the directory:  <strong>images/forum/special/</strong>)");
define("_RANKIMD","Currently Available Images:");
define("_NONEPOST","Forum Empty!");
define("_LASTENP","Last ten messages");

/* AGGIUNTE VARIE 3.1 */

define("_FDI","of");
define("_MAXUPFILE","Max attachment file size (Kb)");
define("_MAXFILE","Attachments");
define("_INVIA","Send");
define("_RESETTA","Reset");
define("_CATORDE","Order");
define("_CATUP","Move one position up");
define("_CATDOWN","Move one position down");
define("_CATRESET","Reset default order");
define("_FPAGE","Page");
define("_FUSDEL","The user doesn't exist in database");
define("_FNASCBS","Hide left blocks");
define("_FVISBS","See left blocks");
define("_FULTM","Last messages ");
define("_FMPIUL","More read messages");
define("_FMEDRI","On average every discussion receives:");
define("_FRISPS","replies");
define("_FCERCF","Search in the forums");
define("_FISCRIPT","* beginning script doesn't accepted*");
define("_FINSCRIPT","*end  script doesn't accepted*");
define("_FHACK","<font color=\"#FF0000\"> *** INSERT CODE PROHIBITED - THIS MESSAGE IS A PROBABLE ATTEMPT TO ATTACK FROM A HACKER! IP ADDRESS REGISTERED! *** </font>");

/* HELP SYSTEM */

define("_SFHS","Splatt Forum Help System");
define("_HSH1","Click here and you can insert a new message in this forum.");
define("_HSH2","Click here and you can see the last messages inserted in this forum.");
define("_HSH3","Click here and you can see the forum without left blocks. This is the best solution for a navigation more readable");
define("_HSH4","Click here for a standard navigation, with left blocks.");
define("_HSH5","These are more readed ten messages. Near , between brackets, you can see how many times messages are read.");
define("_HSH6","These are last  ten messages in forums. They are in chronological order.");
define("_HSH7","Here you can see any restrictions setted in this forum.");

define("_LOCALDATE","%d-%m-%Y");

// define('_EMPTY_MESSAGE','You must enter a message when posting.');
?>
