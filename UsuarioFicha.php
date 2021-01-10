<?php

require_once "_varios.php";

if(!haySesionIniciada()){
        redireccionar("Inicio.php");
    }
    
$pdo = obtenerPdoConexionBD();


$sql = "SELECT * FROM usuario WHERE idUsuario = ?";
$select = $pdo->prepare($sql);
$select->execute([$_SESSION["idUsuario"]]);
$rs = $select->fetchAll();

$nombreUsuario = $rs[0]["nombre"];
$apellidoUsuario = $rs[0]["apellido"];
$usuarioUsuario = $rs[0]["usuario"];

//Que los usuarios puedan cambiar su contraseña?

?>
<html>

<h1>Ficha de <?=$nombreUsuario?></h1>


<form method="post" action="UsuarioGuardar.php">
    <ul>
        <li>
            <strong>Nombre: </strong>
            <input type="text" name="nombre" value="<?=$nombreUsuario?>">
        </li>
        <li>
            <strong>Apellido: </strong>
            <input type="text" name="apellido" value="<?=$apellidoUsuario?>">
        </li>
        <li>
            <strong>Usuario: </strong>
            <input type="text" name="usuario" value="<?=$usuarioUsuario?>">
        </li>
         <li>
            <strong>Cambiar Contraseña: </strong>
            <input type="text" name="contrasenia">
        </li>

        <li>
            <strong>Confirmar Cambio Contraseña: </strong>
            <input type="text" name="contraseniaC">
        </li>

    </ul>

    <input type="submit" value="Guardar cambios" name="guardar">

</form>
<a href="FacturaUsuario.php">Ver mis facturas</a>
<br />
<a href="UsuarioEliminar.php?id=<?=$_SESSION["idUsuario"]?>">Eliminar mi cuenta</a>
<br />
<a href="Inicio.php">Volver al inicio</a>

</html>
<?php
if(isset($_GET["errorC"])){
    ?>
    
    <br/>
    <?php
    echo "Las contraseñas no coinciden.";
}





