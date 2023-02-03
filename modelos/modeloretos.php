<?php
require_once('config/conexion.php');

class ModeloRetos{
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
    }

    /**
     * Saca todos los retos que tiene
     */
    public function consultarRetos(){
        $this->conectar();
        $select= "SELECT * FROM retos;";
		$datos = $this->conexion->query($select);
        return $datos;
        $this->conexion->close();
    }

    /**
     * Insertar reto comprobando que no haya un reto con el mismo nombre
     */
    public function insertarRetos($reto){
        $this->conectar();
        
        $this->conexion->close();
    }

    /**
     * Eliminar una reto
     */
    public function eliminarReto($reto){
        $this->conectar();
        
        $this->conexion->close();
    }
    /**
     * Método que modifica un reto comprobando antes si ya existe un valor igual en la base de datos
     */
    public function modificarCategoria($reto){
        
    }
}
?>