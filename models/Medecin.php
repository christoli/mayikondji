<?php 
  class Medecin {
    // DB stuff
    private $conn;
    private $table = 'medecin';

    // Post Properties
    public $id;
    public $lastname;
    public $firstname;
    public $matricule;
    public $sexe;
    public $password;
    public $token;
    public $created_at;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get medecins list
    public function read() {
      // Create query
      $query = 'SELECT m.id, m.lastname, m.firstname, m.identifiant, m.sexe
                                FROM ' . $this->table . ' m';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single medecin
    public function read_single() {
          // Create query
          $query = 'SELECT m.lastname, m.firstname, m.identifiant, m.sexe
                    FROM ' . $this->table . ' m
                                    WHERE
                                      m.id = ?
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
          $this->matricule = $row['identifiant'];
          $this->sexe = $row['sexe'];
    }

    // Create medecin
    public function create() {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET lastname = :lastname, firstname = :firstname, identifiant = :matricule, sexe = :sexe, password = :password, created_at = NOW()';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->lastname = htmlspecialchars(strip_tags($this->lastname));
          $this->firstname = htmlspecialchars(strip_tags($this->firstname));
          $this->matricule = htmlspecialchars(strip_tags($this->matricule));
          $this->sexe = htmlspecialchars(strip_tags($this->sexe));
          $this->password = password_hash($this->password, PASSWORD_DEFAULT);

          // Bind data
          $stmt->bindParam(':lastname', $this->lastname);
          $stmt->bindParam(':firstname', $this->firstname);
          $stmt->bindParam(':matricule', $this->matricule);
          $stmt->bindParam(':sexe', $this->sexe);
          $stmt->bindParam(':password', $this->password);

          // Execute query
          if($stmt->execute()) {
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Update medecin
    public function update() {
          // Create query
          $query = 'UPDATE ' . $this->table . ' SET lastname = :lastname, firstname = :firstname, identifiant = :matricule, sexe = :sexe, password = :password,
                            updated_at = NOW()
                    WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->lastname = htmlspecialchars(strip_tags($this->lastname));
          $this->firstname = htmlspecialchars(strip_tags($this->firstname));
          $this->matricule = htmlspecialchars(strip_tags($this->matricule));
          $this->sexe = htmlspecialchars(strip_tags($this->sexe));
          $this->password = password_hash($this->password, PASSWORD_DEFAULT);
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam(':lastname', $this->lastname);
          $stmt->bindParam(':firstname', $this->firstname);
          $stmt->bindParam(':matricule', $this->matricule);
          $stmt->bindParam(':sexe', $this->sexe);
          $stmt->bindParam(':password', $this->password);
          $stmt->bindParam(':id', $this->id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }

    // Delete medecin
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