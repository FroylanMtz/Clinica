-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 29-08-2020 a las 13:13:57
-- Versión del servidor: 5.7.31-0ubuntu0.18.04.1
-- Versión de PHP: 7.2.24-0ubuntu0.18.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `consultorio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alergias`
--

CREATE TABLE `alergias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alergias`
--

INSERT INTO `alergias` (`id`, `nombre`, `tipo`) VALUES
(1, 'Polennnn', 'Piel'),
(2, 'Alergia al polvo', 'Corporal'),
(4, 'Penicilina', 'Alergia a la penicilina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos`
--

CREATE TABLE `archivos` (
  `id` int(11) NOT NULL,
  `ruta` varchar(255) NOT NULL,
  `tipo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `archivos`
--

INSERT INTO `archivos` (`id`, `ruta`, `tipo`) VALUES
(1, 'radio1.png', 'Imagen png'),
(3, '1596513304.png', 'imagen'),
(6, '1596513384.jpeg', 'imagen'),
(9, '1596688182.png', 'imagen'),
(10, '1596807104.jpeg', 'imagen'),
(11, '1597337449.jpeg', 'imagen');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajas`
--

CREATE TABLE `cajas` (
  `id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `f_apertura` date NOT NULL,
  `f_cierre` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cajas`
--

INSERT INTO `cajas` (`id`, `total`, `f_apertura`, `f_cierre`) VALUES
(1, '2200.00', '2020-07-27', '2020-07-27'),
(2, '3500.00', '2020-07-27', '2020-07-28'),
(3, '-4700.00', '2020-07-28', '2020-08-07'),
(5, '14900.00', '2020-08-07', '2020-08-11'),
(6, '1000.00', '2020-08-11', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja_pago`
--

CREATE TABLE `caja_pago` (
  `id` int(11) NOT NULL,
  `id_caja` int(11) NOT NULL,
  `id_pago` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `caja_pago`
--

INSERT INTO `caja_pago` (`id`, `id_caja`, `id_pago`) VALUES
(7, 5, 15),
(8, 5, 16),
(9, 6, 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `detalles` text NOT NULL,
  `id_enfermedad` int(11) DEFAULT NULL,
  `doctor_id` int(11) UNSIGNED DEFAULT NULL,
  `paciente_id` int(11) NOT NULL,
  `pago` int(11) DEFAULT NULL,
  `observaciones` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id`, `fecha`, `hora`, `detalles`, `id_enfermedad`, `doctor_id`, `paciente_id`, `pago`, `observaciones`) VALUES
(25, '2020-08-08', '11:40:00', 'sdfsadf', 1, 25, 5, 17, 'toss'),
(27, '2020-08-08', '16:54:00', 'tos', 3, 25, 6, NULL, 'aaaaa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita_medicina`
--

CREATE TABLE `cita_medicina` (
  `id` int(11) NOT NULL,
  `id_cita` int(11) NOT NULL,
  `id_medicina` int(11) NOT NULL,
  `observaciones` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cita_medicina`
--

INSERT INTO `cita_medicina` (`id`, `id_cita`, `id_medicina`, `observaciones`) VALUES
(37, 27, 1, '1 cada 3 hrs');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enfermedades`
--

CREATE TABLE `enfermedades` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `causa` varchar(255) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `enfermedades`
--

INSERT INTO `enfermedades` (`id`, `nombre`, `tipo`, `causa`, `created_at`, `updated_at`) VALUES
(1, 'Tosssss', 'ASDF', 'PATOGENO', NULL, '2020-07-20'),
(2, 'Fiebre', 'En todo el puerco', 'Bacteria', '2020-07-20', '2020-07-20'),
(3, 'Dengue', 'Virus', 'Picadur de mosquito', '2020-07-30', '2020-07-30'),
(4, 'covid-19', 'Virus', 'Contagio', '2020-07-30', '2020-07-30'),
(5, 'dengue', 'Corporal', 'gggg', '2020-08-11', '2020-08-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicina`
--

CREATE TABLE `medicina` (
  `id` int(11) NOT NULL,
  `nombre` varchar(99) NOT NULL,
  `presentacion` varchar(255) NOT NULL,
  `detalles` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `medicina`
--

INSERT INTO `medicina` (`id`, `nombre`, `presentacion`, `detalles`) VALUES
(1, 'Penicilina', 'Tabletas', 'Para curar todoo'),
(2, 'Simvastatina', 'Capsulas', 'Para controlar el colesterol'),
(3, 'Diclofenaco', 'Capsulas', 'Para el dolor en general'),
(4, 'tempra', 'pastilla', 'chica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `edad` int(11) NOT NULL,
  `altura` decimal(10,3) NOT NULL,
  `peso` decimal(10,3) NOT NULL,
  `sexo` varchar(255) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`id`, `nombre`, `apellido`, `edad`, `altura`, `peso`, `sexo`, `fecha_nacimiento`, `foto`) VALUES
(5, 'claudia', 'carrizales', 21, '1.670', '52.000', 'Femenino', '2020-07-07', NULL),
(6, 'José', 'Lopez', 40, '1.600', '60.000', 'Masculino', '2020-08-01', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente_alergias`
--

CREATE TABLE `paciente_alergias` (
  `id` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_alergia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `paciente_alergias`
--

INSERT INTO `paciente_alergias` (`id`, `id_paciente`, `id_alergia`) VALUES
(36, 5, 1),
(38, 6, 2),
(39, 6, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente_usuarios`
--

CREATE TABLE `paciente_usuarios` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) UNSIGNED NOT NULL,
  `medico_asociado` int(11) UNSIGNED NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `info` int(11) NOT NULL,
  `alergias` int(11) NOT NULL,
  `enfermedades` int(11) NOT NULL,
  `medicinas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `paciente_usuarios`
--

INSERT INTO `paciente_usuarios` (`id`, `id_usuario`, `medico_asociado`, `id_paciente`, `fecha`, `info`, `alergias`, `enfermedades`, `medicinas`) VALUES
(21, 25, 26, 5, '2020-08-08', 1, 0, 1, 1),
(22, 25, 26, 6, '2020-08-11', 0, 0, 0, 1),
(23, 23, 26, 6, '2020-08-13', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `detalles` text NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `estado` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id`, `fecha`, `total`, `detalles`, `tipo`, `estado`) VALUES
(3, '2020-07-27', '900', 'cita semanal', 'Transferencia', NULL),
(4, '2020-07-27', '1000', 'cita semanaal', 'Tarjeta', NULL),
(15, '2020-08-07', '15000', 'pago', 'Efectivo', NULL),
(16, '2020-08-11', '500', 'cita diaria', 'Efectivo', NULL),
(17, '2020-08-12', '1000', 'Consulta', 'Efectivo', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `email`, `email_verified_at`, `password`, `tipo`, `edad`, `remember_token`, `created_at`, `updated_at`) VALUES
(23, 'admin', 'admin', 'admin123@admin.com', NULL, '$2y$10$7XzFL/pG/U1EpOvBBzc6Zu5Er2OVI0aVlRNI2sHqQQ.hEGpVqbUla', '1', NULL, NULL, '2020-07-28 04:51:35', '2020-07-28 04:51:35'),
(24, 'secretaria', 'secretaria', 'secretaria123@secretaria.com', NULL, '$2y$10$brHskpdN69/8XTJbeQ01su09ADwnOJ9EKyvMw0UaYd2xIX2P5v6T2', '4', NULL, NULL, '2020-07-28 04:53:13', '2020-07-28 04:53:13'),
(25, 'medico', 'medico', 'medico123@medico.com', NULL, '$2y$10$CtS5gvoiubthdr2lW40S/Oavxtj7anmH8Gw5YMJEUjg1ypxtEkzPi', '2', NULL, NULL, '2020-07-28 04:53:54', '2020-07-28 04:53:54'),
(26, 'medico_asociado', 'medico_asociado', 'asociado123@asociado.com', NULL, '$2y$10$ycK/WgmWfJmtIEA2F1CWgeE.KNH6Occ9gIhJKvMjbAGH/jhIYExfi', '3', NULL, NULL, '2020-07-28 04:57:10', '2020-07-28 04:57:10'),
(27, 'Patricio', 'Estrella', 'patricio@patricio.com', NULL, '$2y$10$FAZOb9H/zWuUF0WKQdd8LOy7yq.Eq91KWR1B0OFXzwFqZelpgnIG2', '3', NULL, NULL, '2020-08-02 13:35:12', '2020-08-02 13:35:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_archivo`
--

CREATE TABLE `usuario_archivo` (
  `id` int(11) NOT NULL,
  `id_archivo` int(11) NOT NULL,
  `id_usuario` int(11) UNSIGNED NOT NULL,
  `medico_asociado` int(11) UNSIGNED NOT NULL,
  `comentario` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario_archivo`
--

INSERT INTO `usuario_archivo` (`id`, `id_archivo`, `id_usuario`, `medico_asociado`, `comentario`) VALUES
(3, 6, 23, 26, 'El paciente se ve grabe, necesita darle tratamiento y examinarlo cuanto antes...'),
(6, 9, 23, 26, 'El paciente se ha roto un hueso, es grabe.'),
(7, 10, 25, 27, 'Imagen bonita 2'),
(8, 11, 23, 27, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alergias`
--
ALTER TABLE `alergias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cajas`
--
ALTER TABLE `cajas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `caja_pago`
--
ALTER TABLE `caja_pago`
  ADD PRIMARY KEY (`id`),
  ADD KEY `caja_pago_fk1` (`id_caja`),
  ADD KEY `caja_pagp_fk2` (`id_pago`);

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointment_fk1` (`id_enfermedad`),
  ADD KEY `appointment_fk2` (`paciente_id`),
  ADD KEY `appointment_fk3` (`doctor_id`),
  ADD KEY `appointment_fk4` (`pago`);

--
-- Indices de la tabla `cita_medicina`
--
ALTER TABLE `cita_medicina`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cita_medicina_fk1` (`id_medicina`),
  ADD KEY `cita_medicina_fk2` (`id_cita`);

--
-- Indices de la tabla `enfermedades`
--
ALTER TABLE `enfermedades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `medicina`
--
ALTER TABLE `medicina`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paciente_alergias`
--
ALTER TABLE `paciente_alergias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paciente_alergias_fk1` (`id_paciente`),
  ADD KEY `paciente_alergias_fk2` (`id_alergia`);

--
-- Indices de la tabla `paciente_usuarios`
--
ALTER TABLE `paciente_usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_paciente_fk1` (`id_usuario`),
  ADD KEY `user_paciente_fk2` (`id_paciente`),
  ADD KEY `user_paciente_fk3` (`medico_asociado`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `user_tipo` (`tipo`);

--
-- Indices de la tabla `usuario_archivo`
--
ALTER TABLE `usuario_archivo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_compartir_fk1` (`id_archivo`),
  ADD KEY `usuario_compartir_fk2` (`id_usuario`),
  ADD KEY `usuario_compartir_fk3` (`medico_asociado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alergias`
--
ALTER TABLE `alergias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `archivos`
--
ALTER TABLE `archivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `cajas`
--
ALTER TABLE `cajas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `caja_pago`
--
ALTER TABLE `caja_pago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `cita_medicina`
--
ALTER TABLE `cita_medicina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `enfermedades`
--
ALTER TABLE `enfermedades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `medicina`
--
ALTER TABLE `medicina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `paciente_alergias`
--
ALTER TABLE `paciente_alergias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `paciente_usuarios`
--
ALTER TABLE `paciente_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `usuario_archivo`
--
ALTER TABLE `usuario_archivo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `caja_pago`
--
ALTER TABLE `caja_pago`
  ADD CONSTRAINT `caja_pago_fk1` FOREIGN KEY (`id_caja`) REFERENCES `cajas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `caja_pagp_fk2` FOREIGN KEY (`id_pago`) REFERENCES `pagos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `appointment_fk1` FOREIGN KEY (`id_enfermedad`) REFERENCES `enfermedades` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointment_fk2` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointment_fk3` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointment_fk4` FOREIGN KEY (`pago`) REFERENCES `pagos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cita_medicina`
--
ALTER TABLE `cita_medicina`
  ADD CONSTRAINT `cita_medicina_fk1` FOREIGN KEY (`id_medicina`) REFERENCES `medicina` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cita_medicina_fk2` FOREIGN KEY (`id_cita`) REFERENCES `citas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `paciente_alergias`
--
ALTER TABLE `paciente_alergias`
  ADD CONSTRAINT `paciente_alergias_fk1` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `paciente_alergias_fk2` FOREIGN KEY (`id_alergia`) REFERENCES `alergias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `paciente_usuarios`
--
ALTER TABLE `paciente_usuarios`
  ADD CONSTRAINT `user_paciente_fk1` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_paciente_fk2` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_paciente_fk3` FOREIGN KEY (`medico_asociado`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario_archivo`
--
ALTER TABLE `usuario_archivo`
  ADD CONSTRAINT `usuario_compartir_fk1` FOREIGN KEY (`id_archivo`) REFERENCES `archivos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_compartir_fk2` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_compartir_fk3` FOREIGN KEY (`medico_asociado`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
