<?php
require_once "_varios.php";

$pdo = obtenerPdoConexionBD();

$sql = "SELECT * FROM coche ORDER BY idCoche";
$select = $pdo->prepare($sql);
$select->execute([]);
$rs = $select->fetchAll();


?>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
<h1>Listado de coches</h1>

<table border="1">

    <tr>
        <th>Id</th> <!--Numero de serie?-->
        <th>Marca</th>
        <th>Modelo</th>
        <th>Tipo</th>
        <th>Precio</th>
    </tr>
    <?php
    foreach ($rs as $fila) { ?>
        <tr>
            <td> <p><?=$fila["idCoche"] ?></p></td>
            <td> <p><?=$fila["marca"] ?></p></td>
            <td> <p><?=$fila["modelo"] ?></p></td>
            <td> <p><?=$fila["tipo"] ?></p></td>
            <td> <p><?=$fila["precio"] ?>€</p></td>
            <td><input type="radio" name="coche" </td>
        </tr>
    <?php } ?>

</table>
<br/>
<a href="">Volver al inicio</a>
<br/>
<a href="">Siguiente</a>

</body>

</html>
