
<html>

<head>
    <meta charset='UTF-8'>
</head>


<body>

    <h1>Iniciar Sesión</h1>


    <form action="SesionInicioComprobar.php" method="post">
        <label>Usuario</label> <input type="text" name="usuario">
        <br />
        <label>Contraseña</label> <input type="text" name="contrasenna">
        <br />
        <label for="recordar">Recuérdame: </label><input type="checkbox" name="recordar">
        <br />
        <input type="submit" value="Enviar">
    </form>
    <br>
    <?php

    if(isset($_REQUEST['error'])){

        $mensaje = "Usuario y contraseña no validos";

        echo $mensaje;
        echo "<br>";
    }

    ?>

    <a href="UsuarioCrear.php">¿No tiene usuario? Cree uno aquí.</a>
    <br />
    <br />
    <a href="Inicio.php">Volver al inicio</a>

</body>

</html>