<?php

require_once "_varios.php";

$pdo = obtenerPdoConexionBD();

$_SESSION["cocheId"] = (int)$_REQUEST["id"];

$nuevaEntrada = ($_SESSION["cocheId"] == -1);

if($nuevaEntrada){
    $marcaCoche = " ";
    $modeloCoche = " ";
    $tipoCoche = " ";
    $precioCoche = " ";
}else{

    $sql = "SELECT marca, modelo, tipo, precio FROM coche WHERE idCoche=?";
    $select = $pdo->prepare($sql);
    $select->execute([$_SESSION["cocheId"]]);
    $rs = $select->fetchAll();

    $marcaCoche = $rs[0]["marca"];
    $modeloCoche = $rs[0]["modelo"];
    $tipoCoche = $rs[0]["tipo"];
    $precioCoche = $rs[0]["precio"];
}

?>
<html>

<h1>Ficha de coche</h1>

<?php
    if($nuevaEntrada){
            echo "<h3>Introduce los datos</h3>";
    }
    ?>

<form method="post" action="CocheGuardar.php">
    <ul>
        <li>
            <strong>Marca: </strong>
            <input type="text" name="marca" value="<?=$marcaCoche?>">
        </li>
        <li>
            <strong>Modelo: </strong>
            <input type="text" name="modelo" value="<?=$modeloCoche?>">
        </li>
        <li>
            <strong>Tipo: </strong>
            <input type="text" name="tipo" value="<?=$tipoCoche?>">
        </li>
        <li>
            <strong>Precio: </strong>
            <input type="text" name="marca" value="<?=$precioCoche?>">
        </li>

    </ul>
    <br/>
    <?php if ($nuevaEntrada) { ?>
        <input type='submit' name='crear' value='Crear nuevo coche' />
    <?php } else { ?>
        <input type='submit' name='guardar' value='Guardar cambios' />
    <?php } ?>
    <br/>
    <a href="CocheEliminar.php?id=<?=$_SESSION["cocheId"]?>">Eliminar</a>
</form>
<a href="CocheListado.php">Volver</a>

</html>
