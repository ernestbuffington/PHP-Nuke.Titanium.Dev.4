<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


define("_SOM_ADMIN_HEADER","PHP-Nuke Titanium Sommaire Menu :: Admin Panel");
define("_SOM_RETURNMAIN","Return to Main Administration");
define("_SOMMAIRE","Sommaire Menu");
define("_SOMADMINTITLE","<strong>Administration Menu</strong>");
define("_SOMMSGNOTNUM","The value of this field must be numeric, please modify.");
define("_SOMMSGVOID","You must enter a value for this field !");
define("_SOMATTNSUPPRCAT","Attention&nbsp;!!&nbsp;&nbsp; You cannot cancel if you delete a category ! (The 'Cancel' button does not re-create the deleted category)");
define("_SOMWEIGHT","Weight");
define("_SOMCATEGORIES","Categories");
define("_SOMCATNAME","Category's name");
define("_SOMIMGNAME","Image file's name");
define("_SOMCATLINK","Link on this category");
define("_SOMCATMODS","Modules in this category");
define("_SOMNOIMG","[No image]");
define("_SOMHR","Horizontal rule");
define("_SOMCENTER","Center title");
define("_SOMBGCOLOR","Background color");
define("_SOMEXTLINK","External link");
define("_SOMMISEENPAGE","Display");
define("_TARGETBLANK","Open in a new window");
define("_SOMACTION","Action");
define("_SOMSUPPR","[Delete]");
define("_SOMADDCAT","Add a new category");
define("_SOMNEWCATEGORY","Add a new category :");
define("_SOMCANCEL","CANCEL");
define("_SOMPOST","SAVE YOUR MODIFICATIONS");
define("_SOMREMARKS","<strong>Remarks :</strong><br /><br />"
    ."- The WEIGHT is used to order categories (categories with a lower WEIGHT are displayed first). [number between 0 and 98]<br /><br />"
    ."- You can create a category without a name : in this case, the image will not be displayed.<br />"
    ."&nbsp;&nbsp;(useful if you are using only horizontal rules to separate categories)<br /><br />"
    ."- The IMAGE FILE'S NAME (for the category) is an image file inside /images/sommaire/. You can also put a FLASH file (.swf)."
    ."<br />&nbsp;&nbsp;The IMAGE (for category's content) is an image file inside /images/sommaire/categories/."
    ."<br />&nbsp;&nbsp;When you add an image file in these folders, it is automatically added in its list box.<br />"
    ."&nbsp;&nbsp;If you don't want to display an image before a category's name, put 'null.gif' (transparent 20x20 px image) in the field.<br /><br />"
    ."- THE LINK ON THE CATEGORY could be any internet url or an url relative to your site.<br />"
    ."&nbsp;&nbsp;If you put an external link (beginnning with 'http://' or 'ftp://'), the link will be opened in a new window.<br />"
    ."&nbsp;&nbsp;If you put a relative url ('modules.php?name=Your_Account&op=new_user'), the link will open in the current window.<br />"
    ."&nbsp;&nbsp;To open an internal link in a new window, put the exact, full  url of your site.<br />"
    ."&nbsp;&nbsp;To open an external link in the current window, type 'HTTP://' (in uppercase).<br /><br />"
    ."- The BACKGROUND COLOR must be a color code or a standard color name.<br />"
    ."&nbsp;&nbsp;ex: 'red' : <span color=\"red\">RED</span>  --  '#ff0000' : <span color=\"#ff0000\">RED</span><br /><br />"
    ."- The CLASS used to display categories' names msut be an existing class in all your themes.<br />"
    ."&nbsp;&nbsp;The classes are in the file /themes/YOURTHEME/style/style.css.<br />"
    ."&nbsp;&nbsp;You can add your own class, for example you can add this line in the style sheets of your themes :<br />"
    ."&nbsp;&nbsp;<i>.sommaire        {FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 12px; COLOR: #363636; FONT-WEIGHT: bold}   </i><br />");
define("_SOMCATCONTENT","Category's content");
define("_SOMLINKURL","link's URL");
define("_SOMLINKTEXT","link's text");
define("_SOMIMAGE","Image");
define("_SOMINVALIDWEIGHT","The WEIGHT value is invalid for the category");
define("_SOMMUSTBENUM"," This value MUST be a number between 0 and 98 !!");
define("_SOMCATS","The categories");
define("_SOMAND","and");
define("_SOMSAMEWEIGHT","have the same WEIGHT !!");
define("_SOMMODIFWEIGHT","Return back to the previous page and modify the WEIGHT value of one of these categories.");
define("_SOMBACKADMIN","Back to Menu administration");
define("_SOMSUCCESS","Your block has been successfully updated !");
define("_SOMGOADMIN","Configure your Menu");
define("_SOMUPGRADESUCCESS","Your Menu was successfully upgraded !!");
define("_SOMV1DETECTED","Sommaire parametrable v.1.0 detected !");
define("_SOMCLICKTOUPGRADE","To upgrade your menu, click");
define("_SOMHERE","HERE");
define("_SOMWARNINGDELETECAT","Are you sure you want to delete the category");
define("_SOMGENERALOPTIONS","General Options");
define("_SOMDISPLAYMEMBERSONLYMODULES","Display of 'members only' modules");
define("_SOMCATEGORIESCLASS","Class for categories' names");
define("_SOMDISPLAYMODULENORMAL","Normal (always displayed)");
define("_SOMDISPLAYMODULEWITHICON","Displayed with icon");
define("_SOMDISPLAYMODULEWITHICONFORVISTORS","for visitors");
define("_SOMDISPLAYMODULEINVISIBLE","Invisible for visitors");
define ("_SOMYES","Yes");
define ("_SOMNO","No");
define("_SOMMAIREREMARKSTWO","<br />- You can create a popup, to do so, enter in the field 'url' of external link :<br />"
        ."&nbsp;&nbsp;<i>javascript:window.open('http://www.url.com','popup_sommaire','directories=no,menubar=no,status=no,location=no,scrollbars=no,resizable=no')</i><br />"
        ."<br />&nbsp;&nbsp;You can modify display options (display scrollbars, etc...)<br />"
        ."&nbsp;&nbsp;See <a href=\"http://www.toutjavascript.com/savoir/savoir15.php3\">Tout Javascript - les popups</a> for more details.<br /><br />");
define("_SOMMAIREHR","Horiz. rule");
define("_SOMBOLD","Bold");
define("_SOMLISTBOX","Drop down box");
define("_SOMSENDTOHAVEMORE","Save your modifications to add new links.");
define("_SOMDISPLAYCLASSES","Display :");
define("_SOMMODULESCLASS","CSS class used for modules/external links");
define("_SOMAUTODETECTNEW","Automatic detection of news");
define("_SOMSINCE","New for");
define("_SOMNBDAYS","days");
define("_SOMDYNAMICMENU","Dynamic menu");
define("_SOMJSSAVEBEFORE","Do you want to save your modifications before deleting this category ?");
define("_SOMEDITLINKTITLE","Edit a link...");
define("_SOMMOREOPTIONS","More options");
define("_SOMCLASS","CSS class");
define("_SOMATTENTIONMOREOPTIONS","<strong>Attention !</strong><br />If you modify in sommaire's admin panel the general CSS class for categories, or for modules/links, or the time 'New!' icon is displayed, the specific values of a category or a module/link will be overwritten.");
define("_SOMMOREOPTIONSUCCESS","Your modifications are applied !");
define("_SOMSENDTOVALIDATE","(You should validate all modifications in the main sommaire panel for your modifications to be finally confirmed)");
define("_SOMCLOSE","Close the window");
define("_SOMTARGETBLANK","Link opened in a new window. To open in the same window, begin url with HTTP:// (uppercase)");
define("_SOMTARGETNONE","Link opened in the same window. To open in a new window, begin url with http:// (lowercase)");
define("_SOMNOTABLEPB","Sommaire Parametrable is unable to access its database tables.Please verify that you have installed correctly, and READ THE FAQ !");

?>