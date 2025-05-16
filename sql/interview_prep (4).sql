-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2025 at 07:22 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`id`, `user_id`, `q_id`, `answer`, `status`) VALUES
(1, 1, 1, 'Python is a programming language', 'pending'),
(2, 1, 6, 'JavaScript is a scripting language', 'pending'),
(3, 1, 31, 'jingle  is a framework to create web pages', 'pending'),
(4, 1, 36, 'basically HTML refers to hypertext markup language', 'pending'),
(5, 1, 2, 'you can declare a variable in Python basically using Python variables', 'pending'),
(6, 1, 7, 'basically the difference between left v a r and constant is that  one has functional scope and the other has  beaten scope', 'pending'),
(7, 1, 32, 'basically you can install thejango using  the dejango website', 'pending'),
(8, 1, 37, 'the role of the tag is  to execute functionalities in  HTML base League  basically', 'pending'),
(9, 1, 3, 'the data types available in Python are basically  integer Boolean etc', 'pending'),
(10, 1, 8, 'JavaScript data types are basically  integer Boolean etc', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `emotions`
--

CREATE TABLE IF NOT EXISTS `emotions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `emotion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=109 ;

--
-- Dumping data for table `emotions`
--

INSERT INTO `emotions` (`id`, `timestamp`, `emotion`) VALUES
(1, '2025-04-08 17:17:32', 'happy'),
(2, '2025-04-08 17:17:34', 'happy'),
(3, '2025-04-08 17:17:35', 'happy'),
(4, '2025-04-08 17:17:36', 'sad'),
(5, '2025-04-08 17:17:37', 'sad'),
(6, '2025-04-08 17:17:39', 'sad'),
(7, '2025-04-08 17:17:40', 'sad'),
(8, '2025-04-08 17:17:41', 'sad'),
(9, '2025-04-08 17:17:42', 'sad'),
(10, '2025-04-08 17:17:43', 'sad'),
(11, '2025-04-08 17:17:45', 'sad'),
(12, '2025-04-08 17:17:46', 'sad'),
(13, '2025-04-08 17:17:47', 'sad'),
(14, '2025-04-08 17:17:48', 'sad'),
(15, '2025-04-08 17:17:49', 'sad'),
(16, '2025-04-08 17:17:51', 'sad'),
(17, '2025-04-08 17:17:52', 'sad'),
(18, '2025-04-08 17:17:53', 'sad'),
(19, '2025-04-08 17:17:54', 'sad'),
(20, '2025-04-08 17:17:56', 'sad'),
(21, '2025-04-08 17:17:57', 'sad'),
(22, '2025-04-08 17:17:58', 'sad'),
(23, '2025-04-08 17:17:59', 'happy'),
(24, '2025-04-08 17:18:01', 'happy'),
(25, '2025-04-08 17:18:02', 'happy'),
(26, '2025-04-08 17:18:03', 'happy'),
(27, '2025-04-08 17:18:04', 'happy'),
(28, '2025-04-08 17:18:05', 'happy'),
(29, '2025-04-08 17:18:07', 'happy'),
(30, '2025-04-08 17:18:08', 'happy'),
(31, '2025-04-08 17:18:09', 'happy'),
(32, '2025-04-08 17:18:10', 'happy'),
(33, '2025-04-08 17:18:12', 'happy'),
(34, '2025-04-08 17:18:13', 'happy'),
(35, '2025-04-08 17:18:14', 'happy'),
(36, '2025-04-08 17:18:15', 'happy'),
(37, '2025-04-08 17:18:17', 'happy'),
(38, '2025-04-08 17:18:18', 'happy'),
(39, '2025-04-08 17:18:19', 'happy'),
(40, '2025-04-08 17:18:20', 'happy'),
(41, '2025-04-08 17:18:21', 'happy'),
(42, '2025-04-08 17:18:23', 'happy'),
(43, '2025-04-08 17:18:24', 'happy'),
(44, '2025-04-08 17:18:25', 'happy'),
(45, '2025-04-08 17:18:26', 'happy'),
(46, '2025-04-08 17:18:28', 'happy'),
(47, '2025-04-08 17:18:29', 'happy'),
(48, '2025-04-08 17:18:30', 'happy'),
(49, '2025-04-08 17:18:31', 'happy'),
(50, '2025-04-08 17:18:33', 'sad'),
(51, '2025-04-08 17:18:34', 'sad'),
(52, '2025-04-08 17:18:35', 'sad'),
(53, '2025-04-08 17:18:36', 'sad'),
(54, '2025-04-08 17:18:37', 'sad'),
(55, '2025-04-08 17:18:39', 'sad'),
(56, '2025-04-08 17:18:40', 'sad'),
(57, '2025-04-08 17:18:41', 'sad'),
(58, '2025-04-08 17:18:42', 'sad'),
(59, '2025-04-08 17:18:44', 'sad'),
(60, '2025-04-08 17:18:45', 'sad'),
(61, '2025-04-08 17:18:46', 'happy'),
(62, '2025-04-08 17:18:47', 'happy'),
(63, '2025-04-08 17:18:49', 'happy'),
(64, '2025-04-08 17:18:50', 'happy'),
(65, '2025-04-08 17:18:51', 'happy'),
(66, '2025-04-08 17:18:52', 'happy'),
(67, '2025-04-08 17:18:53', 'happy'),
(68, '2025-04-08 17:18:55', 'happy'),
(69, '2025-04-08 17:18:56', 'happy'),
(70, '2025-04-08 17:18:57', 'happy'),
(71, '2025-04-08 17:18:58', 'happy'),
(72, '2025-04-08 17:19:00', 'happy'),
(73, '2025-04-08 17:19:01', 'happy'),
(74, '2025-04-08 17:19:02', 'happy'),
(75, '2025-04-08 17:19:03', 'happy'),
(76, '2025-04-08 17:19:05', 'happy'),
(77, '2025-04-08 17:19:06', 'happy'),
(78, '2025-04-08 17:19:07', 'happy'),
(79, '2025-04-08 17:19:08', 'happy'),
(80, '2025-04-08 17:19:09', 'happy'),
(81, '2025-04-08 17:19:11', 'happy'),
(82, '2025-04-08 17:19:12', 'happy'),
(83, '2025-04-08 17:19:13', 'happy'),
(84, '2025-04-08 17:19:14', 'happy'),
(85, '2025-04-08 17:19:16', 'happy'),
(86, '2025-04-08 17:19:17', 'happy'),
(87, '2025-04-08 17:19:18', 'happy'),
(88, '2025-04-08 17:19:19', 'happy'),
(89, '2025-04-08 17:19:21', 'happy'),
(90, '2025-04-08 17:19:22', 'happy'),
(91, '2025-04-08 17:19:23', 'happy'),
(92, '2025-04-08 17:19:24', 'happy'),
(93, '2025-04-08 17:19:25', 'happy'),
(94, '2025-04-08 17:19:27', 'happy'),
(95, '2025-04-08 17:19:28', 'happy'),
(96, '2025-04-08 17:19:29', 'happy'),
(97, '2025-04-08 17:19:30', 'happy'),
(98, '2025-04-08 17:19:32', 'happy'),
(99, '2025-04-08 17:19:33', 'happy'),
(100, '2025-04-08 17:19:34', 'happy'),
(101, '2025-04-08 17:19:35', 'happy'),
(102, '2025-04-08 17:19:36', 'happy'),
(103, '2025-04-08 17:19:38', 'happy'),
(104, '2025-04-08 17:19:39', 'happy'),
(105, '2025-04-08 17:19:40', 'happy'),
(106, '2025-04-08 17:19:41', 'happy'),
(107, '2025-04-08 17:19:43', 'happy'),
(108, '2025-04-08 17:19:44', 'happy');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `job_profile`
--

INSERT INTO `job_profile` (`id`, `user_id`, `college`, `degree`, `cgpa`, `job_role`, `skills`, `experience`) VALUES
(1, 1, 'Rajagiri School of Engineering & Technology', 'Btech', '7.2', '1', '1,2,3,8', '0'),
(2, 2, '', '', '', '1', '1,2,8', '2'),
(3, 3, '', '', '', '1', '1,2,8', '2');

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
(1, '1', 'What is Python?', 'Python is a high-level, interpreted programming language that is widely known for its simplicity and readability. It supports multiple programming paradigms, including procedural, object-oriented, and functional programming. Python is extensively used across various domains such as web development, data science, artificial intelligence, and automation, primarily due to its comprehensive standard library and active community support.', 'basic'),
(2, '1', 'How do you declare a variable in Python?', 'In Python, a variable is declared by assigning a value to a name without explicitly defining its type. Since Python is dynamically typed, it determines the data type at runtime based on the assigned value. ', 'basic'),
(3, '1', 'What data types are available in Python?', 'Python offers a variety of built-in data types to handle different kinds of data efficiently. These include numeric types such as integers, floating-point numbers, and complex numbers; sequence types like lists, tuples, and ranges; and mapping types such as dictionaries.', 'basic'),
(4, '1', 'What is a list in Python?', 'A list in Python is an ordered, mutable collection that can store elements of different data types. Lists are commonly used for data manipulation since they allow adding, removing, and modifying elements while preserving their order.', 'basic'),
(5, '1', 'How do you define a function in Python?', 'A function in Python is defined using the def keyword, followed by the function name and parentheses. The function body is indented, and a return statement can be used to return a value.', 'basic'),
(6, '2', 'What is JavaScript?', 'JavaScript is a high-level, interpreted programming language primarily used to create dynamic and interactive web applications. It supports multiple programming paradigms, including object-oriented, functional, and event-driven programming. JavaScript runs in web browsers but is also used on the server side with environments like Node.js, making it a crucial technology for full-stack development.', 'basic'),
(7, '2', 'What is the difference between let, var, and const?', 'In JavaScript, var, let, and const are used to declare variables but differ in scope and reassignment behavior. The var keyword has function scope and allows redeclaration, making it less predictable in modern development. The let keyword introduces block-scoping, preventing unintended variable redeclarations. The const keyword also has block scope but is used for values that should not be reassigned after declaration, making it ideal for constants.', 'basic'),
(8, '2', 'What are JavaScript data types?', 'JavaScript provides a variety of data types, broadly classified into primitive and reference types. Primitive types include numbers, strings, booleans, undefined, null, symbols, and BigInt. Reference types, such as objects, arrays, functions, and dates, allow storing more complex structures. ', 'basic'),
(9, '2', 'What is an array in JavaScript?', 'An array is a collection of elements stored in a single variable.', 'basic'),
(10, '2', 'How do you declare a function in JavaScript?', 'Using function keyword, e.g., function myFunction() {}', 'basic'),
(11, '1', 'What is list comprehension in Python?', 'List comprehension is a concise way to create lists in Python using a single line of code. It allows iteration over an iterable, applying expressions or conditions within square brackets, making list creation efficient and readable.', 'intermediate'),
(12, '1', 'What is the difference between shallow copy and deep copy?', 'A shallow copy creates a new object but only copies references to the nested objects, meaning changes to the nested objects in one copy affect the original. A deep copy, however, creates a completely independent duplicate of the original, including all nested elements.', 'intermediate'),
(13, '1', 'What is a Python decorator?', 'A Python decorator is a function that modifies another function’s behavior without altering its structure. It is used to add functionality like logging, authentication, or performance monitoring.', 'intermediate'),
(14, '1', 'What is the difference between mutable and immutable objects?', ' Mutable objects can be modified after they are created, whereas immutable objects cannot be changed once they are assigned a value. Lists and dictionaries are mutable, while tuples and strings are immutable.', 'intermediate'),
(15, '1', 'What is a lambda function?', 'A lambda function is an anonymous function in Python that is defined using the lambda keyword. It can take multiple arguments but contains only a single expression, making it useful for short, simple operations.', 'intermediate'),
(16, '2', 'What are closures in JavaScript?', 'A closure is a function that retains access to its parent function’s variables even after the parent function has finished executing. It enables data encapsulation and is commonly used in JavaScript.', 'intermediate'),
(17, '2', 'What is the difference between == and === in JavaScript?', 'The = operator is used for assignment, meaning it assigns values to variables. The == operator is used for comparison, checking whether two values are equal while performing type conversion if necessary.', 'intermediate'),
(18, '2', 'What is an IIFE in JavaScript?', 'An Immediately Invoked Function Expression (IIFE) is a function that is executed immediately after its definition. It is commonly used to avoid polluting the global namespace and to create a private execution context.', 'intermediate'),
(19, '2', 'What is event delegation?', 'Event delegation is a technique where a parent element listens for events on its child elements instead of adding event listeners to each child separately. This improves performance and allows handling dynamically added elements.', 'intermediate'),
(20, '2', 'How does prototypal inheritance work in JavaScript?', 'Prototypal inheritance allows objects to inherit properties and methods from other objects through the prototype chain. When a property or method is accessed, JavaScript first checks the object itself before looking up the prototype chain.', 'intermediate'),
(21, '1', 'What are metaclasses in Python?', 'A metaclass in Python is a class that defines the behavior of other classes. It controls how classes are created and allows advanced customizations in object-oriented programming.', 'advanced'),
(22, '1', 'How does Python handle memory management?', 'Python uses reference counting and garbage collection.', 'advanced'),
(23, '1', 'What is the Global Interpreter Lock (GIL)?', 'A mutex that prevents multiple threads from executing Python bytecode concurrently.', 'advanced'),
(24, '1', 'What are Python generators?', 'Generators are functions that yield values lazily using the yield keyword.', 'advanced'),
(25, '1', 'Explain multithreading vs multiprocessing in Python.', 'Multithreading runs in the same process; multiprocessing uses separate processes.', 'advanced'),
(26, '2', 'What are promises in JavaScript?', 'Promises represent the eventual completion or failure of an async operation.', 'advanced'),
(27, '2', 'What is async/await in JavaScript?', 'A syntax for handling asynchronous operations in a synchronous manner.', 'advanced'),
(28, '2', 'What is the event loop in JavaScript?', 'The event loop handles execution of asynchronous tasks.', 'advanced'),
(29, '2', 'How does hoisting work in JavaScript?', 'Variable and function declarations are moved to the top of their scope.', 'advanced'),
(30, '2', 'What is memoization in JavaScript?', 'A technique to cache function results for performance optimization.', 'advanced'),
(31, '3', 'What is Django?', 'Django is a high-level web framework for Python that helps developers build secure and scalable web applications quickly. It follows the ''don''t repeat yourself'' principle, meaning it helps avoid redundant code. Django provides tools for things like handling databases, user authentication, and routing, which speeds up the development process.', 'basic'),
(32, '3', 'How do you install Django?', 'To install Django, you first need to have Python installed. Then, you can use Python''s package manager, pip, to install Django by running the command: pip install django in your terminal or command prompt.', 'basic'),
(33, '3', 'What is a Django model?', 'A Django model is a class that defines the structure of database tables.', 'basic'),
(34, '3', 'What is the purpose of settings.py?', 'settings.py contains configuration settings for the Django project.', 'basic'),
(35, '3', 'What is a Django view?', 'A view is a function that handles HTTP requests and responses.', 'basic'),
(36, '8', 'What is HTML?', 'HTML, or HyperText Markup Language, is the standard language used to create and design the structure of web pages. It defines the elements on a webpage, such as headings, paragraphs, links, images, and forms, by using tags. HTML is not a programming language; it''s a markup language that structures the content on the web.', 'basic'),
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
(60, '8', 'What are Web Components?', 'Web Components allow creating reusable custom elements.', 'advanced');

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
(2, 2, 'JavaScript'),
(3, 1, 'Django'),
(4, 3, 'Excel'),
(5, 3, 'SQL'),
(6, 3, 'PowerBI'),
(7, 1, 'java'),
(8, 2, 'html'),
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `phone`, `password`) VALUES
(1, 'mike', 'mike@gmail.com', '9876543456', '123'),
(2, 'Tessa', 'tessas@gmail.com', '9876543456', '564'),
(3, 'tez', 'tessa@gmail.com', '9876543456', '123');

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
