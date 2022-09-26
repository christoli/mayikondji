<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Auth.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instanciate Auth for medecin
$user = 'medecin';
$auth = new Auth($db, $user);

// Get data
$data = json_decode(file_get_contents("php://input"));

$auth->token = $data->token;

// Update (delete token)
if($auth->logout()){
    echo json_encode(array('success'=>true,'message'=>'token deleted/updated'));
} else{
    echo json_encode(array('success'=>false));
}
?>