<?php
    class Veterinaria {
        private $id;
        private $nombre;
        private $nit;
        private $direccion;
        private $pathFoto;
        private $cantidadVotos;
        private $totalVotos;
        private $activado;
        private $fechaRegistro;
        private $fechaUM;
        private $idVeterinario;

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
            $sql = "SELECT * FROM tb_veterinarias";
            $resultado =$this->con->consultaRetorno($sql);
            return $resultado;

        }

        public function crear() {
            $sql = "INSERT INTO tb_veterinarias(nombre_veterinaria, nit_veterinaria, direccion_veterinaria, celular_veterinaria, activado_veterinaria, fecha_registro_veterinaria, id_veterinario) VALUES('{$this->nombre}', '{$this->nit}', '{$this->direccion}', '{$this->celular}', '{$this->activado}', NOW(), '{$this->idVeterinario}')";
            $this->con->consultaSimple($sql);

            $sql2 = "SELECT id_veterinaria FROM tb_veterinarias WHERE id_veterinario = {$this->idVeterinario} AND nombre_veterinaria = '{$this->nombre}'";
            $consulta = mysqli_fetch_assoc($this->con->consultaRetorno($sql2));

            $carpeta = "usuarios/veterinarios/{$this->idVeterinario}/veterinarias/{$consulta['id_veterinaria']}";
            if(!file_exists($carpeta)) {
                mkdir($carpeta, 0777, true);
            }

            return true;

        }

        public function eliminar() {
            $sql = "UPDATE tb_veterinarias SET activado_veterinaria = '{$this->activado}' WHERE id_veterinaria = '{$this->id}'";
            $this->con->consultaSimple($sql);

        }

        public function ver() {
            $sql = "SELECT *  FROM tb_veterinarias va, tb_veterinarios vo WHERE va.id_veterinaria = '{$this->id}' AND va.id_veterinario = vo.id_veterinario LIMIT 1";
            $resultado = $this->con->consultaRetorno($sql);

            $row = mysqli_fetch_assoc($resultado);

            $this->id = $row['id_veterinaria'];
            $this->nombre = $row['nombre_veterinaria'];
            $this->nit = $row['nit_veterinaria'];
            $this->direccion = $row['direccion_veterinaria'];
            $this->pathFoto = $row['path_foto_veterinaria'];
            $this->cantidadVotos = $row['cantidad_votos_veterinaria'];
            $this->totalVotos = $row['total_puntos_veterinaria'];
            $this->activado = $row['activado_veterinaria'];
            $this->fechaRegistro = $row['fecha_registro_veterinaria'];
            $this->fechaUM = $row['fecha_ultm_veterinaria'];
            $this->idVeterinario = $row['id_veterinario'];

            return $row;

        }

        public function editar($estFoto) {
            if(empty($estFoto)){
                $sql = "SELECT path_foto_veterinaria FROM tb_veterinarias WHERE id_veterinaria = {$this->id} LIMIT 1";
                $row = mysqli_fetch_assoc($this->con->consultaRetorno($sql));
                $ruta = $row['path_foto_veterinaria'];
            }else {
                $ruta = "usuarios/veterinarios/{$this->idVeterinario}/veterinarias/{$this->id}/{$this->id}.jpg";
                copy($_FILES['foto']['tmp_name'], $ruta);
            }

            $sql = "UPDATE tb_veterinarias SET nombre_veterinaria = '{$this->nombre}', nit_veterinaria = '{$this->nit}', direccion_veterinaria = '{$this->direccion}', telefono_veterinaria = '{$this->telefono}', celular_veterinaria = '{$this->celular}', path_foto_veterinaria = '{$ruta}', activado_veterinaria = '{$this->activado}', id_veterinario = '{$this->idVeterinario}' WHERE id_veterinaria = '{$this->id}'";
            $this->con->consultaSimple($sql);
        }

        public function verComentario() {
          $sql = "SELECT * FROM tb_comentarios_veterinarias WHERE id_mascota = {$this->id}";
          $vacuna = $this->con->consultaRetorno($sql);

          return $vacuna;
        }

        public function misVeterinarias() {
          $sql = "SELECT * FROM tb_veterinarias WHERE id_veterinario = {$this->idVeterinario} AND activado_veterinaria = '1'";
          $resultado = $this->con->consultaRetorno($sql);

          return $resultado;
        }

        public function ingresarHistorial($idMascota, $peso, $sintomas, $diagnostico, $observacion, $idVeterinaria, $idVeterinario) {
            $sql = "INSERT INTO tb_visitas_veterinarias(peso_visita_veterinaria, sintomas_visita_veterinaria, diagnostico_visita_veterinaria, observaciones_visita_veterinaria, fecha_visita_veterinaria, id_mascota, id_veterinario, id_veterinaria) VALUES('{$peso}', '{$sintomas}', '{$diagnostico}', '{$observacion}', NOW(), '{$idMascota}', '{$idVeterinario}', '{$idVeterinaria}')";
            $this->con->consultaSimple($sql);
        }

    }
?>
