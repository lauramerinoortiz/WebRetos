<?php
    require_once('modelos/modelocategorias.php');
    /**
     * Clase para la gestión de objetos de tipo ControladorCategorias
     */
    class ControladorCategorias{
        /**
         * Constructor para el instanciamiento de nuevos objetos de tipo ControladorCategorias
         */
        function __construct()
        {       
            $this->modelo=new ModeloCategorias();
        }
        /**
         *Método para la consulta de categorias y devuelve el resultado
         */
        public function consultar(){
            $datos=$this->modelo->consultarCategorias();
            return $datos;
        }
        /**
         *Método para el envío de categorias recibidas al modelo para su posterior insercción
         */
        public function insertar($categoria){
            $filas=$this->modelo->insertarCategoria($categoria);
            if($filas=='duplicado'){
                echo 'Valor existente';
            }
            else if($filas=='errordesconocido'){
                header('../vistas/erroreliminar.html');
            }
            else{
                return $filas;
            }
        }

        /**
         *Método para el énvio de una categoria para eliminarla
         */
        public function eliminar($datos){
            $resultado=$this->modelo->eliminarCategoria($datos);
            if($resultado>0){
                header('location: consultar_categoria.php ');
                exit;
            }
            else{
                header('../vistas/erroreliminar.html');
            } 
        }

        /**
         *Método para el envío de categorias recibidas al modelo para su posterior insercción
         */
        public function modificar($datos){
            $resultado=$this->modelo->modificarCategoria($datos);
            if($resultado=='ok'){
                header('location: consultar_categoria.php ');
                exit;
            }
            else if($resultado=='duplicado'){
                header('Location:' . getenv('HTTP_REFERER'));
            }
            else{
                header('location: ../vistas/erroreliminar.html ');
                exit;
            }
            
        }
    }
?>