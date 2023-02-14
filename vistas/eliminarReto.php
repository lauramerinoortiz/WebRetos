<!DOCTYPE html>
  <head>
    <meta charset="utf-8">
    <title>Retos</title>
    <meta name="author" content="LAURA MERINO ORTIZ">
    <meta name="description" content="Esta es la descripción de mi web.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="../styles.css" type="text/css">
  </head>
  <body>
    <?php 
        if(isset($_GET['id'])){
            require_once('../controladores/controladorretos.php');
            $controladorRetos=new ControladorRetos();
            $controladorRetos->eliminar($_GET['id']);
        }
        else{
          echo '<h1>¿Seguro que quieres eliminar '.$nombre.'?</h1>
          <button class="modificar"><a href="eliminarReto.php?id='.$id.'">Sí</button>
          <button class="eliminar"><a href="consultar_retos.php">No</button>';
        }
    ?>
    
  </body>
</html>