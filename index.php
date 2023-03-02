<?php 
  session_start();
  if(!isset($_SESSION['idprofesor'])) {
    require_once('vistas/inicio_sesion.php');
  }
  else{
    
?>
<!DOCTYPE html>
  <head>
    <meta charset="utf-8">
    <title>Retos</title>
    <meta name="author" content="LAURA MERINO ORTIZ">
    <meta name="description" content="Esta es la descripción de mi web.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="styles.css" type="text/css">
  </head>
  <body>
    <nav>
      <ul>
        <a href="./index.php"><li id="logo"></li></a>
        <li id="sub"><a href="vistas/consultar_retos.php">Retos</a>
          <ul>
            <a href="vistas/insertar_reto.php"><li class="primer">Nuevo Reto</li></a>
            <a href="vistas/consultar_retos.php"><li>Listado</li></a>
          </ul>
        </li>
        <li id="sub2"><a href="vistas/consultar_categoria.php">Categorías</a>
          <ul>
            <a href="vistas/insertar_categoria.php"><li class="primer">Nueva Categoría</li></a>
            <a href="vistas/consultar_categoria.php"><li>Listado</li></a>
          </ul></li>
        <a href="vistas/pdf.php"><li>PDF</li></a>
        <a href="vistas/cerrar_sesion.php"><li>Cerrar sesión</li></a>
      </ul>
    </nav>
    <h1 id="titulo">Bienvenido/a a la web de Retos</h1>
  </body>
  <?php 
    }
  ?>
</html>