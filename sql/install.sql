-DROP TABLE IF EXISTS `sliders_sliders`;

CREATE TABLE `sliders_sliders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `controlnav` int(11) DEFAULT NULL,
  `infinito` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `createdAt` datetime NOT NULL,
  `updateAt` datetime DEFAULT NULL,
  `auto` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Table structure for table `sliders_sliders_items` */

DROP TABLE IF EXISTS `sliders_sliders_items`;

CREATE TABLE `sliders_sliders_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_slider` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `createdAt` datetime NOT NULL,
  `updateAt` datetime DEFAULT NULL,
  `file_responsive` varchar(255) DEFAULT NULL,
  `code` text DEFAULT NULL,
  `orden` int(11) DEFAULT 0,
  `boton_link` int(11) DEFAULT 0,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_slider` (`id_slider`),
  CONSTRAINT `sliders_sliders_items_ibfk_1` FOREIGN KEY (`id_slider`) REFERENCES `sliders_sliders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;