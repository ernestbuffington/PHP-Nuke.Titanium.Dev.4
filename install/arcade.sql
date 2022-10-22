-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 01, 2022 at 01:34 AM
-- Server version: 10.2.44-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dev4_engine`
--

-- --------------------------------------------------------

--
-- Table structure for table `titanium_bbarcade`
--

DROP TABLE IF EXISTS `titanium_bbarcade`;
CREATE TABLE `titanium_bbarcade` (
  `arcade_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `arcade_value` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `titanium_bbarcade`
--

INSERT INTO `titanium_bbarcade` (`arcade_name`, `arcade_value`) VALUES
('arcade_announcement', 'Welcome to the Arcade!<br>Enjoy!'),
('use_category_mod', '1'),
('category_preview_games', '5'),
('games_par_page', '15'),
('game_order', 'Alpha'),
('display_winner_avatar', '1'),
('stat_par_page', '10'),
('winner_avatar_position', 'left'),
('maxsize_avatar', '200'),
('linkcat_align', '2'),
('limit_by_posts', '0'),
('posts_needed', '5'),
('days_limit', '5'),
('limit_type', 'date'),
('use_fav_category', '0');

-- --------------------------------------------------------

--
-- Table structure for table `titanium_bbarcade_categories`
--

DROP TABLE IF EXISTS `titanium_bbarcade_categories`;
CREATE TABLE `titanium_bbarcade_categories` (
  `arcade_catid` mediumint(8) UNSIGNED NOT NULL,
  `arcade_cattitle` varchar(100) COLLATE utf8_bin NOT NULL,
  `arcade_nbelmt` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `arcade_catorder` mediumint(8) UNSIGNED NOT NULL DEFAULT 0,
  `arcade_catauth` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `titanium_bbarcade_categories`
--

INSERT INTO `titanium_bbarcade_categories` (`arcade_catid`, `arcade_cattitle`, `arcade_nbelmt`, `arcade_catorder`, `arcade_catauth`) VALUES
(1, 'Arcade', 8, 1, 0),
(2, 'Shooting', 25, 11, 0),
(3, 'W T F Games', 19, 21, 0),
(4, 'Racing', 12, 31, 0),
(5, 'Flight Games', 11, 41, 0),
(6, 'Stratagey', 27, 51, 0),
(7, 'Card Games', 4, 61, 0),
(8, 'Casino Games', 6, 71, 0),
(10, 'Adult 18+', 15, 91, 0),
(12, 'Yeti Sports', 15, 111, 0);

-- --------------------------------------------------------

--
-- Table structure for table `titanium_bbarcade_comments`
--

DROP TABLE IF EXISTS `titanium_bbarcade_comments`;
CREATE TABLE `titanium_bbarcade_comments` (
  `game_id` mediumint(8) NOT NULL DEFAULT 0,
  `comments_value` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `titanium_bbauth_arcade_access`
--

DROP TABLE IF EXISTS `titanium_bbauth_arcade_access`;
CREATE TABLE `titanium_bbauth_arcade_access` (
  `group_id` mediumint(8) NOT NULL DEFAULT 0,
  `arcade_catid` mediumint(8) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `titanium_bbgamehash`
--

DROP TABLE IF EXISTS `titanium_bbgamehash`;
CREATE TABLE `titanium_bbgamehash` (
  `gamehash_id` char(32) COLLATE utf8_bin NOT NULL,
  `game_id` mediumint(8) NOT NULL DEFAULT 0,
  `user_id` mediumint(8) NOT NULL DEFAULT 0,
  `hash_date` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `titanium_bbgamehash`
--

INSERT INTO `titanium_bbgamehash` (`gamehash_id`, `game_id`, `user_id`, `hash_date`) VALUES
('52cb484c1eac60f905611ed0e627bfe4', 222, 3, 1664601811),
('1ba281c56e79c28cd4a5a45f16003f60', 222, 3, 1664601843),
('cc5d7058e099ae7ec0d1fbe62c733f74', 68, 3, 1664601875),
('14ffb8fedb344dcc3a9c611949d50aba', 61, 3, 1664602104),
('3c36d84124de10b6bb80fb82dba9dff0', 61, 3, 1664602282);

-- --------------------------------------------------------

--
-- Table structure for table `titanium_bbgames`
--

DROP TABLE IF EXISTS `titanium_bbgames`;
CREATE TABLE `titanium_bbgames` (
  `game_id` mediumint(8) NOT NULL,
  `game_pic` varchar(50) COLLATE utf8_bin NOT NULL,
  `game_desc` varchar(255) COLLATE utf8_bin NOT NULL,
  `game_highscore` int(11) NOT NULL DEFAULT 0,
  `game_highdate` int(11) NOT NULL DEFAULT 0,
  `game_highuser` mediumint(8) NOT NULL DEFAULT 0,
  `game_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `game_swf` varchar(50) COLLATE utf8_bin NOT NULL,
  `game_scorevar` varchar(20) COLLATE utf8_bin NOT NULL,
  `game_type` tinyint(4) NOT NULL DEFAULT 0,
  `game_width` mediumint(5) NOT NULL DEFAULT 550,
  `game_height` varchar(5) COLLATE utf8_bin NOT NULL DEFAULT '380',
  `game_order` mediumint(8) NOT NULL DEFAULT 0,
  `game_set` mediumint(8) NOT NULL DEFAULT 0,
  `arcade_catid` mediumint(8) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `titanium_bbgames`
--

INSERT INTO `titanium_bbgames` (`game_id`, `game_pic`, `game_desc`, `game_highscore`, `game_highdate`, `game_highuser`, `game_name`, `game_swf`, `game_scorevar`, `game_type`, `game_width`, `game_height`, `game_order`, `game_set`, `arcade_catid`) VALUES
(222, 'penguin2.gif', 'Whack the penguin as hard as you can!\'', 0, 0, 0, 'Penguin Bashing', 'penguin.swf', 'penguin', 3, 550, '380', 10, 0, 1),
(223, 'yeti1_5shots1.gif', 'you get 5 shaots to bash the Penguin as far as you can', 0, 0, 0, 'Penguin Bashing 5 shots', 'yeti1_5shots.swf', 'yeti1_5shots', 3, 550, '380', 50, 0, 1),
(8, '5carddraw1.gif', 'Beat the dealer in 5 card Draw', 0, 0, 0, '5 card draw', '5carddraw.swf', '5carddraw', 3, 550, '380', 70, 0, 1),
(1, 'mahjongg2.gif', 'Hmmm, match the Blocks', 0, 0, 0, 'mahjongsolitaire', 'mahjongg2.swf', 'mahjongg2', 5, 550, '380', 0, 0, 6),
(2, 'fastnfurious1.gif', 'Fast n Furious Racing', 0, 0, 0, 'Need for Speed Underground', 'fastnfurious.swf', 'fastnfurious', 3, 550, '380', 0, 0, 4),
(3, 'rally21001.gif', 'Rally Racing', 0, 0, 0, 'Rally2100', 'rally2100.swf', 'rally2100', 3, 550, '380', 0, 0, 4),
(5, 'simpsonsshooter1.gif', 'Kill the Simpson\'s', 0, 0, 0, 'Simpson Shoot Em', 'simpsonsshooter.swf', 'simpsonsshooter', 3, 550, '380', 0, 0, 2),
(6, 'spankthemonkey1.gif', 'Slap the shitniz outta the monkey, lol', 0, 0, 0, 'Slap The Monkey', 'spankthemonkey.swf', 'spankthemonkey', 3, 550, '380', 0, 0, 2),
(7, 'quickshot1.gif', 'See how fast and accurate you are..At hooping basket balls.', 0, 0, 0, 'Quick Shot', 'quickshot.swf', 'quickshot', 3, 550, '380', 0, 0, 2),
(224, 'sharpshooter1.gif', 'How sharp are you.....', 0, 0, 0, 'Sharp Shooter', 'sharpshooter.swf', 'sharpshooter', 3, 550, '380', 0, 0, 2),
(9, 'ninjaturtles21.gif', 'Throw stars, see how many you hit in a time limit..', 0, 0, 0, 'Ninja Turtles', 'ninjaturtles2.swf', 'ninjaturtles2', 3, 550, '380', 0, 0, 2),
(10, 'whatashot1.gif', 'See how Good you can shoot ball.', 0, 0, 0, 'What a Shot', 'whatashot.swf', 'whatashot', 3, 550, '380', 0, 0, 2),
(11, 'vbtetris1.gif', 'test you skill in the original tetris.', 0, 0, 0, 'Tetris', 'vbtetris.swf', 'vbtetris', 3, 550, '380', 0, 0, 2),
(12, 'streaker1.gif', 'See how many touch downs you can make, running around the field Butt Ass Naked, lol', 0, 0, 0, 'Streaker', 'streaker.swf', 'streaker', 3, 550, '380', 0, 0, 3),
(13, 'wot1.gif', 'See if you can bust their azz.', 0, 0, 0, 'War on Terror', 'wot.swf', 'wot', 3, 550, '380', 0, 0, 3),
(14, 'spermwars1.gif', 'Lmmfao, see if you can make it, lol', 0, 0, 0, 'Sperm Wars', 'spermwars.swf', 'spermwars', 3, 550, '380', 0, 0, 3),
(15, 'superfishing1.gif', 'Catch a Fish, Win a trophy.', 0, 0, 0, 'Super Fishing', 'superfishing.swf', 'superfishing', 3, 550, '380', 0, 0, 2),
(16, 'metalslug1.gif', 'Blow sum stuff up.', 0, 0, 0, 'Metal Slug', 'metalslug.swf', 'metalslug', 3, 550, '380', 0, 0, 2),
(17, 'missionmars1.gif', 'Level the city', 0, 0, 0, 'Mission Mars', 'missionmars.swf', 'missionmars', 3, 550, '380', 0, 0, 2),
(18, 'missilestrike1.gif', 'Detroy everything, before they detroy you', 0, 0, 0, 'Missle Strike', 'missilestrike.swf', 'missilestrike', 3, 550, '380', 0, 0, 2),
(19, 'pedestriankiller1.gif', 'See how many peeps you can run down in a small time limit.', 0, 0, 0, 'Pedestrian killer', 'pedestriankiller.swf', 'pedestriankiller', 3, 550, '380', 0, 0, 3),
(20, 'pinheadz1.gif', 'Bowlin.', 0, 0, 0, 'Pin Headz', 'pinheadz.swf', 'pinheadz', 3, 550, '380', 0, 0, 2),
(21, 'roachkill1.gif', 'Kill some bugs.', 0, 0, 0, 'Roach Kill', 'roachkill.swf', 'roachkill', 3, 550, '380', 0, 0, 3),
(22, 'shootthegatso1.gif', 'Shoot the what?', 0, 0, 0, 'Shoot the gatso', 'shootthegatso.swf', 'shootthegatso', 3, 550, '380', 0, 0, 3),
(24, 'pacman.gif', 'Original Pac Man', 0, 0, 0, 'Pac Man', 'pacman.swf', 'pacman', 3, 550, '380', 0, 0, 2),
(47, 'stripordie.gif', 'See how good your luck is.', 0, 0, 0, 'Strip or Die', 'stripordie.swf', 'stripordie', 3, 550, '380', 0, 0, 3),
(25, 'bombjack1.gif', 'bomb Jack', 0, 0, 0, 'Bomb Jack', 'bombjack.swf', 'bombjack', 3, 550, '380', 0, 0, 2),
(26, 'eggs1.gif', 'Catch all the eggs,if you can.', 0, 0, 0, 'Eggs', 'eggs.swf', 'eggs', 3, 550, '380', 0, 0, 3),
(27, 'castledefend1.gif', 'Defend your Castle, by picking them up and dropping them to their deaths.', 0, 0, 0, 'Castle Defense', 'castledefend.swf', 'castledefend', 3, 550, '380', 0, 0, 3),
(28, 'jailbreak1.gif', 'Shoot them jail breakers.', 0, 0, 0, 'Jail Break', 'jailbreak.swf', 'jailbreak', 3, 550, '380', 0, 0, 2),
(29, 'discoracer1.gif', 'Disco Racing, hmmm.', 0, 0, 0, 'Disco Racer', 'discoracer.swf', 'discoracer', 3, 550, '380', 0, 0, 4),
(30, 'dkongsm1.gif', 'Donkey Kong Jr.', 0, 0, 0, 'Donkey Kong Jr.', 'dkongsm.swf', 'dkongsm', 3, 550, '380', 0, 0, 2),
(31, 'enemyshooting1.gif', 'Another shooting skill game.', 0, 0, 0, 'Enemy Shoot', 'enemyshooting.swf', 'enemyshooting', 3, 550, '380', 0, 0, 2),
(32, 'gpchall21.gif', 'Grand prix challege', 0, 0, 0, 'Grand Prix', 'gpchall2.swf', 'gpchall2', 3, 550, '380', 0, 0, 4),
(160, '501darts.gif', '', 0, 0, 0, '501 Darts', '501darts.swf', '501darts', 5, 550, '380', 0, 0, 2),
(161, 'alienattack1.gif', '', 0, 0, 0, 'Alein Attack', 'alienattack.swf', 'alienattack', 3, 550, '380', 0, 0, 5),
(34, 'killerbob1.gif', 'Killer bob shooting', 0, 0, 0, 'Killer Bob', 'killerbob.swf', 'killerbob', 3, 550, '380', 0, 0, 2),
(35, 'islandadventure1.gif', 'Dick\'s Island Aventure', 0, 0, 0, 'Dick\'s Quick', 'islandadventure.swf', 'islandadventure', 3, 550, '380', 0, 0, 2),
(36, 'cutiequake1.gif', 'Shoot these lil freaks', 0, 0, 0, 'Cutie Quake', 'cutiequake.swf', 'cutiequake', 3, 550, '380', 0, 0, 3),
(37, 'desertbattle1.gif', 'Navigate thru the desert with out being shot down.', 0, 0, 0, 'Desert Battle', 'desertbattle.swf', 'desertbattle', 3, 550, '380', 0, 0, 5),
(38, 'homerun1.gif', 'See if you can get this drunk a@# mofo home...', 0, 0, 0, 'Home Run', 'homerun.swf', 'homerun', 3, 550, '380', 0, 0, 3),
(39, 'graveyard1.gif', 'Shoot the zombis\'s, Before the get you...', 0, 0, 0, 'Grave Yard', 'graveyard.swf', 'graveyard', 3, 550, '380', 0, 0, 2),
(40, 'frogger21.gif', 'The all time original Frogger, for us old school folks...', 0, 0, 0, 'Frogger', 'frogger2.swf', 'frogger2', 3, 550, '380', 0, 0, 2),
(41, 'kegstand1.gif', 'Stay baleance on a Beer Keg..', 0, 0, 0, 'Keg Stand', 'kegstand.swf', 'kegstand', 3, 550, '380', 0, 0, 2),
(42, 'gwb1.gif', 'George wants a Beer..', 0, 0, 0, 'Wants Beer', 'gwb.swf', 'gwb', 3, 550, '380', 0, 0, 3),
(43, 'lanebowling1.gif', 'Another Bowling game.', 0, 0, 0, 'Lane Bowling', 'lanebowling.swf', 'lanebowling', 3, 550, '380', 0, 0, 2),
(44, 'asshunter.gif', 'Kill them before they get you, lol', 0, 0, 0, 'Ass Hunter', 'asshunter.swf', 'asshunter', 3, 550, '380', 0, 0, 10),
(45, 'shieldshot.gif', 'Accurany Shooting game.', 0, 0, 0, 'Shield Shot', 'shieldshot.swf', 'shieldshot', 3, 550, '380', 0, 0, 2),
(46, 'duckhunt.gif', 'The original Mario\'s Duck Hunt.', 0, 0, 0, 'Duck Hunt', 'duckhunt.swf', 'duckhunt', 3, 550, '380', 0, 0, 2),
(48, 'airfox.gif', 'Flight', 0, 0, 0, 'Air Fox', 'airfox.swf', 'airfox', 3, 550, '380', 0, 0, 5),
(49, 'plasticsaucer.gif', 'Navigate threw tunnels on trenches', 0, 0, 0, 'Plastic Saucer', 'plasticsaucer.swf', 'plasticsaucer', 3, 550, '380', 0, 0, 5),
(50, 'aim.gif', 'Shoot as many as you can of the specified targets', 0, 0, 0, 'AIM', 'aim.swf', 'aim', 3, 550, '380', 0, 0, 2),
(51, 'marbles1.gif', 'Collect all your marbles.', 0, 0, 0, 'Lost Your Marbles?', 'marbles.swf', 'marbles', 3, 550, '380', 0, 0, 6),
(52, 'kittenshooting1.gif', 'Shoot clay kitten targets, lol', 0, 0, 0, 'Kitten Shooting', 'kittenshooting.swf', 'kittenshooting', 3, 550, '380', 0, 0, 2),
(53, 'gunman1.gif', '', 0, 0, 0, 'Gun Man', 'gunman.swf', 'gunman', 3, 550, '380', 0, 0, 2),
(54, 'juggler1.gif', 'See how long you can keep the ball off the ground.', 0, 0, 0, 'Juggler', 'juggler.swf', 'juggler', 3, 550, '380', 0, 0, 6),
(55, 'fishy.gif', 'Eat smaller fish to grow to eat bigger fish', 0, 0, 0, 'Fishy', 'fishy.swf', 'fishy', 3, 550, '380', 0, 0, 6),
(171, 'cellout1.gif', 'Cure the Patient', 0, 0, 0, 'CellOut', 'cellout.swf', 'cellout', 3, 550, '380', 0, 0, 6),
(57, '3cardpoker1.gif', 'Poker game', 0, 0, 0, '3 Card Poker', '3cardpoker.swf', '3cardpoker', 3, 550, '380', 0, 0, 7),
(58, 'bjfever1.gif', 'Black Jack', 0, 0, 0, 'Black Jack Fever', 'bjfever.swf', 'bjfever', 3, 550, '380', 0, 0, 7),
(59, '5milestogo1.gif', 'Nascar cup car, somewhat, lol', 0, 0, 0, '5 Miles To Go', '5milestogo.swf', '5milestogo', 3, 550, '380', 0, 0, 4),
(60, 'cardriver1.gif', 'Collect money racing in 3D.', 0, 0, 0, '3D Car Driver', 'cardriver.swf', 'cardriver', 3, 550, '380', 0, 0, 4),
(61, 'bowling_tgfg1.gif', 'Another Bowling game.', 0, 0, 0, 'Bowling', 'bowling_tgfg.swf', 'bowling_tgfg', 3, 550, '380', 0, 0, 2),
(62, 'catapult1.gif', 'Something to do with slingshotting cats, lol.', 0, 0, 0, 'Cat-A-Pult', 'catapult.swf', 'catapult', 3, 550, '380', 0, 0, 3),
(63, 'canyonglider1.gif', 'Hang glide threw the canyons.', 0, 0, 0, 'Canyon Glider', 'canyonglider.swf', 'canyonglider', 3, 550, '380', 0, 0, 5),
(64, 'asteroids20001.gif', 'Blow up asteriods before they crash you.', 0, 0, 0, 'Asteriods 2000', 'asteroids2000.swf', 'asteroids2000', 3, 550, '380', 0, 0, 5),
(65, 'bmxtricks1.gif', 'Score points by succeeded tricks.', 0, 0, 0, 'BMX Trick Riding', 'bmxtricks.swf', 'bmxtricks', 3, 550, '380', 0, 0, 2),
(66, 'beermat1.gif', 'You figure it out....', 0, 0, 0, 'Beer Mat', 'beermat.swf', 'beermat', 3, 550, '380', 0, 0, 3),
(67, 'basketballrally1.gif', 'Shoot some hoops.', 0, 0, 0, 'BasketBall Rally', 'basketballrally.swf', 'basketballrally', 3, 550, '380', 0, 0, 2),
(68, 'alienterminator1.gif', 'Destroy the aliens, before the destroy earth.', 0, 0, 0, 'Alien Teminator', 'alienterminator.swf', 'alienterminator', 3, 550, '380', 0, 0, 2),
(69, 'batandmouse21.gif', 'your the mouse, now survive..', 0, 0, 0, 'Bat and Muose', 'batandmouse2.swf', 'batandmouse2', 3, 550, '380', 0, 0, 2),
(70, 'ants1.gif', '', 0, 0, 0, 'Ants', 'ants.swf', 'ants', 3, 550, '380', 0, 0, 2),
(71, 'tieshooter1.gif', 'Stars wars simulation.', 0, 0, 0, 'TIE Shooter', 'tieshooter.swf', 'tieshooter', 3, 550, '380', 0, 0, 5),
(72, 'crazyblockbreaker1.gif', '', 0, 0, 0, 'Crazy Block Brecker', 'crazyblockbreaker.swf', 'crazyblockbreaker', 3, 550, '380', 0, 0, 6),
(73, 'bubbles1.gif', '', 0, 0, 0, 'Bubbles', 'bubbles.swf', 'bubbles', 3, 550, '380', 0, 0, 2),
(74, 'ctdcurling1.gif', 'See how close you can get to the point..', 0, 0, 0, 'CTD Curling', 'ctdcurling.swf', 'ctdcurling', 3, 550, '380', 0, 0, 2),
(75, 'radialsnake1.gif', 'See how long you can last, while eating the food pellets.', 0, 0, 0, 'Radial Snake', 'radialsnake.swf', 'radialsnake', 3, 550, '380', 0, 0, 2),
(76, 'magicball1.gif', 'line up the balls, score points.', 0, 0, 0, 'Magic Ball', 'magicball.swf', 'magicball', 3, 550, '380', 0, 0, 6),
(77, 'parachutepanic1.gif', 'Rescue parachuters from the sharks.', 0, 0, 0, 'Parachute Panic', 'parachutepanic.swf', 'parachutepanic', 3, 550, '380', 0, 0, 2),
(78, 'smacktherabbit1.gif', 'Get as many as you can...', 0, 0, 0, 'Smack the Rabbits', 'smacktherabbit.swf', 'smacktherabbit', 3, 550, '380', 0, 0, 3),
(79, 'target1.gif', 'another shooting game', 0, 0, 0, 'Target shooting', 'target.swf', 'target', 3, 550, '380', 0, 0, 2),
(80, 'roulette1.gif', 'Play you luck on thr roulette table', 0, 0, 0, 'Roulette', 'roulette.swf', 'roulette', 3, 550, '380', 0, 0, 8),
(81, 'ssl1.gif', '', 0, 0, 0, 'StarShip Legend', 'ssl.swf', 'ssl', 3, 550, '380', 0, 0, 5),
(82, 'dragrace1.gif', 'test your times down the strip.', 0, 0, 0, 'Drag race', 'dragrace.swf', 'dragrace', 3, 550, '380', 0, 0, 4),
(83, 'spacerunner1.gif', 'Obsitical course', 0, 0, 0, 'Space Runner', 'spacerunner.swf', 'spacerunner', 3, 550, '380', 0, 0, 6),
(84, 'virus21.gif', '', 0, 0, 0, 'Virus', 'virus2.swf', 'virus2', 3, 550, '380', 0, 0, 6),
(85, 'mariomushroom1.gif', 'Mario\'s Mushroom', 0, 0, 0, 'Mario Bros.', 'mariomushroom.swf', 'mariomushroom', 3, 550, '380', 0, 0, 2),
(87, 'macman1.gif', 'LOL, Don\'t die to son...', 0, 0, 0, 'Mac Man', 'macman.swf', 'macman', 3, 550, '380', 0, 0, 3),
(91, 'ronnorthjewels1.gif', 'Orginal Jewel\'s', 0, 0, 0, 'Ron North\'s Jewels', 'ronnorthjewels.swf', 'ronnorthjewels', 3, 550, '380', 0, 0, 6),
(89, 'itsmine1.gif', 'Catch as many Jewels as you can.', 0, 0, 0, 'It\'s Mine', 'itsmine.swf', 'itsmine', 3, 550, '380', 0, 0, 6),
(90, 'karts1.gif', 'Drive Karts without crashing.', 0, 0, 0, 'Kart Racing', 'karts.swf', 'karts', 3, 550, '380', 0, 0, 4),
(92, 'mspacman1.gif', 'Arcade Original.', 0, 0, 0, 'Ms Pac Man', 'mspacman.swf', 'mspacman', 3, 550, '380', 0, 0, 2),
(93, 'shootout1.gif', 'Wild West ShootOut', 0, 0, 0, 'Shoot Out', 'shootout.swf', 'shootout', 3, 550, '380', 0, 0, 2),
(96, 'maptest1.gif', 'See if you should have realy Graduated', 0, 0, 0, 'Map Test', 'maptest.swf', 'maptest', 3, 550, '380', 0, 0, 6),
(97, 'seafishing1.gif', 'Meet the Quata, Move to the next round..', 0, 0, 0, 'Sea Fishing', 'seafishing.swf', 'seafishing', 3, 550, '380', 0, 0, 2),
(98, 'boogerflick1.gif', 'Flick some Boogers at some Flys, lmao', 0, 0, 0, 'Booger Flick', 'boogerflick.swf', 'boogerflick', 3, 550, '380', 0, 0, 3),
(99, 'flashpoker1.gif', 'Poker Card Game', 0, 0, 0, 'Flash Poker', 'flashpoker.swf', 'flashpoker', 3, 550, '380', 0, 0, 7),
(100, 'ducktracker1.gif', 'Hunt some Ducks', 0, 0, 0, 'Duck Tracker', 'ducktracker.swf', 'ducktracker', 3, 550, '380', 0, 0, 2),
(101, 'kickups1.gif', 'Keep the ball in the air as long as you can..', 0, 0, 0, 'Kick Up', 'kickups.swf', 'kickups', 3, 550, '380', 0, 0, 6),
(102, 'solitaire1.gif', 'Card Game', 0, 0, 0, 'Solitaire', 'solitaire.swf', 'solitaire', 3, 550, '380', 0, 0, 7),
(103, 'paintball1.gif', 'Shoot the Smileys...', 0, 0, 0, 'Paintball Shoot', 'paintball.swf', 'paintball', 3, 550, '380', 0, 0, 2),
(104, 'makaigrandprix21.gif', 'Grand Prix Racing..', 0, 0, 0, 'Makai Grand Prix2', 'makaigrandprix2.swf', 'makaigrandprix2', 3, 550, '380', 0, 0, 4),
(105, 'mariocatcher1.gif', 'Catch the Mario\'s as they fall...', 0, 0, 0, 'Mario Catcher', 'mariocatcher.swf', 'mariocatcher', 3, 550, '380', 0, 0, 2),
(106, 'rocketmx1.gif', 'MX riding. perform stunts..', 0, 0, 0, 'Rockett MX', 'rocketmx.swf', 'rocketmx', 3, 550, '380', 0, 0, 2),
(107, 'yeti1_5shots1.gif', 'Batter up...', 0, 0, 0, 'Yeti 5 Shot', 'yeti1_5shots.swf', 'yeti1_5shots', 3, 550, '380', 0, 0, 12),
(108, 'bloodypingu1.gif', 'see how for you can bat his head, lol....', 0, 0, 0, 'Bloody Peigiun', 'bloodypingu.swf', 'bloodypingu', 3, 550, '380', 0, 0, 12),
(110, 'stripdown1.gif', 'Click on 3 of the same color blocks, to reveal the babe! Half-Naked to nude to really nude!', 0, 0, 0, 'Strip Down', 'stripdown.swf', 'stripdown', 5, 550, '380', 0, 0, 10),
(111, 'pilsstrip1.gif', 'Catch the bottles to see the naked ladies.', 0, 0, 0, 'PilsStrip', 'pilsstrip.swf', 'pilsstrip', 5, 550, '380', 0, 0, 10),
(112, 'brasize1.gif', '100 Celebs, Guess thier Bra Sizes..', 0, 0, 0, 'Bra Size', 'brasize.swf', 'brasize', 3, 550, '380', 0, 0, 10),
(113, 'million21.gif', 'See if you are smart enough for the million..', 0, 0, 0, 'Who Wants To Be A Millionaire?', 'million2.swf', 'million2', 5, 550, '380', 0, 0, 6),
(157, 'bloodysealpp1.gif', '', 0, 0, 0, 'BloodySeal Bounce', 'bloodysealpp.swf', 'bloodysealpp', 4, 550, '380', 0, 0, 12),
(158, 'bloodyorcaspp2.gif', '', 0, 0, 0, 'Bloody Orca Slap', 'bloodyorcaspp.swf', 'bloodyorcaspp', 4, 550, '380', 0, 0, 12),
(115, 'MS.bmp', 'Collect money for...', 0, 0, 0, 'Money Strip', 'MoneyStrip.swf', 'MoneyStrip', 5, 550, '380', 0, 0, 10),
(116, '7upPinball1.gif', '', 0, 0, 0, '7UP PinBall', '7upPinball.swf', '7upPinball', 5, 550, '380', 0, 0, 12),
(117, 'hotrodpin1.gif', '', 0, 0, 0, 'HotRod PinBall', 'hotrodpin.swf', 'hotrodpin', 5, 550, '380', 0, 0, 12),
(118, 'pinball1.gif', '', 0, 0, 0, 'Xtreme PinBall', 'pinball.swf', 'pinball', 5, 550, '380', 0, 0, 12),
(119, 'piratesrevenge1.gif', '', 0, 0, 0, 'PiratesRevenge Slots', 'piratesrevenge.swf', 'piratesrevenge', 5, 550, '380', 0, 0, 8),
(120, 'slots30001.gif', 'casino slots', 0, 0, 0, 'Slots 3000', 'slots3000.swf', 'slots3000', 5, 550, '380', 0, 0, 8),
(121, 'brainiacibpa1.gif', 'See how skill you are, rember were the pictures are and match them up.', 0, 0, 0, 'Brainiac', 'brainiacibpa.swf', 'brainiacibpa', 5, 550, '380', 0, 0, 6),
(122, 'cyberslots1.gif', '', 0, 0, 0, 'Cyber Slots', 'cyberslots.swf', 'cyberslots', 5, 550, '380', 0, 0, 8),
(123, 'craps1.gif', 'Roll some Dice, try out your luck..', 0, 0, 0, 'Craps', 'craps.swf', 'craps', 5, 550, '380', 0, 0, 8),
(124, 'bejeweled1.gif', '', 0, 0, 0, 'BeJeweled', 'bejeweled.swf', 'bejeweled', 5, 550, '380', 0, 0, 6),
(125, 'babegame1.gif', 'The game of memory featuring 12 Playboy Playmates!', 0, 0, 0, 'Babes of Christmas', 'babegame.swf', 'babegame', 5, 550, '380', 0, 0, 10),
(126, 'goldminer1.gif', 'Collect the Qouted amount of money to advance to next level.', 0, 0, 0, 'Gold Miner', 'goldminer.swf', 'goldminer', 5, 550, '380', 0, 0, 2),
(128, 'filluptheboy1.gif', 'Fill up the boy with water.', 0, 0, 0, 'Fill up the Boy', 'filluptheboy.swf', 'filluptheboy', 5, 550, '380', 0, 0, 10),
(129, 'x227sm1.gif', 'An extreme tactical shooting game, hold on, you\'ll love it...', 0, 0, 0, 'x227', 'x227sm.swf', 'x227sm', 5, 550, '380', 0, 0, 2),
(130, 'rshot1.gif', 'hit the bullseye for top points..', 0, 0, 0, 'Target Shot', 'rshot.swf', 'rshot', 5, 550, '380', 0, 0, 2),
(133, 'pinguslap1.gif', 'Hit the lil water birds, hit the bulleye, if you can.', 0, 0, 0, 'PenguinSlap', 'pinguslap.swf', 'pinguslap', 3, 550, '380', 0, 0, 12),
(135, 'ctdhighjump1.gif', 'Crash the Dummy, hit the board as high as you can.', 0, 0, 0, 'CTD HighJump', 'ctdhighjump.swf', 'ctdhighjump', 3, 550, '380', 0, 0, 2),
(137, 'yetitoursm1.gif', 'Compete in a Yeti Tour', 0, 0, 0, 'Yeti AllStar Tour', 'yetitoursm.swf', 'yetitoursm', 3, 550, '380', 0, 0, 12),
(138, 'yeti_stagedive1.gif', '', 0, 0, 0, 'Yeti StageDive', 'yeti_stagedive.swf', 'yeti_stagedive', 5, 550, '380', 0, 0, 12),
(139, 'bowhunter1.gif', 'Click and pul mouse back, release button to fire, now go shoot some deer.', 0, 0, 0, 'Bow Hunter', 'bowhunter.swf', 'bowhunter', 5, 550, '380', 0, 0, 2),
(141, 'sealbounce.gif', 'Throw the penguin as high as you can', 0, 0, 0, 'Yeti Seal Bounce', 'sealbounce.swf', 'sealbounce', 3, 550, '380', 0, 0, 12),
(142, 'yeti7.gif', 'Yeti Snow Boarding', 0, 0, 0, 'Yeti Free Ride', 'yeti7.swf', 'yeti7', 3, 550, '380', 0, 0, 12),
(143, 'yeti4.gif', '', 0, 0, 0, 'Yeti Fly', 'yeti4.swf', 'yeti4', 3, 550, '380', 0, 0, 12),
(144, 'yeti5.gif', '', 0, 0, 0, 'Yeti Flamingo Drive', 'yeti5.swf', 'yeti5', 3, 550, '380', 0, 0, 12),
(145, 'yeti6.gif', '', 0, 0, 0, 'Yeti Big Wave', 'yeti6.swf', 'yeti6', 5, 550, '380', 0, 0, 12),
(147, 'yeti8GC1.gif', 'Number 8 installment of Yetisport games.', 0, 0, 0, 'YetiSports VIII Jungle Swing', 'yeti8GC.swf', 'yeti8GC', 4, 550, '400', 0, 0, 12),
(148, 'curveball1.gif', 'Try and keep up with the curving ball against the computer.', 0, 0, 0, 'Curve Ball', 'curveball.swf', 'curveball', 3, 550, '380', 0, 0, 6),
(170, 'simon1.gif', 'Colr Matching memory Test.', 0, 0, 0, 'Simon', 'simon.swf', 'simon', 3, 550, '380', 0, 0, 6),
(149, 'wallball.gif', 'Nice lil game, but watch out..', 0, 0, 0, 'Wall Ball', 'wallball.swf', 'wallball', 5, 550, '380', 0, 0, 6),
(150, 'missionbabylonSte2.gif', '', 0, 0, 0, 'MissionBabylonSte2', 'missionbabylonSte.swf', 'missionbabylonSte', 4, 550, '380', 0, 0, 5),
(151, 'hoslappin1.gif', 'Slap the Hell outta that hoe..', 0, 0, 0, 'Hoe Slappin', 'hoslappin.swf', 'hoslappin', 4, 550, '380', 0, 0, 10),
(152, 'bonkpong1.gif', '', 0, 0, 0, 'Bonk Pong', 'bonkpong.swf', 'bonkpong', 4, 550, '380', 0, 0, 10),
(153, 'nakedrun1.gif', '', 0, 0, 0, 'Naked Run', 'nakedrun.swf', 'nakedrun', 4, 550, '380', 0, 0, 10),
(154, 'orgasmgirl1.gif', '', 0, 0, 0, 'Orgasm Girl', 'orgasmgirl.swf', 'orgasmgirl', 5, 550, '380', 0, 0, 10),
(155, 'squirter1.gif', '', 0, 0, 0, 'Water Gun', 'squirter.swf', 'squirter', 4, 550, '380', 0, 0, 10),
(156, 'unrevealtournament1.gif', '', 0, 0, 0, 'UnRevealTournament', 'unrevealtournament.swf', 'unrevealtournament', 4, 550, '380', 0, 0, 10),
(162, 'asteroids1.gif', '', 0, 0, 0, 'Asteroids', 'asteroids.swf', 'asteroids', 3, 550, '380', 0, 0, 2),
(163, 'ping1.gif', '', 0, 0, 0, 'Ping', 'ping.swf', 'ping', 3, 550, '380', 0, 0, 2),
(164, 'watchout1.gif', '', 0, 0, 0, 'WatchOut', 'watchout.swf', 'watchout', 3, 550, '380', 0, 0, 2),
(165, 'jasonspong1.gif', '', 0, 0, 0, 'Jason\'s Pong', 'jasonspong.swf', 'jasonspong', 3, 550, '380', 0, 0, 6),
(166, 'ufoshoot1.gif', '', 0, 0, 0, 'UFO Shoot', 'ufoshoot.swf', 'ufoshoot', 3, 550, '380', 0, 0, 2),
(167, 'vforce1.gif', '', 0, 0, 0, 'V Force', 'vforce.swf', 'vforce', 3, 550, '380', 0, 0, 5),
(168, 'spaceinvaders1.gif', 'Classic Atari game here Boys.', 0, 0, 0, 'Space Invaders', 'spaceinvaders.swf', 'spaceinvaders', 3, 550, '380', 0, 0, 2),
(169, 'snakeman1.gif', '', 0, 0, 0, 'Snake Man', 'snakeman.swf', 'snakeman', 3, 550, '380', 0, 0, 2),
(172, 'crazyclosetsynergy.gif', 'Collect all the junk falling from the closet', 0, 0, 0, 'Crazy Closet Energy', 'crazyclosetsynergy.swf', 'crazyclosetsynergy', 3, 550, '380', 0, 0, 2),
(173, 'gyroball1.gif', 'One Hard azz Game, try to get the ball to it\'s destination Point.', 0, 0, 0, 'Gyro Ball', 'gyroball.swf', 'gyroball', 3, 550, '380', 0, 0, 6),
(174, 'hexxagon1.gif', 'One difficult game here boys', 0, 0, 0, 'HexxAgon', 'hexxagon.swf', 'hexxagon', 3, 550, '380', 0, 0, 6),
(175, 'threedsuper1.gif', 'One Hard Ball to get to hit the Target', 0, 0, 0, '3D Super ball', 'threedsuper.swf', 'threedsuper', 3, 550, '380', 0, 0, 6),
(176, 'ollie1.gif', ' Get Olie Home on a SkateBoard', 0, 0, 0, 'Ollie', 'ollie.swf', 'ollie', 3, 550, '380', 0, 0, 2),
(177, 'othello1.gif', 'Rwally hard matching Game', 0, 0, 0, 'Othello', 'othello.swf', 'othello', 3, 550, '380', 0, 0, 6),
(178, 'yankeegohome1.gif', '', 0, 0, 0, 'Knock Him Home', 'yankeegohome.swf', 'yankeegohome', 3, 550, '380', 0, 0, 3),
(179, 'wordup1.gif', 'Word Creation game off the Key Letter', 0, 0, 0, 'Word Up', 'wordup.swf', 'wordup', 3, 550, '380', 0, 0, 6),
(180, 'superhackysack1.gif', 'Kool azz game for playing Hacky Sack', 0, 0, 0, 'Super Hacky Sack', 'superhackysack.swf', 'superhackysack', 3, 550, '380', 0, 0, 2),
(181, 'falldown1.gif', 'Keep the Ball falling as long as you can.', 0, 0, 0, 'Fall Down', 'falldown.swf', 'falldown', 3, 550, '380', 1720, 0, 2),
(182, 'celebfight1.gif', 'Try out your boxing skills, whoop the shitnitz outta a Celebrity..', 0, 0, 0, 'Celebrity Fight Club', 'celebfight.swf', 'celebfight', 5, 550, '380', 0, 0, 10),
(183, 'donkeykong1.gif', 'Original Atari DonkeyKong', 0, 0, 0, 'DonkeKong Classic', 'donkeykong.swf', 'donkeykong', 3, 550, '380', 0, 0, 2),
(184, 'contra1.gif', 'Classic Original.', 0, 0, 0, 'Contra', 'contra.swf', 'contra', 5, 550, '380', 0, 0, 2),
(185, 'elemigrante1.gif', 'Avoid the police for as long as you possibly can!', 0, 0, 0, 'El Emigrante', 'elemigrante.swf', 'elemigrante', 3, 550, '380', 0, 0, 2),
(186, 'powerdriver1.gif', 'Golf Driving Range', 0, 0, 0, 'Power Drive', 'powerdriver.swf', 'powerdriver', 5, 550, '380', 0, 0, 2),
(187, 'likejailbait1.gif', 'Check this to see how ell you know if it Jail Bait Or Not..', 0, 0, 0, 'Like Jail Bait?', 'likejailbait.swf', 'likejailbait', 3, 550, '380', 1780, 0, 10),
(188, 'worldcycle1.gif', '', 0, 0, 0, 'World Cycle Tour', 'worldcycle.swf', 'worldcycle', 3, 550, '380', 0, 0, 4),
(189, 'footballpass1.gif', 'Be Accurate, Win Big..', 0, 0, 0, 'FootBall Pass', 'footballpass.swf', 'footballpass', 3, 550, '380', 0, 0, 2),
(191, 'angrywizard1.gif', '', 0, 0, 0, 'Angry Ole Wizard', 'angrywizard.swf', 'angrywizard', 3, 550, '380', 1810, 0, 2),
(192, 'netblazer3d1.gif', 'Be Accurate in shooting some hoops, 3D Style!!', 0, 0, 0, 'NetBlazer 3D', 'netblazer3d.swf', 'netblazer3d', 3, 550, '380', 0, 0, 2),
(193, 'roboxer1.gif', 'Ultimate Robot Boxing..', 0, 0, 0, 'RoBoxer', 'roboxer.swf', 'roboxer', 3, 550, '380', 0, 0, 2),
(194, 'turbospirit1.gif', 'Sprint from check point to check point on a turbo cycle', 0, 0, 0, 'Turbo Sprint Cycle', 'turbospirit.swf', 'turbospirit', 3, 550, '380', 0, 0, 4),
(195, 'racetoexcel1.gif', 'Bash the Cars to Excel to next round', 0, 0, 0, 'Race to Excel', 'racetoexcel.swf', 'racetoexcel', 3, 550, '380', 0, 0, 4),
(196, 'halflife21.gif', 'Half Life 2 Expert Shooting', 0, 0, 0, 'Half Life 2 Total Mayhem', 'halflife2.swf', 'halflife2', 3, 550, '380', 0, 0, 2),
(197, 'frogger1.gif', '', 0, 0, 0, 'Frogger 2', 'frogger.swf', 'frogger', 3, 550, '380', 0, 0, 2),
(198, 'neverland1.gif', 'Now is this a srewed up game or what..', 0, 0, 0, 'Neverland Escape', 'neverland.swf', 'neverland', 3, 550, '380', 0, 0, 3),
(199, 'blliquors1.gif', 'Bust Ben Laudian\'s  azz', 0, 0, 0, 'Ben Laudin Liquors', 'blliquors.swf', 'blliquors', 3, 550, '380', 0, 0, 2),
(200, 'chopper1.gif', 'Do your best manuvering to score high..', 0, 0, 0, 'Chopper Challege', 'chopper.swf', 'chopper', 3, 550, '380', 0, 0, 5),
(201, 'yeti9sm1.gif', 'Yeti Sports 9 Final, Lama spit', 0, 0, 0, 'Yeti 9 Final', 'yeti9sm.swf', 'yeti9sm', 4, 550, '380', 0, 0, 12),
(202, 'popupkill1.gif', 'Kill the annoying Pop Ups', 0, 0, 0, 'PopUp Kill', 'popupkill.swf', 'popupkill', 3, 550, '380', 0, 0, 6),
(203, 'castle_defender.gif', 'Keep the oponents off aslong as you can.', 0, 0, 0, 'Castle Defend V2', 'castle_defender.swf', 'castle_defender', 5, 550, '380', 0, 0, 2),
(204, 'crabvb1.gif', 'Try and win , being you are a Crab, you are slow..., lol', 0, 0, 0, 'Crab Volley Ball', 'crabvb.swf', 'crabvb', 3, 550, '380', 0, 0, 2),
(214, 'qbert20041.gif', '', 0, 0, 0, 'Qbert 2004', 'qbert2004.swf', 'qbert2004', 3, 550, '380', 0, 0, 2),
(205, 'bottleshoot1.gif', 'Shoot some bottles, and a few other obstacles that get thrown at ya..', 0, 0, 0, 'Bottle Shoot', 'bottleshoot.swf', 'bottleshoot', 3, 550, '380', 0, 0, 2),
(206, 'asteroids20031.gif', '', 0, 0, 0, 'Asteroids 2003', 'asteroids2003.swf', 'asteroids2003', 3, 550, '380', 0, 0, 2),
(207, 'jugglechallenge1.gif', 'Mario\'s Jungle Chenge adventure', 0, 0, 0, 'Juggle Challenge', 'jugglechallenge.swf', 'jugglechallenge', 3, 550, '380', 0, 0, 2),
(209, 'junglescape1.gif', 'Mario\'s Jungle Escape', 0, 0, 0, 'Jungle Escape', 'junglescape.swf', 'junglescape', 3, 550, '380', 1990, 0, 2),
(210, 'teddyswim1.gif', '', 0, 0, 0, 'Teddy\'s Swim', 'teddyswim.swf', 'teddyswim', 3, 550, '380', 0, 0, 2),
(213, 'pooljam1.gif', 'Pool Sharp Shooting, I guess, lol', 0, 0, 0, 'Pool Jam', 'pooljam.swf', 'pooljam', 3, 550, '380', 0, 0, 6),
(215, 'qb_challenge1.gif', '', 0, 0, 0, 'QB Challenge', 'qb_challenge.swf', 'qb_challenge', 3, 550, '380', 0, 0, 2),
(216, 'rollinxpinball1.gif', '', 0, 0, 0, 'Rollin X Pinball', 'rollinxpinball.swf', 'rollinxpinball', 3, 550, '380', 0, 0, 12),
(219, 'starskynhutchpb1.gif', '', 0, 0, 0, 'Starsky N Hutch PinBall', 'starsky-n-hutch.swf', 'starsky-n-hutch', 5, 500, '560', 0, 0, 12),
(220, 'sonic1.gif', 'SEGA\'s Sonic Hedge Hog Classic', 0, 0, 0, 'Sonic', 'sonic.swf', 'sonic', 3, 550, '380', 0, 0, 2),
(221, 'blackjackbbt1.gif', 'Black Jack', 0, 0, 0, 'Black Jack V1', 'blackjackbbt.swf', 'blackjackbbt', 3, 550, '380', 0, 0, 8);

-- --------------------------------------------------------

--
-- Table structure for table `titanium_bbhackgame`
--

DROP TABLE IF EXISTS `titanium_bbhackgame`;
CREATE TABLE `titanium_bbhackgame` (
  `user_id` mediumint(8) NOT NULL DEFAULT 0,
  `game_id` mediumint(8) NOT NULL DEFAULT 0,
  `date_hack` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `titanium_bbscores`
--

DROP TABLE IF EXISTS `titanium_bbscores`;
CREATE TABLE `titanium_bbscores` (
  `game_id` mediumint(8) NOT NULL DEFAULT 0,
  `user_id` mediumint(8) NOT NULL DEFAULT 0,
  `score_game` int(11) NOT NULL DEFAULT 0,
  `score_date` int(11) NOT NULL DEFAULT 0,
  `score_time` int(11) NOT NULL DEFAULT 0,
  `score_set` mediumint(8) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `titanium_bbarcade`
--
ALTER TABLE `titanium_bbarcade`
  ADD PRIMARY KEY (`arcade_name`);

--
-- Indexes for table `titanium_bbarcade_categories`
--
ALTER TABLE `titanium_bbarcade_categories`
  ADD KEY `arcade_catid` (`arcade_catid`);

--
-- Indexes for table `titanium_bbauth_arcade_access`
--
ALTER TABLE `titanium_bbauth_arcade_access`
  ADD KEY `group_id` (`group_id`),
  ADD KEY `arcade_catid` (`arcade_catid`);

--
-- Indexes for table `titanium_bbgames`
--
ALTER TABLE `titanium_bbgames`
  ADD KEY `game_id` (`game_id`);

--
-- Indexes for table `titanium_bbscores`
--
ALTER TABLE `titanium_bbscores`
  ADD KEY `game_id` (`game_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `titanium_bbarcade_categories`
--
ALTER TABLE `titanium_bbarcade_categories`
  MODIFY `arcade_catid` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `titanium_bbgames`
--
ALTER TABLE `titanium_bbgames`
  MODIFY `game_id` mediumint(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
