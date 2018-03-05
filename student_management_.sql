/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.1.13-MariaDB : Database - test
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`test` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `test`;

/*Table structure for table `admin_panel` */

DROP TABLE IF EXISTS `admin_panel`;

CREATE TABLE `admin_panel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `contact_number` decimal(15,0) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created at` time(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `admin_panel` */

insert  into `admin_panel`(`id`,`name`,`contact_number`,`email`,`password`,`image_url`,`created at`) values (1,'Md. Rasel Ahmed','1811545409','rasel2920@diu.edu.bd','12345','pic.jpg','00:00:00.000000'),(2,'rasel','1732545409','rasel300bc@gmail.com','12345',NULL,'00:00:00.000000');

/*Table structure for table `courses` */

DROP TABLE IF EXISTS `courses`;

CREATE TABLE `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(100) NOT NULL,
  `total_fees` double NOT NULL,
  `semester_fee` double NOT NULL,
  `new_batch_no` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `courses` */

insert  into `courses`(`id`,`course_name`,`total_fees`,`semester_fee`,`new_batch_no`,`created_by`,`created_at`) values (7,'BSc in EEE',600000,50000,10,0,NULL),(15,'BSc in CSE',600000,50000,12,0,NULL),(17,'BSc in TE',600000,50000,56,0,NULL),(18,'bba',600000,50000,18,0,NULL),(19,'BSc in ETE',600000,50000,0,0,NULL);

/*Table structure for table `parents` */

DROP TABLE IF EXISTS `parents`;

CREATE TABLE `parents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image_url` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `parents` */

insert  into `parents`(`id`,`name`,`contact_number`,`email`,`password`,`image_url`,`created_at`) values (1,'Jahangir Hossain','01711169467','jahangir@gmail.com','1234',NULL,NULL);

/*Table structure for table `payment_history` */

DROP TABLE IF EXISTS `payment_history`;

CREATE TABLE `payment_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `payment_amount` double NOT NULL,
  `is_admission` int(11) NOT NULL DEFAULT '0',
  `pay_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `payment_history` */

insert  into `payment_history`(`id`,`student_id`,`payment_id`,`payment_amount`,`is_admission`,`pay_date`) values (1,0,0,50000,0,'2016-07-23 22:16:28'),(2,0,0,0,0,'2016-07-23 22:16:41'),(3,1,10,50000,0,'2016-07-29 21:37:05'),(4,1,11,50000,0,'2016-07-29 21:42:39'),(5,1,12,50000,0,'2016-07-30 13:38:23'),(6,1,13,50000,0,'2016-07-30 21:58:17'),(7,4,14,50000,0,'2016-08-01 11:45:37'),(8,4,15,50000,0,'2016-08-01 11:58:44'),(9,4,16,50000,0,'2016-08-05 21:33:20');

/*Table structure for table `results` */

DROP TABLE IF EXISTS `results`;

CREATE TABLE `results` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cgpa` varchar(10) NOT NULL,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `batch_no` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `results` */

/*Table structure for table `semesters` */

DROP TABLE IF EXISTS `semesters`;

CREATE TABLE `semesters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `is_current` tinyint(4) NOT NULL DEFAULT '0',
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `semesters` */

insert  into `semesters`(`id`,`name`,`is_current`,`batch`) values (1,'Spring - 2015',0,0),(2,'Summer - 2016',0,0),(3,'Fall - 2016',0,0),(4,'Spring - 2016',1,0),(5,'Summer - 2017',0,0),(6,'Fall - 2017',0,0);

/*Table structure for table `student_admission` */

DROP TABLE IF EXISTS `student_admission`;

CREATE TABLE `student_admission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roll_no` varchar(50) NOT NULL,
  `course` int(11) NOT NULL,
  `campus` varchar(200) NOT NULL,
  `applicant_name` varchar(100) NOT NULL,
  `father_name` varchar(100) NOT NULL,
  `mother_name` varchar(100) DEFAULT NULL,
  `gender` varchar(10) NOT NULL,
  `birth_date` datetime NOT NULL,
  `blood_group` varchar(5) DEFAULT NULL,
  `contact_no` varchar(25) NOT NULL,
  `country` varchar(40) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL,
  `present_address` text,
  `permanent_address` text,
  `ssc_type` varchar(20) NOT NULL,
  `ssc_grade` varchar(30) DEFAULT NULL,
  `ssc_institute` varchar(200) NOT NULL,
  `ssc_board` varchar(200) NOT NULL,
  `ssc_passing_year` int(11) NOT NULL,
  `ssc_group` varchar(30) NOT NULL,
  `ssc_gpa` varchar(5) NOT NULL,
  `ssc_english_result` varchar(30) DEFAULT NULL,
  `o_level_institute` varchar(100) NOT NULL,
  `o_level_subject1_name` varchar(50) NOT NULL,
  `o_level_subject2_name` varchar(50) NOT NULL,
  `o_level_subject3_name` varchar(50) NOT NULL,
  `o_level_subject4_name` varchar(50) NOT NULL,
  `o_level_subject5_name` varchar(50) NOT NULL,
  `o_level_subject6_name` varchar(50) NOT NULL,
  `o_level_subject7_name` varchar(50) NOT NULL,
  `o_level_passing_year` int(11) NOT NULL,
  `o_level_subject1_result` varchar(30) NOT NULL,
  `o_level_subject2_result` varchar(30) NOT NULL,
  `o_level_subject3_result` varchar(30) NOT NULL,
  `o_level_subject4_result` varchar(30) NOT NULL,
  `o_level_subject5_result` varchar(30) NOT NULL,
  `o_level_subject6_result` varchar(30) NOT NULL,
  `o_level_subject7_result` varchar(30) NOT NULL,
  `hsc_type` varchar(50) NOT NULL,
  `hsc_grade` varchar(30) NOT NULL,
  `hsc_institute` varchar(150) NOT NULL,
  `hsc_board` varchar(150) NOT NULL,
  `hsc_group` varchar(100) NOT NULL,
  `hsc_passing_year` int(11) NOT NULL,
  `hsc_gpa` varchar(30) NOT NULL,
  `hsc_english_result` varchar(30) NOT NULL,
  `hsc_math_result` varchar(30) NOT NULL,
  `hsc_physics_result` varchar(30) NOT NULL,
  `hsc_biology_result` varchar(30) NOT NULL,
  `a_level_institute` varchar(150) NOT NULL,
  `a_level_subject1_name` varchar(50) NOT NULL,
  `a_level_subject2_name` varchar(50) NOT NULL,
  `a_level_subject3_name` varchar(50) NOT NULL,
  `a_level_subject4_name` varchar(50) NOT NULL,
  `a_level_passing_year` int(11) NOT NULL,
  `a_level_subject1_result` varchar(30) NOT NULL,
  `a_level_subject2_result` varchar(30) NOT NULL,
  `a_level_subject3_result` varchar(30) NOT NULL,
  `a_level_subject4_result` varchar(30) NOT NULL,
  `diploma_institute` varchar(150) NOT NULL,
  `diploma_subject` varchar(100) NOT NULL,
  `diploma_grade` varchar(30) NOT NULL,
  `diploma_passing_year` int(11) NOT NULL,
  `diploma_cgpa` varchar(30) NOT NULL,
  `diploma_board` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `total_amount` double NOT NULL,
  `paid_amount` double NOT NULL DEFAULT '0',
  `due_amount` double NOT NULL DEFAULT '0',
  `admission_paid` int(11) NOT NULL DEFAULT '0',
  `batch_no` int(11) NOT NULL,
  `semester_starts` int(11) NOT NULL DEFAULT '0',
  `cur_semester` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_unique` (`email`),
  KEY `Course_Student` (`course`),
  CONSTRAINT `Course_Student` FOREIGN KEY (`course`) REFERENCES `courses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `student_admission` */

insert  into `student_admission`(`id`,`roll_no`,`course`,`campus`,`applicant_name`,`father_name`,`mother_name`,`gender`,`birth_date`,`blood_group`,`contact_no`,`country`,`district`,`present_address`,`permanent_address`,`ssc_type`,`ssc_grade`,`ssc_institute`,`ssc_board`,`ssc_passing_year`,`ssc_group`,`ssc_gpa`,`ssc_english_result`,`o_level_institute`,`o_level_subject1_name`,`o_level_subject2_name`,`o_level_subject3_name`,`o_level_subject4_name`,`o_level_subject5_name`,`o_level_subject6_name`,`o_level_subject7_name`,`o_level_passing_year`,`o_level_subject1_result`,`o_level_subject2_result`,`o_level_subject3_result`,`o_level_subject4_result`,`o_level_subject5_result`,`o_level_subject6_result`,`o_level_subject7_result`,`hsc_type`,`hsc_grade`,`hsc_institute`,`hsc_board`,`hsc_group`,`hsc_passing_year`,`hsc_gpa`,`hsc_english_result`,`hsc_math_result`,`hsc_physics_result`,`hsc_biology_result`,`a_level_institute`,`a_level_subject1_name`,`a_level_subject2_name`,`a_level_subject3_name`,`a_level_subject4_name`,`a_level_passing_year`,`a_level_subject1_result`,`a_level_subject2_result`,`a_level_subject3_result`,`a_level_subject4_result`,`diploma_institute`,`diploma_subject`,`diploma_grade`,`diploma_passing_year`,`diploma_cgpa`,`diploma_board`,`email`,`password`,`total_amount`,`paid_amount`,`due_amount`,`admission_paid`,`batch_no`,`semester_starts`,`cur_semester`,`created_at`) values (4,'',15,'Main','Rasel','Jahangir Hossain','Parvin Sultana','male','0000-00-00 00:00:00','B+','01732545409','Bangladesh','PIROJPUR','Mohammadpur','Kawkhali','ssc','A','Govt K.G Union High School','barisal',2008,'Humanities','4.75','A','0','0','0','0','0','0','0','0',0,'0','0','0','0','0','0','0','hsc','A','Amrita Lal Dey College, Barisal','barisal','Humanities',2010,'4.88','A','A+','A','A+','','0','0','0','0',0,'0','0','0','0','','0','0',0,'','','rasel300bc@gmail.com','1234',600000,150000,450000,0,12,2,1,'2016-08-01 07:44:23');

/*Table structure for table `subjects` */

DROP TABLE IF EXISTS `subjects`;

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_name` varchar(150) NOT NULL,
  `subject_credit` varchar(20) NOT NULL,
  `course_id` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `subjects` */

insert  into `subjects`(`id`,`subject_name`,`subject_credit`,`course_id`,`semester`,`created_at`,`created_by`) values (1,'History of computer','3',0,6,'0000-00-00 00:00:00',0),(2,'Networking','3',0,6,'0000-00-00 00:00:00',0),(3,'Telecommunication fundamentals','3',17,6,'0000-00-00 00:00:00',0),(4,'Basics of computer','3',15,3,'0000-00-00 00:00:00',0),(5,'Networking u','3',7,2,'0000-00-00 00:00:00',0),(6,'Basics of computer j','3',7,2,'0000-00-00 00:00:00',0),(7,'Basics of computer','3',7,3,'0000-00-00 00:00:00',0);

/*Table structure for table `transaction_history` */

DROP TABLE IF EXISTS `transaction_history`;

CREATE TABLE `transaction_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tran_id` varchar(100) NOT NULL,
  `val_id` varchar(100) DEFAULT NULL,
  `amount` double NOT NULL,
  `card_type` varchar(50) DEFAULT NULL,
  `store_amount` double DEFAULT NULL,
  `card_no` varchar(200) DEFAULT NULL,
  `bank_tran_id` varchar(200) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'processing',
  `tran_date` datetime DEFAULT NULL,
  `card_issuer_country` varchar(200) DEFAULT NULL,
  `verify_sign` varchar(300) DEFAULT NULL,
  `verify_key` varchar(300) DEFAULT NULL,
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `transaction_history` */

insert  into `transaction_history`(`id`,`tran_id`,`val_id`,`amount`,`card_type`,`store_amount`,`card_no`,`bank_tran_id`,`status`,`tran_date`,`card_issuer_country`,`verify_sign`,`verify_key`,`creation_time`,`update_time`) values (1,'579b6ee6e4108','1607292057400KbpIc3Q8AEzAN4',50000,'VISA-Dutch Bangla',48500,'','160729205740TNE1oE9T1F0BGWu','VALID','2016-07-29 20:57:18','','7b644731754cf385c265dfe061e21c33','amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_type,currency,currency_amount,currency_rate,currency_type,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d','2016-07-29 16:57:43',NULL),(2,'579b796803229','160729214213NKgxxS6013kptDw',50000,'VISA-Dutch Bangla',48500,'','160729214212FhlpKv1aUjovAiC','VALID','2016-07-29 21:42:07','','1472aef4fb34d6e1ab451d06d53c01d6','amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_type,currency,currency_amount,currency_rate,currency_type,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d','2016-07-29 17:42:32',NULL),(3,'579c5967bbb18','1607301337571zsZuo2yq3fpiUf',50000,'MASTER-Dutch Bangla',48500,'512815XXXXXX4837','1607301337575qu29HTOLVmavh8','VALID','2016-07-30 13:37:51','Bangladesh','46becb98c606f5c1de011f0a43b77e19','amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_type,currency,currency_amount,currency_rate,currency_type,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d','2016-07-30 09:38:15',NULL),(4,'579cce923dbab','1607302157511uYd2zFMMxJmRAr',50000,'VISA-Dutch Bangla',48500,'','1607302157517OWVdnVoqMwqZul','VALID','2016-07-30 21:57:46','','dd75523cc45b1f3348272f32c9ee1a65','amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_type,currency,currency_amount,currency_rate,currency_type,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d','2016-07-30 17:58:10',NULL),(5,'579ee1ebcf375','1608011145080eU5ZdM6bFIbjeH',50000,'VISA-Dutch Bangla',48500,'','1608011145081zAUCRLzJA4Irgu','VALID','2016-08-01 11:44:51','','e3f04e33714d012c3d1b42aa19fb6c74','amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_type,currency,currency_amount,currency_rate,currency_type,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d','2016-08-01 07:45:15',NULL),(6,'579ee4f81b997','16080111581519EdK0kaDnIrKLI',50000,'MASTER-Dutch Bangla',48500,'512815******4147','160801115815WZiGTOABB0nn2cD','VALID','2016-08-01 11:57:55','Bangladesh','11654d5974c392b5519821dadec42878','amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_type,currency,currency_amount,currency_rate,currency_type,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d','2016-08-01 07:58:16',NULL),(7,'57a4b1b478f94','160805213254nek7bsVePSMYNKg',50000,'VISA-Dutch Bangla',48500,'','1608052132541TXveFROBQqF4IH','VALID','2016-08-05 21:32:43','','a1f4f4f5b87abb157e558b161440cbc4','amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_type,currency,currency_amount,currency_rate,currency_type,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d','2016-08-05 17:33:08',NULL);

/*Table structure for table `transactions` */

DROP TABLE IF EXISTS `transactions`;

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tran_id` varchar(100) NOT NULL,
  `student_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `course_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `total_amount` double NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'processing',
  `creation_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `transactions` */

insert  into `transactions`(`id`,`tran_id`,`student_id`,`email`,`course_id`,`semester_id`,`total_amount`,`status`,`creation_time`,`update_time`) values (1,'5797867192732',1,'abcd@gmail.com',7,2,50000,'processing','2016-07-26 17:49:05',NULL),(2,'579786e7be9d7',1,'abcd@gmail.com',7,2,50000,'processing','2016-07-26 17:51:03',NULL),(3,'5797871a6be41',1,'abcd@gmail.com',7,2,50000,'processing','2016-07-26 17:51:54',NULL),(4,'5797872d25012',1,'abcd@gmail.com',7,2,50000,'processing','2016-07-26 17:52:13',NULL),(5,'579a36ac83edb',1,'abcd@gmail.com',7,2,50000,'processing','2016-07-28 18:45:32',NULL),(6,'579a3a733e4a7',1,'abcd@gmail.com',7,0,50000,'processing','2016-07-28 19:01:39',NULL),(7,'579a3b72c2e75',1,'abcd@gmail.com',7,3,50000,'processing','2016-07-28 19:05:54',NULL),(8,'579a3b9cbde35',1,'abcd@gmail.com',7,3,50000,'processing','2016-07-28 19:06:36',NULL),(9,'579a3c0a9e886',1,'abcd@gmail.com',7,3,50000,'processing','2016-07-28 19:08:26',NULL),(10,'579b6ee6e4108',1,'abcd@gmail.com',7,2,50000,'SUCCESS','2016-07-29 16:57:42',NULL),(11,'579b796803229',1,'abcd@gmail.com',7,2,50000,'SUCCESS','2016-07-29 17:42:32',NULL),(12,'579c5967bbb18',1,'abcd@gmail.com',7,0,50000,'SUCCESS','2016-07-30 09:38:15',NULL),(13,'579cce923dbab',1,'rasel300bc@gmail.com',7,0,50000,'SUCCESS','2016-07-30 17:58:10',NULL),(14,'579ee1ebcf375',4,'rasel300bc@gmail.com',15,0,50000,'SUCCESS','2016-08-01 07:45:15',NULL),(15,'579ee4f81b997',4,'rasel300bc@gmail.com',15,0,50000,'SUCCESS','2016-08-01 07:58:16',NULL),(16,'57a4b1b478f94',4,'rasel300bc@gmail.com',15,2,50000,'SUCCESS','2016-08-05 17:33:08',NULL);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(200) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(250) NOT NULL,
  `mobile_no` varchar(13) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE USERNAME` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`full_name`,`username`,`password`,`mobile_no`,`email`,`created_at`) values (1,'Rasel','rasel','1234','01700000000','jewel1971r2@gmail.com',NULL),(3,'Rasel','rasel123','1234','017000000','rasel300bc@gmail.com',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
