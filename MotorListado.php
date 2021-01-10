<?php

	require_once "_varios.php";

	if(!isset($_SESSION["idUsuario"])){ //Si no hay sesión iniciada, redirige al inicio
		redireccionar("Inicio.php");
	}

    if(hayCookieValida()) { //Canjea cookie si ha marcado el checkbox de recuerdame y accede directamente a MotorListado
        $cookieCanjeada = intentarCanjearSesionCookie();
    }

	$conexionBD = obtenerPdoConexionBD();

    //Consulta SQL
	$sql = "SELECT idMotor, potencia, combustible, cilindrada, consumo, co2, cajaCambio, precio FROM motor ORDER BY potencia";
    $select = $conexionBD->prepare($sql);
    $select->execute([]);
    $rs = $select->fetchAll();

    
    if(isset($_REQUEST["disenio"]) && isset($_REQUEST["color"])){ //Recoge los datos seleccionados en Disenio y lo marca
        $_SESSION["facturaDisenio"] = $_REQUEST["disenio"];
        $_SESSION["facturaColor"] = $_REQUEST["color"];
        $_SESSION["disenioMarcado"]= true;    
    }
?>



<html>

<head>
	<meta charset='UTF-8'>
</head>


<body>

<h1>Motores</h1>

<?=mostrarInfoUsuario()?>

<br />
<br />

<form method="get" action="GarantiaListado.php">
    <table border='1' bgcolor='#d3d3d3' bordercolor='black'>

        <tr bgcolor='#a9a9a9' align='center' align="center">
            <th>Potencia</th>
            <th>Combustible</th>
            <th>Cilindrada</th>
            <th>Consumo</th>
            <th>Emisiones</th>
            <th>Caja de cambios</th>
            <th>Precio</th>
        </tr>

        <?php

        if(isset($_SESSION["admin"])){ //Si hay sesión como admin muestra enlaces a la ficha

        foreach ($rs as $fila) { ?>
            <tr align="center">
                <td><a href='MotorFicha.php?motorId=<?=$fila["idMotor"]?>'> <?=$fila["potencia"] ?></a></td>
                <td><a href='MotorFicha.php?motorId=<?=$fila["idMotor"]?>'> <?=$fila["combustible"] ?></a></td>
                <td><a href='MotorFicha.php?motorId=<?=$fila["idMotor"]?>'><?=$fila["cilindrada"] ?></a></td>
                <td><a href='MotorFicha.php?motorId=<?=$fila["idMotor"]?>'>   <?=$fila["consumo"] ?>L /100km</a></td>
                <td><a href='MotorFicha.php?motorId=<?=$fila["idMotor"]?>'><?=$fila["co2"] ?>g co2</a></td>
                <td><a href='MotorFicha.php?motorId=<?=$fila["idMotor"]?>'><?=$fila["cajaCambio"] ?></a></td>
                <td><a href='MotorFicha.php?motorId=<?=$fila["idMotor"]?>'> <?=$fila["precio"] ?>€</a></td>
                <td><input type="radio" name="motor" value='<?=$fila["idMotor"]?>'> </td>
            </tr>
        <?php }
        } else { //Si es un usuario normal
            foreach ($rs as $fila) { ?>
                <tr align="center">
                    <td><p> <?=$fila["potencia"] ?>         </p></td>
                    <td><p> <?=$fila["combustible"] ?>      </p></td>
                    <td><p> <?=$fila["cilindrada"] ?>       </p></td>
                    <td><p> <?=$fila["consumo"] ?>   L/100km</p></td>
                    <td><p> <?=$fila["co2"] ?>       g co2  </p></td>
                    <td><p> <?=$fila["cajaCambio"] ?>       </p></td>
                    <td><p> <?=$fila["precio"] ?>    €       </p></td>
                    <td><input type="radio" name="motor" value='<?=$fila["idMotor"]?>'> </td>
                </tr>
            <?php }
        }?>

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

    <br />

    <?php  if(isset($_SESSION["admin"])){ //Permite crear una nueva entrada si ha iniciado sesión como administrador ?>
        <a href='MotorFicha.php?idMotor=-1'>Crear nuevo Motor</a>
    <?php } ?>

    <br />
    <br/>

    <input type="submit" value="Guardar y continuar">

    <br />

</form>

<button onclick="location.href='DisenioListado.php'">Volver</button>

</body>

</html>


