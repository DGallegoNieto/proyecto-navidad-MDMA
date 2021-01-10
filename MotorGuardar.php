<?php

	require_once "_varios.php";

	if(!esAdmin()){ //Si por algun motivo el usuario que accede no es un admin, redirecciona al Inicio
	    redireccionar("Inicio.php");
	}
	
	$conexionBD = obtenerPdoConexionBD();

	
	$potencia = $_REQUEST["potencia"];
    $combustible = $_REQUEST["combustible"];
    $cilindrada = $_REQUEST["cilindrada"];
    $consumo = $_REQUEST["consumo"];
    $co2 = $_REQUEST["co2"];
    $cajaCambio = $_REQUEST["cajaCambio"];
    $precio = $_REQUEST["precio"];

	$nuevaEntrada = ($_SESSION["motorId"] == -1);
	
	if ($nuevaEntrada) {
 		$sql = "INSERT INTO motor (potencia, combustible, cilindrada, consumo, co2, cajaCambio, precio) VALUES (?, ?, ?, ?, ?, ?, ?)";
 		$parametros = [$potencia, $combustible, $cilindrada, $consumo, $co2, $cajaCambio, $precio];
	} else {
 		$sql = "UPDATE motor SET potencia=?, combustible =?, cilindrada =?, consumo =?, co2=?, cajaCambio=?,precio=? WHERE idMotor=?";
        $parametros = [$potencia, $combustible, $cilindrada, $consumo, $co2, $cajaCambio, $precio, $_SESSION["motorId"]];
 	}
 	
    $sentencia = $conexionBD->prepare($sql);
    $sqlConExito = $sentencia->execute($parametros);

 	$correcto = ($sqlConExito && $sentencia->rowCount() == 1);
 	$datosNoModificados = ($sqlConExito && $sentencia->rowCount() == 0);

?>



<html>

<head>
	<meta charset='UTF-8'>
</head>



<body>

<?php
    
	if ($correcto || $datosNoModificados) { ?>
		<?php if ($nuevaEntrada) { ?>
			<h1>Inserción completada</h1>
		<?php } else { ?>
			<h1>Guardado completado</h1>

			<?php if ($datosNoModificados) { ?>
				<p>En realidad, no había modificado nada, pero no está de más que se haya asegurado pulsando el botón de guardar :)</p>
			<?php } ?>
		<?php }
?>

<?php
	} else {
?>

    <?php if ($nuevaEntrada) { ?>
        <h1>Error en la creación.</h1>
        <p>No se ha podido crear el nuevo Motor.</p>
    <?php } else { ?>
        <h1>Error en la modificación.</h1>
        <p>No se han podido guardar los datos del nuevo Motor.</p>
    <?php } ?>

<?php
	}
?>

<a href='MotorListado.php'>Volver al listado de Motores.</a>

</body>

</html>