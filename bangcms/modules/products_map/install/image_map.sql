DROP TABLE IF EXISTS `bangcms_image_map`;
CREATE TABLE `bangcms_image_map` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `x` int(11) NOT NULL,
  `y` int(11) NOT NULL,
  `listorder` smallint(5) unsigned NOT NULL,
  `siteid` smallint(5) unsigned DEFAULT NULL,
  `parentid` smallint(6) NOT NULL,
  `inserttime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;