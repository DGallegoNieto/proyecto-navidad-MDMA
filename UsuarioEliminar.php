<?php
    require_once "_varios.php";

    $conexion = obtenerPdoConexionBD();

    if(!haySesionIniciada()){ //Si no hay sesión iniciada redirige al inicio
            redireccionar("Inicio.php");
    }

    //Consulta SQL
    $sql = "DELETE FROM usuario WHERE idUsuario=?";
    $sentencia = $conexion->prepare($sql);
    $sqlConExito = $sentencia->execute([$_SESSION["idUsuario"]]);


    $unaFilaAfectada = ($sentencia->rowCount() == 1);
    $ningunaFilaAfectada = ($sentencia->rowCount() == 0);


    $correcto = ($sqlConExito && $unaFilaAfectada);


    $noExistia = ($sqlConExito && $ningunaFilaAfectada);
?>



<html>


<body>

<?php if ($correcto) {
	cerrarSesion();

		 ?>

    <h1>Eliminación completada</h1>
    <p>Se ha eliminado correctamente el usuario.</p>

<?php } else if ($noExistia) { ?>

    <h1>Eliminación imposible</h1>
    <p>No existe el usuario que se pretende eliminar.</p>

<?php } else { ?>

    <h1>Error en la eliminación</h1>
    <p>No se ha podido eliminar el usuario o no existía.</p>

<?php } ?>

<a href='Inicio.php'>Volver al inicio.</a>

</body>

</html>