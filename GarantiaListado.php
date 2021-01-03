<?php
require_once "_varios.php";

$conexionBD = obtenerPdoConexionBD();

$sql = "SELECT idGarantia, anios, kilometraje, precio FROM garantia";

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
            <td><a href='GarantiaFicha.php?id=<?=$fila["idGarantia"]?>'> <?= $fila["anios"] ?> </a></td>
            <td><a href='GarantiaFicha.php?id=<?=$fila["idGarantia"]?>'> <?= $fila["kilometraje"] ?> </a></td>
            <td><a href='GarantiaFicha.php?id=<?=$fila["idGarantia"]?>'> <?= $fila["precio"] ?> </a></td>
            <td><input type="radio" name="garantia" value='<?$fila["idGarantia"]?>'</td>
        </tr>
    <?php } ?>

</table>

<br />
<br />

<a href='GarantiaListado.php'>Listado de Garantías</a>

</body>

</html>
