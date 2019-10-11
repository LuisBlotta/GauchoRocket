drop database if exists gauchoRocket;
create database gauchoRocket;
use gauchoRocket;
create table login (id int primary key auto_increment,
					nick varchar(50) not null,
                    password varchar(50) not null);
                    
create table usuario (id int primary key auto_increment, 
						nombre varchar(50) not null,
                        mail varchar(50) not null,
                        rol int not null,
                        nivel_vuelo int,
                        login int not null,
                        foreign key(login) references login(id));
                        
            
/*------ VIAJES----*/
                        
create table destino (id int primary key auto_increment,
						nombre varchar (25) not null);
    
create table viaje (id int primary key auto_increment,
					dia varchar(15) not null,
					id_destino int not null,
					foreign key(id_destino) references destino(id));
                    
                    
create table tipo_viaje( id int primary key auto_increment,
						nombre varchar(15) not null,
                        duracion varchar(10) not null,
                        destino int not null,
                        id_viaje int not null,
                        foreign key(id_viaje) references viaje(id),
                        foreign key(destino) references destino(id));


create table cabina (id int primary key auto_increment,
					nombre varchar(25) not null);
                
create table nombre_modelo (id int primary key,
							nombre varchar (15));
                            
create table modelo (matricula varchar(10) primary key,
						id_nombre int not null,
                        foreign key(id_nombre) references nombre_modelo(id));
            

                        
create table equipo (id int primary key auto_increment,
					capacidad_total int not null,
                    nivel_vuelo int not null,
					matricula varchar(10),
                    foreign key(matricula) references modelo(matricula));

create table relacion_tipo_viaje ( id_viaje int,
									id_tipo int,
                                    primary key (id_viaje, id_tipo),
									foreign key(id_viaje) references viaje(id),
                                    foreign key(id_tipo) references tipo_viaje(id));
                                    
create table equipo_cabina (id_equipo int,
							id_cabina int,
                            primary key (id_equipo, id_cabina),
                            foreign key(id_equipo) references equipo(id),
                            foreign key(id_cabina) references cabina(id));

create table viaje_cabina (id_viaje int,
							id_cabina int,
                            capacidad int not null,
                            primary key (id_viaje, id_cabina),
                            foreign key(id_viaje) references viaje(id),
                            foreign key(id_cabina) references cabina(id));


INSERT INTO destino (id, nombre)
				values (1, "EEI"),
						(2, "OrbitalHotel"),
                        (3, "Luna"),
                        (4, "Marte"),
                        (5, "Ganimedes"),
                        (6, "Europa"),
                        (7, "Io"),
                        (8, "Encendalo"),
                        (9, "Titan"),
                        (10, "Ankara"),
                        (11, "Buenos Aires"),
                        (12, "Neptuno");
                        
                       
                        
INSERT INTO viaje (id, dia, id_destino)
			values (1, "L", 11),
					(2, "X", 1),
                    (3, "S", 10),
                    (4, "D", 6),
                    (5, "M", 4);
                    
/*------------------ NO TOCAR SIN CONSULTAR--------------*/
INSERT INTO nombre_modelo (id, nombre)
			values (1, "Aguila"),
					(2, "Aguilucho"),
                    (3, "Calandria"),
                    (4, "Canario"),
                    (5, "Carancho"),
                    (6, "Colibri"),
                    (7, "Condor"),
                    (8, "Guanaco"),
                    (9, "Halcon"),
                    (10, "Zorzal");
            
INSERT INTO cabina (id, nombre)
			values (1, "G"),
					(2, "F"),
                    (3, "S");
                    
INSERT INTO modelo (matricula, id_nombre)
			values ("AA1", 1),
					("AA5", 1),
                    ("AA9", 1),
                    ("AA13", 1),
                    ("AA17", 1),
                    ("BA8", 2),
                    ("BA9", 2),
                    ("BA10", 2),
                    ("BA11", 2),
                    ("BA12", 2),
                    ("O1", 3),
                    ("O2", 3),
                    ("O6", 3),
                    ("O7", 3),
                    ("BA13", 4),
                    ("BA14", 4),
                    ("BA15", 4),
                    ("BA16", 4),
                    ("BA17", 4),
                    ("BA4", 5),
                    ("BA5", 5),
                    ("BA6", 5),
                    ("BA7", 5),
                    ("O3", 6),
                    ("O4", 6),
                    ("O5", 6),
                    ("O8", 6),
                    ("O9", 6),
                    ("AA2", 7),
                    ("AA6", 7),
                    ("AA10", 7),
                    ("AA14", 7),
                    ("AA18", 7),
                    ("AA4", 8),
                    ("AA8", 8),
                    ("AA12", 8),
                    ("AA16", 8),
                    ("AA3", 9),
                    ("AA7", 9),
                    ("AA11", 9),
                    ("AA15", 9),
                    ("AA19", 9),
                    ("BA1", 10),
                    ("BA2", 10),
                    ("BA3", 10);
/*------------------------------------*/
                    
                        
insert into  login (nick, password) values ("admin", "e67732763718fbafa22f23adb5679c2f");
insert into  usuario (nombre, mail, rol, login) values ("admin", "admin@gauchorocket.com", 2,1) ;

select id from login where nick = "admin";
select * from usuario join login on usuario.login = login.id;