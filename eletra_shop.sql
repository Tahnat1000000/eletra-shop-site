-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: ינואר 20, 2020 בזמן 02:17 PM
-- גרסת שרת: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eletra_shop`
--

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `NUM_OF_CART` int(11) NOT NULL AUTO_INCREMENT,
  `USER_ID` varchar(9) NOT NULL,
  `PRODUCT_ID` varchar(5) NOT NULL,
  `DATE` date NOT NULL,
  `EXP` bigint(20) NOT NULL,
  PRIMARY KEY (`NUM_OF_CART`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `NUM_OF_PRODUCT` int(11) NOT NULL AUTO_INCREMENT,
  `PRODUCT_ID` varchar(5) NOT NULL,
  `PRODUCT_NAME` varchar(25) NOT NULL,
  `PRICE` float NOT NULL,
  `AMOUNT` int(11) NOT NULL,
  `PROVIDER_ID` varchar(5) NOT NULL,
  PRIMARY KEY (`NUM_OF_PRODUCT`),
  UNIQUE KEY `PRODUCT_ID` (`PRODUCT_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- הוצאת מידע עבור טבלה `products`
--

INSERT INTO `products` (`NUM_OF_PRODUCT`, `PRODUCT_ID`, `PRODUCT_NAME`, `PRICE`, `AMOUNT`, `PROVIDER_ID`) VALUES
(1, '00001', 'Samsung Galaxy S5', 350, 148, '10000'),
(2, '00002', 'Samsung Galaxy S6', 425, 178, '10000'),
(3, '00003', 'Iphone X', 500, 50, '10000'),
(4, '00004', 'Laptop asus', 1000, 100, '10000'),
(5, '00006', 'iPhone 11 pro', 600, 10, '10000'),
(6, '00007', 'Toshiba TV 50 inch', 500, 29, '10000'),
(7, '00008', 'Sunsung SmartTV 32 inch', 660, 39, '10000'),
(8, '00009', 'Dell Computer screen', 220, 9, '10000'),
(9, '00010', 'Toshiba smartTV 120 inch', 800, 64, '10000'),
(10, '00011', 'LG Computer screen', 300, 29, '10001'),
(11, '00012', 'MacBook 15.6', 480, 45, '10001');

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `providers`
--

DROP TABLE IF EXISTS `providers`;
CREATE TABLE IF NOT EXISTS `providers` (
  `NUM_OF_PROVIDER` int(11) NOT NULL AUTO_INCREMENT,
  `PROVIDER_ID` varchar(5) NOT NULL,
  `PROVIDER_NAME` varchar(25) NOT NULL,
  `PROVIDER_PHONE` varchar(10) NOT NULL,
  PRIMARY KEY (`NUM_OF_PROVIDER`),
  UNIQUE KEY `PROVIDER_ID` (`PROVIDER_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- הוצאת מידע עבור טבלה `providers`
--

INSERT INTO `providers` (`NUM_OF_PROVIDER`, `PROVIDER_ID`, `PROVIDER_NAME`, `PROVIDER_PHONE`) VALUES
(1, '10000', 'ElectronicProvider', '0541234567'),
(2, '10001', 'Multi Electronic', '0546234991');

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `purchase`
--

DROP TABLE IF EXISTS `purchase`;
CREATE TABLE IF NOT EXISTS `purchase` (
  `NUM_OF_PRODUCT` int(11) NOT NULL AUTO_INCREMENT,
  `USER_ID` varchar(9) NOT NULL,
  `PRODUCT_ID` varchar(5) NOT NULL,
  `DATE` date NOT NULL,
  `CARD_NUMBER` varchar(16) NOT NULL,
  `EXPIRY_DATE` varchar(4) NOT NULL,
  `CIV` varchar(3) NOT NULL,
  `OWNER_ID` varchar(9) NOT NULL,
  PRIMARY KEY (`NUM_OF_PRODUCT`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `user_card`
--

DROP TABLE IF EXISTS `user_card`;
CREATE TABLE IF NOT EXISTS `user_card` (
  `NUM_OF_CARD` int(11) NOT NULL AUTO_INCREMENT,
  `USER_ID` varchar(9) NOT NULL,
  `CARD_NUMBER` varchar(16) NOT NULL,
  `EXPIRY_DATE` varchar(4) NOT NULL,
  `CIV` varchar(3) NOT NULL,
  `OWNER_ID` varchar(9) NOT NULL,
  PRIMARY KEY (`NUM_OF_CARD`),
  UNIQUE KEY `USER_ID` (`USER_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- הוצאת מידע עבור טבלה `user_card`
--

INSERT INTO `user_card` (`NUM_OF_CARD`, `USER_ID`, `CARD_NUMBER`, `EXPIRY_DATE`, `CIV`, `OWNER_ID`) VALUES
(1, '205659105', '1111222233334444', '1234', '123', '205659105'),
(2, '316513877', '1212121212121212', '1212', '122', '999999999');

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `user_details`
--

DROP TABLE IF EXISTS `user_details`;
CREATE TABLE IF NOT EXISTS `user_details` (
  `NUM_OF_USER` int(11) NOT NULL AUTO_INCREMENT,
  `FIRST_NAME` varchar(10) NOT NULL,
  `FAMILY_NAME` varchar(12) NOT NULL,
  `GENDER` varchar(10) NOT NULL,
  `BIRTHDAY` date NOT NULL,
  `ADDRESS` varchar(25) NOT NULL,
  `PHONE` varchar(10) NOT NULL,
  `MAIL` varchar(40) NOT NULL,
  `FAMILY_STATUS` varchar(12) NOT NULL,
  `USER_ID` varchar(9) NOT NULL,
  `PASSWORD` varchar(30) NOT NULL,
  `QUESTION` varchar(15) NOT NULL,
  `ADMIN` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`NUM_OF_USER`),
  UNIQUE KEY `ID` (`USER_ID`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- הוצאת מידע עבור טבלה `user_details`
--

INSERT INTO `user_details` (`NUM_OF_USER`, `FIRST_NAME`, `FAMILY_NAME`, `GENDER`, `BIRTHDAY`, `ADDRESS`, `PHONE`, `MAIL`, `FAMILY_STATUS`, `USER_ID`, `PASSWORD`, `QUESTION`, `ADMIN`) VALUES
(1, 'Ilan', 'Yevdayev', 'Male', '1994-09-04', 'Akko', '0543312345', 'ilanyev@gmail.com', 'Single', '205659105', '12121212', 'Asher', 1),
(2, 'Haytam', 'mograbi', 'Male', '1992-12-04', '/ben ami 47', '0528667158', 'haytam.mog@gmail.com', 'Single', '204130926', '123412345', 'abbaba', 0),
(3, 'eden', 'rana', 'Female', '1997-08-19', 'shvil tevet 47', '0546841234', 'ranae390@gmail.com', 'Single', '316513878', '1234512345', 'grisha', 0),
(4, 'edena', 'rene', 'Female', '2020-01-09', 'hfgiukhkw667 2', '0547234006', 'asdasdasd@gmail.com', 'Single', '316513877', '123456123456', 'grisha', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
