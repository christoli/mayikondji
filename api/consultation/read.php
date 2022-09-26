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
        // Get medecin identifiant
        $consultation->medecin_identifiant = $data->userId;
        // consultations list query
        $result = $consultation->read();
        // Get row count
        $num = $result->rowCount();

        // Check if any posts
        if($num > 0) {
          // consultation array
          $consultation_arr = array();

          while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $consultation_item = array(
              'id' => $id,
              'motif' => $motif,
              'lastname' => $lastname,
              'firstname' => $firstname,
              'description_maladie' => $description_maladie,
              'diagnostic' => $diagnostic,
              'traitement' => $traitement,
              'created_at' => $created_at
            );

            // Push to "data"
            array_push($consultation_arr, $consultation_item);
            // array_push($posts_arr['data'], $post_item);
          }

          // Turn to JSON & output
          echo json_encode($consultation_arr);

        } else {
          // No Patient
          echo json_encode(
            array('success' => false, 'message' => 'No Consultations Found')
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