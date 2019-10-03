create database gauchoRocket;
use gauchoRocket;
create table usuario (id int primary key auto_increment, nombre varchar(50) not null, mail varchar(50) not null, password varchar(15) not null, codigo int not null);
insert into  usuario (nombre, mail, password, codigo) values ("admin", "admin@gauchorocket.com", "cohete123", 2);
select * from usuario;