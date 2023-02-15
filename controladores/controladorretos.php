<?php
    require_once('../modelos/modeloretos.php');
    /**
     * Clase para la gestión de objetos de tipo ControladorRetos
     */
    class ControladorRetos{
        /**
         * Constructor para el instanciamiento de nuevos objetos de tipo ControladorRetos
         */
        function __construct()
        {       
            $this->modelo=new ModeloRetos();
        }
        /**
         *Método para la consulta de retos y devuelve el resultado
         */
        public function consultar(){
            $datos=$this->modelo->consultarRetos();
            return $datos;
        }

        public function consultarId($id){
            $datos=$this->modelo->consultarId($id);
            return $datos;
        }
        /**
         *Método para el envío de retos recibidas al modelo para su posterior insercción
         */
        public function insertar($reto){
            $filas=$this->modelo->insertarReto($reto);
            if($filas=='duplicado'){
                echo 'Valor existente';  //objetivo quitarlo
            }
            else if($filas=='errordesconocido'){
                header('../vistas/erroreliminar.html');
            }
            else{
                return $filas;
            }
        }

        /**
         *Método para el énvio de una retos para eliminarla
         */
        public function eliminar($reto){
            $resultado=$this->modelo->eliminarReto($reto);
            if($resultado>0){
                header('location: consultar_retos.php ');
                exit;
            }
            else{
                header('../vistas/erroreliminar.html');
            } 
        }

        /**
         *Método para el envío de retos recibidas al modelo para su posterior insercción
         */
        public function modificar($datos){
            if($datos['nombre']=='' || $datos['inicio']='' || $datos['fin']==''||$datos['inicioIns']=='' || $datos['finIns']=''){
                header('Location:' . getenv('HTTP_REFERER'));
            }
            else{
                $resultado=$this->modelo->modificarReto($datos);
                if($resultado>0){
                    header('location: consultar_retos.php ');
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