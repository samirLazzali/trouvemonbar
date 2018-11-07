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
        ->setEmail(strtolower($request->body->email))
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
        $user = $userRepository->fetchFullById($userId);
    } catch (Exception $e) {
        http_response_code(401);
        echo json_encode(['error' => $e->getMessage()]);
        return;
    }

    // Check parameter
    if (is_null($request->body) || !(isset($request->params[0]) && isset($request->body->password) && isset($request->body->currentPassword))) return http_response_code(400);

    $curent_password = $request->body->currentPassword;
    $current_hash = hash('sha256', $curent_password);


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


    if($user->getHash() != $current_hash)
    {
        return http_response_code(403);
    }

    $new_password = $request->body->password;

    if(strlen($new_password) < 3) return http_response_code(400);

    $new_hash = hash('sha256', $new_password);

    if(!$userRepository->updatePassword($id, $new_hash))
    {
        return http_response_code(200);
    }
    else
    {
        return http_response_code(500);
    }

});


Router::post('/api/users/{}/keywords', function($request) use($userRepository, $keywordRepository, $keywordHydrator) {
    if (!array_key_exists('HTTP_AUTHORIZATION', $_SERVER)) {
        http_response_code(401);
        echo json_encode(['error' => 'You are not authorized without JWT']);
        return;
    }

    [, $token] = explode(' ', $_SERVER['HTTP_AUTHORIZATION']);

    try {
        $userId = \Token\JwtHS256::validate($token, getenv('SECRET'));
        $user = $userRepository->fetchFullById($userId);
    } catch (Exception $e) {
        http_response_code(401);
        echo json_encode(['error' => $e->getMessage()]);
        return;
    }

    if(!(!is_null($request->body->keywordsIds) && isset($request->params[0]) && is_array($request->body->keywordsIds) && count($request->body->keywordsIds) > 0)) return http_response_code(400);

    // Get all the information from the body
    $str_id = $request->params[0];
    $user_id = ctype_digit($str_id) ? intval($str_id) : null;
    if ($user_id == null)
    {
        return http_response_code(400);
    }


    $keywords_ids = $request->body->keywordsIds;

    if(count($keywords_ids) < 1) return http_response_code(400);

    // Check if authorized or not
    if($user_id != $user->getId()){
        return http_response_code(400);
    }

    // Insert thoses keyword_ids inside the keyword inside the table keyuser
    if($keywordRepository->addKeywordByUser($user_id,$keywords_ids))
        return http_response_code(200);
    else
        return http_response_code(500);

});

