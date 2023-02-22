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
        <nav>
            <ul>
                <a href="../index.html"><li>Home</li></a>
                <li id="sub"><a href="consultar_retos.php">Retos</a>
                <ul>
                    <a href="insertar_reto.php"><li class="primer">Nuevo Reto</li></a>
                    <a href="consultar_retos.php"><li>Listado</li></a>
                </ul>
                </li>
                <li id="sub2"><a href="consultar_categoria.php">Categorías</a>
                <ul>
                    <a href="insertar_categoria.php"><li class="primer">Nueva Categoría</li></a>
                    <a href="consultar_categoria.php"><li>Listado</li></a>
                </ul></li>
                <a href=""><li>Inscribir</li></a>
            </ul>
        </nav>
        <h1>Datos del reto</h1>
        <?php 
            if(isset($_GET['id'])){
                require_once('../controladores/controladorretos.php');
                $controladorRetos=new ControladorRetos();
                $datos=$controladorRetos->consultarId($_GET['id']);
                $reto=$datos->fetch_assoc();
            }
            else{
                echo 'Ha habido algún error. Inténtelo con otro reto.';
            }
        ?>
        <table id="datos">
            <tbody>
                <tr>
                    <th>Nombre</th>
                    <td><?php echo $reto['nombre'] ;?></td>
                </tr>
                <tr>
                    <th>Descripción</th>
                    <td><?php echo $reto['descripcion'] ;?></td>
                </tr>
                <tr>
                    <th>Inicio Reto</th>
                    <td><?php echo $reto['fecha_inicio_reto'] ;?></td>
                </tr>
                <tr>
                    <th>Fin Reto</th>
                    <td><?php echo $reto['fecha_fin_reto'] ;?></td>
                </tr>
                <tr>
                    <th>Inicio Inscripción</th>
                    <td><?php echo $reto['fecha_inicio_inscripcion'] ;?></td>
                </tr>
                <tr>
                    <th>Fin Inscripción</th>
                    <td><?php echo $reto['fecha_fin_inscripcion'] ;?></td>
                </tr>
                <tr>
                    <th>Dirigido a</th>
                    <td><?php echo $reto['dirigido'] ;?></td>
                </tr>
                <tr>
                    <th>Publicado</th>
                    <td><?php 
                        if($reto['publicado']==0){
                            echo 'No';
                        }
                        else{
                            echo 'Si';
                        }
                    ?></td>
                </tr>
                <tr>
                    <th>Categoria</th>
                    <td><?php 
                    require_once('../controladores/controladorcategorias.php');
                    $controladorCat=new ControladorCategorias();
                    $cat=$controladorCat->consultarId($reto['idcategoria']);
                    $fila=$cat->fetch_assoc();
                    echo $fila['nombre'];
                    ?></td>
                </tr>
            </tbody>
        </table>
        <button><a href="modificarReto.php?idReto=<?php echo $reto['idreto']?>">Modificar</a></button>
	    <button><a href="consultar_retos.php?idReto=<?php echo $reto['idreto']?>">Borrar</a></button>
    </body>
</html>