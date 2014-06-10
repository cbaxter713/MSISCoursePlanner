-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2014 at 08:17 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `courseplanner`
--
CREATE DATABASE IF NOT EXISTS `courseplanner` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `courseplanner`;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `CategoryID` int(10) NOT NULL AUTO_INCREMENT,
  `CategoryName` varchar(255) NOT NULL,
  `HeaderBGColor` char(7) DEFAULT NULL,
  `SortOrder` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`CategoryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryID`, `CategoryName`, `HeaderBGColor`, `SortOrder`) VALUES
(1, 'MSIS Co-Requisites (3 hrs)', '#D44747', 1),
(2, 'MSIS Core Required (18 Hrs)', '#C3BEBE', 2),
(3, 'Electives (12 Hrs): Choose any combination', '#C3BEBE', 3);

-- --------------------------------------------------------

--
-- Table structure for table `classification`
--

CREATE TABLE IF NOT EXISTS `classification` (
  `ClassificationID` int(10) NOT NULL AUTO_INCREMENT,
  `CategoryID` int(10) NOT NULL DEFAULT '0',
  `ClassDescription` varchar(255) NOT NULL,
  `BGColor` char(7) DEFAULT NULL,
  `SortOrder` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ClassificationID`),
  KEY `FK_Category` (`CategoryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `classification`
--

INSERT INTO `classification` (`ClassificationID`, `CategoryID`, `ClassDescription`, `BGColor`, `SortOrder`) VALUES
(1, 1, 'Co-Requisites', NULL, 0),
(2, 2, 'Core Classes', NULL, 0),
(3, 3, 'Web/Development', '#FA9494', 1),
(4, 3, 'Security', '#FFFC00', 2),
(5, 3, 'Data Mgmt/Analytics', '#3B9ABD', 3),
(6, 3, 'Operations Mgmt', '#3BBD48', 4),
(7, 3, 'Independent Study', NULL, 7);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `CourseID` int(10) NOT NULL AUTO_INCREMENT,
  `CourseNumber` char(10) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Note` varchar(255) DEFAULT NULL,
  `Description` text,
  `ClassificationID` int(10) NOT NULL DEFAULT '0',
  `CreditHours` decimal(10,1) NOT NULL DEFAULT '0.0',
  `Hyperlink` varchar(255) DEFAULT NULL,
  `SortOrder` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`CourseID`),
  KEY `FK_Classification` (`ClassificationID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`CourseID`, `CourseNumber`, `Title`, `Note`, `Description`, `ClassificationID`, `CreditHours`, `Hyperlink`, `SortOrder`) VALUES
(2, 'IS 4410', 'Information Systems', NULL, 'Modern organizations operate on computer-based information systems, from day-to-day operations to corporate governance.  This course introduces a systemic way of planning, analyzing, designing, and implementing a computer-based information system for automating and enhancing business processes in organizations.  In this course, we learn the systems analysis and design methodology as well as techniques and tools for analyzing, modeling, and designing information systems. ', 1, '3.0', 'http://catalog.utah.edu/preview_course_nopop.php?catoid=4&coid=41302', 1),
(3, 'IS 6410', 'Systems Analysis & Design', NULL, 'Advanced topics in database theory and design, including hands-on development of a working database system. Topics covered include the relational database model, foundations in relational algebra, design techniques, SQL, distributed databases, multimedia databases, and knowledge bases. ', 2, '3.0', 'http://catalog.utah.edu/preview_course_nopop.php?catoid=4&coid=39836', 2),
(4, 'IS 6420', 'Database Theory and Design', NULL, 'This course introduces data mining technologies that assist in discovery of reliable, understandable and useful patterns in structured, semi-structured and unstructured data.  Students will practice core data mining technologies, analyze cases, and explore real world applications and issues. ', 2, '3.0', 'http://catalog.utah.edu/preview_course_nopop.php?catoid=4&coid=39837', 3),
(5, 'IS 6640', 'Networking & Servers', NULL, 'Meets with IS 4440. An introduction to the design, operation, and management of telecommunication systems including Server 2003, IIS, Linux, TCP/IP, and management support for networking. This course provides instruction in data communications and computer network definitions, concepts and principles, including (but not limited to): the conversion of voice, data, video and image to digital form; topologies; protocols; standards; and fundamental concepts related to data communication networks, such as routers, gateways, cabling, etc. It prepares students to make intelligent and informed decisions about data network design/management, by analyzing the benefits, drawbacks, effects, tradeoffs, and the compromises related to various data communication technologies. You will learn how to make policy, design and installation decisions. ', 2, '3.0', 'http://catalog.utah.edu/preview_course_nopop.php?catoid=4&coid=39855', 4),
(6, 'IS 6615', 'Data Structures & Java', NULL, 'Meets with IS 4415. This course introduces object-oriented computer programming to students using the Java programming language. Introductory topics such as variables, control-flow statements, and basic Java syntax are taught. In addition to single-value structure, the course covers lists, sets, hash tables, trees, and graph data structures. Algorithms for searching, sorting, and clustering data in the various structures are also covered. ', 2, '3.0', 'http://catalog.utah.edu/preview_course_nopop.php?catoid=4&coid=39854', 5),
(7, 'IS 6596', 'Masters Project I - Analysis & Planning', NULL, 'The Master''s Project is a capstone course divided over two semesters. Overall, the course involves the completion of an off-site complex information system development, strategic planning or research project. Students work in teams under the supervision of an on-site contact and in consultation with an IS/OIS faculty member. The project objective is to allow the student to integrate knowledge from individual courses and further expose students to new topics or techniques. The first half of the course covers an overview of project expectations, division of teams, development of projects, securing faculty consultation, and ends with creating and submitting a project proposal. ', 2, '1.5', 'http://catalog.utah.edu/preview_course_nopop.php?catoid=4&coid=39852', 6),
(8, 'IS 6597', 'Masters Project II - Execution & Presentation', NULL, 'The Master''s Project is a capstone course divided over two semesters. Overall, the course involves the completion of an off-site complex information system development, strategic planning or research project. Students work in teams under the supervision of an on-site contact and in consultation with an IS/OIS faculty member. The project objective is to allow the student to integrate knowledge from individual courses and further expose student to new topics or techniques. The second half of the courses involves project execution (completing deliverables). The course culminates with the submission of a written report and a professional presentation of project results by the student team for MSIS faculty, industry partners, and fellow students. ', 2, '1.5', 'http://catalog.utah.edu/preview_course_nopop.php?catoid=4&coid=39853', 7),
(9, 'IS 6465', 'Web Based Applications', NULL, 'Meets with IS 4460. The objective of the course is to provide knowledge and skills needed to create Web-based applications. It covers a broad set of technologies and tools that have led to the successful use of the World Wide Web for various businesses. This includes Java programming, JSP, HTML, XML, HTTP, Web servers and databases. ', 3, '3.0', 'http://catalog.utah.edu/preview_course_nopop.php?catoid=4&coid=39840', 1),
(10, 'OIS 6500', 'Visual Basic Applications for Business', NULL, 'Excel is a powerful computational tool that can be used in many applications. Still, there are many things that you may have wanted to do with a spreadsheet but there was no built-in function or menu item to accomplish your goal. Similarly, you may have desired to automate routine tasks or create a user interface that simplifies tasks for others. Fortunately, Excel can be customized to do much more that what is built-in through its programming language, Visual Basic for Applications (VBA). This class will provide an introduction to creating macros in Excel using VBA. Applications will range from simple tasks like automating formatting, to more complex tasks like creating an interface that will allow users to optimize with just a click of a button. ', 3, '1.5', 'http://catalog.utah.edu/preview_course_nopop.php?catoid=4&coid=40274', 2),
(11, 'IS 6471', 'Emerging Web Technologies and Strategies', NULL, 'Web 2.0 virtualization, cloud computing, mashups, widgets, web marketing, microblogging, blogs, wikis, VolP applications and others; Do you want to understand these terms?  Do you want to know how emerging technologies can help you in...increasing your web presence?  increasing the awareness about your company? getting your work done at lower cost? ', 3, '3.0', 'http://catalog.utah.edu/preview_course_nopop.php?catoid=4&coid=39842', 3),
(12, 'IS 6570', 'Information Technology Security', NULL, 'This course looks at management issues and practical implication related to securing information systems.  This course focuses on Access Control, Site Security, Networking & Review of TCP/IP, Attack Methods, Firewalls, Host Security, Cryptography, Crypto Systems, E-Commerce & Email Security, and Incident Response.  A clear theoretical understanding supports a large practical component where students learn to secure information systems and use contemporary security software. ', 4, '3.0', 'http://catalog.utah.edu/preview_course_nopop.php?catoid=4&coid=39849', 1),
(13, 'IS 6571', 'Digital Forensics', NULL, 'Examines computer forensics and investigations.  It looks at the problems and concerns related to computer investigations.  It blends traditional investigation methods with classic systems-analysis problem solving techniques and applies them to computing investigations.  It implements common computer forensic tools in real-life scenarios. ', 4, '3.0', 'http://catalog.utah.edu/preview_course_nopop.php?catoid=4&coid=39850', 2),
(14, 'IS 6850', 'Healthcare Information Technology', NULL, 'Successful corporations can utilize data science techniques (predictive analytics and data mining) to help drive business decision making by analyzing very large datasets (big data). In this course, a hands-on practitioner''s approach is taken to learning the fundamental knowledge, techniques and tools required for analyzing big data and leading data science teams. Topics covered include framing a business challenge as an analytics problem, using a structured lifecycle approach to data analytics, and applying the appropriate analytic techniques to analyze big data effectively. Hands-on experience is gained using open source tools such as R and Hadoop. ', 4, '1.5', 'http://catalog.utah.edu/preview_course_nopop.php?catoid=4&coid=39856', 3),
(15, 'ACCTG 6520', 'IT Risks and Controls', NULL, 'Objectives include providing students with an understanding of the security issues in a computerized environment. Students will be exposed to security guidelines, implementation and cost issues, security issues pertinent to the internet, and other issues. Students will also be exposed to the potential for fraud and abuse in a computerized environment. ', 4, '3.0', 'http://catalog.utah.edu/preview_course_nopop.php?catoid=4&coid=39810', 4),
(16, 'IS 6480', 'Data Warehousing Design and Implementation', NULL, 'The data generated from ongoing operations of businesses and not-for-profit enterprises continues to grow.  Using the data to diagnose problems and assess opportunities is becoming more and more of a competitive advantage in today''s business environment.  Before analysis can take place, existing data must be modeled in ways that facilitate reporting.  This course briefly presents the data models of existing operational systems and then contrasts those models to dimensional models used in data warehouses and analytic processing engines.  Business reporting needs are analyzed, data warehouses are modeled based on the reporting needs, and then SQL is used to create and populate tables based on dimensional models. Once in place, the data warehouse is used as a backend for a reporting tool to create reports that answer business questions. ', 5, '3.0', 'http://catalog.utah.edu/preview_course_nopop.php?catoid=4&coid=39843', 1),
(17, 'IS 6481', 'Data Driven Strategies and Technologies', NULL, 'This course introduces database technologies for building scalable data warehouse systems and technologies for user-oriented, interactive data analysis.  Data warehouse systems differ from on-line transaction processing systems in time span and access mode of the data, and in query types and purposes. ', 5, '3.0', 'http://catalog.utah.edu/preview_course_nopop.php?catoid=4&coid=39844', 2),
(18, 'IS 6483', 'Advanced Data Mining', NULL, 'This course covers advanced data and web mining methods and software tools for customer segmentation, recommendations, personalization, fraud detection, time series analysis, social network analysis as well as web content matching and extraction.  Special attention will be given to imbalanced data mining, cost-oriented classification and privacy-preserving data mining issues and methods.  Students will collect and analyze real world data using available data mining software or programming tools. ', 5, '3.0', 'http://catalog.utah.edu/preview_course_nopop.php?catoid=4&coid=39846', 3),
(19, 'IS 6484', 'Advanced Data Mgmt', NULL, 'This course covers issues, methods and applications of large-scale database systems.  Topics include administration and management of database, data warehouse and ERP systems, advanced SQL programming, distributed, multimedia and web data management as well as optimization of query processing, ETL and storage management. ', 5, '3.0', 'http://catalog.utah.edu/preview_course_nopop.php?catoid=4&coid=39847', 4),
(20, 'IS 6850', 'Special Topics in Information Systems', 'Digital Analytics', 'Upper Division or graduate status.  Topics vary according to current marketing environment and special interest/experience of instructor. ', 5, '3.0', 'http://catalog.utah.edu/preview_course_nopop.php?catoid=4&coid=39856', 5),
(21, 'OIS 6040', 'Data Analysis and Decision Making I', NULL, 'This course will develop decision making abilities with data-analysis and decision models.  Applications will be in the business functional areas.  Students will use computers to solve business problems.  Course topics will include advanced statistical analysis, regression models, decision analysis basics, and portfolio management. ', 5, '1.5', 'http://catalog.utah.edu/preview_course_nopop.php?catoid=4&coid=40263', 6),
(22, 'OIS 6041', 'Data Analysis and Decision Making II', NULL, 'This course is a continuation of Data Analysis and Decision Making I.  Course topics will include advanced regression, simulation, Bayes theorem and the value of information in decision analysis. ', 5, '1.5', 'http://catalog.utah.edu/preview_course_nopop.php?catoid=4&coid=40264', 7),
(23, 'OIS 6425', 'Six Sigma for Managers', NULL, 'six Sigma is a philosophy and set of concrete tools designed to reduce variation in all critical processes to achieve continuous and breakthrough improvements that impact the bottom line of organization and increase customer satisfaction.  In this course, we will study the five phase DMAIC (Design-Measure-Analyze-Improve-Control) approach in detail with a combination of lecture, small group breakout sessions, and hands-on practice.  Course topics will include a review of statistics, process improvement tools, statistical process control, measurement system evaluation, capability analysis and design of experiments.  Statistical software such as Minitab will be required and used throughout the class. ', 6, '3.0', 'http://catalog.utah.edu/preview_course_nopop.php?catoid=4&coid=40271', 1),
(24, 'OIS 6610', 'Practical Management Science', NULL, NULL, 6, '1.5', 'http://catalog.utah.edu/preview_course_nopop.php?catoid=4&coid=40275', 2),
(25, 'OIS 6621', 'Operations Strategy', '', 'We Explore various operational strategies that can lead to competitive advantage.  Within each topic, we develop a framework or theory that the firm can use to aid in decision-making, and typically also tackle a real-life problem using a case study.  Possible topics include product and process innovation, strategic implications of the learning curve, strategies from diffusion of new products, rapid product and process development, capacity management, strategic supplier management, strategic quality management, and mass customization. ', 6, '1.5', 'http://catalog.utah.edu/preview_course_nopop.php?catoid=4&coid=40277', 3),
(26, 'OIS 6620', 'Supply Chain Management', NULL, 'Production of services and goods typically involves many process steps that are spread across multiple firms or departments.  In supply chain management (SCM) we examine how to improve performance by considering the actions of multiple members within this chain of activities.  SCM addresses not only the flow of materials from upstream to downstream members in the supply chain, but also the flow of information and funds.  Advancements in information technology allow the supply chain to achieve performance improvements previously beyond reach, and may change the optimal structure of the supply chain.  Class discussion is motivated by case studies that examine successful emerging supply chain strategies. ', 6, '1.5', 'http://catalog.utah.edu/preview_course_nopop.php?catoid=4&coid=39855', 4),
(27, 'OIS 6660', 'Project Management', NULL, 'Project management has become the way of life in many industries.  Whether it is development of a new product, organizational-wide implementation of a new IT tool, or execution of a merger, project management skills are required to manage cross-functional teams subject to strict deadlines and tight budget constraints.  In this course we discuss all three phases of project management: project conception, execution, and closure.  Issues related to project leadership, budgeting, and scheduling will be addressed in the course, and case discussions will highlight state of the art project management practices.  Project management software will be introduced (possibly including group project using MS Project Software). ', 6, '3.0', 'http://catalog.utah.edu/preview_course_nopop.php?catoid=4&coid=40279', 5),
(28, 'IS 6910', 'Special Study for Masters Students', 'As many as 3 units', 'Independent Study', 7, '1.5', 'http://catalog.utah.edu/preview_course_nopop.php?catoid=4&coid=39857', 1);

-- --------------------------------------------------------

--
-- Table structure for table `courseterm`
--

CREATE TABLE IF NOT EXISTS `courseterm` (
  `CourseID` int(10) NOT NULL DEFAULT '0',
  `TermID` int(10) NOT NULL DEFAULT '0',
  `AddDate` date NOT NULL DEFAULT '0000-00-00',
  `AddedBy` int(10) NOT NULL DEFAULT '0',
  `PlannerNote` varchar(255) DEFAULT NULL,
  `CreditHours` decimal(10,1) NOT NULL,
  PRIMARY KEY (`CourseID`,`TermID`),
  KEY `FK_Term` (`TermID`),
  KEY `FK_User` (`AddedBy`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courseterm`
--

INSERT INTO `courseterm` (`CourseID`, `TermID`, `AddDate`, `AddedBy`, `PlannerNote`, `CreditHours`) VALUES
(1, 2, '0000-00-00', 0, NULL, '3.0'),
(1, 5, '0000-00-00', 0, NULL, '3.0'),
(1, 8, '0000-00-00', 0, NULL, '3.0'),
(1, 11, '0000-00-00', 0, NULL, '3.0'),
(1, 14, '0000-00-00', 0, NULL, '3.0'),
(1, 17, '0000-00-00', 0, NULL, '3.0'),
(1, 20, '0000-00-00', 0, NULL, '3.0'),
(1, 23, '0000-00-00', 0, NULL, '3.0'),
(2, 1, '0000-00-00', 0, NULL, '3.0'),
(2, 2, '0000-00-00', 0, NULL, '3.0'),
(2, 3, '0000-00-00', 0, NULL, '3.0'),
(2, 4, '0000-00-00', 0, NULL, '3.0'),
(2, 5, '0000-00-00', 0, NULL, '3.0'),
(2, 6, '0000-00-00', 0, NULL, '3.0'),
(2, 7, '0000-00-00', 0, NULL, '3.0'),
(2, 8, '0000-00-00', 0, NULL, '3.0'),
(2, 9, '0000-00-00', 0, NULL, '3.0'),
(2, 10, '0000-00-00', 0, NULL, '3.0'),
(2, 11, '0000-00-00', 0, NULL, '3.0'),
(2, 12, '0000-00-00', 0, NULL, '3.0'),
(2, 13, '0000-00-00', 0, NULL, '3.0'),
(2, 14, '0000-00-00', 0, NULL, '3.0'),
(2, 15, '0000-00-00', 0, NULL, '3.0'),
(2, 16, '0000-00-00', 0, NULL, '3.0'),
(2, 17, '0000-00-00', 0, NULL, '3.0'),
(2, 18, '0000-00-00', 0, NULL, '3.0'),
(2, 19, '0000-00-00', 0, NULL, '3.0'),
(2, 20, '0000-00-00', 0, NULL, '3.0'),
(2, 21, '0000-00-00', 0, NULL, '3.0'),
(2, 22, '0000-00-00', 0, NULL, '3.0'),
(2, 23, '0000-00-00', 0, NULL, '3.0'),
(2, 24, '0000-00-00', 0, NULL, '3.0'),
(2, 25, '0000-00-00', 0, NULL, '3.0'),
(3, 3, '0000-00-00', 0, NULL, '3.0'),
(3, 6, '0000-00-00', 0, NULL, '3.0'),
(3, 9, '0000-00-00', 0, NULL, '3.0'),
(3, 12, '0000-00-00', 0, NULL, '3.0'),
(3, 15, '0000-00-00', 0, NULL, '3.0'),
(3, 18, '0000-00-00', 0, NULL, '3.0'),
(3, 21, '0000-00-00', 0, NULL, '3.0'),
(3, 24, '0000-00-00', 0, NULL, '3.0'),
(4, 1, '0000-00-00', 0, NULL, '3.0'),
(4, 4, '0000-00-00', 0, NULL, '3.0'),
(4, 7, '0000-00-00', 0, NULL, '3.0'),
(4, 10, '0000-00-00', 0, NULL, '3.0'),
(4, 13, '0000-00-00', 0, NULL, '3.0'),
(4, 16, '0000-00-00', 0, NULL, '3.0'),
(4, 19, '0000-00-00', 0, NULL, '3.0'),
(4, 22, '0000-00-00', 0, NULL, '3.0'),
(4, 25, '0000-00-00', 0, NULL, '3.0'),
(5, 1, '0000-00-00', 0, NULL, '3.0'),
(5, 4, '0000-00-00', 0, NULL, '3.0'),
(5, 7, '0000-00-00', 0, NULL, '3.0'),
(5, 10, '0000-00-00', 0, NULL, '3.0'),
(5, 13, '0000-00-00', 0, NULL, '3.0'),
(5, 16, '0000-00-00', 0, NULL, '3.0'),
(5, 19, '0000-00-00', 0, NULL, '3.0'),
(5, 22, '0000-00-00', 0, NULL, '3.0'),
(5, 25, '0000-00-00', 0, NULL, '3.0'),
(6, 2, '0000-00-00', 0, NULL, '3.0'),
(6, 3, '0000-00-00', 0, NULL, '3.0'),
(6, 5, '0000-00-00', 0, NULL, '3.0'),
(6, 6, '0000-00-00', 0, NULL, '3.0'),
(6, 8, '0000-00-00', 0, NULL, '3.0'),
(6, 9, '0000-00-00', 0, NULL, '3.0'),
(6, 11, '0000-00-00', 0, NULL, '3.0'),
(6, 12, '0000-00-00', 0, NULL, '3.0'),
(6, 14, '0000-00-00', 0, NULL, '3.0'),
(6, 15, '0000-00-00', 0, NULL, '3.0'),
(6, 17, '0000-00-00', 0, NULL, '3.0'),
(6, 18, '0000-00-00', 0, NULL, '3.0'),
(6, 20, '0000-00-00', 0, NULL, '3.0'),
(6, 21, '0000-00-00', 0, NULL, '3.0'),
(6, 23, '0000-00-00', 0, NULL, '3.0'),
(6, 24, '0000-00-00', 0, NULL, '3.0'),
(7, 1, '2014-04-14', 0, NULL, '1.5'),
(7, 2, '2014-04-14', 0, NULL, '1.5'),
(7, 4, '2014-04-14', 0, NULL, '1.5'),
(7, 5, '2014-04-14', 0, NULL, '1.5'),
(7, 7, '2014-04-14', 0, NULL, '1.5'),
(7, 8, '2014-04-14', 0, NULL, '1.5'),
(7, 10, '2014-04-14', 0, NULL, '1.5'),
(7, 11, '2014-04-14', 0, NULL, '1.5'),
(7, 13, '2014-04-14', 0, NULL, '1.5'),
(7, 14, '2014-04-14', 0, NULL, '1.5'),
(7, 16, '2014-04-14', 0, NULL, '1.5'),
(7, 17, '2014-04-14', 0, NULL, '1.5'),
(7, 19, '2014-04-14', 0, NULL, '1.5'),
(7, 20, '2014-04-14', 0, NULL, '1.5'),
(7, 22, '2014-04-14', 0, NULL, '1.5'),
(7, 23, '2014-04-14', 0, NULL, '1.5'),
(7, 25, '2014-04-14', 0, NULL, '1.5'),
(8, 1, '2014-04-14', 0, NULL, '1.5'),
(8, 2, '2014-04-14', 0, NULL, '1.5'),
(8, 3, '2014-04-14', 0, NULL, '1.5'),
(8, 4, '2014-04-14', 0, NULL, '1.5'),
(8, 5, '2014-04-14', 0, NULL, '1.5'),
(8, 6, '2014-04-14', 0, NULL, '1.5'),
(8, 7, '2014-04-14', 0, NULL, '1.5'),
(8, 8, '2014-04-14', 0, NULL, '1.5'),
(8, 9, '2014-04-14', 0, NULL, '1.5'),
(8, 10, '2014-04-14', 0, NULL, '1.5'),
(8, 11, '2014-04-14', 0, NULL, '1.5'),
(8, 12, '2014-04-14', 0, NULL, '1.5'),
(8, 13, '2014-04-14', 0, NULL, '1.5'),
(8, 14, '2014-04-14', 0, NULL, '1.5'),
(8, 15, '2014-04-14', 0, NULL, '1.5'),
(8, 16, '2014-04-14', 0, NULL, '1.5'),
(8, 17, '2014-04-14', 0, NULL, '1.5'),
(8, 18, '2014-04-14', 0, NULL, '1.5'),
(8, 19, '2014-04-14', 0, NULL, '1.5'),
(8, 20, '2014-04-14', 0, NULL, '1.5'),
(8, 21, '2014-04-14', 0, NULL, '1.5'),
(8, 22, '2014-04-14', 0, NULL, '1.5'),
(8, 23, '2014-04-14', 0, NULL, '1.5'),
(8, 24, '2014-04-14', 0, NULL, '1.5'),
(8, 25, '2014-04-14', 0, NULL, '1.5'),
(9, 1, '2014-04-14', 0, NULL, '3.0'),
(9, 2, '2014-04-14', 0, NULL, '3.0'),
(9, 4, '2014-04-14', 0, NULL, '3.0'),
(9, 5, '2014-04-14', 0, NULL, '3.0'),
(9, 7, '2014-04-14', 0, NULL, '3.0'),
(9, 8, '2014-04-14', 0, NULL, '3.0'),
(9, 10, '2014-04-14', 0, NULL, '3.0'),
(9, 11, '2014-04-14', 0, NULL, '3.0'),
(9, 13, '2014-04-14', 0, NULL, '3.0'),
(9, 14, '2014-04-14', 0, NULL, '3.0'),
(9, 16, '2014-04-14', 0, NULL, '3.0'),
(9, 17, '2014-04-14', 0, NULL, '3.0'),
(9, 19, '2014-04-14', 0, NULL, '3.0'),
(9, 20, '2014-04-14', 0, NULL, '3.0'),
(9, 22, '2014-04-14', 0, NULL, '3.0'),
(9, 23, '2014-04-14', 0, NULL, '3.0'),
(9, 25, '2014-04-14', 0, NULL, '3.0'),
(10, 2, '2014-04-14', 0, NULL, '1.5'),
(10, 3, '2014-04-14', 0, NULL, '1.5'),
(10, 5, '2014-04-14', 0, NULL, '1.5'),
(10, 6, '2014-04-14', 0, NULL, '1.5'),
(10, 8, '2014-04-14', 0, NULL, '1.5'),
(10, 9, '2014-04-14', 0, NULL, '1.5'),
(10, 11, '2014-04-14', 0, NULL, '1.5'),
(10, 12, '2014-04-14', 0, NULL, '1.5'),
(10, 14, '2014-04-14', 0, NULL, '1.5'),
(10, 15, '2014-04-14', 0, NULL, '1.5'),
(10, 17, '2014-04-14', 0, NULL, '1.5'),
(10, 18, '2014-04-14', 0, NULL, '1.5'),
(10, 20, '2014-04-14', 0, NULL, '1.5'),
(10, 21, '2014-04-14', 0, NULL, '1.5'),
(10, 23, '2014-04-14', 0, NULL, '1.5'),
(10, 24, '2014-04-14', 0, NULL, '1.5'),
(11, 2, '0000-00-00', 0, NULL, '3.0'),
(11, 5, '0000-00-00', 0, NULL, '3.0'),
(11, 8, '0000-00-00', 0, NULL, '3.0'),
(11, 11, '0000-00-00', 0, NULL, '3.0'),
(11, 14, '0000-00-00', 0, NULL, '3.0'),
(11, 17, '0000-00-00', 0, NULL, '3.0'),
(11, 20, '0000-00-00', 0, NULL, '3.0'),
(11, 23, '0000-00-00', 0, NULL, '3.0'),
(12, 1, '2014-04-14', 0, NULL, '3.0'),
(12, 2, '2014-04-14', 0, NULL, '3.0'),
(12, 4, '2014-04-14', 0, NULL, '3.0'),
(12, 5, '2014-04-14', 0, NULL, '3.0'),
(12, 7, '2014-04-14', 0, NULL, '3.0'),
(12, 8, '2014-04-14', 0, NULL, '3.0'),
(12, 10, '2014-04-14', 0, NULL, '3.0'),
(12, 11, '2014-04-14', 0, NULL, '3.0'),
(12, 13, '2014-04-14', 0, NULL, '3.0'),
(12, 14, '2014-04-14', 0, NULL, '3.0'),
(12, 16, '2014-04-14', 0, NULL, '3.0'),
(12, 17, '2014-04-14', 0, NULL, '3.0'),
(12, 19, '2014-04-14', 0, NULL, '3.0'),
(12, 20, '2014-04-14', 0, NULL, '3.0'),
(12, 22, '2014-04-14', 0, NULL, '3.0'),
(12, 23, '2014-04-14', 0, NULL, '3.0'),
(12, 25, '2014-04-14', 0, NULL, '3.0'),
(13, 1, '2014-04-14', 0, NULL, '3.0'),
(13, 4, '2014-04-14', 0, NULL, '3.0'),
(13, 7, '2014-04-14', 0, NULL, '3.0'),
(13, 10, '2014-04-14', 0, NULL, '3.0'),
(13, 13, '2014-04-14', 0, NULL, '3.0'),
(13, 16, '2014-04-14', 0, NULL, '3.0'),
(13, 19, '2014-04-14', 0, NULL, '3.0'),
(13, 22, '2014-04-14', 0, NULL, '3.0'),
(13, 25, '2014-04-14', 0, NULL, '3.0'),
(14, 2, '2014-04-14', 0, NULL, '3.0'),
(14, 5, '2014-04-14', 0, NULL, '3.0'),
(14, 8, '2014-04-14', 0, NULL, '3.0'),
(14, 11, '2014-04-14', 0, NULL, '3.0'),
(14, 14, '2014-04-14', 0, NULL, '3.0'),
(14, 17, '2014-04-14', 0, NULL, '3.0'),
(14, 20, '2014-04-14', 0, NULL, '3.0'),
(14, 23, '2014-04-14', 0, NULL, '3.0'),
(17, 1, '2014-04-14', 0, NULL, '3.0'),
(17, 4, '2014-04-14', 0, NULL, '3.0'),
(17, 7, '2014-04-14', 0, NULL, '3.0'),
(17, 10, '2014-04-14', 0, NULL, '3.0'),
(17, 13, '2014-04-14', 0, NULL, '3.0'),
(17, 16, '2014-04-14', 0, NULL, '3.0'),
(17, 19, '2014-04-14', 0, NULL, '3.0'),
(17, 22, '2014-04-14', 0, NULL, '3.0'),
(17, 25, '2014-04-14', 0, NULL, '3.0'),
(18, 2, '2014-04-14', 0, NULL, '3.0'),
(18, 5, '2014-04-14', 0, NULL, '3.0'),
(18, 8, '2014-04-14', 0, NULL, '3.0'),
(18, 11, '2014-04-14', 0, NULL, '3.0'),
(18, 14, '2014-04-14', 0, NULL, '3.0'),
(18, 17, '2014-04-14', 0, NULL, '3.0'),
(18, 20, '2014-04-14', 0, NULL, '3.0'),
(18, 23, '2014-04-14', 0, NULL, '3.0'),
(19, 3, '2014-04-14', 0, NULL, '3.0'),
(19, 6, '2014-04-14', 0, NULL, '3.0'),
(19, 9, '2014-04-14', 0, NULL, '3.0'),
(19, 12, '2014-04-14', 0, NULL, '3.0'),
(19, 15, '2014-04-14', 0, NULL, '3.0'),
(19, 18, '2014-04-14', 0, NULL, '3.0'),
(19, 21, '2014-04-14', 0, NULL, '3.0'),
(19, 24, '2014-04-14', 0, NULL, '3.0'),
(20, 2, '2014-04-14', 0, NULL, '3.0'),
(20, 5, '2014-04-14', 0, NULL, '3.0'),
(20, 8, '2014-04-14', 0, NULL, '3.0'),
(20, 11, '2014-04-14', 0, NULL, '3.0'),
(20, 14, '2014-04-14', 0, NULL, '3.0'),
(20, 17, '2014-04-14', 0, NULL, '3.0'),
(20, 20, '2014-04-14', 0, NULL, '3.0'),
(20, 23, '2014-04-14', 0, NULL, '3.0'),
(21, 1, '2014-04-14', 0, NULL, '1.5'),
(21, 4, '2014-04-14', 0, NULL, '1.5'),
(21, 7, '2014-04-14', 0, NULL, '1.5'),
(21, 10, '2014-04-14', 0, NULL, '1.5'),
(21, 13, '2014-04-14', 0, NULL, '1.5'),
(21, 16, '2014-04-14', 0, NULL, '1.5'),
(21, 19, '2014-04-14', 0, NULL, '1.5'),
(21, 22, '2014-04-14', 0, NULL, '1.5'),
(21, 25, '2014-04-14', 0, NULL, '1.5'),
(22, 2, '2014-04-14', 0, NULL, '1.5'),
(22, 5, '2014-04-14', 0, NULL, '1.5'),
(22, 8, '2014-04-14', 0, NULL, '1.5'),
(22, 11, '2014-04-14', 0, NULL, '1.5'),
(22, 14, '2014-04-14', 0, NULL, '1.5'),
(22, 17, '2014-04-14', 0, NULL, '1.5'),
(22, 20, '2014-04-14', 0, NULL, '1.5'),
(22, 23, '2014-04-14', 0, NULL, '1.5'),
(23, 2, '2014-04-14', 0, NULL, '3.0'),
(23, 5, '2014-04-14', 0, NULL, '3.0'),
(23, 8, '2014-04-14', 0, NULL, '3.0'),
(23, 11, '2014-04-14', 0, NULL, '3.0'),
(23, 14, '2014-04-14', 0, NULL, '3.0'),
(23, 17, '2014-04-14', 0, NULL, '3.0'),
(23, 20, '2014-04-14', 0, NULL, '3.0'),
(23, 23, '2014-04-14', 0, NULL, '3.0'),
(24, 2, '0000-00-00', 0, NULL, '1.5'),
(24, 5, '0000-00-00', 0, NULL, '1.5'),
(24, 8, '0000-00-00', 0, NULL, '1.5'),
(24, 11, '0000-00-00', 0, NULL, '1.5'),
(24, 14, '0000-00-00', 0, NULL, '1.5'),
(24, 17, '0000-00-00', 0, NULL, '1.5'),
(24, 20, '0000-00-00', 0, NULL, '1.5'),
(24, 23, '0000-00-00', 0, NULL, '1.5'),
(25, 1, '2014-04-14', 0, NULL, '1.5'),
(25, 4, '2014-04-14', 0, NULL, '1.5'),
(25, 7, '2014-04-14', 0, NULL, '1.5'),
(25, 10, '2014-04-14', 0, NULL, '1.5'),
(25, 13, '2014-04-14', 0, NULL, '1.5'),
(25, 16, '2014-04-14', 0, NULL, '1.5'),
(25, 19, '2014-04-14', 0, NULL, '1.5'),
(25, 22, '2014-04-14', 0, NULL, '1.5'),
(25, 25, '2014-04-14', 0, NULL, '1.5'),
(27, 1, '2014-04-14', 0, NULL, '3.0'),
(27, 3, '2014-04-14', 0, NULL, '3.0'),
(27, 4, '2014-04-14', 0, NULL, '3.0'),
(27, 6, '2014-04-14', 0, NULL, '3.0'),
(27, 7, '2014-04-14', 0, NULL, '3.0'),
(27, 9, '2014-04-14', 0, NULL, '3.0'),
(27, 10, '2014-04-14', 0, NULL, '3.0'),
(27, 12, '2014-04-14', 0, NULL, '3.0'),
(27, 13, '2014-04-14', 0, NULL, '3.0'),
(27, 15, '2014-04-14', 0, NULL, '3.0'),
(27, 16, '2014-04-14', 0, NULL, '3.0'),
(27, 18, '2014-04-14', 0, NULL, '3.0'),
(27, 19, '2014-04-14', 0, NULL, '3.0'),
(27, 21, '2014-04-14', 0, NULL, '3.0'),
(27, 22, '2014-04-14', 0, NULL, '3.0'),
(27, 24, '2014-04-14', 0, NULL, '3.0'),
(27, 25, '2014-04-14', 0, NULL, '3.0'),
(28, 1, '0000-00-00', 0, NULL, '1.5'),
(28, 2, '0000-00-00', 0, NULL, '1.5'),
(28, 3, '0000-00-00', 0, NULL, '1.5'),
(28, 4, '0000-00-00', 0, NULL, '1.5'),
(28, 5, '0000-00-00', 0, NULL, '1.5'),
(28, 6, '0000-00-00', 0, NULL, '1.5'),
(28, 7, '0000-00-00', 0, NULL, '1.5'),
(28, 8, '0000-00-00', 0, NULL, '1.5'),
(28, 9, '0000-00-00', 0, NULL, '1.5'),
(28, 10, '0000-00-00', 0, NULL, '1.5'),
(28, 11, '0000-00-00', 0, NULL, '1.5'),
(28, 12, '0000-00-00', 0, NULL, '1.5'),
(28, 13, '0000-00-00', 0, NULL, '1.5'),
(28, 14, '0000-00-00', 0, NULL, '1.5'),
(28, 15, '0000-00-00', 0, NULL, '1.5'),
(28, 16, '0000-00-00', 0, NULL, '1.5'),
(28, 17, '0000-00-00', 0, NULL, '1.5'),
(28, 18, '0000-00-00', 0, NULL, '1.5'),
(28, 19, '0000-00-00', 0, NULL, '1.5'),
(28, 20, '0000-00-00', 0, NULL, '1.5'),
(28, 21, '0000-00-00', 0, NULL, '1.5'),
(28, 22, '0000-00-00', 0, NULL, '1.5'),
(28, 23, '0000-00-00', 0, NULL, '1.5'),
(28, 24, '0000-00-00', 0, NULL, '1.5'),
(28, 25, '0000-00-00', 0, NULL, '1.5');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE IF NOT EXISTS `review` (
  `ReviewID` int(10) NOT NULL AUTO_INCREMENT,
  `CourseID` int(10) NOT NULL DEFAULT '0',
  `ReviewDate` date NOT NULL DEFAULT '0000-00-00',
  `ReviewedBy` int(10) NOT NULL DEFAULT '0',
  `ReviewText` text NOT NULL,
  `StarCount` int(10) DEFAULT NULL,
  PRIMARY KEY (`ReviewID`),
  KEY `FK_Course` (`CourseID`),
  KEY `FK_User` (`ReviewedBy`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `term`
--

CREATE TABLE IF NOT EXISTS `term` (
  `TermID` int(10) NOT NULL AUTO_INCREMENT,
  `Year` int(10) NOT NULL DEFAULT '0',
  `Season` char(6) NOT NULL,
  PRIMARY KEY (`TermID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `term`
--

INSERT INTO `term` (`TermID`, `Year`, `Season`) VALUES
(1, 2012, 'Fall'),
(2, 2013, 'Spring'),
(3, 2013, 'Summer'),
(4, 2013, 'Fall'),
(5, 2014, 'Spring'),
(6, 2014, 'Summer'),
(7, 2014, 'Fall'),
(8, 2015, 'Spring'),
(9, 2015, 'Summer'),
(10, 2015, 'Fall'),
(11, 2016, 'Spring'),
(12, 2016, 'Summer'),
(13, 2016, 'Fall'),
(14, 2017, 'Spring'),
(15, 2017, 'Summer'),
(16, 2017, 'Fall'),
(17, 2018, 'Spring'),
(18, 2018, 'Summer'),
(19, 2018, 'Fall'),
(20, 2019, 'Spring'),
(21, 2019, 'Summer'),
(22, 2019, 'Fall'),
(23, 2020, 'Spring'),
(24, 2020, 'Summer'),
(25, 2020, 'Fall');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `UserID` int(10) NOT NULL AUTO_INCREMENT,
  `UID` char(20) DEFAULT NULL,
  `Password` char(40) NOT NULL,
  `IsAdmin` char(1) NOT NULL DEFAULT 'N',
  `startSemester` int(11) NOT NULL,
  `finishSemester` int(11) NOT NULL,
  `capstoneViews` int(11) NOT NULL,
  `officialStart` int(11) NOT NULL,
  `officialFinish` int(11) NOT NULL,
  `status` varchar(30) NOT NULL,
  `IS4410` varchar(1) NOT NULL,
  `notes` varchar(20000) NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `UID`, `Password`, `IsAdmin`, `startSemester`, `finishSemester`, `capstoneViews`, `officialStart`, `officialFinish`, `status`, `IS4410`, `notes`) VALUES
(1, 'u0476791', 'b53af3e20568070a759e0f2756e999b9fe4bdf92', 'N', 4, 7, 1, 4, 6, 'Current Student', 'Y', 'This is a test of the notes section for the MSIS course planner webpage admin functionality.  These notes should be saved to the individual user in the database, and pulled up any time the Admin searches to view that students course planner.  The notes will only be displayed when you click on the "show notes" radio button. '),
(2, 'user', '011c945f30ce2cbafc452f39840f025693339c42', 'N', 6, 0, 0, 0, 0, 'Current Student', 'Y', 'this is a notes section that is able to save notes for an individual student, and be tied to that student so that Laurie can view them later on. '),
(3, 'testAdmin', 'fb2a311a2c7d0c3d7a669c19a62f5227c20c7a60', 'Y', 4, 0, 0, 0, 0, 'Current Student', 'Y', ''),
(4, 'testUser', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'N', 5, 0, 0, 0, 0, 'Current Student', 'Y', 'how about these notes. have they saved?'),
(8, 'JennWallace', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'N', 0, 0, 1, 0, 0, 'Current Student', 'Y', ''),
(9, 'LaurieBragg', '011c945f30ce2cbafc452f39840f025693339c42', 'Y', 0, 0, 0, 0, 0, '', '', ''),
(10, 'Porter', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'N', 5, 0, 0, 0, 0, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `usercourse`
--

CREATE TABLE IF NOT EXISTS `usercourse` (
  `UserID` int(10) NOT NULL DEFAULT '0',
  `CourseID` int(10) NOT NULL DEFAULT '0',
  `TermID` int(10) NOT NULL DEFAULT '0',
  `CreditHours` decimal(10,1) NOT NULL,
  `AddDate` date NOT NULL DEFAULT '0000-00-00',
  `AddedBy` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`UserID`,`CourseID`,`TermID`),
  KEY `FK_Course` (`CourseID`),
  KEY `FK_Term` (`TermID`),
  KEY `FK_User` (`AddedBy`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usercourse`
--

INSERT INTO `usercourse` (`UserID`, `CourseID`, `TermID`, `CreditHours`, `AddDate`, `AddedBy`) VALUES
(1, 2, 5, '3.0', '0000-00-00', 0),
(1, 3, 6, '3.0', '0000-00-00', 0),
(1, 4, 4, '3.0', '0000-00-00', 0),
(1, 5, 4, '3.0', '0000-00-00', 0),
(1, 6, 5, '3.0', '0000-00-00', 0),
(1, 7, 4, '1.5', '0000-00-00', 0),
(1, 8, 5, '1.5', '0000-00-00', 0),
(1, 9, 5, '3.0', '0000-00-00', 0),
(1, 11, 5, '3.0', '0000-00-00', 0),
(1, 16, 6, '3.0', '0000-00-00', 0),
(1, 19, 6, '3.0', '0000-00-00', 0),
(1, 27, 4, '3.0', '0000-00-00', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
