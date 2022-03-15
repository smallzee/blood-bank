SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'password');

CREATE TABLE `donor` (
  `id` int(11) NOT NULL,
  `institution` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `blood_group` varchar(15) NOT NULL,
  `donation_date` varchar(45) NOT NULL,
  `donation_time` varchar(45) NOT NULL,
  `o_type` varchar(45) DEFAULT 'donor',
  `date_donated` varchar(45) DEFAULT NULL,
  `status` varchar(45) NOT NULL DEFAULT 'pending'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `donor` (`id`, `institution`, `name`, `email`, `phone`, `blood_group`, `donation_date`, `donation_time`, `o_type`, `date_donated`, `status`) VALUES
(1, 3, 'Olatunji Fatai Abiodun', 'sirhollyfat@gmail.com', '08130327697', 'O+', '2019-11-02', '10:23', 'donor', '1572624143', 'Donated'),
(2, 2, 'Olajide Joshua', 'josh@food.com', '08130232329', 'A+', '2019-11-03', '12:03', 'receiver', NULL, 'Rejected'),
(3, 1, 'JoshTom', 'sirhollyfat@gmail.com', '08136023230', 'A-', '2019-11-30', '12:00', 'receiver', '1572624978', 'Received');

CREATE TABLE `institution` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `campus` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `institution` (`id`, `name`, `campus`, `location`) VALUES
(1, 'The Federal Polytechnic, Ede', 'North', 'Ede'),
(2, 'The Federal Polytechnic, Ede', 'South', 'Ede'),
(3, 'Lauutech', 'Osogbo', 'Osogbo'),
(4, 'Uniosun', 'Osogbo', 'Osogbo'),
(5, 'Obafemi Awolowo University (OAU)', 'Main', 'Ife');

CREATE TABLE `receiver` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `blood_group` varchar(15) NOT NULL,
  `donation_center` int(11) NOT NULL,
  `donation_date` varchar(45) NOT NULL,
  `donation_time` varchar(45) NOT NULL,
  `date_donated` varchar(45) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `donor`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `institution`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `receiver`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
ALTER TABLE `donor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
ALTER TABLE `institution`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
ALTER TABLE `receiver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
