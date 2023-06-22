create database if not exists Farm;
use Farm;
create table if not exists Propriedades (
  numero_de_escritura int not null,
  nome varchar(20) not null,
  tamanho float not null,
  primary key(numero_de_escritura)
);
create table if not exists Localizacao (
  id_localizacao int not null AUTO_INCREMENT,
  cidade VARCHAR(20) not null,
  estado VARCHAR(20) not null,
  lagradouro VARCHAR(45) not null,
  ponto_de_referencia VARCHAR(45) not null,
  numero_de_escritura_propriedade int not null,
  primary key (id_localizacao),
  foreign key(numero_de_escritura_propriedade) references Propriedades(numero_de_escritura) ON UPDATE CASCADE ON DELETE CASCADE
);
create table if not exists Plantacoes (
  id_plantacao int not null AUTO_INCREMENT,
  apelido VARCHAR(20) not null,
  tamanho float not null,
  data_de_plantio date not null,
  numero_de_escritura_propriedade int not null,
  primary key(id_plantacao),
  foreign key(numero_de_escritura_propriedade) references Propriedades(numero_de_escritura) ON UPDATE CASCADE ON DELETE CASCADE
);
create table if not exists Cultura (
  nome varchar(30) not null,
  especie varchar(30) not null,
  classificacao varchar(30) not null,
  plantacao_id int not null,
  primary key(nome),
  foreign key(plantacao_id) references Plantacoes(id_plantacao) ON UPDATE CASCADE ON DELETE CASCADE
);
create table if not exists Atividades(
  id_atividade int not null AUTO_INCREMENT,
  data date not null,
  valor float,
  plantacao_id int not null,
  descricao varchar(100) not null,
  primary key (id_atividade),
  foreign key(plantacao_id) references Plantacoes(id_plantacao) ON UPDATE CASCADE ON DELETE CASCADE
);
create table if not exists Colheitas(
  id_colheita int not null AUTO_INCREMENT,
  valor_ganho float not null,
  atividade_id int not null,
  primary key(id_colheita),
  foreign key(atividade_id) references Atividades(id_atividade) ON UPDATE CASCADE ON DELETE CASCADE
);
create table if not exists Quantidade (
  id_quantidade int not null AUTO_INCREMENT,
  tipo varchar(10) not null,
  valor int not null,
  colheita_id int not null,
  primary key(id_quantidade),
  foreign key(colheita_id) REFERENCES Colheitas(id_colheita) ON UPDATE CASCADE ON DELETE CASCADE
);