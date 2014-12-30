CREATE DATABASE  IF NOT EXISTS `bd_POIWebApp` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `bd_POIWebApp`;
-- MySQL dump 10.13  Distrib 5.6.19, for osx10.7 (i386)
--
-- Host: 160.153.55.7    Database: bd_POIWebApp
-- ------------------------------------------------------
-- Server version	5.5.36-cll-lve

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `affiliate`
--

DROP TABLE IF EXISTS `affiliate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `affiliate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_597AA5CFE7927C74` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `affiliate`
--

LOCK TABLES `affiliate` WRITE;
/*!40000 ALTER TABLE `affiliate` DISABLE KEYS */;
/*!40000 ALTER TABLE `affiliate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pinhexcolor` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_64C19C15E237E06` (`name`),
  UNIQUE KEY `UNIQ_64C19C1989D9B62` (`slug`),
  UNIQUE KEY `UNIQ_64C19C1C53D045F` (`image`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'PEAJE','PEAJE','peaje','category-1.jpg','040645'),(2,'RESTRICCIONES OPERATIVAS','RESTRICCIONES OPERATIVAS','restricciones-operativas','category-2.jpg','ffffff'),(3,'PUNTOS DE INSPECCION','PUNTOS DE INSPECCION','puntos-de-inspeccion','category-3.jpg','efec18'),(4,'ESTACIONES DE SERVICIO AUTORIZADAS','ESTACIONES DE SERVICIO AUTORIZADAS','estaciones-de-servicio-autorizadas','category-4.jpg','9bfd00'),(5,'PUNTOS DE ATENCION Y ASISTENCIA (ANTIDERRAMES)','PUNTOS DE ATENCION Y ASISTENCIA (ANTIDERRAMES)','puntos-de-atencion-y-asistencia-antiderrames','category-5.jpg','2b4404'),(6,'ZONAS CON PRECENCIA DE GUERRILLA','ZONAS CON PRECENCIA DE GUERRILLA','zonas-con-precencia-de-guerrilla','category-6.jpg','e29722'),(7,'PROBLEMAS CON COMUNIDADES','PROBLEMAS CON COMUNIDADES','problemas-con-comunidades','category-7.jpg','fb040a'),(8,'PATIOS DE ENRUTAMIENTO','PATIOS DE ENRUTAMIENTO','patios-de-enrutamiento','category-8.jpg','f4009b'),(9,'PATIOS DE ALMACENAMIENTO DE CONTAINERS','PATIOS DE ALMACENAMIENTO DE CONTAINERS','patios-de-almacenamiento-de-containers','category-9.jpg','7ebc80'),(10,'HOTELES APROBADOS PARA CONDUCTORES DE IMPALA','HOTELES APROBADOS PARA CONDUCTORES DE IMPALA','hoteles-aprobados-para-conductores-de-impala','category-10.jpg','cdcdcd'),(11,'OLEODUCTOS','OLEODUCTOS','oleoductos','category-11.jpg','04befb'),(12,'PUNTOS DE INYECCION','PUNTOS DE INYECCION','puntos-de-inyeccion','category-12.jpg','0052a5'),(13,'EMPRESA DE TRANSPORTES','EMPRESA DE TRANSPORTES','empresa-de-transportes','category-13.jpg','0052a5'),(14,'PUERTOS','PUERTOS','puertos','category-14.jpg','0052a5'),(15,'ZONAS FRANCAS','ZONAS FRANCAS','zonas-francas','category-15.jpg','0052a5'),(16,'DEPOSITOS ADUANEROS','DEPOSITOS ADUANEROS','depositos-aduaneros','category-16.jpg','0052a5'),(17,'POZOS DE PRODUCCIÓN','POZOS DE PRODUCCIÓN','pozos-de-producci-n',NULL,'FF9900');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_affiliate`
--

DROP TABLE IF EXISTS `category_affiliate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category_affiliate` (
  `affiliate_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`affiliate_id`,`category_id`),
  KEY `IDX_9E1A77FF9F12C49A` (`affiliate_id`),
  KEY `IDX_9E1A77FF12469DE2` (`category_id`),
  CONSTRAINT `FK_9E1A77FF12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `FK_9E1A77FF9F12C49A` FOREIGN KEY (`affiliate_id`) REFERENCES `affiliate` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_affiliate`
--

LOCK TABLES `category_affiliate` WRITE;
/*!40000 ALTER TABLE `category_affiliate` DISABLE KEYS */;
/*!40000 ALTER TABLE `category_affiliate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `geo_cities`
--

DROP TABLE IF EXISTS `geo_cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `geo_cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `id_state` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `geo_states_id_state_idx` (`id_state`),
  CONSTRAINT `FK_728C88154D1693CB` FOREIGN KEY (`id_state`) REFERENCES `geo_states` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1127 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `geo_cities`
--

LOCK TABLES `geo_cities` WRITE;
/*!40000 ALTER TABLE `geo_cities` DISABLE KEYS */;
INSERT INTO `geo_cities` VALUES (1,'Sin Municipio',0),(2,'Bogota',100),(3,'Cartagena',13),(4,'Calamar',13),(5,'Cantagallo',13),(6,'Cicuco',13),(7,'Cordoba',13),(8,'Clemencia',13),(9,'El Carmen de Bolivar',13),(10,'El Guamo',13),(11,'El Peñon',13),(12,'Altos del Rosario',13),(13,'Hatillo de Loba',13),(14,'Arenal',13),(15,'Magangue',13),(16,'Mahates',13),(17,'Margarita',13),(18,'Maria la Baja',13),(19,'Montecristo',13),(20,'Mompos',13),(21,'Morales',13),(22,'Arjona',13),(23,'Pinillos',13),(24,'Regidor',13),(25,'Achi',13),(26,'Rio Viejo',13),(27,'Arroyohondo',13),(28,'San Cristobal',13),(29,'San Estanislao',13),(30,'San Fernando',13),(31,'San Jacinto',13),(32,'San Jacinto del Cauca',13),(33,'San Juan Nepomuceno',13),(34,'San Martin de Loba',13),(35,'San Pablo',13),(36,'Santa Catalina',13),(37,'Santa Rosa',13),(38,'Santa Rosa del sur',13),(39,'Barranco de Loba',13),(40,'Simiti',13),(41,'Soplaviento',13),(42,'Talaigua Nuevo',13),(43,'Tiquisio',13),(44,'Turbaco',13),(45,'Turbana',13),(46,'Villanueva',13),(47,'Zambrano',13),(48,'Tunja',15),(49,'Boyaca',15),(50,'Briceño',15),(51,'Buenavista',15),(52,'Busbanza',15),(53,'Caldas',15),(54,'Campohermoso',15),(55,'Cerinza',15),(56,'Chinavita',15),(57,'Chiquinquira',15),(58,'Chiscas',15),(59,'Chita',15),(60,'Chitaraque',15),(61,'Chivata',15),(62,'Cienega',15),(63,'Combita',15),(64,'Coper',15),(65,'Corrales',15),(66,'Covarachia',15),(67,'Almeida',15),(68,'Cubara',15),(69,'Cucaita',15),(70,'Cuitiva',15),(71,'Chiquiza',15),(72,'Chivor',15),(73,'Duitama',15),(74,'El Cocuy',15),(75,'El Espino',15),(76,'Firavitoba',15),(77,'Floresta',15),(78,'Gachantiva',15),(79,'Gameza',15),(80,'Garagoa',15),(81,'Guacamayas',15),(82,'Guateque',15),(83,'Guayata',15),(84,'Guican',15),(85,'Iza',15),(86,'Jenesano',15),(87,'Jerico',15),(88,'Labranzagrande',15),(89,'La Capilla',15),(90,'La Victoria',15),(91,'La Uvita',15),(92,'Villa de Leyva',15),(93,'Macanal',15),(94,'Maripi',15),(95,'Miraflores',15),(96,'Mongua',15),(97,'Mongui',15),(98,'Moniquira',15),(99,'Aquitania',15),(100,'Motavita',15),(101,'Muzo',15),(102,'Nobsa',15),(103,'Nuevo Colon',15),(104,'Oicata',15),(105,'Otanche',15),(106,'Arcabuco',15),(107,'Pachavita',15),(108,'Paez',15),(109,'Paipa',15),(110,'Pajarito',15),(111,'Panqueba',15),(112,'Pauna',15),(113,'Paya',15),(114,'paz de rio',15),(115,'Pesca',15),(116,'Pisba',15),(117,'Puerto Boyaca',15),(118,'Quipama',15),(119,'Ramiriqui',15),(120,'Raquira',15),(121,'Rondon',15),(122,'Saboya',15),(123,'Sachica',15),(124,'Samaca',15),(125,'San Eduardo',15),(126,'San Jose de Pare',15),(127,'San Luis de Gaceno',15),(128,'San Mateo',15),(129,'San Miguel de Sema',15),(130,'San Pablo de Borbur',15),(131,'Santana',15),(132,'Santa Maria',15),(133,'Santa Rosa de Viterbo',15),(134,'Santa Sofia',15),(135,'Sativanorte',15),(136,'Sativasur',15),(137,'Siachoque',15),(138,'Soata',15),(139,'Socota',15),(140,'Socha',15),(141,'Sogamoso',15),(142,'Somondoco',15),(143,'Sora',15),(144,'Sotaquira',15),(145,'Soraca',15),(146,'Susacon',15),(147,'Sutamarchan',15),(148,'Sutatenza',15),(149,'Tasco',15),(150,'Tenza',15),(151,'Tibana',15),(152,'Tibasosa',15),(153,'Tinjaca',15),(154,'Tipacoque',15),(155,'Toca',15),(156,'Togui',15),(157,'Topaga',15),(158,'Tota',15),(159,'Tunungua',15),(160,'Turmeque',15),(161,'Tuta',15),(162,'Tutaza',15),(163,'Umbita',15),(164,'Ventaquemada',15),(165,'Belen',15),(166,'Viracacha',15),(167,'Zetaquira',15),(168,'Berbeo',15),(169,'Beteitiva',15),(170,'Boavita',15),(171,'Manizales',17),(172,'Aguadas',17),(173,'Chinchina',17),(174,'Filadelfia',17),(175,'la Dorada',17),(176,'La Merced',17),(177,'Anserma',17),(178,'Manzanares',17),(179,'Marmato',17),(180,'Marquetalia',17),(181,'Marulanda',17),(182,'Neira',17),(183,'Norcasia',17),(184,'Aranzazu',17),(185,'Pacora',17),(186,'Palestina',17),(187,'Pensilvania',17),(188,'Riosucio',17),(189,'Risaralda',17),(190,'Salamina',17),(191,'Samana',17),(192,'San Jose',17),(193,'Supia',17),(194,'Victoria',17),(195,'Villamaria',17),(196,'Viterbo',17),(197,'Belalcazar',17),(198,'Florencia',18),(199,'Cartagena del Chaira',18),(200,'Curillo',18),(201,'El Doncello',18),(202,'El Paujil',18),(203,'Albania',18),(204,'La Montañita',18),(205,'Milan',18),(206,'Morelia',18),(207,'Puerto Rico',18),(208,'San Jose del Fragua',18),(209,'San Vicente del Caguan',18),(210,'Solano',18),(211,'Solita',18),(212,'Valparaiso',18),(213,'Belen de los Andaquies',18),(214,'Popayan',19),(215,'Bolivar',19),(216,'Buenos Aires',19),(217,'Cajibio',19),(218,'Caldono',19),(219,'Caloto',19),(220,'Corinto',19),(221,'Almaguer',19),(222,'El Tambo',19),(223,'Florencia',19),(224,'Guapi',19),(225,'Inza',19),(226,'Jambalo',19),(227,'La Sierra',19),(228,'La Vega',19),(229,'Lopez',19),(230,'Mercaderes',19),(231,'Miranda',19),(232,'Morales',19),(233,'Argelia',19),(234,'Padilla',19),(235,'Paez',19),(236,'Patia',19),(237,'Piamonte',19),(238,'Piendamo',19),(239,'Puerto Tejada',19),(240,'Purace',19),(241,'Rosas',19),(242,'San Sebastian',19),(243,'Santander de Quilichao',19),(244,'Santa Rosa',19),(245,'Silvia',19),(246,'Balboa',19),(247,'Sotara',19),(248,'Suarez',19),(249,'Sucre',19),(250,'Timbio',19),(251,'Timbiqui',19),(252,'Toribio',19),(253,'Totoro',19),(254,'Villa Rica',19),(255,'Valledupar',20),(256,'Aguachica',20),(257,'Agustin Codazzi',20),(258,'Chimichagua',20),(259,'Chiriguana',20),(260,'Curumani',20),(261,'El Copey',20),(262,'El Paso',20),(263,'Gamarra',20),(264,'Gonzalez',20),(265,'Astrea',20),(266,'La Gloria',20),(267,'La Jagua de Ibirico',20),(268,'Manaure Balcon del Cesar',20),(269,'Becerril',20),(270,'Pailitas',20),(271,'Pelaya',20),(272,'Pueblo Bello',20),(273,'Bosconia',20),(274,'Rio de Oro',20),(275,'La paz',20),(276,'La paz (Robles)',20),(277,'San Alberto',20),(278,'San Diego',20),(279,'San Martin',20),(280,'Tamalameque',20),(281,'Monteria',23),(282,'Cerete',23),(283,'Chima',23),(284,'Chinu',23),(285,'Cienaga de oro',23),(286,'Cotorra',23),(287,'La Apartada',23),(288,'Lorica',23),(289,'los Cordobas',23),(290,'Momil',23),(291,'Montelibano',23),(292,'Moñitos',23),(293,'Planeta Rica',23),(294,'Pueblo Nuevo',23),(295,'Puerto Escondido',23),(296,'Puerto Libertador',23),(297,'Purisima',23),(298,'Sahagun',23),(299,'San Andres Sotavento',23),(300,'San Antero',23),(301,'San Bernardo del Viento',23),(302,'San Carlos',23),(303,'Ayapel',23),(304,'San Pelayo',23),(305,'Buenavista',23),(306,'Tierralta',23),(307,'Valencia',23),(308,'Canalete',23),(309,'Agua de Dios',25),(310,'Cabrera',25),(311,'Cachipay',25),(312,'Cajica',25),(313,'Caparrapi',25),(314,'Caqueza',25),(315,'Carmen de Carupa',25),(316,'Chaguani',25),(317,'Chia',25),(318,'Chipaque',25),(319,'Choachi',25),(320,'Choconta',25),(321,'Alban',25),(322,'Cogua',25),(323,'Cota',25),(324,'Cucunuba',25),(325,'El Colegio',25),(326,'El Peñon',25),(327,'El Rosal',25),(328,'Facatativa',25),(329,'Fomeque',25),(330,'Fosca',25),(331,'Funza',25),(332,'Fuquene',25),(333,'Fusagasuga',25),(334,'Gachala',25),(335,'Gachancipa',25),(336,'Gacheta',25),(337,'Gama',25),(338,'Girardot',25),(339,'Granada',25),(340,'Guacheta',25),(341,'Guaduas',25),(342,'Guasca',25),(343,'Guataqui',25),(344,'Guatavita',25),(345,'Guayabal de Siquima',25),(346,'Guayabetal',25),(347,'Gutierrez',25),(348,'Anapoima',25),(349,'Jerusalen',25),(350,'Junin',25),(351,'La Calera',25),(352,'La Mesa',25),(353,'La Palma',25),(354,'La Peña',25),(355,'Anolaima',25),(356,'La Vega',25),(357,'Lenguazaque',25),(358,'Macheta',25),(359,'Madrid',25),(360,'Manta',25),(361,'Medina',25),(362,'Mosquera',25),(363,'Nariño',25),(364,'Nemocon',25),(365,'Nilo',25),(366,'Nimaima',25),(367,'Nocaima',25),(368,'Venecia',25),(369,'Pacho',25),(370,'Paime',25),(371,'Pandi',25),(372,'Arbelaez',25),(373,'Paratebueno',25),(374,'Pasca',25),(375,'Puerto Salgar',25),(376,'Puli',25),(377,'Quebradanegra',25),(378,'Quetame',25),(379,'Quipile',25),(380,'Apulo',25),(381,'Ricaurte',25),(382,'San Antonio del Tequendama',25),(383,'San Bernardo',25),(384,'San Cayetano',25),(385,'San Francisco',25),(386,'San Juan de rio Seco',25),(387,'Sasaima',25),(388,'Sesquile',25),(389,'Sibate',25),(390,'Silvania',25),(391,'Simijaca',25),(392,'Soacha',25),(393,'Sopo',25),(394,'Subachoque',25),(395,'Suesca',25),(396,'Supata',25),(397,'Susa',25),(398,'Sutatausa',25),(399,'Tabio',25),(400,'Tausa',25),(401,'Tena',25),(402,'Tenjo',25),(403,'Tibacuy',25),(404,'Tibirita',25),(405,'Tocaima',25),(406,'Tocancipa',25),(407,'Topaipi',25),(408,'Ubala',25),(409,'Ubaque',25),(410,'Ubate',25),(411,'une',25),(412,'Utica',25),(413,'Beltran',25),(414,'Vergara',25),(415,'Viani',25),(416,'Villagomez',25),(417,'Villapinzon',25),(418,'Villeta',25),(419,'Viota',25),(420,'Yacopi',25),(421,'Zipacon',25),(422,'Zipaquira',25),(423,'Bituima',25),(424,'Bojaca',25),(425,'Quibdo',27),(426,'El Canton del san Pablo',27),(427,'Carmen del Darien',27),(428,'Certegui',27),(429,'Condoto',27),(430,'El Carmen de Atrato',27),(431,'Alto Baudo',27),(432,'El Litoral del san Juan',27),(433,'Istmina',27),(434,'Jurado',27),(435,'Lloro',27),(436,'Medio Atrato',27),(437,'Medio Baudo',27),(438,'Medio san Juan',27),(439,'Novita',27),(440,'Nuqui',27),(441,'Atrato',27),(442,'Rio Iro',27),(443,'Acandi',27),(444,'Rio Quito',27),(445,'Riosucio',27),(446,'San Jose del Palmar',27),(447,'Bagado',27),(448,'Sipi',27),(449,'Bahia Solano',27),(450,'Bajo Baudo',27),(451,'Tado',27),(452,'Unguia',27),(453,'Union Panamericana',27),(454,'Belen de Bajira',27),(455,'Malpelo',27),(456,'Bojaya',27),(457,'Neiva',41),(458,'Agrado',41),(459,'Campoalegre',41),(460,'Aipe',41),(461,'Algeciras',41),(462,'Colombia',41),(463,'Elias',41),(464,'Altamira',41),(465,'Garzon',41),(466,'Gigante',41),(467,'Guadalupe',41),(468,'Hobo',41),(469,'Iquira',41),(470,'Isnos',41),(471,'La Argentina',41),(472,'La Plata',41),(473,'Nataga',41),(474,'Oporapa',41),(475,'Paicol',41),(476,'Palermo',41),(477,'Palestina',41),(478,'Pital',41),(479,'Pitalito',41),(480,'Acevedo',41),(481,'Rivera',41),(482,'Saladoblanco',41),(483,'San Agustin',41),(484,'Santa Maria',41),(485,'Suaza',41),(486,'Baraya',41),(487,'Tarqui',41),(488,'Tesalia',41),(489,'Tello',41),(490,'Teruel',41),(491,'Timana',41),(492,'Villavieja',41),(493,'Yaguara',41),(494,'Riohacha',44),(495,'El Molino',44),(496,'Fonseca',44),(497,'Albania',44),(498,'Hatonuevo',44),(499,'La Jagua del Pilar',44),(500,'Maicao',44),(501,'Manaure',44),(502,'San Juan del Cesar',44),(503,'Barrancas',44),(504,'Uribia',44),(505,'Urumita',44),(506,'Villanueva',44),(507,'Dibulla',44),(508,'Distraccion',44),(509,'Santa Marta',47),(510,'Cerro san Antonio',47),(511,'Chibolo',47),(512,'Cienaga',47),(513,'Concordia',47),(514,'El Banco',47),(515,'El Piñon',47),(516,'El Reten',47),(517,'Fundacion',47),(518,'Algarrobo',47),(519,'Guamal',47),(520,'Nueva Granada',47),(521,'Aracataca',47),(522,'Pedraza',47),(523,'Pijiño del Carmen',47),(524,'Pivijay',47),(525,'Plato',47),(526,'Puebloviejo',47),(527,'Ariguani',47),(528,'Ariguani (el Dificil)',47),(529,'Remolino',47),(530,'Sabanas de san Angel',47),(531,'Salamina',47),(532,'San Sebastian de Buenavista',47),(533,'San Zenon',47),(534,'Santa ana',47),(535,'Santa Barbara de Pinto',47),(536,'Sitionuevo',47),(537,'Tenerife',47),(538,'Zapayan',47),(539,'Zona Bananera',47),(540,'Medellin',5),(541,'Ciudad Bolivar',5),(542,'Briceño',5),(543,'Buritica',5),(544,'Caceres',5),(545,'Caicedo',5),(546,'Caldas',5),(547,'Campamento',5),(548,'Cañasgordas',5),(549,'Caracoli',5),(550,'Caramanta',5),(551,'Carepa',5),(552,'El Carmen de Viboral',5),(553,'Carolina',5),(554,'Caucasia',5),(555,'Chigorodo',5),(556,'Cisneros',5),(557,'Cocorna',5),(558,'Abejorral',5),(559,'Concepcion',5),(560,'Concordia',5),(561,'Alejandria',5),(562,'Copacabana',5),(563,'Dabeiba',5),(564,'Don Matias',5),(565,'Ebejico',5),(566,'El Bagre',5),(567,'Entrerrios',5),(568,'Envigado',5),(569,'Fredonia',5),(570,'Frontino',5),(571,'Amaga',5),(572,'Giraldo',5),(573,'Girardota',5),(574,'Amalfi',5),(575,'Gomez Plata',5),(576,'Granada',5),(577,'Guadalupe',5),(578,'Guarne',5),(579,'Guatape',5),(580,'Andes',5),(581,'Heliconia',5),(582,'Hispania',5),(583,'Angelopolis',5),(584,'Itagui',5),(585,'Ituango',5),(586,'Jardin',5),(587,'Jerico',5),(588,'La Ceja',5),(589,'Angostura',5),(590,'La Estrella',5),(591,'La Pintada',5),(592,'Abriaqui',5),(593,'Anori',5),(594,'La Union',5),(595,'Liborina',5),(596,'Antioquia',5),(597,'Maceo',5),(598,'Anza',5),(599,'Marinilla',5),(600,'Apartado',5),(601,'Montebello',5),(602,'Murindo',5),(603,'Mutata',5),(604,'Nariño',5),(605,'Necocli',5),(606,'Nechi',5),(607,'Olaya',5),(608,'Arboletes',5),(609,'Peñol',5),(610,'Peque',5),(611,'Argelia',5),(612,'Pueblorrico',5),(613,'Puerto Berrio',5),(614,'Puerto Nare',5),(615,'Armenia',5),(616,'Puerto Triunfo',5),(617,'Remedios',5),(618,'Retiro',5),(619,'Rionegro',5),(620,'Sabanalarga',5),(621,'Sabaneta',5),(622,'Salgar',5),(623,'San Andres',5),(624,'San Carlos',5),(625,'San Francisco',5),(626,'San Jeronimo',5),(627,'San Jose de la Montaña',5),(628,'San Juan de Uraba',5),(629,'San Luis',5),(630,'San Pedro',5),(631,'San Pedro de Uraba',5),(632,'San Rafael',5),(633,'San Roque',5),(634,'San Vicente',5),(635,'Santa Barbara',5),(636,'Santa Rosa de Osos',5),(637,'Santo Domingo',5),(638,'El Santuario',5),(639,'Segovia',5),(640,'Sonson',5),(641,'Sopetran',5),(642,'Tamesis',5),(643,'Barbosa',5),(644,'Taraza',5),(645,'Tarso',5),(646,'Titiribi',5),(647,'Toledo',5),(648,'Turbo',5),(649,'Uramita',5),(650,'Urrao',5),(651,'Valdivia',5),(652,'Valparaiso',5),(653,'Vegachi',5),(654,'Belmira',5),(655,'Venecia',5),(656,'Vigia del Fuerte',5),(657,'Bello',5),(658,'Yali',5),(659,'Yarumal',5),(660,'Yolombo',5),(661,'Yondo',5),(662,'Zaragoza',5),(663,'Betania',5),(664,'Betulia',5),(665,'Villavicencio',50),(666,'Barranca de Upia',50),(667,'Cabuyaro',50),(668,'Castilla la Nueva',50),(669,'Cubarral',50),(670,'Cumaral',50),(671,'El Calvario',50),(672,'El Castillo',50),(673,'El Dorado',50),(674,'Fuente de oro',50),(675,'Granada',50),(676,'Guamal',50),(677,'Mapiripan',50),(678,'Mesetas',50),(679,'La Macarena',50),(680,'Uribe',50),(681,'Lejanias',50),(682,'Puerto Concordia',50),(683,'Puerto Gaitan',50),(684,'Puerto Lopez',50),(685,'Puerto Lleras',50),(686,'Puerto Rico',50),(687,'Acacias',50),(688,'Restrepo',50),(689,'San Carlos de Guaroa',50),(690,'San Juan de Arama',50),(691,'San Juanito',50),(692,'San Martin',50),(693,'Vistahermosa',50),(694,'Pasto',52),(695,'Buesaco',52),(696,'Alban',52),(697,'Colon',52),(698,'Consaca',52),(699,'Contadero',52),(700,'Cordoba',52),(701,'Aldana',52),(702,'Cuaspud',52),(703,'Cumbal',52),(704,'Cumbitara',52),(705,'Chachagui',52),(706,'El Charco',52),(707,'El Peñol',52),(708,'El Rosario',52),(709,'El Tablon',52),(710,'El Tablon de Gomez',52),(711,'El Tambo',52),(712,'Funes',52),(713,'Guachucal',52),(714,'Guaitarilla',52),(715,'Gualmatan',52),(716,'Iles',52),(717,'Imues',52),(718,'Ipiales',52),(719,'Ancuya',52),(720,'La Cruz',52),(721,'La Florida',52),(722,'La Llanada',52),(723,'La Tola',52),(724,'La Union',52),(725,'Leiva',52),(726,'Linares',52),(727,'los Andes',52),(728,'Magui',52),(729,'Mallama',52),(730,'Mosquera',52),(731,'Nariño',52),(732,'Olaya Herrera',52),(733,'Ospina',52),(734,'Arboleda',52),(735,'Arboleda (Berruecos)',52),(736,'Francisco Pizarro',52),(737,'Policarpa',52),(738,'Potosi',52),(739,'Providencia',52),(740,'Puerres',52),(741,'Pupiales',52),(742,'Ricaurte',52),(743,'Roberto Payan',52),(744,'Samaniego',52),(745,'Sandona',52),(746,'San Bernardo',52),(747,'San Lorenzo',52),(748,'San Pablo',52),(749,'San Pedro de Cartago',52),(750,'Santa Barbara',52),(751,'Santacruz',52),(752,'Sapuyes',52),(753,'Taminango',52),(754,'Tangua',52),(755,'Barbacoas',52),(756,'Belen',52),(757,'Tumaco',52),(758,'Tuquerres',52),(759,'Yacuanquer',52),(760,'Cucuta',54),(761,'Bucarasica',54),(762,'Cacota',54),(763,'Cachira',54),(764,'Chinacota',54),(765,'Chitaga',54),(766,'Convencion',54),(767,'Cucutilla',54),(768,'Durania',54),(769,'El Carmen',54),(770,'El Tarra',54),(771,'El Zulia',54),(772,'Abrego',54),(773,'Gramalote',54),(774,'Hacari',54),(775,'Herran',54),(776,'Labateca',54),(777,'La Esperanza',54),(778,'La Playa',54),(779,'los Patios',54),(780,'Lourdes',54),(781,'Mutiscua',54),(782,'Ocaña',54),(783,'Arboledas',54),(784,'Pamplona',54),(785,'Pamplonita',54),(786,'Puerto Santander',54),(787,'Ragonvalia',54),(788,'Salazar',54),(789,'San Calixto',54),(790,'San Cayetano',54),(791,'Santiago',54),(792,'Sardinata',54),(793,'Silos',54),(794,'Teorama',54),(795,'Tibu',54),(796,'Toledo',54),(797,'Villa Caro',54),(798,'Villa del Rosario',54),(799,'Bochalema',54),(800,'Armenia',63),(801,'Buenavista',63),(802,'Calarca',63),(803,'Circasia',63),(804,'Cordoba',63),(805,'Filandia',63),(806,'Genova',63),(807,'La Tebaida',63),(808,'Montenegro',63),(809,'Pijao',63),(810,'Quimbaya',63),(811,'Salento',63),(812,'Pereira',66),(813,'Dos Quebradas',66),(814,'Guatica',66),(815,'La Celia',66),(816,'La Virginia',66),(817,'Marsella',66),(818,'Apia',66),(819,'Mistrato',66),(820,'Pueblo Rico',66),(821,'Quinchia',66),(822,'Santa Rosa de Cabal',66),(823,'Santuario',66),(824,'Balboa',66),(825,'Belen de Umbria',66),(826,'Bucaramanga',68),(827,'Bolivar',68),(828,'Cabrera',68),(829,'Aguada',68),(830,'California',68),(831,'Capitanejo',68),(832,'Carcasi',68),(833,'Cepita',68),(834,'Cerrito',68),(835,'Charala',68),(836,'Charta',68),(837,'Chima',68),(838,'Chipata',68),(839,'Cimitarra',68),(840,'Albania',68),(841,'Concepcion',68),(842,'Confines',68),(843,'Contratacion',68),(844,'Coromoro',68),(845,'Curiti',68),(846,'El Carmen',68),(847,'El Carmen de Chucuri',68),(848,'El Guacamayo',68),(849,'El Peñon',68),(850,'El Playon',68),(851,'Encino',68),(852,'Enciso',68),(853,'Florian',68),(854,'Floridablanca',68),(855,'Galan',68),(856,'Gambita',68),(857,'Giron',68),(858,'Guaca',68),(859,'Guadalupe',68),(860,'Guapota',68),(861,'Guavata',68),(862,'Guepsa',68),(863,'Hato',68),(864,'Jesus Maria',68),(865,'Jordan',68),(866,'La Belleza',68),(867,'Landazuri',68),(868,'La paz',68),(869,'Lebrija',68),(870,'los Santos',68),(871,'Macaravita',68),(872,'Malaga',68),(873,'Matanza',68),(874,'Mogotes',68),(875,'Molagavita',68),(876,'Ocamonte',68),(877,'Oiba',68),(878,'Onzaga',68),(879,'Aratoca',68),(880,'Palmar',68),(881,'Palmas del Socorro',68),(882,'Paramo',68),(883,'Piedecuesta',68),(884,'Pinchote',68),(885,'Puente Nacional',68),(886,'Puerto Parra',68),(887,'Puerto Wilches',68),(888,'Rionegro',68),(889,'Sabana de Torres',68),(890,'San Andres',68),(891,'San Benito',68),(892,'San Gil',68),(893,'San Joaquin',68),(894,'San Jose de Miranda',68),(895,'San Miguel',68),(896,'San Vicente de Chucuri',68),(897,'Santa Barbara',68),(898,'Santa Helena del Opon',68),(899,'Simacota',68),(900,'Socorro',68),(901,'Barbosa',68),(902,'Suaita',68),(903,'Sucre',68),(904,'Surata',68),(905,'Barichara',68),(906,'Barrancabermeja',68),(907,'Tona',68),(908,'Valle de san Jose',68),(909,'Velez',68),(910,'Vetas',68),(911,'Villanueva',68),(912,'Zapatoca',68),(913,'Betulia',68),(914,'Sincelejo',70),(915,'Buenavista',70),(916,'Caimito',70),(917,'Coloso',70),(918,'Corozal',70),(919,'Coveñas',70),(920,'Chalan',70),(921,'El Roble',70),(922,'Galeras',70),(923,'Guaranda',70),(924,'La Union',70),(925,'Los Palmitos',70),(926,'Majagual',70),(927,'Morroa',70),(928,'Ovejas',70),(929,'Palmito',70),(930,'Sampues',70),(931,'San Benito Abad',70),(932,'San Juan de Betulia',70),(933,'San Marcos',70),(934,'San Onofre',70),(935,'San Pedro',70),(936,'Since',70),(937,'Sucre',70),(938,'Tolu',70),(939,'Tolu Viejo',70),(940,'Ibague',73),(941,'Cajamarca',73),(942,'Carmen de Apicala',73),(943,'Casabianca',73),(944,'Chaparral',73),(945,'Coello',73),(946,'Coyaima',73),(947,'Cunday',73),(948,'Dolores',73),(949,'Alpujarra',73),(950,'Alvarado',73),(951,'Espinal',73),(952,'Falan',73),(953,'Flandes',73),(954,'Fresno',73),(955,'Ambalema',73),(956,'Guamo',73),(957,'Herveo',73),(958,'Honda',73),(959,'Icononzo',73),(960,'Lerida',73),(961,'Libano',73),(962,'Anzoategui',73),(963,'Mariquita',73),(964,'Melgar',73),(965,'Murillo',73),(966,'Natagaima',73),(967,'Ortega',73),(968,'Palocabildo',73),(969,'Piedras',73),(970,'Armero',73),(971,'Planadas',73),(972,'Prado',73),(973,'Purificacion',73),(974,'Rioblanco',73),(975,'Roncesvalles',73),(976,'Rovira',73),(977,'Ataco',73),(978,'Saldaña',73),(979,'San Antonio',73),(980,'San Luis',73),(981,'Santa Isabel',73),(982,'Suarez',73),(983,'Valle de san Juan',73),(984,'Venadillo',73),(985,'Villahermosa',73),(986,'Villarrica',73),(987,'Cali',76),(988,'Bolivar',76),(989,'Buenaventura',76),(990,'Buga',76),(991,'Bugalagrande',76),(992,'Caicedonia',76),(993,'Calima',76),(994,'Candelaria',76),(995,'Cartago',76),(996,'Alcala',76),(997,'Dagua',76),(998,'El Aguila',76),(999,'San Gil',76),(1000,'El Cerrito',76),(1001,'El Dovio',76),(1002,'Florida',76),(1003,'Ginebra',76),(1004,'Guacari',76),(1005,'Andalucia',76),(1006,'Jamundi',76),(1007,'La Cumbre',76),(1008,'La Union',76),(1009,'La Victoria',76),(1010,'Ansermanuevo',76),(1011,'Obando',76),(1012,'Palmira',76),(1013,'Argelia',76),(1014,'Pradera',76),(1015,'Restrepo',76),(1016,'Riofrio',76),(1017,'Roldanillo',76),(1018,'san Pedro',76),(1019,'Sevilla',76),(1020,'Toro',76),(1021,'Trujillo',76),(1022,'Tulua',76),(1023,'Ulloa',76),(1024,'Versalles',76),(1025,'Vijes',76),(1026,'Yotoco',76),(1027,'Yumbo',76),(1028,'Zarzal',76),(1029,'Barranquilla',8),(1030,'Campo de la Cruz',8),(1031,'Candelaria',8),(1032,'Galapa',8),(1033,'Juan de Acosta',8),(1034,'Luruaco',8),(1035,'Malambo',8),(1036,'Manati',8),(1037,'Palmar de Varela',8),(1038,'Piojo',8),(1039,'Polonuevo',8),(1040,'Ponedera',8),(1041,'Puerto Colombia',8),(1042,'Repelon',8),(1043,'Sabanagrande',8),(1044,'Sabanalarga',8),(1045,'Santa Lucia',8),(1046,'Santo Tomas',8),(1047,'Soledad',8),(1048,'Suan',8),(1049,'Baranoa',8),(1050,'Tubara',8),(1051,'Usiacuri',8),(1052,'Arauca',81),(1053,'Cravo Norte',81),(1054,'Fortul',81),(1055,'Puerto Rondon',81),(1056,'Arauquita',81),(1057,'Saravena',81),(1058,'Tame',81),(1059,'Yopal',85),(1060,'Aguazul',85),(1061,'Hato Corozal',85),(1062,'La Salina',85),(1063,'Mani',85),(1064,'Chameza',85),(1065,'Monterrey',85),(1066,'Nunchia',85),(1067,'Orocue',85),(1068,'paz de Ariporo',85),(1069,'Pore',85),(1070,'Recetor',85),(1071,'Sabanalarga',85),(1072,'Sacama',85),(1073,'san Luis de Palenque',85),(1074,'Tamara',85),(1075,'Tauramena',85),(1076,'Trinidad',85),(1077,'Villanueva',85),(1078,'Mocoa',86),(1079,'Colon',86),(1080,'Orito',86),(1081,'Puerto Asis',86),(1082,'Puerto Caicedo',86),(1083,'Puerto Guzman',86),(1084,'Leguizamo',86),(1085,'Sibundoy',86),(1086,'san Francisco',86),(1087,'san Miguel',86),(1088,'Santiago',86),(1089,'Valle del Guamuez',86),(1090,'Villagarzon',86),(1091,'san Andres',88),(1092,'Providencia',88),(1093,'Leticia',91),(1094,'El Encanto',91),(1095,'La Chorrera',91),(1096,'La Pedrera',91),(1097,'La Victoria',91),(1098,'Miriti - Parana',91),(1099,'Puerto Alegria',91),(1100,'Puerto Arica',91),(1101,'Puerto Nariño',91),(1102,'Puerto Santander',91),(1103,'Tarapaca',91),(1104,'Inirida',94),(1105,'Barranco Minas',94),(1106,'Mapiripana',94),(1107,'san Felipe',94),(1108,'Puerto Colombia',94),(1109,'La Guadalupe',94),(1110,'Cacahual',94),(1111,'Pana Pana',94),(1112,'Morichal',94),(1113,'san Jose del Guaviare',95),(1114,'Calamar',95),(1115,'Miraflores',95),(1116,'El Retorno',95),(1117,'Mitu',97),(1118,'Caruru',97),(1119,'Pacoa',97),(1120,'Taraira',97),(1121,'Papunaua',97),(1122,'Yavarate',97),(1123,'Puerto Carreño',99),(1124,'La Primavera',99),(1125,'Santa Rosalia',99),(1126,'Cumaribo',99);
/*!40000 ALTER TABLE `geo_cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `geo_countries`
--

DROP TABLE IF EXISTS `geo_countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `geo_countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET latin1 NOT NULL,
  `code` varchar(5) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `geo_countries`
--

LOCK TABLES `geo_countries` WRITE;
/*!40000 ALTER TABLE `geo_countries` DISABLE KEYS */;
INSERT INTO `geo_countries` VALUES (1,'Otro','Other'),(57,'Colombia','CO');
/*!40000 ALTER TABLE `geo_countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `geo_states`
--

DROP TABLE IF EXISTS `geo_states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `geo_states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET latin1 NOT NULL,
  `id_country` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_geo_estados_geo_paises1` (`id_country`),
  CONSTRAINT `geo_countries_id_country` FOREIGN KEY (`id_country`) REFERENCES `geo_countries` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `geo_states`
--

LOCK TABLES `geo_states` WRITE;
/*!40000 ALTER TABLE `geo_states` DISABLE KEYS */;
INSERT INTO `geo_states` VALUES (1,'Sin Departamento',57),(5,'Antioquia',57),(8,'Atlantico',57),(13,'Bolivar',57),(15,'Boyaca',57),(17,'Caldas',57),(18,'Caqueta',57),(19,'Cauca',57),(20,'Cesar',57),(23,'Cordoba',57),(25,'Cundinamarca',57),(27,'Choco',57),(41,'Huila',57),(44,'La Guajira',57),(47,'Magdalena',57),(50,'Meta',57),(52,'Nariño',57),(54,'Norte de Santander',57),(63,'Quindio',57),(66,'Risaralda',57),(68,'Santander',57),(70,'Sucre',57),(73,'Tolima',57),(76,'Valle',57),(81,'Arauca',57),(85,'Casanare',57),(86,'Putumayo',57),(88,'San Andres',57),(91,'Amazonas',57),(94,'Guainia',57),(95,'Guaviare',57),(97,'Vaupes',57),(99,'Vichada',57),(100,'Bogota',57);
/*!40000 ALTER TABLE `geo_states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job`
--

DROP TABLE IF EXISTS `job`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `how_to_apply` longtext COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_public` tinyint(1) DEFAULT NULL,
  `is_activated` tinyint(1) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_FBD8E0F85F37A13B` (`token`),
  KEY `IDX_FBD8E0F812469DE2` (`category_id`),
  CONSTRAINT `FK_FBD8E0F812469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job`
--

LOCK TABLES `job` WRITE;
/*!40000 ALTER TABLE `job` DISABLE KEYS */;
/*!40000 ALTER TABLE `job` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `point_of_interest`
--

DROP TABLE IF EXISTS `point_of_interest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `point_of_interest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `longitude` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_activated` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `geocity_id` int(11) DEFAULT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_ext` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `schedule` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `route_id` int(11) DEFAULT NULL,
  `near_route_point_id` int(11) DEFAULT NULL,
  `img_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E67AD35912469DE2` (`category_id`),
  KEY `IDX_E67AD359D94EBC52` (`geocity_id`),
  KEY `IDX_E67AD35934ECB4E6` (`route_id`),
  KEY `IDX_E67AD359BFE33EA4` (`near_route_point_id`),
  CONSTRAINT `FK_E67AD35912469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `FK_E67AD35934ECB4E6` FOREIGN KEY (`route_id`) REFERENCES `route` (`id`),
  CONSTRAINT `FK_E67AD359BFE33EA4` FOREIGN KEY (`near_route_point_id`) REFERENCES `route_point` (`id`),
  CONSTRAINT `FK_E67AD359D94EBC52` FOREIGN KEY (`geocity_id`) REFERENCES `geo_cities` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `point_of_interest`
--

LOCK TABLES `point_of_interest` WRITE;
/*!40000 ALTER TABLE `point_of_interest` DISABLE KEYS */;
INSERT INTO `point_of_interest` VALUES (1,1,'10.96421','-74.797043','Descripcion punto','-',NULL,NULL,NULL,1,'Peaje Av. Rio','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(2,1,'10.960791','-74.74468','Descripcion punto','-',NULL,NULL,NULL,1,'Peaje Puente Laureano','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(3,1,'10.978899','-74.325754','Descripcion punto','-',NULL,NULL,NULL,1,'Peaje Tasajeras','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(4,1,'10.596535','-74.169044','Descripcion punto','-',NULL,NULL,NULL,1,'Peaje Tucurinca','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(5,1,'10.042567','-73.916531','Descripcion punto','-',NULL,NULL,NULL,1,'Peaje El Copey','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(6,1,'9.63838','-73.6397','Descripcion punto','-',NULL,NULL,NULL,1,'Peaje La Loma','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(7,1,'8.873728','-73.661528','Descripcion punto','-',NULL,NULL,NULL,1,'Peaje Pailitas','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(8,1,'8.08549','-73.55656','Descripcion punto','-',NULL,NULL,NULL,1,'Peaje Morrison','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(9,1,'7.130075','-73.564496','Descripcion punto','-',NULL,NULL,NULL,1,'Peaje La Gomez','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(10,1,'6.667303','-73.928204','Descripcion punto','-',NULL,NULL,NULL,1,'Peaje Aguas Negras','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(11,1,'6.262142','-74.483185','Descripcion punto','-',NULL,NULL,NULL,1,'Peaje Zambito','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(12,1,'4.26967','-74.49948','Descripcion punto','-',NULL,NULL,NULL,1,'Peaje Boqueron','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(13,1,'4.31398','-73.86482','Descripcion punto','-',NULL,NULL,NULL,1,'Peaje Puente Quetame','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(14,2,'5.652886','-73.793793','Descripcion punto','-',NULL,NULL,NULL,1,'Chiquinquira','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(15,2,'4.606289','-74.09743','Descripcion punto','-',NULL,NULL,NULL,1,'Bogota -Cra. 30 con Cl. 6','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(16,2,'4.182073','-73.688049','Descripcion punto','-',NULL,NULL,NULL,1,'Villavicencio','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(17,3,'7.049105','-73.832245','Descripcion punto','-',NULL,NULL,NULL,1,'Barrancabermeja','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(18,3,'8.329724','-73.594666','Descripcion punto','-',NULL,NULL,NULL,1,'Cerca a Aguachica Cesar','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(19,4,'8.31424','-73.61911','Descripcion punto','-',NULL,NULL,NULL,1,'EDS Aguachica','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(20,4,'5.629653','-73.306274','Descripcion punto','-',NULL,NULL,NULL,1,'EDS La esperanza','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(21,4,'4.719776','-74.215167','Descripcion punto','-',NULL,NULL,NULL,1,'EDS LA FLORIDA','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(22,5,'10.601092','-74.168701','Descripcion punto','-',NULL,NULL,NULL,1,'Cerca de Aracataca','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(23,5,'8.060028','-73.622818','Descripcion punto','-',NULL,NULL,NULL,1,'Pailitas','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(24,6,'4.571634','-72.962608','Descripcion punto','-',NULL,NULL,NULL,1,'Barranca de Upia','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(25,6,'4.632377','-72.936516','Descripcion punto','-',NULL,NULL,NULL,1,'Villa Aurora','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(26,7,'9.974261','-73.885803','Descripcion punto','-',NULL,NULL,NULL,1,'Bosconia','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(27,7,'8.045292','-73.534584','Descripcion punto','-',NULL,NULL,NULL,1,'San Martin','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(28,8,'10.935124','-74.780846','Descripcion punto','-',NULL,NULL,NULL,1,'El Limon - Barranquilla','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(29,8,'4.73921','-74.023132','Descripcion punto','-',NULL,NULL,NULL,1,'Usaqu_n','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(30,8,'5.33276','-71.182727','Descripcion punto','-',NULL,NULL,NULL,1,'Geopack','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(31,9,'7.049105','-73.832245','Descripcion punto','-',NULL,NULL,NULL,1,'Barrancabermeja','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(32,9,'11.035223','-74.836121','Descripcion punto','-',NULL,NULL,NULL,1,'Barranquilla','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(33,9,'5.33276','-71.182727','Descripcion punto','-',NULL,NULL,NULL,1,'Geopack','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(34,10,'10.938158','-74.834747','Descripcion punto','-',NULL,NULL,NULL,1,'Hotel Metropolitano','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(35,10,'8.628036','-73.636723','Descripcion punto','-',NULL,NULL,NULL,1,'Hotel Buenos Aires','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(36,10,'7.825289','-73.421631','Descripcion punto','-',NULL,NULL,NULL,1,'Hotel San Alberto','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(37,11,'4.296685','-73.483429','Descripcion punto','-',NULL,NULL,NULL,1,'Cumaral','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(38,11,'4.376536','-73.300781','Descripcion punto','-',NULL,NULL,NULL,1,'Oleducto Santa Teresa','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(39,11,'4.255687','-73.562393','Descripcion punto','-',NULL,NULL,NULL,1,'Restrepo','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(40,12,'4.41031','-72.564847','Descripcion punto','-',NULL,NULL,NULL,1,'La trinchera','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(41,12,'4.398704','72.646161','Descripcion punto','-',NULL,NULL,NULL,1,'El cairo','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(42,13,'7.049105','-73.832245','Descripcion punto','-',NULL,NULL,NULL,1,'Impala - Barrancabermeja','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(43,13,'4.65548','-74.113137','Descripcion punto','-',NULL,NULL,NULL,1,'Terminal Bogota','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(44,13,'4.132221','-73.60321','Descripcion punto','-',NULL,NULL,NULL,1,'Terminal Villavicencio','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(45,14,'11.037958','-74.825735','Descripcion punto','-',NULL,NULL,NULL,1,'Barranquilla','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(46,14,'5.212608','-74.73145','Descripcion punto','-',NULL,NULL,NULL,1,'Honda, Tolima','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(47,15,'10.955472','-74.761503','Descripcion punto','-',NULL,NULL,NULL,1,'Zona Franca Barranquilla','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(48,15,'4.674163','-74.155558','Descripcion punto','-',NULL,NULL,NULL,1,'Zona Franca Bogota','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(49,16,'10.930018','-74.787101','Descripcion punto','-',NULL,NULL,NULL,1,'Parque Industrial Malambo, Barranquilla','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(50,16,'4.70348','-74.14963','Descripcion punto','-',NULL,NULL,NULL,1,'Aeropuerto CATAM','','','','','',1,NULL,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(51,17,'5.5209333','-71.00815','API: XX,X      VOLUMEN PRODUCIDO DIARIO XXX   NUMERO DE POCISIONES DE LLENADO Y/O VACIADO     RATAS DE CARGUE Y DESCARGUE','Dorotea',1,'2014-12-20 22:04:32','2014-12-20 22:07:07',1,'Dorotea',NULL,NULL,NULL,NULL,NULL,1,1,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(52,17,'4.44595','-72.6601','API:28,0       VOLUMEN PRODUCIDO DIARIO 214   NUMERO DE POCISIONES DE LLENADO Y/O VACIADO     RATAS DE CARGUE Y DESCARGUE','Tigana',1,'2014-12-20 22:05:59','2014-12-20 16:46:49',1,'Tigana',NULL,NULL,NULL,NULL,NULL,1,2,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(53,17,'3.7871333','-71.454000','API: XX,X      VOLUMEN PRODUCIDO DIARIO XXX   NUMERO DE POCISIONES DE LLENADO Y/O VACIADO     RATAS DE CARGUE Y DESCARGUE','Campo Rubiales (NAPTHA)',1,'2014-12-20 16:49:34','2014-12-29 22:12:41',1,'Campo Rubiales (NAPTHA)',NULL,NULL,NULL,NULL,NULL,1,4,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(54,17,'3.4598167','-72.226967','API: XX,X      VOLUMEN PRODUCIDO DIARIO XXX   NUMERO DE POCISIONES DE LLENADO Y/O VACIADO     RATAS DE CARGUE Y DESCARGUE','CP6',1,'2014-12-20 16:53:34',NULL,1,'CP6',NULL,NULL,NULL,NULL,NULL,1,2,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg'),(55,17,'4.4068667','-72.646350','API: 19,2     VOLUMEN PRODUCIDO DIARIO 6345   NUMERO DE POCISIONES DE LLENADO Y/O VACIADO     RATAS DE CARGUE Y DESCARGUE','TUA',1,'2014-12-20 17:03:00',NULL,1,'TUA',NULL,NULL,NULL,NULL,NULL,1,2,'/poiwebapp/web/uploads/points_of_interest/php3fQCQi.jpeg');
/*!40000 ALTER TABLE `point_of_interest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'ROLE_USER'),(2,'ROLE_ADMIN'),(3,'ROLE_SUPER_ADMIN');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `route`
--

DROP TABLE IF EXISTS `route`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `route` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_2C420795E237E06` (`name`),
  UNIQUE KEY `UNIQ_2C42079989D9B62` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `route`
--

LOCK TABLES `route` WRITE;
/*!40000 ALTER TABLE `route` DISABLE KEYS */;
INSERT INTO `route` VALUES (1,'Ruta 1','Ruta1: Geopack Barranquilla','ruta1');
/*!40000 ALTER TABLE `route` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `route_point`
--

DROP TABLE IF EXISTS `route_point`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `route_point` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `route_id` int(11) DEFAULT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `longitude` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `isOrigin` int(11) DEFAULT NULL,
  `isDestination` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2ADAC18A34ECB4E6` (`route_id`),
  CONSTRAINT `FK_2ADAC18A34ECB4E6` FOREIGN KEY (`route_id`) REFERENCES `route` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `route_point`
--

LOCK TABLES `route_point` WRITE;
/*!40000 ALTER TABLE `route_point` DISABLE KEYS */;
INSERT INTO `route_point` VALUES (1,1,'Geopack','5.332760','-71.182727',NULL,NULL,NULL,1,NULL),(2,1,'Villanueva (Casanare)','4.611866','-72.936645',NULL,NULL,NULL,NULL,NULL),(3,1,'Villavicencio (Meta)','4.150000','-73.633333',NULL,NULL,NULL,NULL,NULL),(4,1,'Bogotá D.C. (Cundinamarca)','4.732060','-74.041900',NULL,NULL,NULL,NULL,0),(7,1,'La Vega (Cundinamarca)','5.000000','-74.350000',NULL,NULL,NULL,NULL,NULL),(8,1,'Honda (Cundinamarca)','4.966810','-74.711540',NULL,NULL,NULL,NULL,0),(14,1,'Aguachica (Cesar)','8.314240','-73.619110',NULL,NULL,NULL,NULL,NULL),(15,1,'Bosconia (Cesar)','9.976611','-73.890300',NULL,NULL,NULL,NULL,NULL),(16,1,'Barranquilla (Atlántico)','10.964210','-74.797043',NULL,NULL,NULL,NULL,1);
/*!40000 ALTER TABLE `route_point` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (12,NULL,'nhDr7OyKlXQju+Ge/WKGrPQ9lPBSUFfpK+B1xqx/+8zLZqRNX0+5G1zBQklXUFy86lCpkAofsExlXiorUcKSNQ==','admin','admin','admin'),(37,NULL,'nhDr7OyKlXQju+Ge/WKGrPQ9lPBSUFfpK+B1xqx/+8zLZqRNX0+5G1zBQklXUFy86lCpkAofsExlXiorUcKSNQ==','Impala','Impala','impala');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_role` (
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`role_id`,`user_id`),
  KEY `IDX_2DE8C6A3D60322AC` (`role_id`),
  KEY `IDX_2DE8C6A3A76ED395` (`user_id`),
  CONSTRAINT `FK_2DE8C6A3A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_2DE8C6A3D60322AC` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_role`
--

LOCK TABLES `user_role` WRITE;
/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
INSERT INTO `user_role` VALUES (1,37),(2,12),(3,12);
/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-12-30 12:33:17
