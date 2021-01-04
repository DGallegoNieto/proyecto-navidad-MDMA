<?php
	require_once "_varios.php";

	$conexionBD = obtenerPdoConexionBD();
	$id = (int)$_REQUEST["idMotor"];
    $sql = "DELETE FROM motor WHERE idMotor=?";

    $sentencia = $conexionBD->prepare($sql);
    $sqlConExito = $sentencia->execute([$id]);

    $correctoNormal = ($sqlConExito && $sentencia->rowCount() == 1);

 	$noExistia = ($sqlConExito && $sentencia->rowCount() == 0);

?>



<html>

<head>
	<meta charset='UTF-8'>
</head>



<body>

<?php if ($correctoNormal) { ?>

	<h1>Eliminación completada</h1>
	<p>Se ha eliminado correctamente el tipo.</p>

<?php } else if ($noExistia) { ?>

	<h1>Eliminación no realizada</h1>
	<p>No existe el tipo que se pretende eliminar.</p>

<?php } else { ?>

	<h1>Error en la eliminación</h1>
	<p>No se ha podido eliminar el tipo.</p>

<?php } ?>

<a href='MotorListado.php'>Volver al listado de Motor.</a>

</body>

</html>