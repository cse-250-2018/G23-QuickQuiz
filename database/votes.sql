
CREATE TABLE `votes` (
  `post` int(32) NOT NULL,
  `user` varchar(150) NOT NULL,
  `vote` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
