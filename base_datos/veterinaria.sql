-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-06-2026 a las 03:38:19
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
-- Base de datos: `veterinaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE `actividad` (
  `id_actividad` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `fecha` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `actividad`
--

INSERT INTO `actividad` (`id_actividad`, `id_usuario`, `ip`, `fecha`) VALUES
(1, 1, '::1', '2026-05-05 12:40:16'),
(2, 1, '::1', '2026-05-05 01:42:09'),
(3, 1, '::1', '2026-05-05 02:10:55'),
(4, 1, '::1', '2026-05-05 03:39:26'),
(5, 23, '::1', '2026-05-05 03:41:35'),
(6, 1, '::1', '2026-05-05 03:43:03'),
(7, 1, '::1', '2026-05-05 04:36:29'),
(8, 2, '::1', '2026-05-05 04:37:31'),
(9, 1, '::1', '2026-05-05 04:44:28'),
(10, 2, '::1', '2026-05-05 05:02:02'),
(11, 31, '::1', '2026-05-05 05:05:59'),
(12, 1, '::1', '2026-05-05 10:02:59'),
(13, 2, '::1', '2026-05-05 11:13:43'),
(14, 1, '::1', '2026-05-06 12:03:33'),
(15, 1, '::1', '2026-05-06 12:38:33'),
(16, 1, '::1', '2026-05-22 12:57:35'),
(17, 1, '::1', '2026-05-28 05:28:37'),
(18, 1, '::1', '2026-05-28 05:33:38'),
(19, 1, '::1', '2026-05-28 05:34:19'),
(20, 2, '::1', '2026-05-28 05:34:49'),
(21, 1, '::1', '2026-05-28 05:37:11'),
(22, 1, '::1', '2026-05-28 05:40:04'),
(23, 1, '::1', '2026-05-28 09:08:42'),
(24, 33, '::1', '2026-05-28 11:04:57'),
(25, 2, '::1', '2026-05-28 11:07:55'),
(26, 1, '::1', '2026-05-28 11:11:20'),
(27, 29, '::1', '2026-05-28 11:25:16'),
(28, 29, '::1', '2026-05-29 12:12:47'),
(29, 2, '::1', '2026-05-29 02:36:35'),
(30, 1, '::1', '2026-05-29 02:55:47'),
(31, 2, '::1', '2026-05-29 02:56:20'),
(32, 1, '::1', '2026-05-29 03:50:35'),
(33, 2, '::1', '2026-05-29 03:16:52'),
(34, 1, '::1', '2026-05-31 08:35:53'),
(35, 2, '::1', '2026-05-31 08:36:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `id_caja` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_inventario` int(11) NOT NULL,
  `precio` varchar(50) NOT NULL,
  `cantidad` varchar(50) NOT NULL,
  `total` varchar(50) NOT NULL,
  `fecha_registro` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendario`
--

CREATE TABLE `calendario` (
  `id` int(11) NOT NULL,
  `id_mascota` int(11) NOT NULL,
  `id_cita` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `color` varchar(20) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `calendario`
--

INSERT INTO `calendario` (`id`, `id_mascota`, `id_cita`, `title`, `color`, `start`, `end`) VALUES
(1, 2, 1, 'Control de vacunas y desparacitación', '#A00000', '2026-05-05 18:50:00', '0000-00-00 00:00:00'),
(3, 1, 3, '4', '#1F9C00', '2026-05-26 12:00:00', '0000-00-00 00:00:00'),
(4, 2, 4, 'Cita de control y seguimiento de la mascota', '#A00000', '2026-05-24 12:30:00', '0000-00-00 00:00:00'),
(5, 0, 5, 'Urgencia médica', '#1F9C00', '2026-05-28 08:30:00', '0000-00-00 00:00:00'),
(6, 1, 6, 'Cita de desparacitacion', '#A00000', '2026-05-29 10:30:00', '0000-00-00 00:00:00'),
(7, 3, 7, 'Cita de control', '#1F9C00', '2026-05-29 12:30:00', '0000-00-00 00:00:00'),
(8, 1, 8, 'Cita de control de Julieta', '#1F9C00', '2026-05-30 14:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id_cita` int(11) NOT NULL,
  `id_mascota` int(11) DEFAULT NULL,
  `nombre_mascota` varchar(150) DEFAULT NULL,
  `fecha_cita` varchar(50) NOT NULL,
  `hora_cita` varchar(50) NOT NULL,
  `doctor` int(11) NOT NULL,
  `motivo` text NOT NULL,
  `fecha_registro` varchar(50) NOT NULL,
  `estado` int(11) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id_cita`, `id_mascota`, `nombre_mascota`, `fecha_cita`, `hora_cita`, `doctor`, `motivo`, `fecha_registro`, `estado`, `descripcion`) VALUES
(1, 2, NULL, '2026-05-05', '18:50', 2, 'Control de vacunas y desparacitación', '2026-05-05 05:09:44', 1, NULL),
(3, 1, NULL, '2026-05-26', '12:00', 4, '4', '2026-05-22 01:15:42', 0, NULL),
(4, 2, NULL, '2026-05-24', '12:30', 4, 'Cita de control y seguimiento de la mascota', '2026-05-22 02:18:06', 1, NULL),
(5, 0, NULL, '2026-05-28', '08:30', 4, 'Urgencia médica', '2026-05-22 02:19:03', 0, NULL),
(6, 1, NULL, '2026-05-29', '10:30', 3, 'Cita de desparacitacion', '2026-05-28 11:13:01', 1, 'Julieta llego con un peso de 12 kg con un peso aceptable para el baño y desparacitacion'),
(7, 3, NULL, '2026-05-29', '12:30', 5, 'Cita de control', '2026-05-29 03:52:34', 0, NULL),
(8, 1, NULL, '2026-05-30', '14:00', 5, 'Cita de control de Julieta', '2026-05-29 04:16:01', 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id_configuracion` int(11) NOT NULL,
  `marca` varchar(200) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `favicon` varchar(200) NOT NULL,
  `logo` varchar(200) NOT NULL,
  `color` varchar(200) NOT NULL,
  `color_manager` varchar(50) NOT NULL,
  `color_user` varchar(50) NOT NULL,
  `pie_pagina` text NOT NULL,
  `telefono` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id_configuracion`, `marca`, `titulo`, `favicon`, `logo`, `color`, `color_manager`, `color_user`, `pie_pagina`, `telefono`) VALUES
(1, 'Vetsoft', 'vetsoft - Tu veterinaria online', 'Favicon_14aeb66d406e00059c59091ee21029dc.png', 'Logo_5665e4e73a8f847b7427c790f7a3bc00.png', 'bg-theme2', 'bg-theme9', 'bg-theme5', '©Copyright 2026 Vetsoft Todos los derechos reservados.', '573004055563');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctores`
--

CREATE TABLE `doctores` (
  `id_doctor` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `apellido` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `doctores`
--

INSERT INTO `doctores` (`id_doctor`, `nombre`, `apellido`) VALUES
(1, 'Dra. Marcela', 'Muñoz Agudelo'),
(2, 'Dr. Pablo', 'Torres Ríos'),
(3, 'Dra. Laura', 'Peña Acosta'),
(4, 'Dr. Juan', 'Rodríguez Méndez'),
(5, 'Dr. Sebastián', 'Chávez Lara');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `internamientos`
--

CREATE TABLE `internamientos` (
  `id_internamiento` int(11) NOT NULL,
  `id_mascota` int(11) NOT NULL,
  `fecha_entrada` varchar(50) NOT NULL,
  `fecha_salida` varchar(50) NOT NULL,
  `medicinas_aplicadas` text NOT NULL,
  `motivo` text NOT NULL,
  `antecedentes` text NOT NULL,
  `tratamiento` text NOT NULL,
  `fecha_registro` varchar(50) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `internamientos`
--

INSERT INTO `internamientos` (`id_internamiento`, `id_mascota`, `fecha_entrada`, `fecha_salida`, `medicinas_aplicadas`, `motivo`, `antecedentes`, `tratamiento`, `fecha_registro`, `estado`) VALUES
(1, 12, '2022-03-10', '2022-03-14', '...', '....', '...', 'jjjj', '2022-03-14', 1),
(2, 1, '2026-05-03', '', 'sadsad', 'asdsad', 'assad', 'sdsad', '2026-05-05', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id_inventario` int(11) NOT NULL,
  `nombre_articulo` varchar(200) NOT NULL,
  `detalle_articulo` text NOT NULL,
  `numero_factura` varchar(100) NOT NULL,
  `fecha_ingreso` varchar(50) NOT NULL,
  `proveedor` varchar(200) NOT NULL,
  `cantidad_sugerida` varchar(50) NOT NULL,
  `stock` varchar(50) NOT NULL,
  `precio_unitario` varchar(50) NOT NULL,
  `precio_sugerido` varchar(50) NOT NULL,
  `fecha_vencimiento` varchar(50) NOT NULL,
  `codigo_barras` varchar(20) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_img`
--

CREATE TABLE `inventario_img` (
  `id_imagen` int(11) NOT NULL,
  `id_inventario` int(11) NOT NULL,
  `imagen` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascotas`
--

CREATE TABLE `mascotas` (
  `id_mascota` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `fecha_nacimiento` varchar(50) NOT NULL,
  `edad` varchar(50) NOT NULL,
  `raza` varchar(150) NOT NULL,
  `especie` varchar(150) NOT NULL,
  `color` varchar(150) NOT NULL,
  `sexo` varchar(50) NOT NULL,
  `peso` varchar(50) NOT NULL,
  `tipo_peso` varchar(50) NOT NULL,
  `fecha_registro` varchar(50) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mascotas`
--

INSERT INTO `mascotas` (`id_mascota`, `id_usuario`, `nombre`, `fecha_nacimiento`, `edad`, `raza`, `especie`, `color`, `sexo`, `peso`, `tipo_peso`, `fecha_registro`, `estado`) VALUES
(1, 2, 'Julieta', '2025-02-15', '1', 'Pastor alemán', 'Perro', 'Blanco', 'Macho', '8', 'Kilogramos', '2026-05-05 01:10:10', 0),
(2, 2, 'Magnus', '2021-05-15', '4', 'Bóxer', 'Perro', 'cafe y blanco', 'Macho', '12', 'Kilogramos', '2026-05-05 02:25:36', 0),
(3, 8, 'GAGO', '2023-09-25', '2', 'Pinscher', 'Perro', 'Cafe', 'Macho', '2', 'Kilogramos', '2026-05-05 04:48:43', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascotas_img`
--

CREATE TABLE `mascotas_img` (
  `id_imagen` int(11) NOT NULL,
  `id_mascota` int(11) NOT NULL,
  `imagen` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mascotas_img`
--

INSERT INTO `mascotas_img` (`id_imagen`, `id_mascota`, `imagen`) VALUES
(1, 1, 'Mascota_f4a65ebfb3e616797311f362de71998d.jpg'),
(2, 2, 'Mascota_6ec60577c2d65ddf3ddd2831eb3639cd.jpg'),
(3, 3, 'Mascota_df7c2dc5cc5435c0762bc9d6420bc2fb.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `monitoreo`
--

CREATE TABLE `monitoreo` (
  `id_monitoreo` int(11) NOT NULL,
  `dominio` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `monitoreo`
--

INSERT INTO `monitoreo` (`id_monitoreo`, `dominio`) VALUES
(1, 'http://localhost/veterinaria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `razas`
--

CREATE TABLE `razas` (
  `id_raza` int(11) NOT NULL,
  `especie` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `razas`
--

INSERT INTO `razas` (`id_raza`, `especie`, `nombre`) VALUES
(1, 'Perro', 'Bulldog'),
(2, 'Perro', 'Chihuahua'),
(3, 'Perro', 'Labrador'),
(4, 'Perro', 'Pastor alem├ín'),
(5, 'Perro', 'Poodle'),
(6, 'Perro', 'Golden retriever'),
(7, 'Perro', 'Pug'),
(8, 'Perro', 'Husky siberiano'),
(9, 'Perro', 'B├│xer'),
(10, 'Perro', 'Bull terrier'),
(11, 'Perro', 'Cocker'),
(12, 'Perro', 'Basset hound'),
(13, 'Perro', 'Chow Chow'),
(14, 'Perro', 'Pinscher'),
(15, 'Perro', 'Doberman'),
(16, 'Perro', 'Rottweiler'),
(17, 'Perro', 'Schnauzer'),
(18, 'Gato', 'Criollo o mestizo'),
(19, 'Gato', 'Persa'),
(20, 'Gato', 'Bengala'),
(21, 'Gato', 'Balin├®s'),
(22, 'Gato', 'Bombay'),
(23, 'Gato', 'Esfinge'),
(24, 'Gato', 'Siam├®s'),
(25, 'Gato', 'Fold'),
(26, 'Gato', 'Tonkin├®s'),
(27, 'Loro', 'Loritos peque├▒os'),
(28, 'Loro', 'Periquito de anteojos'),
(29, 'Loro', 'Loro real amaz├│nico'),
(30, 'Loro', 'Guacamaya azul y amarilla'),
(31, 'Loro', 'Loro orejiamarillo'),
(32, 'Loro', 'Perico cachetiamarillo'),
(33, 'Loro', 'Periquito australiano'),
(34, 'Hamster', 'H├ímster sirio (dorado)'),
(35, 'Hamster', 'H├ímster ruso'),
(36, 'Hamster', 'H├ímster de Campbell'),
(37, 'Hamster', 'H├ímster roborovski'),
(38, 'Hamster', 'H├ímster chino'),
(39, 'Gato', 'Criollo / Mestizo'),
(40, 'Gato', 'Balinés'),
(41, 'Gato', 'Siamés'),
(42, 'Gato', 'Scottish Fold'),
(43, 'Gato', 'Tonkinés'),
(44, 'Loro', 'Loritos pequeños'),
(45, 'Loro', 'Loro real amazónico'),
(46, 'Hamster', 'Hámster sirio (dorado)'),
(47, 'Hamster', 'Hámster ruso'),
(48, 'Hamster', 'Hámster de Campbell'),
(49, 'Hamster', 'Hámster roborovski'),
(50, 'Hamster', 'Hámster chino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `apellidos` varchar(200) NOT NULL,
  `ciudad` varchar(150) NOT NULL,
  `correo` varchar(150) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `clave` varchar(150) NOT NULL,
  `ultima_conexion` varchar(50) NOT NULL,
  `fecha_registro` varchar(50) NOT NULL,
  `ip` varchar(150) NOT NULL,
  `estado` int(11) NOT NULL,
  `rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellidos`, `ciudad`, `correo`, `telefono`, `clave`, `ultima_conexion`, `fecha_registro`, `ip`, `estado`, `rol`) VALUES
(1, 'Admin William', 'Archila', 'Canada', 'admin@gmail.com', '+1 234 78 90 00', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2026-05-31 08:35:53', '2022-03-20 00:00:00', '::1', 0, 1),
(2, 'William', 'Ferney', 'Cucuta', 'liamarchila97@gmail.com', '3163878745', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '2026-05-31 08:36:08', '2026-05-05 12:48:11', '::1', 0, 2),
(8, 'Edgar ', 'Gonzalez', 'Cucuta', 'edgar.cliente1@vetsoft.com', '3211548754', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Nunca', '2026-05-05', '127.0.0.1', 0, 2),
(9, 'Manuel ', 'rodriguez', 'Los Patios, Norte de Santander', 'manuel.cliente2@vetsoft.com', '0000', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Nunca', '2026-05-05', '127.0.0.1', 0, 2),
(10, 'Camila', 'Maldonado', 'Los Patios, Norte de Santander', 'camila.cliente3@vetsoft.com', '0000', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Nunca', '2026-05-05', '127.0.0.1', 0, 2),
(11, 'Miguel', 'Beltran', 'Ciudad', 'miguel.cliente4@vetsoft.com', '0000', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Nunca', '2026-05-05', '127.0.0.1', 0, 2),
(12, 'Andres Fabian', 'Garcia', 'Ciudad', 'andres.cliente5@vetsoft.com', '0000', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Nunca', '2026-05-05', '127.0.0.1', 0, 2),
(13, 'Doctor Armando', 'Buen dia', 'Ciudad', 'doctor1@vetsoft.com', '0000', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Nunca', '2026-05-05', '127.0.0.1', 0, 3),
(18, 'Carlos', 'Martínez Ruiz', 'Bogotá', 'carlos.admin@vetsoft.com', '3001111001', 'f865b53623b121fd34ee5426c792e5c33af8c227', '2026-05-05 11:08:15', '2026-05-05 11:08:15', '127.0.0.1', 0, 1),
(19, 'Daniela', 'Gómez Pérez', 'Medellín', 'daniela.admin@vetsoft.com', '3001111002', 'f865b53623b121fd34ee5426c792e5c33af8c227', '2026-05-05 11:08:15', '2026-05-05 11:08:15', '127.0.0.1', 0, 1),
(20, 'Fernando', 'López Torres', 'Cali', 'fernando.admin@vetsoft.com', '3001111003', 'f865b53623b121fd34ee5426c792e5c33af8c227', '2026-05-05 11:08:15', '2026-05-05 11:08:15', '127.0.0.1', 0, 1),
(21, 'Valentina', 'Hernández Cruz', 'Barranquilla', 'valentina.admin@vetsoft.com', '3001111004', 'f865b53623b121fd34ee5426c792e5c33af8c227', '2026-05-05 11:08:15', '2026-05-05 11:08:15', '127.0.0.1', 0, 1),
(22, 'Ricardo', 'Morales Vega', 'Cartagena', 'ricardo.admin@vetsoft.com', '3001111005', 'f865b53623b121fd34ee5426c792e5c33af8c227', '2026-05-05 11:08:15', '2026-05-05 11:08:15', '127.0.0.1', 0, 1),
(23, 'Sofía', 'Ramírez Díaz', 'Bogotá', 'sofia.cliente@gmail.com', '3002222001', 'f865b53623b121fd34ee5426c792e5c33af8c227', '2026-05-05 03:41:35', '2026-05-05 11:08:15', '::1', 0, 2),
(24, 'Andrés', 'Castro Suárez', 'Medellín', 'andres.cliente@gmail.com', '3002222002', 'f865b53623b121fd34ee5426c792e5c33af8c227', '2026-05-05 11:08:15', '2026-05-05 11:08:15', '127.0.0.1', 0, 2),
(25, 'Camila', 'Vargas Ortiz', 'Cali', 'camila.cliente@gmail.com', '3002222003', 'f865b53623b121fd34ee5426c792e5c33af8c227', '2026-05-05 11:08:15', '2026-05-05 11:08:15', '127.0.0.1', 0, 2),
(26, 'Miguel', 'Salcedo Blanco', 'Pereira', 'miguel.cliente@gmail.com', '3002222004', 'f865b53623b121fd34ee5426c792e5c33af8c227', '2026-05-05 11:08:15', '2026-05-05 11:08:15', '127.0.0.1', 0, 2),
(27, 'Natalia', 'Jiménez Rojas', 'Manizales', 'natalia.cliente@gmail.com', '3002222005', 'f865b53623b121fd34ee5426c792e5c33af8c227', '2026-05-05 11:08:15', '2026-05-05 11:08:15', '127.0.0.1', 0, 2),
(28, 'Dr. Juan', 'Rodríguez Méndez', 'Bogotá', 'juan.doctor@vetsoft.com', '3003333001', 'f865b53623b121fd34ee5426c792e5c33af8c227', '2026-05-05 11:08:15', '2026-05-05 11:08:15', '127.0.0.1', 0, 3),
(29, 'Dra. Laura', 'Peña Acosta', 'Medellín', 'laura.doctor@vetsoft.com', '3003333002', 'f865b53623b121fd34ee5426c792e5c33af8c227', '2026-05-29 12:12:47', '2026-05-05 11:08:15', '::1', 0, 3),
(30, 'Dr. Pablo', 'Torres Ríos', 'Cali', 'pablo.doctor@vetsoft.com', '3003333003', 'f865b53623b121fd34ee5426c792e5c33af8c227', '2026-05-05 11:08:15', '2026-05-05 11:08:15', '127.0.0.1', 0, 3),
(31, 'Dra. Marcela', 'Muñoz Agudelo', 'Bucaramanga', 'marcela.doctor@vetsoft.com', '3003333004', 'f865b53623b121fd34ee5426c792e5c33af8c227', '2026-05-05 05:05:59', '2026-05-05 11:08:15', '::1', 0, 3),
(32, 'Dr. Sebastián', 'Chávez Lara', 'Pasto', 'sebastian.doctor@vetsoft.com', '3003333005', 'f865b53623b121fd34ee5426c792e5c33af8c227', '2026-05-05 11:08:15', '2026-05-05 11:08:15', '127.0.0.1', 0, 3),
(33, 'Wilmer', 'Ferney', 'Cucuta', 'rr_02@gmail.com', '3224557894', 'b4fac44326371f468d3993b8b7c0272a4d21cd14', '2026-05-28 11:04:57', '2026-05-28 11:04:46', '::1', 0, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacunas`
--

CREATE TABLE `vacunas` (
  `id_vacuna` int(11) NOT NULL,
  `id_mascota` int(11) NOT NULL,
  `nombre_vacuna` varchar(150) NOT NULL,
  `fecha_aplicacion` date NOT NULL,
  `tiempo_meses` int(11) NOT NULL,
  `proxima_fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vacunas`
--

INSERT INTO `vacunas` (`id_vacuna`, `id_mascota`, `nombre_vacuna`, `fecha_aplicacion`, `tiempo_meses`, `proxima_fecha`) VALUES
(1, 3, 'Rabia', '2026-05-06', 12, '2027-05-05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `total` varchar(50) NOT NULL,
  `fecha_registro` varchar(50) NOT NULL,
  `cod` varchar(200) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `id_usuario`, `total`, `fecha_registro`, `cod`, `estado`) VALUES
(1, 0, '0', '0', '0', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_detalle`
--

CREATE TABLE `ventas_detalle` (
  `id_venta_detalle` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_inventario` int(11) NOT NULL,
  `precio` varchar(50) NOT NULL,
  `cantidad` varchar(50) NOT NULL,
  `total` varchar(50) NOT NULL,
  `fecha_registro` varchar(50) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitas`
--

CREATE TABLE `visitas` (
  `id_visita` int(11) NOT NULL,
  `id_mascota` int(11) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `motivo` text NOT NULL,
  `peso` varchar(50) NOT NULL,
  `tipo_peso` varchar(50) NOT NULL,
  `temperatura` varchar(50) NOT NULL,
  `sintomas` text NOT NULL,
  `diagnostico` text NOT NULL,
  `medicinas_aplicadas` text NOT NULL,
  `visita_proxima` varchar(50) NOT NULL,
  `motivo_proximo` text NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `visitas`
--

INSERT INTO `visitas` (`id_visita`, `id_mascota`, `fecha`, `motivo`, `peso`, `tipo_peso`, `temperatura`, `sintomas`, `diagnostico`, `medicinas_aplicadas`, `visita_proxima`, `motivo_proximo`, `estado`) VALUES
(1, 1, '2026-05-05 04:24:56', 'Cita de diagnostico y control proritario', '12', 'Kilogramos', '28', 'ASDASD', 'SADASD', 'SDASD', '2026-05-01', 'Cita de control prioritario para seguimiento del estado del animal', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitas_img`
--

CREATE TABLE `visitas_img` (
  `id_imagen` int(11) NOT NULL,
  `id_visita` int(11) NOT NULL,
  `imagen` varchar(150) NOT NULL,
  `tipo_archivo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD PRIMARY KEY (`id_actividad`);

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`id_caja`);

--
-- Indices de la tabla `calendario`
--
ALTER TABLE `calendario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id_cita`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id_configuracion`);

--
-- Indices de la tabla `doctores`
--
ALTER TABLE `doctores`
  ADD PRIMARY KEY (`id_doctor`);

--
-- Indices de la tabla `internamientos`
--
ALTER TABLE `internamientos`
  ADD PRIMARY KEY (`id_internamiento`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id_inventario`);

--
-- Indices de la tabla `inventario_img`
--
ALTER TABLE `inventario_img`
  ADD PRIMARY KEY (`id_imagen`);

--
-- Indices de la tabla `mascotas`
--
ALTER TABLE `mascotas`
  ADD PRIMARY KEY (`id_mascota`);

--
-- Indices de la tabla `mascotas_img`
--
ALTER TABLE `mascotas_img`
  ADD PRIMARY KEY (`id_imagen`);

--
-- Indices de la tabla `monitoreo`
--
ALTER TABLE `monitoreo`
  ADD PRIMARY KEY (`id_monitoreo`);

--
-- Indices de la tabla `razas`
--
ALTER TABLE `razas`
  ADD PRIMARY KEY (`id_raza`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `vacunas`
--
ALTER TABLE `vacunas`
  ADD PRIMARY KEY (`id_vacuna`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`);

--
-- Indices de la tabla `ventas_detalle`
--
ALTER TABLE `ventas_detalle`
  ADD PRIMARY KEY (`id_venta_detalle`);

--
-- Indices de la tabla `visitas`
--
ALTER TABLE `visitas`
  ADD PRIMARY KEY (`id_visita`);

--
-- Indices de la tabla `visitas_img`
--
ALTER TABLE `visitas_img`
  ADD PRIMARY KEY (`id_imagen`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividad`
--
ALTER TABLE `actividad`
  MODIFY `id_actividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `id_caja` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `calendario`
--
ALTER TABLE `calendario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id_cita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id_configuracion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `doctores`
--
ALTER TABLE `doctores`
  MODIFY `id_doctor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `internamientos`
--
ALTER TABLE `internamientos`
  MODIFY `id_internamiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id_inventario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventario_img`
--
ALTER TABLE `inventario_img`
  MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mascotas`
--
ALTER TABLE `mascotas`
  MODIFY `id_mascota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `mascotas_img`
--
ALTER TABLE `mascotas_img`
  MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `monitoreo`
--
ALTER TABLE `monitoreo`
  MODIFY `id_monitoreo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `razas`
--
ALTER TABLE `razas`
  MODIFY `id_raza` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `vacunas`
--
ALTER TABLE `vacunas`
  MODIFY `id_vacuna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ventas_detalle`
--
ALTER TABLE `ventas_detalle`
  MODIFY `id_venta_detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `visitas`
--
ALTER TABLE `visitas`
  MODIFY `id_visita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `visitas_img`
--
ALTER TABLE `visitas_img`
  MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
