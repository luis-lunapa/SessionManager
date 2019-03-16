<?php
    require_once('../include/header.php');
    

    /*
   *	Este web service recibe los datos de login de un usuario, los valida contra BDD, autoriza el acceso a un usuario, si es el caso, y crea una nueva sesión
   *
   *	Parámetros:
   *	- username 
   *    - password

   *
   *	Devuelve un JSON con {status, msg, data}
   *
   *	Lista de status:
   *	- 0         No execution
   *	- 200 	    Success
   *	- 600       Datos faltantes o incorrectos del usuario
   *    - 601       Usuaio no registrado
   *    - 604       Contraseña incorrecta
   */

header('Content-Type: application/json');
$json = array (
    'status'    => '0',
    'msg'       => 'Sin Ejecución',
    'data'      => array (
        'token'         => '',
        'validoHasta'   => '',
        'idUser'        => ''
    )
);

if(isset($_GET['debug'])){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

$username = "";
if(!isset($_GET['username']) || trim($_GET['username']) == "") {
    $json['status'] 	= 601;
    $json['msg']		= "No se recibió username";
    echo json_encode($json);
    exit;

}
else {
    $username = $_GET['username'];
}

$password = "";
if(!isset($_GET['password']) || trim($_GET['password']) == "") {
    $json['status'] 	= 601;
    $json['msg']		= "No se recibió password";
    echo json_encode($json);
    exit;

}
else {
    $password = $_GET['password'];
}

$result = $db->querySelect(
    "Se verifica si existe username $username con password $password en bd",
    " SELECT
        *  
     FROM 
        User
    WHERE
        username = '$username' AND
        password = '$password'
    "

);
//$db->printQuery();
$user =  $result->fetch_assoc();

if($user) {

   
    $json['data']['idUser'] = $user['idUser'];

} else {
    $json['msg']            = 'Usuario o contraseña incorrectos';
    $json['status']         = 600;
    echo(json_encode($json));
    exit;
    
    echo "No se pudo";
}




$json['msg']            = $user['idUser'];

    


echo(json_encode($json));
    
?>