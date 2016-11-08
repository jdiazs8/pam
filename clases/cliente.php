<?php
    include_once('usuario.php');

    class Cliente extends Usuario {
        private $mascotas;

        public function listar() {
            $sql = "SELECT * FROM tb_clientes";
            $resultado =$this->con->consultaRetorno($sql);
            return $resultado;

        }

        public function crear() {
            $sql = "SELECT * FROM tb_clientes WHERE identificacion_cliente = '{$this->identificacion}' OR correo_cliente = '{$this->correo}'";
            $resultado = $this->con->consultaRetorno($sql);
            $num = mysqli_num_rows($resultado);

            if($num != 0) {
                return false;

            }else {
                $sql2 = "INSERT INTO tb_clientes(nombre_cliente, apellido_cliente, identificacion_cliente, correo_cliente, contrasena_cliente, activado_cliente, fecha_registro_cliente, id_usuario) VALUES('{$this->nombre}', '{$this->apellido}', '{$this->identificacion}', '{$this->correo}', md5('{$this->contrasena}'), '{$this->activado}', NOW(), '{$this->idUsuario}')";
                $this->con->consultaSimple($sql2);

                $sql3 = "SELECT id_cliente FROM tb_clientes WHERE identificacion_cliente = {$this->identificacion}";
                $consulta = mysqli_fetch_assoc($this->con->consultaRetorno($sql3));

                $carpeta = "usuarios/clientes/{$consulta['id_cliente']}/imagenes/fotos";
                if(!file_exists($carpeta)) {
                    mkdir($carpeta, 0777, true);

                }

                $carpeta = "usuarios/clientes/{$consulta['id_cliente']}/mascotas";
                if(!file_exists($carpeta)) {
                    mkdir($carpeta, 0777, true);

                }

                return true;

            }

        }

        public function eliminar() {
            $sql = "UPDATE tb_clientes SET activado_cliente = '{$this->activado}' WHERE id_cliente = '{$this->id}'";
            $this->con->consultaSimple($sql);

        }

        public function ver() {
            $sql = "SELECT *  FROM tb_clientes WHERE id_cliente = '{$this->id}' LIMIT 1";
            $resultado = $this->con->consultaRetorno($sql);

            $row = mysqli_fetch_assoc($resultado);

            $this->id = $row['id_cliente'];
            $this->nombre = $row['nombre_cliente'];
            $this->apellido = $row['apellido_cliente'];
            $this->identificacion = $row['identificacion_cliente'];
            $this->correo = $row['correo_cliente'];
            $this->contrasena = md5($row['contrasena_cliente']);
            $this->direccion = $row['direccion_cliente'];
            $this->telefono = $row['telefono_cliente'];
            $this->celular = $row['celular_cliente'];
            $this->pathFoto = $row['path_foto_cliente'];
            $this->activado = $row['activado_cliente'];
            $this->fechaRegistro = $row['fecha_registro_cliente'];
            $this->fechaUM = $row['fecha_ultm_cliente'];
            $this->idUsuario = $row['id_usuario'];

            return $row;

        }

        public function editar($estFoto) {
          if(empty($estFoto)){
              $sql = "SELECT path_foto_cliente FROM tb_clientes WHERE id_cliente = {$this->id} LIMIT 1";
              $row = mysqli_fetch_assoc($this->con->consultaRetorno($sql));
              $ruta = $row['path_foto_cliente'];
          }else {
              $ruta = "usuarios/clientes/{$this->id}/imagenes/fotos/perfil.jpg";
              copy($_FILES['foto']['tmp_name'], $ruta);
          }

          $sql = "UPDATE tb_clientes SET nombre_cliente = '{$this->nombre}', apellido_cliente = '{$this->apellido}', identificacion_cliente = '{$this->identificacion}', correo_cliente = '{$this->correo}', contrasena_cliente = md5('{$this->contrasena}'), direccion_cliente = '{$this->direccion}', telefono_cliente = '{$this->telefono}', celular_cliente = '{$this->celular}', path_foto_cliente = '{$ruta}', activado_cliente = '{$this->activado}' WHERE id_cliente = '{$this->id}'";
          $this->con->consultaSimple($sql);
        }

        public function misMascotas() {
              $controlador = new ControladorMascota();
              $resultado = $this->mascotas= $controlador->misMascotas($this->id);
              return $resultado;
        }


        public function inicioSesion() {
            $sql = "SELECT * FROM tb_clientes WHERE correo_cliente = '{$this->correo}' and contrasena_cliente = '{$this->contrasena}' LIMIT 1";
            $resultado = $this->con->consultaRetorno($sql);

            $num = mysqli_num_rows($resultado);

            if($num != 0) {
                $row = mysqli_fetch_assoc($resultado);

                if($row['correo_cliente'] == $this->correo && $row['contrasena_cliente'] == $this->contrasena) {
                    return $row;
                }else {
                    return false;
                }
            }
        }

        public function calificarVisita($calificacion, $comentario, $idVisita, $idVeterinaria) {
          $sql = "INSERT INTO tb_comentarios_veterinarias(texto_comentario_veterinaria, fecha_comentario_veterinaria, id_visita_veterinaria, id_veterinaria) VALUES('{$comentario}', NOW(), {$idVisita}, {$idVeterinaria})";
          $this->con->consultaSimple($sql);

          $sql = "UPDATE tb_visitas_veterinarias SET calificacion_visita_veterinaria = '{$calificacion}', calificado_visita_veterinaria = true  WHERE id_visita_veterinaria = '{$idVisita}'";
          $this->con->consultaSimple($sql);

          $sql = "SELECT id_veterinaria FROM tb_visitas_veterinarias WHERE id_visita_veterinaria = '{$idVisita}' LIMIT 1";
          $resultado = $this->con->consultaRetorno($sql);
          $row = mysqli_fetch_assoc($resultado);

          $sql = "UPDATE tb_veterinarias SET cantidad_votos_veterinaria = cantidad_votos_veterinaria + 1, total_puntos_veterinaria = total_puntos_veterinaria + {$calificacion} WHERE id_veterinaria = {$row['id_veterinaria']}";
          $this->con->consultaSimple($sql);

        }
    }

?>
