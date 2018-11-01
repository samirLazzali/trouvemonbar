<?php

use \Router\Router;
use \Token\JwtHS256;

$pdo = \Database\DatabaseSingleton::getInstance();
$userHydrator = new \User\UserHydrator();
$userValidator = new \User\UserValidator();
$userRepository = new \User\UserRepository($pdo);

Router::get('/api/users/{}', function() use($userRepository, $userHydrator) {
    if (!array_key_exists('HTTP_AUTHORIZATION', $_SERVER)) {
        http_response_code(401);
        echo json_encode(['error' => 'You are not authorized without JWT']);
        return;
    }

    [, $token] = explode(' ', $_SERVER['HTTP_AUTHORIZATION']);

    try {
        $userId = JwtHS256::validate($token, getenv('SECRET'));
        $user = $userRepository->fetchById($userId);
        echo json_encode($userHydrator->extract($user));
    } catch (Exception $e) {
        http_response_code(401);
        echo json_encode(['error' => $e->getMessage()]);
    }
});

Router::post('/api/users', function($request) use($userRepository, $userValidator) {
    if (!$userValidator->validate($request->body)) {
        return http_response_code(400);
    }

    $user = (new \User\User())
        ->setEmail($request->body->email)
        ->setHash(hash('sha256', $request->body->password))
        ->setPseudo($request->body->pseudo)
        ->setRole('USER');

    if(!$userRepository->isValidUser($user)) {
        http_response_code(400);
        echo json_encode(['error' => 'Email or pseudo already exist']);
        return;
    }

    if(!$userRepository->createUser($user)) {
        return http_response_code(500);
    } else {
        return http_response_code(201);
    }
});

Router::put('/api/users/{}', function($request) use($userRepository) {
    if (!array_key_exists('HTTP_AUTHORIZATION', $_SERVER)) {
        http_response_code(401);
        echo json_encode(['error' => 'You are not authorized without JWT']);
        return;
    }

    [, $token] = explode(' ', $_SERVER['HTTP_AUTHORIZATION']);

    try {
        $userId = JwtHS256::validate($token, getenv('SECRET'));
        $user = $userRepository->fetchById($userId);
    } catch (Exception $e) {
        http_response_code(401);
        echo json_encode(['error' => $e->getMessage()]);
        return;
    }

    // Check parameter
    if (is_null($request->body) || !(isset($request->params[0]) && isset($request->body->user->password))) return http_response_code(400);


    // Get all the information from the body
    $str_id = $request->params[0];
    $id = ctype_digit($str_id) ? intval($str_id) : null;
    if ($id === null)
    {
        return http_response_code(400);
    }

    if($user->getId() != $id)
    {
        return http_response_code(401);
    }

    $password = $request->body->user->password;

    if(strlen($password) < 3) return http_response_code(400);

    $hash = hash('sha256', $password);

    if(!$userRepository->updatePassword($id,$hash))
    {
        return http_response_code(500);
    }
    else
    {
        return http_response_code(200);
    }

});
