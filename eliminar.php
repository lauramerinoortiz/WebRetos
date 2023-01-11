
<?php
	$usuario='user2daw_07';
	$contraseña='TUL9APOhnFN8';
	$basedatos='user2daw_BD1-07';
	$servidorbd='2daw.esvirgua.com';

	$conex =  new mysqli($servidorbd, $usuario, $contraseña, $basedatos);
	

	if(isset($_GET['nombre'])){
		$borrar= "DELETE FROM categorias WHERE nombre='".$_GET['nombre']."';";
		$datos = $conex->query($borrar);
		if($datos>0){
			header('location: https://07.2daw.esvirgua.com/06BBDDRETOS/consultar_categoria.php ');
			exit;
		}
		else{
			echo '
			<html>
				<head>
					<meta charset="utf-8">
					<title>Categorias</title>
					<meta name="author" content="LAURA MERINO ORTIZ">
					<meta name="description" content="Esta es la descripción de mi web.">
					<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
					<link rel="stylesheet" href="styles.css" type="text/css">
				 </head>
				 <body>
					<h1>Ha ocurrido un error.</h1>
					<button><a href="consultar_categoria.php">Volver.</a></button>
				 </body>
			</html>
			';
		}
	}
	else{
		echo 'Error';
	}
	
?>

