<?php
require_once "_varios.php";

$pdo = obtenerPdoConexionBD();

$sql = "SELECT * FROM garantia ORDER BY idGarantia";
$select = $pdo->prepare($sql);
$select->execute([]);
$rs = $select->fetchAll();

?>

<html>

<head>
    <meta charset='UTF-8'>
</head>

<body>

<h1>Listado de Garantías</h1>

<table border='1'>

    <tr>
        <th>Años</th>
        <th>Kilometraje</th>
        <th>Precio</th>
    </tr>

    <?php foreach ($rs as $fila) { ?>
        <tr align="center">
            <td><a href='GarantiaFicha.php?garantiaId=<?=$fila["idGarantia"]?>'> <?= $fila["anios"] ?>       </a></td>
            <td><a href='GarantiaFicha.php?garantiaId=<?=$fila["idGarantia"]?>'> <?= $fila["kilometraje"] ?> </a></td>
            <td><a href='GarantiaFicha.php?garantiaId=<?=$fila["idGarantia"]?>'> <?= $fila["precio"] ?> €    </a></td>
            <td><input type="radio" name="garantia" value='<?$fila["idGarantia"]?>'</td>
        </tr>
    <?php } ?>

</table>
<br/><br/>
<a href="GarantiaFicha.php?garantiaId=-1">Nueva entrada</a>
<br/><br/>
<a href="Inicio.php">Volver al inicio</a>
<br/><br/>
<a href="FacturaListado.php">Siguiente</a>
<br/>

</body>

</html>
