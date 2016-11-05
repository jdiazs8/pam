<?php
    include_once('usuario.php');

    class Veterinario extends Usuario {
        private $mascotas;

        public function listar() {
            $sql = "SELECT * FROM tb_veterinarios";
            $resultado =$this->con->consultaRetorno($sql);
            return $resultado;

        }

        public function crear() {
            $sql = "SELECT * FROM tb_veterinarios WHERE identificacion_veterinario = '{$this->identificacion}' OR correo_veterinario = '{$this->correo}' OR tprofesional_veterinario = '{$this->tprofesional}'";
            $resultado = $this->con->consultaRetorno($sql);
            $num = mysqli_num_rows($resultado);

            if($num != 0) {
                return false;
            }else {
                $sql2 = "INSERT INTO tb_veterinarios(nombre_veterinario, apellido_veterinario, identificacion_veterinario, tprofesional_veterinario, correo_veterinario, contrasena_veterinario, direccion_veterinario, celular_veterinario, activado_veterinario, fecha_registro_veterinario, id_usuario) VALUES('{$this->nombre}', '{$this->apellido}', '{$this->identificacion}', '{$this->tprofesional}', '{$this->correo}', md5('{$this->contrasena}'), '{$this->direccion}', '{$this->celular}', '{$this->activado}', NOW(), '{$this->idUsuario}')";
                $this->con->consultaSimple($sql2);

                $sql3 = "SELECT id_veterinario FROM tb_veterinarios WHERE identificacion_veterinario = '{$this->identificacion}'";
                $consulta = mysqli_fetch_assoc($this->con->consultaRetorno($sql3));

                $sql4 = "INSERT INTO tb_veterinarias(nombre_veterinaria, nit_veterinaria, direccion_veterinaria, celular_veterinaria, activado_veterinaria, id_veterinario) VALUES('{$this->nombre}', '{$this->identificacion}', '{$this->direccion}', '{$this->celular}', '{$this->activado}', '{$consulta['id_veterinario']}')";
                $this->con->consultaRetorno($sql4);

                $sql5 = "SELECT id_veterinario FROM tb_veterinarios WHERE identificacion_veterinario = {$this->identificacion}";
                $consulta = mysqli_fetch_assoc($this->con->consultaRetorno($sql5));

                $carpeta = "usuarios/veterinarios/{$consulta['id_veterinario']}/imagenes/fotos";
                if(!file_exists($carpeta)) {
                    mkdir($carpeta, 0777, true);

                }

                $carpeta = "usuarios/veterinarios/{$consulta['id_veterinario']}/veterinarias";
                if(!file_exists($carpeta)) {
                    mkdir($carpeta, 0777, true);

                }

                return true;

            }

        }

        public function eliminar() {
            $sql = "UPDATE tb_veterinarios SET activado_veterinario = '{$this->activado}' WHERE id_veterinario = '{$this->id}'";
            $this->con->consultaSimple($sql);
        }

        public function ver() {
            $sql = "SELECT *  FROM tb_veterinarios WHERE id_veterinario = '{$this->id}' LIMIT 1";
            $resultado = $this->con->consultaRetorno($sql);

            $row = mysqli_fetch_assoc($resultado);

            $this->id = $row['id_veterinario'];
            $this->nombre = $row['nombre_veterinario'];
            $this->apellido = $row['apellido_veterinario'];
            $this->identificacion = $row['identificacion_veterinario'];
            $this->tprofesional = $row['tprofesional_veterinario'];
            $this->correo = $row['correo_veterinario'];
            $this->contrasena = md5($row['contrasena_veterinario']);
            $this->direccion = $row['direccion_veterinario'];
            $this->telefono = $row['telefono_veterinario'];
            $this->celular = $row['celular_veterinario'];
            $this->pathFoto = $row['path_foto_veterinario'];
            $this->activado = $row['activado_veterinario'];
            $this->fechaRegistro = $row['fecha_registro_veterinario'];
            $this->fechaUM = $row['fecha_ultm_veterinario'];
            $this->idUsuario = $row['id_usuario'];

            return $row;

        }

        public function editar($estFoto) {
          if(empty($estFoto)){
              $sql = "SELECT path_foto_veterinario FROM tb_veterinarios WHERE id_veterinario = {$this->id} LIMIT 1";
              $row = mysqli_fetch_assoc($this->con->consultaRetorno($sql));
              $ruta = $row['path_foto_veterinario'];
          }else {
              $ruta = "usuarios/veterinarios/{$this->id}/imagenes/fotos/perfil.jpg";
              copy($_FILES['foto']['tmp_name'], $ruta);
          }

          $sql = "UPDATE tb_veterinarios SET nombre_veterinario = '{$this->nombre}', apellido_veterinario = '{$this->apellido}', identificacion_veterinario = '{$this->identificacion}', tprofesional_veterinario = '{$this->tprofesional}', correo_veterinario = '{$this->correo}', contrasena_veterinario = md5('{$this->contrasena}'), direccion_veterinario = '{$this->direccion}', telefono_veterinario = '{$this->telefono}', celular_veterinario = '{$this->celular}', path_foto_veterinario = '{$ruta}', activado_veterinario = '{$this->activado}' WHERE id_veterinario = '{$this->id}'";
          $this->con->consultaSimple($sql);
        }

        public function misMascotas() {
              $controlador = new ControladorMascota();
              $resultado = $this->mascotas= $controlador->misMascotas($this->id);
              return $resultado;
        }


        public function inicioSesion() {
            $sql = "SELECT * FROM tb_veterinarios WHERE correo_veterinario = '{$this->correo}' and contrasena_veterinario = '{$this->contrasena}' LIMIT 1";
            $resultado = $this->con->consultaRetorno($sql);

            $num = mysqli_num_rows($resultado);

            if($num != 0) {
                $row = mysqli_fetch_assoc($resultado);

                if($row['correo_veterinario'] == $this->correo && $row['contrasena_veterinario'] == $this->contrasena) {
                    return $row;
                }else {
                    return false;
                }
            }
        }
    }

?>
