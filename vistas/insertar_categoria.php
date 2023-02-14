<!DOCTYPE html>
	<head>
		<meta charset="utf-8">
		<title>Categorias</title>
		<meta name="author" content="LAURA MERINO ORTIZ">
		<meta name="description" content="Esta es la descripción de mi web.">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
		<link rel="stylesheet" href="../styles.css" type="text/css">
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
			if(empty($_POST['nombre'])){
					echo '<br>Añadir un nombre.';
			}
			
			else{
				require_once('../controladores/controladorcategorias.php');
				$controladorCategorias=new ControladorCategorias();
				$nombre=$_POST['nombre'];
				$filas= $controladorCategorias->insertar($nombre);
				if($filas>0){
					echo'<br>Se han registrado '.$filas.' fila/s.';
				}				
			}
		?>
		
		<br/><button><a href="consultar_categoria.php">CONSULTAR CATEGORÍAS</a></button>
	</body>
</html>