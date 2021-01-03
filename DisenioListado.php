<?php
require_once "_varios.php";

$pdo = obtenerPdoConexionBD();

$sql = "SELECT * FROM disenio ORDER BY idDisenio";
$select = $pdo->prepare($sql);
$select->execute([]);
$rs = $select->fetchAll();


?>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
<h1>Listado de diseños</h1>

<table border="1">

    <tr>
        <th>Id</th>
        <th>Acabado</th>
        <th>Llantas</th>
        <th>Asientos</th>
        <th>Parrilla</th>
        <th>Precio</th>
    </tr>
    <?php
    foreach ($rs as $fila) { ?>
        <tr>
            <td> <p><?=$fila["idDisenio"] ?></p></td>
            <td> <p><?=$fila["acabado"] ?></p></td>
            <td> <p><?=$fila["llantas"] ?></p></td>
            <td> <p><?=$fila["asientos"] ?></p></td>
            <td> <p><?=$fila["parrilla"] ?></p></td>
            <td> <p><?=$fila["precio"] ?>€</p></td>
            <td><input type="radio" name="disenio" </td>
        </tr>
    <?php } ?>

</table>
<br/>
<a href="">Atrás</a>
<br/>
<a href="">Siguiente</a>

</body>

</html>