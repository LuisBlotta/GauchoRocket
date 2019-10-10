create database gauchoRocket;
use gauchoRocket;
create table login (id int primary key auto_increment, nick varchar(50) not null, password varchar(50) not null);
create table usuario (id int primary key auto_increment, nombre varchar(50) not null,  mail varchar(50) not null, rol int not null, nivel_vuelo int, login int not null, foreign key(login) references login(id));
insert into  login (nick, password) values ("admin", "cohete123");
select id from login where nick = "admin";
insert into  usuario (nombre, mail, rol, login) values ("admin", "admin@gauchorocket.com", 2,1) ;
select * from usuario join login on usuario.login = login.id;