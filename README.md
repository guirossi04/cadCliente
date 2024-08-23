///////////////////////////////////// Tables //////////////////////////////////////

CREATE TABLE `cliente` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cpf` varchar(18) NOT NULL,
  `rg` varchar(45) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `apelido` varchar(45) DEFAULT NULL,
  `situacao` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `documento_UNIQUE` (`cpf`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


CREATE TABLE `contato` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cliente_id` int NOT NULL,
  `tipo_contato` varchar(10) NOT NULL,
  `contato` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_contato_cliente_idx` (`cliente_id`),
  CONSTRAINT `fk_contato_cliente` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `endereco` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cliente_id` int NOT NULL,
  `logradouro` varchar(45) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `complemento` varchar(45) DEFAULT NULL,
  `bairro` varchar(20) NOT NULL,
  `municipio` varchar(45) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `cep` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_endereco_cliente1_idx` (`cliente_id`),
  CONSTRAINT `fk_endereco_cliente1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


////////////////////////////////////////// View E Procedure ////////////////////////////////

 ---- Procedure ------

CREATE DEFINER=`root`@`localhost` PROCEDURE `novo_cliente`(
IN cpf varchar(18),
IN rg varchar(20),
IN nome varchar(50),
IN apelido varchar(45),
IN email varchar(50),
IN telefone int(11),
IN logradouro varchar(50),
IN numero varchar(15),
IN complemento varchar(30),
IN bairro varchar(20),
IN municipio varchar(30),
IN cep int(8),
IN uf varchar(2)
)
BEGIN
	DECLARE erro SMALLINT DEFAULT 0;
    DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET erro = 1;
    
    INSERT INTO cliente (cpf, rg, nome, apelido, situacao) VALUES (cpf, rg, nome, apelido, 1);
    
    IF erro = 1
    THEN
		SELECT "Erro ao cadastrar cliente" AS Msg;
        ROLLBACK;
	ELSE
		SET @id = (SELECT last_insert_id());
		
		INSERT INTO contato (cliente_id, tipo_contato, contato) VALUES (@id, 'email', email);
        IF erro = 1
        THEN
			SELECT "Erro ao cadastrar E-mail, operacao desfeita" AS Msg;
			ROLLBACK;
		END IF;
        
		INSERT INTO contato (cliente_id, tipo_contato, contato) VALUES (@id, 'telefone', telefone);
		IF erro = 1
        THEN
			SELECT "Erro ao cadastrar Telefone, operacao desfeita" AS Msg;
			ROLLBACK;
		END IF;
        
		INSERT INTO endereco (cliente_id, logradouro, numero, complemento, bairro, municipio, cep, estado) VALUES (@id, logradouro, numero, complemento, bairro, municipio, cep, uf);
		IF erro = 1
        THEN
        SELECT "Erro ao cadastrar Endereco, operacao desfeita" AS Msg;
			ROLLBACK;
		END IF;
        
		SELECT "Usuario criado com sucesso" AS Msg;
        COMMIT;
	END IF;
END


 ----------------- View ---------------------


 CREATE 
    ALGORITHM = UNDEFINED 
    DEFINER = `root`@`localhost` 
    SQL SECURITY DEFINER
VIEW `dados_cliente` AS
    SELECT 
        `cli`.`id` AS `id`,
        `cli`.`cpf` AS `cpf`,
        `cli`.`rg` AS `rg`,
        `cli`.`nome` AS `nome`,
        `cli`.`apelido` AS `apelido`,
        `cli`.`situacao` AS `situacao`,
        `mail`.`contato` AS `email`,
        `tel`.`contato` AS `telefone`,
        CONCAT(`en`.`logradouro`, ' - ', `en`.`numero`) AS `endereco`
    FROM
        (((`cliente` `cli`
        JOIN `contato` `mail` ON (((`cli`.`id` = `mail`.`cliente_id`)
            AND (`mail`.`tipo_contato` = 'email'))))
        JOIN `contato` `tel` ON (((`cli`.`id` = `tel`.`cliente_id`)
            AND (`tel`.`tipo_contato` = 'telefone'))))
        JOIN `endereco` `en` ON ((`cli`.`id` = `en`.`cliente_id`)))