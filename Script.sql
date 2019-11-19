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

/*----------Tablas transaccion----------*/
CREATE TABLE estado_transaccion(id_estado_transaccion INT PRIMARY KEY NOT NULL, descripcion VARCHAR(50));
CREATE TABLE transaccion(id_transaccion INT PRIMARY KEY AUTO_INCREMENT NOT NULL, cod_transaccion VARCHAR(50) NOT NULL, fk_login INT NOT NULL, fk_estado_transaccion INT, fecha DATE NOT NULL, hora time NOT NULL, zona_horaria VARCHAR(50) NOT NULL, nro_reserva INT NOT NULL, FOREIGN KEY (fk_login) REFERENCES login(id_login),FOREIGN KEY (fk_estado_transaccion) REFERENCES estado_transaccion(id_estado_transaccion));

/*----------Tablas centro médico----------*/
CREATE TABLE medico (id_medico INT PRIMARY KEY AUTO_INCREMENT NOT NULL, nombre VARCHAR(60) NOT NULL, direccion VARCHAR(70) NOT NULL);
CREATE TABLE turno (id_turno INT PRIMARY KEY AUTO_INCREMENT NOT NULL, fecha DATE, nombre VARCHAR(50) NOT NULL, fk_medico INT NOT NULL, fk_login INT NOT NULL,
                    FOREIGN KEY(fk_medico) REFERENCES medico(id_medico), FOREIGN KEY(fk_login) REFERENCES login(id_login));


/*--------------------------------------INSERTS--------------------------------------*/

/*----------Administrador----------*/
INSERT INTO  login (userConfirmado, hashConfirmacion, nick, password) VALUES (true,"f50686d5dc72f5d073c5295937bc58ce","admin", "e67732763718fbafa22f23adb5679c2f");
INSERT INTO  usuario (nombre, mail, rol, fk_login) VALUES ("admin", "admin@gauchorocket.com", 2,1) ;
/*---------------------------------*/

INSERT INTO estado_transaccion(id_estado_transaccion, descripcion) VALUES (0,"Error de datos"),(1,"Correcto");

INSERT INTO estado_reserva(id_estado_reserva, descripcion) VALUES (1, "Confirmada"), (2,"Pendiente"), (3,"Abonada y pendiente"), (4,"Cancelada"),(5,"En lista de espera");

INSERT INTO tipo_vuelo (id_tipo_vuelo, descripcion) VALUES (1,"Orbital"),(2,"Baja aceleración"),(3,"Alta aceleración");
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
                                                (8, "AA4"), (8, "AA8"), (8, "AA12"), (8, "AA16"),  
												(9, "AA3"), (9, "AA7"), (9, "AA11"), (9, "AA15"), (9, "AA19"), 
                                                (10, "BA1"), (10, "BA2"), (10, "BA3");
                                                                     
                                                                     
INSERT INTO destino (id_destino, descripcion) VALUES (1, "Buenos Aires"), (2, "Ankara"),(3,"Estacion Espacial Internacional"),(4,"Orbital Hotel"), (5, "Luna"), (6,"Marte"),(7,"Ganimedes"), (8, "Europa"), (9, "Io"), (10, "Encelado"), (11, "Titan");
INSERT INTO tipo_viaje (id_tipo_viaje, descripcion) VALUES (1, "Suborbital"), (2, "Tour"), (3,"Entre destinos");

INSERT INTO vuelo (fk_equipo, fk_tipo_viaje, hora_partida, dia_partida) VALUES 		(3, 1, 23, '20191116'), /*orbitales*/
																					(24, 1, 15, '20191001'),
																					(11, 1, 17, '20191002'),
																					(25, 1, 18, '20191002'),
																					(12, 1, 09, '20201107'),
																					(34, 2, 12, '20191027'),/*tour*/
																					(35, 2, 22, '20201103'),
                                                                                    
																					(6, 3, 08, '20191001'), /*C1 entre destinos BA*/
                                                                                    (6, 3, 14, '20191113'), /*C1 entre destinos BA al revez */ /*cambio para probar 20191101*/ 

																					(38, 3, 14, '20190802'),/*C1 entre destinos AA*/
                                                                                    (38, 3, 14, '20190902'),/*C1 entre destinos AA al revez*/
                                                                                    
																					
																					(43, 3, 08, '20201002'),/*C2 entre destinos BA*/
                                                                                    (43, 3, 08, '20201102'),/*C2 entre destinos BA al revez*/
                                                                                    
																					(39, 3, 20, '20200802'),/*C2 entre destinos AA*/
																					(39, 3, 20, '20210902');/*C2 entre destinos AA al revez*/



INSERT INTO trayecto (fk_punto_partida, fk_punto_llegada, duracion, precio) VALUES 				(1, 1, 8, 800), /*orbitales*/
																								(2, 2, 8, 800),
																								(1, 1, 8, 800),
																								(2, 2, 8, 800),
																								(1, 1, 840, 5000),/*tour*/
																								(1, 1, 840, 5000),
                                                                                    
																								(3, 4, 5, 1000),/*C1 entre destinos BA*/
																								(3, 5, 5, 1000),
                                                                                                (3, 6, 5, 1000),
                                                                                                (4, 5, 16, 1000),
																								(4, 6, 26, 1000),
                                                                                                (5, 6, 26, 1000),
                                                                                                                                                                        
																								(6, 5, 26, 1000),	/*C1 entre destinos BA al revez*/
																								(6, 4, 26, 1000),                                                                                                
                                                                                                (6, 3, 5, 1000),
                                                                                                (5, 4, 16, 1000),
                                                                                                (5, 3, 5, 1000),
                                                                                                (4, 3, 5, 1000),
                                                                                                                                                                                  
																								(3, 4, 4, 2000),/*C1 entre destinos AA*/
																								(3, 5, 9, 2000),
																								(3, 6, 22, 2000),
                                                                                                (4, 5, 4, 2000),
																								(4, 6, 9, 2000),
																								(5, 6, 22, 2000),
                                                                                   
																								(6, 5, 22, 2000),
                                                                                                (6, 4, 9, 2000),
                                                                                                (6, 3, 22, 2000),
                                                                                                (5, 4, 4, 2000),                                                                                                
                                                                                                (5, 3, 9, 2000),
                                                                                                (4, 3, 4, 2000),/*C1 entre destinos AA al revez*/
                                                                                                                                                                     
																								(3, 5, 18, 3000),/*C2 entre destinos BA*/
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
                                                                                            
																								(11, 10, 77, 3000), /*C2 entre destinos BA al revez*/
																								(11, 9, 18, 3000),
                                                                                                (11, 8, 18, 3000),
                                                                                                (11, 7, 18, 3000),
                                                                                                (11, 5, 18, 3000),
                                                                                                (11, 3, 18, 3000),
                                                                                                (10, 9, 70, 3000),
                                                                                                (10, 8, 18, 3000),
                                                                                                (10, 7, 18, 3000),
                                                                                                (10, 5, 18, 3000),
                                                                                                (10, 3, 18, 3000),
                                                                                                (9, 8, 51, 3000),																																												
                                                                                                (9, 7, 18, 3000),
                                                                                                (9, 5, 18, 3000),
                                                                                                (9, 3, 18, 3000),
                                                                                                (8, 7, 50, 3000),                                                                                                
																								(8, 5, 18, 3000),
                                                                                                (8, 3, 18, 3000),
																								(7, 5, 48, 3000),
																								(7, 3, 18, 3000),
                                                                                                (5, 3, 18, 3000),
                                                                                    
																								(3, 5, 13, 4000),/*C2 entre destinos AA*/
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
																								
                                                                                                (11, 10, 52, 4000),  /*C2 entre destinos AA al revez*/
                                                                                                (11, 9, 52, 4000),
                                                                                                (11, 8, 52, 4000), 
                                                                                                (11, 7, 52, 4000),
                                                                                                (11, 5, 52, 4000),
                                                                                                (11, 3, 52, 4000),
                                                                                                (10, 9, 50, 4000),
                                                                                                (10, 8, 50, 4000),
                                                                                                (10, 7, 50, 4000),
                                                                                                (10, 5, 50, 4000),
																								(10, 3, 50, 4000),
                                                                                                (9, 8, 35, 4000),
                                                                                                (9, 7, 35, 4000),
                                                                                                (9, 5, 35, 4000),
																								(9, 3, 35, 4000),
                                                                                                (8, 7, 33, 4000),
                                                                                                (8, 5, 33, 4000),
                                                                                                (8, 3, 33, 4000),
																								(7, 5, 32, 4000),
																								(7, 3, 32, 4000),
																								(5, 3, 13, 4000);
															
						
INSERT INTO vuelo_trayecto (fk_vuelo, fk_trayecto) VALUES 	(1,1), (2,2), (6,6),
															(8,7),(8,8),(8,9),(8,10),(8,11),(8,12), /*C1 BA*/
                                                            (9,13),(9,14),(9,15),(9,16),(9,17),(9,18), /*C1 BA al revez*/
														    (10,19),(10,20),(10,21),(10,22),(10,23),(10,24), /*C1 AA*/
															(11,25),(11,26),(11,27),(11,28),(11,29),(11,30), /*C1 AA al revez*/
                                                            (12,31),(12,32),(12,33),(12,34),(12,35),(12,36),(12,37),(12,38),(12,39),(12,40),(12,41),(12,42),(12,43),(12,44),(12,45),(12,46),(12,47),(12,48),(12,49),(12,50),(12,51), /*C2 BA*/
                                                            (13,52),(13,53),(13,54),(13,55),(13,56),(13,57),(13,58),(13,59),(13,60),(13,61),(13,62),(13,63),(13,64),(13,65),(13,66),(13,67),(13,68),(13,69),(13,70),(13,71),(13,72), /*C2 BA al revez*/
                                                            (14,73),(14,74),(14,75),(14,76),(14,77),(14,78),(14,79),(14,80),(14,81),(14,82),(14,83),(14,84),(14,85),(14,86),(14,87),(14,88),(14,89),(14,90),(14,91),(14,92),(14,93), /*C2 AA*/
                                                            (15,94),(15,95),(15,96),(15,97),(15,98),(15,99),(15,100),(15,101),(15,102),(15,103),(15,104),(15,105),(15,106),(15,107),(15,108),(15,109),(15,110),(15,111),(15,112),(15,113),(15,114); /*C2 AA al revez*/
                                                            





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

----------Tablas transaccion----------
SELECT * FROM estado_transaccion;
SELECT * FROM transaccion;

----------Tablas centro médico----------
SELECT * FROM medico;
SELECT * FROM turno;



SELECT vuelo.id_vuelo, vuelo.dia_partida fecha_ida, d1.descripcion origen, d0.descripcion destino, tipo_viaje.descripcion tipo_viaje
            FROM vuelo
            JOIN trayecto ON vuelo.id_vuelo = trayecto.fk_id_vuelo
            JOIN destino d0 ON trayecto.fk_punto_llegada = d0.id_destino
            JOIN destino d1 ON trayecto.fk_punto_partida = d1.id_destino
            JOIN tipo_viaje ON vuelo.fk_tipo_viaje = tipo_viaje.id_tipo_viaje
WHERE d1.descripcion='Europa' OR d0.descripcion='Encelado';


SELECT cabina.capacidad FROM vuelo
       JOIN equipo on vuelo.fk_equipo = equipo.id_equipo
       JOIN modelo on modelo.id_modelo = equipo.fk_modelo
       JOIN cabina on cabina.fk_id_modelo = modelo.id_modelo
WHERE vuelo.id_vuelo = 13 AND cabina.descripcion = 'f';
                                        

SELECT reserva.cantidad_lugares cantidad_lugares FROM reserva
        JOIN vuelo ON reserva.fk_vuelo = vuelo.id_vuelo
        JOIN equipo ON equipo.id_equipo = vuelo.fk_equipo
        JOIN modelo ON equipo.fk_modelo = modelo.id_modelo
WHERE reserva.tipo_cabina = "F" AND reserva.fk_vuelo = 1;

SELECT * FROM reserva JOIN login ON reserva.fk_login = login.id_login;

SELECT * FROM vuelo JOIN trayecto ON trayecto.fk_id_vuelo = vuelo.id_vuelo;

SELECT * FROM reserva
    JOIN vuelo_trayecto on reserva.fk_id_vuelo_trayecto = vuelo_trayecto.id_vuelo_trayecto
    JOIN trayecto ON vuelo_trayecto.fk_trayecto = trayecto.id_trayecto
    JOIN destino d0 ON trayecto.fk_punto_llegada = d0.id_destino
    JOIN destino d1 ON trayecto.fk_punto_partida = d1.id_destino;
                                            
SELECT reserva.cantidad_lugares cantidad_lugares FROM reserva
        JOIN vuelo_trayecto ON reserva.fk_id_vuelo_trayecto = vuelo_trayecto.id_vuelo_trayecto
        JOIN vuelo ON vuelo.id_vuelo = vuelo_trayecto.fk_vuelo
        JOIN trayecto ON trayecto.id_trayecto = vuelo_trayecto.fk_trayecto
        JOIN destino d0 ON trayecto.fk_punto_llegada = d0.id_destino
        JOIN destino d1 ON trayecto.fk_punto_partida = d1.id_destino
        WHERE reserva.tipo_cabina = 'S'
            AND vuelo_trayecto.fk_vuelo = 1
            AND vuelo_trayecto.fk_trayecto = 1
            AND  d0.id_destino= 1
            OR  d0.id_destino= 2
            OR  d0.id_destino= 3
            OR  d0.id_destino= 4
            OR  d0.id_destino= 5;

SELECT reserva.nro_reserva nro_reserva, reserva.tipo_cabina tipo_cabina, reserva.cantidad_lugares cantidad_lugares, vuelo.hora_partida hora_partida,
    vuelo.dia_partida fecha_ida, d1.descripcion origen, d0.descripcion destino, trayecto.precio precio, nivel_pasajero.id_numero nivel_pasajero,
    tipo_viaje.descripcion tipo_viaje, tipo_vuelo.descripcion tipo_vuelo, estado_reserva.descripcion estado_reserva
FROM reserva
    JOIN estado_reserva ON reserva.fk_estado_reserva = estado_reserva.id_estado_reserva
    JOIN login ON reserva.fk_login = login.id_login
    JOIN vuelo_trayecto ON reserva.fk_id_vuelo_trayecto = vuelo_trayecto.id_vuelo_trayecto
    JOIN vuelo ON vuelo_trayecto.fk_vuelo = vuelo.id_vuelo
    JOIN trayecto ON vuelo_trayecto.fk_trayecto = trayecto.id_trayecto
    JOIN destino d0 ON trayecto.fk_punto_llegada = d0.id_destino
    JOIN destino d1 ON trayecto.fk_punto_partida = d1.id_destino
    JOIN tipo_viaje ON vuelo.fk_tipo_viaje = tipo_viaje.id_tipo_viaje
    JOIN equipo ON vuelo.fk_equipo = equipo.id_equipo
    JOIN modelo ON equipo.fk_modelo = modelo.id_modelo
    JOIN nivel_pasajero ON nivel_pasajero.fk_id_modelo = modelo.id_modelo
    JOIN tipo_vuelo ON modelo.fk_tipo_vuelo = tipo_vuelo.id_tipo_vuelo WHERE login.nick ='admin';

SELECT login.nick nick, usuario.nombre nombre FROM login
    JOIN usuario ON usuario.fk_login = login.id_login
    JOIN reserva ON reserva.fk_login = login.id_login
WHERE reserva.nro_reserva = 1166377634 AND login.nick <> 'admin'

SELECT cabina.capacidad FROM reserva JOIN vuelo_trayecto on reserva.fk_id_vuelo_trayecto = vuelo_trayecto.id_vuelo_trayecto
						JOIN vuelo on vuelo.id_vuelo = vuelo_trayecto.fk_vuelo
                        JOIN equipo on equipo.id_equipo = vuelo.fk_equipo
                        JOIN modelo on modelo.id_modelo = equipo.fk_modelo
                        JOIN cabina on cabina.fk_id_modelo = modelo.id_modelo
WHERE reserva.nro_reserva = 1610062491 AND cabina.descripcion = (SELECT reserva.tipo_cabina FROM reserva
                                                                    WHERE reserva.nro_reserva  =1610062491);
SELECT equipo.matricula, modelo.descripcion, cabina.descripcion, cabina.capacidad FROM equipo
JOIN modelo ON equipo.fk_modelo = modelo. id_modelo
JOIN cabina ON cabina.fk_id_modelo = modelo.id_modelo ORDER BY equipo.id_equipo;



INSERT INTO asientos_reservados (numero_asiento, numero_reserva) VALUES (1,652829274),(4,652829274),(6,652829274);
INSERT INTO asientos_reserva (fk_asientos_reservados,fk_reserva) VALUES (1,1),(2,1),(3,1);


UPDATE usuario SET fk_nivel=null;
UPDATE vuelo SET dia_partida='20191119', hora_partida=3 WHERE id_vuelo=9;

UPDATE reserva SET fk_estado_reserva=3 WHERE id_reserva=1;
UPDATE turno SET fecha='20191118' WHERE id_turno=1;


*/

                                                                                            

select sum(trayecto.precio) precio from transaccion join reserva on transaccion.nro_reserva = reserva.nro_reserva join vuelo_trayecto ON reserva.fk_id_vuelo_trayecto = vuelo_trayecto.id_vuelo_trayecto join trayecto ON vuelo_trayecto.fk_trayecto = trayecto.id_trayecto WHERE transaccion.fecha BETWEEN '2019-11-01'AND '2019-11-30' 