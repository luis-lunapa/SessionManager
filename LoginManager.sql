

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION; -- Si falla algo matar todo
SET time_zone = "+00:00";


-- Database: `LoginManager`
--
CREATE DATABASE IF NOT EXISTS `LoginManager` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `LoginManager`;


CREATE TABLE `Log` (
  `idRecord` int(11) NOT NULL,
  `idLogin` int(11) NOT NULL,
  `query` varchar(2000) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



CREATE TABLE `Login` (
  `idLogin` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `loginDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `token` text COLLATE utf8_bin NOT NULL,
  `status` enum('closed','active') COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


INSERT INTO `Login` (`idLogin`, `idUsuario`, `loginDate`, `token`, `status`) VALUES
(81, 1, '2019-03-21 09:17:15', '87a98c3a9be606f7a0909c6c5f0d2b96', 'closed'),
(82, 1, '2019-03-21 22:03:52', '7b68f30402eecad1dd9aa72998c42e53', 'closed'),
(83, 1, '2019-03-22 16:56:21', 'af14a87a413b72e6fc89a851d3c18368', 'closed'),
(84, 1, '2019-03-22 16:58:07', '74601b553ec6290c8280b1a83e8967e5', 'active');



CREATE TABLE `Permission` (
  `idPermission` int(11) NOT NULL,
  `permission` varchar(200) COLLATE utf8_bin NOT NULL,
  `type` varchar(15) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


INSERT INTO `Permission` (`idPermission`, `permission`, `type`) VALUES
(1, 'login', 'GET'),
(2, 'register', 'POST');



CREATE TABLE `Rol` (
  `idRol` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idPermiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



CREATE TABLE `User` (
  `idUser` int(11) NOT NULL,
  `username` varchar(50) CHARACTER SET utf8 NOT NULL,
  `password` varchar(20) CHARACTER SET utf8 NOT NULL,
  `name` varchar(200) CHARACTER SET utf8 NOT NULL,
  `email` varchar(200) CHARACTER SET utf8 NOT NULL,
  `description` varchar(1000) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Sin descripcion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


INSERT INTO `User` (`idUser`, `username`, `password`, `name`, `email`, `description`) VALUES
(1, 'luis.lunapa', '12345', 'Luis Gerardo Luna Pena', 'luis.lunapa@outlook.com', 'Ing en Sistemas Computacionales'),
(2, 'moni.pa97', '12345', 'Monica Perez Paredes', 'monicaperezparedes6@gmail.com', 'Contadora');


ALTER TABLE `Log`
  ADD PRIMARY KEY (`idRecord`);


ALTER TABLE `Login`
  ADD PRIMARY KEY (`idLogin`);


ALTER TABLE `Permission`
  ADD PRIMARY KEY (`idPermission`);


ALTER TABLE `Rol`
  ADD PRIMARY KEY (`idRol`);

ALTER TABLE `User`
  ADD PRIMARY KEY (`idUser`);


ALTER TABLE `Log`
  MODIFY `idRecord` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `Login`
  MODIFY `idLogin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;


ALTER TABLE `Permission`
  MODIFY `idPermission` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `Rol`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `User`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;
