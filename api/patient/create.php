<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Patient.php';
  include_once '../../models/Auth.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate patient object
  $patient = new Patient($db);

  // Instantiate Auth for medecin
  $table = 'medecin';
  $auth = new Auth($db, $table);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Get user token for authentication
  $result = $auth->getUserToken($data->userId, $table);
  // Get row count
  $num = $result->rowCount();
  
    // Check if any token
    if($num > 0) {
      // Get token
      $requestedToken = $result->fetch();
      // Verify user token
      if(($data->token == $requestedToken['token'])){
        // Get data
        $patient->lastname = $data->lastname;
        $patient->firstname = $data->firstname;
        $patient->sexe = $data->sexe;
        $patient->birthday = $data->birthday;
        $patient->telephone = $data->telephone;
        $patient->adresse = $data->adresse;
      
        // Create patient
        if($patient->create()) {
          $data = $patient->create();
          echo json_encode($data);
        } else {
          echo json_encode(
            array('success'=>false,'message' => 'Patient not Created')
          );
        }
      }  else {
          echo json_encode(
            array('tokenVerify'=>false,'message' => 'Invalid token')
          );
        }
    } else {
        echo json_encode(
          array('success'=>false,'message' => 'No token Found')
        );
      }
      
// http://mayikondji.local/api/patient/create.php