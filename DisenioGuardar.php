<?php

require_once "_varios.php";

$pdo = obtenerPdoConexionBD();

$acabadoDisenio = $_REQUEST["acabado"];
$llantasDisenio = $_REQUEST["llantas"];
$asientosDisenio = $_REQUEST["asientos"];
$parrillaDisenio = $_REQUEST["parrilla"];
$precioDisenio = $_REQUEST["precio"];



$nueva_entrada = ($_SESSION["disenioId"] == -1);

if ($nueva_entrada) {

    $sql = "INSERT INTO disenio (acabado, llantas, asientos, parrilla, precio) VALUES (?, ?, ?, ?, ?)";
    $parametros = [$acabadoDisenio, $llantasDisenio, $asientosDisenio, $parrillaDisenio, $precioDisenio];

} else {

    $sql = "UPDATE disenio SET acabado=?, llantas=?, asientos=?, parrilla=?, precio=? WHERE idCoche=?";
    $parametros = [$acabadoDisenio, $llantasDisenio, $asientosDisenio, $parrillaDisenio, $precioDisenio, $_SESSION["disenioId"]];
}

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

    <?php if ($nueva_entrada) { ?>
        <h1>Inserción completada</h1>
        <p>Se han añadido correctamente los datos del diseño a la base de datos.</p>
    <?php } else { ?>
        <h1>Guardado completado</h1>
        <p>Se han guardado correctamente los datos del diseño.</p>
    <?php } ?>

    <?php
} else {
    ?>

    <h1>Error en la modificación.</h1>
    <p>No se han podido guardar los datos del diseño.</p>

    <?php
}
?>

<a href="DisenioListado.php">Volver al listado de diseños.</a>

</body>

</html>