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
