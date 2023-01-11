<?php
// require_once('config/conexion.php');
define('SERVIDOR', '2daw.esvirgua.com');
define('USUARIO', 'user2daw_07');
define('CONTRASENIA', 'TUL9APOhnFN8');
define('BD', 'user2daw_BD1-07');

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
    private function conectar()
    {     
        $this->conexion = new mysqli($this->servidor,  $this->usuario,  $this->contrasenia, $this->bd);
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
     * Insertar categoria
     */
    public function insertarCategoria($datos){
        $this->conectar();
        $consulta="INSERT INTO categorias (nombre) VALUES ('".$nombre."')";
		$datos = $this->conexion->query($consulta);
        return $this->conexion->affected_rows;
        $this->conexion->close();
    }

    /**
     * Eliminar una categoria
     */
    public function eliminarCategoria($datos){
        $this->conectar();
        $borrar= "DELETE FROM categorias WHERE nombre='".$datos['nombre']."';";
		$resultado = $this->conexion->query($borrar);
        if($this->conexion->affected_rows>0){
            header('location: ../../consultar_categoria.php ');
			exit;
        }
        else{
            require_once('../vistas/erroreliminar.html');
        } 
        $this->conexion->close();
    }
}
?>