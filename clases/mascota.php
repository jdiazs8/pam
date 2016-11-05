<?php
    class Mascota {
        private $id;
        private $nombre;
        private $identificacion;
        private $fechaNacimiento;
        private $direccion;
        private $pathFoto;
        private $pathVacuna;
        private $activado;
        private $fechaRegistro;
        private $fechaUM;
        private $idCliente;
        private $idEspecie;
        private $idRaza;
        private $historial;
        private $vacuna;

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
            $sql = "SELECT * FROM tb_mascotas";
            $resultado =$this->con->consultaRetorno($sql);
            return $resultado;

        }

        public function crear() {
            $sql = "INSERT INTO tb_mascotas(nombre_mascota, fecha_nacimiento_mascota, activado_mascota, fecha_registro_mascota, id_cliente, id_especie, id_raza) VALUES('{$this->nombre}', '{$this->fechaNacimiento}', '1', NOW(), '{$this->idCliente}', '{$this->idEspecie}', '{$this->idRaza}')";
            $this->con->consultaSimple($sql);

            $sql2 = "SELECT id_mascota FROM tb_mascotas WHERE id_cliente = {$this->idCliente} AND nombre_mascota = '{$this->nombre}'";
            $consulta = mysqli_fetch_assoc($this->con->consultaRetorno($sql2));

            $carpeta = "usuarios/clientes/{$this->idCliente}/mascotas/{$consulta['id_mascota']}";
            if(!file_exists($carpeta)) {
                mkdir($carpeta, 0777, true);
            }

            return true;

        }

        public function eliminar() {
            $sql = "UPDATE tb_mascotas SET activado_mascota = '{$this->activado}' WHERE id_mascota = '{$this->id}'";
            $this->con->consultaSimple($sql);

        }

        public function ver() {
            $sql = "SELECT *, nombre_cliente, apellido_cliente, nombre_raza, nombre_especie  FROM tb_mascotas m, tb_clientes c, tb_razas r, tb_especies e WHERE id_mascota = '{$this->id}' AND m.id_cliente = c.id_cliente AND m.id_especie = e.id_especie AND m.id_raza = r.id_raza LIMIT 1";
            $resultado = $this->con->consultaRetorno($sql);


            $row = mysqli_fetch_assoc($resultado);

            $this->id = $row['id_mascota'];
            $this->nombre = $row['nombre_mascota'];
            $this->identificacion = $row['identificacion_mascota'];
            $this->fechaNacimiento = $row['fecha_nacimiento_mascota'];
            $this->direccion = $row['direccion_mascota'];
            $this->pathFoto = $row['path_foto_mascota'];
            $this->pathVacuna = $row['path_foto_cvacunas'];
            $this->activado = $row['activado_mascota'];
            $this->fechaRegistro = $row['fecha_registro_mascota'];
            $this->fechaUM = $row['fecha_ultm_mascota'];
            $this->idCliente = $row['id_cliente'];
            $this->idEspecie = $row['id_especie'];
            $this->idRaza = $row['id_raza'];

            return $row;

        }

        public function editar($estFoto, $estVacuna) {
            if(empty($estFoto)){
                $sql = "SELECT path_foto_mascota FROM tb_mascotas WHERE id_mascota = {$this->id} LIMIT 1";
                $row = mysqli_fetch_assoc($this->con->consultaRetorno($sql));
                $ruta = $row['path_foto_mascota'];
            }else {
                $ruta = "usuarios/clientes/{$this->idCliente}/mascotas/{$this->id}/{$this->id}.jpg";
                copy($_FILES['foto']['tmp_name'], $ruta);
            }

            if(empty($estVacuna)) {
                $sql = "SELECT path_foto_cvacunas FROM tb_mascotas WHERE id_mascota = {$this->id} LIMIT 1";
                $row = mysqli_fetch_assoc($this->con->consultaRetorno($sql));
                $ruta2 = $row['path_foto_cvacunas'];
            }else {
                $ruta2 = "usuarios/clientes/{$this->idCliente}/mascotas/{$this->id}/vacunas{$this->id}.jpg";
                copy($_FILES['vacunas']['tmp_name'], $ruta2);
            }

            $sql = "UPDATE tb_mascotas SET nombre_mascota = '{$this->nombre}', identificacion_mascota = '{$this->identificacion}', fecha_nacimiento_mascota = '{$this->fechaNacimiento}', direccion_mascota = '{$this->direccion}', path_foto_mascota = '{$ruta}', path_foto_cvacunas = '{$ruta2}', activado_mascota = '{$this->activado}', id_cliente = '{$this->idCliente}', id_especie = '{$this->idEspecie}', id_raza = '{$this->idRaza}' WHERE id_mascota = '{$this->id}'";
            $this->con->consultaSimple($sql);
        }

        public function verHistorial() {
          $sql = "SELECT * FROM tb_visitas_veterinarias h, tb_veterinarias va, tb_veterinarios vo WHERE id_mascota = '{$this->id}' AND h.id_veterinaria = va.id_veterinaria AND h.id_veterinario = vo.id_veterinario ORDER BY fecha_visita_veterinaria DESC";
          $historial = $this->con->consultaRetorno($sql);

          return $historial;
        }

        public function verVacunas() {
          $sql = "SELECT * FROM tb_registros_vacunas WHERE id_mascota = {$this->id}";
          $vacuna = $this->con->consultaRetorno($sql);

          return $vacuna;
        }

        public function misMascotas() {
          $sql = "SELECT * FROM tb_mascotas WHERE id_cliente = {$this->idCliente} AND activado_mascota = '1'";
          $resultado = $this->con->consultaRetorno($sql);
          return $resultado;
        }

    }
?>
