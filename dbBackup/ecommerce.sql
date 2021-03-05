-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2021 at 11:15 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(100) NOT NULL,
  `brand_title` text NOT NULL,
  `brand_email` varchar(100) NOT NULL,
  `brand_pass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`, `brand_email`, `brand_pass`) VALUES
(1, 'APPLE', 'apple@gmail.com', 'apple123'),
(2, 'BEATS', 'beats@gmail.com', 'beats123'),
(3, 'BOSE', 'bose@gmail.com', 'bose123'),
(4, 'JBL', 'jbl@gmail.com', 'jbl123'),
(5, 'SENNHEISER', 'senn@gmail.com', 'senn123'),
(6, 'SONOS', 'sonos@gmail.com', 'sonos123'),
(7, 'AUDIO-TECHNICA', 'ad@gmail.com', 'ad123'),
(8, 'SKULLCANDY', 'skc@gmail.com', 'skc123'),
(9, 'YAMAHA', 'yamaha@gmail.com', 'yamaha123'),
(10, 'PALMER', 'palmer@gmail.com', 'palmer123'),
(11, 'FENDER', 'fender@gmail.com', 'fender123'),
(12, 'GIBSON', 'gibson@gmail.com', 'gibson123');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `p_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`p_id`, `customer_id`) VALUES
(7, 10),
(10, 10),
(11, 10);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(100) NOT NULL,
  `cat_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Parlantes'),
(2, 'Audifonos'),
(3, 'Toca Discos'),
(4, 'Guitarras');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(10) NOT NULL,
  `customer_name` text NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `customer_pass` varchar(100) NOT NULL,
  `customer_country` text NOT NULL,
  `customer_city` text NOT NULL,
  `customer_contact` varchar(255) NOT NULL,
  `customer_address` text NOT NULL,
  `customer_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `customer_email`, `customer_pass`, `customer_country`, `customer_city`, `customer_contact`, `customer_address`, `customer_image`) VALUES
(10, 'Matt Lebowski', 'mattlebowski@hotmail.com', 'matt123', 'Colombia', 'Medellin', '5491165784536', 'Hacienda 1', 'MattProPic.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `detalleventas`
--

CREATE TABLE `detalleventas` (
  `idDetalle` int(5) NOT NULL,
  `idProd` int(100) NOT NULL,
  `idVenta` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detalleventas`
--

INSERT INTO `detalleventas` (`idDetalle`, `idProd`, `idVenta`) VALUES
(3, 7, 13),
(4, 10, 13),
(5, 11, 13);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(100) NOT NULL,
  `product_cat` int(100) NOT NULL,
  `product_brand` int(100) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_price` text NOT NULL,
  `product_desc` varchar(200) NOT NULL,
  `product_image` text NOT NULL,
  `product_keywords` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_cat`, `product_brand`, `product_title`, `product_price`, `product_desc`, `product_image`, `product_keywords`) VALUES
(4, 2, 7, 'Audio Technica M50x', '149', 'Audio tehnica audifonos over ear profesionales.', 'm50x.jpg', 'audifonos, nuevo, audiotechnica'),
(5, 2, 2, 'PowerBeats Pro', '230', 'Audifonos true wireless Beats modelo in-ear.', 'powerBeatsPro.jpg', 'beats, wireless, audifonos'),
(7, 4, 12, 'Gibson SG guitar', '1694', 'Guitarra electrica original Gibson SG.', 'originalSGgibson.jpg', 'nueva, gibson, electrica, guitarra'),
(8, 4, 10, 'Guitarra clasica palmer P41NE', '72', 'Guitarra clasica palmer', 'PALMERp41ne.jpg', 'palmer, clasica, nueva, guitarra'),
(9, 4, 9, 'Guitarra Yamaha F335', '199', 'Guitarra Yamaha clasica.', 'yamahaF335.jpg', 'yamaha, nueva, clasica, guitarra'),
(10, 1, 2, 'Beats Pill 2020', '150', 'Beats pill edicion 2020', 'beatsPill.jpg', 'beats, bluetooth, nuevo, parlante'),
(11, 1, 3, 'Sound Link', '200', 'Bose soundlink bluetooth speaker', 'boseSoundLink.jpg', 'bluetooth, bose, nuevo, parlante'),
(12, 1, 4, 'Pulse 4', '249', 'Jbl pulse 4 bluetooth speaker', 'jblPulse4.png', 'jbl, nuevo, bluetooth, parlante'),
(13, 1, 6, 'sonos Move', '399', 'Sonos move bluetooth speaker', 'sonosMove.jpg', 'sonos, bluetooth, nuevo, parlante'),
(14, 3, 9, 'Yamaha Vinyl500', '699', 'Tocadiscos yamaha modelo vinyl 500.', 'vinyl500.jpg', 'yamaha, vinilo, toca discos, nuevo'),
(15, 3, 3, 'Bose Vinyl 360', '899', 'Tocadiscos bose modelo 360.', 'bose360.jpg', 'bose, toca discos, nuevo'),
(16, 3, 7, 'Audio Technica ATLPW', '599', 'Tocadiscos audioTechnica model atlwp30', 'vinylATLPW30TK.jpg', 'audio technica, toca discos, nuevo');

-- --------------------------------------------------------

--
-- Table structure for table `ventas`
--

CREATE TABLE `ventas` (
  `idVenta` int(5) NOT NULL,
  `idCliente` int(10) NOT NULL,
  `fecha` varchar(100) NOT NULL,
  `precioTotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ventas`
--

INSERT INTO `ventas` (`idVenta`, `idCliente`, `fecha`, `precioTotal`) VALUES
(13, 10, 'Tuesday, March 2, 2021', 2044);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD KEY `fkidProd` (`p_id`),
  ADD KEY `fkidCustomer` (`customer_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `detalleventas`
--
ALTER TABLE `detalleventas`
  ADD PRIMARY KEY (`idDetalle`),
  ADD KEY `fkidProd` (`idProd`),
  ADD KEY `fkidVenta` (`idVenta`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fkidCat` (`product_cat`),
  ADD KEY `fkidBrand` (`product_brand`);

--
-- Indexes for table `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`idVenta`),
  ADD KEY `fkidCliente` (`idCliente`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `detalleventas`
--
ALTER TABLE `detalleventas`
  MODIFY `idDetalle` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `ventas`
--
ALTER TABLE `ventas`
  MODIFY `idVenta` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `idCustomer` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idProd` FOREIGN KEY (`p_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detalleventas`
--
ALTER TABLE `detalleventas`
  ADD CONSTRAINT `idProducto` FOREIGN KEY (`idProd`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idVenta` FOREIGN KEY (`idVenta`) REFERENCES `ventas` (`idVenta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `idBrand` FOREIGN KEY (`product_brand`) REFERENCES `brands` (`brand_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idCat` FOREIGN KEY (`product_cat`) REFERENCES `categories` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `idCliente` FOREIGN KEY (`idCliente`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
