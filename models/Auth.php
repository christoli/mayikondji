<?php
class Auth{
    // DB stuff
    private $conn;
    private $table;

    // Login Properties
    public $identifiant;
    public $password;
    public $token;
    public $data;

    // Constructor with DB
    public function __construct($db, $table) {
        $this->conn = $db;
        $this->table = $table;
    }

    public function generateToken() {
        //Generate a random string.
        $token = openssl_random_pseudo_bytes(64);
        //Convert the binary data into hexadecimal representation.
        $token = bin2hex($token);
        //Password hash
        // $token = password_hash($token, PASSWORD_DEFAULT);
        
        return $token;
    }

    public function login() {
        // Create query
        $query = 'SELECT id, lastname, firstname, identifiant, `password` FROM ' . $this->table . '
                    WHERE identifiant = :identifiant';

        // Prepare statement
        $stmt = $this->conn->prepare($query);
        
        // Clean data
        $this->identifiant = htmlspecialchars($this->identifiant);
        // $this->password = htmlspecialchars($this->password);

        // Bind data
        $stmt->bindParam(':identifiant', $this->identifiant);

        // Execute query
        $stmt->execute();
        if($stmt->rowCount()>0){
            // Get user data
            $userData = $stmt->fetch();
            // Password verification
            if(password_verify($this->password, $userData['password'])) {
                
                // Generate token
                $this->token = $this->generateToken();

                // Update user login token
                $tokenUpdateQuery = 'UPDATE '.$this->table.' SET token = :loginToken, updated_at = NOW() WHERE id = :user_id';
                $tokenQuery = $this->conn->prepare($tokenUpdateQuery);

                // Bind data
                $tokenQuery->bindParam(':loginToken', $this->token);
                $tokenQuery->bindParam(':user_id', $userData['id']);
                
                // Verify the query execution and send token
                if($tokenQuery->execute()){
                    // Get logged user data
                    $this->data = array(
                        "identifiant" => $userData['identifiant'],
                        "lastname" => $userData['lastname'],
                        "firstname" => $userData['firstname'],
                        "token" => $this->token,
                        "success" => true
                    );
                    // Return logged user data
                    return $this->data;
                } else{
                    return false;
                }
            }
        } else{
            return false;
        }
    }

    // Get logged user token
    public function getUserToken($identifiant, $table) {
        // Make query
        $query = 'SELECT token FROM '.$table.' 
                    WHERE identifiant = :userIdentifiant';
        $stmt = $this->conn->prepare($query);

        // Bind data
        $stmt->bindParam(':userIdentifiant', $identifiant);
        if($stmt->execute()){
            return $stmt;
        }
    }

    public function logout() {
        // Update token for logout
        $request = $this->conn->prepare('UPDATE '.$this->table.' SET token = NULL 
                    WHERE token = :loginToken');
        
        // Bind data
        $request->bindParam(':loginToken', $this->token);

        if($request->execute()){
            return true;
        } else {
            return false;
        }
    }
}

?>