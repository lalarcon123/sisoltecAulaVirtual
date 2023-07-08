-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-09-2022 a las 17:59:47
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sisoltec`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `descripcion`, `estado`) VALUES
(1, 'COMPUTADORAS', 1),
(2, 'ACCESORIO', 1),
(3, 'COMPONENTES', 1),
(4, 'ALMACENAMIENTO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `identificacion` varchar(13) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` int(10) NOT NULL,
  `responsable` varchar(255) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `identificacion`, `descripcion`, `mail`, `direccion`, `telefono`, `responsable`, `estado`) VALUES
(1, '', 'ABC', '', 'AV. FCO ORELLANA', 222222222, 'INGENIERO VERDUGA', 1),
(2, '0992239247001', 'COMPUTRON', 'LUIS.FERNANDO@COMPUTRON.COM', 'AV. FRANCISCO DE ORELLANA SL. 31 MZ. 110', 990165604, 'INGENIERO L;UIS FERNANDO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_solicitud_compra`
--

CREATE TABLE `detalle_solicitud_compra` (
  `id` int(11) NOT NULL,
  `id_solicitud_compra` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `cantidad_recibida` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_solicitud_compra`
--

INSERT INTO `detalle_solicitud_compra` (`id`, `id_solicitud_compra`, `id_producto`, `precio`, `cantidad`, `cantidad_recibida`, `estado`) VALUES
(1, 1, 1, 300, 10, 5, 3),
(2, 1, 2, 400, 25, 25, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_menu`
--

CREATE TABLE `det_menu` (
  `det_menu_id` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `observacion` varchar(255) NOT NULL,
  `pagina` varchar(255) NOT NULL DEFAULT '#'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `det_menu`
--

INSERT INTO `det_menu` (`det_menu_id`, `id_menu`, `descripcion`, `estado`, `observacion`, `pagina`) VALUES
(1, 5, 'USUARIOS', 1, 'MANTENIMIENTO DE USUARIOS', 'consultausuarios.php'),
(2, 5, 'PERFILES', 1, 'MANTENIMIENTO DE PERFILES', 'ConsultaPerfiles.php'),
(3, 5, 'MODULOS', 1, 'MANTENIMIENTO DE MODULOS', 'consultaopciones.php'),
(4, 5, 'OPCIONES', 1, 'MANTENIMIENTO DE OPCIONES', 'consultasubopciones.php'),
(5, 1, 'CATEGORIA', 1, 'CATEGORIA', 'consultacategoria.php'),
(6, 5, 'OPCIONES POR PERFIL', 1, 'OPCIONES POR PERFIL', 'ConsultaPerfilesOpciones.php'),
(7, 1, 'SUBCATEGORIA', 1, 'SUBCATEGORIA', 'consultasubcategoria.php'),
(8, 1, 'TIPO DE PROYECTO', 1, 'TIPO DE PROYECTO', 'consultatipoproyecto.php'),
(9, 1, 'PROYECTOS', 1, 'PROYECTOS', 'ConsultaProyectos.php'),
(10, 1, 'CLIENTES', 1, 'MANTENIMIENTO DE CLIENTES', 'consultaclientes.php'),
(11, 1, 'TIPO TAREA', 1, 'TIPO TAREA', 'ConsultaTipoTareas.php'),
(12, 1, 'PRODUCTOS', 1, 'MANTENIMIENTO DE PRODUCTOS', 'consultaproductos.php'),
(13, 1, 'PROVEEDORES', 1, 'MANTENIMIENTO DE PROVEEDORES', 'consultaproveedores.php'),
(14, 2, 'SOLICITUD DE COMPRA', 1, 'SOLICITUD DE COMPRA', 'consultasolicitudescompra.php'),
(15, 2, 'RECEPCION COMPRA', 1, 'RECEPCION COMPRA', 'consultasolicitudescomprafin.php'),
(16, 2, 'PRORROGA', 1, 'PRORROGA', 'ConsultaProyectosProrroga.php');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `estado` int(1) NOT NULL DEFAULT 1,
  `fecha_creacion` datetime NOT NULL,
  `observacion` varchar(255) NOT NULL,
  `pagina` varchar(255) NOT NULL DEFAULT '#'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`id_menu`, `descripcion`, `estado`, `fecha_creacion`, `observacion`, `pagina`) VALUES
(1, 'MANTENIMIENTO', 1, '2021-06-07 21:03:54', 'MENU DE MANTENIMIENTO', '#'),
(2, 'PROCESOS', 1, '0000-00-00 00:00:00', 'MENU PROCESOS', '#'),
(3, 'REPORTES', 1, '0000-00-00 00:00:00', 'MENU REPORTES', '#'),
(5, 'ADMINISTRACION', 1, '0000-00-00 00:00:00', 'ADMINISTRACION', '#');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parametros`
--

CREATE TABLE `parametros` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(30) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `estado` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `parametros`
--

INSERT INTO `parametros` (`id`, `descripcion`, `valor`, `estado`) VALUES
(1, 'NOMBRE_SISTEMA', 'SISOLTEC', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `especificaciones` varchar(1000) NOT NULL,
  `color` varchar(100) NOT NULL,
  `documento` varchar(100) NOT NULL,
  `precio` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `especificaciones`, `color`, `documento`, `precio`, `cantidad`, `estado`) VALUES
(1, 'LENOVO - LAPTOP IDEAPAD 3-14ALC6| AZUL', 'PROCESADOR:\r\nAMD RYZEN 3 5300U (4C / 8T, 2.6 / 3.8GHZ, 2MB L2 / 4MB L3)\r\n\r\nMEMORIA:\r\n4GB SOLDERED DDR4-3200 + 4GB SO-DIMM DDR4-3200\r\n\r\nPANTALLA Y GRÃFICOS:\r\n14&amp;quot; FHD (1920X1080) TN 250NITS ANTI-GLARE, 45% NTSC\r\n\r\nALMACENAMIENTO:\r\n256GB SSD M.2 2280 PCIE 3.0X4 NVMEÂ®\r\n\r\nCARACTERÃSTICAS DE EXPANSIÃN:\r\nMODEL WITH 38WH BATTERY: UP TO TWO DRIVES, 1X 2.5&amp;quot; HDD + 1X M.2 SSD\r\n2.5&amp;quot; HDD UP TO 1TB\r\nM.2 2242 SSD UP TO 512GB\r\nM.2 2280 SSD UP TO 512GB\r\n\r\nCONECTIVIDAD INALÃMBRICA:\r\nWLAN + BLUETOOTH: 11AC, 2X2 + BT5.0\r\n\r\nPUERTOS ESTÃNDAR:\r\n1X USB 2.0\r\n1X USB 3.2 GEN 1\r\n1X USB-C 3.2 GEN 1 (SUPPORT DATA TRANSFER ONLY)\r\n1X HDMIÂ® 1.4B\r\n1X CARD READER\r\n1X HEADPHONE / MICROPHONE COMBO JACK (3.5MM)\r\n1X POWER CONNECTOR\r\n\r\nSISTEMA OPERATIVO:\r\nWINDOWS 10 HOME\r\n\r\nBUNDLE:\r\nLENOVO 300 WIRELESS COMPACT MOUSE\r\n\r\n\r\nDIMENSIONES:\r\nLARGO 32.42 CM\r\nPROFUNDIDAD 21.57 CM\r\nALTO 1.99 CM\r\n\r\nPESO:\r\n1.41 KG\r\n', 'NEGRA', 'uploads/img/Ficha Tecnica.docx', 500, 110, 1),
(2, 'HP - LAPTOP 15-DY2056LA 15&amp;quot; PLATEADO', 'PROCESADOR:\r\nINTEL CORETM I5-1135G7 (HASTA 4,2 GHZ CON TECNOLOGÃA INTEL TURBO BOOST, 8 MB DE CACHÃ L3 Y 4 NÃCLEOS)\r\n\r\nMEMORIA:\r\n8 GB DE SDRAM DDR4-2666 (2 X 4 GB)\r\n\r\nALMACENAMIENTO DE DATOS\r\nUNIDAD DE ESTADO SÃLIDO INTEL PCIE NVMETM M.2 DE 512 GB\r\nMEMORIA INTEL OPTANETM DE 32 GB\r\nUNIDAD ÃPTICA NO INCLUIDA\r\n\r\nPANTALLA\r\nPANTALLA HD, BRIGHTVIEW, CON MICROBORDES, DE 39,6 CM (15,6&amp;quot;) EN\r\nDIAGONAL, 250 NITS Y 45 % DE NTSC (1366 X 768)\r\n\r\nFUENTE DE ALIMENTACIÃN DE ENERGÃA\r\nADAPTADOR DE ALIMENTACIÃN DE CA INTELIGENTE DE 45 W\r\n\r\nTIPO DE BATERÃA\r\nIONES DE LITIO DE 3 CELDAS Y 41 WH\r\nBATERÃA Y ENERGÃA\r\nHASTA 8 HORAS\r\nDURACIÃN MÃXIMA DE LA BATERÃA REPRODUCIENDO VIDEO\r\nDURA HASTA 9 HORAS Y 15 MINUTOS\r\nTIEMPO DE RECARGA DE LA BATERÃA\r\nADMITE CARGA RÃPIDA DE LA BATERÃA: APROXIMADAMENTE UN 50 % EN 45\r\nMINUTOS\r\n\r\nCONECTIVIDAD\r\nCONECTIVIDAD INALÃMBRICA\r\nCOMBINACIÃN DE REALTEK RTL8821CE-M 802.11A/B/G/N/AC (1X1) WI-\r\nFIÂ® Y BLUETOOTH 4.2\r\nCOMPATIBLE CON MU-MIMO; COMPATIBLE CON MI', 'AZUL / NEGRO / GRIS ', 'uploads/img/Ficha Tecnica HP  LAPTOP 15 DY2056LA 15 PLATEADO.docx', 500, 100, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_imagenes`
--

CREATE TABLE `producto_imagenes` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto_imagenes`
--

INSERT INTO `producto_imagenes` (`id`, `id_producto`, `imagen`, `estado`) VALUES
(1, 1, 'uploads/img/LAPTOP LENOVO.PNG', 1),
(2, 1, 'uploads/documentos/LAPTOP LENOVO OTRO PERFIL.png', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_proveedores`
--

CREATE TABLE `producto_proveedores` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto_proveedores`
--

INSERT INTO `producto_proveedores` (`id`, `id_producto`, `id_proveedor`, `precio`, `estado`) VALUES
(1, 1, 1, 300, 1),
(2, 1, 2, 350, 1),
(3, 2, 1, 400, 1),
(4, 2, 2, 410, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prorroga_proyecto`
--

CREATE TABLE `prorroga_proyecto` (
  `id` int(11) NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  `fecha_fin_anterior` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `archivo` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `prorroga_proyecto`
--

INSERT INTO `prorroga_proyecto` (`id`, `id_proyecto`, `fecha_fin_anterior`, `fecha_fin`, `archivo`, `estado`) VALUES
(2, 2, '2023-04-30 00:00:00', '2023-05-31 00:00:00', 'uploads/documentos/prorroga.docx', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `ruc` varchar(13) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `telefono` int(10) NOT NULL,
  `responsable` varchar(255) NOT NULL,
  `telefono_representante` int(10) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT current_timestamp(),
  `sitioweb` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `nombre`, `descripcion`, `ruc`, `direccion`, `mail`, `telefono`, `responsable`, `telefono_representante`, `fecha_registro`, `sitioweb`, `estado`) VALUES
(1, 'COMPUTROM', 'COMPUTROM', '0912345678001', 'AV. 9 DE OCTUBRE', 'SERVICIOALCLIENTE@COMPUTROM.COM', 944444444, 'INGENIERO BEN', 921212121, '2022-08-04 22:23:34', 'WWW.COMPUTROM.COM', 1),
(2, 'MULTIPRODUCTOS', 'MULTIPRODUCTOS', '0912345678001', 'AV.LEON FEBRES CORDERO', 'SERVICIO@MULTIPRODUCTOS', 912121212, 'NYMERIA AGUSTA', 913131313, '2022-08-05 06:53:39', 'WWW.MULTISERVICIO.COM', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
  `id` int(11) NOT NULL,
  `codigoproy` varchar(30) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `tipo_proyecto` int(11) NOT NULL,
  `responsable` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `planproyecto` varchar(150) NOT NULL,
  `cronograma` varchar(150) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`id`, `codigoproy`, `nombre`, `descripcion`, `tipo_proyecto`, `responsable`, `id_cliente`, `fecha_inicio`, `fecha_fin`, `planproyecto`, `cronograma`, `estado`) VALUES
(1, 'P-2022-DATAC', 'IMPLEMENTACION DE DATA CENTER PARA CLIENTE ABC', 'IMPLEMENTACION DE DATA CENTER PARA CLIENTE ABC', 1, 2, 1, '2022-06-21', '2022-10-30', 'uploads/documentos/', 'uploads/documentos/', 1),
(2, 'P-2022-COMPAPC', 'COMPRA DE NUEVAS PC', 'COMPRA DE NUEVAS PC', 1, 2, 1, '2022-08-08', '2023-05-31', 'uploads/documentos/', 'uploads/documentos/', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recursos_proyectos`
--

CREATE TABLE `recursos_proyectos` (
  `id` int(11) NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `recursos_proyectos`
--

INSERT INTO `recursos_proyectos` (`id`, `id_proyecto`, `id_user`, `estado`) VALUES
(1, 2, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_tarea`
--

CREATE TABLE `registro_tarea` (
  `id` int(11) NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `hora_inicio` varchar(10) DEFAULT NULL,
  `hora_fin` varchar(10) DEFAULT NULL,
  `fecha_entrega` date NOT NULL,
  `id_tipo_tarea` int(11) NOT NULL,
  `documento` varchar(255) NOT NULL,
  `observacion` varchar(200) DEFAULT NULL,
  `evidencia` varchar(255) DEFAULT NULL,
  `avance` int(3) NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `responsable` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `registro_tarea`
--

INSERT INTO `registro_tarea` (`id`, `id_proyecto`, `descripcion`, `fecha_inicio`, `fecha_fin`, `hora_inicio`, `hora_fin`, `fecha_entrega`, `id_tipo_tarea`, `documento`, `observacion`, `evidencia`, `avance`, `fecha_modificacion`, `responsable`, `estado`) VALUES
(1, 1, 'REUNION INICIAL', '0000-00-00', '0000-00-00', '09:00', '10:00', '2022-07-11', 2, 'uploads/documentos/fondo flores.png', 'A', 'uploads/documentos/', 100, '2022-07-27 20:22:26', 3, 3),
(2, 1, 'LEVANTAMIENTO DE SERVIDORES', '0000-00-00', '0000-00-00', '10:00', '12:00', '2022-07-11', 2, 'uploads/documentos/WhatsApp Image 2022-07-09 at 8.19.40 PM.jpeg', NULL, NULL, 0, '0000-00-00 00:00:00', 3, 1),
(3, 1, 'LEVANTAMIENTO DE SISTEMA OPERATIVO POR SERVIDOR', '0000-00-00', '0000-00-00', '13:00', '14:00', '2022-07-11', 2, 'uploads/documentos/helado.jpeg', NULL, NULL, 0, '0000-00-00 00:00:00', 3, 1),
(4, 1, 'IMPLEMENTACION DE DATA CENTER', '2022-08-09', '2022-08-26', NULL, NULL, '2022-08-27', 3, '', NULL, NULL, 0, '0000-00-00 00:00:00', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudcompra`
--

CREATE TABLE `solicitudcompra` (
  `id` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `forma_pago` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `id_user` int(11) NOT NULL,
  `monto` int(11) NOT NULL,
  `observacion` varchar(250) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `solicitudcompra`
--

INSERT INTO `solicitudcompra` (`id`, `id_proveedor`, `forma_pago`, `fecha`, `id_user`, `monto`, `observacion`, `estado`) VALUES
(1, 1, 1, '2022-08-09 00:02:47', 1, 13000, '1', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategoria`
--

CREATE TABLE `subcategoria` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `subcategoria`
--

INSERT INTO `subcategoria` (`id`, `id_categoria`, `descripcion`, `estado`) VALUES
(1, 1, 'ESCRITORIO Y ALL IN ONE', 1),
(2, 1, 'LAPTOPS', 1),
(3, 1, 'COMPUTADORAS GAMER', 1),
(4, 2, 'TECLADO Y MOUSE', 1),
(5, 2, 'MOCHILAS', 1),
(6, 2, 'FUNDAS', 1),
(7, 2, 'PROTECTORES', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_proyecto`
--

CREATE TABLE `tipo_proyecto` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_proyecto`
--

INSERT INTO `tipo_proyecto` (`id`, `descripcion`, `estado`) VALUES
(1, 'INFRAESTRUCTURA', 1),
(2, 'ARQUITECTURA', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_tarea`
--

CREATE TABLE `tipo_tarea` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_tarea`
--

INSERT INTO `tipo_tarea` (`id`, `descripcion`, `estado`) VALUES
(1, 'ADMINISTRATIVA', 1),
(2, 'GESTION', 1),
(3, 'IMPLEMENTACION', 1),
(4, 'CIERRE', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `ci` varchar(15) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `user_level` int(1) NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL DEFAULT 1,
  `last_login` datetime DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `phone` int(10) NOT NULL,
  `movil` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `last_name`, `ci`, `mail`, `user_level`, `creation_date`, `status`, `last_login`, `image`, `start_date`, `end_date`, `phone`, `movil`) VALUES
(1, 'ADMIN', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'ADMIN', 'ADMIN', '1', 'DDH@HOTMAIL.CONGH', 1, '2021-06-07 20:14:00', 1, NULL, NULL, NULL, NULL, 0, 1),
(2, 'LPADILLA', '4b0805f84f8761d32c422046d83e43d7447a2a8a', 'LORENZA', 'PADILLA', '0912345678', 'LPADILLA@SISOLTEC.COM', 6, '2022-06-21 20:43:08', 1, NULL, NULL, NULL, NULL, 943543543, 1345435435),
(3, 'NADOLFA', '9fa6613713042821639b4692dfb8ddaf9959ccd4', 'NYMERIA', 'ADOLFA', '0912345678', 'NADOLFA@SISOLTEC.COM0', 5, '2022-08-05 22:56:51', 1, NULL, NULL, NULL, NULL, 912121212, 913131313);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(150) NOT NULL,
  `group_level` int(1) NOT NULL,
  `estado` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `user_groups`
--

INSERT INTO `user_groups` (`id`, `group_name`, `group_level`, `estado`) VALUES
(1, 'ADMINISTRADOR', 1, 1),
(2, 'DIRECTOR', 2, 1),
(3, 'JEFE DE INVENTARIO', 3, 1),
(4, 'JEFE DE PROYECTO', 4, 1),
(5, 'ANALISTA', 5, 1),
(6, 'LIDER DE PROYECTO', 6, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_menu`
--

CREATE TABLE `usuario_menu` (
  `usu_menu_id` int(11) NOT NULL,
  `det_menu_id` int(11) NOT NULL,
  `grupo_id` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `observacion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario_menu`
--

INSERT INTO `usuario_menu` (`usu_menu_id`, `det_menu_id`, `grupo_id`, `estado`, `observacion`) VALUES
(1, 5, 1, 1, 'MANTENIMIENTO DE CATEGORIA'),
(1, 7, 1, 1, 'CONSULTA DE SUBCATEGORIA'),
(1, 8, 1, 1, 'TIPO DE PROYECTO'),
(1, 10, 1, 1, 'CLIENTES'),
(1, 11, 1, 1, 'TIPO TAREA'),
(1, 12, 1, 1, 'PRODUCTOS'),
(1, 13, 1, 1, 'PROVEEDORES'),
(2, 9, 1, 1, 'PROYECTOS'),
(2, 14, 1, 1, 'SOLICITUD DE COMPRA'),
(2, 15, 1, 1, 'RECEPCION COMPRA'),
(2, 16, 1, 1, 'PRORROGA'),
(5, 1, 1, 1, 'USUARIOS'),
(5, 2, 1, 1, 'PERFILES'),
(5, 3, 1, 1, 'OPCIONES'),
(5, 4, 1, 1, 'SUBOPCIONES'),
(5, 6, 1, 1, 'ACCESOS');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_solicitud_compra`
--
ALTER TABLE `detalle_solicitud_compra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `det_menu`
--
ALTER TABLE `det_menu`
  ADD PRIMARY KEY (`det_menu_id`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indices de la tabla `parametros`
--
ALTER TABLE `parametros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto_imagenes`
--
ALTER TABLE `producto_imagenes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto_proveedores`
--
ALTER TABLE `producto_proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `prorroga_proyecto`
--
ALTER TABLE `prorroga_proyecto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `recursos_proyectos`
--
ALTER TABLE `recursos_proyectos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `registro_tarea`
--
ALTER TABLE `registro_tarea`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `solicitudcompra`
--
ALTER TABLE `solicitudcompra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_proyecto`
--
ALTER TABLE `tipo_proyecto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_tarea`
--
ALTER TABLE `tipo_tarea`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario_menu`
--
ALTER TABLE `usuario_menu`
  ADD UNIQUE KEY `PK_USUARIO_MENU` (`usu_menu_id`,`det_menu_id`,`grupo_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `detalle_solicitud_compra`
--
ALTER TABLE `detalle_solicitud_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `det_menu`
--
ALTER TABLE `det_menu`
  MODIFY `det_menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `parametros`
--
ALTER TABLE `parametros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `producto_imagenes`
--
ALTER TABLE `producto_imagenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `producto_proveedores`
--
ALTER TABLE `producto_proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `prorroga_proyecto`
--
ALTER TABLE `prorroga_proyecto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `recursos_proyectos`
--
ALTER TABLE `recursos_proyectos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `registro_tarea`
--
ALTER TABLE `registro_tarea`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `solicitudcompra`
--
ALTER TABLE `solicitudcompra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tipo_proyecto`
--
ALTER TABLE `tipo_proyecto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_tarea`
--
ALTER TABLE `tipo_tarea`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
