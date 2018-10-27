<?php
use \Router\Router;

$pdo = \Database\DatabaseSingleton::getInstance();
$userHydrator = new \User\UserHydrator();
$userRepository = new \User\UserRepository($pdo, $userHydrator);

Router::post('/api/login', function($request) use($userRepository) {
    if (is_null($request->body)) return http_response_code(400);

    $email = $request->body->email;
    $hash = hash('sha256', $request->body->password);
    $user = $userRepository->fetchByEmailAndHash($email, $hash);

    if (!$user) return http_response_code(401);

    $id = $user->getId();


    $token = \Token\JwtHS256::generate($id, getenv('SECRET'), time());

    header("Authorization: Bearer $token");
    echo $token; // TODO: remove when front is ok
});
