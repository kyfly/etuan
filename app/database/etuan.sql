-- MySQL Script generated by MySQL Workbench
-- 07/12/14 12:39:35
-- Model: New Model    Version: 1.0
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema etuan
-- -----------------------------------------------------

USE `etuan` ;

-- -----------------------------------------------------
-- Table `etuan`.`organization_user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etuan`.`organization_user` (
  `org_uid` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(80) NOT NULL,
  `password` VARCHAR(60) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  `user_group` ENUM('root','org') NULL,
  PRIMARY KEY (`org_uid`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC));


-- -----------------------------------------------------
-- Table `etuan`.`organization`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etuan`.`organization` (
  `org_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(30) NOT NULL,
  `type` ENUM('校级组织','院级组织','校级社团','院级社团') NOT NULL,
  `school` ENUM('机械工程学院','电子信息学院','通信工程学院','自动化学院','计算机学院','生命信息与仪器工程学院','材料与环境工程学院','软件工程学院','理学院','经济学院','管理学院','会计学院','外国语学院','数字媒体与艺术设计学院','人文与法学院','马克思主义学院','卓越学院','信息工程学院') NOT NULL,
  `logo_url` VARCHAR(100) NULL,
  `internal_order` INT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  `org_uid` INT NOT NULL,
  PRIMARY KEY (`org_id`),
  INDEX `fk_organization_organization_user1_idx` (`org_uid` ASC),
  CONSTRAINT `fk_organization_organization_user1`
    FOREIGN KEY (`org_uid`)
    REFERENCES `etuan`.`organization_user` (`org_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etuan`.`department`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etuan`.`department` (
  `depart_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(20) NOT NULL,
  `description` VARCHAR(250) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  `org_id` INT NOT NULL,
  PRIMARY KEY (`depart_id`),
  INDEX `fk_department_organization1_idx` (`org_id` ASC),
  CONSTRAINT `fk_department_organization1`
    FOREIGN KEY (`org_id`)
    REFERENCES `etuan`.`organization` (`org_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etuan`.`wx_user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etuan`.`wx_user` (
  `wx_uid` VARCHAR(50) NOT NULL,
  `nick_name` VARCHAR(60) NULL,
  `sex` INT NULL,
  `province` VARCHAR(20) NULL,
  `city` VARCHAR(30) NULL,
  `country` VARCHAR(30) NULL,
  `headimgurl` VARCHAR(200) NULL,
  `privilege` VARCHAR(45) NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`wx_uid`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etuan`.`registration`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etuan`.`registration` (
  `reg_id` INT NOT NULL AUTO_INCREMENT,
  `start_time` VARCHAR(45) NOT NULL,
  `stop_time` VARCHAR(45) NOT NULL,
  `limit_grade` VARCHAR(5) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `theme` INT NOT NULL,
  `url` VARCHAR(15) NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  `org_uid` INT NOT NULL,
  PRIMARY KEY (`reg_id`),
  INDEX `fk_Registration_organization_user1_idx` (`org_uid` ASC),
  CONSTRAINT `fk_Registration_organization_user1`
    FOREIGN KEY (`org_uid`)
    REFERENCES `etuan`.`organization_user` (`org_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etuan`.`registration_user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etuan`.`registration_user` (
  `reg_serial` INT NOT NULL AUTO_INCREMENT,
  `used_time` TIME NULL,
  `ip` VARCHAR(50) NULL,
  `student_id` INT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reg_id` INT NOT NULL,
  `wx_uid` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`reg_serial`),
  INDEX `fk_Registration_user_Registration1_idx` (`reg_id` ASC),
  INDEX `fk_Registration_user_wx_user1_idx` (`wx_uid` ASC),
  CONSTRAINT `fk_Registration_user_Registration1`
    FOREIGN KEY (`reg_id`)
    REFERENCES `etuan`.`registration` (`reg_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Registration_user_wx_user1`
    FOREIGN KEY (`wx_uid`)
    REFERENCES `etuan`.`wx_user` (`wx_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etuan`.`reg_question`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etuan`.`reg_question` (
  `reg_id` INT NOT NULL,
  `question_id` INT NOT NULL AUTO_INCREMENT,
  `type` INT NULL,
  `label` VARCHAR(45) NULL,
  `limit_type` INT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`question_id`, `reg_id`),
  INDEX `fk_reg_question_Registration1_idx` (`reg_id` ASC),
  CONSTRAINT `fk_reg_question_Registration1`
    FOREIGN KEY (`reg_id`)
    REFERENCES `etuan`.`registration` (`reg_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etuan`.`reg_result`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etuan`.`reg_result` (
  `reg_serial` INT NOT NULL AUTO_INCREMENT,
  `question_id` INT NOT NULL,
  `answer` VARCHAR(250) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`reg_serial`, `question_id`, `answer`),
  INDEX `fk_reg_result_reg_question1_idx` (`question_id` ASC),
  INDEX `fk_reg_result_Registration_user1_idx` (`reg_serial` ASC),
  CONSTRAINT `fk_reg_result_reg_question1`
    FOREIGN KEY (`question_id`)
    REFERENCES `etuan`.`reg_question` (`question_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_reg_result_Registration_user1`
    FOREIGN KEY (`reg_serial`)
    REFERENCES `etuan`.`registration_user` (`reg_serial`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etuan`.`reg_question_choice`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etuan`.`reg_question_choice` (
  `reg_id` INT NOT NULL,
  `question_id` INT NOT NULL AUTO_INCREMENT,
  `choice_id` INT NOT NULL,
  `label` VARCHAR(150) NULL,
  PRIMARY KEY (`question_id`, `reg_id`, `choice_id`),
  INDEX `fk_reg_question_choice_reg_question1_idx` (`question_id` ASC),
  INDEX `fk_reg_question_choice_registration1_idx` (`reg_id` ASC),
  CONSTRAINT `fk_reg_question_choice_reg_question1`
    FOREIGN KEY (`question_id`)
    REFERENCES `etuan`.`reg_question` (`question_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_reg_question_choice_registration1`
    FOREIGN KEY (`reg_id`)
    REFERENCES `etuan`.`registration` (`reg_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etuan`.`vote`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etuan`.`vote` (
  `vote_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `start_time` DATETIME NOT NULL,
  `stop_time` DATETIME NOT NULL,
  `theme` INT NOT NULL,
  `limit_grade` VARCHAR(5) NOT NULL,
  `choice_num` INT NOT NULL,
  `description` VARCHAR(200) NULL,
  `url` VARCHAR(15) NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  `org_uid` INT NOT NULL,
  PRIMARY KEY (`vote_id`),
  INDEX `fk_vote_organization_user1_idx` (`org_uid` ASC),
  CONSTRAINT `fk_vote_organization_user1`
    FOREIGN KEY (`org_uid`)
    REFERENCES `etuan`.`organization_user` (`org_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etuan`.`vote_item`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etuan`.`vote_item` (
  `vote_item_id` INT NOT NULL AUTO_INCREMENT,
  `pic_url` VARCHAR(200) NULL,
  `label` VARCHAR(45) NOT NULL,
  `content` VARCHAR(500) NULL,
  `vote_count` INT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  `vote_id` INT NOT NULL,
  PRIMARY KEY (`vote_item_id`, `vote_id`),
  INDEX `fk_vote_item_vote1_idx` (`vote_id` ASC),
  CONSTRAINT `fk_vote_item_vote1`
    FOREIGN KEY (`vote_id`)
    REFERENCES `etuan`.`vote` (`vote_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etuan`.`vote_user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etuan`.`vote_user` (
  `vote_serial` INT NOT NULL AUTO_INCREMENT,
  `used_time` TIME NULL,
  `ip` VARCHAR(50) NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `vote_id` INT NOT NULL,
  `wx_uid` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`vote_serial`),
  INDEX `fk_vote_user_vote1_idx` (`vote_id` ASC),
  INDEX `fk_vote_user_wx_user1_idx` (`wx_uid` ASC),
  CONSTRAINT `fk_vote_user_vote1`
    FOREIGN KEY (`vote_id`)
    REFERENCES `etuan`.`vote` (`vote_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vote_user_wx_user1`
    FOREIGN KEY (`wx_uid`)
    REFERENCES `etuan`.`wx_user` (`wx_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etuan`.`vote_result`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etuan`.`vote_result` (
  `vote_id` INT NOT NULL,
  `vote_serial` INT NOT NULL,
  `vote_choice` INT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`vote_id`, `vote_serial`, `vote_choice`),
  INDEX `fk_vote_result_vote1_idx` (`vote_id` ASC),
  INDEX `fk_vote_result_vote_user1_idx` (`vote_serial` ASC),
  CONSTRAINT `fk_vote_result_vote1`
    FOREIGN KEY (`vote_id`)
    REFERENCES `etuan`.`vote` (`vote_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vote_result_vote_user1`
    FOREIGN KEY (`vote_serial`)
    REFERENCES `etuan`.`vote_user` (`vote_serial`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etuan`.`lottery`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etuan`.`lottery` (
  `lottery_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `start_time` DATETIME NOT NULL,
  `stop_time` DATETIME NOT NULL,
  `theme` INT NOT NULL,
  `limit_act` ENUM('reg','vote','ticket') NOT NULL,
  `activity_id` INT NULL,
  `description` VARCHAR(200) NULL,
  `url` VARCHAR(15) NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  `org_uid` INT NOT NULL,
  PRIMARY KEY (`lottery_id`),
  INDEX `fk_lottery_organization_user1_idx` (`org_uid` ASC),
  CONSTRAINT `fk_lottery_organization_user1`
    FOREIGN KEY (`org_uid`)
    REFERENCES `etuan`.`organization_user` (`org_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etuan`.`lottery_item`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etuan`.`lottery_item` (
  `lottery_item_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `probability` INT NOT NULL,
  `item_total` INT NOT NULL,
  `item_out` INT NULL DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  `lottery_id` INT NOT NULL,
  PRIMARY KEY (`lottery_item_id`),
  INDEX `fk_lottery_item_lottery1_idx` (`lottery_id` ASC),
  CONSTRAINT `fk_lottery_item_lottery1`
    FOREIGN KEY (`lottery_id`)
    REFERENCES `etuan`.`lottery` (`lottery_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etuan`.`lottery_user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etuan`.`lottery_user` (
  `lottery_serial` INT NOT NULL AUTO_INCREMENT,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lottery_id` INT NOT NULL,
  `lottery_item_id` INT NOT NULL,
  `wx_uid` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`lottery_serial`),
  INDEX `fk_lottery_user_lottery1_idx` (`lottery_id` ASC),
  INDEX `fk_lottery_user_lottery_item1_idx` (`lottery_item_id` ASC),
  INDEX `fk_lottery_user_wx_user1_idx` (`wx_uid` ASC),
  CONSTRAINT `fk_lottery_user_lottery1`
    FOREIGN KEY (`lottery_id`)
    REFERENCES `etuan`.`lottery` (`lottery_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lottery_user_lottery_item1`
    FOREIGN KEY (`lottery_item_id`)
    REFERENCES `etuan`.`lottery_item` (`lottery_item_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lottery_user_wx_user1`
    FOREIGN KEY (`wx_uid`)
    REFERENCES `etuan`.`wx_user` (`wx_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etuan`.`mp_weixin`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etuan`.`mp_weixin` (
  `mp_id` INT NOT NULL,
  `mp_public_id` VARCHAR(45) NULL,
  `interface_url` VARCHAR(200) NULL,
  `interface_token` CHAR(32) NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  `org_uid` INT NOT NULL,
  PRIMARY KEY (`mp_id`),
  INDEX `fk_mp_weixin_organization_user1_idx` (`org_uid` ASC),
  CONSTRAINT `fk_mp_weixin_organization_user1`
    FOREIGN KEY (`org_uid`)
    REFERENCES `etuan`.`organization_user` (`org_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etuan`.`mp_auto_reply`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etuan`.`mp_auto_reply` (
  `mp_reply_id` INT NOT NULL,
  `keyword` VARCHAR(45) NULL,
  `msg_type` ENUM('text','news') NULL,
  `msg_id` INT NULL,
  `mp_id` INT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`mp_reply_id`),
  INDEX `fk_mp_auto_reply_mp_weixin1_idx` (`mp_id` ASC),
  CONSTRAINT `fk_mp_auto_reply_mp_weixin1`
    FOREIGN KEY (`mp_id`)
    REFERENCES `etuan`.`mp_weixin` (`mp_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etuan`.`ticket`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etuan`.`ticket` (
  `ticket_id` INT NOT NULL AUTO_INCREMENT,
  `act_tittle` VARCHAR(20) NOT NULL,
  `arrange` INT NOT NULL,
  `start_time` DATETIME NULL,
  `logo` VARCHAR(60) NOT NULL,
  `theme` INT NOT NULL,
  `url` VARCHAR(15) NOT NULL,
  `verify` INT NOT NULL,
  `ticket_total` INT NOT NULL,
  `ticket_out` INT NULL DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  `org_uid` INT NOT NULL,
  PRIMARY KEY (`ticket_id`),
  INDEX `fk_ticket_organization_user1_idx` (`org_uid` ASC),
  CONSTRAINT `fk_ticket_organization_user1`
    FOREIGN KEY (`org_uid`)
    REFERENCES `etuan`.`organization_user` (`org_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etuan`.`ticket_arrange`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etuan`.`ticket_arrange` (
  `ticket_id` INT NOT NULL,
  `arrange_id` INT NOT NULL,
  `start_time` DATETIME NOT NULL,
  `ticket_total` INT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`ticket_id`, `arrange_id`),
  INDEX `fk_ticket_arrange_ticket1_idx` (`ticket_id` ASC),
  CONSTRAINT `fk_ticket_arrange_ticket1`
    FOREIGN KEY (`ticket_id`)
    REFERENCES `etuan`.`ticket` (`ticket_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etuan`.`ticket_result`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etuan`.`ticket_result` (
  `wx_uid` VARCHAR(50) NOT NULL,
  `ticket_id` INT NOT NULL,
  `verify_info` VARCHAR(45) NULL,
  `ip` VARCHAR(50) NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`wx_uid`, `ticket_id`),
  INDEX `fk_ticket_result_wx_user1_idx` (`wx_uid` ASC),
  CONSTRAINT `fk_ticket_result_ticket1`
    FOREIGN KEY (`ticket_id`)
    REFERENCES `etuan`.`ticket` (`ticket_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ticket_result_wx_user1`
    FOREIGN KEY (`wx_uid`)
    REFERENCES `etuan`.`wx_user` (`wx_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etuan`.`mp_msg_text`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etuan`.`mp_msg_text` (
  `text_id` INT NOT NULL,
  `content` VARCHAR(250) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`text_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etuan`.`mp_msg_news`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etuan`.`mp_msg_news` (
  `news_id` INT NOT NULL,
  `articles_id` INT NOT NULL,
  `title` VARCHAR(45) NULL,
  `description` VARCHAR(45) NULL,
  `pic_url` VARCHAR(45) NULL,
  `url` VARCHAR(45) NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`news_id`, `articles_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etuan`.`mp_qr_etuan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etuan`.`mp_qr_etuan` (
  `scene_id` INT NOT NULL,
  `act_type` ENUM('reg','vote','ticket') NULL,
  `act_id` INT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`scene_id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
