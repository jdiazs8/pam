<?php
    class Extra {
        private $idExtra;
        private $nombre;
        private $asociado;

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

        public function listar($item) {
            switch($item) {
              case 1:
                $sql = "SELECT * FROM tb_usuarios";
                $resultado =$this->con->consultaRetorno($sql);
                return $resultado;
                break;

              case 2:
                $sql = "SELECT v.*, e.nombre_especie FROM tb_vacunas v, tb_especies e WHERE v.id_especie = e.id_especie";
                $resultado =$this->con->consultaRetorno($sql);
                return $resultado;
                break;

              case 3:
                $sql = "SELECT * FROM tb_especies";
                $resultado =$this->con->consultaRetorno($sql);
                return $resultado;
                break;

              case 4:
                $sql = "SELECT r.*, e.nombre_especie FROM tb_razas r, tb_especies e WHERE r.id_especie = e.id_especie";
                $resultado =$this->con->consultaRetorno($sql);
                return $resultado;
                break;
            }
        }

        public function crear($item) {
            switch ($item) {
              case 1:
                $sql = "INSERT INTO tb_usuarios(nombre_usuario, activado_usuario, fecha_registro_usuario) VALUES('{$this->nombre}', '1', NOW())";
                $resultado = $this->con->consultaRetorno($sql);
                return $resultado;
                break;

              case 2:
                $sql = "INSERT INTO tb_vacunas(nombre_vacuna, activado_vacuna, fecha_registro_vacuna, id_especie) VALUES('{$this->nombre}', '1', NOW(), '{$this->asociado}')";
                $resultado = $this->con->consultaRetorno($sql);
                return $resultado;
                break;

              case 3:
                $sql = "INSERT INTO tb_especies(nombre_especie, activado_especie, fecha_registro_especie) VALUES('{$this->nombre}', '1', NOW())";
                $resultado = $this->con->consultaRetorno($sql);
                return $resultado;
                break;

              case 4:
                $sql = "INSERT INTO tb_razas(nombre_raza, activado_raza, fecha_registro_raza, id_especie) VALUES('{$this->nombre}', '1', NOW(), '{$this->asociado}')";
                $resultado = $this->con->consultaRetorno($sql);
                return $resultado;
                break;
            }
        }

        public function eliminar($item) {
            switch ($item) {
              case 1:
                $sql = "UPDATE tb_usuarios SET activado_usuario = '{$this->activado}' WHERE id_usuario = '{$this->id}'";
                $this->con->consultaSimple($sql);
                break;

              case 2:
                $sql = "UPDATE tb_vacunas SET activado_vacuna = '{$this->activado}' WHERE id_vacuna = '{$this->id}'";
                $this->con->consultaSimple($sql);
                break;

              case 3:
                $sql = "UPDATE tb_especies SET activado_especie = '{$this->activado}' WHERE id_especie = '{$this->id}'";
                $this->con->consultaSimple($sql);
                break;

              case 4:
                $sql = "UPDATE tb_razas SET activado_raza = '{$this->activado}' WHERE id_raza = '{$this->id}'";
                $this->con->consultaSimple($sql);
                break;
            }
        }

        public function ver($item) {
            switch ($item) {
              case 1:
                $sql = "SELECT * FROM tb_usuarios WHERE id_usuario = '{$this->id}' LIMIT 1";
                $resultado = $this->con->consultaRetorno($sql);

                $row = mysqli_fetch_assoc($resultado);

                $this->id = $row['id_usuario'];
                $this->nombre = $row['nombre_usuario'];

                return $row;
                break;

              case 2:
                $sql = "SELECT * FROM tb_vacunas WHERE id_vacuna = '{$this->id}' LIMIT 1";
                $resultado = $this->con->consultaRetorno($sql);

                $row = mysqli_fetch_assoc($resultado);

                $this->id = $row['id_vacuna'];
                $this->nombre = $row['nombre_vacuna'];
                $this->asociado = $row['id_especie'];

                return $row;
                break;

              case 3:
                $sql = "SELECT * FROM tb_especies WHERE id_especie = '{$this->id}' LIMIT 1";
                $resultado = $this->con->consultaRetorno($sql);

                $row = mysqli_fetch_assoc($resultado);

                $this->id = $row['id_especie'];
                $this->nombre = $row['nombre_especie'];

                return $row;
                break;

              case 4:
                $sql = "SELECT * FROM tb_razas WHERE id_raza = '{$this->id}' LIMIT 1";
                $resultado = $this->con->consultaRetorno($sql);

                $row = mysqli_fetch_assoc($resultado);

                $this->id = $row['id_raza'];
                $this->nombre = $row['nombre_raza'];
                $this->asociado = $row['id_especie'];

                return $row;
                break;
              }
        }

        public function editar($item) {
          switch ($item) {
            case 1:
              $sql = "UPDATE tb_usuarios SET nombre_usuario = '{$this->nombre}', activado_usuario = '{$this->activado}' WHERE id_usuario = '{$this->id}'";
              $this->con->consultaSimple($sql);
              break;

            case 2:
              $sql = "UPDATE tb_vacunas SET nombre_vacuna = '{$this->nombre}', id_especie = '{$this->asociado}', activado_vacuna = '{$this->activado}' WHERE id_vacuna = '{$this->id}'";
              $this->con->consultaSimple($sql);
              break;

            case 3:
              $sql = "UPDATE tb_especies SET nombre_especie = '{$this->nombre}', activado_especie = '{$this->activado}' WHERE id_especie = '{$this->id}'";
              $this->con->consultaSimple($sql);
              break;

            case 4:
              $sql = "UPDATE tb_razas SET nombre_raza = '{$this->nombre}', id_especie = '{$this->asociado}', activado_raza = '{$this->activado}' WHERE id_raza = '{$this->id}'";
              $this->con->consultaSimple($sql);
              break;
          }
        }

        public function vacunasEspecie($idEspecie) {
          $sql = "SELECT * FROM tb_vacunas WHERE id_especie = '{$idEspecie}'";
          $resultado = $this->con->consultaRetorno($sql);

          return $resultado;
        }
    }
?>
