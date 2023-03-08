<?php
    require_once('../modelos/modeloretos.php');
    /**
     * Clase para la gestión de objetos de tipo ControladorRetos
     */
    class ControladorRetos{
        /**
         * Constructor para el instanciamiento de nuevos objetos de tipo ControladorRetos
         */
        function __construct(){       
            $this->modelo=new ModeloRetos();
        }
        
        /**
         *Método para la consulta de retos y devuelve el resultado
         */
        public function consultar(){
            $datos=$this->modelo->consultarRetos();
            $datos=$datos->fetch_all( $resulttype = MYSQLI_ASSOC);
            return $datos;
        }

        /**
         * Método que busca un reto según su id
         */
        public function consultarId($id){
            $datos=$this->modelo->consultarId($id);
            if($datos==NULL){
                return NULL;
            }
            else{
                $datos=$datos->fetch_all( $resulttype = MYSQLI_ASSOC);
                return $datos;
            }
        }

        /**
         * Método que consulta los retos según el filtro
         */
        public function consultarFiltro($cat){
            $datos=$this->modelo->consultarRetosFiltro($cat);
            $datos=$datos->fetch_all( $resulttype = MYSQLI_ASSOC);
            return $datos;
        }

        /**
         *Método para el envío de retos recibidas al modelo para su posterior insercción
         */
        public function insertar($reto){
            if($reto['inicio']>$reto['fin'] || $reto['inicioIns']>$reto['finIns'] || $reto['inicioIns']>$reto['inicio']){
                return 0;
            }
            else{
                $filas=$this->modelo->insertarReto($reto);
                if($filas=='errordesconocido'){
                    header('Location: erroreliminar.html');
                    exit;
                }
                else{
                    return $filas;
                }
            }
        }

        /**
         *Método para el énvio de una retos para eliminarla
         */
        public function eliminar($reto){
            $resultado=$this->modelo->eliminarReto($reto);
            if($resultado>0){
                header('Location: consultar_retos.php');
                exit;
            }
            else{
                header('Location: erroreliminar.html');
                exit;
            } 
        }

        /**
         *Método para el envío de retos recibidas al modelo para su posterior insercción
         */
        public function modificar($datos){
            if($datos['nombre']=='' || $datos['inicio']=='' || $datos['fin']==''||$datos['inicioIns']=='' || $datos['finIns']==''){
                header('Location:'.$_SERVER['HTTP_REFERER']);
                exit;
            }
            else if($datos['inicio']>$datos['fin'] || $datos['inicioIns']>$datos['finIns'] || $datos['inicioIns']>$datos['inicio']){
                return 0;
            }
            else{
                $resultado=$this->modelo->modificarReto($datos);
                if($resultado>=0){
                    header('Location: consultar_retos.php');
                    exit;
                }
                else if($resultado=='duplicado'){
                    header('Location:'.$_SERVER['HTTP_REFERER']);
                    exit;
                }
                else{
                    header('Location: erroreliminar.html');
                    exit;
                }
            }
        }
    }
?>