DROP DATABASE IF EXISTS db_pam;
CREATE DATABASE db_pam CHARACTER SET utf8 COLLATE utf8_general_ci;

USE db_pam;

CREATE TABLE tb_clientes (
	id_cliente INT(10) PRIMARY KEY AUTO_INCREMENT, 
	nombre_cliente VARCHAR(30) NOT NULL,
    apellido_cliente VARCHAR(30) NOT NULL,
    identificacion_cliente VARCHAR(11) NOT NULL UNIQUE,
    correo_cliente VARCHAR(100) NOT NULL UNIQUE,
    contrasena_cliente VARCHAR(50) NOT NULL,
    direccion_cliente VARCHAR(100),
    telefono_cliente VARCHAR(11),
    celular_cliente VARCHAR(11),
    path_foto_cliente VARCHAR(256) NOT NULL DEFAULT 'imagenes/defaultPerfil.jpg',
    activado_cliente BOOLEAN NOT NULL,
    fecha_registro_cliente DATETIME NOT NULL,
    fecha_ultm_cliente TIMESTAMP NOT NULL,
    id_usuario INT(10) NOT NULL
);

CREATE TABLE tb_veterinarios (
	id_veterinario INT(10) PRIMARY KEY AUTO_INCREMENT, 
	nombre_veterinario VARCHAR(30) NOT NULL,
    apellido_veterinario VARCHAR(30) NOT NULL,
    identificacion_veterinario VARCHAR(11) NOT NULL UNIQUE,
    tprofesional_veterinario varchar(20) NOT NULL UNIQUE,
    correo_veterinario VARCHAR(100) NOT NULL UNIQUE,
    contrasena_veterinario VARCHAR(50) NOT NULL,
    direccion_veterinario VARCHAR(100) NOT NULL,
    telefono_veterinario VARCHAR(11),
    celular_veterinario VARCHAR(11) NOT NULL,
    path_foto_veterinario VARCHAR(256) NOT NULL DEFAULT 'imagenes/defaultPerfil.jpg',
    activado_veterinario BOOLEAN NOT NULL,
    fecha_registro_veterinario DATETIME NOT NULL,
    fecha_ultm_veterinario TIMESTAMP NOT NULL,
    id_usuario INT(10) NOT NULL
);

CREATE TABLE tb_mascotas (
	id_mascota INT(10) PRIMARY KEY AUTO_INCREMENT,
    nombre_mascota VARCHAR(70) NOT NULL,
    identificacion_mascota VARCHAR(20),
    fecha_nacimiento_mascota DATE NOT NULL,
    direccion_mascota VARCHAR(100),
    path_foto_mascota VARCHAR(256) NOT NULL DEFAULT 'imagenes/defaultMascota.jpg',
    path_foto_cvacunas VARCHAR(256) NOT NULL DEFAULT 'imagenes/defaultVacunas.jpg',
    activado_mascota BOOLEAN NOT NULL,
    fecha_registro_mascota DATETIME NOT NULL,
    fecha_ultm_mascota TIMESTAMP NOT NULL,
    id_cliente INT(10) NOT NULL,
    id_veterinario INT(10) DEFAULT 1,
    id_especie INT(10) NOT NULL,
    id_raza INT(10) NOT NULL
);

CREATE TABLE tb_veterinarias (
	id_veterinaria INT(10) PRIMARY KEY AUTO_INCREMENT,
    nombre_veterinaria VARCHAR(100) NOT NULL,
    nit_veterinaria VARCHAR(15) NOT NULL UNIQUE,
    direccion_veterinaria VARCHAR(100) NOT NULL,
    telefono_veterinaria VARCHAR(11),
    celular_veterinaria VARCHAR(11) NOT NULL,
    path_foto_veterinaria VARCHAR(256) NOT NULL DEFAULT 'imagenes/defaultVeterinaria.jpg',
    cantidad_votos_veterinaria INT(1) NOT NULL DEFAULT 0,
    total_puntos_veterinaria INT(1) NOT NULL DEFAULT 0,
    activado_veterinaria BOOLEAN NOT NULL,
    fecha_registro_veterinaria DATETIME NOT NULL,
    fecha_ultm_veterinaria TIMESTAMP NOT NULL,
    id_veterinario INT(10) NOT NULL
);

CREATE TABLE tb_visitas_veterinarias (
	id_visita_veterinaria INT(10) PRIMARY KEY AUTO_INCREMENT,
    peso_visita_veterinaria DOUBLE(3,1) NOT NULL,
    sintomas_visita_veterinaria VARCHAR(400) NOT NULL,
    diagnostico_visita_veterinaria VARCHAR(400) NOT NULL,
    observaciones_visita_veterinaria VARCHAR(400) NOT NULL,
    fecha_visita_veterinaria DATETIME NOT NULL,
    calificacion_visita_veterinaria INT(1),
    calificado_visita_veterinaria BOOLEAN,
    id_mascota INT(10) NOT NULL,
    id_veterinario INT(10) NOT NULL,
    id_veterinaria INT(10) NOT NULL
);

CREATE TABLE tb_registros_vacunas (
	id_rvacuna INT(10) PRIMARY KEY AUTO_INCREMENT,
    laboratorio_rvacuna VARCHAR(50) NOT NULL,
    cepa_rvacuna VARCHAR(50) NOT NULL,
    lote_rvacuna VARCHAR(10) NOT NULL,
    fecha_exp_rvacuna DATE NOT NULL,
    fecha_apli_rvacuna DATETIME NOT NULL,
    dosis_rvacuna VARCHAR(1) NOT NULL,
    id_mascota INT(10) NOT NULL,
    id_vacuna int(10) NOT NULL
);

CREATE TABLE tb_usuarios (
	id_usuario INT(10) PRIMARY KEY AUTO_INCREMENT,
    nombre_usuario VARCHAR(30) NOT NULL,
    activado_usuario BOOLEAN NOT NULL,
    fecha_registro_usuario DATETIME NOT NULL,
    fecha_ultm_usuario TIMESTAMP NOT NULL
);

CREATE TABLE tb_vacunas (
	id_vacuna INT(10) PRIMARY KEY AUTO_INCREMENT,
    nombre_vacuna VARCHAR(30) NOT NULL,
    activado_vacuna BOOLEAN NOT NULL,
    fecha_registro_vacuna DATETIME NOT NULL,
    fecha_ultm_vacuna TIMESTAMP NOT NULL,
    id_especie INT(10) NOT NULL
);

CREATE TABLE tb_especies (
	id_especie INT(10) PRIMARY KEY AUTO_INCREMENT,
    nombre_especie VARCHAR(30) NOT NULL,
    activado_especie BOOLEAN NOT NULL,
    fecha_registro_especie DATETIME NOT NULL,
    fecha_ultm_especie TIMESTAMP NOT NULL
);

CREATE TABLE tb_razas (
	id_raza INT(10) PRIMARY KEY AUTO_INCREMENT,
    nombre_raza VARCHAR(30) NOT NULL,
    activado_raza BOOLEAN NOT NULL,
    fecha_registro_raza DATETIME NOT NULL,
    fecha_ultm_raza TIMESTAMP NOT NULL,
    id_especie INT(10) NOT NULL
);

CREATE TABLE tb_admins(
	id_admin INT(10) PRIMARY KEY AUTO_INCREMENT,
    nombre_admin VARCHAR(30) NOT NULL,
    correo_admin VARCHAR(100) NOT NULL UNIQUE,
    contrasena_admin VARCHAR(50) NOT NULL,
    activado_admin BOOLEAN NOT NULL,
    fecha_registro_admin DATETIME NOT NULL,
    fecha_ultm_admin TIMESTAMP NOT NULL,
    id_usuario INT(10) NOT NULL
);

CREATE TABLE tb_contacto (
	id_contacto INT(10) PRIMARY KEY AUTO_INCREMENT,
    fecha_contacto DATETIME NOT NULL,
    nombre_contacto VARCHAR(100) NOT NULL,
    correo_contacto VARCHAR(100) NOT NULL,
    tema_contacto VARCHAR(50) NOT NULL,
    mensaje_contacto VARCHAR(1000) NOT NULL,
    estado_contacto BOOLEAN NOT NULL DEFAULT 0,
    id_usuario INT(10) NOT NULL
);

CREATE TABLE tb_fotos_clientes (
	id_foto_cliente INT(10) PRIMARY KEY AUTO_INCREMENT,
    nombre_foto_cliente VARCHAR(30) NOT NULL,
    fecha_foto_cliente DATETIME NOT NULL,
    path_foto_cliente VARCHAR(256) NOT NULL,
    privado_foto_cliente BOOLEAN NOT NULL,
    id_cliente INT(10) NOT NULL
);

CREATE TABLE tb_fotos_veterinarios (
	id_foto_veterinario INT(10) PRIMARY KEY AUTO_INCREMENT,
    nombre_foto_veterinario VARCHAR(30) NOT NULL,
    fecha_foto_veterinario DATETIME NOT NULL,
    path_foto_veterinario VARCHAR(256) NOT NULL,
    privado_foto_veterinario BOOLEAN NOT NULL,
    id_veterinario INT(10) NOT NULL
);

CREATE TABLE tb_comentarios_veterinarias (
	id_comentario_veterinaria INT(10) PRIMARY KEY AUTO_INCREMENT,
    texto_comentario_veterinaria VARCHAR(400) NOT NULL,
    fecha_comentario_veterinaria DATETIME,
    id_visita_veterinaria INT(10),
    id_veterinaria INT(10)
);