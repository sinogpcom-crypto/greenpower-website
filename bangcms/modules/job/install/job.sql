DROP TABLE IF EXISTS `bc_job`;
DROP TABLE IF EXISTS `bc_job_yingpin`;
CREATE TABLE IF NOT EXISTS `bc_job` (
  `jobid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(5) NOT NULL,
  `yingpin` smallint(5) NOT NULL,
  `zhiwei` varchar(32) NOT NULL,
  `bumen` varchar(32) NOT NULL,
  `renshu` int(3) NOT NULL,
  `diqu` varchar(32) NOT NULL,
  `content` text NOT NULL,
  `enddate` varchar(32) NOT NULL,
  `lianxiren` varchar(32) NOT NULL,
  `tel` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `address` varchar(128) NOT NULL,
  `username` char(20) NOT NULL,
  `listorder` int(11) NOT NULL,
  `passed` smallint(1) NOT NULL DEFAULT '1',
  `inputtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`jobid`),
  KEY `status` (`jobid`),
  KEY `listorder` (`jobid`),
  KEY `catid` (`jobid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `bc_job_yingpin` (
  `ypid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(5) NOT NULL,
  `jobid` smallint(5) NOT NULL,
  `name` varchar(32) NOT NULL,
  `sex` varchar(5) NOT NULL,
  `age` tinyint(2) NOT NULL,
  `xueli` varchar(32) NOT NULL,
  `tel` varchar(32) NOT NULL,
  `jianli` text NOT NULL,
  `remark` text NOT NULL,
  `userid` int(11) NOT NULL,
  `username` char(20) NOT NULL,
  `listorder` int(11) NOT NULL,
  `passed` smallint(1) NOT NULL DEFAULT '0',
  `inputtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ypid`),
  KEY `status` (`ypid`),
  KEY `listorder` (`ypid`),
  KEY `catid` (`ypid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
