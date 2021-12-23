--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `author` varchar(150) NOT NULL,
  `startTime` datetime NOT NULL DEFAULT current_timestamp(),
  `endTime` datetime NOT NULL DEFAULT current_timestamp(),
  `isFinished` tinyint(1) NOT NULL DEFAULT 0
)
