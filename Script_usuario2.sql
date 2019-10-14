drop database gauchoRocket;
create database gauchoRocket;
use gauchoRocket;
create table login (id int primary key auto_increment,
					userConfirmado boolean not null,
                    hashConfirmacion varchar(50) not null,
					nick varchar(50) not null,
                    password varchar(50) not null);
                    
create table usuario (id int primary key auto_increment, 
						nombre varchar(50) not null,
                        mail varchar(50) not null,
                        rol int not null,
                        nivel_vuelo int,
                        loginID int not null,
                        foreign key(loginID) references login(id));
                        
create table modelo (id int primary key, descripcion varchar(20));
create table tipo_vuelo (id int primary key, descripcion varchar(20));
create table equipo (id int primary key auto_increment,modelo int not null, matricula varchar(10) not null, tipo_vuelo int not null, capacidad int, foreign key(modelo)references modelo(id), foreign key(tipo_vuelo) references tipo_vuelo(id));
create table cabina (id_equipo int, descripcion varchar(20) not null, capacidad int not null, primary key (id_equipo,descripcion), foreign key (id_equipo) references equipo(id));
create table nivel_pasajero (id_equipo int, numero int not null, primary key (id_equipo,numero), foreign key (id_equipo) references equipo(id));

create table destino (id int primary key, descripcion varchar(20) not null);
create table dia(id int primary key, descripcion varchar(10));
create table tipo_viaje (id int primary key, descripcion varchar(20));
create table trayecto (id int primary key, equipo int not null, tipo_viaje int not null ,punto_partida int not null, punto_llegada int not null, hora_partida int not null, dia_partida int not null, duracion int not null,foreign key(tipo_viaje) references tipo_viaje(id) ,foreign key(equipo) references equipo(id), foreign key(punto_partida) references destino(id), foreign key(punto_llegada) references destino(id), foreign key(dia_partida) references dia(id));

INSERT INTO modelo (id, descripcion) values (1, "Aguila"), (2, "Aguilucho"), (3, "Calandria"), (4, "Canario"), (5, "Carancho"), (6, "Colibri"), (7, "Condor"), (8, "Guanaco"), (9, "Halcon"), (10, "Zorzal");
INSERT INTO tipo_vuelo (id, descripcion) values (1,"Orbital"),(2,"Baja aceleración"),(3,"Alta aceleración");
INSERT INTO equipo (modelo, matricula, tipo_vuelo, capacidad) values (1, "AA1", 3, 300),(1, "AA5", 3, 300), (1, "AA9", 3, 300), (1, "AA13", 3, 300), (1, "AA17", 3, 300),
																	 (2, "BA8", 2, 60), (2, "BA9", 2, 60), (2, "BA10", 2, 60), (2, "BA11", 2, 60), (2, "BA12", 2, 60),
																	 (3, "O1", 1, 300), (3, "O2", 1, 300), (3, "O6", 1, 300), (3, "O7", 1, 300),
																	 (4, "BA13", 2, 80), (4, "BA14", 2, 80), (4, "BA15", 2, 80), (4, "BA16", 2, 80), (4, "BA17", 2, 80),
                                                                     (5, "BA4", 2, 110), (5, "BA5", 2, 110), (5, "BA6", 2, 110), (5, "BA7", 2, 110), 
                                                                     (6, "O3", 1, 120), (6, "O4", 1, 120), (6, "O5", 1, 120), (6, "O8", 1, 120), (6, "O9", 1, 120), 
                                                                     (7, "AA2", 3, 350), (7, "AA6", 3, 350), (7, "AA10", 3, 350), (7, "AA14", 3, 350), (7, "AA18", 3, 350),
                                                                     (8, "AA4", 3, 100), (8, "AA8", 3, 100), (8, "AA12", 3, 100), (8, "AA16", 3, 100),  
                                                                     (9, "AA3", 3, 200), (9, "AA7", 3, 200), (9, "AA11", 3, 200), (9, "AA15", 3, 200), (9, "AA19", 3, 200), 
                                                                     (10, "BA1", 2, 100), (10, "BA2", 2, 100), (10, "BA3", 2, 100);
                                                                     