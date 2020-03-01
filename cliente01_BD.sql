-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-03-2020 a las 19:13:21
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cliente01`
--
CREATE DATABASE IF NOT EXISTS `cliente01` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `cliente01`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `rol` int(1) NOT NULL,
  `archivo_n` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `archivo` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `eliminado` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id`, `nombre`, `apellidos`, `correo`, `pass`, `rol`, `archivo_n`, `archivo`, `status`, `eliminado`) VALUES
(1, 'Ramiro', 'Mendez', 'correo@ejemplo.com', '12394d743f4eb95c74b40ed0697511e6', 1, 'd321909e3da3b9fa25df2af3af986a56', '3.jpg', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `eliminado` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `apellidos`, `correo`, `pass`, `status`, `eliminado`) VALUES
(1, 'Ramiro', 'Mendez', 'correo@ejemplo.com', '12394d743f4eb95c74b40ed0697511e6', 1, 0),
(2, 'lucrecia', 'lopez garcia', 'lucre_cargi@hotmail.com', '168c8a660f86fc28abfb44715d39ff15', 1, 0),
(3, 'Ramiro', 'Mendez Chairez', 'ramiro@prueba.com', '12394d743f4eb95c74b40ed0697511e6', 1, 0),
(4, 'Yajahira', 'Andrade', 'yajahirasu@gmail.com', 'df6f90370be031bb3c2d492b196bf095', 1, 0),
(5, 'danita', 'bb', 'danita@bb.com', '25d55ad283aa400af464c76d713c07ad', 1, 1),
(6, 'Gomela', 'Go', 'gomiz@gmail.com', '12394d743f4eb95c74b40ed0697511e6', 1, 0),
(7, 'Carlos', 'Mendez ', 'cml214579451@outlook.com', 'd6fbca4ff0bc23aee54507cb24f9679c', 1, 0),
(8, 'Jose', 'Cortez', 'jose@ejemplo.com', '25d55ad283aa400af464c76d713c07ad', 1, 1),
(9, 'Alan', 'Capuchino', 'capuchino804@gmail.com', '3c08b731c58db2ecaeed634a29ed8b3e', 1, 0),
(10, 'Hervert', 'Galindo', 'hervert@gmail.com', '87c75a67502a3810c09e5e2ee6b68ae3', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `fecha` int(11) NOT NULL,
  `usuario` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `fecha`, `usuario`, `status`) VALUES
(1, 1122019, 'Ramiro Mendez', 1),
(2, 1122019, '2sh8Yf332e2703f', 1),
(3, 1122019, 'Ramiro Mendez', 1),
(4, 22012020, 'Hervert Galindo', 1),
(5, 12022020, 'Ramiro Mendez', 1),
(6, 12022020, 'Ramiro Mendez', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_productos`
--

CREATE TABLE `pedidos_productos` (
  `id` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pedidos_productos`
--

INSERT INTO `pedidos_productos` (`id`, `id_pedido`, `id_producto`, `cantidad`) VALUES
(1, 1, 12, 6),
(2, 1, 11, 1),
(3, 1, 10, 1),
(4, 2, 11, 1),
(5, 2, 13, 5),
(6, 2, 12, 6),
(7, 3, 11, 0),
(8, 3, 12, 6),
(9, 4, 12, 6),
(10, 4, 8, 0),
(11, 5, 12, 0),
(12, 5, 11, 0),
(13, 5, 10, 0),
(14, 6, 11, 5),
(15, 6, 12, 2),
(16, 6, 10, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `codigo` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `costo` double NOT NULL,
  `stock` int(11) NOT NULL,
  `archivo_n` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `archivo` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `eliminado` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `codigo`, `descripcion`, `costo`, `stock`, `archivo_n`, `archivo`, `status`, `eliminado`) VALUES
(1, 'Variedad tacos', '666', 'De todo un poco', 56.5, 23, 'ceb7ff50693c5889e7fa932e8a821222', 'variedad-taco.jpg', 1, 0),
(2, 'Taco Tripa', '667', 'La mera vena', 12.5, 6, '0609857992a20307274d1106b26ddc31', 'taco-tripa.jpg', 1, 0),
(3, 'Taco Suaperro', '668', 'Son de perro, obviamente', 7, 5899, '135bbbf582bc8916403d02df6bb0d5ac', 'taco-suadero.jpg', 1, 0),
(4, 'Taco Barbacho', '669', 'De barbacoa de hidalgo, ajua', 13.5, 56, '5f50ed846f63f001ebbdee30eda6681d', 'taco-barbacoa.jpg', 1, 0),
(5, 'Taco de Canasta', '670', 'No llenan, a pero que buenos estan', 6, 751, '66269aa5013952f140a3ca46c7e277a0', 'taco-canasta.jpg', 1, 0),
(6, 'Taco Puerco', '671', 'Son de carnitas', 12.5, 123, '437b48cf7f1f3e3dcaccfb4392b57d00', 'taco-carnitas.jpg', 1, 0),
(7, 'Taco de Chicharron', '672', 'Chicharron, lo que nos sobro de las carnitas', 12.5, 14, '4ee388326243156e0ad83c27bdf2338b', 'taco-chicharron.jpg', 1, 0),
(8, 'Taco de Chorizo', '673', 'Chorizo para asar, el mas rico', 9.5, 107, 'ef6f7e389f991d0c2fccdc1bd395e483', 'taco-chorizo.jpg', 1, 0),
(9, 'Taco de Cochinita', '674', 'Nos pusimos fresones, es pivil', 15.7, 3, '1e84a027964f63586f323fed86ed3496', 'taco-cochinita.jpg', 1, 0),
(10, 'Taco Dorado', '675', 'Es al azar, hay de frijol, papa, pollo', 3.5, 560, 'fb882c808f0df856c4e1cd2946c3a94e', 'taco-dorado.jpg', 1, 0),
(11, 'Taco de Lengua', '676', 'Larga, como te gusta', 23.5, 4, '79ebdebccdaf4b86acca4b927cab7c0b', 'taco-lengua.jpg', 1, 0),
(12, 'Taco de Pastor', '677', 'Le ponemos piña, como a la pizza, como debe de ser', 11, 558, 'e98e53ab19a72c888e542abbcb35092e', 'taco-pastor.jpg', 1, 0),
(13, 'Taco de Pescado', '678', 'Sarandeado, Frito, Empanizado, usted diga', 25, 12, 'f576cbb87ab00d56f35649fb8596050c', 'taco-pescado.jpg', 1, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos_productos`
--
ALTER TABLE `pedidos_productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_pedido` (`id_pedido`) USING BTREE;

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `pedidos_productos`
--
ALTER TABLE `pedidos_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedidos_productos`
--
ALTER TABLE `pedidos_productos`
  ADD CONSTRAINT `pedidos_productos_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `pedidos_productos_ibfk_2` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
