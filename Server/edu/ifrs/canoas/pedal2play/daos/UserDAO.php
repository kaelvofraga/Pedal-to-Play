<?php 
require_once ('./beans/User.php'); 
require_once ('daos/Connection.php'); 
class UserDAO{
	
	private $conn;
	
	public function __construct() {
		$this->conn = new Connection();
	}
		
	public function insere(User $user){
		$email = $this -> conn -> quote($user->email);
		$password = $this -> conn -> quote($user->password);

		$result = $this -> conn -> query("INSERT INTO `Usuario` (`email`,`senha`) VALUES (" . $email . "," . md5($password) . ")");
		return $result;
	}
	
	public function searchUser(User $user){
		
	}
	
	public function update(User $user){
		
	}
	
	public function delete(User $user){
		
	}
}	
?>