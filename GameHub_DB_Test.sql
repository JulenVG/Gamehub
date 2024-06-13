-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-04-2024 a las 14:20:02
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
-- Base de datos: `gamehub`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juegos`
--

CREATE TABLE `juegos` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `Descripcion` varchar(400) DEFAULT NULL,
  `Genero` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `juegos`
--

INSERT INTO `juegos` (`ID`, `Nombre`, `img`, `Descripcion`, `Genero`) VALUES
(4, 'DARK SOULS™: REMASTERED', 'DARKSOULSREMASTERED-portada.jpg', 'Entonces llegó el Fuego. Vuelve a disfrutar del aclamado juego que definió el género con el que empezó todo. Gracias a una magnífica remasterización, podrás regresar a Lordran con unos impresionantes detalles en alta definición y a 60 fps.', 'Rol'),
(5, 'DARK SOULS™ II: Scholar of the First Sin', 'DARKSOULSIIScholaroftheFirstSin-portada.jpg', 'DARK SOULS™ II: Scholar of the First Sin lleva la característica oscuridad de la franquicia y su apasionante jugabilidad a un nuevo nivel. Únete al oscuro viaje y experimenta los sobrecogedores encuentros con enemigos, los peligros diabólicos y los desafíos implacables.', 'Rol'),
(6, 'DARK SOULS™ III', 'DARKSOULSIII-portada.jpg', 'Dark Souls continúa redefiniendo los límites con el nuevo y ambicioso capítulo de esta serie revolucionaria, tan aclamada por la crítica. ¡Prepárate para sumergirte en la oscuridad!', 'Rol'),
(17, 'The Binding of Isaac: Rebirth', 'TheBindingofIsaacRebirth-portada.jpg', 'The Binding of Isaac: Rebirth es un shooter de acción RPG generado aleatoriamente con fuertes elementos Rogue-like. Siguiendo a Isaac en su viaje, los jugadores encontrarán tesoros extraños que cambian la forma de Isaac, dándole habilidades sobrehumanas y permitiéndole luchar contra hordas de criaturas misteriosas, descubrir secretos y abrirse camino hacia la seguridad.', 'Acción'),
(23, 'Sekiro™: Shadows Die Twice - GOTY Edition', 'SekiroShadowsDieTwiceGOTYEdition-portada.jpg', 'Juego del año - The Game Awards 2019 Mejor juego de acción de 2019 - IGN Traza tu propio camino hacia la venganza en la galardonada aventura de FromSoftware, creadores de Bloodborne y la saga Dark Souls. Véngate. Restituye tu honor. Mata con ingenio.', 'Acción'),
(24, 'Bloodborne™', 'Bloodborne-portada.jpg', 'Da caza a tus pesadillas Un viajero solitario. Un pueblo maldito. Un misterio letal que devora todo lo que toca. Enfréntate a tus miedos y adéntrate en la ciudad en ruinas de Yharnam, un lugar abandonado asolado por una terrible enfermedad que lo consume todo. Examina sus sombras más oscuras, lucha por tu vida con armas de filo y de fuego, y descubre secretos que harán que se te hiele la sangre...', 'Rol'),
(25, 'Outer Wilds', 'OuterWilds-portada.jpg', 'Outer Wilds, nombrado juego del año 2019 por Giant Bomb, Polygon, Eurogamer y The Guardian, es un galardonado título de mundo abierto, que se desarrolla en un enigmático sistema solar confinado a un bucle temporal infinito.', 'Aventura'),
(30, 'EA SPORTS FC™ 24', 'EASPORTSFC24-portada.jpg', 'EA SPORTS FC™ 24 te da la bienvenida a The World\'s Game: la experiencia futbolística más fiel hasta la fecha con HyperMotionV, PlayStyles optimizado por Opta y el motor mejorado de Frostbite™.', 'Deporte'),
(31, 'ELDEN RING', 'ELDENRING-portada.png', 'EL NUEVO JUEGO DE ROL Y ACCIÓN DE AMBIENTACIÓN FANTÁSTICA. Álzate, Sinluz, y que la gracia te guíe para abrazar el poder del Círculo de Elden y encumbrarte como señor del Círculo en las Tierras Intermedias.', 'Rol'),
(32, '(the) Gnorp Apologue', 'theGnorpApologue-portada.png', '(the) Gnorp Apologue es el viaje de los gnorps mientras los guías hacia su objetivo de acumulación de riqueza excesivamente deliciosa.', 'Estrategia'),
(33, 'Fortnite', 'Fortnite-portada.png', 'Crea, juega y combate con amigos de forma gratuita en Fortnite. Consigue ser el último jugador en pie en Battle Royale y Cero construcción, disfruta de conciertos y eventos en directo, o descubre experiencias nuevas entre más de un millón de juegos diseñados por creadores: carreras, parkour, supervivencia zombi y mucho más. Cada isla de Fortnite tiene una calificación por edades individual para qu', 'Disparos'),
(34, 'The Legend Of Zelda: Breath Of The Wild', 'TheLegendOfZeldaBreathOfTheWild-portada.png', 'La leyenda de Zelda aventura con un estilo al aire libre que rompe las fronteras al tiempo que respeta los orígenes de la aclamada serie', 'Rol'),
(35, 'Atomic Heart', 'AtomicHeart-portada.png', 'Ten encuentros explosivos en un delirante y sublime mundo utópico. Adapta tu estilo de combate a cada rival, aprovecha el entorno y mejora el equipamiento para cumplir la misión. El precio de averiguar la verdad tendrás que pagarlo con sangre.', 'Disparos'),
(36, 'Assassin\'s Creed Mirage', 'AssassinsCreedMirage-portada.png', 'Vive la historia de Basim, un astuto ladrón callejero que busca respuestas y justicia mientras recorre las bulliciosas calles del Bagdad del siglo IX. Conviértete en un Maestro Asesino letal y cambia su destino de una forma que nunca habría imaginado.', 'Acción'),
(37, 'Fallout: New Vegas', 'FalloutNewVegas-portada.png', 'Bienvenido a Las Vegas. New Vegas. ¡Disfruta de tu estancia!', 'Rol');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(11) NOT NULL,
  `Usuario` varchar(255) NOT NULL,
  `Sexo` varchar(255) DEFAULT NULL,
  `Nacimiento` date DEFAULT NULL,
  `Contra` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID`, `Usuario`, `Sexo`, `Nacimiento`, `Contra`, `Email`) VALUES
(1, 'Forerdow', 'hombre', '1998-08-22', '1234', 'julen817@gmail.com'),
(24, 'Edmundo Valdés', 'hombre', '2024-03-03', '12334', 'julenhearthstone23@gmail.com'),
(25, 'Francisco', 'hombre', '2024-03-03', '1234554', 'julen718@gmail.com'),
(26, 'Patata', 'hombre', '1998-01-01', '6565', 'patata@gmail.com'),
(27, 'Xuante', 'ninguno', '2024-02-02', 'àsta', 'gozilla@gmail.com'),
(28, 'Kame', 'mujer', '1997-08-03', '1234', '11nanalove11@gmail.com'),
(29, 'CarlosQS', 'hombre', '1998-02-17', '1998', 'carlosqs73@gmail.com'),
(30, 'Danas24', 'ninguno', '1998-06-01', '1234', 'danitas@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_juegos`
--

CREATE TABLE `usuarios_juegos` (
  `UsuariosID` int(11) NOT NULL,
  `JuegosID` int(11) NOT NULL,
  `Estado` varchar(255) DEFAULT NULL,
  `Plataforma` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuarios_juegos`
--

INSERT INTO `usuarios_juegos` (`UsuariosID`, `JuegosID`, `Estado`, `Plataforma`) VALUES
(1, 4, 'Completado', 'Steam'),
(1, 5, 'Completado', 'Steam'),
(1, 6, 'Completado', 'Steam'),
(1, 23, 'Completado', 'Steam'),
(1, 24, 'Intención de jugar', ' '),
(1, 25, 'Completado', 'Steam'),
(1, 31, 'Completado', 'Steam'),
(1, 32, 'Actualmente jugando', ' '),
(1, 34, 'Completado', 'Físico'),
(1, 35, 'Abandonado', 'Xbox Store PC'),
(24, 4, 'Completado', 'Físico'),
(28, 4, 'Completado', 'Steam'),
(28, 5, 'Abandonado', 'Epic Games'),
(29, 4, 'Completado', 'Steam'),
(29, 5, 'Abandonado', 'Físico'),
(29, 6, 'Completado', 'Steam'),
(29, 23, 'Completado', 'Steam'),
(29, 25, 'Completado', 'Físico'),
(29, 30, 'Actualmente jugando', 'Origin'),
(29, 31, 'Completado', 'Steam'),
(29, 32, 'Actualmente jugando', 'Steam'),
(29, 33, 'Actualmente jugando', 'Epic Games'),
(29, 35, 'Abandonado', 'Epic Games'),
(29, 36, 'Intención de jugar', 'Steam'),
(30, 6, 'Completado', 'Steam'),
(30, 25, 'Completado', 'Steam');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoraciones`
--

CREATE TABLE `valoraciones` (
  `UsuariosID` int(11) NOT NULL,
  `JuegosID` int(11) NOT NULL,
  `Nota` int(11) DEFAULT NULL,
  `Comentario` varchar(255) DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `valoraciones`
--

INSERT INTO `valoraciones` (`UsuariosID`, `JuegosID`, `Nota`, `Comentario`) VALUES
(1, 4, 10, 'Entrañable y único'),
(1, 5, 7, 'Se nota la falta del toque de Miyazaki'),
(1, 6, 10, 'Mejora todos los aspectos de la primera parte'),
(1, 23, 8, 'Gran reformulación de la saga'),
(1, 24, NULL, ''),
(1, 25, 10, 'Único'),
(1, 31, 10, ''),
(1, 32, NULL, ''),
(1, 34, 10, 'El mejor mundo abierto'),
(1, 35, 2, 'Demasiadas decisiones gravemente malas'),
(24, 4, 10, 'El origen'),
(28, 4, 8, 'Una autentico clasico'),
(28, 5, 2, 'El peor de la saga'),
(29, 4, 8, 'Una versión mejorada de Demon Souls'),
(29, 5, 6, 'Buen juego, mal Dark Souls'),
(29, 6, 8, 'Un gran cierre a una gran saga'),
(29, 23, 8, 'Un toque diferente a la fórmula Souls'),
(29, 25, 8, 'Único y emotivo '),
(29, 30, 5, 'Demasiado P2W'),
(29, 31, 9, 'El mejor juego de Miyazaki'),
(29, 32, 7, 'Vicio puro.'),
(29, 33, 7, 'Divertido y entretenido'),
(29, 35, 3, 'Absoluto aburrimiento'),
(30, 6, 9, 'Juegon'),
(30, 25, 10, 'Una experiencia profunda que te hace reflexionar');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `juegos`
--
ALTER TABLE `juegos`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`),
  ADD UNIQUE KEY `Nick` (`Usuario`),
  ADD UNIQUE KEY `unique_email` (`Email`);

--
-- Indices de la tabla `usuarios_juegos`
--
ALTER TABLE `usuarios_juegos`
  ADD PRIMARY KEY (`UsuariosID`,`JuegosID`),
  ADD KEY `JuegosID` (`JuegosID`);

--
-- Indices de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  ADD PRIMARY KEY (`UsuariosID`,`JuegosID`),
  ADD KEY `JuegosID` (`JuegosID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `juegos`
--
ALTER TABLE `juegos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuarios_juegos`
--
ALTER TABLE `usuarios_juegos`
  ADD CONSTRAINT `usuarios_juegos_ibfk_1` FOREIGN KEY (`UsuariosID`) REFERENCES `usuarios` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `usuarios_juegos_ibfk_2` FOREIGN KEY (`JuegosID`) REFERENCES `juegos` (`ID`) ON DELETE CASCADE;

--
-- Filtros para la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  ADD CONSTRAINT `valoraciones_ibfk_1` FOREIGN KEY (`UsuariosID`) REFERENCES `usuarios` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `valoraciones_ibfk_2` FOREIGN KEY (`JuegosID`) REFERENCES `juegos` (`ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
