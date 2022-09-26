<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Consultation.php';
  include_once '../../models/Auth.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate consultation object
  $consultation = new Consultation($db);

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
        // Get id
        $consultation->id = $data->id;
        // Get patient
        $consultation->read_single();

        // Create array
        $consultation_arr = array(
          'lastname' => $consultation->lastname,
          'firstname' => $consultation->firstname,
          'motif' => $consultation->motif,
          'antecedant' =>$consultation->antecedant,
          'description_maladie' => $consultation->description_maladie,
          'examen' => $consultation->examen,
          'diagnostic' => $consultation->diagnostic,
          'traitement' => $consultation->traitement
        );

        // Make JSON
        print_r(json_encode($consultation_arr));
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