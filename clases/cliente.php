<?php
    include_once('usuario.php');
    
    class Cliente extends Usuario {
        private $mascotas = array();
        
        public function listar() {
            $sql = "SELECT * FROM tb_clientes";
            $resultado =$this->con->consultaRetorno($sql);
            return $resultado;
            
        }
        
        public function crear() {
            $sql = "SELECT * FROM tb_clientes WHERE identificacion_cliente = '{$this->identificacion}'";
            $resultado = $this->con->consultaRetorno($sql);
            $num = mysqli_num_rows($resultado);
            
            if($num != 0) {
                return false;
                
            }else {
                $sql2 = "INSERT INTO tb_clientes(nombre_cliente, apellido_cliente, identificacion_cliente, correo_cliente, contrasena_cliente, direccion_cliente, telefono_cliente, celular_cliente, path_foto_cliente, fecha_registro_cliente, fecha_ultm_cliente, id_usuario) VALUES('{$this->nombre}', '{$this->apellido}', '{$this->identificacion}', '{$this->correo}', md5('{$this->contrasena}'), '{$this->direccion}', '{$this->telefono}', '{$this->celular}', '{$this->pathFoto}', NOW(), NOW(), '{$this->idUsuario}')";
                $this->con->consultaSimple($sql2);
                
                return true;
                
            }
            
        }
        
        public function eliminar() {
            $sql = "DELETE FROM tb_clientes WHERE id_cliente = '{$this->id}'";
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
            $this->fechaRegistro = $row['fecha_registro_cliente'];
            $this->fechaUM = $row['fecha_ultm_cliente'];
            $this->idUsuario = $row['id_usuario'];
            
            return $row;
            
        }
        
        public function editar() {
            $sql = "UPDATE tb_clientes SET nombre_cliente = '{$this->nombre}', apellido_cliente = '{$this->apellido}', identificacion_cliente = '{$this->identificacion}', correo_cliente = '{$this->correo}', contrasena_cliente = md5('{$this->contrasena}'), direccion_cliente = '{$this->direccion}', telefono_cliente = '{$this->telefono}', celular_cliente = '{$this->celular}', path_foto_cliente = '{$this->pathFoto}' WHERE id_cliente = '{$this->id}'";
        }
        
    }
    

?>