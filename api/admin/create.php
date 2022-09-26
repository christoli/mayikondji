<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Admin.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate medecin object
  $admin = new Admin($db);


  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));


  // Get data
  $admin->lastname = $data->lastname;
  $admin->firstname = $data->firstname;
  $admin->identifiant = $data->identifiant;
  $admin->sexe = $data->sexe;
  $admin->password = $data->password;

  // Create admin
  if($admin->create()) {
    echo json_encode(
      array('success'=>true,'message' => 'Admin Created')
    );
  } else {
    echo json_encode(
      array('success'=>false,'message' => 'Admin not Created')
    );
  }
?>



