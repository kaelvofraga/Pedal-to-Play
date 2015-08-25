<?php 
	require_once ('edu/ifrs/canoas/pedal2play/daos/UserDAO.php'); 
	
	$user = json_decode(file_get_contents('php://input')); 
	$userDAO = new UserDAO();	
	
	if($user){
		switch($_SERVER['REQUEST_METHOD']) { 
			case 'GET':
				if ($user->email && $user->password) { 
					echo json_encode($userDAO->searchUser($user));
				} else {
					echo "false";
				} 
			case 'POST':
				$userDAO->insere($user);
				break; 
			case 'PUT':
				$userDAO->update($user);  
				break; 
			case 'DELETE':
				$userDAO->delete($user); 
				break; 
		}
	} else {
		echo "false";
	}	
?>