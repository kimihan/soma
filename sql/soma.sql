-- MySQL Script generated by MySQL Workbench
-- Sat May 16 12:34:51 2020
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema soma
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema soma
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `soma` DEFAULT CHARACTER SET utf8 ;
USE `soma` ;

-- -----------------------------------------------------
-- Table `soma`.`Endereco`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `soma`.`Endereco` (
  `idEndereco` INT NOT NULL AUTO_INCREMENT,
  `numCep` INT(11) NOT NULL,
  `descLogradouro` VARCHAR(45) NOT NULL,
  `numLocal` VARCHAR(45) NOT NULL,
  `descComplemento` VARCHAR(45) NULL,
  `descBairro` VARCHAR(45) NULL,
  `descCidade` VARCHAR(45) NULL,
  `siglaUf` VARCHAR(2) NULL,
  PRIMARY KEY (`idEndereco`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `soma`.`Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `soma`.`Usuario` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT,
  `descNome` VARCHAR(100) NOT NULL COMMENT 'Nome completo',
  `descEmail` VARCHAR(80) NOT NULL COMMENT 'Email de contato',
  `descSenha` VARCHAR(45) NULL,
  `descRg` VARCHAR(20) NULL COMMENT 'Registro Geral',
  `dataNascimento` DATE NULL COMMENT 'Data de nascimento',
  `flgSexo` VARCHAR(1) NULL DEFAULT 'M' COMMENT 'F -  Feminino\nM - Masculino',
  `flgTipoPessoa` VARCHAR(1) NULL DEFAULT 'F' COMMENT 'F - Física\nJ - Jurídica',
  `numCpf` INT(13) NOT NULL COMMENT 'CPF (sem formatação)',
  `numTelefone` INT(15) NULL COMMENT 'Telefone fixo (sem formatação)',
  `numWhatsapp` INT(15) NULL COMMENT 'Telefone Whatsapp (sem formatação)',
  `Endereco_idEndereco` INT NOT NULL,
  PRIMARY KEY (`idUsuario`),
  CONSTRAINT `fk_Usuario_Endereco`
    FOREIGN KEY (`Endereco_idEndereco`)
    REFERENCES `soma`.`Endereco` (`idEndereco`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Usuario_Endereco_idx` ON `soma`.`Usuario` (`Endereco_idEndereco` ASC);


-- -----------------------------------------------------
-- Table `soma`.`Vendedor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `soma`.`Vendedor` (
  `idVendedor` INT NOT NULL AUTO_INCREMENT,
  `dataCadastro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `flgBanca` TINYINT(1) NOT NULL DEFAULT '1' COMMENT '0 - Não é banca\n1 - É banca',
  `Usuario_idUsuario` INT NOT NULL,
  PRIMARY KEY (`idVendedor`),
  CONSTRAINT `fk_Cliente_Usuario1`
    FOREIGN KEY (`Usuario_idUsuario`)
    REFERENCES `soma`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Cliente_Usuario1_idx` ON `soma`.`Vendedor` (`Usuario_idUsuario` ASC);


-- -----------------------------------------------------
-- Table `soma`.`Cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `soma`.`Cliente` (
  `idCliente` INT NOT NULL AUTO_INCREMENT,
  `dataCadastro` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `flgLigacao` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '0 - Sem ligação\n1 - Realizar ligação',
  `descPagseguroId` VARCHAR(60) NULL,
  `flgFormaPagamento` TINYINT(1) NOT NULL DEFAULT '2' COMMENT '1 - Pagseguro\n2 - Boleto Paghiper',
  `flgPeriodicidadePagamento` TINYINT(1) NOT NULL DEFAULT '1' COMMENT '1 - Mensal\n2 - Anual',
  `Usuario_idUsuario` INT NOT NULL,
  PRIMARY KEY (`idCliente`),
  CONSTRAINT `fk_Cliente_Usuario10`
    FOREIGN KEY (`Usuario_idUsuario`)
    REFERENCES `soma`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Cliente_Usuario1_idx` ON `soma`.`Cliente` (`Usuario_idUsuario` ASC);


-- -----------------------------------------------------
-- Table `soma`.`Produto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `soma`.`Produto` (
  `idProduto` INT NOT NULL AUTO_INCREMENT,
  `descNome` VARCHAR(60) NOT NULL COMMENT 'Nome do produto',
  `descCoberturas` TEXT NULL COMMENT 'Coberturas do produto',
  `flgAplicativo` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '0 - Não exibe no aplicativo\n1 - Exibe no aplicativo\n',
  PRIMARY KEY (`idProduto`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `soma`.`ProdutoVendedor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `soma`.`ProdutoVendedor` (
  `Produto_idProduto` INT NOT NULL,
  `Vendedor_idVendedor` INT NOT NULL,
  `vrPreco` FLOAT NOT NULL COMMENT 'Preço de venda do produto para o vendedor',
  PRIMARY KEY (`Produto_idProduto`, `Vendedor_idVendedor`),
  CONSTRAINT `fk_Produto_has_Vendedor_Produto1`
    FOREIGN KEY (`Produto_idProduto`)
    REFERENCES `soma`.`Produto` (`idProduto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Produto_has_Vendedor_Vendedor1`
    FOREIGN KEY (`Vendedor_idVendedor`)
    REFERENCES `soma`.`Vendedor` (`idVendedor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Produto_has_Vendedor_Vendedor1_idx` ON `soma`.`ProdutoVendedor` (`Vendedor_idVendedor` ASC);

CREATE INDEX `fk_Produto_has_Vendedor_Produto1_idx` ON `soma`.`ProdutoVendedor` (`Produto_idProduto` ASC);


-- -----------------------------------------------------
-- Table `soma`.`Servico`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `soma`.`Servico` (
  `idServico` INT NOT NULL AUTO_INCREMENT,
  `dataVenda` DATE NULL,
  `dataVencimento` DATE NULL,
  `vrPreco` FLOAT NOT NULL COMMENT 'Valor da venda',
  `Produto_idProduto` INT NOT NULL,
  `Cliente_idCliente` INT NOT NULL,
  PRIMARY KEY (`idServico`),
  CONSTRAINT `fk_Venda_Produto1`
    FOREIGN KEY (`Produto_idProduto`)
    REFERENCES `soma`.`Produto` (`idProduto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Venda_Cliente1`
    FOREIGN KEY (`Cliente_idCliente`)
    REFERENCES `soma`.`Cliente` (`idCliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Venda_Produto1_idx` ON `soma`.`Servico` (`Produto_idProduto` ASC);

CREATE INDEX `fk_Venda_Cliente1_idx` ON `soma`.`Servico` (`Cliente_idCliente` ASC);


-- -----------------------------------------------------
-- Table `soma`.`VendaVendedor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `soma`.`VendaVendedor` (
  `Venda_idVenda` INT NOT NULL,
  `Vendedor_idVendedor` INT NOT NULL,
  `numComissao` INT NOT NULL DEFAULT '0' COMMENT 'Comissao da venda em %',
  PRIMARY KEY (`Venda_idVenda`, `Vendedor_idVendedor`),
  CONSTRAINT `fk_Venda_has_Vendedor_Venda1`
    FOREIGN KEY (`Venda_idVenda`)
    REFERENCES `soma`.`Servico` (`idServico`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Venda_has_Vendedor_Vendedor1`
    FOREIGN KEY (`Vendedor_idVendedor`)
    REFERENCES `soma`.`Vendedor` (`idVendedor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Venda_has_Vendedor_Vendedor1_idx` ON `soma`.`VendaVendedor` (`Vendedor_idVendedor` ASC);

CREATE INDEX `fk_Venda_has_Vendedor_Venda1_idx` ON `soma`.`VendaVendedor` (`Venda_idVenda` ASC);


-- -----------------------------------------------------
-- Table `soma`.`Cobranca`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `soma`.`Cobranca` (
  `idCobranca` INT NOT NULL AUTO_INCREMENT,
  `dataGerado` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dataPagamento` DATE NULL,
  `dataVencimento` DATE NOT NULL,
  `vrPreco` FLOAT NOT NULL,
  `flgPago` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '0 -À pagar\n1 - Pago',
  `Cliente_idCliente` INT NOT NULL,
  `Servico_idServico` INT NOT NULL,
  PRIMARY KEY (`idCobranca`),
  CONSTRAINT `fk_Cobranca_Cliente1`
    FOREIGN KEY (`Cliente_idCliente`)
    REFERENCES `soma`.`Cliente` (`idCliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cobranca_Servico1`
    FOREIGN KEY (`Servico_idServico`)
    REFERENCES `soma`.`Servico` (`idServico`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Cobranca_Cliente1_idx` ON `soma`.`Cobranca` (`Cliente_idCliente` ASC);

CREATE INDEX `fk_Cobranca_Servico1_idx` ON `soma`.`Cobranca` (`Servico_idServico` ASC);


-- -----------------------------------------------------
-- Table `soma`.`Comissao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `soma`.`Comissao` (
  `idComissao` INT NOT NULL AUTO_INCREMENT,
  `dataGerado` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `vrComissao` FLOAT NOT NULL COMMENT 'Valor da comissão',
  `flgPago` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '0 - Não\n1 - Sim',
  `Vendedor_idVendedor` INT NOT NULL,
  `Servico_idServico` INT NOT NULL,
  PRIMARY KEY (`idComissao`),
  CONSTRAINT `fk_Comissao_Vendedor1`
    FOREIGN KEY (`Vendedor_idVendedor`)
    REFERENCES `soma`.`Vendedor` (`idVendedor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Comissao_Servico1`
    FOREIGN KEY (`Servico_idServico`)
    REFERENCES `soma`.`Servico` (`idServico`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Comissao_Vendedor1_idx` ON `soma`.`Comissao` (`Vendedor_idVendedor` ASC);

CREATE INDEX `fk_Comissao_Servico1_idx` ON `soma`.`Comissao` (`Servico_idServico` ASC);


-- -----------------------------------------------------
-- Table `soma`.`Boleto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `soma`.`Boleto` (
  `idBoleto` INT NOT NULL AUTO_INCREMENT,
  `dataGerado` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dataVencimento` DATE NOT NULL,
  `flgCancelado` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '0 - Ativo\n1 - Cancelado',
  `Cobranca_idCobranca` INT NOT NULL,
  PRIMARY KEY (`idBoleto`),
  CONSTRAINT `fk_Boleto_Cobranca1`
    FOREIGN KEY (`Cobranca_idCobranca`)
    REFERENCES `soma`.`Cobranca` (`idCobranca`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Boleto_Cobranca1_idx` ON `soma`.`Boleto` (`Cobranca_idCobranca` ASC);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;



ALTER TABLE `ProdutoVendedor` ADD `vrComissao` FLOAT NULL COMMENT 'Comissao do vendedor ao vender o produto';


ALTER TABLE Usuario
ADD CONSTRAINT uc_Email UNIQUE (descEmail)

ALTER TABLE `ProdutoVendedor` ADD `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`id`);
/*
tabela "ProdutoVendedor" removi a chave primaria da coluna "Produto_idProduto"*/