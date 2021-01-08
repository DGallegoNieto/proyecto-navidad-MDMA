<?php
require_once "_varios.php";

$pdo = obtenerPdoConexionBD();

$sql = "SELECT * FROM garantia ORDER BY idGarantia";
$select = $pdo->prepare($sql);
$select->execute([]);
$rs = $select->fetchAll();

if(isset($_REQUEST["motor"])){
    $_SESSION["facturaMotor"] = $_REQUEST["motor"];
    $_SESSION["motorMarcado"] = true;
}else{
    $_SESSION["motorMarcado"] = false;
}

?>

<html>

<head>
    <meta charset='UTF-8'>
</head>

<body>

<h1>Listado de Garantías</h1>

<?=mostrarInfoUsuario()?>
<br />
<br />

<form action="FacturaListado.php" method="get">
    <table border='1' bgcolor='#d3d3d3' bordercolor='black'>

        <tr bgcolor='#a9a9a9' align='center'>
        <th>Años</th>
        <th>Kilometraje</th>
        <th>Precio</th>
    </tr>

    <?php foreach ($rs as $fila) { ?>
        <tr align="center">
            <td><a href='GarantiaFicha.php?garantiaId=<?=$fila["idGarantia"]?>'> <?= $fila["anios"] ?>       </a></td>
            <td><a href='GarantiaFicha.php?garantiaId=<?=$fila["idGarantia"]?>'> <?= $fila["kilometraje"] ?> </a></td>
            <td><a href='GarantiaFicha.php?garantiaId=<?=$fila["idGarantia"]?>'> <?= $fila["precio"] ?> €    </a></td>
            <td><input type="radio" name="garantia" value='<?=$fila["idGarantia"]?>'</td>
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

<br/><br/>
<?php
if(isset($_SESSION["admin"])){
    ?>
    <a href="GarantiaFicha.php?idGarantia=-1">Nueva entrada</a> 
<?php } ?>
<br/><br/>
<a href="Inicio.php">Volver al inicio</a>
<br/><br/>
<input type="submit" value="Ver factura">
<br/>
</form>
</body>

</html>
