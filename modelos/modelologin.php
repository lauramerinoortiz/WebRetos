<?php
require_once('config/conexion.php');

class ModeloLogin{
    function __construct(){
        $this->servidor = constant('SERVIDOR');
        $this->usuario = constant('USUARIO');
        $this->contrasenia = constant('CONTRASENIA');
        $this->bd = constant('BD');
    }
    /**
     * Iniciar conexión con la base de datos.
     */
    private function conectar(){     
        $this->conexion = new mysqli($this->servidor,  $this->usuario,  $this->contrasenia, $this->bd);
        $this->conexion->set_charset('utf8');
    }

    /**
     * Sacar categorias
     */
    public function login($correo){
        $this->conectar();
        $select= "SELECT * FROM profesor WHERE correo='".$correo."';";
		$datos = $this->conexion->query($select);
        if(($datos->num_rows)>0){
            $linea = $datos ->fetch_assoc();
            return $linea['idprofesor'];
        }
        else{
            return 0;
        }
        return $datos;
        $this->conexion->close();
    }
}
?>