DROP DATABASE IF EXISTS gauchoRocket;
CREATE DATABASE gauchoRocket;
USE gauchoRocket;

/*----------Tablas usuario----------*/  
CREATE TABLE login (id_login INT PRIMARY KEY AUTO_INCREMENT,
					userConfirmado BOOLEAN NOT NULL,
                    hashConfirmacion VARCHAR(50) NOT NULL,
					nick VARCHAR(50) NOT NULL UNIQUE,
                    password VARCHAR(50) NOT NULL);
                    
CREATE TABLE nivel_pasajero (id_nivel INT PRIMARY KEY NOT NULL);
                    
CREATE TABLE usuario (id_usuario INT PRIMARY KEY AUTO_INCREMENT,
						nombre VARCHAR(50) NOT NULL,
                        mail VARCHAR(50) NOT NULL,
                        rol INT NOT NULL,
                        fk_nivel INT,
                        fk_login INT NOT NULL,
                        FOREIGN KEY(fk_login) REFERENCES login(id_login),
                        FOREIGN KEY(fk_nivel) REFERENCES nivel_pasajero(id_nivel));


/*----------Tablas vuelo----------*/
CREATE TABLE tipo_vuelo (id_tipo_vuelo INT PRIMARY KEY, descripcion VARCHAR(20));
CREATE TABLE modelo (id_modelo INT PRIMARY KEY, descripcion VARCHAR(20) , fk_tipo_vuelo INT NOT NULL, FOREIGN KEY(fk_tipo_vuelo) REFERENCES tipo_vuelo(id_tipo_vuelo));
CREATE TABLE cabina (fk_id_modelo INT, descripcion VARCHAR(20) NOT NULL, capacidad INT NOT NULL, PRIMARY KEY (fk_id_modelo, descripcion), FOREIGN KEY (fk_id_modelo) REFERENCES modelo(id_modelo));

CREATE TABLE equipo (id_equipo INT PRIMARY KEY AUTO_INCREMENT, fk_modelo INT NOT NULL, matricula VARCHAR(10) NOT NULL, FOREIGN KEY(fk_modelo)REFERENCES modelo(id_modelo));

CREATE TABLE nivel_modelo(id_nivel_modelo INT PRIMARY KEY AUTO_INCREMENT , fk_nivel INT NOT NULL, fk_modelo INT NOT NULL, FOREIGN KEY(fk_modelo)REFERENCES modelo(id_modelo),FOREIGN KEY(fk_nivel)REFERENCES nivel_pasajero(id_nivel) );


CREATE TABLE destino (id_destino INT PRIMARY KEY, descripcion VARCHAR(50) NOT NULL);
CREATE TABLE tipo_viaje (id_tipo_viaje INT PRIMARY KEY, descripcion VARCHAR(20));
CREATE TABLE vuelo (id_vuelo INT PRIMARY KEY AUTO_INCREMENT, fk_equipo INT NOT NULL, fk_tipo_viaje INT NOT NULL, hora_partida INT NOT NULL, dia_partida DATE NOT NULL, FOREIGN KEY(fk_tipo_viaje) REFERENCES tipo_viaje(id_tipo_viaje) ,FOREIGN KEY(fk_equipo) REFERENCES equipo(id_equipo));
CREATE TABLE trayecto (id_trayecto INT PRIMARY KEY NOT NULL AUTO_INCREMENT,  fk_punto_partida INT NOT NULL, fk_punto_llegada INT NOT NULL, duracion INT NOT NULL, precio INT NOT NULL, FOREIGN KEY(fk_punto_partida) REFERENCES destino(id_destino), FOREIGN KEY(fk_punto_llegada) REFERENCES destino(id_destino));
CREATE TABLE vuelo_trayecto (id_vuelo_trayecto INT NOT NULL PRIMARY KEY AUTO_INCREMENT, fk_vuelo INT NOT NULL, fk_trayecto INT NOT NULL, FOREIGN KEY(fk_vuelo) REFERENCES vuelo(id_vuelo), FOREIGN KEY(fk_trayecto) REFERENCES trayecto(id_trayecto));
    
/*----------Tablas reserva----------*/
CREATE TABLE estado_reserva(id_estado_reserva INT PRIMARY KEY, descripcion VARCHAR(20));
CREATE TABLE asientos_reservados (id_asientos_reservados INT AUTO_INCREMENT PRIMARY KEY, numero_asiento INT NOT NULL, numero_reserva INT NOT NULL);
CREATE TABLE reserva (id_reserva INT PRIMARY KEY AUTO_INCREMENT, nro_reserva INT NOT NULL, fk_id_vuelo_trayecto INT NOT NULL, fk_estado_reserva INT NOT NULL, fk_login INT NOT NULL, tipo_cabina VARCHAR(1), cantidad_lugares INT, FOREIGN KEY(fk_estado_reserva) REFERENCES estado_reserva(id_estado_reserva), FOREIGN KEY(fk_id_vuelo_trayecto) REFERENCES vuelo_trayecto(id_vuelo_trayecto) ,FOREIGN KEY(fk_login) REFERENCES login(id_login));
CREATE TABLE asientos_reserva (id_asientos_reserva INT AUTO_INCREMENT PRIMARY KEY, fk_asientos_reservados INT, fk_reserva INT, FOREIGN KEY(fk_asientos_reservados) REFERENCES asientos_reservados(id_asientos_reservados), FOREIGN KEY(fk_reserva) REFERENCES reserva(id_reserva));

CREATE TABLE lista_espera(id_lista_espera INT AUTO_INCREMENT PRIMARY KEY, fk_reserva INT NOT NULL, FOREIGN KEY(fk_reserva) REFERENCES reserva(id_reserva));
CREATE TABLE reserva_cancelada(id_reserva_cancelada INT AUTO_INCREMENT PRIMARY KEY, fk_reserva INT NOT NULL, FOREIGN KEY(fk_reserva) REFERENCES reserva(id_reserva));

/*----------Tablas transaccion----------*/
CREATE TABLE estado_transaccion(id_estado_transaccion INT PRIMARY KEY NOT NULL, descripcion VARCHAR(50));
CREATE TABLE transaccion(id_transaccion INT PRIMARY KEY AUTO_INCREMENT NOT NULL, cod_transaccion VARCHAR(50) NOT NULL, fk_login INT NOT NULL, fk_estado_transaccion INT, fecha DATE NOT NULL, hora time NOT NULL, zona_horaria VARCHAR(50) NOT NULL, nro_reserva INT NOT NULL, nro_tarjeta INT NOT NULL, tipo_tarjeta VARCHAR(20), FOREIGN KEY (fk_login) REFERENCES login(id_login),FOREIGN KEY (fk_estado_transaccion) REFERENCES estado_transaccion(id_estado_transaccion));

/*----------Tablas centro médico----------*/
CREATE TABLE medico (id_medico INT PRIMARY KEY AUTO_INCREMENT NOT NULL, nombre VARCHAR(60) NOT NULL, direccion VARCHAR(70) NOT NULL);
CREATE TABLE turno (id_turno INT PRIMARY KEY AUTO_INCREMENT NOT NULL, fecha DATE, fk_medico INT NOT NULL, fk_login INT NOT NULL,
                    FOREIGN KEY(fk_medico) REFERENCES medico(id_medico), FOREIGN KEY(fk_login) REFERENCES login(id_login));


/*--------------------------------------INSERTS--------------------------------------*/

/*----------Administrador----------*/
INSERT INTO  login (userConfirmado, hashConfirmacion, nick, password) VALUES (true,"f50686d5dc72f5d073c5295937bc58ce","admin", "e67732763718fbafa22f23adb5679c2f");
INSERT INTO  usuario (nombre, mail, rol, fk_login) VALUES ("Administrador", "admin@gauchorocket.com", 2,1) ;
/*-------------Usuario-------------*/
INSERT INTO  login (userConfirmado, hashConfirmacion, nick, password) VALUES (true,"f50686d5dc72f5d073c5295937bc58ce","user", "e67732763718fbafa22f23adb5679c2f");
INSERT INTO  usuario (nombre, mail, rol, fk_login) VALUES ("Usuario", "user@gauchorocket.com", 1,2);


INSERT INTO estado_transaccion(id_estado_transaccion, descripcion) VALUES (0,"Error de datos"),(1,"Correcto");

INSERT INTO estado_reserva(id_estado_reserva, descripcion) VALUES (1, "Confirmada"), (2,"Pendiente"), (3,"Abonada y pendiente"), (4,"Cancelada"),(5,"En lista de espera");

INSERT INTO tipo_vuelo (id_tipo_vuelo, descripcion) VALUES (1,"Orbital"),(2,"Baja aceleracion"),(3,"Alta aceleracion");
INSERT INTO modelo (id_modelo, descripcion, fk_tipo_vuelo) VALUES (1, "Aguila",3), (2, "Aguilucho",2), (3, "Calandria",1), (4, "Canario",2), (5, "Carancho",2), (6, "Colibri",1), (7, "Condor",3), (8, "Guanaco",3), (9, "Halcon",3), (10, "Zorzal",2);

INSERT INTO cabina (fk_id_modelo, descripcion, capacidad) VALUES (1, "G", 200), (1, "F", 75), (1, "S", 25) ,
															  (2, "G", 0), (2, "F", 50), (2, "S", 10),	
                                                              (3, "G", 200), (3, "F", 75), (3, "S", 25),
                                                              (4, "G", 0), (4, "F", 70), (4, "S", 10),	
                                                              (5, "G", 100), (5, "F", 0), (5, "S", 0),	
                                                              (6, "G", 100), (6, "F", 18), (6, "S", 2),	
                                                              (7, "G", 300), (7, "F", 10), (7, "S", 40),	
                                                              (8, "G", 0), (8, "F", 0), (8, "S", 100),	
                                                              (9, "G", 150), (9, "F", 25), (9, "S", 25),	
                                                              (10, "G", 50), (10, "F", 50), (10, "S", 0);	
INSERT INTO nivel_pasajero(id_nivel) VALUES (1),(2),(3);
INSERT INTO nivel_modelo (fk_modelo,fk_nivel) VALUES (1,2), (1,3),
													  (2,2), (2,3),
													  (3,1), (3,2), (3,3),
													  (4,2), (4,3),
                                                      (5,2), (5,3),
                                                      (6,1), (6,2), (6,3),
                                                      (7,2), (7,3),
                                                      (8,3),
                                                      (9,3),
                                                      (10,2), (10,3);
INSERT INTO equipo (fk_modelo, matricula) VALUES   (1, "AA1"),(1, "AA5"), (1, "AA9"), (1, "AA13"), (1, "AA17"),
											    (2, "BA8"), (2, "BA9"), (2, "BA10"), (2, "BA11"), (2, "BA12"),
												(3, "O1"), (3, "O2"), (3, "O6"), (3, "O7"),
												(4, "BA13"), (4, "BA14"), (4, "BA15"), (4, "BA16"), (4, "BA17"),
                                                (5, "BA4"), (5, "BA5"), (5, "BA6"), (5, "BA7"), 
                                                (6, "O3"), (6, "O4"), (6, "O5"), (6, "O8"), (6, "O9"), 
												(7, "AA2"), (7, "AA6"), (7, "AA10"), (7, "AA14"), (7, "AA18"),
                                                (8, "AA4"), (8, "AA8"), (8, "AA12"), (8, "AA16"),  /*Tour*/
												(9, "AA3"), (9, "AA7"), (9, "AA11"), (9, "AA15"), (9, "AA19"), 
                                                (10, "BA1"), (10, "BA2"), (10, "BA3");
                                                                     
                                                                     
INSERT INTO destino (id_destino, descripcion) VALUES (1, "Buenos Aires"), (2, "Ankara"),(3,"Estacion Espacial Internacional"),(4,"Orbital Hotel"), (5, "Luna"), (6,"Marte"),(7,"Ganimedes"), (8, "Europa"), (9, "Io"), (10, "Encelado"), (11, "Titan");
INSERT INTO tipo_viaje (id_tipo_viaje, descripcion) VALUES (1, "Suborbital"), (2, "Tour"), (3,"Entre destinos");

INSERT INTO vuelo (fk_equipo, fk_tipo_viaje, hora_partida, dia_partida) VALUES 		(13, 1, 18, '20191215'), /*orbitales*/
																					(24, 1, 15, '20191001'),
																					(11, 1, 17, '20191002'),
																					(25, 1, 18, '20191002'),
																					(12, 1, 09, '20201107'),
																					(34, 2, 12, '20191027'),/*tour*/
																					(35, 2, 22, '20201103'),
                                                                                    
																					(6, 3, 08, '20191001'), /*C1 entre destinos BA BS AS*/
																					(6, 3, 08, '20191001'), /*C1 entre destinos BA ANKARA*/
                                                                                    
                                                                                    (6, 3, 14, '20191113'), /*C1 entre destinos BA al revez BS AS*/ /*cambio para probar 20191101*/ 
                                                                                    (6, 3, 14, '20191113'), /*C1 entre destinos BA al revez ANKARA*/ /*cambio para probar 20191101*/ 

																					(38, 3, 14, '20191125'),/*C1 entre destinos AA Bs AS*/
                                                                                    (38, 3, 14, '20191125'),/*C1 entre destinos AA Ankara*/

                                                                                    (38, 3, 14, '20190902'),/*C1 entre destinos AA al revez BS AS*/
                                                                                    (38, 3, 14, '20191002'),/*C1 entre destinos AA al revez Ankara*/
                                                                                    
																					
																					(43, 3, 20, '20191125'),/*C2 entre destinos BA BS AS*/
																					(43, 3, 08, '20201002'),/*C2 entre destinos BA ANKARA*/
                                                                                    
                                                                                    (43, 3, 08, '20201102'),/*C2 entre destinos BA al revez BS AS*/
                                                                                    (43, 3, 08, '20201102'),/*C2 entre destinos BA al revez ANKARA*/
                                                                                    
                                                                                    
																					(39, 3, 20, '20200802'),/*C2 entre destinos AA BS AS*/
																					(39, 3, 20, '20200802'),/*C2 entre destinos AA ANKARA*/

																					(39, 3, 20, '20210902'),/*C2 entre destinos AA al revez BS AS*/
																					(39, 3, 20, '20210902');/*C2 entre destinos AA al revez ANKARA*/
                                                                                    



INSERT INTO trayecto (fk_punto_partida, fk_punto_llegada, duracion, precio) VALUES 				(1, 1, 8, 800), /*orbitales*/
																								(2, 2, 8, 800),
																								(1, 1, 8, 800),
																								(2, 2, 8, 800),
																								(1, 1, 840, 5000),/*tour*/
																								(1, 1, 840, 5000),
                                                                                    
																								(1, 3, 5, 1000),/*C1 entre destinos BA BS AS*/
																								(1, 4, 5, 1000),
                                                                                                (1, 5, 5, 1000),
                                                                                                (1, 6, 5, 1000),
                                                                                                (3, 4, 5, 1000),
                                                                                                (3, 5, 5, 1000),
                                                                                                (3, 6, 5, 1000),
                                                                                                (4, 5, 16, 1000),
																								(4, 6, 26, 1000),
                                                                                                (5, 6, 26, 1000),
                                                                                                                                                                        
																								(6, 5, 26, 1000),	/*C1 entre destinos BA al revez BS AS*/
																								(6, 4, 26, 1000),                                                                                                
                                                                                                (6, 3, 5, 1000),
                                                                                                (6, 1, 5, 1000),
                                                                                                (5, 4, 16, 1000),
                                                                                                (5, 3, 5, 1000),
                                                                                                (5, 1, 5, 1000),
                                                                                                (4, 3, 5, 1000),
                                                                                                (4, 1, 5, 1000),
																								(3, 1, 5, 1000),
                                                                                                                         
																								(2, 3, 5, 1000),/*C1 entre destinos BA ANKARA*/
                                                                                                (2, 4, 5, 1000),
                                                                                                (2, 5, 5, 1000),
                                                                                                (2, 6, 5, 1000),
																								(3, 4, 5, 1000),
                                                                                                (3, 5, 5, 1000),
                                                                                                (3, 6, 5, 1000),
                                                                                                (4, 5, 16, 1000),
																								(4, 6, 26, 1000),
                                                                                                (5, 6, 26, 1000),
                                                                                                                                                                        
																								(6, 5, 26, 1000),	/*C1 entre destinos BA al revez ANKARA*/
																								(6, 4, 26, 1000),                                                                                                
                                                                                                (6, 3, 5, 1000),
                                                                                                (6, 2, 5, 1000),
                                                                                                (5, 4, 16, 1000),
                                                                                                (5, 3, 5, 1000),
                                                                                                (5, 2, 5, 1000),
                                                                                                (4, 3, 5, 1000),
                                                                                                (4, 2, 5, 1000),
																								(3, 2, 5, 1000),
                                                                                                                         
                                                                                                                         
																								(1, 3, 4, 2000),/*C1 entre destinos AA BS AS*/
                                                                                                (1, 4, 4, 2000),
                                                                                                (1, 5, 4, 2000),
                                                                                                (1, 6, 4, 2000),
                                                                                                (3, 4, 4, 2000),
																								(3, 5, 9, 2000),
																								(3, 6, 22, 2000),
                                                                                                (4, 5, 4, 2000),
																								(4, 6, 9, 2000),
																								(5, 6, 22, 2000),
                                                                                   
																								(6, 5, 22, 2000),/*C1 entre destinos AA al revez BS AS*/
                                                                                                (6, 4, 9, 2000),
                                                                                                (6, 3, 22, 2000),
                                                                                                (6, 1, 22, 2000),
                                                                                                (5, 4, 4, 2000),                                                                                                
                                                                                                (5, 3, 9, 2000),
                                                                                                (5, 1, 9, 2000),
																								(4, 3, 4, 2000),
                                                                                                (4, 1, 4, 2000),
                                                                                                (3, 1, 4, 2000),
                                                                                                
                                                                                                (2, 3, 4, 2000),/*C1 entre destinos AA ANKARA*/
                                                                                                (2, 4, 4, 2000),
                                                                                                (2, 5, 4, 2000),
                                                                                                (2, 6, 4, 2000),
                                                                                                (3, 4, 4, 2000),
																								(3, 5, 9, 2000),
																								(3, 6, 22, 2000),
                                                                                                (4, 5, 4, 2000),
																								(4, 6, 9, 2000),
																								(5, 6, 22, 2000),
                                                                                   
																								(6, 5, 22, 2000),/*C1 entre destinos AA al revez ANKARA*/
                                                                                                (6, 4, 9, 2000),
                                                                                                (6, 3, 22, 2000),
                                                                                                (6, 2, 22, 2000),
                                                                                                (5, 4, 4, 2000),                                                                                                
                                                                                                (5, 3, 9, 2000),
                                                                                                (5, 2, 9, 2000),
																								(4, 3, 4, 2000),
                                                                                                (4, 2, 4, 2000),
                                                                                                (3, 2, 4, 2000),
                                                                                                                                                                     
																								(1, 3, 18, 3000),/*C2 entre destinos BA BS AS*/
                                                                                                (1, 5, 18, 3000),
                                                                                                (1, 7, 18, 3000),
                                                                                                (1, 8, 18, 3000),
                                                                                                (1, 9, 18, 3000),
                                                                                                (1, 10, 18, 3000),
                                                                                                (1, 11, 18, 3000),
                                                                                                (3, 5, 18, 3000),
																								(3, 7, 18, 3000),
                                                                                                (3, 8, 18, 3000),
                                                                                                (3, 9, 18, 3000),
                                                                                                (3, 10, 18, 3000),
                                                                                                (3, 11, 18, 3000),
                                                                                                (5, 7, 48, 3000),
																								(5, 8, 18, 3000),
                                                                                                (5, 9, 18, 3000),
                                                                                                (5, 10, 18, 3000),
                                                                                                (5, 11, 18, 3000),
																								(7, 8, 50, 3000),
                                                                                                (7, 9, 18, 3000),
                                                                                                (7, 10, 18, 3000),
                                                                                                (7, 11, 18, 3000),
																								(8, 9, 51, 3000),
                                                                                                (8, 10, 18, 3000),
                                                                                                (8, 11, 18, 3000),
																								(9, 10, 70, 3000),
                                                                                                (9, 11, 18, 3000),
																								(10, 11, 77, 3000),
                                                                                            
																								(11, 10, 77, 3000), /*C2 entre destinos BA al revez BS AS*/
																								(11, 9, 18, 3000),
                                                                                                (11, 8, 18, 3000),
                                                                                                (11, 7, 18, 3000),
                                                                                                (11, 5, 18, 3000),
                                                                                                (11, 3, 18, 3000),
                                                                                                (11, 1, 18, 3000),
                                                                                                (10, 9, 70, 3000),
                                                                                                (10, 8, 18, 3000),
                                                                                                (10, 7, 18, 3000),
                                                                                                (10, 5, 18, 3000),
                                                                                                (10, 3, 18, 3000),
                                                                                                (10, 1, 18, 3000),
                                                                                                (9, 8, 51, 3000),																																												
                                                                                                (9, 7, 18, 3000),
                                                                                                (9, 5, 18, 3000),
                                                                                                (9, 3, 18, 3000),
                                                                                                (9, 1, 18, 3000),
                                                                                                (8, 7, 50, 3000),                                                                                                
																								(8, 5, 18, 3000),
                                                                                                (8, 3, 18, 3000),
                                                                                                (8, 1, 18, 3000),
																								(7, 5, 48, 3000),
																								(7, 3, 18, 3000),
                                                                                                (7, 1, 18, 3000),
                                                                                                (5, 3, 18, 3000),
																								(5, 1, 18, 3000),
																								(3, 1, 18, 3000),
                                                                                                
                                                                                                
                                                                                                
                                                                                                (2, 3, 18, 3000),/*C2 entre destinos BA ANKARA*/
                                                                                                (2, 5, 18, 3000),
                                                                                                (2, 7, 18, 3000),
                                                                                                (2, 8, 18, 3000),
                                                                                                (2, 9, 18, 3000),
                                                                                                (2, 10, 18, 3000),
                                                                                                (2, 11, 18, 3000),
                                                                                                (3, 5, 18, 3000),
																								(3, 7, 18, 3000),
                                                                                                (3, 8, 18, 3000),
                                                                                                (3, 9, 18, 3000),
                                                                                                (3, 10, 18, 3000),
                                                                                                (3, 11, 18, 3000),
                                                                                                (5, 7, 48, 3000),
																								(5, 8, 18, 3000),
                                                                                                (5, 9, 18, 3000),
                                                                                                (5, 10, 18, 3000),
                                                                                                (5, 11, 18, 3000),
																								(7, 8, 50, 3000),
                                                                                                (7, 9, 18, 3000),
                                                                                                (7, 10, 18, 3000),
                                                                                                (7, 11, 18, 3000),
																								(8, 9, 51, 3000),
                                                                                                (8, 10, 18, 3000),
                                                                                                (8, 11, 18, 3000),
																								(9, 10, 70, 3000),
                                                                                                (9, 11, 18, 3000),
																								(10, 11, 77, 3000),
                                                                                            
																								(11, 10, 77, 3000), /*C2 entre destinos BA al revez ANKARA*/
																								(11, 9, 18, 3000),
                                                                                                (11, 8, 18, 3000),
                                                                                                (11, 7, 18, 3000),
                                                                                                (11, 5, 18, 3000),
                                                                                                (11, 3, 18, 3000),
                                                                                                (11, 2, 18, 3000),
                                                                                                (10, 9, 70, 3000),
                                                                                                (10, 8, 18, 3000),
                                                                                                (10, 7, 18, 3000),
                                                                                                (10, 5, 18, 3000),
                                                                                                (10, 3, 18, 3000),
                                                                                                (10, 2, 18, 3000),
                                                                                                (9, 8, 51, 3000),																																												
                                                                                                (9, 7, 18, 3000),
                                                                                                (9, 5, 18, 3000),
                                                                                                (9, 3, 18, 3000),
                                                                                                (9, 2, 18, 3000),
                                                                                                (8, 7, 50, 3000),                                                                                                
																								(8, 5, 18, 3000),
                                                                                                (8, 3, 18, 3000),
                                                                                                (8, 2, 18, 3000),
																								(7, 5, 48, 3000),
																								(7, 3, 18, 3000),
                                                                                                (7, 2, 18, 3000),
                                                                                                (5, 3, 18, 3000),
																								(5, 2, 18, 3000),
																								(3, 2, 18, 3000),
                                                                                                
                                                                                                
                                                                                 
                                                                                 
																								(1, 3, 13, 4000),/*C2 entre destinos AA BS AS*/
                                                                                                (1, 5, 13, 4000),
                                                                                                (1, 7, 13, 4000),
                                                                                                (1, 8, 13, 4000),
                                                                                                (1, 9, 13, 4000),
                                                                                                (1, 10, 13, 4000),
                                                                                                (1, 11, 13, 4000),
                                                                                                (3, 5, 13, 4000),
																								(3, 7, 32, 4000),
																								(3, 8, 33, 4000),
																								(3, 9, 35, 4000),
																								(3, 10, 50, 4000),
																								(3, 11, 52, 4000),
                                                                                                (5, 7, 32, 4000),
                                                                                                (5, 8, 33, 4000),
																								(5, 9, 35, 4000),
																								(5, 10, 50, 4000),
																								(5, 11, 52, 4000),
																								(7, 8, 33, 4000),
                                                                                                (7, 9, 35, 4000),
																								(7, 10, 50, 4000),
																								(7, 11, 52, 4000),
																								(8, 9, 35, 4000),
                                                                                                (8, 10, 50, 4000),
																								(8, 11, 52, 4000),
																								(9, 10, 50, 4000),
                                                                                                (9, 11, 52, 4000),
																								(10, 11, 52, 4000),
																								
                                                                                                (11, 10, 52, 4000),  /*C2 entre destinos AA al revez BS AS*/
                                                                                                (11, 9, 52, 4000),
                                                                                                (11, 8, 52, 4000), 
                                                                                                (11, 7, 52, 4000),
                                                                                                (11, 5, 52, 4000),
                                                                                                (11, 3, 52, 4000),
                                                                                                (11, 1, 52, 4000),
                                                                                                (10, 9, 50, 4000),
                                                                                                (10, 8, 50, 4000),
                                                                                                (10, 7, 50, 4000),
                                                                                                (10, 5, 50, 4000),
																								(10, 3, 50, 4000),
                                                                                                (10, 1, 50, 4000),
                                                                                                (9, 8, 35, 4000),
                                                                                                (9, 7, 35, 4000),
                                                                                                (9, 5, 35, 4000),
																								(9, 3, 35, 4000),
                                                                                                (9, 1, 35, 4000),
                                                                                                (8, 7, 33, 4000),
                                                                                                (8, 5, 33, 4000),
                                                                                                (8, 3, 33, 4000),
																								(8, 1, 33, 4000),
																								(7, 5, 32, 4000),
																								(7, 3, 32, 4000),
                                                                                                (7, 1, 32, 4000),
																								(5, 3, 13, 4000),
                                                                                                (5, 1, 13, 4000),
																								(3, 1, 13, 4000),
                                                                                                
                                                                                                (2, 3, 13, 4000),/*C2 entre destinos AA ANKARA*/
                                                                                                (2, 5, 13, 4000),
                                                                                                (2, 7, 13, 4000),
                                                                                                (2, 8, 13, 4000),
                                                                                                (2, 9, 13, 4000),
                                                                                                (2, 10, 13, 4000),
                                                                                                (2, 11, 13, 4000),                                                                                                
                                                                                                (3, 5, 13, 4000),
																								(3, 7, 32, 4000),
																								(3, 8, 33, 4000),
																								(3, 9, 35, 4000),
																								(3, 10, 50, 4000),
																								(3, 11, 52, 4000),
                                                                                                (5, 7, 32, 4000),
                                                                                                (5, 8, 33, 4000),
																								(5, 9, 35, 4000),
																								(5, 10, 50, 4000),
																								(5, 11, 52, 4000),
																								(7, 8, 33, 4000),
                                                                                                (7, 9, 35, 4000),
																								(7, 10, 50, 4000),
																								(7, 11, 52, 4000),
																								(8, 9, 35, 4000),
                                                                                                (8, 10, 50, 4000),
																								(8, 11, 52, 4000),
																								(9, 10, 50, 4000),
                                                                                                (9, 11, 52, 4000),
																								(10, 11, 52, 4000),
																								
                                                                                                (11, 10, 52, 4000),  /*C2 entre destinos AA al revez BS AS*/
                                                                                                (11, 9, 52, 4000),
                                                                                                (11, 8, 52, 4000), 
                                                                                                (11, 7, 52, 4000),
                                                                                                (11, 5, 52, 4000),
                                                                                                (11, 3, 52, 4000),
                                                                                                (11, 2, 52, 4000),
                                                                                                (10, 9, 50, 4000),
                                                                                                (10, 8, 50, 4000),
                                                                                                (10, 7, 50, 4000),
                                                                                                (10, 5, 50, 4000),
																								(10, 3, 50, 4000),
                                                                                                (10, 2, 50, 4000),
                                                                                                (9, 8, 35, 4000),
                                                                                                (9, 7, 35, 4000),
                                                                                                (9, 5, 35, 4000),
																								(9, 3, 35, 4000),
                                                                                                (9, 2, 35, 4000),
                                                                                                (8, 7, 33, 4000),
                                                                                                (8, 5, 33, 4000),
                                                                                                (8, 3, 33, 4000),
																								(8, 2, 33, 4000),
																								(7, 5, 32, 4000),
																								(7, 3, 32, 4000),
                                                                                                (7, 2, 32, 4000),
																								(5, 3, 13, 4000),
                                                                                                (5, 2, 13, 4000),
																								(3, 2, 13, 4000);
                                                                                                
															/*hacer vuelos trayecto*/
                                                        
						
INSERT INTO vuelo_trayecto (fk_vuelo, fk_trayecto) VALUES 	(1,1), (2,2), (6,6),
															(8,7),(8,8),(8,9),(8,10),(8,11),(8,12),(8,13),(8,14),(8,15),(8,16), /*C1 BA BS AS*/
                                                            (9,17),(9,18),(9,19),(9,20),(9,21),(9,22),(9,23),(9,24),(9,25),(9,26), /*C1 BA al revez BS AS*/
                                                            (10,27),(10,28),(10,29),(10,30),(10,31),(10,32),(10,33),(10,34),(10,35),(10,36), /*C1 BA ANKARA*/
                                                            (11,37),(11,38),(11,39),(11,40),(11,41),(11,42),(11,43),(11,44),(11,45),(11,46), /*C1 BA al revez ANKARA*/
                                                            
														    (12,47),(12,48),(12,49),(12,50),(12,51),(12,52),(12,53),(12,54),(12,55),(12,56), /*C1 AA BS AS*/
															(13,57),(13,58),(13,59),(13,60),(13,61),(13,62),(13,63),(13,64),(13,65),(13,66), /*C1 AA al revez BS AS*/
                                                            (14,67),(14,68),(14,69),(14,70),(14,71),(14,72),(14,73),(14,74),(14,75),(14,76), /*C1 AA ANKARA*/
															(15,77),(15,78),(15,79),(15,80),(15,81),(15,82),(15,83),(15,84),(15,85),(15,86), /*C1 AA al revez ANKARA*/
                                                            
                                                            (16,87),(16,88),(16,89),(16,90),(16,91),(16,92),(16,93),(16,94),(16,95),(16,96),(16,97),(16,98),(16,99),(16,100),(16,101),(16,102),(16,103),(16,104),(16,105),(16,106),(16,107),(16,108),(16,109),(16,110),(16,111),(16,112),(16,113),(16,114), /*C2 BA BS AS*/
                                                            (17,115),(17,116),(17,117),(17,118),(17,119),(17,120),(17,121),(17,122),(17,123),(17,124),(17,125),(17,126),(17,127),(17,128),(17,129),(17,130),(17,131),(17,132),(17,133),(17,134),(17,135),(17,136),(17,137),(17,138),(17,139),(17,140),(17,141),(17,142), /*C2 BA al revez BS AS*/
                                                            (18,143),(18,144),(18,145),(18,146),(18,147),(18,148),(18,149),(18,150),(18,151),(18,152),(18,153),(18,154),(18,155),(18,156),(18,157),(18,158),(18,159),(18,160),(18,161),(18,162),(18,163),(18,164),(18,165),(18,166),(18,167),(18,168),(18,169),(18,170), /*C2 BA ANKARA*/
                                                            (19,171),(19,172),(19,173),(19,174),(19,175),(19,176),(19,177),(19,178),(19,179),(19,180),(19,181),(19,182),(19,183),(19,184),(19,185),(19,186),(19,187),(19,188),(19,189),(19,190),(19,191),(19,192),(19,193),(19,194),(19,195),(19,196),(19,197),(19,198), /*C2 BA al revez ANKARA*/
                                                            
                                                            
                                                            (20,199),(20,200),(20,201),(20,202),(20,203),(20,204),(20,205),(20,206),(20,207),(20,208),(20,209),(20,210),(20,211),(20,212),(20,213),(20,214),(20,215),(20,216),(20,217),(20,218),(20,219),(20,220),(20,221),(20,222),(20,223),(20,224),(20,225),(20,226), /*C2 AA BS AS*/
                                                            (21,227),(21,228),(21,229),(21,230),(21,231),(21,232),(21,233),(21,234),(21,235),(21,236),(21,237),(21,238),(21,239),(21,240),(21,241),(21,242),(21,243),(21,244),(21,245),(21,246),(21,247),(21,248),(21,249),(21,250),(21,251),(21,252),(21,253),(21,254), /*C2 AA al revez BS AS*/
                                                            (22,255),(22,256),(22,257),(22,258),(22,259),(22,260),(22,261),(22,262),(22,263),(22,264),(22,265),(22,266),(22,267),(22,268),(22,269),(22,270),(22,271),(22,272),(22,273),(22,274),(22,275),(22,276),(22,277),(22,278),(22,279),(22,280),(22,281),(22,282), /*C2 AA ANKARA*/
                                                            (23,283),(23,284),(23,285),(23,286),(23,287),(23,288),(23,289),(23,290),(23,291),(23,292),(23,293),(23,294),(23,295),(23,296),(23,297),(23,298),(23,110),(23,299),(23,300),(23,301),(23,302),(23,303),(23,304),(23,305),(23,306),(23,307),(23,308),(23,309),(23,310); /*C2 AA al revez ANKARA*/

INSERT INTO medico (nombre, direccion)	VALUES ("Centro Medico Buenos Aires", "Av Rivadavia 11506"),
					                            ("Centro Medico Shanghai", "Boedo 1150"),
                                                ("Centro Medico Ankara","Marcos Paz 569");
                    


/*INSERT INTO turno (fecha, nick, fk_medico)
                            VALUES ('20191104',"admin" , 2);*/
                            
 
/*
----------Tablas usuario----------
SELECT * FROM login;
SELECT * FROM nivel_pasajero;
SELECT * FROM usuario;

----------Tablas vuelo----------
SELECT * FROM tipo_vuelo;
SELECT * FROM modelo;
SELECT * FROM cabina;
SELECT * FROM equipo;
SELECT * FROM nivel_modelo;
SELECT * FROM destino;
SELECT * FROM tipo_viaje;
SELECT * FROM vuelo;
SELECT * FROM trayecto;
SELECT * FROM vuelo_trayecto;

----------Tablas reserva----------
SELECT * FROM estado_reserva;
SELECT * FROM asientos_reservados;
SELECT * FROM reserva;
SELECT * FROM asientos_reserva;
SELECT * FROM lista_espera;
SELECT * FROM reserva_cancelada;
----------Tablas transaccion----------
SELECT * FROM estado_transaccion;
SELECT * FROM transaccion;

----------Tablas centro médico----------
SELECT * FROM medico;
SELECT * FROM turno;

INSERT INTO asientos_reservados (numero_asiento, numero_reserva) VALUES (1,652829274),(4,652829274),(6,652829274);
INSERT INTO asientos_reserva (fk_asientos_reservados,fk_reserva) VALUES (1,1),(2,1),(3,1);

UPDATE usuario SET fk_nivel=1;

UPDATE vuelo SET dia_partida='20191201', hora_partida=23 WHERE id_vuelo=20;
UPDATE vuelo SET dia_partida='20191212', hora_partida=17 WHERE id_vuelo=10;

UPDATE reserva SET fk_estado_reserva=3 WHERE id_reserva=1;
UPDATE turno SET fecha='20191118' WHERE id_turno=1;

UPDATE asientos_reserva SET fk_asientos_reservados=null, fk_reserva=null WHERE id_asientos_reserva=7;
UPDATE asientos_reservados SET numero_asiento=5 WHERE id_asientos_reservados=5;

ALTER TABLE transaccion ADD nro_tarjeta INT;
ALTER TABLE transaccion ADD tipo_tarjeta VARCHAR(20);
*/               
