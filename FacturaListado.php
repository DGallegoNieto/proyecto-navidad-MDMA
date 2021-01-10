<?php

require_once "_varios.php";

 if(!haySesionIniciada()){
        redireccionar("Inicio.php");
 }
    
$conexionBD = obtenerPdoConexionBD();


if(isset($_REQUEST["idFactura"])){
    $sqlFactura = "SELECT * FROM factura WHERE idFactura=?";
    $selectFactura = $conexionBD->prepare($sqlFactura);
    $selectFactura->execute([$_REQUEST["idFactura"]]);
    $rsFactura = $selectFactura->fetchAll();

    $_SESSION["facturaCoche"] = $rsFactura[0]["idCoche"];
    $_SESSION["facturaMotor"] = $rsFactura[0]["idMotor"];
    $_SESSION["facturaDisenio"] = $rsFactura[0]["idDisenio"];
    $_SESSION["facturaGarantia"] = $rsFactura[0]["idGarantia"];
    $_SESSION["facturaColor"] = $rsFactura[0]["idColor"];


    $_SESSION["cocheMarcado"] = true;
    $_SESSION["disenioMarcado"] = true;
    $_SESSION["motorMarcado"] = true;
    $_SESSION["garantiaMarcado"] = true;
    $todoMarcado = true;
}



if(isset($_REQUEST["garantia"])) { //Recoge datos de Garantía
    $_SESSION["facturaGarantia"] = $_REQUEST["garantia"];
    $_SESSION["garantiaMarcado"] = true;
}

//Control de si están todos los campos seleccionados
if(isset($_SESSION["facturaCoche"]) && isset($_SESSION["facturaDisenio"]) && isset($_SESSION["facturaMotor"]) && isset($_SESSION["facturaGarantia"])){
    $todoMarcado = true;
} else {
    $todoMarcado = false;
}




if($todoMarcado) { //Si están todos los apartados seleccionados

//SQL de Coche
    $sqlCoche = "SELECT * FROM coche WHERE idCoche=?";
    $selectCoche = $conexionBD->prepare($sqlCoche);
    $selectCoche->execute([$_SESSION["facturaCoche"]]);
    $rsCoche = $selectCoche->fetchAll();

//SQL de Diseño
    $sqlDisenio = "SELECT * FROM disenio WHERE idDisenio=?";
    $selectDisenio = $conexionBD->prepare($sqlDisenio);
    $selectDisenio->execute([$_SESSION["facturaDisenio"]]);
    $rsDisenio = $selectDisenio->fetchAll();


//SQL de Color
    $sqlColor = "SELECT * FROM color WHERE idColor=?";
    $selectColor = $conexionBD->prepare($sqlColor);
    $selectColor->execute([$_SESSION["facturaColor"]]);
    $rsColor = $selectColor->fetchAll();

//SQL de Motor
    $sqlMotor = "SELECT * FROM motor WHERE idMotor=?";
    $selectMotor = $conexionBD->prepare($sqlMotor);
    $selectMotor->execute([$_SESSION["facturaMotor"]]);
    $rsMotor = $selectMotor->fetchAll();

//SQL de Garantía
    $sqlGarantia = "SELECT * FROM garantia WHERE idGarantia=?";
    $selectGarantia = $conexionBD->prepare($sqlGarantia);
    $selectGarantia->execute([$_SESSION["facturaGarantia"]]);
    $rsGarantia = $selectGarantia->fetchAll();


    $precioFinal = 0;
?>


    <html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
    <h1>Factura</h1>

    <h2>Coche:</h2>

    <table border='1' bgcolor='#d3d3d3' bordercolor='black'>

        <tr bgcolor='#a9a9a9' align='center'>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Tipo</th>
            <th>Precio</th>
        </tr>
        <?php

        if(isset($_SESSION["admin"])) { //Si es sesión de admin muestra enlaces a las fichas

        foreach ($rsCoche as $fila) { ?>
            <tr align='center'>
                <td> <a href='CocheFicha.php?cocheId=<?=$fila["idCoche"]?>'> <?= $fila["marca"] ?> </a></td>
                <td> <a href='CocheFicha.php?cocheId=<?=$fila["idCoche"]?>'> <?= $fila["modelo"] ?> </a></td>
                <td> <a href='CocheFicha.php?cocheId=<?=$fila["idCoche"]?>'> <?= $fila["tipo"] ?> </a></td>
                <td> <a href='CocheFicha.php?cocheId=<?=$fila["idCoche"]?>'> <?= $fila["precio"] ?> €</a></td>
                <?php $precioFinal = $precioFinal + (int)$fila["precio"] ?>

            </tr>
        <?php }
        } else{ //Si es un usuario normal
            foreach ($rsCoche as $fila) { ?>
                <tr align='center'>
                    <td> <p> <?= $fila["marca"] ?> </p></td>
                    <td> <p> <?= $fila["modelo"] ?> </p></td>
                    <td> <p> <?= $fila["tipo"] ?> </p></td>
                    <td> <p> <?= $fila["precio"] ?> €</p></td>
                    <?php $precioFinal = $precioFinal + (int)$fila["precio"] ?>

                </tr>
            <?php } ?>
        <?php } ?>



    </table>

    <div id="menu" style=" position:absolute; top: 30px; right:200px; padding:40px; border: 1px solid; background-color: #a9a9a9; border-radius:20px; ">
        <a href="Inicio.php">Inicio</a><br>
        <a href="CocheListado.php">Coches</a><?php if($_SESSION["cocheMarcado"]){echo " <img src='imagenes/tick.png' width='15px' height='15px'>";} ?><br>
        <a href="DisenioListado.php">Diseños</a><?php if($_SESSION["disenioMarcado"]){echo " <img src='imagenes/tick.png' width='15px' height='15px'>";} ?><br>
        <a href="MotorListado.php">Motores</a><?php if($_SESSION["motorMarcado"]){echo " <img src='imagenes/tick.png' width='15px' height='15px'>";} ?><br>
        <a href="GarantiaListado.php">Garantias</a><?php if($_SESSION["garantiaMarcado"]){echo " <img src='imagenes/tick.png' width='15px' height='15px'>";} ?><br>
        <a href="FacturaListado.php">Factura</a><br>
    </div>

    <h2>Diseño:</h2>
    <table border='1' bgcolor='#d3d3d3' bordercolor='black'>

        <tr bgcolor='#a9a9a9' align='center'>
            <th>Acabado</th>
            <th>Llantas</th>
            <th>Asientos</th>
            <th>Parrilla</th>
            <th>Precio</th>

        </tr>
        <?php

        if(isset($_SESSION["admin"])){ //Si hay sesión como admin muestra enlaces a la ficha

            foreach ($rsDisenio as $fila) { ?>
                <tr>
                    <td> <a href='DisenioFicha.php?disenioId=<?=$fila["idDisenio"]?>'> <?= $fila["acabado"] ?> </a></td>
                    <td> <a href='DisenioFicha.php?disenioId=<?=$fila["idDisenio"]?>'> <?= $fila["llantas"] ?> </a></td>
                    <td> <a href='DisenioFicha.php?disenioId=<?=$fila["idDisenio"]?>'> <?= $fila["asientos"] ?> </a></td>
                    <td> <a href='DisenioFicha.php?disenioId=<?=$fila["idDisenio"]?>'> <?= $fila["parrilla"] ?> </a></td>
                    <td> <a href='DisenioFicha.php?disenioId=<?=$fila["idDisenio"]?>'> <?= $fila["precio"] ?> €</a></td>
                    <?php $precioFinal = $precioFinal + (int)$fila["precio"] ?>
                </tr>
            <?php }
        } else { //Si es un usuario normal
            foreach ($rsDisenio as $fila) { ?>
                <tr>
                    <td> <p> <?= $fila["acabado"] ?>  </p></td>
                    <td> <p> <?= $fila["llantas"] ?>  </p></td>
                    <td> <p> <?= $fila["asientos"] ?> </p></td>
                    <td> <p> <?= $fila["parrilla"] ?> </p></td>
                    <td> <p> <?= $fila["precio"] ?> € </p></td>
                    <?php $precioFinal = $precioFinal + (int)$fila["precio"] ?>
                </tr>
            <?php }
        }?>

    </table>

    <br />

    <table border='1' bgcolor='#d3d3d3' bordercolor='black'>

        <tr bgcolor='#a9a9a9' align='center'>
            <th colspan="3">Color</th>
        </tr>
        <?php
        foreach ($rsColor as $filaColor) { ?>
            <tr align='center'>

                <td><p> <?= $filaColor["color"] ?> </p></td>
                <td style="background-color:<?=$filaColor["hexadecimal"]?>; width: 15px; height: 10px;"></td>
            </tr>
        <?php } ?>
    </table>

    <h2>Motor:</h2>

    <table border='1' bgcolor='#d3d3d3' bordercolor='black'>

        <tr bgcolor='#a9a9a9' align='center'>
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

            foreach ($rsMotor as $fila) { ?>
                <tr>
                    <td><a href='MotorFicha.php?idMotor=<?=$fila["idMotor"]?>'> <?=$fila["potencia"] ?></a></td>
                    <td><a href='MotorFicha.php?idMotor=<?=$fila["idMotor"]?>'> <?=$fila["combustible"] ?></a></td>
                    <td><a href='MotorFicha.php?idMotor=<?=$fila["idMotor"]?>'><?=$fila["cilindrada"] ?></a></td>
                    <td><a href='MotorFicha.php?idMotor=<?=$fila["idMotor"]?>'>   <?=$fila["consumo"] ?>L /100km</a></td>
                    <td><a href='MotorFicha.php?idMotor=<?=$fila["idMotor"]?>'><?=$fila["co2"] ?>g co2</a></td>
                    <td><a href='MotorFicha.php?idMotor=<?=$fila["idMotor"]?>'><?=$fila["cajaCambio"] ?></a></td>
                    <td><a href='MotorFicha.php?idMotor=<?=$fila["idMotor"]?>'> <?=$fila["precio"] ?>€</a></td>
                    <?php $precioFinal = $precioFinal + (int)$fila["precio"] ?>
                </tr>
            <?php }
        } else { //Si es un usuario normal
            foreach ($rsMotor as $fila) { ?>
                <tr>
                    <td><p> <?=$fila["potencia"] ?>         </p></td>
                    <td><p> <?=$fila["combustible"] ?>      </p></td>
                    <td><p> <?=$fila["cilindrada"] ?>       </p></td>
                    <td><p> <?=$fila["consumo"] ?>   L/100km</p></td>
                    <td><p> <?=$fila["co2"] ?>       g co2  </p></td>
                    <td><p> <?=$fila["cajaCambio"] ?>       </p></td>
                    <td><p> <?=$fila["precio"] ?>    €       </p></td>
                    <?php $precioFinal = $precioFinal + (int)$fila["precio"] ?>
                </tr>
            <?php }
        }?>

    </table>

    <h2>Garantía:</h2>
    <table border='1' bgcolor='#d3d3d3' bordercolor='black'>

        <tr bgcolor='#a9a9a9' align='center'>
            <th>Años</th>
            <th>Kilometraje</th>
            <th>Precio</th>
        </tr>

        <?php

        if(isset($_SESSION["admin"])){ //Si hay sesión como admin muestra enlaces a la ficha

            foreach ($rsGarantia as $fila) { ?>
                <tr align="center">
                    <td><a href='GarantiaFicha.php?garantiaId=<?=$fila["idGarantia"]?>'> <?= $fila["anios"] ?>       </a></td>
                    <td><a href='GarantiaFicha.php?garantiaId=<?=$fila["idGarantia"]?>'> <?= $fila["kilometraje"] ?> </a></td>
                    <td><a href='GarantiaFicha.php?garantiaId=<?=$fila["idGarantia"]?>'> <?= $fila["precio"] ?> €    </a></td>
                    <?php $precioFinal = $precioFinal + (int)$fila["precio"] ?>
                </tr>
            <?php }
        } else { //Si es un usuario normal
            foreach ($rsGarantia as $fila) { ?>
                <tr align="center">
                    <td><p> <?= $fila["anios"] ?>       </p></td>
                    <td><p> <?= $fila["kilometraje"] ?> </p></td>
                    <td><p> <?= $fila["precio"] ?> €    </p></td>
                    <?php $precioFinal = $precioFinal + (int)$fila["precio"] ?>
                </tr>
            <?php }
        } ?>

    </table>

    <h2>Precio final: <?=$precioFinal?> €</h2>

    <?php $_SESSION["precioFinal"] = $precioFinal ?>
    <br />

    <a href="GarantiaListado.php">Volver</a>
    <a href="FacturaGuardar.php">Guardar</a>

    <?php }  else { //Si no ha seleccionado nada  ?>

    <?php if($_SESSION["cocheMarcado"] == false){ ?>
        <div>
            <p> No has seleccionado un <a href="CocheListado.php">coche</a>.</p>
        </div>
    <?php  }?>

    <?php if($_SESSION["disenioMarcado"] == false){ ?>
        <div>
            <p> No has seleccionado un <a href="DisenioListado.php">diseño</a>.</p>
        </div>
    <?php  }?>

    <?php if($_SESSION["motorMarcado"] == false){ ?>
        <div>
            <p> No has seleccionado un <a href="MotorListado.php">motor</a>.</p>
        </div>
    <?php  }?>

    <?php if($_SESSION["garantiaMarcado"] == false){ ?>
        <div>
            <p> No has seleccionado una <a href="GarantiaListado.php">garantía</a>.</p>
        </div>
    <?php  }?>

<?php } ?>
    </body>
    </html>


