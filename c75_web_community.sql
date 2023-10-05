create database c75_web_community;
use c75_web_community;

CREATE TABLE `article` (
  `user_email` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(128) NOT NULL,
  `body_text` varchar(128) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `relevant_file_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `files` (
  `user_email` varchar(30) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `keywords` varchar(128) NOT NULL,
  `relevant_file_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `user` (
  `email` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `photo_path` varchar(70) DEFAULT NULL,
  `bio` varchar(100) DEFAULT NULL,
  `cv_path` varchar(50) DEFAULT NULL,
  `experience` varchar(20) DEFAULT NULL,
  `level_experience` int(11) DEFAULT NULL,
  `interest` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


ALTER TABLE `article`
  ADD PRIMARY KEY (`user_email`,`title`);


ALTER TABLE `files`
  ADD PRIMARY KEY (`user_email`,`title`);


ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);


ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
