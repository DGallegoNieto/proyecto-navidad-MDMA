<?php
require_once"_Varios.php";
?>

<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>
<h1>Creación de nuevo usuario</h1>

<form action="CrearUsuario.php" method="post">
	<label>Nombre de usuario</label>
	<input type="text" name="usuario">
	<br>
	<label>Contraseña</label>
	<input type="text" name="contrasenia">
	<br>
	<label>Repite la contraseña</label>
	<input type="text" name="contraseniaC">
	<br>
	<label>Nombre</label>
	<input type="text" name="nombre">
	<br>
	<label>Apellido</label>
	<input type="text" name="apellido">
	<br>
	<input type="submit" value="Crear Cuenta">
</form>
</body>

</html>

<?php
	

if (isset($_REQUEST["contrasenia"])&& isset($_REQUEST["usuario"])) {

	$contrasenia = $_REQUEST["contrasenia"];
	$contraseniaC = $_REQUEST["contraseniaC"];
	$usuario = $_REQUEST["usuario"];
	$nombre = $_REQUEST["nombre"];
	$apellido = $_REQUEST["apellido"];

	//echo "hola".$contrasenia;

	if($contrasenia != $contraseniaC || $contrasenia==" " || $contraseniaC==""){
		echo "Las contraseñas no coinciden";
}
	elseif(comprobarUsuario($usuario)){
		echo " El usuario que quieres usar ya esta siendo utilizado";


}
	else 
	//metodo que crea el usuario
	
	crearUsuario($usuario,$contrasenia,$nombre,$apellido);

	redireccionar("SesionInicioMostrarFormulario.php");
}







?>