<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

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
    if($data->token == $requestedToken['token']){
        // Get patient ID
        $patient->id = $data->id;
        // Get patient
        $patient->read_single();

        // Create array
        $patient_arr = array(
          'id' => $patient->id,
          'lastname' => $patient->lastname,
          'firstname' => $patient->firstname,
          'sexe' => $patient->sexe,
          'birthday' => $patient->birthday,
          'telephone' => $patient->telephone,
          'adresse' => $patient->adresse
        );

        // Make JSON
        print_r(json_encode($patient_arr));
    } else {
        echo json_encode(
          array('tokenVerify'=>false,'message' => 'Invalid token')
        );
      }
  } else {
      echo json_encode(
        array('success'=>false,'message' => 'No token Found')
      );
    }
?>