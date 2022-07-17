-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2022 at 07:38 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `password`) VALUES
('admin', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` varchar(255) NOT NULL,
  `book_name` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `quantity` int(100) NOT NULL,
  `issued` int(100) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `book_name`, `author`, `quantity`, `issued`, `image`) VALUES
('1001', 'Web Technologies: HTML, JavaScript, PHP, Java, JSP ASP.Net, XML and AJAX Black Book, (with CD)', 'Kogent Solutions', 10, 2, 'book.jpg'),
('1002', 'ANSI C Programming', 'Bronson, Gray J. | Hurd, Andy', 10, 1, 'book.jpg'),
('1003', 'Data Structures', 'Lipschutz, Seymour | Pai, G. A. Vijayalakshmi', 15, 2, 'book.jpg'),
('1004', 'Data Structure using C', 'Desai, M. J.', 20, 1, 'book.jpg'),
('1005', 'JAVA Programming', 'Malik, D. S.', 20, 1, 'book.jpg'),
('1006', 'Computer Networking: A Top-down Approach', 'Jim Kurose', 10, 2, 'book.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `issue`
--

CREATE TABLE `issue` (
  `issue_id` int(11) NOT NULL,
  `book_id` varchar(255) NOT NULL,
  `borrower_id` int(11) NOT NULL,
  `issue_date` date NOT NULL DEFAULT current_timestamp(),
  `return_date` date NOT NULL,
  `returned` int(11) GENERATED ALWAYS AS (`date_returned` is not null) VIRTUAL,
  `days_remaining` int(11) GENERATED ALWAYS AS (if(`returned` > 0,0,to_days(`return_date`) - to_days(curdate()))) VIRTUAL,
  `date_returned` date DEFAULT NULL,
  `fine` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `issue`
--

INSERT INTO `issue` (`issue_id`, `book_id`, `borrower_id`, `issue_date`, `return_date`, `date_returned`, `fine`) VALUES
(44, '1002', 11001, '2022-04-16', '2022-04-30', NULL, 0),
(45, '1001', 22002, '2022-05-07', '2022-05-21', '2022-05-07', 0),
(46, '1004', 22002, '2022-04-01', '2022-04-14', NULL, 0),
(47, '1003', 11002, '2022-05-07', '2022-05-21', NULL, 0),
(48, '1001', 22001, '2022-05-07', '2022-05-21', NULL, 0),
(50, '1006', 22002, '2022-04-26', '2022-05-10', NULL, 0),
(51, '1003', 22002, '2022-05-07', '2022-05-21', NULL, 0),
(52, '1001', 11001, '2022-05-07', '2022-05-21', '2022-05-07', 0),
(53, '1006', 11001, '2022-04-26', '2022-05-10', NULL, 0),
(54, '1005', 11001, '2022-05-07', '2022-05-21', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `fathers_name` varchar(255) NOT NULL,
  `course` varchar(60) NOT NULL,
  `section` varchar(25) NOT NULL,
  `department` varchar(25) NOT NULL,
  `semester` varchar(5) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type`, `name`, `fathers_name`, `course`, `section`, `department`, `semester`, `password`, `image`) VALUES
(11001, 'teacher', 'John', 'Victor', '', '', 'CSE', '', '81dc9bdb52d04dc20036dbd8313ed055', 'avatar.png'),
(11002, 'teacher', 'Mathew', 'Robert', '', '', 'CSE', '', '81dc9bdb52d04dc20036dbd8313ed055', 'avatar.png'),
(22001, 'student', 'Mark', 'Julius', 'BSc', 'A', 'CSE', '6th', '81dc9bdb52d04dc20036dbd8313ed055', 'avatar.png'),
(22002, 'student', 'James', 'John', 'BSc', 'B', 'CSE', '8th', '81dc9bdb52d04dc20036dbd8313ed055', 'avatar.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `issue`
--
ALTER TABLE `issue`
  ADD PRIMARY KEY (`issue_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `issue`
--
ALTER TABLE `issue`
  MODIFY `issue_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;
