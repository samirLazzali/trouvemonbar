<?php

use \Router\Router;

$connection = \Database\DatabaseSingleton::getInstance();

$userHydrator = new \User\UserHydrator();
$userRepository = new \User\UserRepository($connection, $userHydrator);

Router::post('/api/login', function($request) use($userRepository, $userHydrator) {
    $email = $request->body->email;
    $hash = hash('sha256', $request->body->password);
    $user = $userRepository->fetchByEmailAndHash($email, $hash);

    if ($user) {
        $id = $user->getId();
        $header = '{"alg":"HS256","typ":"JWT"}';
        $payload = '{"id":"1"}';

        $base64 = base64_encode($header) . '.' . base64_encode($payload);
        echo $payload;
        echo $base64;

        $signature = hash_hmac('sha256', $base64 , 'secret');
        echo $base64 . '.' . $signature;
    } else {
        http_response_code(401);
    }
});
