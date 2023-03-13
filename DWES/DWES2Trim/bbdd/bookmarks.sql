-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 06-03-2023 a las 18:01:37
-- Versión del servidor: 8.0.32-0ubuntu0.20.04.2
-- Versión de PHP: 7.4.3-4ubuntu2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bookmarks`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bookmarks`
--

CREATE TABLE `bookmarks` (
  `id` int NOT NULL,
  `bm_url` varchar(256) COLLATE utf8mb3_spanish_ci NOT NULL,
  `descripcion` varchar(256) COLLATE utf8mb3_spanish_ci NOT NULL,
  `idUsuario` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `bookmarks`
--

INSERT INTO `bookmarks` (`id`, `bm_url`, `descripcion`, `idUsuario`) VALUES
(1, 'https://www.google.com/', 'Pagina de google', 2),
(2, 'https://twitter.com/', 'Pagina twitter', 2),
(4, 'https://www.reddit.com', 'Pagina reddit', 2),
(6, 'https://www.google.com/maps', 'Google Maps', 3),
(7, 'https://www.chollometro.com/', 'chollometro', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `perfil` varchar(10) COLLATE utf8mb3_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`perfil`) VALUES
('admin'),
('user');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `nombre` varchar(128) COLLATE utf8mb3_spanish_ci NOT NULL,
  `user` varchar(16) COLLATE utf8mb3_spanish_ci NOT NULL,
  `psw` varchar(40) COLLATE utf8mb3_spanish_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `perfil` varchar(10) COLLATE utf8mb3_spanish_ci NOT NULL,
  `bloqueado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `user`, `psw`, `email`, `perfil`, `bloqueado`) VALUES
(1, 'Javier', 'admin', 'admin', 'javi@gmail.com', 'admin', 0),
(2, 'Paco', 'user', 'user', 'paco@gmail.com', 'user', 0),
(3, 'juan', 'juan', 'juan', 'juan@gmail.com', 'user', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuarios` (`idUsuario`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`perfil`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user` (`user`),
  ADD KEY `fk1_perfiles` (`perfil`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bookmarks`
--
ALTER TABLE `bookmarks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD CONSTRAINT `fk_usuarios` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk1_perfiles` FOREIGN KEY (`perfil`) REFERENCES `perfiles` (`perfil`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
