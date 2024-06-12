<?php
include '../config.php';
# -- table
$connect->multi_query(" CREATE TABLE `user` (
`id` bigint PRIMARY KEY,
`en` text DEFAULT NULL,
`coin` float DEFAULT '0',
`step` varchar(150) DEFAULT NULL,
`step2` text DEFAULT NULL,
`step3` text DEFAULT NULL,
`tab` text DEFAULT NULL,
`data` text DEFAULT NULL,
`m1` text DEFAULT NULL,
`m2` text DEFAULT NULL,
`m3` text DEFAULT NULL,
`m4` text DEFAULT NULL,
`m5` text DEFAULT NULL,
`m6` text DEFAULT NULL,
`m7` text DEFAULT NULL,
`wall` text DEFAULT NULL,
`xdteam` text DEFAULT NULL,
`member` bigint DEFAULT '0',
`more` text DEFAULT NULL
) default charset = utf8mb4;
	CREATE TABLE `bot` (
    `id` text NOT NULL,
	`cod` text DEFAULT 'xd'
) default charset = utf8mb4;
CREATE TABLE `adbot` (
    `id` text DEFAULT NULL,
    `start` text DEFAULT NULL,
    `allstart` text DEFAULT NULL,
    `user` text DEFAULT NULL,
    `username` text DEFAULT NULL,
    `bot` text DEFAULT NULL,
    `cr` text DEFAULT NULL,
    `tm` text DEFAULT NULL
) default charset = utf8mb4; 
CREATE TABLE `bots` (
    `id` text NOT NULL,
	`cod` text DEFAULT 'xd'
) default charset = utf8mb4; 
CREATE TABLE `ads` (
    `id` text DEFAULT NULL,
    `see` text DEFAULT NULL,
    `allsee` text DEFAULT NULL,
    `cr` text DEFAULT NULL,
    `m1` text DEFAULT NULL,
    `m2` text DEFAULT NULL,
    `m3` text DEFAULT NULL,
    `xd` text DEFAULT NULL
) default charset = utf8mb4; 
CREATE TABLE `admin` (
    `id` bigint NOT NULL,
    `cr` bigint NOT NULL
) default charset = utf8mb4; 
CREATE TABLE `view` (
    `id` text NOT NULL,
	`cod` text DEFAULT 'xd'
) default charset = utf8mb4; 
CREATE TABLE `block` (
    `id` bigint NOT NULL
) default charset = utf8mb4; 	
CREATE TABLE `settings` (
	`min` float DEFAULT '1.0',
	`bot` text DEFAULT 'off',
	`d1` text DEFAULT 'off',
	`d2` text DEFAULT 'off',
	`m1` float DEFAULT '2.0',
	`m2` float DEFAULT '1.0',
    `wallet` text DEFAULT NULL,
	`arz` text DEFAULT 'TRX',
	`zircoin` float DEFAULT '0.1',
	`xd` text DEFAULT 'hojjat'
) default charset = utf8mb4; 
CREATE TABLE `spam` (
    `id` bigint(30) PRIMARY KEY ,
    `block` VARCHAR(10) CHARACTER SET utf8mb4,
    `spam` INT(50) ,
    `timee` INT(50)
) default charset = utf8mb4;
CREATE TABLE `sendall` (
  	`step` varchar(20) DEFAULT NULL,
	`text` text DEFAULT NULL,
	`chat` varchar(100) DEFAULT NULL,
	`abcd` varchar(100) DEFAULT 'tx',
    `allsend` varchar(100) DEFAULT 'yeh_xd',
    `vaz` varchar(100) DEFAULT 'off',
    `xdhojjat` text DEFAULT NULL,
    `mandeh` bigint DEFAULT '0',
    `sd` bigint DEFAULT '759',
	`user` bigint DEFAULT '0'
) default charset = utf8mb4;
INSERT INTO `sendall` () VALUES ();
INSERT INTO `settings` () VALUES ();
INSERT INTO `dt` () VALUES ();
");
# -- connection
if ($connect->connect_error) {
die("خطا هنگام برقراری با دیتابیس ربات :" . $connect->connect_error);
}
echo "
Done @WinstonSourcebot"
?>