<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************
PHP-Nuke Titanium : Titanium Functions
=========================================================================
Copyright (c) 2022 The PHP-Nuke Titanium Group

Filename      : functions_titanium_custom.php
Author        : Ernest Allen Buffington 
Version       : v4.0.3
Date          : 12.15.2022 (mm.dd.yyyy)

Notes         : Miscellaneous functions
Last Modified : 12.15.2022 3:59 pm Ernest Allen Buffington
************************************************************************/

# all facebook div tags should have the ampersand encoded from & to &amp;
# do not encode script tags from & to &amp; - leave theme alone,

function facebook_likes() {
    if (defined('facebook')):
        global $sid, $appID, $my_url;
		
		# IFRAME LOADER
		#echo '<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.php-nuke-titanium.86it.us%2Fmodules.php%3Fname%3DBlogs%26file%3Darticle%26sid%3D' . $sid . '%26mode%3Dnested%26order%3D0%26thold%3D0&tabs=timeline&width=180&height=70&small_header=false&adapt_container_width=true&hide_cover=true&show_facepile=true&appId=' . $appID . '" width="180" height="70" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>';
        # NORMAL LOADER
		//echo '<div class="fb-page" data-href="https://' . $my_url . '/modules.php?name=Blogs&amp;file=article&amp;sid=' . $sid . '&amp;mode=nested&amp;order=0&amp;thold=0" data-tabs="timeline" data-width="180" data-height="70" data-small-header="false" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true"></div>';

   endif;

}

function facebook_comments() {
    if (defined('facebook')):
        global $sid, $appID, $my_url;
        #facebook comment plugin START
        //echo '<div style="background-color: grey" class="fb-comments" data-colorscheme="light" data-href="https://' . $my_url . '/modules.php?name=Blogs&amp;file=article&amp;sid=' . $sid . '" data-width="100%" data-numposts="5"></div><br /><br />' . "\n";
    #facebook comment plugin END
    endif;
}

/**
 * Customize function: Used for dynamic page titles, This replaces the old Dynamic Titles mod, which required multiple database queries.
 *
 * @since Titanium v3.0.1b
 */
function title_and_meta_tags() {
    /** @var type $facebook_admin_id_number */
    global $facebook_admin_id_number, $ThemeSel, $sitename, $appID, $name, $sid, $file, $db, $prefix;
    $top = '';
	$art = '';
	$hometext = '';
	$facebook_admin = '';
	$facebookappid = '';
	$facebook_ia_markup_url = '';
	$facebook_ia_rules_url = '';
	$facebook_ogdescription = '';
	$facebook_og_title = '';
	$structured_data = '';
	$facebook_ia_markup_url_dev = ''; 
    $facebook_ia_rules_url_dev  = '';
	$facebook_ogimage_normal  = '';
	$facebookimage_alt  = '';
	$facebook_ogurl = '';
	$facebook_ogimage_width = '';
	$facebook_ogimage_height = '';
	$facebookimagetype = '';
	$facebook_ogimage = '';
    $facebook_page_type = '';
	/** @var type $ThemeSel get current theme */
    $ThemeSel = get_theme();
    $item_delim = "&raquo;";
    $module_name = get_query_var('name', 'get', 'string', '');
    $module_name_str = str_replace(array('-', '_'), ' ', $module_name);

    # if the user is in the administration panel, simply change the page title to administration.
    if (defined('ADMIN_FILE')):
        $newpagetitle = $item_delim . ' Administration';

    # if the user is visiting a module, change the page title to the module name.
    else:
    if ($appID > 0):
        $facebookappid = "<meta property=\"fb:app_id\" content=\"" . $appID . "\">\n";
        $facebook_admin = "<meta property=\"fb:admins\" content=\"" . $facebook_admin_id_number . "\">"; # TheGhost's facebook user ID
    endif;    
    
    $facebook_page_type = "<meta property=\"og:type\" content=\"website\">\n";

        if (!defined('HOME_FILE')):

            # PHP-Nuke Titanium Shout Box Module v1.0 -------------------------------------------------------------------------------------------------
            if ($module_name == "Shout_Box"):

                # each module has a logo image file START
                if (file_exists(NUKE_MODULES_DIR . $module_name . '/images/logo.png')):
                    $facebook_ogimage_normal = '<meta property="og:image" content="' . HTTP . 'modules/' . $module_name . '/images/logo.png">' . "\n";
                    $facebook_ogimage = '<meta property="og:image:secure_url" content="' . HTTP . 'modules/' . $module_name . '/images/logo.png">' . "\n";
                else:
                    $facebook_ogimage_normal = '<meta property="og:image" content="' . HTTP . 'modules/Blogs/images/logo.png">' . "\n";
                    $facebook_ogimage = '<meta property="og:image:secure_url" content="' . HTTP . 'modules/Blogs/images/logo.png">' . "\n";
                endif;
                # each module has a logo image file END

                $newpagetitle = $sitename . ' ' . $item_delim . ' Shout Box';

                $facebook_og_title = '<meta property="og:title" content="' . $newpagetitle . '">' . "\n";
                $facebook_ogdescription = '<meta property="og:description" content="PHP-Nuke Titanium ' . $item_delim . ' Shout Box Module v1.0">' . "\n";

                $facebookimagetype = '<meta property="og:image:type" content="image/png">' . "\n";
                $facebook_ogimage_width = '<meta property="og:image:width" content="1200">' . "\n";
                $facebook_ogimage_height = '<meta property="og:image:height" content="628">' . "\n";
                $facebookimage_alt = '<meta property="og:image:alt" content="' . $newpagetitle . '">' . "\n";
                $facebook_ogurl = '<meta property="og:url" content="' . HTTPS . 'modules.php?name=' . $name . '" />' . "\n";
            # PHP-Nuke Titanium Shout Box Module v1.0 -------------------------------------------------------------------------------------------------
            # PHP-Nuke Titanium Google Site Map Module v1.0 --------------------------------------------------------------------------------------------
            elseif ($module_name == "Google-Site-Map"):

                # each module has a logo image file START
                if (file_exists(NUKE_MODULES_DIR . $module_name . '/images/logo.png')):
                    $facebook_ogimage_normal = '<meta property="og:image" content="' . HTTP . 'modules/' . $module_name . '/images/logo.png">' . "\n";
                    $facebook_ogimage = '<meta property="og:image:secure_url" content="' . HTTP . 'modules/' . $module_name . '/images/logo.png">' . "\n";
                else:
                    $facebook_ogimage_normal = '<meta property="og:image" content="' . HTTP . 'modules/Blogs/images/logo.png">' . "\n";
                    $facebook_ogimage = '<meta property="og:image:secure_url" content="' . HTTP . 'modules/Blogs/images/logo.png">' . "\n";
                endif;
                # each module has a logo image file END

                $newpagetitle = $sitename . ' ' . $item_delim . ' Google Site Map v1.0';
                $facebook_og_title = '<meta property="og:title" content="' . $newpagetitle . '">' . "\n";

                $facebook_ogdescription = '<meta property="og:description" content="Google Site Map Generator v1.0 written by Ernest Buffington, have a look!">' . "\n";

                $facebookimagetype = '<meta property="og:image:type" content="image/png">' . "\n";
                $facebook_ogimage_width = '<meta property="og:image:width" content="1200">' . "\n";
                $facebook_ogimage_height = '<meta property="og:image:height" content="628">' . "\n";
                $facebookimage_alt = '<meta property="og:image:alt" content="Google Site Map Module v1.0">' . "\n";
                $facebook_ogurl = '<meta property="og:url" content="' . HTTPS . 'modules.php?name=' . $name . '">' . "\n";
            # PHP-Nuke Titanium Google Site Map Module v1.0 --------------------------------------------------------------------------------------------
            
            # PHP-Nuke Arcade v4.0 --------------------------------------------------------------------------------------------
            elseif ($module_name == "Forums"):
              if (($file == 'arcade') && isset($file)):
                # each module has a logo image file START
                if (file_exists(NUKE_MODULES_DIR . $module_name . '/images/logo.png')):
                    $facebook_ogimage_normal = '<meta property="og:image" content="' . HTTP . 'modules/' . $module_name . '/images/logo.png">' . "\n";
                    $facebook_ogimage = '<meta property="og:image:secure_url" content="' . HTTP . 'modules/' . $module_name . '/images/logo.png">' . "\n";
                else:
                    $facebook_ogimage_normal = '<meta property="og:image" content="' . HTTP . 'modules/Blogs/images/logo.png">' . "\n";
                    $facebook_ogimage = '<meta property="og:image:secure_url" content="' . HTTP . 'modules/Blogs/images/logo.png">' . "\n";
                endif;
                # each module has a logo image file END

                $newpagetitle = $sitename . ' ' . $item_delim . ' Titanium Arcade v4.0';
                $facebook_og_title = '<meta property="og:title" content="' . $newpagetitle . '">' . "\n";

                $facebook_ogdescription = '<meta property="og:description" content="Titanium Arcade v4.0 written by Ernest Buffington, have a look!">' . "\n";

                $facebookimagetype = '<meta property="og:image:type" content="image/png">' . "\n";
                $facebook_ogimage_width = '<meta property="og:image:width" content="1200">' . "\n";
                $facebook_ogimage_height = '<meta property="og:image:height" content="628">' . "\n";
                $facebookimage_alt = '<meta property="og:image:alt" content="Titanium Arcade v4.0">' . "\n";
                $facebook_ogurl = '<meta property="og:url" content="' . HTTPS . 'modules.php?name=' . $name . '&file=arcade">' . "\n";
                
              endif;
            # PHP-Nuke Arcade v4.0 --------------------------------------------------------------------------------------------

                else:

                if (file_exists(NUKE_MODULES_DIR . $module_name . '/images/logo.png')):
                    $facebook_ogimage_normal = '<meta property="og:image" content="' . HTTP . 'modules/' . $module_name . '/images/logo.png">' . "\n";
                    $facebook_ogimage = '<meta property="og:image:secure_url" content="' . HTTP . 'modules/' . $module_name . '/images/logo.png">' . "\n";
                else:
                    $facebook_ogimage_normal = '<meta property="og:image" content="' . HTTP . 'modules/Blogs/images/logo.png">' . "\n";
                    $facebook_ogimage = '<meta property="og:image:secure_url" content="' . HTTP . 'modules/Blogs/images/logo.png">' . "\n";
                endif;

                $facebookimagetype = '<meta property="og:image:type" content="image/png">' . "\n";
                $facebook_ogimage_width = '<meta property="og:image:width" content="1200">' . "\n";
                $facebook_ogimage_height = '<meta property="og:image:height" content="628">' . "\n";
                $facebookimage_alt = '<meta property="og:image:alt" content="Title png File">' . "\n";
                $facebook_ogurl = "<meta property=\"og:url\" content=\"" . HTTPS . "modules.php?name=$name\">\n";

            endif;

            if ($file == 'article' && isset($sid) && is_numeric($sid)):

                list($art, $top) = $db->sql_ufetchrow("SELECT `title`, `topic` FROM `" . $prefix . "_blogs` WHERE `sid`='" . $sid . "'", SQL_NUM);

                if ($top) {
                    $topicimage = '';
                    list($top, $topicimage) = $db->sql_ufetchrow("SELECT `topictext`,`topicimage` FROM `" . $prefix . "_blogs_topics` WHERE `topicid`='" . $top . "'", SQL_NUM);

                    if ($sitename == $top):
                        $newpagetitle = "$sitename $item_delim $art";
                        $facebook_og_title = '<meta property="og:title" content="' . $newpagetitle . '">' . "\n";
                    else:
                        $newpagetitle = "$sitename $item_delim $top $item_delim $art";
                        $facebook_og_title = '<meta property="og:title" content="' . $newpagetitle . '">' . "\n";
                    endif;

                    $facebook_ogimage_normal = '<meta property="og:image" content="' . HTTP . 'modules/' . $module_name . '/images/logo.png">' . "\n";
                    $facebook_ogimage = '<meta property="og:image:secure_url" content="' . HTTP . 'modules/' . $module_name . '/images/logo.png">' . "\n";

                    $facebook_ogurl = "<meta property=\"og:url\" content=\"" . HTTPS . "modules.php?name=$name&file=article&sid=$sid\">\n";
                    $facebook_ia_markup_url = "<meta property=\"ia:markup_url\" content=\"" . HTTPS . "modules.php?name=$name&file=article&sid=$sid\">\n";
                    $facebook_ia_markup_url_dev = "<meta property=\"ia:markup_url_dev\" content=\"" . HTTPS . "modules.php?name=$name&file=article&sid=$sid\">\n";
                    $facebook_ia_rules_url = "<meta property=\"ia:rules_url\" content=\"" . HTTPS . "modules.php?name=$name&file=article&sid=$sid\">\n";
                    $facebook_ia_rules_url_dev = "<meta property=\"ia:rules_url_dev\" content=\"" . HTTPS . "modules.php?name=$name&file=article&sid=$sid\">\n";

                    list($hometext) = $db->sql_ufetchrow("SELECT `hometext` FROM `" . $prefix . "_blogs` WHERE `sid`='" . $sid . "'", SQL_NUM);

                    $hometext = stripslashes(check_html($hometext, "nohtml"));

                    $facebook_ogdescription = '<meta property="og:description" content="' . $hometext . '">' . "\n";

                    $structured_data = '<script type="application/ld+json">' . "\n";

                    $structured_data .= '{' . "\n\n\n";
                    $structured_data .= '  "@context": "https://schema.org/",' . "\n";
                    $structured_data .= '  "@type": "NewsArticle",' . "\n\n";

                    $structured_data .= '  "mainEntityOfPage": {' . "\n";
                    $structured_data .= '  "@type": "WebPage",' . "\n";
                    $structured_data .= '  "@id": "' . HTTPS . 'modules.php?name=' . $module_name . '&file=article&sid=' . $sid . '"' . "\n";
                    $structured_data .= '  },' . "\n\n";

                    $structured_data .= '  "headline": "' . $art . '",' . "\n\n";
                    $structured_data .= '  "image": [' . "\n";
                    $structured_data .= '  "' . HTTPS . 'images/google/1x1.png",' . "\n";
                    $structured_data .= '  "' . HTTPS . 'images/google/4x3.png",' . "\n";
                    $structured_data .= '  "' . HTTPS . 'images/google/16x9.png"' . "\n";
                    $structured_data .= '  ],' . "\n\n";

                    list($time) = $db->sql_ufetchrow("SELECT `datePublished` FROM `" . $prefix . "_blogs` WHERE `sid`='" . $sid . "'", SQL_NUM);
                    $structured_data .= '  "datePublished": "' . $time . '",' . "\n";
                    list($dtm) = $db->sql_ufetchrow("SELECT `dateModified` FROM `" . $prefix . "_blogs` WHERE `sid`='" . $sid . "'", SQL_NUM);
                    $structured_data .= '  "dateModified": "' . $dtm . '",' . "\n\n";

                    list($name) = $db->sql_ufetchrow("SELECT `informant` FROM `" . $prefix . "_blogs` WHERE `sid`='" . $sid . "'", SQL_NUM);
                    list($username) = $db->sql_ufetchrow("SELECT `name` FROM `" . $prefix . "_users` WHERE `username`='" . $name . "'", SQL_NUM);
                    $structured_data .= '  "author": {' . "\n";
                    $structured_data .= '  "@type": "Person",' . "\n";
                    $structured_data .= '  "name": "' . $username . '"' . "\n";
                    $structured_data .= '  },' . "\n\n";

                    $structured_data .= ' "publisher": {' . "\n";
                    $structured_data .= '   "@type": "Organization",' . "\n";
                    $structured_data .= '   "name": "' . $sitename . '",' . "\n\n";

                    $structured_data .= '   "logo": {' . "\n";
                    $structured_data .= '   "@type": "ImageObject",' . "\n";
                    $structured_data .= '   "url": "' . HTTPS . 'images/google/1x1.png"' . "\n";
                    $structured_data .= '   }' . "\n";

                    $structured_data .= '  }' . "\n\n";
                    $structured_data .= "\n\n\n" . '}' . "\n";
                    $structured_data .= '</script>' . "\n";
                }


            endif;

            if (file_exists(TITANIUM_THEMES_DIR . '/includes/facebook/' . $module_name . '/' . $module_name . '.php')): # Added by Ernest Buffington
                include(TITANIUM_THEMES_DIR . '/includes/facebook/' . $module_name . '/' . $module_name . '.php');           # Load extra meta settings from each module
            endif;

        # do all this shit if you are on the index.php page
        else:
            $facebook_ogimage_normal = '<meta property="og:image" content="' . HTTP . 'modules/Blogs/images/logo.png">' . "\n";
            $facebook_ogimage = '<meta property="og:image:secure_url" content="' . HTTP . 'modules/Blogs/images/logo.png">' . "\n";
            $facebookimagetype = '<meta property="og:image:type" content="image/png">' . "\n";
            $facebook_ogimage_width = '<meta property="og:image:width" content="1200">' . "\n";
            $facebook_ogimage_height = '<meta property="og:image:height" content="628">' . "\n";
            $facebookimage_alt = '<meta property="og:image:alt" content="Programmers Making Connections. Coders Making a Difference.">' . "\n";
            $facebook_ogurl = "<meta property=\"og:url\" content=\"" . HTTPS . "index.php\">\n";

            $facebook_ia_markup_url = "<meta property=\"ia:markup_url\" content=\"" . HTTPS . "index.php\">\n";
            $facebook_ia_markup_url_dev = "<meta property=\"ia:markup_url_dev\" content=\"" . HTTPS . "index.php\">\n";
            $facebook_ia_rules_url = "<meta property=\"ia:rules_url\" content=\"" . HTTPS . "index.php\">\n";
            $facebook_ia_rules_url_dev = "<meta property=\"ia:rules_url_dev\" content=\"" . HTTPS . "index.php\">\n";
            $facebook_ogdescription = "<meta property=\"og:description\" content=\"Programmers Making Connections. Coders Making a Difference. We have a new look, come visit us today...\">\n";
            $newpagetitle = "$sitename $item_delim $top $item_delim $art";
            $facebook_og_title = '<meta property="og:title" content="' . $newpagetitle . '">' . "\n";

            $facebook_ogdescription = '<meta property="og:description" content="' . $hometext . '">' . "\n";

            $structured_data = "\n" . '<script type="application/ld+json">' . "\n";

            $structured_data .= '{' . "\n\n\n";
            $structured_data .= '  "@context": "https://schema.org/",' . "\n";
            $structured_data .= '  "@type": "NewsArticle",' . "\n\n";

            $structured_data .= '  "mainEntityOfPage": {' . "\n";
            $structured_data .= '  "@type": "WebPage",' . "\n";
            $structured_data .= '  "@id": "' . HTTPS . 'index.php"' . "\n";
            $structured_data .= '  },' . "\n\n";

            $structured_data .= '  "headline": "Welcome to ' . $sitename . '",' . "\n\n";
            $structured_data .= '  "image": [' . "\n";
            $structured_data .= '  "' . HTTPS . 'images/google/1x1.png",' . "\n";
            $structured_data .= '  "' . HTTPS . 'images/google/4x3.png",' . "\n";
            $structured_data .= '  "' . HTTPS . 'images/google/16x9.png"' . "\n";
            $structured_data .= '  ],' . "\n\n";
            list($dp) = $db->sql_ufetchrow("SELECT `datePublished` FROM `" . $prefix . "_config`", SQL_NUM);
            $structured_data .= '  "datePublished": "' . $dp . '",' . "\n";
            list($dmod) = $db->sql_ufetchrow("SELECT `dateModified` FROM `" . $prefix . "_config`", SQL_NUM);
            if (empty($dmod)) { # u need to add this to save edit General Site Settings
                $db->sql_query("INSERT INTO `" . $prefix . "_config`(dateModified) VALUES (null)");
            }
            $structured_data .= '  "dateModified": "' . $dmod . '",' . "\n\n";

            global $prefix, $portaladmin, $webmastername;
            
            $avatar = '';
            $email = '';
            
            list($webmastername,
                        $avatar,
                         $email) = $db->sql_ufetchrow("SELECT `name`,`user_avatar`, `user_email` FROM `" . $prefix . "_users` WHERE `user_id`='$portaladmin'", SQL_NUM);

            $structured_data .= '  "author": {' . "\n";
            $structured_data .= '  "@type": "Person",' . "\n";
            $structured_data .= '  "name": "' . $webmastername . '"' . "\n";
            $structured_data .= '  },' . "\n\n";

            $structured_data .= ' "publisher": {' . "\n";
            $structured_data .= '   "@type": "Organization",' . "\n";
            $structured_data .= '   "name": "' . $sitename . '",' . "\n\n";

            $structured_data .= '   "logo": {' . "\n";
            $structured_data .= '   "@type": "ImageObject",' . "\n";
            $structured_data .= '   "url": "' . HTTPS . 'images/google/1x1.png"' . "\n";
            $structured_data .= '   }' . "\n";

            $structured_data .= '  }' . "\n\n";
            $structured_data .= "\n\n\n" . '}' . "\n";
            $structured_data .= '</script>' . "\n";

            if (file_exists(TITANIUM_THEMES_DIR . '/includes/facebook/Index/Index.php')): # Added by Ernest Buffington  
                include(TITANIUM_THEMES_DIR . '/includes/facebook/Index/Index.php');           # Load extra meta settings for Index
            endif;
        endif;
        
            if (($file == 'arcade') && isset($file)):
            $module_name_str = 'Arcade v4.0';
            $newpagetitle = ($module_name) ? $item_delim . ' ' . $module_name_str : '';
            endif;
		
		    $newpagetitle = ($module_name) ? $item_delim . ' ' . $module_name_str : ''.$name.'';
			
			if(empty($name)):
            $newpagetitle = ($module_name) ? $item_delim . ' ' . $module_name_str : '&raquo; Home';
			endif;
        
		endif;

        print $facebook_admin;
        print $facebook_page_type;
        print $facebookappid;
        print $facebook_ogimage_normal;
        print $facebook_ogimage;
        print $facebookimage_alt;
        print $facebook_ia_markup_url;
        print $facebook_ia_markup_url_dev;
        print $facebook_ia_rules_url;
        print $facebook_ia_rules_url_dev;
        print $facebook_ogurl;
        print $facebook_ogimage_width;
        print $facebook_ogimage_height;
        print $facebookimagetype;
        print $facebook_ogdescription;
        print $facebook_og_title;

    print '<title>' . $sitename . ' ' . $newpagetitle . '</title>' . "\n";

    print $structured_data;
}

/**
 * Custom function: This will be used quite a lot throughout the site, For such things as CMS, Block, Module & Theme version chekcing. 
 * @since v3.0.0b
 */
function get_titanium_version_information($version_check_url, $local_cache_location, $force_refresh = false) {
    $url = $version_check_url;
    $cache = $local_cache_location . 'json.cache';
    $refresh = 24 * 60 * 60; # check for a new version once a day. // 24 * 60 * 60

    if ($force_refresh || ((time() - filectime($cache)) > ($refresh) || 0 == filesize($cache))):

        # create a new cURL resource
        $ch = curl_init();

        # set URL and other appropriate options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 7);

        # grab URL and pass it to the browser
        $response = curl_exec($ch);

        # close cURL resource, and free up system resources
        curl_close($ch);

        $jsoncache = $response;

        # Insert json information into a locally stored file, This will prevent slow page load time from slow hosts.
        $handle = fopen($cache, 'wb') or die('no fopen');
        fwrite($handle, $jsoncache);
        fclose($handle);

    else:
        # Retrieve the json cache from the locally stored file
        $jsoncache = file_get_contents($cache);
    endif;

    $jsonobject = json_decode($jsoncache, true);
    return $jsonobject;
}

function get_titanium_timeago($ptime) {
    $estimate_time = time() - $ptime;
    if ($estimate_time < 1) {
        return 'Secs';
    }
    $condition = [12 * 30 * 24 * 60 * 60 => 'Year',
        30 * 24 * 60 * 60 => 'Month',
        24 * 60 * 60 => 'Day',
        60 * 60 => 'Hour',
        60 => 'Min',
        1 => 'Sec'
        ];

    foreach ($condition as $secs => $str):
        $d = $estimate_time / $secs;
        if ($d >= 1):
            $r = round($d);
            # default calendar icon       
            $icon_string = '<span style="color:orange"><div align="center"><strong><span style="color:lightgreen">' . $r . '</span></strong><br />' . ' ' . $str . ($r > 1 ? 's' : '') . ' </span><br /><span 
	     style="color:gold"><i class="bi bi-calendar3"></i></span> </div>';
            # change the icon into a clock if less than or equal to 24 hours
            if ($estimate_time <= 86400):
                $icon_string = '<span style="color:orange"><div align="center"><strong><span style="color:lightgreen">' . $r . '</span></strong><br />' . ' ' . $str . ($r > 1 ? 's' : '') . ' </span><br /><span 
	     style="color:gold"><i class="bi bi-alarm"></i></span> </div>';
            endif;
            # change the icon into a stopwatch if less than 60 seconds
            if ($estimate_time <= 60):
                $icon_string = '<span style="color:orange"><div align="center"><strong><span style="color:lightgreen">' . $r . '</span></strong><br />' . ' ' . $str . ($r > 1 ? 's' : '') . ' </span><br /><span 
	     style="color:gold"><i class="bi bi-smartwatch"></i></span> </div>';
            endif;
            return $icon_string;
        endif;
    endforeach;
}


/**
 * Send mail, similar to PHP's mail
 *
 * @since PHP-Nuke Titanium 4.0.3
 *
 * A true return value does not automatically mean that the user received the
 * email successfully. It just only means that the method used was able to
 * process the request without any errors.
 *
 * @global PHPMailer $mail
 *
 * @param string|array $to          Array or comma-separated list of email addresses to send message.
 * @param string       $subject     Email subject
 * @param string       $message     Message contents
 * @param string|array $headers     Optional. Additional headers.
 * @param string|array $attachments Optional. Files to attach.
 * @return bool Whether the email contents were sent successfully.
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function phpmailer($to, $subject, $message, $headers = '', $attachments = array())
{
	global $mail, $board_config, $nukeconfig;

	if ( ! ( $mail instanceof PHPMailer ) ) { $mail = new PHPMailer(true); }

	if (isset($to)) { $to = $to; }
 
	if (!is_array( $to ) ) { $to = explode( ',', $to );	}

	// Headers
	$cc = $bcc = $reply_to = array();

	// $mail->SMTPDebug = 2;

	if ( $board_config['smtp_delivery'] == '1' ):

		$mail->Host = $board_config['smtp_host'];
		$mail->Port = $board_config['smtp_port'];

		$mail->isSMTP();

		$mail->SMTPSecure = $board_config['smtp_encryption'];

		// if ( $board_config['smtp_encryption'] != 'none' ):
		//     $mail->SMTPSecure = $board_config['smtp_encryption'];
		// endif;

		if ( 'none' === $board_config['smtp_encryption'] ):

			$mail->SMTPSecure  = '';
			$mail->SMTPAutoTLS = false;

		endif;

		if ( $board_config['smtp_auth'] == 1 ):

			$mail->SMTPAuth = true;
			$mail->Username = $board_config['smtp_username'];

			if( defined('SMTP_Password') && SMTP_Password ):
				$mail->Password = SMTP_Password;
			else:
				$mail->Password = $board_config['smtp_password'];
			endif;

		else:
			$mail->SMTPAuth = false;
		endif;

	else:
		$mail->IsMail();
	endif;

	/* sort the headers */
	if ( empty( $headers ) ) 
	{
		$headers = array();
	}
	else
	{
		if ( !is_array( $headers ) ) {
			// Explode the headers out, so this function can take both
			// string headers and an array of headers.
			$tempheaders = explode( "\n", str_replace( "\r\n", "\n", $headers ) );
		} 
		else 
		{
			$tempheaders = $headers;
		}

		// If it's actually got contents
		if ( !empty( $tempheaders ) ) {
			// Iterate through the raw headers
			foreach ( (array) $tempheaders as $header ) {
				if ( strpos($header, ':') === false ) {
					if ( false !== stripos( $header, 'boundary=' ) ) {
						$parts = preg_split('/boundary=/i', trim( $header ) );
						$boundary = trim( str_replace( array( "'", '"' ), '', $parts[1] ) );
					}
					continue;
				}
				// Explode them out
				list( $name, $content ) = explode( ':', trim( $header ), 2 );
 
				// Cleanup crew
				$name    = trim( $name    );
				$content = trim( $content );
 
				switch ( strtolower( $name ) ) 
				{
					case 'from':
						$bracket_pos = strpos( $content, '<' );
						if ( $bracket_pos !== false ) {
							// Text before the bracketed email is the "From" name.
							if ( $bracket_pos > 0 ) {
								$from_name = substr( $content, 0, $bracket_pos - 1 );
								$from_name = str_replace( '"', '', $from_name );
								$from_name = trim( $from_name );
							}
 
							$from_email = substr( $content, $bracket_pos + 1 );
							$from_email = str_replace( '>', '', $from_email );
							$from_email = trim( $from_email );
 
						// Avoid setting an empty $from_email.
						} elseif ( '' !== trim( $content ) ) {
							$from_email = trim( $content );
						}
						break;
					case 'content-type':
						if ( strpos( $content, ';' ) !== false ) {
							list( $type, $charset_content ) = explode( ';', $content );
							$content_type = trim( $type );
							if ( false !== stripos( $charset_content, 'charset=' ) ) {
								$charset = trim( str_replace( array( 'charset=', '"' ), '', $charset_content ) );
							} elseif ( false !== stripos( $charset_content, 'boundary=' ) ) {
								$boundary = trim( str_replace( array( 'BOUNDARY=', 'boundary=', '"' ), '', $charset_content ) );
								$charset = '';
							}
 
						// Avoid setting an empty $content_type.
						} elseif ( '' !== trim( $content ) ) {
							$content_type = trim( $content );
						}
						break;
					case 'cc':
						$cc = array_merge( (array) $cc, explode( ',', $content ) );
						break;
					case 'bcc':
						$bcc = array_merge( (array) $bcc, explode( ',', $content ) );
						break;
					case 'reply-to':
						$reply_to = array_merge( (array) $reply_to, explode( ',', $content ) );
						break;
					default:
						// Add it to our grand headers array
						$headers[trim( $name )] = trim( $content );
						break;
				}
			}
		}
	}

	$address_headers = compact( 'to', 'cc', 'bcc', 'reply_to' );
	foreach ( $address_headers as $address_header => $addresses ) 
	{
		if ( empty( $addresses ) ) {
			continue;
		}
 
		foreach ( (array) $addresses as $address ) {
			try {
				// Break $recipient into name and address parts if in the format "Foo <bar@baz.com>"
				$recipient_name = '';
 
				if ( preg_match( '/(.*)<(.+)>/', $address, $matches ) ) {
					if ( count( $matches ) == 3 ) {
						$recipient_name = $matches[1];
						$address        = $matches[2];
					}
				}
 
				switch ( $address_header ) {
					case 'to':
					    //Add a recipient
						$mail->addAddress( $address, $recipient_name );
						break;
					case 'cc':
						$mail->addCC( $address, $recipient_name );
						break;
					case 'bcc':
						$mail->addBCC( $address, $recipient_name );
						break;
					case 'reply_to':
						$mail->addReplyTo( $address, $recipient_name );
						break;
				}
			} catch ( phpmailerException $e ) {
				continue;
			}
		}
	}

	if ( !isset( $from_name ) )
		$from_name = $board_config['sitename'];

	if ( !isset( $from_email ) ) 
		$from_email = $nukeconfig['adminmail'];

	$mail->ContentType = 'text/plain'; 
	$mail->CharSet = 'utf-8';
	$mail->From = $from_email;
	$mail->FromName = $from_name;

	// Set whether it's plaintext, depending on $content_type
	//if ( 'text/html' == $content_type ) # we want html on all the time!
	$content_type = 'text/html';

	$mail->Subject = $subject;
	$mail->Body = $message;
	$mail->isHTML(true);

	if (!$mail->send()) {
		$mail->ErrorInfo;
		$mail->clearAllRecipients();
		$mail->clearReplyTos();
		OpenTable();
		echo 'Message could not be sent.<br />';
		CloseTable();
		include_once(NUKE_BASE_DIR.'footer.php');
		exit;
		// return FALSE;
	} else { 
		$mail->clearAllRecipients();
		$mail->clearReplyTos();      
		return TRUE;
	}
}
