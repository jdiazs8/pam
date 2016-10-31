USE db_pam;
INSERT INTO tb_usuarios(nombre_usuario, activado_usuario, fecha_registro_usuario) VALUES('Administrador', '1', NOW());
INSERT INTO tb_usuarios(nombre_usuario, activado_usuario, fecha_registro_usuario) VALUES('Cliente', '1', NOW());
INSERT INTO tb_usuarios(nombre_usuario, activado_usuario, fecha_registro_usuario) VALUES('Veterinario', '1', NOW());
INSERT INTO tb_usuarios(nombre_usuario, activado_usuario, fecha_registro_usuario) VALUES('Visitante', '1', NOW());

SELECT * FROM tb_clientes;