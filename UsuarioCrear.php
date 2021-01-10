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
	<input type="password" name="contrasenia">
	<br>
	<label>Repite la contraseña</label>
	<input type="password" name="contraseniaC">
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


    if(isset($_GET["errorC"])) { //Si viene error de Contraseña
        echo "Las contraseñas no coinciden.";
    }

    if(isset($_GET["errorU"])) { //Si viene error de Usuario
        echo "El usuario que quieres usar ya esta siendo utilizado";
    }

    if (isset($_REQUEST["contrasenia"]) && isset($_REQUEST["usuario"]) && isset($_REQUEST["nombre"]) && isset($_REQUEST["apellido"])) {

        $contrasenia = trim($_REQUEST["contrasenia"]);
        $contraseniaC = trim($_REQUEST["contraseniaC"]);
        $usuario = trim($_REQUEST["usuario"]);
        $nombre = trim($_REQUEST["nombre"]);
        $apellido = trim($_REQUEST["apellido"]);


        if(comprobarUsuario($usuario)){
            redireccionar("UsuarioCrear.php?errorU");
        }

        if($contrasenia != $contraseniaC || $contrasenia==" " || $contraseniaC==""){
            redireccionar("UsuarioCrear.php?errorC");
        }

        //Método que crea el usuario
        crearUsuario($usuario,$contrasenia,$nombre,$apellido);

        redireccionar("SesionInicioMostrarFormulario.php");
    }

?>