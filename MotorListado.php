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

    $_SESSION["facturaDisenio"] = isset($_REQUEST["disenio"]);
    $_SESSION["facturaColor"] = isset($_REQUEST["color"]);

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
		<th>Potencia</th>
        <th>Combustible</th>
        <th>Cilindrada</th>
        <th>Consumo</th>
        <th>Emisiones</th>
        <th>Caja de cambios</th>
        <th>Precio</th>
	</tr>

	<?php foreach ($rs as $fila) { ?>
        <tr>
            <td><a href='MotorFicha.php?idMotor=<?=$fila["idMotor"]?>'> <?=$fila["potencia"] ?></a></td>
            <td><a href='MotorFicha.php?idMotor=<?=$fila["idMotor"]?>'> <?=$fila["combustible"] ?></a></td>
            <td><a href='MotorFicha.php?idMotor=<?=$fila["idMotor"]?>'><?=$fila["cilindrada"] ?></a></td>
            <td><a href='MotorFicha.php?idMotor=<?=$fila["idMotor"]?>'>   <?=$fila["consumo"] ?>L /100km</a></td>
            <td><a href='MotorFicha.php?idMotor=<?=$fila["idMotor"]?>'><?=$fila["co2"] ?>g co2</a></td>
            <td><a href='MotorFicha.php?idMotor=<?=$fila["idMotor"]?>'><?=$fila["cajaCambio"] ?></a></td>
            <td><a href='MotorFicha.php?idMotor=<?=$fila["idMotor"]?>'> <?=$fila["precio"] ?>€</a></td>
            <td><input type="radio" name="motor" value='<?$fila["idMotor"]?>'> </td>
        </tr>
	<?php } ?>

</table>


<br />
    <?php
    if(isset($_SESSION["admin"])){
        ?>

        <a href='MotorFicha.php?idMotor=-1'>Crear nuevo Motor</a>
    <?php } ?>


<br />

<input type="submit" value="Siguiente">
<br />
</form>
<button onclick="location.href='DisenioListado.php'">Volver</button>
</body>

</html>


