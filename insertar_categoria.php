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
		<div id="form">
			<form action="insertar_categoria.php" method="post">
				<label for="nombre">Nueva categoría</label><br>
				<input type="text" id="nombre" name="nombre">
				<input type="submit" >
				<input type="reset" name="restablecer" value="Restablecer">
			</form>
		</div>
		<?php
			$usuario='user2daw_07';
			$contraseña='TUL9APOhnFN8';
			$basedatos='user2daw_BD1-07';
			$servidorbd='2daw.esvirgua.com';

			$conex =  new mysqli($servidorbd, $usuario, $contraseña, $basedatos);
			$select= "SELECT nombre FROM categorias;";
			$datos = $conex->query($select);

			if(empty($_POST['nombre'])){
					echo '<br>Añadir un nombre.';
			}
			
			else{
				$nombre=$_POST['nombre'];
				$existe=false;
				while($linea = $datos ->fetch_assoc()){
					foreach($linea as $ind => $val){
						if($val==$nombre){
							echo 'Valor existente.';
							$existe=true;
						}
					}	
				}
				if($existe==false){
					$conexion =  new mysqli($servidorbd, $usuario, $contraseña, $basedatos);
					$consulta="INSERT INTO categorias (nombre) VALUES ('".$nombre."')";
					$resultado = $conexion->query($consulta);
					echo'<br>Se han registrado '.$conexion->affected_rows.' fila/s.';
				}
				else{
					echo '<br>Volver a intentar.';
				}
			}
		?>
		
		<br/><button><a href="consultar_categoria.php">CONSULTAR CATEGORÍAS</a></button>
	</body>
</html>