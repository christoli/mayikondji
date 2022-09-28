<?php 
  class Consultation {
    // DB stuff
    private $conn;
    private $table = 'consultation';

    // Post Properties
    public $id;
    public $motif;
    public $antecedant;
    public $description_maladie;
    public $examen;
    public $diagnostic;
    public $traitement;
    public $medecin_id;
    public $patient_id;
    public $centre_de_sante_id;
    public $created_at;
    public $medecin_identifiant;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }
    
    private function getMedecinId(){
      // Get medecin Id
      $query = 'SELECT id FROM medecin WHERE identifiant = ?';
      $stmt = $this->conn->prepare($query);
      $stmt->execute(array($this->medecin_identifiant));
      $result = $stmt->fetch();

      return $result['id'];
    }

    // Get Consultation list
    public function read() {
      // Create query
      $query = 'SELECT  p.lastname, p.firstname, c.id, c.motif, c.description_maladie, c.diagnostic, c.traitement, c.created_at
                FROM ' . $this->table . ' c
                INNER JOIN
                    patient p ON c.patient_id = p.id
                ORDER BY
                    c.created_at DESC';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Consultation
    public function read_single() {
          // Create query
          $query = 'SELECT  c.id, p.lastname, p.firstname, c.motif, c.antecedant, c.description_maladie, c.examen, c.diagnostic, c.traitement
                    FROM ' . $this->table . ' c
                    INNER JOIN
                    patient p ON c.patient_id = p.id
                    WHERE c.id = ?
                    LIMIT 0,1';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->id);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
          $this->id = $row['id'];
          $this->lastname = $row['lastname'];
          $this->firstname = $row['firstname'];
          $this->motif = $row['motif'];
          $this->antecedant = $row['antecedant'];
          $this->description_maladie = $row['description_maladie'];
          $this->examen = $row['examen'];
          $this->diagnostic = $row['diagnostic'];
          $this->traitement = $row['traitement'];
    }

    // Create Consultation
    public function create() {
          // Get medecin Id
          $this->medecin_id = $this->getMedecinId();
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET motif = :motif, antecedant = :antecedant, description_maladie = :description_maladie, 
                        examen = :examen, diagnostic = :diagnostic, traitement = :traitement, created_at = NOW(),
                        medecin_id = :medecin_id, patient_id = :patient_id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->motif = htmlspecialchars(strip_tags($this->motif));
          $this->antecedant = htmlspecialchars(strip_tags($this->antecedant));
          $this->description_maladie = htmlspecialchars(strip_tags($this->description_maladie));
          $this->examen = htmlspecialchars(strip_tags($this->examen));
          $this->diagnostic = htmlspecialchars(strip_tags($this->diagnostic));
          $this->traitement = htmlspecialchars(strip_tags($this->traitement));
          $this->patient_id = htmlspecialchars(strip_tags($this->patient_id));

          // Bind data
          $stmt->bindParam(':motif', $this->motif);
          $stmt->bindParam(':antecedant', $this->antecedant);
          $stmt->bindParam(':description_maladie', $this->description_maladie);
          $stmt->bindParam(':examen', $this->examen);
          $stmt->bindParam(':diagnostic', $this->diagnostic);
          $stmt->bindParam(':traitement', $this->traitement);
          $stmt->bindParam(':medecin_id', $this->medecin_id);
          $stmt->bindParam(':patient_id', $this->patient_id);

          // Execute query
          if($stmt->execute()) {
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Update Consultation
    public function update() {
          // Create query
          $query = 'UPDATE ' . $this->table . ' SET motif = :motif, antecedant = :antecedant, description_maladie = :description_maladie, 
                                            examen = :examen, diagnostic = :diagnostic, traitement = :traitement, updated_at = NOW()
                    WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->motif = htmlspecialchars(strip_tags($this->motif));
          $this->antecedant = htmlspecialchars(strip_tags($this->antecedant));
          $this->description_maladie = htmlspecialchars(strip_tags($this->description_maladie));
          $this->examen = htmlspecialchars(strip_tags($this->examen));
          $this->diagnostic = htmlspecialchars(strip_tags($this->diagnostic));
          $this->traitement = htmlspecialchars(strip_tags($this->traitement));
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam(':motif', $this->motif);
          $stmt->bindParam(':antecedant', $this->antecedant);
          $stmt->bindParam(':description_maladie', $this->description_maladie);
          $stmt->bindParam(':examen', $this->examen);
          $stmt->bindParam(':diagnostic', $this->diagnostic);
          $stmt->bindParam(':traitement', $this->traitement);
          $stmt->bindParam(':id', $this->id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }

    // Delete Consultation
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