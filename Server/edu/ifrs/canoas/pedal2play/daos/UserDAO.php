<?php

require_once ('Connection.php');

class UserDAO {

    private $conn;

    public function __construct() {
        $this->conn = new Connection();
    }

    public function searchUser($user) {
        if ($this->conn) {
            $email = $this->conn->quote($user->email);
            $password = $this->conn->quote($user->password);

            return $this->conn->select("SELECT u.* FROM User u WHERE 
					u.email = " . $email . " AND 
					u.password = " . $password)[0];
        }
        return false;
    }

    public function insere($user) {
        if ($this->conn) {
            $email = $this->conn->quote($user->email);
            $password = $this->conn->quote($user->password);

            return $this->conn->query("INSERT INTO `User` (`email`,`password`) 
				       VALUES (" . $email . "," . $password . ")");
        }
        return false;
    }

    public function update($user) {
        return true;
    }

    public function delete($user) {
        return true;
    }

}
