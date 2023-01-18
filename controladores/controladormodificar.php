<?php
    require_once('../modelos/modelocategorias.php');
    /**
     * Clase para la gestión de objetos de tipo ControladorCategorias
     */
    class ControladorModificar{
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
        public function post($datos){
            $this->modelo->modificarCategoria($datos);
        }

        
    }
?>