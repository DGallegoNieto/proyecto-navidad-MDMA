<?php


require_once "_Varios.php";

if(!haySesionIniciada()){
        redireccionar("Inicio.php");
    }

cerrarSesion();
borrarCookieRecordar();

redireccionar("Inicio.php");




