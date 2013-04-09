CREATE USER 'boxtest'@'localhost' IDENTIFIED BY  'boxtest';
GRANT USAGE ON * . * TO  'boxtest'@'localhost' IDENTIFIED BY  'boxtest' WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0 ;
GRANT ALL PRIVILEGES ON  `boxtest` . * TO  'boxtest'@'localhost';

CREATE DATABASE IF NOT EXISTS  `boxtest` ;

DROP TABLE IF EXISTS `boxtest`.`box_testsimpledataobject`;
CREATE TABLE `boxtest`.`box_testsimpledataobject` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `text` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `boxtest`.`box_testtypesdataobject`;
CREATE TABLE `boxtest`.`box_testtypesdataobject` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `int` int(11) NOT NULL,
  `string` varchar(255) NOT NULL,
  `float` float NOT NULL,
  `bool` tinyint(1) NOT NULL,
  `intA` text NOT NULL,
  `stringA` text NOT NULL,
  `floatA` text NOT NULL,
  `boolA` text NOT NULL,
  PRIMARY KEY (`id`)
);