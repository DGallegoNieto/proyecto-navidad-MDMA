<?php

    require_once"_Varios.php";

    //Recoge usuario y contraseña
    $usuario = $_REQUEST['usuario'];
    $contrasenna = $_REQUEST['contrasenna'];

    //Obtiene un usuario en forma de array a partir de un usuario y contraseña
    $arrayUsuario = obtenerUsuario($usuario, $contrasenna);

    if($arrayUsuario == null){ //Si no encuentra el usuario devolverá null, por lo que redirecciona con un error
            redireccionar("SesionInicioMostrarFormulario.php?error");
    }


    //Comprueba si el usuario es un administrador y asigna true o false
    if(comprobarAdmin($arrayUsuario)) {
        $admin = true;
    } else {
        $admin = false;
    }

    //Si ha habido exito y devuelve un usuario no nulo mara su sesión como iniciada
    if ($arrayUsuario != null) {
        marcarSesionComoIniciada($arrayUsuario, $admin);

        if(isset($_REQUEST["recordar"])){ //Si viene el checkbox "recordar" y hay un usuario, se generará una cookie
            generarCookieRecordar($arrayUsuario);
        }

        redireccionar("Inicio.php");

    } else {

        redireccionar("SesionInicioMostrarFormulario.php?error");
    }


