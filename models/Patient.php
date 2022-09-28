<?php 
  class Patient {
    // DB stuff
    private $conn;
    private $table = 'patient';

    // Post Properties
    public $id;
    public $lastname;
    public $firstname;
    public $sexe;
    public $birthday;
    public $telephone;
    public $adresse;
    public $password;
    public $created_at;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Patients list
    public function read() {
      // Create query
      $query = 'SELECT p.id, p.lastname, p.firstname, p.sexe, p.birth_day, p.telephone, p.adresse, p.created_at
                                FROM ' . $this->table . ' p
                                ORDER BY
                                  p.created_at DESC';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Patient
    public function read_single() {
          // Create query
          $query = 'SELECT p.id, p.lastname, p.firstname, p.sexe, p.birth_day, p.telephone, p.adresse, p.created_at
                    FROM ' . $this->table . ' p
                                    WHERE
                                      p.id = ?
                                    LIMIT 0,1';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->id);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
          $this->lastname = $row['lastname'];
          $this->firstname = $row['firstname'];
          $this->sexe = $row['sexe'];
          $this->birthday = $row['birth_day'];
          $this->telephone = $row['telephone'];
          $this->adresse = $row['adresse'];
    }

    // Get Single Patient
    public function read_singlePatient() {
      // Create query
      $query = 'SELECT p.id, p.lastname, p.firstname, p.sexe, p.birth_day, p.telephone, p.adresse, p.created_at
                FROM ' . $this->table . ' p
                                WHERE
                                  p.lastname = ? AND p.firstname = ? AND p.sexe = ? AND p.birth_day = ? AND p.telephone = ?
                                LIMIT 0,1';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      $this->lastname = htmlspecialchars(strip_tags($this->lastname));
      $this->firstname = htmlspecialchars(strip_tags($this->firstname));
      $this->sexe = htmlspecialchars(strip_tags($this->sexe));
      $this->birthday = htmlspecialchars(strip_tags($this->birthday));
      $this->telephone = htmlspecialchars(strip_tags($this->telephone));

      // Execute query
      $stmt->execute(array($this->lastname, $this->firstname, $this->sexe, $this->birthday, $this->telephone));

      return $stmt;
  }

   // Get Single Patient id
   public function GetPatientId($lastname, $firstname, $birthday,$sexe,$telephone) {
    // Create query
    $query = 'SELECT p.id, p.lastname, p.firstname, p.sexe, p.birth_day, p.telephone, p.adresse, p.created_at
              FROM ' . $this->table . ' p
                              WHERE
                                p.lastname = ? AND p.firstname = ? AND p.sexe = ? AND p.birth_day = ? AND p.telephone = ?
                              LIMIT 0,1';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $lastname = htmlspecialchars(strip_tags($lastname));
    $firstname = htmlspecialchars(strip_tags($firstname));
    $sexe = htmlspecialchars(strip_tags($sexe));
    $birthday = htmlspecialchars(strip_tags($birthday));
    $telephone = htmlspecialchars(strip_tags($telephone));

    // Execute query
    $stmt->execute(array($lastname, $firstname, $sexe, $birthday, $telephone));

    if($stmt->rowCount()>0){
      $row = $stmt->fetch();
      $data = array(
        "id" => $row['id'],
        "lastname" => $row['lastname'],
        "firstname" => $row['firstname'],
        "success" => true
      );
      return $data;
    }
}


    // Create Patient
    public function create() {
      //Verify is any patient
      $result = $this->read_singlePatient();
      if($result->rowCount()>0){
        $row = $result->fetch();
        $data = array(
          "id" => $row['id'],
          "lastname" => $row['lastname'],
          "firstname" => $row['firstname'],
          "success" => true
        );
        return $data;
      } else {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET lastname = :lastname, firstname = :firstname, sexe = :sexe, 
          birth_day = :birthday, telephone = :telephone, adresse = :adresse, created_at = NOW()';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->lastname = htmlspecialchars(strip_tags($this->lastname));
          $this->firstname = htmlspecialchars(strip_tags($this->firstname));
          $this->sexe = htmlspecialchars(strip_tags($this->sexe));
          $this->birthday = htmlspecialchars(strip_tags($this->birthday));
          $this->telephone = htmlspecialchars(strip_tags($this->telephone));
          $this->adresse = htmlspecialchars(strip_tags($this->adresse));

          // Bind data
          $stmt->bindParam(':lastname', $this->lastname);
          $stmt->bindParam(':firstname', $this->firstname);
          $stmt->bindParam(':sexe', $this->sexe);
          $stmt->bindParam(':birthday', $this->birthday);
          $stmt->bindParam(':telephone', $this->telephone);
          $stmt->bindParam(':adresse', $this->adresse);

          // Execute query
          if($stmt->execute()) {
              $result = $this->GetPatientId($this->lastname,$this->firstname,$this->sexe,$this->birthday,$this->telephone);

            return $result;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
      }
    }

    // Update Patient
    public function update() {
          // Create query
          $query = 'UPDATE ' . $this->table . ' SET lastname = :lastname, firstname = :firstname, sexe = :sexe, 
                            birth_day = :birthday, telephone = :telephone, adresse = :adresse, updated_at = NOW()
                                WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->lastname = htmlspecialchars(strip_tags($this->lastname));
          $this->firstname = htmlspecialchars(strip_tags($this->firstname));
          $this->sexe = htmlspecialchars(strip_tags($this->sexe));
          $this->birthday = htmlspecialchars(strip_tags($this->birthday));
          $this->telephone = htmlspecialchars(strip_tags($this->telephone));
          $this->adresse = htmlspecialchars(strip_tags($this->adresse));
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam(':lastname', $this->lastname);
          $stmt->bindParam(':firstname', $this->firstname);
          $stmt->bindParam(':sexe', $this->sexe);
          $stmt->bindParam(':birthday', $this->birthday);
          $stmt->bindParam(':telephone', $this->telephone);
          $stmt->bindParam(':adresse', $this->adresse);
          $stmt->bindParam(':id', $this->id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }

    // Delete Patient
    public function delete() {
          // Create query
          $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam(':id', $this->id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }
    
  }