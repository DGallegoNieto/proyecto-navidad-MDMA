<?php
require_once"_Varios.php";
?>

<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>
<h1>Creación de nuevo usuario</h1>

<form action="UsuarioCrear.php" method="post">
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
	
//*TODO poner un minimo de longitud en todos los campos*
if (isset($_REQUEST["contrasenia"])&& isset($_REQUEST["usuario"])&& isset($_REQUEST["nombre"]) && isset($_REQUEST["apellido"])) {

	$contrasenia = trim($_REQUEST["contrasenia"]);
	$contraseniaC = trim($_REQUEST["contraseniaC"]);
	$usuario = trim($_REQUEST["usuario"]);
	$nombre = trim($_REQUEST["nombre"]);
	$apellido = trim($_REQUEST["apellido"]);

	

	if($contrasenia != $contraseniaC || $contrasenia==" " || $contraseniaC==""){
		echo "Las contraseñas no coinciden";
}
	elseif(comprobarUsuario($usuario)){
		echo " El usuario que quieres usar ya esta siendo utilizado";


}
	else 
	//metodo que crea el usuario
	echo "che pelotudo funcionó";
	crearUsuario($usuario,$contrasenia,$nombre,$apellido);

	redireccionar("SesionInicioMostrarFormulario.php");
}







?>