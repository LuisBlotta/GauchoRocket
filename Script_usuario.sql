drop database gauchoRocket;
create database gauchoRocket;
use gauchoRocket;
create table login (id int primary key auto_increment,
					userConfirmado boolean not null,
					nick varchar(50) not null,
                    password varchar(50) not null);
                    
create table usuario (id int primary key auto_increment, 
						nombre varchar(50) not null,
                        mail varchar(50) not null,
                        rol int not null,
                        nivel_vuelo int,
                        loginID int not null,
                        foreign key(loginID) references login(id));
                        
/*create table userNoConfirmado(id int primary key auto_increment,
								usuarioID INT,
                                foreign key(usuarioID) references usuario(id));*/
                        
insert into  login (userConfirmado, nick, password) values (true,"admin", "e67732763718fbafa22f23adb5679c2f");
insert into  usuario (nombre, mail, rol, loginID) values ("admin", "admin@gauchorocket.com", 2,1) ;


select id from login where nick = "admin";
select * from usuario join login on usuario.loginID = login.id;
