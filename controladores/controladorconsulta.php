<?php
    require_once('../modelos/modelocategorias.php');
    /**
     * Clase para la gestión de objetos de tipo ControladorCategorias
     */
    class ControladorConsulta{
        /**
         * Constructor para el instanciamiento de nuevos objetos de tipo ControladorCategorias
         */
        function __construct()
        {       
            $this->modelo=new ModeloCategorias();
        }

        /**
         *Método para el énvio de una categoria para eliminarla
         */
        public function get($vacio){
            $this->modelo->consultarCategorias();
        }
    }
?>