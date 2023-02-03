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
			require_once('modelos/modeloretos.php');
            $modeloRetos=new modeloRetos();
            $datos=$modeloRetos->consultarRetos();
			echo '<table>
					<tr>
						<th colspan="2">Nombre</th>
						<th colspan="1">Descripción</th>
						<th colspan="1">FechaInicio</th>
						<th colspan="1">FechaFin</th>
						<th colspan="1">Inicio Inscripción</th>
						<th colspan="1">Fin inscripción</th>
					</tr>';
			if($datos->num_rows>0){
				while($linea = $datos ->fetch_assoc()){
						echo '<tr>
						<td colspan="2">'.$linea['nombre'].'</td>
						<td colspan="2">'.$linea['descripcion'].'</td>
						';	
				}
			}
			else{
				echo '<tr><td>No hay valores.</td></tr>';
			}
			echo '<br/><button><a href="insertar_reto.php">INSERTAR NUEVO RETO</a></button>';
		?>
	</table>
  </body>
</html>