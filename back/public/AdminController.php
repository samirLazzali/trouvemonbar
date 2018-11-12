<?php

use \Router\Router;

$pdo = \Database\DatabaseSingleton::getInstance();

$barRepository = new \Bar\BarHydrator();
$barRepository = new \Bar\BarRepository($pdo);

Router::get('/api/admin/comments', function($request) use($barRepository, $barHydrator)
{
    if (!array_key_exists('HTTP_AUTHORIZATION', $_SERVER)) {
        http_response_code(401);
        echo json_encode(['error' => 'You are not authorized without JWT']);
        return;
    }

    [, $token] = explode(' ', $_SERVER['HTTP_AUTHORIZATION']);

    try {
        $userId = \Token\JwtHS256::validate($token, getenv('SECRET'));
        $user = $userRepository->fetchFullById($userId);
        if($user->getRole() !== 'ADMIN'){
            echo json_encode(['error' => 'Vous avez besoin de privillèges administrateur pour accèder cette information.']);
            http_response_code(401);
            return;
        }
        $bars = $barRepository->fetchAll();
        echo json_encode($barHydrator->extractAll($bars), JSON_UNESCAPED_UNICODE);
    } catch (Exception $e) {
        http_response_code(401);
        echo json_encode(['error' => $e->getMessage()]);
        return;
    }
});
