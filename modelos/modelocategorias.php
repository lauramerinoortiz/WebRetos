<?php
require_once('../config/configdb.php');

class ModeloCategorias{
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
    public function consultarCategorias(){
        $this->conectar();
        $select= "SELECT * FROM categorias;";
		$datos = $this->conexion->query($select);
        return $datos;
        $this->conexion->close();
    }

    /**
     * Método que saca la categoría según un id
     */
    public function consultarId($id){
        $this->conectar();
        $select= "SELECT * FROM categorias WHERE idcategoria=".$id.";";
		$datos = $this->conexion->query($select);
        return $datos;
        $this->conexion->close();
    }

    /**
     * Insertar categoria
     */
    public function insertarCategoria($nombre){
        $this->conectar();
        $consulta="INSERT INTO categorias (nombre) VALUES ('".$nombre."')";
		try{
            $datos = $this->conexion->query($consulta);
            return $this->conexion->affected_rows;
        }
        catch(Exception $e){
            $error=$this->conexion->errno;
            if($error==1062){
                return 0;
            }
            else{
                return -1;
            }
        }
        $this->conexion->close();
    }

    /**
     * Eliminar una categoria
     */
    public function eliminarCategoria($datos){
        $this->conectar();
        $borrar= "DELETE FROM categorias WHERE nombre='".$datos['nombre']."';";
		$resultado = $this->conexion->query($borrar);
        $resultado=$this->conexion->affected_rows;
        return $resultado;
        $this->conexion->close();
    }
    /**
     * Método que modifica una categoría data comprobando antes si ya existe un valor igual en la base de datos
     */
    public function modificarCategoria($post){
        if(!empty($post)){
            $formulario = $post;
            foreach($formulario as $id => $nombre){
                    $this->conectar();
                    $upd= "UPDATE categorias SET nombre='".$nombre."' WHERE idcategoria=".$id.";";
                    try{
                        $resultado = $this->conexion->query($upd);
                        if($resultado>0){
                            return 1;
                        }
                    }
                    catch(Exception $e){
                        $error=$this->conexion->errno;
                        if($error==1062){
                            return 0;
                        }
                        else{
                            return -1;
                        }
                    }
            }
        }
        else{
            return 'errormodificar';
        }
    }
}
?>