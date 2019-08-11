-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2017 at 03:35 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `weltecalumni`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `password`, `status`) VALUES
(1, 'Administrator', 'admin', 'c796cea6548aaccb53386840407cb7ef', 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `commenter_id` int(11) NOT NULL,
  `commenter_name` varchar(100) NOT NULL,
  `created_on` datetime NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `content`, `commenter_id`, `commenter_name`, `created_on`, `status`) VALUES
(1, 2, 'CodeIgniter is a good framework but nowadays Laravel framework is more popular than CodeIgniter.', 29, 'Saju R Nath', '2017-09-09 09:43:18', 'Active'),
(2, 2, 'You are right Mr. Saju', 26, 'John Doe', '2017-09-09 15:12:11', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `country` varchar(50) NOT NULL DEFAULT '',
  `iso2` varchar(2) NOT NULL DEFAULT '',
  `iso3` varchar(3) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country`, `iso2`, `iso3`) VALUES
(1, 'AFGHANISTAN', 'AF', 'AFG'),
(2, 'ALAND ISLANDS', 'AX', 'ALA'),
(3, 'ALBANIA', 'AL', 'ALB'),
(4, 'ALGERIA', 'DZ', 'DZA'),
(5, 'AMERICAN SAMOA', 'AS', 'ASM'),
(6, 'ANDORRA', 'AD', 'AND'),
(7, 'ANGOLA', 'AO', 'AGO'),
(8, 'ANGUILLA', 'AI', 'AIA'),
(9, 'ANTARCTICA', 'AQ', ''),
(10, 'ANTIGUA AND BARBUDA', 'AG', 'ATG'),
(11, 'ARGENTINA', 'AR', 'ARG'),
(12, 'ARMENIA', 'AM', 'ARM'),
(13, 'ARUBA', 'AW', 'ABW'),
(14, 'AUSTRALIA', 'AU', 'AUS'),
(15, 'AUSTRIA', 'AT', 'AUT'),
(16, 'AZERBAIJAN', 'AZ', 'AZE'),
(17, 'BAHAMAS', 'BS', 'BHS'),
(18, 'BAHRAIN', 'BH', 'BHR'),
(19, 'BANGLADESH', 'BD', 'BGD'),
(20, 'BARBADOS', 'BB', 'BRB'),
(21, 'BELARUS', 'BY', 'BLR'),
(22, 'BELGIUM', 'BE', 'BEL'),
(23, 'BELIZE', 'BZ', 'BLZ'),
(24, 'BENIN', 'BJ', 'BEN'),
(25, 'BERMUDA', 'BM', 'BMU'),
(26, 'BHUTAN', 'BT', 'BTN'),
(27, 'BOLIVIA, PLURINATIONAL STATE OF', 'BO', 'BOL'),
(28, 'BONAIRE, SINT EUSTATIUS AND SABA', 'BQ', 'BES'),
(29, 'BOSNIA AND HERZEGOVINA', 'BA', 'BIH'),
(30, 'BOTSWANA', 'BW', 'BWA'),
(31, 'BOUVET ISLAND', 'BV', ''),
(32, 'BRAZIL', 'BR', 'BRA'),
(33, 'BRITISH INDIAN OCEAN TERRITORY', 'IO', ''),
(34, 'BRUNEI DARUSSALAM', 'BN', 'BRN'),
(35, 'BULGARIA', 'BG', 'BGR'),
(36, 'BURKINA FASO', 'BF', 'BFA'),
(37, 'BURUNDI', 'BI', 'BDI'),
(38, 'CAMBODIA', 'KH', 'KHM'),
(39, 'CAMEROON', 'CM', 'CMR'),
(40, 'CANADA', 'CA', 'CAN'),
(41, 'CAPE VERDE', 'CV', 'CPV'),
(42, 'CAYMAN ISLANDS', 'KY', 'CYM'),
(43, 'CENTRAL AFRICAN REPUBLIC', 'CF', 'CAF'),
(44, 'CHAD', 'TD', 'TCD'),
(45, 'CHILE', 'CL', 'CHL'),
(46, 'CHINA', 'CN', 'CHN'),
(47, 'CHRISTMAS ISLAND', 'CX', ''),
(48, 'COCOS (KEELING) ISLANDS', 'CC', ''),
(49, 'COLOMBIA', 'CO', 'COL'),
(50, 'COMOROS', 'KM', 'COM'),
(51, 'CONGO', 'CG', 'COD'),
(52, 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'CD', ''),
(53, 'COOK ISLANDS', 'CK', 'COK'),
(54, 'COSTA RICA', 'CR', 'CRI'),
(55, 'COTE D\'IVOIRE', 'CI', 'CIV'),
(56, 'CROATIA', 'HR', 'HRV'),
(57, 'CUBA', 'CU', 'CUB'),
(58, 'CURACAO', 'CW', 'CUW'),
(59, 'CYPRUS', 'CY', 'CYP'),
(60, 'CZECH REPUBLIC', 'CZ', 'CZE'),
(61, 'DENMARK', 'DK', 'DNK'),
(62, 'DJIBOUTI', 'DJ', 'DJI'),
(63, 'DOMINICA', 'DM', 'DMA'),
(64, 'DOMINICAN REPUBLIC', 'DO', 'DOM'),
(65, 'ECUADOR', 'EC', 'ECU'),
(66, 'EGYPT', 'EG', 'EGY'),
(67, 'EL SALVADOR', 'SV', 'SLV'),
(68, 'EQUATORIAL GUINEA', 'GQ', 'GNQ'),
(69, 'ERITREA', 'ER', 'ERI'),
(70, 'ESTONIA', 'EE', 'EST'),
(71, 'ETHIOPIA', 'ET', 'ETH'),
(72, 'FALKLAND ISLANDS (MALVINAS)', 'FK', 'FLK'),
(73, 'FAROE ISLANDS', 'FO', 'FRO'),
(74, 'FIJI', 'FJ', 'FJI'),
(75, 'FINLAND', 'FI', 'FIN'),
(76, 'FRANCE', 'FR', 'FRA'),
(77, 'FRENCH GUIANA', 'GF', 'GUF'),
(78, 'FRENCH POLYNESIA', 'PF', 'PYF'),
(79, 'FRENCH SOUTHERN TERRITORIES', 'TF', ''),
(80, 'GABON', 'GA', 'GAB'),
(81, 'GAMBIA', 'GM', 'GMB'),
(82, 'GEORGIA', 'GE', 'GEO'),
(83, 'GERMANY', 'DE', 'DEU'),
(84, 'GHANA', 'GH', 'GHA'),
(85, 'GIBRALTAR', 'GI', 'GIB'),
(86, 'GREECE', 'GR', 'GRC'),
(87, 'GREENLAND', 'GL', 'GRL'),
(88, 'GRENADA', 'GD', 'GRD'),
(89, 'GUADELOUPE', 'GP', 'GLP'),
(90, 'GUAM', 'GU', 'GUM'),
(91, 'GUATEMALA', 'GT', 'GTM'),
(92, 'GUERNSEY', 'GG', ''),
(93, 'GUINEA', 'GN', 'GIN'),
(94, 'GUINEA-BISSAU', 'GW', 'GNB'),
(95, 'GUYANA', 'GY', 'GUY'),
(96, 'HAITI', 'HT', 'HTI'),
(97, 'HEARD ISLAND AND MCDONALD ISLANDS', 'HM', ''),
(98, 'HOLY SEE (VATICAN CITY STATE)', 'VA', 'VAT'),
(99, 'HONDURAS', 'HN', 'HND'),
(100, 'HONG KONG', 'HK', 'HKG'),
(101, 'HUNGARY', 'HU', 'HUN'),
(102, 'ICELAND', 'IS', 'ISL'),
(103, 'INDIA', 'IN', 'IND'),
(104, 'INDONESIA', 'ID', 'IDN'),
(105, 'IRAN, ISLAMIC REPUBLIC OF', 'IR', 'IRN'),
(106, 'IRAQ', 'IQ', 'IRQ'),
(107, 'IRELAND', 'IE', 'IRL'),
(108, 'ISLE OF MAN', 'IM', 'IMN'),
(109, 'ISRAEL', 'IL', 'ISR'),
(110, 'ITALY', 'IT', 'ITA'),
(111, 'JAMAICA', 'JM', 'JAM'),
(112, 'JAPAN', 'JP', 'JPN'),
(113, 'JERSEY', 'JE', ''),
(114, 'JORDAN', 'JO', 'JOR'),
(115, 'KAZAKHSTAN', 'KZ', 'KAZ'),
(116, 'KENYA', 'KE', 'KEN'),
(117, 'KIRIBATI', 'KI', 'KIR'),
(118, 'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF', 'KP', 'PRK'),
(119, 'KOREA, REPUBLIC OF', 'KR', 'KOR'),
(120, 'KUWAIT', 'KW', 'KWT'),
(121, 'KYRGYZSTAN', 'KG', 'KGZ'),
(122, 'LAO PEOPLE\'S DEMOCRATIC REPUBLIC', 'LA', 'LAO'),
(123, 'LATVIA', 'LV', 'LVA'),
(124, 'LEBANON', 'LB', 'LBN'),
(125, 'LESOTHO', 'LS', 'LSO'),
(126, 'LIBERIA', 'LR', 'LBR'),
(127, 'LIBYAN ARAB JAMAHIRIYA', 'LY', 'LBY'),
(128, 'LIECHTENSTEIN', 'LI', 'LIE'),
(129, 'LITHUANIA', 'LT', 'LTU'),
(130, 'LUXEMBOURG', 'LU', 'LUX'),
(131, 'MACAO', 'MO', 'MAC'),
(132, 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'MK', 'MKD'),
(133, 'MADAGASCAR', 'MG', 'MDG'),
(134, 'MALAWI', 'MW', 'MWI'),
(135, 'MALAYSIA', 'MY', 'MYS'),
(136, 'MALDIVES', 'MV', 'MDV'),
(137, 'MALI', 'ML', 'MLI'),
(138, 'MALTA', 'MT', 'MLT'),
(139, 'MARSHALL ISLANDS', 'MH', 'MHL'),
(140, 'MARTINIQUE', 'MQ', 'MTQ'),
(141, 'MAURITANIA', 'MR', 'MRT'),
(142, 'MAURITIUS', 'MU', 'MUS'),
(143, 'MAYOTTE', 'YT', ''),
(144, 'MEXICO', 'MX', 'MEX'),
(145, 'MICRONESIA, FEDERATED STATES OF', 'FM', 'FSM'),
(146, 'MOLDOVA, REPUBLIC OF', 'MD', 'MDA'),
(147, 'MONACO', 'MC', 'MCO'),
(148, 'MONGOLIA', 'MN', 'MNG'),
(149, 'MONTENEGRO', 'ME', 'MNE'),
(150, 'MONTSERRAT', 'MS', 'MSR'),
(151, 'MOROCCO', 'MA', 'MAR'),
(152, 'MOZAMBIQUE', 'MZ', 'MOZ'),
(153, 'MYANMAR', 'MM', 'MMR'),
(154, 'NAMIBIA', 'NA', 'NAM'),
(155, 'NAURU', 'NR', 'NRU'),
(156, 'NEPAL', 'NP', 'NPL'),
(157, 'NETHERLANDS', 'NL', 'NLD'),
(158, 'NEW CALEDONIA', 'NC', 'NCL'),
(159, 'NEW ZEALAND', 'NZ', 'NZL'),
(160, 'NICARAGUA', 'NI', 'NIC'),
(161, 'NIGER', 'NE', 'NER'),
(162, 'NIGERIA', 'NG', 'NGA'),
(163, 'NIUE', 'NU', 'NIU'),
(164, 'NORFOLK ISLAND', 'NF', 'NFK'),
(165, 'NORTHERN MARIANA ISLANDS', 'MP', 'MNP'),
(166, 'NORWAY', 'NO', 'NOR'),
(167, 'OMAN', 'OM', 'OMN'),
(168, 'PAKISTAN', 'PK', 'PAK'),
(169, 'PALAU', 'PW', 'PLW'),
(170, 'PALESTINIAN TERRITORY, OCCUPIED', 'PS', 'PSE'),
(171, 'PANAMA', 'PA', 'PAN'),
(172, 'PAPUA NEW GUINEA', 'PG', 'PNG'),
(173, 'PARAGUAY', 'PY', 'PRY'),
(174, 'PERU', 'PE', 'PER'),
(175, 'PHILIPPINES', 'PH', 'PHL'),
(176, 'PITCAIRN', 'PN', 'PCN'),
(177, 'POLAND', 'PL', 'POL'),
(178, 'PORTUGAL', 'PT', 'PRT'),
(179, 'PUERTO RICO', 'PR', 'PRI'),
(180, 'QATAR', 'QA', 'QAT'),
(181, 'REUNION', 'RE', 'REU'),
(182, 'ROMANIA', 'RO', 'ROU'),
(183, 'RUSSIAN FEDERATION', 'RU', 'RUS'),
(184, 'RWANDA', 'RW', 'RWA'),
(185, 'SAINT BARTHELEMY', 'BL', 'BLM'),
(186, 'SAINT HELENA, ASCENSION AND TRISTAN DA CUNHA', 'SH', 'SHN'),
(187, 'SAINT KITTS AND NEVIS', 'KN', 'KNA'),
(188, 'SAINT LUCIA', 'LC', 'LCA'),
(189, 'SAINT MARTIN (FRENCH PART)', 'MF', ''),
(190, 'SAINT PIERRE AND MIQUELON', 'PM', 'SPM'),
(191, 'SAINT VINCENT AND THE GRENADINES', 'VC', 'VCT'),
(192, 'SAMOA', 'WS', 'WSM'),
(193, 'SAN MARINO', 'SM', 'SMR'),
(194, 'SAO TOME AND PRINCIPE', 'ST', 'STP'),
(195, 'SAUDI ARABIA', 'SA', 'SAU'),
(196, 'SENEGAL', 'SN', 'SEN'),
(197, 'SERBIA', 'RS', 'SRB'),
(198, 'SEYCHELLES', 'SC', 'SYC'),
(199, 'SIERRA LEONE', 'SL', 'SLE'),
(200, 'SINGAPORE', 'SG', 'SGP'),
(201, 'SINT MAARTEN (DUTCH PART)', 'SX', ''),
(202, 'SLOVAKIA', 'SK', 'SVK'),
(203, 'SLOVENIA', 'SI', 'SVN'),
(204, 'SOLOMON ISLANDS', 'SB', 'SLB'),
(205, 'SOMALIA', 'SO', 'SOM'),
(206, 'SOUTH AFRICA', 'ZA', 'ZAF'),
(207, 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'GS', ''),
(208, 'SPAIN', 'ES', 'ESP'),
(209, 'SRI LANKA', 'LK', 'LKA'),
(210, 'SUDAN', 'SD', 'SDN'),
(211, 'SURINAME', 'SR', 'SUR'),
(212, 'SVALBARD AND JAN MAYEN', 'SJ', 'SJM'),
(213, 'SWAZILAND', 'SZ', 'SWZ'),
(214, 'SWEDEN', 'SE', 'SWE'),
(215, 'SWITZERLAND', 'CH', 'CHE'),
(216, 'SYRIAN ARAB REPUBLIC', 'SY', 'SYR'),
(217, 'TAIWAN, PROVINCE OF CHINA', 'TW', ''),
(218, 'TAJIKISTAN', 'TJ', 'TJK'),
(219, 'TANZANIA, UNITED REPUBLIC OF', 'TZ', 'TZA'),
(220, 'THAILAND', 'TH', 'THA'),
(221, 'TIMOR-LESTE', 'TL', 'TLS'),
(222, 'TOGO', 'TG', 'TGO'),
(223, 'TOKELAU', 'TK', 'TKL'),
(224, 'TONGA', 'TO', 'TON'),
(225, 'TRINIDAD AND TOBAGO', 'TT', 'TTO'),
(226, 'TUNISIA', 'TN', 'TUN'),
(227, 'TURKEY', 'TR', 'TUR'),
(228, 'TURKMENISTAN', 'TM', 'TKM'),
(229, 'TURKS AND CAICOS ISLANDS', 'TC', 'TCA'),
(230, 'TUVALU', 'TV', 'TUV'),
(231, 'UGANDA', 'UG', 'UGA'),
(232, 'UKRAINE', 'UA', 'UKR'),
(233, 'UNITED ARAB EMIRATES', 'AE', 'ARE'),
(234, 'UNITED KINGDOM', 'GB', 'GBR'),
(235, 'UNITED STATES', 'US', 'USA'),
(236, 'UNITED STATES MINOR OUTLYING ISLANDS', 'UM', ''),
(237, 'URUGUAY', 'UY', 'URY'),
(238, 'UZBEKISTAN', 'UZ', 'UZB'),
(239, 'VANUATU', 'VU', 'VUT'),
(240, 'VENEZUELA, BOLIVARIAN REPUBLIC OF', 'VE', 'VEN'),
(241, 'VIET NAM', 'VN', 'VNM'),
(242, 'VIRGIN ISLANDS, BRITISH', 'VG', 'VGB'),
(243, 'VIRGIN ISLANDS, U.S.', 'VI', 'VIR'),
(244, 'WALLIS AND FUTUNA', 'WF', 'WLF'),
(245, 'WESTERN SAHARA', 'EH', 'ESH'),
(246, 'YEMEN', 'YE', 'YEM'),
(247, 'ZAMBIA', 'ZM', 'ZMB'),
(248, 'ZIMBABWE', 'ZW', 'ZWE');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(3) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`) VALUES
(1, 'Information Technology'),
(2, 'Engineering'),
(3, 'Hospitality'),
(4, 'Tourism'),
(5, 'Hairdressing, Beauty and Make-up Artistry'),
(6, 'Construction'),
(7, 'Exercise Science & Recreation');

-- --------------------------------------------------------

--
-- Table structure for table `donate`
--

CREATE TABLE `donate` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `address` varchar(500) NOT NULL,
  `city` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL,
  `donationtype` varchar(150) NOT NULL,
  `submitted_on` datetime NOT NULL,
  `submitted_ip` text NOT NULL,
  `payment_status` tinyint(4) NOT NULL COMMENT '1=Pending, 2=Failure, 3=Success',
  `status` int(11) NOT NULL COMMENT '0=Inactive, 1=Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `donation`
--

CREATE TABLE `donation` (
  `id` bigint(20) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text,
  `address1` text NOT NULL,
  `address2` text,
  `city` text NOT NULL,
  `country_code` text NOT NULL,
  `email` text NOT NULL,
  `amount` int(11) NOT NULL,
  `donationtype` text NOT NULL,
  `submitted_on` datetime NOT NULL,
  `submitted_ip` text NOT NULL,
  `payment_status` tinyint(4) NOT NULL COMMENT '0=Pending, 1=Success, 2=Failed',
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `donation`
--

INSERT INTO `donation` (`id`, `first_name`, `last_name`, `address1`, `address2`, `city`, `country_code`, `email`, `amount`, `donationtype`, `submitted_on`, `submitted_ip`, `payment_status`, `status`) VALUES
(1, 'Saju', 'R Nath', 'Pandit Colony', 'Kowdiar', 'Trivandrum', 'IN', 'saju@invis.in', 500, 'Alumni Scholarship Fund', '2017-09-06 15:36:14', '::1', 2, 1),
(2, 'Mahesh', 'Mohan', 'Kaithamukku', '', 'Trivandrum', 'IN', 'maheshmohan@gmail.com', 150, 'Alumni Scholarship Fund', '2017-09-06 16:40:48', '::1', 1, 1),
(3, 'Vinod', 'Kumar', 'KK Lane', 'Pattom', 'Trivandrum', 'IN', 'vinuk@gmail.com', 100, 'College Business Development Fund', '2017-09-07 17:06:37', '::1', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `friendlist`
--

CREATE TABLE `friendlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `friend_name` varchar(100) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Request Pending'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friendlist`
--

INSERT INTO `friendlist` (`id`, `user_id`, `user_name`, `friend_name`, `friend_id`, `status`) VALUES
(19, 1, 'Frankjohn', 'laracroft', 6, 'Friends'),
(20, 1, 'Frankjohn', 'abhishekgupta', 5, 'Friends'),
(21, 3, 'jaspreetsingh', 'Frankjohn', 1, 'Friends'),
(22, 7, 'tomcruise', 'laracroft', 6, 'Friends'),
(24, 26, 'TestTest', 'SajuR%20Nath', 29, 'Friends');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` bigint(20) NOT NULL,
  `caption` text,
  `img_file` text NOT NULL,
  `display_order` bigint(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Table to store gallery pictures and its captions';

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `caption`, `img_file`, `display_order`, `status`) VALUES
(1, 'New skills. Or upskill', 'picture-20170817175945.png', NULL, 1),
(2, 'New skills. Or upskill', 'picture-20170817180155.jpg', NULL, 1),
(3, 'Jenny Lopez and her students', 'picture-20170817180303.jpg', NULL, 1),
(4, 'Who will be champion', 'picture-20170817180339.jpg', NULL, 1),
(5, '', 'picture-20170817180345.jpg', NULL, 1),
(6, 'Creativity in progress', 'picture-20170820094741.jpg', NULL, 1),
(7, 'Joan Fox in a class', 'picture-20170907070522.jpg', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `company` varchar(150) NOT NULL,
  `jobtitle` varchar(150) NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `city` varchar(150) NOT NULL,
  `address` text CHARACTER SET utf8 NOT NULL,
  `email` varchar(150) NOT NULL,
  `department` varchar(150) NOT NULL,
  `closing_date` date DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `company`, `jobtitle`, `description`, `city`, `address`, `email`, `department`, `closing_date`, `status`) VALUES
(11, 'Project Enterprise', 'Project Manager', 'Project Manager\r\n\r\n- Project experience\r\n- Management experience\r\n- Good at leading a team', 'Wellington', '\0New Zealand', 'aluminatorteam@gmail.com', '1', NULL, 1),
(12, 'Downer', 'Engineering', '- Telecommunications Engineer\r\n- Must have at least 3 years experience\r\n- Can work independently', 'Wellington', '\0New Zealand', 'aluminatorteam@gmail.com', '2', NULL, 1),
(13, 'Chow', 'Master Chef', '- At least 2 - 3 years experience\r\n- Diploma or Bachelor in Hospitality', 'Wellington', '\0New Zealand', 'aluminatorteam@gmail.com', '3', NULL, 1),
(14, 'Jetstar', 'Flight Attendant', '- Looking for fresh graduates of tourism to join our fun and enthusiastic team.', 'Welington', '\0New Zealand', 'aluminatorteam@gmail.com', '4', NULL, 1),
(15, 'Urge Salon', 'Hairstylist', '- At least 1 year experience', 'Wellington', '\0New Zealand', 'aluminatorteam@gmail.com', '5', NULL, 1),
(16, 'Building Ltd.', 'Builder', 'Looking for experienced builder who is very hard working and good at time management.', 'Wellington', '\0New Zealand', 'aluminatorteam@gmail.com', '6', NULL, 1),
(17, 'City Fitness', 'Personal Trainer', '- Looking for a friendly and health freak trainter', 'Wellington', '\0New Zealand', 'aluminatorteam@gmail.com', '7', NULL, 1),
(18, 'Hueray Technologies Pvt Ltd', 'Accounts Receivable Executive', 'Functional Area: Medical Billing/ RCM/ Claims Follow up/ Denials Management.\r\n\r\nPrimary role is to review and resolve unpaid and denied claims, thereby ensuring the health of the AR.\r\n\r\nPreferred skills\r\n\r\n0 – 4 years of experience in US Medical Billing Industry/ RCM processes.\r\nIn-depth understanding of the US Healthcare system, including the life-cycle of a claim, the most popular payers and HIPAA compliance.\r\nPrior engagement with working the most common denials from payers.\r\nAny prior experience of w', 'Trivandrum', 'Module No. 011, Ground Floor, Nila Building, Technopark', 'jobs@hueray.com', '1', '2017-09-19', 1),
(19, 'Company 1', 'Job Title 1', 'Brief Description 1', 'Location 1', 'Address 1', 'test1@test.in', '3', '2017-09-06', 0);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint(20) NOT NULL,
  `primary_title` text CHARACTER SET utf8 NOT NULL,
  `secondary_title` text CHARACTER SET utf8,
  `news_img` text,
  `content` text CHARACTER SET utf8 NOT NULL,
  `news_date` date NOT NULL,
  `display_order` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `primary_title`, `secondary_title`, `news_img`, `content`, `news_date`, `display_order`, `status`) VALUES
(1, 'New Zealand Certificate in Creativity', 'Start your creative journey!', 'news-20170820060543.jpg', 'Start your creative journey. Get a taste of a wide range of creative disciplines. You’ll learn about art and design, illustration, digital media, photography and film. Develop skills in digital modelling and 3D printing. Start to build a professional portfolio.\r\n\r\nWhat you will learn?\r\n\r\nExtend and explore concept drawing and illustration skills\r\n\r\nLearn fundamental digital camera operation skills – aperture, shutter speed, composition and lighting\r\n\r\nEnhance images using Adobe Photoshop and Illustrator\r\n\r\nBe introduced to film making through video camera operation, recording techniques and editing software\r\n\r\nExperience digital innovation - operate a laser cutter, 3D scanner, 3D printer and drawing tablet\r\n\r\nCreate 2D and 3D projects using digital drawing tools and workshop technology', '2017-08-17', NULL, 1),
(2, 'Who will be champion?', '', 'news-20170820060758.jpg', 'Who will be champion? St Pat\'s (Silvestream) take on Wellington College. Stream are unbeaten in this year\'s competition in the WelTec Premiership. Wellington are the 2016 Premiers.\r\n\r\nJoin us at Porirua Park, Sunday 20 August. 2.40pm kick off. Support your school. Follow www.facebook.com/weltec for our coverage of College Sport Wellington events.', '2017-08-16', NULL, 1),
(3, 'New Zealand', 'Country in Oceania', 'news-20170907093443.jpg', 'New Zealand is an island country in the southwestern Pacific Ocean. The country geographically comprises two main landmasses the North Island (or Te Ika-a-Māui), and the South Island (or Te Waipounamu) and around 600 smaller islands. New Zealand is situated some 1,500 kilometres (900 mi) east of Australia across the Tasman Sea and roughly 1,000 kilometres (600 mi) south of the Pacific island areas of New Caledonia, Fiji, and Tonga. Because of its remoteness, it was one of the last lands to be settled by humans. During its long period of isolation, New Zealand developed a distinct biodiversity of animal, fungal and plant life. The country\'s varied topography and its sharp mountain peaks, such as the Southern Alps, owe much to the tectonic uplift of land and volcanic eruptions. New Zealand\'s capital city is Wellington, while its most populous city is Auckland.\r\n\r\nSometime between 1250 and 1300 CE, Polynesians settled in the islands that later were named New Zealand and developed a distinctive Māori culture. In 1642, Dutch explorer Abel Tasman became the first European to sight New Zealand. In 1840, representatives of Britain and Māori chiefs signed the Treaty of Waitangi, which declared British sovereignty over the islands. In 1841, New Zealand became a colony within the British Empire and in 1907 it became a Dominion. Today, the majority of New Zealand\'s population of 4.7 million is of European descent; the indigenous Māori are the largest minority, followed by Asians and Pacific Islanders. Reflecting this, New Zealand\'s culture is mainly derived from Māori and early British settlers, with recent broadening arising from increased immigration. The official languages are English, Māori and New Zealand Sign Language, with English predominant.', '2017-09-06', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `body` text CHARACTER SET utf8 NOT NULL,
  `poster_id` int(11) NOT NULL,
  `poster_name` varchar(100) NOT NULL,
  `created_on` datetime NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `body`, `poster_id`, `poster_name`, `created_on`, `status`) VALUES
(1, 'Hey friends this is my first post.', 29, 'Saju R Nath', '2017-09-09 09:34:53', 'Active'),
(2, 'CodeIgniter is an Application Development Framework - a toolkit - for people who build web sites using PHP. Its goal is to enable you to develop projects much faster than you could if you were writing code from scratch, by providing a rich set of libraries for commonly needed tasks, as well as a simple interface and logical structure to access these libraries. CodeIgniter lets you creatively focus on your project by minimizing the amount of code needed for a given task.', 29, 'Saju R Nath', '2017-09-09 09:35:20', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` bigint(20) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text,
  `stud_id` text NOT NULL,
  `email` text NOT NULL,
  `gender` text NOT NULL,
  `department` int(11) NOT NULL,
  `license` text NOT NULL,
  `pw` text NOT NULL,
  `submitted_on` datetime NOT NULL,
  `submitted_ip` text NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(150) NOT NULL,
  `lastname` varchar(150) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `image` varchar(200) DEFAULT 'default-face.jpg',
  `created_on` date NOT NULL,
  `about` varchar(500) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `department` varchar(50) NOT NULL,
  `user_cv` text NOT NULL,
  `filetype` varchar(50) DEFAULT NULL,
  `driverlicense` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `student_id`, `email`, `password`, `gender`, `image`, `created_on`, `about`, `status`, `department`, `user_cv`, `filetype`, `driverlicense`) VALUES
(1, 'Frank', 'john', '', 'frank.frankjohn@yahoo.in', 'e10adc3949ba59abbe56e057f20f883e', 'male', 'default-face.jpg', '2014-07-23', 'hello i am frank john', 0, '5', '', '', ''),
(3, 'jaspreet', 'singh', '', 'jaspreet@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'male', 'default-face.jpg', '2014-07-23', 'Write Something About Yourself', 0, '4', '', '', ''),
(4, 'shera', 'singh', '', 'shera@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'male', 'default-face.jpg', '2014-07-23', 'Write Something About Yourself', 0, '2', '', '', ''),
(5, 'abhishek', 'gupta', '', 'abhishek@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'male', 'default-face.jpg', '2014-07-24', 'Write Something About Yourself', 0, '3', '', '', ''),
(6, 'lara', 'croft', '', 'lara@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'female', 'default-face.jpg', '2014-07-24', 'Write Something About Yourself', 0, '1', '', '', ''),
(7, 'tom', 'cruise', '', 'tom@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'male', 'default-face.jpg', '2014-08-02', 'I am a film actor in hollywood', 0, '7', '', '', ''),
(26, 'John', 'Doe', '12345', 'test@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'male', 'default-face.jpg', '2015-10-09', 'Test test test', 1, '1', '', '', 'Full license'),
(29, 'Saju', 'R Nath', 'S112', 'saju@invis.in', '11909d7511ece3d05fc048b9be1157c0', 'male', 'saju-photo.jpg', '2017-08-10', 'PHP Programmer at Invis Multimedia', 1, '1', 'APRF_website.doc', NULL, 'Full license'),
(30, 'Sherin', 'F', 'INVIS052', 'sherin@gmail.com', '11909d7511ece3d05fc048b9be1157c0', 'Female', 'default-face.jpg', '2017-09-01', 'Write Something About Yourself', 0, '1', '', NULL, 'Full license');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donate`
--
ALTER TABLE `donate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donation`
--
ALTER TABLE `donation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friendlist`
--
ALTER TABLE `friendlist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=249;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `donate`
--
ALTER TABLE `donate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `donation`
--
ALTER TABLE `donation`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `friendlist`
--
ALTER TABLE `friendlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
