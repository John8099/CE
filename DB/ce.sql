-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2021 at 05:38 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `password` longtext NOT NULL,
  `createAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fname`, `mname`, `lname`, `email`, `uname`, `password`, `createAt`) VALUES
(5, 'Sample', 'S', 'Sample', 'smpl@sample.com', 'smpl', '$argon2i$v=19$m=65536,t=4,p=1$aWdCQzNCVmtEWXYvZ2NIVA$XZJP7Ph78kvTdEj7RSsgLL9cBVzQT3XMsm3bobJFn9Y', '2021-02-22 04:31:34');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course` varchar(100) NOT NULL,
  `category` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course`, `category`) VALUES
(4, 'BS in Accounting Technology ', 'Math'),
(5, 'BS in Nursing ', 'Science'),
(6, 'BS in Tourism Management ', 'English'),
(7, 'BS in Criminology (ETEEAP) ', 'Science'),
(8, 'BS in Civil Engineering ', 'Math'),
(9, 'BS Agricultural Chemistry', 'Science'),
(10, 'BS in Business Administration Major in (Marketing Management)', 'English'),
(11, 'BS in Elementary Education', 'English'),
(12, 'BS in Marine Engineering', 'Math');

-- --------------------------------------------------------

--
-- Table structure for table `examresults`
--

CREATE TABLE `examresults` (
  `id` int(11) NOT NULL,
  `json_result` longtext NOT NULL,
  `totalScores` varchar(32) NOT NULL,
  `goodAt` varchar(50) NOT NULL,
  `student_id` int(11) NOT NULL,
  `createAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `examresults`
--

INSERT INTO `examresults` (`id`, `json_result`, `totalScores`, `goodAt`, `student_id`, `createAt`) VALUES
(1, '{\"english\":{\"number=1\":\"wrong\",\"number=2\":\"correct\",\"number=3\":\"wrong\",\"number=4\":\"correct\",\"number=5\":\"wrong\",\"number=6\":\"correct\",\"number=7\":\"wrong\",\"number=8\":\"correct\",\"number=9\":\"wrong\",\"number=10\":\"wrong\"},\"engPoints\":4,\"math\":{\"number=1\":\"wrong\",\"number=2\":\"wrong\",\"number=3\":\"wrong\",\"number=4\":\"wrong\",\"number=5\":\"wrong\",\"number=6\":\"wrong\",\"number=7\":\"wrong\",\"number=8\":\"correct\",\"number=9\":\"correct\",\"number=10\":\"correct\"},\"mathPoints\":3,\"science\":{\"number=1\":\"wrong\",\"number=2\":\"wrong\",\"number=3\":\"wrong\",\"number=4\":\"correct\",\"number=5\":\"wrong\",\"number=6\":\"wrong\",\"number=7\":\"wrong\",\"number=8\":\"correct\",\"number=9\":\"correct\",\"number=10\":\"correct\"},\"sciPoints\":4}', '11/30', 'english|math|', 1, '2021-02-22 04:35:44'),
(2, '{\"english\":{\"number=1\":\"wrong\",\"number=2\":\"wrong\",\"number=3\":\"correct\",\"number=4\":\"wrong\",\"number=5\":\"wrong\",\"number=6\":\"correct\",\"number=7\":\"wrong\",\"number=8\":\"wrong\",\"number=9\":\"wrong\",\"number=10\":\"wrong\"},\"engPoints\":2,\"math\":{\"number=1\":\"wrong\",\"number=2\":\"wrong\",\"number=3\":\"wrong\",\"number=4\":\"correct\",\"number=5\":\"correct\",\"number=6\":\"wrong\",\"number=7\":\"wrong\",\"number=8\":\"correct\",\"number=9\":\"wrong\",\"number=10\":\"wrong\"},\"mathPoints\":3,\"science\":{\"number=1\":\"wrong\",\"number=2\":\"wrong\",\"number=3\":\"wrong\",\"number=4\":\"wrong\",\"number=5\":\"wrong\",\"number=6\":\"wrong\",\"number=7\":\"wrong\",\"number=8\":\"correct\",\"number=9\":\"wrong\",\"number=10\":\"wrong\"},\"sciPoints\":1}', '6/30', 'math|', 1, '2021-02-22 04:35:54');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` int(11) NOT NULL,
  `category` varchar(32) NOT NULL,
  `question` longtext NOT NULL,
  `c1` longtext NOT NULL,
  `c2` longtext NOT NULL,
  `c3` longtext NOT NULL,
  `c4` longtext NOT NULL,
  `answer` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `category`, `question`, `c1`, `c2`, `c3`, `c4`, `answer`) VALUES
(1, 'math', 'What is the sum of 130+125+191?', '335', ' 456', '446', '426', '446'),
(2, 'math', 'If we minus 712 from 1500, how much do we get?', '788', '778', '768', '758', '788'),
(3, 'math', '50 times of 8 is equal to?', '80', '400', '800', '4000', '400'),
(4, 'math', '110 divided by 10 is:', '11', '10', '5', 'None of these', '11'),
(5, 'math', '20+(90÷2) is equal to:', '50', '55', '65', '60', '65'),
(6, 'math', 'The product of 82 and 5 is:', '400', '410', '420', 'None of these', '410'),
(7, 'math', 'Find the missing terms in multiple of 3: 3, 6, 9, __, 15', '10', '11', '12', '13', '12'),
(8, 'math', 'Solve 24÷8+2.', '5', '6', '8', '12', '5'),
(9, 'math', 'Solve: 300 – (150×2)', '150', '100', '50', '0', '0'),
(10, 'math', 'The product of 121 x 0 x 200 x 25 is', '1500', '0', '4000', 'None of these', '0'),
(11, 'english', 'You __ make noise in this area online classes are going on.', 'Can', 'Must', 'Mustn\'t', 'Don\'t have to', 'Mustn\'t'),
(12, 'english', 'Watch watch out for that car jose you ___ look both ways before you step into the street.', 'can', 'Had to', 'Must', 'Should', 'Should'),
(13, 'english', 'This type of communicative style rarely or never changes.', 'Frozen', 'Formal', 'Conversational', 'Intimate', 'Frozen'),
(14, 'english', '\"All the world\'s stage and all the men and women merely____\".', 'Puppets', 'Actor\'s', 'Players', 'Dummies', 'Players'),
(15, 'english', 'It applies to conversational experiences between and/ or among people who share private relationship.', 'Frozen', 'Casual', 'Formal', 'Intimate', 'Intimate'),
(16, 'english', '(Parent to child ) You _ do your homework before watching television.', 'Mustn\'t ', 'Can', 'Could', 'Must', 'Must'),
(17, 'english', 'This is an informal languages used by friends and peers.', 'Frozen', 'Casual', 'Formal', 'Consultative', 'Casual'),
(18, 'english', 'The desk was made from wood and metal.', 'Sensory image', 'None', 'Figurative imagery', 'Literal imagery', 'Sensory image'),
(19, 'english', '\"Creeping like a snail\" is an example of.', 'Metaphor', 'Alliteration', 'Personification', 'Simile', 'Simile'),
(20, 'english', 'The poem, \"the seven ages of man\" is written by', 'William wordsworth', 'William shakespeare', 'William golding', 'Alfred lord tennesy', 'William shakespeare'),
(21, 'science', 'Which of the following is a large blood vessel that carries blood away from the heart?', 'Vein', 'Artery', 'Capillary', 'Nerve', 'Artery'),
(22, 'science', 'Which of the following is not a member of the vitamin B complex?', 'Thiamine', 'Riboflavin', 'Folic acid', 'Ascorbic acid', 'Ascorbic acid'),
(23, 'science', 'Fungi are plants that lack:', 'Oxygen', 'Carbon dioxide', 'Chlorophyll', 'None of these', 'Chlorophyll'),
(24, 'science', 'What makes a reptile a reptile?', 'Cold blooded', 'Warm Blooded', 'Non-Hearing', 'Egg-laying', 'Egg-laying'),
(25, 'science', 'Which blood vessels have the smallest diameter?', 'Capillaries', 'Arterioles', 'Venules', 'Capillaries', 'Capillaries'),
(26, 'science', 'Which of the following is an air-borne disease?', 'Measles', 'Typhoid', 'Pink eye', 'None of the above', 'Measles'),
(27, 'science', 'A yellow dust appears on the fingers, whenever we touch the middle of a flower. These tiny yellow grains are one of the most precious substances in nature because they contain the secret of plant life.  What is this dust called?', 'Pollen', 'Sperm', 'Spore', 'Sporocyst', 'Pollen'),
(28, 'science', 'Which organ of the body produces the fluid known as bile?', 'Liver', 'Pancreas', 'Gall bladder', 'Kidney', 'Liver'),
(29, 'science', 'Which of the following hormones is a steroid?', 'Estrogen', 'Glucagon', 'Insulin', 'Oxytocin', 'Estrogen'),
(30, 'science', 'Which one of the following is not a function of the liver?', 'Regulation of blood sugar', 'Enzyme activation', 'Detoxification', 'Reproduction', 'Reproduction');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `student_fname` varchar(100) NOT NULL,
  `student_mname` varchar(100) NOT NULL,
  `student_lname` varchar(100) NOT NULL,
  `student_home_add` longtext NOT NULL,
  `gender` varchar(32) NOT NULL,
  `student_birthday` date NOT NULL,
  `religion` longtext NOT NULL,
  `civil_status` varchar(32) NOT NULL,
  `contact_number` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `father_name` varchar(100) NOT NULL,
  `father_occupation` varchar(100) NOT NULL,
  `mother_name` varchar(100) NOT NULL,
  `mother_occupation` varchar(100) NOT NULL,
  `password` longtext NOT NULL,
  `createAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_fname`, `student_mname`, `student_lname`, `student_home_add`, `gender`, `student_birthday`, `religion`, `civil_status`, `contact_number`, `email`, `father_name`, `father_occupation`, `mother_name`, `mother_occupation`, `password`, `createAt`) VALUES
(1, 'sample', 'sample', 'sample', 'samplesample', 'female', '2020-12-11', 'sample', 'single', 9827182, 'sample@sample.com', 'sample', 'sample', 'sample', 'sample', '$argon2i$v=19$m=65536,t=4,p=1$cTY5OXhtTjluTjRsV01RSg$bbqX/Z53vROeClXAF0fUQ9hYE96JEDrxVoriRk9hh6M', '2021-02-22 04:37:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `examresults`
--
ALTER TABLE `examresults`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `examresults`
--
ALTER TABLE `examresults`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
