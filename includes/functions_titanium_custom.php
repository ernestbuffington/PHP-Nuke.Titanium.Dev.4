<?php

# all facebook div tags should have the ampersand encoded from & to &amp;
# do not encode script tags from & to &amp; - leave theme alone,

function facebook_likes() {
    if (defined('facebook')):
        global $sid, $appID, $my_url;
		echo 'LIKE START</br>';
		
		# IFRAME LOADER
		#echo '<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.php-nuke-titanium.86it.us%2Fmodules.php%3Fname%3DBlogs%26file%3Darticle%26sid%3D' . $sid . '%26mode%3Dnested%26order%3D0%26thold%3D0&tabs=timeline&width=180&height=70&small_header=false&adapt_container_width=true&hide_cover=true&show_facepile=true&appId=' . $appID . '" width="180" height="70" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>';
        # NORMAL LOADER
		//echo '<div class="fb-page" data-href="https://' . $my_url . '/modules.php?name=Blogs&amp;file=article&amp;sid=' . $sid . '&amp;mode=nested&amp;order=0&amp;thold=0" data-tabs="timeline" data-width="180" data-height="70" data-small-header="false" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true"></div>';

   endif;
   		echo 'LIKE END</br>';

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

                list($art, $top) = $db->sql_ufetchrow("SELECT `title`, `topic` FROM `" . $prefix . "_stories` WHERE `sid`='" . $sid . "'", SQL_NUM);

                if ($top) {
                    $topicimage = '';
                    list($top, $topicimage) = $db->sql_ufetchrow("SELECT `topictext`,`topicimage` FROM `" . $prefix . "_topics` WHERE `topicid`='" . $top . "'", SQL_NUM);

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

                    list($hometext) = $db->sql_ufetchrow("SELECT `hometext` FROM `" . $prefix . "_stories` WHERE `sid`='" . $sid . "'", SQL_NUM);

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

                    list($time) = $db->sql_ufetchrow("SELECT `datePublished` FROM `" . $prefix . "_stories` WHERE `sid`='" . $sid . "'", SQL_NUM);
                    $structured_data .= '  "datePublished": "' . $time . '",' . "\n";
                    list($dtm) = $db->sql_ufetchrow("SELECT `dateModified` FROM `" . $prefix . "_stories` WHERE `sid`='" . $sid . "'", SQL_NUM);
                    $structured_data .= '  "dateModified": "' . $dtm . '",' . "\n\n";

                    list($name) = $db->sql_ufetchrow("SELECT `informant` FROM `" . $prefix . "_stories` WHERE `sid`='" . $sid . "'", SQL_NUM);
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
            $icon_string = '<font color="orange"><div align="center"><strong><font color="lightgreen">' . $r . '</font></strong><br />' . ' ' . $str . ($r > 1 ? 's' : '') . ' </font><br /><font 
	     color="gold"><i class="bi bi-calendar3"></i></font> </div>';
            # change the icon into a clock if less than or equal to 24 hours
            if ($estimate_time <= 86400):
                $icon_string = '<font color="orange"><div align="center"><strong><font color="lightgreen">' . $r . '</font></strong><br />' . ' ' . $str . ($r > 1 ? 's' : '') . ' </font><br /><font 
	     color="gold"><i class="bi bi-alarm"></i></font> </div>';
            endif;
            # change the icon into a stopwatch if less than 60 seconds
            if ($estimate_time <= 60):
                $icon_string = '<font color="orange"><div align="center"><strong><font color="lightgreen">' . $r . '</font></strong><br />' . ' ' . $str . ($r > 1 ? 's' : '') . ' </font><br /><font 
	     color="gold"><i class="bi bi-smartwatch"></i></font> </div>';
            endif;
            return $icon_string;
        endif;
    endforeach;
}


