-- MySQL Script generated by MySQL Workbench
-- 09/09/14 19:01:29
-- Model: New Model    Version: 1.0
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema etuan
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `etuan` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `etuan` ;

-- -----------------------------------------------------
-- Table `etuan`.`organization_user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etuan`.`organization_user` (
  `org_uid` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(80) NOT NULL,
  `password` VARCHAR(60) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `phone_long` VARCHAR(15) NOT NULL,
  `phone_short` INT NULL,
  `user_group` ENUM('root','org') NOT NULL,
  `updated_at` TIMESTAMP NULL,
  `remember_token` VARCHAR(60) NULL,
  `login_token` BLOB NULL,
  PRIMARY KEY (`org_uid`, `phone_long`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC));


-- -----------------------------------------------------
-- Table `etuan`.`organization`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etuan`.`organization` (
  `org_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(30) NOT NULL,
  `type` ENUM('校级组织','院级组织','校级社团','院级社团') NOT NULL,
  `school` ENUM('全校','机械工程学院','电子信息学院','通信工程学院','自动化学院','计算机学院','生命信息与仪器工程学院','材料与环境工程学院','软件工程学院','理学院','经济学院','管理学院','会计学院','外国语学院','数字媒体与艺术设计学院','人文与法学院','马克思主义学院','卓越学院','信息工程学院','国际教育学院','继续教育学院') NOT NULL,
  `logo_url` VARCHAR(100) NULL,
  `internal_order` INT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  `org_uid` INT NOT NULL,
  `description` VARCHAR(200) NULL,
  `pic_url1` VARCHAR(200) NULL,
  `pic_url2` VARCHAR(200) NULL,
  `pic_url3` VARCHAR(200) NULL,
  `wx` VARCHAR(20) NULL,
  `hidden` INT NULL,
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
  `description` VARCHAR(80) NOT NULL,
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
  `stu_id` INT NULL,
  `stu_name` VARCHAR(45) NULL,
  PRIMARY KEY (`wx_uid`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etuan`.`registration`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etuan`.`registration` (
  `reg_id` INT NOT NULL AUTO_INCREMENT,
  `start_time` DATETIME NOT NULL,
  `stop_time` DATETIME NOT NULL,
  `limit_grade` VARCHAR(5) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `theme` INT NOT NULL,
  `page_view` INT NULL DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  `org_uid` INT NOT NULL,
  `hidden` INT NULL DEFAULT 0,
  PRIMARY KEY (`reg_id`, `stop_time`),
  INDEX `fk_Registration_organization_user1_idx` (`org_uid` ASC),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC),
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
  `content` VARCHAR(250) NULL,
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
  `reg_id` INT NOT NULL,
  `question_id` INT NOT NULL,
  `answer` VARCHAR(1000) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`reg_serial`, `reg_id`, `question_id`),
  INDEX `fk_reg_result_reg_question1_idx` (`question_id` ASC),
  INDEX `fk_reg_result_Registration_user1_idx` (`reg_serial` ASC),
  INDEX `fk_reg_result_registration1_idx` (`reg_id` ASC),
  CONSTRAINT `fk_reg_result_reg_question1`
    FOREIGN KEY (`question_id`)
    REFERENCES `etuan`.`reg_question` (`question_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_reg_result_Registration_user1`
    FOREIGN KEY (`reg_serial`)
    REFERENCES `etuan`.`registration_user` (`reg_serial`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_reg_result_registration1`
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
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  `org_uid` INT NOT NULL,
  PRIMARY KEY (`vote_id`),
  INDEX `fk_vote_organization_user1_idx` (`org_uid` ASC),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC),
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
  `description` VARCHAR(250) NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  `org_uid` INT NOT NULL,
  PRIMARY KEY (`lottery_id`),
  INDEX `fk_lottery_organization_user1_idx` (`org_uid` ASC),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC),
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
  `lottery_item_id` INT NULL,
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
  `mp_id` INT NOT NULL AUTO_INCREMENT,
  `mp_origin_id` VARCHAR(45) NULL,
  `interface_url` VARCHAR(200) NULL,
  `interface_token` CHAR(32) NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  `org_uid` INT NOT NULL,
  `appid` VARCHAR(45) NULL,
  `appsecret` VARCHAR(50) NULL,
  `redirect_uri` VARCHAR(150) NULL,
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
  `mp_reply_id` INT NOT NULL AUTO_INCREMENT,
  `msg_type` ENUM('text','news') NULL,
  `msg_id` INT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  `mp_id` INT NOT NULL,
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
  `name` VARCHAR(20) NOT NULL,
  `arrange` INT NOT NULL,
  `start_time` DATETIME NULL,
  `logo` VARCHAR(60) NOT NULL,
  `theme` INT NOT NULL,
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
  `text_id` INT NOT NULL AUTO_INCREMENT,
  `content` VARCHAR(601) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`text_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etuan`.`mp_msg_news`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etuan`.`mp_msg_news` (
  `news_id` INT NOT NULL AUTO_INCREMENT,
  `article_id` INT NOT NULL,
  `title` VARCHAR(45) NULL,
  `description` VARCHAR(100) NULL,
  `pic_url` VARCHAR(250) NULL,
  `url` VARCHAR(250) NULL,
  `news_from` ENUM('registration','vote','lottery','ticket','sucai','url') NULL,
  `act_id` INT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  `mp_id` INT NOT NULL,
  PRIMARY KEY (`news_id`, `article_id`),
  INDEX `fk_mp_msg_news_mp_weixin1_idx` (`mp_id` ASC),
  CONSTRAINT `fk_mp_msg_news_mp_weixin1`
    FOREIGN KEY (`mp_id`)
    REFERENCES `etuan`.`mp_weixin` (`mp_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etuan`.`mp_qr_etuan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etuan`.`mp_qr_etuan` (
  `scene_id` INT NOT NULL AUTO_INCREMENT,
  `act_type` ENUM('registration','vote','ticket','lottery') NULL,
  `act_id` INT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`scene_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etuan`.`mp_keyword`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etuan`.`mp_keyword` (
  `mp_id` INT NOT NULL,
  `keyword` VARCHAR(45) NOT NULL,
  `mp_reply_id` INT NOT NULL,
  PRIMARY KEY (`mp_id`, `keyword`),
  INDEX `fk_mp_keyword_mp_auto_reply1_idx` (`mp_reply_id` ASC),
  INDEX `fk_mp_keyword_mp_weixin1_idx` (`mp_id` ASC),
  CONSTRAINT `fk_mp_keyword_mp_auto_reply1`
    FOREIGN KEY (`mp_reply_id`)
    REFERENCES `etuan`.`mp_auto_reply` (`mp_reply_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_mp_keyword_mp_weixin1`
    FOREIGN KEY (`mp_id`)
    REFERENCES `etuan`.`mp_weixin` (`mp_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etuan`.`mp_news_content`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etuan`.`mp_news_content` (
  `news_id` INT NOT NULL,
  `article_id` INT NOT NULL,
  `content` TEXT NULL,
  PRIMARY KEY (`news_id`, `article_id`),
  INDEX `fk_mp_news_content_mp_msg_news1_idx` (`news_id` ASC, `article_id` ASC),
  CONSTRAINT `fk_mp_news_content_mp_msg_news1`
    FOREIGN KEY (`news_id` , `article_id`)
    REFERENCES `etuan`.`mp_msg_news` (`news_id` , `article_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etuan`.`notice`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etuan`.`notice` (
  `notice_id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(60) NOT NULL,
  `content` TEXT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`notice_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etuan`.`message`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etuan`.`message` (
  `msg_id` INT NOT NULL,
  `from_org_uid` INT NOT NULL,
  `to_org_uid` INT NOT NULL,
  `tittle` VARCHAR(45) NULL,
  `content` VARCHAR(500) NULL,
  `mark_read` TINYINT(1) NULL,
  `created_at` TIMESTAMP NULL DEFAULT current_timestamp,
  PRIMARY KEY (`msg_id`),
  INDEX `fk_message_organization_user1_idx` (`from_org_uid` ASC),
  INDEX `fk_message_organization_user2_idx` (`to_org_uid` ASC),
  CONSTRAINT `fk_message_organization_user1`
    FOREIGN KEY (`from_org_uid`)
    REFERENCES `etuan`.`organization_user` (`org_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_message_organization_user2`
    FOREIGN KEY (`to_org_uid`)
    REFERENCES `etuan`.`organization_user` (`org_uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etuan`.`mp_click_event`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etuan`.`mp_click_event` (
  `key` VARCHAR(45) NOT NULL,
  `mp_id` INT NOT NULL,
  `mp_reply_id` INT NOT NULL,
  PRIMARY KEY (`key`, `mp_id`),
  INDEX `fk_mp_click_event_mp_weixin1_idx` (`mp_id` ASC),
  INDEX `fk_mp_click_event_mp_auto_reply1_idx` (`mp_reply_id` ASC),
  CONSTRAINT `fk_mp_click_event_mp_weixin1`
    FOREIGN KEY (`mp_id`)
    REFERENCES `etuan`.`mp_weixin` (`mp_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_mp_click_event_mp_auto_reply1`
    FOREIGN KEY (`mp_reply_id`)
    REFERENCES `etuan`.`mp_auto_reply` (`mp_reply_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
