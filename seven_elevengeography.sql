-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2017 at 04:50 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `seven_elevengeography`
--

-- --------------------------------------------------------

--
-- Table structure for table `7_eleven`
--

CREATE TABLE IF NOT EXISTS `7_eleven` (
  `store_no` int(255) NOT NULL AUTO_INCREMENT,
  `store_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `island` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  PRIMARY KEY (`store_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=104 ;

--
-- Dumping data for table `7_eleven`
--

INSERT INTO `7_eleven` (`store_no`, `store_name`, `address`, `island`, `latitude`, `longitude`, `img`) VALUES
(1, 'MalolosCrossing', 'E&R, McArthur Highway cor., Mabini St., Malolos Bulacan', 'Luzon', '14.8522949', '120.8135417', 'https://www.zamboanga.com/z/images/a/a2/7_Eleven%2C_Paraincillo_St.%2C_Sto.Nino%2C_Malolos%2C_Bulacan.jpg\n'),
(2, 'Santolan Malabon', 'Rodriguez St. cor E.Martin St., Brgy. Santolan, Malabon City', 'Luzon', '14.6868109', '120.95814159999998', 'https://www.zamboanga.com/z/images/3/3d/7ELEVEN_STORE_Ibayo%2C_Balanga%2C_Bataan.jpg'),
(5, 'Binan', 'Malvar St, BiÃ±an, 4024 Laguna', 'Luzon', '14.1406629', '121.46917740000004', 'https://www.zamboanga.com/z/images/2/2f/7_Eleven_Sindalan%2C_San_Fernando%2C_Pampanga.jpg'),
(6, 'TiongsonExt', 'Tiongson Ext, General Santos City, South Cotabato', 'Mindanao', '6.1257664', '125.19566110000005', 'https://4.bp.blogspot.com/-n7mWIVfbcNA/V5xEmfaMn_I/AAAAAAAAIwA/qtfQTyjHj98yaqtTS-HPp4Xz5k-3-ytngCLcB/s1600/13615465_10210376346104170_6050651998864690317_n.jpg\n'),
(7, 'ApolinarVelez', 'Don Apolinar Velez St, Cagayan de Oro, 9000 Misamis Oriental', 'Mindanao', '8.479070199999999', '124.64451989999998', 'http://adserver.bworldonline.com/webpics/articles/image/20160112e7874.jpg'),
(8, 'TungkilLipata', 'Tungkil, Lipata, Cebu City, 6046 Cebu', 'Visayas', '10.2695092', '123.80884779999997', 'https://www.zamboanga.com/z/images/f/fb/7_Eleven_Clark_Field%2CAngeles_City%2C_Pampanga.jpg'),
(9, 'CaliforniaVillage', 'Katipunan St.California Village Brgy.SanBartolome, Quezon City', 'Luzon', '14.71026', '121.0262679', 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/80/7-Eleven%2C_Pattaya%2C_Thailand.jpg/1280px-7-Eleven%2C_Pattaya%2C_Thailand.jpg'),
(10, 'Navotas', 'M. Naval St, City of Navotas, Metro Manila', 'Luzon', '14.6594567', '120.9468822', 'https://www.zamboanga.com/z/images/7/7f/7Eleven_Store_Building_Sta.Cruz%2CLubao.jpg'),
(11, 'BlueResidences', 'Katipunan Ave.cor.Aurora Blvd., Quezon City', 'Luzon', '14.630841', '121.07364899999993', 'http://aboutcagayandeoro.com/wp-content/uploads/2015/07/dasdas.jpeg'),
(12, 'RiverviewMansion', 'Ongpin St, Binondo, Manila, 1006 Metro Manila', 'Luzon', '14.6012726', '120.97631019999994', 'http://futuresustainability.com.au/wp-content/uploads/2015/02/711.jpg'),
(13, 'Tamaraw Hills', 'Mc Arthur Hi-way cor. Tamaraw Hills, Marulas, Valenzuela', 'Luzon', '14.6785378', '120.97991730000001', 'https://www.zamboanga.com/z/images/1/16/7Eleven_Store_San_Fernando_City_Town_Proper%2CPampanga.jpg'),
(14, 'Malate', 'Marcelo H. del Pilar, Malate', 'Luzon', '14.5703665', '120.98653579999996', 'https://igx.4sqi.net/img/general/600x600/NuoXCb0_1y5Z6AZkD3u1cTzxj13ag05c25xhiPiDbC0.jpg'),
(15, 'EtonParkviewGreenbelt', 'Unit B, Eton Greenbelt Parkview, Gamboa St., Legaspi Village, Makati City', 'Luzon', '14.5532763', '121.01715910000007', 'https://insideretail.ph/wp-content/uploads/2016/05/7-Eleven-SIngapore.png'),
(16, 'DonEugenio', 'Rizal St, Brgy. Maria Clara, University of Iloilo, Iloilo City', 'Visayas', '10.6918999', '122.57046969999999', 'http://4.bp.blogspot.com/-h6o1pMuYD5I/Ut6T-1KKpEI/AAAAAAAAhmc/PKkz1M09QKY/s1600/7+Eleven+in+Iloilo+City+1.jpg'),
(17, 'Transcom', 'Transcom City, Araneta Ave, Bacolod, Negros Occidental', 'Visayas', '10.640617', '122.93244000000004', 'https://www.zamboanga.com/z/images/5/51/7Eleven_Store_Brgy._San_Nicolas%2C_Angeles_City%2C_Pampanga.jpg'),
(18, 'Carcar', 'RRG Building, Carcar - Barili Rd, Carcar City, Cebu', 'Visayas', '10.1034998', '123.6399758', 'https://www.zamboanga.com/z/images/8/82/7_Eleven%2C_Malabanias%2C_Angeles_City%2C_Pampanga.jpg'),
(19, 'TwoSanParq', 'Two San Parq, Lacson St, Bacolod, Negros Occidental', 'Visayas', '10.6942219', '122.95987630000002', 'http://media.philstar.com/images/the-philippine-star/business/business-as-usual/20141020/7-eleven-Cebu-Fanchisee-Cynthia-Alino.jpg'),
(20, 'AklanMain', 'Malay, Aklan', 'Visayas', '11.9003045', '121.95868700000005', 'http://1.bp.blogspot.com/-Hh21_Z2PxYk/VW-kF5FYTyI/AAAAAAAA2_U/q2XnO8Eo7oQ/s1600/DSC_5374.JPG'),
(21, 'RedPlanet', 'Red Planet Hotels Cebu, Archbishop Reyes Ave, Cebu City, 6000 Cebu', 'Visayas', '10.3178003', '123.90246869999999', 'http://complicatedmelody.com/sites/naiad.blushama.com/files/field/image/711.jpg'),
(22, 'Granada', 'Burgos St, Brgy. Granada, Bacolod, 6100 Negros Occidental', 'Visayas', '10.6662052', '123.03374959999996', 'https://cebuafterhours.files.wordpress.com/2012/08/img_0312a.jpg'),
(23, 'CandumanSt', 'H. Abellana St, Canduman, Mandaue City, 6014 Cebu', 'Visayas', '10.3678477', '123.93327739999995', 'https://cebuafterhours.files.wordpress.com/2012/08/img_0312a.jpg'),
(24, 'EastCoast', 'Iloilo East Coast - Capiz Rd, Sigma, Capiz', 'Visayas', '11.4428572', '122.6820457', 'http://3.bp.blogspot.com/-c1GPrD3nm-Q/U64vVDYepGI/AAAAAAAAjuU/ChXZL_m7MDc/s1600/7+Eleven+Iloilo+grand+launch+6.jpg'),
(25, 'MastersonAve', 'Masterson Ave, Cagayan de Oro, Misamis Oriental', 'Mindanao', '8.447317700000001', '124.62213910000003', 'http://3.bp.blogspot.com/-lAbTRhJ9YN4/VY-FdivTfEI/AAAAAAAAZH4/qq3QMhi8n-s/s1600/20150627_085800%2B%2528Medium%2529%2Bcopy.jpg'),
(26, 'CorralesAve', 'Corrales Ave, Cagayan de Oro, Misamis Oriental', 'Mindanao', '8.4803258', '124.64756409999995', 'http://adserver.bworldonline.com/webpics/articles/image/20160721ab0bb.jpg'),
(27, 'Hayes', '414 Hayes St, Cagayan de Oro, 9000 Misamis Oriental', 'Mindanao', '8.4753661', '124.65318030000003', 'https://i2.wp.com/www.cdodev.com/wp-content/uploads/2015/06/11401531_10204488314304898_312851682845596811_n.jpg'),
(28, 'NorthTriangle', 'North Triangle Complex, Vista Verde, Diversion Rd, Panacan, Davao City, 8000 Davao del Sur', 'Mindanao', '7.1386387', '125.64884430000006', 'http://photos.wikimapia.org/p/00/04/91/55/59_big.jpg\n'),
(29, 'SMLanang Branch', 'Fountain Court, SM Lanang Premier, J.P. Laurel Ave, Lanang, Davao City, 8000 Davao del Sur', 'Mindanao', '7.0978613', '125.63159199999996', 'http://www.philretailers.com/wp-content/uploads/2016/01/7-11-franchise-620x330.jpg\n'),
(30, 'Amson', 'Amson Building, Corner Lapu-Lapu Street, Leon Garcia Steet, Agdao, Davao City, Davao del Sur', 'Mindanao', '7.082939499999999', '125.62425989999997', 'https://www.zamboanga.com/z/images/1/16/7Eleven_Store_San_Fernando_City_Town_Proper%2CPampanga.jpg\n'),
(31, 'RoxasElevenSeven', 'Roxas E Ave, General Santos City, South Cotabato', 'Mindanao', '6.1153701', '125.17317809999997', 'https://2.bp.blogspot.com/-H0lNf-I71gA/V5xEnh8u5cI/AAAAAAAAIwM/n1UO4bbTQy0WGJ3jpsAD1DLBR-Z6TnFXQCLcB/s1600/13887104_10210376345824163_9067601679599428778_n.jpg\n'),
(32, 'GensanEleven', 'General Santos City, South Cotabato', 'Mindanao', '6.1163861', '125.17161799999997', 'https://3.bp.blogspot.com/-_cooS6_pARg/V5xEmrGbGiI/AAAAAAAAIwQ/9RviN7-onfkoe5xVUZC5AdcJ2mStg4uYgCEw/s1600/13631412_10210376272782337_4037370839215716224_n.jpg\n'),
(103, 'name', 'address', 'Luzon', '456', '123', 'www.google.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
