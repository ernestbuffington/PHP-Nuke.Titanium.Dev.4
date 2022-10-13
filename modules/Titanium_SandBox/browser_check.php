<?php
if (!defined('MODULE_FILE')) {
   die('You can\'t access this file directly...');
}
############################################################################################################################################################################			
# TEST CODE GOES HERE - START
############################################################################################################################################################################
$pnt_browser = new Browser();

if( $pnt_browser->getBrowser() == Browser::BROWSER_IE && $pnt_browser->getVersion() >= 2 ) 
{
  echo"<br><strong><font face=\"Verdana\" >Internet Explorer Is Bad For The Web And For You</font></strong><br /><p></p>"
  . "<font face=\"Verdana\" >I have had several recent "
  . "conversations about why not to use Internet Explorer, and they "
  . "prompted me to make a handy list so that I could refer people to it.</font><p>"
  . "</p>"
  . "<p></p>"
  . "<p><font face=\"Verdana\" >I use and recommend Chrome.</font></p>"
  . "<p></p>"
  . "<p><font face=\"Verdana\" >As technology is in a constant state of change and flux, certain "
  . "proprietary software types can't, or won't, keep up. Because they "
  . "don't acknowledge the malleability of the internet, they encounter "
  . "problems when you try to use them.</font></p>"
  . "<p></p>"
  . "<p><font face=\"Verdana\" >So what are some concrete reasons behind my recommendation "
  . "against Internet Explorer in general, and my not wanting to design for "
  . "any version earlier than IE7? (And my reason behind not wanting to "
  . "design for future IE versions at all.)</font></p>"
  . "<p></p>"
  . "<p><font face=\"Verdana\" ><strong>Common Internet Standards Ignored</strong></font></p>"
  . "<p></p>"
  . "<p><font face=\"Verdana\" >The internet works as a cohesive unit only because all makers of "
  . "browsers and web sites adhere to certain commonly accepted standards "
  . "of design and use. Microsoft consistently ignores these standards in "
  . "favor of being proprietary. this means they would rather everyone be "
  . "forced to use their software model than change their model to meet "
  . "fast changes and increasing demand for cross platform and cross "
  . "browser compatibility. </font> </p>"
  . "<p></p>"
  . "<p><font face=\"Verdana\" >This makes Internet Explorer the hardest browser to work with. If "
  . "I design a web site and it isn't working in Chrome, FireFox or Safari, for "
  . "example, the tweak to fix the error is small, because they both "
  . "accept the same standard of design and use. If it doesn't work in "
  . "IE, forget it. The tweak to make it happen in IE is massive and time "
  . "consuming. I already spent huge amounts of time designing the page "
  . "and getting it to work in four common browsers, I don't want to "
  . "spend additional days on end trying to make IE &quot;see&quot; it.</font></p>"
  . "<p></p>"
  . "<p><font face=\"Verdana\" ><strong>ActiveX Is The Debil</strong></font></p>"
  . "<p></p>"
  . "<p><font face=\"Verdana\" >Safety is another huge issue with IE. Other browsers do not use "
  . "or accept ActiveX and Active Scripting, two Microsoft applets that "
  . "allow people to access your browser for various programs. These two "
  . "programs allow someone else the possibility of controlling your "
  . "computer, and open a huge barn door for viruses, adware, spy ware, "
  . "malware and phishers to come strolling leisurely through. </font> </p>"
  . "<p></p>"
  . "<p><font face=\"Verdana\" >Go ahead and use your virus software and your firewall - as long "
  . "as you also use IE, you may as well give it up. You will continue to "
  . "get malware on a regular basis, clogging your computer's arteries, "
  . "causing slowdown and crashes and possibly putting your data at risk. "
  . "Of course, any virus or malware can still get on the machine of "
  . "someone using one of the other browsers. The main difference is that "
  . "the users of other browsers more often have to actually open a file "
  . "or interact with it in some way to allow it in with them, and IE "
  . "lets malware in for you.</font></p>"
  . "<p></p>"
  . "<p><font face=\"Verdana\" ><strong>Does Not Accept Extensions and Add Ons</strong></font></p>"
  . "<p></p>"
  . "<p><font face=\"Verdana\" >No software can accommodate the complete wishes of its user base. "
  . "It's impossible. Other browsers, like Chrome, FireFox and Safari, "
  . "acknowledge this by allowing third party programmers to build "
  . "extensions and add ons that handle the missing features, making "
  . "every one happy. Internet Explorer demonstrates great hubris by not "
  . "allowing their user base to create or add features that address "
  . "issues with their software and its lack of compatibility with so "
  . "many things.</font></p>"
  . "<p></p>"
  . "<p><font face=\"Verdana\" >I'm not the only one who thinks IE's hubris is damaging. There "
  . "have been several suits filed in various places wanting IE to no "
  . "longer be tied to Windows, and to be forced to be more compatible "
  . "with web standards."
  . " <div id=\"link\" class=\"underline\"><a  href=\"http://computerworld.com/action/article.do?command=viewArticleBasic&amp;taxonomyName=standards_and_legal_issues&amp;articleId=9052982&amp;taxonomyId=146\" target=\"_tab\"> The most recent of these is the Opera suit in the EU.</a></font></div></p>"
  . ""
  . "<p></p>"
  . "<p><font face=\"Verdana\" ><strong>Ugly Web Spaces</strong></font></p>"
  . "<p></p>"
  . "<p><font face=\"Verdana\" >Have you ever viewed a web page designed solely with IE in mind "
  . "in another browser? They are hideous, non functional, clunky pages "
  . "in every case, on every other browser. Safari does the best job of "
  . "&quot;fixing&quot; the looks of an IE page, but it can't do much to fix the "
  . "way they work (or don't). Thinking the web still has to be hard to "
  . "use and ugly is just wrong. The moment you switch to any other "
  . "browser, your mind will be opened to a beautiful looking, easy to "
  . "use, functioning web. </font> </p>"
  . "<p></p>"
  . "<p><font face=\"Verdana\" ><strong>Overwrites</strong></font></p>"
  . "<p></p>"
  . "<p><font face=\"Verdana\" >When you install IE, you allow it to overwrite your system DLL "
  . "files. The files it installs are not 100% compatible in many cases, "
  . "mainly because it not only refuses to be compatible with much of the "
  . "web, but with its own operating system as well. This can lead to "
  . "system slow down and crashes. Add in the malware issues mentioned "
  . "above and you have a real morass on your hands.</font></p>"
  . "<p></p>"
  . "<p><font face=\"Verdana\" ><strong>Java Issues</strong></font></p>"
  . "<p></p>"
  . "<p><font face=\"Verdana\" >Did you know that Microsoft Java is not the same as the Java "
  . "everyone else uses? I would be willing to bet you didn't. I'd also "
  . "be willing to bet you've experienced the frustration of going to "
  . "page with Java applets on the recommendation of friends or "
  . "colleagues who have been using it flawlessly in other browsers, only "
  . "to find it doesn't work right for you.</font></p>"
  . "<p></p>"
  . "<p><font face=\"Verdana\" >this is just another example of IE refusing to comply with the "
  . "standards everyone else uses. They want you to have to use Microsoft "
  . "products and Windows, and they think shutting you off from most of "
  . "the web's functionality will convince you that is necessary. It just "
  . "isn't so. You can use FireFox and still use your Microsoft programs. "
  . "Changing browsers won't blow up your computer - it will just open "
  . "new doors to you online.</font></p>"
  . "<p></p>"
  . "<p><font face=\"Verdana\" ><strong>Linux Incompatibility</strong></font></p>"
  . "<p></p>"
  . "<p><font face=\"Verdana\" >This makes no sense to the average web user, but Internet "
  . "Explorer's continued incompatibility with Linux is an issue for a "
  . "very tech savvy sector of the online market. </font> </p>"
  . "<p></p>"
  . "<p><font face=\"Verdana\" >There are so many reasons not to use Internet Explorer I had some "
  . "difficulty putting them into a list. In fact, there are so many I "
  . "keep thinking I forgot a few. Did I? Let me know if I did.</font></p>"
  . "<p></p>";
}
echo "<hr>";

if( $pnt_browser->getBrowser() == Browser::BROWSER_CHROME && $pnt_browser->getVersion() >= 2 ) 
{
echo "<a href=\"https://www.chromium.org/\" target=\"_tab\"><img src=\"https://www.chromium.org/_/rsrc/1302286216006/config/customLogo.gif?revision=2\" align=top width=15 id=\"logo-img-id\" onload=\"ie6ImgFix('logo-img-id');\" alt=\"Logo\" class=\"sites-logo\">
The Chromium Projects</a>";
echo "<hr>";
}

if( $pnt_browser->isChromeFrame() == true ) 
echo 'ChromeFrame is <font color=red><b>IN USE</b></font><hr>';
else
echo 'ChromeFrame is <font color=red><b>NOT IN USE</b></font><hr>';

if( $pnt_browser->getBrowser() == Browser::BROWSER_CHROME && $pnt_browser->getVersion() >= 2 ) 
{
echo "<a href=\"http://www.google.com/chrome\"><img border=\"0\" align=top width=15 src=\"https://www.chromium.org/_/rsrc/1302286290899/chromium-projects/chrome-32.png?height=32&amp;width=32\" width=\"32\"></a> ";
echo 'Your Chrome Support is TURNED <font color=red><b>ON</b><br /> <b>     Chrome Version:</b> '.$pnt_browser->getVersion().'</font><hr>';
}
else
{
echo 'Your Chrome Support is TURNED <font color=red><b>OFF</b></font>';
echo "<hr>";
echo "<a href=\"http://www.google.com/chrome\" target=\"_tab\"><img border=\"0\" align=top width=15 src=\"https://www.chromium.org/_/rsrc/1302286290899/chromium-projects/chrome-32.png?height=32&amp;width=32\" width=\"32\"> DOWNLOAD CHROME</a><hr>";
}
############################################################################################################################################################################			
# TEST CODE GOES HERE - END
############################################################################################################################################################################
?> 
