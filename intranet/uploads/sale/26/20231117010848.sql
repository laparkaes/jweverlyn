-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 23-11-16 18:15
-- 서버 버전: 10.4.24-MariaDB
-- PHP 버전: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `jweverlyn`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `access`
--

CREATE TABLE `access` (
  `access_id` int(11) NOT NULL,
  `module_id` int(11) DEFAULT NULL,
  `access` varchar(30) NOT NULL,
  `code` varchar(50) NOT NULL,
  `valid` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `access`
--

INSERT INTO `access` (`access_id`, `module_id`, `access`, `code`, `valid`) VALUES
(1, 1, 'Agregar módulo', 'authentication_add_module', 1),
(2, 1, 'Agregar acceso', 'authentication_add_access', 1),
(3, 1, 'Eliminar módulo', 'authentication_delete_module', 1),
(4, 1, 'Eliminar acceso', 'authentication_delete_access', 1),
(5, 2, 'Agregar rol', 'authentication_add_role', 1),
(6, 2, 'Eliminar rol', 'authentication_delete_role', 1),
(7, 2, 'Asignar rol y acceso', 'authentication_assign_role_access', 1),
(8, 5, 'probando para eliminar', 'cualquiercodigoaqui', 0),
(9, 1, 'Agregar acceso1', 'authentication_add_access1', 0);

-- --------------------------------------------------------

--
-- 테이블 구조 `account`
--

CREATE TABLE `account` (
  `account_id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(250) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `doc_number` varchar(15) NOT NULL DEFAULT '0',
  `tel` varchar(20) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `valid` tinyint(1) NOT NULL DEFAULT 1,
  `last_logged_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `registed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `account`
--

INSERT INTO `account` (`account_id`, `role_id`, `username`, `password`, `image`, `name`, `doc_number`, `tel`, `mobile`, `address`, `valid`, `last_logged_at`, `updated_at`, `registed_at`) VALUES
(1, 1, 'laparkaes@gmail.com', '$2y$10$GgXbbw1zKLysaytroxNpl.Vp3EsLKplcnKr6H/6xqZBimt7ENGnf6', NULL, 'Georgio Park', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 00:25:42', '2023-08-07 01:21:19'),
(2, 5015, 'fer.lana@gmail.com', '$2y$10$GH/GNjy6UEBgKxCoYU/8q.Nzk8YQBJ63eijfpURFLzTwq.VplPDeS', NULL, 'Fernando Lana', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 00:28:06', '2023-08-15 00:28:06'),
(3, 5019, 'gat.park@gmail.com', '$2y$10$iT7ez7UC6xWWnp6JKGEsO.ih5/wOTIcqSNnm43.Oo7A57e97mfk..', NULL, 'Gatalina Park', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 00:28:31', '2023-08-15 00:28:31'),
(4, 5015, 'smith.alice@gmail.com', '$2y$10$ja8kC./pSnPk5NXqnTaOtOytwFOzsktR8lug.fDMyBEbwje6coBpa', NULL, 'Smith Alice', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:38', '2023-08-15 04:43:38'),
(5, 5011, 'smith.bob@gmail.com', '$2y$10$moUTKMAz/iveMFDbMMtBfuFb8fGkyo3hRjesAAMWcmph2BG1iKoC.', NULL, 'Smith Bob', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:38', '2023-08-15 04:43:38'),
(6, 5003, 'smith.charlie@gmail.com', '$2y$10$s5TV8sShgZQFTy5mXPZlFuRWgiPcYNRTXheqbTwYWblK4TQSALpZW', NULL, 'Smith Charlie', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:38', '2023-08-15 04:43:38'),
(7, 5025, 'smith.david@gmail.com', '$2y$10$2S2EPqiudK08n8Ca0WRLwOtu1oZjSffJt0Io7dqbH/.Bd6kWbK/ee', NULL, 'Smith David', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:38', '2023-08-15 04:43:38'),
(8, 5020, 'smith.emily@gmail.com', '$2y$10$Ad39oDVhJPuOPYhoChsUz.5uXVtLN/EQM52quGDK5VoThzPT.7q/2', NULL, 'Smith Emily', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:38', '2023-08-15 04:43:38'),
(9, 5030, 'smith.frank@gmail.com', '$2y$10$cJQTHDhgeCGpnK9JwZZsRu/FxY.oJdQJWfTDgS2grUX2oQRkRIwBK', NULL, 'Smith Frank', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:38', '2023-08-15 04:43:38'),
(10, 5016, 'smith.grace@gmail.com', '$2y$10$wa870g5O1pmFjYrcqoqsgeGHQuutjGZrIQ7t8BiM9k28dbzy1OmGm', NULL, 'Smith Grace', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:38', '2023-08-15 04:43:38'),
(11, 5024, 'smith.henry@gmail.com', '$2y$10$YjOtQ/9jK3jCaNJ0WXDkRuhuCFaW.OUqL4SS9TCh9Lx1UBCDHi0Qe', NULL, 'Smith Henry', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:38', '2023-08-15 04:43:38'),
(12, 5028, 'smith.isabella@gmail.com', '$2y$10$bkFsvh15FScrFh1aFtxg..76.nJfJg0w8xblQW/8/4nx.nCfBj9vK', NULL, 'Smith Isabella', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:38', '2023-08-15 04:43:38'),
(13, 5030, 'smith.jack@gmail.com', '$2y$10$Ag9CAZ6/GuUNbFnrgUXrGuTjJ/2h9sAv/V.WvnhCH2keqMjfeKaD.', NULL, 'Smith Jack', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:38', '2023-08-15 04:43:38'),
(14, 5020, 'smith.katherine@gmail.com', '$2y$10$F84vVq49NIQodW/K02XVFesZdPwJAmypFb1anrGWoysIbo4XO1mt6', NULL, 'Smith Katherine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:38', '2023-08-15 04:43:38'),
(15, 5013, 'smith.liam@gmail.com', '$2y$10$eSj58MZulLvDgIZ7cqTpc.MzhTsF6dpqJvgRM3ZTfe0o0qcREIQfq', NULL, 'Smith Liam', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:38', '2023-08-15 04:43:38'),
(16, 2, 'smith.mia@gmail.com', '$2y$10$3tg34wAwJISddMHms4AdPOot13yKHDjc1H1h1vfXmpDfMx4tYKxa.', NULL, 'Smith Mia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:38', '2023-08-15 04:43:38'),
(17, 5020, 'smith.noah@gmail.com', '$2y$10$IOGQT/eXvBHK.TfLsMhJYeXGqmm7K4meNcxpvGDHvSTZ2PwH8WXEC', NULL, 'Smith Noah', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:38', '2023-08-15 04:43:38'),
(18, 5018, 'smith.olivia@gmail.com', '$2y$10$6z8avczEaiqx5KYYdkMK6O1WB0.Jcp0YpvjCJZskbapBaQdgBZQaS', NULL, 'Smith Olivia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:38', '2023-08-15 04:43:38'),
(19, 5018, 'smith.penelope@gmail.com', '$2y$10$0j9Z6FQYDDyrBpeJBO/zc.zENd8p.4r8dXhCRJyHHMcXM.4/iPAb6', NULL, 'Smith Penelope', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:38', '2023-08-15 04:43:38'),
(20, 5030, 'smith.quinn@gmail.com', '$2y$10$VqG2DR.kGHF386t/Il7VqerBahzI/DAkStnYm4FASmQt8b0YJEpdq', NULL, 'Smith Quinn', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:39', '2023-08-15 04:43:39'),
(21, 4, 'smith.ryan@gmail.com', '$2y$10$cVpOh6v5vtEqWuW7./yJyuftOeGzpDkrpcu4Lu2EyYUiIgKgd8Ihu', NULL, 'Smith Ryan', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:39', '2023-08-15 04:43:39'),
(22, 5024, 'smith.sophia@gmail.com', '$2y$10$oveZDsqbnhlbMhA3z9RXuu4/6FLCdqNhkfNmqitrV8CaQtEbOEbj6', NULL, 'Smith Sophia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:39', '2023-08-15 04:43:39'),
(23, 5011, 'smith.thomas@gmail.com', '$2y$10$QBbLhHiYsXUvpoOLSLYXpeBke8VSwablr7/rte1EMMt1oj5gDVi12', NULL, 'Smith Thomas', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:39', '2023-08-15 04:43:39'),
(24, 5013, 'smith.uma@gmail.com', '$2y$10$c6e4JLOff45NTQ/dHFwypughKOpVuRb0bZkWX/TBuF3kQ3ROGmE0W', NULL, 'Smith Uma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:39', '2023-08-15 04:43:39'),
(25, 5009, 'smith.victoria@gmail.com', '$2y$10$nDs0E5AiTyG/zNa5kAzFh.5STVTRUUyt5IibaGb.z4aPygs3bGulO', NULL, 'Smith Victoria', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:39', '2023-08-15 04:43:39'),
(26, 5013, 'smith.william@gmail.com', '$2y$10$zrGNv7ubg5zrFjIrD1w3KeNHfB2Rj0AW7UHXzJ6tND0tzULdUsZ12', NULL, 'Smith William', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:39', '2023-08-15 04:43:39'),
(27, 5016, 'smith.xander@gmail.com', '$2y$10$QEFwBJD2Ax8kKVIJQOp3d.X1OkFZMQO2577iYYF22g4kh5e5E9zUe', NULL, 'Smith Xander', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:39', '2023-08-15 04:43:39'),
(28, 5006, 'smith.yasmine@gmail.com', '$2y$10$6bW2iJ3Js5uo5.d16snSH.zbYgjDIbYgiPiKH9lOHNjJzgfB7KmCe', NULL, 'Smith Yasmine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:39', '2023-08-15 04:43:39'),
(29, 5025, 'smith.zachary@gmail.com', '$2y$10$cFY9fYLah0yDAzn3iKXQ.eWSRkrsHycO6wV5ImcSklhKGcSXLIB4y', NULL, 'Smith Zachary', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:39', '2023-08-15 04:43:39'),
(30, 5014, 'smith.ava@gmail.com', '$2y$10$hewmdLGxQKQ30sVsL7bNNOeJ801oRO7n7zRRS7ux25g8qNS6mhIgS', NULL, 'Smith Ava', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:39', '2023-08-15 04:43:39'),
(31, 5023, 'smith.benjamin@gmail.com', '$2y$10$3onCiQwoUN6EE6F7DymsF.4HMXhvVgifoe5eA6cA5bvm17ObsT7g6', NULL, 'Smith Benjamin', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:39', '2023-08-15 04:43:39'),
(32, 5026, 'smith.chloe@gmail.com', '$2y$10$lROJXKuXugo4l2/jhuRYRe2QxlZt9H0GkvONMr1lmk7EbyLJkTgTy', NULL, 'Smith Chloe', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:39', '2023-08-15 04:43:39'),
(33, 5022, 'smith.daniel@gmail.com', '$2y$10$AR6y9jgCu47SiVLW4QPV9OBQyelZP5vzDswgVXBSfvIItXU696dF6', NULL, 'Smith Daniel', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:39', '2023-08-15 04:43:39'),
(34, 5018, 'smith.emma@gmail.com', '$2y$10$k1sRWkxnVlUUb45JzuJbUuHr1pbn.wN4WrJgUqLOc0QtFBm/Q08Aq', NULL, 'Smith Emma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:39', '2023-08-15 04:43:39'),
(35, 5009, 'johnson.alice@gmail.com', '$2y$10$HINYVFZqO5XZ659kmKjEwuwdj37cbB3V3Nrbeiro01lofX9DcA4c2', NULL, 'Johnson Alice', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:39', '2023-08-15 04:43:39'),
(36, 5011, 'johnson.bob@gmail.com', '$2y$10$CFakOwvI91w7Rp8GOsv1x.HqOlXhBC7OP5pLGmUzuSkiaghX9quNa', NULL, 'Johnson Bob', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:39', '2023-08-15 04:43:39'),
(37, 5028, 'johnson.charlie@gmail.com', '$2y$10$kKiBybRNjF51PacycK2qCuba/FLB/E461MEiELaIWdDownQBWFgj6', NULL, 'Johnson Charlie', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:39', '2023-08-15 04:43:39'),
(38, 5031, 'johnson.david@gmail.com', '$2y$10$0Wz8S2I5oQukqmt.Etj.o.rxv4WTpFnhx5mncmrV/Fwka292Adkay', NULL, 'Johnson David', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:39', '2023-08-15 04:43:39'),
(39, 2, 'johnson.emily@gmail.com', '$2y$10$.JNlG2K9MlzOhyX.sqqfceXSUGHZKrrHBubFjRiUE277tT5qNEr2K', NULL, 'Johnson Emily', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:40', '2023-08-15 04:43:40'),
(40, 5016, 'johnson.frank@gmail.com', '$2y$10$xxrxVZmfdHxF4JOOXd/WqOkCjDpOjgVjnYsQfIaz4U7HWeMXj00se', NULL, 'Johnson Frank', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:40', '2023-08-15 04:43:40'),
(41, 5007, 'johnson.grace@gmail.com', '$2y$10$UD5R2dkJuSNUXKC4HoMCC.kUkXuskOW5HZc0e8QShxpVdVNbCG6N2', NULL, 'Johnson Grace', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:40', '2023-08-15 04:43:40'),
(42, 5011, 'johnson.henry@gmail.com', '$2y$10$uOX4vhHQugET1bP35WSlguvg8.MBwbmBvZk2rUtZyOUOmGz7Z8wXm', NULL, 'Johnson Henry', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:40', '2023-08-15 04:43:40'),
(43, 4, 'johnson.isabella@gmail.com', '$2y$10$RDxJYXxRXjhjPG1KrnQbUun47ge5gqXy42YFGNGl7clDJAP8zXHXa', NULL, 'Johnson Isabella', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:40', '2023-08-15 04:43:40'),
(44, 5016, 'johnson.jack@gmail.com', '$2y$10$Gq3rZ3LBvrBPF.MoBY4l6edckdFz4ms.GHVei0Wc4ZiehWJSoIjDy', NULL, 'Johnson Jack', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:40', '2023-08-15 04:43:40'),
(45, 2, 'johnson.katherine@gmail.com', '$2y$10$lXPU2ooJl3wAySthFcE0UedPpW46pRI80rztgCcYA0YyKCWfg7xp.', NULL, 'Johnson Katherine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:40', '2023-08-15 04:43:40'),
(46, 5026, 'johnson.liam@gmail.com', '$2y$10$gsH1vfzfxv8EmMAmojzu8eqSURxUPMvZiGYOMxrFqpQBuvM6YiQEC', NULL, 'Johnson Liam', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:40', '2023-08-15 04:43:40'),
(47, 5003, 'johnson.mia@gmail.com', '$2y$10$.qhNfABzgyVB90uBasBLKOhnCGnIoORsM0TtA0WI26d3SMOX9LBy.', NULL, 'Johnson Mia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:40', '2023-08-15 04:43:40'),
(48, 5026, 'johnson.noah@gmail.com', '$2y$10$nmuTDCE6cNDD89eWZhqH2ugllcAJrWjbW2eWbCQOQKJFGKxa2un1m', NULL, 'Johnson Noah', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:40', '2023-08-15 04:43:40'),
(49, 5027, 'johnson.olivia@gmail.com', '$2y$10$mKicPuDa6wNUJmKvmkyOQuFe4yf6sZU./qBFI3T3dwsSVrBpj2li6', NULL, 'Johnson Olivia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:40', '2023-08-15 04:43:40'),
(50, 4, 'johnson.penelope@gmail.com', '$2y$10$Duj6IQDeLwbv8blohJwVguZY0rh4CnZnnWZqOU4aecN3IWjBgmTqC', NULL, 'Johnson Penelope', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:40', '2023-08-15 04:43:40'),
(51, 5006, 'johnson.quinn@gmail.com', '$2y$10$pqMKV8V5tnraj4gxugr4x.hfwsc4czmxpZmD8NpQy3k.gM0P24GRy', NULL, 'Johnson Quinn', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:40', '2023-08-15 04:43:40'),
(52, 5010, 'johnson.ryan@gmail.com', '$2y$10$eZbcmsBUAIoRxGzFGscZYe15wh5A2TOtt1nOVy5fwfQFLEQypfZIa', NULL, 'Johnson Ryan', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:40', '2023-08-15 04:43:40'),
(53, 5020, 'johnson.sophia@gmail.com', '$2y$10$9MlXfH6aBTbdNg7FemGKoOUBz/BSSBLl0OZgwzPiu2R1q/dEHS6Jy', NULL, 'Johnson Sophia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:40', '2023-08-15 04:43:40'),
(54, 1, 'johnson.thomas@gmail.com', '$2y$10$1eSqspr6.Fv2CJlhdeydqOvHeu2l1WKtCoUDnou6k.qYe.xdvLFau', NULL, 'Johnson Thomas', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:40', '2023-08-15 04:43:40'),
(55, 5022, 'johnson.uma@gmail.com', '$2y$10$IB7kGzhKI5NG4WiEoxExEOiFAa/pc/ncVTjVsYcAeKCm/2tbfu9Ja', NULL, 'Johnson Uma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:40', '2023-08-15 04:43:40'),
(56, 5017, 'johnson.victoria@gmail.com', '$2y$10$0VeDgs5iDacGkgJmU7P4VuZtUZULDFCpqF2oisP9QRg3UDPGk5mh2', NULL, 'Johnson Victoria', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:40', '2023-08-15 04:43:40'),
(57, 5007, 'johnson.william@gmail.com', '$2y$10$q49ttco7mlCyfumyhzkiHu0ua2jfsK7b0W0d9bem3PPbL.wb39Wna', NULL, 'Johnson William', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:40', '2023-08-15 04:43:40'),
(58, 5006, 'johnson.xander@gmail.com', '$2y$10$.C/Un184OFdmhvSNjyS.N./JqVMJ8chx8zvfOKoWI0RLSOIKe2qZS', NULL, 'Johnson Xander', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:40', '2023-08-15 04:43:40'),
(59, 5017, 'johnson.yasmine@gmail.com', '$2y$10$jx1Ksa3ggH3RGrY1kS0PTOfrPAWPsjjSLHaFGsFzLxC49TiZGNYpW', NULL, 'Johnson Yasmine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:41', '2023-08-15 04:43:41'),
(60, 5026, 'johnson.zachary@gmail.com', '$2y$10$jP9qqIi8f941SAz44bpgc.eu7TEPkeEU8BG6PzjNdbAxNShP0BhCu', NULL, 'Johnson Zachary', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:41', '2023-08-15 04:43:41'),
(61, 5006, 'johnson.ava@gmail.com', '$2y$10$BFjFDyeyEBWL6BnvPtdtFe27XLJbt182k4A.kgJ/5Saiy1kOFjJ8S', NULL, 'Johnson Ava', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:41', '2023-08-15 04:43:41'),
(62, 5027, 'johnson.benjamin@gmail.com', '$2y$10$63FtblNZsttS.ALYsoEPKuU1xzdeaXEnutf0u.Q2dwtTTU1kGnGQu', NULL, 'Johnson Benjamin', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:41', '2023-08-15 04:43:41'),
(63, 1, 'johnson.chloe@gmail.com', '$2y$10$8NWjDg0d8vV3Rqv56TDpj.HLGZ9FUx0J4CFAH/7Gn2AbxxySw6E/.', NULL, 'Johnson Chloe', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:41', '2023-08-15 04:43:41'),
(64, 5018, 'johnson.daniel@gmail.com', '$2y$10$B4TvNmWmeisajB/0lWVVoO4LFhGsGF.wRABey3wFLCNH2778xIpZS', NULL, 'Johnson Daniel', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:41', '2023-08-15 04:43:41'),
(65, 5015, 'johnson.emma@gmail.com', '$2y$10$QrOWgUk.Q67cew5uUMLzkuPnsRevx1BlGlz7Fq.Znz13TkJ7ByF4G', NULL, 'Johnson Emma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:41', '2023-08-15 04:43:41'),
(66, 5024, 'williams.alice@gmail.com', '$2y$10$S6ndrjezz1j6OuuAqQs6HeMDWyte//AF3xX5qMSygTCi8eFg8qg/C', NULL, 'Williams Alice', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:41', '2023-08-15 04:43:41'),
(67, 5030, 'williams.bob@gmail.com', '$2y$10$CvSsv1QLKjgjoNQ96KNGgeqXgQjcqowxsnBbNcdp5kfeCWXPIvDMK', NULL, 'Williams Bob', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:41', '2023-08-15 04:43:41'),
(68, 5005, 'williams.charlie@gmail.com', '$2y$10$7NMfe8u.caMOYHUgPIliQ.tcD8KUfZ/ix1EZjpYZ8PXoZLMOBfara', NULL, 'Williams Charlie', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:41', '2023-08-15 04:43:41'),
(69, 1, 'williams.david@gmail.com', '$2y$10$hsIsCbVamQFmY5FkIL/02OJHO52iOyNaXvrnyXhWLGdunl/CKmjhS', NULL, 'Williams David', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:41', '2023-08-15 04:43:41'),
(70, 5025, 'williams.emily@gmail.com', '$2y$10$JJHxOcl91q2O4plRb6tNJeH1VvTmzY5WRsiYSBsm2k9K5wWAK1e2C', NULL, 'Williams Emily', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:41', '2023-08-15 04:43:41'),
(71, 5027, 'williams.frank@gmail.com', '$2y$10$pAA1GtE5Vc7JpgDP73gIK.7wHc1ryMnQeh2DF6xWyyFFV3wUWN2HG', NULL, 'Williams Frank', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:41', '2023-08-15 04:43:41'),
(72, 5024, 'williams.grace@gmail.com', '$2y$10$xC3YtSjhdkR35qHHB61pKuvIM0XXP0KBpfOC3bztaFqKXDBBcLhzy', NULL, 'Williams Grace', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:41', '2023-08-15 04:43:41'),
(73, 5014, 'williams.henry@gmail.com', '$2y$10$lUDR0OCF2AcWlKrWxUV2qeka/WgfRtbzkyz3YSETFkZ2cfTFyXNNG', NULL, 'Williams Henry', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:41', '2023-08-15 04:43:41'),
(74, 5018, 'williams.isabella@gmail.com', '$2y$10$Da/Oa2fWsKWS6eC/xPO2teDyGfUhHQN7h73jWl0aozHYjmQIFF7ZG', NULL, 'Williams Isabella', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:41', '2023-08-15 04:43:41'),
(75, 5031, 'williams.jack@gmail.com', '$2y$10$fSlfm5hVg4vuTyxmCYTOce5VPWR7MWK/F0G.INeKKVEEZPsBPfZie', NULL, 'Williams Jack', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:41', '2023-08-15 04:43:41'),
(76, 5007, 'williams.katherine@gmail.com', '$2y$10$uenkWwI3c34VUXqFokOWpe12gSKwUZrd4py.r19YrpEpvsuJdN6ju', NULL, 'Williams Katherine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:41', '2023-08-15 04:43:41'),
(77, 5021, 'williams.liam@gmail.com', '$2y$10$VzTw2CyrLA71YfY7tw9/IOBOddewwHtBz78apDSW1VRgNB76y7Fsa', NULL, 'Williams Liam', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:41', '2023-08-15 04:43:41'),
(78, 5014, 'williams.mia@gmail.com', '$2y$10$rjgrIgZoIfR.9ThpkRvDQ..zv9.m4rhk7f9OHwdWLPV71glJM6u16', NULL, 'Williams Mia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:42', '2023-08-15 04:43:42'),
(79, 5006, 'williams.noah@gmail.com', '$2y$10$Dm.CYKNaAHo.agU1xlkBCORr0wEGbKMXNT8JrWDsAilJ/rtAwo.OW', NULL, 'Williams Noah', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:42', '2023-08-15 04:43:42'),
(80, 5021, 'williams.olivia@gmail.com', '$2y$10$xa5LmBb4jn/oN0T8EvYX2OJdTY/jQyd8kZAeTybcDGI5qwpMXaK46', NULL, 'Williams Olivia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:42', '2023-08-15 04:43:42'),
(81, 5025, 'williams.penelope@gmail.com', '$2y$10$tBaU.sN.qJl12MhHQMZweO2TLoPsmUXYZ6puxih9E8UI.4i1dv6Ni', NULL, 'Williams Penelope', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:42', '2023-08-15 04:43:42'),
(82, 5024, 'williams.quinn@gmail.com', '$2y$10$lKkB0f4YA39N3N1vuuFP9.oRxz94P5EAe6hadix4hH6028tHGgarC', NULL, 'Williams Quinn', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:42', '2023-08-15 04:43:42'),
(83, 2, 'williams.ryan@gmail.com', '$2y$10$Ca98BH17g0opJxwBh.IYPerSx87VFAi51.YZqUaW9m7pB2AsqLn9C', NULL, 'Williams Ryan', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:42', '2023-08-15 04:43:42'),
(84, 4, 'williams.sophia@gmail.com', '$2y$10$bSQjg597ekCUhztqzV8L1OjrJlk1o/SLjKO5GsAPcOAwTM9geJUye', NULL, 'Williams Sophia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:42', '2023-08-15 04:43:42'),
(85, 5023, 'williams.thomas@gmail.com', '$2y$10$d5mecBKvczETEDCCiMTu7eX9I3LHo8ziPp/2Q7pwU0GuXhJIqsQka', NULL, 'Williams Thomas', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:42', '2023-08-15 04:43:42'),
(86, 5009, 'williams.uma@gmail.com', '$2y$10$oneub9G43L4veqOqtsdvc.iF0dVV/swPqmIFrJhCsbDeKBi7KXN1u', NULL, 'Williams Uma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:42', '2023-08-15 04:43:42'),
(87, 5005, 'williams.victoria@gmail.com', '$2y$10$Ak.K49xezsyvL7HycM.wqu69emX87nj0N.kbb/ofEjq5IGmsmzmG2', NULL, 'Williams Victoria', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:42', '2023-08-15 04:43:42'),
(88, 5015, 'williams.william@gmail.com', '$2y$10$KDTtYpqb1SKrfYWygtJz5OOXvcpQLOFm6RlHXA5qWlJNwVp5bowwS', NULL, 'Williams William', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:42', '2023-08-15 04:43:42'),
(89, 5017, 'williams.xander@gmail.com', '$2y$10$N0dMx0LXjyMTNqHgAD0z9OXcTppoQCMTR9zJuAJblq95jrRsCBT8e', NULL, 'Williams Xander', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:42', '2023-08-15 04:43:42'),
(90, 5012, 'williams.yasmine@gmail.com', '$2y$10$G2WA5T4VCyUqsFTNWjkG3OAluIsjs68yRQYkAYhB1eCLaqqa7OuPS', NULL, 'Williams Yasmine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:42', '2023-08-15 04:43:42'),
(91, 5011, 'williams.zachary@gmail.com', '$2y$10$0fXWUcfEqB2Gd0VTjsW9le6tQbgIhLVQktT2SP8obfkdJ9VgwvbB2', NULL, 'Williams Zachary', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:42', '2023-08-15 04:43:42'),
(92, 5020, 'williams.ava@gmail.com', '$2y$10$pzpJkLkKuwOLr1hCXr5uuOp7Yin8vulpzEKN4Fq5VSVJ1fwILsHBu', NULL, 'Williams Ava', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:42', '2023-08-15 04:43:42'),
(93, 5009, 'williams.benjamin@gmail.com', '$2y$10$.mhJ1PJxoOhLs1hUhsa7c.mLEMd9Gdxwy3/KKHtUZkASFvcdIB.n.', NULL, 'Williams Benjamin', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:42', '2023-08-15 04:43:42'),
(94, 5018, 'williams.chloe@gmail.com', '$2y$10$YC7lJFJBIyEx0SRqmrJfUuzjre9Pr.lrLDTicsfa/9uUa6oUrZbRK', NULL, 'Williams Chloe', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:42', '2023-08-15 04:43:42'),
(95, 5031, 'williams.daniel@gmail.com', '$2y$10$1NBSt9wm88KvHUOUukVLw.kC4RsniqAiixo2Ty25GsN8oWFVNl12a', NULL, 'Williams Daniel', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:42', '2023-08-15 04:43:42'),
(96, 1, 'williams.emma@gmail.com', '$2y$10$.KXoDd0n/Hj2Tl4WuhNILeAfc9Mb1fLHWE68O.wMEHcFdh4M8jtPS', NULL, 'Williams Emma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:43', '2023-08-15 04:43:43'),
(97, 4, 'brown.alice@gmail.com', '$2y$10$H6.h3.ZfhOq6aiI6aXZQ5uybqxz1Vpj4zdzoVyiG7hDV8TIDp66Ty', NULL, 'Brown Alice', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:43', '2023-08-15 04:43:43'),
(98, 1, 'brown.bob@gmail.com', '$2y$10$6R.N0a2IJWxx8r7kXmbgEe2b5cMl5vQOdTUCZKt/fEzBwnMD5Luxe', NULL, 'Brown Bob', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:43', '2023-08-15 04:43:43'),
(99, 5031, 'brown.charlie@gmail.com', '$2y$10$F.pubjITmT/L2VnvLjKXIOmrF78R.g897WTtet38oUCCFnGnWYE56', NULL, 'Brown Charlie', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:43', '2023-08-15 04:43:43'),
(100, 5025, 'brown.david@gmail.com', '$2y$10$sTjBQ8GL3m7.xf.o.QjUaON8.3NrVRg/AyQcgvWf7KStawL2pWVKK', NULL, 'Brown David', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:43', '2023-08-15 04:43:43'),
(101, 5010, 'brown.emily@gmail.com', '$2y$10$5UPMfhSC9zNl1s3bvUtizuJfXQRmInj32dn07pWMDeBW3HpH57Rtu', NULL, 'Brown Emily', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:43', '2023-08-15 04:43:43'),
(102, 4, 'brown.frank@gmail.com', '$2y$10$x/znsuZvtefuO.mdLAPjI.MuujOoXr/MhGL5h5EE170272.Ao1E8u', NULL, 'Brown Frank', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:43', '2023-08-15 04:43:43'),
(103, 5009, 'brown.grace@gmail.com', '$2y$10$/997rlOkPeNjQ3D5pFJ3he7T0FycYWhAAhSLkIz1z0r0ciRn6ToU6', NULL, 'Brown Grace', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:43', '2023-08-15 04:43:43'),
(104, 5031, 'brown.henry@gmail.com', '$2y$10$LaTcQKyEIPhOjZKa8KASYekCJy8k752vBcH7G62A6yhNP4yhs/rCC', NULL, 'Brown Henry', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:43', '2023-08-15 04:43:43'),
(105, 5009, 'brown.isabella@gmail.com', '$2y$10$EnIIJqu/Qjf6JaMfEIaY/ueG7w4EIPUZxUICWD8EGDmFLwXo1qLTK', NULL, 'Brown Isabella', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:43', '2023-08-15 04:43:43'),
(106, 5016, 'brown.jack@gmail.com', '$2y$10$KNS6vh89bAKER.XQ/vI7EOASnUCKjzNr9pyqT.n1T7ePLYZsHVBV6', NULL, 'Brown Jack', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:43', '2023-08-15 04:43:43'),
(107, 4, 'brown.katherine@gmail.com', '$2y$10$KEdwXv4iLskH7JEf.tp6i.UQSzW5fiq6Yyltp5kfL5in19/6MvUjG', NULL, 'Brown Katherine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:43', '2023-08-15 04:43:43'),
(108, 5018, 'brown.liam@gmail.com', '$2y$10$YUfji4avOfBPRJD79IBjP.QpP5ggPNEOVF78HJZEyFSV0WxMjuG2G', NULL, 'Brown Liam', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:43', '2023-08-15 04:43:43'),
(109, 5011, 'brown.mia@gmail.com', '$2y$10$QmtRZe9VU/07oUubSAC1GuHNuMK99DPosTsMcUp.hFQpZ9./vBPIm', NULL, 'Brown Mia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:43', '2023-08-15 04:43:43'),
(110, 5021, 'brown.noah@gmail.com', '$2y$10$YgV.LQi7DWpwmTp6SWH99exyFjkiYZX7QVZJASOCC2m2GNEJQOMjC', NULL, 'Brown Noah', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:43', '2023-08-15 04:43:43'),
(111, 5027, 'brown.olivia@gmail.com', '$2y$10$hz20W8OUT6zCUBOEqSyeKeoiVTMqVLuQGtO5kxD7Tynq7aMzhJeDG', NULL, 'Brown Olivia', '', NULL, NULL, NULL, 0, NULL, '2023-08-15 16:22:31', '2023-08-15 04:43:43'),
(112, 5025, 'brown.penelope@gmail.com', '$2y$10$0rZR6TkFd.ZImGsddWZJT.46SF.cCYXXPE/ALsz7RAbHbJKlf/PRu', NULL, 'Brown Penelope', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:43', '2023-08-15 04:43:43'),
(113, 5005, 'brown.quinn@gmail.com', '$2y$10$Ox6ves4Rst9BTMyrUJb4zeG7cJABiqwXi.ob4e/mZBTJdOkpjsMsW', NULL, 'Brown Quinn', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:43', '2023-08-15 04:43:43'),
(114, 5017, 'brown.ryan@gmail.com', '$2y$10$gEBB9Kp9yB///YAmH7k75epM2vlrXZ8.pLGAufbrLuv0ADzkQkIEK', NULL, 'Brown Ryan', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:43', '2023-08-15 04:43:43'),
(115, 5022, 'brown.sophia@gmail.com', '$2y$10$XnibpYKq8dL5AztIHo1N8OBXvI6Db2BZ5WU./ppycV6r2SA1wWrHu', NULL, 'Brown Sophia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:44', '2023-08-15 04:43:44'),
(116, 5015, 'brown.thomas@gmail.com', '$2y$10$kHI4gPRv3ncuYW4cFR6ElOAKujhVIw/vQIaw44CRLW5WRUQ2NfHZu', NULL, 'Brown Thomas', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:44', '2023-08-15 04:43:44'),
(117, 5010, 'brown.uma@gmail.com', '$2y$10$EYbNAVxPHN8Z7u6AM2f67edCeyEjIqPGrBGMaxpDMtIJqtxYqEca6', NULL, 'Brown Uma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:44', '2023-08-15 04:43:44'),
(118, 5011, 'brown.victoria@gmail.com', '$2y$10$SgenVsisQbqn.NJqu4sxGOr8xSE5IInoDa1CauLheze4R76y3cj16', NULL, 'Brown Victoria', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:44', '2023-08-15 04:43:44'),
(119, 5007, 'brown.william@gmail.com', '$2y$10$S.UxZ08OtWs1WrR5xMHWOODY5If2gXvg5Q6xa0GE1z9tp6EeksXEG', NULL, 'Brown William', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:44', '2023-08-15 04:43:44'),
(120, 5010, 'brown.xander@gmail.com', '$2y$10$T1ea5jQeW07QLanxsAFOGe10mZLLFQbhjGccnSIDqN/MIRYqthftK', NULL, 'Brown Xander', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:44', '2023-08-15 04:43:44'),
(121, 5027, 'brown.yasmine@gmail.com', '$2y$10$OKhIe7oVeoRjjipUJPomXe3Msi20W5KoU8NZzo6FB16vXzYprl81W', NULL, 'Brown Yasmine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:44', '2023-08-15 04:43:44'),
(122, 5024, 'brown.zachary@gmail.com', '$2y$10$5u4XNXfT15Uc4v0j.MIVc.FPmh3ToyMPZx52N2QgsFPacxjgJbV0q', NULL, 'Brown Zachary', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:44', '2023-08-15 04:43:44'),
(123, 5019, 'brown.ava@gmail.com', '$2y$10$P4Z5jfj9QkoHrs1sXJCzFuUASsElHiYSDLEjcX42lfm25MzpPz.c.', NULL, 'Brown Ava', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:44', '2023-08-15 04:43:44'),
(124, 5014, 'brown.benjamin@gmail.com', '$2y$10$K4DDAP6gRWjPqvpKxrJKc.wbn8NpxAOIY0GeKmnani3hIZVOtbwVm', NULL, 'Brown Benjamin', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:44', '2023-08-15 04:43:44'),
(125, 5018, 'brown.chloe@gmail.com', '$2y$10$hif4AhaU3h0VEZgs8OfML.EcxgWvaA8yh2meF1vYHLv1svBTAql4m', NULL, 'Brown Chloe', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:44', '2023-08-15 04:43:44'),
(126, 5022, 'brown.daniel@gmail.com', '$2y$10$s4WTEWuJWTgUfC15LF3aMeS4OGOtLbGm3TLZOfwt4FIb/YvwGT4Si', NULL, 'Brown Daniel', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:44', '2023-08-15 04:43:44'),
(127, 5006, 'brown.emma@gmail.com', '$2y$10$vG0jcsOuzqV3codniU7U8..vgITSlJzYvXvymeDp041lWQY20dT5i', NULL, 'Brown Emma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:44', '2023-08-15 04:43:44'),
(128, 5010, 'jones.alice@gmail.com', '$2y$10$2w./LjsTj9gS9r9Ef2YhNuVCvdngSnsggjKxd4JaAeBo6TlivJu5C', NULL, 'Jones Alice', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:44', '2023-08-15 04:43:44'),
(129, 4, 'jones.bob@gmail.com', '$2y$10$Gs/Y3yr5tUf44jRrBuoK2uLA1tXOLpEf0OIW4VFlaz2DpPES7wylu', NULL, 'Jones Bob', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:44', '2023-08-15 04:43:44'),
(130, 5018, 'jones.charlie@gmail.com', '$2y$10$glwhwKkJzWNFcnKwVR/btOymGwc2GxBuhgBCFPh0Q7s5zHoXK7CGa', NULL, 'Jones Charlie', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:44', '2023-08-15 04:43:44'),
(131, 5030, 'jones.david@gmail.com', '$2y$10$5HWLvX/lXbKWRq3EzOr7TOx.Th2pXzFTTiVjONdQNXRFNk5otuAXu', NULL, 'Jones David', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:44', '2023-08-15 04:43:44'),
(132, 5027, 'jones.emily@gmail.com', '$2y$10$QqfM40aqK5cJN65Y9JHYtO0RrrD1zoOtY4A.mG3jt4ng97i3NkFqW', NULL, 'Jones Emily', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:44', '2023-08-15 04:43:44'),
(133, 5010, 'jones.frank@gmail.com', '$2y$10$1do8foD8CZlqjnOJyHIR7uWSxLiReyFmvvYb.nvPrrP1Ngdcgdk/K', NULL, 'Jones Frank', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:45', '2023-08-15 04:43:45'),
(134, 2, 'jones.grace@gmail.com', '$2y$10$NSWK7bBonQPWXMpHKxZEkO9XSwEahToSThpizK1aC0juBw8qGvkra', NULL, 'Jones Grace', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:45', '2023-08-15 04:43:45'),
(135, 5007, 'jones.henry@gmail.com', '$2y$10$pvnxKy4wWFiVVk3/pN4Rf.4Shli22e6t/iNUq5RgzHSGzAJSLK0U.', NULL, 'Jones Henry', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:45', '2023-08-15 04:43:45'),
(136, 5015, 'jones.isabella@gmail.com', '$2y$10$SheNU8kmk4UVLy1F7vYxM.9OZpSE9cOIp53EEX7ILj5UzEfWALUEa', NULL, 'Jones Isabella', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:45', '2023-08-15 04:43:45'),
(137, 5030, 'jones.jack@gmail.com', '$2y$10$PPw69gAPtvX02A8XeI9LkuVf37KjJTqKq5b.KkRy7QhkLczKHXVY2', NULL, 'Jones Jack', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:45', '2023-08-15 04:43:45'),
(138, 5022, 'jones.katherine@gmail.com', '$2y$10$15Lmzs/FJOeo0zLsCoI5LOSqyv1cQ2Zv0gXr0FEATYjYlLEXx98BO', NULL, 'Jones Katherine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:45', '2023-08-15 04:43:45'),
(139, 5017, 'jones.liam@gmail.com', '$2y$10$Q68HcJ..SQiOCx/FsT.V/.8itTwSZ6EdGxDAqCnBjFtPgUevkVTdO', NULL, 'Jones Liam', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:45', '2023-08-15 04:43:45'),
(140, 5013, 'jones.mia@gmail.com', '$2y$10$/gLZAd5Yh4x0oCe.U9Qwbup8a0u3JPa928dSIdVmDqRo353DPkfOe', NULL, 'Jones Mia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:45', '2023-08-15 04:43:45'),
(141, 5016, 'jones.noah@gmail.com', '$2y$10$7MddlTg/OaCWgc1eaLhlLurasO0Xh/nCvIJd3TiYmmb41huDF1L2C', NULL, 'Jones Noah', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:45', '2023-08-15 04:43:45'),
(142, 5017, 'jones.olivia@gmail.com', '$2y$10$5wECLmma3cidQTH1HZTZHur3j5HoraYRVuFo60jaK0PzeDZlyuLTW', NULL, 'Jones Olivia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:45', '2023-08-15 04:43:45'),
(143, 5027, 'jones.penelope@gmail.com', '$2y$10$3EVEoL9MwwatBwRvRpyDSe/EAAFuiqaAX6CqI3HiUw17skTvmy6kS', NULL, 'Jones Penelope', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:45', '2023-08-15 04:43:45'),
(144, 5030, 'jones.quinn@gmail.com', '$2y$10$SpvD1i8xvz2Aff1z5rnaI.qolsKf9NRndQIcFlfKPNllv9JDcKHLm', NULL, 'Jones Quinn', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:45', '2023-08-15 04:43:45'),
(145, 5020, 'jones.ryan@gmail.com', '$2y$10$l/wgtPj.DWuRKdJOMn9ORuAcYhFd3psTSOTRDJSuUzcdRRMfs6kqe', NULL, 'Jones Ryan', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:45', '2023-08-15 04:43:45'),
(146, 5021, 'jones.sophia@gmail.com', '$2y$10$u40zxx2TIrS2ZXNakMTdReItotbCBRYmzHBpBqipLUpl6mTDbn1zG', NULL, 'Jones Sophia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:45', '2023-08-15 04:43:45'),
(147, 5014, 'jones.thomas@gmail.com', '$2y$10$1ndsXxRBkruxW5VG0c1F2.DqKuwJBqlPUVFCv8GgItMdcaY18NY1W', NULL, 'Jones Thomas', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:45', '2023-08-15 04:43:45'),
(148, 5015, 'jones.uma@gmail.com', '$2y$10$SV9yKXSIDw9c26Vek5wpCOkgNCvtdk3YP7Ie9hFPDLO/OicKyAxPi', NULL, 'Jones Uma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:45', '2023-08-15 04:43:45'),
(149, 5020, 'jones.victoria@gmail.com', '$2y$10$6BOgF1x.zPGxkzw52687fOv/Ct5W7Gx97jStr6lkQ4sMF6MmPvfGy', NULL, 'Jones Victoria', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:45', '2023-08-15 04:43:45'),
(150, 5021, 'jones.william@gmail.com', '$2y$10$RQgYPz0JhLW.94kN7Qi59eWMh6anFHHIW0VuG7RWHjl7osYLVv2he', NULL, 'Jones William', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:45', '2023-08-15 04:43:45'),
(151, 5005, 'jones.xander@gmail.com', '$2y$10$PyMPeS4Dr9y3amgWsS8miO4EuGPS1dDx69/CHKAtdvd9Adxp5cNo2', NULL, 'Jones Xander', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:46', '2023-08-15 04:43:46'),
(152, 5026, 'jones.yasmine@gmail.com', '$2y$10$KkTPDyWYHgGe6qFN2MCSs.ewv8ZZbB4W0lrkrYo/CnnVzb9xhyAPW', NULL, 'Jones Yasmine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:46', '2023-08-15 04:43:46'),
(153, 5020, 'jones.zachary@gmail.com', '$2y$10$MktYI909DYS5EgkXEXNn6us48pwypdKpAFJc9CpP3qZXc8Ngnb5n.', NULL, 'Jones Zachary', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:46', '2023-08-15 04:43:46'),
(154, 5007, 'jones.ava@gmail.com', '$2y$10$PkXcYb.efYNa3RVQ3OozRu4PgoS/wzFqf6AULyQqrIib1ibAWhfYm', NULL, 'Jones Ava', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:46', '2023-08-15 04:43:46'),
(155, 5015, 'jones.benjamin@gmail.com', '$2y$10$qbKjEWM9y02L9TkvR6UJfOnyXhKEsWLOdkvgxNvVL3klUo1bupCBa', NULL, 'Jones Benjamin', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:46', '2023-08-15 04:43:46'),
(156, 5005, 'jones.chloe@gmail.com', '$2y$10$rPeu8oYefxiwW7tvHFMYeudW0FtsJvEISeEJUOBxUEGJOag89ZYEW', NULL, 'Jones Chloe', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:46', '2023-08-15 04:43:46'),
(157, 5013, 'jones.daniel@gmail.com', '$2y$10$Yf1kYIZRex.Tumu0SEu8WOcY7NbWW4JsE0xuPW8YbAj3zp9hd4rlu', NULL, 'Jones Daniel', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:46', '2023-08-15 04:43:46'),
(158, 4, 'jones.emma@gmail.com', '$2y$10$sp3wbWzkXruEGCBigY1EEe9iHgsMZfLAWCqq0CJz2qzMoeioJEBNq', NULL, 'Jones Emma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:46', '2023-08-15 04:43:46'),
(159, 5025, 'miller.alice@gmail.com', '$2y$10$JxVQ3E3ExoX8rldklgpVbOP9s.vFI88n78wxgHf1AlwtglRSO/SLK', NULL, 'Miller Alice', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:46', '2023-08-15 04:43:46'),
(160, 5007, 'miller.bob@gmail.com', '$2y$10$1JUvprGU1NSUZBQ3gp3QI.ntZTn6KoRW75Vnpr6TKXwFiyhW6ACJ2', NULL, 'Miller Bob', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:46', '2023-08-15 04:43:46'),
(161, 5007, 'miller.charlie@gmail.com', '$2y$10$WUE.jKcHUsZfg0pT6X0zy.fgFs8lR//ckFpYYsTcecUGgvGV67Wym', NULL, 'Miller Charlie', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:46', '2023-08-15 04:43:46'),
(162, 5015, 'miller.david@gmail.com', '$2y$10$lUAx57TJToLjbWCtgdTW8.XkBabhwSpft7dQRDbpR5MWtJr7Taquu', NULL, 'Miller David', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:46', '2023-08-15 04:43:46'),
(163, 5014, 'miller.emily@gmail.com', '$2y$10$HitB1Tq1L.fDpqkJW4yJQubGzhPOVCkjlq3/xhTlWIpHxLdeN3sWC', NULL, 'Miller Emily', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:46', '2023-08-15 04:43:46'),
(164, 5021, 'miller.frank@gmail.com', '$2y$10$jOBb0sJoDtTDg/QZNccdn.m3EqltzR5/LxEK2UxYRuegP5XStanCi', NULL, 'Miller Frank', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:46', '2023-08-15 04:43:46'),
(165, 5030, 'miller.grace@gmail.com', '$2y$10$33gh.p0Q0c5my7moVyXFxujJa1OKtsJ9MHS58Fhkm1yAwbdwSWR6a', NULL, 'Miller Grace', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:46', '2023-08-15 04:43:46'),
(166, 5031, 'miller.henry@gmail.com', '$2y$10$aaD0WdOAG3GKt1gyyd43gO7YWexfKDRraLvsWUa0ZxDgedm1iQJIS', NULL, 'Miller Henry', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:46', '2023-08-15 04:43:46'),
(167, 5003, 'miller.isabella@gmail.com', '$2y$10$sX7Z9GljMQoJZdwWirzp1OWTU.9hrSjgqImY..T1jsnCEg/kU7Eae', NULL, 'Miller Isabella', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:46', '2023-08-15 04:43:46'),
(168, 5025, 'miller.jack@gmail.com', '$2y$10$hDiyTO.ZE4qixNGnjMXjo.di5t7RhtH.jDmZdXh0x8lao5apNPr.C', NULL, 'Miller Jack', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:46', '2023-08-15 04:43:46'),
(169, 5011, 'miller.katherine@gmail.com', '$2y$10$w5raAQXGDlveV81OtlgQb.x5tsO828v1AU2RSCgGojQmRgMSr53A6', NULL, 'Miller Katherine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:46', '2023-08-15 04:43:46'),
(170, 5031, 'miller.liam@gmail.com', '$2y$10$Ek.QMnWW2gkSrBMWS5sFSuoP58DeeIfrSY4xnniJ7UmiqLuWVIOqC', NULL, 'Miller Liam', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:47', '2023-08-15 04:43:47'),
(171, 5014, 'miller.mia@gmail.com', '$2y$10$8SzP7zBg9qVrcSiczqMPsui3RSKmPXNEaNKrkXq.MW1A34rK4.sSu', NULL, 'Miller Mia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:47', '2023-08-15 04:43:47'),
(172, 5011, 'miller.noah@gmail.com', '$2y$10$BUohBq6vDhE/bFkvYzidt.v0eSXoqoyUbz.ZJgzHFC4aTFcn2P/7G', NULL, 'Miller Noah', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:47', '2023-08-15 04:43:47'),
(173, 5031, 'miller.olivia@gmail.com', '$2y$10$dg./2xlOJ/GzM.sG6ptvNu8uIcq4b2IR2wKB4IooeiYBVzjx4cM8W', NULL, 'Miller Olivia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:47', '2023-08-15 04:43:47'),
(174, 5027, 'miller.penelope@gmail.com', '$2y$10$6zLa4A/LXSFFaOZNcn5zM./P20sCGWSdq1lM0RWHk5lhTa4tXrnvW', NULL, 'Miller Penelope', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:47', '2023-08-15 04:43:47'),
(175, 5003, 'miller.quinn@gmail.com', '$2y$10$erQN9sIvAjqGihqfALUcaOfl5GDGwB3bWyXSb2Go95/cXzNVxPLZm', NULL, 'Miller Quinn', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:47', '2023-08-15 04:43:47'),
(176, 5030, 'miller.ryan@gmail.com', '$2y$10$sTqPQ1GjzqIL0QJk0z9vleMiuBvd3j9c.EHYnOg9b6usoyQmSY93W', NULL, 'Miller Ryan', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:47', '2023-08-15 04:43:47'),
(177, 5003, 'miller.sophia@gmail.com', '$2y$10$HF6OUM4sXellfmpnSGKozu6wuqUabP6l6XJB3mVWOzjwMtnPlr/VC', NULL, 'Miller Sophia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:47', '2023-08-15 04:43:47'),
(178, 5021, 'miller.thomas@gmail.com', '$2y$10$XUwEpkJag0ra4Dc2QrQwl.RS8zVD2ufPgMp8R724W7/Vk7nU2a2Ve', NULL, 'Miller Thomas', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:47', '2023-08-15 04:43:47'),
(179, 5027, 'miller.uma@gmail.com', '$2y$10$zqguZ2lvKYknjHhY9RqxR.QHAlqE6HnwCKTt0z2eKG2m2ta6lKp32', NULL, 'Miller Uma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:47', '2023-08-15 04:43:47'),
(180, 5026, 'miller.victoria@gmail.com', '$2y$10$96oSj6fRObPiTKeNmNDLROwsoETE5HQMkmb3cqD1jrZBwuk2Avpx6', NULL, 'Miller Victoria', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:47', '2023-08-15 04:43:47'),
(181, 5018, 'miller.william@gmail.com', '$2y$10$JdHF14XAqDYwUSfMJBnkd.DAXO/AqnqUTgBbk1bnCtK79pQj1jtb2', NULL, 'Miller William', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:47', '2023-08-15 04:43:47'),
(182, 5012, 'miller.xander@gmail.com', '$2y$10$fZ2BKJ0Dzl94vKzCecFiMu9LD5pCJfOII9iF1jPfnNSMpJ1fC9OMS', NULL, 'Miller Xander', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:47', '2023-08-15 04:43:47'),
(183, 5018, 'miller.yasmine@gmail.com', '$2y$10$HzNhTConRFfZqN2r4GdX/O3h41EUhtsyrU7f6EDebR7eoiYJTQZue', NULL, 'Miller Yasmine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:47', '2023-08-15 04:43:47'),
(184, 2, 'miller.zachary@gmail.com', '$2y$10$mklvKOuV3w/19QaZHMqmD.zGu2EQC92PC.P/XlTc2vfLvNR/hybFG', NULL, 'Miller Zachary', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:47', '2023-08-15 04:43:47'),
(185, 5012, 'miller.ava@gmail.com', '$2y$10$ivHQVgH0j7u5t7yMaZecw.Czx2F6ZXY.WyEgMr53H4zVrIz86ZrQ6', NULL, 'Miller Ava', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:47', '2023-08-15 04:43:47'),
(186, 5017, 'miller.benjamin@gmail.com', '$2y$10$o2/RKfCbtQ4eeDAthQwlwOgWGjJXrE1CO3aenS.rwNOBg2SLjKOMi', NULL, 'Miller Benjamin', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:47', '2023-08-15 04:43:47'),
(187, 5019, 'miller.chloe@gmail.com', '$2y$10$v2IRSnJHJDiJm41l6M5dJeq6gQtLBk8UuMLloQVXJR0T0xJNdVO.2', NULL, 'Miller Chloe', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:47', '2023-08-15 04:43:47'),
(188, 5017, 'miller.daniel@gmail.com', '$2y$10$zQa10jNPV0og1wPQHY4SCuJpJElDTYdaXHq0o0Gs0YFUYBIS3eQ5u', NULL, 'Miller Daniel', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:47', '2023-08-15 04:43:47'),
(189, 5016, 'miller.emma@gmail.com', '$2y$10$9zdA29FK2ysqyCCp1qIBtuF2Os1UugZVrN03CoBOVRWWWeMBr0b4y', NULL, 'Miller Emma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:47', '2023-08-15 04:43:47'),
(190, 5015, 'davis.alice@gmail.com', '$2y$10$o9UymZL5uKCfVpTK8M63DODNUHUvvBhdvZTLlbQoafMcvI1a6N5hO', NULL, 'Davis Alice', '', NULL, NULL, NULL, 0, NULL, '2023-08-15 16:13:30', '2023-08-15 04:43:48'),
(191, 5009, 'davis.bob@gmail.com', '$2y$10$C.oHCm78NRUiyUdrkwlIuu.Dbho7J1VLnyJCk/1/twC10KvKMnzBi', NULL, 'Davis Bob', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:48', '2023-08-15 04:43:48'),
(192, 5016, 'davis.charlie@gmail.com', '$2y$10$bpnMw6SUrEvWYdo6Yguy5.9W8NY7TzlpShJ4n.bpVZxU.TVl057Ei', NULL, 'Davis Charlie', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:48', '2023-08-15 04:43:48'),
(193, 5006, 'davis.david@gmail.com', '$2y$10$n.LzOX3jPEu/pQTNqZkHuOjPO.nUjQo2dD3ghc9WoReVGrL1L1.Pi', NULL, 'Davis David', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:48', '2023-08-15 04:43:48'),
(194, 5025, 'davis.emily@gmail.com', '$2y$10$TmG4cmCXtYntmQ4eYt91GOmdHDMbf.vue2MaxJ7dDm1LA6fDHd0Ni', NULL, 'Davis Emily', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:48', '2023-08-15 04:43:48'),
(195, 5003, 'davis.frank@gmail.com', '$2y$10$L/sl4etA6VGqGiE81oQInOpviGbciA.3bznUDmxQb7t.fOBPynGUq', NULL, 'Davis Frank', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:48', '2023-08-15 04:43:48'),
(196, 5031, 'davis.grace@gmail.com', '$2y$10$pwLs6R7dmlmJkGyA3vwjDOExR6oMfrFcYKmxNITJrbKcw9POhwp5e', NULL, 'Davis Grace', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:48', '2023-08-15 04:43:48'),
(197, 4, 'davis.henry@gmail.com', '$2y$10$9qBe9OXsKqa/TlnT00X59OYHKFD5s4B.nfZcVRaywHGbh0NZcffHa', NULL, 'Davis Henry', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:48', '2023-08-15 04:43:48'),
(198, 5009, 'davis.isabella@gmail.com', '$2y$10$w5ZOsQiU2lDcfsofrCpU5e82gcLMhqGlEJsHX88H9.F2s1mtPfvVS', NULL, 'Davis Isabella', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:48', '2023-08-15 04:43:48'),
(199, 5025, 'davis.jack@gmail.com', '$2y$10$0ujJeSYHZeL.YG0ZMRQOSuX0rVZP764uncrL7P1fiy8CFx277c7PO', NULL, 'Davis Jack', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:48', '2023-08-15 04:43:48'),
(200, 5023, 'davis.katherine@gmail.com', '$2y$10$XtVxaj5ihcNwU5NmYZeh7umcco6P5kDR5UGkHKUtJfDPYZKmrASl.', NULL, 'Davis Katherine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:48', '2023-08-15 04:43:48'),
(201, 5006, 'davis.liam@gmail.com', '$2y$10$bkSg.NqpLxJWF8Igj.KscuvWRjduBtpbMIKZeYyo.6yjtTl6kOIlq', NULL, 'Davis Liam', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:48', '2023-08-15 04:43:48'),
(202, 5023, 'davis.mia@gmail.com', '$2y$10$LrvYcGVwNMBRrto5W3qY7uPgTtEn3RWdtoBjddx3s4dzVFglED.UK', NULL, 'Davis Mia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:48', '2023-08-15 04:43:48'),
(203, 5025, 'davis.noah@gmail.com', '$2y$10$nwy099IBlKlvFRG1Wzt1FOD.E78xjUnzaoqh9J30BpcD5oECpTZr2', NULL, 'Davis Noah', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:48', '2023-08-15 04:43:48'),
(204, 5011, 'davis.olivia@gmail.com', '$2y$10$VFpy//S/Jm3oMMivisd1wOe3kWAn6sSF/uhSC2pVAskbXJMrVa9Ja', NULL, 'Davis Olivia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:48', '2023-08-15 04:43:48'),
(205, 5018, 'davis.penelope@gmail.com', '$2y$10$L1ahNF6mkEbHE1pvhTGIq.7Pp6qmX1SFHhUuSr8PVxR1Q.pItFLTq', NULL, 'Davis Penelope', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:48', '2023-08-15 04:43:48'),
(206, 5014, 'davis.quinn@gmail.com', '$2y$10$F/3cSMnLptI0yQEZowRzTOSdyMBcr8DQ1xtqtlfSZVxCpMo583KsG', NULL, 'Davis Quinn', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:48', '2023-08-15 04:43:48'),
(207, 5015, 'davis.ryan@gmail.com', '$2y$10$yWjPA8O0on93eYubTZRRvup7x90m0Mwfl1MHdsu/EXDJgyoprnqkK', NULL, 'Davis Ryan', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:48', '2023-08-15 04:43:48'),
(208, 5012, 'davis.sophia@gmail.com', '$2y$10$Dz9GeiVNRAzR50jSJWuLnOo6avlHAfP5K6dEfy.vU7xPQramrF0De', NULL, 'Davis Sophia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:48', '2023-08-15 04:43:48'),
(209, 5019, 'davis.thomas@gmail.com', '$2y$10$CIddsHkumZ9KfZf8mTNNOOTZuhvapHZqq7BFR25owqgS8emcvmhMG', NULL, 'Davis Thomas', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:49', '2023-08-15 04:43:49'),
(210, 5019, 'davis.uma@gmail.com', '$2y$10$gJJjJIonZ.OEal7F7pwoKuHphZoH3n1uFBOXnkbxJ6HBnV3fp1xuW', NULL, 'Davis Uma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:49', '2023-08-15 04:43:49'),
(211, 5012, 'davis.victoria@gmail.com', '$2y$10$EUxmehAhuZPmLf8F8DX9Cuj5Wj/.tfDd5O6QeqBMYMQkCIFu1qQ5e', NULL, 'Davis Victoria', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:49', '2023-08-15 04:43:49'),
(212, 1, 'davis.william@gmail.com', '$2y$10$YrHgUBWtp3ENYaoPrFa8nOxchw/ajwKxVOvJfrY5So8dcO8E7IxJS', NULL, 'Davis William', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:49', '2023-08-15 04:43:49'),
(213, 5003, 'davis.xander@gmail.com', '$2y$10$BLA6VgwRe5kjIt7Gk7zd8O3ZNJ.JHvsS5OHvH1EsW.FRqxE0Py0N2', NULL, 'Davis Xander', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:49', '2023-08-15 04:43:49'),
(214, 5018, 'davis.yasmine@gmail.com', '$2y$10$s0GU1mcL0vrJ26h0OglN/urO70rJ3w5TnXjykmdRd3j8yDzD4Kw2W', NULL, 'Davis Yasmine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:49', '2023-08-15 04:43:49'),
(215, 5006, 'davis.zachary@gmail.com', '$2y$10$bNZm9.DG/hYxMozsvEElw.hkt/8RgkcQ6xCrEno03rTf6LnMqIgG6', NULL, 'Davis Zachary', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:49', '2023-08-15 04:43:49'),
(216, 5028, 'davis.ava@gmail.com', '$2y$10$y1VkEEtaes8oFoIHkliyuusRSY1OQtKBmEMhbdA6rT8gQZ4RuqukO', NULL, 'Davis Ava', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:49', '2023-08-15 04:43:49'),
(217, 5007, 'davis.benjamin@gmail.com', '$2y$10$G.wSn3v82b9rCExfcmPlb.xHZjqe9CIozxe60BFRIBYpxJ2mZdhKy', NULL, 'Davis Benjamin', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:49', '2023-08-15 04:43:49'),
(218, 5003, 'davis.chloe@gmail.com', '$2y$10$9eSi6o2p5e/BjsLZ3hboX.RuspD42rTixfSjMJ4qt3tQezD94wLEC', NULL, 'Davis Chloe', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:49', '2023-08-15 04:43:49'),
(219, 5031, 'davis.daniel@gmail.com', '$2y$10$cVJuw3V7Caku17SrGAmez.IawwkSMZ4t0mTCi1p44jVHcMnuBzhU.', NULL, 'Davis Daniel', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:49', '2023-08-15 04:43:49'),
(220, 5024, 'davis.emma@gmail.com', '$2y$10$wZC0n/MKdJdbiLLLcUYD5epuZUy5tsmZKodWBgHfHAfkKsCleXVsG', NULL, 'Davis Emma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:49', '2023-08-15 04:43:49'),
(221, 5017, 'garcia.alice@gmail.com', '$2y$10$pkJpVbso0dytE1uTUlj/ouXZAWvCtHoJZRWpxLmIEkbvoyPkEkoCG', NULL, 'Garcia Alice', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:49', '2023-08-15 04:43:49'),
(222, 5014, 'garcia.bob@gmail.com', '$2y$10$/TCwzU1rEvS57cgQeNyX9.H7TZq81pnSq9rOEhOWdF4OOZLaYI96q', NULL, 'Garcia Bob', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:49', '2023-08-15 04:43:49'),
(223, 5021, 'garcia.charlie@gmail.com', '$2y$10$mSqInAM7kBJv2P573VrsBetzMGIQqUHioNy/8gBNMXUFULDKe6q.i', NULL, 'Garcia Charlie', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:49', '2023-08-15 04:43:49'),
(224, 5021, 'garcia.david@gmail.com', '$2y$10$txM1MW54cf8y2RiP86zSkek7rcFsQhkFLy/BJciyKAhhsdHEPZVNC', NULL, 'Garcia David', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:49', '2023-08-15 04:43:49'),
(225, 1, 'garcia.emily@gmail.com', '$2y$10$D2yR4AlTL4xVKezeLFTd5uS8Wjm.LPgAj3mq.oc6QPeMdWyvbBB1.', NULL, 'Garcia Emily', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:49', '2023-08-15 04:43:49'),
(226, 2, 'garcia.frank@gmail.com', '$2y$10$l.x22clG7z1ymAXQsmbx4.4eSGO0a.NwHc9hM5jWamMPWdS4zn12m', NULL, 'Garcia Frank', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:49', '2023-08-15 04:43:49'),
(227, 5012, 'garcia.grace@gmail.com', '$2y$10$KfkzkzHLUYvSdbJ56iWEueTvyadtcTAc8xx6xnjEpmyCWhV/kpD6a', NULL, 'Garcia Grace', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:49', '2023-08-15 04:43:49'),
(228, 5014, 'garcia.henry@gmail.com', '$2y$10$MVijvKidCRlKAS2CqGST7Oh18/tnnGalkm65xTZm3lv3iPm.eC5o6', NULL, 'Garcia Henry', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:50', '2023-08-15 04:43:50'),
(229, 5007, 'garcia.isabella@gmail.com', '$2y$10$wV3Qof0qQ8OrrbWHhoZaX.yLAC6r/qXBKSnM9vMDagXCZH0TsTmjO', NULL, 'Garcia Isabella', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:50', '2023-08-15 04:43:50'),
(230, 1, 'garcia.jack@gmail.com', '$2y$10$rZqPsyLSPv.5RS05StT7R.aFygLIJabjtwLc8YR4WtU7e3g8XRPeK', NULL, 'Garcia Jack', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:50', '2023-08-15 04:43:50'),
(231, 4, 'garcia.katherine@gmail.com', '$2y$10$HDWvxptPmsw82UTWiBCSVu7Gpvtl0tW92vDNsILbfAgq59Fs8Fa5q', NULL, 'Garcia Katherine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:50', '2023-08-15 04:43:50'),
(232, 4, 'garcia.liam@gmail.com', '$2y$10$blFjIb3H3OOJTML0UvGTA.OULJAT0GpNuxfDgcArH4pQiQNIaOM1C', NULL, 'Garcia Liam', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:50', '2023-08-15 04:43:50'),
(233, 5006, 'garcia.mia@gmail.com', '$2y$10$LlPIM2d5TTvSt3JmCIXiWOKsrC8GzhiGBaORZ742tRWilKqM1ez1W', NULL, 'Garcia Mia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:50', '2023-08-15 04:43:50'),
(234, 5014, 'garcia.noah@gmail.com', '$2y$10$pPc5LVZAew.EeFGrP.Lhyu1Z1QpKAqWKyFoCPUtasqKKSu9yXsJD6', NULL, 'Garcia Noah', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:50', '2023-08-15 04:43:50'),
(235, 5003, 'garcia.olivia@gmail.com', '$2y$10$WP12CqUoLqD4SwsvADCu2.5NWGIGyWZi3zoOpbM4.hE7UlDCGunky', NULL, 'Garcia Olivia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:50', '2023-08-15 04:43:50'),
(236, 5023, 'garcia.penelope@gmail.com', '$2y$10$KI/4NxDh/DyjKNk2OoqUvevMOWyF.xbPmyhbwd7.154DFrIv3zSR.', NULL, 'Garcia Penelope', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:50', '2023-08-15 04:43:50'),
(237, 5024, 'garcia.quinn@gmail.com', '$2y$10$UtBJlFKjG9O.sKHo2EbhVu8lcmcc8DW62iryEl6KtjzS2EQoRP7sW', NULL, 'Garcia Quinn', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:50', '2023-08-15 04:43:50'),
(238, 5026, 'garcia.ryan@gmail.com', '$2y$10$mMKJ5ILmQEgd36.obIguwuadGvwAocf3HK9DIdM6f3D8BzGXCCDL2', NULL, 'Garcia Ryan', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:50', '2023-08-15 04:43:50'),
(239, 5021, 'garcia.sophia@gmail.com', '$2y$10$7JBknAU7NPDFZCivxeRHmeUN0NjsZDwAGP7/3Hz7MqMSsYJof4aP6', NULL, 'Garcia Sophia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:50', '2023-08-15 04:43:50'),
(240, 5006, 'garcia.thomas@gmail.com', '$2y$10$XfwGVi59E2LEQ60gXCam9.NTIh1AFFVzMqZ6i8y4SWWKHZrkZbqJ2', NULL, 'Garcia Thomas', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:50', '2023-08-15 04:43:50'),
(241, 5031, 'garcia.uma@gmail.com', '$2y$10$PMWwqZFhIKonh3EdBaLtbO87p52jth2uWhRlD22SUOJgx.YzStena', NULL, 'Garcia Uma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:50', '2023-08-15 04:43:50'),
(242, 5016, 'garcia.victoria@gmail.com', '$2y$10$47P17L5T.s/p1BhRBbjmFee4B04GvJe/8GbA.ckG72wLrTITw7BNa', NULL, 'Garcia Victoria', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:50', '2023-08-15 04:43:50'),
(243, 5014, 'garcia.william@gmail.com', '$2y$10$K4dUl7LDAQLytggAmEvJMeCQ3LKeLsoV9ANwnCUULmmppXRbTbh5C', NULL, 'Garcia William', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:50', '2023-08-15 04:43:50'),
(244, 2, 'garcia.xander@gmail.com', '$2y$10$SYYnjbCuNHD0mucObqCrTOu.n9LWJ6yyRtadG.Mm4.ACCb7.E4KuK', NULL, 'Garcia Xander', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:50', '2023-08-15 04:43:50'),
(245, 5021, 'garcia.yasmine@gmail.com', '$2y$10$JQNiYIj6RfDpy0yJFwn3t.etJ6dbwtsd6sO3aL.QGv/XTTnXPo31W', NULL, 'Garcia Yasmine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:50', '2023-08-15 04:43:50'),
(246, 5014, 'garcia.zachary@gmail.com', '$2y$10$YyG/vnyz/CQzTdZA0tGJk.a7xQ61mTJZuhodBlF22Z/21NJjQWS56', NULL, 'Garcia Zachary', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:51', '2023-08-15 04:43:51'),
(247, 5015, 'garcia.ava@gmail.com', '$2y$10$rc4WmgLjIGQyJtCk4V9j9u/qWu4ThW1251ombj4hi7hTJ9J1x72iS', NULL, 'Garcia Ava', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:51', '2023-08-15 04:43:51'),
(248, 5018, 'garcia.benjamin@gmail.com', '$2y$10$x0yl1u6FZYUlwnFw9pWnHu6F.W2GTZduwdwaxfa4qzAAtck4gee/S', NULL, 'Garcia Benjamin', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:51', '2023-08-15 04:43:51'),
(249, 5003, 'garcia.chloe@gmail.com', '$2y$10$e4XhjxXuPRI3Lyn6fYhbrOSMjLXXoKEfHde5qjC3bKREKq/VagkWS', NULL, 'Garcia Chloe', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:51', '2023-08-15 04:43:51');
INSERT INTO `account` (`account_id`, `role_id`, `username`, `password`, `image`, `name`, `doc_number`, `tel`, `mobile`, `address`, `valid`, `last_logged_at`, `updated_at`, `registed_at`) VALUES
(250, 5014, 'garcia.daniel@gmail.com', '$2y$10$97H/OnRiVfAMtnnhAlYZxeUShBvGztWBHAq1OuutavH6S57WNUPRG', NULL, 'Garcia Daniel', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:51', '2023-08-15 04:43:51'),
(251, 5010, 'garcia.emma@gmail.com', '$2y$10$.iWaniLm7V4qTreTOwF36eCaCbhvc1yaGQNFO0Hgq4IfWQWaabS4e', NULL, 'Garcia Emma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:51', '2023-08-15 04:43:51'),
(252, 1, 'rodriguez.alice@gmail.com', '$2y$10$J6qH7rJsxOqjXUHFYFK.tua3vuvxNmxh9FKqCh.uldeAYVqz6RkJy', NULL, 'Rodriguez Alice', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:51', '2023-08-15 04:43:51'),
(253, 4, 'rodriguez.bob@gmail.com', '$2y$10$Ohjp9M9NJ41km/xxSM6DrOgj1G9NgZNbzFQRAn7ECfidxLOeD3yS2', NULL, 'Rodriguez Bob', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:51', '2023-08-15 04:43:51'),
(254, 5012, 'rodriguez.charlie@gmail.com', '$2y$10$M9OQTzt9E7pKTgYHrpvjjeAQgUZnTFyeygEcRh6kgJTMsETWnFyBS', NULL, 'Rodriguez Charlie', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:51', '2023-08-15 04:43:51'),
(255, 5010, 'rodriguez.david@gmail.com', '$2y$10$UGacLBzX23B2tu3sFreo0OSQXRbCI7rSeDsBWzP/a3qhJMmUTq.1G', NULL, 'Rodriguez David', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:51', '2023-08-15 04:43:51'),
(256, 5018, 'rodriguez.emily@gmail.com', '$2y$10$/chbc6vjJnYo1/if5Ge/juqtROHlOgFvtBdaewrASCp7Hh9Uc6sJG', NULL, 'Rodriguez Emily', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:51', '2023-08-15 04:43:51'),
(257, 5007, 'rodriguez.frank@gmail.com', '$2y$10$DmrPuLVu7hb/mx4Jit4T4e327M.FVICnVcuG2C3l5FOjCX.kPjwru', NULL, 'Rodriguez Frank', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:51', '2023-08-15 04:43:51'),
(258, 5007, 'rodriguez.grace@gmail.com', '$2y$10$u8Bk15QalqPVJdMug7nWkeriK5znjp.COVdB4BmvhIc23C8DshaHO', NULL, 'Rodriguez Grace', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:51', '2023-08-15 04:43:51'),
(259, 5009, 'rodriguez.henry@gmail.com', '$2y$10$tYNw4YPKtd7UaTgGJAemZ.hr9dRPbD9HkagGHmhKk3tKGn8rH3vuy', NULL, 'Rodriguez Henry', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:51', '2023-08-15 04:43:51'),
(260, 5013, 'rodriguez.isabella@gmail.com', '$2y$10$nAAchfB3Jt3HkdyrEsqvJO63ffFBNcf49QqByIXovj40YQyhh14La', NULL, 'Rodriguez Isabella', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:51', '2023-08-15 04:43:51'),
(261, 4, 'rodriguez.jack@gmail.com', '$2y$10$LRjoVyZjunwGfyRw8MNlZubSa64kMS/8piDMR/jDYJQN80dG3jKD.', NULL, 'Rodriguez Jack', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:51', '2023-08-15 04:43:51'),
(262, 5019, 'rodriguez.katherine@gmail.com', '$2y$10$1Cvw9NDDZ9w/xgCr/ZRHyexHubi0U9k..gHIB192SjopLO0Y7SdUm', NULL, 'Rodriguez Katherine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:51', '2023-08-15 04:43:51'),
(263, 5030, 'rodriguez.liam@gmail.com', '$2y$10$SvZlqtGDN4dxHOx3A6zRpuNT/DZ/dSpkYPEHTBtPbs.a3fCYmhEdG', NULL, 'Rodriguez Liam', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:51', '2023-08-15 04:43:51'),
(264, 5014, 'rodriguez.mia@gmail.com', '$2y$10$QMX1uhX9fleZp.u4OO2ux.FnkeRhpFDsw3sInECZaga2Hs0EHRZKa', NULL, 'Rodriguez Mia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:51', '2023-08-15 04:43:51'),
(265, 5018, 'rodriguez.noah@gmail.com', '$2y$10$ZL0rWS00vTGnRYTYPZ24VOR0qwPkVT.ZU1s4FN0nvOmEVY4SoQJTm', NULL, 'Rodriguez Noah', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:51', '2023-08-15 04:43:51'),
(266, 5009, 'rodriguez.olivia@gmail.com', '$2y$10$KexWe4Ua6K.wLs9r6mE1OOGZz6h4NLTFgea/aIN..ahFzA/7ga.3S', NULL, 'Rodriguez Olivia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:52', '2023-08-15 04:43:52'),
(267, 5006, 'rodriguez.penelope@gmail.com', '$2y$10$m1uP5kYYVar.pz20JccvK.eMtU9dBgC145.mtCeraGsjmCtogcepS', NULL, 'Rodriguez Penelope', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:52', '2023-08-15 04:43:52'),
(268, 5030, 'rodriguez.quinn@gmail.com', '$2y$10$mjcDrEWDgy062xLxxjWmbeb5f5f8mW822QB66u76unPXqLcb2WYvm', NULL, 'Rodriguez Quinn', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:52', '2023-08-15 04:43:52'),
(269, 5011, 'rodriguez.ryan@gmail.com', '$2y$10$RKvDS6oyJzMK6j7g5vD6MOQhq6eJrZshbu2CYRisYz1kZ4wtGmfzO', NULL, 'Rodriguez Ryan', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:52', '2023-08-15 04:43:52'),
(270, 5021, 'rodriguez.sophia@gmail.com', '$2y$10$I6L5kYKJFSNAHWMyiSfZOu1JwWjNrlRZ9/atP6PstJ135bsnHJtHa', NULL, 'Rodriguez Sophia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:52', '2023-08-15 04:43:52'),
(271, 5022, 'rodriguez.thomas@gmail.com', '$2y$10$VuYTuU.7Bb8dmGAZTDsd6OOZuUA0ExxC1aqwDjgONIcUZOjIU/Keq', NULL, 'Rodriguez Thomas', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:52', '2023-08-15 04:43:52'),
(272, 2, 'rodriguez.uma@gmail.com', '$2y$10$mQ3nmoGdfx1sQvUJFdvQgeRJVWpJG4/KAQ3kfCd8fcwTVJWp0yHSq', NULL, 'Rodriguez Uma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:52', '2023-08-15 04:43:52'),
(273, 2, 'rodriguez.victoria@gmail.com', '$2y$10$n8LxQWMPDJxW5xSvcDJxcOgTInk3MSCvuh1Qsa3I6Sybn4AmH6R2C', NULL, 'Rodriguez Victoria', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:52', '2023-08-15 04:43:52'),
(274, 5030, 'rodriguez.william@gmail.com', '$2y$10$7kYk3g1q3gQvTxoKTmzSmurpFcIifJrzPNvEl20PbIHVFlN8hwgs.', NULL, 'Rodriguez William', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:52', '2023-08-15 04:43:52'),
(275, 5031, 'rodriguez.xander@gmail.com', '$2y$10$K4ZSBVmx/YQljlyMfXUV5.Otq7g2psbBjQzRm5/Q5W/z24Kts1s0y', NULL, 'Rodriguez Xander', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:52', '2023-08-15 04:43:52'),
(276, 5020, 'rodriguez.yasmine@gmail.com', '$2y$10$3nF/GnrEPHdnYO8h2fP7POk9DTM1UT4aQ//spldqoOcvo36vTYVxO', NULL, 'Rodriguez Yasmine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:52', '2023-08-15 04:43:52'),
(277, 5026, 'rodriguez.zachary@gmail.com', '$2y$10$higIjjbtleGMVOItA15WM.iWzO.Se7MMbX6ScjzhJCZD4Kk0tKb5C', NULL, 'Rodriguez Zachary', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:52', '2023-08-15 04:43:52'),
(278, 5012, 'rodriguez.ava@gmail.com', '$2y$10$MMDuTfRmMOwbGibHYaPHE.5jjoge.tInk9Z7mSqlXTQPi.5KBa6cq', NULL, 'Rodriguez Ava', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:52', '2023-08-15 04:43:52'),
(279, 5007, 'rodriguez.benjamin@gmail.com', '$2y$10$nXaJEFEeel28aK8KHJSu3.JKZDQJ20de07MVgNQA6pDk/Uz9DQo4i', NULL, 'Rodriguez Benjamin', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:52', '2023-08-15 04:43:52'),
(280, 5027, 'rodriguez.chloe@gmail.com', '$2y$10$rQ.mdAQ2vUyCnSUCTV0PuOVbrgJXrQnEHIGEbKPcTekFh2oXFhO0m', NULL, 'Rodriguez Chloe', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:52', '2023-08-15 04:43:52'),
(281, 5014, 'rodriguez.daniel@gmail.com', '$2y$10$MHd4ykTDdQs0OpVov/KenuBXqVserd5l.JsTcqA8TWWoIxxXLRg4q', NULL, 'Rodriguez Daniel', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:52', '2023-08-15 04:43:52'),
(282, 5005, 'rodriguez.emma@gmail.com', '$2y$10$aG82n5/G5VSaNt3v2MIx9OqBl7q8MMaa02GzLU8PzmK5H1al1XdLK', NULL, 'Rodriguez Emma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:52', '2023-08-15 04:43:52'),
(283, 5003, 'martinez.alice@gmail.com', '$2y$10$DmEHlzq5TmoI3Zx5NNVOAeU9kMOz6r.0AoLNqBI.thA4LTQcrkNze', NULL, 'Martinez Alice', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:52', '2023-08-15 04:43:52'),
(284, 5005, 'martinez.bob@gmail.com', '$2y$10$.qxGx2mwaqWIjKdXxBJ4VOdBtgQqGEJaWZwhAL3FA0sTKvnzjwhya', NULL, 'Martinez Bob', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:52', '2023-08-15 04:43:52'),
(285, 5005, 'martinez.charlie@gmail.com', '$2y$10$d8S1R9d.dx8iFJtJQAYEuOf1rSYXPDB1BerFoSl7W0r7zUQsc0C4y', NULL, 'Martinez Charlie', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:53', '2023-08-15 04:43:53'),
(286, 5030, 'martinez.david@gmail.com', '$2y$10$/RmGy8aMc.nrqT5L.f6ZneQnm/lKmK8Ouw8Uap1UyGBwOTq8LpzbS', NULL, 'Martinez David', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:53', '2023-08-15 04:43:53'),
(287, 5021, 'martinez.emily@gmail.com', '$2y$10$JHcCG.rrA7eLWDqp9KtHlOUkkMFvdY0ISJorFHxVh/.l2UbUQF8PC', NULL, 'Martinez Emily', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:53', '2023-08-15 04:43:53'),
(288, 5020, 'martinez.frank@gmail.com', '$2y$10$rCUtp.jIyxZ5/Kw1EVGe3O/aKRY9HEmRnwHG9tE8Z1lt.C73r9mLS', NULL, 'Martinez Frank', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:53', '2023-08-15 04:43:53'),
(289, 5011, 'martinez.grace@gmail.com', '$2y$10$okLgGi3j/I7EzlkdvyC6E.MUBhDzExmsqAjQVCCr6tt5bJq9IZGU6', NULL, 'Martinez Grace', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:53', '2023-08-15 04:43:53'),
(290, 5013, 'martinez.henry@gmail.com', '$2y$10$/l74sbRvJOjLLoJDq7Fs.OZQqe1EK7Ytq.q1cE4Mn5lLuSgfJlTtu', NULL, 'Martinez Henry', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:53', '2023-08-15 04:43:53'),
(291, 5018, 'martinez.isabella@gmail.com', '$2y$10$aGNOKoNMWSPEMbsp5VSvgOMvF5phbddbBf/gx8C6XUkEzzeuZneQy', NULL, 'Martinez Isabella', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:53', '2023-08-15 04:43:53'),
(292, 5028, 'martinez.jack@gmail.com', '$2y$10$vi3HP20bQSyo1Sf7mjaiyedFWm0c0ExSwBaBxSkD696QLtV6XdMEa', NULL, 'Martinez Jack', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:53', '2023-08-15 04:43:53'),
(293, 4, 'martinez.katherine@gmail.com', '$2y$10$DG8tf91BPR9x14j6UAgav.BXWZw466jKRBxXib0E80zdDXN/unUgW', NULL, 'Martinez Katherine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:53', '2023-08-15 04:43:53'),
(294, 5024, 'martinez.liam@gmail.com', '$2y$10$KKyGaWhJCjJ.zdNuaUQotOPpPYQXQw4hliQ8jEG9SNpW.lf80rNku', NULL, 'Martinez Liam', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:53', '2023-08-15 04:43:53'),
(295, 5031, 'martinez.mia@gmail.com', '$2y$10$uxXjHbN7RruryzelfzwaDeqvdfCWLiZXe7xQobcpumew1jLLMbTam', NULL, 'Martinez Mia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:53', '2023-08-15 04:43:53'),
(296, 5025, 'martinez.noah@gmail.com', '$2y$10$GM6M6x8yXEG.R.4RiIWtw.i/.l1GcFaIYhZmNnT5cH5FiTnJqFgti', NULL, 'Martinez Noah', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:53', '2023-08-15 04:43:53'),
(297, 5009, 'martinez.olivia@gmail.com', '$2y$10$vZ9enbWZsJmFuscCU9WmOuvhtetc/7FtewVDw0dkkdfr/lkSVt84i', NULL, 'Martinez Olivia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:53', '2023-08-15 04:43:53'),
(298, 5019, 'martinez.penelope@gmail.com', '$2y$10$JrsNBTlrh2KXus9W7fv7/.s9NI.e57/qC2O4g6IaZf.Ba2zV.z0ka', NULL, 'Martinez Penelope', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:53', '2023-08-15 04:43:53'),
(299, 5020, 'martinez.quinn@gmail.com', '$2y$10$Fgbm7qFmo2fOB7DTXweOKuvWJKpLrvmtIYbvQTDgvzXWK40rNuUny', NULL, 'Martinez Quinn', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:53', '2023-08-15 04:43:53'),
(300, 5010, 'martinez.ryan@gmail.com', '$2y$10$xeTgdj2aKPukG4aROlx59OzPaV2RUNz7lcMQjQRiq/dnmRUgdaYi6', NULL, 'Martinez Ryan', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:53', '2023-08-15 04:43:53'),
(301, 5020, 'martinez.sophia@gmail.com', '$2y$10$5i8qEJaYeXERnIHSgLAJ7uaFsheFy8TD2SVPn05Ltbxi3oLoJLJ9.', NULL, 'Martinez Sophia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:53', '2023-08-15 04:43:53'),
(302, 5012, 'martinez.thomas@gmail.com', '$2y$10$365CYTR.MMPfn79vH.VN9ul0n84IY1/FY52Pu9EC1ZjxhRFAU0lKC', NULL, 'Martinez Thomas', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:53', '2023-08-15 04:43:53'),
(303, 5020, 'martinez.uma@gmail.com', '$2y$10$uLWBcZJ4odgBgShRNaHZEui/km0pLzhKNWUrL51vLJFd7g4./.maK', NULL, 'Martinez Uma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:54', '2023-08-15 04:43:54'),
(304, 5015, 'martinez.victoria@gmail.com', '$2y$10$j9tgm6eHDli8VSiKI20kuO5KalcjWpmeHVyuFo3JT.ayt1JlmxTRC', NULL, 'Martinez Victoria', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:54', '2023-08-15 04:43:54'),
(305, 5014, 'martinez.william@gmail.com', '$2y$10$G4iR6JhdNNoXIC4zAzKrwOtRXjYkRSAP8Aj46Wg4VIG3wsjsyC8/K', NULL, 'Martinez William', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:54', '2023-08-15 04:43:54'),
(306, 5007, 'martinez.xander@gmail.com', '$2y$10$POL1WQS4iZoN4q44sqp8ge.GwDUxpVq5SVpA5nxv2UKqCBY4aql5C', NULL, 'Martinez Xander', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:54', '2023-08-15 04:43:54'),
(307, 5018, 'martinez.yasmine@gmail.com', '$2y$10$SZ.YQ5S4N6KJlhBEsxmrT.o0F1./mLFV3d/kn0Kylgvx/qV5kG6wq', NULL, 'Martinez Yasmine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:54', '2023-08-15 04:43:54'),
(308, 5012, 'martinez.zachary@gmail.com', '$2y$10$Nrz0DgvQAovzUkYhCyIS8OvpU.14B7uXOfMiv7dPCrMdO3FtgeyPm', NULL, 'Martinez Zachary', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:54', '2023-08-15 04:43:54'),
(309, 1, 'martinez.ava@gmail.com', '$2y$10$djhmM/VfLFGksBTgpv9hNOtc7qqYwdeTPmqPM0ulLItBn9/XbFkrS', NULL, 'Martinez Ava', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:54', '2023-08-15 04:43:54'),
(310, 5010, 'martinez.benjamin@gmail.com', '$2y$10$c2Nf7Fbx6PNuohBBkLz2rOopuHp1Y3iC9.tSWVzqtPTH5l8aRFar2', NULL, 'Martinez Benjamin', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:54', '2023-08-15 04:43:54'),
(311, 5028, 'martinez.chloe@gmail.com', '$2y$10$DFtK/nLKKBKmp1bpP.sz7uipnwZ5e/M/cr9JUD.NtGQxkIt5zVjBS', NULL, 'Martinez Chloe', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:54', '2023-08-15 04:43:54'),
(312, 5020, 'martinez.daniel@gmail.com', '$2y$10$iEcGh5gvDhSOWt6hRNMui.BbyoNNv9ik1mCOZtRCwxXMfBmoSWQw.', NULL, 'Martinez Daniel', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:54', '2023-08-15 04:43:54'),
(313, 5028, 'martinez.emma@gmail.com', '$2y$10$6xkyLfzWburY/Z7nR.IYGOoEWITFrM8/j2.NsAO5b6PMZcUB719Sq', NULL, 'Martinez Emma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:54', '2023-08-15 04:43:54'),
(314, 5031, 'hernandez.alice@gmail.com', '$2y$10$qEeku0yQopf6VziHgpgvQelGpIn0uJ4iFaNvoEhu2ascDCyo9t/f6', NULL, 'Hernandez Alice', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:54', '2023-08-15 04:43:54'),
(315, 5013, 'hernandez.bob@gmail.com', '$2y$10$6URNJ8URaN7f2Rl04pYR/ebQB.EDgiQXL7Tz6QSKbaD3//GC.7/se', NULL, 'Hernandez Bob', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:54', '2023-08-15 04:43:54'),
(316, 5019, 'hernandez.charlie@gmail.com', '$2y$10$La/UedNz8VmAHIMvonZ2g.8ocOSuVBuGnOdraUexXgFqbQQ0YRmpy', NULL, 'Hernandez Charlie', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:54', '2023-08-15 04:43:54'),
(317, 5015, 'hernandez.david@gmail.com', '$2y$10$Mz/R/0ab4eJTHFOzXA/mQO1HcNs6UWeSUWjkVRLzD.78mUIlqKSwO', NULL, 'Hernandez David', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:54', '2023-08-15 04:43:54'),
(318, 5015, 'hernandez.emily@gmail.com', '$2y$10$Tw8wZ/4kXJowatjT6jBlwOz46OkfeLwWkbd5t/zTZwK2F2Keki9fu', NULL, 'Hernandez Emily', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:54', '2023-08-15 04:43:54'),
(319, 5013, 'hernandez.frank@gmail.com', '$2y$10$mJsfif6FL70YCxGPAucfH.5q3MA6UW.JfuhQrsThMX6DGDIBUXzJS', NULL, 'Hernandez Frank', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:54', '2023-08-15 04:43:54'),
(320, 5028, 'hernandez.grace@gmail.com', '$2y$10$MdS3CXeeN.QDSEkVwdbi.e0vZbfXrYtyCsqW3vbqFWiBl05MQeusq', NULL, 'Hernandez Grace', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:54', '2023-08-15 04:43:54'),
(321, 5009, 'hernandez.henry@gmail.com', '$2y$10$NkDr3ci5UGjwmIzG7FZ1z./s3WyBaKZWQAJvS8QqoR1rsKKqVbRyC', NULL, 'Hernandez Henry', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:54', '2023-08-15 04:43:54'),
(322, 5007, 'hernandez.isabella@gmail.com', '$2y$10$ZRfynylUuj1PGMf7h4afQORZbK7Rq7RhLewdBrZo0kUP4VFDCuf5O', NULL, 'Hernandez Isabella', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:55', '2023-08-15 04:43:55'),
(323, 4, 'hernandez.jack@gmail.com', '$2y$10$LZKdU9WcwjVvysDhVrc0oedzpLTenRGdvfNAnJas5fW8.koOl0khm', NULL, 'Hernandez Jack', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:55', '2023-08-15 04:43:55'),
(324, 5030, 'hernandez.katherine@gmail.com', '$2y$10$zkJFaU6uaN998gGs8qXyJOjTLtst9bdukXb0Kx6qWBqGFs1JFc3mW', NULL, 'Hernandez Katherine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:55', '2023-08-15 04:43:55'),
(325, 5022, 'hernandez.liam@gmail.com', '$2y$10$7.9ViT37o0g9ZYqKMVRsCeGkw5R4faXZnifdt6UAWvCl6NsEJ8DK.', NULL, 'Hernandez Liam', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:55', '2023-08-15 04:43:55'),
(326, 5016, 'hernandez.mia@gmail.com', '$2y$10$aJK./1AwvfT/LW.HTIOLdOLSYj4OR8q1ZqO91qA.B0BFIY.Mj4dzm', NULL, 'Hernandez Mia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:55', '2023-08-15 04:43:55'),
(327, 5022, 'hernandez.noah@gmail.com', '$2y$10$3jNCBl0zFauuBJbiEylgOuank7KZRD9X/HBPAy6l8uczFO8Vdi8xe', NULL, 'Hernandez Noah', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:55', '2023-08-15 04:43:55'),
(328, 5005, 'hernandez.olivia@gmail.com', '$2y$10$pjVMBZju/gqIn1HmFJYB8eST/2fQtTi83CFXxSOU42Mv28FUuLvEu', NULL, 'Hernandez Olivia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:55', '2023-08-15 04:43:55'),
(329, 5019, 'hernandez.penelope@gmail.com', '$2y$10$Y96zTKOqImz4rYk0KHX6KeuF4TpN3MxARCPMkcK.YYhj0mbUVNrmi', NULL, 'Hernandez Penelope', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:55', '2023-08-15 04:43:55'),
(330, 5013, 'hernandez.quinn@gmail.com', '$2y$10$7OZT/iIshq.FasYjFV9zMe1iKMBvRXUVsY0DqWhT3rmkJ6zoPylLm', NULL, 'Hernandez Quinn', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:55', '2023-08-15 04:43:55'),
(331, 5012, 'hernandez.ryan@gmail.com', '$2y$10$Z/6VflKG49am1UyGEtMhW.Q8aKIbGYm856uxVMp0z8P01g1RpCX7K', NULL, 'Hernandez Ryan', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:55', '2023-08-15 04:43:55'),
(332, 5026, 'hernandez.sophia@gmail.com', '$2y$10$Ukh2uFOS8L0a5ucsjS2RUuInpDokNlLYDuraLp7Fo01qMlJHfN4h6', NULL, 'Hernandez Sophia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:55', '2023-08-15 04:43:55'),
(333, 5027, 'hernandez.thomas@gmail.com', '$2y$10$/JmuShXgpaWeL4pvrdPYRu.9RZEGkaEZ8roHOELSOobRvweCFIsea', NULL, 'Hernandez Thomas', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:55', '2023-08-15 04:43:55'),
(334, 2, 'hernandez.uma@gmail.com', '$2y$10$qnsc9E6NK2MiFj8gIVAG3uiufrwjvTf8vTBOCXxxPJgOPjovFeSCm', NULL, 'Hernandez Uma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:55', '2023-08-15 04:43:55'),
(335, 5020, 'hernandez.victoria@gmail.com', '$2y$10$ld/dSXPM5CD4I/.y7EXWgeOUBAniaIXRagGaOYHfGaJML2liJD5Sy', NULL, 'Hernandez Victoria', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:55', '2023-08-15 04:43:55'),
(336, 5010, 'hernandez.william@gmail.com', '$2y$10$jTbQGu.xKyX7qBQcy32UMeKS.rhY.VLoL7om3QjtcCD2KWUEauR4i', NULL, 'Hernandez William', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:55', '2023-08-15 04:43:55'),
(337, 2, 'hernandez.xander@gmail.com', '$2y$10$nqpnn075w9HrMM294dvZDOd4SP6iQz1Ma2.sdFYBaJe2vPFU5jvU2', NULL, 'Hernandez Xander', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:55', '2023-08-15 04:43:55'),
(338, 5003, 'hernandez.yasmine@gmail.com', '$2y$10$FcAITpSL3EZGV0QIY8470uewGcnY3X94RETG2l9ZlXjO8n0XtZS9i', NULL, 'Hernandez Yasmine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:55', '2023-08-15 04:43:55'),
(339, 5021, 'hernandez.zachary@gmail.com', '$2y$10$BrR8uSS.K5c/Ox9Ms09x6.JxP0x3IIVeDG5vcESoaxj3Ju9SokXMa', NULL, 'Hernandez Zachary', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:55', '2023-08-15 04:43:55'),
(340, 5011, 'hernandez.ava@gmail.com', '$2y$10$uwX6D1YiNiAnsF7uQzh7V.saS29gbPYmTVQIZC/GdljrOXmxxidHu', NULL, 'Hernandez Ava', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:55', '2023-08-15 04:43:55'),
(341, 5022, 'hernandez.benjamin@gmail.com', '$2y$10$iwYFWNwQiHeOANyLmJsb2u9/nlRFG8L/KoMKuvs3az8ZOkSHNXxCK', NULL, 'Hernandez Benjamin', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:56', '2023-08-15 04:43:56'),
(342, 5024, 'hernandez.chloe@gmail.com', '$2y$10$nahl1DX2DwSuSpZXzdnDweTNpYr7jevpvCUXJED6kyBVOAUkYyjQG', NULL, 'Hernandez Chloe', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:56', '2023-08-15 04:43:56'),
(343, 1, 'hernandez.daniel@gmail.com', '$2y$10$1EaXF8/D/2Z3y8xM5248r.O5rL9Qamp/qFgYAUTvzMWr6Rzm3nJFi', NULL, 'Hernandez Daniel', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:56', '2023-08-15 04:43:56'),
(344, 5025, 'hernandez.emma@gmail.com', '$2y$10$tn8EzBH0RwDjJSQSD1Fdqe7DdsvwWOr3HoPd09Qgu1lG1HT6cS0PC', NULL, 'Hernandez Emma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:56', '2023-08-15 04:43:56'),
(345, 5030, 'lopez.alice@gmail.com', '$2y$10$2rFFSWBFZuXk3Riu9krZMuy6q5Slild2xpZiTeNnysCbE2vGZVMOq', NULL, 'Lopez Alice', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:56', '2023-08-15 04:43:56'),
(346, 5025, 'lopez.bob@gmail.com', '$2y$10$ioNH/AwTQdQwGyINQoaS4enVmoNe0YcgUgPZR9ZC9l8y5lvPkplL.', NULL, 'Lopez Bob', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:56', '2023-08-15 04:43:56'),
(347, 5030, 'lopez.charlie@gmail.com', '$2y$10$jS7LQTgrW4oVbSqzIIMxG.WiUevzi53lWyVRMtyBVP7rIAYavzEry', NULL, 'Lopez Charlie', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:56', '2023-08-15 04:43:56'),
(348, 5010, 'lopez.david@gmail.com', '$2y$10$zsBFjxKnY0VfBV.3nzXv8OuImtcR0ALjUR6SolPAeEDsyTK/q7i56', NULL, 'Lopez David', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:56', '2023-08-15 04:43:56'),
(349, 5011, 'lopez.emily@gmail.com', '$2y$10$81050IPDxJ3Edf/Uar90EO71mrKWNyFhxKjAL0Y38d.y8lH2kwrnG', NULL, 'Lopez Emily', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:56', '2023-08-15 04:43:56'),
(350, 5012, 'lopez.frank@gmail.com', '$2y$10$5AvOyDlyrcM/EdGJSE9UheF38hV3.R1F/ZIB49VrPaM0l43OCfTEa', NULL, 'Lopez Frank', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:56', '2023-08-15 04:43:56'),
(351, 5007, 'lopez.grace@gmail.com', '$2y$10$OvZdiseeghLt2zyLyT2Yteh0lVZcTU.e6NXZK8/E19m860usVDf/q', NULL, 'Lopez Grace', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:56', '2023-08-15 04:43:56'),
(352, 5021, 'lopez.henry@gmail.com', '$2y$10$hyc3U2c88Ld4pNGH.EFHHuSp4QnUm20CC7KobY.D1g4Rr9ksaibrG', NULL, 'Lopez Henry', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:56', '2023-08-15 04:43:56'),
(353, 5028, 'lopez.isabella@gmail.com', '$2y$10$XypE.oAoEyOXnRIYN1fNA.Dxhn0C85Efw2ygTQv/izksze4weuuaK', NULL, 'Lopez Isabella', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:56', '2023-08-15 04:43:56'),
(354, 5022, 'lopez.jack@gmail.com', '$2y$10$oc8Vx3XJPPCRedjugZ7avOfSko6h7j2mc7sPU4td7gl6Jn7S/Oiuy', NULL, 'Lopez Jack', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:56', '2023-08-15 04:43:56'),
(355, 5007, 'lopez.katherine@gmail.com', '$2y$10$UdsQaCMYnIfoEDMZSA7TZeibnh6ITrALANWhxa4XWQszfeVhJ4aWi', NULL, 'Lopez Katherine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:56', '2023-08-15 04:43:56'),
(356, 1, 'lopez.liam@gmail.com', '$2y$10$Kj9Mk5ZmMLKN7Ej3v3oOH.k0q4gTLqVJEyijVmSbZ6d1KxjTS3cai', NULL, 'Lopez Liam', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:56', '2023-08-15 04:43:56'),
(357, 5009, 'lopez.mia@gmail.com', '$2y$10$UDzXkJY66a.3xmce1tV5rOUJyYUCz4c/A9j5oti/LlHElX7256Cr2', NULL, 'Lopez Mia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:56', '2023-08-15 04:43:56'),
(358, 5007, 'lopez.noah@gmail.com', '$2y$10$lIc3sX3FeEqRiQVZxc0bVe/ilC2rQZ1KwAtdQ3RzDgIMZQLfIhHLO', NULL, 'Lopez Noah', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:56', '2023-08-15 04:43:56'),
(359, 5018, 'lopez.olivia@gmail.com', '$2y$10$cK/u46wRDEdJKc0JmP9KoOVVv3ZGD5L3O.n1wrSQgYPoGbhG6NIb6', NULL, 'Lopez Olivia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:56', '2023-08-15 04:43:56'),
(360, 5023, 'lopez.penelope@gmail.com', '$2y$10$UsudyJajRvSatWPV7rAf7.DiaUeK0fMJthyFuwQOuQ1hJ/sFWfsK6', NULL, 'Lopez Penelope', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:57', '2023-08-15 04:43:57'),
(361, 5009, 'lopez.quinn@gmail.com', '$2y$10$LlZbMsnef9nVClcozJOaz.h3CHItgfshBB68ufHCHWG7AYG79X..u', NULL, 'Lopez Quinn', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:57', '2023-08-15 04:43:57'),
(362, 5009, 'lopez.ryan@gmail.com', '$2y$10$7xcMoQMwc4FgDdDRCcEAC.PkNQdoFDsm9IAfztaXIFBI5Rp4bYIpO', NULL, 'Lopez Ryan', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:57', '2023-08-15 04:43:57'),
(363, 5028, 'lopez.sophia@gmail.com', '$2y$10$38zu/sE4h3D8xj6pghd0DeGCLzskp0vIAxoA8DTaPRLXXFoDW.OzC', NULL, 'Lopez Sophia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:57', '2023-08-15 04:43:57'),
(364, 5009, 'lopez.thomas@gmail.com', '$2y$10$v/r4DNF.0HlDYD1HUI68COhzpdDFf8UVI6vzXVWcBfeiKKdGVVBmO', NULL, 'Lopez Thomas', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:57', '2023-08-15 04:43:57'),
(365, 5031, 'lopez.uma@gmail.com', '$2y$10$XApJzI2Iz8OHFSWoH8XXYeT6amT14XGnZWZltwQqVT5JWBsTQdRJK', NULL, 'Lopez Uma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:57', '2023-08-15 04:43:57'),
(366, 5013, 'lopez.victoria@gmail.com', '$2y$10$XvZxTqfCGETBAmx.EsfHou/8DInL6eEVWTmkg5Wmgpf3Q9SX9H/KO', NULL, 'Lopez Victoria', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:57', '2023-08-15 04:43:57'),
(367, 5009, 'lopez.william@gmail.com', '$2y$10$QTYwusBoLAptH2s18JuS.uoWGcgqNTOkGnaJQEoDkHhp4oWD6IieK', NULL, 'Lopez William', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:57', '2023-08-15 04:43:57'),
(368, 5015, 'lopez.xander@gmail.com', '$2y$10$/Utd3T.4Fg6h2qP7dBkVIuCe6vzSAN1Qq5vj6pJiWpdGHMdWs.7Eu', NULL, 'Lopez Xander', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:57', '2023-08-15 04:43:57'),
(369, 5022, 'lopez.yasmine@gmail.com', '$2y$10$ZqlskmmZXx2uQumJNjBxzuJgkpRBX09bW6jK0yyfG2y5XPBsmxArO', NULL, 'Lopez Yasmine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:57', '2023-08-15 04:43:57'),
(370, 5030, 'lopez.zachary@gmail.com', '$2y$10$n4YJHZHrbtoQw6kcQ8EdL.0nZXU57aeTAcb81qQK9gqJw5EojE.1e', NULL, 'Lopez Zachary', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:57', '2023-08-15 04:43:57'),
(371, 5028, 'lopez.ava@gmail.com', '$2y$10$MQZ37deLuxboIA1m39MsBOpzLMWCGWVj2oM8lUmFllTDIj9o431Q2', NULL, 'Lopez Ava', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:57', '2023-08-15 04:43:57'),
(372, 5022, 'lopez.benjamin@gmail.com', '$2y$10$v8RT9DqW4MUHCig2QCU1pePee95tvKMo9suDpNxAtduVeoIIhHhhG', NULL, 'Lopez Benjamin', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:57', '2023-08-15 04:43:57'),
(373, 5020, 'lopez.chloe@gmail.com', '$2y$10$w9HSYowyAZc3E7VdPNXUYOAnL9d6zP8J.61JedaCEJn7YjfeqfCgq', NULL, 'Lopez Chloe', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:57', '2023-08-15 04:43:57'),
(374, 5024, 'lopez.daniel@gmail.com', '$2y$10$sngoc027OcNBTWo.Ez9qROmHGPncultm7uhbo3490sRMHnWZiwGjW', NULL, 'Lopez Daniel', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:57', '2023-08-15 04:43:57'),
(375, 5006, 'lopez.emma@gmail.com', '$2y$10$nC6ay2kE2RK9OWGVYX4zt.EleXbfrwC1o7gZHLuG0XprAHsBcV7ca', NULL, 'Lopez Emma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:57', '2023-08-15 04:43:57'),
(376, 5026, 'gonzalez.alice@gmail.com', '$2y$10$RxmzfrAPkxy4cLnOTgOKh.OZobp7iBvabS7hhXQkBxfFUwU6a9Ifu', NULL, 'Gonzalez Alice', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:57', '2023-08-15 04:43:57'),
(377, 5015, 'gonzalez.bob@gmail.com', '$2y$10$Lg.OYW8zFKShiAQkJJVk6OKmzd.ri.wSWp3c48JXgGWCNw7L1vNcC', NULL, 'Gonzalez Bob', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:57', '2023-08-15 04:43:57'),
(378, 5023, 'gonzalez.charlie@gmail.com', '$2y$10$PGaSJSr6QPVovi7jZV05nuRqWZDsZHbM9VBfOQS1MjvrIgCdGGTle', NULL, 'Gonzalez Charlie', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:57', '2023-08-15 04:43:57'),
(379, 5022, 'gonzalez.david@gmail.com', '$2y$10$ucZ6COCkMv4gRKYC6ZfnK.zCi3XveBXQ5.1qDUQRBazLpaiQ3HIMa', NULL, 'Gonzalez David', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:58', '2023-08-15 04:43:58'),
(380, 5027, 'gonzalez.emily@gmail.com', '$2y$10$DetKoGjZ45Jf8JfWX.DSLeHGCCot6CepOKli/IzwkE3l2CTxpnT66', NULL, 'Gonzalez Emily', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:58', '2023-08-15 04:43:58'),
(381, 5009, 'gonzalez.frank@gmail.com', '$2y$10$l/UTzgZr2lS7GHACisMngOeIa021ScEIavedkIlQfF2xhf6Gp6xF.', NULL, 'Gonzalez Frank', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:58', '2023-08-15 04:43:58'),
(382, 5018, 'gonzalez.grace@gmail.com', '$2y$10$L9Cw6QkbRtd4Vqmv1n.se.HDOF3KBp6vSDlJc/m7l2bf8uEPbjqmG', NULL, 'Gonzalez Grace', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:58', '2023-08-15 04:43:58'),
(383, 5027, 'gonzalez.henry@gmail.com', '$2y$10$X0720rdJYhpNFz3mqphmueEgm1cDMgCREThMBnGNdnRvxDeh/Yi6.', NULL, 'Gonzalez Henry', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:58', '2023-08-15 04:43:58'),
(384, 5006, 'gonzalez.isabella@gmail.com', '$2y$10$w/pfZywXssRMlXLMXpBY3OGwY2sXLOpnVpqrvgZA8B9/r/KkruQPq', NULL, 'Gonzalez Isabella', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:58', '2023-08-15 04:43:58'),
(385, 5017, 'gonzalez.jack@gmail.com', '$2y$10$KFb1jJpw5aygYn63Vj1OquZuVLrj5ugBCfW/zYGHVJ.GlP60MrDR2', NULL, 'Gonzalez Jack', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:58', '2023-08-15 04:43:58'),
(386, 1, 'gonzalez.katherine@gmail.com', '$2y$10$jBpJ9GyvmRJHaNO63HHm8O8zsCIhoRNJD/jCmZFi4bwH9/aMNgsZ6', NULL, 'Gonzalez Katherine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:58', '2023-08-15 04:43:58'),
(387, 5012, 'gonzalez.liam@gmail.com', '$2y$10$ds/ddXZoPMVAGceqMSdHreqWjXxGLiRlztxQnylGIBalBOohrke6C', NULL, 'Gonzalez Liam', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:58', '2023-08-15 04:43:58'),
(388, 5019, 'gonzalez.mia@gmail.com', '$2y$10$9uJdqoZ3XGImk0HWdETMR.HYCVG.mLkXU8EzYFbqvnRo.VrrovpEC', NULL, 'Gonzalez Mia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:58', '2023-08-15 04:43:58'),
(389, 5005, 'gonzalez.noah@gmail.com', '$2y$10$z42uCJ0BadJXngl1nSldiedHl5PoojDdv0acdiJVTEf29HcE8YEm.', NULL, 'Gonzalez Noah', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:58', '2023-08-15 04:43:58'),
(390, 5010, 'gonzalez.olivia@gmail.com', '$2y$10$vcDHYkHejeKz4ybJpIzJQueWbiztbzTdHjvp5QZTM9Uub.5ZSJyfm', NULL, 'Gonzalez Olivia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:58', '2023-08-15 04:43:58'),
(391, 5025, 'gonzalez.penelope@gmail.com', '$2y$10$bkI8QlJCT.mHYUCwkI6ZiuVws1/xnBgpM8gJ2Xm8AwlUsW0hKYT.C', NULL, 'Gonzalez Penelope', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:58', '2023-08-15 04:43:58'),
(392, 5019, 'gonzalez.quinn@gmail.com', '$2y$10$lcgSWVtPvt0Q8xWMlJcHBOfeT7FP/i3NC7q6/vK0L2ItGA89f7hoq', NULL, 'Gonzalez Quinn', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:58', '2023-08-15 04:43:58'),
(393, 5017, 'gonzalez.ryan@gmail.com', '$2y$10$/0A3skPrChDamispvA9eme47.svyX7mym1T3tBr7qdjQGtKNAvCGm', NULL, 'Gonzalez Ryan', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:58', '2023-08-15 04:43:58'),
(394, 5015, 'gonzalez.sophia@gmail.com', '$2y$10$h/nAPeE7QtHLg5TdTxc2Heokmpklf24f.4MNuvfTOFEvVDVvhxRs.', NULL, 'Gonzalez Sophia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:58', '2023-08-15 04:43:58'),
(395, 5015, 'gonzalez.thomas@gmail.com', '$2y$10$hc5WbBA1SGegNgN5sHXyJONy1jcf9CZrn10.CxVhsXRBo9I8baVGi', NULL, 'Gonzalez Thomas', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:58', '2023-08-15 04:43:58'),
(396, 5026, 'gonzalez.uma@gmail.com', '$2y$10$8BBGUKBMZl6K2DU.SblE6uhcl3veW0TfCMiKLqypDbZje6ZgAtQjW', NULL, 'Gonzalez Uma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:58', '2023-08-15 04:43:58'),
(397, 5013, 'gonzalez.victoria@gmail.com', '$2y$10$d4CKiy1pGClU4DoNbSQhMu6F2eZchQWx5U.L9bjjEb/tU8ofhfvde', NULL, 'Gonzalez Victoria', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:58', '2023-08-15 04:43:58'),
(398, 5006, 'gonzalez.william@gmail.com', '$2y$10$LU90S3exbjAJpRiOOatsQOu6hFA2D75D491OebZrGLaik9NA5hGfy', NULL, 'Gonzalez William', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:59', '2023-08-15 04:43:59'),
(399, 5026, 'gonzalez.xander@gmail.com', '$2y$10$jhmpopgY7ZAcbilfAGt5mOGVSMqeafsIlcgPLUSQeehTFiGG60P0a', NULL, 'Gonzalez Xander', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:59', '2023-08-15 04:43:59'),
(400, 5016, 'gonzalez.yasmine@gmail.com', '$2y$10$oWkHXC973jZ2u5UiUePr6ORVs.dNPlvJfnczhPBlQx8JxgU0F6Cvu', NULL, 'Gonzalez Yasmine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:59', '2023-08-15 04:43:59'),
(401, 5005, 'gonzalez.zachary@gmail.com', '$2y$10$6hkxk5jAWSGVXATCpLdgLOVN1PVE11YSJKIPdUaZkYf0YIqD/GO/O', NULL, 'Gonzalez Zachary', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:59', '2023-08-15 04:43:59'),
(402, 5022, 'gonzalez.ava@gmail.com', '$2y$10$dVQYOgGzfjW2/xmSGOhbEeZYhiPVwWoOWjmtJR2avnqbXtI1C8X7a', NULL, 'Gonzalez Ava', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:59', '2023-08-15 04:43:59'),
(403, 5027, 'gonzalez.benjamin@gmail.com', '$2y$10$TzckQKO9lLRk38dD6teBWuZaDXjZprLUOMeyzU9M9lcIewXu0EJPe', NULL, 'Gonzalez Benjamin', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:59', '2023-08-15 04:43:59'),
(404, 5015, 'gonzalez.chloe@gmail.com', '$2y$10$0zX8/LSI/gpRb4Z6iCO5JuDlK/3ytht5w9/P/BUq9KmatJxRmsCMC', NULL, 'Gonzalez Chloe', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:59', '2023-08-15 04:43:59'),
(405, 5020, 'gonzalez.daniel@gmail.com', '$2y$10$VatVpTXMv3Tt7f.yNNnmGeabGWnb3tTmy9fGRfjJ6DPM8QHOdnehW', NULL, 'Gonzalez Daniel', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:59', '2023-08-15 04:43:59'),
(406, 5017, 'gonzalez.emma@gmail.com', '$2y$10$L4ZZVarTXPzdze07A8eiGOuqvECyFtf60LmubO1Rf1MdSxg3tmHcu', NULL, 'Gonzalez Emma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:59', '2023-08-15 04:43:59'),
(407, 2, 'perez.alice@gmail.com', '$2y$10$EePGodGOrkrLfgWu.JIiK.Nmb7PELlN1udqdddsXr1QZS9aCj9/26', NULL, 'Perez Alice', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:59', '2023-08-15 04:43:59'),
(408, 5014, 'perez.bob@gmail.com', '$2y$10$aJar/xPWTz965hLChp6ga.cQYeiDBnS8beaem8oCh6kTWwaijbSVe', NULL, 'Perez Bob', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:59', '2023-08-15 04:43:59'),
(409, 5010, 'perez.charlie@gmail.com', '$2y$10$tWXpTTrXtFSuoeV/xJupheiGBm/t4cMpV3P8juFLZ/LSYbO35IYt2', NULL, 'Perez Charlie', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:59', '2023-08-15 04:43:59'),
(410, 5022, 'perez.david@gmail.com', '$2y$10$doRoc1Rz15cvJ3VJmqengufuF.y1C384B4A60hF.B8Eqpy6B1mf/.', NULL, 'Perez David', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:59', '2023-08-15 04:43:59'),
(411, 5016, 'perez.emily@gmail.com', '$2y$10$v.LidCZF0K5FEzxskQWZ6eefHqTgIVXjbCASaL0UlOJpHTKbQDHG2', NULL, 'Perez Emily', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:59', '2023-08-15 04:43:59'),
(412, 5025, 'perez.frank@gmail.com', '$2y$10$JeDfziWalalLeb.bFTNvU.S2BkliQrWtJQCkqiOTmMeD.TCYi.K62', NULL, 'Perez Frank', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:59', '2023-08-15 04:43:59'),
(413, 5015, 'perez.grace@gmail.com', '$2y$10$.PK.YLWme/ESHhgqjFf2g.06Smh7QeKtxVgRAV5jA.imo6g7k4mWS', NULL, 'Perez Grace', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:59', '2023-08-15 04:43:59'),
(414, 5013, 'perez.henry@gmail.com', '$2y$10$OAm7ATcdoYgzfJQ6NwQzDO0IB9mFRQvy/e7uEQjjZ7gu7rdccRiHq', NULL, 'Perez Henry', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:59', '2023-08-15 04:43:59'),
(415, 5005, 'perez.isabella@gmail.com', '$2y$10$26WtiWXzEgJ8KMxHN/NHwe8T.dck2DDwgkf22egQp45AdbyYIMh.K', NULL, 'Perez Isabella', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:43:59', '2023-08-15 04:43:59'),
(416, 5007, 'perez.jack@gmail.com', '$2y$10$c1gAd4OoEj6S6E3ZnW5RLu8T3GbJV//NDOVjydiP36ISJyR9o3x.y', NULL, 'Perez Jack', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:00', '2023-08-15 04:44:00'),
(417, 5028, 'perez.katherine@gmail.com', '$2y$10$tC4VlMEno09k8gl0SOIweOjIjDLKTKhnE86R20MnUg38AMGO3GZ6S', NULL, 'Perez Katherine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:00', '2023-08-15 04:44:00'),
(418, 5031, 'perez.liam@gmail.com', '$2y$10$bcXKvpS7prLQ4gLA9.FPIO9UWhqY7RnydeVb8vsFKIufw8yaHaAAO', NULL, 'Perez Liam', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:00', '2023-08-15 04:44:00'),
(419, 5009, 'perez.mia@gmail.com', '$2y$10$lb1Ej30j9aCcDvcGmuHkPuAk78BtvqGa7wDPakNzNONEdp.GRlJEW', NULL, 'Perez Mia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:00', '2023-08-15 04:44:00'),
(420, 5011, 'perez.noah@gmail.com', '$2y$10$HbBZrQuHxd8SVzX3HK.7/OjyS0ruQCYrMCnU1p/Y2Gq89vp7XPF3C', NULL, 'Perez Noah', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:00', '2023-08-15 04:44:00'),
(421, 5007, 'perez.olivia@gmail.com', '$2y$10$F2XfRCFMg1Yv76xQzMFfK.qGCfTYVwGFnuz4Yszs84EntiXZqld..', NULL, 'Perez Olivia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:00', '2023-08-15 04:44:00'),
(422, 4, 'perez.penelope@gmail.com', '$2y$10$XDbz8nXP3P0O1PyowVKJkO.8Mb4TTvcUCFb0PS4rTXdXfyC31lsZu', NULL, 'Perez Penelope', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:00', '2023-08-15 04:44:00'),
(423, 5013, 'perez.quinn@gmail.com', '$2y$10$youkhXSMT1984yfvv4ACVuEdQBopI7Dt9WJob5NMAHNX0tB9VSCY2', NULL, 'Perez Quinn', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:00', '2023-08-15 04:44:00'),
(424, 5009, 'perez.ryan@gmail.com', '$2y$10$yBH1lyv5jfMB5J79KIr4seZNf4hv0PmfpODO03PWZZI3GFG.QBLB2', NULL, 'Perez Ryan', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:00', '2023-08-15 04:44:00'),
(425, 5023, 'perez.sophia@gmail.com', '$2y$10$iZ/igqh/kwR7ZrbRRWtO6Oh/xOse657FxiCmHYDrDOSe3Ch/RwS5y', NULL, 'Perez Sophia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:00', '2023-08-15 04:44:00'),
(426, 5022, 'perez.thomas@gmail.com', '$2y$10$LTno71pRikBf0.1Y92UPlOmvXsvzU4t7XdlUs0zuyQPx.BWbI2GQW', NULL, 'Perez Thomas', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:00', '2023-08-15 04:44:00'),
(427, 5028, 'perez.uma@gmail.com', '$2y$10$J0658qFwSqRZtZtzTIaTKu24cVIPZKbwgUhfJ6RQBPkcerHt83b0C', NULL, 'Perez Uma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:00', '2023-08-15 04:44:00'),
(428, 5020, 'perez.victoria@gmail.com', '$2y$10$cQrtgP2P8gpsQIXuxc79zevq4g/BdI0PCcfG458fQBXY3pJ0OUYGO', NULL, 'Perez Victoria', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:00', '2023-08-15 04:44:00'),
(429, 5018, 'perez.william@gmail.com', '$2y$10$3NaILT8VUlwj0cSwb4ra9OfCD3LDP5CRywyzYeGG582vxPY8caiyu', NULL, 'Perez William', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:00', '2023-08-15 04:44:00'),
(430, 5021, 'perez.xander@gmail.com', '$2y$10$536IZZI183/wBTtRnzfkk.zS1VYnxJy..DEil71w871PLB/SnEjfK', NULL, 'Perez Xander', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:00', '2023-08-15 04:44:00'),
(431, 5026, 'perez.yasmine@gmail.com', '$2y$10$GcHkwMQIYLu8YI0uEyF98.6hKCq/DdxvxbLMcUoaSqt6mtKZf8o4q', NULL, 'Perez Yasmine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:00', '2023-08-15 04:44:00'),
(432, 5018, 'perez.zachary@gmail.com', '$2y$10$Rr0dlDclEewzq/A3CCGLtuq0zNGruqmKctiOVIkCRZtQuR2KtHyrq', NULL, 'Perez Zachary', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:00', '2023-08-15 04:44:00'),
(433, 5028, 'perez.ava@gmail.com', '$2y$10$MRW0ZYVCrWtikPYMwHcgpeQmmFMVoROJkw8cRhEWZoKfwiePiIcfq', NULL, 'Perez Ava', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:00', '2023-08-15 04:44:00'),
(434, 5003, 'perez.benjamin@gmail.com', '$2y$10$5Uk.aZTwyffK0YSIYpcwVeGHWQY0AwcnGBjekhIUHxamob2zKrl.y', NULL, 'Perez Benjamin', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:00', '2023-08-15 04:44:00'),
(435, 5021, 'perez.chloe@gmail.com', '$2y$10$Io3017VE0KDbs8BUB0qxY.8LWd8stz1P6HFb7pMqQS30TT2VBW7QC', NULL, 'Perez Chloe', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:01', '2023-08-15 04:44:01'),
(436, 1, 'perez.daniel@gmail.com', '$2y$10$iJzCcUHvs///4m71CFBi9ug/WBTCrlClEogAlp88qwiYtUB3i0W2a', NULL, 'Perez Daniel', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:01', '2023-08-15 04:44:01'),
(437, 5019, 'perez.emma@gmail.com', '$2y$10$H1X1dAW42ZYC0nmdfyEvTeZ8.YR2XvtBnh54cUBqD8vLDPE.ANtIW', NULL, 'Perez Emma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:01', '2023-08-15 04:44:01'),
(438, 5013, 'wilson.alice@gmail.com', '$2y$10$.ba0EzwDFUh7saI8P6G1j.Yn5uWI/SdkvfKMyud5xlAESNiBh.Fje', NULL, 'Wilson Alice', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:01', '2023-08-15 04:44:01'),
(439, 5018, 'wilson.bob@gmail.com', '$2y$10$2gLh1DkiJ6/4mI6vKiDT7OFqMn6UNMD0mL2s890of/lcYYkuzE62y', NULL, 'Wilson Bob', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:01', '2023-08-15 04:44:01'),
(440, 5017, 'wilson.charlie@gmail.com', '$2y$10$6poCMPhx2ja.DnHO/5PlweRH.7uh2pgOaK73qeC8bzuhaeN/FhwmW', NULL, 'Wilson Charlie', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:01', '2023-08-15 04:44:01'),
(441, 5030, 'wilson.david@gmail.com', '$2y$10$ZVCHyFeI3l8ZNVL4mIE/UeL7NDjxmRXL3hyMA/Ey9kQh5fW9ch.IG', NULL, 'Wilson David', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:01', '2023-08-15 04:44:01'),
(442, 4, 'wilson.emily@gmail.com', '$2y$10$dfOi/aQBr6ajxNEDUOZw..Hgctc5OxYQxxKX.nWOqk5vPnrf0Bokq', NULL, 'Wilson Emily', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:01', '2023-08-15 04:44:01'),
(443, 5024, 'wilson.frank@gmail.com', '$2y$10$yZ/nbWNMaOxJxiDUyRW3U.K20gctWQalg/Hjzf5g0UgTDsXyd0aXG', NULL, 'Wilson Frank', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:01', '2023-08-15 04:44:01'),
(444, 5012, 'wilson.grace@gmail.com', '$2y$10$gvZnS3EeQdpCDXWG7MYG2OVJQ79dGAo.NnuFO7yFgfhjskDZlOTLS', NULL, 'Wilson Grace', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:01', '2023-08-15 04:44:01'),
(445, 1, 'wilson.henry@gmail.com', '$2y$10$4hboN0elZHB8c7E5xy.iKuVaGjLJD3ISVGefYzpO11Y4T9.dfEeU.', NULL, 'Wilson Henry', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:01', '2023-08-15 04:44:01'),
(446, 5005, 'wilson.isabella@gmail.com', '$2y$10$pLa7H5iVRW4wDLJ6/XFTeesDCpd4gy91BPmJXXwGmGBuC5TPVkmlO', NULL, 'Wilson Isabella', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:01', '2023-08-15 04:44:01'),
(447, 5003, 'wilson.jack@gmail.com', '$2y$10$Ihe2Fj1t9fMQNetfzWjzke0x42Jivxa2QKVLM4OnCoqrVp/ATLEE2', NULL, 'Wilson Jack', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:01', '2023-08-15 04:44:01'),
(448, 5005, 'wilson.katherine@gmail.com', '$2y$10$sNxqYKEtBXk3IW63l4miROIR7q5XLLz4ob16oUKAjG5xN23WXEOvm', NULL, 'Wilson Katherine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:01', '2023-08-15 04:44:01'),
(449, 5025, 'wilson.liam@gmail.com', '$2y$10$5u8E5JiohummSVdv8PflueumFOHT4OuKmbmznknsrgnUf89jcTIrO', NULL, 'Wilson Liam', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:01', '2023-08-15 04:44:01'),
(450, 5028, 'wilson.mia@gmail.com', '$2y$10$.Tf3cGBZhq66VhszxROIx.8vpMgBQQFbg5CMY./FGXVm9aSvm.FdO', NULL, 'Wilson Mia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:01', '2023-08-15 04:44:01'),
(451, 5028, 'wilson.noah@gmail.com', '$2y$10$Fec4qCNrL8OhqooW2un22uV3J8ovPYUe9RfvNVAGpa.iJeszSubwu', NULL, 'Wilson Noah', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:01', '2023-08-15 04:44:01'),
(452, 5018, 'wilson.olivia@gmail.com', '$2y$10$q0zJGzbtCKeZ2XCfw5tHKeWnFupu7uY4Na8JVN2hFjwCb//SDfD2G', NULL, 'Wilson Olivia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:01', '2023-08-15 04:44:01'),
(453, 5011, 'wilson.penelope@gmail.com', '$2y$10$1.OKmx75L4wpi2D4o8vxneENrzq1bAfZdokbkMah2jmhWt7uXnM9u', NULL, 'Wilson Penelope', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:02', '2023-08-15 04:44:02'),
(454, 5019, 'wilson.quinn@gmail.com', '$2y$10$fd4hnSHsnT/hsNizvhE1ZeLlomsSNH.rc5tUywnHjWMxd9128s.Um', NULL, 'Wilson Quinn', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:02', '2023-08-15 04:44:02'),
(455, 5007, 'wilson.ryan@gmail.com', '$2y$10$QjXd5NN5byK43/0xsVEcc.GFbpUv3x9ERHRCCFFP1bY0ENfwHrbVK', NULL, 'Wilson Ryan', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:02', '2023-08-15 04:44:02'),
(456, 5018, 'wilson.sophia@gmail.com', '$2y$10$RnykOBFHpfclz5I0IxxVLeJiXEkvpei8OCaovWlNI5K7m.o6L1Z/u', NULL, 'Wilson Sophia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:02', '2023-08-15 04:44:02'),
(457, 5006, 'wilson.thomas@gmail.com', '$2y$10$.AYAp9rEo93ZU3mYREpxvOGy9.Mqz/Ob0bTaS9LticIK32SW5OT8q', NULL, 'Wilson Thomas', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:02', '2023-08-15 04:44:02'),
(458, 5031, 'wilson.uma@gmail.com', '$2y$10$QJ/2xfCftLUbcRyoLZHCKeEXnpYcPi3h68XnGkR3VbBiR7bSQiwZO', NULL, 'Wilson Uma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:02', '2023-08-15 04:44:02'),
(459, 5022, 'wilson.victoria@gmail.com', '$2y$10$wagGJvdJbJ37oF.XTu3.NOEQdyYHW.vjxaZ0Q13XZsePP3YS9FBXS', NULL, 'Wilson Victoria', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:02', '2023-08-15 04:44:02'),
(460, 2, 'wilson.william@gmail.com', '$2y$10$PDpI8Ccwciht0pl2671JH.Ws8dp7ew/npEneNa6dh2IALEopxfxBe', NULL, 'Wilson William', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:02', '2023-08-15 04:44:02'),
(461, 5023, 'wilson.xander@gmail.com', '$2y$10$pJeYiVN7aN79ymDDn9a8ruoN4179KjsMB64cYOSepwauWcBa.Tjma', NULL, 'Wilson Xander', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:02', '2023-08-15 04:44:02'),
(462, 5003, 'wilson.yasmine@gmail.com', '$2y$10$E.ys7ZjUVmZOk9AaHA9DsO8xbuZGRYGrqAMkyifillz8yZ5wXvpZ.', NULL, 'Wilson Yasmine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:02', '2023-08-15 04:44:02'),
(463, 5022, 'wilson.zachary@gmail.com', '$2y$10$pmEU1mPM3/7Ap6WX1ykkXuH5jvTEljZdWPnCGsvK0Qw72waDx7JPG', NULL, 'Wilson Zachary', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:02', '2023-08-15 04:44:02'),
(464, 5006, 'wilson.ava@gmail.com', '$2y$10$yEpv3vIaf3looK7v3v7SKeFHs2bVXYLMeznezPwLfh5M3Fh09j65q', NULL, 'Wilson Ava', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:02', '2023-08-15 04:44:02'),
(465, 5009, 'wilson.benjamin@gmail.com', '$2y$10$4FG9QRs1ct0gh.KuhmoL5OMWnzrqGRMbyYbxCu7bd2ou8X1E2WP26', NULL, 'Wilson Benjamin', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:02', '2023-08-15 04:44:02'),
(466, 1, 'wilson.chloe@gmail.com', '$2y$10$v5Uvg4VaZj3n1Zlv7qFZ2.b18YgJX1SA8/W5R6zgg0WGsz5l7M4EO', NULL, 'Wilson Chloe', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:02', '2023-08-15 04:44:02'),
(467, 5022, 'wilson.daniel@gmail.com', '$2y$10$POFFVNK0EFCPKNF7cuM06.XMf9mx.e0MR8BPyUHdn69m4jZ9IpXwm', NULL, 'Wilson Daniel', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:02', '2023-08-15 04:44:02'),
(468, 5020, 'wilson.emma@gmail.com', '$2y$10$tfd6ytgVEtes3eDciXZFTeGwhVBZAu6SEXqtnMm6fGRQ1HOtDLjCK', NULL, 'Wilson Emma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:02', '2023-08-15 04:44:02'),
(469, 5013, 'anderson.alice@gmail.com', '$2y$10$1l1NFim3oQ4qq1NE6mnXzOjHAKqoa3ZxXILGg21ZhKUJi/k/1W2Ci', NULL, 'Anderson Alice android', '323290', '', '', '', 1, NULL, '2023-11-10 19:57:33', '2023-08-15 04:44:02'),
(470, 5020, 'anderson.bob@gmail.com', '$2y$10$fOWBxN6TgmvWuEygkg70lu/THZP2HoGGxyi91cm30XkcBC5MoqU5C', NULL, 'Anderson Bob', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 17:05:31', '2023-08-15 04:44:02'),
(471, 5028, 'anderson.charlie@gmail.com', '$2y$10$5j7tFVwbBEXvQMI.6m9N7.5MwWYG0vzoWITiv7MHIk2XTsS8abywG', NULL, 'Anderson Charlie', '', NULL, NULL, NULL, 1, NULL, '2023-11-07 23:46:26', '2023-08-15 04:44:02'),
(472, 5021, 'anderson.david@gmail.com', '$2y$10$bCD/RHj7hZM8/8CMFvHooObWJ.Gs49Na2LaqbnOSdhvf7Zt7XZvAC', NULL, 'Anderson David', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:03', '2023-08-15 04:44:03'),
(473, 5003, 'anderson.emily@gmail.com', '$2y$10$c0jNtKnR2C0E/p/E6IlxIOysXFTe6uFPkO9rkZUY0GS0/DD3DE/U.', NULL, 'Anderson Emily', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:03', '2023-08-15 04:44:03'),
(474, 5010, 'anderson.frank@gmail.com', '$2y$10$6/gLcHD0m3b5St369FsTSecltscedgGReZ5WutlLbUu3GFjF4FoPy', NULL, 'Anderson Frank', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:03', '2023-08-15 04:44:03'),
(475, 5026, 'anderson.grace@gmail.com', '$2y$10$VrRmeM.DoFP.hYy0loQxle8E22/dGgSnr9WuUqgCX2Yhj0f8G8kUi', NULL, 'Anderson Grace', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:03', '2023-08-15 04:44:03'),
(476, 2, 'anderson.henry@gmail.com', '$2y$10$SzqzSEEiMWoM.i2PM9HRqObV5cWLf8mX2m7OIAYUtogqCqEDxYJ82', NULL, 'Anderson Henry', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:03', '2023-08-15 04:44:03'),
(477, 5019, 'anderson.isabella@gmail.com', '$2y$10$YagkMx6AKvQj9I0zo6/jVevjcrsb8C88Rtz3A4GG17Njmi39WxDza', NULL, 'Anderson Isabella', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:03', '2023-08-15 04:44:03'),
(478, 5013, 'anderson.jack@gmail.com', '$2y$10$A8LLxNxii7GdiygKG9/LtOnORHYKI6D.zg9COuD..gBBCHTLxpUty', NULL, 'Anderson Jack', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:03', '2023-08-15 04:44:03'),
(479, 5031, 'anderson.katherine@gmail.com', '$2y$10$ZELA/FoYFKImyg3qdoRmV.s5hlCXol0O8YICoHWiOtEsyFI8H8O6u', NULL, 'Anderson Katherine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:50:35', '2023-08-15 04:44:03'),
(480, 5021, 'anderson.liam@gmail.com', '$2y$10$te.M5DqwKaow9264T6xFmeDjGpbQ8kfvnQSOcrfz5O0aieq8f7Lbq', NULL, 'Anderson Liam', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:03', '2023-08-15 04:44:03'),
(481, 5003, 'anderson.mia@gmail.com', '$2y$10$JEjKpTczAag8aM2JgiGrtOfcltPTvxo6eptVTbS2/syRLcjjP9pPy', NULL, 'Anderson Mia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:03', '2023-08-15 04:44:03'),
(482, 5019, 'anderson.noah@gmail.com', '$2y$10$f1i3MsCOd/PNlSzg46PUDOamWG9YMbmeV3gqDcVKj4QzYmTZxhPli', NULL, 'Anderson Noah', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:03', '2023-08-15 04:44:03'),
(483, 5010, 'anderson.olivia@gmail.com', '$2y$10$A0uckTgUAAqpb2LP.tyqveznSL94RpbJ.rxl8svLeEYGoMCrzcTgO', NULL, 'Anderson Olivia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:03', '2023-08-15 04:44:03'),
(484, 5007, 'anderson.penelope@gmail.com', '$2y$10$gJoVN93ZSmkWSMvlc5W9c.SMp6ctajU3oTv8e/MF/hdoHN7aqE1iW', NULL, 'Anderson Penelope', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:03', '2023-08-15 04:44:03'),
(485, 5011, 'anderson.quinn@gmail.com', '$2y$10$hvMK9Dxhu2FdAmsSf0cJEOGX9CJbWMG33szNS3JHWhIVC3zYrswMK', NULL, 'Anderson Quinn', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:03', '2023-08-15 04:44:03'),
(486, 2, 'anderson.ryan@gmail.com', '$2y$10$BNSQRdy8zWws7A7r1V8t6e67wvcpfX1jXeBxPfJId1oxSCDtn3MD6', NULL, 'Anderson Ryan', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:03', '2023-08-15 04:44:03'),
(487, 5014, 'anderson.sophia@gmail.com', '$2y$10$F8rWx8.jYZmVabtaWsCtz.nVQ8zDhPpaxgC09FtiXCSnP9aQ4GRyC', NULL, 'Anderson Sophia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:03', '2023-08-15 04:44:03'),
(488, 5019, 'anderson.thomas@gmail.com', '$2y$10$OWUcSc0LuWvZkpeQT2DxcOnl6JuBQokhkbSE6GxqTyiwydZeQBR8q', NULL, 'Anderson Thomas', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:03', '2023-08-15 04:44:03'),
(489, 5007, 'anderson.uma@gmail.com', '$2y$10$7420/jfgUK9Xz/oPSBSPoe3YWsUn2MXSPk8hz/rAa2bQ9fYEjb/ta', NULL, 'Anderson Uma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:03', '2023-08-15 04:44:03'),
(490, 5028, 'anderson.victoria@gmail.com', '$2y$10$aeM2bNSC2TS7HroOv1UZKu40xN.NcJ69k94CxkyFvbwCyqiVThsEC', NULL, 'Anderson Victoria', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:03', '2023-08-15 04:44:03'),
(491, 5017, 'anderson.william@gmail.com', '$2y$10$br.jv8Djzf31OcBcHEalzeqQgP7ysubul/UB.gH0vv3xqVZkqwb1e', NULL, 'Anderson William', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:04', '2023-08-15 04:44:04'),
(492, 5003, 'anderson.xander@gmail.com', '$2y$10$dFm2HcczSQhIcQzBN/NlkOBkCCh5UKHokmBOlwtD7SBHSGcYiy.3O', NULL, 'Anderson Xander', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:04', '2023-08-15 04:44:04'),
(493, 5026, 'anderson.yasmine@gmail.com', '$2y$10$jMJkkuUojr66lBHJ1dUysO3pZIu.rbcXkEZA8zfVpTCcFMqE0f.ga', NULL, 'Anderson Yasmine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:04', '2023-08-15 04:44:04'),
(494, 5009, 'anderson.zachary@gmail.com', '$2y$10$rH1oxJXqoJhg3GwRtb2zxO2ouS.8t/DOdtsq6PGm81F94C5mMpas6', NULL, 'Anderson Zachary', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:04', '2023-08-15 04:44:04');
INSERT INTO `account` (`account_id`, `role_id`, `username`, `password`, `image`, `name`, `doc_number`, `tel`, `mobile`, `address`, `valid`, `last_logged_at`, `updated_at`, `registed_at`) VALUES
(495, 5024, 'anderson.ava@gmail.com', '$2y$10$LqNurjWnZYO8KyAdfuraXOcV0rx1lp72LY2oHPK79NCNQZY0sMaGq', NULL, 'Anderson Ava', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 16:13:09', '2023-08-15 04:44:04'),
(496, 1, 'anderson.benjamin@gmail.com', '$2y$10$HrK5zCkoQqspqmCrua/wAud//Z6hMQ1l3ctzXnx4jHq45iqBvWXYO', '473375836_20231109190402.png', 'Anderson tolera', '473375836', '284732', '309723957', 'pj. justo figuerola 159', 1, NULL, '2023-11-10 00:13:03', '2023-08-15 04:44:04'),
(497, 5027, 'anderson.chloe@gmail.com', '$2y$10$0R7YFKw2jjh7hBMvwZT4PulR28d3afFWglej.VzGhY9owrt5oXdQu', NULL, 'Anderson Chloe', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:04', '2023-08-15 04:44:04'),
(498, 5022, 'anderson.daniel@gmail.com', '$2y$10$1TkPdmwdU2i2iie//tsjPOtMwroCCA4po6WeZtHafqoXKgUs/G7xa', NULL, 'Anderson Daniel', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:04', '2023-08-15 04:44:04'),
(499, 5009, 'anderson.emma@gmail.com', '$2y$10$wkxekqNQeYQC6dG3NBkgOeAk2Aj8UCULsyDkz.G0PSYwOT/hSxMzS', NULL, 'Anderson Emma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:04', '2023-08-15 04:44:04'),
(500, 5027, 'thomas.alice@gmail.com', '$2y$10$wnyQdRKIrRcOsnX3q3nLZeB5mLiaeZ7iCznhJ5QDUiOUcb80WGmSW', NULL, 'Thomas Alice', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:04', '2023-08-15 04:44:04'),
(501, 5026, 'thomas.bob@gmail.com', '$2y$10$syLDXVjkAcS82JNVXFJ.j.L2wXAKtQThuRfLk0GTf9m4840doJL8i', NULL, 'Thomas Bob', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:04', '2023-08-15 04:44:04'),
(502, 5020, 'thomas.charlie@gmail.com', '$2y$10$WeptVC.zkZFgeiXMS6UYxe4nIkEFB8v9KtlXNPaBc6PSSKeEvJpXS', NULL, 'Thomas Charlie', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:04', '2023-08-15 04:44:04'),
(503, 5020, 'thomas.david@gmail.com', '$2y$10$XXyRISWBl6PFPNNPHhQSXu/17aUt1caorSAN8tuoy5qT72m79ela.', NULL, 'Thomas David', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:04', '2023-08-15 04:44:04'),
(504, 5023, 'thomas.emily@gmail.com', '$2y$10$J.gseKE8yoU9zpD.VK3mAeA3vW2YHGU0Ul1GSb5MH4KEnELJ0Ona.', NULL, 'Thomas Emily', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:04', '2023-08-15 04:44:04'),
(505, 5013, 'thomas.frank@gmail.com', '$2y$10$lG0jOxjSybOLWpkyX6VtceLgbPAQv.bQgFgff/V6ZifqZ6iBHLLqq', NULL, 'Thomas Frank', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:04', '2023-08-15 04:44:04'),
(506, 5013, 'thomas.grace@gmail.com', '$2y$10$noZeEeFE8sbEXeiAgDGvXupgv6RCZuq1AmVtLsJXL4K7mPL01OdCK', NULL, 'Thomas Grace', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:04', '2023-08-15 04:44:04'),
(507, 5028, 'thomas.henry@gmail.com', '$2y$10$cFm2PqnZV4qloETtVask/uWC4xT.WeXYUAn/DOiQS2EYvXwHe1l3i', NULL, 'Thomas Henry', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:04', '2023-08-15 04:44:04'),
(508, 5007, 'thomas.isabella@gmail.com', '$2y$10$83l33W08fCtLHkWyfeV34eAFkLbm/rn8mNUAgTUiREdiPogXjWjCq', NULL, 'Thomas Isabella', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:04', '2023-08-15 04:44:04'),
(509, 5026, 'thomas.jack@gmail.com', '$2y$10$mpVKsAuCAna1f/iBdN4spuCXrL8EzbzKYqNpIcSAkpma4L2r8/l5W', NULL, 'Thomas Jack', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:05', '2023-08-15 04:44:05'),
(510, 5007, 'thomas.katherine@gmail.com', '$2y$10$2UmxhIE9RoKjvOiZyIZ77e9.nxiI0LYV1jUyr.WhJgCizZ3vPVIOW', NULL, 'Thomas Katherine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:05', '2023-08-15 04:44:05'),
(511, 5011, 'thomas.liam@gmail.com', '$2y$10$BBPWRnvumRuAt0nwSO83kObRIT9vK8OHAXFRZz85xmW5QKjFEbUo6', NULL, 'Thomas Liam', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:05', '2023-08-15 04:44:05'),
(512, 5018, 'thomas.mia@gmail.com', '$2y$10$n/HIGbOqxfu3wzgwIRWxx.2o9wqEgx5JDcIDu.XfXP9dFOInuttay', NULL, 'Thomas Mia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:05', '2023-08-15 04:44:05'),
(513, 5031, 'thomas.noah@gmail.com', '$2y$10$2OUXcHsLvsGFjVrYbfpX3.UHE2Czf2b8fv1yTcwazear0Q27/rOD2', NULL, 'Thomas Noah', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:05', '2023-08-15 04:44:05'),
(514, 5026, 'thomas.olivia@gmail.com', '$2y$10$bZ4PijEqMfIYOJE1aeBDRuUn7xtjv.owI/qowmFA1WNFb2JICZnCi', NULL, 'Thomas Olivia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:05', '2023-08-15 04:44:05'),
(515, 5016, 'thomas.penelope@gmail.com', '$2y$10$uxtWwyqaVkZv5xDHMc7kMu1JTNKbm7S7QGSmPuq8WvC./brEvlclC', NULL, 'Thomas Penelope', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:05', '2023-08-15 04:44:05'),
(516, 5025, 'thomas.quinn@gmail.com', '$2y$10$/RQNG8ienV5Qw0UkVFR1MORYoZ88ZrQ9VcP4aDVkwOIY.dcuH2EiC', NULL, 'Thomas Quinn', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:05', '2023-08-15 04:44:05'),
(517, 5007, 'thomas.ryan@gmail.com', '$2y$10$T7xkDhrQS1695451g78ARe4TXMD3j.gpTY3c2ZiqlZtW63aZQh5jq', NULL, 'Thomas Ryan', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:05', '2023-08-15 04:44:05'),
(518, 4, 'thomas.sophia@gmail.com', '$2y$10$.j4ard5aNsMUnqCFcEwzbubrhwvj5oGe.Xkxgd4X.oni5SJ0ArH0O', NULL, 'Thomas Sophia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:05', '2023-08-15 04:44:05'),
(519, 5009, 'thomas.thomas@gmail.com', '$2y$10$zo9bu451dJC/0wV3jwz0H.66QMQzS9Qiss3vJa0VwMt4PBrf7Vxti', NULL, 'Thomas Thomas', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:05', '2023-08-15 04:44:05'),
(520, 5027, 'thomas.uma@gmail.com', '$2y$10$ec0j3QMnOiJdKN3P2tiOI.zUdNL9xum.9yxzBIalQYizeBPYGBKT2', NULL, 'Thomas Uma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:05', '2023-08-15 04:44:05'),
(521, 5003, 'thomas.victoria@gmail.com', '$2y$10$aPHfvJz/YkQ68SeFbC05x.F4iL9/UJ9ojMWLPLxcehLi6H.t77ObC', NULL, 'Thomas Victoria', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:05', '2023-08-15 04:44:05'),
(522, 2, 'thomas.william@gmail.com', '$2y$10$OBxpXxgqYgp0HVNWyMiPduutvWFwtzLqdIL7.szh4F8WzFImSzXNq', NULL, 'Thomas William', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:05', '2023-08-15 04:44:05'),
(523, 5023, 'thomas.xander@gmail.com', '$2y$10$iPcbVVcVQb/IDEd4sJzAnuw3kEfDtq.OJ9DCgAbDFRlPaLpsKu1be', NULL, 'Thomas Xander', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:05', '2023-08-15 04:44:05'),
(524, 5023, 'thomas.yasmine@gmail.com', '$2y$10$z6X4Iw0SaPEViJbNhasNTuVmI3/0TXIj9BpO/IJJ.nri4H.//ZyU6', NULL, 'Thomas Yasmine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:05', '2023-08-15 04:44:05'),
(525, 5030, 'thomas.zachary@gmail.com', '$2y$10$sWwy7yJk1Z45kLOKsd3VFeKVDef4UJsbHVBv.vJh9uzttiRrK/Lqy', NULL, 'Thomas Zachary', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:05', '2023-08-15 04:44:05'),
(526, 5005, 'thomas.ava@gmail.com', '$2y$10$TIyyiIIw3Ih1EnwIP0NMBu8EYHEYMBvUgaU6kiQf5Gd0KZku43TIO', NULL, 'Thomas Ava', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:05', '2023-08-15 04:44:05'),
(527, 5031, 'thomas.benjamin@gmail.com', '$2y$10$MIGT2DEF47CCOEOQ00yP8.zIie8y53AI4foyCz3KPmUzdjAFsnO/a', NULL, 'Thomas Benjamin', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:05', '2023-08-15 04:44:05'),
(528, 5025, 'thomas.chloe@gmail.com', '$2y$10$ovBJoaAIhVtdtftG4OFv6ONPemNUaPItDv2IEhoko/VVgV7e430Ya', NULL, 'Thomas Chloe', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:06', '2023-08-15 04:44:06'),
(529, 5014, 'thomas.daniel@gmail.com', '$2y$10$kRRRpbVvKaJD/LA2ciIGceMB35SfhU72T7wUkxobRWWYXJD/Htpqa', NULL, 'Thomas Daniel', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:06', '2023-08-15 04:44:06'),
(530, 5014, 'thomas.emma@gmail.com', '$2y$10$8Edm.XMQ5OVNPU/bAU2S0u.EXzE/WuHd7vFIo7sdlpviIjIVv1VIW', NULL, 'Thomas Emma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:06', '2023-08-15 04:44:06'),
(531, 5012, 'lee.alice@gmail.com', '$2y$10$KhRomoJRZngf.3WKTJdwN.6HmMmZb0NZzAD8eavCE4EVtZGD8yBDW', NULL, 'Lee Alice', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:06', '2023-08-15 04:44:06'),
(532, 5019, 'lee.bob@gmail.com', '$2y$10$46xYgfmcbZQ35Gbw7mGqn.9rZ75foj/P2JS02.BBELl45Q7WuNnvm', NULL, 'Lee Bob', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:06', '2023-08-15 04:44:06'),
(533, 5031, 'lee.charlie@gmail.com', '$2y$10$6gB1lUX3xTMw5hiqnFdDUefmRj7RFLBLWuChGqNwg9ZmqnViLnjqu', NULL, 'Lee Charlie', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:06', '2023-08-15 04:44:06'),
(534, 5026, 'lee.david@gmail.com', '$2y$10$p.vmYELNgdscpcQ9AcHMVeFxAhf2NWU25Ix6rkyzngXqe.pBxq7nW', NULL, 'Lee David', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:06', '2023-08-15 04:44:06'),
(535, 5013, 'lee.emily@gmail.com', '$2y$10$rnHJTSHz.ZrLB.GzjcMPNO4RmHxIh/r1pMwrq3wylJnojgVCscPvm', NULL, 'Lee Emily', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:06', '2023-08-15 04:44:06'),
(536, 5013, 'lee.frank@gmail.com', '$2y$10$8zRJjp4CnUonYhTDFEsfcO9VOWKFJictRx.J.eIlBUasAEORAiVe.', NULL, 'Lee Frank', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:06', '2023-08-15 04:44:06'),
(537, 5016, 'lee.grace@gmail.com', '$2y$10$M8m82hzEYyrnehWaKKvX6.wNhppBArtueLNPNAIiGLFny5ObtUMHq', NULL, 'Lee Grace', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:06', '2023-08-15 04:44:06'),
(538, 5012, 'lee.henry@gmail.com', '$2y$10$nYnd8.dL8fCbPP68Zq14DedNndvMmW65DnBCF.RGsFFYVwWAd94Lm', NULL, 'Lee Henry', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:06', '2023-08-15 04:44:06'),
(539, 5009, 'lee.isabella@gmail.com', '$2y$10$iQfFLlQLiWVpxs9pjoqH4.i2I/AlF9O1c.nsRl5ueSI/JwLYnx7Fm', NULL, 'Lee Isabella', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:06', '2023-08-15 04:44:06'),
(540, 5024, 'lee.jack@gmail.com', '$2y$10$r1X17qecUDxwSIpFidczSeD/QXth/LNqsMYZ5wOg7rHiPl0Sd/dt6', NULL, 'Lee Jack', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:06', '2023-08-15 04:44:06'),
(541, 5023, 'lee.katherine@gmail.com', '$2y$10$79aBhzzjQWhuoRrHzecNFOD3TOLQYQy8nW96BnH5U76GiBxR.pghO', NULL, 'Lee Katherine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:06', '2023-08-15 04:44:06'),
(542, 5017, 'lee.liam@gmail.com', '$2y$10$dkTJIeIutM8ypf1WZafyd.UVlspTGimA9wtQP.Wy6d7pu.ZWOOGbu', NULL, 'Lee Liam', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:06', '2023-08-15 04:44:06'),
(543, 5009, 'lee.mia@gmail.com', '$2y$10$KGrTff54GqFZiSZgn7gbGu.dKJwYLarpN9UtOTptJooe5E3mfgISC', NULL, 'Lee Mia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:06', '2023-08-15 04:44:06'),
(544, 5020, 'lee.noah@gmail.com', '$2y$10$gidt3nhkewo0vaM0NLv20OHAckoOGW6Gw35XpSIeu0r6sXbieFr8m', NULL, 'Lee Noah', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:06', '2023-08-15 04:44:06'),
(545, 5003, 'lee.olivia@gmail.com', '$2y$10$O7hJ9VY8wspYXNqsZrjnH.QaCpBGGPnprZ4aFIdcF2CDaDiTVFpMG', NULL, 'Lee Olivia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:06', '2023-08-15 04:44:06'),
(546, 5014, 'lee.penelope@gmail.com', '$2y$10$LfFhRqXt9gAFmQEt.EbpBuEl99/nNk4xkyhkxmhf6Bc1oDDr1nINu', NULL, 'Lee Penelope', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:06', '2023-08-15 04:44:06'),
(547, 2, 'lee.quinn@gmail.com', '$2y$10$.5bABpNJcQW7yEizbgqjSutjYUJUm7cwzepaXOhH0Sr4HI9HXawe.', NULL, 'Lee Quinn', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:07', '2023-08-15 04:44:07'),
(548, 5026, 'lee.ryan@gmail.com', '$2y$10$zKfpC0DCBtgUnXydqGqRNOES5.lQjor.onuBwhnjRqdo0wHFLIEUu', NULL, 'Lee Ryan', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:07', '2023-08-15 04:44:07'),
(549, 5017, 'lee.sophia@gmail.com', '$2y$10$AYxvdChCrSzXetpvibm9AuJ2M1PxuVLPxFcPuYgzPi6dbE0YoDPnG', NULL, 'Lee Sophia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:07', '2023-08-15 04:44:07'),
(550, 1, 'lee.thomas@gmail.com', '$2y$10$DgJvGgIszXJ1MsoV0Aw5YOXoJc6FNcRtOaElhMfftCh3PSyb9gI9m', NULL, 'Lee Thomas', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:07', '2023-08-15 04:44:07'),
(551, 1, 'lee.uma@gmail.com', '$2y$10$Ogt7W5xZRRLIQNC9.lNKoueyrvv3uhGSUEnvoOWV5EgfwijHe/Wii', NULL, 'Lee Uma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:07', '2023-08-15 04:44:07'),
(552, 5023, 'lee.victoria@gmail.com', '$2y$10$8o7Y8GZySffIqMb8wIJwE.pJFAIWueHXhO0Y6nWzfm0yW6.QT2CM2', NULL, 'Lee Victoria', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:07', '2023-08-15 04:44:07'),
(553, 5016, 'lee.william@gmail.com', '$2y$10$nmWgq1SYDzjlsjKeBzPp5et5vHOyjbzprHER3ed/xqp1l05PC.TO6', NULL, 'Lee William', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:07', '2023-08-15 04:44:07'),
(554, 5015, 'lee.xander@gmail.com', '$2y$10$QrAgfH3U98dsfTTPqCPOvOmPcOQgrfVMdzn39pcnqDxAimBc1Vzcm', NULL, 'Lee Xander', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:07', '2023-08-15 04:44:07'),
(555, 5010, 'lee.yasmine@gmail.com', '$2y$10$xzfFJm8jtEZ3Yf1MBaVvvuXkI4qx0h1nhLKyTEeHloOGkEOw64Wl6', NULL, 'Lee Yasmine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:07', '2023-08-15 04:44:07'),
(556, 5030, 'lee.zachary@gmail.com', '$2y$10$OXBOOa7y5KwAfU8kJKvWAOHFnn/UYVfWCOZwVvbykOIx6MvbDhDPS', NULL, 'Lee Zachary', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:07', '2023-08-15 04:44:07'),
(557, 5030, 'lee.ava@gmail.com', '$2y$10$pJRbBEO/9KNfALgrjCG0sOY1.tq6sLtNTvPGe22.lUqvETc/Jnj5C', NULL, 'Lee Ava', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:07', '2023-08-15 04:44:07'),
(558, 5005, 'lee.benjamin@gmail.com', '$2y$10$Pla/x.UzFH6z3cIH2JtgPOo3GHbJI47sRor8IuuNop4lTtxJJ2jbK', NULL, 'Lee Benjamin', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:07', '2023-08-15 04:44:07'),
(559, 5014, 'lee.chloe@gmail.com', '$2y$10$wtxDMrBSrsMxrDhufjuAP.U6tOHKYHlymg0xhdIb7s1BUVNr/vCti', NULL, 'Lee Chloe', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:07', '2023-08-15 04:44:07'),
(560, 5030, 'lee.daniel@gmail.com', '$2y$10$/ddFxWbyBhkwHpJzoqFfv.djtBrVoppoancLMIfyAjjlndNw30y4m', NULL, 'Lee Daniel', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:07', '2023-08-15 04:44:07'),
(561, 5006, 'lee.emma@gmail.com', '$2y$10$7Mmt3eblUfP.qRZi9sBUw.ttgIq7L54UQlu96CqoT3JqLNP7STANC', NULL, 'Lee Emma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:07', '2023-08-15 04:44:07'),
(562, 5007, 'moore.alice@gmail.com', '$2y$10$1IzqJwbF69POznX4NwhSU.tOFn7zIYGUfSavmojtbYWt8P7HfaAcy', NULL, 'Moore Alice', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:07', '2023-08-15 04:44:07'),
(563, 5017, 'moore.bob@gmail.com', '$2y$10$FLIQcgF7lYkCrlxynzs8MO8vkew.LBGj4ycK7VGpYLnWbfNq.EHUi', NULL, 'Moore Bob', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:07', '2023-08-15 04:44:07'),
(564, 5019, 'moore.charlie@gmail.com', '$2y$10$SjZisW1ENYdlgRzV9xXeH.6FZtM6ejWt59a64nP80mKy6x5ffDyR2', NULL, 'Moore Charlie', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:07', '2023-08-15 04:44:07'),
(565, 5022, 'moore.david@gmail.com', '$2y$10$2vp8M4ptrUxqeYQpx2dy4.KxuR9qAx3dFZz.5b/w53xVEMOS3dwV2', NULL, 'Moore David', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:07', '2023-08-15 04:44:07'),
(566, 5031, 'moore.emily@gmail.com', '$2y$10$zWemWK9kqnvTXlLWU7evXuxriD5uscG5oE8HCLHFlH3ElyjzNZZGy', NULL, 'Moore Emily', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:08', '2023-08-15 04:44:08'),
(567, 5018, 'moore.frank@gmail.com', '$2y$10$GQJtiXVxd1JD2iEtGl1StekMDuGclT/GCcd9CgvITWoZ.5PPyhRfq', NULL, 'Moore Frank', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:08', '2023-08-15 04:44:08'),
(568, 5017, 'moore.grace@gmail.com', '$2y$10$yYaiXBsvG/CLoMy0/no9jOPi1QUCw7cB5QDD/VtliT2taUTpJzGtO', NULL, 'Moore Grace', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:08', '2023-08-15 04:44:08'),
(569, 5015, 'moore.henry@gmail.com', '$2y$10$HT6uL82KI9gTM7TTlaP.ru8DIiWxJNigvkm0ge8JxKClXsvFplIVu', NULL, 'Moore Henry', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:08', '2023-08-15 04:44:08'),
(570, 5007, 'moore.isabella@gmail.com', '$2y$10$AB6rGxBy737uzCFUTqGId.ZlpkSmK4cIxodGEluuQoI64Ok7sCwrS', NULL, 'Moore Isabella', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:08', '2023-08-15 04:44:08'),
(571, 5023, 'moore.jack@gmail.com', '$2y$10$.YZQGJEDQcUejnmIc.wRQ.JqmFfDm/PY195dSbNXv8AAsXwEIC1pi', NULL, 'Moore Jack', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:08', '2023-08-15 04:44:08'),
(572, 5025, 'moore.katherine@gmail.com', '$2y$10$loY1eft3nuTSvwXOnrsGleC9HgDJu43Ue107Dh0cwiobqhwXIL8lq', NULL, 'Moore Katherine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:08', '2023-08-15 04:44:08'),
(573, 5016, 'moore.liam@gmail.com', '$2y$10$8Kn2gKE2USWmn8xFMKkl.uYWkLSwBK0BZl0/I7OjoHC7VDnlxSH6S', NULL, 'Moore Liam', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:08', '2023-08-15 04:44:08'),
(574, 5013, 'moore.mia@gmail.com', '$2y$10$uPv.MqATH91.XdQliS652.LcJpnXiokeNPEZx1SohqLod7ijr5kG.', NULL, 'Moore Mia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:08', '2023-08-15 04:44:08'),
(575, 5025, 'moore.noah@gmail.com', '$2y$10$Cg3uYw9W396kTHqp96sNlea1Brb.KH1.0LE49M8gXK7UGSPcNanTe', NULL, 'Moore Noah', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:08', '2023-08-15 04:44:08'),
(576, 5022, 'moore.olivia@gmail.com', '$2y$10$XdEMtqTI6H7fOY5PBw4mh.iK4S3CoaZ2v4yD9Jstf97wRqkAWCWhm', NULL, 'Moore Olivia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:08', '2023-08-15 04:44:08'),
(577, 5028, 'moore.penelope@gmail.com', '$2y$10$TQxVjaCFoJ1j0jJ9wXGhrOFbXGNJ4AdKgwE21rF1imfviejRVaA/2', NULL, 'Moore Penelope', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:08', '2023-08-15 04:44:08'),
(578, 5011, 'moore.quinn@gmail.com', '$2y$10$AtJqBXzzRf5y/VVWQyLX5e/r/LycWw.on./bQBx7fCcLlvnQxgJ3C', NULL, 'Moore Quinn', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:08', '2023-08-15 04:44:08'),
(579, 5019, 'moore.ryan@gmail.com', '$2y$10$Q9BSbPQ2mjkq9cXlZsR3Cum43YRxdmPT7WL8bUzKgVHqb6ZCwbBze', NULL, 'Moore Ryan', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:08', '2023-08-15 04:44:08'),
(580, 5003, 'moore.sophia@gmail.com', '$2y$10$QQMl3XTHusXIf0xTaFro7.3.LhpYHCVTYbwDbF.TGnZbusTJx8Glq', NULL, 'Moore Sophia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:08', '2023-08-15 04:44:08'),
(581, 5025, 'moore.thomas@gmail.com', '$2y$10$1XO2zPcR1.QRZ0WFFdCABes2fsfw8Vxh93A.pH2/apmP4D6QFIB7m', NULL, 'Moore Thomas', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:08', '2023-08-15 04:44:08'),
(582, 5025, 'moore.uma@gmail.com', '$2y$10$5MPucLxgEYnkZBxrbRAMxOSOLDHTyWq897mKDP210vHGsldOWwZBK', NULL, 'Moore Uma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:08', '2023-08-15 04:44:08'),
(583, 5011, 'moore.victoria@gmail.com', '$2y$10$35lDkVFg2CRqdhYNYCWy7eLL9Aiwqq1yUy6Fs/kZw5/h3Hdd.CNIK', NULL, 'Moore Victoria', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:08', '2023-08-15 04:44:08'),
(584, 5009, 'moore.william@gmail.com', '$2y$10$rNO9.wMSYhtxhWGI8jZ6cubO/skzB8GL8NMEFTE357o8hL6p08v3y', NULL, 'Moore William', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:09', '2023-08-15 04:44:09'),
(585, 5022, 'moore.xander@gmail.com', '$2y$10$TvpyoeJp4g/XZwE/0kqBludKC8TOhbl0kQwNHoXuKophMdBqT2mby', NULL, 'Moore Xander', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:09', '2023-08-15 04:44:09'),
(586, 5022, 'moore.yasmine@gmail.com', '$2y$10$zUeFuwomq8pRLeXoq4h3aOBVW62x37eLAv9FyZ3cxZuBjr2HeLwRe', NULL, 'Moore Yasmine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:09', '2023-08-15 04:44:09'),
(587, 4, 'moore.zachary@gmail.com', '$2y$10$1Fc45WkMg4aSdjVcVSByiOKlEzuxzzR1sITU6t/ZDe5dsz4zb2dEW', NULL, 'Moore Zachary', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:09', '2023-08-15 04:44:09'),
(588, 4, 'moore.ava@gmail.com', '$2y$10$Fc.Y5LIEbfJk1Wu.b8rvheq65s62UNFMrWltJvjSAyrSYAOxXD7nm', NULL, 'Moore Ava', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:09', '2023-08-15 04:44:09'),
(589, 5030, 'moore.benjamin@gmail.com', '$2y$10$WEAxry3m8JwF18s64QFC4OQG0j7tlKDkA7RQrEpA779vLnN6fQdBa', NULL, 'Moore Benjamin', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:09', '2023-08-15 04:44:09'),
(590, 5011, 'moore.chloe@gmail.com', '$2y$10$1u05PquidkJGfmgtMR.1g.CmiVwBaDHC2Gix2K8nCewV8uSFkqtZq', NULL, 'Moore Chloe', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:09', '2023-08-15 04:44:09'),
(591, 5011, 'moore.daniel@gmail.com', '$2y$10$AyryYFh6NP2oKkk/.D7aSu10XQt74Gqw5LrvqAJHx9TXnkAAPfLcu', NULL, 'Moore Daniel', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:09', '2023-08-15 04:44:09'),
(592, 5009, 'moore.emma@gmail.com', '$2y$10$JwordwffaQ7uWxiMxDdtIeLvChuZXaVJf2WA36f6OxaGdP3IsdAHO', NULL, 'Moore Emma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:09', '2023-08-15 04:44:09'),
(593, 5017, 'jackson.alice@gmail.com', '$2y$10$uIkRFJlQPRPiu4q.fft11./2Zb6EL3J.qsapKpFCZqkf8xFCZASa6', NULL, 'Jackson Alice', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:09', '2023-08-15 04:44:09'),
(594, 5010, 'jackson.bob@gmail.com', '$2y$10$buDygFgtqWMwwOLOzqcxbeZs0ogwDPIBVDkIHD9H5JZSPSizru.3G', NULL, 'Jackson Bob', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:09', '2023-08-15 04:44:09'),
(595, 5031, 'jackson.charlie@gmail.com', '$2y$10$q8GJRTIJIZ2yTGGmbJO/h.i2M5Lsv165UrZatMZVGQGGmj4b3q5hK', NULL, 'Jackson Charlie', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:09', '2023-08-15 04:44:09'),
(596, 5019, 'jackson.david@gmail.com', '$2y$10$55uASWIhkmUyRJPZie43CO.I4Bdd6rdcsoMom.GY6lASuRN0aXaGq', NULL, 'Jackson David', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:09', '2023-08-15 04:44:09'),
(597, 5010, 'jackson.emily@gmail.com', '$2y$10$5leeZfwCSGG.tyjTo7gG0eU/lUA1ong.6iAg5zGmYhJtnLYCbrmI.', NULL, 'Jackson Emily', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:09', '2023-08-15 04:44:09'),
(598, 5020, 'jackson.frank@gmail.com', '$2y$10$t22Q.7e6.5r7ugSAJFnocehQl1U6f2qtCShZcD.rvp7CQNeeaSMTy', NULL, 'Jackson Frank', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:09', '2023-08-15 04:44:09'),
(599, 5015, 'jackson.grace@gmail.com', '$2y$10$NQTjtEdY49AMR3lfRUD4Se74dqvfI09MYYghGyX4Wuqpbg6Lgt.9e', NULL, 'Jackson Grace', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:09', '2023-08-15 04:44:09'),
(600, 5023, 'jackson.henry@gmail.com', '$2y$10$0UaufqB4FHWGKfSZ5A4lVuv.p8uBaEzD8KKxJKFi/ddkuDy.u2Iae', NULL, 'Jackson Henry', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:09', '2023-08-15 04:44:09'),
(601, 5010, 'jackson.isabella@gmail.com', '$2y$10$0h9p1SXbiEExayQcaEa5ludASfUvGIBUbsdUSf0n2y0WrjL/jBkiG', NULL, 'Jackson Isabella', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:09', '2023-08-15 04:44:09'),
(602, 5027, 'jackson.jack@gmail.com', '$2y$10$4jatBBfVbfbnwWlUFomtcepttwdQf0GUrYOIZBHpZONSFRvXxi.ei', NULL, 'Jackson Jack', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:09', '2023-08-15 04:44:09'),
(603, 5026, 'jackson.katherine@gmail.com', '$2y$10$DPokFLzzU.uNZhFWEnfljOxg3Pp2oireOoKtNHeKeko8nc7oz8nUu', NULL, 'Jackson Katherine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:10', '2023-08-15 04:44:10'),
(604, 5028, 'jackson.liam@gmail.com', '$2y$10$nBMf1vD7bOxmc7Tsn9yzzOZdTPqA0q0Ey1zL0f79oSxQIEB6KBSXu', NULL, 'Jackson Liam', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:10', '2023-08-15 04:44:10'),
(605, 5024, 'jackson.mia@gmail.com', '$2y$10$v0HbmF3/3gA5Or.arSdQqu2SKWvNsvWppd6gx0EqUa5jxvDz6HuEq', NULL, 'Jackson Mia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:10', '2023-08-15 04:44:10'),
(606, 5019, 'jackson.noah@gmail.com', '$2y$10$iKunhhBt34MPIcV7UTP62u1/K3Y2mrtbaEYmYjbNYjz6k9U5HnFAa', NULL, 'Jackson Noah', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:10', '2023-08-15 04:44:10'),
(607, 5003, 'jackson.olivia@gmail.com', '$2y$10$eILTVEQ27AxAe0zUEbIn..dPPMKcMPKGxnkIkpusLATQZp4o9ejBK', NULL, 'Jackson Olivia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:10', '2023-08-15 04:44:10'),
(608, 5010, 'jackson.penelope@gmail.com', '$2y$10$rcRUuIs0UILRJ3SZ.0KvseWbBEwUMezcD/cY4MDMdA6nh711A2o72', NULL, 'Jackson Penelope', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:10', '2023-08-15 04:44:10'),
(609, 5011, 'jackson.quinn@gmail.com', '$2y$10$3G3QoO5ySWqXDWmdDlatguWO4L4vY3QxotBTydThviK22.CwHIh5O', NULL, 'Jackson Quinn', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:10', '2023-08-15 04:44:10'),
(610, 5012, 'jackson.ryan@gmail.com', '$2y$10$zAj.eXeH4rtvneb3caGp3uXYNlJR9AGRhxB/5UwMQnqL8cGgmlGHS', NULL, 'Jackson Ryan', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:10', '2023-08-15 04:44:10'),
(611, 5017, 'jackson.sophia@gmail.com', '$2y$10$Rwe2eVyCkMxAs.ixzDHAce28BE9UAA0ajBj56nscRSXo.ukgHB8RS', NULL, 'Jackson Sophia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:10', '2023-08-15 04:44:10'),
(612, 5018, 'jackson.thomas@gmail.com', '$2y$10$zWMov7HciAp.v4ymq6kdYOozQ8XHgxfK84p7L7U6MUVu39nQwjMiq', NULL, 'Jackson Thomas', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:10', '2023-08-15 04:44:10'),
(613, 5022, 'jackson.uma@gmail.com', '$2y$10$LLlOLm0lmDM17RuZUDSGaekrFWhFFdw8ue1Aa5NRpqvqq7eKm1utW', NULL, 'Jackson Uma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:10', '2023-08-15 04:44:10'),
(614, 5028, 'jackson.victoria@gmail.com', '$2y$10$EaTYuUaZXi1Csld39.dagOQc2XNIIexsJBCCJcloiD6n0uq9dgwf2', NULL, 'Jackson Victoria', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:10', '2023-08-15 04:44:10'),
(615, 5011, 'jackson.william@gmail.com', '$2y$10$rRoXVm07DT1mIUypGl3WFORuvT8oY//Rh1FCN80kqD6VgvdCne6s6', NULL, 'Jackson William', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:10', '2023-08-15 04:44:10'),
(616, 5010, 'jackson.xander@gmail.com', '$2y$10$ZIOXPKnKo.af6rf/L5am7expJ7nBKkWoG./TLqXIDzN.vyuL2mSHS', NULL, 'Jackson Xander', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:10', '2023-08-15 04:44:10'),
(617, 5013, 'jackson.yasmine@gmail.com', '$2y$10$EjuJex.W2EVmBa2DLx.ZvOVuG1oB5j2vwtkOTYfVcp9hARhySiuhK', NULL, 'Jackson Yasmine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:10', '2023-08-15 04:44:10'),
(618, 5031, 'jackson.zachary@gmail.com', '$2y$10$BK72is8E18tqkXZsB2eHsef6PydO9GWW2DL6Lxu2m/wLTiZP04WhG', NULL, 'Jackson Zachary', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:10', '2023-08-15 04:44:10'),
(619, 5022, 'jackson.ava@gmail.com', '$2y$10$WgSa1qUqMvV8MtC6Hy0TGeDuWv5ArUNoa80nDt6udY3Oh4lAWlt4S', NULL, 'Jackson Ava', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:10', '2023-08-15 04:44:10'),
(620, 5027, 'jackson.benjamin@gmail.com', '$2y$10$HaG3enO4zu46BtlxOwTDIOBFOhXIH1xT3LwTxsN.6xO2bwSx0sJo.', NULL, 'Jackson Benjamin', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:10', '2023-08-15 04:44:10'),
(621, 1, 'jackson.chloe@gmail.com', '$2y$10$JSCVfFLspxj7vxFqUrkGy.cA2py0niKPXf2EUDyi87zGIfqJONvkG', NULL, 'Jackson Chloe', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:10', '2023-08-15 04:44:10'),
(622, 5012, 'jackson.daniel@gmail.com', '$2y$10$rwYdqvFoKENXihKH2o0aG.IHEc.z86fb8pP34l9ABWIcKxruOdqJu', NULL, 'Jackson Daniel', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:11', '2023-08-15 04:44:11'),
(623, 5017, 'jackson.emma@gmail.com', '$2y$10$byAboQOnAiVTsiDktWPow.LsrINER74JWe9JAGSRpcv5c1EbKJhoy', NULL, 'Jackson Emma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:11', '2023-08-15 04:44:11'),
(624, 5016, 'white.alice@gmail.com', '$2y$10$j1mFbOpREqCPocVQvlfsu.SFFgBP0m.Uhi8kh3XoLAhri4W7.qHPm', NULL, 'White Alice', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:11', '2023-08-15 04:44:11'),
(625, 5021, 'white.bob@gmail.com', '$2y$10$mJoXa/hsS2jrtrSQZHDcBubqn/zPK9jUGsDjX.E12OqskQQkVO6pa', NULL, 'White Bob', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:11', '2023-08-15 04:44:11'),
(626, 5026, 'white.charlie@gmail.com', '$2y$10$s82Kbjq7kIhDtD4pew5j8OEU1Sq0/4qwCxlBiTzUcAqMo4xDqR4j.', NULL, 'White Charlie', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:11', '2023-08-15 04:44:11'),
(627, 5031, 'white.david@gmail.com', '$2y$10$ZZDuOo5nbVrcGJvkPBCn0OAJ0RhPPL.zlrAGpH.TrKINDhM6sd0Yy', NULL, 'White David', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:11', '2023-08-15 04:44:11'),
(628, 5020, 'white.emily@gmail.com', '$2y$10$lY8rLKRUfP80A2uWmR.cleJkwWm1gMXELQf2dhSN0igfAMD2Bnq1G', NULL, 'White Emily', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:11', '2023-08-15 04:44:11'),
(629, 5030, 'white.frank@gmail.com', '$2y$10$jMlGefCrO3f0ivbDMBiTV.GHx37HJ5CQdqbRqWIiMJ6KFqY85hiP6', NULL, 'White Frank', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:11', '2023-08-15 04:44:11'),
(630, 5027, 'white.grace@gmail.com', '$2y$10$6WTtKZReH4d27jzKIVVRH.uI.RtGQUfDe7QOfevDZF.vImbVnVoym', NULL, 'White Grace', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:11', '2023-08-15 04:44:11'),
(631, 5007, 'white.henry@gmail.com', '$2y$10$gViPf7Wer/LM1vIt8fQOI.h0Thwr9Adjo69KgZklMVWPZjeHaV98W', NULL, 'White Henry', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:11', '2023-08-15 04:44:11'),
(632, 5009, 'white.isabella@gmail.com', '$2y$10$CEYfOciA4l/RvYjYN0sKD.NKJCzL/kUwnNtgVgiDD2GjSBKsC23gq', NULL, 'White Isabella', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:11', '2023-08-15 04:44:11'),
(633, 5027, 'white.jack@gmail.com', '$2y$10$VVS.NHfdq9aNqasP58PV8e6hTQWY7ZviqFFM8T0IyJbKbkc9njL..', NULL, 'White Jack', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:11', '2023-08-15 04:44:11'),
(634, 5015, 'white.katherine@gmail.com', '$2y$10$jqfZ4LJdDdDxfhXL1kNMjOvP7giAkYbHsHOI4139HBQBQkWbPLIi6', NULL, 'White Katherine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:11', '2023-08-15 04:44:11'),
(635, 5019, 'white.liam@gmail.com', '$2y$10$wSe3KKoIxf4h2oPd2yWz3ekKLj52LQfzljgWGaeciA4CgatbijdwK', NULL, 'White Liam', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:11', '2023-08-15 04:44:11'),
(636, 5006, 'white.mia@gmail.com', '$2y$10$VbjwJlz2zu1ayZw47iS9B.aPKTqmLW0qj3/y73vZEZ9u.hnr1FkmG', NULL, 'White Mia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:11', '2023-08-15 04:44:11'),
(637, 5021, 'white.noah@gmail.com', '$2y$10$ZQHd2sTieBXxXV00rijjcO1Pp4WpJZHQVc0vRrMcLPMIKfzdnmUwm', NULL, 'White Noah', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:11', '2023-08-15 04:44:11'),
(638, 5015, 'white.olivia@gmail.com', '$2y$10$r0PueKOuMnnSCPWq5bDbj.za..KEK9UNT361Nkz1VbQoEEmowjnjm', NULL, 'White Olivia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:11', '2023-08-15 04:44:11'),
(639, 5013, 'white.penelope@gmail.com', '$2y$10$RsI.v8DCLHC8V6vW8fxU6OeoBsj22q8WsnAMLVCXQ5g5G318wF3V6', NULL, 'White Penelope', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:11', '2023-08-15 04:44:11'),
(640, 5010, 'white.quinn@gmail.com', '$2y$10$v83/iZQza39uhMgn9Kim8.k7b6RKl7EvdoliyraHtMA/8QoX6DH6y', NULL, 'White Quinn', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:11', '2023-08-15 04:44:11'),
(641, 5022, 'white.ryan@gmail.com', '$2y$10$KrshAecKs/bASYusa4qA1OCDHfAEgtyo08jCx0trDHNiVUWoXMjmG', NULL, 'White Ryan', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:12', '2023-08-15 04:44:12'),
(642, 5019, 'white.sophia@gmail.com', '$2y$10$267x9xYo4iU7ATmsBxV5e.iOMrjCd5WTaNA5lpZM0QEke4QI3E7De', NULL, 'White Sophia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:12', '2023-08-15 04:44:12'),
(643, 5011, 'white.thomas@gmail.com', '$2y$10$joM0FnpoFA0MhOSJIxK68OyHq6a24qYorczzpy1efZ3K0wk28IkDq', NULL, 'White Thomas', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:12', '2023-08-15 04:44:12'),
(644, 5018, 'white.uma@gmail.com', '$2y$10$z.JkA5ZYZft36ZltJlQq1.H9jMzHOlJ2Nsf.8yu0U8koV5m2DaTXu', NULL, 'White Uma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:12', '2023-08-15 04:44:12'),
(645, 5025, 'white.victoria@gmail.com', '$2y$10$WUAbwZ0F4CK7RzGhI/qMj.Fes5ZMXrr140yhByZO41tXBhNhZrF9K', NULL, 'White Victoria', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:12', '2023-08-15 04:44:12'),
(646, 5025, 'white.william@gmail.com', '$2y$10$QcNpzfKCLGkkUuYaShySu.kcnQbNFY/f1El0Sw4cnQv.hjujSgOQO', NULL, 'White William', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:12', '2023-08-15 04:44:12'),
(647, 5024, 'white.xander@gmail.com', '$2y$10$BWiKkBWYXDC3O42w6Pigt./E8mwMHY04bwrPtj1SvXaYKwG59Dqka', NULL, 'White Xander', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:12', '2023-08-15 04:44:12'),
(648, 5030, 'white.yasmine@gmail.com', '$2y$10$ym.A9fklKYz3ksSSWZPbSewjDsmuUqn9eQv2QHX.BMEbzz5cs9n7u', NULL, 'White Yasmine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:12', '2023-08-15 04:44:12'),
(649, 5011, 'white.zachary@gmail.com', '$2y$10$0kF.UauxxJWi5KpbDCfYEOaXysBmRjgZEziWZ66xfwVNph4Gd0BI.', NULL, 'White Zachary', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:12', '2023-08-15 04:44:12'),
(650, 1, 'white.ava@gmail.com', '$2y$10$bWd8nTgzGbzOXUZZePNbCe/ItA7BZ0U3h5fJnJOUUZiUAid2fCplO', NULL, 'White Ava', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:12', '2023-08-15 04:44:12'),
(651, 1, 'white.benjamin@gmail.com', '$2y$10$nPt4mvt5fPjpltJSOlfPMe9vbBV6j25WhC8Gi02fCRoHH8hTIC98m', NULL, 'White Benjamin', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:12', '2023-08-15 04:44:12'),
(652, 5025, 'white.chloe@gmail.com', '$2y$10$VsX7.8Si4M1MHanQ/B6lHOnKbdvAR43a6gfRa3W0.uJVvJdAa/q0C', NULL, 'White Chloe', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:12', '2023-08-15 04:44:12'),
(653, 5012, 'white.daniel@gmail.com', '$2y$10$qKC/C0eehAkbqpghn9C2lewK8QSdmpA1hiG7oDoYaw1bQ13DerPhe', NULL, 'White Daniel', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:12', '2023-08-15 04:44:12'),
(654, 5022, 'white.emma@gmail.com', '$2y$10$cO21fBWiEvaY0mkRhEsnguJ6T9SkxNRoE4x2Hz32kIIuh7z5OSLbu', NULL, 'White Emma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:12', '2023-08-15 04:44:12'),
(655, 5005, 'harris.alice@gmail.com', '$2y$10$9FC3KG9oGB.sILlMboDWCOqahA2gyHhrCT4IdoW.QKNeidMDTvZg6', NULL, 'Harris Alice', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:12', '2023-08-15 04:44:12'),
(656, 5025, 'harris.bob@gmail.com', '$2y$10$YnRFger0iO2QrAOwQxpFouQLGxrL.yfZaE2L.QIwPdZiJmB7uhNr.', NULL, 'Harris Bob', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:12', '2023-08-15 04:44:12'),
(657, 5007, 'harris.charlie@gmail.com', '$2y$10$W5HLsaHfCA0vDv.bhoAvkOZet2QcLmkF2VZSzFc5NzTCgNDrW1D86', NULL, 'Harris Charlie', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:12', '2023-08-15 04:44:12'),
(658, 5030, 'harris.david@gmail.com', '$2y$10$dSjtKYxqZtJodi26PsLcOOniHZD.nnckD.YwtICxoVsCGtga.ZvUu', NULL, 'Harris David', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:12', '2023-08-15 04:44:12'),
(659, 4, 'harris.emily@gmail.com', '$2y$10$uodTtcUYHCVIt0lobMmHeOxJI/Tj6Dvkk7KXemoG8YZ/ZlAkP4w3.', NULL, 'Harris Emily', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:13', '2023-08-15 04:44:13'),
(660, 5009, 'harris.frank@gmail.com', '$2y$10$EO3gzRlO1Wq0gxqkFF64wOQMjLkbK0c93oxXtUKCZgwrpVgHjYbTq', NULL, 'Harris Frank', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:13', '2023-08-15 04:44:13'),
(661, 2, 'harris.grace@gmail.com', '$2y$10$7S.B3BYWbUQJy8WazJ16OOWtJbotJUwniQKyzcgu3qd9EImRvJPKC', NULL, 'Harris Grace', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:13', '2023-08-15 04:44:13'),
(662, 5013, 'harris.henry@gmail.com', '$2y$10$ybSFi3XTsRjZILJVDsSc1eUSZ3oij3mbnLxmB0xsBC36wJPV.2Nmu', NULL, 'Harris Henry', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:13', '2023-08-15 04:44:13'),
(663, 2, 'harris.isabella@gmail.com', '$2y$10$Kk5aHvbopggNzcYnnuKLN.lEZ3Nn0IMrG5q1vocw8hrYII.lVcWuy', NULL, 'Harris Isabella', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:13', '2023-08-15 04:44:13'),
(664, 1, 'harris.jack@gmail.com', '$2y$10$EXnkuXIaBDzyO4/OjwmddefD7MLTK6LyDXlVKZ.PKpJPdTB3gh.qS', NULL, 'Harris Jack', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:13', '2023-08-15 04:44:13'),
(665, 5020, 'harris.katherine@gmail.com', '$2y$10$f7gQXw24jcma4amHh/mKvud5rKfxgNtZGvLO2rT9rsAtHMNcCYin6', NULL, 'Harris Katherine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:13', '2023-08-15 04:44:13'),
(666, 5018, 'harris.liam@gmail.com', '$2y$10$wcUPDoc91WJSrK.acakC7OnChBbHTw5gLrPcMWruWb0wqCn9GOcRO', NULL, 'Harris Liam', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:13', '2023-08-15 04:44:13'),
(667, 5017, 'harris.mia@gmail.com', '$2y$10$TkNeKnOL5S7/6FjKMmeqf.YvpbkKHySLoKC6fIMGioR.oppNVENa6', NULL, 'Harris Mia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:13', '2023-08-15 04:44:13'),
(668, 5003, 'harris.noah@gmail.com', '$2y$10$oRl5PYbEhpchndGMm9Yh1ucfAhU8K2K.yWZ/QZrLmwA//rpm7Yqhu', NULL, 'Harris Noah', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:13', '2023-08-15 04:44:13'),
(669, 5023, 'harris.olivia@gmail.com', '$2y$10$3DTC0hef50qx28lnmXEu6OrSuHZ5RWUe4wgyTCtf3yo5QANdzxv1G', NULL, 'Harris Olivia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:13', '2023-08-15 04:44:13'),
(670, 5007, 'harris.penelope@gmail.com', '$2y$10$0ZlF0HyBF2zSYn8nmweJ6O.eGNafe1yf3UDix/Lbk3Cz.gKgN7vcK', NULL, 'Harris Penelope', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:13', '2023-08-15 04:44:13'),
(671, 5023, 'harris.quinn@gmail.com', '$2y$10$/tHJunIVb0Uve6kK2VOt..jsSirnebkyrnm2Zhn7vF6i.e1qLT5k.', NULL, 'Harris Quinn', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:13', '2023-08-15 04:44:13'),
(672, 5014, 'harris.ryan@gmail.com', '$2y$10$/RE6buUSkJkrBJWZSJDQtOiuCwsgk3x5RDbQ61M8qxE4Rr6rpikMO', NULL, 'Harris Ryan', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:13', '2023-08-15 04:44:13'),
(673, 5011, 'harris.sophia@gmail.com', '$2y$10$49FNHcs1pJCvQ3q7t34oS.SZZEtXjq4TPMXI3NF0Ry61tXLbzRAkG', NULL, 'Harris Sophia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:13', '2023-08-15 04:44:13'),
(674, 5019, 'harris.thomas@gmail.com', '$2y$10$bCwZn6eus2KA066pTrRIbefOzeYGfHC3Fsv0QnUGM4S59RCFMeWc2', NULL, 'Harris Thomas', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:13', '2023-08-15 04:44:13'),
(675, 5020, 'harris.uma@gmail.com', '$2y$10$cykPLhA3dEAj/lzQHa9L3uDBUAjRkSLpgaJY0AoJj6tlLhpBjhZWO', NULL, 'Harris Uma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:13', '2023-08-15 04:44:13'),
(676, 5016, 'harris.victoria@gmail.com', '$2y$10$9IGagKNaxegynhRyw4eGGesGjLVHWD4MEULm9SVY9rCjPhMaasQIC', NULL, 'Harris Victoria', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:13', '2023-08-15 04:44:13'),
(677, 5005, 'harris.william@gmail.com', '$2y$10$MasYkmZrF3Q20H75ja94i.H27eRMQ1yufCMSByifb5fy/rdFBvL2O', NULL, 'Harris William', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:13', '2023-08-15 04:44:13'),
(678, 5012, 'harris.xander@gmail.com', '$2y$10$fHbwFHUqW9Ywbejjgo.1re5mPfSVIlDd7KY3l3IQOm98ZI69nw74e', NULL, 'Harris Xander', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:14', '2023-08-15 04:44:14'),
(679, 4, 'harris.yasmine@gmail.com', '$2y$10$5RNRjkzVgbFcy0DBCX.8G.5mfaQyxdPFs3CYzC.Cv4/xoWOqWwkh2', NULL, 'Harris Yasmine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:14', '2023-08-15 04:44:14'),
(680, 5016, 'harris.zachary@gmail.com', '$2y$10$bgNlSl2haKqPRG8hT38tVuAm8F1JxhdMu3hrd0aVdUCAjU1Icy6xu', NULL, 'Harris Zachary', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:14', '2023-08-15 04:44:14'),
(681, 5009, 'harris.ava@gmail.com', '$2y$10$2H9EC9mwDqXrox.eQkAgvugk1tAupFLIv5PtgMD7zTKGt2A9aiJXu', NULL, 'Harris Ava', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:14', '2023-08-15 04:44:14'),
(682, 1, 'harris.benjamin@gmail.com', '$2y$10$x16YN2//CUWD1ngaPs/CWO0GiueQPwyYIfW6ASbWsFxIquUnnhnOG', NULL, 'Harris Benjamin', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:14', '2023-08-15 04:44:14'),
(683, 4, 'harris.chloe@gmail.com', '$2y$10$OouButJyjQidcNxU5jnWgeFkdhoOKcd30aPURw7iM/r1meVmId6C.', NULL, 'Harris Chloe', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:14', '2023-08-15 04:44:14'),
(684, 5005, 'harris.daniel@gmail.com', '$2y$10$13DguDUj7UmqOpgqt3L.TusbFciiGPc2wo8HP3p1kFmW8Tpfbd/je', NULL, 'Harris Daniel', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:14', '2023-08-15 04:44:14'),
(685, 5027, 'harris.emma@gmail.com', '$2y$10$iIsjJGfqoGknXzGq5Eg8PeTfR0BjLrZRVv7w.76ecAWhGIQouwjSe', NULL, 'Harris Emma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:14', '2023-08-15 04:44:14'),
(686, 5024, 'martin.alice@gmail.com', '$2y$10$DDrwq/vxtzycKR8C5434eeXQTtyN5EZZkG/8hErBhtM45khy.VIYG', NULL, 'Martin Alice', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:14', '2023-08-15 04:44:14'),
(687, 5005, 'martin.bob@gmail.com', '$2y$10$l.b2j/dhtMf2ss0ZC/cLuO039c.YrGp.NWBXbM0htv3kujG1GAnFq', NULL, 'Martin Bob', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:14', '2023-08-15 04:44:14'),
(688, 5012, 'martin.charlie@gmail.com', '$2y$10$qqQxPQushWSDkQ1EdWrHaeWpTIPJBFc2GjCMcJLAZjGtrolmUUEei', NULL, 'Martin Charlie', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:14', '2023-08-15 04:44:14'),
(689, 5028, 'martin.david@gmail.com', '$2y$10$ZS22T0Ivgfe7Ggho1.I4mu0YGGNMCSIWfD/xyAYY9ZxwopWnpSPru', NULL, 'Martin David', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:14', '2023-08-15 04:44:14'),
(690, 5024, 'martin.emily@gmail.com', '$2y$10$/mav4bb71m284IFeAin9Qu3aOdEJmXCaArlMJp14SxjZ1PWgHU03y', NULL, 'Martin Emily', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:14', '2023-08-15 04:44:14'),
(691, 1, 'martin.frank@gmail.com', '$2y$10$afF5G2KactOttW7PenYRYOTqnQktCHQVFw7O9ysmGHRnPnFDkFtf2', NULL, 'Martin Frank', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:14', '2023-08-15 04:44:14'),
(692, 5003, 'martin.grace@gmail.com', '$2y$10$ORxG/sPmErKtxmISaWfC/eJqlWVwP8tMncvQy1QFumCuwghm8gpSK', NULL, 'Martin Grace', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:14', '2023-08-15 04:44:14'),
(693, 5031, 'martin.henry@gmail.com', '$2y$10$2FwJWdhQGuSAalXOtqOzNOG4ieRTWYlANydCuZzUn81Kc5zicqkWW', NULL, 'Martin Henry', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:14', '2023-08-15 04:44:14'),
(694, 2, 'martin.isabella@gmail.com', '$2y$10$VBBpeYEKS3wS/SID3lOGiuhUwsv26QWKHBOx0du9KjHNY8/VR5oRS', NULL, 'Martin Isabella', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:14', '2023-08-15 04:44:14'),
(695, 5027, 'martin.jack@gmail.com', '$2y$10$5JQCNz/pkFz54f23g1TCQ.SJKB8ov1we0gMkXnrnSfkrnt0GF8cQa', NULL, 'Martin Jack', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:14', '2023-08-15 04:44:14'),
(696, 5023, 'martin.katherine@gmail.com', '$2y$10$ht7UkptWJYxIXs9WJGbFmucQtnPDB8T0brzKS4UTsNndtZbt.ZCZG', NULL, 'Martin Katherine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:14', '2023-08-15 04:44:14'),
(697, 5006, 'martin.liam@gmail.com', '$2y$10$cSzMIkO.QwbslF9ZKL3NHep8DmByqhnhi90mxN52SXF81vqIMTn22', NULL, 'Martin Liam', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:15', '2023-08-15 04:44:15'),
(698, 5028, 'martin.mia@gmail.com', '$2y$10$Srej6UfSgQGgNoNym2kqiubH6Bf682TetzDpQVjwEXtP5ur9ki6JS', NULL, 'Martin Mia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:15', '2023-08-15 04:44:15'),
(699, 5015, 'martin.noah@gmail.com', '$2y$10$NGHqcRW6XxejK/Q5/zslu.G4jmKHJ69foqNA0wAzmYdovwzxB5ROG', NULL, 'Martin Noah', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:15', '2023-08-15 04:44:15'),
(700, 5007, 'martin.olivia@gmail.com', '$2y$10$hTughYAHrcx6WtpdDEg97OgRRtM02uejWSlwa2RTwQI5/EVv1fO0C', NULL, 'Martin Olivia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:15', '2023-08-15 04:44:15'),
(701, 5011, 'martin.penelope@gmail.com', '$2y$10$clc1JiUQUe2fXW/h8PVa0.YodSMAY38GO8F3.m6ytEhMIOXqPgv7K', NULL, 'Martin Penelope', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:15', '2023-08-15 04:44:15'),
(702, 5022, 'martin.quinn@gmail.com', '$2y$10$HXwd2vcZ5BoGJsu8pfnVxuifz3AzTCaEA.NzS1a9ae.bluEHykEk6', NULL, 'Martin Quinn', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:15', '2023-08-15 04:44:15'),
(703, 4, 'martin.ryan@gmail.com', '$2y$10$XrkSkN8b/vHnB34NJitSiuOWzCDbTWr9IcInlSKhwRt/FHCE.Uo5i', NULL, 'Martin Ryan', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:15', '2023-08-15 04:44:15'),
(704, 5012, 'martin.sophia@gmail.com', '$2y$10$l234zhC.3sYeU0uYm.j7XeG1O5YdVzJCzrj.FRlHPvKTB2v5MgH1u', NULL, 'Martin Sophia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:15', '2023-08-15 04:44:15'),
(705, 5018, 'martin.thomas@gmail.com', '$2y$10$1ClyUADj4JRJsThyRhD3UeqYNqKlbbGVsv5C4V.Pq/3SXfIUqCFZ6', NULL, 'Martin Thomas', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:15', '2023-08-15 04:44:15'),
(706, 5011, 'martin.uma@gmail.com', '$2y$10$nGQN27W6syIaJoJy7LcWR.K8PNnT6wqHvw5a7gCHTEIOQcWBgS48e', NULL, 'Martin Uma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:15', '2023-08-15 04:44:15'),
(707, 4, 'martin.victoria@gmail.com', '$2y$10$.Df97MuPAPboi0HSLcV8H.i0/EHib9eMXEh7g3yo35iZu0NOBj7Ta', NULL, 'Martin Victoria', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:15', '2023-08-15 04:44:15'),
(708, 1, 'martin.william@gmail.com', '$2y$10$ORvGjnuWLm/ctPIK/gyKBukIayDxVQiDI4JA.MZKdpr9jhad1I5ru', NULL, 'Martin William', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:15', '2023-08-15 04:44:15'),
(709, 5016, 'martin.xander@gmail.com', '$2y$10$xl2I.rsASmhB1cXYmvinUuaSh47osiPzPVYVMAuG72MocdNSufbBK', NULL, 'Martin Xander', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:15', '2023-08-15 04:44:15'),
(710, 5005, 'martin.yasmine@gmail.com', '$2y$10$yBodwoDLsNWefZI6FtboCep6qr5.EA3isDQLRiFu41BLsM4LCL0Aa', NULL, 'Martin Yasmine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:15', '2023-08-15 04:44:15'),
(711, 5025, 'martin.zachary@gmail.com', '$2y$10$muw5czXeVBEeBJtEX4fzgePtjdgn6az8bTJt915zv2tpp7BVxdriy', NULL, 'Martin Zachary', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:15', '2023-08-15 04:44:15'),
(712, 5010, 'martin.ava@gmail.com', '$2y$10$5H5Yg2RyZrAr8ObPwnxOKuEi7ECDlazzaERy8uOBI3FcyzQwDRCWW', NULL, 'Martin Ava', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:15', '2023-08-15 04:44:15'),
(713, 5011, 'martin.benjamin@gmail.com', '$2y$10$AGTqflSXYt6I4/09HVgcjufzMUbPZW2l8O5B/yQVqDUQircRCATAi', NULL, 'Martin Benjamin', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:15', '2023-08-15 04:44:15'),
(714, 5003, 'martin.chloe@gmail.com', '$2y$10$leuZ/MA.lu3lVH6mCZL/jeW0xUU0GhODD5TOXLOMjkZRjCEMagKFa', NULL, 'Martin Chloe', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:15', '2023-08-15 04:44:15'),
(715, 5014, 'martin.daniel@gmail.com', '$2y$10$wo88HznA0IO/aPfnLinQuuhHEgwCjHh/Sw4zMWiHqGln9aXNpgjXy', NULL, 'Martin Daniel', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:16', '2023-08-15 04:44:16'),
(716, 5022, 'martin.emma@gmail.com', '$2y$10$XkpTCnUyCtQCLO224qnKKeKA6yxWL4bftfDwhWI4R9aq7DHsAKoPm', NULL, 'Martin Emma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:16', '2023-08-15 04:44:16'),
(717, 5010, 'thompson.alice@gmail.com', '$2y$10$X2twqT6UI86KPJTmxcRZ0uRju1fxr390LC7SQHtDxxCNgdPQQ7Z3e', NULL, 'Thompson Alice', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:16', '2023-08-15 04:44:16'),
(718, 5019, 'thompson.bob@gmail.com', '$2y$10$G1y7q5MAP3xfYc3kRhesU..kBduNtt5zZSjbmWrX.DjoBToC30G3e', NULL, 'Thompson Bob', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:16', '2023-08-15 04:44:16'),
(719, 5023, 'thompson.charlie@gmail.com', '$2y$10$xk1H/e8p0VLRJQ/OlRP4IOTNLIMItyMJlhKfxdXJ.dmkansWWc.22', NULL, 'Thompson Charlie', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:16', '2023-08-15 04:44:16'),
(720, 5006, 'thompson.david@gmail.com', '$2y$10$vHQ9lcWu.zG41767rTR.ceOFvdwZxsECSaXLi3AdKBZpD59L1tAwy', NULL, 'Thompson David', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:16', '2023-08-15 04:44:16'),
(721, 5024, 'thompson.emily@gmail.com', '$2y$10$IUMWVtXY7HG6vymdVR91I.obV0yi9OkUYoYxy1kk84Ilgfl8ryXY6', NULL, 'Thompson Emily', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:16', '2023-08-15 04:44:16'),
(722, 5021, 'thompson.frank@gmail.com', '$2y$10$brJwGfw3huolqjMu.AHXmeUlMrhe4HSeRCpv0r4F1j45PaQO.ECM.', NULL, 'Thompson Frank', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:16', '2023-08-15 04:44:16'),
(723, 5006, 'thompson.grace@gmail.com', '$2y$10$GtmVRvUkJuOlbzQ0JS2dNOmIgRlQJ6.Sy6h7DPy956aGTw61wjk1.', NULL, 'Thompson Grace', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:16', '2023-08-15 04:44:16'),
(724, 5021, 'thompson.henry@gmail.com', '$2y$10$RxSRg7Zh3D0PejLaxPUVreDq2XP9Js3e2IAorMuN4NyW/cgQPzUT6', NULL, 'Thompson Henry', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:16', '2023-08-15 04:44:16'),
(725, 5003, 'thompson.isabella@gmail.com', '$2y$10$Tr3WCw/w4J4nr3Y0ZpEGAenfFlZh1gkWa2xBWcoXvLo2WMM1S5gfi', NULL, 'Thompson Isabella', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:16', '2023-08-15 04:44:16'),
(726, 5005, 'thompson.jack@gmail.com', '$2y$10$Aek7bShY7L83hCeO9mxT5.ryFfefcfnLxC04PBzrhc7GkrhgMb.1q', NULL, 'Thompson Jack', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:16', '2023-08-15 04:44:16'),
(727, 5024, 'thompson.katherine@gmail.com', '$2y$10$ZscBcy.TWgc/pKfJrnLJL.YEHIrQkKzWit6RPw9Wxexgfzv2aqGkO', NULL, 'Thompson Katherine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:16', '2023-08-15 04:44:16'),
(728, 5005, 'thompson.liam@gmail.com', '$2y$10$8eEHrRESw8MpeKZg5zTeYunzTMeaCucb3cJAbbQSsaGTxImdwzDJC', NULL, 'Thompson Liam', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:16', '2023-08-15 04:44:16'),
(729, 5023, 'thompson.mia@gmail.com', '$2y$10$JhfjRAurbj3aLjALAUJh5O0ULGCmvxNxN4QkFErFAj6I7VfSP58Zi', NULL, 'Thompson Mia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:16', '2023-08-15 04:44:16'),
(730, 5023, 'thompson.noah@gmail.com', '$2y$10$umwaP3VjKYCFBj03DvJKvuxhQNa.itT0gWGyeG5qJAT/A6oaVAy.a', NULL, 'Thompson Noah', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:16', '2023-08-15 04:44:16'),
(731, 1, 'thompson.olivia@gmail.com', '$2y$10$468YR.T34f1I7pcDfs7cEutCvOCPU9aY8ukPGu/hdaJaTmlcxR.2m', NULL, 'Thompson Olivia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:16', '2023-08-15 04:44:16'),
(732, 5006, 'thompson.penelope@gmail.com', '$2y$10$pqngpmfaDc8Gw51yKqXVJehfQwwr4YxGhLn6RT94mFKDD7w/4Dlje', NULL, 'Thompson Penelope', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:16', '2023-08-15 04:44:16'),
(733, 5014, 'thompson.quinn@gmail.com', '$2y$10$3i5kZ3bWfHtlue8FhVN7qeYCDM/NvtSK9xGHXyKq6ghIwps5gIZLG', NULL, 'Thompson Quinn', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:16', '2023-08-15 04:44:16'),
(734, 5027, 'thompson.ryan@gmail.com', '$2y$10$Pd8iAFmseQ5NNQnXpfNuWuT5/ISse4WuBOawQW2/KDJ3mbilPlDXq', NULL, 'Thompson Ryan', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:17', '2023-08-15 04:44:17'),
(735, 5024, 'thompson.sophia@gmail.com', '$2y$10$4vuhTc3qdjHM4.Xo0GIrBe6VyePObFES8eX3cW.k4MGgF7QanJJ.i', NULL, 'Thompson Sophia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:17', '2023-08-15 04:44:17'),
(736, 5027, 'thompson.thomas@gmail.com', '$2y$10$jKpSke7CHN9U6D1OfNM7c.2LcCHlNjjRkmccWrMGFO8byd/Fwdzfe', NULL, 'Thompson Thomas', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:17', '2023-08-15 04:44:17'),
(737, 5015, 'thompson.uma@gmail.com', '$2y$10$6aG4tVlMBl3QlrBtTFgAz.kc0esnHMybOjLNGfzfJZIEqMUmnyhuO', NULL, 'Thompson Uma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:17', '2023-08-15 04:44:17'),
(738, 5024, 'thompson.victoria@gmail.com', '$2y$10$bZyOtke8MIssbbYlc7PEmOOW2KNhMWpqdh9mXGvoVPZLQupLrNg1e', NULL, 'Thompson Victoria', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:17', '2023-08-15 04:44:17'),
(739, 5022, 'thompson.william@gmail.com', '$2y$10$70ogasZI1ug6XWyvF1O0Q.GesO2JUcHTCndmmvw3O/2lxOJD6LMNe', NULL, 'Thompson William', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:17', '2023-08-15 04:44:17'),
(740, 5025, 'thompson.xander@gmail.com', '$2y$10$sVaMubT983T79.nDulRUt.2D.OdSJ9UtINmnHBClBE2hzHGOEnLTa', NULL, 'Thompson Xander', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:17', '2023-08-15 04:44:17'),
(741, 5005, 'thompson.yasmine@gmail.com', '$2y$10$/B8BKcT8Uj8Pt.srjYF4num/3kYEqz3n8TUVvqdT852eLrrgOKaYu', NULL, 'Thompson Yasmine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:17', '2023-08-15 04:44:17'),
(742, 5011, 'thompson.zachary@gmail.com', '$2y$10$j78lwTZXyEKjfT1hkrvBk.OIrIgakh.HN3SyZOEzfnalSESmhFq5G', NULL, 'Thompson Zachary', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:17', '2023-08-15 04:44:17');
INSERT INTO `account` (`account_id`, `role_id`, `username`, `password`, `image`, `name`, `doc_number`, `tel`, `mobile`, `address`, `valid`, `last_logged_at`, `updated_at`, `registed_at`) VALUES
(743, 5012, 'thompson.ava@gmail.com', '$2y$10$s3NwVkXdSoZ.pRgG6M4OX.ncWreMHSefrvw6EyH3zBG8QLa4EZrwu', NULL, 'Thompson Ava', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:17', '2023-08-15 04:44:17'),
(744, 5026, 'thompson.benjamin@gmail.com', '$2y$10$6ahRKj8d/7MojcQRd1ywEeonVrh1CRLd04BiedrZvxPTr6Y9yhSkO', NULL, 'Thompson Benjamin', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:17', '2023-08-15 04:44:17'),
(745, 4, 'thompson.chloe@gmail.com', '$2y$10$Hmq8K1Ut0THGs/Uy0diLvOG5e2PspP6V.WnVhg0EYLvmD5eFH7pA6', NULL, 'Thompson Chloe', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:17', '2023-08-15 04:44:17'),
(746, 5021, 'thompson.daniel@gmail.com', '$2y$10$nWXST0eLUS8W2UxygO7buOjv4EvX8DQLFUXYmhGX16PHNOMz3DMKW', NULL, 'Thompson Daniel', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:17', '2023-08-15 04:44:17'),
(747, 5003, 'thompson.emma@gmail.com', '$2y$10$wZ4SZVo0B9jG2285QDD8ZeyWdp5/q6FPZgHJ5hQGlHdgfGVV8.Gs2', NULL, 'Thompson Emma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:17', '2023-08-15 04:44:17'),
(748, 5011, 'garcia.alice@gmail.com', '$2y$10$74HRGw/MNLEY84piBsQy0OE94i4gXw6uw4aRV2iGmK3ztIlBMV2Wq', NULL, 'Garcia Alice', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:17', '2023-08-15 04:44:17'),
(749, 5022, 'garcia.bob@gmail.com', '$2y$10$z6Vaim1Po5LJ4Rt3t2JqAuAGxCCpUOylqKEgK2u5fA13RHrpsdLEC', NULL, 'Garcia Bob', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:17', '2023-08-15 04:44:17'),
(750, 5021, 'garcia.charlie@gmail.com', '$2y$10$jTxBmnYBhvHFp.DlrPnC9e92g9ddR0i8uaOL2Q75I76WegoMFin56', NULL, 'Garcia Charlie', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:17', '2023-08-15 04:44:17'),
(751, 5025, 'garcia.david@gmail.com', '$2y$10$SNppEnNrOCVuC2IGSfw.8uRIgsV8Og0AVM0GTZxgXoEXWHDjvTPgy', NULL, 'Garcia David', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:17', '2023-08-15 04:44:17'),
(752, 5021, 'garcia.emily@gmail.com', '$2y$10$XMDOe16isrJ4EJXoOGGQ6evSWJ5PBfziUd0IAErSeolW2DOgz049i', NULL, 'Garcia Emily', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:18', '2023-08-15 04:44:18'),
(753, 5027, 'garcia.frank@gmail.com', '$2y$10$0fLRBebl1Cbkf3EykYpbD.E2YDicO3JkeX7ruYs6RmrjIzBz/Fm.G', NULL, 'Garcia Frank', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:18', '2023-08-15 04:44:18'),
(754, 4, 'garcia.grace@gmail.com', '$2y$10$SivMyVUFqltIwVfsOhRzoe/DkGjdHG4F76X7MJpj1ruE6zYy5AqMK', NULL, 'Garcia Grace', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:18', '2023-08-15 04:44:18'),
(755, 5030, 'garcia.henry@gmail.com', '$2y$10$mbsa9hjijXrgUFblGTgcKekZSRbsU9VNq1KwGjUIf2yZLHONZdUbu', NULL, 'Garcia Henry', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:18', '2023-08-15 04:44:18'),
(756, 5006, 'garcia.isabella@gmail.com', '$2y$10$sgIyFYDw4m34MA9FAl/9AOhHnQu2GxzUmjh3JiFEH.hFvx1Pxh2EC', NULL, 'Garcia Isabella', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:18', '2023-08-15 04:44:18'),
(757, 5024, 'garcia.jack@gmail.com', '$2y$10$Kvzv9y6iC4OL3ESojaQtD.b23XoHyak9BXzs3L.AXJiAaz7avTsj.', NULL, 'Garcia Jack', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:18', '2023-08-15 04:44:18'),
(758, 5010, 'garcia.katherine@gmail.com', '$2y$10$SU1iVEi8Wjl8iUzcHsATme/SAsXJAKMMtllRSC/6q4T6MXmTZlDpa', NULL, 'Garcia Katherine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:18', '2023-08-15 04:44:18'),
(759, 2, 'garcia.liam@gmail.com', '$2y$10$HZRBENxbbfyzsDXGS8x0oOTa0bDf.EAUqhtIsVEXjRl7vwucwSthO', NULL, 'Garcia Liam', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:18', '2023-08-15 04:44:18'),
(760, 5020, 'garcia.mia@gmail.com', '$2y$10$5tYh3ZFEqzSH6cGZrvc0zuoiTljN8mg0YmBXnmkfZ/Prg/aGj2fLW', NULL, 'Garcia Mia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:18', '2023-08-15 04:44:18'),
(761, 5023, 'garcia.noah@gmail.com', '$2y$10$ePj7rYKBmq7qGEZ0GxkOjuuFU8mfHjKTKD65lN/H4uiwPVx5yNxa.', NULL, 'Garcia Noah', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:18', '2023-08-15 04:44:18'),
(762, 5014, 'garcia.olivia@gmail.com', '$2y$10$81d0FH3YE4uE6GAJ95IhDe3a8BvdM03bQhMNOmvhSJC6M67MtpA.W', NULL, 'Garcia Olivia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:18', '2023-08-15 04:44:18'),
(763, 1, 'garcia.penelope@gmail.com', '$2y$10$2FAPPTIW6U.yAcDOYZXfSOktxogMoeMnJrZDukuu03fHA95a355mW', NULL, 'Garcia Penelope', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:18', '2023-08-15 04:44:18'),
(764, 5009, 'garcia.quinn@gmail.com', '$2y$10$n/zpKpMBtjW8XcB9ekDY2u.BDx/l215F7ZosOUl/i2i7YF.4wdxz.', NULL, 'Garcia Quinn', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:18', '2023-08-15 04:44:18'),
(765, 5014, 'garcia.ryan@gmail.com', '$2y$10$5oaSitKpN/QXDEi3Zw6NDOMtmnqxT24fnBOd7s2iTegJE1W5z6Ysm', NULL, 'Garcia Ryan', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:18', '2023-08-15 04:44:18'),
(766, 5013, 'garcia.sophia@gmail.com', '$2y$10$YL2xdtXJ1fVd1ldA7lv76OIzom.2P4vGmm42DJ0wtY1xihDcH1z5a', NULL, 'Garcia Sophia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:18', '2023-08-15 04:44:18'),
(767, 5021, 'garcia.thomas@gmail.com', '$2y$10$2mVXk.KJUQ81izboNv0hCerEbOEf6.3xNXZ5/.37DqO.lQIM43fmK', NULL, 'Garcia Thomas', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:18', '2023-08-15 04:44:18'),
(768, 5018, 'garcia.uma@gmail.com', '$2y$10$rXnS2AFmX2UPZyFh3lcfOeyKyfdZYk9oeF1RJs4yRpPiVCaq.hnP6', NULL, 'Garcia Uma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:18', '2023-08-15 04:44:18'),
(769, 5021, 'garcia.victoria@gmail.com', '$2y$10$dJr/lTV2zfsDaBJasZjndO/gNCf/um71C0SkRZ2L1TkzCsf4ZdBi6', NULL, 'Garcia Victoria', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:18', '2023-08-15 04:44:18'),
(770, 5027, 'garcia.william@gmail.com', '$2y$10$GquB/g5fjG2THRXMk7QsBOtjYFcf/f0DQW68g0s5DbxS52iUdwTDa', NULL, 'Garcia William', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:18', '2023-08-15 04:44:18'),
(771, 5005, 'garcia.xander@gmail.com', '$2y$10$82abXCse6i0yGl3DX4rHe.0tudQ3v/KZj.tOyOrzWhJFgE4SIvtqW', NULL, 'Garcia Xander', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:19', '2023-08-15 04:44:19'),
(772, 5017, 'garcia.yasmine@gmail.com', '$2y$10$k/n/qfpkho1HI77mUmzqVeKMBn1L5YbBTt0YLvCSGMEUi/fwfxXUi', NULL, 'Garcia Yasmine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:19', '2023-08-15 04:44:19'),
(773, 5010, 'garcia.zachary@gmail.com', '$2y$10$B4r4W8NgffNpn11DaGt7tetr5B28tFdQi1Cdqa1N.JhwTS2avCaQq', NULL, 'Garcia Zachary', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:19', '2023-08-15 04:44:19'),
(774, 5023, 'garcia.ava@gmail.com', '$2y$10$jxnp6uPOHC.TixPnkDav6eeORWTUA.OHEzuQjsPEyx0NfPyzbpfiy', NULL, 'Garcia Ava', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:19', '2023-08-15 04:44:19'),
(775, 5010, 'garcia.benjamin@gmail.com', '$2y$10$C4XRMKAVyKLHioBosKoKTOFxIdswmYtLBKwuqKTbWfGnAhrYPWmUu', NULL, 'Garcia Benjamin', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:19', '2023-08-15 04:44:19'),
(776, 5028, 'garcia.chloe@gmail.com', '$2y$10$./3YAf9IZCzvDEnwKMUkqOIy5SHn3MQC6yMSn8XsfYlKHEtJLKk3e', NULL, 'Garcia Chloe', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:19', '2023-08-15 04:44:19'),
(777, 5028, 'garcia.daniel@gmail.com', '$2y$10$ltk4t0LOBk/NyuSAI4nXOOUhi/MKG1.Y9xt9nOfbVFNbtVFqA5btC', NULL, 'Garcia Daniel', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:19', '2023-08-15 04:44:19'),
(778, 5017, 'garcia.emma@gmail.com', '$2y$10$pclasw5p3I511sCICPMGjuu8QMHXF.vntRjBs5BniYgmWmI3s6/U.', NULL, 'Garcia Emma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:19', '2023-08-15 04:44:19'),
(779, 5023, 'young.alice@gmail.com', '$2y$10$DjhoPYy8p.NB8mw8qnOAv.Ae75hcHKCP593fUlsknFU5eXD4xoYE.', NULL, 'Young Alice', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:19', '2023-08-15 04:44:19'),
(780, 5006, 'young.bob@gmail.com', '$2y$10$BiEaaAI4vSrAu7euaq1g4OEkBC76Vt1IEOZ8w3nP4PbQr/JR3L0bq', NULL, 'Young Bob', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:19', '2023-08-15 04:44:19'),
(781, 5012, 'young.charlie@gmail.com', '$2y$10$xNgJwD644tPrI74DIaorE..PRLCVm1rGbWvFHksh1qoMdPiqd5Pku', NULL, 'Young Charlie', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:19', '2023-08-15 04:44:19'),
(782, 5023, 'young.david@gmail.com', '$2y$10$kuJ9MfBhMRKCBFfYWXuk6uHoflxwjicQP7ijMF/P9o2RV.zQmuP7S', NULL, 'Young David', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:19', '2023-08-15 04:44:19'),
(783, 2, 'young.emily@gmail.com', '$2y$10$FmFX1D6baW1ohaY.rExSc.pBhwd/zCBqCoaacDW4gWLJwwwa0xqXS', NULL, 'Young Emily', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:19', '2023-08-15 04:44:19'),
(784, 5031, 'young.frank@gmail.com', '$2y$10$4jI4QuzhmFparOj7/BTM/.XD6h1NprHRqvXogSoVvv/tQgI.XO9Je', NULL, 'Young Frank', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:19', '2023-08-15 04:44:19'),
(785, 5012, 'young.grace@gmail.com', '$2y$10$LsibZJYCDxPw8tG3Ac2EPuv9SVeKcDsLJGxY8B.aLLdvvVWsDIDiy', NULL, 'Young Grace', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:19', '2023-08-15 04:44:19'),
(786, 2, 'young.henry@gmail.com', '$2y$10$MsiRuZzoaGtEA4tK2hsUluYMBiLIThf.zkqSynLYk0NKI7SfldRh6', NULL, 'Young Henry', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:19', '2023-08-15 04:44:19'),
(787, 1, 'young.isabella@gmail.com', '$2y$10$lBfjjwL.Df2prWYsF9EGeeXbKrlanZyoBxrVvdvscoUuM3fP2OAP2', NULL, 'Young Isabella', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:19', '2023-08-15 04:44:19'),
(788, 5018, 'young.jack@gmail.com', '$2y$10$zzYiXPko4ahBNlYWI7pfFeaMFccCo0JjtJqp79Ntd8bvcLtT41WEa', NULL, 'Young Jack', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:19', '2023-08-15 04:44:19'),
(789, 5028, 'young.katherine@gmail.com', '$2y$10$sswVa/cUCTa9X6uQ7vkO2ufoCeXFgfDW9bjvt83UjPFrGY/WHEdL2', NULL, 'Young Katherine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:19', '2023-08-15 04:44:19'),
(790, 5003, 'young.liam@gmail.com', '$2y$10$/KjkWORCGLLXZqx/wcEQS..mH.LXTB.yEgomgl66am2vvQ6adoAS6', NULL, 'Young Liam', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:20', '2023-08-15 04:44:20'),
(791, 5017, 'young.mia@gmail.com', '$2y$10$NZXb.AeJWDUKqObklNnBQuWPcfZUEnDMVca7JjMLcqOJHSCiaRNNq', NULL, 'Young Mia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:20', '2023-08-15 04:44:20'),
(792, 5031, 'young.noah@gmail.com', '$2y$10$L4ZrMkxig0Q9WQT/VaxYN.puAuyS8bOKDawAldexRNOr7qxvgvAAS', NULL, 'Young Noah', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:20', '2023-08-15 04:44:20'),
(793, 5023, 'young.olivia@gmail.com', '$2y$10$TFR.FXFuYQ1m.vwkA.iFK.M8NRt3ECyUjWtMu6qmydqCLCXEhFzzy', NULL, 'Young Olivia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:20', '2023-08-15 04:44:20'),
(794, 5017, 'young.penelope@gmail.com', '$2y$10$y/5Rtogqk/5E0gHNrTm7QehhCVFfzFQdKDR2DoR8xX1RVoryyZb0q', NULL, 'Young Penelope', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:20', '2023-08-15 04:44:20'),
(795, 5012, 'young.quinn@gmail.com', '$2y$10$eFw6FgOMySuTdLeLVekOWu81CeX80IWN.bPauNq8GUINlEBgQEXVa', NULL, 'Young Quinn', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:20', '2023-08-15 04:44:20'),
(796, 5023, 'young.ryan@gmail.com', '$2y$10$VkHD4vRgjcQQgMECCf5wm.HBRkHghB3mdsCc2eexzNiU1NsW0u1OW', NULL, 'Young Ryan', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:20', '2023-08-15 04:44:20'),
(797, 5009, 'young.sophia@gmail.com', '$2y$10$vl2sG0hI61BPQL6SVaOuEe0RIMOUBqRTpANVkxkjkk4knb5FwcFEK', NULL, 'Young Sophia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:20', '2023-08-15 04:44:20'),
(798, 5006, 'young.thomas@gmail.com', '$2y$10$yoRO7MJJpAMjJcrFKJI89uUDUh/oPSz0TUPlosUCA/QRAkU28P4zq', NULL, 'Young Thomas', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:20', '2023-08-15 04:44:20'),
(799, 5003, 'young.uma@gmail.com', '$2y$10$dBHBF/Q2DuPjlrQNnfuI9.7KhJ/Ie18atAdTY33wac/HnSoJxHyDS', NULL, 'Young Uma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:20', '2023-08-15 04:44:20'),
(800, 4, 'young.victoria@gmail.com', '$2y$10$mVc/v3liXxqaV604S5YFnep6a5nkf08sg10gzeISTL.cLjczU91l6', NULL, 'Young Victoria', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:20', '2023-08-15 04:44:20'),
(801, 5023, 'young.william@gmail.com', '$2y$10$yHTkg0Yl6V/WPOZOSjW1WuCniXcEV7yETxcIB3aBpQdXZvBnn4RQy', NULL, 'Young William', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:20', '2023-08-15 04:44:20'),
(802, 5025, 'young.xander@gmail.com', '$2y$10$.1NWA7z1L2q5CrJgqxlknObz/AXoiQbXJh8XCiYJv3vtQ4HtZzaYG', NULL, 'Young Xander', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:20', '2023-08-15 04:44:20'),
(803, 5023, 'young.yasmine@gmail.com', '$2y$10$WimiX50cGiWWjeNbcfTYt.Yw.DSrz00N2F4TM50qho4GSqQvoOlPa', NULL, 'Young Yasmine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:20', '2023-08-15 04:44:20'),
(804, 5010, 'young.zachary@gmail.com', '$2y$10$tn5YpivAZSmLNVWM.dDKsOu8sPJVyjWpWnhnMxjn39x5NTiYNKkqO', NULL, 'Young Zachary', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:20', '2023-08-15 04:44:20'),
(805, 5005, 'young.ava@gmail.com', '$2y$10$UoCsoYoPgKZPxgw4kQi8VukK6SwurrJmG9z2Itmj7yECzS5zRPMHW', NULL, 'Young Ava', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:20', '2023-08-15 04:44:20'),
(806, 5022, 'young.benjamin@gmail.com', '$2y$10$KOHENK0OWtIKV134HdlEu.QaMB2Zf.Xc.ZQM6okH8lXCGWq5zbcNG', NULL, 'Young Benjamin', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:20', '2023-08-15 04:44:20'),
(807, 2, 'young.chloe@gmail.com', '$2y$10$OynM2d4NWgW2j3eHZwHPEe6VagJWh69wzXYR6Bx.2gKhUjcd3BSD2', NULL, 'Young Chloe', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:20', '2023-08-15 04:44:20'),
(808, 2, 'young.daniel@gmail.com', '$2y$10$kLR3qINa/NZlWn1a0wSIcOidcNtT8Ju2irhYK7okkpQiTRa9hwoGa', NULL, 'Young Daniel', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:20', '2023-08-15 04:44:20'),
(809, 5018, 'young.emma@gmail.com', '$2y$10$jJCRRBo5WGzPIrGBN5j/zu2QadAMxIsPIPIOVFv2sDnfy0TB4mMvS', NULL, 'Young Emma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:21', '2023-08-15 04:44:21'),
(810, 5031, 'hall.alice@gmail.com', '$2y$10$j.STtJ3DZWsTkJjbW7XZfOItMJsL6Vz4H7dROzgqUiCbefUxEpInq', NULL, 'Hall Alice', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:21', '2023-08-15 04:44:21'),
(811, 1, 'hall.bob@gmail.com', '$2y$10$uJsO.6P7caedEDpjNexiSOt3TlP192AJvIw5uZ.PDACF.TcUHS8uO', NULL, 'Hall Bob', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:21', '2023-08-15 04:44:21'),
(812, 5030, 'hall.charlie@gmail.com', '$2y$10$DLmvZM5bIQJ.GIThWPUK/OJhvfjRFepSwxF3bQFlwbyshOd.Mh8iO', NULL, 'Hall Charlie', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:21', '2023-08-15 04:44:21'),
(813, 4, 'hall.david@gmail.com', '$2y$10$xzVi.swZvWDp34ZbIBbfa.M7cut67V/HxwraFwOXnewOvIoCnu1uO', NULL, 'Hall David', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:21', '2023-08-15 04:44:21'),
(814, 5030, 'hall.emily@gmail.com', '$2y$10$Mgfi5LzCkOzOw8r7XJ7u3eajJjazglPE5l56Qesf.wY5E9BBfD1Ye', NULL, 'Hall Emily', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:21', '2023-08-15 04:44:21'),
(815, 5006, 'hall.frank@gmail.com', '$2y$10$vBowMdKSD5Tr6CDCM0Bxc.3.SX5T5mf9kp5qfC6DtKhupyA6V8MsC', NULL, 'Hall Frank', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:21', '2023-08-15 04:44:21'),
(816, 5017, 'hall.grace@gmail.com', '$2y$10$yw4WJSAGhWkY9iRTYBOEzubVZQUUJ94ycD12xks5cZZRFVfYS.AW6', NULL, 'Hall Grace', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:21', '2023-08-15 04:44:21'),
(817, 5018, 'hall.henry@gmail.com', '$2y$10$V3142QG4v7eoKjklIIZJ2usVGOcvRNjUF0lQMZoUbEw6Ej94Nlf8.', NULL, 'Hall Henry', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:21', '2023-08-15 04:44:21'),
(818, 5015, 'hall.isabella@gmail.com', '$2y$10$PDm7cXJBLj1WQt6C9.N3d.xGWgQQCw2RHIJ4QwfOUbGdbfRAWe3u6', NULL, 'Hall Isabella', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:21', '2023-08-15 04:44:21'),
(819, 5011, 'hall.jack@gmail.com', '$2y$10$QhYVpW.mDhV.EQ.Layxmae5xDC9FXxFoG7WwCzKCZmnR8BClXTv.m', NULL, 'Hall Jack', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:21', '2023-08-15 04:44:21'),
(820, 5013, 'hall.katherine@gmail.com', '$2y$10$rO1qrSM0ny1tEgSFKOTlY.x9qW6/TeU0Y8rpTg3igghQOopX3SYPG', NULL, 'Hall Katherine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:21', '2023-08-15 04:44:21'),
(821, 5012, 'hall.liam@gmail.com', '$2y$10$FSSSEfjyvC.TVvLrtpZFz.joVbco848iL7irOMSm91h5.u3u4PZty', NULL, 'Hall Liam', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:21', '2023-08-15 04:44:21'),
(822, 5012, 'hall.mia@gmail.com', '$2y$10$Lt2mt5Lhfan9V36XpQLGbuie65iymmmbaD.bR3cfJ5GfwtePmf85S', NULL, 'Hall Mia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:21', '2023-08-15 04:44:21'),
(823, 5007, 'hall.noah@gmail.com', '$2y$10$2hUQ4Vrhyz7N2htnz1AJBuaAXgj3lBhiuDU0iWddUC8e2XkZ/BmCm', NULL, 'Hall Noah', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:21', '2023-08-15 04:44:21'),
(824, 5030, 'hall.olivia@gmail.com', '$2y$10$HToACiWUHVPr6J6xX2gDMepa8gXBGF9ONPnxQseoqxIOkrsvPQQ9a', NULL, 'Hall Olivia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:21', '2023-08-15 04:44:21'),
(825, 5011, 'hall.penelope@gmail.com', '$2y$10$HLB/KlIu7yf5iUYaYdPFJ.Rh//XZqaCYeEswcDqI3vL..chhIofi2', NULL, 'Hall Penelope', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:21', '2023-08-15 04:44:21'),
(826, 5022, 'hall.quinn@gmail.com', '$2y$10$1lQ68VGfzxeR8H.m.vFFJuDSvzRojaL8lVpxCED0uuzfxXerS.Ohe', NULL, 'Hall Quinn', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:21', '2023-08-15 04:44:21'),
(827, 2, 'hall.ryan@gmail.com', '$2y$10$J3q1f4MZSR204.5/F5RH9.weJiti7pjW1YbQCNOz2Jj334s8i1Ooq', NULL, 'Hall Ryan', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:21', '2023-08-15 04:44:21'),
(828, 5022, 'hall.sophia@gmail.com', '$2y$10$Yj/gYe2vkgft0XNGA3COoOd1spYNGeZQgt/jGLzTGfWiklO8zOtlW', NULL, 'Hall Sophia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:22', '2023-08-15 04:44:22'),
(829, 5003, 'hall.thomas@gmail.com', '$2y$10$4SjhO8yuTDsgEO4ATIj51uycMfe4s6xPxqegEeuVYAzPd/S0JYg6q', NULL, 'Hall Thomas', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:22', '2023-08-15 04:44:22'),
(830, 1, 'hall.uma@gmail.com', '$2y$10$.31FnnJvBVnM1PUZc.J9Ze.idoniQbd4vVTMCxktA3/Lx4mXxxvvi', NULL, 'Hall Uma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:22', '2023-08-15 04:44:22'),
(831, 5007, 'hall.victoria@gmail.com', '$2y$10$1VvTrzvgmYwJxUVtxBcuFui.mqVMBbNQhocTOWKrUOz8UU3PaKZWu', NULL, 'Hall Victoria', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:22', '2023-08-15 04:44:22'),
(832, 5020, 'hall.william@gmail.com', '$2y$10$K87xFiIEl0VAwXnrrGaNGOSpaoZmJnNiWMocEuYzcpjx2x/qV41GK', NULL, 'Hall William', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:22', '2023-08-15 04:44:22'),
(833, 5017, 'hall.xander@gmail.com', '$2y$10$h5EN3qVldBXGTJ22fL.Kyepa9E6T2QCOzGgkuHeAG9S05ke6lw/ue', NULL, 'Hall Xander', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:22', '2023-08-15 04:44:22'),
(834, 5020, 'hall.yasmine@gmail.com', '$2y$10$tLSfeHYJjyYFS0MXyXBYmubk1FlS.n56Zeyb.TRJjbXmfAYxrn/ee', NULL, 'Hall Yasmine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:22', '2023-08-15 04:44:22'),
(835, 2, 'hall.zachary@gmail.com', '$2y$10$Rwi7xGcPyAvOwASod1kBOuNR29r4VoTLowP.ihkQGQ91n6qpUwIt6', NULL, 'Hall Zachary', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:22', '2023-08-15 04:44:22'),
(836, 5015, 'hall.ava@gmail.com', '$2y$10$SsmRStChLYN599ZPxi0SceCf0krO5jzbgeb/PF/0WU5BPe7CPWecW', NULL, 'Hall Ava', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:22', '2023-08-15 04:44:22'),
(837, 5019, 'hall.benjamin@gmail.com', '$2y$10$zX2v/sOSAUc.s4I5pac9GebFAAHgCaVYBWTMMlE.RWBzv3RtZ6PE.', NULL, 'Hall Benjamin', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:22', '2023-08-15 04:44:22'),
(838, 5016, 'hall.chloe@gmail.com', '$2y$10$v3Q3G6T5FiFRWmkfbbpfC.lW10Yn38eBJJ6i811PHzKm2DGSS2ZTC', NULL, 'Hall Chloe', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:22', '2023-08-15 04:44:22'),
(839, 5018, 'hall.daniel@gmail.com', '$2y$10$s/ilWtJYiv/0VIYPYpqBaeCv0qurHXsAd8JCj1O.GASfyG3QOGv9q', NULL, 'Hall Daniel', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:22', '2023-08-15 04:44:22'),
(840, 4, 'hall.emma@gmail.com', '$2y$10$Dsq6hPhFGCNsyKg5K3bsC.SifI8MOK77RGuYvC0H3yPMUjjEta/Cu', NULL, 'Hall Emma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:22', '2023-08-15 04:44:22'),
(841, 5013, 'king.alice@gmail.com', '$2y$10$NeVo/VHFC/MDWGnM0TnBROJb0zgKYuSOKCbR1hqYNbOwcIeJlOoj6', NULL, 'King Alice', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:22', '2023-08-15 04:44:22'),
(842, 5006, 'king.bob@gmail.com', '$2y$10$Vs5XZqHpOhV5Ez9h0f1r2uc0nG0Bljiy/s0bMj/Y3iA2uKPbVkUzW', NULL, 'King Bob', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:22', '2023-08-15 04:44:22'),
(843, 5012, 'king.charlie@gmail.com', '$2y$10$FEL7ZfCkw4MgyINMi9l3QetXRcoj9MMqKnPPojY2J47twGEej49ZW', NULL, 'King Charlie', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:22', '2023-08-15 04:44:22'),
(844, 5022, 'king.david@gmail.com', '$2y$10$ZI6FB6P2zcKIF4hDpvGVsefOwdrWNWw1dcR5ccaW/M9HoHZGOY6tW', NULL, 'King David', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:22', '2023-08-15 04:44:22'),
(845, 5011, 'king.emily@gmail.com', '$2y$10$PCEse.MlJAJEn7EpqpRQHePUuc4GRn6j6.gOsAYt9YOOMY7h4yh8a', NULL, 'King Emily', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:22', '2023-08-15 04:44:22'),
(846, 5013, 'king.frank@gmail.com', '$2y$10$CsLPKniVaiLABn9wen8zXOQMByRsFg0iF13AaZ6e.wc5jWqTV0Q5a', NULL, 'King Frank', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:23', '2023-08-15 04:44:23'),
(847, 5024, 'king.grace@gmail.com', '$2y$10$NrKx.Q1vRj6n0xk3Pjy.y.xb.zgZOtmsdSe2LK.Jw1eNIHw4OGvf6', NULL, 'King Grace', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:23', '2023-08-15 04:44:23'),
(848, 5026, 'king.henry@gmail.com', '$2y$10$8g6fNJNsVKMAFKMZQffr7O93F8.K7w8hJ0cKRdNtdxDyLStiJ0ycK', NULL, 'King Henry', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:23', '2023-08-15 04:44:23'),
(849, 5010, 'king.isabella@gmail.com', '$2y$10$zw.S1/MthvdE41F05vtzmucIdHRDMT3cOHNNK8uQEWzdI1lql8tMm', NULL, 'King Isabella', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:23', '2023-08-15 04:44:23'),
(850, 5028, 'king.jack@gmail.com', '$2y$10$S7JzFqbKWr2YeiiR73aPhO/tkgrwx6aeQxe3FW/afdInzeekLws0S', NULL, 'King Jack', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:23', '2023-08-15 04:44:23'),
(851, 5016, 'king.katherine@gmail.com', '$2y$10$hlKsecZcZcdW3qQhQmFobeeoINF3lDdeIUayIJAICWWkVl955Tqbm', NULL, 'King Katherine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:23', '2023-08-15 04:44:23'),
(852, 5015, 'king.liam@gmail.com', '$2y$10$82p4BFZKM4NDe50CgnbQJ.ZeM3dEdx51yeQ3tk/DSqkZVp33BPsQm', NULL, 'King Liam', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:23', '2023-08-15 04:44:23'),
(853, 5020, 'king.mia@gmail.com', '$2y$10$dAbuK3UI3042OUpGQpN.l.ZEzIOntD7BaPbhGQQ3ctVjTj4OITw9O', NULL, 'King Mia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:23', '2023-08-15 04:44:23'),
(854, 2, 'king.noah@gmail.com', '$2y$10$0rtt/YQimpV8nblstp.tgOkgYW1LauKHT.UAIRKmrj5fs20a9rcLy', NULL, 'King Noah', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:23', '2023-08-15 04:44:23'),
(855, 5020, 'king.olivia@gmail.com', '$2y$10$Mf2tqT.sKFa3bJ39yVUE6eaj.mbG45jHmrBaRJGYmwXwQeDPQ8CFK', NULL, 'King Olivia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:23', '2023-08-15 04:44:23'),
(856, 5015, 'king.penelope@gmail.com', '$2y$10$Ji.JGudA/B..TyJY1jpUp.zxkbaRELT9q1nfOnjkG/PULVMBvMxbC', NULL, 'King Penelope', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:23', '2023-08-15 04:44:23'),
(857, 2, 'king.quinn@gmail.com', '$2y$10$St9dYlu6xILFciKLvnizNuL95mMxX9G8h6/7MjSg.bOEvDzcmhPVG', NULL, 'King Quinn', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:23', '2023-08-15 04:44:23'),
(858, 5025, 'king.ryan@gmail.com', '$2y$10$SUstNNBffgT6SJ.Q.lok8On.z1Gjfn83/C/NO/t0VaDXV2uyLPVES', NULL, 'King Ryan', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:23', '2023-08-15 04:44:23'),
(859, 5019, 'king.sophia@gmail.com', '$2y$10$PceUPvVn98TsKiWo3aqWT.pJs1UVDgQdQsGKGXYCMPWsdx6PjyC6W', NULL, 'King Sophia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:23', '2023-08-15 04:44:23'),
(860, 5015, 'king.thomas@gmail.com', '$2y$10$E1BhUJT03tuUHtrqoOHzWevq5NlAyaxry0ZNXfgiLen/uUf6s0wQW', NULL, 'King Thomas', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:23', '2023-08-15 04:44:23'),
(861, 5012, 'king.uma@gmail.com', '$2y$10$taxERgB2//5n29tV5N0FseaXs4nG7LS64Evcrgzzf2R7RyO/Ky1.2', NULL, 'King Uma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:23', '2023-08-15 04:44:23'),
(862, 5020, 'king.victoria@gmail.com', '$2y$10$Z9wTyVs4z6.CpmwjNYAFQuAD.Vik13deO/lpq0YbS3rPgJ5aIKfoq', NULL, 'King Victoria', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:23', '2023-08-15 04:44:23'),
(863, 5020, 'king.william@gmail.com', '$2y$10$4wW9sod4KoAvm378HpiwgOIbpOh2DBm4j1wDSpjHI7gYhh7hOn4WC', NULL, 'King William', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:23', '2023-08-15 04:44:23'),
(864, 5020, 'king.xander@gmail.com', '$2y$10$gOtYvtGcK/d70ceU.pjhP.3/wP.mlWcH0yaDb5yv05m30mupy3ZX2', NULL, 'King Xander', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:23', '2023-08-15 04:44:23'),
(865, 5031, 'king.yasmine@gmail.com', '$2y$10$wpfkXMKgGKavXBSf5VLrYOYVqPVbb5zz/E5/4eoqheLTR3Q7czbL6', NULL, 'King Yasmine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:24', '2023-08-15 04:44:24'),
(866, 5006, 'king.zachary@gmail.com', '$2y$10$8M9Xmxmi1H8MJ.8ZVcdQoOXs7RxD3Gf4qH5bd8M8m358gwwveRrGe', NULL, 'King Zachary', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:24', '2023-08-15 04:44:24'),
(867, 5016, 'king.ava@gmail.com', '$2y$10$IY5Mrub0f8O8d3wuGswvf.TbDU1Vk.FoXC7GiGVTqK4P.ETOu.AoK', NULL, 'King Ava', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:24', '2023-08-15 04:44:24'),
(868, 5030, 'king.benjamin@gmail.com', '$2y$10$4x4Ck3dRynpI5Iv5cBTCUOpU1hF8qI7QGPFkLcYhJjD25Tbc4jira', NULL, 'King Benjamin', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:24', '2023-08-15 04:44:24'),
(869, 5012, 'king.chloe@gmail.com', '$2y$10$Njc6.yKIngDyYYw.b4eP6O38iMb5avkNnmAPQiw6UH3iPA/RtxBvG', NULL, 'King Chloe', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:24', '2023-08-15 04:44:24'),
(870, 5031, 'king.daniel@gmail.com', '$2y$10$7WgKLS733K5c4arYLXZdkeCOek4TrlZ0SsDQmwj5pFLt/qwvXFfee', NULL, 'King Daniel', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:24', '2023-08-15 04:44:24'),
(871, 5017, 'king.emma@gmail.com', '$2y$10$PeCJL0e1nS3EpdA7k74DwusCVNFZUrWBIlIfnWKR4vV9oW7N7OT32', NULL, 'King Emma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:24', '2023-08-15 04:44:24'),
(872, 5015, 'scott.alice@gmail.com', '$2y$10$/8xkSbykAmubj9QECTbWLeky3qqcPqn1fIVmLDaXmpKvOusEtcC3e', NULL, 'Scott Alice', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:24', '2023-08-15 04:44:24'),
(873, 5007, 'scott.bob@gmail.com', '$2y$10$kTStNJgRcEsrtoCVW8sn0e/8k7Lr2yI9VZps4ka5xDT4zsNK6vH/i', NULL, 'Scott Bob', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:24', '2023-08-15 04:44:24'),
(874, 5015, 'scott.charlie@gmail.com', '$2y$10$GQP.RvzXg75ujmTTyBlysOVyFu7uKm/1ZkXHW7GuuBlKLmfgb6n3K', NULL, 'Scott Charlie', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:24', '2023-08-15 04:44:24'),
(875, 5005, 'scott.david@gmail.com', '$2y$10$J3nbC3RbDziPEyZjmGW/6eXgZgciA07p5H0YMjQoFFiFtxVvIPZma', NULL, 'Scott David', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:24', '2023-08-15 04:44:24'),
(876, 5021, 'scott.emily@gmail.com', '$2y$10$pg1a7NSHaEV9xr9n3o4nXu/fx6.UbNHhTxTE4if8sqn3btGR4Sspi', NULL, 'Scott Emily', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:24', '2023-08-15 04:44:24'),
(877, 5007, 'scott.frank@gmail.com', '$2y$10$AxksqaG01NSGlYJNrCQQL.sJbsJ/0IqDX4h12Fr7ntSJnEJjrj57q', NULL, 'Scott Frank', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:24', '2023-08-15 04:44:24'),
(878, 5012, 'scott.grace@gmail.com', '$2y$10$DYKKD3YAH1GsQbRTe85fLe/Kq6gpCfRaEy0HDLPpnsAeEtM2Lk/si', NULL, 'Scott Grace', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:24', '2023-08-15 04:44:24'),
(879, 5026, 'scott.henry@gmail.com', '$2y$10$YtQ0h2p51gHIkH1OysJ/KeqohOc5PYF5lL1/Th83l4ntkSwYIqMGe', NULL, 'Scott Henry', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:24', '2023-08-15 04:44:24'),
(880, 5024, 'scott.isabella@gmail.com', '$2y$10$hHc1A2b7VIv7eFyP6CaYGuscgbcZfy1Nbeoe182gUKQB4CbTTk0na', NULL, 'Scott Isabella', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:24', '2023-08-15 04:44:24'),
(881, 1, 'scott.jack@gmail.com', '$2y$10$Ii4t3Lj60x52tkQZ92QC0OEGG63UZXZpbOHZvWHvuUc2AXsCcyW9e', NULL, 'Scott Jack', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:24', '2023-08-15 04:44:24'),
(882, 5020, 'scott.katherine@gmail.com', '$2y$10$nDGBjGuom5Lc.BHVWYokSu25pnM24gLrdvKRYnuANCTTnyuLLoypq', NULL, 'Scott Katherine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:24', '2023-08-15 04:44:24'),
(883, 5030, 'scott.liam@gmail.com', '$2y$10$IehO/FK/pAtfqDPrmI3kQuaxv.tLkPtAbOMEUT.bjYsUUz39z6bqu', NULL, 'Scott Liam', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:24', '2023-08-15 04:44:24'),
(884, 4, 'scott.mia@gmail.com', '$2y$10$jPTETtpHFa7GzPVTpFFuuuO28pMtTVcXVfyR9J6wAmn8UFPfk83Ii', NULL, 'Scott Mia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:25', '2023-08-15 04:44:25'),
(885, 5011, 'scott.noah@gmail.com', '$2y$10$IQcoi5a5kia58.L4TCPqHuabqWWb4DsrbzgbfNd5F4w6xenb.T/B6', NULL, 'Scott Noah', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:25', '2023-08-15 04:44:25'),
(886, 5003, 'scott.olivia@gmail.com', '$2y$10$gLHYcYB0Dx2KkXjufK5NceH8n6KO8ycdK9ki7Ezbt8Q52.H81Uv7e', NULL, 'Scott Olivia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:25', '2023-08-15 04:44:25'),
(887, 5021, 'scott.penelope@gmail.com', '$2y$10$tjBwMBV/za1KsCRe1bw3du5JAXihdo3it5/9eMdcQTM0AgAjDmoRO', NULL, 'Scott Penelope', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:25', '2023-08-15 04:44:25'),
(888, 5030, 'scott.quinn@gmail.com', '$2y$10$v0kWyIJZ0ykrMlxtshA6fuPfbiEeNjwoZ0c1gkl4nZY/FiFy9zwDe', NULL, 'Scott Quinn', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:25', '2023-08-15 04:44:25'),
(889, 5006, 'scott.ryan@gmail.com', '$2y$10$TcCjRUcRoZQStVH.r2dSyuXDdDnRUGpPodaFC.jKExmRtxAhxos1y', NULL, 'Scott Ryan', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:25', '2023-08-15 04:44:25'),
(890, 5009, 'scott.sophia@gmail.com', '$2y$10$dL31r9.SM/wbGLP8G4NMX.jrXGGL7dYw1KxDzZ4KvFyh0Mf985tzq', NULL, 'Scott Sophia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:25', '2023-08-15 04:44:25'),
(891, 5005, 'scott.thomas@gmail.com', '$2y$10$rnOP.E0UfIEemEVckbLCheypwolNsqRjvAHEW9fWWYpa4F0e1lJcW', NULL, 'Scott Thomas', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:25', '2023-08-15 04:44:25'),
(892, 5031, 'scott.uma@gmail.com', '$2y$10$JCC1XGkkHbd00IylqrwcveBWGaie5kOpbGSmnAn7j0M88LKHzp6aa', NULL, 'Scott Uma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:25', '2023-08-15 04:44:25'),
(893, 5014, 'scott.victoria@gmail.com', '$2y$10$aR8X.kzSLugjEnlzsGjATOZw4xMVFKax5cXmXtBeohu0ch.Jq.zrq', NULL, 'Scott Victoria', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:25', '2023-08-15 04:44:25'),
(894, 5022, 'scott.william@gmail.com', '$2y$10$c6nEmStkAkpcwkO4JCyt0.S8BTbhoCwvbpxkRxUkgXur32Zn7cAiy', NULL, 'Scott William', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:25', '2023-08-15 04:44:25'),
(895, 5015, 'scott.xander@gmail.com', '$2y$10$fgJAMrgTL3VBa3xPI8ocPeVGqtEGsRvrTIllx49OsaIW7zvJgCWIu', NULL, 'Scott Xander', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:25', '2023-08-15 04:44:25'),
(896, 5010, 'scott.yasmine@gmail.com', '$2y$10$8A4B.kJ1Iu.LPbxDE1YKf.Z5TsL.AQlItH03WKf8sK.qJIeJQwq3i', NULL, 'Scott Yasmine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:25', '2023-08-15 04:44:25'),
(897, 5020, 'scott.zachary@gmail.com', '$2y$10$d6fD1.kZU9Rf4TV/SFBO4./R8qAN9/mB4T09YR7LyTb884qctU9Si', NULL, 'Scott Zachary', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:25', '2023-08-15 04:44:25'),
(898, 2, 'scott.ava@gmail.com', '$2y$10$VzBXP6EIteob9wF3t.lrJ.WVYabBH43exUnUHf0vSRRLepgSuAjfm', NULL, 'Scott Ava', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:25', '2023-08-15 04:44:25'),
(899, 5031, 'scott.benjamin@gmail.com', '$2y$10$y4Yy9N668aWqjnaBdGnHvONDvYqAawqeIkvKQS8yF1jeb2W93Nwjy', NULL, 'Scott Benjamin', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:25', '2023-08-15 04:44:25'),
(900, 5003, 'scott.chloe@gmail.com', '$2y$10$0ycTRhiSFPCJRexYGzEZ5e8YYXgWxuCzZ4xmKNdfg4xjRPhdAUIUe', NULL, 'Scott Chloe', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:25', '2023-08-15 04:44:25'),
(901, 5031, 'scott.daniel@gmail.com', '$2y$10$.8cTqt7JRGi2D3Qk2QYpVuY7w02iU4zS2EzoSt92cC2g0uZR6L5em', NULL, 'Scott Daniel', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:25', '2023-08-15 04:44:25'),
(902, 5025, 'scott.emma@gmail.com', '$2y$10$7iVoxULG6R09lp1ywS8t7O9pt1TaEXYqaudBmmrijcOSgadyfl/1m', NULL, 'Scott Emma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:25', '2023-08-15 04:44:25'),
(903, 5026, 'morris.alice@gmail.com', '$2y$10$hR8lo2jBHrSo2L5NmVx/CeHVwjLvzUqtAwxMqoVhFZwPfvEW2MhGC', NULL, 'Morris Alice', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:26', '2023-08-15 04:44:26'),
(904, 2, 'morris.bob@gmail.com', '$2y$10$Ec5hSPmqfFIBP0t5XQ/9yu.7iGmGySkpXeZinTW6vfZkrkzMoxhmq', NULL, 'Morris Bob', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:26', '2023-08-15 04:44:26'),
(905, 5005, 'morris.charlie@gmail.com', '$2y$10$uLi4m9klwMXUFdnqog8Sh.4.L.XvwhNGXbOBZ5vqOGX/mBASu/itC', NULL, 'Morris Charlie', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:26', '2023-08-15 04:44:26'),
(906, 5027, 'morris.david@gmail.com', '$2y$10$Zk/mqk/bXqEdqVy7xmZ/aO4k5hu4/i92cDu.GXciUuZeVICQpBo6e', NULL, 'Morris David', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:26', '2023-08-15 04:44:26'),
(907, 5010, 'morris.emily@gmail.com', '$2y$10$ARGXhYv7tDmUP/nMrVCzg.3BH6sw71Y.t3uQH5ojvj0.Nuyj6Efdy', NULL, 'Morris Emily', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:26', '2023-08-15 04:44:26'),
(908, 5017, 'morris.frank@gmail.com', '$2y$10$NVUKFkxfBQNY0lA3WX1hHOLsse2wofT7NmReuumSlM4VGiOfZgCpS', NULL, 'Morris Frank', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:26', '2023-08-15 04:44:26'),
(909, 5005, 'morris.grace@gmail.com', '$2y$10$OAXrCOfHCYidorx..F2MmurCwdLI04ASR7dTZ1xKmkRgb7uacu6xO', NULL, 'Morris Grace', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:26', '2023-08-15 04:44:26'),
(910, 5010, 'morris.henry@gmail.com', '$2y$10$h6wFhWpPDmIMx9Z4lb/0lumWSt5w1tTjS2kTsAMH2.9gpO7wUSfte', NULL, 'Morris Henry', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:26', '2023-08-15 04:44:26'),
(911, 5022, 'morris.isabella@gmail.com', '$2y$10$nbm71zxc8mN/QyM3qwRuOuG4oa6HNBc8FYeSqQz6/MdYg1KaNgJq2', NULL, 'Morris Isabella', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:26', '2023-08-15 04:44:26'),
(912, 5012, 'morris.jack@gmail.com', '$2y$10$WBjMES064ooGl0F793.GUuvVVEv0PrVmznuAazx86VXX0uqV4oAVW', NULL, 'Morris Jack', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:26', '2023-08-15 04:44:26'),
(913, 4, 'morris.katherine@gmail.com', '$2y$10$lm5fXU5NBT/Y4jfFDH.RWeQTDy33yz07HAEpEwvaBo/dWk4RGuVr6', NULL, 'Morris Katherine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:26', '2023-08-15 04:44:26'),
(914, 5020, 'morris.liam@gmail.com', '$2y$10$I/aT4py5b9mEdCgHrXZOn.EcvE1KWC5aKHf8CgKeplqUqkB7/6kSe', NULL, 'Morris Liam', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:26', '2023-08-15 04:44:26'),
(915, 5019, 'morris.mia@gmail.com', '$2y$10$EhSv3.NHrDfQLxjjwslR1e0XaDSdiBij6ygQ5WEWTjYsURJMppWCa', NULL, 'Morris Mia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:26', '2023-08-15 04:44:26'),
(916, 5030, 'morris.noah@gmail.com', '$2y$10$v89w/UOcBfTsS9B8t8rvA.9Celhgra0kYu0o/qOadf7p4p0wkCyGm', NULL, 'Morris Noah', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:26', '2023-08-15 04:44:26'),
(917, 4, 'morris.olivia@gmail.com', '$2y$10$nbFq2ek6.bV4z3xOiZU/sO7RIIslgHgn6dEDaK/JWiHjsICLQd3iS', NULL, 'Morris Olivia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:26', '2023-08-15 04:44:26'),
(918, 1, 'morris.penelope@gmail.com', '$2y$10$KMS.Dn5QdsgreQLMK7CClOadRGbygHbGpovSXiTgxX.1omW.7aWiO', NULL, 'Morris Penelope', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:26', '2023-08-15 04:44:26'),
(919, 5018, 'morris.quinn@gmail.com', '$2y$10$OTcWs0JYAQHzaD6QoR2yn.w.kDAfZvV3hJMX.gYvv1PaThCtzQZhq', NULL, 'Morris Quinn', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:26', '2023-08-15 04:44:26'),
(920, 5017, 'morris.ryan@gmail.com', '$2y$10$7rTw4GQGDD4D1XrlWhFYFuNoCysqM1TiQXFLQI206eZo366cipO5u', NULL, 'Morris Ryan', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:26', '2023-08-15 04:44:26'),
(921, 4, 'morris.sophia@gmail.com', '$2y$10$lg9m8rCiMmgnYSKzAgE04uW1XbXA6LzLjWwawhgeiuz.5Y/RNGPyC', NULL, 'Morris Sophia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:26', '2023-08-15 04:44:26'),
(922, 5019, 'morris.thomas@gmail.com', '$2y$10$ouLwfgfYRUJlrHpfQBKeSeT8KLw7u7Z.EpJBSheRtIsbMmhgUBWaG', NULL, 'Morris Thomas', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:27', '2023-08-15 04:44:27'),
(923, 5024, 'morris.uma@gmail.com', '$2y$10$MbBpU.Q1C.nxg.PYT.977uUBgpMkh/CSGsTYFI/j.MjtQC.8rDbd.', NULL, 'Morris Uma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:27', '2023-08-15 04:44:27'),
(924, 5006, 'morris.victoria@gmail.com', '$2y$10$Yji1VZShxQZJxkz8Edhxf.dWcBdzkIPpkmLlhfIBhN2MviU.sAyLG', NULL, 'Morris Victoria', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:27', '2023-08-15 04:44:27'),
(925, 5020, 'morris.william@gmail.com', '$2y$10$7d2TB.o5nxOfZP6yxvlNG.4gDpoM1v7n7wipf9e10.tsQDVP/KpTO', NULL, 'Morris William', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:27', '2023-08-15 04:44:27'),
(926, 5017, 'morris.xander@gmail.com', '$2y$10$gcTB08.sDHd57vzXonkVJeXm18PGWTzVe75.AHmNxisto9v06F7Qu', NULL, 'Morris Xander', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:27', '2023-08-15 04:44:27'),
(927, 5018, 'morris.yasmine@gmail.com', '$2y$10$je/5rqh38OygHQzFT46/h.t4zsrWIHWCMC3Bvf2c/SvCHiRhn2c6u', NULL, 'Morris Yasmine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:27', '2023-08-15 04:44:27'),
(928, 5026, 'morris.zachary@gmail.com', '$2y$10$/6JkYRuaxoa1QROeK7/oxeaG1mjtnWSK1WKipyhQZ/Vl3r/rmtGbu', NULL, 'Morris Zachary', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:27', '2023-08-15 04:44:27'),
(929, 5011, 'morris.ava@gmail.com', '$2y$10$SLgXTjwUyUctkM3C3DYX1Ob1zEKPrKrQyE90./MvFlkBE2HN8cYay', NULL, 'Morris Ava', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:27', '2023-08-15 04:44:27'),
(930, 5005, 'morris.benjamin@gmail.com', '$2y$10$3VuAA43foWfppi8UM3wlX.XkAeX/yqegkUj0SnWt5Rl1sHox2tcWO', NULL, 'Morris Benjamin', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:27', '2023-08-15 04:44:27'),
(931, 5018, 'morris.chloe@gmail.com', '$2y$10$kbXNU0U3LPRsb.HIZeqmIeZJnyLq26nAsqI7jZS/yeTMjNA1Esj5O', NULL, 'Morris Chloe', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:27', '2023-08-15 04:44:27'),
(932, 5009, 'morris.daniel@gmail.com', '$2y$10$Qz.LdzGq4nm7IxbiuGss/.mI/Z/gw7wG1bDxzK4XybvfxyP1xq1zm', NULL, 'Morris Daniel', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:27', '2023-08-15 04:44:27'),
(933, 5018, 'morris.emma@gmail.com', '$2y$10$WGlp7r.iOcpHnKF50O7vW.cu1b2R0XQY/6ulSzdmN3C.9JuhrSJje', NULL, 'Morris Emma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:27', '2023-08-15 04:44:27'),
(934, 5018, 'turner.alice@gmail.com', '$2y$10$V0mbIG/mpqckEFM6bAFO9eHFCovBGiv4lZTIR6u191cHv0.xCd6fa', NULL, 'Turner Alice', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:27', '2023-08-15 04:44:27'),
(935, 4, 'turner.bob@gmail.com', '$2y$10$fSvIqdVRtcd3wbAfVjL1s.vzMYKnS1PD4RmkGVE4c8EARG7oDrwHq', NULL, 'Turner Bob', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:27', '2023-08-15 04:44:27'),
(936, 5018, 'turner.charlie@gmail.com', '$2y$10$Keuhy7N12X/hyRuyNbIhGOxtdDqWylxFdTTNHzfNeGlHoaxA9tjzK', NULL, 'Turner Charlie', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:27', '2023-08-15 04:44:27'),
(937, 5025, 'turner.david@gmail.com', '$2y$10$nSln6FiTIW/XDITDlO8uGOdEpvneCKtGMwxqmkmm3gQ1xsIoSfWka', NULL, 'Turner David', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:27', '2023-08-15 04:44:27'),
(938, 5011, 'turner.emily@gmail.com', '$2y$10$/5X5VaDx2zkV5duYP3wZVeao4pohXxcA.n9n4z5YsQgy0OC71hEdS', NULL, 'Turner Emily', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:27', '2023-08-15 04:44:27'),
(939, 5006, 'turner.frank@gmail.com', '$2y$10$9.oXNFgyMzsQ4IrSuJ/R0eieNwS2ms0ZpIWclQC.MBbJsHzAXARqK', NULL, 'Turner Frank', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:27', '2023-08-15 04:44:27'),
(940, 5022, 'turner.grace@gmail.com', '$2y$10$pa6WS0NYCY.POem7QXNvxeHLpvYyGM/yJ2lp9rDgyZtWNm4L7GlC.', NULL, 'Turner Grace', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:28', '2023-08-15 04:44:28'),
(941, 5022, 'turner.henry@gmail.com', '$2y$10$INNOIlwCfoFIdj4knfMsn.O74BsoM3DTQl3q0et2Si6TtGIoY4E5G', NULL, 'Turner Henry', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:28', '2023-08-15 04:44:28'),
(942, 5007, 'turner.isabella@gmail.com', '$2y$10$2VdoKVMPK5h9nMbZwVfgp.vdXlVJeoqgldcStoWRwnJT37tw0MeQa', NULL, 'Turner Isabella', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:28', '2023-08-15 04:44:28'),
(943, 5024, 'turner.jack@gmail.com', '$2y$10$esz01FqOlWyCCwAqjbZ.9.Ehwv5XAsgS3RmnbAbJPxIveb..ubrFy', NULL, 'Turner Jack', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:28', '2023-08-15 04:44:28'),
(944, 5006, 'turner.katherine@gmail.com', '$2y$10$w.qCY.0ZFcWQxL.R9MvKquyZbrgeufbyh4l5lXM1DbodEDvAoZ6da', NULL, 'Turner Katherine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:28', '2023-08-15 04:44:28'),
(945, 5028, 'turner.liam@gmail.com', '$2y$10$jIFITwoXdtHIuC4pkUbbu.TE6GhCBeeeHtYrQIn5iCdSlj/HCpEXS', NULL, 'Turner Liam', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:28', '2023-08-15 04:44:28'),
(946, 2, 'turner.mia@gmail.com', '$2y$10$TMPPM4k7iTJzl6B7d4LSCuKiKxowtu5mg9ivrzJROE.RM.NhTY.TK', NULL, 'Turner Mia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:28', '2023-08-15 04:44:28'),
(947, 5003, 'turner.noah@gmail.com', '$2y$10$ZXbR04Wd7Jq63XosQ40cW.FXpAFhNJ2tptc5TcS9xjhesMxhgbdw2', NULL, 'Turner Noah', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:28', '2023-08-15 04:44:28'),
(948, 5009, 'turner.olivia@gmail.com', '$2y$10$D69jN5y8H9aW4mOm6u3eA.VGZ/xSGw4mR65UcwVciBD80S.uheFbq', NULL, 'Turner Olivia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:28', '2023-08-15 04:44:28'),
(949, 5019, 'turner.penelope@gmail.com', '$2y$10$ZoGDe6lacLrgoZL5ydlis.ECAbeCUH1d9cLWoyjhGa9.d8qA8hmcS', NULL, 'Turner Penelope', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:28', '2023-08-15 04:44:28'),
(950, 5025, 'turner.quinn@gmail.com', '$2y$10$SeMa32UIkWk4yWeHiij9gOvJrJK8vL.OYpTMtQ6LPXqr5XiqGeT8q', NULL, 'Turner Quinn', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:28', '2023-08-15 04:44:28'),
(951, 5006, 'turner.ryan@gmail.com', '$2y$10$P3laCBQadFjsBFeG892p/O9jjOKRRqJb/JYDDLNyJhAhm3pXJ49uC', NULL, 'Turner Ryan', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:28', '2023-08-15 04:44:28'),
(952, 5009, 'turner.sophia@gmail.com', '$2y$10$GM/tIaGn9sQLTJ49L0PaU.X5uOIDw2tIW1/s9TC0XfGcQeyVlioHi', NULL, 'Turner Sophia', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:28', '2023-08-15 04:44:28'),
(953, 5017, 'turner.thomas@gmail.com', '$2y$10$JqOJc7QDnhs/ukq.mjvdceW1yHs4UomWi5B6C5ZaPs8Mej3koGoZC', NULL, 'Turner Thomas', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:28', '2023-08-15 04:44:28'),
(954, 5019, 'turner.uma@gmail.com', '$2y$10$GxyHBFjH0Et27Or/ID3t/O6ukUTAHpHovIuqez61bK4Bjf.mX4C2O', NULL, 'Turner Uma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:28', '2023-08-15 04:44:28'),
(955, 5027, 'turner.victoria@gmail.com', '$2y$10$QExPfWcKh0PwZJJGrq60WOMZhOjzkiNxFgAw5g8wr4BUAJoq93nca', NULL, 'Turner Victoria', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:28', '2023-08-15 04:44:28'),
(956, 5013, 'turner.william@gmail.com', '$2y$10$SuIz6ibX6GHysOU0WlAzwOHU1Q0UbH.WlIsfuDRLVZ4033C7EdSg2', NULL, 'Turner William', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:28', '2023-08-15 04:44:28'),
(957, 5026, 'turner.xander@gmail.com', '$2y$10$ApStRSwXO4aLbJAXeKe0FOpc/7WWZMLIYu/NAxVZsmTCRY2oJOEjy', NULL, 'Turner Xander', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:28', '2023-08-15 04:44:28'),
(958, 5024, 'turner.yasmine@gmail.com', '$2y$10$kxIFAKgdZMN95qSq.wrvtuTMA4X.8htBzPOFNdcH1Lz7gxWm2/4f.', NULL, 'Turner Yasmine', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:28', '2023-08-15 04:44:28'),
(959, 1, 'turner.zachary@gmail.com', '$2y$10$Ttj2.33CBFVQbMVH/9HmnegOIwaEDaya8t5Bmg.1bsG888zt4vIW.', NULL, 'Turner Zachary', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:29', '2023-08-15 04:44:29'),
(960, 1, 'turner.ava@gmail.com', '$2y$10$eUUMM5K7ED9OMNQ7YdtCJ.pg1xOxCC3fGZT0OhSAOezW1w8Q6NfK6', NULL, 'Turner Ava', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:29', '2023-08-15 04:44:29'),
(961, 5021, 'turner.benjamin@gmail.com', '$2y$10$K5Zitjb853JiCryBixMwQe31dSLE3zImuAlN2.WRTi/9bwuZIQt1K', NULL, 'Turner Benjamin', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:29', '2023-08-15 04:44:29'),
(962, 4, 'turner.chloe@gmail.com', '$2y$10$jDQQPwih0c3NYI.o0q/xk.Qf9iSFF7aE/AThFP0SngJnXTHDlQk6a', NULL, 'Turner Chloe', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:29', '2023-08-15 04:44:29'),
(963, 5027, 'turner.daniel@gmail.com', '$2y$10$3VoAzpXX7hlE7gROeRqsNufRmKzv.NDTozT8eQLfqgr7sA4bi3D4e', NULL, 'Turner Daniel', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:29', '2023-08-15 04:44:29'),
(964, 5019, 'turner.emma@gmail.com', '$2y$10$g6X7A5YYsKKft97/bqmp0uPitGeWNrf/SqVZBGSGH5ALlxSnR1Jdi', NULL, 'Turner Emma', '', NULL, NULL, NULL, 1, NULL, '2023-08-15 04:44:29', '2023-08-15 04:44:29'),
(965, 5030, 'ful.sal@heyhey.com', '$2y$10$Hi3asgff1/6.VZL7xQh0huJBOnckI.p5S0Ux7.nHnjF1wMJt0v2ua', NULL, 'Fulanito Salazar', '21840284', '', '', '', 1, NULL, '2023-11-10 00:15:10', '2023-11-10 00:14:22');

-- --------------------------------------------------------

--
-- 테이블 구조 `address_department`
--

CREATE TABLE `address_department` (
  `department_id` int(11) NOT NULL,
  `department` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `address_department`
--

INSERT INTO `address_department` (`department_id`, `department`) VALUES
(1, 'AMAZONAS'),
(2, 'ANCASH'),
(3, 'APURIMAC'),
(4, 'AREQUIPA'),
(5, 'AYACUCHO'),
(6, 'CAJAMARCA'),
(7, 'CALLAO'),
(8, 'CUSCO'),
(9, 'HUANCAVELICA'),
(10, 'HUANUCO'),
(11, 'ICA'),
(12, 'JUNIN'),
(13, 'LA LIBERTAD'),
(14, 'LAMBAYEQUE'),
(15, 'LIMA'),
(16, 'LORETO'),
(17, 'MADRE DE DIOS'),
(18, 'MOQUEGUA'),
(19, 'PASCO'),
(20, 'PIURA'),
(21, 'PUNO'),
(22, 'SAN MARTIN'),
(23, 'TACNA'),
(24, 'TUMBES'),
(25, 'UCAYALI');

-- --------------------------------------------------------

--
-- 테이블 구조 `address_district`
--

CREATE TABLE `address_district` (
  `district_id` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `district` varchar(50) NOT NULL,
  `ubigeo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `address_district`
--

INSERT INTO `address_district` (`district_id`, `province_id`, `district`, `ubigeo`) VALUES
(1, 1, 'CHACHAPOYAS', 10101),
(2, 1, 'ASUNCION', 10102),
(3, 1, 'BALSAS', 10103),
(4, 1, 'CHETO', 10104),
(5, 1, 'CHILIQUIN', 10105),
(6, 1, 'CHUQUIBAMBA', 10106),
(7, 1, 'GRANADA', 10107),
(8, 1, 'HUANCAS', 10108),
(9, 1, 'LA JALCA', 10109),
(10, 1, 'LEIMEBAMBA', 10110),
(11, 1, 'LEVANTO', 10111),
(12, 1, 'MAGDALENA', 10112),
(13, 1, 'MARISCAL CASTILLA', 10113),
(14, 1, 'MOLINOPAMPA', 10114),
(15, 1, 'MONTEVIDEO', 10115),
(16, 1, 'OLLEROS', 10116),
(17, 1, 'QUINJALCA', 10117),
(18, 1, 'SAN FRANCISCO DE DAGUAS', 10118),
(19, 1, 'SAN ISIDRO DE MAINO', 10119),
(20, 1, 'SOLOCO', 10120),
(21, 1, 'SONCHE', 10121),
(22, 2, 'BAGUA', 10201),
(23, 2, 'ARAMANGO', 10202),
(24, 2, 'COPALLIN', 10203),
(25, 2, 'EL PARCO', 10204),
(26, 2, 'IMAZA', 10205),
(27, 2, 'LA PECA', 10206),
(28, 3, 'JUMBILLA', 10301),
(29, 3, 'CHISQUILLA', 10302),
(30, 3, 'CHURUJA', 10303),
(31, 3, 'COROSHA', 10304),
(32, 3, 'CUISPES', 10305),
(33, 3, 'FLORIDA', 10306),
(34, 3, 'JAZAN', 10307),
(35, 3, 'RECTA', 10308),
(36, 3, 'SAN CARLOS', 10309),
(37, 3, 'SHIPASBAMBA', 10310),
(38, 3, 'VALERA', 10311),
(39, 3, 'YAMBRASBAMBA', 10312),
(40, 4, 'NIEVA', 10401),
(41, 4, 'EL CENEPA', 10402),
(42, 4, 'RIO SANTIAGO', 10403),
(43, 5, 'LAMUD', 10501),
(44, 5, 'CAMPORREDONDO', 10502),
(45, 5, 'COCABAMBA', 10503),
(46, 5, 'COLCAMAR', 10504),
(47, 5, 'CONILA', 10505),
(48, 5, 'INGUILPATA', 10506),
(49, 5, 'LONGUITA', 10507),
(50, 5, 'LONYA CHICO', 10508),
(51, 5, 'LUYA', 10509),
(52, 5, 'LUYA VIEJO', 10510),
(53, 5, 'MARIA', 10511),
(54, 5, 'OCALLI', 10512),
(55, 5, 'OCUMAL', 10513),
(56, 5, 'PISUQUIA', 10514),
(57, 5, 'PROVIDENCIA', 10515),
(58, 5, 'SAN CRISTOBAL', 10516),
(59, 5, 'SAN FRANCISCO DEL YESO', 10517),
(60, 5, 'SAN JERONIMO', 10518),
(61, 5, 'SAN JUAN DE LOPECANCHA', 10519),
(62, 5, 'SANTA CATALINA', 10520),
(63, 5, 'SANTO TOMAS', 10521),
(64, 5, 'TINGO', 10522),
(65, 5, 'TRITA', 10523),
(66, 6, 'SAN NICOLAS', 10601),
(67, 6, 'CHIRIMOTO', 10602),
(68, 6, 'COCHAMAL', 10603),
(69, 6, 'HUAMBO', 10604),
(70, 6, 'LIMABAMBA', 10605),
(71, 6, 'LONGAR', 10606),
(72, 6, 'MARISCAL BENAVIDES', 10607),
(73, 6, 'MILPUC', 10608),
(74, 6, 'OMIA', 10609),
(75, 6, 'SANTA ROSA', 10610),
(76, 6, 'TOTORA', 10611),
(77, 6, 'VISTA ALEGRE', 10612),
(78, 7, 'BAGUA GRANDE', 10701),
(79, 7, 'CAJARURO', 10702),
(80, 7, 'CUMBA', 10703),
(81, 7, 'EL MILAGRO', 10704),
(82, 7, 'JAMALCA', 10705),
(83, 7, 'LONYA GRANDE', 10706),
(84, 7, 'YAMON', 10707),
(85, 8, 'HUARAZ', 20101),
(86, 8, 'COCHABAMBA', 20102),
(87, 8, 'COLCABAMBA', 20103),
(88, 8, 'HUANCHAY', 20104),
(89, 8, 'INDEPENDENCIA', 20105),
(90, 8, 'JANGAS', 20106),
(91, 8, 'LA LIBERTAD', 20107),
(92, 8, 'OLLEROS', 20108),
(93, 8, 'PAMPAS', 20109),
(94, 8, 'PARIACOTO', 20110),
(95, 8, 'PIRA', 20111),
(96, 8, 'TARICA', 20112),
(97, 9, 'AIJA', 20201),
(98, 9, 'CORIS', 20202),
(99, 9, 'HUACLLAN', 20203),
(100, 9, 'LA MERCED', 20204),
(101, 9, 'SUCCHA', 20205),
(102, 10, 'LLAMELLIN', 20301),
(103, 10, 'ACZO', 20302),
(104, 10, 'CHACCHO', 20303),
(105, 10, 'CHINGAS', 20304),
(106, 10, 'MIRGAS', 20305),
(107, 10, 'SAN JUAN DE RONTOY', 20306),
(108, 11, 'CHACAS', 20401),
(109, 11, 'ACOCHACA', 20402),
(110, 12, 'CHIQUIAN', 20501),
(111, 12, 'ABELARDO PARDO LEZAMETA', 20502),
(112, 12, 'ANTONIO RAYMONDI', 20503),
(113, 12, 'AQUIA', 20504),
(114, 12, 'CAJACAY', 20505),
(115, 12, 'CANIS', 20506),
(116, 12, 'COLQUIOC', 20507),
(117, 12, 'HUALLANCA', 20508),
(118, 12, 'HUASTA', 20509),
(119, 12, 'HUAYLLACAYAN', 20510),
(120, 12, 'LA PRIMAVERA', 20511),
(121, 12, 'MANGAS', 20512),
(122, 12, 'PACLLON', 20513),
(123, 12, 'SAN MIGUEL DE CORPANQUI', 20514),
(124, 12, 'TICLLOS', 20515),
(125, 13, 'CARHUAZ', 20601),
(126, 13, 'ACOPAMPA', 20602),
(127, 13, 'AMASHCA', 20603),
(128, 13, 'ANTA', 20604),
(129, 13, 'ATAQUERO', 20605),
(130, 13, 'MARCARA', 20606),
(131, 13, 'PARIAHUANCA', 20607),
(132, 13, 'SAN MIGUEL DE ACO', 20608),
(133, 13, 'SHILLA', 20609),
(134, 13, 'TINCO', 20610),
(135, 13, 'YUNGAR', 20611),
(136, 14, 'SAN LUIS', 20701),
(137, 14, 'SAN NICOLAS', 20702),
(138, 14, 'YAUYA', 20703),
(139, 15, 'CASMA', 20801),
(140, 15, 'BUENA VISTA ALTA', 20802),
(141, 15, 'COMANDANTE NOEL', 20803),
(142, 15, 'YAUTAN', 20804),
(143, 16, 'CORONGO', 20901),
(144, 16, 'ACO', 20902),
(145, 16, 'BAMBAS', 20903),
(146, 16, 'CUSCA', 20904),
(147, 16, 'LA PAMPA', 20905),
(148, 16, 'YANAC', 20906),
(149, 16, 'YUPAN', 20907),
(150, 17, 'HUARI', 21001),
(151, 17, 'ANRA', 21002),
(152, 17, 'CAJAY', 21003),
(153, 17, 'CHAVIN DE HUANTAR', 21004),
(154, 17, 'HUACACHI', 21005),
(155, 17, 'HUACCHIS', 21006),
(156, 17, 'HUACHIS', 21007),
(157, 17, 'HUANTAR', 21008),
(158, 17, 'MASIN', 21009),
(159, 17, 'PAUCAS', 21010),
(160, 17, 'PONTO', 21011),
(161, 17, 'RAHUAPAMPA', 21012),
(162, 17, 'RAPAYAN', 21013),
(163, 17, 'SAN MARCOS', 21014),
(164, 17, 'SAN PEDRO DE CHANA', 21015),
(165, 17, 'UCO', 21016),
(166, 18, 'HUARMEY', 21101),
(167, 18, 'COCHAPETI', 21102),
(168, 18, 'CULEBRAS', 21103),
(169, 18, 'HUAYAN', 21104),
(170, 18, 'MALVAS', 21105),
(171, 19, 'CARAZ', 21201),
(172, 19, 'HUALLANCA', 21202),
(173, 19, 'HUATA', 21203),
(174, 19, 'HUAYLAS', 21204),
(175, 19, 'MATO', 21205),
(176, 19, 'PAMPAROMAS', 21206),
(177, 19, 'PUEBLO LIBRE', 21207),
(178, 19, 'SANTA CRUZ', 21208),
(179, 19, 'SANTO TORIBIO', 21209),
(180, 19, 'YURACMARCA', 21210),
(181, 20, 'PISCOBAMBA', 21301),
(182, 20, 'CASCA', 21302),
(183, 20, 'ELEAZAR GUZMAN BARRON', 21303),
(184, 20, 'FIDEL OLIVAS ESCUDERO', 21304),
(185, 20, 'LLAMA', 21305),
(186, 20, 'LLUMPA', 21306),
(187, 20, 'LUCMA', 21307),
(188, 20, 'MUSGA', 21308),
(189, 21, 'OCROS', 21401),
(190, 21, 'ACAS', 21402),
(191, 21, 'CAJAMARQUILLA', 21403),
(192, 21, 'CARHUAPAMPA', 21404),
(193, 21, 'COCHAS', 21405),
(194, 21, 'CONGAS', 21406),
(195, 21, 'LLIPA', 21407),
(196, 21, 'SAN CRISTOBAL DE RAJAN', 21408),
(197, 21, 'SAN PEDRO', 21409),
(198, 21, 'SANTIAGO DE CHILCAS', 21410),
(199, 22, 'CABANA', 21501),
(200, 22, 'BOLOGNESI', 21502),
(201, 22, 'CONCHUCOS', 21503),
(202, 22, 'HUACASCHUQUE', 21504),
(203, 22, 'HUANDOVAL', 21505),
(204, 22, 'LACABAMBA', 21506),
(205, 22, 'LLAPO', 21507),
(206, 22, 'PALLASCA', 21508),
(207, 22, 'PAMPAS', 21509),
(208, 22, 'SANTA ROSA', 21510),
(209, 22, 'TAUCA', 21511),
(210, 23, 'POMABAMBA', 21601),
(211, 23, 'HUAYLLAN', 21602),
(212, 23, 'PAROBAMBA', 21603),
(213, 23, 'QUINUABAMBA', 21604),
(214, 24, 'RECUAY', 21701),
(215, 24, 'CATAC', 21702),
(216, 24, 'COTAPARACO', 21703),
(217, 24, 'HUAYLLAPAMPA', 21704),
(218, 24, 'LLACLLIN', 21705),
(219, 24, 'MARCA', 21706),
(220, 24, 'PAMPAS CHICO', 21707),
(221, 24, 'PARARIN', 21708),
(222, 24, 'TAPACOCHA', 21709),
(223, 24, 'TICAPAMPA', 21710),
(224, 25, 'CHIMBOTE', 21801),
(225, 25, 'CACERES DEL PERU', 21802),
(226, 25, 'COISHCO', 21803),
(227, 25, 'MACATE', 21804),
(228, 25, 'MORO', 21805),
(229, 25, 'NEPEÑA', 21806),
(230, 25, 'SAMANCO', 21807),
(231, 25, 'SANTA', 21808),
(232, 25, 'NUEVO CHIMBOTE', 21809),
(233, 26, 'SIHUAS', 21901),
(234, 26, 'ACOBAMBA', 21902),
(235, 26, 'ALFONSO UGARTE', 21903),
(236, 26, 'CASHAPAMPA', 21904),
(237, 26, 'CHINGALPO', 21905),
(238, 26, 'HUAYLLABAMBA', 21906),
(239, 26, 'QUICHES', 21907),
(240, 26, 'RAGASH', 21908),
(241, 26, 'SAN JUAN', 21909),
(242, 26, 'SICSIBAMBA', 21910),
(243, 27, 'YUNGAY', 22001),
(244, 27, 'CASCAPARA', 22002),
(245, 27, 'MANCOS', 22003),
(246, 27, 'MATACOTO', 22004),
(247, 27, 'QUILLO', 22005),
(248, 27, 'RANRAHIRCA', 22006),
(249, 27, 'SHUPLUY', 22007),
(250, 27, 'YANAMA', 22008),
(251, 28, 'ABANCAY', 30101),
(252, 28, 'CHACOCHE', 30102),
(253, 28, 'CIRCA', 30103),
(254, 28, 'CURAHUASI', 30104),
(255, 28, 'HUANIPACA', 30105),
(256, 28, 'LAMBRAMA', 30106),
(257, 28, 'PICHIRHUA', 30107),
(258, 28, 'SAN PEDRO DE CACHORA', 30108),
(259, 28, 'TAMBURCO', 30109),
(260, 29, 'ANDAHUAYLAS', 30201),
(261, 29, 'ANDARAPA', 30202),
(262, 29, 'CHIARA', 30203),
(263, 29, 'HUANCARAMA', 30204),
(264, 29, 'HUANCARAY', 30205),
(265, 29, 'HUAYANA', 30206),
(266, 29, 'KISHUARA', 30207),
(267, 29, 'PACOBAMBA', 30208),
(268, 29, 'PACUCHA', 30209),
(269, 29, 'PAMPACHIRI', 30210),
(270, 29, 'POMACOCHA', 30211),
(271, 29, 'SAN ANTONIO DE CACHI', 30212),
(272, 29, 'SAN JERONIMO', 30213),
(273, 29, 'SAN MIGUEL DE CHACCRAMPA', 30214),
(274, 29, 'SANTA MARIA DE CHICMO', 30215),
(275, 29, 'TALAVERA', 30216),
(276, 29, 'TUMAY HUARACA', 30217),
(277, 29, 'TURPO', 30218),
(278, 29, 'KAQUIABAMBA', 30219),
(279, 30, 'ANTABAMBA', 30301),
(280, 30, 'EL ORO', 30302),
(281, 30, 'HUAQUIRCA', 30303),
(282, 30, 'JUAN ESPINOZA MEDRANO', 30304),
(283, 30, 'OROPESA', 30305),
(284, 30, 'PACHACONAS', 30306),
(285, 30, 'SABAINO', 30307),
(286, 31, 'CHALHUANCA', 30401),
(287, 31, 'CAPAYA', 30402),
(288, 31, 'CARAYBAMBA', 30403),
(289, 31, 'CHAPIMARCA', 30404),
(290, 31, 'COLCABAMBA', 30405),
(291, 31, 'COTARUSE', 30406),
(292, 31, 'HUAYLLO', 30407),
(293, 31, 'JUSTO APU SAHUARAURA', 30408),
(294, 31, 'LUCRE', 30409),
(295, 31, 'POCOHUANCA', 30410),
(296, 31, 'SAN JUAN DE CHACÑA', 30411),
(297, 31, 'SAÑAYCA', 30412),
(298, 31, 'SORAYA', 30413),
(299, 31, 'TAPAIRIHUA', 30414),
(300, 31, 'TINTAY', 30415),
(301, 31, 'TORAYA', 30416),
(302, 31, 'YANACA', 30417),
(303, 32, 'TAMBOBAMBA', 30501),
(304, 32, 'COTABAMBAS', 30502),
(305, 32, 'COYLLURQUI', 30503),
(306, 32, 'HAQUIRA', 30504),
(307, 32, 'MARA', 30505),
(308, 32, 'CHALLHUAHUACHO', 30506),
(309, 33, 'CHINCHEROS', 30601),
(310, 33, 'ANCO-HUALLO', 30602),
(311, 33, 'COCHARCAS', 30603),
(312, 33, 'HUACCANA', 30604),
(313, 33, 'OCOBAMBA', 30605),
(314, 33, 'ONGOY', 30606),
(315, 33, 'URANMARCA', 30607),
(316, 33, 'RANRACANCHA', 30608),
(317, 34, 'CHUQUIBAMBILLA', 30701),
(318, 34, 'CURPAHUASI', 30702),
(319, 34, 'GAMARRA', 30703),
(320, 34, 'HUAYLLATI', 30704),
(321, 34, 'MAMARA', 30705),
(322, 34, 'MICAELA BASTIDAS', 30706),
(323, 34, 'PATAYPAMPA', 30707),
(324, 34, 'PROGRESO', 30708),
(325, 34, 'SAN ANTONIO', 30709),
(326, 34, 'SANTA ROSA', 30710),
(327, 34, 'TURPAY', 30711),
(328, 34, 'VILCABAMBA', 30712),
(329, 34, 'VIRUNDO', 30713),
(330, 34, 'CURASCO', 30714),
(331, 35, 'AREQUIPA', 40101),
(332, 35, 'ALTO SELVA ALEGRE', 40102),
(333, 35, 'CAYMA', 40103),
(334, 35, 'CERRO COLORADO', 40104),
(335, 35, 'CHARACATO', 40105),
(336, 35, 'CHIGUATA', 40106),
(337, 35, 'JACOBO HUNTER', 40107),
(338, 35, 'LA JOYA', 40108),
(339, 35, 'MARIANO MELGAR', 40109),
(340, 35, 'MIRAFLORES', 40110),
(341, 35, 'MOLLEBAYA', 40111),
(342, 35, 'PAUCARPATA', 40112),
(343, 35, 'POCSI', 40113),
(344, 35, 'POLOBAYA', 40114),
(345, 35, 'QUEQUEÑA', 40115),
(346, 35, 'SABANDIA', 40116),
(347, 35, 'SACHACA', 40117),
(348, 35, 'SAN JUAN DE SIGUAS', 40118),
(349, 35, 'SAN JUAN DE TARUCANI', 40119),
(350, 35, 'SANTA ISABEL DE SIGUAS', 40120),
(351, 35, 'SANTA RITA DE SIGUAS', 40121),
(352, 35, 'SOCABAYA', 40122),
(353, 35, 'TIABAYA', 40123),
(354, 35, 'UCHUMAYO', 40124),
(355, 35, 'VITOR', 40125),
(356, 35, 'YANAHUARA', 40126),
(357, 35, 'YARABAMBA', 40127),
(358, 35, 'YURA', 40128),
(359, 35, 'JOSE LUIS BUSTAMANTE Y', 40129),
(360, 36, 'CAMANA', 40201),
(361, 36, 'JOSE MARIA QUIMPER', 40202),
(362, 36, 'MARIANO NICOLAS VALCARCEL', 40203),
(363, 36, 'MARISCAL CACERES', 40204),
(364, 36, 'NICOLAS DE PIEROLA', 40205),
(365, 36, 'OCOÑA', 40206),
(366, 36, 'QUILCA', 40207),
(367, 36, 'SAMUEL PASTOR', 40208),
(368, 37, 'CARAVELI', 40301),
(369, 37, 'ACARI', 40302),
(370, 37, 'ATICO', 40303),
(371, 37, 'ATIQUIPA', 40304),
(372, 37, 'BELLA UNION', 40305),
(373, 37, 'CAHUACHO', 40306),
(374, 37, 'CHALA', 40307),
(375, 37, 'CHAPARRA', 40308),
(376, 37, 'HUANUHUANU', 40309),
(377, 37, 'JAQUI', 40310),
(378, 37, 'LOMAS', 40311),
(379, 37, 'QUICACHA', 40312),
(380, 37, 'YAUCA', 40313),
(381, 38, 'APLAO', 40401),
(382, 38, 'ANDAGUA', 40402),
(383, 38, 'AYO', 40403),
(384, 38, 'CHACHAS', 40404),
(385, 38, 'CHILCAYMARCA', 40405),
(386, 38, 'CHOCO', 40406),
(387, 38, 'HUANCARQUI', 40407),
(388, 38, 'MACHAGUAY', 40408),
(389, 38, 'ORCOPAMPA', 40409),
(390, 38, 'PAMPACOLCA', 40410),
(391, 38, 'TIPAN', 40411),
(392, 38, 'UÑON', 40412),
(393, 38, 'URACA', 40413),
(394, 38, 'VIRACO', 40414),
(395, 39, 'CHIVAY', 40501),
(396, 39, 'ACHOMA', 40502),
(397, 39, 'CABANACONDE', 40503),
(398, 39, 'CALLALLI', 40504),
(399, 39, 'CAYLLOMA', 40505),
(400, 39, 'COPORAQUE', 40506),
(401, 39, 'HUAMBO', 40507),
(402, 39, 'HUANCA', 40508),
(403, 39, 'ICHUPAMPA', 40509),
(404, 39, 'LARI', 40510),
(405, 39, 'LLUTA', 40511),
(406, 39, 'MACA', 40512),
(407, 39, 'MADRIGAL', 40513),
(408, 39, 'SAN ANTONIO DE CHUCA', 40514),
(409, 39, 'SIBAYO', 40515),
(410, 39, 'TAPAY', 40516),
(411, 39, 'TISCO', 40517),
(412, 39, 'TUTI', 40518),
(413, 39, 'YANQUE', 40519),
(414, 39, 'MAJES', 40520),
(415, 40, 'CHUQUIBAMBA', 40601),
(416, 40, 'ANDARAY', 40602),
(417, 40, 'CAYARANI', 40603),
(418, 40, 'CHICHAS', 40604),
(419, 40, 'IRAY', 40605),
(420, 40, 'RIO GRANDE', 40606),
(421, 40, 'SALAMANCA', 40607),
(422, 40, 'YANAQUIHUA', 40608),
(423, 41, 'MOLLENDO', 40701),
(424, 41, 'COCACHACRA', 40702),
(425, 41, 'DEAN VALDIVIA', 40703),
(426, 41, 'ISLAY', 40704),
(427, 41, 'MEJIA', 40705),
(428, 41, 'PUNTA DE BOMBON', 40706),
(429, 42, 'COTAHUASI', 40801),
(430, 42, 'ALCA', 40802),
(431, 42, 'CHARCANA', 40803),
(432, 42, 'HUAYNACOTAS', 40804),
(433, 42, 'PAMPAMARCA', 40805),
(434, 42, 'PUYCA', 40806),
(435, 42, 'QUECHUALLA', 40807),
(436, 42, 'SAYLA', 40808),
(437, 42, 'TAURIA', 40809),
(438, 42, 'TOMEPAMPA', 40810),
(439, 42, 'TORO', 40811),
(440, 43, 'AYACUCHO', 50101),
(441, 43, 'ACOCRO', 50102),
(442, 43, 'ACOS VINCHOS', 50103),
(443, 43, 'CARMEN ALTO', 50104),
(444, 43, 'CHIARA', 50105),
(445, 43, 'OCROS', 50106),
(446, 43, 'PACAYCASA', 50107),
(447, 43, 'QUINUA', 50108),
(448, 43, 'SAN JOSE DE TICLLAS', 50109),
(449, 43, 'SAN JUAN BAUTISTA', 50110),
(450, 43, 'SANTIAGO DE PISCHA', 50111),
(451, 43, 'SOCOS', 50112),
(452, 43, 'TAMBILLO', 50113),
(453, 43, 'VINCHOS', 50114),
(454, 43, 'JESUS NAZARENO', 50115),
(455, 44, 'CANGALLO', 50201),
(456, 44, 'CHUSCHI', 50202),
(457, 44, 'LOS MOROCHUCOS', 50203),
(458, 44, 'MARIA PARADO DE BELLIDO', 50204),
(459, 44, 'PARAS', 50205),
(460, 44, 'TOTOS', 50206),
(461, 45, 'SANCOS', 50301),
(462, 45, 'CARAPO', 50302),
(463, 45, 'SACSAMARCA', 50303),
(464, 45, 'SANTIAGO DE LUCANAMARCA', 50304),
(465, 46, 'HUANTA', 50401),
(466, 46, 'AYAHUANCO', 50402),
(467, 46, 'HUAMANGUILLA', 50403),
(468, 46, 'IGUAIN', 50404),
(469, 46, 'LURICOCHA', 50405),
(470, 46, 'SANTILLANA', 50406),
(471, 46, 'SIVIA', 50407),
(472, 46, 'LLOCHEGUA', 50408),
(473, 47, 'SAN MIGUEL', 50501),
(474, 47, 'ANCO', 50502),
(475, 47, 'AYNA', 50503),
(476, 47, 'CHILCAS', 50504),
(477, 47, 'CHUNGUI', 50505),
(478, 47, 'LUIS CARRANZA', 50506),
(479, 47, 'SANTA ROSA', 50507),
(480, 47, 'TAMBO', 50508),
(481, 48, 'PUQUIO', 50601),
(482, 48, 'AUCARA', 50602),
(483, 48, 'CABANA', 50603),
(484, 48, 'CARMEN SALCEDO', 50604),
(485, 48, 'CHAVIÑA', 50605),
(486, 48, 'CHIPAO', 50606),
(487, 48, 'HUAC-HUAS', 50607),
(488, 48, 'LARAMATE', 50608),
(489, 48, 'LEONCIO PRADO', 50609),
(490, 48, 'LLAUTA', 50610),
(491, 48, 'LUCANAS', 50611),
(492, 48, 'OCAÑA', 50612),
(493, 48, 'OTOCA', 50613),
(494, 48, 'SAISA', 50614),
(495, 48, 'SAN CRISTOBAL', 50615),
(496, 48, 'SAN JUAN', 50616),
(497, 48, 'SAN PEDRO', 50617),
(498, 48, 'SAN PEDRO DE PALCO', 50618),
(499, 48, 'SANCOS', 50619),
(500, 48, 'SANTA ANA DE', 50620),
(501, 48, 'SANTA LUCIA', 50621),
(502, 49, 'CORACORA', 50701),
(503, 49, 'CHUMPI', 50702),
(504, 49, 'CORONEL CASTAÑEDA', 50703),
(505, 49, 'PACAPAUSA', 50704),
(506, 49, 'PULLO', 50705),
(507, 49, 'PUYUSCA', 50706),
(508, 49, 'SAN FRANCISCO DE', 50707),
(509, 49, 'UPAHUACHO', 50708),
(510, 50, 'PAUSA', 50801),
(511, 50, 'COLTA', 50802),
(512, 50, 'CORCULLA', 50803),
(513, 50, 'LAMPA', 50804),
(514, 50, 'MARCABAMBA', 50805),
(515, 50, 'OYOLO', 50806),
(516, 50, 'PARARCA', 50807),
(517, 50, 'SAN JAVIER DE ALPABAMBA', 50808),
(518, 50, 'SAN JOSE DE USHUA', 50809),
(519, 50, 'SARA SARA', 50810),
(520, 51, 'QUEROBAMBA', 50901),
(521, 51, 'BELEN', 50902),
(522, 51, 'CHALCOS', 50903),
(523, 51, 'CHILCAYOC', 50904),
(524, 51, 'HUACAÑA', 50905),
(525, 51, 'MORCOLLA', 50906),
(526, 51, 'PAICO', 50907),
(527, 51, 'SAN PEDRO DE LARCAY', 50908),
(528, 51, 'SAN SALVADOR DE QUIJE', 50909),
(529, 51, 'SANTIAGO DE PAUCARAY', 50910),
(530, 51, 'SORAS', 50911),
(531, 52, 'HUANCAPI', 51001),
(532, 52, 'ALCAMENCA', 51002),
(533, 52, 'APONGO', 51003),
(534, 52, 'ASQUIPATA', 51004),
(535, 52, 'CANARIA', 51005),
(536, 52, 'CAYARA', 51006),
(537, 52, 'COLCA', 51007),
(538, 52, 'HUAMANQUIQUIA', 51008),
(539, 52, 'HUANCARAYLLA', 51009),
(540, 52, 'HUAYA', 51010),
(541, 52, 'SARHUA', 51011),
(542, 52, 'VILCANCHOS', 51012),
(543, 53, 'VILCAS HUAMAN', 51101),
(544, 53, 'ACCOMARCA', 51102),
(545, 53, 'CARHUANCA', 51103),
(546, 53, 'CONCEPCION', 51104),
(547, 53, 'HUAMBALPA', 51105),
(548, 53, 'INDEPENDENCIA', 51106),
(549, 53, 'SAURAMA', 51107),
(550, 53, 'VISCHONGO', 51108),
(551, 54, 'CAJAMARCA', 60101),
(552, 54, 'ASUNCION', 60102),
(553, 54, 'CHETILLA', 60103),
(554, 54, 'COSPAN', 60104),
(555, 54, 'ENCAÑADA', 60105),
(556, 54, 'JESUS', 60106),
(557, 54, 'LLACANORA', 60107),
(558, 54, 'LOS BAÑOS DEL INCA', 60108),
(559, 54, 'MAGDALENA', 60109),
(560, 54, 'MATARA', 60110),
(561, 54, 'NAMORA', 60111),
(562, 54, 'SAN JUAN', 60112),
(563, 55, 'CAJABAMBA', 60201),
(564, 55, 'CACHACHI', 60202),
(565, 55, 'CONDEBAMBA', 60203),
(566, 55, 'SITACOCHA', 60204),
(567, 56, 'CELENDIN', 60301),
(568, 56, 'CHUMUCH', 60302),
(569, 56, 'CORTEGANA', 60303),
(570, 56, 'HUASMIN', 60304),
(571, 56, 'JORGE CHAVEZ', 60305),
(572, 56, 'JOSE GALVEZ', 60306),
(573, 56, 'MIGUEL IGLESIAS', 60307),
(574, 56, 'OXAMARCA', 60308),
(575, 56, 'SOROCHUCO', 60309),
(576, 56, 'SUCRE', 60310),
(577, 56, 'UTCO', 60311),
(578, 56, 'LA LIBERTAD DE PALLAN', 60312),
(579, 57, 'CHOTA', 60401),
(580, 57, 'ANGUIA', 60402),
(581, 57, 'CHADIN', 60403),
(582, 57, 'CHIGUIRIP', 60404),
(583, 57, 'CHIMBAN', 60405),
(584, 57, 'CHOROPAMPA', 60406),
(585, 57, 'COCHABAMBA', 60407),
(586, 57, 'CONCHAN', 60408),
(587, 57, 'HUAMBOS', 60409),
(588, 57, 'LAJAS', 60410),
(589, 57, 'LLAMA', 60411),
(590, 57, 'MIRACOSTA', 60412),
(591, 57, 'PACCHA', 60413),
(592, 57, 'PION', 60414),
(593, 57, 'QUEROCOTO', 60415),
(594, 57, 'SAN JUAN DE LICUPIS', 60416),
(595, 57, 'TACABAMBA', 60417),
(596, 57, 'TOCMOCHE', 60418),
(597, 57, 'CHALAMARCA', 60419),
(598, 58, 'CONTUMAZA', 60501),
(599, 58, 'CHILETE', 60502),
(600, 58, 'CUPISNIQUE', 60503),
(601, 58, 'GUZMANGO', 60504),
(602, 58, 'SAN BENITO', 60505),
(603, 58, 'SANTA CRUZ DE TOLED', 60506),
(604, 58, 'TANTARICA', 60507),
(605, 58, 'YONAN', 60508),
(606, 59, 'CUTERVO', 60601),
(607, 59, 'CALLAYUC', 60602),
(608, 59, 'CHOROS', 60603),
(609, 59, 'CUJILLO', 60604),
(610, 59, 'LA RAMADA', 60605),
(611, 59, 'PIMPINGOS', 60606),
(612, 59, 'QUEROCOTILLO', 60607),
(613, 59, 'SAN ANDRES DE CUTERVO', 60608),
(614, 59, 'SAN JUAN DE CUTERVO', 60609),
(615, 59, 'SAN LUIS DE LUCMA', 60610),
(616, 59, 'SANTA CRUZ', 60611),
(617, 59, 'SANTO DOMINGO DE LA', 60612),
(618, 59, 'SANTO TOMAS', 60613),
(619, 59, 'SOCOTA', 60614),
(620, 59, 'TORIBIO CASANOVA', 60615),
(621, 60, 'BAMBAMARCA', 60701),
(622, 60, 'CHUGUR', 60702),
(623, 60, 'HUALGAYOC', 60703),
(624, 61, 'JAEN', 60801),
(625, 61, 'BELLAVISTA', 60802),
(626, 61, 'CHONTALI', 60803),
(627, 61, 'COLASAY', 60804),
(628, 61, 'HUABAL', 60805),
(629, 61, 'LAS PIRIAS', 60806),
(630, 61, 'POMAHUACA', 60807),
(631, 61, 'PUCARA', 60808),
(632, 61, 'SALLIQUE', 60809),
(633, 61, 'SAN FELIPE', 60810),
(634, 61, 'SAN JOSE DEL ALTO', 60811),
(635, 61, 'SANTA ROSA', 60812),
(636, 62, 'SAN IGNACIO', 60901),
(637, 62, 'CHIRINOS', 60902),
(638, 62, 'HUARANGO', 60903),
(639, 62, 'LA COIPA', 60904),
(640, 62, 'NAMBALLE', 60905),
(641, 62, 'SAN JOSE DE LOURDES', 60906),
(642, 62, 'TABACONAS', 60907),
(643, 63, 'PEDRO GALVEZ', 61001),
(644, 63, 'CHANCAY', 61002),
(645, 63, 'EDUARDO VILLANUEVA', 61003),
(646, 63, 'GREGORIO PITA', 61004),
(647, 63, 'ICHOCAN', 61005),
(648, 63, 'JOSE MANUEL QUIROZ', 61006),
(649, 63, 'JOSE SABOGAL', 61007),
(650, 64, 'SAN MIGUEL', 61101),
(651, 64, 'BOLIVAR', 61102),
(652, 64, 'CALQUIS', 61103),
(653, 64, 'CATILLUC', 61104),
(654, 64, 'EL PRADO', 61105),
(655, 64, 'LA FLORIDA', 61106),
(656, 64, 'LLAPA', 61107),
(657, 64, 'NANCHOC', 61108),
(658, 64, 'NIEPOS', 61109),
(659, 64, 'SAN GREGORIO', 61110),
(660, 64, 'SAN SILVESTRE DE COCHAN', 61111),
(661, 64, 'TONGOD', 61112),
(662, 64, 'UNION AGUA BLANCA', 61113),
(663, 65, 'SAN PABLO', 61201),
(664, 65, 'SAN BERNARDINO', 61202),
(665, 65, 'SAN LUIS', 61203),
(666, 65, 'TUMBADEN', 61204),
(667, 66, 'SANTA CRUZ', 61301),
(668, 66, 'ANDABAMBA', 61302),
(669, 66, 'CATACHE', 61303),
(670, 66, 'CHANCAYBAÑOS', 61304),
(671, 66, 'LA ESPERANZA', 61305),
(672, 66, 'NINABAMBA', 61306),
(673, 66, 'PULAN', 61307),
(674, 66, 'SAUCEPAMPA', 61308),
(675, 66, 'SEXI', 61309),
(676, 66, 'UTICYACU', 61310),
(677, 66, 'YAUYUCAN', 61311),
(678, 67, 'CALLAO', 70101),
(679, 67, 'BELLAVISTA', 70102),
(680, 67, 'CARMEN DE LA LEGUA', 70103),
(681, 67, 'LA PERLA', 70104),
(682, 67, 'LA PUNTA', 70105),
(683, 67, 'VENTANILLA', 70106),
(684, 68, 'CUSCO', 80101),
(685, 68, 'CCORCA', 80102),
(686, 68, 'POROY', 80103),
(687, 68, 'SAN JERONIMO', 80104),
(688, 68, 'SAN SEBASTIAN', 80105),
(689, 68, 'SANTIAGO', 80106),
(690, 68, 'SAYLLA', 80107),
(691, 68, 'WANCHAQ', 80108),
(692, 69, 'ACOMAYO', 80201),
(693, 69, 'ACOPIA', 80202),
(694, 69, 'ACOS', 80203),
(695, 69, 'MOSOC LLACTA', 80204),
(696, 69, 'POMACANCHI', 80205),
(697, 69, 'RONDOCAN', 80206),
(698, 69, 'SANGARARA', 80207),
(699, 70, 'ANTA', 80301),
(700, 70, 'ANCAHUASI', 80302),
(701, 70, 'CACHIMAYO', 80303),
(702, 70, 'CHINCHAYPUJIO', 80304),
(703, 70, 'HUAROCONDO', 80305),
(704, 70, 'LIMATAMBO', 80306),
(705, 70, 'MOLLEPATA', 80307),
(706, 70, 'PUCYURA', 80308),
(707, 70, 'ZURITE', 80309),
(708, 71, 'CALCA', 80401),
(709, 71, 'COYA', 80402),
(710, 71, 'LAMAY', 80403),
(711, 71, 'LARES', 80404),
(712, 71, 'PISAC', 80405),
(713, 71, 'SAN SALVADOR', 80406),
(714, 71, 'TARAY', 80407),
(715, 71, 'YANATILE', 80408),
(716, 72, 'YANAOCA', 80501),
(717, 72, 'CHECCA', 80502),
(718, 72, 'KUNTURKANKI', 80503),
(719, 72, 'LANGUI', 80504),
(720, 72, 'LAYO', 80505),
(721, 72, 'PAMPAMARCA', 80506),
(722, 72, 'QUEHUE', 80507),
(723, 72, 'TUPAC AMARU', 80508),
(724, 73, 'SICUANI', 80601),
(725, 73, 'CHECACUPE', 80602),
(726, 73, 'COMBAPATA', 80603),
(727, 73, 'MARANGANI', 80604),
(728, 73, 'PITUMARCA', 80605),
(729, 73, 'SAN PABLO', 80606),
(730, 73, 'SAN PEDRO', 80607),
(731, 73, 'TINTA', 80608),
(732, 74, 'SANTO TOMAS', 80701),
(733, 74, 'CAPACMARCA', 80702),
(734, 74, 'CHAMACA', 80703),
(735, 74, 'COLQUEMARCA', 80704),
(736, 74, 'LIVITACA', 80705),
(737, 74, 'LLUSCO', 80706),
(738, 74, 'QUIÑOTA', 80707),
(739, 74, 'VELILLE', 80708),
(740, 75, 'ESPINAR', 80801),
(741, 75, 'CONDOROMA', 80802),
(742, 75, 'COPORAQUE', 80803),
(743, 75, 'OCORURO', 80804),
(744, 75, 'PALLPATA', 80805),
(745, 75, 'PICHIGUA', 80806),
(746, 75, 'SUYCKUTAMBO', 80807),
(747, 75, 'ALTO PICHIGUA', 80808),
(748, 76, 'SANTA ANA', 80901),
(749, 76, 'ECHARATE', 80902),
(750, 76, 'HUAYOPATA', 80903),
(751, 76, 'MARANURA', 80904),
(752, 76, 'OCOBAMBA', 80905),
(753, 76, 'QUELLOUNO', 80906),
(754, 76, 'KIMBIRI', 80907),
(755, 76, 'SANTA TERESA', 80908),
(756, 76, 'VILCABAMBA', 80909),
(757, 76, 'PICHARI', 80910),
(758, 77, 'PARURO', 81001),
(759, 77, 'ACCHA', 81002),
(760, 77, 'CCAPI', 81003),
(761, 77, 'COLCHA', 81004),
(762, 77, 'HUANOQUITE', 81005),
(763, 77, 'OMACHA', 81006),
(764, 77, 'PACCARITAMBO', 81007),
(765, 77, 'PILLPINTO', 81008),
(766, 77, 'YAURISQUE', 81009),
(767, 78, 'PAUCARTAMBO', 81101),
(768, 78, 'CAICAY', 81102),
(769, 78, 'CHALLABAMBA', 81103),
(770, 78, 'COLQUEPATA', 81104),
(771, 78, 'HUANCARANI', 81105),
(772, 78, 'KOSÑIPATA', 81106),
(773, 79, 'URCOS', 81201),
(774, 79, 'ANDAHUAYLILLAS', 81202),
(775, 79, 'CAMANTI', 81203),
(776, 79, 'CCARHUAYO', 81204),
(777, 79, 'CCATCA', 81205),
(778, 79, 'CUSIPATA', 81206),
(779, 79, 'HUARO', 81207),
(780, 79, 'LUCRE', 81208),
(781, 79, 'MARCAPATA', 81209),
(782, 79, 'OCONGATE', 81210),
(783, 79, 'OROPESA', 81211),
(784, 79, 'QUIQUIJANA', 81212),
(785, 80, 'URUBAMBA', 81301),
(786, 80, 'CHINCHERO', 81302),
(787, 80, 'HUAYLLABAMBA', 81303),
(788, 80, 'MACHUPICCHU', 81304),
(789, 80, 'MARAS', 81305),
(790, 80, 'OLLANTAYTAMBO', 81306),
(791, 80, 'YUCAY', 81307),
(792, 81, 'HUANCAVELICA', 90101),
(793, 81, 'ACOBAMBILLA', 90102),
(794, 81, 'ACORIA', 90103),
(795, 81, 'CONAYCA', 90104),
(796, 81, 'CUENCA', 90105),
(797, 81, 'HUACHOCOLPA', 90106),
(798, 81, 'HUAYLLAHUARA', 90107),
(799, 81, 'IZCUCHACA', 90108),
(800, 81, 'LARIA', 90109),
(801, 81, 'MANTA', 90110),
(802, 81, 'MARISCAL CACERES', 90111),
(803, 81, 'MOYA', 90112),
(804, 81, 'NUEVO OCCORO', 90113),
(805, 81, 'PALCA', 90114),
(806, 81, 'PILCHACA', 90115),
(807, 81, 'VILCA', 90116),
(808, 81, 'YAULI', 90117),
(809, 81, 'ASCENSION', 90118),
(810, 81, 'HUANDO', 90119),
(811, 82, 'ACOBAMBA', 90201),
(812, 82, 'ANDABAMBA', 90202),
(813, 82, 'ANTA', 90203),
(814, 82, 'CAJA', 90204),
(815, 82, 'MARCAS', 90205),
(816, 82, 'PAUCARA', 90206),
(817, 82, 'POMACOCHA', 90207),
(818, 82, 'ROSARIO', 90208),
(819, 83, 'LIRCAY', 90301),
(820, 83, 'ANCHONGA', 90302),
(821, 83, 'CALLANMARCA', 90303),
(822, 83, 'CCOCHACCASA', 90304),
(823, 83, 'CHINCHO', 90305),
(824, 83, 'CONGALLA', 90306),
(825, 83, 'HUANCA-HUANCA', 90307),
(826, 83, 'HUAYLLAY GRANDE', 90308),
(827, 83, 'JULCAMARCA', 90309),
(828, 83, 'SAN ANTONIO DE ANTAPARCO', 90310),
(829, 83, 'SANTO TOMAS DE PATA', 90311),
(830, 83, 'SECCLLA', 90312),
(831, 84, 'CASTROVIRREYNA', 90401),
(832, 84, 'ARMA', 90402),
(833, 84, 'AURAHUA', 90403),
(834, 84, 'CAPILLAS', 90404),
(835, 84, 'CHUPAMARCA', 90405),
(836, 84, 'COCAS', 90406),
(837, 84, 'HUACHOS', 90407),
(838, 84, 'HUAMATAMBO', 90408),
(839, 84, 'MOLLEPAMPA', 90409),
(840, 84, 'SAN JUAN', 90410),
(841, 84, 'SANTA ANA', 90411),
(842, 84, 'TANTARA', 90412),
(843, 84, 'TICRAPO', 90413),
(844, 85, 'CHURCAMPA', 90501),
(845, 85, 'ANCO', 90502),
(846, 85, 'CHINCHIHUASI', 90503),
(847, 85, 'EL CARMEN', 90504),
(848, 85, 'LA MERCED', 90505),
(849, 85, 'LOCROJA', 90506),
(850, 85, 'PAUCARBAMBA', 90507),
(851, 85, 'SAN MIGUEL DE MAYOCC', 90508),
(852, 85, 'SAN PEDRO DE CORIS', 90509),
(853, 85, 'PACHAMARCA', 90510),
(854, 86, 'HUAYTARA', 90601),
(855, 86, 'AYAVI', 90602),
(856, 86, 'CORDOVA', 90603),
(857, 86, 'HUAYACUNDO ARMA', 90604),
(858, 86, 'LARAMARCA', 90605),
(859, 86, 'OCOYO', 90606),
(860, 86, 'PILPICHACA', 90607),
(861, 86, 'QUERCO', 90608),
(862, 86, 'QUITO-ARMA', 90609),
(863, 86, 'SAN ANTONIO DE CUSICANCHA', 90610),
(864, 86, 'SAN FRANCISCO DE', 90611),
(865, 86, 'SAN ISIDRO', 90612),
(866, 86, 'SANTIAGO DE CHOCORVOS', 90613),
(867, 86, 'SANTIAGO DE QUIRAHUARA', 90614),
(868, 86, 'SANTO DOMINGO DE CAPILLAS', 90615),
(869, 86, 'TAMBO', 90616),
(870, 87, 'PAMPAS', 90701),
(871, 87, 'ACOSTAMBO', 90702),
(872, 87, 'ACRAQUIA', 90703),
(873, 87, 'AHUAYCHA', 90704),
(874, 87, 'COLCABAMBA', 90705),
(875, 87, 'DANIEL HERNANDEZ', 90706),
(876, 87, 'HUACHOCOLPA', 90707),
(877, 87, 'HUARIBAMBA', 90709),
(878, 87, 'ÑAHUIMPUQUIO', 90710),
(879, 87, 'PAZOS', 90711),
(880, 87, 'QUISHUAR', 90713),
(881, 87, 'SALCABAMBA', 90714),
(882, 87, 'SALCAHUASI', 90715),
(883, 87, 'SAN MARCOS DE ROCCHAC', 90716),
(884, 87, 'SURCUBAMBA', 90717),
(885, 87, 'TINTAY PUNCU', 90718),
(886, 88, 'HUANUCO', 100101),
(887, 88, 'AMARILIS', 100102),
(888, 88, 'CHINCHAO', 100103),
(889, 88, 'CHURUBAMBA', 100104),
(890, 88, 'MARGOS', 100105),
(891, 88, 'QUISQUI', 100106),
(892, 88, 'SAN FRANCISCO DE CAYRAN', 100107),
(893, 88, 'SAN PEDRO DE CHAULAN', 100108),
(894, 88, 'SANTA MARIA DEL VALLE', 100109),
(895, 88, 'YARUMAYO', 100110),
(896, 88, 'PILLCO MARCA', 100111),
(897, 89, 'AMBO', 100201),
(898, 89, 'CAYNA', 100202),
(899, 89, 'COLPAS', 100203),
(900, 89, 'CONCHAMARCA', 100204),
(901, 89, 'HUACAR', 100205),
(902, 89, 'SAN FRANCISCO', 100206),
(903, 89, 'SAN RAFAEL', 100207),
(904, 89, 'TOMAY KICHWA', 100208),
(905, 90, 'LA UNION', 100301),
(906, 90, 'CHUQUIS', 100307),
(907, 90, 'MARIAS', 100311),
(908, 90, 'PACHAS', 100313),
(909, 90, 'QUIVILLA', 100316),
(910, 90, 'RIPAN', 100317),
(911, 90, 'SHUNQUI', 100321),
(912, 90, 'SILLAPATA', 100322),
(913, 90, 'YANAS', 100323),
(914, 91, 'HUACAYBAMBA', 100401),
(915, 91, 'CANCHABAMBA', 100402),
(916, 91, 'COCHABAMBA', 100403),
(917, 91, 'PINRA', 100404),
(918, 92, 'LLATA', 100501),
(919, 92, 'ARANCAY', 100502),
(920, 92, 'CHAVIN DE PARIARCA', 100503),
(921, 92, 'JACAS GRANDE', 100504),
(922, 92, 'JIRCAN', 100505),
(923, 92, 'MIRAFLORES', 100506),
(924, 92, 'MONZON', 100507),
(925, 92, 'PUNCHAO', 100508),
(926, 92, 'PUÑOS', 100509),
(927, 92, 'SINGA', 100510),
(928, 92, 'TANTAMAYO', 100511),
(929, 93, 'RUPA-RUPA', 100601),
(930, 93, 'DANIEL ALOMIA ROBLES', 100602),
(931, 93, 'HERMILIO VALDIZAN', 100603),
(932, 93, 'JOSE CRESPO Y CASTILLO', 100604),
(933, 93, 'LUYANDO', 100605),
(934, 93, 'MARIANO DAMASO BERAUN', 100606),
(935, 94, 'HUACRACHUCO', 100701),
(936, 94, 'CHOLON', 100702),
(937, 94, 'SAN BUENAVENTURA', 100703),
(938, 95, 'PANAO', 100801),
(939, 95, 'CHAGLLA', 100802),
(940, 95, 'MOLINO', 100803),
(941, 95, 'UMARI', 100804),
(942, 96, 'PUERTO INCA', 100901),
(943, 96, 'CODO DEL POZUZO', 100902),
(944, 96, 'HONORIA', 100903),
(945, 96, 'TOURNAVISTA', 100904),
(946, 96, 'YUYAPICHIS', 100905),
(947, 97, 'JESUS', 101001),
(948, 97, 'BAÑOS', 101002),
(949, 97, 'JIVIA', 101003),
(950, 97, 'QUEROPALCA', 101004),
(951, 97, 'RONDOS', 101005),
(952, 97, 'SAN FRANCISCO DE ASIS', 101006),
(953, 97, 'SAN MIGUEL DE CAURI', 101007),
(954, 98, 'CHAVINILLO', 101101),
(955, 98, 'CAHUAC', 101102),
(956, 98, 'CHACABAMBA', 101103),
(957, 98, 'APARICIO POMARES', 101104),
(958, 98, 'JACAS CHICO', 101105),
(959, 98, 'OBAS', 101106),
(960, 98, 'PAMPAMARCA', 101107),
(961, 98, 'CHORAS', 101108),
(962, 99, 'ICA', 110101),
(963, 99, 'LA TINGUIÑA', 110102),
(964, 99, 'LOS AQUIJES', 110103),
(965, 99, 'OCUCAJE', 110104),
(966, 99, 'PACHACUTEC', 110105),
(967, 99, 'PARCONA', 110106),
(968, 99, 'PUEBLO NUEVO', 110107),
(969, 99, 'SALAS', 110108),
(970, 99, 'SAN JOSE DE LOS MOLINOS', 110109),
(971, 99, 'SAN JUAN BAUTISTA', 110110),
(972, 99, 'SANTIAGO', 110111),
(973, 99, 'SUBTANJALLA', 110112),
(974, 99, 'TATE', 110113),
(975, 99, 'YAUCA DEL ROSARIO', 110114),
(976, 100, 'CHINCHA ALTA', 110201),
(977, 100, 'ALTO LARAN', 110202),
(978, 100, 'CHAVIN', 110203),
(979, 100, 'CHINCHA BAJA', 110204),
(980, 100, 'EL CARMEN', 110205),
(981, 100, 'GROCIO PRADO', 110206),
(982, 100, 'PUEBLO NUEVO', 110207),
(983, 100, 'SAN JUAN DE YANAC', 110208),
(984, 100, 'SAN PEDRO DE HUACARPANA', 110209),
(985, 100, 'SUNAMPE', 110210),
(986, 100, 'TAMBO DE MORA', 110211),
(987, 101, 'NAZCA', 110301),
(988, 101, 'CHANGUILLO', 110302),
(989, 101, 'EL INGENIO', 110303),
(990, 101, 'MARCONA', 110304),
(991, 101, 'VISTA ALEGRE', 110305),
(992, 102, 'PALPA', 110401),
(993, 102, 'LLIPATA', 110402),
(994, 102, 'RIO GRANDE', 110403),
(995, 102, 'SANTA CRUZ', 110404),
(996, 102, 'TIBILLO', 110405),
(997, 103, 'PISCO', 110501),
(998, 103, 'HUANCANO', 110502),
(999, 103, 'HUMAY', 110503),
(1000, 103, 'INDEPENDENCIA', 110504),
(1001, 103, 'PARACAS', 110505),
(1002, 103, 'SAN ANDRES', 110506),
(1003, 103, 'SAN CLEMENTE', 110507),
(1004, 103, 'TUPAC AMARU INCA', 110508),
(1005, 104, 'HUANCAYO', 120101),
(1006, 104, 'CARHUACALLANGA', 120104),
(1007, 104, 'CHACAPAMPA', 120105),
(1008, 104, 'CHICCHE', 120106),
(1009, 104, 'CHILCA', 120107),
(1010, 104, 'CHONGOS ALTO', 120108),
(1011, 104, 'CHUPURO', 120111),
(1012, 104, 'COLCA', 120112),
(1013, 104, 'CULLHUAS', 120113),
(1014, 104, 'EL TAMBO', 120114),
(1015, 104, 'HUACRAPUQUIO', 120116),
(1016, 104, 'HUALHUAS', 120117),
(1017, 104, 'HUANCAN', 120119),
(1018, 104, 'HUASICANCHA', 120120),
(1019, 104, 'HUAYUCACHI', 120121),
(1020, 104, 'INGENIO', 120122),
(1021, 104, 'PARIAHUANCA', 120124),
(1022, 104, 'PILCOMAYO', 120125),
(1023, 104, 'PUCARA', 120126),
(1024, 104, 'QUICHUAY', 120127),
(1025, 104, 'QUILCAS', 120128),
(1026, 104, 'SAN AGUSTIN', 120129),
(1027, 104, 'SAN JERONIMO DE TUNAN', 120130),
(1028, 104, 'SAÑO', 120132),
(1029, 104, 'SAPALLANGA', 120133),
(1030, 104, 'SICAYA', 120134),
(1031, 104, 'SANTO DOMINGO DE', 120135),
(1032, 104, 'VIQUES', 120136),
(1033, 105, 'CONCEPCION', 120201),
(1034, 105, 'ACO', 120202),
(1035, 105, 'ANDAMARCA', 120203),
(1036, 105, 'CHAMBARA', 120204),
(1037, 105, 'COCHAS', 120205),
(1038, 105, 'COMAS', 120206),
(1039, 105, 'HEROINAS TOLEDO', 120207),
(1040, 105, 'MANZANARES', 120208),
(1041, 105, 'MARISCAL CASTILLA', 120209),
(1042, 105, 'MATAHUASI', 120210),
(1043, 105, 'MITO', 120211),
(1044, 105, 'NUEVE DE JULIO', 120212),
(1045, 105, 'ORCOTUNA', 120213),
(1046, 105, 'SAN JOSE DE QUERO', 120214),
(1047, 105, 'SANTA ROSA DE OCOPA', 120215),
(1048, 106, 'CHANCHAMAYO', 120301),
(1049, 106, 'PERENE', 120302),
(1050, 106, 'PICHANAQUI', 120303),
(1051, 106, 'SAN LUIS DE SHUARO', 120304),
(1052, 106, 'SAN RAMON', 120305),
(1053, 106, 'VITOC', 120306),
(1054, 107, 'JAUJA', 120401),
(1055, 107, 'ACOLLA', 120402),
(1056, 107, 'APATA', 120403),
(1057, 107, 'ATAURA', 120404),
(1058, 107, 'CANCHAYLLO', 120405),
(1059, 107, 'CURICACA', 120406),
(1060, 107, 'EL MANTARO', 120407),
(1061, 107, 'HUAMALI', 120408),
(1062, 107, 'HUARIPAMPA', 120409),
(1063, 107, 'HUERTAS', 120410),
(1064, 107, 'JANJAILLO', 120411),
(1065, 107, 'JULCAN', 120412),
(1066, 107, 'LEONOR ORDOÑEZ', 120413),
(1067, 107, 'LLOCLLAPAMPA', 120414),
(1068, 107, 'MARCO', 120415),
(1069, 107, 'MASMA', 120416),
(1070, 107, 'MASMA CHICCHE', 120417),
(1071, 107, 'MOLINOS', 120418),
(1072, 107, 'MONOBAMBA', 120419),
(1073, 107, 'MUQUI', 120420),
(1074, 107, 'MUQUIYAUYO', 120421),
(1075, 107, 'PACA', 120422),
(1076, 107, 'PACCHA', 120423),
(1077, 107, 'PANCAN', 120424),
(1078, 107, 'PARCO', 120425),
(1079, 107, 'POMACANCHA', 120426),
(1080, 107, 'RICRAN', 120427),
(1081, 107, 'SAN LORENZO', 120428),
(1082, 107, 'SAN PEDRO DE CHUNAN', 120429),
(1083, 107, 'SAUSA', 120430),
(1084, 107, 'SINCOS', 120431),
(1085, 107, 'TUNAN MARCA', 120432),
(1086, 107, 'YAULI', 120433),
(1087, 107, 'YAUYOS', 120434),
(1088, 108, 'JUNIN', 120501),
(1089, 108, 'CARHUAMAYO', 120502),
(1090, 108, 'ONDORES', 120503),
(1091, 108, 'ULCUMAYO', 120504),
(1092, 109, 'SATIPO', 120601),
(1093, 109, 'COVIRIALI', 120602),
(1094, 109, 'LLAYLLA', 120603),
(1095, 109, 'MAZAMARI', 120604),
(1096, 109, 'PAMPA HERMOSA', 120605),
(1097, 109, 'PANGOA', 120606),
(1098, 109, 'RIO NEGRO', 120607),
(1099, 109, 'RIO TAMBO', 120608),
(1100, 110, 'TARMA', 120701),
(1101, 110, 'ACOBAMBA', 120702),
(1102, 110, 'HUARICOLCA', 120703),
(1103, 110, 'HUASAHUASI', 120704),
(1104, 110, 'LA UNION', 120705),
(1105, 110, 'PALCA', 120706),
(1106, 110, 'PALCAMAYO', 120707),
(1107, 110, 'SAN PEDRO DE CAJAS', 120708),
(1108, 110, 'TAPO', 120709),
(1109, 111, 'LA OROYA', 120801),
(1110, 111, 'CHACAPALPA', 120802),
(1111, 111, 'HUAY-HUAY', 120803),
(1112, 111, 'MARCAPOMACOCHA', 120804),
(1113, 111, 'MOROCOCHA', 120805),
(1114, 111, 'PACCHA', 120806),
(1115, 111, 'SANTA BARBARA DE', 120807),
(1116, 111, 'SANTA ROSA DE SACCO', 120808),
(1117, 111, 'SUITUCANCHA', 120809),
(1118, 111, 'YAULI', 120810),
(1119, 112, 'CHUPACA', 120901),
(1120, 112, 'AHUAC', 120902),
(1121, 112, 'CHONGOS BAJO', 120903),
(1122, 112, 'HUACHAC', 120904),
(1123, 112, 'HUAMANCACA CHICO', 120905),
(1124, 112, 'SAN JUAN DE ISCOS', 120906),
(1125, 112, 'SAN JUAN DE JARPA', 120907),
(1126, 112, 'TRES DE DICIEMBRE', 120908),
(1127, 112, 'YANACANCHA', 120909),
(1128, 113, 'TRUJILLO', 130101),
(1129, 113, 'EL PORVENIR', 130102),
(1130, 113, 'FLORENCIA DE MORA', 130103),
(1131, 113, 'HUANCHACO', 130104),
(1132, 113, 'LA ESPERANZA', 130105),
(1133, 113, 'LAREDO', 130106),
(1134, 113, 'MOCHE', 130107),
(1135, 113, 'POROTO', 130108),
(1136, 113, 'SALAVERRY', 130109),
(1137, 113, 'SIMBAL', 130110),
(1138, 113, 'VICTOR LARCO HERRERA', 130111),
(1139, 114, 'ASCOPE', 130201),
(1140, 114, 'CHICAMA', 130202),
(1141, 114, 'CHOCOPE', 130203),
(1142, 114, 'MAGDALENA DE CAO', 130204),
(1143, 114, 'PAIJAN', 130205),
(1144, 114, 'RAZURI', 130206),
(1145, 114, 'SANTIAGO DE CAO', 130207),
(1146, 114, 'CASA GRANDE', 130208),
(1147, 115, 'BOLIVAR', 130301),
(1148, 115, 'BAMBAMARCA', 130302),
(1149, 115, 'CONDORMARCA', 130303),
(1150, 115, 'LONGOTEA', 130304),
(1151, 115, 'UCHUMARCA', 130305),
(1152, 115, 'UCUNCHA', 130306),
(1153, 116, 'CHEPEN', 130401),
(1154, 116, 'PACANGA', 130402),
(1155, 116, 'PUEBLO NUEVO', 130403),
(1156, 117, 'JULCAN', 130501),
(1157, 117, 'CALAMARCA', 130502),
(1158, 117, 'CARABAMBA', 130503),
(1159, 117, 'HUASO', 130504),
(1160, 118, 'OTUZCO', 130601),
(1161, 118, 'AGALLPAMPA', 130602),
(1162, 118, 'CHARAT', 130604),
(1163, 118, 'HUARANCHAL', 130605),
(1164, 118, 'LA CUESTA', 130606),
(1165, 118, 'MACHE', 130608),
(1166, 118, 'PARANDAY', 130610),
(1167, 118, 'SALPO', 130611),
(1168, 118, 'SINSICAP', 130613),
(1169, 118, 'USQUIL', 130614),
(1170, 119, 'SAN PEDRO DE LLOC', 130701),
(1171, 119, 'GUADALUPE', 130702),
(1172, 119, 'JEQUETEPEQUE', 130703),
(1173, 119, 'PACASMAYO', 130704),
(1174, 119, 'SAN JOSE', 130705),
(1175, 120, 'TAYABAMBA', 130801),
(1176, 120, 'BULDIBUYO', 130802),
(1177, 120, 'CHILLIA', 130803),
(1178, 120, 'HUANCASPATA', 130804),
(1179, 120, 'HUAYLILLAS', 130805),
(1180, 120, 'HUAYO', 130806),
(1181, 120, 'ONGON', 130807),
(1182, 120, 'PARCOY', 130808),
(1183, 120, 'PATAZ', 130809),
(1184, 120, 'PIAS', 130810),
(1185, 120, 'SANTIAGO DE CHALLAS', 130811),
(1186, 120, 'TAURIJA', 130812),
(1187, 120, 'URPAY', 130813),
(1188, 121, 'HUAMACHUCO', 130901),
(1189, 121, 'CHUGAY', 130902),
(1190, 121, 'COCHORCO', 130903),
(1191, 121, 'CURGOS', 130904),
(1192, 121, 'MARCABAL', 130905),
(1193, 121, 'SANAGORAN', 130906),
(1194, 121, 'SARIN', 130907),
(1195, 121, 'SARTIMBAMBA', 130908),
(1196, 122, 'SANTIAGO DE CHUCO', 131001),
(1197, 122, 'ANGASMARCA', 131002),
(1198, 122, 'CACHICADAN', 131003),
(1199, 122, 'MOLLEBAMBA', 131004),
(1200, 122, 'MOLLEPATA', 131005),
(1201, 122, 'QUIRUVILCA', 131006),
(1202, 122, 'SANTA CRUZ DE CHUCA', 131007),
(1203, 122, 'SITABAMBA', 131008),
(1204, 123, 'CASCAS', 131101),
(1205, 123, 'LUCMA', 131102),
(1206, 123, 'COMPIN', 131103),
(1207, 123, 'SAYAPULLO', 131104),
(1208, 124, 'VIRU', 131201),
(1209, 124, 'CHAO', 131202),
(1210, 124, 'GUADALUPITO', 131203),
(1211, 125, 'CHICLAYO', 140101),
(1212, 125, 'CHONGOYAPE', 140102),
(1213, 125, 'ETEN', 140103),
(1214, 125, 'ETEN PUERTO', 140104),
(1215, 125, 'JOSE LEONARDO ORTIZ', 140105),
(1216, 125, 'LA VICTORIA', 140106),
(1217, 125, 'LAGUNAS', 140107),
(1218, 125, 'MONSEFU', 140108),
(1219, 125, 'NUEVA ARICA', 140109),
(1220, 125, 'OYOTUN', 140110),
(1221, 125, 'PICSI', 140111),
(1222, 125, 'PIMENTEL', 140112),
(1223, 125, 'REQUE', 140113),
(1224, 125, 'SANTA ROSA', 140114),
(1225, 125, 'SAÑA', 140115),
(1226, 125, 'CAYALTI', 140116),
(1227, 125, 'PATAPO', 140117),
(1228, 125, 'POMALCA', 140118),
(1229, 125, 'PUCALA', 140119),
(1230, 125, 'TUMAN', 140120),
(1231, 126, 'FERREÑAFE', 140201),
(1232, 126, 'CAÑARIS', 140202),
(1233, 126, 'INCAHUASI', 140203),
(1234, 126, 'MANUEL ANTONIO MESONES', 140204),
(1235, 126, 'PITIPO', 140205),
(1236, 126, 'PUEBLO NUEVO', 140206),
(1237, 127, 'LAMBAYEQUE', 140301),
(1238, 127, 'CHOCHOPE', 140302),
(1239, 127, 'ILLIMO', 140303),
(1240, 127, 'JAYANCA', 140304),
(1241, 127, 'MOCHUMI', 140305),
(1242, 127, 'MORROPE', 140306),
(1243, 127, 'MOTUPE', 140307),
(1244, 127, 'OLMOS', 140308),
(1245, 127, 'PACORA', 140309),
(1246, 127, 'SALAS', 140310),
(1247, 127, 'SAN JOSE', 140311),
(1248, 127, 'TUCUME', 140312),
(1249, 128, 'LIMA', 150101),
(1250, 128, 'ANCON', 150102),
(1251, 128, 'ATE', 150103),
(1252, 128, 'BARRANCO', 150104),
(1253, 128, 'BREÑA', 150105),
(1254, 128, 'CARABAYLLO', 150106),
(1255, 128, 'CHACLACAYO', 150107),
(1256, 128, 'CHORRILLOS', 150108),
(1257, 128, 'CIENEGUILLA', 150109),
(1258, 128, 'COMAS', 150110),
(1259, 128, 'EL AGUSTINO', 150111),
(1260, 128, 'INDEPENDENCIA', 150112),
(1261, 128, 'JESUS MARIA', 150113),
(1262, 128, 'LA MOLINA', 150114),
(1263, 128, 'LA VICTORIA', 150115),
(1264, 128, 'LINCE', 150116),
(1265, 128, 'LOS OLIVOS', 150117),
(1266, 128, 'LURIGANCHO', 150118),
(1267, 128, 'LURIN', 150119),
(1268, 128, 'MAGDALENA DEL MAR', 150120),
(1269, 128, 'MAGDALENA VIEJA', 150121),
(1270, 128, 'MIRAFLORES', 150122),
(1271, 128, 'PACHACAMAC', 150123),
(1272, 128, 'PUCUSANA', 150124),
(1273, 128, 'PUENTE PIEDRA', 150125),
(1274, 128, 'PUNTA HERMOSA', 150126),
(1275, 128, 'PUNTA NEGRA', 150127),
(1276, 128, 'RIMAC', 150128),
(1277, 128, 'SAN BARTOLO', 150129),
(1278, 128, 'SAN BORJA', 150130),
(1279, 128, 'SAN ISIDRO', 150131),
(1280, 128, 'SAN JUAN DE LURIGANCHO', 150132),
(1281, 128, 'SAN JUAN DE MIRAFLORES', 150133),
(1282, 128, 'SAN LUIS', 150134),
(1283, 128, 'SAN MARTIN DE PORRES', 150135),
(1284, 128, 'SAN MIGUEL', 150136),
(1285, 128, 'SANTA ANITA', 150137),
(1286, 128, 'SANTA MARIA DEL MAR', 150138),
(1287, 128, 'SANTA ROSA', 150139),
(1288, 128, 'SANTIAGO DE SURCO', 150140),
(1289, 128, 'SURQUILLO', 150141),
(1290, 128, 'VILLA EL SALVADOR', 150142),
(1291, 128, 'VILLA MARIA DEL TRIUNFO', 150143),
(1292, 129, 'BARRANCA', 150201),
(1293, 129, 'PARAMONGA', 150202),
(1294, 129, 'PATIVILCA', 150203),
(1295, 129, 'SUPE', 150204),
(1296, 129, 'SUPE PUERTO', 150205),
(1297, 130, 'CAJATAMBO', 150301),
(1298, 130, 'COPA', 150302),
(1299, 130, 'GORGOR', 150303),
(1300, 130, 'HUANCAPON', 150304),
(1301, 130, 'MANAS', 150305),
(1302, 131, 'CANTA', 150401),
(1303, 131, 'ARAHUAY', 150402),
(1304, 131, 'HUAMANTANGA', 150403),
(1305, 131, 'HUAROS', 150404),
(1306, 131, 'LACHAQUI', 150405),
(1307, 131, 'SAN BUENAVENTURA', 150406),
(1308, 131, 'SANTA ROSA DE QUIVES', 150407),
(1309, 132, 'SAN VICENTE DE CAÑETE', 150501),
(1310, 132, 'ASIA', 150502),
(1311, 132, 'CALANGO', 150503),
(1312, 132, 'CERRO AZUL', 150504),
(1313, 132, 'CHILCA', 150505),
(1314, 132, 'COAYLLO', 150506),
(1315, 132, 'IMPERIAL', 150507),
(1316, 132, 'LUNAHUANA', 150508),
(1317, 132, 'MALA', 150509),
(1318, 132, 'NUEVO IMPERIAL', 150510),
(1319, 132, 'PACARAN', 150511),
(1320, 132, 'QUILMANA', 150512),
(1321, 132, 'SAN ANTONIO', 150513),
(1322, 132, 'SAN LUIS', 150514),
(1323, 132, 'SANTA CRUZ DE FLORES', 150515),
(1324, 132, 'ZUÑIGA', 150516),
(1325, 133, 'HUARAL', 150601),
(1326, 133, 'ATAVILLOS ALTO', 150602),
(1327, 133, 'ATAVILLOS BAJO', 150603),
(1328, 133, 'AUCALLAMA', 150604),
(1329, 133, 'CHANCAY', 150605),
(1330, 133, 'IHUARI', 150606),
(1331, 133, 'LAMPIAN', 150607),
(1332, 133, 'PACARAOS', 150608),
(1333, 133, 'SAN MIGUEL DE ACOS', 150609),
(1334, 133, 'SANTA CRUZ DE ANDAMARCA', 150610),
(1335, 133, 'SUMBILCA', 150611),
(1336, 133, 'VEINTISIETE DE NOVIEMBRE', 150612),
(1337, 134, 'MATUCANA', 150701),
(1338, 134, 'ANTIOQUIA', 150702),
(1339, 134, 'CALLAHUANCA', 150703),
(1340, 134, 'CARAMPOMA', 150704),
(1341, 134, 'CHICLA', 150705),
(1342, 134, 'CUENCA', 150706),
(1343, 134, 'HUACHUPAMPA', 150707),
(1344, 134, 'HUANZA', 150708),
(1345, 134, 'HUAROCHIRI', 150709),
(1346, 134, 'LAHUAYTAMBO', 150710),
(1347, 134, 'LANGA', 150711),
(1348, 134, 'LARAOS', 150712),
(1349, 134, 'MARIATANA', 150713),
(1350, 134, 'RICARDO PALMA', 150714),
(1351, 134, 'SAN ANDRES DE TUPICOCHA', 150715),
(1352, 134, 'SAN ANTONIO', 150716),
(1353, 134, 'SAN BARTOLOME', 150717),
(1354, 134, 'SAN DAMIAN', 150718),
(1355, 134, 'SAN JUAN DE IRIS', 150719),
(1356, 134, 'SAN JUAN DE TANTARANCHE', 150720),
(1357, 134, 'SAN LORENZO DE QUINTI', 150721),
(1358, 134, 'SAN MATEO', 150722),
(1359, 134, 'SAN MATEO DE OTAO', 150723),
(1360, 134, 'SAN PEDRO DE CASTA', 150724),
(1361, 134, 'SAN PEDRO DE HUANCAYRE', 150725),
(1362, 134, 'SANGALLAYA', 150726),
(1363, 134, 'SANTA CRUZ DE COCACHACRA', 150727),
(1364, 134, 'SANTA EULALIA', 150728),
(1365, 134, 'SANTIAGO DE ANCHUCAYA', 150729),
(1366, 134, 'SANTIAGO DE TUNA', 150730),
(1367, 134, 'SANTO DOMINGO DE LOS', 150731),
(1368, 134, 'SURCO', 150732),
(1369, 135, 'HUACHO', 150801),
(1370, 135, 'AMBAR', 150802),
(1371, 135, 'CALETA DE CARQUIN', 150803),
(1372, 135, 'CHECRAS', 150804),
(1373, 135, 'HUALMAY', 150805),
(1374, 135, 'HUAURA', 150806),
(1375, 135, 'LEONCIO PRADO', 150807),
(1376, 135, 'PACCHO', 150808),
(1377, 135, 'SANTA LEONOR', 150809),
(1378, 135, 'SANTA MARIA', 150810),
(1379, 135, 'SAYAN', 150811),
(1380, 135, 'VEGUETA', 150812),
(1381, 136, 'OYON', 150901),
(1382, 136, 'ANDAJES', 150902),
(1383, 136, 'CAUJUL', 150903),
(1384, 136, 'COCHAMARCA', 150904),
(1385, 136, 'NAVAN', 150905),
(1386, 136, 'PACHANGARA', 150906),
(1387, 137, 'YAUYOS', 151001),
(1388, 137, 'ALIS', 151002),
(1389, 137, 'AYAUCA', 151003),
(1390, 137, 'AYAVIRI', 151004),
(1391, 137, 'AZANGARO', 151005),
(1392, 137, 'CACRA', 151006),
(1393, 137, 'CARANIA', 151007),
(1394, 137, 'CATAHUASI', 151008),
(1395, 137, 'CHOCOS', 151009),
(1396, 137, 'COCHAS', 151010),
(1397, 137, 'COLONIA', 151011),
(1398, 137, 'HONGOS', 151012),
(1399, 137, 'HUAMPARA', 151013),
(1400, 137, 'HUANCAYA', 151014),
(1401, 137, 'HUANGASCAR', 151015),
(1402, 137, 'HUANTAN', 151016),
(1403, 137, 'HUAÑEC', 151017),
(1404, 137, 'LARAOS', 151018),
(1405, 137, 'LINCHA', 151019),
(1406, 137, 'MADEAN', 151020),
(1407, 137, 'MIRAFLORES', 151021),
(1408, 137, 'OMAS', 151022),
(1409, 137, 'PUTINZA', 151023),
(1410, 137, 'QUINCHES', 151024),
(1411, 137, 'QUINOCAY', 151025),
(1412, 137, 'SAN JOAQUIN', 151026),
(1413, 137, 'SAN PEDRO DE PILAS', 151027),
(1414, 137, 'TANTA', 151028),
(1415, 137, 'TAURIPAMPA', 151029),
(1416, 137, 'TOMAS', 151030),
(1417, 137, 'TUPE', 151031),
(1418, 137, 'VIÑAC', 151032),
(1419, 137, 'VITIS', 151033),
(1420, 138, 'IQUITOS', 160101),
(1421, 138, 'ALTO NANAY', 160102),
(1422, 138, 'FERNANDO LORES', 160103),
(1423, 138, 'INDIANA', 160104),
(1424, 138, 'LAS AMAZONAS', 160105),
(1425, 138, 'MAZAN', 160106),
(1426, 138, 'NAPO', 160107),
(1427, 138, 'PUNCHANA', 160108),
(1428, 138, 'PUTUMAYO', 160109),
(1429, 138, 'TORRES CAUSANA', 160110),
(1430, 138, 'BELEN', 160112),
(1431, 138, 'SAN JUAN BAUTISTA', 160113),
(1432, 138, 'TENIENTE MANUEL CLAVERO', 160114),
(1433, 139, 'YURIMAGUAS', 160201),
(1434, 139, 'BALSAPUERTO', 160202),
(1435, 139, 'JEBEROS', 160205),
(1436, 139, 'LAGUNAS', 160206),
(1437, 139, 'SANTA CRUZ', 160210),
(1438, 139, 'TENIENTE CESAR LOPEZ', 160211),
(1439, 140, 'NAUTA', 160301),
(1440, 140, 'PARINARI', 160302),
(1441, 140, 'TIGRE', 160303),
(1442, 140, 'TROMPETEROS', 160304),
(1443, 140, 'URARINAS', 160305),
(1444, 141, 'RAMON CASTILLA', 160401),
(1445, 141, 'PEBAS', 160402),
(1446, 141, 'YAVARI', 160403),
(1447, 141, 'SAN PABLO', 160404),
(1448, 142, 'REQUENA', 160501),
(1449, 142, 'ALTO TAPICHE', 160502),
(1450, 142, 'CAPELO', 160503),
(1451, 142, 'EMILIO SAN MARTIN', 160504),
(1452, 142, 'MAQUIA', 160505),
(1453, 142, 'PUINAHUA', 160506),
(1454, 142, 'SAQUENA', 160507),
(1455, 142, 'SOPLIN', 160508),
(1456, 142, 'TAPICHE', 160509),
(1457, 142, 'JENARO HERRERA', 160510),
(1458, 142, 'YAQUERANA', 160511),
(1459, 143, 'CONTAMANA', 160601),
(1460, 143, 'INAHUAYA', 160602),
(1461, 143, 'PADRE MARQUEZ', 160603),
(1462, 143, 'PAMPA HERMOSA', 160604),
(1463, 143, 'SARAYACU', 160605),
(1464, 143, 'VARGAS GUERRA', 160606),
(1465, 144, 'BARRANCA', 160701),
(1466, 144, 'CAHUAPANAS', 160702),
(1467, 144, 'MANSERICHE', 160703),
(1468, 144, 'MORONA', 160704),
(1469, 144, 'PASTAZA', 160705),
(1470, 144, 'ANDOAS', 160706),
(1471, 145, 'TAMBOPATA', 170101),
(1472, 145, 'INAMBARI', 170102),
(1473, 145, 'LAS PIEDRAS', 170103),
(1474, 145, 'LABERINTO', 170104),
(1475, 146, 'MANU', 170201),
(1476, 146, 'FITZCARRALD', 170202),
(1477, 146, 'MADRE DE DIOS', 170203),
(1478, 146, 'HUEPETUHE', 170204),
(1479, 147, 'IÑAPARI', 170301),
(1480, 147, 'IBERIA', 170302),
(1481, 147, 'TAHUAMANU', 170303),
(1482, 148, 'MOQUEGUA', 180101),
(1483, 148, 'CARUMAS', 180102),
(1484, 148, 'CUCHUMBAYA', 180103),
(1485, 148, 'SAMEGUA', 180104),
(1486, 148, 'SAN CRISTOBAL', 180105),
(1487, 148, 'TORATA', 180106),
(1488, 149, 'OMATE', 180201),
(1489, 149, 'CHOJATA', 180202),
(1490, 149, 'COALAQUE', 180203),
(1491, 149, 'ICHUÑA', 180204),
(1492, 149, 'LA CAPILLA', 180205),
(1493, 149, 'LLOQUE', 180206),
(1494, 149, 'MATALAQUE', 180207),
(1495, 149, 'PUQUINA', 180208),
(1496, 149, 'QUINISTAQUILLAS', 180209),
(1497, 149, 'UBINAS', 180210),
(1498, 149, 'YUNGA', 180211),
(1499, 150, 'ILO', 180301),
(1500, 150, 'EL ALGARROBAL', 180302),
(1501, 150, 'PACOCHA', 180303),
(1502, 151, 'CHAUPIMARCA', 190101),
(1503, 151, 'HUACHON', 190102),
(1504, 151, 'HUARIACA', 190103),
(1505, 151, 'HUAYLLAY', 190104),
(1506, 151, 'NINACACA', 190105),
(1507, 151, 'PALLANCHACRA', 190106),
(1508, 151, 'PAUCARTAMBO', 190107),
(1509, 151, 'SAN FRANCISCO DE ASIS DE', 190108),
(1510, 151, 'SIMON BOLIVAR', 190109),
(1511, 151, 'TICLACAYAN', 190110),
(1512, 151, 'TINYAHUARCO', 190111),
(1513, 151, 'VICCO', 190112),
(1514, 151, 'YANACANCHA', 190113),
(1515, 152, 'YANAHUANCA', 190201),
(1516, 152, 'CHACAYAN', 190202),
(1517, 152, 'GOYLLARISQUIZGA', 190203),
(1518, 152, 'PAUCAR', 190204),
(1519, 152, 'SAN PEDRO DE PILLAO', 190205),
(1520, 152, 'SANTA ANA DE TUSI', 190206),
(1521, 152, 'TAPUC', 190207),
(1522, 152, 'VILCABAMBA', 190208),
(1523, 153, 'OXAPAMPA', 190301),
(1524, 153, 'CHONTABAMBA', 190302),
(1525, 153, 'HUANCABAMBA', 190303),
(1526, 153, 'PALCAZU', 190304),
(1527, 153, 'POZUZO', 190305),
(1528, 153, 'PUERTO BERMUDEZ', 190306),
(1529, 153, 'VILLA RICA', 190307),
(1530, 154, 'PIURA', 200101),
(1531, 154, 'CASTILLA', 200104),
(1532, 154, 'CATACAOS', 200105),
(1533, 154, 'CURA MORI', 200107),
(1534, 154, 'EL TALLAN', 200108),
(1535, 154, 'LA ARENA', 200109),
(1536, 154, 'LA UNION', 200110),
(1537, 154, 'LAS LOMAS', 200111),
(1538, 154, 'TAMBO GRANDE', 200114),
(1539, 155, 'AYABACA', 200201),
(1540, 155, 'FRIAS', 200202),
(1541, 155, 'JILILI', 200203),
(1542, 155, 'LAGUNAS', 200204),
(1543, 155, 'MONTERO', 200205),
(1544, 155, 'PACAIPAMPA', 200206),
(1545, 155, 'PAIMAS', 200207),
(1546, 155, 'SAPILLICA', 200208),
(1547, 155, 'SICCHEZ', 200209),
(1548, 155, 'SUYO', 200210),
(1549, 156, 'HUANCABAMBA', 200301),
(1550, 156, 'CANCHAQUE', 200302),
(1551, 156, 'EL CARMEN DE LA FRONTERA', 200303),
(1552, 156, 'HUARMACA', 200304),
(1553, 156, 'LALAQUIZ', 200305),
(1554, 156, 'SAN MIGUEL DE EL FAIQUE', 200306),
(1555, 156, 'SONDOR', 200307),
(1556, 156, 'SONDORILLO', 200308),
(1557, 157, 'CHULUCANAS', 200401),
(1558, 157, 'BUENOS AIRES', 200402),
(1559, 157, 'CHALACO', 200403),
(1560, 157, 'LA MATANZA', 200404),
(1561, 157, 'MORROPON', 200405),
(1562, 157, 'SALITRAL', 200406),
(1563, 157, 'SAN JUAN DE BIGOTE', 200407),
(1564, 157, 'SANTA CATALINA DE MOSSA', 200408),
(1565, 157, 'SANTO DOMINGO', 200409),
(1566, 157, 'YAMANGO', 200410),
(1567, 158, 'PAITA', 200501),
(1568, 158, 'AMOTAPE', 200502),
(1569, 158, 'ARENAL', 200503),
(1570, 158, 'COLAN', 200504),
(1571, 158, 'LA HUACA', 200505),
(1572, 158, 'TAMARINDO', 200506),
(1573, 158, 'VICHAYAL', 200507),
(1574, 159, 'SULLANA', 200601),
(1575, 159, 'BELLAVISTA', 200602),
(1576, 159, 'IGNACIO ESCUDERO', 200603),
(1577, 159, 'LANCONES', 200604),
(1578, 159, 'MARCAVELICA', 200605),
(1579, 159, 'MIGUEL CHECA', 200606),
(1580, 159, 'QUERECOTILLO', 200607),
(1581, 159, 'SALITRAL', 200608),
(1582, 160, 'PARIÑAS', 200701),
(1583, 160, 'EL ALTO', 200702),
(1584, 160, 'LA BREA', 200703),
(1585, 160, 'LOBITOS', 200704),
(1586, 160, 'LOS ORGANOS', 200705),
(1587, 160, 'MANCORA', 200706),
(1588, 161, 'SECHURA', 200801),
(1589, 161, 'BELLAVISTA DE LA UNION', 200802),
(1590, 161, 'BERNAL', 200803),
(1591, 161, 'CRISTO NOS VALGA', 200804),
(1592, 161, 'VICE', 200805),
(1593, 161, 'RINCONADA LLICUAR', 200806),
(1594, 162, 'PUNO', 210101),
(1595, 162, 'ACORA', 210102),
(1596, 162, 'AMANTANI', 210103),
(1597, 162, 'ATUNCOLLA', 210104),
(1598, 162, 'CAPACHICA', 210105),
(1599, 162, 'CHUCUITO', 210106),
(1600, 162, 'COATA', 210107),
(1601, 162, 'HUATA', 210108),
(1602, 162, 'MAÑAZO', 210109),
(1603, 162, 'PAUCARCOLLA', 210110),
(1604, 162, 'PICHACANI', 210111),
(1605, 162, 'PLATERIA', 210112),
(1606, 162, 'SAN ANTONIO', 210113),
(1607, 162, 'TIQUILLACA', 210114),
(1608, 162, 'VILQUE', 210115),
(1609, 163, 'AZANGARO', 210201),
(1610, 163, 'ACHAYA', 210202),
(1611, 163, 'ARAPA', 210203),
(1612, 163, 'ASILLO', 210204),
(1613, 163, 'CAMINACA', 210205),
(1614, 163, 'CHUPA', 210206),
(1615, 163, 'JOSE DOMINGO', 210207),
(1616, 163, 'MUÑANI', 210208),
(1617, 163, 'POTONI', 210209),
(1618, 163, 'SAMAN', 210210),
(1619, 163, 'SAN ANTON', 210211),
(1620, 163, 'SAN JOSE', 210212),
(1621, 163, 'SAN JUAN DE SALINAS', 210213),
(1622, 163, 'SANTIAGO DE PUPUJA', 210214),
(1623, 163, 'TIRAPATA', 210215),
(1624, 164, 'MACUSANI', 210301),
(1625, 164, 'AJOYANI', 210302),
(1626, 164, 'AYAPATA', 210303),
(1627, 164, 'COASA', 210304),
(1628, 164, 'CORANI', 210305),
(1629, 164, 'CRUCERO', 210306),
(1630, 164, 'ITUATA', 210307),
(1631, 164, 'OLLACHEA', 210308),
(1632, 164, 'SAN GABAN', 210309),
(1633, 164, 'USICAYOS', 210310),
(1634, 165, 'JULI', 210401),
(1635, 165, 'DESAGUADERO', 210402),
(1636, 165, 'HUACULLANI', 210403),
(1637, 165, 'KELLUYO', 210404),
(1638, 165, 'PISACOMA', 210405),
(1639, 165, 'POMATA', 210406),
(1640, 165, 'ZEPITA', 210407),
(1641, 166, 'ILAVE', 210501),
(1642, 166, 'CAPAZO', 210502),
(1643, 166, 'PILCUYO', 210503),
(1644, 166, 'SANTA ROSA', 210504),
(1645, 166, 'CONDURIRI', 210505),
(1646, 167, 'HUANCANE', 210601),
(1647, 167, 'COJATA', 210602),
(1648, 167, 'HUATASANI', 210603);
INSERT INTO `address_district` (`district_id`, `province_id`, `district`, `ubigeo`) VALUES
(1649, 167, 'INCHUPALLA', 210604),
(1650, 167, 'PUSI', 210605),
(1651, 167, 'ROSASPATA', 210606),
(1652, 167, 'TARACO', 210607),
(1653, 167, 'VILQUE CHICO', 210608),
(1654, 168, 'LAMPA', 210701),
(1655, 168, 'CABANILLA', 210702),
(1656, 168, 'CALAPUJA', 210703),
(1657, 168, 'NICASIO', 210704),
(1658, 168, 'OCUVIRI', 210705),
(1659, 168, 'PALCA', 210706),
(1660, 168, 'PARATIA', 210707),
(1661, 168, 'PUCARA', 210708),
(1662, 168, 'SANTA LUCIA', 210709),
(1663, 168, 'VILAVILA', 210710),
(1664, 169, 'AYAVIRI', 210801),
(1665, 169, 'ANTAUTA', 210802),
(1666, 169, 'CUPI', 210803),
(1667, 169, 'LLALLI', 210804),
(1668, 169, 'MACARI', 210805),
(1669, 169, 'NUÑOA', 210806),
(1670, 169, 'ORURILLO', 210807),
(1671, 169, 'SANTA ROSA', 210808),
(1672, 169, 'UMACHIRI', 210809),
(1673, 170, 'MOHO', 210901),
(1674, 170, 'CONIMA', 210902),
(1675, 170, 'HUAYRAPATA', 210903),
(1676, 170, 'TILALI', 210904),
(1677, 171, 'PUTINA', 211001),
(1678, 171, 'ANANEA', 211002),
(1679, 171, 'PEDRO VILCA APAZA', 211003),
(1680, 171, 'QUILCAPUNCU', 211004),
(1681, 171, 'SINA', 211005),
(1682, 172, 'JULIACA', 211101),
(1683, 172, 'CABANA', 211102),
(1684, 172, 'CABANILLAS', 211103),
(1685, 172, 'CARACOTO', 211104),
(1686, 173, 'SANDIA', 211201),
(1687, 173, 'CUYOCUYO', 211202),
(1688, 173, 'LIMBANI', 211203),
(1689, 173, 'PATAMBUCO', 211204),
(1690, 173, 'PHARA', 211205),
(1691, 173, 'QUIACA', 211206),
(1692, 173, 'SAN JUAN DEL ORO', 211207),
(1693, 173, 'YANAHUAYA', 211208),
(1694, 173, 'ALTO INAMBARI', 211209),
(1695, 173, 'SAN PEDRO DE PUTINA PUNCO', 211210),
(1696, 174, 'YUNGUYO', 211301),
(1697, 174, 'ANAPIA', 211302),
(1698, 174, 'COPANI', 211303),
(1699, 174, 'CUTURAPI', 211304),
(1700, 174, 'OLLARAYA', 211305),
(1701, 174, 'TINICACHI', 211306),
(1702, 174, 'UNICACHI', 211307),
(1703, 175, 'MOYOBAMBA', 220101),
(1704, 175, 'CALZADA', 220102),
(1705, 175, 'HABANA', 220103),
(1706, 175, 'JEPELACIO', 220104),
(1707, 175, 'SORITOR', 220105),
(1708, 175, 'YANTALO', 220106),
(1709, 176, 'BELLAVISTA', 220201),
(1710, 176, 'ALTO BIAVO', 220202),
(1711, 176, 'BAJO BIAVO', 220203),
(1712, 176, 'HUALLAGA', 220204),
(1713, 176, 'SAN PABLO', 220205),
(1714, 176, 'SAN RAFAEL', 220206),
(1715, 177, 'SAN JOSE DE SISA', 220301),
(1716, 177, 'AGUA BLANCA', 220302),
(1717, 177, 'SAN MARTIN', 220303),
(1718, 177, 'SANTA ROSA', 220304),
(1719, 177, 'SHATOJA', 220305),
(1720, 178, 'SAPOSOA', 220401),
(1721, 178, 'ALTO SAPOSOA', 220402),
(1722, 178, 'EL ESLABON', 220403),
(1723, 178, 'PISCOYACU', 220404),
(1724, 178, 'SACANCHE', 220405),
(1725, 178, 'TINGO DE SAPOSOA', 220406),
(1726, 179, 'LAMAS', 220501),
(1727, 179, 'ALONSO DE ALVARADO', 220502),
(1728, 179, 'BARRANQUITA', 220503),
(1729, 179, 'CAYNARACHI', 220504),
(1730, 179, 'CUÑUMBUQUI', 220505),
(1731, 179, 'PINTO RECODO', 220506),
(1732, 179, 'RUMISAPA', 220507),
(1733, 179, 'SAN ROQUE DE CUMBAZA', 220508),
(1734, 179, 'SHANAO', 220509),
(1735, 179, 'TABALOSOS', 220510),
(1736, 179, 'ZAPATERO', 220511),
(1737, 180, 'JUANJUI', 220601),
(1738, 180, 'CAMPANILLA', 220602),
(1739, 180, 'HUICUNGO', 220603),
(1740, 180, 'PACHIZA', 220604),
(1741, 180, 'PAJARILLO', 220605),
(1742, 181, 'PICOTA', 220701),
(1743, 181, 'BUENOS AIRES', 220702),
(1744, 181, 'CASPISAPA', 220703),
(1745, 181, 'PILLUANA', 220704),
(1746, 181, 'PUCACACA', 220705),
(1747, 181, 'SAN CRISTOBAL', 220706),
(1748, 181, 'SAN HILARION', 220707),
(1749, 181, 'SHAMBOYACU', 220708),
(1750, 181, 'TINGO DE PONASA', 220709),
(1751, 181, 'TRES UNIDOS', 220710),
(1752, 182, 'RIOJA', 220801),
(1753, 182, 'AWAJUN', 220802),
(1754, 182, 'ELIAS SOPLIN VARGAS', 220803),
(1755, 182, 'NUEVA CAJAMARCA', 220804),
(1756, 182, 'PARDO MIGUEL', 220805),
(1757, 182, 'POSIC', 220806),
(1758, 182, 'SAN FERNANDO', 220807),
(1759, 182, 'YORONGOS', 220808),
(1760, 182, 'YURACYACU', 220809),
(1761, 183, 'TARAPOTO', 220901),
(1762, 183, 'ALBERTO LEVEAU', 220902),
(1763, 183, 'CACATACHI', 220903),
(1764, 183, 'CHAZUTA', 220904),
(1765, 183, 'CHIPURANA', 220905),
(1766, 183, 'EL PORVENIR', 220906),
(1767, 183, 'HUIMBAYOC', 220907),
(1768, 183, 'JUAN GUERRA', 220908),
(1769, 183, 'LA BANDA DE SHILCAYO', 220909),
(1770, 183, 'MORALES', 220910),
(1771, 183, 'PAPAPLAYA', 220911),
(1772, 183, 'SAN ANTONIO', 220912),
(1773, 183, 'SAUCE', 220913),
(1774, 183, 'SHAPAJA', 220914),
(1775, 184, 'TOCACHE', 221001),
(1776, 184, 'NUEVO PROGRESO', 221002),
(1777, 184, 'POLVORA', 221003),
(1778, 184, 'SHUNTE', 221004),
(1779, 184, 'UCHIZA', 221005),
(1780, 185, 'TACNA', 230101),
(1781, 185, 'ALTO DE LA ALIANZA', 230102),
(1782, 185, 'CALANA', 230103),
(1783, 185, 'CIUDAD NUEVA', 230104),
(1784, 185, 'INCLAN', 230105),
(1785, 185, 'PACHIA', 230106),
(1786, 185, 'PALCA', 230107),
(1787, 185, 'POCOLLAY', 230108),
(1788, 185, 'SAMA', 230109),
(1789, 185, 'CORONEL GREGORIO', 230110),
(1790, 186, 'CANDARAVE', 230201),
(1791, 186, 'CAIRANI', 230202),
(1792, 186, 'CAMILACA', 230203),
(1793, 186, 'CURIBAYA', 230204),
(1794, 186, 'HUANUARA', 230205),
(1795, 186, 'QUILAHUANI', 230206),
(1796, 187, 'LOCUMBA', 230301),
(1797, 187, 'ILABAYA', 230302),
(1798, 187, 'ITE', 230303),
(1799, 188, 'TARATA', 230401),
(1800, 188, 'HEROES ALBARRACIN', 230402),
(1801, 188, 'ESTIQUE', 230403),
(1802, 188, 'ESTIQUE-PAMPA', 230404),
(1803, 188, 'SITAJARA', 230405),
(1804, 188, 'SUSAPAYA', 230406),
(1805, 188, 'TARUCACHI', 230407),
(1806, 188, 'TICACO', 230408),
(1807, 189, 'TUMBES', 240101),
(1808, 189, 'CORRALES', 240102),
(1809, 189, 'LA CRUZ', 240103),
(1810, 189, 'PAMPAS DE HOSPITAL', 240104),
(1811, 189, 'SAN JACINTO', 240105),
(1812, 189, 'SAN JUAN DE LA VIRGEN', 240106),
(1813, 190, 'ZORRITOS', 240201),
(1814, 190, 'CASITAS', 240202),
(1815, 190, 'CANOAS DE PUNTA SAL', 240203),
(1816, 191, 'ZARUMILLA', 240301),
(1817, 191, 'AGUAS VERDES', 240302),
(1818, 191, 'MATAPALO', 240303),
(1819, 191, 'PAPAYAL', 240304),
(1820, 192, 'CALLERIA', 250101),
(1821, 192, 'CAMPOVERDE', 250102),
(1822, 192, 'IPARIA', 250103),
(1823, 192, 'MASISEA', 250104),
(1824, 192, 'YARINACOCHA', 250105),
(1825, 192, 'NUEVA REQUENA', 250106),
(1826, 192, 'MANANTAY', 250107),
(1827, 193, 'RAYMONDI', 250201),
(1828, 193, 'SEPAHUA', 250202),
(1829, 193, 'TAHUANIA', 250203),
(1830, 193, 'YURUA', 250204),
(1831, 194, 'PADRE ABAD', 250301),
(1832, 194, 'IRAZOLA', 250302),
(1833, 194, 'CURIMANA', 250303),
(1834, 195, 'PURUS', 250401);

-- --------------------------------------------------------

--
-- 테이블 구조 `address_province`
--

CREATE TABLE `address_province` (
  `province_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `province` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `address_province`
--

INSERT INTO `address_province` (`province_id`, `department_id`, `province`) VALUES
(1, 1, 'CHACHAPOYAS'),
(2, 1, 'BAGUA'),
(3, 1, 'BONGARA'),
(4, 1, 'CONDORCANQUI'),
(5, 1, 'LUYA'),
(6, 1, 'RODRIGUEZ DE'),
(7, 1, 'UTCUBAMBA'),
(8, 2, 'HUARAZ'),
(9, 2, 'AIJA'),
(10, 2, 'ANTONIO RAYMONDI'),
(11, 2, 'ASUNCION'),
(12, 2, 'BOLOGNESI'),
(13, 2, 'CARHUAZ'),
(14, 2, 'CARLOS FERMIN'),
(15, 2, 'CASMA'),
(16, 2, 'CORONGO'),
(17, 2, 'HUARI'),
(18, 2, 'HUARMEY'),
(19, 2, 'HUAYLAS'),
(20, 2, 'MARISCAL LUZURIAGA'),
(21, 2, 'OCROS'),
(22, 2, 'PALLASCA'),
(23, 2, 'POMABAMBA'),
(24, 2, 'RECUAY'),
(25, 2, 'SANTA'),
(26, 2, 'SIHUAS'),
(27, 2, 'YUNGAY'),
(28, 3, 'ABANCAY'),
(29, 3, 'ANDAHUAYLAS'),
(30, 3, 'ANTABAMBA'),
(31, 3, 'AYMARAES'),
(32, 3, 'COTABAMBAS'),
(33, 3, 'CHINCHEROS'),
(34, 3, 'GRAU'),
(35, 4, 'AREQUIPA'),
(36, 4, 'CAMANA'),
(37, 4, 'CARAVELI'),
(38, 4, 'CASTILLA'),
(39, 4, 'CAYLLOMA'),
(40, 4, 'CONDESUYOS'),
(41, 4, 'ISLAY'),
(42, 4, 'LA UNION'),
(43, 5, 'HUAMANGA'),
(44, 5, 'CANGALLO'),
(45, 5, 'HUANCA SANCOS'),
(46, 5, 'HUANTA'),
(47, 5, 'LA MAR'),
(48, 5, 'LUCANAS'),
(49, 5, 'PARINACOCHAS'),
(50, 5, 'PAUCAR DEL SARA'),
(51, 5, 'SUCRE'),
(52, 5, 'VICTOR FAJARDO'),
(53, 5, 'VILCAS HUAMAN'),
(54, 6, 'CAJAMARCA'),
(55, 6, 'CAJABAMBA'),
(56, 6, 'CELENDIN'),
(57, 6, 'CHOTA'),
(58, 6, 'CONTUMAZA'),
(59, 6, 'CUTERVO'),
(60, 6, 'HUALGAYOC'),
(61, 6, 'JAEN'),
(62, 6, 'SAN IGNACIO'),
(63, 6, 'SAN MARCOS'),
(64, 6, 'SAN MIGUEL'),
(65, 6, 'SAN PABLO'),
(66, 6, 'SANTA CRUZ'),
(67, 7, 'CALLAO'),
(68, 8, 'CUSCO'),
(69, 8, 'ACOMAYO'),
(70, 8, 'ANTA'),
(71, 8, 'CALCA'),
(72, 8, 'CANAS'),
(73, 8, 'CANCHIS'),
(74, 8, 'CHUMBIVILCAS'),
(75, 8, 'ESPINAR'),
(76, 8, 'LA CONVENCION'),
(77, 8, 'PARURO'),
(78, 8, 'PAUCARTAMBO'),
(79, 8, 'QUISPICANCHI'),
(80, 8, 'URUBAMBA'),
(81, 9, 'HUANCAVELICA'),
(82, 9, 'ACOBAMBA'),
(83, 9, 'ANGARAES'),
(84, 9, 'CASTROVIRREYNA'),
(85, 9, 'CHURCAMPA'),
(86, 9, 'HUAYTARA'),
(87, 9, 'TAYACAJA'),
(88, 10, 'HUANUCO'),
(89, 10, 'AMBO'),
(90, 10, 'DOS DE MAYO'),
(91, 10, 'HUACAYBAMBA'),
(92, 10, 'HUAMALIES'),
(93, 10, 'LEONCIO PRADO'),
(94, 10, 'MARAÑON'),
(95, 10, 'PACHITEA'),
(96, 10, 'PUERTO INCA'),
(97, 10, 'LAURICOCHA'),
(98, 10, 'YAROWILCA'),
(99, 11, 'ICA'),
(100, 11, 'CHINCHA'),
(101, 11, 'NAZCA'),
(102, 11, 'PALPA'),
(103, 11, 'PISCO'),
(104, 12, 'HUANCAYO'),
(105, 12, 'CONCEPCION'),
(106, 12, 'CHANCHAMAYO'),
(107, 12, 'JAUJA'),
(108, 12, 'JUNIN'),
(109, 12, 'SATIPO'),
(110, 12, 'TARMA'),
(111, 12, 'YAULI'),
(112, 12, 'CHUPACA'),
(113, 13, 'TRUJILLO'),
(114, 13, 'ASCOPE'),
(115, 13, 'BOLIVAR'),
(116, 13, 'CHEPEN'),
(117, 13, 'JULCAN'),
(118, 13, 'OTUZCO'),
(119, 13, 'PACASMAYO'),
(120, 13, 'PATAZ'),
(121, 13, 'SANCHEZ CARRION'),
(122, 13, 'SANTIAGO DE CHUCO'),
(123, 13, 'GRAN CHIMU'),
(124, 13, 'VIRU'),
(125, 14, 'CHICLAYO'),
(126, 14, 'FERREÑAFE'),
(127, 14, 'LAMBAYEQUE'),
(128, 15, 'LIMA'),
(129, 15, 'BARRANCA'),
(130, 15, 'CAJATAMBO'),
(131, 15, 'CANTA'),
(132, 15, 'CAÑETE'),
(133, 15, 'HUARAL'),
(134, 15, 'HUAROCHIRI'),
(135, 15, 'HUAURA'),
(136, 15, 'OYON'),
(137, 15, 'YAUYOS'),
(138, 16, 'MAYNAS'),
(139, 16, 'ALTO AMAZONAS'),
(140, 16, 'LORETO'),
(141, 16, 'MARISCAL RAMON'),
(142, 16, 'REQUENA'),
(143, 16, 'UCAYALI'),
(144, 16, 'DATEM DEL MARAÑON'),
(145, 17, 'TAMBOPATA'),
(146, 17, 'MANU'),
(147, 17, 'TAHUAMANU'),
(148, 18, 'MARISCAL NIETO'),
(149, 18, 'GENERAL SANCHEZ'),
(150, 18, 'ILO'),
(151, 19, 'PASCO'),
(152, 19, 'DANIEL ALCIDES'),
(153, 19, 'OXAPAMPA'),
(154, 20, 'PIURA'),
(155, 20, 'AYABACA'),
(156, 20, 'HUANCABAMBA'),
(157, 20, 'MORROPON'),
(158, 20, 'PAITA'),
(159, 20, 'SULLANA'),
(160, 20, 'TALARA'),
(161, 20, 'SECHURA'),
(162, 21, 'PUNO'),
(163, 21, 'AZANGARO'),
(164, 21, 'CARABAYA'),
(165, 21, 'CHUCUITO'),
(166, 21, 'EL COLLAO'),
(167, 21, 'HUANCANE'),
(168, 21, 'LAMPA'),
(169, 21, 'MELGAR'),
(170, 21, 'MOHO'),
(171, 21, 'SAN ANTONIO DE'),
(172, 21, 'SAN ROMAN'),
(173, 21, 'SANDIA'),
(174, 21, 'YUNGUYO'),
(175, 22, 'MOYOBAMBA'),
(176, 22, 'BELLAVISTA'),
(177, 22, 'EL DORADO'),
(178, 22, 'HUALLAGA'),
(179, 22, 'LAMAS'),
(180, 22, 'MARISCAL CACERES'),
(181, 22, 'PICOTA'),
(182, 22, 'RIOJA'),
(183, 22, 'SAN MARTIN'),
(184, 22, 'TOCACHE'),
(185, 23, 'TACNA'),
(186, 23, 'CANDARAVE'),
(187, 23, 'JORGE BASADRE'),
(188, 23, 'TARATA'),
(189, 24, 'TUMBES'),
(190, 24, 'CONTRALMIRANTE'),
(191, 24, 'ZARUMILLA'),
(192, 25, 'CORONEL PORTILLO'),
(193, 25, 'ATALAYA'),
(194, 25, 'PADRE ABAD'),
(195, 25, 'PURUS');

-- --------------------------------------------------------

--
-- 테이블 구조 `client`
--

CREATE TABLE `client` (
  `client_id` int(11) NOT NULL,
  `doc_type_id` int(11) NOT NULL,
  `doc_number` varchar(30) NOT NULL,
  `name` varchar(250) NOT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `valid` tinyint(1) NOT NULL DEFAULT 1,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `registed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `client`
--

INSERT INTO `client` (`client_id`, `doc_type_id`, `doc_number`, `name`, `tel`, `mobile`, `email`, `address`, `image`, `valid`, `updated_at`, `registed_at`) VALUES
(1, 2, '76408531', 'LEA MABEL SILUPU MONTALVAN', '', '', NULL, '', NULL, 1, '2023-09-16 23:05:39', '2023-09-16 23:05:39'),
(2, 2, '70614226', 'SOFIA LISSET CASAVERDE VALDIVIEZO', '', '', NULL, '', NULL, 1, '2023-09-17 20:50:05', '2023-09-17 20:50:05'),
(3, 2, '75694084', 'FRANCESCA JENNIFER OLAYA CAMACHO', '', '', NULL, '', NULL, 1, '2023-09-17 22:19:28', '2023-09-17 22:19:28'),
(4, 2, '75098340', 'YESABELLA ESPERANZA UBILLUS MORALES', '', '', NULL, '', NULL, 1, '2023-09-21 21:50:14', '2023-09-21 21:50:14'),
(5, 2, '75763698', 'ESTHEFANY DE LOS MILAGROS HERRERA CHECA', '', '', NULL, '', NULL, 1, '2023-09-25 21:29:42', '2023-09-25 21:29:42'),
(6, 2, '75112025', 'YARIS NAYELY CALLE CASTILLO', '', '', NULL, '', NULL, 1, '2023-10-05 00:33:52', '2023-10-05 00:33:52'),
(7, 3, '000765808', 'Jeong Woo Park', '', '', NULL, '', NULL, 1, '2023-10-07 22:08:29', '2023-10-07 22:08:29'),
(8, 2, '48098843', 'ROSA DEL CARMEN GARRIDO MORE', '', '', NULL, '', NULL, 1, '2023-10-07 23:11:35', '2023-10-07 23:11:35'),
(9, 4, '20454193556', 'COMERCIAL FERNANDA\'S S.R.L.', '', '', NULL, '', NULL, 1, '2023-10-09 23:22:01', '2023-10-09 23:22:01'),
(10, 2, '76147068', 'JACKELINE DEL PILAR ARCELES VINCES', '', '', NULL, '', NULL, 1, '2023-10-10 21:40:41', '2023-10-10 21:40:41'),
(11, 2, '74896747', 'CARLOS DAVID VILELA VILCHEZ', '', '', NULL, '', NULL, 1, '2023-10-10 22:38:14', '2023-10-10 22:38:14'),
(12, 4, '20405441862', 'INGEMET CPI EMPRESA INDIVIDUAL DE RESPONSABILIDAD LIMITADA', '', '', NULL, '', NULL, 1, '2023-10-20 22:37:38', '2023-10-20 22:37:38'),
(13, 4, '20364169982', 'EMGESA S.A.C.', '', '', NULL, '', NULL, 1, '2023-10-20 22:57:43', '2023-10-20 22:57:43'),
(14, 2, '72879477', 'MARIA FERNANDA VASQUEZ EVANGELISTA', '01 241 2345', '99 888 777', NULL, 'Av Aviacion 3204, San Borja, Lima, Peru', NULL, 1, '2023-10-23 20:30:42', '2023-10-23 20:30:42'),
(15, 2, '76155454', 'Emily Delgado', NULL, NULL, NULL, NULL, NULL, 1, '2023-10-26 20:01:00', '2023-10-26 20:01:00'),
(17, 4, '20387144901', 'RD HIDRAULICA S.R.L.', '', '', '', '', NULL, 1, '2023-11-02 23:13:11', '2023-11-02 23:13:11'),
(18, 4, '20408058261', 'CLINICA EVERLYN S.A.C.', '', '', '', '', NULL, 1, '2023-11-02 23:17:29', '2023-11-02 23:17:29'),
(19, 4, '20448426701', 'ALE BIENES Y SERVICIOS EN GENERAL SOCIEDAD ANONIMA CERRADA', NULL, NULL, NULL, NULL, '4_20448426701_20231109183244.jpg', 1, '2023-11-03 19:18:11', '2023-11-03 19:18:11'),
(20, 3, '000765804', 'Henry Calle', '345-6785', '908-237-473', 'h.calle@pontafina.com', 'Cl. Mexico ciudad 283, Cercado de Lima', '3_000765804_20231104161853.jpg', 1, '2023-11-03 23:22:13', '2023-11-03 20:37:49');

-- --------------------------------------------------------

--
-- 테이블 구조 `client_doc_type`
--

CREATE TABLE `client_doc_type` (
  `doc_type_id` int(11) NOT NULL,
  `doc_type` varchar(100) NOT NULL,
  `short` varchar(20) NOT NULL,
  `sunat` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `client_doc_type`
--

INSERT INTO `client_doc_type` (`doc_type_id`, `doc_type`, `short`, `sunat`) VALUES
(1, 'Sin documento', '', '0'),
(2, 'DNI - Documento Nacional de Identidad', 'DNI', '1'),
(3, 'CE - Carnet de Extranjería', 'CE', '4'),
(4, 'RUC - Registro Unico de Contributentes', 'RUC', '6'),
(5, 'Pasaporte', 'Pasaporte', '7'),
(6, 'CDI - Cédula Diplomática de Identidad', 'CDI', 'A');

-- --------------------------------------------------------

--
-- 테이블 구조 `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `sale_id` int(11) NOT NULL,
  `serie_id` int(11) NOT NULL,
  `correlative` int(11) NOT NULL,
  `total` double NOT NULL,
  `amount` double NOT NULL,
  `vat` double NOT NULL,
  `hash` varchar(30) NOT NULL,
  `is_sent_sunat` tinyint(1) NOT NULL DEFAULT 0,
  `valid` tinyint(1) NOT NULL DEFAULT 1,
  `registed_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `type_id`, `client_id`, `sale_id`, `serie_id`, `correlative`, `total`, `amount`, `vat`, `hash`, `is_sent_sunat`, `valid`, `registed_at`) VALUES
(28, 1, 6, 10, 1, 1, 61.2, 51.86, 9.34, 'DHD/KUZrIySiYJ7bJRg.vOmXWI9m', 1, 1, '2023-10-19 22:40:23'),
(29, 1, 5, 9, 1, 2, 299, 253.39, 45.61, 'BG.A4fhmfwZ.i1n8BY6rxVmZZKbC', 1, 1, '2023-10-20 20:48:55'),
(31, 2, 13, 8, 1, 1, 180, 152.54, 27.46, 'cLJSdOx9XJOPJoad7ZEuzxi0070q', 1, 1, '2023-10-20 22:57:43'),
(32, 1, 14, 19, 1, 3, 280, 237.29, 42.71, 'yrD7Kzk8TfUBJmr28TGIRxKjFjB.', 1, 1, '2023-10-24 22:32:54'),
(33, 1, 14, 20, 1, 4, 280, 237.29, 42.71, '9UAuFP8Nwi7oYpQUtzxUMen.hye6', 1, 1, '2023-10-24 23:02:49'),
(34, 1, 14, 21, 1, 5, 280, 237.29, 42.71, 'adMsXuxvtRa//Nz6R5doEwHoyHjS', 1, 1, '2023-10-25 19:56:53'),
(35, 1, 1, 24, 1, 6, 299.2, 253.56, 45.64, '6O2Lk5YT8M6VH2Blk4vbqzfZtztS', 1, 1, '2023-11-02 23:03:15'),
(36, 2, 19, 25, 1, 2, 299.2, 253.56, 45.64, '0gDUwWJxq4.OGuIPvETHadKZuGRK', 1, 1, '2023-11-03 19:18:42'),
(37, 1, 14, 26, 1, 7, 280, 237.29, 42.71, 'voUqfs4eZnlpk09HfoJ.oXTxPJqC', 1, 1, '2023-11-07 21:14:58');

-- --------------------------------------------------------

--
-- 테이블 구조 `invoice_serie`
--

CREATE TABLE `invoice_serie` (
  `serie_id` int(11) NOT NULL,
  `serie` varchar(5) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `invoice_serie`
--

INSERT INTO `invoice_serie` (`serie_id`, `serie`, `description`) VALUES
(1, '001', 'Venta Simple');

-- --------------------------------------------------------

--
-- 테이블 구조 `invoice_type`
--

CREATE TABLE `invoice_type` (
  `type_id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `letter` char(1) NOT NULL,
  `sunat` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `invoice_type`
--

INSERT INTO `invoice_type` (`type_id`, `type`, `letter`, `sunat`) VALUES
(1, 'Boleta', 'B', '03'),
(2, 'Factura', 'F', '01');

-- --------------------------------------------------------

--
-- 테이블 구조 `module`
--

CREATE TABLE `module` (
  `module_id` int(11) NOT NULL,
  `module` varchar(50) NOT NULL,
  `valid` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `module`
--

INSERT INTO `module` (`module_id`, `module`, `valid`) VALUES
(1, 'Autenticación', 1),
(2, 'Rol', 1),
(3, 'Account', 0),
(4, 'Account', 0),
(5, 'Access', 0);

-- --------------------------------------------------------

--
-- 테이블 구조 `payment_method`
--

CREATE TABLE `payment_method` (
  `payment_method_id` int(11) NOT NULL,
  `payment_method` varchar(150) NOT NULL,
  `sunat` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `payment_method`
--

INSERT INTO `payment_method` (`payment_method_id`, `payment_method`, `sunat`) VALUES
(1, 'Efectivo', '008'),
(2, 'Tarjeta de débito', '005'),
(3, 'Tarjeta de crédito nacional', '006'),
(4, 'Tarjeta de crédito extranjera', '013'),
(5, 'Depósito en cuenta', '001');

-- --------------------------------------------------------

--
-- 테이블 구조 `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL DEFAULT 1,
  `code` varchar(50) NOT NULL,
  `product` varchar(200) NOT NULL,
  `price` float NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `valid` tinyint(1) NOT NULL DEFAULT 1,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `registed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `product`
--

INSERT INTO `product` (`product_id`, `category_id`, `type_id`, `code`, `product`, `price`, `image`, `valid`, `updated_at`, `registed_at`) VALUES
(1, 4, 1, 'asdf-2321', 'otra prueba', 15.3, '20230829173001_thumb.png', 1, '2023-08-16 22:48:15', '2023-08-15 21:40:42'),
(2, 5, 1, 'asdf-232', 'Un producto con codigo', 33.57, NULL, 1, '2023-08-16 16:56:20', '2023-08-16 16:48:54'),
(3, 14, 1, 'frambuesas-341294', 'Uvas Higo Vino Mango Ciruela Zumo de guayaba', 94.02, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(4, 8, 1, 'melocotón-358282', 'Vino Higos pasos Té negro Higos secos Compota Zumo de pera', 52.65, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(5, 9, 1, 'zumodegranada-365194', 'Nispero Aguacate Caqui', 37.4, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(6, 13, 1, 'compota-194781', 'Sandía Pasas Zumo de mango Mermelada Moras Naranja', 99.07, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(7, 8, 1, 'higossecos-299759', 'Arándanos Cava rosado Vodka', 53.23, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(8, 15, 1, 'zumodesandía-385409', 'Agua con gas Compota Avellana', 99.18, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(9, 15, 1, 'nuezdebrasil-251227', 'Moras Mango Melocotón Agua mineral', 17.91, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(10, 14, 1, 'guayaba-402357', 'Sandía Pomelo Café Zumo de ciruela', 29.5, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(11, 15, 1, 'zumodemelocotón-146292', 'Uvas Higos pasos Té negro Té verde', 35.25, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(12, 8, 1, 'vinotinto-408744', 'Zumo de melocotón Aguacate Zumo de uva Chocolate Cola', 81.27, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(13, 5, 1, 'macadamia-452789', 'Ciruela Coco Cacahuetes', 37.71, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(14, 9, 1, 'ron-49718', 'Cava blanco Miel Ginebra Vino', 45.06, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(15, 16, 1, 'tequila-20235', 'Papaya Zumo de naranja Nuez de Brasil Canela Coco Vino', 75.42, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(16, 4, 1, 'sandía-372876', 'Avellana Coco Canela Miel Manzana', 66.24, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(17, 4, 1, 'zumodepera-360261', 'Almendra Cereza Feijoa', 55.71, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(18, 9, 1, 'zumo-350188', 'Zumo de pera Banana Ginebra Guayaba Anacardos Moras', 45.84, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(19, 5, 1, 'sandía-15500', 'Zumo Fresas Nuez Agua sin gas Cereza Mango', 23.88, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(20, 13, 1, 'avellana-43417', 'Melocotón Aguacate Agua Cacahuetes', 30.99, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(21, 16, 1, 'melocotón-125893', 'Ginebra Chocolate Brandy Dátiles Té negro', 42.63, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(22, 5, 1, 'naranjada-42816', 'Guayaba Banana Miel Té verde', 92.97, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(23, 5, 1, 'higospasos-128781', 'Mango Coco rallado Macadamia', 21.26, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(24, 5, 1, 'coco-303396', 'Feijoa Vino rosado Vodka', 93.26, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(25, 15, 1, 'uvas-214005', 'Uvas pasas Brandy Melocotón Ginebra', 82.24, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(26, 4, 1, 'cavablanco-132554', 'Vainilla Té de hierbas Banana Ron', 90.26, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(27, 9, 1, 'guayaba-387526', 'Zumo de kiwi Ron Agua', 34.21, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(28, 4, 1, 'feijoa-57940', 'Jalea Uvas Whisky Vodka Chocolate', 47.05, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(29, 15, 1, 'zumodekiwi-148339', 'Uvas pasas Té de hierbas Zumo de naranja', 50.81, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(30, 15, 1, 'piña-381985', 'Pomelo Cava blanco Agua mineral Miel Higos pasos Coco', 49.76, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(31, 9, 1, 'champán-433764', 'Sandía Vino rosado Piña Pistachos', 66.73, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(32, 10, 1, 'zumodepiña-132440', 'Zumo de manzana Cava rosado Zumo de pera Vino blanco Avellana', 25.1, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(33, 16, 1, 'café-116567', 'Uvas pasas Pomelo Zumo de guayaba Piña Zumo Guindas', 10.29, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(34, 15, 1, 'zumodepera-47980', 'Piña Zumo de frambuesa Agua', 99.46, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(35, 5, 1, 'mermelada-141318', 'Granada Mango Uvas Té Manzana', 21.92, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(36, 16, 1, 'higossecos-353630', 'Vino blanco Guayaba Macadamia Tónica Uvas pasas Zumo de limón', 99.19, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(37, 16, 1, 'dátiles-6076', 'Naranjada Vino Vino tinto', 86.94, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(38, 15, 1, 'moras-350378', 'Higos pasos Coco Té Cola Chirimoya', 13.71, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(39, 10, 1, 'zumodekiwi-397752', 'Zumo de mora Vino tinto Zumo', 32.87, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(40, 9, 1, 'nuezdebrasil-479142', 'Almendra confitada Avellana Vainilla Cava Champán Mango', 19.81, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(41, 15, 1, 'almendra-438156', 'Zumo de fresa Nuez Pasas Zumo de piña Pomelo', 53.73, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(42, 10, 1, 'nuez-477856', 'Zumo de fresa Agua mineral Nuez de Brasil', 54.15, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(43, 5, 1, 'zumodeciruela-424155', 'Mango Limón Sidra Zumo de limón', 95.1, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(44, 10, 1, 'compota-447672', 'Café Avellana Zumo de arándanos Vodka', 47.49, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(45, 11, 1, 'vainilla-239249', 'Dátiles Vino blanco Té Higo Banana Fresas', 85.01, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(46, 11, 1, 'mango-310849', 'Puré de fruta Uvas Compota Zumo de papaya', 64.9, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(47, 14, 1, 'macadamia-201236', 'Agua mineral Kiwi Vino tinto', 10.94, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(48, 14, 1, 'uvas-470763', 'Granada Cacahuetes Avellana Piña Higos pasos Zumo de uva', 71.72, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(49, 10, 1, 'almendra-74928', 'Ron Zumo de manzana Ciruela Granada Nuez', 36.74, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(50, 9, 1, 'higo-492876', 'Arándanos Zumo de melocotón Vino Uvas pasas Zumo de sandía Ron', 46.99, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(51, 15, 1, 'zumodepapaya-265322', 'Granada Higos secos Zumo de uva Pistachos', 77.45, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(52, 8, 1, 'nispero-153603', 'Zumo de melocotón Pomelo Zumo de pomelo', 61.54, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(53, 5, 1, 'café-186849', 'Té Champán Cola Mango Dátiles', 37.13, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(54, 11, 1, 'limonada-309833', 'Ron Cola Cola Cerveza Ron Sandía', 72.88, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(55, 15, 1, 'guindas-268002', 'Zumo de granada Zumo Té', 52.83, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(56, 4, 1, 'piña-456102', 'Limonada Mango Zumo de guayaba Mora', 64.32, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(57, 13, 1, 'pasas-187367', 'Té de hierbas Agua sin gas Melocotón Cacao Ciruela Cava rosado', 28.26, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(58, 9, 1, 'mora-77971', 'Naranjada Agua con gas Champán Zumo de papaya Piña Guindas', 88.81, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(59, 9, 1, 'coco-229404', 'Zumo Higo Champán Castañas Granada Ron', 75.6, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(60, 16, 1, 'aguamineral-302482', 'Compota Naranja Vino rosado Anacardos Agua sin gas', 77.3, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(61, 16, 1, 'tédehierbas-184149', 'Zumo de pomelo Vino Limón Cava rosado Chirimoya', 69.39, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(62, 16, 1, 'uvaspasas-108080', 'Cava tinto Canela Guindas Tónica Vino blanco Zumo', 23.77, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(63, 14, 1, 'papaya-227317', 'Chocolate Nuez de Brasil Piña Zumo de pomelo Café', 37.08, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(64, 14, 1, 'zumodelimón-290431', 'Guindas Zumo de piña Zumo de melocotón', 40.48, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(65, 13, 1, 'zumodegranada-372144', 'Melocotón Nuez de Brasil Sandía Pistachos Ginebra', 29.03, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(66, 5, 1, 'zumo-30684', 'Zumo de arándanos Agua Mermelada Agua mineral', 85.4, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(67, 9, 1, 'vodka-227633', 'Cola Nispero Zumo Zumo de mora Higo Vino rosado', 36.86, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(68, 4, 1, 'kiwi-173618', 'Uvas Higos secos Tequila', 13.9, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(69, 15, 1, 'cerveza-303429', 'Caqui Agua mineral Almendra confitada Zumo de pera Almendra', 71.92, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(70, 9, 1, 'tequila-202787', 'Zumo de fruta de la pasión Melocotón Cava', 47.42, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(71, 10, 1, 'zumodegranada-290183', 'Agua con gas Feijoa Zumo de papaya Miel Coco rallado Té verde', 65, '20231107181535.png', 1, '2023-11-07 23:15:24', '2023-09-03 21:20:46'),
(72, 15, 1, 'cocorallado-166457', 'Anacardos Arándanos Almendra confitada Puré de fruta', 14.66, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(73, 15, 1, 'moras-396878', 'Pomelo Champán Agua Almendra confitada Arándanos Cacao', 76.78, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(74, 16, 1, 'kiwi-477018', 'Whisky Cereza Puré de fruta Zumo de uva', 22.9, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(75, 9, 1, 'higossecos-27038', 'Tónica Agua mineral Zumo de piña', 96.35, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(76, 13, 1, 'aguacongas-136564', 'Granada Almendra Té negro', 50.34, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(77, 8, 1, 'uvas-202772', 'Anacardos Ginebra Higo Coco rallado Chirimoya', 83.19, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(78, 13, 1, 'macadamia-415992', 'Cereza Melocotón Whisky', 60.4, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(79, 11, 1, 'castañas-338674', 'Limonada Champán Granada Feijoa', 43.57, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(80, 15, 1, 'macadamia-338593', 'Macadamia Mango Uvas', 78.6, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(81, 4, 1, 'cola-282111', 'Pera Coco rallado Nuez Pasas Moras Puré de fruta', 58.27, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(82, 15, 1, 'brandy-9903', 'Naranja Vodka Zumo de kiwi Cava rosado', 39.57, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(83, 14, 1, 'refresco-86978', 'Higos secos Avellana Vino Té negro', 99.34, NULL, 1, '2023-09-03 21:20:46', '2023-09-03 21:20:46'),
(84, 10, 1, 'aguacate-11863', 'Higo Café Cacahuetes Papaya', 96.32, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(85, 8, 1, 'whisky-305112', 'Melocotón Cola Coco rallado Zumo de naranja', 90.03, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(86, 15, 1, 'zumodekiwi-97341', 'Refresco Zumo de pera Café Cacahuetes', 93.95, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(87, 8, 1, 'almendraconfitada-128677', 'Cola Kiwi Higos secos Papaya Zumo de frambuesa', 54.89, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(88, 9, 1, 'cocorallado-479713', 'Guayaba Zumo de naranja Zumo de piña Cava', 66.24, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(89, 4, 1, 'frambuesas-302912', 'Compota Zumo de papaya Dátiles Zumo de uva Zumo de arándanos', 82.37, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(90, 15, 1, 'brandy-27355', 'Vino rosado Melocotón Agua Guindas', 75.86, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(91, 11, 1, 'pomelo-491723', 'Coco rallado Ginebra Café Té negro Guayaba Manzana', 66.39, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(92, 15, 1, 'tédehierbas-124726', 'Cacahuetes Tequila Zumo de sandía', 20.26, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(93, 4, 1, 'anacardos-32107', 'Café Cerveza Vino tinto Zumo de mango', 32.32, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(94, 15, 1, 'melocotón-333009', 'Miel Mora Frambuesas Cerveza Ciruela', 20.81, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(95, 15, 1, 'té-368204', 'Coco Manzana Cava Zumo de naranja', 58.88, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(96, 11, 1, 'anacardos-410660', 'Canela Refresco Sidra', 58.23, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(97, 13, 1, 'zumodemango-204856', 'Miel Pera Avellana', 49.69, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(98, 9, 1, 'higo-211602', 'Compota Anacardos Cerveza Higo', 33.67, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(99, 14, 1, 'pera-11096', 'Cereza Mango Sandía Zumo de granada', 88.11, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(100, 15, 1, 'champán-174458', 'Ciruela Pistachos Zumo de fresa Naranja', 99.13, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(101, 10, 1, 'cerveza-191286', 'Zumo de piña Zumo de kiwi Avellana Zumo de arándanos', 41.6, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(102, 11, 1, 'zumodemanzana-138058', 'Castañas Uvas Feijoa Zumo de granada Ginebra', 60.57, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(103, 4, 1, 'limonada-287242', 'Granada Agua con gas Vainilla Aguacate Caqui', 89.13, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(104, 4, 1, 'vodka-397495', 'Zumo de fresa Ciruela Zumo de guayaba Vino blanco', 10.9, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(105, 5, 1, 'compota-277064', 'Frambuesas Castañas Zumo de frambuesa Coco Zumo de fruta de la pasión', 26.66, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(106, 9, 1, 'compota-482664', 'Cava rosado Banana Brandy Ron', 52.89, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(107, 15, 1, 'mango-49979', 'Chocolate Coco Naranja Nuez de Brasil Zumo de arándanos Pistachos', 89.38, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(108, 8, 1, 'castañas-158862', 'Zumo Zumo de sandía Zumo Limonada', 30.6, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(109, 5, 1, 'nuezdebrasil-160422', 'Higos secos Compota Pomelo Moras Castañas', 74.13, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(110, 5, 1, 'sandía-348171', 'Uvas pasas Vainilla Vino tinto Macadamia', 22.21, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(111, 5, 1, 'frutadelapasión-106054', 'Agua Zumo de kiwi Banana Anacardos Pistachos Tónica', 71.69, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(112, 5, 1, 'almendraconfitada-490646', 'Puré de fruta Cola Zumo de kiwi', 86.25, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(113, 16, 1, 'pasas-207451', 'Aguacate Agua mineral Macadamia', 51.15, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(114, 15, 1, 'cava-314893', 'Vino tinto Macadamia Zumo de fruta de la pasión', 96.81, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(115, 9, 1, 'fresas-436075', 'Canela Sidra Nuez', 11.89, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(116, 13, 1, 'mora-389237', 'Nuez Naranjada Fruta de la pasión Higos pasos Chirimoya Zumo de manzana', 76.62, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(117, 16, 1, 'zumodeuva-224003', 'Naranja Higos secos Whisky', 93.3, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(118, 15, 1, 'zumodepapaya-360288', 'Fruta de la pasión Zumo de kiwi Zumo', 53.72, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(119, 13, 1, 'agua-221284', 'Higos pasos Zumo Puré de fruta', 96.87, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(120, 9, 1, 'cacahuetes-17956', 'Té negro Té verde Zumo de guayaba Mora Zumo', 62.23, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(121, 10, 1, 'papaya-89588', 'Zumo de pera Dátiles Agua con gas Moras Agua sin gas Zumo de sandía', 37.1, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(122, 10, 1, 'manzana-170558', 'Zumo de guayaba Frambuesas Naranjada', 58.7, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(123, 5, 1, 'feijoa-402128', 'Vino tinto Arándanos Zumo Macadamia Zumo de fruta de la pasión', 77.42, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(124, 16, 1, 'compota-431568', 'Vino tinto Almendra confitada Miel Caqui Vodka', 10.42, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(125, 11, 1, 'zumodesandía-105252', 'Tequila Sidra Whisky', 22.81, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(126, 5, 1, 'brandy-42743', 'Guindas Zumo de melocotón Cacahuetes Puré de fruta Zumo de frambuesa', 35.37, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(127, 14, 1, 'café-341236', 'Zumo de pera Anacardos Cola Almendra', 10.05, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(128, 16, 1, 'purédefruta-150705', 'Feijoa Jalea Zumo de manzana Zumo de sandía Canela Pasas', 82.87, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(129, 15, 1, 'zumodeuva-202001', 'Piña Agua sin gas Zumo de limón Zumo de uva Uvas Aguacate', 40.92, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(130, 16, 1, 'refresco-19799', 'Moras Zumo de guayaba Almendra confitada', 34.82, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(131, 9, 1, 'ciruela-68275', 'Higo Cava Vino tinto Agua Zumo de fresa Zumo de granada', 50.29, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(132, 5, 1, 'zumodemelocotón-125076', 'Pasas Guayaba Aguacate Vino blanco Zumo de naranja', 79.12, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(133, 15, 1, 'zumodegranada-355581', 'Kiwi Brandy Fruta de la pasión Moras Nuez Zumo de pomelo', 14.03, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(134, 13, 1, 'tequila-267313', 'Pistachos Zumo de fruta de la pasión Papaya Banana', 56.06, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(135, 5, 1, 'frambuesas-35943', 'Zumo de piña Higo Anacardos Moras', 43.84, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(136, 5, 1, 'limón-248778', 'Zumo de fruta de la pasión Agua sin gas Zumo de piña', 25.07, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(137, 14, 1, 'nuez-488525', 'Zumo de kiwi Agua mineral Zumo de uva', 15.24, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(138, 8, 1, 'arándanos-327001', 'Uvas Canela Zumo de piña Compota Mora Té verde', 78.21, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(139, 10, 1, 'té-137739', 'Café Zumo de ciruela Mango Coco rallado Zumo de uva Zumo de papaya', 96.28, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(140, 15, 1, 'agua-216614', 'Chocolate Cerveza Zumo de limón', 91.09, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(141, 13, 1, 'nuezdebrasil-218806', 'Zumo de arándanos Manzana Zumo de pomelo Vino blanco Almendra', 84.09, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(142, 15, 1, 'naranjada-187316', 'Zumo de mora Nuez de Brasil Zumo de limón Cava blanco Almendra confitada Moras', 67.26, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(143, 16, 1, 'cava-334819', 'Cacahuetes Zumo de kiwi Aguacate Melocotón Limonada', 52.86, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(144, 5, 1, 'vino-354594', 'Whisky Zumo de kiwi Fruta de la pasión Tónica', 81.89, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(145, 14, 1, 'mora-306970', 'Cola Fruta de la pasión Limonada Coco Ron', 67.11, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(146, 11, 1, 'castañas-154107', 'Canela Anacardos Cava tinto Vino blanco Anacardos Cava tinto', 32.68, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(147, 13, 1, 'zumodeciruela-400440', 'Chirimoya Pera Zumo de guayaba Agua con gas', 67.1, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(148, 8, 1, 'moras-109099', 'Zumo de kiwi Dátiles Champán', 54.4, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(149, 9, 1, 'té-145520', 'Almendra Té de hierbas Fruta de la pasión Limonada', 33.5, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(150, 14, 1, 'ciruela-252797', 'Cereza Nuez de Brasil Fruta de la pasión Avellana Fruta de la pasión', 47.4, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(151, 13, 1, 'whisky-497892', 'Café Cola Whisky Chocolate Zumo de melocotón', 80.97, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(152, 14, 1, 'aguasingas-441124', 'Fruta de la pasión Sandía Mango', 96.89, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(153, 14, 1, 'almendra-124356', 'Melocotón Té Mora Zumo Pera', 65.87, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(154, 15, 1, 'zumodenaranja-373774', 'Zumo de pera Frambuesas Canela Tónica', 65.33, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(155, 5, 1, 'vinotinto-45459', 'Ginebra Castañas Ron Feijoa Ginebra', 57.5, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(156, 4, 1, 'ron-265980', 'Kiwi Frambuesas Zumo de mora', 45.15, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(157, 11, 1, 'dátiles-206398', 'Cava rosado Agua Tequila Cereza Coco Pistachos', 69.33, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(158, 10, 1, 'zumodefrutadelapasión-201060', 'Aguacate Naranjada Uvas Canela Feijoa', 21.14, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(159, 11, 1, 'zumodekiwi-187134', 'Cava rosado Cereza Sandía Coco rallado Té negro', 82.24, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(160, 15, 1, 'kiwi-350953', 'Limonada Zumo de piña Mermelada Granada', 54.84, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(161, 5, 1, 'anacardos-411127', 'Cola Agua mineral Cola Zumo de papaya Almendra', 62.07, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(162, 16, 1, 'pistachos-263286', 'Brandy Champán Zumo de pera Cava rosado Manzana Higos pasos', 76.04, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(163, 11, 1, 'zumodemango-127824', 'Zumo de piña Cereza Guayaba Zumo de piña Agua', 33.38, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(164, 4, 1, 'uvaspasas-455721', 'Zumo de mora Almendra confitada Fruta de la pasión Cerveza', 40.45, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(165, 8, 1, 'pistachos-306135', 'Moras Cereza Zumo de sandía Sandía Kiwi Canela', 51.48, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(166, 16, 1, 'caqui-333221', 'Naranja Té Cacao Refresco Ron Uvas pasas', 99.09, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(167, 9, 1, 'coco-95018', 'Zumo de melocotón Papaya Jalea Zumo de ciruela', 99.36, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(168, 11, 1, 'cereza-384833', 'Zumo de arándanos Cava blanco Uvas Vino tinto Cacahuetes Banana', 35.5, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(169, 15, 1, 'dátiles-489227', 'Melocotón Té Manzana', 47.84, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(170, 15, 1, 'vinotinto-291158', 'Uvas Zumo de sandía Guindas Compota Agua con gas', 41.48, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(171, 15, 1, 'cerveza-480959', 'Zumo de frambuesa Zumo de manzana Tónica Tónica Ginebra', 46.38, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(172, 9, 1, 'zumodesandía-101665', 'Zumo de uva Zumo de arándanos Guindas Pera Moras Caqui', 85.59, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(173, 10, 1, 'sidra-32379', 'Coco Zumo de pera Zumo de fruta de la pasión Zumo de piña', 61.02, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(174, 5, 1, 'téverde-17312', 'Pistachos Chocolate Zumo de mango', 24, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(175, 8, 1, 'limón-247272', 'Sidra Chirimoya Almendra Mermelada Fruta de la pasión', 17.03, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(176, 8, 1, 'coco-473367', 'Guindas Zumo de melocotón Piña Guayaba', 58.48, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(177, 14, 1, 'zumodefrutadelapasión-16008', 'Zumo de granada Zumo de uva Ginebra', 29.42, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(178, 13, 1, 'té-169537', 'Pasas Té Higo Nispero', 39.46, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(179, 16, 1, 'vodka-462277', 'Avellana Zumo de arándanos Cola Cereza', 72.85, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(180, 13, 1, 'cavablanco-415368', 'Ron Fresas Naranja', 33.07, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(181, 10, 1, 'zumodemelocotón-375836', 'Cava Chirimoya Uvas pasas Caqui', 37.52, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(182, 8, 1, 'manzana-409703', 'Pasas Higo Tónica Nuez', 34.11, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(183, 9, 1, 'cola-456206', 'Kiwi Cava blanco Pistachos Pera Ron', 69.51, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(184, 14, 1, 'zumodemango-306153', 'Refresco Uvas Fresas Chirimoya Papaya Whisky', 37.4, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(185, 8, 1, 'pistachos-245988', 'Pasas Zumo Zumo de frambuesa Papaya', 69.26, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(186, 4, 1, 'brandy-47512', 'Fruta de la pasión Zumo de ciruela Ciruela Manzana Puré de fruta Higo', 15.3, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(187, 13, 1, 'whisky-254561', 'Cava blanco Ciruela Agua', 69.63, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(188, 15, 1, 'melocotón-404563', 'Ron Zumo de mango Cerveza', 68.78, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(189, 16, 1, 'cerveza-11614', 'Zumo de fruta de la pasión Zumo Vino rosado', 65.7, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(190, 5, 1, 'limonada-142244', 'Macadamia Agua con gas Ciruela Coco rallado', 40.14, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(191, 13, 1, 'avellana-481634', 'Vodka Zumo de kiwi Vino blanco Zumo de papaya Limón', 64.05, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(192, 16, 1, 'zumodegranada-306831', 'Vainilla Zumo de pomelo Tequila Tequila Mora', 34.31, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(193, 11, 1, 'macadamia-90966', 'Vino blanco Zumo de guayaba Zumo de sandía Fresas', 48.33, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(194, 5, 1, 'guindas-351948', 'Manzana Zumo de sandía Tequila Whisky Zumo de limón Limón', 91.31, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(195, 16, 1, 'limón-79641', 'Cacao Naranja Mango Melocotón Sidra', 35.07, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(196, 10, 1, 'zumodelimón-351217', 'Zumo de fresa Mora Zumo de arándanos', 49.59, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(197, 8, 1, 'vinorosado-291310', 'Agua Compota Zumo de sandía Guindas Zumo de papaya Higo', 59.84, '20231116141958.jpg', 1, '2023-11-16 20:48:25', '2023-09-03 21:20:47'),
(198, 15, 1, 'tédehierbas-339222', 'Pistachos Nuez Guayaba Cacao', 67.31, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(199, 15, 1, 'café-57373', 'Zumo de fresa Granada Cerveza Cacao Agua con gas Zumo de fruta de la pasión', 18.32, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(200, 10, 1, 'mango-369255', 'Brandy Tónica Zumo de uva Zumo de naranja', 99.38, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(201, 4, 1, 'nuezdebrasil-162841', 'Fruta de la pasión Limón Higo Coco rallado Almendra confitada', 40.03, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(202, 13, 1, 'té-90502', 'Zumo de uva Zumo de sandía Nispero Pasas', 82.95, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(203, 15, 1, 'anacardos-201838', 'Dátiles Zumo de guayaba Pasas', 28.43, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(204, 16, 1, 'champán-288392', 'Zumo de kiwi Zumo de melocotón Caqui Uvas Guayaba Coco rallado', 81.88, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(205, 16, 1, 'zumodeuva-77761', 'Tónica Ron Jalea', 16.83, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(206, 13, 1, 'compota-438933', 'Manzana Café Ron Zumo de melocotón Tequila', 56.62, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(207, 15, 1, 'mermelada-402828', 'Tequila Cacahuetes Ron Guayaba', 38.83, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(208, 5, 1, 'cavatinto-210369', 'Agua mineral Zumo de fruta de la pasión Anacardos', 30.11, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(209, 15, 1, 'higospasos-2534', 'Arándanos Zumo de melocotón Zumo de limón Zumo de ciruela Zumo de granada', 74.35, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(210, 16, 1, 'zumodesandía-235121', 'Café Macadamia Pasas Nuez de Brasil', 53.44, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(211, 8, 1, 'cacao-177859', 'Agua sin gas Naranjada Higos pasos Mango Mora', 79.29, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(212, 9, 1, 'ron-261862', 'Agua Nuez de Brasil Refresco Papaya Caqui Zumo de guayaba', 27.22, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(213, 4, 1, 'zumo-163705', 'Nuez Nuez Uvas pasas Moras Frambuesas Puré de fruta', 83.11, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(214, 13, 1, 'zumodearándanos-471277', 'Nispero Zumo de granada Dátiles Feijoa Tequila', 48.75, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(215, 5, 1, 'castañas-480942', 'Zumo de ciruela Cereza Zumo de pomelo Zumo de manzana', 65.41, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(216, 10, 1, 'ron-404963', 'Agua sin gas Canela Pera Cerveza', 99.99, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(217, 8, 1, 'zumodepiña-4820', 'Zumo de manzana Cacahuetes Cacahuetes Melocotón', 54.68, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(218, 13, 1, 'manzana-285670', 'Naranja Sidra Cava tinto Cava blanco', 79.97, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(219, 15, 1, 'frutadelapasión-284392', 'Zumo de piña Té de hierbas Sidra Nuez Zumo de papaya Zumo de frambuesa', 66.29, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(220, 15, 1, 'tédehierbas-50955', 'Castañas Vino rosado Zumo de melocotón Cacao Mermelada', 33.47, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(221, 9, 1, 'arándanos-80202', 'Nuez Higos secos Zumo de granada Higos secos Zumo de papaya', 46.51, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(222, 9, 1, 'agua-178296', 'Miel Granada Castañas', 43.93, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(223, 10, 1, 'cavablanco-293270', 'Cerveza Zumo de fruta de la pasión Nispero Zumo de papaya Coco rallado Zumo de mora', 17.9, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(224, 10, 1, 'zumodeguayaba-454255', 'Cola Café Zumo de limón Zumo de ciruela', 48.61, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(225, 8, 1, 'higo-378958', 'Miel Naranjada Moras Tónica Zumo de sandía', 94.37, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(226, 11, 1, 'nuez-425308', 'Cacahuetes Mora Vino tinto', 95.54, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(227, 15, 1, 'vinoblanco-408456', 'Zumo de fruta de la pasión Pistachos Caqui Refresco', 97.84, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(228, 15, 1, 'feijoa-39178', 'Higos pasos Chocolate Cava rosado Cerveza', 11.9, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(229, 15, 1, 'cavatinto-85991', 'Cava rosado Higos pasos Champán Manzana Zumo de arándanos Cacahuetes', 28.3, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(230, 15, 1, 'zumodegranada-165668', 'Feijoa Arándanos Cerveza Zumo de papaya Mermelada', 79.46, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(231, 4, 1, 'aguamineral-158902', 'Té verde Zumo de fruta de la pasión Zumo de granada', 20.87, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(232, 9, 1, 'ténegro-418321', 'Banana Té Cerveza Refresco Zumo de limón Ron', 38.95, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(233, 16, 1, 'chirimoya-289459', 'Ciruela Pomelo Agua sin gas Uvas', 17.96, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(234, 10, 1, 'guindas-21162', 'Sandía Nispero Canela Uvas Zumo de mora Té negro', 72.18, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(235, 13, 1, 'café-256554', 'Agua mineral Macadamia Vainilla', 24.9, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(236, 15, 1, 'limonada-46165', 'Zumo de piña Naranja Zumo de piña Melocotón Agua', 99.02, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(237, 5, 1, 'aguacate-52640', 'Agua mineral Ginebra Limón', 39.37, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(238, 14, 1, 'naranja-4721', 'Pomelo Banana Cola Limonada Feijoa', 56.42, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(239, 16, 1, 'zumodefrutadelapasión-323943', 'Aguacate Mango Coco', 20.9, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(240, 4, 1, 'limonada-339033', 'Vino Vino rosado Mora Zumo de mora', 44.44, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(241, 9, 1, 'arándanos-200850', 'Zumo de fresa Papaya Papaya Chirimoya Vino blanco', 75.32, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(242, 5, 1, 'pasas-218466', 'Melocotón Zumo de papaya Zumo de limón', 29.44, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(243, 11, 1, 'ciruela-69879', 'Kiwi Chirimoya Zumo de pera Zumo de pera Zumo de guayaba Zumo de mora', 87.5, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(244, 14, 1, 'guayaba-127457', 'Sandía Chocolate Ron', 48.57, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(245, 15, 1, 'cacahuetes-380895', 'Cacao Nuez Pasas Coco rallado', 20.95, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(246, 8, 1, 'zumodeciruela-149968', 'Sidra Chirimoya Cava rosado Té verde Pistachos Zumo de uva', 14.9, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(247, 15, 1, 'vinorosado-298472', 'Guayaba Compota Avellana Mora Champán', 95.42, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(248, 8, 1, 'guayaba-241773', 'Almendra confitada Cola Ginebra', 86.64, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(249, 8, 1, 'vino-256053', 'Zumo de kiwi Cerveza Cava blanco Refresco Moras Frambuesas', 69.04, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(250, 10, 1, 'purédefruta-372670', 'Avellana Feijoa Agua sin gas', 14.15, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(251, 16, 1, 'té-374882', 'Canela Zumo de arándanos Banana Brandy Mermelada Banana', 23, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(252, 4, 1, 'naranja-33902', 'Vino rosado Vino Chocolate Zumo de melocotón Cacao', 51.66, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(253, 8, 1, 'cereza-482914', 'Miel Agua sin gas Cava Pasas Vino tinto Papaya', 42.78, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(254, 10, 1, 'pomelo-465312', 'Agua mineral Fresas Vino tinto Pomelo Higo Zumo de frambuesa', 68.1, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(255, 11, 1, 'zumodepapaya-422270', 'Canela Vodka Zumo de pomelo', 37.97, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(256, 15, 1, 'frutadelapasión-88865', 'Sandía Zumo de granada Sandía Zumo de piña Ron', 34.47, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(257, 8, 1, 'vinoblanco-276851', 'Manzana Anacardos Brandy Sidra', 68.65, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(258, 13, 1, 'pasas-354089', 'Zumo de piña Nispero Té Coco rallado Frambuesas Higos pasos', 24.83, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(259, 8, 1, 'zumodefrutadelapasión-252148', 'Ron Almendra confitada Puré de fruta', 88.59, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(260, 9, 1, 'anacardos-105455', 'Refresco Cerveza Zumo de arándanos', 16.09, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(261, 11, 1, 'refresco-411050', 'Chirimoya Cacao Chirimoya Coco Ginebra', 48.83, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(262, 9, 1, 'zumodemanzana-161175', 'Compota Cava blanco Aguacate Chirimoya', 71, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(263, 11, 1, 'zumodeguayaba-29836', 'Melocotón Higos secos Zumo de papaya Zumo de fruta de la pasión Zumo de sandía', 42.79, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(264, 15, 1, 'zumodeguayaba-28695', 'Melocotón Zumo de uva Té negro Zumo de fresa', 46.41, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(265, 8, 1, 'macadamia-169652', 'Sidra Compota Cava rosado Fruta de la pasión Vainilla', 92.25, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(266, 11, 1, 'higo-292184', 'Banana Banana Ron Kiwi', 84.94, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(267, 9, 2, '9302326155', 'Agua con gas Aguacate Zumo de ciruela Nuez de Brasil Zumo de ciruela', 53.48, '20231109154618.jpg', 1, '2023-11-16 21:03:19', '2023-09-03 21:20:47'),
(268, 10, 1, 'zumodearándanos-451654', 'Pistachos Macadamia Kiwi', 50.37, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(269, 15, 1, 'nispero-268062', 'Vino tinto Cacao Agua sin gas Cacahuetes Arándanos Nuez de Brasil', 98.86, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(270, 11, 1, 'cavarosado-42141', 'Zumo de pera Cacao Sandía Cava blanco', 82.52, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(271, 15, 1, 'vodka-90958', 'Mango Chocolate Pasas', 93.1, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(272, 15, 1, 'dátiles-274959', 'Zumo de pomelo Avellana Castañas Vino rosado', 55.26, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(273, 8, 1, 'anacardos-17707', 'Cerveza Agua mineral Coco rallado Chirimoya Té verde', 25.44, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(274, 5, 1, 'zumodepiña-352911', 'Cava blanco Zumo de granada Zumo de fruta de la pasión', 24.21, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(275, 16, 1, 'papaya-331894', 'Uvas Zumo de melocotón Café', 65.22, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(276, 8, 1, 'compota-43614', 'Canela Fresas Pistachos Papaya Almendra confitada Nispero', 88.61, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(277, 16, 1, 'higossecos-335922', 'Vino Zumo de melocotón Zumo de granada Kiwi Mermelada Arándanos', 50.09, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(278, 15, 1, 'guayaba-229030', 'Anacardos Agua con gas Papaya', 73.5, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(279, 5, 1, 'guindas-1806', 'Caqui Vino blanco Chirimoya Mango Refresco Frambuesas', 76.63, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(280, 11, 1, 'ténegro-317843', 'Zumo de naranja Zumo Jalea Champán', 86.27, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(281, 8, 1, 'mermelada-176715', 'Fresas Pasas Té verde Agua con gas Ron Canela', 28.14, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(282, 16, 1, 'zumodekiwi-100642', 'Jalea Naranja Mora', 76.31, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(283, 9, 1, 'uvaspasas-385795', 'Nuez Limón Cacahuetes', 94.01, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(284, 13, 1, 'arándanos-487747', 'Zumo de mora Puré de fruta Vino Zumo de guayaba', 62.89, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(285, 14, 1, 'sidra-136725', 'Zumo de manzana Kiwi Arándanos', 63.35, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(286, 14, 1, 'ginebra-445754', 'Zumo de mora Agua Zumo de limón Té de hierbas', 68.86, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(287, 11, 1, 'canela-134930', 'Zumo de manzana Higos secos Cacao Cereza Zumo de fresa Té negro', 29.75, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(288, 10, 1, 'macadamia-389785', 'Feijoa Higo Feijoa Miel', 68.77, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(289, 15, 1, 'champán-230129', 'Zumo de mango Compota Agua con gas', 93.27, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(290, 11, 1, 'cereza-157496', 'Cola Zumo de limón Ron Miel Cola Papaya', 42.03, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(291, 4, 1, 'kiwi-59455', 'Anacardos Cereza Frambuesas Guayaba Cava tinto Zumo de piña', 54.48, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(292, 14, 1, 'mora-195864', 'Zumo de kiwi Puré de fruta Manzana', 29.31, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(293, 10, 1, 'zumodelimón-270729', 'Vino blanco Vino Ron Zumo de sandía Cava rosado', 50.66, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(294, 16, 1, 'chirimoya-291831', 'Anacardos Agua Papaya Zumo de piña Caqui Ron', 34.26, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(295, 13, 1, 'pomelo-311526', 'Cava blanco Sandía Zumo de manzana Sidra Cerveza Pera', 83.82, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(296, 4, 1, 'miel-204245', 'Castañas Vino tinto Mermelada', 15, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(297, 8, 1, 'vinoblanco-475855', 'Refresco Higo Chocolate Cava blanco Ron', 59.81, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(298, 14, 1, 'melocotón-209947', 'Cereza Té de hierbas Naranja', 68.61, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(299, 14, 1, 'whisky-80183', 'Macadamia Té Ciruela Arándanos Sidra', 33.94, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(300, 11, 1, 'frambuesas-283222', 'Cava Brandy Cacahuetes Jalea', 74.44, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(301, 4, 1, 'frutadelapasión-382543', 'Piña Pistachos Agua sin gas Té Higos pasos Refresco', 22.35, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(302, 8, 1, 'cavatinto-261408', 'Brandy Agua con gas Nispero Zumo de limón Zumo de frambuesa', 47.58, NULL, 1, '2023-09-03 21:20:47', '2023-09-03 21:20:47'),
(303, 9, 1, 'CI19283', 'Cualqueira vaina', 33.29, '20231108170615.jpg', 1, '2023-11-16 21:04:40', '2023-11-08 22:06:04'),
(304, 8, 2, '1442931302', 'Consulta medica de fulanito', 33, '20231116152247.jpg', 1, '2023-11-16 20:22:58', '2023-11-16 20:14:10');

-- --------------------------------------------------------

--
-- 테이블 구조 `product_category`
--

CREATE TABLE `product_category` (
  `category_id` int(11) NOT NULL,
  `category` varchar(200) NOT NULL,
  `valid` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `product_category`
--

INSERT INTO `product_category` (`category_id`, `category`, `valid`) VALUES
(2, 'Ortopedico', 0),
(3, 'Ortopedico', 0),
(4, 'Ortopedico', 1),
(5, 'otra categoria', 1),
(6, 'probando una mas', 0),
(7, 'hola coo estas?', 0),
(8, 'Consultas', 1),
(9, 'Insumos', 1),
(10, 'Pasteles', 1),
(11, 'Tortas', 1),
(12, 'Bebidas alcoholicas', 1),
(13, 'Bebidas no alcoholicas', 1),
(14, 'Te', 1),
(15, 'Gaseosa', 1),
(16, 'Pizzas', 1),
(17, 'nueva categoria', 1),
(18, 'new bla bla', 0);

-- --------------------------------------------------------

--
-- 테이블 구조 `product_image`
--

CREATE TABLE `product_image` (
  `image_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(50) NOT NULL,
  `valid` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `product_image`
--

INSERT INTO `product_image` (`image_id`, `product_id`, `image`, `valid`) VALUES
(2, 1, '20230817115625.png', 0),
(3, 1, '20230817120250.png', 0),
(4, 1, '20230817120544.png', 0),
(5, 1, '20230817120548.png', 0),
(6, 1, '20230817120657.png', 0),
(7, 1, '20230817122501.png', 0),
(8, 1, '20230829140809.png', 0),
(9, 1, '20230829142145.png', 0),
(10, 1, '20230829142216.png', 0),
(11, 1, '20230829151131.png', 0),
(12, 1, '20230829151141.png', 0),
(13, 1, '20230829151523.png', 0),
(14, 1, '20230829151855.png', 0),
(15, 1, '20230829160516.png', 0),
(16, 1, '20230829160539.png', 0),
(17, 1, '20230829160558.png', 0),
(18, 1, '20230829170435.png', 0),
(19, 1, '20230829170624.png', 0),
(20, 1, '20230829171427.png', 0),
(21, 1, '20230829171522.png', 0),
(22, 1, '20230829171546.png', 0),
(23, 1, '20230829171753.png', 0),
(24, 1, '20230829171924.png', 0),
(25, 1, '20230829172727.png', 0),
(26, 1, '20230829172923.png', 0),
(27, 1, '20230829172933.png', 0),
(28, 1, '20230829173001.png', 1),
(29, 2, '20230829175952.png', 0),
(30, 197, '20230919181851.png', 0),
(31, 267, '20231106164736.jpg', 0),
(32, 267, '20231106164925.jpg', 0),
(33, 267, '20231106165038.jpg', 0),
(34, 267, '20231106165050.png', 0),
(35, 267, '20231106170122.jpeg', 0),
(36, 267, '20231106170757.jpg', 0),
(37, 267, '20231106170940.png', 0),
(38, 267, '20231106171207.jpg', 0),
(39, 267, '20231106171359.jpg', 0),
(40, 267, '20231106175314.jpg', 0),
(41, 267, '20231106175905.jpg', 0),
(42, 267, '20231106180034.jpg', 0),
(43, 267, '20231107142004.jpg', 0),
(44, 267, '20231107142141.jpg', 0),
(45, 267, '20231107153203.jpg', 0),
(46, 267, '20231107153556.jpg', 0),
(47, 267, '20231107153608.jpg', 0),
(48, 71, '20231107181535.png', 1),
(49, 303, '20231108170615.jpg', 1),
(50, 267, '20231109154618.jpg', 1),
(51, 197, '20231115183123.jpg', 0),
(52, 197, '20231116141717.jpg', 0),
(53, 197, '20231116141738.jpg', 0),
(54, 197, '20231116141948.jpg', 0),
(55, 197, '20231116141958.jpg', 1),
(56, 304, '20231116152247.jpg', 1);

-- --------------------------------------------------------

--
-- 테이블 구조 `product_option`
--

CREATE TABLE `product_option` (
  `option_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `option` varchar(100) NOT NULL,
  `stock` int(11) NOT NULL,
  `valid` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `product_option`
--

INSERT INTO `product_option` (`option_id`, `product_id`, `option`, `stock`, `valid`) VALUES
(1, 1, 'Rosado', 123, 0),
(2, 1, 'Negro', 13, 0),
(3, 1, 'Verde', 123, 0),
(4, 1, 'Azul', 1500, 0),
(5, 1, 'testing123', 123, 0),
(6, 1, 'hola', 12348, 0),
(7, 1, 'testing', 2222, 0),
(8, 1, 'otra cosa', 3321, 0),
(9, 1, 'testing3', 123123, 0),
(10, 1, 'talla S - Rosado', 1123, 0),
(11, 1, 'nyev', 1295, 0),
(12, 1, 'Amarillo', 4, 0),
(13, 1, 'Rosadoa', 1234, 0),
(14, 1, 'aaa', 44, 0),
(15, 1, 'asdf', 111, 0),
(16, 1, 'sdaf', 11, 0),
(17, 1, 'aa1', 33, 0),
(18, 1, 'aa12', 23123, 0),
(19, 1, 'a111111111', 1234, 0),
(20, 1, 'a3', 33, 0),
(21, 1, 'aa', 33, 0),
(22, 1, 'Negro', 143, 0),
(23, 1, 'Rosado', 12375, 0),
(24, 1, 'Talla S', 157, 0),
(25, 1, 'Rosado', 77, 0),
(26, 1, 'Negro', 124, 1),
(27, 197, 'Talla SS', 69, 1),
(28, 197, 'Talla MM', 203, 1),
(29, 197, 'Talla L', 12, 1),
(30, 216, '7L', 300, 1),
(31, 71, 'Verde', 300, 1),
(32, 197, '-', 7, 0),
(33, 254, '-', 100, 1),
(34, 197, 'Talla XS', 0, 1),
(35, 254, '--', 0, 1),
(36, 197, 'Talla XL', 0, 1),
(37, 254, '---', 0, 1),
(38, 162, '-', 0, 1),
(39, 8, '-', 0, 1),
(40, 235, 'Talla M - Talla Asia', 0, 1),
(41, 235, 'Talla M', 0, 0),
(42, 235, 'Talla M', 0, 1),
(43, 235, 'Talla L', 0, 1),
(44, 197, 'dfsdaf', 0, 1);

-- --------------------------------------------------------

--
-- 테이블 구조 `product_type`
--

CREATE TABLE `product_type` (
  `type_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `product_type`
--

INSERT INTO `product_type` (`type_id`, `type`) VALUES
(1, 'Producto'),
(2, 'Servicio');

-- --------------------------------------------------------

--
-- 테이블 구조 `proforma`
--

CREATE TABLE `proforma` (
  `proforma_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `validity` date DEFAULT NULL,
  `remark` text NOT NULL,
  `valid` tinyint(1) NOT NULL DEFAULT 1,
  `registed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `proforma`
--

INSERT INTO `proforma` (`proforma_id`, `client_id`, `amount`, `validity`, `remark`, `valid`, `registed_at`) VALUES
(1, 7, 1490, '2023-10-21', 'Descuento por mayorista', 1, '2023-10-07 22:36:14'),
(2, 8, 150, '2023-10-21', 'cliente no tiene dinero', 1, '2023-10-07 23:11:35'),
(3, 11, 1000, '2024-01-30', 'Descuento por compra mayor', 0, '2023-10-10 22:38:14'),
(4, 14, 280, '2023-11-30', 'Descuento por mayorista', 1, '2023-10-23 20:30:42'),
(5, 15, 164, '2023-11-02', '- Termino de Pago: 30% adelanto / 70% dia de instalacion\r\n- Para una clinica\r\n- Descuento especial por mayor', 1, '2023-10-26 20:01:00');

-- --------------------------------------------------------

--
-- 테이블 구조 `proforma_product`
--

CREATE TABLE `proforma_product` (
  `proforma_product_id` int(11) NOT NULL,
  `proforma_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `price` double NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `proforma_product`
--

INSERT INTO `proforma_product` (`proforma_product_id`, `proforma_id`, `product_id`, `option_id`, `price`, `qty`) VALUES
(1, 1, 197, 27, 55, 20),
(2, 1, 1, 26, 13, 30),
(3, 2, 197, 29, 50, 3),
(4, 3, 197, 29, 50, 20),
(5, 4, 1, 26, 14, 20),
(6, 5, 1, 26, 14, 1),
(7, 5, 197, 27, 50, 3);

-- --------------------------------------------------------

--
-- 테이블 구조 `provider`
--

CREATE TABLE `provider` (
  `provider_id` int(11) NOT NULL,
  `doc_type_id` int(11) NOT NULL,
  `doc_number` varchar(30) NOT NULL,
  `name` varchar(250) NOT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `valid` tinyint(1) NOT NULL DEFAULT 1,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `registed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `provider`
--

INSERT INTO `provider` (`provider_id`, `doc_type_id`, `doc_number`, `name`, `tel`, `mobile`, `email`, `address`, `image`, `valid`, `updated_at`, `registed_at`) VALUES
(1, 2, '76408531', 'LEA MABEL SILUPU MONTALVAN', '', '', NULL, '', NULL, 1, '2023-09-16 23:05:39', '2023-09-16 23:05:39'),
(2, 2, '70614226', 'SOFIA LISSET CASAVERDE VALDIVIEZO', '', '', NULL, '', NULL, 1, '2023-09-17 20:50:05', '2023-09-17 20:50:05'),
(3, 2, '75694084', 'FRANCESCA JENNIFER OLAYA CAMACHO', '', '', NULL, '', NULL, 1, '2023-09-17 22:19:28', '2023-09-17 22:19:28'),
(4, 2, '75098340', 'YESABELLA ESPERANZA UBILLUS MORALES', '', '', NULL, '', NULL, 1, '2023-09-21 21:50:14', '2023-09-21 21:50:14'),
(5, 2, '75763698', 'ESTHEFANY DE LOS MILAGROS HERRERA CHECA', '', '', NULL, '', NULL, 1, '2023-09-25 21:29:42', '2023-09-25 21:29:42'),
(6, 2, '75112025', 'YARIS NAYELY CALLE CASTILLO', '', '', NULL, '', NULL, 1, '2023-10-05 00:33:52', '2023-10-05 00:33:52'),
(7, 3, '000765808', 'Jeong Woo Park', '', '', NULL, '', NULL, 1, '2023-10-07 22:08:29', '2023-10-07 22:08:29'),
(8, 2, '48098843', 'ROSA DEL CARMEN GARRIDO MORE', '', '', NULL, '', NULL, 1, '2023-10-07 23:11:35', '2023-10-07 23:11:35'),
(9, 4, '20454193556', 'COMERCIAL FERNANDA\'S S.R.L.', '', '', NULL, '', NULL, 1, '2023-10-09 23:22:01', '2023-10-09 23:22:01'),
(10, 2, '76147068', 'JACKELINE DEL PILAR ARCELES VINCES', '', '', NULL, '', NULL, 1, '2023-10-10 21:40:41', '2023-10-10 21:40:41'),
(11, 2, '74896747', 'CARLOS DAVID VILELA VILCHEZ', '', '', NULL, '', NULL, 1, '2023-10-10 22:38:14', '2023-10-10 22:38:14'),
(12, 4, '20405441862', 'INGEMET CPI EMPRESA INDIVIDUAL DE RESPONSABILIDAD LIMITADA', '', '', NULL, '', NULL, 1, '2023-10-20 22:37:38', '2023-10-20 22:37:38'),
(13, 4, '20364169982', 'EMGESA S.A.C.', '', '', NULL, '', NULL, 1, '2023-10-20 22:57:43', '2023-10-20 22:57:43'),
(14, 2, '72879477', 'MARIA FERNANDA VASQUEZ EVANGELISTA', '01 241 2345', '99 888 777', NULL, 'Av Aviacion 3204, San Borja, Lima, Peru', NULL, 1, '2023-10-23 20:30:42', '2023-10-23 20:30:42'),
(15, 2, '76155454', 'Emily Delgado', NULL, NULL, NULL, NULL, NULL, 1, '2023-10-26 20:01:00', '2023-10-26 20:01:00'),
(17, 4, '20387144901', 'RD HIDRAULICA S.R.L.', '', '', '', '', NULL, 1, '2023-11-02 23:13:11', '2023-11-02 23:13:11'),
(18, 4, '20408058261', 'CLINICA EVERLYN S.A.C.', '', '', '', '', NULL, 1, '2023-11-02 23:17:29', '2023-11-02 23:17:29'),
(19, 4, '20448426701', 'ALE BIENES Y SERVICIOS EN GENERAL SOCIEDAD ANONIMA CERRADA', NULL, NULL, NULL, NULL, '4_20448426701_20231109183244.jpg', 1, '2023-11-03 19:18:11', '2023-11-03 19:18:11'),
(20, 3, '000765804', 'Henry Calle', '345-6785', '908-237-473', 'h.calle@pontafina.com', 'Cl. Mexico ciudad 283, Cercado de Lima', '3_000765804_20231104161853.jpg', 1, '2023-11-03 23:22:13', '2023-11-03 20:37:49'),
(21, 5, 'M68303812', 'Jeong Woo fulanito', '241-29371', '999-123-5831', 'hola@dff.com1', '1', '5_M68303812_20231110163414.jpg', 1, '2023-11-10 21:22:00', '2023-11-10 20:46:12'),
(22, 7, '38463498', 'Dongwon Hyd - Coreana', NULL, NULL, NULL, NULL, NULL, 1, '2023-11-14 22:06:17', '2023-11-14 22:06:17'),
(23, 4, '20517206955', 'HEADMARK CORPORATION S.A.C.', '', '', '', '', '4_20517206955_20231116180033.png', 1, '2023-11-16 23:04:54', '2023-11-16 21:40:36');

-- --------------------------------------------------------

--
-- 테이블 구조 `provider_doc_type`
--

CREATE TABLE `provider_doc_type` (
  `doc_type_id` int(11) NOT NULL,
  `doc_type` varchar(100) NOT NULL,
  `short` varchar(20) NOT NULL,
  `sunat` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `provider_doc_type`
--

INSERT INTO `provider_doc_type` (`doc_type_id`, `doc_type`, `short`, `sunat`) VALUES
(1, 'Sin documento', '', '0'),
(2, 'DNI - Documento Nacional de Identidad', 'DNI', '1'),
(3, 'CE - Carnet de Extranjería', 'CE', '4'),
(4, 'RUC - Registro Unico de Contributentes', 'RUC', '6'),
(5, 'Pasaporte', 'Pasaporte', '7'),
(6, 'CDI - Cédula Diplomática de Identidad', 'CDI', 'A'),
(7, 'Tax ID - Extranjero', 'Tax ID', '0');

-- --------------------------------------------------------

--
-- 테이블 구조 `provider_note`
--

CREATE TABLE `provider_note` (
  `note_id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `note` text NOT NULL,
  `valid` tinyint(1) NOT NULL DEFAULT 1,
  `registed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `provider_note`
--

INSERT INTO `provider_note` (`note_id`, `provider_id`, `note`, `valid`, `registed_at`) VALUES
(1, 23, 'pide mucho descuento', 1, '2023-11-16 22:57:35'),
(2, 23, 'este cliente\r\ncanta bien\r\ny toma poco', 0, '2023-11-16 22:57:46');

-- --------------------------------------------------------

--
-- 테이블 구조 `provider_person`
--

CREATE TABLE `provider_person` (
  `person_id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `position` varchar(100) DEFAULT NULL,
  `tel` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `valid` tinyint(1) NOT NULL DEFAULT 1,
  `registed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `provider_person`
--

INSERT INTO `provider_person` (`person_id`, `provider_id`, `name`, `position`, `tel`, `email`, `valid`, `registed_at`) VALUES
(1, 23, 'Jorge Ravines', '', '', '', 0, '2023-11-16 22:23:19'),
(2, 23, 'Jorge Ravines', 'Gerente General', '+51)992533099', 'laparaejhdf@Sdfsdf.com', 1, '2023-11-16 22:40:44');

-- --------------------------------------------------------

--
-- 테이블 구조 `purchase`
--

CREATE TABLE `purchase` (
  `purchase_id` int(11) NOT NULL,
  `provider_id` int(11) DEFAULT NULL,
  `proforma_id` int(11) DEFAULT NULL,
  `amount` double NOT NULL,
  `paid` double NOT NULL,
  `balance` double NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `registed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `valid` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `purchase`
--

INSERT INTO `purchase` (`purchase_id`, `provider_id`, `proforma_id`, `amount`, `paid`, `balance`, `updated_at`, `registed_at`, `valid`) VALUES
(1, 3, NULL, 363, 363, 0, '2023-10-02 16:26:10', '2023-09-17 22:19:28', 0),
(2, 3, NULL, 363, 363, 0, '2023-10-02 16:20:43', '2023-09-17 22:19:34', 1),
(3, 3, NULL, 363, 0, 363, '2023-10-02 16:13:43', '2023-09-17 22:19:58', 1),
(4, 3, NULL, 363, 363, 0, '2023-10-02 16:17:28', '2023-09-17 22:21:19', 1),
(5, NULL, NULL, 1975, 1975, 0, '2023-10-02 16:19:46', '2023-09-17 23:58:18', 1),
(6, NULL, NULL, 1795, 0, 1795, '2023-10-06 19:13:29', '2023-09-21 21:48:37', 0),
(7, NULL, NULL, 180, 0, 180, '2023-09-28 22:52:22', '2023-09-21 21:48:57', 1),
(8, 4, NULL, 180, 180, 0, '2023-09-21 21:50:14', '2023-09-21 21:50:14', 1),
(9, 5, NULL, 299, 299, 0, '2023-10-03 15:23:02', '2023-09-25 21:29:42', 1),
(10, 6, NULL, 61.2, 61.2, 0, '2023-10-05 00:34:13', '2023-10-05 00:33:52', 1),
(11, 10, NULL, 631.72, 631.72, 0, '2023-10-18 21:54:51', '2023-10-10 21:40:41', 0),
(12, 14, 4, 280, 100, 180, '2023-10-24 21:27:48', '2023-10-24 21:27:48', 1),
(13, 14, 4, 280, 100, 180, '2023-11-09 00:03:26', '2023-10-24 21:27:53', 0),
(14, 14, 4, 280, 100, 180, '2023-10-24 21:43:00', '2023-10-24 21:43:00', 1),
(15, 14, 4, 280, 100, 180, '2023-10-24 21:53:06', '2023-10-24 21:53:06', 1),
(16, 14, 4, 280, 100, 180, '2023-10-24 21:53:46', '2023-10-24 21:53:46', 1),
(17, 14, 4, 280, 100, 180, '2023-10-24 21:54:32', '2023-10-24 21:54:32', 1),
(18, 14, 4, 280, 100, 180, '2023-10-24 21:55:48', '2023-10-24 21:55:48', 1),
(19, 14, 4, 280, 280, 0, '2023-10-24 22:32:45', '2023-10-24 22:32:29', 1),
(20, 14, 4, 280, 280, 0, '2023-10-24 23:02:45', '2023-10-24 23:02:34', 1),
(21, 14, 4, 280, 280, 0, '2023-10-25 19:56:37', '2023-10-25 19:56:37', 1),
(22, 14, 4, 280, 280, 0, '2023-10-30 00:15:22', '2023-10-30 00:14:38', 1),
(23, 14, 4, 280, 280, 0, '2023-10-30 21:01:06', '2023-10-30 21:01:06', 1),
(24, 1, NULL, 299.2, 299.2, 0, '2023-11-02 23:03:08', '2023-11-02 23:03:08', 1),
(25, 19, NULL, 299.2, 299.2, 0, '2023-11-03 19:18:11', '2023-11-03 19:18:11', 1),
(26, 14, 4, 280, 280, 0, '2023-11-10 23:40:41', '2023-11-07 21:14:48', 1),
(27, 22, NULL, 570, 70, 500, '2023-11-14 22:18:36', '2023-11-14 22:18:36', 1),
(28, 22, NULL, 570, 70, 500, '2023-11-14 22:26:56', '2023-11-14 22:26:56', 1),
(29, 22, NULL, 570, 570, 0, '2023-11-15 23:28:37', '2023-11-14 22:30:42', 1),
(30, 22, NULL, 570, 70, 500, '2023-11-14 22:30:55', '2023-11-14 22:30:55', 1),
(31, 22, NULL, 570, 70, 500, '2023-11-15 20:47:20', '2023-11-14 22:31:01', 0),
(32, 22, NULL, 570, 570, 0, '2023-11-16 23:10:31', '2023-11-14 22:31:33', 0),
(33, 22, NULL, 3830, 3830, 0, '2023-11-14 23:13:25', '2023-11-14 22:37:33', 1),
(34, 17, NULL, 990, 990, 0, '2023-11-15 23:28:08', '2023-11-14 22:40:14', 0),
(35, 17, NULL, 121, 121, 0, '2023-11-15 20:46:15', '2023-11-15 05:24:02', 0),
(36, 17, NULL, 10200, 10200, 0, '2023-11-15 21:20:29', '2023-11-15 20:50:08', 0);

-- --------------------------------------------------------

--
-- 테이블 구조 `purchase_file`
--

CREATE TABLE `purchase_file` (
  `file_id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `description` varchar(200) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `valid` tinyint(1) NOT NULL DEFAULT 1,
  `registed_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `purchase_file`
--

INSERT INTO `purchase_file` (`file_id`, `purchase_id`, `description`, `filename`, `valid`, `registed_at`) VALUES
(1, 35, 'afadfasdf hola', '20231115132349.pdf', 1, '2023-11-15 19:35:41'),
(2, 35, 'Proforma', '20231115132932.pdf', 1, '2023-11-15 19:35:41'),
(3, 35, 'Proforma', '20231115133125.pdf', 1, '2023-11-15 19:35:32'),
(4, 36, 'Proforma', '20231115161955.pdf', 0, '2023-11-15 21:20:10'),
(5, 29, 'Cotizacion', '20231115182907.pdf', 1, '2023-11-15 23:29:07');

-- --------------------------------------------------------

--
-- 테이블 구조 `purchase_note`
--

CREATE TABLE `purchase_note` (
  `note_id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `note` text NOT NULL,
  `valid` tinyint(1) NOT NULL DEFAULT 1,
  `registed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `purchase_note`
--

INSERT INTO `purchase_note` (`note_id`, `purchase_id`, `note`, `valid`, `registed_at`) VALUES
(1, 35, 'afasfdsdfasdf', 1, '2023-11-15 05:56:54'),
(2, 35, 'afasfdsdfasdf', 0, '2023-11-15 05:57:13'),
(3, 35, 'nueva fecha de llegada : 2023 11 30', 0, '2023-11-15 05:57:52'),
(4, 35, 'fasfasdfas\r\nfasdf\r\nasdf\r\nasf\r\nasf\r\nasfsdf', 0, '2023-11-15 06:05:09'),
(5, 35, 'asfasdfasdf\r\n\r\n\r\nasdfasfsfd', 0, '2023-11-15 06:06:15'),
(6, 35, 'hola\r\ncomo estas/\r\ntu no es', 1, '2023-11-15 06:17:49'),
(7, 36, 'jeje\r\nestoy e\r\nes spharta', 1, '2023-11-15 21:19:18'),
(8, 29, 'Muy espeso es el weon', 1, '2023-11-15 23:28:52');

-- --------------------------------------------------------

--
-- 테이블 구조 `purchase_payment`
--

CREATE TABLE `purchase_payment` (
  `payment_id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  `total` float NOT NULL,
  `paid` float NOT NULL,
  `balance` float NOT NULL,
  `registed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `valid` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `purchase_payment`
--

INSERT INTO `purchase_payment` (`payment_id`, `purchase_id`, `payment_method_id`, `total`, `paid`, `balance`, `registed_at`, `valid`) VALUES
(1, 3, 1, 363.12, 400, 36.88, '2023-09-17 22:19:58', 0),
(2, 4, 1, 363.12, 400, 36.88, '2023-09-17 22:21:19', 0),
(3, 5, 3, 1974.72, 2000, 25.28, '2023-09-17 23:58:18', 0),
(4, 6, 1, 1795.2, 1795.2, 0, '2023-09-21 21:48:37', 0),
(5, 7, 1, 179.52, 200, 20.48, '2023-09-21 21:48:57', 0),
(6, 8, 1, 179.52, 300, 120.48, '2023-09-21 21:50:14', 1),
(7, 9, 1, 299.2, 300, 0.8, '2023-09-25 21:29:42', 0),
(8, 9, 1, 299.2, 99.2, 0, '2023-10-02 15:36:27', 1),
(9, 9, 1, 200, 100, 0, '2023-10-02 15:37:04', 1),
(10, 9, 1, 100, 140, 40, '2023-10-02 15:40:33', 0),
(11, 5, 1, 1974.72, 2000, 25.28, '2023-10-02 16:19:35', 0),
(12, 9, 1, 100, 999, 899, '2023-10-03 15:15:35', 0),
(13, 9, 1, 99.8, 9999, 9899.2, '2023-10-03 15:23:02', 1),
(14, 10, 1, 61.2, 30, 0, '2023-10-05 00:33:52', 1),
(15, 10, 1, 31.2, 50, 18.8, '2023-10-05 00:34:13', 1),
(16, 11, 2, 631.72, 631.72, 0, '2023-10-10 21:40:41', 0),
(17, 18, 1, 280, 100, 0, '2023-10-24 21:55:48', 1),
(18, 19, 1, 280, 100, 0, '2023-10-24 22:32:29', 1),
(19, 19, 1, 180, 300, 120, '2023-10-24 22:32:45', 1),
(20, 20, 1, 280, 5, 0, '2023-10-24 23:02:34', 1),
(21, 20, 1, 275, 300, 25, '2023-10-24 23:02:45', 1),
(22, 21, 1, 280, 300, 20, '2023-10-25 19:56:37', 1),
(23, 22, 1, 280, 120, 0, '2023-10-30 00:14:38', 1),
(24, 22, 1, 160, 200, 40, '2023-10-30 00:15:22', 1),
(25, 23, 1, 280, 300, 20, '2023-10-30 21:01:06', 1),
(26, 24, 3, 299.2, 500, 200.8, '2023-11-02 23:03:08', 1),
(27, 25, 3, 299.2, 299.2, 0, '2023-11-03 19:18:11', 1),
(30, 26, 1, 280, 200, 0, '2023-11-10 23:31:24', 1),
(31, 26, 1, 80, 300, 220, '2023-11-10 23:40:41', 1),
(32, 27, 1, 570, 70, 500, '2023-11-14 22:18:36', 1),
(33, 28, 1, 570, 70, 500, '2023-11-14 22:26:56', 1),
(34, 29, 1, 570, 70, 500, '2023-11-14 22:30:42', 1),
(35, 30, 1, 570, 70, 500, '2023-11-14 22:30:55', 1),
(36, 31, 1, 570, 70, 500, '2023-11-14 22:31:01', 0),
(37, 32, 1, 570, 70, 500, '2023-11-14 22:31:33', 0),
(38, 33, 5, 3830, 2000, 1830, '2023-11-14 22:37:33', 0),
(39, 34, 1, 990, 990, 0, '2023-11-14 22:40:14', 0),
(40, 33, 4, 3830, 3830, 0, '2023-11-14 23:11:50', 0),
(41, 33, 1, 3830, 2000, 1830, '2023-11-14 23:12:08', 0),
(42, 33, 5, 1830, 1830, 0, '2023-11-14 23:12:23', 1),
(43, 33, 1, 2000, 450, 1550, '2023-11-14 23:12:44', 1),
(44, 33, 1, 1550, 1550, 0, '2023-11-14 23:13:25', 1),
(45, 35, 1, 121, 121, 0, '2023-11-15 05:24:02', 0),
(46, 36, 5, 10200, 10200, 0, '2023-11-15 20:50:08', 0),
(47, 29, 1, 500, 1, 499, '2023-11-15 23:28:28', 1),
(48, 29, 1, 499, 499, 0, '2023-11-15 23:28:37', 1),
(49, 32, 1, 500, 500, 0, '2023-11-16 23:10:22', 0);

-- --------------------------------------------------------

--
-- 테이블 구조 `purchase_product`
--

CREATE TABLE `purchase_product` (
  `purchase_product_id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` float NOT NULL,
  `subtotal` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `purchase_product`
--

INSERT INTO `purchase_product` (`purchase_product_id`, `purchase_id`, `product_id`, `option_id`, `qty`, `price`, `subtotal`) VALUES
(1, 3, 197, 28, 3, 59.84, 179.52),
(2, 4, 197, 28, 3, 59.84, 179.52),
(3, 4, 1, 26, 12, 15.3, 183.6),
(4, 5, 197, 28, 33, 59.84, 1974.72),
(5, 6, 197, 27, 30, 59.84, 1795.2),
(6, 7, 197, 28, 3, 59.84, 179.52),
(7, 8, 197, 27, 3, 59.84, 179.52),
(8, 9, 197, 28, 5, 59.84, 299.2),
(9, 10, 1, 26, 4, 15.3, 61.2),
(10, 11, 197, 28, 3, 59.84, 179.52),
(11, 11, 197, 29, 5, 59.84, 299.2),
(12, 11, 1, 26, 10, 15.3, 153),
(14, 17, 1, 26, 20, 14, 280),
(15, 18, 1, 26, 20, 14, 280),
(16, 19, 1, 26, 20, 14, 280),
(17, 20, 1, 26, 20, 14, 280),
(18, 21, 1, 26, 20, 14, 280),
(19, 22, 1, 26, 20, 14, 280),
(20, 23, 1, 26, 20, 14, 280),
(21, 24, 197, 27, 5, 59.84, 299.2),
(22, 25, 197, 29, 5, 59.84, 299.2),
(23, 26, 1, 26, 20, 14, 280),
(26, 30, 197, 32, 7, 10, 0),
(27, 30, 254, 33, 100, 5, 0),
(28, 31, 197, 34, 7, 10, 0),
(29, 31, 254, 35, 100, 5, 0),
(30, 32, 197, 36, 7, 10, 0),
(31, 32, 254, 37, 100, 5, 0),
(32, 33, 197, 28, 130, 10, 0),
(33, 33, 197, 29, 230, 11, 0),
(34, 34, 162, 38, 99, 10, 990),
(35, 35, 197, 29, 11, 11, 121),
(36, 36, 8, 39, 12, 100, 1200),
(37, 36, 235, 40, 300, 30, 9000);

-- --------------------------------------------------------

--
-- 테이블 구조 `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role` varchar(100) NOT NULL,
  `valid` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `role`
--

INSERT INTO `role` (`role_id`, `role`, `valid`) VALUES
(1, 'Admin', 1),
(2, 'Gerencia', 1),
(4, 'HkRpvbuqcC', 1),
(5003, 'KoCCvwlVhk', 1),
(5004, 'FrIWiBZFyY', 0),
(5005, 'qGueVrhgli', 1),
(5006, 'DrIVUuULba', 1),
(5007, 'v adyjtbYW', 1),
(5008, 'FelKygNErZ', 0),
(5009, 'eaXLKxhrfl', 1),
(5010, 'miPcGGxYff', 1),
(5011, 'zTeESSDvjr', 1),
(5012, 'XN T apvss', 1),
(5013, 'IsCjcaLWfn', 1),
(5014, 'qGCTmXQnSh', 1),
(5015, 'DnSUWUHPaV', 1),
(5016, 'hKmOYCSMDV', 1),
(5017, 'rHiepRlDRO', 1),
(5018, 'rOQxRKQpBi', 1),
(5019, 'eHSZVdUdAF', 1),
(5020, 'FlWvAkTuFH', 1),
(5021, 'baluPiwIkH', 1),
(5022, 'DTJcNIxQMi', 1),
(5023, 'YSpoEGJpGw', 1),
(5024, 'iTGJpZOlM', 1),
(5025, 'YlBChVtYc', 1),
(5026, 'nRuCdkcHEX', 1),
(5027, 'lpgjXc UdW', 1),
(5028, 'vsYclGBuOz', 1),
(5029, 'Admin de banio', 0),
(5030, 'admin de sala 123', 1),
(5031, 'Admin de sala 2', 1),
(5032, 'af asf asd f', 0);

-- --------------------------------------------------------

--
-- 테이블 구조 `role_access`
--

CREATE TABLE `role_access` (
  `role_id` int(11) NOT NULL,
  `access_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `role_access`
--

INSERT INTO `role_access` (`role_id`, `access_id`) VALUES
(1, 3),
(1, 6),
(1, 7),
(1, 5),
(1, 4),
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- 테이블 구조 `sale`
--

CREATE TABLE `sale` (
  `sale_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `proforma_id` int(11) DEFAULT NULL,
  `amount` double NOT NULL,
  `paid` double NOT NULL,
  `balance` double NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `registed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `valid` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `sale`
--

INSERT INTO `sale` (`sale_id`, `client_id`, `proforma_id`, `amount`, `paid`, `balance`, `updated_at`, `registed_at`, `valid`) VALUES
(1, 3, NULL, 363, 363, 0, '2023-10-02 16:26:10', '2023-09-17 22:19:28', 0),
(2, 3, NULL, 363, 363, 0, '2023-10-02 16:20:43', '2023-09-17 22:19:34', 1),
(3, 3, NULL, 363, 0, 363, '2023-10-02 16:13:43', '2023-09-17 22:19:58', 1),
(4, 3, NULL, 363, 363, 0, '2023-10-02 16:17:28', '2023-09-17 22:21:19', 1),
(5, NULL, NULL, 1975, 1975, 0, '2023-10-02 16:19:46', '2023-09-17 23:58:18', 1),
(6, NULL, NULL, 1795, 0, 1795, '2023-10-06 19:13:29', '2023-09-21 21:48:37', 0),
(7, NULL, NULL, 180, 0, 180, '2023-09-28 22:52:22', '2023-09-21 21:48:57', 1),
(8, 4, NULL, 180, 180, 0, '2023-09-21 21:50:14', '2023-09-21 21:50:14', 1),
(9, 5, NULL, 299, 299, 0, '2023-10-03 15:23:02', '2023-09-25 21:29:42', 1),
(10, 6, NULL, 61.2, 61.2, 0, '2023-10-05 00:34:13', '2023-10-05 00:33:52', 1),
(11, 10, NULL, 631.72, 631.72, 0, '2023-10-18 21:54:51', '2023-10-10 21:40:41', 0),
(12, 14, 4, 280, 100, 180, '2023-10-24 21:27:48', '2023-10-24 21:27:48', 1),
(13, 14, 4, 280, 100, 180, '2023-11-09 00:03:26', '2023-10-24 21:27:53', 0),
(14, 14, 4, 280, 100, 180, '2023-10-24 21:43:00', '2023-10-24 21:43:00', 1),
(15, 14, 4, 280, 100, 180, '2023-10-24 21:53:06', '2023-10-24 21:53:06', 1),
(16, 14, 4, 280, 100, 180, '2023-10-24 21:53:46', '2023-10-24 21:53:46', 1),
(17, 14, 4, 280, 100, 180, '2023-10-24 21:54:32', '2023-10-24 21:54:32', 1),
(18, 14, 4, 280, 100, 180, '2023-10-24 21:55:48', '2023-10-24 21:55:48', 1),
(19, 14, 4, 280, 280, 0, '2023-10-24 22:32:45', '2023-10-24 22:32:29', 1),
(20, 14, 4, 280, 280, 0, '2023-10-24 23:02:45', '2023-10-24 23:02:34', 1),
(21, 14, 4, 280, 280, 0, '2023-10-25 19:56:37', '2023-10-25 19:56:37', 1),
(22, 14, 4, 280, 280, 0, '2023-10-30 00:15:22', '2023-10-30 00:14:38', 1),
(23, 14, 4, 280, 280, 0, '2023-10-30 21:01:06', '2023-10-30 21:01:06', 1),
(24, 1, NULL, 299.2, 299.2, 0, '2023-11-02 23:03:08', '2023-11-02 23:03:08', 1),
(25, 19, NULL, 299.2, 299.2, 0, '2023-11-03 19:18:11', '2023-11-03 19:18:11', 1),
(26, 14, 4, 280, 280, 0, '2023-11-07 21:14:48', '2023-11-07 21:14:48', 1);

-- --------------------------------------------------------

--
-- 테이블 구조 `sale_payment`
--

CREATE TABLE `sale_payment` (
  `payment_id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  `total` float NOT NULL,
  `received` float NOT NULL,
  `change` float NOT NULL,
  `registed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `valid` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `sale_payment`
--

INSERT INTO `sale_payment` (`payment_id`, `sale_id`, `payment_method_id`, `total`, `received`, `change`, `registed_at`, `valid`) VALUES
(1, 3, 1, 363.12, 400, 36.88, '2023-09-17 22:19:58', 0),
(2, 4, 1, 363.12, 400, 36.88, '2023-09-17 22:21:19', 0),
(3, 5, 3, 1974.72, 2000, 25.28, '2023-09-17 23:58:18', 0),
(4, 6, 1, 1795.2, 1795.2, 0, '2023-09-21 21:48:37', 0),
(5, 7, 1, 179.52, 200, 20.48, '2023-09-21 21:48:57', 0),
(6, 8, 1, 179.52, 300, 120.48, '2023-09-21 21:50:14', 1),
(7, 9, 1, 299.2, 300, 0.8, '2023-09-25 21:29:42', 0),
(8, 9, 1, 299.2, 99.2, 0, '2023-10-02 15:36:27', 1),
(9, 9, 1, 200, 100, 0, '2023-10-02 15:37:04', 1),
(10, 9, 1, 100, 140, 40, '2023-10-02 15:40:33', 0),
(11, 5, 1, 1974.72, 2000, 25.28, '2023-10-02 16:19:35', 0),
(12, 9, 1, 100, 999, 899, '2023-10-03 15:15:35', 0),
(13, 9, 1, 99.8, 9999, 9899.2, '2023-10-03 15:23:02', 1),
(14, 10, 1, 61.2, 30, 0, '2023-10-05 00:33:52', 1),
(15, 10, 1, 31.2, 50, 18.8, '2023-10-05 00:34:13', 1),
(16, 11, 2, 631.72, 631.72, 0, '2023-10-10 21:40:41', 0),
(17, 18, 1, 280, 100, 0, '2023-10-24 21:55:48', 1),
(18, 19, 1, 280, 100, 0, '2023-10-24 22:32:29', 1),
(19, 19, 1, 180, 300, 120, '2023-10-24 22:32:45', 1),
(20, 20, 1, 280, 5, 0, '2023-10-24 23:02:34', 1),
(21, 20, 1, 275, 300, 25, '2023-10-24 23:02:45', 1),
(22, 21, 1, 280, 300, 20, '2023-10-25 19:56:37', 1),
(23, 22, 1, 280, 120, 0, '2023-10-30 00:14:38', 1),
(24, 22, 1, 160, 200, 40, '2023-10-30 00:15:22', 1),
(25, 23, 1, 280, 300, 20, '2023-10-30 21:01:06', 1),
(26, 24, 3, 299.2, 500, 200.8, '2023-11-02 23:03:08', 1),
(27, 25, 3, 299.2, 299.2, 0, '2023-11-03 19:18:11', 1),
(28, 26, 1, 280, 300, 20, '2023-11-07 21:14:48', 1);

-- --------------------------------------------------------

--
-- 테이블 구조 `sale_product`
--

CREATE TABLE `sale_product` (
  `sale_product_id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` float NOT NULL,
  `subtotal` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `sale_product`
--

INSERT INTO `sale_product` (`sale_product_id`, `sale_id`, `product_id`, `option_id`, `qty`, `price`, `subtotal`) VALUES
(1, 3, 197, 28, 3, 59.84, 179.52),
(2, 4, 197, 28, 3, 59.84, 179.52),
(3, 4, 1, 26, 12, 15.3, 183.6),
(4, 5, 197, 28, 33, 59.84, 1974.72),
(5, 6, 197, 27, 30, 59.84, 1795.2),
(6, 7, 197, 28, 3, 59.84, 179.52),
(7, 8, 197, 27, 3, 59.84, 179.52),
(8, 9, 197, 28, 5, 59.84, 299.2),
(9, 10, 1, 26, 4, 15.3, 61.2),
(10, 11, 197, 28, 3, 59.84, 179.52),
(11, 11, 197, 29, 5, 59.84, 299.2),
(12, 11, 1, 26, 10, 15.3, 153),
(14, 17, 1, 26, 20, 14, 280),
(15, 18, 1, 26, 20, 14, 280),
(16, 19, 1, 26, 20, 14, 280),
(17, 20, 1, 26, 20, 14, 280),
(18, 21, 1, 26, 20, 14, 280),
(19, 22, 1, 26, 20, 14, 280),
(20, 23, 1, 26, 20, 14, 280),
(21, 24, 197, 27, 5, 59.84, 299.2),
(22, 25, 197, 29, 5, 59.84, 299.2),
(23, 26, 1, 26, 20, 14, 280);

-- --------------------------------------------------------

--
-- 테이블 구조 `setting_company`
--

CREATE TABLE `setting_company` (
  `company_id` int(11) NOT NULL,
  `ruc` varchar(15) NOT NULL,
  `company` varchar(200) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `email` varchar(150) NOT NULL,
  `address` varchar(250) NOT NULL,
  `department_id` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `setting_company`
--

INSERT INTO `setting_company` (`company_id`, `ruc`, `company`, `tel`, `email`, `address`, `department_id`, `province_id`, `district_id`, `updated_at`) VALUES
(1, '20610879668', 'JW EVERLYN S.A.C.', '+51 9925 33099', 'gerencia@jweverlyn.com', 'CORONEL MANUEL GOMEZ URB. DEL FUNDO LOBATON Nro. 120 Dpto. 203', 15, 128, 1264, '2023-09-01 21:15:38');

-- --------------------------------------------------------

--
-- 테이블 구조 `sunat_file`
--

CREATE TABLE `sunat_file` (
  `file_id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `xml` varchar(200) NOT NULL,
  `cdr` varchar(200) NOT NULL,
  `registed_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `sunat_file`
--

INSERT INTO `sunat_file` (`file_id`, `sale_id`, `invoice_id`, `xml`, `cdr`, `registed_at`) VALUES
(23, 10, 28, '20610879668-03-B001-1.xml', 'R-20610879668-03-B001-1.zip', '2023-10-19 22:40:23'),
(24, 9, 29, '20610879668-03-B001-2.xml', 'R-20610879668-03-B001-2.zip', '2023-10-20 20:48:55'),
(26, 8, 31, '20610879668-01-F001-1.xml', 'R-20610879668-01-F001-1.zip', '2023-10-20 22:57:43'),
(27, 19, 32, '20610879668-03-B001-3.xml', 'R-20610879668-03-B001-3.zip', '2023-10-24 22:32:54'),
(28, 20, 33, '20610879668-03-B001-4.xml', 'R-20610879668-03-B001-4.zip', '2023-10-24 23:02:49'),
(29, 21, 34, '20610879668-03-B001-5.xml', 'R-20610879668-03-B001-5.zip', '2023-10-25 19:56:53'),
(30, 22, 35, '20610879668-03-B001-6.xml', 'R-20610879668-03-B001-6.zip', '2023-10-30 00:16:16'),
(31, 24, 35, '20610879668-03-B001-6.xml', 'R-20610879668-03-B001-6.zip', '2023-11-02 23:03:15'),
(32, 25, 36, '20610879668-01-F001-2.xml', 'R-20610879668-01-F001-2.zip', '2023-11-03 19:18:42'),
(33, 26, 37, '20610879668-03-B001-7.xml', 'R-20610879668-03-B001-7.zip', '2023-11-07 21:14:58');

-- --------------------------------------------------------

--
-- 테이블 구조 `sunat_resume`
--

CREATE TABLE `sunat_resume` (
  `resume_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `ticket` varchar(250) NOT NULL,
  `correlative` int(11) NOT NULL,
  `registed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `sunat_resume`
--

INSERT INTO `sunat_resume` (`resume_id`, `date`, `ticket`, `correlative`, `registed_at`) VALUES
(1, '2023-10-18', '1697646708695', 1, '2023-10-18 16:39:13'),
(2, '2023-10-18', '1697649585349', 1, '2023-10-18 17:27:10'),
(3, '2023-10-18', '1697649795257', 2, '2023-10-18 17:30:41'),
(4, '2023-10-18', '1697649819385', 3, '2023-10-18 17:31:04');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `access`
--
ALTER TABLE `access`
  ADD PRIMARY KEY (`access_id`),
  ADD KEY `fk_access_module` (`module_id`);

--
-- 테이블의 인덱스 `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`account_id`),
  ADD KEY `fk_account_role` (`role_id`) USING BTREE;

--
-- 테이블의 인덱스 `address_department`
--
ALTER TABLE `address_department`
  ADD PRIMARY KEY (`department_id`);

--
-- 테이블의 인덱스 `address_district`
--
ALTER TABLE `address_district`
  ADD PRIMARY KEY (`district_id`);

--
-- 테이블의 인덱스 `address_province`
--
ALTER TABLE `address_province`
  ADD PRIMARY KEY (`province_id`);

--
-- 테이블의 인덱스 `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`),
  ADD KEY `fk_doc_type_id` (`doc_type_id`);

--
-- 테이블의 인덱스 `client_doc_type`
--
ALTER TABLE `client_doc_type`
  ADD PRIMARY KEY (`doc_type_id`);

--
-- 테이블의 인덱스 `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- 테이블의 인덱스 `invoice_serie`
--
ALTER TABLE `invoice_serie`
  ADD PRIMARY KEY (`serie_id`);

--
-- 테이블의 인덱스 `invoice_type`
--
ALTER TABLE `invoice_type`
  ADD PRIMARY KEY (`type_id`);

--
-- 테이블의 인덱스 `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`module_id`);

--
-- 테이블의 인덱스 `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`payment_method_id`);

--
-- 테이블의 인덱스 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_product_type` (`type_id`),
  ADD KEY `fk_product_category` (`category_id`);

--
-- 테이블의 인덱스 `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`category_id`);

--
-- 테이블의 인덱스 `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `fk_image_product` (`product_id`);

--
-- 테이블의 인덱스 `product_option`
--
ALTER TABLE `product_option`
  ADD PRIMARY KEY (`option_id`),
  ADD KEY `fk_option_product` (`product_id`);

--
-- 테이블의 인덱스 `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`type_id`);

--
-- 테이블의 인덱스 `proforma`
--
ALTER TABLE `proforma`
  ADD PRIMARY KEY (`proforma_id`),
  ADD KEY `fk_profrma_client` (`client_id`);

--
-- 테이블의 인덱스 `proforma_product`
--
ALTER TABLE `proforma_product`
  ADD PRIMARY KEY (`proforma_product_id`),
  ADD KEY `fk_proforma_proforma` (`proforma_id`),
  ADD KEY `fk_proforma_product` (`product_id`),
  ADD KEY `fk_proforma_option` (`option_id`);

--
-- 테이블의 인덱스 `provider`
--
ALTER TABLE `provider`
  ADD PRIMARY KEY (`provider_id`),
  ADD KEY `fk_provider_doc_type_id` (`doc_type_id`);

--
-- 테이블의 인덱스 `provider_doc_type`
--
ALTER TABLE `provider_doc_type`
  ADD PRIMARY KEY (`doc_type_id`);

--
-- 테이블의 인덱스 `provider_note`
--
ALTER TABLE `provider_note`
  ADD PRIMARY KEY (`note_id`),
  ADD KEY `fk_note_provider` (`provider_id`);

--
-- 테이블의 인덱스 `provider_person`
--
ALTER TABLE `provider_person`
  ADD PRIMARY KEY (`person_id`),
  ADD KEY `fk_person_provider` (`provider_id`);

--
-- 테이블의 인덱스 `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `fk_purchase_provider` (`provider_id`),
  ADD KEY `fk_purchase_proforma` (`proforma_id`);

--
-- 테이블의 인덱스 `purchase_file`
--
ALTER TABLE `purchase_file`
  ADD PRIMARY KEY (`file_id`),
  ADD KEY `fk_file_purchase` (`purchase_id`);

--
-- 테이블의 인덱스 `purchase_note`
--
ALTER TABLE `purchase_note`
  ADD PRIMARY KEY (`note_id`),
  ADD KEY `fk_note_purchase` (`purchase_id`);

--
-- 테이블의 인덱스 `purchase_payment`
--
ALTER TABLE `purchase_payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `fk_payment_purchase` (`purchase_id`);

--
-- 테이블의 인덱스 `purchase_product`
--
ALTER TABLE `purchase_product`
  ADD PRIMARY KEY (`purchase_product_id`),
  ADD KEY `fk_purchase_product_purchase` (`purchase_id`),
  ADD KEY `fk_purchase_product_product` (`product_id`),
  ADD KEY `fk_purchase_product_option` (`option_id`);

--
-- 테이블의 인덱스 `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- 테이블의 인덱스 `role_access`
--
ALTER TABLE `role_access`
  ADD KEY `fk_role_access_role` (`role_id`),
  ADD KEY `fk_role_access_access` (`access_id`);

--
-- 테이블의 인덱스 `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`sale_id`),
  ADD KEY `fk_sale_client` (`client_id`),
  ADD KEY `fk_sale_proforma` (`proforma_id`);

--
-- 테이블의 인덱스 `sale_payment`
--
ALTER TABLE `sale_payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `fk_payment_sale` (`sale_id`);

--
-- 테이블의 인덱스 `sale_product`
--
ALTER TABLE `sale_product`
  ADD PRIMARY KEY (`sale_product_id`),
  ADD KEY `fk_sale_product_sale` (`sale_id`),
  ADD KEY `fk_sale_product_product` (`product_id`),
  ADD KEY `fk_sale_product_option` (`option_id`);

--
-- 테이블의 인덱스 `setting_company`
--
ALTER TABLE `setting_company`
  ADD PRIMARY KEY (`company_id`);

--
-- 테이블의 인덱스 `sunat_file`
--
ALTER TABLE `sunat_file`
  ADD PRIMARY KEY (`file_id`),
  ADD KEY `fk_file_invoice` (`invoice_id`),
  ADD KEY `fk_file_sale` (`sale_id`);

--
-- 테이블의 인덱스 `sunat_resume`
--
ALTER TABLE `sunat_resume`
  ADD PRIMARY KEY (`resume_id`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `access`
--
ALTER TABLE `access`
  MODIFY `access_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 테이블의 AUTO_INCREMENT `account`
--
ALTER TABLE `account`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=966;

--
-- 테이블의 AUTO_INCREMENT `address_department`
--
ALTER TABLE `address_department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- 테이블의 AUTO_INCREMENT `address_district`
--
ALTER TABLE `address_district`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1835;

--
-- 테이블의 AUTO_INCREMENT `address_province`
--
ALTER TABLE `address_province`
  MODIFY `province_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- 테이블의 AUTO_INCREMENT `client`
--
ALTER TABLE `client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- 테이블의 AUTO_INCREMENT `client_doc_type`
--
ALTER TABLE `client_doc_type`
  MODIFY `doc_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 테이블의 AUTO_INCREMENT `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- 테이블의 AUTO_INCREMENT `invoice_serie`
--
ALTER TABLE `invoice_serie`
  MODIFY `serie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 테이블의 AUTO_INCREMENT `invoice_type`
--
ALTER TABLE `invoice_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 테이블의 AUTO_INCREMENT `module`
--
ALTER TABLE `module`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 테이블의 AUTO_INCREMENT `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `payment_method_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 테이블의 AUTO_INCREMENT `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=305;

--
-- 테이블의 AUTO_INCREMENT `product_category`
--
ALTER TABLE `product_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- 테이블의 AUTO_INCREMENT `product_image`
--
ALTER TABLE `product_image`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- 테이블의 AUTO_INCREMENT `product_option`
--
ALTER TABLE `product_option`
  MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- 테이블의 AUTO_INCREMENT `product_type`
--
ALTER TABLE `product_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 테이블의 AUTO_INCREMENT `proforma`
--
ALTER TABLE `proforma`
  MODIFY `proforma_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 테이블의 AUTO_INCREMENT `proforma_product`
--
ALTER TABLE `proforma_product`
  MODIFY `proforma_product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 테이블의 AUTO_INCREMENT `provider`
--
ALTER TABLE `provider`
  MODIFY `provider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- 테이블의 AUTO_INCREMENT `provider_doc_type`
--
ALTER TABLE `provider_doc_type`
  MODIFY `doc_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 테이블의 AUTO_INCREMENT `provider_note`
--
ALTER TABLE `provider_note`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 테이블의 AUTO_INCREMENT `provider_person`
--
ALTER TABLE `provider_person`
  MODIFY `person_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 테이블의 AUTO_INCREMENT `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- 테이블의 AUTO_INCREMENT `purchase_file`
--
ALTER TABLE `purchase_file`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 테이블의 AUTO_INCREMENT `purchase_note`
--
ALTER TABLE `purchase_note`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 테이블의 AUTO_INCREMENT `purchase_payment`
--
ALTER TABLE `purchase_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- 테이블의 AUTO_INCREMENT `purchase_product`
--
ALTER TABLE `purchase_product`
  MODIFY `purchase_product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- 테이블의 AUTO_INCREMENT `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5033;

--
-- 테이블의 AUTO_INCREMENT `sale`
--
ALTER TABLE `sale`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- 테이블의 AUTO_INCREMENT `sale_payment`
--
ALTER TABLE `sale_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- 테이블의 AUTO_INCREMENT `sale_product`
--
ALTER TABLE `sale_product`
  MODIFY `sale_product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- 테이블의 AUTO_INCREMENT `setting_company`
--
ALTER TABLE `setting_company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 테이블의 AUTO_INCREMENT `sunat_file`
--
ALTER TABLE `sunat_file`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- 테이블의 AUTO_INCREMENT `sunat_resume`
--
ALTER TABLE `sunat_resume`
  MODIFY `resume_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 덤프된 테이블의 제약사항
--

--
-- 테이블의 제약사항 `access`
--
ALTER TABLE `access`
  ADD CONSTRAINT `fk_access_module` FOREIGN KEY (`module_id`) REFERENCES `module` (`module_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_role` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `fk_doc_type_id` FOREIGN KEY (`doc_type_id`) REFERENCES `client_doc_type` (`doc_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_category` FOREIGN KEY (`category_id`) REFERENCES `product_category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_type` FOREIGN KEY (`type_id`) REFERENCES `product_type` (`type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `product_image`
--
ALTER TABLE `product_image`
  ADD CONSTRAINT `fk_image_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `product_option`
--
ALTER TABLE `product_option`
  ADD CONSTRAINT `fk_option_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `proforma`
--
ALTER TABLE `proforma`
  ADD CONSTRAINT `fk_profrma_client` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `proforma_product`
--
ALTER TABLE `proforma_product`
  ADD CONSTRAINT `fk_proforma_option` FOREIGN KEY (`option_id`) REFERENCES `product_option` (`option_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_proforma_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_proforma_proforma` FOREIGN KEY (`proforma_id`) REFERENCES `proforma` (`proforma_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `provider`
--
ALTER TABLE `provider`
  ADD CONSTRAINT `fk_provider_doc_type_id` FOREIGN KEY (`doc_type_id`) REFERENCES `provider_doc_type` (`doc_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `provider_note`
--
ALTER TABLE `provider_note`
  ADD CONSTRAINT `fk_note_provider` FOREIGN KEY (`provider_id`) REFERENCES `provider` (`provider_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `provider_person`
--
ALTER TABLE `provider_person`
  ADD CONSTRAINT `fk_person_provider` FOREIGN KEY (`provider_id`) REFERENCES `provider` (`provider_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `fk_purchase_proforma` FOREIGN KEY (`proforma_id`) REFERENCES `proforma` (`proforma_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_purchase_provider` FOREIGN KEY (`provider_id`) REFERENCES `provider` (`provider_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `purchase_file`
--
ALTER TABLE `purchase_file`
  ADD CONSTRAINT `fk_file_purchase` FOREIGN KEY (`purchase_id`) REFERENCES `purchase` (`purchase_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `purchase_note`
--
ALTER TABLE `purchase_note`
  ADD CONSTRAINT `fk_note_purchase` FOREIGN KEY (`purchase_id`) REFERENCES `purchase` (`purchase_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `purchase_payment`
--
ALTER TABLE `purchase_payment`
  ADD CONSTRAINT `fk_payment_purchase` FOREIGN KEY (`purchase_id`) REFERENCES `purchase` (`purchase_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `purchase_product`
--
ALTER TABLE `purchase_product`
  ADD CONSTRAINT `fk_purchase_product_option` FOREIGN KEY (`option_id`) REFERENCES `product_option` (`option_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_purchase_product_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_purchase_product_purchase` FOREIGN KEY (`purchase_id`) REFERENCES `purchase` (`purchase_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `role_access`
--
ALTER TABLE `role_access`
  ADD CONSTRAINT `fk_role_access_access` FOREIGN KEY (`access_id`) REFERENCES `access` (`access_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_role_access_role` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `sale`
--
ALTER TABLE `sale`
  ADD CONSTRAINT `fk_sale_client` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sale_proforma` FOREIGN KEY (`proforma_id`) REFERENCES `proforma` (`proforma_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `sale_payment`
--
ALTER TABLE `sale_payment`
  ADD CONSTRAINT `fk_payment_sale` FOREIGN KEY (`sale_id`) REFERENCES `sale` (`sale_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `sale_product`
--
ALTER TABLE `sale_product`
  ADD CONSTRAINT `fk_sale_product_option` FOREIGN KEY (`option_id`) REFERENCES `product_option` (`option_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sale_product_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sale_product_sale` FOREIGN KEY (`sale_id`) REFERENCES `sale` (`sale_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 테이블의 제약사항 `sunat_file`
--
ALTER TABLE `sunat_file`
  ADD CONSTRAINT `fk_file_invoice` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`invoice_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_file_sale` FOREIGN KEY (`sale_id`) REFERENCES `sale` (`sale_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
