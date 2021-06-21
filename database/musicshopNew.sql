-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2021 at 01:43 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `musicshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_fname` varchar(50) NOT NULL,
  `admin_lname` varchar(50) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_fname`, `admin_lname`, `admin_email`, `admin_password`) VALUES
(1, 'Jeff', 'Bezos', 'jeff.bezos@email.com', 'password001'),
(2, 'Jonathan', 'Broady', 'something@email.com', 'test'),
(3, 'NewAdmin', 'Admin', 'admin.ad@email.com', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL,
  `bname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `bname`) VALUES
(1, 'Ibanez'),
(2, 'Gibson'),
(3, 'Alvarez'),
(4, 'Mitchell');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `cname` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `cname`, `image`) VALUES
(1, 'Guitar', 'ibanez2.jpg'),
(2, 'Bass', 'bass1.jpg'),
(3, 'Studio And Recording', 'std.jpg'),
(4, 'Keyboards And Synthesizers', 'cat_syn.jpg'),
(5, 'Drums and Percussions', 'cat_drums.jpg'),
(6, 'Mricrophones', 'cat_mics.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cust_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `street` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `phone` int(11) DEFAULT NULL,
  `lattitude` decimal(8,6) DEFAULT NULL,
  `longitude` decimal(9,6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cust_id`, `fname`, `lname`, `gender`, `dob`, `email`, `street`, `city`, `username`, `password`, `phone`, `lattitude`, `longitude`) VALUES
(1, 'Shreeya', 'Ramkissoon', 'Female', '2000-03-11', 'shreeyaramkissoon@gmail.com', 'Royal Road', 'Pamplemousses', 'shree', '1234', 56789762, NULL, NULL),
(2, 'Roy', 'Smith', 'Male', '2000-05-04', 'bla@email.com', 'City', 'Reduit', 'job123', '147', 12345678, '-20.233237', '57.499630'),
(3, 'Jonathan', 'Broady', 'Male', '2000-02-05', 'email@email.com', 'Street', 'City', 'Jonathan1', '1234', 12345678, NULL, NULL),
(4, 'Samuel', 'Kane', 'Female', '2000-06-15', 'ablsa@email.com', 'Street', 'Labah', 'Samuel1', '123456', 12345678, NULL, NULL),
(6, 'Danny', 'Denzongpa', 'Male', '1996-01-08', 'danny145@gmail.com', 'Cassis Street', 'Plouis', 'dan123', '5678', 56345678, NULL, NULL),
(7, 'Jessica', 'Gambit', 'Female', '1995-02-22', 'jess@yahoo.com', 'Royal Road', 'Moka', 'jess12', '54321', 56784362, NULL, NULL),
(8, 'Atomic', 'Bomb', 'Female', '2018-08-20', 'atomic.bomb@nuclear.com', 'Hiroshima', 'Nagasaki', 'atom', 'bomb', 1234567, '-20.248146', '57.610924');

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `driver_id` int(11) NOT NULL,
  `dname` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `contact` int(11) NOT NULL,
  `workday` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`driver_id`, `dname`, `dob`, `gender`, `contact`, `workday`) VALUES
(1, 'Jones', '2000-05-06', 'Male', 1235467, 'Monday'),
(2, 'Jessica', '2000-05-06', 'Female', 1235467, 'Tuesday'),
(3, 'Shreeya', '2000-05-06', 'Female', 1235467, 'Wednesday'),
(4, 'Jeremy', '2000-05-06', 'Male', 1235467, 'Thursday'),
(5, 'Someone', '2000-05-06', 'Male', 1235467, 'Friday'),
(6, 'Ram', '2000-05-06', 'Male', 1235467, 'Saturday'),
(7, 'Kratos', '2000-05-06', 'Male', 1235467, 'Sunday');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `news_id` int(11) NOT NULL,
  `article` varchar(1000) NOT NULL,
  `date` date NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_price` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `cust_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_price`, `order_date`, `cust_id`, `driver_id`) VALUES
(5, 1988, '2021-01-16', 2, 1),
(6, 989, '2021-01-16', 2, 1),
(7, 999, '2021-01-16', 2, 1),
(8, 999, '2021-01-16', 2, 1),
(9, 1998, '2021-01-17', 2, 2),
(10, 1998, '2021-01-17', 2, 2),
(11, 1998, '2021-01-17', 2, 2),
(12, 999, '2021-01-17', 2, 2),
(13, 999, '2021-01-17', 2, 2),
(14, 999, '2021-01-17', 2, 2),
(15, 989, '2021-01-17', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders2`
--

CREATE TABLE `orders2` (
  `prod_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `date_purchase` date NOT NULL,
  `driver_id` int(11) NOT NULL,
  `reviewed` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders2`
--

INSERT INTO `orders2` (`prod_id`, `cust_id`, `date_purchase`, `driver_id`, `reviewed`) VALUES
(1, 2, '2021-06-06', 2, 1),
(1, 8, '2021-06-02', 5, 1),
(7, 8, '2021-06-02', 5, 1),
(8, 8, '2021-06-02', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `prod_id` int(11) NOT NULL,
  `pname` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `instock` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prod_id`, `pname`, `description`, `price`, `image`, `instock`, `category_id`, `brand_id`) VALUES
(1, 'Gibson PRS Guitar', 'PRS Hollow Body. Very Good Guitar.', 999.9, 'prs.jpg', 10, 1, 2),
(3, 'Alvarez Regent Electric Guitar ', 'SYS250 pickup and 3-band EQ with tuner', 199, 'guitar3.jpg', 5, 1, 3),
(4, 'Ibanez Regent Guitar', 'Mahogany neck, bi-level rosewood fingerboard', 999.9, 'ibanez2.jpg', 10, 1, 1),
(5, 'Fender', 'This 1968 Fender Stratocaster  is almost too good to be true.', 4999, 'fender1.jpg', 10, 1, 1),
(7, 'Gibson Bass 5-String series', 'High-mass adjustable saddle bridge', 245.99, 'ibanez3.jpg', 8, 2, 2),
(8, 'Ibanez Acoustic Bass', 'High quality and refined sound', 999.9, 'bass1.jpg', 10, 2, 1),
(14, 'Microphone', 'Best Microphone Ever', 511, 'piano1.jpg', 10, 6, 3),
(17, 'Acoustic Guitar ', 'Intermidiate Acoustic Guitar', 256, 'guitar5.jpg', 10, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `product update`
--

CREATE TABLE `product update` (
  `prod_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `p_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `prod_reviews`
--

CREATE TABLE `prod_reviews` (
  `rev_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `date` date NOT NULL,
  `flagged` int(11) NOT NULL,
  `banned` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prod_reviews`
--

INSERT INTO `prod_reviews` (`rev_id`, `prod_id`, `cust_id`, `comment`, `rating`, `date`, `flagged`, `banned`) VALUES
(7, 7, 8, 'Very Good', 4, '0000-00-00', 0, 0),
(8, 1, 8, 'Very Good as Well', 5, '0000-00-00', 0, 0),
(9, 1, 2, 'Very VEry Good Guitar', 4, '0000-00-00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `rev_id` int(11) NOT NULL,
  `review` varchar(500) NOT NULL,
  `rev_date` date NOT NULL,
  `cust_id` int(11) NOT NULL,
  `rating` enum('1','2','3','4','5') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`rev_id`, `review`, `rev_date`, `cust_id`, `rating`) VALUES
(1, 'Very good service! Highly recommend this music shop!', '2021-01-17', 2, '1'),
(2, 'They deliver on time and product is of good quality!', '2021-01-17', 1, '1'),
(3, 'Good service. Highly recommend!', '2021-01-18', 3, '1'),
(4, 'The guitar I bought here is the finest one I\'ve had till date!', '2021-01-17', 4, '3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`driver_id`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`news_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `cust_id` (`cust_id`),
  ADD KEY `driver_id` (`driver_id`);

--
-- Indexes for table `orders2`
--
ALTER TABLE `orders2`
  ADD PRIMARY KEY (`prod_id`,`cust_id`,`date_purchase`),
  ADD KEY `cust_id` (`cust_id`),
  ADD KEY `driver_id` (`driver_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_id`,`prod_id`),
  ADD KEY `prod_id` (`prod_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prod_id`),
  ADD KEY `product_ibfk_1` (`brand_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product update`
--
ALTER TABLE `product update`
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `prod_id` (`prod_id`);

--
-- Indexes for table `prod_reviews`
--
ALTER TABLE `prod_reviews`
  ADD PRIMARY KEY (`rev_id`),
  ADD KEY `prod_id` (`prod_id`),
  ADD KEY `cust_id` (`cust_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`rev_id`),
  ADD KEY `cust_id` (`cust_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `driver_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `prod_reviews`
--
ALTER TABLE `prod_reviews`
  MODIFY `rev_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `rev_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD CONSTRAINT `newsletter_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`cust_id`) REFERENCES `customer` (`cust_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`driver_id`) REFERENCES `driver` (`driver_id`);

--
-- Constraints for table `orders2`
--
ALTER TABLE `orders2`
  ADD CONSTRAINT `orders2_ibfk_1` FOREIGN KEY (`prod_id`) REFERENCES `product` (`prod_id`),
  ADD CONSTRAINT `orders2_ibfk_2` FOREIGN KEY (`cust_id`) REFERENCES `customer` (`cust_id`),
  ADD CONSTRAINT `orders2_ibfk_3` FOREIGN KEY (`driver_id`) REFERENCES `driver` (`driver_id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`prod_id`) REFERENCES `product` (`prod_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON UPDATE CASCADE;

--
-- Constraints for table `product update`
--
ALTER TABLE `product update`
  ADD CONSTRAINT `product update_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`),
  ADD CONSTRAINT `product update_ibfk_2` FOREIGN KEY (`prod_id`) REFERENCES `product` (`prod_id`);

--
-- Constraints for table `prod_reviews`
--
ALTER TABLE `prod_reviews`
  ADD CONSTRAINT `prod_reviews_ibfk_1` FOREIGN KEY (`prod_id`) REFERENCES `orders2` (`prod_id`),
  ADD CONSTRAINT `prod_reviews_ibfk_2` FOREIGN KEY (`cust_id`) REFERENCES `orders2` (`cust_id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`cust_id`) REFERENCES `customer` (`cust_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
