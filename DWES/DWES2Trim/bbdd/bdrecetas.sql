-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-03-2023 a las 20:09:21
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdrecetas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colaboradores`
--

CREATE TABLE `colaboradores` (
  `cuenta` varchar(50) NOT NULL,
  `saldo` decimal(12,2) DEFAULT NULL,
  `idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `colaboradores`
--

INSERT INTO `colaboradores` (`cuenta`, `saldo`, `idusuario`) VALUES
('959156156162', '4545.00', 6),
('959156156145', '50.00', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config`
--

CREATE TABLE `config` (
  `id` varchar(45) NOT NULL,
  `tiempoinactividad` int(11) DEFAULT NULL,
  `beneficios` decimal(12,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `config`
--

INSERT INTO `config` (`id`, `tiempoinactividad`, `beneficios`) VALUES
('1', 60, '10000.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `perfil` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`perfil`) VALUES
('Admin'),
('Collaborator'),
('User');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recetas`
--

CREATE TABLE `recetas` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `ingredientes` mediumtext DEFAULT NULL,
  `elaboracion` mediumtext DEFAULT NULL,
  `etiquetas` varchar(250) DEFAULT NULL,
  `publica` tinyint(4) DEFAULT NULL,
  `imagen` varchar(250) DEFAULT NULL,
  `idColaborador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `recetas`
--

INSERT INTO `recetas` (`id`, `titulo`, `ingredientes`, `elaboracion`, `etiquetas`, `publica`, `imagen`, `idColaborador`) VALUES
(8, 'Macarrones con queso', 'Macarrones y queso', 'Hervir los macarrones', 'Facil rapido', 1, 'thumb04-e1622557271226.jpg', 6),
(9, 'Patatas fritas', 'Patatas y aceite', 'Freir las patatas', 'Facil rico', 1, 'patatas.png', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `r_usuarios_perfiles`
--

CREATE TABLE `r_usuarios_perfiles` (
  `Perfiles_perfil` varchar(15) NOT NULL,
  `usuarios_id` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `r_usuarios_perfiles`
--

INSERT INTO `r_usuarios_perfiles` (`Perfiles_perfil`, `usuarios_id`, `id`) VALUES
('User', 1, 1),
('User', 2, 2),
('User', 3, 3),
('Admin', 4, 4),
('Admin', 5, 5),
('Collaborator', 6, 6),
('Collaborator', 7, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `r_usuarios_recetas_favoritas`
--

CREATE TABLE `r_usuarios_recetas_favoritas` (
  `id` int(11) NOT NULL,
  `usuarios_id` int(11) NOT NULL,
  `recetas_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `r_usuarios_recetas_votacion`
--

CREATE TABLE `r_usuarios_recetas_votacion` (
  `id` int(11) NOT NULL,
  `usuarios_id` int(11) NOT NULL,
  `recetas_id` int(11) NOT NULL,
  `puntuacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `usuario` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `estado` enum('Activo','Bloqueado') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `password`, `estado`) VALUES
(1, 'Usuario1', 'usuario1', 'usuario1', 'Activo'),
(2, 'Usuario2', 'usuario2', 'usuario2', 'Activo'),
(3, 'Usuario3', 'usuario3', 'usuario3', 'Activo'),
(4, 'Usuario administrador 1', 'admin1', 'admin1', 'Activo'),
(5, 'Usuario administrador 2', 'admin2', 'admin2', 'Activo'),
(6, 'Usuario colaborador 1', 'colaborador1', 'colaborador1', 'Activo'),
(7, 'Usuario colaborador 2', 'colaborador2', 'colaborador2', 'Activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `colaboradores`
--
ALTER TABLE `colaboradores`
  ADD PRIMARY KEY (`idusuario`);

--
-- Indices de la tabla `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`perfil`);

--
-- Indices de la tabla `recetas`
--
ALTER TABLE `recetas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_recetas_colaboradores1_idx` (`idColaborador`);

--
-- Indices de la tabla `r_usuarios_perfiles`
--
ALTER TABLE `r_usuarios_perfiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Perfiles_has_usuarios_usuarios1_idx` (`usuarios_id`),
  ADD KEY `fk_Perfiles_has_usuarios_Perfiles1_idx` (`Perfiles_perfil`);

--
-- Indices de la tabla `r_usuarios_recetas_favoritas`
--
ALTER TABLE `r_usuarios_recetas_favoritas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuarios_has_recetas_recetas3_idx` (`recetas_id`),
  ADD KEY `fk_usuarios_has_recetas_usuarios2_idx` (`usuarios_id`);

--
-- Indices de la tabla `r_usuarios_recetas_votacion`
--
ALTER TABLE `r_usuarios_recetas_votacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuarios_has_recetas_recetas2_idx` (`recetas_id`),
  ADD KEY `fk_usuarios_has_recetas_usuarios1_idx` (`usuarios_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario_UNIQUE` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `recetas`
--
ALTER TABLE `recetas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `colaboradores`
--
ALTER TABLE `colaboradores`
  ADD CONSTRAINT `fk_colaboradores_usuarios1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `recetas`
--
ALTER TABLE `recetas`
  ADD CONSTRAINT `fk_recetas_colaboradores1` FOREIGN KEY (`idColaborador`) REFERENCES `colaboradores` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `r_usuarios_perfiles`
--
ALTER TABLE `r_usuarios_perfiles`
  ADD CONSTRAINT `fk_Perfiles_has_usuarios_Perfiles1` FOREIGN KEY (`Perfiles_perfil`) REFERENCES `perfiles` (`perfil`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Perfiles_has_usuarios_usuarios1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `r_usuarios_recetas_favoritas`
--
ALTER TABLE `r_usuarios_recetas_favoritas`
  ADD CONSTRAINT `fk_usuarios_has_recetas_recetas3` FOREIGN KEY (`recetas_id`) REFERENCES `recetas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuarios_has_recetas_usuarios2` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `r_usuarios_recetas_votacion`
--
ALTER TABLE `r_usuarios_recetas_votacion`
  ADD CONSTRAINT `fk_usuarios_has_recetas_recetas2` FOREIGN KEY (`recetas_id`) REFERENCES `recetas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuarios_has_recetas_usuarios1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
