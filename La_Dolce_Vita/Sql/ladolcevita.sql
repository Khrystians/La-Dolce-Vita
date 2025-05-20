-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-05-2025 a las 15:08:14
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
-- Base de datos: `ladolcevita`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` tinyint(3) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre`) VALUES
(1, 'Entrantes'),
(2, 'Pasta'),
(3, 'Pizza'),
(4, 'Antipasta'),
(5, 'Bebidas'),
(6, 'Postre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallepedido`
--

CREATE TABLE `detallepedido` (
  `id_detalle` tinyint(3) UNSIGNED NOT NULL,
  `id_pedido` tinyint(3) UNSIGNED NOT NULL,
  `id_plato` tinyint(3) UNSIGNED NOT NULL,
  `cantidad` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ganancia`
--

CREATE TABLE `ganancia` (
  `id_ganancia` tinyint(3) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `ganancia_total` decimal(10,2) NOT NULL,
  `id_categoria` tinyint(3) UNSIGNED NOT NULL,
  `numero_mesa` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` tinyint(3) UNSIGNED NOT NULL,
  `nombre_cliente` varchar(100) NOT NULL,
  `numero_mesa` tinyint(3) UNSIGNED NOT NULL,
  `estado` varchar(50) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plato`
--

CREATE TABLE `plato` (
  `id_plato` tinyint(3) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `id_categoria` tinyint(3) UNSIGNED NOT NULL,
  `alergenos` text DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `plato`
--

INSERT INTO `plato` (`id_plato`, `nombre`, `descripcion`, `precio`, `id_categoria`, `alergenos`, `imagen`) VALUES
(61, 'Bruschetta', 'Pan tostado con tomate, ajo y albahaca', 5.50, 1, 'Gluten', 'bruschetta.jpg'),
(62, 'Caprese', 'Ensalada de tomate, mozzarella y albahaca', 7.00, 1, 'Lácteos', 'caprese.jpg'),
(63, 'Arancini', 'Bolas de arroz rellenas de queso', 6.50, 1, 'Gluten, Lácteos', 'arancini.jpg'),
(64, 'Carpaccio', 'Carne de res finamente cortada con rúcula y parmesano', 9.00, 1, 'Lácteos', 'carpaccio.jpg'),
(65, 'Antipasto', 'Selección de embutidos y quesos', 12.00, 1, 'Lácteos', 'antipasto.jpg'),
(66, 'Focaccia', 'Pan italiano con romero y aceite de oliva', 4.50, 1, 'Gluten', 'focaccia.jpg'),
(67, 'Olivas', 'Aceitunas marinadas', 3.00, 1, 'Ninguno', 'olivas.jpg'),
(68, 'Calamares', 'Calamares fritos con salsa de limón', 8.00, 1, 'Gluten', 'calamares.jpg'),
(69, 'Prosciutto e Melone', 'Jamón serrano con melón', 10.00, 1, 'Ninguno', 'prosciutto_e_melone.jpg'),
(70, 'Mozzarella Sticks', 'Palitos de mozzarella fritos', 6.00, 1, 'Gluten, Lácteos', 'mozzarella_sticks.jpg'),
(71, 'Spaghetti Carbonara', 'Spaghetti con salsa de huevo, queso y panceta', 12.00, 2, 'Gluten, Lácteos', 'spaghetti_carbonara.jpg'),
(72, 'Lasagna', 'Lasagna de carne con salsa de tomate y queso', 14.00, 2, 'Gluten, Lácteos', 'lasagna.jpg'),
(73, 'Penne Arrabbiata', 'Penne con salsa de tomate picante', 11.00, 2, 'Gluten', 'penne_arrabbiata.jpg'),
(74, 'Fettuccine Alfredo', 'Fettuccine con salsa de crema y queso', 13.00, 2, 'Gluten, Lácteos', 'fettuccine_alfredo.jpg'),
(75, 'Ravioli', 'Ravioli rellenos de espinacas y ricotta', 15.00, 2, 'Gluten, Lácteos', 'ravioli.jpg'),
(76, 'Gnocchi', 'Gnocchi de patata con salsa de tomate', 10.00, 2, 'Gluten', 'gnocchi.jpg'),
(77, 'Tagliatelle Bolognese', 'Tagliatelle con salsa de carne', 12.50, 2, 'Gluten', 'tagliatelle_bolognese.jpg'),
(78, 'Tortellini', 'Tortellini rellenos de carne con salsa de crema', 14.00, 2, 'Gluten, Lácteos', 'tortellini.jpg'),
(79, 'Pasta Primavera', 'Pasta con verduras frescas', 11.50, 2, 'Gluten', 'pasta_primavera.jpg'),
(80, 'Pasta Puttanesca', 'Pasta con salsa de tomate, aceitunas y alcaparras', 12.00, 2, 'Gluten', 'pasta_puttanesca.jpg'),
(81, 'Margherita', 'Pizza con tomate, mozzarella y albahaca', 10.00, 3, 'Gluten, Lácteos', 'margherita.jpg'),
(82, 'Pepperoni', 'Pizza con tomate, mozzarella y pepperoni', 12.00, 3, 'Gluten, Lácteos', 'pepperoni.jpg'),
(83, 'Quattro Formaggi', 'Pizza con cuatro tipos de queso', 14.00, 3, 'Gluten, Lácteos', 'quattro_formaggi.jpg'),
(84, 'Vegetariana', 'Pizza con verduras frescas', 11.00, 3, 'Gluten, Lácteos', 'vegetariana.jpg'),
(85, 'Hawaiana', 'Pizza con jamón y piña', 12.00, 3, 'Gluten, Lácteos', 'hawaiana.jpg'),
(86, 'Diavola', 'Pizza con salami picante', 13.00, 3, 'Gluten, Lácteos', 'diavola.jpg'),
(87, 'Capricciosa', 'Pizza con jamón, champiñones y alcachofas', 13.50, 3, 'Gluten, Lácteos', 'capricciosa.jpg'),
(88, 'Prosciutto', 'Pizza con jamón serrano', 14.00, 3, 'Gluten, Lácteos', 'prosciutto.jpg'),
(89, 'Funghi', 'Pizza con champiñones', 11.50, 3, 'Gluten, Lácteos', 'funghi.jpg'),
(90, 'Calzone', 'Pizza rellena de queso y jamón', 15.00, 3, 'Gluten, Lácteos', 'calzone.jpg'),
(91, 'Prosciutto e Melone', 'Jamón serrano con melón', 10.00, 4, 'Ninguno', 'prosciutto_e_melone.jpg'),
(92, 'Olivas', 'Aceitunas marinadas', 3.00, 4, 'Ninguno', 'olivas.jpg'),
(93, 'Focaccia', 'Pan italiano con romero y aceite de oliva', 4.50, 4, 'Gluten', 'focaccia.jpg'),
(94, 'Antipasto', 'Selección de embutidos y quesos', 12.00, 4, 'Lácteos', 'antipasto.jpg'),
(95, 'Carpaccio', 'Carne de res finamente cortada con rúcula y parmesano', 9.00, 4, 'Lácteos', 'carpaccio.jpg'),
(96, 'Arancini', 'Bolas de arroz rellenas de queso', 6.50, 4, 'Gluten, Lácteos', 'arancini.jpg'),
(97, 'Caprese', 'Ensalada de tomate, mozzarella y albahaca', 7.00, 4, 'Lácteos', 'caprese.jpg'),
(98, 'Bruschetta', 'Pan tostado con tomate, ajo y albahaca', 5.50, 4, 'Gluten', 'bruschetta.jpg'),
(99, 'Calamares', 'Calamares fritos con salsa de limón', 8.00, 4, 'Gluten', 'calamares.jpg'),
(100, 'Mozzarella Sticks', 'Palitos de mozzarella fritos', 6.00, 4, 'Gluten, Lácteos', 'mozzarella_sticks.jpg'),
(101, 'Agua Mineral', 'Agua mineral natural', 2.00, 5, 'Ninguno', 'agua_mineral.jpg'),
(102, 'Refresco', 'Refresco de cola', 2.50, 5, 'Ninguno', 'refresco.jpg'),
(103, 'Cerveza', 'Cerveza artesanal', 4.00, 5, 'Gluten', 'cerveza.jpg'),
(104, 'Vino Tinto', 'Copa de vino tinto', 5.00, 5, 'Sulfitos', 'vino_tinto.jpg'),
(105, 'Vino Blanco', 'Copa de vino blanco', 5.00, 5, 'Sulfitos', 'vino_blanco.jpg'),
(106, 'Limonada', 'Limonada casera', 3.00, 5, 'Ninguno', 'limonada.jpg'),
(107, 'Té Helado', 'Té helado con limón', 3.50, 5, 'Ninguno', 'te_helado.jpg'),
(108, 'Café Espresso', 'Café espresso', 2.50, 5, 'Ninguno', 'cafe_espresso.jpg'),
(109, 'Cappuccino', 'Café con leche y espuma', 3.00, 5, 'Lácteos', 'cappuccino.jpg'),
(110, 'Chocolate Caliente', 'Chocolate caliente con crema', 3.50, 5, 'Lácteos', 'chocolate_caliente.jpg'),
(111, 'Tiramisú', 'Postre italiano con café y mascarpone', 6.00, 6, 'Gluten, Lácteos', 'tiramisu.jpg'),
(112, 'Panna Cotta', 'Postre de crema cocida con frutas', 5.50, 6, 'Lácteos', 'panna_cotta.jpg'),
(113, 'Cannoli', 'Dulce relleno de ricotta', 4.50, 6, 'Gluten, Lácteos', 'cannoli.jpg'),
(114, 'Gelato', 'Helado italiano', 4.00, 6, 'Lácteos', 'gelato.jpg'),
(115, 'Profiteroles', 'Bolas de masa rellenas de crema', 5.00, 6, 'Gluten, Lácteos', 'profiteroles.jpg'),
(116, 'Tarta de Queso', 'Tarta de queso con base de galleta', 5.50, 6, 'Gluten, Lácteos', 'tarta_de_queso.jpg'),
(117, 'Sfogliatella', 'Hojaldre relleno de ricotta', 4.50, 6, 'Gluten, Lácteos', 'sfogliatella.jpg'),
(118, 'Zabaglione', 'Crema de yema de huevo y vino', 5.00, 6, 'Lácteos', 'zabaglione.jpg'),
(119, 'Cassata', 'Pastel de helado y frutas confitadas', 6.00, 6, 'Lácteos', 'cassata.jpg'),
(120, 'Semifreddo', 'Postre helado con crema', 5.50, 6, 'Lácteos', 'semifreddo.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_plato` (`id_plato`);

--
-- Indices de la tabla `ganancia`
--
ALTER TABLE `ganancia`
  ADD PRIMARY KEY (`id_ganancia`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`);

--
-- Indices de la tabla `plato`
--
ALTER TABLE `plato`
  ADD PRIMARY KEY (`id_plato`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  MODIFY `id_detalle` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ganancia`
--
ALTER TABLE `ganancia`
  MODIFY `id_ganancia` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `plato`
--
ALTER TABLE `plato`
  MODIFY `id_plato` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD CONSTRAINT `detallepedido_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`),
  ADD CONSTRAINT `detallepedido_ibfk_2` FOREIGN KEY (`id_plato`) REFERENCES `plato` (`id_plato`);

--
-- Filtros para la tabla `ganancia`
--
ALTER TABLE `ganancia`
  ADD CONSTRAINT `ganancia_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`);

--
-- Filtros para la tabla `plato`
--
ALTER TABLE `plato`
  ADD CONSTRAINT `plato_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
