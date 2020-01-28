-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2019 at 08:25 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bank`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `interest` (IN `accid` INT(10) UNSIGNED, IN `type` VARCHAR(15))  READS SQL DATA
BEGIN
DECLARE cur_date date;
DECLARE due date;
SET cur_date = CURRENT_DATE();
SET due =( SELECT bill.due_date FROM bill WHERE bill.account_id=accid AND bill.billtype=type);
IF cur_date>=due THEN
UPDATE bill SET bill.amount=bill.amount*1.15 WHERE bill.account_id=accid AND bill.billtype=type;
UPDATE bill SET bill.due_date= ADDDATE(bill.due_date,INTERVAL 1 MONTH) WHERE bill.account_id=accid AND bill.billtype=type;
END if;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int(5) NOT NULL,
  `account_type` varchar(15) NOT NULL,
  `balance` int(10) NOT NULL,
  `date` date NOT NULL,
  `cust_id` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `account_type`, `balance`, `date`, `cust_id`) VALUES
(150012001, 'savings', 350758, '2019-10-11', 1000),
(150012002, 'savings', 98897, '2017-07-10', 1001),
(150012003, 'savings', 342843, '2017-09-11', 1002),
(150012004, 'savings', 222595, '2018-03-18', 1003),
(150012005, 'savings', 144324, '2019-05-07', 1004),
(150012006, 'savings', 65455, '2018-12-31', 1005),
(150012007, 'savings', 178657, '2019-05-14', 1006);

-- --------------------------------------------------------

--
-- Table structure for table `ben`
--

CREATE TABLE `ben` (
  `account_id` int(5) NOT NULL,
  `ben_name` varchar(20) NOT NULL,
  `ben_account` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ben`
--

INSERT INTO `ben` (`account_id`, `ben_name`, `ben_account`) VALUES
(150012001, 'adithya', 150012001),
(150012001, 'amaey', 150012002),
(150012001, 'abhi', 150012003),
(150012002, 'adithya', 150012001),
(150012003, 'adithya', 150012001),
(150012004, 'adi', 150012001),
(150012007, 'adi', 150012001);

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `account_id` int(5) NOT NULL,
  `billtype` varchar(50) NOT NULL,
  `amount` int(6) NOT NULL,
  `due_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`account_id`, `billtype`, `amount`, `due_date`) VALUES
(150012001, 'credit card', 43244, '2019-12-13'),
(150012001, 'electricity', 2200, '2019-11-12'),
(150012001, 'Mobile recharge ', 2530, '2019-12-05'),
(150012001, 'water', 2300, '2019-12-24'),
(150012002, 'Credit card', 4545, '2019-12-03'),
(150012002, 'Electricity', 5765, '2019-12-10'),
(150012002, 'Mobile recharge ', 419, '2019-12-19'),
(150012002, 'Water', 324, '2019-11-06'),
(150012003, 'credit card', 23434, '2019-12-26'),
(150012003, 'electricity', 1727, '2019-11-12'),
(150012003, 'Mobile recharge ', 343, '2019-12-17'),
(150012003, 'water', 599, '2019-11-04'),
(150012004, 'credit card', 9494, '2019-12-12'),
(150012004, 'electricity', 5045, '2019-11-06'),
(150012004, 'Mobile recharge ', 200, '2019-11-12'),
(150012004, 'water', 4540, '2019-11-20'),
(150012005, 'credit card', 8384, '2019-12-15'),
(150012005, 'electricity', 3353, '2019-11-14'),
(150012005, 'Mobile recharge ', 999, '2019-12-11'),
(150012005, 'water', 484, '2019-11-15'),
(150012006, 'credit card', 3477, '2019-11-16'),
(150012006, 'electricity', 5958, '2019-11-01'),
(150012006, 'Mobile recharge ', 199, '2019-11-07'),
(150012006, 'water', 2344, '2019-12-21'),
(150012007, 'credit card', 1231, '2019-12-12'),
(150012007, 'electricity', 0, '0000-00-00'),
(150012007, 'Mobile recharge ', 453, '0000-00-00'),
(150012007, 'water', 4535, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branch_id` int(5) NOT NULL,
  `location` varchar(100) NOT NULL,
  `total_employess` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_id`, `location`, `total_employess`) VALUES
(1, 'mg road', 3),
(2, 'jp nagar', 3),
(3, 'jayanagar', 3);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cust_id` int(5) NOT NULL,
  `cust_name` varchar(50) NOT NULL,
  `cust_phone` varchar(10) NOT NULL,
  `cust_email` varchar(100) NOT NULL,
  `cust_username` varchar(25) NOT NULL,
  `cust_password` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `txn_password` varchar(10) DEFAULT NULL,
  `custimg` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cust_id`, `cust_name`, `cust_phone`, `cust_email`, `cust_username`, `cust_password`, `address`, `txn_password`, `custimg`) VALUES
(1000, 'Adithya', '8792808526', 'adithyakaushik326@gmail.com', 'adithyakaushik', 'adithya326', 'jp nagar', '1234', 'img/adithya.jpg'),
(1001, 'Amey', '9980196833', 'ameyaditya.j@gmail.com', 'amey123', '1234', 'abcdac', '1111', 'img/amey.jpg'),
(1002, 'Abhinav', '8317488323', 'abhinav@gmail.com', 'abhinavsk', 'abhi', 'bangalore ,jp nagar', '58845', 'img/abhi.jpg'),
(1003, 'Rajkumar', '9945001531', 'rajkumar@gmail.com', 'rajkumar', 'raj@123', 'channasandra,bangalore', '9945', 'img/raj.jpg'),
(1004, 'Sudarshan', '9449215902', 'sudarshan@gmail.com', 'sudharshan', 'shad1234', 'banashankari 3rd stage', '94492', 'img/sud.jpg'),
(1005, 'Kalpaj', '8197988998', 'kalpaj@gmail.com', 'kalpaj', 'kap123', 'Rnsit, bangalore', '8197', 'img/kap.jpg'),
(1006, 'anirudh', '8310906617', 'anirudh101298@gmail.com', 'anirudh', 'ani', 'elita, jp nagar ', '8310', 'img/ani.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` int(5) NOT NULL,
  `emp_name` varchar(20) NOT NULL,
  `branch_id` int(5) NOT NULL,
  `emp_img` varchar(50) NOT NULL,
  `designation` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `emp_name`, `branch_id`, `emp_img`, `designation`, `email`) VALUES
(2001, 'soumya', 3, 'img/soumya.jpg', 'manager', 'soumya@ezpay.com'),
(2002, 'vinutha', 3, 'img/vinutha.jpg', ' chief manager', 'vinutha@ezpay.com'),
(2003, 'prakash', 3, 'img/prakash.jpg', 'senior manager', 'prakasha@ezpay.com'),
(2004, 'ramesh', 2, 'img/ramesh.jpg', 'chief manager', 'ramesh@ezpay.com'),
(2005, 'santhosh', 2, 'img/santhosh.jpg', 'manager', 'santhosh@ezpay.com'),
(2006, 'hema n', 2, 'img/hema.jpg', 'senior manager', 'hema@ezpay.com'),
(2007, 'sudha v', 1, 'img/sudha.jpg', 'senior manager', 'sudha@ezpay.com'),
(2008, 'kusuma', 1, 'img/kusuma.jpg', 'chief manager', 'kusuma@ezpay.com'),
(2009, 'shridhar', 1, 'img/shridhar.jpg', 'manager', 'shirdhar@ezpay.com');

-- --------------------------------------------------------

--
-- Table structure for table `txn`
--

CREATE TABLE `txn` (
  `account_id` int(5) NOT NULL,
  `type` varchar(10) NOT NULL,
  `ben_name` varchar(20) NOT NULL,
  `amount` int(10) NOT NULL,
  `balance` int(5) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `txn`
--

INSERT INTO `txn` (`account_id`, `type`, `ben_name`, `amount`, `balance`, `date`, `time`) VALUES
(150012004, 'paid', 'Electricity bill', 2342, 233998, '2019-11-03', '09:11:43'),
(150012004, 'paid', 'Water bill', 999, 232999, '2019-11-03', '09:11:59'),
(150012001, 'sent', 'amaey', 4, 356380, '2019-11-03', '02:23:35'),
(150012002, 'recieved', 'adithyakaushik', 4, 99397, '2019-11-03', '02:23:35'),
(150012001, 'paid', 'Electricity bill', 1200, 355180, '2019-11-07', '01:11:47'),
(150012001, 'paid', 'Electricity bill', 0, 355180, '2019-11-07', '01:11:56'),
(150012007, 'paid', 'Electricity bill', 9292, 40708, '2019-11-07', '02:11:32'),
(150012007, 'sent', 'adi', 40707, 1, '2019-11-07', '02:59:10'),
(150012001, 'recieved', 'anirudh', 40707, 395887, '2019-11-07', '02:59:10'),
(150012007, 'paid', 'Electricity bill', 0, 1, '2019-11-07', '03:11:20'),
(150012002, 'paid', 'Electricity bill', 1000, 98397, '2019-11-07', '04:11:20'),
(150012001, 'paid', 'Mobile recharge bill', 3, 395884, '2019-11-07', '09:11:47'),
(150012001, 'paid', 'Mobile recharge bill', 39, 395845, '2019-11-07', '09:11:08'),
(150012003, 'paid', 'Electricity bill', 1000, 292843, '2019-11-07', '10:11:08'),
(150012003, 'sent', 'adithya', 200000, 92843, '2019-11-07', '10:22:05'),
(150012001, 'recieved', 'abhinavsk', 200000, 595845, '2019-11-07', '10:22:05'),
(150012001, 'sent', 'abhi', 250000, 345845, '2019-11-07', '10:23:17'),
(150012003, 'recieved', 'adithyakaushik', 250000, 342843, '2019-11-07', '10:23:17'),
(150012004, 'paid', 'Mobile recharge bill', 399, 232600, '2019-11-07', '10:11:33'),
(150012004, 'sent', 'adi', 10000, 222600, '2019-11-07', '10:39:34'),
(150012001, 'recieved', 'rajkumar', 10000, 355845, '2019-11-07', '10:39:34'),
(150012001, 'sent', 'amaey', 500, 355345, '2019-11-07', '10:47:15'),
(150012002, 'recieved', 'adithyakaushik', 500, 98897, '2019-11-07', '10:47:15'),
(150012001, 'paid', 'Electricity bill', 0, 355345, '2019-11-07', '11:11:54'),
(150012001, 'paid', 'Credit card bill', 4364, 350981, '2019-11-07', '11:11:38'),
(150012001, 'paid', 'Mobile recharge bill', 99, 350882, '2019-11-08', '12:11:39'),
(150012001, 'paid', 'Electricity bill', 100, 350782, '2019-11-08', '12:11:57'),
(150012004, 'paid', 'Water bill', 5, 222595, '2019-11-08', '12:11:31'),
(150012001, 'paid', 'Water bill', 24, 350758, '2019-11-08', '12:11:51');

--
-- Triggers `txn`
--
DELIMITER $$
CREATE TRIGGER `update bal` BEFORE INSERT ON `txn` FOR EACH ROW UPDATE accounts SET balance = (NEW.balance) WHERE account_id=(NEW.account_id)
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`),
  ADD KEY `afk` (`cust_id`);

--
-- Indexes for table `ben`
--
ALTER TABLE `ben`
  ADD PRIMARY KEY (`account_id`,`ben_account`),
  ADD KEY `ben_account` (`ben_account`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`account_id`,`billtype`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`),
  ADD KEY `efk` (`branch_id`);

--
-- Indexes for table `txn`
--
ALTER TABLE `txn`
  ADD KEY `to_id` (`ben_name`),
  ADD KEY `account_id` (`account_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150012009;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branch_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cust_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1010;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2010;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `afk` FOREIGN KEY (`cust_id`) REFERENCES `customer` (`cust_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ben`
--
ALTER TABLE `ben`
  ADD CONSTRAINT `ben_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`),
  ADD CONSTRAINT `ben_ibfk_2` FOREIGN KEY (`ben_account`) REFERENCES `accounts` (`account_id`);

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `efk` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `txn`
--
ALTER TABLE `txn`
  ADD CONSTRAINT `txn_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
