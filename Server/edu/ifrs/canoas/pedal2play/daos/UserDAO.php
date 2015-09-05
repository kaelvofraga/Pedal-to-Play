<?php

require_once 'Connection.php';

class UserDAO {

    private $conn;

    public function __construct() 
    {
        $this->conn = new Connection();
    }

    public function searchUser($user) 
    {
        if ($this->conn) 
        {
            $email = $this->conn->quote($user->email);
            $password = $this->conn->quote($user->password);
            
            return $this->conn->select("SELECT u.id_user, u.token FROM User u WHERE 
					u.email = " . $email . " AND 
					u.password = " . $password);
        }
        return false;
    }
    
    public function validateToken($id, $token) 
    {
        if ($this->conn) 
        {
            $quotedID = $this->conn->quote($id);
            $quotedToken = $this->conn->quote($token);
            
            return $this->conn->select("SELECT COUNT(u.id_user) FROM User u WHERE 
					u.id_user = " . $quotedID . " AND 
					u.token = " . $quotedToken) > 0;
        }
        return false;
    }

    public function insere($user) 
    {
        if ($this->conn) 
        {
            $email = $this->conn->quote($user->email);
            $password = $this->conn->quote($user->password);
            $token = bin2hex(openssl_random_pseudo_bytes(16));

            return $this->conn->query("INSERT INTO User (email, password, token) 
				       VALUES (" . $email . "," . 
                                                   $password . "," .
                                                   $token . ")");
        }
        return false;
    }

    public function update($user) 
    {
        return true;
    }

    public function delete($user) 
    {
        return true;
    }

}
