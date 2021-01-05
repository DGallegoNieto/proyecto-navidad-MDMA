<?php

require_once "_varios.php";

$pdo = obtenerPdoConexionBD();

$_SESSION["disenioId"] = (int)$_REQUEST["disenioId"];

$nuevaEntrada = ($_SESSION["disenioId"] == -1);

if($nuevaEntrada){
    $acabadoDisenio = " ";
    $llantasDisenio = " ";
    $asientosDisenio = " ";
    $parrillaDisenio = " ";
    $precioDisenio = " ";
}else{

    $sql = "SELECT acabado, llantas, asientos, parrilla, precio FROM disenio WHERE idDisenio=?";
    $select = $pdo->prepare($sql);
    $select->execute([$_SESSION["disenioId"]]);
    $rs = $select->fetchAll();

    $acabadoDisenio = $rs[0]["acabado"];
    $llantasDisenio = $rs[0]["llantas"];
    $asientosDisenio = $rs[0]["asientos"];
    $parrillaDisenio = $rs[0]["parrilla"];
    $precioDisenio = $rs[0]["precio"];
}

?>
<html>

<h1>Ficha de diseño</h1>

<?php
if($nuevaEntrada){
    echo "<h3>Introduce los datos</h3>";
}
?>

<form method="post" action="DisenioGuardar.php">
    <ul>
        <li>
            <strong>Acabado: </strong>
            <input type="text" name="acabado" value="<?=$acabadoDisenio?>">
        </li>
        <li>
            <strong>Llantas: </strong>
            <input type="text" name="llantas" value="<?=$llantasDisenio?>">
        </li>
        <li>
            <strong>Asientos: </strong>
            <input type="text" name="asientos" value="<?=$asientosDisenio?>">
        </li>
        <li>
            <strong>Parrilla: </strong>
            <input type="text" name="parrilla" value="<?=$parrillaDisenio?>">
        </li>
        <li>
            <strong>Precio: </strong>
            <input type="text" name="precio" value="<?=$precioDisenio?>">
        </li>

    </ul>
    <?php if($nuevaEntrada){ ?>
        <input type="submit" value="Crear diseño" name="crear">
    <?php } else {?>
        <input type="submit" value="Guardar cambios" name="guardar">
    <?php } ?>
</form>

<a href="DisenioEliminar.php?id=<?=$_SESSION["disenioId"]?>">Eliminar</a>
<br />
<a href="DisenioListado.php">Volver</a>

</html>
