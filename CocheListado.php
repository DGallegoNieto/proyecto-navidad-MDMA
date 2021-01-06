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
        <th>Marca</th>
        <th>Modelo</th>
        <th>Tipo</th>
        <th>Precio</th>
    </tr>
    <?php
    foreach ($rs as $fila) { ?>
        <tr>
            <td> <a href='CocheFicha.php?cocheId=<?=$fila["idCoche"]?>'> <?= $fila["marca"] ?> </a></td>
            <td> <a href='CocheFicha.php?cocheId=<?=$fila["idCoche"]?>'> <?= $fila["modelo"] ?> </a></td>
            <td> <a href='CocheFicha.php?cocheId=<?=$fila["idCoche"]?>'> <?= $fila["tipo"] ?> </a></td>
            <td> <a href='CocheFicha.php?cocheId=<?=$fila["idCoche"]?>'> <?= $fila["precio"] ?> €</a></p></td>
            <td><input type="radio" name="coche" value='<?$fila["idCoche"]?>'</td>
        </tr>
    <?php } ?>

</table>
<br/>
<?php 
if(isset($_SESSION["admin"])){
    ?>
    <a href="CocheFicha.php?cocheId=-1">Nueva entrada</a> 
<?php } ?>

<br/>
<a href="Inicio.php">Volver al inicio</a>
<br/>
<a href="DisenioListado.php">Siguiente</a>
<a href="SesionCerrar.php">Cerrar Sesión</a>
<br/>

</body>

</html>
