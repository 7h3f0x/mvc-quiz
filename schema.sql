CREATE TABLE `quiz`.`users` ( `username` VARCHAR(255) NOT NULL , `password` VARCHAR(64) NOT NULL , `points` INT(255) NOT NULL DEFAULT '0' , `isadmin` INT(1) NOT NULL DEFAULT '0' ) ENGINE = InnoDB;


CREATE TABLE `quiz`.`questions` ( `Title` VARCHAR(64) NOT NULL,`Question` VARCHAR(1023) NOT NULL , `a` VARCHAR(64) NOT NULL , `b` VARCHAR(64) NOT NULL , `c` VARCHAR(64) NOT NULL , `d` VARCHAR(64) NOT NULL , `correct` VARCHAR(1) NOT NULL , `points` INT(64) NOT NULL , `number` INT(255) NOT NULL AUTO_INCREMENT,PRIMARY KEY(number) )ENGINE = InnoDB;

CREATE TABLE `quiz`.`results` ( `username` VARCHAR(255) NOT NULL , `q` INT(255) NOT NULL , `status` VARCHAR(64) NOT NULL DEFAULT 'unanswered' ) ENGINE = InnoDB;
