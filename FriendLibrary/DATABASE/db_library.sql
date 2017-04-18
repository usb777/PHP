/*
SQLyog Ultimate v9.50 
MySQL - 5.5.16 : Database - db_library
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_library` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `db_library`;

/*Table structure for table `books` */

DROP TABLE IF EXISTS `books`;

CREATE TABLE `books` (
  `b_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `b_url` varchar(255) DEFAULT NULL,
  `b_description` text,
  `b_year` varchar(50) DEFAULT NULL,
  `b_name` varchar(150) DEFAULT NULL,
  `b_filename` varchar(100) DEFAULT NULL,
  `b_img1` varchar(200) DEFAULT NULL,
  `b_img2` varchar(200) DEFAULT NULL,
  `b_img3` varchar(200) DEFAULT NULL,
  `cb_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`b_id`),
  KEY `books2user` (`u_id`),
  KEY `books2category` (`cb_id`),
  CONSTRAINT `books2category` FOREIGN KEY (`cb_id`) REFERENCES `category_book` (`cb_id`),
  CONSTRAINT `books2user` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `books` */

insert  into `books`(`b_id`,`u_id`,`b_url`,`b_description`,`b_year`,`b_name`,`b_filename`,`b_img1`,`b_img2`,`b_img3`,`cb_id`) values (1,1,'1',NULL,'2010','book','boka',NULL,NULL,NULL,1),(6,7,'/AllUsersBooks/natasha/','Description:dsfsdf','2010','Cool Book','COOL_book777.pdf',NULL,NULL,NULL,4),(9,7,'/AllUsersBooks/natasha/','Description:','2004','MegaBookNatasha','February 2017 Career Readiness Workshops - CU Students.pdf',NULL,NULL,NULL,3),(10,8,'/AllUsersBooks/user2/','Android development, Mobile App Strategy. ','2016','Mobile Applic Startegu','MobileAppStrategy.pdf',NULL,NULL,NULL,4),(11,4,'/AllUsersBooks/test/','Description: resume programming','2001','New Book test1','New_Book_test.docx','New_Book_test.jpg',NULL,NULL,4),(12,4,'/AllUsersBooks/test/','Description:Vas is das Description:Vas is dasDescription:Vas is dasDescription:Vas is dasDescription:Vas is dasDescription:Vas is dasDescription:Vas is dasDescription:Vas is dasDescription:Vas is dasDescription:Vas is dasDescription:Vas is dasDescription:Vas is dasDescription:Vas is dasDescription:Vas is dasDescription:Vas is dasDescription:Vas is dasDescription:Vas is dasDescription:Vas is dasDescription:Vas is dasDescription:Vas is dasDescription:Vas is dasDescription:Vas is dasDescription:Vas is das','2010','vas is das book','vas_is_das_book.txt','vas_is_das_book.gif',NULL,NULL,2),(13,7,'/AllUsersBooks/natasha/','Description: Hellow World','2014','Mars atakuet','Mars_atakuet.docx','Mars_atakuet.jpg',NULL,NULL,4);

/*Table structure for table `category_book` */

DROP TABLE IF EXISTS `category_book`;

CREATE TABLE `category_book` (
  `cb_id` int(11) NOT NULL AUTO_INCREMENT,
  `cb_name` varchar(100) NOT NULL,
  PRIMARY KEY (`cb_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `category_book` */

insert  into `category_book`(`cb_id`,`cb_name`) values (1,'Science'),(2,'Medicine'),(3,'History7'),(4,'Programming'),(7,'Alchemyst');

/*Table structure for table `role` */

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `role_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `role` */

insert  into `role`(`role_id`,`role_name`) values (1,'administartor'),(2,'author/uploader'),(3,'subscriber'),(4,'reader');

/*Table structure for table `status` */

DROP TABLE IF EXISTS `status`;

CREATE TABLE `status` (
  `status_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `status` */

insert  into `status`(`status_id`,`status_name`) values (1,'enabled'),(2,'disabled'),(3,'banned');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_login` varchar(50) NOT NULL,
  `u_passw` varchar(100) NOT NULL,
  `u_firstname` varchar(100) DEFAULT NULL,
  `u_lastname` varchar(100) DEFAULT NULL,
  `u_mail` varchar(100) DEFAULT NULL,
  `u_facebookid` varchar(220) DEFAULT NULL,
  `role_id` smallint(6) DEFAULT NULL,
  `status_id` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`u_id`,`u_login`,`u_passw`,`u_firstname`,`u_lastname`,`u_mail`,`u_facebookid`,`role_id`,`status_id`) values (1,'admin','adminadmin',NULL,NULL,NULL,'',1,1),(3,'dzendzimon','dzen','Dzmitry','Samoila','dzsamoila@gmail.com','',2,1),(4,'test','test','Testovy','User','testuser@test.com','',2,2),(6,'dzsamoila','zxcdsaqwe','Dzmitry','Samoila','seodslab@gmail.com',NULL,2,1),(7,'natasha','1234','Natali','Khoshonij7','kh777@kh.ru',NULL,2,1),(8,'user2','user2','USER2Andreich','USERVToroi','userovski@gmail.com',NULL,2,1),(10,'panasik','1234','Olga','Panasik','olpanasik@gmail.com',NULL,2,1),(12,'ozzy','ozzy','Dio','Ozzy','Ozzy@mail.ru',NULL,4,1),(13,'anderson','123','Andrei','Anderson','and@gmail.com',NULL,2,1),(14,'test2','test2','test2','test2','test2@gmail.com',NULL,2,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
