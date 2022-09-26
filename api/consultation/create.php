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
        // Get data
        $consultation->motif = $data->motif;
        $consultation->antecedant = $data->antecedant;
        $consultation->description_maladie = $data->description_maladie;
        $consultation->examen = $data->examen;
        $consultation->diagnostic = $data->diagnostic;
        $consultation->traitement = $data->traitement;
        $consultation->medecin_identifiant = $data->userId;
        $consultation->patient_id = $data->patient_id;
      
        // Create consultation
        if($consultation->create()) {
          echo json_encode(
            array('success'=>true,'message' => 'Consultation Created')
          );
        } else {
          echo json_encode(
            array('success'=>false,'message' => 'Consultation not Created')
          );
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

