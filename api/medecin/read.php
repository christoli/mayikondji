<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Medecin.php';
  include_once '../../models/Auth.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate medecin object
  $medecin = new Medecin($db);

  // Instantiate Auth for admin
  $table = 'admin';
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
    if(password_verify($data->token, $requestedToken)){
      // Medecins list query
      $result = $medecin->read();
      // Get row count
      $num = $result->rowCount();

      // Check if any medecin
      if($num > 0) {
        // medecin array
        $medecins_arr = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $medecin_item = array(
            'id' => $id,
            'lastname' => $lastname,
            'firstname' => $firstname,
            'sexe' => $sexe,
            'matricule' => $matricule
          );

          // Push to "data"
          array_push($medecins_arr, $medecin_item);
        }

        // Turn to JSON & output
        echo json_encode($medecins_arr);

      } else {
        // No medecin
        echo json_encode(
          array('success' => false, 'message' => 'No Medecins Found')
        );
      }
    } else {
        echo json_encode(
          array('tokenVerify'=>false,'message' => 'Invalid token')
        );
      }
  }  else {
        echo json_encode(
          array('success'=>false,'message' => 'No token Found')
        );
      }
?>