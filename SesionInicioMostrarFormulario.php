



<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>

<h1>Iniciar Sesión</h1>


<form action="SesionInicioComprobar.php" method="post">
	<label>Usuario</label>
	<input type="text" name="usuario">
	<label>Contraseña</label>
	<input type="text" name="contrasenna">
	<input type="submit" value="enviar">
</form>
<br>
<?php

if(isset($_REQUEST['error'])){

	$mensaje = "Usuario y contraseña no validos";
	
	echo $mensaje;
	echo "<br>";
}

?>

<a href="CrearUsuario.php">¿No tiene usuario?, cree uno aquí.</a>

</body>

</html>