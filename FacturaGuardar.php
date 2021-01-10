<?php

    require_once "_varios.php";

    if(!haySesionIniciada()){ //Si no hay sesión iniciada, redirige al inicio
            redireccionar("Inicio.php");
    }

    $pdo = obtenerPdoConexionBD();

    //Consulta SQL
    $sql = "INSERT INTO factura (idUsuario, idCoche, idMotor, idDisenio, idGarantia, idColor, fecha, precioFinal) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $parametros = [$_SESSION["idUsuario"], $_SESSION["facturaCoche"], $_SESSION["facturaMotor"], $_SESSION["facturaDisenio"], $_SESSION["facturaGarantia"], $_SESSION["facturaColor"], date("Y-m-d"), $_SESSION["precioFinal"]];
    $sentencia = $pdo->prepare($sql);
    $sql_con_exito = $sentencia->execute($parametros);


    $una_fila_afectada = ($sentencia->rowCount() == 1); //Si ha habido exito, deberá devolver una unica fila afectada

    $correcto = ($sql_con_exito && $una_fila_afectada);

?>



<html>

<head>
    <meta charset="UTF-8">
</head>



<body>

<?php
    if ($correcto) {
        restablecerSeleccion(); ?>

        <h1>Guardado completado</h1>
        <p>Se ha guardado completamente la factura.</p>


<?php } else {?>

    <h1>Error en la modificación.</h1>
    <p>No se ha podido guardar la factura.</p>

    <?php } ?>

<a href="Inicio.php">Volver al inicio.</a>

</body>

</html>
