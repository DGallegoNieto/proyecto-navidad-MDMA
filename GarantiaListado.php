<?php
require_once "varios.php";

$conexionBD = obtenerPdoConexionBD();

$sql = "SELECT idGarantia, anios, kilometraje, precio FROM gatantia";

$select = $conexionBD->prepare($sql);
$select->execute([]);
$rs = $select->fetchAll();

?>

<html>

<head>
    <meta charset='UTF-8'>
</head>

<body>

<h1>Listado de Garantías</h1>

<table border='1' bgcolor='#d3d3d3' bordercolor='black'>

    <tr bgcolor='#a9a9a9' align='center'>
        <th>Años</th>
        <th>Kilometraje</th>
        <th>Precio</th>
    </tr>

    <?php foreach ($rs as $fila) { ?>
        <tr align="center">
            <td><a href='GarantiaFicha.php?id=<?=$fila["id"]?>'> <?= $fila["anios"] ?> </a></td>
            <td><a href='GarantiaFicha.php?id=<?=$fila["id"]?>'> <?= $fila["kilometraje"] ?> </a></td>
            <td><a href='GarantiaFicha.php?id=<?=$fila["id"]?>'> <?= $fila["precio"] ?> </a></td>
        </tr>
    <?php } ?>

</table>

<br />
<br />

<a href='GarantiaListado.php'>Listado de Garantías</a>

</body>

</html>
