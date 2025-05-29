-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-05-2025 a las 22:53:12
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
-- Base de datos: `la_dolce_vita`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `allergens`
--

CREATE TABLE `allergens` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `allergens`
--

INSERT INTO `allergens` (`id`, `name`) VALUES
(6, 'Frutos secos'),
(1, 'Gluten'),
(5, 'Huevo'),
(2, 'Lácteos'),
(3, 'Mariscos'),
(4, 'Pescado'),
(7, 'Sulfitos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(4, 'Antipasta'),
(5, 'Bebidas'),
(1, 'Entradas'),
(2, 'Pasta'),
(3, 'Pizzas'),
(6, 'Postres');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dishes`
--

CREATE TABLE `dishes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` text DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dishes`
--

INSERT INTO `dishes` (`id`, `name`, `description`, `price`, `image_url`, `category_id`, `is_active`) VALUES
(1, 'Bruschetta', 'Pan tostado con tomate, ajo y albahaca', 4.50, 'img/bruschetta.jpg', 1, 0),
(2, 'Caprese', 'Mozzarella fresca con tomate y albahaca', 6.00, 'img/caprese.jpg', 1, 1),
(3, 'Carpaccio de res', 'Finas láminas de carne con parmesano y rúcula', 8.00, 'img/carpaccio.jpg', 1, 1),
(4, 'Calamares fritos', 'Aros de calamar rebozados y fritos', 7.50, 'img/calamares.jpg', 1, 1),
(5, 'Pan de ajo', 'Pan con mantequilla de ajo', 3.00, 'img/pan_ajo.jpg', 1, 1),
(6, 'Ensalada César', 'Lechuga, croutons, parmesano y salsa césar', 7.00, 'img/cesar.jpg', 1, 0),
(7, 'Arancini', 'Bolas de arroz rellenas de queso y fritas', 6.50, 'img/arancini.jpg', 1, 1),
(8, 'Provolone al horno', 'Queso provolone derretido con especias', 7.00, 'img/provolone.jpg', 1, 1),
(9, 'Antipasto misto', 'Embutidos italianos, quesos, aceitunas y pan', 9.00, 'img/antipasto.jpg', 1, 1),
(10, 'Crostini de setas', 'Pan tostado con crema de setas', 6.00, 'img/crostini.jpg', 1, 1),
(11, 'Spaghetti alla Carbonara', 'Spaghetti con panceta, huevo y queso parmesano', 9.50, 'img/carbonara.jpg', 2, 1),
(12, 'Fettuccine Alfredo', 'Fettuccine en salsa cremosa de parmesano y mantequilla', 10.00, 'img/alfredo.jpg', 2, 1),
(13, 'Lasagna alla Bolognese', 'Capas de pasta con carne, tomate y bechamel', 11.00, 'img/lasagna.jpg', 2, 1),
(14, 'Ravioli di Ricotta e Spinaci', 'Pasta rellena de ricotta y espinacas con mantequilla', 10.50, 'img/ravioli.jpg', 2, 0),
(15, 'Gnocchi al Pesto', 'Gnocchi de papa con salsa pesto', 9.00, 'img/gnocchi.jpg', 2, 1),
(16, 'Penne all\'Arrabbiata', 'Penne con salsa de tomate picante', 8.50, 'img/arrabbiata.jpg', 2, 0),
(17, 'Tagliatelle ai Funghi Porcini', 'Tagliatelle con salsa de setas porcini', 10.00, 'img/funghi.jpg', 2, 1),
(18, 'Tortellini alla Panna', 'Tortellini con crema de leche y jamón', 10.50, 'img/tortellini.jpg', 2, 1),
(19, 'Spaghetti alle Vongole', 'Spaghetti con almejas y vino blanco', 12.00, 'img/vongole.jpg', 2, 1),
(20, 'Orecchiette con Broccoli', 'Orecchiette salteada con brócoli y ajo', 9.00, 'img/orecchiette.jpg', 2, 1),
(21, 'Margherita', 'Salsa de tomate, mozzarella y albahaca', 8.00, 'img/margherita.jpg', 3, 1),
(22, 'Pepperoni', 'Salsa de tomate, mozzarella y rodajas de pepperoni', 9.00, 'img/pepperoni.jpg', 3, 1),
(23, 'Quattro Formaggi', 'Mezcla de cuatro quesos italianos', 10.00, 'img/quattro_formaggi.jpg', 3, 0),
(24, 'Prosciutto e Funghi', 'Jamón curado, champiñones y mozzarella', 9.50, 'img/prosciutto_funghi.jpg', 3, 1),
(25, 'Capricciosa', 'Jamón, alcachofas, aceitunas y champiñones', 10.00, 'img/capricciosa.jpg', 3, 1),
(26, 'Diavola', 'Salami picante, mozzarella y salsa de tomate', 9.50, 'img/diavola.jpg', 3, 0),
(27, 'Vegetariana', 'Verduras mixtas: pimientos, berenjenas, calabacín', 9.00, 'img/vegetariana.jpg', 3, 1),
(28, 'Hawaiana', 'Jamón cocido y piña', 9.50, 'img/hawaiana.jpg', 3, 1),
(29, 'Frutti di Mare', 'Pizza de mariscos con ajo y perejil', 11.00, 'img/frutti_di_mare.jpg', 3, 1),
(30, 'Calzone Classico', 'Pizza cerrada rellena de jamón y queso', 10.50, 'img/calzone.jpg', 3, 1),
(31, 'Tiramisu', 'Postre clásico italiano con café, mascarpone y cacao', 6.50, 'img/tiramisu.jpg', 6, 1),
(32, 'Panna Cotta', 'Flan de nata italiana con coulis de frutos rojos', 5.50, 'img/pannacotta.jpg', 6, 0),
(33, 'Cannoli Siciliani', 'Rollo crujiente relleno de ricotta endulzada', 6.00, 'img/cannoli.jpg', 6, 1),
(34, 'Gelato al Cioccolato', 'Helado artesanal de chocolate', 4.50, 'img/gelato.jpg', 6, 0),
(35, 'Semifreddo al Limone', 'Postre frío de limón con textura cremosa', 5.00, 'img/semifreddo.jpg', 6, 1),
(36, 'Zabaione', 'Crema batida de vino Marsala y yemas', 5.50, 'img/zabaione.jpg', 6, 1),
(37, 'Crostata di Frutta', 'Tarta con crema pastelera y frutas frescas', 6.00, 'img/crostata.jpg', 6, 1),
(38, 'Affogato al Caffè', 'Helado de vainilla con espresso caliente', 4.50, 'img/affogato.jpg', 6, 1),
(39, 'Budino al Caramello', 'Flan suave con caramelo', 5.50, 'img/budino.jpg', 6, 1),
(40, 'Biscotti alle Mandorle', 'Galletas de almendra crujientes', 4.00, 'img/biscotti.jpg', 6, 1),
(41, 'Bruschetta al Pomodoro', 'Pan tostado con tomate, ajo y albahaca', 5.00, 'img/bruschetta.jpg', 4, 1),
(42, 'Carpaccio di Manzo', 'Finas láminas de ternera cruda con parmesano y rúcula', 8.50, 'img/carpaccio.jpg', 4, 0),
(43, 'Prosciutto e Melone', 'Jamón curado italiano servido con melón dulce', 7.00, 'img/prosciutto_melone.jpg', 4, 0),
(44, 'Insalata Caprese', 'Mozzarella fresca, tomate y albahaca con aceite de oliva', 6.50, 'img/caprese.jpg', 4, 1),
(45, 'Frittura di Calamari', 'Calamares fritos con limón', 9.00, 'img/frittura.jpg', 4, 1),
(46, 'Olive All’ascolana', 'Aceitunas rellenas de carne empanizadas y fritas', 6.50, 'img/olive.jpg', 4, 1),
(47, 'Arancini Siciliani', 'Bolas de arroz rellenas de queso y carne, empanizadas y fritas', 7.00, 'img/arancini.jpg', 4, 1),
(48, 'Crostini ai Funghi', 'Pan tostado con crema de setas y perejil', 6.00, 'img/crostini.jpg', 4, 1),
(49, 'Polpette di Melanzane', 'Albóndigas de berenjena con queso pecorino', 6.50, 'img/polpette.jpg', 4, 0),
(50, 'Insalata di Mare', 'Ensalada fría de mariscos con vinagreta ligera', 9.00, 'img/insalata_mare.jpg', 4, 1),
(51, 'Agua Mineral', 'Botella de agua con o sin gas', 1.50, 'img/agua.jpg', 5, 1),
(52, 'Limonata Italiana', 'Refresco casero de limón', 2.50, 'img/limonata.jpg', 5, 1),
(53, 'Chinotto', 'Refresco amargo italiano', 2.80, 'img/chinotto.jpg', 5, 0),
(54, 'San Pellegrino Naranja', 'Refresco espumoso de naranja', 2.80, 'img/pellegrino.jpg', 5, 1),
(55, 'Espresso', 'Café italiano corto', 1.80, 'img/espresso.jpg', 5, 0),
(56, 'Cappuccino', 'Café con leche y espuma', 2.20, 'img/cappuccino.jpg', 5, 0),
(57, 'Vino Tinto della Casa', 'Copa de vino tinto italiano', 3.50, 'img/vino_tinto.jpg', 5, 1),
(58, 'Vino Blanco della Casa', 'Copa de vino blanco italiano', 3.50, 'img/vino_blanco.jpg', 5, 1),
(59, 'Spritz Aperol', 'Aperitivo de Aperol con prosecco y soda', 4.50, 'img/spritz.jpg', 5, 1),
(60, 'Cerveza Italiana', 'Botella de birra Moretti o Peroni', 3.20, 'img/cerveza.jpg', 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dish_allergens`
--

CREATE TABLE `dish_allergens` (
  `dish_id` int(11) NOT NULL,
  `allergen_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dish_allergens`
--

INSERT INTO `dish_allergens` (`dish_id`, `allergen_id`) VALUES
(1, 1),
(2, 2),
(3, 2),
(4, 1),
(4, 3),
(5, 1),
(5, 2),
(6, 1),
(6, 2),
(6, 4),
(6, 5),
(7, 1),
(7, 2),
(7, 5),
(8, 2),
(9, 1),
(9, 2),
(10, 1),
(10, 2),
(11, 1),
(11, 2),
(11, 5),
(12, 1),
(12, 2),
(13, 1),
(13, 2),
(13, 5),
(14, 1),
(14, 2),
(14, 5),
(15, 2),
(15, 6),
(16, 1),
(17, 1),
(17, 2),
(18, 1),
(18, 2),
(18, 5),
(19, 1),
(19, 3),
(20, 1),
(21, 1),
(21, 2),
(22, 1),
(22, 2),
(23, 1),
(23, 2),
(24, 1),
(24, 2),
(25, 1),
(25, 2),
(26, 1),
(26, 2),
(27, 1),
(27, 2),
(28, 1),
(28, 2),
(29, 1),
(29, 3),
(30, 1),
(30, 2),
(30, 5),
(31, 1),
(31, 2),
(31, 5),
(32, 2),
(33, 1),
(33, 2),
(34, 2),
(35, 2),
(35, 5),
(36, 2),
(36, 5),
(37, 1),
(37, 2),
(37, 5),
(38, 2),
(39, 2),
(39, 5),
(40, 1),
(40, 5),
(40, 6),
(41, 1),
(42, 2),
(44, 2),
(45, 1),
(45, 3),
(46, 1),
(46, 5),
(47, 1),
(47, 2),
(47, 5),
(48, 1),
(48, 2),
(49, 2),
(49, 5),
(50, 3),
(56, 2),
(57, 7),
(58, 7),
(59, 7),
(60, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `rol` varchar(50) NOT NULL,
  `descripcion_rol` text DEFAULT NULL,
  `horario` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `correo_electronico` varchar(100) DEFAULT NULL,
  `foto` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`id`, `nombre`, `rol`, `descripcion_rol`, `horario`, `telefono`, `correo_electronico`, `foto`) VALUES
(1, 'Giovanni Rossi', 'Cocinero', 'Encargado de la preparación de platos principales y control de calidad.', 'Lunes a Sábado, 10:00 - 18:00', '+34 612345678', 'giovanni@ladolcevita.com', 'giovanni.jpg'),
(2, 'Lucía Fernández', 'Mesera', 'Atención al cliente, toma de pedidos y entrega en mesa.', 'Lunes a Viernes, 12:00 - 20:00', '+34 698765432', 'lucia@ladolcevita.com', 'lucia.jpg'),
(3, 'Marco Bianchi', 'Administrador', 'Gestión de finanzas, supervisión general y modificaciones del menú.', 'Lunes a Viernes, 09:00 - 17:00', '+34 611223344', 'marco@ladolcevita.com', 'marco.jpg'),
(4, 'Sofía Martínez', 'Cocinera', 'Especialista en postres y platos fríos.', 'Martes a Domingo, 14:00 - 22:00', '+34 699112233', 'sofia@ladolcevita.com', 'sofia.jpg'),
(5, 'Carlos Romero', 'Ayudante de cocina', 'Apoyo en la preparación, limpieza y organización en cocina.', 'Lunes a Sábado, 09:00 - 17:00', '+34 677889900', 'carlos@ladolcevita.com', 'carlos.jpg'),
(6, 'Isabella Conti', 'Recepcionista', 'Recepción de clientes, asignación de mesas y gestión de reservas.', 'Lunes a Domingo, 11:00 - 19:00', '+34 688334455', 'isabella@ladolcevita.com', 'isabella.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_read` tinyint(1) DEFAULT 0,
  `mesa_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `notifications`
--

INSERT INTO `notifications` (`id`, `message`, `created_at`, `is_read`, `mesa_id`) VALUES
(1, 'Nuevo pedido recibido de la mesa 3', '2025-05-18 18:17:27', 0, 3),
(3, 'El pedido #1 ha sido entregado', '2025-05-18 18:17:27', 1, 1),
(5, 'El pedido #4 fue cancelado por el cliente', '2025-05-18 18:17:27', 1, 2),
(8, 'Mesa 7 ha realizado un nuevo pedido', '2025-05-18 18:17:27', 0, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `table_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` enum('pendiente','en cocina','entregado') NOT NULL DEFAULT 'pendiente',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `table_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(2, 9, 'Prueba1', 'en cocina', '2025-05-24 21:44:32', '2025-05-27 18:14:51'),
(3, 9, 'Prueba2', 'entregado', '2025-05-24 22:07:31', '2025-05-27 18:15:54'),
(16, 8, 'Nombre del pedido', 'en cocina', '2025-05-26 18:36:18', '2025-05-27 16:34:47'),
(18, 9, 'Nombre del pedido', 'entregado', '2025-05-26 21:18:04', '2025-05-26 21:18:28'),
(25, 2, 'Nombre del pedido', 'entregado', '2025-05-27 17:52:14', '2025-05-27 18:16:03'),
(26, 2, 'Nombre del pedido', 'pendiente', '2025-05-27 17:52:24', '2025-05-27 17:52:24'),
(27, 3, 'Prueba 3 | Mesa 3', 'pendiente', '2025-05-27 17:53:05', '2025-05-27 17:53:05'),
(28, 4, 'Prueba 4', 'en cocina', '2025-05-27 17:56:53', '2025-05-27 18:15:01'),
(29, 5, 'Pedido 5', 'pendiente', '2025-05-27 18:05:34', '2025-05-27 18:05:34'),
(30, 5, 'Nombre del pedido', 'entregado', '2025-05-27 18:05:41', '2025-05-27 18:16:08'),
(31, 6, 'Prueba 6', 'pendiente', '2025-05-27 18:09:39', '2025-05-27 18:09:39'),
(32, 7, 'Nombre del pedido', 'en cocina', '2025-05-27 18:09:59', '2025-05-27 18:15:08'),
(33, 8, 'Nombre del pedido', 'pendiente', '2025-05-27 18:10:21', '2025-05-27 18:10:21'),
(34, 10, 'Nombre del pedido', 'en cocina', '2025-05-27 18:14:10', '2025-05-27 18:15:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order_dishes`
--

CREATE TABLE `order_dishes` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `dish_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `order_dishes`
--

INSERT INTO `order_dishes` (`id`, `order_id`, `dish_id`, `quantity`) VALUES
(6, 2, 2, 1),
(7, 2, 44, 1),
(8, 2, 33, 1),
(9, 3, 12, 2),
(26, 16, 7, 2),
(27, 16, 4, 1),
(28, 16, 11, 1),
(29, 16, 22, 1),
(30, 16, 51, 1),
(31, 16, 60, 2),
(37, 18, 3, 1),
(38, 18, 21, 1),
(39, 18, 33, 1),
(67, 25, 33, 2),
(68, 25, 57, 3),
(69, 25, 29, 1),
(70, 25, 15, 1),
(71, 25, 18, 1),
(72, 25, 9, 1),
(73, 26, 46, 1),
(74, 27, 11, 1),
(75, 27, 17, 1),
(76, 27, 44, 1),
(77, 27, 54, 3),
(78, 28, 2, 1),
(79, 28, 3, 1),
(80, 28, 4, 1),
(81, 28, 33, 1),
(82, 28, 35, 1),
(83, 28, 37, 1),
(84, 29, 2, 1),
(85, 29, 3, 1),
(86, 29, 41, 4),
(87, 29, 11, 1),
(88, 29, 35, 1),
(89, 30, 3, 1),
(90, 30, 2, 1),
(91, 30, 4, 1),
(92, 30, 21, 1),
(93, 30, 22, 1),
(94, 30, 24, 1),
(95, 31, 33, 1),
(96, 31, 36, 1),
(97, 31, 22, 1),
(98, 31, 24, 1),
(99, 32, 4, 1),
(100, 32, 44, 1),
(101, 32, 11, 1),
(102, 32, 22, 1),
(103, 33, 2, 1),
(104, 33, 3, 1),
(105, 33, 7, 1),
(106, 33, 33, 1),
(107, 33, 21, 1),
(108, 34, 2, 1),
(109, 34, 11, 1),
(110, 34, 21, 1),
(111, 34, 41, 1),
(112, 34, 51, 4),
(113, 34, 31, 1),
(114, 34, 35, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `table_id` int(11) NOT NULL,
  `dish_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `sale_date` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sales`
--

INSERT INTO `sales` (`id`, `table_id`, `dish_id`, `quantity`, `price`, `sale_date`) VALUES
(1, 1, 2, 1, 6.00, '2025-05-27'),
(2, 1, 52, 1, 2.50, '2025-05-27'),
(3, 1, 54, 3, 2.80, '2025-05-27'),
(4, 1, 11, 1, 9.50, '2025-05-27'),
(5, 1, 11, 1, 9.50, '2025-05-27'),
(6, 1, 12, 1, 10.00, '2025-05-27'),
(7, 1, 17, 1, 10.00, '2025-05-27'),
(8, 1, 44, 1, 6.50, '2025-05-27'),
(9, 1, 21, 1, 8.00, '2025-05-27'),
(10, 1, 54, 3, 2.80, '2025-05-27'),
(11, 1, 58, 1, 3.50, '2025-05-27'),
(12, 1, 54, 1, 2.80, '2025-05-27'),
(13, 1, 51, 1, 1.50, '2025-05-27'),
(14, 1, 11, 1, 9.50, '2025-05-27'),
(15, 1, 22, 1, 9.00, '2025-05-27'),
(16, 1, 25, 1, 10.00, '2025-05-27'),
(17, 1, 35, 1, 5.00, '2025-05-27'),
(18, 1, 2, 1, 6.00, '2025-05-27'),
(19, 1, 3, 1, 8.00, '2025-05-27'),
(20, 1, 2, 1, 6.00, '2025-05-27'),
(21, 1, 12, 2, 10.00, '2025-05-27'),
(22, 1, 21, 1, 8.00, '2025-05-27'),
(23, 1, 58, 2, 3.50, '2025-05-27'),
(24, 1, 2, 1, 6.00, '2025-05-27'),
(25, 1, 52, 1, 2.50, '2025-05-27'),
(26, 1, 54, 3, 2.80, '2025-05-27'),
(27, 1, 11, 1, 9.50, '2025-05-27'),
(28, 1, 11, 1, 9.50, '2025-05-27'),
(29, 1, 12, 1, 10.00, '2025-05-27'),
(30, 1, 17, 1, 10.00, '2025-05-27'),
(31, 1, 44, 1, 6.50, '2025-05-27'),
(32, 1, 21, 1, 8.00, '2025-05-27'),
(33, 1, 54, 3, 2.80, '2025-05-27'),
(34, 1, 58, 1, 3.50, '2025-05-27'),
(35, 1, 54, 1, 2.80, '2025-05-27'),
(36, 1, 51, 1, 1.50, '2025-05-27'),
(37, 1, 11, 1, 9.50, '2025-05-27'),
(38, 1, 22, 1, 9.00, '2025-05-27'),
(39, 1, 25, 1, 10.00, '2025-05-27'),
(40, 1, 35, 1, 5.00, '2025-05-27'),
(41, 1, 2, 1, 6.00, '2025-05-27'),
(42, 1, 3, 1, 8.00, '2025-05-27'),
(43, 1, 2, 1, 6.00, '2025-05-27'),
(44, 1, 12, 2, 10.00, '2025-05-27'),
(45, 1, 21, 1, 8.00, '2025-05-27'),
(46, 1, 58, 2, 3.50, '2025-05-27'),
(47, 1, 2, 1, 6.00, '2025-05-27'),
(48, 1, 2, 1, 6.00, '2025-05-27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tables`
--

CREATE TABLE `tables` (
  `id` int(11) NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tables`
--

INSERT INTO `tables` (`id`, `number`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `allergens`
--
ALTER TABLE `allergens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `dishes`
--
ALTER TABLE `dishes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indices de la tabla `dish_allergens`
--
ALTER TABLE `dish_allergens`
  ADD PRIMARY KEY (`dish_id`,`allergen_id`),
  ADD KEY `allergen_id` (`allergen_id`);

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo_electronico` (`correo_electronico`);

--
-- Indices de la tabla `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mesa_notificacion` (`mesa_id`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `table_id` (`table_id`);

--
-- Indices de la tabla `order_dishes`
--
ALTER TABLE `order_dishes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `dish_id` (`dish_id`);

--
-- Indices de la tabla `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `table_id` (`table_id`),
  ADD KEY `dish_id` (`dish_id`);

--
-- Indices de la tabla `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `number` (`number`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `allergens`
--
ALTER TABLE `allergens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `dishes`
--
ALTER TABLE `dishes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `order_dishes`
--
ALTER TABLE `order_dishes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT de la tabla `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `tables`
--
ALTER TABLE `tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `dishes`
--
ALTER TABLE `dishes`
  ADD CONSTRAINT `dishes_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Filtros para la tabla `dish_allergens`
--
ALTER TABLE `dish_allergens`
  ADD CONSTRAINT `dish_allergens_ibfk_1` FOREIGN KEY (`dish_id`) REFERENCES `dishes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `dish_allergens_ibfk_2` FOREIGN KEY (`allergen_id`) REFERENCES `allergens` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `fk_mesa_notificacion` FOREIGN KEY (`mesa_id`) REFERENCES `tables` (`id`);

--
-- Filtros para la tabla `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`table_id`) REFERENCES `tables` (`id`);

--
-- Filtros para la tabla `order_dishes`
--
ALTER TABLE `order_dishes`
  ADD CONSTRAINT `order_dishes_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_dishes_ibfk_2` FOREIGN KEY (`dish_id`) REFERENCES `dishes` (`id`);

--
-- Filtros para la tabla `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`table_id`) REFERENCES `tables` (`id`),
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`dish_id`) REFERENCES `dishes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
