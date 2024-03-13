-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: 50.87.184.179    Database: wsoqajmy_crediweb
-- ------------------------------------------------------
-- Server version	5.7.23-23

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cantidad_consultas`
--

DROP TABLE IF EXISTS `cantidad_consultas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cantidad_consultas` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `fecha_creado` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cantidad_consultas`
--

LOCK TABLES `cantidad_consultas` WRITE;
/*!40000 ALTER TABLE `cantidad_consultas` DISABLE KEYS */;
INSERT INTO `cantidad_consultas` VALUES (21,'0993245543',1,'2024-03-10 22:24:01'),(22,'0993245543',1,'2024-03-10 23:30:27'),(23,'0985458618',1,'2024-03-11 10:33:22'),(24,'0967479760',1,'2024-03-11 14:21:47'),(25,'0988488258',1,'2024-03-11 16:49:23'),(26,'0999390035',1,'2024-03-11 17:35:49'),(27,'0990383315',1,'2024-03-11 18:06:56'),(28,'0999390035',1,'2024-03-12 14:10:14'),(29,'0999390035',1,'2024-03-12 14:37:53');
/*!40000 ALTER TABLE `cantidad_consultas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `creditos_solicitados`
--

DROP TABLE IF EXISTS `creditos_solicitados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `creditos_solicitados` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numero` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `correo` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre_cliente` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_nacimiento` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigo_dactilar` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `credito_aprobado` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT '1',
  `ip` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dispositivo` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_creado` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cedula_encr` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado_encr` int(11) DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `creditos_solicitados`
--

LOCK TABLES `creditos_solicitados` WRITE;
/*!40000 ALTER TABLE `creditos_solicitados` DISABLE KEYS */;
INSERT INTO `creditos_solicitados` VALUES (4,'0919338293','0993245543','samuelmaruri@gmail.com','MARURI SALVATIERRA SAMUEL JOSHUAL','16/10/1993','A1333I1122',1,1,'179.49.32.247','Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:123.0) Gecko/20100101 Firefox/123.0','2024-03-10 22:23:55','HgUXT+qrm2X1jEO3UPIHI1zyHDManOd9wZFqJ2ddjys=\r\n',0),(5,'0930783352','0985458618','ettielvicentep@gmail.com','PIVAQUE PADILLA ETTIEL VICENTE','6/11/1989','E4443V4444',1,1,'181.199.61.104','Mozilla/5.0 (Linux; Android 9; moto g(6) Build/PPS29.118-15-11-16; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/122.0.6261.105 Mobile Safari/537.36[FBAN/EMA;FBLC/es_ES;FBAV/397.0.0.11.117;]','2024-03-11 10:33:16','ONauvc36GGOXK/9KKhsndo2zEZkmyhKNyPHweo5wYrY=\r\n',0),(6,'0951991637','0967479760','Franklinnoel-1996@hotmail.com','SALTOS PIGUABE FRANKLIN NOEL','14/1/1996','E3333I2222',1,1,'200.24.133.196','Mozilla/5.0 (Linux; Android 13; CRT-NX3 Build/HONORCRT-N33; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/122.0.6261.102 Mobile Safari/537.36 [FB_IAB/FB4A;FBAV/454.1.0.49.104;]','2024-03-11 14:21:41','A74E21bzSWIxEx5WQLEUD5Mkg8WQtVL/okwdhRHwhMs=\r\n',0),(7,'0919872184','0988488258','moa_1980_13f@hotmail.es','OSORIO ARZUBE MARIUXI LOURDES','13/2/1980','E3333I3222',1,1,'200.24.135.4','Mozilla/5.0 (Linux; Android 10; STK-LX3 Build/HUAWEISTK-LX3; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/122.0.6261.102 Mobile Safari/537.36 [FB_IAB/FB4A;FBAV/454.1.0.49.104;]','2024-03-11 16:49:17','968lM9uIddjeQQ3gAd8nNsJzEtvZz/jM1OWNxZeyN80=\r\n',0),(8,'0928950021','0999390035','mirjoha.19@gmail.com','SALAZAR CRUZ MIRLEN JOHANNA','17/6/1986','V4443V4442',1,1,'179.0.42.20','Mozilla/5.0 (Linux; Android 11; Infinix X693 Build/RP1A.200720.011; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/122.0.6261.102 Mobile Safari/537.36 [FB_IAB/FB4A;FBAV/454.1.0.49.104;] [FB_IAB/FB4A;FBAV/454.1.0.49.104;]','2024-03-11 17:35:43','nOX5TYKmXibuJolh17C0uqNLRpsE81/8IHxB5RoD+PM=\r\n',0),(9,'0930908181','0990383315','Benrock_104@hotmail.com','CRUZ CHANCAY JULIO ISAAC','12/4/1991','V4444V4444',1,1,'181.188.198.58','Mozilla/5.0 (Linux; Android 13; RMX3241 Build/TP1A.220905.001; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/122.0.6261.66 Mobile Safari/537.36[FBAN/EMA;FBLC/es_ES;FBAV/397.0.0.11.117;]','2024-03-11 18:06:50','W7jtyUIzoxQo5Y+T7b7ltkcJu9SWso79ZJ2IxnIJEWk=\r\n',0),(10,'0023517726',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,'2024-03-11 20:07:52','syJR/u8Km8ckLV2p7IXLtSyMJikKRoIVOtl7hol1sEI=\r\n',0),(11,'0923517726',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,'2024-03-11 20:08:20','0Ldi0RKJJZrwuiMO4bOUXzv7Qkb05ykKlEaHSvkhXE4=\r\n',0),(12,'0923517726',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,'2024-03-11 20:08:58','0Ldi0RKJJZrwuiMO4bOUXzv7Qkb05ykKlEaHSvkhXE4=\r\n',0),(13,'0923517726',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,'2024-03-11 20:32:46','0Ldi0RKJJZrwuiMO4bOUXzv7Qkb05ykKlEaHSvkhXE4=\r\n',0),(14,'0910042332',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,'2024-03-12 07:38:00','WOhLaPT8w0sVK59ZuscBYwN7OqmSdg0HeKS1rkwJBUw=\r\n',0),(15,'0910042332',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,'2024-03-12 07:38:25','WOhLaPT8w0sVK59ZuscBYwN7OqmSdg0HeKS1rkwJBUw=\r\n',0),(16,'0910042332',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,'2024-03-12 07:39:08','WOhLaPT8w0sVK59ZuscBYwN7OqmSdg0HeKS1rkwJBUw=\r\n',0),(17,'0910042332',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,'2024-03-12 07:39:34','WOhLaPT8w0sVK59ZuscBYwN7OqmSdg0HeKS1rkwJBUw=\r\n',0),(18,'0910042332',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,'2024-03-12 07:41:04','WOhLaPT8w0sVK59ZuscBYwN7OqmSdg0HeKS1rkwJBUw=\r\n',0),(19,'0923517726',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,'2024-03-12 08:53:01','0Ldi0RKJJZrwuiMO4bOUXzv7Qkb05ykKlEaHSvkhXE4=\r\n',0),(20,'0705366532',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,'2024-03-12 14:52:10','pNdCNL1YuMzHgBNsDhwc9nHk+Qc93wQZhKgBgD8zm5Q=\r\n',0),(21,'0705366532',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,'2024-03-12 14:52:46','pNdCNL1YuMzHgBNsDhwc9nHk+Qc93wQZhKgBgD8zm5Q=\r\n',0),(22,'0905665295',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,'2024-03-12 15:33:13','P9awKxUSHXGCgwOCXZOA+CuT5v0o0qItLdH/40YVcc0=\r\n',0),(23,'0941358533',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,'2024-03-12 15:34:11','CWN0bXW3wWzYGdBNAe/QU7QNwINn3rUMzm+cih6qUd4=\r\n',0),(24,'0944076983',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,'2024-03-12 15:34:40','0+ALY7Ddh0jVh0DFdO37aba9fPu/wUZCj/qv6hPM5Rw=\r\n',0),(25,'0944076983',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,'2024-03-12 15:34:55','0+ALY7Ddh0jVh0DFdO37aba9fPu/wUZCj/qv6hPM5Rw=\r\n',0),(26,'0958462350',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,'2024-03-12 15:56:16','NoA7ssQfKvp6M9N0gfRdjsNl4HZ4Xk2bYHHNNZ7hmfs=\r\n',0),(27,'0958462350',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,'2024-03-12 15:56:49','NoA7ssQfKvp6M9N0gfRdjsNl4HZ4Xk2bYHHNNZ7hmfs=\r\n',0),(28,'0958462350',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,'2024-03-12 15:57:23','NoA7ssQfKvp6M9N0gfRdjsNl4HZ4Xk2bYHHNNZ7hmfs=\r\n',0),(29,'0951874387',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,'2024-03-12 16:48:14','ZQbXWPSyUHILZt2uIHwsRGM5/hlR1aFFBHXL4GnJwfQ=\r\n',0),(30,'0951874387',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,'2024-03-12 16:49:29','ZQbXWPSyUHILZt2uIHwsRGM5/hlR1aFFBHXL4GnJwfQ=\r\n',0),(31,'0951874387',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,'2024-03-12 16:51:32','ZQbXWPSyUHILZt2uIHwsRGM5/hlR1aFFBHXL4GnJwfQ=\r\n',0),(32,'0951874387',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,'2024-03-12 16:51:43','ZQbXWPSyUHILZt2uIHwsRGM5/hlR1aFFBHXL4GnJwfQ=\r\n',0),(33,'0703056499',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,'2024-03-12 18:35:49','8DDHcDqQVInZO8CVvOFET1h6bMqrdjZZK8hBnr6Z4G8=\r\n',0),(34,'0703056499',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,'2024-03-12 18:36:15','8DDHcDqQVInZO8CVvOFET1h6bMqrdjZZK8hBnr6Z4G8=\r\n',0);
/*!40000 ALTER TABLE `creditos_solicitados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solo_telefonos`
--

DROP TABLE IF EXISTS `solo_telefonos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `solo_telefonos` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigo` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `terminos` int(11) DEFAULT NULL,
  `ip` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dispositivo` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` int(11) DEFAULT '1',
  `fecha_creado` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solo_telefonos`
--

LOCK TABLES `solo_telefonos` WRITE;
/*!40000 ALTER TABLE `solo_telefonos` DISABLE KEYS */;
INSERT INTO `solo_telefonos` VALUES (1,'0993245543','9745',1,'179.49.32.247','Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:123.0) Gecko/20100101 Firefox/123.0',1,'2024-03-10 22:22:59'),(2,'0985458618','1708',1,'181.199.61.104','Mozilla/5.0 (Linux; Android 9; moto g(6) Build/PPS29.118-15-11-16; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/122.0.6261.105 Mobile Safari/537.36[FBAN/EMA;FBLC/es_ES;FBAV/397.0.0.11.117;]',1,'2024-03-11 10:31:45'),(3,'0988894573','9146',1,'157.100.60.215','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',1,'2024-03-11 11:31:54'),(4,'0994457528','2735',1,'190.63.120.176','Mozilla/5.0 (Linux; Android 12; Infinix X669D Build/SP1A.210812.016; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/122.0.6261.105 Mobile Safari/537.36 [FBAN/EMA;FBLC/es_ES;FBAV/397.0.0.11.117;FB_FW/1;FBDM/DisplayMetrics{density=2.0, width=720, height=1444, scaledDensity=2.0, xdpi=268.941, ydpi=269.373};]',1,'2024-03-11 12:04:07'),(5,'0994457428','8654',1,'190.63.120.176','Mozilla/5.0 (Linux; Android 12; Infinix X669D Build/SP1A.210812.016; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/122.0.6261.105 Mobile Safari/537.36[FBAN/EMA;FBLC/es_ES;FBAV/397.0.0.11.117;]',0,'2024-03-11 12:05:21'),(6,'0994457428','3710',1,'190.63.120.176','Mozilla/5.0 (Linux; Android 12; Infinix X669D Build/SP1A.210812.016; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/122.0.6261.105 Mobile Safari/537.36[FBAN/EMA;FBLC/es_ES;FBAV/397.0.0.11.117;]',0,'2024-03-11 12:08:00'),(7,'0994457428','3849',1,'190.63.120.176','Mozilla/5.0 (Linux; Android 12; Infinix X669D Build/SP1A.210812.016; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/122.0.6261.105 Mobile Safari/537.36 [FBAN/EMA;FBLC/es_ES;FBAV/397.0.0.11.117;FB_FW/1;FBDM/DisplayMetrics{density=2.0, width=720, height=1444, scaledDensity=2.0, xdpi=268.941, ydpi=269.373};]',1,'2024-03-11 12:10:04'),(8,'0967479760','1580',1,'200.24.133.196','Mozilla/5.0 (Linux; Android 13; CRT-NX3 Build/HONORCRT-N33; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/122.0.6261.102 Mobile Safari/537.36 [FB_IAB/FB4A;FBAV/454.1.0.49.104;]',1,'2024-03-11 14:20:52'),(9,'0988488258','5504',1,'200.24.135.4','Mozilla/5.0 (Linux; Android 10; STK-LX3 Build/HUAWEISTK-LX3; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/122.0.6261.102 Mobile Safari/537.36 [FB_IAB/FB4A;FBAV/454.1.0.49.104;]',1,'2024-03-11 16:48:38'),(10,'0999390035','9275',1,'179.0.42.20','Mozilla/5.0 (Linux; Android 11; Infinix X693 Build/RP1A.200720.011; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/122.0.6261.102 Mobile Safari/537.36 [FB_IAB/FB4A;FBAV/454.1.0.49.104;] [FB_IAB/FB4A;FBAV/454.1.0.49.104;]',1,'2024-03-11 17:34:22'),(11,'0990383315','9617',1,'181.188.198.58','Mozilla/5.0 (Linux; Android 13; RMX3241 Build/TP1A.220905.001; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/122.0.6261.66 Mobile Safari/537.36[FBAN/EMA;FBLC/es_ES;FBAV/397.0.0.11.117;]',1,'2024-03-11 18:05:27'),(12,'0981296747','4532',1,'181.199.63.132','Mozilla/5.0 (Linux; Android 13; RMX3830 Build/TP1A.220624.014; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/122.0.6261.102 Mobile Safari/537.36 [FB_IAB/FB4A;FBAV/454.1.0.49.104;]',0,'2024-03-11 20:06:57'),(13,'0981296747','7717',1,'181.199.63.132','Mozilla/5.0 (Linux; Android 13; RMX3830 Build/TP1A.220624.014; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/122.0.6261.102 Mobile Safari/537.36 [FB_IAB/FB4A;FBAV/454.1.0.49.104;]',0,'2024-03-11 20:31:53'),(14,'0991615224','2169',1,'181.199.60.155','Mozilla/5.0 (Linux; Android 13; TECNO KI5q Build/TP1A.220624.014; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/122.0.6261.102 Mobile Safari/537.36 [FB_IAB/FB4A;FBAV/454.1.0.49.104;]',0,'2024-03-12 07:36:41'),(15,'0991615224','8981',1,'181.199.60.155','Mozilla/5.0 (Linux; Android 13; TECNO KI5q Build/TP1A.220624.014; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/122.0.6261.102 Mobile Safari/537.36 [FB_IAB/FB4A;FBAV/454.1.0.49.104;] [FB_IAB/FB4A;FBAV/454.1.0.49.104;]',1,'2024-03-12 07:40:12'),(16,'0981296747','4245',1,'190.131.45.159','Mozilla/5.0 (Linux; Android 13; RMX3830 Build/TP1A.220624.014; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/122.0.6261.102 Mobile Safari/537.36 [FB_IAB/FB4A;FBAV/454.1.0.49.104;]',0,'2024-03-12 08:52:02'),(17,'0981296747','1644',1,'190.131.45.159','Mozilla/5.0 (Linux; Android 13; RMX3830 Build/TP1A.220624.014; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/122.0.6261.102 Mobile Safari/537.36 [FB_IAB/FB4A;FBAV/454.1.0.49.104;] [FB_IAB/FB4A;FBAV/454.1.0.49.104;]',1,'2024-03-12 08:56:03'),(18,'0960034914','5456',1,'157.100.106.111','Mozilla/5.0 (Linux; Android 13; Infinix X6835B Build/TP1A.220624.014; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/122.0.6261.102 Mobile Safari/537.36 [FB_IAB/FB4A;FBAV/454.1.0.49.104;]',1,'2024-03-12 13:44:23'),(19,'0982873849','8970',1,'157.100.54.16','Mozilla/5.0 (Linux; Android 13; 220333QAG Build/TKQ1.221114.001; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/122.0.6261.102 Mobile Safari/537.36 [FB_IAB/FB4A;FBAV/454.1.0.49.104;]',1,'2024-03-12 14:51:14'),(20,'0968990513','7412',1,'191.99.28.165','Mozilla/5.0 (Linux; Android 11; M2004J19C Build/RP1A.200720.011; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/122.0.6261.102 Mobile Safari/537.36 [FB_IAB/FB4A;FBAV/454.1.0.49.104;]',0,'2024-03-12 15:00:35'),(21,'0991350331','3540',1,'157.100.112.162','Mozilla/5.0 (Linux; Android 12; TECNO LG7n Build/SP1A.210812.016; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/122.0.6261.102 Mobile Safari/537.36 [FB_IAB/FB4A;FBAV/454.1.0.49.104;]',1,'2024-03-12 15:32:25'),(22,'0967455842','6967',1,'45.239.51.7','Mozilla/5.0 (Linux; Android 12; Infinix X6825 Build/SP1A.210812.016; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/122.0.6261.105 Mobile Safari/537.36[FBAN/EMA;FBLC/es_ES;FBAV/398.0.0.13.113;]',1,'2024-03-12 15:33:09'),(23,'0987179531','3961',1,'200.7.246.236','Mozilla/5.0 (Linux; Android 12; TECNO BF7 Build/SP1A.210812.016; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/122.0.6261.102 Mobile Safari/537.36 [FB_IAB/FB4A;FBAV/454.1.0.49.104;]',0,'2024-03-12 15:48:31'),(24,'0985864260','6970',1,'191.99.93.45','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Mobile Safari/537.36',1,'2024-03-12 15:55:27'),(25,'0987179531','4328',1,'179.0.42.20','Mozilla/5.0 (Linux; Android 12; TECNO BF7 Build/SP1A.210812.016; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/122.0.6261.102 Mobile Safari/537.36 [FB_IAB/FB4A;FBAV/454.1.0.49.104;]',1,'2024-03-12 16:43:08'),(26,'0981505353','2791',1,'181.199.42.129','Mozilla/5.0 (Linux; Android 13; Infinix X6525 Build/TP1A.220624.014; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/122.0.6261.105 Mobile Safari/537.36 [FB_IAB/FB4A;FBAV/448.0.0.47.109;]',1,'2024-03-12 16:45:48'),(27,'0968990513','6780',1,'191.99.52.163','Mozilla/5.0 (Linux; Android 11; M2004J19C Build/RP1A.200720.011; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/122.0.6261.102 Mobile Safari/537.36 [FB_IAB/FB4A;FBAV/454.1.0.49.104;]',1,'2024-03-12 16:48:44'),(28,'0980738978','6389',1,'200.24.133.243','Mozilla/5.0 (Linux; Android 14; SM-A042M Build/UP1A.231005.007; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/122.0.6261.105 Mobile Safari/537.36[FBAN/EMA;FBLC/es_LA;FBAV/398.0.0.13.113;]',1,'2024-03-12 18:35:17');
/*!40000 ALTER TABLE `solo_telefonos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pass` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_creado` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'admin','admin12345','2024-03-10 18:38:43',1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'wsoqajmy_crediweb'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-03-12 20:17:55
