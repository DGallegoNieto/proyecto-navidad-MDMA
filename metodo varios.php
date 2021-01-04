<?php
session_start();

function obtenerUsuario(string $usuario, string $contrasenia): ?array
{
	$conexionBD= obtenerPdoConexionBD();
	
	$sql = 'SELECT * FROM usuario WHERE usuario =? AND contrasenia =?';
	$consulta = $conexionBD->prepare($sql);
	
	$consulta->execute([$usuario, $contrasenia]);
	$rs = $consulta->fetchAll();

	if($consulta->rowCount()==1){
		 return $user = array('idUsuario'=> $rs[0]['idUsuario'],'tipo'=> $rs[0]['tipo'],'nombre'=> $rs[0]['nombre'],'apellido' => $rs[0]['apellido'], 'usuario' => $rs[0]['usuario'],'contrasenia' => $rs[0]['contrasenia']);
	}

	else{
		return null;
	}



	function marcarSesionComoIniciada(array $arrayUsuario,bool $admin)
{	
	
	
	$_SESSION["id"]= $arrayUsuario['id'];
	$_SESSION["usuario"]= $arrayUsuario['usuario'];
	if(isset($admin)){
		$_SESSION["admin"]=$admin;
	}
	
}
function comprobarAdmin(array $arrayUsuario): bool
{
	if($arrayUsuario['tipo']=="admin"){
		return true;
	}
	else{
		return false;
	}
}