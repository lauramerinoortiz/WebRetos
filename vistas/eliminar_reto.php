<?php 

  //Comprobamos la sesion
    if(!isset($_SESSION['idprofesor'])) {
          header('Location: ../index.php');
      }
  
    if(isset($_GET['id'])){
        require_once('../controladores/controladorretos.php');
        $controladorRetos=new ControladorRetos();
        $controladorRetos->eliminar($_GET['id']);
    }
    else{
      echo '<h1>¿Seguro que quieres eliminar '.$nombre.'?</h1>
      <button class="modificar"><a href="eliminar_reto.php?id='.$id.'">Sí</button>
      <button class="eliminar"><a href="consultar_retos.php">No</button>';
    }
?>