/*
SQLyog Professional v11.41 (64 bit)
MySQL - 5.6.20 : Database - freelanceprojectmanager
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`freelanceprojectmanager` /*!40100 DEFAULT CHARACTER SET latin1 */;

/*Table structure for table `companies` */

DROP TABLE IF EXISTS `companies`;

CREATE TABLE `companies` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `company` varchar(50) DEFAULT NULL,
  `owner` varchar(50) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `admin` int(10) DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `companies` */

/*Table structure for table `pages` */

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `page` varchar(50) DEFAULT NULL,
  `description` varchar(10000) DEFAULT NULL,
  `project` int(10) DEFAULT NULL,
  `company` int(10) DEFAULT NULL,
  `modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `pages` */

/*Table structure for table `projects` */

DROP TABLE IF EXISTS `projects`;

CREATE TABLE `projects` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `project` varchar(50) DEFAULT NULL,
  `type` varchar(100) DEFAULT 'web site',
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `description` varchar(10000) DEFAULT NULL,
  `company` int(10) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `projects` */

/*Table structure for table `reminders` */

DROP TABLE IF EXISTS `reminders`;

CREATE TABLE `reminders` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `reminder` varchar(10000) DEFAULT NULL,
  `task` int(10) DEFAULT NULL,
  `status` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `reminders` */

/*Table structure for table `tasks` */

DROP TABLE IF EXISTS `tasks`;

CREATE TABLE `tasks` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `task` varchar(50) DEFAULT NULL,
  `description` varchar(10000) DEFAULT NULL,
  `status` int(100) DEFAULT '1',
  `project` int(10) DEFAULT NULL,
  `priority` varchar(15) DEFAULT NULL,
  `assignee` varchar(30) DEFAULT NULL,
  `dueDate` date DEFAULT NULL,
  `company` int(10) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `notes` blob,
  `percent` int(10) DEFAULT '0',
  `lastUpdate` timestamp NULL DEFAULT NULL,
  `completeDate` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

/*Data for the table `tasks` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(250) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NULL DEFAULT NULL,
  `salt` varchar(100) DEFAULT NULL,
  `hash` varchar(100) DEFAULT NULL,
  `status` int(1) DEFAULT '0',
  `forget` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=146 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`email`,`phone`,`first_name`,`last_name`,`company`,`role`,`created`,`modified`,`salt`,`hash`,`status`,`forget`) values (145,'admin','admin','','Admin','Account','','admin','2014-12-02 04:37:42',NULL,'$2a$05$fPSY6Gs1gOvRPZ8VaTOTzw==','$2a$05$fPSY6Gs1gOvRPZ8VaTOTzuhL/QoWNyXgjs7NqgumtAEnT0NEAiKBO',0,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
