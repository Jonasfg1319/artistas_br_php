create table usuarios(
  id int not null AUTO_INCREMENT PRIMARY key, 
  email varchar(250) not null,
  nome varchar(250) not null,
  sobrenome varchar(250) not null,
  nick varchar(250) not null,
  id_privilegio int not null,
  senha varchar(250) not null,
  img_perfil varchar(250) not null

);

create table artes(
  id int not null AUTO_INCREMENT PRIMARY key,
  id_usuario int not null,
  CONSTRAINT FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
  titulo varchar(250) not null,
  descricao text not null,
  img varchar(250) not null,
  autor varchar(250) not null
);

create table quadrinhos(
	id int not null AUTO_INCREMENT PRIMARY key,
    id_usuario int not null,
    CONSTRAINT FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
    titulo varchar(250) not null,
    descricao varchar(250) not null,
    capa varchar(250) not null,
    genero varchar(250) not null,
    status varchar(250) not null,
    autor varchar(250) not null

);

create table capitulos(
  id int not null AUTO_INCREMENT PRIMARY key,
  id_quadrinho int not null,
  CONSTRAINT FOREIGN KEY (id_quadrinho) REFERENCES quadrinhos(id),
  numero int not null,
  titulo varchar(250) not null,
  titulo_quadrinho varchar(250) not null
 
);

create table paginas(
  id int not null AUTO_INCREMENT PRIMARY key,
  id_quadrinho int not null,
  CONSTRAINT FOREIGN KEY (id_quadrinho) REFERENCES quadrinhos(id),
  id_capitulo int not null,
  CONSTRAINT FOREIGN KEY (id_capitulo) REFERENCES capitulos(id),
  img varchar(250) not null

);

create table mensagens(
  id int not null AUTO_INCREMENT PRIMARY key,
  id_remetente int not null,
  id_destinatario int not null,
  mensagem text not null
);

create table comentarios(
 id int not null AUTO_INCREMENT PRIMARY key,
 id_usuario int not null,
 CONSTRAINT FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
 nick_usuario varchar(250) not null,
 id_arte int not null,
 CONSTRAINT FOREIGN KEY (id_arte) REFERENCES artes(id),
 id_quadrinho int not null,
 CONSTRAINT FOREIGN KEY (id_quadrinho) REFERENCES quadrinhos(id),
 id_cap int not null,
 CONSTRAINT FOREIGN KEY (id_cap) REFERENCES capitulos(id),
 id_autor int not null,
 coment text not null
);