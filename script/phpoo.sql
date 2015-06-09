-- criando banco de dados phpoo
CREATE DATABASE phpoo;

-- entrando no banco de dados
USE phpoo;

-- criando tabela cliente
CREATE TABLE cliente(
cliente_nome           VARCHAR(80)     NOT NULL,
cliente_email          VARCHAR(140)    NOT NULL,
cpf                    VARCHAR(11)     NOT NULL
)Engine = InnoDB; 

-- criando tabela produto
CREATE TABLE produto(
nome                   VARCHAR(80)     NOT NULL,
preco                  FLOAT           NOT NULL,
quantidade             INT             NOT NULL,
referencia             INT             NOT NULL
);

-- inserindo chave primaria
ALTER TABLE cliente ADD COLUMN cliente_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT FIRST;
ALTER TABLE produto ADD COLUMN produto_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT FIRST;