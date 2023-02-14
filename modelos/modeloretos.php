<?php
require_once('../config/conexion.php');

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

    public function consultarId($id){
        $this->conectar();
        $select= "SELECT * FROM retos WHERE idreto=".$id.";";
		$datos = $this->conexion->query($select);
        return $datos;
        $this->conexion->close();
    }

    /**
     * Insertar reto comprobando que no haya un reto con el mismo nombre
     */
    public function insertarReto($reto){
        $desc=$reto['descripcion'];
        if(empty($desc)){
            $desc='NULL';
        }
        else{
            $desc="'$desc'";
        }
        $this->conectar();
        $select= "INSERT INTO `retos` (`nombre`, `descripcion`, `fecha_inicio_reto`, `fecha_fin_reto`, `fecha_inicio_inscripcion`, `fecha_fin_inscripcion`,`publicada`, `idprofesor`, `idcategoria` ,`dirigido`) 
        VALUES ('".$reto['nombre']."', ".$desc.", '".$reto['inicio']."', '".$reto['fin']."','".$reto['inicioIns']."','".$reto['finIns']."',".$reto['opciones'].", 1, ".$reto['cat'].", '".$reto['dirigido']."');";
        try{
            $datos = $this->conexion->query($select);
            return $datos;
        }
        catch(Exception $e){
            $error=$this->conexion->errno;
            echo $e;
            // if($error==1062){
            //     return 'duplicado';
            // }
            // else{
            //     //echo $error;
            //     return 'errordesconocido';
            // }
        }
        $this->conexion->close();
    }

    /**
     * Eliminar una reto
     */
    public function eliminarReto($reto){
        $this->conectar();
        $select= "DELETE FROM retos WHERE idreto=".$reto."; ";
        try{
            $datos = $this->conexion->query($select);
            return $datos;
        }
        catch(Exception $e){
            $error=$this->conexion->errno;
            return 'errordesconocido';
        }
        $this->conexion->close();
    }
    /**
     * Método que modifica un reto comprobando antes si ya existe un valor igual en la base de datos
     */
    public function modificarCategoria($reto){
        $this->conectar();
        $this->conexion->close();
    }
}
?>