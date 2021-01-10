<?php

require_once "_varios.php";

if(!haySesionIniciada()){
        redireccionar("Inicio.php");
    }

$pdo = obtenerPdoConexionBD();

$nombreUsuario = $_REQUEST["nombre"];
$apellidoUsuario = $_REQUEST["apellido"];
$usuarioUsuario = $_REQUEST["usuario"];
$contrasenia = trim($_REQUEST["contrasenia"]);
$contraseniaC = trim($_REQUEST["contraseniaC"]);



	

if($contrasenia != $contraseniaC || $contrasenia==" " || $contraseniaC==""){
		redireccionar("UsuarioFicha.php?errorC");

}
$sql = "UPDATE usuario SET nombre=?, apellido=?, usuario=?, contrasenna=? WHERE idUsuario=?";
$parametros = [$nombreUsuario, $apellidoUsuario, $usuarioUsuario,$contrasenia, $_SESSION["idUsuario"]];


$sentencia = $pdo->prepare($sql);
$sql_con_exito = $sentencia->execute($parametros);


$una_fila_afectada = ($sentencia->rowCount() == 1);
$ninguna_fila_afectada = ($sentencia->rowCount() == 0);


$correcto = ($sql_con_exito && $una_fila_afectada);

$datos_no_modificados = ($sql_con_exito && $ninguna_fila_afectada);

?>



<html>

<head>
    <meta charset="UTF-8">
</head>


<body>

<?php

if ($correcto || $datos_no_modificados) {
$arrayUsuario= obtenerUsuario($usuarioUsuario,$contrasenia);
if(isset($_SESSION["admin"])){
	$admin=true;
}
else{
	$admin=false;
}
marcarSesionComoIniciada($arrayUsuario,$admin);
 ?>

        <h1>Guardado completado</h1>
        <p>Se han guardado correctamente los datos del usuario.</p>

    <?php } else { ?>

    <h1>Error en la modificación.</h1>
    <p>No se han podido guardar los datos del usuario.</p>

    <?php
}
?>

<a href="Inicio.php">Volver al inicio.</a>

</body>

</html>