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
        public function login($correo,$contra){
            $id=$this->modelo->login($correo,$contra);
            if($id>0){
                session_start();
                $_SESSION['idprofesor']=$id;
                header('Location: index.php');
            }
            else{
                
            }
        }
    }
?>