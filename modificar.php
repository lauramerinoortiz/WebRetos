<!DOCTYPE html>
  <head>
    <meta charset="utf-8">
    <title>Modificar Categorias</title>
    <meta name="author" content="LAURA MERINO ORTIZ">
    <meta name="description" content="Esta es la descripción de mi web.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="styles.css" type="text/css">
  </head>
  <body>
		<h1>Modificar categoría</h1>
		<?php
			$usuario='user2daw_07';
			$contraseña='TUL9APOhnFN8';
			$basedatos='user2daw_BD1-07';
			$servidorbd='2daw.esvirgua.com';

			$conex =  new mysqli($servidorbd, $usuario, $contraseña, $basedatos);
			$select= "SELECT * FROM categorias;";
			$datos = $conex->query($select);
			$categoria='';
			
			if(isset($_GET['id'])){
				while($linea = $datos ->fetch_assoc()){
					if($linea['idcategoria']==$_GET['id']){
						$categoria=$linea['nombre'];
					}
				}
				echo'
				<form method="POST" action="modificar.php">
				<label>Categoría <label>
				<input type="text" required="required" name="'.$_GET['id'].'" value="'.$categoria.'"/>
				<input type="submit" value="Guardar"/><br>
				</form>
				';
			}
			else{
				
			}
			
			if(!empty($_POST)){
				$error=false;
				echo 'entra';
				$formulario = $_POST;
				foreach($formulario as $id => $nombre){
					echo 'dentro de form';
					while($linea = $datos ->fetch_assoc()){
						echo 'dentro de while';
						foreach($linea as $ind => $val){
							if($val==$nombre){
								echo 'dentro del if'; 
								$error=true;
								header('Location: consultar_categoria.php ');
								exit;
							}
							
						}
					}
					if(!$error){
						$conexion =  new mysqli($servidorbd, $usuario, $contraseña, $basedatos);
						$upd= "UPDATE categorias SET nombre='".$nombre."' WHERE idcategoria=".$id.";";
						$resultado = $conex->query($upd);
						if($resultado>0){
						echo 'header';
							header('location: consultar_categoria.php ');
							exit;
						}
						else{
							echo 'Ha ocurrido un error';
							echo '<br><a href="https://07.2daw.esvirgua.com/06BBDDRETOS/consultar_categoria.php ">Volver</a>';
							exit;
						}
					}
					else{
						header('Location:'.getenv('HTTP_REFERER'));
					}
				}
			}
			else{
				echo '<br>Pulse guardar siempre y cuando sea un nombre que no exista.';
			}
		?>
	</div>
  </body>
</html>
