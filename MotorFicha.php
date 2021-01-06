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

    <label for='potencia'>Potencia</label>
	<input type='text' name='potencia' value='<?=$potenciaMotor?>' />                
    <br/>
    <label for='combustible'>Combustible</label>
	<input type='text' name='combustible' value='<?=$combustibleMotor?>' />                
    <br/>
    <label for='cilindrada'>Cilindrada</label>
	<input type='text' name='cilindrada' value='<?=$cilindradaMotor?>' />                
    <br/>
    <label for='consumo'>Consumo</label>
	<input type='text' name='consumo' value='<?=$consumoMotor?>' />                
    <br/>
    <label for='co2'>Co2</label>
	<input type='text' name='co2' value='<?=$co2Motor?>' />                
    <br/>
    <label for='cajaCambio'>Caja de Cambios</label>
	<input type='text' name='cajaCambio' value='<?=$cajaCambioMotor?>' />                
    <br/>
    <label for='precio'>Precio</label>
	<input type='text' name='precio' value='<?=$precioMotor?>' />                
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
<p>Datos del motor</p>

<ul>
<?php
    foreach ($rsMotores as $fila) {
        echo "Id: $fila[idMotor]</br> Potencia: $fila[potencia]</br> Combustible: $fila[combustible]</br> Cilindrada: $fila[cilindrada]</br> Consumo: $fila[consumo]</br> Emision Co2: $fila[co2]</br> Caja de cambios: $fila[cajaCambio]</br> Precio: $fila[precio]";
        
    }
?>
</ul>

<?php } ?>

<?php if (!$nuevaEntrada) { ?>
    <br />
    <a href='MotorEliminar.php?idMotor=<?=$idMotor?>'>Eliminar Motor</a>
<?php } ?>

<br />
<br />

<a href='MotorListado.php'>Volver a la lista de motores.</a>

</body>

</html>