-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 23-08-09 09:26
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
  `action` varchar(30) NOT NULL,
  `code` varchar(50) NOT NULL,
  `valid` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `account`
--

CREATE TABLE `account` (
  `account_id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(250) NOT NULL,
  `name` varchar(100) NOT NULL,
  `valid` tinyint(1) NOT NULL DEFAULT 1,
  `last_logged_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `registed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `account`
--

INSERT INTO `account` (`account_id`, `role_id`, `username`, `password`, `name`, `valid`, `last_logged_at`, `updated_at`, `registed_at`) VALUES
(1, 1, 'laparkaes@gmail.com', '$2y$10$GgXbbw1zKLysaytroxNpl.Vp3EsLKplcnKr6H/6xqZBimt7ENGnf6', 'Georgio Park', 1, NULL, '2023-08-07 01:21:19', '2023-08-07 01:21:19');

-- --------------------------------------------------------

--
-- 테이블 구조 `module`
--

CREATE TABLE `module` (
  `module_id` int(11) NOT NULL,
  `module` varchar(50) NOT NULL,
  `valid` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `role`
--

INSERT INTO `role` (`role_id`, `role`) VALUES
(1, 'Admin'),
(2, 'Gerencia');

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
-- 테이블의 인덱스 `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`module_id`);

--
-- 테이블의 인덱스 `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `access`
--
ALTER TABLE `access`
  MODIFY `access_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `account`
--
ALTER TABLE `account`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 테이블의 AUTO_INCREMENT `module`
--
ALTER TABLE `module`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
