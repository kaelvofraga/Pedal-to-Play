<?php 
	/*$user = json_decode(file_get_contents('php://input')); 
	if($user->email && $user->password){
		echo "true"; 
	}else{
		echo "false";
	}*/
	
	//call library 
	require_once ('edu/ifrs/canoas/pedal2play/resources/nusoap/nusoap.php');
	require_once ('edu/ifrs/canoas/pedal2play/beans/User.php'); 
	require_once ('edu/ifrs/canoas/pedal2play/daos/UserDAO.php'); 
	//using soap_server to create server object 
	$server = new soap_server; 

	//register a function that works on server 
	$server->register('set_user'); 

	// create the function 
	function set_user($user) 
	{ 
		if($user && $user->email && $user->password){ 
			$userBean = new User();
			$userBean->email = $user->email;
			$userBean->password = $user->password;
			$userDAO = new UserDAO();
			$userDAO->insere($userBean);
			return $userBean->email . ' ' . $userBean->password;
		}
		return new soap_fault('Invalid user.');  
	} 
	// create HTTP listener 
	$server->service($HTTP_RAW_POST_DATA); 
	exit(); 
?>