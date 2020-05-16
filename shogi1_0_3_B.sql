-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-04-2020 a las 08:45:47
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `shogi1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `idContacto` int(11) NOT NULL,
  `nombreC` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `titulo` varchar(155) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_spanish2_ci NOT NULL,
  `correo` varchar(155) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`idContacto`, `nombreC`, `titulo`, `descripcion`, `correo`) VALUES
(1, 'Jorge Esteban Restrepo Restrepo', 'Probando sección de contacto', 'Hola, soy tu padre. El sujeto que todos los días, sin falta hace una u otra cosilla, un controlador aquí, un modelo allá, depurando en tal módulo y entre otras cosas.', 'joruresu4@gmail.com'),
(2, 'Mellamo Jorge', 'Probando paginación', 'Este tiquet de contacto es para probar la paginación', 'supapito@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devreport`
--

CREATE TABLE `devreport` (
  `idReport` int(11) NOT NULL,
  `titulo` varchar(155) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_spanish2_ci NOT NULL,
  `correo` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `enlace` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `devreport`
--

INSERT INTO `devreport` (`idReport`, `titulo`, `descripcion`, `correo`, `enlace`) VALUES
(2, 'Test', 'Probando sección de reportes', 'supapito@gmail.com', 'http://localhost:8080/shogi-c/index.php?vista=vDev-report');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diseno`
--

CREATE TABLE `diseno` (
  `idContent` int(11) NOT NULL,
  `titulo` varchar(155) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `enlace` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `diseno`
--

INSERT INTO `diseno` (`idContent`, `titulo`, `descripcion`, `imagen`, `enlace`) VALUES
(25, 'Logo', 'Primer logo (que yo sepa) de la federación', 'images/Copiademapita3.png', 'https://drive.google.com/file/d/1jkSyye5k1ekbyxjX3iWHn4J49SA4Qr1V/view?usp=sharing');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `joinus`
--

CREATE TABLE `joinus` (
  `idJoinUs` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `fecha` varchar(15) COLLATE utf8mb4_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `idNoticia` int(11) NOT NULL,
  `titulo` varchar(155) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_spanish2_ci NOT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `autor` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`idNoticia`, `titulo`, `descripcion`, `imagen`, `autor`, `fecha`) VALUES
(10, 'Kuraha\'s News Section', 'Probando cambios en 2 sistemas:<br>- Noticias, se cambió la forma en como se suben imágenes, las rutas en dónde se almacenan.<br>- Paginación, se implementó y se corrigieron errores de PHP_EOL', 'images/WoWScrnShot_041620_213801.jpg', 'Jorge Restrepo', '2020-04-27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `IdRol` int(11) NOT NULL,
  `Rol` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`IdRol`, `Rol`) VALUES
(1, 'Administrador'),
(2, 'common'),
(3, 'Diseno'),
(4, 'Traduccion'),
(5, 'Difusion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `IdUsuario` int(11) NOT NULL,
  `Usuario` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Clave` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `NombreCompleto` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Correo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `IdRol` int(11) NOT NULL,
  `Estado` tinyint(1) NOT NULL,
  `memberCode` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nacimiento` date DEFAULT NULL,
  `habilidades` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `mensaje` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`IdUsuario`, `Usuario`, `Clave`, `NombreCompleto`, `Correo`, `IdRol`, `Estado`, `memberCode`, `nacimiento`, `habilidades`, `mensaje`) VALUES
(3, 'KurahaSho', '2238097ccfc2a65fd31ad071ca8ebe65', 'Jorge Restrepo', 'joruresu4@gmail.com', 2, 1, '', '2001-07-12', 'programación', 'KurahaSho, así me dicen, también \"dizque parcerito\"'),
(4, 'KurahaSho', '2238097ccfc2a65fd31ad071ca8ebe65', 'Jorge Restrepo', 'joruresu4@gmail.com', 1, 1, '', '0000-00-00', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`idContacto`);

--
-- Indices de la tabla `devreport`
--
ALTER TABLE `devreport`
  ADD PRIMARY KEY (`idReport`);

--
-- Indices de la tabla `diseno`
--
ALTER TABLE `diseno`
  ADD PRIMARY KEY (`idContent`);

--
-- Indices de la tabla `joinus`
--
ALTER TABLE `joinus`
  ADD PRIMARY KEY (`idJoinUs`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`idNoticia`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`IdRol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`IdUsuario`),
  ADD KEY `IdRol` (`IdRol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `idContacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `devreport`
--
ALTER TABLE `devreport`
  MODIFY `idReport` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `diseno`
--
ALTER TABLE `diseno`
  MODIFY `idContent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `joinus`
--
ALTER TABLE `joinus`
  MODIFY `idJoinUs` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `idNoticia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `IdRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_roles` FOREIGN KEY (`IdRol`) REFERENCES `roles` (`IdRol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
