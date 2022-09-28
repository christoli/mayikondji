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

  $consultation->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get patient
  $consultation->read_single();

  // Create array
  $consultation_arr = array(
    'id'=> $consultation->id,
    'lastname' => $consultation->lastname,
    'firstname' => $consultation->firstname,
    'motif' => $consultation->motif,
    'antecedant' =>$consultation->antecedant,
    'description_maladie' => $consultation->description_maladie,
    'examen' => $consultation->examen,
    'diagnostic' => $consultation->diagnostic,
    'traitement' => $consultation->traitement,
    'empty' => 'full'
  );

  // Make JSON
  print_r(json_encode($consultation_arr));
    
?>