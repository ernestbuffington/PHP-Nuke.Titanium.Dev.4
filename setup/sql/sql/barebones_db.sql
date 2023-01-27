SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

DROP TABLE IF EXISTS `nuke_answer`;
CREATE TABLE `nuke_answer` (
  `user_id` int(11) NOT NULL,
  `questionID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `askedDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `text` varchar(300) DEFAULT NULL,
  `voteValue` int(11) DEFAULT 0,
  `isAccepted` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS `nuke_answer_vote`;
CREATE TABLE `nuke_answer_vote` (
  `answerID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `directionOfVote` enum('DOWN','UP') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS `nuke_question`;
CREATE TABLE `nuke_question` (
  `user_id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `askedDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `title` varchar(200) DEFAULT NULL,
  `text` varchar(300) DEFAULT NULL,
  `voteValue` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS `nuke_question_tag`;
CREATE TABLE `nuke_question_tag` (
  `questionID` int(11) DEFAULT NULL,
  `tagID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS `nuke_question_vote`;
CREATE TABLE `nuke_question_vote` (
  `questionID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `directionOfVote` enum('DOWN','UP') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS `nuke_tag`;
CREATE TABLE `nuke_tag` (
  `user_id` int(11) NOT NULL,
  `isDisabled` bit(1) DEFAULT b'0',
  `name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `nuke_tag` (`user_id`, `isDisabled`, `name`) VALUES
(1, b'0', 'python'),
(2, b'0', 'php'),
(3, b'0', 'c++'),
(4, b'0', 'javascript'),
(5, b'0', 'sql');

DROP TABLE IF EXISTS `nuke_users`;

ALTER TABLE `nuke_answer`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `userID` (`userID`),
  ADD KEY `questionID` (`questionID`);
ALTER TABLE `nuke_answer` ADD FULLTEXT KEY `text` (`text`);

ALTER TABLE `nuke_answer_vote`
  ADD KEY `userID` (`userID`),
  ADD KEY `answerID` (`answerID`);

ALTER TABLE `nuke_question`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `userID` (`userID`);
ALTER TABLE `nuke_question` ADD FULLTEXT KEY `title` (`title`,`text`);

ALTER TABLE `nuke_question_tag`
  ADD KEY `questionID` (`questionID`),
  ADD KEY `tagID` (`tagID`);

ALTER TABLE `nuke_question_vote`
  ADD KEY `userID` (`userID`),
  ADD KEY `questionID` (`questionID`);

ALTER TABLE `nuke_tag`
  ADD PRIMARY KEY (`user_id`);

ALTER TABLE `nuke_users`
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `user_email` (`user_email`);

ALTER TABLE `nuke_answer`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `nuke_question`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `nuke_tag`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `nuke_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `nuke_answer`
  ADD CONSTRAINT `nuke_answer_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `nuke_users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nuke_answer_ibfk_2` FOREIGN KEY (`questionID`) REFERENCES `nuke_question` (`user_id`) ON DELETE CASCADE;

ALTER TABLE `nuke_answer_vote`
  ADD CONSTRAINT `nuke_answer_vote_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `nuke_users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nuke_answer_vote_ibfk_2` FOREIGN KEY (`answerID`) REFERENCES `nuke_answer` (`user_id`) ON DELETE CASCADE;

ALTER TABLE `nuke_question`
  ADD CONSTRAINT `nuke_question_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `nuke_users` (`user_id`) ON DELETE CASCADE;

ALTER TABLE `nuke_question_tag`
  ADD CONSTRAINT `nuke_question_tag_ibfk_1` FOREIGN KEY (`questionID`) REFERENCES `nuke_question` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nuke_question_tag_ibfk_2` FOREIGN KEY (`tagID`) REFERENCES `nuke_tag` (`user_id`) ON DELETE CASCADE;

ALTER TABLE `nuke_question_vote`
  ADD CONSTRAINT `nuke_question_vote_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `nuke_users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nuke_question_vote_ibfk_2` FOREIGN KEY (`questionID`) REFERENCES `nuke_question` (`user_id`) ON DELETE CASCADE;
COMMIT;
