<?php
require_once('../config/conexion.php');

class ModeloRetos{
    function __construct(){
        $this->servidor = constant('SERVIDOR');
        $this->usuario = constant('USUARIO');
        $this->contrasenia = constant('CONTRASENIA');
        $this->bd = constant('BD');
        if(isset($_SESSION['idprofesor'])){
            $this->idProfesor=$_SESSION['idprofesor'];
        }
        
    }
    /**
     * Iniciar conexión con la base de datos.
     */
    private function conectar(){     
        $this->conexion = new mysqli($this->servidor,  $this->usuario,  $this->contrasenia, $this->bd);
        $this->conexion->set_charset('utf8');
    }

    /**
     * Saca todos los retos que tiene
     */
    public function consultarRetos(){
        $this->conectar();
        $select= "SELECT * FROM retos WHERE idprofesor=".$this->idProfesor.";";
		$datos = $this->conexion->query($select);
        return $datos;
        $this->conexion->close();
    }
    /**
     * Método que consulta los retos según el filtro seleccionado
     */
    public function consultarRetosFiltro($cat){
        $this->conectar();
        $select= "SELECT * FROM retos WHERE idcategoria=".$cat." AND idprofesor=".$this->idProfesor.";";
		$datos = $this->conexion->query($select);
        return $datos;
        $this->conexion->close();
    }
    /**
     * Método que consulta el reto según su id
     */
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
        $select= "INSERT INTO `retos` (`nombre`, `descripcion`, `fecha_inicio_reto`, `fecha_fin_reto`, `fecha_inicio_inscripcion`, `fecha_fin_inscripcion`,`publicado`, `idprofesor`, `idcategoria` ,`dirigido`) 
        VALUES ('".$reto['nombre']."', ".$desc.", '".$reto['inicio']."', '".$reto['fin']."','".$reto['inicioIns']."','".$reto['finIns']."',".$reto['opciones'].", ".$this->idProfesor.", ".$reto['cat'].", '".$reto['dirigido']."');";
        try{
            $datos = $this->conexion->query($select);
            return $this->conexion->affected_rows;
        }
        catch(Exception $e){
            $error=$this->conexion->errno;
            if($error==1062){
                return 'duplicado';
            }
            else{
                return 'errordesconocido';
            }
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
    public function modificarReto($reto){
        $this->conectar();
        try{
            $upd= "UPDATE retos SET nombre='".$reto['nombre']."', descripcion='".$reto['descripcion']."', publicado=".$reto['opciones'].", dirigido='".$reto['dirigido']."', idcategoria=".$reto['cat'].", fecha_inicio_inscripcion='".$reto['inicioIns']."', fecha_fin_inscripcion='".$reto['finIns']."', fecha_inicio_reto='".$reto['inicio']."', fecha_fin_reto='".$reto['fin']."'  WHERE idreto=".$reto['id'].";";
            $this->conexion->query($upd);
            return $this->conexion->affected_rows;
        }
        catch(Exception $e){
            $error=$this->conexion->errno;
            if($error==1062){
                return 'duplicado';
            }
            else{
                return -1;
            }
        }
        $this->conexion->close();
    }
}
?>