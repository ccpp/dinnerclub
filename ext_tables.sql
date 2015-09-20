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

CREATE TABLE tx_news_domain_model_news (
  `tx_dinnerclub_cook` VARCHAR(64) DEFAULT '' NOT NULL,
  `tx_dinnerclub_contactperson` VARCHAR(64) DEFAULT '' NOT NULL,
);
