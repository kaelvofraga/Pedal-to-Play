<?php
require_once (__DIR__ . '/../daos/UserDAO.php');

class TokenAuth extends \Slim\Middleware {

    public function __construct() {}

    /**
     * Deny Access
     */
    public function deny_access() {
        $response = $this->app->response();
        $response->status(401); //<! Unhautorized Error
    }

    /**
     * Call
     */
    public function call() {
        $userAuth = $this->app->request->headers->get('Authorization');
        $userDAO = new UserDAO();
        if ($userAuth->isLoging ||
            $userDAO->validateToken($userAuth->id_user, $userAuth->token)) 
        {
            $this->next->call();
        } 
        else 
        {
            $this->deny_access();
        }
    }

}
