<?php
	require_once "_varios.php";

	$conexion = obtenerPdoConexionBD();
	$idMotor = (int)$_REQUEST["idMotor"];
	$nuevaEntrada = ($idMotor == -1);

	if ($nuevaEntrada) {
		
        $potenciaMotor = " ";
        $combustibleMotor = " ";
        $cilindradaMotor = " ";
        $consumoMotor = " ";
        $co2Motor = " ";
        $cajaCambioMotor = " ";
        $precioMotor = " ";
        
        
	} else {
		$sql = "SELECT potencia, combustible, cilindrada, consumo, co2, cajaCambio, precio FROM motor WHERE idMotor=?";

        $select = $conexion->prepare($sql);
        $select->execute([$idMotor]);
        $rs = $select->fetchAll();
        
        $potenciaMotor = $rs[0]["potencia"];
        $combustibleMotor = $rs[0]["combustible"];
        $cilindradaMotor = $rs[0]["cilindrada"];
        $consumoMotor = $rs[0]["consumo"];
        $co2Motor = $rs[0]["co2"];
        $cajaCambioMotor = $rs[0]["cajaCambio"];
        $precioMotor = $rs[0]["precio"];
        
        
	}



    $sql = "SELECT * FROM motor WHERE idMotor=? ORDER BY potencia";

    $select = $conexion->prepare($sql);
    $select->execute([$idMotor]);
    $rsMotores = $select->fetchAll();
?>



<html>

<head>
	<meta charset='UTF-8'>
</head>



<body>

<?php if ($nuevaEntrada) { ?>
	<h1>Ficha de nuevo Motor</h1>
<?php } else { ?>
	<h1>Ficha tecnica del motor</h1>
<?php } ?>

<form method='get' action='MotorGuardar.php'>

<input type='hidden' name='idMotor' value='<?=$idMotor?>' />

    <ul>
        <li>
            <strong>Potencia: </strong>
            <input type="text" name="potencia" value="<?=$potenciaMotor?>">
            <br /><br />
        </li>
        <li>
            <strong>Combustible: </strong>
            <input type="text" name="combustible" value="<?=$combustibleMotor?>"'>
            <br /><br />
        </li>
        <li>
            <strong>Cilindrada: </strong>
            <input type="text" name="cilindrada" value="<?=$cilindradaMotor?>">
            <br /><br />
        </li>
        <li>
            <strong>Consumo: </strong>
            <input type="text" name="consumo" value="<?=$consumoMotor?>">
            <br /><br />
        </li>
        <li>
            <strong>Co2: </strong>
            <input type="text" name="co2" value="<?=$co2Motor?>">
            <br /><br />
        </li>
        <li>
            <strong>Caja de cambios: </strong>
            <input type="text" name="cajaCambio" value="<?=$cajaCambioMotor?>">
            <br /><br />
        </li>
        <li>
            <strong>Precio: </strong>
            <input type="text" name="precio" value="<?=$precioMotor?>">
            <br /><br />
        </li>
    </ul>

<?php if ($nuevaEntrada) { ?>
	<input type='submit' name='crear' value='Crear nuevo motor' />
<?php } else { ?>
	<input type='submit' name='guardar' value='Guardar cambios' />
<?php } ?>

</form>
<button onclick="location.href='MotorListado.php'">Volver</button>
<br /><br />
<a href="MotorEliminar.php?id=<?=$_SESSION["motorId"]?>">Eliminar</a>
</body>

</html>