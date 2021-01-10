<?php

    require_once "_varios.php";

    if(!esAdmin()){ //Si por algun motivo el usuario que accede no es un admin, redirecciona al Inicio
        redireccionar("Inicio.php");
    }

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
            <br /><br />
        </li>
        <li>
            <strong>Llantas: </strong>
            <input type="text" name="llantas" value="<?=$llantasDisenio?>"'>
            <br /><br />
        </li>
        <li>
            <strong>Asientos: </strong>
            <input type="text" name="asientos" value="<?=$asientosDisenio?>">
            <br /><br />
        </li>
        <li>
            <strong>Parrilla: </strong>
            <input type="text" name="parrilla" value="<?=$parrillaDisenio?>">
            <br /><br />
        </li>
        <li>
            <strong>Precio: </strong>
            <input type="text" name="precio" value="<?=$precioDisenio?>">
            <br /><br />
        </li>

    </ul>
    <?php if($nuevaEntrada){ ?>
        <input type="submit" value="Crear diseño" name="crear">
    <?php } else {?>
        <input type="submit" value="Guardar cambios" name="guardar">
    <?php } ?>
</form>
<button onclick="location.href='DisenioListado.php'">Volver</button>
<br /><br />
<a href="DisenioEliminar.php?id=<?=$_SESSION["disenioId"]?>">Eliminar</a>

</html>
