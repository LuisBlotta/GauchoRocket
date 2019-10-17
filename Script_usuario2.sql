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


insert into  login (userConfirmado, hashConfirmacion, nick, password) values (true,"f50686d5dc72f5d073c5295937bc58ce","admin", "e67732763718fbafa22f23adb5679c2f");
insert into  usuario (nombre, mail, rol, loginID) values ("admin", "admin@gauchorocket.com", 2,1) ;                      
                        
create table tipo_vuelo (id int primary key, descripcion varchar(20));                        
create table modelo (id int primary key, descripcion varchar(20) , tipo_vuelo int not null, foreign key(tipo_vuelo) references tipo_vuelo(id));
create table cabina (id_modelo int, descripcion varchar(20) not null, capacidad int not null, primary key (id_modelo,descripcion), foreign key (id_modelo) references modelo(id));
create table nivel_pasajero (id_modelo int, numero int not null, primary key (id_modelo,numero), foreign key (id_modelo) references modelo(id));
create table equipo (id int primary key auto_increment,modelo int not null, matricula varchar(10) not null, foreign key(modelo)references modelo(id));


create table destino (id int primary key, descripcion varchar(20) not null);
create table tipo_viaje (id int primary key, descripcion varchar(20));
create table trayecto (id int primary key, equipo int not null, tipo_viaje int not null ,punto_partida int not null, punto_llegada int not null, hora_partida int not null, dia_partida date not null, duracion int not null,foreign key(tipo_viaje) references tipo_viaje(id) ,foreign key(equipo) references equipo(id), foreign key(punto_partida) references destino(id), foreign key(punto_llegada) references destino(id));

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
INSERT INTO equipo (modelo, matricula) values   (1, "AA1"),(1, "AA5"), (1, "AA9"), (1, "AA13"), (1, "AA17"),
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
                                                                     
INSERT INTO destino (id, descripcion) values (1, "BA"), (2, "AK"),(3,"EEI"),(4,"Orbital Hotel"), (5, "Luna"), (6,"Marte"),(7,"Ganimedes"), (8, "Europa"), (9, "Io"), (10, "Encelado"), (11, "Titan");                                                                    
INSERT INTO tipo_viaje (id, descripcion) values (1, "Suborbital"), (2, "Tour"), (3,"Entre destinos");         

INSERT INTO trayecto (id, equipo, tipo_viaje, punto_partida, punto_llegada, hora_partida, dia_partida, duracion) values (1, 3, 1, 1, 1, 12, '20191001', 8), /*orbitales*/
																														(2, 24, 1, 2, 2, 15, '20191001', 8),
																														(3, 11, 1, 1, 1, 17, '20191002', 8),
																														(4, 25, 1, 2, 2, 18, '20191002', 8),
																														(5, 12, 1, 1, 1, 09, '20201107', 8),
																														(6, 34, 2, 1, 1, 12, '20191027', 840),/*tour*/
																														(7, 35, 2, 1, 1, 22, '20191103', 840),
																														(8, 6, 3, 1, 6, 08, '20191001', 47), /*C1 entre destinos BA*/
																														(9, 38, 3, 2, 6, 14, '20191002', 35),/*C1 entre destinos AA*/
																														(10, 29, 3, 1, 5, 10, '20191102', 13),
																														(11, 43, 3, 2, 11, 08, '20201002', 314),/*C2 entre destinos BA*/
																														(12, 39, 3, 1, 11, 20, '20201002', 215),/*C2 entre destinos AA*/
																														(13, 40, 3, 7, 10, 20, '20191009', 118);/*C2 entre destinos AA de ganimedes a encedalo*/


select trayecto.dia_partida, modelo.descripcion, equipo.matricula, d1.descripcion partida, d0.descripcion llegada from trayecto join tipo_viaje on trayecto.tipo_viaje = tipo_viaje.id
						join destino d0 on trayecto.punto_llegada = d0.id
						join destino d1 on trayecto.punto_partida = d1.id
						join equipo on equipo.id = trayecto.equipo
						join modelo on modelo.id = equipo.modelo;

/*select * from trayecto join equipo on trayecto.equipo = equipo.id join modelo on modelo.id = equipo.modelo
select * from equipo join modelo on modelo.id = equipo.modelo*/