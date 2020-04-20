/*!40100 DEFAULT CHARACTER SET utf8 */;
USE `id13314013_ids_db`;
-- MySQL dump 10.13  Distrib 8.0.16, for Win64 (x86_64)
--
-- Host: localhost    Database: id13314013_ids_db
-- ------------------------------------------------------
-- Server version	5.7.26

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `inv_categoria_operacion`
--

DROP TABLE IF EXISTS `inv_categoria_operacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `inv_categoria_operacion` (
  `id_categoria_operacion` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `descripcion` varchar(30) NOT NULL,
  `clave` varchar(15) NOT NULL,
  `estado_registro` enum('A','B') NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_categoria_operacion`),
  KEY `id_empresa` (`id_empresa`),
  CONSTRAINT `inv_categoria_operacion_ibfk_1` FOREIGN KEY (`id_empresa`) REFERENCES `sys_empresa` (`id_empresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inv_categoria_operacion`
--

LOCK TABLES `inv_categoria_operacion` WRITE;
/*!40000 ALTER TABLE `inv_categoria_operacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `inv_categoria_operacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inv_operacion_detalle`
--

DROP TABLE IF EXISTS `inv_operacion_detalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `inv_operacion_detalle` (
  `id_operacion_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `id_operacion_encabezado` int(11) NOT NULL,
  `id_bodega` int(11) NOT NULL,
  `tipo_movimiento` enum('I','E') NOT NULL DEFAULT 'I',
  `id_producto` int(11) NOT NULL,
  `codigo_producto` varchar(45) DEFAULT NULL,
  `unidades` int(11) NOT NULL DEFAULT '1',
  `valor_unitario` decimal(10,2) NOT NULL DEFAULT '0.00',
  `valor` decimal(10,2) NOT NULL DEFAULT '0.00',
  `valor_iva` decimal(10,2) NOT NULL DEFAULT '0.00',
  `estado_registro` enum('A','B') NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_operacion_detalle`) USING BTREE,
  KEY `id_operacion_encabezado` (`id_operacion_encabezado`),
  CONSTRAINT `inv_operacion_detalle_ibfk_1` FOREIGN KEY (`id_operacion_encabezado`) REFERENCES `inv_operacion_encabezado` (`id_operacion_encabezado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inv_operacion_detalle`
--

LOCK TABLES `inv_operacion_detalle` WRITE;
/*!40000 ALTER TABLE `inv_operacion_detalle` DISABLE KEYS */;
/*!40000 ALTER TABLE `inv_operacion_detalle` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `mantenimiento_existencia` BEFORE INSERT ON `inv_operacion_detalle` FOR EACH ROW IF NEW.tipo_movimiento = 'I' THEN

	UPDATE opr_producto

    SET opr_producto.existencia = opr_producto.existencia + NEW.unidades

    WHERE  opr_producto.id_producto = NEW.id_producto;

ELSE

	UPDATE opr_producto

    SET opr_producto.existencia = opr_producto.existencia - NEW.unidades

    WHERE  opr_producto.id_producto = NEW.id_producto;

END IF */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `inv_operacion_encabezado`
--

DROP TABLE IF EXISTS `inv_operacion_encabezado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `inv_operacion_encabezado` (
  `id_operacion_encabezado` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL DEFAULT '1',
  `id_sucursal` int(11) NOT NULL DEFAULT '0',
  `id_tipo_documento` int(11) NOT NULL,
  `id_categoria_operacion` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `numero` int(25) NOT NULL,
  `serie` varchar(3) DEFAULT NULL,
  `id_proveedor` int(255) DEFAULT NULL,
  `observaciones` varchar(1000) DEFAULT NULL,
  `id_operador` int(11) NOT NULL DEFAULT '0',
  `estado_registro` enum('A','B') NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_operacion_encabezado`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inv_operacion_encabezado`
--

LOCK TABLES `inv_operacion_encabezado` WRITE;
/*!40000 ALTER TABLE `inv_operacion_encabezado` DISABLE KEYS */;
/*!40000 ALTER TABLE `inv_operacion_encabezado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inv_tipo_documento`
--

DROP TABLE IF EXISTS `inv_tipo_documento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `inv_tipo_documento` (
  `id_tipo_documento` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `descripcion` varchar(30) NOT NULL,
  `clave` varchar(15) NOT NULL,
  `estado_registro` enum('A','B') NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_tipo_documento`),
  KEY `id_empresa` (`id_empresa`),
  CONSTRAINT `inv_tipo_documento_ibfk_1` FOREIGN KEY (`id_empresa`) REFERENCES `sys_empresa` (`id_empresa`),
  CONSTRAINT `inv_tipo_documento_ibfk_2` FOREIGN KEY (`id_empresa`) REFERENCES `sys_empresa` (`id_empresa`),
  CONSTRAINT `inv_tipo_documento_ibfk_3` FOREIGN KEY (`id_empresa`) REFERENCES `sys_empresa` (`id_empresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inv_tipo_documento`
--

LOCK TABLES `inv_tipo_documento` WRITE;
/*!40000 ALTER TABLE `inv_tipo_documento` DISABLE KEYS */;
/*!40000 ALTER TABLE `inv_tipo_documento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `opr_bodega`
--

DROP TABLE IF EXISTS `opr_bodega`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `opr_bodega` (
  `id_bodega` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `descripcion` varchar(45) COLLATE utf8_bin NOT NULL,
  `clave` varchar(15) COLLATE utf8_bin NOT NULL,
  `estado_registro` enum('A','B') COLLATE utf8_bin NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_bodega`) USING BTREE,
  KEY `id_empresa` (`id_empresa`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opr_bodega`
--

LOCK TABLES `opr_bodega` WRITE;
/*!40000 ALTER TABLE `opr_bodega` DISABLE KEYS */;
/*!40000 ALTER TABLE `opr_bodega` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `opr_categoria`
--

DROP TABLE IF EXISTS `opr_categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `opr_categoria` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `descripcion` varchar(45) COLLATE utf8_bin NOT NULL,
  `clave` varchar(15) COLLATE utf8_bin NOT NULL,
  `estado_registro` enum('A','B') COLLATE utf8_bin NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_categoria`) USING BTREE,
  KEY `id_empresa` (`id_empresa`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opr_categoria`
--

LOCK TABLES `opr_categoria` WRITE;
/*!40000 ALTER TABLE `opr_categoria` DISABLE KEYS */;
/*!40000 ALTER TABLE `opr_categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `opr_clase`
--

DROP TABLE IF EXISTS `opr_clase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `opr_clase` (
  `id_clase` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `descripcion` varchar(45) COLLATE utf8_bin NOT NULL,
  `clave` varchar(15) COLLATE utf8_bin NOT NULL,
  `estado_registro` enum('A','B') COLLATE utf8_bin NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_clase`) USING BTREE,
  KEY `id_empresa` (`id_empresa`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opr_clase`
--

LOCK TABLES `opr_clase` WRITE;
/*!40000 ALTER TABLE `opr_clase` DISABLE KEYS */;
/*!40000 ALTER TABLE `opr_clase` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `opr_marca`
--

DROP TABLE IF EXISTS `opr_marca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `opr_marca` (
  `id_marca` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `descripcion` varchar(45) COLLATE utf8_bin NOT NULL,
  `clave` varchar(15) COLLATE utf8_bin NOT NULL,
  `estado_registro` enum('A','B') COLLATE utf8_bin NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_marca`) USING BTREE,
  KEY `id_empresa` (`id_empresa`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opr_marca`
--

LOCK TABLES `opr_marca` WRITE;
/*!40000 ALTER TABLE `opr_marca` DISABLE KEYS */;
/*!40000 ALTER TABLE `opr_marca` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `opr_medida`
--

DROP TABLE IF EXISTS `opr_medida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `opr_medida` (
  `id_medida` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `descripcion` varchar(45) COLLATE utf8_bin NOT NULL,
  `clave` varchar(15) COLLATE utf8_bin NOT NULL,
  `estado_registro` enum('A','B') COLLATE utf8_bin NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_medida`) USING BTREE,
  KEY `id_empresa` (`id_empresa`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opr_medida`
--

LOCK TABLES `opr_medida` WRITE;
/*!40000 ALTER TABLE `opr_medida` DISABLE KEYS */;
/*!40000 ALTER TABLE `opr_medida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `opr_modelo`
--

DROP TABLE IF EXISTS `opr_modelo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `opr_modelo` (
  `id_modelo` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `descripcion` varchar(70) COLLATE utf8_bin NOT NULL,
  `clave` varchar(45) COLLATE utf8_bin NOT NULL,
  `codigo_modelo` varchar(10) COLLATE utf8_bin NOT NULL,
  `estado_registro` enum('A','B') COLLATE utf8_bin NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_modelo`) USING BTREE,
  KEY `id_empresa` (`id_empresa`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opr_modelo`
--

LOCK TABLES `opr_modelo` WRITE;
/*!40000 ALTER TABLE `opr_modelo` DISABLE KEYS */;
/*!40000 ALTER TABLE `opr_modelo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `opr_producto`
--

DROP TABLE IF EXISTS `opr_producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `opr_producto` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `id_bodega` int(11) NOT NULL COMMENT 'Define la bodega por defecto del producto',
  `codigo` varchar(45) CHARACTER SET latin1 NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `descripcion` varchar(75) CHARACTER SET latin1 NOT NULL,
  `id_marca` int(11) NOT NULL,
  `id_modelo` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `id_tipo_producto` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_clase` int(11) DEFAULT NULL,
  `id_medida` int(11) DEFAULT NULL,
  `tipo_producto` enum('T','P') CHARACTER SET latin1 NOT NULL DEFAULT 'T',
  `imagen` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `observaciones` varchar(500) CHARACTER SET latin1 DEFAULT NULL,
  `descripcion_alternativa` varchar(150) CHARACTER SET latin1 NOT NULL,
  `id_operador` int(11) NOT NULL,
  `estado_registro` enum('A','B') CHARACTER SET latin1 NOT NULL DEFAULT 'A',
  `existencia` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_producto`) USING BTREE,
  UNIQUE KEY `codigo_UNIQUE` (`codigo`) USING BTREE,
  KEY `id_empresa` (`id_empresa`),
  CONSTRAINT `opr_producto_ibfk_1` FOREIGN KEY (`id_empresa`) REFERENCES `sys_empresa` (`id_empresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opr_producto`
--

LOCK TABLES `opr_producto` WRITE;
/*!40000 ALTER TABLE `opr_producto` DISABLE KEYS */;
/*!40000 ALTER TABLE `opr_producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `opr_proveedor`
--

DROP TABLE IF EXISTS `opr_proveedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `opr_proveedor` (
  `id_proveedor` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `telefono` varchar(8) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `observaciones` varchar(500) DEFAULT NULL,
  `estado_registro` enum('A','B') DEFAULT 'A',
  PRIMARY KEY (`id_proveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opr_proveedor`
--

LOCK TABLES `opr_proveedor` WRITE;
/*!40000 ALTER TABLE `opr_proveedor` DISABLE KEYS */;
/*!40000 ALTER TABLE `opr_proveedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `opr_sucursal`
--

DROP TABLE IF EXISTS `opr_sucursal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `opr_sucursal` (
  `id_sucursal` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `descripcion` varchar(45) COLLATE utf8_bin NOT NULL,
  `clave` varchar(15) COLLATE utf8_bin NOT NULL,
  `estado_registro` enum('A','B') COLLATE utf8_bin NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_sucursal`) USING BTREE,
  KEY `id_empresa` (`id_empresa`),
  CONSTRAINT `opr_sucursal_ibfk_1` FOREIGN KEY (`id_empresa`) REFERENCES `sys_empresa` (`id_empresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opr_sucursal`
--

LOCK TABLES `opr_sucursal` WRITE;
/*!40000 ALTER TABLE `opr_sucursal` DISABLE KEYS */;
/*!40000 ALTER TABLE `opr_sucursal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `opr_tipo_producto`
--

DROP TABLE IF EXISTS `opr_tipo_producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `opr_tipo_producto` (
  `id_tipo_producto` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `descripcion` varchar(45) COLLATE utf8_bin NOT NULL,
  `clave` varchar(15) COLLATE utf8_bin NOT NULL,
  `estado_registro` enum('A','B') COLLATE utf8_bin NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_tipo_producto`) USING BTREE,
  UNIQUE KEY `clave_UNIQUE` (`clave`),
  KEY `id_empresa` (`id_empresa`),
  CONSTRAINT `opr_tipo_producto_ibfk_1` FOREIGN KEY (`id_empresa`) REFERENCES `sys_empresa` (`id_empresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opr_tipo_producto`
--

LOCK TABLES `opr_tipo_producto` WRITE;
/*!40000 ALTER TABLE `opr_tipo_producto` DISABLE KEYS */;
/*!40000 ALTER TABLE `opr_tipo_producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_asignacion_entidad_grupo`
--

DROP TABLE IF EXISTS `sys_asignacion_entidad_grupo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `sys_asignacion_entidad_grupo` (
  `id_asignacion_entidad_grupo` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) DEFAULT NULL,
  `id_grupo` int(11) unsigned NOT NULL,
  `id_entidad` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id_asignacion_entidad_grupo`) USING BTREE,
  KEY `fk_asignacion_entidad_grupo_id_entidad_idx` (`id_entidad`) USING BTREE,
  KEY `fk_asignacion_entidad_grupo_id_grupo_idx` (`id_grupo`) USING BTREE,
  KEY `id_empresa` (`id_empresa`),
  CONSTRAINT `fk_asignacion_entidad_grupo_id_entidad` FOREIGN KEY (`id_entidad`) REFERENCES `sys_entidad` (`id_entidad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_asignacion_entidad_grupo_id_grupo` FOREIGN KEY (`id_grupo`) REFERENCES `sys_grupo` (`id_grupo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `sys_asignacion_entidad_grupo_ibfk_1` FOREIGN KEY (`id_empresa`) REFERENCES `sys_empresa` (`id_empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_asignacion_entidad_grupo`
--

LOCK TABLES `sys_asignacion_entidad_grupo` WRITE;
/*!40000 ALTER TABLE `sys_asignacion_entidad_grupo` DISABLE KEYS */;
INSERT INTO `sys_asignacion_entidad_grupo` VALUES (3,1,2,3),(4,1,2,2),(5,1,2,4),(6,1,3,5),(7,1,3,7),(8,1,4,6),(9,1,4,8),(10,1,5,9),(11,1,5,10),(12,1,5,11),(16,1,1,1),(17,1,1,2),(18,1,1,3),(19,1,1,4);
/*!40000 ALTER TABLE `sys_asignacion_entidad_grupo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_asignacion_menu_entidad`
--

DROP TABLE IF EXISTS `sys_asignacion_menu_entidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `sys_asignacion_menu_entidad` (
  `id_asignacion_menu_entidad` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `id_entidad` int(11) unsigned NOT NULL,
  `id_menu` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id_asignacion_menu_entidad`) USING BTREE,
  KEY `fk_id_menu_idx` (`id_menu`) USING BTREE,
  KEY `fk_id_entidad_id_entidad_idx` (`id_entidad`) USING BTREE,
  KEY `idx_asignacion_menu_entidad_id_menu` (`id_menu`) USING BTREE,
  KEY `idx_asignacion_menu_entidad_id_entidad` (`id_entidad`) USING BTREE,
  CONSTRAINT `fk_asignacion_menu_entidad_id_entidad` FOREIGN KEY (`id_entidad`) REFERENCES `sys_entidad` (`id_entidad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_asignacion_menu_entidad_id_menu` FOREIGN KEY (`id_menu`) REFERENCES `sys_menu` (`id_menu`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_asignacion_menu_entidad`
--

LOCK TABLES `sys_asignacion_menu_entidad` WRITE;
/*!40000 ALTER TABLE `sys_asignacion_menu_entidad` DISABLE KEYS */;
INSERT INTO `sys_asignacion_menu_entidad` VALUES (1,0,1,17),(2,1,1,10);
/*!40000 ALTER TABLE `sys_asignacion_menu_entidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_asignacion_menu_grupo`
--

DROP TABLE IF EXISTS `sys_asignacion_menu_grupo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `sys_asignacion_menu_grupo` (
  `id_asignacion_menu_grupo` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) DEFAULT NULL,
  `id_grupo` int(11) unsigned NOT NULL,
  `id_menu` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id_asignacion_menu_grupo`) USING BTREE,
  KEY `idx_asignacion_menu_grupo_id_menu` (`id_menu`) USING BTREE,
  KEY `idx_asignacion_menu_grupo_id_grupo` (`id_grupo`) USING BTREE,
  CONSTRAINT `fk_asignacion_menu_grupo_id_grupo` FOREIGN KEY (`id_grupo`) REFERENCES `sys_grupo` (`id_grupo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_asignacion_menu_grupo_id_menu` FOREIGN KEY (`id_menu`) REFERENCES `sys_menu` (`id_menu`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=344 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_asignacion_menu_grupo`
--

LOCK TABLES `sys_asignacion_menu_grupo` WRITE;
/*!40000 ALTER TABLE `sys_asignacion_menu_grupo` DISABLE KEYS */;
INSERT INTO `sys_asignacion_menu_grupo` VALUES (98,1,2,19),(99,1,2,22),(307,1,1,1),(308,1,1,2),(309,1,1,3),(310,1,1,5),(311,1,1,6),(312,1,1,7),(313,1,1,10),(314,1,1,11),(315,1,1,12),(316,1,1,13),(317,1,1,17),(318,1,1,25),(319,1,1,26),(320,1,1,28),(321,1,1,29),(322,1,1,35),(323,1,1,36),(324,1,1,37),(325,1,1,39),(326,1,1,40),(327,1,1,41),(328,1,1,43),(329,1,1,44),(330,1,1,45),(331,1,1,46),(332,1,1,51),(333,1,1,52),(334,1,1,53),(335,1,1,54),(336,1,1,55),(337,1,1,56),(338,1,1,57),(339,1,1,58),(340,1,1,59),(341,1,1,60),(342,1,1,61),(343,1,1,62);
/*!40000 ALTER TABLE `sys_asignacion_menu_grupo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_asignacion_rol_entidad`
--

DROP TABLE IF EXISTS `sys_asignacion_rol_entidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `sys_asignacion_rol_entidad` (
  `id_asignacion_rol_entidad` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `id_rol_entidad` int(11) unsigned NOT NULL,
  `id_entidad` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id_asignacion_rol_entidad`) USING BTREE,
  UNIQUE KEY `idx_entidad_rol` (`id_rol_entidad`,`id_entidad`) USING BTREE,
  KEY `fk_asignacion_rol_entidad_id_entidad_idx` (`id_entidad`) USING BTREE,
  CONSTRAINT `fk_asignacion_rol_entidad_id_entidad` FOREIGN KEY (`id_entidad`) REFERENCES `sys_entidad` (`id_entidad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_asignacion_rol_entidad_id_rol_entidad` FOREIGN KEY (`id_rol_entidad`) REFERENCES `sys_rol_entidad` (`id_rol_entidad`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_asignacion_rol_entidad`
--

LOCK TABLES `sys_asignacion_rol_entidad` WRITE;
/*!40000 ALTER TABLE `sys_asignacion_rol_entidad` DISABLE KEYS */;
INSERT INTO `sys_asignacion_rol_entidad` VALUES (104,1,1,1),(105,1,1,4),(106,1,1,5),(107,1,1,6),(108,1,2,1),(109,1,2,2);
/*!40000 ALTER TABLE `sys_asignacion_rol_entidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_empresa`
--

DROP TABLE IF EXISTS `sys_empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `sys_empresa` (
  `id_empresa` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(75) NOT NULL,
  `clave` varchar(45) DEFAULT NULL,
  `logo` varchar(75) DEFAULT NULL,
  `logo_encabezado` varchar(75) DEFAULT NULL,
  `estado_registro` enum('A','B') NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_empresa`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_empresa`
--

LOCK TABLES `sys_empresa` WRITE;
/*!40000 ALTER TABLE `sys_empresa` DISABLE KEYS */;
INSERT INTO `sys_empresa` VALUES (1,'id13314013_ids','id13314013_ids','logo_empresa.png','logo_encabezado.png','A');
/*!40000 ALTER TABLE `sys_empresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_entidad`
--

DROP TABLE IF EXISTS `sys_entidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `sys_entidad` (
  `id_entidad` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID de registro',
  `id_empresa` int(11) NOT NULL COMMENT 'Identificador de la empresa a la que pertenece el usuario',
  `descripcion` varchar(75) NOT NULL COMMENT 'Descripcion del usuario, nombre completo',
  `usuario` varchar(50) NOT NULL DEFAULT '' COMMENT 'Usuario',
  `clave_acceso` varchar(75) NOT NULL COMMENT 'Clave encriptada',
  `telefono` varchar(18) DEFAULT NULL COMMENT 'Telefono del usuario',
  `correo` varchar(75) NOT NULL COMMENT 'Correo electrónico del usuario',
  `codigo` varchar(25) NOT NULL COMMENT 'Código de usuario para autenticar al usuario cuando va a restablecer contraseña',
  `avatar` varchar(45) DEFAULT NULL,
  `estado_registro` enum('A','B','S') NOT NULL DEFAULT 'A' COMMENT 'Estado del Registro/ A=Alta,B=Baja,S=Suspendido',
  PRIMARY KEY (`id_entidad`) USING BTREE,
  UNIQUE KEY `clave` (`clave_acceso`) USING BTREE,
  UNIQUE KEY `usuario_UNIQUE` (`usuario`) USING BTREE,
  UNIQUE KEY `codigo_UNIQUE` (`codigo`) USING BTREE,
  KEY `id_empresa` (`id_empresa`),
  CONSTRAINT `sys_entidad_ibfk_1` FOREIGN KEY (`id_empresa`) REFERENCES `sys_empresa` (`id_empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_entidad`
--

LOCK TABLES `sys_entidad` WRITE;
/*!40000 ALTER TABLE `sys_entidad` DISABLE KEYS */;
INSERT INTO `sys_entidad` VALUES (1,1,'Administrador','admin','452fa616a13d1fc48a835080836ca84564ea995c','12345678','developer@ideasysistemas.com','10','1-avatar-max.png','A');
/*!40000 ALTER TABLE `sys_entidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_grupo`
--

DROP TABLE IF EXISTS `sys_grupo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `sys_grupo` (
  `id_grupo` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador de Registro',
  `id_empresa` int(11) DEFAULT NULL,
  `descripcion` varchar(75) COLLATE utf8_bin NOT NULL COMMENT 'Descripción del grupo',
  `estado_registro` enum('A','B','S') COLLATE utf8_bin NOT NULL DEFAULT 'A' COMMENT 'Estado del Registro del Grupo/A=Alta,B=Baja,S=Suspendido',
  PRIMARY KEY (`id_grupo`) USING BTREE,
  KEY `id_empresa` (`id_empresa`),
  CONSTRAINT `sys_grupo_ibfk_1` FOREIGN KEY (`id_empresa`) REFERENCES `sys_empresa` (`id_empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_grupo`
--

LOCK TABLES `sys_grupo` WRITE;
/*!40000 ALTER TABLE `sys_grupo` DISABLE KEYS */;
INSERT INTO `sys_grupo` VALUES (1,1,'Administradores','A');
/*!40000 ALTER TABLE `sys_grupo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_menu`
--

DROP TABLE IF EXISTS `sys_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `sys_menu` (
  `id_menu` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador de Registro',
  `id_empresa` int(11) NOT NULL DEFAULT '1' COMMENT 'Identificador de Empresa',
  `descripcion` varchar(75) NOT NULL COMMENT 'Descripción del menú que aparecerá en interface',
  `nivel` int(11) unsigned NOT NULL COMMENT 'Determina el nivel de menu dentro de la gestión, es decir primer nivel es el titulo de las opciones de menu que se encuentran sobre este, por lo que un segundo nivel determina el nivel de la opción de menú.',
  `link` varchar(75) NOT NULL COMMENT 'Es el comando que se ejecutará al seleccionar la opción de menu',
  `patron` varchar(3) NOT NULL COMMENT 'Determina el orden de presentación de los menús ',
  `tipo_imagen` enum('I','G') DEFAULT 'I' COMMENT 'I=Icono;G=Grafico Fisico',
  `imagen` varchar(50) DEFAULT NULL COMMENT 'Es la imagen que se adjuntará al menú cuando se elije tipo_imagen = ''G''',
  `color` varchar(10) DEFAULT NULL COMMENT 'Define el color del menu cuando aplica.',
  `ayuda` varchar(250) DEFAULT NULL COMMENT 'Comentario de ayuda sobre la opción de menu',
  `funcion` enum('M','C') NOT NULL DEFAULT 'M' COMMENT 'M=menu;C=comando',
  `estado_registro` enum('A','B') NOT NULL DEFAULT 'A' COMMENT 'A=Alta,B=Baja',
  PRIMARY KEY (`id_menu`) USING BTREE,
  KEY `id_empresa` (`id_empresa`),
  CONSTRAINT `sys_menu_ibfk_1` FOREIGN KEY (`id_empresa`) REFERENCES `sys_empresa` (`id_empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_menu`
--

LOCK TABLES `sys_menu` WRITE;
/*!40000 ALTER TABLE `sys_menu` DISABLE KEYS */;
INSERT INTO `sys_menu` VALUES (1,1,'Inicio',1,'#','A','I','dashboard','#26a135',NULL,'C','A'),(2,1,'Catalogos',1,'#','B','I','table',NULL,NULL,'M','A'),(3,1,'Menu',2,'catalogos/menu','BA','I','table',NULL,NULL,'C','A'),(4,1,'Causa de Titularidad',2,'catalogos/causa_titularidad','BAA','I','table','',NULL,'C','B'),(5,1,'Empresas',2,'catalogos/empresa','BAA','I','table',NULL,NULL,'C','A'),(6,1,'Entidad',2,'entidades/entidad','BAA','I','table','','','C','A'),(7,1,'Grupos',2,'catalogos/grupo','BAA','I','table','','','C','A'),(8,1,'Tipo Unidad de Medida',2,'catalogos/tipo_unidad_medida','BAA','I','table','','','C','B'),(9,1,'Unidad de Medidas',2,'catalogos/unidad_medida','BAA','I','table','','','C','B'),(10,1,'Parametros',2,'catalogos/parametro','BAA','I','table','','','C','A'),(11,1,'Tipo de Parametro',2,'catalogos/tipo_parametro','BAA','I','table',NULL,NULL,'C','A'),(12,1,'Asignacion Menu a Entidad',2,'catalogos/asignacion_menu_entidad','BAA','I','table',NULL,NULL,'C','A'),(13,1,'Asignacion Menu a Grupo',2,'catalogos/asignacion_menu_grupo','BAA','I','table',NULL,NULL,'C','A'),(14,1,'Titularidad de Derechos',2,'proyectos/titularidad_derechos','BAA','I','table','','','C','B'),(15,1,'Documento de Titularidad',2,'catalogos/documento_titularidad','BAA','I','table','','','C','B'),(16,1,'Tipo Persona Entrevista',2,'catalogos/tipo_persona_entrevista','BAA','I','table','','','C','B'),(17,1,'Asignacion Entidad Grupo',2,'catalogos/asignacion_entidad_grupo','BAA','I','table',NULL,NULL,'C','A'),(18,1,'Proyectos',1,'#','D','I','table','','prueba','M','B'),(19,1,'Ingreso Ficha Técnica Predial',2,'proyectos/ficha_tecnica/ingreso_ficha_tecnica_predial','DA','I','table','','prueba','C','B'),(20,1,'Clientes',1,'clientes/cliente','C','I','users','','Prueba','M','B'),(21,1,'Proyectos',2,'proyectos/proyecto','DAA','I','table','','','C','B'),(22,1,'Expediente',2,'proyectos/expediente','DAA','I','table','','','C','B'),(23,1,'Equipo',2,'catalogos/equipo','BAA','I','table','','','C','B'),(24,1,'Uso de Terreno',2,'catalogos/uso_terreno','BAA','I','table','','','C','B'),(25,1,'Departamentos',2,'catalogos/departamento','BAA','I','table','','','C','A'),(26,1,'Municipios',2,'catalogos/municipio','BAA','I','table','','','C','A'),(27,1,'Identificador Dirección',2,'catalogos/identificador_direccion','BAA','I','table','','','C','B'),(28,1,'Rol Entidad',2,'catalogos/rol_entidad','BAA','I','table','','','C','A'),(29,1,'Asignacion Rol a Entidad',2,'catalogos/asignacion_rol_entidad','BAA','I','table','','','C','A'),(30,1,'Tomar Fotos',2,'proyectos/tomar_fotos','DAA','I','camera','','','C','B'),(31,1,'Consulta Fotografías',2,'proyectos/tomar_fotos/consulta_fotos','DAB','I','file-text-o','','','C','B'),(32,1,'Tipo de Reportes',2,'catalogos/tipo_reporte','BAD','I','table','','','C','B'),(33,1,'Reportes de Usuario',2,'catalogos/reporte_usuario','BAA','I','file-text-o','','','C','B'),(34,1,'Consulta de Ficha Tecnica Predial',2,'proyectos/consulta_ficha_tecnica_predial','DAC','I','file-text','','','C','B'),(35,1,'Mantenimientos BUO',1,'#','D','I','file-text-o',NULL,'pruebaD1','M','A'),(36,1,'Marcas',2,'catalogos/marca','DA','I','table',NULL,'pruebaD1','C','A'),(37,1,'Modelos',2,'catalogos/modelo','DA','I','table',NULL,'pruebaD1','C','A'),(38,1,'Presentacion',2,'catalogos/presentacion','DA','I','table',NULL,'pruebaD1','C','B'),(39,1,'Medidas',2,'catalogos/medida','DA','I','table',NULL,'pruebaC1','C','A'),(40,1,'Clases',2,'catalogos/clase','DA','I','table',NULL,'pruebaD1','C','A'),(41,1,'Categorias',2,'catalogos/categoria','DA','I','table',NULL,'pruebaD1','C','A'),(43,1,'Sucursales',2,'catalogos/sucursal','DA','I','table',NULL,'pruebaD1','C','A'),(44,1,'Tipo Producto',2,'catalogos/tipo_producto','DA','I','table',NULL,'pruebaD1','C','A'),(45,1,'Bodega',2,'catalogos/bodega','DA','I','table',NULL,'pruebaD1','C','A'),(46,1,'Receta',2,'catalogos/receta','DA','I','table','','pruebaD1','C','A'),(51,1,'Detalle Receta',2,'catalogos/detalle_receta','DA','I','table',NULL,'pruebaD1','C','A'),(52,1,'Producto',1,'catalogos/producto','E','I','table','','pruebaD1','C','A'),(53,1,'Tipo Documento',2,'catalogos/tipo_documento','BAA','I','table','','pruebaD1','C','A'),(54,1,'Categoría Operación',2,'catalogos/categoria_operacion','BAA','I','table','','pruebaD1','C','A'),(55,1,'Inventario',1,'#','F','I','table','','pruebaD1','M','A'),(56,1,'Compras',2,'inventario/compras','FA','I','fas fa-shopping-cart','','pruebaD1','C','A'),(57,1,'Devoluciones',2,'inventario/devoluciones','FB','I','fas fa-people-carry','','pruebaD1','C','A'),(58,1,'Egresos Varios',2,'inventario/egresos_varios','FC','I','fas fa-sign-out-alt','','pruebaD1','C','A'),(59,1,'Ingresos Varios',2,'inventario/ingresos_varios','FD','I','fas fa-sign-in-alt','','pruebaD1','C','A'),(60,1,'Traslados entre Bodegas',2,'inventario/traslados_entre_bodegas','FE','I','fas fa-dolly-flatbed','','preubaD1','C','A'),(61,1,'Reportes',2,'inventario/reportes','FF','I','fa fa-document','','prueba1','C','A'),(62,1,'TPV',1,'facturacion/tpv','G','I','fas fa-file-invoice-dollar','','','C','A');
/*!40000 ALTER TABLE `sys_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_parametro`
--

DROP TABLE IF EXISTS `sys_parametro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `sys_parametro` (
  `id_parametro` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `descripcion` varchar(75) NOT NULL,
  `clave` varchar(45) NOT NULL,
  `valor` varchar(75) NOT NULL,
  `id_tipo_parametro` int(11) unsigned NOT NULL,
  `estado_registro` enum('A','B') NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_parametro`) USING BTREE,
  UNIQUE KEY `clave_UNIQUE` (`clave`) USING BTREE,
  KEY `fk_parametro_id_tipo_parametro_idx` (`id_tipo_parametro`) USING BTREE,
  KEY `id_empresa` (`id_empresa`),
  CONSTRAINT `fk_parametro_id_tipo_parametro` FOREIGN KEY (`id_tipo_parametro`) REFERENCES `sys_tipo_parametro` (`id_tipo_parametro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `sys_parametro_ibfk_1` FOREIGN KEY (`id_empresa`) REFERENCES `sys_empresa` (`id_empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_parametro`
--

LOCK TABLES `sys_parametro` WRITE;
/*!40000 ALTER TABLE `sys_parametro` DISABLE KEYS */;
INSERT INTO `sys_parametro` VALUES (7,1,'logo_empresa','LOGO','logo_empresa.png',1,'A'),(8,1,'logo_encabezado','LOGO_ENCABEZADO','logo_encabezado.png',1,'A'),(9,1,'Nombre de la Empresa32','NOMBRE_EMPRESA','Mi Buo',1,'A');
/*!40000 ALTER TABLE `sys_parametro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_rol_entidad`
--

DROP TABLE IF EXISTS `sys_rol_entidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `sys_rol_entidad` (
  `id_rol_entidad` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `descripcion` varchar(75) NOT NULL,
  `clave` varchar(25) NOT NULL,
  `estado_registro` enum('A','B') NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_rol_entidad`) USING BTREE,
  KEY `id_empresa` (`id_empresa`),
  CONSTRAINT `sys_rol_entidad_ibfk_1` FOREIGN KEY (`id_empresa`) REFERENCES `sys_empresa` (`id_empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_rol_entidad`
--

LOCK TABLES `sys_rol_entidad` WRITE;
/*!40000 ALTER TABLE `sys_rol_entidad` DISABLE KEYS */;
INSERT INTO `sys_rol_entidad` VALUES (3,1,'Vendedor','VENDEDOR','A'),(4,1,'Administrador','ADMINISTRADOR','A');
/*!40000 ALTER TABLE `sys_rol_entidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_routes`
--

DROP TABLE IF EXISTS `sys_routes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `sys_routes` (
  `id_route` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(100) NOT NULL,
  `modulo` varchar(75) DEFAULT NULL,
  `controlador` varchar(70) NOT NULL,
  `metodo` varchar(75) NOT NULL,
  `parametros` varchar(75) DEFAULT NULL,
  `url_real` varchar(75) DEFAULT NULL,
  `estado_registro` enum('A','B','S') NOT NULL DEFAULT 'A' COMMENT 'A=Alta,B=Baja,S=Suspendida',
  PRIMARY KEY (`id_route`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_routes`
--

LOCK TABLES `sys_routes` WRITE;
/*!40000 ALTER TABLE `sys_routes` DISABLE KEYS */;
INSERT INTO `sys_routes` VALUES (3,'no_autenticado',NULL,'index','index',NULL,NULL,'A'),(4,'autenticar','entidades','entidad','autenticarUsuario',NULL,NULL,'A');
/*!40000 ALTER TABLE `sys_routes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_tipo_parametro`
--

DROP TABLE IF EXISTS `sys_tipo_parametro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `sys_tipo_parametro` (
  `id_tipo_parametro` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `descripcion` varchar(75) NOT NULL,
  `clave` varchar(45) NOT NULL,
  `estado_registro` enum('A','B') NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id_tipo_parametro`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_tipo_parametro`
--

LOCK TABLES `sys_tipo_parametro` WRITE;
/*!40000 ALTER TABLE `sys_tipo_parametro` DISABLE KEYS */;
INSERT INTO `sys_tipo_parametro` VALUES (1,0,'Parametros de Empresa','EMPRESA','A'),(2,1,'Otro','OTRO','A');
/*!40000 ALTER TABLE `sys_tipo_parametro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `vw_detalle_inventario`
--

DROP TABLE IF EXISTS `vw_detalle_inventario`;
/*!50001 DROP VIEW IF EXISTS `vw_detalle_inventario`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8mb4;
/*!50001 CREATE VIEW `vw_detalle_inventario` AS SELECT 
 1 AS `id_detalle`,
 1 AS `id_encabezado`,
 1 AS `bodega`,
 1 AS `movimiento`,
 1 AS `producto`,
 1 AS `codigo_producto`,
 1 AS `unidades`,
 1 AS `valor_unitario`,
 1 AS `valor`,
 1 AS `valor_iva`,
 1 AS `estado`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_inventario_productos`
--

DROP TABLE IF EXISTS `vw_inventario_productos`;
/*!50001 DROP VIEW IF EXISTS `vw_inventario_productos`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8mb4;
/*!50001 CREATE VIEW `vw_inventario_productos` AS SELECT 
 1 AS `id_producto`,
 1 AS `codigo`,
 1 AS `fecha_creacion`,
 1 AS `descripcion`,
 1 AS `marca`,
 1 AS `modelo`,
 1 AS `tipo_producto`,
 1 AS `estado_producto`,
 1 AS `precio`,
 1 AS `existencia`,
 1 AS `total`,
 1 AS `estado`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_inventario_totales`
--

DROP TABLE IF EXISTS `vw_inventario_totales`;
/*!50001 DROP VIEW IF EXISTS `vw_inventario_totales`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8mb4;
/*!50001 CREATE VIEW `vw_inventario_totales` AS SELECT 
 1 AS `id_operacion`,
 1 AS `empresa`,
 1 AS `sucursal`,
 1 AS `tipo_documento`,
 1 AS `categoria_operacion`,
 1 AS `fecha_operacion`,
 1 AS `serie`,
 1 AS `numero`,
 1 AS `Total`,
 1 AS `proveedor`,
 1 AS `observaciones`,
 1 AS `operador`,
 1 AS `estado`*/;
SET character_set_client = @saved_cs_client;

--
-- Dumping events for database 'id13314013_ids_db'
--

--
-- Dumping routines for database 'id13314013_ids_db'
--
/*!50003 DROP PROCEDURE IF EXISTS `sp_usr_genera_menu` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_usr_genera_menu`(in tipo char(1),entidad int,empresa int)
BEGIN
	IF (tipo='A') then
		select 
			a.* 
		from sys_menu a
		inner join sys_asignacion_menu_grupo b on a.id_menu=b.id_menu
		inner join sys_asignacion_entidad_grupo c on b.id_grupo=c.id_grupo and c.id_entidad=entidad
		where estado_registro='A' and b.id_empresa=empresa
		union
		select 
			a.* 
		from sys_menu a
		inner join sys_asignacion_menu_entidad d on a.id_menu=d.id_menu and d.id_entidad=entidad
		where estado_registro='A' and a.id_empresa=empresa
		order by patron;
	ELSE
    	select 
			a.* 
		from sys_menu a
		where estado_registro='A' and a.id_empresa=empresa
        order by patron;
	END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Final view structure for view `vw_detalle_inventario`
--

/*!50001 DROP VIEW IF EXISTS `vw_detalle_inventario`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_detalle_inventario` AS select `a`.`id_operacion_detalle` AS `id_detalle`,`b`.`id_operacion_encabezado` AS `id_encabezado`,`c`.`descripcion` AS `bodega`,`a`.`tipo_movimiento` AS `movimiento`,`d`.`descripcion` AS `producto`,`d`.`codigo` AS `codigo_producto`,`a`.`unidades` AS `unidades`,`a`.`valor_unitario` AS `valor_unitario`,`a`.`valor` AS `valor`,`a`.`valor_iva` AS `valor_iva`,if((`a`.`estado_registro` = 'A'),'Alta','Baja') AS `estado` from (((`inv_operacion_detalle` `a` left join `inv_operacion_encabezado` `b` on((`a`.`id_operacion_encabezado` = `b`.`id_operacion_encabezado`))) left join `opr_bodega` `c` on((`a`.`id_bodega` = `c`.`id_bodega`))) left join `opr_producto` `d` on((`a`.`id_producto` = `d`.`id_producto`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_inventario_productos`
--

/*!50001 DROP VIEW IF EXISTS `vw_inventario_productos`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_inventario_productos` AS select `a`.`id_producto` AS `id_producto`,`a`.`codigo` AS `codigo`,`a`.`fecha` AS `fecha_creacion`,`a`.`descripcion` AS `descripcion`,`b`.`descripcion` AS `marca`,`c`.`descripcion` AS `modelo`,`d`.`descripcion` AS `tipo_producto`,if(((`a`.`tipo_producto` = 'T') or (`a`.`tipo_producto` = 'P')),'Terminado','Para Preparar') AS `estado_producto`,`a`.`precio` AS `precio`,`a`.`existencia` AS `existencia`,(`a`.`precio` * `a`.`existencia`) AS `total`,if((`a`.`estado_registro` = 'A'),'Alta','Baja') AS `estado` from (((`opr_producto` `a` left join `opr_marca` `b` on((`a`.`id_marca` = `b`.`id_marca`))) left join `opr_modelo` `c` on((`a`.`id_modelo` = `c`.`id_modelo`))) left join `opr_tipo_producto` `d` on((`a`.`id_tipo_producto` = `d`.`id_tipo_producto`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_inventario_totales`
--

/*!50001 DROP VIEW IF EXISTS `vw_inventario_totales`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_inventario_totales` AS select `a`.`id_operacion_encabezado` AS `id_operacion`,`b`.`descripcion` AS `empresa`,`c`.`descripcion` AS `sucursal`,`d`.`descripcion` AS `tipo_documento`,`e`.`descripcion` AS `categoria_operacion`,`a`.`fecha` AS `fecha_operacion`,`a`.`serie` AS `serie`,`a`.`numero` AS `numero`,(select sum(`inv_operacion_detalle`.`valor`) AS `total` from `inv_operacion_detalle` where (`inv_operacion_detalle`.`id_operacion_encabezado` = `id_operacion`)) AS `Total`,`f`.`descripcion` AS `proveedor`,`a`.`observaciones` AS `observaciones`,`g`.`descripcion` AS `operador`,if((`a`.`estado_registro` = 'A'),'Alta','Baja') AS `estado` from ((((((`inv_operacion_encabezado` `a` left join `sys_empresa` `b` on((`a`.`id_empresa` = `b`.`id_empresa`))) left join `opr_sucursal` `c` on((`a`.`id_sucursal` = `c`.`id_sucursal`))) left join `inv_tipo_documento` `d` on((`a`.`id_tipo_documento` = `d`.`id_tipo_documento`))) left join `inv_categoria_operacion` `e` on((`a`.`id_categoria_operacion` = `e`.`id_categoria_operacion`))) left join `opr_proveedor` `f` on((`a`.`id_proveedor` = `f`.`id_proveedor`))) left join `sys_entidad` `g` on((`a`.`id_operador` = `g`.`id_entidad`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-13 23:54:50
