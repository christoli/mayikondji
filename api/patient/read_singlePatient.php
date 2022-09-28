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
    if($data->token == $requestedToken['token']){
        // Get patient data
        $patient->lastname = $data->lastname;
        $patient->firstname = $data->firstname;
        $patient->sexe = $data->sexe;
        $patient->birthday = $data->birthday;
        $patient->telephone = $data->telephone;

        // Get patient
        $result = $patient->read_singlePatient();
        if($result->rowCount() > 0) {
            $row = $result->fetch();

            // Create array
            $patient_arr = array(
                'id' => $row['id'],
                'lastname' => $row['lastname'],
                'firstname' => $row['firstname'],
                'sexe' => $row['sexe'],
                'birthday' => $row['birth_day'],
                'telephone' => $row['telephone'],
                'adresse' => $row['adresse'],
                'success' => true
            );
            // Make JSON
            print_r(json_encode($patient_arr));
        } 
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