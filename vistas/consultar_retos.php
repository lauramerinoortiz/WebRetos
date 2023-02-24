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
  	<nav>
      <ul>
		<a href="../index.html"><li>Home</li></a>
        <li id="sub"><a href="consultar_retos.php">Retos</a>
          <ul>
            <a href="insertar_reto.php"><li class="primer">Nuevo Reto</li></a>
            <a href="consultar_retos.php"><li>Listado</li></a>
          </ul>
        </li>
        <li id="sub2"><a href="consultar_categoria.php">Categorías</a>
          <ul>
            <a href="insertar_categoria.php"><li class="primer">Nueva Categoría</li></a>
            <a href="consultar_categoria.php"><li>Listado</li></a>
          </ul></li>
        <a href=""><li>Inscribir</li></a>
      </ul>
    </nav>
		<?php
		if(isset($_GET['idReto'])){
			$id=$_GET['idReto'];
			require_once('../controladores/controladorretos.php');
            $controladorRetos=new ControladorRetos();
            $datos=$controladorRetos->consultar();
			while($linea = $datos ->fetch_assoc()){
				if($linea['idreto']==$id){
					$nombre=$linea['nombre'];
				}
			}
			require_once('eliminarReto.php');
		}
		else{
			require_once('../controladores/controladorretos.php');
            $controladorRetos=new ControladorRetos();
			if(isset($_GET['filtro']) && $_GET['filtro']!='todos'){
				$datos=$controladorRetos->consultarFiltro($_GET['filtro']);
			}
			else{
				$datos=$controladorRetos->consultar();
			}
            
			?>
			<h1>Retos</h1>
			<br><label>Filtrar:</label><br>
			<form action="consultar_retos.php" method="GET">
				<select name="filtro">
					<option value="todos">Todos</option>
					<?php 
						require_once('../controladores/controladorcategorias.php');
						$controladorCat=new ControladorCategorias();
						$cat=$controladorCat->consultar();
						while($cate = $cat ->fetch_assoc()){
							if(isset($_GET['filtro']) && $_GET['filtro']==$cate['idcategoria']){
								echo '<option value='.$cate['idcategoria'].' selected>'.$cate['nombre'].'</option>';
							}else{
								echo '<option value='.$cate['idcategoria'].'>'.$cate['nombre'].'</option>';
							}
						}
					?>
				</select>
				<input type="submit" value="Buscar">
			</form>
			<table id="retos">
				<tr>
					<th colspan="1">Nombre</th>
					<th colspan="1">Descripción</th>
					<th colspan="1">Publicado</th>
					<th colspan="1">Categoría</th>
					<th colspan="1">Opciones</th>
				</tr>
			
			<?php
			require_once('../controladores/controladorcategorias.php');
            $controladorCat=new ControladorCategorias();
			if($datos->num_rows>0){
				while($linea = $datos ->fetch_assoc()){
					if($linea['publicado']==1){
						$publicado='Si';
					}else{
						$publicado='No';
					}

					$cat=$controladorCat->consultarId($linea['idcategoria']);
					echo '<tr>
					<td colspan="1"><a href="datos_reto.php?id='.$linea['idreto'].'">'.$linea['nombre'].'</a></td>
					<td colspan="1">'.$linea['descripcion'].'</td>
					<td colspan="1">'.$publicado.'</td>';
					$cate = $cat ->fetch_assoc();
					if($cate==NULL){
						echo '<td colspan="1">Vacio</td>';
					}
					else{
						echo '<td colspan="1">'.$cate['nombre'].'</td>';
					}					
					
					echo '<td><a href="modificarReto.php?idReto='.$linea['idreto'].'">✎</a>
					<a href="consultar_retos.php?idReto='.$linea['idreto'].'">🗑</a></td></tr>';
				}
			}
			else{
				echo '<tr><td colspan="10">No hay retos.</td></tr>';
			}
			echo '</table><br/><button><a href="insertar_reto.php">INSERTAR NUEVO RETO</a></button>';
		}
		?>
  </body>
</html>