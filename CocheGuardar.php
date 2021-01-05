<?php

require_once "_varios.php";

$pdo = obtenerPdoConexionBD();

//$_SESSION["cocheId"]

$marcaCoche = $_REQUEST["marca"];
$modeloCoche = $_REQUEST["modelo"];
$tipoCoche = $_REQUEST["tipo"];
$precioCoche = $_REQUEST["precio"];



$nueva_entrada = ($_SESSION["cocheId"] == -1);

if ($nueva_entrada) {

    $sql = "INSERT INTO coche (marca, modelo, tipo, precio) VALUES (?, ?, ?, ?)";
    $parametros = [$marcaCoche, $modeloCoche, $tipoCoche, $precioCoche];

} else {

    $sql = "UPDATE coche SET marca=?, modelo=?, tipo=?, precio=? WHERE idCoche=?";
    $parametros = [$marcaCoche, $modeloCoche, $tipoCoche, $precioCoche, $_SESSION["cocheId"]];
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
        <p>Se han añadido correctamente los datos del coche a la base de datos.</p>
    <?php } else { ?>
        <h1>Guardado completado</h1>
        <p>Se han guardado correctamente los datos del coche.</p>
    <?php } ?>

    <?php
} else {
    ?>

    <h1>Error en la modificación.</h1>
    <p>No se han podido guardar los datos del coche.</p>

    <?php
}
?>

<a href="CocheListado.php">Volver al listado de coches.</a>

</body>

</html>