CREATE TABLE tx_dinnerclub_domain_model_registration (
  `uid` int(11) NOT NULL auto_increment,
  `pid` int(11) NOT NULL DEFAULT '0',

  `event` int(11) NOT NULL DEFAULT '0',
  `name` VARCHAR(64) NOT NULL DEFAULT '',
  `count` int(11) NOT NULL DEFAULT '0',
  `vegetarian` int(11) NOT NULL DEFAULT '0',
 
  PRIMARY KEY (`uid`),
  KEY `event` (`event`)
);
