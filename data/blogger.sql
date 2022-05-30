-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema blogger
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `blogger` ;

-- -----------------------------------------------------
-- Schema blogger
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `blogger` DEFAULT CHARACTER SET utf8 ;
USE `blogger` ;

-- -----------------------------------------------------
-- Table `blogger`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `blogger`.`user` ;

CREATE TABLE IF NOT EXISTS `blogger`.`user` (
  `user_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(20) NOT NULL,
  `email` VARCHAR(120) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `firstname` VARCHAR(80) NOT NULL,
  `lastname` VARCHAR(80) NOT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `blogger`.`article`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `blogger`.`article` ;

CREATE TABLE IF NOT EXISTS `blogger`.`article` (
  `article_id` INT UNSIGNED NOT NULL,
  `user_id` INT UNSIGNED NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `teaser` VARCHAR(255) NOT NULL,
  `content` TEXT NOT NULL,
  `status` TINYINT NOT NULL DEFAULT 1,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL,
  PRIMARY KEY (`article_id`),
  INDEX `fk_article_user_idx` (`user_id` ASC),
  CONSTRAINT `fk_article_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `blogger`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `blogger`.`category`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `blogger`.`category` ;

CREATE TABLE IF NOT EXISTS `blogger`.`category` (
  `category_id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`category_id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `blogger`.`article_has_category`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `blogger`.`article_has_category` ;

CREATE TABLE IF NOT EXISTS `blogger`.`article_has_category` (
  `article_id` INT UNSIGNED NOT NULL,
  `category_id` SMALLINT UNSIGNED NOT NULL,
  PRIMARY KEY (`article_id`, `category_id`),
  INDEX `fk_article_has_category_category1_idx` (`category_id` ASC),
  INDEX `fk_article_has_category_article1_idx` (`article_id` ASC),
  CONSTRAINT `fk_article_has_category_article1`
    FOREIGN KEY (`article_id`)
    REFERENCES `blogger`.`article` (`article_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_article_has_category_category1`
    FOREIGN KEY (`category_id`)
    REFERENCES `blogger`.`category` (`category_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `blogger`.`comment`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `blogger`.`comment` ;

CREATE TABLE IF NOT EXISTS `blogger`.`comment` (
  `comment_id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `article_id` INT UNSIGNED NOT NULL,
  `user_id` INT UNSIGNED NOT NULL,
  `content` TEXT NOT NULL,
  `is_activated` TINYINT NOT NULL DEFAULT 1,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL,
  PRIMARY KEY (`comment_id`),
  INDEX `fk_comment_article1_idx` (`article_id` ASC),
  INDEX `fk_comment_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_comment_article1`
    FOREIGN KEY (`article_id`)
    REFERENCES `blogger`.`article` (`article_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comment_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `blogger`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `blogger`.`user`
-- -----------------------------------------------------
START TRANSACTION;
USE `blogger`;
INSERT INTO `blogger`.`user` (`user_id`, `username`, `email`, `password`, `firstname`, `lastname`, `created_at`, `updated_at`) VALUES (1, 'stan', 'stan@gmail.com', '$2y$10$cvxefA/yNPF74ffxtd/ilOkz5.qrzCf8BkI6bjWyQJMzJJBFbnEm6', 'stan', 'smith', DEFAULT, NULL);
INSERT INTO `blogger`.`user` (`user_id`, `username`, `email`, `password`, `firstname`, `lastname`, `created_at`, `updated_at`) VALUES (2, 'roger', 'roger@gmail.com', '$2y$10$L0CYLNwcvzmer//pbELX1.8Ch8Cu5sW.x3FNRMeRfyLFxnr/KYh.y', 'roger', 'smith', DEFAULT, NULL);
INSERT INTO `blogger`.`user` (`user_id`, `username`, `email`, `password`, `firstname`, `lastname`, `created_at`, `updated_at`) VALUES (3, 'steve', 'steve@gmail.com', '$2y$10$NLssEX3aT9kGWonWLlLiYuUymlM2iYqFsMsCOAlRDKUpHxxkih9RS', 'steve', 'smith', DEFAULT, NULL);
INSERT INTO `blogger`.`user` (`user_id`, `username`, `email`, `password`, `firstname`, `lastname`, `created_at`, `updated_at`) VALUES (4, 'john', 'john@gmail.com', '$2y$10$neQsEsC2aqbPgc5uDm9BBu11NZBdS5pg7XidgR.xElHATq6sKXuDi', 'john', 'doe', DEFAULT, NULL);

COMMIT;


-- -----------------------------------------------------
-- Data for table `blogger`.`article`
-- -----------------------------------------------------
START TRANSACTION;
USE `blogger`;
INSERT INTO `blogger`.`article` (`article_id`, `user_id`, `title`, `teaser`, `content`, `status`, `created_at`, `updated_at`) VALUES (1, 2, 'Lorem Ipsum sparadra', 'Cras in nibh vehicula, mattis leo et, malesuada lacus. Sed dictum sem et ipsum vehicula, quis tristique arcu commodo. Praesent eu ante lectus.', 'Cras in nibh vehicula, mattis leo et, malesuada lacus. Sed dictum sem et ipsum vehicula, quis tristique arcu commodo. Praesent eu ante lectus. Pellentesque gravida malesuada eros eu vulputate. Donec facilisis viverra nibh vel pellentesque. Vestibulum porta nunc nec elit lobortis tempus. Fusce bibendum tempus ipsum, eu dapibus lectus malesuada vel. Donec maximus nisl at ante lacinia, non sollicitudin nunc pellentesque. ', 1, '2017-06-13 14:56:32', '2018-06-13 14:56:32');
INSERT INTO `blogger`.`article` (`article_id`, `user_id`, `title`, `teaser`, `content`, `status`, `created_at`, `updated_at`) VALUES (2, 2, 'Pellentesque tempor urna', 'Phasellus elit quam, laoreet porta auctor quis, venenatis vitae lorem.', 'Phasellus elit quam, laoreet porta auctor quis, venenatis vitae lorem. Nullam nec sem id elit vulputate tempor. Morbi nec interdum quam. Donec convallis tortor id lacinia posuere. Pellentesque vel orci nec augue efficitur ornare eget at mi. Praesent vulputate ac orci quis rhoncus. Aliquam vel est ut lorem vehicula placerat id at nibh. Etiam vitae cursus enim, quis varius arcu. Cras a sapien posuere massa blandit volutpat. Phasellus ullamcorper suscipit aliquet. Duis molestie tempus lobortis. Phasellus gravida maximus ex, suscipit iaculis quam tincidunt in. Sed ac consequat quam, eu viverra purus. Vivamus justo erat, auctor vel rhoncus et, elementum cursus est. In egestas faucibus velit, non commodo ex vehicula eu. Etiam pulvinar dictum libero, vel sagittis neque aliquet at. ', 1, '2016-08-23 05:06:00', '2017-08-23 05:06:00');
INSERT INTO `blogger`.`article` (`article_id`, `user_id`, `title`, `teaser`, `content`, `status`, `created_at`, `updated_at`) VALUES (3, 3, 'In hac habitasse platea dictumst. Vivamus posuere dolor id malesuada tincidunt', 'In hac habitasse platea dictumst', 'Proin tempor at magna et tempor. In at turpis sit amet nisi maximus tincidunt. Suspendisse lacus purus, maximus nec dictum non, malesuada et diam. Quisque fringilla nec massa at gravida. Duis vel congue diam. Nullam dapibus mollis massa eget ultrices. Cras dapibus nunc in augue vulputate, nec commodo lorem vulputate. Morbi pretium, quam non rhoncus scelerisque, eros nunc congue tortor, egestas lacinia odio ante eget est. In id eros ac ipsum vehicula tincidunt eu id dui. Morbi luctus libero orci, a semper ante accumsan eget. Etiam varius volutpat eros. Pellentesque ac neque sed lectus vehicula tincidunt a imperdiet nisl. Nunc lacinia orci nec neque ornare, sed dictum neque venenatis. Sed interdum porta lectus id mattis. Ut euismod mi ultrices lorem ullamcorper efficitur. ', 1, '2014-12-13 23:58:32', '2015-06-12 14:56:32');
INSERT INTO `blogger`.`article` (`article_id`, `user_id`, `title`, `teaser`, `content`, `status`, `created_at`, `updated_at`) VALUES (4, 3, 'Aliquam erat volutpat. Ut vehicula hendrerit tincidunt', 'Pellentesque tempor urna eget interdum auctor', 'Fusce aliquam molestie ipsum nec finibus. Curabitur quam libero, varius sit amet ultricies vel, pharetra ac nisi. Curabitur blandit consequat erat ac porttitor. Etiam rhoncus accumsan leo, at egestas est efficitur eget. Fusce at luctus nisi. Sed auctor, mauris sed rhoncus fermentum, arcu nisi iaculis magna, a tempus nisi nunc id lacus. Ut dapibus rhoncus varius. Pellentesque ullamcorper nisl et nibh interdum, eget eleifend felis varius. Sed sit amet semper turpis. Nulla ultricies nulla elit. ', 0, '2018-08-13 22:56:32', '2018-08-15 22:56:32');
INSERT INTO `blogger`.`article` (`article_id`, `user_id`, `title`, `teaser`, `content`, `status`, `created_at`, `updated_at`) VALUES (5, 1, 'Ut mi nisi, imperdiet quis quam suscipit, imperdiet sollicitudin tellus', 'Phasellus elit quam, laoreet porta auctor quis, venenatis vitae lorem', 'In hac habitasse platea dictumst. Vivamus posuere dolor id malesuada tincidunt. Nunc ut odio erat. Quisque et enim quis urna semper sollicitudin a nec arcu. Cras bibendum libero sit amet eleifend interdum. Sed et interdum diam. Nulla velit ante, rutrum id varius id, egestas nec ligula. Nunc sit amet convallis orci, sed imperdiet elit. Vestibulum aliquet lobortis mi, eget dictum leo gravida at. In nec viverra nisi. Aenean eleifend vestibulum metus nec finibus. Mauris sed odio elementum purus iaculis laoreet non id libero. ', 0, '2012-06-13 21:56:32', '2012-09-13 21:56:32');

COMMIT;


-- -----------------------------------------------------
-- Data for table `blogger`.`category`
-- -----------------------------------------------------
START TRANSACTION;
USE `blogger`;
INSERT INTO `blogger`.`category` (`category_id`, `name`) VALUES (1, 'PHP');
INSERT INTO `blogger`.`category` (`category_id`, `name`) VALUES (2, 'Javascript');
INSERT INTO `blogger`.`category` (`category_id`, `name`) VALUES (3, 'Go');
INSERT INTO `blogger`.`category` (`category_id`, `name`) VALUES (4, 'Ruby');
INSERT INTO `blogger`.`category` (`category_id`, `name`) VALUES (5, 'Angular');
INSERT INTO `blogger`.`category` (`category_id`, `name`) VALUES (6, 'React');
INSERT INTO `blogger`.`category` (`category_id`, `name`) VALUES (7, 'MongoDB');

COMMIT;


-- -----------------------------------------------------
-- Data for table `blogger`.`article_has_category`
-- -----------------------------------------------------
START TRANSACTION;
USE `blogger`;
INSERT INTO `blogger`.`article_has_category` (`article_id`, `category_id`) VALUES (2, 5);
INSERT INTO `blogger`.`article_has_category` (`article_id`, `category_id`) VALUES (2, 2);
INSERT INTO `blogger`.`article_has_category` (`article_id`, `category_id`) VALUES (1, 6);
INSERT INTO `blogger`.`article_has_category` (`article_id`, `category_id`) VALUES (1, 3);
INSERT INTO `blogger`.`article_has_category` (`article_id`, `category_id`) VALUES (4, 2);
INSERT INTO `blogger`.`article_has_category` (`article_id`, `category_id`) VALUES (5, 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `blogger`.`comment`
-- -----------------------------------------------------
START TRANSACTION;
USE `blogger`;
INSERT INTO `blogger`.`comment` (`comment_id`, `article_id`, `user_id`, `content`, `is_activated`, `created_at`, `updated_at`) VALUES (1, 2, 2, 'Blah blah blah', 1, '2018-12-04 00:12:36', '2018-12-04 00:12:36');
INSERT INTO `blogger`.`comment` (`comment_id`, `article_id`, `user_id`, `content`, `is_activated`, `created_at`, `updated_at`) VALUES (2, 2, 1, 'Je suis pas content', 1, '2018-12-04 14:12:36', '2018-12-04 00:12:36');
INSERT INTO `blogger`.`comment` (`comment_id`, `article_id`, `user_id`, `content`, `is_activated`, `created_at`, `updated_at`) VALUES (3, 2, 2, 'Super article j\'ai adoré le passage où tu parles de Go', 1, '2018-12-04 13:12:36', '2018-12-04 00:12:36');
INSERT INTO `blogger`.`comment` (`comment_id`, `article_id`, `user_id`, `content`, `is_activated`, `created_at`, `updated_at`) VALUES (4, 1, 3, 'React c\'est le top', 1, '2018-12-05 00:12:36', '2018-12-04 00:12:36');
INSERT INTO `blogger`.`comment` (`comment_id`, `article_id`, `user_id`, `content`, `is_activated`, `created_at`, `updated_at`) VALUES (5, 5, 4, 'Java ça craint', 0, '2018-12-04 00:12:36', '2018-12-04 00:12:36');
INSERT INTO `blogger`.`comment` (`comment_id`, `article_id`, `user_id`, `content`, `is_activated`, `created_at`, `updated_at`) VALUES (6, 3, 3, 'Javascript n\'est pas un langage mais une abération', 0, '2018-12-04 12:12:36', '2018-12-04 00:12:36');

COMMIT;

