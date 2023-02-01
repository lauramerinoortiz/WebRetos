<!DOCTYPE html>
  <head>
    <meta charset="utf-8">
    <title>Modificar Categorias</title>
    <meta name="author" content="LAURA MERINO ORTIZ">
    <meta name="description" content="Esta es la descripción de mi web.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="../styles.css" type="text/css">
  </head>
  <body>
		<h1>Modificar categoría</h1>
		<?php
		require_once('controladores/controladorcategorias.php');
		if(empty($_POST)){
			$controlador=new ControladorCategorias();
			$datos=$controlador->consultar();
			if(isset($_GET['id'])){
				while($linea = $datos ->fetch_assoc()){
					if($linea['idcategoria']==$_GET['id']){
						$categoria=$linea['nombre'];
					}
				}
			}
			
			echo '<form method="POST" action="modificar.php">
			<label>Categoría <label>
			<input type="text" required="required" name="'.$_GET['id'].'" value="'.$categoria.'"/>
			<input type="submit" value="Guardar"/><br>
			</form>
			<p>Si el valor ya existe, se le volverá a pedir el dato.</p>';
		
		}		
		else{
			$controlador=new ControladorCategorias();
			$controlador->modificar($_POST);
		}
		?>
	</div>
  </body>
</html>
