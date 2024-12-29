-- (c) copyright 2011 nadlabs. All rights reserved.
-- liceneced under the nl-DFLA for more info goto http://www.nadlabs.co.uk/licence.php

-- --------------------------------------------------------

USE ##dbname##;




CREATE TABLE `blocked_ip_domains` (
  `bid` int(255) NOT NULL auto_increment,
  `ip` varchar(30) NOT NULL,
  `domain` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `refer` varchar(500) NOT NULL,
  `referaldomain` varchar(300) NOT NULL,
  `desci` varchar(2000) NOT NULL,
  `valid` int(3) NOT NULL,
  `type` int(2) NOT NULL,
  PRIMARY KEY  (`bid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

-- --------------------------------------------------------


-- 
-- Table structure for table `failed_login`
-- 

CREATE TABLE `failed_login` (
  `failedid` int(50) NOT NULL auto_increment,
  `loc` varchar(10) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `sms` varchar(10) NOT NULL,
  `smstok` varchar(30) default 'empty',
  `msg` varchar(100) NOT NULL,
  `inital_attempt` datetime NOT NULL,
  `current_attempt` datetime NOT NULL,
  `country` varchar(10) NOT NULL,
  `setid` int(50) NOT NULL,
  `ipad` varchar(30) NOT NULL,
  `refurl` varchar(1000) NOT NULL,
  PRIMARY KEY  (`failedid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;

-- --------------------------------------------------------


-- 
-- Table structure for table `notes`
-- 

CREATE TABLE `notes` (
  `noteid` int(255) NOT NULL auto_increment,
  `note` varchar(4000) NOT NULL,
  `elementid` int(255) NOT NULL,
  `element_type` int(2) NOT NULL,
  `userid` int(255) NOT NULL,
  `dateposted` datetime NOT NULL,
  `valid` int(2) NOT NULL,
  PRIMARY KEY  (`noteid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=127 ;

-- --------------------------------------------------------


-- --------------------------------------------------------

-- 
-- Table structure for table `security_blocks`
-- 

CREATE TABLE `security_blocks` (
  `blockid` int(10) NOT NULL auto_increment,
  `blockvalue` varchar(1000) NOT NULL,
  `type` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  `valid` int(1) NOT NULL,
  `blockarea` int(2) NOT NULL default '1',
  PRIMARY KEY  (`blockid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `stats_browser`
-- 

CREATE TABLE `stats_browser` (
  `browser_code` varchar(5) NOT NULL,
  `browser_name` varchar(30) NOT NULL,
  PRIMARY KEY  (`browser_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Table structure for table `stats_country_ip`
-- 

CREATE TABLE `stats_country_ip` (
  `ipstart` bigint(100) NOT NULL,
  `ipend` bigint(100) NOT NULL,
  `2letter` varchar(2) NOT NULL,
  `3letter` varchar(3) NOT NULL,
  `full` varchar(100) NOT NULL,
  KEY `ipstart` (`ipstart`),
  KEY `ipend` (`ipend`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Table structure for table `stats_country_iso_codes`
-- 

CREATE TABLE `stats_country_iso_codes` (
  `name` varchar(100) NOT NULL,
  `code` varchar(4) NOT NULL,
  PRIMARY KEY  (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Table structure for table `stats_lang`
-- 

CREATE TABLE `stats_lang` (
  `langid` mediumint(4) NOT NULL auto_increment,
  `lang_code` varchar(5) NOT NULL,
  `language` varchar(30) NOT NULL,
  PRIMARY KEY  (`langid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=367 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `stats_os`
-- 

CREATE TABLE `stats_os` (
  `OS_code` varchar(5) NOT NULL,
  `OS_name` varchar(30) NOT NULL,
  PRIMARY KEY  (`OS_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Table structure for table `user_groups`
-- 

CREATE TABLE `user_groups` (
  `groupid` int(255) NOT NULL auto_increment,
  `name` varchar(200) NOT NULL,
  `descip` varchar(4000) NOT NULL,
  `valid` int(2) NOT NULL,
  PRIMARY KEY  (`groupid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2266 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `user_table`
-- 

CREATE TABLE `user_table` (
  `userid` int(255) NOT NULL auto_increment,
  `username` varchar(200) NOT NULL,
  `screenname` varchar(200) NOT NULL,
  `p_hash` varchar(200) NOT NULL,
  `s_hash` varchar(100) NOT NULL,
  `valid` int(3) NOT NULL,
  `acti_code` varchar(300) NOT NULL,
  `ipad` varchar(30) NOT NULL,
  `date_joined` datetime NOT NULL,
  `lastip` varchar(30) NOT NULL,
  `last_visit` datetime NOT NULL,
  `email` varchar(200) NOT NULL,
  `gravtar_email` varchar(200) NOT NULL,
  `usergroup` int(255) NOT NULL,
  `temppass` varchar(100) NOT NULL,
  `tpdate` datetime NOT NULL,
  `tpip` varchar(30) NOT NULL,
  `tp_flag` int(1) NOT NULL,
  `browser` varchar(5) DEFAULT 'OBW',
  `os` varchar(5) DEFAULT 'OOS',
  `lang` varchar(5) DEFAULT 'ool',
  `country` varchar(5) DEFAULT 'ZZ',
  `refid` varchar(50) default NULL,
  `refurl` varchar(1000) default NULL,
  `refdomain` varchar(100) default NULL,
  `contact` int(1) NOT NULL,
  `fname` varchar(50) default NULL,
  `sname` varchar(50) default NULL,
  `mobilenum` varchar(20) default NULL,
  `screenres` varchar(30) NOT NULL,
  `searchengine` varchar(30) NOT NULL,
  `searchterm` varchar(300) NOT NULL,
  `smstok` varchar(30) default NULL,
  `smsip` varchar(30) default NULL,
  `smstimedate` datetime NOT NULL,
  `oneuse` int(1) NOT NULL default '0',
  `landingpage` varchar(500) default 'none',
  `openidurl` varchar(500) NOT NULL,
  `authentication_source` varchar(30) NOT NULL DEFAULT 'userbase',
  `img_flag` varchar(1) NOT NULL DEFAULT '0',
  `img_url` varchar(1000) NOT NULL,
  `cookie_id` varchar(1000) NOT NULL,
  `cookie_salt` varchar(50) NOT NULL,
  `cookie_expire` datetime NOT NULL,
  PRIMARY KEY  (`userid`),
  KEY `usergroup` (`usergroup`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=317 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `visit_stats`
-- 

CREATE TABLE `visit_stats` (
  `visitid` int(15) NOT NULL auto_increment,
  `reg_flag` int(1) NOT NULL,
  `browser` varchar(30) NOT NULL,
  `os` varchar(30) NOT NULL,
  `lang` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `date_visited` datetime NOT NULL,
  `refurl` varchar(500) NOT NULL,
  `refdomain` varchar(200) NOT NULL,
  `refid` varchar(50) NOT NULL,
  `screenres` varchar(30) NOT NULL,
  `userid` int(20) NOT NULL COMMENT 'if you really want to track users',
  `searchengine` varchar(100) NOT NULL,
  `searchterm` varchar(300) NOT NULL,
  `admin_flag` int(1) NOT NULL,
  `landingpage` varchar(500) default 'none',
  `lp_flag` int(1) NOT NULL,
  `parent_id` int(15) NOT NULL,
  `landing_id` int(15) NOT NULL,
  UNIQUE KEY `visitid` (`visitid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2175 ;

-- ------------------------------------------------------------------

--
-- stats data - do not remove this data
--


INSERT INTO `stats_browser` (`browser_code`, `browser_name`) VALUES 
('IE8', 'Internet Explorer 8'),
('IE9', 'Internet Explorer 9'),
('IE7', 'Internet Explorer 7'),
('IE6', 'Internet Explorer 6'),
('IEO', 'Other IE'),
('FFX', 'Firefox'),
('SAF', 'Safari'),
('GOO', 'Google Chrome'),
('OPA', 'Opera'),
('OBW', 'Other Bowsers'),
('MOB', 'Mobile Browsers'),
('IE', 'Internet Explorer'),
('WBK', 'WebKit '),
('IPAD', 'iPad'),
('IPHO', 'iPhone'),
('IPOD', 'iPod'),
('ANDR', 'Android'),
('PALM', 'PalmPre');



INSERT INTO `stats_country_iso_codes` (`name`, `code`) VALUES 
('AFGHANISTAN', 'AF'),
('ALAND ISLANDS', 'AX'),
('ALBANIA', 'AL'),
('ALGERIA', 'DZ'),
('AMERICAN SAMOA', 'AS'),
('ANDORRA', 'AD'),
('ANGOLA', 'AO'),
('ANGUILLA', 'AI'),
('ANTARCTICA', 'AQ'),
('ANTIGUA AND BARBUDA', 'AG'),
('ARGENTINA', 'AR'),
('ARMENIA', 'AM'),
('ARUBA', 'AW'),
('AUSTRALIA', 'AU'),
('AUSTRIA', 'AT'),
('AZERBAIJAN', 'AZ'),
('BAHAMAS', 'BS'),
('BAHRAIN', 'BH'),
('BANGLADESH', 'BD'),
('BARBADOS', 'BB'),
('BELARUS', 'BY'),
('BELGIUM', 'BE'),
('BELIZE', 'BZ'),
('BENIN', 'BJ'),
('BERMUDA', 'BM'),
('BHUTAN', 'BT'),
('BOLIVIA', 'BO'),
('BOSNIA AND HERZEGOVINA', 'BA'),
('BOTSWANA', 'BW'),
('BOUVET ISLAND', 'BV'),
('BRAZIL', 'BR'),
('BRITISH INDIAN OCEAN TERRITORY', 'IO'),
('BRUNEI DARUSSALAM', 'BN'),
('BULGARIA', 'BG'),
('BURKINA FASO', 'BF'),
('BURUNDI', 'BI'),
('CAMBODIA', 'KH'),
('CAMEROON', 'CM'),
('CANADA', 'CA'),
('CAPE VERDE', 'CV'),
('CAYMAN ISLANDS', 'KY'),
('CENTRAL AFRICAN REPUBLIC', 'CF'),
('CHAD', 'TD'),
('CHILE', 'CL'),
('CHINA', 'CN'),
('CHRISTMAS ISLAND', 'CX'),
('COCOS (KEELING) ISLANDS', 'CC'),
('COLOMBIA', 'CO'),
('COMOROS', 'KM'),
('CONGO', 'CG'),
('DR of CONGO', 'CD'),
('COOK ISLANDS', 'CK'),
('COSTA RICA', 'CR'),
('COTE D''IVOIRE', 'CI'),
('CROATIA', 'HR'),
('CUBA', 'CU'),
('CYPRUS', 'CY'),
('CZECH REPUBLIC', 'CZ'),
('DENMARK', 'DK'),
('DJIBOUTI', 'DJ'),
('DOMINICA', 'DM'),
('DOMINICAN REPUBLIC', 'DO'),
('ECUADOR', 'EC'),
('EGYPT', 'EG'),
('EL SALVADOR', 'SV'),
('EQUATORIAL GUINEA', 'GQ'),
('ERITREA', 'ER'),
('ESTONIA', 'EE'),
('ETHIOPIA', 'ET'),
('FALKLAND ISLANDS (MALVINAS)', 'FK'),
('FAROE ISLANDS', 'FO'),
('FIJI', 'FJ'),
('FINLAND', 'FI'),
('FRANCE', 'FR'),
('FRENCH GUIANA', 'GF'),
('FRENCH POLYNESIA', 'PF'),
('FRENCH SOUTHERN TERRITORIES', 'TF'),
('GABON', 'GA'),
('GAMBIA', 'GM'),
('GEORGIA', 'GE'),
('GERMANY', 'DE'),
('GHANA', 'GH'),
('GIBRALTAR', 'GI'),
('GREECE', 'GR'),
('GREENLAND', 'GL'),
('GRENADA', 'GD'),
('GUADELOUPE', 'GP'),
('GUAM', 'GU'),
('GUATEMALA', 'GT'),
('GUERNSEY', 'GG'),
('GUINEA', 'GN'),
('GUINEA-BISSAU', 'GW'),
('GUYANA', 'GY'),
('HAITI', 'HT'),
('HEARD ISLAND AND MCDONALD ISLANDS', 'HM'),
('VATICAN CITY STATE', 'VA'),
('HONDURAS', 'HN'),
('HONG KONG', 'HK'),
('HUNGARY', 'HU'),
('ICELAND', 'IS'),
('INDIA', 'IN'),
('INDONESIA', 'ID'),
('IRAN', 'IR'),
('IRAQ', 'IQ'),
('IRELAND', 'IE'),
('ISLE OF MAN', 'IM'),
('ISRAEL', 'IL'),
('ITALY', 'IT'),
('JAMAICA', 'JM'),
('JAPAN', 'JP'),
('JERSEY', 'JE'),
('JORDAN', 'JO'),
('KAZAKHSTAN', 'KZ'),
('KENYA', 'KE'),
('KIRIBATI', 'KI'),
('NORTH KOREA', 'KP'),
('SOUTH KOREA', 'KR'),
('KUWAIT', 'KW'),
('KYRGYZSTAN', 'KG'),
('LAO PEOPLE''S DEMOCRATIC REPUBLIC', 'LA'),
('LATVIA', 'LV'),
('LEBANON', 'LB'),
('LESOTHO', 'LS'),
('LIBERIA', 'LR'),
('LIBYA', 'LY'),
('LIECHTENSTEIN', 'LI'),
('LITHUANIA', 'LT'),
('LUXEMBOURG', 'LU'),
('MACAO', 'MO'),
('MACEDONIA', 'MK'),
('MADAGASCAR', 'MG'),
('MALAWI', 'MW'),
('MALAYSIA', 'MY'),
('MALDIVES', 'MV'),
('MALI', 'ML'),
('MALTA', 'MT'),
('MARSHALL ISLANDS', 'MH'),
('MARTINIQUE', 'MQ'),
('MAURITANIA', 'MR'),
('MAURITIUS', 'MU'),
('MAYOTTE', 'YT'),
('MEXICO', 'MX'),
('MICRONESIA', 'FM'),
('MOLDOVA', 'MD'),
('MONACO', 'MC'),
('MONGOLIA', 'MN'),
('MONTENEGRO', 'ME'),
('MONTSERRAT', 'MS'),
('MOROCCO', 'MA'),
('MOZAMBIQUE', 'MZ'),
('MYANMAR', 'MM'),
('NAMIBIA', 'NA'),
('NAURU', 'NR'),
('NEPAL', 'NP'),
('NETHERLANDS', 'NL'),
('NETHERLANDS ANTILLES', 'AN'),
('NEW CALEDONIA', 'NC'),
('NEW ZEALAND', 'NZ'),
('NICARAGUA', 'NI'),
('NIGER', 'NE'),
('NIGERIA', 'NG'),
('NIUE', 'NU'),
('NORFOLK ISLAND', 'NF'),
('NORTHERN MARIANA ISLANDS', 'MP'),
('NORWAY', 'NO'),
('OMAN', 'OM'),
('PAKISTAN', 'PK'),
('PALAU', 'PW'),
('PALESTINIAN TERRITORY', 'PS'),
('PANAMA', 'PA'),
('PAPUA NEW GUINEA', 'PG'),
('PARAGUAY', 'PY'),
('PERU', 'PE'),
('PHILIPPINES', 'PH'),
('PITCAIRN', 'PN'),
('POLAND', 'PL'),
('PORTUGAL', 'PT'),
('PUERTO RICO', 'PR'),
('QATAR', 'QA'),
('REUNION', 'RE'),
('ROMANIA', 'RO'),
('RUSSIAN FEDERATION', 'RU'),
('RWANDA', 'RW'),
('SAINT BARTH?LEMY', 'BL'),
('SAINT HELENA', 'SH'),
('SAINT KITTS AND NEVIS', 'KN'),
('SAINT LUCIA', 'LC'),
('SAINT MARTIN', 'MF'),
('SAINT PIERRE AND MIQUELON', 'PM'),
('SAINT VINCENT AND THE GRENADINES', 'VC'),
('SAMOA', 'WS'),
('SAN MARINO', 'SM'),
('SAO TOME AND PRINCIPE', 'ST'),
('SAUDI ARABIA', 'SA'),
('SENEGAL', 'SN'),
('SERBIA', 'RS'),
('SEYCHELLES', 'SC'),
('SIERRA LEONE', 'SL'),
('SINGAPORE', 'SG'),
('SLOVAKIA', 'SK'),
('SLOVENIA', 'SI'),
('SOLOMON ISLANDS', 'SB'),
('SOMALIA', 'SO'),
('SOUTH AFRICA', 'ZA'),
('SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'GS'),
('SPAIN', 'ES'),
('SRI LANKA', 'LK'),
('SUDAN', 'SD'),
('SURINAME', 'SR'),
('SVALBARD AND JAN MAYEN', 'SJ'),
('SWAZILAND', 'SZ'),
('SWEDEN', 'SE'),
('SWITZERLAND', 'CH'),
('SYRIAN ARAB REPUBLIC', 'SY'),
('TAIWAN', 'TW'),
('TAJIKISTAN', 'TJ'),
('TANZANIA', 'TZ'),
('THAILAND', 'TH'),
('TIMOR-LESTE', 'TL'),
('TOGO', 'TG'),
('TOKELAU', 'TK'),
('TONGA', 'TO'),
('TRINIDAD AND TOBAGO', 'TT'),
('TUNISIA', 'TN'),
('TURKEY', 'TR'),
('TURKMENISTAN', 'TM'),
('TURKS AND CAICOS ISLANDS', 'TC'),
('TUVALU', 'TV'),
('UGANDA', 'UG'),
('UKRAINE', 'UA'),
('UNITED ARAB EMIRATES', 'AE'),
('UNITED KINGDOM', 'GB'),
('UNITED STATES', 'US'),
('URUGUAY', 'UY'),
('UZBEKISTAN', 'UZ'),
('VANUATU', 'VU'),
('VENEZUEL', 'VE'),
('VIET NAM', 'VN'),
('VIRGIN ISLANDS (BRITISH)', 'VG'),
('VIRGIN ISLANDS (U.S).', 'VI'),
('WALLIS AND FUTUNA', 'WF'),
('WESTERN SAHARA', 'EH'),
('YEMEN', 'YE'),
('ZAMBIA', 'ZM'),
('ZIMBABWE', 'ZW'),
('UNKNOWN', 'ZZ');



INSERT INTO `stats_lang` (`langid`, `lang_code`, `language`) VALUES 
(208, 'ab', 'Abkhazian'),
(209, 'aa', 'Afar'),
(210, 'af', 'Afrikaans'),
(211, 'sq', 'Albanian'),
(212, 'am', 'Amharic'),
(213, 'ar', 'Arabic'),
(214, 'hy', 'Armenian'),
(215, 'as', 'Assamese'),
(216, 'ay', 'Aymara'),
(217, 'az', 'Azerbaijani'),
(218, 'ba', 'Bashkir'),
(219, 'eu', 'Basque'),
(220, 'bn', 'Bengali(Bangla)'),
(221, 'dz', 'Bhutani'),
(222, 'bh', 'Bihari'),
(223, 'bi', 'Bislama'),
(224, 'br', 'Breton'),
(225, 'bg', 'Bulgarian'),
(226, 'my', 'Burmese'),
(227, 'be', 'Byelorussian(Belarusian)'),
(228, 'km', 'Cambodian'),
(229, 'ca', 'Catalan'),
(232, 'zh', 'Chinese'),
(233, 'zh', 'Chinese(Traditional)'),
(234, 'co', 'Corsican'),
(235, 'hr', 'Croatian'),
(236, 'cs', 'Czech'),
(237, 'da', 'Danish'),
(239, 'nl', 'Dutch'),
(241, 'en', 'English'),
(242, 'eo', 'Esperanto'),
(243, 'et', 'Estonian'),
(244, 'fo', 'Faeroese'),
(245, 'fa', 'Farsi'),
(246, 'fj', 'Fiji'),
(247, 'fi', 'Finnish'),
(249, 'fr', 'French'),
(250, 'fy', 'Frisian'),
(252, 'gl', 'Galician'),
(253, 'gd', 'Gaelic(Scottish)'),
(254, 'gv', 'Gaelic(Manx)'),
(255, 'ka', 'Georgian'),
(256, 'de', 'German'),
(257, 'el', 'Greek'),
(258, 'kl', 'Greenlandic'),
(259, 'gn', 'Guarani'),
(260, 'gu', 'Gujarati'),
(261, 'ha', 'Hausa'),
(263, 'he', 'Hebrew'),
(264, 'hi', 'Hindi'),
(265, 'hu', 'Hungarian'),
(267, 'is', 'Icelandic'),
(269, 'id', 'Indonesian'),
(270, 'ia', 'Interlingua'),
(271, 'ie', 'Interlingue'),
(272, 'iu', 'Inuktitut'),
(273, 'ik', 'Inupiak'),
(274, 'ga', 'Irish'),
(275, 'it', 'Italian'),
(276, 'ja', 'Japanese'),
(277, 'jv', 'Javanese'),
(278, 'kn', 'Kannada'),
(280, 'ks', 'Kashmiri'),
(281, 'kk', 'Kazakh'),
(282, 'rw', 'Kinyarwanda(Ruanda)'),
(283, 'ky', 'Kirghiz'),
(284, 'rn', 'Kirundi(Rundi)'),
(286, 'ko', 'Korean'),
(287, 'ku', 'Kurdish'),
(288, 'lo', 'Laothian'),
(289, 'la', 'Latin'),
(290, 'lv', 'Latvian(Lettish)'),
(291, 'li', 'Limburgish(Limburger)'),
(292, 'ln', 'Lingala'),
(293, 'lt', 'Lithuanian'),
(294, 'mk', 'Macedonian'),
(295, 'mg', 'Malagasy'),
(296, 'ms', 'Malay'),
(297, 'ml', 'Malayalam'),
(298, 'mt', 'Maltese'),
(299, 'mi', 'Maori'),
(300, 'mr', 'Marathi'),
(301, 'mo', 'Moldavian'),
(302, 'mn', 'Mongolian'),
(303, 'na', 'Nauru'),
(304, 'ne', 'Nepali'),
(305, 'no', 'Norwegian'),
(306, 'oc', 'Occitan'),
(307, 'or', 'Oriya'),
(308, 'om', 'Oromo (Afan, Galla)'),
(310, 'ps', 'Pashto(Pushto)'),
(311, 'pl', 'Polish'),
(312, 'pt', 'Portuguese'),
(313, 'pa', 'Punjabi'),
(314, 'qu', 'Quechua'),
(315, 'rm', 'Rhaeto-Romance'),
(316, 'ro', 'Romanian'),
(317, 'ru', 'Russian'),
(319, 'sm', 'Samoan'),
(320, 'sg', 'Sangro'),
(321, 'sa', 'Sanskrit'),
(322, 'sr', 'Serbian'),
(323, 'sh', 'Serbo-Croatian'),
(324, 'st', 'Sesotho'),
(325, 'tn', 'Setswana'),
(326, 'sn', 'Shona'),
(327, 'sd', 'Sindhi'),
(328, 'si', 'Sinhalese'),
(329, 'ss', 'Siswati'),
(330, 'sk', 'Slovak'),
(331, 'sl', 'Slovenian'),
(332, 'so', 'Somali'),
(333, 'es', 'Spanish'),
(334, 'su', 'Sundanese'),
(335, 'sw', 'Swahili(Kiswahili)'),
(336, 'sv', 'Swedish'),
(338, 'tl', 'Tagalog'),
(339, 'tg', 'Tajik'),
(341, 'ta', 'Tamil'),
(342, 'tt', 'Tatar'),
(343, 'te', 'Telugu'),
(344, 'th', 'Thai'),
(345, 'bo', 'Tibetan'),
(346, 'ti', 'Tigrinya'),
(347, 'to', 'Tonga'),
(348, 'ts', 'Tsonga'),
(349, 'tr', 'Turkish'),
(350, 'tk', 'Turkmen'),
(351, 'tw', 'Twi'),
(352, 'ug', 'Uighur'),
(353, 'uk', 'Ukrainian'),
(354, 'ur', 'Urdu'),
(355, 'uz', 'Uzbek'),
(357, 'vi', 'Vietnamese'),
(358, 'vo', 'Volapk'),
(359, 'cy', 'Welsh'),
(360, 'wo', 'Wolof'),
(361, 'xh', 'Xhosa'),
(366, 'ool', 'Other Language'),
(363, 'yi', 'Yiddish'),
(364, 'yo', 'Yoruba'),
(365, 'zu', 'Zulu');



INSERT INTO `stats_os` (`OS_code`, `OS_name`) VALUES 
('WIN98', 'Windows 98'),
('WIN95', 'Windows 95'),
('WIN3', 'Windows 3.11'),
('WIN2K', 'Windows 2000'),
('WINXP', 'Windows XP'),
('WIN23', 'WinServer 2003'),
('WINV', 'Windows Vista'),
('WIN7', 'Windows 7'),
('WINNT', 'Windows NT 4'),
('WINME', 'Windows ME'),
('OBSD', 'Open BSD'),
('SUNOS', 'Sun OS'),
('LIN', 'Linux'),
('MACOS', 'Apple OS'),
('QNX', 'QNX'),
('BEOS', 'BeOS'),
('OS/2', 'OS/2'),
('SSB', 'Search Bots'),
('OOS', 'Other OS');

INSERT INTO `user_groups` (`groupid`, `name`, `descip`, `valid`) VALUES 
(1, 'Administrator', 'Administrator user group - protected', 1),
(2, 'Assistant', 'Assistant user group - protected', 1),
(3, 'Moderator', 'Moderator user group - protected', 1),
(4, 'Default', 'Users who sign up through the site', 1);

INSERT INTO `user_table` (`userid`, `username`, `screenname`, `p_hash`, `s_hash`, `valid`, `acti_code`, `ipad`, `date_joined`, `lastip`, `last_visit`, `email`, `gravtar_email`, `usergroup`, `temppass`, `tpdate`, `tpip`, `tp_flag`, `browser`, `os`, `lang`, `country`, `refid`, `refurl`, `refdomain`, `contact`, `fname`, `sname`, `mobilenum`, `screenres`, `searchengine`, `searchterm`, `smstok`, `smsip`, `smstimedate`, `oneuse`, `landingpage`) VALUES 
(1, 'admini', 'admini', 'f1ec576431a311408193184f68e39ee23a5db93f', '[tZ', 1, '1321996771', '127.0.0.2', '2011-01-23 11:48:04', '127.0.0.1', '2011-11-23 19:14:35', 'myname@myemail.com', '', 1, '0875070f2ceb6fe78b57956ef3b0fd19', '2011-08-27 10:30:08', '127.0.0.1', 1, 'GOO', 'WIN98', 'en', 'MF', '', '', '', 1, '', '', '', '1024x768', '', '', '1321996672', '127.0.0.1', '2011-11-22 21:17:52', 1, '');
