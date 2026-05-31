-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2023 at 02:59 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `collegealumnidb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(10) NOT NULL,
  `AdminName` varchar(120) DEFAULT NULL,
  `UserName` varchar(120) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `AdminName`, `UserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`) VALUES
(1, 'Admin', 'admin', 8979555558, 'admin@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2023-12-01 04:36:52');

-- --------------------------------------------------------

--
-- Table structure for table `tblalumni`
--

CREATE TABLE `tblalumni` (
  `ID` int(10) NOT NULL,
  `FullName` varchar(250) DEFAULT NULL,
  `CollegeID` varchar(250) DEFAULT NULL,
  `Gender` varchar(250) DEFAULT NULL,
  `Batch` varchar(250) DEFAULT NULL,
  `CourseGraduated` int(10) DEFAULT NULL,
  `CurrentlyConnected` varchar(250) DEFAULT NULL,
  `Image` varchar(250) DEFAULT NULL,
  `Emailid` varchar(255) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblalumni`
--

INSERT INTO `tblalumni` (`ID`, `FullName`, `CollegeID`, `Gender`, `Batch`, `CourseGraduated`, `CurrentlyConnected`, `Image`, `Emailid`, `Password`, `RegDate`) VALUES
(1, 'Rakesh', '2226765', 'Male', '2010-2014', 1, 'ABC', '3f3141ed3b2293aaa6b66587343daa091680536067.jpg', 'fhg@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2023-11-30 04:49:00'),
(3, 'Test', '3346767', 'Female', '2010-2014', 4, 'XYZ Company', 'a349f3cb7785a1195c68af349047b8081701348445.png', 'test@gmail.com', '202cb962ac59075b964b07152d234b70', '2023-11-30 05:48:22'),
(4, 'Karan Singh', '2346765', 'Male', '2012-2015', 11, 'XYZ Company', '69ba0bb2844b3131a4f15bbcc02bfede1701666938.png', 'karan@gmail.com', '202cb962ac59075b964b07152d234b70', '2023-12-04 05:15:38'),
(5, 'Anuj kumar', '10806121', 'Male', 'IT', 1, 'HCL', 'e9841dd659b6d7b628f99926d60c8a561702316770.png', 'ak30@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2023-12-11 17:46:10'),
(6, 'John Doe', '12567455', 'Male', 'IT', 1, 'TCS', 'e9841dd659b6d7b628f99926d60c8a561702345513.png', 'johntcs@t.com', 'f925916e2754e5e03f75dd58a5733251', '2023-12-12 01:45:13');

-- --------------------------------------------------------

--
-- Table structure for table `tblcourse`
--

CREATE TABLE `tblcourse` (
  `ID` int(5) NOT NULL,
  `CourseName` varchar(250) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcourse`
--

INSERT INTO `tblcourse` (`ID`, `CourseName`, `CreationDate`) VALUES
(1, 'B.Tech(Information Technology)', '2023-11-25 13:51:59'),
(2, 'B.Tech(Computer Science)', '2023-11-25 13:52:19'),
(3, 'B.Tech(Mechanical)', '2023-11-25 13:52:35'),
(4, 'B.Tech(Electrical)', '2023-11-25 13:52:45'),
(5, 'B.Tech(Civil Engineering)', '2023-11-25 13:53:05'),
(6, 'B.Sc', '2023-11-25 13:53:18'),
(7, 'BA', '2023-11-25 13:53:23'),
(8, 'M.Sc', '2023-11-25 13:53:40'),
(10, 'Bachelor of Computer Application(BCA)', '2023-11-25 14:03:23'),
(11, 'B.Com', '2023-11-25 14:03:30'),
(12, 'M.Com', '2023-11-25 14:03:37');

-- --------------------------------------------------------

--
-- Table structure for table `tblevents`
--

CREATE TABLE `tblevents` (
  `ID` int(5) NOT NULL,
  `EventTitle` varchar(250) DEFAULT NULL,
  `Schedule` varchar(250) DEFAULT NULL,
  `Description` mediumtext DEFAULT NULL,
  `BannerImage` varchar(250) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblevents`
--

INSERT INTO `tblevents` (`ID`, `EventTitle`, `Schedule`, `Description`, `BannerImage`, `CreationDate`) VALUES
(1, 'College Feast', '2023-12-28T22:30', 'CollegeFest presents an unmatched consumer offering for college students by unique and engaging experiences from locally and nationally recognized brands.\r\nStudent of all batches are invited. Please confirm your presence to following numbers\r\nCN: 7890654325 ', '3f72678c4339b844781889070368cc631680333193.jpg', '2023-11-29 05:34:35'),
(2, 'Scavenger Hunt', '2023-11-30T09:35', 'Alumni events are often focused on team building, and scavenger hunts are one of the best team-building activities. The aim of a scavenger hunt is to work together, collaborate, and solve a problem. They’re loads of fun, and they encourage your alumni to utilize their skills and expertise. \r\n\r\nThere is a range of scavenger hunts that you could run. These include dedicated scavenger hunt rooms, organized scavenger hunt events, and even online scavenger hunts – which can be great for virtual alumni networking. ', 'ba38306a2c8654c254d293f280c476bb1701260586.jpg', '2023-11-29 05:36:09'),
(3, 'Friendly Tournaments', '2023-12-05T09:30', 'Friendly sports tournaments are always a good idea for alumni events. You can host all kinds of fun games and tournaments for your alumni for a simple but enjoyable event. This could include a sports day outdoors or a fun games evening inside. \r\n\r\nHere are a few great ideas for friendly tournaments:\r\n\r\nA rounders game: Much quicker than a game of cricket and much easier than a game of baseball. This is an excellent way to get everyone involved and build some team spirit.\r\nDarts tournament: Not so keen on outdoor sport? A darts tournament is a fun way to bring your alumni events indoors. You can enjoy a casual arts tournament over some drinks and snacks, and minimal resources are required for the event to be a success.\r\nTennis contest: If you’ve got a tennis court available and your alumni are feeling active, this can be a great way to encourage some friendly competition. You can also pair the alumni up to promote teamwork.\r\nTouch football day: This takes the hard contact out of football and makes it a fun game for everyone to enjoy. Again, minimal resources are required. ', '9217104b00ca4748fa8ac758e9cbce0b1701260614jpeg', '2023-11-29 05:37:09'),
(4, 'Alumni Getaway', '2023-12-16T21:37', 'This takes a bit more planning and resources, but definitely a worthwhile idea. Consider an alumni getaway weekend to offer your alumni an opportunity to network and learn (if you include a guest speaker or some sort of educational element). \r\n\r\nYou could spend the weekend running networking events, hosting team-building activities, or even doing a kind of wellness retreat for your alumni.', 'b3b5be5d27f20a438347a84e8ef8ae041701260632.jpg', '2023-11-29 05:38:06'),
(5, 'Private Cinema', '2024-01-05T12:00', 'Everyone loves going to the cinema, and what better way to do this than to set up your very own cinema. With just a projector and a screen, you can create an unforgettable indoor or outdoor cinema. \r\n\r\nYou can always combine this with food, drinks, music, or games. It can be a great way to raise funds and create a memorable alumni evening, and it won’t require too much input from you. ', '9555fab6019d120edfda7f0aa817d95d1701260656.jpg', '2023-11-29 05:40:25');

-- --------------------------------------------------------

--
-- Table structure for table `tbljobpost`
--

CREATE TABLE `tbljobpost` (
  `ID` int(10) NOT NULL,
  `AlumniID` int(10) DEFAULT NULL,
  `JobTitle` varchar(250) DEFAULT NULL,
  `CompanyName` varchar(250) DEFAULT NULL,
  `Location` varchar(250) DEFAULT NULL,
  `Vacancy` int(10) DEFAULT NULL,
  `Designation` varchar(250) DEFAULT NULL,
  `JobDescription` mediumtext DEFAULT NULL,
  `ContactPerson` varchar(250) DEFAULT NULL,
  `ContactNumber` bigint(11) DEFAULT NULL,
  `LastDate` date DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `Remark` varchar(250) DEFAULT NULL,
  `Status` varchar(100) DEFAULT NULL,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbljobpost`
--

INSERT INTO `tbljobpost` (`ID`, `AlumniID`, `JobTitle`, `CompanyName`, `Location`, `Vacancy`, `Designation`, `JobDescription`, `ContactPerson`, `ContactNumber`, `LastDate`, `PostingDate`, `Remark`, `Status`, `UpdationDate`) VALUES
(1, 3, 'Vacancy For Telecaller', 'Kamlin Pvt Ltd', 'Gurugram', 250, 'Tellecaller', 'As a Telecaller, you are responsible for handling sales over the phone entirely. You are also responsible for solving questions in regard to the product or service provided by the company. In addition to this, you should collect desired information from the clients and maintain healthy relations with them.', 'Himanshu', 8595464648, '2023-12-11', '2023-11-30 13:46:35', 'Approved', 'Approved', '2023-12-04 06:30:47'),
(2, 1, 'Vacancy For Telecaller', 'Kamlin Pvt Ltd', 'Gurugram', 250, 'Tellecaller', 'As a Telecaller, you are responsible for handling sales over the phone entirely. You are also responsible for solving questions in regard to the product or service provided by the company. In addition to this, you should collect desired information from the clients and maintain healthy relations with them.', 'Himanshu', 8595464648, '2023-12-11', '2023-11-30 13:46:35', NULL, NULL, '2023-12-04 05:35:11'),
(5, 4, 'Vacancy For  Junior HR', 'HRX Company', 'Noida', 5, 'Jr. HR', 'ytutyutuyawetgua\r\nef\r\newrres\r\ng\r\ntrg\r\nrtdhyr', 'Ridhima Singh', 4534534534, '2023-12-21', '2023-12-04 13:04:21', NULL, NULL, NULL),
(6, 5, 'Full Stack Developer', 'HCL', 'Noida UP', 1, 'Full Stack Developer', 'At least one year of experience in building large-scale software applications\r\nExperience in building web applications\r\nExperience in designing and integrating RESTful APIs\r\nKnowledge of Ruby, Java/JRuby, React, and JavaScript\r\nExcellent debugging and optimization skills\r\nExperience in unit/integration testing', 'Amit Singh', 1425654120, '2023-12-30', '2023-12-11 17:49:23', NULL, NULL, NULL),
(7, 6, 'SEO Manager', 'TCS', 'Gurugram', 1, 'SEO Manager', 'On page Optimization\r\nPage listing\r\nSMO', 'Rahul Kumar', 7979745445, '2024-01-31', '2023-12-12 01:46:55', 'Approved', 'Approved', '2023-12-12 01:48:03');

-- --------------------------------------------------------

--
-- Table structure for table `tblpage`
--

CREATE TABLE `tblpage` (
  `ID` int(10) NOT NULL,
  `PageType` varchar(200) DEFAULT NULL,
  `PageTitle` mediumtext DEFAULT NULL,
  `PageDescription` mediumtext DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `UpdationDate` date DEFAULT NULL,
  `Timing` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblpage`
--

INSERT INTO `tblpage` (`ID`, `PageType`, `PageTitle`, `PageDescription`, `Email`, `MobileNumber`, `UpdationDate`, `Timing`) VALUES
(1, 'aboutus', 'About Us', 'A college alumni system refers to a network or organization that connects and engages former students (alumni) of a particular college or university. The primary purpose of an alumni system is to maintain a relationship between the institution and its graduates even after they have completed their studies. This system helps in fostering a sense of community, facilitating communication, and providing various benefits to both the alumni and the alma mater.', NULL, NULL, NULL, ''),
(2, 'contactus', 'Contact Us', '890,Sector 62, Gyan Sarovar, GAIL Noida(Delhi/NCR)', 'info@gmail.com', 7896541239, NULL, '10:30 am to 7:30 pm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblalumni`
--
ALTER TABLE `tblalumni`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblcourse`
--
ALTER TABLE `tblcourse`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblevents`
--
ALTER TABLE `tblevents`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbljobpost`
--
ALTER TABLE `tbljobpost`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblpage`
--
ALTER TABLE `tblpage`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblalumni`
--
ALTER TABLE `tblalumni`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblcourse`
--
ALTER TABLE `tblcourse`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tblevents`
--
ALTER TABLE `tblevents`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbljobpost`
--
ALTER TABLE `tbljobpost`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblpage`
--
ALTER TABLE `tblpage`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
