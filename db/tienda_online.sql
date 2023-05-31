-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-05-2023 a las 10:25:18
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda_online`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,0) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `id_categoria`, `activo`) VALUES
(1, 'TENIS COLOR NEGRO', '<li> Suela de Goma </li>\r\n<li> La parte superior sintética moldeada cuenta con un patrón texturizado para un mejor control de la bola al driblar a altas velocidades.</li>\r\n<li> Cómodo forro que envuelve tu pie para una sensación natural y ajustada.\r\nPlantilla acolchada para mayor comodidad.</li>\r\n<li>Diseñado para varias superficies, los tacos cónicos ofrecen tracción sobrecargada con liberación rápida y pivotante.</li>', 100, 1, 1),
(2, 'MEDIAS', '<p> Listas para usar en cualquier ocasión.</p>\r\n<p> Medias elaboradas con materiales de excelente calidad tipo transpirable, con un diseños modernos, cómodos, ligeros y perfecto para el ajuste de tu pie, colores modernos para lucir en cualquier momento del día. Especiales para practicar deportes: Futbol o simplemente para lucir en cualquier ocasión. Un obsequio perfecto para tus seres queridos.</p>', 10, 1, 1),
(3, 'BALON DE FUTBOL', '<p>Mira cómo se alinearán las estrellas en Estambul en 2023.</p>\r\n\r\n<p>El intrincado diseño de esta pelota de entrenamiento adidas UCL está inspirado en la pelota oficial usada en las eliminatorias de la UEFA Champions League.</p>', 25, 1, 1),
(4, 'ESPINILLERAS ', '<li>Marca:FIT2</li>\r\n<li>Categoría:Futbol</li>\r\n<li>Género:Unisex</li>\r\n<li>Talla:M</li>', 6, 1, 1),
(5, 'GUANTES DE PORTERO', '<li>talla s</li>\r\n<li>unisex</li>', 15, 1, 1),
(6, 'CAMISOLA DE ARGENTINA 2023', '<li>talla m</li>\r\n<li>unisex</li>\r\n<li>campeones del mundo</li>', 50, 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
