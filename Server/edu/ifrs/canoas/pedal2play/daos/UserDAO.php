<?php

require_once 'Connection.php';
define('TOKEN_BYTES', 16);

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
            
            return $this->conn->select("SELECT u.id_user, u.token FROM user u WHERE 
					u.email = " . $email . " AND 
					u.password = " . $password);
        }
        return array("error" => "Null connection.");
    }
    
    public function searchUserByEmail($email) 
    {
        if ($this->conn) 
        {
            $quotedEmail = $this->conn->quote($email);
            
            return $this->conn->select("SELECT u.id_user FROM user u WHERE 
					u.email = " . $quotedEmail);
        }
        return array("error" => "Null connection.");
    }
    
    public function validateToken($id, $token) 
    {
        if ($this->conn) 
        {
            $quotedID = $this->conn->quote($id);
            $quotedToken = $this->conn->quote($token);
            
            return $this->conn->select("SELECT COUNT(u.id_user) FROM user u WHERE 
					u.id_user = " . $quotedID . " AND 
					u.token = " . $quotedToken) > 0;
        }
        return array("error" => "Null connection.");
    }

    public function insere($user) 
    {
        if ($this->conn) 
        {
            $email = $this->conn->quote($user->email);
            $password = $this->conn->quote($user->password);
            $token = $this->conn->quote(bin2hex(openssl_random_pseudo_bytes(TOKEN_BYTES)));
            $currentDate = $this->conn->quote((new DateTime())->format('Y-m-d H:i:s'));
            return $this->conn->query("INSERT INTO user (email, 
                                                         password, 
                                                         token, 
                                                         subscription_date) 
				       VALUES (" . $email . "," . 
                                                   $password . "," .
                                                   $token . "," .
                                                   $currentDate . ")");
        }
        return array("error" => "Null connection.");
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
