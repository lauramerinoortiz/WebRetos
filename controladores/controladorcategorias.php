<?php
    require_once('../modelos/modelocategorias.php');
    /**
     * Clase para la gestión de objetos de tipo ControladorCategorias
     */
    class ControladorCategorias{
        /**
         * Constructor para el instanciamiento de nuevos objetos de tipo ControladorCategorias
         */
        function __construct(){       
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
         *Método para la consulta de categorias según su id y devuelve el resultado
         */
        public function consultarId($id){
            $datos=$this->modelo->consultarId($id);
            return $datos;
        }

        /**
         *Método para el envío de categorias recibidas al modelo para su posterior insercción
         */
        public function insertar($categoria){
            $filas=$this->modelo->insertarCategoria($categoria);
            if($filas==0){
                return 0;
            }
            else if($filas==-1){
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
            if(reset($datos)==''){
                header('Location:' . getenv('HTTP_REFERER'));
            }else{
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
    }
?>