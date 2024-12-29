-- (c) copyright 2011 nadlabs. All rights reserved.
-- liceneced under the nl-DFLA for more info goto http://www.nadlabs.co.uk/licence.php

-- --------------------------------------------------------
USE ##dbname##;

INSERT INTO `security_blocks` (`blockid`, `blockvalue`, `type`, `description`, `valid`, `blockarea`) VALUES 
(2, 'mikedahacker@hotmail.com', 3, 'block this user as he is a hacker', 1, 1),
(3, 'bbc.co.uk', 5, 'domain', 1, 1),
(4, '127.0.0.1', 1, 'ip', 2, 1),
(5, 'yahoo.co.uk/news', 4, 'url', 2, 1),
(6, 'newblock@mynamethis_long.com', 3, 'my email address', 1, 1),
(7, '123.123.123.123', 1, 'ip blocked due to suspect dos', 1, 3),
(8, '123.21.213.12', 1, 'block this ip from accessing the site', 1, 2),
(9, '221.21.56.78', 1, '', 1, 1),
(10, '43.5.6.2', 1, '', 1, 1),
(11, '4.5.66.123', 1, '', 2, 1),
(12, '123.56.7.8', 1, '', 1, 1),
(13, '198.0.0.1', 1, '', 1, 1),
(14, '123.23.43.5', 1, '', 1, 1),
(15, '12.32.45.5', 1, '', 1, 1),
(16, '213.32.4.56', 1, '', 1, 1),
(17, '12.23.4.223', 1, '', 1, 1),
(18, '12.3.45.6', 1, '', 1, 1),
(19, '213.4.5.66', 1, '', 1, 1),
(20, '55.55.55.55', 1, '', 1, 1),
(21, '12.32.21.34', 1, '', 1, 1),
(22, '32.43.213.4', 1, '', 1, 1),
(23, '92.0.0.1', 1, '', 1, 1),
(24, '21.32.5.2', 1, '', 1, 1),
(25, '0.0.0.0', 1, '', 1, 1),
(26, 'http://www.bbc.co.uk/sport', 4, 'block any sports people!', 1, 3),
(27, 'newblock@blocks.com', 3, '', 1, 1),
(28, 'gmail.com', 2, 'block all people signing up with gmail accounts', 1, 1),
(29, 'ymail.com', 2, 'block people signing up with ymail.com accounts', 1, 1),
(30, 'mike@estore.com', 3, 'i dont like this guy - blocking his email', 1, 1),
(31, 'tony@british.gov', 3, 'blocked email address', 1, 1),
(32, 'sports.com', 5, '', 1, 2),
(33, 'thisisasiteblock.com', 5, '', 1, 3),
(34, 'example.com', 2, 'blocking the obvious', 1, 3),
(35, 'adobeflash.com', 5, '', 1, 3),
(36, 'yahoo.co.uk', 5, 'we dont have anything against yahoo - it''s just the first thing to come to mind!', 1, 1),
(37, 'yahoo', 1, '', 1, 1);





INSERT INTO `user_groups` (`groupid`, `name`, `descip`, `valid`) VALUES 

(10, 'Administrator', 'this is a esc', 2),
(12, 'AAEditor', 'this is a esc222', 2),
(13, 'Modertator', '21221', 2),
(14, 'AA Paying Clients', 'this is our private area for clients', 2),
(21, 'Administrator', 'this is a esc', 2),
(23, 'Modertator', '21221', 2),
(221, 'Administrator', 'this is a esc', 2),
(222, 'Editor', 'this is a esc222', 2),
(223, 'Modertator', '21221', 2),
(224, 'Paying Clients', 'this is our private area for clients', 2),
(2210, 'Administrator', 'this is a esc', 2),
(2213, 'this is a new group', 'this is a better description', 2),
(2214, 'dsdsds', 'dsdsds', 2),
(2215, 'dsds', 'dsds', 2),
(2218, 'edit the This is a new name user group123', 'this is', 2),
(2219, 'this is a new neame', '', 2),
(2220, 'dsdsds', 'dsdsds', 2),
(2221, 'Normal users', 'Thi sis for normal users', 2),
(2249, 'premium members', 'for customers who have paid the fee', 1),
(2251, 'Normal Users', 'this is for regular members', 1),
(2257, 'Watch List group', 'people who have been placed on a watch list', 1);




INSERT INTO `user_table` (`userid`, `username`, `screenname`, `p_hash`, `s_hash`, `valid`, `acti_code`, `ipad`, `date_joined`, `lastip`, `last_visit`, `email`, `gravtar_email`, `usergroup`, `temppass`, `tpdate`, `tpip`, `tp_flag`, `browser`, `os`, `lang`, `country`, `refid`, `refurl`, `refdomain`, `contact`, `fname`, `sname`, `mobilenum`, `screenres`, `searchengine`, `searchterm`, `smstok`, `smsip`, `smstimedate`, `oneuse`, `landingpage`) VALUES 
(175, 'nadlabsguy', 'nadlabsguy', 'f1ec576431a311408193184f68e39ee23a5db93f', '[tZ', 1, '1321996771', '127.0.0.2', '2011-01-23 11:48:04', '127.0.0.1', '2011-11-23 19:14:35', 'myname@myemail.com', '', 1, '0875070f2ceb6fe78b57956ef3b0fd19', '2011-08-27 10:30:08', '127.0.0.1', 1, 'GOO', 'WIN98', 'en', 'MF', '1234567', 'http://www.google.com/q?=usermanagementsystem', 'http://www.theseconddomain.com', 1, '', '', 'n/a', '1024x768', 'google.co.uk', 'php user management', '1321996672', '127.0.0.1', '2011-11-22 21:17:52', 1, 'http://127.0.0.1/ns/nl_userbase/index/index.php '),
(265, 'windowsGuy', 'windowsGuy', '63212d9e79a160469791a8da8a9f3350', 'q0(', 0, 'admin-activated', '127.0.0.1', '2011-08-19 16:48:47', '127.0.0.1', '2011-08-24 10:33:28', 'winguy@msn.com', '', 1, '', '0000-00-00 00:00:00', '', 0, 'IE9', 'WIN3', 'ab', 'US', '', 'admin-created', 'http://www.theseconddomain.com', 0, NULL, NULL, 'N/A', 'not set', 'bing.com', 'nadlabs apps', NULL, NULL, '0000-00-00 00:00:00', 0, 'http://127.0.0.1/ns/nl_userbase/index/index.php '),
(266, 'stevejoby', 'stevejoby', '0e71271e91547298ed643c9ce18e1cf0', '$0L', 1, 'admin-activated', '127.0.0.1', '2011-08-13 16:48:56', '', '2011-08-24 10:33:28', 'fdfdfd@fdf2.com', '', 1, '', '0000-00-00 00:00:00', '', 0, 'IE9', 'BEOS', 'ool', 'ZZ', '', 'admin-created', 'http://www.theseconddomain.com', 0, NULL, NULL, 'N/A', 'not set', 'google.co.uk', 'nadlabs apps', NULL, NULL, '0000-00-00 00:00:00', 0, 'http://127.0.0.1/ns/nl_userbase/index/index.php '),
(267, 'Whowhatwhere', 'Whowhatwhere', 'ad1a45e9e063515a09235fdf5810cd15', 'maM', 1, 'admin-activated', '127.0.0.1', '2011-08-19 16:49:04', '', '2011-08-24 10:33:28', 'fdfdfd@fdf23.com', '', 1, '', '0000-00-00 00:00:00', '', 0, 'IE9', 'LIN', 'ool', 'ZZ', '', 'admin-created', 'http://www.theseconddomain.com', 0, NULL, NULL, 'N/A', 'not set', 'none', '---', NULL, NULL, '0000-00-00 00:00:00', 0, 'http://127.0.0.1/ns/nl_userbase/index/index.php '),
(299, 'fairusepolicy', 'fairusepolicy', 'eb27346bf85805bdf2bb16fb507be081', '|AW', 1, '1317028868', '127.0.0.1', '2011-09-26 10:21:08', '127.0.0.1', '2011-09-26 10:21:08', 'hsjhs@sjjh2jsh.com', '', 4, '', '0000-00-00 00:00:00', '', 0, 'FFX', 'WINXP', 'en', 'ZZ', '', 'type-in-traffic', 'type-in-traffic', 0, NULL, NULL, 'N/A', '1024x768', 'none', '---', NULL, NULL, '0000-00-00 00:00:00', 0, 'http://127.0.0.1/ns/nl_userbase/index/index.php '),
(298, 'tinytim', 'tinytim', '156fc6c12778275ee9c2e45e8f8b1487', 'ysr', 1, '1317028790', '127.0.0.1', '2011-09-26 10:19:50', '127.0.0.1', '2011-09-29 11:27:51', 'hsjhs@sjjhjsh.com', '', 4, '', '0000-00-00 00:00:00', '', 0, 'FFX', 'WINXP', 'en', 'ZZ', '', 'type-in-traffic', 'type-in-traffic', 0, NULL, NULL, 'N/A', '1024x768', 'none', '---', NULL, NULL, '0000-00-00 00:00:00', 0, 'http://127.0.0.1/ns/nl_userbase/index/index.php '),
(310, 'novisitguy', 'novisitguy', '812ed5b93f6f4d29948aefbfe0135e03', '5MF', 1, 'admin-activated', '127.0.0.1', '2011-11-13 20:20:11', 'no visit', '0000-00-00 00:00:00', 'papos@dkkd.ods', '', 1, '', '0000-00-00 00:00:00', '', 0, 'IE9', 'WINXP', 'aa', 'ZZ', '127044-1310375862', 'admin-created', 'admin-created', 0, NULL, NULL, 'N/A', 'not set', 'none', '---', '', '', '0000-00-00 00:00:00', 0, 'admin-cp'),
(309, 'jamesbob', 'jamesbob', 'cc1a2693a199e8ee59115c2b3bddb8f0', 'ep,', 1, 'admin-activated', '127.0.0.1', '2011-11-13 20:13:05', '127.0.0.1', '0000-00-00 00:00:00', 'sjkjs@skjskj.com', '', 4, '', '0000-00-00 00:00:00', '', 0, 'IE9', 'WINXP', 'ool', 'ZZ', '127044-1310375862', 'admin-created', 'admin-created', 0, NULL, NULL, 'N/A', 'not set', 'none', '---', '', '', '0000-00-00 00:00:00', 0, 'admin-cp'),
(308, 'jamesthegiant', 'jamesthegiant', 'a94d5e867fa0a1f3f5b911b38e5db9ba', '9^p', 1, '1319626920', '127.0.0.1', '2011-10-26 12:02:00', '127.0.0.1', '2011-10-26 12:02:00', 'skjkjhs@sjsjhs.com', '', 4, '', '0000-00-00 00:00:00', '', 0, 'FFX', 'WINXP', 'en', 'ZZ', '127044-1310375862', 'http://127.0.0.1/ns/nl_userbase/index/index.php', '127.0.0.1', 1, NULL, NULL, 'N/A', '1024x768', 'none', '---', '', '', '0000-00-00 00:00:00', 0, 'http://127.0.0.1/ns/nl_userbase/index/index.php'),
(293, 'passguysd', 'passguysd', '21b79394da420ca29dd06ccd8a1da131', 'Ccb', 1, 'admin-activated', '127.0.0.1', '2011-09-24 21:50:07', '127.0.0.1', '2011-09-24 21:50:07', 'passw@sjhdssjh.com', '', 1, '', '0000-00-00 00:00:00', '', 0, 'IE9', 'WINXP', 'ool', 'ZZ', '', 'admin-created', 'admin-created', 0, NULL, NULL, 'N/A', 'not set', 'none', '---', NULL, NULL, '0000-00-00 00:00:00', 0, 'http://127.0.0.1/ns/nl_userbase/index/index.php '),
(292, 'passguy', 'passguy', 'f02f9c835665a6d47e71a23a4ae08fc4', 'H4l', 1, 'admin-activated', '127.0.0.1', '2011-09-24 21:49:55', '127.0.0.1', '2011-09-24 21:49:55', 'passw@sjhsjh.com', '', 1, '', '0000-00-00 00:00:00', '', 0, 'IE9', 'WINXP', 'ool', 'ZZ', '', 'admin-created', 'admin-created', 0, NULL, NULL, 'N/A', 'not set', 'none', '---', NULL, NULL, '0000-00-00 00:00:00', 0, 'http://127.0.0.1/ns/nl_userbase/index/index.php '),
(307, 'shrek', 'shrek', '2257f442bfc8b882bf975b2da6baf7e5', 'gsl', 1, '1319626873', '127.0.0.1', '2011-10-26 12:01:13', '127.0.0.1', '2011-10-26 12:01:13', 'shrek@pixar.com', '', 4, '', '0000-00-00 00:00:00', '', 0, 'FFX', 'WINXP', 'en', 'ZZ', '', 'http://127.0.0.1/ns/nl_userbase/index/index.php', '127.0.0.1', 0, NULL, NULL, 'N/A', '1024x768', 'none', '---', '', '', '0000-00-00 00:00:00', 0, 'http://127.0.0.1/ns/nl_userbase/index/index.php'),
(286, 'doughnutking', 'doughnutking', '5c265f512862271b42f7397ea130de5c', '>IO', 1, '1316731178', '127.0.0.1', '2011-09-22 23:39:38', '127.0.0.1', '2011-09-22 23:39:38', 'sss@skjjs.com', '', 4, '', '0000-00-00 00:00:00', '', 0, 'FFX', 'WINXP', 'en', 'ZZ', '', 'type-in-traffic', 'type-in-traffic', 0, NULL, NULL, 'N/A', '1024x768', 'none', '---', NULL, NULL, '0000-00-00 00:00:00', 0, 'http://127.0.0.1/ns/nl_userbase/index/index.php '),
(290, 'sdsds', 'sdsds', '697c697abe54183745e890d0520fb25e', ',V#', 1, 'admin-activated', '127.0.0.1', '2011-09-24 21:45:50', '127.0.0.1', '2011-09-24 21:45:50', 'dsdds@dsdsds.vom', '', 1, '', '0000-00-00 00:00:00', '', 0, 'IE9', 'WINXP', 'ool', 'ZZ', '', 'admin-created', 'admin-created', 0, NULL, NULL, 'N/A', 'not set', 'none', '---', NULL, NULL, '0000-00-00 00:00:00', 0, 'http://127.0.0.1/ns/nl_userbase/index/index.php '),
(288, 'forestGump', 'forestGump', '7a32ea7ad66e35350e749295c2202f47', '_Dm', 1, 'admin-activated', '127.0.0.1', '2011-09-24 21:43:35', '127.0.0.1', '2011-09-24 21:43:35', 'clever@gump.com', '', 1, '', '0000-00-00 00:00:00', '', 0, 'IE9', 'WINXP', 'ool', 'ZZ', '', 'admin-created', 'admin-created', 0, NULL, NULL, 'N/A', 'not set', 'none', '---', NULL, NULL, '0000-00-00 00:00:00', 0, 'http://127.0.0.1/ns/nl_userbase/index/index.php '),
(289, 'jamesowner', 'jamesowner', '9f3401ddbbf4c6bf7fefff822ab19b19', 'E.3', 2, 'admin-activated', '127.0.0.1', '2011-09-24 21:44:58', '127.0.0.1', '2011-09-24 21:44:58', 'fdfdfd@fdfdh.vom', '', 1, '', '0000-00-00 00:00:00', '', 0, 'IE9', 'WINXP', 'ool', 'ZZ', '', 'admin-created', 'admin-created', 0, NULL, NULL, 'N/A', 'not set', 'none', '---', NULL, NULL, '0000-00-00 00:00:00', 0, 'http://127.0.0.1/ns/nl_userbase/index/index.php '),
(278, 'mynameisjames', 'mynameisjames', '6c350af24f07ba340e9be1e947a20aca', 'Ey>', 1, 'admin-activated', '127.0.0.1', '2011-09-15 10:24:57', '127.0.0.1', '0000-00-00 00:00:00', 'james@jamesmane.com', '', 1, '', '0000-00-00 00:00:00', '', 0, 'IE9', 'WINXP', 'ool', 'ZZ', '', 'admin-created', 'admin-created', 0, NULL, NULL, 'N/A', 'not set', 'none', '---', NULL, NULL, '0000-00-00 00:00:00', 0, 'http://127.0.0.1/ns/nl_userbase/index/index.php '),
(277, 'Borisforpres', 'Borisforpres', '5ec7c78114a50e622b3b7b7575372faa', 'gk_', 1, 'admin-activated', '134.232.123.124', '2011-10-17 09:02:04', '127.0.0.1', '2011-10-25 21:07:03', 'boriy-2011@mail.ru', '', 4, '6bc93f3c012a69a0aee180a29052dd77', '2011-10-25 21:50:41', '127.0.0.1', 1, 'SAF', 'WIN98', 'ru', 'US', 'kremlin-128', 'http://www.google.com?q=president+boris', 'www.google.com', 0, NULL, NULL, 'N/A', 'not set', 'none', '---', NULL, NULL, '0000-00-00 00:00:00', 0, 'http://127.0.0.1/ns/nl_userbase/index/userarea.php '),
(276, 'JohnSmith', 'JohnSmith', 'a31df051e1372040e9d61c2584bbb02b', 'X;I', 1, 'admin-activated', '127.0.0.1', '2011-08-20 15:01:41', '', '2011-08-24 10:33:28', 'dsds@dsd2s222.com', '', 1, '', '0000-00-00 00:00:00', '', 0, 'IE9', 'WINXP', 'ool', 'ZZ', '', 'admin-created', 'admin-created', 0, NULL, NULL, 'N/A', 'not set', 'none', '---', NULL, NULL, '0000-00-00 00:00:00', 0, 'http://127.0.0.1/ns/nl_userbase/index/index.php '),
(275, 'onlyfoolsandhorsesbydelboyanddo', 'onlyfoolsandhorsesbydelboyanddo', '3338f56c2541048949dbd3cbde8e44c5', 'Z^=', 1, 'admin-activated', '127.0.0.1', '2011-08-22 15:01:25', '', '2011-08-24 10:33:28', 'dsds@dsd2s22.com', '', 1, '', '0000-00-00 00:00:00', '', 0, 'IE9', 'WINXP', 'ool', 'ZZ', '', 'admin-created', 'admin-created', 0, NULL, NULL, 'N/A', 'not set', 'none', '---', NULL, NULL, '0000-00-00 00:00:00', 0, 'http://127.0.0.1/ns/nl_userbase/index/index.php '),
(274, 'happyFonzy', 'happyFonzy', '044fe1cdd34742a51ac29cbc57647cf3', 'eo4', 1, 'admin-activated', '127.0.0.1', '2011-08-20 15:01:20', '', '2011-08-24 10:33:28', 'dsds@dsds22.com', '', 1, '', '0000-00-00 00:00:00', '', 0, 'IE9', 'WINXP', 'ool', 'ZZ', '', 'admin-created', 'admin-created', 0, NULL, NULL, 'N/A', 'not set', 'none', '---', NULL, NULL, '0000-00-00 00:00:00', 0, 'http://127.0.0.1/ns/nl_userbase/index/index.php '),
(273, 'HuskyStarCraft', 'HuskyStarCraft', 'e689df755060bf4ac69dfe1a88058fbd', '&}L', 1, 'admin-activated', '127.0.0.1', '2011-08-14 15:01:15', '', '2011-08-24 10:33:28', 'husky@youtube.com', '', 1, '', '0000-00-00 00:00:00', '', 0, 'FFX', 'WIN7', 'en', 'US', '', 'admin-created', 'admin-created', 0, NULL, NULL, 'N/A', 'not set', 'none', '---', NULL, NULL, '0000-00-00 00:00:00', 0, 'http://127.0.0.1/ns/nl_userbase/index/index.php '),
(279, 'james calana', 'james calana', '839ba1027897fd62a54be462c4a5761e', 'e(6', 1, 'admin-activated', '127.0.0.1', '2011-09-19 18:18:34', '127.0.0.1', '2011-09-19 18:18:34', 'jdjdjd@skjskjs.coms', '', 1, '', '0000-00-00 00:00:00', '', 0, 'IE9', 'WINXP', 'ool', 'ZZ', '', 'admin-created', 'admin-created', 0, NULL, NULL, 'N/A', 'not set', 'none', '---', NULL, NULL, '0000-00-00 00:00:00', 0, 'http://127.0.0.1/ns/nl_userbase/index/index.php '),
(280, 'jamestestguy', 'jamestestguy', '8039ac2695d5db1839a7992691cbc215', '_im', 1, 'admin-activated', '127.0.0.1', '2011-09-22 22:03:00', '127.0.0.1', '2011-09-23 09:20:46', 'james@testguy.com', '', 1, 'f0cda6ffc2084ed3a4f2638364c30e1d', '2011-09-22 22:57:01', '127.0.0.1', 0, 'IE9', 'WINXP', 'ool', 'ZZ', '', 'admin-created', 'admin-created', 0, NULL, NULL, 'N/A', 'not set', 'none', '---', NULL, NULL, '0000-00-00 00:00:00', 0, 'http://127.0.0.1/ns/nl_userbase/index/index.php '),
(281, 'testguy223', 'testguy223', '354f11bcd730d5528c7e36c296d5c9a1', 'a|G', 1, '1316729024', '127.0.0.1', '2011-09-22 23:03:44', '127.0.0.1', '2011-09-22 23:03:44', 'password@sjhjsh.com', '', 4, '', '0000-00-00 00:00:00', '', 0, 'FFX', 'WINXP', 'en', 'ZZ', '', 'type-in-traffic', 'type-in-traffic', 0, NULL, NULL, 'N/A', '1024x768', 'none', '---', NULL, NULL, '0000-00-00 00:00:00', 0, 'http://127.0.0.1/ns/nl_userbase/index/index.php '),
(282, 'testguy2233', 'testguy2233', 'e9ccb8a1b67e9ebd8665955e701ab552', 'Zde', 1, '1316729106', '127.0.0.1', '2011-09-22 23:05:06', '127.0.0.1', '2011-09-22 23:05:06', 'password@sjh3jsh.com', '', 4, '', '0000-00-00 00:00:00', '', 0, 'FFX', 'WINXP', 'en', 'ZZ', '', 'type-in-traffic', 'type-in-traffic', 0, NULL, NULL, 'N/A', '1024x768', 'none', '---', NULL, NULL, '0000-00-00 00:00:00', 0, 'http://127.0.0.1/ns/nl_userbase/index/index.php '),
(291, 'jamesfloyd', 'jamesfloyd', '61767e63adc43bc389fda3239377caa7', 'D/', 1, 'admin-activated', '127.0.0.1', '2011-09-24 21:47:45', '127.0.0.1', '2011-09-24 21:47:45', 'dsfdsf@sfdsf.vom', '', 2, '', '0000-00-00 00:00:00', '', 0, 'SAF', 'WIN98', 'lt', 'GB', '', 'admin-created', 'http://www.theseconddomain.com', 0, NULL, NULL, 'N/A', 'not set', 'none', '---', NULL, NULL, '0000-00-00 00:00:00', 0, 'http://127.0.0.1/ns/nl_userbase/index/index.php '),
(300, 'mynameissms', 'mynameissms', 'e30613b7d29c3645e368cf6689cb9ccd', 'Qa|', 1, 'admin-activated', '127.0.0.1', '2011-09-26 11:15:00', '127.0.0.1', '2011-09-26 11:15:00', 'sms@example.com', '', 1, '', '0000-00-00 00:00:00', '', 0, 'IE9', 'WINXP', 'ool', 'ZZ', '', 'admin-created', 'admin-created', 0, NULL, NULL, 'N/A', 'not set', 'none', '---', '', '', '2011-09-26 11:15:00', 0, 'http://127.0.0.1/ns/nl_userbase/index/index.php '),
(301, 'mynameissms2', 'mynameissms2', 'faabfcd716aa76f7f3191a586cd5e232', '<$5', 1, 'admin-activated', '127.0.0.1', '2011-09-26 11:15:26', '127.0.0.1', '2011-09-26 11:15:26', 'sms@examp2le.com', '', 1, '', '0000-00-00 00:00:00', '', 0, 'IE9', 'WINXP', 'ool', 'ZZ', '', 'admin-created', 'admin-created', 0, NULL, NULL, 'N/A', 'not set', 'none', '---', '', '', '0000-00-00 00:00:00', 0, 'http://127.0.0.1/ns/nl_userbase/index/index.php '),
(302, 'unlimitedguy', 'unlimitedguy', '0a9f4b4126c1b6b606339783a4f62bd3', '7wk', 1, 'admin-activated', '127.0.0.1', '2011-09-26 11:56:05', '127.0.0.1', '2011-09-26 11:56:05', 'paskhd@exas.com', '', 1, '', '0000-00-00 00:00:00', '', 0, 'SAF', 'WIN7', 'ab', 'GB', '', 'admin-created', 'admin-created', 0, NULL, NULL, 'N/A', 'not set', 'none', '---', '', '', '0000-00-00 00:00:00', 0, 'http://127.0.0.1/ns/nl_userbase/index/index.php '),
(303, 'james t kirk', 'james t kirk', 'f7ea8089a66959ef1c7cb19210ae12e9', '.Vj', 1, 'admin-activated', '127.0.0.1', '2011-09-27 10:36:52', '127.0.0.1', '2011-09-27 10:36:52', 'startrek@finalfrontier.com', '', 1, '', '0000-00-00 00:00:00', '', 0, 'IE9', 'WINXP', 'ab', 'ZZ', '', 'admin-created', 'admin-created', 0, NULL, NULL, 'N/A', 'not set', 'none', '---', '', '', '0000-00-00 00:00:00', 0, 'http://127.0.0.1/ns/nl_userbase/index/index.php '),
(304, 'joebloggs', 'joebloggs', '638b12512eacf028ecdf3a29700979a3', 'Q,+', 1, '1317548802', '127.0.0.1', '2011-10-02 10:46:42', '127.0.0.1', '2011-10-02 10:46:42', 'joe@placeholder.com', '', 4, '', '0000-00-00 00:00:00', '', 0, 'FFX', 'WINXP', 'en', 'ZZ', '', 'type-in-traffic', 'type-in-traffic', 0, NULL, NULL, 'N/A', '1024x768', 'none', '---', '', '', '0000-00-00 00:00:00', 0, 'http://127.0.0.1/ns/nl_userbase/index/index.php '),
(305, 'cookiemonster', 'cookiemonster', 'e21a0dd22bf660150b8b99966f7c7c2f', 'q]Q', 1, '1317549156', '127.0.0.1', '2011-10-02 10:52:36', '127.0.0.1', '2011-10-02 10:52:36', 'paoisois@skjsjh.com', '', 4, '', '0000-00-00 00:00:00', '', 0, 'FFX', 'WINXP', 'en', 'GB', '', 'type-in-traffic', 'type-in-traffic', 0, NULL, NULL, 'N/A', '1024x768', 'none', '---', '', '', '0000-00-00 00:00:00', 0, 'http://127.0.0.1/ns/nl_userbase/index/index.php '),
(306, 'cityoflondon', 'cityoflondon', '0ab861fe70b02fda8693b605bed7d948', '+3R', 1, '1317549535', '127.0.0.1', '2011-10-02 10:58:55', '127.0.0.1', '2011-10-02 10:58:55', 'banks@rich.com', '', 4, '', '0000-00-00 00:00:00', '', 0, 'FFX', 'WINXP', 'en', 'ZZ', '', 'type-in-traffic', 'type-in-traffic', 0, NULL, NULL, 'N/A', '1024x768', 'none', '---', '', '', '0000-00-00 00:00:00', 0, 'http://127.0.0.1/ns/nl_userbase/index/index.php'),
(314, 'a better name', 'a better name', '542574b8e281cc88e20dd75e2b97b814', '+5', 1, 'admin-activated', '127.0.0.1', '2011-11-22 18:33:36', 'no visit', '0000-00-00 00:00:00', 'newuser@example.com', '', 2251, '5de9d9424c08733315f340664ff98558', '2011-11-22 21:29:01', '127.0.0.1', 1, 'IE9', 'WINXP', 'ool', 'US', '', 'admin-created', 'admin-created', 0, NULL, NULL, 'N/A', 'not set', 'none', '---', '', '', '0000-00-00 00:00:00', 0, 'admin-cp'),
(315, 'anewusername', 'anewusername', 'a85cba796c806124b9aff9c910561ca5', 'gW1', 1, 'admin-activated', '127.0.0.1', '2011-11-22 20:03:04', 'no visit', '0000-00-00 00:00:00', 'myemail@example.com', '', 4, '', '0000-00-00 00:00:00', '', 0, 'IE9', 'WINXP', 'ool', 'ZZ', '', 'admin-created', 'admin-created', 0, NULL, NULL, 'N/A', 'not set', 'none', '---', '', '', '0000-00-00 00:00:00', 0, 'admin-cp'),
(316, 'anewusername2', 'anewusername2', '3689b8580b6718aa4a1e59b3539a691e', ';$v', 1, 'admin-activated', '127.0.0.1', '2011-11-22 20:03:18', 'no visit', '0000-00-00 00:00:00', 'myemail2@example.com', '', 4, '', '0000-00-00 00:00:00', '', 0, 'IE9', 'WINXP', 'ool', 'ZZ', '', 'admin-created', 'admin-created', 0, NULL, NULL, 'N/A', 'not set', 'none', '---', '', '', '0000-00-00 00:00:00', 0, 'admin-cp');
