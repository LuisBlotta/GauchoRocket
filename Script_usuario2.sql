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
                        
                        
create table tipo_vuelo (id int primary key, descripcion varchar(20));                        
create table modelo (id int primary key, descripcion varchar(20) , tipo_vuelo int not null, foreign key(tipo_vuelo) references tipo_vuelo(id));
create table cabina (id_modelo int, descripcion varchar(20) not null, capacidad int not null, primary key (id_modelo,descripcion), foreign key (id_modelo) references modelo(id));
create table nivel_pasajero (id_modelo int, numero int not null, primary key (id_modelo,numero), foreign key (id_modelo) references modelo(id));
create table equipo (id int primary key auto_increment,modelo int not null, matricula varchar(10) not null, foreign key(modelo)references modelo(id));


create table destino (id int primary key, descripcion varchar(20) not null);
create table dia(id int primary key, descripcion varchar(10));
create table tipo_viaje (id int primary key, descripcion varchar(20));
create table trayecto (id int primary key, equipo int not null, tipo_viaje int not null ,punto_partida int not null, punto_llegada int not null, hora_partida int not null, dia_partida int not null, duracion int not null,foreign key(tipo_viaje) references tipo_viaje(id) ,foreign key(equipo) references equipo(id), foreign key(punto_partida) references destino(id), foreign key(punto_llegada) references destino(id), foreign key(dia_partida) references dia(id));

INSERT INTO tipo_vuelo (id, descripcion) values (1,"Orbital"),(2,"Baja aceleración"),(3,"Alta aceleración");
INSERT INTO modelo (id, descripcion, tipo_vuelo) values (1, "Aguila",3), (2, "Aguilucho",2), (3, "Calandria",1), (4, "Canario",2), (5, "Carancho",2), (6, "Colibri",1), (7, "Condor",3), (8, "Guanaco",3), (9, "Halcon",3), (10, "Zorzal",2);
INSERT INTO cabina (id_modelo, descripcion, capacidad) values (1, "G", 200), (1, "F", 75), (1, "S", 25) ,
															  (2, "G", 0), (2, "F", 50), (2, "S", 10),	
                                                              (3, "G", 200), (3, "F", 75), (3, "S", 25),
                                                              (4, "G", 0), (4, "F", 70), (4, "S", 10),	
                                                              (5, "G", 100), (5, "F", 0), (5, "S", 0),	
                                                              (6, "G", 100), (6, "F", 18), (6, "S", 2),	
                                                              (7, "G", 300), (7, "F", 10), (7, "S", 40),	
                                                              (8, "G", 0), (8, "F", 0), (8, "S", 100),	
                                                              (9, "G", 150), (9, "F", 25), (9, "S", 25),	
                                                              (10, "G", 50), (10, "F", 50), (10, "S", 0);	
INSERT INTO nivel_pasajero (id_modelo, numero) values (1,2), (1,3),
													  (2,2), (2,3),
													  (3,1), (3,2), (3,3),
													  (4,2), (4,3),
                                                      (5,2), (5,3),
                                                      (6,1), (6,2), (6,3),
                                                      (7,2), (7,3),
                                                      (8,3),
                                                      (9,3),
                                                      (10,2), (10,3);
INSERT INTO equipo (modelo, matricula) values (1, "AA1"),(1, "AA5"), (1, "AA9"), (1, "AA13"), (1, "AA17"),
																	 (2, "BA8"), (2, "BA9"), (2, "BA10"), (2, "BA11"), (2, "BA12"),
																	 (3, "O1"), (3, "O2"), (3, "O6"), (3, "O7"),
																	 (4, "BA13"), (4, "BA14"), (4, "BA15"), (4, "BA16"), (4, "BA17"),
                                                                     (5, "BA4"), (5, "BA5"), (5, "BA6"), (5, "BA7"), 
                                                                     (6, "O3"), (6, "O4"), (6, "O5"), (6, "O8"), (6, "O9"), 
                                                                     (7, "AA2"), (7, "AA6"), (7, "AA10"), (7, "AA14"), (7, "AA18"),
                                                                     (8, "AA4"), (8, "AA8"), (8, "AA12"), (8, "AA16"),  
                                                                     (9, "AA3"), (9, "AA7"), (9, "AA11"), (9, "AA15"), (9, "AA19"), 
                                                                     (10, "BA1"), (10, "BA2"), (10, "BA3");
                                                                     
select * from cabina join modelo on cabina.id_modelo = modelo.id join nivel_pasajero on modelo.id = nivel_pasajero.id_modelo join equipo on equipo.modelo = modelo.id;
                                                                     
INSERT INTO destino (id, descripcion) values (1, "BA"), (2, "AK"),(3,"EEI"),(4,"Orbital Hotel"), (5, "Luna"), (6,"Marte"),(7,"Ganimedes"), (8, "Europa"), (9, "Io"), (10, "Encedalo"), (11, "Titan");                                                                    
INSERT INTO dia (id, descripcion) values (1, "Lunes"), (2, "Martes"), (3, "Miercoles"), (4,"Jueves"), (5,"Viernes"), (6,"Sabado"), (7,"Domingo");                   
INSERT INTO tipo_viaje (id, descripcion) values (1, "Suborbital"), (2, "Tour"), (3,"Entre destinos");                                                  