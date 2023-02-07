<a href="https://www.php-nuke-titanium.86it.us" rel="nofollow"><img src="/images/github/github_rip_open2.png" alt="PHP-NUke Titanium" style="max-width: 100%;"></a>

<h2>Changes in PHP-Nuke Titanium v4.0.4</h2>
<p>Support Website https://www.php-nuke-titanium.86it.us <-(This Code Running Live) SIGN UP AND CHECK IT OUT!!!</p>


[![FOSSA Status](https://app.fossa.com/api/projects/git%2Bgithub.com%2Fernestbuffington%2FPHP-Nuke.Titanium.Dev.4.svg?type=shield)](https://app.fossa.com/projects/git%2Bgithub.com%2Fernestbuffington%2FPHP-Nuke.Titanium.Dev.4?ref=badge_shield)  [![Codacy Badge](https://app.codacy.com/project/badge/Grade/e5300f0dccdb4bcc9b7bdbc5d6e65f50)](https://www.codacy.com/gh/ernestbuffington/PHP-Nuke.Titanium.Dev.4/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=ernestbuffington/PHP-Nuke.Titanium.Dev.4&amp;utm_campaign=Badge_Grade)

<h2>PHP-Nuke Titanium v4.0.4 2023 Nightly Build Repo</h2>

<p>This code is running live at https://www.php-nuke-titanium.86it.us</p>

<h2>PHP-Nuke Titanium v4.0.4 Core Developers</h2>

<ul>
	<li>Ernest Allen Buffington (Lead Core Developer)</li>
	<li>Gaz "Wiggy" Jones (Core Developer)</li>
	<li>Winston Terrance Wolfe</li>
	<li>Truman Scott Buffington</li>
	<li>Bob Marion</li> 
	<li>Sebastian Scott Buffington</li>
</ul>

<h2>PHP-Nuke Titanium v4.0.4 Core Contributors</h2>

<ul>
	<li>Technocrat</li>
	<li>killigan</li>
	<li>SgtLegend</li>
	<li>Eyecu</li> 
	<li>Wolfstar</li>
	<li>Lonestar</li>
	<li>CoRpSE</li>
	<li>CodeBuzzard</li>
	<li>CyBorg</li>
	<li>NukeSheriff</li>
	<li>TheGhost</li>
	<li>ScottyBcoder</li>
	<li>UniKCode</li>
	<li>Cobalt74</li>
</ul>

<h2>PHP-Nuke Titanium v4.0.4 Flash Game, and Movie Support for 2022</h2>

<ul>
	<li>The Ruffle Web Core (https://github.com/ruffle-rs/ruffle): is what we use to enable flash site wide, you will not need any browser plugins.</li>
	<li>The Arcade Mod v4.0 is now functional and keeps score!</li>
	<li>AVM 1 is ActionScript 1 and ActionScript 2 - All movies and games made before Flash Player 9 (June 2006).</li>
	<li>AVM 2 is ActionScript 3, which was introduced with Flash Player 9 (June 2006).</li> 
	<li>After the release of Flash Professional CC (2013), authors were required to use ActionScript 3.</li>
	<li>Ha, Suck it Adobe!</li>
</ul>

<h2>PHP-Nuke Titanium Ruffle Web Core</h2>

The Flash Player has existed since 1996, and there are millions of pieces of Flash content around the web. This content represents an important piece of computing history and culture. Unfortunately, as browser support has faded, this history is no longer easily accessible. This became even worse [when the Flash Player reached end of life](https://theblog.adobe.com/adobe-flash-update/).

Ruffle's chief goal is to preserve this legacy content and keep it accessible for the future. Ruffle is an Adobe Flash Player emulator written in the Rust programming language, compiling both to the desktop and to the web.

Ruffle has 4 goals, roughly in order of priority:
1) **Ease of Use**: SWF content should remain easily accessible. Ruffle's HTML5 client is a first-class citizen, allowing the playback of SWFs without external software, even on mobile.
2) **Compatibility**: Strive to acceptably display the wide range of SWF content available on the web.
3) **Accuracy**: Behave as close to the original Flash Player as possible.
4) **Speed**: The content should run full-speed.

In-browser emulation is the best way to accomplish these goals:
 * Manual conversion to modern platforms is time-consuming and simply not possible given the vast amount of SWF content.
 * Automatic conversion is possible, but still requires user intervention. Ideally users can run the SWF content directly without a conversion process.
 * Desktop players and plug-ins have the best performance, but most users do not want to install extra software. Ruffle offers a desktop player, but the primary focus is on the web client.
 * Accurate emulation of the majority of SWF content is possible given the current state of web APIs.
 * WebAssembly has opened the door for better performance in the browser.
 
Rust was chosen as the programming language because:
 * Rust is a systems programming language, giving the tools and performance necessary for emulation.
 * Rust is the best way to target WebAssembly. Rust considers WebAssembly [a primary platform](https://forge.rust-lang.org/platform-support.html), allowing Ruffle to run in the browser with high speed.
 * [Rust has a thriving community](https://insights.stackoverflow.com/survey/2019#most-loved-dreaded-and-wanted), which is key for attracting contributors.
 * Rust has a large focus on [memory safety](https://blog.gds-gov.tech/appreciating-rust-memory-safety-438301fee097), avoiding bugs and easing traditional concerns about the security of Flash content.

There have been existing efforts to re-implement the Flash Player, including Gnash, Shumway, and [Lightspark](https://lightspark.github.io/). Of these, only Lightspark is still maintained. Porting one of the existing C++ projects to Web using Emscripten is another path forward, and, in fact, may be the fastest way to getting a large amount of content running quickly. This project's goal is a fresh start in a modern codebase with the web as a primary platform.

<h2>PHP-Nuke Titanium v4.0.4 Modules</h2>

<ul>
	<li><b>Advertising</b><br />Programmable local Portal Advertisng.</li>
	<li><b>Blogs</b><br />This use to be the News system from Nuke Evolution Xtreme (UK Version) and it was drasticly changed and we renamed it to Blogs when we added new features and updated the code for PHP 8.X - We added a Blog Signature and a few other bells and whistles!</li>
	<li><b>Blog Archives</b><br />This use to be the News archive for Nuke Evolution Xtreme (UK Version), it is now the Blog Archives and has had some updates and addons implemented. The display layout has been changed.</li>
	<li><b>Blog Submit</b><br />Portal members can submit Blogs.</li>
	<li><b>Blogs Top</b><br />Top 10 Blogs information will be listed - 10 Most Read, 10 Most Voted, 10 Best Rated, 10 Most Commented, 10 Most Active, and 10 Most Active Blog Post Submitters.</li>
	<li><b>Blog Topics</b><br />Lists the Topics and various stats and information about each topic.</li>
	<li><b>Docs</b><br />Local portal disclaimers - About Us, Disclaimer, Privacy Statement, and Terms of Use.</li>
	<li><b>Donations</b><br />Make donations to the local Webmaster or Admin with PayPal.</li>
	<li><b>ECalendar</b><br />Just another Calendar.</li>
	<li><b>FAQ<br />Portal Frequently Asked Questions</li>
	<li><b>Feedback<br />Users can leave detailed Feedback anytime they want.</li>
	<li><b>File Repository</b><br />A Most excellent Downloads Manager, This module brings you an advanced file manager, it was been developed to be as user friendly as possible. by Lonestar.</br>Module Version: v1.1.0</br>Website: (http://lonestar-modules.com)</br>Author Email: crazycoder@live.co.uk</br></li>
	<li><b>Forums</b><br />phpBB Forums Area - phpBB Titanium v2.0.25 is what we use now.</br>We are currently porting phpBB 3 into our system.</li>
	<li><b>Google Site Map</b><br />Added a NEW fast and lightweight class for generating Google sitemap XML files and index of sitemap files. Written on PHP and uses XMLWriter extension (wrapper for libxml xmlWriter API) for creating XML files. XMLWriter extension is enabled by default in PHP 5 >= 5.1.2. If you have more than 50000 urls, it will split items into seperated files. (In benchmarks, 1 million urls were generated in 8 seconds).</li>
	<li><b>Groups</b><br />List of various groups that members of a portal can subscribe to and become a member of.</li>
	<li><b>HTML Newsletter</b><br />Currently needs to be re-written as it does have some security issues.</li>
	<li><b>Image Repository</b><br />A Most excellent private image hosting system for each of your portal members. By Lonestar.</br>Module Version: v1.1.0</br>Website: (http://lonestar-modules.com)</br>Author Email: crazycoder@live.co.uk</br></li>
	<li><b>Loan Amortization</b><br />This is great and was written by ScottyBcoder. </br>Truman Scott Buffington (https://www.scottybcoder.86it.us)</br>Author Email: scottybcoder@gmail.com</li>
	<li><b>Link Us</b><br />A Backlink system so that members of your portal can Backlink their websites to yours.</li>
	<li><b>Members List</b><br />Enhanced list of Portal Members - Has a built in Ghost Mode, when users are set to Ghost Mode (Enabled) their is no way to see when their last visit was or if they are online at the same time others are.</li>
	<li><b>NukeSentinel</b><br />Security and User Tracking like no other website has. By Bob Marion of Nukescripts.Net</br>Website: (https://www.nukescripts.86it.us)</br>Author Email: bob.marion@86it.us</li>
	<li><b>Private Messages</b><br />A Portal Messaging system.</li>
	<li><b>Profile</b><br />Each user has a personal profile.</li>
	<li><b>Recommend Us</b><br />People can recommend your Portal/Web SIte to a friend.</li>
	<li><b>Reviews</b><br />Reviews Section that is soon to be revamped.</li>
	<li><b>Search</b><br />Search entire Portal/Web Site.</li>
	<li><b>Shout Box</b><br />Awesome Shout Box.</li>
	<li><b>Spambot Killer</b><br />Spam Bot Choker.</li>
	<li><b>Statistics</b><br />Portal Statistics.</li>
	<li><b>Surveys</b><br />Portal Surveys, soon to be revamped.</li>
	<li><b>Titanium SandBox</b><br />This is for developers to test code on their Portal/Web Site - A Moodule that allows you to test and add various types of code. Great for people just starting out as well because they can practice any and all PHP code and their tests will show up when they execute the module.</li>
	<li><b>Web Links</b><br />Web Resources for your Portal.</li>
	<li><b>Your Account</b><br />Edit your profile settings anytime you like - Change Avatar, Name, Ghost Mode, and much more...</li>
</ul>

<h2>PHP-Nuke Titanium v4.0.4 Test Server Information</h2>

<ul>
	<li><b>You will need Network Database Access for the Network Projects Module</b>- edit your nconfig.php file</li>
	<code>$portaladmin = 2;
    define('network', 'enabled');
    if ( defined('network') ):
    $dbhost2 = 'hub.domain.name.here';
    $dbname2 = 'hub_db';
    $dbuname2 = 'ask for a hub user name and put it here';
    $dbpass2 = 'you need to request an access password to put here';
    $network_prefix = 'network';
    endif;</code>
	<li><b>This Config is needed to submit Bug Reports!</b></li>
</ul>

<ul>
	<li>Easy Apache 4 / Apache 2.4.54</li>
	<li>MySQL Server Version: 5.5.5-10.3.37-MariaDB (MariaDB Server) The fastest on the planet!</li>
	<li>PHP 8.1.14 / php-fpm 8.1.14 (we are working on a version for PHP 9)</li>
	<li>cURL&nbsp;7.86.0</li>
	<li>GD Support bundled (2.1.0 compatible)</li>
	<li>Client API library version (mysqlnd/mysqli 8.1.14)</li>
	<li>OpenSSL 1.1.1s 1 Nov 2022</li>
	<li>libxml Version 2.9.7</li>
	<li>json support</li>
	<li>Phar API version v1.1.1</li>
	<li>ZLib 1.9.2</li>
	<li>Minimum of 100 MB/s web space</li>
	<li>Minimum of 5 GB/s bandwidth (5 TB/s or unmetered is recommended)</li>
	<li>Mime Type .wasm for Flash Gaming and Movie Support (This is what we started to do in 2022)</br>This is so that ruffle can process .swf files.</li>
</ul>
Apache doesn't serve these files correctly by default, you will need to add this to your `httpd.conf` configuration file or root .htaccess file and reload it:

```
AddType application/wasm .wasm
```

<h2>PHP-Nuke Titanium v4.0.4 Local Development</h2>

<p>PHP-Nuke Titanium while advanced can be easily installed using local development servers including MAMP, WAMP, and XAMPP but you can also use IIS or compile your own AMP (Apache, MySQL, PHP) server if you wish to. Please ensure that your local server meets the first 3 server requirements in order to achieve the best possible development results when building your custom add-ons, modules, and mods.</p>

<h2>PHP-Nuke Titanium v4.0.4 Installation and Upgrade</h2>

<p>While PHP-Nuke Titanium uses the same core as PHP-Nuke Evolution Xtreme there have been a lot of updates to it which improve performance and security, please see the following links for installing a fresh copy or upgrading.</p>

<h5>NOTE</h5>

<p><a href="https://php-nuke-titanium.86it.us/modules.php?name=Network_Projects&amp;op=Project&amp;project_id=76" rel="nofollow" target="_tab">Fresh install</a><br />
<a href="https://php-nuke-titanium.86it.us/modules.php?name=Network_Projects&amp;op=Project&amp;project_id=76" rel="nofollow" target="_tab">Upgrade</a></p>

<h2>PHP-Nuke Titanium v4.0.4 Security</h2>

<p>Security is the top priority for this CMS, the core of PHP-Nuke Titanium uses a comprehensive integrated module called Nuke Sentinel (tm). Nuke Sentinel (tm) protects your website against DDOS, CLIKE, Union, and many more attacks, Nuke Sentinel (tm) is so advanced you don&#39;t even have to worry about protecting your admin panel as it watches for failed logins and can ban anonymous users automatically from your website.</p>

<p>Hopefully, you will never have to visit the admin panel for Nuke Sentinel (tm) as 99% of all web hosts now have DDOS protection and many more security features which prevent attacks and such.</p>

<h2>PHP-Nuke Titanium v4.0.4 Help</h2>

<p>If you are having issues with your installation please do not hesitate to submit a report by clicking <a href="https://php-nuke-titanium.86it.us/modules.php?name=Network_Projects&amp;op=RequestSubmit&amp;project_id=76" target="_tab">HERE</a><br />
If you need help with an install do not hesitate to submit a request by clicking <a href="https://php-nuke-titanium.86it.us/modules.php?name=Network_Projects&amp;op=RequestSubmit&amp;project_id=76" target="_tab">HERE</a></p>

<h2>PHP-Nuke Titanium v4.0.4 Feedback, Bugs, and Improvements</h2>

<p>If you have any suggestions, feedback, or ideas you feel will be a nice contribution to PHP-Nuke Titanium please use the following links</p>

<p><a href="https://php-nuke-titanium.86it.us/modules.php?name=Network_Projects&amp;op=RequestSubmit&amp;project_id=76" target="_tab">Help improve the US version of PHP-Nuke Titanium</a><br />
<a href="https://php-nuke-titanium.86it.us/modules.php?name=Network_Projects&amp;op=ReportSubmit&amp;project_id=76" target="_tab">Report a PHP-Nuke Titanium bug</a><br />
<a href="https://php-nuke-titanium.86it.us/modules.php?name=Feedback" target="_tab">Your PHP-Nuke Titanium feedback</a></p>

<hr />
<p>Thanks for using our enhanced PHP-Nuke Web Portal System and we hope you enjoy it&nbsp;&nbsp;</p>

<p><strong>The PHP-Nuke Titanium Team </strong>(This is the US Support Team)<br />
<a href="https://php-nuke-titanium.86it.us/index.php">http://php-nuke-titanium.86it.us/index.php</a></p>

<h2>GNU GENERAL PUBLIC LICENSE Version 2, June 1991</h2>

<p>PHP-Nuke Titanium&nbsp;is licensed as free software under the GNU general public license for non-profit use, because there are so many people to include in the license please refer to the licenses.pdf file. Re-selling or direct&nbsp;marketing this software for commercial use is forbidden by the GNU general public license, the result of doing so can lead to legal action been taken against you so please ensure to read and understand the license before using this software for development and personal use.</p>

<p>The skinny on this jargon is to do what you want with the software and always give full credit to the original copyright owners. You can sell a modified version of this software but you must always give credit to the original copyright owners. I suggest you do some research and find out who owns PHP-Nuke. The Original Copyright belonged to&nbsp;Francisco Burzi who added to a version of&nbsp;Thatware and the copyright owner for that software is&nbsp;David Norman. This is Open-Source software and should be treated as such.</p>

<h2>Warranty</h2>

<p>Because PHP-Nuke Titanium is licensed free of charge, there is no warranty for the package, to the extent permitted by applicable law. Except when otherwise stated in writing, the PHP-Nuke Titanium Team provides PHP-Nuke Titanium &quot;as is&quot; without warranty of any kind, either expressed or implied, including, but not limited to, the implied warranties of merchantability and fitness for a particular purpose. The entire risk as to the quality and performance of the package is with you. Should the package prove defective, you assume the cost of all necessary servicing, repair, or correction.</p>

## License
[![FOSSA Status](https://app.fossa.com/api/projects/git%2Bgithub.com%2Fernestbuffington%2FPHP-Nuke.Titanium.Dev.4.svg?type=large)](https://app.fossa.com/projects/git%2Bgithub.com%2Fernestbuffington%2FPHP-Nuke.Titanium.Dev.4?ref=badge_large)

