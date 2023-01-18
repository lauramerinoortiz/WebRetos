<?php
    //Obtenemos el array de configuración descrito en config/config.php para así facilitar la gestión
    $config=require_once("../config/config.php");
    //Leemos el metodo de la petición que recibimos
    $metodo=$_SERVER['REQUEST_METHOD'];

    //Recogemos los pathparams, en nuestro caso, seran los indicadores de a que controlador deben de dirigirse dicha solicitud
    $pathParams=null;
    if(isset($_SERVER['PATH_INFO'])){//Estos parámetros si existen, estaran recogidos en ese elemento del array $_SERVER
        $pathParams=explode('/',$_SERVER['PATH_INFO']);//Con el siguiente método, estamos conformando un array que parte de $_SERVER['PATH_INFO'] y que
                                                        //y que separamos con / que es como viene en la petición
    }
    //El controlador siempre sera el primero en recibirse, no se pone el 0 por que viene vacío
    $controlador=$pathParams[1];
    $parametrosQuery=null;
    //Función específica para la lectura de parametros query de las peticiones, lee dichos parámetros y los inserta en $paramQuery
    parse_str($_SERVER["QUERY_STRING"],$parametrosQuery);
    switch($controlador){
        case 'controladorcategorias':
            require_once($config['path_controladores'].'controladorcategorias.php');
            $controlador=new ControladorCategorias();
            break;
        case 'controladormodificar':
            require_once($config['path_controladores'].'controladormodificar.php');
            $controlador=new ControladorModificar();
            break;
        case 'controladorconsulta':
            require_once($config['path_controladores'].'controladorconsulta.php');
            $controlador=new ControladorConsulta();
            break;
    }
    switch($metodo){
    case 'POST':
        $controlador->post($_POST);
        die();
        break;
    case "GET":
        $controlador->get($parametrosQuery);
        die();
        break;
   }
    
?>