<?php
require_once "_varios.php";

$conexion = obtenerPdoConexionBD();

$id = (int)$_REQUEST["id"];

$nuevaEntrada = ($id == -1);

if ($nuevaEntrada) {
    $GarantiaAnios = "Años de garantía";
    $GarantiaKilometraje = "Kilometraje máximo";
    $GarantiaPrecio = "Precio a pagar";
} else {
    $sql = "SELECT * FROM garantia WHERE id=?";

    $select = $conexion->prepare($sql);
    $select->execute([$id]);
    $rsGarantia = $select->fetchAll();

    $GarantiaAnios = $rsGarantia[0]["garantia"];
    $GarantiaKilometraje = $rsGarantia[0]["kilometraje"];
    $GarantiaPrecio = $rsGarantia[0]["precio"];
    $GarantiaId = $rsGarantia[0]["id"];
}

?>

<html>

<head>
    <meta charset='UTF-8'>
</head>

<body>

<?php if ($nuevaEntrada) { ?>
    <h1>Nueva garantía</h1>
<?php } else { ?>
    <h1>Ficha de garantía</h1>
<?php } ?>

<form method='post' action='GarantiaFicha.php'>

    <input type='hidden' name='id' value='<?=$id?>' />

    <label for='nombre'>Años: </label>
    <input type='text' name='años' value='<?=$GarantiaAnios?>' />
    <br/>
    <br/>
    <label for='localidad'>Kilometraje: </label>
    <input type='text' name='kilometraje' value='<?=$GarantiaKilometraje?>' />
    <br/>
    <br/>

    <label for='anioCreacion'>Precio: </label>
    <input type='text' name='precio' value='<?=$GarantiaPrecio?>' />
    <br/>
    <br/>

    <?php if ($nuevaEntrada) { ?>
        <input type='submit' name='crear' value='Crear nueva garantía' />
    <?php } else { ?>
        <input type='submit' name='guardar' value='Guardar cambios' />
    <?php } ?>

</form>

<br />
<a href='equipoListado.php'>Volver al listado de equipos.</a>
<br />
<br />

<a href='jugadoresEquipoListado.php?id=<?=$id?>'>Ver jugadores del equipo.</a>

</body>

</html>