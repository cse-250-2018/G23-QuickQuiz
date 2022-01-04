CREATE TABLE `comments` (
  `id` int(32) NOT NULL,
  `lvl` int(11) NOT NULL,
  `par` int(32) NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp(),
  `user` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `votes` int(32) NOT NULL DEFAULT 0,
  `content` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
