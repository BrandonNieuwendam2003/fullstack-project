-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
-- -----------------------------------------------------
-- Schema new_schema1
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema new_schema2
-- -----------------------------------------------------
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`bands`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`bands` (
  `idbands` INT NOT NULL,
  `BandNaam` VARCHAR(45) NOT NULL,
  `genre` VARCHAR(45) NOT NULL,
  `Herkomst` VARCHAR(45) NOT NULL,
  `KorteOmschrijving` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idbands`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`MuziekAvond`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`MuziekAvond` (
  `idAvondInfo` INT NOT NULL,
  `BandAantal` VARCHAR(45) NOT NULL,
  `AanvangTijd` VARCHAR(45) NOT NULL,
  `HoofdActsAantal` VARCHAR(45) NOT NULL,
  `SupportActsAantal` VARCHAR(45) NOT NULL,
  `BezoekersAantal` VARCHAR(45) NULL,
  `DrankOmzet` VARCHAR(45) NULL,
  `EntreeOmzet` VARCHAR(45) NULL,
  PRIMARY KEY (`idAvondInfo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`bandLeden`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`bandLeden` (
  `idbandLeden` INT NOT NULL,
  `WelkeBand` VARCHAR(45) NOT NULL,
  `Email` VARCHAR(45) NOT NULL,
  `telefoonNummer` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idbandLeden`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`bezoekers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`bezoekers` (
  `idbezoekers` INT NOT NULL,
  `Postcode` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idbezoekers`))
ENGINE = InnoDB;

USE `mydb` ;

-- -----------------------------------------------------
-- Placeholder table for view `mydb`.`view1`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`view1` (`id` INT);

-- -----------------------------------------------------
-- View `mydb`.`view1`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`view1`;
USE `mydb`;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
