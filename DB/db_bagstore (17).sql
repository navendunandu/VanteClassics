-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2024 at 11:51 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bagstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_adminreg`
--

CREATE TABLE `tbl_adminreg` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(30) NOT NULL,
  `admin_contact` varchar(10) NOT NULL,
  `admin_email` varchar(30) NOT NULL,
  `admin_pwd` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_adminreg`
--

INSERT INTO `tbl_adminreg` (`admin_id`, `admin_name`, `admin_contact`, `admin_email`, `admin_pwd`) VALUES
(2, 'Hridya', '2147481234', 'hridyarnair04@gmail.com', 'Hridya@1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_assign`
--

CREATE TABLE `tbl_assign` (
  `assign_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `assign_date` varchar(10) NOT NULL,
  `designer_id` int(11) NOT NULL,
  `assign_image` varchar(100) NOT NULL,
  `assign_msg` varchar(300) NOT NULL,
  `assign_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_assign`
--

INSERT INTO `tbl_assign` (`assign_id`, `request_id`, `assign_date`, `designer_id`, `assign_image`, `assign_msg`, `assign_status`) VALUES
(12, 5, '2024-09-20', 3, 'college5.jpeg', '', 2),
(13, 3, '2024-09-25', 3, 'delilah.jpg', '', 2),
(14, 5, '2024-09-27', 3, 'lexi.jpeg', '', 1),
(15, 9, '2024-09-27', 3, 'delilah.jpg', '', 2),
(16, 6, '2024-09-27', 3, 'harmony.jpg', '', 3),
(17, 10, '2024-09-28', 3, 'b4079daf9a4dfe11b4bbf93828b37167.jpg', '', 3),
(18, 13, '2024-09-29', 3, 'lexi.jpeg', '', 2),
(19, 14, '2024-09-29', 3, '', '', 0),
(20, 15, '2024-09-29', 3, 'harmony.jpg', '', 2),
(21, 0, '2024-10-04', 3, '', '', 0),
(22, 17, '2024-10-04', 3, '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking`
--

CREATE TABLE `tbl_booking` (
  `booking_id` int(11) NOT NULL,
  `booking_date` varchar(10) NOT NULL,
  `booking_amount` int(11) NOT NULL,
  `booking_status` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_booking`
--

INSERT INTO `tbl_booking` (`booking_id`, `booking_date`, `booking_amount`, `booking_status`, `user_id`) VALUES
(13, '2024-10-25', 1300, 2, 3),
(14, '2024-11-01', 1300, 1, 3),
(15, '2024-11-01', 1300, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cart_id` int(11) NOT NULL,
  `cart_qty` int(11) NOT NULL DEFAULT 1,
  `cart_status` int(11) NOT NULL DEFAULT 0,
  `product_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cart_id`, `cart_qty`, `cart_status`, `product_id`, `booking_id`) VALUES
(21, 1, 4, 1, 13),
(22, 1, 3, 1, 14),
(23, 1, 1, 1, 15);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`) VALUES
(3, 'Backpacks'),
(5, 'Handbag');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_color`
--

CREATE TABLE `tbl_color` (
  `color_id` int(11) NOT NULL,
  `color_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_color`
--

INSERT INTO `tbl_color` (`color_id`, `color_name`) VALUES
(5, 'Red'),
(7, 'White'),
(8, 'Beige'),
(9, 'Black'),
(10, 'Green'),
(11, 'Pink'),
(12, 'Tan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_complaint`
--

CREATE TABLE `tbl_complaint` (
  `complaint_id` int(11) NOT NULL,
  `complaint_content` varchar(500) NOT NULL,
  `complaint_date` varchar(10) NOT NULL,
  `complaint_status` int(11) NOT NULL DEFAULT 0,
  `complaint_reply` varchar(500) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `complaint_file` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_complaint`
--

INSERT INTO `tbl_complaint` (`complaint_id`, `complaint_content`, `complaint_date`, `complaint_status`, `complaint_reply`, `user_id`, `product_id`, `complaint_file`) VALUES
(6, 'dfd', '2024-09-28', 1, 'jkk', 3, 4, 'delilah.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_complainttype`
--

CREATE TABLE `tbl_complainttype` (
  `ctype_id` int(11) NOT NULL,
  `ctype_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_designer`
--

CREATE TABLE `tbl_designer` (
  `designer_id` int(11) NOT NULL,
  `designer_name` varchar(30) NOT NULL,
  `designer_email` varchar(30) NOT NULL,
  `designer_contact` varchar(10) NOT NULL,
  `designer_password` varchar(10) NOT NULL,
  `designer_address` varchar(100) NOT NULL,
  `designer_photo` varchar(100) NOT NULL,
  `place_id` int(11) NOT NULL,
  `manufacturer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_designer`
--

INSERT INTO `tbl_designer` (`designer_id`, `designer_name`, `designer_email`, `designer_contact`, `designer_password`, `designer_address`, `designer_photo`, `place_id`, `manufacturer_id`) VALUES
(3, 'Adhya', 'adhya1704@gmail.com', '7546985488', '0011', ' thkmk', 'user-profile-icon-free-vector.jpg', 2, 3),
(5, 'Anagha Suresh', 'naturennnnn076@gmail.com', '8467857511', 'Anagha71', 'dfhgb', 'codeglitch-gif.gif', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_district`
--

CREATE TABLE `tbl_district` (
  `district_id` int(11) NOT NULL,
  `district_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_district`
--

INSERT INTO `tbl_district` (`district_id`, `district_name`) VALUES
(2, 'Kollam'),
(3, 'Ernakulam'),
(4, 'Kottayam');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gallery`
--

CREATE TABLE `tbl_gallery` (
  `gallery_id` int(11) NOT NULL,
  `gallery_image` varchar(100) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_gallery`
--

INSERT INTO `tbl_gallery` (`gallery_id`, `gallery_image`, `product_id`) VALUES
(3, '', 0),
(6, 'harmony.jpg', 1),
(7, 'Screenshot 2024-09-28 195511.png', 4),
(8, 'Screenshot 2024-09-28 195535.png', 4),
(9, 'delilah.jpg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_manufacturer`
--

CREATE TABLE `tbl_manufacturer` (
  `manufacturer_id` int(11) NOT NULL,
  `manufacturer_name` varchar(50) NOT NULL,
  `manufacturer_vstatus` int(11) NOT NULL DEFAULT 0,
  `manufacturer_email` varchar(30) NOT NULL,
  `manufacturer_password` varchar(10) NOT NULL,
  `manufacturer_address` varchar(120) NOT NULL,
  `manufacturer_logo` varchar(100) NOT NULL,
  `manufacturer_proof` varchar(100) NOT NULL,
  `manufacturer_doj` varchar(10) NOT NULL,
  `manufacturer_contact` varchar(10) NOT NULL,
  `place_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_manufacturer`
--

INSERT INTO `tbl_manufacturer` (`manufacturer_id`, `manufacturer_name`, `manufacturer_vstatus`, `manufacturer_email`, `manufacturer_password`, `manufacturer_address`, `manufacturer_logo`, `manufacturer_proof`, `manufacturer_doj`, `manufacturer_contact`, `place_id`) VALUES
(1, 'hridya', 2, 'bniir@gmail.com', '87654321', 'acbh', 'bpclogo.png', 'bpcpic.jpg', '2024-05-22', '1234567890', 4),
(2, 'hradya', 2, 'hradyaeldhose23@gmail.com', 'hradya44', 'jk', 'bpclogo.png', 'bpcpic.jpg', '2024-05-23', '3245763891', 4),
(3, 'Allure ', 1, 'aleenareji002@gmail.com', 'Aleena@4', 'CK Complex Kacherithazham \r\nMuvattupuzha P.O Muvattupuzha', 'logo1.jpeg', 'college4.jpg', '2024-05-24', '856678985', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_material`
--

CREATE TABLE `tbl_material` (
  `material_id` int(11) NOT NULL,
  `material_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_material`
--

INSERT INTO `tbl_material` (`material_id`, `material_name`) VALUES
(2, 'Leather'),
(5, ' Jute'),
(6, 'Nylon');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_place`
--

CREATE TABLE `tbl_place` (
  `place_id` int(11) NOT NULL,
  `place_name` varchar(50) NOT NULL,
  `district_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_place`
--

INSERT INTO `tbl_place` (`place_id`, `place_name`, `district_id`) VALUES
(2, 'Muvattupuzha', 3),
(3, 'Pala', 4),
(4, 'Kothamangalam', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(30) NOT NULL,
  `product_description` varchar(100) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_photo` varchar(100) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `manufacturer_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `product_vstatus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `product_name`, `product_description`, `product_price`, `product_photo`, `subcategory_id`, `manufacturer_id`, `material_id`, `color_id`, `product_vstatus`) VALUES
(1, 'harmony', 'kl', 1300, 'harmony.jpg', 7, 3, 2, 8, 1),
(3, 'liza', 'hjkk', 1500, 'liza', 9, 2, 2, 9, 0),
(4, 'Delilah', 'jhjjs', 2000, 'delilah.jpg', 11, 3, 2, 11, 0),
(6, 'lexi', 'xcsdvfgb', 2000, 'lexi.jpeg', 11, 2, 2, 9, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rating`
--

CREATE TABLE `tbl_rating` (
  `rating_id` int(11) NOT NULL,
  `rating_value` int(11) NOT NULL,
  `rating_content` varchar(50) NOT NULL,
  `rating_datetime` varchar(15) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_rating`
--

INSERT INTO `tbl_rating` (`rating_id`, `rating_value`, `rating_content`, `rating_datetime`, `product_id`, `user_id`) VALUES
(1, 2, 'hjfgk', '2024-09-27 11:3', 4, 3),
(2, 2, 'its nice\n', '2024-10-04 20:0', 4, 3),
(3, 3, 'ghgh', '2024-10-09 12:4', 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_request`
--

CREATE TABLE `tbl_request` (
  `request_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `request_content` varchar(500) NOT NULL,
  `request_date` varchar(10) NOT NULL,
  `request_amount` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `manufacturer_id` int(11) NOT NULL,
  `request_status` int(11) NOT NULL DEFAULT 0,
  `request_file` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_request`
--

INSERT INTO `tbl_request` (`request_id`, `material_id`, `category_id`, `color_id`, `request_content`, `request_date`, `request_amount`, `user_id`, `manufacturer_id`, `request_status`, `request_file`) VALUES
(3, 5, 5, 8, 'vjkjlllkml', '2024-07-12', 1200, 1, 3, 5, 'harmony.jpg'),
(4, 6, 3, 8, 'gucci fake ', '2024-07-21', 0, 1, 1, 0, 'lexi.jpeg'),
(5, 2, 3, 8, 'hjkkj', '2024-09-17', 600, 3, 3, 7, 'harmony.jpg'),
(6, 5, 5, 7, 'njk', '2024-09-17', 1400, 3, 3, 4, 'lexi.jpeg'),
(8, 6, 5, 5, 'tttt', '2024-09-27', 1500, 0, 3, 1, 'delilah.jpg'),
(9, 6, 5, 11, 'iiii', '2024-09-27', 1200, 3, 3, 7, 'delilah.jpg'),
(10, 2, 3, 7, 'dfbfj', '2024-09-27', 1400, 3, 3, 4, 'lexi.jpeg'),
(11, 2, 5, 9, 'leather bag', '2024-09-28', 0, 3, 2, 0, 'harmony.jpg'),
(12, 2, 5, 9, 'black leather', '2024-09-28', 1500, 0, 1, 1, 'harmony.jpg'),
(13, 5, 5, 8, 'jute', '2024-09-29', 1200, 3, 3, 7, 'lexi.jpeg'),
(14, 6, 5, 11, 'nylon handbag', '2024-09-29', 1400, 1, 3, 4, 'slide-02.jpg'),
(15, 5, 5, 9, 'jj', '2024-09-29', 1000, 3, 3, 7, 'harmony.jpg'),
(16, 5, 3, 8, 'kkkk', '2024-10-04', 0, 3, 3, 2, 'harmony.jpg'),
(17, 2, 5, 7, 'jjj', '2024-10-04', 1200, 3, 3, 4, 'lexi.jpeg'),
(18, 5, 3, 7, 'vfv', '2024-10-09', 0, 3, 3, 0, 'b4079daf9a4dfe11b4bbf93828b37167.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock`
--

CREATE TABLE `tbl_stock` (
  `stock_id` int(11) NOT NULL,
  `stock_qty` int(11) NOT NULL,
  `stock_date` varchar(10) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_stock`
--

INSERT INTO `tbl_stock` (`stock_id`, `stock_qty`, `stock_date`, `product_id`) VALUES
(5, 45, '2024-05-27', 4),
(6, 23, '2024-07-06', 6),
(7, 3, '2024-09-20', 1),
(9, 3, '2024-10-04', 0),
(10, 2, '2024-10-25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subcategory`
--

CREATE TABLE `tbl_subcategory` (
  `subcat_id` int(11) NOT NULL,
  `subcat_name` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_subcategory`
--

INSERT INTO `tbl_subcategory` (`subcat_id`, `subcat_name`, `category_id`) VALUES
(1, '', 0),
(6, 'Hiking bag', 3),
(7, 'Pouch', 5),
(8, 'laptop bag', 3),
(9, 'Clucthes', 5),
(11, 'Crossbody bag', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `user_email` varchar(30) NOT NULL,
  `user_contact` varchar(10) NOT NULL,
  `user_address` varchar(50) NOT NULL,
  `place_id` int(11) NOT NULL,
  `user_photo` varchar(100) NOT NULL,
  `user_password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `user_email`, `user_contact`, `user_address`, `place_id`, `user_photo`, `user_password`) VALUES
(1, 'hridya', 'zxc@gmil.com', '1234655678', '', 4, 'apj.jpg', '43214321'),
(3, 'Sreeshna', 'sree4102004@gmail.com', '8590698511', ' Flat no.12 Canopy Mathirappilly PO Kothamangalam', 4, 'profilepic.jpg', 'Sree1234'),
(4, 'ABC', 'abc@gmail.com', '8283396657', 'Home', 2, 'boat.jpg', 'Q1q2q3q4'),
(5, 'Nandu', 'navendunandu@gmail.com', '8281241875', 'Home', 2, 'codeglitch-gif.gif', 'Q1q2q3q4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_adminreg`
--
ALTER TABLE `tbl_adminreg`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_assign`
--
ALTER TABLE `tbl_assign`
  ADD PRIMARY KEY (`assign_id`);

--
-- Indexes for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_color`
--
ALTER TABLE `tbl_color`
  ADD PRIMARY KEY (`color_id`);

--
-- Indexes for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `tbl_complainttype`
--
ALTER TABLE `tbl_complainttype`
  ADD PRIMARY KEY (`ctype_id`);

--
-- Indexes for table `tbl_designer`
--
ALTER TABLE `tbl_designer`
  ADD PRIMARY KEY (`designer_id`);

--
-- Indexes for table `tbl_district`
--
ALTER TABLE `tbl_district`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `tbl_gallery`
--
ALTER TABLE `tbl_gallery`
  ADD PRIMARY KEY (`gallery_id`);

--
-- Indexes for table `tbl_manufacturer`
--
ALTER TABLE `tbl_manufacturer`
  ADD PRIMARY KEY (`manufacturer_id`);

--
-- Indexes for table `tbl_material`
--
ALTER TABLE `tbl_material`
  ADD PRIMARY KEY (`material_id`);

--
-- Indexes for table `tbl_place`
--
ALTER TABLE `tbl_place`
  ADD PRIMARY KEY (`place_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  ADD PRIMARY KEY (`rating_id`);

--
-- Indexes for table `tbl_request`
--
ALTER TABLE `tbl_request`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `tbl_stock`
--
ALTER TABLE `tbl_stock`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  ADD PRIMARY KEY (`subcat_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_adminreg`
--
ALTER TABLE `tbl_adminreg`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_assign`
--
ALTER TABLE `tbl_assign`
  MODIFY `assign_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_color`
--
ALTER TABLE `tbl_color`
  MODIFY `color_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_complainttype`
--
ALTER TABLE `tbl_complainttype`
  MODIFY `ctype_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_designer`
--
ALTER TABLE `tbl_designer`
  MODIFY `designer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_district`
--
ALTER TABLE `tbl_district`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_gallery`
--
ALTER TABLE `tbl_gallery`
  MODIFY `gallery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_manufacturer`
--
ALTER TABLE `tbl_manufacturer`
  MODIFY `manufacturer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_material`
--
ALTER TABLE `tbl_material`
  MODIFY `material_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_place`
--
ALTER TABLE `tbl_place`
  MODIFY `place_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_request`
--
ALTER TABLE `tbl_request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_stock`
--
ALTER TABLE `tbl_stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  MODIFY `subcat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
