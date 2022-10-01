 Table structure for table 'titanium_bbarcade' 
#

CREATE TABLE titanium_bbarcade (
   arcade_name varchar(255) NOT NULL,
   arcade_value varchar(255) NOT NULL,
   PRIMARY KEY (arcade_name)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

#
# Dumping data for table 'titanium_bbarcade'
#

INSERT INTO titanium_bbarcade VALUES ('arcade_announcement', 'Welcome to the Arcade!<br>Enjoy!');
INSERT INTO titanium_bbarcade VALUES ('use_category_mod', '1');
INSERT INTO titanium_bbarcade VALUES ('category_preview_games', '5');
INSERT INTO titanium_bbarcade VALUES ('games_par_page', '15');
INSERT INTO titanium_bbarcade VALUES ('game_order', 'Alpha');
INSERT INTO titanium_bbarcade VALUES ('display_winner_avatar', '1');
INSERT INTO titanium_bbarcade VALUES ('stat_par_page', '10');
INSERT INTO titanium_bbarcade VALUES ('winner_avatar_position', 'left');
INSERT INTO titanium_bbarcade VALUES ('maxsize_avatar', '200');
INSERT INTO titanium_bbarcade VALUES ('linkcat_align', '2');
INSERT INTO titanium_bbarcade VALUES ('limit_by_posts', '0');
INSERT INTO titanium_bbarcade VALUES ('posts_needed', '5');
INSERT INTO titanium_bbarcade VALUES ('days_limit', '5');
INSERT INTO titanium_bbarcade VALUES ('limit_type', 'date');
INSERT INTO titanium_bbarcade VALUES ('use_fav_category', '0');

# Table structure for table 'titanium_bbarcade_categories'
#

CREATE TABLE titanium_bbarcade_categories (
   arcade_catid mediumint(8) unsigned NOT NULL auto_increment,
   arcade_cattitle varchar(100) NOT NULL,
   arcade_nbelmt mediumint(8) unsigned DEFAULT '0' NOT NULL,
   arcade_catorder mediumint(8) unsigned DEFAULT '0' NOT NULL,
   arcade_catauth tinyint(2) DEFAULT '0' NOT NULL,
   KEY arcade_catid (arcade_catid)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

#
# Dumping data for table 'titanium_bbarcade_categories'
#

INSERT INTO titanium_bbarcade_categories VALUES ('1', 'Arcade', '8', '1', '0');
INSERT INTO titanium_bbarcade_categories VALUES ('2', 'Shooting', '25', '11', '0');
INSERT INTO titanium_bbarcade_categories VALUES ('3', 'W T F Games', '19', '21', '0');
INSERT INTO titanium_bbarcade_categories VALUES ('4', 'Racing', '12', '31', '0');
INSERT INTO titanium_bbarcade_categories VALUES ('5', 'Flight Games', '11', '41', '0');
INSERT INTO titanium_bbarcade_categories VALUES ('6', 'Stratagey', '27', '51', '0');
INSERT INTO titanium_bbarcade_categories VALUES ('7', 'Card Games', '4', '61', '0');
INSERT INTO titanium_bbarcade_categories VALUES ('8', 'Casino Games', '6', '71', '0');
INSERT INTO titanium_bbarcade_categories VALUES ('10', 'Adult 18+', '15', '91', '0');
INSERT INTO titanium_bbarcade_categories VALUES ('12', 'Yeti Sports', '15', '111', '0');

# --------------------------------------------------------
#
# Table structure for table 'titanium_bbarcade_comments'
#

CREATE TABLE titanium_bbarcade_comments (
   game_id mediumint(8) DEFAULT '0' NOT NULL,
   comments_value varchar(255) NOT NULL
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

#
# Dumping data for table 'titanium_bbarcade_comments'


# --------------------------------------------------------
#
# Table structure for table 'titanium_bbauth_arcade_access'
#

CREATE TABLE titanium_bbauth_arcade_access (
   group_id mediumint(8) DEFAULT '0' NOT NULL,
   arcade_catid mediumint(8) unsigned DEFAULT '0' NOT NULL,
   KEY group_id (group_id),
   KEY arcade_catid (arcade_catid)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

#
# Dumping data for table 'titanium_bbauth_arcade_access'

# --------------------------------------------------------

# Table structure for table 'titanium_bbgamehash'
#

CREATE TABLE titanium_bbgamehash (
   gamehash_id char(32) NOT NULL,
   game_id mediumint(8) DEFAULT '0' NOT NULL,
   user_id mediumint(8) DEFAULT '0' NOT NULL,
   hash_date int(11) DEFAULT '0' NOT NULL
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

#
# Dumping data for table 'titanium_bbgamehash'

# --------------------------------------------------------

#
# Table structure for table 'titanium_bbgames'
#

CREATE TABLE titanium_bbgames (
   game_id mediumint(8) NOT NULL auto_increment,
   game_pic varchar(50) NOT NULL,
   game_desc varchar(255) NOT NULL,
   game_highscore int(11) DEFAULT '0' NOT NULL,
   game_highdate int(11) DEFAULT '0' NOT NULL,
   game_highuser mediumint(8) DEFAULT '0' NOT NULL,
   game_name varchar(50) NOT NULL,
   game_swf varchar(50) NOT NULL,
   game_scorevar varchar(20) NOT NULL,
   game_type tinyint(4) DEFAULT '0' NOT NULL,
   game_width mediumint(5) DEFAULT '550' NOT NULL,
   game_height varchar(5) DEFAULT '380' NOT NULL,
   game_order mediumint(8) DEFAULT '0' NOT NULL,
   game_set mediumint(8) DEFAULT '0' NOT NULL,
   arcade_catid mediumint(8) DEFAULT '1' NOT NULL,
   KEY game_id (game_id)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

#
# Dumping data for table 'titanium_bbgames'
#

INSERT INTO titanium_bbgames VALUES ('222', 'penguin2.gif', 'Whack the penguin as hard as you can!\'', '0', '0', '0', 'Penguin Bashing', 'penguin.swf', 'penguin', '3', '550', '380', '10', '0', '1');
INSERT INTO titanium_bbgames VALUES ('223', 'yeti1_5shots1.gif', 'you get 5 shaots to bash the Penguin as far as you can', '0', '0', '0', 'Penguin Bashing 5 shots', 'yeti1_5shots.swf', 'yeti1_5shots', '3', '550', '380', '50', '0', '1');
INSERT INTO titanium_bbgames VALUES ('8', '5carddraw1.gif', 'Beat the dealer in 5 card Draw', '0', '0', '0', '5 card draw', '5carddraw.swf', '5carddraw', '3', '550', '380', '70', '0', '1');
INSERT INTO titanium_bbgames VALUES ('1', 'mahjongg2.gif', 'Hmmm, match the Blocks', '0', '0', '0', 'mahjongsolitaire', 'mahjongg2.swf', 'mahjongg2', '5', '550', '380', '0', '0', '6');
INSERT INTO titanium_bbgames VALUES ('2', 'fastnfurious1.gif', 'Fast n Furious Racing', '0', '0', '0', 'Need for Speed Underground', 'fastnfurious.swf', 'fastnfurious', '3', '550', '380', '0', '0', '4');
INSERT INTO titanium_bbgames VALUES ('3', 'rally21001.gif', 'Rally Racing', '0', '0', '0', 'Rally2100', 'rally2100.swf', 'rally2100', '3', '550', '380', '0', '0', '4');
INSERT INTO titanium_bbgames VALUES ('5', 'simpsonsshooter1.gif', 'Kill the Simpson\'s', '0', '0', '0', 'Simpson Shoot Em', 'simpsonsshooter.swf', 'simpsonsshooter', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('6', 'spankthemonkey1.gif', 'Slap the shitniz outta the monkey, lol', '0', '0', '0', 'Slap The Monkey', 'spankthemonkey.swf', 'spankthemonkey', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('7', 'quickshot1.gif', 'See how fast and accurate you are..At hooping basket balls.', '0', '0', '0', 'Quick Shot', 'quickshot.swf', 'quickshot', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('224', 'sharpshooter1.gif', 'How sharp are you.....', '0', '0', '0', 'Sharp Shooter', 'sharpshooter.swf', 'sharpshooter', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('9', 'ninjaturtles21.gif', 'Throw stars, see how many you hit in a time limit..', '0', '0', '0', 'Ninja Turtles', 'ninjaturtles2.swf', 'ninjaturtles2', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('10', 'whatashot1.gif', 'See how Good you can shoot ball.', '0', '0', '0', 'What a Shot', 'whatashot.swf', 'whatashot', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('11', 'vbtetris1.gif', 'test you skill in the original tetris.', '0', '0', '0', 'Tetris', 'vbtetris.swf', 'vbtetris', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('12', 'streaker1.gif', 'See how many touch downs you can make, running around the field Butt Ass Naked, lol', '0', '0', '0', 'Streaker', 'streaker.swf', 'streaker', '3', '550', '380', '0', '0', '3');
INSERT INTO titanium_bbgames VALUES ('13', 'wot1.gif', 'See if you can bust their azz.', '0', '0', '0', 'War on Terror', 'wot.swf', 'wot', '3', '550', '380', '0', '0', '3');
INSERT INTO titanium_bbgames VALUES ('14', 'spermwars1.gif', 'Lmmfao, see if you can make it, lol', '0', '0', '0', 'Sperm Wars', 'spermwars.swf', 'spermwars', '3', '550', '380', '0', '0', '3');
INSERT INTO titanium_bbgames VALUES ('15', 'superfishing1.gif', 'Catch a Fish, Win a trophy.', '0', '0', '0', 'Super Fishing', 'superfishing.swf', 'superfishing', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('16', 'metalslug1.gif', 'Blow sum stuff up.', '0', '0', '0', 'Metal Slug', 'metalslug.swf', 'metalslug', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('17', 'missionmars1.gif', 'Level the city', '0', '0', '0', 'Mission Mars', 'missionmars.swf', 'missionmars', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('18', 'missilestrike1.gif', 'Detroy everything, before they detroy you', '0', '0', '0', 'Missle Strike', 'missilestrike.swf', 'missilestrike', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('19', 'pedestriankiller1.gif', 'See how many peeps you can run down in a small time limit.', '0', '0', '0', 'Pedestrian killer', 'pedestriankiller.swf', 'pedestriankiller', '3', '550', '380', '0', '0', '3');
INSERT INTO titanium_bbgames VALUES ('20', 'pinheadz1.gif', 'Bowlin.', '0', '0', '0', 'Pin Headz', 'pinheadz.swf', 'pinheadz', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('21', 'roachkill1.gif', 'Kill some bugs.', '0', '0', '0', 'Roach Kill', 'roachkill.swf', 'roachkill', '3', '550', '380', '0', '0', '3');
INSERT INTO titanium_bbgames VALUES ('22', 'shootthegatso1.gif', 'Shoot the what?', '0', '0', '0', 'Shoot the gatso', 'shootthegatso.swf', 'shootthegatso', '3', '550', '380', '0', '0', '3');
INSERT INTO titanium_bbgames VALUES ('24', 'pacman.gif', 'Original Pac Man', '0', '0', '0', 'Pac Man', 'pacman.swf', 'pacman', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('47', 'stripordie.gif', 'See how good your luck is.', '0', '0', '0', 'Strip or Die', 'stripordie.swf', 'stripordie', '3', '550', '380', '0', '0', '3');
INSERT INTO titanium_bbgames VALUES ('25', 'bombjack1.gif', 'bomb Jack', '0', '0', '0', 'Bomb Jack', 'bombjack.swf', 'bombjack', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('26', 'eggs1.gif', 'Catch all the eggs,if you can.', '0', '0', '0', 'Eggs', 'eggs.swf', 'eggs', '3', '550', '380', '0', '0', '3');
INSERT INTO titanium_bbgames VALUES ('27', 'castledefend1.gif', 'Defend your Castle, by picking them up and dropping them to their deaths.', '0', '0', '0', 'Castle Defense', 'castledefend.swf', 'castledefend', '3', '550', '380', '0', '0', '3');
INSERT INTO titanium_bbgames VALUES ('28', 'jailbreak1.gif', 'Shoot them jail breakers.', '0', '0', '0', 'Jail Break', 'jailbreak.swf', 'jailbreak', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('29', 'discoracer1.gif', 'Disco Racing, hmmm.', '0', '0', '0', 'Disco Racer', 'discoracer.swf', 'discoracer', '3', '550', '380', '0', '0', '4');
INSERT INTO titanium_bbgames VALUES ('30', 'dkongsm1.gif', 'Donkey Kong Jr.', '0', '0', '0', 'Donkey Kong Jr.', 'dkongsm.swf', 'dkongsm', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('31', 'enemyshooting1.gif', 'Another shooting skill game.', '0', '0', '0', 'Enemy Shoot', 'enemyshooting.swf', 'enemyshooting', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('32', 'gpchall21.gif', 'Grand prix challege', '0', '0', '0', 'Grand Prix', 'gpchall2.swf', 'gpchall2', '3', '550', '380', '0', '0', '4');
INSERT INTO titanium_bbgames VALUES ('160', '501darts.gif', '', '0', '0', '0', '501 Darts', '501darts.swf', '501darts', '5', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('161', 'alienattack1.gif', '', '0', '0', '0', 'Alein Attack', 'alienattack.swf', 'alienattack', '3', '550', '380', '0', '0', '5');
INSERT INTO titanium_bbgames VALUES ('34', 'killerbob1.gif', 'Killer bob shooting', '0', '0', '0', 'Killer Bob', 'killerbob.swf', 'killerbob', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('35', 'islandadventure1.gif', 'Dick\'s Island Aventure', '0', '0', '0', 'Dick\'s Quick', 'islandadventure.swf', 'islandadventure', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('36', 'cutiequake1.gif', 'Shoot these lil freaks', '0', '0', '0', 'Cutie Quake', 'cutiequake.swf', 'cutiequake', '3', '550', '380', '0', '0', '3');
INSERT INTO titanium_bbgames VALUES ('37', 'desertbattle1.gif', 'Navigate thru the desert with out being shot down.', '0', '0', '0', 'Desert Battle', 'desertbattle.swf', 'desertbattle', '3', '550', '380', '0', '0', '5');
INSERT INTO titanium_bbgames VALUES ('38', 'homerun1.gif', 'See if you can get this drunk a@# mofo home...', '0', '0', '0', 'Home Run', 'homerun.swf', 'homerun', '3', '550', '380', '0', '0', '3');
INSERT INTO titanium_bbgames VALUES ('39', 'graveyard1.gif', 'Shoot the zombis\'s, Before the get you...', '0', '0', '0', 'Grave Yard', 'graveyard.swf', 'graveyard', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('40', 'frogger21.gif', 'The all time original Frogger, for us old school folks...', '0', '0', '0', 'Frogger', 'frogger2.swf', 'frogger2', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('41', 'kegstand1.gif', 'Stay baleance on a Beer Keg..', '0', '0', '0', 'Keg Stand', 'kegstand.swf', 'kegstand', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('42', 'gwb1.gif', 'George wants a Beer..', '0', '0', '0', 'Wants Beer', 'gwb.swf', 'gwb', '3', '550', '380', '0', '0', '3');
INSERT INTO titanium_bbgames VALUES ('43', 'lanebowling1.gif', 'Another Bowling game.', '0', '0', '0', 'Lane Bowling', 'lanebowling.swf', 'lanebowling', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('44', 'asshunter.gif', 'Kill them before they get you, lol', '0', '0', '0', 'Ass Hunter', 'asshunter.swf', 'asshunter', '3', '550', '380', '0', '0', '10');
INSERT INTO titanium_bbgames VALUES ('45', 'shieldshot.gif', 'Accurany Shooting game.', '0', '0', '0', 'Shield Shot', 'shieldshot.swf', 'shieldshot', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('46', 'duckhunt.gif', 'The original Mario\'s Duck Hunt.', '0', '0', '0', 'Duck Hunt', 'duckhunt.swf', 'duckhunt', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('48', 'airfox.gif', 'Flight', '0', '0', '0', 'Air Fox', 'airfox.swf', 'airfox', '3', '550', '380', '0', '0', '5');
INSERT INTO titanium_bbgames VALUES ('49', 'plasticsaucer.gif', 'Navigate threw tunnels on trenches', '0', '0', '0', 'Plastic Saucer', 'plasticsaucer.swf', 'plasticsaucer', '3', '550', '380', '0', '0', '5');
INSERT INTO titanium_bbgames VALUES ('50', 'aim.gif', 'Shoot as many as you can of the specified targets', '0', '0', '0', 'AIM', 'aim.swf', 'aim', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('51', 'marbles1.gif', 'Collect all your marbles.', '0', '0', '0', 'Lost Your Marbles?', 'marbles.swf', 'marbles', '3', '550', '380', '0', '0', '6');
INSERT INTO titanium_bbgames VALUES ('52', 'kittenshooting1.gif', 'Shoot clay kitten targets, lol', '0', '0', '0', 'Kitten Shooting', 'kittenshooting.swf', 'kittenshooting', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('53', 'gunman1.gif', '', '0', '0', '0', 'Gun Man', 'gunman.swf', 'gunman', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('54', 'juggler1.gif', 'See how long you can keep the ball off the ground.', '0', '0', '0', 'Juggler', 'juggler.swf', 'juggler', '3', '550', '380', '0', '0', '6');
INSERT INTO titanium_bbgames VALUES ('55', 'fishy.gif', 'Eat smaller fish to grow to eat bigger fish', '0', '0', '0', 'Fishy', 'fishy.swf', 'fishy', '3', '550', '380', '0', '0', '6');
INSERT INTO titanium_bbgames VALUES ('171', 'cellout1.gif', 'Cure the Patient', '0', '0', '0', 'CellOut', 'cellout.swf', 'cellout', '3', '550', '380', '0', '0', '6');
INSERT INTO titanium_bbgames VALUES ('57', '3cardpoker1.gif', 'Poker game', '0', '0', '0', '3 Card Poker', '3cardpoker.swf', '3cardpoker', '3', '550', '380', '0', '0', '7');
INSERT INTO titanium_bbgames VALUES ('58', 'bjfever1.gif', 'Black Jack', '0', '0', '0', 'Black Jack Fever', 'bjfever.swf', 'bjfever', '3', '550', '380', '0', '0', '7');
INSERT INTO titanium_bbgames VALUES ('59', '5milestogo1.gif', 'Nascar cup car, somewhat, lol', '0', '0', '0', '5 Miles To Go', '5milestogo.swf', '5milestogo', '3', '550', '380', '0', '0', '4');
INSERT INTO titanium_bbgames VALUES ('60', 'cardriver1.gif', 'Collect money racing in 3D.', '0', '0', '0', '3D Car Driver', 'cardriver.swf', 'cardriver', '3', '550', '380', '0', '0', '4');
INSERT INTO titanium_bbgames VALUES ('61', 'bowling_tgfg1.gif', 'Another Bowling game.', '0', '0', '0', 'Bowling', 'bowling_tgfg.swf', 'bowling_tgfg', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('62', 'catapult1.gif', 'Something to do with slingshotting cats, lol.', '0', '0', '0', 'Cat-A-Pult', 'catapult.swf', 'catapult', '3', '550', '380', '0', '0', '3');
INSERT INTO titanium_bbgames VALUES ('63', 'canyonglider1.gif', 'Hang glide threw the canyons.', '0', '0', '0', 'Canyon Glider', 'canyonglider.swf', 'canyonglider', '3', '550', '380', '0', '0', '5');
INSERT INTO titanium_bbgames VALUES ('64', 'asteroids20001.gif', 'Blow up asteriods before they crash you.', '0', '0', '0', 'Asteriods 2000', 'asteroids2000.swf', 'asteroids2000', '3', '550', '380', '0', '0', '5');
INSERT INTO titanium_bbgames VALUES ('65', 'bmxtricks1.gif', 'Score points by succeeded tricks.', '0', '0', '0', 'BMX Trick Riding', 'bmxtricks.swf', 'bmxtricks', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('66', 'beermat1.gif', 'You figure it out....', '0', '0', '0', 'Beer Mat', 'beermat.swf', 'beermat', '3', '550', '380', '0', '0', '3');
INSERT INTO titanium_bbgames VALUES ('67', 'basketballrally1.gif', 'Shoot some hoops.', '0', '0', '0', 'BasketBall Rally', 'basketballrally.swf', 'basketballrally', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('68', 'alienterminator1.gif', 'Destroy the aliens, before the destroy earth.', '0', '0', '0', 'Alien Teminator', 'alienterminator.swf', 'alienterminator', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('69', 'batandmouse21.gif', 'your the mouse, now survive..', '0', '0', '0', 'Bat and Muose', 'batandmouse2.swf', 'batandmouse2', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('70', 'ants1.gif', '', '0', '0', '0', 'Ants', 'ants.swf', 'ants', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('71', 'tieshooter1.gif', 'Stars wars simulation.', '0', '0', '0', 'TIE Shooter', 'tieshooter.swf', 'tieshooter', '3', '550', '380', '0', '0', '5');
INSERT INTO titanium_bbgames VALUES ('72', 'crazyblockbreaker1.gif', '', '0', '0', '0', 'Crazy Block Brecker', 'crazyblockbreaker.swf', 'crazyblockbreaker', '3', '550', '380', '0', '0', '6');
INSERT INTO titanium_bbgames VALUES ('73', 'bubbles1.gif', '', '0', '0', '0', 'Bubbles', 'bubbles.swf', 'bubbles', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('74', 'ctdcurling1.gif', 'See how close you can get to the point..', '0', '0', '0', 'CTD Curling', 'ctdcurling.swf', 'ctdcurling', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('75', 'radialsnake1.gif', 'See how long you can last, while eating the food pellets.', '0', '0', '0', 'Radial Snake', 'radialsnake.swf', 'radialsnake', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('76', 'magicball1.gif', 'line up the balls, score points.', '0', '0', '0', 'Magic Ball', 'magicball.swf', 'magicball', '3', '550', '380', '0', '0', '6');
INSERT INTO titanium_bbgames VALUES ('77', 'parachutepanic1.gif', 'Rescue parachuters from the sharks.', '0', '0', '0', 'Parachute Panic', 'parachutepanic.swf', 'parachutepanic', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('78', 'smacktherabbit1.gif', 'Get as many as you can...', '0', '0', '0', 'Smack the Rabbits', 'smacktherabbit.swf', 'smacktherabbit', '3', '550', '380', '0', '0', '3');
INSERT INTO titanium_bbgames VALUES ('79', 'target1.gif', 'another shooting game', '0', '0', '0', 'Target shooting', 'target.swf', 'target', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('80', 'roulette1.gif', 'Play you luck on thr roulette table', '0', '0', '0', 'Roulette', 'roulette.swf', 'roulette', '3', '550', '380', '0', '0', '8');
INSERT INTO titanium_bbgames VALUES ('81', 'ssl1.gif', '', '0', '0', '0', 'StarShip Legend', 'ssl.swf', 'ssl', '3', '550', '380', '0', '0', '5');
INSERT INTO titanium_bbgames VALUES ('82', 'dragrace1.gif', 'test your times down the strip.', '0', '0', '0', 'Drag race', 'dragrace.swf', 'dragrace', '3', '550', '380', '0', '0', '4');
INSERT INTO titanium_bbgames VALUES ('83', 'spacerunner1.gif', 'Obsitical course', '0', '0', '0', 'Space Runner', 'spacerunner.swf', 'spacerunner', '3', '550', '380', '0', '0', '6');
INSERT INTO titanium_bbgames VALUES ('84', 'virus21.gif', '', '0', '0', '0', 'Virus', 'virus2.swf', 'virus2', '3', '550', '380', '0', '0', '6');
INSERT INTO titanium_bbgames VALUES ('85', 'mariomushroom1.gif', 'Mario\'s Mushroom', '0', '0', '0', 'Mario Bros.', 'mariomushroom.swf', 'mariomushroom', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('87', 'macman1.gif', 'LOL, Don\'t die to son...', '0', '0', '0', 'Mac Man', 'macman.swf', 'macman', '3', '550', '380', '0', '0', '3');
INSERT INTO titanium_bbgames VALUES ('91', 'ronnorthjewels1.gif', 'Orginal Jewel\'s', '0', '0', '0', 'Ron North\'s Jewels', 'ronnorthjewels.swf', 'ronnorthjewels', '3', '550', '380', '0', '0', '6');
INSERT INTO titanium_bbgames VALUES ('89', 'itsmine1.gif', 'Catch as many Jewels as you can.', '0', '0', '0', 'It\'s Mine', 'itsmine.swf', 'itsmine', '3', '550', '380', '0', '0', '6');
INSERT INTO titanium_bbgames VALUES ('90', 'karts1.gif', 'Drive Karts without crashing.', '0', '0', '0', 'Kart Racing', 'karts.swf', 'karts', '3', '550', '380', '0', '0', '4');
INSERT INTO titanium_bbgames VALUES ('92', 'mspacman1.gif', 'Arcade Original.', '0', '0', '0', 'Ms Pac Man', 'mspacman.swf', 'mspacman', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('93', 'shootout1.gif', 'Wild West ShootOut', '0', '0', '0', 'Shoot Out', 'shootout.swf', 'shootout', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('96', 'maptest1.gif', 'See if you should have realy Graduated', '0', '0', '0', 'Map Test', 'maptest.swf', 'maptest', '3', '550', '380', '0', '0', '6');
INSERT INTO titanium_bbgames VALUES ('97', 'seafishing1.gif', 'Meet the Quata, Move to the next round..', '0', '0', '0', 'Sea Fishing', 'seafishing.swf', 'seafishing', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('98', 'boogerflick1.gif', 'Flick some Boogers at some Flys, lmao', '0', '0', '0', 'Booger Flick', 'boogerflick.swf', 'boogerflick', '3', '550', '380', '0', '0', '3');
INSERT INTO titanium_bbgames VALUES ('99', 'flashpoker1.gif', 'Poker Card Game', '0', '0', '0', 'Flash Poker', 'flashpoker.swf', 'flashpoker', '3', '550', '380', '0', '0', '7');
INSERT INTO titanium_bbgames VALUES ('100', 'ducktracker1.gif', 'Hunt some Ducks', '0', '0', '0', 'Duck Tracker', 'ducktracker.swf', 'ducktracker', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('101', 'kickups1.gif', 'Keep the ball in the air as long as you can..', '0', '0', '0', 'Kick Up', 'kickups.swf', 'kickups', '3', '550', '380', '0', '0', '6');
INSERT INTO titanium_bbgames VALUES ('102', 'solitaire1.gif', 'Card Game', '0', '0', '0', 'Solitaire', 'solitaire.swf', 'solitaire', '3', '550', '380', '0', '0', '7');
INSERT INTO titanium_bbgames VALUES ('103', 'paintball1.gif', 'Shoot the Smileys...', '0', '0', '0', 'Paintball Shoot', 'paintball.swf', 'paintball', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('104', 'makaigrandprix21.gif', 'Grand Prix Racing..', '0', '0', '0', 'Makai Grand Prix2', 'makaigrandprix2.swf', 'makaigrandprix2', '3', '550', '380', '0', '0', '4');
INSERT INTO titanium_bbgames VALUES ('105', 'mariocatcher1.gif', 'Catch the Mario\'s as they fall...', '0', '0', '0', 'Mario Catcher', 'mariocatcher.swf', 'mariocatcher', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('106', 'rocketmx1.gif', 'MX riding. perform stunts..', '0', '0', '0', 'Rockett MX', 'rocketmx.swf', 'rocketmx', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('107', 'yeti1_5shots1.gif', 'Batter up...', '0', '0', '0', 'Yeti 5 Shot', 'yeti1_5shots.swf', 'yeti1_5shots', '3', '550', '380', '0', '0', '12');
INSERT INTO titanium_bbgames VALUES ('108', 'bloodypingu1.gif', 'see how for you can bat his head, lol....', '0', '0', '0', 'Bloody Peigiun', 'bloodypingu.swf', 'bloodypingu', '3', '550', '380', '0', '0', '12');
INSERT INTO titanium_bbgames VALUES ('110', 'stripdown1.gif', 'Click on 3 of the same color blocks, to reveal the babe! Half-Naked to nude to really nude!', '0', '0', '0', 'Strip Down', 'stripdown.swf', 'stripdown', '5', '550', '380', '0', '0', '10');
INSERT INTO titanium_bbgames VALUES ('111', 'pilsstrip1.gif', 'Catch the bottles to see the naked ladies.', '0', '0', '0', 'PilsStrip', 'pilsstrip.swf', 'pilsstrip', '5', '550', '380', '0', '0', '10');
INSERT INTO titanium_bbgames VALUES ('112', 'brasize1.gif', '100 Celebs, Guess thier Bra Sizes..', '0', '0', '0', 'Bra Size', 'brasize.swf', 'brasize', '3', '550', '380', '0', '0', '10');
INSERT INTO titanium_bbgames VALUES ('113', 'million21.gif', 'See if you are smart enough for the million..', '0', '0', '0', 'Who Wants To Be A Millionaire?', 'million2.swf', 'million2', '5', '550', '380', '0', '0', '6');
INSERT INTO titanium_bbgames VALUES ('157', 'bloodysealpp1.gif', '', '0', '0', '0', 'BloodySeal Bounce', 'bloodysealpp.swf', 'bloodysealpp', '4', '550', '380', '0', '0', '12');
INSERT INTO titanium_bbgames VALUES ('158', 'bloodyorcaspp2.gif', '', '0', '0', '0', 'Bloody Orca Slap', 'bloodyorcaspp.swf', 'bloodyorcaspp', '4', '550', '380', '0', '0', '12');
INSERT INTO titanium_bbgames VALUES ('115', 'MS.bmp', 'Collect money for...', '0', '0', '0', 'Money Strip', 'MoneyStrip.swf', 'MoneyStrip', '5', '550', '380', '0', '0', '10');
INSERT INTO titanium_bbgames VALUES ('116', '7upPinball1.gif', '', '0', '0', '0', '7UP PinBall', '7upPinball.swf', '7upPinball', '5', '550', '380', '0', '0', '12');
INSERT INTO titanium_bbgames VALUES ('117', 'hotrodpin1.gif', '', '0', '0', '0', 'HotRod PinBall', 'hotrodpin.swf', 'hotrodpin', '5', '550', '380', '0', '0', '12');
INSERT INTO titanium_bbgames VALUES ('118', 'pinball1.gif', '', '0', '0', '0', 'Xtreme PinBall', 'pinball.swf', 'pinball', '5', '550', '380', '0', '0', '12');
INSERT INTO titanium_bbgames VALUES ('119', 'piratesrevenge1.gif', '', '0', '0', '0', 'PiratesRevenge Slots', 'piratesrevenge.swf', 'piratesrevenge', '5', '550', '380', '0', '0', '8');
INSERT INTO titanium_bbgames VALUES ('120', 'slots30001.gif', 'casino slots', '0', '0', '0', 'Slots 3000', 'slots3000.swf', 'slots3000', '5', '550', '380', '0', '0', '8');
INSERT INTO titanium_bbgames VALUES ('121', 'brainiacibpa1.gif', 'See how skill you are, rember were the pictures are and match them up.', '0', '0', '0', 'Brainiac', 'brainiacibpa.swf', 'brainiacibpa', '5', '550', '380', '0', '0', '6');
INSERT INTO titanium_bbgames VALUES ('122', 'cyberslots1.gif', '', '0', '0', '0', 'Cyber Slots', 'cyberslots.swf', 'cyberslots', '5', '550', '380', '0', '0', '8');
INSERT INTO titanium_bbgames VALUES ('123', 'craps1.gif', 'Roll some Dice, try out your luck..', '0', '0', '0', 'Craps', 'craps.swf', 'craps', '5', '550', '380', '0', '0', '8');
INSERT INTO titanium_bbgames VALUES ('124', 'bejeweled1.gif', '', '0', '0', '0', 'BeJeweled', 'bejeweled.swf', 'bejeweled', '5', '550', '380', '0', '0', '6');
INSERT INTO titanium_bbgames VALUES ('125', 'babegame1.gif', 'The game of memory featuring 12 Playboy Playmates!', '0', '0', '0', 'Babes of Christmas', 'babegame.swf', 'babegame', '5', '550', '380', '0', '0', '10');
INSERT INTO titanium_bbgames VALUES ('126', 'goldminer1.gif', 'Collect the Qouted amount of money to advance to next level.', '0', '0', '0', 'Gold Miner', 'goldminer.swf', 'goldminer', '5', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('128', 'filluptheboy1.gif', 'Fill up the boy with water.', '0', '0', '0', 'Fill up the Boy', 'filluptheboy.swf', 'filluptheboy', '5', '550', '380', '0', '0', '10');
INSERT INTO titanium_bbgames VALUES ('129', 'x227sm1.gif', 'An extreme tactical shooting game, hold on, you\'ll love it...', '0', '0', '0', 'x227', 'x227sm.swf', 'x227sm', '5', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('130', 'rshot1.gif', 'hit the bullseye for top points..', '0', '0', '0', 'Target Shot', 'rshot.swf', 'rshot', '5', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('133', 'pinguslap1.gif', 'Hit the lil water birds, hit the bulleye, if you can.', '0', '0', '0', 'PenguinSlap', 'pinguslap.swf', 'pinguslap', '3', '550', '380', '0', '0', '12');
INSERT INTO titanium_bbgames VALUES ('135', 'ctdhighjump1.gif', 'Crash the Dummy, hit the board as high as you can.', '0', '0', '0', 'CTD HighJump', 'ctdhighjump.swf', 'ctdhighjump', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('137', 'yetitoursm1.gif', 'Compete in a Yeti Tour', '0', '0', '0', 'Yeti AllStar Tour', 'yetitoursm.swf', 'yetitoursm', '3', '550', '380', '0', '0', '12');
INSERT INTO titanium_bbgames VALUES ('138', 'yeti_stagedive1.gif', '', '0', '0', '0', 'Yeti StageDive', 'yeti_stagedive.swf', 'yeti_stagedive', '5', '550', '380', '0', '0', '12');
INSERT INTO titanium_bbgames VALUES ('139', 'bowhunter1.gif', 'Click and pul mouse back, release button to fire, now go shoot some deer.', '0', '0', '0', 'Bow Hunter', 'bowhunter.swf', 'bowhunter', '5', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('141', 'sealbounce.gif', 'Throw the penguin as high as you can', '0', '0', '0', 'Yeti Seal Bounce', 'sealbounce.swf', 'sealbounce', '3', '550', '380', '0', '0', '12');
INSERT INTO titanium_bbgames VALUES ('142', 'yeti7.gif', 'Yeti Snow Boarding', '0', '0', '0', 'Yeti Free Ride', 'yeti7.swf', 'yeti7', '3', '550', '380', '0', '0', '12');
INSERT INTO titanium_bbgames VALUES ('143', 'yeti4.gif', '', '0', '0', '0', 'Yeti Fly', 'yeti4.swf', 'yeti4', '3', '550', '380', '0', '0', '12');
INSERT INTO titanium_bbgames VALUES ('144', 'yeti5.gif', '', '0', '0', '0', 'Yeti Flamingo Drive', 'yeti5.swf', 'yeti5', '3', '550', '380', '0', '0', '12');
INSERT INTO titanium_bbgames VALUES ('145', 'yeti6.gif', '', '0', '0', '0', 'Yeti Big Wave', 'yeti6.swf', 'yeti6', '5', '550', '380', '0', '0', '12');
INSERT INTO titanium_bbgames VALUES ('147', 'yeti8GC1.gif', 'Number 8 installment of Yetisport games.', '0', '0', '0', 'YetiSports VIII Jungle Swing', 'yeti8GC.swf', 'yeti8GC', '4', '550', '400', '0', '0', '12');
INSERT INTO titanium_bbgames VALUES ('148', 'curveball1.gif', 'Try and keep up with the curving ball against the computer.', '0', '0', '0', 'Curve Ball', 'curveball.swf', 'curveball', '3', '550', '380', '0', '0', '6');
INSERT INTO titanium_bbgames VALUES ('170', 'simon1.gif', 'Colr Matching memory Test.', '0', '0', '0', 'Simon', 'simon.swf', 'simon', '3', '550', '380', '0', '0', '6');
INSERT INTO titanium_bbgames VALUES ('149', 'wallball.gif', 'Nice lil game, but watch out..', '0', '0', '0', 'Wall Ball', 'wallball.swf', 'wallball', '5', '550', '380', '0', '0', '6');
INSERT INTO titanium_bbgames VALUES ('150', 'missionbabylonSte2.gif', '', '0', '0', '0', 'MissionBabylonSte2', 'missionbabylonSte.swf', 'missionbabylonSte', '4', '550', '380', '0', '0', '5');
INSERT INTO titanium_bbgames VALUES ('151', 'hoslappin1.gif', 'Slap the Hell outta that hoe..', '0', '0', '0', 'Hoe Slappin', 'hoslappin.swf', 'hoslappin', '4', '550', '380', '0', '0', '10');
INSERT INTO titanium_bbgames VALUES ('152', 'bonkpong1.gif', '', '0', '0', '0', 'Bonk Pong', 'bonkpong.swf', 'bonkpong', '4', '550', '380', '0', '0', '10');
INSERT INTO titanium_bbgames VALUES ('153', 'nakedrun1.gif', '', '0', '0', '0', 'Naked Run', 'nakedrun.swf', 'nakedrun', '4', '550', '380', '0', '0', '10');
INSERT INTO titanium_bbgames VALUES ('154', 'orgasmgirl1.gif', '', '0', '0', '0', 'Orgasm Girl', 'orgasmgirl.swf', 'orgasmgirl', '5', '550', '380', '0', '0', '10');
INSERT INTO titanium_bbgames VALUES ('155', 'squirter1.gif', '', '0', '0', '0', 'Water Gun', 'squirter.swf', 'squirter', '4', '550', '380', '0', '0', '10');
INSERT INTO titanium_bbgames VALUES ('156', 'unrevealtournament1.gif', '', '0', '0', '0', 'UnRevealTournament', 'unrevealtournament.swf', 'unrevealtournament', '4', '550', '380', '0', '0', '10');
INSERT INTO titanium_bbgames VALUES ('162', 'asteroids1.gif', '', '0', '0', '0', 'Asteroids', 'asteroids.swf', 'asteroids', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('163', 'ping1.gif', '', '0', '0', '0', 'Ping', 'ping.swf', 'ping', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('164', 'watchout1.gif', '', '0', '0', '0', 'WatchOut', 'watchout.swf', 'watchout', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('165', 'jasonspong1.gif', '', '0', '0', '0', 'Jason\'s Pong', 'jasonspong.swf', 'jasonspong', '3', '550', '380', '0', '0', '6');
INSERT INTO titanium_bbgames VALUES ('166', 'ufoshoot1.gif', '', '0', '0', '0', 'UFO Shoot', 'ufoshoot.swf', 'ufoshoot', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('167', 'vforce1.gif', '', '0', '0', '0', 'V Force', 'vforce.swf', 'vforce', '3', '550', '380', '0', '0', '5');
INSERT INTO titanium_bbgames VALUES ('168', 'spaceinvaders1.gif', 'Classic Atari game here Boys.', '0', '0', '0', 'Space Invaders', 'spaceinvaders.swf', 'spaceinvaders', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('169', 'snakeman1.gif', '', '0', '0', '0', 'Snake Man', 'snakeman.swf', 'snakeman', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('172', 'crazyclosetsynergy.gif', 'Collect all the junk falling from the closet', '0', '0', '0', 'Crazy Closet Energy', 'crazyclosetsynergy.swf', 'crazyclosetsynergy', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('173', 'gyroball1.gif', 'One Hard azz Game, try to get the ball to it\'s destination Point.', '0', '0', '0', 'Gyro Ball', 'gyroball.swf', 'gyroball', '3', '550', '380', '0', '0', '6');
INSERT INTO titanium_bbgames VALUES ('174', 'hexxagon1.gif', 'One difficult game here boys', '0', '0', '0', 'HexxAgon', 'hexxagon.swf', 'hexxagon', '3', '550', '380', '0', '0', '6');
INSERT INTO titanium_bbgames VALUES ('175', 'threedsuper1.gif', 'One Hard Ball to get to hit the Target', '0', '0', '0', '3D Super ball', 'threedsuper.swf', 'threedsuper', '3', '550', '380', '0', '0', '6');
INSERT INTO titanium_bbgames VALUES ('176', 'ollie1.gif', ' Get Olie Home on a SkateBoard', '0', '0', '0', 'Ollie', 'ollie.swf', 'ollie', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('177', 'othello1.gif', 'Rwally hard matching Game', '0', '0', '0', 'Othello', 'othello.swf', 'othello', '3', '550', '380', '0', '0', '6');
INSERT INTO titanium_bbgames VALUES ('178', 'yankeegohome1.gif', '', '0', '0', '0', 'Knock Him Home', 'yankeegohome.swf', 'yankeegohome', '3', '550', '380', '0', '0', '3');
INSERT INTO titanium_bbgames VALUES ('179', 'wordup1.gif', 'Word Creation game off the Key Letter', '0', '0', '0', 'Word Up', 'wordup.swf', 'wordup', '3', '550', '380', '0', '0', '6');
INSERT INTO titanium_bbgames VALUES ('180', 'superhackysack1.gif', 'Kool azz game for playing Hacky Sack', '0', '0', '0', 'Super Hacky Sack', 'superhackysack.swf', 'superhackysack', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('181', 'falldown1.gif', 'Keep the Ball falling as long as you can.', '0', '0', '0', 'Fall Down', 'falldown.swf', 'falldown', '3', '550', '380', '1720', '0', '2');
INSERT INTO titanium_bbgames VALUES ('182', 'celebfight1.gif', 'Try out your boxing skills, whoop the shitnitz outta a Celebrity..', '0', '0', '0', 'Celebrity Fight Club', 'celebfight.swf', 'celebfight', '5', '550', '380', '0', '0', '10');
INSERT INTO titanium_bbgames VALUES ('183', 'donkeykong1.gif', 'Original Atari DonkeyKong', '0', '0', '0', 'DonkeKong Classic', 'donkeykong.swf', 'donkeykong', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('184', 'contra1.gif', 'Classic Original.', '0', '0', '0', 'Contra', 'contra.swf', 'contra', '5', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('185', 'elemigrante1.gif', 'Avoid the police for as long as you possibly can!', '0', '0', '0', 'El Emigrante', 'elemigrante.swf', 'elemigrante', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('186', 'powerdriver1.gif', 'Golf Driving Range', '0', '0', '0', 'Power Drive', 'powerdriver.swf', 'powerdriver', '5', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('187', 'likejailbait1.gif', 'Check this to see how ell you know if it Jail Bait Or Not..', '0', '0', '0', 'Like Jail Bait?', 'likejailbait.swf', 'likejailbait', '3', '550', '380', '1780', '0', '10');
INSERT INTO titanium_bbgames VALUES ('188', 'worldcycle1.gif', '', '0', '0', '0', 'World Cycle Tour', 'worldcycle.swf', 'worldcycle', '3', '550', '380', '0', '0', '4');
INSERT INTO titanium_bbgames VALUES ('189', 'footballpass1.gif', 'Be Accurate, Win Big..', '0', '0', '0', 'FootBall Pass', 'footballpass.swf', 'footballpass', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('191', 'angrywizard1.gif', '', '0', '0', '0', 'Angry Ole Wizard', 'angrywizard.swf', 'angrywizard', '3', '550', '380', '1810', '0', '2');
INSERT INTO titanium_bbgames VALUES ('192', 'netblazer3d1.gif', 'Be Accurate in shooting some hoops, 3D Style!!', '0', '0', '0', 'NetBlazer 3D', 'netblazer3d.swf', 'netblazer3d', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('193', 'roboxer1.gif', 'Ultimate Robot Boxing..', '0', '0', '0', 'RoBoxer', 'roboxer.swf', 'roboxer', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('194', 'turbospirit1.gif', 'Sprint from check point to check point on a turbo cycle', '0', '0', '0', 'Turbo Sprint Cycle', 'turbospirit.swf', 'turbospirit', '3', '550', '380', '0', '0', '4');
INSERT INTO titanium_bbgames VALUES ('195', 'racetoexcel1.gif', 'Bash the Cars to Excel to next round', '0', '0', '0', 'Race to Excel', 'racetoexcel.swf', 'racetoexcel', '3', '550', '380', '0', '0', '4');
INSERT INTO titanium_bbgames VALUES ('196', 'halflife21.gif', 'Half Life 2 Expert Shooting', '0', '0', '0', 'Half Life 2 Total Mayhem', 'halflife2.swf', 'halflife2', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('197', 'frogger1.gif', '', '0', '0', '0', 'Frogger 2', 'frogger.swf', 'frogger', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('198', 'neverland1.gif', 'Now is this a srewed up game or what..', '0', '0', '0', 'Neverland Escape', 'neverland.swf', 'neverland', '3', '550', '380', '0', '0', '3');
INSERT INTO titanium_bbgames VALUES ('199', 'blliquors1.gif', 'Bust Ben Laudian\'s  azz', '0', '0', '0', 'Ben Laudin Liquors', 'blliquors.swf', 'blliquors', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('200', 'chopper1.gif', 'Do your best manuvering to score high..', '0', '0', '0', 'Chopper Challege', 'chopper.swf', 'chopper', '3', '550', '380', '0', '0', '5');
INSERT INTO titanium_bbgames VALUES ('201', 'yeti9sm1.gif', 'Yeti Sports 9 Final, Lama spit', '0', '0', '0', 'Yeti 9 Final', 'yeti9sm.swf', 'yeti9sm', '4', '550', '380', '0', '0', '12');
INSERT INTO titanium_bbgames VALUES ('202', 'popupkill1.gif', 'Kill the annoying Pop Ups', '0', '0', '0', 'PopUp Kill', 'popupkill.swf', 'popupkill', '3', '550', '380', '0', '0', '6');
INSERT INTO titanium_bbgames VALUES ('203', 'castle_defender.gif', 'Keep the oponents off aslong as you can.', '0', '0', '0', 'Castle Defend V2', 'castle_defender.swf', 'castle_defender', '5', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('204', 'crabvb1.gif', 'Try and win , being you are a Crab, you are slow..., lol', '0', '0', '0', 'Crab Volley Ball', 'crabvb.swf', 'crabvb', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('214', 'qbert20041.gif', '', '0', '0', '0', 'Qbert 2004', 'qbert2004.swf', 'qbert2004', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('205', 'bottleshoot1.gif', 'Shoot some bottles, and a few other obstacles that get thrown at ya..', '0', '0', '0', 'Bottle Shoot', 'bottleshoot.swf', 'bottleshoot', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('206', 'asteroids20031.gif', '', '0', '0', '0', 'Asteroids 2003', 'asteroids2003.swf', 'asteroids2003', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('207', 'jugglechallenge1.gif', 'Mario\'s Jungle Chenge adventure', '0', '0', '0', 'Juggle Challenge', 'jugglechallenge.swf', 'jugglechallenge', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('209', 'junglescape1.gif', 'Mario\'s Jungle Escape', '0', '0', '0', 'Jungle Escape', 'junglescape.swf', 'junglescape', '3', '550', '380', '1990', '0', '2');
INSERT INTO titanium_bbgames VALUES ('210', 'teddyswim1.gif', '', '0', '0', '0', 'Teddy\'s Swim', 'teddyswim.swf', 'teddyswim', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('213', 'pooljam1.gif', 'Pool Sharp Shooting, I guess, lol', '0', '0', '0', 'Pool Jam', 'pooljam.swf', 'pooljam', '3', '550', '380', '0', '0', '6');
INSERT INTO titanium_bbgames VALUES ('215', 'qb_challenge1.gif', '', '0', '0', '0', 'QB Challenge', 'qb_challenge.swf', 'qb_challenge', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('216', 'rollinxpinball1.gif', '', '0', '0', '0', 'Rollin X Pinball', 'rollinxpinball.swf', 'rollinxpinball', '3', '550', '380', '0', '0', '12');
INSERT INTO titanium_bbgames VALUES ('219', 'starskynhutchpb1.gif', '', '0', '0', '0', 'Starsky N Hutch PinBall', 'starsky-n-hutch.swf', 'starsky-n-hutch', '5', '500', '560', '0', '0', '12');
INSERT INTO titanium_bbgames VALUES ('220', 'sonic1.gif', 'SEGA\'s Sonic Hedge Hog Classic', '0', '0', '0', 'Sonic', 'sonic.swf', 'sonic', '3', '550', '380', '0', '0', '2');
INSERT INTO titanium_bbgames VALUES ('221', 'blackjackbbt1.gif', 'Black Jack', '0', '0', '0', 'Black Jack V1', 'blackjackbbt.swf', 'blackjackbbt', '3', '550', '380', '0', '0', '8');

# --------------------------------------------------------

Table structure for table 'titanium_bbhackgame'
#

CREATE TABLE titanium_bbhackgame (
   user_id mediumint(8) DEFAULT '0' NOT NULL,
   game_id mediumint(8) DEFAULT '0' NOT NULL,
   date_hack int(11) DEFAULT '0' NOT NULL
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

#
# Dumping data for table 'titanium_bbhackgame'
#


# --------------------------------------------------------

 Table structure for table 'titanium_bbscores'
#

CREATE TABLE titanium_bbscores (
   game_id mediumint(8) DEFAULT '0' NOT NULL,
   user_id mediumint(8) DEFAULT '0' NOT NULL,
   score_game int(11) DEFAULT '0' NOT NULL,
   score_date int(11) DEFAULT '0' NOT NULL,
   score_time int(11) DEFAULT '0' NOT NULL,
   score_set mediumint(8) DEFAULT '0' NOT NULL,
   KEY game_id (game_id),
   KEY user_id (user_id)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

#
# Dumping data for table 'titanium_bbscores'
#


# --------------------------------------------------------