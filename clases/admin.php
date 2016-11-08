<?php
    class Admin {

        public function __construct() {
            $this->con = new Conexion();
            $this->con->conectar();

        }

        public function set($atributo, $contenido) {
            $this->$atributo = $contenido;

        }

        public function get($atributo) {
            return $this->$atributo;

        }

        public function listar() {
            $sql = "SELECT * FROM tb_admins";
            $resultado =$this->con->consultaRetorno($sql);
            return $resultado;

        }

        public function crear() {
            $sql = "SELECT * FROM tb_admins WHERE correo_admin = '{$this->correo}'";
            $resultado = $this->con->consultaRetorno($sql);
            $num = mysqli_num_rows($resultado);

            if($num != 0) {
                return false;
            }else {
                $sql2 = "INSERT INTO tb_admins(nombre_admin, correo_admin, contrasena_admin, activado_admin, fecha_registro_admin, id_usuario) VALUES('{$this->nombre}', '{$this->correo}', md5('{$this->contrasena}'), '{$this->activado}', NOW(), '{$this->idUsuario}')";
                $this->con->consultaSimple($sql2);

                return true;
            }

        }

        public function eliminar() {
            $sql = "UPDATE tb_admins SET activado_admin = '{$this->activado}' WHERE id_admin = '{$this->id}'";
            $this->con->consultaSimple($sql);

        }

        public function ver() {
            $sql = "SELECT *  FROM tb_admins WHERE id_admin = '{$this->id}' LIMIT 1";
            $resultado = $this->con->consultaRetorno($sql);

            $row = mysqli_fetch_assoc($resultado);

            $this->id = $row['id_admin'];
            $this->nombre = $row['nombre_admin'];
            $this->correo = $row['correo_admin'];
            $this->contrasena = md5($row['contrasena_admin']);
            $this->activado = $row['activado_admin'];
            $this->fechaRegistro = $row['fecha_registro_admin'];
            $this->fechaUM = $row['fecha_ultm_admin'];
            $this->idUsuario = $row['id_usuario'];

            return $row;

        }

        public function editar() {
          $sql = "UPDATE tb_admins SET nombre_admin = '{$this->nombre}', correo_admin = '{$this->correo}', contrasena_admin = md5('{$this->contrasena}'), activado_admin = '{$this->activado}' WHERE id_admin = '{$this->id}'";
          $this->con->consultaSimple($sql);
        }

        public function inicioSesion() {
            $sql = "SELECT * FROM tb_admins WHERE correo_admin = '{$this->correo}' and contrasena_admin = '{$this->contrasena}' LIMIT 1";
            $resultado = $this->con->consultaRetorno($sql);

            $num = mysqli_num_rows($resultado);

            if($num != 0) {
                $row = mysqli_fetch_assoc($resultado);

                if($row['correo_admin'] == $this->correo && $row['contrasena_admin'] == $this->contrasena) {
                    return $row;
                }else {
                    return false;
                }
            }
        }

        public function verClientes() {
          $controlador = new ControladorCliente();
          $resultado = $controlador->index();
          return $resultado;
        }

        public function verMascotas() {
          $controlador = new ControladorMascota();
          $resultado = $controlador->index();
          return $resultado;
        }
    }

?>
