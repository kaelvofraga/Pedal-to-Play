<?php

require_once (__DIR__ . '/../resources/Slim/Slim/Middleware.php');
require_once (__DIR__ . '/../daos/UserDAO.php');

class TokenMiddleware extends \Slim\Middleware {

    public function __construct() {}

    /**
     * Call
     */
    public function call() 
    {
        $request = $this->app->request;
        $headers = $request->headers;
        $jsonStrUser = $headers->get('Authorization');        
        $userAuth = json_decode($jsonStrUser);
        $userDAO = new UserDAO();
        if (($userAuth !== null) && 
            ($userDAO->validateToken($userAuth->id_user, $userAuth->token))
        ){
            $this->app->authenticated = true;
        } 
        else
        {
            $this->app->authenticated = false;
        }
        $this->next->call();
    }

}
