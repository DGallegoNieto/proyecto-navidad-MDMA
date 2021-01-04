<?php
	require_once "_varios.php";

	$conexion = obtenerPdoConexionBD();
	$idMotor = (int)$_REQUEST["idMotor"];
	$nuevaEntrada = ($idMotor == -1);

	if ($nuevaEntrada) {
		$categoriaNombre = "<introduzca: potencia, combustible, cilindrada, consumo, co2, cajaCambio, precio>";
	} else {
		$sql = "SELECT potencia, combustible, cilindrada, consumo, co2, cajaCambio, precio FROM motor WHERE idMotor=?";

        $select = $conexion->prepare($sql);
        $select->execute([$idMotor]);
        $rs = $select->fetchAll();
        $motor = $rs[0];
        
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
	<h1>Motores</h1>
<?php } ?>

<form method='post' action='MotorGuardar.php'>

<input type='hidden' name='idMotor' value='<?=$idMotor?>' />

    <label for='potencia'>Potencia</label>
	<input type='text' name='potencia' value='<?=$motor["potencia"]?>' />                
    <br/>
    <label for='combustible'>Combustible</label>
	<input type='text' name='combustible' value='<?=$motor["combustible"]?>' />                
    <br/>
    <label for='cilindrada'>Cilindrada</label>
	<input type='text' name='cilindrada' value='<?=$motor["cilindrada"]?>' />                
    <br/>
    <label for='consumo'>Consumo</label>
	<input type='text' name='consumo' value='<?=$motor["consumo"]?>' />                
    <br/>
    <label for='co2'>Co2</label>
	<input type='text' name='co2' value='<?=$motor["co2"]?>' />                
    <br/>
    <label for='cajaCambio'>Caja de Cambios</label>
	<input type='text' name='cajaCambio' value='<?=$motor["cajaCambio"]?>' />                
    <br/>
    <label for='precio'>Precio</label>
	<input type='text' name='precio' value='<?=$motor["precio"]?>' />                
    <br/>
    
    <br/>

<?php if ($nuevaEntrada) { ?>
	<input type='submit' name='crear' value='Crear nuevo motor' />
<?php } else { ?>
	<input type='submit' name='guardar' value='Guardar cambios' />
<?php } ?>

</form>

<br />
<?php if ($idMotor != -1) { ?>
<p>Motores</p>

<ul>
<?php
    foreach ($rsMotores as $fila) {
        echo "<li>$fila[idMotor] $fila[potencia] $fila[combustible] $fila[cilindrada] $fila[consumo] $fila[co2] $fila[cajaCambio] $fila[precio]</li>";
    }
?>
</ul>

<?php } ?>

<?php if (!$nuevaEntrada) { ?>
    <br />
    <a href='MotorEliminar.php?id=<?=$id?>'>Eliminar Motor</a>
<?php } ?>

<br />
<br />

<a href='MotorListado.php'>Volver a la lista de motores.</a>

</body>

</html>