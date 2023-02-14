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
		<div id="formReto">
			<form action="insertar_reto.php" method="post">
				
			<h1>Nuevo reto</h1>
			<label for="nombre" id="labelNombre">*Nombre del reto:</label><input type="text" id="nombre" name="nombre"><br>
			<label for="descripcion" id="labelDesc">Descripción del reto:</label><textarea id="descripcion" name="descripcion"></textarea><br>
			<label for="publiopciones" id="labelOpciones">*¿Publicar ya?</label>
			<div id="publiopciones">
				<label for="publicadaSi"><input type="radio" name="opciones" value=1  id="publicadaSi">Si</label>
				<label for="publicadaNo" id="labelPublicadaNo"><input type="radio" value=0 name="opciones" id="publicadaNo" checked>No</label>
			</div><br>

			<label for="dirigido" id="labelDirigido">*Dirigido a:</label>
			<select id="dirigido" name="dirigido">
				<option value="infantil">INFANTIL</option>
				<option value="eso">ESO</option>
				<option value="bachillerato">BACHILLERATO</option>
				<option value="gm">GM</option>
				<option value="gs">GS</option>
			</select>

			<label for="categoria" id="labelCategoria">*Categoría:</label>
			<select id="categoria" name="cat">
				<?php 
					require_once('../controladores/controladorcategorias.php');
					$controlador=new ControladorCategorias();
					$datos=$controlador-> consultar();
					if($datos->num_rows>0){
						while($linea = $datos ->fetch_assoc()){
							echo '<option value="'.$linea['idcategoria'].'">'.$linea['nombre'].'</option>';
						}
					}
					else{
						echo '<option>No hay categorias</option>';
					}
				?>

			</select><br>

			<div id="inscripcion">
				<h3>Fecha inscripción</h3>
				<label>*Fecha inicio:</label><input type="date" name="inicioIns">
				<label>*Fecha fin:</label><input type="date" name="finIns">
			</div><br>

			<div id="realizacion">
				<h3>Fecha realización</h3>
				<label>*Fecha inicio:</label><input type="datetime-local" name="inicio">
				<label>*Fecha fin:</label><input type="date" name="fin">
			</div><br>

				<input type="submit" >
				<input type="reset" name="restablecer" value="Restablecer">
			</form>
		</div>
		<?php
		if(empty($_POST['nombre'])|| empty($_POST['inicio']) || empty($_POST['fin']) || empty($_POST['inicioIns']) || empty($_POST['finIns']) ){
				echo '<br>Añadir los datos con asterisco.';
		}
		else{
			require_once('../controladores/controladorretos.php');
			$controladorRetos=new ControladorRetos();
			$filas= $controladorRetos->insertar($_POST);
			if($filas>0){
				echo'<br>Se han registrado '.$filas.' fila/s.';
			}				
		}
		?>
		
		<br/><button><a href="consultar_retos.php">CONSULTAR RETOS</a></button>
	</body>
</html>