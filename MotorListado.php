<?php
//Listado
//Seleccionar solo 1
//Admins puedan editar (añadir/eliminar) motores

	require_once "_varios.php";

	$conexionBD = obtenerPdoConexionBD();
	$sql = "SELECT idMotor, potencia, combustible, cilindrada, consumo, co2, cajaCambio, precio FROM motor ORDER BY potencia";

    $select = $conexionBD->prepare($sql);
    $select->execute([]);
    $rs = $select->fetchAll();

    $_SESSION["facturaDisenio"] = $_REQUEST["disenio"];
    $_SESSION["facturaColor"] = $_REQUEST["color"];

?>



<html>

<head>
	<meta charset='UTF-8'>
</head>



<body>

<h1>Motores</h1>

<form method="get" action="GarantiaListado.php">
<table border='1'>

	<tr>
		<th>Tipos</th>
	</tr>

	<?php foreach ($rs as $fila) { ?>
        <tr>
            <td><a href='MotorFicha.php?idMotor=<?=$fila["idMotor"]?>'> <?=$fila["potencia"] ?> <?=$fila["combustible"] ?> <?=$fila["cilindrada"] ?> <?=$fila["consumo"] ?> <?=$fila["co2"] ?><?=$fila["cajaCambio"] ?> <?=$fila["precio"] ?></a></td>
            <td><input type="radio" name="motor" value='<?$fila["idMotor"]?>' </td>
        </tr>
	<?php } ?>

</table>


<br />

<a href='MotorGuardar.php?id=-1'>Crear nuevo Motor</a>

<br />
<br />
<input type="submit" value="Siguiente">
<br />
<a href='DisenioListado.php'>Volver</a>
</form>

</body>

</html>


