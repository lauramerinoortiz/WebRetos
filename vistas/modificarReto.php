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
		<?php
			if(empty($_POST['nombre'])|| empty($_POST['inicio']) || empty($_POST['fin']) || empty($_POST['inicioIns']) || empty($_POST['finIns']) ){
				echo '<br>Añadir los datos con asterisco.';
			}
			else{
				require_once('../controladores/controladorretos.php');
				$controladorRetos=new ControladorRetos();
				$filas= $controladorRetos->modificar($_POST);
							
			}
		?>
		<div id="formReto">
			<form action="modificarReto.php" method="post">
			<?php 
				$id=$_GET['idReto'];
				require_once('../controladores/controladorretos.php');
				$controlador=new ControladorRetos();
				$datos=$controlador-> consultarId($id);
				while($linea = $datos ->fetch_assoc()){
					print_r($linea);
					$nombre=$linea['nombre'];
					$desc=$linea['descripcion'];
					$inicio=$linea['fecha_inicio_reto'];
					$fin=$linea['fecha_fin_reto'];
					$inicioIns=$linea['fecha_inicio_inscripcion'];
					$finIns=$linea['fecha_fin_inscripcion'];
					$publicada=$linea['publicada'];
					$categoria=$linea['idcategoria'];
					$dirigido=$linea['dirigido'];
				}
			?>
			<h1>Modificar reto</h1>
			<input class="oculto" name="id" value="<?php echo $id; ?>">
			<label for="nombre" id="labelNombre">*Nombre del reto:</label><input type="text" id="nombre" name="nombre" value="<?php echo $nombre;?>"><br>
			<label for="descripcion" id="labelDesc">Descripción del reto:</label><textarea id="descripcion" name="descripcion"><?php echo $desc;?></textarea><br>
			<label for="publiopciones" id="labelOpciones">*¿Publicar ya?</label>
			<div id="publiopciones">
				<?php
					if($publicada==0){
						echo '<label for="publicadaSi"><input type="radio" name="opciones" value=1  id="publicadaSi">Si</label>
						<label for="publicadaNo" id="labelPublicadaNo"><input type="radio" value=0 name="opciones" id="publicadaNo" checked>No</label>
					';
					}
					else{
						echo '<label for="publicadaSi"><input type="radio" name="opciones" value=1  id="publicadaSi" checked>Si</label>
						<label for="publicadaNo" id="labelPublicadaNo"><input type="radio" value=0 name="opciones" id="publicadaNo">No</label>
					';
					}
				?>
			</div><br>
			<label for="dirigido" id="labelDirigido">*Dirigido a:</label>
			<select id="dirigido" name="dirigido">
				<?php 
				$clases=['Infantil','ESO', 'Bachillerato', 'GM', 'GS'];
				foreach($clases as $clase){
					if($clase==$dirigido){
						echo '<option selected value="'.$clase.'">'.$clase.'</option>';
					}
					else{
						echo '<option value="'.$clase.'">'.$clase.'</option>';
					}
				}
				?>
			
			</select>

			<label for="categoria" id="labelCategoria">*Categoría:</label>
			<select id="categoria" name="cat">
				<?php 
					require_once('../controladores/controladorcategorias.php');
					$controlador=new ControladorCategorias();
					$datos=$controlador-> consultar();
					if($datos->num_rows>0){
						while($linea = $datos ->fetch_assoc()){
							if($categoria==$linea['idcategoria']){
								echo '<option selected value="'.$linea['idcategoria'].'">'.$linea['nombre'].'</option>';
							}
							else{
								echo '<option value="'.$linea['idcategoria'].'">'.$linea['nombre'].'</option>';
							}
						}
					}
					else{
						echo '<option>No hay categorias</option>';
					}
				?>

			</select><br>

			<div id="inscripcion">
				<h3>Fecha inscripción</h3>
				<label>*Fecha inicio:</label><input type="date" name="inicioIns" value="<?php echo $inicioIns?>">
				<label>*Fecha fin:</label><input type="date" name="finIns" value="<?php echo $finIns?>">
			</div><br>

			<div id="realizacion">
				<h3>Fecha realización</h3>
				<label>*Fecha inicio:</label><input type="datetime-local" name="inicio" value="<?php echo $inicio?>">
				<label>*Fecha fin:</label><input type="date" name="fin" value="<?php echo $fin?>">
			</div><br>
				<input type="submit" >
				<input type="reset" name="restablecer" value="Restablecer">
			</form>
		</div>		
		<br/><button><a href="consultar_retos.php">CONSULTAR RETOS</a></button>
	</body>
</html>