--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `exam` int(11) DEFAULT -1,
  `quiz` int(11) NOT NULL DEFAULT -1,
  `question` varchar(200) DEFAULT NULL,
  `answer` int(11) NOT NULL,
  `course` varchar(255) NOT NULL DEFAULT 'others',
  `marks` int(5) NOT NULL DEFAULT 1,
  `difficulty` varchar(20) NOT NULL DEFAULT 'easy',
  `duplicate` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


