<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Consultation.php';
  include_once '../../models/Auth.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate consultation object
  $consultation = new Consultation($db);


  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $consultation->id = $data->id;

  // Delete consultation
  if($consultation->delete()) {
    echo json_encode(
      array('success'=>true, 'message' => 'Consultation Deleted')
    );
  } else {
    echo json_encode(
      array('success'=>false, 'message' => 'Consultation Not Deleted')
    );
  }
?>

