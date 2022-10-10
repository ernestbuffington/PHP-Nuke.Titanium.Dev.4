<?php

function ShoutBox($ShoutSubmit, $ShoutComment, $shoutuid) {

    global $currentlang, $cache, $top_content, $mid_content, $bottom_content, $ShoutMarqueeheight, $nsnst_const, $userinfo, $prefix, $db, $top_out, $board_config;
	
    if (!empty($currentlang)) {
        include_once(NUKE_MODULES_DIR.'Shout_Box/lang-block/lang-'.$currentlang.'.php');
    } else {
        include_once(NUKE_MODULES_DIR.'Shout_Box/lang-block/lang-english.php');
    }

    $PreviousShoutComment = $ShoutComment;
    $BannedShouter = '';

    $is_user = is_user();
    $username = $userinfo['username'];

    if ((($conf = $cache->load('conf', 'shoutbox')) == false) || empty($conf)) {
        $sql = "SELECT * FROM `".$prefix."_shoutbox_conf`";
        $result = $db->sql_query($sql);
        $conf = $db->sql_fetchrow($result);
        $cache->save('conf', 'shoutbox', $conf);
        $db->sql_freeresult($result);
    }

    if ((($nameblock = $cache->load('nameblock', 'shoutbox')) == false) || empty($nameblock)) {
        $sql = "SELECT `name` FROM ".$prefix."_shoutbox_nameblock";
        $nameresult = $db->sql_query($sql);
        while ($row = $db->sql_fetchrow($nameresult)) {
            $nameblock[] = $row;
        }
        $cache->save('nameblock', 'shoutbox', $nameblock);
        $db->sql_freeresult($nameresult);
    }

    if ((($censor = $cache->load('censor', 'shoutbox')) == false) || empty($censor)) {
        $sql = "SELECT * FROM ".$prefix."_shoutbox_censor";
        $result = $db->sql_query($sql);
        while ($row = $db->sql_fetchrow($result)) {
            $censor[] = $row;
        }
        $cache->save('censor', 'shoutbox', $censor);
        $db->sql_freeresult($result);
    }

    // Check if block is in center position
    $sql = "SELECT `bposition` FROM `".$prefix."_blocks` WHERE `blockfile`='block-Shout_Box.php'";
    $SBpos = $db->sql_query($sql);
    $SBpos = $db->sql_fetchrow($SBpos);
    if ($SBpos['bposition'] == 'c' || $SBpos['bposition'] == 'd') {
        $SBpos = 'center';
        $SBborder = 1;
    } else {
        $SBpos = 'side';
        $SBborder = 0;
    }
    $db->sql_freeresult($SBpos);

    if (isset($nsnst_const['remote_ip']) && !empty($nsnst_const['remote_ip'])) {
        $uip = $nsnst_const['remote_ip'];
    } else {
        $uip = '';
    }

    //do IP test then ban if on list
    if($conf['ipblock']== 'yes') {
        $sql = "SELECT `name` FROM `".$prefix."_shoutbox_ipblock`";
        $ipresult = $db->sql_query($sql);
        while ($badips = $db->sql_fetchrow($ipresult)) {
            if (preg_match("/\[\*\]/i", $badips['name'])) { // Allow for Subnet bans like 123.456.*
                $badipsArray = explode(".",$badips['name']);
                $uipArray = explode(".",$uip);
                $i = 0;
                if (is_array($badipsArray)) {
                    foreach($badipsArray as $badipsPart) {
                        if ($badipsPart == "*") {
                            $BannedShouter = "yes";
                            break;
                        }
                        if ($badipsPart != $uipArray[$i] && $badipsPart != "*") { break; }
                        $i++;
                    }
                }
            } else {
                if($uip == $badips['name']) {
                    $BannedShouter = "yes";
                    break;
                }
            }
        }
        $db->sql_freeresult($ipresult);
    }
    //do name test then ban if on list (only applies to registered users)
    if ($conf['nameblock']== 'yes'  && $BannedShouter != "yes") {
        if (is_array($nameblock)) {
            foreach ($nameblock as $name) {
                if ($username == $name['name']) {
                    $BannedShouter = "yes";
                    break;
                }
            }
        }
    }
    if ($BannedShouter != "yes") {
        if ($ShoutSubmit == "ShoutPost") {
			// start processing shout
			if (isset($shoutuid) && !empty($shoutuid)) {
				$username = $shoutuid;
			}
			
			// remove whitespace off ends of nickname
			$username = trim($username);
			
			if($conf['anonymouspost']== 'yes') {
				$unum = strlen($username);
				if ($unum < 2) { $ShoutError = _NICKTOOSHORT; }
				if (!$username || $username == _NAME) { $ShoutError = _NONICK; }
				if (preg_match("/\.xxx/i", $username) && $conf['blockxxx']== 'yes') { $username = "Anonymous"; }
				if (preg_match("#javascript:(.*)#i", $username)) { $username = "Anonymous"; }
				$username = htmlspecialchars($username, ENT_QUOTES);
				$username = str_replace("&amp;amp;", "&amp;",$username);
			}
			if (!$is_user && !empty($username) && $username != "Anonymous") {
				$username = str_replace(" ", "_",$username);
			}

			$ShoutComment = trim($ShoutComment); // remove whitespace off ends of shout
			$ShoutComment = preg_replace('/\s+/', ' ', $ShoutComment); // convert double spaces in middle of shout to single space
			$num = strlen($ShoutComment);
			if ($num < 1) { $ShoutError = _SHOUTTOOSHORT; }
			if ($num > 2500) { $ShoutError = _SHOUTTOOLONG; }
			if (!$ShoutComment) { $ShoutError = _NOSHOUT; }
			if ($ShoutComment == _SB_MESSAGE) { $ShoutError = _NOSHOUT; }
			$ShoutComment = str_replace(" [.] ", ".",$ShoutComment);
			if (preg_match("/\.xxx/i", $ShoutComment) && $conf['blockxxx']== 'yes') {
				$ShoutError = _XXXBLOCKED;
				$PreviousShoutComment = '';
			}
			if (preg_match("#javascript:(.*)#i", $ShoutComment)) {
				$ShoutError = _JSINSHOUT;
				$PreviousShoutComment = '';
			}

			$ShoutComment = htmlspecialchars($ShoutComment, ENT_QUOTES);
			$ShoutComment = str_replace("&amp;amp;", "&amp;",$ShoutComment);

			// Scan for links in the shout. If there is, replace it with [URL] || block it if disallowed
			$i = 0;
			$ShoutNew = '';
			$ShoutArray = explode(" ",$ShoutComment);
			if (is_array($ShoutArray)) {
				foreach($ShoutArray as $ShoutPart) {
					if (is_array($ShoutPart)) { $ShoutPart = $ShoutPart[0]; }
					if (preg_match("#http://#i", $ShoutPart)) {
						if ((!$is_user && $conf['urlanononoff'] == 'no') || ($is_user && $conf['urlonoff'] == 'no')) { $ShoutError = _URLNOTALLOWED; break; }
						// fix for users adding text to the beginning of links: HACKhttp://www.website.com
						$ShoutPartL = strtolower($ShoutPart);
						$spot = strpos($ShoutPartL,"http://");
						if ($spot > 0) { $ShoutPart = substr($ShoutPart, $spot); }
						$ShoutNew[$i] = "&#91;<a rel=\"nofollow\" target=\"_blank\" href=\"$ShoutPart\">URL</a>&#93;";
					} elseif (preg_match("#ftp://#i", $ShoutPart)) {
						if ((!$is_user && $conf['urlanononoff'] == 'no') || ($is_user && $conf['urlonoff'] == 'no')) { $ShoutError = _URLNOTALLOWED; break; }
						$ShoutPartL = strtolower($ShoutPart);
						$spot = strpos($ShoutPartL,"ftp://");
						if ($spot > 0) { $ShoutPart = substr($ShoutPart, $spot); }
						$ShoutNew[$i] = "&#91;<a rel=\"nofollow\" target=\"_blank\" href=\"$ShoutPart\">FTP</a>&#93;";
					} elseif (preg_match("#irc://#i", $ShoutPart)) {
						if ((!$is_user && $conf['urlanononoff'] == 'no') || ($is_user && $conf['urlonoff'] == 'no')) { $ShoutError = _URLNOTALLOWED; break; }
						$ShoutPartL = strtolower($ShoutPart);
						$spot = strpos($ShoutPartL,"irc://");
						if ($spot > 0) { $ShoutPart = substr($ShoutPart, $spot); }
						$ShoutNew[$i] = "&#91;<a rel=\"nofollow\" href=\"$ShoutPart\">IRC</a>&#93;";
					} elseif (preg_match("#teamspeak://#i", $ShoutPart)) {
						if ((!$is_user && $conf['urlanononoff'] == 'no') || ($is_user && $conf['urlonoff'] == 'no')) { $ShoutError = _URLNOTALLOWED; break; }
						$ShoutPartL = strtolower($ShoutPart);
						$spot = strpos($ShoutPartL,"teamspeak://");
						if ($spot > 0) { $ShoutPart = substr($ShoutPart, $spot); }
						$ShoutNew[$i] = "&#91;<a rel=\"nofollow\" href=\"$ShoutPart\">TeamSpeak</a>&#93;";
					} elseif (preg_match("#aim:goim#i", $ShoutPart)) {
						if ((!$is_user && $conf['urlanononoff'] == 'no') || ($is_user && $conf['urlonoff'] == 'no')) { $ShoutError = _URLNOTALLOWED; break; }
						$ShoutPartL = strtolower($ShoutPart);
						$spot = strpos($ShoutPartL,"aim:goim");
						if ($spot > 0) { $ShoutPart = substr($ShoutPart, $spot); }
						$ShoutNew[$i] = "&#91;<a rel=\"nofollow\" href=\"$ShoutPart\">AIM</a>&#93;";
					} elseif (preg_match("#gopher://#i", $ShoutPart)) {
						if ((!$is_user && $conf['urlanononoff'] == 'no') || ($is_user && $conf['urlonoff'] == 'no')) { $ShoutError = _URLNOTALLOWED; break; }
						$ShoutPartL = strtolower($ShoutPart);
						$spot = strpos($ShoutPartL,"gopher://");
						if ($spot > 0) { $ShoutPart = substr($ShoutPart, $spot); }
						$ShoutNew[$i] = "&#91;<a rel=\"nofollow\" href=\"$ShoutPart\">Gopher</a>&#93;";
					} elseif (preg_match("#mailto:#i", $ShoutPart)) {
						$ShoutPartL = strtolower($ShoutPart);
						$spot = strpos($ShoutPartL,"mailto:");
						if ($spot > 0) { $ShoutPart = substr($ShoutPart, $spot); }
						// email encoding to stop harvesters
						$ShoutPart = bin2hex($ShoutPart);
						$ShoutPart = chunk_split($ShoutPart, 2, '%');
						$ShoutPart = '%' . substr($ShoutPart, 0, strlen($ShoutPart) - 1);
						$ShoutNew[$i] = "&#91;<a href=\"$ShoutPart\">E-Mail</a>&#93;";
					} elseif (preg_match("#www.#i", $ShoutPart)) {
						if ((!$is_user && $conf['urlanononoff'] == 'no') || ($is_user && $conf['urlonoff'] == 'no')) { $ShoutError = _URLNOTALLOWED; break; }
						$ShoutPartL = strtolower($ShoutPart);
						$spot = strpos($ShoutPartL,"www.");
						if ($spot > 0) { $ShoutPart = substr($ShoutPart, $spot); }
						$ShoutPart = "http://" . $ShoutPart;
						$ShoutNew[$i] = "&#91;<a rel=\"nofollow\" target=\"_blank\" href=\"$ShoutPart\">URL</a>&#93;";
					} elseif (preg_match('#@#i', $ShoutPart) && preg_match('/\[\.\]/i', $ShoutPart)) {
						// email encoding to stop harvesters
						$ShoutPart = bin2hex($ShoutPart);
						$ShoutPart = chunk_split($ShoutPart, 2, '%');
						$ShoutPart = '%' . substr($ShoutPart, 0, strlen($ShoutPart) - 1);
						$ShoutNew[$i] = "&#91;<a href=\"mailto:$ShoutPart\">E-Mail</a>&#93;";
					} elseif ((preg_match("/\.(us|tv|cc|ws|ca|de|jp|ro|be|fm|ms|tc|ph|dk|st|ac|gs|vg|sh|kz|as|lt|to)/i", substr("$ShoutPart", -3,3))) || (preg_match("/\.(com|net|org|mil|gov|biz|pro|xxx)/i", substr("$ShoutPart", -4,4))) || (preg_match("/\.(info|name|mobi)/i", substr("$ShoutPart", -5,5))) || (preg_match("/\.(co\.uk|co\.za|co\.nz|co\.il)/i", substr("$ShoutPart", -6,6)))) {
						if ((!$is_user && $conf['urlanononoff'] == 'no') || ($is_user && $conf['urlonoff'] == 'no')) { $ShoutError = _URLNOTALLOWED; break; }
						$ShoutPart = "http://" . $ShoutPart;
						$ShoutNew[$i] = "&#91;<a rel=\"nofollow\" target=\"_blank\" href=\"$ShoutPart\">URL</a>&#93;";
					} elseif (strlen(html_entity_decode($ShoutPart, ENT_QUOTES)) > 21) {
						$ShoutNew[$i] = htmlspecialchars(wordwrap(html_entity_decode($ShoutPart, ENT_QUOTES), 21, " ", 1), ENT_QUOTES);

						$ShoutNew[$i] = str_replace("[ b]", " [b]",$ShoutNew[$i]);
						$ShoutNew[$i] = str_replace("[b ]", " [b]",$ShoutNew[$i]);
						$ShoutNew[$i] = str_replace("[ /b]", "[/b] ",$ShoutNew[$i]);
						$ShoutNew[$i] = str_replace("[/ b]", "[/b] ",$ShoutNew[$i]);
						$ShoutNew[$i] = str_replace("[/b ]", "[/b] ",$ShoutNew[$i]);

						$ShoutNew[$i] = str_replace("[ i]", " [i]",$ShoutNew[$i]);
						$ShoutNew[$i] = str_replace("[i ]", " [i]",$ShoutNew[$i]);
						$ShoutNew[$i] = str_replace("[ /i]", "[/i] ",$ShoutNew[$i]);
						$ShoutNew[$i] = str_replace("[/ i]", "[/i] ",$ShoutNew[$i]);
						$ShoutNew[$i] = str_replace("[/i ]", "[/i] ",$ShoutNew[$i]);

						$ShoutNew[$i] = str_replace("[ u]", " [u]",$ShoutNew[$i]);
						$ShoutNew[$i] = str_replace("[u ]", " [u]",$ShoutNew[$i]);
						$ShoutNew[$i] = str_replace("[ /u]", "[/u] ",$ShoutNew[$i]);
						$ShoutNew[$i] = str_replace("[/ u]", "[/u] ",$ShoutNew[$i]);
						$ShoutNew[$i] = str_replace("[/u ]", "[/u] ",$ShoutNew[$i]);
					} else { $ShoutNew[$i] = $ShoutPart; }
					$i++;
				}
			}
			if (empty($ShoutError)) { $ShoutComment = implode(" ",$ShoutNew); }

			//Smilies from database
			$ShoutArrayReplace = explode(" ",$ShoutComment);
			$ShoutArrayScan = $ShoutArrayReplace;
			$sql = "SELECT `text`, `image` FROM `".$prefix."_shoutbox_emoticons`";
			$eresult = $db->sql_query($sql);
			while ($emoticons = $db->sql_fetchrow($eresult)) {
				$i = 0;
				if (is_array($ShoutArrayScan)) {
					foreach($ShoutArrayScan as $ShoutPart) {
						if ($ShoutPart == $emoticons['text']) { $ShoutArrayReplace[$i] = $emoticons['image']; }
						$i++;
					}
				}
			}
			$db->sql_freeresult($eresult);
			$ShoutComment = implode(" ",$ShoutArrayReplace);

			//do name test then error if on list
			if($conf['nameblock']== 'yes') {
				if (is_array($nameblock)) {
					foreach ($nameblock as $name) {
						if($username == $name['name']) {
							$ShoutError = _BANNEDNICK;
						}
					}
				}
			}

			// check for anonymous users cloning/ghosting registered users' nicknames
			if (!is_user() && !empty($username) && $username != "Anonymous") {
				$sql = "SELECT `username` FROM `".$prefix."_users` WHERE `username`='$username'";
				$nameresult = $db->sql_query($sql);
				if ($row = $db->sql_fetchrow($nameresult)) {
					$ShoutError = _NOCLONINGNICKS;
				}
				$db->sql_freeresult($nameresult);
			}

			//look for bad words, then censor them.
			if($conf['censor']== 'yes') {
				// start Anonymous nickname censor check here. If bad, replace bad nick with 'Anonymous'
				if (!$is_user && !empty($username) && $username != "Anonymous") {
					if (is_array($censor)) {
						foreach ($censor as $word) {
							if ($username != 'Anonymous') {
								$one = strtolower($word['text']);
								$usernameL = strtolower($username);
								if (stristr($usernameL, $one) !== false) {
									$username = "Anonymous";
								}
							}
						}
					}
				}
				// Censor of posting text
				$ShoutArrayReplace = explode(" ",$ShoutComment);
				$ShoutArrayScan = $ShoutArrayReplace;
				if (is_array($censor)) {
					foreach ($censor as $word) {
						$i = 0;
						if (is_array($ShoutArrayScan)) {
							foreach($ShoutArrayScan as $ShoutPart) {
								$ShoutPart = strtolower($ShoutPart);
								$censor['text'] = strtolower($word['text']);
								if ($ShoutPart == $word['text']) { $ShoutArrayReplace[$i] = $word['replacement']; }
								$i++;
							}
						}
					}
				}
				$ShoutComment = implode(" ",$ShoutArrayReplace);

			}

			// duplicate posting checker. stops repeated spam attacks
			$sql = "SELECT `comment` FROM `".$prefix."_shoutbox_shouts` ORDER BY `id` DESC LIMIT 5";
			$result = $db->sql_query($sql);
			while ($row = $db->sql_fetchrow($result)) {
				if ($row['comment'] == $ShoutComment) {
					$ShoutError = _DUPLICATESHOUT;
				}
			}
			$db->sql_freeresult($result);

			if ($conf['anonymouspost'] == 'no' && $username == 'Anonymous') {
					$ShoutError = _ONLYREGISTERED2;
			}

			if (!$ShoutError) {

				if ($is_user) {
					$day = EvoDate('d/m/Y', time(), $userinfo['user_timezone']);
					$time = EvoDate('H:i', time(), $userinfo['user_timezone']);
				} else {
					$day = EvoDate('d/m/Y', time(), $board_config['board_timezone']);
					$time = EvoDate('H:i', time(), $board_config['board_timezone']);
				}

				$currentTime = time();

				$sql = "INSERT INTO ".$prefix."_shoutbox_shouts (id,name,comment,date,time,ip,timestamp) VALUES ('0','$username','$ShoutComment','$day','$time','$uip','$currentTime')";
				$db->sql_query($sql);

				$PreviousShoutComment = '';
				$PreviousComment = '';
			} else {
				if ($username != _NAME) {
					$PreviousUsername = $username;
				}
				if ($PreviousShoutComment != _SB_MESSAGE) {
					$PreviousComment = $PreviousShoutComment;
				}
			}

        }

        //Display Content From here on down

        if (!is_user() && !empty($username) && $username != "Anonymous") { $username = "Anonymous"; }

        $ThemeSel = get_theme();
        $sql = "SELECT * FROM `".$prefix."_shoutbox_theme_images` WHERE `themeName`='$ThemeSel'";
        $result = $db->sql_query($sql);
        $themeRow = $db->sql_fetchrow($result);
        $db->sql_freeresult($result);

        if (!empty($themeRow['blockBackgroundImage']) && file_exists(NUKE_MODULES_DIR.'Shout_Box/images/background/'.$themeRow['blockBackgroundImage'])) {
            $showBackground = 'yes';
        } else {
            $showBackground = 'no';
        }

        if (!empty($themeRow['blockArrowColor'])) {
            if (file_exists(NUKE_MODULES_DIR.'Shout_Box/images/up/'.$themeRow['blockArrowColor'])) {
                $up_img = 'modules/Shout_Box/images/up/'.$themeRow['blockArrowColor'];
            } else {
                $up_img = 'modules/Shout_Box/images/up/Black.gif';
            }
            if (file_exists(NUKE_MODULES_DIR.'Shout_Box/images/down/'.$themeRow['blockArrowColor'])) {
                $down_img = 'modules/Shout_Box/images/down/'.$themeRow['blockArrowColor'];
            } else {
                $down_img = 'modules/Shout_Box/images/down/Black.gif';
            }
            if (file_exists(NUKE_MODULES_DIR.'Shout_Box/images/pause/'.$themeRow['blockArrowColor'])) {
                $pause_img = 'modules/Shout_Box/images/pause/'.$themeRow['blockArrowColor'];
            } else {
                $pause_img = 'modules/Shout_Box/images/pause/Black.gif';
            }
        } else {
            $up_img = 'modules/Shout_Box/images/up/Black.gif';
            $down_img = 'modules/Shout_Box/images/down/Black.gif';
            $pause_img = 'modules/Shout_Box/images/pause/Black.gif';
        }

        $sql = "SELECT * FROM `".$prefix."_shoutbox_shouts` ORDER BY `id` DESC LIMIT $conf[number]";
        $result = $db->sql_query($sql);


        // Top half

        // shout error reporting
        $top_content = '';
        if (!empty($ShoutError)) {
            $top_content .= "<table style=\"cursor: text;\" width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\"><tr><td style=\"background-color: #FFFFE1;\"><strong>"._SB_NOTE.":</strong> $ShoutError</td></tr></table>";
            $top_out = "<td style=\"background-color: #FFFFE1;\"><strong>"._SB_NOTE.":</strong> $ShoutError</td>";
        }

        // table that holds the scrolling area
        if ($showBackground == 'yes') {
            $top_content .= "<table style=\"cursor: text;\" width=\"100%\" border=\"$SBborder\" cellspacing=\"0\" cellpadding=\"0\"><tr><td style=\"background: url(modules/Shout_Box/images/background/".$themeRow['blockBackgroundImage'].");\" height=\"".$conf['height']."\"><div id=\"shout_top\"></div>\n";
        } else {
            $top_content .= "<table style=\"cursor: text;\" width=\"100%\" border=\"$SBborder\" cellspacing=\"0\" cellpadding=\"0\"><tr><td height=\"".$conf['height']."\"><div id=\"shout_top\"></div>\n";
        }
        // end top content

        // table of the actual scrolling content
        if ($showBackground == 'yes') {
            $mid_content = "<table style=\"table-layout: fixed; width: 100%;\" border=\"0\" align=\"left\" cellspacing=\"0\" cellpadding=\"5\">";
        } else {
            $mid_content = "<table style=\"table-layout: fixed; width: 100%;\" border=\"0\" align=\"left\" cellspacing=\"0\" cellpadding=\"2\">";
        }
        $flag = 1;
        $ThemeSel = get_theme();
        $sql = "SELECT `blockColor1`, `blockColor2` FROM `".$prefix."_shoutbox_themes` WHERE `themeName`='$ThemeSel'";
        $resultT = $db->sql_query($sql);
        $rowColor = $db->sql_fetchrow($resultT);
        $db->sql_freeresult($resultT);

        // Sticky shouts
        $sql = "SELECT `comment`, `timestamp` FROM `".$prefix."_shoutbox_sticky` WHERE `stickySlot`=0";
        $stickyResult = $db->sql_query($sql);
        $stickyRow0 = $db->sql_fetchrow($stickyResult);
        $db->sql_freeresult($stickyResult);
        $sql = "SELECT `comment`, `timestamp` FROM `".$prefix."_shoutbox_sticky` WHERE `stickySlot`=1";
        $stickyResult = $db->sql_query($sql);
        $stickyRow1 = $db->sql_fetchrow($stickyResult);
        $db->sql_freeresult($stickyResult);

        if ($stickyRow0) {
            if ($showBackground == 'yes') {
                $mid_content .= "<tr><td>";
            } else {
                if ($flag == 1) { $flag = 2; }
                elseif ($flag == 2) { $flag = 1; }
                $mid_content .= "<tr><td style=\"background-color: ".$rowColor['blockColor1'].";\">";
            }
            $mid_content .= "<strong>"._SB_ADMIN.":</strong> ".$stickyRow0['comment'];
            if ($conf['date']== 'yes') {
                if ($is_user) {
                    $unixTime = EvoDate($userinfo['user_dateformat'], $stickyRow0['timestamp'], $userinfo['user_timezone']);
                    $mid_content .= "<br />$unixTime";
                } else {
                    $unixTime = EvoDate($board_config['default_dateformat'], $stickyRow0['timestamp'], $board_config['board_timezone']);
                    $mid_content .= "<br />$unixTime";
                }
            }
            $mid_content .= "</td></tr>";
        }
        if ($stickyRow1) {
            if ($showBackground == 'yes') {
                $mid_content .= "<tr><td>";
            } else {
                if ($flag == 1) { $flag = 2; }
                elseif ($flag == 2) { $flag = 1; }
                $mid_content .= "<tr><td style=\"background-color: ".$rowColor['blockColor2'].";\">";
            }
            $mid_content .= "<strong>"._SB_ADMIN.":</strong> ".$stickyRow1['comment'];
            if ($conf['date']== 'yes') {
                if ($is_user) {
                    $unixTime = EvoDate($userinfo['user_dateformat'], $stickyRow1['timestamp'], $userinfo['user_timezone']);
                    $mid_content .= "<br />$unixTime";
                } else {
                    $unixTime = EvoDate($board_config['default_dateformat'], $stickyRow1['timestamp'], $board_config['board_timezone']);
                    $mid_content .= "<br />$unixDay&nbsp;$unixTime";
                }
            }
            $mid_content .= "</td></tr>";
        }
        // end sticky shouts

        $i = 0;
        while ($row = $db->sql_fetchrow($result)) {
            if ($flag == 1) { $bgcolor = $rowColor['blockColor1']; }
            if ($flag == 2) { $bgcolor = $rowColor['blockColor2']; }
            if ($showBackground == 'yes') {
                $tempContent[$i] = "<tr><td>";
            } else {
                $tempContent[$i] = "<tr><td style=\"background-color: $bgcolor;\">";
            }
            $ShoutComment = str_replace('src=', 'src="', $row['comment']);
            $ShoutComment = str_replace('.gif>', '.gif" alt="" />', $ShoutComment);
            $ShoutComment = str_replace('.jpg>', '.jpg" alt="" />', $ShoutComment);
            $ShoutComment = str_replace('.png>', '.png" alt="" />', $ShoutComment);
            $ShoutComment = str_replace('.bmp>', '.bmp" alt="" />', $ShoutComment);

            // BB code [b]word[/b] [i]word[/i] [u]word[/u]
            if ((preg_match("/\[b\]/i", $ShoutComment)) && (preg_match("/\[\/b\]/i", $ShoutComment)) && (substr_count("$ShoutComment","[b]") == substr_count("$ShoutComment","[/b]"))) {
                $ShoutComment = preg_replace("/\[b\]/i","<span style=\"font-weight: bold\">","$ShoutComment");
                $ShoutComment = preg_replace("/\[\/b\]/i","</span>","$ShoutComment");
            }
            if ((preg_match("/\[i\]/i", $ShoutComment)) && (preg_match("/\[\/i\]/i", $ShoutComment)) && (substr_count("$ShoutComment","[i]") == substr_count("$ShoutComment","[/i]"))) {
                $ShoutComment = preg_replace("/\[i\]/i","<span style=\"font-style: italic\">","$ShoutComment");
                $ShoutComment = preg_replace("/\[\/i\]/i","</span>","$ShoutComment");
            }
            if ((preg_match("/\[u\]/i", $ShoutComment)) && (preg_match("/\[\/u\]/i", $ShoutComment)) && (substr_count("$ShoutComment","[u]") == substr_count("$ShoutComment","[/u]"))) {
                $ShoutComment = preg_replace("/\[u\]/i","<span style=\"text-decoration: underline\">","$ShoutComment");
                $ShoutComment = preg_replace("/\[\/u\]/i","</span>","$ShoutComment");
            }

            if ($username == 'Anonymous') {
    /*****[BEGIN]******************************************
     [ Mod:    Advanced Username Color             v1.0.5 ]
     ******************************************************/
                $tempContent[$i] .= "<strong>" . UsernameColor($row['name']) . ":</strong> $ShoutComment";
    /*****[END]********************************************
     [ Mod:    Advanced Username Color             v1.0.5 ]
     ******************************************************/
            }
            else {
                // check to see if nickname is a user in the DB
                $sqlN = "SELECT * FROM `".$prefix."_users` WHERE `username`='".$row['name']."'";
                $nameresultN = $db->sql_query($sqlN);
                $rowN = $db->sql_fetchrow($nameresultN);
                $db->sql_freeresult($nameresultN);
                if ($rowN && ($row['name'] != "Anonymous")) {
    /*****[BEGIN]******************************************
     [ Mod:    Advanced Username Color             v1.0.5 ]
     ******************************************************/
                    $tempContent[$i] .= "<strong><a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$row[name]\">" . UsernameColor($row['name']) . "</a>:</strong> $ShoutComment";
    /*****[END]********************************************
     [ Mod:    Advanced Username Color             v1.0.5 ]
     ******************************************************/
                } else {
                    $tempContent[$i] .= "<strong>".$row['name'].":</strong> $ShoutComment";
                }
            }
            if ($conf['date']== 'yes') {
                if (!empty($row['timestamp'])) {
                    // reads unix timestamp && formats it to the viewer's timezone
                    if ($is_user) {
                        $unixTime = EvoDate($userinfo['user_dateformat'], $row['timestamp'], $userinfo['user_timezone']);
                        $tempContent[$i] .= "<br />$unixTime";
                    } else {
                        $unixTime = EvoDate($board_config['default_dateformat'], $row['timestamp'], $board_config['board_timezone']);
                        $tempContent[$i] .= "<br />$unixTime";
                    }
                } else {
                    $tempContent[$i] .= "<br />".$row['date']."&nbsp;".$row['time'];
                }
            }
            $tempContent[$i] .= "</td></tr>";
            if ($flag == 1) { $flag = 2; }
            elseif ($flag == 2) { $flag = 1; }
            $i++;
        }
        // Reversing the posts
        if ($conf['reversePosts'] == 'no') {
            for ($j = 0; $j < $conf['number']; $j++) {
                if (isset($tempContent[$j]) && !empty($tempContent[$j])) {
                    $mid_content .= $tempContent[$j];
                }
            }
        } else {
            for ($j = $conf['number']; $j >= 0; $j = $j - 1) {
                if (isset($tempContent[$j]) && !empty($tempContent[$j])) {
                    $mid_content .= $tempContent[$j];
                }
            }
        }
        // You may not remove or edit this copyright!!! Doing so violates the GPL license.
        $mid_content .= "<tr><td align=\"right\"><a title=\"Free scripts!\" target=\"_blank\" href=\"http://www.ourscripts.net\"><span style=\"font-size: 9;\">Shout Box &copy;</span></a></td></tr></table>";
        // end copyright.
        // end mid content
        // start bottom content $bottom_content

        $bottom_content = "</td></tr></table>\n";
		
        // bottom half
		$bottom_content .= "<form name=\"shoutform1\" method=\"post\" action=\"modules.php?name=Your_Account\" style=\"margin-bottom: 0px; margin-top: 0px\" id=\"shoutform1\">";
		
        if ($conf['anonymouspost'] == 'no' && $username == 'Anonymous') {
            $bottom_content .= "<div style=\"padding: 1px;\" align=\"center\" class=\"content\"><a href=\"modules.php?name=Shout_Box\">"._SHOUTHISTORY."</a>";
            $bottom_content .= "&nbsp;<span style=\"cursor: pointer;\" onmouseover=\"SBspeed=4\" onmouseout=\"SBspeed=1\"><img src=\"$up_img\" border=\"0\" alt=\"\" width=\"9\" height=\"5\" /></span>";
            $bottom_content .= "&nbsp;<span style=\"cursor: pointer;\" onmouseover=\"SBspeed=1-5\" onmouseout=\"SBspeed=1\"><img src=\"$down_img\" border=\"0\" alt=\"\" width=\"9\" height=\"5\" /></span>";
            $bottom_content .= "&nbsp;<span style=\"cursor: wait;\" onmouseover=\"SBspeed=0\" onmouseout=\"SBspeed=1\"><img src=\"$pause_img\" border=\"0\" alt=\"\" width=\"9\" height=\"5\" /></span>";
            $bottom_content .= "</div><div style=\"padding: 1px; text-align: center;\" class=\"content\"><br />"._ONLYREGISTERED." <a href=\"modules.php?name=Your_Account\">"._SHOUTLOGIN."</a> "._OR." <a href=\"modules.php?name=Your_Account&amp;op=new_user\">"._CREATEANACCT."</a>.</div>";
        } else {
            $bottom_content .= "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
            $bottom_content .= "    <tr>";
            $bottom_content .= "        <td align=\"center\"" . (($SBpos == 'center') ? " colspan=\"" . (($conf['anonymouspost']== 'yes' && $username == 'Anonymous') ? '3' : '2') . "\" style=\"padding: 5px 0;\"" : '') . ">";
            $bottom_content .= "            <a href=\"modules.php?name=Shout_Box\">"._SHOUTHISTORY."</a>";
            $bottom_content .= "            <span style=\"cursor: pointer;\" onmouseover=\"SBspeed=4\" onmouseout=\"SBspeed=1\"><img src=\"$up_img\" border=\"0\" alt=\"\" width=\"9\" height=\"5\" /></span>";
            $bottom_content .= "            <span style=\"cursor: pointer;\" onmouseover=\"SBspeed=1-5\" onmouseout=\"SBspeed=1\"><img src=\"$down_img\" border=\"0\" alt=\"\" width=\"9\" height=\"5\" /></span>";
            $bottom_content .= "            <span style=\"cursor: wait;\" onmouseover=\"SBspeed=0\" onmouseout=\"SBspeed=1\"><img src=\"$pause_img\" border=\"0\" alt=\"\" width=\"9\" height=\"5\" /></span>";
            $bottom_content .= "        </td>";
            $bottom_content .= "    </tr>\n";
			
            // Start smilie Drop-Down Code
            $messageDefinition = _SB_MESSAGE;

            if (preg_match("/MSIE(.*)/i", $_SERVER['HTTP_USER_AGENT']) || preg_match("/Konqueror\/3(.*)/i", $_SERVER['HTTP_USER_AGENT']) || (preg_match("/Opera(.*)/i", $_SERVER['HTTP_USER_AGENT']))) {
                $ShoutNameWidth = $conf['textWidth'];
                $ShoutTextWidth = $conf['textWidth'];
            } else {
                // Firefox, Mozilla, NS, && any others.
                $ShoutNameWidth = $conf['textWidth'] - 4;
                $ShoutTextWidth = $conf['textWidth'] - 4;
            }
			
            if ($conf['anonymouspost']== 'yes' && $username == 'Anonymous') {
                if ($PreviousUsername) { $boxtext = $PreviousUsername; } else { $boxtext = _NAME; }
                
				if ($SBpos == 'center') {
					$bottom_content .= "<td align=\"center\" width=\"130\" valign=\"top\" style=\"padding-right: 10px;\"><input type=\"text\" name=\"shoutuid\" id=\"shoutuid\" size=\"$ShoutNameWidth\" value=\"$boxtext\" maxlength=\"25\" onfocus=\"if ( this.value == '"._NAME."' ) { this.value=''; }\" onblur=\"if (this.value == '') { this.value='"._NAME."' }\" style=\"width: 100%;\" /></td>\n";
				} else {
					$bottom_content .= "<tr><td align=\"center\"><input type=\"text\" name=\"shoutuid\" id=\"shoutuid\" size=\"$ShoutNameWidth\" value=\"$boxtext\" maxlength=\"25\" onfocus=\"if ( this.value == '"._NAME."' ) { this.value=''; }\" onblur=\"if (this.value == '') { this.value='"._NAME."' }\" /></td></tr>\n";
				}
            }
			
            if (!empty($PreviousComment)) { $boxtext = $PreviousComment; } else { $boxtext = _SB_MESSAGE; }
			
			if ($SBpos == 'center') {
				$bottom_content .= "<td align=\"left\" nowrap=\"nowrap\" valign=\"top\">";
				$bottom_content .= "    <input type=\"text\" name=\"ShoutComment\" id=\"ShoutComment\" size=\"$ShoutTextWidth\" onKeyPress=\"return OnEnter(event)\" value=\"$boxtext\" maxlength=\"2500\" onfocus=\"if ( this.value == '"._SB_MESSAGE."' ) { this.value=''; }\" onblur=\"if (this.value == '') { this.value='"._SB_MESSAGE."' }\" style=\"width: 100%;\" />";
				$bottom_content .= "</td>";
				$bottom_content .= "<td align=\"right\" width=\"140\">";
				$bottom_content .= "    <input type=\"hidden\" name=\"ShoutSubmit\" id=\"ShoutSubmit\" value=\"ShoutPost\" />";
				$bottom_content .= "    <div id=\"smilies_hide\" style=\"display: block;\">";
				$bottom_content .= "        <div class=\"content\">";
				$bottom_content .= "            <input type=\"button\" name=\"button\" onclick=\"AjaxShout();\" value=\""._SHOUT."\" />";
				$bottom_content .= "            <span onclick=\"changeBoxSize('show'); return false;\"><input type=\"button\" value=\""._SMILIES."\" /></span>";
				$bottom_content .= "        </div>";
				$bottom_content .= "    </div>";
				$bottom_content .= "    <div id=\"smilies_show\" style=\"display: none;\">";
				$bottom_content .= "        <div class=\"content\">";
				$bottom_content .= "            <input type=\"button\" name=\"button\" onclick=\"AjaxShout();\" value=\""._SHOUT."\" />";
				$bottom_content .= "            <span onclick=\"changeBoxSize ('hide'); return false;\"><input type=\"button\" value=\""._SMILIES."\" /></span>";
				$bottom_content .= "            <br /><br />";
			} else {
				$bottom_content .= "<tr>";
				$bottom_content .= "    <td align=\"center\" nowrap=\"nowrap\">";
				$bottom_content .= "        <input type=\"text\" name=\"ShoutComment\" id=\"ShoutComment\" size=\"$ShoutTextWidth\" onKeyPress=\"return OnEnter(event)\" value=\"$boxtext\" maxlength=\"2500\" onfocus=\"if ( this.value == '"._SB_MESSAGE."' ) { this.value=''; }\" onblur=\"if (this.value == '') { this.value='"._SB_MESSAGE."' }\" />";
				$bottom_content .= "    </td>";
				$bottom_content .= "</tr>";
				$bottom_content .= "<tr>";
				$bottom_content .= "    <td align=\"center\">";
				$bottom_content .= "        <input type=\"hidden\" name=\"ShoutSubmit\" id=\"ShoutSubmit\" value=\"ShoutPost\" />";
				$bottom_content .= "        <div id=\"smilies_hide\" style=\"display: block;\">";
				$bottom_content .= "            <div class=\"content\">";
				$bottom_content .= "                <input type=\"button\" name=\"button\" onclick=\"AjaxShout();\" value=\""._SHOUT."\" />";
				$bottom_content .= "                <span onclick=\"changeBoxSize('show'); return false;\"><input type=\"button\" value=\""._SMILIES."\" /></span>";
				$bottom_content .= "            </div>";
				$bottom_content .= "        </div>";
				$bottom_content .= "        <div id=\"smilies_show\" style=\"display: none;\">";
				$bottom_content .= "            <div class=\"content\">";
				$bottom_content .= "                <input type=\"button\" name=\"button\" onclick=\"AjaxShout();\" value=\""._SHOUT."\" />";
				$bottom_content .= "                <span onclick=\"changeBoxSize ('hide'); return false;\"><input type=\"button\" value=\""._SMILIES."\" /></span>";
				$bottom_content .= "                <br /><br />";
			}

            $sql = "SELECT distinct image FROM `".$prefix."_shoutbox_emoticons`";
            $nameresult1 = $db->sql_query($sql);
            $flag = 1;
            while ($return = $db->sql_fetchrow($nameresult1)) {
                $sql = "SELECT * FROM `".$prefix."_shoutbox_emoticons` WHERE `image`='$return[0]' LIMIT 1";
                $nameresult = $db->sql_query($sql);
                while ($emoticons = $db->sql_fetchrow($nameresult)) {
                    $emoticons[3] = str_replace('>', '', $emoticons['image']);
                    $emoticons[3] = str_replace('src=', 'src="', $emoticons[3]);
                    $bottom_content .= "<span style=\"cursor: pointer;\" onclick=\"DoSmilie(' $emoticons[text] ','$messageDefinition');\">$emoticons[3]\" border=\"0\" alt=\"\" /></span>&nbsp;";
                    if ($flag == $conf['smiliesPerRow']) {
                        $bottom_content .="<br /><br />\n";
                        $flag = 1;
                        continue;
                    }
                    $flag++;
                }
                $db->sql_freeresult($nameresult);
            }
            $db->sql_freeresult($nameresult1);
            $bottom_content .= "</div></div></td></tr>\n";

            $bottom_content .= "</table></form>\n";
        }

    } else {
        $top_content = "<p class=\"title\" align=\"center\"><strong>";
        $mid_content = _YOUAREBANNED;
        $bottom_content = "</strong></p>";
    }

    $ShoutMarqueeheight = $conf['height'];

}

global $HTTP_POST_VARS, $HTTP_GET_VARS, $json, $top_out, $mid_content;

$ShoutComment = (isset($HTTP_POST_VARS['ShoutComment'])) ? $HTTP_POST_VARS['ShoutComment'] : '';
$ShoutSubmit = (isset($HTTP_POST_VARS['ShoutSubmit'])) ? $HTTP_POST_VARS['ShoutSubmit'] : '';
$shoutuid = (isset($HTTP_POST_VARS['shoutuid'])) ? $HTTP_POST_VARS['shoutuid'] : '';

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	if (isset($HTTP_POST_VARS['shoutbox_action']) && !empty($HTTP_POST_VARS['shoutbox_action'])) { 
		switch($HTTP_POST_VARS['shoutbox_action']) {
			case 'post_shout':
				$ShoutComment = (isset($HTTP_POST_VARS['ShoutComment'])) ? base64_decode($HTTP_POST_VARS['ShoutComment']) : '';
				$ShoutSubmit = (isset($HTTP_POST_VARS['ShoutSubmit'])) ? $HTTP_POST_VARS['ShoutSubmit'] : '';
				$shoutuid = (isset($HTTP_POST_VARS['shoutuid'])) ? $HTTP_POST_VARS['shoutuid'] : '';
				ShoutBox($ShoutSubmit,$ShoutComment,$shoutuid);
				$value = array('disable' => false, 'top' => $top_out, 'mid' => $mid_content);
				echo $json->encode($value);
			break;
			
			case 'refresh_shouts':
				$ShoutComment = (isset($HTTP_POST_VARS['ShoutComment'])) ? base64_decode($HTTP_POST_VARS['ShoutComment']) : '';
				$ShoutSubmit = (isset($HTTP_POST_VARS['ShoutSubmit'])) ? $HTTP_POST_VARS['ShoutSubmit'] : '';
				$shoutuid = (isset($HTTP_POST_VARS['shoutuid'])) ? $HTTP_POST_VARS['shoutuid'] : '';
				ShoutBox($ShoutSubmit,$ShoutComment,$shoutuid);
				$value = array('disable' => false, 'top' => $top_out, 'mid' => $mid_content);
				echo $json->encode($value);
			break;
		}
		
		exit;
	}
}

?>