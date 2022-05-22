-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-05-2022 a las 16:21:28
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `club`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administracion`
--

CREATE TABLE `administracion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `email` varchar(90) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `password` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `administracion`
--

INSERT INTO `administracion` (`id`, `nombre`, `email`, `password`) VALUES
(1, 'admin', 'justvoleycv@gmail.com', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejercicio`
--

CREATE TABLE `ejercicio` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `descripcion` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `foto` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ejercicio`
--

INSERT INTO `ejercicio` (`id`, `nombre`, `descripcion`, `foto`) VALUES
(1, 'saque largo', 'Para realizar un saque largo, lanzamos el balón a una distancia media y golpeamos con toda nuestra palma', 'saque_largo.png'),
(2, 'bloqueo', 'La técnica del bloqueo consiste en bajar para coger impulso y saltar con nuestros 2 brazos en alto para parar el balón y al ser posible devolverlo a la cancha del rival', 'bloqueo.jpg'),
(3, 'carrera continua', 'La carrera continua se basa en correr a un ritmo medio con el objetivo de ganar más resistencia', 'carrera.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrenador`
--

CREATE TABLE `entrenador` (
  `id` int(11) NOT NULL,
  `foto` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'placeholder.png',
  `nombre` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `apellidos` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `dni` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `telefono` int(9) NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `titulacion` int(11) NOT NULL,
  `password` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `entrenador`
--

INSERT INTO `entrenador` (`id`, `foto`, `nombre`, `apellidos`, `dni`, `telefono`, `email`, `titulacion`, `password`) VALUES
(1, 'placeholder.png', 'Alejandro', 'Aguilar Otero', '77190415B', 617800670, 'alexakarex@gmail.com', 1, 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec'),
(24, 'pa_david2.png', 'David', 'Ramos Navajas', '77453291C', 636603516, 'davidr@gmail.com', 2, 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `instagram` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sede` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jugadores` int(11) NOT NULL,
  `id_entrenador` int(11) NOT NULL,
  `chat` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`id`, `nombre`, `instagram`, `email`, `sede`, `jugadores`, `id_entrenador`, `chat`) VALUES
(1, 'Just Voley AFADE', 'justvoleycv', 'justvoleycv@gmail.com', 'Divino Pastor', 0, 1, '-793336326'),
(2, 'Just Voley Femenino', 'justvoleyfem', 'justvoleyfem@gmail.com', 'Colegio San Jose', 0, 1, '-746464264'),
(16, 'Dark Souls', '', 'darsouls1@gmail.com', 'Churriana', 0, 24, '-746464264');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `events`
--

CREATE TABLE `events` (
  `evt_id` bigint(20) NOT NULL,
  `evt_start` datetime NOT NULL,
  `evt_end` datetime NOT NULL,
  `evt_text` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `detalles` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `evt_color` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `id_equipo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `events`
--

INSERT INTO `events` (`evt_id`, `evt_start`, `evt_end`, `evt_text`, `detalles`, `evt_color`, `id_equipo`) VALUES
(8, '2022-05-21 00:00:00', '2022-05-21 00:00:00', 'Entrena', '', '#e4edff', NULL),
(9, '2022-05-21 00:00:00', '2022-05-21 00:00:00', 'Entrenamiento', '', '#e4edff', NULL),
(12, '2022-05-04 19:00:00', '2022-05-04 22:00:00', 'fiesta', 'cumpleaños de daniel, todo el mundo esta invitado!!', '#e1e401', 1),
(15, '2022-05-21 19:00:00', '2022-05-21 21:00:00', 'Partido contra la coracha', 'Será un partido reñido y muy duro contra un rival muy duro y fuerte así que espero que vayáis muy concentrados y deis lo mejor de vosotros.', '#e1e401', 2),
(16, '2022-05-24 19:00:00', '2022-05-24 23:00:00', 'Entrenamiento', 'Entrenamiento físico para finalizar la temporada', '#e1e401', 1),
(17, '2022-05-25 08:00:00', '2022-05-27 14:00:00', 'Jugar', 'Jugar dark souls', '#e1e401', 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugador`
--

CREATE TABLE `jugador` (
  `id` int(11) NOT NULL,
  `nombre` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `foto` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'placeholder.png',
  `apellidos` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `password` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `dni` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `telefono` int(9) DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `nick` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `observaciones` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `lesiones` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `id_equipo` int(11) NOT NULL,
  `id_entrenador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `jugador`
--

INSERT INTO `jugador` (`id`, `nombre`, `foto`, `apellidos`, `password`, `dni`, `telefono`, `email`, `nick`, `observaciones`, `lesiones`, `id_equipo`, `id_entrenador`) VALUES
(19, 'Marina', '', 'Lopez Ortega', '51810b1881ddc40c934ca423d489bb8f3e17ac8df3ceb66c8a1a7bcdd1f55e9e46261774a9ed5e53c5bbf5e7d54b8fa93ef47c72c0e2587ab62455266e88ea89', '00292384P', 652147583, 'marinalo@gmail.com', 'Marina', 'Muchos años de experiencia, puede ayudar a aconsejar', 'Rodilla derecha dislocada, tiene para 3 meses de baja', 1, 1),
(20, 'Leticia', '', 'Garret Cabello', 'be0ca43afb4253331e4acb1b6e320ac90519154d6bb09e79bb9d5f66fe606e22ccb66bbd513fcbc91bb910eca0461176df230f2c7ada3ae3f22188de14db106b', '69047136D', 698741235, 'letig@hotmail.com', 'Leticia', NULL, '', 1, 1),
(21, 'Samara', '', 'Santiago Santiago', 'dc3e18b0775cb3a6fe6726e15a0f525a2b58c6f3d685a8988879e771963c761718b66bbd9aa3e515d83315ab33e91baad8717875eba1acc4e957df3fe0c2e163', '93420500C', 623589746, 's.santi@gmail.com', 'Sam', NULL, '', 1, 1),
(22, 'Lucia', '', 'Santiago Santiago', 'f3ce828c82cc1b80af867e8cc366a914efad3a5d381fd2f5140f6dcd5205060867368f5c2997e70abd2aeccef0483207e6485f06d47b6260cb5e93f8cafb8eb8', '97277859A', 658798412, 'l.santi@gmail.com', 'Lucia', 'Muy joven, jugando categorias por encima, pulir bien la tecnica y que no pille malos habitos', '', 1, 1),
(23, 'Sara', '', 'Fernandez Alvarez', '0b347e4bc2ddecacbd44b30c6622ab55ddad6ab467ef87b212fefc3785d57fb8d40d3708e7bc5ad5f3a7d331bf6b62a200f6ca5906a63a1900576fcaa25c2b4d', '35288999F', 632598741, 'sarafer@hotmail.com', 'Sara', 'Muy buena, viene de otro equipo bastante mejor', '', 1, 1),
(24, 'Rocio', '', 'Quintana Perez', '9a812c82fbb84836d67af1c55f91e20f9e542de391f6d6bfafe3d1c6c41cb0c7d7df12f92907e44aa6009a932e16d145c8814585895c617387a5f67d8894fd22', '26850654V', 639874562, 'rocisa@gmail.com', 'Quintana', NULL, '', 1, 1),
(25, 'Alejandro', '', 'Torres Vega', '8ee17c17d77b1589981039116159ab9ccc54ffae91423cbb0225cf290fffab59fc9096bf3c6c40f0b3388779dd4221c204980a5d9c6149bb5b81bab193fb3aa5', '09720321S', 639874521, 'aletorre@gmail.com', 'Ale T.', 'Zurdo, tener en cuenta al explicar la tecnica', '', 16, 24),
(26, 'Pablo', '', 'Guillermo Lopez', '30334f250db3a3b2802a11c200323c2da0cd8234faf695abbf5b8410cce2c89bb212a1cba1b2a821bdfcd4b0890ab7b9c26eda7228b63c708c1f2cf934210d5e', '53779485B', 698743216, 'p.guille@gmail.com', 'Pablillo', NULL, '', 16, 24),
(27, 'Alejandro', '', 'Naranja Garcia', 'f3f7eb1421dcfed9a2614712ec608f1b', '23151367G', 698741235, 'alen@hotmail.com', 'AleN', 'Muy buen saque', 'Hace poco se torci? el dedo y est? en per?odo de recuperaci?n', 16, 24),
(28, 'Juan Luis', 'pa_david.png', 'Miravista Velazquez', '6b1509537de3b29d2d75acae36f2add87a05b0cfcd3aea0fade5a1e253b8aab3a1189f41cdea3d5d4eef4c61345324d9f4aa02aeef35e02fe33ba34418019ddc', '72194770R', 632198743, 'juanlu@hotmail.es', 'Juanlu', NULL, '', 1, 1),
(29, 'Guillermo', '', 'Cobos Ruiz', '8b9069d2ca2764b676fdc42739ea29d8b0e5c6877105117acd1caaf75bff1f6ffbd4b7ed5141120e559e0015069a6b0d4b4ddc4a779d728678c66bfc96e0eb33', '64263605H', 666354789, 'guilleloco@gmail.com', 'Guille', 'Tiene buenos accesorios, por ejemplo sus rodilleras', '', 16, 24),
(30, 'Jose', '', 'Benitez Ruarte', '127cf71cc3a46d84b59744f66fae374690dbb79c09cb8bcb216afdba4439fdd7ef26d8a8cc629f97c296cf238e17e2bfaeedcda985811cf35eb6c156a30ba299', '08967092J', 621498756, 'jbenitez@gmail.com', 'Grillo', NULL, '', 16, 24),
(31, 'Christopher', 'placeholder.png', 'González Martín', '39b72800b1055ab9db839029f81f715427be929c019cda23632378e346d82dee73271f1fcc031c8a915aaaa747dee32a8676fccb6b76f29bed2b0251852521f4', '54371397H', 628785274, 'christophergm1999@gmail.com', '', 'Solo sabe ir a fe y tirar magia', '', 16, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administracion`
--
ALTER TABLE `administracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ejercicio`
--
ALTER TABLE `ejercicio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `entrenador`
--
ALTER TABLE `entrenador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_entrenador` (`id_entrenador`);

--
-- Indices de la tabla `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`evt_id`),
  ADD KEY `evt_start` (`evt_start`),
  ADD KEY `evt_end` (`evt_end`),
  ADD KEY `id_entrenador` (`id_equipo`);

--
-- Indices de la tabla `jugador`
--
ALTER TABLE `jugador`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_equipo` (`id_equipo`),
  ADD KEY `id_entrenador` (`id_entrenador`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administracion`
--
ALTER TABLE `administracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ejercicio`
--
ALTER TABLE `ejercicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `entrenador`
--
ALTER TABLE `entrenador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `events`
--
ALTER TABLE `events`
  MODIFY `evt_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `jugador`
--
ALTER TABLE `jugador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD CONSTRAINT `equipo_ibfk_1` FOREIGN KEY (`id_entrenador`) REFERENCES `entrenador` (`id`);

--
-- Filtros para la tabla `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`id_equipo`) REFERENCES `equipo` (`id`);

--
-- Filtros para la tabla `jugador`
--
ALTER TABLE `jugador`
  ADD CONSTRAINT `jugador_ibfk_1` FOREIGN KEY (`id_equipo`) REFERENCES `equipo` (`id`),
  ADD CONSTRAINT `jugador_ibfk_2` FOREIGN KEY (`id_entrenador`) REFERENCES `entrenador` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
