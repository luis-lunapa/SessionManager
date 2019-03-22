<?php
    require_once('../include/header.php');
    

    /*
   *	Este web service regresa los datos de login
   *
   *	Parámetros:
   *	- idUsuario 
   *    - token

   *
   *	Devuelve un JSON con {status, msg, data}
   *
   *	Lista de status:
   *	- 0         No execution
   *	- 200 	    Success
   *	- 600       Datos faltantes o incorrectos del usuario
   *    - 601       No se recibio idUsuario
   *    - 604       Token no recibido o válido
   */

header('Content-Type: application/json');
$json = array (
    'status'    => '0',
    'msg'       => 'Sin Ejecución',
    'data'      => array()
);

if(isset($_GET['debug'])){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

$idUsuario = "";
if(!isset($_GET['idUsuario']) || trim($_GET['idUsuario']) == "") {
    $json['status'] 	= 601;
    $json['msg']		= "No se recibió idUsuario";
    echo json_encode($json);
    exit;

}
else {
    $idUsuario = $_GET['idUsuario'];
}

$token = "";
if(!isset($_GET['token']) || trim($_GET['token']) == "") {
    $json['status'] 	= 602;
    $json['msg']		= "No se recibió token con autorización";
    echo json_encode($json);
    exit;

}
else {
    $token = $_GET['token'];
}

$result = $db->querySelect(
    "Se verifica que el token recibido es válido",
    "SELECT
        u.username,
        u.name,
        u.email,
        u.description
    FROM
        Login l INNER JOIN User u ON
        l.idUsuario = u.idUser

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

$json['status']                 = '200';
$json['msg']                    = 'Datos obtenidos correctamente';
$json['data']['username']       = $login['username'];
$json['data']['name']           = $login['name'];
$json['data']['email']          = $login['email'];
$json['data']['description']    = $login['description'];



echo(json_encode($json));
    
?>