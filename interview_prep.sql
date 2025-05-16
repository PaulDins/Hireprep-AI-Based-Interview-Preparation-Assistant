-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2025 at 08:35 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `interview_prep`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE IF NOT EXISTS `answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `q_id` int(11) NOT NULL,
  `answer` text NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`id`, `user_id`, `q_id`, `answer`, `status`) VALUES
(1, 1, 1, 'basically programming language', 'pending'),
(2, 1, 6, 'programming language to  actually basically', 'pending'),
(3, 1, 31, 'like a framework', 'pending'),
(4, 1, 36, 'HTML is actually hypertext markup language', 'pending'),
(5, 1, 2, 'I don''t know', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `emotions`
--

CREATE TABLE IF NOT EXISTS `emotions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `emotion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=86 ;

--
-- Dumping data for table `emotions`
--

INSERT INTO `emotions` (`id`, `timestamp`, `emotion`) VALUES
(1, '2025-02-26 06:06:29', 'sad'),
(2, '2025-02-26 06:16:52', 'sad'),
(3, '2025-02-26 06:16:53', 'sad'),
(4, '2025-02-26 06:16:53', 'sad'),
(5, '2025-02-26 06:16:54', 'sad'),
(6, '2025-02-26 06:16:59', 'sad'),
(7, '2025-02-26 06:16:59', 'sad'),
(8, '2025-02-26 06:16:59', 'sad'),
(9, '2025-02-26 06:16:59', 'sad'),
(10, '2025-02-26 06:16:59', 'sad'),
(11, '2025-02-26 06:17:03', 'sad'),
(12, '2025-02-26 06:17:03', 'sad'),
(13, '2025-02-26 06:17:03', 'sad'),
(14, '2025-02-26 06:17:03', 'sad'),
(15, '2025-02-26 06:17:03', 'neutral'),
(16, '2025-02-26 06:17:03', 'neutral'),
(17, '2025-02-26 06:17:03', 'neutral'),
(18, '2025-02-26 06:17:04', 'neutral'),
(19, '2025-02-26 06:17:04', 'neutral'),
(20, '2025-02-26 06:17:04', 'sad'),
(21, '2025-02-26 06:17:04', 'neutral'),
(22, '2025-02-26 06:17:04', 'neutral'),
(23, '2025-02-26 06:17:04', 'neutral'),
(24, '2025-02-26 06:17:04', 'sad'),
(25, '2025-02-26 06:17:04', 'sad'),
(26, '2025-02-26 06:17:04', 'neutral'),
(27, '2025-02-26 06:17:05', 'neutral'),
(28, '2025-02-26 06:17:05', 'happy'),
(29, '2025-02-26 06:17:05', 'happy'),
(30, '2025-02-26 06:17:05', 'neutral'),
(31, '2025-02-26 06:17:05', 'happy'),
(32, '2025-02-26 06:17:05', 'happy'),
(33, '2025-02-26 06:17:05', 'sad'),
(34, '2025-02-26 06:17:49', 'sad'),
(35, '2025-02-26 06:17:49', 'sad'),
(36, '2025-02-26 06:17:49', 'angry'),
(37, '2025-02-26 06:17:49', 'angry'),
(38, '2025-02-26 06:17:49', 'sad'),
(39, '2025-02-26 06:17:49', 'sad'),
(40, '2025-02-26 06:17:50', 'sad'),
(41, '2025-02-26 06:17:50', 'sad'),
(42, '2025-02-26 06:17:50', 'sad'),
(43, '2025-02-26 06:17:50', 'sad'),
(44, '2025-02-26 06:17:50', 'sad'),
(45, '2025-02-26 06:17:50', 'neutral'),
(46, '2025-02-26 06:17:50', 'sad'),
(47, '2025-02-26 06:17:51', 'angry'),
(48, '2025-02-26 06:17:51', 'neutral'),
(49, '2025-02-26 06:17:51', 'neutral'),
(50, '2025-02-26 06:17:51', 'angry'),
(51, '2025-02-26 06:17:51', 'neutral'),
(52, '2025-02-26 06:17:51', 'neutral'),
(53, '2025-02-26 06:17:51', 'neutral'),
(54, '2025-02-26 06:17:51', 'angry'),
(55, '2025-02-26 06:17:51', 'angry'),
(56, '2025-02-26 06:17:51', 'neutral'),
(57, '2025-02-26 06:17:52', 'angry'),
(58, '2025-02-26 06:17:52', 'neutral'),
(59, '2025-02-26 06:17:52', 'neutral'),
(60, '2025-02-26 06:17:52', 'angry'),
(61, '2025-02-26 06:17:52', 'neutral'),
(62, '2025-02-26 06:17:52', 'neutral'),
(63, '2025-02-26 06:17:52', 'sad'),
(64, '2025-02-26 06:17:52', 'sad'),
(65, '2025-02-26 06:17:52', 'happy'),
(66, '2025-02-26 06:17:52', 'happy'),
(67, '2025-02-26 06:17:52', 'angry'),
(68, '2025-02-26 06:17:53', 'sad'),
(69, '2025-02-26 06:17:53', 'neutral'),
(70, '2025-02-26 06:17:53', 'sad'),
(71, '2025-02-26 06:17:53', 'angry'),
(72, '2025-02-26 06:17:53', 'angry'),
(73, '2025-02-26 06:17:53', 'happy'),
(74, '2025-02-26 06:17:53', 'angry'),
(75, '2025-02-26 06:17:53', 'angry'),
(76, '2025-02-26 06:17:53', 'neutral'),
(77, '2025-02-26 06:17:53', 'sad'),
(78, '2025-02-26 06:17:53', 'angry'),
(79, '2025-02-26 06:17:54', 'neutral'),
(80, '2025-02-26 06:17:54', 'sad'),
(81, '2025-02-26 06:17:54', 'neutral'),
(82, '2025-02-26 06:17:54', 'sad'),
(83, '2025-02-26 06:17:54', 'angry'),
(84, '2025-02-26 06:17:54', 'angry'),
(85, '2025-02-26 06:17:55', 'angry');

-- --------------------------------------------------------

--
-- Table structure for table `job_post`
--

CREATE TABLE IF NOT EXISTS `job_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `job_post`
--

INSERT INTO `job_post` (`id`, `job_name`) VALUES
(1, 'Software Developer'),
(2, 'Web Developer'),
(3, 'Data Scientist'),
(4, 'UI/UX Designer'),
(5, 'DevOps Engineer'),
(6, 'Data Analyst'),
(7, 'Technical Support Engineer'),
(9, 'Data Analyst');

-- --------------------------------------------------------

--
-- Table structure for table `job_profile`
--

CREATE TABLE IF NOT EXISTS `job_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `college` varchar(255) NOT NULL,
  `degree` varchar(100) NOT NULL,
  `cgpa` varchar(100) NOT NULL,
  `job_role` varchar(100) NOT NULL,
  `skills` varchar(255) NOT NULL,
  `experience` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `job_profile`
--

INSERT INTO `job_profile` (`id`, `user_id`, `college`, `degree`, `cgpa`, `job_role`, `skills`, `experience`) VALUES
(1, 1, 'Rajagiri School of Engineering & Technology', 'Btech', '7.2', '1', '1,2,3,8', '0');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `skill` varchar(100) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `level` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `skill`, `question`, `answer`, `level`) VALUES
(1, '1', 'What is Python?', 'Python is a high-level, interpreted programming language.', 'basic'),
(2, '1', 'How do you declare a variable in Python?', 'Use the assignment operator, e.g., x = 10.', 'basic'),
(3, '1', 'What data types are available in Python?', 'Common data types include int, float, str, list, tuple, dict, set, and bool.', 'basic'),
(4, '1', 'What is a list in Python?', 'A list is an ordered, mutable collection of elements.', 'basic'),
(5, '1', 'How do you define a function in Python?', 'Using the def keyword, e.g., def my_function():', 'basic'),
(6, '2', 'What is JavaScript?', 'JavaScript is a scripting language used for web development.', 'basic'),
(7, '2', 'What is the difference between let, var, and const?', 'var has function scope, let and const have block scope.', 'basic'),
(8, '2', 'What are JavaScript data types?', 'Common types include Number, String, Boolean, Object, Undefined, and Null.', 'basic'),
(9, '2', 'What is an array in JavaScript?', 'An array is a collection of elements stored in a single variable.', 'basic'),
(10, '2', 'How do you declare a function in JavaScript?', 'Using function keyword, e.g., function myFunction() {}', 'basic'),
(11, '1', 'What is list comprehension in Python?', 'A concise way to create lists using a single line of code.', 'intermediate'),
(12, '1', 'What is the difference between shallow copy and deep copy?', 'Shallow copy copies references, deep copy creates a new object.', 'intermediate'),
(13, '1', 'What is a Python decorator?', 'A function that modifies the behavior of another function.', 'intermediate'),
(14, '1', 'What is the difference between mutable and immutable objects?', 'Mutable objects can change, immutable objects cannot.', 'intermediate'),
(15, '1', 'What is a lambda function?', 'An anonymous function defined using the lambda keyword.', 'intermediate'),
(16, '2', 'What are closures in JavaScript?', 'A closure is a function that retains access to its outer scope.', 'intermediate'),
(17, '2', 'What is the difference between == and === in JavaScript?', '== checks value equality, === checks value and type.', 'intermediate'),
(18, '2', 'What is an IIFE in JavaScript?', 'An Immediately Invoked Function Expression.', 'intermediate'),
(19, '2', 'What is event delegation?', 'A technique to handle events efficiently by using a common ancestor.', 'intermediate'),
(20, '2', 'How does prototypal inheritance work in JavaScript?', 'Objects inherit from other objects via the prototype chain.', 'intermediate'),
(21, '1', 'What are metaclasses in Python?', 'Metaclasses define the behavior of classes.', 'advanced'),
(22, '1', 'How does Python handle memory management?', 'Python uses reference counting and garbage collection.', 'advanced'),
(23, '1', 'What is the Global Interpreter Lock (GIL)?', 'A mutex that prevents multiple threads from executing Python bytecode concurrently.', 'advanced'),
(24, '1', 'What are Python generators?', 'Generators are functions that yield values lazily using the yield keyword.', 'advanced'),
(25, '1', 'Explain multithreading vs multiprocessing in Python.', 'Multithreading runs in the same process; multiprocessing uses separate processes.', 'advanced'),
(26, '2', 'What are promises in JavaScript?', 'Promises represent the eventual completion or failure of an async operation.', 'advanced'),
(27, '2', 'What is async/await in JavaScript?', 'A syntax for handling asynchronous operations in a synchronous manner.', 'advanced'),
(28, '2', 'What is the event loop in JavaScript?', 'The event loop handles execution of asynchronous tasks.', 'advanced'),
(29, '2', 'How does hoisting work in JavaScript?', 'Variable and function declarations are moved to the top of their scope.', 'advanced'),
(30, '2', 'What is memoization in JavaScript?', 'A technique to cache function results for performance optimization.', 'advanced'),
(31, '3', 'What is Django?', 'Django is a high-level Python web framework.', 'basic'),
(32, '3', 'How do you install Django?', 'Using pip: pip install django.', 'basic'),
(33, '3', 'What is a Django model?', 'A Django model is a class that defines the structure of database tables.', 'basic'),
(34, '3', 'What is the purpose of settings.py?', 'settings.py contains configuration settings for the Django project.', 'basic'),
(35, '3', 'What is a Django view?', 'A view is a function that handles HTTP requests and responses.', 'basic'),
(36, '8', 'What is HTML?', 'HTML is the standard markup language for creating web pages.', 'basic'),
(37, '8', 'What is the role of the <head> tag?', 'The <head> tag contains metadata and links to external resources.', 'basic'),
(38, '8', 'What is the <body> tag used for?', 'The <body> tag contains the main content of an HTML document.', 'basic'),
(39, '8', 'What are HTML attributes?', 'Attributes provide additional information about HTML elements.', 'basic'),
(40, '8', 'What is a hyperlink in HTML?', 'A hyperlink is created using the <a> tag to navigate to another page.', 'basic'),
(41, '3', 'What is Django ORM?', 'Django ORM is an abstraction layer for interacting with the database.', 'intermediate'),
(42, '3', 'How do you create a Django model?', 'Define a class in models.py and inherit from models.Model.', 'intermediate'),
(43, '3', 'What is a Django middleware?', 'Middleware is a framework to process requests and responses.', 'intermediate'),
(44, '3', 'How do you handle static files in Django?', 'Use the STATICFILES_DIRS setting and manage them using collectstatic.', 'intermediate'),
(45, '3', 'What is the use of the Django admin panel?', 'The admin panel allows managing models via a web interface.', 'intermediate'),
(46, '8', 'What are semantic HTML elements?', 'Semantic elements clearly define their meaning, e.g., <article>, <section>.', 'intermediate'),
(47, '8', 'What is the difference between inline and block elements?', 'Inline elements do not start a new line, block elements do.', 'intermediate'),
(48, '8', 'How do you create a table in HTML?', 'Using <table>, <tr>, <td>, and <th> tags.', 'intermediate'),
(49, '8', 'What is an iframe in HTML?', 'An iframe embeds another document within the current page.', 'intermediate'),
(50, '8', 'What is the difference between HTML and XHTML?', 'XHTML is a stricter version of HTML with XML rules.', 'intermediate'),
(51, '3', 'What is Django REST Framework?', 'DRF is a toolkit for building web APIs in Django.', 'advanced'),
(52, '3', 'How do you implement authentication in Django?', 'Using Django’s built-in authentication system or third-party libraries.', 'advanced'),
(53, '3', 'What are Django signals?', 'Django signals allow decoupled components to communicate.', 'advanced'),
(54, '3', 'What is caching in Django?', 'Caching stores frequently used data to improve performance.', 'advanced'),
(55, '3', 'How do you deploy a Django application?', 'Using a WSGI server like Gunicorn and a web server like Nginx.', 'advanced'),
(56, '8', 'What is the role of ARIA in HTML?', 'ARIA improves accessibility for dynamic content.', 'advanced'),
(57, '8', 'How do you optimize HTML for SEO?', 'Using proper headings, meta tags, and structured data.', 'advanced'),
(58, '8', 'What is lazy loading in HTML?', 'Lazy loading defers loading images until needed.', 'advanced'),
(59, '8', 'How do you implement a responsive design in HTML?', 'Using media queries and flexible layouts.', 'advanced'),
(60, '8', 'What are Web Components?', 'Web Components allow creating reusable custom elements.', 'advanced'),
(61, '4', 'What is Microsoft Excel?', 'Microsoft Excel is a spreadsheet tool for organizing, analyzing, and visualizing data. It enables calculations, charts, and data modeling for various industries.\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n', 'basic'),
(62, '4', 'What is a cell in Excel?', 'A cell is the smallest unit in Excel, located at a row and column intersection. It holds text, numbers, or formulas and is identified by an address like A1.', 'basic'),
(63, '4', 'How do you save a file in Excel?', 'You can save your file using the excel shortcut Ctrl + S or by navigating to File > Save As. This allows you to save your work in various formats, including .xlsx, .xls, or .csv.', 'basic'),
(64, '4', 'What is a workbook in Excel?', 'A workbook is an Excel file that contains one or more worksheets. It allows you to organize related data into multiple sheets for easier analysis and management.', 'basic'),
(65, '4', 'How do you insert a new worksheet?', 'To insert a worksheet, click the + button at the bottom of the screen or use the shortcut Shift + F11. This creates a blank worksheet within the same workbook.', 'basic'),
(66, '4', 'What is the Ribbon in Excel?', 'The Ribbon is the toolbar at the top of Excel that contains various tabs and commands. It is divided into sections like Home, Insert, Data, and Formulas, each offering specific tools for your tasks.', 'basic'),
(67, '4', 'How do you use Undo and Redo in Excel?', 'Undo allows you to reverse your last action (Ctrl + Z), while Redo re-applies an undone action (Ctrl + Y). These shortcuts are useful for correcting mistakes or reapplying changes.', 'basic'),
(68, '4', 'What is the shortcut for copying data?', 'Use Ctrl + C to copy and Ctrl + V to paste data. This is a quick way to duplicate data or formulas between cells.', 'basic'),
(69, '4', 'What is the formula bar in Excel?', 'The formula bar is a field at the top of the Excel window that displays the contents of the selected cell. It’s especially useful for viewing and editing formulas.', 'basic'),
(70, '4', ' How do you merge cells in Excel?', 'To merge cells, select the cells you want to combine and click Merge & Center in the Home tab. This is often used for creating headings or labels.', 'basic'),
(71, '4', ' What is the difference between a column and a row?', 'Columns are vertical sections identified by letters (A, B, C), while rows are horizontal sections identified by numbers (1, 2, 3). Together, they form the grid of an Excel worksheet.', 'basic'),
(72, '4', 'How do you wrap text in a cell?', 'To wrap text, select a cell and click Wrap Text in the Home tab. This adjusts the cell content to fit within its boundaries without spilling over into adjacent cells.', 'basic'),
(73, '4', 'What are cell references in Excel?', 'Cell references specify a cell’s location in a formula. Relative references (e.g., A1) adjust when copied, absolute references (e.g., $A$1) remain fixed, and mixed references (e.g., $A1) partially adjust.', 'basic'),
(74, '4', 'How do you delete a worksheet?', 'Right-click the sheet tab and select Delete. Deleting a sheet permanently removes its data, so it’s recommended to back up your workbook first.', 'basic'),
(75, '4', 'How do you adjust column width?', 'Drag the boundary of a column header to resize it manually or double-click the boundary to auto-adjust based on the longest cell content.', 'basic'),
(76, '4', 'What is a formula in Excel?', 'A formula is an expression that calculates the value of a cell. It begins with = and can include operators, cell references, and functions (e.g., =A1+B1).', 'basic');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE IF NOT EXISTS `skills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_post_id` int(11) DEFAULT NULL,
  `skill_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `job_post_id` (`job_post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `job_post_id`, `skill_name`) VALUES
(1, 1, 'Python'),
(2, 1, 'JavaScript'),
(3, 1, 'Django'),
(4, 2, 'Excel'),
(5, 2, 'SQL'),
(6, 2, 'PowerBI'),
(7, 1, 'java'),
(8, 1, 'html'),
(9, 2, 'css');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `phone`, `password`) VALUES
(1, 'mike', 'mike@gmail.com', '9876543456', '123');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `skills`
--
ALTER TABLE `skills`
  ADD CONSTRAINT `skills_ibfk_1` FOREIGN KEY (`job_post_id`) REFERENCES `job_post` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
