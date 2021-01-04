<?php


require_once"_Varios.php";



$usuario = $_REQUEST['usuario'];
$contrasenia = $_REQUEST['contrasenia'];


$arrayUsuario = obtenerUsuario($usuario, $contrasenia);




if ($arrayUsuario != null) { 
	marcarSesionComoIniciada($arrayUsuario);
    
    redireccionar("CocheListado.php");
} else {
	redireccionar("SesionInicioMostrarFormulario.php");
    
}
