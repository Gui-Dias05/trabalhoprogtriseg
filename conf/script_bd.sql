-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema trabalho
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema trabalho
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `trabalho` DEFAULT CHARACTER SET utf8 ;
USE `trabalho` ;

-- -----------------------------------------------------
-- Table `trabalho`.`tabuleiro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `trabalho`.`tabuleiro` (
  `idtabuleiro` INT NOT NULL AUTO_INCREMENT,
  `lado` INT NULL,
  PRIMARY KEY (`idtabuleiro`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `trabalho`.`quadrado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `trabalho`.`quadrado` (
  `idquadrado` INT NOT NULL AUTO_INCREMENT,
  `lado` INT NULL,
  `cor` VARCHAR(45) NULL,
  `tabuleiro_idtabuleiro` INT NULL,
  PRIMARY KEY (`idquadrado`),
  CONSTRAINT `fk_quadrado_tabuleiro`
    FOREIGN KEY (`tabuleiro_idtabuleiro`)
    REFERENCES `trabalho`.`tabuleiro` (`idtabuleiro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `trabalho`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `trabalho`.`usuario` (
  `idusuario` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(250) NULL,
  `user` VARCHAR(45) NULL,
  `senha` VARCHAR(250) NULL,
  PRIMARY KEY (`idusuario`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
