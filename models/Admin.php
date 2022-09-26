<?php 
class Admin {
    // DB stuff
    private $conn;
    private $table = 'admin';

    // Post Properties
    public $id;
    public $lastname;
    public $firstname;
    public $identifiant;
    public $sexe;
    public $password;
    public $token;
    public $created_at;
    public $updated_at;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Create medecin
    public function create() {
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' SET lastname = :lastname, firstname = :firstname, identifiant = :identifiant, sexe = :sexe, password = :password, created_at = NOW()';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->lastname = htmlspecialchars(strip_tags($this->lastname));
        $this->firstname = htmlspecialchars(strip_tags($this->firstname));
        $this->identifiant = htmlspecialchars(strip_tags($this->identifiant));
        $this->sexe = htmlspecialchars(strip_tags($this->sexe));
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        // Bind data
        $stmt->bindParam(':lastname', $this->lastname);
        $stmt->bindParam(':firstname', $this->firstname);
        $stmt->bindParam(':identifiant', $this->identifiant);
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
}

?>