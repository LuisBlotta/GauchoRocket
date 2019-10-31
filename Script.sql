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
create table trayecto (id_trayecto int primary key not null auto_increment,  fk_punto_partida int not null, fk_punto_llegada int not null, duracion int not null, precio int not null, foreign key(fk_punto_partida) references destino(id_destino), foreign key(fk_punto_llegada) references destino(id_destino));
create table vuelo_trayecto (id_vuelo_trayecto int not null primary key auto_increment, fk_vuelo int not null, fk_trayecto int not null, foreign key(fk_vuelo) references vuelo(id_vuelo), foreign key(fk_trayecto) references trayecto(id_trayecto));
    
/*Tablas reserva*/
create table reserva (id_reserva int primary key auto_increment, nro_reserva int not null, fk_id_vuelo_trayecto int not null,  fk_login int not null, tipo_cabina varchar(1), cantidad_lugares int, foreign key(fk_id_vuelo_trayecto) references vuelo_trayecto(id_vuelo_trayecto) ,foreign key(fk_login) references login(id_login) );


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
                                                                                    (6, 3, 08, '20191101'), /*C1 entre destinos BA al revez */

																					(38, 3, 14, '20190802'),/*C1 entre destinos AA*/
                                                                                    (38, 3, 14, '20190902'),/*C1 entre destinos AA al revez*/
                                                                                    
																					
																					(43, 3, 08, '20201002'),/*C2 entre destinos BA*/
                                                                                    (43, 3, 08, '20201102'),/*C2 entre destinos BA al revez*/
                                                                                    
																					(39, 3, 20, '20200802'),/*C2 entre destinos AA*/
																					(39, 3, 20, '20210902');/*C2 entre destinos AA al revez*/



INSERT INTO trayecto (fk_punto_partida, fk_punto_llegada, duracion, precio) values 				(1, 1, 8, 800), /*orbitales*/
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
																								
																								
																								
						
insert into vuelo_trayecto (fk_vuelo, fk_trayecto) values 	
															(8,7),(8,8),(8,9),(8,10),(8,11),(8,12), /*C1 BA*/
                                                            (8,13),(8,14),(8,15),(8,16),(8,17),(8,18), /*C1 BA al revez*/
														    (9,19),(9,20),(9,21),(9,22),(9,23),(9,24), /*C1 AA*/
															(9,25),(9,26),(9,27),(9,28),(9,29),(9,30), /*C1 AA al revez*/
                                                            (10,31),(10,32),(10,33),(10,34),(10,35),(10,36),(10,37),(10,38),(10,39),(10,40),(10,41),(10,42),(10,43),(10,44),(10,45),(10,46),(10,47),(10,48),(10,49),(10,50),(10,51), /*C2 BA*/
                                                            (10,52),(10,53),(10,54),(10,55),(10,56),(10,57),(10,58),(10,59),(10,60),(10,61),(10,62),(10,63),(10,64),(10,65),(10,66),(10,67),(10,68),(10,69),(10,70),(10,71),(10,72), /*C2 BA al revez*/
                                                            (11,73),(11,74),(11,75),(11,76),(11,77),(11,78),(11,79),(11,80),(11,81),(11,82),(11,83),(11,84),(11,85),(11,86),(11,87),(11,88),(11,89),(11,90),(11,91),(11,92),(11,93), /*C2 AA*/
                                                            (11,94),(11,95),(11,96),(11,97),(11,98),(11,99),(11,100),(11,101),(11,102),(11,103),(11,104),(11,105),(11,106),(11,107),(11,108),(11,109),(11,110),(11,111),(11,112),(11,113),(11,114); /*C2 AA al revez*/
                                                            


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
         
         
         
         
         */


            
            
            
SELECT vuelo_trayecto.id_vuelo_trayecto id_vuelo_trayecto ,vuelo_trayecto.fk_vuelo id_vuelo,  vuelo_trayecto.fk_trayecto id_trayecto, vuelo.dia_partida fecha_ida, d1.descripcion origen, d0.descripcion destino, d0.id_destino id_destino,tipo_viaje.descripcion tipo_viaje, tipo_vuelo.descripcion tipo_vuelo 
            FROM  vuelo_trayecto JOIN vuelo on  vuelo_trayecto.fk_vuelo = vuelo.id_vuelo
            JOIN trayecto ON vuelo_trayecto.fk_trayecto = trayecto.id_trayecto 
            JOIN destino d0 on trayecto.fk_punto_llegada = d0.id_destino
            JOIN destino d1 on trayecto.fk_punto_partida = d1.id_destino
            JOIN tipo_viaje on vuelo.fk_tipo_viaje = tipo_viaje.id_tipo_viaje
            JOIN equipo on vuelo.fk_equipo = equipo.id_equipo
            JOIN modelo on equipo.fk_modelo = modelo.id_modelo
            JOIN tipo_vuelo on modelo.fk_tipo_vuelo = tipo_vuelo.id_tipo_vuelo