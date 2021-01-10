<?php
require_once "_varios.php";

if(!esAdmin()){
	redireccionar("Inicio.php");
}

$conexion = obtenerPdoConexionBD();

$sql = "DELETE FROM garantia WHERE idGarantia=?";

$sentencia = $conexion->prepare($sql);

$sqlConExito = $sentencia->execute([$_SESSION["garantiaId"]]);

$unaFilaAfectada = ($sentencia->rowCount() == 1);
$ningunaFilaAfectada = ($sentencia->rowCount() == 0);

$correcto = ($sqlConExito && $unaFilaAfectada);

$noExistia = ($sqlConExito && $ningunaFilaAfectada);
?>

<html>

<body>

<?php if ($correcto) { ?>

    <h1>Eliminación completada</h1>
    <p>Se ha eliminado correctamente la garantía de la base de datos.</p>

<?php } else if ($noExistia) { ?>

    <h1>Eliminación imposible</h1>
    <p>No existe la garantía que se pretende eliminar.</p>

<?php } else { ?>

    <h1>Error en la eliminación</h1>
    <p>No se ha podido eliminar la garantía o no existía.</p>

<?php } ?>

<a href='GarantiaListado.php'>Volver al listado de garantías.</a>

</body>

</html>