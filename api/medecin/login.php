<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Auth.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instanciate Auth for medecin
$table = 'medecin';
$auth = new Auth($db, $table);

// Get data
$data = json_decode(file_get_contents("php://input"));

$auth->identifiant = $data->identifiant;
$auth->password = $data->password;

// Login authentication
if($auth->login()){
    // Turn to JSON & output
    $data = $auth->login();
    echo json_encode($data);
} else {
        // Login failed
        echo json_encode(
            array('success' => false,'message' => 'Identifiant or password invalid')
          );
}
?>