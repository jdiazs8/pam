<?php
    class Mascota {
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
            $sql = "INSERT INTO tb_veterinarias(nombre_veterinaria, nit_veterinaria, direccion_veterinaria, path_foto_veterinaria, activado_veterinaria, fecha_registro_veterinaria, id_veterinario) VALUES('{$this->nombre}', '{$this->nit}', '{$this->direccion}', '{$this->pathFoto}', '{$this->activado}', '{$this->fechaRegistro}', '{$this->idVeterinario}')";
            $this->con->consultaSimple($sql);
                
            return true;
            
        }
        
        public function eliminar() {
            $sql = "UPDATE tb_veterinarias SET activado_veterinaria = '{$this->activado}', WHERE id_veterinaria = '{$this->id}'";
            $this->con->consultaSimple($sql);
            
        }
        
        public function ver() {
            $sql = "SELECT *  FROM tb_veterinarias WHERE id_veterinaria = '{$this->id}' LIMIT 1";
            $resultado = $this->con->consultaRetorno($sql);
            
            $row = mysqli_fetch_assoc($resultado);
            
            $this->id = $row['id_veterinaria'];
            $this->nombre = $row['nombre_veterinaria'];
            $this->nit = $row['nit_veterinaria'];
            $this->direccion = $row['direccion_veterinaria'];
            $this->pathFoto = $row['path_foto_veterinaria'];
            $this->cantidadVotos = $row['cantidad_votos_veterinaria'];
            $this->totalVotos = $row['total_votos_veterinaria'];
            $this->activado = $row['activado_veterinaria'];
            $this->fechaRegistro = $row['fecha_registro_veterinaria'];
            $this->fechaUM = $row['fecha_ultm_veterinaria'];
            $this->idVeterinario = $row['id_veterinario'];
            
            return $row;
            
        }
        
        public function editar() {
            $sql = "UPDATE tb_veterinarias SET nombre_veterinaria = '{$this->nombre}', nit_veterinaria = '{$this->nit}', direccion_veterinaria = '{$this->direccion}', path_foto_veterinaria = '{$this->pathFoto}', activado_veterinaria = '{$this->activado}', id_veterinario = '{$this->idVeterinario}' WHERE id_veterinaria = '{$this->id}'";
            
        }
        
    }
?>