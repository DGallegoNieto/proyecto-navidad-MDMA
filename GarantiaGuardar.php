<?php

    require_once "_varios.php";

    if(!esAdmin()){ //Si por algun motivo el usuario que accede no es un admin, redirecciona al Inicio
        redireccionar("Inicio.php");
    }

    $pdo = obtenerPdoConexionBD();

    $aniosGarantia = $_REQUEST["anios"];
    $kilometrajeGarantia = $_REQUEST["kilometraje"];
    $precioGarantia = $_REQUEST["precio"];



    $nueva_entrada = ($_SESSION["garantiaId"] == -1);

    if ($nueva_entrada) {

        $sql = "INSERT INTO garantia (anios, kilometraje, precio) VALUES (?, ?, ?)";
        $parametros = [$aniosGarantia, $kilometrajeGarantia, $precioGarantia];

    } else {

        $sql = "UPDATE garantia SET anios=?, kilometraje=?, precio=? WHERE idGarantia=?";
        $parametros = [$aniosGarantia, $kilometrajeGarantia, $precioGarantia, $_SESSION["garantiaId"]];
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
        <p>Se han añadido correctamente los datos de la garantía a la base de datos.</p>
    <?php } else { ?>
        <h1>Guardado completado</h1>
        <p>Se han guardado correctamente los datos de la garantía.</p>
    <?php } ?>

    <?php
} else {
    ?>

    <h1>Error en la modificación.</h1>
    <p>No se han podido guardar los datos de la garantía.</p>

    <?php
}
?>

<a href="GarantiaListado.php">Volver al listado de las garantías.</a>

</body>

</html>