<?php
    require_once "_varios.php";

     if(!haySesionIniciada()){ //Si no hay sesión iniciada redirige al inicio
            redireccionar("Inicio.php");
     }

    if(hayCookieValida()) { //Canjea cookie si ha marcado el checkbox de recuerdame y accede directamente a CocheListado
        $cookieCanjeada = intentarCanjearSesionCookie();
    }

    if(!isset($_SESSION["cocheMarcado"])){ //Inicia todas la sesiones de marcado a false la primera vez que se accede
        $_SESSION["cocheMarcado"] = false;
        $_SESSION["disenioMarcado"] = false;
        $_SESSION["motorMarcado"] = false;
        $_SESSION["garantiaMarcado"] = false;
    }

    if(isset($_REQUEST["borrar"])){ //Si se llama desde la factura a "Borrar selección" para reiniciar todos los valores
        restablecerSeleccion();
    }


    $pdo = obtenerPdoConexionBD();

    //Consulta SQL
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

<h1>Coches</h1>

<?=mostrarInfoUsuario()?>

<br />
<br />

<form method="get" action="DisenioListado.php">
<table border='1' bgcolor='#d3d3d3' bordercolor='black'>

    <tr bgcolor='#a9a9a9' align='center' align="center">
        <th>Marca</th>
        <th>Modelo</th>
        <th>Tipo</th>
        <th>Precio</th>
    </tr>
    <?php

    if(isset($_SESSION["admin"])) { //Si hay sesión como admin muestra enlaces a la ficha

    foreach ($rs as $fila) { ?>
        <tr align="center">
            <td> <a href='CocheFicha.php?cocheId=<?=$fila["idCoche"]?>'> <?= $fila["marca"] ?> </a></td>
            <td> <a href='CocheFicha.php?cocheId=<?=$fila["idCoche"]?>'> <?= $fila["modelo"] ?> </a></td>
            <td> <a href='CocheFicha.php?cocheId=<?=$fila["idCoche"]?>'> <?= $fila["tipo"] ?> </a></td>
            <td> <a href='CocheFicha.php?cocheId=<?=$fila["idCoche"]?>'> <?= $fila["precio"] ?> €</a></td>
            <td><input type="radio" name="coche" value='<?=$fila["idCoche"]?>'></td>
        </tr>
    <?php }
    } else { //Si es un usuario normal
        foreach ($rs as $fila) { ?>
            <tr align="center">
                <td> <p> <?= $fila["marca"] ?> </p></td>
                <td> <p> <?= $fila["modelo"] ?> </p></td>
                <td> <p> <?= $fila["tipo"] ?> </p></td>
                <td> <p> <?= $fila["precio"] ?> €</p></td>
                <td><input type="radio" name="coche" value='<?=$fila["idCoche"]?>'></td>
            </tr>
        <?php }
    } ?>



</table>

    <!-- Menú de navegación -->
    <div id="menu" style=" position:absolute; top: 30px; right:200px; padding:40px; border: 1px solid; background-color: darkgrey; border-radius:20px; ">
        <a href="Inicio.php">Inicio</a><br>
        <a href="CocheListado.php">Coches</a><?php if($_SESSION["cocheMarcado"]){echo " <img src='imagenes/tick.png' width='15px' height='15px'>";} ?><br>
        <a href="DisenioListado.php">Diseños</a><?php if($_SESSION["disenioMarcado"]){echo " <img src='imagenes/tick.png' width='15px' height='15px'>";} ?><br>
        <a href="MotorListado.php">Motores</a><?php if($_SESSION["motorMarcado"]){echo " <img src='imagenes/tick.png' width='15px' height='15px'>";} ?><br>
        <a href="GarantiaListado.php">Garantias</a><?php if($_SESSION["garantiaMarcado"]){echo " <img src='imagenes/tick.png' width='15px' height='15px'>";} ?><br>
        <a href="FacturaListado.php">Factura</a><br>
    </div>
    
<br/>
    <?php if(isset($_SESSION["admin"])){ //Permite crear una nueva entrada si ha iniciado sesión como administrador ?>
        <a href="CocheFicha.php?cocheId=-1">Nueva entrada</a>
    <?php } ?>

    <br/>
    <br/>

    <input type="submit" value="Guardar y continuar">

    <br/>

</form>

<button onclick="location.href='Inicio.php'">Volver al inicio</button>

</body>

</html>
