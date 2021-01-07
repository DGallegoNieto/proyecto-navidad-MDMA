<?php
require_once "_varios.php";

$pdo = obtenerPdoConexionBD();

$sql = "SELECT * FROM factura WHERE idUsuario=? ORDER BY fecha";
$select = $pdo->prepare($sql);
$select->execute([$_SESSION["idUsuario"]]);
$rs = $select->fetchAll();


?>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
<h1>Mis facturas</h1>

<?= mostrarInfoUsuario() ?>

<br />
<br />
    <table border="1">

        <tr>
            <th>Número de factura</th>
            <th>Fecha</th>
            <th>IdCoche</th>
            <th>IdMotor</th>
            <th>IdDiseño</th>
            <th>IdGarantía</th>
            <th>IdColor</th>
            <th>Precio</th>
        </tr>
        <?php
        foreach ($rs as $fila) { ?>
            <tr>
                <td><p><?=$fila["idFactura"]?></p></td>
                <td><p><?=$fila["fecha"]?></p></td>
                <td> <p> <?=$fila["idCoche"]?> </p></td>
                <td> <p> <?= $fila["idMotor"] ?> </p></td>
                <td> <p> <?= $fila["idDisenio"] ?> </p></td>
                <td> <p> <?= $fila["idGarantia"] ?></p></td>
                <td> <p> <?= $fila["idColor"] ?></p></td>
                <td> <p> <?= $fila["precioFinal"] ?>€</p></td>

            </tr>
        <?php } ?>

    </table>
    <br/>

    <br/>
    <a href="Inicio.php">Volver al inicio</a>


</body>

</html>