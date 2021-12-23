--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `exam` int(11) DEFAULT NULL,
  `question` varchar(200) NOT NULL,
  `answer` int(11) NOT NULL,
  `course` varchar(255) NOT NULL DEFAULT 'others',
  `marks` int(5) NOT NULL DEFAULT 1,
  `difficulty` varchar(20) NOT NULL DEFAULT 'easy'
)
