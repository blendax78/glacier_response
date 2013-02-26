CREATE TABLE `glacier` (  `id` int(11) NOT NULL AUTO_INCREMENT,
  `archive_id` varchar(255) DEFAULT NULL,
	`hash` varchar(255) DEFAULT NULL,
	`filename` varchar(1000) DEFAULT NULL,
	`created` datetime DEFAULT NULL,
	`updated` datetime DEFAULT NULL,
	`vault` varchar(255) DEFAULT NULL,	
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
