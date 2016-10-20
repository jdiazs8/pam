DROP DATABASE IF EXISTS pam_db;
CREATE DATABASE pam_db CHARACTER SET utf8 COLLATE utf8_general_ci;
USE pam_db;


CREATE TABLE tb_clients (
	id_client int(10) not null auto_increment,
	name_client varchar(50) not null,
	dni_client int(10) not null unique,
	email_client varchar(50) not null unique,
	phone_client int(10) not null,
	pass_client varchar(50) not null,
	status_client boolean not null,
	date_up_client date not null,
	date_last_ud_client date not null,
	address_client varchar(50) not null,
	id_zone int(4) not null,
	id_kind_user int(4) not null,
	primary key(id_client)
);

CREATE TABLE tb_pets (
	id_pet int(10) not null auto_increment,
	name_pet varchar(50) not null,
	breed_pet varchar(50) not null,
	gender_pet enum('H', 'M') not null,
	birthdate_pet date not null,
	path_pic_pet varchar(250) not null,
	date_up_pet date not null,
	date_last_ud_pet date not null,
	id_client int(10), 
	id_kind_pet int(4) not null,
	/*id_breed int(4) not null,*/
	primary key(id_pet)
);

CREATE TABLE tb_vets (
	id_vet int(10) not null auto_increment,
	name_vet varchar(50) not null,
	dni_vet int(10) not null unique,
	email_vet varchar(50) not null unique,
	phone_vet int(10) not null, 
	pass_vet varchar(50) not null,
	pro_pass_vet varchar(20) not null unique,
	status_vet boolean not null,
	date_up_vet date not null,
	date_last_ud_vet date null,
	id_kind_user int(4) not null,
	primary key(id_vet)
);

CREATE TABLE tb_veterinarys (
	id_veterinary int(10) not null auto_increment,
	name_veterinary varchar(50) not null unique,
	nit_veterinary int(10) not null unique,
	score_veterinary int(1) not null,
	votes_veterinary int(10) not null,
	phone_veterinary int(10) not null,
	address_veterinary varchar(50) not null,
	path_pic_veterinary varchar(250) not null,
	date_up_veterinary date not null,
	date_last_ud_veterinary date not null,
	id_vet int(10) not null,
	id_zone int(4) not null,
	primary key(id_veterinary)
);

CREATE TABLE tb_zones (
	id_zone int(2) not null auto_increment,
	name_zone varchar(50) not null unique,
	primary key(id_zone)
);
/*
CREATE TABLE tb_breeds (
	id_breed int(4) not null auto_increment,
	name_breed varchar(50) not null unique,
	primary key(id_breed)
);
*/
CREATE TABLE tb_kind_pets (
	id_kind_pet int(4) not null auto_increment,
	name_kind_pet varchar(50) not null unique,
	primary key(id_kind_pet)
);

CREATE TABLE tb_vaccines (
	id_vaccine int(4) not null auto_increment,
	name_vaccine varchar(50) not null unique,
	primary key(id_vaccine)
);

CREATE TABLE tb_vaccines_pets (	
	id_vaccine_pets int(4) not null auto_increment,
	name_vaccine_pets varchar(50) not null,
	date_vaccine_pets date not null,
	id_pet int(10) not null,
	id_vaccine int(4) not null,
	primary key(id_vaccine_pets)
);

CREATE TABLE tb_kind_users (
	id_kind_user int(4) not null auto_increment,
	name_kind_user varchar(50) not null unique,
	primary key(id_kind_user)
);

CREATE TABLE tb_historics_pets (
	id_historics_pet int(10) not null auto_increment,
	date_historics_pet date not null,
	description_historics_pet varchar(400) not null,
	id_pet int(10) not null,
	id_vet int(10) not null,
	id_veterinary int(10) not null,
	primary key(id_historics_pet)
);


CREATE TABLE tb_pictures_clients (
	id_picture_client int(10) not null auto_increment,
	name_picture_client varchar(20) not null,
	date_picture_client date not null,
	path_picture_client varchar(250) not null,
	public_picture_client boolean not null, 
	id_client int(10) not null,
	primary key(id_picture_client)
);

CREATE TABLE tb_pictures_vets (
	id_picture_vet int(10) not null auto_increment,
	name_picture_vet varchar(20) not null,
	date_picture_vet date not null,
	path_picture_vet varchar(250) not null,
	public_picture_vet boolean not null, 
	id_vet int(10) not null,
	primary key(id_picture_vet)
);

CREATE TABLE tb_news (
	id_new int(10) not null auto_increment,
	date_new date not null,
	title_new varchar(20) not null,
	body_new varchar(400) not null,
	id_admin int(2) not null,
	primary key(id_new)
);

CREATE TABLE tb_comments (
	id_comment int(10) not null auto_increment,
	date_comment date not null,
	comment_comment varchar(400) not null,
	id_veterinary int(10) not null,
	id_client int(10) not null,
	primary key(id_comment)
);

CREATE TABLE tb_veterinarys_aso (
	id_veterinary_aso int(10) not null auto_increment,
	id_pet int(10) not null,
	id_vet int(10) not null,
	primary key(id_veterinary_aso)
);

select * from tb_veterinarys_aso;

insert into tb_veterinarys_aso(id_veterinary_aso, id_pet, id_vet) values(null, 1, 1);

CREATE TABLE tb_contacts (
	id_contact int(10) not null auto_increment,
	name_contact varchar(50) not null,
	date_contact date not null,
	email_contact varchar(50) not null,
	subject_contact  varchar(20) not null,
	message_contact varchar(400) not null,
	primary key(id_contact)
);

CREATE TABLE tb_admins (
	id_admin int(2) not null auto_increment,
	name_admin varchar(20) not null,
	pass_admin varchar(50) not null,
	primary key(id_admin)
);

ALTER TABLE tb_clients ADD FOREIGN KEY (id_zone) REFERENCES tb_zones (id_zone);
ALTER TABLE tb_clients ADD FOREIGN KEY (id_kind_user) REFERENCES tb_kind_users (id_kind_user);

ALTER TABLE tb_vets ADD FOREIGN KEY (id_kind_user) REFERENCES tb_kind_users (id_kind_user);

ALTER TABLE tb_pets ADD FOREIGN KEY (id_client) REFERENCES tb_clients (id_client);
ALTER TABLE tb_pets ADD FOREIGN KEY (id_kind_pet) REFERENCES tb_kind_pets (id_kind_pet);
/*ALTER TABLE tb_pets ADD FOREIGN KEY (id_breed) REFERENCES tb_breeds (id_breed);*/

ALTER TABLE tb_veterinarys ADD FOREIGN KEY (id_vet) REFERENCES tb_vets (id_vet);
ALTER TABLE tb_veterinarys ADD FOREIGN KEY (id_zone) REFERENCES tb_zones (id_zone);

ALTER TABLE tb_historics_pets ADD FOREIGN KEY (id_pet) REFERENCES tb_pets (id_pet);
ALTER TABLE tb_historics_pets ADD FOREIGN KEY (id_vet) REFERENCES tb_vets (id_vet);
ALTER TABLE tb_historics_pets ADD FOREIGN KEY (id_veterinary) REFERENCES tb_veterinarys (id_veterinary);

ALTER TABLE tb_pictures_clients ADD FOREIGN KEY (id_client) REFERENCES tb_clients (id_client);
ALTER TABLE tb_pictures_vets ADD FOREIGN KEY (id_vet) REFERENCES tb_vets (id_vet);

ALTER TABLE tb_vaccines_pets ADD FOREIGN KEY (id_pet) REFERENCES tb_pets (id_pet);
ALTER TABLE tb_vaccines_pets ADD FOREIGN KEY (id_vaccine) REFERENCES tb_vaccines (id_vaccine);

ALTER TABLE tb_comments ADD FOREIGN KEY (id_veterinary) REFERENCES tb_veterinarys (id_veterinary);
ALTER TABLE tb_comments ADD FOREIGN KEY (id_client) REFERENCES tb_clients (id_client);

ALTER TABLE tb_veterinarys_aso ADD FOREIGN KEY (id_pet) REFERENCES tb_pets (id_pet);
ALTER TABLE tb_veterinarys_aso ADD FOREIGN KEY (id_vet) REFERENCES tb_vets (id_vet);

ALTER TABLE tb_news ADD FOREIGN KEY (id_admin) REFERENCES tb_admins (id_admin);

INSERT INTO tb_zones(id_zone, name_zone) VALUES(NULL, 'Usaquen');
INSERT INTO tb_zones(id_zone, name_zone) VALUES(NULL, 'Chapinero');
INSERT INTO tb_zones(id_zone, name_zone) VALUES(NULL, 'Sante Fe');
INSERT INTO tb_zones(id_zone, name_zone) VALUES(NULL, 'San Cristobal');
INSERT INTO tb_zones(id_zone, name_zone) VALUES(NULL, 'Usme');
INSERT INTO tb_zones(id_zone, name_zone) VALUES(NULL, 'Tunjuelito');
INSERT INTO tb_zones(id_zone, name_zone) VALUES(NULL, 'Bosa');
INSERT INTO tb_zones(id_zone, name_zone) VALUES(NULL, 'Ciudad Kennedy');
INSERT INTO tb_zones(id_zone, name_zone) VALUES(NULL, 'Fontibon');
INSERT INTO tb_zones(id_zone, name_zone) VALUES(NULL, 'Engativa');
INSERT INTO tb_zones(id_zone, name_zone) VALUES(NULL, 'Suba');
INSERT INTO tb_zones(id_zone, name_zone) VALUES(NULL, 'Barrios Unidos');
INSERT INTO tb_zones(id_zone, name_zone) VALUES(NULL, 'Teusaquillo');
INSERT INTO tb_zones(id_zone, name_zone) VALUES(NULL, 'Los Martires');
INSERT INTO tb_zones(id_zone, name_zone) VALUES(NULL, 'Antonio Narino');
INSERT INTO tb_zones(id_zone, name_zone) VALUES(NULL, 'Puente Aranda');
INSERT INTO tb_zones(id_zone, name_zone) VALUES(NULL, 'Candelaria');
INSERT INTO tb_zones(id_zone, name_zone) VALUES(NULL, 'Rafael Uribe');
INSERT INTO tb_zones(id_zone, name_zone) VALUES(NULL, 'Ciudad Bolivar');
INSERT INTO tb_zones(id_zone, name_zone) VALUES(NULL, 'Sumapaz');

INSERT INTO tb_kind_users(id_kind_user, name_kind_user) VALUES(NULL, 'Cliente');
INSERT INTO tb_kind_users(id_kind_user, name_kind_user) VALUES(NULL, 'Veterinario');

INSERT INTO tb_kind_pets(id_kind_pet, name_kind_pet) VALUES(NULL, 'Perro');
INSERT INTO tb_kind_pets(id_kind_pet, name_kind_pet) VALUES(NULL, 'Gato');

INSERT INTO tb_vaccines(id_vaccine, name_vaccine) VALUES(NULL, 'Triple');
INSERT INTO tb_vaccines(id_vaccine, name_vaccine) VALUES(NULL, 'Parvovirus');
INSERT INTO tb_vaccines(id_vaccine, name_vaccine) VALUES(NULL, 'Rabia');
INSERT INTO tb_vaccines(id_vaccine, name_vaccine) VALUES(NULL, 'leucemia');
INSERT INTO tb_vaccines(id_vaccine, name_vaccine) VALUES(NULL, 'panleucopenia');
INSERT INTO tb_vaccines(id_vaccine, name_vaccine) VALUES(NULL, 'rinotraqueitis');
INSERT INTO tb_vaccines(id_vaccine, name_vaccine) VALUES(NULL, ' calicivirosis');

INSERT INTO tb_veterinarys(id_veterinary, name_veterinary, nit_veterinary, score_veterinary, votes_veterinary, phone_veterinary, address_veterinary, path_pic_veterinary, date_up_veterinary, date_last_ud_veterinary, id_vet, id_zone) VALUES(NULL, 'Clinica Veterinaria Romareda', 860047379, 0, 0, 6157655, 'Cr 49 No 134-44', 'users/vets/2/images/veterinarys/Clinica Vet Romareda.jpg', '2016-05-14', '2016-05-14', 2, 11);

select* from tb_veterinarys;