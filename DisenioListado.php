<?php
require_once "_varios.php";

$pdo = obtenerPdoConexionBD();

$sql = "SELECT * FROM disenio ORDER BY idDisenio";
$select = $pdo->prepare($sql);
$select->execute([]);
$rs = $select->fetchAll();

$sqlColor = "SELECT * FROM color ORDER BY idColor";
$selectColor = $pdo->prepare($sqlColor);
$selectColor->execute([]);
$rsColor = $selectColor->fetchAll();

?>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
<h1>Listado de diseños</h1>

<table border="1">

    <tr>
        <th>Acabado</th>
        <th>Llantas</th>
        <th>Asientos</th>
        <th>Parrilla</th>
        <th>Precio</th>

    </tr>
    <?php
    foreach ($rs as $fila) { ?>
        <tr>
            <td> <a href='DisenioFicha.php?id=<?=$fila["idDisenio"]?>'> <?= $fila["acabado"] ?> </a></td>
            <td> <a href='DisenioFicha.php?id=<?=$fila["idDisenio"]?>'> <?= $fila["llantas"] ?> </a></td>
            <td> <a href='DisenioFicha.php?id=<?=$fila["idDisenio"]?>'> <?= $fila["asientos"] ?> </a></td>
            <td> <a href='DisenioFicha.php?id=<?=$fila["idDisenio"]?>'> <?= $fila["parrilla"] ?> </a></td>
            <td> <a href='DisenioFicha.php?id=<?=$fila["idDisenio"]?>'> <?= $fila["precio"] ?> €</a></td>
            <td><input type="radio" name="disenio" value='<?$fila["idDisenio"]?>' </td>
        </tr>
    <?php } ?>

</table>

<h2>Colores disponibles</h2>
<table border="1" >

    <tr>
        <th colspan="3">Color</th>
    </tr>
    <?php
    foreach ($rsColor as $filaColor) { ?>
        <tr>

            <td><p> <?= $filaColor["color"] ?> </p></td>
            <td style="background-color:<?=$filaColor["hexadecimal"]?>; width: 15px; height: 10px;"></td>
            <td><input type="radio" name="color" value='<?$filaColor["idColor"]?>' </td>
        </tr>
    <?php } ?>

</table>


<br/>
<a href="CocheListado.php">Atrás</a>
<br/>
<a href="MotorListado.php">Siguiente</a>

</body>

</html>