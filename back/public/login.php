<?php

use \Router\Router;

$connection = \Database\DatabaseSingleton::getInstance();

$userHydrator = new \User\UserHydrator();
$userRepository = new \User\UserRepository($connection, $userHydrator);

Router::post('/api/login', function($request) use($userRepository, $userHydrator) {
    if (is_null($request->body)) return http_response_code(400);

    $email = $request->body->email;
    $hash = hash('sha256', $request->body->password);
    $user = $userRepository->fetchByEmailAndHash($email, $hash);

    if (!$user) return http_response_code(401);

    $id = $user->getId();
    $secret = 'secret123';

    $token = \Token\JwtHS256::generate($id, $secret, time());

    header("Authorization: Bearer $token");
});
