<?php

require_once "_varios.php";

$pdo = obtenerPdoConexionBD();

$_SESSION["garantiaId"] = (int)$_REQUEST["garantiaId"];

$nuevaEntrada = ($_SESSION["garantiaId"] == -1);

if($nuevaEntrada){
    $anios = " ";
    $kilometraje = " ";
    $precio = " ";
}else{

    $sql = "SELECT anios, kilometraje, precio FROM garantia WHERE idGarantia=?";
    $select = $pdo->prepare($sql);
    $select->execute([$_SESSION["garantiaId"]]);
    $rs = $select->fetchAll();

    $aniosGarantia = $rs[0]["anios"];
    $kilometrajeGarantia = $rs[0]["kilometraje"];
    $precioGarantia = $rs[0]["precio"];
}

?>
<html>

<h1>Ficha de garantía</h1>

<?php
if($nuevaEntrada){
    echo "<h3>Introduce los datos de la garantía</h3>";
}
?>

<form method="post" action="GarantiaGuardar.php">
    <ul>
        <li>
            <strong>Anios: </strong>
            <input type="text" name="anios" value="<?=$aniosGarantia?>">
        </li>
        <li>
            <strong>Kilometraje: </strong>
            <input type="text" name="kilometraje" value="<?=$kilometrajeGarantia?>">
        </li>
        <li>
            <strong>Precio: </strong>
            <input type="text" name="precio" value="<?=$precioGarantia?>">
        </li>

    </ul>
    <?php if($nuevaEntrada){ ?>
        <input type="submit" value="Crear garantia" name="crear">
    <?php } else {?>
        <input type="submit" value="Guardar cambios" name="guardar">
    <?php } ?>
</form>

<br />
<a href="GarantiaListado.php">Volver al listado de garantías</a>
<br /><br />
<a href="GarantiaEliminar.php?id=<?=$_SESSION["garantiaId"]?>">Eliminar garantía</a>

</html>