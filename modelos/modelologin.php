<?php
require_once('config/configdb.php');

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
    public function login($correo, $contra){
        $this->conectar();
        $select= "SELECT * FROM profesor WHERE correo=?";
        $peticion = $this->conexion->prepare($select);
        $peticion->bind_param("s",$correo);
        $peticion->execute();
        $datos=$peticion->get_result();

        $linea=$datos->fetch_assoc();
        if(password_verify($contra, $linea['contrasena'])){
            return $linea['idprofesor'];
        }
        else{
            return 0;
        }
        $this->conexion->close();
    }
}
?>