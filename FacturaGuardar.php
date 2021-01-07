<?php

require_once "_varios.php";

$pdo = obtenerPdoConexionBD();




$sql = "INSERT INTO factura (idUsuario, idCoche, idMotor, idDisenio, idGarantia, idColor, fecha, precioFinal) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$parametros = [$_SESSION["idUsuario"], $_SESSION["facturaCoche"], $_SESSION["facturaMotor"], $_SESSION["facturaDisenio"], $_SESSION["facturaGarantia"], $_SESSION["facturaColor"], date("Y-m-d"), $_SESSION["precioFinal"]];



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

if ($correcto || $datos_no_modificados) { ?>

    <h1>Guardado completado</h1>
    <p>Se ha guardado completamente la factura.</p>

<?php } else {?>

    <h1>Error en la modificación.</h1>
    <p>No se ha podido guardar la factura.</p>

    <?php } ?>

<a href="Inicio.php">Volver al inicio.</a>

</body>

</html>
