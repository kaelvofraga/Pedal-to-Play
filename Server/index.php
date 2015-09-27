<?php

require_once (__DIR__ . '/edu/ifrs/canoas/pedal2play/resources/Slim/Slim/Slim.php');
require_once (__DIR__ . '/edu/ifrs/canoas/pedal2play/services/AuthenticationService.php');
require_once (__DIR__ . '/edu/ifrs/canoas/pedal2play/services/TokenMiddleware.php');

\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();
$app->setName("Pedal-to-Play");
$app->add(new \TokenMiddleware());
$app->response()->header('Content-Type', 'application/json;charset=utf-8');
$app->log->setEnabled(true);
$app->log->setLevel(\Slim\Log::DEBUG);
$app->environment['slim.errors'] = fopen(__DIR__ .'/log.txt', 'w');

/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Configurations ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

if (isset($_SERVER['HTTP_ORIGIN'])) 
{
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400'); //<! Cache for 1 day
}

/* Access-Control headers are received during OPTIONS requests */
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') 
{
    // return only the headers and not the content
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']) && 
        isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) 
    {
        header('Access-Control-Allow-Headers: content-type');
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    }
    exit;    
}

/*~~~~~~~~~~~~~~~~~~~~~~~~~~ End Configurations ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

function accessIsOK() 
{
    $app = \Slim\Slim::getInstance();
    if ($app->authenticated)
    {       
       return true;
    }
    $app->response()->status(401); //<! Unhautorized Error 
    return false;
}

/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ Routes ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

$app->get('/', function () 
{
    echo "Welcome to P2P-WebAPI";   
});

$app->get('/validateemail/:email', function ($email) 
{
    $authService = new AuthenticationService();
    echo json_encode($authService->validateEmail($email));
});

$app->post('/signin', function() 
{
    $request = \Slim\Slim::getInstance()->request();
    $user = json_decode($request->getBody());
    $authService = new AuthenticationService();
    echo json_encode($authService->signIn($user));
});

$app->post('/signup', function()
{
    $request = \Slim\Slim::getInstance()->request();
    $user = json_decode($request->getBody());
    $authService = new AuthenticationService();
    echo json_encode($authService->signUp($user));    
});

/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ End Routes ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

$app->run();
