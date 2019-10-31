drop database if exists gauchoRocket;
create database gauchoRocket;
use gauchoRocket;
create table login (id_login int primary key auto_increment,
					userConfirmado boolean not null,
                    hashConfirmacion varchar(50) not null,
					nick varchar(50) not null,
                    password varchar(50) not null);
                    
create table usuario (id_usuario int primary key auto_increment, 
						nombre varchar(50) not null,
                        mail varchar(50) not null,
                        rol int not null,
                        nivel_vuelo int,
                        fk_login int not null,
                        foreign key(fk_login) references login(id_login));


insert into  login (userConfirmado, hashConfirmacion, nick, password) values (true,"f50686d5dc72f5d073c5295937bc58ce","admin", "e67732763718fbafa22f23adb5679c2f");
insert into  usuario (nombre, mail, rol, fk_login) values ("admin", "admin@gauchorocket.com", 2,1) ;                      
                        
create table tipo_vuelo (id_tipo_vuelo int primary key, descripcion varchar(20));                        
create table modelo (id_modelo int primary key, descripcion varchar(20) , fk_tipo_vuelo int not null, foreign key(fk_tipo_vuelo) references tipo_vuelo(id_tipo_vuelo));
create table cabina (fk_id_modelo int, descripcion varchar(20) not null, capacidad int not null, primary key (fk_id_modelo, descripcion), foreign key (fk_id_modelo) references modelo(id_modelo));
create table nivel_pasajero (fk_id_modelo int, id_numero int not null, primary key (fk_id_modelo, id_numero), foreign key (fk_id_modelo) references modelo(id_modelo));
create table equipo (id_equipo int primary key auto_increment, fk_modelo int not null, matricula varchar(10) not null, foreign key(fk_modelo)references modelo(id_modelo));

/*select equipo.matricula, modelo.descripcion, cabina.descripcion, cabina.capacidad from equipo join modelo on equipo.fk_modelo = modelo. id_modelo join cabina on cabina.fk_id_modelo = modelo.id_modelo order by equipo.id_equipo;*/

create table destino (id_destino int primary key, descripcion varchar(50) not null);
create table tipo_viaje (id_tipo_viaje int primary key, descripcion varchar(20));
create table vuelo (id_vuelo int primary key auto_increment, fk_equipo int not null, fk_tipo_viaje int not null, hora_partida int not null, dia_partida date not null, foreign key(fk_tipo_viaje) references tipo_viaje(id_tipo_viaje) ,foreign key(fk_equipo) references equipo(id_equipo));
create table trayecto (id_trayecto int not null , fk_id_vuelo int not null,  fk_punto_partida int not null, fk_punto_llegada int not null, duracion int not null, precio int not null, primary key(fk_id_vuelo, id_trayecto),foreign key(fk_id_vuelo) references vuelo(id_vuelo) ,foreign key(fk_punto_partida) references destino(id_destino), foreign key(fk_punto_llegada) references destino(id_destino));

    
/*Tablas reserva*/
create table reserva (id_reserva int primary key auto_increment, fk_id_vuelo int not null, fk_trayecto int not null, nro_reserva int not null, fk_login int not null, tipo_cabina varchar(1), cantidad_lugares int, foreign key(fk_id_vuelo, fk_trayecto) references trayecto( fk_id_vuelo, id_trayecto) ,foreign key(fk_login) references login(id_login) );


INSERT INTO tipo_vuelo (id_tipo_vuelo, descripcion) values (1,"Orbital"),(2,"Baja aceleración"),(3,"Alta aceleración");
INSERT INTO modelo (id_modelo, descripcion, fk_tipo_vuelo) values (1, "Aguila",3), (2, "Aguilucho",2), (3, "Calandria",1), (4, "Canario",2), (5, "Carancho",2), (6, "Colibri",1), (7, "Condor",3), (8, "Guanaco",3), (9, "Halcon",3), (10, "Zorzal",2);

INSERT INTO cabina (fk_id_modelo, descripcion, capacidad) values (1, "G", 200), (1, "F", 75), (1, "S", 25) ,
															  (2, "G", 0), (2, "F", 50), (2, "S", 10),	
                                                              (3, "G", 200), (3, "F", 75), (3, "S", 25),
                                                              (4, "G", 0), (4, "F", 70), (4, "S", 10),	
                                                              (5, "G", 100), (5, "F", 0), (5, "S", 0),	
                                                              (6, "G", 100), (6, "F", 18), (6, "S", 2),	
                                                              (7, "G", 300), (7, "F", 10), (7, "S", 40),	
                                                              (8, "G", 0), (8, "F", 0), (8, "S", 100),	
                                                              (9, "G", 150), (9, "F", 25), (9, "S", 25),	
                                                              (10, "G", 50), (10, "F", 50), (10, "S", 0);	
INSERT INTO nivel_pasajero (fk_id_modelo,id_numero) values (1,2), (1,3),
													  (2,2), (2,3),
													  (3,1), (3,2), (3,3),
													  (4,2), (4,3),
                                                      (5,2), (5,3),
                                                      (6,1), (6,2), (6,3),
                                                      (7,2), (7,3),
                                                      (8,3),
                                                      (9,3),
                                                      (10,2), (10,3);
INSERT INTO equipo (fk_modelo, matricula) values   (1, "AA1"),(1, "AA5"), (1, "AA9"), (1, "AA13"), (1, "AA17"),
											    (2, "BA8"), (2, "BA9"), (2, "BA10"), (2, "BA11"), (2, "BA12"),
												(3, "O1"), (3, "O2"), (3, "O6"), (3, "O7"),
												(4, "BA13"), (4, "BA14"), (4, "BA15"), (4, "BA16"), (4, "BA17"),
                                                (5, "BA4"), (5, "BA5"), (5, "BA6"), (5, "BA7"), 
                                                (6, "O3"), (6, "O4"), (6, "O5"), (6, "O8"), (6, "O9"), 
												(7, "AA2"), (7, "AA6"), (7, "AA10"), (7, "AA14"), (7, "AA18"),
                                                (8, "AA4"), (8, "AA8"), (8, "AA12"), (8, "AA16"),  
												(9, "AA3"), (9, "AA7"), (9, "AA11"), (9, "AA15"), (9, "AA19"), 
                                                (10, "BA1"), (10, "BA2"), (10, "BA3");
                                                                     
                                                                     
INSERT INTO destino (id_destino, descripcion) values (1, "Buenos Aires"), (2, "Ankara"),(3,"Estacion Espacial Internacional"),(4,"Orbital Hotel"), (5, "Luna"), (6,"Marte"),(7,"Ganimedes"), (8, "Europa"), (9, "Io"), (10, "Encelado"), (11, "Titan");                                                                    
INSERT INTO tipo_viaje (id_tipo_viaje, descripcion) values (1, "Suborbital"), (2, "Tour"), (3,"Entre destinos");         

INSERT INTO vuelo (fk_equipo, fk_tipo_viaje, hora_partida, dia_partida) values 		(3, 1, 12, '20191001'), /*orbitales*/
																					(24, 1, 15, '20191001'),
																					(11, 1, 17, '20191002'),
																					(25, 1, 18, '20191002'),
																					(12, 1, 09, '20201107'),
																					(34, 2, 12, '20191027'),/*tour*/
																					(35, 2, 22, '20201103'),
                                                                                    
																					(6, 3, 08, '20191001'), /*C1 entre destinos BA*/
                                                                                    (6, 3, 08, '20201001'), /*C1 entre destinos BA al revez */

																					(38, 3, 14, '20191002'),/*C1 entre destinos AA*/
                                                                                    (38, 3, 14, '20201002'),/*C1 entre destinos AA al revez*/
                                                                                    
																					
																					(43, 3, 08, '20201002'),/*C2 entre destinos BA*/
                                                                                    (43, 3, 08, '20211002'),/*C2 entre destinos BA al revez*/
                                                                                    
																					(39, 3, 20, '20200802'),/*C2 entre destinos AA*/
																					(39, 3, 20, '20210802');/*C2 entre destinos AA al revez*/



INSERT INTO trayecto (id_trayecto, fk_id_vuelo, fk_punto_partida, fk_punto_llegada, duracion, precio) values (1,1,1, 1, 8, 800), /*orbitales*/
																								(2,2,2, 2, 8, 800),
																								(3,3,1, 1, 8, 800),
																								(4,4,2, 2, 8, 800),
																								(5,6,1, 1, 840, 5000),/*tour*/
																								(6,7,1, 1, 840, 5000),
																					
                                                                                    
																								(7,8,3, 4, 5, 1000),/*C1 entre destinos BA*/
																								(8,8,3, 5, 5, 1000),
                                                                                                (9,8,3, 6, 5, 1000),
                                                                                                (10,8,4, 5, 16, 1000),
																								(11,8,4, 6, 26, 1000),
                                                                                                (12,8,5, 6, 26, 1000),
                                                                                    
																								(13,8,4, 3, 5, 1000),/*C1 entre destinos BA al revez*/
																								(14,8,5, 3, 5, 1000),
                                                                                                (15,8,6, 3, 5, 1000),
                                                                                                (16,8,5, 4, 16, 1000),
																								(17,8,6, 4, 26, 1000),
                                                                                                (18,8,6, 5, 26, 1000),
                                                                                    
																								(19,10,3, 4, 4, 2000),/*C1 entre destinos AA*/
																								(20,10,3, 5, 9, 2000),
																								(21,10,3, 6, 22, 2000),
                                                                                                (22,10,4, 5, 4, 2000),
																								(23,10,4, 6, 9, 2000),
																								(24,10,5, 6, 22, 2000),
																				
                                                                                   
																								(25,10,4, 3, 4, 2000),/*C1 entre destinos AA al revez*/
																								(26,10,5, 3, 9, 2000),
																								(27,10,6, 3, 22, 2000),
                                                                                                (28,10,5, 4, 4, 2000),
																								(29,10,6, 4, 9, 2000),
																								(30,10,6, 5, 22, 2000),
																				
                                                                                    
                                                                                                                                                                     
																								(31,12,3, 5, 18, 3000),/*C2 entre destinos BA*/
																								(32,12,3, 7, 18, 3000),
                                                                                                (33,12,3, 8, 18, 3000),
                                                                                                (34,12,3, 9, 18, 3000),
                                                                                                (35,12,3, 10, 18, 3000),
                                                                                                (36,12,3, 11, 18, 3000),
                                                                                                (37,12,5, 7, 48, 3000),
																								(38,12,5, 8, 18, 3000),
                                                                                                (39,12,5, 9, 18, 3000),
                                                                                                (40,12,5, 10, 18, 3000),
                                                                                                (41,12,5, 11, 18, 3000),
																								(42,12,7, 8, 50, 3000),
                                                                                                (43,12,7, 9, 18, 3000),
                                                                                                (44,12,7, 10, 18, 3000),
                                                                                                (45,12,7, 11, 18, 3000),
																								(46,12,8, 9, 51, 3000),
                                                                                                (47,12,8, 10, 18, 3000),
                                                                                                (48,12,8, 11, 18, 3000),
																								(49,12,9, 10, 70, 3000),
                                                                                                (50,12,9, 11, 18, 3000),
																								(51,12,10, 11, 77, 3000),
																							
                                                                                                (52,12,5, 3, 18, 3000),/*C2 entre destinos BA al revez*/
																								(53,12,7, 3, 18, 3000),
                                                                                                (54,12,8, 3, 18, 3000),
                                                                                                (55,12,9, 3, 18, 3000),
                                                                                                (56,12,10, 3, 18, 3000),
                                                                                                (57,12,11, 3, 18, 3000),
                                                                                                (58,12,7, 5, 48, 3000),
																								(59,12,8, 5, 18, 3000),
                                                                                                (60,12,9, 5, 18, 3000),
                                                                                                (61,12,10, 5, 18, 3000),
                                                                                                (62,12,11, 5, 18, 3000),
																								(63,12,8, 7, 50, 3000),
                                                                                                (64,12,9, 7, 18, 3000),
                                                                                                (65,12,10, 7, 18, 3000),
                                                                                                (66,12,11, 7, 18, 3000),
																								(67,12,9, 8, 51, 3000),
                                                                                                (68,12,10, 8, 18, 3000),
                                                                                                (69,12,11, 8, 18, 3000),
																								(70,12,10, 9, 70, 3000),
                                                                                                (71,12,11, 9, 18, 3000),
																								(72,12,11, 10, 77, 3000),
                                                                                            
																								
                                                                                    
																								(73,14,3, 5, 13, 4000),/*C2 entre destinos AA*/
																								(74,14,3, 7, 32, 4000),
																								(75,14,3, 8, 33, 4000),
																								(76,14,3, 9, 35, 4000),
																								(77,14,3, 10, 50, 4000),
																								(78,14,3, 11, 52, 4000),
                                                                                                (79,14,5, 7, 32, 4000),
                                                                                                (80,14,5, 8, 33, 4000),
																								(81,14,5, 9, 35, 4000),
																								(82,14,5, 10, 50, 4000),
																								(83,14,5, 11, 52, 4000),
																								(84,14,7, 8, 33, 4000),
                                                                                                (85,14,7, 9, 35, 4000),
																								(86,14,7, 10, 50, 4000),
																								(87,14,7, 11, 52, 4000),
																								(88,14,8, 9, 35, 4000),
                                                                                                (89,14,8, 10, 50, 4000),
																								(90,14,8, 11, 52, 4000),
																								(91,14,9, 10, 50, 4000),
                                                                                                (92,14,9, 11, 52, 4000),
																								(93,14,10, 11, 52, 4000),
                                                                                    
																								(94,14,5, 3, 13, 4000),/*C2 entre destinos AA al revez*/
																								(95,14,7, 3, 32, 4000),
																								(96,14,8, 3, 33, 4000),
																								(97,14,9, 3, 35, 4000),
																								(98,14,10, 3, 50, 4000),
																								(99,14,11, 3, 52, 4000),
                                                                                                (100,14,7, 5, 32, 4000),
                                                                                                (101,14,8, 5, 33, 4000),
																								(102,14,9, 5, 35, 4000),
																								(103,14,10, 5, 50, 4000),
																								(104,14,11, 5, 52, 4000),
																								(105,14,8, 7, 33, 4000),
                                                                                                (106,14,9, 7, 35, 4000),
																								(107,14,10, 7, 50, 4000),
																								(108,14,11, 7, 52, 4000),
																								(109,14,9, 8, 35, 4000),
                                                                                                (110,14,10, 8, 50, 4000),
																								(111,14,11, 8, 52, 4000),
																								(112,14,10, 9, 50, 4000),
                                                                                                (113,14,11, 9, 52, 4000),
																								(114,14,11, 10, 52, 4000);
																							



CREATE TABLE medico (id_medico int primary key auto_increment not null, nombre varchar(60) not null, direccion varchar(70) not null, turnos int not null); 

INSERT INTO medico (nombre, direccion, turnos)
			values ("Centro Medico Buenos Aires", "Av Rivadavia 11506", 300),
					("Centro Medico Shanghai", "Boedo 1150", 210),
                    ("Centro Medico Ankara","Marcos Paz 569", 200);

/*
SELECT vuelo.id_vuelo, vuelo.dia_partida fecha_ida, d1.descripcion origen, d0.descripcion destino, tipo_viaje.descripcion tipo_viaje FROM vuelo JOIN trayecto ON vuelo.id_vuelo = trayecto.fk_id_vuelo 
            JOIN destino d0 on trayecto.fk_punto_llegada = d0.id_destino
            JOIN destino d1 on trayecto.fk_punto_partida = d1.id_destino
            JOIN tipo_viaje on vuelo.fk_tipo_viaje = tipo_viaje.id_tipo_viaje
            where d1.descripcion='Europa' or d0.descripcion='Encelado';
            
            
select * from vuelo;	




SELECT cabina.capacidad FROM vuelo join
                                        equipo on vuelo.fk_equipo = equipo.id_equipo join
                                        modelo on modelo.id_modelo = equipo.fk_modelo join 
                                        cabina on cabina.fk_id_modelo = modelo.id_modelo 
                                        WHERE vuelo.id_vuelo = 4 AND cabina.descripcion = 'F';
                                        

select reserva.cantidad_lugares cantidad_lugares   from reserva join vuelo on reserva.fk_vuelo = vuelo.id_vuelo join equipo on equipo.id_equipo = vuelo.fk_equipo join modelo on equipo.fk_modelo = modelo.id_modelo  where reserva.tipo_cabina = "F" AND reserva.fk_vuelo = 1;                           

select * from reserva join login on reserva.fk_login = login.id_login;


         select * from usuario;      
         select * from login;      
         select * from trayecto;
         select * from vuelo join trayecto on trayecto.fk_id_vuelo = vuelo.id_vuelo
         select * from reserva
         
         
         
         
         insert INTO reserva (nro_reserva, fk_vuelo, fk_usuario) values (1752539895,12,'11')*/
         
         /*INSERT INTO usuario (nombre, mail, rol, fk_login) values ('$nick', '$mail',1,'6')*/
         
			/*SELECT vuelo.id_vuelo id_vuelo, vuelo.dia_partida fecha_ida, d1.descripcion origen, d0.descripcion destino, tipo_viaje.descripcion tipo_viaje, nivel_pasajero.id_numero nivel_pasajero         
            FROM vuelo JOIN trayecto ON vuelo.fk_trayecto = trayecto.id_trayecto 
                       JOIN destino d0 ON trayecto.fk_punto_llegada = d0.id_destino
                       JOIN destino d1 ON trayecto.fk_punto_partida = d1.id_destino
                       JOIN tipo_viaje ON vuelo.fk_tipo_viaje = tipo_viaje.id_tipo_viaje
                       JOIN equipo ON vuelo.fk_equipo = equipo.id_equipo
                       JOIN modelo ON equipo.fk_modelo = modelo.id_modelo
                       JOIN nivel_pasajero ON nivel_pasajero.fk_id_modelo = modelo.id_modelo
                       


SELECT trayecto.id_trayecto, vuelo.id_vuelo id_vuelo, vuelo.dia_partida fecha_ida, d1.descripcion origen, d0.descripcion destino, tipo_viaje.descripcion tipo_viaje, nivel_pasajero.id_numero nivel_pasajero, trayecto.precio precio         
            FROM vuelo JOIN trayecto ON vuelo.id_vuelo = trayecto.fk_id_vuelo
                       JOIN destino d0 ON trayecto.fk_punto_llegada = d0.id_destino
                       JOIN destino d1 ON trayecto.fk_punto_partida = d1.id_destino
                       JOIN tipo_viaje ON vuelo.fk_tipo_viaje = tipo_viaje.id_tipo_viaje
                       JOIN equipo ON vuelo.fk_equipo = equipo.id_equipo
                       JOIN modelo ON equipo.fk_modelo = modelo.id_modelo
                       JOIN nivel_pasajero ON nivel_pasajero.fk_id_modelo = modelo.id_modelo
            WHERE vuelo.id_vuelo =11 AND trayecto.id_trayecto = 18/*
            
            
            SELECT vuelo.dia_partida fecha_ida, d1.descripcion origen, d0.descripcion destino, tipo_viaje.descripcion tipo_viaje, tipo_vuelo.descripcion tipo_vuelo FROM vuelo JOIN trayecto ON vuelo.id_vuelo = trayecto.fk_id_vuelo 
            JOIN destino d0 on trayecto.fk_punto_llegada = d0.id_destino
            JOIN destino d1 on trayecto.fk_punto_partida = d1.id_destino
            JOIN tipo_viaje on vuelo.fk_tipo_viaje = tipo_viaje.id_tipo_viaje
            JOIN equipo on vuelo.fk_equipo = equipo.id_equipo
            JOIN modelo on equipo.fk_modelo = modelo.id_modelo
            JOIN tipo_vuelo on modelo.fk_tipo_vuelo = tipo_vuelo.id_tipo_vuelo
            */
            
			select reserva.nro_reserva numero_reserva,trayecto.id_trayecto ud_trayecto ,vuelo.id_vuelo,  d1.descripcion origen, d0.descripcion destino, vuelo.dia_partida fecha_ida from reserva 
            join trayecto on reserva.id_reserva = trayecto.id_trayecto 
            join vuelo on trayecto.fk_id_vuelo = vuelo.id_vuelo
             JOIN destino d0 on trayecto.fk_punto_llegada = d0.id_destino
            JOIN destino d1 on trayecto.fk_punto_partida = d1.id_destino
            JOIN tipo_viaje on vuelo.fk_tipo_viaje = tipo_viaje.id_tipo_viaje;


SELECT reserva.cantidad_lugares, reserva.nro_reserva nro_reserva,vuelo.dia_partida fecha_ida, vuelo.hora_partida hora_partida, d1.descripcion origen, d0.descripcion destino, tipo_viaje.descripcion tipo_viaje  FROM reserva 
    JOIN login ON reserva.fk_login = login.id_login                
    JOIN trayecto on reserva.id_reserva = trayecto.id_trayecto 
    JOIN vuelo on trayecto.fk_id_vuelo = vuelo.id_vuelo
    JOIN destino d0 ON trayecto.fk_punto_llegada = d0.id_destino
    JOIN destino d1 ON trayecto.fk_punto_partida = d1.id_destino
    JOIN tipo_viaje ON vuelo.fk_tipo_viaje = tipo_viaje.id_tipo_viaje
    WHERE login.nick ='admin'