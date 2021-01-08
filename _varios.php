<?php
declare(strict_types=1);

session_start();

function obtenerPdoConexionBD(): PDO
{
    $servidor = "localhost";
    $bd = "concesionario";
    $identificador = "root";
    $contrasenna = "";
    $opciones = [
        PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
    ];

    try {
        $conexion = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8", $identificador, $contrasenna, $opciones);
    } catch (Exception $e) {
        error_log("Error al conectar: " . $e->getMessage()); // El error se vuelca a php_error.log
        exit('Error al conectar'); //something a user can understand
    }

    return $conexion;
}

function redireccionar(string $url)
{
    header("Location: $url");
    exit;
}

function syso(string $contenido)
{
    file_put_contents('php://stderr', $contenido . "\n");
}

// funciones para crear un usuario y comprobar si existe el usuario que se va a crear (Alex)
function comprobarUsuario(string $usuario): bool
{
    $conexionBD= obtenerPdoConexionBD();
    $sql = 'SELECT * FROM Usuario WHERE idUsuario=? ';
    $consulta = $conexionBD->prepare($sql);
    $consulta->execute([$usuario]);
    $rs = $consulta->fetchAll();
    if($consulta->rowCount()==1){
         return true;
    }
    else{
        return false;
    }

}
function crearUsuario(string $usuario,string $contrasenna,string $nombre,string $apellido)
{
    $conexionBD= obtenerPdoConexionBD();
    $sql = 'INSERT INTO `Usuario` (`tipo`,`nombre`,`apellido`,`usuario`, `contrasenna`) VALUES
( ?,?,?,?,?)';
    $consulta = $conexionBD->prepare($sql);
    $consulta->execute(['Cliente',$usuario,$contrasenna,$nombre,$apellido]);
    $rs = $consulta->fetchAll();

}


function obtenerUsuario(string $usuario, string $contrasenna): ?array
{
    $conexionBD = obtenerPdoConexionBD();

    $sql = 'SELECT * FROM usuario WHERE usuario =? AND contrasenna =?';
    $consulta = $conexionBD->prepare($sql);

    $consulta->execute([$usuario, $contrasenna]);
    $rs = $consulta->fetchAll();

    if ($consulta->rowCount() == 1) {
        return ['idUsuario' => $rs[0]['idUsuario'], 'tipo' => $rs[0]['tipo'], 'nombre' => $rs[0]['nombre'], 'apellido' => $rs[0]['apellido'], 'usuario' => $rs[0]['usuario'], 'contrasenna' => $rs[0]['contrasenna']];
    } else {
        return null;
    }
}



	function marcarSesionComoIniciada(array $arrayUsuario, bool $admin)
{
	$_SESSION["idUsuario"]= $arrayUsuario['idUsuario'];
	$_SESSION["usuario"]= $arrayUsuario['usuario'];
	$_SESSION["nombre"] = $arrayUsuario['nombre'];
	$_SESSION["apellido"] = $arrayUsuario['apellido'];
	if($admin == true){
		$_SESSION["admin"] = $admin;
	}
	
}
function comprobarAdmin(array $arrayUsuario): bool
{
    if ($arrayUsuario['tipo'] == "Admin") {
        return true;
    } else {
        return false;
    }
}

function cerrarSesion()
{
    session_destroy();
    session_unset();


}

//
function generarCookieRecordar(array $arrayUsuario)
{
    $pdo = obtenerPdoConexionBD();

    $codigoCookie = generarCadenaAleatoria(32);

    setcookie("codigoCookie", $codigoCookie, time()+60*60*24);
    setcookie("usuarioCookie", $arrayUsuario["identificador"], time()+60*60*24);

    $sql = "UPDATE usuario SET codigoCookie=? WHERE id=?";
    $sentencia = $pdo ->prepare($sql);
    $sentencia->execute([$codigoCookie, $arrayUsuario["idUsuario"]]);


   
}

function generarCadenaAleatoria(int $longitud): string
{
    for ($s = '', $i = 0, $z = strlen($a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')-1; $i != $longitud; $x = rand(0,$z), $s .= $a[$x], $i++);
    return $s;
}

function borrarCookieRecordar()
{
    //TODO borrar cookie BD
    setcookie("codigoCookie", "", time()-60*60*24);
    setcookie("usuarioCookie", "", time()-60*60*24);

}

function hayCookieValida()
{
    if(isset($_COOKIE["codigoCookie"])){
        return true;
    } else {
        return false;
    }
}

function intentarCanjearSesionCookie(): bool
{

    if(isset($_COOKIE["codigoCookie"]) && isset($_COOKIE["usuarioCookie"])){

        $pdo = obtenerPdoConexionBD();

        $sql = "SELECT * FROM Usuario WHERE identificador=? AND codigoCookie=?";
        $sentencia = $pdo ->prepare($sql);
        $sentencia->execute([$_COOKIE["usuarioCookie"], $_COOKIE["codigoCookie"]]); 
        $usuario = $sentencia->fetchAll();

        $unaFilaAfectada = ($sentencia->rowCount() == 1);

        if($unaFilaAfectada){
            $_SESSION["idUsuario"] = $usuario[0]["idUsuario"];
            $_SESSION["identificador"] = $usuario[0]["identificador"];
            $_SESSION["contrasenna"] = $usuario[0]["contrasenna"];
            $_SESSION["nombre"] = $usuario[0]["nombre"];
            $_SESSION["apellidos"] = $usuario[0]["apellidos"];
            $_SESSION["codigoCookie"] = $usuario[0]["codigoCookie"];
            $_SESSION["tipo"] = $usuario[0]["tipo"];
            return true;
        } else {
            return false;
        }
    } else {
        borrarCookieRecordar();
        return false;
    }
}

function haySesionIniciada(): bool
{
    if(isset($_SESSION["idUsuario"])){
        return true;
    } else{
        return false;
    }
}

function mostrarInfoUsuario()
{
    if(haySesionIniciada()){
        echo "<span><p>Bienvenido, <a href='UsuarioFicha.php'>$_SESSION[nombre] $_SESSION[apellido]</a>.</p><a href='SesionCerrar.php'>Cerrar sesión</a></span>";
    } else{
        echo "<span><a href='SesionInicioMostrarFormulario.php'>Iniciar sesión</a></span>";
    }

}
