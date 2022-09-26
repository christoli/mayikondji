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
  $result = $auth->getUserToken($data->identifiant, $table);
  // Get row count
  $num = $result->rowCount();

  // Check if any token
  if($num > 0) {
    // Get token
    $requestedToken = $result->fetch();
    // Verify user token
    if($data->token == $requestedToken['token']){
        // Patients list query
      $result = $patient->read();
      // Get row count
      $num = $result->rowCount();

      // Check if any posts
      if($num > 0) {
        // Patient array
        $patients_arr = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $patient_item = array(
            'id' => $id,
            'lastname' => $lastname,
            'firstname' => $firstname,
            'sexe' => $sexe,
            'telephone' => $telephone,
            'adresse' => html_entity_decode($adresse),
            'created_at' => $created_at
          );

          // Push to "data"
          array_push($patients_arr, $patient_item);
          // array_push($posts_arr['data'], $post_item);
        }

        // Turn to JSON & output
        echo json_encode($patients_arr);

      } else {
        // No Patient
        echo json_encode(
          array('success' => false, 'message' => 'No Patients Found')
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