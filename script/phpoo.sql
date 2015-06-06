-- criando banco de dados phpoo
CREATE DATABASE phpoo;

-- entrando no banco de dados
USE phpoo;

-- criando tabela cliente
CREATE TABLE cliente(
cliente_id             INT             NOT NULL      PRIMARY KEY        AUTO_INCREMENT,
cliente_nome           VARCHAR(80)     NOT NULL,
cliente_email          VARCHAR(140)    NOT NULL
)Engine = InnoDB; 