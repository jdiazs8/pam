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
            $sql = "INSERT INTO tb_mascotas(nombre_mascota, fecha_nacimiento_mascota, activado_mascota, fecha_registro_mascota, id_cliente, id_especie, id_raza) VALUES('{$this->nombre}', '{$this->fechaNacimiento}', '{$this->activado}', NOW(), '{$this->idCliente}', '{$this->idEspecie}', '{$this->idRaza}')";
            $this->con->consultaSimple($sql);
                
            return true;
            
        }
        
        public function eliminar() {
            $sql = "UPDATE tb_mascotas SET activado_mascota = '{$this->activado}', WHERE id_mascota = '{$this->id}'";
            $this->con->consultaSimple($sql);
            
        }
        
        public function ver() {
            $sql = "SELECT *  FROM tb_mascotas WHERE id_mascota = '{$this->id}' LIMIT 1";
            $resultado = $this->con->consultaRetorno($sql);
            
            $row = mysqli_fetch_assoc($resultado);
            
            $this->id = $row['id_mascota'];
            $this->nombre = $row['nombre_mascota'];
            $this->apellido = $row['apellido_mascota'];
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
        
        public function editar() {
            $sql = "UPDATE tb_mascotas SET nombre_mascota = '{$this->nombre}', identificacion_mascota = '{$this->identificacion}', fecha_nacimiento_mascota = '{$this->fechaNacimiento}', direccion_mascota = '{$this->direccion}', path_foto_mascota = '{$this->pathFoto}', path_foto_cvacunas = '{$this->pathVacuna}', activado_mascota = '{$this->activado}', id_cliente = '{$this->idCliente}', id_especie = '{$this->idEspecie}', id_raza = '{$this->idRaza}' WHERE id_mascota = '{$this->id}'";
            
        }
        
    }
?>