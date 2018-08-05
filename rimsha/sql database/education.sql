-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2018 at 01:05 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `education`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_about`
--

CREATE TABLE IF NOT EXISTS `admin_about` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `p_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `about` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `admin_about`
--

INSERT INTO `admin_about` (`id`, `p_id`, `user_id`, `about`) VALUES
(1, 1, 4, 0x496e2047637566207765206f666665727320427320436f6d707574657220536369656e6365),
(2, 3, 4, 0x41626f7574),
(3, 4, 4, 0x686868),
(6, 7, 4, 0x61626f7574),
(8, 9, 4, 0x53454c454354202a2046524f4d206061646d696e5f61626f75746020574845524520705f6964203d2039);

-- --------------------------------------------------------

--
-- Table structure for table `admin_a_schedule`
--

CREATE TABLE IF NOT EXISTS `admin_a_schedule` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `p_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `admission_date` varchar(255) NOT NULL,
  `test_date` varchar(255) NOT NULL,
  `test_venue` varchar(255) NOT NULL,
  `test_time` varchar(255) NOT NULL,
  `merit_date` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `admin_a_schedule`
--

INSERT INTO `admin_a_schedule` (`id`, `p_id`, `user_id`, `admission_date`, `test_date`, `test_venue`, `test_time`, `merit_date`) VALUES
(1, 1, 4, '2018-08-31', '2018-07-21', 'Faisalabad', '13:03', '2018-08-30'),
(2, 3, 4, '2018-07-18', '2018-07-21', 'Faisalabad', '21:12', '2018-08-22'),
(6, 7, 4, '2018-08-26', '', '', '', '2018-07-31');

-- --------------------------------------------------------

--
-- Table structure for table `admin_criteria_list`
--

CREATE TABLE IF NOT EXISTS `admin_criteria_list` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `p_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `t_seats` varchar(255) NOT NULL,
  `quota` varchar(255) NOT NULL,
  `punjab` varchar(255) NOT NULL,
  `sindh` varchar(255) NOT NULL,
  `kpk` varchar(255) NOT NULL,
  `bal` varchar(255) NOT NULL,
  `fed` varchar(255) NOT NULL,
  `fata` varchar(255) NOT NULL,
  `sports` varchar(255) NOT NULL,
  `handicaped` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `admin_criteria_list`
--

INSERT INTO `admin_criteria_list` (`id`, `p_id`, `user_id`, `t_seats`, `quota`, `punjab`, `sindh`, `kpk`, `bal`, `fed`, `fata`, `sports`, `handicaped`) VALUES
(1, 1, 4, '30', 'Quota System', '15', '15', '', '', '', '', '', ''),
(2, 3, 4, '30', 'Quota System', '15', '15', '', '', '', '', '', ''),
(6, 7, 4, '90', 'Quota System', '', '', '', '', '9', '9', '9', '9');

-- --------------------------------------------------------

--
-- Table structure for table `admin_e_criteria`
--

CREATE TABLE IF NOT EXISTS `admin_e_criteria` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `p_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `program` varchar(255) NOT NULL,
  `matric_marks` varchar(255) NOT NULL,
  `inter_marks` varchar(255) NOT NULL,
  `bachlor_marks` varchar(255) NOT NULL,
  `master_marks` varchar(255) NOT NULL,
  `mphil_marks` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `sat` varchar(255) NOT NULL,
  `hec` varchar(255) NOT NULL,
  `nat` varchar(255) NOT NULL,
  `nts` varchar(255) NOT NULL,
  `af_matric` varchar(255) NOT NULL,
  `af_inter` varchar(255) NOT NULL,
  `af_bachlor` varchar(255) NOT NULL,
  `af_master` varchar(255) NOT NULL,
  `af_mphil` varchar(255) NOT NULL,
  `ahq` varchar(255) NOT NULL,
  `aet` varchar(255) NOT NULL,
  `ait` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `admin_e_criteria`
--

INSERT INTO `admin_e_criteria` (`id`, `p_id`, `user_id`, `program`, `matric_marks`, `inter_marks`, `bachlor_marks`, `master_marks`, `mphil_marks`, `type`, `sat`, `hec`, `nat`, `nts`, `af_matric`, `af_inter`, `af_bachlor`, `af_master`, `af_mphil`, `ahq`, `aet`, `ait`) VALUES
(4, 4, 4, 'BA/BSC/BCOM/BBA', '99', '999', '', '', '', 'openMerit', '', '', '', '', '75', '12', '', '', '', '', '30', '5'),
(7, 3, 4, 'PHD', '50%', '50%', '', '', '', 'openMerit', '', '', '', '', '75', '15', '', '', '', '', '30', '5'),
(8, 1, 4, 'BS/MSC', '50%', '50%', '50%', '', '', 'openMerit', '', '', '', '', '', '', '', '', '', '', '30', '5'),
(10, 7, 4, 'PHD', '45', '45', '45', '45', '45', 'openMerit', '55', '', '', '555', '75', '10', '5', '', '', '', '5', '5');

-- --------------------------------------------------------

--
-- Table structure for table `admin_late_admission`
--

CREATE TABLE IF NOT EXISTS `admin_late_admission` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `p_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `late_title` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `admin_late_admission`
--

INSERT INTO `admin_late_admission` (`id`, `p_id`, `user_id`, `late_title`) VALUES
(1, 1, 4, 0x4c4154452041444d495353494f4e20504f4c4943592048455245),
(2, 3, 4, 0x506f6c696379),
(5, 6, 4, 0x706f6c696379),
(6, 7, 4, 0x706f6c696379);

-- --------------------------------------------------------

--
-- Table structure for table `admin_p_detail`
--

CREATE TABLE IF NOT EXISTS `admin_p_detail` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `p_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `uni_name` varchar(255) NOT NULL,
  `uni_program` varchar(255) NOT NULL,
  `uni_dept` varchar(255) NOT NULL,
  `uni_campus` varchar(255) NOT NULL,
  `max_duration` varchar(255) NOT NULL,
  `min_duration` varchar(255) NOT NULL,
  `t_courses` varchar(255) NOT NULL,
  `t_hours` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `admin_p_detail`
--

INSERT INTO `admin_p_detail` (`id`, `p_id`, `user_id`, `uni_name`, `uni_program`, `uni_dept`, `uni_campus`, `max_duration`, `min_duration`, `t_courses`, `t_hours`, `img`, `status`) VALUES
(1, 1, 4, 'gcuf', 'Bs Computer Science', 'Computer Science', 'Faisalabad Main Campus', '4 Years', '4 Years', '8', '3', 'Documentation.docx', '0'),
(4, 3, 4, 'gcuf', 'Bs Information technology', 'Computer Science', 'Faisalabad Main Campus', '4 Years', '4 Years', '8', '3', 'Muhammad Zahid Tufail-CV.pdf', '1'),
(6, 7, 4, 'gcuf', 'Physics', 'physics', 'fsd', '4 years', '4 years', '8', '20', 'Documentation1.docx', '1'),
(7, 9, 4, 'gcuf', 'Biology', 'op', 'o', 'po', 'po', 'p', 'op', 'Documentation.docx', '');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `subject` text NOT NULL,
  `message` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `phone`, `subject`, `message`) VALUES
(1, 'kk', 'k@gmail.com', 'kk', 'k', 0x6b),
(2, 'Rimsha', 'rimsha@gmail.com', '03148789783', 'testing', 0x6d6573736167652068657265);

-- --------------------------------------------------------

--
-- Table structure for table `course_enrolled`
--

CREATE TABLE IF NOT EXISTS `course_enrolled` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `p_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `cnic` varchar(255) NOT NULL,
  `marks` varchar(244) NOT NULL,
  `E_total` varchar(255) NOT NULL,
  `interview_marks` varchar(255) NOT NULL,
  `I_total` varchar(255) NOT NULL,
  `by_` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `course_enrolled`
--

INSERT INTO `course_enrolled` (`id`, `p_id`, `user_id`, `cnic`, `marks`, `E_total`, `interview_marks`, `I_total`, `by_`) VALUES
(53, 3, 6, '5320184998653', '78', '100', '10', '100', '4');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `toNot` varchar(255) NOT NULL,
  `fromNot` varchar(255) NOT NULL,
  `p_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `title`, `toNot`, `fromNot`, `p_id`) VALUES
(17, 'Yours Entry Test Marks 000 are added.', '', '4', ''),
(18, 'You have Cancel applied to  Physics program.', '6', '4', '7'),
(19, 'You have Cancel applied to  Physics program.', '6', '4', '7'),
(20, 'You have Cancel applied to  Physics program.', '6', '4', '7'),
(22, 'Student removed enroll from your programs', '4', '6', '7');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE IF NOT EXISTS `programs` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `status` int(255) NOT NULL,
  `p_status` varchar(255) NOT NULL,
  `fees` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `title`, `user_id`, `status`, `p_status`, `fees`) VALUES
(1, 'Bs Computer Science', 4, 0, 'Completed', '90000'),
(3, 'Bs Information technology', 4, 1, 'Completed', '1000'),
(7, 'Physics', 4, 1, 'Completed', '89000'),
(8, 'Bs Chemistry', 4, 0, '', ''),
(9, 'Biology', 4, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `student_address`
--

CREATE TABLE IF NOT EXISTS `student_address` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `permanent_address` varchar(255) NOT NULL,
  `city1` varchar(255) NOT NULL,
  `postal_address` varchar(255) NOT NULL,
  `city2` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `student_address`
--

INSERT INTO `student_address` (`id`, `user_id`, `permanent_address`, `city1`, `postal_address`, `city2`) VALUES
(1, 2, 'p', 'c', 'a', 'c');

-- --------------------------------------------------------

--
-- Table structure for table `student_doc_detail`
--

CREATE TABLE IF NOT EXISTS `student_doc_detail` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `img1` varchar(255) NOT NULL,
  `img2` varchar(255) NOT NULL,
  `img3` varchar(255) NOT NULL,
  `img4` varchar(255) NOT NULL,
  `img5` varchar(255) NOT NULL,
  `img6` varchar(255) NOT NULL,
  `img7` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `student_doc_detail`
--

INSERT INTO `student_doc_detail` (`id`, `user_id`, `img1`, `img2`, `img3`, `img4`, `img5`, `img6`, `img7`) VALUES
(2, 2, 'logo.png', 'logo.png', 'logo.png', 'logo.png', 'logo.png', 'logo.png', 'logo.png'),
(3, 6, 'logo.png', 'logo.png', 'logo.png', 'logo.png', 'logo.png', 'logo.png', 'logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `student_e_detail`
--

CREATE TABLE IF NOT EXISTS `student_e_detail` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `degree` varchar(255) NOT NULL,
  `ms_pass_year` varchar(255) NOT NULL,
  `bs_pass_year` varchar(255) NOT NULL,
  `ba_pass_year` varchar(255) NOT NULL,
  `fa_pass_year` varchar(255) NOT NULL,
  `ssc_pass_year` varchar(255) NOT NULL,
  `ms_uni_board` varchar(255) NOT NULL,
  `bs_uni_board` varchar(255) NOT NULL,
  `ba_uni_board` varchar(255) NOT NULL,
  `fa_uni_board` varchar(255) NOT NULL,
  `ssc_uni_board` varchar(255) NOT NULL,
  `ms_sub` varchar(255) NOT NULL,
  `bs_sub` varchar(255) NOT NULL,
  `ba_sub` varchar(255) NOT NULL,
  `fa_sub` varchar(255) NOT NULL,
  `ssc_sub` varchar(255) NOT NULL,
  `ms_max_marks` varchar(255) NOT NULL,
  `bs_max_marks` varchar(255) NOT NULL,
  `ba_max_marks` varchar(255) NOT NULL,
  `fa_max_marks` varchar(255) NOT NULL,
  `ssc_max_marks` varchar(255) NOT NULL,
  `ms_obtained` varchar(255) NOT NULL,
  `bs_obtained` varchar(255) NOT NULL,
  `ba_obtained` varchar(255) NOT NULL,
  `fa_obtained` varchar(255) NOT NULL,
  `ssc_obtained` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `student_e_detail`
--

INSERT INTO `student_e_detail` (`id`, `user_id`, `degree`, `ms_pass_year`, `bs_pass_year`, `ba_pass_year`, `fa_pass_year`, `ssc_pass_year`, `ms_uni_board`, `bs_uni_board`, `ba_uni_board`, `fa_uni_board`, `ssc_uni_board`, `ms_sub`, `bs_sub`, `ba_sub`, `fa_sub`, `ssc_sub`, `ms_max_marks`, `bs_max_marks`, `ba_max_marks`, `fa_max_marks`, `ssc_max_marks`, `ms_obtained`, `bs_obtained`, `ba_obtained`, `fa_obtained`, `ssc_obtained`) VALUES
(4, 6, 'BS/MSC', '2012', '2010', '2011', '2010', '2010', 'gcuf', 'gcuf', 'gcuf', 'Bahawalpur', 'Bahawalpur', 'english', 'english', 'english', 'bscs', 'english', '1100', '4', '1100', '1100', '850', '644', '3.4', '', '633', '629');

-- --------------------------------------------------------

--
-- Table structure for table `student_p_detail`
--

CREATE TABLE IF NOT EXISTS `student_p_detail` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `domicile` varchar(255) NOT NULL,
  `hq` varchar(255) NOT NULL,
  `cnic` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `handicaped` varchar(255) NOT NULL,
  `sm` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `student_p_detail`
--

INSERT INTO `student_p_detail` (`id`, `user_id`, `img`, `name`, `f_name`, `dob`, `gender`, `nationality`, `domicile`, `hq`, `cnic`, `mobile`, `email`, `handicaped`, `sm`) VALUES
(3, 6, '764070681_l.gif', 'Student', 'saleem', '2-FEB-1961', 'Male', 'Pakistani', 'Bahawalpur', 'no', '33098978787878', '03148767873', 'student@gmail.com', 'no', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `request` varchar(255) NOT NULL,
  `uni_name` varchar(255) NOT NULL,
  `created_date` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `pass`, `status`, `role`, `request`, `uni_name`, `created_date`) VALUES
(4, 'Admin', 'admin@gmail.com', '123', '0', 'admin', '', 'gcuf', '18-Jul-2018 04:12:48pm'),
(6, 'Student', 'student@gmail.com', '123', '0', 'student', '', 'gcuf', '18-Jul-2018 08:09:55pm'),
(7, 'Super Admin', 'superadmin@gmail.com', '123', '0', 'superadmin', '', '', '18-Jul-2018 04:12:48pm'),
(8, 'Mujahid', 'mujahid@gmail.com', '123', '0', 'admin', '', 'Gcuf', '24-Jul-2018 08:26:05pm');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
