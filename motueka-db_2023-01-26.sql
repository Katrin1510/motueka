-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 26, 2023 at 06:35 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `motueka`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `bookingID` int NOT NULL,
  `customerID` int DEFAULT NULL,
  `roomID` int DEFAULT NULL,
  `checkInDate` date DEFAULT NULL,
  `checkOutDate` date DEFAULT NULL,
  `contactNumber` varchar(50) DEFAULT NULL,
  `bookingExtras` text,
  `roomReview` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`bookingID`, `customerID`, `roomID`, `checkInDate`, `checkOutDate`, `contactNumber`, `bookingExtras`, `roomReview`) VALUES
(1, 20, 8, '2022-04-12', '2022-12-14', '684-425-3517', 'blandit lacinia', 'duis bibendum felis sed interdum venenatis turpis'),
(2, 20, 7, '2022-05-16', '2022-05-20', '984-612-5910', 'eu nibh', 'nunc commodo placerat praesent blandit nam nulla integer pede justo lacinia eget tincidunt'),
(3, 9, 12, '2022-12-15', '2022-12-16', 'sdsdd', NULL, 'consectetuer'),
(4, 1, 12, '2022-05-02', '2022-05-10', '738-320-3800', 'tincidunt eget', 'et magnis dis parturient montes nascetur ridiculus mus vivamus vestibulum sagittis'),
(5, 8, 7, '2022-08-26', '2022-08-31', '622-124-4461', 'ipsum integer', 'pretium quis'),
(6, 1, 7, '2022-12-18', '2022-12-21', '839-183-0513', 'nascetur ridiculus', 'felis eu sapien cursus'),
(7, 5, 14, '2022-11-20', '2022-11-23', '584-531-0176', 'eu nibh', 'amet diam in magna bibendum imperdiet nullam orci pede venenatis non sodales sed tincidunt eu felis fusce posuere felis sed'),
(8, 16, 7, '2022-12-11', '2022-12-21', '433-221-8157', 'aliquet at', 'at velit vivamus vel nulla eget eros elementum'),
(9, 2, 2, '2022-10-25', '2022-10-30', '809-800-1766', 'metus aenean', 'nibh in lectus pellentesque at nulla suspendisse potenti cras'),
(10, 1, 7, '2022-12-23', '2022-12-31', '959-412-9686', 'consequat lectus', 'tellus semper interdum mauris ullamcorper purus sit amet nulla quisque arcu libero rutrum ac lobortis'),
(12, 5, 2, '2022-06-29', '2022-07-04', '338-983-1293', 'fermentum justo', 'a ipsum integer a nibh'),
(13, 1, 7, '2022-06-24', '2022-07-13', '780-766-1199', 'id ornare', 'nulla nunc purus phasellus in felis donec semper sapien a libero'),
(14, 11, 1, '2022-08-04', '2022-08-10', '163-966-7034', 'platea dictumst', 'vulputate justo in blandit ultrices enim lorem ipsum dolor'),
(15, 19, 9, '2022-02-03', '2022-02-16', '409-519-6928', 'ultrices posuere', 'quis augue luctus tincidunt nulla mollis molestie lorem quisque ut erat curabitur gravida nisi at nibh'),
(16, 8, 11, '2022-08-08', '2022-08-17', '221-851-2492', 'ac tellus', 'eu magna vulputate luctus'),
(17, 5, 14, '2022-03-09', '2022-03-10', '557-635-5456', 'nisl aenean', 'quis orci'),
(18, 18, 3, '2022-10-26', '2022-10-31', 'consectetuer adipisc', NULL, 'sollicitudin mi sit amet lobortis sapien sapien non'),
(19, 18, 4, '2022-07-08', '2022-07-21', '880-633-4608', 'ultrices posuere', 'tellus nisi eu');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerID` int NOT NULL,
  `firstname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `lastname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'temp1234',
  `role` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerID`, `firstname`, `lastname`, `email`, `password`, `role`) VALUES
(1, 'Cherlyn', 'Gunson', 'cgunson0@twitter.com', '.', 0),
(2, 'Chrysa', 'Brugden', 'cbrugden1@ca.gov', '.', 0),
(3, 'Keenan', 'Chestle', 'kchestle2@sohu.com', '.', 0),
(4, 'Liana', 'MacSherry', 'lmacsherry3@alexa.com', '.', 0),
(5, 'Olly', 'Simko', 'osimko4@delicious.com', '.', 0),
(6, 'Leoine', 'Schwartz', 'lschwartz5@wikipedia.org', '.', 0),
(7, 'Kailey', 'Raw', 'kraw6@aol.com', '.', 0),
(8, 'Ilysa', 'Kupisz', 'ikupisz7@seattletimes.com', '.', 0),
(9, 'Any', 'Bails', 'abails8@nasa.gov', '.', 0),
(10, 'Linnell', 'Deakins', 'ldeakins9@cbslocal.com', '.', 0),
(11, 'Otes', 'Kleinberer', 'okleinberera@cnn.com', '.', 0),
(12, 'Phillipp', 'Krikorian', 'pkrikorianb@delicious.com', '.', 0),
(13, 'Joann', 'Liggens', 'jliggensc@google.com.au', '.', 0),
(14, 'Briana', 'Augar', 'baugard@digg.com', '.', 0),
(15, 'Rodney', 'Menear', 'rmeneare@newyorker.com', '.', 0),
(16, 'Jeremiah', 'Poli', 'jpolif@feedburner.com', '.', 0),
(17, 'Gonzalo', 'Blanket', 'gblanketg@chron.com', '.', 0),
(18, 'Haslett', 'Barz', 'hbarzh@deliciousdays.com', '.', 0),
(19, 'Berty', 'Lanon', 'blanoni@technorati.com', '.', 0),
(20, 'Anatollo', 'Pagon', 'apagonj@livejournal.com', '.', 0),
(43, 'The', 'Admin', 'admin@memberadmin.co.nz', '$2y$10$i7/8EPe7r0Yaza035Y8trew7GggYkjwwq0VaxVNP5DsqKP1j6a9rO', 9),
(44, 'Ordinary', 'Member', 'amember@amember.co.nz', '$2y$10$i7/8EPe7r0Yaza035Y8trew7GggYkjwwq0VaxVNP5DsqKP1j6a9rO', 1);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `roomID` int NOT NULL,
  `roomname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `description` text,
  `roomtype` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `beds` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`roomID`, `roomname`, `description`, `roomtype`, `beds`) VALUES
(1, 'Kellie', 'sapien arcu sed augue aliquam erat volutpat in congue etiam justo', 'S', 5),
(2, 'Herman', 'quis justo maecenas rhoncus aliquam lacus morbi quis tortor id nulla ultrices aliquet maecenas', 'D', 5),
(3, 'Scarlett', 'ut mauris eget massa tempor convallis nulla neque libero convallis eget eleifend luctus ultricies eu nibh quisque id', 'D', 2),
(4, 'Jelani', 'lobortis convallis tortor risus dapibus augue vel accumsan tellus nisi eu orci', 'S', 2),
(5, 'Sonya', 'purus phasellus in felis donec semper sapien a libero nam dui proin leo', 'S', 5),
(6, 'Miranda', 'nisl aenean lectus pellentesque eget nunc donec quis orci eget orci vehicula condimentum', 'S', 4),
(7, 'Helen', 'mus vivamus vestibulum sagittis sapien cum sociis natoque penatibus et magnis dis parturient', 'S', 2),
(8, 'Octavia', 'posuere nonummy integer non velit donec diam neque vestibulum eget vulputate ut ultrices vel augue vestibulum', 'D', 3),
(9, 'Gretchen', 'sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus mus etiam vel augue vestibulum rutrum rutrum neque aenean auctor', 'D', 3),
(10, 'Bernard', 'tristique est et tempus semper est quam pharetra magna ac consequat metus sapien ut nunc vestibulum ante', 'S', 5),
(11, 'Dacey', 'arcu sed augue aliquam erat volutpat in congue etiam justo etiam pretium iaculis justo in hac', 'D', 2),
(12, 'Preston', 'fusce posuere felis sed lacus morbi sem mauris laoreet ut rhoncus aliquet pulvinar sed nisl nunc rhoncus', 'D', 2),
(13, 'Dane', 'facilisi cras non velit nec nisi vulputate nonummy maecenas tincidunt lacus at velit vivamus', 'S', 4),
(14, 'Cole', 'leo odio condimentum id luctus nec molestie sed justo pellentesque viverra pede ac diam cras pellentesque volutpat dui maecenas', 'S', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`bookingID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`roomID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `bookingID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `roomID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
