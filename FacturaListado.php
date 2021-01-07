<?php

require_once "_varios.php";

$conexionBD = obtenerPdoConexionBD();


$_SESSION["facturaGarantia"] = $_REQUEST["garantia"];


//SQL de Coche
$sqlCoche = "SELECT * FROM coche WHERE idCoche=?";
$selectCoche = $conexionBD->prepare($sqlCoche);
$selectCoche->execute([$_SESSION["facturaCoche"]]);
$rsCoche = $selectCoche->fetchAll();


//SQL de Diseño
$sqlDisenio = "SELECT * FROM disenio WHERE idDisenio=?";
$selectDisenio = $conexionBD->prepare($sqlDisenio);
$selectDisenio->execute([$_SESSION["facturaDisenio"]]);
$rsDisenio = $selectDisenio->fetchAll();


//SQL de Color
$sqlColor = "SELECT * FROM color WHERE idColor=?";
$selectColor = $conexionBD->prepare($sqlColor);
$selectColor->execute([$_SESSION["facturaColor"]]);
$rsColor = $selectColor->fetchAll();


//SQL de Motor
$sqlMotor = "SELECT * FROM motor WHERE idMotor=?";
$selectMotor = $conexionBD->prepare($sqlMotor);
$selectMotor->execute([$_SESSION["facturaMotor"]]);
$rsMotor = $selectMotor->fetchAll();


//SQL de Garantía
$sqlGarantia = "SELECT * FROM garantia WHERE idGarantia=?";
$selectGarantia = $conexionBD->prepare($sqlGarantia);
$selectGarantia->execute([$_SESSION["facturaGarantia"]]);
$rsGarantia = $selectGarantia->fetchAll();


$precioFinal = 0;

?>

<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
<h1>Factura</h1>

<h2>Coche:</h2>

<table border="1">

    <tr>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Tipo</th>
        <th>Precio</th>
    </tr>
    <?php
    foreach ($rsCoche as $fila) { ?>
        <tr>
            <td> <p> <?= $fila["marca"] ?> </p></td>
            <td> <p> <?= $fila["modelo"] ?> </p></td>
            <td> <p> <?= $fila["tipo"] ?> </p></td>
            <td> <p> <?= $fila["precio"] ?> €</p></p></td>
            <?php $precioFinal = $precioFinal + (int)$fila["precio"] ?>

        </tr>
    <?php } ?>

</table>

<h2>Diseño:</h2>
<table border="1">

    <tr>
        <th>Acabado</th>
        <th>Llantas</th>
        <th>Asientos</th>
        <th>Parrilla</th>
        <th>Precio</th>

    </tr>
    <?php
    foreach ($rsDisenio as $fila) { ?>
        <tr>
            <td> <p> <?= $fila["acabado"] ?> </p></td>
            <td> <p> <?= $fila["llantas"] ?> </p></td>
            <td> <p> <?= $fila["asientos"] ?> </p></td>
            <td> <p> <?= $fila["parrilla"] ?> </p></td>
            <td> <p> <?= $fila["precio"] ?> €</p></td>
            <?php $precioFinal = $precioFinal + (int)$fila["precio"] ?>

        </tr>
    <?php } ?>

</table>

<br />

<table border="1" >

    <tr>
        <th colspan="3">Color</th>
    </tr>
    <?php
    foreach ($rsColor as $filaColor) { ?>
        <tr>

            <td><p> <?= $filaColor["color"] ?> </p></td>
            <td style="background-color:<?=$filaColor["hexadecimal"]?>; width: 15px; height: 10px;"></td>
        </tr>
    <?php } ?>
</table>

<h2>Motor:</h2>

<table border='1'>

    <tr>
        <th>Potencia</th>
        <th>Combustible</th>
        <th>Cilindrada</th>
        <th>Consumo</th>
        <th>Emisiones</th>
        <th>Caja de cambios</th>
        <th>Precio</th>
    </tr>

    <?php foreach ($rsMotor as $fila) { ?>
        <tr>
            <td><p> <?=$fila["potencia"] ?></p></td>
            <td><p> <?=$fila["combustible"] ?></p></td>
            <td><p> <?=$fila["cilindrada"] ?></p></td>
            <td><p> <?=$fila["consumo"] ?>L /100km</p></td>
            <td><p> <?=$fila["co2"] ?>g co2</p></td>
            <td><p> <?=$fila["cajaCambio"] ?></p></td>
            <td><p> <?=$fila["precio"] ?>€</p></td>
            <?php $precioFinal = $precioFinal + (int)$fila["precio"] ?>
        </tr>
    <?php } ?>

</table>

<h2>Garantía:</h2>
<table border='1'>

    <tr>
        <th>Años</th>
        <th>Kilometraje</th>
        <th>Precio</th>
    </tr>

    <?php foreach ($rsGarantia as $fila) { ?>
        <tr align="center">
            <td><p> <?= $fila["anios"] ?>       </p></td>
            <td><p> <?= $fila["kilometraje"] ?> </p></td>
            <td><p> <?= $fila["precio"] ?> €    </p></td>
            <?php $precioFinal = $precioFinal + (int)$fila["precio"] ?>
        </tr>
    <?php } ?>

</table>

<h2>Precio final: <?=$precioFinal?> €</h2>

<?php $_SESSION["precioFinal"] = $precioFinal ?>
<br />

<a href="GarantiaListado.php">Volver</a>
<a href="FacturaGuardar.php">Guardar</a>

</body>
</html>
