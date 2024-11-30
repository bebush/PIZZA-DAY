-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-11-2024 a las 07:42:53
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `restaurante`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bebidas`
--

CREATE TABLE `bebidas` (
  `id` int(100) NOT NULL,
  `producto` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `precio` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bebidas`
--

INSERT INTO `bebidas` (`id`, `producto`, `descripcion`, `precio`) VALUES
(1, 'happy santa fe canton ', '500cc', 1970),
(2, 'happy imperial ipa o negra canton', '500cc', 2200),
(3, 'happy heineken canton', '500cc', 1950),
(4, 'promo liso santa fe 2x1', 'miercoles', 1950),
(5, 'promo fernet', 'viernes', 2310),
(6, 'promo gin gordon 2x1', 'viernes', 5590);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menuinfantil`
--

CREATE TABLE `menuinfantil` (
  `id` int(100) NOT NULL,
  `producto` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `precio` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `menuinfantil`
--

INSERT INTO `menuinfantil` (`id`, `producto`, `descripcion`, `precio`) VALUES
(1, 'bastones de pollo con papas', '--', 4180),
(2, 'super panchos de salchicas con papas', 'papas rejillas', 4950),
(3, 'hamburgesas cheddar con papas', '--', 6490),
(4, 'hamburgesas gratinadas con papas', '--', 6490),
(5, 'tallarines al huevo', 'con salsa crema y queso', 4180);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `minutaspicadas`
--

CREATE TABLE `minutaspicadas` (
  `id` int(100) NOT NULL,
  `producto` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `precio` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `minutaspicadas`
--

INSERT INTO `minutaspicadas` (`id`, `producto`, `descripcion`, `precio`) VALUES
(1, 'papas rusticas', '--', 5260),
(2, 'papas a caballo', 'con huevo fritos', 5970),
(3, 'papas con chedar', '--', 3200),
(4, 'papas con provolone', '--', 6290),
(5, 'papas con chedar y panceta', '--', 6630);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(30) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `celular` int(30) NOT NULL,
  `direccion` text NOT NULL,
  `RoD` text NOT NULL,
  `comentario` text NOT NULL,
  `total` int(100) NOT NULL,
  `metodo_pago` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `nombre`, `celular`, `direccion`, `RoD`, `comentario`, `total`, `metodo_pago`) VALUES
(9, 'asd', 123456, '321654 cucu', 'local', '', 7620, 'efectivo'),
(10, 'asd', 123456, '321654 cucu', 'local', '', 3810, 'efectivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `platosespeciales`
--

CREATE TABLE `platosespeciales` (
  `id` int(100) NOT NULL,
  `producto` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `precio` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `platosespeciales`
--

INSERT INTO `platosespeciales` (`id`, `producto`, `descripcion`, `precio`) VALUES
(1, 'canelones de verdura ', '--', 7590),
(2, 'ravioles de verdura', '--', 7590),
(3, 'sorrentinos de calabaza', '--', 7590),
(4, 'sorrentinos de jamon y queso', '--', 7590),
(5, 'tallarines al huevo', '--', 5960);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `postres`
--

CREATE TABLE `postres` (
  `id` int(100) NOT NULL,
  `producto` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `precio` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `postres`
--

INSERT INTO `postres` (`id`, `producto`, `descripcion`, `precio`) VALUES
(1, 'Panqueque con dulce de leche', 'helado de americana,salsa de dulce de leche', 3810),
(2, 'brownie', 'helado de americana, frutos rojos', 4680),
(3, 'flan con dulce de leche', '--', 3810),
(4, 'wafles con dulce de leche', 'helado de americana ,dulce de leche , salsa de dulce de leche', 4200),
(5, 'wafles caramelados', 'helado de  americana,salsa de caramelo,crocante', 4200),
(6, 'bombom escoces', '--', 2500),
(7, 'bocha de helado americana', '--', 2100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id` int(100) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `personas` int(3) NOT NULL,
  `comentario` text NOT NULL,
  `fechareserva` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id`, `nombre`, `email`, `telefono`, `fecha`, `hora`, `personas`, `comentario`, `fechareserva`) VALUES
(1, 'bebush', 'bebu100@hotmail.com', '4126523262', '1200-10-10', '19:00:00', 4, '', '2024-09-11 18:42:01');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bebidas`
--
ALTER TABLE `bebidas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `menuinfantil`
--
ALTER TABLE `menuinfantil`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `minutaspicadas`
--
ALTER TABLE `minutaspicadas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `platosespeciales`
--
ALTER TABLE `platosespeciales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `postres`
--
ALTER TABLE `postres`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bebidas`
--
ALTER TABLE `bebidas`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `menuinfantil`
--
ALTER TABLE `menuinfantil`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `minutaspicadas`
--
ALTER TABLE `minutaspicadas`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `platosespeciales`
--
ALTER TABLE `platosespeciales`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `postres`
--
ALTER TABLE `postres`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
