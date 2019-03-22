<?php
    require_once('../include/header.php');
    

    /*
   *	Este web service termina la sesion de un usuario
   *
   *	Parámetros:
   *	- idUsuario 
   *    - token

   *
   *	Devuelve un JSON con {status, msg}
   *
   *	Lista de status:
   *	- 0         No execution
   *	- 200 	    Success
   *	- 600       Datos faltantes o incorrectos del usuario
   *    - 601       Token invalido
   *    - 604       Usuario invalido
   */

header('Content-Type: application/json');
$json = array (
    'status'    => '0',
    'msg'       => 'Sin Ejecución'
   
);

if(isset($_GET['debug'])){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

$idUsuario = "";
if(!isset($_GET['idUsuario']) || trim($_GET['idUsuario']) == "") {
    $json['status'] 	= 604;
    $json['msg']		= "No se recibió idUsuario";
    echo json_encode($json);
    exit;

}
else {
    $idUsuario = $_GET['idUsuario'];
}

$token = "";
if(!isset($_GET['token']) || trim($_GET['token']) == "") {
    $json['status'] 	= 601;
    $json['msg']		= "No se recibió token";
    echo json_encode($json);
    exit;

}
else {
    $token = $_GET['token'];
}

$result = $db->querySelect(
    "Se verifica que el token recibido es válido",
    "SELECT
        l.idLogin
    FROM
        Login l

    WHERE
        idUsuario = $idUsuario AND
        token = '$token' AND
        status = 'active'
    "
);

$login =  $result->fetch_assoc();

if(!isset($login)) {
    $json['status'] = '605';
    $json['msg']    = 'No tiene permiso de realizar esta petición';
    echo(json_encode($json));
    exit;

}

$idLogin = $login['idLogin'];

$result = $db->queryInsert(
    "Se desactiva el login y el token",
    array("
    UPDATE Login
    SET
    status = 'closed'
    WHERE 
    idLogin = $idLogin
    
 
    ")
);


$json['status']     = '200';
$json['msg']        = 'Logout Correcto';


echo(json_encode($json));
    
?>