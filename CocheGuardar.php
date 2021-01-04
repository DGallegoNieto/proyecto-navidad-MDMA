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

    $sql = "INSERT INTO persona (nombre, apellidos, telefono, categoriaId) VALUES (?, ?, ?, ?)";
    $parametros = [$nombre, $apellidos, $telefono, $categoriaId];

} else {

    $sql = "UPDATE persona SET nombre=?, apellidos=?, telefono=?, categoriaId=? WHERE id=?";
    $parametros = [$nombre, $apellidos, $telefono, $categoriaId, $id];
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
// Todo bien tanto si se han guardado los datos nuevos como si no se habían modificado.
if ($correcto || $datos_no_modificados) { ?>

    <?php if ($id == -1) { ?>
        <h1>Inserción completada</h1>
        <p>Se ha insertado correctamente la nueva entrada de <?php echo $nombre; ?>.</p>
    <?php } else { ?>
        <h1>Guardado completado</h1>
        <p>Se han guardado correctamente los datos de <?php echo $nombre; ?>.</p>

        <?php if ($datos_no_modificados) { ?>
            <p>En realidad, no había modificado nada, pero no está de más que se haya asegurado pulsando el botón de guardar :)</p>
        <?php } ?>
    <?php }
    ?>

    <?php
} else {
    ?>

    <h1>Error en la modificación.</h1>
    <p>No se han podido guardar los datos de el contacto.</p>

    <?php
}
?>

<a href="persona-listado.php">Volver al listado de personas.</a>

</body>

</html>