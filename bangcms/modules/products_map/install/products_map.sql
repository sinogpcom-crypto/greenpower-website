DROP TABLE IF EXISTS `bangcms_products_map`;
CREATE TABLE `bangcms_products_map` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product` varchar(200) NOT NULL,
  `main_products` varchar(400) NOT NULL,
  `company` varchar(400) NOT NULL,
  `address` varchar(400) NOT NULL,
  `tel` varchar(200) NOT NULL,
  `fax` varchar(200) NOT NULL,
  `listorder` smallint(5) unsigned NOT NULL,
  `siteid` smallint(5) unsigned DEFAULT NULL,
  `inserttime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;