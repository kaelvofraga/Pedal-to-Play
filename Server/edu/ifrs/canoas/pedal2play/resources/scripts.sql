-- Geração de Modelo físico
-- Sql ANSI 2003 - brModelo.

CREATE TABLE Imagem (
id_imagem INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
id_tipoimagem INT(11) NOT NULL,
cor INT(11) NOT NULL
);

CREATE TABLE Usuario (
id_usuario INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
data_inscricao timestamp NOT NULL,
email varchar(100) NOT NULL,
nome varchar(100),
peso float,
senha varchar(100) NOT NULL,
endereco varchar(150),
data_nasc date
);

CREATE TABLE Recompensa (
id_recompensa INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
id_imagem INT(11) NOT NULL,
FOREIGN KEY(id_imagem) REFERENCES Imagem (id_imagem)
);

CREATE TABLE Avatar (
id_avatar INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
id_usuario INT(11) NOT NULL,
genero char NOT NULL
);

CREATE TABLE Ranking (
id_ranking INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
score INT(11) NOT NULL,
data_update timestamp NOT NULL,
id_usuario INT(11) NOT NULL,
FOREIGN KEY(id_usuario) REFERENCES Usuario (id_usuario)
);

CREATE TABLE AtividadeLog (
id_atividadelog INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
calorias float NOT NULL,
data_inicio timestamp NOT NULL,
distancia float NOT NULL,
data_fim timestamp NOT NULL,
id_usuario INT(11) NOT NULL,
FOREIGN KEY(id_usuario) REFERENCES Usuario (id_usuario)
);

CREATE TABLE Tipo_Imagem (
id_tipoimagem INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT
);

CREATE TABLE Avatar_Imagem (
id_imagem INT(11) NOT NULL,
id_avatar INT(11) NOT NULL,
FOREIGN KEY(id_imagem) REFERENCES Imagem (id_imagem),
FOREIGN KEY(id_avatar) REFERENCES Avatar (id_avatar)
);

ALTER TABLE Imagem ADD FOREIGN KEY(id_tipoimagem) REFERENCES Tipo_Imagem (id_tipoimagem);
ALTER TABLE Avatar ADD FOREIGN KEY(id_usuario) REFERENCES Usuario (id_usuario);