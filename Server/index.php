<?php

require_once '/edu/ifrs/canoas/pedal2play/resources/Slim/Slim/Slim.php';
require_once '/edu/ifrs/canoas/pedal2play/services/AuthenticationService.php';

\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

$app->response()->header('Content-Type', 'application/json;charset=utf-8');

$app->get('/', function () {
    echo "PSP-WebAPI";
});

$app->post('/signIn', 'signIn');

function signIn() {
    $request = \Slim\Slim::getInstance()->request();
    $user = json_decode($request->getBody());
    $authService = new AuthenticationService();
    echo json_encode($authService->signIn($user));
}

$app->run();
