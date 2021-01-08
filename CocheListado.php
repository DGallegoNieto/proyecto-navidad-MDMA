<?php
require_once "_varios.php";

$_SESSION["cocheMarcado"] = false;
$_SESSION["disenioMarcado"] = false;
$_SESSION["motorMarcado"] = false;
$_SESSION["garantiaMarcado"] = false;

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

<?=mostrarInfoUsuario()?>
<br />
<br />

<form method="get" action="DisenioListado.php">
<table border='1' bgcolor='#d3d3d3' bordercolor='black'>

    <tr bgcolor='#a9a9a9' align='center'>
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
            <td> <a href='CocheFicha.php?cocheId=<?=$fila["idCoche"]?>'> <?= $fila["precio"] ?> €</a></td>
            <td><input type="radio" name="coche" value='<?=$fila["idCoche"]?>'></td>
        </tr>
    <?php } ?>

</table>
    
<div id="menu" style=" position:absolute; top: 30px; right:200px; padding:40px; border: 1px solid; background-color: darkgrey; border-radius:20px; ">
<a href="Inicio.php">Inicio</a><br>    
<a href="CocheListado.php">Coches</a><?php if($_SESSION["cocheMarcado"]){echo " <img src='imagenes/tick.png' width='15px' height='15px'>";} ?><br>
<a href="DisenioListado.php">Diseños</a><?php if($_SESSION["disenioMarcado"]){echo " <img src='imagenes/tick.png' width='15px' height='15px'>";} ?><br>
<a href="MotorListado.php">Motores</a><?php if($_SESSION["motorMarcado"]){echo " <img src='imagenes/tick.png' width='15px' height='15px'>";} ?><br>
<a href="GarantiaListado.php">Garantias</a><?php if($_SESSION["garantiaMarcado"]){echo " <img src='imagenes/tick.png' width='15px' height='15px'>";} ?><br>
<a href="FacturaListado.php">Factura</a><br>
</div>    
    
<br/>
<?php 
if(isset($_SESSION["admin"])){
    ?>
    <a href="CocheFicha.php?cocheId=-1">Nueva entrada</a> 
<?php } ?>

<br/>
<a href="Inicio.php">Volver al inicio</a>
<br/>
<input type="submit" value="Siguiente">
<br/>
</form>
<br/>

</body>

</html>
