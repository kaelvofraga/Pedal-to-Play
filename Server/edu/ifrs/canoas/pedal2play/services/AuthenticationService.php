<?php

require_once (__DIR__ . '/../daos/UserDAO.php');

class AuthenticationService {

    private $userDAO;
           
    public function __construct() 
    {
        $this->userDAO = new UserDAO();
    }
    
    private function validateEmail($email) 
    {
        return true;
    }

    private function validatePassword($password) 
    {
        return ctype_xdigit($password) && (strlen($password) == 32);
    }

    public function signIn($user) 
    {
        if ($user !== null &&
            $user->email !== null &&
            $user->password !== null) 
        {              
            $results = $this->userDAO->searchUser($user);    
            if (count($results) > 0) 
            {
                return $results[0]; // returns first element in array
            }  
        }
        return false;
    }
        
    public function signUp($user) 
    {
        if (($user !== null) &&
            ($user->email !== null) &&
            ($user->password !== null) &&
            $this->validateEmail($user->email) &&
            $this->validatePassword($user->password)
        ){              
            if($this->userDAO->insere($user))
            {
                return $this->userDAO->searchUser($user)[0];
            }
        }
        return false;
    }
}
