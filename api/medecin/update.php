<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Medecin.php';
  include_once '../../models/Auth.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate medecin object
  $medecin = new Medecin($db);

  // Instantiate Auth for admin
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
      if(password_verify($data->token, $requestedToken)){
        // Set ID to update
        $medecin->id = $data->id;

        $medecin->lastname = $data->lastname;
        $medecin->firstname = $data->firstname;
        $medecin->matricule = $data->matricule;
        $medecin->sexe = $data->sexe;
        $medecin->password = $data->password;

        // Update Consultation
        if($medecin->update()) {
          echo json_encode(
            array('success'=>true, 'message' => 'Medecin Updated')
          );
        } else {
          echo json_encode(
            array('success'=>false, 'message' => 'Medecin Not Updated')
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
?>


