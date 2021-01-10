<?php

    require_once "_varios.php";

    if(!esAdmin()){ //Si por algun motivo el usuario que accede no es un admin, redirecciona al Inicio
        redireccionar("Inicio.php");
    }

    $conexion = obtenerPdoConexionBD();

    //Consulta SQL
    $sql = "DELETE FROM coche WHERE idCoche=?";
    $sentencia = $conexion->prepare($sql);
    $sqlConExito = $sentencia->execute([$_SESSION["cocheId"]]);


    $unaFilaAfectada = ($sentencia->rowCount() == 1);
    $ningunaFilaAfectada = ($sentencia->rowCount() == 0);


    $correcto = ($sqlConExito && $unaFilaAfectada);


    $noExistia = ($sqlConExito && $ningunaFilaAfectada);
?>



<html>


<body>

<?php if ($correcto) { ?>

    <h1>Eliminación completada</h1>
    <p>Se ha eliminado correctamente el coche de la base de datos.</p>

<?php } else if ($noExistia) { ?>

    <h1>Eliminación imposible</h1>
    <p>No existe el coche que se pretende eliminar.</p>

<?php } else { ?>

    <h1>Error en la eliminación</h1>
    <p>No se ha podido eliminar el coche o no existía.</p>

<?php } ?>

<a href='CocheListado.php'>Volver al listado de coches.</a>

</body>

</html>