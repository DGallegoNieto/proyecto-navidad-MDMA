<?php

require_once "_varios.php";

if(hayCookieValida()) { //Canjea cookie si ha marcado el checkbox de recuerdame y accede directamente a Inicio
    $cookieCanjeada = intentarCanjearSesionCookie();
}

?>
<html>
<style type="text/css">
    div1 { position: absolute; top: 33%; left: 3%; border: 5px solid black; text-align: center; background-color: darkgrey}
    div2 { position: absolute; top: 33%; left: 32%; border: 5px solid black; text-align: center; background-color: darkgrey}
    div3 { position: absolute; top: 33%; left: 63%; border: 5px solid black; text-align: center; background-color: darkgrey}

</style>

<h1><b><u>CONCESIONARIO DE COCHES</u></b></h1>

<?php mostrarInfoUsuario(); ?>

<?php if(haySesionIniciada()){ //Da opción a crear coches personalizados y comprar una vez se haya iniciado sesión?>

<H3>CREA TU PROPIO COCHE PERSONALIZADO <a href="CocheListado.php" >AQUÍ</a></H3>

<?php } ?>

<h3>COCHES MÁS VENDIDOS:</h3>
<div1>
<b><u>VOLKSWAGEN TIGUAN</u></b>
</br>
    <p><b>COLOR:</b> AZÚL</p>
    <p><b>DISEÑO:</b> DEPORTIVO (R-LINE)</p>
    <p><b>GARANTÍA:</b> 3 AÑOS</p>
    <p><b>MOTOR:</b> GASOLINA 150CV MANUAL</p>
    <p><b>PRECIO: 33.405€</b> </p>
    <img src="imagenes/volkswagen.jfif" width="248px">
    </br></br>
    <?php if(haySesionIniciada()){ ?>
        <button onclick="location.href='FacturaListado.php?idFactura=13'">COMPRAR</button>
    <?php } ?>
    </br>
</div1>

<div2>
    <b><u>AUDI A4</u></b>
    </br>
    <p><b>COLOR:</b> ROJO</p>
    <p><b>DISEÑO:</b> INTERMEDIO (AMBITION)</p>
    <p><b>GARANTÍA:</b> 4 AÑOS</p>
    <p><b>MOTOR:</b> DIESEL 170CV AUTOMÁTICO</p>
    <p><b>PRECIO: 42.135€</b> </p>
    <img src="imagenes/audiA4.jfif" width="301px">
    </br></br>
    <?php if(haySesionIniciada()){ ?>
        <button onclick="location.href='FacturaListado.php?idFactura=14'">COMPRAR</button>
    <?php } ?>
    </br>
</div2>

<div3>
    <b><u>SEAT CORDOBA</u></b>
    </br>
    <p><b>COLOR:</b> METÁTICO</p>
    <p><b>DISEÑO:</b> BASE (ACTIVE)</p>
    <p><b>GARANTÍA:</b> 3 AÑOS</p>
    <p><b>MOTOR:</b> DIESEL 150CV MANUAL</p>
    <p><b>PRECIO: 24.405€</b> </p>
    <img src="imagenes/seatCordoba.jfif" width="228px">
    </br></br>
    <?php if(haySesionIniciada()){ ?>
        <button onclick="location.href='FacturaListado.php?idFactura=15'">COMPRAR</button>
    <?php } ?>

    </br>
</div3>

</html>
