<?php
    require_once('modelos/modelologin.php');
    /**
     * Clase para la gestión de objetos de tipo ControladorCategorias
     */
    class ControladorLogin{
        /**
         * Constructor para el instanciamiento de nuevos objetos de tipo ControladorCategorias
         */
        function __construct(){       
            $this->modelo=new ModeloLogin();
        }

        /**
         *Método para la consulta de categorias y devuelve el resultado
         */
        public function login($correo){
            $id=$this->modelo->login($correo);
            if($id>0){
                setcookie ("id", $id, time()+120);
                header('Location: index.php');
            }
            else{
                
            }
        }
    }
?>