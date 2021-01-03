<?php
declare(strict_types=1);

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
    $sql = 'SELECT * FROM Usuario WHERE identificador=? ';
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
( usuario,?,?,?,?)';
    $consulta = $conexionBD->prepare($sql);
    $consulta->execute([$usuario,$contrasenna,$nombre,$apellido]);
    $rs = $consulta->fetchAll();

}

?>
