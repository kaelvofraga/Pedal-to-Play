<?php

require_once '/edu/ifrs/canoas/pedal2play/resources/Slim/Slim/Slim.php';
require_once '/edu/ifrs/canoas/pedal2play/services/AuthenticationService.php';
require_once '/edu/ifrs/canoas/pedal2play/services/TokenMiddleware.php';

\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

$app->response()->header('Content-Type', 'application/json;charset=utf-8');

$app->add(new \TokenMiddleware());

function accessIsOK() 
{
    $app = \Slim\Slim::getInstance();
    if ($app->athenticated)
    {       
       return true;
    }
    $app->response()->status(401); //<! Unhautorized Error 
    return false;
}

/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Routes ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

$app->get('/', function () 
{
    echo "P2P-WebAPI";   
});

$app->post('/signIn', function() 
{
    $request = \Slim\Slim::getInstance()->request();
    $user = json_decode($request->getBody());
    $authService = new AuthenticationService();
    echo json_encode($authService->signIn($user));
});

$app->post('/signUp', function() 
{
    if (accessIsOK()) 
    {
        $request = \Slim\Slim::getInstance()->request();
        $user = json_decode($request->getBody());
        $authService = new AuthenticationService();
        echo json_encode($authService->signUp($user));
    }
});

/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ End Routes ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

$app->run();
