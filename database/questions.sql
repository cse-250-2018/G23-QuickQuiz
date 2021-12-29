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
  `difficulty` varchar(20) NOT NULL DEFAULT 'easy'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `exam`, `quiz`, `question`, `answer`, `course`, `marks`, `difficulty`) VALUES
(1, 1, -1, 'What is the capital of Bangladesh?', 2, 'Structured Programming Language', 1, 'easy'),
(2, 2, -1, 'Which of the following is most powerful?', 2, 'Structured Programming Language', 2, 'easy'),
(3, 2, -1, 'Whatever can be solved with a DFA can also be solved with a NFA', 0, 'Structured Programming Language', 1, 'easy'),
(4, 2, -1, 'Which algorithm finds MST?', 1, 'Structured Programming Language', 2, 'easy'),
(5, 2, -1, 'Does this problem requires fft to solve it?', 1, 'Structured Programming Language', 3, 'easy'),
(6, 2, -1, 'Tito kala pare?', 1, 'Structured Programming Language', 1, 'easy'),
(7, 3, -1, 'Is there any question?', 0, 'Structured Programming Language', 5, 'easy'),
(8, 3, -1, 'Did you read python inorder to answer these question?', 0, 'Structured Programming Language', 3, 'easy'),
(9, 4, -1, 'sdfa', 0, 'others', 1, 'easy'),
(10, 4, -1, 'ad', 0, 'others', 1, 'easy'),
(11, 4, -1, '3', 0, 'others', 1, 'easy'),
(12, 4, -1, '5', 0, 'others', 1, 'easy'),
(13, 5, -1, 'b', 0, 'others', 1, 'easy'),
(14, 5, -1, 'e', 0, 'others', 1, 'easy'),
(15, 5, -1, 'h', 0, 'others', 1, 'easy'),
(16, 6, -1, 'Is this a valid question?', 0, 'Structured Programming Language', 4, 'easy'),
(17, 6, -1, 'Did you read fft to solve this question?', 0, 'Structured Programming Language', 1, 'easy'),
(18, 7, -1, 'daff waeofj wae wf eowaefj aw fowief aw foiwae a faweifaw e', 0, 'others', 1, 'easy'),
(19, 7, -1, 'afwijewf wfoiejf aw fowiwef afwioehfja ', 0, 'others', 1, 'easy'),
(20, 7, -1, 'fwaoif weoif fawoifw wfwa', 0, 'others', 1, 'easy'),
(21, 8, -1, 'FGh sdghj sdghj', 1, 'others', 1, 'easy'),
(22, 8, -1, 'FHJ ', 0, 'others', 1, 'easy'),
(23, 11, -1, '-2  3 = ?', 2, 'Discrete Math', 2, 'hard'),
(24, 11, -1, 'How are you?', 1, 'Discrete Math', 5, 'hard'),
(25, 12, -1, 'Is there any bug?', 1, 'Structured Programming Language', 4, 'medium'),
(26, 13, -1, 'Bug?', 0, 'Operating System', 4, 'medium'),
(27, 13, -1, 'Tired?', 1, 'Operating System', 4, 'medium'),
(28, 14, -1, 'Why?', 0, 'Operating System', 1, 'easy'),
(29, 14, -1, 'why why medium', 0, 'Discrete Math', 2, 'easy'),
(30, 15, -1, 'Bug? spl 2 easy', 1, 'Discrete Math', 1, 'easy'),
(31, 15, -1, 'Check? OOP 5 hard', 1, 'Object Oriented Programming', 5, 'hard'),
(32, 16, -1, 'g', 0, 'others', 2, 'easy'),
(33, -1, 1, 'Which data type cannot be checked in switch-case statement?', 2, 'Structured Programming Language', 3, 'medium'),
(34, -1, 1, 'How would you round off a value from 1.66 to 2.0?', 1, 'Structured Programming Language', 1, 'easy'),
(35, -1, 2, 'Is an empty .java file a valid source file?', 0, 'Object Oriented Programming', 1, 'easy'),
(36, -1, 2, 'What is Abstraction?', 1, 'Object Oriented Programming', 2, 'easy'),
(37, -1, 2, 'What is the size of int variable? (in bit)', 2, 'Object Oriented Programming', 1, 'easy'),
(38, -1, 2, 'When finally block gets executed?', 1, 'Object Oriented Programming', 2, 'medium');
