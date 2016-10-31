<?php
    include_once('usuario.php');
    
    class Cliente extends Usuario {
        private $tprofesional;
        private $veterinarias = array();
        
        public function listar() {
            $sql = "SELECT * FROM tb_veterinarios";
            $resultado =$this->con->consultaRetorno($sql);
            return $resultado;
            
        }
        
        public function crear() {
            $sql = "SELECT * FROM tb_veterinarios WHERE identificacion_veterinario = '{$this->identificacion}'";
            $resultado = $this->con->consultaRetorno($sql);
            $num = mysqli_num_rows($resultado);
            
            if($num != 0) {
                return false;
                
            }else {
                $sql2 = "INSERT INTO tb_veterinarios(nombre_veterinario, apellido_veterinario, identificacion_veterinario, tprofesional_veterinario, correo_veterinario, contrasena_veterinario, activado_veterinario, fecha_registro_veterinario, id_usuario) VALUES('{$this->nombre}', '{$this->apellido}', '{$this->identificacion}', '{$this->tprofesional}','{$this->correo}', md5('{$this->contrasena}'), '{$this->activado}', NOW(), '{$this->idUsuario}')";
                $this->con->consultaSimple($sql2);
                
                $carpeta = "usuarios/veterinarios/{$this->identificacion}/";//colocar la carpeta usuarios/clientes/
                if(!file_exists($carpeta)) {
                    mkdir($carpeta, 0777, true);
    
                }
                    
                return true;
                
            }
            
        }
        
        public function eliminar() {
            $sql = "UPDATE tb_veterinarios SET activado_veterinario = '{$this->activado}', WHERE id_veterinario = '{$this->id}'";
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
        
        public function editar() {
            $sql = "UPDATE tb_veterinarios SET nombre_veterinario = '{$this->nombre}', apellido_veterinario = '{$this->apellido}', identificacion_veterinario = '{$this->identificacion}', tprofesional_veterinario = '{$this->tprofesional}', correo_veterinario = '{$this->correo}', contrasena_veterinario = md5('{$this->contrasena}'), direccion_veterinario = '{$this->direccion}', telefono_veterinario = '{$this->telefono}', celular_veterinario = '{$this->celular}', path_foto_veterinario = '{$this->pathFoto}', activado_veterinario = '{$this->activado}' WHERE id_veterinario = '{$this->id}'";
            
        }
        
        public function cargarVeterinarias() {
            $sql = "SELECT * FROM tb_mascotas WHERE id_cliente = '{$this->id}'";
            $veterinarias =$this->con->consultaRetorno($sql);
            return $veterinarias;
            
        }
        
    }

?>