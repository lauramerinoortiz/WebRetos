<?php
    require_once('../modelos/modelocategorias.php');
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
         *Método para el envío de categorias recibidas al modelo para su posterior insercción
         */
        public function post($categoria){
            $this->modelo->insertarCategoria($categoria);
        }

        /**
         *Método para el énvio de una categoria para eliminarla
         */
        public function get($datos){
            $this->modelo->eliminarCategoria($datos);
        }
    }
?>