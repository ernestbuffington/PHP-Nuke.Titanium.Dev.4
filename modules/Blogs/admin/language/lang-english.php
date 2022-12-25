<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/
/**************************************************************************/
/* PHP-NUKE: Advanced Content Management System                           */
/* ============================================                           */
/* This is the language module with all the system messages               */
/*                                                                        */
/* If you made a translation go to the my website and send to me          */
/* the translated file. Please keep the original text order by modules,   */
/* and just one message per line, also double check your translation!     */
/*                                                                        */
/* You need to change the second quoted phrase, not the capital one!      */
/*                                                                        */
/* If you need to use double quotes (") remember to add a backslash (\),  */
/* so your entry will look like: This is \"double quoted\" text.          */
/* And, if you use HTML code, please double check it.                     */
/**************************************************************************/
/*****[CHANGES]**********************************************************
-=[Mod]=-
      Display Topic Icon                       v1.0.0       06/27/2005
      Display Writes                           v1.0.0       10/14/2005
 ************************************************************************/
if (!defined('_BLOG_SUBMISSIONS')) define('_BLOG_SUBMISSIONS','Blog Post Submissons');
if (!defined('_TOPICS')) define('_TOPICS','Blog Posts Topics Manager');
if (!defined('_BY')) define('_BY','by');
if (!defined('_POSTEDON')) define('_POSTEDON','Posted on');
if (!defined('_AUTOMATEDARTICLES')) define("_AUTOMATEDARTICLES","Programmed Blog Posts");
if (!defined('_NOAUTOARTICLES')) define("_NOAUTOARTICLES","There are no programmed Blog Posts");
if (!defined('_GO')) define("_GO","Go");
if (!defined('_STORYID')) define("_STORYID","Blog Post ID");
if (!defined('_LAST')) define("_LAST","Last");
if (!defined('_NEWS')) define("_NEWS","Blog Post");
if (!defined('_FUNCTIONS')) define("_FUNCTIONS","Functions");
if (!defined('_YES')) define("_YES","Yes");
if (!defined('_NO')) define("_NO","No");
if (!defined('_ALLTOPICS')) define("_ALLTOPICS","All Blog Posts Topics");
if (!defined('_BLOG_POST_CATEGORY')) define("_BLOG_POST_CATEGORY","Blog Posts Category");
if (!defined('_SAVECHANGES')) define("_SAVECHANGES","Save Changes");
if (!defined('_OK')) define("_OK","Ok!");
if (!defined('_SAVE')) define("_SAVE","Save");
if (!defined('_NOSUBJECT')) define("_NOSUBJECT","No Subject");
if (!defined('_ARTICLES')) define("_ARTICLES","Blog Posts");
if (!defined('_ALL')) define("_ALL","All");
if (!defined('_AREYOUSURE')) define("_AREYOUSURE","Are you sure you included a URL? Did you test them for typos?");
if (!defined('_SELECTTOPIC')) define("_SELECTTOPIC","Select Blog Post Topic");
if (!defined('_OPTION')) define("_OPTION","Option");
if (!defined('_AUTHOR')) define("_AUTHOR","Author");
if (!defined('_NAME')) define("_NAME","Name");
if (!defined('_TITLE')) define("_TITLE","Blog Post Title");
if (!defined('_HOUR')) define("_HOUR","Hour");
if (!defined('_EDITCATEGORY')) define("_EDITCATEGORY","Edit Blog Post Category");
if (!defined('_NEWS_ADMIN_HEADER')) define("_NEWS_ADMIN_HEADER", "Blogs Posts :: Modules Admin Panel");
if (!defined('_NEWSSUBMISSION_ADMIN_HEADER')) define("_NEWSSUBMISSION_ADMIN_HEADER", "Blog Posts Submissions :: Modules Admin Panel");
if (!defined('_NEWSCONFIG_ADMIN_HEADER')) define("_NEWSCONFIG_ADMIN_HEADER", "Blog Posts Configuration :: Modules Admin Panel");
if (!defined('_NEWS_RETURNMAIN')) define("_NEWS_RETURNMAIN", "Return to Main Administration");
if (!defined('_ARTICLEADMIN')) define("_ARTICLEADMIN","Blog Posts Administration");
if (!defined('_ADDARTICLE')) define("_ADDARTICLE","Add New Blog Post");
if (!defined('_STORYTEXT')) define("_STORYTEXT","Blog Post Text");
if (!defined('_EXTENDEDTEXT')) define("_EXTENDEDTEXT","Extended Blog Post Text");
if (!defined('_ARESUREURL')) define("_ARESUREURL","(Are you sure you included an URL? Did you test it for typos?)");
if (!defined('_PUBLISHINHOME')) define("_PUBLISHINHOME","Publish Blog Post in Home?");
if (!defined('_ONLYIFCATSELECTED')) define("_ONLYIFCATSELECTED","Only works if <i>Blogs</i> category isn't selected");
if (!defined('_ADD')) define("_ADD","Add");
if (!defined('_PROGRAMSTORY')) define("_PROGRAMSTORY","Do you want to program this Blog Post?");
if (!defined('_NOWIS')) define("_NOWIS","Now is");
if (!defined('_DAY')) define("_DAY","Day");
if (!defined('_UMONTH')) define("_UMONTH","Month");
if (!defined('_YEAR')) define("_YEAR","Year");
if (!defined('_PREVIEWSTORY')) define("_PREVIEWSTORY","Preview Blog Post");
if (!defined('_POSTSTORY')) define("_POSTSTORY","Post Blog");
if (!defined('_REMOVESTORY')) define("_REMOVESTORY","Are you sure you want to remove Blog Post ID #");
if (!defined('_ANDCOMMENTS')) define("_ANDCOMMENTS","and all it's comments?");
if (!defined('_CATEGORIESADMIN')) define("_CATEGORIESADMIN","Blog Post Categories Administration");
if (!defined('_CATEGORYADD')) define("_CATEGORYADD","Add a New Blog Post Category");
if (!defined('_CATNAME')) define("_CATNAME","Blog Post Category Name");
if (!defined('_NOBLOGEDIT')) define("_NOBLOGEDIT","You can't edit <i>Blogs</i> Category");
if (!defined('_ASELECTCATEGORY')) define("_ASELECTCATEGORY","Select Blog Post Category");
if (!defined('_CATEGORYNAME')) define("_CATEGORYNAME","Blog Post Category Name");
if (!defined('_DELETECATEGORY')) define("_DELETECATEGORY","Delete Blog Post Category");
if (!defined('_SELECTCATDEL')) define("_SELECTCATDEL","Select a Blog Post Category to Delete");
if (!defined('_CATDELETED')) define("_CATDELETED","Blog Post Category Deleted!");
if (!defined('_WARNING')) define("_WARNING","Warning");
if (!defined('_THECATEGORY')) define("_THECATEGORY","The Category");
if (!defined('_HAS')) define("_HAS","has");
if (!defined('_STORIESINSIDE')) define("_STORIESINSIDE","Blog Posts inside");
if (!defined('_DELCATWARNING1')) define("_DELCATWARNING1","You can Delete this Blog Post Category and ALL its Blog Posts and Comments");
if (!defined('_DELCATWARNING2')) define("_DELCATWARNING2","or you can Move ALL the Blog Posts to a New Blog Post Category.");
if (!defined('_DELCATWARNING3')) define("_DELCATWARNING3","What do you want to do?");
if (!defined('_YESDEL')) define("_YESDEL","Yes! Delete ALL!");
if (!defined('_NOMOVE')) define("_NOMOVE","No! Move my Blog Posts");
if (!defined('_MOVESTORIES')) define("_MOVESTORIES","Move Blog Posts to a New Blog Post Category");
if (!defined('_ALLSTORIES')) define("_ALLSTORIES","ALL Blog Posts under");
if (!defined('_WILLBEMOVED')) define("_WILLBEMOVED","will be moved.");
if (!defined('_SELECTNEWCAT')) define("_SELECTNEWCAT","Please Select the New Blog Post Category");
if (!defined('_MOVEDONE')) define("_MOVEDONE","Congratulations! The move has been completed!");
if (!defined('_CATEXISTS')) define("_CATEXISTS","The Blog Post Category already exists!");
if (!defined('_CATSAVED')) define("_CATSAVED","Blog Post Category Saved!");
if (!defined('_GOTOADMIN')) define("_GOTOADMIN","Go to Admin Section");
if (!defined('_CATADDED')) define("_CATADDED","New Blog POst Category Added!");
if (!defined('_AUTOSTORYEDIT')) define("_AUTOSTORYEDIT","Edit Automated Blog Post");
if (!defined('_NOTES')) define("_NOTES","Blog Post Notes");
if (!defined('_CHNGPROGRAMSTORY')) define("_CHNGPROGRAMSTORY","Select new date for this Blog Post:");
if (!defined('_BLOG_SUBMISSIONSADMIN')) define("_BLOG_SUBMISSIONSADMIN","Blog Post Submissions Administration");
if (!defined('_DELETEBLOG')) define("_DELETEBLOG","Delete Blog Post");
if (!defined('_EDITBLOGPOST')) define("_EDITBLOGPOST","Edit Blog Post");
if (!defined('_NO_BLOG_SUBMISSIONS')) define("_NO_BLOG_SUBMISSIONS","No New Blog Post Submissions");
if (!defined('_NEW_BLOG_SUBMISSIONS')) define("_NEW_BLOG_SUBMISSIONS","New Blog Post Submissions");
if (!defined('_NOTAUTHORIZED_EDIT1')) define("_NOTAUTHORIZED_EDIT1","You aren't authorized to modify or edit this Blog Post!");
if (!defined('_NOTAUTHORIZED_EDIT2')) define("_NOTAUTHORIZED_EDIT2","You can't edit and/or delete Blog Posts that you did not publish");

if (!defined('_POLLTITLE')) define("_POLLTITLE","Poll Title");
if (!defined('_POLLEACHFIELD')) define("_POLLEACHFIELD","Please enter each available option into a single field");

if (!defined('_ACTIVATE_BLOG_COMMENTS')) define("_ACTIVATE_BLOG_COMMENTS","Activate Comments for this Blog Post?");
if (!defined('_LANGUAGE')) define("_LANGUAGE","Language");
if (!defined('_ATTACHA_BLOG_POLL')) define("_ATTACHA_BLOG_POLL","Attach a Poll to this Blog Post");
if (!defined('_LEAVEBLANKTONOTATTACH')) define("_LEAVEBLANKTONOTATTACH","(Leave blank to post the Blog Post without any attached Poll)<br />(NOTE: Automated/Programmed blog posts can't have attached Polls)");
if (!defined('_USERPROFILE')) define("_USERPROFILE","User Profile");
if (!defined('_EMAILUSER')) define("_EMAILUSER","Email User");
if (!defined('_SENDPM')) define("_SENDPM","Send Private Message");

# NEW in Titanium Blogs 1.1.0                       
if (!defined('_BLOG_ARTPUB')) define("_BLOG_ARTPUB","Blog Post Published");
if (!defined('_BLOG_HASPUB')) define("_BLOG_HASPUB","The Blog Post you submitted has been published. You can view it at:");
if (!defined('_BLOGS_CONFIG')) define("_BLOGS_CONFIG","Blog Posts Configuration");
if (!defined('_BLOG_DISPLAYTYPE')) define("_BLOG_DISPLAYTYPE","Display Column");
if (!defined('_BLOG_SINGLE')) define("_BLOG_SINGLE","Single Column");
if (!defined('_BLOG_DUAL')) define("_BLOG_DUAL","Dual Column");
if (!defined('_BLOG_READLINK')) define("_BLOG_READLINK","Read More Link");
if (!defined('_BLOG_POPUP')) define("_BLOG_POPUP","Popup");
if (!defined('_BLOG_PAGE')) define("_BLOG_PAGE","Page");
if (!defined('_BLOG_TEXTTYPE')) define("_BLOG_TEXTTYPE","Blog Post Length");
if (!defined('_BLOG_TRUNCATE')) define("_BLOG_TRUNCATE","Truncate to 255 chars");
if (!defined('_BLOG_COMPLETE')) define("_BLOG_COMPLETE","Original text");
if (!defined('_BLOG_NOTIFYAUTH')) define("_BLOG_NOTIFYAUTH","Notify Blog Post Author");
if (!defined('_BLOG_NOTIFYAUTHNOTE')) define("_BLOG_NOTIFYAUTHNOTE","This will email the blog post submitter<br />\non approval");
if (!defined('_BLOG_NO')) define("_BLOG_NO","No");
if (!defined('_BLOG_YES')) define("_BLOG_YES","Yes");
if (!defined('_BLOG_HOMETOPIC')) define("_BLOG_HOMETOPIC","Blog Post Topic in Home");
if (!defined('_BLOG_ALLTOPICS')) define("_BLOG_ALLTOPICS","All Blog Post Topics");
if (!defined('_BLOG_HOMENUMBER')) define("_BLOG_HOMENUMBER","Blog Posts in Home");
if (!defined('_BLOG_NUKEDEFAULT')) define("_BLOG_NUKEDEFAULT","Titanium Default");
if (!defined('_BLOG_ARTICLES')) define("_BLOG_ARTICLES","Blog Posts");
if (!defined('_BLOG_HOMENUMNOTE')) define("_BLOG_HOMENUMNOTE","This will over-ride user preferences<br />\nif set other then Titanium Default");
if (!defined('_BLOG_SAVECHANGES')) define("_BLOG_SAVECHANGES","Save Changes");
if (!defined('_SAVECHANGES')) define("_SAVECHANGES","Save Changes");
# Mod: Display Topic Icon v1.0.0 START
if (!defined('_DISPLAY_TOPIC_ICON')) define("_DISPLAY_TOPIC_ICON","Display Blog Topic Icon with Blog?");
# Mod: Display Topic Icon v1.0.0 START

# Mod: Display Writes v1.0.0 START
if (!defined('_DISPLAY_WRITES')) define("_DISPLAY_WRITES","Display Author Writes \"text\" with Blog?");
# Mod: Display Writes v1.0.0 END
?>
