<!DOCTYPE html>
  <head>
    <meta charset="utf-8">
    <title>Categorias</title>
    <meta name="author" content="LAURA MERINO ORTIZ">
    <meta name="description" content="Esta es la descripción de mi web.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="styles.css" type="text/css">
  </head>
  <body>
	<h1>CATEGORÍAS</h1>
		<?php
		if(isset($_GET['nombre'])){
			echo '<h1>¿Seguro que quiere eliminar '.$_GET['nombre'].' ?</h1>
				<button class="modificar"><a href="fachada/fachada.php/controladorcategorias?nombre='.$_GET['nombre'].'">Sí</button>
				<button class="eliminar"><a href="consultar_categoria.php">No</button>
			';
		}
		else{
			require_once('modelos/modelocategorias.php');
            $modeloCategorias=new ModeloCategorias();
            $datos=$modeloCategorias->consultarCategorias();
			echo '<table><tr><th colspan="2">Datos introducidos</th><th colspan="1">Opciones</th></tr>';
			if($datos->num_rows>0){
				while($linea = $datos ->fetch_assoc()){
						echo '<tr>
						<td colspan="2">'.$linea['nombre'].'</td>
						<td><a href="vistas/modificar.php?id='.$linea['idcategoria'].'">✎</a>
							<a href="consultar_categoria.php?nombre='.$linea['nombre'].'&id='.$linea['idcategoria'].'">🗑</a></td>
						</tr>';	
				}
			}
			else{
				echo '<tr><td>No hay valores.</td></tr>';
			}
			echo '<br/><button><a href="insertar_categoria.php">INSERTAR CATEGORÍAS</a></button>';
		}
		?>
	</table>
  </body>
</html>