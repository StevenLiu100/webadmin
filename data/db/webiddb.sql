-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2012 年 02 月 09 日 08:35
-- 服务器版本: 5.5.20
-- PHP 版本: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;



--
-- 数据库: `webiddb`
--
drop database webiddb;
create database webiddb;
use webiddb;

-- --------------------------------------------------------

--
-- 表的结构 `webinfo`
--

CREATE TABLE IF NOT EXISTS `webinfo` (
  `webid` int(11) NOT NULL AUTO_INCREMENT,
  `webname` varchar(100) NOT NULL,
  `webtype` varchar(20) DEFAULT NULL,
  `webnumber` varchar(30) DEFAULT NULL,
  `firstlevelid` int(4) DEFAULT NULL,
  `secondlevelid` int(4) DEFAULT NULL,
  `webunit` varchar(100) DEFAULT NULL,
  `webauthorize` varchar(100) DEFAULT NULL,
  `webchanel` varchar(300) DEFAULT NULL,
  `webregisterid` int(11) DEFAULT NULL,
  `webip` varchar(60) NOT NULL,
  `webdomain` varchar(30) DEFAULT NULL,
  `webrecorddate` datetime DEFAULT NULL,
  `webstate` varchar(10) NOT NULL,
  PRIMARY KEY (`webid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
-- --------------------------------------------------------

--
-- 表的结构 `webhistory`
--

CREATE TABLE IF NOT EXISTS `webhistory` (
  `historyid` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(11) NOT NULL,
  `checkname` varchar(50) DEFAULT NULL,
  `createdate` datetime DEFAULT NULL,
  `checkconnect` varchar(10) DEFAULT NULL,
  `checkwebnumber` varchar(10) DEFAULT NULL,
  `checkunit` varchar(10) DEFAULT NULL,
  `checkip` varchar(10) DEFAULT NULL,
  `checkdomain` varchar(10) DEFAULT NULL,
  `checklinkman` varchar(10) DEFAULT NULL,
  `checktel` varchar(10) NOT NULL,
  `checkregister` boolean DEFAULT NULL,
  PRIMARY KEY (`historyid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
-- --------------------------------------------------------

--
-- 表的结构 `certkey`
--

CREATE TABLE IF NOT EXISTS `certkey` (
  `keyid` int(11) NOT NULL AUTO_INCREMENT,
  `certid` int(11) NOT NULL,
  `publickey` varchar(200) NOT NULL,
  `privatekey` varchar(200) NOT NULL,
  `publickey1` varchar(200) NOT NULL,
  `privatekey1` varchar(200) NOT NULL,
  PRIMARY KEY (`keyid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
-- --------------------------------------------------------

--
-- 表的结构 `webcert`
--

CREATE TABLE IF NOT EXISTS `webcert` (
  `certid` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(11) NOT NULL,
  `releaseunit` varchar(50) NOT NULL,
  `releasedate` datetime NOT NULL,
  `releaseuserid` int(11) NOT NULL,
  `validity` datetime NOT NULL,
  PRIMARY KEY (`certid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
-- --------------------------------------------------------

--
-- 表的结构 `webcheck`
--

CREATE TABLE IF NOT EXISTS `webcheck` (
  `checkid` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(11) NOT NULL,
  `checkuserid` varchar(50) NOT NULL,
  `checkdate` datetime NOT NULL,
  `suggestion` varchar(200) DEFAULT NULL,
  `ifpass` boolean NOT NULL,
  PRIMARY KEY (`checkid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
-- --------------------------------------------------------

--
-- 表的结构 `webillegal`
-- 
--

CREATE TABLE IF NOT EXISTS `webillegal` (
  `reportid` int(11) NOT NULL AUTO_INCREMENT,
  `reporttype` varchar(10) NOT NULL,
  `reportdate` datetime NOT NULL,
  `reporter` varchar(50) NOT NULL,
  `reportertel` varchar(50) NOT NULL,
  `weburl` varchar(200) NOT NULL,
  `reportcontent` varchar(300) NOT NULL,
  `iftrue` boolean DEFAULT NULL,
  `dealresult` varchar(100) NOT NULL,
  `dealuserid` int(11) DEFAULT NULL,
  PRIMARY KEY (`reportid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `webradiowork`
-- 
--

CREATE TABLE IF NOT EXISTS `webradiowork` (
  `workid` int(11) NOT NULL AUTO_INCREMENT,
  `workdate` int(11) NOT NULL,
  `strategyid` int(11) NOT NULL,
  `webid` int(11) DEFAULT NULL,
  `webip` varchar(30) NOT NULL,
  `weburl` varchar(200) NOT NULL,
  `result` varchar(300) ,
  PRIMARY KEY (`workid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
-- --------------------------------------------------------

--
-- 表的结构 `webradiostrategy`
-- 
--

CREATE TABLE IF NOT EXISTS `webradiostrategy` (
  `strategyid` int(11) NOT NULL AUTO_INCREMENT,
  `strategyname` varchar(50) NOT NULL,
  `iparray` varchar(600) NOT NULL,
  `ifreuse` boolean DEFAULT false,
  PRIMARY KEY (`strategyid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
-- --------------------------------------------------------

--
-- 表的结构 `unit`
-- 
--

CREATE TABLE IF NOT EXISTS `unit` (
  `unitid` int(11) NOT NULL AUTO_INCREMENT,
  `unitname` varchar(50) NOT NULL,
  `parentid` int(11) DEFAULT 0,
  `unitorder` int(4) NOT NULL,
  PRIMARY KEY (`unitid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
-- --------------------------------------------------------

--
-- 表的结构 `ACApplication`
--

CREATE TABLE IF NOT EXISTS `acapplication` (
  `applicationid` int(11) NOT NULL AUTO_INCREMENT,
  `applicationname` varchar(50) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `enable` boolean DEFAULT true,
  `apporder` int(4) DEFAULT NULL,
  PRIMARY KEY (`applicationid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ACUser`
--

CREATE TABLE IF NOT EXISTS `acuser` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `passwordsalt` varchar(100) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `tel` varchar(50) DEFAULT NULL,
  `unit` varchar(100) DEFAULT NULL,
  `createdate` datetime DEFAULT NULL,
  `userstyle` varchar(100) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `comment` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `SYSLog`
--

CREATE TABLE IF NOT EXISTS `SYSLog` (
  `logid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `event` varchar(200) DEFAULT NULL,
  `eventtype` varchar(10) DEFAULT NULL,
  `createdate` datetime DEFAULT NULL,
  PRIMARY KEY (`logid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;





/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
