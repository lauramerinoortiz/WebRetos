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
	<h1>Retos</h1>
		<?php
			require_once('controladores/controladorretos.php');
            $controladorRetos=new ControladorRetos();
            $datos=$controladorRetos->consultar();

			require_once('controladores/controladorcategorias.php');
            $controladorCat=new ControladorCategorias();
            $cat=$controladorCat->consultar();
			echo '<table id="retos">
					<tr>
						<th colspan="1">Nombre</th>
						<th colspan="1">Descripción</th>
						<th colspan="1">Inicio</th>
						<th colspan="1">Fin</th>
						<th colspan="1">Inicio Inscripción</th>
						<th colspan="1">Fin inscripción</th>
						<th colspan="1">Categoría</th>
					</tr>';
			if($datos->num_rows>0){
				while($linea = $datos ->fetch_assoc()){
						echo '<tr>
						<td colspan="1">'.$linea['nombre'].'</td>
						<td colspan="1">'.$linea['descripcion'].'</td>
						<td colspan="1">'.$linea['fecha_inicio_reto'].'</td>
						<td colspan="1">'.$linea['fecha_fin_reto'].'</td>
						<td colspan="1">'.$linea['fecha_inicio_inscripcion'].'</td>
						<td colspan="1">'.$linea['fecha_fin_inscripcion'].'</td>';
						while($cate = $cat ->fetch_assoc()){
							if($cate['idcategoria']==$linea['idcategoria']){
								echo '<td colspan="1">'.$cate['nombre'].'</td>';
							}					
						}
				}
			}
			else{
				echo '<tr><td>No hay valores.</td></tr>';
			}
			echo '<button><a href="index.html">Home</a></button>
			<br/><button><a href="insertar_reto.php">INSERTAR NUEVO RETO</a></button><br>';
		?>
	</table>
  </body>
</html>