<?php

use \Router\Router;
use \Token\JwtHS256;

$pdo = \Database\DatabaseSingleton::getInstance();
$userHydrator = new \User\UserHydrator();
$userRepository = new \User\UserRepository($pdo, $userHydrator);

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
        echo json_encode(['error' => $e->getMessage()]);
    }
});
