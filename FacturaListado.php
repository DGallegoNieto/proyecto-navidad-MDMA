<?php

require_once "_varios.php";

$conexionBD = obtenerPdoConexionBD();

if(isset($_REQUEST["garantia"])){
    $_SESSION["facturaGarantia"] = $_REQUEST["garantia"];
    $_SESSION["garantiaMarcado"] = true;
}else{
    $_SESSION["garantiaMarcado"] = false;
}

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


//SQL de Color ---------?????
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

//SQL del Precio final
/*$sqlPrecio = "SELECT c.precio AS 'cochePrecio', d.precio AS 'disenioPrecio', m.precio AS 'motorPrecio', g.precio AS 'garantiaPrecio', (c.precio + d.precio + m.precio + g.precio) AS 'sumaTotal'
FROM coche c, disenio d, motor m, garantia g
WHERE c.idCoche = ? AND d.idDisenio = ? AND m.idMotor = ? AND g.idGarantia = ?";
$selectPrecio = $conexionBD->prepare($sqlPrecio);
$selectPrecio->execute([$_SESSION["facturaCoche"], $_SESSION["facturaDisenio"], $_SESSION["facturaMotor"], $_SESSION["facturaGarantia"]]);
$rsPrecio = $selectPrecio->fetchAll();
*/

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
            <td> <a href='CocheFicha.php?cocheId=<?=$fila["idCoche"]?>'> <?= $fila["marca"] ?> </a></td>
            <td> <a href='CocheFicha.php?cocheId=<?=$fila["idCoche"]?>'> <?= $fila["modelo"] ?> </a></td>
            <td> <a href='CocheFicha.php?cocheId=<?=$fila["idCoche"]?>'> <?= $fila["tipo"] ?> </a></td>
            <td> <a href='CocheFicha.php?cocheId=<?=$fila["idCoche"]?>'> <?= $fila["precio"] ?> €</a></td>
            <?php $precioFinal = $precioFinal + (int)$fila["precio"] ?>

        </tr>
    <?php } ?>

</table>

<div id="menu" style=" position:absolute; right:200px; padding:40px; border: 1px solid; background-color: darkgrey; border-radius:20px; ">
<a href="Inicio.php">Inicio</a><br>    
<a href="CocheListado.php">Coches</a><?php if($_SESSION["cocheMarcado"]){echo " <img src='imagenes/tick.png' width='15px' height='15px'>";} ?><br>
<a href="DisenioListado.php">Diseños</a><?php if($_SESSION["disenioMarcado"]){echo " <img src='imagenes/tick.png' width='15px' height='15px'>";} ?><br>
<a href="MotorListado.php">Motores</a><?php if($_SESSION["motorMarcado"]){echo " <img src='imagenes/tick.png' width='15px' height='15px'>";} ?><br>
<a href="GarantiaListado.php">Garantias</a><?php if($_SESSION["garantiaMarcado"]){echo " <img src='imagenes/tick.png' width='15px' height='15px'>";} ?><br>
<a href="FacturaListado.php">Factura</a><br>
</div>    
    
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
            <td> <a href='DisenioFicha.php?disenioId=<?=$fila["idDisenio"]?>'> <?= $fila["acabado"] ?> </a></td>
            <td> <a href='DisenioFicha.php?disenioId=<?=$fila["idDisenio"]?>'> <?= $fila["llantas"] ?> </a></td>
            <td> <a href='DisenioFicha.php?disenioId=<?=$fila["idDisenio"]?>'> <?= $fila["asientos"] ?> </a></td>
            <td> <a href='DisenioFicha.php?disenioId=<?=$fila["idDisenio"]?>'> <?= $fila["parrilla"] ?> </a></td>
            <td> <a href='DisenioFicha.php?disenioId=<?=$fila["idDisenio"]?>'> <?= $fila["precio"] ?> €</a></td>
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
            <td><a href='MotorFicha.php?idMotor=<?=$fila["idMotor"]?>'> <?=$fila["potencia"] ?></a></td>
            <td><a href='MotorFicha.php?idMotor=<?=$fila["idMotor"]?>'> <?=$fila["combustible"] ?></a></td>
            <td><a href='MotorFicha.php?idMotor=<?=$fila["idMotor"]?>'><?=$fila["cilindrada"] ?></a></td>
            <td><a href='MotorFicha.php?idMotor=<?=$fila["idMotor"]?>'>   <?=$fila["consumo"] ?>L /100km</a></td>
            <td><a href='MotorFicha.php?idMotor=<?=$fila["idMotor"]?>'><?=$fila["co2"] ?>g co2</a></td>
            <td><a href='MotorFicha.php?idMotor=<?=$fila["idMotor"]?>'><?=$fila["cajaCambio"] ?></a></td>
            <td><a href='MotorFicha.php?idMotor=<?=$fila["idMotor"]?>'> <?=$fila["precio"] ?>€</a></td>
            <td><input type="radio" name="motor" value='<?$fila["idMotor"]?>'> </td>
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
            <td><a href='GarantiaFicha.php?garantiaId=<?=$fila["idGarantia"]?>'> <?= $fila["anios"] ?>       </a></td>
            <td><a href='GarantiaFicha.php?garantiaId=<?=$fila["idGarantia"]?>'> <?= $fila["kilometraje"] ?> </a></td>
            <td><a href='GarantiaFicha.php?garantiaId=<?=$fila["idGarantia"]?>'> <?= $fila["precio"] ?> €    </a></td>
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
