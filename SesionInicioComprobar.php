<?php


require_once"_Varios.php";



$usuario = $_REQUEST['usuario'];
$contrasenna = $_REQUEST['contrasenna'];


$arrayUsuario = obtenerUsuario($usuario, $contrasenna);
if(comprobarAdmin($arrayUsuario)){
	$admin = true;
}



if ($arrayUsuario != null) { 
	marcarSesionComoIniciada($arrayUsuario);
    
    redireccionar("CocheListado.php");
} else {
	redireccionar("SesionInicioMostrarFormulario.php");
    
}
