<?php

require_once (__DIR__ . '/../daos/UserDAO.php');
define("MD5_LENGTH", 32);

class AuthenticationService {

    private $userDAO;
           
    public function __construct() 
    {
        $this->userDAO = new UserDAO();
    }
    
    public function validateEmail($email) 
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $result = $this->userDAO->searchUserByEmail($email);
            if ( ($result !== false) || (count($result) === 0) )
            {
               return true; 
            }           
        }        
        return false;
    }

    private function validatePassword($password) 
    {
        return ctype_xdigit($password) && (strlen($password) == MD5_LENGTH);
    }

    public function signIn($user) 
    {
        if ($user !== null &&
            $user->email !== null &&
            $user->password !== null) 
        {              
            $results = $this->userDAO->searchUser($user);    
            if ( $results && (count($results) > 0) )
            {
                return $results[0]; //<! Returns first element in array
            }
            return array("error" => "Search user failed.");
        }
        return array("error" => "Invalid values.");
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
            return array("error" => "Insert new user failed.");
        }
        return array("error" => "Invalid values.");
    }
}
