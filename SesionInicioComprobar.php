<?php

require_once"_Varios.php";

$usuario = $_REQUEST['usuario'];
$contrasenna = $_REQUEST['contrasenna'];


$arrayUsuario = obtenerUsuario($usuario, $contrasenna);

if($arrayUsuario ==null){
		redireccionar("SesionInicioMostrarFormulario.php?error");}
if(comprobarAdmin($arrayUsuario)){
	$admin = true;
} else{
    $admin = false;
}
echo $admin;


if ($arrayUsuario != null) { 
	marcarSesionComoIniciada($arrayUsuario, $admin);
    redireccionar("Inicio.php");
	
}

//----------------

if ($arrayUsuario["contrasenna"] == $contrasenna) { // HAN venido datos: identificador existía y contraseña era correcta.

    if(isset($_REQUEST["recordar"])){
        generarCookieRecordar($arrayUsuario);
    }

    marcarSesionComoIniciada($arrayUsuario);
    redireccionar("Inicio.php");

} else {

    redireccionar("SesionInicioMostrarFormulario.php?error");
}


