<?php

require_once (__DIR__ . '/../daos/UserDAO.php');

class AuthenticationService {

    private $userDAO;

    public function __construct() {
        $this->userDAO = new UserDAO();
    }

    public function signIn($user) {
        if ($user !== null &&
            $user->email !== null &&
            $user->password !== null) {
            return $this->userDAO->searchUser($user);
        }
        return false;
    }

    public function signUp($user) {
        //TODO: insert in DB
    }

    private function validateEmail($email) {
        //TODO: to validate email
    }

    private function validatePassword($password) {
        //TODO: to validate password
    }

}
