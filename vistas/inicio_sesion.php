<?php
    if(isset($_POST['usuario'])){
        $usuario=$_POST['usuario'];
        require_once('controladores/controladorlogin.php');
        $controladorLogin=new ControladorLogin();
		$controladorLogin->login($usuario);	
    }
?>
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
        <br><h3>Inicio de sesión</h3><br>
        <form action="./" method="POST">
            <br><label for="usuario">Email: </label>
            <input id="usuario" type="text" name="usuario"><br>
            <br><input type="submit">
        </form>
    </body>
</html>